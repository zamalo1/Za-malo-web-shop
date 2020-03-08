-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: webstore
-- ------------------------------------------------------
-- Server version	5.7.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'laptopov'),(2,'Racunari'),(3,'monitori'),(4,'misevi'),(5,'stampaci'),(6,'tastature'),(15,'Zvucnici');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `text` varchar(256) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=133 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (13,'zamalo','Sat-02-20 00:37:40','kgkgjkgkgjkgkgk',18),(11,'Dukic123','Sat-02-20 00:37:10','fdfadfdaafdafafdadf',20),(12,'zamalo','Sat-02-20 00:37:40','kgkgjkgkgjkgkgk',18),(6,'Dukic123','Sat-02-20 00:22:42','Do jaja je monitor, evo pet komada cu sutra da kupim. Imam pare bole me kurac',18),(7,'Dukic123','Sat-02-20 00:34:38','Do jaja je monitor, evo pet komada cu sutra da kupim. Imam pare bole me kurac',18),(14,'zamalo','Sat-02-20 00:37:40','kgkgjkgkgjkgkgk',18),(15,'zamalo','Sat-02-20 00:37:40','kgkgjkgkgjkgkgk',18),(16,'zamalo','Sat-02-20 00:37:40','kgkgjkgkgjkgkgk',18),(17,'zamalo','Sat-02-20 00:37:40','kgkgjkgkgjkgkgk',18),(21,'zamalo','Sat-02-20 01:09:39','Govno od misa!',14),(19,'zamalo','Sat-02-20 01:07:03','Sranje mis, nikad nista gore nisam kupiJO',14),(24,'zamalo','Sat-02-20 01:12:44','Govno od misa!',12),(25,'zamalo','Sat-02-20 01:12:56','Sranje mis, nikad nista gore nisam kupiJO',12),(33,'Dukic123','Sat-02-20 03:28:35','gdddddddddddddddddddddddddddddddddd',199),(32,'Mirkoalkos','Sat-02-20 03:20:25','Sranje mis, nikad nista gore nisam kupiJO',12),(30,'zamalo','Sat-02-20 01:50:27','Sranje tastatura, nikad nista gore nisam kupiJO',203),(34,'zamalo','Sat-02-20 03:30:19','adggag gag a ga  ga ga d ',199),(36,'Mirkoalkos','Mon-02-20 01:54:04','fsd',203),(37,'Mirkoalkos','Mon-02-20 01:54:10','asdffd',203),(38,'Mirkoalkos','Mon-02-20 01:54:11','adfasdfasd',203),(40,'Mirkoalkos','Mon-02-20 01:54:14','afdsfasdf',203),(91,'Dukic123','Sat-03-20 01:47:27','jjjiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii',9),(42,'Mirkoalkos','Mon-02-20 01:54:17','asdfasdfsdf',203),(44,'Mirkoalkos','Mon-02-20 02:07:31','hhhhhhhhhhhhh',9),(90,'Dukic123','Sat-03-20 01:47:22','jjjjjjjjjjjjjjjjjjjjjjjjjj',9),(89,'Dukic123','Sat-03-20 01:46:50','gggggggg',9),(47,'Mirkoalkos','Mon-02-20 02:07:45','gafgdgadgadgadgg',9),(110,'zamalo','Sat-03-20 02:42:00','vcbbc',9),(111,'zamalo','Sat-03-20 02:42:00',' dgfgd',9),(113,'zamalo','Sat-03-20 02:43:16','fdd',9),(104,'zamalo','Sat-03-20 02:41:08','jhhjhj',9),(73,'Dukic123','Sat-03-20 00:28:13','ssssssssssaaaaaaaaaaaaaaaaaaaa',12),(127,'zamalo','Sat-03-20 02:47:02','asdad',9);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `like_comment`
--

DROP TABLE IF EXISTS `like_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `like_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=343 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `like_comment`
--

