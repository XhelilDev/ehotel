-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2023 at 02:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Food'),
(2, 'Drinks'),
(3, 'Pasta');

-- --------------------------------------------------------

--
-- Table structure for table `dhoma`
--

CREATE TABLE `dhoma` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dhomanr` varchar(45) NOT NULL,
  `dhomacmimi` float DEFAULT NULL,
  `image` varchar(100) DEFAULT 'noimage.png',
  `dhomastatusi` tinyint(1) DEFAULT NULL,
  `dhoma_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dhoma`
--

INSERT INTO `dhoma` (`id`, `user_id`, `dhomanr`, `dhomacmimi`, `image`, `dhomastatusi`, `dhoma_id`) VALUES
(54, NULL, '16', 120, '1679919053logo.png', 0, 7),
(71, NULL, '84', 100, '1679846901room6.jpg', 0, 4),
(72, NULL, '55', 140, '1679847106gallery7.jpg', 0, 6),
(73, NULL, '104', 50, '1679862246room1.jpg', 0, 8),
(75, NULL, '100', 30, '1679919019room3.jpg', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `dhoma_id` int(11) DEFAULT NULL,
  `dhoma_lloji` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `dhoma_id`, `dhoma_lloji`) VALUES
(3, NULL, 'Ekskluzive 3'),
(4, NULL, 'Dyshe'),
(5, NULL, 'Studio Rooms'),
(6, NULL, 'Deluxe'),
(7, NULL, 'Teke'),
(8, NULL, 'Familjare');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_data` text NOT NULL,
  `notes` text DEFAULT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_data`, `notes`, `total`) VALUES
(3, 2, 'John Smith<br />+3894535434<br />ylber.veliu@yahoo.com<br />Dr. Mladen Stojanovikj Br. 28', 'ASAP', 1.7),
(4, 2, 'Ilber Velija Veliji<br />+3894535434<br />ylber.veliu@yahoo.com<br />Dr. Mladen Stojanovikj Br. 28', 'ASAP please', 2.3),
(5, 2, 'Ilber Veliji<br />070580780<br />ylber.veliu@yahoo.com<br />Brakja Filipovikj Br. 8\r\n8', 'dsadasdasdasd test', 1.25);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(11) DEFAULT NULL,
  `products_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `products_id`) VALUES
