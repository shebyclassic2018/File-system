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
DROP DATABASE IF EXISTS `fs`;
CREATE DATABASE IF NOT EXISTS `fs` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `fs`;

-- Dumping structure for table fs.attachment
DROP TABLE IF EXISTS `attachment`;
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

-- Dumping data for table fs.attachment: ~5 rows (approximately)
/*!40000 ALTER TABLE `attachment` DISABLE KEYS */;
REPLACE INTO `attachment` (`id`, `name`, `size`, `type`, `doc_id`) VALUES
	(17, 'p.png', 536268, 'image/png', 8),
	(18, 'w.png', 815429, 'image/png', 9),
	(19, 'a.png', 694585, 'image/png', 10),
	(20, 'c.png', 1222, 'image/png', 11),
	(21, 'Chart(1).png', 51228, 'image/png', 12),
	(22, 'IMG_0299.JPG', 5974950, 'image/jpeg', 13);
/*!40000 ALTER TABLE `attachment` ENABLE KEYS */;

-- Dumping structure for table fs.certificate
DROP TABLE IF EXISTS `certificate`;
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table fs.certificate: ~4 rows (approximately)
/*!40000 ALTER TABLE `certificate` DISABLE KEYS */;
REPLACE INTO `certificate` (`cid`, `cert_name`, `type`, `size`, `status`, `cert_type`, `user_id`) VALUES
	(2, 'a.png', 'image', 57676, 'Approved', 'Birth', 1),
	(4, 'send.png', 'image', 65788700, 'Pending', 'NHIF', 2),
	(5, 't2.jpg', 'image', 65445, 'Approved', 'NHIF', 1),
	(6, 'send.png', 'image', 5435340, 'Approved', 'Advance Level', 1),
	(11, 'shake.png', 'image/png', 81064, 'Approved', 'Passport Size', 22),
	(12, '20190804_181447.jpg', 'image/jpeg', 1372690, 'Approved', 'Birth', 22),
	(13, 'train.png', 'image/png', 14578, 'Approved', 'Advanced level', 22),
	(14, 'hd-background-images-beautiful-background-hd-wallpapers-pulse-of-background-hd.jpg', 'image/jpeg', 224842, 'Rejected', 'Passport Size', 23),
	(15, 'p4.png', 'image/png', 469525, 'Approved', 'Birth', 23),
	(16, 'IMG_0421.JPG', 'image/jpeg', 5320050, 'Rejected', 'Advanced level', 23);
/*!40000 ALTER TABLE `certificate` ENABLE KEYS */;

-- Dumping structure for table fs.department
DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `abbr` varchar(10) NOT NULL DEFAULT '',
  `faculty_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faculty_id` (`faculty_id`),
  CONSTRAINT `department_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table fs.department: ~2 rows (approximately)
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
REPLACE INTO `department` (`id`, `name`, `abbr`, `faculty_id`) VALUES
	(1, 'Computing Science Studies', 'CSS', 1),
	(2, 'Mathematical Social Studies', 'MSS', 2),
	(3, 'Null', 'Null', 3);
/*!40000 ALTER TABLE `department` ENABLE KEYS */;

-- Dumping structure for table fs.designation
DROP TABLE IF EXISTS `designation`;
CREATE TABLE IF NOT EXISTS `designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table fs.designation: ~5 rows (approximately)
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
DROP TABLE IF EXISTS `docs`;
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

-- Dumping data for table fs.docs: ~5 rows (approximately)
/*!40000 ALTER TABLE `docs` DISABLE KEYS */;
REPLACE INTO `docs` (`id`, `subject`, `descript`, `created_at`, `status`, `file_id`) VALUES
	(8, 'Kughairisha masomo', '<p>hello</p>\r\n', '2021-06-11 06:24:09', 'Rejected', 6),
	(9, 'Naumwa Homa', '<p>kweli naumwa</p>\r\n', '2021-06-11 05:47:23', 'Waiting for approval', 7),
	(10, 'gvfhg', '<p>grgrgrgrg</p>\r\n', '2021-06-11 06:04:06', 'Waiting for approval', 7),
	(11, 'kunywa', '<p>kiume3eeeeeeeeeeeeeeeeee</p>\r\n', '2021-06-11 06:33:05', 'Rejected', 6),
	(12, 'Kuomba ruhusa', '<p>ruhusaaaaaaaaaaaaaaaaaaaaaa&nbsp; naombeni</p>\r\n', '2021-06-12 19:21:08', 'Rejected', 4),
	(13, 'Kuomba ruhusa', '<p>kugukgkuguyti</p>\r\n', '2021-06-13 03:00:04', 'Pending', 4);
/*!40000 ALTER TABLE `docs` ENABLE KEYS */;

