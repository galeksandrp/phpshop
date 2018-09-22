ALTER TABLE `phpshop_products` ADD `dop_cat` varchar(255) NOT NULL default '';
ALTER TABLE  `phpshop_categories` ADD  `dop_cat` varchar(255) DEFAULT '';
ALTER TABLE  `phpshop_delivery` ADD  `payment` varchar(255) DEFAULT '';
CREATE TABLE `phpshop_modules` (
  `path` varchar(255) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `date` int(11) NOT NULL default '0',
  PRIMARY KEY  (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


CREATE TABLE `phpshop_modules_key` (
  `path` varchar(64) NOT NULL default '',
  `date` int(11) NOT NULL default '0',
  `key` text NOT NULL,
  `verification` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

ALTER TABLE  `phpshop_users` ADD  `hash` VARCHAR( 255 ) NOT NULL ;
ALTER TABLE  `phpshop_delivery` ADD  `icon` VARCHAR( 255 ) NOT NULL ;
ALTER TABLE  `phpshop_payment_systems` ADD  `icon` VARCHAR( 255 ) NOT NULL ;
ALTER TABLE  `phpshop_comment` ADD  `rate`  SMALLINT( 1 ) UNSIGNED NOT NULL DEFAULT  '0';
ALTER TABLE  `phpshop_sort_categories` ADD  `brand` ENUM(  '0',  '1' ) NOT NULL DEFAULT  '0';
ALTER TABLE  `phpshop_sort` ADD  `icon` VARCHAR( 255 ) NOT NULL;
ALTER TABLE  `phpshop_shopusers` ADD  `wishlist` BLOB NOT NULL;
ALTER TABLE  `phpshop_shopusers` ADD  `data_adres` BLOB NOT NULL;
ALTER TABLE  `phpshop_delivery` ADD  `city_select` ENUM(  '0',  '1',  '2' ) NOT NULL DEFAULT  '0', ADD  `data_fields` BLOB NOT NULL;
ALTER TABLE  `phpshop_payment_systems` ADD  `yur_data_flag` ENUM(  '0',  '1' ) NOT NULL DEFAULT  '0';
ALTER TABLE  `phpshop_orders` 
ADD  `country` VARCHAR( 255 ) NOT NULL ,
ADD  `state` VARCHAR( 255 ) NOT NULL ,
ADD  `city` VARCHAR( 255 ) NOT NULL ,
ADD  `index` VARCHAR( 255 ) NOT NULL ,
ADD  `fio` VARCHAR( 255 ) NOT NULL ,
ADD  `tel` VARCHAR( 255 ) NOT NULL ,
ADD  `street` VARCHAR( 255 ) NOT NULL ,
ADD  `house` VARCHAR( 255 ) NOT NULL ,
ADD  `porch` VARCHAR( 255 ) NOT NULL ,
ADD  `door_phone` VARCHAR( 255 ) NOT NULL ,
ADD  `flat` VARCHAR( 255 ) NOT NULL ,
ADD  `org_name` VARCHAR( 255 ) NOT NULL ,
ADD  `org_inn` VARCHAR( 255 ) NOT NULL ,
ADD  `org_kpp` VARCHAR( 255 ) NOT NULL ,
ADD  `org_yur_adres` VARCHAR( 255 ) NOT NULL ,
ADD  `org_fakt_adres` VARCHAR( 255 ) NOT NULL ,
ADD  `org_ras` VARCHAR( 255 ) NOT NULL ,
ADD  `org_bank` VARCHAR( 255 ) NOT NULL ,
ADD  `org_kor` VARCHAR( 255 ) NOT NULL ,
ADD  `org_bik` VARCHAR( 255 ) NOT NULL ,
ADD  `org_city` VARCHAR( 255 ) NOT NULL;
ALTER TABLE  `phpshop_delivery` ADD  `num` SMALLINT( 3 ) NOT NULL DEFAULT  '0';
ALTER TABLE  `phpshop_delivery` CHANGE  `city_select`  `city_select` ENUM(  '0',  '1',  '2',  '3' ) CHARACTER SET cp1251 COLLATE cp1251_general_ci NOT NULL DEFAULT  '0';
ALTER TABLE  `phpshop_delivery` CHANGE  `city_select`  `city_select` ENUM(  '0',  '1',  '2' ) CHARACTER SET cp1251 COLLATE cp1251_general_ci NOT NULL DEFAULT  '0';
ALTER TABLE  `phpshop_orders` ADD  `dop_info` TEXT NOT NULL;
ALTER TABLE  `phpshop_orders` ADD  `delivtime` VARCHAR( 255 ) NOT NULL AFTER  `flat`;
ALTER TABLE  `phpshop_sort_categories` DROP  `flag`;
CREATE TABLE `phpshop_slider` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `enabled` enum('0','1') NOT NULL DEFAULT '0',
  `num` smallint(6) NOT NULL,
  `link` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;


ALTER TABLE  `phpshop_products` ADD  `rate`  FLOAT( 1.1 ) UNSIGNED NOT NULL DEFAULT  '0.0';
ALTER TABLE  `phpshop_products` ADD  `rate_count` INT UNSIGNED NOT NULL DEFAULT  '0';

ALTER TABLE  `phpshop_categories` ADD  `icon` VARCHAR( 255 ) NOT NULL ;
ALTER TABLE  `phpshop_categories` ADD  `icon_description` VARCHAR( 255 ) NOT NULL ;

CREATE TABLE `phpshop_citylist_city` (
  `city_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(11) unsigned NOT NULL DEFAULT '0',
  `region_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`city_id`),
  KEY `country_id` (`country_id`),
  KEY `region_id` (`region_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=15789521 ;


CREATE TABLE `phpshop_citylist_country` (
  `country_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`country_id`),
  KEY `city_id` (`city_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=7716094 ;


CREATE TABLE `phpshop_citylist_region` (
  `region_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned NOT NULL DEFAULT '0',
  `city_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`region_id`),
  KEY `country_id` (`country_id`),
  KEY `city_id` (`city_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;


ALTER TABLE  `phpshop_shopusers_status` ADD  `cumulative_discount_check` INT NOT NULL AFTER  `enabled` ,
ADD  `cumulative_discount` BLOB NOT NULL AFTER  `cumulative_discount_check` ;

ALTER TABLE  `phpshop_shopusers` ADD  `cumulative_discount` INT NOT NULL AFTER  `data_adres` ;
ALTER TABLE  `phpshop_order_status` ADD  `cumulative_action` ENUM(  '0',  '1' ) NOT NULL AFTER  `sklad_action` ;
ALTER TABLE  `phpshop_orders` ADD  `sum` FLOAT ;

ALTER TABLE  `phpshop_sort_categories` ADD  `product` enum('0','1') NOT NULL DEFAULT '0' ;

CREATE TABLE IF NOT EXISTS `phpshop_newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `template` int(11) DEFAULT '0',
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


CREATE TABLE `phpshop_photo_categories` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `parent_to` int(11) default '0',
  `link` varchar(64) default '',
  `name` varchar(64) default '',
  `num` tinyint(11) default '0',
  `content` text,
  `enabled` enum('0','1') default '0',
  `page` varchar(255)  default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;



CREATE TABLE `phpshop_photo` (
  `id` int(11) NOT NULL auto_increment,
  `category` int(11) default '0',
  `enabled` enum('0','1') default '0',
  `name` varchar(64) default '',
  `num` tinyint(11)  default '0',
  `info` varchar(255) default '',
  PRIMARY KEY  (`id`),
  KEY `parent` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

ALTER TABLE  `phpshop_categories` CHANGE  `num`  `num` INT( 11 ) NOT NULL DEFAULT  '0',
CHANGE  `num_row`  `num_row` ENUM(  '1',  '2',  '3',  '4' ) CHARACTER SET cp1251 COLLATE cp1251_general_ci NOT NULL DEFAULT  '2';


ALTER TABLE  `phpshop_categories` ADD  `count` INT( 11 ) NOT NULL ,
ADD  `cat_seo_name` VARCHAR( 255 ) NOT NULL ;


ALTER TABLE  `phpshop_comment` CHANGE  `rate`  `rate` SMALLINT( 1 ) NOT NULL DEFAULT  '0';

ALTER TABLE  `phpshop_delivery` CHANGE  `price_null_enabled`  `price_null_enabled` ENUM(  '0',  '1' ) CHARACTER SET cp1251 COLLATE cp1251_general_ci NULL DEFAULT  '0';

ALTER TABLE  `phpshop_products` CHANGE  `uid`  `uid` VARCHAR( 64 ) CHARACTER SET cp1251 COLLATE cp1251_general_ci NOT NULL DEFAULT  '',
CHANGE  `title_enabled`  `title_enabled` ENUM(  '0',  '1',  '2' ) CHARACTER SET cp1251 COLLATE cp1251_general_ci NOT NULL DEFAULT '0';

ALTER TABLE  `phpshop_products` CHANGE  `parent`  `parent` TEXT CHARACTER SET cp1251 COLLATE cp1251_general_ci NOT NULL DEFAULT  '';


ALTER TABLE  `phpshop_products` ADD  `prod_seo_name` VARCHAR( 255 ) NOT NULL ,
ADD  `price_search` FLOAT NOT NULL DEFAULT  '0';

ALTER TABLE  `phpshop_shopusers_status` CHANGE  `cumulative_discount_check`  `cumulative_discount_check` ENUM(  '0',  '1' ) NOT NULL DEFAULT  '0';

ALTER TABLE  `phpshop_sort` CHANGE  `num`  `num` INT( 11 ) NOT NULL DEFAULT  '0';


ALTER TABLE  `phpshop_sort_categories` CHANGE  `num`  `num` INT( 11 ) NOT NULL DEFAULT  '0',
CHANGE  `category`  `category` INT( 11 ) NOT NULL DEFAULT  '0';


ALTER TABLE  `phpshop_system` CHANGE  `kurs`  `kurs` FLOAT NOT NULL DEFAULT  '0';

ALTER TABLE `phpshop_users`
  DROP `content`,
  DROP `skin`,
  DROP `skin_enabled`,
  DROP `name_enabled`;
  
ALTER TABLE  `phpshop_system` ADD  `1c_option` BLOB NOT NULL ;


CREATE TABLE IF NOT EXISTS `phpshop_payment_systems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(255) NOT NULL DEFAULT '',
  `enabled` enum('0','1') NOT NULL DEFAULT '1',
  `num` tinyint(11) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `message_header` text NOT NULL,
  `yur_data_flag` enum('0','1') NOT NULL DEFAULT '0',
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_payment_systems`
--

INSERT INTO `phpshop_payment_systems` (`id`, `name`, `path`, `enabled`, `num`, `message`, `message_header`, `yur_data_flag`, `icon`) VALUES
(1, '���������� �������', 'bank', '1', 4, '<img src="/UserFiles/Image/Trial/rabbit.png" alt="" align="" border="0"><h3>���������� ��� �� �����!</h3><p>���� ��� �������� � �����&nbsp;<a href="/users/order.html">������ ��������</a>.&nbsp;</p><p>������ ������� �� ������� �������� ��������� � ����� �����.</p>', '', '1', '/UserFiles/Image/Payments/beznal.png'),
(2, '��������� ���������', 'sberbank', '1', 3, '<img src="/UserFiles/Image/Trial/rabbit.png" alt="" align="" border="0"><h3>���������� ��� �� �����!</h3><p>��������� ��������� ��� �������� � �����&nbsp;<a href="/users/order.html">������ ��������</a>.&nbsp;</p><p>������ ������� �� ������� �������� ��������� � ����� �����.</p>', '', '', '/UserFiles/Image/Payments/sberbank.png'),
(3, '�������� ������', 'message', '1', 0, '<img src="/UserFiles/Image/Trial/rabbit.png" alt="" align="" border="0"><h3>���������� ��� �� �����!</h3>� ��������� ����� � ���� �������� ��� �������� ��� ��������� �������.', '', '', '/UserFiles/Image/Payments/nal.png'),
(4, 'Visa, Mastercard (PayOnlineSystem)', 'payonlinesystem', '1', 2, '<img src="/UserFiles/Image/Trial/rabbit.png" alt="" align="" border="0"><h3>���������� ��� �� �����!</h3><p>��� ����� �������, � ��������� ����� ��� �������� �������� � ����.</p>\r\n', '', '', '/UserFiles/Image/Payments/payonline.png'),
(5, 'Visa, Mastercard, Webmoney, Yandex (Robokassa)', 'robox', '1', 1, '<img src="/UserFiles/Image/Trial/rabbit.png" alt="" align="" border="0"><h3>���������� ��� �� �����!</h3><p>��� ����� �������, � ��������� ����� ��� �������� �������� � ����.</p>', '', '', '/UserFiles/Image/Payments/robox.png'),
(6, 'WebMoney', 'webmoney', '1', 8, '<img src="/UserFiles/Image/Trial/rabbit.png" alt="" align="" border="0"><h3>���������� ��� �� �����!</h3><p>��� ����� �������, � ��������� ����� ��� �������� �������� � ����.</p>', '', '', '/UserFiles/Image/Payments/webmoney.png'),
(8, 'Visa, Mastercard, Webmoney, Yandex (Platron)', 'payonlinesystem', '1', 5, '<img src="/UserFiles/Image/Trial/rabbit.png" alt="" align="" border="0"><h3>���������� ��� �� �����!</h3><p>��� ����� �������, � ��������� ����� ��� �������� �������� � ����.</p>', '', '', '/UserFiles/Image/Payments/platron.png');

CREATE TABLE IF NOT EXISTS `phpshop_templates_key` (
  `path` varchar(64) NOT NULL DEFAULT '',
  `date` int(11) DEFAULT '0',
  `key` text,
  `verification` varchar(32) DEFAULT '',
  PRIMARY KEY (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

CREATE TABLE IF NOT EXISTS `phpshop_parent_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251;

ALTER TABLE `phpshop_categories` ADD `parent_title` int(11) DEFAULT '0';
ALTER TABLE `phpshop_order_status` ADD `mail_action` ENUM( "0", "1" ) DEFAULT '1';
ALTER TABLE `phpshop_servers` ADD `tel` varchar(255) default '';
ALTER TABLE `phpshop_servers` ADD `company` varchar(255) default '';
ALTER TABLE `phpshop_servers` ADD `adres` varchar(255) default '';
ALTER TABLE `phpshop_servers` ADD `logo` varchar(255) default '';
ALTER TABLE `phpshop_servers` ADD `adminmail` varchar(255) default '';
ALTER TABLE `phpshop_order_status` ADD `mail_message` text default '';
ALTER TABLE `phpshop_categories` ADD `sort_cache` blob;
ALTER TABLE `phpshop_categories` ADD `sort_cache_created_at` int(11);
ALTER TABLE `phpshop_servers` ADD `currency` int(11);
ALTER TABLE `phpshop_servers` ADD `lang` varchar(32);
ALTER TABLE `phpshop_news` ADD `odnotip` text;
ALTER TABLE `phpshop_servers` ADD `admoption` blob;
ALTER TABLE `phpshop_news` ADD `servers` varchar(64) default '';
ALTER TABLE `phpshop_page_categories` ADD `servers` varchar(64) default '';
ALTER TABLE `phpshop_delivery` ADD `sum_max` float DEFAULT '0';