LOCK TABLES `like_comment` WRITE;
/*!40000 ALTER TABLE `like_comment` DISABLE KEYS */;
INSERT INTO `like_comment` VALUES (321,24,'','like'),(322,24,'','like'),(323,24,'','like'),(324,70,'Dukic123','unlike'),(325,69,'Dukic123','unlike'),(326,92,'zamalo','unlike'),(327,13,'','like'),(328,13,'','like'),(329,13,'','like'),(330,12,'','like'),(331,12,'','like'),(319,25,'Dukic123','like'),(320,32,'Dukic123','unlike'),(318,24,'Dukic123','like'),(332,12,'','like'),(333,6,'','like'),(334,13,'','like'),(335,12,'','like'),(336,6,'','like'),(337,13,'','like'),(338,13,'zamalo','unlike'),(339,12,'zamalo','like'),(340,7,'zamalo','unlike'),(341,6,'zamalo','like'),(342,14,'zamalo','like');
/*!40000 ALTER TABLE `like_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `type` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=194 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (18,200,'zamalo',NULL),(10,17,'zamalo',NULL),(17,202,'zamalo',NULL),(16,197,'zamalo',NULL),(67,17,'Mirkoalkos',NULL),(29,199,'Mirkoalkos',NULL),(31,191,'Mirkoalkos',NULL),(177,9,'Mirkoalkos',NULL),(74,201,'Dukic123',NULL),(46,191,'zamalo',NULL),(187,18,'zamalo',NULL),(44,5,'zamalo',NULL),(50,191,'Dukic123',NULL),(52,186,'Dukic123',NULL),(103,190,'Dukic123',NULL),(57,17,'Dukic123',NULL),(73,18,'Dukic123',NULL),(182,20,'zamalo',NULL),(188,14,'zamalo',NULL),(82,5,'Dukic123',NULL),(191,203,'zamalo',NULL),(127,14,'Mirkoalkos',NULL),(146,20,'Mirkoalkos',NULL),(172,202,'Mirkoalkos',NULL),(174,203,'Mirkoalkos',NULL),(192,9,'Dukic123',NULL),(193,14,'Dukic123',NULL);
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `price` varchar(128) DEFAULT NULL,
  `images` varchar(128) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (5,'Altos Home, AMD A8-76804GBSSD 240GBRadeon R7DVD','20000','desctop2.jpg',2),(9,'Monitor 18.5 Asus VS197DE TN, 1366x768 (HD Ready) 5ms','20000','monitor2.jpg',1),(12,'Miš USB Altos MO-040, PIXART 7515 1000dpi black mouse ','1920','mis1.jpg',1),(14,'Miš USB Hama  86524 AM-100, Optical Crna, 86524 Za Malo shop','30000','mis3.jpg',4),(17,'Stampac Laser A4 HP M203dw, 1200x1200dpi 28ppm 256MB USB duplex Wifi','20000','stampac2.jpg',5),(18,'Stampac Laser A4 Samsung SL-M2026, 1200x1200dpi 20ppm 8MB','2000','stampac3.jpg',5),(20,'Laptop HP 15 15.6HD AG,AMD DC A4-91204GB500GBRadeon R3','2000','laptop8.jpg',1),(203,'Tastatura USB US Mionix Zibal, mehanicka','1212','bezmalo.jpg',6),(204,'Tastatura USB US Logitech K120 OEM','4800','tastatura23.jpg',6),(199,'Stampac Laser A4 Xerox Phaser 3020bi, 1200dpi 20ppm 128MB Wifi','2300','MAAAAZALOkonj.jpg',5),(200,'Å tampaÄ Laser A4 Xerox Phaser 3020bi, 1200dpi 20ppm 128MB Wiifi','2300','MAAAAZALOkonj.jpg',5),(202,'Tastatura USB US Redragon Kumara K552, mehaniÄka','1212','tastatura23.jpg',6),(191,'Laptop Acer Nitro Spin NP515-51-53P5 Win10 15.6,Intel i5-8250U8GB256SSDGTX 1050 ','20000','laptop2.jpg',1),(201,'Tastatura+miÅ¡ wireless US Logitech MK220','1212','tastatura23.jpg',6),(197,'Stampac Laser A4 HP M15w, 600x600dpi 16MB, WiFi','3000','Stampac aa.jpg',5),(192,'Laptop Lenovo IdeaPad L340 Gaming 15.6,Intel QC i5-9300H16GB1TB128 SSDGTX 1650 4G','20000','laptop8.jpg',1),(190,'Laptop Lenovo IdeaPad L340 Gaming 15.6FHD,Intel QC i5-9300H8GB256 SSDGTX 1050 3GB','30500','laptop766.jpg',1),(186,'Tastatura USB US Natec R33','2000','tastatura8.jpg',6);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='		';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Marko','Cvetic','zamalo','zamaloman@gmail.com','0638190811'),(10,'marko','Dukic','sara12','budozelja@gmail.com','Dolceikebana1'),(4,'Mirko','Cvetic','Mirkoalkos','mirkoalkos@gmail.com','tocenopivo'),(9,'marko','savovic','savovic123','savovic@gmail.com','Mareza95'),(8,'Mimi','Dukic','Dukic123','prohibitiontime@gmail.com','Mimi123');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-08 13:03:29
