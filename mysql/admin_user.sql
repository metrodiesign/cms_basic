-- MySQL Workbench Synchronization
-- Generated: 2018-08-18 11:34
-- Model: admin_user
-- Version: 1.0
-- Project: CMS BASIC
-- Author: Supachai

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE TABLE IF NOT EXISTS `cms_basic`.`admin_user` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `gender` ENUM('-', 'F', 'M') NOT NULL,
    `first_name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100) NOT NULL,
    `nickname` VARCHAR(100) NOT NULL,
    `telephone` VARCHAR(100) NOT NULL,
    `mobile` VARCHAR(100) NOT NULL,
    `birthday` DATE NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(250) NOT NULL,
    `salt` VARCHAR(250) NOT NULL,
    `avatar` VARCHAR(250) NOT NULL,
    `remember_code` VARCHAR(250) NOT NULL,
    `status` TINYINT(4) NOT NULL DEFAULT 0,
    `activate` TINYINT(4) NOT NULL DEFAULT 0,
    `activate_code` VARCHAR(250) NOT NULL,
    `activate_expire` VARCHAR(100) NOT NULL,
    `forgot_password_code` VARCHAR(250) NOT NULL,
    `forgot_password_expire` VARCHAR(100) NOT NULL,
    `token` VARCHAR(250) NOT NULL,
    `token_expire` VARCHAR(100) NOT NULL,
    `last_login` DATETIME NOT NULL,
    `login_ip_address` VARCHAR(100) NOT NULL,
    `login_attempts` TINYINT(4) NOT NULL DEFAULT 0,
    `create_datetime` DATETIME NOT NULL,
    `update_datetime` DATETIME NOT NULL,
    PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
