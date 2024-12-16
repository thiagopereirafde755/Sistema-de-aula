-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3316
-- Tempo de geração: 16/12/2024 às 19:16
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
-- Banco de dados: `sisteam_de_aula`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm`
--

CREATE TABLE `adm` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `adm`
--

INSERT INTO `adm` (`id`, `nome`, `senha`) VALUES
(5, 'adm', 'abc'),
(6, 'adm1', 'teste');

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL,
  `nome` varchar(70) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `codigo_recuperacao` varchar(6) DEFAULT NULL,
  `data_geracao_codigo` datetime DEFAULT NULL,
  `codigo_confirmacao` varchar(6) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT 0,
  `data_registro` datetime DEFAULT current_timestamp(),
  `foto_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos_salas`
--

CREATE TABLE `alunos_salas` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) DEFAULT NULL,
  `salas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividades`
--

CREATE TABLE `atividades` (
  `id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `data_envio` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividades_salas`
--

CREATE TABLE `atividades_salas` (
  `atividade_id` int(11) NOT NULL,
  `sala_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `professores`
--

CREATE TABLE `professores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `codigo_recuperacao` varchar(6) DEFAULT NULL,
  `data_geracao_codigo` datetime DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `professores_materias`
--

CREATE TABLE `professores_materias` (
  `professor_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `professores_salas`
--

CREATE TABLE `professores_salas` (
  `professor_id` int(11) DEFAULT NULL,
  `sala_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `salas`
--

CREATE TABLE `salas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `salas_materias`
--

CREATE TABLE `salas_materias` (
  `salas_id` int(11) NOT NULL,
  `materias_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `verificacoes`
--

CREATE TABLE `verificacoes` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `alunos_salas`
--
ALTER TABLE `alunos_salas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `salas_id` (`salas_id`);

--
-- Índices de tabela `atividades`
--
ALTER TABLE `atividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor_id` (`professor_id`),
  ADD KEY `materia_id` (`materia_id`);

--
-- Índices de tabela `atividades_salas`
--
ALTER TABLE `atividades_salas`
  ADD PRIMARY KEY (`atividade_id`,`sala_id`),
  ADD KEY `sala_id` (`sala_id`);

--
-- Índices de tabela `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `professores_materias`
--
ALTER TABLE `professores_materias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `professores_salas`
--
ALTER TABLE `professores_salas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `salas_materias`
--
ALTER TABLE `salas_materias`
  ADD PRIMARY KEY (`salas_id`,`materias_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `materias_id` (`materias_id`);

--
-- Índices de tabela `verificacoes`
--
ALTER TABLE `verificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adm`
--
ALTER TABLE `adm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `alunos_salas`
--
ALTER TABLE `alunos_salas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `atividades`
--
ALTER TABLE `atividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `professores`
--
ALTER TABLE `professores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `professores_materias`
--
ALTER TABLE `professores_materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `professores_salas`
--
ALTER TABLE `professores_salas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `salas`
--
ALTER TABLE `salas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `salas_materias`
--
ALTER TABLE `salas_materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `verificacoes`
--
ALTER TABLE `verificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `alunos_salas`
--
ALTER TABLE `alunos_salas`
  ADD CONSTRAINT `alunos_salas_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`),
  ADD CONSTRAINT `alunos_salas_ibfk_2` FOREIGN KEY (`salas_id`) REFERENCES `salas` (`id`);

--
-- Restrições para tabelas `atividades`
--
ALTER TABLE `atividades`
  ADD CONSTRAINT `atividades_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `professores` (`id`),
  ADD CONSTRAINT `atividades_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`);

--
-- Restrições para tabelas `atividades_salas`
--
ALTER TABLE `atividades_salas`
  ADD CONSTRAINT `atividades_salas_ibfk_1` FOREIGN KEY (`atividade_id`) REFERENCES `atividades` (`id`),
  ADD CONSTRAINT `atividades_salas_ibfk_2` FOREIGN KEY (`sala_id`) REFERENCES `salas` (`id`);

--
-- Restrições para tabelas `salas_materias`
--
ALTER TABLE `salas_materias`
  ADD CONSTRAINT `salas_materias_ibfk_1` FOREIGN KEY (`salas_id`) REFERENCES `salas` (`id`),
  ADD CONSTRAINT `salas_materias_ibfk_2` FOREIGN KEY (`materias_id`) REFERENCES `materias` (`id`);

--
-- Restrições para tabelas `verificacoes`
--
ALTER TABLE `verificacoes`
  ADD CONSTRAINT `verificacoes_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
