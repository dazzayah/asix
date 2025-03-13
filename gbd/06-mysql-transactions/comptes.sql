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

SELECT * FROM comptes;

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
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Saldo insuficiente';
    ELSE
        UPDATE comptes SET saldo = saldo - saldo_transferido WHERE id = 1;
        UPDATE comptes SET saldo = saldo + saldo_transferido WHERE id = 2;
        INSERT INTO log_transaccion(descripcion, data_operacion) VALUES (CONCAT('Transferencia realizada: ', CAST(saldo_transferido AS CHAR), ' créditos.'), NOW());
        COMMIT;
    END IF;
END //
DELIMITER ;

CALL sp_transferenciaLog();

UPDATE comptes SET saldo = 400 WHERE id = 1;
SELECT * FROM comptes;
SELECT * FROM log_transaccion;