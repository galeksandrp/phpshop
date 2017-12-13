

ALTER TABLE `phpshop_system` ADD `rss_use` int(1) unsigned NOT NULL default '1';
ALTER TABLE `phpshop_system` ADD `1c_load_accounts` enum('0','1') NOT NULL default '1';
ALTER TABLE `phpshop_system` ADD `1c_load_invoice` enum('0','1') NOT NULL default '1';


ALTER TABLE `phpshop_news` ADD `datau` INT( 11 ) DEFAULT '0' NOT NULL;
ALTER TABLE `phpshop_orders` CHANGE `seller` `seller` ENUM( '0', '1' ) DEFAULT '0' NOT NULL ;


CREATE TABLE `phpshop_gbook` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `datas` int(11) default NULL,
  `name` varchar(32) default NULL,
  `mail` varchar(32) default NULL,
  `tema` text,
  `otsiv` text,
  `otvet` text,
  `flag` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ��������� ������� `phpshop_rssgraber_jurnal`
-- 

CREATE TABLE `phpshop_rssgraber_jurnal` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `date` int(15) unsigned NOT NULL default '0',
  `link_id` int(11) NOT NULL default '0',
  `status` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- 
-- ��������� ������� `phpshop_rssgraber`
-- 

CREATE TABLE `phpshop_rssgraber` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `link` text NOT NULL,
  `day_num` int(1) NOT NULL default '1',
  `news_num` mediumint(8) NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '1',
  `start_date` int(16) unsigned NOT NULL default '0',
  `end_date` int(16) unsigned NOT NULL default '0',
  `last_load` int(16) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- 
-- ���� ������ ������� `phpshop_rssgraber`
-- 

INSERT INTO `phpshop_rssgraber` VALUES (1, 'http://www.phpshop.ru/rss.php', 1, 1, '1', 1225227600, 1230757200, 1325314000);
        


-- 
-- ��������� ������� `phpshop_rating_votes`
-- 

CREATE TABLE `phpshop_rating_votes` (
  `id_vote` int(11) NOT NULL auto_increment,
  `id_charact` int(11) NOT NULL default '0',
  `id_good` int(11) NOT NULL default '0',
  `id_user` int(11) NOT NULL default '0',
  `userip` varchar(16) NOT NULL default '',
  `rate` tinyint(4) NOT NULL default '0',
  `date` int(11) NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id_vote`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- 
-- ��������� ������� `phpshop_rating_charact`
-- 

CREATE TABLE `phpshop_rating_charact` (
  `id_charact` int(11) NOT NULL auto_increment,
  `id_category` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `num` int(11) NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id_charact`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- 
-- ��������� ������� `phpshop_rating_categories`
-- 

CREATE TABLE `phpshop_rating_categories` (
  `id_category` int(11) NOT NULL auto_increment,
  `ids_dir` varchar(255) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  `revoting` enum('0','1') default NULL,
  PRIMARY KEY  (`id_category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ��������� ������� `phpshop_1c_jurnal`
-- 

CREATE TABLE `phpshop_1c_jurnal` (
  `id` int(11) NOT NULL auto_increment,
  `datas` varchar(64) NOT NULL default '0',
  `p_name` varchar(64) NOT NULL default '',
  `f_name` varchar(64) NOT NULL default '',
  `time` float NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;



-- 
-- ��������� ������� `phpshop_1c_docs`
-- 

CREATE TABLE `phpshop_1c_docs` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `cid` varchar(64) NOT NULL default '',
  `datas` int(11) NOT NULL default '0',
  `datas_f` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;




ALTER TABLE `phpshop_categories` ADD `secure_groups` VARCHAR( 255 ) NOT NULL ;

ALTER TABLE `phpshop_products` ADD `files` TEXT NOT NULL;
ALTER TABLE `phpshop_products` ADD `baseinputvaluta` INT NOT NULL;
ALTER TABLE `phpshop_products` ADD `ed_izm` VARCHAR( 255 ) NOT NULL;

ALTER TABLE `phpshop_sort_categories` ADD `goodoption` ENUM( '0', '1' ) NOT NULL;
ALTER TABLE `phpshop_sort_categories` ADD `optionname` ENUM( '0', '1' ) NOT NULL;

ALTER TABLE `phpshop_messages` ADD `enabled` enum('0','1') NOT NULL default '0';