SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `WAP` ;
CREATE SCHEMA IF NOT EXISTS `WAP` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `WAP` ;

-- -----------------------------------------------------
-- Table `WAP`.`Accounts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`Accounts` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`Accounts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `account_type` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `join_date` DATE NULL ,
  `status` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`Promotions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`Promotions` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`Promotions` (
  `promotion_id` INT NOT NULL AUTO_INCREMENT ,
  `accounts_id` INT NOT NULL ,
  `name` VARCHAR(60) NOT NULL ,
  `description` TEXT NULL ,
  `img` VARCHAR(45) NULL ,
  `shared` INT NULL ,
  `start_date` DATE NOT NULL ,
  `end_date` DATE NOT NULL ,
  `status` ENUM('disable','enable') NULL ,
  PRIMARY KEY (`promotion_id`, `accounts_id`) ,
  INDEX `fk_Promotions_Accounts1_idx` (`accounts_id` ASC) ,
  CONSTRAINT `fk_Promotions_Accounts1`
    FOREIGN KEY (`accounts_id` )
    REFERENCES `WAP`.`Accounts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`RequestingSignup`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`RequestingSignup` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`RequestingSignup` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(45) NULL ,
  `password` VARCHAR(45) NULL ,
  `name` VARCHAR(45) NULL ,
  `phone_number` VARCHAR(45) NULL ,
  `sub_district` VARCHAR(45) NULL ,
  `latitude` DECIMAL(12,10) NULL ,
  `longtitude` DECIMAL(12,10) NULL ,
  `address` TEXT NULL ,
  `open_time` TEXT NULL ,
  `description` TEXT NULL ,
  `image` TEXT NULL ,
  `request_date` DATE NULL ,
  `approve_date` DATE NULL ,
  `manage_by` INT NULL ,
  `status` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`ShopInformations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`ShopInformations` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`ShopInformations` (
  `id` INT NOT NULL ,
  `accounts_id` INT NOT NULL ,
  `phone_number` VARCHAR(45) NULL ,
  `sub_district` VARCHAR(45) NOT NULL ,
  `latitude` DECIMAL(12,10) NULL ,
  `longitude` DECIMAL(12,10) NULL ,
  `address` TEXT NULL ,
  `open_time` TEXT NULL ,
  `description` TEXT NULL ,
  `image` TEXT NULL ,
  PRIMARY KEY (`id`, `accounts_id`) ,
  INDEX `fk_ShopInformations_Accounts1_idx` (`accounts_id` ASC) ,
  CONSTRAINT `fk_ShopInformations_Accounts1`
    FOREIGN KEY (`accounts_id` )
    REFERENCES `WAP`.`Accounts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`Logs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`Logs` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`Logs` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` TEXT NULL ,
  `action` VARCHAR(45) NULL ,
  `action_detail` TEXT NULL ,
  `date` DATE NULL ,
  `account_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `account_id`) ,
  INDEX `fk_Logs_Accounts1_idx` (`account_id` ASC) ,
  CONSTRAINT `fk_Logs_Accounts1`
    FOREIGN KEY (`account_id` )
    REFERENCES `WAP`.`Accounts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `WAP` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
