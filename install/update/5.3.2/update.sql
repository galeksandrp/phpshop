ALTER TABLE `phpshop_categories` ADD `sort_cache` blob;
ALTER TABLE `phpshop_categories` ADD `sort_cache_created_at` int(11);
ALTER TABLE `phpshop_servers` ADD `currency` int(11);
ALTER TABLE `phpshop_servers` ADD `lang` varchar(32);
ALTER TABLE `phpshop_news` ADD `odnotip` text;
ALTER TABLE `phpshop_servers` ADD `admoption` blob;
ALTER TABLE `phpshop_news` ADD `servers` varchar(64) default '';
ALTER TABLE `phpshop_page_categories` ADD `servers` varchar(64) default '';
ALTER TABLE `phpshop_news` ADD `odnotip` text;
ALTER TABLE `phpshop_servers` ADD `admoption` blob;
ALTER TABLE `phpshop_news` ADD `servers` varchar(64) default '';
ALTER TABLE `phpshop_page_categories` ADD `servers` varchar(64) default '';
ALTER TABLE `phpshop_delivery` ADD `sum_max` float DEFAULT '0';
ALTER TABLE `phpshop_modules` ADD `servers` varchar(64) default '';
ALTER TABLE `phpshop_delivery` ADD `servers` varchar(64) default '';
ALTER TABLE `phpshop_orders` ADD `tracking` varchar(64) default '';
ALTER TABLE `phpshop_rssgraber` ADD `servers` varchar(64) default '';
ALTER TABLE `phpshop_baners` ADD `dop_cat` varchar(255) default '';
ALTER TABLE `phpshop_baners` ADD `servers` varchar(64) default '';
ALTER TABLE `phpshop_payment_systems` ADD `color` varchar(64) default '#000000';
ALTER TABLE `phpshop_system` CHANGE `width_icon` `icon` varchar(255) default ''; 
ALTER TABLE `phpshop_sort_categories` ADD `virtual` ENUM('0', '1') DEFAULT '0';
ALTER TABLE `phpshop_categories` ADD `menu` ENUM('0', '1') DEFAULT '0';
ALTER TABLE `phpshop_page_categories` ADD `menu` ENUM('0', '1') DEFAULT '0';
ALTER TABLE `phpshop_order_status` ADD `sms_action` ENUM('0', '1') DEFAULT '0';
ALTER TABLE `phpshop_search_base` ADD `link` varchar(255) DEFAULT '';
ALTER TABLE `phpshop_sort` ADD `description` text;
ALTER TABLE `phpshop_sort` ADD `title` varchar(255) DEFAULT '';
ALTER TABLE `phpshop_news` ADD `icon`  varchar(255) DEFAULT '';

CREATE TABLE IF NOT EXISTS `phpshop_warehouses` (
  `id` int(11) AUTO_INCREMENT,
  `name` varchar(64) ,
  `description` varchar(255) ,
  `uid` varchar(64),
  `enabled` enum('0','1') DEFAULT '1',
  `num` int(11) ,
  `servers` varchar(64) default '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

ALTER TABLE `phpshop_servers` ADD `warehouse` int(11) DEFAULT '0';
ALTER TABLE `phpshop_page` ADD `icon`  varchar(255) DEFAULT '';
ALTER TABLE `phpshop_page` ADD `preview` text;
ALTER TABLE `phpshop_servers` ADD `price` enum('1','2','3','4','5') DEFAULT '1';
ALTER TABLE `phpshop_delivery` ADD `warehouse` int(11) DEFAULT '0';
ALTER TABLE `phpshop_sort_categories` ADD `servers` varchar(64) default '';
ALTER TABLE `phpshop_baners` ADD `skin` varchar(64) default '';
ALTER TABLE `phpshop_page` ADD `footer` enum('0','1') DEFAULT '1';

CREATE TABLE IF NOT EXISTS `phpshop_promotions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` enum('0','1') DEFAULT '0',
  `description` text NOT NULL,
  `label` text NOT NULL,
  `active_check` enum('0','1') NOT NULL,
  `active_date_ot` varchar(255) NOT NULL,
  `active_date_do` varchar(255) NOT NULL,
  `discount_check` enum('0','1') NOT NULL,
  `discount_tip` enum('0','1') NOT NULL,
  `discount` int(11) NOT NULL,
  `free_delivery` enum('0','1') NOT NULL,
  `categories_check` enum('0','1') NOT NULL,
  `categories` text NOT NULL,
  `status_check` enum('0','1') NOT NULL DEFAULT '0',
  `statuses` text NOT NULL DEFAULT '',
  `products_check` enum('0','1') NOT NULL,
  `products` text NOT NULL,
  `sum_order_check` enum('0','1') NOT NULL,
  `sum_order` int(11) NOT NULL,
  `delivery_method_check` enum('0','1') NOT NULL,
  `delivery_method` int(11) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `block_old_price` enum('0','1') DEFAULT '0',
  `hide_old_price` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

ALTER TABLE `phpshop_gbook` ADD `servers` varchar(64) default '';

CREATE TABLE `phpshop_push` (
  `token` text,
  `date` timestamp DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

ALTER TABLE `phpshop_discount` ADD `action` ENUM('1', '2') DEFAULT '1';
ALTER TABLE `phpshop_orders` ADD `admin` int(11) default 0;
ALTER TABLE `phpshop_parent_name` ADD `color` VARCHAR(255);
ALTER TABLE `phpshop_orders` ADD `servers` int(11) default 0;
ALTER TABLE `phpshop_servers` ADD `admin` int(11) default 0;

ALTER TABLE `phpshop_promotions` CHANGE `free_delivery` `num_check` int(11) DEFAULT '0';
ALTER TABLE `phpshop_payment_systems` ADD `servers` varchar(64) default '';
ALTER TABLE `phpshop_shopusers` ADD `servers` int(11) default 0;
ALTER TABLE `phpshop_shopusers` DROP INDEX `login`;
ALTER TABLE `phpshop_orders` ADD `paid` TINYINT(1) DEFAULT NULL;