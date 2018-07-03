
CREATE TABLE `phpshop_photo_categories` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `parent_to` int(11) default '0',
  `link` varchar(64) default '',
  `name` varchar(64) default '',
  `num` tinyint(11) default '0',
  `content` text,
  `enabled` enum('0','1') default '0',
  `page` varchar(255)  default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_photo`
-- 


CREATE TABLE `phpshop_photo` (
  `id` int(11) NOT NULL auto_increment,
  `category` int(11) default '0',
  `enabled` enum('0','1') default '0',
  `name` varchar(64) default '',
  `num` tinyint(11)  default '0',
  `info` varchar(255) default '',
  PRIMARY KEY  (`id`),
  KEY `parent` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- ��������� ������� `phpshop_1c_docs`
--

CREATE TABLE IF NOT EXISTS `phpshop_1c_docs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `cid` varchar(64) DEFAULT '',
  `datas` int(11) DEFAULT '0',
  `datas_f` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_1c_jurnal`
--

CREATE TABLE IF NOT EXISTS `phpshop_1c_jurnal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datas` varchar(64) DEFAULT '0',
  `p_name` varchar(64) DEFAULT '',
  `f_name` varchar(64) DEFAULT '',
  `time` float  DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_baners`
--

CREATE TABLE IF NOT EXISTS `phpshop_baners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `content` text,
  `count_all` int(11) DEFAULT '0',
  `count_today` int(11) DEFAULT '0',
  `flag` enum('0','1') DEFAULT '0',
  `datas` varchar(32) DEFAULT '',
  `limit_all` int(11) DEFAULT '0',
  `dir` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_baners`
--

INSERT INTO `phpshop_baners` (`id`, `name`, `content`, `count_all`, `count_today`, `flag`, `datas`, `limit_all`, `dir`) VALUES
(1, '', '<div><img src="/UserFiles/Image/Trial/Slider/phpshop_banner.png" width="100%" alt="������ �����" /></div>', 1613, 76, '1', '13.12.11', 2147483647, '');

-- --------------------------------------------------------


--
-- ��������� ������� `phpshop_categories`
--

CREATE TABLE IF NOT EXISTS `phpshop_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `num` int(11) DEFAULT '0',
  `parent_to` int(11) NOT NULL DEFAULT '0',
  `yml` enum('0','1') DEFAULT '1',
  `num_row` enum('1','2','3','4')  DEFAULT '2',
  `num_cow` tinyint(11) DEFAULT '0',
  `sort` blob,
  `content` text,
  `vid` enum('0','1') DEFAULT '0',
  `name_rambler` varchar(255) DEFAULT '',
  `servers` varchar(255) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `title_enabled` enum('0','1','2')DEFAULT '0',
  `title_shablon` varchar(255) DEFAULT '',
  `descrip` varchar(255) DEFAULT '',
  `descrip_enabled` enum('0','1','2') DEFAULT '0',
  `descrip_shablon` varchar(255) DEFAULT '',
  `keywords` varchar(255) DEFAULT '',
  `keywords_enabled` enum('0','1','2') DEFAULT '0',
  `keywords_shablon` varchar(255) DEFAULT '',
  `skin` varchar(64) DEFAULT '',
  `skin_enabled` enum('0','1') DEFAULT '0',
  `order_by` enum('1','2','3')  DEFAULT '3',
  `order_to` enum('1','2') DEFAULT '1',
  `secure_groups` varchar(255) DEFAULT '',
  `icon` varchar(255) DEFAULT '',
  `icon_description` varchar(255) DEFAULT '',
  `count` int(11) DEFAULT '0',
  `cat_seo_name` varchar(255) DEFAULT '',
  `dop_cat` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `parent_to` (`parent_to`),
  KEY `servers` (`servers`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_categories`
--

