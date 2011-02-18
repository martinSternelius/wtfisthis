-- Adminer 3.1.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `wtfisthis`;
CREATE DATABASE `wtfisthis` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `wtfisthis`;

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  `answer_text` text COLLATE utf8_swedish_ci NOT NULL,
  `published_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`answer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

INSERT INTO `answers` (`answer_id`, `question_id`, `name`, `answer_text`, `published_time`) VALUES
(1,	7,	'Sten-Åke',	'EN förtydling: jag ville bara se vilka som känner igen mig...',	'2011-02-09 14:38:12'),
(2,	7,	'Pelle Spam',	'Delicous Canned Spam!',	'2011-02-09 14:38:28'),
(3,	7,	'Pelle Spam',	'Delicous Canned Spam!',	'2011-02-09 14:38:29'),
(4,	7,	'Pelle Spam',	'Delicous Canned Spam!',	'2011-02-09 14:38:30'),
(5,	7,	'Pelle Spam',	'Delicous Canned Spam!',	'2011-02-09 14:38:31'),
(6,	7,	'Pelle Spam',	'Delicous Canned Spam!',	'2011-02-09 14:38:32'),
(7,	7,	'Pelle Spam',	'Delicous Canned Spam!',	'2011-02-09 14:38:33'),
(8,	7,	'Pelle Spam',	'Delicous Canned Spam!',	'2011-02-09 14:38:34'),
(9,	7,	'Pelle Spam',	'Delicous Canned Spam!',	'2011-02-09 14:38:35'),
(10,	7,	'Pelle Spam',	'Delicous Canned Spam!',	'2011-02-09 14:38:36'),
(11,	7,	'Pelle Spam',	'Delicous Canned Spam!',	'2011-02-09 14:38:37'),
(12,	7,	'Pelle Spam',	'Delicous Canned Spam!',	'2011-02-09 14:38:38'),
(13,	7,	'Sten-Åke',	'Sluta spamma min tråd!',	'2011-02-10 18:25:48'),
(14,	6,	NULL,	'Joker celebrates new year\'s eve.',	'2010-12-31 23:49:45'),
(15,	1,	'Joe Linker',	'jag tror du vill se http://www.thereistheoneandonlytruthoutthere.org/ishityounot/hereitis/1',	'2011-02-02 15:13:08'),
(16,	1,	NULL,	'we have some really good Supercalifragilisticexpialidocious Supercalifragilisticexpialidocious Supercalifragilisticexpialidocious Supercalifragilisticexpialidocious right there.',	'2011-02-05 15:43:08'),
(17,	4,	NULL,	'Enligt hemsidan \"Django is a high-level Python Web framework that encourages rapid development and clean, pragmatic design.\" Det är djangos logga.',	'2011-01-19 15:19:52'),
(18,	4,	NULL,	'kanske det? Något programspråkrelaterat iaf',	'2011-02-10 15:19:43'),
(19,	4,	NULL,	'Ser ut som en ponny enligt mig...',	'2011-02-12 15:19:31'),
(20,	4,	NULL,	'Knappast, det är en enhörning!',	'2011-02-17 10:58:13'),
(21,	4,	NULL,	'Jag tror det är Visual basic som har det som logotyp.',	'2011-02-15 15:19:22'),
(22,	4,	'Vicki Pedia',	'Django är ett ramverk för utveckling av webbsidor. Django är skrivet i Python. Det utvecklades ursprungligen för nyhetssidor och släpptes under BSD-licensen 2005. Namnet kommer av gitarristen Django Reinhardt. Syftet med Django är att göra det enklare att utveckla avancerade databas-drivna webbplatser. Det ska vara lätt att återanvända komponenter och det ska gå snabbt att skriva kod. Django genererar automatiskt administrations-gränssnitt utifrån data-modellen som anges i Python-kod.',	'2011-02-16 15:26:22');

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(160) COLLATE utf8_bin NOT NULL,
  `author` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `post_date` datetime DEFAULT NULL,
  `description` text COLLATE utf8_bin,
  `photo_id` bigint(11) NOT NULL,
  `thumbnail` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `medium` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `original` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `questions` (`id`, `title`, `description`, `photo_id`, `thumbnail`, `medium`, `original`) VALUES
(1,	'Vem är du?',	'Vad händer nu?',	5448394116,	NULL,	NULL,	NULL),
(2,	'Vad i allsin dagar pysslar de med?',	'Vad händer nu?!!',	5431368117,	NULL,	NULL,	NULL),
(3,	'Vad kan det här vara då?',	'Vad gör rosorna?',	5450522098,	NULL,	NULL,	NULL),
(4,	'Django?',	'Vad är django?',	5449919259,	NULL,	NULL,	NULL),
(5,	'Vilka böcker?',	'Hur kan de bara stå sådär mitt på bordet?',	5450530094,	NULL,	NULL,	NULL),
(6,	'Jag såg en man med grönt hår',	'Sjukt skumt! Hände precis!',	5450561566,	NULL,	NULL,	NULL),
(7,	'Vem är det här?',	'Sten-Åke undrar vad det här är bra för. Jag vet ju själv vem jag är...',	5450004171,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `testId` tinyint(4) NOT NULL AUTO_INCREMENT,
  `testString` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`testId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- 2011-02-17 11:04:24
