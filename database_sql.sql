/* base de datos para el sistema --- 2:03 pm - 21 / septiembre/ 2018*/

 CREATE TABLE IF NOT EXISTS user 
(
	id      INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name    VARCHAR(50) NOT NULL,
	email    VARCHAR(100) NOT NULL,
	password VARCHAR(255),
	role INT(10) DEFAULT 1,
	state TINYINT(1) DEFAULT 1,
	updated_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS customer (
	id      INT(255) AUTO_INCREMENT PRIMARY KEY,
	dni VARCHAR(255) NOT NULL,
	dni_type ENUM('V','E'),
	first_name    VARCHAR(255) NOT NULL,
	sur_name VARCHAR(255) NOT NULL,
	email    VARCHAR(255) NOT NULL,
	country VARCHAR(255),
	sex ENUM('M','F'),
	birthdate DATE NOT NULL,
	state TINYINT(1) DEFAULT 1,
	address VARCHAR(255),
	updated_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS category
(
	id_category INT(255) PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	description VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS product 
(
	id_product INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
	product_code VARCHAR(255) NOT NULL,
	name VARCHAR(255) NOT NULL,
	descripcion VARCHAR(255),
	id_category INT(255),
	FOREIGN KEY(id_category) REFERENCES category(id_category),
	prize INT(255) UNSIGNED NOT NULL,
	stock INT(255) UNSIGNED NOT NULL
);

CREATE TABLE IF NOT EXISTS invoice
		(
			id_invoice INT(255) PRIMARY KEY,
			id_customer INT(255), 
			FOREIGN KEY(id_customer) REFERENCES customer(id),
			emision_date DATE
		);

CREATE TABLE IF NOT EXISTS product_detail 
		(
			id_detail INT(255) PRIMARY KEY,
			id_invoice INT(255),
			id_product INT(255),
			FOREIGN KEY (id_invoice) REFERENCES invoice(id_invoice),
			FOREIGN KEY (id_product) REFERENCES product(id_product),
			quantity INT(255) DEFAULT 1,
			sell_prize INT(255) UNSIGNED
		);
