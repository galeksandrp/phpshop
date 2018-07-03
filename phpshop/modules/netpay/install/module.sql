

DROP TABLE IF EXISTS `phpshop_modules_netpay_system`;
CREATE TABLE IF NOT EXISTS `phpshop_modules_netpay_system` (
  `id` int(11) NOT NULL auto_increment,
  `status` int(11) NOT NULL,
  `title` text NOT NULL,
  `title_sub` text NOT NULL,
  `merchant_key` varchar(64) NOT NULL default '',
  `merchant_skey` varchar(64) NOT NULL default '',
  `autosubmit` enum('1','2') NOT NULL default '1',
  `expiredtime` int(11) NOT NULL,
  `version` FLOAT(2) DEFAULT '1.0' NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


INSERT INTO `phpshop_modules_netpay_system` VALUES (1,0,'�������� ���������� ���� �����','����� ��������� �� ������ ��������.','','','1','15','1.0');

INSERT INTO `phpshop_payment_systems` VALUES (10017, 'Visa, Mastercard, Yandex (NetPay)', 'modules', '0', 0, '', '', '', '/UserFiles/Image/Payments/visa.png');