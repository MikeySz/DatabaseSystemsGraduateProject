-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: imc.kean.edu    Database: 2022F_sanchem1
-- ------------------------------------------------------
-- Server version	5.5.39-MariaDB

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
-- Table structure for table `CUSTOMER`
--

DROP TABLE IF EXISTS `CUSTOMER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CUSTOMER` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `TEL` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `zipcode` char(5) NOT NULL,
  `state` char(2) NOT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `login_id` (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CUSTOMER`
--

LOCK TABLES `CUSTOMER` WRITE;
/*!40000 ALTER TABLE `CUSTOMER` DISABLE KEYS */;
INSERT INTO `CUSTOMER` VALUES (1,'Mikey','password','Michael','Sanchez','8485551000','Monmouth Ave','Asbury Park','07712','NJ'),(2,'Penguin','pass123','Michael','Sanchez','8485551000','Asbury Ave','Asbury Park','07712','NJ'),(3,'Train','1234','Joe','Smith','333656010','Hollywood Ave','Los Angeles','90001','CA'),(7,'Dog','1234','Rando','Neutral','3334441992','Some Street','New City','12099','CA'),(8,'Monkey','1234','Winston','PB','2939490220','New Street','Old City  ','08899','AL'),(9,'Key','heart','Roxas','Nobody','3899290488','Castle Oblivion','Kingdom','02292','DC'),(10,'2022','3','New','Tester2','3333','222 Morris Ave','Union','90017','IN');
/*!40000 ALTER TABLE `CUSTOMER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Courses`
--

DROP TABLE IF EXISTS `Courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Courses` (
  `cid` varchar(8) NOT NULL,
  `name` varchar(30) NOT NULL,
  `credits` int(11) NOT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `cid` (`cid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Courses`
--

LOCK TABLES `Courses` WRITE;
/*!40000 ALTER TABLE `Courses` DISABLE KEYS */;
INSERT INTO `Courses` VALUES ('CPS1231','Java1',4),('CPS2231','Java2',4),('CPS2232','Data Structure',4),('CPS3500','Web Programming',3),('CPS3740','Database Introduction',3),('CPS5740','Database Systems',3),('CPS5921','Data Mining',3);
/*!40000 ALTER TABLE `Courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HW2_Concurrency`
--

DROP TABLE IF EXISTS `HW2_Concurrency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HW2_Concurrency` (
  `Time_id` int(11) NOT NULL AUTO_INCREMENT,
  `T1` varchar(255) DEFAULT NULL,
  `T2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Time_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HW2_Concurrency`
--

LOCK TABLES `HW2_Concurrency` WRITE;
/*!40000 ALTER TABLE `HW2_Concurrency` DISABLE KEYS */;
INSERT INTO `HW2_Concurrency` VALUES (1,'START TRANSACTION;',''),(2,'','START TRANSACTION;'),(3,'SELECT * FROM HW2_test2 WHERE name = \"Tom\" LOCK IN SHARE MODE;',''),(4,'','UPDATE HW2_test2 SET name=\"Tom1\" WHERE name = \"Tom\";'),(5,'UPDATE HW2_test2 SET name=\"Tom1\" WHERE name = \"Tom\";',''),(6,'','ERROR 1213(40001) : Deadlock found when trying to get lock; try restarting transaction');
/*!40000 ALTER TABLE `HW2_Concurrency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HW2_test1`
--

DROP TABLE IF EXISTS `HW2_test1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HW2_test1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HW2_test1`
--

LOCK TABLES `HW2_test1` WRITE;
/*!40000 ALTER TABLE `HW2_test1` DISABLE KEYS */;
INSERT INTO `HW2_test1` VALUES (1,'Union1',100,3),(2,'Union2',11.8,3),(3,'Union1',100,3),(4,'Union2',11.8,3),(5,'Union1',100,3),(6,'Union2',11.8,3);
/*!40000 ALTER TABLE `HW2_test1` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`sanchem1`@`%`*/ /*!50003 TRIGGER HW2_test_AFTER_INSERT
AFTER INSERT ON HW2_test1
FOR EACH ROW
BEGIN
INSERT INTO HW2_test_audit
(tid,user,access_time,new_price,note) values
(NEW.id, USER(), NOW(),NEW.price, 'after insert operation' );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`sanchem1`@`%`*/ /*!50003 TRIGGER HW2_test_BEFORE_UPDATE
BEFORE UPDATE ON HW2_test1
FOR EACH ROW
BEGIN
IF old.name <> new.name THEN
signal sqlstate '45000' set message_text = 'Cannot update the name!';
else
INSERT INTO HW2_test_audit
(tid,user,access_time,old_price, new_price, note) values
(OLD.id, USER(), NOW(), OLD.price, NEW.price, concat("update item ",old.name) );
END IF;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`sanchem1`@`%`*/ /*!50003 TRIGGER HW2_test_BEFORE_DELETE
BEFORE DELETE ON HW2_test1
FOR EACH ROW
BEGIN
INSERT INTO HW2_test_audit
(tid,user,access_time,note) values
(OLD.id, USER(), NOW(), concat("Cannot delete the item ",old.name) );
signal sqlstate '45000' set message_text = 'Error! Deletion not allowed!';
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `HW2_test2`
--

DROP TABLE IF EXISTS `HW2_test2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HW2_test2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  `salary` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HW2_test2`
--

LOCK TABLES `HW2_test2` WRITE;
/*!40000 ALTER TABLE `HW2_test2` DISABLE KEYS */;
INSERT INTO `HW2_test2` VALUES (1,'Tom',120.5),(2,'Jerry',1000);
/*!40000 ALTER TABLE `HW2_test2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HW2_test_audit`
--

DROP TABLE IF EXISTS `HW2_test_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HW2_test_audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) DEFAULT NULL,
  `user` varchar(30) DEFAULT NULL,
  `access_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `old_price` float DEFAULT NULL,
  `new_price` float DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HW2_test_audit`
