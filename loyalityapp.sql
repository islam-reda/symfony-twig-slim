-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2018 at 12:57 PM
-- Server version: 5.7.22
-- PHP Version: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loyalityapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand_news`
--

CREATE TABLE `brand_news` (
  `ad_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `active` int(11) NOT NULL,
  `ad_title` varchar(25) NOT NULL,
  `ad_desc1` varchar(30) NOT NULL,
  `ad_img1` text NOT NULL,
  `ad_img2` text NOT NULL,
  `ad_img3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand_news`
--

INSERT INTO `brand_news` (`ad_id`, `brand_id`, `start_date`, `end_date`, `active`, `ad_title`, `ad_desc1`, `ad_img1`, `ad_img2`, `ad_img3`) VALUES
(2, 11, '2018-06-17 00:00:00', '2018-07-24 00:00:00', 1, 'Title', 'This is description', '//35.232.23.64/uploads/33df3119cd7ae0b1.PNG', '//35.232.23.64/uploads/33df3119cd7ae0b1.PNG', '//35.232.23.64/uploads/33df3119cd7ae0b1.PNG'),
(3, 11, '2018-06-06 00:00:00', '2018-06-06 00:00:00', 1, 'lkj', 'lkj', '//35.232.23.64/uploads/037c67bad39d0d8e.jpg', '//35.232.23.64/uploads/be110ca2b5f23887.PNG', '//35.232.23.64/uploads/f1352d85d0c9d09e.PNG'),
(5, 4, '2018-06-08 00:00:00', '2018-06-15 00:00:00', 1, 'lkjl', 'lk', 'dad', 'dd', 'dfvdsf'),
(7, 4, '2002-06-04 00:00:00', '2002-06-06 00:00:00', 1, 'new 1', 'new 2', 'dad', 'dd', 'dfvdsf'),
(8, 4, '2018-06-14 00:00:00', '2018-06-04 00:00:00', 1, 'kjlj', 'kjh', 'dad', 'dd', 'dfvdsf'),
(10, 13, '2018-06-10 00:00:00', '2018-07-24 00:00:00', 1, 'News 2', 'New 2 Dec', '//35.232.23.64/uploads/1ddf2ba58f2355fd.PNG', '//35.232.23.64/uploads/d37e1b09ac10dd36.PNG', '//35.232.23.64/uploads/6f1eec96d18ed554.PNG'),
(12, 11, '2018-06-13 00:00:00', '2018-07-31 00:00:00', 1, 'kjhkjh', 'gfd', '//35.232.23.64/uploads/ced1462f61c19c26.jpg', '//35.232.23.64/uploads/a5df28e2ac61e72e.jpg', '//35.232.23.64/uploads/7389625fc02d53fd.jpg'),
(14, 11, '2018-09-01 00:00:00', '2019-01-31 00:00:00', 1, 'Dejavu Is Showing up', 'Hello Dejavu ', '//35.232.23.64/uploads/400605aa1c760088.png', '//35.232.23.64/uploads/5845226e0e12638f.jpg', '//35.232.23.64/uploads/d88087759a2376d0.jpg'),
(15, 16, '2018-06-20 00:00:00', '2019-07-31 00:00:00', 1, 'Islam Going to Army', 'say goodbye to him', '//35.232.23.64/uploads/62df57df891b972f.jpg', '//35.232.23.64/uploads/eae52ac33b86f7d5.jpg', '//35.232.23.64/uploads/7e505e8bb5c669d2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `loyalty_customers`
--

CREATE TABLE `loyalty_customers` (
  `customer_phone` varchar(20) NOT NULL,
  `active` int(3) NOT NULL,
  `activation_code` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `active_program_id` int(11) NOT NULL,
  `prog_accm_points` int(11) NOT NULL,
  `prog_accm_value` double NOT NULL,
  `prog_rdm_points` int(11) NOT NULL,
  `prog_rdm_value` double NOT NULL,
  `last_up_invc_datetime` datetime NOT NULL,
  `last_up_invc_sid` varchar(30) NOT NULL,
  `last_rdm_invc_datetime` datetime NOT NULL,
  `last_rdm_invc_sid` varchar(30) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loyalty_customers`
--

INSERT INTO `loyalty_customers` (`customer_phone`, `active`, `activation_code`, `created_date`, `active_program_id`, `prog_accm_points`, `prog_accm_value`, `prog_rdm_points`, `prog_rdm_value`, `last_up_invc_datetime`, `last_up_invc_sid`, `last_rdm_invc_datetime`, `last_rdm_invc_sid`, `brand_id`, `email`) VALUES
('011127839129', 1, '11444', '2018-07-10 12:08:55', 1, 1, 1, 100, 1, '2018-06-20 00:00:00', '1', '2018-06-20 00:00:00', '1', 1, 'nader@hotmail.com'),
('011178391259', 1, '20541', '2018-07-10 12:39:42', 1, 100, 110, 1, 1, '2018-06-19 00:00:00', '1', '2018-06-28 00:00:00', '1', 1, 'islam@yahoo.com'),
('01117839129', 1, '11444', '2018-07-10 12:08:55', 1, 1, 1, 100, 1, '2018-06-20 00:00:00', '1', '2018-06-20 00:00:00', '1', 1, '43434@hotmail.com'),
('01144054656', 1, '11', '2018-07-09 10:43:53', 1, 1, 1, 100, 1, '2018-06-20 00:00:00', '1', '2018-06-20 00:00:00', '1', 1, 'nader2@hotmail.com'),
('01150466243', 1, '20541', '2018-06-20 00:00:00', 1, 100, 110, 1, 1, '2018-06-19 00:00:00', '1', '2018-06-28 00:00:00', '1', 1, 'islam@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `loyalty_programs`
--

CREATE TABLE `loyalty_programs` (
  `brand_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `program_type` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `program_name` varchar(30) NOT NULL,
  `program_desc1` varchar(50) NOT NULL,
  `active` varchar(3) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `program_filter` varchar(100) NOT NULL,
  `program_condition` varchar(50) NOT NULL,
  `program_get` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lo_admin_users`
--

CREATE TABLE `lo_admin_users` (
  `user_id` int(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `active` int(3) NOT NULL,
  `user_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lo_admin_users`
--

INSERT INTO `lo_admin_users` (`user_id`, `email`, `password`, `active`, `user_level`) VALUES
(1, 'eslam@yahoo.com', '202cb962ac59075b964b07152d234b70', 1, 1),
(5, 'nader@yahoo.com', '202cb962ac59075b964b07152d234b70', 1, 2),
(6, 'root 4', '26e8ff29133cdeb6a1c352ccd71ec7e7', 1, 1),
(7, 'root@yahoo.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 2),
(10, 'nadermohammad9@gmail.com', 'a78bcd0197ca682b5d0728e9f5af69e6', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lo_app_settings`
--

CREATE TABLE `lo_app_settings` (
  `brand_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `check_location` varchar(3) NOT NULL,
  `show_ads` varchar(3) NOT NULL,
  `general_off_location` varchar(3) NOT NULL,
  `show_news` varchar(3) NOT NULL,
  `get_invc_url_api` varchar(75) NOT NULL,
  `get_rdm_url_api` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lo_brands`
--

CREATE TABLE `lo_brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `brand_logofile` varchar(50) NOT NULL,
  `active` varchar(3) NOT NULL,
  `activation_code` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `get_invc_url_api` varchar(75) DEFAULT NULL,
  `ge_rdm_url_api` varchar(75) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lo_brands`
--

INSERT INTO `lo_brands` (`brand_id`, `brand_name`, `brand_logofile`, `active`, `activation_code`, `created_date`, `get_invc_url_api`, `ge_rdm_url_api`, `user_id`) VALUES
(11, 'Dejavu', '//35.232.23.64/uploads/d732805e60b89101.PNG', '1', 'efssdf', '2018-06-26 14:16:09', NULL, NULL, 1),
(14, 'Testing', '//35.232.23.64/uploads/8699e50f5635029a.PNG', '1', 'dadfa', '2018-06-26 15:01:31', NULL, NULL, 1),
(15, 'ttgg', '//35.232.23.64/uploads/0836b435e6966a44.jpg', '1', 'ee', '2018-06-28 10:36:47', NULL, NULL, 1),
(16, 'Oxygen', '//35.232.23.64/uploads/11b5f0ded5d9c6b2.PNG', '1', 'das', '2018-06-28 14:39:03', NULL, NULL, 1),
(18, 'fdsgfdgh', '//35.232.23.64/uploads/c4182484d786ac60.jpg', '1', 'dfg', '2018-07-02 14:31:52', NULL, NULL, 1),
(19, 'Testing', '//35.232.23.64/uploads/39934d6b0b80b4d8.jpg', '1', 'lkj', '2018-07-02 14:33:37', NULL, NULL, 1),
(20, 'IMI', '//35.232.23.64/uploads/98eb209f07ddf803.jpg', '1', 'dadfa', '2018-07-02 14:36:44', NULL, NULL, 1),
(21, '3344', '//35.232.23.64/uploads/2d24f50831dbe969.jpg', '1', 'rhh', '2018-07-02 14:37:17', NULL, NULL, 1),
(22, 'IMI', '//35.232.23.64/uploads/87d130db257e18dc.jpg', '1', 'sdf', '2018-07-02 14:38:21', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lo_brand_stores`
--

CREATE TABLE `lo_brand_stores` (
  `store_no` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `store_code` varchar(50) NOT NULL,
  `store_name` varchar(30) NOT NULL,
  `store_loc_lat` double NOT NULL,
  `store_loc_lon` double NOT NULL,
  `active` varchar(3) NOT NULL,
  `store_region` varchar(25) NOT NULL,
  `store_addr1` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lo_brand_stores`
--

INSERT INTO `lo_brand_stores` (`store_no`, `brand_id`, `store_code`, `store_name`, `store_loc_lat`, `store_loc_lon`, `active`, `store_region`, `store_addr1`) VALUES
(2, 11, 'al3b', 'Cairo Festival', 30.519686585854092, 31.20566728030701, '1', 'Cario', '3 st el maadi'),
(4, 13, 'erf', 'Ataba', 30.045153, 31.22883, '1', 'Cario', '3 st el maadi 66666'),
(9, 11, 'erfe', 'Ataba', 25.89818593847728, 32.73065273656664, '1', 'Cario2', '3 st el maadi'),
(10, 11, 'erfew', 'Elmarg', 30.15604177800207, 31.360971500045707, '1', 'Elmarg', 'Elmarg'),
(11, 11, 'nader', 'nader', 31.27386126296606, 32.370218061556784, '1', 'dsa', 'dsa');

-- --------------------------------------------------------

--
-- Table structure for table `lo_setting`
--

CREATE TABLE `lo_setting` (
  `id` int(11) NOT NULL,
  `config_key` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `active` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lo_setting`
--

INSERT INTO `lo_setting` (`id`, `config_key`, `value`, `active`) VALUES
(2, 'show_limit_news', '123', '1'),
(3, 'ssaas', 'assa', '1'),
(4, 'as', 'sads', '0'),
(6, 'ssaasfs', 'as', '1'),
(8, 'afdvdfvsfd', 'fd', '1'),
(10, 'ssa', 'ef', '1'),
(11, 'sd', 'sa', '1');

-- --------------------------------------------------------

--
-- Table structure for table `lo_user_level`
--

CREATE TABLE `lo_user_level` (
  `level_id` int(11) NOT NULL,
  `g_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lo_user_level`
--

INSERT INTO `lo_user_level` (`level_id`, `g_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `lo_vouchers`
--

CREATE TABLE `lo_vouchers` (
  `vou_id` int(11) NOT NULL,
  `vou_code` varchar(30) NOT NULL,
  `vou_type` varchar(10) NOT NULL,
  `disc_per` double NOT NULL,
  `disc_value` double NOT NULL,
  `active_fdate` datetime NOT NULL,
  `active_tdate` datetime NOT NULL,
  `all_cust` int(3) NOT NULL,
  `forcust_phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lo_vouchers`
--

INSERT INTO `lo_vouchers` (`vou_id`, `vou_code`, `vou_type`, `disc_per`, `disc_value`, `active_fdate`, `active_tdate`, `all_cust`, `forcust_phone`) VALUES
(3, 'jhgjh 4', '0', 54, 43, '2018-06-11 00:00:00', '2018-07-23 00:00:00', 0, '01144054656'),
(4, 'Dejavu', '1', 12, 0, '2018-06-01 00:00:00', '2018-07-31 00:00:00', 0, '01150466243'),
(5, 'Dejavu Voucher', '1', 12, 333, '2018-09-01 00:00:00', '2019-04-30 00:00:00', 1, '00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand_news`
--
ALTER TABLE `brand_news`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `loyalty_customers`
--
ALTER TABLE `loyalty_customers`
  ADD PRIMARY KEY (`customer_phone`);

--
-- Indexes for table `loyalty_programs`
--
ALTER TABLE `loyalty_programs`
  ADD PRIMARY KEY (`brand_id`,`program_id`);

--
-- Indexes for table `lo_admin_users`
--
ALTER TABLE `lo_admin_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `lo_app_settings`
--
ALTER TABLE `lo_app_settings`
  ADD PRIMARY KEY (`brand_id`,`id`);

--
-- Indexes for table `lo_brands`
--
ALTER TABLE `lo_brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `lo_brand_stores`
--
ALTER TABLE `lo_brand_stores`
  ADD PRIMARY KEY (`store_no`);

--
-- Indexes for table `lo_setting`
--
ALTER TABLE `lo_setting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`config_key`);

--
-- Indexes for table `lo_user_level`
--
ALTER TABLE `lo_user_level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `lo_vouchers`
--
ALTER TABLE `lo_vouchers`
  ADD PRIMARY KEY (`vou_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand_news`
--
ALTER TABLE `brand_news`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `lo_admin_users`
--
ALTER TABLE `lo_admin_users`
  MODIFY `user_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `lo_brands`
--
ALTER TABLE `lo_brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `lo_brand_stores`
--
ALTER TABLE `lo_brand_stores`
  MODIFY `store_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `lo_setting`
--
ALTER TABLE `lo_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `lo_user_level`
--
ALTER TABLE `lo_user_level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lo_vouchers`
--
ALTER TABLE `lo_vouchers`
  MODIFY `vou_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
