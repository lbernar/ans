
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(255) DEFAULT NULL,
`email` varchar(40) DEFAULT NULL,
`password` varchar(40) DEFAULT NULL,
`phone` varchar(40) DEFAULT NULL,
`level` int(1) DEFAULT NULL,
`blood_type` varchar(3) DEFAULT NULL,
`status` char(1) DEFAULT NULL,
`last_question` int(11) DEFAULT NULL,
`resp_date` VARCHAR(40) DEFAULT NULL,
`register_date` VARCHAR(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
)CHARACTER SET 'UTF8';

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`quest_id` varchar(255) DEFAULT NULL,
`question` LONGTEXT,
`type` char(1) DEFAULT NULL,
`bu` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
)CHARACTER SET 'UTF8';

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`resp_id` varchar(255) DEFAULT NULL,
`quest_id` varchar(255) DEFAULT NULL,
`response` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)CHARACTER SET 'UTF8';


DROP TABLE IF EXISTS `results`;
CREATE TABLE `results` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`resp_id` varchar(255) DEFAULT NULL,
`quest_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)CHARACTER SET 'UTF8';

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`ini_text` LONGTEXT,
`final_text` LONGTEXT,
  PRIMARY KEY (`id`)
)CHARACTER SET 'UTF8';
