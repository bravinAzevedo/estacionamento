/*
SQLyog Community
MySQL - 10.4.28-MariaDB : Database - login
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`estacionamento` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `estacionamento`;

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nomecompleto` varchar(255) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`email`,`password`,`nomecompleto`,`tel`,`cpf`) values 
(1,'admin','moleculass@gmail.com','$2y$10$4aIpYXL0uEIj1ezmapnzUOj48I.XRPYDPpj63eP4gz4YqcxP2f4Ne',NULL,NULL,NULL),
(2,'admin2','moleculass@gmail.com','admin2','marco antobio','27999031295','56ye54525245'),
(3,'admin3','moleculass@gmail.com','admin3','marco 2','27999031295','0453459843'),
(4,'admin3','moleculass@gmail.com','$2y$10$Owf39.WXBCmTkcqO0gT2tejZEYNgsi2bV0ftJKFdXrClBaupDHQ3K','marco antobio','27999031295','56ye54525245');

/*Table structure for table `vagas` */

DROP TABLE IF EXISTS `vagas`;

CREATE TABLE `vagas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numerovaga` int(6) DEFAULT NULL,
  `placa` varchar(20) DEFAULT NULL,
  `dataentrada` date DEFAULT '1900-01-01',
  `horaentrada` time DEFAULT '00:00:00',
  `datasaida` date DEFAULT '1900-01-01',
  `horasaida` time DEFAULT '00:00:00',
  `titulo` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `nome_condutor` varchar(255) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `tipoveiculo` varchar(100) DEFAULT NULL,
  `valortotal` float DEFAULT NULL,
  `cadastrado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cadastrado_por` (`cadastrado_por`),
  CONSTRAINT `vagas_ibfk_1` FOREIGN KEY (`cadastrado_por`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `vagas` */

insert  into `vagas`(`id`,`numerovaga`,`placa`,`dataentrada`,`horaentrada`,`datasaida`,`horasaida`,`titulo`,`descricao`,`nome_condutor`,`cpf`,`tipoveiculo`,`valortotal`,`cadastrado_por`) values 
(1,3,'459ufier','2023-06-21','21:48:00','0000-00-00','02:37:21',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1),
(3,8,'fghdfghd','1900-01-01','00:00:00','2023-06-27','02:45:03',NULL,NULL,'marco','05320159757','carro',NULL,1),
(5,2,'459ufier','2023-06-06','21:48:00','2023-06-27','03:45:41',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1),
(8,10,'459ufier','2023-06-06','21:48:00','0000-00-00','02:37:49',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1),
(20,11,'459ufier','2023-06-06','21:48:00','0000-00-00','02:37:26',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1),
(21,5,'459ufier','2023-06-06','21:48:00','0000-00-00','02:37:53',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1),
(22,8,'459ufier','2023-06-06','21:48:00','2023-06-27','03:46:02',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1),
(23,8,'459ufier','2023-06-06','21:48:00','0000-00-00','02:37:45',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1),
(24,1,'459ufier','2023-06-26','21:48:00','2023-06-28','01:35:16',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1),
(25,2,'459ufier','2023-06-06','21:48:00','0000-00-00','02:39:20',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1),
(32,6,'459ufier','2023-06-27','21:34:00','1900-01-01','00:00:00',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1),
(33,8,'459ufier','2023-06-27','21:22:00','1900-01-01','00:00:00',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1),
(34,11,'459ufier','2023-06-27','21:40:00','1900-01-01','00:00:00',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1),
(35,1,'459ufier','2023-06-27','21:46:00','1900-01-01','00:00:00',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1),
(36,2,'459ufier','2023-06-27','21:48:00','1900-01-01','00:00:00',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1),
(37,3,'459ufier','2023-06-27','21:48:00','1900-01-01','00:00:00',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1),
(39,4,'459ufier','2023-06-27','22:05:00','1900-01-01','00:00:00',NULL,NULL,'jsdhfsdhfsd','09732407234','carro',NULL,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
