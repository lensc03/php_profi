-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema rezept
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `rezept` ;

-- -----------------------------------------------------
-- Schema rezept
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `rezept` DEFAULT CHARACTER SET utf8 ;
USE `rezept` ;

-- -----------------------------------------------------
-- Table `rezept`.`rezeptname`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rezept`.`rezeptname` (
  `rez_id` INT NOT NULL AUTO_INCREMENT,
  `rez_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`rez_id`),
  UNIQUE INDEX `rez_name_UNIQUE` (`rez_name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rezept`.`zubereitung`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rezept`.`zubereitung` (
  `zub_id` INT NOT NULL AUTO_INCREMENT,
  `zub_beschreibung` VARCHAR(100) NOT NULL,
  `rez_id` INT NOT NULL,
  `zub_bereitgestellt_am` DATETIME NOT NULL,
  PRIMARY KEY (`zub_id`),
  INDEX `fk_zubereitung_rezeptname1_idx` (`rez_id` ASC) VISIBLE,
  CONSTRAINT `fk_zubereitung_rezeptname1`
    FOREIGN KEY (`rez_id`)
    REFERENCES `rezept`.`rezeptname` (`rez_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rezept`.`zutat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rezept`.`zutat` (
  `zut_id` INT NOT NULL AUTO_INCREMENT,
  `zut_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`zut_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rezept`.`einheit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rezept`.`einheit` (
  `ein_id` INT NOT NULL AUTO_INCREMENT,
  `ein_name` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`ein_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rezept`.`zutat_einheit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rezept`.`zutat_einheit` (
  `zuei_id` INT NOT NULL AUTO_INCREMENT,
  `zut_id` INT NOT NULL,
  `ein_id` INT NOT NULL,
  PRIMARY KEY (`zuei_id`),
  INDEX `fk_zutat_einheit_zutat1_idx` (`zut_id` ASC) VISIBLE,
  INDEX `fk_zutat_einheit_einheit1_idx` (`ein_id` ASC) VISIBLE,
  CONSTRAINT `fk_zutat_einheit_zutat1`
    FOREIGN KEY (`zut_id`)
    REFERENCES `rezept`.`zutat` (`zut_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_zutat_einheit_einheit1`
    FOREIGN KEY (`ein_id`)
    REFERENCES `rezept`.`einheit` (`ein_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rezept`.`zubereitung_einheit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rezept`.`zubereitung_einheit` (
  `zub_id` INT NOT NULL,
  `zuei_id` INT NOT NULL,
  `zubein_menge` INT NOT NULL,
  INDEX `fk_zubereitung_einheit_zubereitung_idx` (`zub_id` ASC) VISIBLE,
  INDEX `fk_zubereitung_einheit_zutat_einheit1_idx` (`zuei_id` ASC) VISIBLE,
  CONSTRAINT `fk_zubereitung_einheit_zubereitung`
    FOREIGN KEY (`zub_id`)
    REFERENCES `rezept`.`zubereitung` (`zub_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_zubereitung_einheit_zutat_einheit1`
    FOREIGN KEY (`zuei_id`)
    REFERENCES `rezept`.`zutat_einheit` (`zuei_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `rezept`.`rezeptname`
-- -----------------------------------------------------
START TRANSACTION;
USE `rezept`;
INSERT INTO `rezept`.`rezeptname` (`rez_id`, `rez_name`) VALUES (DEFAULT, 'Marmorkuchen');
INSERT INTO `rezept`.`rezeptname` (`rez_id`, `rez_name`) VALUES (DEFAULT, 'Schnitzerl');
INSERT INTO `rezept`.`rezeptname` (`rez_id`, `rez_name`) VALUES (DEFAULT, 'Wiener Schnitzerl');

COMMIT;


-- -----------------------------------------------------
-- Data for table `rezept`.`zubereitung`
-- -----------------------------------------------------
START TRANSACTION;
USE `rezept`;
INSERT INTO `rezept`.`zubereitung` (`zub_id`, `zub_beschreibung`, `rez_id`, `zub_bereitgestellt_am`) VALUES (DEFAULT, 'Mischen Sie alle Zutaten zu einem Teig', 1, '2021-05-14 12:10:25');
INSERT INTO `rezept`.`zubereitung` (`zub_id`, `zub_beschreibung`, `rez_id`, `zub_bereitgestellt_am`) VALUES (DEFAULT, 'Salzen, nicht Klopfen sondern drücken', 2, '2021-10-22 23:40:22');
INSERT INTO `rezept`.`zubereitung` (`zub_id`, `zub_beschreibung`, `rez_id`, `zub_bereitgestellt_am`) VALUES (DEFAULT, 'Verwenden Sie extra dünn geschnittene Filetschnitten', 3, '2022-01-10 16:15:05');
INSERT INTO `rezept`.`zubereitung` (`zub_id`, `zub_beschreibung`, `rez_id`, `zub_bereitgestellt_am`) VALUES (DEFAULT, 'Zuerst Eiklar steif schlagen, dann Mehl langsam untermischen usw', 1, '2022-05-06 10:05:01');

COMMIT;


-- -----------------------------------------------------
-- Data for table `rezept`.`zutat`
-- -----------------------------------------------------
START TRANSACTION;
USE `rezept`;
INSERT INTO `rezept`.`zutat` (`zut_id`, `zut_name`) VALUES (DEFAULT, 'Mehl');
INSERT INTO `rezept`.`zutat` (`zut_id`, `zut_name`) VALUES (DEFAULT, 'Eier');
INSERT INTO `rezept`.`zutat` (`zut_id`, `zut_name`) VALUES (DEFAULT, 'Salz');
INSERT INTO `rezept`.`zutat` (`zut_id`, `zut_name`) VALUES (DEFAULT, 'Kakaopulver');

COMMIT;


-- -----------------------------------------------------
-- Data for table `rezept`.`einheit`
-- -----------------------------------------------------
START TRANSACTION;
USE `rezept`;
INSERT INTO `rezept`.`einheit` (`ein_id`, `ein_name`) VALUES (DEFAULT, 'Prise');
INSERT INTO `rezept`.`einheit` (`ein_id`, `ein_name`) VALUES (DEFAULT, 'dag');
INSERT INTO `rezept`.`einheit` (`ein_id`, `ein_name`) VALUES (DEFAULT, 'Stück');
INSERT INTO `rezept`.`einheit` (`ein_id`, `ein_name`) VALUES (DEFAULT, 'kg');

COMMIT;


-- -----------------------------------------------------
-- Data for table `rezept`.`zutat_einheit`
-- -----------------------------------------------------
START TRANSACTION;
USE `rezept`;
INSERT INTO `rezept`.`zutat_einheit` (`zuei_id`, `zut_id`, `ein_id`) VALUES (DEFAULT, 1, 2);
INSERT INTO `rezept`.`zutat_einheit` (`zuei_id`, `zut_id`, `ein_id`) VALUES (DEFAULT, 1, 4);
INSERT INTO `rezept`.`zutat_einheit` (`zuei_id`, `zut_id`, `ein_id`) VALUES (DEFAULT, 2, 3);
INSERT INTO `rezept`.`zutat_einheit` (`zuei_id`, `zut_id`, `ein_id`) VALUES (DEFAULT, 3, 1);
INSERT INTO `rezept`.`zutat_einheit` (`zuei_id`, `zut_id`, `ein_id`) VALUES (DEFAULT, 4, 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `rezept`.`zubereitung_einheit`
-- -----------------------------------------------------
START TRANSACTION;
USE `rezept`;
INSERT INTO `rezept`.`zubereitung_einheit` (`zub_id`, `zuei_id`, `zubein_menge`) VALUES (1, 1, 50);
INSERT INTO `rezept`.`zubereitung_einheit` (`zub_id`, `zuei_id`, `zubein_menge`) VALUES (1, 3, 4);
INSERT INTO `rezept`.`zubereitung_einheit` (`zub_id`, `zuei_id`, `zubein_menge`) VALUES (1, 4, 1);
INSERT INTO `rezept`.`zubereitung_einheit` (`zub_id`, `zuei_id`, `zubein_menge`) VALUES (1, 5, 20);
INSERT INTO `rezept`.`zubereitung_einheit` (`zub_id`, `zuei_id`, `zubein_menge`) VALUES (2, 1, 20);
INSERT INTO `rezept`.`zubereitung_einheit` (`zub_id`, `zuei_id`, `zubein_menge`) VALUES (2, 3, 2);
INSERT INTO `rezept`.`zubereitung_einheit` (`zub_id`, `zuei_id`, `zubein_menge`) VALUES (2, 4, 3);
INSERT INTO `rezept`.`zubereitung_einheit` (`zub_id`, `zuei_id`, `zubein_menge`) VALUES (3, 1, 20);
INSERT INTO `rezept`.`zubereitung_einheit` (`zub_id`, `zuei_id`, `zubein_menge`) VALUES (4, 4, 1);
INSERT INTO `rezept`.`zubereitung_einheit` (`zub_id`, `zuei_id`, `zubein_menge`) VALUES (4, 5, 25);
INSERT INTO `rezept`.`zubereitung_einheit` (`zub_id`, `zuei_id`, `zubein_menge`) VALUES (4, 1, 75);

COMMIT;

