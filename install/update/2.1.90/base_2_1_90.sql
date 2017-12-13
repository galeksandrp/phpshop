ALTER TABLE `phpshop_delivery` ADD `PID` INT( 11 ) NOT NULL;
ALTER TABLE `phpshop_delivery` ADD `taxa` INT( 11 ) NOT NULL;
ALTER TABLE `phpshop_delivery` ADD `is_folder` ENUM( "0", "1" ) DEFAULT '0' NOT NULL ;


-- 
-- Структура таблицы `phpshop_messages`
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



ALTER TABLE `phpshop_page` ADD `secure_groups` varchar(255) NOT NULL default '';


ALTER TABLE `phpshop_orders` CHANGE `uid` `uid` VARCHAR( 64 ) DEFAULT '0' NOT NULL;
ALTER TABLE `phpshop_comment` ADD `enabled` enum('0','1') NOT NULL default '0';
