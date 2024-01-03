-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: nekretnine
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `nekretnina`
--

DROP TABLE IF EXISTS `nekretnina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nekretnina` (
  `id` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `cijena` int NOT NULL,
  `lokacija_zupanija` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `lokacija_grad` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `adresa` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sprat` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `broj_soba` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `broj_kvadrata` int NOT NULL,
  `stanje` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `opis` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slika_url1` text COLLATE utf8mb4_general_ci,
  `slika_url2` text COLLATE utf8mb4_general_ci,
  `slika_url3` text COLLATE utf8mb4_general_ci,
  `slika_url4` text COLLATE utf8mb4_general_ci,
  `slika_url5` text COLLATE utf8mb4_general_ci,
  `slika_url6` text COLLATE utf8mb4_general_ci,
  `slika_url7` text COLLATE utf8mb4_general_ci,
  `slika_url8` text COLLATE utf8mb4_general_ci,
  `slika_url9` text COLLATE utf8mb4_general_ci,
  `slika_url10` text COLLATE utf8mb4_general_ci,
  `prodano` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vlasnik_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nekretnina_user_fk` (`vlasnik_id`),
  CONSTRAINT `nekretnina_user_fk` FOREIGN KEY (`vlasnik_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nekretnina`
--

LOCK TABLES `nekretnina` WRITE;
/*!40000 ALTER TABLE `nekretnina` DISABLE KEYS */;
INSERT INTO `nekretnina` VALUES (2,'Naziv',200,'Sarajevska županija','Sarajevo','Adresa Ulica','Visoko prizemlje','Jednosoban',33,'Novogradnja','Dvosoban stan opremljen svim potrebnim uređajima, namještajem i priključcima. Odmah useljiv, površine 66 m kvadratnih, na 4. spratu zgrade, bez lifta. Vlasništvo 1/1, bez tereta.','../assets/upload/realEstates/1695586281_img-1693138906-5f26fa3dd7d2.jpg','../assets/upload/realEstates/1695586281_img-1693138915-ae2ea27a4ce3.jpg','../assets/upload/realEstates/1695586281_img-1693138904-eafd46f908e5.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'NE',1),(3,'Stan Brcko dobro stanje',150000,'Posavska županija','Brčko','Brcko posavska ulica 13b','5','Jednoiposoban',34,'Dobro stanje','IZDAJEM APARTMAN U CENTRU GRADA\r\nMOGUCNOST NA DAN,ILI NA DUZE UZ DOGOVOR.\r\n\r\nSTAN JE U POTPUNOSTI OPREMLJEN ZA UGODAN BORAVAK  \r\n\r\nBROJ OSOBA U ISTOM JE 1+2\r\nJEDNOKREVETNA SOBA + TROSJED NA RAZVLACENJE U DNEVNOM','../assets/upload/realEstates/1695645944_img-1685016119-fce64b0a7298.jpg','../assets/upload/realEstates/1695645944_img-1685016116-78a57dea706b.jpg','../assets/upload/realEstates/1695645944_img-1685016112-0f403a30f2fb.jpg','../assets/upload/realEstates/1695645944_img-1685016115-152b2a55a861.jpg','../assets/upload/realEstates/1695645944_img-1685016113-2e1e4609bfaf.jpg',NULL,NULL,NULL,NULL,NULL,'NE',1),(4,'Tuzla romanticni stan',190000,'Tuzlanska županija','Tuzla','Ulica tuzle 22','8','Dvosoban',55,'Novogradnja','Apartman Luni se nalazi u ulici Gavrila Principa 3,Obilicevo (Mejdan) u blizini Zelenog mosta','../assets/upload/realEstates/1695646089_4dVvyi2tDE6v5ttZSo8t.jpg','../assets/upload/realEstates/1695646089_Dbz1Hj2MLUg2pn6zpuJq.jpg','../assets/upload/realEstates/1695646089_hHYD3UXKNk3RgejdRWWy.jpg','../assets/upload/realEstates/1695646089_sR8t0kDvBpVMvjBshLUm.jpg','../assets/upload/realEstates/1695646089_ZOuH2xkUek91De4OpHiR.jpg',NULL,NULL,NULL,NULL,NULL,'NE',1),(5,'Mostar stan u centru grada',120000,'Hercegovačko-neretvanska županija','Mostar','Ulica Kralja Tomislava 11','Visoko prizemlje','Jednosoban',29,'Parcijalno renoviran','Prodaje se namješten, renoviran i lijep dvosoban stan površine 57m2 na I spratu, naselje Simin Han. Stan se sastoji od dnevnog boravka, kuhinje, spavaće sobe, kupatila, hodnika i dva balkona površine 35m2. Maksimalna iskorištenost stambenog prostora, dvostrana orjentacija istok','../assets/upload/realEstates/1695646202_7QqxsHA9Ff3EK7VWnh1F.jpg','../assets/upload/realEstates/1695646202_cburqLuGMwVvu3ODxsPI.jpg','../assets/upload/realEstates/1695646202_d06A7fURMt50KGOvSBwx.jpg','../assets/upload/realEstates/1695646202_Lwebl30v3TxAGGXGUm4v.jpg','../assets/upload/realEstates/1695646202_w2Kh7vADiG5gY0OUnc5C.jpg','../assets/upload/realEstates/1695646202_Xn4YGBgjuBZrRFL84dMe.jpg',NULL,NULL,NULL,NULL,'NE',1),(6,'Stan Sarajevo lepi pogledi',210000,'Sarajevska županija','Sarajevo','Sarajevska kod Merce','14','Dvosoban',62,'Dobro stanje','rodaje se renoviran i namješten manji trosoban stan površine 65m2 na drugom spratu, naselje Kula. Stan se sastoji od dnevnog boravka, kuhinje sa trpezarijom, dvije spavaće sobe, kupatila, hodnika i ostave. Idealan raspored prostorija, maksimalno iskorišten stambeni prostor, dvostrana orjentacija jug ','../assets/upload/realEstates/1695646967_img-1695466412-b035f72aa587.jpeg','../assets/upload/realEstates/1695646967_img-1695466413-2987a09a3446.jpeg','../assets/upload/realEstates/1695646967_img-1695466417-0ece5dadf963.jpeg','../assets/upload/realEstates/1695646967_img-1695466418-59adfbcd70a6.jpeg','../assets/upload/realEstates/1695646967_img-1695466429-f6e31f285ee7.jpeg','../assets/upload/realEstates/1695646967_img-1694773875-0cdd51d2200a.jpg','../assets/upload/realEstates/1695646967_img-1694773857-80be767e0e34.jpg','../assets/upload/realEstates/1695646967_img-1695466423-96ef9689d103.jpeg',NULL,NULL,'NE',2),(7,'Moderan stan Posušje',150000,'Zapadnohercegovačka županija','Posušje','Nova Ulica 22','2','Četverosoban',65,'Novogradnja','Moderno uređen stan u posušju.','../assets/upload/realEstates/1696186928_1.jpg','../assets/upload/realEstates/1696186979_New Kitchen.jpg','../assets/upload/realEstates/1696186928_3.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'NE',9),(8,'Dvosoban, namješten stan u centru ',180000,'Hercegovačko-neretvanska županija','Mostar','Kneza Višeslava, Mostar','5','Dvosoban',66,'Renoviran','Dvosoban stan opremljen svim potrebnim uređajima, namještajem i priključcima. Odmah useljiv, površine 66 m kvadratnih, na 4. spratu zgrade, bez lifta. Vlasništvo 1/1, bez tereta.','../assets/upload/realEstates/1697626273_k1MK0KYjP5zOliq8KS9G.jpg','../assets/upload/realEstates/1697626273_LRkvQ9h6zcECHOTqvPMv.jpg','../assets/upload/realEstates/1697626273_QG3L9DeoCPa3qSbl40A7.jpg','../assets/upload/realEstates/1697626273_RIaUQfN4M4gX4JvMau8t.jpg','../assets/upload/realEstates/1697626273_2.jpg',NULL,NULL,NULL,NULL,NULL,'NE',1);
/*!40000 ALTER TABLE `nekretnina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obilazak`
--

DROP TABLE IF EXISTS `obilazak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obilazak` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nekretnina_id` int NOT NULL,
  `vlasnik_id` int NOT NULL,
  `kupac_id` int NOT NULL,
  `datum` date NOT NULL,
  `vrijeme` time NOT NULL,
  `stanje_vlasnik` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stanje_kupac` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `obilazak_nekretnina_fk` (`nekretnina_id`),
  KEY `obilazak_vlasnik_fk` (`vlasnik_id`),
  KEY `obilazak_kupac_fk` (`kupac_id`),
  CONSTRAINT `obilazak_kupac_fk` FOREIGN KEY (`kupac_id`) REFERENCES `users` (`id`),
  CONSTRAINT `obilazak_nekretnina_fk` FOREIGN KEY (`nekretnina_id`) REFERENCES `nekretnina` (`id`),
  CONSTRAINT `obilazak_vlasnik_fk` FOREIGN KEY (`vlasnik_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obilazak`
--

LOCK TABLES `obilazak` WRITE;
/*!40000 ALTER TABLE `obilazak` DISABLE KEYS */;
/*!40000 ALTER TABLE `obilazak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poruka_za_kupovinu`
--

DROP TABLE IF EXISTS `poruka_za_kupovinu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `poruka_za_kupovinu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `razgovor_id` int NOT NULL,
  `posiljatelj_id` int NOT NULL,
  `datum` date NOT NULL,
  `vrijeme` time NOT NULL,
  `poruka` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `poruka_user_fk` (`posiljatelj_id`),
  KEY `poruka_razgovor_fk` (`razgovor_id`),
  CONSTRAINT `poruka_razgovor_fk` FOREIGN KEY (`razgovor_id`) REFERENCES `razgovor_za_kupovinu` (`id`),
  CONSTRAINT `poruka_user_fk` FOREIGN KEY (`posiljatelj_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poruka_za_kupovinu`
--

LOCK TABLES `poruka_za_kupovinu` WRITE;
/*!40000 ALTER TABLE `poruka_za_kupovinu` DISABLE KEYS */;
INSERT INTO `poruka_za_kupovinu` VALUES (1,10,2,'2023-09-25','00:00:50','E mogu li kupiti imovinu'),(2,10,1,'2023-09-25','00:01:25','E mogli bi se dog. Aj na whatsapp.'),(3,10,2,'2023-09-25','01:23:13','123'),(4,10,2,'2023-09-25','01:23:56','1234'),(5,10,2,'2023-09-25','01:24:21','Kako je dobar ovaj chat u app'),(6,10,1,'2023-09-25','01:52:35','Ma ja sta stari'),(7,10,1,'2023-09-25','02:19:37','ee'),(8,10,1,'2023-09-25','02:19:39','ee'),(9,10,1,'2023-09-25','02:19:42','eeee'),(10,10,1,'2023-09-25','02:19:43','eeee'),(11,10,1,'2023-09-25','02:30:31','Nova poruka'),(12,17,7,'2023-09-25','03:45:25','123'),(13,17,7,'2023-09-25','03:48:46','Pozz mogu li pregledat nekretninu sutra'),(14,17,1,'2023-09-25','03:49:06','Naravno'),(15,18,9,'2023-10-01','20:53:23','Pozdrav. Kupio bih nekretninu'),(16,10,1,'2023-10-14','15:02:29','dasd'),(17,19,5,'2023-10-18','12:24:17','Pozdrav kupio bih nekretninu'),(18,19,5,'2023-10-18','12:24:55','Kada se mozemo naci da pregledam'),(19,19,1,'2023-10-18','12:25:31','Odgovaral u subotu 12 sati'),(20,19,5,'2023-10-18','12:25:47','Moze subota oko 6'),(21,19,1,'2023-10-18','12:25:57','Naravno. Pozz'),(22,19,5,'2023-10-18','12:26:03','lp');
/*!40000 ALTER TABLE `poruka_za_kupovinu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `razgovor_za_kupovinu`
--

DROP TABLE IF EXISTS `razgovor_za_kupovinu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `razgovor_za_kupovinu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nekretnina_id` int NOT NULL,
  `vlasnik_id` int NOT NULL,
  `kupac_id` int NOT NULL,
  `datum` date NOT NULL,
  `vrijeme` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `razgovor_nekretnina_fk` (`nekretnina_id`),
  KEY `razgovor_vlasnik_fk` (`vlasnik_id`),
  KEY `razgovor_kupac_fk` (`kupac_id`),
  CONSTRAINT `razgovor_kupac_fk` FOREIGN KEY (`kupac_id`) REFERENCES `users` (`id`),
  CONSTRAINT `razgovor_nekretnina_fk` FOREIGN KEY (`nekretnina_id`) REFERENCES `nekretnina` (`id`),
  CONSTRAINT `razgovor_vlasnik_fk` FOREIGN KEY (`vlasnik_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `razgovor_za_kupovinu`
--

LOCK TABLES `razgovor_za_kupovinu` WRITE;
/*!40000 ALTER TABLE `razgovor_za_kupovinu` DISABLE KEYS */;
INSERT INTO `razgovor_za_kupovinu` VALUES (10,2,1,2,'2023-09-24','22:50:00'),(17,2,1,7,'2023-09-25','03:42:26'),(18,3,1,9,'2023-10-01','20:51:09'),(19,3,1,5,'2023-10-18','12:24:04');
/*!40000 ALTER TABLE `razgovor_za_kupovinu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `korisnicko_ime` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` text COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `puno_ime` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `zupanija` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `grad` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `telefon` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profile_picture_url` text COLLATE utf8mb4_general_ci NOT NULL,
  `isAdmin` int DEFAULT NULL,
  `isAgency` int DEFAULT NULL,
  `isUser` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'agencijaRamljak','202cb962ac59075b964b07152d234b70','ramljak1004@gmail.com','Agencija Ramljak','Unsko-sanska županija','Bihać','063-333222','../assets/upload/profiles/1695604402_sarajevo.jpg',1,1,0),(2,'agencijaBakula','202cb962ac59075b964b07152d234b70','jbakula@gmail.com','Agencija Bakula \"Posušje\"','Zapadnohercegovačka županija','Posušje',NULL,'../assets/upload/profiles/agencijaBakula.png',0,1,1),(5,'agencijaTomas','202cb962ac59075b964b07152d234b70','tomas@gmail.com','Agencija Tomas','Zapadnohercegovačka županija','Grude','063-444-555','',0,1,1),(6,'agencijaVTZ','202cb962ac59075b964b07152d234b70','vinkotino@gmail.com','Agencija \"VTZ\"','Zapadnohercegovačka županija','Posušje','063-655-655','',0,1,1),(7,'UserKupac','202cb962ac59075b964b07152d234b70','newmail@gmail.com','Ivan Ivanovic','Zapadnohercegovačka županija','Široki Brijeg','063-434-434','../assets/upload/profiles/1695605893_newuser.jpg',0,0,1),(9,'korisnikIme123','e10adc3949ba59abbe56e057f20f883e','korisnik@gmail.com','Novi Korisnik','Hercegovačko-neretvanska županija','Mostar','063-123-123','../assets/upload/profiles/1696185869_newuser.jpg',0,1,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-18 14:43:56
