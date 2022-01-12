<?php
$array_q = array();
if(!isset($rodb->prefix)){
	$rodb->prefix = 'ro_1_';
}

$array_q[] = "CREATE TABLE IF NOT EXISTS `user` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";


$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."buy` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."buy_products` (
  `id` int(11) NOT NULL,
  `buy_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `buy_price` double DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `sub_total` double DEFAULT NULL,
  `buy_date` datetime DEFAULT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_tc_id` int(11) NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

// $array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."city` (
//   `city_id` int(11) NOT NULL,
//   `city_name` varchar(100) NOT NULL,
//   `city_ct_id` int(11) NOT NULL,
//   `city_userid` int(11) NOT NULL,
//   `synced` int(11) NOT NULL
// ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."customers` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."customer_balance` (
  `cb_id` int(11) NOT NULL,
  `cb_userid` int(11) NOT NULL,
  `cb_customerid` int(11) NOT NULL,
  `cb_balance` double NOT NULL,
  `cb_date` datetime NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

// $array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."customer_type` (
//   `ct_id` int(11) NOT NULL,
//   `ct_name` varchar(100) NOT NULL,
//   `user_id` int(11) NOT NULL,
//   `dt` datetime NOT NULL,
//   `synced` int(11) NOT NULL
// ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."expenditure` (
  `id` int(11) NOT NULL,
  `description` varchar(250) CHARACTER SET latin1 NOT NULL,
  `total` double NOT NULL,
  `expenditure_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."expenditures` (
  `id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `description` varchar(500) NOT NULL,
  `userid` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."orders` (
  `id` int(11) NOT NULL,
  `test` int(11) NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."order_products` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."product` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."production` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `rtno` int(11) NOT NULL,
  `fileno` varchar(10) NOT NULL,
  `total` double NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."production_products` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `qty` double NOT NULL,
  `production_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."product_raw_formulae` (
  `id` int(11) NOT NULL,
  `raw_product_id` int(11) DEFAULT NULL,
  `fg_product_id` int(11) DEFAULT NULL,
  `raw_product_qty` double DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."product_stock` (
  `ps_id` int(11) NOT NULL,
  `ps_productid` int(11) NOT NULL,
  `ps_productname` varchar(100) NOT NULL,
  `ps_userid` int(11) NOT NULL,
  `ps_stock` double NOT NULL,
  `ps_date` datetime NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."sale` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."sale_products` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sale_price` double NOT NULL,
  `qty` double NOT NULL,
  `sale_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."sale_return` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."sale_return_products` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sale_price` double NOT NULL,
  `qty` double NOT NULL,
  `sale_return_id` int(11) NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

// $array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."top_category` (
//   `tc_id` int(11) NOT NULL,
//   `tc_name` varchar(100) NOT NULL,
//   `tc_user_id` int(11) NOT NULL,
//   `dt` datetime NOT NULL,
//   `synced` int(11) NOT NULL
// ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."transactions` (
  `transaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `payment` double NOT NULL,
  `desc` varchar(100) NOT NULL,
  `dt` datetime NOT NULL,
  `sale_id` int(11) NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "CREATE TABLE IF NOT EXISTS `". $rodb->prefix ."w_payment` (
  `id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."w_payment` ADD PRIMARY KEY(`id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."w_payment` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."buy`
  ADD PRIMARY KEY (`id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."buy_products`
  ADD PRIMARY KEY (`id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."category`
  ADD PRIMARY KEY (`cat_id`);";

// $array_q[] = "ALTER TABLE `". $rodb->prefix ."city`
//   ADD PRIMARY KEY (`city_id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."customers`
  ADD PRIMARY KEY (`customer_id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."customer_balance`
  ADD PRIMARY KEY (`cb_id`);";

// $array_q[] = "ALTER TABLE `". $rodb->prefix ."customer_type`
//   ADD PRIMARY KEY (`ct_id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."expenditure`
  ADD PRIMARY KEY (`id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."expenditures`
  ADD PRIMARY KEY (`id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."orders`
  ADD PRIMARY KEY (`id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."order_products`
  ADD PRIMARY KEY (`id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."product`
  ADD PRIMARY KEY (`productid`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."production`
  ADD PRIMARY KEY (`id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."production_products`
  ADD PRIMARY KEY (`id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."product_raw_formulae`
  ADD PRIMARY KEY (`id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."product_stock`
  ADD PRIMARY KEY (`ps_id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale`
  ADD PRIMARY KEY (`id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_products`
  ADD PRIMARY KEY (`id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_return`
  ADD PRIMARY KEY (`id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_return_products`
  ADD PRIMARY KEY (`id`);";

// $array_q[] = "ALTER TABLE `". $rodb->prefix ."top_category`
//   ADD PRIMARY KEY (`tc_id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."transactions`
  ADD PRIMARY KEY (`transaction_id`);";

$array_q[] = "ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."buy_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;";

// $array_q[] = "ALTER TABLE `". $rodb->prefix ."city`
//   MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."customer_balance`
  MODIFY `cb_id` int(11) NOT NULL AUTO_INCREMENT;";

// $array_q[] = "ALTER TABLE `". $rodb->prefix ."customer_type`
//   MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."expenditure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."expenditures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."production_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."product_raw_formulae`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."product_stock`
  MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_return_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";

// $array_q[] = "ALTER TABLE `". $rodb->prefix ."top_category`
//   MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;";

$array_q[] = "ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;";

$array_q[] = "ALTER TABLE `user` ADD `membership` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER `active` ;";

// $array_q[] = "update `user` set `membership` = '1'";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."order_products` CHANGE `qty` `qty` FLOAT( 11 ) NOT NULL ";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_products` CHANGE `qty` `qty` FLOAT( 11 ) NOT NULL ";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_return_products` CHANGE `qty` `qty` FLOAT( 11 ) NOT NULL ";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."production_products` CHANGE `qty` `qty` FLOAT( 11 ) NOT NULL ";

$array_q[] = "ALTER TABLE `user` ADD `footer` TEXT NOT NULL AFTER `print_header`; ";

$array_q[] = "ALTER TABLE `user` ADD `user_of` INT NOT NULL AFTER `licence`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale` ADD `worker_id` INT NOT NULL AFTER `userid`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."purchase` ADD `worker_id` INT NOT NULL AFTER `userid`;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_return` ADD `worker_id` INT NOT NULL AFTER `userid`;"; 
$array_q[] = "ALTER TABLE `". $rodb->prefix ."transactions` ADD `worker_id` INT NOT NULL AFTER `user_id`;"; 
$array_q[] = "ALTER TABLE `". $rodb->prefix ."expenditure` ADD `user_id` INT NOT NULL AFTER `expenditure_date`, ADD `worker_id` INT NOT NULL AFTER `user_id`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."expenditures` ADD `worker_id` INT NOT NULL AFTER `userid`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."production` ADD `worker_id` INT NOT NULL AFTER `userid`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale` ADD `status` INT NOT NULL AFTER `gTotal`; ";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."transactions` ADD `sale_id` INT NOT NULL AFTER `dt`; ";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."buy` ADD `type` INT NOT NULL AFTER `buy_date`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale` ADD `is_gatepass` INT NOT NULL AFTER `status`;";


$array_q[] = "ALTER TABLE `". $rodb->prefix ."buy` ADD `synced` INT NOT NULL AFTER `type`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."buy_products` ADD `synced` INT NOT NULL AFTER `buy_date`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."category` ADD `synced` INT NOT NULL AFTER `cat_tc_id`;";
// $array_q[] = "ALTER TABLE `". $rodb->prefix ."city` ADD `synced` INT NOT NULL AFTER `city_userid`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."customers` ADD `synced` INT NOT NULL AFTER `dt`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."customer_balance` ADD `synced` INT NOT NULL AFTER `cb_date`;";
// $array_q[] = "ALTER TABLE `". $rodb->prefix ."customer_type` ADD `synced` INT NOT NULL AFTER `dt`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."expenditure` ADD `synced` INT NOT NULL AFTER `worker_id`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."expenditures` ADD `synced` INT NOT NULL AFTER `dt`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."orders` ADD `synced` INT NOT NULL AFTER `test`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."order_products` ADD `synced` INT NOT NULL AFTER `grit_number`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."production` ADD `synced` INT NOT NULL AFTER `total`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."production_products` ADD `synced` INT NOT NULL AFTER `dt`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."product_raw_formulae` ADD `synced` INT NOT NULL AFTER `user_id`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."product_stock` ADD `synced` INT NOT NULL AFTER `ps_date`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."purchase` ADD `synced` INT NOT NULL AFTER `dateofpurchase`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale` ADD `synced` INT NOT NULL AFTER `is_gatepass`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_products` ADD `synced` INT NOT NULL AFTER `userid`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_return` ADD `synced` INT NOT NULL AFTER `gTotal`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_return_products` ADD `synced` INT NOT NULL AFTER `sale_return_id`;";
// $array_q[] = "ALTER TABLE `". $rodb->prefix ."top_category` ADD `synced` INT NOT NULL AFTER `dt`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."transactions` ADD `synced` INT NOT NULL AFTER `sale_id`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale` ADD `order_type` VARCHAR(100) NOT NULL AFTER `is_gatepass`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale` ADD `payment_type` VARCHAR(250) NOT NULL AFTER `order_type`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale` ADD `is_paid` TINYINT NOT NULL AFTER `synced`, ADD `kot_1` TINYINT NOT NULL AFTER `is_paid`, ADD `kot_2` TINYINT NOT NULL AFTER `kot_1`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale` ADD `is_edited` INT NOT NULL AFTER `kot_2`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."buy` ADD `is_edited` INT NOT NULL AFTER `synced`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale` CHANGE `fileno` `fileno` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;";
$array_q[] = "ALTER TABLE `user` ADD `menu` TEXT NOT NULL AFTER `user_of`;";
$array_q[] = "ALTER TABLE `user` ADD `type` VARCHAR(250) NOT NULL AFTER `menu`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."production_products` ADD `price` DOUBLE NOT NULL AFTER `qty`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."product` ADD `sale_discount_percent` FLOAT NOT NULL AFTER `sale_price`, ADD `sale_discount` FLOAT NOT NULL AFTER `sale_discount_percent`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_products` ADD `sale_discount` FLOAT NOT NULL AFTER `sale_price`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_products` ADD `qty_packs` FLOAT NOT NULL AFTER `qty`;";
$array_q[] = "ALTER TABLE `". $rodb->prefix ."buy_products` ADD `qty_packs` FLOAT NOT NULL AFTER `quantity`;";
$array_q[] = "RENAME TABLE `ya`.`". $rodb->prefix ."worker_payment` TO `ya`.`". $rodb->prefix ."w_payment`;";

$array_q[] = "CREATE TABLE `". $rodb->prefix ."reminders` (
  `id` int(11) NOT NULL,
  `set_dt` datetime NOT NULL,
  `description` varchar(500) NOT NULL,
  `userid` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `synced` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."reminders`
  ADD PRIMARY KEY (`id`);";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";

$array_q[] = "
ALTER TABLE `user` ADD `flag_outstanding_balance` TINYINT NOT NULL AFTER `user_of`;";

$array_q[] = "
ALTER TABLE `user` ADD `registration_code` VARCHAR(100) NOT NULL AFTER `activation_key`;";

$array_q[] = "CREATE TABLE `". $rodb->prefix ."item` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$array_q[] = "ALTER TABLE `". $rodb->prefix ."item` ADD PRIMARY KEY(`id`);";
  
$array_q[] = "ALTER TABLE `". $rodb->prefix ."item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;";

$array_q[] = "CREATE TABLE `". $rodb->prefix ."unit` (
    `id` bigint(20) NOT NULL,
    `name` text NOT NULL,
    `qty` double NOT NULL,
    `user_id` bigint(20) NOT NULL,
    `status` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
  
  $array_q[] = "ALTER TABLE `". $rodb->prefix ."unit`
    ADD PRIMARY KEY (`id`);";
  
  $array_q[] = "ALTER TABLE `". $rodb->prefix ."unit`
    MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."product` ADD `image` TEXT NOT NULL AFTER `comments`;";

  $array_q[] = "ALTER TABLE `user` ADD `show_barcode` TINYINT NOT NULL AFTER `licence`;";

  $array_q[] = "ALTER TABLE `user` ADD `flag_packs_quantity` TINYINT NOT NULL AFTER `show_barcode`;";
  $array_q[] = "ALTER TABLE `user` ADD `product_discount_flag` TINYINT NOT NULL AFTER `flag_packs_quantity`;";

  $array_q[] = "CREATE TABLE `usermeta` (
    `id` bigint(20) NOT NULL,
    `user_id` bigint(20) NOT NULL,
    `meta_key` text NOT NULL,
    `meta_value` text NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
  
  $array_q[] = "ALTER TABLE `usermeta`
    ADD PRIMARY KEY (`id`);";

  $array_q[] = "ALTER TABLE `usermeta`
    MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;";
  
  $array_q[] = "ALTER TABLE `". $rodb->prefix ."product` ADD `synced` INT NOT NULL AFTER `admin_auth_show_on_web`;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."product` ADD `enabled` TINYINT NOT NULL DEFAULT '1' AFTER `synced`;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."sale` CHANGE `userid` `userid` INT(11) NULL, CHANGE `worker_id` `worker_id` INT(11) NULL, CHANGE `customerid` `customerid` INT(11) NULL, CHANGE `dt` `dt` DATETIME NULL, CHANGE `rtno` `rtno` INT(11) NULL, CHANGE `fileno` `fileno` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `total` `total` DOUBLE NULL, CHANGE `gst` `gst` TINYINT(4) NULL DEFAULT '0', CHANGE `extrachargesdesc` `extrachargesdesc` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `extracharges` `extracharges` DOUBLE NULL, CHANGE `discount_desc` `discount_desc` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `discountinpercent` `discountinpercent` TINYINT(4) NULL, CHANGE `discount` `discount` DOUBLE NULL, CHANGE `gTotal` `gTotal` DOUBLE NULL, CHANGE `status` `status` INT(11) NULL, CHANGE `is_gatepass` `is_gatepass` INT(11) NULL, CHANGE `order_type` `order_type` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `payment_type` `payment_type` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `synced` `synced` INT(11) NULL, CHANGE `is_paid` `is_paid` TINYINT(4) NULL, CHANGE `kot_1` `kot_1` TINYINT(4) NULL, CHANGE `kot_2` `kot_2` TINYINT(4) NULL, CHANGE `is_edited` `is_edited` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."buy` CHANGE `customer` `customer` INT(11) NULL, CHANGE `fileno` `fileno` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `gst` `gst` DOUBLE NULL, CHANGE `discount_percent_check` `discount_percent_check` TINYINT(1) NULL DEFAULT '0', CHANGE `discount_amount` `discount_amount` DOUBLE NULL, CHANGE `extra_charges_desc` `extra_charges_desc` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `extra_charges_amount` `extra_charges_amount` DOUBLE NULL, CHANGE `type` `type` INT(11) NULL, CHANGE `synced` `synced` INT(11) NULL, CHANGE `is_edited` `is_edited` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."buy_products` CHANGE `qty_packs` `qty_packs` FLOAT NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."category` CHANGE `cat_name` `cat_name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `user_id` `user_id` INT(11) NULL, CHANGE `cat_tc_id` `cat_tc_id` INT(11) NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."customers` CHANGE `customer_name` `customer_name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `customer_address` `customer_address` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `customer_phone` `customer_phone` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `contact_person` `contact_person` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `fileno` `fileno` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `opening_balance` `opening_balance` DOUBLE NULL, CHANGE `current_balance` `current_balance` DOUBLE NULL, CHANGE `customer_city_id` `customer_city_id` INT(11) NULL, CHANGE `ct_id` `ct_id` INT(11) NULL, CHANGE `user_id` `user_id` INT(11) NULL, CHANGE `dt` `dt` DATETIME NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."customer_balance` CHANGE `cb_userid` `cb_userid` INT(11) NULL, CHANGE `cb_customerid` `cb_customerid` INT(11) NULL, CHANGE `cb_balance` `cb_balance` DOUBLE NULL, CHANGE `cb_date` `cb_date` DATETIME NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."expenditure` CHANGE `description` `description` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `total` `total` DOUBLE NULL, CHANGE `expenditure_date` `expenditure_date` DATETIME NULL, CHANGE `user_id` `user_id` INT(11) NULL, CHANGE `worker_id` `worker_id` INT(11) NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."expenditures` CHANGE `amount` `amount` DOUBLE NULL, CHANGE `description` `description` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `userid` `userid` INT(11) NULL, CHANGE `worker_id` `worker_id` INT(11) NULL, CHANGE `dt` `dt` DATETIME NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."item` CHANGE `name` `name` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `user_id` `user_id` BIGINT(20) NULL, CHANGE `status` `status` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."orders` CHANGE `test` `test` INT(11) NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."order_products` CHANGE `productid` `productid` INT(11) NULL, CHANGE `productname` `productname` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `cat_id` `cat_id` INT(11) NULL, CHANGE `sale_price` `sale_price` DOUBLE NULL, CHANGE `qty` `qty` FLOAT NULL, CHANGE `order_id` `order_id` INT(11) NULL, CHANGE `userid` `userid` INT(11) NULL, CHANGE `grit_number` `grit_number` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."product` CHANGE `userid` `userid` INT(11) NULL, CHANGE `cat_id` `cat_id` INT(11) NULL, CHANGE `productname` `productname` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `productcode` `productcode` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `grit_number` `grit_number` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `stock` `stock` DOUBLE NULL, CHANGE `opening_stock` `opening_stock` DOUBLE NULL, CHANGE `unit` `unit` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `purchase_price` `purchase_price` DOUBLE NULL, CHANGE `comments` `comments` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `image` `image` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `sale_price` `sale_price` DOUBLE NULL, CHANGE `sale_discount_percent` `sale_discount_percent` FLOAT NULL, CHANGE `sale_discount` `sale_discount` FLOAT NULL, CHANGE `sequence` `sequence` INT(11) NULL, CHANGE `show_on_web` `show_on_web` TINYINT(4) NULL, CHANGE `admin_auth_show_on_web` `admin_auth_show_on_web` TINYINT(4) NULL, CHANGE `synced` `synced` INT(11) NULL, CHANGE `enabled` `enabled` TINYINT(4) NULL DEFAULT '1';";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."production` CHANGE `userid` `userid` INT(11) NULL, CHANGE `worker_id` `worker_id` INT(11) NULL, CHANGE `dt` `dt` DATETIME NULL, CHANGE `rtno` `rtno` INT(11) NULL, CHANGE `fileno` `fileno` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `total` `total` DOUBLE NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."production_products` CHANGE `productid` `productid` INT(11) NULL, CHANGE `productname` `productname` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `cat_id` `cat_id` INT(11) NULL, CHANGE `qty` `qty` FLOAT NULL, CHANGE `price` `price` DOUBLE NULL, CHANGE `production_id` `production_id` INT(11) NULL, CHANGE `userid` `userid` INT(11) NULL, CHANGE `dt` `dt` DATETIME NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."product_raw_formulae` CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."product_stock` CHANGE `ps_productid` `ps_productid` INT(11) NULL, CHANGE `ps_productname` `ps_productname` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `ps_userid` `ps_userid` INT(11) NULL, CHANGE `ps_stock` `ps_stock` DOUBLE NULL, CHANGE `ps_date` `ps_date` DATETIME NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."reminders` CHANGE `set_dt` `set_dt` DATETIME NULL, CHANGE `description` `description` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `userid` `userid` INT(11) NULL, CHANGE `worker_id` `worker_id` INT(11) NULL, CHANGE `dt` `dt` DATETIME NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_products` CHANGE `productid` `productid` INT(11) NULL, CHANGE `productname` `productname` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `cat_id` `cat_id` INT(11) NULL, CHANGE `sale_price` `sale_price` DOUBLE NULL, CHANGE `sale_discount` `sale_discount` FLOAT NULL, CHANGE `qty` `qty` FLOAT NULL, CHANGE `qty_packs` `qty_packs` FLOAT NULL, CHANGE `sale_id` `sale_id` INT(11) NULL, CHANGE `userid` `userid` INT(11) NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_return` CHANGE `userid` `userid` INT(11) NULL, CHANGE `worker_id` `worker_id` INT(11) NULL, CHANGE `customerid` `customerid` INT(11) NULL, CHANGE `dt` `dt` DATETIME NULL, CHANGE `returnno` `returnno` INT(11) NULL, CHANGE `rtno` `rtno` INT(11) NULL, CHANGE `fileno` `fileno` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `total` `total` DOUBLE NULL, CHANGE `gst` `gst` TINYINT(4) NULL DEFAULT '0', CHANGE `extrachargesdesc` `extrachargesdesc` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `extracharges` `extracharges` DOUBLE NULL, CHANGE `discountinpercent` `discountinpercent` TINYINT(4) NULL, CHANGE `discount` `discount` DOUBLE NULL, CHANGE `gTotal` `gTotal` DOUBLE NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."sale_return_products` CHANGE `productid` `productid` INT(11) NULL, CHANGE `productname` `productname` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `cat_id` `cat_id` INT(11) NULL, CHANGE `sale_price` `sale_price` DOUBLE NULL, CHANGE `qty` `qty` FLOAT NULL, CHANGE `sale_return_id` `sale_return_id` INT(11) NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."transactions` CHANGE `customer_id` `customer_id` INT(11) NULL, CHANGE `user_id` `user_id` INT(11) NULL, CHANGE `worker_id` `worker_id` INT(11) NULL, CHANGE `payment` `payment` DOUBLE NULL, CHANGE `desc` `desc` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `dt` `dt` DATETIME NULL, CHANGE `sale_id` `sale_id` INT(11) NULL, CHANGE `synced` `synced` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."unit` CHANGE `name` `name` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `qty` `qty` DOUBLE NULL, CHANGE `user_id` `user_id` BIGINT(20) NULL, CHANGE `status` `status` INT(11) NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."w_payment` CHANGE `worker_id` `worker_id` INT(11) NULL, CHANGE `amount` `amount` DOUBLE NULL, CHANGE `dt` `dt` DATETIME NULL;";

  $array_q[] = "ALTER TABLE `user` CHANGE `uid` `uid` INT(11) NOT NULL AUTO_INCREMENT, CHANGE `password` `password` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `company_name` `company_name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `address` `address` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `phone` `phone` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `saletax` `saletax` DOUBLE NULL, CHANGE `reg_date` `reg_date` DATETIME NULL, CHANGE `active` `active` TINYINT(4) NULL DEFAULT '0', CHANGE `_login_token` `_login_token` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `membership` `membership` TINYINT(1) NULL DEFAULT '0', CHANGE `activation_key` `activation_key` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `registration_code` `registration_code` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `production` `production` TINYINT(4) NULL DEFAULT '0', CHANGE `p_and_l` `p_and_l` TINYINT(4) NULL DEFAULT '0', CHANGE `exp_date` `exp_date` DATETIME NULL, CHANGE `print_header` `print_header` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `footer` `footer` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `lang` `lang` TINYINT(4) NULL, CHANGE `product_label1` `product_label1` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `product_label2` `product_label2` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `product_label3` `product_label3` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `customer_label1` `customer_label1` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `customer_label2` `customer_label2` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `customer_label3` `customer_label3` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `discount` `discount` DOUBLE NULL, CHANGE `licence` `licence` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `show_barcode` `show_barcode` TINYINT(4) NULL, CHANGE `flag_packs_quantity` `flag_packs_quantity` TINYINT(4) NULL, CHANGE `product_discount_flag` `product_discount_flag` TINYINT(4) NULL, CHANGE `user_of` `user_of` INT(11) NULL, CHANGE `flag_outstanding_balance` `flag_outstanding_balance` TINYINT(4) NULL, CHANGE `menu` `menu` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `type` `type` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;";

  $array_q[] = "ALTER TABLE `usermeta` CHANGE `user_id` `user_id` BIGINT(20) NULL, CHANGE `meta_key` `meta_key` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `meta_value` `meta_value` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."sale` CHANGE `is_gatepass` `is_gatepass` INT(11) NOT NULL DEFAULT '0';";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."buy` CHANGE `gst` `gst` DOUBLE NOT NULL DEFAULT '0';";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."product` CHANGE `sale_price` `sale_price` DOUBLE NOT NULL DEFAULT '0';";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."product` CHANGE `sale_price` `sale_price` DOUBLE NOT NULL;";

  $array_q[] = "ALTER TABLE `". $rodb->prefix ."buy` CHANGE `customer` `customer` INT(11) NOT NULL;";
  
  $array_q[] = "ALTER TABLE `". $rodb->prefix ."buy` CHANGE `customer` `customer` INT(11) NOT NULL DEFAULT '0';
  ";
  $array_q[] = "ALTER TABLE `". $rodb->prefix ."buy` CHANGE `customer` `customer` VARCHAR(11) NULL DEFAULT NULL;
  ";
  $array_q[] = "ALTER TABLE `". $rodb->prefix ."product` CHANGE `sale_discount_percent` `sale_discount_percent` FLOAT NULL DEFAULT '0';
  ";
  $array_q[] = "";

  foreach($array_q as $q){
    $result = $rodb->Execute($q);
    if(isset($result[0])){
      echo '<br /><br />'.$q.' <br />'.$result[0];
    }
  }

// include "products_merger.php";
// include "customers_merger.php";