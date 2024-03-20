-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema adresse
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `adresse` ;

-- -----------------------------------------------------
-- Schema adresse
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `adresse` DEFAULT CHARACTER SET utf8 ;
USE `adresse` ;

-- -----------------------------------------------------
-- Table `adresse`.`ort`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adresse`.`ort` (
  `ort_id` INT NOT NULL AUTO_INCREMENT,
  `ort_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ort_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `adresse`.`plz`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adresse`.`plz` (
  `plz_id` INT NOT NULL AUTO_INCREMENT,
  `plz_nr` INT NOT NULL,
  PRIMARY KEY (`plz_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `adresse`.`ort_plz`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adresse`.`ort_plz` (
  `orpl_id` INT NOT NULL AUTO_INCREMENT,
  `ort_id` INT NULL,
  `plz_id` INT NOT NULL,
  INDEX `fk_ort_has_plz_plz1_idx` (`plz_id` ASC) VISIBLE,
  INDEX `fk_ort_has_plz_ort_idx` (`ort_id` ASC) VISIBLE,
  PRIMARY KEY (`orpl_id`),
  CONSTRAINT `fk_ort_has_plz_ort`
    FOREIGN KEY (`ort_id`)
    REFERENCES `adresse`.`ort` (`ort_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ort_has_plz_plz1`
    FOREIGN KEY (`plz_id`)
    REFERENCES `adresse`.`plz` (`plz_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `adresse`.`strasse`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adresse`.`strasse` (
  `str_id` INT NOT NULL AUTO_INCREMENT,
  `str_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`str_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `adresse`.`strasse_ort_plz`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adresse`.`strasse_ort_plz` (
  `str_id` INT NOT NULL,
  `orpl_id` INT NOT NULL,
  PRIMARY KEY (`str_id`, `orpl_id`),
  INDEX `fk_strasse_has_ort_plz_ort_plz1_idx` (`orpl_id` ASC) VISIBLE,
  INDEX `fk_strasse_has_ort_plz_strasse1_idx` (`str_id` ASC) VISIBLE,
  CONSTRAINT `fk_strasse_has_ort_plz_strasse1`
    FOREIGN KEY (`str_id`)
    REFERENCES `adresse`.`strasse` (`str_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_strasse_has_ort_plz_ort_plz1`
    FOREIGN KEY (`orpl_id`)
    REFERENCES `adresse`.`ort_plz` (`orpl_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `adresse`.`person`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adresse`.`person` (
  `per_id` INT NOT NULL AUTO_INCREMENT,
  `per_vname` VARCHAR(45) NOT NULL,
  `per_nname` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`per_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `adresse`.`person_strasse_ort_plz`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adresse`.`person_strasse_ort_plz` (
  `per_id` INT NOT NULL,
  `str_id` INT NOT NULL,
  `orpl_id` INT NOT NULL,
  PRIMARY KEY (`per_id`, `str_id`, `orpl_id`),
  INDEX `fk_person_has_strasse_ort_plz_strasse_ort_plz1_idx` (`str_id` ASC, `orpl_id` ASC) VISIBLE,
  INDEX `fk_person_has_strasse_ort_plz_person1_idx` (`per_id` ASC) VISIBLE,
  CONSTRAINT `fk_person_has_strasse_ort_plz_person1`
    FOREIGN KEY (`per_id`)
    REFERENCES `adresse`.`person` (`per_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_has_strasse_ort_plz_strasse_ort_plz1`
    FOREIGN KEY (`str_id` , `orpl_id`)
    REFERENCES `adresse`.`strasse_ort_plz` (`str_id` , `orpl_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `adresse`.`ort`
-- -----------------------------------------------------
START TRANSACTION;
USE `adresse`;
INSERT INTO `adresse`.`ort` (`ort_id`, `ort_name`) VALUES (DEFAULT, 'Linz');
INSERT INTO `adresse`.`ort` (`ort_id`, `ort_name`) VALUES (DEFAULT, 'Wels');
INSERT INTO `adresse`.`ort` (`ort_id`, `ort_name`) VALUES (DEFAULT, 'Leonding');
INSERT INTO `adresse`.`ort` (`ort_id`, `ort_name`) VALUES (DEFAULT, 'Urfahr');

COMMIT;


-- -----------------------------------------------------
-- Data for table `adresse`.`plz`
-- -----------------------------------------------------
START TRANSACTION;
USE `adresse`;
INSERT INTO `adresse`.`plz` (`plz_id`, `plz_nr`) VALUES (DEFAULT, 4020);
INSERT INTO `adresse`.`plz` (`plz_id`, `plz_nr`) VALUES (DEFAULT, 4040);
INSERT INTO `adresse`.`plz` (`plz_id`, `plz_nr`) VALUES (DEFAULT, 4600);
INSERT INTO `adresse`.`plz` (`plz_id`, `plz_nr`) VALUES (DEFAULT, 4060);

COMMIT;


-- -----------------------------------------------------
-- Data for table `adresse`.`ort_plz`
-- -----------------------------------------------------
START TRANSACTION;
USE `adresse`;
INSERT INTO `adresse`.`ort_plz` (`orpl_id`, `ort_id`, `plz_id`) VALUES (DEFAULT, 1, 1);
INSERT INTO `adresse`.`ort_plz` (`orpl_id`, `ort_id`, `plz_id`) VALUES (DEFAULT, 3, 4);
INSERT INTO `adresse`.`ort_plz` (`orpl_id`, `ort_id`, `plz_id`) VALUES (DEFAULT, 4, 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `adresse`.`strasse`
-- -----------------------------------------------------
START TRANSACTION;
USE `adresse`;
INSERT INTO `adresse`.`strasse` (`str_id`, `str_name`) VALUES (DEFAULT, 'Wiener Straße');
INSERT INTO `adresse`.`strasse` (`str_id`, `str_name`) VALUES (DEFAULT, 'Eine-Gasse');
INSERT INTO `adresse`.`strasse` (`str_id`, `str_name`) VALUES (DEFAULT, 'Baumstraße');

COMMIT;


-- -----------------------------------------------------
-- Data for table `adresse`.`strasse_ort_plz`
-- -----------------------------------------------------
START TRANSACTION;
USE `adresse`;
INSERT INTO `adresse`.`strasse_ort_plz` (`str_id`, `orpl_id`) VALUES (2, 3);
INSERT INTO `adresse`.`strasse_ort_plz` (`str_id`, `orpl_id`) VALUES (1, 2);
INSERT INTO `adresse`.`strasse_ort_plz` (`str_id`, `orpl_id`) VALUES (3, 1);
INSERT INTO `adresse`.`strasse_ort_plz` (`str_id`, `orpl_id`) VALUES (2, 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `adresse`.`person`
-- -----------------------------------------------------
START TRANSACTION;
USE `adresse`;
INSERT INTO `adresse`.`person` (`per_id`, `per_vname`, `per_nname`) VALUES (DEFAULT, 'Maria', 'Huber');
INSERT INTO `adresse`.`person` (`per_id`, `per_vname`, `per_nname`) VALUES (DEFAULT, 'Christian', 'Schmidt');
INSERT INTO `adresse`.`person` (`per_id`, `per_vname`, `per_nname`) VALUES (DEFAULT, 'Erwin', 'Klausen');

COMMIT;


-- -----------------------------------------------------
-- Data for table `adresse`.`person_strasse_ort_plz`
-- -----------------------------------------------------
START TRANSACTION;
USE `adresse`;
INSERT INTO `adresse`.`person_strasse_ort_plz` (`per_id`, `str_id`, `orpl_id`) VALUES (1, 2, 3);
INSERT INTO `adresse`.`person_strasse_ort_plz` (`per_id`, `str_id`, `orpl_id`) VALUES (2, 1, 2);
INSERT INTO `adresse`.`person_strasse_ort_plz` (`per_id`, `str_id`, `orpl_id`) VALUES (3, 2, 2);

COMMIT;

