DROP TABLE IF EXISTS `phpshop_modules_tinkoff_system`;
CREATE TABLE IF NOT EXISTS `phpshop_modules_tinkoff_system` (
  `id` int(11) NOT NULL auto_increment,
  `title` text NOT NULL,
  `terminal` varchar(64) NOT NULL default '',
  `secret_key` varchar(64) NOT NULL default '',
  `gateway` varchar(64) NOT NULL default '',
  `version` varchar(64) DEFAULT '2.2',
  `enabled_taxation` int DEFAULT 0,
  `status` int(11) NOT NULL,
  `title_end` text NOT NULL,
  `taxation` varchar(64) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_modules_tinkoff_system` (`id`, `title`, `terminal`, `secret_key`, `gateway`, `version`, `enabled_taxation`, `status`, `title_end`, `taxation`) VALUES
(1, '��������� ������� �������� �����', 'TinkoffBankTest', 'TinkoffBankTest', 'https://securepay.tinkoff.ru/v2', 2.2, 0, 0, '', 'osn');

INSERT INTO `phpshop_payment_systems` (`id`, `name`, `path`, `enabled`, `num`, `message`, `message_header`, `yur_data_flag`, `icon`) VALUES
(10032, 'Visa, Mastercard (Tinkoff)', 'modules', '0', 0, '', '', '', '/UserFiles/Image/Payments/tinkoff.png');