(3, 6),
(3, 2),
(4, 8),
(5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT 0,
  `description` text DEFAULT NULL,
  `image` varchar(150) DEFAULT 'noimage.png',
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `price`, `qty`, `discount`, `description`, `image`, `category_id`) VALUES
(2, 1, 'Bread', 0.45, 10, 5, 'White Bread 500gr', '1678134163download.jpg', 1),
(6, 1, 'Coca Cola 0.5l', 1.25, 10, 0, 'Coca Cola 0.5l\r\n<br />\r\nOrigin: RKS', '16782999921678132836coca-cola-original-20oz.png', 2),
(7, 1, 'Coca Cola 0.33l', 0.88, 50, 2, 'Coca Cola 0.33l\r\n<br />\r\nOrigin: Macedonia', '16782999721678133665coca-cola-classic-033-l-sweet-water-w-w.jpg', 2),
(8, 1, 'Fanta 0.5l', 1.15, 8, 10, 'Fanta 0.5l\r\n<br />\r\nOrigin: RKS', '1678302734fanta-0.5-L-pet.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `subtitle` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `image` varchar(255) NOT NULL DEFAULT 'noimage.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `title`, `subtitle`, `is_active`, `image`) VALUES
(13, 'ASUS Rog Strike 500', 'Best gaming laptop of 2023', 1, '1678131699mb_d-KS-1678094748.jpg'),
(14, 'Karrige per gamera', 'Karrige komode nga brendi i ASUS', 0, '1678131832mb-d-1677936208.jpg'),
(15, 'Samsung HQ TV', 'Bota reale ne ekranin tuaj', 0, '1678131859tc.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rezervimi`
--

CREATE TABLE `rezervimi` (
  `rezervimi_id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `dhoma_id` int(11) DEFAULT NULL,
  `datafillimi` datetime DEFAULT NULL,
  `datambarimi` datetime DEFAULT NULL,
  `totalipagesa` float DEFAULT NULL,
  `emri` varchar(45) DEFAULT NULL,
  `telefoni` varchar(45) DEFAULT NULL,
  `adresa` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rezervimi`
--

INSERT INTO `rezervimi` (`rezervimi_id`, `userid`, `dhoma_id`, `datafillimi`, `datambarimi`, `totalipagesa`, `emri`, `telefoni`, `adresa`, `email`) VALUES
(3, NULL, NULL, '2023-03-25 00:00:00', '2023-03-26 00:00:00', 70, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(4, NULL, NULL, '2023-03-31 00:00:00', '2023-03-27 00:00:00', NULL, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(5, NULL, NULL, '2023-03-25 00:00:00', '2023-03-29 00:00:00', 0, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(6, NULL, NULL, '2023-03-25 00:00:00', '2023-03-27 00:00:00', 0, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(7, NULL, NULL, '2023-03-25 00:00:00', '2023-03-29 00:00:00', 280, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(8, NULL, NULL, '2023-03-25 00:00:00', '2023-04-02 00:00:00', 640, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(9, NULL, NULL, '2023-03-26 00:00:00', '2023-03-29 00:00:00', 240, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(10, NULL, NULL, '2023-03-26 00:00:00', '2023-03-29 00:00:00', 240, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(11, NULL, NULL, '2023-03-26 00:00:00', '2023-03-29 00:00:00', 240, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(12, NULL, NULL, '2023-03-26 00:00:00', '2023-03-29 00:00:00', 240, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(13, NULL, NULL, '2023-03-26 00:00:00', '2023-03-29 00:00:00', 240, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(14, NULL, NULL, '2023-03-26 00:00:00', '2023-03-27 00:00:00', 80, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(15, NULL, NULL, '2023-03-26 00:00:00', '2023-03-27 00:00:00', 80, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(16, NULL, NULL, '2023-03-26 00:00:00', '2023-03-27 00:00:00', 80, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(17, NULL, NULL, '2023-03-26 00:00:00', '2023-03-27 00:00:00', 80, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(18, NULL, NULL, '2023-03-26 00:00:00', '2023-03-30 00:00:00', 320, 'Klient1', '656654', NULL, 'xheliling@gmail.com'),
(19, NULL, NULL, '2023-03-25 00:00:00', '2023-03-28 00:00:00', 240, 'Klient5', '656654', NULL, 'user5@gmail.com'),
(20, NULL, NULL, '2023-03-25 00:00:00', '2023-03-28 00:00:00', 240, 'Klient5', '656654', NULL, 'user5@gmail.com'),
(21, NULL, NULL, '2023-03-30 00:00:00', '2023-03-31 00:00:00', 70, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(22, NULL, NULL, '2023-03-30 00:00:00', '2023-03-31 00:00:00', 70, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(23, NULL, NULL, '2023-03-30 00:00:00', '2023-03-31 00:00:00', 70, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(24, NULL, NULL, '2023-03-30 00:00:00', '2023-03-31 00:00:00', 70, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(25, NULL, NULL, '2023-03-30 00:00:00', '2023-03-31 00:00:00', 70, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(26, NULL, NULL, '2023-03-30 00:00:00', '2023-04-07 00:00:00', 560, 'Klient1', '0255655', NULL, 'xheliling@gmail.com'),
(27, 6, NULL, '2023-03-25 00:00:00', '2023-03-30 00:00:00', 350, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(28, 6, NULL, '2023-03-31 00:00:00', '2023-04-07 00:00:00', 490, 'Klient1', '0442225', NULL, 'xheliling@gmail.com'),
(34, 5, NULL, '2023-03-24 00:00:00', '2023-03-31 00:00:00', 840, 'Klient1', '0445551225', NULL, 'user1@hotmail.com'),
(35, 5, NULL, '2023-03-25 00:00:00', '2023-03-26 00:00:00', 70, 'xhelili', '22456', NULL, 'xheliling@gmail.com'),
(36, 6, NULL, '2023-03-25 00:00:00', '2023-03-31 00:00:00', 720, 'Klient5', '0445551225', NULL, 'xheliling@gmail.com'),
(37, 6, NULL, '2023-03-31 00:00:00', '2023-04-01 00:00:00', 120, 'Klient5', '55454', NULL, 'klient@gmail.com'),
(38, 5, NULL, '2023-03-28 00:00:00', '2023-03-31 00:00:00', 360, 'Klient5', '54556', NULL, 'xheliling@gmail.com'),
(39, 6, NULL, '2023-03-26 00:00:00', '2023-03-28 00:00:00', 280, 'Klient4', '044222555', NULL, 'klient@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `reze_dhoma`
--

CREATE TABLE `reze_dhoma` (
  `rezervimi_id` int(11) DEFAULT NULL,
  `dhoma_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `emri` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `confirm_password` varchar(45) DEFAULT NULL,
  `tel` varchar(45) NOT NULL,
  `adresa` varchar(45) DEFAULT NULL,
  `roli` varchar(45) DEFAULT 'customer',
  `image` varchar(150) DEFAULT 'noimage.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `emri`, `username`, `email`, `password`, `confirm_password`, `tel`, `adresa`, `roli`, `image`) VALUES
(1, NULL, 'xhelil', 'xheliling@gmail.com', '123456', '123456', '', NULL, 'admin', 'noimage.png'),
(2, NULL, 'user', 'user@hotmail.com', '$2y$10$B07ySbNDSqW.i.DXaJypoOeXSr35pkhyzGX4u9', NULL, '', NULL, 'admin', 'noimage.png'),
(3, NULL, 'user1', 'user1@hotmail.com', '$2y$10$n90XC5nkkQJ.cupZXmo0puJM2Z6Cs86GkyMQEr', NULL, '', NULL, 'customer', 'noimage.png'),
(4, NULL, 'user3', 'user3@gmail.com', '$2y$10$Imh/uWGQry1223JQ3QYRkudqV.DexSSTiEbzti', NULL, '', NULL, 'customer', 'noimage.png'),
(5, NULL, 'user4', 'user4@gmail.com', '11111', NULL, '', NULL, 'customer', 'noimage.png'),
(6, NULL, 'user5', 'user5@gmail.com', '55555', NULL, '', NULL, 'customer', 'noimage.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dhoma`
--
ALTER TABLE `dhoma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dhoma_user_idx` (`user_id`),
  ADD KEY `fk-dhomacategory_idx` (`dhoma_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rezervimi`
--
ALTER TABLE `rezervimi`
  ADD PRIMARY KEY (`rezervimi_id`),
  ADD KEY `fk_rezervim_dhioma_idx` (`dhoma_id`),
  ADD KEY `fk_rezervim_user_idx` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dhoma`
--
ALTER TABLE `dhoma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rezervimi`
--
ALTER TABLE `rezervimi`
  MODIFY `rezervimi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dhoma`
--
ALTER TABLE `dhoma`
  ADD CONSTRAINT `fk-dhomacategory` FOREIGN KEY (`dhoma_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dhoma_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rezervimi`
--
ALTER TABLE `rezervimi`
  ADD CONSTRAINT `fk_rezervim_dhioma` FOREIGN KEY (`dhoma_id`) REFERENCES `dhoma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rezervim_user` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
