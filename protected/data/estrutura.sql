-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2016 at 03:06 PM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bdg`
--

-- --------------------------------------------------------

--
-- Table structure for table `bolao`
--

CREATE TABLE IF NOT EXISTS `bolao` (
  `codCampeonato` varchar(5) NOT NULL,
  `idBolao` int(11) NOT NULL AUTO_INCREMENT,
  `isAtivo` int(11) NOT NULL DEFAULT '1',
  `nome` varchar(128) NOT NULL,
  `tipoInscricao` char(1) NOT NULL,
  `valorInscricao` int(11) NOT NULL,
  `prazo` int(5) NOT NULL,
  PRIMARY KEY (`idBolao`),
  KEY `fk_bolao_campeonato` (`codCampeonato`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `campeonato`
--

CREATE TABLE IF NOT EXISTS `campeonato` (
  `codigo` varchar(5) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `inicio` date NOT NULL,
  `fim` date NOT NULL,
  `situacao` char(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipe`
--

CREATE TABLE IF NOT EXISTS `equipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `abreviacao` varchar(10) NOT NULL,
  `brasao` varchar(120) NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `jogo`
--

CREATE TABLE IF NOT EXISTS `jogo` (
  `codCampeonato` varchar(5) NOT NULL,
  `idJogo` int(11) NOT NULL AUTO_INCREMENT,
  `numJogo` int(11) DEFAULT NULL,
  `data` datetime NOT NULL,
  `equipeMandante` int(11) NOT NULL,
  `equipeVisitante` int(11) NOT NULL,
  `golsMandante` int(2) DEFAULT NULL,
  `golsVisitante` int(2) DEFAULT NULL,
  `vencedor` char(1) DEFAULT NULL,
  PRIMARY KEY (`idJogo`),
  KEY `fk_jogo_campeonato` (`codCampeonato`),
  KEY `fk_jogo_equipeMandante` (`equipeMandante`),
  KEY `fk_jogo_equipeVisitante` (`equipeVisitante`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

-- --------------------------------------------------------

--
-- Table structure for table `palpite`
--

CREATE TABLE IF NOT EXISTS `palpite` (
  `idUsuario` int(11) NOT NULL,
  `idBolao` int(11) NOT NULL,
  `idJogo` int(11) NOT NULL,
  `golsMandante` int(2) NOT NULL,
  `golsVisitante` int(2) NOT NULL,
  `vencedor` char(1) DEFAULT NULL,
  `pontos` int(2) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`,`idBolao`,`idJogo`),
  KEY `fk_palpite_bolao` (`idBolao`),
  KEY `fk_palpite_jogo` (`idJogo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idBolao` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  `linkTransacao` text,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pedido_usuario` (`idUsuario`),
  KEY `fk_pedido_bolao` (`idBolao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `seg_authassignment`
--

CREATE TABLE IF NOT EXISTS `seg_authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` int(11) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seg_authitem`
--

CREATE TABLE IF NOT EXISTS `seg_authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seg_authitemchild`
--

CREATE TABLE IF NOT EXISTS `seg_authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `apresentacao` text,
  `email` varchar(300) NOT NULL,
  `senha` varchar(300) NOT NULL,
  `tipo` varchar(12) NOT NULL,
  `social_id` varchar(255) DEFAULT NULL,
  `social_provider` varchar(255) DEFAULT NULL,
  `dt_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `social` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_bolao`
--

CREATE TABLE IF NOT EXISTS `user_bolao` (
  `idUsuario` int(11) NOT NULL,
  `idBolao` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUsuario`,`idBolao`),
  KEY `userbolao_fk_bolao` (`idBolao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_senha`
--

CREATE TABLE IF NOT EXISTS `user_senha` (
  `user_id` int(11) NOT NULL,
  `hash` varchar(512) NOT NULL,
  `estado` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bolao`
--
ALTER TABLE `bolao`
  ADD CONSTRAINT `fk_bolao_campeonato` FOREIGN KEY (`codCampeonato`) REFERENCES `campeonato` (`codigo`);

--
-- Constraints for table `jogo`
--
ALTER TABLE `jogo`
  ADD CONSTRAINT `fk_jogo_campeonato` FOREIGN KEY (`codCampeonato`) REFERENCES `campeonato` (`codigo`),
  ADD CONSTRAINT `fk_jogo_equipeMandante` FOREIGN KEY (`equipeMandante`) REFERENCES `equipe` (`id`),
  ADD CONSTRAINT `fk_jogo_equipeVisitante` FOREIGN KEY (`equipeVisitante`) REFERENCES `equipe` (`id`);

--
-- Constraints for table `palpite`
--
ALTER TABLE `palpite`
  ADD CONSTRAINT `fk_palpite_jogo` FOREIGN KEY (`idJogo`) REFERENCES `jogo` (`idJogo`),
  ADD CONSTRAINT `fk_palpite_bolao` FOREIGN KEY (`idBolao`) REFERENCES `bolao` (`idBolao`),
  ADD CONSTRAINT `fk_palpite_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `user` (`id`);

--
-- Constraints for table `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_bolao` FOREIGN KEY (`idBolao`) REFERENCES `bolao` (`idBolao`),
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `user` (`id`);

--
-- Constraints for table `seg_authassignment`
--
ALTER TABLE `seg_authassignment`
  ADD CONSTRAINT `seg_authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `seg_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seg_authassignment_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seg_authitemchild`
--
ALTER TABLE `seg_authitemchild`
  ADD CONSTRAINT `seg_authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `seg_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seg_authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `seg_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_bolao`
--
ALTER TABLE `user_bolao`
  ADD CONSTRAINT `userbolao_fk_bolao` FOREIGN KEY (`idBolao`) REFERENCES `bolao` (`idBolao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `userbolao_fk_user` FOREIGN KEY (`idUsuario`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
