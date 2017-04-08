-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 03/11/2016 às 07:50
-- Versão do servidor: 5.7.13-0ubuntu0.16.04.2
-- Versão do PHP: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `iFilmes`
--

create database ifilmes;

use ifilmes;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `categoria`
--

INSERT INTO `categoria` (`id`, `descricao`) VALUES
(1, 'Drama'),
(2, 'Terror'),
(3, 'Comedia'),
(4, 'Ficcao');

-- --------------------------------------------------------

--
-- Estrutura para tabela `filme`
--

CREATE TABLE `filme` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `filme`
--

INSERT INTO `filme` (`id`, `nome`, `idCategoria`) VALUES
(10, 'O resgate do soldado Rian', 1);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `filme`
--
ALTER TABLE `filme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `filme`
--
ALTER TABLE `filme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `filme`
--
ALTER TABLE `filme`
  ADD CONSTRAINT `filme_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


alter table filme add imagem nvarchar(500);
alter table filme add descricao nvarchar(1000);