INSERT INTO `phpshop_categories` (`id`, `name`, `num`, `parent_to`, `yml`, `num_row`, `num_cow`, `sort`, `content`, `vid`, `name_rambler`, `servers`, `title`, `title_enabled`, `title_shablon`, `descrip`, `descrip_enabled`, `descrip_shablon`, `keywords`, `keywords_enabled`, `keywords_shablon`, `skin`, `skin_enabled`, `order_by`, `order_to`, `secure_groups`, `icon`, `icon_description`, `count`, `cat_seo_name`) VALUES
(13, '������', 2, 0, '0', '3', 0, 0x4e3b, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '', '', 28, ''),
(15, '��� ������', 1, 13, '0', '4', 0, 0x613a333a7b693a303b733a323a223435223b693a313b733a323a223436223b693a323b733a323a223536223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '', '', 9, ''),
(16, '��� ������', 1, 13, '0', '3', 0, 0x613a333a7b693a303b733a323a223435223b693a313b733a323a223436223b693a323b733a323a223536223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', 6, ''),
(49, '����������', 4, 13, '0', '3', 0, 0x4e3b, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '', '', 13, ''),
(50, '����', 1, 49, '0', '4', 8, 0x613a313a7b693a303b733a323a223436223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '', '', 4, ''),
(51, '�����, �����', 1, 49, '0', '3', 0, 0x613a323a7b693a303b733a323a223435223b693a313b733a323a223436223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', 6, ''),
(52, '��������� �������', 1, 49, '0', '3', 0, 0x613a323a7b693a303b733a323a223436223b693a313b733a323a223536223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', 3, ''),
(53, '�����, �����������', 3, 0, '0', '3', 0, 0x4e3b, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', 12, ''),
(54, '���������� ������������', 1, 53, '0', '3', 0, 0x613a313a7b693a303b733a323a223533223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', 6, ''),
(55, '���� ������', 1, 53, '0', '3', 0, 0x613a323a7b693a303b733a323a223533223b693a313b733a323a223535223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '', '', 6, ''),
(59, '���������', 1, 0, '0', '3', 0, 0x4e3b, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '', '', 16, ''),
(60, '������', 1, 59, '0', '3', 0, 0x613a323a7b693a303b733a323a223439223b693a313b733a323a223531223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', 6, ''),
(62, '������� � ����', 1, 59, '0', '3', 0, 0x613a323a7b693a303b733a323a223439223b693a313b733a323a223531223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', 6, ''),
(63, '����������', 4, 59, '0', '2', 0, 0x613a323a7b693a303b733a323a223531223b693a313b733a323a223532223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', 4, '');

-- --------------------------------------------------------


--
-- ��������� ������� `phpshop_comment`
--

CREATE TABLE IF NOT EXISTS `phpshop_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `datas` varchar(32) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `content` text,
  `user_id` int(11) DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '0',
  `rate` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_comment`
--

INSERT INTO `phpshop_comment` (`id`, `datas`, `name`, `parent_id`, `content`, `user_id`, `enabled`, `rate`) VALUES
(91, '1406707200', '����� �������', 138, '�������� ������, �������� � ����.\r\n', 1, '1', 5),
(92, '1406707200', '����� �������', 132, '�������� �������� ������, �������� ������, � ���������� ������ �������� ������� ���������� ��� �� ����! ', 1, '1', 5),
(93, '1406707200', '����� �������', 133, '������ �� �����������.', 1, '1', 1),
(94, '1406707200', '����� �������', 134, '���������� ������ �� ������ ����, ����� - ���������.', 1, '1', 2),
(95, '1406707200', '����� �������', 135, '�� ������������� �������, �� ����� ��������!', 1, '1', 3),
(96, '1406707200', '����� �������', 137, '���������� ������ ������!', 1, '1', 4),
(97, '1406707200', '����� �������', 136, '����� ������, ������, ����� ��������!', 1, '1', 2),
(98, '1406707200', '����� �������', 144, '������ �����������. ������ 5.', 1, '1', 5),
(99, '1406707200', '����� �������', 140, '����� ���� ����� ������ ������. ����� 2 �� ���. ', 1, '1', 2),
(100, '1406707200', '����� �������', 141, '�� ����� � ������, � �������� ��������. ', 1, '1', 4),
(101, '1406707200', '����� �������', 143, '������� � ����� ) ', 1, '1', 2),
(102, '1406707200', '����� �������', 169, '���������� ������, ��������� ������, ���� ������ ��������-) ', 1, '1', 5),
(103, '1406707200', '����� �������', 164, '�������� ������ ��� ������ ����, ������ ��� ��������������, ��� ��������. �����.', 1, '1', 2),
(104, '1406707200', '����� �������', 165, '���� ������� � ������.', 1, '1', 0),
(105, '1406707200', '����� �������', 166, '�� ������ � ���, �� ��������� �������� ��������!', 1, '1', 4),
(106, '1406707200', '����� �������', 167, '���� ���������, ������ ������� ��������.', 1, '1', 1),
(107, '1406707200', '����� �������', 174, '���� ����������, ������ � ���������. ������ ������� !', 1, '1', 5),
(108, '1406707200', '����� �������', 171, '���� �� ������. ����� 1.', 1, '1', 4),
(109, '1406707200', '����� �������', 172, '������� ������� �� ����-) ', 1, '1', 4),
(110, '1406707200', '����� �������', 177, '�������������, ����) ����� �� ��������.', 1, '1', 4),
(111, '1406707200', '����� �������', 175, '������ �������� ���� �����, �� �������������� � �� ���� ���....', 1, '1', 5),
(112, '1406707200', '����� �������', 176, '��������� ����� ������...', 1, '1', 4),
(113, '1406707200', '����� �������', 179, '������� ������� �� ��� ���� ������.', 1, '1', 3),
(114, '1406707200', '����� �������', 178, '������������ ����� - ������ ������������� ���������!', 1, '1', 5),
(115, '1406707200', '����� �������', 180, '�������� �� ������ ��������!', 1, '1', 1),
(116, '1406707200', '����� �������', 181, '���� ����������!', 1, '1', 4),
(117, '1406707200', '���� ������', 144, '�������� �����.', 2, '1', 1),
(118, '1406707200', '���� ������', 140, '�����������!', 2, '1', 2),
(119, '1406707200', '���� ������', 141, '������� ���������.. ', 2, '1', 2),
(120, '1406707200', '���� ������', 142, '������� ��������, ������ � ������!', 2, '1', 4),
(121, '1406707200', '���� ������', 143, '�������� ��������, ������ � ������...', 2, '1', 4),
(122, '1406707200', '���� ������', 116, '������ �� ������������ ����, ����������.', 2, '1', 5),
(123, '1406707200', '���� ������', 119, '���� �������� �� ���� ��������, �������� �� ����� ���������, ������, ������ 5.', 2, '1', 5),
(124, '1406707200', '���� ������', 121, '���� ����� �������!', 2, '1', 4),
(125, '1406707200', '���� ������', 179, '������� ���� �� ����� ��� - ��� � �������� !', 2, '1', 5),
(126, '1406707200', '���� ������', 180, '������� �������������� ���������� ������ �� ���� ) ', 2, '1', 2),
(127, '1406707200', '���� ������', 181, '�������� ��� �����.', 2, '1', 4),
(128, '1406707200', '���� ������', 145, '�������� ������ ��������. ��� ���, ��� ����� ���������� �� Android�� - ��� �����������, ���� ��������� ������� ���� �����.', 2, '1', 4),
(129, '1406707200', '���� ������', 146, '����������� "�������������� �������� ����� �������".', 2, '1', 2),
(130, '1406707200', '���� ������', 147, '������������ ������ ����������� ��� ��������������� ���������� (���� ���������� � �������� �� ���� ����)', 2, '1', 3),
(131, '1406707200', '���� ������', 147, ' ������� ������� �������� �� 600 �������. ��� � �������. ', 2, '1', 4),
(132, '1406707200', '���� ������', 148, '��� �� �����. ����� ������ ��� �����? ', 2, '1', 2),
(133, '1406707200', '���� ������', 157, '���������� ���������� ������� (��� ��������, ��� ����� �� �������� ������ ���������� ������� � ������ ��������, ����� ��� ��� ����� ���������� ��� �� ������ � ������ � �����)', 2, '1', 3),
(134, '1406707200', '���� ������', 146, '�������, ������, �������� ����� � ��������.', 2, '1', 5),
(135, '1406707200', '���� ������', 157, '��� ����� ��������� ������. ������� ��������� � ����� � �������� � ������ �������� �� ����� ������. ', 2, '1', 5),
(136, '1406707200', '���� ������', 149, '� ���� ����������� �����������.', 2, '1', 5),
(137, '1406707200', '���� ������', 151, '+ �������������� ������������� ������ .', 2, '1', 4),
(138, '1406707200', '���� ������', 152, '����� - �� ����� ������� ���������� � ������� ���� ������. ������ ����� � ���������. \r\n', 2, '1', 3),
(139, '1406707200', '���� ������', 153, '���������, ��� �� ������ ������ �������� ��� ���������. \r\n', 2, '1', 4),
(140, '1406707200', '���� ������', 154, '�������������� ������������� ������ !\r\n', 2, '1', 5),
(141, '1406707200', '���� ������', 155, '������ ����� ������������ ������������ � ����� ���������.\r\n', 2, '1', 1),
(142, '1406707200', '���� ������', 156, '�������� �������� �������� ������. ', 2, '1', 3),
(143, '1406707200', '���� ������', 156, '�������� �������� �������� ������. ', 2, '1', 3),
(144, '1408003200', '����� �������', 152, '�����������!', 16, '1', 0);

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_delivery`
--

CREATE TABLE IF NOT EXISTS `phpshop_delivery` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(255) DEFAULT '',
  `price` float DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '1',
  `flag` enum('0','1') DEFAULT '0',
  `price_null` float DEFAULT '0',
  `price_null_enabled` enum('0','1') DEFAULT '0',
  `PID` int(11) DEFAULT '0',
  `taxa` int(11) DEFAULT '0',
  `is_folder` enum('0','1') DEFAULT '0',
  `city_select` enum('0','1','2') DEFAULT '0',
  `data_fields` blob,
  `num` smallint(3) DEFAULT '0',
  `icon` varchar(255) DEFAULT '',
  `payment` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_delivery`
--

INSERT INTO `phpshop_delivery` (`id`, `city`, `price`, `enabled`, `flag`, `price_null`, `price_null_enabled`, `PID`, `taxa`, `is_folder`, `city_select`, `data_fields`, `num`, `icon`) VALUES
(1, '������', 0, '1', '1', 0, '0', 0, 0, '1', '0', '', 0, '/UserFiles/Image/Payments/city.png'),
(3, '�������� �������� � �������� ����', 180, '1', '1', 2000, '1', 1, 1, '0', '0', 0x613a323a7b733a373a22656e61626c6564223b613a31323a7b733a373a22636f756e747279223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a353a227374617465223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a343a2263697479223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a353a22696e646578223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a333a2266696f223b613a323a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a333a22d4c8ce223b7d733a333a2274656c223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a373a22d2e5ebe5f4eeed223b733a333a22726571223b733a313a2231223b7d733a363a22737472656574223b613a313a7b733a343a226e616d65223b733a353a22d3ebe8f6e0223b7d733a353a22686f757365223b613a313a7b733a343a226e616d65223b733a333a22c4eeec223b7d733a353a22706f726368223b613a313a7b733a343a226e616d65223b733a373a22cfeee4fae5e7e4223b7d733a31303a22646f6f725f70686f6e65223b613a313a7b733a343a226e616d65223b733a31323a22caeee420e4eeeceef4eeede0223b7d733a343a22666c6174223b613a313a7b733a343a226e616d65223b733a383a22cae2e0f0f2e8f0e0223b7d733a393a2264656c697674696d65223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31363a22caeee3e4e020e4eef1f2e0e2e8f2fc3f223b733a333a22726571223b733a313a2231223b7d7d733a333a226e756d223b613a31323a7b733a373a22636f756e747279223b733a303a22223b733a353a227374617465223b733a303a22223b733a343a2263697479223b733a303a22223b733a353a22696e646578223b733a303a22223b733a333a2266696f223b733a313a2231223b733a333a2274656c223b733a313a2232223b733a363a22737472656574223b733a313a2233223b733a353a22686f757365223b733a313a2234223b733a353a22706f726368223b733a313a2235223b733a31303a22646f6f725f70686f6e65223b733a313a2236223b733a343a22666c6174223b733a313a2237223b733a393a2264656c697674696d65223b733a313a2238223b7d7d, 0, '/UserFiles/Image/Payments/courier.png'),
(4, '�������� �������� �� ��������� ����', 300, '1', '0', 0, '0', 1, 0, '0', '0', 0x613a323a7b733a373a22656e61626c6564223b613a31323a7b733a373a22636f756e747279223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a353a227374617465223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a343a2263697479223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a353a22696e646578223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a333a2266696f223b613a313a7b733a343a226e616d65223b733a333a22d4c8ce223b7d733a333a2274656c223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a373a22d2e5ebe5f4eeed223b733a333a22726571223b733a313a2231223b7d733a363a22737472656574223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a353a22d3ebe8f6e0223b733a333a22726571223b733a313a2231223b7d733a353a22686f757365223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a333a22c4eeec223b733a333a22726571223b733a313a2231223b7d733a353a22706f726368223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a373a22cfeee4fae5e7e4223b733a333a22726571223b733a313a2231223b7d733a31303a22646f6f725f70686f6e65223b613a323a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31323a22caeee420e4eeeceef4eeede0223b7d733a343a22666c6174223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a383a22cae2e0f0f2e8f0e0223b733a333a22726571223b733a313a2231223b7d733a393a2264656c697674696d65223b613a313a7b733a343a226e616d65223b733a303a22223b7d7d733a333a226e756d223b613a31323a7b733a373a22636f756e747279223b733a303a22223b733a353a227374617465223b733a303a22223b733a343a2263697479223b733a303a22223b733a353a22696e646578223b733a303a22223b733a333a2266696f223b733a313a2231223b733a333a2274656c223b733a313a2232223b733a363a22737472656574223b733a313a2233223b733a353a22686f757365223b733a313a2234223b733a353a22706f726368223b733a313a2235223b733a31303a22646f6f725f70686f6e65223b733a313a2236223b733a343a22666c6174223b733a313a2237223b733a393a2264656c697674696d65223b733a303a22223b7d7d, 0, '/UserFiles/Image/Payments/courier-za-mkad.png'),
(7, '������', 0, '1', '', 0, '0', 0, 0, '1', '0', '', 1, '/UserFiles/Image/Payments/russia.png'),
(8, 'EMS', 500, '1', '0', 5000, '1', 7, 50, '0', '1', 0x613a323a7b733a373a22656e61626c6564223b613a31323a7b733a373a22636f756e747279223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a353a227374617465223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a343a2263697479223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a353a22c3eef0eee4223b733a333a22726571223b733a313a2231223b7d733a353a22696e646578223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a363a22c8ede4e5eaf1223b733a333a22726571223b733a313a2231223b7d733a333a2266696f223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31343a22d4c8ce20efeeebf3f7e0f2e5ebff223b733a333a22726571223b733a313a2231223b7d733a333a2274656c223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31383a22d2e5ebe5f4eeed20efeeebf3f7e0f2e5ebff223b733a333a22726571223b733a313a2231223b7d733a363a22737472656574223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a353a22d3ebe8f6e0223b733a333a22726571223b733a313a2231223b7d733a353a22686f757365223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a333a22c4eeec223b733a333a22726571223b733a313a2231223b7d733a353a22706f726368223b613a323a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a373a22cfeee4fae5e7e4223b7d733a31303a22646f6f725f70686f6e65223b613a323a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31323a22caeee420e4eeeceef4eeede0223b7d733a343a22666c6174223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a383a22cae2e0f0f2e8f0e0223b733a333a22726571223b733a313a2231223b7d733a393a2264656c697674696d65223b613a313a7b733a343a226e616d65223b733a303a22223b7d7d733a333a226e756d223b613a31323a7b733a373a22636f756e747279223b733a303a22223b733a353a227374617465223b733a303a22223b733a343a2263697479223b733a313a2231223b733a353a22696e646578223b733a313a2232223b733a333a2266696f223b733a313a2233223b733a333a2274656c223b733a313a2234223b733a363a22737472656574223b733a313a2235223b733a353a22686f757365223b733a313a2236223b733a353a22706f726368223b733a313a2237223b733a31303a22646f6f725f70686f6e65223b733a313a2238223b733a343a22666c6174223b733a313a2239223b733a393a2264656c697674696d65223b733a303a22223b7d7d, 1, '/UserFiles/Image/Payments/ems.png'),
(9, '����� ������', 900, '1', '0', 5000, '1', 7, 60, '0', '0', 0x613a323a7b733a373a22656e61626c6564223b613a31323a7b733a373a22636f756e747279223b613a313a7b733a343a226e616d65223b733a363a22d1f2f0e0ede0223b7d733a353a227374617465223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a343a2263697479223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a353a22c3eef0eee4223b733a333a22726571223b733a313a2231223b7d733a353a22696e646578223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a363a22c8ede4e5eaf1223b733a333a22726571223b733a313a2231223b7d733a333a2266696f223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31343a22d4c8ce20efeeebf3f7e0f2e5ebff223b733a333a22726571223b733a313a2231223b7d733a333a2274656c223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31383a22d2e5ebe5f4eeed20efeeebf3f7e0f2e5ebff223b733a333a22726571223b733a313a2231223b7d733a363a22737472656574223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a353a22d3ebe8f6e0223b733a333a22726571223b733a313a2231223b7d733a353a22686f757365223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a333a22c4eeec223b733a333a22726571223b733a313a2231223b7d733a353a22706f726368223b613a323a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a373a22cfeee4fae5e7e4223b7d733a31303a22646f6f725f70686f6e65223b613a323a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31323a22caeee420e4eeeceef4eeede0223b7d733a343a22666c6174223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a383a22cae2e0f0f2e8f0e0223b733a333a22726571223b733a313a2231223b7d733a393a2264656c697674696d65223b613a313a7b733a343a226e616d65223b733a303a22223b7d7d733a333a226e756d223b613a31323a7b733a373a22636f756e747279223b733a303a22223b733a353a227374617465223b733a303a22223b733a343a2263697479223b733a313a2231223b733a353a22696e646578223b733a313a2232223b733a333a2266696f223b733a313a2233223b733a333a2274656c223b733a313a2234223b733a363a22737472656574223b733a313a2235223b733a353a22686f757365223b733a313a2236223b733a353a22706f726368223b733a313a2237223b733a31303a22646f6f725f70686f6e65223b733a313a2238223b733a343a22666c6174223b733a313a2239223b733a393a2264656c697674696d65223b733a303a22223b7d7d, 2, '/UserFiles/Image/Payments/pochta-rf.png'),
(12, '�� ������� ������', 0, '1', '0', 0, '', 0, 0, '1', '0', '', 3, '/UserFiles/Image/Payments/world.png'),
(13, 'DHL', 0, '1', '0', 0, '0', 12, 0, '0', '2', 0x613a323a7b733a373a22656e61626c6564223b613a31323a7b733a373a22636f756e747279223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a363a22d1f2f0e0ede0223b733a333a22726571223b733a313a2231223b7d733a353a227374617465223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a363a22d0e5e3e8eeed223b733a333a22726571223b733a313a2231223b7d733a343a2263697479223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a353a22c3eef0eee4223b733a333a22726571223b733a313a2231223b7d733a353a22696e646578223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a363a22c8ede4e5eaf1223b733a333a22726571223b733a313a2231223b7d733a333a2266696f223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31343a22d4c8ce20efeeebf3f7e0f2e5ebff223b733a333a22726571223b733a313a2231223b7d733a333a2274656c223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31383a22d2e5ebe5f4eeed20efeeebf3f7e0f2e5ebff223b733a333a22726571223b733a313a2231223b7d733a363a22737472656574223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a353a22d3ebe8f6e0223b733a333a22726571223b733a313a2231223b7d733a353a22686f757365223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a333a22c4eeec223b733a333a22726571223b733a313a2231223b7d733a353a22706f726368223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a373a22cfeee4fae5e7e4223b733a333a22726571223b733a313a2231223b7d733a31303a22646f6f725f70686f6e65223b613a323a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31323a22caeee420e4eeeceef4eeede0223b7d733a343a22666c6174223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a383a22cae2e0f0f2e8f0e0223b733a333a22726571223b733a313a2231223b7d733a393a2264656c697674696d65223b613a313a7b733a343a226e616d65223b733a303a22223b7d7d733a333a226e756d223b613a31323a7b733a373a22636f756e747279223b733a313a2231223b733a353a227374617465223b733a313a2232223b733a343a2263697479223b733a313a2233223b733a353a22696e646578223b733a313a2234223b733a333a2266696f223b733a313a2235223b733a333a2274656c223b733a313a2236223b733a363a22737472656574223b733a313a2237223b733a353a22686f757365223b733a313a2238223b733a353a22706f726368223b733a313a2239223b733a31303a22646f6f725f70686f6e65223b733a323a223130223b733a343a22666c6174223b733a323a223131223b733a393a2264656c697674696d65223b733a303a22223b7d7d, 0, '/UserFiles/Image/Payments/dhl.png');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_discount`
--

CREATE TABLE IF NOT EXISTS `phpshop_discount` (
  `id` tinyint(11) unsigned NOT NULL AUTO_INCREMENT,
  `sum` int(255) DEFAULT '0',
  `discount` float(2) DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_foto`
--

CREATE TABLE IF NOT EXISTS `phpshop_foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT '0',
  `name` varchar(64) DEFAULT '',
  `num` tinyint(11) DEFAULT '0',
  `info` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_foto`
--

INSERT INTO `phpshop_foto` (`id`, `parent`, `name`, `num`, `info`) VALUES
(292, 1, '/UserFiles/Image/Trial/img1_14820.jpg', 0, ''),
(296, 2, '/UserFiles/Image/Trial/img2_61080.jpg', 0, ''),
(300, 3, '/UserFiles/Image/Trial/img3_66664.jpg', 0, ''),
(7, 4, '/UserFiles/Image/Trial/img4_97080.jpg', 0, ''),
(276, 6, '/UserFiles/Image/Trial/img6_20923.jpg', 0, ''),
(288, 38, '/UserFiles/Image/Trial/img38_11536.jpg', 0, ''),
(280, 7, '/UserFiles/Image/Trial/img7_66247.jpg', 0, ''),
(284, 8, '/UserFiles/Image/Trial/img8_13325.jpg', 0, ''),
(252, 9, '/UserFiles/Image/Trial/img9_20828.jpg', 0, ''),
(258, 10, '/UserFiles/Image/Trial/img10_98700.jpg', 0, ''),
(576, 39, '/UserFiles/Image/img39_37444.jpg', 0, ''),
(253, 9, '/UserFiles/Image/Trial/img9_15513.jpg', 0, ''),
(327, 13, '/UserFiles/Image/Trial/img13_15367.jpg', 0, ''),
(337, 15, '/UserFiles/Image/Trial/img15_13063.jpg', 0, ''),
(331, 14, '/UserFiles/Image/Trial/img14_61199.jpg', 0, ''),
(339, 16, '/UserFiles/Image/Trial/img16_13068.jpg', 0, ''),
(373, 17, '/UserFiles/Image/Trial/img17_35966.jpg', 0, ''),
(377, 18, '/UserFiles/Image/Trial/img18_54162.jpg', 0, ''),
(381, 19, '/UserFiles/Image/Trial/img19_97642.', 0, ''),
(385, 20, '/UserFiles/Image/Trial/img20_13117.jpg', 0, ''),
(358, 21, '/UserFiles/Image/Trial/img21_10640.jpg', 0, ''),
(361, 22, '/UserFiles/Image/Trial/img22_71944.jpg', 0, ''),
(365, 23, '/UserFiles/Image/Trial/img23_11103.jpg', 0, ''),
(369, 24, '/UserFiles/Image/Trial/img24_19847.jpg', 0, ''),
(406, 25, '/UserFiles/Image/Trial/img25_27608.jpg', 0, ''),
(422, 26, '/UserFiles/Image/Trial/img26_12295.jpg', 0, ''),
(414, 27, '/UserFiles/Image/Trial/img27_57811.jpg', 0, ''),
(421, 28, '/UserFiles/Image/Trial/img28_64148.jpg', 0, ''),
(423, 29, '/UserFiles/Image/Trial/img29_62370.jpg', 0, ''),
(428, 30, '/UserFiles/Image/Trial/img30_20926.jpg', 0, ''),
(435, 31, '/UserFiles/Image/Trial/img31_11735.jpg', 0, ''),
(437, 32, '/UserFiles/Image/Trial/img32_56526.jpg', 0, ''),
(441, 33, '/UserFiles/Image/Trial/img33_20905.jpg', 0, ''),
(450, 35, '/UserFiles/Image/Trial/img35_49910.jpg', 0, ''),
(453, 36, '/UserFiles/Image/Trial/img36_64985.jpg', 0, ''),
(293, 1, '/UserFiles/Image/Trial/img1_15540.jpg', 0, ''),
(304, 37, '/UserFiles/Image/Trial/img37_17791.jpg', 0, ''),
(301, 3, '/UserFiles/Image/Trial/img3_11413.jpg', 0, ''),
(486, 45, '/UserFiles/Image/Trial/img45_67611.jpg', 0, ''),
(328, 13, '/UserFiles/Image/Trial/img13_59320.jpg', 0, ''),
(297, 2, '/UserFiles/Image/Trial/img2_15458.jpg', 0, ''),
(298, 2, '/UserFiles/Image/Trial/img2_16142.jpg', 0, ''),
(302, 3, '/UserFiles/Image/Trial/img3_67419.jpg', 0, ''),
(305, 37, '/UserFiles/Image/Trial/img37_14361.jpg', 0, ''),
(279, 6, '/UserFiles/Image/Trial/img6_81860.jpg', 0, ''),
(285, 8, '/UserFiles/Image/Trial/img8_43325.jpg', 0, ''),
(286, 8, '/UserFiles/Image/Trial/img8_19919.jpg', 0, ''),
(281, 7, '/UserFiles/Image/Trial/img7_20815.jpg', 0, ''),
(282, 7, '/UserFiles/Image/Trial/img7_39656.jpg', 0, ''),
(277, 6, '/UserFiles/Image/Trial/img6_18424.jpg', 0, ''),
(278, 6, '/UserFiles/Image/Trial/img6_12208.jpg', 0, ''),
(289, 38, '/UserFiles/Image/Trial/img38_12110.jpg', 0, ''),
(290, 38, '/UserFiles/Image/Trial/img38_35567.jpg', 0, ''),
(256, 9, '/UserFiles/Image/Trial/img9_47633.jpg', 0, ''),
(255, 9, '/UserFiles/Image/Trial/img9_55876.jpg', 0, ''),
(259, 10, '/UserFiles/Image/Trial/img10_70506.jpg', 0, ''),
(260, 10, '/UserFiles/Image/Trial/img10_99517.jpg', 0, ''),
(267, 11, '/UserFiles/Image/Trial/img11_19968.jpg', 0, ''),
(268, 11, '/UserFiles/Image/Trial/img11_16800.jpg', 0, ''),
(269, 11, '/UserFiles/Image/Trial/img11_15173.jpg', 0, ''),
(473, 41, '/UserFiles/Image/Trial/img41_13522.jpg', 0, ''),
(332, 14, '/UserFiles/Image/Trial/img14_14799.jpg', 0, ''),
(333, 14, '/UserFiles/Image/Trial/img14_16725.jpg', 0, ''),
(342, 16, '/UserFiles/Image/Trial/img16_14316.jpg', 0, ''),
(335, 15, '/UserFiles/Image/Trial/img15_13938.jpg', 0, ''),
(340, 16, '/UserFiles/Image/Trial/img16_95385.jpg', 0, ''),
(341, 16, '/UserFiles/Image/Trial/img16_16151.jpg', 0, ''),
(374, 17, '/UserFiles/Image/Trial/img17_34086.jpg', 0, ''),
(375, 17, '/UserFiles/Image/Trial/img17_18035.jpg', 0, ''),
(378, 18, '/UserFiles/Image/Trial/img18_61454.jpg', 0, ''),
(379, 18, '/UserFiles/Image/Trial/img18_20302.jpg', 0, ''),
(382, 19, '/UserFiles/Image/Trial/img19_10107.jpg', 0, ''),
(383, 19, '/UserFiles/Image/Trial/img19_97468.jpg', 0, ''),
(386, 20, '/UserFiles/Image/Trial/img20_70570.jpg', 0, ''),
(389, 20, '/UserFiles/Image/Trial/img20_35512.jpg', 0, ''),
(359, 21, '/UserFiles/Image/Trial/img21_32804.jpg', 0, ''),
(357, 21, '/UserFiles/Image/Trial/img21_57890.jpg', 0, ''),
(362, 22, '/UserFiles/Image/Trial/img22_10116.jpg', 0, ''),
(363, 22, '/UserFiles/Image/Trial/img22_99779.jpg', 0, ''),
(366, 23, '/UserFiles/Image/Trial/img23_12441.jpg', 0, ''),
(367, 23, '/UserFiles/Image/Trial/img23_50672.jpg', 0, ''),
(370, 24, '/UserFiles/Image/Trial/img24_20831.jpg', 0, ''),
(371, 24, '/UserFiles/Image/Trial/img24_13073.jpg', 0, ''),
(407, 25, '/UserFiles/Image/Trial/img25_38615.jpg', 0, ''),
(408, 25, '/UserFiles/Image/Trial/img25_17990.jpg', 0, ''),
(426, 29, '/UserFiles/Image/Trial/img29_18781.jpg', 0, ''),
(410, 26, '/UserFiles/Image/Trial/img26_39871.jpg', 0, ''),
(415, 27, '/UserFiles/Image/Trial/img27_13799.jpg', 0, ''),
(416, 27, '/UserFiles/Image/Trial/img27_10423.jpg', 0, ''),
(420, 28, '/UserFiles/Image/Trial/img28_12357.jpg', 0, ''),
(419, 28, '/UserFiles/Image/Trial/img28_36278.jpg', 0, ''),
(424, 29, '/UserFiles/Image/Trial/img29_26450.jpg', 0, ''),
(425, 29, '/UserFiles/Image/Trial/img29_15804.jpg', 0, ''),
(429, 30, '/UserFiles/Image/Trial/img30_91257.jpg', 0, ''),
(430, 30, '/UserFiles/Image/Trial/img30_77562.jpg', 0, ''),
(433, 31, '/UserFiles/Image/Trial/img31_62035.jpg', 0, ''),
(434, 31, '/UserFiles/Image/Trial/img31_16012.jpg', 0, ''),
(438, 32, '/UserFiles/Image/Trial/img32_12719.jpg', 0, ''),
(439, 32, '/UserFiles/Image/Trial/img32_74919.jpg', 0, ''),
(442, 33, '/UserFiles/Image/Trial/img33_94300.jpg', 0, ''),
(443, 33, '/UserFiles/Image/Trial/img33_16896.jpg', 0, ''),
(447, 34, '/UserFiles/Image/Trial/img34_18896.jpg', 0, ''),
(446, 34, '/UserFiles/Image/Trial/img34_54875.jpg', 0, ''),
(451, 35, '/UserFiles/Image/Trial/img35_16730.jpg', 0, ''),
(452, 35, '/UserFiles/Image/Trial/img35_79801.jpg', 0, ''),
(454, 36, '/UserFiles/Image/Trial/img36_56679.jpg', 0, ''),
(455, 36, '/UserFiles/Image/Trial/img36_50315.jpg', 0, ''),
(800, 112, '/UserFiles/Image/Trial/img112_24010.jpg', 0, ''),
(295, 1, '/UserFiles/Image/Trial/img1_14333.jpg', 0, ''),
(272, 12, '/UserFiles/Image/Trial/img12_54691.jpg', 0, ''),
(274, 12, '/UserFiles/Image/Trial/img12_14304.jpg', 0, ''),
(380, 18, '/UserFiles/Image/Trial/img18_37948.jpg', 0, ''),
(472, 41, '/UserFiles/Image/Trial/img41_34798.jpg', 0, ''),
(261, 10, '/UserFiles/Image/Trial/img10_20493.jpg', 0, ''),
(273, 12, '/UserFiles/Image/Trial/img12_39663.jpg', 0, ''),
(275, 12, '/UserFiles/Image/Trial/img12_78129.jpg', 0, ''),
(283, 7, '/UserFiles/Image/Trial/img7_91321.jpg', 0, ''),
(287, 8, '/UserFiles/Image/Trial/img8_21440.jpg', 0, ''),
(291, 38, '/UserFiles/Image/Trial/img38_17545.jpg', 0, ''),
(299, 2, '/UserFiles/Image/Trial/img2_11819.jpg', 0, ''),
(458, 37, '/UserFiles/Image/Trial/img37_11242.jpg', 0, ''),
(307, 37, '/UserFiles/Image/Trial/img37_84802.jpg', 0, ''),
(360, 21, '/UserFiles/Image/Trial/img21_74428.jpg', 0, ''),
(338, 15, '/UserFiles/Image/Trial/img15_14316.jpg', 0, ''),
(334, 14, '/UserFiles/Image/Trial/img14_90055.jpg', 0, ''),
(336, 15, '/UserFiles/Image/Trial/img15_92385.jpg', 0, ''),
(330, 13, '/UserFiles/Image/Trial/img13_53749.jpg', 0, ''),
(344, 13, '/UserFiles/Image/Trial/img13_19444.jpg', 0, ''),
(364, 22, '/UserFiles/Image/Trial/img22_14431.jpg', 0, ''),
(368, 23, '/UserFiles/Image/Trial/img23_16936.jpg', 0, ''),
(372, 24, '/UserFiles/Image/Trial/img24_20598.jpg', 0, ''),
(376, 17, '/UserFiles/Image/Trial/img17_13782.jpg', 0, ''),
(384, 19, '/UserFiles/Image/Trial/img19_12587.jpg', 0, ''),
(388, 20, '/UserFiles/Image/Trial/img20_45107.jpg', 0, ''),
(409, 25, '/UserFiles/Image/Trial/img25_17522.jpg', 0, ''),
(412, 26, '/UserFiles/Image/Trial/img26_77269.jpg', 0, ''),
(417, 27, '/UserFiles/Image/Trial/img27_13427.jpg', 0, ''),
(418, 28, '/UserFiles/Image/Trial/img28_16567.jpg', 0, ''),
(413, 26, '/UserFiles/Image/Trial/img26_19691.jpg', 0, ''),
(427, 29, '/UserFiles/Image/Trial/img29_90265.jpg', 0, ''),
(431, 30, '/UserFiles/Image/Trial/img30_80985.jpg', 0, ''),
(436, 31, '/UserFiles/Image/Trial/img31_15570.jpg', 0, ''),
(440, 32, '/UserFiles/Image/Trial/img32_19735.jpg', 0, ''),
(444, 33, '/UserFiles/Image/Trial/img33_15359.jpg', 0, ''),
(448, 34, '/UserFiles/Image/Trial/img34_52462.jpg', 0, ''),
(449, 34, '/UserFiles/Image/Trial/img34_84429.jpg', 0, ''),
(456, 36, '/UserFiles/Image/Trial/img36_11726.jpg', 0, ''),
(625, 68, '/UserFiles/Image/img68_15777.jpg', 0, ''),
(464, 39, '/UserFiles/Image/Trial/img39_20373.jpg', 0, ''),
(463, 39, '/UserFiles/Image/Trial/img39_24753.jpg', 0, ''),
(466, 40, '/UserFiles/Image/Trial/img40_23487.jpg', 0, ''),
(468, 40, '/UserFiles/Image/Trial/img40_95110.jpg', 0, ''),
(470, 40, '/UserFiles/Image/Trial/img40_39656.jpg', 0, ''),
(471, 41, '/UserFiles/Image/Trial/img41_20484.jpg', 0, ''),
(474, 42, '/UserFiles/Image/Trial/img42_11343.jpg', 0, ''),
(475, 42, '/UserFiles/Image/Trial/img42_51122.jpg', 0, ''),
(476, 42, '/UserFiles/Image/Trial/img42_38656.jpg', 0, ''),
(477, 43, '/UserFiles/Image/Trial/img43_10440.jpg', 0, ''),
(478, 43, '/UserFiles/Image/Trial/img43_40796.jpg', 0, ''),
(479, 43, '/UserFiles/Image/Trial/img43_15715.jpg', 0, ''),
(480, 43, '/UserFiles/Image/Trial/img43_11693.jpg', 0, ''),
(481, 44, '/UserFiles/Image/Trial/img44_28040.jpg', 0, ''),
(482, 44, '/UserFiles/Image/Trial/img44_38392.jpg', 0, ''),
(483, 44, '/UserFiles/Image/Trial/img44_20187.jpg', 0, ''),
(484, 44, '/UserFiles/Image/Trial/img44_17963.jpg', 0, ''),
(487, 45, '/UserFiles/Image/Trial/img45_19097.jpg', 0, ''),
(488, 45, '/UserFiles/Image/Trial/img45_21662.jpg', 0, ''),
(489, 45, '/UserFiles/Image/Trial/img45_10530.jpg', 0, ''),
(490, 46, '/UserFiles/Image/Trial/img46_41231.jpg', 0, ''),
(491, 46, '/UserFiles/Image/Trial/img46_52654.jpg', 0, ''),
(492, 46, '/UserFiles/Image/Trial/img46_27775.jpg', 0, ''),
(493, 46, '/UserFiles/Image/Trial/img46_82828.jpg', 0, ''),
(494, 47, '/UserFiles/Image/Trial/img47_20734.jpg', 0, ''),
(495, 47, '/UserFiles/Image/Trial/img47_20257.jpg', 0, ''),
(496, 47, '/UserFiles/Image/Trial/img47_10181.jpg', 0, ''),
(497, 47, '/UserFiles/Image/Trial/img47_88355.jpg', 0, ''),
(498, 48, '/UserFiles/Image/Trial/img48_33520.jpg', 0, ''),
(499, 48, '/UserFiles/Image/Trial/img48_14375.jpg', 0, ''),
(500, 48, '/UserFiles/Image/Trial/img48_39292.jpg', 0, ''),
(501, 48, '/UserFiles/Image/Trial/img48_16392.jpg', 0, ''),
(502, 49, '/UserFiles/Image/Trial/img49_35509.jpg', 0, ''),
(503, 49, '/UserFiles/Image/Trial/img49_79905.jpg', 0, ''),
(504, 49, '/UserFiles/Image/Trial/img49_14919.jpg', 0, ''),
(505, 49, '/UserFiles/Image/Trial/img49_16481.jpg', 0, ''),
(506, 50, '/UserFiles/Image/Trial/img50_11683.jpg', 0, ''),
(507, 50, '/UserFiles/Image/Trial/img50_10982.jpg', 0, ''),
(508, 50, '/UserFiles/Image/Trial/img50_20075.jpg', 0, ''),
(509, 50, '/UserFiles/Image/Trial/img50_17321.jpg', 0, ''),
(510, 51, '/UserFiles/Image/Trial/img51_12553.jpg', 0, ''),
(511, 51, '/UserFiles/Image/Trial/img51_10729.jpg', 0, ''),
(512, 51, '/UserFiles/Image/Trial/img51_34155.jpg', 0, ''),
(513, 51, '/UserFiles/Image/Trial/img51_20327.jpg', 0, ''),
(514, 52, '/UserFiles/Image/Trial/img52_49079.jpg', 0, ''),
(515, 52, '/UserFiles/Image/Trial/img52_27973.jpg', 0, ''),
(516, 52, '/UserFiles/Image/Trial/img52_40737.jpg', 0, ''),
(517, 52, '/UserFiles/Image/Trial/img52_36914.jpg', 0, ''),
(518, 53, '/UserFiles/Image/Trial/img53_60874.jpg', 0, ''),
(519, 53, '/UserFiles/Image/Trial/img53_34463.jpg', 0, ''),
(520, 53, '/UserFiles/Image/Trial/img53_22321.jpg', 0, ''),
(521, 53, '/UserFiles/Image/Trial/img53_40262.jpg', 0, ''),
(522, 54, '/UserFiles/Image/Trial/img54_31886.jpg', 0, ''),
(523, 54, '/UserFiles/Image/Trial/img54_23507.jpg', 0, ''),
(524, 54, '/UserFiles/Image/Trial/img54_22432.jpg', 0, ''),
(525, 54, '/UserFiles/Image/Trial/img54_11723.jpg', 0, ''),
(526, 55, '/UserFiles/Image/Trial/img55_83969.jpg', 0, ''),
(527, 55, '/UserFiles/Image/Trial/img55_25813.jpg', 0, ''),
(528, 55, '/UserFiles/Image/Trial/img55_16476.jpg', 0, ''),
(529, 55, '/UserFiles/Image/Trial/img55_26928.jpg', 0, ''),
(530, 56, '/UserFiles/Image/Trial/img56_13546.jpg', 0, ''),
(531, 56, '/UserFiles/Image/Trial/img56_33843.jpg', 0, ''),
(532, 56, '/UserFiles/Image/Trial/img56_28237.jpg', 0, ''),
(533, 56, '/UserFiles/Image/Trial/img56_26817.jpg', 0, ''),
(564, 39, '/UserFiles/Image/img39_20936.jpg', 0, ''),
(659, 77, '/UserFiles/Image/Trial/img77_10470.jpg', 0, ''),
(658, 77, '/UserFiles/Image/Trial/img77_19234.jpg', 0, ''),
(660, 77, '/UserFiles/Image/Trial/img77_30677.jpg', 0, ''),
(662, 79, '/UserFiles/Image/Trial/img79_42420.jpg', 0, ''),
(663, 79, '/UserFiles/Image/Trial/img79_11960.jpg', 0, ''),
(665, 80, '/UserFiles/Image/Trial/img80_10364.jpg', 0, ''),
(666, 80, '/UserFiles/Image/Trial/img80_22265.jpg', 0, ''),
(667, 80, '/UserFiles/Image/Trial/img80_21050.jpg', 0, ''),
(668, 80, '/UserFiles/Image/Trial/img80_29462.jpg', 0, ''),
(669, 81, '/UserFiles/Image/Trial/img81_15884.jpg', 0, ''),
(671, 81, '/UserFiles/Image/Trial/img81_19713.jpg', 0, ''),
(722, 94, '/UserFiles/Image/Trial/img94_36767.jpg', 0, ''),
(719, 94, '/UserFiles/Image/Trial/img94_29855.jpg', 0, ''),
(718, 93, '/UserFiles/Image/Trial/img93_32986.jpg', 0, ''),
(717, 93, '/UserFiles/Image/Trial/img93_12532.jpg', 0, ''),
(703, 87, '/UserFiles/Image/img87_40404.jpg', 0, ''),
(716, 93, '/UserFiles/Image/Trial/img93_61545.jpg', 0, ''),
(723, 94, '/UserFiles/Image/Trial/img94_16224.jpg', 0, ''),
(724, 94, '/UserFiles/Image/Trial/img94_25439.jpg', 0, ''),
(725, 78, '/UserFiles/Image/Trial/img78_38038.jpg', 0, ''),
(726, 78, '/UserFiles/Image/Trial/img78_23453.jpg', 0, ''),
(727, 95, '/UserFiles/Image/Trial/img95_12884.jpg', 0, ''),
(728, 95, '/UserFiles/Image/Trial/img95_26110.jpg', 0, ''),
(729, 95, '/UserFiles/Image/Trial/img95_23328.jpg', 0, ''),
(730, 95, '/UserFiles/Image/Trial/img95_36096.jpg', 0, ''),
(731, 96, '/UserFiles/Image/Trial/img96_16862.jpg', 0, ''),
(732, 97, '/UserFiles/Image/Trial/img97_38685.jpg', 0, ''),
(733, 97, '/UserFiles/Image/Trial/img97_18654.jpg', 0, ''),
(734, 97, '/UserFiles/Image/Trial/img97_11428.jpg', 0, ''),
(735, 97, '/UserFiles/Image/Trial/img97_31330.jpg', 0, ''),
(736, 98, '/UserFiles/Image/Trial/img98_27222.jpg', 0, ''),
(738, 99, '/UserFiles/Image/Trial/img99_90290.jpg', 0, ''),
(741, 99, '/UserFiles/Image/Trial/img99_10675.jpg', 0, ''),
(742, 99, '/UserFiles/Image/Trial/img99_16023.jpg', 0, ''),
(743, 100, '/UserFiles/Image/Trial/img100_30097.jpg', 0, ''),
(744, 100, '/UserFiles/Image/Trial/img100_98579.jpg', 0, ''),
(745, 100, '/UserFiles/Image/Trial/img100_24461.jpg', 0, ''),
(746, 100, '/UserFiles/Image/Trial/img100_30087.jpg', 0, ''),
(747, 101, '/UserFiles/Image/Trial/img101_31019.jpg', 0, ''),
(748, 101, '/UserFiles/Image/Trial/img101_10651.jpg', 0, ''),
(749, 101, '/UserFiles/Image/Trial/img101_13652.jpg', 0, ''),
(750, 101, '/UserFiles/Image/Trial/img101_21959.jpg', 0, ''),
(751, 101, '/UserFiles/Image/Trial/img101_26171.jpg', 0, ''),
(752, 102, '/UserFiles/Image/Trial/img102_29540.jpg', 0, ''),
(753, 102, '/UserFiles/Image/Trial/img102_23586.jpg', 0, ''),
(754, 102, '/UserFiles/Image/Trial/img102_27240.jpg', 0, ''),
(755, 102, '/UserFiles/Image/Trial/img102_19475.jpg', 0, ''),
(756, 103, '/UserFiles/Image/Trial/img103_26861.jpg', 0, ''),
(757, 103, '/UserFiles/Image/Trial/img103_22327.jpg', 0, ''),
(758, 104, '/UserFiles/Image/Trial/img104_35182.jpg', 0, ''),
(759, 104, '/UserFiles/Image/Trial/img104_18955.jpg', 0, ''),
(760, 104, '/UserFiles/Image/Trial/img104_17767.jpg', 0, ''),
(761, 104, '/UserFiles/Image/Trial/img104_90265.jpg', 0, ''),
(762, 105, '/UserFiles/Image/Trial/img105_71454.jpg', 0, ''),
(763, 105, '/UserFiles/Image/Trial/img105_86482.jpg', 0, ''),
(764, 105, '/UserFiles/Image/Trial/img105_16564.jpg', 0, ''),
(765, 105, '/UserFiles/Image/Trial/img105_21544.jpg', 0, ''),
(824, 132, '/UserFiles/Image/Trial/img132_10356.jpg', 0, ''),
(797, 92, '/UserFiles/Image/Trial/img92_31736.jpg', 0, ''),
(803, 112, '/UserFiles/Image/Trial/img112_98479.jpg', 0, ''),
(804, 112, '/UserFiles/Image/Trial/img112_39375.jpg', 0, ''),
(806, 116, '/UserFiles/Image/Trial/img116_20029.jpg', 0, ''),
(807, 116, '/UserFiles/Image/Trial/img116_29906.jpg', 0, ''),
(808, 117, '/UserFiles/Image/Trial/img117_37537.jpg', 0, ''),
(809, 117, '/UserFiles/Image/Trial/img117_24486.jpg', 0, ''),
(810, 117, '/UserFiles/Image/Trial/img117_16192.jpg', 0, ''),
(811, 118, '/UserFiles/Image/Trial/img118_42030.jpg', 0, ''),
(812, 118, '/UserFiles/Image/Trial/img118_30495.jpg', 0, ''),
(813, 112, '/UserFiles/Image/Trial/img112_30693.jpg', 0, ''),
(814, 119, '/UserFiles/Image/Trial/img119_39409.jpg', 0, ''),
(815, 119, '/UserFiles/Image/Trial/img119_29758.jpg', 0, ''),
(816, 119, '/UserFiles/Image/Trial/img119_29387.jpg', 0, ''),
(817, 120, '/UserFiles/Image/Trial/img120_42105.jpg', 0, ''),
(818, 120, '/UserFiles/Image/Trial/img120_75071.jpg', 0, ''),
(819, 120, '/UserFiles/Image/Trial/img120_37040.jpg', 0, ''),
(821, 121, '/UserFiles/Image/Trial/img121_42039.jpg', 0, ''),
(825, 132, '/UserFiles/Image/Trial/img132_30128.jpg', 0, ''),
(828, 133, '/UserFiles/Image/Trial/img133_35113.jpg', 0, ''),
(827, 133, '/UserFiles/Image/Trial/img133_21219.jpg', 0, ''),
(829, 134, '/UserFiles/Image/Trial/img134_20212.jpg', 0, ''),
(830, 134, '/UserFiles/Image/Trial/img134_22624.jpg', 0, ''),
(831, 135, '/UserFiles/Image/Trial/img135_38333.jpg', 0, ''),
(832, 135, '/UserFiles/Image/Trial/img135_42509.jpg', 0, ''),
(833, 136, '/UserFiles/Image/Trial/img136_39346.jpg', 0, ''),
(834, 136, '/UserFiles/Image/Trial/img136_40848.jpg', 0, ''),
(835, 137, '/UserFiles/Image/Trial/img137_15292.jpg', 0, ''),
(836, 137, '/UserFiles/Image/Trial/img137_11628.jpg', 0, ''),
(837, 138, '/UserFiles/Image/Trial/img138_18755.jpg', 0, ''),
(838, 138, '/UserFiles/Image/Trial/img138_69192.jpg', 0, ''),
(839, 139, '/UserFiles/Image/Trial/img139_79956.jpg', 0, ''),
(840, 139, '/UserFiles/Image/Trial/img139_16820.jpg', 0, ''),
(841, 140, '/UserFiles/Image/Trial/img140_30020.jpg', 0, ''),
(842, 140, '/UserFiles/Image/Trial/img140_13649.jpg', 0, ''),
(843, 141, '/UserFiles/Image/Trial/img141_35883.jpg', 0, ''),
(844, 141, '/UserFiles/Image/Trial/img141_34388.jpg', 0, ''),
(845, 142, '/UserFiles/Image/Trial/img142_14734.jpg', 0, ''),
(846, 142, '/UserFiles/Image/Trial/img142_38581.jpg', 0, ''),
(847, 143, '/UserFiles/Image/Trial/img143_35137.jpg', 0, ''),
(848, 143, '/UserFiles/Image/Trial/img143_13671.jpg', 0, ''),
(849, 144, '/UserFiles/Image/Trial/img144_21967.jpg', 0, ''),
(850, 144, '/UserFiles/Image/Trial/img144_21825.jpg', 0, ''),
(869, 149, '/UserFiles/Image/Trial/img149_28830.jpg', 0, ''),
(868, 149, '/UserFiles/Image/Trial/img149_73468.jpg', 0, ''),
(853, 145, '/UserFiles/Image/Trial/img145_39657.jpg', 0, ''),
(854, 146, '/UserFiles/Image/Trial/img146_22910.jpg', 0, ''),
(855, 146, '/UserFiles/Image/Trial/img146_32080.jpg', 0, ''),
(856, 146, '/UserFiles/Image/Trial/img146_22121.jpg', 0, ''),
(857, 147, '/UserFiles/Image/Trial/img147_12354.jpg', 0, ''),
(858, 147, '/UserFiles/Image/Trial/img147_66682.jpg', 0, ''),
(859, 147, '/UserFiles/Image/Trial/img147_39454.jpg', 0, ''),
(860, 147, '/UserFiles/Image/Trial/img147_17093.jpg', 0, ''),
(861, 148, '/UserFiles/Image/Trial/img148_23769.jpg', 0, ''),
(862, 148, '/UserFiles/Image/Trial/img148_18159.jpg', 0, ''),
(863, 148, '/UserFiles/Image/Trial/img148_37010.jpg', 0, ''),
(864, 148, '/UserFiles/Image/Trial/img148_27728.jpg', 0, ''),
(865, 145, '/UserFiles/Image/Trial/img145_42868.jpg', 0, ''),
(866, 145, '/UserFiles/Image/Trial/img145_28499.jpg', 0, ''),
(870, 149, '/UserFiles/Image/Trial/img149_13433.jpg', 0, ''),
(872, 149, '/UserFiles/Image/Trial/img149_32887.jpg', 0, ''),
(873, 150, '/UserFiles/Image/Trial/img150_41941.jpg', 0, ''),
(874, 151, '/UserFiles/Image/Trial/img151_40716.jpg', 0, ''),
(875, 151, '/UserFiles/Image/Trial/img151_26150.jpg', 0, ''),
(876, 151, '/UserFiles/Image/Trial/img151_35119.jpg', 0, ''),
(877, 151, '/UserFiles/Image/Trial/img151_20972.jpg', 0, ''),
(878, 152, '/UserFiles/Image/Trial/img152_31605.jpg', 0, ''),
(879, 152, '/UserFiles/Image/Trial/img152_95619.jpg', 0, ''),
(880, 152, '/UserFiles/Image/Trial/img152_23897.jpg', 0, ''),
(881, 152, '/UserFiles/Image/Trial/img152_10183.jpg', 0, ''),
(882, 153, '/UserFiles/Image/Trial/img153_38771.jpg', 0, ''),
(883, 153, '/UserFiles/Image/Trial/img153_10098.jpg', 0, ''),
(884, 153, '/UserFiles/Image/Trial/img153_62353.jpg', 0, ''),
(885, 154, '/UserFiles/Image/Trial/img154_64898.jpg', 0, ''),
(886, 154, '/UserFiles/Image/Trial/img154_13291.jpg', 0, ''),
(887, 154, '/UserFiles/Image/Trial/img154_55606.jpg', 0, ''),
(888, 154, '/UserFiles/Image/Trial/img154_25557.jpg', 0, ''),
(889, 155, '/UserFiles/Image/Trial/img155_38554.jpg', 0, ''),
(890, 155, '/UserFiles/Image/Trial/img155_31189.jpg', 0, ''),
(891, 156, '/UserFiles/Image/Trial/img156_19277.jpg', 0, ''),
(892, 156, '/UserFiles/Image/Trial/img156_24634.jpg', 0, ''),
(893, 156, '/UserFiles/Image/Trial/img156_23456.jpg', 0, ''),
(894, 156, '/UserFiles/Image/Trial/img156_73226.jpg', 0, ''),
(895, 157, '/UserFiles/Image/Trial/img157_17728.jpg', 0, ''),
(896, 158, '/UserFiles/Image/Trial/img158_39606.jpg', 0, ''),
(897, 158, '/UserFiles/Image/Trial/img158_17064.jpg', 0, ''),
(898, 158, '/UserFiles/Image/Trial/img158_26941.jpg', 0, ''),
(899, 159, '/UserFiles/Image/Trial/img159_26062.jpg', 0, ''),
(900, 159, '/UserFiles/Image/Trial/img159_29608.jpg', 0, ''),
(901, 159, '/UserFiles/Image/Trial/img159_26985.jpg', 0, ''),
(910, 160, '/UserFiles/Image/Trial/img160_15110.jpg', 0, ''),
(909, 160, '/UserFiles/Image/Trial/img160_23354.jpg', 0, ''),
(907, 160, '/UserFiles/Image/Trial/img160_13485.jpg', 0, ''),
(908, 160, '/UserFiles/Image/Trial/img160_20686.jpg', 0, ''),
(913, 161, '/UserFiles/Image/Trial/img161_11765.jpg', 0, ''),
(912, 161, '/UserFiles/Image/Trial/img161_16117.jpg', 0, ''),
(914, 161, '/UserFiles/Image/Trial/img161_40939.jpg', 0, ''),
(915, 162, '/UserFiles/Image/Trial/img162_30804.jpg', 0, ''),
(916, 162, '/UserFiles/Image/Trial/img162_10831.jpg', 0, ''),
(917, 162, '/UserFiles/Image/Trial/img162_18254.jpg', 0, ''),
(918, 162, '/UserFiles/Image/Trial/img162_16455.jpg', 0, ''),
(919, 163, '/UserFiles/Image/Trial/img163_67287.jpg', 0, ''),
(920, 163, '/UserFiles/Image/Trial/img163_38345.jpg', 0, ''),
(921, 163, '/UserFiles/Image/Trial/img163_30488.jpg', 0, ''),
(940, 164, '/UserFiles/Image/Trial/img164_21395.jpg', 0, ''),
(941, 164, '/UserFiles/Image/Trial/img164_11706.jpg', 0, ''),
(942, 164, '/UserFiles/Image/Trial/img164_33192.jpg', 0, ''),
(943, 165, '/UserFiles/Image/Trial/img165_29494.jpg', 0, ''),
(944, 165, '/UserFiles/Image/Trial/img165_17940.jpg', 0, ''),
(945, 166, '/UserFiles/Image/Trial/img166_16020.jpg', 0, ''),
(946, 166, '/UserFiles/Image/Trial/img166_28925.jpg', 0, ''),
(947, 167, '/UserFiles/Image/Trial/img167_26213.jpg', 0, ''),
(948, 167, '/UserFiles/Image/Trial/img167_81243.jpg', 0, ''),
(949, 168, '/UserFiles/Image/Trial/img168_22957.jpg', 0, ''),
(950, 168, '/UserFiles/Image/Trial/img168_27511.jpg', 0, ''),
(951, 168, '/UserFiles/Image/Trial/img168_30088.jpg', 0, ''),
(952, 169, '/UserFiles/Image/Trial/img169_37697.jpg', 0, ''),
(954, 169, '/UserFiles/Image/Trial/img169_15546.jpg', 0, ''),
(982, 180, '/UserFiles/Image/Trial/img180_56076.jpg', 0, ''),
(958, 171, '/UserFiles/Image/Trial/img171_41948.jpg', 0, ''),
(981, 180, '/UserFiles/Image/Trial/img180_12098.jpg', 0, ''),
(980, 179, '/UserFiles/Image/Trial/img179_28544.jpg', 0, ''),
(962, 171, '/UserFiles/Image/Trial/img171_35338.jpg', 0, ''),
(963, 172, '/UserFiles/Image/Trial/img172_81522.jpg', 0, ''),
(978, 178, '/UserFiles/Image/Trial/img178_42168.jpg', 0, ''),
(977, 178, '/UserFiles/Image/Trial/img178_41195.jpg', 0, ''),
(976, 177, '/UserFiles/Image/Trial/img177_33642.jpg', 0, ''),
(967, 174, '/UserFiles/Image/Trial/img174_40842.jpg', 0, ''),
(970, 175, '/UserFiles/Image/Trial/img175_15382.jpg', 0, ''),
(972, 175, '/UserFiles/Image/Trial/img175_11805.jpg', 0, ''),
(973, 176, '/UserFiles/Image/Trial/img176_22056.jpg', 0, ''),
(975, 176, '/UserFiles/Image/Trial/img176_19349.jpg', 0, ''),
(984, 181, '/UserFiles/Image/Trial/img181_20890.jpg', 0, ''),
(986, 189, '/UserFiles/Image/Trial/img189_17383.jpg', 0, ''),
(987, 190, '/UserFiles/Image/Trial/img190_79470.jpg', 0, ''),
(988, 191, '/UserFiles/Image/Trial/img191_11486.jpg', 0, ''),
(989, 191, '/UserFiles/Image/Trial/img191_16488.jpg', 0, ''),
(990, 192, '/UserFiles/Image/Trial/img192_38925.jpg', 0, ''),
(991, 192, '/UserFiles/Image/Trial/img192_10326.jpg', 0, ''),
(993, 184, '/UserFiles/Image/Trial/img184_22369.jpg', 0, ''),
(994, 184, '/UserFiles/Image/Trial/img184_19762.jpg', 0, ''),
(998, 193, '/UserFiles/Image/Trial/img193_42664.jpg', 0, ''),
(997, 193, '/UserFiles/Image/Trial/img193_14463.jpg', 0, ''),
(999, 194, '/UserFiles/Image/Trial/img194_42001.jpg', 0, ''),
(1000, 194, '/UserFiles/Image/Trial/img194_68660.jpg', 0, ''),
(1001, 195, '/UserFiles/Image/Trial/img195_12793.jpg', 0, ''),
(1002, 195, '/UserFiles/Image/Trial/img195_38660.jpg', 0, '');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_gbook`
--

CREATE TABLE IF NOT EXISTS `phpshop_gbook` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `datas` int(11) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `mail` varchar(32) DEFAULT NULL,
  `tema` text,
  `otsiv` text,
  `otvet` text,
  `flag` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_gbook`
--

INSERT INTO `phpshop_gbook` (`id`, `datas`, `name`, `mail`, `tema`, `otsiv`, `otvet`, `flag`) VALUES
(1, 1409740328, '�����', '', '����� �� 03-09-2014', '������� ������������ � ����� ���������! � ����� �� ������� ���� � ���� ��������� �������������) ������� ���� ������� ������ ������ ����������� � ������ ������, �� ������������ �������. ������� ������ �������� �����������, �� ��� �������, ��� �������� ����� ���������, ��� ��� ����� ������ ������ 2000 ������) ��� ������� ����������.', '�������, �����! ���� ���������!', '1'),
(3, 1409731200, '�����', 'mail@test.ru', '������� �������!', '�������� �� ���� ���������� �������� ������ ��������. ������ ��-������ ������������� � ����������.', '������������, �����.</p><p>���������� ��� �� ������������� ������!', '1');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_jurnal`
--

CREATE TABLE IF NOT EXISTS `phpshop_jurnal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(64) NOT NULL DEFAULT '',
  `datas` varchar(32) NOT NULL DEFAULT '',
  `flag` enum('0','1') NOT NULL DEFAULT '0',
  `ip` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_links`
--

CREATE TABLE IF NOT EXISTS `phpshop_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `image` text,
  `opis` text,
  `link` text,
  `num` int(11) DEFAULT NULL,
  `enabled` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_links`
--

INSERT INTO `phpshop_links` (`id`, `name`, `image`, `opis`, `link`, `num`, `enabled`) VALUES
(1, 'PHPShop Software', '', '�������� ��������-��������, ������ ��������-�������� PHPShop.', 'http://www.phpshop.ru', 5, '1'),
(2, 'PHPShop CMS Free', '', '���������� ��c���� ���������� ������ PHPShop CMS Free.', 'http://www.phpshopcms.ru', 3, '1'),
(3, '������ ��������-��������', '', 'Shopbuilder - ��� ����� SaaS ������ ������ ��������-��������, ����������� ������������� �� ��������� ������ ������� ����������� ���� ��������-�������� �� 599 ���.', 'http://www.shopbuilder.ru', 1, '1');

-- --------------------------------------------------------


--
-- ��������� ������� `phpshop_black_list`
--

CREATE TABLE IF NOT EXISTS `phpshop_black_list` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(32) DEFAULT '',
  `datas` varchar(32) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- ��������� ������� `phpshop_menu`
--

CREATE TABLE IF NOT EXISTS `phpshop_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `content` text,
  `flag` enum('0','1') DEFAULT '1',
  `num` int(11) DEFAULT '0',
  `dir` varchar(64),
  `element` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `flag` (`flag`),
  KEY `element` (`element`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_menu`
--

INSERT INTO `phpshop_menu` (`id`, `name`, `content`, `flag`, `num`, `dir`, `element`) VALUES
(1, '����������', '���������� ���������� ����������� - c����� PHPShop ��������� �����������, �� ��������� ��� ������������ ����������, �������� �� �������� ������������.', '1', 4, '/', '1'),
(2, '������ ��������', '������ �������� ������� ��� ������ ������� ��������-��������, ��� �� �������� ����������� � ��������� �������, ���������������� - ��� ������ ��������� ������ �������� �������.', '1', 2, '/', '0'),
(3, 'C����� � ������', '������������� ������ � ������ - �� ������ ����������, ������� 10% �� ������� ����������� ������. ����� ��������� ������������� ������, ������� ����������� � ��������.', '1', 3, '', '1'),
(4, '����������������', '������� ��������� ��� ���� �����. ������������ ������ ��� ��� ����� ��� ��, ��� � ����� ��������� �����������, � ������� ������ IDE � ����������� ����������.', '1', 3, '', '0');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_messages`
--

CREATE TABLE IF NOT EXISTS `phpshop_messages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PID` int(11) DEFAULT '0',
  `UID` int(11) DEFAULT '0',
  `AID` int(11) DEFAULT '0',
  `DateTime` datetime DEFAULT '1970-01-01 00:00:00',
  `Subject` text,
  `Message` text,
  `enabled` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `enabled` (`enabled`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules`
--

CREATE TABLE IF NOT EXISTS `phpshop_modules` (
  `path` varchar(255) DEFAULT '',
  `name` varchar(255) DEFAULT '',
  `date` int(11) DEFAULT '0',
  PRIMARY KEY (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_modules`
--

INSERT INTO `phpshop_modules` (`path`, `name`, `date`) VALUES
('button', 'Button', 1490694228),
('returncall', 'Return Call', 1490694228),
('visualcart', 'Visual Cart', 1490694228),
('oneclick', 'One Click', 1490694228),
('socauth', 'SocAuth', 1490694228),
('seourlpro', 'SeoUrlPro', 1490694228),
('netpay', 'NetPay', 1490694228);


-- --------------------------------------------------------


--
-- ��������� ������� `phpshop_modules_button_forms`
--

CREATE TABLE IF NOT EXISTS `phpshop_modules_button_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64)DEFAULT '',
  `content` text,
  `enabled` enum('0','1') DEFAULT '1',
  `num` tinyint(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_modules_button_forms`
--

INSERT INTO `phpshop_modules_button_forms` (`id`, `name`, `content`, `enabled`, `num`) VALUES
(1, '������� �������', '<!-- �������� ��� �������� ���� --><img src="/UserFiles/Image/Trial/cycounter.gif">\r\n<!-- �������� ��� �������� ���� -->\r\n<img src="/UserFiles/Image/Trial/metrika.png">\r\n', '1', 1);

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_button_system`
--

CREATE TABLE IF NOT EXISTS `phpshop_modules_button_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enabled` enum('0','1','2','3') DEFAULT '1',
  `serial` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_modules_button_system`
--

INSERT INTO `phpshop_modules_button_system` (`id`, `enabled`, `serial`) VALUES
(1, '0', '');

-- --------------------------------------------------------


--
-- ��������� ������� `phpshop_modules_key`
--

CREATE TABLE IF NOT EXISTS `phpshop_modules_key` (
  `path` varchar(64) NOT NULL DEFAULT '',
  `date` int(11) DEFAULT '0',
  `key` text,
  `verification` varchar(32) DEFAULT '',
  PRIMARY KEY (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------


--
-- ��������� ������� `phpshop_modules_oneclick_jurnal`
--

CREATE TABLE IF NOT EXISTS `phpshop_modules_oneclick_jurnal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT '0',
  `name` varchar(64) DEFAULT '',
  `tel` varchar(64)  DEFAULT '',
  `message` text,
  `product_name` varchar(64) DEFAULT '',
  `product_id` int(11),
  `product_price` varchar(64) DEFAULT '',
  `status` enum('1','2','3','4') DEFAULT '1',
  `ip` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_oneclick_system`
--

CREATE TABLE IF NOT EXISTS `phpshop_modules_oneclick_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enabled` enum('0','1','2') DEFAULT '1',
  `title` text,
  `title_end` text,
  `serial` varchar(64) DEFAULT '',
  `windows` enum('0','1') DEFAULT '0',
  `version` float DEFAULT '1.1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_modules_oneclick_system`
--

INSERT INTO `phpshop_modules_oneclick_system` (`id`, `enabled`, `title`, `title_end`, `serial`, `windows`, `version`) VALUES
(1, '0', '�������, ��� ����� ������!', '���� ��������� �������� � ���� ��� ��������� �������.', '', '1', 1.2);

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_returncall_jurnal`
--

CREATE TABLE IF NOT EXISTS `phpshop_modules_returncall_jurnal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT '0',
  `time_start` float DEFAULT '10',
  `time_end` float DEFAULT '18',
  `name` varchar(64) DEFAULT '',
  `tel` varchar(64) DEFAULT '',
  `message` text,
  `status` enum('1','2','3','4') DEFAULT '1',
  `ip` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_returncall_system`
--

CREATE TABLE IF NOT EXISTS `phpshop_modules_returncall_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enabled` enum('0','1','2') DEFAULT '1',
  `title` varchar(64) DEFAULT '',
  `title_end` text,
  `serial` varchar(64) DEFAULT '',
  `windows` enum('0','1') DEFAULT '0',
  `captcha_enabled` enum('1','2') DEFAULT '1',
  `version` float DEFAULT '1.4',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_modules_returncall_system`
--

INSERT INTO `phpshop_modules_returncall_system` (`id`, `enabled`, `title`, `title_end`, `serial`, `windows`, `captcha_enabled`, `version`) VALUES
(1, '1', '�������� ������', '������ �� �������� ������ �������, �����', '', '1', '1', 1.4);

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_seourlpro_system`
--

CREATE TABLE IF NOT EXISTS `phpshop_modules_seourlpro_system` (
  `id` int(11) NOT NULL auto_increment,
  `paginator` enum('1','2') default '1',
  `cat_content_enabled` enum('1','2') default '1',
  `serial` varchar(64) default '',
  `version` FLOAT(2) DEFAULT '1.5',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


--
-- ���� ������ ������� `phpshop_modules_seourlpro_system`
--

INSERT INTO `phpshop_modules_seourlpro_system` (`id`, `paginator`, `serial`, `version`) VALUES
(1, '1', '', 1);

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_socauth_system`
--

CREATE TABLE IF NOT EXISTS `phpshop_modules_socauth_system` (
  `id` smallint(1) NOT NULL DEFAULT '0',
  `authConfig` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_modules_socauth_system`
--

INSERT INTO `phpshop_modules_socauth_system` (`id`, `authConfig`) VALUES
(1, '');

-- --------------------------------------------------------


--
-- ��������� ������� `phpshop_modules_visualcart_memory`
--

CREATE TABLE IF NOT EXISTS `phpshop_modules_visualcart_memory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memory` varchar(64)DEFAULT '',
  `cart` text,
  `date` int(11) DEFAULT '0',
  `user` int(11) DEFAULT '0',
  `ip` varchar(64) DEFAULT '',
  `referal` text ,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_visualcart_system`
--

CREATE TABLE IF NOT EXISTS `phpshop_modules_visualcart_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enabled` enum('0','1','2') DEFAULT '1',
  `flag` enum('1','2') DEFAULT '1',
  `title` varchar(64) DEFAULT '',
  `pic_width` tinyint(100) DEFAULT '0',
  `memory` enum('0','1') DEFAULT '1',
  `serial` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_modules_visualcart_system`
--

INSERT INTO `phpshop_modules_visualcart_system` (`id`, `enabled`, `flag`, `title`, `pic_width`, `memory`, `serial`) VALUES
(1, '0', '1', '�������', 50, '1', '');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_news`
--

CREATE TABLE IF NOT EXISTS `phpshop_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datas` varchar(32) DEFAULT '',
  `zag` varchar(255) DEFAULT '',
  `kratko` text,
  `podrob` text,
  `datau` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_notice`
--

CREATE TABLE IF NOT EXISTS `phpshop_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `product_id` int(11) DEFAULT '0',
  `datas_start` varchar(64)DEFAULT '',
  `datas` varchar(64) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_opros`
--

CREATE TABLE IF NOT EXISTS `phpshop_opros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) unsigned DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `total` int(11) DEFAULT '0',
  `num` tinyint(32) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_opros`
--

INSERT INTO `phpshop_opros` (`id`, `category`, `name`, `total`, `num`) VALUES
(1, 1, '��', 23, 0),
(2, 1, '���������', 8, 0),
(3, 1, '�� �����', 8, 0),
(4, 2, '��, �� ������ ����� � ���', 67, 0),
(5, 2, '��, ����, ���� ���������� ������� ��� �����', 63, 0),
(6, 2, '���, �� ���� ������', 116, 0);

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_opros_categories`
--

CREATE TABLE IF NOT EXISTS `phpshop_opros_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `dir` varchar(32) DEFAULT '',
  `flag` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_opros_categories`
--

INSERT INTO `phpshop_opros_categories` (`id`, `name`, `dir`, `flag`) VALUES
(1, '��� �������� ����� ������?', '', '1');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_orders`
--

CREATE TABLE IF NOT EXISTS `phpshop_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datas` varchar(64) DEFAULT '',
  `uid` varchar(64) DEFAULT '0',
  `orders` blob,
  `status` text,
  `user` int(11) unsigned DEFAULT '0',
  `seller` enum('0','1')  DEFAULT '0',
  `statusi` tinyint(11)  DEFAULT '0',
  `country` varchar(255) DEFAULT '',
  `state` varchar(255) DEFAULT '',
  `city` varchar(255) DEFAULT '',
  `index` varchar(255) DEFAULT '',
  `fio` varchar(255) DEFAULT '',
  `tel` varchar(255) DEFAULT '',
  `street` varchar(255) DEFAULT '',
  `house` varchar(255) DEFAULT '',
  `porch` varchar(255) DEFAULT '',
  `door_phone` varchar(255) DEFAULT '',
  `flat` varchar(255) DEFAULT '',
  `delivtime` varchar(255) DEFAULT '',
  `org_name` varchar(255) DEFAULT '',
  `org_inn` varchar(255) DEFAULT '',
  `org_kpp` varchar(255) DEFAULT '',
  `org_yur_adres` varchar(255) DEFAULT '',
  `org_fakt_adres` varchar(255) DEFAULT '',
  `org_ras` varchar(255) DEFAULT '',
  `org_bank` varchar(255) DEFAULT '',
  `org_kor` varchar(255) DEFAULT '',
  `org_bik` varchar(255) DEFAULT '',
  `org_city` varchar(255) DEFAULT '',
  `dop_info` text,
  `sum` float,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

INSERT INTO `phpshop_orders` (`id`, `datas`, `uid`, `orders`, `status`, `user`, `seller`, `statusi`, `country`, `state`, `city`, `index`, `fio`, `tel`, `street`, `house`, `porch`, `door_phone`, `flat`, `delivtime`, `org_name`, `org_inn`, `org_kpp`, `org_yur_adres`, `org_fakt_adres`, `org_ras`, `org_bank`, `org_kor`, `org_bik`, `org_city`, `dop_info`, `sum`) VALUES
(1, '1451057196', '1-47', 0x613a323a7b733a343a2243617274223b613a353a7b733a343a2263617274223b613a333a7b693a3133323b613a31303a7b733a323a226964223b733a333a22313332223b733a343a226e616d65223b733a32313a22cfebe0f2fce520f7e5f0edeee52056657273616365223b733a353a227072696365223b733a353a223338343735223b733a333a22756964223b4e3b733a333a226e756d223b693a313b733a363a22776569676874223b4e3b733a363a2265645f697a6d223b733a333a22f8f22e223b733a393a227069635f736d616c6c223b733a34303a222f5573657246696c65732f496d6167652f547269616c2f696d673133325f3130333536732e6a7067223b733a363a22706172656e74223b693a303b733a343a2275736572223b4e3b7d693a3133333b613a31303a7b733a323a226964223b733a333a22313333223b733a343a226e616d65223b733a32373a22cfebe0f2fce520e4ebff20eaeeeaf2e5e9ebff2056657273616365223b733a353a227072696365223b733a353a223338303030223b733a333a22756964223b4e3b733a333a226e756d223b693a313b733a363a22776569676874223b4e3b733a363a2265645f697a6d223b733a333a22f8f22e223b733a393a227069635f736d616c6c223b733a34303a222f5573657246696c65732f496d6167652f547269616c2f696d673133335f3335313133732e6a7067223b733a363a22706172656e74223b693a303b733a343a2275736572223b4e3b7d693a3133373b613a31303a7b733a323a226964223b733a333a22313337223b733a343a226e616d65223b733a33383a22cfebe0f2fce520e8e720efebeef2edeee3ee20ece0f2e5f0e8e0ebe0204875676f20426f7373223b733a353a227072696365223b733a353a223338343735223b733a333a22756964223b4e3b733a333a226e756d223b693a313b733a363a22776569676874223b4e3b733a363a2265645f697a6d223b733a333a22f8f22e223b733a393a227069635f736d616c6c223b733a34303a222f5573657246696c65732f496d6167652f547269616c2f696d673133375f3131363238732e6a7067223b733a363a22706172656e74223b693a303b733a343a2275736572223b4e3b7d7d733a333a226e756d223b693a333b733a333a2273756d223b733a363a22313134393530223b733a363a22776569676874223b693a303b733a383a22646f737461766b61223b693a303b7d733a363a22506572736f6e223b613a31373a7b733a343a226f756964223b733a343a22312d3437223b733a343a2264617461223b733a31303a2231343531303537313936223b733a343a2274696d65223b733a383a2231393a333620706d223b733a343a226d61696c223b733a31353a22746573743340676d61696c2e636f6d223b733a31313a226e616d655f706572736f6e223b733a303a22223b733a383a226f72675f6e616d65223b733a303a22223b733a373a226f72675f696e6e223b733a303a22223b733a373a226f72675f6b7070223b733a303a22223b733a383a2274656c5f636f6465223b733a303a22223b733a383a2274656c5f6e616d65223b733a303a22223b733a383a226164725f6e616d65223b733a303a22223b733a31343a22646f737461766b615f6d65746f64223b733a313a2233223b733a383a22646973636f756e74223b733a313a2235223b733a373a22757365725f6964223b733a323a223136223b733a363a22646f735f6f74223b733a303a22223b733a363a22646f735f646f223b733a303a22223b733a31313a226f726465725f6d65746f64223b733a313a2233223b7d7d, 'a:2:{s:7:"maneger";s:0:"";s:4:"time";s:16:"25-12-2015 19:28";}', 16, '0', 3, '', '', '', '', '����� �������', '1234567890', '', '', '', '', '', '� 10 �� 19', '', '', '', '', '', '', '', '', '', '', '', 114950),
(2, '1451057227', '2-11', 0x613a323a7b733a343a2243617274223b613a353a7b733a343a2263617274223b613a333a7b693a3135313b613a31303a7b733a323a226964223b733a333a22313531223b733a343a226e616d65223b733a35333a22c2e8e4e5eeeae0ece5f0e020f6e8f4f0eee2e0ff20fdeaf8ed20476f50726f204865726f20332b20426c61636b2045646974696f6e223b733a353a227072696365223b733a343a2234373530223b733a333a22756964223b4e3b733a333a226e756d223b693a313b733a363a22776569676874223b4e3b733a363a2265645f697a6d223b733a333a22f8f22e223b733a393a227069635f736d616c6c223b733a34303a222f5573657246696c65732f496d6167652f547269616c2f696d673135315f3430373136732e6a7067223b733a363a22706172656e74223b693a303b733a343a2275736572223b4e3b7d693a3135323b613a31303a7b733a323a226964223b733a333a22313532223b733a343a226e616d65223b733a34303a22c2e8e4e5eeeae0ece5f0e020f6e8f4f0eee2e0ff20fdeaf8ed20536f6e79204844522d4153313030223b733a353a227072696365223b733a343a2235323235223b733a333a22756964223b4e3b733a333a226e756d223b693a313b733a363a22776569676874223b4e3b733a363a2265645f697a6d223b733a333a22f8f22e223b733a393a227069635f736d616c6c223b733a34303a222f5573657246696c65732f496d6167652f547269616c2f696d673135325f3331363035732e6a7067223b733a363a22706172656e74223b693a303b733a343a2275736572223b4e3b7d693a3135363b613a31303a7b733a323a226964223b733a333a22313536223b733a343a226e616d65223b733a33353a22c2e8e4e5eeeae0ece5f0e020f6e8f4f0eee2e0ff20fdeaf8ed205069766f7468656164223b733a353a227072696365223b733a353a223131343030223b733a333a22756964223b4e3b733a333a226e756d223b693a313b733a363a22776569676874223b4e3b733a363a2265645f697a6d223b733a333a22f8f22e223b733a393a227069635f736d616c6c223b733a34303a222f5573657246696c65732f496d6167652f547269616c2f696d673135365f3139323737732e6a7067223b733a363a22706172656e74223b693a303b733a343a2275736572223b4e3b7d7d733a333a226e756d223b693a333b733a333a2273756d223b733a353a223231333735223b733a363a22776569676874223b693a303b733a383a22646f737461766b61223b693a303b7d733a363a22506572736f6e223b613a31373a7b733a343a226f756964223b733a343a22322d3131223b733a343a2264617461223b733a31303a2231343531303537323237223b733a343a2274696d65223b733a383a2231393a303720706d223b733a343a226d61696c223b733a31353a22746573743340676d61696c2e636f6d223b733a31313a226e616d655f706572736f6e223b733a303a22223b733a383a226f72675f6e616d65223b733a303a22223b733a373a226f72675f696e6e223b733a303a22223b733a373a226f72675f6b7070223b733a303a22223b733a383a2274656c5f636f6465223b733a303a22223b733a383a2274656c5f6e616d65223b733a303a22223b733a383a226164725f6e616d65223b733a303a22223b733a31343a22646f737461766b615f6d65746f64223b693a333b733a383a22646973636f756e74223b733a313a2235223b733a373a22757365725f6964223b733a323a223136223b733a363a22646f735f6f74223b733a303a22223b733a363a22646f735f646f223b733a303a22223b733a31313a226f726465725f6d65746f64223b693a333b7d7d, 'a:2:{s:7:"maneger";s:0:"";s:4:"time";s:0:"";}', 16, '0', 0, '', '', '', '', '����� �������', '1234567890', '', '', '', '', '', '� 10 �� 19', '', '', '', '', '', '', '', '', '', '', '', NULL),
(3, '1451057270', '3-14', 0x613a323a7b733a343a2243617274223b613a353a7b733a343a2263617274223b613a323a7b693a3138393b613a31303a7b733a323a226964223b733a333a22313839223b733a343a226e616d65223b733a32313a22c6e5edf1eae0ff20f1f3eceae02056657273616365223b733a353a227072696365223b733a353a223135303030223b733a333a22756964223b4e3b733a333a226e756d223b693a313b733a363a22776569676874223b4e3b733a363a2265645f697a6d223b733a333a22f8f22e223b733a393a227069635f736d616c6c223b733a34303a222f5573657246696c65732f496d6167652f547269616c2f696d673138395f3137333833732e6a7067223b733a363a22706172656e74223b693a303b733a343a2275736572223b4e3b7d693a3139303b613a31303a7b733a323a226964223b733a333a22313930223b733a343a226e616d65223b733a32333a22d1f3eceae020e6e5edf1eae0ff204875676f20426f7373223b733a353a227072696365223b733a353a223435303030223b733a333a22756964223b4e3b733a333a226e756d223b693a313b733a363a22776569676874223b4e3b733a363a2265645f697a6d223b733a333a22f8f22e223b733a393a227069635f736d616c6c223b733a34303a222f5573657246696c65732f496d6167652f547269616c2f696d673139305f3739343730732e6a7067223b733a363a22706172656e74223b693a303b733a343a2275736572223b4e3b7d7d733a333a226e756d223b693a323b733a333a2273756d223b733a353a223630303030223b733a363a22776569676874223b693a303b733a383a22646f737461766b61223b693a303b7d733a363a22506572736f6e223b613a31373a7b733a343a226f756964223b733a343a22332d3134223b733a343a2264617461223b733a31303a2231343531303537323730223b733a343a2274696d65223b733a383a2231393a353020706d223b733a343a226d61696c223b733a31353a22746573743340676d61696c2e636f6d223b733a31313a226e616d655f706572736f6e223b733a303a22223b733a383a226f72675f6e616d65223b733a303a22223b733a373a226f72675f696e6e223b733a303a22223b733a373a226f72675f6b7070223b733a303a22223b733a383a2274656c5f636f6465223b733a303a22223b733a383a2274656c5f6e616d65223b733a303a22223b733a383a226164725f6e616d65223b733a303a22223b733a31343a22646f737461766b615f6d65746f64223b693a333b733a383a22646973636f756e74223b733a313a2235223b733a373a22757365725f6964223b733a323a223136223b733a363a22646f735f6f74223b733a303a22223b733a363a22646f735f646f223b733a303a22223b733a31313a226f726465725f6d65746f64223b693a333b7d7d, 'a:2:{s:7:"maneger";s:0:"";s:4:"time";s:0:"";}', 16, '0', 0, '', '', '', '', '����� �������', '1234567890', '', '', '', '', '', '� 10 �� 19', '', '', '', '', '', '', '', '', '', '', '', NULL);


--
-- ��������� ������� `phpshop_order_status`
--

CREATE TABLE IF NOT EXISTS `phpshop_order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `color` varchar(64) DEFAULT '',
  `sklad_action` enum('0','1') DEFAULT '0',
  `cumulative_action` ENUM('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_order_status`
--

INSERT INTO `phpshop_order_status` (`id`, `name`, `color`, `sklad_action`) VALUES
(1, '�����������', 'red', '0'),
(2, '�����������', '#99cccc', '0'),
(3, '������������', '#ff9900', '0'),
(4, '��������', '#ccffcc', '1'),
(100, '�������� � �����������', '#ffff33', '0');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_page`
--

CREATE TABLE IF NOT EXISTS `phpshop_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `link` varchar(64) DEFAULT '',
  `category` int(11) DEFAULT '0',
  `keywords` text,
  `description` varchar(255) DEFAULT '',
  `content` text,
  `flag` varchar(16) DEFAULT '1',
  `num` smallint(3) DEFAULT '0',
  `datas` int(11) DEFAULT '0',
  `odnotip` text,
  `title` varchar(255) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '0',
  `secure` enum('0','1') DEFAULT '0',
  `secure_groups` varchar(255) DEFAULT '',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `link` (`link`),
  FULLTEXT KEY `content` (`content`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_page`
--

INSERT INTO `phpshop_page` (`id`, `name`, `link`, `category`, `keywords`, `description`, `content`, `flag`, `num`, `datas`, `odnotip`, `title`, `enabled`, `secure`, `secure_groups`) VALUES
(1, '���������� ��� �� ��������� PHPShop @version@', 'index', 2000, '', '', '<p><img style="float: left; margin: 0px 10px 10px 0px;" alt="" src="/UserFiles/Image/Trial/box.png">������������ PHPShop 5 - ����� ������ ��������-��������, � ������� �� \n��������� ����������� ���-���������� � ��� 12-������ ���� �������� � \n��������� ��������-���������. ������� PHPShop 5 - ��� HTML5, Bootstrap, \nJQuery,  ����������� ��������� ������������, �������������� ������� � \n����������� � ���������� ��������.\n</p>\n<p><strong></strong>\n</p>\n<p>PHPShop - ��� ����� <strong>����������� ��������</strong> ��� �������� � ���������� ��������-���������. ����� ������ PHP-������� ��� ������� ������ � ��������� ������� �� �������,  ���������� ����������� ����� �������������� <strong>���������� Windows ������</strong>, ������������ � ����� <a target="_blank" href="http://phpshop.ru/loads/files/setup.exe">EasyControl</a>. ������� ������� �� 4 ������ �� ����������: ���������� �������� ����, ���������� ��������, ��������� ������� �������� � ����������� ������������.\n</p>\n<p>� ������ ��������� ������, ���������� ������� <strong></strong><a target="_blank" href="http://faq.phpshop.ru/page/batch-loading.html">PriceLoader</a><strong></strong> ��� ����������� ��������� �����-������ �����������, �������������� �������� � ���������� ������������ � ��� �������. ��� �� PriceLoader ��������� ������ ����� �������� ���� �� ������ ���� ������.������� (YML-�����), ������� ��������� � ������������ ����������� � �������, ������� � ������� ���������� �����������, ���������� �������� ������ �� ����� ���� ����� ������.�������. ��� �� ����������� ������ ��������� �������� �������, ���������� <strong>���� ��� ��������� PriceLoader</strong> �� �������������� ��������� � ������������� ���.\n</p>\n<p>������� Order Agent, Monitor, Chat �������� ������������ <strong>�������� � ��������� ����� �������</strong>, �������� ���������� ��������� � �������� � �������������� ����� � ������� <strong>���������� ����</strong> ���������� Chat.<br>\n</p>\n<p>� ������� ������� ���������� ��������� �������  <strong></strong><a target="_blank" href="http://wiki.phpshop.ru/index.php/PHPShop_Editor">Editor</a>, ���������� ��������� ��������-�������� <strong>��� �������</strong> � ������������� <strong>Server Synhronizer</strong>  ����� ����� �� ����� ��������� ���������� ��������� ������� ��� ��������, ��������� ��� �������� (��������, ����� PriceLoader ��� 1�), ��������� ��� ������� � ������, � ����� ����� ������ <a target="_blank" href="http://faq.phpshop.ru/page/synch.html">����������������</a> ��������� � ������� ������. ��� ��������� ���� ����� � �� ��������� ����������� ����������� � ���������.\n</p>\n<p>� ��������� ������ ��������� ������� ��� ������������ PHP �������� �� �������. Installer � <strong>Updater</strong> ��������� ���������� � �������� PHPShop � 3 �����. ����� ����� ����������  ���������� ������� � ����� ������� �������� ������ ����� � ������� ������. ������������� ���������� �������� ������� � ��������� ��� ����������� �����������. ��� <strong>�������������� ����������� ������</strong> ������������ <a target="_blank" href="http://wiki.phpshop.ru/index.php/Password_Restore_Help">PasswordRestore</a>. SiteLock ������� �������� ���� ��������������� ������ ������������ ��������. <strong></strong>��������������� ����� ����������<strong> </strong><a target="_blank" href="http://wiki.phpshop.ru/index.php/PHPShop_IDE">IDE</a><strong></strong> �������� ��������� ���������� ������������� ��� ���������� ������������ PHPShop � ��������� ����������� �������.\n</p>\n<p>��� ������������� 1� ���������� ����������� ���������������� ���������� ������������� � ��������� ������� � PHPShop. ������ ��������� ���������� <a target="_blank" href="http://phpshop.ru/page/1c.html">������������� ��������-�������� � 1�</a> ������� ������� ������������� ������ �������. ���������� ��������� ��������� ������ ������������� ����� �������������  �������� ����� ������� �������.\n</p>\n<p>�� ����� ����������� �������� ��� ����������� ���������� ����� ��������� � <a target="_blank" href="https://help.phpshop.ru">������ ����������� ���������</a>. �� ��������� <strong>������ ������ �����</strong>, � ��� ����� �������� ����������� <a target="_blank" href="http://phpshop-design.ru/page/brif-design.html">������������� �������</a> ��� ��������� �������������.\n</p>\n<blockquote>�� ������ ���������� ��������-�������� ��� 12 ���, - �������� ���� ������ ������� �������������!\n<footer class="text-right"><cite>������� PHPShop Software</cite></footer>\n</blockquote>', '', 0, 1458900915, '', '', '1', '0', ''),
(24, '������', 'design', 1000, '', '', '<p>� �������� ��������-�������� PHPShop @version@ ������ 17 �������� � ��������� �������������� �������� ��������. � ������������ ����� �������� ������ 8 ����� ���������� ���������� ��������, ��������� ������� ����� ���������� �� ������ ���������� � ������� <kbd>���������</kbd> - <kbd>������� �������</kbd>\n</p>\n<a href="?skin=diggi"><img class="template" title="diggi" src="/UserFiles/Image/Trial/template_icon/diggi.gif" alt="" width="150" height="120"></a><a href="?skin=spice"><img class="template" title="spice" src="/UserFiles/Image/Trial/template_icon/spice.gif" alt="" width="150" height="120"></a><a href="?skin=astero"><img class="template" title="astero" src="/UserFiles/Image/Trial/template_icon/astero.gif" alt="" width="150" height="120"></a>
<a href="?skin=bootstrap"><img class="template" title="bootstrap" src="/UserFiles/Image/Trial/template_icon/bootstrap.gif" alt="" width="150" height="120"></a><a href="?skin=bootstrap_fluid"><img class="template" title="bootstrap_fluid" src="/UserFiles/Image/Trial/template_icon/bootstrap_fluid.gif" alt="" width="150" height="120"></a><a href="?skin=white_brick"><img class="template" title="white_brick" src="/UserFiles/Image/Trial/template_icon/white_brick.gif" alt="" width="150" height="120"></a><a href="?skin=variaty"><img class="template" title="variaty" src="/UserFiles/Image/Trial/template_icon/variaty.gif" alt="" width="150" height="120"></a><a href="?skin=mobile"><img class="template" title="mobil" src="/UserFiles/Image/Trial/template_icon/mobile.gif" alt="" width="150" height="120"></a>\n<h2>���������  �������</h2>\n��� �������������� ������� �� ������ ���������� ������������ ������� <strong>�������� ��������</strong>.\n<p><a title="���������� Template Edit" href="http://faq.phpshop.ru/page/template-edit.html" target="_blank"><img class="template" src="/UserFiles/Image/Trial/template_edit.jpg" alt="" width="95%"></a>\n</p>\n<p>��� �������������� ������� �� ��������� ���������� ��� �����������  Windows ���������� <strong>���������� ��������</strong> ��������  PHPShop Editor.\n</p>\n<p><a title="���������� PHPShop Editor" href="http://faq.phpshop.ru/page/your-design.html" target="_blank"><img class="template" src="/UserFiles/Image/Trial/phpshop_editor.jpg" alt="PHPShop Editor" width="95%"></a>\n</p>\n<h2>������������  ������</h2>\n������-���� <a href="http://phpshop-design.ru" target="_blank">PHPShop.Design</a> ������ ������� ������ ���  PHPShop, � ������, �������������� ��� �������� ������� �� ����������, �  �� �������� ���������� ���������������� ������ � ����, ���������� ����  ����������� ������������ ���.\n<ol>\n	<li>�� �� 100% ����� ���� ���������, � ��� ������, ���  ��� �� �������� ������������� �� ���� ������ ���������, �� ��������� �  PHPShop. </li>\n	<li>�� ��������� ��������� ��� ���������������� PHPShop  ��� �� ������ ����� ��� ��������, � �� �������� ����������  ��������-������� �����, ����� �� ��� ������ �� ������������ ���� ������. </li>\n	<li>����������� ���������, ����� �����������  ������������� � ��� ���������, �� ����� ������ PHPShop 5,  ������������ � ������� "������-�����", - ��� ������, ��� � ������� ��  ������� ����������� ��� ������ ���������. </li>\n	<li>�� ��������� �����, � ������������� �������� - ����  ����� ���������� ������� �� �������� ������� � ����� �������  ��  �������� ���. </li>\n</ol>\n<p>��� ������ ������������� ������� ����� ��������� ����, � ������� ��  ������������ ������� ������, ��� ����������� ������� �������� � �����  �������������. C��� �������� ������ ������� - 15 �������  ����\n</p>\n<a href="http://phpshop-design.ru/page/brif-design.html" target="_blank" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-share-alt"></span> ���� �� ������������ ������ �����</a>', '1', 1, 1477663500, '', '�������������� ������� PHPShop', '1', '0', ''),
(26, '������', 'purchase', 1000, '', '', '<div>��� �������� ��������-������� <strong>@serverName@</strong> �� ���� ��������� PHPShop @version@ ����� �������� 30 ����. <strong>�� ������ ��� ������ ��������� ���� �������, ��� ������ ����� ������� ����������!�</strong>����� <strong>���������� �������� PHPShop</strong>, ��� ����������� <strong>��������� ���� ���� ���� ��������</strong>, ��� ����������� �������� ���� ��������� ����������.\n<p>��� ������������ ������������ ����������� PHPShop, ����� ������� � ������ ���������� ������ �� ������ ����. �����, ��� ����� ������� ������� ��� ������ - �����������: ������� Visa, Mastercard, ����� ��������� Qiwi, ����� ��������, ���������� ��������� ��� ����������� ���. ����� ������ ������, � ������� ����� �������� ���� �� ������ � ����������� ����. ��������� ���� ���������� �� ���������� �� �����, ��������� � ������� ������� ������ ������� ��������.</p>\n<p><a class="btn btm-sm btn-primary" target="_blank" href="http://www.phpshop.ru/order/?from=@serverName@&action=order">������� � ���������� ������ PHPShop</a><p>�</p>\n<h2>������������</h2>\n<p>�� ����� ���� ������ ��� � ��� � ����� � ������������ �� ������� � 10:00 �� 19:00. �� �������� ������������ ��� � ������� �� ��������.</p>\n<p><b>���: +7 (495) 989-11-15</b></p>\n<p>�����: ��������� ��������, �. 24 ����. 2, 2 ����, ���� 3., �. ��������� ��������. ������-����� "�����-�����".</p>\n<p><iframe src="https://www.google.ru/maps?f=q&source=s_q&hl=ru&geocode=FbEtUgMdgq5AAg%3BFaQ8UgMdCWhAAiGO9hUAe8ehdCm1mSQod7VKQTGO9hUAe8ehdA&q=%D0%A0%D1%8F%D0%B7%D0%B0%D0%BD%D1%81%D0%BA%D0%B8%D0%B9 %D0%BF%D1%80%D0%BE%D1%81%D0%BF., 24 %D0%BA%D0%BE%D1%80%D0%BF%D1%83%D1%81 2, %D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0&aq=1&oq=%D1%80%D1%8F%D0%B7%D0%B0%D0%BD%D1%81%D0%BA%D0%B8%D0%B9 %D0%BF%D1%80%D0%BE%D1%81%D0%BF%D0%B5%D0%BA%D1%82 &sll=55.720729,37.774676&sspn=0.004061,0.011362&ie=UTF8&hq=&hnear=%D0%A0%D1%8F%D0%B7%D0%B0%D0%BD%D1%81%D0%BA%D0%B8%D0%B9 %D0%BF%D1%80%D0%BE%D1%81%D0%BF., 24 %D0%BA%D0%BE%D1%80%D0%BF%D1%83%D1%81 2, %D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0, %D0%B3%D0%BE%D1%80%D0%BE%D0%B4 %D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0&t=m&start=0&ll=55.725805,37.774343&spn=0.016918,0.036478&z=14&iwloc=A&output=embed" frameborder="0" scrolling="no" height="350" width="100%"></iframe><br /><small><a style="color: #0000ff; text-align: left;" href="https://www.google.ru/maps?f=q&source=embed&hl=ru&geocode=FbEtUgMdgq5AAg%3BFaQ8UgMdCWhAAiGO9hUAe8ehdCm1mSQod7VKQTGO9hUAe8ehdA&q=%D0%A0%D1%8F%D0%B7%D0%B0%D0%BD%D1%81%D0%BA%D0%B8%D0%B9 %D0%BF%D1%80%D0%BE%D1%81%D0%BF., 24 %D0%BA%D0%BE%D1%80%D0%BF%D1%83%D1%81 2, %D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0&aq=1&oq=%D1%80%D1%8F%D0%B7%D0%B0%D0%BD%D1%81%D0%BA%D0%B8%D0%B9 %D0%BF%D1%80%D0%BE%D1%81%D0%BF%D0%B5%D0%BA%D1%82 &sll=55.720729,37.774676&sspn=0.004061,0.011362&ie=UTF8&hq=&hnear=%D0%A0%D1%8F%D0%B7%D0%B0%D0%BD%D1%81%D0%BA%D0%B8%D0%B9 %D0%BF%D1%80%D0%BE%D1%81%D0%BF., 24 %D0%BA%D0%BE%D1%80%D0%BF%D1%83%D1%81 2, %D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0, %D0%B3%D0%BE%D1%80%D0%BE%D0%B4 %D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0&t=m&start=0&ll=55.725805,37.774343&spn=0.016918,0.036478&z=14&iwloc=A" target="_blank">����������� ����������� �����</a></small></p>\n</div>', '1', 1, 1455711721, '', '������ PHPShop', '1', '0', ''),
(25, '�������������', 'developers', 1000, '', '', '<div>� ������ ������������� PHPShop Software ����������� ���������� ��������������� ����� ���������� <strong>PHPShop IDE</strong> � ���������� �������� �������� <strong>PHPShop Editor</strong>.\n<h3>PHPShop IDE</h3>\n<p>PHPShop IDE �������� �������� ������������� � �������� ������� �������������� ����, �������������� �� ������� ���� ������������� �� �������� �� ��������������.</p>\n<p><strong>�����������:</strong></p>\n<ol>\n<li class="trial">������� � �������������� ���������� ������� PHPShop API </li>\n<li>������� � ����������� �������������� ���������� ������� ����� ���� �������� </li>\n<li>������� ������ � ����� ������������ HTML � PHP �������� </li>\n<li>�������������� �������� ����� ������� � ��������� </li>\n<li>���������� ����� ������������ ����� ������� XML-���� �������� </li>\n<li>�������������� �������� ������� </li>\n<li>�������������� � ������������ ���� </li>\n<li>�������� �������� � ���� ��� �������� ������� � �������� ���� </li>\n</ol>\n<p>�</p>\n<p><a title="���������� PHPShop IDE" href="http://wiki.phpshop.ru/index.php/PHPShop_IDE" target="_blank"><img class="template" src="/UserFiles/Image/Trial/phpshop_ide.jpg" alt="PHPShop IDE"></a></p>\n<h3>PHPShop Editor</h3>\n<p>PHPShop Editor ��������� �������������� ������ ������� �����, ������� �������� �������� �������, ��������� ����� ���������� ����������� ����������� ������������� � ���������� ������.</p>\n<p><strong>����� ����������� ���������� � ��������������</strong> ��������� ������ ������� � ��������� ����� ���������� ������ �������: ��������, ���������, ���������� � �.�. ����� ����� ���������� � ����� �����, ������� �� �������. �������������� ����� HTML-��������� ���� ��� ���������� �����.</p>\n<strong>������ ����������</strong> ���� ����������� ����� ���������� �������� ������ �������� ����� ���������� CSS: ��������, �����, �����, ������, �������, ������ ��������� �������.\n<p>�</p>\n<p><strong>����� ������ HTML ����</strong> ������ ��� ��������� ���� ������� � �������� ��������������� ��������� �������. � ����� ����� �������, ����� ������ ������� ���� �� ������ ����� � ������ � ���� ����� ��������������. ��� �������� ���������� � ���� ������ ������ � ��������� ���������� ������ ��������. ��� ������� ������� ��������� ��������� ���������� � ��������� ��� ������������� � �������.</p>\n<p><a title="���������� PHPShop Editor" href="http://wiki.phpshop.ru/index.php/PHPShop_Editor" target="_blank"><img class="template" src="/UserFiles/Image/Trial/phpshop_editor.jpg" alt="PHPShop Editor"></a></p>\n<p><strong>����� 20 ���������� ������ ��� ������ � PHPShop</strong> ������� � ����� <a title="�������� ��� ��� EasyControl" href="http://wiki.phpshop.ru/index.php/PHPShop_EasyControl" target="_blank">EasyControl</a> � �������� ��� �������� �� ����� ������������ � ������� <a title="����� �������� PHPShop" href="http://phpshop.ru/page/downloads.html" target="_blank">����� ��������</a>.</p>\n</div>', '1', 1, 1455631148, '', '������������� PHPShop', '0', '0', ''),
(23, '�����������������', 'admin', 1000, '', '', '<div>��� ������� � ������ ���������� PHPShop ������� ��������� ������ <kbd>Ctrl</kbd>   <kbd>F12</kbd> ��� ����������� ������ �������� ����.<br /> ����� �� ��������� <strong>demo</strong>, ������ <strong>demouser</strong>. ���� �� ��� ��������� ������ ���� ����� � ������, �� ����������� ���� ������ ��� �����������.\n<p><a href="..phpshop/admpanel/" target="_blank" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-share-alt"></span> ������� � ������ ����������</a></p>\n<h2>�������� ����</h2>\n��� ��������� �������� ����������� �������� �������� ���� ��� ������������ ������������ ���������. ��� ������� �������� ���� ������� � ������ ���������� ��������� ������� � ���� <kbd>����</kbd> - <kbd>SQL ������ � ����</kbd> ������� � ���������� ������ ����� <strong>"�������� ����"</strong>. �������� ���� ��������, ��� ��������� ��� �������� ���� � ������� ������ ������ ��������.\n<h2>�������������� �������</h2>\nPHPShop EasyControl - <strong>���������� �����  ���������� ������</strong> ��� �������� � ���������� ��������-��������� PHPShop �� ��������� ���������� . EasyControl ����� � ��������� � �� ������� ������� ����������� �������. � ������� EasyControl �� ������� ���������� ���� �������� �� �� ���� �� �������, ��������� ��������� �����, ������������ ������, ��������� �������� ���� � ������������� �������. � ������ ������ ������ 20 ������: <strong>Order Agent, Monitor, Updater, Installer, Chat,  Price Loader, Editor, IDE, Password Restore</strong> � ������.\n<p><a href="http://www.phpshop.ru/loads/files/setup.exe" target="_blank" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-share-alt"></span> ������� ������� EasyControl</a></p>\n</div>', '1', 1, 1455711992, '39,40', '����������������� PHPShop', '1', '0', ''),
(27, '�������', 'help', 4, '', '', '<h3>�������</h3> ���������-�������������� ���� (F.A.Q.), ����������� ����������� PHPShop � ������ �� ������ ������� �� ���������� ��������-���������. ������� ������� ����������� ���������� � �����-������.<br>�����: <a href="http://faq.phpshop.ru" target="_blank">faq.phpshop.ru</a><h3>����������� ������������</h3> ���������� ���� ��� ������������� (WIKI). �������� ������� ���������� ����������� ������������ � ��������� �� ���������� PHPShop. �������� ������ EasyControl � �������������� �������.<br>�����: <a href="http://wiki.phpshop.ru" target="_blank">wiki.phpshop.ru</a><h3>�������� API</h3> ���������� ���� ��� ������������� (PHPDoc). �������� ��������� �������� API PHPShop, ������� � �������.<br>�����: <a href="http://doc.phpshop.ru" target="_blank">doc.phpshop.ru</a><h3>���� ������</h3> ���������� ���� ������ ����������� ���������. �������� ������ �� �������� ������ ��������, ������������� � ������������� PHPShop � ���������.<br>�����: <a href="https://help.phpshop.ru" target="_blank">help.phpshop.ru</a><h3>���������� ����</h3> ������������ ��������� � ���������� ���������� �����. �������� ����� ���������� ���������� �� ������������ ���������, �������� � ������.<br>�����: <a href="https://www.facebook.com/shopsoft" target="_blank">https://www.facebook.com/shopsoft</a><br><a href="https://twitter.com/PHPShopCMS" target="_blank">https://twitter.com/PHPShopCMS</a><br><a href="https://plus.google.com/+PhpshopRu" target="_blank">https://plus.google.com/+PhpshopRu</a><h3>�����-�����</h3> �������������� ������ � �����-������� �� ������ � PHPShop �� ������� YouTube. �������� ��������� ����� �� ��������� � ������ � 1�-��������������, PHPShop � ��������� EasyControl.<br>�����: <a href="http://www.youtube.com/user/phpshopsoftware" target="_blank">http://www.youtube.com/user/phpshopsoftware</a>', '1', 1, 0, '', '', '1', '0', ''),
(28, '�������� � ������', 'forma', 0, '', '', '', '1', 1, 0, '', '', '1', '0', ''),
(21, 'R�vlon', 'revlon', 3, '', '', '<p><strong>Revlon</strong> �������� �������� ���������� ������� � ������� ���������, ����� �� �����, ���������� � ������ ������� � ������� ������� �� ����� ���������.</p>\r\n<p><a href="../../../selection/?v[51]=142">�������� ��� ������ ������</a></p>', '1', 1, 0, '', '', '1', '0', ''),
(22, '������� ������ ��� ������ Visa � Mastercard', 'agreement', 0, '', '', '', '1', 1, 0, '', '', '1', '0', ''),
(32, 'Lancome', 'lancome', 3, '', '', '<p><strong>Clarins</strong> �������� �������� ���������� ������� � ������� ���������, ����� �� �����, ���������� � ������ ������� � ������� ������� �� ����� ���������.</p>\r\n<p><a href="../../../selection/?v[51]=146">�������� ��� ������ ������</a></p>', '1', 1, 0, '', '', '1', '0', ''),
(34, 'Dior', 'dior', 3, '', '', '<p><strong>Dior</strong>&nbsp;�������� �������� ���������� ������� � ������� ���������, ����� �� �����, ���������� � ������ ������� � ������� ������� �� ����� ���������.&nbsp;</p>\r\n<p><a href="../../../selection/?v[51]=140">�������� ��� ������ ������</a></p>', '1', 1, 0, '', '', '1', '0', ''),
(33, 'Clarins', 'clarins', 3, '', '', '<p><strong>Clarins</strong>&nbsp;�������� �������� ���������� ������� � ������� ���������, ����� �� �����, ���������� � ������ ������� � ������� ������� �� ����� ���������.</p>\r\n<p><a href="../../../selection/?v[51]=139">�������� ��� ������ ������</a></p>', '1', 1, 0, '', '', '1', '0', ''),
(35, 'Payot', 'payot', 3, '', '', '<p><strong>Payot</strong> �������� �������� ���������� ������� � ������� ���������, ����� �� �����, ���������� � ������ ������� � ������� ������� �� ����� ���������.</p>\r\n<p><a href="../../../selection/?v[51]=141">�������� ��� ������ ������</a></p>', '1', 1, 0, '', '', '1', '0', ''),
(36, 'Canon', 'canon', 3, '', '', '<p>�������� <strong>Canon</strong> - ������� ����� � ����� ������������ �������� ��������� � ������� ��� ��������� �����������, ��������������� ��� ���� � �����.</p>\r\n<p><a href="../../../selection/?v[53]=147">�������� ��� ������ ������</a></p>', '1', 1, 0, '', '', '1', '0', ''),
(37, 'Nikon', 'nikon', 3, '', '', '<p>��������&nbsp;<strong>Nikon</strong>&nbsp;- ������� ����� � ����� ������������ �������� ��������� � ������� ��� ��������� �����������, ��������������� ��� ���� � �����.</p>\r\n<p><a href="../../../selection/?v[53]=148">�������� ��� ������ ������</a></p>', '1', 1, 0, '', '', '1', '0', ''),
(38, 'Sony', 'sony', 3, '', '', '<p>��������&nbsp;<strong>Sony</strong>&nbsp;- ������� ����� � ����� ������������ �������� ��������� � ������� ��� ��������� �����������, ��������������� ��� ���� � �����.</p>\r\n<p><a href="../../../selection/?v[53]=149">�������� ��� ������ ������</a></p>', '1', 1, 0, '', '', '1', '0', ''),
(39, 'Garmin', 'garmin', 3, '', '', '<p>��������&nbsp;<strong>Garmin</strong>&nbsp;- ������� ����� � ����� ������������ �������� ��������� � ������� ��� ��������� �����������, ��������������� ��� ���� � �����.</p>\r\n<p><a href="../../../selection/?v[53]=150">�������� ��� ������ ������</a></p>', '1', 1, 0, '', '', '1', '0', ''),
(40, 'Versace', 'versace', 3, '', '', '<p><strong>Versace</strong> - ����� ���, ��� ��������� ����������� ���� ���������������� � ��������������, ��� �� ������ ���� ���������, ����������� � ������������.</p>\r\n<p><a href="../../../selection/?v[45]=127">�������� ��� ������ ������</a></p>', '1', 1, 0, '', '', '1', '0', ''),
(41, 'Hugo Boss', 'hugo-boss', 3, '', '', '<p><strong>Hugo Boss</strong>&nbsp;- ����� ���, ��� ��������� ����������� ���� ���������������� � ��������������, ��� �� ������ ���� ���������, ����������� � ������������.</p>\r\n<p><a href="../../../selection/?v[45]=133">�������� ��� ������ ������</a></p>', '1', 1, 0, '', '', '1', '0', ''),
(42, 'Adidas', 'adidas', 3, '', '', '<p><strong>Adidas</strong>�- ����� ���, ��� ��������� ����������� ���� ���������������� � ��������������, ��� �� ������ ���� ���������, ����������� � ������������.</p>\r\n<p><a href="../../../selection/?v[45]=134">�������� ��� ������ ������</a></p>', '1', 1, 1455625315, '', '', '1', '0', '');


-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_page_categories`
--

CREATE TABLE IF NOT EXISTS `phpshop_page_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `num` int(64) DEFAULT '1',
  `parent_to` int(11) DEFAULT '0',
  `content` text,
  PRIMARY KEY (`id`),
  KEY `parent_to` (`parent_to`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_page_categories`
--

INSERT INTO `phpshop_page_categories` (`id`, `name`, `num`, `parent_to`, `content`) VALUES
(4, '������� ���������', 0, 0, ''),
(3, '���� ������', 0, 0, '');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_payment`
--

CREATE TABLE IF NOT EXISTS `phpshop_payment` (
  `uid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `sum` float  DEFAULT '0',
  `datas` int(11) DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `order` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_payment_systems`
--

CREATE TABLE IF NOT EXISTS `phpshop_payment_systems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `path` varchar(255) DEFAULT '',
  `enabled` enum('0','1')  DEFAULT '1',
  `num` tinyint(11) DEFAULT '0',
  `message` text,
  `message_header` text,
  `yur_data_flag` enum('0','1')DEFAULT '0',
  `icon` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_payment_systems`
--

INSERT INTO `phpshop_payment_systems` (`id`, `name`, `path`, `enabled`, `num`, `message`, `message_header`, `yur_data_flag`, `icon`) VALUES
(1, '���������� �������', 'bank', '1', 4, '<img src="/UserFiles/Image/Trial/rabbit.png" alt="" align="" border="0"><h3>���������� ��� �� �����!</h3><p>���� ��� �������� � �����&nbsp;<a href="/users/order.html">������ ��������</a>.&nbsp;</p><p>������ ������� �� ������� �������� ��������� � ����� �����.</p>', '', '1', '/UserFiles/Image/Payments/beznal.png'),
(2, '��������� ���������', 'sberbank', '1', 3, '<img src="/UserFiles/Image/Trial/rabbit.png" alt="" align="" border="0"><h3>���������� ��� �� �����!</h3><p>��������� ��������� ��� �������� � �����&nbsp;<a href="/users/order.html">������ ��������</a>.&nbsp;</p><p>������ ������� �� ������� �������� ��������� � ����� �����.</p>', '', '', '/UserFiles/Image/Payments/sberbank.png'),
(3, '�������� ������', 'message', '1', 0, '<img src="/UserFiles/Image/Trial/rabbit.png" alt="" align="" border="0"><h3>���������� ��� �� �����!</h3>� ��������� ����� � ���� �������� ��� �������� ��� ��������� �������.', '', '', '/UserFiles/Image/Payments/nal.png'),
(10017, 'Visa, Mastercard, Yandex (NetPay)', 'modules', '0', 0, '', '', '', '/UserFiles/Image/Payments/visa.png');;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_products`
--

CREATE TABLE IF NOT EXISTS `phpshop_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `description` text,
  `content` text,
  `price` float DEFAULT '0',
  `price_n` float DEFAULT '0',
  `sklad` enum('0','1') DEFAULT '0',
  `p_enabled` enum('0','1') DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '1',
  `uid` varchar(64) DEFAULT '',
  `spec` enum('0','1') DEFAULT '0',
  `odnotip` varchar(64) DEFAULT '',
  `vendor` varchar(255) DEFAULT '',
  `vendor_array` blob,
  `yml` enum('0','1') DEFAULT '0',
  `num` int(11) DEFAULT '1',
  `newtip` enum('0','1') DEFAULT '0',
  `title` varchar(255)  DEFAULT '',
  `title_enabled` enum('0','1','2') DEFAULT '0',
  `datas` int(11) DEFAULT '0',
  `page` varchar(255) DEFAULT '',
  `user` tinyint(11) DEFAULT '0',
  `descrip` varchar(255) DEFAULT '',
  `descrip_enabled` enum('0','1','2') DEFAULT '0',
  `title_shablon` varchar(255) DEFAULT '',
  `descrip_shablon` varchar(255) DEFAULT '',
  `keywords` varchar(255) DEFAULT '',
  `keywords_enabled` enum('0','1','2') DEFAULT '0',
  `keywords_shablon` varchar(255) DEFAULT '',
  `pic_small` varchar(255) DEFAULT '',
  `pic_big` varchar(255) DEFAULT '',
  `yml_bid_array` tinyblob,
  `parent_enabled` enum('0','1') DEFAULT '0',
  `parent` text,
  `items` int(11) DEFAULT '0',
  `weight` float DEFAULT '0',
  `price2` float DEFAULT '0',
  `price3` float DEFAULT '0',
  `price4` float DEFAULT '0',
  `price5` float DEFAULT '0',
  `files` text,
  `baseinputvaluta` int(11) DEFAULT '0',
  `ed_izm` varchar(255) DEFAULT '',
  `dop_cat` varchar(255) DEFAULT '',
  `rate` float unsigned DEFAULT '0',
  `rate_count` int(10) unsigned DEFAULT '0',
  `prod_seo_name` varchar(255) DEFAULT '',
  `price_search` float DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `enabled` (`enabled`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_products`
--

INSERT INTO `phpshop_products` (`id`, `category`, `name`, `description`, `content`, `price`, `price_n`, `sklad`, `p_enabled`, `enabled`, `uid`, `spec`, `odnotip`, `vendor`, `vendor_array`, `yml`, `num`, `newtip`, `title`, `title_enabled`, `datas`, `page`, `user`, `descrip`, `descrip_enabled`, `title_shablon`, `descrip_shablon`, `keywords`, `keywords_enabled`, `keywords_shablon`, `pic_small`, `pic_big`, `yml_bid_array`, `parent_enabled`, `parent`, `items`, `weight`, `price2`, `price3`, `price4`, `price5`, `files`, `baseinputvaluta`, `ed_izm`, `dop_cat`, `rate`, `rate_count`, `prod_seo_name`) VALUES
(112, 52, '������� ��� ������� �� ������� 925 �����', '<p>������� ��� ������� �� ������� 925 �����. ������������: ������. ����� ��� ����� 2.70 ��.</p>', '<p>������� ��� ������� �� ������� 925 �����. ������������: ������. ����� ��� ����� 2.70 ��.</p>', 3800, 0, '0', '1', '1', '', '1', '118,120', 'i56-155ii56-156ii46-130i', 0x613a323a7b693a35363b613a323a7b693a303b733a333a22313535223b693a313b733a333a22313536223b7d693a34363b613a313a7b693a303b733a333a22313330223b7d7d, '1', 0, '0', '', '0', 1409311457, 'purchase,', 0, '', '0', '', '', '����������� ��������', '1', '', '/UserFiles/Image/Trial/img112_24010s.jpg', '/UserFiles/Image/Trial/img112_24010.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 5, 0, 5000, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, ''),
(116, 51, '���������� ������� ������ Hugo Boss', '<p>���������� ������� ������ �� Escada Sport �������� �� ����������� ���� ����������� �����. �����������: ����������� ������������� ������ ������������ �����.</p>', '<p>���������� ������� ������ �� Escada Sport �������� �� ����������� ���� ����������� �����. �����������: ����������� ������������� ������ ������������ �����.</p>', 4750, 0, '0', '1', '1', '', '1', '117', 'i45-133ii46-131i', 0x613a323a7b693a34353b613a313a7b693a303b733a333a22313333223b7d693a34363b613a313a7b693a303b733a333a22313331223b7d7d, '1', 0, '0', '', '0', 1409310941, 'help,', 0, '', '0', '', '', '������ �� ����', '1', '', '/UserFiles/Image/Trial/img116_20029s.jpg', '/UserFiles/Image/Trial/img116_20029.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 55, 100, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, ''),
(132, 15, '������ ������ Versace', '<p>������ &nbsp;- ��������� ����� �� ������ ����. ������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����.&nbsp;</p>', '<p>������ &nbsp;- ��������� ����� �� ������ ����. ������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', 38475, 0, '0', '1', '1', '', '1', '136,137,135,134,133,138', 'i45-127i', 0x613a313a7b693a34353b613a313a7b693a303b733a333a22313237223b7d7d, '1', 1, '0', '', '0', 1409310794, ' ', 0, '', '0', '', '', '���������� ������', '1', '', '/UserFiles/Image/Trial/img132_10356s.jpg', '/UserFiles/Image/Trial/img132_10356.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '138', 45, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, ''),
(184, 50, '���� Swatch BW0201', '<p>��������� ����������� ����� ������� ����������� �������. ���� ���������� ��� ������� ����� ��� �������: ������� � ��������. ������� ����� �������� �� ����������� ���� ����������� ����� � ������� ������������ ���������.</p>', '<p>��������� ����������� ����� ������� ����������� �������. ���� ���������� ��� ������� ����� ��� �������: ������� � ��������. ������� ����� �������� �� ����������� ���� ����������� ����� � ������� ������������ ���������.</p>', 5000, 0, '0', '1', '1', '', '1', '184,119,121', 'i46-131ii46-130ii46-128ii46-132ii46-129i', 0x613a313a7b693a34363b613a353a7b693a303b733a333a22313331223b693a313b733a333a22313330223b693a323b733a333a22313238223b693a333b733a333a22313332223b693a343b733a333a22313239223b7d7d, '1', 0, '0', '', '0', 1409311143, ' ', 0, '', '0', '', '', '����', '1', '', '/UserFiles/Image/Trial/img184_22369s.jpg', '/UserFiles/Image/Trial/img184_22369.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 10, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, ''),
(117, 51, '������� ����� �� ������������ �����-������� Vercase', '<p>������� ����� �� ������������ �����-������� ��� ������� �� �����. �������� ������ � �������� �� ������.</p>', '<p>������� ����� �� ������������ �����-������� ��� ������� �� �����. �������� ������ � �������� �� ������.</p>', 8455, 0, '1', '1', '1', '', '1', '116', 'i45-127ii46-131i', 0x613a323a7b693a34353b613a313a7b693a303b733a333a22313237223b7d693a34363b613a313a7b693a303b733a333a22313331223b7d7d, '1', 0, '0', '', '0', 1409310959, ' ', 0, '', '0', '', '', '����� ��� ��������', '1', '', '/UserFiles/Image/Trial/img117_16192s.jpg', '/UserFiles/Image/Trial/img117_16192.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, ''),
(118, 52, '������������ ������� �� Taya', '<p>������������ ������� �� Taya. ������ ��������� �� ���������� ������������ ������� � ��������� ������������� ����. ������: �������� �� ������.</p>', '<p>������������ ������� �� Taya. ������ ��������� �� ���������� ������������ ������� � ��������� ������������� ����. ������: �������� �� ������.</p>', 4275, 0, '0', '1', '1', '', '0', '112,120', 'i56-155i', 0x613a313a7b693a35363b613a313a7b693a303b733a333a22313535223b7d7d, '1', 0, '0', '', '0', 1409311475, ' ', 0, '', '0', '', '', '������� ��������', '1', '', '/UserFiles/Image/Trial/img118_30495s.jpg', '/UserFiles/Image/Trial/img118_30495.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 11, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, ''),
(119, 50, '���� ��������� Citizen FE1011-11L', '<p>������� Eco-Drive �� ��������� ������ ���������. ������� �� ��������� �������, ����� ������� �� 180 ����. ������� �������������� � ������ ������ ������ ������������ �� 5 ���� �� ������������ ������.&nbsp;</p>', '<p>������� Eco-Drive �� ��������� ������ ���������. ������� �� ��������� �������, ����� ������� �� 180 ����. ������� �������������� � ������ ������ ������ ������������ �� 5 ���� �� ������������ ������.&nbsp;</p>', 11685, 0, '0', '1', '1', '', '0', '121,184', 'i46-129i', 0x613a313a7b693a34363b613a313a7b693a303b733a333a22313239223b7d7d, '1', 0, '0', '', '0', 1409311154, ' ', 0, '', '0', '', '', '��������� ����', '1', '', '/UserFiles/Image/Trial/img119_29758s.jpg', '/UserFiles/Image/Trial/img119_29758.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 3, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, ''),
(120, 52, '��������� ����������� ������ � ������� ������', '<p>��������� ����������� ������ � ������� ������ �� ������������ �������� ������ ������� �� ���� ����� �������� �������.&nbsp;</p>', '<p>��������� ����������� ������ � ������� ������ �� ������������ �������� ������ ������� �� ���� ����� �������� �������.&nbsp;</p>', 32300, 0, '0', '1', '1', '', '0', '112,118', 'i56-155ii56-156ii56-157i', 0x613a313a7b693a35363b613a333a7b693a303b733a333a22313535223b693a313b733a333a22313536223b693a323b733a333a22313537223b7d7d, '1', 0, '0', '', '0', 1409311954, ' ', 0, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img120_37040s.jpg', '/UserFiles/Image/Trial/img120_37040.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 2, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, ''),
(121, 50, '���� �������� Citizen BW0201-06A', '<p>������� Eco-Drive �� ��������� ������ ���������. ������� �� ��������� �������, ����� ������� �� 180 ����. ������� �������������� � ������ ������ ������ ������������ �� 5 ���� �� ������������ ������.&nbsp;</p>', '<p>������� Eco-Drive �� ��������� ������ ���������. ������� �� ��������� �������, ����� ������� �� 180 ����. ������� �������������� � ������ ������ ������ ������������ �� 5 ���� �� ������������ ������.</p>', 3800, 0, '0', '1', '1', '', '0', '119', 'i46-131i', 0x613a313a7b693a34363b613a313a7b693a303b733a333a22313331223b7d7d, '1', 0, '0', '', '0', 1409311168, ' ', 0, '', '0', '', '', '�������� ����', '1', '', '/UserFiles/Image/Trial/img121_42039s.jpg', '/UserFiles/Image/Trial/img121_42039.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 56, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 1, ''),
(133, 15, '������ ��� �������� Versace', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', 38000, 0, '0', '1', '1', '', '1', '136,137,135,134,132,138', 'i45-127ii46-128ii46-132ii46-129i', 0x613a323a7b693a34353b613a313a7b693a303b733a333a22313237223b7d693a34363b613a333a7b693a303b733a333a22313238223b693a313b733a333a22313332223b693a323b733a333a22313239223b7d7d, '1', 2, '0', '', '0', 1409310751, 'admin,design,purchase,developers,help,forma,', 0, '', '0', '', '', '����������� ������', '1', '', '/UserFiles/Image/Trial/img133_35113s.jpg', '/UserFiles/Image/Trial/img133_35113.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 5, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 1, 1, ''),
(134, 15, '������ ������ Hugo Boss', '<p>������ �� ������� ����������� ���������. ������: ��������������� ����, ������� �����, �������� ��������������� ����� 3/4, ��������� �����, ������ ���������, ����� �������� �� ������.</p>', '<p>������ �� ������� ����������� ���������. ������: ��������������� ����, ������� �����, �������� ��������������� ����� 3/4, ��������� �����, ������ ���������, ����� �������� �� ������.</p>', 9570, 0, '0', '1', '1', '', '1', '136,137,135,133,132,138', 'i56-155ii56-156ii56-157ii45-133ii46-129i', 0x613a333a7b693a35363b613a333a7b693a303b733a333a22313535223b693a313b733a333a22313536223b693a323b733a333a22313537223b7d693a34353b613a313a7b693a303b733a333a22313333223b7d693a34363b613a313a7b693a303b733a333a22313239223b7d7d, '1', 3, '1', '', '0', 1409346316, 'design,developers,', 0, '', '0', '', '', '����������� ������', '1', '', '/UserFiles/Image/Trial/img134_22624s.jpg', '/UserFiles/Image/Trial/img134_22624.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 46, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 2, 1, ''),
(135, 15, '������ � ��������� ������� Hugo Boss', '<p>������ �� ������� ����������� ���������. ������: ��������������� ����, ������� �����, �������� ��������������� ����� 3/4, ��������� �����, ������ ���������, ����� �������� �� ������.������ �� ������� ����������� ���������.</p>', '<p>������ �� ������� ����������� ���������. ������: ��������������� ����, ������� �����, �������� ��������������� ����� 3/4, ��������� �����, ������ ���������, ����� �������� �� ������.</p>', 23750, 0, '0', '1', '1', '', '0', '136,137,134,133,132,138', 'i56-155ii56-156ii56-157ii45-133ii46-131ii46-130ii46-128i', 0x613a333a7b693a35363b613a333a7b693a303b733a333a22313535223b693a313b733a333a22313536223b693a323b733a333a22313537223b7d693a34353b613a313a7b693a303b733a333a22313333223b7d693a34363b613a333a7b693a303b733a333a22313331223b693a313b733a333a22313330223b693a323b733a333a22313238223b7d7d, '1', 4, '0', '', '0', 1409346564, 'developers,', 0, '', '0', '', '', '����������� ������', '1', '', '/UserFiles/Image/Trial/img135_38333s.jpg', '/UserFiles/Image/Trial/img135_38333.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 2, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 3, 1, ''),
(136, 15, '������ �� ������� ��������� Adidas', '<p>������ ��������� �� ������� �� ����� ���������. ������: ������� �����, �������� ������ �� �����, ����� �� ������������� ���� �� ������� �������.</p>', '<p>������ ��������� �� ������� �� ����� ���������. ������: ������� �����, �������� ������ �� �����, ����� �� ������������� ���� �� ������� �������.</p>', 1168.5, 0, '0', '1', '1', '', '0', '137,135,134,133,132,138', 'i56-155ii56-156ii45-134ii46-128ii46-132ii46-129i', 0x613a333a7b693a35363b613a323a7b693a303b733a333a22313535223b693a313b733a333a22313536223b7d693a34353b613a313a7b693a303b733a333a22313334223b7d693a34363b613a333a7b693a303b733a333a22313238223b693a313b733a333a22313332223b693a323b733a333a22313239223b7d7d, '1', 7, '0', '', '0', 1409310700, ' ', 0, '', '0', '', '', '������� ������', '1', '', '/UserFiles/Image/Trial/img136_40848s.jpg', '/UserFiles/Image/Trial/img136_40848.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 5, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 2, 1, ''),
(137, 15, '������ �� �������� ��������� Hugo Boss', '<p>������ �� �������� ������ ���������� �������� ��������� �����. �������� ������� ����� ����������� �������� �������� ��������. ������: �������� �� ������ �� ������, ������� ������������ ���������� ������� �� ������, ���������� ����.</p>', '<p>������ �� �������� ������ ���������� �������� ��������� �����. �������� ������� ����� ����������� �������� �������� ��������. ������: �������� �� ������ �� ������, ������� ������������ ���������� ������� �� ������, ���������� ����.</p>', 38475, 0, '0', '1', '1', '', '1', '136,135,134,133,132,138', 'i56-156ii56-157ii45-133ii46-131ii46-130ii46-128i', 0x613a333a7b693a35363b613a323a7b693a303b733a333a22313536223b693a313b733a333a22313537223b7d693a34353b613a313a7b693a303b733a333a22313333223b7d693a34363b613a333a7b693a303b733a333a22313331223b693a313b733a333a22313330223b693a323b733a333a22313238223b7d7d, '1', 5, '0', '', '0', 1409346581, ' ', 0, '', '0', '', '', '������� ������', '1', '', '/UserFiles/Image/Trial/img137_11628s.jpg', '/UserFiles/Image/Trial/img137_11628.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 2, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 1, ''),
(138, 15, '������ �� ��������� �� ����� ��������� Hugo Boss', '<p>������ ��������� �� ��������� �� ����� ���������. ����������� ����� �� �������� ����������� �����, ������� ������, ���� ����������� ����������� �����������.</p>', '<p>������ ��������� �� ��������� �� ����� ���������. ������: ����������� ����, �������� ������ � ���������� ������� �� ������, ���������� ������� ��� ��������� �����, ����������� ����� �� �������� ����������� �����, ������� ������, ���� ����������� ����������� �����������.</p>', 38475, 0, '0', '1', '1', '', '1', '136,137,135,134,133,132', 'i56-155ii56-156ii45-133ii46-131ii46-130ii46-128i', 0x613a333a7b693a35363b613a323a7b693a303b733a333a22313535223b693a313b733a333a22313536223b7d693a34353b613a313a7b693a303b733a333a22313333223b7d693a34363b613a333a7b693a303b733a333a22313331223b693a313b733a333a22313330223b693a323b733a333a22313238223b7d7d, '1', 0, '0', '', '0', 1409346517, ' ', 0, '', '0', '', '', '���������� ������', '1', '', '/UserFiles/Image/Trial/img138_69192s.jpg', '/UserFiles/Image/Trial/img138_69192.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 7, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, ''),
(139, 16, '����� ���� Hugo Boss', '<p>����� ���� ��������� �� ������� ���������� ��������� ������ �����. ������: ������ ����, �������� �������� � ������� �� ���������, �������� ������.</p>', '<p>����� ���� ��������� �� ������� ���������� ��������� ������ �����. ������: ������ ����, �������� �������� � ������� �� ���������, �������� ������.</p>', 1168.5, 0, '1', '1', '1', '', '0', '140,141,142,143,144', 'i56-155ii56-156ii56-157ii45-133ii46-131ii46-130ii46-128i', 0x613a333a7b693a35363b613a333a7b693a303b733a333a22313535223b693a313b733a333a22313536223b693a323b733a333a22313537223b7d693a34353b613a313a7b693a303b733a333a22313333223b7d693a34363b613a333a7b693a303b733a333a22313331223b693a313b733a333a22313330223b693a323b733a333a22313238223b7d7d, '1', 0, '0', '', '0', 1409587651, ' ', 0, '', '0', '', '', '������� �����', '1', '', '/UserFiles/Image/Trial/img139_16820s.jpg', '/UserFiles/Image/Trial/img139_16820.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, ''),
(140, 16, '����� �������', '<p>������ ����������� �������� - ������, ������, ������� �����, ������� ��������� ������� ����� � ������� �� ������, �������� ���� �����. ������: ������ ����, �������� ����� ���������, ��������� ���������� � ��������� ������ �� ������� �������.</p>', '<p>������ ����������� �������� - ������, ������, ������� �����, ������� ��������� ������� ����� � ������� �� ������, �������� ���� �����. ������: ������ ����, �������� ����� ���������, ��������� ���������� � ��������� ������ �� ������� �������.</p>', 1330, 0, '0', '1', '1', '', '0', '139,141,142,143,144', 'i56-155ii56-156ii56-157ii46-130ii46-128i', 0x613a323a7b693a35363b613a333a7b693a303b733a333a22313535223b693a313b733a333a22313536223b693a323b733a333a22313537223b7d693a34363b613a323a7b693a303b733a333a22313330223b693a313b733a333a22313238223b7d7d, '1', 0, '0', '', '0', 1409310837, 'purchase,', 0, '', '0', '', '', '������� �����', '1', '', '/UserFiles/Image/Trial/img140_13649s.jpg', '/UserFiles/Image/Trial/img140_13649.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 10, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 2, 2, ''),
(141, 16, '���� Adidas', '<p>������ ����������� �������� - ������, ������, ������� �����, ������� ��������� ������� ����� � ������� �� ������, �������� ���� �����.</p>', '', 1520, 0, '0', '1', '1', '', '0', '139,140,142,143,144', 'i45-134ii46-131ii46-130ii46-129i', 0x613a323a7b693a34353b613a313a7b693a303b733a333a22313334223b7d693a34363b613a333a7b693a303b733a333a22313331223b693a313b733a333a22313330223b693a323b733a333a22313239223b7d7d, '1', 0, '0', '', '0', 1409587636, 'forma,', 0, '', '0', '', '', '���� �������', '1', '', '/UserFiles/Image/Trial/img141_34388s.jpg', '/UserFiles/Image/Trial/img141_34388.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '143', 4, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 3, 2, ''),
(142, 16, '�������� ����������', '<p>�������� ������ ����� �� Adidas Performance - ��� ������� � ���������� ������ �������� ���������.&nbsp;&nbsp;������: ������ ����, �������� ����� ���������, ��������� ���������� � ��������� ������ �� ������� �������.</p>', '<p>�������� ������ ����� �� Adidas Performance - ��� ������� � ���������� ������ �������� ���������.</p>', 1805, 0, '0', '1', '1', '', '1', '139,140,141,143,144', 'i56-155ii56-156ii56-157ii46-131ii46-132i', 0x613a323a7b693a35363b613a333a7b693a303b733a333a22313535223b693a313b733a333a22313536223b693a323b733a333a22313537223b7d693a34363b613a323a7b693a303b733a333a22313331223b693a313b733a333a22313332223b7d7d, '1', 0, '0', '', '0', 1409587666, ' ', 0, '', '0', '', '', '������� �����', '1', '', '/UserFiles/Image/Trial/img142_38581s.jpg', '/UserFiles/Image/Trial/img142_38581.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 8, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 1, ''),
(143, 16, '���� ����� Hugo Boss', '<p>�������� ������ ����� �� Adidas Performance - ��� ������� � ���������� ������ �������� ���������.</p>', '<p>�������� ������ ����� �� Adidas Performance - ��� ������� � ���������� ������ �������� ���������.</p>', 2375, 0, '0', '1', '1', '', '1', '139,140,141,142,144', 'i56-156ii56-157ii45-133ii46-132ii46-129i', 0x613a333a7b693a35363b613a323a7b693a303b733a333a22313536223b693a313b733a333a22313537223b7d693a34353b613a313a7b693a303b733a333a22313333223b7d693a34363b613a323a7b693a303b733a333a22313332223b693a313b733a333a22313239223b7d7d, '1', 0, '0', '', '0', 1409310870, 'help,', 0, '', '0', '', '', '���� �������', '1', '', '/UserFiles/Image/Trial/img143_13671s.jpg', '/UserFiles/Image/Trial/img143_13671.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 89, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 3, 2, ''),
(144, 16, '������ ������� Versace', '<p>������ ��������� �� ������� ���������� ��������� ������ �����. ������: ������ ����, �������� �������� � ������� �� ���������, �������� ������.</p>', '<p>����� ���� adidas Neo ��������� �� ������� ���������� ��������� ������ �����. ������: ������ ����, �������� �������� � ������� �� ���������, �������� ������.</p>', 665, 0, '0', '1', '1', '', '1', '139,140,141,142,143', 'i56-155ii56-156ii56-157ii45-127i', 0x613a323a7b693a35363b613a333a7b693a303b733a333a22313535223b693a313b733a333a22313536223b693a323b733a333a22313537223b7d693a34353b613a313a7b693a303b733a333a22313237223b7d7d, '1', 0, '0', '', '0', 1409310880, ' ', 0, '', '0', '', '', '������ �������', '1', '', '/UserFiles/Image/Trial/img144_21825s.jpg', '/UserFiles/Image/Trial/img144_21825.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 5, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 3, 2, ''),
(145, 54, '����������� ���������� Canon EOS 1100D Kit', '<p>������������ ���������� ����������, ������� Canon EF/EF-S, �������� � ���������, ������ ��������� � ��������, ������� 18.5 �� (APS-C). ������ ����� Full HD, ���������� ��������� ����� 3, ��� ������ ��� ��������� 575 �</p>', '<p>������������ ���������� ����������, ������� Canon EF/EF-S, �������� � ���������, ������ ��������� � ��������, ������� 18.5 �� (APS-C). ������ ����� Full HD, ���������� ��������� ����� 3, ��� ������ ��� ��������� 575 �</p>', 84550, 0, '0', '1', '1', '', '0', '146,147,148,157,149', 'i53-147i', 0x613a313a7b693a35333b613a313a7b693a303b733a333a22313437223b7d7d, '1', 0, '0', '', '0', 1409315050, 'design,purchase,developers,help,', 0, '', '0', '', '', '�����������', '1', '', '/UserFiles/Image/Trial/img145_28499s.jpg', '/UserFiles/Image/Trial/img145_28499.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 22, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 1, ''),
(146, 54, '����������� ���������� Canon EOS 600D', '<div>\r\n<div>������������ ���������� ����������</div>\r\n<div>������� Canon EF/EF-S</div>\r\n<div>�������� � ���������, ������ ��������� � ��������</div>\r\n<div>������� 18.5 �� (APS-C)</div>\r\n<div>������ ����� Full HD</div>\r\n<div>���������� ��������� ����� 3</div>\r\n<div>��� ������ ��� ��������� 575�</div>\r\n</div>', '<div>������������ ���������� ����������</div>\r\n<div>������� Canon EF/EF-S</div>\r\n<div>�������� � ���������, ������ ��������� � ��������</div>\r\n<div>������� 18.5 �� (APS-C)</div>\r\n<div>������ ����� Full HD</div>\r\n<div>���������� ��������� ����� 3</div>\r\n<div>��� ������ ��� ��������� 575�.</div>', 4750, 0, '0', '1', '1', '', '1', '145,147,148,157,149', 'i53-147i', 0x613a313a7b693a35333b613a313a7b693a303b733a333a22313437223b7d7d, '1', 0, '0', '', '0', 1409315032, 'help,', 0, '', '0', '', '', '�����������', '1', '', '/UserFiles/Image/Trial/img146_32080s.jpg', '/UserFiles/Image/Trial/img146_32080.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 17, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 3.5, 2, ''),
(147, 54, '����������� ���������� Nikon D3200 Kit', '<div>������������ ���������� ����������</div>\r\n<div>������� Canon EF/EF-S</div>\r\n<div>�������� � ���������, ������ ��������� � ��������</div>\r\n<div>������� 18.5 �� (APS-C)</div>\r\n<div>������ ����� Full HD</div>\r\n<div>���������� ��������� ����� 3</div>\r\n<div>��� ������ ��� ��������� 575 �</div>', '<div>������������ ���������� ����������</div>\r\n<div>������� Canon EF/EF-S</div>\r\n<div>�������� � ���������, ������ ��������� � ��������</div>\r\n<div>������� 18.5 �� (APS-C)</div>\r\n<div>������ ����� Full HD</div>\r\n<div>���������� ��������� ����� 3</div>\r\n<div>��� ������ ��� ��������� 575 �</div>', 53200, 0, '0', '1', '1', '', '1', '145,146,148,157,149', 'i53-148i', 0x613a313a7b693a35333b613a313a7b693a303b733a333a22313438223b7d7d, '1', 0, '0', '', '0', 1409315066, 'design,', 0, '', '0', '', '', '�����������', '1', '', '/UserFiles/Image/Trial/img147_17093s.jpg', '/UserFiles/Image/Trial/img147_17093.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 13, 0, 45000, 0, 0, 0, 'N;', 6, '��.', '', 3.5, 2, ''),
(148, 54, '����������� ���������� Nikon D3200 kit 18', '<div>������������ ���������� ����������</div>\r\n<div>������� Canon EF/EF-S</div>\r\n<div>�������� � ���������, ������ ��������� � ��������</div>\r\n<div>������� 18.5 �� (APS-C)</div>\r\n<div>������ ����� Full HD</div>\r\n<div>���������� ��������� ����� 3</div>\r\n<div>��� ������ ��� ��������� 575 �</div>', '<div>������������ ���������� ����������</div>\r\n<div>������� Canon EF/EF-S</div>\r\n<div>�������� � ���������, ������ ��������� � ��������</div>\r\n<div>������� 18.5 �� (APS-C)</div>\r\n<div>������ ����� Full HD</div>\r\n<div>���������� ��������� ����� 3</div>\r\n<div>��� ������ ��� ��������� 575 �</div>', 19000, 0, '0', '1', '1', '', '0', '145,146,147,157,149', 'i53-148i', 0x613a313a7b693a35333b613a313a7b693a303b733a333a22313438223b7d7d, '1', 0, '0', '', '0', 1409315084, 'help,', 0, '', '0', '', '', '�����������', '1', '', '/UserFiles/Image/Trial/img148_23769s.jpg', '/UserFiles/Image/Trial/img148_23769.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 53, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 2, 1, ''),
(157, 54, '����������� ���������� Nikon D3100 Kit', '<div>������������ ���������� ����������</div>\r\n<div>������� Canon EF/EF-S</div>\r\n<div>�������� � ���������, ������ ��������� � ��������</div>\r\n<div>������� 18.5 �� (APS-C)</div>\r\n<div>������ ����� Full HD</div>\r\n<div>���������� ��������� ����� 3</div>\r\n<div>��� ������ ��� ��������� 575 �</div>', '<div>������������ ���������� ����������</div>\r\n<div>������� Canon EF/EF-S</div>\r\n<div>�������� � ���������, ������ ��������� � ��������</div>\r\n<div>������� 18.5 �� (APS-C)</div>\r\n<div>������ ����� Full HD</div>\r\n<div>���������� ��������� ����� 3</div>\r\n<div>��� ������ ��� ��������� 575 �</div>', 42750, 0, '0', '1', '1', '', '0', '145,146,147,148,149', 'i53-148i', 0x613a313a7b693a35333b613a313a7b693a303b733a333a22313438223b7d7d, '1', 0, '0', '', '0', 1409313423, 'design,purchase,', 0, '', '0', '', '', '���������������� �����������', '1', '', '/UserFiles/Image/Trial/img150_41941s.jpg', '/UserFiles/Image/Trial/img150_41941.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 2, 0, 50000, 0, 0, 0, 'N;', 6, '��.', '', 4, 2, ''),
(149, 54, '����������� ���������� Canon EOS 70D', '<div>������������ ���������� ����������</div>\r\n<div>�������� � ���������, ������ ��������� � ��������</div>\r\n<div>������� 18.5 �� (APS-C)</div>\r\n<div>������ ����� Full HD</div>\r\n<div>���������� ��������� ����� 3</div>\r\n<div>��� ������ ��� ��������� 575</div>', '<div>������������ ���������� ����������</div>\r\n<div>�������� � ���������, ������ ��������� � ��������</div>\r\n<div>������� 18.5 �� (APS-C)</div>\r\n<div>������ ����� Full HD</div>\r\n<div>���������� ��������� ����� 3</div>\r\n<div>��� ������ ��� ��������� 575 �</div>', 29165, 0, '0', '1', '1', '', '0', '145,146,147,148,157', 'i53-147i', 0x613a313a7b693a35333b613a313a7b693a303b733a333a22313437223b7d7d, '1', 0, '0', '', '0', 1409313445, 'design,purchase,', 0, '', '0', '', '', '���������������� �����������', '1', '', '/UserFiles/Image/Trial/img149_73468s.jpg', '/UserFiles/Image/Trial/img149_73468.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 104, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, ''),
(151, 55, '����������� �������� ���� GoPro Hero 3+ Black Edition', '<p>���������� action-������ �������� �������� ��� ������ ����� � ���� � ������������� ��������.</p>', '<p>���������� action-������ �������� �������� ��� ������ ����� � ���� � ������������� ��������.</p>', 4750, 0, '0', '1', '1', '', '1', '152,153,154,155,156', 'i55-151i', 0x613a313a7b693a35353b613a313a7b693a303b733a333a22313531223b7d7d, '1', 0, '1', '', '0', 1409313680, ' ', 0, '', '0', '', '', '���������� ���� ������', '1', '', '/UserFiles/Image/Trial/img151_40716s.jpg', '/UserFiles/Image/Trial/img151_40716.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 6, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 1, ''),
(152, 55, '����������� �������� ���� Sony HDR-AS100', '<p>������� ������������ SteadyShot � ���������������������� ��������� BIONZ X ����������� �������� �������� ������ �� ����� ��������.</p>', '<p>������� ������������ SteadyShot � ���������������������� ��������� BIONZ X ����������� �������� �������� ������ �� ����� ��������. �������� � ���������, ����������� ��������� ��� �������� ��������� ��� &amp;ndash ������ ������������ ����������� ������ ����� �����������.</p>', 5225, 0, '0', '1', '1', '', '1', '151,153,154,155,156', 'i55-151ii53-149i', 0x613a323a7b693a35353b613a313a7b693a303b733a333a22313531223b7d693a35333b613a313a7b693a303b733a333a22313439223b7d7d, '1', 0, '1', '', '0', 1409313658, ' ', 0, '', '0', '', '', '���������� ���� ������', '1', '', '/UserFiles/Image/Trial/img152_31605s.jpg', '/UserFiles/Image/Trial/img152_31605.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 2, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 1.5, 2, ''),
(153, 55, '����������� �������� ���� Liquid Image', '<p>������� � ���������� ������� ������ ������������ ������ ����������� ��� ���������� ������ � � ����� ��������� � ��������, ������� ���������� ����������� ��� ������� ��������� ����������.</p>', '<p>������� � ���������� ������� ������ ������������ ������ ����������� ��� ���������� ������ � � ����� ��������� � ��������, ������� ���������� ����������� ��� ������� ��������� ����������.</p>', 11685, 0, '0', '1', '1', '', '1', '151,152,154,155,156', 'i55-152i', 0x613a313a7b693a35353b613a313a7b693a303b733a333a22313532223b7d7d, '1', 0, '1', '', '0', 1409313566, 'admin,', 0, '', '0', '', '', '���� ������ � ������������', '1', '', '/UserFiles/Image/Trial/img153_38771s.jpg', '/UserFiles/Image/Trial/img153_38771.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 59, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 1, ''),
(154, 55, '����������� �������� ���� Garmin Virb', '<p>������� � ���������� ������� ������ ������������ ������ ����������� ��� ���������� ������ � � ����� ��������� � ��������, ������� ���������� ����������� ��� ������� ��������� ����������.</p>', '<p>������� � ���������� ������� ������ ������������ ������ ����������� ��� ���������� ������ � � ����� ��������� � ��������, ������� ���������� ����������� ��� ������� ��������� ����������.</p>', 3800, 0, '0', '1', '1', '', '1', '151,152,153,155,156', 'i55-153ii53-150i', 0x613a323a7b693a35353b613a313a7b693a303b733a333a22313533223b7d693a35333b613a313a7b693a303b733a333a22313530223b7d7d, '1', 0, '1', '', '0', 1409313573, 'help,', 0, '', '0', '', '', '���������� ���� ������', '1', '', '/UserFiles/Image/Trial/img154_64898s.jpg', '/UserFiles/Image/Trial/img154_64898.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 7, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, ''),
(155, 55, '����������� �������� ���� HP ac200w', '<p>������� � ���������� ������� ������ ������������ ������ ����������� ��� ���������� ������ � � ����� ��������� � ��������, ������� ���������� ����������� ��� ������� ��������� ����������.</p>', '<p>���������� action-������ �������� �������� ��� ������ ����� � ���� � ������������� ��������.</p>', 7600, 0, '0', '1', '1', '', '0', '', 'i55-153i', 0x613a313a7b693a35353b613a313a7b693a303b733a333a22313533223b7d7d, '1', 0, '1', '', '0', 1409313719, ' ', 0, '', '0', '', '', '���������� ���� ������', '1', '', '/UserFiles/Image/Trial/img155_38554s.jpg', '/UserFiles/Image/Trial/img155_38554.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 8, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 1, 1, ''),
(156, 55, '����������� �������� ���� Pivothead', '<p>������� � ���������� ������� ������ ������������ ������ ����������� ��� ���������� ������ � � ����� ��������� � ��������, ������� ���������� ����������� ��� ������� ��������� ����������.</p>', '<p>���������� action-������ �������� �������� ��� ������ ����� � ���� � ������������� ��������.</p>', 11400, 0, '0', '1', '1', '', '1', '151,152,153,154,155', 'i55-154i', 0x613a313a7b693a35353b613a313a7b693a303b733a333a22313534223b7d7d, '1', 0, '1', '', '0', 1409313732, 'design,', 0, '', '0', '', '', '���� ������-����', '1', '', '/UserFiles/Image/Trial/img156_19277s.jpg', '/UserFiles/Image/Trial/img156_19277.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 9, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 3, 2, ''),
(164, 60, '��������� ����� Diorskin Nude Shimmer', '<p>��������� ������� ��������� ���������� � ��������� ����� Diorskin Nude Shimmer ����� ������������ � �������� ������ ����� �� ������������ �������� ����, ����� ��������� �������� ����� � ������� ������������ ������������ �������.&nbsp;</p>', '<p>��������� ������� ��������� ���������� � ��������� ����� Diorskin Nude Shimmer ����� ������������ � �������� ������ ����� �� ������������ �������� ����, ����� ��������� �������� ����� � ������� ������������ ������������ �������.&nbsp;</p>', 5000, 0, '0', '1', '1', '123', '0', '165,166,167,168,169', 'i51-140ii49-143i', 0x613a323a7b693a35313b613a313a7b693a303b733a333a22313430223b7d693a34393b613a313a7b693a303b733a333a22313433223b7d7d, '1', 0, '0', '', '0', 1409309272, 'purchase,', 0, '', '0', '', '', '�����, ����� Dior', '1', '', '/UserFiles/Image/Trial/img164_21395s.jpg', '/UserFiles/Image/Trial/img164_21395.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 45, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 2, 1, ''),
(165, 60, '���������� ����� Diorskin Forever', '<p>��������� �������� � �� ������ �������� ����������� � ����������� ����������� ����� �������� �������� ���� ����, �������� �������� ��������.</p>', '<p>��������� �������� � �� ������ �������� ����������� � ����������� ����������� ����� �������� �������� ���� ����, �������� �������� ��������.</p>', 1200, 0, '0', '1', '1', '', '1', '164,166,167,168,169', 'i51-140ii49-137i', 0x613a323a7b693a35313b613a313a7b693a303b733a333a22313430223b7d693a34393b613a313a7b693a303b733a333a22313337223b7d7d, '1', 0, '0', '', '0', 1409309288, ' ', 0, '', '0', '', '', '���������� �����', '1', '', '/UserFiles/Image/Trial/img165_17940s.jpg', '/UserFiles/Image/Trial/img165_17940.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 45, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 1, ''),
(166, 60, '������ ������ Lancome Addict Extreme', '<p>������ ������ ������ Dior Addict ��������� ����� �������� - Extreme � � �������� �������, �������� ������� ��������� � �������� ������� ��� � ������, ���������� ������ Dior.</p>', '<p>������ ������ ������ Dior Addict ��������� ����� �������� - Extreme � � �������� �������, �������� ������� ��������� � �������� ������� ��� � ������, ���������� ������ Dior.</p>', 2000, 0, '0', '1', '1', '', '1', '164,165,167,168,169', 'i51-146ii49-137i', 0x613a323a7b693a35313b613a313a7b693a303b733a333a22313436223b7d693a34393b613a313a7b693a303b733a333a22313337223b7d7d, '1', 0, '0', '', '0', 1409309310, 'help,', 0, '', '0', '', '', '������ ������ Lancome', '1', '', '/UserFiles/Image/Trial/img166_16020s.jpg', '/UserFiles/Image/Trial/img166_16020.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 1, ''),
(167, 60, '���� ��� ������ PhotoReady Revlon', '<p>��������� �� ������ ������� ������������� �������, ��� �������� ������� �� �������, ��������� ��������� ��.&nbsp;</p>', '<p>��������� �� ������ ������� ������������� �������, ��� �������� ������� �� �������, ��������� ��������� ��.&nbsp;</p>', 600, 0, '0', '1', '1', '', '1', '164,165,166,168,169', 'i51-142ii49-143i', 0x613a323a7b693a35313b613a313a7b693a303b733a333a22313432223b7d693a34393b613a313a7b693a303b733a333a22313433223b7d7d, '1', 0, '0', '', '0', 1409314971, 'purchase,developers,forma,', 0, '', '0', '', '', '���� ��� ������ Revlon', '1', '', '/UserFiles/Image/Trial/img167_26213s.jpg', '/UserFiles/Image/Trial/img167_26213.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 13, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 1, 1, ''),
(168, 60, '����������� ���� ��� ������ Truly Clarins', '<p>������������ ������� ������� �� � �������� �� �����. ����������� 12 ����� ���������. ����������� �������, ���������� ������� �� �� �������� ����������� �����, ���� (������� ����), ����� (���� � ��������) � ������.&nbsp;</p>', '<p>������������ ������� ������� �� � �������� �� �����. ����������� 12 ����� ���������. ����������� �������, ���������� ������� �� �� �������� ����������� �����, ���� (������� ����), ����� (���� � ��������) � ������.&nbsp;</p>', 3000, 0, '0', '1', '1', '', '0', '164,165,166,167,169', 'i51-139ii49-143i', 0x613a323a7b693a35313b613a313a7b693a303b733a333a22313339223b7d693a34393b613a313a7b693a303b733a333a22313433223b7d7d, '1', 0, '0', '', '0', 1409314960, ' ', 0, '', '0', '', '', '����������� ����', '1', '', '/UserFiles/Image/Trial/img168_22957s.jpg', '/UserFiles/Image/Trial/img168_22957.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 3, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '');
INSERT INTO `phpshop_products` (`id`, `category`, `name`, `description`, `content`, `price`, `price_n`, `sklad`, `p_enabled`, `enabled`, `uid`, `spec`, `odnotip`, `vendor`, `vendor_array`, `yml`, `num`, `newtip`, `title`, `title_enabled`, `datas`, `page`, `user`, `descrip`, `descrip_enabled`, `title_shablon`, `descrip_shablon`, `keywords`, `keywords_enabled`, `keywords_shablon`, `pic_small`, `pic_big`, `yml_bid_array`, `parent_enabled`, `parent`, `items`, `weight`, `price2`, `price3`, `price4`, `price5`, `files`, `baseinputvaluta`, `ed_izm`, `dop_cat`, `rate`, `rate_count`, `prod_seo_name`) VALUES
(169, 60, '������� ��� ��� Dior Addict Lip Glow', '<p>��������� ���������� Color Reviver, Dior Addict Lip Glow �������������� ��� �������������� ������� ������������� ���, �������� ��������� �������� ����������� ����������.</p>', '<p>������ ������� ���������� � ������������ ������� ����� ���, �������� �� ����������� ����. ��������� ���������� Color Reviver, Dior Addict Lip Glow �������������� ��� �������������� ������� ������������� ���, �������� ��������� �������� ����������� ����������.&nbsp;</p>', 5000, 0, '0', '1', '1', '', '1', '164,165,166,167,168', 'i51-140ii49-137i', 0x613a323a7b693a35313b613a313a7b693a303b733a333a22313430223b7d693a34393b613a313a7b693a303b733a333a22313337223b7d7d, '1', 0, '0', '', '0', 1409314979, 'developers,', 0, '', '0', '', '', '������� ��� ��� Dior', '1', '', '/UserFiles/Image/Trial/img169_37697s.jpg', '/UserFiles/Image/Trial/img169_37697.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 10, 0, 6000, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, ''),
(178, 63, '��������� ���� Dior Addict Eau de Toilette', '<p>Agent Provocateur Maitresse Eau Provocateur&nbsp;- ���� ��������� ��������� ����� �������� ����� ����������� � ������ �������������� ������������� �������&nbsp;Agent Provocateur&nbsp;2000 ����. ���� ������������ ������ ������ �������������� ��������� ���������, �� ��� ������ ������ �������� ��� ������������� �������.</p>', '<p>Agent Provocateur Maitresse Eau Provocateur&nbsp;- ���� ��������� ��������� ����� �������� ����� ����������� � ������ �������������� ������������� �������&nbsp;Agent Provocateur&nbsp;2000 ����. ���� ������������ ������ ������ �������������� ��������� ���������, �� ��� ������ ������ �������� ��� ������������� �������.</p>', 3000, 0, '0', '1', '1', '', '0', '179,180,181', 'i52-145ii51-140i', 0x613a323a7b693a35323b613a313a7b693a303b733a333a22313435223b7d693a35313b613a313a7b693a303b733a333a22313430223b7d7d, '1', 0, '0', '', '0', 1409310566, ' ', 0, '', '0', '', '', '������ �������', '1', '', '/UserFiles/Image/Trial/img178_41195s.jpg', '/UserFiles/Image/Trial/img178_41195.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 10, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, ''),
(171, 62, '���������� ����� Tom Ford', '<p>������������� ���� � ������ �������� ��������� �� 5-10 ����� ��������� ��� �������� ��������� (����� � ����� ��� �������, ��������), ������������ � ���������� ���� ������ ����, �������� ����� �����, �������� �������� �������� � ��������.</p>', '<p>������������� ���� � ������ �������� ��������� �� 5-10 ����� ��������� ��� �������� ��������� (����� � ����� ��� �������, ��������), ������������ � ���������� ���� ������ ����, �������� ����� �����, �������� �������� �������� � ��������.</p>', 4000, 0, '0', '1', '1', '', '1', '172,177,174,175,176', 'i49-135i', 0x613a313a7b693a34393b613a313a7b693a303b733a333a22313335223b7d7d, '1', 0, '0', '', '0', 1409310507, 'developers,help,forma,', 0, '', '0', '', '', '����� ��� ����', '1', '', '/UserFiles/Image/Trial/img171_41948s.jpg', '/UserFiles/Image/Trial/img171_41948.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 45, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 1, ''),
(172, 62, '���������� ����� ��� ������� ���� Clarins', '<p>������������� ���� � ������ �������� ��������� �� 5-10 ����� ��������� ��� �������� ��������� (����� � ����� ��� �������, ��������), ������������ � ���������� ���� ������ ����, �������� ����� �����, �������� �������� �������� � ��������.</p>', '<p>������������� ���� � ������ �������� ��������� �� 5-10 ����� ��������� ��� �������� ��������� (����� � ����� ��� �������, ��������), ������������ � ���������� ���� ������ ����, �������� ����� �����, �������� �������� �������� � ��������.</p>', 2800, 0, '0', '1', '1', '', '1', '171,177,174,175,176', 'i51-139ii49-143i', 0x613a323a7b693a35313b613a313a7b693a303b733a333a22313339223b7d693a34393b613a313a7b693a303b733a333a22313433223b7d7d, '1', 0, '0', '', '0', 1409310514, ' ', 0, '', '0', '', '', '����� ��� ����', '1', '', '/UserFiles/Image/Trial/img172_81522s.jpg', '/UserFiles/Image/Trial/img172_81522.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 28, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 1, ''),
(177, 62, '������ ����������� ���� Payot', '<p>���� Payot Hydra 24 Creme Melting, Multi-Hydrating Cream With Hydro-Dermo-Regulating Complex � ���������� ������ ��������� - ������� ������� � �������� ������������ ����, ������� ��������� � �������� � ��������.</p>', '<p>���� Payot Hydra 24 Creme Melting, Multi-Hydrating Cream With Hydro-Dermo-Regulating Complex � ���������� ������ ��������� - ������� ������� � �������� ������������ ����, ������� ��������� � �������� � ��������.</p>', 2700, 0, '0', '1', '1', '', '1', '171,172,174,175,176', 'i51-141ii49-137i', 0x613a323a7b693a35313b613a313a7b693a303b733a333a22313431223b7d693a34393b613a313a7b693a303b733a333a22313337223b7d7d, '1', 0, '0', '', '0', 1409310530, 'design,', 0, '', '0', '', '', '���� �����������', '1', '', '/UserFiles/Image/Trial/img177_33642s.jpg', '/UserFiles/Image/Trial/img177_33642.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 14, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 1, ''),
(174, 62, 'Lancome Nutrix Royal Body ���� ��� ���� �����������', '<p>LANCOME ����������� � ����������� ���� ��� ���� Nutrix Royal Body&nbsp;����������� ����������� � ����������� ����&nbsp;Nutrix Royal Body&nbsp;������ ��� ���������� ������ ����� � ������������ ����.&nbsp;</p>', '<p>LANCOME ����������� � ����������� ���� ��� ���� Nutrix Royal Body&nbsp;����������� ����������� � ����������� ����&nbsp;Nutrix Royal Body&nbsp;������ ��� ���������� ������ ����� � ������������ ����.&nbsp;</p>', 3500, 0, '0', '1', '1', '', '1', '171,172,177,175,176', 'i51-146ii49-135ii49-143i', 0x613a323a7b693a35313b613a313a7b693a303b733a333a22313436223b7d693a34393b613a323a7b693a303b733a333a22313335223b693a313b733a333a22313433223b7d7d, '1', 0, '0', '', '0', 1409310539, 'design,', 0, '', '0', '', '', '���� �����������', '1', '', '/UserFiles/Image/Trial/img174_40842s.jpg', '/UserFiles/Image/Trial/img174_40842.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 32, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, ''),
(175, 62, '����������� ���� ��� ���� Nutricia Intense Payot', '<p>Nutricia Creme - ����������, ������ ����, ������� ���� �� ����. ������������ ��� �������������� ������������ � �������� ���� �� ����. � ��� ���������� �������� � ������������ � ������������ ����������, �� �������� �������� ��� ����� � ����� ����� ����.</p>', '<p>Nutricia Creme - ����������, ������ ����, ������� ���� �� ����. ������������ ��� �������������� ������������ � �������� ���� �� ����. � ��� ���������� �������� � ������������ � ������������ ����������, �� �������� �������� ��� ����� � ����� ����� ����. Nutricia Creme ���������� ������, ��������������� � ��������� ����.&nbsp;</p>', 2500, 0, '0', '1', '1', '', '1', '171,172,177,174,176', 'i51-141ii49-135ii49-143i', 0x613a323a7b693a35313b613a313a7b693a303b733a333a22313431223b7d693a34393b613a323a7b693a303b733a333a22313335223b693a313b733a333a22313433223b7d7d, '1', 0, '0', '', '0', 1409312068, 'design,', 0, '', '0', '', '', '���� �����������', '1', '', '/UserFiles/Image/Trial/img175_15382s.jpg', '/UserFiles/Image/Trial/img175_15382.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 23, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, ''),
(176, 62, '������������� ����� ��� ���� Clarins', '<p>������������� ����� ��� ���� � ����������� �������, ������ � ��������. ������������ ������� ������������, ������� ���� �������� � ����� � ����� ��������.&nbsp;</p>', '<p>������������� ����� ��� ���� � ����������� �������, ������ � ��������. ������������ ������� ������������, ������� ���� �������� � ����� � ����� ��������.&nbsp;</p>', 5600, 0, '0', '1', '1', '', '1', '171,172,177,174,175', 'i51-139ii49-143i', 0x613a323a7b693a35313b613a313a7b693a303b733a333a22313339223b7d693a34393b613a313a7b693a303b733a333a22313433223b7d7d, '1', 0, '0', '', '0', 1406640160, 'admin,', 0, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img176_22056s.jpg', '/UserFiles/Image/Trial/img176_22056.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 15, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 1, ''),
(179, 63, '���� Feerie Eau de Toilette', '<p>Agent Provocateur Maitresse Eau Provocateur&nbsp;- ���� ��������� ��������� ����� �������� ����� ����������� � ������ �������������� ������������� �������&nbsp;Agent Provocateur&nbsp;2000 ����. ���� ������������ ������ ������ �������������� ��������� ���������, �� ��� ������ ������ �������� ��� ������������� �������.</p>', '<p>Agent Provocateur Maitresse Eau Provocateur&nbsp;- ���� ��������� ��������� ����� �������� ����� ����������� � ������ �������������� ������������� �������&nbsp;Agent Provocateur&nbsp;2000 ����. ���� ������������ ������ ������ �������������� ��������� ���������, �� ��� ������ ������ �������� ��� ������������� �������.</p>', 3790, 4000, '0', '1', '1', '', '1', '178,180,181', 'i52-144i', 0x613a313a7b693a35323b613a313a7b693a303b733a333a22313434223b7d7d, '1', 0, '0', '', '0', 1409575140, ' ', 0, '', '0', '', '', '������� �������', '1', '', '/UserFiles/Image/Trial/img179_28544s.jpg', '/UserFiles/Image/Trial/img179_28544.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 7, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 2, ''),
(180, 63, '����.  ���� Lancome Miracle So Magic', '<p>����� ���������� �������-�����, �������-�������, ����������� ������������, ��������������, ������������������, ������ ���������� ����������, ������ ��� ��������������� ��������, ������� ���� ��������� ���� � �������.&nbsp;</p>', '<p>����� ���������� �������-�����, �������-�������, ����������� ������������, ��������������, ������������������, ������ ���������� ����������, ������ ��� ��������������� ��������, ������� ���� ��������� ���� � �������. ��� �������� ��������� �������, ������� &laquo;� ���������&raquo;. Miracle So Magic ����� ����� �������������� ����, ������ � �������, ������� ����������, � ����� �������� ������������ � �������� ������� ���������.&nbsp;</p>', 1200, 0, '0', '1', '1', '', '1', '178,179,181', 'i52-145ii51-146i', 0x613a323a7b693a35323b613a313a7b693a303b733a333a22313435223b7d693a35313b613a313a7b693a303b733a333a22313436223b7d7d, '1', 0, '0', '', '0', 1409310595, ' ', 0, '', '0', '', '', '������ �������', '1', '', '/UserFiles/Image/Trial/img180_12098s.jpg', '/UserFiles/Image/Trial/img180_12098.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 9, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 1.5, 2, ''),
(190, 51, '����� ������� Hugo Boss', '<p>������ - ������ �� ������, ������ ��� ���������� �������� � �������� ������. �� ������ ������� ����� ���������� �������������� ������ �� ������.&nbsp;</p>', '<p><span>������ - ������ �� ������, ������ ��� ���������� �������� � �������� ������. �� ������ ������� ����� ���������� �������������� ������ �� ������. ��������� ����� ��������� �� ������� ������������ �����. ������ �������� ����� �������� ������� � ������� �������� ������.&nbsp;</span></p>', 45000, 0, '0', '1', '1', '', '0', '', 'i45-133ii46-131i', 0x613a323a7b693a34353b613a313a7b693a303b733a333a22313333223b7d693a34363b613a313a7b693a303b733a333a22313331223b7d7d, '1', 0, '1', '', '0', 1409311982, ' ', 0, '', '0', '', '', '����� � �������', '1', '', '/UserFiles/Image/Trial/img190_79470s.jpg', '/UserFiles/Image/Trial/img190_79470.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, ''),
(194, 15, '������ �� ������� ����������� ��������� Hugo Boss', '<p>������ �� ������� ����������� ���������. ������: ��������������� ����, ������� �����, �������� ��������������� ����� 3/4, ��������� �����, ������ ���������, ����� �������� �� ������.</p>', '<p>������ �� ������� ����������� ���������. ������: ��������������� ����, ������� �����, �������� ��������������� ����� 3/4, ��������� �����, ������ ���������, ����� �������� �� ������.</p>', 9500, 0, '0', '1', '1', '', '0', '136,137,135,133,132,138', 'i56-155ii56-156ii56-157ii45-133ii46-132ii46-129i', 0x613a333a7b693a35363b613a333a7b693a303b733a333a22313535223b693a313b733a333a22313536223b693a323b733a333a22313537223b7d693a34353b613a313a7b693a303b733a333a22313333223b7d693a34363b613a323a7b693a303b733a333a22313332223b693a313b733a333a22313239223b7d7d, '1', 3, '0', '', '0', 1409345485, 'design,developers,', 0, '', '0', '', '', '����������� ������', '1', '', '/UserFiles/Image/Trial/img194_42001s.jpg', '/UserFiles/Image/Trial/img194_42001.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 45, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, ''),
(181, 63, '������� ��������� ���� Nautic Spirit', '<p>������ ��������� ���� � ������� �� ����� �� ����� Baldessarini STRICTLY PRIVATE men �������� �������, �������� �������� ���� �������. �� ������� � ������ � ���� �, ��� �������� ����������, ������ ����� ��� ��������� � ������� �� ���� �������.</p>', '<p>������ ��������� ���� � ������� �� ����� �� ����� Baldessarini STRICTLY PRIVATE men �������� �������, �������� �������� ���� �������. �� ������� � ������ � ���� �, ��� �������� ����������, ������ ����� ��� ��������� � ������� �� ���� �������.</p>', 4000, 0, '0', '1', '1', '', '1', '178,179,180', 'i52-144i', 0x613a313a7b693a35323b613a313a7b693a303b733a333a22313434223b7d7d, '1', 0, '0', '', '0', 1409310612, ' ', 0, '', '0', '', '', '������� �������', '1', '', '/UserFiles/Image/Trial/img181_20890s.jpg', '/UserFiles/Image/Trial/img181_20890.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 4, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 2, ''),
(189, 51, '������� ����� Versace', '<p>������� �����, ����������� �� ������������� ���� ������� ����� � ��������� ��� "��������" � �������� ������������ ��������� �� ������� � ���� �������. ����� ����� ���� ��������� � ����������� �� ��������-������.</p>', '<p>������� �����, ����������� �� ������������� ���� ������� ����� � ��������� ��� "��������" � �������� ������������ ��������� �� ������� � ���� �������. ����� ����� ���� ��������� � ����������� �� ��������-������.</p>', 15000, 0, '0', '1', '1', '', '1', '', 'i45-127ii46-129i', 0x613a323a7b693a34353b613a313a7b693a303b733a333a22313237223b7d693a34363b613a313a7b693a303b733a333a22313239223b7d7d, '1', 3, '1', '', '0', 1409310922, ' ', 0, '', '0', '', '', '�����-�����', '1', '', '/UserFiles/Image/Trial/img189_17383s.jpg', '/UserFiles/Image/Trial/img189_17383.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 18, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, ''),
(191, 51, '������ ������� Adidas', '<p>�������� ������� ������ ������ ������� ����������� ��� ���, ��� ����� �������� � �������. ������ �������� �� ����������� ���� � �������� �� ������ ����������� ��������. ������� ������������� �� ������������� ������.</p>', '<p>�������� ������� ������ ������ ������� ����������� ��� ���, ��� ����� �������� � �������. ������ �������� �� ����������� ���� � �������� �� ������ ����������� ��������. ������� ������������� �� ������������� ������.</p>', 5000, 0, '0', '1', '1', '', '0', '189,116,117,190', 'i45-134ii46-131ii46-130ii46-128i', 0x613a323a7b693a34353b613a313a7b693a303b733a333a22313334223b7d693a34363b613a333a7b693a303b733a333a22313331223b693a313b733a333a22313330223b693a323b733a333a22313238223b7d7d, '1', 0, '1', '', '0', 1409311029, ' ', 0, '', '0', '', '', '������ �������', '1', '', '/UserFiles/Image/Trial/img191_16488s.jpg', '/UserFiles/Image/Trial/img191_16488.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 2, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, ''),
(192, 51, '������ ������� Versace', '<p>�������� &nbsp;������ ������ ������� ����������� ��� ���, ��� ����� �������� � �������. ������ �������� �� ����������� ���� � �������� �� ������ ����������� ��������. ������� ������������� �� ������������� ������.</p>', '<p>�������� ������ ������ ������� ����������� ��� ���, ��� ����� �������� � �������. ������ �������� �� ����������� ���� � �������� �� ������ ����������� ��������. ������� ������������� �� ������������� ������.</p>', 5600, 0, '0', '1', '1', '100', '0', '189,116,117,190,191', 'i45-127ii46-131ii46-130ii46-128i', 0x613a323a7b693a34353b613a313a7b693a303b733a333a22313237223b7d693a34363b613a333a7b693a303b733a333a22313331223b693a313b733a333a22313330223b693a323b733a333a22313238223b7d7d, '1', 0, '1', '', '0', 1409311040, ' ', 0, '', '0', '', '', '������ �������', '1', '', '/UserFiles/Image/Trial/img192_38925s.jpg', '/UserFiles/Image/Trial/img192_38925.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 19, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, ''),
(193, 50, '���� ����������� Swatch', '<p>�������� ������� ���� �������� �������� ��������� ���������� MIYOTA 2035. ������ �������� �� ������������������ ����������� ����� ����������� �����.</p>', '<p>�������� ������� ���� �������� �������� ��������� ���������� MIYOTA 2035. ������ �������� �� ������������������ ����������� ����� ����������� �����.</p>', 9000, 0, '0', '1', '1', '', '0', '119,184,121', 'i46-131ii46-130i', 0x613a313a7b693a34363b613a323a7b693a303b733a333a22313331223b693a313b733a333a22313330223b7d7d, '1', 0, '1', '', '0', 1409311185, ' ', 0, '', '0', '', '', '����������� ����', '1', '', '/UserFiles/Image/Trial/img193_14463s.jpg', '/UserFiles/Image/Trial/img193_14463.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 3, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, ''),
(195, 15, '������ �� �������� ��������� Hugo Boss', '<p>������ �� �������� ������ ���������� �������� ��������� �����. �������� ������� ����� ����������� �������� �������� ��������. ������: �������� �� ������ �� ������, ������� ������������ ���������� ������� �� ������, ���������� ����.</p>', '<p>������ �� �������� ������ ���������� �������� ��������� �����. �������� ������� ����� ����������� �������� �������� ��������. ������: �������� �� ������ �� ������, ������� ������������ ���������� ������� �� ������, ���������� ����.</p>', 38475, 0, '0', '1', '1', '', '1', '136,135,134,133,132,138', 'i56-156ii56-157ii45-133ii46-131ii46-130ii46-128i', 0x613a333a7b693a35363b613a323a7b693a303b733a333a22313536223b693a313b733a333a22313537223b7d693a34353b613a313a7b693a303b733a333a22313333223b7d693a34363b613a333a7b693a303b733a333a22313331223b693a313b733a333a22313330223b693a323b733a333a22313238223b7d7d, '1', 5, '0', '', '0', 1409346598, ' ', 0, '', '0', '', '', '������� ������', '1', '', '/UserFiles/Image/Trial/img195_12793s.jpg', '/UserFiles/Image/Trial/img195_12793.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 2, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_rating_categories`
--

CREATE TABLE IF NOT EXISTS `phpshop_rating_categories` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `ids_dir` varchar(255) DEFAULT '',
  `name` varchar(255) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '0',
  `revoting` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_rating_categories`
--

INSERT INTO `phpshop_rating_categories` (`id_category`, `ids_dir`, `name`, `enabled`, `revoting`) VALUES
(1, ',2,,3,,4,,6,,7,,8,,10,,11,,12,', '������', '1', '1');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_rating_charact`
--

CREATE TABLE IF NOT EXISTS `phpshop_rating_charact` (
  `id_charact` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) DEFAULT '0',
  `name` varchar(255)  DEFAULT '',
  `num` int(11) DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id_charact`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_rating_charact`
--

INSERT INTO `phpshop_rating_charact` (`id_charact`, `id_category`, `name`, `num`, `enabled`) VALUES
(1, 1, '������� ���', 1, '1'),
(2, 1, '����������������', 2, '1'),
(3, 1, '��������', 3, '1');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_rating_votes`
--

CREATE TABLE IF NOT EXISTS `phpshop_rating_votes` (
  `id_vote` int(11) NOT NULL AUTO_INCREMENT,
  `id_charact` int(11)DEFAULT '0',
  `id_good` int(11) DEFAULT '0',
  `id_user` int(11) DEFAULT '0',
  `userip` varchar(16) DEFAULT '',
  `rate` tinyint(4) DEFAULT '0',
  `date` int(11) DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id_vote`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_rssgraber`
--

CREATE TABLE IF NOT EXISTS `phpshop_rssgraber` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `link` text,
  `day_num` int(1) DEFAULT '1',
  `news_num` mediumint(8) DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '1',
  `start_date` int(16) unsigned DEFAULT '0',
  `end_date` int(16) unsigned DEFAULT '0',
  `last_load` int(16) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_rssgraber`
--

INSERT INTO `phpshop_rssgraber` (`id`, `link`, `day_num`, `news_num`, `enabled`, `start_date`, `end_date`, `last_load`) VALUES
(1, 'http://www.phpshop.ru/rss/', 1, 10, '1', 1307995200, 1606766400, 1409688000);

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_rssgraber_jurnal`
--

CREATE TABLE IF NOT EXISTS `phpshop_rssgraber_jurnal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` int(15) unsigned DEFAULT '0',
  `link_id` int(11) DEFAULT '0',
  `status` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_search_base`
--

CREATE TABLE IF NOT EXISTS `phpshop_search_base` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `uid` varchar(255) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_search_jurnal`
--

CREATE TABLE IF NOT EXISTS `phpshop_search_jurnal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `num` tinyint(32) DEFAULT '0',
  `datas` varchar(11) DEFAULT '',
  `dir` varchar(255)  DEFAULT '',
  `cat` tinyint(11) DEFAULT '0',
  `set` tinyint(2)  DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

INSERT INTO `phpshop_search_jurnal` (`id`, `name`, `num`, `datas`, `dir`, `cat`, `set`) VALUES
(1, '����� �������', 3, '1451057356', '', 0, 0),
(2, '������ ������ hugo boss', 13, '1451057378', '', 0, 0);

--
-- ��������� ������� `phpshop_servers`
--

CREATE TABLE IF NOT EXISTS `phpshop_servers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `host` varchar(255) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_shopusers`
--

CREATE TABLE IF NOT EXISTS `phpshop_shopusers` (
  `id` int(64) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(64) DEFAULT '',
  `password` varchar(64) DEFAULT '',
  `datas` varchar(64) DEFAULT '',
  `mail` varchar(64) DEFAULT '',
  `name` varchar(255) DEFAULT '',
  `company` varchar(255) DEFAULT '',
  `inn` varchar(64) DEFAULT '',
  `tel` varchar(64) DEFAULT '',
  `adres` text,
  `enabled` enum('0','1') DEFAULT '0',
  `status` varchar(64) DEFAULT '0',
  `kpp` varchar(64) DEFAULT '',
  `tel_code` varchar(64) DEFAULT '',
  `wishlist` blob,
  `data_adres` blob,
  `cumulative_discount` INT(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_shopusers`
--

INSERT INTO `phpshop_shopusers` (`id`, `login`, `password`, `datas`, `mail`, `name`, `company`, `inn`, `tel`, `adres`, `enabled`, `status`, `kpp`, `tel_code`, `wishlist`, `data_adres`) VALUES
(1, 'test@mail.ru', 'MWZsOG5lcm8=', '1409225144', 'test@mail.ru', '����� �������', '', '', '', '', '1', '0', '', '', 0x613a323a7b693a3139303b693a313b693a3132313b693a313b7d, 0x613a323a7b733a343a226c697374223b613a313a7b693a303b613a32323a7b733a31313a22636f756e7472795f6e6577223b733a303a22223b733a393a2273746174655f6e6577223b733a303a22223b733a383a22636974795f6e6577223b733a303a22223b733a393a22696e6465785f6e6577223b733a303a22223b733a373a2266696f5f6e6577223b733a31343a22ceebfce3e020cfe5f2f0eee2e020223b733a373a2274656c5f6e6577223b733a31303a2231323334353637383930223b733a31303a227374726565745f6e6577223b733a303a22223b733a393a22686f7573655f6e6577223b733a303a22223b733a393a22706f7263685f6e6577223b733a303a22223b733a31343a22646f6f725f70686f6e655f6e6577223b733a303a22223b733a383a22666c61745f6e6577223b733a303a22223b733a31333a2264656c697674696d655f6e6577223b733a31303a22f120313020e4ee203139223b733a31323a226f72675f6e616d655f6e6577223b733a32373a222a20cde0e8ece5edeee2e0ede8e520eef0e3e0ede8e7e0f6e8e820223b733a31313a226f72675f696e6e5f6e6577223b733a343a22c8cdcd20223b733a31313a226f72675f6b70705f6e6577223b733a333a22cacfcf223b733a31373a226f72675f7975725f61647265735f6e6577223b733a31343a22d2e5f1f2eee2e0ff20f3ebe8f6e0223b733a31383a226f72675f66616b745f61647265735f6e6577223b733a32363a22d2e5f1f2eee2e0ff20f3ebe8f6e020f4e0eaf2e8f7e5f1eae0ff223b733a31313a226f72675f7261735f6e6577223b733a31343a22f0e0f1f7e5f2edfbe920f1f7e5f2223b733a31323a226f72675f62616e6b5f6e6577223b733a31383a22ede0e8ece5edeee2e0ede8e520e1e0edeae0223b733a31313a226f72675f6b6f725f6e6577223b733a393a22eaeef0f020f1f7e5f2223b733a31313a226f67725f62696b5f6e6577223b733a303a22223b733a31323a226f72675f636974795f6e6577223b733a363a22e3eef0eee420223b7d7d733a343a226d61696e223b693a303b7d),
(2, 'test2@gmail.com', 'ZjE0cDQ4d3Y=', '1406906469', 'test2@gmail.com', '���� ������', '', '', '', '', '1', '0', '', '', 0x613a303a7b7d, 0x613a323a7b733a343a226c697374223b613a323a7b693a303b613a32323a7b733a31313a22636f756e7472795f6e6577223b733a303a22223b733a393a2273746174655f6e6577223b733a303a22223b733a383a22636974795f6e6577223b733a303a22223b733a393a22696e6465785f6e6577223b733a303a22223b733a373a2266696f5f6e6577223b733a31343a22ceebfce3e020cfe5f2f0eee2e020223b733a373a2274656c5f6e6577223b733a31303a2231323334353637383930223b733a31303a227374726565745f6e6577223b733a303a22223b733a393a22686f7573655f6e6577223b733a303a22223b733a393a22706f7263685f6e6577223b733a303a22223b733a31343a22646f6f725f70686f6e655f6e6577223b733a303a22223b733a383a22666c61745f6e6577223b733a303a22223b733a31333a2264656c697674696d655f6e6577223b733a31303a22f120313020e4ee203139223b733a31323a226f72675f6e616d655f6e6577223b733a303a22223b733a31313a226f72675f696e6e5f6e6577223b733a303a22223b733a31313a226f72675f6b70705f6e6577223b733a303a22223b733a31373a226f72675f7975725f61647265735f6e6577223b733a303a22223b733a31383a226f72675f66616b745f61647265735f6e6577223b733a303a22223b733a31313a226f72675f7261735f6e6577223b733a303a22223b733a31323a226f72675f62616e6b5f6e6577223b733a303a22223b733a31313a226f72675f6b6f725f6e6577223b733a303a22223b733a31313a226f67725f62696b5f6e6577223b733a303a22223b733a31323a226f72675f636974795f6e6577223b733a303a22223b7d693a313b613a32323a7b733a31313a22636f756e7472795f6e6577223b733a303a22223b733a393a2273746174655f6e6577223b733a303a22223b733a383a22636974795f6e6577223b733a303a22223b733a393a22696e6465785f6e6577223b733a303a22223b733a373a2266696f5f6e6577223b733a31343a22cbe5ede020cfe8f0eee6eaeee2e0223b733a373a2274656c5f6e6577223b733a31303a2231323334353637383930223b733a31303a227374726565745f6e6577223b733a303a22223b733a393a22686f7573655f6e6577223b733a303a22223b733a393a22706f7263685f6e6577223b733a303a22223b733a31343a22646f6f725f70686f6e655f6e6577223b733a303a22223b733a383a22666c61745f6e6577223b733a303a22223b733a31333a2264656c697674696d655f6e6577223b733a31303a22f120313020e4ee203139223b733a31323a226f72675f6e616d655f6e6577223b733a303a22223b733a31313a226f72675f696e6e5f6e6577223b733a303a22223b733a31313a226f72675f6b70705f6e6577223b733a303a22223b733a31373a226f72675f7975725f61647265735f6e6577223b733a303a22223b733a31383a226f72675f66616b745f61647265735f6e6577223b733a303a22223b733a31313a226f72675f7261735f6e6577223b733a303a22223b733a31323a226f72675f62616e6b5f6e6577223b733a303a22223b733a31313a226f72675f6b6f725f6e6577223b733a303a22223b733a31313a226f67725f62696b5f6e6577223b733a303a22223b733a31323a226f72675f636974795f6e6577223b733a303a22223b7d7d733a343a226d61696e223b693a303b7d),
(16, 'test3@gmail.com', 'N202bXJpaDk=', '1409309056', 'test3@gmail.com', '����� �������', '', '', '', '', '1', '1', '', '', 0x613a303a7b7d, 0x613a323a7b733a343a226c697374223b613a313a7b693a303b613a32323a7b733a31313a22636f756e7472795f6e6577223b733a303a22223b733a393a2273746174655f6e6577223b733a303a22223b733a383a22636974795f6e6577223b733a303a22223b733a393a22696e6465785f6e6577223b733a303a22223b733a373a2266696f5f6e6577223b733a31333a22ceebfce3e020c8e2e0edeee2e0223b733a373a2274656c5f6e6577223b733a31303a2231323334353637383930223b733a31303a227374726565745f6e6577223b733a303a22223b733a393a22686f7573655f6e6577223b733a303a22223b733a393a22706f7263685f6e6577223b733a303a22223b733a31343a22646f6f725f70686f6e655f6e6577223b733a303a22223b733a383a22666c61745f6e6577223b733a303a22223b733a31333a2264656c697674696d655f6e6577223b733a31303a22f120313020e4ee203139223b733a31323a226f72675f6e616d655f6e6577223b733a303a22223b733a31313a226f72675f696e6e5f6e6577223b733a303a22223b733a31313a226f72675f6b70705f6e6577223b733a303a22223b733a31373a226f72675f7975725f61647265735f6e6577223b733a303a22223b733a31383a226f72675f66616b745f61647265735f6e6577223b733a303a22223b733a31313a226f72675f7261735f6e6577223b733a303a22223b733a31323a226f72675f62616e6b5f6e6577223b733a303a22223b733a31313a226f72675f6b6f725f6e6577223b733a303a22223b733a31313a226f67725f62696b5f6e6577223b733a303a22223b733a31323a226f72675f636974795f6e6577223b733a303a22223b7d7d733a343a226d61696e223b693a303b7d);

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_shopusers_status`
--

CREATE TABLE IF NOT EXISTS `phpshop_shopusers_status` (
  `id` tinyint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `discount` float DEFAULT '0',
  `price` enum('1','2','3','4','5') DEFAULT '1',
  `enabled` enum('0','1') DEFAULT '1',
  `cumulative_discount_check` enum('0','1') DEFAULT '0',
  `cumulative_discount` BLOB,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_shopusers_status`
--

INSERT INTO `phpshop_shopusers_status` (`id`, `name`, `discount`, `price`, `enabled`) VALUES
(1, '�������', 5, '2', '1');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_slider`
--

CREATE TABLE IF NOT EXISTS `phpshop_slider` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '0',
  `num` smallint(6) DEFAULT '0',
  `link` varchar(255) DEFAULT '',
  `alt` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_slider`
--

INSERT INTO `phpshop_slider` (`id`, `image`, `enabled`, `num`, `link`, `alt`) VALUES
(12, '/UserFiles/Image/Trial/Slider/slider2.png', '1', 0, '/spec/', ''),
(9, '/UserFiles/Image/Trial/Slider/slider1.png', '1', 0, '/page/CID_4_uchebnye_materialy.html', '');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_sort`
--

CREATE TABLE IF NOT EXISTS `phpshop_sort` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `category` int(11) unsigned DEFAULT '0',
  `num` int(11) DEFAULT '0',
  `page` varchar(255) DEFAULT '',
  `icon` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_sort`
--

INSERT INTO `phpshop_sort` (`id`, `name`, `category`, `num`, `page`, `icon`) VALUES
(102, 'BABYLISS', 6, 3, '', '/UserFiles/Image/Trial/logo_babyliss120x80.png'),
(111, 'BINATONE', 6, 4, '', '/UserFiles/Image/Trial/logo_binatone120x80.png'),
(112, 'KENWOOD', 6, 5, '', '/UserFiles/Image/Trial/logo_kenwood120x80.png'),
(113, 'MOULINEX', 6, 6, '', '/UserFiles/Image/Trial/logo_mulinex120x80.png'),
(115, 'PHILIPS', 6, 7, '', '/UserFiles/Image/Trial/logo_philips120x80.png'),
(116, 'SAMSUNG', 6, 8, '', '/UserFiles/Image/Trial/logo_sumsung120x80.png'),
(121, '�������', 43, 0, '', '/UserFiles/Image/logo_binatone120x80.png'),
(127, 'Versace', 45, 0, 'versace', '/UserFiles/Image/Trial/brands/versace-logo.png'),
(128, '�������', 46, 0, '', ''),
(129, '������', 46, 0, '', ''),
(130, '�����', 46, 0, '', ''),
(131, '�������', 46, 0, '', ''),
(132, '�����', 46, 0, '', ''),
(133, 'Hugo Boss', 45, 0, 'hugo-boss', '/UserFiles/Image/Trial/brands/hugo-logo.png'),
(134, 'Adidas', 45, 0, 'adidas', '/UserFiles/Image/Trial/brands/adidas-logo.png'),
(135, '��� ���� ����� ����', 49, 0, '', ''),
(144, '������� �������', 52, 0, '', ''),
(137, '��� ������ � ���������� ����', 49, 0, '', ''),
(142, 'Revlon', 51, 0, 'revlon', '/UserFiles/Image/Trial/brands/revlon-logo.png'),
(139, 'Clarins', 51, 1, 'clarins', '/UserFiles/Image/Trial/brands/clarins-logo.png'),
(140, 'Dior', 51, 2, 'dior', '/UserFiles/Image/Trial/brands/dior-logo.png'),
(141, 'Payot', 51, 3, 'payot', '/UserFiles/Image/Trial/brands/payot-logo.png'),
(143, '��� ����� � �������������� ����', 49, 0, '', ''),
(145, '������ �������', 52, 0, '', ''),
(146, 'Lancome', 51, 0, 'lancome', '/UserFiles/Image/Trial/brands/lankome-logo.png'),
(147, 'Canon', 53, 0, 'canon', '/UserFiles/Image/Trial/brands/canon-logo.png'),
(148, 'Nikon', 53, 0, 'nikon', '/UserFiles/Image/Trial/brands/nikon-logo.png'),
(149, 'Sony', 53, 0, 'sony', '/UserFiles/Image/Trial/brands/sony-logo.png'),
(150, 'Garmin', 53, 0, 'garmin', '/UserFiles/Image/Trial/brands/garmin-logo.png'),
(151, '32Mb', 55, 0, '', ''),
(152, '64Mb', 55, 0, '', ''),
(153, '8Gb', 55, 0, '', ''),
(154, '32Gb', 55, 0, '', ''),
(155, '42', 56, 0, '', ''),
(156, '44', 56, 0, '', ''),
(157, '46', 56, 0, '', '');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_sort_categories`
--

CREATE TABLE IF NOT EXISTS `phpshop_sort_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `num` int(11) DEFAULT '0',
  `category` int(11) DEFAULT '0',
  `filtr` enum('0','1') DEFAULT '0',
  `description` varchar(255) DEFAULT '',
  `goodoption` enum('0','1') DEFAULT '0',
  `optionname` enum('0','1') DEFAULT '0',
  `page` varchar(255) DEFAULT '',
  `brand` enum('0','1')  DEFAULT '0',
  `product` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_sort_categories`
--

INSERT INTO `phpshop_sort_categories` (`id`, `name`, `num`, `category`, `filtr`, `description`, `goodoption`, `optionname`, `page`, `brand`) VALUES
(45, '�������� �����', 0, 48, '1', '', '0', '0', '', '1'),
(46, '����', 0, 48, '1', '', '1', '1', '', ''),
(48, '��� �������� ������', 0, 0, '0', '������ ������������� ������ ��� ���������� ���������� ���-� ��� ��������� ���������. �� ������ ������� ������ �������������, � ��������� ���� ����, ������ ����, ����� ��������� ���� ��� ������ ���������. ', '0', '0', '0', ''),
(49, '��� ����� ����', 0, 50, '1', '', '', '0', '', ''),
(50, '��� �������� ���������', 0, 0, '0', '������ ������������� ������ ��� ���������� ���������� ���-� ��� ��������� ���������. ������: �� ������ ������� ������ �������������, � ��������� ���� ����, ������ ����, ����� ��������� ���� ��� ������ ���������. ', '0', '0', '0', ''),
(51, '������������� �����', 0, 50, '1', '', '', '0', '', '1'),
(52, '������', 0, 50, '1', '', '', '', '', ''),
(53, '������������� �����������', 0, 54, '', '', '', '0', '', '1'),
(54, '��� �������� �����������', 0, 0, '0', '������ ������������� ������ ��� ���������� ���������� ���-� ��� ��������� ���������. �� ������ ������� ������ �������������, � ��������� ���� ����, ������ ����, ����� ��������� ���� ��� ������ ���������. ', '0', '0', '', ''),
(55, '���������� ������', 0, 54, '', '', '1', '1', '', ''),
(56, '������', 0, 48, '', '', '1', '1', '', '');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_system`
--

CREATE TABLE IF NOT EXISTS `phpshop_system` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` text,
  `company` text,
  `num_row` int(10) DEFAULT NULL,
  `num_row_adm` int(10) DEFAULT NULL,
  `dengi` tinyint(11) DEFAULT NULL,
  `percent` varchar(16) DEFAULT '',
  `skin` varchar(32) DEFAULT NULL,
  `adminmail2` varchar(64) DEFAULT '',
  `title` varchar(255)  DEFAULT '',
  `keywords` varchar(255) DEFAULT '',
  `kurs` float DEFAULT '0',
  `spec_num` tinyint(5) DEFAULT '0',
  `new_num` tinyint(11) DEFAULT '0',
  `tel` text,
  `bank` blob,
  `num_vitrina` enum('1','2','3','4') DEFAULT '3',
  `width_icon` varchar(11) DEFAULT '',
  `updateU` varchar(32) DEFAULT '',
  `nds` varchar(64) DEFAULT '',
  `nds_enabled` enum('0','1') DEFAULT '1',
  `admoption` blob,
  `kurs_beznal` tinyint(11) DEFAULT '0',
  `descrip` varchar(255) DEFAULT '',
  `descrip_shablon` varchar(255) DEFAULT '',
  `title_shablon` varchar(255) DEFAULT '',
  `keywords_shablon` varchar(255) DEFAULT '',
  `title_shablon2` varchar(255) DEFAULT '',
  `descrip_shablon2` varchar(255) DEFAULT '',
  `keywords_shablon2` varchar(255) DEFAULT '',
  `logo` varchar(255) DEFAULT '',
  `promotext` text,
  `title_shablon3` varchar(255) DEFAULT '',
  `descrip_shablon3` varchar(255) DEFAULT '',
  `keywords_shablon3` varchar(255) DEFAULT '',
  `rss_use` int(1) unsigned DEFAULT '1',
  `1c_load_accounts` enum('0','1') DEFAULT '1',
  `1c_load_invoice` enum('0','1') DEFAULT '1',
  `1c_option` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_system`
--

INSERT INTO `phpshop_system` (`id`, `name`, `company`, `num_row`, `num_row_adm`, `dengi`, `percent`, `skin`, `adminmail2`, `title`, `keywords`, `kurs`, `spec_num`, `new_num`, `tel`, `bank`, `num_vitrina`, `width_icon`, `updateU`, `nds`, `nds_enabled`, `admoption`, `kurs_beznal`, `descrip`, `descrip_shablon`, `title_shablon`, `keywords_shablon`, `title_shablon2`, `descrip_shablon2`, `keywords_shablon2`, `logo`, `promotext`, `title_shablon3`, `descrip_shablon3`, `keywords_shablon3`, `rss_use`, `1c_load_accounts`, `1c_load_invoice`, `1c_option`) VALUES
(1, '�������� ��������-��������', '��������', 9, 0, 6, '0', 'diggi', 'admin@localhost', '����-������ ������� ��������-�������� PHPShop', '������ ��������, ������ ��������-�������', 6, 4, 4, '(495)111-22-33', 0x613a393a7b733a383a226f72675f6e616d65223b733a31343a22cecece2022cff0eee4e0e2e5f622223b733a31323a226f72675f75725f6164726573223b733a34313a2230303030303020e32e20cceef1eae2e02c20f3eb2e20def0e8e4e8f7e5f1eae0ff2c20e4eeec20312e223b733a393a226f72675f6164726573223b733a33303a22cceef1eae2e02c20f3eb2e20d4e8e7e8f7e5f1eae0ff2c20e4eeec20312e223b733a373a226f72675f696e6e223b733a393a22373737373737373737223b733a373a226f72675f6b7070223b733a31303a2238383838383838383838223b733a393a226f72675f7363686574223b733a31363a2231313131313131313131313131313131223b733a383a226f72675f62616e6b223b733a32333a22cec0ce2022c2e0f820f2e5f1f2eee2fbe920e1e0edea22223b733a373a226f72675f626963223b733a383a223436373738383838223b733a31343a226f72675f62616e6b5f7363686574223b733a31353a22323232323232323232323232323232223b7d, '3', '', '1409661405', '18', '1', 0x613a37303a7b733a31373a227072657670616e656c5f656e61626c6564223b733a313a2231223b733a31323a22736b6c61645f737461747573223b733a313a2233223b733a31343a2268656c7065725f656e61626c6564223b733a313a2231223b733a31333a22636c6f75645f656e61626c6564223b693a303b733a32333a226469676974616c5f70726f647563745f656e61626c6564223b693a303b733a31333a22757365725f63616c656e646172223b693a303b733a31393a22757365725f70726963655f6163746976617465223b693a303b733a32323a22757365725f6d61696c5f61637469766174655f707265223b693a303b733a31383a227273735f6772616265725f656e61626c6564223b733a313a2231223b733a31373a22696d6167655f736176655f736f75726365223b733a313a2231223b733a363a22696d675f776d223b4e3b733a353a22696d675f77223b733a333a22333030223b733a353a22696d675f68223b733a333a22333030223b733a363a22696d675f7477223b733a333a22313930223b733a363a22696d675f7468223b733a333a22313930223b733a31343a2277696474685f706f64726f626e6f223b733a333a22313030223b733a31323a2277696474685f6b7261746b6f223b733a333a22313030223b733a31353a226d6573736167655f656e61626c6564223b733a313a2231223b733a31323a226d6573736167655f74696d65223b733a323a223230223b733a31353a226465736b746f705f656e61626c6564223b4e3b733a31323a226465736b746f705f74696d65223b4e3b733a383a226f706c6174615f31223b733a313a2231223b733a383a226f706c6174615f32223b733a313a2231223b733a383a226f706c6174615f33223b733a313a2231223b733a383a226f706c6174615f34223b4e3b733a383a226f706c6174615f35223b733a313a2231223b733a383a226f706c6174615f36223b733a313a2231223b733a383a226f706c6174615f37223b733a313a2231223b733a383a226f706c6174615f38223b733a313a2231223b733a31343a2273656c6c65725f656e61626c6564223b4e3b733a31323a22626173655f656e61626c6564223b4e3b733a31313a22736d735f656e61626c6564223b693a303b733a31343a226e6f746963655f656e61626c6564223b693a303b733a31343a227570646174655f656e61626c6564223b733a313a2231223b733a373a22626173655f6964223b733a303a22223b733a393a22626173655f686f7374223b733a303a22223b733a343a226c616e67223b733a373a227275737369616e223b733a31333a22736b6c61645f656e61626c6564223b733a313a2231223b733a31303a2270726963655f7a6e616b223b733a313a2230223b733a31383a22757365725f6d61696c5f6163746976617465223b693a303b733a31313a22757365725f737461747573223b733a313a2230223b733a393a22757365725f736b696e223b733a313a2231223b733a31323a22636172745f6d696e696d756d223b733a343a2231303030223b733a31343a22656469746f725f656e61626c6564223b733a313a2231223b733a31333a2277617465726d61726b5f626967223b613a32313a7b733a31343a226269675f6d657267654c6576656c223b693a37303b733a31313a226269675f656e61626c6564223b733a313a2231223b733a383a226269675f74797065223b733a333a22706e67223b733a31323a226269675f706e675f66696c65223b733a33303a222f5573657246696c65732f496d6167652f73686f705f6c6f676f2e706e67223b733a31323a226269675f636f7079466c6167223b733a313a2230223b733a363a226269675f736d223b693a303b733a31363a226269675f706f736974696f6e466c6167223b733a313a2234223b733a31333a226269675f706f736974696f6e58223b693a303b733a31333a226269675f706f736974696f6e59223b693a303b733a393a226269675f616c706861223b693a37303b733a383a226269675f74657874223b733a303a22223b733a32313a226269675f746578745f706f736974696f6e466c6167223b693a303b733a383a226269675f73697a65223b693a303b733a393a226269675f616e676c65223b693a303b733a31383a226269675f746578745f706f736974696f6e58223b693a303b733a31383a226269675f746578745f706f736974696f6e59223b693a303b733a31303a226269675f636f6c6f7252223b693a303b733a31303a226269675f636f6c6f7247223b693a303b733a31303a226269675f636f6c6f7242223b693a303b733a31343a226269675f746578745f616c706861223b693a303b733a383a226269675f666f6e74223b733a31363a226e6f726f626f745f666f6e742e747466223b7d733a31353a2277617465726d61726b5f736d616c6c223b613a32313a7b733a31363a22736d616c6c5f6d657267654c6576656c223b693a3130303b733a31333a22736d616c6c5f656e61626c6564223b733a313a2231223b733a31303a22736d616c6c5f74797065223b733a333a22706e67223b733a31343a22736d616c6c5f706e675f66696c65223b733a32353a222f5573657246696c65732f496d6167652f6c6f676f2e706e67223b733a31343a22736d616c6c5f636f7079466c6167223b733a313a2230223b733a383a22736d616c6c5f736d223b693a303b733a31383a22736d616c6c5f706f736974696f6e466c6167223b733a313a2231223b733a31353a22736d616c6c5f706f736974696f6e58223b693a303b733a31353a22736d616c6c5f706f736974696f6e59223b693a303b733a31313a22736d616c6c5f616c706861223b693a35303b733a31303a22736d616c6c5f74657874223b733a303a22223b733a32333a22736d616c6c5f746578745f706f736974696f6e466c6167223b693a303b733a31303a22736d616c6c5f73697a65223b693a303b733a31313a22736d616c6c5f616e676c65223b693a303b733a32303a22736d616c6c5f746578745f706f736974696f6e58223b693a303b733a32303a22736d616c6c5f746578745f706f736974696f6e59223b693a303b733a31323a22736d616c6c5f636f6c6f7252223b693a303b733a31323a22736d616c6c5f636f6c6f7247223b693a303b733a31323a22736d616c6c5f636f6c6f7242223b693a303b733a31363a22736d616c6c5f746578745f616c706861223b693a303b733a31303a22736d616c6c5f666f6e74223b733a31363a226e6f726f626f745f666f6e742e747466223b7d733a31353a2277617465726d61726b5f6973686f64223b613a32313a7b733a31363a226973686f645f6d657267654c6576656c223b693a3130303b733a31333a226973686f645f656e61626c6564223b4e3b733a31303a226973686f645f74797065223b733a333a22706e67223b733a31343a226973686f645f706e675f66696c65223b733a303a22223b733a31343a226973686f645f636f7079466c6167223b733a313a2230223b733a383a226973686f645f736d223b693a303b733a31383a226973686f645f706f736974696f6e466c6167223b733a313a2231223b733a31353a226973686f645f706f736974696f6e58223b693a303b733a31353a226973686f645f706f736974696f6e59223b693a303b733a31313a226973686f645f616c706861223b693a303b733a31303a226973686f645f74657874223b733a303a22223b733a32333a226973686f645f746578745f706f736974696f6e466c6167223b693a303b733a31303a226973686f645f73697a65223b693a303b733a31313a226973686f645f616e676c65223b693a303b733a32303a226973686f645f746578745f706f736974696f6e58223b693a303b733a32303a226973686f645f746578745f706f736974696f6e59223b693a303b733a31323a226973686f645f636f6c6f7252223b693a303b733a31323a226973686f645f636f6c6f7247223b693a303b733a31323a226973686f645f636f6c6f7242223b693a303b733a31363a226973686f645f746578745f616c706861223b693a303b733a31303a226973686f645f666f6e74223b733a31363a226e6f726f626f745f666f6e742e747466223b7d733a31303a2263616c69627261746564223b4e3b733a31343a226e6f776275795f656e61626c6564223b733a313a2232223b733a393a22786d6c656e636f6465223b733a353a225554462d38223b733a363a22656469746f72223b733a373a2274696e796d6365223b733a353a227468656d65223b733a373a2264656661756c74223b733a32343a22736d735f7374617475735f6f726465725f656e61626c6564223b693a303b733a31373a226d61696c5f736d74705f7265706c79746f223b733a303a22223b733a393a22736d735f70686f6e65223b733a303a22223b733a383a22736d735f75736572223b733a303a22223b733a383a22736d735f70617373223b733a303a22223b733a383a22736d735f6e616d65223b733a303a22223b733a393a226163655f7468656d65223b733a343a226461776e223b733a393a2261646d5f7469746c65223b733a303a22223b733a31343a227365617263685f656e61626c6564223b733a313a2232223b733a31343a226d61696c5f736d74705f686f7374223b733a303a22223b733a31343a226d61696c5f736d74705f706f7274223b733a303a22223b733a31343a226d61696c5f736d74705f75736572223b733a303a22223b733a31343a226d61696c5f736d74705f70617373223b733a303a22223b733a32303a22706172656e745f70726963655f656e61626c6564223b693a303b733a31373a226d61696c5f736d74705f656e61626c6564223b693a303b733a31353a226d61696c5f736d74705f6465627567223b693a303b733a31343a226d61696c5f736d74705f61757468223b693a303b733a31323a2272756c655f656e61626c6564223b693a303b7d, 6, 'PHPShop � ��� ������� ������� ��� �������� �������� ��������-��������.', '@Podcatalog@, @Catalog@, @System@', '@Podcatalog@ - @Catalog@ - @System@', '@Podcatalog@, @Catalog@, @Generator@', '@Product@ - @Podcatalog@ - @Catalog@', '@Product@, @Podcatalog@, @Catalog@', '@Product@,@System@', '/UserFiles/Image/Trial/your_logo.png', '', '@Catalog@ - @System@', '@Catalog@', '@Catalog@', 0, '0', '0', 0x613a353a7b733a31313a227570646174655f6e616d65223b733a313a2231223b733a31343a227570646174655f636f6e74656e74223b733a313a2231223b733a31383a227570646174655f6465736372697074696f6e223b733a313a2231223b733a31353a227570646174655f63617465676f7279223b733a313a2231223b733a31313a227570646174655f736f7274223b733a313a2231223b7d);
-- --------------------------------------------------------


--
-- ��������� ������� `phpshop_users`
--

CREATE TABLE IF NOT EXISTS `phpshop_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` blob,
  `login` varchar(64) DEFAULT '',
  `password` varchar(64) DEFAULT '',
  `mail` varchar(64) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '1',
  `name` varchar(255) DEFAULT '',
  `hash` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_valuta`
--

CREATE TABLE IF NOT EXISTS `phpshop_valuta` (
  `id` tinyint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `code` varchar(64) DEFAULT '',
  `iso` varchar(64) DEFAULT '',
  `kurs` varchar(64) DEFAULT '0',
  `num` tinyint(11) DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_valuta`
--

INSERT INTO `phpshop_valuta` (`id`, `name`, `code`, `iso`, `kurs`, `num`, `enabled`) VALUES
(4, '������', '��.', 'UAU', '0.061', 4, '1'),
(5, '�������', '$', 'USD', '0.016', 0, '1'),
(6, '�����', '���.', 'RUB', '1', 1, '1');


--
-- ��������� ������� `phpshop_citylist_city`
--

CREATE TABLE IF NOT EXISTS `phpshop_citylist_city` (
  `city_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(11) unsigned DEFAULT '0',
  `region_id` int(10) unsigned  DEFAULT '0',
  `name` varchar(128) DEFAULT '',
  PRIMARY KEY (`city_id`),
  KEY `country_id` (`country_id`),
  KEY `region_id` (`region_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ��������� ������� `phpshop_citylist_country`
--

CREATE TABLE IF NOT EXISTS `phpshop_citylist_country` (
  `country_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT '0',
  `name` varchar(128) DEFAULT '',
  PRIMARY KEY (`country_id`),
  KEY `city_id` (`city_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;


--
-- ��������� ������� `phpshop_citylist_region`
--

CREATE TABLE IF NOT EXISTS `phpshop_citylist_region` (
  `region_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned DEFAULT '0',
  `city_id` int(10) unsigned DEFAULT '0',
  `name` varchar(64) DEFAULT '',
  PRIMARY KEY (`region_id`),
  KEY `country_id` (`country_id`),
  KEY `city_id` (`city_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ��������� ������� `phpshop_newsletter`
--

CREATE TABLE IF NOT EXISTS `phpshop_newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `content` text ,
  `template` int(11) DEFAULT '0',
  `date` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_modules_netpay_system`
--

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
