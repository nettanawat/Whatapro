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
  `role` VARCHAR(45) NOT NULL DEFAULT 'user' ,
  `join_date` DATETIME NULL ,
  `status` TINYINT(1) NOT NULL DEFAULT true ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`ShopInformations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`ShopInformations` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`ShopInformations` (
  `accounts_id` INT NOT NULL ,
  `name` VARCHAR(100) NULL ,
  `address` VARCHAR(250) NULL ,
  `phone_number` VARCHAR(45) NULL ,
  `sub_district` VARCHAR(45) NULL ,
  `latitude` DECIMAL(12,10) NULL ,
  `longitude` DECIMAL(12,10) NULL ,
  `open_time` TEXT NULL ,
  `description` TEXT NULL ,
  `category` VARCHAR(45) NULL ,
  PRIMARY KEY (`accounts_id`) ,
  INDEX `fk_ShopInformations_Accounts1_idx` (`accounts_id` ASC) ,
  CONSTRAINT `fk_ShopInformations_Accounts1`
    FOREIGN KEY (`accounts_id` )
    REFERENCES `WAP`.`Accounts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`Promotions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`Promotions` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`Promotions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `shop_id` INT NOT NULL ,
  `name` VARCHAR(60) NOT NULL ,
  `description` TEXT NULL ,
  `shared` INT NULL ,
  `start_date` DATETIME NOT NULL ,
  `end_date` DATETIME NOT NULL ,
  `status` TINYINT(1) NOT NULL DEFAULT true ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Promotions_ShopInformations1_idx` (`shop_id` ASC) ,
  CONSTRAINT `fk_Promotions_ShopInformations1`
    FOREIGN KEY (`shop_id` )
    REFERENCES `WAP`.`ShopInformations` (`accounts_id` )
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
  `request_date` DATETIME NULL ,
  `approve_date` DATETIME NULL ,
  `manage_by` INT NULL ,
  `status` TINYINT(1) NOT NULL DEFAULT false ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`Logs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`Logs` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`Logs` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `accounts_id` INT NOT NULL ,
  `method` VARCHAR(45) NULL ,
  `module` VARCHAR(45) NULL ,
  `detail` TEXT NULL ,
  `date` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Logs_Accounts2_idx` (`accounts_id` ASC) ,
  CONSTRAINT `fk_Logs_Accounts2`
    FOREIGN KEY (`accounts_id` )
    REFERENCES `WAP`.`Accounts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`ShopImage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`ShopImage` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`ShopImage` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `shop_id` INT NOT NULL ,
  `added_date` DATETIME NULL ,
  `image_path` VARCHAR(250) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ShopImage_ShopInformations1_idx` (`shop_id` ASC) ,
  CONSTRAINT `fk_ShopImage_ShopInformations1`
    FOREIGN KEY (`shop_id` )
    REFERENCES `WAP`.`ShopInformations` (`accounts_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`PromotionImage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`PromotionImage` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`PromotionImage` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `promotion_id` INT NOT NULL ,
  `image_path` VARCHAR(250) NULL ,
  `add_date` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_PromotionImage_Promotions1_idx` (`promotion_id` ASC) ,
  CONSTRAINT `fk_PromotionImage_Promotions1`
    FOREIGN KEY (`promotion_id` )
    REFERENCES `WAP`.`Promotions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`MobileUsers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`MobileUsers` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`MobileUsers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `facebook_id` VARCHAR(250) NULL ,
  `totalPoint` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`Codes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`Codes` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`Codes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `point_amount` INT NULL ,
  `code` VARCHAR(45) NULL ,
  `barcode_path` VARCHAR(100) NULL ,
  `generate_date` DATETIME NULL ,
  `status` TINYINT(1) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

USE `WAP` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
