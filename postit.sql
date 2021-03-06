

INSERT INTO users (username, pwhash) VALUES ("niels", "asdfasdfasdfasdfasdfasdfsd");



-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mul18
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mul18
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mul2018` DEFAULT CHARACTER SET utf8 ;
USE `mul2018` ;


DROP TABLE IF EXISTS postit;
DROP TABLE IF EXISTS color;

-- -----------------------------------------------------
-- Table `mul18`.`color`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mul2018`.`color` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `colorname` VARCHAR(45) NULL,
  `cssclass` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mul18`.`postit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mul2018`.`postit` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `createdate` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `author` VARCHAR(45) NULL,
  `headline` VARCHAR(45) NULL,
  `content` VARCHAR(100) NULL,
  `color_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_postit_color_idx` (`color_id` ASC),
  CONSTRAINT `fk_postit_color`
    FOREIGN KEY (`color_id`)
    REFERENCES `mul2018`.`color` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



-- Add color info to the color table
INSERT INTO color (colorname, cssclass) VALUES ('Yellow', 'postityellow');
INSERT INTO color (colorname, cssclass) VALUES ('Green', 'postitgreen');
INSERT INTO color (colorname, cssclass) VALUES ('Red', 'postitred');
INSERT INTO color (colorname, cssclass) VALUES ('Blue', 'postitblue');

-- Add a few test PostIt's
INSERT INTO postit (author, headline, content, color_id) 
VALUES ('Torben', 'Husk', 'Databaser er vigtige!!!', 4);
INSERT INTO postit (author, headline, content, color_id) 
VALUES ('Morten', 'Interface', 'Intet interface - ingen brugere', 4);


SELECT * FROM color;
SELECT * FROM postit;


-- SQL til valg af farve
SELECT id, colorname FROM color;


-- SQL til at slette postit
DELETE FROM postit WHERE id=1;
