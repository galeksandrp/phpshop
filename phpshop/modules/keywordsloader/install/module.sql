

DROP TABLE IF EXISTS `phpshop_modules_keywordsloader_system`;
CREATE TABLE IF NOT EXISTS `phpshop_modules_keywordsloader_system` (
  `id` int(11) NOT NULL auto_increment,
  `serial` varchar(64) NOT NULL default '',
  `version` FLOAT(2) DEFAULT '1.0' NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


INSERT INTO `phpshop_modules_keywordsloader_system` VALUES (1,'','1.0');
