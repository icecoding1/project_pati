-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2023 at 05:25 AM
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
  `background` varchar(100) DEFAULT NULL,
  `slide_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `structure_management`
--

INSERT INTO `structure_management` (`id`, `name_shop`, `count_table`, `text_index`, `logo_shop`, `background`, `slide_image`) VALUES
(1, 'ร้านป้าเเจ๋ว  สาขา 2', 20, 'ขอให้พนักงานทุกท่านดูเเล เเละบริการลูกค้าเป็นอย่างดี😀🥰 ', '030920221718723153.png', '030920221050614110.jpg', '[{\"name\":\"251122376826817.png\"},{\"name\":\"241222375502844.png\"},{\"name\":\"271222130810424.png\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `table_article`
--

CREATE TABLE `table_article` (
  `id` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `name_edit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_article`
--

INSERT INTO `table_article` (`id`, `header`, `detail`, `type`, `date_created`, `name_edit`) VALUES
(40, 'test', '<p>เนื้อหาบทความ</p>', 'test', '2023-01-05 01:02:22', 'ปฏิพล'),
(41, 'test', '<p>การทำงาน</p>', 'การทำงาน', '2023-01-05 01:21:18', 'ปฏิพล');

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
(280, '506429620', 'กระเพรา', 'อาหาร', 55, 'กระเพราไม่มีไข่ดาว\r\n', 'offline', '01092022942060730.png', '2023-01-04 18:11:46', 'yes', '07092022114013', 3),
(281, '1371232339', 'กระเพรา', 'อาหาร', 55, 'กระเพราไข่ดาว', 'online', '010920222073250723.png', '2023-01-04 19:12:39', NULL, '11092022114013', 11),
(284, '1669297764', 'ต้มยำ', 'อาหาร', 65, 'เมนูต้มยำ', 'online', '010920221620088494.png', '2022-11-24 11:54:47', NULL, '11092022114013', 5),
(285, '489397862', 'ต้มจืด', 'อาหาร', 50, 'ต้มจืด', 'online', '01092022919219140.png', '2023-01-04 19:12:39', NULL, '11092022114013', 1),
(286, '1382771226', 'ข้าวผัด', 'อาหาร', 50, 'ไข่ดาวเพิ่ม 5 ฿ ', 'offline', '01092022989168970.png', '2022-11-25 04:15:18', NULL, '11092022114013', 2),
(287, '1421436445', 'ไข่ดาวไส้กรอก', 'อาหาร', 50, 'อาหารเช้า', 'online', '010920221672098156.png', '2023-01-04 16:36:56', NULL, '10092022114013', 4),
(288, '1353681830', 'กระเพราไข่ดาว', 'อาหาร', 60, 'กระเพราไข่ดาว', 'online', '010920221062648880.png', '2023-01-04 18:16:47', NULL, '11092022114013', 5),
(289, '1877583263', 'ต้มจืด', 'อาหาร', 50, 'ต้มจืด', 'online', '01092022824269332.png', '2022-12-27 15:29:26', NULL, '01092022114013', 1),
(290, '1171736340', 'ข้าวผัด', 'อาหาร', 50, 'ข้าวผัด', 'online', '01092022216527205.png', '2022-09-11 05:37:10', NULL, '01092022114013', 0),
(291, '1385816242', 'ต้มยำ', 'อาหาร', 50, 'ต้มยำ', 'online', '01092022291622951.png', '2022-09-24 16:32:55', 'yes', '01092022114013', 0),
(292, '2041587132', 'ไข่ดาวไส้กรอก', 'อาหาร', 50, 'อาหารเช้า', 'online', '01092022897597479.png', '2022-09-11 06:20:48', 'yes', '01092022114013', 0),
(293, '1960642275', 'มอคค่า', 'เครื่องดื่ม', 55, 'มอคค่า', 'online', '010920221233237399.png', '2023-01-04 19:12:39', 'no', '01092022114013', 2),
(294, '1419324236', 'ต้มจืด', 'อาหาร', 50, 'ต้มจืด', 'online', '020920221417027925.png', '2022-09-28 09:14:10', 'yes', '01092022114013', 0),
(295, '2097776672', 'ต้มยำ', 'อาหาร', 100, 'ต้มยำ', 'online', '03092022625107283.png', '2022-09-28 09:14:13', 'yes', '01092022114013', 0),
(297, '1133213927', 'ต้มยำ', 'อาหาร', 160, 'xx', 'online', '11092022386145228.png', '2022-09-11 07:04:35', 'no', '11092022133647', 0),
(298, '1168210926', 'ไข่ดาวไส้กรอก', 'อาหาร', 60, 'ไข่ดาวไส้กรอก', 'online', '11092022565079081.png', '2022-11-25 04:22:41', 'yes', '05092022140635', 1),
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
(92, '251122502822876.png', 'ปฏิพล', 'admin', '714d16fd3366d3ea56d2e81a3d7ea39f', 'admin', '2022-10-21 03:43:42'),
(96, '241122882610676', 'นัทพงค์', 'patiphon11_dev', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '2022-11-24 16:44:45'),
(97, '2511221539582615', 'mai', 'mai', '714d16fd3366d3ea56d2e81a3d7ea39f', 'admin', '2022-11-25 02:53:22'),
(98, '2511221743313117', 'thanit', 'thanit', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '2022-11-25 04:19:34');

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
  `sound_notification` int(11) NOT NULL DEFAULT 1,
  `create_date` text NOT NULL,
  `name_edit` varchar(255) NOT NULL,
  `number_sort` text NOT NULL,
  `date_report` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_order`
--

