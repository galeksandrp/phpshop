
CREATE TABLE `phpshop_modules` (
  `path` varchar(255) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `date` int(11) NOT NULL default '0',
  PRIMARY KEY  (`path`)
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

INSERT INTO `phpshop_baners` VALUES
(1, '������-���� PHPShop', '<A title="�����! 10% ������ �� ������������ ������" href="http://www.phpshop.ru/docs/service.html#1"><IMG border=0 src="/UserFiles/Image/Trial/banner_skidka1.gif" width=468 height=60></A>', 472092, 1931, '1', '30.06.10', 2147483647, '');
INSERT INTO `phpshop_baners` VALUES (2, '������ ��������-��������', '<object codebase="http://active.macromedia.com/flash6/cabs/swflash.cab#version=6.0.0.0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" height="80" width="460"><param name="movie" value="/UserFiles/Image/Trial/shopbuilder.swf"><param name="play" value="true"><param name="loop" value="true"><param name="WMode" value="Opaque"><param name="quality" value="high"><param name="bgcolor" value=""><param name="align" value=""><embed src="/UserFiles/Image/Trial/shopbuilder.swf" play="true" loop="true" wmode="Opaque" quality="high" bgcolor="" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" align="" height="80" width="460"></object>', 29, 29, '1', '14.06.11', 2147483647, '');


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


CREATE TABLE `phpshop_cache` (
  `sesid` varchar(64) NOT NULL default '',
  `cache` longblob NOT NULL,
  `datas` int(11) NOT NULL default '0',
  PRIMARY KEY  (`sesid`),
  KEY `datas` (`datas`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_categories` VALUES
(1, '������ ������� �������', 0, 0, '0', '', 0, 'N;', '<p><img alt=\"\" src=\"/UserFiles/Image/Trial/img9_18900s.jpg\" width=\"86\" border=\"0\" height=\"100\"></p>\r\n', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '3', '1', ''),
(2, '�����', 3, 1, '0', '', 0, 'a:4:{i:0;s:2:\"16\";i:1;s:2:\"23\";i:2;s:1:\"4\";i:3;s:1:\"5\";}', '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', ''),
(3, '������� ��� �������', 2, 1, '0', '2', 0, 'a:6:{i:0;s:1:\"2\";i:1;s:2:\"14\";i:2;s:2:\"16\";i:3;s:2:\"23\";i:4;s:2:\"29\";i:5;s:2:\"17\";}', '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', ''),
(4, '��������������', 1, 1, '0', '2', 0, 'a:3:{i:0;s:1:\"2\";i:1;s:2:\"23\";i:2;s:2:\"29\";}', '<BR>', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', ''),
(5, '������� ������� �������', 0, 0, '0', '', 0, 'N;', '<img alt=\"\" src=\"/UserFiles/Image/Trial/img21_66070s.jpg\" width=\"85\" border=\"0\" height=\"100\">\r\n', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '3', '1', ''),
(6, '������������� ����', 1, 5, '0', '2', 0, 'a:3:{i:0;s:2:\"14\";i:1;s:2:\"15\";i:2;s:2:\"10\";}', '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', ''),
(7, '���������� ������', 3, 5, '0', '2', 0, 'a:3:{i:0;s:1:\"9\";i:1;s:2:\"19\";i:2;s:2:\"21\";}', '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', ''),
(8, '����-�������', 2, 5, '0', '2', 0, 'a:4:{i:0;s:1:\"2\";i:1;s:2:\"14\";i:2;s:2:\"23\";i:3;s:2:\"10\";}', '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', ''),
(9, '�����-�����-����', 0, 0, '0', '', 0, 'N;', '<IMG height=73 alt=\"\" src=\"/UserFiles/Image/Trial/img26_20400s.jpg\" width=100 border=0>', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '', '', ''),
(10, '��-����������', 0, 9, '0', '2', 0, 'a:3:{i:0;s:1:\"7\";i:1;s:1:\"2\";i:2;s:2:\"10\";}', '<BR>', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', ''),
(11, '�������� ������������', 0, 9, '0', '2', 0, 'a:4:{i:0;s:1:\"2\";i:1;s:2:\"10\";i:2;s:2:\"24\";i:3;s:2:\"27\";}', '<BR>', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', ''),
(12, 'MP3-������', 0, 9, '0', '2', 0, 'a:3:{i:0;s:1:\"2\";i:1;s:2:\"10\";i:2;s:2:\"28\";}', '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'phpshop_1', '', '1', '1', '');

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

INSERT INTO `phpshop_comment` VALUES
(4, '1277798400', '���������', 13, '� �����, ����� ��������� ����, ����������.', 66, '1'),
(3, '1276675200', '����', 10, '� ����� ������� ��������! \r\n��������� � ������������� ��� �����!) :yes::yes::yes:', 2, '1');


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

INSERT INTO `phpshop_foto` VALUES
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
(271, 11, '/UserFiles/Image/Trial/img11_15809.jpg', 0, ''),
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
(294, 1, '/UserFiles/Image/Trial/img1_16674.jpg', 0, ''),
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
(197, 41, '/UserFiles/Image/Trial/img41_86676.jpg', 0, ''),
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
(303, 3, '/UserFiles/Image/Trial/img3_47552.jpg', 0, ''),
(295, 1, '/UserFiles/Image/Trial/img1_14333.jpg', 0, ''),
(272, 12, '/UserFiles/Image/Trial/img12_54691.jpg', 0, ''),
(274, 12, '/UserFiles/Image/Trial/img12_14304.jpg', 0, ''),
(380, 18, '/UserFiles/Image/Trial/img18_37948.jpg', 0, ''),
(206, 41, '/UserFiles/Image/Trial/img41_78022.jpg', 0, ''),
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
(456, 36, '/UserFiles/Image/Trial/img36_11726.jpg', 0, '');

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


DROP TABLE IF EXISTS phpshop_opros;
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



INSERT INTO `phpshop_page` VALUES (10, '�������� � ������������� PHPShop', 'page10', 1, '�������� �������� ��������, ������ �������� �������, ���������� ������, ��������� �������� �������, ������������ ������, ������ +��� �������� ��������, ����������� �������� �������� ', '�������� � ������������� ������������� �������� ��������-�������� PHPShop', '<DIV><I><EM><IMG border=0 hspace=10 alt="" vspace=5 align=left src="/UserFiles/Image/Trial/denis.jpg" width=113 height=150>� ��������� ����� ������� � ��������-�������� ������� �����. ����� �������, ��� ������ ��������-������� - �� ������ ����������� �������� ��������, � ������� ���������, ������� ������������ ���������� �������� �������. � ������������� ��������-��������� � ������ �������� �������� ��������� ����� �������, ��������� � ������� ���������� PHPShop Software, - ���������� ��������� ��� ��������-��������� � ������.<BR><BR></EM></I></DIV>\r\n<DIV><I>������� PHPShop ������ �������� � ������.</I></DIV>\r\n<DIV><I>��� ����� �������� ��������� �� ���������� �����?</I></DIV>\r\n<DIV>&nbsp;</DIV>\r\n<DIV>�������� <A href="http://www.phpshop.ru/">PHPShop Software</A>&nbsp;��������� � 2004 ����. �� ���� ��� ������ �� �����, �� ������ �������� ������ ���� ��������. �� ����� �� ��������-�������� �� ����������, � ������ ����� ����� ������ ������ �����, �������� �������� ������������� �������, �������� ������� ������� �����, ��������, �������� ���������� ��������� � ������� ����������� �������� � ����������.<BR><BR><I>�����, ��� ������ ���� ��������� ��������-��������? ������ ������ ��������, � �� ������ ��������-����������, ���� ���������������� - ��� ������� ������� ��� ����������.</I></DIV>\r\n<P>� 2004 ���� �� ��������� ������ CMS ��� ������, �� ��� ������ ��� ���� ��� ������������������� ������� � ������ �������������� ��������������. ���������� ������ ����� �� �������� ��������. ��� ���� ����������� ������� ��� ������, � �� ������� �� ������. �������� ����� ����� ������ ������� PHPShop ��� �����, � �� ������ �������� ������ ���� ������� ��� ����� ������ ��������-���������.<BR>� �� ����� ����� ����������� ��������� ��� ����������� ������, ������� ����� 3 ��������, ������������ ��������������� ��������� ��������-��������� �� ����������� CMS. PHPShop ����� ���� ���� ��������� ������������� ����� � ������ ������� � �������� ���� ������ ����������, ������� � �� ��� ��� �������� ����������. � ���� ��, ����� ��������� PHPShop ����� �� ��������� Windows, ��� ����������� �������� ���������� � ������ ������ ����� �������, ��� �� ����� �� ������� ����������.</P>\r\n<P><I>��������, ��� ������ �� ����� �������� ��������-��������� � ����� �������� ���� ����������. ��� ��� ������� ����������� ����������� �� ���������� �����?</I></P>\r\n<P>�����������, ����� ����������� � ���������� ����� �����. ������� ����� �� ��������-�������� ������ �����, � ��������������, ��������� ��������� �������� � ������-������, ������������ �� ���������. ��������� �� ����� ������ ������� ����������� �������� � ����, �� ���� �������� � ������������� ��� ������� ������, ���������� ������, ����� ������������ ��� ���� ������. ������, �� �������� � ������ ���������� �� <A href="http://www.phpshop.ru/docs/partners.html">����������� ���������</A>, � ��� ����� ����������� �������� ������ ��� ��������� �� ��������� �����.</P>\r\n<DIV>PHPShop ����������� �����������, ��������� ����� �� �������� ���������. �� �� ������ ������� ���������, � ��������� ������������� ������ - ������� � ������, � � ����� �������� ������� �������� �������� �� ������. � ��� �������� ��������� �����������, � ������ �������� �������� �������� � ���������� ��� ��������. �� ��������� ������� ���������� ���������� � �������, ��� ����� �������� � �������� ��������, ���������, ��������� � ������������� ��������. ��������, ������������ ��������������, ����� ������ ��� �������� ���������� ��������� <A href="http://www.phpshop.ru/news/ID_208.html">PHPShop EasyControl</A>.</DIV>\r\n<DIV>���������� ����������� ����� ������� ������� Enterprise Pro 1� - ������������� �������� ��� � ���������� 1�, ������ ������������� ���������� ����������, ������������� � �������� ������� � ��������-��������� � ������ ��������� �������.<BR>��������, ��� ���� ����� ������������ ������� �� ����� ����������� ��� ��������� ����������� ���������, �� ��� ��������, �, ��������� ��������� ��������� � ����������� ������������. �� ����� �� �������� ������� ��������� ��������� �������� - ��� ������������ �������� � ���� � ������.<BR>� �������, ��������������� ���� - ������������ ������, ��������� �������� ���� �������� PHPShop.<BR><I><BR>����� ��������-���������, �� �������������� ���������� ������� ���������� ������ (CMS). ���������� ��������� � �������. ��� PHPShop CMS Free ���������� �� ������ ��������?</I></DIV>\r\n<P><A href="http://www.phpshopcms.ru/">PHPShop CMS Free</A>� ��� ���������� ���������, � ������� �� ������� ���� ������� ������ �������������, ��� ������ � ��������, ������� ���� ����. ���� ������� ���������, ��� �������� ������� ������ � web, �.�. ��� ������ html, php, � �.�., ������� ���� ����������� ����. � ���������� ����� ������ 3.1., � �� ������� �������� �������������� ������� ���, ������� �� ����� �����������������, ���������� ���������� ��������-���������. �� ������ ������ ���������� ����� 40 ���������� <A href="http://phpshopcms.ru/doc/skins.html">��������</A>- ����� ������ ������� ����������. ������� �� ��������� <A href="http://forum.phpshopcms.ru/">����� ��� �������������</A>, ��� ��� ��� ������� ����� ������ ���, � ���������� � ������������� � �������� ��������������. ������, �� ���������� ��������,<I>PHPShop CMS Free </I>��� ������� ����� 40000 �������������, � �� �������� �� �������� ���� ����� ����������.</P>\r\n<P><I>������������� �� ��������� ���������� ��� �������? ��� �� �����-������ ������� ��������?</I></P>\r\n<P>������� ��������� ����������. ��� ��������� ������, ���������� �� ������������� ����� ������� ������� ���������� ���������, � ������� "�������� ������" �� �������������������� ������, ������� �� ��� ����. ������ �� �� ���������� �� ���������� ������, � ������������ � ����� ������ ����� ��������� ��� �����. ��� ��� �������� �� ������� ������������ (�������).<BR><BR><I>�������� iTrack ��������� ����������� ������� ������ ���������� ������� (CMS), ������������ �� ���������� � �������� ���������� �� ������, � ������� �������� ����������, ��� PHPShop �������� 51,7% ����� ������ � CMS ��� ��������-���������. ��� ��������� ���������.<BR>��� �� �������, ������ ���� �������� ��� �������?</I></P>\r\n<P>�������, �� �������� ����� �����������. �� ���� �������, ��� ���� ������� ����� �������� �� �������� � ��������� ���������, �� �� ���������� �����-����� �������� ����������� ����������� ��������. ��� ��� � ����������, ���� ��� �������� �� ����������� �����-�������� � �������� ���������� �������������� ������, ����������� ������ ������������ ���������, ��� ����������� �� ������, ������� � ������������ ���������������� �������.</P>\r\n<P><I>� ��� ��, ����� �� ����������� ������ ��� ������ � PHPShop?</I></P>\r\n<P>������ ������� �� ������ �������, �� ������ ��� ��������� ����������, ��� ������� ����� ��� ������, ��������, ����� <A href="http://www.phpshop.ru/news/ID_217.html">������� ������� ��������</A>&nbsp;�� ���������� ��� ���� �������, � ����� ����� ����� �������� ������� ��������� ����� � ��������, ������� ��� ���� ����� � ������. ������� �������, � �� ��������� �� ��� ������������!</P>\r\n<P><I>��� ���� �������? �� ����� ��������� ����� ���� ��������� ������?</I></P>\r\n<P>PHPShop �������� ��������� ������ ����: ��� � ������� ��������, � �����������������, � ����� ������� ��������������� � ���� ��������. ��� ��� ��� ����������, ��� ���� �� ��� ������� ����� �������������: ��������� ��������� ������ <A href="http://www.phpshop.ru/docs/product2.html">PHPShop Start</A>- 3990 ���. � �� ����� ��������� ���� �����. ���������������� ������ � ���������� 1� (<A href="http://www.phpshop.ru/docs/product5.html">PHPShop Pro 1C</A>) ����� 16770 ���. � ������������� �� ������� ����� �������.</P>\r\n<P><I>�������� �� ����� ����������� ��������� ������� ������������� ������? ��� ��������� ��������� ��� ������ �� ��� ��������� ��������� ����?</I></P>\r\n<P>� �������, ���. ��������, � ����� � ��������� ������������, ���� �������� �������� �� ����, � ���������, � ��������������, ���������� ������ ���������. � ������� ������������� �������� ������ ��� ���� �������� PHPShop, ������ ��� ������ ����� ���� ������.<BR><I><BR>����� ������ �� ������ ���� ���������� ����������������?</I></P>\r\n<DIV>������ �� �������, � ����� �������� ������ � ���������. ���� �� ����� �� ��������.</DIV>\r\n<DIV align=right>&nbsp;</DIV>\r\n<DIV align=right>������� �����,</DIV>\r\n<DIV align=right>��������� �������� PHPShop Software,</DIV>\r\n<DIV align=right>������� ���������� �������� phpshop.ru,&nbsp;phpshopcms.ru.</DIV>', '', 1, 1279698501, '', '��� ���������� ������� ��������-�������', '1', '', '');
INSERT INTO `phpshop_page` VALUES (9, '������� ��� Windows 7', 'page9', 1, '���������� ��������-��������, ������� ��� ������� 7, ������� ��� Windows 7, ������� ����� ��������, �������� ��������-��������, ��������� ��������-�������, ������� �������� ������� ���������, ������� ��� ��������-��������', '�������, ��� ��� �� �������� Microsoft, "�������" --��� ��������� ����������, ���������� ��������� ��� �����. ���������� ��� ������� ������������, ��� ��� �� ���������� ��������� ������ �� ����������� ������������ �������� �����.', '<p><i>�������, ��� ��� �� �������� Microsoft,\r\n"�������" --��� ��������� ����������, ���������� ��������� ��� �����.\r\n���������� ��� ������� ������������, ��� ��� �� ���������� ��������� ������ ��\r\n����������� ������������ �������� �����.</i></p><p>�������\r\n�������� ������������ ������� Windows 7 ��������� ��������� ����� ����� ������������ �������������. ����� ������\r\n������� ��������, ��� � Microsoft ������� ������� ���� �� ��������. ������ ����������\r\n����������� �������������, Windows 7 ������ ���������� �������� � ��������� ����������.</p><p>�������\r\n�������� Windows Seven �� ���������� ������ ������������ ������ ���� �����\r\n������ � ����������� �������� �����. ������� ������� ������, �������\r\n����������� ����� �� �����������, � ������ �������� ������� ����� ���������\r\n����� �� ������� �����.</p><p>�\r\n�����, ������� - ��� ����-����������, ��������� ������� ����� �����������\r\n������� � ������� ������ � ����������� ����� ���������� - ��� ���������, ��� �\r\n��������� ����������� ����� ��������. ����-���������� ���������, ��������,\r\n���������� ������, ������������� ��������� ����������� ��������� �������� �\r\n�������� � ������, ������ ��������, ������� �� ����������� �������� � ���������\r\n������ ��������.</p><p>������������Windows 7 ����������\r\n��������� ���������� ��������, � ������������, ����� ��� ������������\r\n���������� �� Windows Vista ��������� �������� � ����� ������ � ��������. ������� �����\r\n� ����� ������ �� ���������. ��� ����� ����������� ��������� ��� ����� �\r\n�������� ������.</p><p>��\r\n������ ������� ����� ����������, ������� ���-����<a href="http://http://vista.gallery.microsoft.com/vista/SideBar.aspx?mkt=ru-ru"> Gadgets</a>.&nbsp; �� ����� �������� ��������� �������� � ����������� ��������, ��������������� ��\r\n�������� � ���������� ����������.</p><p>����� ����, ��������� ������������ ���������� ���� ��������\r\n����-����������. ��������, ����������� ��� ���������� ��������-��������� ���\r\n����������, �������� <a href="http://http://www.phpshop.ru/news/ID_212.html">PHPShop Vista Order Gadge</a>,\r\n��������� ��� ���������� � ������<a href="http://http://www.phpshop.ru/"> ��������-������� PHPShop</a>. �� ������������ ���\r\n������ ���������� �� �������������� ������� � ��������� �����������\r\n�������������� ��. ������ �������� ���<a href="http://http://www.phpshop.ru/update/gadget/download.php"> ����������� ���������� </a>�� �����\r\n������������.</p>\r\n', '', 1, 1279547998, '', '������� ��� Windows 7', '1', '', '');
INSERT INTO `phpshop_page` VALUES (11, '�����-�����', 'page11', 1000, '', '', '<H2>����������, ��� ����� � ������ �������� � ��������, ����������, ��������, ��������� � PHPShop!</H2><BR><BR>��� �����-����� �������� � <A href="http://www.phpshop.ru/help/" target=_blank>on-line �������� PHPShop</A>.<BR><BR><BR>\r\n<OBJECT width=480 height=385><PARAM NAME="movie" VALUE="http://www.youtube.com/v/AKEMaJwTryo&amp;amp;amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;amp;amp;fs=1?rel=0"><PARAM NAME="allowFullScreen" VALUE="true"><PARAM NAME="allowscriptaccess" VALUE="always">\r\n<embed src="http://www.youtube.com/v/AKEMaJwTryo&amp;amp;amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;amp;amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></OBJECT><BR><BR>\r\n<OBJECT width=480 height=385><PARAM NAME="movie" VALUE="http://www.youtube.com/v/LrqW9lzLxcM&amp;amp;amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;amp;amp;fs=1?rel=0"><PARAM NAME="allowFullScreen" VALUE="true"><PARAM NAME="allowscriptaccess" VALUE="always">\r\n<embed src="http://www.youtube.com/v/LrqW9lzLxcM&amp;amp;amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;amp;amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></OBJECT><BR><BR>\r\n<OBJECT width=480 height=385><PARAM NAME="movie" VALUE="http://www.youtube.com/v/XPuuJD6maXQ&amp;amp;amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;amp;amp;fs=1?rel=0"><PARAM NAME="allowFullScreen" VALUE="true"><PARAM NAME="allowscriptaccess" VALUE="always">\r\n<embed src="http://www.youtube.com/v/XPuuJD6maXQ&amp;amp;amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;amp;amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></OBJECT><BR><BR><BR><BR>��� �����-����� �������� � <A href="http://www.phpshop.ru/help/" target=_blank>on-line �������� PHPShop</A>', '', 1, 1279695906, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (8, '��� ������� ���� ��������������', 'page8', 1, '������ �����, cms, ��� ������� ����, ������� ������ �����, ������ �����', '��� ������� ����? ���� ������ ������� ��������� �����. ������ ������� ���� �������� � ��������� ����� ����� � �������, ��� �� �������. ����, ��� ����, ����� ������� ����������� ����, ����� �������, ������, ������ � �������. ���� ��� ����� ��� �� �������,', '<p>��� ������� ����? ���� ������ ������� ��������� �����.\r\n������ ������� ���� �������� � ��������� ����� ����� � �������, ��� �� �������.\r\n����, ��� ����, ����� ������� ����������� ����, ����� <i>�������, ������, ������ </i>�<i> �������</i>.\r\n���� ��� ����� ��� �� �������, �� ���������, ���� � �������� � ������ �� ���.</p><p><i>�������</i> � ���\r\n������ �� ���������� ����� � ����. �� ������ ������� ������� ��� ����������\r\n�������, ������ ������ � ������ ������ ����� ������ ��� ����������� ��������. �\r\n���� ��, ������� ���� ����� �������, ������ ���� �� �������� �� �������\r\n��������. ��� ������� ��������<span></span>�������������� �������� ��� (����� �����������\r\n���� ��������) � �� ������ ������������ ����� ����&nbsp; www.�����.net (.ru,� �.�.). ��� ������ ������\r\n������ 2 ������� �������: ��� ������ ���� �� ������� ������� � ������ �����\r\n������������.</p><p><i>������</i> ����� (CMS)&nbsp; � ��� ���������, ����������� ������������ ��������������\r\n����� � ������������. � �� ������, ������ � ��� � ���� ��� ����. ��������, ���\r\n�� ���� ������� ����������������, ������� ������ �������������� ����������. �������,\r\n�� ������ ���������� � ������� ������������, ������ ���������� ��� �������\r\n�������, �, ��� �� �������, ��������� ��\r\n��� ��������� �, � �� �� �����, �����������!</p><p>� �������, ��������� ������������ ������� ���������� ������\r\n���������� ������������� ����������� <a href="http://www.phpshopcms.ru/">PHPShop Software</a>. CMS ��\r\nPHPShop ���������\r\n��������� � �������� ��� �������� ����� ����� ���������: �� ������ ��������� ��\r\n����������������� ��������. ��� ����� ����� ���� ������� ��������� � ����\r\n�����!</p><p>��������� �����\r\n��������� ����� ����� � ���������� ��������� Windows. ����������� ��� �������� ����� ��������� ������� <a href="http://demo.phpshop.ru/">����-������</a> �� ����� �������������.</p><p>������� ���� ����� ����������� ��� �� ������ �<i> ��������</i>. ��������, PHPShop �������������\r\n�� ����� ����� 35 ���������� ���������\r\n������� �� ����� ����. ���� �� �� ����� ������ �����������, ���������� �\r\n���������� � �� ��� CMS ����� ��������� ����� ������.</p><p>����, �� ������� (������, �������) CMS. ������ ��� ��������� �������\r\n��������� � ������ ��������� ����<i> ���������</i>,\r\n�� ���� ����������. ���������� �� ����� ������ � ����������! ����������, �������\r\n� ���, ��������� ������ ����������� ����� ������������� ��� ���� � ��\r\n���������� ������� ������� ��� ������� ��������� ����������, ������������ �� ��\r\n��������� ����� � ����������, ������ ������ ��� �������� ������ � �����������\r\n������������� ������.</p><br>\r\n\r\n', '', 1, 1279547987, '', '��� ������� ���� ��������������', '1', '', '');
INSERT INTO `phpshop_page` VALUES (2, '����� � 1�', 'page2', 1000, '', '', '<DIV>\r\n<H2>�����-����� �� ������ � 1�-��������������</H2>������� ��������� �����-����� �� ������ � 1�-�������������� ��� PHPShop Pro 1C! ����� ��������� �� �������� ��������� ����������� ����� ��� 1� ������ 7.7 � 8.1.<BR><BR>��� �����-����� �������� � <A href="http://www.phpshop.ru/help/" target=_blank>on-line �������� PHPShop</A>.<BR></DIV><BR>\r\n<OBJECT width=480 height=385><PARAM NAME="movie" VALUE="http://www.youtube.com/v/aHGF7xZwgjM&amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;fs=1?rel=0"><PARAM NAME="allowFullScreen" VALUE="true"><PARAM NAME="allowscriptaccess" VALUE="always">\r\n<embed src="http://www.youtube.com/v/aHGF7xZwgjM&amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></OBJECT><BR><BR>\r\n<OBJECT width=480 height=385><PARAM NAME="movie" VALUE="http://www.youtube.com/v/yDWpuzvrmy8&amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;fs=1?rel=0"><PARAM NAME="allowFullScreen" VALUE="true"><PARAM NAME="allowscriptaccess" VALUE="always">\r\n<embed src="http://www.youtube.com/v/yDWpuzvrmy8&amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></OBJECT><BR><BR>\r\n<OBJECT width=480 height=385><PARAM NAME="movie" VALUE="http://www.youtube.com/v/dk6ULAmGGvI&amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;fs=1?rel=0"><PARAM NAME="allowFullScreen" VALUE="true"><PARAM NAME="allowscriptaccess" VALUE="always">\r\n<embed src="http://www.youtube.com/v/dk6ULAmGGvI&amp;amp;amp;amp;hl=ru_RU&amp;amp;amp;amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></OBJECT><BR><BR><STRONG></STRONG>��� �������� �����:<BR>\r\n<DIV><A href="http://phpshop.ru/loads/ThLHDegJUj/setup.exe" target=_blank>��������� PHPShop EasyControl(~ 8 Mb)</A><BR><A href="http://phpshop.ru/help/Content/install/phpshop_server.html#1" target=_blank>���������� ���������� �� PHPShop EasyControl</A><BR>������ ������� ������������� �� �������� 8-800-700-11-15, ������ ���������� �� ��.</DIV>', '', 2, 1279695855, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (3, '������ ��������', 'page3', 1000, '', '', '<h2>�������� ������� "������� �����������"��� ������� �������� PHPShop! </h2>\r\n<div>��� ������� ������� �������� ��������-�������� PHPShop �������� ������� "������� �����������", � ���������� ��������� � ���������� �����������.<br><br>������� ������ � ����������� �������� ���������� ������ �� ������, ��� �������� ����� �������� �� � <a href="http://www.phpshop.ru/docs/adres.html">����� ��������</a>, ��� <a href="http://www.phpshop.ru/option/blok.rar">������� � ��. ����</a> (win rar, ~7 ��).</div>\r\n<div><br><b><img alt="" src="/UserFiles/Image/Trial/broshura.jpg" width="277" border="0" height="218"><br><br>1. �������� </b></div>\r\n<div>1.1. ��� ����� PHPShop? </div>\r\n<div>1.2. ������� ��������� ������</div>\r\n<div>1.3. ��������� ����������</div>\r\n<div>1.4. ���������</div>\r\n<div>1.5. ��� ����� PHPShop EasyControl </div>\r\n<div>1.6. ��������� �� �������</div>\r\n<div><b></b><b>2</b><b>. ������ ������</b></div>\r\n<div>2.1. ��������� PHPShop</div>\r\n<div>2.2. ���������, �������</div>\r\n<div>3. Keywords &amp; Titles </div>\r\n<div>2.4. �������� ������ �������� �������</div>\r\n<div>2.5. �������� ������ �����������</div>\r\n<div>2.6. �������� ������ ������</div>\r\n<div>2.7. ������ � �������������</div>\r\n<div>2.8. ������ � ����������������</div>\r\n<div>2.9. �������������� �������� ���� ����� Ex�el </div>\r\n<div>2.10. �������������� �������� �����-����� ����� Ex�el </div>\r\n<div><b>3. ����� � 1�:�����������</b></div>\r\n<div>3.1. ��������� � ����������</div>\r\n<div>3.2. ��� �������� ����� � 1�:�����������?</div>\r\n<div><b>4. ��������� �������</b></div>\r\n<div>4.1. ��� �������� �������?</div>\r\n<div>4.2. ��� �������� ��������� � "�����" �����?</div>\r\n<div>4.3. ��� �������� �������� ������� ��������?</div>\r\n<div>4.4. ��� �������� ������� �����?</div>\r\n<div>4.5. ��� ������� ����� ������������� ����?</div>\r\n<div>4.6. ��� �������� ��� ������?</div>\r\n<div><b>5. ������ �������</b></div>\r\n<div>5.1. ����������� ����������� �������� ������</div>\r\n<div>5.2. ������ � �������</div>\r\n<div>5.3. ������ �������� ������������� </div>\r\n<div>5.4. � ���� ������ ������������� ������� c 1C \r\n<div>\r\n<div>5.5. ������ ������ �������</div>\r\n<div>5.6. ���������� ����������� ��������-�����<br>5.7. ��� ������ ������ � ������ ���������.</div></div></div>\r\n<p></p>\r\n', '', 3, 1279633387, '', '�������� ������� "������� �����������"��� ������� �������� PHPShop!', '1', '', '');
INSERT INTO `phpshop_page` VALUES (4, '��������', 'page4', 1000, '', '', '<h2>�� ���������� � ����-������ ������� ��������-�������� PHPShop!</h2>\r\n<h2>��������&nbsp;��� "������"</h2>\r\n<p>�� ������ ��������� <a title="������� ���� �� ����������� ��������� \r\n��������-��������" href="http://www.phpshop.ru/brif_tz.doc" target="_blank">���� �� ����������� �������</a>, ���� <a title="������� ���� �� ������������ ������" href="http://www.phpshop.ru/brif_person_diz.doc" target="_blank">���� �� ������������ ������ �����</a>, ���� �������� ������������ ��� �������: <br>������ �������� - <a href="mailto:client@phpshop.ru">client@phpshop.ru</a>, ���� <br>������� �������� - <a href="mailto:sales@phpshop.ru">sales@phpshop.ru</a>. <br><br>������������ ��������, ���������� ��������� � ����� �� ��������������� ������ <br>�� ���������: <br><br><b>8-800-700-11-15</b> (������ ���������� �� ��)<br>(495) 989-11-15, � ������������ �� �������.<br><br>��-��: 10:00-19:00 <br><br>�����: �.�����������, ��.������������, �.41�, 1 �������, 2 ����, ���� 1, ������ �������� "PHPShop". </p>\r\n<h1></h1>\r\n<div>&nbsp;</div>\r\n', '', 4, 1279633382, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (5, '������� ����������� �������  �������', 'page5', 1, '', '', '<i>...� ���������\r\n����� ����������� � ������� ���������� ������������� ���������� ���� ����������\r\n������������ ���������� � ���� ������� ����������� ��� �� ����� �����. � 2009\r\n���� ����������� 25-����� ������ ������ � �� ������� ��� ��������� �����\r\n������� � ���������� ��������� �������-�����, � �� ���������� ���������� �� ���\r\n��� ����� ������ ������������� �� ���� ����������. � ���� ������ ��������\r\n��������� � �����-������ � ���� ��������� ������� ���� ������� ��������� ������������,\r\n������� � ���������� �������� ����. �� ������ � ������...<br><br></i><b>��� ����� ������?</b><br>USB Flash\r\nDrive&nbsp;��� ������ ������� - ��� ��� �������� �������� ����������, �������\r\n�������� ��� ��������� ��������, MP3 ������, �������� ������, � ������ �\r\n������������ ����������. \r\n\r\n�\r\n����������� ����� �flash� ��������� ��������: �������, ��������, ������������,\r\n���������, �������, ������ ������ � ������. � ����� �������� �� ��������, ���\r\n��� ���������� ������������, �������� ��������� ������ ������� (Fujio Masuoka).<br><br><b>����� ����������� ����� ������.</b><br>����������� ����������\r\n����-��������� ���������� �� ������ ��� �������� �������������� ������, �� ��\r\n������ �����, ��� ������ ���� ������� ������ ����� ������������ ����� ������,\r\n��� ������� ���� ������ ��� ����� ��������.\r\n\r\n��-������, �����\r\n����������, ������ � ������� �� ������ ��������\r\n�� ������ ���� �������. ��� ������, ���� �� ������, ��� ��� ��������\r\n�������� � ���� ����� �� ��������� ��� �������� ����������.<br><br>� �������\r\n������������ �������� �� �� ��������� ��������� � ����������� ������������\r\n��������, � ��� �� ��� ����������� ���� ������ � ������ ����� ��� �����. ���\r\n����� ����� ������� ����������� ������� (�������� Mozilla Firefox), �����������\r\n����� �� ������ � ����� �� � �����. ����� �� ������� �� ������ ��������� � ����� ������� �������� ������.\r\n\r\n\r\n������, ���� ��\r\n������ ��������� ����������� �������� ���������,\r\n��������� ����� ���������, ������ � ��� �������� ������.<br><br>���������� ����������\r\n��������� ��� ���������� ����������� ����� (��������,CryptoAnywhere).\r\n��� ��������� �������� � ��������� ������������� ��������� (��� �������� �\r\n������ ��������� ������������ ������). ������������� ����� ���������, ������\r\n���� � �������� �����, � �� ������� �������� ������������ �� �� �����\r\n����������.\r\n\r\n� ���� ��, ��\r\n������ ������������ ���� ������ �\r\n�������� ���������� ������������ �����. ��� ����� ����� ���������, ��� BIOS\r\n������������ �������� � USB-��������� (��� ��� ��������, ����� ����� ����� �\r\n����) � ��������������� �������� HP USB disk storage tool. ��� �������������\r\n��� ������� ������ �� HP, �� ������������ �������� � ������������ �� ������\r\n��������������. ������ ���������� ����-���� � ��������� �������.<br><br>� ����� �����\r\n������ � �������� �� USB ���� �����\r\n������������ �������! ��� ����� ����� ������������ ���� �� ������� Linux\r\nLive CD, ��������������� ��� ������� ��������� � ������ ��� �������������\r\n��������� �� ���������. ������������ ������ ������� �������� ��������, ����\r\n���������� ����� �������� �� ������ �����������, ����� ������ ����� ��� �����\r\n���� ������� ����� � ������� ����������� ����������.<br><br>�� ���� ������� �������� ������ �\r\n���������� ��������� �������� �� �������������. ���, ����������\r\n��������-��������� �� PHPShop ��� ��������� <a href="http://www.phpshop.ru/news/ID_217.html">����� ������� Shop2Flash</a>.<b> ��� ��������� ����������� ����\r\n��������-������� �� ������� �������� � ��������� �� � ������� ����������. \r\n\r\n��� �� �����,\r\n�������� ��������� �������� USB-����� ������ ����� �����������\r\n�����������.</b><br>\r\n\r\n\r\n', '', 0, 1279547945, '', '', '1', '', '');
INSERT INTO `phpshop_page` VALUES (7, '��� ������ ���� ���� � ���������', 'page7', 1, '�������� ��������-��������, ������ ��������-��������, ������� ��������-�������, ��������-������', '', '<p><span>� ������������� ��������-�������� ������� � �������� ���������� �����. ���� ��������, ��� ���������� ��������-�������, ��, �� ��������� ������, ��������� ����������� ���������� ����� ���� ������. ��� ���� ����������� ����������� �������� ��������, ������� �������������, �� ������ ������.<i><br></i></span>����� �������, ������� ���� ���� ����������� ������ - ����� ����\r\n������������, ��� ��������� (��� �������� ���� ��� ������� � ����) �\r\n��������������� ������� ��������-�������.<br><br><b>��� 1. �������</b><br></p><span>����� ����, ��� �� ������������ � �����, ����������,\r\n��� ������� ���� ������. ��� ����� �������� � ���������� �����, �� �� ����� ��\r\n����� ������. ����, ��� ��������, "��� ������� ��������, ��� �� �\r\n��������".<br><br><b>���2. ����������� ������</b><br><br>�����-��� ����� �����. �� ������ ��������� ����� �������� ��� ����<a href="http://www.%D0%B8%D0%BC%D1%8F.ru">www.���.ru</a>(.com, .net, .org �\r\n�.�.) ��� ���������������� � �������� ��������� ��� ��������, ����������� ��\r\n����� ����������� ������. �������� ��� ������ ���� ������� � �������, ���\r\n�����. �������� �������� ���!<br><br><b>���3. ����� ������� ���</b><br><br>���������� ����������� � ������ ����� �������� ������� � ����. ��� ���������\r\n������������� ��� - ��������������� ����� ��������-��������. ����\r\n��������-������� - �� ������ �������� ������� ��� ������ ������, �� � �������\r\n�����, ������� ������ ������� ���� ���������� ��� ���!<br><br>����, ����� ����� ����� ��������: ������ ������� ��������-������� ���\r\n��������������� ���������� ��������. �������, ����� ����������� �����\r\n���������� ��������, ��, � ���������, ��� ���������� ��������, �������������\r\n����� ��������� ��������� � ����. ��� ������� ������ ����� � ��� ������� ��������\r\n�� ���� �������-���������. � ����� �� ��������� ����������� ������� �����,\r\n������� ���������� ���������, �������� ��������� ����������� �������.<br><br>����������� ������ ������� ����������� ��������-�������. ��� ������������\r\n��������� ��������� �� ��������� ������������� ������� � ������ ������������\r\n��� ������. �� ������ ������ ���� ������ ������� ������� � �� ����� ���� �\r\n�������. ���������� ������ � ������ ������ ������� ��������� ��������-��������\r\n��� ������� ��������-��������, �� ������ ������ ������ ������ ���������\r\n�������������. �������� �������� �� ����, ������� ������������ ��� �������\r\n����������� �������� � ������� ����������� �������.<br><br>������ ������ �������� ���, �� � ����������<a href="http://www.phpshop.ru/" target="_blank">PHPShop</a>. ���������� � ����������� ������ �� ������� �����,\r\n��������� �������<a href="http://www.phpshop.ru/docs/democentre.html" target="_blank">����-������</a>. ����� ���������� ���������� �������, ���\r\n��������� PHPShop ����� �� ��������� Windows, � ������������ ���� �����������\r\n������� ��� ������������: ����� ��������� �� ���������, � ����� �������� �����\r\n�� �������, ���� ����������� ��������� ������� �� ������� � �������� ������ ��\r\n����� ����������. �� ������� ��� ��� ����� �����, ����� ����������� � ���������\r\n��������.<br><br><b>���4. ������</b><br><br>��������, ������ �����. ������ ����� ��������� ��������� ������ � �������� �\r\n������, � ������ ������� ������-����� ������� ������. ���������� ������ ����\r\n������� ���������� �� ����� ����� � ������� ��� ���������� ������� ���\r\n����������� ��������� ��� ������� �������. �� ������ ���������� ����������\r\n��������, � ������ ������ ��������� �� �������. ����������� ����������\r\n��������� ��� ����������� ����� �� ����� ��������-������������� ��������, ��\r\n������ ������� ��-���������� ���������� �������.<br><br><b>���5. ������� ������</b><br><br>�� ������ ����������� � ���, ����� ����� �������� ���� ����������� ������\r\n���������� �������. �� ����������� ���� ��������� ��������� ������ ��������:<br><br>� ���� � ���� - ����������� ����� ����������� ������ ��� ��. ���.<br><br>� �������� ����� Interkassa - ��������� ������� Interkassa.<br><br>� ��������� - ����������� ��������� ���������,������������ ��� ������� ������\r\n"���������� �������� � �.�.".<br><br>� Visa,Mastercard (PayOnlineSystem) - ��������� ������� PayOnlineSystem.<br><br>� �������� ����� Robox - ��������� ������� ROBOXchange.<br><br>� �������� - ����������� ����� ��������� ��������� ������ ��� ���. ���.<br><br>� Webmoney - ��������� ������� Webmoney.<br><br>� Z-Payment - ��������� ������� Z-Payment.<br><br>���������� ������� ��������� ���� �������� ������ � ������������� ��������-��������.\r\n���������� ��������� �� ��� ����� ����� ������������ ��� ������� � �� ���������\r\n������������� ��������.<br><br><b>���6. ��������</b><br><br>����� ����������� ���������, ��� �� ������ ���������� ����� ����������. �����\r\n������ ��� ������, � ������� ���������� � �����, � ����� ������ ��������.\r\n������� - ������������� ������������� � ������� ��������, ���� ��� ��, ���� ���\r\n����� ��� ����������. ��� ������ ���� ������ �������������� ��������\r\n������, �������, ��� ���� ������ ����� ����������� ��������, ������� �����������\r\n������.<br><br>����� 6 �����, � � ��� ����������� ��������-������! �������, ��� ����� ����\r\n������ ����, �� ������ � ��� ���� ���, ����� ������ ������������ �� �������\r\n����. ������ ����� �������������, ��� �������� ������ � ������ �������\r\n��������� ����������. ��������� ���� ��������-������� ������ �������� �����\r\n������� �������, �������� �����, ��� ����� � ���������� 1� ��� ����, �����\r\n��������� ����� ���������� ������� � �������������� ��.<br><br>����� � ����������� ��� � ������ ����!</span><br>', '', 1, 1279546370, '', '��� ������ ���� ���� � ���������', '1', '', '');
INSERT INTO `phpshop_page` VALUES (1, '�������� ������� ��������', 'page1', 2000, '', '', '����� �������<BR>\r\n<DIV style="PADDING-BOTTOM: 10px; PADDING-LEFT: 10px; PADDING-RIGHT: 10px; PADDING-TOP: 10px" align=center>\r\n<TABLE border=0 align=center>\r\n<TBODY>\r\n<TR>\r\n<TD><A title="���������� � ��������" href="/?skin=phpshop_4"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 alt="" src="/UserFiles/Image/Trial/def_skin_15_small.gif" width=100 height=80></A></TD>\r\n<TD><A title="���������� � ��������" href="/?skin=phpshop_5"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_13_small.gif" width=100 height=80></A></TD>\r\n<TD><A title="���������� � ��������" href="/?skin=phpshop_1"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_9_small.gif" width=100 height=80></A></TD>\r\n<TD style="BORDER-BOTTOM: rgb(211,211,211) 1px dashed; BORDER-LEFT: rgb(211,211,211) 1px dashed; PADDING-BOTTOM: 5px; PADDING-LEFT: 5px; PADDING-RIGHT: 5px; BORDER-TOP: rgb(211,211,211) 1px dashed; BORDER-RIGHT: rgb(211,211,211) 1px dashed; PADDING-TOP: 5px" align=middle><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 src="/UserFiles/Image/Trial/palette.png"><BR><A class=b title="�������� ������������� �������" href="http://www.phpshop.ru/docs/service.html#1">������<BR>��� ����� �</A></TD></TR>\r\n<TR>\r\n<TD><A title="���������� � ��������" href="/?skin=phpshop_2"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_10_small.gif" width=100 height=80></A></TD>\r\n<TD><A title="���������� � ��������" href="/?skin=phpshop_3"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_11_small.gif" width=100 height=80></A></TD>\r\n<TD><A title="���������� � ��������" href="/?skin=aeroblue"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_5_small.gif" width=100 height=80></A></TD>\r\n<TD><A title="���������� � ��������" href="/?skin=pink" ?=""><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_7_small.gif" width=100 height=80></A></TD></TR>\r\n<TR>\r\n<TD><A title="���������� � ��������" href="/?skin=grass"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_6_small.gif" width=100 height=80></A></TD>\r\n<TD><A href="/?skin=phpshop_6"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 alt=alt= src="/UserFiles/Image/Trial/def_skin_14_small.gif" width=100 height=80 ����������="" �="" ��������=""></A></TD>\r\n<TD><A href="/?skin=phpshop_7"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 alt=alt= src="/UserFiles/Image/Trial/def_skin_12_small.gif" width=100 height=80 ����������="" �="" ��������=""></A></TD>\r\n<TD><A title="���������� � ��������" href="/?skin=yellow_classic"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_4_small.gif" width=100 height=80></A></TD></TR>\r\n<TR>\r\n<TD style="BORDER-BOTTOM: rgb(211,211,211) 1px dashed; BORDER-LEFT: rgb(211,211,211) 1px dashed; PADDING-BOTTOM: 5px; PADDING-LEFT: 5px; PADDING-RIGHT: 5px; BORDER-TOP: rgb(211,211,211) 1px dashed; BORDER-RIGHT: rgb(211,211,211) 1px dashed; PADDING-TOP: 5px" align=middle><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 src="/UserFiles/Image/Trial/palette.png"><BR><A class=b title="������� ������� ���������" href="http://www.phpshop.ru/docs/service.html#2">������� �</A></TD>\r\n<TD><A title="���������� � ��������" href="/?skin=blue_classic"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_1_small.gif" width=100 height=80></A></TD>\r\n<TD><A title="���������� � ��������" href="/?skin=red_classic"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 alt="���������� � ��������" src="/UserFiles/Image/Trial/def_skin_2_small.gif" width=100 height=80></A></TD>\r\n<TD style="BORDER-BOTTOM: rgb(211,211,211) 1px dashed; BORDER-LEFT: rgb(211,211,211) 1px dashed; PADDING-BOTTOM: 5px; PADDING-LEFT: 5px; PADDING-RIGHT: 5px; BORDER-TOP: rgb(211,211,211) 1px dashed; BORDER-RIGHT: rgb(211,211,211) 1px dashed; PADDING-TOP: 5px" align=middle><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) border=0 src="/UserFiles/Image/Trial/palette.png"><BR><A class=b title="�������� ������������� �������" href="http://www.phpshop.ru/docs/service.html#vip">VIP-������ �</A></TD></TR></TBODY></TABLE></DIV>', '', 0, 1279195508, '', '', '1', '0', '');
     

CREATE TABLE `phpshop_page_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `num` int(64) NOT NULL default '1',
  `parent_to` int(11) NOT NULL default '0',
  `content` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `parent_to` (`parent_to`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_page_categories` VALUES
(1, '�������� ����������', 0, 0, '');

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

INSERT INTO `phpshop_products` VALUES
(1, 2, '���� BINATONE SI 2000 A', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n', '<div>���� � ����� SI-2000A<br>\r\n<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p></div>\r\n<div>��������� ������������� ������<br>����������� ����� ������<br>������� �����������<br>����� ��� ������� �����<br>������ ��������� � ���������</div>\r\n', '500', '0', '0', '1', '1', '', '1', '3,37', 'i23-47ii5-9i', 'a:2:{i:23;a:1:{i:0;s:2:\"47\";}i:5;a:1:{i:0;s:1:\"9\";}}', '', 0, '1', '', '0', 1278410795, 'page2,', 1, '', '0', '@Product@', '', '������ ����', '1', '', '/UserFiles/Image/Trial/img1_14333s.jpg', '/UserFiles/Image/Trial/img1_14333.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 0, '100', '0', '0', '0', '0', 'N;', 6, '', ''),
(2, 2, '���� BINATONE SI-2000 WG', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n', '600', '0', '0', '1', '1', '', '1', '3,37', 'i23-45ii5-9i', 'a:2:{i:23;a:1:{i:0;s:2:\"45\";}i:5;a:1:{i:0;s:1:\"9\";}}', '', 0, '1', '', '0', 1278410852, 'page5,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img2_11819s.jpg', '/UserFiles/Image/Trial/img2_11819.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 100, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(3, 2, '���� BINATONE SI 2600 W', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n', '650', '0', '0', '1', '1', '', '1', '1,2', 'i23-46ii5-10i', 'a:2:{i:23;a:1:{i:0;s:2:\"46\";}i:5;a:1:{i:0;s:2:\"10\";}}', '', 0, '1', '', '0', 1278410927, 'page6,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img3_47552s.jpg', '/UserFiles/Image/Trial/img3_47552.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 34, '400', '0', '0', '0', '0', 'a:1:{i:0;s:26:\"/UserFiles/Image/chars.rar\";}', 6, '', ''),
(6, 3, '������� ��� ������� PHILIPS QC 5050', '����� ������� ������ �������� ��������� ������ � �������� ��������. ������� ��� ������� ����� Complete Control ���� ������������ �������� � ���������� ����������.\r\n', '<span style=\\\"font-family: Arial;\\\">����� ������� ������ �������� ��������� ������ � �������� ��������. ������� ��� ������� ����� Complete Control ���� ������������ �������� � ���������� ����������.</span><br><br>\r\n', '1000', '0', '0', '1', '1', '', '1', '7,8', 'i2-1ii14-98ii23-45i', 'a:3:{i:2;a:1:{i:0;s:1:\"1\";}i:14;a:1:{i:0;s:2:\"98\";}i:23;a:1:{i:0;s:2:\"45\";}}', '', 0, '1', '', '0', 1278409987, 'page2,', 1, '', '0', '', '', 'PHILIPS', '1', '', '/UserFiles/Image/Trial/img6_81860s.jpg', '/UserFiles/Image/Trial/img6_81860.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 5, '140', '0', '0', '0', '0', 'N;', 5, '', ''),
(7, 3, '������� ��� ������� PHILIPS QC 5070', 'Philishave Super Easy. ������� � ������������� ������� ��� ������� ����� � 8 ����������� ����� (1-21 ��), ������ ��������� Flexcomb � ���������� �����. �������� ������� � �������� �������� - ������ � ������.\r\n', 'Philishave Super Easy. ������� � ������������� ������� ��� ������� ����� � 8 ����������� ����� (1-21 ��), ������ ��������� Flexcomb � ���������� �����. �������� ������� � �������� �������� - ������ � ������.\r\n', '2400', '0', '0', '1', '1', '', '1', '5,38', 'i2-1ii14-98ii23-46i', 'a:3:{i:2;a:1:{i:0;s:1:\"1\";}i:14;a:1:{i:0;s:2:\"98\";}i:23;a:1:{i:0;s:2:\"46\";}}', '', 0, '1', '', '0', 1278410429, 'page3,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img7_91321s.jpg', '/UserFiles/Image/Trial/img7_91321.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 45, '200', '0', '0', '0', '0', 'N;', 6, '��.', ''),
(8, 3, '������� ��� ������� PHILIPS QC 5099', 'Philishave MaxPricision. �� ������� � �������� �������� ������� ����������� ����� ���������������� �������. ������� ��� ������� ����� MaxPrecision ����� 15 �������� ����� (1-41 ��) � �������� ������������ ������� ��� �������� ���������� ��������.\r\n', 'Philishave MaxPricision. �� ������� � �������� �������� ������� ����������� ����� ���������������� �������. ������� ��� ������� ����� MaxPrecision ����� 15 �������� ����� (1-41 ��) � �������� ������������ ������� ��� �������� ���������� ��������.\r\n', '2600', '0', '0', '1', '1', '', '1', '38,6', 'i2-2ii14-98ii23-47i', 'a:3:{i:2;a:1:{i:0;s:1:\"2\";}i:14;a:1:{i:0;s:2:\"98\";}i:23;a:1:{i:0;s:2:\"47\";}}', '', 0, '1', '', '0', 1278410487, 'page5,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img8_21440s.jpg', '/UserFiles/Image/Trial/img8_21440.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 38, '300', '0', '0', '0', '0', 'N;', 6, '', ''),
(9, 4, '������������� BINATONE AEJ-1501 CG|WG', '������ �� ������ ��� ���� �������������� ��� ��������� ����������� 1.5 � ����� ������ ���� �������� 2000 �� �������� ��������� ������\r\n\r\n\r\n\r\n\r\n', '������ �� ������ ��� ���� �������������� ��� ��������� ����������� 1.5 � ����� ������ ���� �������� 2000 �� �������� ��������� ������\r\n\r\n\r\n\r\n\r\n', '300', '500', '0', '1', '1', '100', '1', '11,12', 'i2-96ii23-47i', 'a:2:{i:2;a:1:{i:0;s:2:\"96\";}i:23;a:1:{i:0;s:2:\"47\";}}', '', 0, '1', '', '0', 1278408998, 'page2,', 1, '', '0', '', '', '������ �������������', '1', '', '/UserFiles/Image/Trial/img9_47633s.jpg', '/UserFiles/Image/Trial/img9_47633.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 50, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(10, 4, '������������� BINATONE CEJ-1012 CP', '��� ��������������� ��������: ������� (��������) �������� ��������������� ��������: ����������� ����� ��������: 1500 �� �����: 1 � ������ ������ ������: �������������\r\n\r\n\r\n', '��� ��������������� ��������: ������� (��������) �������� ��������������� ��������: ����������� ����� ��������: 1500 �� �����: 1 � ������ ������ ������: �������������\r\n\r\n\r\n', '700', '965', '0', '1', '1', '', '1', '11,12', 'i2-96ii23-47i', 'a:2:{i:2;a:1:{i:0;s:2:\"96\";}i:23;a:1:{i:0;s:2:\"47\";}}', '', 0, '1', '', '0', 1278409123, 'page3,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img10_20493s.jpg', '/UserFiles/Image/Trial/img10_20493.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 44, '150', '0', '0', '0', '0', 'N;', 6, '', '#1#3'),
(11, 4, '������������� BINATONE CEJ-3300 CP|SG|T|WG', '��� ��������������� ��������: ������� (��������) �������� ��������������� ��������: ����������� ����� �������� (��): 2200 ����� (�): 2 ������ ������ ������: �������������\r\n\r\n\r\n\r\n\r\n\r\n', '��� ��������������� ��������: ������� (��������) �������� ��������������� ��������: ����������� ����� �������� (��): 2200 ����� (�): 2 ������ ������ ������: �������������\r\n\r\n\r\n\r\n\r\n\r\n', '1000', '0', '0', '1', '1', '', '1', '9,10', 'i2-1ii23-45i', 'a:2:{i:2;a:1:{i:0;s:1:\"1\";}i:23;a:1:{i:0;s:2:\"45\";}}', '', 0, '1', '', '0', 1278409414, 'page5,page7,page9,page10,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img11_15809s.jpg', '/UserFiles/Image/Trial/img11_15809.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 65, '150', '0', '0', '0', '0', 'N;', 6, '�����', ''),
(12, 4, '������������� BINATONE CEJ-3500 BB|BS|CP', 'MAGIC - thermo control, 2200��, 2�., ����� ����������, ����������� ���������� ����������� ���� � ������� �� ����� ���������� ���������: - ����� - ����������� ���� �� 40�C, - ������ - ����������� ���� �� 40�C �� 80�C,�� 80�C - �������, ������ �����\r\n\r\n\r\n', 'MAGIC - thermo control, 2200��, 2�., ����� ����������, ����������� ���������� ����������� ���� � ������� �� ����� ���������� ���������: - ����� - ����������� ���� �� 40�C, - ������ - ����������� ���� �� 40�C �� 80�C,�� 80�C - �������, ������ �����\r\n\r\n\r\n', '875', '0', '0', '1', '1', '', '1', '9,10', 'i2-2ii23-46i', 'a:2:{i:2;a:1:{i:0;s:1:\"2\";}i:23;a:1:{i:0;s:2:\"46\";}}', '', 0, '1', '', '0', 1278409468, 'page6,page10,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img12_78129s.jpg', '/UserFiles/Image/Trial/img12_78129.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 55, '300', '0', '0', '0', '0', 'N;', 6, '', ''),
(13, 6, '������������� ���� DELONGHI MW 355', '������������ ���������� ������ �� 30 ��� �������� ������ ���������� ���� �������� ��������� 700 �� EMD ���������� ������� �������� 5\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '������������ ���������� ������ �� 30 ��� �������� ������ ���������� ���� �������� ��������� 700 �� EMD ���������� ������� �������� 5\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '1578', '0', '0', '1', '1', '', '1', '15,16', 'i14-26ii15-31ii10-19i', 'a:3:{i:14;a:1:{i:0;s:2:\"26\";}i:15;a:1:{i:0;s:2:\"31\";}i:10;a:1:{i:0;s:2:\"19\";}}', '', 0, '1', '', '0', 1278414654, 'page2,', 1, '', '0', '', '', '������������� ����', '1', '', '/UserFiles/Image/Trial/img13_19444s.jpg', '/UserFiles/Image/Trial/img13_19444.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 199, '4', '0', '0', '0', '0', 'N;', 6, '��', ''),
(14, 6, '������������� ���� MOULINEX AFM4 43', '����� 22 � ��� ���������� ��������� ���������� ����� 290 �� �������� �������� ����������, �� 850 ������������ �������� �����, �� 1100 �������������� ������� ����� ��� ������� �������� - 6\r\n\r\n', '����� 22 � ��� ���������� ��������� ���������� ����� 290 �� �������� �������� ����������, �� 850 ������������ �������� �����, �� 1100 �������������� ������� ����� ��� ������� �������� - 6\r\n\r\n', '3000', '0', '0', '1', '1', '', '1', '15,16', 'i14-27ii15-30ii10-19i', 'a:3:{i:14;a:1:{i:0;s:2:\"27\";}i:15;a:1:{i:0;s:2:\"30\";}i:10;a:1:{i:0;s:2:\"19\";}}', '', 0, '1', '', '0', 1278414302, 'page3,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img14_90055s.jpg', '/UserFiles/Image/Trial/img14_90055.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 22, '166', '0', '0', '0', '0', 'N;', 6, '��.', ''),
(15, 6, '������������� ���� SAMSUNG C-100 R-5', '����� - 20 �, ������������� ���� � ������, �������� ��� - 750 ��, �������� ����� - 1100 ��, 6 ������� ��������, ��� ���������� - ������������, ������� ��� �����, ���-������������ �����, ������ �� 60 ���., ������� �.�.�.\r\n\r\n\r\n', '����� - 20 �, ������������� ���� � ������, �������� ��� - 750 ��, �������� ����� - 1100 ��, 6 ������� ��������, ��� ���������� - ������������, ������� ��� �����, ���-������������ �����, ������ �� 60 ���., ������� �.�.�.\r\n\r\n\r\n', '1025', '1320', '0', '1', '1', '', '1', '13,14', 'i14-28ii15-30ii10-19i', 'a:3:{i:14;a:1:{i:0;s:2:\"28\";}i:15;a:1:{i:0;s:2:\"30\";}i:10;a:1:{i:0;s:2:\"19\";}}', '', 0, '1', '', '0', 1278414374, 'page5,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img15_14316s.jpg', '/UserFiles/Image/Trial/img15_14316.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '16', 45, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(16, 6, '������������� ���� SAMSUNG CE-2833 NR', '������������� ���� � ������ ����� - 23 � �������� ��� - 850 �� / ����� - 1110 �� 6 ������� �������� ��� ���������� - �������� +Dial ���-������������ ����� ������� �.�.�.\r\n', '������������� ���� � ������ ����� - 23 � �������� ��� - 850 �� / ����� - 1110 �� 6 ������� �������� ��� ���������� - �������� +Dial ���-������������ ����� ������� �.�.�.\r\n', '2000', '0', '0', '1', '1', '', '1', '13,14', 'i14-28ii15-31ii10-20i', 'a:3:{i:14;a:1:{i:0;s:2:\"28\";}i:15;a:1:{i:0;s:2:\"31\";}i:10;a:1:{i:0;s:2:\"20\";}}', '', 0, '1', '', '0', 1278414433, 'page6,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img16_14316s.jpg', '/UserFiles/Image/Trial/img16_14316.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 68, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(17, 7, '���������� ������ WHIRLPOOL AWO|D 43115', '���������� Silver Nano ������������ ����������� ����� ���������������� - A ����� ������ - A ����� ������ - D �������� (��) - 40 / 4,5 �������� ��� �������� (�����, ��) 598 x 404 x 850\r\n', '���������� Silver Nano ������������ ����������� ����� ���������������� - A ����� ������ - A ����� ������ - D �������� (��) - 40 / 4,5 �������� ��� �������� (�����, ��) 598 x 404 x 850\r\n', '7523', '0', '0', '1', '1', '', '1', '19,20', 'i9-16ii19-41ii21-43i', 'a:3:{i:9;a:1:{i:0;s:2:\"16\";}i:19;a:1:{i:0;s:2:\"41\";}i:21;a:1:{i:0;s:2:\"43\";}}', '', 0, '1', '', '0', 1278416385, 'page2,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img17_13782s.jpg', '/UserFiles/Image/Trial/img17_13782.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 20, '560', '0', '0', '0', '0', 'N;', 6, '', ''),
(18, 7, '���������� ������ CANDY Aquamatic 1000T-45', '��������: ������ (��) 69.5, ������ (��) 51, ������� (��) 44 ��� �������� ����������� �������� (��) 3.5 ����� (��/���) 1000 ����� ������ A /����� � �������������������/ ����� ������ C C����� �������������: ������\r\n', '��������: ������ (��) 69.5, ������ (��) 51, ������� (��) 44 ��� �������� ����������� �������� (��) 3.5 ����� (��/���) 1000 ����� ������ A /����� � �������������������/ ����� ������ C C����� �������������: ������\r\n', '2500', '3250', '0', '1', '1', '', '1', '19,20', 'i9-17ii19-41ii21-42i', 'a:3:{i:9;a:1:{i:0;s:2:\"17\";}i:19;a:1:{i:0;s:2:\"41\";}i:21;a:1:{i:0;s:2:\"42\";}}', '', 0, '1', '', '0', 1278416443, 'page3,', 1, '', '0', '', '', '���������� �������', '1', '', '/UserFiles/Image/Trial/img18_37948s.jpg', '/UserFiles/Image/Trial/img18_37948.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 24, '600', '0', '0', '0', '0', 'N;', 6, '', ''),
(19, 7, '���������� ������ CANDY CNL 105', '�������: ������ (��) 85, ������ (��) 60, ������� (��) 52 ��� �������� ����������� �������� (��) 5 ����� (��/���) 0-1000 ����� ������ A /����� � �������������������!/ ����� ������ C C����� �������������: ������, �������\r\n', '�������: ������ (��) 85, ������ (��) 60, ������� (��) 52 ��� �������� ����������� �������� (��) 5 ����� (��/���) 0-1000 ����� ������ A /����� � �������������������!/ ����� ������ C C����� �������������: ������, �������\r\n', '8020', '0', '0', '1', '1', '', '1', '17,18', 'i9-18ii19-40i', 'a:2:{i:9;a:1:{i:0;s:2:\"18\";}i:19;a:1:{i:0;s:2:\"40\";}}', '', 0, '1', '', '0', 1278416600, 'page5,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img19_12587s.jpg', '/UserFiles/Image/Trial/img19_12587.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 45, '360', '0', '0', '0', '0', 'N;', 6, '�', ''),
(20, 7, '���������� ������ CANDY Aquamatic 800T-45', '��������: ������ (��) 69.5, ������ (��) 51, ������� (��) 44 ��� �������� ����������� �������� (��) 3.5 ����� (��/���) 800 ����� ������ A /����� � �������������������/ ����� ������ D C����� �������������: ������\r\n\r\n', '��������: ������ (��) 69.5, ������ (��) 51, ������� (��) 44 ��� �������� ����������� �������� (��) 3.5 ����� (��/���) 800 ����� ������ A /����� � �������������������/ ����� ������ D C����� �������������: ������\r\n\r\n', '11230', '0', '0', '1', '1', '', '1', '17,18', 'i9-16ii19-40ii21-42i', 'a:3:{i:9;a:1:{i:0;s:2:\"16\";}i:19;a:1:{i:0;s:2:\"40\";}i:21;a:1:{i:0;s:2:\"42\";}}', '', 0, '1', '', '0', 1278416771, 'page6,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img20_35512s.jpg', '/UserFiles/Image/Trial/img20_35512.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 56, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(21, 8, '���������� MOULINEX OW 2000', '�������� 610 �� 12 ������� ������������� 68 ��������� ��������� ������������� ����� ������� ���� � ������������� ��������� ������� ����������� ������� � ������� ��������� �����: 500, 750, 1000 �\r\n\r\n\r\n\r\n', '�������� 610 �� 12 ������� ������������� 68 ��������� ��������� ������������� ����� ������� ���� � ������������� ��������� ������� ����������� ������� � ������� ��������� �����: 500, 750, 1000 �\r\n\r\n\r\n\r\n', '2005', '2350', '0', '1', '1', '', '1', '23,24', 'i2-2ii14-27ii23-46ii10-19i', 'a:4:{i:2;a:1:{i:0;s:1:\"2\";}i:14;a:1:{i:0;s:2:\"27\";}i:23;a:1:{i:0;s:2:\"46\";}i:10;a:1:{i:0;s:2:\"19\";}}', '', 0, '1', '', '0', 1278415795, 'page2,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img21_74428s.jpg', '/UserFiles/Image/Trial/img21_74428.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 23, '670', '1500', '0', '0', '0', 'N;', 6, '��', ''),
(22, 8, '���������� KENWOOD BM 250', '��� ������� �� 500 �� �� 1 ��. ������� ����������� ����������� ����� �� 58 ���. ����������� ������ ����� �������. ��������: 480 ��. 12 ��������.\r\n\r\n', '��� ������� �� 500 �� �� 1 ��. ������� ����������� ����������� ����� �� 58 ���. ����������� ������ ����� �������. ��������: 480 ��. 12 ��������.\r\n\r\n', '2000', '0', '0', '1', '1', '', '1', '23,24', 'i2-1ii14-37ii23-45ii10-19i', 'a:4:{i:2;a:1:{i:0;s:1:\"1\";}i:14;a:1:{i:0;s:2:\"37\";}i:23;a:1:{i:0;s:2:\"45\";}i:10;a:1:{i:0;s:2:\"19\";}}', '', 0, '1', '', '0', 1278415854, 'page3,', 1, '', '0', '', '', '���������� KENWOOD', '1', '', '/UserFiles/Image/Trial/img22_14431s.jpg', '/UserFiles/Image/Trial/img22_14431.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '23', 34, '456', '0', '0', '0', '0', 'N;', 6, '', ''),
(23, 8, '���������� KENWOOD BM 256', '�����: Principio ��������, ��: 260 ���������� �������� - �������� ��� ���������� - ������������ ������ ������ ������� - 2 ��������� - ���� ��� ����� - ���\r\n\r\n', '�����: Principio ��������, ��: 2600 ���������� �������� - �������� ��� ���������� - ������������ ������ ������ ������� - 2 ��������� - ���� ��� ����� - ���\r\n\r\n', '1863', '0', '0', '1', '1', '', '1', '21,22', 'i2-2ii14-37ii23-47ii10-19i', 'a:4:{i:2;a:1:{i:0;s:1:\"2\";}i:14;a:1:{i:0;s:2:\"37\";}i:23;a:1:{i:0;s:2:\"47\";}i:10;a:1:{i:0;s:2:\"19\";}}', '', 0, '1', '', '0', 1278415941, 'page5,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img23_16936s.jpg', '/UserFiles/Image/Trial/img23_16936.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 45, '333', '0', '0', '0', '0', 'N;', 6, '��', ''),
(24, 8, '���������� KENWOOD BM 350', '��� ������� �� 500 �� �� 1 ��. ������� ����������� ����������� ����� �� 58 ���. ����������� ������ ����� �������. ��������: 480 ��. 12 ��������. ������ �� ����������� ����� � ����� ����������� ������� � ����������� �������.\r\n', '��� ������� �� 500 �� �� 1 ��. ������� ����������� ����������� ����� �� 58 ���. ����������� ������ ����� �������. ��������: 480 ��. 12 ��������. ������ �� ����������� ����� � ����� ����������� ������� � ����������� �������.\r\n', '3000', '0', '0', '1', '1', '', '1', '21,22', 'i14-37ii23-45i', 'a:2:{i:14;a:1:{i:0;s:2:\"37\";}i:23;a:1:{i:0;s:2:\"45\";}}', '', 0, '1', '', '0', 1278416004, 'page6,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img24_20598s.jpg', '/UserFiles/Image/Trial/img24_20598.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '22,23', 46, '560', '0', '0', '0', '0', 'N;', 6, '', ''),
(25, 10, '��-��������� SONY KDL-52HX900', '����������� ������������������� ����������� ������� � ��� ���� 52� (132 ��), Full HD 1080, �� �� 3D � ������������ \r\n������������ ���������� � Motionflow 400 PRO\r\n', '����������� ������������������� ����������� ������� � ��� ���� 52� (132 \r\n��), Full HD 1080, �� �� 3D � ������������ \r\n������������ ���������� � Motionflow 400 PRO\r\n\r\n', '30000', '0', '0', '1', '1', '', '1', '27,28', 'i2-1ii10-19i', 'a:2:{i:2;a:1:{i:0;s:1:\"1\";}i:10;a:1:{i:0;s:2:\"19\";}}', '', 0, '1', '', '0', 1278419768, 'page2,', 1, '', '0', '', '', '��������� SONY', '1', '', '/UserFiles/Image/Trial/img25_17522s.jpg', '/UserFiles/Image/Trial/img25_17522.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 67, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(26, 10, '��-��������� SONY KDL-19BX200|W', '���������� ��������� High Definition �������� ��� ����� \r\n�������<br><br>����� ����� S � ���������� 40\\\" - ��� �������� ��-���������� � ������� ��������� �����������, ������� �������������� �������� \\\"BRAVIA ENGINE\\\" � ������������������ ��-�������\r\n\r\n\r\n\r\n\r\n\r\n', '���������� ��������� High Definition �������� ��� ����� \r\n�������<br>\r\n<br>\r\n����� ����� S � ���������� 40\\\" - ��� �������� ��-���������� � ������� \r\n��������� �����������, ������� �������������� �������� \\\"BRAVIA ENGINE\\\" �\r\n ������������������ ��-�������\r\n\r\n\r\n\r\n\r\n\r\n', '25000', '0', '0', '1', '1', '', '1', '27,28', 'i2-96ii10-19i', 'a:2:{i:2;a:1:{i:0;s:2:\"96\";}i:10;a:1:{i:0;s:2:\"19\";}}', '', 0, '1', '', '0', 1278420010, 'page3,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img26_12295s.jpg', '/UserFiles/Image/Trial/img26_12295.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 56, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(27, 10, '��-��������� Sony KDL-46NX700', '��������� ������� ������� � �������� �����������\r\n\r\n\r\n\r\n', '<p>46� (117 ��), Full HD 1080, �� �� BRAVIA Monolith � ���������� Edge \r\nLED � ����. Wi-Fi�</p><ul><li>BRAVIA Monolith � ���������� ����� � ������� ��������</li><li>�������� Wi-Fi�-����������� � ����������� �������� � �������</li><li>������ � ������� ����������� ���������� ���� ���� � ���������� \r\n�������</li></ul>� ����� ����� V � ���������� 32\\\" � ���������� ������� HD ������������ ������������ �������������� �� Sony: \\\"Live Colour Creation\\\", BRAVIA ENGINE � ������������������ ��-������. ����� ����� ����� ����������� ����������� ����������� � ������� �������.\r\n\r\n\r\n\r\n\r\n', '32000', '33800', '0', '1', '1', '', '1', '25,26', 'i2-96i', 'a:1:{i:2;a:1:{i:0;s:2:\"96\";}}', '', 0, '1', '', '0', 1278419894, 'page5,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img27_13427s.jpg', '/UserFiles/Image/Trial/img27_13427.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 56, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(28, 10, '��-��������� SONY KDL-32S2000', '��������� 81 ��, 2&#215;10, 1366&#215;768, ��������� � HDTV, ����������� DNLe, ��������� LNA+, ����������� ������������� PC.', '��������� 81 ��, 2&#215;10, 1366&#215;768, ��������� � HDTV, ����������� DNLe, ��������� LNA+, ����������� ������������� PC, ������� ���� S-PVA, �������� 1000:1, ������� 500 ��/�&#178;, ��������� HDMI, ������� &lt;�������� � ��������&gt; � &lt;������� �����&gt;, FM-�����, ������ NICAM, �������� SRS TruSurround XT, ���������: 1000 �������, ������������ ����� ��', '35000', '0', '0', '1', '1', '', '1', '25,26', '', 'N;', '', 0, '1', '', '0', 1278425888, 'page6,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img28_64148s.jpg', '/UserFiles/Image/Trial/img28_64148.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 55, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(29, 11, '�������� ����������� SONY DSC-W380', 'W380�������� ���������� ����������<br><br>����������������� ������� ��������� ����������� � ������� \r\nSweep Panorama � ������� ��������� ������\r\n\r\n\r\n', '<p>14,1 ��, �������� G f/2,4, 5x ���������� ���/��������. �������� 24 \r\n��, ����� HD, ��-����� 6,7 ��</p><ul class=\\\"reasonsToBuy\\\"><li>������ ����������� �������� ������ ����������</li><li>������������ �������� ��������� �������� ������������ ���������\r\n ������ ��� ������������� ���������</li><li>����������� ������� ���������� ������</li></ul>\r\n', '10000', '800', '0', '1', '1', '', '1', '31,32', 'i2-96ii10-19ii24-51i', 'a:3:{i:2;a:1:{i:0;s:2:\"96\";}i:10;a:1:{i:0;s:2:\"19\";}i:24;a:1:{i:0;s:2:\"51\";}}', '', 0, '1', '', '0', 1278420925, 'page2,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img29_90265s.jpg', '/UserFiles/Image/Trial/img29_90265.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 67, '130', '0', '0', '0', '0', 'N;', 6, '', ''),
(30, 11, '�������� ����������� SONY DSC-TX7', '��������������� � �������� ���������� � �������� Intelligent Sweep \r\nPanorama � ������������ ������������� ������', '<p>������� Exmor R� CMOS, 4x ���. ���/���. �������� 25 ��, ������ ����� \r\n1080i HD, ����. ��-����� 8,8 ��</p><ul class=\\\"reasonsToBuy\\\"><li>������ � �������� ������ � ������ ��������� ���������</li><li>����������� ������� ��������� �����</li><li>���������� �������� �������� � HD-����� ������� 1080i</li></ul>', '9800', '0', '0', '1', '1', '', '1', '31,32', 'i2-1ii10-19ii24-51i', 'a:3:{i:2;a:1:{i:0;s:1:\"1\";}i:10;a:1:{i:0;s:2:\"19\";}i:24;a:1:{i:0;s:2:\"51\";}}', '', 0, '1', '', '0', 1278421265, 'page3,', 1, '', '0', '', '', '������ �����������', '1', '', '/UserFiles/Image/Trial/img30_80985s.jpg', '/UserFiles/Image/Trial/img30_80985.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 45, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(31, 11, '�������� ����������� SONY DSLR-A45', 'A450&nbsp;�������� ���������� ����������<br><br>�������������� �������� �������, ������� �������� ������� � \r\n������ ������� ��������������', '<p>14.2 �� Exmor� CMOS, 7 ����/�*, ��-����� 6,9 ��, SteadyShot INSIDE. \r\n������ ������</p><ul class=\\\"reasonsToBuy\\\"><li>����������� � ������ ����������� ����� � ������� ������������</li><li>���������������� �������� ������</li><li>�������� ����������������� ������ �� ������������</li></ul>', '7963', '0', '0', '1', '1', '', '1', '29,30', 'i2-1ii10-19ii24-50i', 'a:3:{i:2;a:1:{i:0;s:1:\"1\";}i:10;a:1:{i:0;s:2:\"19\";}i:24;a:1:{i:0;s:2:\"50\";}}', '', 0, '1', '', '0', 1278421835, 'page5,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img31_15570s.jpg', '/UserFiles/Image/Trial/img31_15570.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 29, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(32, 11, '�������� ����������� SONY A290L', '�������� ���������� ����������<br>����� ������ � ���������� ������ ������ ����� � ���� � �������� \r\n�������� ���������<br>', '����� ������ � ���������� ������ ������ ����� � ���� � �������� \r\n�������� ���������<p>14,2 ��, 2,5 ������/�, ��-����� 6,9 ��, ���������� SteadyShot \r\nINSIDE, HDMI�. �������� 18-55 ��.</p><ul class=\\\"reasonsToBuy\\\"><li>������, ���������� � ������� � ������</li><li>���� ������� ����� �������� ��������� ����������</li><li>����� ������� �������� �����������</li></ul>', '5890', '6000', '0', '1', '1', '', '1', '29,30', 'i2-96ii10-19ii24-92i', 'a:3:{i:2;a:1:{i:0;s:2:\"96\";}i:10;a:1:{i:0;s:2:\"19\";}i:24;a:1:{i:0;s:2:\"92\";}}', '', 0, '1', '', '0', 1278422002, 'page6,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img32_19735s.jpg', '/UserFiles/Image/Trial/img32_19735.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 46, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(33, 12, 'Apple iPod nano 8�� (5G)', '<strong>iPod nano</strong> � ��� �� ������ �������� MP3-����� �������� \r\n���������� ������. ������������ ����� ������������ \r\n���������� � ���������� ��������, ���������� ��� ��������� �������� <strong>Apple</strong>.\r\n', '��������� ����� - ����� H.264: �� 1,5 ��/�, 640 �\r\n 480 ��������, 30 ������ � �������, ������� Baseline Profile Low \r\nComplexity � ����� AAC-LC �� 160 ��/�, 48 ���, ���������� � �������� \r\n.m4v, .mp4 � .mov; ����� H.264 �� 2,5 ��/�, 640 � 480 ��������, 30 \r\n������ � �������, ������� Baseline Profile Level 3.0 � ����� AAC-LC �� \r\n160 ��/�, 48 ���, ���������� � �������� .m4v, .mp4 � .mov; ����� MPEG-4,\r\n �� 2,5 ��/�, 640 � 480 ��������, 30 ������ � �������, ������� Simple \r\nProfile � ����� AAC-LC �� 160 ��/�, 48 ���, ���������� � �������� .m4v, \r\n.mp4 � .mov.\r\n', '1200', '0', '0', '1', '1', '', '1', '35,36', 'i2-1ii10-19ii28-58i', 'a:3:{i:2;a:1:{i:0;s:1:\"1\";}i:10;a:1:{i:0;s:2:\"19\";}i:28;a:1:{i:0;s:2:\"58\";}}', '', 0, '1', '', '0', 1278422732, 'page2,', 1, '', '0', '', '', 'MP3 ����� DEX', '1', '', '/UserFiles/Image/Trial/img33_15359s.jpg', '/UserFiles/Image/Trial/img33_15359.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 11, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(34, 12, 'iPod classic 160GB', '160 �� ������ iPod classic � ��� 40 000 �����, 200 ����� ����� ��� 25 \r\n000 ����������. �����, ��� ����������, ����� �� ������� ��������...1 � \r\n����� � ��� �����!', '��, ��� �����, ����� ������ �������� �����, ������� � iTunes. ������ \r\n�������������� ��������� � ����������� �������. ������� ������ ���������\r\n iPod classic �������, �����, ������ � ����������.', '1110', '1325', '1', '1', '1', '', '1', '35,36', 'i2-2ii28-58i', 'a:2:{i:2;a:1:{i:0;s:1:\"2\";}i:28;a:1:{i:0;s:2:\"58\";}}', '', 0, '1', '', '0', 1278422714, 'page3,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img34_84429s.jpg', '/UserFiles/Image/Trial/img34_84429.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '', 0, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(35, 12, 'Apple iPod touch 32GB (3G)', '������-�����������, ������ MP3-�����, � ������� ����������� �������, \r\n������� ������� ��������������� �������. �������� ������� ��� ������ � \r\n����� ����������� ������ ���� ���������� ��������, ����������� ��� ���� \r\n��������� �� Apple.', '<strong>Apple iPod touch</strong> �������� ������� ��������� ������� � \r\n����������� \\\"Multi-touch�, ��������� ���� ��� ��������� ����������� ��� \r\n������ ������� ������������� ������� � �������.<br>\r\n<strong> </strong>������� ������� iPod touch �������� �������� ��� \r\n��������� ����, ����� � �����������. ���������� ������ ������������� \r\n���������� ������� ������� � ����������� �� ���������.', '900', '0', '1', '1', '1', '', '1', '33,34', 'i2-96ii28-59i', 'a:2:{i:2;a:1:{i:0;s:2:\"96\";}i:28;a:1:{i:0;s:2:\"59\";}}', '', 0, '1', '', '0', 1278422899, 'page5,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img35_79801s.jpg', '/UserFiles/Image/Trial/img35_79801.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '34,36', 0, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(36, 12, 'iPod Shuffle', '� iPod shuffle ��������� ��������� ���������� Apple � ������� ������ \r\n���������� �����. �� ����� ��������� ����������� ��� �������� \r\n����������� �� ���������� �����. <br>\r\n', '����������� � �������<li>���������� �������� ����������� � ���������� ������������</li><li>����� ���������������: �� 10 ����� ��� ������ ������ \r\n������������</li><li>������� ����� USB �� ���������� ��� �������� ������� \r\n(�������� ��������)</li><li>������� �� 80% �� 2 ����, ������ ������� �� 3 ����.</li>\r\n', '1500', '0', '1', '1', '1', '', '1', '33,34', 'i2-1ii10-19ii28-59i', 'a:3:{i:2;a:1:{i:0;s:1:\"1\";}i:10;a:1:{i:0;s:2:\"19\";}i:28;a:1:{i:0;s:2:\"59\";}}', '', 0, '1', '', '0', 1278423912, 'page6,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img36_11726s.jpg', '/UserFiles/Image/Trial/img36_11726.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '33,34', 0, '0', '0', '0', '0', '0', 'N;', 6, '', ''),
(37, 2, '���� BINATONE SI 2660 W', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n\r\n', '<p>��������� ������ ���������������<br>�����<br>��������� ������������� ������</p>\r\n\r\n', '700', '850', '0', '1', '1', '', '1', '1,2', 'i23-45ii5-84i', 'a:2:{i:23;a:1:{i:0;s:2:\"45\";}i:5;a:1:{i:0;s:2:\"84\";}}', '', 0, '', '', '0', 1278596999, 'page3,', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img37_11242s.jpg', '/UserFiles/Image/Trial/img37_11242.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '3', 22, '300', '0', '0', '0', '0', 'N;', 6, '', ''),
(38, 3, '������� ��� ������� PHILIPS QC 5000', '����� ������� ������ �������� ��������� ������ � �������� ��������. ������� ��� ������� ����� Complete Control ���� ������������ �������� � ���������� ����������.\r\n', '<p style=\\\"font-family: Arial;\\\">����� ������� ������ �������� ��������� ������ � �������� ��������. ������� ��� ������� ����� Complete Control ���� ������������ �������� � ���������� ����������. </p>\r\n', '700', '850', '0', '1', '1', '', '1', '6,7', 'i2-2ii14-98ii23-45i', 'a:3:{i:2;a:1:{i:0;s:1:\"2\";}i:14;a:1:{i:0;s:2:\"98\";}i:23;a:1:{i:0;s:2:\"45\";}}', '0', 0, '1', '', '0', 1278410586, 'page6,', 3, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img38_17545s.jpg', '/UserFiles/Image/Trial/img38_17545.jpg', 'a:4:{s:11:\"bid_enabled\";s:0:\"\";s:3:\"bid\";s:0:\"\";s:12:\"cbid_enabled\";s:0:\"\";s:4:\"cbid\";s:0:\"\";}', '0', '7,8', 49, '450', '0', '0', '0', '0', 'N;', 6, '��.', '');

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


INSERT INTO `phpshop_rssgraber` VALUES (1, 'http://www.phpshop.ru/rss.php', 1, 10, '1', 1307995200, 1322686800, 1);
    


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

INSERT INTO `phpshop_sort` VALUES
(1, '�������', 2, 1, ''),
(2, '�����', 2, 2, ''),
(4, '2000', 3, 0, ''),
(7, '����', 4, 1, ''),
(8, '���', 4, 2, ''),
(9, '��������', 5, 1, ''),
(10, '����. �����', 5, 2, ''),
(11, 'SONY', 6, 1, ''),
(12, 'PHILIPS', 6, 2, ''),
(13, '32', 7, 1, ''),
(14, '40', 7, 2, ''),
(15, '42', 7, 3, ''),
(16, '1 �', 9, 1, ''),
(17, '1.5 �', 9, 2, ''),
(18, '2 �', 9, 3, ''),
(19, '1500 ��', 10, 1, ''),
(20, '2000 ��', 10, 2, ''),
(22, '����', 12, 1, ''),
(23, '�����������', 12, 2, ''),
(30, '750 ��', 15, 2, ''),
(29, '700 ��', 15, 1, ''),
(26, 'DELONGHI', 14, 0, ''),
(27, 'MOULINEX ', 14, 0, ''),
(28, 'SAMSUNG', 14, 0, ''),
(31, '850 ��', 15, 3, ''),
(32, '������������', 16, 1, ''),
(33, '�����������', 16, 2, ''),
(34, '20 �', 17, 1, ''),
(35, '22 �', 17, 2, ''),
(36, '23 �', 17, 3, ''),
(37, 'KENWOOD', 14, 0, ''),
(38, 'CANDY ', 14, 0, ''),
(39, 'WHIRLPOOL', 14, 0, ''),
(40, '�����������', 19, 1, ''),
(41, '������������', 19, 2, ''),
(42, '3.5 ��', 21, 1, ''),
(43, '4 ��', 21, 2, ''),
(44, '5 ��', 21, 3, ''),
(45, '480 ��', 23, 2, ''),
(46, '610 ��', 23, 3, ''),
(47, '260 ��', 23, 1, ''),
(48, '����', 25, 1, ''),
(49, '���', 25, 2, ''),
(50, '6.0', 24, 1, ''),
(51, '7.2', 24, 2, ''),
(52, '����', 27, 1, ''),
(53, '���', 27, 2, ''),
(54, 'White|Black', 29, 2, ''),
(56, 'Red|Silver', 29, 3, ''),
(57, 'Black|Silver', 29, 4, ''),
(58, '1 Gb', 28, 1, ''),
(59, '2 Gb', 28, 2, ''),
(96, '�������', 2, 0, ''),
(65, '5000', 3, 0, ''),
(66, '4000', 3, 0, ''),
(67, '12', 7, 0, ''),
(68, '55', 7, 0, ''),
(101, '6 �', 9, 0, ''),
(72, '123', 24, 0, ''),
(92, '22', 24, 0, ''),
(100, '���', 23, 0, ''),
(91, '12', 24, 0, ''),
(76, '�������', 12, 0, ''),
(79, '�����', 12, 0, ''),
(82, '������', 12, 0, ''),
(99, '132', 10, 0, ''),
(84, '�����', 5, 0, ''),
(98, 'PHILIPS', 14, 0, '');

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

INSERT INTO `phpshop_sort_categories` VALUES
(1, '�����', '0', 1, 0, '0', '����� ������', '0', '0', ''),
(2, '����� �����', '1', 0, 13, '1', '���� �����', '', '', ''),
(4, '��������', '', 0, 1, '', '������� ���������', '1', '1', ''),
(5, '�������� �������', '1', 0, 1, '1', '', '', '', ''),
(6, '�����', '1', 0, 26, '1', '', '', '', ''),
(7, '������ ������', '', 0, 8, '', '', '1', '1', ''),
(8, '����������', '0', 0, 0, '0', '', '0', '0', ''),
(9, '�����', '1', 0, 20, '1', '', '', '', ''),
(10, '����� ��������', '1', 0, 22, '1', '', '', '', ''),
(11, '�������', '0', 0, 0, '0', '', '0', '0', ''),
(13, '������� ��� �������', '0', 0, 0, '0', '', '0', '0', ''),
(14, '�������������', '1', 0, 13, '1', '', '', '', ''),
(15, '�������� ���������', '1', 0, 18, '1', '', '', '', ''),
(16, '��� ����������', '', 0, 13, '', '', '1', '1', ''),
(17, '�����', '1', 1, 13, '', '��� �������� �����', '1', '1', ''),
(18, '������������� ����', '0', 0, 0, '0', '', '0', '0', ''),
(19, '��� ��������', '1', 0, 20, '1', '', '', '', ''),
(20, '���������� ������', '0', 0, 0, '0', '', '0', '0', ''),
(21, '�������� �����', '1', 0, 20, '1', '', '', '', ''),
(22, '����������', '0', 0, 0, '0', '', '0', '0', ''),
(23, '��������', '1', 0, 13, '1', '', '', '', ''),
(24, '���-�� ������������', '1', 0, 26, '1', '', '', '', ''),
(27, '������������ �����������', '', 0, 26, '', '', '1', '1', ''),
(26, '������������', '0', 0, 0, '0', '', '0', '0', ''),
(28, '���������� ������', '1', 1, 26, '1', '', '', '', ''),
(29, '����', '1', 0, 13, '', '', '1', '1', ''),
(31, '���� ', '0', 0, 0, '0', '����� ���� ', '0', '0', ''),
(32, '�����', '0', 10, 0, '0', '', '0', '0', '');


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

INSERT INTO `phpshop_system` VALUES
(1, '��������-������� ���� ���', '���� ���', 10, 2, 6, '0', 'phpshop_7', 'mail@mail.ru', '������ ������� � ���������� ���������', '�������, ������, ������, ����������, ��������, MP3, �������������, �������������, �����������, �������, �������, �����, �����, ����, ������������, ����������, ����������, ������, DEX, SONY, PHILIPS, TEFAL, ROWENTA, SAMSUNG, KRUPS, BINATONE, KENWOOD', 6, 4, 4, '(495) 105-05-50', 'a:9:{s:8:\"org_name\";s:11:\"��� �������\";s:12:\"org_ur_adres\";s:6:\"������\";s:9:\"org_adres\";s:6:\"������\";s:7:\"org_inn\";s:0:\"\";s:7:\"org_kpp\";s:0:\"\";s:9:\"org_schet\";s:0:\"\";s:8:\"org_bank\";s:0:\"\";s:7:\"org_bic\";s:0:\"\";s:14:\"org_bank_schet\";s:0:\"\";}', '2', '25', '1278426076', '18', '1', 'a:47:{s:17:\"prevpanel_enabled\";s:1:\"1\";s:12:\"sklad_status\";s:1:\"3\";s:14:\"helper_enabled\";s:1:\"1\";s:13:\"cloud_enabled\";s:1:\"1\";s:23:\"digital_product_enabled\";N;s:13:\"user_calendar\";s:1:\"1\";s:19:\"user_price_activate\";N;s:22:\"user_mail_activate_pre\";N;s:18:\"rss_graber_enabled\";s:1:\"1\";s:17:\"image_save_source\";s:1:\"1\";s:6:\"img_wm\";N;s:5:\"img_w\";s:3:\"300\";s:5:\"img_h\";s:3:\"300\";s:6:\"img_tw\";s:3:\"100\";s:6:\"img_th\";s:3:\"100\";s:14:\"width_podrobno\";s:2:\"90\";s:12:\"width_kratko\";s:2:\"90\";s:15:\"message_enabled\";s:1:\"1\";s:12:\"message_time\";s:2:\"20\";s:15:\"desktop_enabled\";N;s:12:\"desktop_time\";N;s:8:\"oplata_1\";s:1:\"1\";s:8:\"oplata_2\";s:1:\"1\";s:8:\"oplata_3\";s:1:\"1\";s:8:\"oplata_4\";N;s:8:\"oplata_5\";s:1:\"1\";s:8:\"oplata_6\";s:1:\"1\";s:8:\"oplata_7\";s:1:\"1\";s:8:\"oplata_8\";s:1:\"1\";s:14:\"seller_enabled\";N;s:12:\"base_enabled\";N;s:11:\"sms_enabled\";N;s:14:\"notice_enabled\";N;s:14:\"update_enabled\";N;s:7:\"base_id\";s:0:\"\";s:9:\"base_host\";s:0:\"\";s:4:\"lang\";s:7:\"russian\";s:13:\"sklad_enabled\";s:1:\"1\";s:10:\"price_znak\";s:1:\"0\";s:18:\"user_mail_activate\";N;s:11:\"user_status\";s:1:\"0\";s:9:\"user_skin\";s:1:\"1\";s:12:\"cart_minimum\";s:4:\"5000\";s:14:\"editor_enabled\";s:1:\"1\";s:13:\"watermark_big\";a:21:{s:14:\"big_mergeLevel\";i:70;s:11:\"big_enabled\";s:1:\"1\";s:8:\"big_type\";s:3:\"png\";s:12:\"big_png_file\";s:30:\"/UserFiles/Image/shop_logo.png\";s:12:\"big_copyFlag\";s:1:\"0\";s:6:\"big_sm\";i:0;s:16:\"big_positionFlag\";s:1:\"4\";s:13:\"big_positionX\";i:0;s:13:\"big_positionY\";i:0;s:9:\"big_alpha\";i:70;s:8:\"big_text\";s:0:\"\";s:21:\"big_text_positionFlag\";i:0;s:8:\"big_size\";i:0;s:9:\"big_angle\";i:0;s:18:\"big_text_positionX\";i:0;s:18:\"big_text_positionY\";i:0;s:10:\"big_colorR\";i:0;s:10:\"big_colorG\";i:0;s:10:\"big_colorB\";i:0;s:14:\"big_text_alpha\";i:0;s:8:\"big_font\";s:16:\"norobot_font.ttf\";}s:15:\"watermark_small\";a:21:{s:16:\"small_mergeLevel\";i:100;s:13:\"small_enabled\";s:1:\"1\";s:10:\"small_type\";s:3:\"png\";s:14:\"small_png_file\";s:25:\"/UserFiles/Image/logo.png\";s:14:\"small_copyFlag\";s:1:\"0\";s:8:\"small_sm\";i:0;s:18:\"small_positionFlag\";s:1:\"1\";s:15:\"small_positionX\";i:0;s:15:\"small_positionY\";i:0;s:11:\"small_alpha\";i:50;s:10:\"small_text\";s:0:\"\";s:23:\"small_text_positionFlag\";i:0;s:10:\"small_size\";i:0;s:11:\"small_angle\";i:0;s:20:\"small_text_positionX\";i:0;s:20:\"small_text_positionY\";i:0;s:12:\"small_colorR\";i:0;s:12:\"small_colorG\";i:0;s:12:\"small_colorB\";i:0;s:16:\"small_text_alpha\";i:0;s:10:\"small_font\";s:16:\"norobot_font.ttf\";}s:15:\"watermark_ishod\";a:21:{s:16:\"ishod_mergeLevel\";i:100;s:13:\"ishod_enabled\";N;s:10:\"ishod_type\";s:3:\"png\";s:14:\"ishod_png_file\";s:0:\"\";s:14:\"ishod_copyFlag\";s:1:\"0\";s:8:\"ishod_sm\";i:0;s:18:\"ishod_positionFlag\";s:1:\"1\";s:15:\"ishod_positionX\";i:0;s:15:\"ishod_positionY\";i:0;s:11:\"ishod_alpha\";i:0;s:10:\"ishod_text\";s:0:\"\";s:23:\"ishod_text_positionFlag\";i:0;s:10:\"ishod_size\";i:0;s:11:\"ishod_angle\";i:0;s:20:\"ishod_text_positionX\";i:0;s:20:\"ishod_text_positionY\";i:0;s:12:\"ishod_colorR\";i:0;s:12:\"ishod_colorG\";i:0;s:12:\"ishod_colorB\";i:0;s:16:\"ishod_text_alpha\";i:0;s:10:\"ishod_font\";s:16:\"norobot_font.ttf\";}}', 6, 'PHPShop � ��� ������� ������� ��� �������� �������� �������� ��������.', '@Podcatalog@, @Catalog@, @System@', '@Podcatalog@ - @Catalog@ - @System@', '@Podcatalog@, @Catalog@, @Generator@', '@Product@ - @Podcatalog@ - @Catalog@', '@Product@, @Podcatalog@, @Catalog@', '@Product@,@System@', '/UserFiles/Image/shop_logo.png', '', '@Catalog@ /', '@Catalog@', '@Catalog@', 0, '', '','');

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

