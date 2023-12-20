CREATE DATABASE webemple;
USE webemple;

CREATE TABLE departamento
(cod_dpto      VARCHAR(4),
 nombre_dpto   VARCHAR(40)) ENGINE=InnoDB; 

CREATE TABLE empleado
(dni VARCHAR(9),
 nombre VARCHAR(40),
 apellidos VARCHAR(40),
 fecha_nac DATE,
 salario DOUBLE) ENGINE=InnoDB; 

CREATE TABLE emple_depart
(dni VARCHAR(9),
 cod_dpto   VARCHAR(4),
 fecha_ini  DATETIME,
 fecha_fin DATETIME) ENGINE=InnoDB;
 
ALTER TABLE departamento ADD CONSTRAINT pk_departamento 
PRIMARY KEY (cod_dpto); 

ALTER TABLE empleado ADD CONSTRAINT pk_empleado 
PRIMARY KEY (dni);

ALTER TABLE emple_depart ADD CONSTRAINT pk_emple_depart
PRIMARY KEY (dni,cod_dpto,fecha_ini);

ALTER TABLE emple_depart
ADD CONSTRAINT fk_empledepart_dni FOREIGN KEY (dni) 
REFERENCES empleado(dni);

ALTER TABLE emple_depart
ADD CONSTRAINT fk_empledepart_cd FOREIGN KEY (cod_dpto) 
REFERENCES departamento(cod_dpto);
