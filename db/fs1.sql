-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for fs
CREATE DATABASE IF NOT EXISTS `fs` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `fs`;

-- Dumping structure for table fs.attachment
CREATE TABLE IF NOT EXISTS `attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `size` float NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT '0',
  `doc_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `doc_id` (`doc_id`),
  CONSTRAINT `attachment_ibfk_1` FOREIGN KEY (`doc_id`) REFERENCES `docs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table fs.attachment: ~6 rows (approximately)
/*!40000 ALTER TABLE `attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachment` ENABLE KEYS */;

-- Dumping structure for table fs.certificate
CREATE TABLE IF NOT EXISTS `certificate` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cert_name` varchar(255) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT '0',
  `size` float NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `cert_type` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `certificate_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table fs.certificate: ~4 rows (approximately)
/*!40000 ALTER TABLE `certificate` DISABLE KEYS */;
REPLACE INTO `certificate` (`cid`, `cert_name`, `type`, `size`, `status`, `cert_type`, `user_id`) VALUES
	(4, 'send.png', 'image', 65788700, 'Pending', 'NHIF', 2),
	(17, 'g4.png', 'image/png', 394384, 'Pending', 'Passport Size', 30),
	(18, 'g5.png', 'image/png', 469525, 'Pending', 'Birth', 30),
	(19, 'g1.png', 'image/png', 702526, 'Pending', 'Advanced level', 30);
/*!40000 ALTER TABLE `certificate` ENABLE KEYS */;

-- Dumping structure for table fs.department
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `abbr` varchar(10) NOT NULL DEFAULT '',
  `faculty_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faculty_id` (`faculty_id`),
  CONSTRAINT `department_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table fs.department: ~3 rows (approximately)
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
REPLACE INTO `department` (`id`, `name`, `abbr`, `faculty_id`, `created_at`) VALUES
	(1, 'Computing Science Studies', 'CSS', 1, '2021-07-01 01:59:20'),
	(2, 'Mathematical Social Studies', 'MSS', 2, '2021-07-01 01:59:22'),
	(3, 'Null', 'Null', 3, '2021-07-01 01:59:23');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;

-- Dumping structure for table fs.designation
CREATE TABLE IF NOT EXISTS `designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table fs.designation: ~6 rows (approximately)
/*!40000 ALTER TABLE `designation` DISABLE KEYS */;
REPLACE INTO `designation` (`id`, `type`) VALUES
	(7, 'HoD'),
	(8, 'DVC'),
	(9, 'Lecture'),
	(10, 'Dean of student'),
	(11, 'Dean of faculty'),
	(12, 'Null');
/*!40000 ALTER TABLE `designation` ENABLE KEYS */;

-- Dumping structure for table fs.docs
CREATE TABLE IF NOT EXISTS `docs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `descript` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `file_id` (`file_id`),
  CONSTRAINT `docs_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fs.docs: ~6 rows (approximately)
/*!40000 ALTER TABLE `docs` DISABLE KEYS */;
/*!40000 ALTER TABLE `docs` ENABLE KEYS */;

-- Dumping structure for table fs.email
CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `address` (`address`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `email_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fs.email: ~9 rows (approximately)
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
REPLACE INTO `email` (`id`, `address`, `user_id`) VALUES
	(2, 'custodian@gmail.com', 2),
	(20, 'furaha@gmail.com', 25),
	(21, 'kingvidal@gmail.com', 26),
	(23, 'sc@gmail.com', 28),
	(24, 'je@gmail.com', 29),
	(25, 'student@gmail.com', 30);
/*!40000 ALTER TABLE `email` ENABLE KEYS */;

-- Dumping structure for table fs.faculty
CREATE TABLE IF NOT EXISTS `faculty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `abbr` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table fs.faculty: ~3 rows (approximately)
/*!40000 ALTER TABLE `faculty` DISABLE KEYS */;
REPLACE INTO `faculty` (`id`, `name`, `abbr`, `created_at`) VALUES
	(1, 'Faculty of Science and Technology', 'FST', '0000-00-00 00:00:00'),
	(2, 'Faculty of Social Studies', 'FSS', '0000-00-00 00:00:00'),
	(3, 'Null', 'Null', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `faculty` ENABLE KEYS */;

-- Dumping structure for table fs.file
CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `file_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fs.file: ~6 rows (approximately)
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
REPLACE INTO `file` (`id`, `type`, `created_at`, `user_id`) VALUES
	(20, 'open', '2021-07-01 15:48:05', 30);
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- Dumping structure for table fs.passport
CREATE TABLE IF NOT EXISTS `passport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `size` float DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `passport_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table fs.passport: ~0 rows (approximately)
/*!40000 ALTER TABLE `passport` DISABLE KEYS */;
/*!40000 ALTER TABLE `passport` ENABLE KEYS */;

