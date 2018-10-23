/* base de datos para el sistema --- 2:03 pm - 21 / septiembre/ 2018*/

 CREATE TABLE IF NOT EXISTS usuario 
(
	id      INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	nombre    VARCHAR(50) NOT NULL,
	correo    VARCHAR(100) NOT NULL,
	password VARCHAR(255),
	role INT(10) DEFAULT 2,
	active TINYINT(1) DEFAULT 1,
	direccion VARCHAR(255),
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
	descripcion VARCHAR(255),
	id_categoria INT(255),
	FOREIGN KEY(id_categoria) REFERENCES categoria(id_categoria),
	precio INT(255) UNSIGNED NOT NULL,
	stock INT(255) UNSIGNED NOT NULL
);

CREATE TABLE IF NOT EXISTS factura
		(
			id_factura INT(255) PRIMARY KEY,
			id_cliente INT(255), 
			FOREIGN KEY(id_cliente) REFERENCES usuario(id),
			fecha_de_emision DATE
		);

CREATE TABLE IF NOT EXISTS detalle_producto 
		(
			id_detalle INT(255) PRIMARY KEY,
			id_factura INT(255),
			id_producto INT(255),
			FOREIGN KEY (id_factura) REFERENCES factura(id_factura),
			FOREIGN KEY (id_producto) REFERENCES producto(id_producto),
			cantidad_pedida INT(255) DEFAULT 1,
			precio_venta INT(255) UNSIGNED
		);

INSERT INTO `usuario` (`id`, `nombre`, `correo`, `password`, `role`, `direccion`, `creado_en`) VALUES
 (3, 'Concepcion Andaluz', 'concep@mail.com', NULL, 2, 'Calle Urdaneta cruce con paez', '2018-10-15 16:32:15'),
 (4, 'John Doe', 'johndux@oele.com', NULL, 2, 'Peltown High Town St 3', '2018-10-14 19:21:45'),
 (5, 'Ada Lovelace', 'ada@mail.com', NULL, 2, 'EEUU Texas, Missisipi', '2018-10-14 15:34:13'),
 (6, 'Robwert Mota', 'robwert1997@gmail.com', NULL, 2, 'Calle Colombia casa #48', '2018-10-13 21:40:42'),
 (7, 'Ramon Valdes', 'don@barriga.com', NULL, 2, 'Vecinda', '2018-10-13 21:11:09'),
 (8, 'Mariannys Rodriguez', 'marimari8@hotmail.com', NULL, 2, 'Calle Bolivar cruce con Jose antonio paez', '2018-10-13 17:55:38'),
 (9, 'Juana Cortez', 'juanitaroxi@gmail.com', NULL, 2, 'Barrio San Jose', '2018-10-13 21:03:19'),
 (10, 'Maria Cifuentes', 'mariacif123@gmail.com', NULL, 2, 'Barrio las Maravillas 2', '2018-10-13 17:54:54'),
 (11, 'Sabrina Cervantes', 'sabrinit4@mail.com', NULL, 2, 'Barrio Las Flecheras ', '2018-10-13 17:54:27'),
 (12, 'Hector Sandoval', 'hec123tor@mail.com', NULL, 2, 'Barrio La Morenera Sector 2', '2018-10-13 17:53:37'),
 (13, 'Ana Fernandez', 'anita99@mail.com', NULL, 2, 'Urbanizacion los cedros', '2018-10-13 17:53:07'),
 (14, 'Juan perez', 'juan@mail.com', NULL, 2, 'Girardo cruce con sanchez olivo', '2018-10-13 17:52:35');
