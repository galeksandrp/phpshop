

DROP TABLE IF EXISTS `phpshop_modules_robokassa_system`;
CREATE TABLE IF NOT EXISTS `phpshop_modules_robokassa_system` (
  `id` int(11) NOT NULL auto_increment,
  `status` int(11) NOT NULL,
  `title` text NOT NULL,
  `title_sub` text NOT NULL,
  `merchant_login` varchar(64) NOT NULL default '',
  `merchant_key` varchar(64) NOT NULL default '',
  `merchant_skey` varchar(64) NOT NULL default '',
  `version` varchar(64) DEFAULT '1.2',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


INSERT INTO `phpshop_modules_robokassa_system` VALUES (1,0,'�������� �����','����� ��������� �� ������ ��������.','','','','1.2');

INSERT INTO `phpshop_payment_systems` (`id`, `name`, `path`, `enabled`, `num`, `message`, `message_header`, `yur_data_flag`, `icon`) VALUES
(10020, 'Visa, Mastercard, Yandex, Webmoney (Robokassa)', 'modules', '0', 0, '<p>��� ����� �������!</p>', '�������', '', '/UserFiles/Image/Payments/visa.png');

CREATE TABLE IF NOT EXISTS `phpshop_modules_robokassa_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `message` text NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `type` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;