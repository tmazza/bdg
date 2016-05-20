-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 12, 2016 at 12:27 AM
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

--
-- Dumping data for table `equipe`
--

INSERT INTO `equipe` (`id`, `nome`, `abreviacao`, `brasao`, `tipo`) VALUES
(2, 'América-MG', 'AMG', 'fut_america_mg.png', 1),
(3, 'Atlético-PR', 'CAP', 'fut_atletico-pr.png', 1),
(4, 'Atlético-MG', 'CAM', 'fut_atletico_mg.png', 1),
(5, 'Botafogo', 'BOT', 'fut_botafogo.png', 1),
(6, 'Chapecoense', 'CHA', 'fut_chape.png', 1),
(7, 'Corinthians', 'COR', 'fut_corinthians.png', 1),
(8, 'Coritiba', 'CFC', 'fut_coritiba.png', 1),
(9, 'Cruzeiro', 'CRU', 'fut_cruzeiro.png', 1),
(10, 'Figueirense', 'FIG', 'fut_figueirense.png', 1),
(11, 'Flamengo', 'FLA', 'fut_flamengo.png', 1),
(12, 'Fluminense', 'FLU', 'fut_fluminense.png', 1),
(13, 'Grêmio', 'GRE', 'fut_gremio.png', 1),
(14, 'Internacional', 'INT', 'fut_internacional.png', 1),
(15, 'Palmeiras', 'PAL', 'fut_palmeiras.png', 1),
(16, 'Ponte preta', 'PON', 'fut_ponte-preta.png', 1),
(17, 'Santa cruz', 'STA', 'fut_santa_cruz.png', 1),
(18, 'Santos', 'SAN', 'fut_santos.png', 1),
(19, 'São Paulo', 'SAO', 'fut_sao_paulo.png', 1),
(20, 'Sport', 'SPO', 'fut_sport65.png', 1),
(21, 'Vitória', 'VIT', 'fut_vitoria.png', 1);

--
-- Dumping data for table `seg_authitem`
--

INSERT INTO `seg_authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('cliente', 0, NULL, NULL, NULL),
('editor', 0, NULL, NULL, NULL),
('modEditor', 1, NULL, NULL, NULL);

--
-- Dumping data for table `seg_authitemchild`
--

INSERT INTO `seg_authitemchild` (`parent`, `child`) VALUES
('editor', 'cliente'),
('editor', 'modEditor');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
