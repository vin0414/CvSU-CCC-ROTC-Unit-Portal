-- Database backup of db_cvsu created on 20251116045221



-- Creating table accounts --
CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `date_created` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


-- Inserting data into accounts --
INSERT INTO `accounts` (account_id,employee_id,password,fullname,email,role_id,status,token,date_created) VALUES ('1','EMP-00001','$2y$10$aQHOFPE43iqsoi1LXjksZOEaO183lhCALzxPKoOehHwb/oNdIJY9y','Administrator','admin@gmail.com','2','1','gjj232w2j2344hqq423423hq2312434','2025-05-03');
INSERT INTO `accounts` (account_id,employee_id,password,fullname,email,role_id,status,token,date_created) VALUES ('2','EMP-00002','$2y$10$CMkD2OncIS9nLAhw4PaVROgaajgVAAkIU3haF.DeMFuAGSv0/ZbC6','Juan Dela Cruz','juan.delacruz@gmail.com','3','1','c5634f45afa591c099072d76891944da','2025-10-18 10:53:52 am');
INSERT INTO `accounts` (account_id,employee_id,password,fullname,email,role_id,status,token,date_created) VALUES ('3','EMP-00003','$2y$10$bIdNth3Ron50evmEYuJ9e.A/9WxE2gxRfwnrk4E0Wfm1DoQHRWmKq','Pedro Santos','pedrosantos@gmail.com','3','1','97830d3c100067a49e879c989f3a92d0','2025-11-06 09:44:12 am');


