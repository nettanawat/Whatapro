SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `WAP`.`Promotions` DROP FOREIGN KEY `fk_Promotions_Accounts1` ;

ALTER TABLE `WAP`.`Promotions` DROP COLUMN `account_id` , CHANGE COLUMN `Accounts_id` `accounts_id` INT(11) NOT NULL  AFTER `promotion_id` , 
  ADD CONSTRAINT `fk_Promotions_Accounts1`
  FOREIGN KEY (`accounts_id` )
  REFERENCES `WAP`.`Accounts` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
