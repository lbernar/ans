
SET NAMES 'UTF8';

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(255) DEFAULT NULL,
`email` varchar(40) DEFAULT NULL,
`password` varchar(40) DEFAULT NULL,
`phone` varchar(40) DEFAULT NULL,
`level` int(1) DEFAULT NULL,
`blood_type` varchar(3) DEFAULT NULL,
`register_date` VARCHAR(40) DEFAULT NULL,
`status` CHAR(1) DEFAULT NULL,
`last_page` INT(11) DEFAULT NULL,
`resp_date` VARCHAR(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
)CHARACTER SET 'UTF8';

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`quest_id` varchar(255) DEFAULT NULL,
`question` LONGTEXT,
`type_id` char(1) DEFAULT NULL,
`bu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
)CHARACTER SET 'UTF8';

DROP TABLE IF EXISTS `alternatives`;
CREATE TABLE `alternatives` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`alternative_id` varchar(255) DEFAULT NULL,
`quest_id` varchar(255) DEFAULT NULL,
`sub_class` varchar(255) DEFAULT NULL,
`response` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)CHARACTER SET 'UTF8';

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`class` varchar(255) DEFAULT NULL,
`sub_class` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)CHARACTER SET 'UTF8';

DROP TABLE IF EXISTS `business_unit`;
CREATE TABLE `business_unit` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)CHARACTER SET 'UTF8';

DROP TABLE IF EXISTS `type_questions`;
CREATE TABLE `type_questions` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`question_type` char(1) DEFAULT NULL,
`type_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)CHARACTER SET 'UTF8';
INSERT INTO `type_questions`(`question_type`,`type_desc`)
VALUES  ('P','Peso'),
        ('M','Múltipla Escolha'),
        ('S','Única Escolha');

DROP TABLE IF EXISTS `results`;
CREATE TABLE `results` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`alternative_id` varchar(11) DEFAULT NULL,
`quest_id` varchar(11) DEFAULT NULL,
`response` varchar(255) DEFAULT NULL,
`user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
)CHARACTER SET 'UTF8';

DROP TABLE IF EXISTS `status`;

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`ini_msg` LONGTEXT,
`final_msg` LONGTEXT,
  PRIMARY KEY (`id`)
)CHARACTER SET 'UTF8';
