CREATE DATABASE registro;
USE registro;


-- CREACIÓN DE LA TABLA PERSONA --
CREATE TABLE persona
(
idpersona		INT AUTO_INCREMENT 	PRIMARY KEY,
nombres			VARCHAR(50)		NOT NULL,
apellidos		VARCHAR(50)		NOT NULL,
dni			CHAR(8)			UNIQUE NOT NULL,
fecha_nacimiento	DATE 			NOT NULL,
direccion		VARCHAR(60) 		NOT NULL,
ocupacion		VARCHAR(70) 		NOT NULL,
telefono		CHAR(9)			NOT NULL,
email			VARCHAR(120) 		NULL,
estado_civil		CHAR(1)			NOT NULL,
discapacidad		CHAR(1) 		NOT NULL DEFAULT 'N',
created_at 		DATETIME 		NOT NULL DEFAULT NOW(),
update_at		DATETIME 		NULL,
estado 			CHAR(1) 		NOT NULL DEFAULT '1'
)ENGINE = INNODB;

DROP TABLE persona
SELECT * FROM persona;

INSERT INTO persona (nombres, apellidos, dni, fecha_nacimiento, direccion, ocupacion, telefono, email, estado_civil, discapacidad) VALUES
	('Juana María', 'Ronceros Valenzuela', '82900198', '1994-05-10', 'Av. León #27 - Lima', 'Diseñadora Gráfica', '988098002', '', 'S', 'N'),
	('George', 'Marcos Reyes', '70912890', '2000-01-09', 'Jr 28 De Julio 148 AYACUCHO', 'Estudiante', '900127889', 'georgemarcosr@gmail.com', 'S', 'N'),
	('Marthina Josefa', 'García Díaz', '40921100', '1996-10-11', 'AV De La Poesia 160 LIMA', 'Docente', '900123889', 'marthinam10@gmail.com', 'S', 'Y'),
	('Treicy', 'Cahuana Aedo', '78902207', '1989-12-01', 'Plaza 30 de Agosto San Isidro LIMA', 'Ingeniera Civil', '912789667', 'treicycahuana38@gmail.com', 'C', 'N'),
	('Marthin Gustavo', 'De la Cruz Quiroz', '47890076', '1979-06-27', 'JR San Martin 475 Independencia', 'Obrero', '900278990', 'marthinquiroz123@gmail.com', 'V', 'N');
	


-- PROCEDIMIENTO ALMACENADO PARA LISTAR --
DELIMITER $$
CREATE PROCEDURE spu_listar_personas()
BEGIN
SELECT	idpersona,
	nombres,
	apellidos,
	dni,
	fecha_nacimiento,
	direccion,
	ocupacion,
	telefono,
	email,
	estado_civil,
	discapacidad
FROM persona
WHERE estado = '1'
ORDER BY idpersona ASC;
END $$
CALL spu_listar_personas();