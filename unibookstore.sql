/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.27-MariaDB : Database - unibookstore
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`unibookstore` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `unibookstore`;

/*Table structure for table `buku` */

DROP TABLE IF EXISTS `buku`;

CREATE TABLE `buku` (
  `id_buku` varchar(5) NOT NULL,
  `id_kategori` int(2) DEFAULT NULL,
  `id_penerbit` varchar(5) NOT NULL,
  `nama_buku` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_buku`),
  KEY `id_penerbit` (`id_penerbit`),
  KEY `id_kategori` (`id_kategori`),
  CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`),
  CONSTRAINT `buku_ibfk_3` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `buku` */

insert  into `buku`(`id_buku`,`id_kategori`,`id_penerbit`,`nama_buku`,`harga`,`stok`) values 
('fsg35',3,'SP009','adafafaf',60000,100),
('K1001',2,'SP01','Informatika',100000,5);

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id_kategori` int(2) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(20) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kategori` */

insert  into `kategori`(`id_kategori`,`nama_kategori`) values 
(1,'Bisnis'),
(2,'Keilmuan'),
(3,'Novel'),
(4,'kesehatan');

/*Table structure for table `penerbit` */

DROP TABLE IF EXISTS `penerbit`;

CREATE TABLE `penerbit` (
  `id_penerbit` varchar(5) NOT NULL,
  `nama_penerbit` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(50) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  PRIMARY KEY (`id_penerbit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penerbit` */

insert  into `penerbit`(`id_penerbit`,`nama_penerbit`,`alamat`,`kota`,`telepon`) values 
('SP009','ERLANGGA','aksdjakfjsfsjfsg','Bandung','575675775'),
('SP01','Penerbit Informatika','Jl. Buah Batu No. 121','Bandung','081322209874');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
