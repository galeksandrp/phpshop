

DROP TABLE IF EXISTS `phpshop_modules_yescredit_system`;
CREATE TABLE IF NOT EXISTS `phpshop_modules_yescredit_system` (
  `id` int(11) NOT NULL auto_increment,
  `payment_id` tinyint(11) NOT NULL default '0',
  `MERCHANT_ID` int(11) NOT NULL default '0',
  `serial` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_modules_yescredit_system` VALUES (1,25, 99999, '');

INSERT INTO `phpshop_payment_systems` VALUES (25, '�������� ������ (Yes Credit)', 'message', '1', 0, '������ �� ������ ���������� � ����, ����� ����� � ���� �������� ������������� �����.', '������� �� �����');
