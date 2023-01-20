CREATE DATABASE prumo_tech;

CREATE TABLE prumo_tech.`enterprises` ( 
    `enterprise_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `cnpj` varchar(255) NOT NULL, 
    `social_reason` varchar(255) NOT NULL, 
    `social_capital` varchar(255) NOT NULL, 
    `port_description` varchar(255) NOT NULL, 
    `address` varchar(255) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;