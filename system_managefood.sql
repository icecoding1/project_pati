-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2022 at 03:41 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system_managefood`
--

-- --------------------------------------------------------

--
-- Table structure for table `structure_management`
--

CREATE TABLE `structure_management` (
  `id` int(11) NOT NULL,
  `name_shop` varchar(100) DEFAULT NULL,
  `count_table` int(11) DEFAULT NULL,
  `text_index` longtext DEFAULT NULL,
  `logo_shop` varchar(100) DEFAULT NULL,
  `background` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `structure_management`
--

INSERT INTO `structure_management` (`id`, `name_shop`, `count_table`, `text_index`, `logo_shop`, `background`) VALUES
(1, 'ร้านป้าเเจ๋ว ', 20, 'ขอให้พนักงานทุกท่านดูเเล เเละบริการลูกค้าเป็นอย่างดี😀🥰 ', '030920221718723153.png', '030920221050614110.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `table_listfood`
--

CREATE TABLE `table_listfood` (
  `id` int(11) NOT NULL,
  `number_menu` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type_food` varchar(100) DEFAULT NULL,
  `price_food` int(11) DEFAULT NULL,
  `detail` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'online',
  `image` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `intro_check` varchar(100) DEFAULT NULL,
  `new_menu` varchar(100) DEFAULT NULL,
  `count_sales` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_listfood`
--

INSERT INTO `table_listfood` (`id`, `number_menu`, `name`, `type_food`, `price_food`, `detail`, `status`, `image`, `created_at`, `intro_check`, `new_menu`, `count_sales`) VALUES
(280, '506429620', 'กระเพรา', 'อาหาร', 55, 'กระเพราไม่มีไข่ดาว\r\n', 'online', '01092022942060730.png', '2022-11-24 14:50:24', NULL, '07092022114013', 2),
(281, '1371232339', 'กระเพรา', 'อาหาร', 55, 'กระเพราไข่ดาว', 'online', '010920222073250723.png', '2022-11-24 14:40:13', NULL, '11092022114013', 9),
(284, '1669297764', 'ต้มยำ', 'อาหาร', 65, 'เมนูต้มยำ', 'online', '010920221620088494.png', '2022-11-24 11:54:47', NULL, '11092022114013', 5),
(285, '489397862', 'ต้มจืด', 'อาหาร', 50, 'ต้มจืด', 'online', '01092022919219140.png', '2022-09-28 09:13:57', NULL, '11092022114013', 0),
(286, '1382771226', 'ข้าวผัด', 'อาหาร', 50, 'ไข่ดาวเพิ่ม 5 ฿ ', 'online', '01092022989168970.png', '2022-11-19 04:23:00', NULL, '11092022114013', 2),
(287, '1421436445', 'ไข่ดาวไส้กรอก', 'อาหาร', 50, 'อาหารเช้า', 'online', '010920221672098156.png', '2022-11-19 04:22:48', NULL, '10092022114013', 1),
(288, '1353681830', 'กระเพราไข่ดาว', 'อาหาร', 60, 'กระเพราไข่ดาว', 'online', '010920221062648880.png', '2022-11-19 04:23:00', NULL, '11092022114013', 3),
(289, '1877583263', 'ต้มจืด', 'อาหาร', 50, 'ต้มจืด', 'online', '01092022824269332.png', '2022-09-11 05:37:10', NULL, '01092022114013', 0),
(290, '1171736340', 'ข้าวผัด', 'อาหาร', 50, 'ข้าวผัด', 'online', '01092022216527205.png', '2022-09-11 05:37:10', NULL, '01092022114013', 0),
(291, '1385816242', 'ต้มยำ', 'อาหาร', 50, 'ต้มยำ', 'online', '01092022291622951.png', '2022-09-24 16:32:55', 'yes', '01092022114013', 0),
(292, '2041587132', 'ไข่ดาวไส้กรอก', 'อาหาร', 50, 'อาหารเช้า', 'online', '01092022897597479.png', '2022-09-11 06:20:48', 'yes', '01092022114013', 0),
(293, '1960642275', 'มอคค่า', 'เครื่องดื่ม', 55, 'มอคค่า', 'online', '010920221233237399.png', '2022-09-28 09:14:03', 'no', '01092022114013', 0),
(294, '1419324236', 'ต้มจืด', 'อาหาร', 50, 'ต้มจืด', 'online', '020920221417027925.png', '2022-09-28 09:14:10', 'yes', '01092022114013', 0),
(295, '2097776672', 'ต้มยำ', 'อาหาร', 100, 'ต้มยำ', 'online', '03092022625107283.png', '2022-09-28 09:14:13', 'yes', '01092022114013', 0),
(297, '1133213927', 'ต้มยำ', 'อาหาร', 160, 'xx', 'online', '11092022386145228.png', '2022-09-11 07:04:35', 'no', '11092022133647', 0),
(298, '1168210926', 'ไข่ดาวไส้กรอก', 'อาหาร', 60, 'ไข่ดาวไส้กรอก', 'online', '11092022565079081.png', '2022-09-28 09:14:17', 'yes', '05092022140635', 0),
(299, '1921217778', 'ต้มยำ', 'อาหาร', 60, 'xxx', 'online', '110920221575936288', '2022-09-11 09:39:36', 'yes', '11092022163936', 0),
(300, '376003760', 'ต้มยำ', 'อาหาร', 60, '', 'online', '24092022354517635', '2022-09-24 16:31:16', 'no', '24092022233116', 0),
(301, '397757692', 'กระเพราไข่ดาว', 'อาหาร', 60, '', 'online', '24092022651278900', '2022-09-24 16:31:27', 'no', '24092022233127', 0),
(302, '349175130', 'ไข่ดาวไส้กรอก', 'อาหาร', 60, '', 'online', '2409202247599995', '2022-09-24 16:31:42', 'no', '24092022233142', 0),
(303, '700842914', 'กระเพราไข่ดาว', NULL, 60, '', 'online', '240920221334222308', '2022-09-24 16:31:50', 'no', '24092022233150', 0),
(304, '1186259340', 'ต้มยำ', 'อาหาร', 60, '', 'online', '240920221691727653', '2022-09-24 16:31:58', 'no', '24092022233158', 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_member`
--

