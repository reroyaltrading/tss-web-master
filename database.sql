-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.34-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela royalcrm.asigned_tasks
CREATE TABLE IF NOT EXISTS `asigned_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `status_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `hash_import` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_asigned_tasks_users` (`user_id`),
  KEY `FK_asigned_tasks_client_statuses` (`status_id`),
  KEY `FK_asigned_tasks_companies` (`company_id`),
  CONSTRAINT `FK_asigned_tasks_client_statuses` FOREIGN KEY (`status_id`) REFERENCES `client_statuses` (`id`),
  CONSTRAINT `FK_asigned_tasks_companies` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  CONSTRAINT `FK_asigned_tasks_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela royalcrm.asigned_tasks: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `asigned_tasks` DISABLE KEYS */;
REPLACE INTO `asigned_tasks` (`id`, `user_id`, `status_id`, `company_id`, `hash_import`) VALUES
	(6, 1, 1, 1, 'FIN-2019415-FE2BD'),
	(7, 1, 4, 1, 'FIN-2019415-FE2BD');
/*!40000 ALTER TABLE `asigned_tasks` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state_province` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `optional_code` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `company_id` int(11) NOT NULL,
  `hash_import` varchar(50) NOT NULL,
  `is_locked` int(11) NOT NULL DEFAULT '0',
  `description` varchar(50) DEFAULT '0',
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_clients_client_statuses` (`status_id`),
  KEY `FK_clients_companies` (`company_id`),
  CONSTRAINT `FK_clients_client_statuses` FOREIGN KEY (`status_id`) REFERENCES `client_statuses` (`id`),
  CONSTRAINT `FK_clients_companies` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela royalcrm.clients: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
REPLACE INTO `clients` (`id`, `name`, `phone`, `city`, `state_province`, `postal_code`, `optional_code`, `email`, `status_id`, `company_id`, `hash_import`, `is_locked`, `description`, `active`) VALUES
	(66, 'Marco', '+5513997574127', 'Santos', 'Sao Paulo', '113000-000', '13', 'marco@email.com', 1, 1, 'FIN-2019415-FE2BD', 0, 'a', 1),
	(67, 'Alexandre Novaes Iosimura', '+14372149458', 'Toronto', 'Ontario', '0', '65', 'alexandre@email.com', 4, 1, 'FIN-2019415-FE2BD', 0, '0', 1),
	(68, 'Valmir', '+14372149458', NULL, NULL, NULL, NULL, NULL, 1, 1, 'FIN-2019415-FE2BD', 0, '0', 1),
	(69, 'Pedro', '+5513997574127', NULL, NULL, NULL, NULL, NULL, 1, 1, 'FIN-2019415-FE2BD', 0, '0', 1),
	(91, 'name', 'phone', 'city', 'state_province', 'postal_code', 'optional_code', 'email', 4, 3, '010212201904265cc25894eda4e', 0, 'description', 1),
	(92, 'name', 'phone', 'city', 'state_province', 'postal_code', 'optional_code', 'email', 4, 3, '010212201904265cc25894eda4e', 0, 'description', 1),
	(93, 'Pedro', '123', 'Santos', 'Sao Paulo', '1a', '1', 'email@email.com', 4, 3, '010212201904265cc25894eda4e', 0, 'none', 1),
	(94, 'name', 'phone', 'city', 'state_province', 'postal_code', 'optional_code', 'email', 4, 3, '010212201904265cc25894eda4e', 0, 'description', 1),
	(95, 'Pedro', '123', 'Santos', 'Sao Paulo', '1a', '1', 'email@email.com', 4, 3, '010212201904265cc25894eda4e', 0, 'none', 1),
	(96, 'Tiago', '123', 'Totonto', 'Ontatio', '2b', '2', 'email@email.com', 4, 3, '010212201904265cc25894eda4e', 0, 'none', 1),
	(97, 'name', 'phone', 'city', 'state_province', 'postal_code', 'optional_code', 'email', 4, 3, '010212201904265cc25894eda4e', 0, 'description', 1),
	(98, 'Pedro', '123', 'Santos', 'Sao Paulo', '1a', '1', 'email@email.com', 4, 3, '010212201904265cc25894eda4e', 0, 'none', 1),
	(99, 'Tiago', '123', 'Totonto', 'Ontatio', '2b', '2', 'email@email.com', 4, 3, '010212201904265cc25894eda4e', 0, 'none', 1),
	(100, 'Henry', '123', 'Santos', 'Sao Paulo', '3c', '3', 'email@email.com', 4, 3, '010212201904265cc25894eda4e', 0, 'none', 1),
	(101, 'name', 'phone', 'city', 'state_province', 'postal_code', 'optional_code', 'email', 4, 3, '010212201904265cc25894eda4e', 0, 'description', 1),
	(102, 'Pedro', '123', 'Santos', 'Sao Paulo', '1a', '1', 'email@email.com', 4, 3, '010212201904265cc25894eda4e', 0, 'none', 1),
	(103, 'Tiago', '123', 'Totonto', 'Ontatio', '2b', '2', 'email@email.com', 4, 3, '010212201904265cc25894eda4e', 0, 'none', 1),
	(104, 'Henry', '123', 'Santos', 'Sao Paulo', '3c', '3', 'email@email.com', 4, 3, '010212201904265cc25894eda4e', 0, 'none', 1),
	(105, 'Mathew', '2334', 'Totonto', 'Ontatio', '4d', '4', 'email@email.com', 4, 3, '010212201904265cc25894eda4e', 0, 'none', 1),
	(106, 'name', 'phone', 'city', 'state_province', 'postal_code', 'optional_code', 'email', 4, 3, '010212201904265cc25894eda4e', 0, 'description', 1),
	(107, 'Pedro', '123', 'Santos', 'Sao Paulo', '1a', '1', 'email@email.com', 4, 3, '010212201904265cc25894eda4e', 0, 'none', 1),
	(108, 'Tiago', '123', 'Totonto', 'Ontatio', '2b', '2', 'email@email.com', 4, 3, '010212201904265cc25894eda4e', 0, 'none', 1),
	(109, 'Henry', '123', 'Santos', 'Sao Paulo', '3c', '3', 'email@email.com', 4, 3, '010212201904265cc25894eda4e', 0, 'none', 1),
	(110, 'Mathew', '2334', 'Totonto', 'Ontatio', '4d', '4', 'email@email.com', 4, 3, '010212201904265cc25894eda4e', 0, 'none', 1),
	(111, 'Teresa', '456', 'Tokyo', 'Tokyo Prefecture', '5e', '5', 'email@email.com', 4, 3, '010212201904265cc25894eda4e', 0, 'none', 1);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.client_history
CREATE TABLE IF NOT EXISTS `client_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `content` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela royalcrm.client_history: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `client_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_history` ENABLE KEYS */;

-- Copiando estrutura para view royalcrm.client_log
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `client_log` (
	`id` INT(11) NOT NULL,
	`description` LONGTEXT NULL COLLATE 'latin1_swedish_ci',
	`client_id` INT(11) NULL,
	`created_by` INT(11) UNSIGNED NULL,
	`user_name` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`created_at` DATETIME NULL
) ENGINE=MyISAM;

