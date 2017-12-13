

CREATE TABLE `phpshop_modules_key` (
  `path` varchar(64) NOT NULL default '',
  `date` int(11) NOT NULL default '0',
  `key` text NOT NULL,
  `verification` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


CREATE TABLE `phpshop_modules` (
  `path` varchar(255) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `date` int(11) NOT NULL default '0',
  PRIMARY KEY  (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_modules` VALUES ('visualcart', 'Visual Cart', 1335333909);

DROP TABLE IF EXISTS `phpshop_modules_visualcart_system`;
CREATE TABLE IF NOT EXISTS `phpshop_modules_visualcart_system` (
  `id` int(11) NOT NULL auto_increment,
  `enabled` enum('0','1','2') NOT NULL default '1',
  `flag` enum('1','2') NOT NULL default '1',
  `title` varchar(64) NOT NULL default '',
  `pic_width` tinyint(100) NOT NULL default '0',
  `serial` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


INSERT INTO `phpshop_modules_visualcart_system` VALUES (1, '1', '1', '�������', 50, '');

DROP TABLE IF EXISTS `phpshop_modules_visualcart_memory`;
CREATE TABLE `phpshop_modules_visualcart_memory` (
  `id` int(11) NOT NULL auto_increment,
  `memory` varchar(64) NOT NULL default '',
  `cart` text NOT NULL,
  `date` int(11) NOT NULL default '0',
  `user` int(11) NOT NULL default '0',
  `ip` varchar(64) NOT NULL default '',
  `referal` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

CREATE TABLE `phpshop_1c_docs` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `cid` varchar(64) NOT NULL default '',
  `datas` int(11) NOT NULL default '0',
  `datas_f` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;



CREATE TABLE `phpshop_1c_jurnal` (
  `id` int(11) NOT NULL auto_increment,
  `datas` varchar(64) NOT NULL default '0',
  `p_name` varchar(64) NOT NULL default '',
  `f_name` varchar(64) NOT NULL default '',
  `time` float NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


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

INSERT INTO `phpshop_baners` VALUES (1, '������ ��������-��������', '<object codebase="http://active.macromedia.com/flash6/cabs/swflash.cab#version=6.0.0.0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" height="80" width="460"><param name="movie" value="/UserFiles/Image/Trial/shopbuilder.swf"><param name="play" value="true"><param name="loop" value="true"><param name="WMode" value="Opaque"><param name="quality" value="high"><param name="bgcolor" value=""><param name="align" value=""><embed src="/UserFiles/Image/Trial/shopbuilder.swf" play="true" loop="true" wmode="Opaque" quality="high" bgcolor="" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" align="" height="80" width="460"></object>', 1613, 76, '1', '13.12.11', 2147483647, '');

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


CREATE TABLE `phpshop_black_list` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `ip` varchar(32) NOT NULL default '',
  `datas` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;



CREATE TABLE `phpshop_categories` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `num` int(11) NOT NULL default '0',
  `parent_to` int(11) NOT NULL default '0',
  `yml` enum('0','1') NOT NULL default '1',
  `num_row` enum('1','2','3','4') NOT NULL default '2',
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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_categories` VALUES (1, '������ ������� �������', 0, 0, '0', '3', 0, 0x4e3b, '', '1', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '3', '1', '');
INSERT INTO `phpshop_categories` VALUES (2, '�����', 3, 1, '0', '3', 0, 0x613a363a7b693a303b733a323a223136223b693a313b733a323a223233223b693a323b733a313a2234223b693a333b733a313a2235223b693a343b733a313a2236223b693a353b733a323a223239223b7d, '\r\n\r\n', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (3, '������� ��� �������', 2, 1, '0', '3', 0, 0x613a363a7b693a303b733a313a2232223b693a313b733a323a223134223b693a323b733a323a223136223b693a333b733a323a223233223b693a343b733a323a223239223b693a353b733a323a223137223b7d, '\r\n', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (4, '��������������', 1, 1, '0', '3', 0, 0x613a333a7b693a303b733a313a2232223b693a313b733a323a223233223b693a323b733a323a223239223b7d, '<br>\r\n\r\n\r\n\r\n\r\n', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (5, '������� ������� �������', 0, 0, '0', '3', 0, 0x4e3b, '<br>', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '3', '1', '');
INSERT INTO `phpshop_categories` VALUES (6, '������������� ����', 1, 5, '0', '3', 0, 0x613a333a7b693a303b733a323a223134223b693a313b733a323a223135223b693a323b733a323a223130223b7d, '\r\n', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (7, '���������� ������', 3, 5, '0', '3', 0, 0x613a333a7b693a303b733a313a2239223b693a313b733a323a223139223b693a323b733a323a223231223b7d, '\r\n', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (8, '����-�������', 2, 5, '0', '3', 0, 0x613a343a7b693a303b733a313a2232223b693a313b733a323a223134223b693a323b733a323a223233223b693a333b733a323a223130223b7d, '\r\n', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (9, '�����-�����-����', 0, 0, '0', '3', 0, 0x4e3b, '\r\n', '', '', '', '�����, �����, ����.', '1', '', '', '0', '', '', '0', '', 'phpshop_1', '', '3', '1', '');
INSERT INTO `phpshop_categories` VALUES (10, '��-����������', 0, 9, '0', '3', 0, 0x613a333a7b693a303b733a313a2237223b693a313b733a313a2232223b693a323b733a323a223130223b7d, '<br>\r\n\r\n\r\n\r\n\r\n\r\n', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (11, '�������� ������������', 0, 9, '0', '2', 0, 0x613a343a7b693a303b733a313a2232223b693a313b733a323a223130223b693a323b733a323a223234223b693a333b733a323a223237223b7d, '<BR>', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
INSERT INTO `phpshop_categories` VALUES (12, 'MP3-������', 0, 9, '0', '3', 0, 0x613a333a7b693a303b733a313a2232223b693a313b733a323a223130223b693a323b733a323a223238223b7d, '\r\n', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');
  
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

INSERT INTO `phpshop_delivery` VALUES
(1, '������', '0', '1', '', '0', '', 0, 0, '1'),
(3, '������ � �������� ����', '180', '1', '0', '0', '0', 1, 0, '0'),
(4, '������ �� ��������� ����', '300', '1', '0', '0', '0', 1, 0, '0'),
(7, '����� ������', '0', '1', '', '0', '', 0, 0, '1'),
(8, '������', '500', '1', '', '0', '', 7, 50, '0'),
(9, '������������', '100', '1', '', '1000', '1', 7, 60, '0');


CREATE TABLE `phpshop_discount` (
  `id` tinyint(11) unsigned NOT NULL auto_increment,
  `sum` int(255) NOT NULL default '0',
  `discount` varchar(64) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


CREATE TABLE `phpshop_foto` (
  `id` int(11) NOT NULL auto_increment,
  `parent` int(11) NOT NULL default '0',
  `name` varchar(64) NOT NULL default '',
  `num` tinyint(11) NOT NULL default '0',
  `info` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_foto` VALUES (292, 1, '/UserFiles/Image/Trial/img1_14820.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (296, 2, '/UserFiles/Image/Trial/img2_61080.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (300, 3, '/UserFiles/Image/Trial/img3_66664.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (7, 4, '/UserFiles/Image/Trial/img4_97080.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (276, 6, '/UserFiles/Image/Trial/img6_20923.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (288, 38, '/UserFiles/Image/Trial/img38_11536.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (280, 7, '/UserFiles/Image/Trial/img7_66247.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (284, 8, '/UserFiles/Image/Trial/img8_13325.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (252, 9, '/UserFiles/Image/Trial/img9_20828.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (258, 10, '/UserFiles/Image/Trial/img10_98700.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (271, 11, '/UserFiles/Image/Trial/img11_15809.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (253, 9, '/UserFiles/Image/Trial/img9_15513.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (327, 13, '/UserFiles/Image/Trial/img13_15367.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (337, 15, '/UserFiles/Image/Trial/img15_13063.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (331, 14, '/UserFiles/Image/Trial/img14_61199.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (339, 16, '/UserFiles/Image/Trial/img16_13068.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (373, 17, '/UserFiles/Image/Trial/img17_35966.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (377, 18, '/UserFiles/Image/Trial/img18_54162.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (381, 19, '/UserFiles/Image/Trial/img19_97642.', 0, '');
INSERT INTO `phpshop_foto` VALUES (385, 20, '/UserFiles/Image/Trial/img20_13117.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (358, 21, '/UserFiles/Image/Trial/img21_10640.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (361, 22, '/UserFiles/Image/Trial/img22_71944.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (365, 23, '/UserFiles/Image/Trial/img23_11103.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (369, 24, '/UserFiles/Image/Trial/img24_19847.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (406, 25, '/UserFiles/Image/Trial/img25_27608.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (422, 26, '/UserFiles/Image/Trial/img26_12295.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (414, 27, '/UserFiles/Image/Trial/img27_57811.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (421, 28, '/UserFiles/Image/Trial/img28_64148.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (423, 29, '/UserFiles/Image/Trial/img29_62370.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (428, 30, '/UserFiles/Image/Trial/img30_20926.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (435, 31, '/UserFiles/Image/Trial/img31_11735.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (437, 32, '/UserFiles/Image/Trial/img32_56526.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (441, 33, '/UserFiles/Image/Trial/img33_20905.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (450, 35, '/UserFiles/Image/Trial/img35_49910.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (453, 36, '/UserFiles/Image/Trial/img36_64985.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (293, 1, '/UserFiles/Image/Trial/img1_15540.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (304, 37, '/UserFiles/Image/Trial/img37_17791.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (301, 3, '/UserFiles/Image/Trial/img3_11413.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (486, 45, '/UserFiles/Image/Trial/img45_67611.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (328, 13, '/UserFiles/Image/Trial/img13_59320.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (297, 2, '/UserFiles/Image/Trial/img2_15458.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (298, 2, '/UserFiles/Image/Trial/img2_16142.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (302, 3, '/UserFiles/Image/Trial/img3_67419.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (305, 37, '/UserFiles/Image/Trial/img37_14361.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (279, 6, '/UserFiles/Image/Trial/img6_81860.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (285, 8, '/UserFiles/Image/Trial/img8_43325.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (286, 8, '/UserFiles/Image/Trial/img8_19919.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (281, 7, '/UserFiles/Image/Trial/img7_20815.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (282, 7, '/UserFiles/Image/Trial/img7_39656.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (277, 6, '/UserFiles/Image/Trial/img6_18424.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (278, 6, '/UserFiles/Image/Trial/img6_12208.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (289, 38, '/UserFiles/Image/Trial/img38_12110.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (290, 38, '/UserFiles/Image/Trial/img38_35567.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (256, 9, '/UserFiles/Image/Trial/img9_47633.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (255, 9, '/UserFiles/Image/Trial/img9_55876.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (259, 10, '/UserFiles/Image/Trial/img10_70506.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (260, 10, '/UserFiles/Image/Trial/img10_99517.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (267, 11, '/UserFiles/Image/Trial/img11_19968.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (268, 11, '/UserFiles/Image/Trial/img11_16800.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (269, 11, '/UserFiles/Image/Trial/img11_15173.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (473, 41, '/UserFiles/Image/Trial/img41_13522.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (332, 14, '/UserFiles/Image/Trial/img14_14799.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (333, 14, '/UserFiles/Image/Trial/img14_16725.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (342, 16, '/UserFiles/Image/Trial/img16_14316.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (335, 15, '/UserFiles/Image/Trial/img15_13938.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (340, 16, '/UserFiles/Image/Trial/img16_95385.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (341, 16, '/UserFiles/Image/Trial/img16_16151.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (374, 17, '/UserFiles/Image/Trial/img17_34086.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (375, 17, '/UserFiles/Image/Trial/img17_18035.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (378, 18, '/UserFiles/Image/Trial/img18_61454.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (379, 18, '/UserFiles/Image/Trial/img18_20302.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (382, 19, '/UserFiles/Image/Trial/img19_10107.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (383, 19, '/UserFiles/Image/Trial/img19_97468.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (386, 20, '/UserFiles/Image/Trial/img20_70570.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (389, 20, '/UserFiles/Image/Trial/img20_35512.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (359, 21, '/UserFiles/Image/Trial/img21_32804.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (357, 21, '/UserFiles/Image/Trial/img21_57890.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (362, 22, '/UserFiles/Image/Trial/img22_10116.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (363, 22, '/UserFiles/Image/Trial/img22_99779.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (366, 23, '/UserFiles/Image/Trial/img23_12441.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (367, 23, '/UserFiles/Image/Trial/img23_50672.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (370, 24, '/UserFiles/Image/Trial/img24_20831.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (371, 24, '/UserFiles/Image/Trial/img24_13073.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (407, 25, '/UserFiles/Image/Trial/img25_38615.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (408, 25, '/UserFiles/Image/Trial/img25_17990.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (426, 29, '/UserFiles/Image/Trial/img29_18781.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (410, 26, '/UserFiles/Image/Trial/img26_39871.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (415, 27, '/UserFiles/Image/Trial/img27_13799.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (416, 27, '/UserFiles/Image/Trial/img27_10423.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (420, 28, '/UserFiles/Image/Trial/img28_12357.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (419, 28, '/UserFiles/Image/Trial/img28_36278.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (424, 29, '/UserFiles/Image/Trial/img29_26450.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (425, 29, '/UserFiles/Image/Trial/img29_15804.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (429, 30, '/UserFiles/Image/Trial/img30_91257.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (430, 30, '/UserFiles/Image/Trial/img30_77562.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (433, 31, '/UserFiles/Image/Trial/img31_62035.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (434, 31, '/UserFiles/Image/Trial/img31_16012.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (438, 32, '/UserFiles/Image/Trial/img32_12719.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (439, 32, '/UserFiles/Image/Trial/img32_74919.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (442, 33, '/UserFiles/Image/Trial/img33_94300.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (443, 33, '/UserFiles/Image/Trial/img33_16896.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (447, 34, '/UserFiles/Image/Trial/img34_18896.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (446, 34, '/UserFiles/Image/Trial/img34_54875.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (451, 35, '/UserFiles/Image/Trial/img35_16730.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (452, 35, '/UserFiles/Image/Trial/img35_79801.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (454, 36, '/UserFiles/Image/Trial/img36_56679.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (455, 36, '/UserFiles/Image/Trial/img36_50315.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (485, 3, '/UserFiles/Image/Trial/img3_12154.', 0, '');
INSERT INTO `phpshop_foto` VALUES (295, 1, '/UserFiles/Image/Trial/img1_14333.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (272, 12, '/UserFiles/Image/Trial/img12_54691.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (274, 12, '/UserFiles/Image/Trial/img12_14304.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (380, 18, '/UserFiles/Image/Trial/img18_37948.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (472, 41, '/UserFiles/Image/Trial/img41_34798.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (261, 10, '/UserFiles/Image/Trial/img10_20493.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (273, 12, '/UserFiles/Image/Trial/img12_39663.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (275, 12, '/UserFiles/Image/Trial/img12_78129.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (283, 7, '/UserFiles/Image/Trial/img7_91321.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (287, 8, '/UserFiles/Image/Trial/img8_21440.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (291, 38, '/UserFiles/Image/Trial/img38_17545.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (299, 2, '/UserFiles/Image/Trial/img2_11819.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (458, 37, '/UserFiles/Image/Trial/img37_11242.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (307, 37, '/UserFiles/Image/Trial/img37_84802.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (360, 21, '/UserFiles/Image/Trial/img21_74428.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (338, 15, '/UserFiles/Image/Trial/img15_14316.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (334, 14, '/UserFiles/Image/Trial/img14_90055.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (336, 15, '/UserFiles/Image/Trial/img15_92385.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (330, 13, '/UserFiles/Image/Trial/img13_53749.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (344, 13, '/UserFiles/Image/Trial/img13_19444.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (364, 22, '/UserFiles/Image/Trial/img22_14431.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (368, 23, '/UserFiles/Image/Trial/img23_16936.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (372, 24, '/UserFiles/Image/Trial/img24_20598.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (376, 17, '/UserFiles/Image/Trial/img17_13782.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (384, 19, '/UserFiles/Image/Trial/img19_12587.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (388, 20, '/UserFiles/Image/Trial/img20_45107.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (409, 25, '/UserFiles/Image/Trial/img25_17522.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (412, 26, '/UserFiles/Image/Trial/img26_77269.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (417, 27, '/UserFiles/Image/Trial/img27_13427.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (418, 28, '/UserFiles/Image/Trial/img28_16567.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (413, 26, '/UserFiles/Image/Trial/img26_19691.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (427, 29, '/UserFiles/Image/Trial/img29_90265.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (431, 30, '/UserFiles/Image/Trial/img30_80985.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (436, 31, '/UserFiles/Image/Trial/img31_15570.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (440, 32, '/UserFiles/Image/Trial/img32_19735.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (444, 33, '/UserFiles/Image/Trial/img33_15359.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (448, 34, '/UserFiles/Image/Trial/img34_52462.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (449, 34, '/UserFiles/Image/Trial/img34_84429.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (456, 36, '/UserFiles/Image/Trial/img36_11726.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (465, 39, '/UserFiles/Image/Trial/img39_44882.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (464, 39, '/UserFiles/Image/Trial/img39_20373.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (463, 39, '/UserFiles/Image/Trial/img39_24753.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (466, 40, '/UserFiles/Image/Trial/img40_23487.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (468, 40, '/UserFiles/Image/Trial/img40_95110.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (470, 40, '/UserFiles/Image/Trial/img40_39656.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (471, 41, '/UserFiles/Image/Trial/img41_20484.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (474, 42, '/UserFiles/Image/Trial/img42_11343.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (475, 42, '/UserFiles/Image/Trial/img42_51122.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (476, 42, '/UserFiles/Image/Trial/img42_38656.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (477, 43, '/UserFiles/Image/Trial/img43_10440.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (478, 43, '/UserFiles/Image/Trial/img43_40796.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (479, 43, '/UserFiles/Image/Trial/img43_15715.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (480, 43, '/UserFiles/Image/Trial/img43_11693.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (481, 44, '/UserFiles/Image/Trial/img44_28040.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (482, 44, '/UserFiles/Image/Trial/img44_38392.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (483, 44, '/UserFiles/Image/Trial/img44_20187.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (484, 44, '/UserFiles/Image/Trial/img44_17963.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (487, 45, '/UserFiles/Image/Trial/img45_19097.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (488, 45, '/UserFiles/Image/Trial/img45_21662.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (489, 45, '/UserFiles/Image/Trial/img45_10530.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (490, 46, '/UserFiles/Image/Trial/img46_41231.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (491, 46, '/UserFiles/Image/Trial/img46_52654.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (492, 46, '/UserFiles/Image/Trial/img46_27775.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (493, 46, '/UserFiles/Image/Trial/img46_82828.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (494, 47, '/UserFiles/Image/Trial/img47_20734.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (495, 47, '/UserFiles/Image/Trial/img47_20257.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (496, 47, '/UserFiles/Image/Trial/img47_10181.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (497, 47, '/UserFiles/Image/Trial/img47_88355.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (498, 48, '/UserFiles/Image/Trial/img48_33520.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (499, 48, '/UserFiles/Image/Trial/img48_14375.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (500, 48, '/UserFiles/Image/Trial/img48_39292.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (501, 48, '/UserFiles/Image/Trial/img48_16392.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (502, 49, '/UserFiles/Image/Trial/img49_35509.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (503, 49, '/UserFiles/Image/Trial/img49_79905.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (504, 49, '/UserFiles/Image/Trial/img49_14919.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (505, 49, '/UserFiles/Image/Trial/img49_16481.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (506, 50, '/UserFiles/Image/Trial/img50_11683.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (507, 50, '/UserFiles/Image/Trial/img50_10982.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (508, 50, '/UserFiles/Image/Trial/img50_20075.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (509, 50, '/UserFiles/Image/Trial/img50_17321.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (510, 51, '/UserFiles/Image/Trial/img51_12553.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (511, 51, '/UserFiles/Image/Trial/img51_10729.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (512, 51, '/UserFiles/Image/Trial/img51_34155.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (513, 51, '/UserFiles/Image/Trial/img51_20327.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (514, 52, '/UserFiles/Image/Trial/img52_49079.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (515, 52, '/UserFiles/Image/Trial/img52_27973.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (516, 52, '/UserFiles/Image/Trial/img52_40737.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (517, 52, '/UserFiles/Image/Trial/img52_36914.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (518, 53, '/UserFiles/Image/Trial/img53_60874.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (519, 53, '/UserFiles/Image/Trial/img53_34463.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (520, 53, '/UserFiles/Image/Trial/img53_22321.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (521, 53, '/UserFiles/Image/Trial/img53_40262.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (522, 54, '/UserFiles/Image/Trial/img54_31886.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (523, 54, '/UserFiles/Image/Trial/img54_23507.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (524, 54, '/UserFiles/Image/Trial/img54_22432.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (525, 54, '/UserFiles/Image/Trial/img54_11723.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (526, 55, '/UserFiles/Image/Trial/img55_83969.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (527, 55, '/UserFiles/Image/Trial/img55_25813.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (528, 55, '/UserFiles/Image/Trial/img55_16476.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (529, 55, '/UserFiles/Image/Trial/img55_26928.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (530, 56, '/UserFiles/Image/Trial/img56_13546.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (531, 56, '/UserFiles/Image/Trial/img56_33843.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (532, 56, '/UserFiles/Image/Trial/img56_28237.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (533, 56, '/UserFiles/Image/Trial/img56_26817.jpg', 0, '');


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


CREATE TABLE `phpshop_jurnal` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user` varchar(64) NOT NULL default '',
  `datas` varchar(32) NOT NULL default '',
  `flag` enum('0','1') NOT NULL default '0',
  `ip` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;



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

INSERT INTO `phpshop_links` VALUES
(1, 'PHPShop Software', '', '�������� ��������-��������, ������ ��������-�������� PHPShop.', 'http://www.phpshop.ru', 5, '1'),
(2, 'PHPShop CMS Free', '', '���������� ��c���� ���������� ������ PHPShop CMS Free.', 'http://www.phpshopcms.ru', 3, '1'),
(3, '������ ��������-��������', '', 'Shopbuilder - ��� ����� SaaS ������ ������ ��������-��������, ����������� ������������� �� ��������� ������ ������� ����������� ���� ��������-�������� �� 599 ���.', 'http://www.shopbuilder.ru', 1, '1');


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


CREATE TABLE `phpshop_news` (
  `id` int(11) NOT NULL auto_increment,
  `datas` varchar(32) NOT NULL default '',
  `zag` varchar(255) NOT NULL default '',
  `kratko` text NOT NULL,
  `podrob` text NOT NULL,
  `datau` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


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


CREATE TABLE `phpshop_opros` (
  `id` int(11) NOT NULL auto_increment,
  `category` int(11) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `total` int(11) NOT NULL default '0',
  `num` tinyint(32) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_opros` VALUES
(1, 1, '��', 23, 0),
(2, 1, '���������', 7, 0),
(3, 1, '�� �����', 7, 0),
(4, 2, '��, �� ������ ����� � ���', 66, 0),
(5, 2, '��, ����, ���� ���������� ������� ��� �����', 62, 0),
(6, 2, '���, �� ���� ������', 114, 0);

CREATE TABLE `phpshop_opros_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `dir` varchar(32) NOT NULL default '',
  `flag` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_opros_categories` VALUES
(1, '��� �������� ����� ������?', '', '0'),
(2, '����� �� ���  ����� ������������ �� �������� ��������-�������� �� ���/� ����? ', '', '1');

CREATE TABLE `phpshop_order_status` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `color` varchar(64) NOT NULL default '',
  `sklad_action` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_order_status` VALUES
(1, '�����������', 'red', ''),
(2, '�����������', '#99cccc', ''),
(3, '������������', '#ff9900', ''),
(4, '��������', '#ccffcc', '1'),
(100, '�������� � �����������', '#ffff33', '');

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


DROP TABLE IF EXISTS phpshop_page;
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



INSERT INTO `phpshop_page` VALUES (11, '�����-�����', 'page11', 1000, '', '', '<h2>����������, ��� ����� � ������ �������� � ��������, ����������, ��������, ��������� � PHPShop!</h2><br><br>��� �����-����� �������� � <a href="http://www.phpshop.ru/help/" target="_blank">on-line �������� PHPShop</a>.<br><br><br>\r\n<object height="385" width="480"><param name="movie" value="http://www.youtube.com/v/AKEMaJwTryo&amp;amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;amp;fs=1?rel=0"><param name="allowFullScreen" value="true"><param name="allowscriptaccess" value="always">\r\n<embed src="http://www.youtube.com/v/AKEMaJwTryo&amp;amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" height="385" width="480"></object><br><br>\r\n<object height="385" width="480"><param name="movie" value="http://www.youtube.com/v/LrqW9lzLxcM&amp;amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;amp;fs=1?rel=0"><param name="allowFullScreen" value="true"><param name="allowscriptaccess" value="always">\r\n<embed src="http://www.youtube.com/v/LrqW9lzLxcM&amp;amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" height="385" width="480"></object><br><br>\r\n<object height="385" width="480"><param name="movie" value="http://www.youtube.com/v/XPuuJD6maXQ&amp;amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;amp;fs=1?rel=0"><param name="allowFullScreen" value="true"><param name="allowscriptaccess" value="always">\r\n<embed src="http://www.youtube.com/v/XPuuJD6maXQ&amp;amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" height="385" width="480"></object><br><br><br><br>��� �����-����� �������� � <a href="http://www.phpshop.ru/help/" target="_blank">on-line �������� PHPShop</a>\r\n', '', 1, 1323776460, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (8, '��� ������� ���� ��������������?', 'page8', 1, '������ �����, cms, ��� ������� ����, ������� ������ �����, ������ �����', '��� ������� ����? ���� ������ ������� ��������� �����. ������ ������� ���� �������� � ��������� ����� ����� � �������, ��� �� �������. ����, ��� ����, ����� ������� ����������� ����, ����� �������, ������, ������ � �������. ���� ��� ����� ��� �� �������,', '<p>��� ������� ����? ���� ������ ������� ��������� �����.\r\n������ ������� ���� �������� � ��������� ����� ����� � �������, ��� �� �������.\r\n����, ��� ����, ����� ������� ����������� ����, ����� <i>�������, ������, ������ </i>�<i> �������</i>.\r\n���� ��� ����� ��� �� �������, �� ���������, ���� � �������� � ������ �� ���.</p><p><i>�������</i> � ���\r\n������ �� ���������� ����� � ����. �� ������ ������� ������� ��� ����������\r\n�������, ������ ������ � ������ ������ ����� ������ ��� ����������� ��������. �\r\n���� ��, ������� ���� ����� �������, ������ ���� �� �������� �� �������\r\n��������. ��� ������� ��������<span></span>�������������� �������� ��� (����� �����������\r\n���� ��������) � �� ������ ������������ ����� ����&nbsp; www.�����.net (.ru,� �.�.). ��� ������ ������\r\n������ 2 ������� �������: ��� ������ ���� �� ������� ������� � ������ �����\r\n������������.</p><p><i>������</i> ����� (CMS)&nbsp; � ��� ���������, ����������� ������������ ��������������\r\n����� � ������������. � �� ������, ������ � ��� � ���� ��� ����. ��������, ���\r\n�� ���� ������� ����������������, ������� ������ �������������� ����������. �������,\r\n�� ������ ���������� � ������� ������������, ������ ���������� ��� �������\r\n�������, �, ��� �� �������, ��������� ��\r\n��� ��������� �, � �� �� �����, �����������!</p><p>� �������, ��������� ������������ ������� ���������� ������\r\n���������� ������������� ����������� <a href=\\"http://www.phpshopcms.ru/\\">PHPShop Software</a>. CMS ��\r\nPHPShop ���������\r\n��������� � �������� ��� �������� ����� ����� ���������: �� ������ ��������� ��\r\n����������������� ��������. ��� ����� ����� ���� ������� ��������� � ����\r\n�����!</p><p>��������� �����\r\n��������� ����� ����� � ���������� ��������� Windows. ����������� ��� �������� ����� ��������� ������� <a href=\\"http://demo.phpshop.ru/\\">����-������</a> �� ����� �������������.</p><p>������� ���� ����� ����������� ��� �� ������ �<i> ��������</i>. ��������, PHPShop �������������\r\n�� ����� ����� 35 ���������� ���������\r\n������� �� ����� ����. ���� �� �� ����� ������ �����������, ���������� �\r\n���������� � �� ��� CMS ����� ��������� ����� ������.</p><p>����, �� ������� (������, �������) CMS. ������ ��� ��������� �������\r\n��������� � ������ ��������� ����<i> ���������</i>,\r\n�� ���� ����������. ���������� �� ����� ������ � ����������! ����������, �������\r\n� ���, ��������� ������ ����������� ����� ������������� ��� ���� � ��\r\n���������� ������� ������� ��� ������� ��������� ����������, ������������ �� ��\r\n��������� ����� � ����������, ������ ������ ��� �������� ������ � �����������\r\n������������� ������.</p><br>\r\n\r\n\r\n\r\n\r\n\r\n', '', 8, 1321537276, '', '��� ������� ���� ��������������', '1', '', '');
INSERT INTO `phpshop_page` VALUES (2, '����� � 1�', 'page2', 1000, '', '', '<div><h2>�����-����� �� ������ � 1�-��������������</h2>������� ��������� �����-����� �� ������ � 1�-�������������� ��� PHPShop Pro 1C! ����� ��������� �� �������� ��������� ����������� ����� ��� 1� ������ 7.7 � 8.1.<br><br>��� �����-����� �������� �&nbsp;<a href="http://www.phpshop.ru/help/" target="_blank">on-line �������� PHPShop</a>.<br></div><br><iframe src="http://www.youtube.com/embed/9NXxoStHEh0" allowfullscreen="" frameborder="0" height="360" width="480"></iframe><div><br></div><div><br><br ><iframe src="http://www.youtube.com/embed/bRp07UeoX5A" allowfullscreen="" frameborder="0" height="360" width="480"></iframe><br></br ></div><div><br ><br ><object height="385" width="480"><br></object></br ></br ></div><div><br ><br ><object height="385" width="480"><br></object></br ></br ></div><div><br ><br ><object height="385" width="480"><param name="movie" value="http://www.youtube.com/v/dk6ULAmGGvI&amp;amp;hl=ru_RU&amp;amp;fs=1?rel=0"><param name="allowFullScreen" value="true"><param name="allowscriptaccess" value="always"><embed src="http://www.youtube.com/v/dk6ULAmGGvI&amp;amp;hl=ru_RU&amp;amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" height="385" width="480"></object><br><br><strong></strong>��� �������� �����:<br><div><a href="http://phpshop.ru/loads/ThLHDegJUj/setup.exe" target="_blank">��������� PHPShop EasyControl(~ 8 Mb)</a><br><a href="http://phpshop.ru/help/Content/install/phpshop_server.html#1" target="_blank">���������� ���������� �� PHPShop EasyControl</a><br>������ ������� ������������� �� �������� 8-800-700-11-15, ������ ���������� �� ��.</div></br ></br ></div><div></div>\r\n\r\n', '', 2, 1323776456, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (15, '��� ����� � �����������?', 'page15', 1, '', '', '<img src="" alt="" align="" border="0px">� ������� �������� ����� ������� Ctrl+F5, ���������� �������� �������, - �������� ������ ������ ������, ��������� ��� ���������. �� ����� ����-������ ��� ����� ��� ���������: demo � demouser.<div><br></div><div><img src="/UserFiles/Image/Trial/str2.png" alt="" align="" border="0px"></div>\r\n\r\n\r\n\r\n\r\n', '', 1, 1323769257, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (3, '������ ��������', 'page3', 1000, '', '', '<h2>�������� ������� "������� �����������"��� ������� �������� PHPShop! </h2>\r\n<div>��� ������� ������� �������� ��������-�������� PHPShop �������� ������� "������� �����������", � ���������� ��������� � ���������� �����������.<br><br>������� ������ � ����������� �������� ���������� ������ �� ������, ��� �������� ����� �������� �� � <a href="http://www.phpshop.ru/docs/adres.html">����� ��������</a>, ��� <a href="http://www.phpshop.ru/option/blok.rar">������� � ��. ����</a> (win rar, ~7 ��).</div>\r\n<div><br><b><img alt="" src="/UserFiles/Image/Trial/broshura.jpg" border="0" height="218" width="277"><br><br>1. �������� </b></div>\r\n<div>1.1. ��� ����� PHPShop? </div>\r\n<div>1.2. ������� ��������� ������</div>\r\n<div>1.3. ��������� ����������</div>\r\n<div>1.4. ���������</div>\r\n<div>1.5. ��� ����� PHPShop EasyControl </div>\r\n<div>1.6. ��������� �� �������</div>\r\n<div><b></b><b>2</b><b>. ������ ������</b></div>\r\n<div>2.1. ��������� PHPShop</div>\r\n<div>2.2. ���������, �������</div>\r\n<div>3. Keywords &amp; Titles </div>\r\n<div>2.4. �������� ������ �������� �������</div>\r\n<div>2.5. �������� ������ �����������</div>\r\n<div>2.6. �������� ������ ������</div>\r\n<div>2.7. ������ � �������������</div>\r\n<div>2.8. ������ � ����������������</div>\r\n<div>2.9. �������������� �������� ���� ����� Ex�el </div>\r\n<div>2.10. �������������� �������� �����-����� ����� Ex�el </div>\r\n<div><b>3. ����� � 1�:�����������</b></div>\r\n<div>3.1. ��������� � ����������</div>\r\n<div>3.2. ��� �������� ����� � 1�:�����������?</div>\r\n<div><b>4. ��������� �������</b></div>\r\n<div>4.1. ��� �������� �������?</div>\r\n<div>4.2. ��� �������� ��������� � "�����" �����?</div>\r\n<div>4.3. ��� �������� �������� ������� ��������?</div>\r\n<div>4.4. ��� �������� ������� �����?</div>\r\n<div>4.5. ��� ������� ����� ������������� ����?</div>\r\n<div>4.6. ��� �������� ��� ������?</div>\r\n<div><b>5. ������ �������</b></div>\r\n<div>5.1. ����������� ����������� �������� ������</div>\r\n<div>5.2. ������ � �������</div>\r\n<div>5.3. ������ �������� ������������� </div>\r\n<div>5.4. � ���� ������ ������������� ������� c 1C \r\n<div>\r\n<div>5.5. ������ ������ �������</div>\r\n<div>5.6. ���������� ����������� ��������-�����<br>5.7. ��� ������ ������ � ������ ���������.</div></div></div>\r\n<p></p>\r\n\r\n', '', 3, 1323776453, '', '�������� ������� "������� �����������"��� ������� �������� PHPShop!', '1', '', '');
INSERT INTO `phpshop_page` VALUES (4, '��������', 'page4', 1000, '', '', '<h1>��������!!!!</h1><h1>�� ���������� � ����-������ ������� ��������-�������� PHPShop!</h1><h2>��������&nbsp;��� "������"</h2><p>�� ������ ���������&nbsp;<a title="������� ���� �� ����������� ���������  ��������-��������" href="http://www.phpshop.ru/brif_tz.doc" target="_blank">���� �� ����������� �������</a>, ����&nbsp;<a title="������� ���� �� ������������ ������" href="http://www.phpshop.ru/brif_person_diz.doc" target="_blank">���� �� ������������ ������ �����</a>, ���� �������� ������������ ��� �������:<br>������ �������� -&nbsp;<a href="mailto:client@phpshop.ru">client@phpshop.ru</a>, ����<br>��������he ��������-&nbsp;<a href="mailto:manager@phpshop.ru">manager@phpshop.ru</a>.<br><br>������������ ��������, ���������� ��������� � ����� �� ��������������� ������<br>�� ���������:<br><br><b>8-800-700-11-15&nbsp;</b>(������ ���������� �� ��)<br>(495) 989-11-15, � ������������ �� �������.<br><br>��-��: 10:00-19:00<br><br>�����: �.�����������, ��.������������, �.41�, 1 �������, 2 ����, ���� 1, ������ �������� "PHPShop".</p><p><br><br><iframe marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=ru&amp;geocode=&amp;q=%D0%BC%D0%BE%D1%81%D0%BA%D0%B2%D0%B0%20%D0%A9%D0%B5%D1%80%D0%B1%D0%B0%D0%BA%D0%BE%D0%B2%D1%81%D0%BA%D0%B0%D1%8F%2041%D0%90&amp;sll=37.0625,-95.677068&amp;sspn=38.911557,92.460937&amp;ie=UTF8&amp;z=14&amp;iwloc=addr&amp;ll=55.789798,37.737522&amp;output=embed&amp;s=AARTsJo2eyEHGgOG1Dn0YvjwnwUo0H8bFA" frameborder="0" height="350" scrolling="no" width="425"></iframe><br><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=ru&amp;geocode=&amp;q=%D0%BC%D0%BE%D1%81%D0%BA%D0%B2%D0%B0%20%D0%A9%D0%B5%D1%80%D0%B1%D0%B0%D0%BA%D0%BE%D0%B2%D1%81%D0%BA%D0%B0%D1%8F%2041%D0%90&amp;sll=37.0625,-95.677068&amp;sspn=38.911557,92.460937&amp;ie=UTF8&amp;z=14&amp;iwloc=addr&amp;ll=55.789798,37.737522" style="color:#0000FF;text-align:left">���������� ����������� �����</a></small><br><br></p>\r\n', '', 4, 1323776450, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (17, '��� ������� ������?', 'page17', 1, '', '', '��� �������� ������, � ����������� �������� ���� <i>������ - ������� - ����� ��������</i>. &nbsp;����� ����� ������� �������, � �������� ����� ������������ ��������, ��������, � � �������� ���������� ������ ������ �����.<div><br></div><div><img src="/UserFiles/Image/Trial/str3.png" alt="" align="" border="0px"></div>\r\n\r\n\r\n', '', 3, 1323769312, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (18, '��� ������� �����? ', 'page18', 1, '', '', '� ����� ������ ������� � ���� <i>������� - ������� - ����� �����. &nbsp;</i><div><i><br></i></div><div><img src="/UserFiles/Image/Trial/str4.png" alt="" style="border-top-style: none; border-top-width: initial; border-top-color: initial; " align="" border="0"><i><br></i><div><i><br></i></div><div>����� �������� � ���������� �������� ���� �� ������ �������� � <a href="http://wiki.phpshop.ru/index.php/Help_Enterprise" target="_blank">��������</a>, ��� ��������� <a href="http://www.youtube.com/user/phpshopsoftware" target="_blank">�����-�����</a>.</div></div>\r\n\r\n\r\n', '', 2, 1323769287, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (19, '��� �������� ������� ����?', 'page19', 1, '', '', '����� �������� ������ ���� (������� ����), ���� ����� � ����������� (Cntrl+F12 � ������� ����� �����), ������� ���� ������ - ����� - ��������. ������ �� ������� �������� �������. �������� ������� ���� - ������� ���� �����. ����� ����� ���� ��������, �� ����� �������, �������������, ��������� �����.<div><br></div><div><img src="/UserFiles/Image/Trial/str5.png" alt="" align="" border="0px"></div>\r\n', '', 5, 1323769316, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (20, '������������� �����-����', 'page20', 1, '', '', '<div>������ �������� ������������� ����� �����-����� � ���� "�����-����", ������� ��������� ������� ������� � ����� ��������� ������ �������, �� ������ �� ����!</div><div><br></div><div><img src="/UserFiles/Image/Trial/str6.png" alt="" align="" border="0px"></div><div><br></div><div><br></div><iframe src="http://www.youtube.com/embed/1_X5qHyphTI?rel=0" allowfullscreen="" frameborder="0" height="360" width="480"></iframe><div><br></div>\r\n\r\n', '', 10, 1323769319, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (1, '�������� ������� ��������', 'page1', 2000, '', '', '�������� ������ ��������, ������ ������� ������������ � ����������� ��������.&nbsp;�������� ������ ���� �������� 150 ����, � �������� � ���� �������� �������� �����, ������� �� ��������� � Title. ��� ������ ���������� �����, ��� ���� �� �������� ��� ������ ����. ����� ����� ��� ���������� ������� ���������� �������� ��� ������� ������.&nbsp;<div><div><div><div style=\\"PADDING-BOTTOM: 10px; PADDING-LEFT: 10px; PADDING-RIGHT: 10px; PADDING-TOP: 10px\\" align=\\"center\\"><br></div>\r\n</div></div></div>\r\n\r\n\r\n\r\n', '', 0, 1321534107, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (13, '��� �������� �������� ������� ��������?', 'page13', 1, '', '', '<img src="" alt="" align="" border="0px">����� ��������������� ���� �����, ����� ����� � ���� ����������� PHPShop:&nbsp;<i>������ - ����� - ��������</i>, �������� �������&nbsp;<i>����</i>, � ��������<i>&nbsp;��������� ��������</i>. ����� ����� ������� ��������, � ������������� ����� � ��������&nbsp;<i>����������</i>.<div><br>&nbsp;\r\n\r\n<div><img src="/UserFiles/Image/Trial/str1.png" alt="" align="" border="0px"></div>\r\n</div>\r\n\r\n\r\n', '', 4, 1323769323, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (12, '��� ������ ����� ������ �����?', 'page12', 1, '', '', '<div style="height: 100%; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; background-image: none; background-attachment: scroll; background-origin: initial; background-clip: initial; background-position: 50% 50%; background-repeat: no-repeat no-repeat; "><font class="Apple-style-span" size="2">�������������� ������� ������� �� id: ���������� �� ������ ����� ������&nbsp;<a href="http://ishop.phpshop-partners.ru/shop/UID_38.html">ishop.phpshop-partners.ru/shop/UID_38.html</a>, UID_38- ��� ��� id. ������ � ����������� ��������� � ������ <i>������� - �������� �����������</i> � � ���� <i>�����</i> ������ 38, ������� <i>��������</i> - ������ ������ ������� ������ �����:)&nbsp;</font></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '', 5, 1323769326, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (14, '��� ������������ ������� ����������� ���������?', 'page14', 1, '', '', '<p>������ ��������� ��������� �������� �������� �� ����������� �������, � � ������ ������� ������������ ������ ��������� �������� ����� � ���� ��������� �������� �� ������. ��� ������� �������� ������������ ������ �������, � ������� �������������� ���������� �������� �������, � ��� �� �������� ���������� � ������������ �������. ��� ������ ����� ������ ��������� �����, �������� ��� ����������� ��� ������, ������� ����� ������ ������ �� ����� �������.</p><iframe src="http://www.youtube.com/embed/a43-bhA2mqM?rel=0" allowfullscreen="" frameborder="0" height="360" width="480"></iframe>\r\n', '', 7, 1323769330, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (16, '��� ��������� ��������� ����-���� Title, Description, Keywords?', 'page16', 1, '', '', '<p>����� ����, ��� �� ������� 2-4 �������� ������ ��� ��������������, �� ������� ������, ����� ��� �������� � ����, &nbsp;����� ��������� ����-���� � PHPShop. � ����������� �������� (��� ���� ������� ������� ����), �������� ���� <i>������ - Keywords&amp;Titles</i>, ����� ���� �������� ���� � ����� ������ ��� ����-����� � <i>Title, Description, Keywords</i>.</p><div><p><i>Title</i> - ����� ������� ����-���, �� ������� ���������� �������� ��������, ��� ����� ��������� �����������. <b>����� �� ����� 80 ��������</b>, � ������ ������� ���������� �������� �������� ��� ��� ����� �� ���� ��������, �������� ����� ���� ����� ��� ������� ����� ��������, �� � ��������� �������, �.�. ������������ ��������� �� ����� ������ ��� �� ��������, � �� ��������� �����. Title ����������� ������ ���� ���������� ��� ������ ��������, ��� ����� � PHPShop � ������ �������� � �������� ������ ���� ����� �� ����, ��� � ��� ������� ��������, ������� �� ������ ���������, � ����� ������� �������������� ��������� ����-����� �� ������ �������� ��������, ������. ��� ������������� �� ������ �� �������������, �������� ��������� ������� ��� ������� ��������, �������� � �����������.</p><p>��� <i>Description</i> ����� ������ ��� ������������, ������ ������ ���������� ����� ��������, ������� ������� ��� ������� �� ����, ������ �� ����� ����. ����� ������� ��������� �������� ����� �� ���� �������� �� ����������, � ���������� ����� � ������������� �����������, ������� ������������ ����� ��������� � ������. ����� ��������� � ������ ��� ���������� �����������. <b>���������� �������� � �� ����� 150-200.</b></p><p>��� <i>Keywords</i> �� ������� �� ��� ��������� � ����������� ��-�� ��������������� ���������, ����������� � ���� ��� ����� ����. ������ ���������� ���������� ���� ���, ������ ��������� ��� ����� � ����������� ��� �� ��������. <b>������� �� ��������� ����� 3-4 ��� ���� � �� �� �������� �����, � ����� �������� ����� ���������� ����� ���� ��� �������</b>, ��������: "��������� �������", "�������� ������ ������", "������ ������", "������� ������ ������" ����� ���������� � ��������������: "��������� ������� ������ ������ �������".</p></div>\r\n\r\n\r\n\r\n', '', 6, 1323769333, '', '', '1', '', '');
          

CREATE TABLE `phpshop_page_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `num` int(64) NOT NULL default '1',
  `parent_to` int(11) NOT NULL default '0',
  `content` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `parent_to` (`parent_to`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


INSERT INTO `phpshop_page_categories` VALUES (1, '��������� :)', 0, 0, '');


CREATE TABLE `phpshop_payment` (
  `uid` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `sum` float NOT NULL default '0',
  `datas` int(11) NOT NULL default '0',
  PRIMARY KEY  (`uid`),
  KEY `order` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

CREATE TABLE `phpshop_payment_systems` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `path` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '1',
  `num` tinyint(11) NOT NULL default '0',
  `message` text NOT NULL,
  `message_header` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_payment_systems` VALUES
(1, '���� � ����', 'bank', '1', 0, '���� ��������� �������� � ����. ���� �������� � ������ ��������.', '��� ����� ������� ��������'),
(2, '��������� ���������', 'sberbank', '1', 0, '��������� ��������� ��������� � ������ ��������.', '��� ����� ������� ��������'),
(3, '�������� ������', 'message', '1', 0, '� ��������� ����� � ���� �������� ��� ��������.', '��� ����� ������� �������� '),
(4, 'Visa, Mastercard (PayOnlineSystem)', 'payonlinesystem', '1', 0, '������� �� �������', '��� ����� �������'),
(5, 'WebMoney, Yandex Money (ROBOXchange)', 'robox', '1', 0, '��� ����� �������', '��� ����� �������'),
(6, 'WebMoney', 'webmoney', '1', 0, '��� ����� �������', '��� ����� �������'),
(7, 'Visa (ActivePay)', 'activepay', '1', 0, '��� ����� �������', '��� ����� �������'),
(8, 'Visa, Mastercard, Webmoney, Yandex (Platron)', 'platron', '1', 0, '��� ����� �������', '��� ����� �������');

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
  `uid` varchar(64) NOT NULL default '',
  `spec` enum('0','1') NOT NULL default '0',
  `odnotip` varchar(64) NOT NULL default '',
  `vendor` varchar(255) NOT NULL default '',
  `vendor_array` blob NOT NULL,
  `yml` enum('0','1') NOT NULL default '0',
  `num` int(11) NOT NULL default '1',
  `newtip` enum('0','1') NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `title_enabled` enum('0','1','2') NOT NULL default '0',
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
  `parent` text NOT NULL,
  `items` int(11) NOT NULL default '0',
  `weight` float NOT NULL default '0',
  `price2` float NOT NULL default '0',
  `price3` float NOT NULL default '0',
  `price4` float NOT NULL default '0',
  `price5` float NOT NULL default '0',
  `files` text NOT NULL,
  `baseinputvaluta` int(11) NOT NULL default '0',
  `ed_izm` varchar(255) NOT NULL default '',
  `dop_cat` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `category` (`category`),
  KEY `enabled` (`enabled`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_products` VALUES (1, 2, '���� BINATONE SI 2000 A', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n\r\n\r\n', '<div>���� � ����� SI-2000A<br>\r\n<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p></div>\r\n<div>��������� ������������� ������<br>����������� ����� ������<br>������� �����������<br>����� ��� ������� �����<br>������ ��������� � ���������</div>\r\n\r\n\r\n', 500, 0, '0', '1', '1', '', '1', '3,37', 'i23-47ii5-9i', 0x613a323a7b693a32333b613a313a7b693a303b733a323a223437223b7d693a353b613a313a7b693a303b733a313a2239223b7d7d, '', 0, '1', '', '0', 1321625030, 'page2,', 1, '', '0', '@Product@', '', '������ ����', '1', '', '/UserFiles/Image/Trial/img1_14333s.jpg', '/UserFiles/Image/Trial/img1_14333.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 30, 100, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (2, 2, '���� BINATONE SI-2000 WG', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n', 600, 0, '0', '1', '1', '', '1', '3,37', 'i23-45ii5-9i', 0x613a323a7b693a32333b613a313a7b693a303b733a323a223435223b7d693a353b613a313a7b693a303b733a313a2239223b7d7d, '', 0, '1', '', '0', 1278410852, 'page5,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img2_11819s.jpg', '/UserFiles/Image/Trial/img2_11819.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 100, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (3, 2, '���� BINATONE SI 2600 W', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n\r\n\r\n', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n\r\n\r\n', 650, 0, '0', '1', '1', '', '1', '1,2', 'i23-46ii5-10i', 0x613a323a7b693a32333b613a313a7b693a303b733a323a223436223b7d693a353b613a313a7b693a303b733a323a223130223b7d7d, '', 0, '1', '', '0', 1321625127, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img3_66664s.jpg', '/UserFiles/Image/Trial/img3_66664.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 34, 400, 0, 0, 0, 0, 'a:1:{i:0;s:26:"/UserFiles/Image/chars.rar";}', 6, '', '');
INSERT INTO `phpshop_products` VALUES (6, 3, '������� ��� ������� PHILIPS QC 5050', '����� ������� ������ �������� ��������� ������ � �������� ��������. ������� ��� ������� ����� Complete Control ���� ������������ �������� � ���������� ����������.\r\n', '<span style=\\"font-family: Arial;\\">����� ������� ������ �������� ��������� ������ � �������� ��������. ������� ��� ������� ����� Complete Control ���� ������������ �������� � ���������� ����������.</span><br><br>\r\n', 1000, 0, '0', '1', '1', '', '1', '7,8', 'i2-1ii14-98ii23-45i', 0x613a333a7b693a323b613a313a7b693a303b733a313a2231223b7d693a31343b613a313a7b693a303b733a323a223938223b7d693a32333b613a313a7b693a303b733a323a223435223b7d7d, '', 0, '1', '', '0', 1278409987, 'page2,', 1, '', '0', '', '', 'PHILIPS', '1', '', '/UserFiles/Image/Trial/img6_81860s.jpg', '/UserFiles/Image/Trial/img6_81860.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 5, 140, 0, 0, 0, 0, 'N;', 5, '', '');
INSERT INTO `phpshop_products` VALUES (7, 3, '������� ��� ������� PHILIPS QC 5070', 'Philishave Super Easy. ������� � ������������� ������� ��� ������� ����� � 8 ����������� ����� (1-21 ��), ������ ��������� Flexcomb � ���������� �����. �������� ������� � �������� �������� - ������ � ������.\r\n', 'Philishave Super Easy. ������� � ������������� ������� ��� ������� ����� � 8 ����������� ����� (1-21 ��), ������ ��������� Flexcomb � ���������� �����. �������� ������� � �������� �������� - ������ � ������.\r\n', 2400, 0, '0', '1', '1', '', '1', '5,38', 'i2-1ii14-98ii23-46i', 0x613a333a7b693a323b613a313a7b693a303b733a313a2231223b7d693a31343b613a313a7b693a303b733a323a223938223b7d693a32333b613a313a7b693a303b733a323a223436223b7d7d, '', 0, '1', '', '0', 1278410429, 'page3,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img7_91321s.jpg', '/UserFiles/Image/Trial/img7_91321.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 45, 200, 0, 0, 0, 0, 'N;', 6, '��.', '');
INSERT INTO `phpshop_products` VALUES (8, 3, '������� ��� ������� PHILIPS QC 5099', 'Philishave MaxPricision. �� ������� � �������� �������� ������� ����������� ����� ���������������� �������. ������� ��� ������� ����� MaxPrecision ����� 15 �������� ����� (1-41 ��) � �������� ������������ ������� ��� �������� ���������� ��������.\r\n', 'Philishave MaxPricision. �� ������� � �������� �������� ������� ����������� ����� ���������������� �������. ������� ��� ������� ����� MaxPrecision ����� 15 �������� ����� (1-41 ��) � �������� ������������ ������� ��� �������� ���������� ��������.\r\n', 2600, 0, '0', '1', '1', '', '1', '38,6', 'i2-2ii14-98ii23-47i', 0x613a333a7b693a323b613a313a7b693a303b733a313a2232223b7d693a31343b613a313a7b693a303b733a323a223938223b7d693a32333b613a313a7b693a303b733a323a223437223b7d7d, '', 0, '1', '', '0', 1278410487, 'page5,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img8_21440s.jpg', '/UserFiles/Image/Trial/img8_21440.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 38, 300, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (9, 4, '������������� BINATONE AEJ-1501 CG|WG', '������ �� ������ ��� ���� �������������� ��� ��������� ����������� 1.5 � ����� ������ ���� �������� 2000 �� �������� ��������� ������\r\n\r\n\r\n\r\n\r\n\r\n', '������ �� ������ ��� ���� �������������� ��� ��������� ����������� 1.5 � ����� ������ ���� �������� 2000 �� �������� ��������� ������\r\n\r\n\r\n\r\n\r\n\r\n', 300, 500, '0', '1', '1', '100', '1', '11,12', 'i2-96ii23-47i', 0x613a323a7b693a323b613a313a7b693a303b733a323a223936223b7d693a32333b613a313a7b693a303b733a323a223437223b7d7d, '', 1, '1', '', '0', 1321623565, 'page2,', 1, '', '0', '', '', '������ �������������', '1', '', '/UserFiles/Image/Trial/img9_47633s.jpg', '/UserFiles/Image/Trial/img9_47633.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 50, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (10, 4, '������������� BINATONE CEJ-1012 CP', '��� ��������������� ��������: ������� (��������) �������� ��������������� ��������: ����������� ����� ��������: 1500 �� �����: 1 � ������ ������ ������: �������������\r\n\r\n\r\n\r\n', '��� ��������������� ��������: ������� (��������) �������� ��������������� ��������: ����������� ����� ��������: 1500 �� �����: 1 � ������ ������ ������: �������������\r\n\r\n\r\n\r\n', 700, 965, '0', '1', '1', '', '1', '11,12', 'i2-96ii23-47i', 0x613a323a7b693a323b613a313a7b693a303b733a323a223936223b7d693a32333b613a313a7b693a303b733a323a223437223b7d7d, '', 2, '1', '', '0', 1321623580, 'page3,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img10_20493s.jpg', '/UserFiles/Image/Trial/img10_20493.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 44, 150, 0, 0, 0, 0, 'N;', 6, '', '#1#3');
INSERT INTO `phpshop_products` VALUES (11, 4, '������������� BINATONE CEJ-3300 CP|SG|T|WG', '��� ��������������� ��������: ������� (��������) �������� ��������������� ��������: ����������� ����� �������� (��): 2200 ����� (�): 2 ������ ������ ������: �������������\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '��� ��������������� ��������: ������� (��������) �������� ��������������� ��������: ����������� ����� �������� (��): 2200 ����� (�): 2 ������ ������ ������: �������������\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 1000, 0, '0', '1', '1', '', '1', '9,10', 'i2-1ii23-45i', 0x613a323a7b693a323b613a313a7b693a303b733a313a2231223b7d693a32333b613a313a7b693a303b733a323a223435223b7d7d, '', 3, '1', '', '0', 1321623587, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img11_15809s.jpg', '/UserFiles/Image/Trial/img11_15809.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 65, 150, 0, 0, 0, 0, 'N;', 6, '�����', '');
INSERT INTO `phpshop_products` VALUES (12, 4, '������������� BINATONE CEJ-3500 BB|BS|CP', 'MAGIC - thermo control, 2200��, 2�., ����� ����������, ����������� ���������� ����������� ���� � ������� �� ����� ���������� ���������: - ����� - ����������� ���� �� 40�C, - ������ - ����������� ���� �� 40�C �� 80�C,�� 80�C - �������, ������ �����\r\n\r\n\r\n\r\n', 'MAGIC - thermo control, 2200��, 2�., ����� ����������, ����������� ���������� ����������� ���� � ������� �� ����� ���������� ���������: - ����� - ����������� ���� �� 40�C, - ������ - ����������� ���� �� 40�C �� 80�C,�� 80�C - �������, ������ �����\r\n\r\n\r\n\r\n', 875, 0, '0', '1', '1', '', '1', '9,10', 'i2-2ii23-46i', 0x613a323a7b693a323b613a313a7b693a303b733a313a2232223b7d693a32333b613a313a7b693a303b733a323a223436223b7d7d, '', 4, '1', '', '0', 1321623593, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img12_78129s.jpg', '/UserFiles/Image/Trial/img12_78129.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 55, 300, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (13, 6, '������������� ���� DELONGHI MW 355', '������������ ���������� ������ �� 30 ��� �������� ������ ���������� ���� �������� ��������� 700 �� EMD ���������� ������� �������� 5\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '������������ ���������� ������ �� 30 ��� �������� ������ ���������� ���� �������� ��������� 700 �� EMD ���������� ������� �������� 5\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 1578, 0, '0', '1', '1', '', '1', '15,16', 'i14-26ii15-31ii10-19i', 0x613a333a7b693a31343b613a313a7b693a303b733a323a223236223b7d693a31353b613a313a7b693a303b733a323a223331223b7d693a31303b613a313a7b693a303b733a323a223139223b7d7d, '', 0, '1', '', '0', 1278414654, 'page2,', 1, '', '0', '', '', '������������� ����', '1', '', '/UserFiles/Image/Trial/img13_19444s.jpg', '/UserFiles/Image/Trial/img13_19444.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 199, 4, 0, 0, 0, 0, 'N;', 6, '��', '');
INSERT INTO `phpshop_products` VALUES (14, 6, '������������� ���� MOULINEX AFM4 43', '����� 22 � ��� ���������� ��������� ���������� ����� 290 �� �������� �������� ����������, �� 850 ������������ �������� �����, �� 1100 �������������� ������� ����� ��� ������� �������� - 6\r\n\r\n', '����� 22 � ��� ���������� ��������� ���������� ����� 290 �� �������� �������� ����������, �� 850 ������������ �������� �����, �� 1100 �������������� ������� ����� ��� ������� �������� - 6\r\n\r\n', 3000, 0, '0', '1', '1', '', '1', '15,16', 'i14-27ii15-30ii10-19i', 0x613a333a7b693a31343b613a313a7b693a303b733a323a223237223b7d693a31353b613a313a7b693a303b733a323a223330223b7d693a31303b613a313a7b693a303b733a323a223139223b7d7d, '', 0, '1', '', '0', 1278414302, 'page3,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img14_90055s.jpg', '/UserFiles/Image/Trial/img14_90055.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 22, 166, 0, 0, 0, 0, 'N;', 6, '��.', '');
INSERT INTO `phpshop_products` VALUES (15, 6, '������������� ���� SAMSUNG C-100 R-5', '����� - 20 �, ������������� ���� � ������, �������� ��� - 750 ��, �������� ����� - 1100 ��, 6 ������� ��������, ��� ���������� - ������������, ������� ��� �����, ���-������������ �����, ������ �� 60 ���., ������� �.�.�.\r\n\r\n\r\n', '����� - 20 �, ������������� ���� � ������, �������� ��� - 750 ��, �������� ����� - 1100 ��, 6 ������� ��������, ��� ���������� - ������������, ������� ��� �����, ���-������������ �����, ������ �� 60 ���., ������� �.�.�.\r\n\r\n\r\n', 1025, 1320, '0', '1', '1', '', '1', '13,14', 'i14-28ii15-30ii10-19i', 0x613a333a7b693a31343b613a313a7b693a303b733a323a223238223b7d693a31353b613a313a7b693a303b733a323a223330223b7d693a31303b613a313a7b693a303b733a323a223139223b7d7d, '', 0, '1', '', '0', 1278414374, 'page5,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img15_14316s.jpg', '/UserFiles/Image/Trial/img15_14316.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '16', 45, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (16, 6, '������������� ���� SAMSUNG CE-2833 NR', '������������� ���� � ������ ����� - 23 � �������� ��� - 850 �� / ����� - 1110 �� 6 ������� �������� ��� ���������� - �������� +Dial ���-������������ ����� ������� �.�.�.\r\n\r\n', '������������� ���� � ������ ����� - 23 � �������� ��� - 850 �� / ����� - 1110 �� 6 ������� �������� ��� ���������� - �������� +Dial ���-������������ ����� ������� �.�.�.\r\n\r\n', 2000, 3000, '0', '1', '1', '', '1', '13,14', 'i14-28ii15-31ii10-20i', 0x613a333a7b693a31343b613a313a7b693a303b733a323a223238223b7d693a31353b613a313a7b693a303b733a323a223331223b7d693a31303b613a313a7b693a303b733a323a223230223b7d7d, '', 0, '1', '', '0', 1319471132, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img16_14316s.jpg', '/UserFiles/Image/Trial/img16_14316.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 68, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (17, 7, '���������� ������ WHIRLPOOL AWO|D 43115', '���������� Silver Nano ������������ ����������� ����� ���������������� - A ����� ������ - A ����� ������ - D �������� (��) - 40 / 4,5 �������� ��� �������� (�����, ��) 598 x 404 x 850\r\n', '���������� Silver Nano ������������ ����������� ����� ���������������� - A ����� ������ - A ����� ������ - D �������� (��) - 40 / 4,5 �������� ��� �������� (�����, ��) 598 x 404 x 850\r\n', 7523, 0, '0', '1', '1', '', '1', '19,20', 'i9-16ii19-41ii21-43i', 0x613a333a7b693a393b613a313a7b693a303b733a323a223136223b7d693a31393b613a313a7b693a303b733a323a223431223b7d693a32313b613a313a7b693a303b733a323a223433223b7d7d, '', 0, '1', '', '0', 1278416385, 'page2,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img17_13782s.jpg', '/UserFiles/Image/Trial/img17_13782.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 20, 560, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (18, 7, '���������� ������ CANDY Aquamatic 1000T-45', '��������: ������ (��) 69.5, ������ (��) 51, ������� (��) 44 ��� �������� ����������� �������� (��) 3.5 ����� (��/���) 1000 ����� ������ A /����� � �������������������/ ����� ������ C C����� �������������: ������\r\n', '��������: ������ (��) 69.5, ������ (��) 51, ������� (��) 44 ��� �������� ����������� �������� (��) 3.5 ����� (��/���) 1000 ����� ������ A /����� � �������������������/ ����� ������ C C����� �������������: ������\r\n', 2500, 3250, '0', '1', '1', '', '1', '19,20', 'i9-17ii19-41ii21-42i', 0x613a333a7b693a393b613a313a7b693a303b733a323a223137223b7d693a31393b613a313a7b693a303b733a323a223431223b7d693a32313b613a313a7b693a303b733a323a223432223b7d7d, '', 0, '1', '', '0', 1278416443, 'page3,', 1, '', '0', '', '', '���������� �������', '1', '', '/UserFiles/Image/Trial/img18_37948s.jpg', '/UserFiles/Image/Trial/img18_37948.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 24, 600, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (19, 7, '���������� ������ CANDY CNL 105', '�������: ������ (��) 85, ������ (��) 60, ������� (��) 52 ��� �������� ����������� �������� (��) 5 ����� (��/���) 0-1000 ����� ������ A /����� � �������������������!/ ����� ������ C C����� �������������: ������, �������\r\n', '�������: ������ (��) 85, ������ (��) 60, ������� (��) 52 ��� �������� ����������� �������� (��) 5 ����� (��/���) 0-1000 ����� ������ A /����� � �������������������!/ ����� ������ C C����� �������������: ������, �������\r\n', 8020, 0, '0', '1', '1', '', '1', '17,18', 'i9-18ii19-40i', 0x613a323a7b693a393b613a313a7b693a303b733a323a223138223b7d693a31393b613a313a7b693a303b733a323a223430223b7d7d, '', 0, '1', '', '0', 1278416600, 'page5,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img19_12587s.jpg', '/UserFiles/Image/Trial/img19_12587.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 45, 360, 0, 0, 0, 0, 'N;', 6, '�', '');
INSERT INTO `phpshop_products` VALUES (20, 7, '���������� ������ CANDY Aquamatic 800T-45', '��������: ������ (��) 69.5, ������ (��) 51, ������� (��) 44 ��� �������� ����������� �������� (��) 3.5 ����� (��/���) 800 ����� ������ A /����� � �������������������/ ����� ������ D C����� �������������: ������\r\n\r\n', '��������: ������ (��) 69.5, ������ (��) 51, ������� (��) 44 ��� �������� ����������� �������� (��) 3.5 ����� (��/���) 800 ����� ������ A /����� � �������������������/ ����� ������ D C����� �������������: ������\r\n\r\n', 11230, 0, '0', '1', '1', '', '1', '17,18', 'i9-16ii19-40ii21-42i', 0x613a333a7b693a393b613a313a7b693a303b733a323a223136223b7d693a31393b613a313a7b693a303b733a323a223430223b7d693a32313b613a313a7b693a303b733a323a223432223b7d7d, '', 0, '1', '', '0', 1278416771, 'page6,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img20_35512s.jpg', '/UserFiles/Image/Trial/img20_35512.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 56, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (21, 8, '���������� MOULINEX OW 2000', '�������� 610 �� 12 ������� ������������� 68 ��������� ��������� ������������� ����� ������� ���� � ������������� ��������� ������� ����������� ������� � ������� ��������� �����: 500, 750, 1000 �\r\n\r\n\r\n\r\n', '�������� 610 �� 12 ������� ������������� 68 ��������� ��������� ������������� ����� ������� ���� � ������������� ��������� ������� ����������� ������� � ������� ��������� �����: 500, 750, 1000 �\r\n\r\n\r\n\r\n', 2005, 2350, '0', '1', '1', '', '1', '23,24', 'i2-2ii14-27ii23-46ii10-19i', 0x613a343a7b693a323b613a313a7b693a303b733a313a2232223b7d693a31343b613a313a7b693a303b733a323a223237223b7d693a32333b613a313a7b693a303b733a323a223436223b7d693a31303b613a313a7b693a303b733a323a223139223b7d7d, '', 0, '1', '', '0', 1278415795, 'page2,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img21_74428s.jpg', '/UserFiles/Image/Trial/img21_74428.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 23, 670, 1500, 0, 0, 0, 'N;', 6, '��', '');
INSERT INTO `phpshop_products` VALUES (22, 8, '���������� KENWOOD BM 250', '��� ������� �� 500 �� �� 1 ��. ������� ����������� ����������� ����� �� 58 ���. ����������� ������ ����� �������. ��������: 480 ��. 12 ��������.\r\n\r\n', '��� ������� �� 500 �� �� 1 ��. ������� ����������� ����������� ����� �� 58 ���. ����������� ������ ����� �������. ��������: 480 ��. 12 ��������.\r\n\r\n', 2000, 0, '0', '1', '1', '', '1', '23,24', 'i2-1ii14-37ii23-45ii10-19i', 0x613a343a7b693a323b613a313a7b693a303b733a313a2231223b7d693a31343b613a313a7b693a303b733a323a223337223b7d693a32333b613a313a7b693a303b733a323a223435223b7d693a31303b613a313a7b693a303b733a323a223139223b7d7d, '', 0, '1', '', '0', 1278415854, 'page3,', 1, '', '0', '', '', '���������� KENWOOD', '1', '', '/UserFiles/Image/Trial/img22_14431s.jpg', '/UserFiles/Image/Trial/img22_14431.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '23', 34, 456, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (23, 8, '���������� KENWOOD BM 256', '�����: Principio ��������, ��: 260 ���������� �������� - �������� ��� ���������� - ������������ ������ ������ ������� - 2 ��������� - ���� ��� ����� - ���\r\n\r\n', '�����: Principio ��������, ��: 2600 ���������� �������� - �������� ��� ���������� - ������������ ������ ������ ������� - 2 ��������� - ���� ��� ����� - ���\r\n\r\n', 1863, 0, '0', '1', '1', '', '1', '21,22', 'i2-2ii14-37ii23-47ii10-19i', 0x613a343a7b693a323b613a313a7b693a303b733a313a2232223b7d693a31343b613a313a7b693a303b733a323a223337223b7d693a32333b613a313a7b693a303b733a323a223437223b7d693a31303b613a313a7b693a303b733a323a223139223b7d7d, '', 0, '1', '', '0', 1278415941, 'page5,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img23_16936s.jpg', '/UserFiles/Image/Trial/img23_16936.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 45, 333, 0, 0, 0, 0, 'N;', 6, '��', '');
INSERT INTO `phpshop_products` VALUES (24, 8, '���������� KENWOOD BM 350', '��� ������� �� 500 �� �� 1 ��. ������� ����������� ����������� ����� �� 58 ���. ����������� ������ ����� �������. ��������: 480 ��. 12 ��������. ������ �� ����������� ����� � ����� ����������� ������� � ����������� �������.\r\n', '��� ������� �� 500 �� �� 1 ��. ������� ����������� ����������� ����� �� 58 ���. ����������� ������ ����� �������. ��������: 480 ��. 12 ��������. ������ �� ����������� ����� � ����� ����������� ������� � ����������� �������.\r\n', 3000, 0, '0', '1', '1', '', '1', '21,22', 'i14-37ii23-45i', 0x613a323a7b693a31343b613a313a7b693a303b733a323a223337223b7d693a32333b613a313a7b693a303b733a323a223435223b7d7d, '', 0, '1', '', '0', 1278416004, 'page6,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img24_20598s.jpg', '/UserFiles/Image/Trial/img24_20598.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '22,23', 46, 560, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (25, 10, '��-��������� SONY KDL-52HX900', '����������� ������������������� ����������� ������� � ��� ���� 52� (132 ��), Full HD 1080, �� �� 3D � ������������ \r\n������������ ���������� � Motionflow 400 PRO\r\n\r\n', '����������� ������������������� ����������� ������� � ��� ���� 52� (132 \r\n��), Full HD 1080, �� �� 3D � ������������ \r\n������������ ���������� � Motionflow 400 PRO\r\n\r\n\r\n', 30000, 0, '0', '1', '1', '', '1', '27,28,26', 'i2-1ii10-19i', 0x613a323a7b693a323b613a313a7b693a303b733a313a2231223b7d693a31303b613a313a7b693a303b733a323a223139223b7d7d, '', 0, '1', '', '0', 1323343692, 'page2,', 1, '', '0', '', '', '��������� SONY', '1', '', '/UserFiles/Image/Trial/img25_17522s.jpg', '/UserFiles/Image/Trial/img25_17522.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 67, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (26, 10, '��-��������� SONY KDL-19BX200|W', '���������� ��������� High Definition �������� ��� ����� \r\n�������<br><br>����� ����� S � ���������� 40" - ��� �������� ��-���������� � ������� ��������� �����������, ������� �������������� �������� "BRAVIA ENGINE" � ������������������ ��-�������\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '���������� ��������� High Definition �������� ��� ����� \r\n�������<br>\r\n<br>\r\n����� ����� S � ���������� 40" - ��� �������� ��-���������� � ������� \r\n��������� �����������, ������� �������������� �������� "BRAVIA ENGINE" �\r\n ������������������ ��-�������\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 25000, 0, '0', '1', '1', '', '1', '27,28,25,51,52', 'i2-96ii10-19i', 0x613a323a7b693a323b613a313a7b693a303b733a323a223936223b7d693a31303b613a313a7b693a303b733a323a223139223b7d7d, '', 0, '1', '', '0', 1323427917, 'page3,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img26_12295s.jpg', '/UserFiles/Image/Trial/img26_12295.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 56, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (27, 10, '��-��������� Sony KDL-46NX700', '� ����� ����� V � ���������� 32" � ���������� ������� HD ������������ ������������ �������������� �� Sony: "Live Colour Creation", BRAVIA ENGINE � ������������������ ��-������. ����� ����� ����� ����������� ����������� ����������� � ������� �������.\r\n', '<p>46� (117 ��), Full HD 1080, �� �� BRAVIA Monolith � ���������� Edge \r\nLED � ����. Wi-Fi�</p><ul><li>BRAVIA Monolith � ���������� ����� � ������� ��������</li><li>�������� Wi-Fi�-����������� � ����������� �������� � �������</li><li>������ � ������� ����������� ���������� ���� ���� � ���������� \r\n�������</li></ul>� ����� ����� V � ���������� 32" � ���������� ������� HD ������������ ������������ �������������� �� Sony: "Live Colour Creation", BRAVIA ENGINE � ������������������ ��-������. ����� ����� ����� ����������� ����������� ����������� � ������� �������.\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 32000, 33800, '0', '1', '1', '', '1', '25,26,28,51,52', 'i2-96i', 0x613a313a7b693a323b613a313a7b693a303b733a323a223936223b7d7d, '', 0, '1', '', '0', 1323683430, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img27_13427s.jpg', '/UserFiles/Image/Trial/img27_13427.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 56, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (28, 10, '��-��������� SONY KDL-32S2000', '��������� 81 ��, 2&#215;10, 1366&#215;768, ��������� � HDTV, ����������� DNLe, ��������� LNA+, ����������� ������������� PC.', '��������� 81 ��, 2&#215;10, 1366&#215;768, ��������� � HDTV, ����������� DNLe, ��������� LNA+, ����������� ������������� PC, ������� ���� S-PVA, �������� 1000:1, ������� 500 ��/�&#178;, ��������� HDMI, ������� &lt;�������� � ��������&gt; � &lt;������� �����&gt;, FM-�����, ������ NICAM, �������� SRS TruSurround XT, ���������: 1000 �������, ������������ ����� ��', 35000, 0, '0', '1', '1', '', '1', '25,26', '', 0x4e3b, '', 0, '1', '', '0', 1278425888, 'page6,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img28_64148s.jpg', '/UserFiles/Image/Trial/img28_64148.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 55, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (29, 11, '�������� ����������� SONY DSC-W380', 'W380�������� ���������� ����������<br><br>����������������� ������� ��������� ����������� � ������� \r\nSweep Panorama � ������� ��������� ������\r\n\r\n\r\n\r\n\r\n', '<p>14,1 ��, �������� G f/2,4, 5x ���������� ���/��������. �������� 24 \r\n��, ����� HD, ��-����� 6,7 ��</p><ul class="reasonsToBuy"><li>������ ����������� �������� ������ ����������</li><li>������������ �������� ��������� �������� ������������ ���������\r\n ������ ��� ������������� ���������</li><li>����������� ������� ���������� ������</li></ul>\r\n\r\n\r\n', 10000, 10500, '0', '1', '1', '', '1', '31,32', 'i2-96ii10-19ii24-51i', 0x613a333a7b693a323b613a313a7b693a303b733a323a223936223b7d693a31303b613a313a7b693a303b733a323a223139223b7d693a32343b613a313a7b693a303b733a323a223531223b7d7d, '', 1, '1', '', '0', 1323678330, 'page2,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img29_90265s.jpg', '/UserFiles/Image/Trial/img29_90265.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 67, 130, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (30, 11, '�������� ����������� SONY DSC-TX7', '��������������� � �������� ���������� � �������� Intelligent Sweep \r\nPanorama � ������������ ������������� ������', '<p>������� Exmor R� CMOS, 4x ���. ���/���. �������� 25 ��, ������ ����� \r\n1080i HD, ����. ��-����� 8,8 ��</p><ul class=\\"reasonsToBuy\\"><li>������ � �������� ������ � ������ ��������� ���������</li><li>����������� ������� ��������� �����</li><li>���������� �������� �������� � HD-����� ������� 1080i</li></ul>', 9800, 0, '0', '1', '1', '', '1', '31,32', 'i2-1ii10-19ii24-51i', 0x613a333a7b693a323b613a313a7b693a303b733a313a2231223b7d693a31303b613a313a7b693a303b733a323a223139223b7d693a32343b613a313a7b693a303b733a323a223531223b7d7d, '', 0, '1', '', '0', 1278421265, 'page3,', 1, '', '0', '', '', '������ �����������', '1', '', '/UserFiles/Image/Trial/img30_80985s.jpg', '/UserFiles/Image/Trial/img30_80985.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 45, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (31, 11, '�������� ����������� SONY DSLR-A45', 'A450&nbsp;�������� ���������� ����������<br><br>�������������� �������� �������, ������� �������� ������� � \r\n������ ������� ��������������', '<p>14.2 �� Exmor� CMOS, 7 ����/�*, ��-����� 6,9 ��, SteadyShot INSIDE. \r\n������ ������</p><ul class=\\"reasonsToBuy\\"><li>����������� � ������ ����������� ����� � ������� ������������</li><li>���������������� �������� ������</li><li>�������� ����������������� ������ �� ������������</li></ul>', 7963, 0, '0', '1', '1', '', '1', '29,30', 'i2-1ii10-19ii24-50i', 0x613a333a7b693a323b613a313a7b693a303b733a313a2231223b7d693a31303b613a313a7b693a303b733a323a223139223b7d693a32343b613a313a7b693a303b733a323a223530223b7d7d, '', 0, '1', '', '0', 1278421835, 'page5,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img31_15570s.jpg', '/UserFiles/Image/Trial/img31_15570.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 29, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (32, 11, '�������� ����������� SONY A290L', '�������� ���������� ����������<br>����� ������ � ���������� ������ ������ ����� � ���� � �������� \r\n�������� ���������<br>', '����� ������ � ���������� ������ ������ ����� � ���� � �������� \r\n�������� ���������<p>14,2 ��, 2,5 ������/�, ��-����� 6,9 ��, ���������� SteadyShot \r\nINSIDE, HDMI�. �������� 18-55 ��.</p><ul class=\\"reasonsToBuy\\"><li>������, ���������� � ������� � ������</li><li>���� ������� ����� �������� ��������� ����������</li><li>����� ������� �������� �����������</li></ul>', 5890, 6000, '0', '1', '1', '', '1', '29,30', 'i2-96ii10-19ii24-92i', 0x613a333a7b693a323b613a313a7b693a303b733a323a223936223b7d693a31303b613a313a7b693a303b733a323a223139223b7d693a32343b613a313a7b693a303b733a323a223932223b7d7d, '', 0, '1', '', '0', 1278422002, 'page6,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img32_19735s.jpg', '/UserFiles/Image/Trial/img32_19735.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 46, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (33, 12, 'Apple iPod nano 8�� (5G)', '<strong>iPod nano</strong> � ��� �� ������ �������� MP3-����� �������� \r\n���������� ������. ������������ ����� ������������ \r\n���������� � ���������� ��������, ���������� ��� ��������� �������� <strong>Apple</strong>.\r\n\r\n', '��������� ����� - ����� H.264: �� 1,5 ��/�, 640 �\r\n 480 ��������, 30 ������ � �������, ������� Baseline Profile Low \r\nComplexity � ����� AAC-LC �� 160 ��/�, 48 ���, ���������� � �������� \r\n.m4v, .mp4 � .mov; ����� H.264 �� 2,5 ��/�, 640 � 480 ��������, 30 \r\n������ � �������, ������� Baseline Profile Level 3.0 � ����� AAC-LC �� \r\n160 ��/�, 48 ���, ���������� � �������� .m4v, .mp4 � .mov; ����� MPEG-4,\r\n �� 2,5 ��/�, 640 � 480 ��������, 30 ������ � �������, ������� Simple \r\nProfile � ����� AAC-LC �� 160 ��/�, 48 ���, ���������� � �������� .m4v, \r\n.mp4 � .mov.\r\n\r\n', 1200, 0, '0', '1', '1', '', '1', '35,36', 'i2-1ii10-19ii28-58i', 0x613a333a7b693a323b613a313a7b693a303b733a313a2231223b7d693a31303b613a313a7b693a303b733a323a223139223b7d693a32383b613a313a7b693a303b733a323a223538223b7d7d, '', 2, '1', '', '0', 1321530542, 'page2,', 1, '', '0', '', '', 'MP3 ����� DEX', '1', '', '/UserFiles/Image/Trial/img33_15359s.jpg', '/UserFiles/Image/Trial/img33_15359.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 11, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (34, 12, 'iPod classic 160GB', '160 �� ������ iPod classic � ��� 40 000 �����, 200 ����� ����� ��� 25 \r\n000 ����������. �����, ��� ����������, ����� �� ������� ��������...1 � \r\n����� � ��� �����!', '��, ��� �����, ����� ������ �������� �����, ������� � iTunes. ������ \r\n�������������� ��������� � ����������� �������. ������� ������ ���������\r\n iPod classic �������, �����, ������ � ����������.', 1110, 1325, '1', '1', '1', '', '1', '35,36', 'i2-2ii28-58i', 0x613a323a7b693a323b613a313a7b693a303b733a313a2232223b7d693a32383b613a313a7b693a303b733a323a223538223b7d7d, '', 0, '1', '', '0', 1278422714, 'page3,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img34_84429s.jpg', '/UserFiles/Image/Trial/img34_84429.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (35, 12, 'Apple iPod touch 32GB (3G)', '������-�����������, ������ MP3-�����, � ������� ����������� �������, \r\n������� ������� ��������������� �������. �������� ������� ��� ������ � \r\n����� ����������� ������ ���� ���������� ��������, ����������� ��� ���� \r\n��������� �� Apple.\r\n\r\n', '<strong>Apple iPod touch</strong> �������� ������� ��������� ������� � \r\n����������� \\"Multi-touch�, ��������� ���� ��� ��������� ����������� ��� \r\n������ ������� ������������� ������� � �������.<br>\r\n<strong> </strong>������� ������� iPod touch �������� �������� ��� \r\n��������� ����, ����� � �����������. ���������� ������ ������������� \r\n���������� ������� ������� � ����������� �� ���������.\r\n\r\n', 900, 0, '0', '1', '1', '', '1', '33,34', 'i2-96ii28-59i', 0x613a323a7b693a323b613a313a7b693a303b733a323a223936223b7d693a32383b613a313a7b693a303b733a323a223539223b7d7d, '', 1, '1', '', '0', 1322483738, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img35_79801s.jpg', '/UserFiles/Image/Trial/img35_79801.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '34,36', 10, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (36, 12, 'iPod Shuffle', '� iPod shuffle ��������� ��������� ���������� Apple � ������� ������ \r\n���������� �����. �� ����� ��������� ����������� ��� �������� \r\n����������� �� ���������� �����. <br>\r\n\r\n\r\n\r\n\r\n', '����������� � �������<li>���������� �������� ����������� � ���������� ������������</li><li>����� ���������������: �� 10 ����� ��� ������ ������ \r\n������������</li><li>������� ����� USB �� ���������� ��� �������� ������� \r\n(�������� ��������)</li><li>������� �� 80% �� 2 ����, ������ ������� �� 3 ����.</li>\r\n\r\n\r\n\r\n\r\n', 1500, 0, '1', '1', '1', '', '1', '33,34', 'i2-1ii10-19ii28-59i', 0x613a333a7b693a323b613a313a7b693a303b733a313a2231223b7d693a31303b613a313a7b693a303b733a323a223139223b7d693a32383b613a313a7b693a303b733a323a223539223b7d7d, '', 0, '0', '', '0', 1322653173, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img36_11726s.jpg', '/UserFiles/Image/Trial/img36_11726.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '33,34', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:41:"/UserFiles/Image/Trial/banner_skidka1.gif";}', 6, '', '');
INSERT INTO `phpshop_products` VALUES (37, 2, '���� BINATONE SI 2660 W', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n\r\n', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n\r\n', 700, 850, '0', '1', '1', '', '1', '1,2', 'i23-45ii5-84i', 0x613a323a7b693a32333b613a313a7b693a303b733a323a223435223b7d693a353b613a313a7b693a303b733a323a223834223b7d7d, '', 0, '', '', '0', 1278596999, 'page3,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img37_11242s.jpg', '/UserFiles/Image/Trial/img37_11242.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '3', 22, 300, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (38, 3, '������� ��� ������� PHILIPS QC 5000', '<div style=\\"height: 100%; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; background-image: none; background-attachment: scroll; background-origin: initial; background-clip: initial; background-position: 50% 50%; background-repeat: no-repeat no-repeat; \\"><p style=\\"font-family: Arial; \\">����� ������� ������ �������� ��������� ������ � �������� ��������. ������� ��� ������� ����� Complete Control ���� ������������ �������� � ���������� ����������.</p></div>', '<p style=\\"font-family: Arial;\\">����� ������� ������ �������� ��������� ������ � �������� ��������. ������� ��� ������� ����� Complete Control ���� ������������ �������� � ���������� ����������. </p>\r\n\r\n\r\n\r\n\r\n', 700, 850, '0', '1', '1', '', '1', '6,7', 'i2-2ii14-98ii23-45i', 0x613a333a7b693a323b613a313a7b693a303b733a313a2232223b7d693a31343b613a313a7b693a303b733a323a223938223b7d693a32333b613a313a7b693a303b733a323a223435223b7d7d, '0', 0, '0', '', '0', 1321624383, '', 3, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img38_17545s.jpg', '/UserFiles/Image/Trial/img38_17545.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '7,8', 49, 450, 0, 0, 0, 0, 'N;', 6, '��.', '');
INSERT INTO `phpshop_products` VALUES (39, 4, '������������� Mirta KTT 123', '������ NOVIS NKT-712 ����������<br><span>������� 1.7� ������ -����������� �����, ��� �������� ������������, ����� ��������� �������. ������� �������������� ������� �������� ��������� ������� ������� ������ �������� 2000 ��</span>\r\n\r\n\r\n\r\n\r\n', '<span>������ NOVIS NKT-712 ����������</span><p>������� 1.7� ������ -����������� �����, ��� �������� ������������, ����� ��������� �������. ������� �������������� ������� �������� ��������� ������� ������� ������ �������� 2000 ��</p><div><br></div>\r\n\r\n\r\n\r\n\r\n', 1900, 0, '1', '1', '1', '', '0', '', 'i2-96ii23-47i', 0x613a323a7b693a323b613a313a7b693a303b733a323a223936223b7d693a32333b613a313a7b693a303b733a323a223437223b7d7d, '1', 5, '0', '', '0', 1321623796, 'page3,page17,page4,page13,page19,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img39_44882s.jpg', '/UserFiles/Image/Trial/img39_44882.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, 'N;', 6, '��.', '');
INSERT INTO `phpshop_products` VALUES (40, 4, '������������� Lumme LU-205', '����� 1.8 �, ��� �������� ������������, ����� 2 ��������� ���������. �����- ������ ��������, �������-��� �������. - ������� �������������� ������� - ���� ������� ��������� ������ - ������� ������ - �������� 2000 ��', '����� 1.8 �, ��� �������� ������������, ����� 2 ��������� ���������. �����- ������ ��������, �������-��� �������. - ������� �������������� ������� - ���� ������� ��������� ������ - ������� ������ - �������� 2000 ������������� - ����������������� �� ������ - 300���.������� �������� - �� 400���.�������� �� ������', 6000, 0, '0', '1', '1', '', '1', '1,2', 'i2-96ii23-45i', 0x613a323a7b693a323b613a313a7b693a303b733a323a223936223b7d693a32333b613a313a7b693a303b733a323a223435223b7d7d, '1', 6, '', '', '0', 1321624103, 'page4,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img40_39656s.jpg', '/UserFiles/Image/Trial/img40_39656.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 45, 100, 0, 0, 0, 0, 'N;', 6, '��.', '');
INSERT INTO `phpshop_products` VALUES (41, 3, '������� ��� ������� Panasonic ER508', '���������������� ������� ��� ������� �����. ������� ��� ������������ ��������� ������������ ��� ��������, ������������ �������� ������ Diamond ��� ���������� � ������������ ������������.', '���������������� ������� ��� ������� �����. ������� ��� ������������ ��������� ������������ ��� ��������, ������������ �������� ������ Diamond ��� ���������� � ������������ ������������, ����� 10000 ��/������. 8 ����������� �����, �������������� ������� ��� �������.<div><br><ul><li>����� 10 000 �������� � ������.</li><li><div>������������ �� 8 ��������� ���� �����.</div></li><li><div>����������� ������� ������.</div></li><li><div>������ ���� Diamond �� ����������� �����.</div></li><li><div>����� ������� ������������ 8 �����.</div></li><li><div>����� ������ �� ������������ 60 ���.</div></li><li><div>��������� ������� ������������.</div></li><li><div>������� ������������� ����� ������� �����.</div></li><li><div>�������������� ������� ��� ������� �����.</div></li><li><div>����� �� ������ ������.</div></li><li><div>������� ��� ������������ �����.</div></li><li><div>������� ���������� �������.</div></li></ul></div>\r\n', 5400, 0, '1', '1', '1', '', '0', '6,7', 'i2-96ii23-45i', 0x613a323a7b693a323b613a313a7b693a303b733a323a223936223b7d693a32333b613a313a7b693a303b733a323a223435223b7d7d, '1', 5, '', '', '0', 1321624471, 'page4,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img41_13522s.jpg', '/UserFiles/Image/Trial/img41_13522.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, 'N;', 6, '��.', '');
INSERT INTO `phpshop_products` VALUES (42, 3, '������� ��� ������� Babyliss E 842 ��� ������ � ����', '����������� ��������������<br>- ���: ������������<br>- �������: ����/�����������<br>- ����� ���������� ������: 30 ���<br>- ����: �����+�������� CMS<br>- ����: �����\r\n', '�����������<br><span>- ���������������� ��������</span><br><span>- Smart Adjusting System</span><br><span>- 32 �� ��� ������� ������</span><br><span>- 7 �� ��� ������������� �������� ������</span><br><span>- ���������� �������: ��� ����� ������ �������</span><br><span>- ��������� ����������� ������</span><br><span>- ��������� ������ � ����� ��������� CMS (����, ��������, �����)</span><br><span>- ����������� �������� ��� ����������� ����������� �����: ����� ��������� �������� ������ �������: 0.5-15 �� (0.5 �� � 29 �� ������ �������)</span><br><span>- ����������������� ������</span><br><span>- ������� �����</span><br><span>- �������� ��������� �������</span>\r\n', 4000, 0, '', '1', '1', '', '', '38,6', 'i2-1ii14-��� ������ii23-47i', 0x613a333a7b693a323b613a313a7b693a303b733a313a2231223b7d693a31343b613a313a7b693a303b733a31303a22cde5f220e4e0ededfbf5223b7d693a32333b613a313a7b693a303b733a323a223437223b7d7d, '1', 0, '', '', '0', 1321624649, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img42_38656s.jpg', '/UserFiles/Image/Trial/img42_38656.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 45, 100, 0, 0, 0, 0, 'N;', 6, '��.', '');
INSERT INTO `phpshop_products` VALUES (43, 2, '���� BINATONE SI 2663 W', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n\r\n\r\n\r\n', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n\r\n\r\n\r\n', 2000, 850, '0', '1', '1', '', '1', '1,2', 'i23-45ii5-84i', 0x613a323a7b693a32333b613a313a7b693a303b733a323a223435223b7d693a353b613a313a7b693a303b733a323a223834223b7d7d, '', 5, '', '', '0', 1321625205, 'page3,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img43_10440s.jpg', '/UserFiles/Image/Trial/img43_10440.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 22, 300, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (44, 2, '���� BINATONE SI 2605667 GTI', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n\r\n\r\n\r\n', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n\r\n\r\n\r\n', 6509, 0, '1', '1', '1', '', '1', '1,2', 'i23-45ii5-84ii6-11ii29-54i', 0x613a343a7b693a32333b613a313a7b693a303b733a323a223435223b7d693a353b613a313a7b693a303b733a323a223834223b7d693a363b613a313a7b693a303b733a323a223131223b7d693a32393b613a313a7b693a303b733a323a223534223b7d7d, '', 6, '', '', '0', 1321637809, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img44_38392s.jpg', '/UserFiles/Image/Trial/img44_38392.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 400, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (45, 6, '������������� ���� DELONGHI MW 355', '������������ ���������� ������ �� 30 ��� �������� ������ ���������� ���� �������� ��������� 700 �� EMD ���������� ������� �������� 5\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '������������ ���������� ������ �� 30 ��� �������� ������ ���������� ���� �������� ��������� 700 �� EMD ���������� ������� �������� 5\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 2000, 0, '0', '1', '1', '', '1', '15,16', 'i14-26ii15-31ii10-19i', 0x613a333a7b693a31343b613a313a7b693a303b733a323a223236223b7d693a31353b613a313a7b693a303b733a323a223331223b7d693a31303b613a313a7b693a303b733a323a223139223b7d7d, '', 0, '', '', '0', 1321625360, 'page2,', 1, '', '0', '', '', '������������� ����', '1', '', '/UserFiles/Image/Trial/img13_53749s.jpg', '/UserFiles/Image/Trial/img13_53749.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 199, 4, 0, 0, 0, 0, 'N;', 6, '��', '');
INSERT INTO `phpshop_products` VALUES (46, 6, '������������� ���� MOULINEX AFM4 43', '����� 22 � ��� ���������� ��������� ���������� ����� 290 �� �������� �������� ����������, �� 850 ������������ �������� �����, �� 1100 �������������� ������� ����� ��� ������� �������� - 6\r\n\r\n\r\n', '����� 22 � ��� ���������� ��������� ���������� ����� 290 �� �������� �������� ����������, �� 850 ������������ �������� �����, �� 1100 �������������� ������� ����� ��� ������� �������� - 6\r\n\r\n\r\n', 1200, 0, '0', '1', '1', '', '1', '15,16', 'i14-27ii15-30ii10-19i', 0x613a333a7b693a31343b613a313a7b693a303b733a323a223237223b7d693a31353b613a313a7b693a303b733a323a223330223b7d693a31303b613a313a7b693a303b733a323a223139223b7d7d, '', 0, '', '', '0', 1321625397, 'page3,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img14_14799s.jpg', '/UserFiles/Image/Trial/img14_14799.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 25, 166, 0, 0, 0, 0, 'N;', 6, '��.', '');
INSERT INTO `phpshop_products` VALUES (47, 8, '���������� MOULINEX OW 2000', '�������� 610 �� 12 ������� ������������� 68 ��������� ��������� ������������� ����� ������� ���� � ������������� ��������� ������� ����������� ������� � ������� ��������� �����: 500, 750, 1000 �\r\n\r\n\r\n\r\n\r\n', '�������� 610 �� 12 ������� ������������� 68 ��������� ��������� ������������� ����� ������� ���� � ������������� ��������� ������� ����������� ������� � ������� ��������� �����: 500, 750, 1000 �\r\n\r\n\r\n\r\n\r\n', 3000, 2350, '0', '1', '1', '', '1', '23,20', 'i2-2ii14-27ii23-46ii10-19i', 0x613a343a7b693a323b613a313a7b693a303b733a313a2232223b7d693a31343b613a313a7b693a303b733a323a223237223b7d693a32333b613a313a7b693a303b733a323a223436223b7d693a31303b613a313a7b693a303b733a323a223139223b7d7d, '', 5, '', '', '0', 1321627366, 'page2,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img21_10640s.jpg', '/UserFiles/Image/Trial/img21_10640.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 23, 670, 1500, 0, 0, 0, 'N;', 6, '��', '');
INSERT INTO `phpshop_products` VALUES (48, 8, '���������� KENWOOD BM', '�����: Principio ��������, ��: 260 ���������� �������� - �������� ��� ���������� - ������������ ������ ������ ������� - 2 ��������� - ���� ��� ����� - ���\r\n\r\n\r\n', '�����: Principio ��������, ��: 2600 ���������� �������� - �������� ��� ���������� - ������������ ������ ������ ������� - 2 ��������� - ���� ��� ����� - ���\r\n\r\n\r\n', 3400, 0, '0', '1', '1', '', '1', '21,22', 'i2-2ii14-37ii23-47ii10-19i', 0x613a343a7b693a323b613a313a7b693a303b733a313a2232223b7d693a31343b613a313a7b693a303b733a323a223337223b7d693a32333b613a313a7b693a303b733a323a223437223b7d693a31303b613a313a7b693a303b733a323a223139223b7d7d, '', 0, '', '', '0', 1321627398, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img23_12441s.jpg', '/UserFiles/Image/Trial/img23_12441.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 333, 0, 0, 0, 0, 'N;', 6, '��', '');
INSERT INTO `phpshop_products` VALUES (49, 7, '���������� ������ CANDY CNL D', '��������: ������ (��) 69.5, ������ (��) 51, ������� (��) 44 ��� �������� ����������� �������� (��) 3.5 ����� (��/���) 800 ����� ������ A /����� � �������������������/ ����� ������ D C����� �������������: ������\r\n\r\n\r\n', '��������: ������ (��) 69.5, ������ (��) 51, ������� (��) 44 ��� �������� ����������� �������� (��) 3.5 ����� (��/���) 800 ����� ������ A /����� � �������������������/ ����� ������ D C����� �������������: ������\r\n\r\n\r\n', 46777, 0, '0', '1', '1', '', '1', '17,19', 'i9-16ii19-40ii21-42i', 0x613a333a7b693a393b613a313a7b693a303b733a323a223136223b7d693a31393b613a313a7b693a303b733a323a223430223b7d693a32313b613a313a7b693a303b733a323a223432223b7d7d, '', 0, '', '', '0', 1321627917, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img20_35512s.jpg', '/UserFiles/Image/Trial/img20_35512.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 3, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (50, 7, '���������� ������ WHIRLPOOL AWO|D 43115', '���������� Silver Nano ������������ ����������� ����� ���������������� - A ����� ������ - A ����� ������ - D �������� (��) - 40 / 4,5 �������� ��� �������� (�����, ��) 598 x 404 x 850\r\n\r\n', '���������� Silver Nano ������������ ����������� ����� ���������������� - A ����� ������ - A ����� ������ - D �������� (��) - 40 / 4,5 �������� ��� �������� (�����, ��) 598 x 404 x 850\r\n\r\n', 4000, 0, '0', '1', '1', '', '1', '19,24', 'i9-16ii19-41ii21-43i', 0x613a333a7b693a393b613a313a7b693a303b733a323a223136223b7d693a31393b613a313a7b693a303b733a323a223431223b7d693a32313b613a313a7b693a303b733a323a223433223b7d7d, '', 0, '', '', '0', 1321627950, 'page2,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial//img17_18035s.jpg', '/UserFiles/Image/Trial//img17_18035.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 12, 560, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (51, 10, '��-��������� SONY KDL 34', '��������� 81 ��, 2&#215;10, 1366&#215;768, ��������� � HDTV, ����������� DNLe, ��������� LNA+, ����������� ������������� PC.\r\n\r\n', '��������� 81 ��, 2&#215;10, 1366&#215;768, ��������� � HDTV, ����������� DNLe, ��������� LNA+, ����������� ������������� PC, ������� ���� S-PVA, �������� 1000:1, ������� 500 ��/�&#178;, ��������� HDMI, ������� &lt;�������� � ��������&gt; � &lt;������� �����&gt;, FM-�����, ������ NICAM, �������� SRS TruSurround XT, ���������: 1000 �������, ������������ ����� ��\r\n\r\n', 78000, 0, '0', '1', '1', '', '1', '25,26', 'i2-96ii10-19i', 0x613a323a7b693a323b613a313a7b693a303b733a323a223936223b7d693a31303b613a313a7b693a303b733a323a223139223b7d7d, '', 0, '', '', '0', 1321628246, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img51_20327s.jpg', '/UserFiles/Image/Trial/img51_20327.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 55, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (52, 10, '��-��������� SONY KDL-32S2000', '��������� 81 ��, 2&#215;10, 1366&#215;768, ��������� � HDTV, ����������� DNLe, ��������� LNA+, ����������� ������������� PC.\r\n\r\n', '��������� 81 ��, 2&#215;10, 1366&#215;768, ��������� � HDTV, ����������� DNLe, ��������� LNA+, ����������� ������������� PC, ������� ���� S-PVA, �������� 1000:1, ������� 500 ��/�&#178;, ��������� HDMI, ������� &lt;�������� � ��������&gt; � &lt;������� �����&gt;, FM-�����, ������ NICAM, �������� SRS TruSurround XT, ���������: 1000 �������, ������������ ����� ��\r\n\r\n', 67000, 0, '0', '1', '1', '', '1', '25,26', '', 0x4e3b, '', 0, '0', '', '0', 1323428050, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img28_12357s.jpg', '/UserFiles/Image/Trial/img28_12357.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 2, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (53, 11, '�������� ����������� SONY A5', '�������� ���������� ����������<br>����� ������ � ���������� ������ ������ ����� � ���� � �������� \r\n�������� ���������<br>\r\n', '����� ������ � ���������� ������ ������ ����� � ���� � �������� \r\n�������� ���������<p>14,2 ��, 2,5 ������/�, ��-����� 6,9 ��, ���������� SteadyShot \r\nINSIDE, HDMI�. �������� 18-55 ��.</p><ul class=\\"\\\\\\" reasonstobuy\\\\\\"\\"=\\"\\"><li>������, ���������� � ������� � ������</li><li>���� ������� ����� �������� ��������� ����������</li><li>����� ������� �������� �����������</li></ul>\r\n', 5890, 6000, '0', '1', '1', '', '1', '29,30', 'i2-96ii10-19ii24-92i', 0x613a333a7b693a323b613a313a7b693a303b733a323a223936223b7d693a31303b613a313a7b693a303b733a323a223139223b7d693a32343b613a313a7b693a303b733a323a223932223b7d7d, '', 0, '', '', '0', 1321628121, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img32_74919s.jpg', '/UserFiles/Image/Trial/img32_74919.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (54, 11, '�������� ����������� SONY DSC', '��������������� � �������� ���������� � �������� Intelligent Sweep \r\nPanorama � ������������ ������������� ������\r\n', '<p>������� Exmor R� CMOS, 4x ���. ���/���. �������� 25 ��, ������ ����� \r\n1080i HD, ����. ��-����� 8,8 ��</p><ul class=\\"\\\\\\" reasonstobuy\\\\\\"\\"=\\"\\"><li>������ � �������� ������ � ������ ��������� ���������</li><li>����������� ������� ��������� �����</li><li>���������� �������� �������� � HD-����� ������� 1080i</li></ul>\r\n', 6700, 0, '0', '1', '1', '', '1', '31,32', 'i2-1ii10-19ii24-51i', 0x613a333a7b693a323b613a313a7b693a303b733a313a2231223b7d693a31303b613a313a7b693a303b733a323a223139223b7d693a32343b613a313a7b693a303b733a323a223531223b7d7d, '', 0, '', '', '0', 1321628149, 'page3,', 1, '', '0', '', '', '������ �����������', '1', '', '/UserFiles/Image/Trial/img30_77562s.jpg', '/UserFiles/Image/Trial/img30_77562.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 45, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (55, 12, 'iPod classic 160GB', '160 �� ������ iPod classic � ��� 40 000 �����, 200 ����� ����� ��� 25 \r\n000 ����������. �����, ��� ����������, ����� �� ������� ��������...1 � \r\n����� � ��� �����!\r\n\r\n', '��, ��� �����, ����� ������ �������� �����, ������� � iTunes. ������ \r\n�������������� ��������� � ����������� �������. ������� ������ ���������\r\n iPod classic �������, �����, ������ � ����������.\r\n\r\n', 5670, 1325, '0', '1', '1', '', '1', '35,36', 'i2-2ii28-58i', 0x613a323a7b693a323b613a313a7b693a303b733a313a2232223b7d693a32383b613a313a7b693a303b733a323a223538223b7d7d, '', 0, '', '', '0', 1322483813, 'page3,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img34_54875s.jpg', '/UserFiles/Image/Trial/img34_54875.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 10, 0, 0, 0, 0, 0, 'N;', 6, '', '');
INSERT INTO `phpshop_products` VALUES (56, 12, 'Apple iPod nano 8�� (5G)', '<strong>iPod nano</strong> � ��� �� ������ �������� MP3-����� �������� \r\n���������� ������. ������������ ����� ������������ \r\n���������� � ���������� ��������, ���������� ��� ��������� �������� <strong>Apple</strong>.\r\n\r\n\r\n', '��������� ����� - ����� H.264: �� 1,5 ��/�, 640 �\r\n 480 ��������, 30 ������ � �������, ������� Baseline Profile Low \r\nComplexity � ����� AAC-LC �� 160 ��/�, 48 ���, ���������� � �������� \r\n.m4v, .mp4 � .mov; ����� H.264 �� 2,5 ��/�, 640 � 480 ��������, 30 \r\n������ � �������, ������� Baseline Profile Level 3.0 � ����� AAC-LC �� \r\n160 ��/�, 48 ���, ���������� � �������� .m4v, .mp4 � .mov; ����� MPEG-4,\r\n �� 2,5 ��/�, 640 � 480 ��������, 30 ������ � �������, ������� Simple \r\nProfile � ����� AAC-LC �� 160 ��/�, 48 ���, ���������� � �������� .m4v, \r\n.mp4 � .mov.\r\n\r\n\r\n', 4500, 0, '0', '1', '1', '', '1', '35,36', 'i2-1ii10-19ii28-58i', 0x613a333a7b693a323b613a313a7b693a303b733a313a2231223b7d693a31303b613a313a7b693a303b733a323a223139223b7d693a32383b613a313a7b693a303b733a323a223538223b7d7d, '', 2, '', '', '0', 1321628201, 'page2,', 1, '', '0', '', '', 'MP3 ����� DEX', '1', '', '/UserFiles/Image/Trial/img33_16896s.jpg', '/UserFiles/Image/Trial/img33_16896.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 11, 0, 0, 0, 0, 0, 'N;', 6, '', '');
        
CREATE TABLE `phpshop_rating_categories` (
  `id_category` int(11) NOT NULL auto_increment,
  `ids_dir` varchar(255) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  `revoting` enum('0','1') default NULL,
  PRIMARY KEY  (`id_category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_rating_categories` VALUES
(1, ',2,,3,,4,,6,,7,,8,,10,,11,,12,', '������', '1', '1');

CREATE TABLE `phpshop_rating_charact` (
  `id_charact` int(11) NOT NULL auto_increment,
  `id_category` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `num` int(11) NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id_charact`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_rating_charact` VALUES
(1, 1, '������� ���', 1, '1'),
(2, 1, '����������������', 2, '1'),
(3, 1, '��������', 3, '1');

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
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;


INSERT INTO `phpshop_rssgraber` VALUES (1, 'http://www.phpshop.ru/rss.php', 1, 10, '1', 1307995200, 1354305600, 1322686800);

CREATE TABLE `phpshop_rssgraber_jurnal` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `date` int(15) unsigned NOT NULL default '0',
  `link_id` int(11) NOT NULL default '0',
  `status` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 ;


CREATE TABLE `phpshop_search_base` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `uid` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

CREATE TABLE `phpshop_search_jurnal` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `num` tinyint(32) NOT NULL default '0',
  `datas` varchar(11) NOT NULL default '',
  `dir` varchar(255) NOT NULL default '',
  `cat` tinyint(11) NOT NULL default '0',
  `set` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 ;


CREATE TABLE `phpshop_servers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `host` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


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


CREATE TABLE `phpshop_shopusers_status` (
  `id` tinyint(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `discount` float NOT NULL default '0',
  `price` enum('1','2','3','4','5') NOT NULL default '1',
  `enabled` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


CREATE TABLE `phpshop_sort` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `category` int(11) unsigned NOT NULL default '0',
  `num` tinyint(11) NOT NULL default '0',
  `page` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_sort` VALUES (1, '�������', 2, 1, '');
INSERT INTO `phpshop_sort` VALUES (2, '�����', 2, 2, '');
INSERT INTO `phpshop_sort` VALUES (4, '2000', 3, 0, '');
INSERT INTO `phpshop_sort` VALUES (7, '����', 4, 1, '');
INSERT INTO `phpshop_sort` VALUES (8, '���', 4, 2, '');
INSERT INTO `phpshop_sort` VALUES (9, '��������', 5, 1, '');
INSERT INTO `phpshop_sort` VALUES (10, '����. �����', 5, 2, '');
INSERT INTO `phpshop_sort` VALUES (11, 'SONY', 6, 1, '');
INSERT INTO `phpshop_sort` VALUES (12, 'PHILIPS', 6, 2, '');
INSERT INTO `phpshop_sort` VALUES (13, '32', 7, 1, '');
INSERT INTO `phpshop_sort` VALUES (14, '40', 7, 2, '');
INSERT INTO `phpshop_sort` VALUES (15, '42', 7, 3, '');
INSERT INTO `phpshop_sort` VALUES (16, '1 �', 9, 1, '');
INSERT INTO `phpshop_sort` VALUES (17, '1.5 �', 9, 2, '');
INSERT INTO `phpshop_sort` VALUES (18, '2 �', 9, 3, '');
INSERT INTO `phpshop_sort` VALUES (19, '1500 ��', 10, 1, '');
INSERT INTO `phpshop_sort` VALUES (20, '2000 ��', 10, 2, '');
INSERT INTO `phpshop_sort` VALUES (22, '����', 12, 1, '');
INSERT INTO `phpshop_sort` VALUES (23, '�����������', 12, 2, '');
INSERT INTO `phpshop_sort` VALUES (30, '750 ��', 15, 2, '');
INSERT INTO `phpshop_sort` VALUES (29, '700 ��', 15, 1, '');
INSERT INTO `phpshop_sort` VALUES (26, 'DELONGHI', 14, 0, '');
INSERT INTO `phpshop_sort` VALUES (27, 'MOULINEX', 14, 0, '');
INSERT INTO `phpshop_sort` VALUES (28, 'SAMSUNG', 14, 0, '');
INSERT INTO `phpshop_sort` VALUES (31, '850 ��', 15, 3, '');
INSERT INTO `phpshop_sort` VALUES (32, '������������', 16, 1, '');
INSERT INTO `phpshop_sort` VALUES (33, '�����������', 16, 2, '');
INSERT INTO `phpshop_sort` VALUES (34, '20 �', 17, 1, '');
INSERT INTO `phpshop_sort` VALUES (35, '22 �', 17, 2, '');
INSERT INTO `phpshop_sort` VALUES (36, '23 �', 17, 3, '');
INSERT INTO `phpshop_sort` VALUES (37, 'KENWOOD', 14, 0, '');
INSERT INTO `phpshop_sort` VALUES (38, 'CANDY', 14, 0, '');
INSERT INTO `phpshop_sort` VALUES (39, 'WHIRLPOOL', 14, 0, '');
INSERT INTO `phpshop_sort` VALUES (40, '�����������', 19, 1, '');
INSERT INTO `phpshop_sort` VALUES (41, '������������', 19, 2, '');
INSERT INTO `phpshop_sort` VALUES (42, '3.5 ��', 21, 1, '');
INSERT INTO `phpshop_sort` VALUES (43, '4 ��', 21, 2, '');
INSERT INTO `phpshop_sort` VALUES (44, '5 ��', 21, 3, '');
INSERT INTO `phpshop_sort` VALUES (45, '480 ��', 23, 2, '');
INSERT INTO `phpshop_sort` VALUES (46, '610 ��', 23, 3, '');
INSERT INTO `phpshop_sort` VALUES (47, '260 ��', 23, 1, '');
INSERT INTO `phpshop_sort` VALUES (48, '����', 25, 1, '');
INSERT INTO `phpshop_sort` VALUES (49, '���', 25, 2, '');
INSERT INTO `phpshop_sort` VALUES (50, '6.0', 24, 1, '');
INSERT INTO `phpshop_sort` VALUES (51, '7.2', 24, 2, '');
INSERT INTO `phpshop_sort` VALUES (52, '����', 27, 1, '');
INSERT INTO `phpshop_sort` VALUES (53, '���', 27, 2, '');
INSERT INTO `phpshop_sort` VALUES (54, 'White|Black', 29, 2, '');
INSERT INTO `phpshop_sort` VALUES (56, 'Red|Silver', 29, 3, '');
INSERT INTO `phpshop_sort` VALUES (57, 'Black|Silver', 29, 4, '');
INSERT INTO `phpshop_sort` VALUES (58, '1 Gb', 28, 1, '');
INSERT INTO `phpshop_sort` VALUES (59, '2 Gb', 28, 2, '');
INSERT INTO `phpshop_sort` VALUES (96, '�������', 2, 0, '');
INSERT INTO `phpshop_sort` VALUES (65, '5000', 3, 0, '');
INSERT INTO `phpshop_sort` VALUES (66, '4000', 3, 0, '');
INSERT INTO `phpshop_sort` VALUES (67, '12', 7, 0, '');
INSERT INTO `phpshop_sort` VALUES (68, '55', 7, 0, '');
INSERT INTO `phpshop_sort` VALUES (101, '6 �', 9, 0, '');
INSERT INTO `phpshop_sort` VALUES (72, '123', 24, 0, '');
INSERT INTO `phpshop_sort` VALUES (92, '22', 24, 0, '');
INSERT INTO `phpshop_sort` VALUES (91, '12', 24, 0, '');
INSERT INTO `phpshop_sort` VALUES (76, '�������', 12, 0, '');
INSERT INTO `phpshop_sort` VALUES (79, '�����', 12, 0, '');
INSERT INTO `phpshop_sort` VALUES (82, '������', 12, 0, '');
INSERT INTO `phpshop_sort` VALUES (99, '132', 10, 0, '');
INSERT INTO `phpshop_sort` VALUES (84, '�����', 5, 0, '');
INSERT INTO `phpshop_sort` VALUES (98, 'PHILIPS', 14, 0, '');
        
CREATE TABLE `phpshop_sort_categories` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `flag` enum('0','1') NOT NULL default '0',
  `num` tinyint(11) NOT NULL default '0',
  `category` int(11) NOT NULL default '-1',
  `filtr` enum('0','1') NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `goodoption` enum('0','1') NOT NULL,
  `optionname` enum('0','1') NOT NULL,
  `page` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_sort_categories` VALUES (1, '�����', '0', 1, 0, '0', '����� ������', '0', '0', '');
INSERT INTO `phpshop_sort_categories` VALUES (2, '����� �����', '1', 0, 13, '1', '���� �����', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (4, '��������', '1', 0, 1, '1', '������� ���������', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (5, '�������� �������', '1', 0, 1, '1', '', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (6, '�����', '1', 0, 1, '1', '', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (7, '������ ������', '', 0, 8, '', '', '1', '1', '');
INSERT INTO `phpshop_sort_categories` VALUES (8, '����������', '0', 0, 0, '0', '', '0', '0', '');
INSERT INTO `phpshop_sort_categories` VALUES (9, '�����', '1', 0, 20, '1', '', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (10, '����� ��������', '1', 0, 22, '1', '', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (11, '�������', '0', 0, 0, '0', '', '0', '0', '');
INSERT INTO `phpshop_sort_categories` VALUES (13, '������� ��� �������', '0', 0, 0, '0', '', '0', '0', '');
INSERT INTO `phpshop_sort_categories` VALUES (14, '�������������', '1', 0, 13, '1', '', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (15, '�������� ���������', '1', 0, 18, '1', '', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (16, '��� ����������', '', 0, 13, '1', '', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (17, '�����', '1', 1, 13, '1', '��� �������� �����', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (18, '������������� ����', '0', 0, 0, '0', '', '0', '0', '');
INSERT INTO `phpshop_sort_categories` VALUES (19, '��� ��������', '1', 0, 20, '1', '', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (20, '���������� ������', '0', 0, 0, '0', '', '0', '0', '');
INSERT INTO `phpshop_sort_categories` VALUES (21, '�������� �����', '1', 0, 20, '1', '', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (22, '����������', '0', 0, 0, '0', '', '0', '0', '');
INSERT INTO `phpshop_sort_categories` VALUES (23, '��������', '1', 0, 13, '1', '', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (24, '���-�� ������������', '1', 0, 26, '1', '', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (27, '������������ �����������', '', 0, 26, '', '', '1', '1', '');
INSERT INTO `phpshop_sort_categories` VALUES (26, '������������', '0', 0, 0, '0', '', '0', '0', '');
INSERT INTO `phpshop_sort_categories` VALUES (28, '���������� ������', '1', 1, 26, '1', '', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (29, '����', '1', 0, 1, '', '', '', '', '');
INSERT INTO `phpshop_sort_categories` VALUES (31, '����', '0', 0, 0, '0', '����� ����', '0', '0', '');
INSERT INTO `phpshop_sort_categories` VALUES (32, '�����', '0', 10, 0, '0', '', '0', '0', '');
        

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
  `kurs` float NOT NULL default '0',
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
  `1c_option` blob NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_system` VALUES (1, '�������� ��������-��������', '���� ���', 4, 1, 6, '0', 'skyblue', 'mail@localhost', '����-������ ������� ��������-�������� PHPShop', '������ ��������, ������ ��������-�������', 6, 4, 3, '(495)111-22-33', 0x613a393a7b733a383a226f72675f6e616d65223b733a32343a22cecece202671756f743bcff0eee4e0e2e5f62671756f743b223b733a31323a226f72675f75725f6164726573223b733a32333a22cceef1eae2e02c20f3eb2e20def0e8e4e8f7e5f1eae0ff223b733a393a226f72675f6164726573223b733a32323a22cceef1eae2e02c20f3eb2e20d4e8e7e8f7e5f1eae0ff223b733a373a226f72675f696e6e223b733a31343a223134313431343134313431343134223b733a373a226f72675f6b7070223b733a31363a2232333233323332333233323332323332223b733a393a226f72675f7363686574223b733a31373a223334333433343334333433343333343334223b733a383a226f72675f62616e6b223b733a32373a22c7c0ce202671756f743bcaf0f3f2eee920c1e0edea2671756f743b223b733a373a226f72675f626963223b733a383a223436373738383838223b733a31343a226f72675f62616e6b5f7363686574223b733a31393a2232343234323432343234323434363537353737223b7d, '2', '', '1335355154', '18', '1', 0x613a35303a7b733a31373a227072657670616e656c5f656e61626c6564223b733a313a2231223b733a31323a22736b6c61645f737461747573223b733a313a2231223b733a31343a2268656c7065725f656e61626c6564223b733a313a2231223b733a31333a22636c6f75645f656e61626c6564223b4e3b733a32333a226469676974616c5f70726f647563745f656e61626c6564223b4e3b733a31333a22757365725f63616c656e646172223b4e3b733a31393a22757365725f70726963655f6163746976617465223b4e3b733a32323a22757365725f6d61696c5f61637469766174655f707265223b4e3b733a31383a227273735f6772616265725f656e61626c6564223b733a313a2231223b733a31373a22696d6167655f736176655f736f75726365223b733a313a2231223b733a363a22696d675f776d223b4e3b733a353a22696d675f77223b733a333a22333030223b733a353a22696d675f68223b733a333a22333030223b733a363a22696d675f7477223b733a333a22313030223b733a363a22696d675f7468223b733a333a22313030223b733a31343a2277696474685f706f64726f626e6f223b733a323a223930223b733a31323a2277696474685f6b7261746b6f223b733a323a223930223b733a31353a226d6573736167655f656e61626c6564223b733a313a2231223b733a31323a226d6573736167655f74696d65223b733a323a223230223b733a31353a226465736b746f705f656e61626c6564223b4e3b733a31323a226465736b746f705f74696d65223b4e3b733a383a226f706c6174615f31223b733a313a2231223b733a383a226f706c6174615f32223b733a313a2231223b733a383a226f706c6174615f33223b733a313a2231223b733a383a226f706c6174615f34223b4e3b733a383a226f706c6174615f35223b733a313a2231223b733a383a226f706c6174615f36223b733a313a2231223b733a383a226f706c6174615f37223b733a313a2231223b733a383a226f706c6174615f38223b733a313a2231223b733a31343a2273656c6c65725f656e61626c6564223b4e3b733a31323a22626173655f656e61626c6564223b4e3b733a31313a22736d735f656e61626c6564223b4e3b733a31343a226e6f746963655f656e61626c6564223b4e3b733a31343a227570646174655f656e61626c6564223b4e3b733a373a22626173655f6964223b733a303a22223b733a393a22626173655f686f7374223b733a303a22223b733a343a226c616e67223b4e3b733a31333a22736b6c61645f656e61626c6564223b733a313a2231223b733a31303a2270726963655f7a6e616b223b733a313a2231223b733a31383a22757365725f6d61696c5f6163746976617465223b733a313a2231223b733a31313a22757365725f737461747573223b733a313a2230223b733a393a22757365725f736b696e223b733a313a2231223b733a31323a22636172745f6d696e696d756d223b733a333a22353030223b733a31343a22656469746f725f656e61626c6564223b733a313a2231223b733a31333a2277617465726d61726b5f626967223b613a32313a7b733a31343a226269675f6d657267654c6576656c223b693a37303b733a31313a226269675f656e61626c6564223b733a313a2231223b733a383a226269675f74797065223b733a333a22706e67223b733a31323a226269675f706e675f66696c65223b733a33303a222f5573657246696c65732f496d6167652f73686f705f6c6f676f2e706e67223b733a31323a226269675f636f7079466c6167223b733a313a2230223b733a363a226269675f736d223b693a303b733a31363a226269675f706f736974696f6e466c6167223b733a313a2234223b733a31333a226269675f706f736974696f6e58223b693a303b733a31333a226269675f706f736974696f6e59223b693a303b733a393a226269675f616c706861223b693a37303b733a383a226269675f74657874223b733a303a22223b733a32313a226269675f746578745f706f736974696f6e466c6167223b693a303b733a383a226269675f73697a65223b693a303b733a393a226269675f616e676c65223b693a303b733a31383a226269675f746578745f706f736974696f6e58223b693a303b733a31383a226269675f746578745f706f736974696f6e59223b693a303b733a31303a226269675f636f6c6f7252223b693a303b733a31303a226269675f636f6c6f7247223b693a303b733a31303a226269675f636f6c6f7242223b693a303b733a31343a226269675f746578745f616c706861223b693a303b733a383a226269675f666f6e74223b733a31363a226e6f726f626f745f666f6e742e747466223b7d733a31353a2277617465726d61726b5f736d616c6c223b613a32313a7b733a31363a22736d616c6c5f6d657267654c6576656c223b693a3130303b733a31333a22736d616c6c5f656e61626c6564223b733a313a2231223b733a31303a22736d616c6c5f74797065223b733a333a22706e67223b733a31343a22736d616c6c5f706e675f66696c65223b733a32353a222f5573657246696c65732f496d6167652f6c6f676f2e706e67223b733a31343a22736d616c6c5f636f7079466c6167223b733a313a2230223b733a383a22736d616c6c5f736d223b693a303b733a31383a22736d616c6c5f706f736974696f6e466c6167223b733a313a2231223b733a31353a22736d616c6c5f706f736974696f6e58223b693a303b733a31353a22736d616c6c5f706f736974696f6e59223b693a303b733a31313a22736d616c6c5f616c706861223b693a35303b733a31303a22736d616c6c5f74657874223b733a303a22223b733a32333a22736d616c6c5f746578745f706f736974696f6e466c6167223b693a303b733a31303a22736d616c6c5f73697a65223b693a303b733a31313a22736d616c6c5f616e676c65223b693a303b733a32303a22736d616c6c5f746578745f706f736974696f6e58223b693a303b733a32303a22736d616c6c5f746578745f706f736974696f6e59223b693a303b733a31323a22736d616c6c5f636f6c6f7252223b693a303b733a31323a22736d616c6c5f636f6c6f7247223b693a303b733a31323a22736d616c6c5f636f6c6f7242223b693a303b733a31363a22736d616c6c5f746578745f616c706861223b693a303b733a31303a22736d616c6c5f666f6e74223b733a31363a226e6f726f626f745f666f6e742e747466223b7d733a31353a2277617465726d61726b5f6973686f64223b613a32313a7b733a31363a226973686f645f6d657267654c6576656c223b693a3130303b733a31333a226973686f645f656e61626c6564223b4e3b733a31303a226973686f645f74797065223b733a333a22706e67223b733a31343a226973686f645f706e675f66696c65223b733a303a22223b733a31343a226973686f645f636f7079466c6167223b733a313a2230223b733a383a226973686f645f736d223b693a303b733a31383a226973686f645f706f736974696f6e466c6167223b733a313a2231223b733a31353a226973686f645f706f736974696f6e58223b693a303b733a31353a226973686f645f706f736974696f6e59223b693a303b733a31313a226973686f645f616c706861223b693a303b733a31303a226973686f645f74657874223b733a303a22223b733a32333a226973686f645f746578745f706f736974696f6e466c6167223b693a303b733a31303a226973686f645f73697a65223b693a303b733a31313a226973686f645f616e676c65223b693a303b733a32303a226973686f645f746578745f706f736974696f6e58223b693a303b733a32303a226973686f645f746578745f706f736974696f6e59223b693a303b733a31323a226973686f645f636f6c6f7252223b693a303b733a31323a226973686f645f636f6c6f7247223b693a303b733a31323a226973686f645f636f6c6f7242223b693a303b733a31363a226973686f645f746578745f616c706861223b693a303b733a31303a226973686f645f666f6e74223b733a31363a226e6f726f626f745f666f6e742e747466223b7d733a31303a2263616c69627261746564223b4e3b733a31343a226e6f776275795f656e61626c6564223b733a313a2232223b733a393a22786d6c656e636f6465223b733a303a22223b7d, 6, 'PHPShop � ��� ������� ������� ��� �������� �������� ��������-��������.', '@Podcatalog@, @Catalog@, @System@', '@Podcatalog@ - @Catalog@ - @System@', '@Podcatalog@, @Catalog@, @Generator@', '@Product@ - @Podcatalog@ - @Catalog@', '@Product@, @Podcatalog@, @Catalog@', '@Product@,@System@', '/UserFiles/Image/Trial/your_logo.png', '', '@Catalog@ /', '@Catalog@', '@Catalog@', 0, '', '', 0x613a353a7b733a31313a227570646174655f6e616d65223b733a313a2231223b733a31343a227570646174655f636f6e74656e74223b733a313a2231223b733a31383a227570646174655f6465736372697074696f6e223b733a313a2231223b733a31353a227570646174655f63617465676f7279223b733a313a2231223b733a31313a227570646174655f736f7274223b733a313a2231223b7d);


CREATE TABLE `phpshop_upload_backup` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `date` int(16) NOT NULL default '0',
  `folder` varchar(255) NOT NULL default '',
  `backup_use` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

CREATE TABLE `phpshop_upload_list` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(200) NOT NULL default '',
  `backup` enum('1','0') NOT NULL default '0',
  `backup_flag` enum('0','1','2','3') NOT NULL default '0',
  `dir` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 ;


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


INSERT INTO `phpshop_valuta` VALUES (4, '������', '��.', 'UAU', '0.06', 4, '1');
INSERT INTO `phpshop_valuta` VALUES (5, '�������', '$', 'USD', '0.03', 0, '1');
INSERT INTO `phpshop_valuta` VALUES (6, '�����', '���', 'RUR', '1', 1, '1');

