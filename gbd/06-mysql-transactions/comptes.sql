-- 1: Validación de saldo (PROCEDURE)
USE comptes;
DROP PROCEDURE IF EXISTS sp_transferencia;

DELIMITER //
CREATE PROCEDURE sp_transferencia()
BEGIN
    DECLARE saldo_origen DECIMAL(10,2);
    START TRANSACTION;

    SELECT saldo INTO saldo_origen FROM comptes WHERE id = 1;
    IF saldo_origen < 200 THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Saldo insuficiente';
    ELSE
        UPDATE comptes SET saldo = saldo - 200 WHERE id = 1;
        UPDATE comptes SET saldo = saldo + 200 WHERE id = 2;
        COMMIT;
    END IF;
END //

DELIMITER ;
CALL sp_transferencia();

-- 2: Transacción con ingreso de log
USE comptes;
CREATE TABLE log_transaccion(
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL,
    data_operacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

DROP PROCEDURE IF EXISTS sp_transferenciaLog;

DELIMITER //
CREATE PROCEDURE sp_transferenciaLog()
BEGIN
    DECLARE saldo_origen DECIMAL(10,2);
    DECLARE saldo_transferido DECIMAL(10,2);
    START TRANSACTION;

    SET saldo_origen = (SELECT saldo FROM comptes WHERE id = 1);
    SET saldo_transferido = 200;
    IF saldo_origen < 200 THEN
        ROLLBACK;
        INSERT INTO log_transaccion(descripcion, data_operacion) VALUES ('Operación cancelada, saldo insuficiente', NOW());
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Saldo insuficiente'; -- Este el último ya que detiene la ejecución aparantemente.
    ELSE
        UPDATE comptes SET saldo = saldo - saldo_transferido WHERE id = 1;
        UPDATE comptes SET saldo = saldo + saldo_transferido WHERE id = 2;
        COMMIT;
        INSERT INTO log_transaccion(descripcion, data_operacion) VALUES (CONCAT('Transferencia realizada: ', CAST(saldo_transferido AS CHAR), ' créditos.'), NOW());
    END IF;
END //
DELIMITER ;

CALL sp_transferenciaLog();

-- 3: Actualización masiva con condición
DROP PROCEDURE IF EXISTS sp_aplicar_interes;

DELIMITER //
CREATE PROCEDURE sp_aplicar_interes()
BEGIN
    DECLARE cuentas_actualizadas INT;
    START TRANSACTION;

    UPDATE comptes SET saldo = saldo * 1.02 WHERE saldo >= 800;
    SET cuentas_actualizadas = ROW_COUNT();

    IF cuentas_actualizadas = 0 THEN
        ROLLBACK;
        INSERT INTO log_transaccion(descripcion, data_operacion) VALUES('Ningúna cuenta aplica para interés. Ningún cambio realizado.', NOW());
    ELSE
        COMMIT; -- Supongo que el orden en este caso no es demasiado importante, ya que la gracia de los logs es que se efectuen fuera de la transacción (?).
        INSERT INTO log_transaccion(descripcion, data_operacion) VALUES (CONCAT('Interés aplicado a ', CAST(cuentas_actualizadas AS CHAR), ' cuentas.') , NOW());
    END IF;
END //

DELIMITER ;
CALL sp_aplicar_interes();

-- 4: Transacción con savepoint y log opcional
DROP PROCEDURE IF EXISTS sp_ingreso_cuenta_c;

DELIMITER //
CREATE PROCEDURE sp_ingreso_cuenta_c()
BEGIN
    DECLARE log_registrado INT;
    START TRANSACTION;

    UPDATE comptes SET saldo = saldo + 150 WHERE nom = 'Compte C';
    SAVEPOINT ingreso_cuenta_c; -- Si lo he entendido bien...

    INSERT INTO log_transaccion(descripcion, data_operacion) VALUES('Ingreso de 150 créditos a Compte C.', NOW());
    SET log_registrado = ROW_COUNT();
    IF log_registrado = 0 THEN
        ROLLBACK TO ingreso_cuenta_c;
    ELSE
        COMMIT;
    END IF;
END //

DELIMITER ;
CALL sp_ingreso_cuenta_c();

-- 5: Transferencia condicional con registro detallado
DROP PROCEDURE IF EXISTS sp_transferencia_CD;
DELIMITER //
CREATE PROCEDURE sp_transferencia_CD()
BEGIN
    DECLARE saldo_origen DECIMAL(10,2);
    DECLARE saldo_destino DECIMAL(10,2);
    DECLARE cuantia DECIMAL(10,2);

    START TRANSACTION;
    SET cuantia = 100;

    -- Planeaba hacerlo con IF saldo_origen - cuantia > 800 THEN, pero creo que no es la idea del ejercicio.
    UPDATE comptes SET saldo = saldo - cuantia WHERE nom = 'Compte C';
    UPDATE comptes SET saldo = saldo + cuantia WHERE nom = 'Compte D';

    SET saldo_origen = (SELECT saldo FROM comptes WHERE nom = 'Compte C');
    SET saldo_destino = (SELECT saldo FROM comptes WHERE nom = 'Compte D');

    IF saldo_origen > 800 THEN
        COMMIT;
        INSERT INTO log_transaccion (descripcion, data_operacion) VALUES ('Transferencia de 100 créditos de Compte C a Compte D efectuada.', NOW());
    ELSE
        ROLLBACK;
        INSERT INTO log_transaccion (descripcion, data_operacion) VALUES ('Transferencia cancelada, el saldo final es inferior a 800.', NOW());
    END IF;
END //

DELIMITER ;
CALL sp_transferencia_CD();

SELECT * FROM comptes;
SELECT * FROM log_transaccion;

-- UPDATE comptes SET saldo = saldo + 400 WHERE nom = 'Compte C';