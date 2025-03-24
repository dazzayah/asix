# Apuntes MySQL: Declaraciones y sintaxis 

Ficha de las distintas declaraciones que vamos probando en clase.

## Introducción
Analizaremos el lenguaje que utilizaremos para comunicarnos con el intérprete SQL de MariaDB.

## Comandos iniciales
### SHOW

Utilizado sobre los distintos elementos del GBD, como:
* Las bases de datos (DATABASES)
* Las tablas (TABLES)
````
SHOW DATABASES;
````

### USE

Utilizado para seleccionar una base de datos sobre la que trabajar:

````
USE DB_NAME;
````

### DROP
Utilizado para descartar distintos elementos presentes en el GBD:
* Las bases de datos (DATABASES)
* Las tablas (TABLES)
````
DROP DATABASE DB_NAME;
DROP TABLE TABLE_NAME;
````
