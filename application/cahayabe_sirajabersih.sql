-- MariaDB dump 10.19  Distrib 10.5.15-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: cahayabe_sirajabersih
-- ------------------------------------------------------
-- Server version	10.5.15-MariaDB-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `access`
--

DROP TABLE IF EXISTS `access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `code` varchar(32) NOT NULL,
  `icon` varchar(32) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `sort` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `access_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `access` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access`
--

LOCK TABLES `access` WRITE;
/*!40000 ALTER TABLE `access` DISABLE KEYS */;
/*!40000 ALTER TABLE `access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `username`, `password`, `nama`, `foto`) VALUES (1,'auwfar','f0a047143d1da15b630c73f0256d5db0','Achmad Chadil Auwfar','Koala.jpg'),(2,'ozil','f4e404c7f815fc68e7ce8e3c2e61e347','Mesut ','profil2.jpg');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agen`
--

DROP TABLE IF EXISTS `agen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agen` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_agen` varchar(100) NOT NULL,
  `alamat_agen` varchar(200) NOT NULL,
  `kota_agen` varchar(50) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `kontak_person` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `latitude` varchar(30) NOT NULL,
  `longitude` varchar(30) NOT NULL,
  `id_cabang` smallint(4) NOT NULL,
  `komisi` double(6,2) NOT NULL COMMENT 'dalam persen',
  PRIMARY KEY (`id`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `agen_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agen`
--

LOCK TABLES `agen` WRITE;
/*!40000 ALTER TABLE `agen` DISABLE KEYS */;
INSERT INTO `agen` (`id`, `nama_agen`, `alamat_agen`, `kota_agen`, `kode_pos`, `kontak_person`, `no_hp`, `email`, `status`, `latitude`, `longitude`, `id_cabang`, `komisi`) VALUES (0,'Tanpa Agen','','','','','','',1,'','',1,0.00),(1,'agen A','alamat','kota','12313','detyy','123123','farid0910',1,'1231231.232133','231331.',1,0.00),(3,'Agen B','Perumahan Cisarantan Residence','Bandung','40284','Farid Syafaat','1232','farid0910@gmail.com',1,'','',4,0.00),(10,'aderai','Perumahan Cisarantan Residence','Bandung','40284','Farid Syafaat','asdad','farid0910@gmail.com',1,'','',1,40.00);
/*!40000 ALTER TABLE `agen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cabang`
--

DROP TABLE IF EXISTS `cabang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cabang` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `nama_cabang` varchar(100) NOT NULL,
  `alamat_cabang` varchar(200) NOT NULL,
  `kota_cabang` varchar(50) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `kontak_person` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `latitude` varchar(30) NOT NULL,
  `longitude` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cabang`
--

LOCK TABLES `cabang` WRITE;
/*!40000 ALTER TABLE `cabang` DISABLE KEYS */;
INSERT INTO `cabang` (`id`, `nama_cabang`, `alamat_cabang`, `kota_cabang`, `kode_pos`, `kontak_person`, `no_hp`, `email`, `status`, `latitude`, `longitude`) VALUES (1,'Cabang Utama','Indah Raya 1','Jakarta','2313','Deny','0229867789','a@a.com',1,'-6.9151148','107.6833153'),(4,'Cabang Ke dua','Perumahan Cisarantan Residence','Bandung','40284','Farid Syafaat','1232','farid0910@gmail.com',1,'','');
/*!40000 ALTER TABLE `cabang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `driver` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_driver` varchar(100) NOT NULL,
  `alamat_driver` varchar(200) NOT NULL,
  `kota_driver` varchar(50) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `id_cabang` smallint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_agen` (`id_cabang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driver`
--

LOCK TABLES `driver` WRITE;
/*!40000 ALTER TABLE `driver` DISABLE KEYS */;
INSERT INTO `driver` (`id`, `nama_driver`, `alamat_driver`, `kota_driver`, `kode_pos`, `no_hp`, `email`, `status`, `id_cabang`) VALUES (2,'ade','ade','Bandungg','402845','1232d','farid0910@g]\\\\mail.com',0,4);
/*!40000 ALTER TABLE `driver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `layanan`
--

DROP TABLE IF EXISTS `layanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `layanan` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `kode_layanan` varchar(20) NOT NULL,
  `nama_layanan` varchar(100) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `jenis_layanan` enum('Kiloan','Satuan','Meteran') NOT NULL DEFAULT 'Kiloan',
  `harga_jual` double(12,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_layanan` (`kode_layanan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `layanan`
--

LOCK TABLES `layanan` WRITE;
/*!40000 ALTER TABLE `layanan` DISABLE KEYS */;
INSERT INTO `layanan` (`id`, `kode_layanan`, `nama_layanan`, `satuan`, `jenis_layanan`, `harga_jual`, `status`) VALUES (1,'SATU-BCK','BEDCOVER-KING','pcs','Kiloan',11000.00,1),(4,'Apa ta','Alat Sewa baru','ok','Meteran',34000.00,1);
/*!40000 ALTER TABLE `layanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat_pelanggan` varchar(200) NOT NULL,
  `kota_pelanggan` varchar(50) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `id_agen` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_agen` (`id_agen`),
  CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_agen`) REFERENCES `agen` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelanggan`
--

LOCK TABLES `pelanggan` WRITE;
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `alamat_pelanggan`, `kota_pelanggan`, `kode_pos`, `no_hp`, `email`, `status`, `id_agen`) VALUES (2,'Dedy','Perumahan Cisaranten Residence Blok c20','Bandung','40294','1232','farid0910@gmail.com',1,1),(3,'Dedy B','Perumahan Cisaranten Residence Blok c20','Bandung','40294','1232','farid0910@gmail.com',1,0),(4,'Ade','Perumahan Cisarantan Residence','Bandung','40284','313123','farid0910@gmail.com',1,3);
/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_akhir` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`id`, `tanggal_akhir`) VALUES (1,'2022-03-12 21:42:26');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_transaksi` varchar(25) NOT NULL DEFAULT '',
  `id_pelanggan` int(11) NOT NULL DEFAULT 0,
  `id_agen` smallint(6) NOT NULL,
  `tgl_transaksi` timestamp NULL DEFAULT current_timestamp(),
  `jumlah` double(12,2) NOT NULL DEFAULT 0.00,
  `status_laundry` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 ready,1 proses,2 pengiriman ke pelanggan,4 done',
  `status_bayar` tinyint(1) DEFAULT NULL COMMENT '0 belum dibayar, 1 sdh dibayar',
  `jenis_bayar` varchar(20) DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `nomor_transaksi` (`nomor_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` (`Id`, `nomor_transaksi`, `id_pelanggan`, `id_agen`, `tgl_transaksi`, `jumlah`, `status_laundry`, `status_bayar`, `jenis_bayar`, `tgl_selesai`) VALUES (1,'tr123',2,1,'2022-06-16 14:19:17',20000.00,0,1,'cash',NULL);
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_access`
--

DROP TABLE IF EXISTS `user_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) DEFAULT NULL,
  `access_id` int(11) DEFAULT NULL,
  `c` tinyint(1) DEFAULT NULL,
  `u` tinyint(1) DEFAULT NULL,
  `d` tinyint(1) DEFAULT NULL,
  `a` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_type_id` (`user_type_id`),
  KEY `access_id` (`access_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_access`
--

LOCK TABLES `user_access` WRITE;
/*!40000 ALTER TABLE `user_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_log`
--

DROP TABLE IF EXISTS `user_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(4) NOT NULL,
  `log_ip` varchar(50) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_log`
--

LOCK TABLES `user_log` WRITE;
/*!40000 ALTER TABLE `user_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(32) DEFAULT NULL,
  `deletable` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` (`id`, `code`, `deletable`) VALUES (1,'Admin',0),(2,'Pelaksana',0),(3,'Direksi',0),(4,'Pimpro',1),(5,'Estimator',1),(6,'Purchasing',1),(7,'Finance',1),(13,'aw',1),(14,'Admin3',1);
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(32) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `verification` varchar(64) DEFAULT NULL,
  `verified` tinyint(1) DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `foto` varchar(128) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(32) DEFAULT NULL,
  `update_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY `email` (`email`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `code`, `name`, `email`, `password`, `type_id`, `verification`, `verified`, `active`, `foto`, `create_time`, `create_by`, `update_time`, `update_by`) VALUES (49,'faridsya','aderait','farid0910@gmail.comm','f1c500492cf1e5de58c0a098bdd3b9ff',1,'f484759a63925269356aeb49a12e2e11',1,1,'profil2.jpg','2022-06-06 08:36:15',NULL,'2022-06-09 13:18:33',0),(57,'aderai','ade','farid09100@gmail.comm','f1c500492cf1e5de58c0a098bdd3b9ff',1,'e8c33eded1de390d45298696aa7829f7',1,1,'profil2.jpg','2022-06-08 02:19:40',NULL,'2022-06-09 13:18:39',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'cahayabe_sirajabersih'
--

--
-- Dumping routines for database 'cahayabe_sirajabersih'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-17 14:56:45
