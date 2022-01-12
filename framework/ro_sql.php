-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 14, 2018 at 09:15 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ya`
--

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_buy`
--

CREATE TABLE `ro_0_buy` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `customer` int(11) NOT NULL,
  `fileno` varchar(100) NOT NULL,
  `gst` double NOT NULL,
  `discount_percent_check` tinyint(1) NOT NULL DEFAULT '0',
  `discount_amount` double NOT NULL,
  `extra_charges_desc` varchar(100) NOT NULL,
  `extra_charges_amount` double NOT NULL,
  `buy_date` datetime DEFAULT NULL,
  `type` int(11) NOT NULL,
  `synced` int(11) NOT NULL,
  `is_edited` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_buy_products`
--

CREATE TABLE `ro_0_buy_products` (
  `id` int(11) NOT NULL,
  `buy_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `buy_price` double DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `sub_total` double DEFAULT NULL,
  `buy_date` datetime DEFAULT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_category`
--

CREATE TABLE `ro_0_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_tc_id` int(11) NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_city`
--

CREATE TABLE `ro_0_city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `city_ct_id` int(11) NOT NULL,
  `city_userid` int(11) NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_customers`
--

CREATE TABLE `ro_0_customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `customer_phone` varchar(30) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `fileno` varchar(25) NOT NULL,
  `opening_balance` double NOT NULL,
  `current_balance` double NOT NULL,
  `customer_city_id` int(11) NOT NULL,
  `ct_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_customer_balance`
--

CREATE TABLE `ro_0_customer_balance` (
  `cb_id` int(11) NOT NULL,
  `cb_userid` int(11) NOT NULL,
  `cb_customerid` int(11) NOT NULL,
  `cb_balance` double NOT NULL,
  `cb_date` datetime NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_customer_type`
--

