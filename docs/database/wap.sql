SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `Accounts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Accounts` ;

CREATE  TABLE IF NOT EXISTS `Accounts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `account_type` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `join_date` DATETIME NULL ,
  `status` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Promotions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Promotions` ;

CREATE  TABLE IF NOT EXISTS `Promotions` (
  `promotion_id` INT NOT NULL AUTO_INCREMENT ,
  `accounts_id` INT NOT NULL ,
  `name` VARCHAR(60) NOT NULL ,
  `description` TEXT NULL ,
  `img` VARCHAR(45) NULL ,
  `shared` INT NULL ,
  `start_date` DATETIME NOT NULL ,
  `end_date` DATETIME NOT NULL ,
  `status` ENUM('disable','enable') NULL ,
  PRIMARY KEY (`promotion_id`, `accounts_id`) ,
  CONSTRAINT `fk_Promotions_Accounts1`
    FOREIGN KEY (`accounts_id` )
    REFERENCES `Accounts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Promotions_Accounts1_idx` ON `Promotions` (`accounts_id` ASC) ;


-- -----------------------------------------------------
-- Table `RequestingSignup`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RequestingSignup` ;

CREATE  TABLE IF NOT EXISTS `RequestingSignup` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(45) NULL ,
  `password` VARCHAR(45) NULL ,
  `name` VARCHAR(45) NULL ,
  `phone_number` VARCHAR(45) NULL ,
  `sub_district` VARCHAR(45) NULL ,
  `latitude` DECIMAL(12,10) NULL ,
  `longtitude` DECIMAL(12,10) NULL ,
  `open_time` TEXT NULL ,
  `description` TEXT NULL ,
  `image` TEXT NULL ,
  `request_date` DATE NULL COMMENT '	' ,
  `approve_date` DATE NULL ,
  `manage_by` INT NULL ,
  `status` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ShopInformations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ShopInformations` ;

CREATE  TABLE IF NOT EXISTS `ShopInformations` (
  `id` INT NOT NULL ,
  `accounts_id` INT NOT NULL ,
  `phone_number` VARCHAR(45) NULL ,
  `sub_district` VARCHAR(45) NOT NULL ,
  `latitude` DECIMAL(12,10) NULL ,
  `longitude` DECIMAL(12,10) NULL ,
  `open_time` TEXT NULL ,
  `description` TEXT NULL ,
  `image` TEXT NULL ,
  PRIMARY KEY (`id`, `accounts_id`) ,
  CONSTRAINT `fk_ShopInformations_Accounts1`
    FOREIGN KEY (`accounts_id` )
    REFERENCES `Accounts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_ShopInformations_Accounts1_idx` ON `ShopInformations` (`accounts_id` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
