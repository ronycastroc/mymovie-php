-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 14/09/2023 às 14:38
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mymovie`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `movies`
--

CREATE DATABASE mymovie;

USE mymovie;

CREATE TABLE `movies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `trailer` varchar(200) DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `length` varchar(50) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `image`, `trailer`, `category`, `length`, `user_id`) VALUES
(3, 'Click', 'Very funny!!! :D', '6d2026a2790bc1b7093a8e7c2beb0e21267526b56ca9889a05daa9fa6440dfe479f58c13653307be0d54141bd1584eb9e30be9f0413612f68d32812e.jpg', 'https://www.youtube.com/embed/zZNC5emNyEQ?si=osXfzEF4slD2DSMW', 'Comedy', '1h 50m', 1),
(4, '21 Jump Street', 'Nice, i liked', 'b9291db362760678c96c35cf4ea68bb1e457c7c22d49b731b7231d3ae2aef3c33200db951b90538e08d7ff96be32faccc9566a51ce2cae57cdee0362.jpg', 'https://www.youtube.com/embed/RLoKtb4c4W0?si=X6TmVxN1S-O-QH-q', 'Comedy', '2h 10m', 1),
(5, 'Interstellar', 'My mind boom', '97bf81330e6761e8c9d6c6e3e4f0c6bbca75094513959e130b70e1be8780d3fd119b69fc959ec23a063d1331a8ad2a970b3b02b0d8d1d334e843f6df.jpg', 'https://www.youtube.com/embed/hHBsKHVLAYc?si=BRfmFatsCiYyCK-2', 'Science fiction', '3h 10m', 1),
(6, 'Super Mario Bros', 'I loved :D', 'e4d64884603f7d1388569fd4f780690c10ccb284cab7dd1e0d7752745e6961597739a12cade70378b8e2b7d404ffc4b92dbe8a93dc0031f17328937a.jpg', 'https://www.youtube.com/embed/wkn-Gb-Fhac?si=wgGD4TODrRj8kBBY', 'Comedy', '1h 40m', 1),
(7, 'This is the end', 'Very very funny', 'e4e2580e50d88cfc6b7147510948d2788f14c1739998d19e340f547d536db45f9cb5ba7da7519978b21f8bf2fa1061c656618095d042be09ba6fbd31.jpg', 'https://www.youtube.com/embed/kliQSsD_npo?si=bZklbAq-KTWG-ziG', 'Comedy', '2h 10m', 1),
(8, 'BLACK MIRROR: Bandersnatch', 'Very crazy!!!!', 'd2057dc7c9f8126873b871cbd947152c15c6ee6a298e82566994ba748fd29fcd05e0f9d55c8658b4662fcd2dbecdec8e499e1ae3b6eb2b898d1d994b.jpg', 'https://www.youtube.com/embed/7wnRi3Sclm8?si=sjAQCNIqibvHl-SJ', 'Science fiction', '2h 23m', 1),
(12, 'RESIDENT EVIL: DEATH ISLAND', 'best movie action!!!!!', '0bf7b4105281d25b62ca707704d2f3dcbaf9d79771e9e4e570e941518ceae7168652100ffcdbe1c109efe4a9483b53ba9aec8aa5ace0b4294c2c7ba5.jpg', 'https://www.youtube.com/embed/L-vkuA8oqMY?si=KY8hvLadnJ9T2xmQ', 'Action', '1h 32m', 1),
(13, 'Puss in Boots: The Last Wish', 'Cute cat *-*', '3e9aac234c066a2a856be8080b7e2dc95d59b78050e831b7a9c5536a623291c039662e8e14151b219b6c696625a8867a688b1cfc6a2f26e9955b0d13.jpg', 'https://www.youtube.com/embed/Y5zqweZAEKI?si=BPhSq-ftvFgGOc3C', 'Drama', '1h 40m', 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `movie_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reviews`
--

INSERT INTO `reviews` (`id`, `rating`, `review`, `user_id`, `movie_id`) VALUES
(1, 9, 'The best movie!!!!', 6, 6),
(2, 7, 'I liked!', 6, 6),
(4, 10, 'The best movie ever!!!!', 6, 5),
(5, 10, 'The best cartoon movie ever!!!!!!!!!!!', 1, 13);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `image`, `token`, `bio`) VALUES
(1, 'Rony', 'Castro', 'teste@teste.com', '$2y$10$csED5ewabKi23b5DPnSfp.OyIfY/C.IdOkrTpuEyvMtdyjpMqeKnC', 'bfb81903004db742092968140faad1db12d7b4bc24aac20f67f987b07039f6000ac2a4da394935ed3b8ca67ec9be9cfd134993ad63381ebb79b982d3.jpg', 'ed317f3c0a6929b9c7d90b09d48ea0d95ac9a8841f6bc37e931179db8119352823a27ace353bc89f1ba2c884223e4b431bf6', 'I like good movies'),
(2, 'Teste', '2', 'teste2@2.com', '$2y$10$CL5Wi5I8QKexwR1Wufm6reXCghWyx0XFE2rcdaEWPtxddg4BH368S', NULL, '3804fff0795b7033f1cd25ae243521acdf373c6a947b55aa4b448a229346da8532e6e63cbbdd2cd763a4866667bb175ef86d', NULL),
(3, '123', '1234', 'ron@a.com', '$2y$10$wu67cdrsxpHqC3wA8VT8OOxxC5yvik5vjan.8rpEbdQWU.KhgEGJ.', NULL, 'bafdd128eab604288bf3bd0e57dea9122910241ebd4278253c1d62bbc9eaf1a663cac8e34945bc2787fa4dc36acc3f568def', NULL),
(4, 'opa', 'eae', 'opa@opa', '$2y$10$JafBLdjIUWXAEwAiO.6UWe.5.jMxCzRhQzl6XwXYFysxlhSF5gPda', NULL, '7a1c776f929e2734cdbb2638237a0305267c09524aa44c1b7c23d8f6d3bccc2d65abbac1b680b59c1cff0a89da1ed9fa9cfb', NULL),
(5, 'Rony', 'Castro', 'a@a.com', '$2y$10$V5hZMcBok0DWlQ6ng9Svlu.YX5YrevTFzRLShqz..8/e.wul1BC5O', NULL, 'baa18f6a54efca48f9eaae3c55501242d03cc4313609cdd914931f9675ffb0ab5a40a5a17adadbaaf62b8f81225d9ca3c169', NULL),
(6, 'Let', 'Gouvea', 'let@let.com', '$2y$10$JG2p.3P3qJMJg1PFVuYDn.N4IHtjTKL7bTCD4fX8aQWWqnuk5BgHC', '3b59420db6de30b767542f8e7a4b0b5e1a82131331467471e80e614f2ba62cac02fe01e4e78c1593e1b957df4cb4938a34bb793eb1152f499ea3cf90.jpg', '71c80c23fd0a19d5a91f57270f3b3e0ff8549b16551632757decc6c96711fce011c98288c11d360afeed2fa3096225cdfbd5', 'OI');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `movies`
--
ALTER TABLE `movies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
