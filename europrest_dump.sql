-- --------------------------------------------------------
-- Хост:                         localhost
-- Версия сервера:               8.0.21 - MySQL Community Server - GPL
-- Операционная система:         Linux
-- HeidiSQL Версия:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных europrest
CREATE DATABASE IF NOT EXISTS `europrest` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `europrest`;

-- Дамп структуры для таблица europrest.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы europrest.category: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `name`) VALUES
	(1, 'cars'),
	(3, 'products');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Дамп структуры для таблица europrest.category_option
CREATE TABLE IF NOT EXISTS `category_option` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-category_option-category_id` (`category_id`),
  CONSTRAINT `fk-category_option-category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы europrest.category_option: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `category_option` DISABLE KEYS */;
INSERT INTO `category_option` (`id`, `name`, `category_id`) VALUES
	(1, 'size', 1),
	(4, 'weigth', 3),
	(5, 'color', 3);
/*!40000 ALTER TABLE `category_option` ENABLE KEYS */;

-- Дамп структуры для таблица europrest.category_product
CREATE TABLE IF NOT EXISTS `category_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-category_product-category_id` (`category_id`),
  KEY `idx-category_product-product_id` (`product_id`),
  CONSTRAINT `fk-category_product-category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-category_product-product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы europrest.category_product: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `category_product` DISABLE KEYS */;
INSERT INTO `category_product` (`id`, `category_id`, `product_id`) VALUES
	(1, 1, 1),
	(2, 3, 2);
/*!40000 ALTER TABLE `category_product` ENABLE KEYS */;

-- Дамп структуры для таблица europrest.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `price` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы europrest.product: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`, `name`, `description`, `price`) VALUES
	(1, 'Nissan', 'Description of the product', 2000000),
	(2, 'Meat', 'Description of the product', 2000);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Дамп структуры для таблица europrest.product_option
CREATE TABLE IF NOT EXISTS `product_option` (
  `id` int NOT NULL AUTO_INCREMENT,
  `value` varchar(255) DEFAULT NULL,
  `category_option_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-product_option-product_id` (`product_id`),
  KEY `idx-product_option-category_option_id` (`category_option_id`),
  CONSTRAINT `fk-product_option-category_option_id` FOREIGN KEY (`category_option_id`) REFERENCES `category_option` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-product_option-product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы europrest.product_option: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `product_option` DISABLE KEYS */;
INSERT INTO `product_option` (`id`, `value`, `category_option_id`, `product_id`) VALUES
	(1, 'small', 1, 1),
	(2, 'small', 4, 2),
	(3, 'red', 5, 2);
/*!40000 ALTER TABLE `product_option` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
