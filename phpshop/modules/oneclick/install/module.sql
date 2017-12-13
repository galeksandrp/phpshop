

DROP TABLE IF EXISTS `phpshop_modules_oneclick_system`;
CREATE TABLE IF NOT EXISTS `phpshop_modules_oneclick_system` (
  `id` int(11) NOT NULL auto_increment,
  `enabled` enum('0','1','2') NOT NULL default '1',
  `title` text NOT NULL,
  `title_end` text NOT NULL,
  `serial` varchar(64) NOT NULL default '',
  `windows` enum('0','1') NOT NULL default '0',
  `version` FLOAT(2) DEFAULT '1.1' NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


INSERT INTO `phpshop_modules_oneclick_system` VALUES (1,'0','�������, ��� ����� ������!','���� ��������� �������� � ���� ��� ��������� �������.','','1','1.2');

DROP TABLE IF EXISTS `phpshop_modules_oneclick_jurnal`;
CREATE TABLE `phpshop_modules_oneclick_jurnal` (
  `id` int(11) NOT NULL auto_increment,
  `date` int(11) NOT NULL default '0',
  `name` varchar(64) NOT NULL default '',
  `tel` varchar(64) NOT NULL default '',
  `message` text NOT NULL,
  `product_name` varchar(64) NOT NULL default '',
  `product_id` int(11) NOT NULL,
  `product_price` varchar(64) NOT NULL default '',
  `status` enum('1','2','3','4') NOT NULL default '1',
  `ip` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;