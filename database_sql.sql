/* base de datos para el sistema --- 2:03 pm - 21 / septiembre/ 2018*/

 CREATE TABLE IF NOT EXISTS cliente 
 		(
			id_cliente       INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			nombre    VARCHAR(50) NOT NULL,
			telefono  INT(20) NOT NULL,
			correo    VARCHAR(100) NOT NULL,
			fecha_nacimiento DATE NOT NULL,
			sexo      CHAR(1) DEFAULT 'm', /* m o f*/
			direccion VARCHAR(255) NOT NULL,
			creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
 		);

CREATE TABLE IF NOT EXISTS vendedor
		(
			id_vendedor       INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			nombre    VARCHAR(50) NOT NULL,
			telefono  INT(20) NOT NULL,
			correo    VARCHAR(100) NOT NULL,
			fecha_nacimiento DATE NOT NULL,
			sexo      CHAR(1) NOT NULL,
			rol INT(5),
			direccion VARCHAR(255) NOT NULL,
			creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		);




CREATE TABLE IF NOT EXISTS categoria
		(
			id_categoria INT(255) PRIMARY KEY AUTO_INCREMENT,
			nombre VARCHAR(255) NOT NULL,
			descripcion VARCHAR(255) NOT NULL
		);

CREATE TABLE IF NOT EXISTS producto 
(
	id_producto INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
	nombre VARCHAR(255) NOT NULL,
	id_categoria INT(255),
	FOREIGN KEY(id_categoria) REFERENCES categoria(id_categoria),
	precio INT(255) NOT NULL,
	stock INT(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS factura
		(
			id_factura INT(255) PRIMARY KEY,
			id_cliente INT(255), 
			FOREIGN KEY(id_cliente) REFERENCES cliente(id_cliente),
			fecha_de_emision DATE
		);
CREATE TABLE IF NOT EXISTS detalle_producto 
		(
			id_detalle INT(255) PRIMARY KEY,
			id_cliente INT(255),
			id_factura INT(255),
			id_producto INT(255),
			FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente),
			FOREIGN KEY (id_factura) REFERENCES factura(id_factura),
			FOREIGN KEY (id_producto) REFERENCES producto(id_producto),
			cantidad INT(255) DEFAULT 1,
			precio INT(255)
		);

