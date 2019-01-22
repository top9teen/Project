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
  `activities_aspect` text COMMENT 'หน้าที่รับผิดชอบ',
  `activities_timeday` varchar(100) DEFAULT NULL COMMENT 'ช่วงเวลาเช้า',
  `activities_detill` text COMMENT 'รายละเอียดกิจกรรม',
  `activities_createdate` datetime NOT NULL COMMENT 'วันที่สร้างกิจกรรม',
  `activities_enddate` datetime NOT NULL COMMENT 'วันที่สิ้นสุดกิจกรรรม',
  `activities_year` varchar(4) DEFAULT NULL COMMENT 'ปีการศึกษา',
  `activities_trem` varchar(4) DEFAULT NULL COMMENT 'เทอมการศึกษา',
  `activities_hour` varchar(4) DEFAULT NULL COMMENT 'ชั่วโมงที่ได้รับ',
  `activities_join` int(4) DEFAULT NULL COMMENT 'ผู้คนที่เข้าร่วม',
  `activities_total` int(4) DEFAULT NULL COMMENT 'ผู้คนที่รับได้ทั้งหมด',
  `activities_status` varchar(1) DEFAULT NULL COMMENT 'สถานะกิจกรรม 0=ยัง,1=ทำ',
  `activities_max` varchar(1) DEFAULT NULL COMMENT 'คน A -เต็มม N- ไม่เต็ม',
  `activities_timenint` varchar(100) DEFAULT NULL COMMENT 'ช่วงเวลาเย็น',
  `activities_adminstatus` varchar(1) DEFAULT NULL COMMENT 'A =ตรวจแล้ว,N=ยังไม่ตรวจ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='ตารางกิจกรรม';

