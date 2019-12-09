-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 04, 2018 at 11:07 AM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bytetrash_db`
--
CREATE DATABASE IF NOT EXISTS `bytetrash_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bytetrash_db`;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cat` varchar(45) DEFAULT NULL,
  `tipo_cat` varchar(45) DEFAULT NULL,
  `desc_cat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id_cat`, `nome_cat`, `tipo_cat`, `desc_cat`) VALUES
(1, 'telas', 'peças', NULL),
(2, 'celular', 'aparelho', NULL),
(3, 'placas', 'componente', NULL),
(4, 'notebook', 'aparelho', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prod_trash`
--

CREATE TABLE IF NOT EXISTS `prod_trash` (
  `id_trash` int(11) NOT NULL AUTO_INCREMENT,
  `img_trash` varchar(120) DEFAULT NULL,
  `cat_trash` int(11) DEFAULT NULL,
  `value` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id_trash`),
  KEY `cat_trash` (`cat_trash`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `prod_trash`
--

INSERT INTO `prod_trash` (`id_trash`, `img_trash`, `cat_trash`, `value`) VALUES
(1, '_assets/_img/trash/15413285825bdecec6019e2.jpg', 2, '150.00'),
(2, '_assets/_img/trash/15413267985bdec7ce23e6e.jpg', 3, '50.00'),
(3, NULL, 4, '250.00');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usu` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usu` varchar(45) DEFAULT NULL,
  `email_usu` varchar(50) DEFAULT NULL,
  `senha` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id_usu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prod_trash`
--
ALTER TABLE `prod_trash`
  ADD CONSTRAINT `trash_fk` FOREIGN KEY (`cat_trash`) REFERENCES `categorias` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
