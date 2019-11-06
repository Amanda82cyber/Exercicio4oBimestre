-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2019 at 04:54 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ex_4obimestre`
--

-- --------------------------------------------------------

--
-- Table structure for table `cadastro`
--

CREATE TABLE IF NOT EXISTS `cadastro` (
  `id_cadastro` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sexo` char(1) NOT NULL COMMENT 'F = "Feminino" e M = "Masculino"',
  `cod_cidade` int(11) NOT NULL,
  `salario` float NOT NULL,
  PRIMARY KEY (`id_cadastro`),
  KEY `cod_cidade` (`cod_cidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `cadastro`
--

INSERT INTO `cadastro` (`id_cadastro`, `nome`, `email`, `sexo`, `cod_cidade`, `salario`) VALUES
(2, 'Deoclécia', 'deinhah@gmail.com', 'F', 1, 200),
(3, 'Pedro', 'pedrinho@gmail.com', 'M', 1, 855),
(4, 'Joana Maria', 'joma@gmail.com', 'F', 1, 785),
(5, 'Carlita Perez', 'auuuu@gmail.com', 'F', 1, 9985),
(6, 'Dourada Do RIO', 'dourada@gmail.com', 'F', 1, 5555),
(7, 'Mario Luiz', 'luizinho@gmail.com', 'M', 1, 8810),
(8, 'Ágatha Maria', 'agatinha@gmail.com', 'F', 1, 789),
(10, 'Vanessa Benitte', 'vanessa@gmail.com', 'F', 5, 78965);

-- --------------------------------------------------------

--
-- Table structure for table `cidade`
--

CREATE TABLE IF NOT EXISTS `cidade` (
  `id_cidade` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cod_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_cidade`),
  KEY `cod_estado` (`cod_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `cidade`
--

INSERT INTO `cidade` (`id_cidade`, `nome`, `cod_estado`) VALUES
(1, 'São Paulo', 1),
(2, 'Deoclécia A', 1),
(3, 'Curitba', 1),
(5, 'São Carlos', 1),
(6, 'Ibaté', 1),
(7, 'São Paulo', 1),
(8, 'Londrina', 3),
(9, 'Rio Branco', 15),
(10, 'São Paulo1', 16),
(11, 'São Paulo1', 16);

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `uf` char(2) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`id_estado`, `nome`, `uf`) VALUES
(1, 'São Paulo', 'SP'),
(3, 'Paraná', 'PR'),
(15, 'Acre', 'AC'),
(16, 'Pernambuco', 'PE'),
(17, 'Pará', 'PA'),
(18, 'Santa Catarina', 'SC');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cadastro`
--
ALTER TABLE `cadastro`
  ADD CONSTRAINT `cadastro_ibfk_1` FOREIGN KEY (`cod_cidade`) REFERENCES `cidade` (`id_cidade`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `cidade_ibfk_1` FOREIGN KEY (`cod_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