-- Creating table announcement --
CREATE TABLE `announcement` (
  `announcement_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `details` longtext,
  `image` varchar(255) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`announcement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


-- Inserting data into announcement --
INSERT INTO `announcement` (announcement_id,title,details,image,account_id,created_at,updated_at) VALUES ('1','Hello world','<p>The quick brown fox jumps over the lazy dog near at the bank of the river</p>','20251019015004_cvsu-logo.png','','2025-10-18 14:23:01','2025-11-05 13:55:45');
INSERT INTO `announcement` (announcement_id,title,details,image,account_id,created_at,updated_at) VALUES ('2','Sample of text here','<p>Hello world here.</p>','20251018143754_logo.png','1','2025-10-18 14:37:54','2025-11-05 13:55:31');


-- Creating table assignments --
CREATE TABLE `assignments` (
  `assignment_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`assignment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


-- Inserting data into assignments --
INSERT INTO `assignments` (assignment_id,account_id,schedule_id,created_at,updated_at) VALUES ('1','0','0','2025-11-12 14:21:50','2025-11-12 14:35:06');
INSERT INTO `assignments` (assignment_id,account_id,schedule_id,created_at,updated_at) VALUES ('2','0','0','2025-11-12 14:24:43','2025-11-12 14:34:30');
INSERT INTO `assignments` (assignment_id,account_id,schedule_id,created_at,updated_at) VALUES ('3','2','1','2025-11-12 14:38:01','2025-11-12 14:38:01');
INSERT INTO `assignments` (assignment_id,account_id,schedule_id,created_at,updated_at) VALUES ('4','1','2','2025-11-14 07:35:50','2025-11-14 07:35:50');
INSERT INTO `assignments` (assignment_id,account_id,schedule_id,created_at,updated_at) VALUES ('5','1','3','2025-11-14 07:35:56','2025-11-14 07:35:56');
INSERT INTO `assignments` (assignment_id,account_id,schedule_id,created_at,updated_at) VALUES ('6','3','4','2025-11-14 07:36:06','2025-11-14 07:36:06');


-- Creating table attachments --
CREATE TABLE `attachments` (
  `attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`attachment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


-- Inserting data into attachments --
INSERT INTO `attachments` (attachment_id,student_id,file,created_at,updated_at) VALUES ('1','0','20251106083628_My_Resume__1_.pdf','2025-11-06 08:36:28','2025-11-12 14:40:43');


-- Creating table attendance --
CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`attendance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


-- Inserting data into attendance --
INSERT INTO `attendance` (attendance_id,student_id,date,time,remarks,token,created_at,updated_at) VALUES ('1','1','2025-11-12','08:00','IN','313414124','2025-11-12 08:00:00','2025-11-12 08:00:00');
INSERT INTO `attendance` (attendance_id,student_id,date,time,remarks,token,created_at,updated_at) VALUES ('2','1','2025-11-12','16:00','OUT','313414124','2025-11-12 08:00:00','2025-11-12 08:00:00');


-- Creating table cadets --
CREATE TABLE `cadets` (
  `cadet_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `house_no` varchar(45) DEFAULT NULL,
  `street` varchar(45) DEFAULT NULL,
  `village` varchar(45) DEFAULT NULL,
  `municipality` varchar(45) DEFAULT NULL,
  `province` varchar(45) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `section` varchar(45) DEFAULT NULL,
  `school_attended` varchar(45) DEFAULT NULL,
  `birthdate` varchar(45) DEFAULT NULL,
  `height` varchar(45) DEFAULT NULL,
  `weight` varchar(45) DEFAULT NULL,
  `blood_type` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `religion` varchar(45) DEFAULT NULL,
  `contact_no` varchar(45) DEFAULT NULL,
  `fb_account` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mother_sname` varchar(45) DEFAULT NULL,
  `mother_fname` varchar(45) DEFAULT NULL,
  `mother_mname` varchar(45) DEFAULT NULL,
  `mother_contact` varchar(45) DEFAULT NULL,
  `mother_work` varchar(45) DEFAULT NULL,
  `father_sname` varchar(45) DEFAULT NULL,
  `father_fname` varchar(45) DEFAULT NULL,
  `father_mname` varchar(45) DEFAULT NULL,
  `father_contact` varchar(45) DEFAULT NULL,
  `father_work` varchar(45) DEFAULT NULL,
  `emergency_address` longtext,
  `relationship` varchar(45) DEFAULT NULL,
  `emergency_contact` varchar(45) DEFAULT NULL,
  `emergency_email` varchar(45) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`cadet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


-- Inserting data into cadets --
INSERT INTO `cadets` (cadet_id,student_id,house_no,street,village,municipality,province,course,year,section,school_attended,birthdate,height,weight,blood_type,gender,religion,contact_no,fb_account,email,mother_sname,mother_fname,mother_mname,mother_contact,mother_work,father_sname,father_fname,father_mname,father_contact,father_work,emergency_address,relationship,emergency_contact,emergency_email,token,created_at,updated_at) VALUES ('1','1','B6 L6','Grape Street','Summerwind Village III','Dasmarinas City','Cavite','Bachelor of Science in Computer Science','2012','N/A','Dominican College of Iloilo','1990-04-14','167.00','65.00','A+','Male','Catholic','09352901671','test','vinmogate@gmail.com','Mogate','Lily','Barretto','0987654323','N/A','Mogate','Warlito','Barrido','0987654345','N/A','Salitran III, Dasmarinas City, Cavite 4114','Sister','Mae Rose Mogate','vinmogate@gmail.com','726363e92654924adcf0e15025402ccfd7aec2155db5415b9670c63381d452fc','2025-11-06 08:34:40','2025-11-14 05:36:10');


-- Creating table favorites --
CREATE TABLE `favorites` (
  `favorite_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`favorite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Inserting data into favorites --


-- Creating table logs --
CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `activities` longtext,
  `page` varchar(45) DEFAULT NULL,
  `datetime` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=latin1;


-- Inserting data into logs --
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('1','1','Logged On','Login page','2025-05-03 02:28:20 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('2','1','Logged Out','Login page','2025-05-03 02:56:44 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('3','1','Logged On','Login page','2025-05-03 08:05:43 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('4','1','Logged Out','Login page','2025-05-03 10:14:18 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('5','1','Logged On','Login page','2025-05-04 03:06:26 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('6','1','Logged Out','Login page','2025-05-04 03:35:01 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('7','1','Logged On','Login page','2025-05-04 03:41:38 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('8','1','Logged Out','Login page','2025-05-04 04:33:22 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('9','1','Logged On','Login page','2025-05-04 08:55:13 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('10','1','Logged Out','Login page','2025-05-04 08:55:19 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('11','1','Logged On','Login page','2025-05-04 08:55:23 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('12','1','Logged Out','Login page','2025-05-04 09:22:32 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('13','1','Logged On','Login page','2025-10-13 09:36:35 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('14','1','Logged Out','Login page','2025-10-13 10:16:49 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('15','1','Logged On','Login page','2025-10-13 10:17:27 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('16','1','Logged Out','Login page','2025-10-13 10:55:28 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('17','1','Logged On','Login page','2025-10-14 09:35:22 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('18','1','Logged Out','Login page','2025-10-14 10:47:26 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('19','1','Logged On','Login page','2025-10-18 05:37:38 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('20','1','Created Account','Create Account page','2025-10-18 06:29:23 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('21','1','Created Account','Create Account page','2025-10-18 06:31:42 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('22','1','Modify permission','Settings page','2025-10-18 06:49:15 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('23','1','Created Account','Create Account page','2025-10-18 06:53:52 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('24','1','Modify permission','Settings page','2025-10-18 06:54:55 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('25','1','Logged Out','Login page','2025-10-18 06:55:12 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('26','1','Logged On','Login page','2025-10-18 08:51:46 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('27','1','Modify Account','Create Account page','2025-10-18 08:57:21 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('28','1','Modify Account','Create Account page','2025-10-18 08:57:45 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('29','1','Logged Out','Login page','2025-10-18 10:39:43 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('30','1','Logged On','Login page','2025-10-19 09:30:05 am');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('31','1','Logged Out','Login page','2025-10-19 11:22:44 am');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('32','1','Logged On','Login page','2025-10-19 09:00:20 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('33','1','Modify Account','Create Account page','2025-10-19 09:07:00 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('34','1','Logged Out','Login page','2025-10-19 10:13:58 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('35','1','Logged On','Login page','2025-10-22 09:46:53 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('36','1','Logged Out','Login page','2025-10-22 09:53:55 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('37','1','Logged On','Login page','2025-10-22 09:57:41 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('38','1','Logged Out','Login page','2025-10-22 10:33:42 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('39','1','Logged On','Login page','2025-10-25 06:46:46 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('40','1','Logged Out','Login page','2025-10-25 06:47:09 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('41','1','Logged On','Login page','2025-10-26 03:28:21 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('42','1','Logged Out','Login page','2025-10-26 03:31:07 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('43','1','Logged On','Login page','2025-10-26 03:31:48 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('44','1','Logged Out','Login page','2025-10-26 04:48:00 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('45','1','Logged On','Login page','2025-10-26 07:42:51 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('46','1','Logged Out','Login page','2025-10-26 09:44:05 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('47','1','Logged On','Login page','2025-10-31 08:03:46 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('48','1','Logged Out','Login page','2025-10-31 09:51:22 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('49','1','Logged On','Login page','2025-11-01 10:02:34 am');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('50','1','Logged Out','Login page','2025-11-01 11:34:16 am');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('51','1','Logged On','Login page','2025-11-01 12:05:56 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('52','1','Logged Out','Login page','2025-11-01 12:06:53 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('53','1','Logged On','Login page','2025-11-01 04:40:29 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('54','1','Logged Out','Login page','2025-11-01 05:02:18 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('55','1','Logged On','Login page','2025-11-02 11:27:30 am');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('56','1','Logged Out','Login page','2025-11-02 12:20:24 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('57','1','Logged On','Login page','2025-11-03 10:51:28 am');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('58','1','Logged Out','Login page','2025-11-03 12:08:14 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('59','1','Logged On','Login page','2025-11-03 01:07:42 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('60','1','Logged Out','Login page','2025-11-03 01:07:56 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('61','1','Logged On','Login page','2025-11-03 07:13:49 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('62','1','Logged Out','Login page','2025-11-03 09:58:56 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('63','1','Logged On','Login page','2025-11-04 10:31:34 am');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('64','1','Logged Out','Login page','2025-11-04 12:13:29 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('65','1','Logged On','Login page','2025-11-05 09:43:39 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('66','1','Modify Account','Create Account page','2025-11-05 09:57:16 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('67','1','Modify Account','Create Account page','2025-11-05 09:57:31 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('68','1','Logged Out','Login page','2025-11-05 11:18:58 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('69','1','Logged On','Login page','2025-11-06 02:42:43 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('70','1','Logged Out','Login page','2025-11-06 04:32:07 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('71','1','Logged On','Login page','2025-11-06 05:34:11 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('72','1','Created Account','Create Account page','2025-11-06 05:44:12 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('73','1','Modify permission','Settings page','2025-11-06 05:46:03 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('74','1','Modify permission','Settings page','2025-11-06 06:17:59 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('75','1','Logged On','Login page','2025-11-12 11:32:14 am');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('76','1','Logged Out','Login page','2025-11-12 01:03:50 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('77','1','Logged On','Login page','2025-11-12 05:24:04 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('78','1','Logged Out','Login page','2025-11-12 07:10:17 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('79','1','Logged On','Login page','2025-11-12 08:33:00 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('80','1','Assigned officer with task # 1','Schedules','2025-11-12 10:21:50 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('81','1','Assigned officer with task # 2','Schedules','2025-11-12 10:24:43 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('82','1','Removed the assigned task','Schedules','2025-11-12 10:33:49 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('83','1','Removed the assigned task','Schedules','2025-11-12 10:34:30 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('84','1','Removed the assigned task','Schedules','2025-11-12 10:35:06 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('85','1','Assigned officer with task # 1','Schedules','2025-11-12 10:38:01 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('86','1','Logged Out','Login page','2025-11-12 10:39:48 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('87','1','Logged On','Login page','2025-11-13 07:54:20 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('88','1','Modify schedule for PT3','Schedules','2025-11-13 10:33:55 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('89','1','Create a new schedule for PT4','Schedules','2025-11-13 10:36:46 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('90','1','Add schedule for cadet #:  1','Cadets','2025-11-13 11:03:55 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('91','1','Logged Out','Login page','2025-11-13 11:06:33 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('92','1','Logged On','Login page','2025-11-14 11:29:10 am');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('93','1','Add schedule for cadet #:  1','Cadets','2025-11-14 12:00:16 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('94','1','Add schedule for cadet #:  1','Cadets','2025-11-14 12:20:45 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('95','1','Logged Out','Login page','2025-11-14 12:46:07 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('96','1','Logged On','Login page','2025-11-14 03:32:32 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('97','1','Assigned officer with task # 2','Schedules','2025-11-14 03:35:50 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('98','1','Assigned officer with task # 3','Schedules','2025-11-14 03:35:57 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('99','1','Assigned officer with task # 4','Schedules','2025-11-14 03:36:06 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('100','1','Modify permission','Settings page','2025-11-14 04:20:10 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('101','1','Modify permission','Settings page','2025-11-14 04:39:48 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('102','1','Logged Out','Login page','2025-11-14 05:23:48 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('103','1','Logged On','Login page','2025-11-14 09:22:35 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('104','1','Modify permission','Settings page','2025-11-14 10:00:38 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('105','1','Logged Out','Login page','2025-11-14 10:38:17 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('106','1','Logged On','Login page','2025-11-15 10:17:15 am');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('107','1','Modify permission','Settings page','2025-11-15 11:19:12 am');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('108','1','Add schedule for cadet #:  1','Cadets','2025-11-15 11:20:06 am');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('109','1','Logged Out','Login page','2025-11-15 11:56:33 am');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('110','1','Logged On','Login page','2025-11-15 11:58:45 am');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('111','1','Logged Out','Login page','2025-11-15 12:16:34 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('112','1','Logged On','Login page','2025-11-15 01:12:42 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('113','1','Logged Out','Login page','2025-11-15 01:30:14 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('114','1','Logged On','Login page','2025-11-15 02:25:01 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('115','1','Add new subject :  ROTC','Gradebook','2025-11-15 02:52:30 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('116','1','Modify permission','Settings page','2025-11-15 05:00:36 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('117','1','Logged Out','Login page','2025-11-15 05:49:30 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('118','1','Logged On','Login page','2025-11-15 07:19:05 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('119','1','modify subject :  ROTC','Gradebook','2025-11-15 07:21:27 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('120','1','modify subject :  ROTC','Gradebook','2025-11-15 07:22:08 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('121','1','Add grades for task # 1','Gradebook','2025-11-15 08:56:07 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('122','1','Add grades for task # 1','Gradebook','2025-11-15 09:00:56 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('123','1','Add grades for task # 2','Gradebook','2025-11-15 09:02:09 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('124','1','Add grades for task # 3','Gradebook','2025-11-15 09:18:29 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('125','1','Add grades for task # 3','Gradebook','2025-11-15 09:26:40 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('126','1','Logged Out','Login page','2025-11-15 10:11:30 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('127','1','Logged On','Login page','2025-11-15 10:11:44 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('128','1','Modify Account','Create Account page','2025-11-15 10:30:24 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('129','1','Logged Out','Login page','2025-11-15 10:30:39 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('130','1','Logged On','Login page','2025-11-16 10:41:17 am');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('131','1','Logged Out','Login page','2025-11-16 12:08:48 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('132','1','Logged On','Login page','2025-11-16 12:20:45 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('133','1','Logged Out','Login page','2025-11-16 12:30:36 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('134','1','Logged On','Login page','2025-11-16 12:36:47 pm');
INSERT INTO `logs` (log_id,account_id,activities,page,datetime) VALUES ('135','1','Modify permission','Settings page','2025-11-16 12:51:41 pm');


-- Creating table qrcodes --
CREATE TABLE `qrcodes` (
  `qr_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `control_number` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`qr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


-- Inserting data into qrcodes --
INSERT INTO `qrcodes` (qr_id,student_id,control_number,token,created_at,updated_at) VALUES ('1','1','CN-0000001','2b48dcaa1a4e533d8ba4a11cd151f2d200bb59c287756bcc9094f0c06024e829','2025-11-06 08:43:13','2025-11-06 08:43:13');


-- Creating table roles --
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(45) DEFAULT NULL,
  `cadet` int(11) DEFAULT NULL,
  `schedule` int(11) DEFAULT NULL,
  `attendance` int(11) DEFAULT NULL,
  `grading_system` int(11) DEFAULT NULL,
  `announcement` int(11) DEFAULT NULL,
  `maintenance` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


-- Inserting data into roles --
INSERT INTO `roles` (role_id,role_name,cadet,schedule,attendance,grading_system,announcement,maintenance,created_at,updated_at) VALUES ('1','Admin','0','1','1','1','0','1','2025-10-13 10:00:00','2025-11-15 09:00:36');
INSERT INTO `roles` (role_id,role_name,cadet,schedule,attendance,grading_system,announcement,maintenance,created_at,updated_at) VALUES ('2','Super-admin','0','0','0','0','0','1','2025-10-18 10:29:23','2025-11-16 04:51:40');
INSERT INTO `roles` (role_id,role_name,cadet,schedule,attendance,grading_system,announcement,maintenance,created_at,updated_at) VALUES ('3','Standard-user','0','0','1','1','0','0','2025-10-18 10:31:42','2025-11-06 10:17:59');


-- Creating table schedules --
CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_year` varchar(255) DEFAULT NULL,
  `semester` varchar(45) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `details` longtext,
  `day` varchar(45) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `from_date` varchar(45) DEFAULT NULL,
  `to_date` varchar(45) DEFAULT NULL,
  `from_time` varchar(45) DEFAULT NULL,
  `to_time` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


-- Inserting data into schedules --
INSERT INTO `schedules` (schedule_id,school_year,semester,subject_id,name,details,day,code,from_date,to_date,from_time,to_time,status,created_at,updated_at) VALUES ('1','2025-2026','1st','1','Performance Task 1','The quick brown fox jumps over the lazy dog near at the bank of the river','Saturday','PT1','2025-11-15','2026-04-03','08:00','09:00','1','2025-11-05 14:28:34','2025-11-12 10:55:55');
INSERT INTO `schedules` (schedule_id,school_year,semester,subject_id,name,details,day,code,from_date,to_date,from_time,to_time,status,created_at,updated_at) VALUES ('2','2025-2026','1st','1','Performance Task 2','The quick brown fox jumps over the lazy dog near at the bank of the river','Saturday','PT2','2025-11-15','2026-04-03','09:00','10:00','1','2025-11-05 14:41:38','2025-11-06 08:03:09');
INSERT INTO `schedules` (schedule_id,school_year,semester,subject_id,name,details,day,code,from_date,to_date,from_time,to_time,status,created_at,updated_at) VALUES ('3','2025-2026','1st','1','Performance Task 3','Sample of the statement here','Saturday','PT3','2025-11-15','2026-04-10','13:00','15:00','1','2025-11-06 08:04:31','2025-11-13 14:33:54');
INSERT INTO `schedules` (schedule_id,school_year,semester,subject_id,name,details,day,code,from_date,to_date,from_time,to_time,status,created_at,updated_at) VALUES ('4','2025-2026','1st','1','Performance Task 4','Sample of text here','Saturday','PT4','2025-11-10','2026-04-30','15:00','16:00','1','2025-11-13 14:36:46','2025-11-13 14:36:46');


-- Creating table student_performance --
CREATE TABLE `student_performance` (
  `performance_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(45) DEFAULT NULL,
  `semester` varchar(45) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`performance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


-- Inserting data into student_performance --
INSERT INTO `student_performance` (performance_id,year,semester,subject_id,schedule_id,student_id,total,created_at,updated_at) VALUES ('1','2025-2026','1st','1','1','1','15','2025-11-15 13:00:56','2025-11-15 13:00:56');
INSERT INTO `student_performance` (performance_id,year,semester,subject_id,schedule_id,student_id,total,created_at,updated_at) VALUES ('2','2025-2026','1st','1','2','1','20','2025-11-15 13:02:09','2025-11-15 13:02:09');
INSERT INTO `student_performance` (performance_id,year,semester,subject_id,schedule_id,student_id,total,created_at,updated_at) VALUES ('3','2025-2026','1st','1','3','1','22','2025-11-15 13:18:29','2025-11-15 13:26:40');


-- Creating table students --
CREATE TABLE `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `is_enroll` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


-- Inserting data into students --
INSERT INTO `students` (student_id,school_id,password,fullname,email,status,is_enroll,photo,token,created_at,updated_at) VALUES ('1','ABC-00001','$2y$10$GTRm7LGnmBv3oMn5NpkY0u2C6OsZhv5A/O1B6YlhV8gZCxTQq4cn2','Warvin Mogate','vinmogate@gmail.com','1','1','','a6514f49cc992ed2fbaa39c9a345ff1db17155dc09e25c52097c6096f8bec6cb','2025-11-03 05:07:24','2025-11-12 14:39:00');
INSERT INTO `students` (student_id,school_id,password,fullname,email,status,is_enroll,photo,token,created_at,updated_at) VALUES ('2','ABC-00002','$2y$10$GTRm7LGnmBv3oMn5NpkY0u2C6OsZhv5A/O1B6YlhV8gZCxTQq4cn2','Juan Dela Cruz','j.delacruz@gmail.com','1','0','','2345671ewqe12312324543451231e2123123f2312r141412','2025-11-03 05:07:24','2025-11-03 05:07:24');


-- Creating table subjects --
CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_year` varchar(45) DEFAULT NULL,
  `semester` varchar(45) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `subjectName` varchar(255) DEFAULT NULL,
  `subjectDetails` longtext,
  `account_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


-- Inserting data into subjects --
INSERT INTO `subjects` (subject_id,school_year,semester,code,subjectName,subjectDetails,account_id,status,created_at,updated_at) VALUES ('1','2025-2026','1st','ROTC','ROTC','Sample of details regarding ROTC','2','1','2025-11-15 06:52:29','2025-11-15 11:22:08');


-- Creating table trainings --
CREATE TABLE `trainings` (
  `training_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`training_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


-- Inserting data into trainings --
INSERT INTO `trainings` (training_id,student_id,schedule_id,status,remarks,created_at,updated_at) VALUES ('1','1','1','1','N/A','2025-11-14 04:20:45','2025-11-14 04:20:45');
INSERT INTO `trainings` (training_id,student_id,schedule_id,status,remarks,created_at,updated_at) VALUES ('2','1','2','1','N/A','2025-11-14 04:20:45','2025-11-14 04:20:45');
INSERT INTO `trainings` (training_id,student_id,schedule_id,status,remarks,created_at,updated_at) VALUES ('3','1','3','1','N/A','2025-11-15 03:20:06','2025-11-15 03:20:06');
