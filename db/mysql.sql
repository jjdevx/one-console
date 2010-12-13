SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `oneconsole` ;
CREATE SCHEMA IF NOT EXISTS `oneconsole` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `oneconsole` ;

-- -----------------------------------------------------
-- Table `oneconsole`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oneconsole`.`user` ;

CREATE  TABLE IF NOT EXISTS `oneconsole`.`user` (
  `user` VARCHAR(50) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `sshkey` TEXT NULL ,
  PRIMARY KEY (`user`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oneconsole`.`privileges`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oneconsole`.`privileges` ;

CREATE  TABLE IF NOT EXISTS `oneconsole`.`privileges` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oneconsole`.`user_privileges`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oneconsole`.`user_privileges` ;

CREATE  TABLE IF NOT EXISTS `oneconsole`.`user_privileges` (
  `user` VARCHAR(50) NOT NULL ,
  `id` INT NOT NULL ,
  PRIMARY KEY (`user`, `id`) ,
  INDEX `fk_user_has_privileges_privileges1` (`id` ASC) ,
  INDEX `fk_user_has_privileges_user` (`user` ASC) ,
  CONSTRAINT `fk_user_has_privileges_user`
    FOREIGN KEY (`user` )
    REFERENCES `oneconsole`.`user` (`user` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_privileges_privileges1`
    FOREIGN KEY (`id` )
    REFERENCES `oneconsole`.`privileges` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oneconsole`.`template`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oneconsole`.`template` ;

CREATE  TABLE IF NOT EXISTS `oneconsole`.`template` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `template` TEXT NOT NULL ,
  `user` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_template_user1` (`user` ASC) ,
  CONSTRAINT `fk_template_user1`
    FOREIGN KEY (`user` )
    REFERENCES `oneconsole`.`user` (`user` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `oneconsole`.`user`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `oneconsole`;
INSERT INTO `oneconsole`.`user` (`user`, `email`, `sshkey`) VALUES ('oneadmin', 'oneadmin@localhost', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `oneconsole`.`privileges`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `oneconsole`;
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (1, 'show_host');
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (2, 'show_network');
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (3, 'show_user');
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (4, 'edit_host');
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (5, 'edit_network');
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (6, 'edit_user');
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (7, 'create_host');
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (8, 'create_network');
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (9, 'create_user');
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (10, 'deploy_vm');
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (11, 'show_all_vm');
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (12, 'show_all_network');
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (13, 'upload_image');
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (14, 'edit_image');
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (15, 'create_template');
INSERT INTO `oneconsole`.`privileges` (`id`, `name`) VALUES (16, 'edit_template');

COMMIT;

-- -----------------------------------------------------
-- Data for table `oneconsole`.`user_privileges`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `oneconsole`;
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 1);
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 2);
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 3);
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 4);
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 5);
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 6);
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 7);
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 8);
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 9);
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 10);
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 11);
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 12);
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 13);
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 14);
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 15);
INSERT INTO `oneconsole`.`user_privileges` (`user`, `id`) VALUES ('oneadmin', 16);

COMMIT;
