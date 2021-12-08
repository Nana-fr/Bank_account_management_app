DROP DATABASE IF EXISTS banque_php;
CREATE DATABASE banque_php;
USE banque_php;
DROP USER IF EXISTS banquePHP;
CREATE USER 'banquePHP'@'localhost' IDENTIFIED BY 'root';
GRANT ALL PRIVILEGES ON banque_php.* TO 'banquePHP'@'localhost';

-- SET banque_php 'utf8';
CREATE TABLE Customers (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    login_customer VARCHAR(30),
    password_customer VARCHAR(20),
    street VARCHAR(50) NOT NULL,
    postcode INT NOT NULL,
    country VARCHAR(20) NOT NULL,
    phone_number INT NOT NULL,
    email VARCHAR(50),
    subscript_date DATE NOT NULL,
    PRIMARY KEY (id)
)
ENGINE=INNODB;