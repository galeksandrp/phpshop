
--
-- ��������� ������� `phpshop_1c_docs`
--

CREATE TABLE `phpshop_1c_docs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `cid` varchar(64) DEFAULT '',
  `datas` int(11) DEFAULT '0',
  `datas_f` int(11) DEFAULT '0',
  `year` int(11) DEFAULT '2018',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_1c_jurnal`
--

CREATE TABLE `phpshop_1c_jurnal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datas` varchar(64) DEFAULT '0',
  `p_name` varchar(64) DEFAULT '',
  `f_name` varchar(64) DEFAULT '',
  `time` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_baners`
--

CREATE TABLE `phpshop_baners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `content` text,
  `count_all` int(11) DEFAULT '0',
  `count_today` int(11) DEFAULT '0',
  `flag` enum('0','1') DEFAULT '0',
  `datas` varchar(32) DEFAULT '',
  `limit_all` int(11) DEFAULT '0',
  `dir` varchar(255) DEFAULT '',
  `dop_cat` varchar(255) default '',
  `servers` varchar(64) default '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_baners`
--

INSERT INTO `phpshop_baners` (`id`, `name`, `content`, `count_all`, `count_today`, `flag`, `datas`, `limit_all`, `dir`) VALUES
(1, '������', '<div><img src="/UserFiles/Image/Trial/slider/banner-1.jpg" alt="������ �����" /></div>', 0, 0, '1', '', 0, 'odezhda,obuv-i-aksessuary'),
(2, '���������', '<p><img src="/UserFiles/Image/Trial/slider/banner-2.jpg" alt="" width="1170" height="200" /></p>', 0, 0, '1', '', 0, 'kosmetika,lico,glaza,guby'),
(3, '�������', '<p><img src="/UserFiles/Image/Trial/slider/banner-3.jpg" alt="" width="1170" height="200" /></p>', 0, 0, '1', '', 0, 'high-tech');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_black_list`
--

CREATE TABLE `phpshop_black_list` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(32) DEFAULT '',
  `datas` varchar(32) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_categories`
--

CREATE TABLE `phpshop_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `num` int(11) DEFAULT '0',
  `parent_to` int(11) NOT NULL DEFAULT '0',
  `yml` enum('0','1') DEFAULT '1',
  `num_row` enum('1','2','3','4') DEFAULT '2',
  `num_cow` tinyint(11) DEFAULT '0',
  `sort` blob,
  `content` text,
  `vid` enum('0','1') DEFAULT '0',
  `name_rambler` varchar(255) DEFAULT '',
  `servers` varchar(255) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `title_enabled` enum('0','1','2') DEFAULT '0',
  `title_shablon` varchar(255) DEFAULT '',
  `descrip` varchar(255) DEFAULT '',
  `descrip_enabled` enum('0','1','2') DEFAULT '0',
  `descrip_shablon` varchar(255) DEFAULT '',
  `keywords` varchar(255) DEFAULT '',
  `keywords_enabled` enum('0','1','2') DEFAULT '0',
  `keywords_shablon` varchar(255) DEFAULT '',
  `skin` varchar(64) DEFAULT '',
  `skin_enabled` enum('0','1') DEFAULT '0',
  `order_by` enum('1','2','3') DEFAULT '3',
  `order_to` enum('1','2') DEFAULT '1',
  `secure_groups` varchar(255) DEFAULT '',
  `icon` varchar(255) DEFAULT '',
  `icon_description` varchar(255) DEFAULT '',
  `count` int(11) DEFAULT '0',
  `cat_seo_name` varchar(255) DEFAULT '',
  `dop_cat` varchar(255) DEFAULT '',
  `parent_title` int(11) DEFAULT '0',
  `sort_cache` blob,
  `sort_cache_created_at` int(11),
  `cat_seo_name_old` VARCHAR(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `parent_to` (`parent_to`),
  KEY `servers` (`servers`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_categories`
--