-- Dumping structure for table fs.phone
CREATE TABLE IF NOT EXISTS `phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `phone_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fs.phone: ~10 rows (approximately)
/*!40000 ALTER TABLE `phone` DISABLE KEYS */;
REPLACE INTO `phone` (`id`, `number`, `user_id`) VALUES
	(2, '0745681619', 2),
	(20, '0768564543', 25),
	(21, '0745681617', 26),
	(23, '0768564544', 28),
	(24, '0756434566', 29),
	(25, '0768564540', 30);
/*!40000 ALTER TABLE `phone` ENABLE KEYS */;

-- Dumping structure for table fs.programme
CREATE TABLE IF NOT EXISTS `programme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0',
  `abbr` varchar(20) NOT NULL DEFAULT '0',
  `dep_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dep_id` (`dep_id`),
  CONSTRAINT `programme_ibfk_1` FOREIGN KEY (`dep_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table fs.programme: ~3 rows (approximately)
/*!40000 ALTER TABLE `programme` DISABLE KEYS */;
REPLACE INTO `programme` (`id`, `title`, `abbr`, `dep_id`, `created_at`) VALUES
	(3, 'Bachelor of Information Technology and System', 'BSc.ITS', 1, '2021-07-01 01:59:13'),
	(4, 'BAchelor of Information Communication Technology with Business', 'BSc.ICTB', 1, '2021-07-01 01:59:15'),
	(5, 'Null', 'Null', 3, '2021-07-01 01:59:16');
/*!40000 ALTER TABLE `programme` ENABLE KEYS */;

-- Dumping structure for table fs.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fs.role: ~4 rows (approximately)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
REPLACE INTO `role` (`id`, `role`) VALUES
	(1, 'student'),
	(2, 'custodian'),
	(3, 'staff'),
	(4, 'admin');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Dumping structure for table fs.transfer
CREATE TABLE IF NOT EXISTS `transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `transferred_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `descript` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `dep_id` int(11) DEFAULT NULL,
  `doc_id` int(11) DEFAULT '6',
  PRIMARY KEY (`id`),
  KEY `_to` (`recipient`),
  KEY `dep_id` (`dep_id`),
  KEY `doc_id` (`doc_id`),
  KEY `sender` (`sender`),
  CONSTRAINT `transfer_ibfk_2` FOREIGN KEY (`recipient`) REFERENCES `designation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transfer_ibfk_3` FOREIGN KEY (`dep_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transfer_ibfk_4` FOREIGN KEY (`doc_id`) REFERENCES `docs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transfer_ibfk_5` FOREIGN KEY (`sender`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fs.transfer: ~7 rows (approximately)
/*!40000 ALTER TABLE `transfer` DISABLE KEYS */;
/*!40000 ALTER TABLE `transfer` ENABLE KEYS */;

-- Dumping structure for table fs.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `regno` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `marital_status` varchar(50) NOT NULL,
  `sex` char(1) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `prog_id` int(11) DEFAULT NULL,
  `des_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`role_id`),
  KEY `dep_id` (`dep_id`),
  KEY `prog_id` (`prog_id`),
  KEY `des_id` (`des_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_3` FOREIGN KEY (`dep_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_4` FOREIGN KEY (`prog_id`) REFERENCES `programme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_5` FOREIGN KEY (`des_id`) REFERENCES `designation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fs.user: ~17 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `name`, `regno`, `dob`, `marital_status`, `sex`, `password`, `created_at`, `role_id`, `dep_id`, `prog_id`, `des_id`) VALUES
	(2, 'EDSON MWIJAGE', '13301256/T.19', '2021-05-19', 'married', 'M', '11111', '2021-05-28 04:27:00', 2, 1, 5, 12),
	(25, 'FURAHA M ISSA', '', '2021-07-02', 'Married', 'F', 'cust12345', '2021-07-01 14:45:50', 2, 3, 5, 12),
	(26, 'VICTOR L DAUDI', '', '2021-07-01', 'Single', 'M', 'cust12345', '2021-07-01 14:49:51', 4, 3, 5, 12),
	(28, 'SHABANI H ROGER', '', '2021-07-01', 'Single', 'M', 'cust12345', '2021-07-01 14:57:40', 4, 3, 5, 12),
	(29, 'JOSHUA E THABITI', '', '2021-07-01', 'Married', 'M', 'cust12345', '2021-07-01 15:40:21', 3, 1, 5, 7),
	(30, 'SHABANI RAJABU', '13301257/T.18', '2021-07-01', 'Single', 'M', '12345', '2021-07-01 15:48:05', 1, 1, 3, 12);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