CREATE TABLE `table_member` (
  `id` int(11) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_member`
--

INSERT INTO `table_member` (`id`, `image`, `name`, `username`, `password`, `status`, `date_create`) VALUES
(92, '251122502822876.png', 'pong', 'admin', '714d16fd3366d3ea56d2e81a3d7ea39f', 'admin', '2022-10-21 03:43:42'),
(96, '241122882610676', 'xx', 'patiphon11_dev', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '2022-11-24 16:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `table_order`
--

CREATE TABLE `table_order` (
  `id` int(11) NOT NULL,
  `number_order` varchar(100) DEFAULT NULL,
  `list_order` text DEFAULT NULL,
  `listAll_order` text NOT NULL,
  `priceAll` int(11) DEFAULT NULL,
  `count_order` int(11) DEFAULT NULL,
  `pay_from_user` int(11) NOT NULL,
  `table_user` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_date` text NOT NULL,
  `number_sort` text NOT NULL,
  `date_report` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_order`
--

INSERT INTO `table_order` (`id`, `number_order`, `list_order`, `listAll_order`, `priceAll`, `count_order`, `pay_from_user`, `table_user`, `note`, `status`, `create_date`, `number_sort`, `date_report`) VALUES
(64, '202858326', '[{\"id\":293,\"name\":\"\\u0e21\\u0e2d\\u0e04\\u0e04\\u0e48\\u0e32\",\"type\":\"\\u0e40\\u0e04\\u0e23\\u0e37\\u0e48\\u0e2d\\u0e07\\u0e14\\u0e37\\u0e48\\u0e21\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920221233237399.png\"}]', '[{\"id\":293,\"name\":\"\\u0e21\\u0e2d\\u0e04\\u0e04\\u0e48\\u0e32\",\"type\":\"\\u0e40\\u0e04\\u0e23\\u0e37\\u0e48\\u0e2d\\u0e07\\u0e14\\u0e37\\u0e48\\u0e21\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920221233237399.png\"}]', 55, 1, 0, '2', '', 3, '27-09-2022  20:52:05', '27092022205205', '2022-09-27'),
(67, '231624106', '[{\"id\":280,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"01092022942060730.png\"}]', '[{\"id\":280,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"01092022942060730.png\"}]', 55, 1, 0, '2', '', 3, '27-09-2022  23:16:49', '27092022231649', '2022-09-27'),
(68, '231826434', '[{\"id\":280,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"01092022942060730.png\"}]', '[{\"id\":280,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"01092022942060730.png\"}]', 55, 1, 0, '1', '', 3, '27-09-2022  23:23:09', '27092022232309', '2022-09-27'),
(69, '155717866', '[{\"id\":281,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":4,\"price_food\":55,\"priceAll\":220,\"image\":\"010920222073250723.png\"},{\"id\":293,\"name\":\"\\u0e21\\u0e2d\\u0e04\\u0e04\\u0e48\\u0e32\",\"type\":\"\\u0e40\\u0e04\\u0e23\\u0e37\\u0e48\\u0e2d\\u0e07\\u0e14\\u0e37\\u0e48\\u0e21\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920221233237399.png\"},{\"id\":295,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e22\\u0e33\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":2,\"price_food\":100,\"priceAll\":200,\"image\":\"03092022625107283.png\"},{\"id\":298,\"name\":\"\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\\u0e44\\u0e2a\\u0e49\\u0e01\\u0e23\\u0e2d\\u0e01\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":60,\"priceAll\":60,\"image\":\"11092022565079081.png\"}]', '[{\"id\":281,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920222073250723.png\"},{\"id\":281,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920222073250723.png\"},{\"id\":281,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920222073250723.png\"},{\"id\":281,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920222073250723.png\"},{\"id\":293,\"name\":\"\\u0e21\\u0e2d\\u0e04\\u0e04\\u0e48\\u0e32\",\"type\":\"\\u0e40\\u0e04\\u0e23\\u0e37\\u0e48\\u0e2d\\u0e07\\u0e14\\u0e37\\u0e48\\u0e21\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920221233237399.png\"},{\"id\":295,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e22\\u0e33\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":100,\"priceAll\":100,\"image\":\"03092022625107283.png\"},{\"id\":295,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e22\\u0e33\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":100,\"priceAll\":100,\"image\":\"03092022625107283.png\"},{\"id\":298,\"name\":\"\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\\u0e44\\u0e2a\\u0e49\\u0e01\\u0e23\\u0e2d\\u0e01\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":60,\"priceAll\":60,\"image\":\"11092022565079081.png\"}]', 535, 8, 0, '2', 'ไข่ดาวสุก', 3, '28-09-2022  16:07:30', '28092022160730', '2022-09-28'),
(70, '160003145', '[{\"id\":281,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":3,\"price_food\":55,\"priceAll\":165,\"image\":\"010920222073250723.png\"}]', '[{\"id\":281,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920222073250723.png\"},{\"id\":281,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920222073250723.png\"},{\"id\":281,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920222073250723.png\"}]', 165, 3, 0, '2', '', 3, '28-09-2022  16:16:59', '28092022161659', '2022-09-28'),
(71, '160034711', '[{\"id\":284,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e22\\u0e33\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":65,\"priceAll\":65,\"image\":\"010920221620088494.png\"}]', '[{\"id\":284,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e22\\u0e33\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":65,\"priceAll\":65,\"image\":\"010920221620088494.png\"}]', 65, 1, 0, '2', '', 3, '24-11-2022  18:54:47', '24112022185447', '2022-09-28'),
(72, '160140645', '[{\"id\":284,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e22\\u0e33\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":2,\"price_food\":65,\"priceAll\":130,\"image\":\"010920221620088494.png\"}]', '[{\"id\":284,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e22\\u0e33\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":65,\"priceAll\":65,\"image\":\"010920221620088494.png\"},{\"id\":284,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e22\\u0e33\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":65,\"priceAll\":65,\"image\":\"010920221620088494.png\"}]', 130, 2, 0, '2', '', 3, '24-11-2022  18:54:42', '24112022185442', '2022-09-28'),
(73, '160231610', '[{\"id\":285,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e08\\u0e37\\u0e14\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":2,\"price_food\":50,\"priceAll\":100,\"image\":\"01092022919219140.png\"},{\"id\":286,\"name\":\"\\u0e02\\u0e49\\u0e32\\u0e27\\u0e1c\\u0e31\\u0e14\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":50,\"priceAll\":50,\"image\":\"01092022989168970.png\"},{\"id\":294,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e08\\u0e37\\u0e14\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":50,\"priceAll\":50,\"image\":\"020920221417027925.png\"},{\"id\":295,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e22\\u0e33\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":100,\"priceAll\":100,\"image\":\"03092022625107283.png\"}]', '[{\"id\":285,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e08\\u0e37\\u0e14\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":50,\"priceAll\":50,\"image\":\"01092022919219140.png\"},{\"id\":285,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e08\\u0e37\\u0e14\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":50,\"priceAll\":50,\"image\":\"01092022919219140.png\"},{\"id\":286,\"name\":\"\\u0e02\\u0e49\\u0e32\\u0e27\\u0e1c\\u0e31\\u0e14\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":50,\"priceAll\":50,\"image\":\"01092022989168970.png\"},{\"id\":294,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e08\\u0e37\\u0e14\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":50,\"priceAll\":50,\"image\":\"020920221417027925.png\"},{\"id\":295,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e22\\u0e33\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":100,\"priceAll\":100,\"image\":\"03092022625107283.png\"}]', 300, 5, 0, '2', '', 3, '28-09-2022  16:06:50', '28092022160650', '2022-09-28'),
(74, '154600451', '[{\"id\":280,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":2,\"price_food\":55,\"priceAll\":110,\"image\":\"01092022942060730.png\"},{\"id\":284,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e22\\u0e33\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":2,\"price_food\":65,\"priceAll\":130,\"image\":\"010920221620088494.png\"},{\"id\":286,\"name\":\"\\u0e02\\u0e49\\u0e32\\u0e27\\u0e1c\\u0e31\\u0e14\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":2,\"price_food\":50,\"priceAll\":100,\"image\":\"01092022989168970.png\"},{\"id\":288,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":2,\"price_food\":60,\"priceAll\":120,\"image\":\"010920221062648880.png\"}]', '[{\"id\":280,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"01092022942060730.png\"},{\"id\":280,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"01092022942060730.png\"},{\"id\":284,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e22\\u0e33\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":65,\"priceAll\":65,\"image\":\"010920221620088494.png\"},{\"id\":284,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e22\\u0e33\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":65,\"priceAll\":65,\"image\":\"010920221620088494.png\"},{\"id\":286,\"name\":\"\\u0e02\\u0e49\\u0e32\\u0e27\\u0e1c\\u0e31\\u0e14\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":50,\"priceAll\":50,\"image\":\"01092022989168970.png\"},{\"id\":286,\"name\":\"\\u0e02\\u0e49\\u0e32\\u0e27\\u0e1c\\u0e31\\u0e14\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":50,\"priceAll\":50,\"image\":\"01092022989168970.png\"},{\"id\":288,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":60,\"priceAll\":60,\"image\":\"010920221062648880.png\"},{\"id\":288,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":60,\"priceAll\":60,\"image\":\"010920221062648880.png\"}]', 460, 8, 0, '1', '', 3, '19-11-2022  11:23:00', '19112022112300', '2022-10-15'),
(75, '124150548', '[{\"id\":288,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":60,\"priceAll\":60,\"image\":\"010920221062648880.png\"}]', '[{\"id\":288,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":60,\"priceAll\":60,\"image\":\"010920221062648880.png\"}]', 60, 1, 0, '1', '', 3, '21-10-2022  12:52:55', '21102022125255', '2022-10-21'),
(76, '225958103', '[{\"id\":287,\"name\":\"\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\\u0e44\\u0e2a\\u0e49\\u0e01\\u0e23\\u0e2d\\u0e01\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":50,\"priceAll\":50,\"image\":\"010920221672098156.png\"}]', '[{\"id\":287,\"name\":\"\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\\u0e44\\u0e2a\\u0e49\\u0e01\\u0e23\\u0e2d\\u0e01\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":50,\"priceAll\":50,\"image\":\"010920221672098156.png\"}]', 50, 1, 0, '1', '', 3, '19-11-2022  11:22:48', '19112022112248', '2022-11-17'),
(78, '184043901', '[{\"id\":281,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920222073250723.png\"}]', '[{\"id\":281,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920222073250723.png\"}]', 55, 1, 100, '1', 'ไข่ดาวไม่สุก', 3, '24-11-2022  21:40:13', '24112022214013', '2022-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `table_typefood`
--

CREATE TABLE `table_typefood` (
  `id` int(11) NOT NULL,
  `type` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_typefood`
--

INSERT INTO `table_typefood` (`id`, `type`, `created_at`) VALUES
(16, 'อาหาร', '2022-08-31 14:31:35'),
(17, 'เครื่องดื่ม', '2022-08-31 14:31:38'),
(19, 'กาเเฟสด', '2022-08-31 15:02:54'),
(20, 'น้ำหวาน เเละ ชานมไข่มุก', '2022-09-03 09:09:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `structure_management`
--
ALTER TABLE `structure_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_listfood`
--
ALTER TABLE `table_listfood`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_member`
--
ALTER TABLE `table_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_order`
--
ALTER TABLE `table_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_typefood`
--
ALTER TABLE `table_typefood`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `structure_management`
--
ALTER TABLE `structure_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `table_listfood`
--
ALTER TABLE `table_listfood`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT for table `table_member`
--
ALTER TABLE `table_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `table_order`
--
ALTER TABLE `table_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `table_typefood`
--
ALTER TABLE `table_typefood`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
