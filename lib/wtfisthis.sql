-- Adminer 3.1.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `wtfisthis`;
CREATE DATABASE `wtfisthis` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `wtfisthis`;

DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `testId` tinyint(4) NOT NULL AUTO_INCREMENT,
  `testString` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`testId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- 2011-02-14 11:12:43


DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(160) COLLATE utf8_bin NOT NULL,
	`description` text COLLATE utf8_bin,
	`photo_id` bigint(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `wtfisthis`.`questions` (
`id` ,
`title` ,
`description` ,
`photo_id`
)
VALUES (
NULL , 'Vem är du?', 'Vad händer nu?', '5448394116'
), (
NULL , 'Vad i allsin dagar pysslar de med?', 'Vad händer nu?!!', '5431368117'
), (
NULL , 'Vad kan det här vara då?', 'Vad gör rosorna?', '5450522098'
), (
NULL , 'Django?', 'Vad är django?', '5449919259'
), (
NULL , 'Vilka böcker?', 'Hur kan de bara stå sådär mitt på bordet?', '5450530094'
), (
NULL , 'Jag såg en man med grönt hår', 'Sjukt skumt! Hände precis!', '5450561566'
), (
NULL , 'Vem är det här?', 'Sten-Åke undrar vad det här är bra för. Jag vet ju själv vem jag är...', '5450004171'
);

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  `answer_text` text COLLATE utf8_swedish_ci NOT NULL,
  `published_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`answer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1 ;


INSERT INTO `wtfisthis`.`answers` (
`answer_id`, 
`question_id`, 
`name`, 
`answer_text`, 
`published_time`) 
VALUES 
(NULL, '7', 'Sten-Åke', 'EN förtydling: jag ville bara se vilka som känner igen mig...', '2011-02-09 14:38:12'),
(NULL, '7', 'Pelle Spam', 'Delicous Canned Spam!', '2011-02-09 14:38:28'), 
(NULL, '7', 'Pelle Spam', 'Delicous Canned Spam!', '2011-02-09 14:38:29'), 
(NULL, '7', 'Pelle Spam', 'Delicous Canned Spam!', '2011-02-09 14:38:30'), 
(NULL, '7', 'Pelle Spam', 'Delicous Canned Spam!', '2011-02-09 14:38:31'), 
(NULL, '7', 'Pelle Spam', 'Delicous Canned Spam!', '2011-02-09 14:38:32'), 
(NULL, '7', 'Pelle Spam', 'Delicous Canned Spam!', '2011-02-09 14:38:33'), 
(NULL, '7', 'Pelle Spam', 'Delicous Canned Spam!', '2011-02-09 14:38:34'), 
(NULL, '7', 'Pelle Spam', 'Delicous Canned Spam!', '2011-02-09 14:38:35'), 
(NULL, '7', 'Pelle Spam', 'Delicous Canned Spam!', '2011-02-09 14:38:36'), 
(NULL, '7', 'Pelle Spam', 'Delicous Canned Spam!', '2011-02-09 14:38:37'), 
(NULL, '7', 'Pelle Spam', 'Delicous Canned Spam!', '2011-02-09 14:38:38'),
(NULL, '7', 'Sten-Åke', 'Sluta spamma min tråd!', '2011-02-10 18:25:48');