DROP SCHEMA IF EXISTS `shai-abai`;
CREATE SCHEMA `shai-abai` DEFAULT CHARACTER SET utf8;
USE `shai-abai`;

CREATE TABLE IF NOT EXISTS `shai-abai`.`users` (
  `userId` INT NOT NULL AUTO_INCREMENT,
  `userEmail` VARCHAR(64) NOT NULL,
  `userName` VARCHAR(30) NOT NULL,
  `userPass` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`userId`))
ENGINE = InnoDB
AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS `shai-abai`.`reviews` (
  `revId` INT NOT NULL AUTO_INCREMENT,
  `revUserId` INT NOT NULL,
  `revText` VARCHAR(400) NOT NULL,
  PRIMARY KEY (`revId`),
  INDEX `fk_reviews_users_idx` (`revUserId` ASC),
  CONSTRAINT `fk_reviews_users`
    FOREIGN KEY (`revUserId`)
    REFERENCES `shai-abai`.`users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1;

INSERT INTO `users` VALUES
(1, "email@mail.com", "Oleg", "550e1bafe077ff0b0b67f4e32f29d751"),
(2, "email2@mail.com", "Svinota1488", "550e1bafe077ff0b0b67f4e32f29d751");

INSERT INTO `reviews` VALUES
(1, 1, "I want to pre-order this shit man))))))fdasfasdfafasdfsasdfasd hd hdhfg dhg hd fgdhg fdhg f"),
(2, 2, "Where is my fcking tea dude?");