INSERT INTO `table_order` (`id`, `number_order`, `list_order`, `listAll_order`, `priceAll`, `count_order`, `pay_from_user`, `table_user`, `note`, `status`, `sound_notification`, `create_date`, `name_edit`, `number_sort`, `date_report`) VALUES
(203, '235327492', '[{\"id\":287,\"name\":\"\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\\u0e44\\u0e2a\\u0e49\\u0e01\\u0e23\\u0e2d\\u0e01\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":50,\"priceAll\":50,\"image\":\"010920221672098156.png\"}]', '[{\"id\":287,\"name\":\"\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\\u0e44\\u0e2a\\u0e49\\u0e01\\u0e23\\u0e2d\\u0e01\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":50,\"priceAll\":50,\"image\":\"010920221672098156.png\"}]', 50, 1, 0, '5', '', 2, 2, '04-01-2023  23:53:53', '{\"order_send\":\"\\u0e1b\\u0e0f\\u0e34\\u0e1e\\u0e25\",\"order_confirm\":\"\\u0e1b\\u0e0f\\u0e34\\u0e1e\\u0e25\"}', '04012023235327', '2023-01-04'),
(204, '235430347', '[{\"id\":288,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":60,\"priceAll\":60,\"image\":\"010920221062648880.png\"}]', '[{\"id\":288,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":60,\"priceAll\":60,\"image\":\"010920221062648880.png\"}]', 60, 1, 100, '5', '', 3, 2, '04-01-2023  23:57:23', '{\"order_send\":\"\\u0e1b\\u0e0f\\u0e34\\u0e1e\\u0e25\",\"order_confirm\":\"\\u0e1b\\u0e0f\\u0e34\\u0e1e\\u0e25\",\"order_success\":\"\\u0e1b\\u0e0f\\u0e34\\u0e1e\\u0e25\"}', '04012023235723', '2023-01-04'),
(205, '000148275', '[{\"id\":288,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":60,\"priceAll\":60,\"image\":\"010920221062648880.png\"}]', '[{\"id\":288,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":60,\"priceAll\":60,\"image\":\"010920221062648880.png\"}]', 60, 1, 0, '5', '', 2, 2, '05-01-2023  00:02:20', '{\"order_send\":\"\\u0e1b\\u0e0f\\u0e34\\u0e1e\\u0e25\",\"order_confirm\":\"\\u0e1b\\u0e0f\\u0e34\\u0e1e\\u0e25\"}', '05012023000148', '2023-01-05'),
(206, '011449469', '[{\"id\":288,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":60,\"priceAll\":60,\"image\":\"010920221062648880.png\"}]', '[{\"id\":288,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\\u0e44\\u0e02\\u0e48\\u0e14\\u0e32\\u0e27\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":60,\"priceAll\":60,\"image\":\"010920221062648880.png\"}]', 60, 1, 100, '1', '', 3, 2, '05-01-2023  01:16:47', '{\"order_send\":\"\\u0e1b\\u0e0f\\u0e34\\u0e1e\\u0e25\",\"order_confirm\":\"\\u0e1b\\u0e0f\\u0e34\\u0e1e\\u0e25\",\"order_success\":\"\\u0e1b\\u0e0f\\u0e34\\u0e1e\\u0e25\"}', '05012023011647', '2023-01-05'),
(207, '021024390', '[{\"id\":281,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920222073250723.png\"},{\"id\":285,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e08\\u0e37\\u0e14\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":50,\"priceAll\":50,\"image\":\"01092022919219140.png\"},{\"id\":293,\"name\":\"\\u0e21\\u0e2d\\u0e04\\u0e04\\u0e48\\u0e32\",\"type\":\"\\u0e40\\u0e04\\u0e23\\u0e37\\u0e48\\u0e2d\\u0e07\\u0e14\\u0e37\\u0e48\\u0e21\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920221233237399.png\"}]', '[{\"id\":281,\"name\":\"\\u0e01\\u0e23\\u0e30\\u0e40\\u0e1e\\u0e23\\u0e32\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920222073250723.png\"},{\"id\":285,\"name\":\"\\u0e15\\u0e49\\u0e21\\u0e08\\u0e37\\u0e14\",\"type\":\"\\u0e2d\\u0e32\\u0e2b\\u0e32\\u0e23\",\"count\":1,\"price_food\":50,\"priceAll\":50,\"image\":\"01092022919219140.png\"},{\"id\":293,\"name\":\"\\u0e21\\u0e2d\\u0e04\\u0e04\\u0e48\\u0e32\",\"type\":\"\\u0e40\\u0e04\\u0e23\\u0e37\\u0e48\\u0e2d\\u0e07\\u0e14\\u0e37\\u0e48\\u0e21\",\"count\":1,\"price_food\":55,\"priceAll\":55,\"image\":\"010920221233237399.png\"}]', 160, 3, 500, '1', '', 3, 2, '05-01-2023  02:12:39', '{\"order_send\":\"\\u0e1b\\u0e0f\\u0e34\\u0e1e\\u0e25\",\"order_confirm\":\"\\u0e1b\\u0e0f\\u0e34\\u0e1e\\u0e25\",\"order_success\":\"\\u0e1b\\u0e0f\\u0e34\\u0e1e\\u0e25\"}', '05012023021239', '2023-01-05');

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
-- Indexes for table `table_article`
--
ALTER TABLE `table_article`
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
-- AUTO_INCREMENT for table `table_article`
--
ALTER TABLE `table_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `table_listfood`
--
ALTER TABLE `table_listfood`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT for table `table_member`
--
ALTER TABLE `table_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `table_order`
--
ALTER TABLE `table_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `table_typefood`
--
ALTER TABLE `table_typefood`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