-- Dumping structure for table fs.email
DROP TABLE IF EXISTS `email`;
CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `email_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fs.email: ~10 rows (approximately)
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
REPLACE INTO `email` (`id`, `address`, `user_id`) VALUES
	(1, 'student@gmail.com', 1),
	(2, 'custodian@gmail.com', 2),
	(3, 'hpashua@gmail.com', 3),
	(4, 'kiva@mu.com', 4),
	(5, 'zuwena@gmail.com', 10),
	(6, 'ashura@gmail.com', 11),
	(7, 'bedda@gmail.com', 12),
	(8, 'bk@gmail.com', 13),
	(9, 'sr@gmail.com', 14),
	(10, 'ba@gmail.com', 15),
	(11, 'sf@gmail.com', 16),
	(12, 'sf@gmail.com', 17),
	(13, 'hpashua@gmail.com', 18),
	(14, 'sf@gmail.com', 19),
	(15, 'sf@gmail.com', 20),
	(16, 'sf@gmail.com', 21),
	(17, 'sf@gmail.com', 22),
	(18, 'kiva@mu.com', 23);
/*!40000 ALTER TABLE `email` ENABLE KEYS */;

-- Dumping structure for table fs.faculty
DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `abbr` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table fs.faculty: ~2 rows (approximately)
/*!40000 ALTER TABLE `faculty` DISABLE KEYS */;
REPLACE INTO `faculty` (`id`, `name`, `abbr`) VALUES
	(1, 'Faculty of Science and Technology', 'FST'),
	(2, 'Faculty of Social Studies', 'FSS'),
	(3, 'Null', 'Null');
/*!40000 ALTER TABLE `faculty` ENABLE KEYS */;

-- Dumping structure for table fs.file
DROP TABLE IF EXISTS `file`;
CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `file_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fs.file: ~7 rows (approximately)
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
REPLACE INTO `file` (`id`, `type`, `created_at`, `user_id`) VALUES
	(4, 'open', '2021-06-11 04:55:39', 1),
	(6, 'open', '2021-06-11 05:01:33', 10),
	(7, 'open', '2021-06-11 05:45:02', 11),
	(8, 'open', '2021-06-12 19:38:26', 12),
	(9, 'open', '2021-06-12 20:44:35', 13),
	(10, 'open', '2021-06-12 20:49:13', 14),
	(11, 'open', '2021-06-12 20:50:27', 15),
	(12, 'open', '2021-06-13 00:00:06', 16),
	(13, 'open', '2021-06-13 00:03:45', 17),
	(14, 'open', '2021-06-13 02:13:44', 18),
	(15, 'open', '2021-06-13 02:15:55', 19),
	(16, 'open', '2021-06-13 02:16:45', 20),
	(17, 'open', '2021-06-13 02:17:32', 21),
	(18, 'open', '2021-06-13 02:20:29', 22),
	(19, 'open', '2021-06-13 02:36:29', 23);
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- Dumping structure for table fs.passport
DROP TABLE IF EXISTS `passport`;
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
DROP TABLE IF EXISTS `phone`;
CREATE TABLE IF NOT EXISTS `phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `phone_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fs.phone: ~10 rows (approximately)
/*!40000 ALTER TABLE `phone` DISABLE KEYS */;
REPLACE INTO `phone` (`id`, `number`, `user_id`) VALUES
	(1, '+255718800422', 1),
	(2, '0745681617', 2),
	(3, '0788667755', 3),
	(4, '0678667788', 4),
	(5, '0789776655', 10),
	(6, '0789654399', 11),
	(7, '0786553212', 12),
	(8, '0745681617', 13),
	(9, '0745681617', 14),
	(10, '+2554545676', 15),
	(11, '0718800422', 16),
	(12, '0718800422', 17),
	(13, '0745681617', 18),
	(14, '0745681617', 19),
	(15, '0745681617', 20),
	(16, '0745681617', 21),
	(17, '0745681617', 22),
	(18, '0745681617', 23);
/*!40000 ALTER TABLE `phone` ENABLE KEYS */;

