-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2020 at 12:58 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acme`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(10) UNSIGNED NOT NULL,
  `categoryName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Category classifications of inventory items';

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Cannon'),
(2, 'Explosive'),
(3, 'Misc'),
(4, 'Rocket'),
(5, 'Trap'),
(7, 'Rope');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comments`) VALUES
(6, 'Ruth', 'La Plant', 'ruthlaplant@gmail.com', '$2y$10$VkwpR.aIefEvVP.sjY6lEuAtIUk67q9qJwdRkrTlmw5Abwi0qb.5.', '1', ''),
(7, 'Admin', 'User', 'admin@cit336.net', '$2y$10$3UayJJraq/cCAbm2kfGMo.if3OiLUFpce6fnDDVCkyDjajw50GAIO', '3', ''),
(10, 'Greg', '  La Plant', 'laplant.g@gmail.com', '$2y$10$jlLKk5OgROAiTNQlJ6QFSe/4rviq73Vw1CxUBHm2OyXazex7iv4Ne', '1', ''),
(11, 'Joe', 'N', 'jel@gmail.com', '$2y$10$onbzKlT5DIzoi54KNRVNKOWe2yR18tvNKrXEGVYVIDZci55fl8yVe', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL COMMENT 'AUTO_INCREMENT',
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`) VALUES
(5, 8, 'anvil.png', '/acme/images/products/anvil.png', '2020-03-20 01:39:48'),
(6, 8, 'anvil-tn.png', '/acme/images/products/anvil-tn.png', '2020-03-20 01:39:48'),
(7, 3, 'catapult.png', '/acme/images/products/catapult.png', '2020-03-20 01:40:29'),
(8, 3, 'catapult-tn.png', '/acme/images/products/catapult-tn.png', '2020-03-20 01:40:29'),
(9, 14, 'helmet.png', '/acme/images/products/helmet.png', '2020-03-20 01:40:50'),
(10, 14, 'helmet-tn.png', '/acme/images/products/helmet-tn.png', '2020-03-20 01:40:50'),
(11, 4, 'roadrunner.jpg', '/acme/images/products/roadrunner.jpg', '2020-03-20 01:41:50'),
(12, 4, 'roadrunner-tn.jpg', '/acme/images/products/roadrunner-tn.jpg', '2020-03-20 01:41:50'),
(13, 5, 'trap.jpg', '/acme/images/products/trap.jpg', '2020-03-20 01:42:10'),
(14, 5, 'trap-tn.jpg', '/acme/images/products/trap-tn.jpg', '2020-03-20 01:42:10'),
(15, 13, 'piano.jpg', '/acme/images/products/piano.jpg', '2020-03-20 01:42:29'),
(16, 13, 'piano-tn.jpg', '/acme/images/products/piano-tn.jpg', '2020-03-20 01:42:29'),
(17, 6, 'hole.png', '/acme/images/products/hole.png', '2020-03-20 01:43:16'),
(18, 6, 'hole-tn.png', '/acme/images/products/hole-tn.png', '2020-03-20 01:43:16'),
(19, 7, 'no-image.png', '/acme/images/products/no-image.png', '2020-03-20 01:43:51'),
(20, 7, 'no-image-tn.png', '/acme/images/products/no-image-tn.png', '2020-03-20 01:43:51'),
(21, 10, 'mallet.png', '/acme/images/products/mallet.png', '2020-03-20 01:44:07'),
(22, 10, 'mallet-tn.png', '/acme/images/products/mallet-tn.png', '2020-03-20 01:44:07'),
(23, 9, 'rubberband.jpg', '/acme/images/products/rubberband.jpg', '2020-03-20 01:44:44'),
(24, 9, 'rubberband-tn.jpg', '/acme/images/products/rubberband-tn.jpg', '2020-03-20 01:44:44'),
(25, 2, 'mortar.jpg', '/acme/images/products/mortar.jpg', '2020-03-20 01:45:13'),
(26, 2, 'mortar-tn.jpg', '/acme/images/products/mortar-tn.jpg', '2020-03-20 01:45:13'),
(27, 15, 'rope.jpg', '/acme/images/products/rope.jpg', '2020-03-20 01:45:30'),
(28, 15, 'rope-tn.jpg', '/acme/images/products/rope-tn.jpg', '2020-03-20 01:45:30'),
(29, 12, 'seed.jpg', '/acme/images/products/seed.jpg', '2020-03-20 01:46:09'),
(30, 12, 'seed-tn.jpg', '/acme/images/products/seed-tn.jpg', '2020-03-20 01:46:09'),
(31, 1, 'rocket.png', '/acme/images/products/rocket.png', '2020-03-20 01:46:37'),
(32, 1, 'rocket-tn.png', '/acme/images/products/rocket-tn.png', '2020-03-20 01:46:37'),
(33, 17, 'bomb.png', '/acme/images/products/bomb.png', '2020-03-20 01:46:51'),
(34, 17, 'bomb-tn.png', '/acme/images/products/bomb-tn.png', '2020-03-20 01:46:51'),
(35, 16, 'fence.png', '/acme/images/products/fence.png', '2020-03-20 01:47:07'),
(36, 16, 'fence-tn.png', '/acme/images/products/fence-tn.png', '2020-03-20 01:47:07'),
(37, 11, 'tnt.png', '/acme/images/products/tnt.png', '2020-03-20 01:47:22'),
(38, 11, 'tnt-tn.png', '/acme/images/products/tnt-tn.png', '2020-03-20 01:47:22'),
(39, 8, 'download.jpg', '/acme/images/products/download.jpg', '2020-03-21 18:25:30'),
(40, 8, 'download-tn.jpg', '/acme/images/products/download-tn.jpg', '2020-03-21 18:25:30'),
(41, 14, 'logo-01.png', '/acme/images/products/logo-01.png', '2020-03-22 03:03:06'),
(42, 14, 'logo-01-tn.png', '/acme/images/products/logo-01-tn.png', '2020-03-22 03:03:06'),
(43, 2, 'CasaLoma.png', '/acme/images/products/CasaLoma.png', '2020-03-22 03:03:49'),
(44, 2, 'CasaLoma-tn.png', '/acme/images/products/CasaLoma-tn.png', '2020-03-22 03:03:49'),
(45, 14, 'Capture2.JPG', '/acme/images/products/Capture2.JPG', '2020-03-22 03:57:32'),
(46, 14, 'Capture2-tn.JPG', '/acme/images/products/Capture2-tn.JPG', '2020-03-22 03:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invName` varchar(50) NOT NULL DEFAULT '',
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL DEFAULT '',
  `invThumbnail` varchar(50) NOT NULL DEFAULT '',
  `invPrice` decimal(10,2) NOT NULL DEFAULT 0.00,
  `invStock` smallint(6) NOT NULL DEFAULT 0,
  `invSize` smallint(6) NOT NULL DEFAULT 0,
  `invWeight` smallint(6) NOT NULL DEFAULT 0,
  `invLocation` varchar(35) NOT NULL DEFAULT '',
  `categoryId` int(10) UNSIGNED NOT NULL,
  `invVendor` varchar(20) NOT NULL DEFAULT '',
  `invStyle` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Acme Inc. Inventory Table';

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invName`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invSize`, `invWeight`, `invLocation`, `categoryId`, `invVendor`, `invStyle`) VALUES
(1, 'Rocket', 'Rocket for multiple purposes. This can be launched independently to deliver a payload or strapped on to help get you to where you want to be FAST!!! Really Fast!', '/acme/images/products/rocket.png', '/acme/images/products/rocket-tn.png', '1320.00', 5, 60, 90, 'California', 4, 'Goddard', 'metal'),
(2, 'Mortar', 'Our Mortar is very powerful. This cannon can launch a projectile or bomb 3 miles. Made of solid steel and mounted on cement or metal stands [not included].', '/acme/images/products/mortar.jpg', '/acme/images/products/mortar-tn.jpg', '1500.00', 26, 250, 750, 'San Jose', 1, 'Smith & Wesson', 'Metal'),
(3, 'Catapult', 'Our best wooden catapult. Ideal for hurling objects for up to 1000 yards. Payloads of up to 300 lbs.', '/acme/images/products/catapult.png', '/acme/images/products/catapult-tn.png', '2500.00', 4, 1569, 400, 'Cedar Point, IO', 1, 'Wooden Creations', 'Wood'),
(4, 'Female RoadRunner Cutout', 'This carbon fiber backed cutout of a female roadrunner is sure to catch the eye of any male roadrunner.', '/acme/images/products/roadrunner.jpg', '/acme/images/products/roadrunner-tn.jpg', '20.00', 500, 27, 2, 'San Jose', 5, 'Picture Perfect', 'Carbon Fiber'),
(5, 'Giant Mouse Trap', 'Our big mouse trap. This trap is multifunctional. It can be used to catch dogs, mountain lions, road runners or even muskrats. Must be staked for larger varmints [stakes not included] and baited with approptiate bait [sold seperately].\r\n', '/acme/images/products/trap.jpg', '/acme/images/products/trap-tn.jpg', '20.00', 34, 470, 28, 'Cedar Point, IO', 5, 'Rodent Control', 'Wood'),
(6, 'Instant Hole', 'Instant hole - Wonderful for creating the appearance of openings.', '/acme/images/products/hole.png', '/acme/images/products/hole-tn.png', '25.00', 269, 24, 2, 'San Jose', 3, 'Hidden Valley', 'Ether'),
(7, 'Koenigsegg CCX', 'This high performance car is sure to get you where you are going fast. It holds the production car land speed record at an amazing 250mph.', '/acme/images/products/no-image.png', '/acme/images/products/no-image.png', '500000.00', 1, 25000, 3000, 'San Jose', 3, 'Koenigsegg', 'Metal'),
(8, 'Anvil', '50 lb. Anvil - perfect for any task requireing lots of weight. Made of solid, tempered steel.', '/acme/images/products/anvil.png', '/acme/images/products/anvil-tn.png', '150.00', 15, 80, 50, 'San Jose', 5, 'Steel Made', 'Metal'),
(9, 'Monster Rubber Band', 'These are not tiny rubber bands. These are MONSTERS! These bands can stop a train locamotive or be used as a slingshot for cows. Only the best materials are used!', '/acme/images/products/rubberband.jpg', '/acme/images/products/rubberband-tn.jpg', '4.00', 4589, 75, 1, 'Cedar Point, IO', 3, 'Rubbermaid', 'Rubber'),
(10, 'Mallet', 'Ten pound mallet for bonking roadrunners on the head. Can also be used for bunny rabbits.', '/acme/images/products/mallet.png', '/acme/images/products/mallet-tn.png', '25.00', 100, 36, 10, 'Cedar Point, IA', 3, 'Wooden Creations', 'Wood'),
(11, 'TNT', 'The biggest bang for your buck with our nitro-based TNT. Price is per stick.', '/acme/images/products/tnt.png', '/acme/images/products/tnt-tn.png', '10.00', 1000, 25, 2, 'San Jose', 2, 'Nobel Enterprises', 'Plastic'),
(12, 'Roadrunner Custom Bird Seed Mix', 'Our best varmint seed mix - varmints on two or four legs can\'t resist this mix. Contains meat, nuts, cereals and our own special ingredient. Guaranteed to bring them in. Can be used with our monster trap.', '/acme/images/products/seed.jpg', '/acme/images/products/seed-tn.jpg', '8.00', 150, 24, 3, 'San Jose', 5, 'Acme', 'Plastic'),
(13, 'Grand Piano', 'This grand piano is guaranteed to play well and smash anything beneath it if dropped from a height.', '/acme/images/products/piano.jpg', '/acme/images/products/piano-tn.jpg', '3500.00', 36, 500, 1200, 'Cedar Point, IA', 3, 'Wulitzer', 'Wood'),
(14, 'Crash Helmet', 'This carbon fiber and plastic helmet is the ultimate in protection for your head. comes in assorted colors.', '/acme/images/products/helmet.png', '/acme/images/products/helmet-tn.png', '100.00', 25, 48, 9, 'San Jose', 3, 'Suzuki', 'Carbon Fiber'),
(15, 'Nylon Rope', 'This nylon rope is ideal for all uses. Each rope is the highest quality nylon and comes in 100 foot lengths.', '/acme/images/products/rope.jpg', '/acme/images/products/rope-tn.jpg', '15.00', 200, 200, 6, 'San Jose', 3, 'Marina Sales', 'Nylon'),
(16, 'Sticky Fence', 'This fence is covered with Gorilla Glue and is guaranteed to stick to anything that touches it and is sure to hold it tight.', '/acme/images/products/fence.png', '/acme/images/products/fence-tn.png', '75.00', 15, 48, 2, 'San Jose', 3, 'Acme', 'Nylon'),
(17, 'Small Bomb', 'Bomb with a fuse - A little old fashioned, but highly effective. This bomb has the ability to devistate anything within 30 feet.', '/acme/images/products/bomb.png', '/acme/images/products/bomb-tn.png', '275.00', 58, 30, 12, 'San Jose', 2, 'Nobel Enterprises', 'Metal');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(15, 'This is heavy', '2020-03-29 02:39:45', 8, 10),
(16, 'This is heavy', '2020-03-29 02:41:52', 8, 10),
(31, ';kjnklj', '2020-03-29 03:16:34', 12, 10),
(32, 'boom', '2020-03-29 03:17:45', 17, 10),
(33, 'Fast', '2020-03-29 03:19:04', 1, 10),
(34, 'Fast', '2020-03-29 03:24:01', 1, 10),
(35, 'Look out', '2020-03-29 03:29:40', 13, 10),
(36, 'Look out', '2020-03-29 03:31:32', 13, 10),
(37, 'Look out', '2020-03-29 03:51:13', 13, 10),
(38, 'What', '2020-03-29 03:52:40', 8, 10),
(39, 'What', '2020-03-29 04:06:29', 8, 10),
(40, 'mouse', '2020-03-29 04:15:32', 5, 10),
(41, 'I hate bird seed!!!', '2020-03-31 03:11:30', 12, 10),
(42, 'I hate bird seed!!!', '2020-03-31 03:11:54', 12, 10),
(43, 'I hate bird seed!!!', '2020-03-31 03:11:57', 12, 10),
(44, 'Look a piano', '2020-03-31 03:53:11', 13, 10),
(45, 'rockets are awesome', '2020-03-31 04:19:15', 1, 10),
(46, 'rockets are awesome', '2020-03-31 04:19:57', 1, 10),
(47, 'anvil', '2020-03-31 04:20:28', 8, 10),
(48, 'Anvil', '2020-03-31 04:22:41', 8, 10),
(49, 'NO', '2020-03-31 17:05:49', 12, 10),
(50, 'NO', '2020-03-31 17:13:28', 12, 10),
(51, 'NO', '2020-03-31 17:24:22', 1, 10),
(52, 'beep', '2020-03-31 17:25:52', 4, 10),
(53, 'NO', '2020-03-31 17:33:45', 12, 10),
(76, 'NO', '2020-04-01 20:16:40', 1, 10),
(77, 'nope', '2020-04-01 20:26:48', 5, 10),
(78, 'nope', '2020-04-01 20:27:25', 5, 10),
(79, 'I HATE THIS!!!!', '2020-04-01 21:50:16', 12, 10),
(80, 'alskjdbckscknj', '2020-04-01 22:30:54', 12, 10),
(81, 'nope', '2020-04-01 22:59:09', 12, 10),
(82, 'nope', '2020-04-01 23:07:48', 12, 10),
(83, 'asdfSD', '2020-04-01 23:58:26', 12, 10),
(84, 'KHGVHG', '2020-04-02 00:05:06', 12, 10),
(85, 'asfasda', '2020-04-02 00:09:15', 12, 10),
(91, 'AAAAAAAAAAA', '2020-04-04 00:03:36', 8, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `invId` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_image` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
