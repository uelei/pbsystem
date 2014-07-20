-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 20, 2014 at 04:37 PM
-- Server version: 5.5.37
-- PHP Version: 5.4.4-14+deb7u10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `piubol`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_manufacturer_data`
--

CREATE TABLE IF NOT EXISTS `ci_manufacturer_data` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `fantasia` varchar(40) NOT NULL,
  `contato` varchar(35) NOT NULL,
  `ie` varchar(16) NOT NULL,
  `im` varchar(16) NOT NULL,
  `cgc` varchar(19) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `endere` varchar(35) NOT NULL,
  `numero` varchar(5) NOT NULL,
  `cmpl` varchar(15) NOT NULL,
  `comple` varchar(35) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `fone` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `SITE` varchar(80) NOT NULL,
  `adicional1` varchar(20) NOT NULL,
  `adicional2` varchar(20) NOT NULL,
  `obs` varchar(254) NOT NULL,
  `ativo` enum('F','T') NOT NULL,
  PRIMARY KEY (`manufacturer_id`),
  UNIQUE KEY `cgc` (`cgc`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=168 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_product_cost`
--

CREATE TABLE IF NOT EXISTS `ci_product_cost` (
  `product_id` int(11) NOT NULL,
  `price_cost` decimal(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forneced`
--

CREATE TABLE IF NOT EXISTS `forneced` (
  `NOME` varchar(60) NOT NULL,
  `FANTASIA` varchar(40) NOT NULL,
  `CONTATO` varchar(35) NOT NULL,
  `IE` varchar(16) NOT NULL,
  `IM` varchar(16) NOT NULL,
  `CGC` varchar(19) NOT NULL,
  `TIPO` varchar(15) NOT NULL,
  `ENDERE` varchar(35) NOT NULL,
  `NUMERO` varchar(5) NOT NULL,
  `CMPL` varchar(15) NOT NULL,
  `COMPLE` varchar(35) NOT NULL,
  `CIDADE` varchar(30) NOT NULL,
  `ESTADO` varchar(2) NOT NULL,
  `CEP` varchar(9) NOT NULL,
  `FONE` varchar(20) NOT NULL,
  `FAX` varchar(20) NOT NULL,
  `CELULAR` varchar(20) NOT NULL,
  `EMAIL` varchar(80) NOT NULL,
  `SITE` varchar(80) NOT NULL,
  `ADICIONAL1` varchar(20) NOT NULL,
  `ADICIONAL2` varchar(20) NOT NULL,
  `OBS` varchar(254) NOT NULL,
  `ATIVO` enum('F','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `money_control`
--

CREATE TABLE IF NOT EXISTS `money_control` (
  `im` int(11) NOT NULL AUTO_INCREMENT,
  `data_venc` date NOT NULL,
  `tipo_pag` int(11) NOT NULL,
  `tipo_doc` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `n_doc` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `valor_ori` double NOT NULL,
  `valor_efe` double NOT NULL,
  `n_ope_cli` int(11) NOT NULL,
  `data_efe` date NOT NULL,
  `parcela` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `n_conta` int(11) NOT NULL,
  `n_cedente` int(11) NOT NULL,
  `id_d_desp` int(11) NOT NULL DEFAULT '1',
  `situacao` int(11) NOT NULL,
  PRIMARY KEY (`im`),
  KEY `im` (`im`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16858 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_contas`
--

CREATE TABLE IF NOT EXISTS `tb_contas` (
  `id_conta` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_conta` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `saldo_conta` double NOT NULL,
  PRIMARY KEY (`id_conta`),
  KEY `id_conta` (`id_conta`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_d_desp`
--

CREATE TABLE IF NOT EXISTS `tb_d_desp` (
  `i_d_desp` int(11) NOT NULL AUTO_INCREMENT,
  `desc_d_desp` varchar(50) NOT NULL,
  `var_d_desp` float NOT NULL,
  PRIMARY KEY (`i_d_desp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_t_doc`
--

CREATE TABLE IF NOT EXISTS `tb_t_doc` (
  `id_t_doc` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_t_doc` varchar(30) NOT NULL,
  `var` double NOT NULL,
  PRIMARY KEY (`id_t_doc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_t_pag`
--

CREATE TABLE IF NOT EXISTS `tb_t_pag` (
  `id_t_pag` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_t_pag` varchar(30) NOT NULL,
  `prazo_medio` float NOT NULL,
  `id_status_padrao` int(11) NOT NULL,
  `juros` float NOT NULL,
  `id_conta_padrao` int(11) NOT NULL,
  PRIMARY KEY (`id_t_pag`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nivel` int(1) NOT NULL,
  `sigla` varchar(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
