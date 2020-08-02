-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: pfc_banco_novo
-- ------------------------------------------------------
-- Server version	8.0.19

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
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `areas` (
  `area_id` int NOT NULL AUTO_INCREMENT,
  `area_nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Automação'),(2,'Automotiva'),(3,'Construção Civil'),(4,'Gestão'),(5,'GTD'),(6,'Manutenção'),(7,'Redes'),(8,'Software'),(15,'teste');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bancas`
--

DROP TABLE IF EXISTS `bancas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bancas` (
  `banca_id` int NOT NULL AUTO_INCREMENT,
  `banca_local` varchar(45) DEFAULT NULL,
  `banca_data` date DEFAULT NULL,
  `banca_convidado1` varchar(45) DEFAULT NULL,
  `banca_convidado2` varchar(45) DEFAULT NULL,
  `banca_observacao` varchar(1000) DEFAULT NULL,
  `banca_projeto_id` int NOT NULL,
  PRIMARY KEY (`banca_id`),
  KEY `fk_bancas_projetos1_idx` (`banca_projeto_id`),
  CONSTRAINT `fk_bancas_projetos1` FOREIGN KEY (`banca_projeto_id`) REFERENCES `projetos` (`projeto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancas`
--

LOCK TABLES `bancas` WRITE;
/*!40000 ALTER TABLE `bancas` DISABLE KEYS */;
INSERT INTO `bancas` VALUES (16,'SENAI CIMATEC','2020-07-24','Convidado 1','Convidado 2','observação banca',13),(17,'SENAI CIMATEC','2020-07-30','Convidado 1','','observação banca',14);
/*!40000 ALTER TABLE `bancas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `cliente_id` int NOT NULL AUTO_INCREMENT,
  `cliente_razaosocial` varchar(45) DEFAULT NULL,
  `cliente_nomefantasia` varchar(45) DEFAULT NULL,
  `cliente_endereco` varchar(45) DEFAULT NULL,
  `cliente_nomerepresentante` varchar(45) DEFAULT NULL,
  `cliente_emailrepresentante` varchar(45) DEFAULT NULL,
  `cliente_telrepresentante` varchar(45) DEFAULT NULL,
  `cliente_problema` varchar(1000) DEFAULT NULL,
  `cliente_solucao` varchar(1000) DEFAULT NULL,
  `cliente_resultado` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (2,'Senai CIMATEC','Senai CIMATEC','Av. Orlando Gomes, Piatã','José Eduardo','jeduardo@fieb.org.br','3879-5500','Cliente Possui uma Oficina localizada na av. Orlando gomes (BA) em que foi solicitado.','Deve ser utilizado check list impresso para o levantamento de dados onde constarão campos para  a sinalização das condições e necessidades de reparos.\r\n Deve–se utilizara planilha em excel com o intuito de alimentar o programa para acompanhamento e controle da gestão dos serviços de manutenção do veiculo.\r\n Para o acompanhamento dos serviços de manutenção deverá ser utilizado o aplicativo PowerBi, facilitando a gestão e o controle do almoxarifado.','Processo mais enxuto, facilitando o controle de manutenção, tempo gasto, peças, processo de execução; Possibilidade de gera relatórios com maior precisão sobre a situação do veículo; Maior rapidez na gestão da oficina sobre os veículos sob sua responsabilidade; Modernização e melhoria das ferramentas de trabalho.');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracoes`
--

DROP TABLE IF EXISTS `configuracoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configuracoes` (
  `configuracao_id` int NOT NULL AUTO_INCREMENT,
  `configuracao_semestreatual` decimal(5,1) DEFAULT NULL,
  PRIMARY KEY (`configuracao_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracoes`
--

LOCK TABLES `configuracoes` WRITE;
/*!40000 ALTER TABLE `configuracoes` DISABLE KEYS */;
INSERT INTO `configuracoes` VALUES (1,2019.1);
/*!40000 ALTER TABLE `configuracoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coordenadores`
--

DROP TABLE IF EXISTS `coordenadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coordenadores` (
  `coordenador_id` int NOT NULL AUTO_INCREMENT,
  `coordenador_nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`coordenador_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coordenadores`
--

LOCK TABLES `coordenadores` WRITE;
/*!40000 ALTER TABLE `coordenadores` DISABLE KEYS */;
INSERT INTO `coordenadores` VALUES (1,'Carla Melo'),(2,'Caroline Paim'),(3,'Eduardo'),(4,'Lilian Moraes'),(5,'Luciano'),(6,'Ricardo Celestino');
/*!40000 ALTER TABLE `coordenadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cursos` (
  `curso_id` int NOT NULL AUTO_INCREMENT,
  `curso_nome` varchar(45) DEFAULT NULL,
  `curso_area_id` int NOT NULL,
  `curso_coordenador_id` int NOT NULL,
  PRIMARY KEY (`curso_id`),
  KEY `fk_cursos_areas1_idx` (`curso_area_id`),
  KEY `fk_cursos_coordenadores1_idx` (`curso_coordenador_id`),
  CONSTRAINT `fk_cursos_areas1` FOREIGN KEY (`curso_area_id`) REFERENCES `areas` (`area_id`),
  CONSTRAINT `fk_cursos_coordenadores1` FOREIGN KEY (`curso_coordenador_id`) REFERENCES `coordenadores` (`coordenador_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (1,'Técnico em Desenvolvimento de Sistemas',8,2),(2,'Técnico em Edificações',3,1),(3,'Técnico em Eletrotécnica',5,5),(4,'Técnico em Logística ',4,3),(5,'Técnico em Manutenção Automotiva',2,3),(6,'Técnico em Mecânica',6,6),(7,'Técnico em Mecatrônica',1,4),(8,'Técnico em Redes de Computadores',7,2);
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipes`
--

DROP TABLE IF EXISTS `equipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipes` (
  `equipe_id` int NOT NULL AUTO_INCREMENT,
  `equipe_nota` decimal(3,1) DEFAULT NULL,
  `equipe_gestor` varchar(45) DEFAULT NULL,
  `equipe_membro1` varchar(45) DEFAULT NULL,
  `equipe_membro2` varchar(45) DEFAULT NULL,
  `equipe_membro3` varchar(45) DEFAULT NULL,
  `equipe_membro4` varchar(45) DEFAULT NULL,
  `equipe_membro5` varchar(45) DEFAULT NULL,
  `equipe_tem_projeto` tinyint NOT NULL,
  `equipe_turma_id` int NOT NULL,
  PRIMARY KEY (`equipe_id`),
  KEY `fk_equipes_turmas1_idx` (`equipe_turma_id`),
  CONSTRAINT `fk_equipes_turmas1` FOREIGN KEY (`equipe_turma_id`) REFERENCES `turmas` (`turma_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipes`
--

LOCK TABLES `equipes` WRITE;
/*!40000 ALTER TABLE `equipes` DISABLE KEYS */;
INSERT INTO `equipes` VALUES (6,NULL,'Vinicius dos Santos Costa Gomes','Anderson da Conceição','Carlos Matheus Carvalho','Sérgio Serrate','','',1,16),(7,2.0,'Ricardo','Caio','Ian','Wilson','','',1,26),(10,NULL,'Adriano','Luan','Gleissu','Alexander','','',0,26),(11,NULL,'Jeferson','Fernando','Diego','','','',0,26);
/*!40000 ALTER TABLE `equipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gpes`
--

DROP TABLE IF EXISTS `gpes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gpes` (
  `gpe_id` int NOT NULL AUTO_INCREMENT,
  `gpe_nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`gpe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gpes`
--

LOCK TABLES `gpes` WRITE;
/*!40000 ALTER TABLE `gpes` DISABLE KEYS */;
INSERT INTO `gpes` VALUES (1,'Érita'),(2,'João');
/*!40000 ALTER TABLE `gpes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orientadores`
--

DROP TABLE IF EXISTS `orientadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orientadores` (
  `orientador_id` int NOT NULL AUTO_INCREMENT,
  `orientador_nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`orientador_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orientadores`
--

LOCK TABLES `orientadores` WRITE;
/*!40000 ALTER TABLE `orientadores` DISABLE KEYS */;
INSERT INTO `orientadores` VALUES (1,'Adson'),(2,'André Portugal'),(3,'Daniel'),(4,'Jorsiele'),(5,'Paulo de Tarso'),(6,'Pedro'),(7,'Sanval'),(8,'Sérgio Rolemberg'),(9,'Sidney');
/*!40000 ALTER TABLE `orientadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projetos`
--

DROP TABLE IF EXISTS `projetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projetos` (
  `projeto_id` int NOT NULL AUTO_INCREMENT,
  `projeto_nome` varchar(45) DEFAULT NULL,
  `projeto_tipo` varchar(45) DEFAULT NULL,
  `projeto_empresa` varchar(45) DEFAULT NULL,
  `projeto_negocio` varchar(45) DEFAULT NULL,
  `projeto_macrotema` varchar(45) DEFAULT NULL,
  `projeto_risco` varchar(45) DEFAULT NULL,
  `projeto_retorno` decimal(10,2) DEFAULT NULL,
  `projeto_status` int DEFAULT NULL,
  `projeto_semestre` decimal(5,1) DEFAULT NULL,
  `projeto_entregavel1` date DEFAULT NULL,
  `projeto_status1` int DEFAULT NULL,
  `projeto_entregavel2` date DEFAULT NULL,
  `projeto_status2` int DEFAULT NULL,
  `projeto_entregavel3` date DEFAULT NULL,
  `projeto_status3` int DEFAULT NULL,
  `projeto_observacao` varchar(1000) DEFAULT NULL,
  `projeto_motivocancelamento` varchar(1000) DEFAULT NULL,
  `projeto_tem_banca` tinyint NOT NULL,
  `projeto_cliente_id` int DEFAULT NULL,
  `projeto_equipe_id` int DEFAULT NULL,
  PRIMARY KEY (`projeto_id`),
  KEY `fk_projetos_clientes1_idx` (`projeto_cliente_id`),
  KEY `fk_projetos_equipes1_idx` (`projeto_equipe_id`),
  CONSTRAINT `fk_projetos_clientes1` FOREIGN KEY (`projeto_cliente_id`) REFERENCES `clientes` (`cliente_id`),
  CONSTRAINT `fk_projetos_equipes1` FOREIGN KEY (`projeto_equipe_id`) REFERENCES `equipes` (`equipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projetos`
--

LOCK TABLES `projetos` WRITE;
/*!40000 ALTER TABLE `projetos` DISABLE KEYS */;
INSERT INTO `projetos` VALUES (13,'Teste','Interno','Projeto','Comércio','Construção de Protótipos','Médio',0.03,3,2019.1,'2020-07-14',1,'2020-07-20',1,'2020-07-21',1,'Esta é uma observação para teste.','',1,2,7),(14,'Teste 3','Interno','Desenvolvimento de Produto','Cimatec','Sustentabilidade','Alto',0.06,3,2019.1,'2020-07-13',1,'2020-07-14',1,'2020-07-15',1,'Esta é uma observação para teste.','',1,2,7),(15,'Teste 4','Interno','Processo','Cimatec','Construção de Protótipos','Médio',0.04,2,2019.1,'2020-07-01',1,'2020-07-02',1,'2020-07-03',1,'Esta é uma observação para teste.','',0,2,7),(16,'Teste 5','Interno','Pesquisa','Cimatec','Social','Baixo',0.03,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Esta é uma observação para teste.',NULL,0,2,NULL);
/*!40000 ALTER TABLE `projetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turmas`
--

DROP TABLE IF EXISTS `turmas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `turmas` (
  `turma_id` int NOT NULL AUTO_INCREMENT,
  `turma_codigo` varchar(45) DEFAULT NULL,
  `turma_turno` varchar(45) DEFAULT NULL,
  `turma_curso_id` int NOT NULL,
  `turma_orientador_id` int NOT NULL,
  `turma_gpe_id` int NOT NULL,
  PRIMARY KEY (`turma_id`),
  KEY `fk_turmas_cursos1_idx` (`turma_curso_id`),
  KEY `fk_turmas_orientadores1_idx` (`turma_orientador_id`),
  KEY `fk_turmas_gpes1_idx` (`turma_gpe_id`),
  CONSTRAINT `fk_turmas_cursos1` FOREIGN KEY (`turma_curso_id`) REFERENCES `cursos` (`curso_id`),
  CONSTRAINT `fk_turmas_gpes1` FOREIGN KEY (`turma_gpe_id`) REFERENCES `gpes` (`gpe_id`),
  CONSTRAINT `fk_turmas_orientadores1` FOREIGN KEY (`turma_orientador_id`) REFERENCES `orientadores` (`orientador_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turmas`
--

LOCK TABLES `turmas` WRITE;
/*!40000 ALTER TABLE `turmas` DISABLE KEYS */;
INSERT INTO `turmas` VALUES (14,'55679','Noturno',2,8,1),(15,'55682','Noturno',5,6,2),(16,'56545','Noturno',5,6,1),(17,'56946','Vespertino',5,6,1),(18,'58179','Noturno',1,9,1),(19,'58180','Noturno',3,5,1),(20,'58182','Noturno',6,1,1),(21,'58183','Noturno',7,4,1),(22,'61273','Noturno',4,3,1),(23,'62008','Noturno',1,2,1),(24,'62166','Vespertino',8,7,1),(25,'62168','Vespertino',1,9,1),(26,'64084','Noturno',1,9,1);
/*!40000 ALTER TABLE `turmas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `usuario_id` int NOT NULL AUTO_INCREMENT,
  `usuario_nome` varchar(45) DEFAULT NULL,
  `usuario_senha` varchar(120) DEFAULT NULL,
  `usuario_perfil` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `usuario_nome_UNIQUE` (`usuario_nome`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (34,'Hash','$2y$10$uIkoI2jbFx9bG8Cca00/q.6oHxQqTe6giraRwUmZzcYJ2/4NGJ.5O','Administrador'),(37,'Caio','$2y$10$7vcdzvwXxKUxlwcNu/GOzOfF4HUzj8/u5b05FS9kWCtxcEwffIn9u','Administrador'),(39,'Admin','$2y$10$8oYEPXw1EcGkUgys4alaZetPd1.4pH45ARknL0QdXyfwwkTaGyWD2','Administrador'),(40,'Wilson','$2y$10$cmgH943C5z7cAyKCenfg4.wKrI/ST/7GBQZ1eNJLihZ27RugFQQ.K','Administrador'),(41,'Carlos','$2y$10$k0.jMY1ibJuqM7mQUu73I.ntAC1aok2YJROdYPOKBQEuNCHasyIAS','Administrador'),(42,'Ian','$2y$10$b/F7TyRKXQI9mCxiWD0RauPBK95nLjn9Sk6DkzQYpqFpKSNsoKV96','Administrador');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-28 10:42:21
