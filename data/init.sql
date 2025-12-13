-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for starryearings
DROP DATABASE IF EXISTS `starryearings`;
CREATE DATABASE IF NOT EXISTS `starryearings` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `starryearings`;

-- Dumping structure for table starryearings.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `category` varchar(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table starryearings.products: ~37 rows (approximately)
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `stock`, `image`) VALUES
	(1, 'Star', 'stud', 39.99, 'Delicate star-shaped studs in warm rose gold tone, perfect for everyday wear!', 50, '../images/stud1.jpg'),
	(2, 'Circle', 'stud', 44.99, 'Classic elegant crystal studs, perfect for special occasions!', 50, '../images/stud2.jpg'),
	(3, 'Maple Leaf', 'stud', 54.99, 'Luxurious rose gold maple leaf-shaped stud earrings, perfect for special occasions!', 50, '../images/stud3.jpg'),
	(4, 'Pearl with Petal', 'stud', 39.99, 'Light blue metallic petals with lustrous white pearl drops.', 50, '../images/stud4.jpg'),
	(5, 'Tears', 'stud', 64.99, 'Elegant crystal earrings, perfect for special occasions!', 50, '../images/stud5.jpg'),
	(6, 'Point', 'stud', 44.99, 'Classic crystal studs, perfect for special occasions!', 50, '../images/stud6.jpg'),
	(7, 'Snowdrop', 'stud', 54.99, 'Timeless diamond-inspired crystal studs, perfect for special occasions!', 50, '../images/stud7.jpg'),
	(8, 'Heart', 'stud', 34.99, 'Elegant gold heart-shaped stud earrings with crystals, perfect for everyday wear!', 50, '../images/stud8.jpg'),
	(9, 'Ruby', 'stud', 39.99, 'Rich deep red jewel stud earrings, perfect for special occasions!', 50, '../images/stud9.jpg'),
	(10, 'Big Pearl', 'stud', 44.99, 'Sophisticated white pearl earrings with gold metal caps, perfect for special occasions!', 50, '../images/stud10.jpg'),
	(11, 'Minimalist', 'stud', 24.99, 'Contemporary crystal stud earrings in gold, perfect for everyday wear!', 50, '../images/stud11.jpg'),
	(12, 'Pearl', 'stud', 39.99, 'Sophisticated white pearl earrings, perfect for everyday wear!', 50, '../images/stud12.jpg'),
	(13, 'Unique', 'drop', 54.99, 'Elegant gold drop earrings with purple crystal point, perfect for special occasions!', 50, '../images/drop1.jpg'),
	(14, 'Emerald', 'drop', 74.99, 'Elegant emerald drop earrings with delicate decoration in silver crystals, perfect for special occasions!', 50, '../images/drop2.jpg'),
	(15, 'Sparkle', 'drop', 44.99, 'Luxurious teardrop earrings with a warm metallic frame, perfect for special occasions!', 50, '../images/drop3.jpg'),
	(16, 'Amber', 'drop', 29.99, 'Sparkle amber gemstone drop earrings with antique silver caps.', 50, '../images/drop4.jpg'),
	(17, 'Modern', 'drop', 59.99, 'Sleek gold drop earrings with sparkling crystal loop, perfect for special occasions!', 50, '../images/drop5.jpg'),
	(18, 'Black-pink', 'drop', 54.99, 'Artisan-crafted earrings featuring a pink stone paired with a sleek black semicircle.', 50, '../images/drop6.jpg'),
	(19, 'Pearl Drop', 'drop', 49.99, 'Luxurious pearl drop earrings with delicate silver hooks.', 50, '../images/drop7.jpg'),
	(20, 'Pink', 'drop', 39.99, 'Lovely pastel ruby drop earrings with elegant wire-wrapped details in gold-plated metal.', 50, '../images/drop8.jpg'),
	(21, 'Vibrance', 'drop', 54.99, 'Modern unique earrings featuring black curved tops and white pearl drops.', 50, '../images/drop9.jpg'),
	(22, 'Classic', 'hoop', 59.99, 'Classic twisted textured gold hoop earrings, perfect for elevating everyday style.', 50, '../images/hoop1.jpg'),
	(23, 'Glory', 'hoop', 69.99, 'Luxurious crystal hoops with polished gold wiring.', 50, '../images/hoop2.jpg'),
	(24, 'Golden Hoop', 'hoop', 44.99, 'Minimalist C-shaped golden hoop earrings designed for everyday wear.', 50, '../images/hoop3.jpg'),
	(25, 'Timeless', 'hoop', 74.99, 'Bold ribbed or grooved texture gold hoop earrings in warm rose gold tone, perfect for special occasions!', 50, '../images/hoop4.jpg'),
	(26, 'Elegance', 'hoop', 54.99, 'Stunning sterling silver drop earrings featuring vibrant ruby gemstones.', 50, '../images/hoop5.jpg'),
	(27, 'Beads', 'hoop', 34.99, 'Large multi-layered chandelier-style hoop earrings with hanging gemstone elements.', 50, '../images/hoop6.jpg'),
	(28, 'Diamond', 'hoop', 49.99, 'Sparkling crystal hoop earrings set in polished silver, perfect for special occasions!', 50, '../images/hoop7.jpg'),
	(29, 'Luxe', 'hoop', 64.99, 'Contemporary gold-colored latched-back earrings with crystal points.', 50, '../images/hoop8.jpg'),
	(30, 'Pendant', 'hoop', 24.99, 'Distinctive pendant earrings featuring a scarab and an artistic portrait element.', 50, '../images/hoop9.jpg'),
	(31, 'Sleek', 'hoop', 59.99, 'Classic chunky gold-tone hoop earrings with a smooth and polished finish.', 50, '../images/hoop10.jpg'),
	(32, 'Dachshund', 'hoop', 39.99, 'Adorable dachshund-shaped hoop earrings in polished gold-tone metal.', 50, '../images/hoop11.jpg'),
	(33, 'Magnificence', 'clip', 74.99, 'Stunning multi-gemstone clip-on earrings featuring tiered amethyst, peridot, and crystal accents in rose gold.', 50, '../images/clip1.jpg'),
	(34, 'Moon', 'clip', 59.99, 'Unique crescent moon-shaped Chandbali clip-on Earrings.', 50, '../images/clip2.jpg'),
	(35, 'Allure', 'clip', 59.99, 'Authentic Indian Jhumka clip-on earrings with dangling pearl beads, crafted in oxidized silver and gold-plated metal.', 50, '../images/clip3.jpg'),
	(36, 'Distinction', 'clip', 64.99, 'Luxurious textured gold-tone clip-on earrings with sparkling stone accents.', 50, '../images/clip4.jpg'),
	(37, 'Prestige', 'clip', 69.99, 'Stunning sapphire-inspired clip-on earrings, perfect for special occasions!', 50, '../images/clip5.jpg');

-- Dumping structure for table starryearings.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table starryearings.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `email`, `password`, `name`, `address`, `phone`, `created_at`) VALUES
	(1, 'user@example.com', 'password', NULL, NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
