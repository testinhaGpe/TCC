CREATE DATABASE  IF NOT EXISTS `controleacesso_sql` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `controleacesso_sql`;
-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: controleacesso_sql
-- ------------------------------------------------------
-- Server version	8.0.39

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
-- Table structure for table `administradores`
--

DROP TABLE IF EXISTS `administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administradores` (
  `id_administrador` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_administrador`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portarias`
--

DROP TABLE IF EXISTS `portarias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portarias` (
  `id_portaria` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `localizacao` varchar(255) NOT NULL,
  PRIMARY KEY (`id_portaria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portarias`
--

LOCK TABLES `portarias` WRITE;
/*!40000 ALTER TABLE `portarias` DISABLE KEYS */;
/*!40000 ALTER TABLE `portarias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrosdeacesso`
--

DROP TABLE IF EXISTS `registrosdeacesso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registrosdeacesso` (
  `id_registro` int NOT NULL AUTO_INCREMENT,
  `id_visitante` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `data_acesso` date NOT NULL,
  `hora_entrada` datetime NOT NULL,
  `hora_saida` datetime DEFAULT NULL,
  `tipo_acesso` enum('entrada','saida') DEFAULT NULL,
  PRIMARY KEY (`id_registro`),
  KEY `id_visitante` (`id_visitante`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `registrosdeacesso_ibfk_1` FOREIGN KEY (`id_visitante`) REFERENCES `visitantes` (`id_visitante`),
  CONSTRAINT `registrosdeacesso_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrosdeacesso`
--

LOCK TABLES `registrosdeacesso` WRITE;
/*!40000 ALTER TABLE `registrosdeacesso` DISABLE KEYS */;
/*!40000 ALTER TABLE `registrosdeacesso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` enum('administrador','porteiro') NOT NULL,
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'gabriel','1111111111','Gabriel@hotmail.com','2024-09-16','181818181818','$2y$10$IePoTEz5KA7pvuhjdEKMjeYX50WlzUQ53nybUP1PtzPU0uu6RFPai','administrador','2024-09-15 18:35:18'),(2,'pereira','555555555555','pereira123@hotmail.com','2024-09-03','189997896418','$2y$10$87t3Yf04p.l9Qz75UAFfo.WvFsoN0/x.QnfqIm.LEBS/1KcjnTKc6','porteiro','2024-09-15 18:48:46');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitantes`
--

DROP TABLE IF EXISTS `visitantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visitantes` (
  `id_visitante` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `documento` varchar(50) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id_visitante`),
  UNIQUE KEY `documento` (`documento`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `visitantes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitantes`
--

LOCK TABLES `visitantes` WRITE;
/*!40000 ALTER TABLE `visitantes` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitantes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-15 16:17:56