-- Dumping data for table pro_activity.tb_activities: ~13 rows (approximately)
DELETE FROM `tb_activities`;
/*!40000 ALTER TABLE `tb_activities` DISABLE KEYS */;
INSERT INTO `tb_activities` (`id`, `activities_name`, `activities_location`, `activities_aspect`, `activities_timeday`, `activities_detill`, `activities_createdate`, `activities_enddate`, `activities_year`, `activities_trem`, `activities_hour`, `activities_join`, `activities_total`, `activities_status`, `activities_max`, `activities_timenint`, `activities_adminstatus`) VALUES
	(1, 'ปลูกป่าเพื่อพ่อ1', 'ปลูกป่าเพื่อพ่อ1 ทดสอบ', NULL, '09.00 - 12.00', 'ปลูกป่าเพื่อพ่อ\r\n55\r\n44\r\n', '2019-01-12 13:26:31', '2019-02-12 13:26:33', '2561', '1', '6', 2, 10, '0', 'N', '13.00-15.00', 'N'),
	(2, 'ปลูกป่าเพื่อพ่อ2', 'ปลูกป่าเพื่อพ่อ2 ทดสอบ', NULL, '09.00 - 12.00', 'ปลูกป่าเพื่อพ่อ', '2019-01-12 13:27:11', '2019-02-12 13:27:12', '2561', '1', '6', 3, 10, '0', 'N', '13.00-15.00', 'N'),
	(3, 'ปลูกป่าเพื่อพ่อ3', 'ปลูกป่าเพื่อพ่อ3 ทดสอบ', NULL, '09.00 - 12.00', 'ปลูกป่าเพื่อพ่อ', '2019-01-12 13:27:52', '2019-01-12 13:27:53', '2561', '1', '7', 7, 10, '1', 'N', '13.00-15.00', 'A'),
	(4, 'ปลูกป่าเพื่อพ่อ4', 'ปลูกป่าเพื่อพ่อ4 ทดสอบ', NULL, '09.00 - 12.00', 'ปลูกป่าเพื่อพ่อ', '2019-01-12 13:53:34', '2019-01-12 13:53:35', '2561', '1', '2', 6, 10, '1', 'N', '13.00-15.00', 'N'),
	(5, 'ปลูกป่าเพื่อพ่อ5', 'ปลูกป่าเพื่อพ่อ5 ทดสอบ', NULL, '09.00 - 12.00', 'ปลูกป่าเพื่อพ่อ', '2019-01-18 02:20:54', '2019-01-18 02:20:54', '2562', '1', '2', 0, 10, '1', 'N', '13.00-15.00', 'N'),
	(6, 'ปลูกป่าเพื่อพ่อ6', 'ปลูกป่าเพื่อพ่อ6 ทดสอบ', NULL, '09.00 - 12.00', 'ปลูกป่าเพื่อพ่อ', '2019-01-18 02:21:44', '2019-01-18 02:21:43', '2562', '1', '3', 10, 10, '0', 'A', '13.00-15.00', 'N'),
	(7, 'sadadsad', 'sadsadasd', 'asdasdas', '08.00น - 11.00น', 'dsadasdsad', '2019-01-22 11:23:04', '2019-01-23 00:00:00', '2561', '3', '2', 0, 2, '0', 'N', '13.00น - 15.00น', 'N'),
	(8, 'sadadsad', 'sadsadasd', 'asdasdas', '08.00น - 11.00น', 'dsadasdsad', '2019-01-22 11:24:09', '2019-01-23 00:00:00', '2561', '3', '2', 0, 2, '0', 'N', '13.00น - 15.00น', 'N'),
	(9, 'sadadsad', 'sadsadasd', 'asdasdas', '08.00น - 11.00น', 'dsadasdsad', '2019-01-22 11:27:09', '2019-01-23 00:00:00', '2561', '3', '2', 0, 2, '0', 'N', '13.00น - 15.00น', 'N'),
	(10, 'sadadbbbbbb', 'bbssfsdfdsf', 'sdfsdfsd', '09.00 - 10.00', 'fdsfsdfsdfsdf', '2019-01-22 11:27:48', '2019-01-24 00:00:00', '2563', '3', '33', 0, 33, '0', 'N', '13.00 - 14.00', 'N'),
	(11, 'sadadbbbbbb', 'bbssfsdfdsf', 'sdfsdfsd', '09.00 - 10.00', 'fdsfsdfsdfsdf', '2019-01-22 11:28:28', '2019-01-24 00:00:00', '2563', '3', '33', 0, 33, '0', 'N', '13.00 - 14.00', 'N'),
	(12, 'หกฟกฟหก', 'กฟหกฟหก', 'กฟหกฟหกหฟ', '07.00 - 09.00', 'หฟกฟหกฟหก', '2019-01-22 11:28:56', '2019-01-23 00:00:00', '2563', '1', '5', 0, 55, '0', 'N', '14.00 - 16.00', 'N'),
	(13, 'หฟกหฟกฟหก', 'ฟหกฟหกฟหก', 'กฟหกหฟ', '08.00 - 09.00', 'กหฟกหฟกฟหกหฟ', '2019-01-22 11:38:43', '1970-01-01 07:00:00', '2563', '2', '5', 0, 5, '1', 'N', '13.00 - 14.00', 'N');
/*!40000 ALTER TABLE `tb_activities` ENABLE KEYS */;

