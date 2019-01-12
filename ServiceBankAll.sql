-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.37-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for pro_activity
CREATE DATABASE IF NOT EXISTS `pro_activity` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `pro_activity`;

-- Dumping structure for table pro_activity.tb_activities
CREATE TABLE IF NOT EXISTS `tb_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดี',
  `activities_name` varchar(50) DEFAULT NULL COMMENT 'ชื่อกิจกรรม',
  `activities_location` varchar(100) DEFAULT NULL COMMENT 'สถานที่กิจกรรม',
  `activities_aspect` text COMMENT 'ลักษณะกิจกรรม',
  `activities_time` varchar(100) DEFAULT NULL COMMENT 'ช่วงเวลา',
  `activities_detill` text COMMENT 'รายละเอียดกิจกรรม',
  `activities_createdate` datetime DEFAULT NULL COMMENT 'วันที่สร้างกิจกรรม',
  `activities_enddate` datetime DEFAULT NULL COMMENT 'วันที่สิ้นสุดกิจกรรรม',
  `activities_year` varchar(4) DEFAULT NULL COMMENT 'ปีการศึกษา',
  `activities_trem` varchar(4) DEFAULT NULL COMMENT 'เทอมการศึกษา',
  `activities_hour` varchar(4) DEFAULT NULL COMMENT 'ชั่วโมงที่ได้รับ',
  `activities_join` int(4) DEFAULT NULL COMMENT 'ผู้คนที่เชข้าร่วม',
  `activities_total` int(4) DEFAULT NULL COMMENT 'ผู้คนที่รับได้ทั้งหมด',
  `activities_status` varchar(1) DEFAULT NULL COMMENT 'สถานะกิจกรรม',
  `activities_max` varchar(1) DEFAULT NULL COMMENT 'คน A -เต็มม N- ไม่เต็ม',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='ตารางกิจกรรม';

-- Dumping data for table pro_activity.tb_activities: ~4 rows (approximately)
DELETE FROM `tb_activities`;
/*!40000 ALTER TABLE `tb_activities` DISABLE KEYS */;
INSERT INTO `tb_activities` (`id`, `activities_name`, `activities_location`, `activities_aspect`, `activities_time`, `activities_detill`, `activities_createdate`, `activities_enddate`, `activities_year`, `activities_trem`, `activities_hour`, `activities_join`, `activities_total`, `activities_status`, `activities_max`) VALUES
	(1, 'ปลูกป่าเพื่อพ่อ1', NULL, NULL, NULL, 'ปลูกป่าเพื่อพ่อ\r\n55\r\n44\r\n', '2019-01-12 13:26:31', '2019-02-12 13:26:33', '2561', '1', '6', 0, 10, '0', 'A'),
	(2, 'ปลูกป่าเพื่อพ่อ2', NULL, NULL, NULL, 'ปลูกป่าเพื่อพ่อ', '2019-01-12 13:27:11', '2019-02-12 13:27:12', '2561', '1', '6', 2, 10, '0', 'A'),
	(3, 'ปลูกป่าเพื่อพ่อ3', NULL, NULL, NULL, 'ปลูกป่าเพื่อพ่อ', '2019-01-12 13:27:52', '2019-01-12 13:27:53', '2561', '1', '7', 5, 10, '0', 'A'),
	(4, 'ปลูกป่าเพื่อพ่อ4', NULL, NULL, NULL, 'ปลูกป่าเพื่อพ่อ', '2019-01-12 13:53:34', '2019-01-12 13:53:35', '2561', '1', '2', 6, 10, '0', 'A');
  (5, 'ปลูกป่าเพื่อพ่อ5', NULL, NULL, NULL, 'ปลูกป่าเพื่อพ่อ', '2019-01-12 13:53:34', '2019-01-12 13:53:35', '2561', '1', '2', 6, 10, '0', 'A');
  (6, 'ปลูกป่าเพื่อพ่อ6', NULL, NULL, NULL, 'ปลูกป่าเพื่อพ่อ', '2019-01-12 13:53:34', '2019-01-12 13:53:35', '2561', '1', '2', 3, 10, '0', 'A');
/*!40000 ALTER TABLE `tb_activities` ENABLE KEYS */;

-- Dumping structure for table pro_activity.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `pre_name` varchar(50) DEFAULT NULL COMMENT 'คำนำหน้า',
  `user_name` varchar(50) DEFAULT NULL COMMENT 'ชื่อ',
  `user_lastname` varchar(50) DEFAULT NULL COMMENT 'นามสกุล',
  `user_id` int(12) DEFAULT NULL COMMENT 'รหัสนักศึกษา',
  `user_majer` int(12) DEFAULT NULL COMMENT 'สาชา fk',
  `user_year` int(10) DEFAULT NULL COMMENT 'ชั้นปี',
  `user_moo` int(10) DEFAULT NULL COMMENT 'หมู่เรียน',
  `user_tel` int(10) DEFAULT NULL COMMENT 'เบอร์โทร',
  `user_email` varchar(50) DEFAULT NULL COMMENT 'e-mail',
  `user_password` varchar(50) DEFAULT NULL COMMENT 'รหัส',
  `user_img` varchar(255) DEFAULT NULL COMMENT 'ที่เก็บรูป',
  `user_status` varchar(1) DEFAULT NULL COMMENT 'สถานะ 1=นศ,2=admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='สมาชิก';

-- Dumping data for table pro_activity.tb_user: ~0 rows (approximately)
DELETE FROM `tb_user`;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` (`id`, `pre_name`, `user_name`, `user_lastname`, `user_id`, `user_majer`, `user_year`, `user_moo`, `user_tel`, `user_email`, `user_password`, `user_img`, `user_status`) VALUES

/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
