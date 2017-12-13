


ALTER TABLE `phpshop_products` ADD `items` int(11) NOT NULL default '0';
ALTER TABLE `phpshop_products` ADD `weight` float NOT NULL default '0';
ALTER TABLE `phpshop_products` ADD `price2` float NOT NULL default '0';
ALTER TABLE `phpshop_products` ADD `price3` float NOT NULL default '0';
ALTER TABLE `phpshop_products` ADD `price4` float NOT NULL default '0';
ALTER TABLE `phpshop_products` ADD `price5` float NOT NULL default '0';





-- 
-- ��������� ������� `phpshop_foto`
-- 

CREATE TABLE `phpshop_foto` (
  `id` int(11) NOT NULL auto_increment,
  `parent` int(11) NOT NULL default '0',
  `name` varchar(64) NOT NULL default '',
  `num` tinyint(11) NOT NULL default '0',
  `info` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM ;


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_comment`
-- 

CREATE TABLE `phpshop_comment` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `datas` varchar(32) default NULL,
  `name` varchar(32) default NULL,
  `parent_id` int(11) NOT NULL default '0',
  `content` text,
  `user_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM;




-- 
-- ��������� ������� `phpshop_messages`
-- 

CREATE TABLE `phpshop_messages` (
  `ID` int(11) NOT NULL auto_increment,
  `PID` int(11) NOT NULL default '0',
  `UID` int(11) NOT NULL default '0',
  `AID` int(11) NOT NULL default '0',
  `DateTime` datetime NOT NULL default '0000-00-00 00:00:00',
  `Subject` text NOT NULL,
  `Message` text NOT NULL,
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;




-- 
-- ��������� ������� `phpshop_notice`
-- 

CREATE TABLE `phpshop_notice` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `product_id` int(11) NOT NULL default '0',
  `datas_start` varchar(64) NOT NULL default '',
  `datas` varchar(64) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM ;


-- 
-- ���������� ������� `phpshop_categories`
-- 

ALTER TABLE `phpshop_categories` ADD `order_by` enum('1','2','3') NOT NULL default '3';
ALTER TABLE `phpshop_categories` ADD `order_to` enum('1','2') NOT NULL default '1';



-- 
-- ���������� ������� `phpshop_page_categories`
-- 

ALTER TABLE `phpshop_page_categories` CHANGE `parent_to` `parent_to` INT( 11 ) DEFAULT '0' NOT NULL;
ALTER TABLE `phpshop_page_categories` ADD `content` text NOT NULL;

-- 
-- ��������
-- 


