SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `WAP`.`Accounts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`Accounts` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`Accounts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(45) NULL ,
  `password` VARCHAR(45) NULL ,
  `join_date` DATETIME NULL ,
  `account_type` INT NULL ,
  `status` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`District`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`District` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`District` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `city_id` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`City`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`City` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`City` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `province_id` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`Locations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`Locations` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`Locations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `shop_id` INT NULL ,
  `latitude` DECIMAL(12,10) NULL ,
  `longitude` DECIMAL(12,10) NULL ,
  `district` INT NULL ,
  `city` INT NULL ,
  `province` INT NULL ,
  `District_id` INT NOT NULL ,
  `City_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `District_id`, `City_id`) ,
  INDEX `fk_Locations_District1_idx` (`District_id` ASC) ,
  INDEX `fk_Locations_City1_idx` (`City_id` ASC) ,
  CONSTRAINT `fk_Locations_District1`
    FOREIGN KEY (`District_id` )
    REFERENCES `WAP`.`District` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Locations_City1`
    FOREIGN KEY (`City_id` )
    REFERENCES `WAP`.`City` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`Shops`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`Shops` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`Shops` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `description` TEXT NULL ,
  `phone_number` VARCHAR(45) NULL ,
  `telephone` VARCHAR(45) NULL ,
  `image` VARCHAR(45) NULL ,
  `Accounts_id` INT NOT NULL ,
  `Locations_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `Accounts_id`, `Locations_id`) ,
  INDEX `fk_Shops_Accounts_idx` (`Accounts_id` ASC) ,
  INDEX `fk_Shops_Locations1_idx` (`Locations_id` ASC) ,
  CONSTRAINT `fk_Shops_Accounts`
    FOREIGN KEY (`Accounts_id` )
    REFERENCES `WAP`.`Accounts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Shops_Locations1`
    FOREIGN KEY (`Locations_id` )
    REFERENCES `WAP`.`Locations` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`Promotions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`Promotions` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`Promotions` (
  `promotion_id` INT NOT NULL AUTO_INCREMENT ,
  `shop_id` INT NULL ,
  `name` VARCHAR(60) NOT NULL ,
  `description` TEXT NULL ,
  `img` VARCHAR(45) NULL ,
  `shared` INT NULL ,
  `start_date` DATETIME NOT NULL ,
  `end_date` DATETIME NOT NULL ,
  `status` ENUM('disable','enable') NULL ,
  PRIMARY KEY (`promotion_id`) ,
  INDEX `fk_Promotions_Shops1_idx` (`shop_id` ASC) ,
  CONSTRAINT `fk_Promotions_Shops1`
    FOREIGN KEY (`shop_id` )
    REFERENCES `WAP`.`Shops` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WAP`.`RequestingSignup`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WAP`.`RequestingSignup` ;

CREATE  TABLE IF NOT EXISTS `WAP`.`RequestingSignup` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `shop_name` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  `phone_number` VARCHAR(45) NULL ,
  `telephone` VARCHAR(45) NULL ,
  `commend` TEXT NULL ,
  `request_date` DATETIME NULL ,
  `approve_date` DATETIME NULL ,
  `manage_by` INT NULL ,
  `status` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
