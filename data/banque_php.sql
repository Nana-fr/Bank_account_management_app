DROP DATABASE IF EXISTS banque_php;
CREATE DATABASE banque_php
CHARACTER SET utf8
COLLATE utf8_general_ci;

DROP USER IF EXISTS 'banquePHP'@'localhost';
CREATE USER 'banquePHP'@'localhost' IDENTIFIED BY 'banque76';
GRANT ALL PRIVILEGES ON banque_php.* TO 'banquePHP'@'localhost';
USE banque_php;

CREATE TABLE Customers (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    password_customer VARCHAR(20),
    street VARCHAR(50) NOT NULL,
    postcode INT NOT NULL,
    city VARCHAR(50) NOT NULL,
    country VARCHAR(20) NOT NULL,
    phone_number VARCHAR(14) NOT NULL,
    email VARCHAR(50),
    subscript_date DATE NOT NULL,
    PRIMARY KEY (id)
)
ENGINE=INNODB;

INSERT INTO Customers
VALUES (1, 'John', 'DOE', 'cochon', '20 rue de la paix', 75000, 'Paris', 'FRANCE', '06-26-26-26-26', 'littlepig@gmail.com', '2021-01-08'),
        (2, 'Jane', 'DOE', 'spider', '20 rue de la guerre', 76300, 'Sotteville-lès-Rouen', 'FRANCE', '06-06-06-06-06', 'gobankrupt@gmail.com', '2021-03-08');

CREATE TABLE Accounts_type (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    account_type_name VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
)
ENGINE=INNODB;

INSERT INTO Accounts_type
VALUES (1, 'Current account'),
        (2, 'Savings account'),
        (3, 'ISA');

CREATE TABLE Accounts (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    account_number INT NOT NULL,
    account_type_id INT UNSIGNED NOT NULL,
    customer_id INT UNSIGNED NOT NULL,
    balance DECIMAL NOT NULL,
    created_date Date NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_account_type_id
        FOREIGN KEY (account_type_id)
        REFERENCES Accounts_type(id),
    CONSTRAINT FK_customer_id
        FOREIGN KEY (customer_id)
        REFERENCES Customers(id)
)
ENGINE=INNODB;

INSERT INTO Accounts
VALUES (1, 123456789, 1, 1, 5000.00, '2021-01-08'),
        (2, 987456321, 2, 1, 30000.00, '2021-01-30'),
        (3, 321456987, 3, 1, 15000.00, '2021-02-03'),
        (4, 147852369, 1, 2, 350.00, '2021-03-08'),
        (5, 987456987, 2, 2, 19000.00, '2021-04-01');

CREATE TABLE Transactions (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    transaction_number INT NOT NULL,
    transaction_name VARCHAR(200) NOT NULL,
    transaction_description TEXT NULL,
    amount DECIMAL NOT NULL,
    transaction_type CHAR(1) NOT NULL,
    account_id INT UNSIGNED NOT NULL,
    transaction_date DATETIME NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_account_id
        FOREIGN KEY (account_id)
        REFERENCES Accounts(id)
)
ENGINE=INNODB;

INSERT INTO Transactions
VALUES (1, 96369, 'APPLE', NULL, 1199.99, '-', 1, '2021-05-03 17:34:22'),
        (2, 14741, 'PiggyBank', 'investment profit', 23.72, '+', 2, '2021-09-11 09:23:51'),
        (3, 85214, 'Withdrawal', NULL, 1500.00, '-', 1, '2021-09-15 10:54:41'),
        (4, 36985, 'Deposit', NULL, 500.00, '+', 3, '2021-09-16 12:14:03'),
        (5, 74125, 'Football pools', NULL, 1000.00, '-', 4, '2021-03-15 15:54:12'),
        (6, 98745, 'Deposit', NULL, 400.00, '+', 5, '2021-05-06 16:24:36');