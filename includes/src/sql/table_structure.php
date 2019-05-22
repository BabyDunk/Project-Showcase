<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 19/02/2019
	 * Time: 02:17
	 */
	
	$sqlQueries = [];
	
	$sqlQueries[] = "CREATE TABLE `{$DB_PREFIX}carts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cart` text NOT NULL,
  `transaction_amount` float NOT NULL,
  `currency` varchar(5) NOT NULL,
  `transaction_data` text NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `promo_code` varchar(100) DEFAULT NULL,
  `valid_email` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET={$DB_CHARSET};";
	
	
	$sqlQueries[] = "CREATE TABLE `{$DB_PREFIX}comments` (
`id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `body` mediumtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET={$DB_CHARSET};";
	
	
	$sqlQueries[] = "CREATE TABLE `{$DB_PREFIX}contacted` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `email` mediumtext NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` mediumtext NOT NULL,
  `date_est` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET={$DB_CHARSET};";
	
	$sqlQueries[] ="CREATE TABLE `{$DB_PREFIX}logging` (
`id` int(11) NOT NULL,
  `logs` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET={$DB_CHARSET};";
	
	
	$sqlQueries[] = "CREATE TABLE `{$DB_PREFIX}preference` (
`pref_section` varchar(100) NOT NULL,
  `pref_key` varchar(100) NOT NULL,
  `pref_value` longtext NOT NULL,
  `pref_type` enum('STRING','INTEGER','BOOLEAN') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET={$DB_CHARSET};";
	
	
	
	$sqlQueries[] = "CREATE TABLE `{$DB_PREFIX}promotions` (
  `id` int(11) NOT NULL,
  `promo_code` varchar(100) NOT NULL,
  `value` int(11) NOT NULL,
  `conversion` int(11) NOT NULL ,
  `valid` tinyint(1) NOT NULL,
  `valid_email` varchar(100) DEFAULT NULL,
  `valid_for_items` text DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET={$DB_CHARSET};";
	
	
	$sqlQueries[] = "CREATE TABLE `{$DB_PREFIX}showcasepins` (
`id` int(11) NOT NULL,
  `show_id` varchar(255) NOT NULL,
  `show_title` varchar(255) NOT NULL,
  `show_body` mediumtext NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET={$DB_CHARSET};";
	
	
	$sqlQueries[] = "CREATE TABLE `{$DB_PREFIX}showcases` (
`id` int(11) NOT NULL,
  `show_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description1` mediumtext,
  `showcasePayment` varchar(255) NOT NULL,
  `three_notice_block` mediumtext NOT NULL,
  `fg_colorselector` varchar(40) DEFAULT NULL,
  `bg_colorselector` varchar(40) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `job_deposit` int(11) DEFAULT NULL,
  `job_duration` int(11) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `front_demo_link` varchar(255) NOT NULL,
  `back_demo_link` varchar(255) NOT NULL,
  `back_demo_user` varchar(255) NOT NULL,
  `back_demo_pass` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET={$DB_CHARSET};";
	
	
	$sqlQueries[] = "CREATE TABLE `{$DB_PREFIX}showcase_images` (
`id` int(11) NOT NULL,
  `show_id` varchar(255) NOT NULL,
  `show_img_name` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET={$DB_CHARSET};";
	
	
	$sqlQueries[] = "CREATE TABLE `{$DB_PREFIX}users` (
`id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `filename` varchar(255) CHARACTER SET utf8 NOT NULL,
  `privilege` int(11) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET={$DB_CHARSET};";
	
	
	$sqlQueries[] = "CREATE TABLE `{$DB_PREFIX}visitors` (
`id` int(11) NOT NULL,
  `visitors_ip` int(10) NOT NULL,
  `visitors_host` varchar(255) CHARACTER SET utf8 NOT NULL,
  `visitors_agent` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `visited_page_id` int(11) NOT NULL,
  `visited_page_title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `visited_page_author` int(11) DEFAULT NULL,
  `visitors_sess` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET={$DB_CHARSET};";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}carts`
  ADD PRIMARY KEY (`id`);";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}comments`
  ADD PRIMARY KEY (`id`);";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}contacted`
  ADD PRIMARY KEY (`id`);";
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}logging`
  ADD PRIMARY KEY (`id`);";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}preference`
  ADD UNIQUE KEY `pref_section` (`pref_section`,`pref_key`);";
	
		
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}promotions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promo_code` (`promo_code`);";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}showcasepins`
  ADD PRIMARY KEY (`id`);";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}showcases`
  ADD PRIMARY KEY (`id`);";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}showcase_images`
  ADD PRIMARY KEY (`id`);";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}visitors`
  ADD PRIMARY KEY (`id`);";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}contacted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}logging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}showcasepins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}showcases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}showcase_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
	
	
	$sqlQueries[] = "ALTER TABLE `{$DB_PREFIX}visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";


