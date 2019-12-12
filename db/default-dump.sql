
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;

INSERT INTO `admin` (`id`, `username`, `password`)
VALUES
	(1,'admin','N0rthCl1ffAdm1n@');

/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table m_timetable
# ------------------------------------------------------------

DROP TABLE IF EXISTS `m_timetable`;

CREATE TABLE `m_timetable` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `sdate` date NOT NULL,
  `sehri_end` time DEFAULT NULL,
  `fajr_athaan` time DEFAULT NULL,
  `fajr_salaah` time DEFAULT NULL,
  `sunrise` time DEFAULT NULL,
  `zuhr_athaan` time DEFAULT NULL,
  `zuhr_salaah` time DEFAULT NULL,
  `asr_athaan` time DEFAULT NULL,
  `asr_salaah` time DEFAULT NULL,
  `magrib_athaan` time DEFAULT NULL,
  `magrib_salaah` time DEFAULT NULL,
  `esha_athaan` time DEFAULT NULL,
  `esha_salaah` time DEFAULT NULL,
  `jummah_athaan` time DEFAULT '12:10:00',
  `jummah_salaah` time DEFAULT '12:45:00',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `sdate_UNIQUE` (`sdate`),
  UNIQUE KEY `uid_UNIQUE` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `m_timetable` WRITE;
/*!40000 ALTER TABLE `m_timetable` DISABLE KEYS */;


# Dump of table p_timetable
# ------------------------------------------------------------

DROP TABLE IF EXISTS `p_timetable`;

CREATE TABLE `p_timetable` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(2) DEFAULT NULL,
  `month` int(2) DEFAULT NULL,
  `sehri` time DEFAULT NULL,
  `fajr` time DEFAULT NULL,
  `sunrise` time DEFAULT NULL,
  `zawal` time DEFAULT NULL,
  `asr_s` time DEFAULT NULL,
  `asr_h` time DEFAULT NULL,
  `maghrib` time DEFAULT NULL,
  `esha` time DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
