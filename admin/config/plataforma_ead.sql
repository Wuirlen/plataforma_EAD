-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.21 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para plataforma_ead
CREATE DATABASE IF NOT EXISTS `plataforma_ead` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `plataforma_ead`;

-- Copiando estrutura para tabela plataforma_ead.aluno
CREATE TABLE IF NOT EXISTS `aluno` (
  `id_aluno` int NOT NULL AUTO_INCREMENT,
  `nome_aluno` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `endereco_aluno` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cidade_aluno` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bairro_aluno` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `uf` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cep` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `foto` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `senha` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telefone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL,
  `ativo_aluno` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_cargo_aluno` int DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `acesso_atual` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_aluno`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela plataforma_ead.aluno: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
INSERT INTO `aluno` (`id_aluno`, `nome_aluno`, `endereco_aluno`, `cidade_aluno`, `bairro_aluno`, `uf`, `cep`, `foto`, `email`, `senha`, `telefone`, `data_cadastro`, `ativo_aluno`, `id_cargo_aluno`, `cpf`, `acesso_atual`) VALUES
	(17, 'ana cleide prescinca guedes', 'Rua sena, 42', 'manaus', 'Jorge Teixeira', 'PB', '69054-672', NULL, 'erik.automacao@hotmail.com', '312321', '(25) 85228-5282', '2021-01-14', NULL, 1, '025.197.912-18', NULL),
	(18, 'ana cleide prescinca guedes', 'Rua sena, 42', 'manaus', 'Jorge Teixeira', 'MT', '69054-672', NULL, 'anacleide1109@gmail.com', '22222', '(25) 85228-5282', '2021-01-14', NULL, 1, '222.222.222-22', '2021-02-12'),
	(19, 'lara maria de pinho pinto', 'Rua sena, 42', 'Manaus', 'Jorge Teixeira', 'MG', '69038-470', NULL, 'allan@tutiplast.com', '123', '(92) 99184-4668', '2021-01-26', NULL, 4, '111.111.111-11', '0');
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;

-- Copiando estrutura para tabela plataforma_ead.aluno_curso
CREATE TABLE IF NOT EXISTS `aluno_curso` (
  `id_aluno_curso` int NOT NULL AUTO_INCREMENT,
  `id_curso` int DEFAULT NULL,
  `id_aluno` int DEFAULT NULL,
  `data_matricula` date DEFAULT NULL,
  `hora_matricula` time DEFAULT NULL,
  PRIMARY KEY (`id_aluno_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela plataforma_ead.aluno_curso: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `aluno_curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `aluno_curso` ENABLE KEYS */;

-- Copiando estrutura para tabela plataforma_ead.aula
CREATE TABLE IF NOT EXISTS `aula` (
  `id_aula` int NOT NULL AUTO_INCREMENT,
  `id_modulo` int DEFAULT NULL,
  `titulo_aula` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `duracao_aula` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `embed_youtube` varchar(450) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `embed_vimeo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `slug_aula` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ativo_aula` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_curso` int DEFAULT NULL,
  `path_aula` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_aula`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela plataforma_ead.aula: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `aula` DISABLE KEYS */;
INSERT INTO `aula` (`id_aula`, `id_modulo`, `titulo_aula`, `duracao_aula`, `embed_youtube`, `embed_vimeo`, `slug_aula`, `ativo_aula`, `id_curso`, `path_aula`) VALUES
	(1, 13, 'Programação WEB - Aula 01 - Introdução a Programação WEBBb', '05:16', 'dsvsdv', NULL, 'programacao-web-aula-01-introducao-a-programacao-webbb', NULL, 6, 'teste (2).rar'),
	(2, 13, 'Programação WEB - Aula 02 - Ferramentas de edição de código', '05:16', 'dsvsdv', NULL, 'programacao-web-aula-02-ferramentas-de-edicao-de-codigo', NULL, 6, 'img.rar'),
	(4, 13, 'Programação WEB - Aula 03 - Introdução a Programação WEB para dispositvos', '05:16', 'dsvsdv', NULL, NULL, NULL, 6, 'teste.rar');
/*!40000 ALTER TABLE `aula` ENABLE KEYS */;

-- Copiando estrutura para tabela plataforma_ead.aula_assistida
CREATE TABLE IF NOT EXISTS `aula_assistida` (
  `id_aula_assistida` int NOT NULL AUTO_INCREMENT,
  `id_aula` int DEFAULT NULL,
  `id_aluno` int DEFAULT NULL,
  `id_curso` int DEFAULT NULL,
  `data_assistida` date DEFAULT NULL,
  `hora_assistida` time DEFAULT NULL,
  PRIMARY KEY (`id_aula_assistida`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela plataforma_ead.aula_assistida: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `aula_assistida` DISABLE KEYS */;
INSERT INTO `aula_assistida` (`id_aula_assistida`, `id_aula`, `id_aluno`, `id_curso`, `data_assistida`, `hora_assistida`) VALUES
	(1, 1, 19, 6, '2021-02-12', '17:18:47'),
	(2, 2, 19, 6, '2021-02-12', '17:19:10'),
	(3, 4, 19, 6, '2021-02-12', '17:19:29');
/*!40000 ALTER TABLE `aula_assistida` ENABLE KEYS */;

-- Copiando estrutura para tabela plataforma_ead.cargo
CREATE TABLE IF NOT EXISTS `cargo` (
  `id_cargo` int NOT NULL AUTO_INCREMENT,
  `nome_cargo` varchar(250) DEFAULT NULL,
  `descricao` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela plataforma_ead.cargo: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` (`id_cargo`, `nome_cargo`, `descricao`) VALUES
	(1, 'Desenvolvedor Jr', 'Desenvolver Aplicações de Software.'),
	(2, 'Gerente de Software', 'Gerenciar Construção de Software.'),
	(3, 'Diretor', 'Mandar em tudo.'),
	(4, 'bugas', 'dsdf');
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;

-- Copiando estrutura para tabela plataforma_ead.cargo_curso
CREATE TABLE IF NOT EXISTS `cargo_curso` (
  `id_cargo_curso` int NOT NULL AUTO_INCREMENT,
  `id_cargo` int NOT NULL,
  `id_curso` int NOT NULL,
  PRIMARY KEY (`id_cargo_curso`) USING BTREE,
  UNIQUE KEY `UK_id_cargo_id_curso` (`id_cargo`,`id_curso`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela plataforma_ead.cargo_curso: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `cargo_curso` DISABLE KEYS */;
INSERT INTO `cargo_curso` (`id_cargo_curso`, `id_cargo`, `id_curso`) VALUES
	(1, 1, 4),
	(8, 1, 5),
	(2, 1, 6),
	(3, 2, 2),
	(4, 2, 4),
	(5, 3, 3),
	(6, 4, 1),
	(9, 4, 2),
	(10, 4, 3),
	(11, 4, 4),
	(7, 4, 5),
	(12, 4, 6);
/*!40000 ALTER TABLE `cargo_curso` ENABLE KEYS */;

-- Copiando estrutura para tabela plataforma_ead.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(32) NOT NULL,
  `text` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela plataforma_ead.chat: 0 rows
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;

-- Copiando estrutura para tabela plataforma_ead.comentario
CREATE TABLE IF NOT EXISTS `comentario` (
  `id_comentario` int NOT NULL AUTO_INCREMENT,
  `id_aula` int DEFAULT NULL,
  `id_aluno` int DEFAULT NULL,
  `comentario` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `data_comentario` date DEFAULT NULL,
  `hora_comentario` time DEFAULT NULL,
  `titulo_comentario` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_comentario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela plataforma_ead.comentario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
INSERT INTO `comentario` (`id_comentario`, `id_aula`, `id_aluno`, `comentario`, `data_comentario`, `hora_comentario`, `titulo_comentario`) VALUES
	(3, 3, 1, 'drer', '2020-12-04', '14:57:41', NULL);
/*!40000 ALTER TABLE `comentario` ENABLE KEYS */;

-- Copiando estrutura para tabela plataforma_ead.curso
CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int NOT NULL AUTO_INCREMENT,
  `nome_curso` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `imagem_curso` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `duracao_curso` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `slug_curso` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `descricao_curso` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `embed` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ativo_curso` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela plataforma_ead.curso: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`id_curso`, `nome_curso`, `imagem_curso`, `duracao_curso`, `slug_curso`, `descricao_curso`, `embed`, `ativo_curso`) VALUES
	(1, 'Curso de Edição de Video', NULL, '23:42', 'curso-de-edicao-de-video', 'Entender os princípios básicos de criar um vídeo.', 'kcmksm', 'S'),
	(2, 'Gestão de Projetos', '3f8c291dcca762caa0b472f16d27bde0.png', '23:42', 'gestao-de-projetos', 'Gerenciamento de Projetos de Software.', 'kcmksm', 'S'),
	(3, 'Princípios de Como se Tornar um Bom diretor', NULL, '23:42', 'principios-de-como-se-tornar-um-bom-diretor', 'Entender os princípios básicos de Mandar. ', 'kcmksm', 'S'),
	(4, 'Lógica de Programação', NULL, '23:42', 'logica-de-programacao', 'Entender os princípios básicos de programar. ', 'kcmksm', 'S'),
	(5, 'Corel Draw e Photoshop', NULL, '12:32', 'corel-draw-e-photoshop', 'Desenvolver skills na Arte de Imagens.', 'kcmksm', 'S'),
	(6, 'Programação WEB - HTML 5, CSS 3 e JavaScript', 'a3cba495d22e225f99c15dced65d112e.png', '02:15', 'programacao-web-html-5-css-3-e-javascript', 'Desenvolvimento web é o termo utilizado para descrever o desenvolvimento de sites, na Internet ou numa intranet.', 'cjknejwfn', 'S'),
	(10, 'sem titulo', NULL, NULL, NULL, NULL, NULL, NULL),
	(22, 'Teste teste', NULL, '16:51', 'teste-teste', 'sadasds', 'wdererw', 'S');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;

-- Copiando estrutura para tabela plataforma_ead.download
CREATE TABLE IF NOT EXISTS `download` (
  `id_download` int NOT NULL AUTO_INCREMENT,
  `id_curso` int DEFAULT NULL,
  `titulo_download` varchar(150) DEFAULT NULL,
  `path_download` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_aula` int DEFAULT NULL,
  PRIMARY KEY (`id_download`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela plataforma_ead.download: ~26 rows (aproximadamente)
/*!40000 ALTER TABLE `download` DISABLE KEYS */;
INSERT INTO `download` (`id_download`, `id_curso`, `titulo_download`, `path_download`, `id_aula`) VALUES
	(1, 1, 'dsf', '0fbe6bdc7f02e7bf185c993d0c77c165.png', 4),
	(3, 1, 'scdsvdv', '81b5d4cee80a1cbae6fedd723abe10a4.png', 38),
	(14, 1, 'scdsvdv', '80b078e41f2316c81d6c05b9fa32d014.png', 36),
	(15, 1, 'scdsvdv', 'ef50ed1d6293ff812a54ab20eab9c197.png', 36),
	(16, 1, 'scdsvdv', 'ef50ed1d6293ff812a54ab20eab9c197.png', 36),
	(17, 1, 'scdsvdv', '36574ed5a96283d3871ad1760ad9b0e6.png', 36),
	(18, 1, 'scdsvdv', '36574ed5a96283d3871ad1760ad9b0e6.png', 36),
	(19, 1, 'scdsvdv', '36574ed5a96283d3871ad1760ad9b0e6.png', 36),
	(20, 1, 'scdsvdv', '36574ed5a96283d3871ad1760ad9b0e6.png', 36),
	(21, 1, 'scdsvdv', '238af7395059b4e7bdbfd058a1f3ccc9.png', 36),
	(22, 1, 'scdsvdv', '238af7395059b4e7bdbfd058a1f3ccc9.png', 36),
	(23, 1, 'scdsvdv', '238af7395059b4e7bdbfd058a1f3ccc9.png', 36),
	(24, 1, 'scdsvdv', '238af7395059b4e7bdbfd058a1f3ccc9.png', 36),
	(25, 1, 'scdsvdv', '6d8f3f45c50c92934f5b0b228cb1f9b2.png', 36),
	(26, 1, 'scdsvdv', '6d8f3f45c50c92934f5b0b228cb1f9b2.png', 36),
	(27, 1, 'scdsvdv', 'e57925bf64bd03d30a99fd1118965edc.png', 36),
	(28, 1, 'scdsvdv', 'e57925bf64bd03d30a99fd1118965edc.png', 36),
	(29, 1, 'scdsvdv', 'f036cc56cefb84d0a53b374c574f407b.png', 36),
	(30, 1, 'scdsvdv', 'f036cc56cefb84d0a53b374c574f407b.png', 36),
	(31, 1, 'scdsvdv', 'f036cc56cefb84d0a53b374c574f407b.png', 36),
	(32, 1, 'scdsvdv', 'f036cc56cefb84d0a53b374c574f407b.png', 36),
	(36, 6, 'scdsvdv', '942117f075d52531c7b21839d3cae903.png', 13),
	(37, 6, 'scdsvdv', '11e61d737f7742d0a3d367eb6a0294a9.png', 13),
	(38, 6, 'scdsvdv', '03ad8b86b3e52743c4496f6690353b4b.png', 13),
	(39, 6, 'scdsvdv', 'a1d395ce070216c258a75c2bc63527a8.png', 13),
	(43, 1, 'erertet', '902b19efbd5820428d6988c17205e70c.png', 13);
/*!40000 ALTER TABLE `download` ENABLE KEYS */;

-- Copiando estrutura para tabela plataforma_ead.modulo
CREATE TABLE IF NOT EXISTS `modulo` (
  `id_modulo` int NOT NULL AUTO_INCREMENT,
  `titulo_modulo` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_curso` int DEFAULT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela plataforma_ead.modulo: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
INSERT INTO `modulo` (`id_modulo`, `titulo_modulo`, `id_curso`) VALUES
	(13, 'Unidade 1', 6),
	(14, 'Unidade 2', 6),
	(15, 'Unidade 3', 6),
	(17, 'Unidade 1', 1),
	(20, 'Unidade 4', 6),
	(21, 'Ex::Informe um Título', 0);
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;

-- Copiando estrutura para tabela plataforma_ead.resposta
CREATE TABLE IF NOT EXISTS `resposta` (
  `id_resposta` int NOT NULL AUTO_INCREMENT,
  `id_comentario` int DEFAULT NULL,
  `id_aluno` int DEFAULT NULL,
  `data_resposta` date DEFAULT NULL,
  `hora_resposta` time DEFAULT NULL,
  PRIMARY KEY (`id_resposta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela plataforma_ead.resposta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `resposta` DISABLE KEYS */;
/*!40000 ALTER TABLE `resposta` ENABLE KEYS */;

-- Copiando estrutura para tabela plataforma_ead.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(200) DEFAULT NULL,
  `login_usuario` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `senha_usuario` varchar(100) DEFAULT NULL,
  `foto` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela plataforma_ead.usuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `login_usuario`, `senha_usuario`, `foto`) VALUES
	(1, 'tutilabs', 'teste', 'teste', 'd9559a0140971207670dee0e3b9887d6.png');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
