-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: oscip
-- ------------------------------------------------------
-- Server version	5.7.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contexto`
--

DROP TABLE IF EXISTS `contexto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contexto` (
  `idcontexto` int(11) NOT NULL AUTO_INCREMENT,
  `dimensao` varchar(1) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `sinonimos` varchar(500) DEFAULT NULL,
  `termos` varchar(500) DEFAULT NULL,
  `notin` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcontexto`),
  UNIQUE KEY `idcontexto_UNIQUE` (`idcontexto`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `convcrono`
--

DROP TABLE IF EXISTS `convcrono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `convcrono` (
  `idcrono` int(11) NOT NULL AUTO_INCREMENT,
  `idconv` varchar(45) DEFAULT NULL,
  `descricao` text,
  `dtinicio` varchar(12) DEFAULT NULL,
  `dtfim` varchar(12) DEFAULT NULL,
  `unidfornec` varchar(200) DEFAULT NULL,
  `valor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcrono`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `convemp`
--

DROP TABLE IF EXISTS `convemp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `convemp` (
  `idemp` int(11) NOT NULL AUTO_INCREMENT,
  `idconv` varchar(45) DEFAULT NULL,
  `tiponota` varchar(45) DEFAULT NULL,
  `tiponotadesc` varchar(100) DEFAULT NULL,
  `dtemissao` varchar(12) DEFAULT NULL,
  `codsit` varchar(100) DEFAULT NULL,
  `descsit` varchar(100) DEFAULT NULL,
  `valor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idemp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `convproj`
--

DROP TABLE IF EXISTS `convproj`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `convproj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idconv` varchar(45) DEFAULT NULL,
  `idoscip` int(11) NOT NULL,
  `tipo` varchar(1) DEFAULT NULL COMMENT 'C = Convenio / P = Projeto',
  `status` varchar(100) DEFAULT NULL,
  `codproposta` varchar(45) DEFAULT NULL,
  `objetivo` text,
  `descricao` text,
  `orgao` varchar(100) DEFAULT NULL,
  `origem` varchar(100) DEFAULT NULL,
  `modalidade` varchar(100) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `cep` varchar(11) DEFAULT NULL,
  `cidade` varchar(200) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `valorglob` varchar(300) DEFAULT NULL,
  `valorep` varchar(45) DEFAULT NULL,
  `valorcont` varchar(45) DEFAULT NULL,
  `dtini` varchar(12) DEFAULT NULL,
  `dtfim` varchar(12) DEFAULT NULL,
  `fonte` varchar(300) DEFAULT NULL,
  `pathimg` varchar(200) DEFAULT NULL,
  `pathimg2` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `debug`
--

DROP TABLE IF EXISTS `debug`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `debug` (
  `iddebug` int(11) NOT NULL AUTO_INCREMENT,
  `idoscip` int(11) NOT NULL,
  `dtinilink` datetime DEFAULT NULL,
  `dtfimlink` datetime DEFAULT NULL,
  `dtinicrl` datetime DEFAULT NULL,
  `dtfimcrl` datetime DEFAULT NULL,
  `dtinimng` datetime DEFAULT NULL,
  `dtfimmng` datetime DEFAULT NULL,
  PRIMARY KEY (`iddebug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `descoberta`
--

DROP TABLE IF EXISTS `descoberta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `descoberta` (
  `iddesc` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkpagina` int(11) NOT NULL,
  `tipo` varchar(1) NOT NULL,
  `sinonimo` varchar(100) NOT NULL,
  `texto` mediumtext NOT NULL,
  `descoberta` varchar(500) NOT NULL,
  `posini` int(11) NOT NULL,
  `posfim` int(11) NOT NULL,
  PRIMARY KEY (`iddesc`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `estmorf`
--

DROP TABLE IF EXISTS `estmorf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estmorf` (
  `idest` int(11) NOT NULL AUTO_INCREMENT,
  `fkcontexto` varchar(45) NOT NULL,
  `estrutura` varchar(45) NOT NULL,
  PRIMARY KEY (`idest`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fonte`
--

DROP TABLE IF EXISTS `fonte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fonte` (
  `idfonte` int(11) NOT NULL AUTO_INCREMENT,
  `dominio` varchar(200) NOT NULL,
  `desc` varchar(500) NOT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`idfonte`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `oscip`
--

DROP TABLE IF EXISTS `oscip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oscip` (
  `idoscip` int(11) NOT NULL,
  `cnpj` varchar(15) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nome2` varchar(100) DEFAULT NULL,
  `sigla` varchar(10) DEFAULT NULL,
  `endereco` varchar(300) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `cidade` varchar(200) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `telefone` varchar(200) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `dataQualif` varchar(10) DEFAULT NULL,
  `conv` int(1) NOT NULL DEFAULT '0',
  `doacao` text,
  `partic` text,
  `edital` varchar(300) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idoscip`,`conv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `oscmeta`
--

DROP TABLE IF EXISTS `oscmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oscmeta` (
  `idmeta` int(11) NOT NULL AUTO_INCREMENT,
  `fkoscip` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `tipo` varchar(3) NOT NULL COMMENT 'PUB =  Notícias, Boletins, Blogs e Publicações, OBR = Obras e Exposições / PRF = Perfil / PUA = Publico Alvo / OBJ = Objetivos / SRV = Serviços / EDT = Edital / MBO = Membro / INF = Infra / AJU = Como ajudar (Patrocinadores/Doações e Voluntariado) / SIT = Sites sobre cultura / NOT = Noticia / EML = Email',
  `titulo` varchar(300) DEFAULT NULL,
  `texto` text,
  `fonte` varchar(500) NOT NULL,
  `imagem` varchar(300) DEFAULT NULL,
  `dtinclusao` datetime DEFAULT NULL,
  PRIMARY KEY (`idmeta`),
  KEY `fkoscipmeta_idx` (`fkoscip`),
  CONSTRAINT `fkoscipmeta` FOREIGN KEY (`fkoscip`) REFERENCES `oscip` (`idoscip`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pagina`
--

DROP TABLE IF EXISTS `pagina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagina` (
  `idpagina` int(11) NOT NULL AUTO_INCREMENT,
  `fkcontexto` int(11) NOT NULL,
  `fkoscip` int(11) NOT NULL,
  `tipo` varchar(1) NOT NULL,
  `status` varchar(2) NOT NULL,
  `url` varchar(500) NOT NULL,
  `html` mediumtext,
  `texto` mediumtext,
  `termos` text,
  `path` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idpagina`),
  KEY `idcontexto_idx` (`fkcontexto`),
  KEY `idoscip_idx` (`fkoscip`),
  CONSTRAINT `idcontexto` FOREIGN KEY (`fkcontexto`) REFERENCES `contexto` (`idcontexto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idoscip` FOREIGN KEY (`fkoscip`) REFERENCES `oscip` (`idoscip`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `relatorio`
--

DROP TABLE IF EXISTS `relatorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relatorio` (
  `idrelatorio` int(11) NOT NULL AUTO_INCREMENT,
  `idoscip` varchar(45) NOT NULL,
  `idcontexto` int(11) NOT NULL,
  `qtdlink` int(11) NOT NULL DEFAULT '0',
  `qtdpag` int(11) NOT NULL DEFAULT '0',
  `qtddesc` int(11) NOT NULL DEFAULT '0',
  `qtddesc2` int(11) DEFAULT NULL,
  `dtiniproc` datetime DEFAULT NULL,
  `dtfimproc` datetime DEFAULT NULL,
  PRIMARY KEY (`idrelatorio`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tripla`
--

DROP TABLE IF EXISTS `tripla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tripla` (
  `idtripla` int(11) NOT NULL AUTO_INCREMENT,
  `idcontexto` varchar(45) NOT NULL,
  `ent1` varchar(45) DEFAULT NULL,
  `rel` varchar(45) DEFAULT NULL,
  `ent2` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtripla`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-28 22:14:10