--

LOCK TABLES `HW2_test_audit` WRITE;
/*!40000 ALTER TABLE `HW2_test_audit` DISABLE KEYS */;
INSERT INTO `HW2_test_audit` VALUES (1,1,'austin@131.125.80.108','2022-11-19 17:51:08',NULL,100,'after insert operation'),(2,2,'austin@131.125.80.108','2022-11-19 17:51:08',NULL,100,'after insert operation'),(3,1,'austin@131.125.80.108','2022-11-19 17:51:08',NULL,NULL,'Cannot delete the item Union1'),(4,2,'austin@131.125.80.108','2022-11-19 17:51:08',100,11.8,'update item Union2'),(5,3,'austin@131.125.80.108','2022-12-06 17:52:03',NULL,100,'after insert operation'),(6,4,'austin@131.125.80.108','2022-12-06 17:52:03',NULL,100,'after insert operation'),(7,1,'austin@131.125.80.108','2022-12-06 17:52:03',NULL,NULL,'Cannot delete the item Union1'),(8,2,'austin@131.125.80.108','2022-12-06 17:52:03',11.8,11.8,'update item Union2'),(9,4,'austin@131.125.80.108','2022-12-06 17:52:03',100,11.8,'update item Union2'),(10,5,'austin@131.125.80.108','2022-12-17 14:54:25',NULL,100,'after insert operation'),(11,6,'austin@131.125.80.108','2022-12-17 14:54:25',NULL,100,'after insert operation'),(12,1,'austin@131.125.80.108','2022-12-17 14:54:25',NULL,NULL,'Cannot delete the item Union1'),(13,2,'austin@131.125.80.108','2022-12-17 14:54:25',11.8,11.8,'update item Union2'),(14,4,'austin@131.125.80.108','2022-12-17 14:54:25',11.8,11.8,'update item Union2'),(15,6,'austin@131.125.80.108','2022-12-17 14:54:25',100,11.8,'update item Union2');
/*!40000 ALTER TABLE `HW2_test_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MyStaff`
--

DROP TABLE IF EXISTS `MyStaff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MyStaff` (
  `staffNo` varchar(5) NOT NULL,
  `fName` varchar(15) NOT NULL,
  `lName` varchar(15) NOT NULL,
  `position` varchar(25) DEFAULT NULL,
  `sex` char(1) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `salary` decimal(8,2) DEFAULT NULL,
  `branchNo` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MyStaff`
--

LOCK TABLES `MyStaff` WRITE;
/*!40000 ALTER TABLE `MyStaff` DISABLE KEYS */;
INSERT INTO `MyStaff` VALUES ('SA9','Mary','Howe','Assistant','F','1970-02-19',9001.00,'B007'),('SG14','David','Ford','Supervisor','M','1958-03-24',18000.00,'B003'),('SG37','Ann','Beech','Assistant','F','1960-11-10',12000.00,'B003'),('SG5','Susan','Brand','Manager','F','1940-06-03',24000.00,'B003'),('SL21','John','White','Manager','M','1945-10-01',30000.00,'B005'),('SL41','Julie','Lee','Assistant','F','1965-06-13',9000.00,'B005');
/*!40000 ALTER TABLE `MyStaff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ORDERS`
--

DROP TABLE IF EXISTS `ORDERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ORDERS` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `ORDERS_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `CUSTOMER` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ORDERS`
--

LOCK TABLES `ORDERS` WRITE;
/*!40000 ALTER TABLE `ORDERS` DISABLE KEYS */;
INSERT INTO `ORDERS` VALUES (1,1,'2022-12-05 19:08:48'),(2,3,'2022-11-06 08:48:13'),(3,1,'2022-12-05 19:16:27'),(4,7,'2022-11-28 08:48:13'),(5,8,'2022-11-27 08:48:13'),(13,1,'2022-12-05 19:38:10'),(15,9,'2022-12-05 19:44:14'),(16,9,'2022-12-06 18:26:24'),(17,10,'2022-12-10 21:03:14');
/*!40000 ALTER TABLE `ORDERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PRODUCT`
--

DROP TABLE IF EXISTS `PRODUCT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PRODUCT` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `sell_price` decimal(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `vendor_id` (`vendor_id`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `PRODUCT_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `CPS5740`.`VENDOR` (`vendor_id`),
  CONSTRAINT `PRODUCT_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `CPS5740`.`EMPLOYEE2` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PRODUCT`
--

LOCK TABLES `PRODUCT` WRITE;
/*!40000 ALTER TABLE `PRODUCT` DISABLE KEYS */;
INSERT INTO `PRODUCT` VALUES (1,'Apple\'s Latest Phone Released!','IPhone 14 Mini',1100,350.00,499.99,0,2),(2,'The latest Mac Book released.','Mac Book Air 2022',1001,700.00,999.99,8,1),(3,'Apple\'s TV Streaming device','Apple TV+',1003,150.00,350.55,6,2),(4,'All Smartphone from Google!','Google Pixel 7 Pro',1333,350.50,649.99,3,1),(5,'Samsung\'s Flasship Phone!','Samsung Galaxy S22',1111,399.99,600.00,12,1),(6,'A pack of gel pens.3','Gel Pen 10-Pack',1004,3.50,5.99,25,5),(7,'waterproof action camera.','GoPro HERO 11',1555,250.00,500.00,3,1),(8,'SUV car made by Toyota','Toyota Rav 4',1333,10000.00,25000.00,6,2),(9,'Classic Video Game console','Nintendo 64',1100,111.00,250.00,1,5),(10,'this is a new test','new',1666,100.00,334.00,43,5);
/*!40000 ALTER TABLE `PRODUCT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PRODUCT_ORDER`
--

DROP TABLE IF EXISTS `PRODUCT_ORDER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PRODUCT_ORDER` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `PRODUCT_ORDER_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `ORDERS` (`order_id`),
  CONSTRAINT `PRODUCT_ORDER_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `PRODUCT` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PRODUCT_ORDER`
--

LOCK TABLES `PRODUCT_ORDER` WRITE;
/*!40000 ALTER TABLE `PRODUCT_ORDER` DISABLE KEYS */;
INSERT INTO `PRODUCT_ORDER` VALUES (1,1,2),(1,3,1),(3,2,2),(3,4,1),(13,1,2),(15,4,1),(2,6,25),(2,5,2),(2,4,1),(4,2,1),(5,6,6),(16,7,1),(17,1,2),(17,3,3);
/*!40000 ALTER TABLE `PRODUCT_ORDER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `People`
--

DROP TABLE IF EXISTS `People`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `People` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `People`
--

LOCK TABLES `People` WRITE;
/*!40000 ALTER TABLE `People` DISABLE KEYS */;
/*!40000 ALTER TABLE `People` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Product`
--

DROP TABLE IF EXISTS `Product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Product` (
  `id` int(11) NOT NULL,
  `Name` varchar(20) DEFAULT NULL,
  `Price` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Product`
--

LOCK TABLES `Product` WRITE;
/*!40000 ALTER TABLE `Product` DISABLE KEYS */;
INSERT INTO `Product` VALUES (0,'Cardboard Box',3.5),(1,'Chair',12.5),(2,'Magnets',2.99);
/*!40000 ALTER TABLE `Product` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`sanchem1`@`%`*/ /*!50003 TRIGGER before_product_update
BEFORE UPDATE ON Product
FOR EACH ROW
BEGIN
INSERT INTO ProductAudit
(Pid,User_name,Action,Pname,Changed_date) values
(OLD.id, USER(), 'update',OLD.Name, NOW() );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `ProductAudit`
--

DROP TABLE IF EXISTS `ProductAudit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProductAudit` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Pid` int(11) DEFAULT NULL,
  `User_name` varchar(20) DEFAULT NULL,
  `Action` varchar(20) DEFAULT NULL,
  `PName` varchar(20) DEFAULT NULL,
  `Changed_date` date DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProductAudit`
--

LOCK TABLES `ProductAudit` WRITE;
/*!40000 ALTER TABLE `ProductAudit` DISABLE KEYS */;
INSERT INTO `ProductAudit` VALUES (1,0,'sanchem1@131.125.80.','update','Cardboard Box','2022-10-20');
/*!40000 ALTER TABLE `ProductAudit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Shape`
--

DROP TABLE IF EXISTS `Shape`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Shape` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `g` geometry NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Shape`
--

LOCK TABLES `Shape` WRITE;
/*!40000 ALTER TABLE `Shape` DISABLE KEYS */;
INSERT INTO `Shape` VALUES (1,'Test1','\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0$@\0\0\0\0\0\0\0\0\0\0\0\0\0\0$@\0\0\0\0\0\0$@\0\0\0\0\0\0\0\0\0\0\0\0\0\0$@\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0'),(2,'Test2','\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0Y@\0\0\0\0\0\0\0\0\0\0\0\0\0\0Y@\0\0\0\0\0\0Y@\0\0\0\0\0\0\0\0\0\0\0\0\0\0Y@\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0');
/*!40000 ALTER TABLE `Shape` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Students`
--

DROP TABLE IF EXISTS `Students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Students` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `birthday` date NOT NULL,
  `major` varchar(15) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  PRIMARY KEY (`sid`),
  UNIQUE KEY `sid` (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=1031 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Students`
--

LOCK TABLES `Students` WRITE;
/*!40000 ALTER TABLE `Students` DISABLE KEYS */;
INSERT INTO `Students` VALUES (1001,'Austin','Huang','1990-01-01','CS','07123'),(1002,'Mary','Smith','1976-02-08','IT','08348'),(1003,'Claudia','Lee','1987-03-21','Math','91384'),(1004,'Andrew','Lin','1947-08-25','Biology','07101'),(1005,'Helen','Wu','1997-01-25','CS','07083'),(1007,'Sarah','Lee','1995-09-15','IT','04101'),(1008,'Andrew','Huang','1988-01-15','Nursing','07101'),(1009,'Ray','Ho','1985-09-15','CS','08134'),(1010,'Eric','Smith','1983-03-11','CS','08034'),(1011,'Judy','Lin','1987-03-11','CS','07034'),(1012,'Susan','Wang','1989-09-01','CS','07834'),(1013,'Simon','Ku','1994-12-21','CS','07824'),(1014,'Frank','Fisher','1995-03-15','CS','07800'),(1015,'Grace','Ham','1994-08-12','CS','07701'),(1016,'Joyce','Cooper','1992-02-14','CS','07781'),(1030,'Brian','Lee','1995-12-23','CS','10783');
/*!40000 ALTER TABLE `Students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Students_Courses`
--

DROP TABLE IF EXISTS `Students_Courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Students_Courses` (
  `sid` int(11) NOT NULL,
  `cid` varchar(8) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `grade` char(2) NOT NULL,
  PRIMARY KEY (`sid`,`cid`,`year`,`semester`),
  KEY `cid` (`cid`),
  CONSTRAINT `Students_Courses_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `Students` (`sid`),
  CONSTRAINT `Students_Courses_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `Courses` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Students_Courses`
--

LOCK TABLES `Students_Courses` WRITE;
/*!40000 ALTER TABLE `Students_Courses` DISABLE KEYS */;
INSERT INTO `Students_Courses` VALUES (1001,'CPS2231',2013,'Fall','A-'),(1001,'CPS2232',2016,'Fall','C+'),(1001,'CPS3500',2017,'Spring','C+'),(1003,'CPS2231',2015,'Spring','A'),(1003,'CPS5740',2016,'Fall','C'),(1003,'CPS5921',2016,'Spring','B'),(1004,'CPS2231',2014,'Spring','A-'),(1004,'CPS2232',2014,'Spring','B+'),(1005,'CPS2231',2016,'Spring','A'),(1007,'CPS2231',2015,'Spring','B'),(1007,'CPS3740',2014,'Fall','A'),(1008,'CPS2232',2014,'Spring','F'),(1009,'CPS2232',2014,'Fall','F'),(1009,'CPS2232',2015,'Fall','A'),(1009,'CPS3740',2011,'Fall','B-'),(1011,'CPS3500',2017,'Spring','C+'),(1012,'CPS2231',2016,'Spring','B'),(1013,'CPS2231',2016,'Spring','B'),(1014,'CPS2231',2016,'Spring','B'),(1016,'CPS2231',2015,'Spring','F'),(1016,'CPS2232',2015,'Fall','A'),(1030,'CPS3740',2017,'Fall','');
/*!40000 ALTER TABLE `Students_Courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `acct_num` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (137,14.98),(141,1937.50),(97,-100.00);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`sanchem1`@`%`*/ /*!50003 TRIGGER ins_sum BEFORE INSERT ON account
FOR EACH ROW SET @sum = @sum + NEW.amount */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES (7,NULL);
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `vBranch_count`
--