-- Dumping structure for table pro_activity.tb_branch
CREATE TABLE IF NOT EXISTS `tb_branch` (
  `user_majer` int(3) DEFAULT NULL,
  `br_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ประเภทสาขา';

-- Dumping data for table pro_activity.tb_branch: ~12 rows (approximately)
DELETE FROM `tb_branch`;
/*!40000 ALTER TABLE `tb_branch` DISABLE KEYS */;
INSERT INTO `tb_branch` (`user_majer`, `br_name`) VALUES
	(1, 'คณิตศาสตร์'),
	(2, 'วิทยาการคอมพิวเตอร์'),
	(3, 'ภูมิศาสตร์และภูมิสารสนเทศ'),
	(4, 'วิทยาศาสตร์การกีฬา'),
	(5, 'สถิติประยุกต์'),
	(6, 'เคมี'),
	(7, 'สาธารณสุขศาสตร์'),
	(8, 'วิทยาศาสตร์การอาหาร'),
	(9, 'ชีววิทยา'),
	(10, 'วิทยาศาสตร์สิ่งแวดล้อม'),
	(11, 'เทคโนโลยีสารสนเทศ'),
	(12, 'วิทยาศาสตร์สิ่งทอ');
/*!40000 ALTER TABLE `tb_branch` ENABLE KEYS */;

-- Dumping structure for table pro_activity.tb_joinactivity
CREATE TABLE IF NOT EXISTS `tb_joinactivity` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดี',
  `jo_activties` int(11) DEFAULT NULL COMMENT 'รหัสกิจกรรม',
  `jo_userid` int(11) DEFAULT NULL COMMENT 'รหัสผู้ใช้',
  `jo_status` varchar(1) DEFAULT NULL COMMENT 'สถานะ',
  `jo_crdate` datetime DEFAULT NULL COMMENT 'วันที่เข้าร่วม',
  `jo_update` datetime DEFAULT NULL COMMENT 'เวลาที่ยกเลิก',
  `jo_inbox` text COMMENT 'หมายเหตุที่ยกเลิก',
  `jo_trem` varchar(4) DEFAULT NULL COMMENT 'เทอม',
  `jo_year` varchar(4) DEFAULT NULL COMMENT 'ปี',
  `jo_statusadmin` varchar(1) DEFAULT NULL COMMENT 'T=ผ่าน,F=ไม่ผ่าน',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='เข้าร่วมกิจกรรม';

-- Dumping data for table pro_activity.tb_joinactivity: ~5 rows (approximately)
DELETE FROM `tb_joinactivity`;
/*!40000 ALTER TABLE `tb_joinactivity` DISABLE KEYS */;
INSERT INTO `tb_joinactivity` (`id`, `jo_activties`, `jo_userid`, `jo_status`, `jo_crdate`, `jo_update`, `jo_inbox`, `jo_trem`, `jo_year`, `jo_statusadmin`) VALUES
	(1, 2, 42, '1', '2019-01-21 18:27:37', NULL, NULL, '1', '2561', 'T'),
	(2, 1, 42, '1', '2019-01-21 18:27:40', NULL, NULL, '1', '2561', 'T'),
	(3, 3, 42, '1', '2019-01-21 18:27:40', NULL, NULL, '1', '2561', '0'),
	(4, 4, 42, '1', '2019-01-21 18:27:40', NULL, NULL, '1', '2561', '0'),
	(5, 3, 31, '1', '2019-01-21 18:55:03', NULL, NULL, '1', '2561', '0');
/*!40000 ALTER TABLE `tb_joinactivity` ENABLE KEYS */;

-- Dumping structure for table pro_activity.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `pre_name` varchar(50) DEFAULT NULL COMMENT 'คำนำหน้า',
  `user_name` varchar(50) DEFAULT NULL COMMENT 'ชื่อ',
  `user_lastname` varchar(50) DEFAULT NULL COMMENT 'นามสกุล',
  `user_id` int(12) DEFAULT NULL COMMENT 'รหัสนักศึกษา',
  `user_majer` int(12) DEFAULT NULL COMMENT 'สาชา fk',
  `user_year` varchar(1) DEFAULT NULL COMMENT 'ชั้นปี',
  `user_moo` int(10) DEFAULT NULL COMMENT 'หมู่เรียน',
  `user_tel` varchar(11) DEFAULT NULL COMMENT 'เบอร์โทร',
  `user_email` varchar(50) DEFAULT NULL COMMENT 'e-mail',
  `user_password` varchar(50) DEFAULT NULL COMMENT 'รหัส',
  `user_img` varchar(255) DEFAULT NULL COMMENT 'ที่เก็บรูป',
  `user_status` varchar(1) DEFAULT NULL COMMENT 'สถานะ 1=นศ,2=admin',
  `user_date` datetime DEFAULT NULL COMMENT 'วันที่อัพเดท',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COMMENT='สมาชิก';

-- Dumping data for table pro_activity.tb_user: ~2 rows (approximately)
DELETE FROM `tb_user`;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` (`id`, `pre_name`, `user_name`, `user_lastname`, `user_id`, `user_majer`, `user_year`, `user_moo`, `user_tel`, `user_email`, `user_password`, `user_img`, `user_status`, `user_date`) VALUES
	(42, 'นาย', 'nnn', 'ทดสอบ2', 5755, 4, '2', 2, '2232', 'top@top.com', '1234', '../../assets/upload/img/5c41ba5653ead.jpg', '1', '2019-01-21 12:12:55'),
	(43, 'tt', 'admin', 'admin', 555, NULL, NULL, NULL, NULL, 'admin@admin', '1234', '../../assets/upload/img/5c41ba5653sssee.jpg', '2', '2019-01-21 12:12:54');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