INSERT INTO `phpshop_categories` (`id`, `name`, `num`, `parent_to`, `yml`, `num_row`, `num_cow`, `sort`, `content`, `vid`, `name_rambler`, `servers`, `title`, `title_enabled`, `title_shablon`, `descrip`, `descrip_enabled`, `descrip_shablon`, `keywords`, `keywords_enabled`, `keywords_shablon`, `skin`, `skin_enabled`, `order_by`, `order_to`, `secure_groups`, `icon`, `icon_description`, `count`, `dop_cat`, `parent_title`, `cat_seo_name`) VALUES
(1, '������', 5, 0, '0', '4', 0, 0x613a333a7b693a303b733a313a2236223b693a313b733a313a2237223b693a323b733a313a2238223b7d, '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '/UserFiles/Image/Trial/catalog-11.jpg', '', 0, '', 0, ''),
(2, '���������', 1, 0, '0', '3', 0, 0x4e3b, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '/UserFiles/Image/Trial/catalog-10.jpg', '', 0, '', 0, ''),
(3, '�����', 2, 0, '0', '3', 0, 0x4e3b, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '/UserFiles/Image/Trial/catalog-1.png', '', 0, '', 0, ''),
(4, '����� � ����������', 3, 0, '0', '3', 0, 0x613a333a7b693a303b733a313a2236223b693a313b733a313a2237223b693a323b733a313a2238223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '/UserFiles/Image/Trial/catalog-9.jpg', '', 0, '', 0, ''),
(5, '������', 6, 0, '0', '3', 0, 0x613a323a7b693a303b733a323a223135223b693a313b733a323a223134223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '/UserFiles/Image/Trial/catalog-8.jpg', '', 0, '', 0, ''),
(6, 'High-tech', 4, 0, '0', '3', 0, 0x613a323a7b693a303b733a323a223133223b693a313b733a323a223132223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '/UserFiles/Image/Trial/catalog-7.jpg', '', 0, '', 2, ''),
(7, '����', 1, 2, '0', '3', 0, 0x613a323a7b693a303b733a313a2231223b693a313b733a313a2233223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/catalog-6.png', '', 0, '', 0, ''),
(8, '�����', 1, 2, '0', '3', 0, 0x613a323a7b693a303b733a313a2231223b693a313b733a313a2233223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/catalog-5.jpg', '', 0, '', 0, ''),
(9, '����', 1, 2, '0', '3', 0, 0x613a323a7b693a303b733a313a2231223b693a313b733a313a2233223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/catalog-4.jpg', '', 0, '', 0, ''),
(10, '���������� �������', 1, 3, '0', '4', 0, 0x4e3b, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/catalog-3.jpg', '', 0, '', 0, ''),
(11, '���������', 1, 3, '0', '3', 0, 0x613a313a7b693a303b733a313a2236223b7d, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/catalog-2.jpg', '', 0, '', 0, ''),
(12, '���������', 1, 3, '0', '3', 0, 0x4e3b, '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/catalog-1.png', '', 0, '', 1, '');


-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_citylist_city`
--

CREATE TABLE `phpshop_citylist_city` (
  `city_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(11) unsigned DEFAULT '0',
  `region_id` int(10) unsigned DEFAULT '0',
  `name` varchar(128) DEFAULT '',
  PRIMARY KEY (`city_id`),
  KEY `country_id` (`country_id`),
  KEY `region_id` (`region_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_citylist_country`
--

CREATE TABLE `phpshop_citylist_country` (
  `country_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT '0',
  `name` varchar(128) DEFAULT '',
  PRIMARY KEY (`country_id`),
  KEY `city_id` (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_citylist_region`
--

CREATE TABLE `phpshop_citylist_region` (
  `region_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned DEFAULT '0',
  `city_id` int(10) unsigned DEFAULT '0',
  `name` varchar(64) DEFAULT '',
  PRIMARY KEY (`region_id`),
  KEY `country_id` (`country_id`),
  KEY `city_id` (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_comment`
--

CREATE TABLE `phpshop_comment` (
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
(1, '1523371255', '������', 16, '���������� ������, ��������� ������, ���� ������ ��������-) ', 19, '1', 4),
(2, '1523371303', '������', 17, '������� ����', 19, '1', 4),
(3, '1523371313', '������', 1, '�������!', 19, '1', 5),
(4, '1523371326', '������', 61, '������� ����', 19, '1', 4),
(5, '1523371341', '������', 58, '��������� ������', 19, '1', 5),
(6, '1523371356', '������', 57, '������� �������', 19, '1', 5),
(7, '1523371367', '������', 60, '���������� ����', 19, '1', 5),
(8, '1523371380', '������', 59, '����� ��������', 19, '1', 5),
(9, '1523371394', '������', 45, '�������!', 19, '1', 5),
(10, '1523371404', '������', 53, '�������!', 19, '1', 5),
(11, '1523371417', '������', 44, '�������� �������', 19, '1', 5),
(12, '1523371431', '������', 52, '������� �����', 19, '1', 5),
(13, '1523371440', '������', 50, '������� ��������', 19, '1', 5),
(14, '1523371455', '������', 2, '��������� ', 19, '1', 5);

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_delivery`
--

CREATE TABLE `phpshop_delivery` (
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
  `ofd_nds` varchar(64) DEFAULT '',
  `sum_max` float DEFAULT '0',
  `servers` varchar(64) default '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_delivery`
--

INSERT INTO `phpshop_delivery` (`id`, `city`, `price`, `enabled`, `flag`, `price_null`, `price_null_enabled`, `PID`, `taxa`, `is_folder`, `city_select`, `data_fields`, `num`, `icon`, `payment`, `ofd_nds`) VALUES
(1, '������', 0, '1', '1', 0, '0', 0, 0, '1', '0', '', 0, '/UserFiles/Image/Payments/city.png', '', ''),
(3, '�������� �������� � �������� ����', 180, '1', '1', 2000, '1', 1, 1, '0', '0', 0x613a323a7b733a373a22656e61626c6564223b613a31323a7b733a373a22636f756e747279223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a353a227374617465223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a343a2263697479223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a353a22696e646578223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a333a2266696f223b613a323a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a333a22d4c8ce223b7d733a333a2274656c223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a373a22d2e5ebe5f4eeed223b733a333a22726571223b733a313a2231223b7d733a363a22737472656574223b613a313a7b733a343a226e616d65223b733a353a22d3ebe8f6e0223b7d733a353a22686f757365223b613a313a7b733a343a226e616d65223b733a333a22c4eeec223b7d733a353a22706f726368223b613a313a7b733a343a226e616d65223b733a373a22cfeee4fae5e7e4223b7d733a31303a22646f6f725f70686f6e65223b613a313a7b733a343a226e616d65223b733a31323a22caeee420e4eeeceef4eeede0223b7d733a343a22666c6174223b613a313a7b733a343a226e616d65223b733a383a22cae2e0f0f2e8f0e0223b7d733a393a2264656c697674696d65223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31363a22caeee3e4e020e4eef1f2e0e2e8f2fc3f223b733a333a22726571223b733a313a2231223b7d7d733a333a226e756d223b613a31323a7b733a373a22636f756e747279223b733a303a22223b733a353a227374617465223b733a303a22223b733a343a2263697479223b733a303a22223b733a353a22696e646578223b733a303a22223b733a333a2266696f223b733a313a2231223b733a333a2274656c223b733a313a2232223b733a363a22737472656574223b733a313a2233223b733a353a22686f757365223b733a313a2234223b733a353a22706f726368223b733a313a2235223b733a31303a22646f6f725f70686f6e65223b733a313a2236223b733a343a22666c6174223b733a313a2237223b733a393a2264656c697674696d65223b733a313a2238223b7d7d, 0, '/UserFiles/Image/Payments/courier.png', '', ''),
(4, '�������� �������� �� ��������� ����', 300, '1', '0', 0, '0', 1, 0, '0', '0', 0x613a323a7b733a373a22656e61626c6564223b613a31323a7b733a373a22636f756e747279223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a353a227374617465223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a343a2263697479223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a353a22696e646578223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a333a2266696f223b613a313a7b733a343a226e616d65223b733a333a22d4c8ce223b7d733a333a2274656c223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a373a22d2e5ebe5f4eeed223b733a333a22726571223b733a313a2231223b7d733a363a22737472656574223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a353a22d3ebe8f6e0223b733a333a22726571223b733a313a2231223b7d733a353a22686f757365223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a333a22c4eeec223b733a333a22726571223b733a313a2231223b7d733a353a22706f726368223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a373a22cfeee4fae5e7e4223b733a333a22726571223b733a313a2231223b7d733a31303a22646f6f725f70686f6e65223b613a323a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31323a22caeee420e4eeeceef4eeede0223b7d733a343a22666c6174223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a383a22cae2e0f0f2e8f0e0223b733a333a22726571223b733a313a2231223b7d733a393a2264656c697674696d65223b613a313a7b733a343a226e616d65223b733a303a22223b7d7d733a333a226e756d223b613a31323a7b733a373a22636f756e747279223b733a303a22223b733a353a227374617465223b733a303a22223b733a343a2263697479223b733a303a22223b733a353a22696e646578223b733a303a22223b733a333a2266696f223b733a313a2231223b733a333a2274656c223b733a313a2232223b733a363a22737472656574223b733a313a2233223b733a353a22686f757365223b733a313a2234223b733a353a22706f726368223b733a313a2235223b733a31303a22646f6f725f70686f6e65223b733a313a2236223b733a343a22666c6174223b733a313a2237223b733a393a2264656c697674696d65223b733a303a22223b7d7d, 0, '/UserFiles/Image/Payments/courier-za-mkad.png', '', ''),
(7, '������', 0, '1', '', 0, '0', 0, 0, '1', '0', '', 1, '/UserFiles/Image/Payments/russia.png', '', ''),
(8, 'EMS', 500, '1', '0', 5000, '1', 7, 50, '0', '1', 0x613a323a7b733a373a22656e61626c6564223b613a31323a7b733a373a22636f756e747279223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a353a227374617465223b613a313a7b733a343a226e616d65223b733a303a22223b7d733a343a2263697479223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a353a22c3eef0eee4223b733a333a22726571223b733a313a2231223b7d733a353a22696e646578223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a363a22c8ede4e5eaf1223b733a333a22726571223b733a313a2231223b7d733a333a2266696f223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31343a22d4c8ce20efeeebf3f7e0f2e5ebff223b733a333a22726571223b733a313a2231223b7d733a333a2274656c223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31383a22d2e5ebe5f4eeed20efeeebf3f7e0f2e5ebff223b733a333a22726571223b733a313a2231223b7d733a363a22737472656574223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a353a22d3ebe8f6e0223b733a333a22726571223b733a313a2231223b7d733a353a22686f757365223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a333a22c4eeec223b733a333a22726571223b733a313a2231223b7d733a353a22706f726368223b613a323a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a373a22cfeee4fae5e7e4223b7d733a31303a22646f6f725f70686f6e65223b613a323a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31323a22caeee420e4eeeceef4eeede0223b7d733a343a22666c6174223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a383a22cae2e0f0f2e8f0e0223b733a333a22726571223b733a313a2231223b7d733a393a2264656c697674696d65223b613a313a7b733a343a226e616d65223b733a303a22223b7d7d733a333a226e756d223b613a31323a7b733a373a22636f756e747279223b733a303a22223b733a353a227374617465223b733a303a22223b733a343a2263697479223b733a313a2231223b733a353a22696e646578223b733a313a2232223b733a333a2266696f223b733a313a2233223b733a333a2274656c223b733a313a2234223b733a363a22737472656574223b733a313a2235223b733a353a22686f757365223b733a313a2236223b733a353a22706f726368223b733a313a2237223b733a31303a22646f6f725f70686f6e65223b733a313a2238223b733a343a22666c6174223b733a313a2239223b733a393a2264656c697674696d65223b733a303a22223b7d7d, 1, '/UserFiles/Image/Payments/ems.png', '', ''),
(9, '����� ������', 900, '1', '0', 5000, '1', 7, 60, '0', '1', 0x613a323a7b733a373a22656e61626c6564223b613a31323a7b733a373a22636f756e747279223b613a313a7b733a343a226e616d65223b733a363a22d1f2f0e0ede0223b7d733a353a227374617465223b613a313a7b733a343a226e616d65223b733a31313a22d0e5e3e8eeed2ff8f2e0f2223b7d733a343a2263697479223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a353a22c3eef0eee4223b733a333a22726571223b733a313a2231223b7d733a353a22696e646578223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a363a22c8ede4e5eaf1223b733a333a22726571223b733a313a2231223b7d733a333a2266696f223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31343a22d4c8ce20efeeebf3f7e0f2e5ebff223b733a333a22726571223b733a313a2231223b7d733a333a2274656c223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31383a22d2e5ebe5f4eeed20efeeebf3f7e0f2e5ebff223b733a333a22726571223b733a313a2231223b7d733a363a22737472656574223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a353a22d3ebe8f6e0223b733a333a22726571223b733a313a2231223b7d733a353a22686f757365223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a333a22c4eeec223b733a333a22726571223b733a313a2231223b7d733a353a22706f726368223b613a323a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a373a22cfeee4fae5e7e4223b7d733a31303a22646f6f725f70686f6e65223b613a323a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31323a22caeee420e4eeeceef4eeede0223b7d733a343a22666c6174223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a383a22cae2e0f0f2e8f0e0223b733a333a22726571223b733a313a2231223b7d733a393a2264656c697674696d65223b613a313a7b733a343a226e616d65223b733a31343a22c2f0e5ecff20e4eef1f2e0e2eae8223b7d7d733a333a226e756d223b613a31323a7b733a373a22636f756e747279223b733a303a22223b733a353a227374617465223b733a313a2232223b733a343a2263697479223b733a313a2231223b733a353a22696e646578223b733a313a2232223b733a333a2266696f223b733a313a2233223b733a333a2274656c223b733a313a2234223b733a363a22737472656574223b733a313a2235223b733a353a22686f757365223b733a313a2236223b733a353a22706f726368223b733a313a2237223b733a31303a22646f6f725f70686f6e65223b733a313a2238223b733a343a22666c6174223b733a313a2239223b733a393a2264656c697674696d65223b733a323a223132223b7d7d, 2, '/UserFiles/Image/Payments/pochta-rf.png', 'null', '18'),
(12, '�� ������� ������', 0, '1', '0', 0, '', 0, 0, '1', '0', '', 3, '/UserFiles/Image/Payments/world.png', '', ''),
(13, 'DHL', 0, '1', '0', 0, '0', 12, 0, '0', '2', 0x613a323a7b733a373a22656e61626c6564223b613a31323a7b733a373a22636f756e747279223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a363a22d1f2f0e0ede0223b733a333a22726571223b733a313a2231223b7d733a353a227374617465223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a363a22d0e5e3e8eeed223b733a333a22726571223b733a313a2231223b7d733a343a2263697479223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a353a22c3eef0eee4223b733a333a22726571223b733a313a2231223b7d733a353a22696e646578223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a363a22c8ede4e5eaf1223b733a333a22726571223b733a313a2231223b7d733a333a2266696f223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31343a22d4c8ce20efeeebf3f7e0f2e5ebff223b733a333a22726571223b733a313a2231223b7d733a333a2274656c223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31383a22d2e5ebe5f4eeed20efeeebf3f7e0f2e5ebff223b733a333a22726571223b733a313a2231223b7d733a363a22737472656574223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a353a22d3ebe8f6e0223b733a333a22726571223b733a313a2231223b7d733a353a22686f757365223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a333a22c4eeec223b733a333a22726571223b733a313a2231223b7d733a353a22706f726368223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a373a22cfeee4fae5e7e4223b733a333a22726571223b733a313a2231223b7d733a31303a22646f6f725f70686f6e65223b613a323a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a31323a22caeee420e4eeeceef4eeede0223b7d733a343a22666c6174223b613a333a7b733a373a22656e61626c6564223b733a313a2231223b733a343a226e616d65223b733a383a22cae2e0f0f2e8f0e0223b733a333a22726571223b733a313a2231223b7d733a393a2264656c697674696d65223b613a313a7b733a343a226e616d65223b733a303a22223b7d7d733a333a226e756d223b613a31323a7b733a373a22636f756e747279223b733a313a2231223b733a353a227374617465223b733a313a2232223b733a343a2263697479223b733a313a2233223b733a353a22696e646578223b733a313a2234223b733a333a2266696f223b733a313a2235223b733a333a2274656c223b733a313a2236223b733a363a22737472656574223b733a313a2237223b733a353a22686f757365223b733a313a2238223b733a353a22706f726368223b733a313a2239223b733a31303a22646f6f725f70686f6e65223b733a323a223130223b733a343a22666c6174223b733a323a223131223b733a393a2264656c697674696d65223b733a303a22223b7d7d, 0, '/UserFiles/Image/Payments/dhl.png', '', '');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_discount`
--

CREATE TABLE `phpshop_discount` (
  `id` tinyint(11) unsigned NOT NULL AUTO_INCREMENT,
  `sum` int(255) DEFAULT '0',
  `discount` float DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_foto`
--

CREATE TABLE `phpshop_foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `num` tinyint(11) DEFAULT '0',
  `info` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_foto`
--

INSERT INTO `phpshop_foto` (`id`, `parent`, `name`, `num`, `info`) VALUES
(15, 1, '/UserFiles/Image/Trial/img1_90545.png', 0, ''),
(13, 1, '/UserFiles/Image/Trial/img1_22472.png', 0, ''),
(16, 1, '/UserFiles/Image/Trial/img1_36459.png', 0, ''),
(9, 2, '/UserFiles/Image/Trial/img2_78894.png', 0, ''),
(10, 2, '/UserFiles/Image/Trial/img2_54984.png', 0, ''),
(11, 2, '/UserFiles/Image/Trial/img2_35744.png', 0, ''),
(17, 3, '/UserFiles/Image/Trial/img3_16362.png', 0, ''),
(18, 3, '/UserFiles/Image/Trial/img3_72208.png', 0, ''),
(19, 3, '/UserFiles/Image/Trial/img3_17672.png', 0, ''),
(20, 4, '/UserFiles/Image/Trial/img4_42389.png', 0, ''),
(21, 4, '/UserFiles/Image/Trial/img4_20386.png', 0, ''),
(22, 4, '/UserFiles/Image/Trial/img4_10290.png', 0, ''),
(24, 5, '/UserFiles/Image/Trial/img5_19433.png', 0, ''),
(25, 5, '/UserFiles/Image/Trial/img5_38508.jpg', 0, ''),
(26, 5, '/UserFiles/Image/Trial/img5_18142.jpg', 0, ''),
(27, 6, '/UserFiles/Image/Trial/img6_66962.jpg', 0, ''),
(31, 7, '/UserFiles/Image/Trial/img7_29009.png', 0, ''),
(29, 6, '/UserFiles/Image/Trial/img6_36814.png', 0, ''),
(32, 7, '/UserFiles/Image/Trial/img7_11718.png', 0, ''),
(33, 7, '/UserFiles/Image/Trial/img7_29787.png', 0, ''),
(34, 8, '/UserFiles/Image/Trial/img8_36236.png', 0, ''),
(35, 8, '/UserFiles/Image/Trial/img8_79720.png', 0, ''),
(36, 8, '/UserFiles/Image/Trial/img8_38982.png', 0, ''),
(37, 9, '/UserFiles/Image/Trial/img9_60887.png', 0, ''),
(38, 9, '/UserFiles/Image/Trial/img9_10863.jpg', 0, ''),
(39, 9, '/UserFiles/Image/Trial/img9_13210.jpg', 0, ''),
(40, 10, '/UserFiles/Image/Trial/img10_31391.jpg', 0, ''),
(41, 10, '/UserFiles/Image/Trial/img10_91260.png', 0, ''),
(42, 11, '/UserFiles/Image/Trial/img11_37520.png', 0, ''),
(43, 11, '/UserFiles/Image/Trial/img11_26365.png', 0, ''),
(44, 11, '/UserFiles/Image/Trial/img11_28823.png', 0, ''),
(45, 12, '/UserFiles/Image/Trial/img12_26231.png', 0, ''),
(46, 12, '/UserFiles/Image/Trial/img12_35324.png', 0, ''),
(47, 12, '/UserFiles/Image/Trial/img12_70307.png', 0, ''),
(48, 13, '/UserFiles/Image/Trial/img13_22815.png', 0, ''),
(49, 13, '/UserFiles/Image/Trial/img13_79095.png', 0, ''),
(50, 13, '/UserFiles/Image/Trial/img13_21459.png', 0, ''),
(51, 14, '/UserFiles/Image/Trial/img14_30791.png', 0, ''),
(52, 14, '/UserFiles/Image/Trial/img14_23300.png', 0, ''),
(53, 14, '/UserFiles/Image/Trial/img14_27432.png', 0, ''),
(54, 14, '/UserFiles/Image/Trial/img14_34523.png', 0, ''),
(55, 14, '/UserFiles/Image/Trial/img14_44194.png', 0, ''),
(56, 14, '/UserFiles/Image/Trial/img14_42250.png', 0, ''),
(57, 15, '/UserFiles/Image/Trial/img15_29803.png', 0, ''),
(58, 15, '/UserFiles/Image/Trial/img15_39077.jpg', 0, ''),
(59, 15, '/UserFiles/Image/Trial/img15_38381.jpg', 0, ''),
(60, 16, '/UserFiles/Image/Trial/img16_18757.jpg', 0, ''),
(61, 16, '/UserFiles/Image/Trial/img16_18997.png', 0, ''),
(62, 17, '/UserFiles/Image/Trial/img17_42014.png', 0, ''),
(63, 17, '/UserFiles/Image/Trial/img17_15588.png', 0, ''),
(64, 17, '/UserFiles/Image/Trial/img17_26915.png', 0, ''),
(65, 18, '/UserFiles/Image/Trial/img18_30994.png', 0, ''),
(66, 18, '/UserFiles/Image/Trial/img18_22108.png', 0, ''),
(67, 18, '/UserFiles/Image/Trial/img18_31371.png', 0, ''),
(74, 19, '/UserFiles/Image/Trial/img19_71648.jpg', 0, ''),
(75, 19, '/UserFiles/Image/Trial/img19_78131.jpg', 0, ''),
(73, 19, '/UserFiles/Image/Trial/img19_70097.jpg', 0, ''),
(76, 20, '/UserFiles/Image/Trial/img20_48320.jpg', 0, ''),
(77, 20, '/UserFiles/Image/Trial/img20_87409.jpg', 0, ''),
(78, 20, '/UserFiles/Image/Trial/img20_11241.jpg', 0, ''),
(79, 21, '/UserFiles/Image/Trial/img21_15578.jpg', 0, ''),
(80, 21, '/UserFiles/Image/Trial/img21_81261.jpg', 0, ''),
(81, 21, '/UserFiles/Image/Trial/img21_96204.jpg', 0, ''),
(82, 22, '/UserFiles/Image/Trial/img22_32410.jpg', 0, ''),
(83, 22, '/UserFiles/Image/Trial/img22_26871.jpg', 0, ''),
(84, 22, '/UserFiles/Image/Trial/img22_73532.jpg', 0, ''),
(85, 23, '/UserFiles/Image/Trial/img23_89786.jpg', 0, ''),
(86, 23, '/UserFiles/Image/Trial/img23_29368.jpg', 0, ''),
(89, 24, '/UserFiles/Image/Trial/img24_16757.jpg', 0, ''),
(88, 23, '/UserFiles/Image/Trial/img23_26114.jpg', 0, ''),
(90, 24, '/UserFiles/Image/Trial/img24_17045.jpg', 0, ''),
(91, 24, '/UserFiles/Image/Trial/img24_54220.jpg', 0, ''),
(92, 25, '/UserFiles/Image/Trial/img25_64682.jpg', 0, ''),
(93, 25, '/UserFiles/Image/Trial/img25_53495.jpg', 0, ''),
(94, 25, '/UserFiles/Image/Trial/img25_66005.jpg', 0, ''),
(95, 26, '/UserFiles/Image/Trial/img26_53995.jpg', 0, ''),
(96, 26, '/UserFiles/Image/Trial/img26_56539.jpg', 0, ''),
(97, 26, '/UserFiles/Image/Trial/img26_44824.jpg', 0, ''),
(98, 27, '/UserFiles/Image/Trial/img27_18062.jpg', 0, ''),
(99, 27, '/UserFiles/Image/Trial/img27_31130.jpg', 0, ''),
(100, 27, '/UserFiles/Image/Trial/img27_55301.jpg', 0, ''),
(101, 28, '/UserFiles/Image/Trial/img28_13935.jpg', 0, ''),
(102, 28, '/UserFiles/Image/Trial/img28_40283.jpg', 0, ''),
(103, 28, '/UserFiles/Image/Trial/img28_54487.jpg', 0, ''),
(104, 28, '/UserFiles/Image/Trial/img28_39845.jpg', 0, ''),
(105, 29, '/UserFiles/Image/Trial/img29_12250.jpg', 0, ''),
(106, 29, '/UserFiles/Image/Trial/img29_28701.jpg', 0, ''),
(107, 29, '/UserFiles/Image/Trial/img29_34655.jpg', 0, ''),
(108, 29, '/UserFiles/Image/Trial/img29_38525.jpg', 0, ''),
(109, 29, '/UserFiles/Image/Trial/img29_20915.jpg', 0, ''),
(110, 30, '/UserFiles/Image/Trial/img30_33310.jpg', 0, ''),
(111, 30, '/UserFiles/Image/Trial/img30_29678.jpg', 0, ''),
(112, 30, '/UserFiles/Image/Trial/img30_32460.jpg', 0, ''),
(113, 31, '/UserFiles/Image/Trial/img31_22065.jpg', 0, ''),
(114, 31, '/UserFiles/Image/Trial/img31_41341.jpg', 0, ''),
(115, 31, '/UserFiles/Image/Trial/img31_23535.jpg', 0, ''),
(116, 32, '/UserFiles/Image/Trial/img32_23840.jpg', 0, ''),
(117, 32, '/UserFiles/Image/Trial/img32_25817.jpg', 0, ''),
(118, 32, '/UserFiles/Image/Trial/img32_29755.jpg', 0, ''),
(119, 33, '/UserFiles/Image/Trial/img33_61292.jpg', 0, ''),
(120, 33, '/UserFiles/Image/Trial/img33_53487.jpg', 0, ''),
(121, 33, '/UserFiles/Image/Trial/img33_32374.jpg', 0, ''),
(122, 34, '/UserFiles/Image/Trial/img34_60925.jpg', 0, ''),
(123, 34, '/UserFiles/Image/Trial/img34_62276.jpg', 0, ''),
(124, 34, '/UserFiles/Image/Trial/img34_57469.jpg', 0, ''),
(125, 35, '/UserFiles/Image/Trial/img35_21932.jpg', 0, ''),
(126, 35, '/UserFiles/Image/Trial/img35_98263.jpg', 0, ''),
(127, 35, '/UserFiles/Image/Trial/img35_99318.jpg', 0, ''),
(128, 36, '/UserFiles/Image/Trial/img36_62837.jpg', 0, ''),
(129, 36, '/UserFiles/Image/Trial/img36_52701.jpg', 0, ''),
(130, 36, '/UserFiles/Image/Trial/img36_93859.jpg', 0, ''),
(131, 37, '/UserFiles/Image/Trial/img37_19544.jpg', 0, ''),
(132, 37, '/UserFiles/Image/Trial/img37_32039.jpg', 0, ''),
(133, 37, '/UserFiles/Image/Trial/img37_62079.jpg', 0, ''),
(134, 38, '/UserFiles/Image/Trial/img38_10928.jpg', 0, ''),
(135, 38, '/UserFiles/Image/Trial/img38_22872.jpg', 0, ''),
(136, 38, '/UserFiles/Image/Trial/img38_20950.jpg', 0, ''),
(137, 39, '/UserFiles/Image/Trial/img39_86997.jpg', 0, ''),
(138, 39, '/UserFiles/Image/Trial/img39_50960.jpg', 0, ''),
(139, 39, '/UserFiles/Image/Trial/img39_43964.jpg', 0, ''),
(140, 39, '/UserFiles/Image/Trial/img39_16581.jpg', 0, ''),
(141, 40, '/UserFiles/Image/Trial/img40_42498.jpg', 0, ''),
(142, 40, '/UserFiles/Image/Trial/img40_35924.jpg', 0, ''),
(143, 40, '/UserFiles/Image/Trial/img40_60229.jpg', 0, ''),
(144, 41, '/UserFiles/Image/Trial/img41_86121.png', 0, ''),
(145, 41, '/UserFiles/Image/Trial/img41_13435.jpg', 0, ''),
(146, 41, '/UserFiles/Image/Trial/img41_27112.jpg', 0, ''),
(147, 42, '/UserFiles/Image/Trial/img42_76518.jpg', 0, ''),
(148, 42, '/UserFiles/Image/Trial/img42_63520.jpg', 0, ''),
(149, 42, '/UserFiles/Image/Trial/img42_89023.jpg', 0, ''),
(150, 43, '/UserFiles/Image/Trial/img43_25431.jpg', 0, ''),
(151, 43, '/UserFiles/Image/Trial/img43_33566.jpg', 0, ''),
(152, 43, '/UserFiles/Image/Trial/img43_40758.jpg', 0, ''),
(153, 44, '/UserFiles/Image/Trial/img44_66993.jpg', 0, ''),
(154, 44, '/UserFiles/Image/Trial/img44_43519.jpg', 0, ''),
(155, 44, '/UserFiles/Image/Trial/img44_80880.jpg', 0, ''),
(156, 45, '/UserFiles/Image/Trial/img45_47678.jpg', 0, ''),
(157, 45, '/UserFiles/Image/Trial/img45_89361.jpg', 0, ''),
(158, 45, '/UserFiles/Image/Trial/img45_70583.jpg', 0, ''),
(159, 46, '/UserFiles/Image/Trial/img46_42405.jpg', 0, ''),
(160, 46, '/UserFiles/Image/Trial/img46_39677.jpg', 0, ''),
(161, 46, '/UserFiles/Image/Trial/img46_47593.jpg', 0, ''),
(162, 47, '/UserFiles/Image/Trial/img47_21051.jpg', 0, ''),
(163, 47, '/UserFiles/Image/Trial/img47_33713.jpg', 0, ''),
(164, 47, '/UserFiles/Image/Trial/img47_27834.jpg', 0, ''),
(165, 48, '/UserFiles/Image/Trial/img48_89410.jpg', 0, ''),
(166, 48, '/UserFiles/Image/Trial/img48_41999.jpg', 0, ''),
(167, 48, '/UserFiles/Image/Trial/img48_85509.jpg', 0, ''),
(168, 49, '/UserFiles/Image/Trial/img49_77689.jpg', 0, ''),
(169, 49, '/UserFiles/Image/Trial/img49_10243.jpg', 0, ''),
(170, 49, '/UserFiles/Image/Trial/img49_10863.jpg', 0, ''),
(171, 50, '/UserFiles/Image/Trial/img50_22110.jpg', 0, ''),
(172, 50, '/UserFiles/Image/Trial/img50_42880.jpg', 0, ''),
(173, 50, '/UserFiles/Image/Trial/img50_30952.jpg', 0, ''),
(174, 51, '/UserFiles/Image/Trial/img51_77278.jpg', 0, ''),
(175, 51, '/UserFiles/Image/Trial/img51_93577.jpg', 0, ''),
(176, 51, '/UserFiles/Image/Trial/img51_34326.jpg', 0, ''),
(177, 52, '/UserFiles/Image/Trial/img52_39446.jpg', 0, ''),
(178, 52, '/UserFiles/Image/Trial/img52_14179.jpg', 0, ''),
(179, 52, '/UserFiles/Image/Trial/img52_63499.jpg', 0, ''),
(180, 53, '/UserFiles/Image/Trial/img53_12129.jpg', 0, ''),
(181, 53, '/UserFiles/Image/Trial/img53_26404.jpg', 0, ''),
(182, 53, '/UserFiles/Image/Trial/img53_34575.jpg', 0, ''),
(183, 54, '/UserFiles/Image/Trial/img54_56298.jpg', 0, ''),
(184, 54, '/UserFiles/Image/Trial/img54_16718.jpg', 0, ''),
(185, 54, '/UserFiles/Image/Trial/img54_66653.jpg', 0, ''),
(186, 55, '/UserFiles/Image/Trial/img55_54757.jpg', 0, ''),
(187, 55, '/UserFiles/Image/Trial/img55_13369.jpg', 0, ''),
(188, 55, '/UserFiles/Image/Trial/img55_23381.jpg', 0, ''),
(189, 56, '/UserFiles/Image/Trial/img56_67285.jpg', 0, ''),
(190, 56, '/UserFiles/Image/Trial/img56_72601.jpg', 0, ''),
(191, 56, '/UserFiles/Image/Trial/img56_81573.jpg', 0, ''),
(192, 57, '/UserFiles/Image/Trial/img57_61348.jpg', 0, ''),
(193, 57, '/UserFiles/Image/Trial/img57_34525.jpg', 0, ''),
(194, 57, '/UserFiles/Image/Trial/img57_75016.jpg', 0, ''),
(195, 58, '/UserFiles/Image/Trial/img58_79133.jpg', 0, ''),
(196, 58, '/UserFiles/Image/Trial/img58_56520.jpg', 0, ''),
(197, 58, '/UserFiles/Image/Trial/img58_29188.jpg', 0, ''),
(198, 59, '/UserFiles/Image/Trial/img59_20971.jpg', 0, ''),
(199, 59, '/UserFiles/Image/Trial/img59_92292.jpg', 0, ''),
(200, 59, '/UserFiles/Image/Trial/img59_61956.jpg', 0, ''),
(201, 60, '/UserFiles/Image/Trial/img60_75028.jpg', 0, ''),
(202, 60, '/UserFiles/Image/Trial/img60_95557.jpg', 0, ''),
(203, 60, '/UserFiles/Image/Trial/img60_27601.jpg', 0, ''),
(204, 61, '/UserFiles/Image/Trial/img61_26143.jpg', 0, ''),
(205, 61, '/UserFiles/Image/Trial/img61_39043.jpg', 0, ''),
(206, 61, '/UserFiles/Image/Trial/img61_78367.jpg', 0, ''),
(207, 62, '/UserFiles/Image/Trial/img62_51251.jpg', 0, ''),
(208, 62, '/UserFiles/Image/Trial/img62_12965.jpg', 0, ''),
(209, 62, '/UserFiles/Image/Trial/img62_92938.jpg', 0, '');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_gbook`
--

CREATE TABLE `phpshop_gbook` (
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

CREATE TABLE `phpshop_jurnal` (
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

CREATE TABLE `phpshop_links` (
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
(1, 'PHPShop Software', '', '�������� ��������-��������, ������ ��������-�������� PHPShop.', 'https://www.phpshop.ru', 5, '1'),
(2, 'PHPShop CMS Free', '', '���������� ��c���� ���������� ������ PHPShop CMS Free.', 'https://www.phpshopcms.ru', 3, '1'),
(3, '������ ��������-��������', '', 'Shopbuilder - ������ ������ ��������-��������, ����������� ������������� �� ��������� ������ ������� ����������� ���� ��������-�������� �� 599 ���.', 'https://www.shopbuilder.ru', 1, '1');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_menu`
--

CREATE TABLE `phpshop_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `content` text,
  `flag` enum('0','1') DEFAULT '1',
  `num` int(11) DEFAULT '0',
  `dir` varchar(64) DEFAULT NULL,
  `element` enum('0','1') DEFAULT '0',
  `servers` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `flag` (`flag`),
  KEY `element` (`element`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_menu`
--

INSERT INTO `phpshop_menu` (`id`, `name`, `content`, `flag`, `num`, `dir`, `element`, `servers`) VALUES
(1, '����������', '���������� ���������� ����������� - c����� PHPShop ��������� �����������, �� ��������� ��� ������������ ����������, �������� �� �������� ������������.', '1', 4, '/', '1', ''),
(2, '������ ��������', '������ �������� ������� ��� ������ ������� ��������-��������, ��� �� �������� ����������� � ��������� �������, ���������������� - ��� ������ ��������� ������ �������� �������.', '1', 2, '/', '0', ''),
(3, 'C����� � ������', '������������� ������ � ������ - �� ������ ����������, ������� 10% �� ������� ����������� ������. ����� ��������� ������������� ������, ������� ����������� � ��������.', '1', 3, '', '1', ''),
(4, '����������������', '������� ��������� ��� ���� �����. ������������ ������ ��� ��� ����� ��� ��, ��� � ����� ��������� �����������, � ������� ������ IDE � ����������� ����������.', '1', 3, '', '0', '');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_messages`
--

CREATE TABLE `phpshop_messages` (
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

CREATE TABLE `phpshop_modules` (
  `path` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT '',
  `date` int(11) DEFAULT '0',
  `servers` varchar(64) default '',
  PRIMARY KEY (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_modules`
--

INSERT INTO `phpshop_modules` (`path`, `name`, `date`) VALUES
('returncall', 'Return Call', 1512653689),
('visualcart', 'Visual Cart', 1512653689),
('oneclick', 'One Click', 1512653689),
('promotions', 'Promotions', 1512653689),
('seourlpro', 'SeoUrlPro', 1512653689),
('sticker', 'Sticker', 1521908948),
('tinkoff', 'Tinkoff', 1512653689),
('productlastview', 'Product Last View', 1521908948);


-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_key`
--

CREATE TABLE `phpshop_modules_key` (
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

CREATE TABLE `phpshop_modules_oneclick_jurnal` (
  `id` int(11) NOT NULL auto_increment,
  `date` int(11) default '0',
  `name` varchar(64) default '',
  `tel` varchar(64) default '',
  `message` text,
  `product_name` varchar(64) default '',
  `product_id` int(11),
  `product_price` varchar(64) default '',
  `product_image` varchar(64) default '',
  `status` enum('1','2','3','4') default '1',
  `ip` varchar(64) default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_oneclick_system`

CREATE TABLE IF NOT EXISTS `phpshop_modules_oneclick_system` (
  `id` int(11) NOT NULL auto_increment,
  `enabled` enum('0','1','2') default '1',
  `title` text,
  `title_end` text,
  `serial` varchar(64) default '',
  `windows` enum('0','1') default '0',
  `display` enum('0','1') default '0',
  `version` varchar(64) DEFAULT '1.1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


INSERT INTO `phpshop_modules_oneclick_system` VALUES (1,'0','�������, ��� ����� ������!','���� ��������� �������� � ���� ��� ��������� �������.','','1','0','1.4');
--

CREATE TABLE IF NOT EXISTS `phpshop_modules_tinkoff_system` (
  `id` int(11) NOT NULL auto_increment,
  `status` int(11),
  `title` text,
  `title_end` text,
  `terminal` varchar(64) default '',
  `secret_key` varchar(64) default '',
  `gateway` varchar(64) default '',
  `version` varchar(64) DEFAULT '1.0',
  `enabled_taxation` int DEFAULT 0,
  `taxation` varchar(64),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_modules_tinkoff_system` VALUES (1, 0, '��������� ������� �������� �����', '�������� ���������� ���� �����','TinkoffBankTest', 'TinkoffBankTest
', 'https://securepay.tinkoff.ru/v2', '2.2', '0', 'osn');

CREATE TABLE IF NOT EXISTS `phpshop_modules_promotions_system` (
  `id` int(11) NOT NULL auto_increment,
  `version` varchar(64) DEFAULT '1.0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_modules_oneclick_system`
--

INSERT INTO `phpshop_modules_promotions_system` VALUES (1,'2.6');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_promotions_forms`
--

CREATE TABLE IF NOT EXISTS `phpshop_modules_promotions_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` enum('0','1') DEFAULT '0',
  `description` text NOT NULL,
  `label` text NOT NULL,
  `active_check` enum('0','1') NOT NULL,
  `active_date_ot` varchar(255) NOT NULL,
  `active_date_do` varchar(255) NOT NULL,
  `discount_check` enum('0','1') NOT NULL,
  `discount_tip` enum('0','1') NOT NULL,
  `discount` int(11) NOT NULL,
  `free_delivery` enum('0','1') NOT NULL,
  `categories_check` enum('0','1') NOT NULL,
  `categories` text NOT NULL,
  `status_check` enum('0','1') NOT NULL DEFAULT '0',
  `statuses` text NOT NULL DEFAULT '',
  `products_check` enum('0','1') NOT NULL,
  `products` text NOT NULL,
  `sum_order_check` enum('0','1') NOT NULL,
  `sum_order` int(11) NOT NULL,
  `delivery_method_check` enum('0','1') NOT NULL,
  `delivery_method` int(11) NOT NULL,
  `code_check` enum('0','1') NOT NULL,
  `code` varchar(255) NOT NULL,
  `code_tip` enum('0','1') NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `header_mail` varchar(255) NOT NULL,
  `content_mail` text NOT NULL,
  `block_old_price` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_modules_promotions_forms`
--

INSERT INTO `phpshop_modules_promotions_forms` (`id`, `name`, `enabled`, `description`, `active_check`, `active_date_ot`, `active_date_do`, `discount_check`, `discount_tip`, `discount`, `free_delivery`, `categories_check`, `categories`, `products_check`, `products`, `sum_order_check`, `sum_order`, `delivery_method_check`, `delivery_method`, `code_check`, `code`, `code_tip`, `date_create`) VALUES
(1, '������ 30%', '1', '<p><span class="s1"><a href="/order/"><img src="/UserFiles/Image/Trial/gift.png" alt="" width="100" height="92" /></a></span></p>\r\n<p><span class="s1">�����-��� <strong>gift2018</strong></span></p>\r\n<p><span class="s1">������� � ������� � �������� ������ 30%!</span></p>', '1', '27-11-2017', '31-05-2019', '1', '1', 30, '0', '1', '8,9,7,1,4,6,3,5,', '0', '', '0', 0, '0', 10017, '1', 'gift2018', '0', '2018-03-25 05:28:57');


CREATE TABLE IF NOT EXISTS `phpshop_modules_promotions_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL UNIQUE,
  `enabled` ENUM( '0', '1' ) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_returncall_jurnal`
--

CREATE TABLE `phpshop_modules_returncall_jurnal` (
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

CREATE TABLE `phpshop_modules_returncall_system` (
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
(1, '0', '�������� ������', '������ �� �������� ������ �������, �����', '', '1', '1', 1.4);

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_seourlpro_system`
--

CREATE TABLE IF NOT EXISTS `phpshop_modules_seourlpro_system` (
  `id` int(11)  auto_increment,
  `paginator` enum('1','2') default '1',
  `seo_brands_enabled` enum('1','2') default '1',
  `cat_content_enabled` enum('1','2') default '1',
  `seo_news_enabled` enum('1','2') default '1',
  `seo_page_enabled` enum('1','2') default '1',
  `redirect_enabled` enum('1','2') default '1',
  `version` VARCHAR(64) DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_modules_seourlpro_system`
--

INSERT INTO `phpshop_modules_seourlpro_system` (`id`, `paginator`, `seo_brands_enabled`, `cat_content_enabled`, `version`) VALUES
(1, '1', '2', '1', '2.1');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_sticker_forms`
--

CREATE TABLE `phpshop_modules_sticker_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `path` varchar(64) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `mail` varchar(64) NOT NULL DEFAULT '',
  `enabled` enum('0','1') NOT NULL DEFAULT '1',
  `dir` text NOT NULL,
  `skin` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_modules_sticker_forms`
--

INSERT INTO `phpshop_modules_sticker_forms` (`id`, `name`, `path`, `content`, `mail`, `enabled`, `dir`, `skin`) VALUES
(1, '������������', 'three', '<p class="icon">&nbsp;</p>\r\n<h6 class="no-margin text-uppercase">������ � ������������</h6>\r\n<p>������� � �������</p>', '', '1', '', 'hub'),
(2, '�������� �������� �����', 'two', '<p class="icon">&nbsp;</p>\r\n<h6 class="no-margin text-uppercase">�������� �������� �����</h6>\r\n<p>� ������� 14 ���� � ������� �������</p>', '', '1', '', 'hub'),
(3, '���������� ��������', 'one', '<p class="icon">&nbsp;</p>\r\n<h6 class="no-margin text-uppercase">���������� ��������</h6>\r\n<p>��� ������ �� 5000 ���.</p>', '', '1', '', 'hub');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_sticker_system`
--

CREATE TABLE `phpshop_modules_sticker_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial` varchar(64) NOT NULL DEFAULT '',
  `version` varchar(64) DEFAULT '1.0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_modules_sticker_system`
--

INSERT INTO `phpshop_modules_sticker_system` (`id`, `serial`, `version`) VALUES
(1, '', '1.2');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_visualcart_memory`
--

CREATE TABLE `phpshop_modules_visualcart_memory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memory` varchar(64) DEFAULT '',
  `cart` text,
  `date` int(11) DEFAULT '0',
  `user` int(11) DEFAULT '0',
  `ip` varchar(64) DEFAULT '',
  `referal` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;


-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_modules_visualcart_system`
--

CREATE TABLE `phpshop_modules_visualcart_system` (
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

CREATE TABLE `phpshop_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datas` varchar(32) DEFAULT '',
  `zag` varchar(255) DEFAULT '',
  `kratko` text,
  `podrob` text,
  `datau` int(11) DEFAULT '0',
  `odnotip` text,
  `news_seo_name` VARCHAR(255) DEFAULT '',
  `servers` varchar(64) default '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;


-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_newsletter`
--

CREATE TABLE `phpshop_newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `content` text,
  `template` int(11) DEFAULT '0',
  `date` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_notice`
--

CREATE TABLE `phpshop_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `product_id` int(11) DEFAULT '0',
  `datas_start` varchar(64) DEFAULT '',
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

CREATE TABLE `phpshop_opros` (
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

CREATE TABLE `phpshop_opros_categories` (
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

CREATE TABLE `phpshop_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datas` varchar(64) DEFAULT '',
  `uid` varchar(64) DEFAULT '0',
  `orders` blob,
  `status` text,
  `user` int(11) unsigned DEFAULT '0',
  `seller` enum('0','1') DEFAULT '0',
  `statusi` tinyint(11) DEFAULT '0',
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
  `sum` float DEFAULT NULL,
  `files` text,
  `tracking` varchar(64) default '',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_orders`
--

INSERT INTO `phpshop_orders` (`id`, `datas`, `uid`, `orders`, `status`, `user`, `seller`, `statusi`, `country`, `state`, `city`, `index`, `fio`, `tel`, `street`, `house`, `porch`, `door_phone`, `flat`, `delivtime`, `org_name`, `org_inn`, `org_kpp`, `org_yur_adres`, `org_fakt_adres`, `org_ras`, `org_bank`, `org_kor`, `org_bik`, `org_city`, `dop_info`, `sum`, `files`) VALUES
(1, '1523370976', '1-73', 0x613a323a7b733a343a2243617274223b613a353a7b733a343a2263617274223b613a333a7b693a31333b613a383a7b733a323a226964223b733a323a223133223b733a343a226e616d65223b733a31333a22cfeeece0e4e0204c6f7265616c223b733a353a227072696365223b733a343a2232333030223b733a333a22756964223b733a363a22333435343634223b733a333a226e756d223b693a313b733a363a2265645f697a6d223b733a333a22f8f22e223b733a393a227069635f736d616c6c223b733a33393a222f5573657246696c65732f496d6167652f547269616c2f696d6731335f3739303935732e706e67223b733a363a22776569676874223b733a323a223130223b7d693a31343b613a383a7b733a323a226964223b733a323a223134223b733a343a226e616d65223b733a31353a22d2f3f8fc20e4ebff20f0e5f1ede8f6223b733a353a227072696365223b733a343a2234303030223b733a333a22756964223b733a363a22333536353432223b733a333a226e756d223b693a313b733a363a2265645f697a6d223b733a333a22f8f22e223b733a393a227069635f736d616c6c223b733a33393a222f5573657246696c65732f496d6167652f547269616c2f696d6731345f3330373931732e706e67223b733a363a22776569676874223b733a323a223430223b7d693a35373b613a383a7b733a323a226964223b733a323a223537223b733a343a226e616d65223b733a31323a22caf0eee2e0f2fc20cbe8e4f1223b733a353a227072696365223b733a353a223930303030223b733a333a22756964223b4e3b733a333a226e756d223b693a313b733a363a2265645f697a6d223b733a333a22f8f22e223b733a393a227069635f736d616c6c223b733a33393a222f5573657246696c65732f496d6167652f547269616c2f696d6735375f3334353235732e6a7067223b733a363a22776569676874223b4e3b7d7d733a333a226e756d223b693a333b733a333a2273756d223b733a353a223936333030223b733a363a22776569676874223b693a35303b733a383a22646f737461766b61223b693a303b7d733a363a22506572736f6e223b613a32303a7b733a343a226f756964223b733a343a22312d3733223b733a343a2264617461223b733a31303a2231353233333730393736223b733a343a2274696d65223b733a383a2231373a313620706d223b733a343a226d61696c223b733a31323a2274657374406d61696c2e7275223b733a31313a226e616d655f706572736f6e223b733a303a22223b733a383a226f72675f6e616d65223b733a303a22223b733a373a226f72675f696e6e223b733a303a22223b733a373a226f72675f6b7070223b733a303a22223b733a383a2274656c5f636f6465223b733a303a22223b733a383a2274656c5f6e616d65223b733a303a22223b733a383a226164725f6e616d65223b733a303a22223b733a31343a22646f737461766b615f6d65746f64223b733a313a2233223b733a383a22646973636f756e74223b693a303b733a373a22757365725f6964223b693a31383b733a363a22646f735f6f74223b733a303a22223b733a363a22646f735f646f223b733a303a22223b733a31313a226f726465725f6d65746f64223b733a313a2233223b733a393a2270726f6d6f636f6465223b733a303a22223b733a31343a22646973636f756e745f70726f6d6f223b4e3b733a383a227469705f64697363223b4e3b7d7d, 'a:2:{s:7:"maneger";s:0:"";s:4:"time";s:16:"12-04-2018 13:35";}', 18, '0', 3, '', '', '', '', '����', '(111) 224-1241', '', '', '', '', '', '� 10 ����', '', '', '', '', '', '', '', '', '', '', '', 96300, 'N;'),
(2, '1523371029', '2-51', 0x613a323a7b733a343a2243617274223b613a353a7b733a343a2263617274223b613a333a7b693a36313b613a383a7b733a323a226964223b733a323a223631223b733a343a226e616d65223b733a343a22d1f2f3eb223b733a353a227072696365223b733a353a223234303030223b733a333a22756964223b733a373a2230393830393837223b733a333a226e756d223b693a313b733a363a2265645f697a6d223b733a333a22f8f22e223b733a393a227069635f736d616c6c223b733a33393a222f5573657246696c65732f496d6167652f547269616c2f696d6736315f3236313433732e6a7067223b733a363a22776569676874223b4e3b7d693a36303b613a383a7b733a323a226964223b733a323a223630223b733a343a226e616d65223b733a343a22d7e0f1fb223b733a353a227072696365223b733a343a2239303030223b733a333a22756964223b733a383a223039383938373938223b733a333a226e756d223b693a313b733a363a2265645f697a6d223b733a333a22f8f22e223b733a393a227069635f736d616c6c223b733a33393a222f5573657246696c65732f496d6167652f547269616c2f696d6736305f3237363031732e6a7067223b733a363a22776569676874223b4e3b7d693a35393b613a383a7b733a323a226964223b733a323a223539223b733a343a226e616d65223b733a353a22cbe0ecefe0223b733a353a227072696365223b733a343a2232333030223b733a333a22756964223b733a373a2239373837373635223b733a333a226e756d223b693a313b733a363a2265645f697a6d223b733a333a22f8f22e223b733a393a227069635f736d616c6c223b733a33393a222f5573657246696c65732f496d6167652f547269616c2f696d6735395f3631393536732e6a7067223b733a363a22776569676874223b4e3b7d7d733a333a226e756d223b693a333b733a333a2273756d223b693a33353330303b733a363a22776569676874223b693a303b733a383a22646f737461766b61223b693a303b7d733a363a22506572736f6e223b613a32303a7b733a343a226f756964223b733a343a22322d3531223b733a343a2264617461223b733a31303a2231353233333731303239223b733a343a2274696d65223b733a383a2231373a303920706d223b733a343a226d61696c223b733a31353a22746573743240676d61696c2e636f6d223b733a31313a226e616d655f706572736f6e223b733a303a22223b733a383a226f72675f6e616d65223b733a303a22223b733a373a226f72675f696e6e223b733a303a22223b733a373a226f72675f6b7070223b733a303a22223b733a383a2274656c5f636f6465223b733a303a22223b733a383a2274656c5f6e616d65223b733a303a22223b733a383a226164725f6e616d65223b733a303a22223b733a31343a22646f737461766b615f6d65746f64223b733a313a2233223b733a383a22646973636f756e74223b693a303b733a373a22757365725f6964223b693a31393b733a363a22646f735f6f74223b733a303a22223b733a363a22646f735f646f223b733a303a22223b733a31313a226f726465725f6d65746f64223b733a353a223130303137223b733a393a2270726f6d6f636f6465223b733a303a22223b733a31343a22646973636f756e745f70726f6d6f223b4e3b733a383a227469705f64697363223b4e3b7d7d, 'a:2:{s:7:"maneger";s:0:"";s:4:"time";s:16:"12-04-2018 13:35";}', 19, '0', 2, '', '', '', '', '������', '(888) 888-8888', '', '', '', '', '', '� 17 ������', '', '', '', '', '', '', '', '', '', '', '', 35300, 'N;'),
(3, '1523524420', '3-90', 0x613a323a7b733a343a2243617274223b613a353a7b733a343a2263617274223b613a313a7b693a3131313b613a31303a7b733a323a226964223b733a333a22313131223b733a343a226e616d65223b733a32323a2253616d73756e67204765617220565220e1e5ebfbe920223b733a353a227072696365223b733a353a223637303030223b733a333a22756964223b4e3b733a333a226e756d223b693a313b733a363a2265645f697a6d223b4e3b733a393a227069635f736d616c6c223b733a33393a222f5573657246696c65732f496d6167652f547269616c2f696d6733365f3632383337732e6a7067223b733a363a22776569676874223b4e3b733a363a22706172656e74223b693a33363b733a31303a22706172656e745f756964223b733a373a2231383832323334223b7d7d733a333a226e756d223b693a313b733a333a2273756d223b693a36373030303b733a363a22776569676874223b693a303b733a383a22646f737461766b61223b693a303b7d733a363a22506572736f6e223b613a32303a7b733a343a226f756964223b733a343a22332d3930223b733a343a2264617461223b733a31303a2231353233353234343230223b733a343a2274696d65223b733a383a2231333a343020706d223b733a343a226d61696c223b733a31333a227465737433406d61696c2e7275223b733a31313a226e616d655f706572736f6e223b733a303a22223b733a383a226f72675f6e616d65223b733a303a22223b733a373a226f72675f696e6e223b733a303a22223b733a373a226f72675f6b7070223b733a303a22223b733a383a2274656c5f636f6465223b733a303a22223b733a383a2274656c5f6e616d65223b733a303a22223b733a383a226164725f6e616d65223b733a303a22223b733a31343a22646f737461766b615f6d65746f64223b693a333b733a383a22646973636f756e74223b693a303b733a373a22757365725f6964223b733a323a223137223b733a363a22646f735f6f74223b733a303a22223b733a363a22646f735f646f223b733a303a22223b733a31313a226f726465725f6d65746f64223b693a333b733a393a2270726f6d6f636f6465223b733a303a22223b733a31343a22646973636f756e745f70726f6d6f223b4e3b733a383a227469705f64697363223b4e3b7d7d, 'a:2:{s:7:"maneger";N;s:4:"time";s:0:"";}', 17, '0', 0, '', '', '', '', '���������', '(888) 999-8888', '', '', '', '', '', '098098', '', '', '', '', '', '', '', '', '', '', '', 67000, NULL);


-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_order_status`
--

CREATE TABLE `phpshop_order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `color` varchar(64) DEFAULT '',
  `sklad_action` enum('0','1') DEFAULT '0',
  `cumulative_action` enum('0','1') DEFAULT '0',
  `mail_action` enum('0','1') DEFAULT '1',
  `mail_message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_order_status`
--

INSERT INTO `phpshop_order_status` (`id`, `name`, `color`, `sklad_action`, `cumulative_action`, `mail_action`, `mail_message`) VALUES
(1, '�����������', 'red', '0', '0', '1', NULL),
(2, '�����������', '#99cccc', '0', '0', '1', NULL),
(3, '������������', '#ff9900', '0', '0', '1', NULL),
(4, '��������', '#ccffcc', '1', '0', '1', NULL),
(100, '�������� � �����������', '#ffff33', '0', '0', '1', NULL);

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_page`
--

CREATE TABLE `phpshop_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `link` varchar(64) DEFAULT '',
  `category` int(11) DEFAULT '0',
  `keywords` text,
  `description` varchar(255) DEFAULT '',
  `content` text,
  `servers` varchar(64) DEFAULT '',
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

INSERT INTO `phpshop_page` (`id`, `name`, `link`, `category`, `keywords`, `description`, `content`, `servers`, `num`, `datas`, `odnotip`, `title`, `enabled`, `secure`, `secure_groups`) VALUES
(1, '���������� ��� �� ��������� PHPShop', 'index', 2000, '', '', '<p><img style="float: left; margin: 0px 10px 10px 0px;" src="/UserFiles/Image/Trial/box.png" alt="" />������������ PHPShop @version@ - ����� ������ ��������-��������, � ������� �� ��������� ����������� ���-���������� � ��� ����������� ���� �������� � ��������� ��������-���������. ������� PHPShop 5 - ��� HTML5, Bootstrap, jQuery, ����������� ��������� ������������, �������������� ������� � ����������� � ���������� ��������.</p>\n<p>�</p>\n<p>PHPShop - ��� ����� <strong>����������� ��������</strong> ��� �������� � ���������� ��������-���������. ����� ������ PHP-������� ��� ������� ������ � ��������� ������� �� �������, ���������� ����������� ����� �������������� <strong>���������� Windows ������</strong>, ������������ � ����� <a href="https://www.phpshop.ru/page/downloads.html" target="_blank" rel="noopener">EasyControl</a>. ������� ������� �� 4 ������ �� ����������: ���������� �������� ����, ���������� ��������, ��������� ������� �������� � ����������� ������������.</p>\n<p>� ������ ��������� ������, ���������� ������� <a href="http://faq.phpshop.ru/page/batch-loading.html" target="_blank" rel="noopener">PriceLoader</a> ��� ����������� ��������� �����-������ �����������, �������������� �������� � ���������� ������������ � ��� �������. ��� �� PriceLoader ��������� ������ ����� �������� ���� �� ������ ���� ������.������� (YML-�����), ������� ��������� � ������������ ����������� � �������, ������� � ������� ���������� �����������, ���������� �������� ������ �� ����� ���� ����� ������.�������. ��� �� ����������� ������ ��������� �������� �������, ���������� <strong>���� ��� ��������� PriceLoader</strong> �� �������������� ��������� � ������������� ���.</p>\n<p>������� Monitor, Chat �������� ������������ <strong>�������� � ��������� ����� �������</strong>, �������� ���������� ��������� � �������� � �������������� ����� � ������� <strong>���������� ����</strong> ���������� Chat.</p>\n<p>� ������� ���������� ��������� ��������-�������� <b>��� �������</b> ����� ����� �� ����� ��������� ���������� ��������� ������� ��� ��������, ��������� ��� �������� (��������, ����� PriceLoader ��� 1�), ��������� ��� ������� � ������, � ����� ����� ������ <a href="http://faq.phpshop.ru/page/synch.html" target="_blank" rel="noopener">����������������</a> ��������� � ������� ������. ��� ��������� ���� ����� � �� ��������� ����������� ����������� � ���������.</p>\n<p>� ��������� ������ ��������� ������� ��� ������������ PHP �������� �� �������. Installer � <strong>Updater</strong> ��������� ���������� � �������� PHPShop � 3 �����. ����� ����� ���������� ���������� ������� � ����� ������� �������� ������ ����� � ������� ������. ������������� ���������� �������� ������� � ��������� ��� ����������� �����������. ��� <strong>�������������� ����������� ������</strong> ������������ <b>PasswordRestore</b>.</p>\n<p>��� ������������� 1� ���������� ����������� ���������������� ���������� ������������� � ��������� ������� � PHPShop. ������ ��������� ���������� <a href="https://www.phpshop.ru/page/1c.html" target="_blank" rel="noopener">������������� ��������-�������� � 1�</a> ������� ������� ������������� ������ �������. ���������� ��������� ��������� ������ ������������� ����� ������������� �������� ����� ������� �������.</p>\n<p>�� ����� ����������� �������� ��� ����������� ���������� ����� ��������� � <a href="https://help.phpshop.ru" target="_blank" rel="noopener">������ ����������� ���������</a>. �� ��������� <strong>������ ������ �����</strong>, � ��� ����� �������� ����������� <a href="https://www.phpshop.ru/calculation/brifdesign/" target="_blank" rel="noopener">������������� �������</a> ��� ��������� �������������.</p>\n<blockquote>�� ������ ���������� ��������-�������� ��� 15 ���, - �������� ���� ������ ������� �������������!<footer class="text-right"><cite>������� PHPShop Software</cite></footer></blockquote>', '', 0, 1523285236, '', '', '1', '0', ''),
(24, '������', 'design', 1000, '', '', '<p>� �������� ��������-�������� PHPShop @version@ ������ ��������� ����������� ����������� �������� � ������� ��������� ��������� � �������� ���������� ��������� ����� ��������.</p>\n<p><a href="?skin=diggi"><img class="template" title="diggi" src="/UserFiles/Image/Trial/template_icon/diggi.gif" alt="" width="150" height="120" /></a><a href="?skin=spice"><img class="template" title="spice" src="/UserFiles/Image/Trial/template_icon/spice.gif" alt="" width="150" height="120" /></a><a href="?skin=astero"><img class="template" title="astero" src="/UserFiles/Image/Trial/template_icon/astero.gif" alt="" width="150" height="120" /></a> <a href="?skin=bootstrap"><img class="template" title="bootstrap" src="/UserFiles/Image/Trial/template_icon/bootstrap.gif" alt="" width="150" height="120" /></a><a href="?skin=unishop"><img class="template" title="unishop" src="/UserFiles/Image/Trial/template_icon/unishop.gif" alt="" width="150" height="120" /></a><a href="?skin=hub"><img class="template" title="hub" src="/UserFiles/Image/Trial/template_icon/hub.gif" alt="" width="150" height="120" /></a><a href="?skin=terra"><img class="template" title="hub" src="/UserFiles/Image/Trial/template_icon/terra.gif" alt="" width="150" height="120" /></a></p>\n<h2>��������� �������</h2>\n<p>��� �������������� � ��������� ������� � ������ ���������� ������������ "�������� ��������", ��������� ����� ���� <kbd>���������</kbd> - <kbd>������� ��������</kbd> .</p>\n<p><a title="���������� Template Edit" href="http://faq.phpshop.ru/page/templating.html" target="_blank" rel="noopener"><img class="template" src="/UserFiles/Image/Trial/template_edit.jpg" alt="" ></a></p>\n\n<h2>������������ ������</h2>\n<p>���� ������-���������� ������� ������ ��� PHPShop, � ������, �������������� ��� �������� ������� �� ����������, � �� �������� ���������� ���������������� ������ � ����, ���������� ���� ����������� ������������ ���.</p>\n<ol>\n<li>�� �� 100% ����� ���� ���������, � ��� ������, ��� ��� �� �������� ������������� �� ���� ������ ���������, �� ��������� � PHPShop.</li>\n<li>�� ��������� ��������� ��� ���������������� PHPShop ��� �� ������ ����� ��� ��������, � �� �������� ���������� ��������-������� �����, ����� �� ��� ������ �� ������������ ���� ������.</li>\n<li>����������� ���������, ����� ����������� ������������� � ��� ���������, �� ����� ������ PHPShop 5, ������������ � ������� "������-�����", - ��� ������, ��� � ������� �� ������� ����������� ��� ������ ���������.</li>\n<li>�� ��������� �����, � ������������� �������� - ���� ����� ���������� ������� �� �������� ������� � ����� ������� �� �������� ���.</li>\n</ol>\n<p>��� ������ ������������� ������� ����� ��������� ����, � ������� �� ������������ ������� ������, ��� ����������� ������� �������� � ����� �������������. C��� �������� ������ ������� - 15 ������� ����</p>\n<p><a class="btn btn-sm btn-success" href="https://www.phpshop.ru/calculation/brifdesign/" target="_blank" rel="noopener">��������� ���� �� ������������ ������ �����</a></p>', 'i1ii1000i', 1, 1537525119, '', '�������������� ������� PHPShop', '1', '0', ''),
(26, '������', 'purchase', 1000, '', '', '<p>��� �������� ��������-������� <strong>@serverName@</strong> �� ���� ��������� PHPShop @version@ ����� �������� 30 ����. <strong>�� ������ ��� ������ ��������� ���� �������, ��� ������ ����� ������� ����������! </strong>����� <strong>���������� �������� PHPShop</strong>, ��� ����������� <strong>��������� ���� ���� ���� ��������</strong>, ��� ����������� �������� ���� ��������� ����������.\n</p><p>��� ������������ ������������ ����������� PHPShop, ����� ������� � ������ ���������� ������ �� ������ ����. �����, ��� ����� ������� ������� ��� ������ - �����������: ������� Visa, Mastercard, ����� ��������� Qiwi, ����� ��������, ���������� ��������� ��� ����������� ���. ����� ������ ������, � ������� ����� �������� ���� �� ������ � ����������� ����. ��������� ���� ���������� �� ���������� �� �����, ��������� � ������� ������� ������ ������� ��������.</p>\n<p><a class="btn btm-sm btn-primary" target="_blank" href="https://www.phpshop.ru/order/?from=@serverName@&amp;action=order">������� � ���������� ������ PHPShop</a></p>', '', 2, 1522156399, '', '������ PHPShop', '1', '0', ''),
(23, '����������', 'admin', 1000, '', '', '<p>��� ������� � ������ ���������� PHPShop ������� ��������� ������ <kbd>Ctrl</kbd> + <kbd>F12</kbd> ��� ����������� ������ �������� ����.<br> ����� �� ��������� <strong>demo</strong>, ������ <strong>demouser</strong>. ���� �� ��� ��������� ������ ���� ����� � ������, �� ����������� ���� ������ ��� �����������.\n</p><p><a href="..phpshop/admpanel/" target="_blank" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-share-alt"></span> ������� � ������ ����������</a></p>\n<h2>�������� ����</h2>\n��� ��������� �������� ����������� �������� �������� ���� ��� ������������ ������������ ���������. ��� ������� �������� ���� ������� � ������ ���������� ��������� ������� � ���� <kbd>����</kbd> - <kbd>SQL ������ � ����</kbd> ������� � ���������� ������ ����� <strong>"�������� ����"</strong>. �������� ���� ��������, ��� ��������� ��� �������� ���� � ������� ������ ������ ��������.\n<h2>�������������� �������</h2>\nPHPShop EasyControl - <strong>���������� �����  ���������� ������</strong> ��� �������� � ���������� ��������-��������� PHPShop �� ��������� ���������� . EasyControl ����� � ��������� � �� ������� ������� ����������� �������. � ������� EasyControl �� ������� ���������� ���� �������� �� �� ���� �� �������, ��������� ��������� �����, ������������ ������, ��������� �������� ���� � ������������� �������. � ������ ������ ������ ����� 10 ������: <strong>Monitor, Updater, Installer, Chat,  Price Loader, Password Restore</strong> � ������.\n<p><a href="https://www.phpshop.ru/loads/files/setup.exe" target="_blank" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-share-alt"></span> ������� ������� EasyControl</a></p>', '', 3, 1522156405, '39,40', '����������������� PHPShop', '1', '0', ''),
(27, '�������', 'help', 4, '', '', '<h3>�������</h3> ���������-�������������� ���� (F.A.Q.), ����������� ����������� PHPShop � ������ �� ������ ������� �� ���������� ��������-���������. ������� ������� ����������� ���������� � �����-������.<br>�����: <a href="http://faq.phpshop.ru" target="_blank">faq.phpshop.ru</a><h3>����������� ������������</h3> ���������� ���� ��� ������������� (WIKI). �������� ������� ���������� ����������� ������������ � ��������� �� ���������� PHPShop. �������� ������ EasyControl � �������������� �������.<br>�����: <a href="http://wiki.phpshop.ru" target="_blank">wiki.phpshop.ru</a><h3>�������� API</h3> ���������� ���� ��� ������������� (PHPDoc). �������� ��������� �������� API PHPShop, ������� � �������.<br>�����: <a href="http://doc.phpshop.ru" target="_blank">doc.phpshop.ru</a><h3>���� ������</h3> ���������� ���� ������ ����������� ���������. �������� ������ �� �������� ������ ��������, ������������� � ������������� PHPShop � ���������.<br>�����: <a href="https://help.phpshop.ru" target="_blank">help.phpshop.ru</a><h3>���������� ����</h3> ������������ ��������� � ���������� ���������� �����. �������� ����� ���������� ���������� �� ������������ ���������, �������� � ������.<br>�����: <a href="https://www.facebook.com/shopsoft" target="_blank">https://www.facebook.com/shopsoft</a><br><a href="https://twitter.com/PHPShopCMS" target="_blank">https://twitter.com/PHPShopCMS</a><br><a href="https://plus.google.com/+PhpshopRu" target="_blank">https://plus.google.com/+PhpshopRu</a><h3>�����-�����</h3> �������������� ������ � �����-������� �� ������ � PHPShop �� ������� YouTube. �������� ��������� ����� �� ��������� � ������ � 1�-��������������, PHPShop � ��������� EasyControl.<br>�����: <a href="http://www.youtube.com/user/phpshopsoftware" target="_blank">http://www.youtube.com/user/phpshopsoftware</a>', '1', 1, 0, '', '', '1', '0', ''),
(22, '������� ������ ��� ������ Visa � Mastercard', 'agreement', 0, '', '', '', '1', 1, 0, '', '', '1', '0', '');

INSERT INTO `phpshop_page` (`id`, `name`, `link`, `category`, `keywords`, `description`, `content`, `servers`, `num`, `datas`, `odnotip`, `title`, `enabled`, `secure`, `secure_groups`) VALUES
(43, '�������� ������������������', 'politika_konfidencialnosti', 0, '', '', '<h2>�������� ������������������ ��� ��������-��������</h2>\r\n<p>� ������� ������ � ������� ��, ��� ��� ���� ���������� ��� ������ �������.</p>\r\n<ol>\r\n<li>����������� ��������\r\n<ol>\r\n<li>������������ �� ������� ������ �������� ������������������ ������������ ������ (����� &ndash; �������� ������������������) �������� �� ���������� ���������:\r\n<ol>\r\n<li>&laquo;������������� ����� ��������-�������� (����� &ndash; ������������� �����)&raquo;. ��� �������� �������������� �������� ����������� ������������, � ��� ����������� ������ ���������� ������, �� ���� ����������� � (���) ��������� ����������� �� ���� ������������ ������. ��� ���������� ���� ������������ ��� ������ ����� ������������, ��� ���� �������������� ��������, ����� �������� ������ ���� ����������, ����� �������� (��������) ������ ������������� � ����������� ����������.</li>\r\n<li>&laquo;������������ ������&raquo; &mdash; ��������, ������� ������ ��� ��������� ��������� � ������������ ���� ������������� ����������� ���� (����� ����������� ��������� ������������ ������).</li>\r\n<li>&laquo;��������� ������������ ������&raquo; &mdash; ����� �������� (��������) ���� ������������ �������, ������� ������������� ���������� � ������������� �������. �� ����� ��������, ����������, �����������������, �����������, �������, �������� (��� ������������� ��������� ��� ��������), ���������, ������������, ���������� (��������������, �������������, ��������� � ��� ������), ������������, �����������, ������� � ���� ����������. ������ �������� (��������) ����� ����������� ��� �������������, ��� � �������.</li>\r\n<li>&laquo;������������������ ������������ ������&raquo; &mdash; ������������ ����������, ������������� � ��������� ��� ����� ����������� � ������� ������������ ������������ ����, ������� ���������� �������� � �����, �� �������� � ��� �����������, ���� �������������� ������������ ������ ������������ �� ������� ��� ��������, � ����� ����������� �������� ��������� ��� �����������.</li>\r\n<li>&laquo;������������ ����� ��������-��������&raquo; (����� &mdash; ������������)&raquo; &ndash; �������, ���������� ���� ��������-��������, � ����� ������������ ��� ����������� � ����������.</li>\r\n<li>&laquo;Cookies&raquo; &mdash; �������� �������� ������, ������������ ���-��������� ��� ���-�������� ���-������� � HTTP-�������, ������ ���, ����� ������������ �������� ������� �������� ��������-��������. �������� �������� �� ���������� ������������.</li>\r\n<li>&laquo;IP-�����&raquo; &mdash; ���������� ������� ����� ���� � ������������ ����, ����������� �� ��������� TCP/IP.</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n</li>\r\n<li>����� ���������\r\n<ol>\r\n<li>�������� ����� ��������-��������, � ����� ������������� ��� �������� � ��������� ������������� �������������� �������� � �������� ��� ��������� ������������������, ��������������� �������������� ������������� ������������ ������ �� ���������.</li>\r\n<li>���� ������������ �� ��������� ������������ �������� ������������������, ������������ ������ �������� ��������-�������.</li>\r\n<li>��������� �������� ������������������ ���������������� ������ �� ���� ��������-��������. ���� �� �������, ����������� �� ����� ����������, ������������ ����� �� ������� ������� ���, ��������-������� �� ��� �������� ��������������� �� ����.</li>\r\n<li>�������� ������������� ������������ ������, ������� ����� �������� ��������� �������� ������������������ ������������, �� ������ � ����������� ������������� �����.</li>\r\n</ol>\r\n</li>\r\n<li>������� �������� ������������������\r\n<ol>\r\n<li>�������� ���������� � ������� ������ �������� ������������������ ������������� ��������-�������� ������� �� ���������� ������������ ������, ���������� ��������������, ����������������� �� ����� ��� ������������ ����� �� ������� ������, � ����� ������������ ���� ������ ���������� ������������������.</li>\r\n<li>����� �������� ������������ ������, ������������ ��������� ������������� �� ����� ��������-�������� ����������� �����. ������������� ������� ������������, ������� �������� ���������, ��������:\r\n<ol>\r\n<li>��� �������, ���, ��������;</li>\r\n<li>��� ���������� �������;</li>\r\n<li>��� ����������� ����� (e-mail);</li>\r\n<li>�����, �� �������� ������ ���� ��������� ��������� �� �����;</li>\r\n<li>����� ���������� ������������.</li>\r\n</ol>\r\n</li>\r\n<li>������ ������, ������������� ������������ ��� ��������� ��������� ������ � ��������� ������� � �������������� �� ��� ��������������� ��������� ������� (���������) �������������� ��������-���������. ��� �������� ���� ������:<br />IP-�����;<br />�������� �� cookies;<br />�������� � �������� (���� ������ ���������, ����� ������� ���������� �������� ����� �������);<br />����� ��������� �����;<br />����� ��������, �� ������� ������������� ��������� ����;<br />������� (����� ���������� ��������).</li>\r\n<li>������������ ���������� cookies ����� ����� ������������� ������� � ��������� ����������� ������ ����� ��������-��������.</li>\r\n<li>��������-������� �������� ���������� �� IP-������� ���� �����������. ������ �������� �����, ����� ������� � ������ ����������� �������� � �����������������, ��������� �������� ����� ���������� ���������� ��������.</li>\r\n<li>����� ������ ������������ ���� ������������ �������� (� ���, ����� � ����� ������� ���� �������, ����� ��� ���� ������������� �������, ����� ���� ����������� ������������ ������� � ��.) ������ �������� � �� ����������������. ���������� ������������ �������� ������������������ ��������������� ��� �������, ��������� � �.�. 5.2 � 5.3.</li>\r\n</ol>\r\n</li>\r\n<li>���� ����� ������������ ���������� ������������\r\n<ol>\r\n<li>���� ������������ ������ ������������ �������������� ��������-�������� ���������� ���� ����, �����:\r\n<ol>\r\n<li>���������������� ������������, ������� ������ ��������� ����������� �� ����� ��������-��������, ����� �������� ����� � (���) ���������� ����� ������� �������� ������������.</li>\r\n<li>������� ������������ ������ � ������������������� �������� ������� �����.</li>\r\n<li>���������� � ������������� �������� �����, ��� ������� ���������������, � ���������, �������� �������� � �����������, ���������� ������������� ����� ��������-��������, ��������� ���������������� �������� � ������, �������� ������ �����.</li>\r\n<li>���������� ��������������� ������������, ����� ���������� ������������ �������� � ������������� �������������.</li>\r\n<li>�����������, ��� ������, ������� ����������� ������������, ����� � ����������.</li>\r\n<li>������� ������� ������ ��� ���������� �������, ���� ������������ ������� �� �� ��� �������.</li>\r\n<li>��������� ������������ � ��������� ��� ������ � ��������-��������.</li>\r\n<li>������������ � �������� �������, ������������ ����� ��� ��������� ������, ���������� �����, ����������, ������������� �� ������������ ����������� ������������ ��������� �����.</li>\r\n<li>���������� ������������ ����������� ������� ������� �������, ������������� ��� ������������� ��������-��������, �� ���� ����������� ���������� � ����������� ���������.</li>\r\n<li>������������ ������������� ������������ �� ���������� ���������, ����������� ��� � ����������� �������������, ������ ��������, ��������� � ������������ ��������-�������� ��� ��� �������� � ������� ����������, ���� ������������ ������� �� �� ��� ��������.</li>\r\n<li>������������� ������ ��������-��������, ���� ������������ ������� �� �� ��� ��������.</li>\r\n<li>������������ ������������ ������ �� ����� ��� ������� ��������-��������, ������� ��� ��� ����� �������� ��������, ���������� � ������.</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n</li>\r\n<li>������� � ����� ��������� ������������ ����������\r\n<ol>\r\n<li>���� ��������� ������������ ������ ������������ ����� �� ���������. ��������� ��������� ����� ����������� ����� ��������������� ����������������� ��������. � ���������, � ������� ��������������&nbsp;������&nbsp;������������ ������, ������� ����� ������� ������������� ���� ��� ������� �������������.</li>\r\n<li>������������ �������������� ����� ������������ ������ ������������ ����� ������������ ������� �����, � ����� ������� ������ ���������� ������, ����������� �������� �����, ��������� ������������. �������� ��� ��� ����, ����� ��������� ����� ������������, ����������� �� �� ����� ��������-��������, � ��������� ����� �� ������. �������� ������������ �� �������� �������� ������������� ��������� �������� �����.</li>\r\n<li>����� ������������ �������������� ����� ������������ ������ ����� ������������ �������������� ������� ��������������� ������ ���������� ���������, ���� ��� �������������� �� �������� ���������� � � ��������������� ���������� ����������������� �������.</li>\r\n<li>���� ������������ ������ ����� �������� ��� ����������, ������������ ������������ �� ���� �������������� �����.</li>\r\n<li>��� �������� ������������� ����� ���������� �� ��, ����� �� ��������� � ������������ ������ ������������ ������� ��� (�� ����������� �.�. 5.2, 5.3). ��������� ��� ���������� �� ������ ���� �������� ���� ��������, ���� �� �� ���������� �, �� �������� � �� �����������, �� ���������� � �� ��������������, � ����� �� ��������� ������ ��������������� ��������. ��� ������ ���������������� ������ ������������� ����������� ���������� ��������������� � ����������� ���.</li>\r\n<li>���� ������������ ������ ����� �������� ���� ����������, ������������� ����� ��������� � ������������� ������ ������� ��� ��������� ����, ���� ������������� ������ � ������ ���������� �����������, ��������� ������ ���������.</li>\r\n</ol>\r\n</li>\r\n<li>������������� ������\r\n<ol>\r\n<li>� ����������� ������������ ������:\r\n<ol>\r\n<li>��������� ��������������� ����������� ��������-�������� �������� � ����.</li>\r\n<li>���������� � ���������� ��������������� �� �������� � ������ ��������� �������.</li>\r\n</ol>\r\n</li>\r\n<li>� ����������� ������������� ����� ������:\r\n<ol>\r\n<li>���������� ���������� �������� ������������� � �����, ������������ � �. 4 ������������ �������� ������������������.</li>\r\n<li>����������� ������������������ ����������� �� ������������ ��������. ��� �� ������ ������������, ���� ������������ �� ���� �� �� ���������� ����������. ����� ������������� �� ����� ����� ���������, ����������, ����������� ���� ���������� ������� ��������� ���������� ������������� ������������ ������, �������� �.�. 5.2 � 5.3 ������������ �������� ������������������.</li>\r\n<li>�������� ��� ����������������, ���� ������������ ������ ������������ ���������� ������ �����������������, ����� �����, ��� �������� ����������������� ������ ���� �������� � ����������� ������� �������.</li>\r\n<li>���������� ������������ ���������������� ������ � ���� �������, � �������� ������������ ���� ��� �������� ������������� ������� ��������������� ������. ����� ������� ������ �� ���������� ����� ��������������� ������, ��������������� �������� ����� ������������, ��������������� ������������� ����� ���� ������, �� ������ ��������, � ������ ����������� ��������������� ���������� ������������ ������ ���� ��������������� ��������.</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n</li>\r\n<li>��������������� ������\r\n<ol>\r\n<li>� ������ ������������ �������������� ����� ����������� ������������ �, ��� ���������, ������� ������������, ��������� ��-�� �������������� ������������� ��������������� �� ����������, ��������������� ����������� �� ��. �� ����, � ���������, ���������� ���������� ����������������. ���������� ������������ � ��������� ����� �������� ������������������ ������ ��� �������, ��������� � �.�. 5.2, 5.3 � 7.2.</li>\r\n<li>�� ���������� ��� �������, ����� ������������� ����� ��������������� �� ����, ���� ���������������� ������ ������������ ��� ������������. ��� ���������� �����, ����� ���:\r\n<ol>\r\n<li>������������ � ��������� �������������� �� ����, ��� ���� �������� ��� ����������.</li>\r\n<li>���� ������������� �������� ������ �� ����, ��� �� �������� ������������� �����.</li>\r\n<li>������������ � �������� ������������.</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n</li>\r\n<li>���������� ������\r\n<ol>\r\n<li>���� ������������ ��������� ���������� ������������� ��������-�������� � ������� ���������� ���� ����� � ����, �� ���� ��� ���������� � �����, �� � ������������ ������� ������ ���������� ��������� (��������� ���������� ������������� �������� �����������).</li>\r\n<li>���������� ��������� ������������� ������� � ������� 30 ����������� ���� � ���� � ��������� ��������� ��������� ������������ � � ������������ � �������� �����.</li>\r\n<li>���� ��� ������� ��� � �� ������ ������������, ���� ��������� � �������� �����, ��� ��� ������ ����������� �������� ������������ ����������� ����������������.</li>\r\n<li>������������� ��������� ������������ � ������������� ����� � �������� ������������������ ���������� �������� ������������ ����������� ����������������.</li>\r\n</ol>\r\n</li>\r\n<li>�������������� �������\r\n<ol>\r\n<li>������������� ����� ������ ������ ������������ �� ������� ������ �������� ������������������, �� ��������� �������� � ������������.</li>\r\n<li>���������� � ���� ����� �������� ������������������ ���������� ����� ����, ��� ���������� � ��� ����� �������� �� ���� ��������-��������, ���� ������������ �������� �� ������������� ����� �������� ����������.</li>\r\n<li>&nbsp;��� �����������, ���������, ���������� ��� ������� �� ��������� �������� ������������������ ������� �������� � ������ �������� �����, ������������� �� ������:&nbsp;<strong>(������)</strong>. ��� ����� �������� ������������ ������ �� ������&nbsp;<strong>(��� ��� email)</strong></li>\r\n<li>��������� � ������������ �������� ������������������ �����, ����� �� �������� ��&nbsp;<strong>������ www.����� ��������.ru</strong></li>\r\n</ol>\r\n</li>\r\n</ol>', '', 1, 0, '', '', '1', '0', ''),
(44, '�������� �� ��������� ������������ ������', 'soglasie_na_obrabotku_personalnyh_dannyh', 0, '', '', '<p>�������� �� ��������� ������������ ������</p>\r\n<p>��������� �, ����� &ndash; &laquo;������� ������������ ������&raquo;, �� ���������� ���������� ������������ ������ �� 27.07.2006 �. � 152-�� &laquo;� ������������ ������&raquo; (� ����������� � ������������) ��������, ����� ����� � � ����� �������� ��� ���� ��������&nbsp;<strong>�������������� ��������������� ������� ����� ���������</strong>&nbsp;(����� &ndash; &laquo;��������-�������&raquo;, �����:&nbsp;<strong>(��� ��� �����)&nbsp;</strong>) �� ��������� ����� ������������ ������, ��������� ��� ����������� ����� ���������� ���-����� �� ����� ��������-��������&nbsp;<strong>��������.��</strong>&nbsp;� ��� ����������&nbsp;<strong>*.��������.��</strong>&nbsp;(����� &ndash; ����), ������������ (�����������) � �������������� �����.</p>\r\n<p>��� ������������� ������� � ������� ����� ����������, ����������� �� ��� ��� � �������� ������������ ������, � ��� ����� ��� �������, ���, ��������, �����, �����������, ���������, ���������� ������ (�������, ����, ����������� �����, �������� �����), ����������,&nbsp; ���� ������ ����������. ��� ���������� ������������ ������ � ������� ����, ��������������, ����������, ���������, ����������, ���������, �������������, ���������������, ��������, � ��� ����� ��������������, �������������, ������������, �����������, ���������� ��������), � ����� ������ �������� (��������) � ������������� �������.</p>\r\n<p>��������� ������������ ������ �������� ������������ ������ �������������� ������������� � ����� ����������� �������� ������������ ������ � ���� ������ ��������-�������� � ����������� ������������ �������� ������������ ������ �������� ��������� � ���-�����������, � ��� ����� ���������� ����������, �� ��������-��������, ��� �������������� ��� �/��� ��������������, �������������� � ��������� ��������,&nbsp; ����������� �� ����������� ��������-�������� � ������ ���������� ��������-���������� ����������, � ����� � ����� ������������� �������� �������� ������������ ������ ��� ��������� ����������� ��������-��������.</p>\r\n<p>����� ������ �������� �� ��������� ������������ ������ �������� ������������ ������ �������� ���� �������� ��������������� ���-����� � ����� ��������-��������.</p>\r\n<p>��������� ������������ ������ �������� ������������ ������ ����� �������������� � ������� ������� ������������� �/��� ��� ������������� ������� ������������� � ������������ � ����������� ����������������� �� � ����������� ����������� ��������-��������.</p>\r\n<p>��������-������� ��������� ����������� ��������, ��������������� � ����������� ���� ��� ������������ �� �������� ��� ������ ������������ ������ �� �������������� ��� ���������� ������� � ���, �����������, ���������, ������������, �����������, ��������������, ��������������� ������������ ������, � ����� �� ���� ������������� �������� � ��������� ������������ ������, � ����� ��������� �� ���� ������������� ���������� ������������������ ������������ ������ �������� ������������ ������. ��������-������� ������ ���������� ��� ��������� ������������ ������ �������� ������������ ������ ��������������, � ����� ������ ���������� ������������ ������ ��� ��������� ����� �������������� �����, ����������� ��� ���� �������� ������ ��������������� � ��������������� ������ ��������������� ������������ � ����� ������������������ ������������ ������.</p>\r\n<p>� ����������(�), ���:</p>\r\n<ol>\r\n<li>��������� �������� �� ��������� ���� ������������ ������, ��������� ��� ����������� �� ����� ��������-��������, ������������ (�����������) � �������������� C����, ��������� � ������� 20 (��������) ��� � ������� ����������� �� C���� ��������-��������;</li>\r\n<li>�������� ����� ���� �������� ���� �� ��������� ����������� ��������� � ������������ �����;</li>\r\n<li>�������������� ������������ ������ ������� ��� ��� �� �������� ������ ��������������� � ������������ � ����������� ����������������� ���������� ���������.</li>\r\n</ol>', '', 1, 0, '', '', '1', '0', '');



-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_page_categories`
--

CREATE TABLE `phpshop_page_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `num` int(64) DEFAULT '1',
  `parent_to` int(11) DEFAULT '0',
  `content` text,
  `page_cat_seo_name` VARCHAR(255) DEFAULT '',
  `servers` varchar(64) default '',
  PRIMARY KEY (`id`),
  KEY `parent_to` (`parent_to`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_page_categories`
--

INSERT INTO `phpshop_page_categories` (`id`, `name`, `num`, `parent_to`, `content`) VALUES
(4, '������� ���������', 0, 0, '');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_parent_name`
--

CREATE TABLE `phpshop_parent_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_parent_name`
--

INSERT INTO `phpshop_parent_name` (`id`, `name`, `enabled`) VALUES
(1, '��������', '1'),
(2, '���� �������', '1');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_payment`
--

CREATE TABLE `phpshop_payment` (
  `uid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `sum` float DEFAULT '0',
  `datas` int(11) DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `order` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_payment_systems`
--

CREATE TABLE `phpshop_payment_systems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `path` varchar(255) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '1',
  `num` tinyint(11) DEFAULT '0',
  `message` text,
  `message_header` text,
  `yur_data_flag` enum('0','1') DEFAULT '0',
  `icon` varchar(255) DEFAULT '',
  `color` varchar(64) default '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_payment_systems`
--

INSERT INTO `phpshop_payment_systems` (`id`, `name`, `path`, `enabled`, `num`, `message`, `message_header`, `yur_data_flag`, `icon`) VALUES
(1, '���������� �������', 'bank', '1', 4, '<img src="/UserFiles/Image/Trial/rabbit.png" alt="" align="" border="0"><h3>���������� ��� �� �����!</h3><p>���� ��� �������� � �����&nbsp;<a href="/users/order.html">������ ��������</a>.&nbsp;</p><p>������ ������� �� ������� �������� ��������� � ����� �����.</p>', '', '1', '/UserFiles/Image/Payments/beznal.png'),
(3, '�������� ������', 'message', '1', 0, '<img src="/UserFiles/Image/Trial/rabbit.png" alt="" align="" border="0"><h3>���������� ��� �� �����!</h3>� ��������� ����� � ���� �������� ��� �������� ��� ��������� �������.', '', '', '/UserFiles/Image/Payments/nal.png'),
(10032, 'Visa, Mastercard (Tinkoff)', 'modules', '0', 0, '', '', '', '/UserFiles/Image/Payments/tinkoff.png');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_photo`
--

CREATE TABLE `phpshop_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '0',
  `name` varchar(64) DEFAULT '',
  `num` tinyint(11) DEFAULT '0',
  `info` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `parent` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_photo_categories`
--

CREATE TABLE `phpshop_photo_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_to` int(11) DEFAULT '0',
  `link` varchar(64) DEFAULT '',
  `name` varchar(64) DEFAULT '',
  `num` tinyint(11) DEFAULT '0',
  `content` text,
  `enabled` enum('0','1') DEFAULT '0',
  `page` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_products`
--

CREATE TABLE `phpshop_products` (
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
  `title` varchar(255) DEFAULT '',
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
  `parent2` text,
  `color` varchar(64) DEFAULT NULL,
  `prod_seo_name_old` VARCHAR(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `enabled` (`enabled`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_products`
--

INSERT INTO `phpshop_products` (`id`, `category`, `name`, `description`, `content`, `price`, `price_n`, `sklad`, `p_enabled`, `enabled`, `uid`, `spec`, `odnotip`, `vendor`, `vendor_array`, `yml`, `num`, `newtip`, `title`, `title_enabled`, `datas`, `page`, `user`, `descrip`, `descrip_enabled`, `title_shablon`, `descrip_shablon`, `keywords`, `keywords_enabled`, `keywords_shablon`, `pic_small`, `pic_big`, `yml_bid_array`, `parent_enabled`, `parent`, `items`, `weight`, `price2`, `price3`, `price4`, `price5`, `files`, `baseinputvaluta`, `ed_izm`, `dop_cat`, `rate`, `rate_count`, `prod_seo_name`, `price_search`, `parent2`, `color`) VALUES
(1, 8, '����������� ���� ��� ������', '<p>������������ ������� ������� �� � �������� �� �����. ����������� 12 ����� ���������. ����������� �������, ���������� ������� �� �� �������� ����������� �����, ���� (������� ����), ����� (���� � ��������) � ������.</p>', '<p>������������ ������� ������� �� � �������� �� �����. ����������� 12 ����� ���������. ����������� �������, ���������� ������� �� �� �������� ����������� �����, ���� (������� ����), ����� (���� � ��������) � ������.</p>', 4000, 7000, '0', '1', '1', '356542', '1', '1,8,14', 'i1-2ii3-10i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2232223b7d693a333b613a313a7b693a303b733a323a223130223b7d7d, '1', 0, '1', '', '0', 1522079380, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img1_22472s.png', '/UserFiles/Image/Trial/img1_22472.png', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 30, 40, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, '', 0, NULL, NULL),
(2, 8, '������� ��� ��� Loreal', '<p>������������ ������� ������� �� � �������� �� �����. ����������� 12 ����� ���������. ����������� �������, ���������� ������� �� �� �������� ����������� �����, ���� (������� ����), ����� (���� � ��������) � ������.</p>', '<p>������������ ������� ������� �� � �������� �� �����. ����������� 12 ����� ���������. ����������� �������, ���������� ������� �� �� �������� ����������� �����, ���� (������� ����), ����� (���� � ��������) � ������.</p>', 2300, 4000, '0', '1', '1', '345464', '0', '13,6,10', 'i1-1ii3-10i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2231223b7d693a333b613a313a7b693a303b733a323a223130223b7d7d, '1', 0, '1', '', '0', 1522079462, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img2_78894s.png', '/UserFiles/Image/Trial/img2_78894.png', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 100, 10, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, '', 0, NULL, NULL),
(3, 8, '��������� �����', '<p>������ ������ ������ Dior Addict ��������� ����� �������� - Extreme � � �������� �������, �������� ������� ��������� � �������� ������� ��� � ������, ���������� ������ Dior.</p>', '<p>������ ������ ������ Dior Addict ��������� ����� �������� - Extreme � � �������� �������, �������� ������� ��������� � �������� ������� ��� � ������, ���������� ������ Dior.</p>', 6000, 0, '0', '1', '1', '345724', '0', '12,4,10', 'i1-6ii3-10ii3-9i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2236223b7d693a333b613a323a7b693a303b733a323a223130223b693a313b733a313a2239223b7d7d, '1', 0, '1', '', '0', 1522079493, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img3_16362s.png', '/UserFiles/Image/Trial/img3_16362.png', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 50, 10, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(4, 8, '������ Vichy', '<p>���� ��� ������ PhotoReady Revlon</p>', '<p>��������� �� ������ ������� ������������� �������, ��� �������� ������� �� �������, ��������� ��������� ��. </p>', 2300, 3000, '0', '1', '1', '456879', '0', '13,6,10', 'i1-7ii3-9i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2237223b7d693a333b613a313a7b693a303b733a313a2239223b7d7d, '1', 0, '1', '', '0', 1522079488, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img4_42389s.png', '/UserFiles/Image/Trial/img4_42389.png', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 100, 10, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(5, 8, '���������� ����� Vichy', '<p>��������� �������� � �� ������ �������� ����������� � ����������� ����������� ����� �������� �������� ���� ����, �������� �������� ��������.</p>', '<p>��������� �������� � �� ������ �������� ����������� � ����������� ����������� ����� �������� �������� ���� ����, �������� �������� ��������.</p>', 500, 700, '0', '1', '1', '486837', '0', '10,16,5,3', 'i1-7ii3-8ii3-9i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2237223b7d693a333b613a323a7b693a303b733a313a2238223b693a313b733a313a2239223b7d7d, '1', 0, '1', '', '0', 1522079392, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img5_38508s.jpg', '/UserFiles/Image/Trial/img5_38508.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 100, 2, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(6, 8, '������ Maybelline', '<p>��������� �������� � �� ������ �������� ����������� � ����������� ����������� ����� �������� �������� ���� ����, �������� �������� ��������.</p>', '<p>��������� �������� � �� ������ �������� ����������� � ����������� ����������� ����� �������� �������� ���� ����, �������� �������� ��������.</p>', 600, 1000, '0', '1', '1', '486847', '0', '13,6,10', 'i1-3ii3-8i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2233223b7d693a333b613a313a7b693a303b733a313a2238223b7d7d, '1', 0, '1', '', '0', 1522079499, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img6_66962s.jpg', '/UserFiles/Image/Trial/img6_66962.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 10, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(7, 9, '������� ��� ��� Lip Glow', '<p>������������ ������� ������� �� � �������� �� �����. ����������� 12 ����� ���������. ����������� �������, ���������� ������� �� �� �������� ����������� �����, ���� (������� ����), ����� (���� � ��������) � ������.</p>', '<p>������������ ������� ������� �� � �������� �� �����. ����������� 12 ����� ���������. ����������� �������, ���������� ������� �� �� �������� ����������� �����, ���� (������� ����), ����� (���� � ��������) � ������.</p>', 2300, 4000, '0', '1', '1', '345464', '0', '16,17,13,15,14,18', 'i1-1ii3-8i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2231223b7d693a333b613a313a7b693a303b733a313a2238223b7d7d, '1', 0, '1', '', '0', 1522079521, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img7_29787s.png', '/UserFiles/Image/Trial/img7_29787.png', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 100, 10, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(8, 9, '����������� ���� ��� ������', '<p>������������ ������� ������� �� � �������� �� �����. ����������� 12 ����� ���������. ����������� �������, ���������� ������� �� �� �������� ����������� �����, ���� (������� ����), ����� (���� � ��������) � ������.</p>', '<p>������������ ������� ������� �� � �������� �� �����. ����������� 12 ����� ���������. ����������� �������, ���������� ������� �� �� �������� ����������� �����, ���� (������� ����), ����� (���� � ��������) � ������.</p>', 4000, 7000, '0', '1', '1', '356542', '0', '16,17,13,15,14,18', 'i1-2ii3-9i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2232223b7d693a333b613a313a7b693a303b733a313a2239223b7d7d, '1', 0, '1', '', '0', 1522079550, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img8_36236s.png', '/UserFiles/Image/Trial/img8_36236.png', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 30, 40, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(9, 9, '����� ��� �������', '<p>��������� �������� � �� ������ �������� ����������� � ����������� ����������� ����� �������� �������� ���� ����, �������� �������� ��������.</p>', '<p>��������� �������� � �� ������ �������� ����������� � ����������� ����������� ����� �������� �������� ���� ����, �������� �������� ��������.</p>', 500, 700, '0', '1', '1', '486837', '0', '16,17,13,15,14,18', 'i1-2i', 0x613a313a7b693a313b613a313a7b693a303b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1522079564, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img9_13210s.jpg', '/UserFiles/Image/Trial/img9_13210.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 100, 2, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(10, 9, '���������� ����� Forever', '<p>��������� �������� � �� ������ �������� ����������� � ����������� ����������� ����� �������� �������� ���� ����, �������� �������� ��������.</p>', '<p>��������� �������� � �� ������ �������� ����������� � ����������� ����������� ����� �������� �������� ���� ����, �������� �������� ��������.</p>', 600, 1000, '0', '1', '1', '486847', '0', '16,17,13,15,14,18', 'i1-3ii3-8ii3-9i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2233223b7d693a333b613a323a7b693a303b733a313a2238223b693a313b733a313a2239223b7d7d, '1', 0, '1', '', '0', 1522079574, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img10_91260s.png', '/UserFiles/Image/Trial/img10_91260.png', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 10, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(11, 9, '������� Nude Shimmer', '<p>������ ������ ������ Dior Addict ��������� ����� �������� - Extreme � � �������� �������, �������� ������� ��������� � �������� ������� ��� � ������, ���������� ������ Dior.</p>', '<p>������ ������ ������ Dior Addict ��������� ����� �������� - Extreme � � �������� �������, �������� ������� ��������� � �������� ������� ��� � ������, ���������� ������ Dior.</p>', 6000, 0, '0', '1', '1', '345724', '0', '7,8,9,10,12,11', 'i1-6ii3-8i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2236223b7d693a333b613a313a7b693a303b733a313a2238223b7d7d, '1', 0, '1', '', '0', 1522079595, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img11_26365s.png', '/UserFiles/Image/Trial/img11_26365.png', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 50, 10, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(12, 9, '������ Maybelline', '<p>���� ��� ������ PhotoReady Revlon</p>', '<p>��������� �� ������ ������� ������������� �������, ��� �������� ������� �� �������, ��������� ��������� ��. </p>', 2300, 3000, '0', '1', '1', '456879', '0', '16,17,13,15,14,18', 'i1-3i', 0x613a313a7b693a313b613a313a7b693a303b733a313a2233223b7d7d, '1', 0, '1', '', '0', 1522079583, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img12_70307s.png', '/UserFiles/Image/Trial/img12_70307.png', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 100, 10, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(13, 7, '������ Loreal', '<p>������������ ������� ������� �� � �������� �� �����. ����������� 12 ����� ���������. ����������� �������, ���������� ������� �� �� �������� ����������� �����, ���� (������� ����), ����� (���� � ��������) � ������.</p>', '<p>������������ ������� ������� �� � �������� �� �����. ����������� 12 ����� ���������. ����������� �������, ���������� ������� �� �� �������� ����������� �����, ���� (������� ����), ����� (���� � ��������) � ������.</p>', 2300, 4000, '0', '1', '1', '345464', '0', '7,8,9,10,12,11', 'i1-1ii3-8i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2231223b7d693a333b613a313a7b693a303b733a313a2238223b7d7d, '1', 0, '1', '', '0', 1522079633, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img13_79095s.png', '/UserFiles/Image/Trial/img13_79095.png', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 100, 10, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(14, 7, '���� ��� ������', '<p>������������ ������� ������� �� � �������� �� �����. ����������� 12 ����� ���������. ����������� �������, ���������� ������� �� �� �������� ����������� �����, ���� (������� ����), ����� (���� � ��������) � ������.</p>', '<p>������������ ������� ������� �� � �������� �� �����. ����������� 12 ����� ���������. ����������� �������, ���������� ������� �� �� �������� ����������� �����, ���� (������� ����), ����� (���� � ��������) � ������.</p>', 4000, 7000, '0', '1', '1', '356542', '0', '7,8,9', 'i1-7ii3-9i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2237223b7d693a333b613a313a7b693a303b733a313a2239223b7d7d, '1', 0, '1', '', '0', 1522079674, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img14_30791s.png', '/UserFiles/Image/Trial/img14_30791.png', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 30, 40, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(15, 7, '���� Loreal', '<p>��������� �������� � �� ������ �������� ����������� � ����������� ����������� ����� �������� �������� ���� ����, �������� �������� ��������.</p>', '<p>��������� �������� � �� ������ �������� ����������� � ����������� ����������� ����� �������� �������� ���� ����, �������� �������� ��������.</p>', 500, 700, '0', '1', '1', '486837', '0', '16,17,13', 'i1-1ii3-10ii3-8ii3-9i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2231223b7d693a333b613a333a7b693a303b733a323a223130223b693a313b733a313a2238223b693a323b733a313a2239223b7d7d, '1', 0, '1', '', '0', 1522079645, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img15_38381s.jpg', '/UserFiles/Image/Trial/img15_38381.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 100, 2, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(16, 7, '���������� ����� Forever', '<p>��������� �������� � �� ������ �������� ����������� � ����������� ����������� ����� �������� �������� ���� ����, �������� �������� ��������.</p>', '<p>��������� �������� � �� ������ �������� ����������� � ����������� ����������� ����� �������� �������� ���� ����, �������� �������� ��������.</p>', 600, 1000, '0', '1', '1', '486847', '0', '16,17,13,15,14,18', 'i1-2ii3-10i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2232223b7d693a333b613a313a7b693a303b733a323a223130223b7d7d, '1', 0, '1', '', '0', 1522079607, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img16_18757s.jpg', '/UserFiles/Image/Trial/img16_18757.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 10, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 1, '', 0, NULL, NULL),
(17, 7, '����� ��� ������ PhotoReady', '<p>���� ��� ������ PhotoReady Revlon</p>', '<p>��������� �� ������ ������� ������������� �������, ��� �������� ������� �� �������, ��������� ��������� ��. </p>', 2300, 3000, '0', '1', '1', '456879', '0', '2,1,5,4,3,6', 'i1-2ii3-8i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2232223b7d693a333b613a313a7b693a303b733a313a2238223b7d7d, '1', 0, '1', '', '0', 1522079617, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img17_15588s.png', '/UserFiles/Image/Trial/img17_15588.png', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 100, 10, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 1, '', 0, NULL, NULL),
(18, 7, '������ Nude', '<p>������ ������ ������ Dior Addict ��������� ����� �������� - Extreme � � �������� �������, �������� ������� ��������� � �������� ������� ��� � ������, ���������� ������ Dior.</p>', '<p>������ ������ ������ Dior Addict ��������� ����� �������� - Extreme � � �������� �������, �������� ������� ��������� � �������� ������� ��� � ������, ���������� ������ Dior.</p>', 6000, 0, '0', '1', '1', '345724', '0', '9,10,12', 'i1-6ii3-10i', 0x613a323a7b693a313b613a313a7b693a303b733a313a2236223b7d693a333b613a313a7b693a303b733a323a223130223b7d7d, '1', 0, '1', '', '0', 1522079689, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img18_31371s.png', '/UserFiles/Image/Trial/img18_31371.png', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 50, 10, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(19, 1, '������ Mango', '<p>������ ��������� �� ��������� �� ����� ���������. ����������� ����� �� �������� ����������� �����, ������� ������, ���� ����������� ����������� �����������.</p>', '<p>������ ��������� �� ��������� �� ����� ���������. ����������� ����� �� �������� ����������� �����, ������� ������, ���� ����������� ����������� �����������.</p>', 3400, 4000, '0', '1', '1', '129699', '1', '52,54,55', 'i6-14ii7-15ii7-16ii7-17ii8-26ii8-22i', 0x613a333a7b693a363b613a313a7b693a303b733a323a223134223b7d693a373b613a333a7b693a303b733a323a223135223b693a313b733a323a223136223b693a323b733a323a223137223b7d693a383b613a323a7b693a303b733a323a223236223b693a313b733a323a223232223b7d7d, '1', 0, '1', '', '0', 1522079712, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img19_78131s.jpg', '/UserFiles/Image/Trial/img19_78131.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '88,87,86,85', 100, 500, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(20, 1, '������ �� �������� ���������', '<p>������ �� �������� ������ ���������� �������� ��������� �����. �������� ������� ����� ����������� �������� �������� ��������. ������: �������� �� ������ �� ������, ������� ������������ ���������� ������� �� ������, ���������� ����.</p>', '<p>������ �� �������� ������ ���������� �������� ��������� �����. �������� ������� ����� ����������� �������� �������� ��������. ������: �������� �� ������ �� ������, ������� ������������ ���������� ������� �� ������, ���������� ����.</p>', 5000, 8000, '0', '1', '1', '8769786', '1', '31,19,24', 'i6-12ii7-17ii7-18ii8-26i', 0x613a333a7b693a363b613a313a7b693a303b733a323a223132223b7d693a373b613a323a7b693a303b733a323a223137223b693a313b733a323a223138223b7d693a383b613a313a7b693a303b733a323a223236223b7d7d, '1', 0, '1', '', '0', 1522079701, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img20_11241s.jpg', '/UserFiles/Image/Trial/img20_11241.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '91,90,89', 33, 200, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(21, 1, '����� �����', '<p>������  - ��������� ����� �� ������ ����. ������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. </p>', '<p>������  - ��������� ����� �� ������ ����. ������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. </p>', 800, 1000, '0', '1', '1', '0980987', '1', '26,27,30', 'i6-13ii6-13ii7-nullii8-nulli', 0x613a333a7b693a363b613a323a7b693a303b733a323a223133223b693a313b733a323a223133223b7d693a373b613a313a7b693a303b733a343a226e756c6c223b7d693a383b613a313a7b693a303b733a343a226e756c6c223b7d7d, '1', 0, '1', '', '0', 1523282107, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img21_81261s.jpg', '/UserFiles/Image/Trial/img21_81261.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '84,83,82', 99, 200, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 'zhaket-seryy', 0, NULL, NULL),
(22, 1, '������ ������', '<div class="product-info-box">\n<div class="content panel-smart">\n<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>\n</div>\n</div>\n<div class="product-info-box empty-check">�</div>', '<div class="product-info-box">\n<div class="content panel-smart">\n<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>\n</div>\n</div>\n<div class="product-info-box empty-check">�</div>', 4500, 7800, '0', '1', '1', '09870986', '1', '30,25,28', 'i6-13ii6-13ii7-nullii8-nulli', 0x613a333a7b693a363b613a323a7b693a303b733a323a223133223b693a313b733a323a223133223b7d693a373b613a313a7b693a303b733a343a226e756c6c223b7d693a383b613a313a7b693a303b733a343a226e756c6c223b7d7d, '1', 0, '1', '', '0', 1523371558, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img22_73532s.jpg', '/UserFiles/Image/Trial/img22_73532.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '81,80,79,78', 70, 300, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 'plate-chernoe', 0, NULL, NULL),
(23, 1, '����� �� ������� ����������� ���������', '<p>������ �� ������� ����������� ���������. ������: ��������������� ����, ������� �����, �������� ��������������� ����� 3/4, ��������� �����, ������ ���������, ����� �������� �� ������.</p>', '<p>������ �� ������� ����������� ���������. ������: ��������������� ����, ������� �����, �������� ��������������� ����� 3/4, ��������� �����, ������ ���������, ����� �������� �� ������.</p>', 5600, 7800, '0', '1', '1', '0987089', '1', '19,24,22', 'i6-12i', 0x613a313a7b693a363b613a313a7b693a303b733a323a223132223b7d7d, '1', 0, '1', '', '0', 1522079779, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img23_26114s.jpg', '/UserFiles/Image/Trial/img23_26114.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '73,72,71,70', 80, 300, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(24, 1, '������ �� ������� ���������', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����.</p>', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', 9900, 11000, '0', '1', '1', '900897', '1', '26,27,30', 'i6-14i', 0x613a313a7b693a363b613a313a7b693a303b733a323a223134223b7d7d, '1', 0, '1', '', '0', 1522079758, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img24_16757s.jpg', '/UserFiles/Image/Trial/img24_16757.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '77,76,75,74', 70, 560, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(25, 4, '����', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', 15000, 0, '0', '1', '1', '', '0', '23,21,31', 'i6-14i', 0x613a313a7b693a363b613a313a7b693a303b733a323a223134223b7d7d, '1', 0, '1', '', '0', 1522079879, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img25_66005s.jpg', '/UserFiles/Image/Trial/img25_66005.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '93,92', 23, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(26, 4, '������� �������', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', 12000, 0, '0', '1', '1', '9878790', '0', '21,19,24', '', 0x4e3b, '1', 0, '1', '', '0', 1522079826, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img26_53995s.jpg', '/UserFiles/Image/Trial/img26_53995.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '104,103,102', 66, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(27, 4, '��������� ����������', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', 13000, 0, '0', '1', '1', '', '0', '24,20,22', 'i6-11i', 0x613a313a7b693a363b613a313a7b693a303b733a323a223131223b7d7d, '1', 0, '1', '', '0', 1522079871, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img27_18062s.jpg', '/UserFiles/Image/Trial/img27_18062.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '95,94', 55, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(28, 4, '������', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', 6000, 6500, '1', '1', '1', '567850', '0', '26,27,30', 'i6-14i', 0x613a313a7b693a363b613a313a7b693a303b733a323a223134223b7d7d, '1', 0, '1', '', '0', 1522079838, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img28_54487s.jpg', '/UserFiles/Image/Trial/img28_54487.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '101,100', 60, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(29, 4, '����� ������� �������', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', '<p>�����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', 15500, 0, '0', '1', '1', '09860', '0', '31,19,24', 'i6-13i', 0x613a313a7b693a363b613a313a7b693a303b733a323a223133223b7d7d, '1', 0, '1', '', '0', 1522079860, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img29_38525s.jpg', '/UserFiles/Image/Trial/img29_38525.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '97,96', 50, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(30, 4, '��������� ���������� Boss', '<p>������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', 16000, 0, '0', '1', '1', '098097', '0', '21,31,20', 'i6-14i', 0x613a313a7b693a363b613a313a7b693a303b733a323a223134223b7d7d, '1', 0, '1', '', '0', 1522079846, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img30_32460s.jpg', '/UserFiles/Image/Trial/img30_32460.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '99,98', 50, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(31, 1, '����������', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����.</p>', '<p>������ ������������ ���� ��������� �� ������� ���������� ��������� ������ �����. ������: �����-���� �� �����, ������� ��� ���������� �������, ������ ���������, ��������� ���������� �����, �������������� ������ �� ������.</p>', 11000, 11000, '1', '1', '1', '900897', '1', '31,24,20', 'i6-14i', 0x613a313a7b693a363b613a313a7b693a303b733a323a223134223b7d7d, '1', 0, '1', '', '0', 1522079803, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img31_22065s.jpg', '/UserFiles/Image/Trial/img31_22065.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '69,68,67', 70, 560, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(32, 1, '�����', '<p>������ �� ������� ����������� ���������. ������: ��������������� ����, ������� �����, �������� ��������������� ����� 3/4, ��������� �����, ������ ���������, ����� �������� �� ������.</p>', '<p>������ �� ������� ����������� ���������. ������: ��������������� ����, ������� �����, �������� ��������������� ����� 3/4, ��������� �����, ������ ���������, ����� �������� �� ������.</p>', 7800, 7800, '0', '1', '1', '0987089', '1', '26,30,28', 'i6-12i', 0x613a313a7b693a363b613a313a7b693a303b733a323a223132223b7d7d, '1', 0, '1', '', '0', 1522079794, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img32_25817s.jpg', '/UserFiles/Image/Trial/img32_25817.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '66,65,64,63', 80, 300, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(33, 6, '������� Apple', '<p>������� Canon EF/EF-S</p>\r\n<p>�������� � ���������, ������ ��������� � ��������</p>\r\n<p>������� 18.5 �� (APS-C)</p>\r\n<p>������ ����� Full HD</p>\r\n<p>���������� ��������� ����� 3</p>\r\n<p>��� ������ ��� ��������� 575�</p>', '<p>������� Canon EF/EF-S</p>\r\n<p>�������� � ���������, ������ ��������� � ��������</p>\r\n<p>������� 18.5 �� (APS-C)</p>\r\n<p>������ ����� Full HD</p>\r\n<p>���������� ��������� ����� 3</p>\r\n<p>��� ������ ��� ��������� 575�</p>', 46000, 7000, '0', '1', '1', '9809000', '0', '37,35,34', 'i12-28i', 0x613a313a7b693a31323b613a313a7b693a303b733a323a223238223b7d7d, '1', 0, '1', '', '0', 1522079894, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img33_61292s.jpg', '/UserFiles/Image/Trial/img33_61292.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '115', 70, 200, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(34, 6, 'Samsung', '<p>������ ����� Full HD</p>\r\n<p>���������� ��������� ����� 3</p>\r\n<p>��� ������ ��� ��������� 575�</p>', '<p>������ ����� Full HD</p>\r\n<p>���������� ��������� ����� 3</p>\r\n<p>��� ������ ��� ��������� 575�</p>', 60000, 65000, '0', '1', '1', '', '0', '38,34,36', 'i12-29i', 0x613a313a7b693a31323b613a313a7b693a303b733a323a223239223b7d7d, '1', 0, '1', '', '0', 1522079938, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img34_60925s.jpg', '/UserFiles/Image/Trial/img34_60925.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '110,109', 77, 60, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(35, 6, 'HP ProBook 450', '<p>������� Canon EF/EF-S</p>\r\n<p>�������� � ���������, ������ ��������� � ��������</p>\r\n<p>������� 18.5 �� (APS-C)</p>', '<p>������� Canon EF/EF-S</p>\r\n<p>�������� � ���������, ������ ��������� � ��������</p>\r\n<p>������� 18.5 �� (APS-C)</p>', 125000, 127000, '1', '1', '1', '0789876', '0', '38,35,34', 'i12-28i', 0x613a313a7b693a31323b613a313a7b693a303b733a323a223238223b7d7d, '1', 0, '1', '', '0', 1522079909, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img35_98263s.jpg', '/UserFiles/Image/Trial/img35_98263.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '114,113', 45, 500, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(36, 6, 'Samsung Gear VR', '<p>������ ����� Full HD</p>\r\n<p>���������� ��������� ����� 3</p>\r\n<p>��� ������ ��� ��������� 575�</p>', '<p>������ ����� Full HD</p>\r\n<p>���������� ��������� ����� 3</p>\r\n<p>��� ������ ��� ��������� 575�</p>', 67000, 0, '0', '1', '1', '1882234', '0', '37,38,35', 'i12-28i', 0x613a313a7b693a31323b613a313a7b693a303b733a323a223238223b7d7d, '1', 0, '1', '', '0', 1522079923, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img36_62837s.jpg', '/UserFiles/Image/Trial/img36_62837.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '112,111', 56, 700, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(37, 6, ' Lenovo IdeaPad 110', '<p>������ ����� Full HD</p>\r\n<p>���������� ��������� ����� 3</p>\r\n<p>��� ������ ��� ��������� 575�</p>', '<p>������ ����� Full HD</p>\r\n<p>���������� ��������� ����� 3</p>\r\n<p>��� ������ ��� ��������� 575�</p>', 64000, 0, '0', '1', '1', '45674567', '0', '38,35,34', 'i12-29i', 0x613a313a7b693a31323b613a313a7b693a303b733a323a223239223b7d7d, '1', 0, '1', '', '0', 1522079949, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img37_19544s.jpg', '/UserFiles/Image/Trial/img37_19544.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '108,107', 45, 1200, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(38, 6, ' Vivo V5', '<p>������� Canon EF/EF-S</p>\r\n<p>�������� � ���������, ������ ��������� � ��������</p>\r\n<p>������� 18.5 �� (APS-C)</p>', '<p>������� Canon EF/EF-S</p>\r\n<p>�������� � ���������, ������ ��������� � ��������</p>\r\n<p>������� 18.5 �� (APS-C)</p>', 35000, 0, '0', '1', '1', '9879087', '0', '38,35,34', 'i12-28i', 0x613a313a7b693a31323b613a313a7b693a303b733a323a223238223b7d7d, '1', 0, '1', '', '0', 1522079962, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img38_22872s.jpg', '/UserFiles/Image/Trial/img38_22872.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '106,105', 0, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(39, 12, '������� �������', '<p class="pp">��� ������ � ��������� (�): 0.45 �</p>\r\n<p class="pp">����� ����������: 23 ��</p>\r\n<p class="pp">������ ������: ������</p>\r\n<p class="pp">������ �������������: �����</p>\r\n<p class="pp">������������: ���</p>', '<p class="pp">��� ������ � ��������� (�): 0.45 �</p>\r\n<p class="pp">����� ����������: 23 ��</p>\r\n<p class="pp">������ ������: ������</p>\r\n<p class="pp">������ �������������: �����</p>\r\n<p class="pp">������������: ���</p>', 45000, 0, '0', '1', '1', '098089', '0', '47,48,45', '', 0x4e3b, '1', 0, '1', '', '0', 1522079978, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img39_86997s.jpg', '/UserFiles/Image/Trial/img39_86997.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '117,116', 5, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(40, 12, '����', '<p class="pp">��� ������ � ��������� (�): 0.45 �</p>\r\n<p class="pp">����� ����������: 23 ��</p>\r\n<p class="pp">������ ������: ������</p>\r\n<p class="pp">������ �������������: �����</p>\r\n<p class="pp">������������: ���</p>', '<p class="pp">��� ������ � ��������� (�): 0.45 �</p>\r\n<p class="pp">����� ����������: 23 ��</p>', 5000, 0, '0', '1', '1', '0798098', '0', '38,35,34', '', 0x4e3b, '1', 0, '1', '', '0', 1522080030, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img40_42498s.jpg', '/UserFiles/Image/Trial/img40_42498.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '127,126', 0, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(41, 12, '������ �� ������', '<p class="pp">��� ������ � ��������� (�): 0.45 �</p>\r\n<p class="pp">����� ����������: 23 ��</p>\r\n<p class="pp">������ ������: ������</p>\r\n<p class="pp">������ �������������: �����</p>\r\n<p class="pp">������������: ���</p>', '<p class="pp">��� ������ � ��������� (�): 0.45 �</p>\r\n<p class="pp">����� ����������: 23 ��</p>\r\n<p class="pp">������ ������: ������</p>\r\n<p class="pp">������ �������������: �����</p>\r\n<p class="pp">������������: ���</p>', 600, 0, '0', '1', '1', '253458', '0', '39,41,50', '', 0x4e3b, '1', 0, '1', '', '0', 1522079990, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img41_13435s.jpg', '/UserFiles/Image/Trial/img41_13435.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '119,118', 8, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(42, 12, '����� ����������', '<p class="pp">��� ��������: ������</p>\r\n<p class="pp">������� ���������: �������</p>\r\n<p class="pp">���������� �����: �� �����</p>\r\n<p class="pp">�������: ���������� �� ������</p>\r\n<p class="pp">���������� ���������: 3 ��.</p>\r\n<p class="pp">������ �����: ����� �����</p>', '<p class="pp">��� ��������: ������</p>\r\n<p class="pp">������� ���������: �������</p>\r\n<p class="pp">���������� �����: �� �����</p>\r\n<p class="pp">�������: ���������� �� ������</p>\r\n<p class="pp">���������� ���������: 3 ��.</p>\r\n<p class="pp">������ �����: ����� �����</p>', 3500, 0, '0', '1', '1', '857732', '0', '56,52,55', '', 0x4e3b, '1', 0, '1', '', '0', 1522080019, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img42_63520s.jpg', '/UserFiles/Image/Trial/img42_63520.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '125,124', 4, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(43, 12, '���� ��� ��������', '<p class="pp">������ ������: ������</p>\r\n<p class="pp">������ �������������: �����</p>', '<p class="pp">��� ��������: �������</p>\r\n<p class="pp">��� ������ � ��������� (�): 100 �</p>\r\n<p class="pp">������ ��������: 4.5 ��</p>\r\n<p class="pp">������ ��������: 17 ��</p>\r\n<p class="pp">������ ������: ������</p>\r\n<p class="pp">������ �������������: �����</p>', 1200, 1500, '0', '1', '1', '9900007', '0', '38,35,34', '', 0x4e3b, '1', 0, '1', '', '0', 1522080010, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img43_25431s.jpg', '/UserFiles/Image/Trial/img43_25431.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '123,122', 5, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL);
INSERT INTO `phpshop_products` (`id`, `category`, `name`, `description`, `content`, `price`, `price_n`, `sklad`, `p_enabled`, `enabled`, `uid`, `spec`, `odnotip`, `vendor`, `vendor_array`, `yml`, `num`, `newtip`, `title`, `title_enabled`, `datas`, `page`, `user`, `descrip`, `descrip_enabled`, `title_shablon`, `descrip_shablon`, `keywords`, `keywords_enabled`, `keywords_shablon`, `pic_small`, `pic_big`, `yml_bid_array`, `parent_enabled`, `parent`, `items`, `weight`, `price2`, `price3`, `price4`, `price5`, `files`, `baseinputvaluta`, `ed_izm`, `dop_cat`, `rate`, `rate_count`, `prod_seo_name`, `price_search`, `parent2`, `color`) VALUES
(44, 10, '������� Dynamic Whey', '<p class="pp">����� �������: �������</p>\r\n<p class="pp">��� ��������: ������������</p>\r\n<p class="pp">������� �������� ��������: 4.3 �/100�</p>\r\n<p class="pp">������� �������� �����: 75 �/100�</p>\r\n<p class="pp">������� �������� ����: 5.7 �/100�</p>', '<p class="pp">����� �������: �������</p>\r\n<p class="pp">��� ��������: ������������</p>\r\n<p class="pp">������� �������� ��������: 4.3 �/100�</p>\r\n<p class="pp">������� �������� �����: 75 �/100�</p>\r\n<p class="pp">������� �������� ����: 5.7 �/100�</p>', 2500, 0, '0', '1', '1', '', '0', '56,53,52', '', 0x4e3b, '1', 0, '1', '', '0', 1522080143, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img44_66993s.jpg', '/UserFiles/Image/Trial/img44_66993.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 12, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, '', 0, NULL, NULL),
(45, 10, 'Sportein Enriched PROTEIN', '<p class="pp">��� ��������: ������������</p>\r\n', '<p class="pp">��� ��������: ������������</p>\r\n<p class="pp">������� �������� ��������: 15 �/100�</p>\r\n<p class="pp">������� �������� �����: 73.3 �/100�</p>\r\n<p class="pp">������� �������� ����: 0.4 �/100�</p>', 4500, 0, '0', '1', '1', '97878686', '0', '56,53,52', '', 0x4e3b, '1', 0, '1', '', '0', 1522080135, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img45_70583s.jpg', '/UserFiles/Image/Trial/img45_70583.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 6, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, '', 0, NULL, NULL),
(46, 10, '������� Whey Protein, �������', '<p>������: �����������,���������� ��������,������������ ���������� ������������,���������� �������������.</p>', '<p>������: �����������,���������� ��������,������������ ���������� ������������,���������� �������������.</p>', 5600, 0, '0', '1', '1', '087087', '0', '56,53,52', '', 0x4e3b, '1', 0, '1', '', '0', 1522080165, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img46_42405s.jpg', '/UserFiles/Image/Trial/img46_42405.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 1, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(47, 10, 'Enriched PROTEIN', '<p class="pp">��� ��������: ������������</p>\r\n', '<p class="pp">��� ��������: ������������</p>\r\n<p class="pp">������� �������� ��������: 15 �/100�</p>\r\n<p class="pp">������� �������� �����: 73.3 �/100�</p>\r\n<p class="pp">������� �������� ����: 0.4 �/100�</p>', 4500, 0, '0', '1', '1', '97878686', '0', '56,53,52', '', 0x4e3b, '1', 0, '1', '', '0', 1522080118, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img47_27834s.jpg', '/UserFiles/Image/Trial/img47_27834.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 6, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(48, 10, 'Enriched PROTEIN', '<p class="pp">��� ��������: ������������</p>\r\n', '<p class="pp">��� ��������: ������������</p>\r\n<p class="pp">������� �������� ��������: 15 �/100�</p>\r\n<p class="pp">������� �������� �����: 73.3 �/100�</p>\r\n<p class="pp">������� �������� ����: 0.4 �/100�</p>', 4500, 0, '0', '1', '1', '97878686', '0', '56,53,52', '', 0x4e3b, '1', 0, '1', '', '0', 1522080128, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img45_47678s.jpg', '/UserFiles/Image/Trial/img45_47678.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 6, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(49, 10, '������� Whey Protein', '<p>������: �����������,���������� ��������,������������ ���������� ������������,���������� �������������.</p>', '<p>������: �����������,���������� ��������,������������ ���������� ������������,���������� �������������.</p>', 5600, 0, '0', '1', '1', '087087', '0', '56,53,52', '', 0x4e3b, '1', 0, '1', '', '0', 1522080156, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img49_10863s.jpg', '/UserFiles/Image/Trial/img49_10863.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 1, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(50, 12, '����� ��� ��������', '<p class="pp">������ ������: ������</p>\r\n<p class="pp">������ �������������: �����</p>', '<p class="pp">��� ��������: �������</p>\r\n<p class="pp">��� ������ � ��������� (�): 100 �</p>\r\n<p class="pp">������ ��������: 4.5 ��</p>\r\n<p class="pp">������ ��������: 17 ��</p>\r\n<p class="pp">������ ������: ������</p>\r\n<p class="pp">������ �������������: �����</p>', 1200, 1500, '0', '1', '1', '9900007', '0', '41,50,43', '', 0x4e3b, '1', 0, '1', '', '0', 1522080000, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img50_42880s.jpg', '/UserFiles/Image/Trial/img50_42880.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '121,120', 5, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, '', 0, NULL, NULL),
(51, 11, '��������� ������� CROCS', '<p class="pp color colorpicker-element">����: <span class="color j-color-name colorpicker-element">�����</span></p>\r\n<p class="pp composition">������: ������������� ���� 100%</p>', '<p class="pp color colorpicker-element">����: <span class="color j-color-name colorpicker-element">�����</span></p>\r\n<p class="pp composition">������: ������������� ���� 100%</p>', 3400, 0, '0', '1', '1', '08708707', '0', '41,50,43', 'i6-12i', 0x613a313a7b693a363b613a313a7b693a303b733a323a223132223b7d7d, '1', 0, '1', '', '0', 1522080100, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img51_77278s.jpg', '/UserFiles/Image/Trial/img51_77278.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '133,132', 17, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(52, 11, '��������� ASICS', '<p class="pp color colorpicker-element">����: <span class="color j-color-name colorpicker-element">������, �������, �����</span></p>\r\n<p class="pp composition">������: ��������,������������� ��������</p>', '<p class="pp color colorpicker-element">����: <span class="color j-color-name colorpicker-element">������, �������, �����</span></p>\r\n<p class="pp composition">������: ��������,������������� ��������</p>', 5100, 0, '0', '1', '1', '7777443', '0', '41,50,43', 'i6-11i', 0x613a313a7b693a363b613a313a7b693a303b733a323a223131223b7d7d, '1', 0, '1', '', '0', 1522080078, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img52_39446s.jpg', '/UserFiles/Image/Trial/img52_39446.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '131', 23, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, '', 0, NULL, NULL),
(53, 11, '��������� 574 Classic', '<p>������: ����������� ���� 75%,������ 19%,���������� 6%</p>', '<p>������: ����������� ���� 75%,������ 19%,���������� 6%</p>', 5700, 0, '0', '1', '1', '354456', '0', '45,44,46', 'i6-11i', 0x613a313a7b693a363b613a313a7b693a303b733a323a223131223b7d7d, '1', 0, '1', '', '0', 1522080047, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img53_12129s.jpg', '/UserFiles/Image/Trial/img53_12129.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '129,128', 12, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, '', 0, NULL, NULL),
(54, 11, '��������� Finn-flare', '<p>������: ����������� �����,��������,������</p>', '<p>������: ����������� �����,��������,������</p>', 6700, 0, '0', '1', '1', '89769876', '0', '41,50,43', 'i6-13i', 0x613a313a7b693a363b613a313a7b693a303b733a323a223133223b7d7d, '1', 0, '1', '', '0', 1522080085, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img54_56298s.jpg', '/UserFiles/Image/Trial/img54_56298.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '136,135,134', 5, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(55, 11, '��������� Mango', '<p>������: ������������� �������� 60%,����������� ����� 40%</p>', '<p>������: ������������� �������� 60%,����������� ����� 40%</p>', 11000, 0, '0', '1', '1', '0987098', '0', '41,50,43', 'i6-14i', 0x613a313a7b693a363b613a313a7b693a303b733a323a223134223b7d7d, '1', 0, '1', '', '0', 1522080093, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img55_13369s.jpg', '/UserFiles/Image/Trial/img55_13369.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '139,138,137', 12, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(56, 11, '��������� 574', '<p>������: ����������� ���� 75%,������ 19%,���������� 6%</p>', '<p>������: ����������� ���� 75%,������ 19%,���������� 6%</p>', 14000, 0, '0', '1', '1', '23452456', '0', '41,50,43', 'i6-11i', 0x613a313a7b693a363b613a313a7b693a303b733a323a223131223b7d7d, '1', 0, '1', '', '0', 1522080069, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img56_67285s.jpg', '/UserFiles/Image/Trial/img56_67285.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '130', 0, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(57, 5, '������� ����', '<p class="pp composition">������: ��������� 100%</p>', '<p>������: ��������� 100%</p>', 90000, 0, '0', '1', '1', '', '0', '58,57,59', 'i15-36ii15-38ii14-35ii14-33ii14-34i', 0x613a323a7b693a31353b613a323a7b693a303b733a323a223336223b693a313b733a323a223338223b7d693a31343b613a333a7b693a303b733a323a223335223b693a313b733a323a223333223b693a323b733a323a223334223b7d7d, '1', 0, '1', '', '0', 1522080209, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img57_34525s.jpg', '/UserFiles/Image/Trial/img57_34525.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 3, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, '', 0, NULL, NULL),
(58, 5, '������', '<p>������: ��������� 100%</p>', '<p>������: ��������� 100%</p>', 67000, 0, '0', '1', '1', '09870987', '0', '56,57,58', 'i15-36ii14-35ii14-33i', 0x613a323a7b693a31353b613a313a7b693a303b733a323a223336223b7d693a31343b613a323a7b693a303b733a323a223335223b693a313b733a323a223333223b7d7d, '1', 0, '1', '', '0', 1522080223, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img58_79133s.jpg', '/UserFiles/Image/Trial/img58_79133.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 12, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, '', 0, NULL, NULL),
(59, 5, '�����', '<p>������: ��������� 100%</p>', '<p>������: ��������� 100%</p>', 2300, 0, '0', '1', '1', '9787765', '0', '57,58,59', 'i15-36ii15-38ii15-37i', 0x613a313a7b693a31353b613a333a7b693a303b733a323a223336223b693a313b733a323a223338223b693a323b733a323a223337223b7d7d, '1', 0, '1', '', '0', 1522080216, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img59_61956s.jpg', '/UserFiles/Image/Trial/img59_61956.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 0, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, '', 0, NULL, NULL),
(60, 5, '����', '<p>������: ��������� 100%</p>', '<p>������: ��������� 100%</p>', 9000, 0, '0', '1', '1', '09898798', '0', '57,58,59', 'i15-38ii14-33i', 0x613a323a7b693a31353b613a313a7b693a303b733a323a223338223b7d693a31343b613a313a7b693a303b733a323a223333223b7d7d, '1', 0, '1', '', '0', 1522080231, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img60_27601s.jpg', '/UserFiles/Image/Trial/img60_27601.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 5, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 5, 1, '', 0, NULL, NULL),
(61, 5, '����', '<p>������: ��������� 100%</p>', '<div class="product-info-box">\n<div class="content panel-smart">\n<p>������: ��������� 100%</p>\n</div>\n</div>\n<div class="product-info-box empty-check">�</div>', 24000, 0, '0', '1', '1', '0980987', '0', '57,58,59', 'i15-38ii15-38ii14-33ii14-33i', 0x613a323a7b693a31353b613a323a7b693a303b733a323a223338223b693a313b733a323a223338223b7d693a31343b613a323a7b693a303b733a323a223333223b693a313b733a323a223333223b7d7d, '1', 0, '1', '', '0', 1523371703, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img61_26143s.jpg', '/UserFiles/Image/Trial/img61_26143.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 13, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 4, 1, 'stul', 0, NULL, NULL),
(62, 5, '����', '<p>������: ��������� 100%</p>', '<p>������: ��������� 100%</p>', 7000, 0, '0', '1', '1', '9080987', '0', '57,58,59', 'i15-36ii14-35i', 0x613a323a7b693a31353b613a313a7b693a303b733a323a223336223b7d693a31343b613a313a7b693a303b733a323a223335223b7d7d, '1', 0, '1', '', '0', 1522080248, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img62_12965s.jpg', '/UserFiles/Image/Trial/img62_12965.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 14, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, '', 0, NULL, NULL),
(63, 1, '����� 42 �����', NULL, NULL, 7800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522073663, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'S', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(64, 1, '����� 44 ������', NULL, NULL, 7900, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522073661, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'L', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '������', '#000000'),
(65, 1, '����� 46 �����', NULL, NULL, 7900, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522073659, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'M', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(66, 1, '����� 48 �����', NULL, NULL, 7900, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522073658, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'L', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(67, 1, '���������� 42 �������', NULL, NULL, 11000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522073635, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'M', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�������', '#FF0000'),
(68, 1, '���������� 44 �������', NULL, NULL, 11000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522073632, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'S', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�������', '#FF0000'),
(69, 1, '���������� 42 �����', NULL, NULL, 11000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522073629, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'M', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(70, 1, '����� �� ������� ����������� ��������� S �������', NULL, NULL, 5600, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522073679, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'S', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�������', '#FF0000'),
(71, 1, '����� �� ������� ����������� ��������� S �����', NULL, NULL, 5600, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522073685, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'S', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(72, 1, '����� �� ������� ����������� ��������� M ', NULL, NULL, 5600, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522073696, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'M', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(73, 1, '����� �� ������� ����������� ��������� L ����������', NULL, NULL, 5600, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522073704, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'L', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '����������', '#A0522D'),
(74, 1, '������ �� ������� ��������� XS �������', NULL, NULL, 9900, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522073743, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'XS', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�������', '#C0C0C0'),
(75, 1, '������ �� ������� ��������� S �����', NULL, NULL, 9900, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522073749, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'S', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(76, 1, '������ �� ������� ��������� M �����', NULL, NULL, 9900, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522073755, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'M', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(77, 1, '������ �� ������� ��������� M ������', NULL, NULL, 9900, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522073760, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'M', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '������', '#000000'),
(78, 1, '������ ������ XS �����', NULL, NULL, 4500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522077728, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'XS', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(79, 1, '������ ������ S �����', NULL, NULL, 4500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522077735, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'S', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(80, 1, '������ ������ M �����', NULL, NULL, 4500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522077742, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'M', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(81, 1, '������ ������ L ������', NULL, NULL, 4500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522077748, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'L', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '������', '#000000'),
(82, 1, '����� ����� S ����������', NULL, NULL, 800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522077762, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'S', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '����������', '#A0522D'),
(83, 1, '����� ����� M �����', NULL, NULL, 800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522077767, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'M', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#808080'),
(84, 1, '����� ����� L �����', NULL, NULL, 800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522077774, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'L', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#808080'),
(85, 1, '������ Mango S �������', NULL, NULL, 3400, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522077787, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'S', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�������', '#C0C0C0'),
(86, 1, '������ Mango S ������', NULL, NULL, 3400, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522077792, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'S', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '������', '#FFFF00'),
(87, 1, '������ Mango M �������', NULL, NULL, 3400, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522077801, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'M', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�������', '#C0C0C0'),
(88, 1, '������ Mango L �����', NULL, NULL, 3400, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522077808, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'L', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#0000FF'),
(89, 1, '������ �� �������� ��������� S �����', NULL, NULL, 5000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522077819, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'S', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(90, 1, '������ �� �������� ��������� S �������', NULL, NULL, 5000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522077826, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'S', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�������', '#FF0000'),
(91, 1, '������ �� �������� ���������  ����������', NULL, NULL, 5000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522077835, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '����������', '#A0522D'),
(92, 4, '����  �����', NULL, NULL, 15000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078336, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(93, 4, '����  �����', NULL, NULL, 15000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078340, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#0000FF'),
(94, 4, '��������� ���������� 37 �����', NULL, NULL, 13000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078369, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(95, 4, '��������� ���������� 42 ������', NULL, NULL, 13000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078376, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '42', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '������', '#FFFF00'),
(96, 4, '����� ������� �������  �������', NULL, NULL, 15500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078398, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�������', '#C0C0C0'),
(97, 4, '����� ������� �������  ���������', NULL, NULL, 15500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078402, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '���������', '#FFA500'),
(98, 4, '��������� ���������� Boss 38 �����', NULL, NULL, 16000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078425, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(99, 4, '��������� ���������� Boss 39 �������', NULL, NULL, 16000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078432, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '39', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�������', '#008000'),
(100, 4, '������  ������', NULL, NULL, 6000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078444, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '������', '#000000'),
(101, 4, '������  �����', NULL, NULL, 6000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078447, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#808080'),
(102, 4, '������� ������� 38 ������', NULL, NULL, 12000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078463, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '������', '#000000'),
(103, 4, '������� ������� 38 �����', NULL, NULL, 12000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078469, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(104, 4, '������� ������� 42 �����', NULL, NULL, 12000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078474, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '42', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(105, 6, ' Vivo V5 �������� �������', NULL, NULL, 35000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078518, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '��������', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�������', '#C0C0C0'),
(106, 6, ' Vivo V5 ������� ������', NULL, NULL, 35000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078526, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '�������', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '������', '#000000'),
(107, 6, ' Lenovo IdeaPad 110 ����� ', NULL, NULL, 64000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078554, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '�����', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(108, 6, ' Lenovo IdeaPad 110 ������� ', NULL, NULL, 64000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078558, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '�������', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(109, 6, 'Samsung ������� ', NULL, NULL, 60000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078570, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '�������', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(110, 6, 'Samsung ������� ', NULL, NULL, 60000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078573, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '�������', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(111, 6, 'Samsung Gear VR ����� ', NULL, NULL, 67000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078587, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '�����', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(112, 6, 'Samsung Gear VR ������ ', NULL, NULL, 67000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078592, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '������', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(113, 6, 'HP ProBook 450 ����� ', NULL, NULL, 125000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078606, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '�����', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(114, 6, 'HP ProBook 450 ���������� ', NULL, NULL, 125000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078611, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '����������', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(115, 6, '������� Apple ����� ', NULL, NULL, 46000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078618, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '�����', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(116, 12, '������� ������� 1200 �� ', NULL, NULL, 45000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078680, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '1200 ��', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(118, 12, '������ �� ������  ������', NULL, NULL, 600, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078694, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '������', '#000000'),
(117, 12, '������� ������� 1400 �� ', NULL, NULL, 45000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078684, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '1400 ��', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(120, 12, '����� ��� ��������  ����������', NULL, NULL, 1200, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078721, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '����������', '#C0C0C0'),
(119, 12, '������ �� ������  �����', NULL, NULL, 600, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078697, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(121, 12, '����� ��� ��������  �������', NULL, NULL, 1200, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078727, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�������', '#FF0000'),
(122, 12, '���� ��� ��������  �������', NULL, NULL, 1200, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078752, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�������', '#008000'),
(124, 12, '����� ���������� 3 � ', NULL, NULL, 3500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078777, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '3 �', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(123, 12, '���� ��� ��������  �������', NULL, NULL, 1200, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078757, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�������', '#00FFFF'),
(126, 12, '����  ������', NULL, NULL, 5000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078789, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '������', '#000000'),
(125, 12, '����� ���������� 4 �  ', NULL, NULL, 3500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078781, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '4 � ', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(127, 12, '����  �����', NULL, NULL, 5000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078792, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(128, 11, '��������� 574 Classic 42 �����', NULL, NULL, 5700, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078840, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '42', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#ffffff'),
(129, 11, '��������� 574 Classic 44 �����', NULL, NULL, 5700, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078845, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '44', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#0000FF'),
(130, 11, '��������� 574 Classic 44 �����', NULL, NULL, 14000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078887, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '44', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#808080'),
(131, 11, '��������� ASICS 44 �����', NULL, NULL, 5100, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078904, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '44', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#0000FF'),
(132, 11, '��������� ������� CROCS 38 �������', NULL, NULL, 3400, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078946, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�������', '#008000'),
(133, 11, '��������� ������� CROCS 41 �����', NULL, NULL, 3400, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522078952, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '41', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '�����', '#0000FF'),
(134, 11, '��������� Finn-flare 40 ������', NULL, NULL, 6700, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522079006, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '40', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '������', '#000000'),
(135, 11, '��������� Finn-flare 42 ', NULL, NULL, 6700, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522079012, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '42', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(136, 11, '��������� Finn-flare 44 ', NULL, NULL, 6700, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522079015, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '44', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(137, 11, '��������� Mango 38 ', NULL, NULL, 11000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522079049, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(138, 11, '��������� Mango 39 ', NULL, NULL, 11000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522079052, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '39', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL),
(139, 11, '��������� Mango 41 ', NULL, NULL, 11000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1522079055, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '41', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, '', 0, '', NULL);

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_rating_categories`
--

CREATE TABLE `phpshop_rating_categories` (
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

CREATE TABLE `phpshop_rating_charact` (
  `id_charact` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
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

CREATE TABLE `phpshop_rating_votes` (
  `id_vote` int(11) NOT NULL AUTO_INCREMENT,
  `id_charact` int(11) DEFAULT '0',
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

CREATE TABLE `phpshop_rssgraber` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `link` text,
  `day_num` int(1) DEFAULT '1',
  `news_num` mediumint(8) DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '1',
  `start_date` int(16) unsigned DEFAULT '0',
  `end_date` int(16) unsigned DEFAULT '0',
  `last_load` int(16) unsigned DEFAULT '0',
  `servers` varchar(64) default '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_rssgraber`
--

INSERT INTO `phpshop_rssgraber` (`id`, `link`, `day_num`, `news_num`, `enabled`, `start_date`, `end_date`, `last_load`) VALUES
(1, 'http://www.phpshop.ru/rss/', 1, 10, '1', 1307995200, 1606766400, 1523394000);

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_rssgraber_jurnal`
--

CREATE TABLE `phpshop_rssgraber_jurnal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` int(15) unsigned DEFAULT '0',
  `link_id` int(11) DEFAULT '0',
  `status` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;


-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_search_base`
--

CREATE TABLE `phpshop_search_base` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `uid` varchar(255) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '1',
  `category` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_search_jurnal`
--

CREATE TABLE `phpshop_search_jurnal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `num` tinyint(32) DEFAULT '0',
  `datas` varchar(11) DEFAULT '',
  `dir` varchar(255) DEFAULT '',
  `cat` tinyint(11) DEFAULT '0',
  `set` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;


-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_servers`
--

CREATE TABLE `phpshop_servers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `host` varchar(255) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '0',
  `code` varchar(64) DEFAULT '',
  `skin` varchar(64) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `descrip` varchar(255) DEFAULT '',
  `tel` varchar(255) DEFAULT '',
  `company` varchar(255) DEFAULT '',
  `adres` varchar(255) DEFAULT '',
  `logo` varchar(255) DEFAULT '',
  `adminmail` varchar(255) DEFAULT '',
  `currency` int(11),
  `lang` varchar(32),
  `admoption` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_shopusers`
--

CREATE TABLE `phpshop_shopusers` (
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
  `cumulative_discount` int(11) DEFAULT '0',
  `sendmail` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_shopusers`
--

INSERT INTO `phpshop_shopusers` (`id`, `login`, `password`, `datas`, `mail`, `name`, `company`, `inn`, `tel`, `adres`, `enabled`, `status`, `kpp`, `tel_code`, `wishlist`, `data_adres`, `cumulative_discount`, `sendmail`) VALUES
(17, 'test3@mail.ru', 'MTIzNDU2', '1523026100', 'pozhitok2004@mail.ru', '���������', '', '', '(888) 999-8888', '', '1', '0', '', '', 0x613a303a7b7d, 0x613a323a7b733a343a226d61696e223b693a303b733a343a226c697374223b613a313a7b693a303b613a32333a7b733a373a2266696f5f6e6577223b733a393a22c5eae0f2e5f0e8ede0223b733a373a2274656c5f6e6577223b733a383a222d30382d30383937223b733a31313a22636f756e7472795f6e6577223b733a303a22223b733a393a2273746174655f6e6577223b733a303a22223b733a383a22636974795f6e6577223b733a303a22223b733a393a22696e6465785f6e6577223b733a303a22223b733a31303a227374726565745f6e6577223b733a303a22223b733a393a22686f7573655f6e6577223b733a303a22223b733a393a22706f7263685f6e6577223b733a303a22223b733a31343a22646f6f725f70686f6e655f6e6577223b733a303a22223b733a383a22666c61745f6e6577223b733a303a22223b733a31333a2264656c697674696d655f6e6577223b733a373a222d303938303938223b733a373a2264656661756c74223b733a313a2231223b733a31323a226f72675f6e616d655f6e6577223b733a303a22223b733a31313a226f72675f696e6e5f6e6577223b733a303a22223b733a31313a226f72675f6b70705f6e6577223b733a303a22223b733a31373a226f72675f7975725f61647265735f6e6577223b733a303a22223b733a31383a226f72675f66616b745f61647265735f6e6577223b733a303a22223b733a31313a226f72675f7261735f6e6577223b733a303a22223b733a31323a226f72675f62616e6b5f6e6577223b733a303a22223b733a31313a226f72675f6b6f725f6e6577223b733a303a22223b733a31313a226f72675f62696b5f6e6577223b733a303a22223b733a31323a226f72675f636974795f6e6577223b733a303a22223b7d7d7d, 0, '1'),
(18, 'test@mail.ru', 'cG5kMTFrN3Q=', '1523370976', 'test@mail.ru', '����', '', '', '(111) 224-1241', '', '1', '0', '', '', 0x613a303a7b7d, 0x613a323a7b733a343a226c697374223b613a313a7b693a303b613a333a7b733a373a2266696f5f6e6577223b733a343a22deebe8ff223b733a373a2274656c5f6e6577223b733a31343a222831313129203232342d31323431223b733a31333a2264656c697674696d655f6e6577223b733a393a22f120313020f3f2f0e0223b7d7d733a343a226d61696e223b693a303b7d, 0, '1'),
(19, 'test2@gmail.com', 'bnl2MXJkYzg=', '1523371028', 'test2@gmail.com', '������', '', '', '(888) 888-8888', '', '1', '0', '', '', 0x613a303a7b7d, 0x613a323a7b733a343a226c697374223b613a313a7b693a303b613a333a7b733a373a2266696f5f6e6577223b733a363a22d0f3f1ebe0ed223b733a373a2274656c5f6e6577223b733a31343a222838383829203838382d38383838223b733a31333a2264656c697674696d655f6e6577223b733a31313a22f120313720e2e5f7e5f0e0223b7d7d733a343a226d61696e223b693a303b7d, 0, '1');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_shopusers_status`
--

CREATE TABLE `phpshop_shopusers_status` (
  `id` tinyint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `discount` float DEFAULT '0',
  `price` enum('1','2','3','4','5') DEFAULT '1',
  `enabled` enum('0','1') DEFAULT '1',
  `cumulative_discount_check` enum('0','1') DEFAULT '0',
  `cumulative_discount` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_shopusers_status`
--

INSERT INTO `phpshop_shopusers_status` (`id`, `name`, `discount`, `price`, `enabled`, `cumulative_discount_check`, `cumulative_discount`) VALUES
(1, '�������', 5, '2', '1', '0', NULL);

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_slider`
--

CREATE TABLE `phpshop_slider` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '0',
  `num` smallint(6) DEFAULT '0',
  `link` varchar(255) DEFAULT '',
  `alt` varchar(255) DEFAULT '',
  `servers` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_slider`
--

INSERT INTO `phpshop_slider` (`id`, `image`, `enabled`, `num`, `link`, `alt`, `servers`) VALUES
(12, '/UserFiles/Image/Trial/slider/slider-3.jpg', '1', 0, '', '', ''),
(9, '/UserFiles/Image/Trial/slider/slider-4.jpg', '1', 2, '', '', ''),
(14, '/UserFiles/Image/Trial/slider/slider-2.jpg', '1', 4, '', '', ''),
(13, '/UserFiles/Image/Trial/slider/slider-1.jpg', '1', 0, '', '', '');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_sort`
--

CREATE TABLE `phpshop_sort` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `category` int(11) unsigned DEFAULT '0',
  `num` int(11) DEFAULT '0',
  `page` varchar(255) DEFAULT '',
  `icon` varchar(255) DEFAULT '',
  `sort_seo_name` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_sort`
--

INSERT INTO `phpshop_sort` (`id`, `name`, `category`, `num`, `page`, `icon`, `sort_seo_name`) VALUES
(1, 'Loreal', 1, 1, 'stranica_opisaniya_brenda', '/UserFiles/Image/Trial/brand/loreal-paris.png', 'loreal'),
(2, 'Max-Factor', 1, 2, 'stranica_opisaniya_brenda', '/UserFiles/Image/Trial/brand/max-factor.png', 'max-factor'),
(3, 'Maybelline', 1, 3, 'stranica_opisaniya_brenda', '/UserFiles/Image/Trial/brand/maybelline-new-york.png', 'maybelline'),
(4, 'Schwarzkopf', 0, 4, 'stranica_opisaniya_brenda', '/UserFiles/Image/Trial/brand/schwarzkopf-professional.png', '-99'),
(5, 'Vichy', 0, 0, 'stranica_opisaniya_brenda', '/UserFiles/Image/Trial/brand/vichy.png', '-99'),
(6, 'Schwarzkopf', 1, 4, 'stranica_opisaniya_brenda', '/UserFiles/Image/Trial/brand/schwarzkopf-professional.png', 'schwarzkopf'),
(7, 'Vichy', 1, 5, 'stranica_opisaniya_brenda', '/UserFiles/Image/Trial/brand/vichy.png', 'vichy'),
(8, '���������', 3, 1, '', '', ''),
(9, '�����', 3, 2, '', '', ''),
(10, '����������', 3, 3, '', '', ''),
(11, 'Asics', 6, 1, 'stranica_opisaniya_brenda', '/UserFiles/Image/Trial/brand/asics.png', 'asics'),
(12, 'Crocs', 6, 2, 'stranica_opisaniya_brenda', '/UserFiles/Image/Trial/brand/crocs.png', 'crocs'),
(13, 'Finn-flare', 6, 0, 'stranica_opisaniya_brenda', '/UserFiles/Image/Trial/brand/finn-flare.png', 'finn-flare'),
(14, 'Mango', 6, 0, 'stranica_opisaniya_brenda', '/UserFiles/Image/Trial/brand/mango.png', 'mango'),
(15, '40', 7, 1, '', '', ''),
(16, '42', 7, 2, '', '', ''),
(17, '44', 7, 3, '', '', ''),
(18, '46', 7, 4, '', '', ''),
(19, '48', 7, 5, '', '', ''),
(20, '50', 7, 6, '', '', ''),
(21, '52', 7, 7, '', '', ''),
(22, '�����', 8, 1, '', '', ''),
(23, '������', 8, 2, '', '', ''),
(24, '�������', 8, 3, '', '', ''),
(25, '�����', 8, 4, '', '', ''),
(26, '�������', 8, 5, '', '', ''),
(27, '64 ��', 12, 1, '', '', ''),
(28, '128 ��', 12, 2, '', '', ''),
(29, '264 ��', 12, 3, '', '', ''),
(30, '�����', 13, 1, '', '', ''),
(31, '��������', 13, 2, '', '', ''),
(32, '�����', 13, 3, '', '', ''),
(33, '2000*1500', 14, 1, '', '', ''),
(34, '2500*1850', 14, 2, '', '', ''),
(35, '1500*300', 14, 3, '', '', ''),
(36, '�����', 15, 1, '', '', ''),
(37, '����', 15, 2, '', '', ''),
(38, '������', 15, 3, '', '', '');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_sort_categories`
--

CREATE TABLE `phpshop_sort_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `num` int(11) DEFAULT '0',
  `category` int(11) DEFAULT '0',
  `filtr` enum('0','1') DEFAULT '0',
  `description` varchar(255) DEFAULT '',
  `goodoption` enum('0','1') DEFAULT '0',
  `optionname` enum('0','1') DEFAULT '0',
  `page` varchar(255) DEFAULT '',
  `brand` enum('0','1') DEFAULT '0',
  `product` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- ���� ������ ������� `phpshop_sort_categories`
--

INSERT INTO `phpshop_sort_categories` (`id`, `name`, `num`, `category`, `filtr`, `description`, `goodoption`, `optionname`, `page`, `brand`, `product`) VALUES
(1, '������������� �����', 1, 2, '1', '', '0', '0', '', '1', '0'),
(2, '���������', 0, 0, '0', '', '0', '0', '', '0', '0'),
(3, '��� ����', 2, 2, '1', '', '1', '0', '', '0', '0'),
(4, '������, �����', 2, 0, '0', '', '0', '0', '', '0', '0'),
(6, '�������� �����', 1, 4, '1', '', '0', '0', '', '1', '0'),
(7, '������', 2, 4, '1', '', '1', '0', '', '0', '0'),
(8, '����', 3, 4, '1', '', '1', '0', '', '0', '0'),
(9, '������', 0, 0, '0', '', '0', '0', '', '0', '0'),
(11, 'High-tech', 0, 0, '0', '', '0', '0', '', '0', '0'),
(12, '���������� ������', 1, 11, '1', '', '1', '0', '', '0', '0'),
(13, '���� �������', 0, 11, '1', '', '1', '0', '', '0', '0'),
(14, '��������', 1, 9, '1', '', '1', '0', '', '0', '0'),
(15, '����', 0, 9, '1', '', '1', '0', '', '0', '0');

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_system`
--

CREATE TABLE `phpshop_system` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` text,
  `company` text,
  `num_row` int(10) DEFAULT NULL,
  `num_row_adm` int(10) DEFAULT NULL,
  `dengi` tinyint(11) DEFAULT NULL,
  `percent` varchar(16) DEFAULT '',
  `skin` varchar(32) DEFAULT NULL,
  `adminmail2` varchar(64) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `keywords` varchar(255) DEFAULT '',
  `kurs` float DEFAULT '0',
  `spec_num` tinyint(5) DEFAULT '0',
  `new_num` tinyint(11) DEFAULT '0',
  `tel` text,
  `bank` blob,
  `num_vitrina` enum('1','2','3','4') DEFAULT '3',
  `icon` varchar(255) default '',
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

INSERT INTO `phpshop_system` (`id`, `name`, `company`, `num_row`, `num_row_adm`, `dengi`, `percent`, `skin`, `adminmail2`, `title`, `keywords`, `kurs`, `spec_num`, `new_num`, `tel`, `bank`, `num_vitrina`, `icon`, `updateU`, `nds`, `nds_enabled`, `admoption`, `kurs_beznal`, `descrip`, `descrip_shablon`, `title_shablon`, `keywords_shablon`, `title_shablon2`, `descrip_shablon2`, `keywords_shablon2`, `logo`, `promotext`, `title_shablon3`, `descrip_shablon3`, `keywords_shablon3`, `rss_use`, `1c_load_accounts`, `1c_load_invoice`, `1c_option`) VALUES
(1, '�������� ��������-��������', '��������', 9, 0, 6, '0', 'hub', 'admin@localhost', '����-������ ������� ��������-�������� PHPShop', '������ ��������, ������ ��������-�������', 6, 8, 8, '(495)111-22-33', 0x613a31323a7b733a383a226f72675f6e616d65223b733a31343a22cecece2022cff0eee4e0e2e5f622223b733a31323a226f72675f75725f6164726573223b733a34313a2230303030303020e32e20cceef1eae2e02c20f3eb2e20def0e8e4e8f7e5f1eae0ff2c20e4eeec20312e223b733a393a226f72675f6164726573223b733a33303a22cceef1eae2e02c20f3eb2e20d4e8e7e8f7e5f1eae0ff2c20e4eeec20312e223b733a373a226f72675f696e6e223b733a393a22373737373737373737223b733a373a226f72675f6b7070223b733a31303a2238383838383838383838223b733a393a226f72675f7363686574223b733a31363a2231313131313131313131313131313131223b733a383a226f72675f62616e6b223b733a32333a22cec0ce2022c2e0f820f2e5f1f2eee2fbe920e1e0edea22223b733a373a226f72675f626963223b733a383a223436373738383838223b733a31343a226f72675f62616e6b5f7363686574223b733a31353a22323232323232323232323232323232223b733a393a226f72675f7374616d70223b733a33323a222f5573657246696c65732f496d6167652f547269616c2f7374616d702e706e67223b733a373a226f72675f736967223b733a33363a222f5573657246696c65732f496d6167652f547269616c2f66616373696d696c652e706e67223b733a31313a226f72675f7369675f627568223b733a33363a222f5573657246696c65732f496d6167652f547269616c2f66616373696d696c652e706e67223b7d, '3', '', '1409661405', '20', '1', 0x613a37383a7b733a31323a22736b6c61645f737461747573223b733a313a2231223b733a31333a22636c6f75645f656e61626c6564223b693a303b733a32333a226469676974616c5f70726f647563745f656e61626c6564223b693a303b733a31333a22757365725f63616c656e646172223b693a303b733a31393a22757365725f70726963655f6163746976617465223b693a303b733a32323a22757365725f6d61696c5f61637469766174655f707265223b693a303b733a31383a227273735f6772616265725f656e61626c6564223b733a313a2231223b733a31373a22696d6167655f736176655f736f75726365223b733a313a2231223b733a363a22696d675f776d223b4e3b733a353a22696d675f77223b733a333a22333530223b733a353a22696d675f68223b733a333a22333530223b733a363a22696d675f7477223b733a333a22323530223b733a363a22696d675f7468223b733a333a22323530223b733a31343a2277696474685f706f64726f626e6f223b733a333a22313030223b733a31323a2277696474685f6b7261746b6f223b733a333a22313030223b733a31323a22626173655f656e61626c6564223b4e3b733a31313a22736d735f656e61626c6564223b693a303b733a31343a226e6f746963655f656e61626c6564223b693a303b733a373a22626173655f6964223b733a303a22223b733a393a22626173655f686f7374223b733a303a22223b733a31333a22736b6c61645f656e61626c6564223b733a313a2231223b733a31303a2270726963655f7a6e616b223b733a313a2230223b733a31383a22757365725f6d61696c5f6163746976617465223b693a303b733a31313a22757365725f737461747573223b733a313a2230223b733a393a22757365725f736b696e223b733a313a2231223b733a31323a22636172745f6d696e696d756d223b733a303a22223b733a31333a2277617465726d61726b5f626967223b613a32313a7b733a31343a226269675f6d657267654c6576656c223b693a37303b733a31313a226269675f656e61626c6564223b733a313a2231223b733a383a226269675f74797065223b733a333a22706e67223b733a31323a226269675f706e675f66696c65223b733a33303a222f5573657246696c65732f496d6167652f73686f705f6c6f676f2e706e67223b733a31323a226269675f636f7079466c6167223b733a313a2230223b733a363a226269675f736d223b693a303b733a31363a226269675f706f736974696f6e466c6167223b733a313a2234223b733a31333a226269675f706f736974696f6e58223b693a303b733a31333a226269675f706f736974696f6e59223b693a303b733a393a226269675f616c706861223b693a37303b733a383a226269675f74657874223b733a303a22223b733a32313a226269675f746578745f706f736974696f6e466c6167223b693a303b733a383a226269675f73697a65223b693a303b733a393a226269675f616e676c65223b693a303b733a31383a226269675f746578745f706f736974696f6e58223b693a303b733a31383a226269675f746578745f706f736974696f6e59223b693a303b733a31303a226269675f636f6c6f7252223b693a303b733a31303a226269675f636f6c6f7247223b693a303b733a31303a226269675f636f6c6f7242223b693a303b733a31343a226269675f746578745f616c706861223b693a303b733a383a226269675f666f6e74223b733a31363a226e6f726f626f745f666f6e742e747466223b7d733a31353a2277617465726d61726b5f736d616c6c223b613a32313a7b733a31363a22736d616c6c5f6d657267654c6576656c223b693a3130303b733a31333a22736d616c6c5f656e61626c6564223b733a313a2231223b733a31303a22736d616c6c5f74797065223b733a333a22706e67223b733a31343a22736d616c6c5f706e675f66696c65223b733a32353a222f5573657246696c65732f496d6167652f6c6f676f2e706e67223b733a31343a22736d616c6c5f636f7079466c6167223b733a313a2230223b733a383a22736d616c6c5f736d223b693a303b733a31383a22736d616c6c5f706f736974696f6e466c6167223b733a313a2231223b733a31353a22736d616c6c5f706f736974696f6e58223b693a303b733a31353a22736d616c6c5f706f736974696f6e59223b693a303b733a31313a22736d616c6c5f616c706861223b693a35303b733a31303a22736d616c6c5f74657874223b733a303a22223b733a32333a22736d616c6c5f746578745f706f736974696f6e466c6167223b693a303b733a31303a22736d616c6c5f73697a65223b693a303b733a31313a22736d616c6c5f616e676c65223b693a303b733a32303a22736d616c6c5f746578745f706f736974696f6e58223b693a303b733a32303a22736d616c6c5f746578745f706f736974696f6e59223b693a303b733a31323a22736d616c6c5f636f6c6f7252223b693a303b733a31323a22736d616c6c5f636f6c6f7247223b693a303b733a31323a22736d616c6c5f636f6c6f7242223b693a303b733a31363a22736d616c6c5f746578745f616c706861223b693a303b733a31303a22736d616c6c5f666f6e74223b733a31363a226e6f726f626f745f666f6e742e747466223b7d733a31353a2277617465726d61726b5f6973686f64223b613a32313a7b733a31363a226973686f645f6d657267654c6576656c223b693a3130303b733a31333a226973686f645f656e61626c6564223b4e3b733a31303a226973686f645f74797065223b733a333a22706e67223b733a31343a226973686f645f706e675f66696c65223b733a303a22223b733a31343a226973686f645f636f7079466c6167223b733a313a2230223b733a383a226973686f645f736d223b693a303b733a31383a226973686f645f706f736974696f6e466c6167223b733a313a2231223b733a31353a226973686f645f706f736974696f6e58223b693a303b733a31353a226973686f645f706f736974696f6e59223b693a303b733a31313a226973686f645f616c706861223b693a303b733a31303a226973686f645f74657874223b733a303a22223b733a32333a226973686f645f746578745f706f736974696f6e466c6167223b693a303b733a31303a226973686f645f73697a65223b693a303b733a31313a226973686f645f616e676c65223b693a303b733a32303a226973686f645f746578745f706f736974696f6e58223b693a303b733a32303a226973686f645f746578745f706f736974696f6e59223b693a303b733a31323a226973686f645f636f6c6f7252223b693a303b733a31323a226973686f645f636f6c6f7247223b693a303b733a31323a226973686f645f636f6c6f7242223b693a303b733a31363a226973686f645f746578745f616c706861223b693a303b733a31303a226973686f645f666f6e74223b733a31363a226e6f726f626f745f666f6e742e747466223b7d733a31343a226e6f776275795f656e61626c6564223b733a313a2232223b733a363a22656469746f72223b733a373a2274696e796d6365223b733a353a227468656d65223b733a373a2264656661756c74223b733a32343a22736d735f7374617475735f6f726465725f656e61626c6564223b693a303b733a31373a226d61696c5f736d74705f7265706c79746f223b733a303a22223b733a393a22736d735f70686f6e65223b733a303a22223b733a383a22736d735f75736572223b733a303a22223b733a383a22736d735f70617373223b733a303a22223b733a383a22736d735f6e616d65223b733a303a22223b733a393a226163655f7468656d65223b733a343a226461776e223b733a393a2261646d5f7469746c65223b733a303a22223b733a31343a227365617263685f656e61626c6564223b733a313a2233223b733a31343a226d61696c5f736d74705f686f7374223b733a303a22223b733a31343a226d61696c5f736d74705f706f7274223b733a303a22223b733a31343a226d61696c5f736d74705f75736572223b733a303a22223b733a31343a226d61696c5f736d74705f70617373223b733a303a22223b733a32303a22706172656e745f70726963655f656e61626c6564223b693a303b733a31373a226d61696c5f736d74705f656e61626c6564223b693a303b733a31353a226d61696c5f736d74705f6465627567223b693a303b733a31343a226d61696c5f736d74705f61757468223b693a303b733a31323a2272756c655f656e61626c6564223b693a303b733a31353a226361746c6973745f656e61626c6564223b733a313a2231223b733a31373a227265636170746368615f656e61626c6564223b733a313a2231223b733a31343a227265636170746368615f706b6579223b733a303a22223b733a31343a227265636170746368615f736b6579223b733a303a22223b733a31343a226461646174615f656e61626c6564223b733a313a2231223b733a31323a226461646174615f746f6b656e223b733a303a22223b733a32313a226d756c74695f63757272656e63795f736561726368223b693a303b733a31373a22696d6167655f726573756c745f70617468223b733a303a22223b733a31343a2277617465726d61726b5f74657874223b733a303a22223b733a32303a2277617465726d61726b5f746578745f636f6c6f72223b733a373a2223636363636363223b733a31393a2277617465726d61726b5f746578745f73697a65223b733a323a223230223b733a31393a2277617465726d61726b5f746578745f666f6e74223b733a343a2256657261223b733a31353a2277617465726d61726b5f7269676874223b733a313a2230223b733a31363a2277617465726d61726b5f626f74746f6d223b733a313a2230223b733a32303a2277617465726d61726b5f746578745f616c706861223b733a323a223830223b733a31353a2277617465726d61726b5f696d616765223b733a303a22223b733a32313a22696d6167655f61646170746976655f726573697a65223b693a303b733a31353a22696d6167655f736176655f6e616d65223b693a303b733a32313a2277617465726d61726b5f6269675f656e61626c6564223b693a303b733a32343a2277617465726d61726b5f736f757263655f656e61626c6564223b693a303b733a31373a2279616e6465786d61705f656e61626c6564223b733a313a2231223b733a393a226875625f7468656d65223b733a32333a22626f6f7473747261702d7468656d652d64656661756c74223b733a31353a226875625f666c7569645f7468656d65223b733a32333a22626f6f7473747261702d7468656d652d64656661756c74223b733a32343a2277617465726d61726b5f63656e7465725f656e61626c6564223b693a303b733a343a226c616e67223b733a373a227275737369616e223b733a31393a2266696c7465725f63616368655f706572696f64223b733a303a22223b733a32303a2266696c7465725f63616368655f656e61626c6564223b693a303b733a32313a2266696c7465725f70726f64756374735f636f756e74223b693a303b7d, 6, 'PHPShop � ��� ������� ������� ��� �������� �������� ��������-��������.', '@Podcatalog@, @Catalog@, @System@', '@Podcatalog@ - @Catalog@ - @System@', '@Podcatalog@, @Catalog@, @Generator@', '@Product@ - @Podcatalog@ - @Catalog@', '@Product@, @Podcatalog@, @Catalog@', '@Product@,@System@', '/UserFiles/Image/Trial/logotip2018.png', '', '@Catalog@ - @System@', '@Catalog@', '@Catalog@', 0, '0', '0', 0x613a373a7b733a31313a227570646174655f6e616d65223b733a313a2231223b733a31343a227570646174655f636f6e74656e74223b733a313a2231223b733a31383a227570646174655f6465736372697074696f6e223b733a313a2231223b733a31353a227570646174655f63617465676f7279223b733a313a2231223b733a31313a227570646174655f736f7274223b733a313a2231223b733a31323a227570646174655f7072696365223b733a313a2231223b733a31313a227570646174655f6974656d223b733a313a2231223b7d);


-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_templates_key`
--

CREATE TABLE `phpshop_templates_key` (
  `path` varchar(64) NOT NULL DEFAULT '',
  `date` int(11) DEFAULT '0',
  `key` text,
  `verification` varchar(32) DEFAULT '',
  PRIMARY KEY (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_users`
--

CREATE TABLE `phpshop_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` blob,
  `login` varchar(64) DEFAULT '',
  `password` varchar(64) DEFAULT '',
  `mail` varchar(64) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '1',
  `name` varchar(255) DEFAULT '',
  `hash` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;



-- --------------------------------------------------------

--
-- ��������� ������� `phpshop_valuta`
--

CREATE TABLE `phpshop_valuta` (
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
-- ������ ProductLastView
--

CREATE TABLE `phpshop_modules_productlastview_system` (
  `id` int(11) NOT NULL auto_increment,
  `enabled` enum('0','1','2') NOT NULL default '1',
  `flag` enum('1','2') NOT NULL default '1',
  `title` varchar(64) NOT NULL default '',
  `pic_width` tinyint(100) NOT NULL default '0',
  `memory` enum('0','1') NOT NULL default '1',
  `num` tinyint(11) NOT NULL default '0',
  `serial` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;


INSERT INTO `phpshop_modules_productlastview_system` VALUES (1, '2', '1', '������������� ������', 50, '1', 5, '');

CREATE TABLE `phpshop_modules_productlastview_memory` (
  `id` int(11) NOT NULL auto_increment,
  `memory` varchar(64) NOT NULL default '',
  `product` text NOT NULL,
  `date` int(11) NOT NULL default '0',
  `user` int(11) NOT NULL default '0',
  `ip` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;
