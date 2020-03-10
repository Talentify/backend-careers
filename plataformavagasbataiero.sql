-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Mar-2020 às 01:10
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `plataformavagasbataiero`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `email`, `ativo`) VALUES
(1, 'Rafael', '1234!@', 'johnrambo@mail.com', 1),
(2, 'Vanessa', '1234!@', 'clarkkent@mail.com', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vagas`
--

CREATE TABLE `vagas` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `workplace` varchar(256) DEFAULT NULL,
  `salary` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vagas`
--

INSERT INTO `vagas` (`id`, `title`, `description`, `status`, `workplace`, `salary`) VALUES
(10, 'Recepcionista', 'Área e especialização profissional: Administração - Recepção\nNível hierárquico: Auxiliar\nLocal de trabalho: São Paulo, SP\nRegime de contratação de tipo Efetivo – CLT\nJornada Parcial tardes', 1, 'Atendimento ao publico, abertura de ficha, esclarecimento de dúvidas, autorização junto ao convênio, pré faturamento e outras atividades relacionadas ao cargo. Horário: 13:00 ás 19:00 ou 16:00 ás 22:00 (6x1)', '1500'),
(11, 'Jovem Aprendiz - SP', 'Sobre a Stone\n\nAtuamos na indústria de pagamentos, lutando para servir o nosso cliente e provar que há uma maneira mais justa, pessoal e inteligente de fazer negócio.\n\nEstamos crescendo em um ritmo forte e assumimos desafios cada vez maiores e mais difíceis. Queremos nos tornar os melhores em serviços aos clientes e construir um negócio grande: em receita, colaboradores e pessoas impactadas.', 1, 'Desejável ter entre 14 e 22 anos.', '700'),
(12, 'Esteticista', '• Nível: Técnico\n• Contratação: Registro PJ\n• 2 vaga(s)\n• Comissão: 30\n• Vale Transporte, Oferece Material', 1, 'RUA MARIA FIGUEIREDO, 177 - Paraíso - SAO PAULO / São Paulo', '850,00'),
(13, 'Consultor', 'Gerenciamento de carteira de clientes, desenvolvimento de avaliações e orçamentos, criação de novas promoções, desenvolver e manter bom relacionamento com clientes, num mercado de médio e alto padrão, prospecção de novos clientes. Identificar as necessidades dos clientes, antecipando-se na busca de oportunidades de encantá- lo, estabelecendo uma relação de parceria, satisfação e fidelização. Foco em metas e resultados, estabelecer planos de ações com objetivo de curto, médio e longo prazo junto a Gerente da área. Desejável formação em Estética, Biomedicina Esteta ou Fisioterapeuta Dermato Funcional.', 1, 'Conhecimento intermediário no pacote office.', '7863,00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `vagas`
--
ALTER TABLE `vagas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
