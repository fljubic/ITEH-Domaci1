/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.4.22-MariaDB : Database - iteh-domaci1
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`iteh-domaci1` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `iteh-domaci1`;

/*Table structure for table `ucenik` */

DROP TABLE IF EXISTS `ucenik`;

CREATE TABLE `ucenik` (
  `ime` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `ucenik` */

insert  into `ucenik`(`ime`,`email`,`username`,`password`) values ('Филип','filip@gmail.com','filip','filip'),('Кузман','kuzman@gmail.com','kuzman','kuzman'),('Грегор','gregor@gmail.hu','magas','magas'),('Андрија','andrija@gmail.com','cvijetic','cvijetic'),('Новица','novke.brate@gmail.com','novke','novke'),('Павле','covpa@yahoo.com','pacov','pacov');

/*Table structure for table `ucitelj` */

DROP TABLE IF EXISTS `ucitelj`;

CREATE TABLE `ucitelj` (
  `ime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `iskustvo` int(5) NOT NULL DEFAULT 0,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `ucitelj` */

insert  into `ucitelj`(`ime`,`username`,`password`,`iskustvo`) values ('Јоцке','jocke','jocke123',123),('Кови','kovi','kovi123',20),('Борис','boreli','boreli123',350),('Ћазим','vidramdk','cazim',1070);

/*Table structure for table `cas` */

DROP TABLE IF EXISTS `cas`;

CREATE TABLE `cas` (
  `datum` date NOT NULL,
  `vreme` int(5) NOT NULL,
  `ucenik` varchar(50) NOT NULL,
  `ucitelj` varchar(50) NOT NULL,
  PRIMARY KEY (`datum`,`vreme`,`ucitelj`),
  KEY `ucenik` (`ucenik`),
  KEY `cas_ibfk_2` (`ucitelj`),
  CONSTRAINT `cas_ibfk_1` FOREIGN KEY (`ucenik`) REFERENCES `ucenik` (`username`),
  CONSTRAINT `cas_ibfk_2` FOREIGN KEY (`ucitelj`) REFERENCES `ucitelj` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `cas` */

insert  into `cas`(`datum`,`vreme`,`ucenik`,`ucitelj`) values ('2023-06-21',12,'magas','jocke');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
