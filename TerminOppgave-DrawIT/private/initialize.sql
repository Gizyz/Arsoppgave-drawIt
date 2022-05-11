CREATE DATABASE drawit;



CREATE TABLE `drawit`.`users` ( 
    `id` BIGINT NOT NULL AUTO_INCREMENT , 
    `url_address` VARCHAR(60) NOT NULL ,
    `name` VARCHAR(128) NOT NULL , 
    `username` VARCHAR(128) NOT NULL , 
    `email` VARCHAR(128) NOT NULL , 
    `password` VARCHAR(128) NOT NULL , 
    `date` DATETIME NOT NULL , 
    PRIMARY KEY (`id`)) 
ENGINE = InnoDB;