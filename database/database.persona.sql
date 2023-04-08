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

-- PROCEDIMIENTO ALMACENADO PARA REGISTRAR PERSONA --
DELIMITER $$
CREATE PROCEDURE spu_registrar_persona
(
IN _nombres		VARCHAR(50),
IN _apellidos		VARCHAR(50),
IN _dni			CHAR(8),
IN _fecha_nacimiento	DATE,
IN _direccion		VARCHAR(60),
IN _ocupacion		VARCHAR(70),
IN _telefono		CHAR(9),
IN _email		VARCHAR(120),
IN _estado_civil	CHAR(1),
IN _discapacidad	CHAR(1)
)
BEGIN
	INSERT INTO persona(nombres, apellidos, dni, fecha_nacimiento, direccion, ocupacion, telefono, email, estado_civil, discapacidad)
	VALUES (_nombres, _apellidos, _dni, _fecha_nacimiento, _direccion, _ocupacion, _telefono, _email, _estado_civil, _discapacidad);
END$$ 
CALL spu_registrar_persona('Mariana','Castilla Lévano','90234019','2000-06-21','Jorge Basadre 498, Lima 27', 'Estudiante', '988021119', 'mariana@gmail.com', 'S','N');


-- PROCEDIMIENTO ALMACENADO PARA ELIMINAR PERSONA --
DELIMITER $$
CREATE PROCEDURE spu_eliminar_persona(IN _idpersona INT)
BEGIN
	UPDATE persona 
	SET estado = '0' 
	WHERE idpersona = _idpersona;
END $$

CALL spu_eliminar_persona();
SELECT * FROM persona;

-- PROCEDIMIENTO ALMACENADO PARA MODIFICAR PERSONA -- 
DELIMITER $$
CREATE PROCEDURE spu_modificar_persona(
IN _idpersona		INT,
IN _nombres		VARCHAR(50),
IN _apellidos		VARCHAR(50),
IN _dni			CHAR(8),
IN _fecha_nacimiento	DATE,
IN _direccion		VARCHAR(60),
IN _ocupacion		VARCHAR(70),
IN _telefono		CHAR(9),
IN _email		VARCHAR(120),
IN _estado_civil	CHAR(1),
IN _discapacidad	CHAR(1)
)
BEGIN
	UPDATE persona SET
	nombres 	= _nombres,
	apellidos 	=_apellidos,
	dni 		= _dni,
	fecha_nacimiento = _fecha_nacimiento,
	direccion 	= _direccion,
	ocupacion 	= _ocupacion,
	telefono 	= _telefono,
	email		= _email,
	estado_civil 	= _estado_civil,
	discapacidad 	= _discapacidad
	WHERE idpersona = _idpersona;
END $$
CALL spu_modificar_persona(6,'Sofia','Castilla Lévano','90234019','2000-06-21','Jorge Basadre 498, Lima 27', 'Estudiante', '988021119', 'mariana@gmail.com', 'S','N');