-- Copiando estrutura para tabela royalcrm.client_messages
CREATE TABLE IF NOT EXISTS `client_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11),
  `user_id` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message_text` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_client_messages_clients` (`client_id`),
  KEY `FK_client_messages_users` (`user_id`),
  CONSTRAINT `FK_client_messages_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `FK_client_messages_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela royalcrm.client_messages: ~23 rows (aproximadamente)
/*!40000 ALTER TABLE `client_messages` DISABLE KEYS */;
REPLACE INTO `client_messages` (`id`, `client_id`, `user_id`, `created_at`, `message_text`) VALUES
	(1, 67, 2, '2019-04-18 15:15:00', 'Olá'),
	(2, 67, 1, '2019-04-18 16:04:30', 'teste'),
	(3, 67, 1, '2019-04-18 16:04:35', 'teste'),
	(4, 67, 1, '2019-04-18 16:04:53', 'teste'),
	(5, 66, 1, '2019-04-18 16:29:45', 'testing'),
	(6, 67, 1, '2019-04-18 16:52:13', 'Ol? Alexandre, junte-se ao TSS'),
	(7, 66, 1, '2019-04-18 16:58:06', 'test'),
	(8, 66, 1, '2019-04-18 16:58:29', 'test'),
	(9, 66, 1, '2019-04-18 16:59:27', 'test'),
	(10, 66, 1, '2019-04-18 17:00:15', 'verificando o custo de envio de sms'),
	(11, 66, 1, '2019-04-18 17:17:31', 'oi marco'),
	(12, 67, 1, '2019-04-18 22:35:46', 'oi cara'),
	(13, 68, 1, '2019-04-18 22:38:47', 'testandi'),
	(14, 68, 1, '2019-04-18 22:40:18', 'send'),
	(15, 66, 1, '2019-04-18 23:47:38', 'enviando sms'),
	(16, 69, 1, '2019-04-19 00:41:00', 'novo sms'),
	(17, 67, 1, '2019-04-21 21:16:46', 'testando amazon web'),
	(18, 68, 1, '2019-04-21 21:17:20', 'testando amazn'),
	(19, 69, 1, '2019-04-21 21:17:50', 'teste'),
	(20, 66, 1, '2019-04-21 21:19:23', '1'),
	(21, 69, 1, '2019-04-21 21:20:30', 'amazon'),
	(22, 69, 1, '2019-04-21 21:21:31', 'oi cara'),
	(23, 69, 1, '2019-04-21 21:31:41', 'consegui integrar o sistema da amazon em php'),
	(24, 69, 1, '2019-04-21 21:31:52', 'está vendo?');
/*!40000 ALTER TABLE `client_messages` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.client_notes
CREATE TABLE IF NOT EXISTS `client_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) unsigned NOT NULL,
  `description` longtext,
  `created_at` datetime DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `date_to_call` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_client_notes_users` (`created_by`),
  KEY `FK_client_notes_clients` (`client_id`),
  CONSTRAINT `FK_client_notes_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `FK_client_notes_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela royalcrm.client_notes: ~21 rows (aproximadamente)
/*!40000 ALTER TABLE `client_notes` DISABLE KEYS */;
REPLACE INTO `client_notes` (`id`, `created_by`, `description`, `created_at`, `client_id`, `status_id`, `date_to_call`) VALUES
	(1, 2, 'AAAAAAAA', '2019-04-17 12:54:14', 68, NULL, NULL),
	(2, 1, 'testing again', NULL, 68, NULL, NULL),
	(3, 1, 'testing again', NULL, 68, NULL, NULL),
	(4, 1, 'aaa', NULL, 67, NULL, NULL),
	(5, 1, 'O cliente estava com problemas no atendimento', NULL, 67, NULL, NULL),
	(6, 1, 'aaaa', NULL, 68, NULL, NULL),
	(7, 1, 'teste', NULL, 69, NULL, NULL),
	(8, 1, 'testintg', NULL, 66, NULL, NULL),
	(9, 1, 'nome do cara', NULL, 68, NULL, NULL),
	(10, 1, 'test2', NULL, 69, NULL, NULL),
	(11, 1, 'posso adicionar quantas notas eu quiser no sistema web deste cliente', NULL, 69, NULL, NULL),
	(12, 1, 'tired of hearing sorry', NULL, 69, NULL, NULL),
	(13, 1, 'qualquer coisa que eu quiser', NULL, 68, NULL, NULL),
	(14, 1, 'adicionando uma nota', NULL, 66, NULL, NULL),
	(15, 1, 'testing', NULL, 66, NULL, '04/30/2019'),
	(16, 1, NULL, NULL, 66, NULL, '04/30/2019'),
	(17, 1, NULL, NULL, 66, NULL, '04/30/2019'),
	(18, 1, NULL, NULL, 66, NULL, '04/30/2019'),
	(19, 1, 'a', NULL, 67, 10, NULL),
	(20, 1, NULL, NULL, 68, 4, '04/24/2019'),
	(21, 1, 'testing call', NULL, 66, 4, '04/25/2019'),
	(22, 1, NULL, NULL, 67, 4, '04/30/2019'),
	(23, 1, 'teste', NULL, 67, 4, '04/18/2019');
/*!40000 ALTER TABLE `client_notes` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.client_statuses
CREATE TABLE IF NOT EXISTS `client_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela royalcrm.client_statuses: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `client_statuses` DISABLE KEYS */;
REPLACE INTO `client_statuses` (`id`, `name`) VALUES
	(1, 'New Lead'),
	(2, 'To Call'),
	(3, 'Voice Mail'),
	(4, 'Callback'),
	(5, 'Follow Up'),
	(6, 'Appointment Schedule'),
	(7, 'In progress'),
	(8, 'Sale'),
	(9, 'Not interested'),
	(10, 'Dead'),
	(11, 'Hoax'),
	(12, 'Do Not Call'),
	(13, 'Number out of service');
/*!40000 ALTER TABLE `client_statuses` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.client_status_logs
CREATE TABLE IF NOT EXISTS `client_status_logs` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) DEFAULT NULL,
  `id_status` int(11) DEFAULT NULL,
  `changed_at` int(11) DEFAULT NULL,
  `changed_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela royalcrm.client_status_logs: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `client_status_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_status_logs` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.companies
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `site` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela royalcrm.companies: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
REPLACE INTO `companies` (`id`, `name`, `site`) VALUES
	(1, 'Fine Homes Real State', 'https://finehomesrealstate.ca'),
	(2, 'MeKontrol', 'https://mekontrol.com'),
	(3, 'Basements to Go', 'basementstogo.ca'),
	(4, 'Lowcalorie Plans', 'https://lowcalorieplans.ca');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `original_name` varchar(50) DEFAULT NULL,
  `extension` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `import_id` int(11) DEFAULT '0',
  `processed` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela royalcrm.files: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
REPLACE INTO `files` (`id`, `name`, `location`, `original_name`, `extension`, `user_id`, `import_id`, `processed`) VALUES
	(5, '230021201904255cc23c0552c35', '/storage/app/uploads/YGDedF73dPSDhmNJyFvOTk8uK7NiIQOCTdNLKAhn.txt', 'SD.rtx', 'txt', 1, 2, 0),
	(6, '230234201904255cc23c8a05579', '/storage/app/uploads/JhGBqkCgDN05B0XhOtaFKyI1KNSECNYsSmEENdkH.txt', 'SD.rtx', 'txt', 1, 4, 0),
	(7, '230244201904255cc23c94ecec3', '/storage/app/uploads/H0KPwSb6a4XUo5i2RRtgEFz3OWeSZ4ZEOQqmi3hT.png', 'unnamed.png', 'png', 1, 4, 0),
	(8, '230317201904255cc23cb542b94', '/storage/app/uploads/hc4VB90DKLtez0FGKwsA7wVT5k7ZXHs13zbperhh.txt', 'SD.rtx', 'txt', 1, 5, 0),
	(12, '232652201904255cc2423c8e89a', '/storage/app/uploads/Wbxwe0xNs8ARr7ZpdhF5GnQvZLwq6gCXJfTVP9dO.txt', 'SD.rtx', 'txt', 1, 6, 0),
	(13, '232736201904255cc242689981d', '/storage/app/uploads/A3mut1n1fJBmdYoPE2DARKyvWEipXgkJKvEi9AWf.html', 'DialUPSys.html', 'html', 1, 7, 0),
	(16, '001850201904265cc24e6ae8ffe', '/app/uploads/3PrVKP8VWU4vXsOTCktNWOtmx2B2y8qEDSoXrua5.xlsx', 'import_example.xlsx', 'xlsx', 1, 8, 1);
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.imports
CREATE TABLE IF NOT EXISTS `imports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash_import` varchar(50) NOT NULL,
  `status_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_imports_client_statuses` (`status_id`),
  KEY `FK_imports_companies` (`company_id`),
  KEY `FK_imports_users` (`user_id`),
  CONSTRAINT `FK_imports_client_statuses` FOREIGN KEY (`status_id`) REFERENCES `client_statuses` (`id`),
  CONSTRAINT `FK_imports_companies` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  CONSTRAINT `FK_imports_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela royalcrm.imports: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `imports` DISABLE KEYS */;
REPLACE INTO `imports` (`id`, `hash_import`, `status_id`, `company_id`, `user_id`, `created_at`) VALUES
	(8, '001853201904265cc24e6dd7cac', 4, 3, 1, '2019-04-25 21:18:53');
