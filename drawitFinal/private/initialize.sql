-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema test
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema test
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `drawItDb`;
USE `drawItDb`;

-- -----------------------------------------------------
-- Table `drawItDb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `drawItDb`.`users` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `url_address` VARCHAR(60) NULL,
  `name` VARCHAR(128) NULL,
  `username` VARCHAR(128) NULL,
  `email` VARCHAR(128) NULL,
  `password` VARCHAR(128) NULL,
  `date` DATETIME NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `drawItDb`.`images`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `drawItDb`.`images` (
  `image_id` INT NOT NULL AUTO_INCREMENT,
  `url_address` VARCHAR(60) NULL,
  `img_name` VARCHAR(255) NULL,
  `date` DATETIME NULL,
  PRIMARY KEY (`image_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `drawItDb`.`users_has_images`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `drawItDb`.`users_has_images` (
  `user_id` INT NOT NULL,
  `image_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `image_id`),
  INDEX `fk_users_has_images_images1_idx` (`image_id` ASC),
  INDEX `fk_users_has_images_users_idx` (`user_id` ASC),
  CONSTRAINT `fk_users_has_images_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `drawItDb`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_images_images1`
    FOREIGN KEY (`image_id`)
    REFERENCES `drawItDb`.`images` (`image_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `drawItDb`.`tickets`
-- -----------------------------------------------------

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `msg` text NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
