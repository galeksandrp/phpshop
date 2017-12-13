
-- 
-- ��������� ������� `phpshop_upload_list`
-- 

CREATE TABLE `phpshop_upload_list` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(200) NOT NULL default '',
  `backup` enum('1','0') NOT NULL default '0',
  `backup_flag` enum('0','1','2','3') NOT NULL default '0',
  `dir` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;



-- 
-- ��������� ������� `phpshop_upload_backup`
-- 

CREATE TABLE `phpshop_upload_backup` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `date` int(16) NOT NULL default '0',
  `folder` varchar(255) NOT NULL default '',
  `backup_use` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- 
-- ��������� ������� `phpshop_bigcsv`
-- 

CREATE TABLE `phpshop_bigcsv` (
  `id` enum('1') NOT NULL default '1',
  `file` text NOT NULL,
  `status` enum('0','1','2') NOT NULL default '0',
  `seek` bigint(12) NOT NULL default '0',
  `num_new` bigint(12) NOT NULL default '0',
  `num_upd` bigint(12) NOT NULL default '0',
  `aoption` blob NOT NULL,
  `num` int(8) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- 
-- ���� ������ ������� `phpshop_bigcsv`
-- 

INSERT INTO `phpshop_bigcsv` VALUES ('1', './csv/sample_bigcsv.csv', '0', 52395, 1000, 0, 0x613a383a7b733a353a226964656e74223b733a313a2231223b733a363a226964656e7430223b733a303a22223b733a363a226964656e7431223b733a373a22636865636b6564223b733a363a2276616c757461223b733a313a2235223b733a363a22736b6c616430223b733a383a2273656c6563746564223b733a363a22736b6c616431223b733a303a22223b733a353a22736b6c6164223b733a313a2230223b733a353a226572726f72223b733a303a22223b7d, 500);
  
-- 
-- ��������� ������� `phpshop_gbook`
-- 

CREATE TABLE `phpshop_gbook` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `datas` int(11) default NULL,
  `name` varchar(32) default NULL,
  `mail` varchar(32) default NULL,
  `tema` text,
  `otsiv` text,
  `otvet` text,
  `flag` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ��������� ������� `phpshop_rssgraber_jurnal`
-- 

CREATE TABLE `phpshop_rssgraber_jurnal` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `date` int(15) unsigned NOT NULL default '0',
  `link_id` int(11) NOT NULL default '0',
  `status` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- 
-- ��������� ������� `phpshop_rssgraber`
-- 

CREATE TABLE `phpshop_rssgraber` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `link` text NOT NULL,
  `day_num` int(1) NOT NULL default '1',
  `news_num` mediumint(8) NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '1',
  `start_date` int(16) unsigned NOT NULL default '0',
  `end_date` int(16) unsigned NOT NULL default '0',
  `last_load` int(16) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- 
-- ���� ������ ������� `phpshop_rssgraber`
-- 

INSERT INTO `phpshop_rssgraber` VALUES (1, 'http://www.phpshop.ru/rss.php', 1, 1, '1', 1225227600, 1330757200, 1225314000);
        


-- 
-- ��������� ������� `phpshop_rating_votes`
-- 

CREATE TABLE `phpshop_rating_votes` (
  `id_vote` int(11) NOT NULL auto_increment,
  `id_charact` int(11) NOT NULL default '0',
  `id_good` int(11) NOT NULL default '0',
  `id_user` int(11) NOT NULL default '0',
  `userip` varchar(16) NOT NULL default '',
  `rate` tinyint(4) NOT NULL default '0',
  `date` int(11) NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id_vote`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- 
-- ��������� ������� `phpshop_rating_charact`
-- 

CREATE TABLE `phpshop_rating_charact` (
  `id_charact` int(11) NOT NULL auto_increment,
  `id_category` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `num` int(11) NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id_charact`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- 
-- ��������� ������� `phpshop_rating_categories`
-- 

CREATE TABLE `phpshop_rating_categories` (
  `id_category` int(11) NOT NULL auto_increment,
  `ids_dir` varchar(255) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  `revoting` enum('0','1') default NULL,
  PRIMARY KEY  (`id_category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ��������� ������� `phpshop_1c_jurnal`
-- 

CREATE TABLE `phpshop_1c_jurnal` (
  `id` int(11) NOT NULL auto_increment,
  `datas` varchar(64) NOT NULL default '0',
  `p_name` varchar(64) NOT NULL default '',
  `f_name` varchar(64) NOT NULL default '',
  `time` float NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;



-- 
-- ��������� ������� `phpshop_1c_docs`
-- 

CREATE TABLE `phpshop_1c_docs` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `cid` varchar(64) NOT NULL default '',
  `datas` int(11) NOT NULL default '0',
  `datas_f` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;



-- 
-- ��������� ������� `phpshop_messages`
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
  PRIMARY KEY  (`ID`),
  KEY `enabled` (`enabled`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;
-- 
-- ��������� ������� `phpshop_baners`
-- 

CREATE TABLE `phpshop_baners` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `content` text NOT NULL,
  `count_all` int(11) NOT NULL default '0',
  `count_today` int(11) NOT NULL default '0',
  `flag` enum('0','1') NOT NULL default '0',
  `datas` varchar(32) NOT NULL default '',
  `limit_all` int(11) NOT NULL default '0',
  `dir` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_baners`
-- 

INSERT INTO `phpshop_baners` VALUES (1, 'PHPShop Start', '<A href="http://www.phpshop.ru"><IMG height=60 alt="" src="/UserFiles/Image/Trial/baner_start.gif" width=468 border=0></A>', 63, 63, '0', '14.04.08', 2147483647, '');

-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_black_list`
-- 

CREATE TABLE `phpshop_black_list` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `ip` varchar(32) NOT NULL default '',
  `datas` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 ;

-- 
-- ���� ������ ������� `phpshop_black_list`
-- 


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_cache`
-- 

CREATE TABLE `phpshop_cache` (
  `sesid` varchar(64) NOT NULL default '',
  `cache` longblob NOT NULL,
  `datas` int(11) NOT NULL default '0',
  PRIMARY KEY  (`sesid`),
  KEY `datas` (`datas`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_cache`
-- 


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_categories`
-- 
-- 
-- ��������� ������� `phpshop_categories`
-- 

CREATE TABLE `phpshop_categories` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `num` tinyint(11) NOT NULL default '0',
  `parent_to` int(11) NOT NULL default '0',
  `yml` enum('0','1') NOT NULL default '1',
  `num_row` enum('1','2','3') NOT NULL default '2',
  `num_cow` tinyint(11) NOT NULL default '0',
  `sort` blob NOT NULL,
  `content` text NOT NULL,
  `vid` enum('0','1') NOT NULL default '0',
  `name_rambler` varchar(255) NOT NULL default '',
  `servers` varchar(255) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `title_enabled` enum('0','1','2') NOT NULL default '0',
  `title_shablon` varchar(255) NOT NULL default '',
  `descrip` varchar(255) NOT NULL default '',
  `descrip_enabled` enum('0','1','2') NOT NULL default '0',
  `descrip_shablon` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `keywords_enabled` enum('0','1','2') NOT NULL default '0',
  `keywords_shablon` varchar(255) NOT NULL default '',
  `skin` varchar(64) NOT NULL default '',
  `skin_enabled` enum('0','1') NOT NULL default '0',
  `order_by` enum('1','2','3') NOT NULL default '3',
  `order_to` enum('1','2') NOT NULL default '1',
  `secure_groups` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `parent_to` (`parent_to`),
  KEY `servers` (`servers`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=13 ;

-- 
-- ���� ������ ������� `phpshop_categories`
-- 

INSERT INTO `phpshop_categories` VALUES (1, '������ ������� �������', 0, 0, '0', '', 0, 0x4e3b, '<P><IMG height=100 alt="" src="/UserFiles/Image/Trial/img9_18900s.jpg" width=86 border=0></P>', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '', '', '');
INSERT INTO `phpshop_categories` VALUES (2, '�����', 0, 1, '0', '2', 0, 0x613a353a7b693a303b733a313a2236223b693a313b733a313a2232223b693a323b733a313a2233223b693a333b733a313a2234223b693a343b733a313a2235223b7d, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (3, '������� ��� �������', 0, 1, '0', '2', 0, 0x613a323a7b693a303b733a313a2233223b693a313b733a313a2234223b7d, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (4, '��������������', 0, 1, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (5, '������� ������� �������', 0, 0, '0', '', 0, 0x4e3b, '<IMG height=100 alt="" src="/UserFiles/Image/Trial/img21_66070s.jpg" width=85 border=0>', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '', '', '');
INSERT INTO `phpshop_categories` VALUES (6, '������������� ����', 0, 5, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (7, '���������� ������', 0, 5, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (8, '����-�������', 0, 5, '0', '2', 0, 0x613a313a7b693a303b733a313a2232223b7d, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (9, '�����-�����-����', 0, 0, '0', '', 0, 0x4e3b, '<IMG height=73 alt="" src="/UserFiles/Image/Trial/img26_20400s.jpg" width=100 border=0>', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '', '', '');
INSERT INTO `phpshop_categories` VALUES (10, '��-����������', 0, 9, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (11, '�������� ������������', 0, 9, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (12, 'MP3-������', 0, 9, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
   
-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_comment`
-- 


CREATE TABLE `phpshop_comment` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `datas` varchar(32) default NULL,
  `name` varchar(32) default NULL,
  `parent_id` int(11) NOT NULL default '0',
  `content` text,
  `user_id` int(11) NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_comment`
-- 


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_delivery`
-- 

CREATE TABLE `phpshop_delivery` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `city` varchar(255) NOT NULL default '',
  `price` float NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '1',
  `flag` enum('0','1') NOT NULL default '0',
  `price_null` float NOT NULL default '0',
  `price_null_enabled` enum('0','1') NOT NULL default '0',
  `PID` int(11) NOT NULL default '0',
  `taxa` int(11) NOT NULL default '0',
  `is_folder` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_delivery`
-- 

INSERT INTO `phpshop_delivery` VALUES (1, '������', 0, '1', '', 0, '', 0, 0, '1');
INSERT INTO `phpshop_delivery` VALUES (3, '������ � �������� ����', 180, '1', '0', 0, '0', 1, 0, '0');
INSERT INTO `phpshop_delivery` VALUES (4, '������ �� ��������� ����', 300, '1', '0', 0, '0', 1, 0, '0');
INSERT INTO `phpshop_delivery` VALUES (7, '����� ������', 0, '1', '', 0, '', 0, 0, '1');
INSERT INTO `phpshop_delivery` VALUES (8, '������', 500, '1', '', 0, '', 7, 50, '0');

-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_discount`
-- 

CREATE TABLE `phpshop_discount` (
  `id` tinyint(11) unsigned NOT NULL auto_increment,
  `sum` int(255) NOT NULL default '0',
  `discount` varchar(64) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_discount`
-- 


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_foto`
-- 

CREATE TABLE `phpshop_foto` (
  `id` int(11) NOT NULL auto_increment,
  `parent` int(11) NOT NULL default '0',
  `name` varchar(64) NOT NULL default '',
  `num` tinyint(11) NOT NULL default '0',
  `info` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_foto`
-- 

INSERT INTO `phpshop_foto` VALUES (4, 1, '/UserFiles/Image/Trial/img1_15201.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (5, 2, '/UserFiles/Image/Trial/img2_20923.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (6, 3, '/UserFiles/Image/Trial/img3_27387.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (7, 4, '/UserFiles/Image/Trial/img4_97080.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (17, 6, '/UserFiles/Image/Trial/img6_94790.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (16, 5, '/UserFiles/Image/Trial/img5_13875.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (18, 7, '/UserFiles/Image/Trial/img7_21593.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (19, 8, '/UserFiles/Image/Trial/img8_19242.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (20, 9, '/UserFiles/Image/Trial/img9_18900.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (22, 10, '/UserFiles/Image/Trial/img10_16509.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (23, 11, '/UserFiles/Image/Trial/img11_10500.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (24, 12, '/UserFiles/Image/Trial/img12_17764.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (25, 13, '/UserFiles/Image/Trial/img13_15187.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (28, 15, '/UserFiles/Image/Trial/img15_10754.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (27, 14, '/UserFiles/Image/Trial/img14_72079.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (29, 16, '/UserFiles/Image/Trial/img16_23131.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (30, 17, '/UserFiles/Image/Trial/img17_15624.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (31, 18, '/UserFiles/Image/Trial/img18_17180.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (32, 19, '/UserFiles/Image/Trial/img19_20468.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (33, 20, '/UserFiles/Image/Trial/img20_12661.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (35, 21, '/UserFiles/Image/Trial/img21_66070.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (36, 22, '/UserFiles/Image/Trial/img22_40627.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (37, 23, '/UserFiles/Image/Trial/img23_60070.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (38, 24, '/UserFiles/Image/Trial/img24_92740.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (39, 25, '/UserFiles/Image/Trial/img25_89668.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (40, 26, '/UserFiles/Image/Trial/img26_20400.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (41, 27, '/UserFiles/Image/Trial/img27_20637.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (42, 28, '/UserFiles/Image/Trial/img28_22696.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (43, 29, '/UserFiles/Image/Trial/img29_10321.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (44, 30, '/UserFiles/Image/Trial/img30_20017.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (45, 31, '/UserFiles/Image/Trial/img31_16234.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (46, 32, '/UserFiles/Image/Trial/img32_23078.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (47, 33, '/UserFiles/Image/Trial/img33_11122.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (48, 34, '/UserFiles/Image/Trial/img34_12151.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (49, 35, '/UserFiles/Image/Trial/img35_18833.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (50, 36, '/UserFiles/Image/Trial/img36_16386.jpg', 0, '');

-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_jurnal`
-- 

CREATE TABLE `phpshop_jurnal` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user` varchar(64) NOT NULL default '',
  `datas` varchar(32) NOT NULL default '',
  `flag` enum('0','1') NOT NULL default '0',
  `ip` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_links`
-- 

CREATE TABLE `phpshop_links` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `image` text NOT NULL,
  `opis` text NOT NULL,
  `link` text NOT NULL,
  `num` int(11) default NULL,
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_links`
-- 

INSERT INTO `phpshop_links` VALUES (1, 'PHPShop Software', '', '�������� ��������-��������, ������ ��������-�������� PHPShop.', 'http://www.phpshop.ru', 5, '1');
INSERT INTO `phpshop_links` VALUES (2, 'PHPShop CMS Free', '', '���������� ��c���� ���������� ������ PHPShop CMS Free.', 'http://www.phpshopcms.ru', 3, '1');
INSERT INTO `phpshop_links` VALUES (3, 'Vsego Mnogo', '', 'Vsego-mnogo.ru � ���� � ������� �������, �����������, ����-�������, �����-�������. ', 'http://www.vsego-mnogo.ru/', 1, '1');

-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_menu`
-- 

CREATE TABLE `phpshop_menu` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `content` text NOT NULL,
  `flag` enum('0','1') NOT NULL default '1',
  `num` int(11) NOT NULL default '0',
  `dir` varchar(64) NOT NULL default '',
  `element` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `flag` (`flag`),
  KEY `element` (`element`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_menu`
-- 


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_news`
-- 

CREATE TABLE `phpshop_news` (
  `id` int(11) NOT NULL auto_increment,
  `datas` varchar(32) NOT NULL default '',
  `zag` varchar(255) NOT NULL default '',
  `kratko` text NOT NULL,
  `podrob` text NOT NULL,
  `datau` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_notice`
-- 

CREATE TABLE `phpshop_notice` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `product_id` int(11) NOT NULL default '0',
  `datas_start` varchar(64) NOT NULL default '',
  `datas` varchar(64) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_notice`
-- 


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_opros`
-- 

CREATE TABLE `phpshop_opros` (
  `id` int(11) NOT NULL auto_increment,
  `category` int(11) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `total` int(11) NOT NULL default '0',
  `num` tinyint(32) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_opros`
-- 

INSERT INTO `phpshop_opros` VALUES (1, 1, '��', 1, 0);
INSERT INTO `phpshop_opros` VALUES (2, 1, '���������', 0, 0);
INSERT INTO `phpshop_opros` VALUES (3, 1, '�� �����', 0, 0);

-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_opros_categories`
-- 

CREATE TABLE `phpshop_opros_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `dir` varchar(32) NOT NULL default '',
  `flag` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_opros_categories`
-- 

INSERT INTO `phpshop_opros_categories` VALUES (1, '��� �������� ����� ������?', '', '1');

-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_order_status`
-- 

CREATE TABLE `phpshop_order_status` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `color` varchar(64) NOT NULL default '',
  `sklad_action` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_order_status`
-- 

INSERT INTO `phpshop_order_status` VALUES (1, '�����������', 'red', '');
INSERT INTO `phpshop_order_status` VALUES (2, '�����������', '#99cccc', '');
INSERT INTO `phpshop_order_status` VALUES (3, '������������', '#ff9900', '');
INSERT INTO `phpshop_order_status` VALUES (4, '��������', '#ccffcc', '1');

-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_orders`
-- 

CREATE TABLE `phpshop_orders` (
  `id` int(11) NOT NULL auto_increment,
  `datas` varchar(64) NOT NULL default '',
  `uid` varchar(64) NOT NULL default '0',
  `orders` blob NOT NULL,
  `status` text NOT NULL,
  `user` int(11) unsigned NOT NULL default '0',
  `seller` enum('0','1') NOT NULL default '0',
  `statusi` tinyint(11) NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_page`
-- 

CREATE TABLE `phpshop_page` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `link` varchar(64) NOT NULL default '',
  `category` int(11) NOT NULL default '0',
  `keywords` text NOT NULL,
  `description` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  `flag` varchar(16) NOT NULL default '1',
  `num` smallint(3) NOT NULL default '0',
  `datas` int(11) NOT NULL default '0',
  `odnotip` text NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  `secure` enum('0','1') NOT NULL default '0',
  `secure_groups` varchar(255) NOT NULL default '',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `link` (`link`),
  FULLTEXT KEY `content` (`content`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_page`
-- 

INSERT INTO `phpshop_page` VALUES (1, '����� �������', 'page1', 2000, '', '', '<DIV style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px" align=center>\r\n<TABLE align=center>\r\n<TBODY>\r\n<TR>\r\n<TD><A title="���������� � ��������" href="/?skin=phpshop_1"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_9_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="���������� � ��������" href="/?skin=phpshop_2"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_10_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="���������� � ��������" href="/?skin=phpshop_3"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_11_small.gif" width=100 border=0> </A></TD>\r\n<TD style="BORDER-RIGHT: #d3d3d3 1px dashed; PADDING-RIGHT: 5px; BORDER-TOP: #d3d3d3 1px dashed; PADDING-LEFT: 5px; PADDING-BOTTOM: 5px; BORDER-LEFT: #d3d3d3 1px dashed; PADDING-TOP: 5px; BORDER-BOTTOM: #d3d3d3 1px dashed" align=middle><IMG src="/UserFiles/Image/Trial/palette.png" border=0> <BR><A class=b title="�������� ������������� �������" href="http://www.phpshop.ru/docs/service.html#1">������<BR>��� ����� �</A></TD></TR>\r\n<TR>\r\n<TD><A title="���������� � ��������" href="/?skin=aeroblue"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_5_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="���������� � ��������" href="/?skin=pink" ?><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_7_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="���������� � ��������" href="/?skin=grass"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_6_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="���������� � ��������" href="/?skin=gray"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_8_small.gif" width=100 border=0></A> </TD></TR>\r\n<TR>\r\n<TD><A title="���������� � ��������" href="/?skin=blue_classic"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_1_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="���������� � ��������" href="/?skin=red_classic"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_2_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="���������� � ��������" href="/?skin=green_classic"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_3_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="���������� � ��������" href="/?skin=yellow_classic"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_4_small.gif" width=100 border=0></A> </TD></TR></TBODY></TABLE></DIV>', '', 0, 1208180402, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (2, '��� ������� �����?', 'page2', 1000, '', '', '<H3 align=center>��� ������� �����?</H3>\r\n<DIV><STRONG>1. ��������� ������</STRONG><BR>��� ������ � ����� ��������-�������� ������������� � ������������ �������. ��� ������ ��������, ���� �������� ������� ������� ��������� ��������, ������� ������� ��� ������ ����� ������ ������.<BR>������ �����, ������� ������ �� ������� � ����� ����� �������� � ��� ����� (��������). ���������� � ����� ������ �������� ����� ��������� ������������ ���������� ������� � ����� ������� � ����� ��������� ��������� ���� �������.<BR>����� ���������� ������ � �������, �� ������ ���������� �������� ������ ��� ������� � ���������� ������.</DIV>\r\n<DIV><BR><STRONG>2. ���������� �����</STRONG><BR>��� ��������� ����������� ������ ������ ������� �� ������� ��������� �����.<BR>���������� ������ ������ ����� ���� ��������� ��� ��������� �� ������ ������� - ������ �������� ����� � ������ ������ � ������� ������ �������������. ���� �� �������� �������� � ������� ������ �����, �� ������ ������ ������� ��� � ������� ������ ���������.<BR>����� ��������� ������ �������������� ������������� � ������������ ����� ������ ������ �������. ��������� ����� ���������� � ����������� �� ������� ������.<BR>��������� ��������� ����� ������. � ��� ��� ���������� ������� ���� ���������� ������, ����� � ����� ��� �������� ������, ������� ������ ������.<BR>����� ����� ������� ������ ��������� �������. ��� � ��� - ����� ��������!<BR>�� ����������� ����� �� �������� ����������� � ������ ������ ������.</DIV>\r\n<DIV><BR><STRONG>3. �������� �������� ������ ������!</STRONG><BR>� ���������� ���� �������� ������ �������� �������� � ����, ��������� �������� ���������� ������� � ������ ������, ���������� ����������� �������� ������ � ��������� ���� �����, ��� ������� ������ ������� ��� ��� ����� ��������� ������.</DIV>\r\n<P><STRONG>�������� ��������:</STRONG><BR>����� ����� � ����� ��������-��������, �� ��� �� ������� ������, � ����� ���� ��������� ��� � ����� ����������. � ����� ������, �� ������ ����� ���������� �� ����������� ������ �� ������� ��� �������� ��������.</P>\r\n<P><STRONG>�������� �������?</STRONG><BR>���� ��������� ���������������� ��� �� ���� ��������, ��������� � ����������� ������, ������� � ��������� �� ��������: 200-30-40 (��-��, � 9 �� 18 �����).</P>', '', 0, 1208172153, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (3, '������� � ������', 'page3', 1000, '', '', '<H1>������� � ������</H1>\r\n<DIV class=cl>�� ��� ������, ��� �������� ��������� ������ �������, � ������ ������������ � ���, ��� ������������ ���� ��������� ��������, ������� ����� ��������� �, ���� �����, ������ ���������� ����� �������. ���� ��������-������� ������ � ���� �����, �� �� ����� �������� � ���� ��������� ������ ����������:<BR><BR></DIV>\r\n<DIV class=text>\r\n<UL>\r\n<LI><STRONG>�������� ��������� �������������� ���������, �������-������� � �������� �����.</STRONG> </LI></UL>\r\n<P><STRONG>�������</STRONG>: � ���� ������ ������� ��������� ����� �������� �����-���� �������� ��� ��������� �����. ��� ����������� ����� ��������� �� ����� ������������� �����, ���� ��������� �����-���� �� ��������� ������. �� ���������� � ���������� ��������, ������ ��� �������� ��������� ����� �������� ����� ���������� �� ���� ���������� �����. �����-����� ���������� ����� ��������, �������������� ����� �����������-����������, ��� ����� ������ �� �������� �� ���������� ������ ������ �������������� �����. � ���� �� �����-����� ���������� ��������� ��������� ���������.<BR><BR><STRONG>������</STRONG>: �� ������ ��� ����� ���������� �� ��, ��� ����� ����������� ���� �����, � �������� �� ���������� �����, � �����. ���� ���� ������� ����������� ������ �� ������ � ���������� ��� ��������� ������ �����, ��� �� ����, ��� �� �������� � ������ ��� �����. �������� �� � ����������� ����� �� �������� � �������� ������ ������ � ���� �� �������� � ���, ��� ����������� ����� ����� ������� �� ����� �������� � ���������, �� ���������� ������� ����������� ����, ��� ��� ����� ���������, ��� �� �� ��������. � ���� �� ����������� �������� ��������������, ��� ���������������� ������, �� ����������� ����� ���� ���������� � ���� �������� � ���, �� ����, ������� ������������ �������, � ���� ��������� ������ ����� ������ ��� ����� ������.<BR><BR></P>\r\n<UL>\r\n<LI><STRONG>�������� �������� ������� ��������� �������.</STRONG> </LI></UL>\r\n<P><STRONG>�������</STRONG>: ����������� ������� �� ���������� ��� �������� ������������� �������. ���������� � ������������ ������� ������� �����, ������������ ����� �������� � ��������� �������� ����������.<BR>���� � ��� ��� ���� ���� � ������������� � �������� �����-����� ��� ��������� ����� ���, ��, ����� ��, ������ ���������� ������� ����������� �����������.<BR>� ����� ������ ����������� ���������, �������� �� ������ ���������� � �������-�������. ������� ������������ ����� ������� ������� ��������� �������, ������� ����������� � ����������� ����� �� �������� ������ � ����� ����������� �������� ��� ����������� �������� �������. ������� ���������� ��������� ��������� ������ ���� �� �������� ������, � �������� � ����������� ������ �� ��������� ����������� ������ �����. � �������� ������ ��� ������ ����������. ��� ���������� ����� � ��������������� � �������� (� ������� �� ������������) ������������ ������� ������������ ������, �� � �������� ��� ��������� �������� ������������ ����� �������� �� �������������� ���������. � ��������� �� ���������� ���� �� � ������� �������, ������� � ����������� ������� �������� ������� ������ � ���� ����������� ������� ���������, ��� ������� ����������������� �������. <BR>����������� ����, ������� �� ���������� �� ����������� � ���-������, �� ������������� � ��������. ���� � ��������� �� �� �� ������ ���� ����������� ��������� ��������� �������, ������ �����������, ������������ ������������ �������� �� ������ �����, �������� ����������� ��������� � �������� ����������� ��������� � ���� ������ �������� ��������� ����� � �������� ������. <BR><BR><STRONG>������</STRONG>: ��� ��������� ������� ��� ��������� ��� ������������� ��������, ������� ���������� ������� ��������� � ���������. �� ��������� � �������-�������� �� ������� ������� ������� ���������� ������� � �����, ��� ���� ��������� ��������� ���� ������� ���������. �� ��������� ����������� ��������� ������������� ����� ��������� �������� � �������� ������� � �������������� ���� ������ ����������� �� �����������. �� ������, ����������� �� ������������ ���������� ������� � �������� �� ������� ���������� ���� �������� ��������� ���������� ��������� � ����� ����� (��������� �������), ������� ���������� ����������� � ������ ������, �������� ����������, ����������� ����� � �.�. � �� ��������� � ���, ��� ���� ������� ������ ������� � ����� ����� ����� � � ����� ����� ������� ����.<BR>���������� ����� ��������, ����� ��� ������ ������������� ������ � ���������, ������� � �������� �������� ��������� �������, �� ��� ���� �������-������� ��������� �������������� ��������� ��������-�������. ��� ������������� �������, ������� ����� ����� ��������� ��� ���������� ����� ��� ��������� � ���������.<BR>����� �������� ������ �� ��������-������� � ����� ���������� ������������� ������� �� ��������� ���������� �������� �������, ��������� ����� ��� ������������, ������ ���-�� �������� �������� ����� ��������. ����� �������, ������ ��������-���������, �� ����������� ��� �� � ������������ ������������ ��������� ��������� - ������, ��������, ����������� � ��. <BR>��� ������, ����������� � ���������, ��� ���������� ��������, �����, � �� ������������ �������� � ��������� �������� ���� �� ��������������� � ��������� � ����� ������ ����������. ������ ����� ������� ����������� ��������� � �������� ���� ��������� � ������������ ��������, ������ ��� ���������, �������� ��, �������������� ������, ����� ������� ��������� ����� ������ �������, ������� ����� ����� ���� ������ � �������� ���������������.<BR><BR>�� ������ ��� ������ ����������� � �������!<BR></P></DIV>', '', 0, 1208172033, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (4, '��������', 'page4', 1000, '', '', '<DIV style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 5px; PADDING-TOP: 5px">\r\n<H1>�������� �����</H1>\r\n<DIV class=cl>�� ��������� �� ������:</DIV>\r\n<DIV class=text>�. ������, ����� �������������� �������� 9/8 ����.3 ���� 7. <BR>T��./����: (+7 495) 400-30-20</DIV>\r\n<DIV class=text>�� ������ ������ ����� ������������ ��� �������, ���������� ����� �����, ������ ����� ��� ��������������.<BR></DIV></DIV>', '', 0, 1208172286, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (5, '���������� ��������� � ���������', 'page5', 1, '', '', '<DIV>�������� �������� ������������ ��������� 90-�, ��� ���� ����� � ����&shy;��� ���� ���� �� ��������� � ��������� ��������. ����� �������� ���&shy;�����, �������� � ������ 500 ���������� ���� ��� �Fortune 500�, ���������� ��������, � ���� ����������, ����������������� � ������������� ����� ����. ������ �� ����� ��� � ������������ ������� World Wide Web, ������������� ������� �����&nbsp; 37 000 �������, ��� � �� �������, ���������������&nbsp; ��� ����������� ���������� �������� ������ ���������� (��������, �� ��������� ������), ��� ������ ���������� ��� �������� ��������� � ����. ��������, Netscape Communications � ������� ������������� ������������ ����������� ��� ������ � �������� � ��� ���������� ��������, ���������� �� ���������� ������-������ � ��������� ��� ������� ���� ������; ����� ����, ��������� �������� ������������� ���������� ������� ����������� ��������.</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ���� ����� ����������� �� ����� ������ � ������; ���������� ����� ������ ��� ��������� � ���� ������: ��������������� �����, ����������� ������������ ������������ � ������� ������&shy;��� � ������� ����������� ������, ����� � ���������&shy;���� (������� �������, �������).</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ������� ���������� � �������� �������� �������� ��������� � ������������ ������� �������� �����, ��&shy;������ ���������� ���������� � ���� �������. � ���� ���� �� ���-������ � ��������� ������� ������ ���� ������ ����������� ������� ������� (��� ��� ����� ������������� � ���������� ��� �� ������������ ����&shy;����������), ��� ������ ����� ���������� �������&shy;�� ��������� ������� ������� � ����.</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ���� �������� ����������� �� � ������������ �����, � ��� ������ ����������� ����� �������. �� ���� ������� ������� �� ����� �� � ��� ���� �������� � ����� ��������� ����, ���� ��������� ��� ��� �����&shy;��� ��������, ����� ��� ��������� �������, �������&shy;��� �������, ��������������� ���������, ���������&shy;�� ������ �� ������ � ���� �����������. �������� ����� �������� � ����������� ������� ��� �� ������&shy;�� ��������� ����������� � ����������� ����������&shy;��� ��������, � ������ ����� ���� ������ ���� ����� ���������?�, �������� �� ������� ����� ���������� ��-������.</DIV>\r\n<DIV>&nbsp;</DIV>\r\n<DIV><STRONG>�������� ���������� � ���������</STRONG></DIV>\r\n<DIV>&nbsp;</DIV>\r\n<DIV>��� ����������� ������ ��������������� �������� ����� (��������, ��������������� �������������, ������������) ��� ���������� ��������, ����������� ����, ��������� ����������� � ��������� �������� ������� � ����������. ������� �������, ����������&shy;�� ����������� � ��������, ������ ������������ �� ���������� ����������:</DIV>\r\n<DIV>&nbsp;</DIV>\r\n<DIV>�&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ������������ ��������� �����, </DIV>\r\n<DIV>�&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ������������ ����������� </DIV>\r\n<DIV>�&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ��������� �����&shy;�������.</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<BR><STRONG>����������� ������� �����<BR></STRONG><BR></DIV>\r\n<DIV>� ������������� �������� �� ����� ����� ����. ����������, ���� ����� ��� ����� ����� ���������� �� �����. �������� ���������������� ������ ������� ��������, ������������� Internet Society, ��������&shy;���� ��� ����� ������������ � ���� ������� ������&shy;�����. ��� � ���� 1996 ���� �� ���� 13 ��������� (�� ����� ���� ��� ���� ����� ����), ��� ���� �� ������ ��������� 1996 ���� ��� ����� ����������� �� 35 %. ��������� ���������� ������������� � ����������� �� �������� ���, ����� ��������� �������������� �������&shy;���������, ����������� ����������. �� ��������� �������, � ��������� ����� ��������&shy;����� ���� ������� 50 ���������.</DIV>\r\n<DIV>��, � ��� ������� ���� � ������? �������� �������� �� ������������ ������� Computer Week-Moscow (CW-Moscow, 34-35, 1998, http://www.ritmpress.ru/ it/talk/Ol.htm):</DIV>\r\n<DIV>�� ����� ������, ���� �� ����� ������ �������, ��&shy;�������� ������������� ����������� ����� �� �����&shy;���� 500 ���., � "��������� �������" � 50 ���. ��&shy;�����. ������ �� ������� ��������, ��� � � ������ ��� ���� �������, � ����� ������� ������, �����&shy;����, �����������, ���������, ��������, ��� � ��&shy;������ �������� �� ������ ������������ ���������&shy;��. � ���������, � ����������� ������� � ��������� ���� ���������� ����� 30 �������� ����. � ����&shy;��� �������������� �������� ����� ������ �� ���� ������ ������������� ���������� �������������, � ��&shy;����� ������������ ����� ��������� ������������� ������� ����������������������� ������������ �, ����� ���������, ������������� ������������ ���&shy;������ � �����. ������������� ������������ �������� ��� ����� �������������� ���������� � ����� ��&shy;������ ��� ����, ��� ����� ���� �� ��������� �������� ������� �������� ���������: ����� ������� ������&shy;�����. ���� ������ ����� ���������������, ��� �� ��&shy;��������� ���������� ����� �������� �����. �����&shy;���, ���������� � ������������� �������� � ������ � ������������� ���������� �� �������� ���������� ��������� "��������". � ����������� ��� �� ������ ���&shy;������ ��������, �� � ���������, ��� ������ ����� �� ���� ������������� ����� ���������� ������.</DIV>\r\n<DIV>&nbsp;</DIV>\r\n<DIV>���� � �������� �������� (�, � ���������, WWW) ����� ������� ������, ��� ��� ������ ������ � ����&shy;������� �����, �� ��� ������� ��������������� ��&shy;������������ ������������� ����? ����� �������, ��� ������ ����������� ������������ �����? ���, � ����� ������, ���������? �����, ��� �� ���, ��������, ��&shy;��������, ��� ��: ����������. ���� �� ������������ ��������, ��� 95 % ������������� ���������� �����&shy;�� � �������� �� 22 �� 30 ���, �� ���� �������� � ��&shy;������ ���������� �����. ��������� ����� ��������&shy;��� �����, ������� ��, ������ ������� ��� ����� (�, ������ �����, � ������ �������).</DIV>\r\n<DIV>&nbsp;</DIV>\r\n<DIV>\r\n<HR>\r\n</DIV>\r\n<DIV><STRONG>����������� ������������</STRONG></DIV>\r\n<DIV>&nbsp;</DIV>\r\n<DIV>���������� �� �����, ��� ������������ ������ � ��� ����� ������? ��� ������� (������� � ���� ��������&shy;����� �������), ������ ����� � �������� � ���� ������ � �� �����. � ����� ������, ������� �� ����������� � ��������&nbsp; �� ��������� � ��������� �� �������� ���������� �������� � ������ ����� �����&shy;����� ������������ ��������.<BR></DIV>\r\n<DIV>��������� �������� ���������, ����� �� ��������� �������� (���������� ����!) � ����� ������������� � ���������. ����������� ����������� �������� ���&shy;��� � ����������� ����� � ����� ���������� (����&shy;�����������) � ��������� ����������� ��� ������&shy;��������� ����� ����������. ���������� ����� ��������, ��� ������ � ������ ������ ������������� � ���� ��� ��, ��� �� �����������, �� ���� ����� � ����������. ����������� ����� ��������� � �����&shy;��� ����� � ����� ����������� ������ ���� �� ����&shy;������. ��������� ��������� ������ ���������� �������� � ������� �� ������� ������������� � ��&shy;�������� ��������, ����� �������, ��� �������� ������ ���������� ��������� �� ����������� ���&shy;��. �������� ����� ���������� �������� ������� �� ����� ���� ������������, ������� �������� �� � �����&shy;���� ���������� � ���������� ������ ���������� ����&shy;�����. ��� ������� � ���������� ������ ������� ����� ���� � ��������. ������������ ����� ����� �������� ������ ������� � ������� �������� � ������ ����&shy;����� ����������� � ��� �� ����. � �� ������ �����, �� ��� �� ��������� � �����, ��� ���������� ����� ���������� ����� ������������ ����������� ������&shy;�� ���� � ��� ���� �����, �������� �� ��������, ����&shy;���� �� ������.<BR></DIV>\r\n<DIV>���� ������� ������������� ������ � ���� ����� �� ��������, �� ��� �� ����������� ���� ����� ��� ������ ������� �������? ���������, �������� ����������� ������� �Hotwired� ������� �Wired�, ��������� ��������� ����� ��� ������� � ����������� ���������&shy;��. ����������� �������� � �������������� ����� ����������� �� �������� � ������� �� ��, ��� ����&shy;���� �� ������ �������� �������� �����, �� � �����&shy;��� � �� �������� � ������� �������. ����� ����, � �������� ���������� ����� ��� ��������� �������� �������, ��������������� ������ ������������ ����&shy;������� ��������� �� ����������. � ���� ������� ��� ���� �����������, ������ �������, ��� �� �����, ����������� ����� � ������ ����� �������� ������ � ������.<BR></DIV>\r\n<DIV>���������� ����� ���������� � ������ �������� ���&shy;����, ������� ��, �� ����� ���� ��������, � �����&shy;�������� ��������� ������� ������ �� ����������&shy;�� ������������ �� ��������� ������� �����-���� ������.<BR></DIV>\r\n<DIV>��������, ��� �������� ���������� ������������ ������������ ���� PRODIGY ����������� ������&shy;����� �������� ��������. ������, ������ � ����� �������, � ����� ��������� �������, PRODIGY ����&shy;���� ��������� ��������� �������, ����� ����������, ��� ������������� �����, ������, �������� �������, ������ ����������� ��������� ������� � ������ on&shy;line. � � ��������� ������� � ����� ��� �������� ������� ��� ����������� ������������ � ���� ��� ��� ������ �����. ��� ��� ����� ����������� � ��&shy;������ ������� �� ������� �� ������ �������� ��������� ������ ����, ������� �� ����, �������� �� ��������� ��� ������ ��� ������ ��� �������������.</DIV>\r\n<DIV>���������� ��������� ����������, ������ ��������� ����������� �������� ������ ������� (����� �� ����������� ����� ����������: ������ ������������&shy;���� ���������, �������� �������, ���������� ��&shy;������� ���������� �������, ������������� ������ ��������� � ��� �����). ������, ��� �������, ����&shy;����� ����������� ��������������� ���������� ��&shy;�������:</DIV>\r\n<DIV>&nbsp;</DIV>\r\n<DIV>� ��������: ������� � ����� ������� (����, ������ � ��� �����) ������ �� ���;</DIV>\r\n<DIV>� �������������� ����: �� ���� �� �� ���� ���&shy;���;</DIV>\r\n<DIV>� �������������: �� �� ����, ��� ��� ����, � � ����� ������ ��, ��� ����� �����;</DIV>\r\n<DIV>� �������������� ������ ������: ���� ��� ��&shy;��� ���������������, �� � �� ��������� ���&shy;���������� ������ ������ ���������.<BR></DIV>\r\n<DIV>�� ��������� � �������� ���������� �������� ��&shy;�������� � ��������, ������������ � �����, � ����&shy;���, �� ����, ������������� ��� �������� ��������&shy;���� ���������, �������� �������� �������� � ������ ���������� �������������� ���������. �� ������ ��&shy;����� ������� � ����� �����������.</DIV>\r\n<DIV>&nbsp;</DIV>\r\n<H5><B>&nbsp;�������� ������������</B></H5>\r\n<DIV>&nbsp;</DIV>\r\n<DIV>���� ����������� � ��������� �������� ������� ����� ����� � ��������������� ������������, �� ��� ������� � ����������, ���������� �� ����������� ��&shy;��������� � �������� ����� � ������������? ������� �������, �� ���������� �� ���������� ���� ��� �����&shy;�������� ����������� � ��������� ��, ����������� �� ����������� �����, ����� � ���������? ����� �� �� ��������, �� ������������ �������� ����������, �������, ���������� ���� �� ������� �����������? ��������� ���������� ������� �������� �� ��� �������:</DIV>\r\n<DIV>� ������� � ��� �������������;</DIV>\r\n<DIV>� ��� ������������ ������ � ����� ��������;</DIV>\r\n<DIV>� ��� ��� ����, ������� �� ��� ������ �����;</DIV>\r\n<DIV>� ������ ��� ��������� (��� �� ���������) ��&shy;�����.<BR></DIV>\r\n<DIV>� ������� �� ���������, ���������� �� ����������� ������ ����������, �������� ��������� ����������� �������������� ����������� � ������������, ��� ������� ��������� ���� ���������� ������������ (� ���������, ������������ ���������� � ����� ������������). ����� ������ ������� �������� "grassroots" ("����� �����").<BR></DIV>\r\n<DIV>��������� �������� ������������ ����� ���������� ����� ���������������� ����� � ������� �� ������������ ������� ����������, �� ������ ������� ��������� ������ � �������� ���������� �� ����� ���� ��������� � �� ������������ �����.<BR></DIV>\r\n<DIV>����� �� ������� �������� �������������� ������� ����������? ��� ������������ ������, ������������ ��� ������� ������������ �������� �������� ����������, �����������, ��� ������������� �������� ���� ����������� ������������� �������� �� ��������� � ���� ��������� ���������, � �������������� ��������� �������, ������� �� �� ����������� � ���������� ��������� �����������.<BR></DIV>\r\n<DIV>��� ������ � �������� �����, ��������� � ������������ ����������� �������, ������ ���������� ������ ���� ����� � ���������� ����� ���� � ������� ��� ����������� ���������.</DIV>\r\n<DIV>����� �������, ����� ���� ���������� ������ �������������� ������������ ������� ��������������� �������� � ���� "����������������", ������������� ���� ���������� �������� �����. ��� ��������� ������������� ���������� ������� ������������ �������� ���� (�������� ���, 1994): "� ����� �������� ������� �����, �������������� ����� �������� ������� ������ ������, ��� �����������, � �������������� ���������� ����� ����������� ��� �������������� ��������".</DIV>\r\n<DIV>� ����� �������� ���������� �� ���������� ������� ��������������� �� ���������� ����� ���� � ���������, ��������� "������������" ������� � ����� �������� ������ ����, ������ �����, ����� ���������������. ������������, ��������, ����� ������ ��������� � ��������������� ������ ��������������� Usenet ���������� � ������������ ����������. ����� �����, ��������� ����� �����������, � ���� �������, ������� ���������� ����� �������� � �������, �����, �������� � ��������� � ������ �������� ������������ ������������.</DIV>', '', 0, 1214400752, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (6, '����� ������� � �������, �����, �������� � ���������', 'page6', 1, '', '', '<DIV>����� �������� ����������� ������������ �� ������ ������������ ������� ����� ������ ���������� � ������� � �������, �� � � ���� ������� �������� �� �������� ����������� ��� ������������� ����� ���������� ������ � ������� ������� ������ �� ��������� � ������������� ���������� �������� ����������.</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ����� �����, ��� ��� ���������� ���� �����������, ����� ����� �������� ���� � �������� ����������, � ���� ����� ������ ��������������� ������� � ������ ��������� ������� � ����� ������������ ������. ��������, ��� ��� �� ����� �� �������� � �������� ��� �� ���������� � ��������� �� ��������, �.�. ����� ���������� ���������� ����� �����������.</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ������ ������ �������������� ������������� ���������� ������� � �������� ������ ������������� �������� � ����������� � �������������� ��������. ��������������, ��������, ���������������� ������� �������� ������ ��������� �������� � ������ ���������������� ���������� � ��������, �.�. ��� ���������� ����� �������������. ������������������ ���������������� ���������� ������� ��� ��������, �� ��� ���� ��� �� �������� ����� �������� ��� ��������� ������ �������� � ���������� �������. � �������� ������������ ����� ������������� ������������ ������� �.�. ��������� ��������� �������, ����� ����� - ���� ��������� �����, �� ������� ������� ����� ���������� � ������� � ��� ����������� "������" � ������� ���������� ������������� ��� �������� ��������-"digi-cash" ��� "e-cash", ������������ ������� ������� � ������������������.</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ������� ��������, ��� ������ � �������������, ������� �������� ����� ������� ����������� � ������� "����������������" ������� ��������� � ��� �������� ���������� "����" ���������� � ������������ �����������, ������� ��� ������ ������������ ����� ��������. ������ �������� ��������� � ���� ����������� �������� The Global Network Navigator � ������������� Special Connections List ����������� ������� ������ (Scott Yanoff), � ����� ��� ���������� ���������, ��������, �� ��������������� �������� (Aerospace Engineering: A Guide to Internet Resources) ��� ����������� (All the Investment Links. Direct links to all the resources in the PFC Investment Index). ��� ���� ������������ ������� ���������� ������� ������� � ������, ������������ "�����������" � ������� ��������������� ������ ��������� ��� ������ � ������ ����������.</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ����� ����������� ������������ � ����� �������� ��� �������������� �������, ��������, ���� ������������ ������ Digital Equipment, ����� ��� ���������� ���� �������� ������� ������� � ���������������� ���������� ����� ����� ������� Alpha AXP � ������������� ������ ����� ��������. ������ �������� ����� ��������� ���������� ���������� �� ������ ���� ������� ���������, �������������� � ������, ������ � ���������� ���� �������� ����� ������ ��������� ��������, ������� �� ����������� NASA � ������ ��������� ��������� � ����������.</DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; �������� ����� � ��������� ������� ��������� ������� ����� ������� � ����� ��������, �������� � ���������� ������������, �������������������� � ������������ ������������� � ��������� ���������� �� ����� ����������� ���� ��������. ', '', 0, 1208172974, '', '', '1', '', '');
        
-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_page_categories`
-- 

CREATE TABLE `phpshop_page_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `num` int(64) NOT NULL default '1',
  `parent_to` int(11) NOT NULL default '0',
  `content` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `parent_to` (`parent_to`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_page_categories`
-- 

INSERT INTO `phpshop_page_categories` VALUES (1, '��� ������� ��������-�������', 0, 0, '');

-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_payment`
-- 

CREATE TABLE `phpshop_payment` (
  `uid` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `sum` float NOT NULL default '0',
  `datas` int(11) NOT NULL default '0',
  PRIMARY KEY  (`uid`),
  KEY `order` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_payment`
-- 


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_products`
-- 

CREATE TABLE `phpshop_products` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `category` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `content` text NOT NULL,
  `price` float NOT NULL default '0',
  `price_n` float NOT NULL default '0',
  `sklad` enum('0','1') NOT NULL default '0',
  `p_enabled` enum('0','1') NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '1',
  `uid` varchar(32) NOT NULL default '',
  `spec` enum('0','1') NOT NULL default '0',
  `odnotip` varchar(64) NOT NULL default '',
  `vendor` varchar(255) NOT NULL default '',
  `vendor_array` blob NOT NULL,
  `yml` enum('0','1') NOT NULL default '0',
  `num` int(11) NOT NULL default '1',
  `newtip` enum('0','1') NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `title_enabled` enum('0','1') NOT NULL default '0',
  `datas` int(11) NOT NULL default '0',
  `page` varchar(255) NOT NULL default '',
  `user` tinyint(11) NOT NULL default '0',
  `descrip` varchar(255) NOT NULL default '',
  `descrip_enabled` enum('0','1','2') NOT NULL default '0',
  `title_shablon` varchar(255) NOT NULL default '',
  `descrip_shablon` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `keywords_enabled` enum('0','1','2') NOT NULL default '0',
  `keywords_shablon` varchar(255) NOT NULL default '',
  `pic_small` varchar(255) NOT NULL default '',
  `pic_big` varchar(255) NOT NULL default '',
  `yml_bid_array` tinyblob NOT NULL,
  `parent_enabled` enum('0','1') NOT NULL default '0',
  `parent` varchar(255) NOT NULL default '',
  `items` int(11) NOT NULL default '0',
  `weight` float NOT NULL default '0',
  `price2` float NOT NULL default '0',
  `price3` float NOT NULL default '0',
  `price4` float NOT NULL default '0',
  `price5` float NOT NULL default '0',
  `files` TEXT NOT NULL ,
  `baseinputvaluta` INT NOT NULL ,
  `ed_izm` VARCHAR(255) NOT NULL,
   `dop_cat` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `category` (`category`),
  KEY `enabled` (`enabled`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- 
-- ���� ������ ������� `phpshop_products`
-- 



INSERT INTO `phpshop_products` VALUES (1, 2, '���� BINATONE SI 2000 A', '<P>��������� ������ ���������������<BR>�����<BR>��������� ������������� ������</P>', '<DIV>���� � ����� SI-2000A<BR>\r\n<P>��������� ������ ���������������<BR>�����<BR>��������� ������������� ������</P></DIV>\r\n<DIV>��������� ������������� ������<BR>����������� ����� ������<BR>������� �����������<BR>����� ��� ������� �����<BR>������ ��������� � ���������</DIV>', 500, 0, '', '1', '1', '', '1', '2,3,4', 'i6-11ii3-4i', 0x613a323a7b693a363b613a313a7b693a303b733a323a223131223b7d693a333b613a313a7b693a303b733a313a2234223b7d7d, '', 0, '1', '', '0', 1225285621, '', 1, '', '0', '@Product@', '', '', '0', '', '/UserFiles/Image/Trial/img1_15201s.jpg', '/UserFiles/Image/Trial/img1_15201.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 100, 100, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (2, 2, '���� BINATONE SI-2000 WG', '<P>��������� ������ ���������������<BR>�����<BR>��������� ������������� ������</P>', '<P>��������� ������ ���������������<BR>�����<BR>��������� ������������� ������</P>', 600, 0, '', '1', '1', '', '1', '1', 'i6-11ii3-4i', 0x613a323a7b693a363b613a313a7b693a303b733a323a223131223b7d693a333b613a313a7b693a303b733a313a2234223b7d7d, '', 0, '1', '', '0', 1225285539, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img2_20923s.jpg', '/UserFiles/Image/Trial/img2_20923.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 100, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (3, 2, '���� BINATONE SI 2600 W', '<P>��������� ������ ���������������<BR>�����<BR>��������� ������������� ������</P>', '<P>��������� ������ ���������������<BR>�����<BR>��������� ������������� ������</P>', 650, 0, '', '1', '1', '', '1', '', 'i6-11ii3-4i', 0x613a323a7b693a363b613a313a7b693a303b733a323a223131223b7d693a333b613a313a7b693a303b733a313a2234223b7d7d, '', 0, '1', '', '0', 1225285568, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img3_27387s.jpg', '/UserFiles/Image/Trial/img3_27387.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:26:"/UserFiles/Image/chars.rar";}', 6, '', '');
INSERT INTO `phpshop_products` VALUES (4, 2, '���� BINATONE SI 2800', '<P>��������� ������ ���������������<BR>�����<BR>��������� ������������� ������</P>', '<P>��������� ������ ���������������<BR>�����<BR>��������� ������������� ������</P>', 700, 0, '', '1', '1', '', '1', '', 'i6-11ii3-4i', 0x613a323a7b693a363b613a313a7b693a303b733a323a223131223b7d693a333b613a313a7b693a303b733a313a2234223b7d7d, '', 0, '1', '', '0', 1225274234, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img4_97080s.jpg', '/UserFiles/Image/Trial/img4_97080.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:43:"/UserFiles/Image/Trial/def_skin_2_small.gif";}', 6, '��.', '');
INSERT INTO `phpshop_products` VALUES (5, 3, '������� ��� ������� PHILIPS QC 5000', '����� ������� ������ �������� ��������� ������ � �������� ��������. ������� ��� ������� ����� Complete Control ���� ������������ �������� � ���������� ����������.', '����� ������� ������ �������� ��������� ������ � �������� ��������. ������� ��� ������� ����� Complete Control ���� ������������ �������� � ���������� ����������.', 700, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208164534, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img5_13875s.jpg', '/UserFiles/Image/Trial/img5_13875.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (6, 3, '������� ��� ������� PHILIPS QC 5050', '����� ������� ������ �������� ��������� ������ � �������� ��������. ������� ��� ������� ����� Complete Control ���� ������������ �������� � ���������� ����������.', '����� ������� ������ �������� ��������� ������ � �������� ��������. ������� ��� ������� ����� Complete Control ���� ������������ �������� � ���������� ����������.', 1000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208164510, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img6_94790s.jpg', '/UserFiles/Image/Trial/img6_94790.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (7, 3, '������� ��� ������� PHILIPS QC 5070', 'Philishave Super Easy. ������� � ������������� ������� ��� ������� ����� � 8 ����������� ����� (1-21 ��), ������ ��������� Flexcomb � ���������� �����. �������� ������� � �������� �������� - ������ � ������.', 'Philishave Super Easy. ������� � ������������� ������� ��� ������� ����� � 8 ����������� ����� (1-21 ��), ������ ��������� Flexcomb � ���������� �����. �������� ������� � �������� �������� - ������ � ������.', 2400, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208164613, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img7_21593s.jpg', '/UserFiles/Image/Trial/img7_21593.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (8, 3, '������� ��� ������� PHILIPS QC 5099', 'Philishave MaxPricision. �� ������� � �������� �������� ������� ����������� ����� ���������������� �������. ������� ��� ������� ����� MaxPrecision ����� 15 �������� ����� (1-41 ��) � �������� ������������ ������� ��� �������� ���������� ��������.', 'Philishave MaxPricision. �� ������� � �������� �������� ������� ����������� ����� ���������������� �������. ������� ��� ������� ����� MaxPrecision ����� 15 �������� ����� (1-41 ��) � �������� ������������ ������� ��� �������� ���������� ��������.', 2600, 0, '', '1', '1', '', '1', '', 'i6-11ii2-3ii6-11ii2-3ii6-11ii2-3ii6-11ii2-3ii6-11ii2-3i', 0x613a323a7b693a363b613a313a7b693a303b733a323a223131223b7d693a323b613a313a7b693a303b733a313a2233223b7d7d, '', 0, '1', '', '0', 1208164686, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img8_19242s.jpg', '/UserFiles/Image/Trial/img8_19242.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (9, 4, '������������� BINATONE AEJ-1501 CG/WG', '������ �� ������ ��� ���� �������������� ��� ��������� ����������� 1.5 � ����� ������ ���� �������� 2000 �� �������� ��������� ������', '������ �� ������ ��� ���� �������������� ��� ��������� ����������� 1.5 � ����� ������ ���� �������� 2000 �� �������� ��������� ������', 300, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208165004, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img9_18900s.jpg', '/UserFiles/Image/Trial/img9_18900.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (10, 4, '������������� BINATONE CEJ-1012 CP', '��� ��������������� ��������: ������� (��������) �������� ��������������� ��������: ����������� ����� ��������: 1500 �� �����: 1 � ������ ������ ������: �������������', '��� ��������������� ��������: ������� (��������) �������� ��������������� ��������: ����������� ����� ��������: 1500 �� �����: 1 � ������ ������ ������: �������������', 700, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208165103, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img10_16509s.jpg', '/UserFiles/Image/Trial/img10_16509.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (11, 4, '������������� BINATONE CEJ-3300 CP/SG/T/WG', '��� ��������������� ��������: ������� (��������) �������� ��������������� ��������: ����������� ����� �������� (��): 2200 ����� (�): 2 ������ ������ ������: �������������', '��� ��������������� ��������: ������� (��������) �������� ��������������� ��������: ����������� ����� �������� (��): 2200 ����� (�): 2 ������ ������ ������: �������������', 1000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208165193, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img11_10500s.jpg', '/UserFiles/Image/Trial/img11_10500.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (12, 4, '������������� BINATONE CEJ-3500 BB/BS/CP', 'MAGIC - thermo control, 2200��, 2�., ����� ����������, ����������� ���������� ����������� ���� � ������� �� ����� ���������� ���������: - ����� - ����������� ���� �� 40�C, - ������ - ����������� ���� �� 40�C �� 80�C,�� 80�C - �������, ������ �����', 'MAGIC - thermo control, 2200��, 2�., ����� ����������, ����������� ���������� ����������� ���� � ������� �� ����� ���������� ���������: - ����� - ����������� ���� �� 40�C, - ������ - ����������� ���� �� 40�C �� 80�C,�� 80�C - �������, ������ �����', 875, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208165278, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img12_17764s.jpg', '/UserFiles/Image/Trial/img12_17764.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (13, 6, '������������� ���� DELONGHI MW 355', '������������ ���������� ������ �� 30 ��� �������� ������ ���������� ���� �������� ��������� 700 �� EMD ���������� ������� �������� 5', '������������ ���������� ������ �� 30 ��� �������� ������ ���������� ���� �������� ��������� 700 �� EMD ���������� ������� �������� 5', 1578, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208165769, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img13_15187s.jpg', '/UserFiles/Image/Trial/img13_15187.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (14, 6, '������������� ���� MOULINEX AFM4 43', '����� 22 � ��� ���������� ��������� ���������� ����� 290 �� �������� �������� ����������, �� 850 ������������ �������� �����, �� 1100 �������������� ������� ����� ��� ������� �������� - 6', '����� 22 � ��� ���������� ��������� ���������� ����� 290 �� �������� �������� ����������, �� 850 ������������ �������� �����, �� 1100 �������������� ������� ����� ��� ������� �������� - 6', 3000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208170805, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img14_72079s.jpg', '/UserFiles/Image/Trial/img14_72079.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (15, 6, '������������� ���� SAMSUNG C-100 R-5', '����� - 20 �, ������������� ���� � ������, �������� ��� - 750 ��, �������� ����� - 1100 ��, 6 ������� ��������, ��� ���������� - ������������, ������� ��� �����, ���-������������ �����, ������ �� 60 ���., ������� �.�.�.', '����� - 20 �, ������������� ���� � ������, �������� ��� - 750 ��, �������� ����� - 1100 ��, 6 ������� ��������, ��� ���������� - ������������, ������� ��� �����, ���-������������ �����, ������ �� 60 ���., ������� �.�.�.', 1025, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208166069, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img15_10754s.jpg', '/UserFiles/Image/Trial/img15_10754.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (16, 6, '������������� ���� SAMSUNG CE-2833 NR', '������������� ���� � ������ ����� - 23 � �������� ��� - 850 �� / ����� - 1110 �� 6 ������� �������� ��� ���������� - �������� +Dial ���-������������ ����� ������� �.�.�.', '������������� ���� � ������ ����� - 23 � �������� ��� - 850 �� / ����� - 1110 �� 6 ������� �������� ��� ���������� - �������� +Dial ���-������������ ����� ������� �.�.�.', 2000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208166144, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img16_23131s.jpg', '/UserFiles/Image/Trial/img16_23131.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (17, 7, '���������� ������ WHIRLPOOL AWO/D 43115', '���������� Silver Nano ������������ ����������� ����� ���������������� - A ����� ������ - A ����� ������ - D �������� (��) - 40 / 4,5 �������� ��� �������� (�����, ��) 598 x 404 x 850', '���������� Silver Nano ������������ ����������� ����� ���������������� - A ����� ������ - A ����� ������ - D �������� (��) - 40 / 4,5 �������� ��� �������� (�����, ��) 598 x 404 x 850', 7523, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208166360, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img17_15624s.jpg', '/UserFiles/Image/Trial/img17_15624.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (18, 7, '���������� ������ CANDY Aquamatic 1000T-45', '��������: ������ (��) 69.5, ������ (��) 51, ������� (��) 44 ��� �������� ����������� �������� (��) 3.5 ����� (��/���) 1000 ����� ������ A /����� � �������������������/ ����� ������ C C����� �������������: ������', '��������: ������ (��) 69.5, ������ (��) 51, ������� (��) 44 ��� �������� ����������� �������� (��) 3.5 ����� (��/���) 1000 ����� ������ A /����� � �������������������/ ����� ������ C C����� �������������: ������', 2500, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208166430, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img18_17180s.jpg', '/UserFiles/Image/Trial/img18_17180.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (19, 7, '���������� ������ CANDY CNL 105', '�������: ������ (��) 85, ������ (��) 60, ������� (��) 52 ��� �������� ����������� �������� (��) 5 ����� (��/���) 0-1000 ����� ������ A /����� � �������������������!/ ����� ������ C C����� �������������: ������, �������', '�������: ������ (��) 85, ������ (��) 60, ������� (��) 52 ��� �������� ����������� �������� (��) 5 ����� (��/���) 0-1000 ����� ������ A /����� � �������������������!/ ����� ������ C C����� �������������: ������, �������', 8020, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208167110, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img19_20468s.jpg', '/UserFiles/Image/Trial/img19_20468.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (20, 7, '���������� ������ CANDY Aquamatic 800T-45', '��������: ������ (��) 69.5, ������ (��) 51, ������� (��) 44 ��� �������� ����������� �������� (��) 3.5 ����� (��/���) 800 ����� ������ A /����� � �������������������/ ����� ������ D C����� �������������: ������', '��������: ������ (��) 69.5, ������ (��) 51, ������� (��) 44 ��� �������� ����������� �������� (��) 3.5 ����� (��/���) 800 ����� ������ A /����� � �������������������/ ����� ������ D C����� �������������: ������', 11230, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208167185, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img20_12661s.jpg', '/UserFiles/Image/Trial/img20_12661.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (21, 8, '���������� MOULINEX OW 2000', '�������� 610 �� 12 ������� ������������� 68 ��������� ��������� ������������� ����� ������� ���� � ������������� ��������� ������� ����������� ������� � ������� ��������� �����: 500, 750, 1000 �', '�������� 610 �� 12 ������� ������������� 68 ��������� ��������� ������������� ����� ������� ���� � ������������� ��������� ������� ����������� ������� � ������� ��������� �����: 500, 750, 1000 �', 2005, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1223541722, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img21_66070s.jpg', '/UserFiles/Image/Trial/img21_66070.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (22, 8, '���������� KENWOOD BM 250', '��� ������� �� 500 �� �� 1 ��. ������� ����������� ����������� ����� �� 58 ���. ����������� ������ ����� �������. ��������: 480 ��. 12 ��������.', '��� ������� �� 500 �� �� 1 ��. ������� ����������� ����������� ����� �� 58 ���. ����������� ������ ����� �������. ��������: 480 ��. 12 ��������.', 2000, 0, '', '1', '1', '', '1', '', 'i6-11ii2-3ii6-11ii2-3ii6-11ii2-3ii6-11ii2-3ii6-11ii2-3i', 0x613a323a7b693a363b613a313a7b693a303b733a323a223131223b7d693a323b613a313a7b693a303b733a313a2233223b7d7d, '', 0, '1', '', '0', 1208167429, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img22_40627s.jpg', '/UserFiles/Image/Trial/img22_40627.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (23, 8, '���������� KENWOOD BM 256', '�����: Principio ��������, ��: 2600 ���������� �������� - �������� ��� ���������� - ������������ ������ ������ ������� - 2 ��������� - ���� ��� ����� - ���', '�����: Principio ��������, ��: 2600 ���������� �������� - �������� ��� ���������� - ������������ ������ ������ ������� - 2 ��������� - ���� ��� ����� - ���', 1863, 0, '', '1', '1', '', '1', '', 'i6-11ii2-3ii6-11ii2-3ii6-11ii2-3ii6-11ii2-3ii6-11ii2-3i', 0x613a323a7b693a363b613a313a7b693a303b733a323a223131223b7d693a323b613a313a7b693a303b733a313a2233223b7d7d, '', 0, '1', '', '0', 1208167517, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img23_60070s.jpg', '/UserFiles/Image/Trial/img23_60070.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (24, 8, '���������� KENWOOD BM 350', '��� ������� �� 500 �� �� 1 ��. ������� ����������� ����������� ����� �� 58 ���. ����������� ������ ����� �������. ��������: 480 ��. 12 ��������. ������ �� ����������� ����� � ����� ����������� ������� � ����������� �������.', '��� ������� �� 500 �� �� 1 ��. ������� ����������� ����������� ����� �� 58 ���. ����������� ������ ����� �������. ��������: 480 ��. 12 ��������. ������ �� ����������� ����� � ����� ����������� ������� � ����������� �������.', 3000, 0, '', '1', '1', '', '1', '', 'i6-11ii2-3ii6-11ii2-3ii6-11ii2-3ii6-11ii2-3ii6-11ii2-3i', 0x613a323a7b693a363b613a313a7b693a303b733a323a223131223b7d693a323b613a313a7b693a303b733a313a2233223b7d7d, '', 0, '1', '', '0', 1208167599, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img24_92740s.jpg', '/UserFiles/Image/Trial/img24_92740.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (25, 10, '��-��������� SONY KDL-40V2500', '����� ����� V � ���������� 46" � ���������� ������� HD �������� ������������� ���������������� �� Sony: "�������� ����� ��������", "BRAVIA ENGINE" � ������������������ ��-������, �������������� ������� �������� �����������. ����� ����� �������� ����������� ����������� ����������� � ������� �������.', '����� ����� V � ���������� 46" � ���������� ������� HD �������� ������������� ���������������� �� Sony: "�������� ����� ��������", "BRAVIA ENGINE" � ������������������ ��-������, �������������� ������� �������� �����������. ����� ����� �������� ����������� ����������� ����������� � ������� �������.', 30000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208170201, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img25_89668s.jpg', '/UserFiles/Image/Trial/img25_89668.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (26, 10, '��-��������� SONY KDL-40S2000', '����� ����� S � ���������� 40" - ��� �������� ��-���������� � ������� ��������� �����������, ������� �������������� �������� "BRAVIA ENGINE" � ������������������ ��-�������', '����� ����� S � ���������� 40" - ��� �������� ��-���������� � ������� ��������� �����������, ������� �������������� �������� "BRAVIA ENGINE" � ������������������ ��-�������', 25000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208170276, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img26_20400s.jpg', '/UserFiles/Image/Trial/img26_20400.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (27, 10, '��-��������� PHILIPS 42PF5421/10', '� ����� ����� V � ���������� 32" � ���������� ������� HD ������������ ������������ �������������� �� Sony: "Live Colour Creation", BRAVIA ENGINE � ������������������ ��-������. ����� ����� ����� ����������� ����������� ����������� � ������� �������.', '� ����� ����� V � ���������� 32" � ���������� ������� HD ������������ ������������ �������������� �� Sony: "Live Colour Creation", BRAVIA ENGINE � ������������������ ��-������. ����� ����� ����� ����������� ����������� ����������� � ������� �������.', 32000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208170345, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img27_20637s.jpg', '/UserFiles/Image/Trial/img27_20637.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (28, 10, '��-��������� SONY KDL-32S2000', '��������� 81 ��, 2&#215;10, 1366&#215;768, ��������� � HDTV, ����������� DNLe, ��������� LNA+, ����������� ������������� PC, ������� ���� S-PVA, �������� 1000:1, ������� 500 ��/�&#178;, ��������� HDMI, ������� <�������� � ��������> � <������� �����>, FM-�����, ������ NICAM, �������� SRS TruSurround XT, ���������: 1000 �������, ������������ ����� ��', '��������� 81 ��, 2&#215;10, 1366&#215;768, ��������� � HDTV, ����������� DNLe, ��������� LNA+, ����������� ������������� PC, ������� ���� S-PVA, �������� 1000:1, ������� 500 ��/�&#178;, ��������� HDMI, ������� <�������� � ��������> � <������� �����>, FM-�����, ������ NICAM, �������� SRS TruSurround XT, ���������: 1000 �������, ������������ ����� ��', 35000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208170407, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img28_22696s.jpg', '/UserFiles/Image/Trial/img28_22696.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (29, 11, '�������� ����������� SONY DSC-H5 / Black', '������ Cyber-shot H5 - ������ � ���� �������: ������� ������� ��������� �������� ������, 7,2 ����������� ������������, �������� Carl ZeissR � 12-������� ���������� �����, ������������ ��������� ��-����� Clear Photo 3", ������ ������ ��������� ����������, ������� ����������� ����� ������ STAMINA.', '������ Cyber-shot H5 - ������ � ���� �������: ������� ������� ��������� �������� ������, 7,2 ����������� ������������, �������� Carl ZeissR � 12-������� ���������� �����, ������������ ��������� ��-����� Clear Photo 3", ������ ������ ��������� ����������, ������� ����������� ����� ������ STAMINA.', 10000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171095, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img29_10321s.jpg', '/UserFiles/Image/Trial/img29_10321.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (30, 11, '�������� ����������� SONY DSC-T10 / Silver', 'Cyber-shot T10 - �������� � ������ �������� ������ � ������� �������� ��������� ��������, ���������� ����������� ������������� Super SteadyShot � ������� ����������������, � ����������� 7,2 ����������� ������������, ���������� ZEISS � 3-������� ���������� ����������� � 2,5-�������� ��-��������.', 'Cyber-shot T10 - �������� � ������ �������� ������ � ������� �������� ��������� ��������, ���������� ����������� ������������� Super SteadyShot � ������� ����������������, � ����������� 7,2 ����������� ������������, ���������� ZEISS � 3-������� ���������� ����������� � 2,5-�������� ��-��������.', 9800, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171183, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img30_20017s.jpg', '/UserFiles/Image/Trial/img30_20017.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (31, 11, '�������� ����������� SONY DSC-T50 / Red', '���������� Cyber-shot T50 � ������� �������� ��������� �������� ������. ������� ��������� ��-����� 3,0 ����� � �������� "����� ������� ��� ������", ���-������� � 7,2 ������������ �������������, �������� Carl ZeissR � ���������� ����� 3�, ������� STAMINA - � ��� ��� � �������� ����������� �������.', '���������� Cyber-shot T50 � ������� �������� ��������� �������� ������. ������� ��������� ��-����� 3,0 ����� � �������� "����� ������� ��� ������", ���-������� � 7,2 ������������ �������������, �������� Carl ZeissR � ���������� ����� 3�, ������� STAMINA - � ��� ��� � �������� ����������� �������.', 7963, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171271, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img31_16234s.jpg', '/UserFiles/Image/Trial/img31_16234.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (32, 11, '�������� ����������� SONY DCS-W40', '������ Cyber-shot W40 - ������� ������ � ������ �����: 6,0 ����������� ������������, ������� ���������������� ISO ��� ����� ������ �������, 3-������� ���-�������� Carl ZeissR, ����� ��-����� 2 �����, ������� ����������� ����� ������ STAMINA, �������� �������� ������. ', '������ Cyber-shot W40 - ������� ������ � ������ �����: 6,0 ����������� ������������, ������� ���������������� ISO ��� ����� ������ �������, 3-������� ���-�������� Carl ZeissR, ����� ��-����� 2 �����, ������� ����������� ����� ������ STAMINA, �������� �������� ������. ', 5890, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171352, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img32_23078s.jpg', '/UserFiles/Image/Trial/img32_23078.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (33, 12, 'MP3-����� DEX MPX-152 (1Gb) White/Black', '1 Gb, 1.5 ����� ������� �� �������, 128*128 ����., USB-2.0, FM-�����, MP1, MP2, MP3, WMA, WMV, ASF, WAV-�����., ���� � ������� � �������� JPEG, BMP, ���������.����������� AMV, MTV, �����. ���������, ����. Li-Ion �������, ������. ����. � ���������, �������� Sennheizer', '1 Gb, 1.5 ����� ������� �� �������, 128*128 ����., USB-2.0, FM-�����, MP1, MP2, MP3, WMA, WMV, ASF, WAV-�����., ���� � ������� � �������� JPEG, BMP, ���������.����������� AMV, MTV, �����. ���������, ����. Li-Ion �������, ������. ����. � ���������, �������� Sennheizer', 1200, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171476, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img33_11122s.jpg', '/UserFiles/Image/Trial/img33_11122.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (34, 12, 'MP3-����� DEX MPX-153 (1Gb) Red/Silver', '1 Gb, 1.5 ����� ������� �� �������, 128*128 ����., USB-2.0, FM-�����, MP1, MP2, MP3, WMA, WMV, ASF, WAV-�����., ���� � ������� � �������� JPEG, BMP, ���������.����������� AMV, MTV, �����. ���������, ����. Li-Ion �������, ������. ����. � ���������, �������� Sennheizer', '1 Gb, 1.5 ����� ������� �� �������, 128*128 ����., USB-2.0, FM-�����, MP1, MP2, MP3, WMA, WMV, ASF, WAV-�����., ���� � ������� � �������� JPEG, BMP, ���������.����������� AMV, MTV, �����. ���������, ����. Li-Ion �������, ������. ����. � ���������, �������� Sennheizer', 1110, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171539, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img34_12151s.jpg', '/UserFiles/Image/Trial/img34_12151.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (35, 12, 'MP3-����� DEX MPX-156 (2Gb) Black/Silver', '2 Gb, 1.5 ����� ������� �� �������, 128x128 ����., USB-2.0, FM-�����, MP1, MP2, MP3, WMA, WMV, ASF, WAV-�����., ���� � ������� � �������� JPEG, BMP, ���������.����������� AMV, MTV, �����. ���������, ����. Li-Ion �������, ������. ����. � ���������, ��������', '2 Gb, 1.5 ����� ������� �� �������, 128x128 ����., USB-2.0, FM-�����, MP1, MP2, MP3, WMA, WMV, ASF, WAV-�����., ���� � ������� � �������� JPEG, BMP, ���������.����������� AMV, MTV, �����. ���������, ����. Li-Ion �������, ������. ����. � ���������, ��������', 900, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171609, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img35_18833s.jpg', '/UserFiles/Image/Trial/img35_18833.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
INSERT INTO `phpshop_products` VALUES (36, 12, 'MP3-����� DEX MPX-186 (2Gb) Black / White', '2 Gb, 1.8" ������� �� �������, 128*128 ����., USB-2.0, FM-�����, MP1, MP2, MP3, WMA, WMV, ASF, WAV-�����., ���� � ������� � �������� JPEG, BMP, ���������.����������� AMV(��������� � ���������), �����. ���������, ����. Li-Ion �������, ������. ����. � ���������, �������� Sennheiser MX400RC.', '2 Gb, 1.8" ������� �� �������, 128*128 ����., USB-2.0, FM-�����, MP1, MP2, MP3, WMA, WMV, ASF, WAV-�����., ���� � ������� � �������� JPEG, BMP, ���������.����������� AMV(��������� � ���������), �����. ���������, ����. Li-Ion �������, ������. ����. � ���������, �������� Sennheiser MX400RC.', 1500, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171719, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img36_16386s.jpg', '/UserFiles/Image/Trial/img36_16386.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, '', 0, '', '');
        
-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_search_base`
-- 

CREATE TABLE `phpshop_search_base` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `uid` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 ;

-- 
-- ���� ������ ������� `phpshop_search_base`
-- 


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_search_jurnal`
-- 

CREATE TABLE `phpshop_search_jurnal` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `num` tinyint(32) NOT NULL default '0',
  `datas` varchar(11) NOT NULL default '',
  `dir` varchar(255) NOT NULL default '',
  `cat` tinyint(11) NOT NULL default '0',
  `set` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_servers`
-- 

CREATE TABLE `phpshop_servers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `host` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_servers`
-- 


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_shopusers`
-- 

CREATE TABLE `phpshop_shopusers` (
  `id` int(64) unsigned NOT NULL auto_increment,
  `login` varchar(64) NOT NULL default '',
  `password` varchar(64) NOT NULL default '',
  `datas` varchar(64) NOT NULL default '',
  `mail` varchar(64) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `company` varchar(255) NOT NULL default '',
  `inn` varchar(64) NOT NULL default '',
  `tel` varchar(64) NOT NULL default '',
  `adres` text NOT NULL,
  `enabled` enum('0','1') NOT NULL default '0',
  `status` varchar(64) NOT NULL default '0',
  `kpp` varchar(64) NOT NULL default '',
  `tel_code` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_shopusers_status`
-- 

CREATE TABLE `phpshop_shopusers_status` (
  `id` tinyint(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `discount` float NOT NULL default '0',
  `price` enum('1','2','3','4','5') NOT NULL default '1',
  `enabled` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_shopusers_status`
-- 


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_sort`
-- 

CREATE TABLE `phpshop_sort` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `category` int(11) unsigned NOT NULL default '0',
  `num` tinyint(11) NOT NULL default '0',
  `page` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_sort`
-- 
INSERT INTO `phpshop_sort` VALUES
(1, '�������', 2, 1, ''),
(2, '�����', 2, 2, ''),
(3, '�������', 2, 3, ''),
(4, '2000', 3, 0, ''),
(5, '2600', 3, 1, ''),
(6, '2800', 3, 3, ''),
(7, '����', 4, 1, ''),
(8, '���', 4, 2, ''),
(9, '��������', 5, 1, ''),
(10, '����. �����', 5, 2, '');


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_sort_categories`
-- 

CREATE TABLE `phpshop_sort_categories` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `flag` enum('0','1') NOT NULL default '0',
  `num` tinyint(11) NOT NULL default '0',
  `category` int(11) NOT NULL default '-1',
  `filtr` enum('0','1') NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `goodoption` ENUM('0','1') NOT NULL,
  `optionname` ENUM('0','1') NOT NULL,
  `page` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- 
-- ���� ������ ������� `phpshop_sort_categories`
-- 

INSERT INTO `phpshop_sort_categories` VALUES
(1, '�����', '0', 1, 0, '0', '����� ������', '0', '0', ''),
(2, '����', '', 0, 1, '', '���� �����', '1', '1', ''),
(3, '�������� [��]', '', 0, 1, '1', '�������� �����', '', '', ''),
(4, '��������', '', 0, 1, '1', '������� ���������', '', '', ''),
(5, '�������� �������', '', 0, 1, '1', '', '', '', '');


-- 
-- ��������� ������� `phpshop_system`
-- 

CREATE TABLE `phpshop_system` (
  `id` int(32) NOT NULL auto_increment,
  `name` text,
  `company` text,
  `num_row` int(10) default NULL,
  `num_row_adm` int(10) default NULL,
  `dengi` tinyint(11) default NULL,
  `percent` varchar(16) NOT NULL default '',
  `skin` varchar(32) default NULL,
  `adminmail2` varchar(64) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `kurs` tinyint(11) NOT NULL default '0',
  `spec_num` tinyint(5) NOT NULL default '0',
  `new_num` tinyint(11) NOT NULL default '0',
  `tel` text NOT NULL,
  `bank` blob NOT NULL,
  `num_vitrina` enum('1','2','3') NOT NULL default '3',
  `width_icon` varchar(11) NOT NULL default '',
  `updateU` varchar(32) NOT NULL default '',
  `nds` varchar(64) NOT NULL default '',
  `nds_enabled` enum('0','1') NOT NULL default '1',
  `admoption` blob NOT NULL,
  `kurs_beznal` tinyint(11) NOT NULL default '0',
  `descrip` varchar(255) NOT NULL default '',
  `descrip_shablon` varchar(255) NOT NULL default '',
  `title_shablon` varchar(255) NOT NULL default '',
  `keywords_shablon` varchar(255) NOT NULL default '',
  `title_shablon2` varchar(255) NOT NULL default '',
  `descrip_shablon2` varchar(255) NOT NULL default '',
  `keywords_shablon2` varchar(255) NOT NULL default '',
  `logo` varchar(255) NOT NULL default '',
  `promotext` text NOT NULL,
  `title_shablon3` varchar(255) NOT NULL default '',
  `descrip_shablon3` varchar(255) NOT NULL default '',
  `keywords_shablon3` varchar(255) NOT NULL default '',
  `rss_use` int(1) unsigned NOT NULL default '1',
  `1c_load_accounts` enum('0','1') NOT NULL default '1',
  `1c_load_invoice` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_system`
-- 

INSERT INTO `phpshop_system` VALUES (1, '��������-������� ���� ���', '���� ���', 10, 2, 6, '10', 'phpshop_1', 'den@phpshop.ru', '������ ������� � ���������� ���������', '�������, ������, ������, ����������, ��������, MP3, �������������, �������������, �����������, �������, �������, �����, �����, ����, ������������, ����������, ����������, ������, DEX, SONY, PHILIPS, TEFAL, ROWENTA, SAMSUNG, KRUPS, BINATONE, KENWOOD', 6, 4, 4, '(495) 105-05-50', 0x613a393a7b733a383a226f72675f6e616d65223b733a31303a22cecece20cde5f2f0e8ea223b733a31323a226f72675f75725f6164726573223b733a363a22cceef1eae2e0223b733a393a226f72675f6164726573223b733a363a22cceef1eae2e0223b733a373a226f72675f696e6e223b733a31303a2237373230353238383233223b733a373a226f72675f6b7070223b733a393a22373732303031303031223b733a393a226f72675f7363686574223b733a32303a223430373032383130343030313630303030303830223b733a383a226f72675f62616e6b223b733a31313a22cac120d1c4cc2dc1c0cdca223b733a373a226f72675f626963223b733a393a22303434353833363835223b733a31343a226f72675f62616e6b5f7363686574223b733a32303a223330313031383130363030303030303030363835223b7d, '2', '0', '1244018091', '18', '1', 0x613a34373a7b733a31373a227072657670616e656c5f656e61626c6564223b733a313a2231223b733a31323a22736b6c61645f737461747573223b733a313a2231223b733a31343a2268656c7065725f656e61626c6564223b733a313a2231223b733a31333a22636c6f75645f656e61626c6564223b733a313a2231223b733a32333a226469676974616c5f70726f647563745f656e61626c6564223b4e3b733a31333a22757365725f63616c656e646172223b733a313a2231223b733a31393a22757365725f70726963655f6163746976617465223b4e3b733a32323a22757365725f6d61696c5f61637469766174655f707265223b733a313a2231223b733a31383a227273735f6772616265725f656e61626c6564223b733a313a2231223b733a31373a22696d6167655f736176655f736f75726365223b733a313a2231223b733a363a22696d675f776d223b4e3b733a353a22696d675f77223b733a333a22333030223b733a353a22696d675f68223b733a333a22333030223b733a363a22696d675f7477223b733a333a22313030223b733a363a22696d675f7468223b733a333a22313030223b733a31343a2277696474685f706f64726f626e6f223b733a323a223930223b733a31323a2277696474685f6b7261746b6f223b733a323a223930223b733a31353a226d6573736167655f656e61626c6564223b4e3b733a31323a226d6573736167655f74696d65223b733a313a2235223b733a31353a226465736b746f705f656e61626c6564223b4e3b733a31323a226465736b746f705f74696d65223b4e3b733a383a226f706c6174615f31223b733a313a2231223b733a383a226f706c6174615f32223b733a313a2231223b733a383a226f706c6174615f33223b733a313a2231223b733a383a226f706c6174615f34223b4e3b733a383a226f706c6174615f35223b733a313a2231223b733a383a226f706c6174615f36223b733a313a2231223b733a383a226f706c6174615f37223b733a313a2231223b733a383a226f706c6174615f38223b733a313a2231223b733a31343a2273656c6c65725f656e61626c6564223b4e3b733a31323a22626173655f656e61626c6564223b4e3b733a31313a22736d735f656e61626c6564223b733a313a2231223b733a31343a226e6f746963655f656e61626c6564223b4e3b733a31343a227570646174655f656e61626c6564223b733a313a2231223b733a373a22626173655f6964223b733a303a22223b733a393a22626173655f686f7374223b733a303a22223b733a343a226c616e67223b733a373a227275737369616e223b733a31333a22736b6c61645f656e61626c6564223b733a313a2231223b733a31303a2270726963655f7a6e616b223b733a313a2230223b733a31383a22757365725f6d61696c5f6163746976617465223b733a313a2231223b733a31313a22757365725f737461747573223b733a313a2230223b733a393a22757365725f736b696e223b733a313a2231223b733a31323a22636172745f6d696e696d756d223b733a303a22223b733a31343a22656469746f725f656e61626c6564223b733a313a2231223b733a31333a2277617465726d61726b5f626967223b613a32313a7b733a31343a226269675f6d657267654c6576656c223b693a3130303b733a31313a226269675f656e61626c6564223b733a313a2231223b733a383a226269675f74797065223b733a333a22706e67223b733a31323a226269675f706e675f66696c65223b733a32353a222f5573657246696c65732f496d6167652f6c6f676f2e706e67223b733a31323a226269675f636f7079466c6167223b733a313a2230223b733a363a226269675f736d223b693a303b733a31363a226269675f706f736974696f6e466c6167223b733a313a2231223b733a31333a226269675f706f736974696f6e58223b693a303b733a31333a226269675f706f736974696f6e59223b693a303b733a393a226269675f616c706861223b693a35303b733a383a226269675f74657874223b733a303a22223b733a32313a226269675f746578745f706f736974696f6e466c6167223b693a303b733a383a226269675f73697a65223b693a303b733a393a226269675f616e676c65223b693a303b733a31383a226269675f746578745f706f736974696f6e58223b693a303b733a31383a226269675f746578745f706f736974696f6e59223b693a303b733a31303a226269675f636f6c6f7252223b693a303b733a31303a226269675f636f6c6f7247223b693a303b733a31303a226269675f636f6c6f7242223b693a303b733a31343a226269675f746578745f616c706861223b693a303b733a383a226269675f666f6e74223b733a31363a226e6f726f626f745f666f6e742e747466223b7d733a31353a2277617465726d61726b5f736d616c6c223b613a32313a7b733a31363a22736d616c6c5f6d657267654c6576656c223b693a3130303b733a31333a22736d616c6c5f656e61626c6564223b733a313a2231223b733a31303a22736d616c6c5f74797065223b733a333a22706e67223b733a31343a22736d616c6c5f706e675f66696c65223b733a32353a222f5573657246696c65732f496d6167652f6c6f676f2e706e67223b733a31343a22736d616c6c5f636f7079466c6167223b733a313a2230223b733a383a22736d616c6c5f736d223b693a303b733a31383a22736d616c6c5f706f736974696f6e466c6167223b733a313a2231223b733a31353a22736d616c6c5f706f736974696f6e58223b693a303b733a31353a22736d616c6c5f706f736974696f6e59223b693a303b733a31313a22736d616c6c5f616c706861223b693a35303b733a31303a22736d616c6c5f74657874223b733a303a22223b733a32333a22736d616c6c5f746578745f706f736974696f6e466c6167223b693a303b733a31303a22736d616c6c5f73697a65223b693a303b733a31313a22736d616c6c5f616e676c65223b693a303b733a32303a22736d616c6c5f746578745f706f736974696f6e58223b693a303b733a32303a22736d616c6c5f746578745f706f736974696f6e59223b693a303b733a31323a22736d616c6c5f636f6c6f7252223b693a303b733a31323a22736d616c6c5f636f6c6f7247223b693a303b733a31323a22736d616c6c5f636f6c6f7242223b693a303b733a31363a22736d616c6c5f746578745f616c706861223b693a303b733a31303a22736d616c6c5f666f6e74223b733a31363a226e6f726f626f745f666f6e742e747466223b7d733a31353a2277617465726d61726b5f6973686f64223b613a32313a7b733a31363a226973686f645f6d657267654c6576656c223b693a3130303b733a31333a226973686f645f656e61626c6564223b4e3b733a31303a226973686f645f74797065223b733a333a22706e67223b733a31343a226973686f645f706e675f66696c65223b733a303a22223b733a31343a226973686f645f636f7079466c6167223b733a313a2230223b733a383a226973686f645f736d223b693a303b733a31383a226973686f645f706f736974696f6e466c6167223b733a313a2231223b733a31353a226973686f645f706f736974696f6e58223b693a303b733a31353a226973686f645f706f736974696f6e59223b693a303b733a31313a226973686f645f616c706861223b693a303b733a31303a226973686f645f74657874223b733a303a22223b733a32333a226973686f645f746578745f706f736974696f6e466c6167223b693a303b733a31303a226973686f645f73697a65223b693a303b733a31313a226973686f645f616e676c65223b693a303b733a32303a226973686f645f746578745f706f736974696f6e58223b693a303b733a32303a226973686f645f746578745f706f736974696f6e59223b693a303b733a31323a226973686f645f636f6c6f7252223b693a303b733a31323a226973686f645f636f6c6f7247223b693a303b733a31323a226973686f645f636f6c6f7242223b693a303b733a31363a226973686f645f746578745f616c706861223b693a303b733a31303a226973686f645f666f6e74223b733a31363a226e6f726f626f745f666f6e742e747466223b7d7d, 6, 'PHPShop � ��� ������� ������� ��� �������� �������� �������� ��������.', '@Podcatalog@, @Catalog@, @System@', '@Podcatalog@ - @Catalog@ - @System@', '@Podcatalog@, @Catalog@, @Generator@', '@Product@ - @Podcatalog@ - @Catalog@', '@Product@, @Podcatalog@, @Catalog@', '@Product@,@System@', '/UserFiles/Image/img44_82435s.jpg', '', '@Catalog@ /', '@Catalog@', '@Catalog@', 0, '1', '1');
      
-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_users`
-- 

CREATE TABLE `phpshop_users` (
  `id` int(11) NOT NULL auto_increment,
  `status` blob NOT NULL,
  `login` varchar(64) NOT NULL default '',
  `password` varchar(64) NOT NULL default '',
  `mail` varchar(64) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  `content` text NOT NULL,
  `skin` varchar(255) NOT NULL default '',
  `skin_enabled` enum('0','1') NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `name_enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- --------------------------------------------------------

-- 
-- ��������� ������� `phpshop_valuta`
-- 

CREATE TABLE `phpshop_valuta` (
  `id` tinyint(11) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `code` varchar(64) NOT NULL default '',
  `iso` varchar(64) NOT NULL default '',
  `kurs` varchar(64) NOT NULL default '0',
  `num` tinyint(11) NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `phpshop_valuta`
-- 

INSERT INTO `phpshop_valuta` VALUES (4, '������', '��.', 'UAU', '13', 4, '1');
INSERT INTO `phpshop_valuta` VALUES (5, '�������', '$', 'USD', '23.5', 0, '1');
INSERT INTO `phpshop_valuta` VALUES (6, '�����', '���', 'RUR', '1', 1, '1');