/*!40000 ALTER TABLE `imports` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela royalcrm.logs: ~56 rows (aproximadamente)
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
REPLACE INTO `logs` (`id`, `created_at`, `created_by`, `content`) VALUES
	(1, '2019-04-15 17:24:09', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(2, '2019-04-15 17:42:09', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(3, '2019-04-15 17:42:14', 1, 'User Marco Aurélio Lima locked all clients of '),
	(4, '2019-04-15 17:44:13', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(5, '2019-04-15 17:44:33', 1, 'User Marco Aurélio Lima locked all clients of Voice Mail'),
	(6, '2019-04-15 17:46:48', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(7, '2019-04-15 17:50:16', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(8, '2019-04-15 17:51:22', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(9, '2019-04-15 17:51:30', 1, 'User Marco Aurélio Lima locked all clients of Voice Mail'),
	(10, '2019-04-15 17:52:05', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(11, '2019-04-15 17:53:32', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(12, '2019-04-15 17:53:35', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(13, '2019-04-15 18:53:43', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(14, '2019-04-15 18:53:51', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(15, '2019-04-16 10:53:51', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(16, '2019-04-16 10:53:56', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(17, '2019-04-16 10:59:01', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(18, '2019-04-16 11:00:37', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(19, '2019-04-16 11:05:35', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(20, '2019-04-16 11:09:16', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(21, '2019-04-16 11:09:27', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(22, '2019-04-16 11:52:29', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(23, '2019-04-16 11:52:36', 1, 'User Marco Aurélio Lima locked all clients of FIN-2019415-FE2BD'),
	(24, '2019-04-16 11:57:14', 1, 'User Marco Aurélio Lima locked all clients of '),
	(25, '2019-04-16 11:57:55', 1, 'User Marco Aurélio Lima locked all clients of '),
	(26, '2019-04-16 11:58:58', 1, 'User Marco Aurélio Lima locked all clients of '),
	(27, '2019-04-16 12:00:23', 1, 'User Marco Aurélio Lima locked all clients of '),
	(28, '2019-04-16 12:01:49', 1, 'User Marco Aurélio Lima locked all clients of '),
	(29, '2019-04-16 12:02:32', 1, 'User Marco Aurélio Lima locked all clients of '),
	(30, '2019-04-16 12:04:02', 1, 'User Marco Aurélio Lima locked all clients of '),
	(31, '2019-04-16 12:34:38', 1, 'User Marco Aurélio Lima locked all clients of '),
	(32, '2019-04-16 14:51:13', 1, 'User Marco Aurélio Lima locked all clients of '),
	(33, '2019-04-16 15:09:36', 1, 'User Marco Aurélio Lima locked all clients of '),
	(34, '2019-04-16 15:09:39', 1, 'User Marco Aurélio Lima locked all clients of '),
	(35, '2019-04-16 15:11:30', 1, 'User Marco Aurélio Lima locked all clients of '),
	(36, '2019-04-16 15:11:58', 1, 'User Marco Aurélio Lima locked all clients of '),
	(37, '2019-04-16 15:13:10', 1, 'User Marco Aurélio Lima locked all clients of '),
	(38, '2019-04-16 18:43:10', 1, 'User Marco Aurélio Lima locked all clients of '),
	(39, '2019-04-16 19:25:43', 1, 'User Marco Aurélio Lima locked all clients of '),
	(40, '2019-04-16 19:27:05', 1, 'User Marco Aurélio Lima locked all clients of '),
	(41, '2019-04-16 19:29:58', 1, 'User Marco Aurélio Lima locked all clients of '),
	(42, '2019-04-16 19:32:41', 1, 'User Marco Aurélio Lima locked all clients of '),
	(43, '2019-04-16 21:06:55', 1, 'User Marco Aurélio Lima locked all clients of '),
	(44, '2019-04-17 13:27:29', 1, 'User Marco Aurélio Lima locked all clients of '),
	(45, '2019-04-17 13:34:51', 1, 'User Marco Aurélio Lima locked all clients of '),
	(46, '2019-04-17 14:01:39', 1, 'User Marco Aurélio Lima locked all clients of '),
	(47, '2019-04-17 15:44:29', 1, 'User Marco Aurélio Lima locked all clients of '),
	(48, '2019-04-17 16:11:31', 1, 'User Marco Aurélio Lima locked all clients of '),
	(49, '2019-04-17 16:22:47', 1, 'User Marco Aurélio Lima locked all clients of '),
	(50, '2019-04-17 16:38:11', 1, 'User Marco Aurélio Lima locked all clients of '),
	(51, '2019-04-17 16:42:10', 1, 'User Marco Aurélio Lima locked all clients of '),
	(52, '2019-04-17 16:43:42', 1, 'User Marco Aurélio Lima locked all clients of '),
	(53, '2019-04-17 16:43:56', 1, 'User Marco Aurélio Lima locked all clients of '),
	(54, '2019-04-17 17:17:04', 1, 'User Marco Aurélio Lima locked all clients of '),
	(55, '2019-04-17 18:41:51', 1, 'User Marco Aurélio Lima locked all clients of '),
	(56, '2019-04-17 19:13:14', 1, 'User Marco Aurélio Lima locked all clients of '),
	(57, '2019-04-18 16:28:37', 1, 'User Marco Aurélio Lima locked all clients of '),
	(58, '2019-04-18 16:58:52', 1, 'User Marco Aurélio Lima locked all clients of ');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela royalcrm.migrations: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.password_recoveries
CREATE TABLE IF NOT EXISTS `password_recoveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela royalcrm.password_recoveries: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `password_recoveries` DISABLE KEYS */;
REPLACE INTO `password_recoveries` (`id`, `user_id`, `hash`, `created_at`, `active`) VALUES
	(1, 1, '6852ce2a5706270abd1e0ecaf388bdef', '2019-03-31 19:23:06', 1),
	(2, 1, '6852ce2a5706270abd1e0ecaf388bdef', '2019-03-31 20:09:45', 1);
/*!40000 ALTER TABLE `password_recoveries` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela royalcrm.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `select_company_to_work` int(11) DEFAULT '0',
  `back_office_operator` int(11) DEFAULT '0',
  `front_office_operator` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_permissions_users` (`user_id`),
  CONSTRAINT `FK_permissions_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela royalcrm.permissions: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
REPLACE INTO `permissions` (`id`, `user_id`, `select_company_to_work`, `back_office_operator`, `front_office_operator`) VALUES
	(1, 2, 0, 0, 0),
	(2, 6, 0, 0, 0),
	(3, 1, 0, 1, 1),
	(4, 3, 1, 1, 1);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.scripts
CREATE TABLE IF NOT EXISTS `scripts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `content` longtext,
  `company_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_scripts_companies` (`company_id`),
  KEY `FK_scripts_client_statuses` (`status_id`),
  CONSTRAINT `FK_scripts_client_statuses` FOREIGN KEY (`status_id`) REFERENCES `client_statuses` (`id`),
  CONSTRAINT `FK_scripts_companies` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela royalcrm.scripts: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `scripts` DISABLE KEYS */;
REPLACE INTO `scripts` (`id`, `name`, `content`, `company_id`, `status_id`) VALUES
	(1, 'New Lead Script', '<strong style="margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;">Lorem Ipsum</strong><span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>', 1, 1);
