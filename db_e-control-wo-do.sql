/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.11.4-MariaDB : Database - db_e-control-wo-do
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_e-control-wo-do` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;

USE `db_e-control-wo-do`;

/*Table structure for table `trx_do` */

DROP TABLE IF EXISTS `trx_do`;

CREATE TABLE `trx_do` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sto` int(11) DEFAULT NULL,
  `tgl_input` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_do` */

/*Table structure for table `trx_sto` */

DROP TABLE IF EXISTS `trx_sto`;

CREATE TABLE `trx_sto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `so_no` varchar(255) DEFAULT NULL,
  `pt_no` varchar(255) DEFAULT NULL,
  `wo_state` varchar(255) DEFAULT NULL,
  `wo_date` datetime DEFAULT NULL,
  `do_no` varchar(255) DEFAULT NULL,
  `do_date` datetime DEFAULT NULL,
  `do_state` varchar(255) DEFAULT NULL,
  `tgl_upload` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_sto` */

/*Table structure for table `trx_wo` */

DROP TABLE IF EXISTS `trx_wo`;

CREATE TABLE `trx_wo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sto` int(11) DEFAULT NULL,
  `tgl_input` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_wo` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_tlp` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`pass`,`role_id`,`name`,`email`,`no_tlp`,`foto`,`is_active`,`update_by`,`last_update`) values 
(1,'admin','$2y$10$c3W.UkaWWfqg53Xl7esRT.RckZLC/r2vREKedHl/GroQMIJb2WBvO','1',1,'Kang Dru','kgdr@gmail.com','081211159962','default.jpg',0,1,'2023-12-03 21:52:06'),
(2,'tst','$2y$10$BdqrXdTWjgHDVlrK/v8C5Osi0tZgOTMlNDoUMGofU.jl.A/0z.Uum','1',2,'Test Input ddsdsds','tes@gmailo.com','08999','20321.png',0,1,'2023-12-03 21:49:23'),
(3,'medi','$2y$12$aVAvFmmW6rRLOLcpaQ6TcOnGhl6dlfEHCNJhHMZmmetrncl3wuuDu','1',1,'Medi','medi@gmail.com','088','default.jpg',1,1,'2023-12-03 21:50:36'),
(4,'oprwo','$2y$12$UJ89GhiJmKF3XoiZa5SZFOEiX/4vz4ZkeBUEzlWent3A01tS/pPz.','1',2,'OPR WO','oprwo@gmail.com','0888','default.jpg',1,1,'2023-12-03 21:51:10'),
(5,'oprdo','$2y$12$Sz8JpZTl0cAY2mYDAuYVOO84DDz9Pfvj2X14muZQEUvxrc3kF8xTW','1',3,'OPR DO','oprdo@gmail.com','08888','default.jpg',1,1,'2023-12-03 21:51:38'),
(6,'mkrt','$2y$12$69wtXDghC23sl1YblYso3OYTFZw8TJNad1FUpyO3prt/32Xk4krPi','1',4,'Marketing','marketing@gmail.com','0777','default.jpg',1,1,'2023-12-13 21:54:38');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
