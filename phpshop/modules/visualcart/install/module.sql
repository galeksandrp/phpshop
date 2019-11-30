

DROP TABLE IF EXISTS `phpshop_modules_visualcart_system`;
CREATE TABLE IF NOT EXISTS `phpshop_modules_visualcart_system` (
  `id` int(11) NOT NULL auto_increment,
  `enabled` enum('0','1','2')default '1',
  `flag` enum('1','2') default '1',
  `title` varchar(64) default '',
  `pic_width` tinyint(100) default '0',
  `memory` enum('0','1') default '1',
  `nowbuy` enum('0','1') default '1',
  `version` varchar(64) DEFAULT '2.0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


INSERT INTO `phpshop_modules_visualcart_system` VALUES (1, '0', '1', '�������', 50,'1','1','2.0');

DROP TABLE IF EXISTS `phpshop_modules_visualcart_memory`;
CREATE TABLE `phpshop_modules_visualcart_memory` (
  `id` int(11) NOT NULL auto_increment,
  `memory` varchar(64) default '',
  `cart` text ,
  `date` int(11) default '0',
  `user` int(11) default '0',
  `ip` varchar(64) default '',
  `referal` text ,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;