/*!40000 ALTER TABLE `scripts` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `ic_admin` bit(1) NOT NULL DEFAULT b'0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ic_shadow_user` bit(1) DEFAULT b'0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `profile_description` longtext COLLATE utf8mb4_unicode_ci,
  `default_locale` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'en',
  `my_location` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela royalcrm.users: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `ic_admin`, `password`, `remember_token`, `created_at`, `updated_at`, `ic_shadow_user`, `image`, `site`, `phone`, `company_id`, `profile_description`, `default_locale`, `my_location`) VALUES
	(1, 'Marco Aurélio Lima', 'marckdx@outlook.com', '2018-09-05 19:32:30', b'1', 'd9628b779da2ba0a826776d6bb4cc757', 'IpxuHZOvmHITitq5qgXIRxIes9ltN46XZkmNu12sH0xBZvWjcvKj9uBPaCDa', '2018-09-05 19:32:50', '2018-09-05 19:32:51', b'0', 'uploads/fZT8DPZMGuehasmgwSktAcqztNl3iXCNIUiwTilX.png', 'https://marckdx.com', '+5513997574127', 3, '', NULL, NULL),
	(2, 'Alexandre Novaes', 'alexandre@reroyaltrading.ca', '2018-09-13 18:15:28', b'1', 'd9628b779da2ba0a826776d6bb4cc757', NULL, NULL, NULL, b'0', NULL, NULL, NULL, NULL, NULL, 'en', ''),
	(3, 'teste', 'teste@example.com', '2019-04-12 12:31:45', b'1', '698dc19d489c4e4db73e28a713eab07b', NULL, NULL, NULL, b'0', NULL, NULL, NULL, NULL, NULL, 'pt', ''),
	(6, 'jose', 'jose@gmail.com', NULL, b'0', '196b0f14eba66e10fba74dbf9e99c22f', NULL, NULL, NULL, b'0', NULL, 'sdasd', 'sadads', NULL, NULL, 'en', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Copiando estrutura para tabela royalcrm.user_sessions
CREATE TABLE IF NOT EXISTS `user_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(50) DEFAULT NULL,
  `device` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `os` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=309 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela royalcrm.user_sessions: ~276 rows (aproximadamente)
/*!40000 ALTER TABLE `user_sessions` DISABLE KEYS */;
REPLACE INTO `user_sessions` (`id`, `hash`, `device`, `user_id`, `latitude`, `longitude`, `created_at`, `os`) VALUES
	(2, '96ee8b2ada58e60dd01191fe095a982a', 'WindowsPC', 1, NULL, NULL, '2019-04-10 15:45:26', 'Windows'),
	(3, '2110b6af095370f962061c1ca327ad83', 'WindowsPC', 1, NULL, NULL, '2019-04-10 15:52:17', 'Windows'),
	(4, 'de7c1ecf32aab40bd190f4909b7ed7d5', 'WindowsPC', 1, NULL, NULL, '2019-04-10 15:56:14', 'Windows'),
	(5, '6082784a5c81d79972b6c8b0800d92cb', 'WindowsPC', 1, NULL, NULL, '2019-04-10 15:56:18', 'Windows'),
	(6, '440346a8886ca123aa131f28be0eb4fa', 'WindowsPC', 1, NULL, NULL, '2019-04-10 16:27:22', 'Windows'),
	(7, '192855de075aa470526a4c2a7a56e32a', 'WindowsPC', 1, NULL, NULL, '2019-04-10 16:43:36', 'Windows'),
	(8, '05f183defee024b9b08012a1d3b60d2f', 'WindowsPC', 1, NULL, NULL, '2019-04-10 16:44:47', 'Windows'),
	(9, 'd94adf3d00bbbe0097539f43f1693840', 'WindowsPC', 1, NULL, NULL, '2019-04-10 16:45:07', 'Windows'),
	(10, '8b8da191f4136bc488726c5b20eba330', 'WindowsPC', 1, NULL, NULL, '2019-04-10 16:45:47', 'Windows'),
	(11, 'c96f6dcfe68869473fbf0b39c234ea20', 'WindowsPC', 1, NULL, NULL, '2019-04-10 19:29:28', 'Windows'),
	(12, '1704c38462c1634839ee0635868743bf', 'WindowsPC', 1, NULL, NULL, '2019-04-10 19:30:05', 'Windows'),
	(13, 'cf1e01adcc19c13afd399d0d755b80ac', 'WindowsPC', 1, NULL, NULL, '2019-04-10 19:33:32', 'Windows'),
	(14, '7e8633bed3362d8849fcea563d471a53', 'WindowsPC', 1, NULL, NULL, '2019-04-10 19:33:39', 'Windows'),
	(15, '18dd0da63fbc03211b89ece59fb670d3', NULL, 1, NULL, NULL, '2019-04-11 11:08:31', NULL),
	(16, '1652b958d39aeed0f8f68606fc36d184', NULL, 1, NULL, NULL, '2019-04-11 11:11:26', NULL),
	(17, '4de77be0ce53a537fa07e61082ec259d', NULL, 1, NULL, NULL, '2019-04-11 11:13:20', NULL),
	(18, '1b25ecce415705cc47e4b41db9ab3f83', NULL, 1, NULL, NULL, '2019-04-11 11:16:03', NULL),
	(19, 'f5ee70a0d767ee69884576c1ccc0255a', NULL, 1, NULL, NULL, '2019-04-11 11:17:04', NULL),
	(20, '62f89ac8c7f118d0f506349d62779fea', NULL, 1, NULL, NULL, '2019-04-11 11:56:40', NULL),
	(21, '1c5f72822d778858421ccc56273cc7da', NULL, 1, NULL, NULL, '2019-04-11 11:59:22', NULL),
	(22, '289b770d5a26bddeb9d90eacbb1b8a0a', NULL, 1, NULL, NULL, '2019-04-11 12:04:29', NULL),
	(23, '642874016f664725f705f570678780ff', NULL, 1, NULL, NULL, '2019-04-11 12:05:03', NULL),
	(24, 'f2c34f98eac3c2275e25840e30c57541', NULL, 1, NULL, NULL, '2019-04-11 12:08:18', NULL),
	(25, '2e82b166b50778ad1f3df20c8eb5f792', NULL, 1, NULL, NULL, '2019-04-11 12:10:22', NULL),
	(26, 'fce002d0c7d6ec21206b673faa6cb3a0', NULL, 1, NULL, NULL, '2019-04-11 12:10:53', NULL),
	(27, 'f1d6fac7c8c9c2a9b6603855d32a46e0', NULL, 1, NULL, NULL, '2019-04-11 15:28:54', NULL),
	(28, '4d4373bd638f354abe3100772604bb32', 'WindowsPC', 1, NULL, NULL, '2019-04-11 15:36:00', 'Windows'),
	(29, 'd15a2e0580e28348a1583a6690f4df7a', NULL, 1, NULL, NULL, '2019-04-11 15:40:01', NULL),
	(30, 'cd698359736d997ad83fe960c5d1a1c4', 'WindowsPC', 1, NULL, NULL, '2019-04-11 16:00:02', 'Windows'),
	(31, 'de041fcc4f893291cd7a45557848901a', NULL, 1, NULL, NULL, '2019-04-11 16:38:31', NULL),
	(32, '3f637640ad9a951ef458814d8b7ee3ed', NULL, 1, NULL, NULL, '2019-04-11 17:02:53', NULL),
	(33, '9ef06187ee000ef3503c00632c15212e', 'WindowsPC', 1, NULL, NULL, '2019-04-11 17:46:57', 'Windows'),
	(34, '4bce34756554bdf3dcc7d18664cf49a7', 'WindowsPC', 1, NULL, NULL, '2019-04-11 18:26:19', 'Windows'),
	(35, '26e36dfe3908947700f5d841e6aef3d6', 'WindowsPC', 1, NULL, NULL, '2019-04-11 19:03:10', 'Windows'),
	(36, '6bea1e83a6006bceb422ee4ae95840b7', 'WindowsPC', 1, NULL, NULL, '2019-04-11 19:03:45', 'Windows'),
	(37, '6ef1e2f0a3bce0e49573d6adaaf7f001', 'WindowsPC', 1, NULL, NULL, '2019-04-11 19:04:37', 'Windows'),
	(38, '378ab7f1bc88059dc8e984e70955ad0b', 'WindowsPC', 1, NULL, NULL, '2019-04-11 19:05:07', 'Windows'),
	(39, '472d3f90cf9e2758a78ff17d793d3c9b', 'WindowsPC', 1, NULL, NULL, '2019-04-11 19:19:17', 'Windows'),
	(40, '07ab9b389e3e9c0d53a512d2e91a7e71', 'WindowsPC', 1, NULL, NULL, '2019-04-11 19:21:51', 'Windows'),
	(41, 'ad8cb06f9d24b6bb1ed060e22134689f', 'WindowsPC', 1, NULL, NULL, '2019-04-11 19:34:41', 'Windows'),
	(42, '8b2806130e344d7f07874124778bbea0', 'WindowsPC', 1, NULL, NULL, '2019-04-11 19:37:04', 'Windows'),
	(43, 'ba9f443de152102622b00f7cbc9054cf', 'WindowsPC', 1, NULL, NULL, '2019-04-11 19:39:58', 'Windows'),
	(44, '5e4b052ec7ddfb6bb3eb904f5eee5f87', 'WindowsPC', 1, NULL, NULL, '2019-04-11 19:40:38', 'Windows'),
	(45, '4036a806d510b05fb4cf85177b3f7725', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:21:52', 'Windows'),
	(46, 'd9c7c51b00066d8a55d6f9dd1c7bad06', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:24:13', 'Windows'),
	(47, '4c53a3de4020c90e01fbcf9f88aa67cf', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:24:55', 'Windows'),
	(48, '0d2eb98f28e1db52f676b7efacff1e98', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:30:46', 'Windows'),
	(49, 'cee4d8f58acaf1fb62cf7ada81363dd6', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:31:22', 'Windows'),
	(50, '86de35d064d8e5e8024fd3625c1ab8d0', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:32:11', 'Windows'),
	(51, '5705af9ef11cc4359f86dccc91ff7133', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:32:26', 'Windows'),
	(52, 'a194352ae9a409923414ef97ff97d7da', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:34:10', 'Windows'),
	(53, '66d19f102f8540c5d8073fd48cb02168', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:35:31', 'Windows'),
	(54, 'a60e84d30a7ca501840bd356615aae03', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:41:48', 'Windows'),
	(55, '488c90a88f4d3d07e983ff6daeefe66a', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:42:52', 'Windows'),
	(56, '16208900d5e638c5ba379836475240b2', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:50:59', 'Windows'),
	(57, '76931e0b86070d10aa44c2b75331fc1e', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:52:01', 'Windows'),
	(58, 'ae90b81c4fed868c2e5382206b84ace6', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:53:12', 'Windows'),
	(59, 'd85798466180c28a29d1cda60317a56f', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:54:27', 'Windows'),
	(60, '3309f227b33698c48e8d51adb138e798', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:55:59', 'Windows'),
	(61, 'c1a31485a6e5bfc60558a393189e8133', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:57:41', 'Windows'),
	(62, '7accdf00272bb1650768df43d6687f04', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:58:22', 'Windows'),
	(63, '432874b59e6f45a81c123a0d60cab2c0', 'WindowsPC', 1, NULL, NULL, '2019-04-11 20:59:17', 'Windows'),
	(64, '55d2ac12fb75645c336c52c68d6272b1', 'WindowsPC', 1, NULL, NULL, '2019-04-12 12:16:29', 'Windows'),
	(65, 'f8949f23737f4053615da5b2fc1fee6d', 'WindowsPC', 1, NULL, NULL, '2019-04-12 12:31:15', 'Windows'),
	(66, '0fea5f6fa0b9674b3aa3d48fd482f05e', 'WindowsPC', 1, NULL, NULL, '2019-04-12 13:23:28', 'Windows'),
	(67, '848c24d90d64768ccda05bff31c1bc89', 'WindowsPC', 1, NULL, NULL, '2019-04-12 13:46:08', 'Windows'),
	(68, 'a9be09a930b05ecd3be45846b90c63cc', 'WindowsPC', 1, NULL, NULL, '2019-04-12 14:15:58', 'Windows'),
	(69, '9b0be0a33b7265bd7a71665540b2be65', 'WindowsPC', 1, NULL, NULL, '2019-04-12 14:18:08', 'Windows'),
	(70, '79abb77fd33b684c9dda1430a514e2e7', 'WindowsPC', 1, NULL, NULL, '2019-04-12 14:24:57', 'Windows'),
	(71, '4f60923965debe346ab9c2554c6885aa', 'WindowsPC', 1, NULL, NULL, '2019-04-12 14:54:14', 'Windows'),
	(72, '9a71160ed65884ba8383570685852484', 'WindowsPC', 1, NULL, NULL, '2019-04-12 14:58:37', 'Windows'),
	(73, '7d68da0bc0b453a343706812e39905c8', 'WindowsPC', 1, NULL, NULL, '2019-04-12 14:59:46', 'Windows'),
	(74, 'd68ddd6afd1cc8142cf48c9fed857809', 'WindowsPC', 1, NULL, NULL, '2019-04-12 15:01:36', 'Windows'),
	(75, '1b7b1c51e1acc2afa971b949fe02d03d', 'WindowsPC', 1, NULL, NULL, '2019-04-12 15:02:01', 'Windows'),
	(76, '4c3c336aa4f2a9e86677cc4bc12098d1', 'WindowsPC', 1, NULL, NULL, '2019-04-12 15:19:27', 'Windows'),
	(77, '258a616c58a138c2a85705c63b4d2b3d', 'WindowsPC', 1, NULL, NULL, '2019-04-12 15:19:58', 'Windows'),
	(78, '34ea355fb122dc267fee71949708c591', 'WindowsPC', 1, NULL, NULL, '2019-04-12 15:22:37', 'Windows'),
	(79, '78fe256e428a210bbc1b59b4533b9d51', 'WindowsPC', 1, NULL, NULL, '2019-04-12 15:26:10', 'Windows'),
	(80, '4c00c3c7b3ed9a9b0bc79e1f6b6f131b', 'WindowsPC', 1, NULL, NULL, '2019-04-12 15:27:18', 'Windows'),
	(81, '1c79a4f2c4f118ff7b6984dd49ee9502', 'WindowsPC', 1, NULL, NULL, '2019-04-12 15:29:25', 'Windows'),
	(82, '2c382b198cc8c6eceaa7d30b068c72d8', 'WindowsPC', 1, NULL, NULL, '2019-04-12 15:52:23', 'Windows'),
	(83, 'abd38857eb933823e311a09af5d7db70', 'WindowsPC', 1, NULL, NULL, '2019-04-12 15:59:32', 'Windows'),
	(84, 'f418b108d69f8df8f6e0e981eeb1da01', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:22:32', 'Windows'),
	(85, '20844f816852f5563ee9b43846f6a37b', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:25:30', 'Windows'),
	(86, 'f8661e36daf15af49aa52bc547358fd8', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:31:57', 'Windows'),
	(87, 'de5ba178d2ff7a2973d1e2bb9f6b87e8', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:34:49', 'Windows'),
	(88, 'a4773ecc52fed49b82ea74cfdcaf8bbf', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:36:09', 'Windows'),
	(89, '3d680feb167ca52c8f52ef8a066ecbc5', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:41:04', 'Windows'),
	(90, '732d9b2538c94f8919b4ddafdf027460', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:46:19', 'Windows'),
	(91, '412b30fddf6a15926ae71be99fee5999', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:46:39', 'Windows'),
	(92, 'fa1e5d2a8c5268fd880c14aa921e855a', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:50:01', 'Windows'),
	(93, '4d69da5a445a65eeba7456e647610995', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:51:52', 'Windows'),
	(94, 'bb0492764cd56791a6652d77b7ef1eef', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:53:28', 'Windows'),
	(95, '3c528613125464c4ef5ad63aec2f81e2', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:54:01', 'Windows'),
	(96, 'a0fbfa500b4a5a87ef71a8d8973bb99f', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:54:41', 'Windows'),
	(97, '62471f7abe09a8cba040d15c6b332952', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:56:13', 'Windows'),
	(98, '6771d522fc1207f2495099d01ac9132b', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:57:32', 'Windows'),
	(99, 'fd18a1d1a803506d3ee9f91d9e80ffba', 'WindowsPC', 1, NULL, NULL, '2019-04-12 16:58:35', 'Windows'),
	(100, '0755587d5085cea68a283c31caba65b8', 'WindowsPC', 1, NULL, NULL, '2019-04-12 17:01:02', 'Windows'),
	(101, '3ce6c114e4128e0ee5f19b884ac58bb0', 'WindowsPC', 1, NULL, NULL, '2019-04-12 17:01:38', 'Windows'),
	(102, '4f69b384ef2627c3bc1a5738e0500cfd', 'WindowsPC', 1, NULL, NULL, '2019-04-12 17:03:48', 'Windows'),
	(103, '4e37639ca34dc18a2c1ef27635bf45ca', 'WindowsPC', 1, NULL, NULL, '2019-04-12 17:35:43', 'Windows'),
	(104, '6e9f1d615b943616d80f46d877efd570', 'WindowsPC', 1, NULL, NULL, '2019-04-12 17:36:51', 'Windows'),
	(105, 'eb343baf3f04801eefdab3ae88673210', 'WindowsPC', 1, NULL, NULL, '2019-04-12 17:37:22', 'Windows'),
	(106, '95ce728df67ff1da61690baba2f387fe', 'WindowsPC', 1, NULL, NULL, '2019-04-12 17:42:24', 'Windows'),
	(107, '632bbfcf94ec7d57b9bcdad823ff40e3', 'WindowsPC', 1, NULL, NULL, '2019-04-12 17:42:56', 'Windows'),
	(108, '3a938268cfb9dffc4ea5aed066461952', 'WindowsPC', 1, NULL, NULL, '2019-04-12 17:44:10', 'Windows'),
	(109, '7bed1974413d5155b1b202aa429fcc82', 'WindowsPC', 1, NULL, NULL, '2019-04-12 17:44:54', 'Windows'),
	(110, '790e5e109a8718ae99814b69834bf689', 'WindowsPC', 1, NULL, NULL, '2019-04-12 17:47:02', 'Windows'),
	(111, 'c3d644c5c04608f86bd546f946a9bc07', 'WindowsPC', 1, NULL, NULL, '2019-04-12 17:47:54', 'Windows'),
	(112, '9c474c0aff2b056b6b18984f2fad6a6d', 'WindowsPC', 1, NULL, NULL, '2019-04-12 17:48:39', 'Windows'),
	(113, 'ca322e2dc8a283db5ba3b97165e40a09', 'WindowsPC', 1, NULL, NULL, '2019-04-12 19:20:13', 'Windows'),
	(114, '6b43d57c87a1ae8d743e41af76cecf7f', 'WindowsPC', 1, NULL, NULL, '2019-04-12 19:22:47', 'Windows'),
	(115, '1607ef2ab650da59992ae9b08ebfe241', 'WindowsPC', 1, NULL, NULL, '2019-04-12 20:50:34', 'Windows'),
	(116, 'f594979c5ff844a3b887297d42cbf18b', 'WindowsPC', 1, NULL, NULL, '2019-04-12 20:52:19', 'Windows'),
	(117, '6e7d7ebc6a681dfd602e9a629a2be1c6', 'WindowsPC', 1, NULL, NULL, '2019-04-12 20:53:10', 'Windows'),
	(118, '2c1efc295385b543a3cfb775e07fb8a7', 'WindowsPC', 1, NULL, NULL, '2019-04-12 20:54:23', 'Windows'),
	(119, 'e3f2c16d8a44580570fe3d49218676a0', 'WindowsPC', 1, NULL, NULL, '2019-04-12 20:56:08', 'Windows'),
	(120, '68d33173ca2864625025244f58b40b45', 'WindowsPC', 1, NULL, NULL, '2019-04-12 20:57:52', 'Windows'),
	(121, '3fc1bbc33545a89a88de0756b75f9c30', 'WindowsPC', 1, NULL, NULL, '2019-04-12 20:58:49', 'Windows'),
	(122, '7abcfe752f59db33586e14ccc91a46c1', 'WindowsPC', 1, NULL, NULL, '2019-04-12 20:59:17', 'Windows'),
	(123, 'c62d8dc3fe61b669750bc435a83604e5', 'WindowsPC', 1, NULL, NULL, '2019-04-14 19:01:24', 'Windows'),
	(124, '01fa28a64f5aeb2b45dee4efe470839f', 'WindowsPC', 1, NULL, NULL, '2019-04-14 19:02:20', 'Windows'),
	(125, '2271f588329c362b35075c94643e8e90', 'WindowsPC', 1, NULL, NULL, '2019-04-15 00:20:33', 'Windows'),
	(126, '018223fbb661264e958ee2b04afa051c', 'WindowsPC', 1, NULL, NULL, '2019-04-15 00:22:36', 'Windows'),
	(127, '5217df39ca43964b213a99a4211023f6', 'WindowsPC', 1, NULL, NULL, '2019-04-15 00:36:04', 'Windows'),
	(128, '5870be79e80170a348a7c701d71039ce', 'WindowsPC', 1, NULL, NULL, '2019-04-15 00:43:06', 'Windows'),
	(129, 'c33196b8c7b65e3926ec5af99544d7f3', 'WindowsPC', 1, NULL, NULL, '2019-04-15 00:44:07', 'Windows'),
	(130, '4be1842272682a282eac8cbbbecae287', 'WindowsPC', 1, NULL, NULL, '2019-04-15 00:48:13', 'Windows'),
	(131, 'ff22cd033e42e30dcf152160aedbc991', 'WindowsPC', 1, NULL, NULL, '2019-04-15 00:49:07', 'Windows'),
	(132, '16735dc8a4ad195e475547a9bec644c5', 'WindowsPC', 1, NULL, NULL, '2019-04-15 00:52:57', 'Windows'),
	(133, '91fc558e58879ead44a921f1fbc682dd', 'WindowsPC', 1, NULL, NULL, '2019-04-15 00:53:19', 'Windows'),
	(134, '124601ee61dcbc9b99b0d6ed58280d3f', 'WindowsPC', 1, NULL, NULL, '2019-04-15 00:55:55', 'Windows'),
	(135, 'f115d49f17221d09ca2a1442f327b80d', 'WindowsPC', 1, NULL, NULL, '2019-04-15 01:08:04', 'Windows'),
	(136, '58340a32c7684258deb452afe2cc9ed5', 'WindowsPC', 1, NULL, NULL, '2019-04-15 01:08:44', 'Windows'),
	(137, '7148bc3b1bb09ca78081d65832bad18a', 'WindowsPC', 1, NULL, NULL, '2019-04-15 01:09:15', 'Windows'),
	(138, 'dd5d242e36d6a35a0be1df8ebcab7cdd', 'WindowsPC', 1, NULL, NULL, '2019-04-15 01:09:58', 'Windows'),
	(139, 'c002c4ac84d9fc48780e01a8a5a2d827', 'WindowsPC', 1, NULL, NULL, '2019-04-15 01:12:19', 'Windows'),
	(140, 'd38d6bea5f4e812dbc23b7969a8ade74', 'WindowsPC', 1, NULL, NULL, '2019-04-15 01:15:28', 'Windows'),
	(141, 'cbdccf91f2e8b3813b578dfabe561df5', 'WindowsPC', 1, NULL, NULL, '2019-04-15 01:16:16', 'Windows'),
	(142, '4d6b1085915f021d4b345e029c02738b', 'WindowsPC', 1, NULL, NULL, '2019-04-15 01:17:30', 'Windows'),
	(143, 'b0fc56d688ade0513448aa846a14c5e1', 'WindowsPC', 1, NULL, NULL, '2019-04-15 10:29:37', 'Windows'),
	(144, 'b7a706b232cec9ae0435f173123cae27', 'WindowsPC', 1, NULL, NULL, '2019-04-15 11:16:42', 'Windows'),
	(145, 'f449bfd919f4c9c268e6bddb818a2ca9', 'WindowsPC', 1, NULL, NULL, '2019-04-15 11:17:18', 'Windows'),
	(146, '8c43403448f81933cf57882dae3df431', 'WindowsPC', 1, NULL, NULL, '2019-04-15 11:23:47', 'Windows'),
	(147, '11241e7719c427bf336805d3605360d7', 'WindowsPC', 1, NULL, NULL, '2019-04-15 11:24:54', 'Windows'),
	(148, 'd44b32f8915795656cdb53d6c6da083e', 'WindowsPC', 1, NULL, NULL, '2019-04-15 11:28:42', 'Windows'),
	(149, 'f4c4401d4d95b3bcd50f93546f14cddb', 'WindowsPC', 1, NULL, NULL, '2019-04-15 11:38:23', 'Windows'),
	(150, 'f930aa0e6e33139fd953273704e625d4', 'WindowsPC', 1, NULL, NULL, '2019-04-15 13:00:46', 'Windows'),
	(151, 'de26da731ebaaab01c16badc2c825d1e', 'WindowsPC', 1, NULL, NULL, '2019-04-15 13:27:04', 'Windows'),
	(152, '45d7c4f3d4374f614981602be948e79c', 'WindowsPC', 1, NULL, NULL, '2019-04-15 13:37:42', 'Windows'),
	(153, 'b80bfe6f5ca1587d6b0b40af8c299cc7', 'WindowsPC', 1, NULL, NULL, '2019-04-15 13:38:24', 'Windows'),
	(154, '34809cf212e5b7687c08788f189a6cb8', 'WindowsPC', 1, NULL, NULL, '2019-04-15 13:38:46', 'Windows'),
	(155, 'c06a990d1bc38703283412dde6a7fd2e', 'WindowsPC', 1, NULL, NULL, '2019-04-15 13:39:19', 'Windows'),
	(156, '35641b01baf7d688680baf73166eeb1e', 'WindowsPC', 1, NULL, NULL, '2019-04-15 13:39:46', 'Windows'),
	(157, '0d4f1fbdc63914232f5daf0b1b358f06', 'WindowsPC', 1, NULL, NULL, '2019-04-15 14:43:12', 'Windows'),
	(158, '4192e383bac491b51fc8d183509c76c9', 'WindowsPC', 1, NULL, NULL, '2019-04-15 14:43:35', 'Windows'),
	(159, 'b95b95887973f2c536a0502f4999a734', 'WindowsPC', 1, NULL, NULL, '2019-04-15 14:43:52', 'Windows'),
	(160, 'e981a6250feee311109b9ec72419540a', 'WindowsPC', 1, NULL, NULL, '2019-04-15 14:57:27', 'Windows'),
	(161, '24309f40a1635fefb9ea6b486b40335b', 'WindowsPC', 1, NULL, NULL, '2019-04-15 15:00:40', 'Windows'),
	(162, 'ab2a237b5a32ffdfd938eeb3170aef3e', 'WindowsPC', 1, NULL, NULL, '2019-04-15 15:03:13', 'Windows'),
	(163, '850580b915cd05439740b5c4b3fbfc3e', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:05:54', 'Windows'),
	(164, '72bb5e54291381946e826d33d6675c1c', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:07:01', 'Windows'),
	(165, 'e4d008a98124182ae30e0a8422144cae', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:07:24', 'Windows'),
	(166, 'a33bcdd2178a3f2074deb89d0b00f18e', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:11:17', 'Windows'),
	(167, '9464f5fc700aa4fbf72590bfcd8cc1c1', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:12:16', 'Windows'),
	(168, 'a57c34e37455e0a6def711215e182dce', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:16:19', 'Windows'),
	(169, '043262a87fd0501030f41075e7663571', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:16:31', 'Windows'),
	(170, 'e859aacad1d32f91a0fc28f0d48ed802', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:17:56', 'Windows'),
	(171, 'c8266737849e1ab0b7ef0f73b1cba78f', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:20:57', 'Windows'),
	(172, '34191c2760ace85d1cc50309a3d4e09b', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:21:32', 'Windows'),
	(173, '213c3a04d7c4c41320f8dca5c34741b7', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:21:59', 'Windows'),
	(174, '3ed17dd4a843691a9bd6c93a4a75197f', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:24:04', 'Windows'),
	(175, '8426ddeef7ebccb9c3fa22e331e06ada', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:36:00', 'Windows'),
	(176, '206f9bc511e93efa76ae2fdaa14644e3', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:42:03', 'Windows'),
	(177, '24cf9afdc941cc9afe50a4bd9d00f80a', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:43:51', 'Windows'),
	(178, '1e2ffae119b6c242b3f5cb7a3a1b7bef', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:46:23', 'Windows'),
	(179, 'dee58084b82a5281010547c30f106152', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:47:29', 'Windows'),
	(180, '0c30b6e993794d0dd89de7075e4381fa', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:51:07', 'Windows'),
	(181, '9dc44135248c338ccb07e84675f998e5', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:52:50', 'Windows'),
	(182, '4a69432b51610509bab3e078ab60a2a5', 'WindowsPC', 1, NULL, NULL, '2019-04-15 17:54:01', 'Windows'),
	(183, '5c61afde10ed7e7d3e7eb639edf4450c', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:17:34', 'Windows'),
	(184, '1466b1e2c53af346aadca224c78da1d8', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:20:04', 'Windows'),
	(185, '97c61d4a975b862e5cf053bdf39e4aad', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:21:02', 'Windows'),
	(186, '75a15e0d483d6a58547a07a84f081b86', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:27:45', 'Windows'),
	(187, '319ddc8bb1d4dba5260b7c7d409a6264', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:30:30', 'Windows'),
	(188, '780a3fa88faa036a4e04ad19ac82c533', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:30:57', 'Windows'),
	(189, '8d6b7fb2a3814226e52d46e9c2bdb456', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:31:47', 'Windows'),
	(190, '0fd66a24ef64bb0002646147b60ba820', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:34:14', 'Windows'),
	(191, '2d1000aef6eaff59f9b91c6e2e638e6f', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:35:20', 'Windows'),
	(192, '60813959f743be88ff3b9dea67444c2b', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:36:57', 'Windows'),
	(193, '6501ac7ee86d1bd45dfb1ddba1e63329', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:39:17', 'Windows'),
	(194, '345f22bdcc639fe2d85f4e6a918f3a7d', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:40:25', 'Windows'),
	(195, '37e48d64d28de47787832f3c0c489ba3', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:41:01', 'Windows'),
	(196, 'e5082ae5fa3b3adbea841250e92cbadd', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:43:00', 'Windows'),
	(197, '89db0e9c78c13471f326255f66380275', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:44:51', 'Windows'),
	(198, '561b9847e19cb81804435d587b184d88', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:48:07', 'Windows'),
	(199, '2501e372166d58fad2b2e595e5013cb4', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:48:53', 'Windows'),
	(200, '50c581b36a01593b2375def8d9102816', 'WindowsPC', 1, NULL, NULL, '2019-04-15 18:51:10', 'Windows'),
	(201, '298b2af702fd39e78589413aa0ee8d0b', 'WindowsPC', 1, NULL, NULL, '2019-04-15 23:24:14', 'Windows'),
	(202, '6a3b353d96d856e5d90a06809a3f03ef', 'WindowsPC', 1, NULL, NULL, '2019-04-16 00:02:46', 'Windows'),
	(203, 'a2c69822532ece490734b0fccb742c6e', 'WindowsPC', 1, NULL, NULL, '2019-04-16 10:53:36', 'Windows'),
	(204, '462ecdb90a8d633272e71dcfb5b664f3', 'WindowsPC', 1, NULL, NULL, '2019-04-16 10:58:56', 'Windows'),
	(205, 'fb4ae8b541c8adcf75b584b3727e2732', 'WindowsPC', 1, NULL, NULL, '2019-04-16 11:00:00', 'Windows'),
	(206, '5043322924b0a1f3297347555889c23e', 'WindowsPC', 1, NULL, NULL, '2019-04-16 11:07:08', 'Windows'),
	(207, 'fdeb243febfb03922d1502f255dbba9b', 'WindowsPC', 1, NULL, NULL, '2019-04-16 11:09:11', 'Windows'),
	(208, '7177352ac6af65e16f397bac66411374', 'WindowsPC', 1, NULL, NULL, '2019-04-16 11:41:34', 'Windows'),
	(209, '7f6ded9ec3aaef069719209745436a1e', 'WindowsPC', 1, NULL, NULL, '2019-04-16 11:43:06', 'Windows'),
	(210, '4cbf7084bb42e63bb4ea504d3e4c52b1', 'WindowsPC', 1, NULL, NULL, '2019-04-16 11:47:33', 'Windows'),
	(211, 'a15bfc7b73b7a4895493aa97a6840642', 'WindowsPC', 1, NULL, NULL, '2019-04-16 11:52:22', 'Windows'),
	(212, '687c2d59fd50e07f462b35d131b40b82', 'WindowsPC', 1, NULL, NULL, '2019-04-16 11:54:08', 'Windows'),
	(213, '5548e8d611b9570f34d0000b46d131be', 'WindowsPC', 1, NULL, NULL, '2019-04-16 11:56:49', 'Windows'),
	(214, '0002417a8091b330b3b04d2355513be8', 'WindowsPC', 1, NULL, NULL, '2019-04-16 11:57:48', 'Windows'),
	(215, '08bdb6f5b0b199976773e0eec5f4bd02', 'WindowsPC', 1, NULL, NULL, '2019-04-16 11:58:43', 'Windows'),
	(216, 'edb25f30b8e8cb69320872be7d2622fa', 'WindowsPC', 1, NULL, NULL, '2019-04-16 12:00:04', 'Windows'),
	(217, '738f690fd162810f051744e09d0c8890', 'WindowsPC', 1, NULL, NULL, '2019-04-16 12:01:25', 'Windows'),
	(218, '8e1fac3b4fc3ed953dccd7c2157aa8bb', 'WindowsPC', 1, NULL, NULL, '2019-04-16 12:02:06', 'Windows'),
	(219, '690e8d89d2aaa9c54a0aa3df73c07ccf', 'WindowsPC', 1, NULL, NULL, '2019-04-16 12:02:43', 'Windows'),
	(220, 'ca2d3543d204eca675c68e051ce97301', 'WindowsPC', 1, NULL, NULL, '2019-04-16 12:15:46', 'Windows'),
	(221, 'fbeb815ffa17a63e392810a2a61aa5a3', 'WindowsPC', 1, NULL, NULL, '2019-04-16 12:34:35', 'Windows'),
	(222, '7fd02c25152afb727b8451642c21581b', 'WindowsPC', 1, NULL, NULL, '2019-04-16 13:16:52', 'Windows'),
	(223, 'ce3d0fc372d696eecb5bdd952c431e95', 'WindowsPC', 1, NULL, NULL, '2019-04-16 13:34:27', 'Windows'),
	(224, '6755734e2f7210fa2befcce64225d9a7', 'WindowsPC', 1, NULL, NULL, '2019-04-16 13:36:07', 'Windows'),
	(225, '8e9e83736cc544a1ded518004cc80f8a', 'WindowsPC', 1, NULL, NULL, '2019-04-16 13:36:52', 'Windows'),
	(226, '66729f5e166daf4d641c53fc7b7e1db0', 'WindowsPC', 1, NULL, NULL, '2019-04-16 13:41:28', 'Windows'),
	(227, '0032727d0c64d17e9463b5ae00559109', 'WindowsPC', 1, NULL, NULL, '2019-04-16 13:42:32', 'Windows'),
	(228, '2f83f34db18aa92198229007a14f640e', 'WindowsPC', 1, NULL, NULL, '2019-04-16 14:02:48', 'Windows'),
	(229, '591839ce05fd8a8d85f19b10e3878817', 'WindowsPC', 1, NULL, NULL, '2019-04-16 14:03:42', 'Windows'),
	(230, 'b78573fc018b41b34a21b70eaff25eb2', 'WindowsPC', 1, NULL, NULL, '2019-04-16 14:04:42', 'Windows'),
	(231, 'b3a12f9083f80ecaa7403fad5bda89d2', 'WindowsPC', 1, NULL, NULL, '2019-04-16 14:44:29', 'Windows'),
	(232, 'fdaf86cef179b0d7d339a71431af695b', 'WindowsPC', 1, NULL, NULL, '2019-04-16 14:45:21', 'Windows'),
	(233, '903e2815e268bda08b2386d90ed32229', 'WindowsPC', 1, NULL, NULL, '2019-04-16 14:47:05', 'Windows'),
	(234, '3c52c1cf8fb29eb10760e73b900f3311', 'WindowsPC', 1, NULL, NULL, '2019-04-16 14:49:46', 'Windows'),
	(235, '5ed6f734c45ecc35c347b3f9df546a46', 'WindowsPC', 1, NULL, NULL, '2019-04-16 15:08:13', 'Windows'),
	(236, '9e6cf31c5a35488b7f6e7e494528baa0', 'WindowsPC', 1, NULL, NULL, '2019-04-16 15:11:23', 'Windows'),
	(237, '38beb2c8e207e4e8d1244db7c4eb1dad', 'WindowsPC', 1, NULL, NULL, '2019-04-16 15:12:36', 'Windows'),
	(238, 'a2c6a9bac7f4c2fbb9069fa68c3f0269', 'WindowsPC', 1, NULL, NULL, '2019-04-16 15:14:00', 'Windows'),
	(239, '22a46adccd000fbcf95fcacddde7b647', 'WindowsPC', 1, NULL, NULL, '2019-04-16 17:44:38', 'Windows'),
	(240, 'c3331416476a7e55616bccc28b6877d6', 'WindowsPC', 1, NULL, NULL, '2019-04-16 17:48:14', 'Windows'),
	(241, '154fa5861e5b3c0b06baf15db44ce5f2', 'WindowsPC', 1, NULL, NULL, '2019-04-16 18:37:09', 'Windows'),
	(242, '6ef4678f07e2dde5e552c6a6bf30e728', 'WindowsPC', 1, NULL, NULL, '2019-04-16 18:40:38', 'Windows'),
	(243, 'd1ff8420cc03e709f2326f831784d3c1', 'WindowsPC', 1, NULL, NULL, '2019-04-16 19:03:00', 'Windows'),
	(244, '2b09cab18d2a09079c0a04cc7d099610', 'WindowsPC', 1, NULL, NULL, '2019-04-16 19:25:04', 'Windows'),
	(245, 'fc832575c88317fb36bc6cec9deef9b3', 'WindowsPC', 1, NULL, NULL, '2019-04-16 19:31:20', 'Windows'),
	(246, 'a5112d01d468800a35b1c4a4d8cbe03d', 'WindowsPC', 1, NULL, NULL, '2019-04-16 19:32:16', 'Windows'),
	(247, '8bf8f12adfe973d6d991ddc8203b5c1f', 'WindowsPC', 1, NULL, NULL, '2019-04-16 19:52:30', 'Windows'),
	(248, '4493eed0f77624ee9ab5d62ef78aa24e', 'WindowsPC', 1, NULL, NULL, '2019-04-16 21:07:36', 'Windows'),
	(249, '748e805de7d53b8a501580a04117d59c', 'WindowsPC', 1, NULL, NULL, '2019-04-16 21:16:22', 'Windows'),
	(250, 'fb6b7fd9dea8737107c5403f1d192e45', 'WindowsPC', 1, NULL, NULL, '2019-04-16 21:17:16', 'Windows'),
	(251, 'b6baf434df4205136d693d036029a241', 'WindowsPC', 1, NULL, NULL, '2019-04-17 13:01:04', 'Windows'),
	(252, '176604a62ec5f965adc0dba646d54e53', 'WindowsPC', 1, NULL, NULL, '2019-04-17 13:03:17', 'Windows'),
	(253, '2d4879390cc56cdad351b18d56e6805c', 'WindowsPC', 1, NULL, NULL, '2019-04-17 13:26:39', 'Windows'),
	(254, 'f3afcbcf958f2598f8bd9830c326bb48', 'WindowsPC', 1, NULL, NULL, '2019-04-17 13:32:06', 'Windows'),
	(255, '2e4f3535df8d07e8a7437064cc31dad5', 'WindowsPC', 1, NULL, NULL, '2019-04-17 13:34:11', 'Windows'),
	(256, 'a86fe13a6d5d35b9c59b639ad303da5a', 'WindowsPC', 1, NULL, NULL, '2019-04-17 13:38:25', 'Windows'),
	(257, '11c32bbee44ea2ed8f14313af263e7f2', 'WindowsPC', 1, NULL, NULL, '2019-04-17 13:39:05', 'Windows'),
	(258, 'a54e43a9e8651dfd6292af79fd3d296f', 'WindowsPC', 1, NULL, NULL, '2019-04-17 13:39:58', 'Windows'),
	(259, 'd32fb0e9d604449bf8122a20816edd10', 'WindowsPC', 1, NULL, NULL, '2019-04-17 13:41:16', 'Windows'),
	(260, 'bb1f97aed52a7b17c6b67056aa53196b', 'WindowsPC', 1, NULL, NULL, '2019-04-17 13:46:05', 'Windows'),
	(261, '2ead509150d0f1afda72f11660fc365b', 'WindowsPC', 1, NULL, NULL, '2019-04-17 13:51:38', 'Windows'),
	(262, 'd895a4f09fec69f34cde8c9dcdc29e50', 'WindowsPC', 1, NULL, NULL, '2019-04-17 13:55:11', 'Windows'),
	(263, 'eb6c03586942bc0f2607e4bccf3967c9', 'WindowsPC', 1, NULL, NULL, '2019-04-17 13:59:13', 'Windows'),
	(264, '0b2cf470e46f026b86119faeb69caa7c', 'WindowsPC', 1, NULL, NULL, '2019-04-17 14:03:35', 'Windows'),
	(265, 'cd8eb41a4333fa409d622b66c1fce032', 'WindowsPC', 1, NULL, NULL, '2019-04-17 15:32:46', 'Windows'),
	(266, 'b64f14d59388bf13941b0c8fe48a0742', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:02:42', 'Windows'),
	(267, '378633297ec9885a34d3a635887fcbb2', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:07:44', 'Windows'),
	(268, '1aa5bf73799831a498c82e6aea7c60a6', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:11:14', 'Windows'),
	(269, 'a8fa9ae228d8437b61d2b28ce758ec8b', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:12:29', 'Windows'),
	(270, 'a2a5c7871bb2d31427de80fa7bdb8679', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:16:12', 'Windows'),
	(271, '387f9e5cfe4bd78ba62801d1f7513bfb', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:16:51', 'Windows'),
	(272, '5cbb13d3ac637c8fefcecdd7fdd0cbb9', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:17:14', 'Windows'),
	(273, '5de8421f54f58466cd9fe4c7360f6f4d', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:18:25', 'Windows'),
	(274, 'a71500a48b71f9005261ce135e9df27c', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:22:32', 'Windows'),
	(275, '347a3e403c0aa9eb427a736070dfda7c', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:26:38', 'Windows'),
	(276, '615eb9c5db85057c0e45f1132590daf5', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:27:37', 'Windows'),
	(277, 'faba3995d81e8e65b9ac944f881d2e20', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:27:57', 'Windows'),
	(278, '968ff6059e9defccd7c79226d66db7b9', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:28:31', 'Windows'),
	(279, '880de30e73d1b1fd749f4f868e739e0a', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:39:16', 'Windows'),
	(280, '70dc781f0bc6ea49e31ad60267d941ad', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:39:49', 'Windows'),
	(281, '73bd72d4aab89d860c1b8bb96e925013', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:40:45', 'Windows'),
	(282, '94c51eb24fbb8669bc0b688f7774b734', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:41:31', 'Windows'),
	(283, '013e9259901ab4df079d33f5a1bba3a1', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:43:31', 'Windows'),
	(284, '90b49ec12c8a9496cb0535ad892ed842', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:43:51', 'Windows'),
	(285, '08d5f1321eb9e10a13ef6d7993541509', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:44:12', 'Windows'),
	(286, '11a4efb5606b054f47cf9869878d565c', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:47:01', 'Windows'),
	(287, '1458ce170ade4fd008021dd9e72ebe55', 'WindowsPC', 1, NULL, NULL, '2019-04-17 16:48:28', 'Windows'),
	(288, 'f919b03035c0ea009f3ca5f87c548a42', 'WindowsPC', 1, NULL, NULL, '2019-04-17 17:14:45', 'Windows'),
	(289, 'ff212bcbc703c148b33ac275ae3eea42', 'WindowsPC', 1, NULL, NULL, '2019-04-17 17:15:29', 'Windows'),
	(290, '90bac3349f5f6e9f77c7358c082c8b36', 'WindowsPC', 1, NULL, NULL, '2019-04-17 17:18:17', 'Windows'),
	(291, '02b10620e345bf687247c958acc1455e', 'WindowsPC', 1, NULL, NULL, '2019-04-17 17:19:10', 'Windows'),
	(292, '75c8b2466a691aaa6771920f7ba4d907', 'WindowsPC', 1, NULL, NULL, '2019-04-17 17:26:32', 'Windows'),
	(293, 'facbb9582b239e97d0e5eded2859a857', 'WindowsPC', 1, NULL, NULL, '2019-04-17 17:30:36', 'Windows'),
	(294, 'aedaf71251927ef3ddd96641fbe0ef2a', 'WindowsPC', 1, NULL, NULL, '2019-04-17 17:35:09', 'Windows'),
	(295, 'b4ed840b4c77809b261358cfedbb8c75', 'WindowsPC', 1, NULL, NULL, '2019-04-17 17:45:02', 'Windows'),
	(296, '30a66ad23013997a4cd54a6229076890', 'WindowsPC', 1, NULL, NULL, '2019-04-17 18:03:12', 'Windows'),
	(297, 'bc3c86733bfb5483f1bba088c7dc71a7', 'WindowsPC', 1, NULL, NULL, '2019-04-17 19:10:23', 'Windows'),
	(298, '82f0d1af03738b971d6ba831833ac26b', 'WindowsPC', 1, NULL, NULL, '2019-04-17 19:15:29', 'Windows'),
	(299, 'ab2cc29a20fbcf7c5c67ad629e33a5e5', 'WindowsPC', 1, NULL, NULL, '2019-04-18 14:10:38', 'Windows'),
	(300, '3d7c8e08f956b81bb32951bbd932fcee', 'WindowsPC', 1, NULL, NULL, '2019-04-18 15:59:56', 'Windows'),
	(301, '267a58617063775e89dc16e13deeea94', 'WindowsPC', 1, NULL, NULL, '2019-04-18 16:01:40', 'Windows'),
	(302, '3d43340407b3c0c4b65a484acd61f3c5', 'WindowsPC', 1, NULL, NULL, '2019-04-18 16:21:36', 'Windows'),
	(303, '34dbd3ca9d91ba00cf45396f2fc41fbb', 'WindowsPC', 1, NULL, NULL, '2019-04-18 16:34:25', 'Windows'),
	(304, 'bd7999809f4e88622523aa5d8541e10f', 'WindowsPC', 1, NULL, NULL, '2019-04-18 16:35:06', 'Windows'),
	(305, '156bfdb2a1c0777da9bc2bec961ee534', 'WindowsPC', 1, NULL, NULL, '2019-04-18 16:35:44', 'Windows'),
	(306, 'ce933cfe2eaf149cbf6c45a2f5208330', 'WindowsPC', 1, NULL, NULL, '2019-04-18 16:51:33', 'Windows'),
	(307, 'cb34e44e4fe3ca55eaff29f004117c7a', 'WindowsPC', 1, NULL, NULL, '2019-04-18 16:51:46', 'Windows'),
	(308, '7d5361241c5b619f0a95d9e64ca8a8fe', 'WindowsPC', 1, NULL, NULL, '2019-04-18 16:57:51', 'Windows');
/*!40000 ALTER TABLE `user_sessions` ENABLE KEYS */;

-- Copiando estrutura para view royalcrm.client_log
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `client_log`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `client_log` AS SELECT cn.id, cn.description, cn.client_id, cn.created_by, u.name as user_name, cn.created_at FROM client_notes cn JOIN users u ON u.id=cn.created_by
UNION ALL
SELECT ch.id, ch.content, ch.client_id, ch.created_by, u.name as user_name, ch.created_at FROM client_history ch JOIN users u ON u.id=ch.created_by ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