CREATE TABLE `ro_0_customer_type` (
  `ct_id` int(11) NOT NULL,
  `ct_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_expenditure`
--

CREATE TABLE `ro_0_expenditure` (
  `id` int(11) NOT NULL,
  `description` varchar(250) CHARACTER SET latin1 NOT NULL,
  `total` double NOT NULL,
  `expenditure_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_expenditures`
--

CREATE TABLE `ro_0_expenditures` (
  `id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `description` varchar(500) NOT NULL,
  `userid` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_orders`
--

CREATE TABLE `ro_0_orders` (
  `id` int(11) NOT NULL,
  `test` int(11) NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_order_products`
--

CREATE TABLE `ro_0_order_products` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sale_price` double NOT NULL,
  `qty` double NOT NULL,
  `order_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `grit_number` varchar(250) NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_product`
--

CREATE TABLE `ro_0_product` (
  `productid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `productname` varchar(250) NOT NULL,
  `productcode` varchar(200) NOT NULL,
  `grit_number` varchar(250) NOT NULL,
  `stock` double NOT NULL,
  `opening_stock` double NOT NULL,
  `unit` varchar(20) NOT NULL,
  `purchase_price` double NOT NULL,
  `comments` varchar(500) NOT NULL,
  `sale_price` double NOT NULL,
  `sequence` int(11) NOT NULL,
  `show_on_web` tinyint(4) NOT NULL,
  `admin_auth_show_on_web` tinyint(4) NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_production`
--

CREATE TABLE `ro_0_production` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `rtno` int(11) NOT NULL,
  `fileno` varchar(10) NOT NULL,
  `total` double NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_production_products`
--

CREATE TABLE `ro_0_production_products` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `qty` double NOT NULL,
  `production_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_product_raw_formulae`
--

CREATE TABLE `ro_0_product_raw_formulae` (
  `id` int(11) NOT NULL,
  `raw_product_id` int(11) DEFAULT NULL,
  `fg_product_id` int(11) DEFAULT NULL,
  `raw_product_qty` double DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_product_stock`
--

CREATE TABLE `ro_0_product_stock` (
  `ps_id` int(11) NOT NULL,
  `ps_productid` int(11) NOT NULL,
  `ps_productname` varchar(100) NOT NULL,
  `ps_userid` int(11) NOT NULL,
  `ps_stock` double NOT NULL,
  `ps_date` datetime NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_sale`
--

CREATE TABLE `ro_0_sale` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `rtno` int(11) NOT NULL,
  `fileno` varchar(1000) NOT NULL,
  `total` double NOT NULL,
  `gst` tinyint(4) NOT NULL DEFAULT '0',
  `extrachargesdesc` varchar(100) NOT NULL,
  `extracharges` double NOT NULL,
  `discount_desc` varchar(255) NOT NULL,
  `discountinpercent` tinyint(4) NOT NULL,
  `discount` double NOT NULL,
  `gTotal` double NOT NULL,
  `status` int(11) NOT NULL,
  `is_gatepass` int(11) NOT NULL,
  `order_type` varchar(100) NOT NULL,
  `payment_type` varchar(250) NOT NULL,
  `synced` int(11) NOT NULL,
  `is_paid` tinyint(4) NOT NULL,
  `kot_1` tinyint(4) NOT NULL,
  `kot_2` tinyint(4) NOT NULL,
  `is_edited` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_sale_products`
--

CREATE TABLE `ro_0_sale_products` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sale_price` double NOT NULL,
  `qty` double NOT NULL,
  `sale_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_sale_return`
--

CREATE TABLE `ro_0_sale_return` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `returnno` int(11) NOT NULL,
  `rtno` int(11) NOT NULL,
  `fileno` varchar(10) NOT NULL,
  `total` double NOT NULL,
  `gst` tinyint(4) NOT NULL DEFAULT '0',
  `extrachargesdesc` varchar(100) NOT NULL,
  `extracharges` double NOT NULL,
  `discountinpercent` tinyint(4) NOT NULL,
  `discount` double NOT NULL,
  `gTotal` double NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_sale_return_products`
--

CREATE TABLE `ro_0_sale_return_products` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sale_price` double NOT NULL,
  `qty` double NOT NULL,
  `sale_return_id` int(11) NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_top_category`
--

CREATE TABLE `ro_0_top_category` (
  `tc_id` int(11) NOT NULL,
  `tc_name` varchar(100) NOT NULL,
  `tc_user_id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_transactions`
--

CREATE TABLE `ro_0_transactions` (
  `transaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `payment` double NOT NULL,
  `desc` varchar(100) NOT NULL,
  `dt` datetime NOT NULL,
  `sale_id` int(11) NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ro_0_w_payment`
--

CREATE TABLE `ro_0_w_payment` (
  `id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `saletax` double NOT NULL,
  `reg_date` datetime NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `_login_token` varchar(200) NOT NULL,
  `membership` tinyint(1) NOT NULL DEFAULT '0',
  `activation_key` varchar(50) NOT NULL,
  `production` tinyint(4) NOT NULL DEFAULT '0',
  `p_and_l` tinyint(4) NOT NULL DEFAULT '0',
  `exp_date` datetime NOT NULL,
  `print_header` text NOT NULL,
  `footer` text NOT NULL,
  `lang` tinyint(4) NOT NULL,
  `product_label1` varchar(50) NOT NULL,
  `product_label2` varchar(50) NOT NULL,
  `product_label3` varchar(50) NOT NULL,
  `customer_label1` varchar(50) NOT NULL,
  `customer_label2` varchar(50) NOT NULL,
  `customer_label3` varchar(50) NOT NULL,
  `discount` double NOT NULL,
  `licence` varchar(250) NOT NULL,
  `user_of` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `company_name`, `email`, `address`, `phone`, `saletax`, `reg_date`, `active`, `_login_token`, `membership`, `activation_key`, `production`, `p_and_l`, `exp_date`, `print_header`, `footer`, `lang`, `product_label1`, `product_label2`, `product_label3`, `customer_label1`, `customer_label2`, `customer_label3`, `discount`, `licence`, `user_of`) VALUES
(1, 'youaccounts', 'youaccounts', '', '', '', '', 16, '0000-00-00 00:00:00', 1, '', 0, '', 0, 0, '0000-00-00 00:00:00', '<table>\r\n<tr>\r\n<td colspan="2"><img src="toolsales/header.jpg" /></td>\r\n</tr>\r\n<tr>\r\n<td><img src="toolsales/sidebar.jpg" /></td>\r\n<td valign="top">', '</td></tr></table>', 0, 'DESCRIPTION', 'GRIT', 'SIZE', '', '', '', 0, 'VFdwQmVFOURNSGhOYVRCNlRWRTlQUT09', 0),
(2, 'sajid', 'sajid', '', '', '', '', 16, '0000-00-00 00:00:00', 1, '', 0, '', 0, 0, '0000-00-00 00:00:00', '<table>\r\n<tr>\r\n<td colspan="2"><img src="toolsales/header.jpg" /></td>\r\n</tr>\r\n<tr>\r\n<td><img src="toolsales/sidebar.jpg" /></td>\r\n<td valign="top">', '</td></tr></table>', 0, 'DESCRIPTION', 'GRIT', 'SIZE', '', '', '', 0, 'VFdwQmVFOURNSGhOYVRCNlRWRTlQUT09', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ro_0_buy`
--
ALTER TABLE `ro_0_buy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ro_0_buy_products`
--
ALTER TABLE `ro_0_buy_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ro_0_category`
--
ALTER TABLE `ro_0_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `ro_0_city`
--
ALTER TABLE `ro_0_city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `ro_0_customers`
--
ALTER TABLE `ro_0_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `ro_0_customer_balance`
--
ALTER TABLE `ro_0_customer_balance`
  ADD PRIMARY KEY (`cb_id`);

--
-- Indexes for table `ro_0_customer_type`
--
ALTER TABLE `ro_0_customer_type`
  ADD PRIMARY KEY (`ct_id`);

--
-- Indexes for table `ro_0_expenditure`
--
ALTER TABLE `ro_0_expenditure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ro_0_expenditures`
--
ALTER TABLE `ro_0_expenditures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ro_0_orders`
--
ALTER TABLE `ro_0_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ro_0_order_products`
--
ALTER TABLE `ro_0_order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ro_0_product`
--
ALTER TABLE `ro_0_product`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `ro_0_production`
--
ALTER TABLE `ro_0_production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ro_0_production_products`
--
ALTER TABLE `ro_0_production_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ro_0_product_raw_formulae`
--
ALTER TABLE `ro_0_product_raw_formulae`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ro_0_product_stock`
--
ALTER TABLE `ro_0_product_stock`
  ADD PRIMARY KEY (`ps_id`);

--
-- Indexes for table `ro_0_sale`
--
ALTER TABLE `ro_0_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ro_0_sale_products`
--
ALTER TABLE `ro_0_sale_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ro_0_sale_return`
--
ALTER TABLE `ro_0_sale_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ro_0_sale_return_products`
--
ALTER TABLE `ro_0_sale_return_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ro_0_top_category`
--
ALTER TABLE `ro_0_top_category`
  ADD PRIMARY KEY (`tc_id`);

--
-- Indexes for table `ro_0_transactions`
--
ALTER TABLE `ro_0_transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ro_0_buy`
--
ALTER TABLE `ro_0_buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_buy_products`
--
ALTER TABLE `ro_0_buy_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_category`
--
ALTER TABLE `ro_0_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_city`
--
ALTER TABLE `ro_0_city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_customers`
--
ALTER TABLE `ro_0_customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_customer_balance`
--
ALTER TABLE `ro_0_customer_balance`
  MODIFY `cb_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_customer_type`
--
ALTER TABLE `ro_0_customer_type`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_expenditure`
--
ALTER TABLE `ro_0_expenditure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_expenditures`
--
ALTER TABLE `ro_0_expenditures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_orders`
--
ALTER TABLE `ro_0_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_order_products`
--
ALTER TABLE `ro_0_order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_product`
--
ALTER TABLE `ro_0_product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_production`
--
ALTER TABLE `ro_0_production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_production_products`
--
ALTER TABLE `ro_0_production_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_product_raw_formulae`
--
ALTER TABLE `ro_0_product_raw_formulae`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_product_stock`
--
ALTER TABLE `ro_0_product_stock`
  MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_sale`
--
ALTER TABLE `ro_0_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_sale_products`
--
ALTER TABLE `ro_0_sale_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_sale_return`
--
ALTER TABLE `ro_0_sale_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_sale_return_products`
--
ALTER TABLE `ro_0_sale_return_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_top_category`
--
ALTER TABLE `ro_0_top_category`
  MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ro_0_transactions`
--
ALTER TABLE `ro_0_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
  <?php echo '';?>