-- MySQL dump 10.15  Distrib 10.0.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.0.29-MariaDB-0ubuntu0.16.04.1

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
-- Table structure for table `backoffice_menu`
--

DROP TABLE IF EXISTS `backoffice_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backoffice_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seqno` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_ip` varchar(20) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backoffice_menu`
--

LOCK TABLES `backoffice_menu` WRITE;
/*!40000 ALTER TABLE `backoffice_menu` DISABLE KEYS */;
INSERT INTO `backoffice_menu` VALUES (1,1,0,'Home','index.php',1,'2016-04-11 18:31:28','superuser@jalurkerja.com','127.0.0.1','2017-05-10 09:01:30','superuser','127.0.0.1','2017-05-16 03:39:22'),(2,2,0,'Master Data','#',1,'2016-04-11 18:31:28','superuser@jalurkerja.com','127.0.0.1','2016-04-11 18:31:28','superuser@jalurkerja.com','127.0.0.1','2017-05-16 03:39:22'),(3,3,0,'Pekerjaan','procurement_works_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(4,4,0,'Dokumen/Surat/Kuitansi','#',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(5,5,0,'Berita Acara','#',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(6,6,0,'Scan Dokumen','scanned_documents_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(7,7,0,'Admin','#',1,'2016-04-11 18:31:28','superuser@jalurkerja.com','127.0.0.1','2016-11-07 08:01:39','superuser','127.0.0.1','2017-05-16 03:39:22'),(8,1,2,'Backoffice Menu','backoffice_menu_list.php',1,'2016-04-11 18:31:28','superuser@jalurkerja.com','127.0.0.1','2016-11-07 08:06:40','superuser','127.0.0.1','2017-05-16 03:39:22'),(9,2,2,'Group','groups_list.php',1,'2017-05-10 09:04:54','superuser','127.0.0.1','2017-05-10 09:04:54','superuser','127.0.0.1','2017-05-16 03:39:22'),(10,3,2,'Users','users_list.php',1,'2016-11-07 08:08:09','superuser','127.0.0.1','2016-11-07 08:08:09','superuser','127.0.0.1','2017-05-16 03:39:22'),(11,4,2,'Tipe Dokumen','document_types_list.php',1,'2017-05-10 10:27:22','superuser','127.0.0.1','2017-05-10 10:27:22','superuser','127.0.0.1','2017-05-16 03:39:22'),(12,5,2,'Kategori Pekerjaan','work_categories_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(14,7,2,'Supplier / Penyedia Jasa','suppliers_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(15,1,7,'Change Password','change_password.php',1,'2016-11-07 08:08:39','superuser','127.0.0.1','2016-11-07 08:08:39','superuser','127.0.0.1','2017-05-16 03:39:22'),(16,1,4,'Jadwal Lelang','jadwal_lelang_list.php',0,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:32'),(17,2,4,'Dokumen Pengadaan','dokumen_pengadaan_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(18,3,4,'Surat Perintah Pengadaan Barang/Jasa','surat_perintah_pengadaan_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(19,4,4,'Surat Pesanan','surat_pesanan_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(20,5,4,'Undangan Kepada Penyedia','pokja_ulp_undangan_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(21,6,4,'Surat Permintaan Penawaran Harga','pokja_ulp_penawaran_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(22,7,4,'Undangan Negosiasi','pokja_ulp_nego_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(23,8,4,'Surat Laporan Hasil Pengadaan','pokja_ulp_laporan_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(24,9,4,'Daftar Hadir','pokja_ulp_daftar_hadir_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(25,10,4,'Surat Penunjukan Penyedia Barang & Jasa','spk_penunjukan_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(26,11,4,'SPK','spk_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(27,12,4,'Surat Permintaan Pemeriksaan Hasil Pengadaan','spk_pemeriksaan_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(28,13,4,'Kuitansi','kuitansi_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(29,1,5,'BA Pemasukan Penawaran Pengadaan Langsung','pokja_ulp_ba_pemasukan_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(30,2,5,'BA Pembukaan Dokumen Penawaran','pokja_ulp_ba_pembukaan_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(31,3,5,'BA Evaluasi dan Penelitian Penawaran','pokja_ulp_ba_evaluasi_dok_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(32,4,5,'BA Negosiasi','pokja_ulp_ba_nego_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(33,5,5,'BA Hasil Pengadaan Langsung','pokja_ulp_ba_hasil_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(34,6,5,'BA Evaluasi Penawaran','pokja_ulp_ba_evaluasi_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(35,7,5,'BA Pemeriksaan Penyelesaian Hasil Pekerjaan','spk_ba_hasil_kerja_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(36,8,5,'BA Serah Terima Barang','spk_ba_serah_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(37,9,5,'BA Pembayaran','spk_ba_bayar_list.php',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22'),(38,10,5,'BA Serah Terima Operasional dari PPK ke KPA','',1,NULL,'',NULL,NULL,'',NULL,'2017-05-16 03:39:22');
/*!40000 ALTER TABLE `backoffice_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backoffice_menu_privileges`
--

DROP TABLE IF EXISTS `backoffice_menu_privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backoffice_menu_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `backoffice_menu_id` int(11) NOT NULL,
  `privilege` smallint(6) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backoffice_menu_privileges`
--

LOCK TABLES `backoffice_menu_privileges` WRITE;
/*!40000 ALTER TABLE `backoffice_menu_privileges` DISABLE KEYS */;
INSERT INTO `backoffice_menu_privileges` VALUES (1,1,1,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(2,1,2,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(3,1,8,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(4,1,9,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(5,1,10,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(6,1,11,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(7,1,12,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(8,1,13,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(9,1,14,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(10,1,3,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(11,1,4,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(12,1,16,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(13,1,17,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(14,1,18,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(15,1,19,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(16,1,20,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(17,1,21,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(18,1,22,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(19,1,23,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(20,1,24,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(21,1,25,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:32'),(22,1,26,1,'2017-05-12 17:16:32','superuser','127.0.0.1','2017-05-12 10:16:33'),(23,1,27,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33'),(24,1,28,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33'),(25,1,5,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33'),(26,1,29,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33'),(27,1,30,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33'),(28,1,31,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33'),(29,1,32,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33'),(30,1,33,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33'),(31,1,34,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33'),(32,1,35,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33'),(33,1,36,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33'),(34,1,37,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33'),(35,1,38,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33'),(36,1,6,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33'),(37,1,7,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33'),(38,1,15,1,'2017-05-12 17:16:33','superuser','127.0.0.1','2017-05-12 10:16:33');
/*!40000 ALTER TABLE `backoffice_menu_privileges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_types`
--

DROP TABLE IF EXISTS `document_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_types`
--

LOCK TABLES `document_types` WRITE;
/*!40000 ALTER TABLE `document_types` DISABLE KEYS */;
INSERT INTO `document_types` VALUES (1,'Surat Penetapan HPS','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(2,'Surat Perintah Pengadaan','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(3,'Dokumen Pengadaan','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(4,'Surat Pesanan','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(5,'Undangan Kepada Penyedia','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(6,'Surat Permintaan Penawaran Harga','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(7,'BA Pemasukan Penawaran Pengadaan Langsung','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(8,'BA Pembukaan Dokumen Penawaran','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(9,'BA Evaluasi dan Penelitian Penawaran','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(10,'Undangan Negosiasi','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(11,'BA Negosiasi','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(12,'BA Hasil Pengadaan Langsung atau Lelang','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(13,'Laporan Hasil Pengadaan','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(14,'Surat Penunjukan Penyedia Barang dan Jasa','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(15,'SPK','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(16,'Surat Permintaan Pemeriksaan Hasil Pengadaan Barang/Jasa','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(17,'BA Pemeriksaan Penyelesaian Hasil Pekerjaan','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(18,'BA Serah Terima Barang','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(19,'BA Pembayaran','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(20,'Kwitansi','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(21,'BA Serah Terima Operasional dari PPK ke KPA','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(22,'Pengumuman Lelang','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(23,'Undangan Pembuktian Kualifikasi','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(24,'BA Pembuktian Kualifikasi','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28'),(25,'Kontrak Kerja','','0000-00-00 00:00:00','',NULL,'2017-05-16 01:48:28');
/*!40000 ALTER TABLE `document_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokumen_pengadaan`
--

DROP TABLE IF EXISTS `dokumen_pengadaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dokumen_pengadaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `procurement_work_id` int(11) NOT NULL,
  `nomor` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumen_pengadaan`
--

LOCK TABLES `dokumen_pengadaan` WRITE;
/*!40000 ALTER TABLE `dokumen_pengadaan` DISABLE KEYS */;
INSERT INTO `dokumen_pengadaan` VALUES (1,2,'DOK/ULP/C/344/BP2IP-2016','2017-05-19 07:49:05','superuser','127.0.0.1','2017-05-19 00:49:05');
/*!40000 ALTER TABLE `dokumen_pengadaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokumen_pengadaan_kegiatan`
--

DROP TABLE IF EXISTS `dokumen_pengadaan_kegiatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dokumen_pengadaan_kegiatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `procurement_work_id` int(11) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `tanggal_1` date NOT NULL,
  `tanggal_2` date NOT NULL,
  `waktu_1` time DEFAULT NULL,
  `waktu_2` time DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumen_pengadaan_kegiatan`
--

LOCK TABLES `dokumen_pengadaan_kegiatan` WRITE;
/*!40000 ALTER TABLE `dokumen_pengadaan_kegiatan` DISABLE KEYS */;
INSERT INTO `dokumen_pengadaan_kegiatan` VALUES (32,2,'Pemasukan Dokumen Penawaran','2016-11-30','0000-00-00','09:00:00','16:00:00','2017-05-19 07:49:05','superuser','127.0.0.1','2017-05-19 00:49:05'),(33,2,'Pembukaan Dokumen Penawaran','2016-12-01','0000-00-00','08:00:00','16:00:00','2017-05-19 07:49:05','superuser','127.0.0.1','2017-05-19 00:49:05'),(34,2,'Evaluasi, Klarifikasi Teknis dan Negosiasi Harga','2016-12-01','2016-12-05','08:00:00','16:00:00','2017-05-19 07:49:05','superuser','127.0.0.1','2017-05-19 00:49:05'),(35,2,'Penandatanganan SPK','2016-12-08','0000-00-00',NULL,NULL,'2017-05-19 07:49:05','superuser','127.0.0.1','2017-05-19 00:49:05');
/*!40000 ALTER TABLE `dokumen_pengadaan_kegiatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokumen_pengadaan_undangan`
--

DROP TABLE IF EXISTS `dokumen_pengadaan_undangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dokumen_pengadaan_undangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dokumen_pengadaan_id` int(11) NOT NULL,
  `nomor` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumen_pengadaan_undangan`
--

LOCK TABLES `dokumen_pengadaan_undangan` WRITE;
/*!40000 ALTER TABLE `dokumen_pengadaan_undangan` DISABLE KEYS */;
INSERT INTO `dokumen_pengadaan_undangan` VALUES (22,1,'01/ULP/C/344/BP2IP-2016','2016-11-25',2,'2017-05-19 10:14:54','superuser','127.0.0.1','2017-05-19 03:14:54'),(23,1,'01/ULP/C/344/BP2IP-2016','2016-11-25',1,'2017-05-19 10:14:54','superuser','127.0.0.1','2017-05-19 03:14:54');
/*!40000 ALTER TABLE `dokumen_pengadaan_undangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_ip` varchar(20) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Administrator','2017-05-12 17:14:06','superuser','127.0.0.1','2017-05-12 17:14:06','superuser','127.0.0.1','2017-05-12 10:14:06'),(2,'Anggota ULP','2017-05-12 17:15:08','superuser','127.0.0.1','2017-05-12 17:15:08','superuser','127.0.0.1','2017-05-12 10:15:08'),(3,'Pokja','2017-05-12 17:15:16','superuser','127.0.0.1','2017-05-12 17:15:16','superuser','127.0.0.1','2017-05-12 10:15:16'),(4,'Pejabat Pengadaan','2017-05-12 17:15:29','superuser','127.0.0.1','2017-05-12 17:15:29','superuser','127.0.0.1','2017-05-12 10:15:29'),(5,'PPK','2017-05-12 17:15:43','superuser','127.0.0.1','2017-05-12 17:15:43','superuser','127.0.0.1','2017-05-12 10:15:43'),(6,'BMN','2017-05-12 17:16:05','superuser','127.0.0.1','2017-05-12 17:16:05','superuser','127.0.0.1','2017-05-12 10:16:05');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jadwal_lelang`
--

DROP TABLE IF EXISTS `jadwal_lelang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jadwal_lelang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `procurement_work_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal_lelang`
--

LOCK TABLES `jadwal_lelang` WRITE;
/*!40000 ALTER TABLE `jadwal_lelang` DISABLE KEYS */;
/*!40000 ALTER TABLE `jadwal_lelang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuitansi`
--

DROP TABLE IF EXISTS `kuitansi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuitansi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `procurement_work_id` int(11) NOT NULL,
  `nomor` varchar(100) NOT NULL,
  `mak` varchar(50) NOT NULL,
  `nominal` double NOT NULL,
  `tanggal` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_position` varchar(100) NOT NULL,
  `pejabat_pj` varchar(100) NOT NULL,
  `pemeriksa1_name` varchar(100) NOT NULL,
  `pemeriksa1_nip` varchar(100) NOT NULL,
  `pemeriksa2_name` varchar(100) NOT NULL,
  `pemeriksa2_nip` varchar(100) NOT NULL,
  `pemeriksa3_name` varchar(100) NOT NULL,
  `pemeriksa3_nip` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuitansi`
--

LOCK TABLES `kuitansi` WRITE;
/*!40000 ALTER TABLE `kuitansi` DISABLE KEYS */;
/*!40000 ALTER TABLE `kuitansi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_histories`
--

DROP TABLE IF EXISTS `log_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `x_mode` smallint(6) NOT NULL,
  `log_at` datetime DEFAULT NULL,
  `log_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_histories`
--

LOCK TABLES `log_histories` WRITE;
/*!40000 ALTER TABLE `log_histories` DISABLE KEYS */;
INSERT INTO `log_histories` VALUES (1,1,'superuser',2,'2017-05-10 08:53:28','127.0.0.1','2017-05-10 01:53:28'),(2,1,'superuser',1,'2017-05-10 08:53:31','127.0.0.1','2017-05-10 01:53:31'),(3,1,'superuser',1,'2017-05-10 10:26:47','127.0.0.1','2017-05-10 03:26:47'),(4,1,'superuser',1,'2017-05-12 17:10:36','127.0.0.1','2017-05-12 10:10:36'),(5,1,'superuser',2,'2017-05-12 17:17:39','127.0.0.1','2017-05-12 10:17:39'),(6,2,'admin@bp2ip.dishub.or.id',1,'2017-05-12 17:17:43','127.0.0.1','2017-05-12 10:17:43'),(7,2,'admin@bp2ip.dishub.or.id',2,'2017-05-12 19:27:40','127.0.0.1','2017-05-12 12:27:40'),(8,1,'superuser',1,'2017-05-12 19:27:44','127.0.0.1','2017-05-12 12:27:44'),(9,1,'superuser',1,'2017-05-13 09:22:29','127.0.0.1','2017-05-13 02:22:29'),(10,1,'superuser',1,'2017-05-13 15:35:09','127.0.0.1','2017-05-13 08:35:09'),(11,1,'superuser',1,'2017-05-13 20:07:48','127.0.0.1','2017-05-13 13:07:49'),(12,1,'superuser',1,'2017-05-13 20:58:29','127.0.0.1','2017-05-13 13:58:29'),(13,1,'superuser',1,'2017-05-13 22:14:00','127.0.0.1','2017-05-13 15:14:00'),(14,1,'superuser',1,'2017-05-14 14:06:09','127.0.0.1','2017-05-14 07:06:09'),(15,1,'superuser',1,'2017-05-14 14:12:32','192.168.0.14','2017-05-14 07:12:32'),(16,1,'superuser',1,'2017-05-14 14:40:27','127.0.0.1','2017-05-14 07:40:27'),(17,1,'superuser',1,'2017-05-14 20:18:28','127.0.0.1','2017-05-14 13:18:28'),(18,1,'superuser',1,'2017-05-16 08:25:24','127.0.0.1','2017-05-16 01:25:24'),(19,1,'superuser',1,'2017-05-16 10:31:42','192.168.43.219','2017-05-16 03:31:42'),(20,1,'superuser',1,'2017-05-18 08:49:37','127.0.0.1','2017-05-18 01:49:37'),(21,1,'superuser',2,'2017-05-18 08:49:42','127.0.0.1','2017-05-18 01:49:42'),(22,1,'superuser',1,'2017-05-18 08:49:49','127.0.0.1','2017-05-18 01:49:49'),(23,1,'superuser',1,'2017-05-19 05:49:11','127.0.0.1','2017-05-18 22:49:11'),(24,1,'superuser',1,'2017-05-19 10:58:50','192.168.0.15','2017-05-19 03:58:50'),(25,1,'superuser',1,'2017-05-19 12:32:26','192.168.0.20','2017-05-19 05:32:26'),(26,1,'superuser',1,'2017-05-19 13:55:35','127.0.0.1','2017-05-19 06:55:35'),(27,1,'superuser',1,'2017-05-19 13:59:25','192.168.0.23','2017-05-19 06:59:25'),(28,1,'superuser',1,'2017-05-19 15:50:34','192.168.0.10','2017-05-19 08:50:34'),(29,1,'superuser',1,'2017-05-19 17:39:21','127.0.0.1','2017-05-19 10:39:21'),(30,1,'superuser',1,'2017-05-20 10:23:53','192.168.0.18','2017-05-20 03:23:53');
/*!40000 ALTER TABLE `log_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pokja_ulp`
--

DROP TABLE IF EXISTS `pokja_ulp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pokja_ulp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `procurement_work_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `pokja_name` varchar(100) NOT NULL,
  `pokja_nip` varchar(100) NOT NULL,
  `undangan_nomor` varchar(100) NOT NULL,
  `undangan_tanggal` date NOT NULL,
  `undang_tgl` date NOT NULL,
  `undang_jam` time NOT NULL,
  `undang_tempat` varchar(255) NOT NULL,
  `undangan_updated_at` datetime NOT NULL,
  `undangan_updated_by` varchar(100) NOT NULL,
  `penawaran_nomor` varchar(100) NOT NULL,
  `penawaran_tanggal` date NOT NULL,
  `penawaran_latest_at` datetime NOT NULL,
  `penawaran_updated_at` datetime NOT NULL,
  `penawaran_updated_by` varchar(100) NOT NULL,
  `ba_pemasukan_nomor` varchar(100) NOT NULL,
  `ba_pemasukan_tanggal` date NOT NULL,
  `ba_pemasukan_updated_at` datetime NOT NULL,
  `ba_pemasukan_updated_by` varchar(100) NOT NULL,
  `ba_pembukaan_nomor` varchar(100) NOT NULL,
  `ba_pembukaan_tanggal` date NOT NULL,
  `ba_pembukaan_updated_at` datetime NOT NULL,
  `ba_pembukaan_updated_by` varchar(100) NOT NULL,
  `ba_evaluasi_dok_nomor` varchar(100) NOT NULL,
  `ba_evaluasi_dok_tanggal` date NOT NULL,
  `ba_evaluasi_dok_harga` double NOT NULL,
  `ba_evaluasi_dok_updated_at` datetime NOT NULL,
  `ba_evaluasi_dok_updated_by` varchar(100) NOT NULL,
  `nego_nomor` varchar(100) NOT NULL,
  `nego_tanggal` date NOT NULL,
  `nego_undang_tgl` date NOT NULL,
  `nego_undang_jam` time NOT NULL,
  `nego_undang_tempat` varchar(255) NOT NULL,
  `nego_updated_at` datetime NOT NULL,
  `nego_updated_by` varchar(100) NOT NULL,
  `ba_nego_nomor` varchar(100) NOT NULL,
  `ba_nego_tanggal` date NOT NULL,
  `ba_nego_harga` double NOT NULL,
  `ba_nego_supplier_name` varchar(100) NOT NULL,
  `ba_nego_supplier_position` varchar(100) NOT NULL,
  `ba_nego_updated_at` datetime NOT NULL,
  `ba_nego_updated_by` varchar(100) NOT NULL,
  `ba_hasil_nomor` varchar(100) NOT NULL,
  `ba_hasil_tanggal` date NOT NULL,
  `ba_hasil_updated_at` datetime NOT NULL,
  `ba_hasil_updated_by` varchar(100) NOT NULL,
  `laporan_nomor` varchar(100) NOT NULL,
  `laporan_tanggal` date NOT NULL,
  `laporan_updated_at` datetime NOT NULL,
  `laporan_updated_by` varchar(100) NOT NULL,
  `ba_evaluasi_nomor` varchar(100) NOT NULL,
  `ba_evaluasi_tanggal` date NOT NULL,
  `ba_evaluasi_updated_at` datetime NOT NULL,
  `ba_evaluasi_updated_by` varchar(100) NOT NULL,
  `daftar_hadir_tanggal` date NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pokja_ulp`
--

LOCK TABLES `pokja_ulp` WRITE;
/*!40000 ALTER TABLE `pokja_ulp` DISABLE KEYS */;
/*!40000 ALTER TABLE `pokja_ulp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procurement_work_pokja`
--

DROP TABLE IF EXISTS `procurement_work_pokja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procurement_work_pokja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `procurement_work_id` int(11) NOT NULL,
  `pokja_name` varchar(100) NOT NULL,
  `pokja_nip` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procurement_work_pokja`
--

LOCK TABLES `procurement_work_pokja` WRITE;
/*!40000 ALTER TABLE `procurement_work_pokja` DISABLE KEYS */;
INSERT INTO `procurement_work_pokja` VALUES (10,3,'','','2017-05-13 16:02:34'),(11,3,'','','2017-05-13 16:02:34'),(12,3,'','','2017-05-13 16:02:34'),(25,2,'BENNY HIDAYAT','19770925 200912 1 001','2017-05-19 07:45:54'),(26,2,'YAN PERMANA','19800130 200812 1 001','2017-05-19 07:45:54'),(27,2,'SRIYONO','19811202 200912 1 003','2017-05-19 07:45:54');
/*!40000 ALTER TABLE `procurement_work_pokja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procurement_works`
--

DROP TABLE IF EXISTS `procurement_works`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procurement_works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `work_category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hps_nomor` varchar(255) NOT NULL,
  `hps_nominal` double NOT NULL,
  `hps_tanggal` date NOT NULL,
  `hps_ok` smallint(6) NOT NULL,
  `hps_ok_by` varchar(100) NOT NULL,
  `hps_ok_at` date NOT NULL,
  `work_start` date NOT NULL,
  `work_end` date NOT NULL,
  `work_days` int(11) NOT NULL,
  `work_days_type` smallint(6) NOT NULL,
  `ppk_name` varchar(100) NOT NULL,
  `ppk_nip` varchar(100) NOT NULL,
  `tahun_anggaran` varchar(4) NOT NULL,
  `sumber_pendanaan` varchar(255) NOT NULL,
  `masa_berlaku_penawaran` int(11) NOT NULL,
  `siup_penyedia` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procurement_works`
--

LOCK TABLES `procurement_works` WRITE;
/*!40000 ALTER TABLE `procurement_works` DISABLE KEYS */;
INSERT INTO `procurement_works` VALUES (2,1,'Pengadaan Kursi Makan Ruang Makan','PL.103/23/21/BP2IP.Tng-2017',172562500,'2017-02-22',1,'superuser','2017-05-16','2017-06-01','2017-06-30',35,1,'AMILIA NUR ASTUTI','19850603 201012 2 005','2017','DIPA Satker Balai Pendidikan dan Pelatihan Ilmu Pelayaran (BP2IP) Tangerang Tahun Anggaran 2017 Nomor SP DIPA-022.12.1.654603/2017 Tanggal 20 November 2016',7,'Laboratorium','2017-05-19 14:45:53','superuser','127.0.0.1','2017-05-19 08:44:15');
/*!40000 ALTER TABLE `procurement_works` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scanned_documents`
--

DROP TABLE IF EXISTS `scanned_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scanned_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_type_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `nomor` varchar(100) NOT NULL,
  `work_category_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scanned_documents`
--

LOCK TABLES `scanned_documents` WRITE;
/*!40000 ALTER TABLE `scanned_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `scanned_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spk`
--

DROP TABLE IF EXISTS `spk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `procurement_work_id` int(11) NOT NULL,
  `nomor` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_position` varchar(100) NOT NULL,
  `work_start` date NOT NULL,
  `work_end` date NOT NULL,
  `work_days` int(11) NOT NULL,
  `pemeriksaan_nomor` varchar(100) NOT NULL,
  `pemeriksaan_tanggal` date NOT NULL,
  `pemeriksaan_supplier_nomor` varchar(100) NOT NULL,
  `pemeriksaan_supplier_tanggal` date NOT NULL,
  `pemeriksaan_updated_at` datetime NOT NULL,
  `pemeriksaan_updated_by` varchar(100) NOT NULL,
  `ba_hasil_kerja_nomor` varchar(100) NOT NULL,
  `ba_hasil_kerja_tanggal` date NOT NULL,
  `ba_hasil_kerja_nama_1` varchar(100) NOT NULL,
  `ba_hasil_kerja_nip_1` varchar(100) NOT NULL,
  `ba_hasil_kerja_nama_2` varchar(100) NOT NULL,
  `ba_hasil_kerja_nip_2` varchar(100) NOT NULL,
  `ba_hasil_kerja_nama_3` varchar(100) NOT NULL,
  `ba_hasil_kerja_nip_3` varchar(100) NOT NULL,
  `ba_hasil_kerja_updated_at` datetime NOT NULL,
  `ba_hasil_kerja_updated_by` varchar(100) NOT NULL,
  `ba_serah_nomor` varchar(100) NOT NULL,
  `ba_serah_tanggal` date NOT NULL,
  `ba_serah_updated_at` datetime NOT NULL,
  `ba_serah_updated_by` varchar(100) NOT NULL,
  `ba_bayar_nomor` varchar(100) NOT NULL,
  `ba_bayar_tanggal` date NOT NULL,
  `ba_bayar_nama` varchar(100) NOT NULL,
  `ba_bayar_nip` varchar(100) NOT NULL,
  `ba_bayar_bank` varchar(100) NOT NULL,
  `ba_bayar_cabang` varchar(100) NOT NULL,
  `ba_bayar_norek` varchar(100) NOT NULL,
  `ba_bayar_updated_at` datetime NOT NULL,
  `ba_bayar_updated_by` varchar(100) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spk`
--

LOCK TABLES `spk` WRITE;
/*!40000 ALTER TABLE `spk` DISABLE KEYS */;
/*!40000 ALTER TABLE `spk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sql_log`
--

DROP TABLE IF EXISTS `sql_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sql_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `query` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_ip` varchar(20) NOT NULL,
  `xtimestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sql_log`
--

LOCK TABLES `sql_log` WRITE;
/*!40000 ALTER TABLE `sql_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `sql_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_categories`
--

DROP TABLE IF EXISTS `supplier_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_categories`
--

LOCK TABLES `supplier_categories` WRITE;
/*!40000 ALTER TABLE `supplier_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplier_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_files`
--

DROP TABLE IF EXISTS `supplier_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `file_type` varchar(30) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_files`
--

LOCK TABLES `supplier_files` WRITE;
/*!40000 ALTER TABLE `supplier_files` DISABLE KEYS */;
INSERT INTO `supplier_files` VALUES (1,1,'siup','siup_1_0.jpg','2017-05-12 14:50:12'),(2,1,'tdp','tdp_1_1.jpg','2017-05-12 14:50:12'),(3,1,'spt','spt_1_2.jpg','2017-05-12 14:50:12'),(4,1,'npwp','npwp_1_3.jpg','2017-05-12 14:50:12'),(5,1,'akta','akta_1_4.jpg','2017-05-12 14:50:12'),(6,1,'akta','akta_1_5.jpg','2017-05-12 14:50:12'),(7,1,'akta','akta_1_6.jpg','2017-05-12 14:50:12'),(8,1,'rekening','rekening_1_7.png','2017-05-12 14:50:12');
/*!40000 ALTER TABLE `supplier_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `work_category_ids` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `pic_position` varchar(100) NOT NULL,
  `value_of_capital` double NOT NULL,
  `types_of_goods` varchar(255) NOT NULL,
  `siup_category` varchar(100) NOT NULL,
  `siup_validity` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,0,'CV. DUTA ASRI JAYA','|1||2||3|','Jl. Veteran Pos 2 Gg. Delima VI Rt.002 Rw.009 Ranca Goong, Legok - Kab.Tangerang','RIAN SAIFUDDIN','DIREKTUR',1000123123,'','Perkantoran','2017-06-30','2017-05-13 22:37:21','superuser','127.0.0.1','2017-05-19 02:31:28'),(2,0,'PT. JAYA MUDA SELARAS','|1||3|','Jl. Pondok Kelapa Raya No. 4C, Pondok Kelapa - Jakarta Timur','AAAA','DIREKTUR',0,'','','0000-00-00','2017-05-19 09:37:01','superuser','127.0.0.1','2017-05-19 02:37:01');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surat_perintah_pengadaan`
--

DROP TABLE IF EXISTS `surat_perintah_pengadaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surat_perintah_pengadaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `procurement_work_id` int(11) NOT NULL,
  `nomor` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surat_perintah_pengadaan`
--

LOCK TABLES `surat_perintah_pengadaan` WRITE;
/*!40000 ALTER TABLE `surat_perintah_pengadaan` DISABLE KEYS */;
INSERT INTO `surat_perintah_pengadaan` VALUES (4,2,'PL.103/3/20/BP2IP.Tng-2017','2017-01-26',0,'2017-05-20 09:52:06','superuser','127.0.0.1','2017-05-20 02:52:06');
/*!40000 ALTER TABLE `surat_perintah_pengadaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surat_perintah_pengadaan_detail`
--

DROP TABLE IF EXISTS `surat_perintah_pengadaan_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surat_perintah_pengadaan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surat_perintah_pengadaan_id` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` double NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surat_perintah_pengadaan_detail`
--

LOCK TABLES `surat_perintah_pengadaan_detail` WRITE;
/*!40000 ALTER TABLE `surat_perintah_pengadaan_detail` DISABLE KEYS */;
INSERT INTO `surat_perintah_pengadaan_detail` VALUES (8,4,'Bahan ajar (4 modul pembelajaran)',154,'orang','2017-05-20 02:52:06');
/*!40000 ALTER TABLE `surat_perintah_pengadaan_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surat_pesanan`
--

DROP TABLE IF EXISTS `surat_pesanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surat_pesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `procurement_work_id` int(11) NOT NULL,
  `surat_perintah_pengadaan_id` int(11) NOT NULL,
  `nomor` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `pejabat_name` varchar(100) NOT NULL,
  `pejabat_nip` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surat_pesanan`
--

LOCK TABLES `surat_pesanan` WRITE;
/*!40000 ALTER TABLE `surat_pesanan` DISABLE KEYS */;
/*!40000 ALTER TABLE `surat_pesanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_division` varchar(100) NOT NULL,
  `sign_in_count` int(11) NOT NULL,
  `current_sign_in_at` datetime DEFAULT NULL,
  `last_sign_in_at` datetime DEFAULT NULL,
  `current_sign_in_ip` varchar(20) DEFAULT NULL,
  `last_sign_in_ip` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_ip` varchar(20) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `setting_clicked` tinyint(4) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,0,'superuser','UjJoMnMxMio=','Superuser','Superuser','Superuser',25,'2017-05-20 10:23:52','2017-05-19 17:39:21','192.168.0.18','127.0.0.1','0000-00-00 00:00:00','',NULL,'0000-00-00 00:00:00','',NULL,0,'2017-05-20 03:23:53'),(2,1,'admin@bp2ip.dishub.or.id','MTIzNDU2','Admin BP2IP','Admin','Admin',1,'2017-05-12 17:17:43','0000-00-00 00:00:00','127.0.0.1','','2017-05-12 17:17:29','superuser','127.0.0.1','2017-05-12 17:17:29','superuser','127.0.0.1',0,'2017-05-12 10:17:43');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_categories`
--

DROP TABLE IF EXISTS `work_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_categories`
--

LOCK TABLES `work_categories` WRITE;
/*!40000 ALTER TABLE `work_categories` DISABLE KEYS */;
INSERT INTO `work_categories` VALUES (1,'Pengadaan Barang/Jasa Nilai &le; 50 juta','2017-05-12 19:38:48','superuser','127.0.0.1','2017-05-12 12:38:48'),(2,'Pengadaan Barang Nilai > 50 jt s/d &le; 200 jt','2017-05-12 19:41:28','superuser','127.0.0.1','2017-05-12 12:41:28'),(3,'Pengadaan Barang > 200 jt & Jasa > 50 jt','2017-05-12 19:42:44','superuser','127.0.0.1','2017-05-12 12:42:44');
/*!40000 ALTER TABLE `work_categories` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-20 10:35:31