-- Dumping structure for table fs.programme
DROP TABLE IF EXISTS `programme`;
CREATE TABLE IF NOT EXISTS `programme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0',
  `abbr` varchar(20) NOT NULL DEFAULT '0',
  `dep_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `dep_id` (`dep_id`),
  CONSTRAINT `programme_ibfk_1` FOREIGN KEY (`dep_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table fs.programme: ~2 rows (approximately)
/*!40000 ALTER TABLE `programme` DISABLE KEYS */;
REPLACE INTO `programme` (`id`, `title`, `abbr`, `dep_id`) VALUES
	(3, 'Bachelor of Information Technology and System', 'BSc.ITS', 1),
	(4, 'BAchelor of Information Communication Technology with Business', 'BSc.ICTB', 1),
	(5, 'Null', 'Null', 3);
/*!40000 ALTER TABLE `programme` ENABLE KEYS */;

-- Dumping structure for table fs.role
DROP TABLE IF EXISTS `role`;
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
DROP TABLE IF EXISTS `transfer`;
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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fs.transfer: ~5 rows (approximately)
/*!40000 ALTER TABLE `transfer` DISABLE KEYS */;
REPLACE INTO `transfer` (`id`, `sender`, `recipient`, `transferred_at`, `descript`, `status`, `dep_id`, `doc_id`) VALUES
	(58, 10, 7, '2021-06-11 06:27:06', '', 'Rejected', 1, 8),
	(60, 2, 7, '2021-06-11 05:47:23', 'Hello', 'Pending', 1, 9),
	(61, 2, 7, '2021-06-11 06:04:06', 'Hello', 'Pending', 1, 10),
	(62, 2, 7, '2021-06-11 06:33:05', '', 'Rejected', 1, 11),
	(63, 2, 7, '2021-06-12 19:21:08', '', 'Rejected', 1, 12);
/*!40000 ALTER TABLE `transfer` ENABLE KEYS */;

-- Dumping structure for table fs.user
DROP TABLE IF EXISTS `user`;
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fs.user: ~10 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `name`, `regno`, `dob`, `marital_status`, `sex`, `password`, `created_at`, `role_id`, `dep_id`, `prog_id`, `des_id`) VALUES
	(1, 'SHABANI H RAJABU', '13301257/T.18', '2021-05-18', 'single', 'M', '12345', '2021-05-28 04:26:58', 1, 1, 3, 12),
	(2, 'EDSON MWIJAGE', '13301256/T.19', '2021-05-19', 'married', 'M', '11111', '2021-05-28 04:27:00', 2, 1, 5, 12),
	(3, 'HAMADI PASHUA', '13301232/T.18', '2021-06-07', 'Married', 'M', '12345', '2021-06-07 21:02:45', 3, 1, 3, 7),
	(4, 'KIVARIA', '1345665', '2021-06-08', 'FBGFFG', 'M', '12345', '2021-06-08 03:27:17', 3, 1, 5, 8),
	(10, 'ZUWENA RAJABU', '13301232/T.18', '2021-06-11', 'Single', 'F', '12345', '2021-06-11 05:01:33', 1, 1, 4, 12),
	(11, 'ASHURA JUMA', '13301209/T.18', '2021-06-10', 'Single', 'F', '12345', '2021-06-11 05:45:02', 1, 1, 3, 12),
	(12, 'EMANNUEL BEDDA', '13301234/T.18', '2021-06-20', 'Single', 'M', '12345', '2021-06-12 19:38:26', 1, 1, 3, 12),
	(13, 'Bakari Abdul', '13301245/T.18', '2021-06-12', 'Single', 'M', '9090', '2021-06-12 20:44:35', 1, 1, 3, 12),
	(14, 'SHABANI RAJABU', '13301245/T.18', '2021-06-12', 'Single', 'M', '12345', '2021-06-12 20:49:13', 1, 1, 3, 12),
	(15, 'Bakari Abdul', '13301245/T.18', '2021-06-12', 'Single', 'M', '12345', '2021-06-12 20:50:27', 1, 1, 3, 12),
	(16, 'SHABANI Ghj', '13301245/T.18', '2021-06-23', 'Single', 'M', '12345', '2021-06-13 00:00:06', 1, 1, 3, 12),
	(17, 'SHABANI Ghj', '13301245/T.18', '2021-06-23', 'Single', 'M', '12345', '2021-06-13 00:03:45', 1, 1, 3, 12),
	(18, 'EMMANUEL RAJABU', '13301245/T.18', '2021-06-15', 'Married', 'M', '12345', '2021-06-13 02:13:44', 1, 1, 3, 12),
	(19, 'SHABANI RAJABU', '13301245/T.18', '2021-06-13', 'Married', 'M', '12345', '2021-06-13 02:15:55', 1, 1, 3, 12),
	(20, 'SHABANI RAJABU', '13301245/T.18', '2021-06-13', 'Married', 'M', '12345', '2021-06-13 02:16:45', 1, 1, 3, 12),
	(21, 'SHABANI RAJABU', '13301245/T.18', '2021-06-13', 'Married', 'M', '12345', '2021-06-13 02:17:32', 1, 1, 3, 12),
	(22, 'SHABANI Abdul', '13301245/T.18', '2021-06-14', 'Single', 'M', '12345', '2021-06-13 02:20:29', 1, 1, 3, 12),
	(23, 'Bakari Abdul', '13301245/T.18', '2021-06-14', 'Single', 'M', '12345', '2021-06-13 02:36:29', 1, 1, 3, 12);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
