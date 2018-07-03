

DROP TABLE IF EXISTS `phpshop_modules_netpay_system`;
CREATE TABLE IF NOT EXISTS `phpshop_modules_netpay_system` (
  `id` int(11) NOT NULL auto_increment,
  `status` int(11) NOT NULL,
  `work` enum('1','0') NOT NULL default '0',
  `apikey` varchar(64) NOT NULL default '',
  `auth` varchar(64) NOT NULL default '',
  `title` text NOT NULL,
  `title_sub` text NOT NULL,  
  `autosubmit` enum('1','2') NOT NULL default '1',
  `expiredtime` int(11) NOT NULL,
  `status_paid` int(11) NOT NULL,
  `status_refund` int(11) NOT NULL,
  `online_bill` enum('1','0') NOT NULL default '0',
  `inn` varchar(10) NOT NULL default '',
  `tax` varchar(10) NOT NULL default 'none',
  `hold` enum('1','0') NOT NULL default '0',
  `status_hold` int(11) NOT NULL,
  `version` FLOAT(2) DEFAULT '1.1' NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


INSERT INTO `phpshop_modules_netpay_system` VALUES (1,0, 0, '', '', '��� ������ ���������� ������ �� ������ �������������� �� ���������� ��������� �������� �������������� �������� <a href="http://net2pay.ru" target=_blank>��� ���� ���</a>. �������� ������ �������� ��������� ������������� ����������� ������������ ��������� ������ Visa � MasterCard.','����� �����������. ����� ��������� ������� ������ ����� �������� ������ ��� ������-������','1','15','2','1','0','','none','0', 0, '1.1');

INSERT INTO `phpshop_payment_systems` (`id`, `name`, `path`, `enabled`, `num`, `message`, `message_header`, `yur_data_flag`, `icon`) VALUES
(10017, '������ ������ ��� �������� (VISA, Visa Electron, Maestro, MasterCard, ���)', 'modules', '0', 0, '<p>��� ����� �������!</p>', '�������', '', 'phpshop/modules/netpay/payment/logo.png');