DROP TABLE IF EXISTS `vBranch_count`;
/*!50001 DROP VIEW IF EXISTS `vBranch_count`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vBranch_count` (
  `branchno` tinyint NOT NULL,
  `ct` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vMax_payment_students`
--

DROP TABLE IF EXISTS `vMax_payment_students`;
/*!50001 DROP VIEW IF EXISTS `vMax_payment_students`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vMax_payment_students` (
  `first_name` tinyint NOT NULL,
  `last_name` tinyint NOT NULL,
  `total_amount` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vMissing_prerequisite`
--

DROP TABLE IF EXISTS `vMissing_prerequisite`;
/*!50001 DROP VIEW IF EXISTS `vMissing_prerequisite`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vMissing_prerequisite` (
  `first_name` tinyint NOT NULL,
  `last_name` tinyint NOT NULL,
  `cid` tinyint NOT NULL,
  `missing_prequistes` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vMissing_year_students`
--

DROP TABLE IF EXISTS `vMissing_year_students`;
/*!50001 DROP VIEW IF EXISTS `vMissing_year_students`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vMissing_year_students` (
  `sid` tinyint NOT NULL,
  `first_name` tinyint NOT NULL,
  `last_name` tinyint NOT NULL,
  `missing_years` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vOverloaded_students`
--

DROP TABLE IF EXISTS `vOverloaded_students`;
/*!50001 DROP VIEW IF EXISTS `vOverloaded_students`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vOverloaded_students` (
  `first_name` tinyint NOT NULL,
  `last_name` tinyint NOT NULL,
  `year` tinyint NOT NULL,
  `number_of_courses` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vStaff_female`
--

DROP TABLE IF EXISTS `vStaff_female`;
/*!50001 DROP VIEW IF EXISTS `vStaff_female`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vStaff_female` (
  `staffNo` tinyint NOT NULL,
  `fName` tinyint NOT NULL,
  `lName` tinyint NOT NULL,
  `position` tinyint NOT NULL,
  `sex` tinyint NOT NULL,
  `DOB` tinyint NOT NULL,
  `salary` tinyint NOT NULL,
  `branchNo` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vSum_payment_students`
--

DROP TABLE IF EXISTS `vSum_payment_students`;
/*!50001 DROP VIEW IF EXISTS `vSum_payment_students`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vSum_payment_students` (
  `first_name` tinyint NOT NULL,
  `last_name` tinyint NOT NULL,
  `total_amount` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vTest`
--

DROP TABLE IF EXISTS `vTest`;
/*!50001 DROP VIEW IF EXISTS `vTest`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vTest` (
  `sex` tinyint NOT NULL,
  `ct` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vTop_Course_count`
--

DROP TABLE IF EXISTS `vTop_Course_count`;
/*!50001 DROP VIEW IF EXISTS `vTop_Course_count`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vTop_Course_count` (
  `name` tinyint NOT NULL,
  `mycount` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vBranch_count`
--

/*!50001 DROP TABLE IF EXISTS `vBranch_count`*/;
/*!50001 DROP VIEW IF EXISTS `vBranch_count`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`sanchem1`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vBranch_count` AS select `MyStaff`.`branchNo` AS `branchno`,count(0) AS `ct` from `MyStaff` group by `MyStaff`.`branchNo` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vMax_payment_students`
--

/*!50001 DROP TABLE IF EXISTS `vMax_payment_students`*/;
/*!50001 DROP VIEW IF EXISTS `vMax_payment_students`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`sanchem1`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vMax_payment_students` AS select `s`.`first_name` AS `first_name`,`s`.`last_name` AS `last_name`,(sum(`c`.`credits`) * 100) AS `total_amount` from ((`Students` `s` join `Students_Courses` `sc` on((`s`.`sid` = `sc`.`sid`))) join `Courses` `c` on((`sc`.`cid` = `c`.`cid`))) group by `s`.`sid` having `total_amount` in (select max(`vSum_payment_students`.`total_amount`) from `vSum_payment_students`) order by `s`.`first_name` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vMissing_prerequisite`
--

/*!50001 DROP TABLE IF EXISTS `vMissing_prerequisite`*/;
/*!50001 DROP VIEW IF EXISTS `vMissing_prerequisite`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`sanchem1`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vMissing_prerequisite` AS select `s`.`first_name` AS `first_name`,`s`.`last_name` AS `last_name`,group_concat(`sc`.`cid` separator ',') AS `cid`,(case when (`sc`.`cid` = 'CPS3500') then 'CPS2232, CPS2231' when (`sc`.`cid` = 'CPS2232') then 'CPS2231' when ((`sc`.`cid` = 'CPS2231') and (`sc`.`cid` = 'CPS3500')) then 'CPS2232' else 'No prequistes' end) AS `missing_prequistes` from (`Students_Courses` `sc` join `Students` `s` on((`sc`.`sid` = `s`.`sid`))) where ((`sc`.`grade` <> 'F') and (`sc`.`cid` in ('CPS2231','CPS2232','CPS3500'))) group by `s`.`sid` having ((`cid` = 'CPS2232') or (`cid` = 'CPS3500')) union select `s`.`first_name` AS `first_name`,`s`.`last_name` AS `last_name`,group_concat(`sc`.`cid` separator ',') AS `cid`,(case when (`sc`.`cid` = 'CPS3500') then 'CPS2232, CPS2231' when (`sc`.`cid` = 'CPS2232') then 'CPS2231' when ((`sc`.`cid` = 'CPS2231') and (`sc`.`cid` = 'CPS3500')) then 'CPS2232' else 'No prequistes' end) AS `missing_prequistes` from (`Students_Courses` `sc` join `Students` `s` on((`sc`.`sid` = `s`.`sid`))) where (`sc`.`cid` in ('CPS2231','CPS2232','CPS3500')) group by `s`.`sid` having ((`cid` = 'CPS2232') or (`cid` = 'CPS3500')) order by `cid` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vMissing_year_students`
--

/*!50001 DROP TABLE IF EXISTS `vMissing_year_students`*/;
/*!50001 DROP VIEW IF EXISTS `vMissing_year_students`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`sanchem1`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vMissing_year_students` AS select `s`.`sid` AS `sid`,`s`.`first_name` AS `first_name`,`s`.`last_name` AS `last_name`,if(`s`.`sid` in (select `2022F_sanchem1`.`Students_Courses`.`sid` from `2022F_sanchem1`.`Students_Courses` where (`2022F_sanchem1`.`Students_Courses`.`sid` = `s`.`sid`)),(select group_concat(`CPS5740`.`Tuitions`.`year` separator ',') from `CPS5740`.`Tuitions` where ((not(`CPS5740`.`Tuitions`.`year` in (select `2022F_sanchem1`.`Students_Courses`.`year` from `2022F_sanchem1`.`Students_Courses` where (`2022F_sanchem1`.`Students_Courses`.`sid` = `s`.`sid`)))) and (`CPS5740`.`Tuitions`.`year` >= 2014) and (`CPS5740`.`Tuitions`.`year` <= 2017))),(select group_concat(`CPS5740`.`Tuitions`.`year` separator ',') from `CPS5740`.`Tuitions` where ((`CPS5740`.`Tuitions`.`year` >= 2014) and (`CPS5740`.`Tuitions`.`year` <= 2017)))) AS `missing_years` from `2022F_sanchem1`.`Students` `s` group by `s`.`sid` order by `s`.`sid` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vOverloaded_students`
--

/*!50001 DROP TABLE IF EXISTS `vOverloaded_students`*/;
/*!50001 DROP VIEW IF EXISTS `vOverloaded_students`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`sanchem1`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vOverloaded_students` AS select `s`.`first_name` AS `first_name`,`s`.`last_name` AS `last_name`,`sc`.`year` AS `year`,count(`sc`.`year`) AS `number_of_courses` from (`Students` `s` join `Students_Courses` `sc` on((`s`.`sid` = `sc`.`sid`))) group by `s`.`sid`,`sc`.`year` having (`number_of_courses` > 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vStaff_female`
--

/*!50001 DROP TABLE IF EXISTS `vStaff_female`*/;
/*!50001 DROP VIEW IF EXISTS `vStaff_female`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`sanchem1`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vStaff_female` AS select `MyStaff`.`staffNo` AS `staffNo`,`MyStaff`.`fName` AS `fName`,`MyStaff`.`lName` AS `lName`,`MyStaff`.`position` AS `position`,`MyStaff`.`sex` AS `sex`,`MyStaff`.`DOB` AS `DOB`,`MyStaff`.`salary` AS `salary`,`MyStaff`.`branchNo` AS `branchNo` from `MyStaff` where (`MyStaff`.`sex` = 'F') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vSum_payment_students`
--

/*!50001 DROP TABLE IF EXISTS `vSum_payment_students`*/;
/*!50001 DROP VIEW IF EXISTS `vSum_payment_students`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`sanchem1`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vSum_payment_students` AS select `s`.`first_name` AS `first_name`,`s`.`last_name` AS `last_name`,(sum(`c`.`credits`) * 100) AS `total_amount` from ((`Students` `s` join `Students_Courses` `sc` on((`s`.`sid` = `sc`.`sid`))) join `Courses` `c` on((`sc`.`cid` = `c`.`cid`))) group by `s`.`sid` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vTest`
--

/*!50001 DROP TABLE IF EXISTS `vTest`*/;
/*!50001 DROP VIEW IF EXISTS `vTest`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`sanchem1`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vTest` AS select `dreamhome`.`Staff`.`sex` AS `sex`,count(0) AS `ct` from `dreamhome`.`Staff` where (`dreamhome`.`Staff`.`sex` = 'F') group by `dreamhome`.`Staff`.`sex` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vTop_Course_count`
--

/*!50001 DROP TABLE IF EXISTS `vTop_Course_count`*/;
/*!50001 DROP VIEW IF EXISTS `vTop_Course_count`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`sanchem1`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vTop_Course_count` AS select `c`.`name` AS `name`,count(`sc`.`cid`) AS `mycount` from (`Students_Courses` `sc` join `Courses` `c` on((`sc`.`cid` = `c`.`cid`))) group by `sc`.`cid` limit 2 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-20 15:13:26
