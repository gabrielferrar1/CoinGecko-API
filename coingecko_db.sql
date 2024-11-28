-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/11/2024 às 01:22
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `coingecko_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `log`
--

CREATE TABLE `log` (
  `idlog` int(11) NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT current_timestamp(),
  `numeroregistros` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `moedas`
--

CREATE TABLE `moedas` (
  `id_moeda` int(11) NOT NULL,
  `simbolo` varchar(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `url_imagem` text DEFAULT NULL,
  `preco_atual` decimal(15,2) DEFAULT NULL,
  `capital_mercado` bigint(20) DEFAULT NULL,
  `percentual_mudanca_preco` float DEFAULT NULL,
  `rank_capital_mercado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `moedas`
--

INSERT INTO `moedas` (`id_moeda`, `simbolo`, `nome`, `url_imagem`, `preco_atual`, `capital_mercado`, `percentual_mudanca_preco`, `rank_capital_mercado`) VALUES
(2, 'ethereum', 'Ethereum', 'https://coin-images.coingecko.com/coins/images/279/large/ethereum.png?1696501628', 3648.54, 439390706898, 9.13451, 2),
(3, 'tether', 'Tether', 'https://coin-images.coingecko.com/coins/images/325/large/Tether.png?1696501661', 1.00, 132796562946, -0.08334, 3),
(4, 'solana', 'Solana', 'https://coin-images.coingecko.com/coins/images/4128/large/solana.png?1718769756', 241.29, 114478459304, 3.85157, 4),
(5, 'binancecoin', 'BNB', 'https://coin-images.coingecko.com/coins/images/825/large/bnb-icon2_2x.png?1696501970', 643.54, 93917404523, 4.57451, 5),
(6, 'ripple', 'XRP', 'https://coin-images.coingecko.com/coins/images/44/large/xrp-symbol-white-128.png?1696501442', 1.47, 83702457181, 3.9692, 6),
(7, 'dogecoin', 'Dogecoin', 'https://coin-images.coingecko.com/coins/images/5/large/dogecoin.png?1696501409', 0.40, 58633889420, 2.10638, 7),
(8, 'usd-coin', 'USDC', 'https://coin-images.coingecko.com/coins/images/6319/large/usdc.png?1696506694', 1.00, 39466871238, 0.00972, 8),
(9, 'cardano', 'Cardano', 'https://coin-images.coingecko.com/coins/images/975/large/cardano.png?1696502090', 1.00, 35953324161, 4.0025, 9),
(10, 'staked-ether', 'Lido Staked Ether', 'https://coin-images.coingecko.com/coins/images/13442/large/steth_logo.png?1696513206', 3641.44, 35671112969, 8.8938, 10);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`idlog`);

--
-- Índices de tabela `moedas`
--
ALTER TABLE `moedas`
  ADD PRIMARY KEY (`id_moeda`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `log`
--
ALTER TABLE `log`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `moedas`
--
ALTER TABLE `moedas`
  MODIFY `id_moeda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
