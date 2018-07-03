
DROP TABLE IF EXISTS `phpshop_modules_partner_users`;
CREATE TABLE `phpshop_modules_partner_users` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(64) NOT NULL default '',
  `password` varchar(64) NOT NULL default '',
  `date` varchar(64) NOT NULL default '',
  `mail` varchar(64) NOT NULL default '',
  `money` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  `content` blob NOT NULL,
  `activation` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS `phpshop_modules_partner_key`;
CREATE TABLE `phpshop_modules_partner_key` (
 `id` INT( 11) NOT NULL AUTO_INCREMENT ,
 `partner_id` INT( 11) NOT NULL ,
 `url` VARCHAR( 256) NOT NULL ,
 `date` INT( 11) NOT NULL ,
 `url_key` VARCHAR( 256) NOT NULL ,
 PRIMARY KEY (`id`) 
);


DROP TABLE IF EXISTS `phpshop_modules_partner_payment`;
CREATE TABLE `phpshop_modules_partner_payment` (
  `id` int(11) NOT NULL auto_increment,
  `date` int(11) NOT NULL default '0',
  `partner_id` varchar(11) NOT NULL default '0',
  `sum` float NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '0',
  `date_done` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS `phpshop_modules_partner_log`;
CREATE TABLE `phpshop_modules_partner_log` (
  `id` int(11) NOT NULL auto_increment,
  `date` int(11) NOT NULL default '0',
  `order_id` varchar(64) NOT NULL default '0',
  `partner_id` varchar(11) NOT NULL default '0',
  `path` varchar(255) NOT NULL default '',
  `order_user` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  `percent` float NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


DROP TABLE IF EXISTS `phpshop_modules_partner_system`;
CREATE TABLE IF NOT EXISTS `phpshop_modules_partner_system` (
  `id` int(11) NOT NULL auto_increment,
  `enabled` enum('0','1') NOT NULL default '0',
  `percent` float NOT NULL default '0',
  `order_status` tinyint(11) NOT NULL default '0',
  `rule` text NOT NULL,
  `key_enabled` enum('0','1') NOT NULL default '0',
  `version` FLOAT(2) DEFAULT '1.6' NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_modules_partner_system` VALUES (1, '1', 5, 4, '<h1>������� � ������� ���������� ���������</h1>\r\n\r\n<p>\r\n    <b>1. ��������� ���������� ���������.</b><br>\r\n    ����������� ���������� ��������� ����� ���� ���������� ����. ��� ����������� ������ ���������� �������� ��, ����������� ��������, ���� ��� �����������, � ��� �� ��������������� ��� ����������� ������������ ����.\r\n\r\n<p>\r\n    <b>2. ������ ����� �������.</b><br>\r\n    �� ����� ����������� ��� ��������, ������������� � ������� @partnerPercent@% �� ��������� ����������� ������.\r\n\r\n<p>\r\n    <b>3. ������� ������.</b><br>\r\n    ��� ���������� ������� ������������ � ������ ����� ����������� �������� ������� WebMoney, �� ������ ������������ � ������ �������� �� ������ http://www.webmoney.ru\r\n\r\n<p>\r\n    <b>4. ����������� ����� � ������.</b><br>\r\n    ����������� ����� � ������ ����������� � ������� 500 ���. � ������, ���� ������������ ���� ���������� �������� �� ��������� 500 ���, ������ �������� �� ����� �������� �� ��� ���, ���� ����� �������� �� ��������� �� ������� ���� 500 ���. ������ ���������� �������� ������������ ������ 2 ������.\r\n\r\n<p>\r\n    <b>5. ���������� ��������.</b><br>\r\n    ���������� �������� ����� ��������� ������ ���� ����� �������� � ������� �����������, �������� ������� ��.\r\n\r\n<p>\r\n    <b>���������� �������� ����������� ������ �� ���������� ������.</b>\r\n\r\n<p>\r\n    ���������� �������� �� ����� ���������, ����:<br>\r\n    �) ����������, ��������� � ������ ����� �� ����� ���� ����� �������� �� ����������� �������� (��������� "Cookies" � �.�.).<br>\r\n    �) ���������� ������� � ������� �� ���������� ������ ������� �������.<br>\r\n    �) �����������, ���������� ����� ����� ���� ���������� ������ �� ������� ���.<br>\r\n\r\n<p>\r\n    <b>6. �������.</b><br>\r\n    ����������, ����������� ������ ����� �������� ��������� ������ ������������ � ����������� �������� ������ ��������. ������� ������ �������� ����� ���� �������� ���� ��� ���������������� �����������.\r\n\r\n<p>\r\n    <b>7. �����������</b><br>\r\n    � ������ ������������� �����������, ������� ����� ���������� ������������� ��������� ����������� ����� �����������. � ������, ���� ������� �� ������ � ����������, �� ���� �������� ������������ � ���� ��.\r\n\r\n<p><a href="/partner/register_user.html" style="font-size:17px">����������� � ����������� ���������</a>','0','1.7');
