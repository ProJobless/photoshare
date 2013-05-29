SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `photosharedb` ;
CREATE SCHEMA IF NOT EXISTS `photosharedb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

-- -----------------------------------------------------
-- Table `photosharedb`.`members`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `photosharedb`.`members` ;

CREATE  TABLE IF NOT EXISTS `photosharedb`.`members` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(20) NOT NULL ,
  `password` VARCHAR(255) NOT NULL ,
  `email` VARCHAR(50) NOT NULL ,
  `first_name` VARCHAR(40) NOT NULL ,
  `last_name` VARCHAR(40) NOT NULL ,
  `date_created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  `active` TINYINT(1)  NULL DEFAULT 1 ,
  `admin` TINYINT(1)  NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `photosharedb`.`ci_sessions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `photosharedb`.`ci_sessions` ;

CREATE  TABLE IF NOT EXISTS `photosharedb`.`ci_sessions` (
  `session_id` VARCHAR(40) NOT NULL DEFAULT '0' ,
  `ip_address` VARCHAR(16) NOT NULL DEFAULT '0' ,
  `user_agent` VARCHAR(50) NOT NULL ,
  `last_activity` INT UNSIGNED NOT NULL DEFAULT 0 ,
  `user_data` TEXT NOT NULL ,
  PRIMARY KEY (`session_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
