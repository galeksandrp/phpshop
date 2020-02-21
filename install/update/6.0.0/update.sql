ALTER TABLE `phpshop_gbook` ADD `servers` varchar(64) default '';

CREATE TABLE `phpshop_push` (
  `token` text,
  `date` timestamp DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

ALTER TABLE `phpshop_discount` ADD `action` ENUM('1', '2') DEFAULT '1';
ALTER TABLE `phpshop_orders` ADD `admin` int(11) default 0;