SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='';

ALTER TABLE `Promotions` DROP FOREIGN KEY `fk_Promotions_Shops1` ;

ALTER TABLE `Promotions` DROP COLUMN `shop_id` , ADD COLUMN `account_id` INT(11) NOT NULL  AFTER `promotion_id` , ADD COLUMN `Accounts_id` INT(11) NOT NULL  AFTER `status` , 
  ADD CONSTRAINT `fk_Promotions_Accounts1`
  FOREIGN KEY (`Accounts_id` )
  REFERENCES `Accounts` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, DROP PRIMARY KEY 
, ADD PRIMARY KEY (`promotion_id`, `Accounts_id`) 
, ADD INDEX `fk_Promotions_Accounts1_idx` (`Accounts_id` ASC) 
, DROP INDEX `fk_Promotions_Shops1_idx` ;

ALTER TABLE `Accounts` DROP COLUMN `image` , DROP COLUMN `discription` , DROP COLUMN `phone_number` , ADD COLUMN `name` VARCHAR(45) NOT NULL  AFTER `account_type` ;

CREATE  TABLE IF NOT EXISTS `ShopInformations` (
  `id` INT(11) NOT NULL ,
  `accounts_id` INT(11) NOT NULL ,
  `sub_district` VARCHAR(45) NOT NULL ,
  `latituse` DECIMAL(12,10) NULL DEFAULT NULL ,
  `longitude` DECIMAL(12,10) NULL DEFAULT NULL ,
  `address` TEXT NULL DEFAULT NULL ,
  `open_time` TEXT NULL DEFAULT NULL ,
  `description` TEXT NULL DEFAULT NULL ,
  `image` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`, `accounts_id`) ,
  INDEX `fk_ShopInformations_Accounts1_idx` (`accounts_id` ASC) ,
  CONSTRAINT `fk_ShopInformations_Accounts1`
    FOREIGN KEY (`accounts_id` )
    REFERENCES `Accounts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

DROP TABLE IF EXISTS `Address` ;

DROP TABLE IF EXISTS `Shops` ;

DROP TABLE IF EXISTS `Locations` ;

DROP TABLE IF EXISTS `City` ;

DROP TABLE IF EXISTS `District` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
