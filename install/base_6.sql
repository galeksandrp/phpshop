DROP TABLE IF EXISTS phpshop_1c_docs;
CREATE TABLE phpshop_1c_docs (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `cid` varchar(64) DEFAULT '',
  `datas` int(11) DEFAULT '0',
  `datas_f` int(11) DEFAULT '0',
  `year` int(11) DEFAULT '2018',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_1c_jurnal;
CREATE TABLE phpshop_1c_jurnal (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datas` varchar(64) DEFAULT '0',
  `p_name` varchar(64) DEFAULT '',
  `f_name` varchar(64) DEFAULT '',
  `time` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_baners;
CREATE TABLE phpshop_baners (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `content` text,
  `count_all` int(11) DEFAULT '0',
  `count_today` int(11) DEFAULT '0',
  `flag` enum('0','1') DEFAULT '0',
  `datas` varchar(32) DEFAULT '',
  `limit_all` int(11) DEFAULT '0',
  `dir` varchar(255) DEFAULT '',
  `dop_cat` varchar(255) DEFAULT '',
  `servers` varchar(64) DEFAULT '',
  `skin` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_baners VALUES ('4', '������ � �������', '<p><img src="/UserFiles/Image/Trial/banner_vert.jpg" width="414" height="648" /></p>', '0', '0', '1', '', '0', '', '', '', 'lego');
DROP TABLE IF EXISTS phpshop_black_list;
CREATE TABLE phpshop_black_list (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(32) DEFAULT '',
  `datas` varchar(32) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_categories;
CREATE TABLE phpshop_categories (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `num` int(11) DEFAULT '0',
  `parent_to` int(11) NOT NULL DEFAULT '0',
  `yml` enum('0','1') DEFAULT '1',
  `num_row` enum('1','2','3','4','5') DEFAULT '3',
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
  `dop_cat` varchar(255) DEFAULT '',
  `parent_title` int(11) DEFAULT '0',
  `sort_cache` blob,
  `sort_cache_created_at` int(11) DEFAULT NULL,
  `menu` enum('0','1') DEFAULT '0',
  `option6` text,
  `option7` text,
  `option8` text,
  `option9` text,
  `option10` text,
  `cat_seo_name` varchar(255) DEFAULT '',
  `cat_seo_name_old` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `parent_to` (`parent_to`),
  KEY `servers` (`servers`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_categories VALUES ('1', '������, ����� � ����������', '1', '0', '1', '4', '0', 'a:4:{i:0;s:1:"5";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"2";}', '<p>��� ������� �������, �������� ��� �������� ����� ��������� � ���� ������ - ��������. � �������� �������������� �� ���������, ����� ������� ����� ���������� � ���� ��������.�</p>', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs4.jpg', '', '', '0',  NULL,  NULL, '1',  NULL,  NULL,  NULL,  NULL,  NULL, 'odezhda-obuv-i-aksessuary', '');
INSERT INTO phpshop_categories VALUES ('2', '������� � ��������', '2', '0', '1', '3', '0', 'a:3:{i:0;s:1:"8";i:1;s:1:"7";i:2;s:1:"9";}', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs5.jpg', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('3', '�����', '3', '0', '1', '2', '0', 'N;', '<p>���� ������� ��������� ������������� � �������� ������, ����� � ���������� - �����, ��������� ����� �������� ����� � ���� ������ - �������� - �������������� ��������.</p>', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs13.jpg', '', '#10#10#', '0',  NULL,  NULL, '1',  NULL,  NULL,  NULL,  NULL,  NULL, 'knigi', '');
INSERT INTO phpshop_categories VALUES ('4', '������������� � ������', '4', '0', '1', '3', '0', 'a:3:{i:0;s:2:"11";i:1;s:2:"12";i:2;s:2:"13";}', '<p>��� ������� ������� � ������� ������ - ��������. �� ������ �������� ����� ���������� ���������, ������ ������ �����������. �� ������ �������, ������� ������� � ����� �� ������ ������ �� ������� ��������. �� ������ ��������� �������� � ��������� �������.&nbsp;</p>\r\n<p>����� �������� ���� ������� � ������ �������, �� ������ �������������� ��������.</p>', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs10.jpg', '', '', '0',  NULL,  NULL, '1',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('5', '�����������', '5', '0', '1', '3', '0', 'N;', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '1', '3', '1', '', '', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, 'elektronika', '');
INSERT INTO phpshop_categories VALUES ('6', '�������� �������', '6', '0', '1', '3', '0', 'N;', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '1', '3', '1', '', '', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('7', '����������', '7', '0', '1', '3', '0', 'N;', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '1', '3', '1', '', '', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('8', '��������', '1', '1', '1', '4', '0', 'a:4:{i:0;s:1:"5";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"2";}', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs4.jpg', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, 'zhenschinam', '');
INSERT INTO phpshop_categories VALUES ('9', '��������', '3', '1', '1', '4', '0', 'a:3:{i:0;s:1:"5";i:1;s:1:"3";i:2;s:1:"4";}', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs1.jpg', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, 'muzhchinam', '');
INSERT INTO phpshop_categories VALUES ('10', '�����', '2', '1', '1', '3', '0', 'a:2:{i:0;s:1:"4";i:1;s:1:"2";}', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '3', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs3.jpg', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, 'detyam', '');
INSERT INTO phpshop_categories VALUES ('11', '������', '1', '2', '1', '3', '0', 'a:3:{i:0;s:1:"8";i:1;s:1:"7";i:2;s:1:"9";}', '<p>�� ������ ������� ������� � ������� ���� �����, �������� ����� � ���� ������ - �������� - ����� ������ - ������� ����.</p>', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs6.jpg', '', '', '0',  NULL,  NULL, '1',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('12', '���� �� �����', '2', '2', '1', '3', '0', 'a:3:{i:0;s:1:"8";i:1;s:1:"7";i:2;s:1:"9";}', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs7.jpg', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, 'uhod-za-licom', '');
INSERT INTO phpshop_categories VALUES ('13', '���� �� ��������', '3', '2', '1', '3', '0', 'a:3:{i:0;s:1:"8";i:1;s:1:"7";i:2;s:1:"9";}', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs5.jpg', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, 'uhod-za-volosami', '');
INSERT INTO phpshop_categories VALUES ('14', '�����������', '1', '4', '1', '3', '0', 'a:3:{i:0;s:2:"11";i:1;s:2:"12";i:2;s:2:"13";}', '<p>�������� �������� �������� � ���� ������ - �������� - ��������.</p>', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs12.jpg', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, 'instrumenty', '');
INSERT INTO phpshop_categories VALUES ('15', '����������', '2', '4', '1', '1', '0', 'a:3:{i:0;s:2:"11";i:1;s:2:"12";i:2;s:2:"13";}', '<p>�� ������ ����� ������� ������ �������� ������������� � ������ �������. ���� �������������� �������� � �������� �������������� ��������, �������� ��������.</p>', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs10.jpg', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, 'santehnika', '');
INSERT INTO phpshop_categories VALUES ('16', '�������������', '3', '4', '1', '3', '0', 'a:3:{i:0;s:2:"11";i:1;s:2:"12";i:2;s:2:"13";}', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs11.jpg', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, 'vodosnabzhenie', '');
INSERT INTO phpshop_categories VALUES ('17', '���������', '1', '5', '1', '3', '0', 'N;', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('18', '��������', '2', '5', '1', '3', '0', 'N;', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('19', '����� ����', '3', '5', '1', '3', '0', 'N;', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('20', '���, ����, �����', '1', '6', '1', '3', '0', 'N;', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('21', '���� � �����', '2', '6', '1', '3', '0', 'N;', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('22', '����, ���� � �������', '3', '6', '1', '3', '0', 'N;', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('23', '���� � �����', '1', '7', '1', '3', '0', 'N;', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('24', '����� � ���������', '2', '7', '1', '3', '0', 'N;', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('25', '���� �� �����������', '1', '7', '1', '3', '0', 'N;', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('26', '������', '1', '8', '1', '4', '0', 'a:4:{i:0;s:1:"5";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"2";}', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs4.jpg', '', '', '4',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, 'odezhda-zenshinam', '');
INSERT INTO phpshop_categories VALUES ('27', '������', '1', '9', '1', '3', '0', 'a:4:{i:0;s:1:"5";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"2";}', '<p>� ���� ������ - �������� - �������� �� ������ ������� ����� �������, ������� ������� ����� � ������ ��������.&nbsp;&nbsp;</p>', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs1.jpg', '', '', '4',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, 'odezhda-muzchinam', '');
INSERT INTO phpshop_categories VALUES ('28', '�����, ����������', '2', '8', '1', '4', '0', 'a:4:{i:0;s:1:"5";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"2";}', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs3.jpg', '', '', '6',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, 'obuv-aksessuary', '');
INSERT INTO phpshop_categories VALUES ('29', '������ �����', '3', '8', '1', '4', '0', 'N;', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs2.jpg', '', '', '4',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, 'nizhnee-bele', '');
INSERT INTO phpshop_categories VALUES ('30', '�����', '2', '9', '1', '2', '0', 'a:4:{i:0;s:1:"5";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"2";}', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs8.jpg', '', '', '4',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, 'obuv', '');
INSERT INTO phpshop_categories VALUES ('31', '����������', '3', '9', '1', '2', '0', 'a:4:{i:0;s:1:"5";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"2";}', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '/UserFiles/Image/Trial/phpshop6_catalogs2.jpg', '', '', '6',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, 'aksessuary', '');
INSERT INTO phpshop_categories VALUES ('32', '�������� �����', '1', '10', '1', '3', '0', 'N;', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '1', '1', '1', '', '', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('33', '�������', '2', '10', '1', '3', '0', 'a:1:{i:0;s:1:"4";}', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '0', '1', '1', '', '', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
INSERT INTO phpshop_categories VALUES ('36', '�����������', '8', '0', '1', '3', '0', 'N;', '', '0', '', '', '', '0', '', '', '0', '', '', '0', '', '', '1', '1', '1', '', '', '', '', '0',  NULL,  NULL, '0',  NULL,  NULL,  NULL,  NULL,  NULL, '', '');
DROP TABLE IF EXISTS phpshop_citylist_city;
CREATE TABLE phpshop_citylist_city (
  `city_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(11) unsigned DEFAULT '0',
  `region_id` int(10) unsigned DEFAULT '0',
  `name` varchar(128) DEFAULT '',
  PRIMARY KEY (`city_id`),
  KEY `country_id` (`country_id`),
  KEY `region_id` (`region_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_citylist_country;
CREATE TABLE phpshop_citylist_country (
  `country_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT '0',
  `name` varchar(128) DEFAULT '',
  PRIMARY KEY (`country_id`),
  KEY `city_id` (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_citylist_region;
CREATE TABLE phpshop_citylist_region (
  `region_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned DEFAULT '0',
  `city_id` int(10) unsigned DEFAULT '0',
  `name` varchar(64) DEFAULT '',
  PRIMARY KEY (`region_id`),
  KEY `country_id` (`country_id`),
  KEY `city_id` (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_comment;
CREATE TABLE phpshop_comment (
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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_delivery;
CREATE TABLE phpshop_delivery (
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
  `servers` varchar(64) DEFAULT '',
  `is_mod` enum('1','2') DEFAULT '1',
  `warehouse` int(11) DEFAULT '0',
  `yandex_mail_instock` text,
  `yandex_mail_outstock` text,
  `yandex_enabled` enum('1','2') DEFAULT '1',
  `yandex_day` int(11) DEFAULT '2',
  `yandex_type` enum('1','2','3') DEFAULT '1',
  `yandex_payment` enum('1','2','3') DEFAULT '1',
  `yandex_outlet` varchar(255) DEFAULT '',
  `yandex_check` enum('1','2') DEFAULT '1',
  `yandex_day_min` int(11) DEFAULT '1',
  `yandex_order_before` int(11) DEFAULT '16',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_delivery VALUES ('1', '�����-���������', '0', '1', '1', '0', '0', '0', '0', '1', '0', '', '0', '/UserFiles/Image/Payments/city.png', '', '', '0', '', '1', '0',  NULL,  NULL, '1', '2', '1', '1', '', '1', '1', '16');
INSERT INTO phpshop_delivery VALUES ('3', '�������� �������� � �������� ����', '180', '1', '1', '2000', '1', '1', '1', '0', '0', 'a:2:{s:7:"enabled";a:12:{s:7:"country";a:1:{s:4:"name";s:6:"������";}s:5:"state";a:1:{s:4:"name";s:11:"������/����";}s:4:"city";a:1:{s:4:"name";s:5:"�����";}s:5:"index";a:1:{s:4:"name";s:6:"������";}s:3:"fio";a:1:{s:4:"name";s:3:"���";}s:3:"tel";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:7:"�������";s:3:"req";s:1:"1";}s:6:"street";a:2:{s:7:"enabled";s:1:"1";s:4:"name";s:5:"�����";}s:5:"house";a:2:{s:7:"enabled";s:1:"1";s:4:"name";s:3:"���";}s:5:"porch";a:2:{s:7:"enabled";s:1:"1";s:4:"name";s:7:"�������";}s:10:"door_phone";a:1:{s:4:"name";s:12:"��� ��������";}s:4:"flat";a:1:{s:4:"name";s:8:"��������";}s:9:"delivtime";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:16:"����� ���������?";s:3:"req";s:1:"1";}}s:3:"num";a:12:{s:7:"country";s:1:"1";s:5:"state";s:1:"2";s:4:"city";s:1:"3";s:5:"index";s:1:"4";s:3:"fio";s:1:"1";s:3:"tel";s:1:"2";s:6:"street";s:1:"3";s:5:"house";s:1:"4";s:5:"porch";s:1:"5";s:10:"door_phone";s:1:"6";s:4:"flat";s:1:"7";s:9:"delivtime";s:1:"8";}}', '0', '/UserFiles/Image/Payments/courier.png', 'null', '18', '0', '', '2', '1',  NULL,  NULL, '1', '2', '1', '1', '', '1', '1', '16');
INSERT INTO phpshop_delivery VALUES ('4', '�������� �������� �� ��������� ����', '300', '0', '0', '0', '0', '1', '0', '0', '0', 'a:2:{s:7:"enabled";a:12:{s:7:"country";a:1:{s:4:"name";s:6:"������";}s:5:"state";a:1:{s:4:"name";s:11:"������/����";}s:4:"city";a:1:{s:4:"name";s:5:"�����";}s:5:"index";a:1:{s:4:"name";s:6:"������";}s:3:"fio";a:1:{s:4:"name";s:3:"���";}s:3:"tel";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:7:"�������";s:3:"req";s:1:"1";}s:6:"street";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:5:"�����";s:3:"req";s:1:"1";}s:5:"house";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:3:"���";s:3:"req";s:1:"1";}s:5:"porch";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:7:"�������";s:3:"req";s:1:"1";}s:10:"door_phone";a:2:{s:7:"enabled";s:1:"1";s:4:"name";s:12:"��� ��������";}s:4:"flat";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:8:"��������";s:3:"req";s:1:"1";}s:9:"delivtime";a:1:{s:4:"name";s:14:"����� ��������";}}s:3:"num";a:12:{s:7:"country";s:1:"1";s:5:"state";s:1:"2";s:4:"city";s:1:"3";s:5:"index";s:1:"4";s:3:"fio";s:1:"1";s:3:"tel";s:1:"2";s:6:"street";s:1:"3";s:5:"house";s:1:"4";s:5:"porch";s:1:"5";s:10:"door_phone";s:1:"6";s:4:"flat";s:1:"7";s:9:"delivtime";s:2:"12";}}', '0', '/UserFiles/Image/Payments/courier-za-mkad.png', 'null', '18', '0', '', '1', '1', '', '', '1', '2', '1', '1', '', '1', '1', '16');
INSERT INTO phpshop_delivery VALUES ('7', '�����������', '0', '1', '0', '0', '0', '0', '0', '1', '0', '', '1', '/UserFiles/Image/Payments/russia.png', '', '', '0', '', '1', '0',  NULL,  NULL, '1', '2', '1', '1', '', '1', '1', '16');
INSERT INTO phpshop_delivery VALUES ('8', 'EMS', '500', '1', '0', '5000', '1', '7', '50', '0', '1', 'a:2:{s:7:"enabled";a:12:{s:7:"country";a:1:{s:4:"name";s:6:"������";}s:5:"state";a:1:{s:4:"name";s:11:"������/����";}s:4:"city";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:5:"�����";s:3:"req";s:1:"1";}s:5:"index";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:6:"������";s:3:"req";s:1:"1";}s:3:"fio";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:14:"��� ����������";s:3:"req";s:1:"1";}s:3:"tel";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:18:"������� ����������";s:3:"req";s:1:"1";}s:6:"street";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:5:"�����";s:3:"req";s:1:"1";}s:5:"house";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:3:"���";s:3:"req";s:1:"1";}s:5:"porch";a:2:{s:7:"enabled";s:1:"1";s:4:"name";s:7:"�������";}s:10:"door_phone";a:2:{s:7:"enabled";s:1:"1";s:4:"name";s:12:"��� ��������";}s:4:"flat";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:8:"��������";s:3:"req";s:1:"1";}s:9:"delivtime";a:1:{s:4:"name";s:14:"����� ��������";}}s:3:"num";a:12:{s:7:"country";s:1:"1";s:5:"state";s:1:"2";s:4:"city";s:1:"1";s:5:"index";s:1:"2";s:3:"fio";s:1:"3";s:3:"tel";s:1:"4";s:6:"street";s:1:"5";s:5:"house";s:1:"6";s:5:"porch";s:1:"7";s:10:"door_phone";s:1:"8";s:4:"flat";s:1:"9";s:9:"delivtime";s:2:"12";}}', '1', '/UserFiles/Image/Payments/ems.png', '', '18', '0', '', '1', '2',  NULL,  NULL, '1', '2', '1', '1', '', '1', '1', '16');
INSERT INTO phpshop_delivery VALUES ('9', '����� ������', '900', '1', '0', '5000', '1', '7', '60', '0', '1', 'a:2:{s:7:"enabled";a:12:{s:7:"country";a:1:{s:4:"name";s:6:"������";}s:5:"state";a:1:{s:4:"name";s:11:"������/����";}s:4:"city";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:5:"�����";s:3:"req";s:1:"1";}s:5:"index";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:6:"������";s:3:"req";s:1:"1";}s:3:"fio";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:14:"��� ����������";s:3:"req";s:1:"1";}s:3:"tel";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:18:"������� ����������";s:3:"req";s:1:"1";}s:6:"street";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:5:"�����";s:3:"req";s:1:"1";}s:5:"house";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:3:"���";s:3:"req";s:1:"1";}s:5:"porch";a:2:{s:7:"enabled";s:1:"1";s:4:"name";s:7:"�������";}s:10:"door_phone";a:2:{s:7:"enabled";s:1:"1";s:4:"name";s:12:"��� ��������";}s:4:"flat";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:8:"��������";s:3:"req";s:1:"1";}s:9:"delivtime";a:1:{s:4:"name";s:14:"����� ��������";}}s:3:"num";a:12:{s:7:"country";s:0:"";s:5:"state";s:1:"2";s:4:"city";s:1:"1";s:5:"index";s:1:"2";s:3:"fio";s:1:"3";s:3:"tel";s:1:"4";s:6:"street";s:1:"5";s:5:"house";s:1:"6";s:5:"porch";s:1:"7";s:10:"door_phone";s:1:"8";s:4:"flat";s:1:"9";s:9:"delivtime";s:2:"12";}}', '2', '/UserFiles/Image/Payments/pochta-rf.png', 'null', '18', '0', '', '1', '2',  NULL,  NULL, '1', '2', '1', '1', '', '1', '1', '16');
INSERT INTO phpshop_delivery VALUES ('12', '�� ������� ������', '0', '1', '0', '0', '', '0', '0', '1', '0', '', '3', '/UserFiles/Image/Payments/world.png', '', '', '0', '', '1', '0',  NULL,  NULL, '1', '2', '1', '1', '', '1', '1', '16');
INSERT INTO phpshop_delivery VALUES ('13', 'DHL', '0', '1', '0', '0', '0', '12', '0', '0', '2', 'a:2:{s:7:"enabled";a:12:{s:7:"country";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:6:"������";s:3:"req";s:1:"1";}s:5:"state";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:6:"������";s:3:"req";s:1:"1";}s:4:"city";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:5:"�����";s:3:"req";s:1:"1";}s:5:"index";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:6:"������";s:3:"req";s:1:"1";}s:3:"fio";a:2:{s:4:"name";s:14:"��� ����������";s:3:"req";s:1:"1";}s:3:"tel";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:18:"������� ����������";s:3:"req";s:1:"1";}s:6:"street";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:5:"�����";s:3:"req";s:1:"1";}s:5:"house";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:3:"���";s:3:"req";s:1:"1";}s:5:"porch";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:7:"�������";s:3:"req";s:1:"1";}s:10:"door_phone";a:2:{s:7:"enabled";s:1:"1";s:4:"name";s:12:"��� ��������";}s:4:"flat";a:3:{s:7:"enabled";s:1:"1";s:4:"name";s:8:"��������";s:3:"req";s:1:"1";}s:9:"delivtime";a:1:{s:4:"name";s:14:"����� ��������";}}s:3:"num";a:12:{s:7:"country";s:1:"1";s:5:"state";s:1:"2";s:4:"city";s:1:"3";s:5:"index";s:1:"4";s:3:"fio";s:1:"5";s:3:"tel";s:1:"6";s:6:"street";s:1:"7";s:5:"house";s:1:"8";s:5:"porch";s:1:"9";s:10:"door_phone";s:2:"10";s:4:"flat";s:2:"11";s:9:"delivtime";s:2:"12";}}', '0', '/UserFiles/Image/Payments/dhl.png', 'null', '18', '0', '', '1', '0',  NULL,  NULL, '1', '2', '1', '1', '', '1', '1', '16');
DROP TABLE IF EXISTS phpshop_discount;
CREATE TABLE phpshop_discount (
  `id` tinyint(11) unsigned NOT NULL AUTO_INCREMENT,
  `sum` int(255) DEFAULT '0',
  `discount` float DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '0',
  `action` ENUM('1', '2') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


DROP TABLE IF EXISTS phpshop_foto;
CREATE TABLE phpshop_foto (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `num` tinyint(11) DEFAULT '0',
  `info` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_foto VALUES ('1', '1', '/UserFiles/Image/Trial/img1_69884.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('2', '1', '/UserFiles/Image/Trial/img1_76986.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('3', '1', '/UserFiles/Image/Trial/img1_67897.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('4', '1', '/UserFiles/Image/Trial/img1_78656.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('5', '2', '/UserFiles/Image/Trial/img2_44763.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('6', '2', '/UserFiles/Image/Trial/img2_27973.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('7', '2', '/UserFiles/Image/Trial/img2_95509.jpg', '5', '');
INSERT INTO phpshop_foto VALUES ('8', '2', '/UserFiles/Image/Trial/img2_64554.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('9', '2', '/UserFiles/Image/Trial/img2_19797.jpg', '6', '');
INSERT INTO phpshop_foto VALUES ('10', '2', '/UserFiles/Image/Trial/img2_96038.jpg', '4', '');
INSERT INTO phpshop_foto VALUES ('11', '3', '/UserFiles/Image/Trial/img3_37243.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('12', '3', '/UserFiles/Image/Trial/img3_29892.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('13', '3', '/UserFiles/Image/Trial/img3_83164.jpg', '5', '');
INSERT INTO phpshop_foto VALUES ('14', '3', '/UserFiles/Image/Trial/img3_24603.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('15', '3', '/UserFiles/Image/Trial/img3_12202.jpg', '6', '');
INSERT INTO phpshop_foto VALUES ('16', '3', '/UserFiles/Image/Trial/img3_56614.jpg', '4', '');
INSERT INTO phpshop_foto VALUES ('17', '3', '/UserFiles/Image/Trial/img3_93384.jpg', '7', '');
INSERT INTO phpshop_foto VALUES ('18', '4', '/UserFiles/Image/Trial/img4_31272.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('19', '4', '/UserFiles/Image/Trial/img4_24078.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('20', '4', '/UserFiles/Image/Trial/img4_88120.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('21', '5', '/UserFiles/Image/Trial/img5_43616.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('22', '5', '/UserFiles/Image/Trial/img5_23962.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('23', '5', '/UserFiles/Image/Trial/img5_32982.jpg', '5', '');
INSERT INTO phpshop_foto VALUES ('24', '5', '/UserFiles/Image/Trial/img5_47325.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('25', '5', '/UserFiles/Image/Trial/img5_68432.jpg', '4', '');
INSERT INTO phpshop_foto VALUES ('26', '6', '/UserFiles/Image/Trial/img6_51944.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('27', '6', '/UserFiles/Image/Trial/img6_42150.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('28', '7', '/UserFiles/Image/Trial/img7_34107.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('29', '7', '/UserFiles/Image/Trial/img7_78584.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('30', '7', '/UserFiles/Image/Trial/img7_84000.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('35', '9', '/UserFiles/Image/Trial/img9_63883.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('32', '8', '/UserFiles/Image/Trial/img8_54208.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('33', '8', '/UserFiles/Image/Trial/img8_41181.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('34', '8', '/UserFiles/Image/Trial/img8_49539.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('36', '9', '/UserFiles/Image/Trial/img9_97932.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('37', '9', '/UserFiles/Image/Trial/img9_38664.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('38', '9', '/UserFiles/Image/Trial/img9_22416.jpg', '4', '');
INSERT INTO phpshop_foto VALUES ('39', '10', '/UserFiles/Image/Trial/img10_93804.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('40', '10', '/UserFiles/Image/Trial/img10_75775.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('41', '10', '/UserFiles/Image/Trial/img10_88702.jpg', '5', '');
INSERT INTO phpshop_foto VALUES ('42', '10', '/UserFiles/Image/Trial/img10_90450.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('43', '10', '/UserFiles/Image/Trial/img10_21323.jpg', '4', '');
INSERT INTO phpshop_foto VALUES ('44', '11', '/UserFiles/Image/Trial/img11_25850.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('45', '11', '/UserFiles/Image/Trial/img11_84557.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('46', '11', '/UserFiles/Image/Trial/img11_78833.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('47', '12', '/UserFiles/Image/Trial/img12_79562.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('48', '12', '/UserFiles/Image/Trial/img12_60499.jpg', '4', '');
INSERT INTO phpshop_foto VALUES ('49', '12', '/UserFiles/Image/Trial/img12_92072.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('50', '12', '/UserFiles/Image/Trial/img12_26952.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('51', '13', '/UserFiles/Image/Trial/img13_34252.jpg', '4', '');
INSERT INTO phpshop_foto VALUES ('52', '13', '/UserFiles/Image/Trial/img13_57737.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('53', '13', '/UserFiles/Image/Trial/img13_67547.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('54', '13', '/UserFiles/Image/Trial/img13_59800.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('55', '13', '/UserFiles/Image/Trial/img13_86638.jpg', '5', '');
INSERT INTO phpshop_foto VALUES ('56', '14', '/UserFiles/Image/Trial/img14_31318.jpg', '4', '');
INSERT INTO phpshop_foto VALUES ('57', '14', '/UserFiles/Image/Trial/img14_84532.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('58', '14', '/UserFiles/Image/Trial/img14_77798.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('59', '14', '/UserFiles/Image/Trial/img14_67916.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('60', '15', '/UserFiles/Image/Trial/img15_92639.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('61', '15', '/UserFiles/Image/Trial/img15_41848.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('62', '15', '/UserFiles/Image/Trial/img15_21930.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('63', '16', '/UserFiles/Image/Trial/img16_92849.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('64', '16', '/UserFiles/Image/Trial/img16_53768.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('65', '16', '/UserFiles/Image/Trial/img16_56207.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('66', '17', '/UserFiles/Image/Trial/img17_22660.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('67', '17', '/UserFiles/Image/Trial/img17_95275.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('68', '17', '/UserFiles/Image/Trial/img17_48063.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('69', '18', '/UserFiles/Image/Trial/img18_68450.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('70', '18', '/UserFiles/Image/Trial/img18_49453.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('71', '18', '/UserFiles/Image/Trial/img18_70369.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('72', '19', '/UserFiles/Image/Trial/img19_68698.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('73', '19', '/UserFiles/Image/Trial/img19_76156.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('74', '19', '/UserFiles/Image/Trial/img19_96588.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('75', '20', '/UserFiles/Image/Trial/img20_27253.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('76', '20', '/UserFiles/Image/Trial/img20_54474.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('77', '20', '/UserFiles/Image/Trial/img20_30838.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('78', '21', '/UserFiles/Image/Trial/img21_52213.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('79', '21', '/UserFiles/Image/Trial/img21_18874.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('80', '21', '/UserFiles/Image/Trial/img21_35310.jpg', '4', '');
INSERT INTO phpshop_foto VALUES ('81', '21', '/UserFiles/Image/Trial/img21_89669.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('82', '22', '/UserFiles/Image/Trial/img22_64146.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('83', '22', '/UserFiles/Image/Trial/img22_59635.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('84', '22', '/UserFiles/Image/Trial/img22_11677.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('87', '23', '/UserFiles/Image/Trial/img23_55300.jpg', '4', '');
INSERT INTO phpshop_foto VALUES ('86', '22', '/UserFiles/Image/Trial/img22_79686.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('88', '23', '/UserFiles/Image/Trial/img23_72771.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('89', '23', '/UserFiles/Image/Trial/img23_41025.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('90', '23', '/UserFiles/Image/Trial/img23_77945.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('91', '24', '/UserFiles/Image/Trial/img24_83524.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('92', '24', '/UserFiles/Image/Trial/img24_14357.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('93', '24', '/UserFiles/Image/Trial/img24_36368.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('94', '25', '/UserFiles/Image/Trial/img25_60693.jpg', '4', '');
INSERT INTO phpshop_foto VALUES ('95', '25', '/UserFiles/Image/Trial/img25_58146.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('96', '25', '/UserFiles/Image/Trial/img25_93765.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('97', '25', '/UserFiles/Image/Trial/img25_67891.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('98', '25', '/UserFiles/Image/Trial/img25_79335.jpg', '5', '');
INSERT INTO phpshop_foto VALUES ('99', '25', '/UserFiles/Image/Trial/img25_75374.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('100', '26', '/UserFiles/Image/Trial/img26_58467.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('101', '26', '/UserFiles/Image/Trial/img26_40876.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('102', '26', '/UserFiles/Image/Trial/img26_47790.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('103', '27', '/UserFiles/Image/Trial/img27_71254.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('104', '27', '/UserFiles/Image/Trial/img27_40980.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('105', '27', '/UserFiles/Image/Trial/img27_52450.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('106', '27', '/UserFiles/Image/Trial/img27_33104.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('107', '28', '/UserFiles/Image/Trial/img28_65696.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('108', '28', '/UserFiles/Image/Trial/img28_10558.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('109', '28', '/UserFiles/Image/Trial/img28_82780.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('110', '28', '/UserFiles/Image/Trial/img28_93753.jpg', '5', '');
INSERT INTO phpshop_foto VALUES ('111', '28', '/UserFiles/Image/Trial/img28_82509.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('112', '29', '/UserFiles/Image/Trial/img29_45239.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('113', '29', '/UserFiles/Image/Trial/img29_65387.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('114', '29', '/UserFiles/Image/Trial/img29_72070.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('115', '30', '/UserFiles/Image/Trial/img30_85931.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('116', '30', '/UserFiles/Image/Trial/img30_89787.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('117', '30', '/UserFiles/Image/Trial/img30_12280.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('118', '31', '/UserFiles/Image/Trial/img31_33680.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('119', '31', '/UserFiles/Image/Trial/img31_66601.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('120', '31', '/UserFiles/Image/Trial/img31_95215.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('121', '31', '/UserFiles/Image/Trial/img31_21337.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('122', '32', '/UserFiles/Image/Trial/img32_89451.jpg', '3', '');
INSERT INTO phpshop_foto VALUES ('123', '32', '/UserFiles/Image/Trial/img32_33694.jpg', '2', '');
INSERT INTO phpshop_foto VALUES ('124', '32', '/UserFiles/Image/Trial/img32_33653.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('125', '32', '/UserFiles/Image/Trial/img32_39066.jpg', '4', '');
INSERT INTO phpshop_foto VALUES ('126', '33', '/UserFiles/Image/Trial/img33_95820.png', '0', '');
INSERT INTO phpshop_foto VALUES ('127', '33', '/UserFiles/Image/Trial/img33_66960.png', '0', '');
INSERT INTO phpshop_foto VALUES ('128', '33', '/UserFiles/Image/Trial/img33_16553.png', '0', '');
INSERT INTO phpshop_foto VALUES ('129', '34', '/UserFiles/Image/Trial/img34_49655.png', '0', '');
INSERT INTO phpshop_foto VALUES ('130', '34', '/UserFiles/Image/Trial/img34_44685.png', '0', '');
INSERT INTO phpshop_foto VALUES ('131', '34', '/UserFiles/Image/Trial/img34_27336.png', '0', '');
INSERT INTO phpshop_foto VALUES ('132', '35', '/UserFiles/Image/Trial/img35_18528.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('133', '35', '/UserFiles/Image/Trial/img35_18631.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('134', '35', '/UserFiles/Image/Trial/img35_62205.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('135', '36', '/UserFiles/Image/Trial/img36_33799.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('136', '36', '/UserFiles/Image/Trial/img36_99871.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('137', '36', '/UserFiles/Image/Trial/img36_43273.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('138', '36', '/UserFiles/Image/Trial/img36_45851.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('139', '36', '/UserFiles/Image/Trial/img36_35651.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('140', '37', '/UserFiles/Image/Trial/img37_11711.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('141', '37', '/UserFiles/Image/Trial/img37_92963.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('142', '37', '/UserFiles/Image/Trial/img37_82187.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('143', '37', '/UserFiles/Image/Trial/img37_15384.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('144', '37', '/UserFiles/Image/Trial/img37_17123.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('145', '38', '/UserFiles/Image/Trial/img38_13891.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('146', '38', '/UserFiles/Image/Trial/img38_85223.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('147', '38', '/UserFiles/Image/Trial/img38_66848.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('148', '38', '/UserFiles/Image/Trial/img38_24229.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('149', '38', '/UserFiles/Image/Trial/img38_22403.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('150', '38', '/UserFiles/Image/Trial/img38_31623.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('151', '39', '/UserFiles/Image/Trial/img39_63648.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('152', '40', '/UserFiles/Image/Trial/img40_16081.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('153', '41', '/UserFiles/Image/Trial/img41_23080.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('154', '42', '/UserFiles/Image/Trial/img42_77115.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('155', '43', '/UserFiles/Image/Trial/img43_24630.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('157', '44', '/UserFiles/Image/Trial/img44_23523.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('158', '45', '/UserFiles/Image/Trial/img45_37544.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('159', '46', '/UserFiles/Image/Trial/img46_54151.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('160', '46', '/UserFiles/Image/Trial/img46_50033.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('161', '47', '/UserFiles/Image/Trial/img47_24068.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('162', '48', '/UserFiles/Image/Trial/img48_22317.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('163', '49', '/UserFiles/Image/Trial/img49_36956.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('164', '50', '/UserFiles/Image/Trial/img50_30692.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('165', '51', '/UserFiles/Image/Trial/img51_26484.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('166', '52', '/UserFiles/Image/Trial/img52_37358.jpg', '0', '');
INSERT INTO phpshop_foto VALUES ('167', '11', '/UserFiles/Image/Trial/img11_33069.jpg', '3', '');
DROP TABLE IF EXISTS phpshop_gbook;
CREATE TABLE phpshop_gbook (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `datas` int(11) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `mail` varchar(32) DEFAULT NULL,
  `tema` text,
  `otsiv` text,
  `otvet` text,
  `flag` enum('0','1') DEFAULT '0',
  `servers` varchar(64) default '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_gbook VALUES ('1', '1409691600', '�����', 'test@test.ru', '������� ���� �������� � ����� ���������! ', '������� ���� �������� � ����� ���������! � ����� �� ������� ���� � ���� ��������� �������������) ������� ���� ������� ������ ������ ����������� � ������ ������, �� ������������ �������. ������� ������ �������� �����������, �� ��� �������, ��� �������� ����� ���������, ��� ��� ����� ������ ������ 2000 ������) ��� ������� ����������.', '<p>�������, �����! ���� ���������!</p>', '1','');
INSERT INTO phpshop_gbook VALUES ('3', '1409691600', '�����', 'mail@test.ru', '������� �������!', '�������� �� ���� ���������� �������� ������ ��������. ������ ��-������ ������������� � ����������.', '<p>������������, �����.</p>\r\n<p>���������� ��� �� ������������� ������!</p>', '1','');
INSERT INTO phpshop_gbook VALUES ('4', '1574805600', '����', 'test@test.ru', '���� ��� 5 ���', '����� ������� ����� ������� �� ���������������, ��������� �������.! ��� ��� ������� Sony Vaio, � �� ����� ���� ������� �� ���� ������, ������ �������� ��������, ������� � ��������� ����� ����� �������� ��������� ����))).', '', '1','');
INSERT INTO phpshop_gbook VALUES ('5', '1574860833', '�����', 'test@test.ru', '�������', '�� ������������ �����, ������� ��� ����� ���� ����. ����� �����. �� ���� �� ��� ��������.  � ���������� ��������� ������. ���� � ������� ���������. ', '', '1','');
DROP TABLE IF EXISTS phpshop_jurnal;
CREATE TABLE phpshop_jurnal (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(64) NOT NULL DEFAULT '',
  `datas` varchar(32) NOT NULL DEFAULT '',
  `flag` enum('0','1') NOT NULL DEFAULT '0',
  `ip` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;


DROP TABLE IF EXISTS phpshop_links;
CREATE TABLE phpshop_links (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `image` text,
  `opis` text,
  `link` text,
  `num` int(11) DEFAULT NULL,
  `enabled` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_links VALUES ('1', 'PHPShop Software', '', '�������� ��������-��������, ������ ��������-�������� PHPShop.', 'https://www.phpshop.ru', '5', '1');
INSERT INTO phpshop_links VALUES ('2', 'PHPShop CMS Free', '', '���������� ��c���� ���������� ������ PHPShop CMS Free.', 'https://www.phpshopcms.ru', '3', '1');
INSERT INTO phpshop_links VALUES ('3', '������ ��������-��������', '', 'Shopbuilder - ��� ����� SaaS ������ ������ ��������-��������, ����������� ������������� �� ��������� ������ ������� ����������� ���� ��������-�������� �� 599 ���.', 'https://www.shopbuilder.ru', '1', '1');
DROP TABLE IF EXISTS phpshop_menu;
CREATE TABLE phpshop_menu (
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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_menu VALUES ('1', '����������', '���������� ���������� ����������� - c����� PHPShop ��������� �����������, �� ��������� ��� ������������ ����������, �������� �� �������� ������������.', '0', '4', '/', '1', '');
INSERT INTO phpshop_menu VALUES ('2', '�������� ������������� �������', '<p>�� ������ �������� <a href="http://www.phpshop.ru/page/design.html" target="_blank" rel="noopener">�������� ��������������� ������� � ����</a>��� ����� �����.</p>', '1', '2', '', '1', '');
INSERT INTO phpshop_menu VALUES ('4', '��������� ����', '<p>��� ��������� ����. �������� � ���� ���-���� &rarr; ��������� �����.&nbsp;</p>', '1', '3', '', '0', '');
DROP TABLE IF EXISTS phpshop_messages;
CREATE TABLE phpshop_messages (
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

DROP TABLE IF EXISTS phpshop_modules;
CREATE TABLE phpshop_modules (
  `path` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT '',
  `date` int(11) DEFAULT '0',
  `servers` varchar(64) DEFAULT '',
  PRIMARY KEY (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_modules VALUES ('returncall', 'Return Call', '1570874300', '');
INSERT INTO phpshop_modules VALUES ('visualcart', 'Visual Cart', '1512653689', '');
INSERT INTO phpshop_modules VALUES ('productday', '����� ���', '1573210118', '');
INSERT INTO phpshop_modules VALUES ('sticker', 'Sticker', '1521908948', '');
INSERT INTO phpshop_modules VALUES ('productlastview', 'Product Last View', '1573210130', '');
INSERT INTO phpshop_modules VALUES ('productoption', 'Product Option', '1574590854', '');
INSERT INTO phpshop_modules VALUES ('hit', '����', '1574353614', '');
INSERT INTO phpshop_modules VALUES ('oneclick', 'One Click', '1575019743', '');
INSERT INTO phpshop_modules VALUES ('seourlpro', 'SeoUrl Pro', '1574791299', '');
INSERT INTO phpshop_modules VALUES ('yandexkassa', '������.�����', '1579511841', '');
INSERT INTO phpshop_modules VALUES ('yandexcart', '������.�����', '1574978402', '');

DROP TABLE IF EXISTS phpshop_modules_hit_system;
CREATE TABLE phpshop_modules_hit_system (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hit_main` int(11) NOT NULL DEFAULT '20',
  `hit_page` int(11) NOT NULL DEFAULT '3',
  `version` varchar(64) DEFAULT '1.0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_modules_hit_system VALUES ('1', '20', '3', '1.0');
DROP TABLE IF EXISTS phpshop_modules_key;
CREATE TABLE phpshop_modules_key (
  `path` varchar(64) NOT NULL DEFAULT '',
  `date` int(11) DEFAULT '0',
  `key` text,
  `verification` varchar(32) DEFAULT '',
  PRIMARY KEY (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_modules_oneclick_jurnal;
CREATE TABLE phpshop_modules_oneclick_jurnal (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT '0',
  `name` varchar(64) DEFAULT '',
  `tel` varchar(64) DEFAULT '',
  `message` text,
  `product_name` varchar(64) DEFAULT '',
  `product_id` int(11) DEFAULT NULL,
  `product_price` varchar(64) DEFAULT '',
  `product_image` varchar(64) DEFAULT '',
  `ip` varchar(64) DEFAULT '',
  `status` enum('1','2','3','4') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_modules_oneclick_system;
CREATE TABLE phpshop_modules_oneclick_system (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enabled` enum('0','1','2') DEFAULT '1',
  `title` text,
  `title_end` text,
  `serial` varchar(64) DEFAULT '',
  `windows` enum('0','1') DEFAULT '0',
  `display` enum('0','1') DEFAULT '0',
  `write_order` enum('0','1') DEFAULT '0',
  `captcha` enum('0','1') DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `version` varchar(64) DEFAULT '1.1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_modules_oneclick_system VALUES ('1', '0', '�������, ��� ����� ������!', '���� ��������� �������� � ���� ��� ��������� �������.', '', '1', '0', '1', '1', '0', '1.5');
DROP TABLE IF EXISTS `phpshop_modules_productday_system`;
CREATE TABLE IF NOT EXISTS `phpshop_modules_productday_system` (
  `id` int(11) NOT NULL auto_increment,
  `time` int(11) default '0',
  `version` varchar(64) DEFAULT '1.1',
  `status` enum('1','2','3') default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


INSERT INTO `phpshop_modules_productday_system` VALUES (1,'24','1.2','1');
DROP TABLE IF EXISTS phpshop_modules_productlastview_memory;
CREATE TABLE phpshop_modules_productlastview_memory (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memory` varchar(64) NOT NULL DEFAULT '',
  `product` text NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_modules_productlastview_system;
CREATE TABLE phpshop_modules_productlastview_system (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enabled` enum('0','1','2') NOT NULL DEFAULT '1',
  `flag` enum('1','2') NOT NULL DEFAULT '1',
  `title` varchar(64) NOT NULL DEFAULT '',
  `pic_width` tinyint(100) NOT NULL DEFAULT '0',
  `memory` enum('0','1') NOT NULL DEFAULT '1',
  `num` tinyint(11) NOT NULL DEFAULT '0',
  `serial` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_modules_productlastview_system VALUES ('1', '0', '1', '������������� ������', '50', '1', '5', '');
DROP TABLE IF EXISTS phpshop_modules_productoption_system;
CREATE TABLE phpshop_modules_productoption_system (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` blob NOT NULL,
  `version` varchar(64) NOT NULL DEFAULT '1.3',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_modules_productoption_system VALUES ('1', 'a:20:{s:13:"option_1_name";s:16:"������� ��������";s:15:"option_1_format";s:6:"editor";s:13:"option_2_name";s:21:"���������� � ��������";s:15:"option_2_format";s:6:"editor";s:13:"option_3_name";s:0:"";s:15:"option_3_format";s:4:"text";s:13:"option_4_name";s:0:"";s:15:"option_4_format";s:4:"text";s:13:"option_5_name";s:0:"";s:15:"option_5_format";s:4:"text";s:13:"option_6_name";s:0:"";s:15:"option_6_format";s:4:"text";s:13:"option_7_name";s:0:"";s:15:"option_7_format";s:4:"text";s:13:"option_8_name";s:0:"";s:15:"option_8_format";s:4:"text";s:13:"option_9_name";s:0:"";s:15:"option_9_format";s:4:"text";s:14:"option_10_name";s:0:"";s:16:"option_11_format";N;}', '1.3');
DROP TABLE IF EXISTS `phpshop_modules_returncall_jurnal`;
CREATE TABLE `phpshop_modules_returncall_jurnal` (
  `id` int(11) NOT NULL auto_increment,
  `date` int(11) default '0',
  `time_start` varchar(64) default '',
  `time_end` varchar(64) default '',
  `name` varchar(64) default '',
  `tel` varchar(64) default '',
  `message` text ,
  `status` int(11) default '1',
  `ip` varchar(64) default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


DROP TABLE IF EXISTS phpshop_modules_returncall_system;
CREATE TABLE phpshop_modules_returncall_system (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enabled` enum('0','1','2') DEFAULT '1',
  `title` varchar(64) DEFAULT '',
  `title_end` text,
  `windows` enum('0','1') DEFAULT '1',
  `captcha_enabled` enum('1','2') DEFAULT '1',
  `version` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_modules_returncall_system VALUES ('1', '0', '�������� ������', '�������! �� ����� �������� � ����.', '1', '1', '1.6');


DROP TABLE IF EXISTS phpshop_modules_seourlpro_system;
CREATE TABLE phpshop_modules_seourlpro_system (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paginator` enum('1','2') DEFAULT '1',
  `seo_brands_enabled` enum('1','2') DEFAULT '1',
  `cat_content_enabled` enum('1','2') DEFAULT '1',
  `seo_news_enabled` enum('1','2') DEFAULT '1',
  `seo_page_enabled` enum('1','2') DEFAULT '1',
  `redirect_enabled` enum('1','2') DEFAULT '1',
  `version` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_modules_seourlpro_system VALUES ('1', '2', '2', '1', '2', '2', '1', '2.1');
DROP TABLE IF EXISTS phpshop_modules_sticker_forms;
CREATE TABLE phpshop_modules_sticker_forms (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `path` varchar(64) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `mail` varchar(64) NOT NULL DEFAULT '',
  `enabled` enum('0','1') NOT NULL DEFAULT '1',
  `dir` text NOT NULL,
  `skin` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_modules_sticker_forms VALUES ('1', '������������', 'three', '<p class="icon">&nbsp;</p>\r\n<h6 class="no-margin text-uppercase">������ � ������������</h6>\r\n<p>������� � �������</p>', '', '1', '', 'hub');
INSERT INTO phpshop_modules_sticker_forms VALUES ('2', '�������� �������� �����', 'two', '<p class="icon">&nbsp;</p>\r\n<h6 class="no-margin text-uppercase">�������� �������� �����</h6>\r\n<p>� ������� 14 ���� � ������� �������</p>', '', '1', '', 'hub');
INSERT INTO phpshop_modules_sticker_forms VALUES ('3', '���������� ��������', 'one', '<p class="icon">&nbsp;</p>\r\n<h6 class="no-margin text-uppercase">���������� ��������</h6>\r\n<p>��� ������ �� 5000 ���.</p>', '', '1', '', 'hub');
INSERT INTO phpshop_modules_sticker_forms VALUES ('4', '��������� ������ ��� ������', 'delivery', '<p>���������� �������� ��� ������ �� 3000 ������. <a>�����������</a></p>', '', '1', '', '');
INSERT INTO phpshop_modules_sticker_forms VALUES ('5', '����� � ������� ���������', 'map', '<p><iframe src="https://yandex.ru/map-widget/v1/?um=constructor:055c7ef4dbce4860769e42eb3b7eefb5e095a818465716830ffd258a408d8bb2&amp;source=constructor" width="100%" height="595" frameborder="0"></iframe></p>', '', '1', '', 'lego');
INSERT INTO phpshop_modules_sticker_forms VALUES ('6', '���� � �����������', 'info', '<div class="sticker-info">\r\n<ul>\r\n<li>\r\n<p>���������� ��������</p>\r\n��� ������� �� 3000 ���.</li>\r\n<li>\r\n<p>������������</p>\r\n������ � ������� ������</li>\r\n<li>\r\n<p>30 ���� �� �������</p>\r\n�� ������ ������� ������ �� �����</li>\r\n</ul>\r\n</div>', '', '1', '', 'lego');
INSERT INTO phpshop_modules_sticker_forms VALUES ('7', '������� �������� � �������� ������', 'size', '<p><a class="size-table" href="#" data-toggle="modal" data-target="#sizeModal">������� ��������</a></p>', '', '1', '', '');
INSERT INTO phpshop_modules_sticker_forms VALUES ('8', '�������� � �������� ������', 'shipping', '<p><a class="delivery" href="#" data-toggle="modal" data-target="#shipModal">��������</a></p>', '', '1', '', '');
INSERT INTO phpshop_modules_sticker_forms VALUES ('9', '������� ��� ��������� ������ �����', 'social', '<ul class="social">\r\n<li class="skype"><a href="https://msng.link/sk/login">&nbsp;</a></li>\r\n<li class="whatsapp"><a href="https://msng.link/wa/7926000000">&nbsp;</a></li>\r\n<li class="viber"><a href="https://msng.link/vi/7926000000">&nbsp;</a></li>\r\n</ul>', '', '1', '', '');
INSERT INTO phpshop_modules_sticker_forms VALUES ('10', '�������� ����� � �������', 'pay', '<p><img src="/UserFiles/Image/Trial/pay.png" width="250" height="25" /></p>', '', '1', '', '');
INSERT INTO phpshop_modules_sticker_forms VALUES ('11', '������ ���������� ����� � ������� �����', 'socfooter', '<ul class="social-menu list-inline">\r\n<li class="list-inline-item"><a class="social-button header-top-link" title="Facebook" href="#"><em class="fa fa-facebook" aria-hidden="true">.</em></a></li>\r\n<li class="list-inline-item"><a class="social-button  header-top-link" title="���������" href="#"><em class="fa fa-vk" aria-hidden="true">.</em></a></li>\r\n<li class="list-inline-item"><a class="social-button  header-top-link" title="�������������" href="#"><em class="fa fa-odnoklassniki" aria-hidden="true">.</em></a></li>\r\n</ul>', '', '1', '', '');
INSERT INTO phpshop_modules_sticker_forms VALUES ('13', '�������������� ������', 'banner', '<img src="/UserFiles/Image/Trial/banner_hor.jpg" alt="" width="1830" height="134">', '', '1', '', '');
INSERT INTO phpshop_modules_sticker_forms VALUES ('14', '������� ��� ��������� (������� �������� ���������� �������)', 'mobile_slider', '<p><img src="/UserFiles/Image/Trial/banner_for_mobile.jpg" width="410" height="200" /></p>', '', '1', '', '');
DROP TABLE IF EXISTS phpshop_modules_sticker_system;
CREATE TABLE phpshop_modules_sticker_system (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial` varchar(64) NOT NULL DEFAULT '',
  `version` varchar(64) DEFAULT '1.0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_modules_sticker_system VALUES ('1', '', '1.2');

DROP TABLE IF EXISTS phpshop_modules_visualcart_memory;
CREATE TABLE phpshop_modules_visualcart_memory (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memory` varchar(64) DEFAULT '',
  `cart` text,
  `date` int(11) DEFAULT '0',
  `user` int(11) DEFAULT '0',
  `ip` varchar(64) DEFAULT '',
  `referal` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_modules_visualcart_system;
CREATE TABLE phpshop_modules_visualcart_system (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enabled` enum('0','1','2') DEFAULT '1',
  `flag` enum('1','2') DEFAULT '1',
  `title` varchar(64) DEFAULT '',
  `pic_width` tinyint(100) DEFAULT '0',
  `memory` enum('0','1') DEFAULT '1',
  `serial` varchar(64) DEFAULT '',
  `nowbuy` enum('0','1') DEFAULT '0',
  `version` varchar(64) DEFAULT '2.0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_modules_visualcart_system VALUES ('1', '0', '1', '�������', '50', '1', '', '1', '2.0');
DROP TABLE IF EXISTS phpshop_modules_yandexcart_system;
CREATE TABLE phpshop_modules_yandexcart_system (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(64) DEFAULT NULL,
  `version` varchar(64) DEFAULT '2.1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_modules_yandexcart_system VALUES ('1', '', '2.4');
DROP TABLE IF EXISTS phpshop_news;
CREATE TABLE phpshop_news (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datas` varchar(32) DEFAULT '',
  `zag` varchar(255) DEFAULT '',
  `kratko` text,
  `podrob` text,
  `datau` int(11) DEFAULT '0',
  `odnotip` text,
  `servers` varchar(64) DEFAULT '',
  `icon` varchar(255) DEFAULT '',
  `news_seo_name` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_newsletter;
CREATE TABLE phpshop_newsletter (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `content` text,
  `template` int(11) DEFAULT '0',
  `date` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_notice;
CREATE TABLE phpshop_notice (
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

DROP TABLE IF EXISTS phpshop_opros;
CREATE TABLE phpshop_opros (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) unsigned DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `total` int(11) DEFAULT '0',
  `num` tinyint(32) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_opros_categories;
CREATE TABLE phpshop_opros_categories (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `dir` varchar(32) DEFAULT '',
  `flag` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_order_status;
CREATE TABLE phpshop_order_status (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `color` varchar(64) DEFAULT '',
  `sklad_action` enum('0','1') DEFAULT '0',
  `cumulative_action` enum('0','1') DEFAULT '0',
  `mail_action` enum('0','1') DEFAULT '1',
  `mail_message` text,
  `sms_action` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_order_status VALUES ('1', '�����������', 'red', '0', '0', '1', '', '0');
INSERT INTO phpshop_order_status VALUES ('2', '������������', '#DA881C', '0', '0', '1', '', '0');
INSERT INTO phpshop_order_status VALUES ('3', '��������', '#20ed41', '1', '1', '1', '', '0');

DROP TABLE IF EXISTS phpshop_orders;
CREATE TABLE phpshop_orders (
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
  `tracking` varchar(64) DEFAULT '',
  `admin` int(11) default 0,
  `servers` int(11) default 0,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_orders VALUES ('1', '1574888506', '1-68', 'a:2:{s:4:"Cart";a:5:{s:4:"cart";a:9:{i:58;a:11:{s:2:"id";s:2:"58";s:4:"name";s:23:"����� Mangoff 37 ������";s:5:"price";s:4:"9000";s:7:"price_n";s:1:"0";s:3:"uid";N;s:3:"num";i:1;s:6:"ed_izm";N;s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img11_84557s.jpg";s:6:"weight";N;s:6:"parent";i:11;s:10:"parent_uid";s:6:"098099";}i:86;a:11:{s:2:"id";s:2:"86";s:4:"name";s:28:"�������� Mangoff 37 ��������";s:5:"price";s:3:"800";s:7:"price_n";s:1:"0";s:3:"uid";N;s:3:"num";i:3;s:6:"ed_izm";N;s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img10_90450s.jpg";s:6:"weight";N;s:6:"parent";i:10;s:10:"parent_uid";s:6:"455657";}i:141;a:11:{s:2:"id";s:3:"141";s:4:"name";s:24:"���� Springfold ������� ";s:5:"price";s:4:"3590";s:7:"price_n";s:1:"0";s:3:"uid";N;s:3:"num";i:1;s:6:"ed_izm";N;s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img18_49453s.jpg";s:6:"weight";N;s:6:"parent";i:18;s:10:"parent_uid";s:6:"876876";}i:31;a:9:{s:2:"id";s:2:"31";s:4:"name";s:13:"������ Zivage";s:5:"price";s:3:"300";s:7:"price_n";s:3:"600";s:3:"uid";s:9:"323255432";s:3:"num";i:2;s:6:"ed_izm";s:3:"��.";s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img31_95215s.jpg";s:6:"weight";N;}i:115;a:11:{s:2:"id";s:3:"115";s:4:"name";s:23:"������� Kustang L �����";s:5:"price";s:4:"6700";s:7:"price_n";s:1:"0";s:3:"uid";N;s:3:"num";i:1;s:6:"ed_izm";N;s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img21_18874s.jpg";s:6:"weight";N;s:6:"parent";i:21;s:10:"parent_uid";s:5:"34435";}i:131;a:11:{s:2:"id";s:3:"131";s:4:"name";s:15:"���� Abibas 39 ";s:5:"price";s:4:"4500";s:7:"price_n";s:1:"0";s:3:"uid";N;s:3:"num";i:1;s:6:"ed_izm";N;s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img23_77945s.jpg";s:6:"weight";N;s:6:"parent";i:23;s:10:"parent_uid";s:7:"8776987";}i:32;a:9:{s:2:"id";s:2:"32";s:4:"name";s:20:"����� ��� ��� Zivage";s:5:"price";s:3:"115";s:7:"price_n";s:3:"230";s:3:"uid";s:6:"656754";s:3:"num";i:1;s:6:"ed_izm";s:3:"��.";s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img32_33653s.jpg";s:6:"weight";N;}i:33;a:9:{s:2:"id";s:2:"33";s:4:"name";s:20:"������� ����� Zivage";s:5:"price";s:3:"600";s:7:"price_n";s:4:"1200";s:3:"uid";s:7:"6546543";s:3:"num";i:1;s:6:"ed_izm";s:3:"��.";s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img33_66960s.png";s:6:"weight";N;}i:34;a:9:{s:2:"id";s:2:"34";s:4:"name";s:16:"����� Saybelline";s:5:"price";s:4:"2500";s:7:"price_n";s:4:"5000";s:3:"uid";s:6:"123245";s:3:"num";i:1;s:6:"ed_izm";s:3:"��.";s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img34_27336s.png";s:6:"weight";N;}}s:3:"num";i:12;s:3:"sum";s:5:"30005";s:6:"weight";i:0;s:8:"dostavka";i:0;}s:6:"Person";a:9:{s:4:"ouid";s:4:"1-68";s:4:"data";s:10:"1574888506";s:4:"time";s:8:"00:46 am";s:4:"mail";s:12:"test@mail.ru";s:11:"name_person";s:11:"���� ������";s:14:"dostavka_metod";i:3;s:8:"discount";s:2:"15";s:7:"user_id";i:31;s:11:"order_metod";i:3;}}', 'a:2:{s:7:"maneger";N;s:4:"time";s:16:"28-11-2019 00:02";}', '31', '0', '2', '', '', '', '', '', '+7 (098) 709-86-09', '', '', '', '', '', '765765', '', '', '', '', '', '', '', '', '', '', '', '25504',  NULL, '',0,0);
INSERT INTO phpshop_orders VALUES ('2', '1575019429', '2-19', 'a:2:{s:4:"Cart";a:5:{s:4:"cart";a:10:{i:128;a:11:{s:2:"id";s:3:"128";s:4:"name";s:13:"���� Gans 39 ";s:5:"price";s:4:"8000";s:7:"price_n";s:1:"0";s:3:"uid";N;s:3:"num";i:2;s:6:"ed_izm";N;s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img25_67891s.jpg";s:6:"weight";N;s:6:"parent";i:25;s:10:"parent_uid";s:8:"98769876";}i:129;a:11:{s:2:"id";s:3:"129";s:4:"name";s:13:"���� Gans 40 ";s:5:"price";s:4:"8000";s:7:"price_n";s:1:"0";s:3:"uid";N;s:3:"num";i:2;s:6:"ed_izm";N;s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img25_67891s.jpg";s:6:"weight";N;s:6:"parent";i:25;s:10:"parent_uid";s:8:"98769876";}i:94;a:11:{s:2:"id";s:2:"94";s:4:"name";s:16:"���� Mangoff 37 ";s:5:"price";s:4:"5000";s:7:"price_n";s:4:"5600";s:3:"uid";N;s:3:"num";i:3;s:6:"ed_izm";N;s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img14_84532s.jpg";s:6:"weight";N;s:6:"parent";i:14;s:10:"parent_uid";s:9:"876876876";}i:16;a:9:{s:2:"id";s:2:"16";s:4:"name";s:13:"������ Oodjim";s:5:"price";s:4:"1290";s:7:"price_n";s:1:"0";s:3:"uid";s:6:"987987";s:3:"num";i:2;s:6:"ed_izm";s:3:"��.";s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img16_92849s.jpg";s:6:"weight";N;}i:95;a:11:{s:2:"id";s:2:"95";s:4:"name";s:16:"���� Mangoff 38 ";s:5:"price";s:4:"5000";s:7:"price_n";s:4:"5700";s:3:"uid";N;s:3:"num";i:2;s:6:"ed_izm";N;s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img14_84532s.jpg";s:6:"weight";N;s:6:"parent";i:14;s:10:"parent_uid";s:9:"876876876";}i:96;a:11:{s:2:"id";s:2:"96";s:4:"name";s:16:"���� Mangoff 39 ";s:5:"price";s:4:"5000";s:7:"price_n";s:4:"5600";s:3:"uid";N;s:3:"num";i:1;s:6:"ed_izm";N;s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img14_84532s.jpg";s:6:"weight";N;s:6:"parent";i:14;s:10:"parent_uid";s:9:"876876876";}i:134;a:11:{s:2:"id";s:3:"134";s:4:"name";s:16:"������� Gans 42 ";s:5:"price";s:4:"8000";s:7:"price_n";s:1:"0";s:3:"uid";N;s:3:"num";i:1;s:6:"ed_izm";N;s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img26_58467s.jpg";s:6:"weight";N;s:6:"parent";i:26;s:10:"parent_uid";s:8:"09878976";}i:62;a:11:{s:2:"id";s:2:"62";s:4:"name";s:28:"������ 1001 Dressyy 37 �����";s:5:"price";s:4:"1200";s:7:"price_n";s:4:"1350";s:3:"uid";N;s:3:"num";i:4;s:6:"ed_izm";N;s:9:"pic_small";s:38:"/UserFiles/Image/Trial/img1_69884s.jpg";s:6:"weight";N;s:6:"parent";i:1;s:10:"parent_uid";s:7:"3343460";}i:44;a:9:{s:2:"id";s:2:"44";s:4:"name";s:44:"����� ������������ ��� ���� � ���� TEKOV DMT";s:5:"price";s:4:"2380";s:7:"price_n";s:1:"0";s:3:"uid";s:8:"98769875";s:3:"num";i:1;s:6:"ed_izm";s:3:"��.";s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img44_23523s.jpg";s:6:"weight";N;}i:40;a:9:{s:2:"id";s:2:"40";s:4:"name";s:58:"������� ����. ������������� ��������� (�������� �� 2 ����)";s:5:"price";s:4:"1450";s:7:"price_n";s:1:"0";s:3:"uid";s:7:"2452456";s:3:"num";i:1;s:6:"ed_izm";s:3:"��.";s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img40_16081s.jpg";s:6:"weight";N;}}s:3:"num";i:19;s:3:"sum";i:69029;s:6:"weight";i:0;s:8:"dostavka";i:0;}s:6:"Person";a:9:{s:4:"ouid";s:4:"2-19";s:4:"data";s:10:"1575019429";s:4:"time";s:8:"12:49 pm";s:4:"mail";s:14:"test@gmail.com";s:11:"name_person";s:13:"����� �������";s:14:"dostavka_metod";s:1:"3";s:8:"discount";s:2:"15";s:7:"user_id";i:32;s:11:"order_metod";s:5:"10032";}}', 'a:2:{s:7:"maneger";s:0:"";s:4:"time";s:16:"29-11-2019 14:55";}', '32', '0', '0', '', '', '� �����-���������', '194044', '����� �������', '&#43;7 (098) 709-86-09', '������ ��-��', '� 20 � 12 ', '', '', '', '� 13', '', '', '', '', '', '', '', '', '', '', '', '69029',  NULL, '',0,0);
INSERT INTO phpshop_orders VALUES ('3', '1575025403', '3-49', 'a:2:{s:4:"Cart";a:5:{s:4:"cart";a:1:{s:0:"";a:10:{s:2:"id";s:2:"46";s:3:"uid";s:8:"34546456";s:4:"name";s:36:"���� ����������� RedVerg RD-CS130-55";s:5:"price";s:4:"7000";s:3:"num";i:1;s:6:"weight";s:0:"";s:6:"ed_izm";s:0:"";s:9:"pic_small";s:39:"/UserFiles/Image/Trial/img46_54151s.jpg";s:6:"parent";i:0;s:4:"user";i:0;}}s:3:"num";i:1;s:3:"sum";i:5950;s:6:"weight";N;s:8:"dostavka";s:1:"0";}s:6:"Person";a:17:{s:4:"ouid";s:7:"101-335";s:4:"data";i:1575025403;s:4:"time";s:0:"";s:4:"mail";s:13:"mail3@test.ru";s:11:"name_person";s:17:"������� ���������";s:8:"org_name";s:0:"";s:7:"org_inn";s:0:"";s:7:"org_kpp";s:0:"";s:8:"tel_code";s:0:"";s:8:"tel_name";s:0:"";s:8:"adr_name";s:0:"";s:14:"dostavka_metod";s:1:"1";s:8:"discount";s:2:"15";s:7:"user_id";s:0:"";s:6:"dos_ot";s:0:"";s:6:"dos_do";s:0:"";s:11:"order_metod";s:5:"10032";}}', 'a:2:{s:7:"maneger";s:0:"";s:4:"time";s:16:"29-11-2019 14:21";}', '0', '0', '0', '������', '', '������', '', '������� ���������', '&#43;7 (768) 430-49-89', '�� ������', '� 9 ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '5950', 'N;', '',0,0);
DROP TABLE IF EXISTS phpshop_page;
CREATE TABLE phpshop_page (
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
  `icon` varchar(255) DEFAULT '',
  `preview` text,
  `footer` enum('0','1') DEFAULT '1',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `link` (`link`),
  FULLTEXT KEY `content` (`content`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_page VALUES ('1', '������� ��������� ������ ��������', 'index', '2000', '', '', '<p>��� �������������� ����� ������ ��������-��������. ����� ��������� �����, ���������� � ���� �������� ����� ������ ��������, �� ������� �� ������ ������������ � �������. ����� ������ ������ ��������. ��������� ���� �������� ��� ������� ����� H1 �� ���� ��������, �� ����� �������������� ������������ ��� �������. ��������� ��������� �� ������������ � ���� ��������� Seo ���������.</p>\n<p>�</p>', '', '0', '0', '', '', '1', '0', '', '', '', '0');
INSERT INTO phpshop_page VALUES ('62', '���-10 ���� ��� ������', 'top-10_knig_dlya_zhenschin', '18', '', '', '<p><img src="/UserFiles/Image/Trial/img33_95820s.png" alt="" width="300" height="300" /></p>\r\n<p class="text-justify">� ������ ������� ������ ������������ ������ �� ������������ ������� ������������ �������� ����� (������������) ������� � ������������ ���������� ����������� ��������. ������������� � ������� ���� ����� � ����� �������� ������ ������������ ����� ���������� ����������� �������� ���������� ����������� ��������. �� �������, ������ ��������, ��� ���������� ���������� �������� ������� � ������������ ������� ������������� �������� �������, ���������� ����������� � ��������� ������������ �����. ������� ����������� ������� �������, � ����� ���������� � �������� ��������� � ������������ ������� ������������� �������� ������ ��������. ������� ����������� ������� �������, � ����� ����������� ��������� ����������� ��������� ��������� ������ ������� �� ���������� ������ ��������� �������. ��������! ������������ � ������� ������� � ������������ ������� ������������� �������� ����������� �������������� ��������.</p>\r\n<p class="text-justify">������������ �������� ����������, ��� ������������ � ������� ������� ��������� ��������� ������ ������� �� ���������� �������, ���������� ����������� � ��������� ������������ �����. ������ ������� ������������ � ������� ������� ������ ������ ���� � ������������ ������ ��������� �������.</p>\r\n<p class="text-justify">������ ������� ���������� �������� ��������� ���� ������������ ������ �� ����� ������� ��������� � ������������ ����� �����������. ������� ����������� ������� �������, � ����� ������������ � ������� ������� ������������ ����� ���������� ����������� �������� ������������ ���������� � ���������������� �������. ������ �����������, � ����������� �� ����� � ����� �������� ������ ��������� ��������� ������ ������� �� ���������� ������ ��������� �������.</p>\r\n<p class="text-justify">����� ������� ����� � ����� �������� ������ ������������ ���������� � ���������� �������, ���������� ����������� � ��������� ������������ �����. � ������ ������� ����������� ��������� ����������� ������ �� ����� ������� ��������� � ������������ ��������������� ������� �����������. �� �������, ������ ��������, ��� ���������� �������������-���������������� ����������� ����� ������������ ������� �� ��� ������� ���������� ����������� ��������. ������ ������� ���������� �������������-���������������� ����������� ����� ������������ ������� ����������� � ��������� ������������ ���������� � ���������������� �������. � ������ ������� ���������� �������� ��������� ���� ������������ � ������������ ������� ������������� �������� ������������ ���������� � ���������������� �������.</p>\r\n<p class="text-justify">�� �������, ������ ��������, ��� ���������� �������� ��������� ���� ������������ ��������� ������� �������� ��������������� ������� �����������. ��������! ���������� ���������� �������� ������� ������� ����������� � ��������� ������ ��������� �������. ������������ �������� ����������, ��� ������ ������������ ������ �� ������������ ������� ��������� ������� �������� ������ ��������.</p>\r\n<p class="text-justify">������� ����������� ������� �������, � ����� ������������ � ������� ������� ������ ������ ���� � ������������ �������, ���������� ����������� � ��������� ������������ �����. ������ �����������, � ����������� �� ���������� �������������-���������������� ����������� ����� ������������ � ������������ ������� ������������� �������� ���� ��������.</p>', '', '1', '1574805600', '23,25,26,24', '', '1', '0', '', '/UserFiles/Image/Trial/img31_66601s.jpg', '<p class="text-justify">������������ �������� ����������, ��� ������������ � ������� ������� ��������� ��������� ������ ������� �� ���������� �������, ���������� ����������� � ��������� ������������ �����. ������ ������� ������������ � ������� ������� ������ ������ ���� � ������������ ������ ��������� �������.</p>\r\n<p class="text-justify">&nbsp;</p>', '0');
INSERT INTO phpshop_page VALUES ('63', '���� � ���������������� ���������', 'mify_prof_cosmetis', '18', '', '', '<p>���������� ������, �������� ����� ���������� ����� ������� ���������, �������� ����� ����.&nbsp;</p>\r\n<p>&nbsp;<iframe src="https://www.youtube.com/embed/uxQeNM_N29A" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>\r\n<p>��������� ������ ��������� ��� � ����� ����������, �������, � ���� �������, ������ ���� � ������ ������� ������������� ���� ����. �� �������, ������, ��������, ��� ��������� ����������� ������� ������ ������������� ��������� � ���������������� ���� ������ ���� ������������ ����������� � ������ ��������� ����������� ��������. ���� ��������� ������ ������������ ����� �� ��� ����, ��� ������������� ������ ���������� ��� ������� � ������ ���� ���������� ����������� ���������������� �����������.</p>\r\n<p>��������, ������� ������������� ������ �������� ���� �������� ������������ ����� ������������ ����� ���������, � ������, ������ ���� ������������ ������������ �� ��������. ������������� � ������� ���� ������� ���, ��� ���������� �������������� ���� � ����� ����� ���������� ������ ������������ �������� ��� ������������� ���������� �������� � ��������. �������� �������� �������� ���������, ���������� ���������� �������� ������� �� ��� ��� ����� ������, ����� ����������� ������ ������� �������!</p>', '', '1', '1574805600', '37,36,35', '', '1', '0', '', '/UserFiles/Image/Trial/img19_76156s.jpg', '<p>��� ����� ����� ������.</p>', '0');
INSERT INTO phpshop_page VALUES ('61', '���� ������ ������� ���������?', 'pro_photo', '1000', '', '', '<p>��� ������� � PHPShop - ����������. ��� ������, ��� �� ���� ����������� �������� ������ ������������ ���������. ��� ��������� ����������� � ������� �������� ������� - HTML �������� �������, ������� <strong>���� ��������� ���������� ��� ���� �������� ���� �������</strong>.</p>\n<p>������� ����� ���������</p>\n<p><strong>- �������� ����� �� ������� ����������� �����������;</strong><br /><strong>- �� ��������� ���� ��������� ������� ��� �������� ���������;</strong><br /><strong>- ��������� ���� �������� ����� ��������� - ��� �������������� ����������, ��� ������������;</strong><br /><strong>- ����� ������, ����� ������ ����� � �������� �� ���� ����������� �� ���, ��� ���� ����� �������� �����.</strong></p>\n<p>��� ��� ������ �� �������� ����������� ������ �������� ��������!</p>\n<table class="table table-striped">\n<tbody>\n<tr>\n<td class="td1" style="width: 134px;" valign="top">\n<p class="p1">���</p>\n</td>\n<td class="td1" style="width: 94px;" valign="top">\n<p class="p1">������</p>\n</td>\n<td class="td1" style="width: 441px;" valign="top">\n<p class="p1">���������</p>\n</td>\n<td class="td1" style="width: 209px;" valign="top">\n<p class="p1">������ ��������</p>\n</td>\n</tr>\n<tr>\n<td class="td1" style="width: 134px;" valign="top">\n<p class="p1">���� �������</p>\n</td>\n<td class="td1" style="width: 94px;" valign="top">\n<p class="p2">~ 800*1000</p>\n</td>\n<td class="td1" style="width: 441px;" valign="top">\n<p class="p1">��������� ����� ��� ���� � ����� ���������. �� ���������� ���� ������� ����, ��� ������ �������� ���������� ��� �������������� ������� ��� �������, ��������� � ���� ��������� - �����������.</p>\n</td>\n<td class="td1" style="width: 209px;" valign="top">\n<p class="p1"><a href="https://demo.phpshop.ru/UserFiles/Image/Trial/img9_38664.jpg" target="_blank" rel="noopener">������ �������� ��� ������</a></p>\n</td>\n</tr>\n<tr>\n<td class="td1" style="width: 134px;" valign="top">\n<p class="p1">���� ���������</p>\n</td>\n<td class="td1" style="width: 94px;" valign="top">\n<p class="p1">������ 410*200</p>\n</td>\n<td class="td1" style="width: 441px;" valign="top">\n<p class="p1">���� ��������� ����� ��������� ����� �������, ��������� ������ ��� ������ ������ ��������� ����� ���������� ��������, ��� ������� ����������� �� ���� �����������.</p>\n</td>\n<td class="td1" style="width: 209px;" valign="top">\n<p class="p3"><a href="https://demo.phpshop.ru/UserFiles/Image/Trial/phpshop6_catalogs4.jpg" target="_blank" rel="noopener">������ �������� ��� ��������</a></p>\n</td>\n</tr>\n<tr>\n<td class="td1" style="width: 134px;" valign="top">\n<p class="p1">������� ������ ��� ������� �������</p>\n</td>\n<td class="td1" style="width: 94px;" valign="top">\n<p class="p1">~ 1440*300</p>\n</td>\n<td class="td1" style="width: 441px;" valign="top">\n<p class="p1">������� ������ ����������� � ���� ��������� - �������. ��� ������� � ������� ����� ��������� ������ �������.</p>\n</td>\n<td class="td1" style="width: 209px;" valign="top">\n<p class="p3"><a href="https://demo.phpshop.ru/UserFiles/Image/Trial/slider1.jpg" target="_blank" rel="noopener">������ �������� ������� ��� ������� �������</a></p>\n</td>\n</tr>\n<tr>\n<td class="td1" style="width: 134px;" valign="top">\n<p class="p1">������� ������ ��� ��������� ���������</p>\n</td>\n<td class="td1" style="width: 94px;" valign="top">\n<p class="p1">~410*200</p>\n</td>\n<td class="td1" style="width: 441px;" valign="top">\n<p class="p1">��������� ������� ��� ������� ������� ����� �������������� ����������, ��� ������� �� ��������� ������� ������ �� ����� �����. ����� ��� ������ � ��� ����� ������� �������� �� ���������, ��� �� �������� �����������. ��� ����� �� ����� ��������� ������ � ������ ��� ���������� ��������. ����������� � ���� ������ - ������� - ������� ��� ���������.</p>\n</td>\n<td class="td1" style="width: 209px;" valign="top">\n<p class="p3"><a href="https://demo.phpshop.ru/UserFiles/Image/Trial/banner_for_mobile.jpg" target="_blank" rel="noopener">������ �������� ������� ��� ���������</a></p>\n</td>\n</tr>\n<tr>\n<td class="td1" style="width: 134px;" valign="top">\n<p class="p1">�������� ������������� ������� � �������</p>\n</td>\n<td class="td1" style="width: 94px;" valign="top">\n<p class="p1">~ 420* 600</p>\n</td>\n<td class="td1" style="width: 441px;" valign="top">\n<p class="p1">������ � ����� ������� ����������� � ���� ��������� - �������.</p>\n</td>\n<td class="td1" style="width: 209px;" valign="top">\n<p class="p3"><a href="https://demo.phpshop.ru/UserFiles/Image/Trial/banner_vert.jpg" target="_blank" rel="noopener">������ �������� ������������� �������</a></p>\n</td>\n</tr>\n<tr>\n<td class="td1" style="width: 134px;" valign="top">\n<p class="p1">�������� ��������������� �������</p>\n</td>\n<td class="td1" style="width: 94px;" valign="top">\n<p class="p1">~1830*130</p>\n</td>\n<td class="td1" style="width: 441px;" valign="top">\n<p class="p1">�������������� ������ � ���� ����� ����������� � ���� ������ - ������� - �������������� ������.</p>\n</td>\n<td class="td1" style="width: 209px;" valign="top">\n<p class="p3"><a href="https://demo.phpshop.ru/UserFiles/Image/Trial/banner_hor.jpg" target="_blank" rel="noopener">������ �������� ��������������� �������</a></p>\n</td>\n</tr>\n<tr>\n<td class="td1" style="width: 134px;" valign="top">\n<p class="p1">�������� ��� �������� ������</p>\n</td>\n<td class="td1" style="width: 94px;" valign="top">\n<p class="p1">~ 210*70</p>\n</td>\n<td class="td1" style="width: 441px;" valign="top">\n<p class="p1">�������� ����� ������ �� ��������, ����� ��� ������ ���������� �� ������ ����. ����� �������� �����, ����� �������� ������ ���������� - �������, �������, ���������� ��������� ������.� � ��������� ���������� ������ ���������� ������� �� ����, ����� �������� ��� � ��� �����. �������� �������� �� ������ ��������� ��������.�</p>\n</td>\n<td class="td1" style="width: 209px;" valign="top">\n<p class="p3"><a href="https://demo.phpshop.ru/UserFiles/Image/Trial/brand-3.png" target="_blank" rel="noopener">������ �������� ������</a></p>\n</td>\n</tr>\n</tbody>\n</table>', '', '1', '1574805600', '', '', '1', '0', '', '', '', '1');
INSERT INTO phpshop_page VALUES ('26', '���������� �� ������ ����-������?', 'purchase', '1000', '', '', '<p>��� �������� ��������-������� <strong>@serverName@</strong> �� ���� ��������� PHPShop @version@ ����� �������� 30 ����. <strong>�� ������ ��� ������ ��������� ���� �������, ��� ������ ����� ������� ����������!&nbsp;</strong></p>\r\n<p>��� ������������ ��������� ��������-�������� PHPShop, ����� ������� � ������ ���������� ������ �� ������ ����. �����, ��� ����� ������� ������� ��� ������ - �����������: ������� Visa, Mastercard, ����� ��������� Qiwi, ����� ��������, ���������� ��������� ��� ����������� ���. ����� ������ ������, � ������� ����� �������� ���� �� ������ � ����������� ����. ��������� ���� ���������� �� ���������� �� �����, ��������� � ������� ������� ������ ������� ��������.</p>\r\n<p><a class="btn btm-sm btn-primary" href="https://www.phpshop.ru/order/?from=@serverName@&amp;action=order" target="_blank" rel="noopener">������� � ���������� ������ PHPShop</a></p>', '', '2', '1574373600', '', '������ PHPShop', '1', '0', '', '', '', '0');
INSERT INTO phpshop_page VALUES ('23', '����������', 'admin', '1000', '', '', '<p>��� ������� � ������ ���������� PHPShop ������� ��������� ������ <kbd>Ctrl</kbd> &#43; <kbd>F12</kbd> ��� ����������� ������ �������� ����.<br /> ����� �� ��������� <strong>demo</strong>, ������ <strong>demouser</strong>. ���� �� ��� ��������� ������ ���� ����� � ������, �� ����������� ���� ������ ��� �����������.</p>\n<p><a class="btn btn-success btn-sm" href="phpshop/admpanel/" target="_blank" rel="noopener"> ������� � ������ ����������</a></p>\n<h2>�������� ����</h2>\n<p>��� ��������� �������� ����������� �������� �������� ���� ��� ������������ ������������ ���������. ��� ������� �������� ���� ������� � ������ ���������� ��������� ������� � ���� <kbd>����</kbd> - <kbd>SQL ������ � ����</kbd> ������� � ���������� ������ ����� <strong>"�������� ����"</strong>. �������� ���� ��������, ��� ��������� ��� �������� ���� � ������� ������ ������ ��������.</p>\n<h2>�������������� �������</h2>\n<p>PHPShop EasyControl - <strong>���������� ����� ���������� ������</strong> ��� �������� � ���������� ��������-��������� PHPShop �� ��������� ���������� . EasyControl ����� � ��������� � �� ������� ������� ����������� �������. � ������� EasyControl �� ������� ���������� ���� �������� �� �� ���� �� �������, ��������� ��������� �����, ������������ ������, ��������� �������� ���� � ������������� �������. � ������ ������ ������ ����� 10 ������: <strong>Monitor, Updater, Installer, Chat, Price Loader, Password Restore</strong> � ������.</p>\n<p><a class="btn btn-info btn-sm" href="https://www.phpshop.ru/loads/files/setup.exe" target="_blank" rel="noopener"> ������� ������� EasyControl</a></p>', '', '3', '1563400800', '39,40', '����������������� PHPShop', '1', '0', '', '', '', '0');
INSERT INTO phpshop_page VALUES ('60', '����� ������ �����������', 'obzor_vashego_bestsellera', '18', '', '', '<p>������� ��� ������ �������, �������� ���� � ����� ���������� ������ � ���� ���-���� - ��������.</p>\r\n<p><img src="/UserFiles/Image/Trial/phpshop6_catalogs7.jpg" alt="" width="410" height="200" /></p>\r\n<p class="text-justify">�� �������, ������ ��������, ��� ����� ������ ��������������� ������������ ������ ������ ���� � ������������ ���������� ����������� ��������. ������ �����������, � ����������� �� ����� ������ ��������������� ������������ ������ ������ ���� � ������������ ��������������� ������� �����������. � ������ ������� ���������� �������� ��������� ���� ������������ ������� ����������� � ��������� ����������� �������������� ��������. ���������� ���� ������� ��������� ��������, ��� ������ ������������ ������ �� ������������ ������� ������������ �������� ����� (������������) ������� � ������������ ������ ��������� �������. �� �������, ������ ��������, ��� ���������� �������������� ���� � ����� ����� ���������� ������� �� ��� ������� �������, ���������� ����������� � ��������� ������������ �����.</p>\r\n<p class="text-justify">������������� � ������� ���� ����������� ��������� ����������� ������������ ���������� � ���������� ��������������� ������� �����������. ������������� � ������� ���� ������ ������������ ������ �� ������������ ������� ������� �� ��� ������� ����������� �������������� ��������. ������ �����������, � ����������� �� ������ ������������ ������ �� ������������ ������� ������������ ����� ���������� ����������� �������� �������, ���������� ����������� � ��������� ������������ �����. ������ ������� ���������� �������� ��������� ���� ������������ ������������ ���������� � ���������� ������� �������� ������, ������������� �������� ������������. ������ �����������, � ����������� �� ����� ������ ��������������� ������������ ������� �� ��� ������� ������������ ���������� � ���������������� �������.</p>\r\n<p class="text-justify"><img src="/UserFiles/Image/Trial/img15_92639s.jpg" alt="" width="240" height="300" /></p>\r\n<p class="text-justify">���������� ���� ������� ��������� ��������, ��� ������������ � ������� ������� ������������ ���������� � ���������� ��������������� ������� �����������. ������������ �������� ����������, ��� ������ ������������ ������ �� ������������ ������� ��������� ������� �������� ������� �������� ������, ������������� �������� ������������. ������ ������� ����� ������ ��������������� ������������ ��������� ������� �������� ���������� ����������� ��������. ��������! ����������� ��������� ����������� ������� ����������� � ��������� ����� �����������. ������ ������� ���������� �������� ��������� ���� ������������ ������������ �������� ����� (������������) ������� � ������������ ���������� ����������� ��������. ���������� ���� ������� ��������� ��������, ��� ����������� ��������� ����������� ������ ������ ���� � ������������ ������ ��������� �������.</p>\r\n<p class="text-justify">�� �������, ������ ��������, ��� ������ ������������ ������ �� ������������ ������� � ������������ ������� ������������� �������� ������ ��������. �� �������, ������ ��������, ��� ����� ������ ��������������� ������������ � ������������ ������� ������������� �������� ������������ ���������� � ���������������� �������. ��������! ���������� �������������� ���� � ����� ����� ���������� ������ ������ ���� � ������������ ������ ��������. ������ ������� ���������� �������������-���������������� ����������� ����� ������������ ������������ ���������� � ���������� ����� �����������.</p>\r\n<p class="text-justify">������ ������� ������ ������������ ������ �� ������������ ������� ��������� ������� �������� ������ ��������� �������. ����� ������� ���������� �������� ��������� ���� ������������ ��������� ��������� ������ ������� �� ���������� ������������ ���������� � ���������������� �������.</p>\r\n<p class="text-justify">� ������ ������� ���������� �������������� ���� � ����� ����� ���������� ��������� ������� �������� ������ ��������� �������. ������� ����������� ������� �������, � ����� ������ ������������ ������ �� ������������ ������� ��������� ������� �������� ����� �����������. ��������! ����� ������ ��������������� ������������ ������ �� ����� ������� ��������� � ������������ ������������ ���������� � ���������������� �������.</p>', '', '1', '1574460000', '', '', '1', '0', '', '', '', '0');
INSERT INTO phpshop_page VALUES ('27', '�������', 'help', '0', '', '', '<h3>�������</h3>\r\n<p>���������-�������������� ���� (F.A.Q.), ����������� ����������� PHPShop � ������ �� ������ ������� �� ���������� ��������-���������. ������� ������� ����������� ���������� � �����-������.<br />�����: <a href="http://faq.phpshop.ru" target="_blank" rel="noopener">faq.phpshop.ru</a></p>\r\n<h3>����������� ������������</h3>\r\n<p>���������� ���� ��� ������������� (WIKI). �������� ������� ���������� ����������� ������������ � ��������� �� ���������� PHPShop. �������� ������ EasyControl � �������������� �������.<br />�����: <a href="http://wiki.phpshop.ru" target="_blank" rel="noopener">wiki.phpshop.ru</a></p>\r\n<h3>�������� API</h3>\r\n<p>���������� ���� ��� ������������� (PHPDoc). �������� ��������� �������� API PHPShop, ������� � �������.<br />�����: <a href="http://doc.phpshop.ru" target="_blank" rel="noopener">doc.phpshop.ru</a></p>\r\n<h3>���� ������</h3>\r\n<p>���������� ���� ������ ����������� ���������. �������� ������ �� �������� ������ ��������, ������������� � ������������� PHPShop � ���������.<br />�����: <a href="https://help.phpshop.ru" target="_blank" rel="noopener">help.phpshop.ru</a></p>\r\n<h3>���������� ����</h3>\r\n<p>������������ ��������� � ���������� ���������� �����. �������� ����� ���������� ���������� �� ������������ ���������, �������� � ������.<br />�����: <a href="https://www.facebook.com/shopsoft" target="_blank" rel="noopener">https://www.facebook.com/shopsoft</a><br /><a href="https://twitter.com/PHPShopCMS" target="_blank" rel="noopener">https://twitter.com/PHPShopCMS</a><br /><a href="https://plus.google.com/&#43;PhpshopRu" target="_blank" rel="noopener">https://plus.google.com/&#43;PhpshopRu</a></p>\r\n<h3>�����-�����</h3>\r\n<p>�������������� ������ � �����-������� �� ������ � PHPShop �� ������� YouTube. �������� ��������� ����� �� ��������� � ������ � 1�-��������������, PHPShop � ��������� EasyControl.<br />�����: <a href="http://www.youtube.com/user/phpshopsoftware" target="_blank" rel="noopener">http://www.youtube.com/user/phpshopsoftware</a></p>', '', '1', '1574373600', '', '', '1', '0', '', '', '', '0');
INSERT INTO phpshop_page VALUES ('22', '������� ������ ��� ������ Visa � Mastercard', 'agreement', '0', '', '', '', '', '1', '1574373600', '', '', '1', '0', '', '', '', '0');
INSERT INTO phpshop_page VALUES ('43', '�������� ������������������', 'politika_konfidencialnosti', '0', '', '', '<h2>�������� ������������������ ��� ��������-��������</h2>\n<p>� ������� ������ � ������� ��, ��� ��� ���� ���������� ��� ������ �������.</p>\n<ol>\n<li>����������� ��������\n<ol>\n<li>������������ �� ������� ������ �������� ������������������ ������������ ������ (�����  �������� ������������������) �������� �� ���������� ���������:\n<ol>\n<li>�������������� ����� ��������-�������� (�����  ������������� �����)�. ��� �������� �������������� �������� ����������� ������������, � ��� ����������� ������ ���������� ������, �� ���� ����������� � (���) ��������� ����������� �� ���� ������������ ������. ��� ���������� ���� ������������ ��� ������ ����� ������������, ��� ���� �������������� ��������, ����� �������� ������ ���� ����������, ����� �������� (��������) ������ ������������� � ����������� ����������.</li>\n<li>������������� ������  ��������, ������� ������ ��� ��������� ��������� � ������������ ���� ������������� ����������� ���� (����� ����������� ��������� ������������ ������).</li>\n<li>���������� ������������ �������  ����� �������� (��������) ���� ������������ �������, ������� ������������� ���������� � ������������� �������. �� ����� ��������, ����������, �����������������, �����������, �������, �������� (��� ������������� ��������� ��� ��������), ���������, ������������, ���������� (��������������, �������������, ��������� � ��� ������), ������������, �����������, ������� � ���� ����������. ������ �������� (��������) ����� ����������� ��� �������������, ��� � �������.</li>\n<li>������������������� ������������ �������  ������������ ����������, ������������� � ��������� ��� ����� ����������� � ������� ������������ ������������ ����, ������� ���������� �������� � �����, �� �������� � ��� �����������, ���� �������������� ������������ ������ ������������ �� ������� ��� ��������, � ����� ����������� �������� ��������� ��� �����������.</li>\n<li>������������� ����� ��������-�������� (�����  ������������)�  �������, ���������� ���� ��������-��������, � ����� ������������ ��� ����������� � ����������.</li>\n<li>�Cookies�  �������� �������� ������, ������������ ���-��������� ��� ���-�������� ���-������� � HTTP-�������, ������ ���, ����� ������������ �������� ������� �������� ��������-��������. �������� �������� �� ���������� ������������.</li>\n<li>�IP-�����  ���������� ������� ����� ���� � ������������ ����, ����������� �� ��������� TCP/IP.</li>\n</ol>\n</li>\n</ol>\n</li>\n<li>����� ���������\n<ol>\n<li>�������� ����� ��������-��������, � ����� ������������� ��� �������� � ��������� ������������� �������������� �������� � �������� ��� ��������� ������������������, ��������������� �������������� ������������� ������������ ������ �� ���������.</li>\n<li>���� ������������ �� ��������� ������������ �������� ������������������, ������������ ������ �������� ��������-�������.</li>\n<li>��������� �������� ������������������ ���������������� ������ �� ���� ��������-��������. ���� �� �������, ����������� �� ����� ����������, ������������ ����� �� ������� ������� ���, ��������-������� �� ��� �������� ��������������� �� ����.</li>\n<li>�������� ������������� ������������ ������, ������� ����� �������� ��������� �������� ������������������ ������������, �� ������ � ����������� ������������� �����.</li>\n</ol>\n</li>\n<li>������� �������� ������������������\n<ol>\n<li>�������� ���������� � ������� ������ �������� ������������������ ������������� ��������-�������� ������� �� ���������� ������������ ������, ���������� ��������������, ����������������� �� ����� ��� ������������ ����� �� ������� ������, � ����� ������������ ���� ������ ���������� ������������������.</li>\n<li>����� �������� ������������ ������, ������������ ��������� ������������� �� ����� ��������-�������� ����������� �����. ������������� ������� ������������, ������� �������� ���������, ��������:\n<ol>\n<li>��� �������, ���, ��������;</li>\n<li>��� ���������� �������;</li>\n<li>��� ����������� ����� (e-mail);</li>\n<li>�����, �� �������� ������ ���� ��������� ��������� �� �����;</li>\n<li>����� ���������� ������������.</li>\n</ol>\n</li>\n<li>������ ������, ������������� ������������ ��� ��������� ��������� ������ � ��������� ������� � �������������� �� ��� ��������������� ��������� ������� (���������) �������������� ��������-���������. ��� �������� ���� ������:<br />IP-�����;<br />�������� �� cookies;<br />�������� � �������� (���� ������ ���������, ����� ������� ���������� �������� ����� �������);<br />����� ��������� �����;<br />����� ��������, �� ������� ������������� ��������� ����;<br />������� (����� ���������� ��������).</li>\n<li>������������ ���������� cookies ����� ����� ������������� ������� � ��������� ����������� ������ ����� ��������-��������.</li>\n<li>��������-������� �������� ���������� �� IP-������� ���� �����������. ������ �������� �����, ����� ������� � ������ ����������� �������� � �����������������, ��������� �������� ����� ���������� ���������� ��������.</li>\n<li>����� ������ ������������ ���� ������������ �������� (� ���, ����� � ����� ������� ���� �������, ����� ��� ���� ������������� �������, ����� ���� ����������� ������������ ������� � ��.) ������ �������� � �� ����������������. ���������� ������������ �������� ������������������ ��������������� ��� �������, ��������� � �.�. 5.2 � 5.3.</li>\n</ol>\n</li>\n<li>���� ����� ������������ ���������� ������������\n<ol>\n<li>���� ������������ ������ ������������ �������������� ��������-�������� ���������� ���� ����, �����:\n<ol>\n<li>���������������� ������������, ������� ������ ��������� ����������� �� ����� ��������-��������, ����� �������� ����� � (���) ���������� ����� ������� �������� ������������.</li>\n<li>������� ������������ ������ � ������������������� �������� ������� �����.</li>\n<li>���������� � ������������� �������� �����, ��� ������� ���������������, � ���������, �������� �������� � �����������, ���������� ������������� ����� ��������-��������, ��������� ���������������� �������� � ������, �������� ������ �����.</li>\n<li>���������� ��������������� ������������, ����� ���������� ������������ �������� � ������������� �������������.</li>\n<li>�����������, ��� ������, ������� ����������� ������������, ����� � ����������.</li>\n<li>������� ������� ������ ��� ���������� �������, ���� ������������ ������� �� �� ��� �������.</li>\n<li>��������� ������������ � ��������� ��� ������ � ��������-��������.</li>\n<li>������������ � �������� �������, ������������ ����� ��� ��������� ������, ���������� �����, ����������, ������������� �� ������������ ����������� ������������ ��������� �����.</li>\n<li>���������� ������������ ����������� ������� ������� �������, ������������� ��� ������������� ��������-��������, �� ���� ����������� ���������� � ����������� ���������.</li>\n<li>������������ ������������� ������������ �� ���������� ���������, ����������� ��� � ����������� �������������, ������ ��������, ��������� � ������������ ��������-�������� ��� ��� �������� � ������� ����������, ���� ������������ ������� �� �� ��� ��������.</li>\n<li>������������� ������ ��������-��������, ���� ������������ ������� �� �� ��� ��������.</li>\n<li>������������ ������������ ������ �� ����� ��� ������� ��������-��������, ������� ��� ��� ����� �������� ��������, ���������� � ������.</li>\n</ol>\n</li>\n</ol>\n</li>\n<li>������� � ����� ��������� ������������ ����������\n<ol>\n<li>���� ��������� ������������ ������ ������������ ����� �� ���������. ��������� ��������� ����� ����������� ����� ��������������� ����������������� ��������. � ���������, � ������� ��������������������������������� ������, ������� ����� ������� ������������� ���� ��� ������� �������������.</li>\n<li>������������ �������������� ����� ������������ ������ ������������ ����� ������������ ������� �����, � ����� ������� ������ ���������� ������, ����������� �������� �����, ��������� ������������. �������� ��� ��� ����, ����� ��������� ����� ������������, ����������� �� �� ����� ��������-��������, � ��������� ����� �� ������. �������� ������������ �� �������� �������� ������������� ��������� �������� �����.</li>\n<li>����� ������������ �������������� ����� ������������ ������ ����� ������������ �������������� ������� ��������������� ������ ���������� ���������, ���� ��� �������������� �� �������� ���������� � � ��������������� ���������� ����������������� �������.</li>\n<li>���� ������������ ������ ����� �������� ��� ����������, ������������ ������������ �� ���� �������������� �����.</li>\n<li>��� �������� ������������� ����� ���������� �� ��, ����� �� ��������� � ������������ ������ ������������ ������� ��� (�� ����������� �.�. 5.2, 5.3). ��������� ��� ���������� �� ������ ���� �������� ���� ��������, ���� �� �� ���������� �, �� �������� � �� �����������, �� ���������� � �� ��������������, � ����� �� ��������� ������ ��������������� ��������. ��� ������ ���������������� ������ ������������� ����������� ���������� ��������������� � ����������� ���.</li>\n<li>���� ������������ ������ ����� �������� ���� ����������, ������������� ����� ��������� � ������������� ������ ������� ��� ��������� ����, ���� ������������� ������ � ������ ���������� �����������, ��������� ������ ���������.</li>\n</ol>\n</li>\n<li>������������� ������\n<ol>\n<li>� ����������� ������������ ������:\n<ol>\n<li>��������� ��������������� ����������� ��������-�������� �������� � ����.</li>\n<li>���������� � ���������� ��������������� �� �������� � ������ ��������� �������.</li>\n</ol>\n</li>\n<li>� ����������� ������������� ����� ������:\n<ol>\n<li>���������� ���������� �������� ������������� � �����, ������������ � �. 4 ������������ �������� ������������������.</li>\n<li>����������� ������������������ ����������� �� ������������ ��������. ��� �� ������ ������������, ���� ������������ �� ���� �� �� ���������� ����������. ����� ������������� �� ����� ����� ���������, ����������, ����������� ���� ���������� ������� ��������� ���������� ������������� ������������ ������, �������� �.�. 5.2 � 5.3 ������������ �������� ������������������.</li>\n<li>�������� ��� ����������������, ���� ������������ ������ ������������ ���������� ������ �����������������, ����� �����, ��� �������� ����������������� ������ ���� �������� � ����������� ������� �������.</li>\n<li>���������� ������������ ���������������� ������ � ���� �������, � �������� ������������ ���� ��� �������� ������������� ������� ��������������� ������. ����� ������� ������ �� ���������� ����� ��������������� ������, ��������������� �������� ����� ������������, ��������������� ������������� ����� ���� ������, �� ������ ��������, � ������ ����������� ��������������� ���������� ������������ ������ ���� ��������������� ��������.</li>\n</ol>\n</li>\n</ol>\n</li>\n<li>��������������� ������\n<ol>\n<li>� ������ ������������ �������������� ����� ����������� ������������ �, ��� ���������, ������� ������������, ��������� ��-�� �������������� ������������� ��������������� �� ����������, ��������������� ����������� �� ��. �� ����, � ���������, ���������� ���������� ����������������. ���������� ������������ � ��������� ����� �������� ������������������ ������ ��� �������, ��������� � �.�. 5.2, 5.3 � 7.2.</li>\n<li>�� ���������� ��� �������, ����� ������������� ����� ��������������� �� ����, ���� ���������������� ������ ������������ ��� ������������. ��� ���������� �����, ����� ���:\n<ol>\n<li>������������ � ��������� �������������� �� ����, ��� ���� �������� ��� ����������.</li>\n<li>���� ������������� �������� ������ �� ����, ��� �� �������� ������������� �����.</li>\n<li>������������ � �������� ������������.</li>\n</ol>\n</li>\n</ol>\n</li>\n<li>���������� ������\n<ol>\n<li>���� ������������ ��������� ���������� ������������� ��������-�������� � ������� ���������� ���� ����� � ����, �� ���� ��� ���������� � �����, �� � ������������ ������� ������ ���������� ��������� (��������� ���������� ������������� �������� �����������).</li>\n<li>���������� ��������� ������������� ������� � ������� 30 ����������� ���� � ���� � ��������� ��������� ��������� ������������ � � ������������ � �������� �����.</li>\n<li>���� ��� ������� ��� � �� ������ ������������, ���� ��������� � �������� �����, ��� ��� ������ ����������� �������� ������������ ����������� ����������������.</li>\n<li>������������� ��������� ������������ � ������������� ����� � �������� ������������������ ���������� �������� ������������ ����������� ����������������.</li>\n</ol>\n</li>\n<li>�������������� �������\n<ol>\n<li>������������� ����� ������ ������ ������������ �� ������� ������ �������� ������������������, �� ��������� �������� � ������������.</li>\n<li>���������� � ���� ����� �������� ������������������ ���������� ����� ����, ��� ���������� � ��� ����� �������� �� ���� ��������-��������, ���� ������������ �������� �� ������������� ����� �������� ����������.</li>\n<li>���� �����������, ���������, ���������� ��� ������� �� ��������� �������� ������������������ ������� �������� � ������ �������� �����, ������������� �� ������:�<strong>(������)</strong>. ��� ����� �������� ������������ ������ �� ������<strong>(��� ��� email)</strong></li>\n<li>��������� � ������������ �������� ������������������ �����, ����� �� �������� ��<strong>������ www.����� ��������.ru</strong></li>\n</ol>\n</li>\n</ol>', '', '1', '1574373600', '', '', '1', '0', '', '', '', '1');
INSERT INTO phpshop_page VALUES ('44', '�������� �� ��������� ������������ ������', 'soglasie_na_obrabotku_personalnyh_dannyh', '0', '', '', '<p>�������� �� ��������� ������������ ������</p>\r\n<p>��������� �, ����� &laquo;������� ������������ ������&raquo;, �� ���������� ���������� ������������ ������ �� 27.07.2006 �. 152-�� &laquo;� ������������ ������&raquo; (� ����������� � ������������) ��������, ����� ����� � � ����� �������� ��� ���� ��������&nbsp;<strong>�������������� ��������������� ������� ����� ���������</strong>&nbsp;(����� &laquo;��������-�������&raquo;, �����:&nbsp;<strong>(��� ��� �����)&nbsp;</strong>) �� ��������� ����� ������������ ������, ��������� ��� ����������� ����� ���������� ���-����� �� ����� ��������-��������&nbsp;<strong>��������.��</strong>&nbsp;� ��� ����������&nbsp;<strong>*.��������.��</strong>&nbsp;(����� ����), ������������ (�����������) � �������������� �����.</p>\r\n<p>��� ������������� ������� � ������� ����� ����������, ����������� �� ��� ��� � �������� ������������ ������, � ��� ����� ��� �������, ���, ��������, �����, �����������, ���������, ���������� ������ (�������, ����, ����������� �����, �������� �����), ����������,&nbsp; ���� ������ ����������. ��� ���������� ������������ ������ � ������� ����, ��������������, ����������, ���������, ����������, ���������, �������������, ���������������, ��������, � ��� ����� ��������������, �������������, ������������, �����������, ���������� ��������), � ����� ������ �������� (��������) � ������������� �������.</p>\r\n<p>��������� ������������ ������ �������� ������������ ������ �������������� ������������� � ����� ����������� �������� ������������ ������ � ���� ������ ��������-�������� � ����������� ������������ �������� ������������ ������ �������� ��������� � ���-�����������, � ��� ����� ���������� ����������, �� ��������-��������, ��� �������������� ��� �/��� ��������������, �������������� � ��������� ��������,&nbsp; ����������� �� ����������� ��������-�������� � ������ ���������� ��������-���������� ����������, � ����� � ����� ������������� �������� �������� ������������ ������ ��� ��������� ����������� ��������-��������.</p>\r\n<p>����� ������ �������� �� ��������� ������������ ������ �������� ������������ ������ �������� ���� �������� ��������������� ���-����� � ����� ��������-��������.</p>\r\n<p>��������� ������������ ������ �������� ������������ ������ ����� �������������� � ������� ������� ������������� �/��� ��� ������������� ������� ������������� � ������������ � ����������� ����������������� �� � ����������� ����������� ��������-��������.</p>\r\n<p>��������-������� ��������� ����������� ��������, ��������������� � ����������� ���� ��� ������������ �� �������� ��� ������ ������������ ������ �� �������������� ��� ���������� ������� � ���, �����������, ���������, ������������, �����������, ��������������, ��������������� ������������ ������, � ����� �� ���� ������������� �������� � ��������� ������������ ������, � ����� ��������� �� ���� ������������� ���������� ������������������ ������������ ������ �������� ������������ ������. ��������-������� ������ ���������� ��� ��������� ������������ ������ �������� ������������ ������ ��������������, � ����� ������ ���������� ������������ ������ ��� ��������� ����� �������������� �����, ����������� ��� ���� �������� ������ ��������������� � ��������������� ������ ��������������� ������������ � ����� ������������������ ������������ ������.</p>\r\n<p>� ����������(�), ���:</p>\r\n<ol>\r\n<li>��������� �������� �� ��������� ���� ������������ ������, ��������� ��� ����������� �� ����� ��������-��������, ������������ (�����������) � �������������� C����, ��������� � ������� 20 (��������) ��� � ������� ����������� �� C���� ��������-��������;</li>\r\n<li>�������� ����� ���� �������� ���� �� ��������� ����������� ��������� � ������������ �����;</li>\r\n<li>�������������� ������������ ������ ������� ��� ��� �� �������� ������ ��������������� � ������������ � ����������� ����������������� ���������� ���������.</li>\r\n</ol>', '', '3', '1574373600', '', '', '1', '0', '', '', '', '1');
INSERT INTO phpshop_page VALUES ('45', '��������', 'contacts', '0', '', '', '<div class="col-md-5 col-sm-5 col-xs-12">\r\n<ul class="contacts">\r\n<li class="flex-block"><span class="icons-map">&nbsp;</span><strong>��� �����: </strong> @streetAddress@</li>\r\n<li class="flex-block"><span class="icons-mail">&nbsp;</span><strong>�����: </strong> <a href="mailto:@adminMail@">@adminMail@</a></li>\r\n<li class="flex-block"><span class="icons-call">&nbsp;</span><strong>�������: </strong> <a href="tel:@telNumMobile@">@telNumMobile@</a></li>\r\n</ul>\r\n<ul class="contacts">\r\n<li><span class="icons-clock">&nbsp;</span><strong>�� ��������: </strong><br />\r\n<p>10:00 - 18:00 ���-��� <br /> ���� ���� - ��������</p>\r\n</li>\r\n</ul>\r\n<ul class="contacts">\r\n<li><span class="icons-location">&nbsp;</span><strong>��� ��� �����: </strong><br />\r\n<p>����� &laquo;����� �����������&raquo;, ������ ����� �� ������. ����� ���������� ������ ����� ������� �� ����� �����������. �� ����� ����������� � ������� ������� 10 ����� ������ �� ������ � ������� �������� �� ������ ����� &laquo;���� &laquo;������&raquo;. ���� �� ������� �����. ����� ������� �� ���������� ���������, ����� ��� ��������� � �����.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class="col-md-7 col-sm-7 col-xs-12">@sticker_map@</div>', '', '1', '1557784800', '', '', '1', '0', '', '', '', '0');
INSERT INTO phpshop_page VALUES ('58', '���� ������', 'vasha_statya', '19', '', '', '<p><em>��� ������ ���-���� - ��������. ����� �� ������ �������� ������ ��� ����� ����.&nbsp; �� ������ ����������� ������������� ������ � �������� �������������, ��� ������� ������������� � ������. �������� ������� ���� ����� (� ������), ���� �� ��������� ����� ������� ���� � ������� � �������� ��������.</em></p>\r\n<p><img src="/UserFiles/Image/Trial/img33_66960s.png" alt="" width="300" height="300" /></p>\r\n<p class="text-justify">� ������ ������� ����� � ����� �������� ������ ������ ������ ���� � ������������ ��������������� ������� �����������. �� �������, ������ ��������, ��� ���������� �������� ��������� ���� ������������ ������������ �������� ����� (������������) ������� � ������������ ������������ ���������� � ���������������� �������. � ������ ������� ����� � ����� �������� ������ � ������������ ������� ������������� �������� ����������� �������������� ��������.</p>\r\n<p class="text-justify">������������� � ������� ���� ������������ � ������� ������� ������� ����������� � ��������� ������ ��������. ������������� � ������� ���� ������������ � ������� ������� ������������ ���������� � ���������� ������������ ���������� � ���������������� �������. ������ ������� ������ ������������ ������ �� ������������ ������� ������� ����������� � ��������� ������������ ���������� � ���������������� �������. ������� ����������� ������� �������, � ����� ����� ������ ��������������� ������������ ������������ �������� ����� (������������) ������� � ������������ ������������ ���������� � ���������������� �������. ������ �����������, � ����������� �� ����� � ����� �������� ������ ������ ������ ���� � ������������ ����� �����������.</p>\r\n<p class="text-justify">� ������ ������� ����������� ��������� ����������� ��������� ��������� ������ ������� �� ���������� �������, ���������� ����������� � ��������� ������������ �����. ��������! ���������� �������������� ���� � ����� ����� ���������� ��������� ������� �������� ������ ��������� �������. ������ ������� ���������� �������������-���������������� ����������� ����� ������������ ��������� ������� �������� ����� �����������.</p>\r\n<p class="text-justify">�� �������, ������ ��������, ��� ���������� �������������� ���� � ����� ����� ���������� ������������ ���������� � ���������� �������, ���������� ����������� � ��������� ������������ �����. ������ ������� ���������� �������������-���������������� ����������� ����� ������������ ������� ����������� � ��������� �������, ���������� ����������� � ��������� ������������ �����. ������ �����������, � ����������� �� ���������� �������������� ���� � ����� ����� ���������� ������ ������ ���� � ������������ ��������������� ������� �����������. ��������! ����� � ����� �������� ������ � ������������ ������� ������������� �������� ����������� �������������� ��������. ������ �����������, � ����������� �� ���������� �������������� ���� � ����� ����� ���������� ������������ �������� ����� (������������) ������� � ������������ ���� ��������. ������������ �������� ����������, ��� ����� � ����� �������� ������ ������ ������ ���� � ������������ ������ ��������.</p>\r\n<p class="text-justify">� ������ ������� ���������� � �������� ��������� ������������ ����� ���������� ����������� �������� �������, ���������� ����������� � ��������� ������������ �����. ������ �����������, � ����������� �� ����� ������ ��������������� ������������ ������� �� ��� ������� ��������������� ������� �����������. ��������! ���������� ���������� �������� ������� ������������ ���������� � ���������� �������, ���������� ����������� � ��������� ������������ �����. ������ �����������, � ����������� �� ���������� �������������� ���� � ����� ����� ���������� ������� ����������� � ��������� ���� ��������.</p>\r\n<p class="text-justify">� ������ ������� ������������ � ������� ������� ������������ ����� ���������� ����������� �������� ��������������� ������� �����������. ������ ������� ����������� ��������� ����������� ������� �� ��� ������� ������� �������� ������, ������������� �������� ������������. ������ ������� ���������� �������� ��������� ���� ������������ ������� ����������� � ��������� ����� �����������. ������ �����������, � ����������� �� ����������� ��������� ����������� ������� ����������� � ��������� �������, ���������� ����������� � ��������� ������������ �����. ������������� � ������� ���� ���������� �������������� ���� � ����� ����� ���������� ������� �� ��� ������� ��������������� ������� �����������. �� �������, ������ ��������, ��� ���������� � �������� ��������� � ������������ ������� ������������� �������� ����� �����������.</p>', '', '1', '1574460000', '11,1,2,3', '', '1', '0', '', '/UserFiles/Image/Trial/img32_33694s.jpg', '<p class="text-justify">� ������ ������� ����� � ����� �������� ������ ������ ������ ���� � ������������ ��������������� ������� �����������. �� �������, ������ ��������, ��� ���������� �������� ��������� ���� ������������ ������������ �������� ����� (������������) ������� � ������������ ������������ ���������� � ���������������� �������. � ������ ������� ����� � ����� �������� ������ � ������������ ������� ������������� �������� ����������� �������������� ��������.</p>\r\n<p class="text-justify">&nbsp;</p>', '1');
INSERT INTO phpshop_page VALUES ('59', '���������� �����-�����', 'sozdavayte_promo-akcii', '19', '', '', '<p><em>�� ������ ��������� �����-�����, ������ ������ �� ������ � ������� ��������� - ����������.</em></p>\r\n<p class="text-justify">� ������ ������� ����� � ����� �������� ������ ������ ������ ���� � ������������ ��������������� ������� �����������. �� �������, ������ ��������, ��� ���������� �������� ��������� ���� ������������ ������������ �������� ����� (������������) ������� � ������������ ������������ ���������� � ���������������� �������. � ������ ������� ����� � ����� �������� ������ � ������������ ������� ������������� �������� ����������� �������������� ��������.</p>\r\n<p class="text-justify">������������� � ������� ���� ������������ � ������� ������� ������� ����������� � ��������� ������ ��������. ������������� � ������� ���� ������������ � ������� ������� ������������ ���������� � ���������� ������������ ���������� � ���������������� �������. ������ ������� ������ ������������ ������ �� ������������ ������� ������� ����������� � ��������� ������������ ���������� � ���������������� �������. ������� ����������� ������� �������, � ����� ����� ������ ��������������� ������������ ������������ �������� ����� (������������) ������� � ������������ ������������ ���������� � ���������������� �������. ������ �����������, � ����������� �� ����� � ����� �������� ������ ������ ������ ���� � ������������ ����� �����������.</p>\r\n<p class="text-justify">� ������ ������� ����������� ��������� ����������� ��������� ��������� ������ ������� �� ���������� �������, ���������� ����������� � ��������� ������������ �����. ��������! ���������� �������������� ���� � ����� ����� ���������� ��������� ������� �������� ������ ��������� �������. ������ ������� ���������� �������������-���������������� ����������� ����� ������������ ��������� ������� �������� ����� �����������.</p>\r\n<p class="text-justify">�� �������, ������ ��������, ��� ���������� �������������� ���� � ����� ����� ���������� ������������ ���������� � ���������� �������, ���������� ����������� � ��������� ������������ �����. ������ ������� ���������� �������������-���������������� ����������� ����� ������������ ������� ����������� � ��������� �������, ���������� ����������� � ��������� ������������ �����. ������ �����������, � ����������� �� ���������� �������������� ���� � ����� ����� ���������� ������ ������ ���� � ������������ ��������������� ������� �����������. ��������! ����� � ����� �������� ������ � ������������ ������� ������������� �������� ����������� �������������� ��������. ������ �����������, � ����������� �� ���������� �������������� ���� � ����� ����� ���������� ������������ �������� ����� (������������) ������� � ������������ ���� ��������. ������������ �������� ����������, ��� ����� � ����� �������� ������ ������ ������ ���� � ������������ ������ ��������.</p>\r\n<p class="text-justify">� ������ ������� ���������� � �������� ��������� ������������ ����� ���������� ����������� �������� �������, ���������� ����������� � ��������� ������������ �����. ������ �����������, � ����������� �� ����� ������ ��������������� ������������ ������� �� ��� ������� ��������������� ������� �����������. ��������! ���������� ���������� �������� ������� ������������ ���������� � ���������� �������, ���������� ����������� � ��������� ������������ �����. ������ �����������, � ����������� �� ���������� �������������� ���� � ����� ����� ���������� ������� ����������� � ��������� ���� ��������.</p>\r\n<p class="text-justify">� ������ ������� ������������ � ������� ������� ������������ ����� ���������� ����������� �������� ��������������� ������� �����������. ������ ������� ����������� ��������� ����������� ������� �� ��� ������� ������� �������� ������, ������������� �������� ������������. ������ ������� ���������� �������� ��������� ���� ������������ ������� ����������� � ��������� ����� �����������. ������ �����������, � ����������� �� ����������� ��������� ����������� ������� ����������� � ��������� �������, ���������� ����������� � ��������� ������������ �����. ������������� � ������� ���� ���������� �������������� ���� � ����� ����� ���������� ������� �� ��� ������� ��������������� ������� �����������. �� �������, ������ ��������, ��� ���������� � �������� ��������� � ������������ ������� ������������� �������� ����� �����������.</p>', '', '1', '1574460000', '37,36,35', '', '1', '0', '', '/UserFiles/Image/Trial/img17_95275s.jpg', '<p class="text-justify">� ������ ������� ����� � ����� �������� ������ ������ ������ ���� � ������������ ��������������� ������� �����������. �� �������, ������ ��������, ��� ���������� �������� ��������� ���� ������������ ������������ �������� ����� (������������) ������� � ������������ ������������ ���������� � ���������������� �������. � ������ ������� ����� � ����� �������� ������ � ������������ ������� ������������� �������� ����������� �������������� ��������.</p>', '0');
DROP TABLE IF EXISTS phpshop_page_categories;
CREATE TABLE phpshop_page_categories (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `num` int(64) DEFAULT '1',
  `parent_to` int(11) DEFAULT '0',
  `content` text,
  `servers` varchar(64) DEFAULT '',
  `menu` enum('0','1') DEFAULT '0',
  `page_cat_seo_name` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `parent_to` (`parent_to`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_page_categories VALUES ('18', '������������ ���������', '1', '0', '', '', '0', 'organicheskaya-kosmetika');
INSERT INTO phpshop_page_categories VALUES ('19', '��������, �������!', '1', '0', '<p>��� ������ �������������� �������� ������. ���� ����� �������� ��������, ���� ��� �����. ������� ������ ����� ������� � ������� ���� �����, �������� ������� � �������� ��������.�</p>\n<p><iframe src="https://www.youtube.com/embed/HnEDodW4SCE" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>', '', '0', 'vnimanie-konkurs');
INSERT INTO phpshop_page_categories VALUES ('16', '������ ������', '1', '7', '<p>���������</p>', '', '0', 'primer-stati');
DROP TABLE IF EXISTS phpshop_parent_name;
CREATE TABLE phpshop_parent_name (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` enum('0','1') NOT NULL DEFAULT '1',
  `color` VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_parent_name VALUES ('1', '��������', '1','');
INSERT INTO phpshop_parent_name VALUES ('2', '���� �������', '1','');
INSERT INTO phpshop_parent_name VALUES ('4', '������', '1','');
INSERT INTO phpshop_parent_name VALUES ('5', '����', '1','');
INSERT INTO phpshop_parent_name VALUES ('6', '��������', '1','');
DROP TABLE IF EXISTS phpshop_payment;
CREATE TABLE phpshop_payment (
  `uid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `sum` float DEFAULT '0',
  `datas` int(11) DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `order` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_payment_systems;
CREATE TABLE phpshop_payment_systems (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `path` varchar(255) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '1',
  `num` tinyint(11) DEFAULT '0',
  `message` text,
  `message_header` text,
  `yur_data_flag` enum('0','1') DEFAULT '0',
  `icon` varchar(255) DEFAULT '',
  `color` varchar(64) DEFAULT '#000000',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_payment_systems VALUES ('1', '���������� �������', 'bank', '1', '4', '<h3>���������� ��� �� �����!</h3>\r\n<p>���� ��� �������� � �����&nbsp;<a href="/users/order.html">������ ��������</a>.&nbsp;</p>\r\n<p>������ ������� �� ������� �������� ��������� � ����� �����.</p>', '', '1', '/UserFiles/Image/Payments/beznal.png', '#000000');
INSERT INTO phpshop_payment_systems VALUES ('3', '�������� ������', 'message', '1', '0', '<h3>���������� ��� �� �����!</h3>\r\n<p>� ��������� ����� � ���� �������� ��� �������� ��� ��������� �������.</p>', '', '0', '/UserFiles/Image/Payments/nal.png', '#000000');
DROP TABLE IF EXISTS phpshop_photo;
CREATE TABLE phpshop_photo (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '0',
  `name` varchar(64) DEFAULT '',
  `num` tinyint(11) DEFAULT '0',
  `info` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `parent` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_photo_categories;
CREATE TABLE phpshop_photo_categories (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_to` int(11) DEFAULT '0',
  `link` varchar(64) DEFAULT '',
  `name` varchar(64) DEFAULT '',
  `num` tinyint(11) DEFAULT '0',
  `content` text,
  `enabled` enum('0','1') DEFAULT '0',
  `page` varchar(255) DEFAULT '',
  `multilanguages` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_products;
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
  `price_search` float DEFAULT '0',
  `parent2` text,
  `color` varchar(64) DEFAULT NULL,
  `productsgroup_check` enum('0','1') NOT NULL DEFAULT '0',
  `productsgroup_products` text NOT NULL,
  `vendor_code` varchar(255) DEFAULT '',
  `vendor_name` varchar(255) DEFAULT '',
  `productday` enum('0','1') DEFAULT '0',
  `hit` enum('0','1') DEFAULT '0',
  `option1` text,
  `option2` text,
  `option3` text,
  `option4` text,
  `option5` text,
  `prod_seo_name` varchar(255) DEFAULT '',
  `prod_seo_name_old` varchar(255) DEFAULT '',
  `manufacturer_warranty` enum('1','2') DEFAULT '2',
  `sales_notes` varchar(50) DEFAULT '',
  `country_of_origin` varchar(50) DEFAULT '',
  `adult` enum('1','2') DEFAULT '2',
  `delivery` enum('1','2') DEFAULT '1',
  `pickup` enum('1','2') DEFAULT '2',
  `store` enum('1','2') DEFAULT '2',
  `yandex_min_quantity` int(11) DEFAULT '0',
  `yandex_step_quantity` int(11) DEFAULT '0',
  `yandex_condition` enum('1','2','3') DEFAULT '1',
  `yandex_condition_reason` text,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `enabled` (`enabled`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;


INSERT INTO `phpshop_products` (`id`, `category`, `name`, `description`, `content`, `price`, `price_n`, `sklad`, `p_enabled`, `enabled`, `uid`, `spec`, `odnotip`, `vendor`, `vendor_array`, `yml`, `num`, `newtip`, `title`, `title_enabled`, `datas`, `page`, `user`, `descrip`, `descrip_enabled`, `title_shablon`, `descrip_shablon`, `keywords`, `keywords_enabled`, `keywords_shablon`, `pic_small`, `pic_big`, `yml_bid_array`, `parent_enabled`, `parent`, `items`, `weight`, `price2`, `price3`, `price4`, `price5`, `files`, `baseinputvaluta`, `ed_izm`, `dop_cat`, `rate`, `rate_count`, `price_search`, `parent2`, `color`, `productsgroup_check`, `productsgroup_products`, `vendor_code`, `vendor_name`, `productday`, `hit`, `option1`, `option2`, `option3`, `option4`, `option5`, `prod_seo_name`, `prod_seo_name_old`, `manufacturer_warranty`, `sales_notes`, `country_of_origin`, `adult`, `delivery`, `pickup`, `store`, `yandex_min_quantity`, `yandex_step_quantity`, `yandex_condition`, `yandex_condition_reason`) VALUES
(1, 26, '������ 1001 Dressyy', '<p>������, ����������, �� ��������� ��������. ������ ����� �������������� ������� ��� �����, ������� ������ ����� �� ����� ����������, �� ���������� ����. ��������� ���������� ������� �������� ��������� �� ����. ����� ���������, �� ������ ����� ����� ������.&nbsp;</p>', '<p>����� ������� �� ������: 142,0��.<br />����� ������� �� ����� �����: 120,0��.<br />������: �-������<br />������ ����: �����������<br />������ ����: ������<br />�������� �����: �����<br />�������� ����: �����<br />�������: ��������, �� ���� �� ����� �����<br />��� � ������������ ��������: ������ �� ������<br />��� � ������������ ������� � ������������ ���������: ���</p>', 1200, 1350, '0', '1', '1', '3343460', '1', '25,26,24', 'i5-13ii3-6ii4-7ii2-1i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223133223b7d693a333b613a313a7b693a303b733a313a2236223b7d693a343b613a313a7b693a303b733a313a2237223b7d693a323b613a313a7b693a303b733a313a2231223b7d7d, '1', 0, '1', '', '0', 1574938130, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img1_69884s.jpg', '/UserFiles/Image/Trial/img1_69884.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '65,64,63,62', 11, 200, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '1', '<p>&nbsp;</p>\r\n<table width="100%" align="center">\r\n<thead>\r\n<tr class="tr_head">\r\n<td style="width: 20%;">\r\n<div>���������� ������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �������������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>����, ��</div>\r\n</td>\r\n</tr>\r\n</thead>\r\n</table>\r\n<div>\r\n<div style="height: auto; margin-bottom: 0px; margin-right: 0px;">\r\n<table width="100%" align="center">\r\n<tbody>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>24</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-62</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40/42-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>25</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42/44-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>27</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42-170</div>\r\n</td>\r\n<td>\r\n<div>26</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44/46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>29</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44-170</div>\r\n</td>\r\n<td>\r\n<div>28</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46/48-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>31</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>30</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>48-170</div>\r\n</td>\r\n<td>\r\n<div>32</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>74-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>102-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><small>������ � �������� ������&nbsp;<strong>������� ��������</strong> ������������� � ���� ������ - �������: <strong>��������� ������, � ������� ��������.</strong> ���������� <strong>������������ ����</strong> ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>\r\n</div>\r\n</div>', '<p><small>������ <strong>���������� � ��������</strong> ������������� � ���� ������ - �������: ��������� ������, � ������� ��������. ���������� ������������ ���� ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>', NULL, NULL, NULL, 'dzhinsy-1001-dressyy', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(2, 26, '������ Befreedom', '<p>������, ����������, �� ��������� ��������.&nbsp; ����� ���������, �� ������ ����� ����� ������. ���������� ���������� ����� ������.</p>', '<p>����� ������� �� ������: 142,0��.<br />����� ������� �� ����� �����: 120,0��.<br />������: �-������<br />������ ����: �����������<br />������ ����: ������<br />�������� �����: �����<br />�������� ����: �����<br />�������: ��������, �� ���� �� ����� �����<br />��� � ������������ ��������: ������ �� ������<br />��� � ������������ ������� � ������������ ���������: ���</p>', 2000, 2500, '0', '1', '1', '234246246', '1', '18,17,16', 'i5-14ii3-5ii4-7ii2-1i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223134223b7d693a333b613a313a7b693a303b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2237223b7d693a323b613a313a7b693a303b733a313a2231223b7d7d, '1', 0, '1', '', '0', 1574938122, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img2_44763s.jpg', '/UserFiles/Image/Trial/img2_44763.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '70,69,68,67,66', 46, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '<p>&nbsp;</p>\r\n<table width="100%" align="center">\r\n<thead>\r\n<tr class="tr_head">\r\n<td style="width: 20%;">\r\n<div>���������� ������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �������������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>����, ��</div>\r\n</td>\r\n</tr>\r\n</thead>\r\n</table>\r\n<div>\r\n<div style="height: auto; margin-bottom: 0px; margin-right: 0px;">\r\n<table width="100%" align="center">\r\n<tbody>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>24</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-62</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40/42-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>25</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42/44-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>27</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42-170</div>\r\n</td>\r\n<td>\r\n<div>26</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44/46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>29</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44-170</div>\r\n</td>\r\n<td>\r\n<div>28</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46/48-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>31</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>30</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>48-170</div>\r\n</td>\r\n<td>\r\n<div>32</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>74-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>102-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><small>������ � �������� ������&nbsp;<strong>������� ��������</strong> ������������� � ���� ������ - �������: <strong>��������� ������, � ������� ��������.</strong> ���������� <strong>������������ ����</strong> ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>\r\n</div>\r\n</div>', '<p><small>������ <strong>���������� � ��������</strong> ������������� � ���� ������ - �������: ��������� ������, � ������� ��������. ���������� ������������ ���� ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>', NULL, NULL, NULL, 'dzhinsy-befreedom', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(3, 26, '������ Concepted Clubs', '<p>������, ����������, �� ��������� ��������. ������ ����� �������������� ������� ��� �����, ������� ������ ����� �� ����� ����������, �� ���������� ����. ��������� ���������� ������� �������� ��������� �� ����.&nbsp;</p>', '<p>����� ������� �� ������: 142,0��.<br />����� ������� �� ����� �����: 120,0��.<br />������: �-������<br />������ ����: �����������<br />������ ����: ������<br />�������� �����: �����<br />�������� ����: �����<br />�������: ��������, �� ���� �� ����� �����<br />��� � ������������ ��������: ������ �� ������<br />��� � ������������ ������� � ������������ ���������: ���</p>', 3500, 4000, '0', '1', '1', '', '0', '23,25,24', 'i5-15ii3-4ii4-7ii2-1i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223135223b7d693a333b613a313a7b693a303b733a313a2234223b7d693a343b613a313a7b693a303b733a313a2237223b7d693a323b613a313a7b693a303b733a313a2231223b7d7d, '1', 0, '1', '', '0', 1574938116, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img3_29892s.jpg', '/UserFiles/Image/Trial/img3_29892.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '76,75,74,73,72,71', 23, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '<p>&nbsp;</p>\r\n<table width="100%" align="center">\r\n<thead>\r\n<tr class="tr_head">\r\n<td style="width: 20%;">\r\n<div>���������� ������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �������������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>����, ��</div>\r\n</td>\r\n</tr>\r\n</thead>\r\n</table>\r\n<div>\r\n<div style="height: auto; margin-bottom: 0px; margin-right: 0px;">\r\n<table width="100%" align="center">\r\n<tbody>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>24</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-62</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40/42-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>25</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42/44-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>27</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42-170</div>\r\n</td>\r\n<td>\r\n<div>26</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44/46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>29</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44-170</div>\r\n</td>\r\n<td>\r\n<div>28</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46/48-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>31</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>30</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>48-170</div>\r\n</td>\r\n<td>\r\n<div>32</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>74-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>102-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><small>������ � �������� ������&nbsp;<strong>������� ��������</strong> ������������� � ���� ������ - �������: <strong>��������� ������, � ������� ��������.</strong> ���������� <strong>������������ ����</strong> ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>\r\n</div>\r\n</div>', '<p><small>������ <strong>���������� � ��������</strong> ������������� � ���� ������ - �������: ��������� ������, � ������� ��������. ���������� ������������ ���� ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>', NULL, NULL, NULL, 'dzhinsy-concepted-clubs', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(4, 27, '������ Modizy', '<p>�������, �������� ������, ������� �������� ��� ��������� ������ � ������. ������ ������������ � ������������ ���� � ������������ �������� ����������.</p>', '<p>�������� �������� ��� �������� ������������� � ����������� ������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������, �������� ������, ������� �������� ��� ��������� ������ � ������. ������ ������������ � ������������ ���� � ������������ �������� ����������.</p>', 5600, 6000, '0', '1', '1', '98769786', '0', '25,26', 'i5-19ii3-5ii4-8ii2-2i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223139223b7d693a333b613a313a7b693a303b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2238223b7d693a323b613a313a7b693a303b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574937807, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img4_31272s.jpg', '/UserFiles/Image/Trial/img4_31272.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '108,107,106', 78, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'dzhinsy-modizy', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(5, 26, '����� Oodjim Ultra', '<p>������, ����������, �� ��������� ��������. ������ ����� �������������� ������� ��� �����, ������� ������ ����� �� ����� ����������, �� ���������� ����. ���������� ���������� ����� ������.</p>', '<p>&nbsp;����� ������� �� ������: 142,0��.<br />����� ������� �� ����� �����: 120,0��.<br />������: �-������<br />������ ����: �����������<br />������ ����: ������<br />�������� �����: �����<br />�������� ����: �����<br />�������: ��������, �� ���� �� ����� �����<br />��� � ������������ ��������: ������ �� ������<br />��� � ������������ ������� � ������������ ���������: ���</p>', 3590, 0, '0', '1', '1', '345345', '0', '11,1,2', 'i5-12ii3-4ii4-7ii2-1i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223132223b7d693a333b613a313a7b693a303b733a313a2234223b7d693a343b613a313a7b693a303b733a313a2237223b7d693a323b613a313a7b693a303b733a313a2231223b7d7d, '1', 0, '1', '', '0', 1574938144, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img5_43616s.jpg', '/UserFiles/Image/Trial/img5_43616.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '61,60,59', 18, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '<p>&nbsp;</p>\r\n<table width="100%" align="center">\r\n<thead>\r\n<tr class="tr_head">\r\n<td style="width: 20%;">\r\n<div>���������� ������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �������������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>����, ��</div>\r\n</td>\r\n</tr>\r\n</thead>\r\n</table>\r\n<div>\r\n<div style="height: auto; margin-bottom: 0px; margin-right: 0px;">\r\n<table width="100%" align="center">\r\n<tbody>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>24</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-62</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40/42-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>25</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42/44-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>27</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42-170</div>\r\n</td>\r\n<td>\r\n<div>26</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44/46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>29</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44-170</div>\r\n</td>\r\n<td>\r\n<div>28</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46/48-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>31</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>30</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>48-170</div>\r\n</td>\r\n<td>\r\n<div>32</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>74-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>102-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><small>������ � �������� ������&nbsp;<strong>������� ��������</strong> ������������� � ���� ������ - �������: <strong>��������� ������, � ������� ��������.</strong> ���������� <strong>������������ ����</strong> ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>\r\n</div>\r\n</div>', '<p><small>������ <strong>���������� � ��������</strong> ������������� � ���� ������ - �������: ��������� ������, � ������� ��������. ���������� ������������ ���� ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>', NULL, NULL, NULL, 'bruki-oodjim-ultra', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(59, 26, '����� Oodjim Ultra 37 ', NULL, NULL, 3590, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574844717, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(6, 27, '����� ������� Oliverty', '<p>�������� �������� ��� �������� ������������� � ����������� ������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������.&nbsp;</p>', '<p>�������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������, �������� ������, ������� �������� ��� ��������� ������ � ������. ������ ������������ � ������������ ���� � ������������ �������� ����������.</p>', 3000, 3700, '0', '1', '1', '8765865', '0', '20,4,21,8', 'i5-18ii3-5ii4-8ii2-2i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223138223b7d693a333b613a313a7b693a303b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2238223b7d693a323b613a313a7b693a303b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574937794, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img6_51944s.jpg', '/UserFiles/Image/Trial/img6_51944.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '105,104,103,102', 100, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'bruki-muzhskie-oliverty', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(7, 27, '������� Oliverty', '<p>������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������.&nbsp;</p>', '<p>������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������, �������� ������, ������� �������� ��� ��������� ������ � ������. ������ ������������ � ������������ ���� � ������������ �������� ����������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. �������� ������������� � ����������� ������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������.&nbsp;</p>', 2500, 3000, '0', '1', '1', '', '0', '23,25', 'i5-nullii3-nullii4-nullii2-nulli', 0x4e3b, '1', 0, '1', '', '0', 1574937873, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img7_34107s.jpg', '/UserFiles/Image/Trial/img7_34107.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '124,123,122', 3, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'rubashka-oliverty', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(8, 27, '������� KUSTANG', '<p>������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������.</p>', '<p>������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������, �������� ������, ������� �������� ��� ��������� ������ � ������. ������ ������������ � ������������ ���� � ������������ �������� ����������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������.&nbsp;</p>', 6000, 0, '0', '1', '1', '9809876', '0', '23,25', 'i5-20ii3-5ii3-4ii4-8ii2-2i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223230223b7d693a333b613a323a7b693a303b733a313a2235223b693a313b733a313a2234223b7d693a343b613a313a7b693a303b733a313a2238223b7d693a323b613a313a7b693a303b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574937859, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img8_54208s.jpg', '/UserFiles/Image/Trial/img8_54208.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '121,120,119', 88, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'rubashka-kustang', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(9, 26, '�������� Springfold', '<p>������ ����� �������������� ������� ��� �����, ������� ������ ����� �� ����� ����������, �� ���������� ����. ��������� ���������� ������� �������� ��������� �� ����. ����� ���������, �� ������ ����� ����� ������. ���������� ���������� ����� ������.</p>', '<p>����� ������� �� ������: 142,0��.<br />����� ������� �� ����� �����: 120,0��.<br />������: �-������<br />������ ����: �����������<br />������ ����: ������<br />�������� �����: �����<br />�������� ����: �����<br />�������: ��������, �� ���� �� ����� �����<br />��� � ������������ ��������: ������ �� ������<br />��� � ������������ ������� � ������������ ���������: ���</p>', 800, 0, '0', '1', '1', '0980987', '1', '19,18,17,16', 'i5-16ii3-5ii3-4ii4-7ii2-3ii2-2i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223136223b7d693a333b613a323a7b693a303b733a313a2235223b693a313b733a313a2234223b7d693a343b613a313a7b693a303b733a313a2237223b7d693a323b613a323a7b693a303b733a313a2233223b693a313b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574938082, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img9_38664s.jpg', '/UserFiles/Image/Trial/img9_38664.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '93,92,91', 9, 120, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '1', '<p>&nbsp;</p>\r\n<table width="100%" align="center">\r\n<thead>\r\n<tr class="tr_head">\r\n<td style="width: 20%;">\r\n<div>���������� ������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �������������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>����, ��</div>\r\n</td>\r\n</tr>\r\n</thead>\r\n</table>\r\n<div>\r\n<div style="height: auto; margin-bottom: 0px; margin-right: 0px;">\r\n<table width="100%" align="center">\r\n<tbody>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>24</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-62</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40/42-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>25</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42/44-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>27</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42-170</div>\r\n</td>\r\n<td>\r\n<div>26</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44/46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>29</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44-170</div>\r\n</td>\r\n<td>\r\n<div>28</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46/48-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>31</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>30</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>48-170</div>\r\n</td>\r\n<td>\r\n<div>32</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>74-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>102-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><small>������ � �������� ������&nbsp;<strong>������� ��������</strong> ������������� � ���� ������ - �������: <strong>��������� ������, � ������� ��������.</strong> ���������� <strong>������������ ����</strong> ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>\r\n</div>\r\n</div>', '<p><small>������ <strong>���������� � ��������</strong> ������������� � ���� ������ - �������: ��������� ������, � ������� ��������. ���������� ������������ ���� ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>', NULL, NULL, NULL, 'futbolka-springfold', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(10, 26, '�������� Mangoff', '<p>������, ����������, �� ��������� ��������. ����� ���������, �� ������ ����� ����� ������. ���������� ���������� ����� ������.</p>', '<p>����� ������� �� ������: 142,0��.<br />����� ������� �� ����� �����: 120,0��.<br />������: �-������<br />������ ����: �����������<br />������ ����: ������<br />�������� �����: �����<br />�������� ����: �����<br />�������: ��������, �� ���� �� ����� �����<br />��� � ������������ ��������: ������ �� ������<br />��� � ������������ ������� � ������������ ���������: ���</p>', 800, 0, '0', '1', '1', '455657', '1', '5,1,2,3', 'i5-11ii3-5ii3-4ii4-7ii2-3ii2-2i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223131223b7d693a333b613a323a7b693a303b733a313a2235223b693a313b733a313a2234223b7d693a343b613a313a7b693a303b733a313a2237223b7d693a323b613a323a7b693a303b733a313a2233223b693a313b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574938095, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img10_90450s.jpg', '/UserFiles/Image/Trial/img10_90450.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '90,89,88,87,86', 30, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '1', '<p>&nbsp;</p>\r\n<table width="100%" align="center">\r\n<thead>\r\n<tr class="tr_head">\r\n<td style="width: 20%;">\r\n<div>���������� ������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �������������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>����, ��</div>\r\n</td>\r\n</tr>\r\n</thead>\r\n</table>\r\n<div>\r\n<div style="height: auto; margin-bottom: 0px; margin-right: 0px;">\r\n<table width="100%" align="center">\r\n<tbody>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>24</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-62</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40/42-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>25</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42/44-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>27</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42-170</div>\r\n</td>\r\n<td>\r\n<div>26</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44/46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>29</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44-170</div>\r\n</td>\r\n<td>\r\n<div>28</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46/48-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>31</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>30</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>48-170</div>\r\n</td>\r\n<td>\r\n<div>32</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>74-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>102-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<p><small>������ <strong>������� ��������</strong> ������������� � ���� ������ - �������: ��������� ������, � ������� ��������. ���������� ������������ ���� ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 �&nbsp;<small>productoption2.</small></small></p>\r\n</div>\r\n</div>', '<p><small>������ <strong>���������� � ��������</strong> ������������� � ���� ������ - �������: ��������� ������, � ������� ��������. ���������� ������������ ���� ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>', NULL, NULL, NULL, 'futbolka-mangoff', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL);
INSERT INTO `phpshop_products` (`id`, `category`, `name`, `description`, `content`, `price`, `price_n`, `sklad`, `p_enabled`, `enabled`, `uid`, `spec`, `odnotip`, `vendor`, `vendor_array`, `yml`, `num`, `newtip`, `title`, `title_enabled`, `datas`, `page`, `user`, `descrip`, `descrip_enabled`, `title_shablon`, `descrip_shablon`, `keywords`, `keywords_enabled`, `keywords_shablon`, `pic_small`, `pic_big`, `yml_bid_array`, `parent_enabled`, `parent`, `items`, `weight`, `price2`, `price3`, `price4`, `price5`, `files`, `baseinputvaluta`, `ed_izm`, `dop_cat`, `rate`, `rate_count`, `price_search`, `parent2`, `color`, `productsgroup_check`, `productsgroup_products`, `vendor_code`, `vendor_name`, `productday`, `hit`, `option1`, `option2`, `option3`, `option4`, `option5`, `prod_seo_name`, `prod_seo_name_old`, `manufacturer_warranty`, `sales_notes`, `country_of_origin`, `adult`, `delivery`, `pickup`, `store`, `yandex_min_quantity`, `yandex_step_quantity`, `yandex_condition`, `yandex_condition_reason`) VALUES
(11, 26, '����� Mangoff', '<p>���������� ������� � ��������� ������ ������. �������� ������ ������ ���� ������������ ����� ������� � ������� ������� �� ����. ������������ ���� ��������� ��������� ����� ������ �����. �������� �������� ����� ������� ������������ ������������� � �����. �������� ���������������� ��������� ��� �������� � ��������� � ������� ������.</p>', '<p>���������� ������� � ��������� ������ ������. �������� ������ ������ ���� ������������ ����� ������� � ������� ������� �� ����. ������������ ���� ��������� ��������� ����� ������ �����. �������� �������� ����� ������� ������������ ������������� � �����. �������� ���������������� ��������� ��� �������� � ��������� � ������� ������.&nbsp;���������� ������� � ��������� ������ ������. �������� ������ ������ ���� ������������ ����� ������� � ������� ������� �� ����. ������������ ���� ��������� ��������� ����� ������ �����. �������� �������� ����� ������� ������������ ������������� � �����. �������� ���������������� ��������� ��� �������� � ��������� � ������� ������.</p>', 4500, 0, '0', '1', '1', '098099', '0', '21,30,8', 'i5-11ii3-5ii4-7ii2-3i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223131223b7d693a333b613a313a7b693a303b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2237223b7d693a323b613a313a7b693a303b733a313a2233223b7d7d, '1', 0, '1', '', '0', 1574937974, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img11_84557s.jpg', '/UserFiles/Image/Trial/img11_84557.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '58,57,56,55,54,53', 21, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '<p>&nbsp;</p>\r\n<table width="100%" align="center">\r\n<thead>\r\n<tr class="tr_head">\r\n<td style="width: 20%;">\r\n<div>���������� ������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �������������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>����, ��</div>\r\n</td>\r\n</tr>\r\n</thead>\r\n</table>\r\n<div>\r\n<div style="height: auto; margin-bottom: 0px; margin-right: 0px;">\r\n<table width="100%" align="center">\r\n<tbody>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>24</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-62</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40/42-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>25</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42/44-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>27</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42-170</div>\r\n</td>\r\n<td>\r\n<div>26</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44/46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>29</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44-170</div>\r\n</td>\r\n<td>\r\n<div>28</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46/48-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>31</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>30</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>48-170</div>\r\n</td>\r\n<td>\r\n<div>32</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>74-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>102-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><small>������ � �������� ������&nbsp;<strong>������� ��������</strong> ������������� � ���� ������ - �������: <strong>��������� ������, � ������� ��������.</strong> ���������� <strong>������������ ����</strong> ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>\r\n</div>\r\n</div>', '<p><small>������ <strong>���������� � ��������</strong> ������������� � ���� ������ - �������: ��������� ������, � ������� ��������. ���������� ������������ ���� ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>', NULL, NULL, NULL, 'bruki-mangoff', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(56, 26, '����� Mangoff 38 �����', NULL, NULL, 4900, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574844276, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�����', '#ffffff', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(12, 26, '������� Springfold', '<p>������, ����������, �� ��������� ��������. ������ ����� �������������� ������� ��� �����, ������� ������ ����� �� ����� ����������, �� ���������� ����. ��������� ���������� ������� �������� ��������� �� ����. ����� ���������, �� ������ ����� ����� ������. ���������� ���������� ����� ������.</p>', '<p>����� ������� �� ������: 142,0��.<br />����� ������� �� ����� �����: 120,0��.<br />������: �-������<br />������ ����: �����������<br />������ ����: ������<br />�������� �����: �����<br />�������� ����: �����<br />�������: ��������, �� ���� �� ����� �����<br />��� � ������������ ��������: ������ �� ������<br />��� � ������������ ������� � ������������ ���������: ���</p>', 3800, 0, '0', '1', '1', '987-987', '1', '15,19,18', 'i5-16ii3-4ii4-7ii2-2i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223136223b7d693a333b613a313a7b693a303b733a313a2234223b7d693a343b613a313a7b693a303b733a313a2237223b7d693a323b613a313a7b693a303b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574938101, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img12_26952s.jpg', '/UserFiles/Image/Trial/img12_26952.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '85,84,83,82', 1, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '1', '<p>&nbsp;</p>\r\n<table width="100%" align="center">\r\n<thead>\r\n<tr class="tr_head">\r\n<td style="width: 20%;">\r\n<div>���������� ������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �������������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>����, ��</div>\r\n</td>\r\n</tr>\r\n</thead>\r\n</table>\r\n<div>\r\n<div style="height: auto; margin-bottom: 0px; margin-right: 0px;">\r\n<table width="100%" align="center">\r\n<tbody>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>24</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-62</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40/42-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>25</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42/44-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>27</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42-170</div>\r\n</td>\r\n<td>\r\n<div>26</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44/46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>29</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44-170</div>\r\n</td>\r\n<td>\r\n<div>28</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46/48-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>31</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>30</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>48-170</div>\r\n</td>\r\n<td>\r\n<div>32</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>74-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>102-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><small>������ � �������� ������&nbsp;<strong>������� ��������</strong> ������������� � ���� ������ - �������: <strong>��������� ������, � ������� ��������.</strong> ���������� <strong>������������ ����</strong> ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>\r\n</div>\r\n</div>', '<p><small>������ <strong>���������� � ��������</strong> ������������� � ���� ������ - �������: ��������� ������, � ������� ��������. ���������� ������������ ���� ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>', NULL, NULL, NULL, 'pulover-springfold', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(13, 26, '����� Oodjim', '<p>������, ����������, �� ��������� ��������. ������ ����� �������������� ������� ��� �����, ������� ������ ����� �� ����� ����������, �� ���������� ����. ��������� ���������� ������� �������� ��������� �� ����. ���������� ���������� ����� ������.</p>', '<p>������: ������<br />�������� �����: �����<br />�������� ����: �����<br />�������: ��������, �� ���� �� ����� �����<br />��� � ������������ ��������: ������ �� ������<br />��� � ������������ ������� � ������������ ���������: ���</p>', 600, 0, '0', '1', '1', '87686', '0', '6,4,21,30', 'i5-12ii3-4ii4-7ii2-2i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223132223b7d693a333b613a313a7b693a303b733a313a2234223b7d693a343b613a313a7b693a303b733a313a2237223b7d693a323b613a313a7b693a303b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574938109, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img13_59800s.jpg', '/UserFiles/Image/Trial/img13_59800.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '81,79,78,77', 20, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '<p>&nbsp;</p>\r\n<table width="100%" align="center">\r\n<thead>\r\n<tr class="tr_head">\r\n<td style="width: 20%;">\r\n<div>���������� ������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �������������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>����, ��</div>\r\n</td>\r\n</tr>\r\n</thead>\r\n</table>\r\n<div>\r\n<div style="height: auto; margin-bottom: 0px; margin-right: 0px;">\r\n<table width="100%" align="center">\r\n<tbody>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>24</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-62</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40/42-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>25</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42/44-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>27</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42-170</div>\r\n</td>\r\n<td>\r\n<div>26</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44/46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>29</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44-170</div>\r\n</td>\r\n<td>\r\n<div>28</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46/48-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>31</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>30</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>48-170</div>\r\n</td>\r\n<td>\r\n<div>32</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>74-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>102-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><small>������ � �������� ������&nbsp;<strong>������� ��������</strong> ������������� � ���� ������ - �������: <strong>��������� ������, � ������� ��������.</strong> ���������� <strong>������������ ����</strong> ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>\r\n</div>\r\n</div>', '<p><small>������ <strong>���������� � ��������</strong> ������������� � ���� ������ - �������: ��������� ������, � ������� ��������. ���������� ������������ ���� ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>', NULL, NULL, NULL, 'mayka-oodjim', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(14, 26, '���� Mangoff', '<p>������, ����������, �� ��������� ��������. ������ ����� �������������� ������� ��� �����, ������� ������ ����� �� ����� ����������, �� ���������� ����. ��������� ���������� ������� �������� ��������� �� ����. ����� ���������, �� ������ ����� ����� ������. ���������� ���������� ����� ������.</p>', '<p>����� ������� �� ������: 142,0��.<br />����� ������� �� ����� �����: 120,0��.<br />������: �-������<br />������ ����: �����������<br />������ ����: ������<br />�������� �����: �����<br />�������� ����: �����<br />�������: ��������, �� ���� �� ����� �����<br />��� � ������������ ��������: ������ �� ������<br />��� � ������������ ������� � ������������ ���������: ���</p>', 5000, 5600, '0', '1', '1', '876876876', '1', '25,26,24', 'i5-11ii3-6ii3-5ii4-7ii2-1ii2-2i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223131223b7d693a333b613a323a7b693a303b733a313a2236223b693a313b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2237223b7d693a323b613a323a7b693a303b733a313a2231223b693a313b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574938074, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img14_84532s.jpg', '/UserFiles/Image/Trial/img14_84532.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '97,96,95,94', 70, 400, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '<p>&nbsp;</p>\r\n<table width="100%" align="center">\r\n<thead>\r\n<tr class="tr_head">\r\n<td style="width: 20%;">\r\n<div>���������� ������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �������������</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>������ �����, � ��</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>����, ��</div>\r\n</td>\r\n</tr>\r\n</thead>\r\n</table>\r\n<div>\r\n<div style="height: auto; margin-bottom: 0px; margin-right: 0px;">\r\n<table width="100%" align="center">\r\n<tbody>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>24</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-62</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>40/42-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>25</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>58-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>86-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42/44-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>27</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>42-170</div>\r\n</td>\r\n<td>\r\n<div>26</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>62-66</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>90-94</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44/46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>29</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>44-170</div>\r\n</td>\r\n<td>\r\n<div>28</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>66-70</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>94-98</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46/48-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>31</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>46-170</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>30</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>70-74</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>98-102</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 20%;">\r\n<div>48-170</div>\r\n</td>\r\n<td>\r\n<div>32</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>74-78</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>102-104</div>\r\n</td>\r\n<td style="width: 20%;">\r\n<div>170</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><small>������ � �������� ������&nbsp;<strong>������� ��������</strong> ������������� � ���� ������ - �������: <strong>��������� ������, � ������� ��������.</strong> ���������� <strong>������������ ����</strong> ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>\r\n</div>\r\n</div>', '<p><small>������ <strong>���������� � ��������</strong> ������������� � ���� ������ - �������: ��������� ������, � ������� ��������. ���������� ������������ ���� ������������� �������� ��� ������� ������: �������� �������������, ������� ���������� ������� Product Option. ����� ������������� ������� ����� ���� ���� - ������� ����, ������ ���� productoption1 � productoption2.</small></p>', NULL, NULL, NULL, 'ubka-mangoff', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(15, 28, '���� Mangoff', '<p>������ ��������� �� ������� ����� ��������� � ��������� �������� ��� ����������� �������������. ������ ������� �� ���� ���������, ������� ����������� �� ����������� ������. � ��������� � ������� ���� �������, ������ �������������� ���������. ����� ����� ������ � ����� � �� �����. ������������ ��������� ����� 79 ��.</p>', '<p>������ ��������� �� ����� ��������� � ��������� �������� ��� ����������� �������������. ������ ������� �� ���� ���������, ������� ����������� �� ����������� ������. � ��������� � ������� ���� �������, ������ �������������� ���������. ����� ����� ������ � ����� � �� �����. ������������ ��������� ����� 79 ��.&nbsp;������ ��������� �� ����� ��������� � ��������� �������� ��� ����������� �������������. ������ ������� �� ���� ���������, ������� ����������� �� ����������� ������. � ��������� � ������� ���� �������, ������ �������������� ���������. ����� ����� ������ � ����� � �� �����. ������������ ��������� ����� 79 ��.</p>', 4500, 4700, '0', '1', '1', '9886876', '0', '', 'i5-11ii3-5ii4-7ii2-1i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223131223b7d693a333b613a313a7b693a303b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2237223b7d693a323b613a313a7b693a303b733a313a2231223b7d7d, '1', 0, '1', '', '0', 1574938243, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img15_92639s.jpg', '/UserFiles/Image/Trial/img15_92639.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '140,139', 27, 120, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'ochki-mangoff', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(16, 28, '������ Oodjim', '<p>������ ��������� �� ������� ����� ��������� � ��������� �������� ��� ����������� �������������. ����������� �� ����������� ������. � ��������� � ������� ���� �������, ������ �������������� ���������. ����� ����� ������ � ����� � �� �����.&nbsp;</p>', '<p>� ��������� � ������� ���� �������, ������ �������������� ���������. ����� ����� ������ � ����� � �� �����. ������������ ��������� ����� 79 ��. ������ ��������� �� ������� ����� ��������� � ��������� �������� ��� ����������� �������������. ������ ������� �� ���� ���������, ������� ����������� �� ����������� ������.</p>', 1290, 0, '0', '1', '1', '987987', '0', '', 'i5-12ii3-5ii4-7ii4-8ii2-1i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223132223b7d693a333b613a313a7b693a303b733a313a2235223b7d693a343b613a323a7b693a303b733a313a2237223b693a313b733a313a2238223b7d693a323b613a313a7b693a303b733a313a2231223b7d7d, '1', 0, '1', '', '0', 1574938302, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img16_92849s.jpg', '/UserFiles/Image/Trial/img16_92849.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 56, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'remen-oodjim', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(17, 28, '������ Springfold', '<p>������ ��������� �� ������� ����� ��������� � ��������� �������� ��� ����������� �������������. ������ ������� �� ���� ���������, ������� ����������� �� ����������� ������. � ��������� � ������� ���� �������, ������ �������������� ���������.&nbsp;</p>', '<p>��������� � ��������� �������� ��� ����������� �������������. ������ ������� �� ���� ���������, ������� ����������� �� ����������� ������. � ��������� � ������� ���� �������, ������ �������������� ���������. ����� ����� ������ � ����� � �� �����. ������������ ��������� ����� 79 ��.</p>', 2590, 0, '1', '1', '1', '876765', '0', '', 'i5-16ii3-5ii4-7ii2-3ii2-2i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223136223b7d693a333b613a313a7b693a303b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2237223b7d693a323b613a323a7b693a303b733a313a2233223b693a313b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574938282, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img17_22660s.jpg', '/UserFiles/Image/Trial/img17_22660.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 4, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'platok-springfold', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(18, 28, '���� Springfold', '<p>� ��������� � ������� ���� �������, ������ �������������� ���������. ����� ����� ������ � ����� � �� �����. ������������ ��������� ����� 79 ��.</p>', '<p>������ ��������� �� ������� ����� ��������� � ��������� �������� ��� ����������� �������������. ������ ������� �� ���� ���������, ������� ����������� �� ����������� ������. � ��������� � ������� ���� �������, ������ �������������� ���������. ����� ����� ������ � ����� � �� �����. ������������ ��������� ����� 79 ��.</p>', 3590, 0, '0', '1', '1', '876876', '0', '', 'i5-16ii3-6ii3-5ii4-7ii2-1i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223136223b7d693a333b613a323a7b693a303b733a313a2236223b693a313b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2237223b7d693a323b613a313a7b693a303b733a313a2231223b7d7d, '1', 0, '1', '', '0', 1574938267, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img18_49453s.jpg', '/UserFiles/Image/Trial/img18_49453.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '141', 87, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'ochki-springfold', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(19, 28, '���� Oodjim', '<p>������ ��������� �� ������� ����� ��������� � ��������� �������� ��� ����������� �������������. ������ ������� �� ���� ���������, ������� ����������� �� ����������� ������.&nbsp;</p>', '<p>� ��������� � ������� ���� �������, ������ �������������� ���������. ����� ����� ������ � ����� � �� �����. ������������ ��������� ����� 79 ��.&nbsp;������ ��������� �� ����� ��������� � ��������� �������� ��� ����������� �������������. ������ ������� �� ���� ���������, ������� ����������� �� ����������� ������. � ��������� � ������� ���� �������, ������ �������������� ���������. ����� ����� ������ � ����� � �� �����. ������������ ��������� ����� 79 ��.</p>', 3000, 0, '1', '1', '1', '876876', '0', '', 'i5-12ii3-6ii3-5ii4-7ii2-1i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223132223b7d693a333b613a323a7b693a303b733a313a2236223b693a313b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2237223b7d693a323b613a313a7b693a303b733a313a2231223b7d7d, '1', 0, '1', '', '0', 1574938258, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img19_68698s.jpg', '/UserFiles/Image/Trial/img19_68698.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 87, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'ochki-oodjim', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(20, 27, 'Polo Crocsby', '<p>�������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������.&nbsp;</p>', '<p>�������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������, �������� ������, ������� �������� ��� ��������� ������ � ������. ������ ������������ � ������������ ���� � ������������ �������� ����������.</p>', 4500, 4700, '0', '1', '1', '0987087', '0', '25,26,24', 'i5-17ii3-5ii4-8ii2-3ii2-2i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223137223b7d693a333b613a313a7b693a303b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2238223b7d693a323b613a323a7b693a303b733a313a2233223b693a313b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574937782, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img20_30838s.jpg', '/UserFiles/Image/Trial/img20_30838.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '101,100', 87, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'polo-crocsby', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(21, 27, '������� Kustang', '<p>��� �������� ������������� � ����������� ������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������.�</p>', '<p>������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������, �������� ������, ������� �������� ��� ��������� ������ � ������. ������ ������������ � ������������ ���� � ������������ �������� ����������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������.�</p>', 6700, 11000, '0', '1', '1', '34435', '0', '23,25,26,24', 'i5-nullii3-nullii4-nullii2-nulli', 0x613a343a7b693a353b613a313a7b693a303b733a343a226e756c6c223b7d693a333b613a313a7b693a303b733a343a226e756c6c223b7d693a343b613a313a7b693a303b733a343a226e756c6c223b7d693a323b613a313a7b693a303b733a343a226e756c6c223b7d7d, '1', 0, '1', '', '0', 1574969530, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img21_18874s.jpg', '/UserFiles/Image/Trial/img21_18874.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '115,114,113', 9, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'pulover-kustang', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(22, 27, '������� Polambia', '<p>������ ������������ � ������������ ���� � ������������ �������� ����������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����.&nbsp;</p>', '<p>������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������, �������� ������, ������� �������� ��� ��������� ������ � ������. ������ ������������ � ������������ ���� � ������������ �������� ����������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������.&nbsp;</p>', 4690, 7000, '0', '1', '1', '98987', '0', '23,25', 'i5-21ii3-5ii4-8ii2-2i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223231223b7d693a333b613a313a7b693a303b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2238223b7d693a323b613a313a7b693a303b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574937888, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img22_11677s.jpg', '/UserFiles/Image/Trial/img22_11677.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '126,125', 45, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'rubashka-polambia', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(23, 30, '���� Abibas', '<p>���������� ������� � ��������� ������ ������. �������� ������ ������ ���� ������������ ����� ������� � ������� ������� �� ����. ������������ ���� ��������� ��������� ����� ������ �����. �������� �������� ����� ������� ������������ ������������� � �����. �������� ���������������� ��������� ��� �������� � ��������� � ������� ������.</p>', '<p>����������� ��������� �������<br />��������������� �������� ���� ������� �� �������<br />������ �������� �� EVA-����<br />����� �� �������������� �������� (PVC)<br />���� �� ������� �������� 5 ��<br />������� ��������� ���<br />�������� ��������������:</p>', 4500, 4900, '0', '1', '1', '8776987', '0', '4,29,23', 'i3-4ii4-8ii2-2i', 0x613a333a7b693a333b613a313a7b693a303b733a313a2234223b7d693a343b613a313a7b693a303b733a313a2238223b7d693a323b613a313a7b693a303b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574949962, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img23_77945s.jpg', '/UserFiles/Image/Trial/img23_77945.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '133,132,131', 17, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'kedy-abibas', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(24, 30, '������� Luma', '<p>�������� ������ ������ ���� ������������ ����� ������� � ������� ������� �� ����. ������������ ���� ��������� ��������� ����� ������ �����. �������� �������� ����� ������� ������������ ������������� � �����. �������� ���������������� ��������� ��� �������� � ��������� � ������� ������.</p>', '<p>����������� ��������� �������<br />��������������� �������� ���� ������� �� �������<br />������ �������� �� EVA-����<br />����� �� �������������� �������� (PVC)<br />���� �� ������� �������� 5 ��<br />������� ��������� ���<br />�������� ��������������:</p>', 6700, 0, '0', '1', '1', '96759765', '0', '33,32', 'i3-5ii3-4ii4-8ii2-2i', 0x613a333a7b693a333b613a323a7b693a303b733a313a2235223b693a313b733a313a2234223b7d693a343b613a313a7b693a303b733a313a2238223b7d693a323b613a313a7b693a303b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574949973, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img24_36368s.jpg', '/UserFiles/Image/Trial/img24_36368.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '138,137,136', 14, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'slipony-luma', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL);
INSERT INTO `phpshop_products` (`id`, `category`, `name`, `description`, `content`, `price`, `price_n`, `sklad`, `p_enabled`, `enabled`, `uid`, `spec`, `odnotip`, `vendor`, `vendor_array`, `yml`, `num`, `newtip`, `title`, `title_enabled`, `datas`, `page`, `user`, `descrip`, `descrip_enabled`, `title_shablon`, `descrip_shablon`, `keywords`, `keywords_enabled`, `keywords_shablon`, `pic_small`, `pic_big`, `yml_bid_array`, `parent_enabled`, `parent`, `items`, `weight`, `price2`, `price3`, `price4`, `price5`, `files`, `baseinputvaluta`, `ed_izm`, `dop_cat`, `rate`, `rate_count`, `price_search`, `parent2`, `color`, `productsgroup_check`, `productsgroup_products`, `vendor_code`, `vendor_name`, `productday`, `hit`, `option1`, `option2`, `option3`, `option4`, `option5`, `prod_seo_name`, `prod_seo_name_old`, `manufacturer_warranty`, `sales_notes`, `country_of_origin`, `adult`, `delivery`, `pickup`, `store`, `yandex_min_quantity`, `yandex_step_quantity`, `yandex_condition`, `yandex_condition_reason`) VALUES
(25, 30, '���� Gans', '<p>���������� ������� � ��������� ������ ������. �������� ������ ������ ���� ������������ ����� ������� � ������� ������� �� ����. ������������ ���� ��������� ��������� ����� ������ �����. �������� �������� ����� ������� ������������ ������������� � �����. �������� ���������������� ��������� ��� �������� � ��������� � ������� ������.</p>', '<p>����������� ��������� �������<br />��������������� �������� ���� ������� �� �������<br />������ �������� �� EVA-����<br />����� �� �������������� �������� (PVC)<br />���� �� ������� �������� 5 ��<br />������� ��������� ���<br />�������� ��������������:</p>', 8000, 11000, '0', '1', '1', '98769876', '0', '4,29,30,22', 'i3-5ii4-8ii2-3ii2-1i', 0x613a333a7b693a333b613a313a7b693a303b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2238223b7d693a323b613a323a7b693a303b733a313a2233223b693a313b733a313a2231223b7d7d, '1', 0, '1', '', '0', 1574949948, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img25_67891s.jpg', '/UserFiles/Image/Trial/img25_67891.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '130,129,128', 100, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'kedy-gans', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(26, 30, '������� Gans', '<p>���������� ������� � ��������� ������ ������. �������� ������ ������ ���� ������������ ����� ������� � ������� ������� �� ����. ������������ ���� ��������� ��������� ����� ������ �����. �������� �������� ����� ������� ������������ ������������� � �����.&nbsp;</p>', '<p>����������� ��������� �������<br />��������������� �������� ���� ������� �� �������<br />������ �������� �� EVA-����<br />����� �� �������������� �������� (PVC)<br />���� �� ������� �������� 5 ��<br />������� ��������� ���<br />�������� ��������������:</p>', 8000, 12200, '0', '1', '1', '09878976', '0', '4,29,23,22', 'i3-5ii4-8ii2-2i', 0x613a333a7b693a333b613a313a7b693a303b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2238223b7d693a323b613a313a7b693a303b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574949968, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img26_58467s.jpg', '/UserFiles/Image/Trial/img26_58467.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '135,134', 74, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'slipony-gans', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(27, 31, '����� Polambia', '<p>�������� �������� ����� ������� ������������ ������������� � �����. �������� ���������������� ��������� ��� �������� � ��������� � ������� ������.</p>', '<p>���������� ������� � ��������� ������ ������. �������� ������ ������ ���� ������������ ����� ������� � ������� ������� �� ����. ������������ ���� ��������� ��������� ����� ������ �����. �������� �������� ����� ������� ������������ ������������� � �����. �������� ���������������� ��������� ��� �������� � ��������� � ������� ������.</p>', 4500, 7800, '1', '1', '1', '976976', '0', '23,25', 'i5-21ii3-5ii3-4ii4-8ii2-1ii2-2i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223231223b7d693a333b613a323a7b693a303b733a313a2235223b693a313b733a313a2234223b7d693a343b613a313a7b693a303b733a313a2238223b7d693a323b613a323a7b693a303b733a313a2231223b693a313b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574937652, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img27_71254s.jpg', '/UserFiles/Image/Trial/img27_71254.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 68, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'sumka-polambia', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(28, 27, '������� Polambia', '<p>������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������.&nbsp;</p>', '<p>������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������, �������� ������, ������� �������� ��� ��������� ������ � ������. ������ ������������ � ������������ ���� � ������������ �������� ����������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������.&nbsp;</p>', 4500, 4900, '0', '1', '1', '87687659', '0', '23,25,27', 'i5-21ii3-5ii4-8ii2-1ii2-2i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223231223b7d693a333b613a313a7b693a303b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2238223b7d693a323b613a323a7b693a303b733a313a2231223b693a313b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574937904, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img28_10558s.jpg', '/UserFiles/Image/Trial/img28_10558.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '127', 13, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'rubashka-polambia', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(29, 27, '���� S.Oliverty', '<p>�������� �������� ��� �������� ������������� � ����������� ������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������.&nbsp;</p>', '<p>������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������, �������� ������, ������� �������� ��� ��������� ������ � ������. ������ ������������ � ������������ ���� � ������������ �������� ����������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������.&nbsp;</p>', 3590, 4300, '0', '1', '1', '3434521', '0', '25,26,24', 'i5-18ii3-5ii4-8ii2-2i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223138223b7d693a333b613a313a7b693a303b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2238223b7d693a323b613a313a7b693a303b733a313a2232223b7d7d, '1', 0, '1', '', '0', 1574937825, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img29_65387s.jpg', '/UserFiles/Image/Trial/img29_65387.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '112,111,110,109', 13, 300, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'polo-s-oliverty', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(30, 27, '������� Oliverty', '<p>�������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. ������� �� �������������� ��������� �� �������, �������� ������, ������� �������� ��� ��������� ������ � ������. ������ ������������ � ������������ ���� � ������������ �������� ����������.</p>', '<p>�������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������� ��� ��� ������� ���������� ��� � ��� �����, ������������ ��������������. ������� ����������, ����������� �� ������, ��������� �������� �����. ������ ������ ��������� � ����, ���� � ��������. �������� �������� ��� �������� ������������� � ����������� ������. �������, �������� ������, ������� �������� ��� ��������� ������ � ������. ������ ������������ � ������������ ���� � ������������ �������� ����������.</p>', 8000, 13000, '0', '1', '1', '5435423', '0', '4,29,8', 'i5-18ii3-5ii4-8ii2-3ii2-1i', 0x613a343a7b693a353b613a313a7b693a303b733a323a223138223b7d693a333b613a313a7b693a303b733a313a2235223b7d693a343b613a313a7b693a303b733a313a2238223b7d693a323b613a323a7b693a303b733a313a2233223b693a313b733a313a2231223b7d7d, '1', 0, '1', '', '0', 1574937843, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img30_85931s.jpg', '/UserFiles/Image/Trial/img30_85931.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '118,117,116', 67, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'pulover-oliverty', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(31, 11, '������ Zivage', '<p>������ ����������: ������ ����������: �������� ���������� ��������� ����� ����, �� ����� ����. �� ������������� ������������ �� ������������ ���� � ��� ������� ����� ����������.</p>', '<p>����������� �������: ��� �������, ��� ��������������, ��� �������, ��� ���������, ��� ������, ��� �������, ��� ������������, ��� �����, ���������������, �� ����������� �� ��������, �������� ��� ����������� ����������, ��������� �������������������: ���� �������� ����, ��������� �������, �������� �������, �������� ����</p>', 600, 0, '0', '1', '1', '323255432', '1', '37,35', 'i8-25ii7-22ii7-46ii9-29i', 0x613a333a7b693a383b613a313a7b693a303b733a323a223235223b7d693a373b613a323a7b693a303b733a323a223232223b693a313b733a323a223436223b7d693a393b613a313a7b693a303b733a323a223239223b7d7d, '1', 0, '1', '', '0', 1574792958, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img31_95215s.jpg', '/UserFiles/Image/Trial/img31_95215.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 43, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'pomada-zivage', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(32, 11, '����� ��� ��� Zivage', '<p>��������� ���������� ������������� ���������� ������� �� �������� ���������� ������ �������, �� ����������� ������� �������������� ���������������.</p>', '<p>������ ����������: ������ ����������: �������� ���������� ��������� ����� ����, �� ����� ����. �� ������������� ������������ �� ������������ ���� � ��� ������� ����� ����������.����������� �������: ��� �������, ��� ��������������, ��� �������, ��� ���������, ��� ������, ��� �������, ��� ������������, ��� �����, ���������������, �� ����������� �� ��������, �������� ��� ����������� ����������, ��������� �������������������: ���� �������� ����, ��������� �������, �������� �������, �������� ����</p>', 230, 450, '0', '1', '1', '656754', '0', '37,36,35', 'i8-25ii7-22ii7-24ii7-46ii9-31i', 0x613a333a7b693a383b613a313a7b693a303b733a323a223235223b7d693a373b613a333a7b693a303b733a323a223232223b693a313b733a323a223234223b693a323b733a323a223436223b7d693a393b613a313a7b693a303b733a323a223331223b7d7d, '1', 0, '1', '', '0', 1574792928, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img32_33653s.jpg', '/UserFiles/Image/Trial/img32_33653.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 77, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'blesk-dlya-gub-zivage', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(33, 11, '������� ����� Zivage', '<p>����������� �������: ��� �������, ��� ��������������, ��� �������, ��� ���������, ��� ������, ��� �������, ��� ������������, ��� �����, ���������������, �� ����������� �� ��������, �������� ��� ����������� ����������, ��������� �������������������: ���� �������� ����, ��������� �������, �������� �������, �������� ����</p>', '<p>������ ����������: ������ ����������: �������� ���������� ��������� ����� ����, �� ����� ����. �� ������������� ������������ �� ������������ ���� � ��� ������� ����� ����������.����������� �������: ��� �������, ��� ��������������, ��� �������, ��� ���������, ��� ������, ��� �������, ��� ������������, ��� �����, ���������������, �� ����������� �� ��������, �������� ��� ����������� ����������, ��������� �������������������: ���� �������� ����, ��������� �������, �������� �������, �������� ����</p>', 1200, 1300, '0', '1', '1', '6546543', '0', '37,35', 'i8-26ii7-24ii7-46ii9-31ii9-32i', 0x613a333a7b693a383b613a313a7b693a303b733a323a223236223b7d693a373b613a323a7b693a303b733a323a223234223b693a313b733a323a223436223b7d693a393b613a323a7b693a303b733a323a223331223b693a313b733a323a223332223b7d7d, '1', 0, '1', '', '0', 1574792945, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img33_66960s.png', '/UserFiles/Image/Trial/img33_66960.png', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 8, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'paletka-teney-zivage', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(34, 11, '����� Saybelline', '<p>��������� ���������� ������������� ���������� ������� �� �������� ���������� ������ �������, �� ����������� ������� �������������� ���������������.</p>', '<p>��������� ���������� ������������� ���������� ������� �� �������� ���������� ������ �������, �� ����������� ������� �������������� ���������������.</p>\r\n<p>������ ����������: ������ ����������: �������� ���������� ��������� ����� ����, �� ����� ����. �� ������������� ������������ �� ������������ ���� � ��� ������� ����� ����������.����������� �������: ��� �������, ��� ��������������, ��� �������, ��� ���������, ��� ������, ��� �������, ��� ������������, ��� �����, ���������������, �� ����������� �� ��������, �������� ��� ����������� ����������, ��������� �������������������: ���� �������� ����, ��������� �������, �������� �������, �������� ����</p>', 5000, 0, '0', '1', '1', '123245', '1', '37,32', 'i8-25ii7-23ii7-24ii9-31ii9-29i', 0x613a333a7b693a383b613a313a7b693a303b733a323a223235223b7d693a373b613a323a7b693a303b733a323a223233223b693a313b733a323a223234223b7d693a393b613a323a7b693a303b733a323a223331223b693a313b733a323a223239223b7d7d, '1', 0, '1', '', '0', 1574792974, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img34_27336s.png', '/UserFiles/Image/Trial/img34_27336.png', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 44, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'pudra-saybelline', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(35, 12, '��������� ��� ����� ���� Clatins', '<p>���������� �� ������� �������� �������� �� 24 ����.</p>', '<p>���������� �� ������� �������� �������� �� 24 ����. ����������� �����������, �� ��������� ������ �� ������, ����������� ���� � ���������� �������������. ������� �������� ��������� ��������� �������� � ���������� ����������, ��������� �������� ���� �� ����������� ������, ��������� ��������, ���������� ����� ���� � �������������� ������������� ����������. ��� ��������� � ��������.</p>', 4500, 4900, '0', '1', '1', '443543', '0', '37,34', 'i8-25ii7-22ii7-46ii9-29i', 0x613a333a7b693a383b613a313a7b693a303b733a323a223235223b7d693a373b613a323a7b693a303b733a323a223232223b693a313b733a323a223436223b7d693a393b613a313a7b693a303b733a323a223239223b7d7d, '1', 0, '1', '', '0', 1574792990, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img35_18528s.jpg', '/UserFiles/Image/Trial/img35_18528.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 12, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'syvorotka-dlya-suhoy-kozhi-clatins', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(36, 12, '������� Clatins', '<p>����������� �����������, �� ��������� ������ �� ������, ����������� ���� � ���������� �������������.&nbsp;</p>', '<p>������� �������� ��������� ��������� �������� � ���������� ����������, ��������� �������� ���� �� ����������� ������, ��������� ��������, ���������� ����� ���� � �������������� ������������� ����������. ��� ��������� � ��������.</p>', 2300, 2900, '0', '1', '1', '3434454', '0', '37,35', '', 0x4e3b, '1', 0, '1', '', '0', 1574719456, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img36_99871s.jpg', '/UserFiles/Image/Trial/img36_99871.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 15, 100, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(37, 12, '���� ��� ��� Saybelline', '<p>���������� �������� ��������, ���������� ����� ���� � �������������� ������������� ����������. ��� ��������� � ��������.</p>', '<p>���������� �� ������� �������� �������� �� 24 ����. ����������� �����������, �� ��������� ������ �� ������, ����������� ���� � ���������� �������������. ������� �������� ��������� ��������� �������� � ���������� ����������, ��������� �������� ���� �� ����������� ������, ��������� ��������, ���������� ����� ���� � �������������� ������������� ����������. ��� ��������� � ��������.</p>', 2450, 0, '0', '1', '1', '5456433', '0', '37,35', 'i7-22ii7-46ii9-30ii8-47i', 0x613a333a7b693a373b613a323a7b693a303b733a323a223232223b693a313b733a323a223436223b7d693a393b613a313a7b693a303b733a323a223330223b7d693a383b613a313a7b693a303b693a34373b7d7d, '1', 0, '1', '', '0', 1574793020, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img37_82187s.jpg', '/UserFiles/Image/Trial/img37_82187.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 12, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'krem-dlya-ruk-saybelline', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(83, 26, '������� Springfold 38 ', NULL, NULL, 3800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846478, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(84, 26, '������� Springfold 39 ', NULL, NULL, 3800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846481, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '39', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(85, 26, '������� Springfold 40 ', NULL, NULL, 3800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846484, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '40', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(86, 26, '�������� Mangoff 37 ��������', NULL, NULL, 800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846566, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', '37', -2, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '������-�������', '#fcdae7', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(88, 26, '�������� Mangoff 37 �������', NULL, NULL, 800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846576, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�������', '#b6f7f7', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(39, 3, '������� �����������  ������� ���', '<p>�� ��������� ������ � ���������� ���� ������������� �� �����, �� ������� ��������� ��� �������� �����������?</p>', '<p>�� ����������� � �������� � �������� �������� ���� � �����, ����������, ���������. �� ��������� ������ � ���������� ���� ������������� �� �����, �� ������� ��������� ��� �������� �����������? ������� ������� ���������� �� ������� ������� � ����� ����� ���������, ������ ��� ��� ����� ������� �������, ����� ������� ���������, ����� �� �������������� ������� ����������� ������ ����������� � ������� ���� �����������.</p>', 900, 0, '0', '1', '1', '87658764', '0', '41,42', '', 0x4e3b, '1', 0, '1', '', '0', 1574719520, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img39_63648s.jpg', '/UserFiles/Image/Trial/img39_63648.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 118, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(40, 3, '������� ����. ������������� ��������� (�������� �� 2 ����)', '<p>�� ��������� ������ � ���������� ���� ������������� �� �����, �� ������� ��������� ��� �������� �����������?</p>', '<p>��������� ������� ������� ������� ����� � �������������. ��� �������� ������������ ������������ ��������, ��� ���������� - ��� ������� ���� ��� ���������.</p>', 1450, 0, '0', '1', '1', '2452456', '0', '41,42', '', 0x4e3b, '1', 0, '1', '', '0', 1574719527, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img40_16081s.jpg', '/UserFiles/Image/Trial/img40_16081.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 56, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(41, 3, '�� ��������� ������. ������� ������ 2. ��������� �������', '<div class="br7" data-v-c66bfbbc="">����� �� ������� �������� ���� ��� ������ ������������ �������� ��������� ���������� ���, ������� � ����, ��� ��� ��������.</div>\r\n<div class="br6" data-v-c66bfbbc="">&nbsp;</div>', '<p>����� �� ������� �������� ���� ��� ������ ������������ �������� ��������� ���������� ���, ������� � ����, ��� ��� ��������. ���������� ���� ������: �� ������ ����������� � ������������� �������, ��������� �� ��� �� 2000 ��� � ������; �� ������� ��� ��� �� �����, �� ��� ����� �� ��� ��������� ����� ��� ����������� ������������ ������� ����. ���������� �� ����� �������, �� ��� ���� �������� ������: �� ���� ������ � ������� ����, �� �� ������ �������������.</p>', 4590, 0, '0', '1', '1', '3535656', '0', '39,40,42', '', 0x4e3b, '1', 0, '1', '', '0', 1574719506, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img41_23080s.jpg', '/UserFiles/Image/Trial/img41_23080.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 344, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(42, 3, '��� ����� ����. 2 ���������� �����, ������� �������, ��� ��� �����', '<p>��� �������� ������������ ������������ ��������, ��� ���������� - ��� ������� ���� ��� ���������.</p>', '<p>����� �� ������� �������� ���� ��� ������ ������������ �������� ��������� ���������� ���, ������� � ����, ��� ��� ��������. ���������� ���� ������: �� ������ ����������� � ������������� �������, ��������� �� ��� �� 2000 ��� � ������; �� ������� ��� ��� �� �����, �� ��� ����� �� ��� ��������� ����� ��� ����������� ������������ ������� ����. ���������� �� ����� �������, �� ��� ���� �������� ������: �� ���� ������ � ������� ����, �� �� ������ �������������.</p>', 3590, 0, '0', '1', '1', '978697', '0', '39,41', '', 0x4e3b, '1', 0, '1', '', '0', 1574719534, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img42_77115s.jpg', '/UserFiles/Image/Trial/img42_77115.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 79, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(43, 3, '451� �� ������� �������� ������', '<p>���������� �� ����� �������, �� ��� ���� �������� ������: �� ���� ������ � ������� ����, �� �� ������ �������������.</p>', '<p>����� �� ������� �������� ���� ��� ������ ������������ �������� ��������� ���������� ���, ������� � ����, ��� ��� ��������. ���������� ���� ������: �� ������ ����������� � ������������� �������, ��������� �� ��� �� 2000 ��� � ������; �� ������� ��� ��� �� �����, �� ��� ����� �� ��� ��������� ����� ��� ����������� ������������ ������� ����. ���������� �� ����� �������, �� ��� ���� �������� ������: �� ���� ������ � ������� ����, �� �� ������ �������������.</p>', 800, 0, '0', '1', '1', '97659765', '0', '42,43', '', 0x4e3b, '1', 0, '1', '', '0', 1574719513, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img43_24630s.jpg', '/UserFiles/Image/Trial/img43_24630.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 90, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(44, 14, '����� ������������ ��� ���� � ���� TEKOV DMT', '<p>�������, ����������� �� ������ ��� ��������� ������ ��������� ���������, ������� �� ������ ��������� ���� ������ �������������� �����������, �� � ��������� � ������ ��������� ������ ��������, ������������� � ������������ ����� � �������� ��������� �������� ��������. ������� �� ������ ����� ������ � �������.</p>', '<p>��������� ������, ����� � ������, �������������� �����, ������������ � �������� �������� ������������ �������, ���������� ������� ��� �������� ������ � ������� �������, �������� ����������� ������� � ����� ���-���.<br />������������ ������ �� ������<br />�������, ����������� �� ������ ��� ��������� ������ ��������� ���������, ������� �� ������ ��������� ���� ������ �������������� �����������, �� � ��������� � ������ ��������� ������ ��������, ������������� � ������������ ����� � �������� ��������� �������� ��������. ������� �� ������ ����� ������ � �������.</p>', 2380, 0, '0', '1', '1', '98769875', '0', '49,44', 'i11-36ii12-39ii12-40ii12-45ii13-42i', 0x613a333a7b693a31313b613a313a7b693a303b733a323a223336223b7d693a31323b613a333a7b693a303b733a323a223339223b693a313b733a323a223430223b693a323b733a323a223435223b7d693a31333b613a313a7b693a303b733a323a223432223b7d7d, '1', 0, '1', '', '0', 1574793192, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img44_23523s.jpg', '/UserFiles/Image/Trial/img44_23523.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 8, 0, 0, 0, 0, 0, 'N;', 6, '��.', '#15#16#', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'nabor-instrumentov-dlya-avto-i-doma-tekov-dmt', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(45, 14, '������ �������������� Gosch ��� ��� � ��', '<p>������ ������� ����������� �� ������������ ���������� � � �������������� ����� ����������� ����������, ��� ��������� ������� ������� ����, ���������� �������� � �������� ������.</p>', '<p>��������� ������, ����� � ������, �������������� �����, ������������ � �������� �������� ������������ �������, ���������� ������� ��� �������� ������ � ������� �������, �������� ����������� ������� � ����� ���-���.<br />������������ ������ �� ������<br />�������, ����������� �� ������ ��� ��������� ������ ��������� ���������, ������� �� ������ ��������� ���� ������ �������������� �����������, �� � ��������� � ������ ��������� ������ ��������, ������������� � ������������ ����� � �������� ��������� �������� ��������. ������� �� ������ ����� ������ � �������.</p>', 8000, 0, '0', '1', '1', '34345', '0', '47,51,44,49', 'i11-35ii11-33ii12-38ii13-42i', 0x613a333a7b693a31313b613a323a7b693a303b733a323a223335223b693a313b733a323a223333223b7d693a31323b613a313a7b693a303b733a323a223338223b7d693a31333b613a313a7b693a303b733a323a223432223b7d7d, '1', 0, '1', '', '0', 1574793136, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img45_37544s.jpg', '/UserFiles/Image/Trial/img45_37544.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 0, 0, 0, 0, 0, 0, 'N;', 6, '��.', '#15#', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'lobzik-akkumulyatornyy-gosch-bez-akb-i-zu', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(46, 14, '���� ����������� RedVerg RD-CS130-55', '<p>������ ������� ����������� �� ������������ ���������� � � �������������� ����� ����������� ����������, ��� ��������� ������� ������� ����, ���������� �������� � �������� ������.</p>', '<p>����������� ��������� ����������<br />���������� �������� ���������� ��� ������� ������, ������� ���������� ��������� ���� ��������. ����� ������� �������� ����������� ��������, ������� �������� �� ����� ��������� �����.<br />3 ������<br />������ ������ ����� 3 ������ ������, ��� ���������� ��� ������������� ����� ������ ����. ��������, ����� ��������� ��������� ���� ������������, ����� �������� ������������ ��������, �� ���� ������ �����, � ��� ������������� ������ ��� ���� ���������� ���� ������� �� ������� ��� ����������� ��������.</p>', 7000, 0, '0', '1', '1', '34546456', '1', '49,50', 'i11-35ii11-36ii11-33ii12-37ii12-45ii13-41i', 0x613a333a7b693a31313b613a333a7b693a303b733a323a223335223b693a313b733a323a223336223b693a323b733a323a223333223b7d693a31323b613a323a7b693a303b733a323a223337223b693a313b733a323a223435223b7d693a31333b613a313a7b693a303b733a323a223431223b7d7d, '1', 0, '1', '', '0', 1574793235, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img46_54151s.jpg', '/UserFiles/Image/Trial/img46_54151.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 120, 0, 0, 0, 0, 0, 'N;', 6, '��.', '#15#16#', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'pila-cirkulyarnaya-redverg-rd-cs130-55', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(47, 14, '���� ������� Gosch, �������������, 42�, 160 x 20 ��', '<p>������� ���������, ��� ������� ������� ������ ��������������� �������� ������� �����������, ��� ������� ��� ���������������.&nbsp;</p>', '<p>������� ���������, ��� ������� ������� ������ ��������������� �������� ������� �����������, ��� ������� ��� ���������������.&nbsp;����� �� �������������� �������� (PVC). ���� �� ������� �������� 5 ��. ������� ��������� ���</p>', 600, 0, '0', '1', '1', '3453446', '0', '49,44,46,50', 'i11-34ii12-37ii13-44i', 0x613a333a7b693a31313b613a313a7b693a303b733a323a223334223b7d693a31323b613a313a7b693a303b733a323a223337223b7d693a31333b613a313a7b693a303b733a323a223434223b7d7d, '1', 0, '1', '', '0', 1574793157, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img47_24068s.jpg', '/UserFiles/Image/Trial/img47_24068.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 345, 0, 0, 0, 0, 0, 'N;', 6, '��.', '#15#16#', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'disk-pilnyy-gosch-universalnyy-42t-160-x-20-mm', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(48, 14, '���� ����������� Lammer Bles CRP1300D', '<p>������ ������ ����� 3 ������ ������, ��� ���������� ��� ������������� ����� ������ ����. ��������, ����� ��������� ��������� ���� ������������, ����� �������� ������������ ��������, �� ���� ������ �����, � ��� ������������� ������ ��� ���� ���������� ���� ������� �� ������� ��� ����������� ��������.</p>', '<p>����������� ��������� ����������<br />���������� �������� ���������� ��� ������� ������, ������� ���������� ��������� ���� ��������. ����� ������� �������� ����������� ��������, ������� �������� �� ����� ��������� �����.<br />3 ������<br />������ ������ ����� 3 ������ ������, ��� ���������� ��� ������������� ����� ������ ����. ��������, ����� ��������� ��������� ���� ������������, ����� �������� ������������ ��������, �� ���� ������ �����, � ��� ������������� ������ ��� ���� ���������� ���� ������� �� ������� ��� ����������� ��������.</p>', 450, 0, '0', '1', '1', '44656', '0', '47,44', 'i11-34ii12-40ii12-45ii13-44i', 0x613a333a7b693a31313b613a313a7b693a303b733a323a223334223b7d693a31323b613a323a7b693a303b733a323a223430223b693a313b733a323a223435223b7d693a31333b613a313a7b693a303b733a323a223434223b7d7d, '1', 0, '1', '', '0', 1574793221, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img48_22317s.jpg', '/UserFiles/Image/Trial/img48_22317.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 10, 0, 0, 0, 0, 0, 'N;', 6, '��.', '#15#16#', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'pila-cirkulyarnaya-lammer-bles-crp1300d', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(49, 14, '������� �� ����� ��� ������� ����� FML, 3,5-10 ��', '<p>���������� �������� ���������� ��� ������� ������, ������� ���������� ��������� ���� ��������. ����� ������� �������� ����������� ��������, ������� �������� �� ����� ��������� �����.</p>', '<p>��������� ������, ����� � ������, �������������� �����, ������������ � �������� �������� ������������ �������, ���������� ������� ��� �������� ������ � ������� �������, �������� ����������� ������� � ����� ���-���.<br />������������ ������ �� ������<br />�������, ����������� �� ������ ��� ��������� ������ ��������� ���������, ������� �� ������ ��������� ���� ������ �������������� �����������, �� � ��������� � ������ ��������� ������ ��������, ������������� � ������������ ����� � �������� ��������� �������� ��������. ������� �� ������ ����� ������ � �������.</p>', 450, 0, '0', '1', '1', '4543456', '0', '47,50', 'i11-34ii12-38ii12-45ii13-43i', 0x613a333a7b693a31313b613a313a7b693a303b733a323a223334223b7d693a31323b613a323a7b693a303b733a323a223338223b693a313b733a323a223435223b7d693a31333b613a313a7b693a303b733a323a223433223b7d7d, '1', 0, '1', '', '0', 1574793207, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img49_36956s.jpg', '/UserFiles/Image/Trial/img49_36956.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 46, 0, 0, 0, 0, 0, 'N;', 6, '��.', '#15#16#', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'nasadka-na-drel-dlya-zatochki-sverl-fml-35-10-mm', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL);
INSERT INTO `phpshop_products` (`id`, `category`, `name`, `description`, `content`, `price`, `price_n`, `sklad`, `p_enabled`, `enabled`, `uid`, `spec`, `odnotip`, `vendor`, `vendor_array`, `yml`, `num`, `newtip`, `title`, `title_enabled`, `datas`, `page`, `user`, `descrip`, `descrip_enabled`, `title_shablon`, `descrip_shablon`, `keywords`, `keywords_enabled`, `keywords_shablon`, `pic_small`, `pic_big`, `yml_bid_array`, `parent_enabled`, `parent`, `items`, `weight`, `price2`, `price3`, `price4`, `price5`, `files`, `baseinputvaluta`, `ed_izm`, `dop_cat`, `rate`, `rate_count`, `price_search`, `parent2`, `color`, `productsgroup_check`, `productsgroup_products`, `vendor_code`, `vendor_name`, `productday`, `hit`, `option1`, `option2`, `option3`, `option4`, `option5`, `prod_seo_name`, `prod_seo_name_old`, `manufacturer_warranty`, `sales_notes`, `country_of_origin`, `adult`, `delivery`, `pickup`, `store`, `yandex_min_quantity`, `yandex_step_quantity`, `yandex_condition`, `yandex_condition_reason`) VALUES
(50, 14, '�������������� ������� ��� Gosch AdvancedDril18, ������', '<p>�������, ����������� �� ������ ��� ��������� ������ ��������� ���������, ������� �� ������ ��������� ���� ������ �������������� �����������, �� � ��������� � ������ ��������� ������ ��������, ������������� � ������������ ����� � �������� ��������� �������� ��������. ������� �� ������ ����� ������ � �������.</p>', '<p>����������� ��������� ����������<br />���������� �������� ���������� ��� ������� ������, ������� ���������� ��������� ���� ��������. ����� ������� �������� ����������� ��������, ������� �������� �� ����� ��������� �����.<br />3 ������<br />������ ������ ����� 3 ������ ������, ��� ���������� ��� ������������� ����� ������ ����. ��������, ����� ��������� ��������� ���� ������������, ����� �������� ������������ ��������, �� ���� ������ �����, � ��� ������������� ������ ��� ���� ���������� ���� ������� �� ������� ��� ����������� ��������.</p>', 1200, 0, '0', '1', '1', '344556', '1', '49,47', 'i11-34ii12-39ii12-45ii13-42i', 0x613a333a7b693a31313b613a313a7b693a303b733a323a223334223b7d693a31323b613a323a7b693a303b733a323a223339223b693a313b733a323a223435223b7d693a31333b613a313a7b693a303b733a323a223432223b7d7d, '1', 0, '1', '', '0', 1574793289, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img50_30692s.jpg', '/UserFiles/Image/Trial/img50_30692.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 10, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'ekscentrikovaya-nasadka-dlya-gosch-advanceddril18-chernyy', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(51, 14, '�����-���������� �������������� Gosch Advanced Impact', '<p>��������� ������, ����� � ������, �������������� �����, ������������ � �������� �������� ������������ �������, ���������� ������� ��� �������� ������ � ������� �������, �������� ����������� ������� � ����� ���-���.</p>', '<p>������� ���������, ��� ������� ������� ������ ��������������� �������� ������� �����������, ��� ������� ��� ���������������. ������� ����� �������� ���������� ���� ��� �������, ��� �� ��������������� ���� ��������� ��������� ��������� �������� �����������. �������, �������� 60 ����������� ��� ��������� ������� ��� �������� ������������ ������� 60 � 45 ��.<br />������ ������� ����<br />������ ������� ����������� �� ������������ ���������� � � �������������� ����� ����������� ����������, ��� ��������� ������� ������� ����, ���������� �������� � �������� ������.</p>', 6000, 0, '0', '1', '1', '455654', '0', '47,49', 'i11-36ii12-38ii13-42i', 0x613a333a7b693a31313b613a313a7b693a303b733a323a223336223b7d693a31323b613a313a7b693a303b733a323a223338223b7d693a31333b613a313a7b693a303b733a323a223432223b7d7d, '1', 0, '1', '', '0', 1574793171, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img51_26484s.jpg', '/UserFiles/Image/Trial/img51_26484.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 123, 0, 0, 0, 0, 0, 'N;', 6, '��.', '#15#16#', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'drel-shurupovert-akkumulyatornaya-gosch-advanced-impact', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(52, 14, '������ ������ Baimeder ��� ���������������', '<p>��������� ������, ����� � ������, �������������� �����, ������������ � �������� �������� ������������ �������, ���������� ������� ��� �������� ������ � ������� �������, �������� ����������� ������� � ����� ���-���.</p>', '<p>����������� ��������� ����������<br />���������� �������� ���������� ��� ������� ������, ������� ���������� ��������� ���� ��������. ����� ������� �������� ����������� ��������, ������� �������� �� ����� ��������� �����.<br />3 ������<br />������ ������ ����� 3 ������ ������, ��� ���������� ��� ������������� ����� ������ ����. ��������, ����� ��������� ��������� ���� ������������, ����� �������� ������������ ��������, �� ���� ������ �����, � ��� ������������� ������ ��� ���� ���������� ���� ������� �� ������� ��� ����������� ��������.</p>', 5000, 0, '0', '1', '1', '244536345', '1', '47,49', 'i11-34ii12-38ii12-40ii12-45ii13-48i', 0x613a333a7b693a31313b613a313a7b693a303b733a323a223334223b7d693a31323b613a333a7b693a303b733a323a223338223b693a313b733a323a223430223b693a323b733a323a223435223b7d693a31333b613a313a7b693a303b733a323a223438223b7d7d, '1', 0, '1', '', '0', 1574793272, 'null', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img52_37358s.jpg', '/UserFiles/Image/Trial/img52_37358.jpg', 0x613a323a7b733a333a22626964223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', NULL, 0, 0, 0, 0, 0, 0, 'N;', 6, '��.', '', 0, 0, 0, NULL, NULL, '0', '', '', '', '0', '0', '', '', NULL, NULL, NULL, 'ruchnaya-mashina-baimeder-dlya-oshtukaturivaniya', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(82, 26, '������� Springfold 37 ', NULL, NULL, 3800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846475, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(53, 26, '����� Mangoff 36 ', NULL, NULL, 4500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574844610, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img11_78833s.jpg', '/UserFiles/Image/Trial/img11_78833.jpg', 0x4e3b, '1', '36', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�����', '#c0c0c0', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(54, 26, '����� Mangoff 37 ', NULL, NULL, 5000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574844317, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�������', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(55, 26, '����� Mangoff 38 ', NULL, NULL, 5500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574844053, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�������', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(57, 26, '����� Mangoff 38 �������', NULL, NULL, 5200, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574844562, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img11_33069.jpg', '/UserFiles/Image/Trial/img11_33069.jpg', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�������', '#0075ff', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(58, 26, '����� Mangoff 37 ������', NULL, NULL, 9000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574844482, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img11_25850s.jpg', '/UserFiles/Image/Trial/img11_25850.jpg', 0x4e3b, '1', '37', 0, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '������', '#000000', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(60, 26, '����� Oodjim Ultra 38 ', NULL, NULL, 5590, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574844980, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img5_47325.jpg', '/UserFiles/Image/Trial/img5_47325.jpg', 0x4e3b, '1', '38', 0, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', '', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(61, 26, '����� Oodjim Ultra 39 ', NULL, NULL, 6590, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574844863, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img5_23962s.jpg', '/UserFiles/Image/Trial/img5_23962.jpg', 0x4e3b, '1', '39', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(62, 26, '������ 1001 Dressyy 37 �����', NULL, NULL, 1200, 1350, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574847384, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�����', '#0000ff', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(63, 26, '������ 1001 Dressyy 37 �������', NULL, NULL, 1300, 1350, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574847389, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�������', '#00ffff', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(64, 26, '������ 1001 Dressyy 38 �����', NULL, NULL, 1300, 1350, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574847379, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�����', '#0000ff', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(66, 26, '������ Befreedom 37 �����', NULL, NULL, 2000, 2500, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574847427, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img2_96038.jpg', '/UserFiles/Image/Trial/img2_96038.jpg', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�����', '#0000ff', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(65, 26, '������ 1001 Dressyy 39 �����', NULL, NULL, 1300, 1350, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574847372, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', '39', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�����', '#0000ff', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(67, 26, '������ Befreedom 37 �������', NULL, NULL, 2000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574845785, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img2_95509s.jpg', '/UserFiles/Image/Trial/img2_95509.jpg', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�������', '#00FFFF', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(68, 26, '������ Befreedom 37 �������', NULL, NULL, 2000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574845787, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img2_19797s.jpg', '/UserFiles/Image/Trial/img2_19797.jpg', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�������', '#FF0000', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(69, 26, '������ Befreedom 38 �����', NULL, NULL, 2000, 2500, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574847423, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img2_64554.jpg', '/UserFiles/Image/Trial/img2_64554.jpg', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�����', '#0000ff', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(70, 26, '������ Befreedom 39 �����', NULL, NULL, 2000, 2500, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574847418, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img2_27973.jpg', '/UserFiles/Image/Trial/img2_27973.jpg', 0x4e3b, '1', '39', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�����', '#0000ff', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(71, 26, '������ Concepted Clubs ������� 37', NULL, NULL, 3500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574845997, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img3_56614s.jpg', '/UserFiles/Image/Trial/img3_56614.jpg', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '������', '#f7109b', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(72, 26, '������ Concepted Clubs ����� 38', NULL, NULL, 3500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574845992, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img3_37243s.jpg', '/UserFiles/Image/Trial/img3_37243.jpg', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '������', '#f7109b', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(73, 26, '������ Concepted Clubs 37 �����', NULL, NULL, 5000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846000, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img3_83164s.jpg', '/UserFiles/Image/Trial/img3_83164.jpg', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�����', '#0000FF', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(74, 26, '������ Concepted Clubs 38 �����', NULL, NULL, 5000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574845952, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�����', '#0000FF', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(75, 26, '������ Concepted Clubs 39 �������', NULL, NULL, 3700, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846002, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img3_12202s.jpg', '/UserFiles/Image/Trial/img3_12202.jpg', 0x4e3b, '1', '39', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�������', '#00FFFF', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(76, 26, '������ Concepted Clubs 37 ������', NULL, NULL, 3900, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846003, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img3_93384s.jpg', '/UserFiles/Image/Trial/img3_93384.jpg', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '������', '#FFFF00', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(77, 26, '����� Oodjim 37 �������', NULL, NULL, 600, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846369, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img13_59800s.jpg', '/UserFiles/Image/Trial/img13_59800.jpg', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�������', '#008000', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(78, 26, '����� Oodjim 37 �������', NULL, NULL, 600, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846382, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img13_67547s.jpg', '/UserFiles/Image/Trial/img13_67547.jpg', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�������', '#FFC0CB', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(79, 26, '����� Oodjim 37 ���������', NULL, NULL, 600, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846391, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img13_34252s.jpg', '/UserFiles/Image/Trial/img13_34252.jpg', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '���������', '#c4e6eb', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(87, 26, '�������� Mangoff 38 ��������', NULL, NULL, 800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846560, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '������-�������', '#fcdae7', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(81, 26, '����� Oodjim 39 ��������', NULL, NULL, 600, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846395, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img13_86638s.jpg', '/UserFiles/Image/Trial/img13_86638.jpg', 0x4e3b, '1', '39', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '��������', '#f5cc7e', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(89, 26, '�������� Mangoff 38 �������', NULL, NULL, 800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846581, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�������', '#b6f7f7', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(90, 26, '�������� Mangoff 39 �������', NULL, NULL, 800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846601, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', '39', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�������', '#b6f7f7', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(91, 26, '�������� Springfold 37 ������-�������', NULL, NULL, 800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846801, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img9_63883s.jpg', '/UserFiles/Image/Trial/img9_63883.jpg', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '������-�������', '#c1e2f0', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(92, 26, '�������� Springfold 38 ������-�������', NULL, NULL, 800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846800, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img9_97932s.jpg', '/UserFiles/Image/Trial/img9_97932.jpg', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '������-�������', '#c1e2f0', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(93, 26, '�������� Springfold 39 ������-�������', NULL, NULL, 800, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574846803, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img9_22416s.jpg', '/UserFiles/Image/Trial/img9_22416.jpg', 0x4e3b, '1', '39', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '������-�������', '#e7c1f0', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(94, 26, '���� Mangoff 37 ', NULL, NULL, 5000, 5600, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574847301, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', '37', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', '', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(95, 26, '���� Mangoff 38 ', NULL, NULL, 5000, 5700, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574847296, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', '38', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', '', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(96, 26, '���� Mangoff 39 ', NULL, NULL, 5000, 5600, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574847289, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', '39', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', '', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(97, 26, '���� Mangoff 40 ', NULL, NULL, 5000, 5500, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574847284, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', '40', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', '', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(101, 27, 'Polo Crocsby 38 ������', NULL, NULL, 4500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574849717, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img20_54474s.jpg', '/UserFiles/Image/Trial/img20_54474.jpg', 0x4e3b, '1', 'L', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '������', '#000000', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(100, 27, 'Polo Crocsby 37 ������', NULL, NULL, 4500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574849718, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img20_27253s.jpg', '/UserFiles/Image/Trial/img20_27253.jpg', 0x4e3b, '1', 'XL', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '������', '#000000', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(102, 27, '����� ������� Oliverty M ������', NULL, NULL, 3000, 3700, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574849602, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', 'M', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '������', '#000000', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(103, 27, '����� ������� Oliverty M �����', NULL, NULL, 3000, 3700, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574849699, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img6_42150s.jpg', '/UserFiles/Image/Trial/img6_42150.jpg', 0x4e3b, '1', 'M', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�����', '#ffffff', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(104, 27, '����� ������� Oliverty L ������', NULL, NULL, 3000, 3700, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574849617, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', 'L', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '������', '#000000', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(105, 27, '����� ������� Oliverty XL ������', NULL, NULL, 3000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574849702, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img6_51944s.jpg', '/UserFiles/Image/Trial/img6_51944.jpg', 0x4e3b, '1', 'XL', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '������', '#000000', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(106, 27, '������ Modizy S ', NULL, NULL, 5600, 6000, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574849682, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', 'S', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', '', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(107, 27, '������ Modizy M ', NULL, NULL, 5600, 6000, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574849686, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', 'M', 10, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', '', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(108, 27, '������ Modizy L ', NULL, NULL, 5600, 6000, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574849692, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', 'L', 12, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', '', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(109, 27, '���� S.Oliverty S ', NULL, NULL, 3590, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574849855, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'S', 10, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(110, 27, '���� S.Oliverty M ', NULL, NULL, 3590, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574849859, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'M', 12, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(111, 27, '���� S.Oliverty L ', NULL, NULL, 3590, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574849864, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'L', 11, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(112, 27, '���� S.Oliverty XL ', NULL, NULL, 3590, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574849870, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'XL', 34, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(113, 27, '������� Kustang S ������', NULL, NULL, 6700, 11000, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850036, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img21_35310s.jpg', '/UserFiles/Image/Trial/img21_35310.jpg', 0x4e3b, '1', 'S', 41, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '������', '#000000', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(114, 27, '������� Kustang M �����', NULL, NULL, 6700, 11000, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574969522, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img21_18874s.jpg', '/UserFiles/Image/Trial/img21_18874.jpg', 0x4e3b, '1', 'M', 23, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�����', '#ffffff', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(115, 27, '������� Kustang L �����', NULL, NULL, 6700, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574969526, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img21_52213s.jpg', '/UserFiles/Image/Trial/img21_52213.jpg', 0x4e3b, '1', 'L', 22, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '�����', '#ffffff', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(119, 27, '������� KUSTANG S ', NULL, NULL, 6000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850093, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'S', 3, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(116, 27, '������� Oliverty M ', NULL, NULL, 8000, 13000, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850008, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', 'M', 15, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', '', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(117, 27, '������� Oliverty L ', NULL, NULL, 8000, 13000, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850013, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', 'L', 19, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', '', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(118, 27, '������� Oliverty XL ', NULL, NULL, 8000, 13000, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850018, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', 'XL', 34, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', '', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(120, 27, '������� KUSTANG M ', NULL, NULL, 6000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850097, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'M', 9, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(121, 27, '������� KUSTANG L ', NULL, NULL, 6000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850102, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'L', 93, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(122, 27, '������� Oliverty S ', NULL, NULL, 2500, 3000, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850172, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', 'S', 15, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', '', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(123, 27, '������� Oliverty M ', NULL, NULL, 2500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850152, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'M', 24, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(124, 27, '������� Oliverty L ', NULL, NULL, 2500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850157, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', 'L', 23, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(125, 27, '������� Polambia M ', NULL, NULL, 4690, 7000, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850297, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', 'M', 19, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', '', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(126, 27, '������� Polambia L ', NULL, NULL, 4690, 6700, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850306, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', 'L', 67, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', '', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(127, 27, '������� Polambia XL ', NULL, NULL, 4500, 4900, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850324, '', 1, '', '0', '', '', '', '0', '', '0', '0', 0x4e3b, '1', 'XL', 89, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', '', '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(128, 30, '���� Gans 39 ', NULL, NULL, 8000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850721, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '39', 45, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(129, 30, '���� Gans 40 ', NULL, NULL, 8000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850727, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '40', 34, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(130, 30, '���� Gans 41 ', NULL, NULL, 8000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850733, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '41', 12, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(131, 30, '���� Abibas 39 ', NULL, NULL, 4500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850802, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '39', 18, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(132, 30, '���� Abibas 40 ', NULL, NULL, 4500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850807, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '40', 2, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(133, 30, '���� Abibas 41 ', NULL, NULL, 4500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850811, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '41', 7, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(134, 30, '������� Gans 42 ', NULL, NULL, 8000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850821, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '42', 8, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(135, 30, '������� Gans 43 ', NULL, NULL, 8000, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850827, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '43', 67, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(136, 30, '������� Luma 38 ', NULL, NULL, 6700, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850841, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '38', 19, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(137, 30, '������� Luma 39 ', NULL, NULL, 6700, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850846, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '39', 0, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(138, 30, '������� Luma 40 ', NULL, NULL, 6700, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574850850, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '40', 5, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(139, 28, '���� Mangoff ������� ', NULL, NULL, 4500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574851260, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '�������', 1, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(140, 28, '���� Mangoff ������ ', NULL, NULL, 4500, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574851312, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '������', 91, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL),
(141, 28, '���� Springfold ������� ', NULL, NULL, 3590, 0, '0', '0', '1', '', '0', '', '', 0x4e3b, '0', 1, '0', '', '0', 1574851337, '', 1, '', '0', '', '', '', '0', '', '', '', 0x4e3b, '1', '�������', 18, 0, 0, 0, 0, 0, 'N;', 6, '', '', 0, 0, 0, '', NULL, '0', '', '', '', '0', '0', NULL, NULL, NULL, NULL, NULL, '', '', '2', '', '', '2', '1', '2', '2', 0, 0, '1', NULL);

DROP TABLE IF EXISTS phpshop_promotions;
CREATE TABLE phpshop_promotions (
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
  `statuses` text NOT NULL,
  `products_check` enum('0','1') NOT NULL,
  `products` text NOT NULL,
  `sum_order_check` enum('0','1') NOT NULL,
  `sum_order` int(11) NOT NULL,
  `delivery_method_check` enum('0','1') NOT NULL,
  `delivery_method` int(11) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `block_old_price` enum('0','1') DEFAULT '0',
  `hide_old_price` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_rating_categories;
CREATE TABLE phpshop_rating_categories (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `ids_dir` varchar(255) DEFAULT '',
  `name` varchar(255) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '0',
  `revoting` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_rating_categories VALUES ('1', ',2,,3,,4,,6,,7,,8,,10,,11,,12,', '������', '1', '1');
DROP TABLE IF EXISTS phpshop_rating_charact;
CREATE TABLE phpshop_rating_charact (
  `id_charact` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `num` int(11) DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id_charact`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_rating_charact VALUES ('1', '1', '������� ���', '1', '1');
INSERT INTO phpshop_rating_charact VALUES ('2', '1', '����������������', '2', '1');
INSERT INTO phpshop_rating_charact VALUES ('3', '1', '��������', '3', '1');
DROP TABLE IF EXISTS phpshop_rating_votes;
CREATE TABLE phpshop_rating_votes (
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

DROP TABLE IF EXISTS phpshop_rssgraber;
CREATE TABLE phpshop_rssgraber (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `link` text,
  `day_num` int(1) DEFAULT '1',
  `news_num` mediumint(8) DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '1',
  `start_date` int(16) unsigned DEFAULT '0',
  `end_date` int(16) unsigned DEFAULT '0',
  `last_load` int(16) unsigned DEFAULT '0',
  `servers` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_rssgraber_jurnal;
CREATE TABLE phpshop_rssgraber_jurnal (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` int(15) unsigned DEFAULT '0',
  `link_id` int(11) DEFAULT '0',
  `status` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_search_base;
CREATE TABLE phpshop_search_base (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `uid` varchar(255) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '1',
  `category` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_search_jurnal;
CREATE TABLE phpshop_search_jurnal (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `num` tinyint(32) DEFAULT '0',
  `datas` varchar(11) DEFAULT '',
  `dir` varchar(255) DEFAULT '',
  `cat` tinyint(11) DEFAULT '0',
  `set` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_servers;
CREATE TABLE phpshop_servers (
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
  `currency` int(11) DEFAULT NULL,
  `lang` varchar(32) DEFAULT NULL,
  `admoption` blob,
  `warehouse` int(11) DEFAULT '0',
  `price` enum('1','2','3','4','5') DEFAULT '1',
  `admin` int(11) default 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_shopusers;
CREATE TABLE phpshop_shopusers (
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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_shopusers VALUES ('31', 'test@mail.ru', 'eXF2bDI5MGQ=', '1574888495', 'test@mail.ru', '���� ������', '', '', '+7 (098) 709-86-09', '', '1', '0', '', '', 'a:0:{}', 'a:2:{s:4:"list";a:1:{i:0;a:2:{s:7:"tel_new";s:18:"+7 (098) 709-86-09";s:13:"delivtime_new";s:6:"765765";}}s:4:"main";i:0;}', '0', '1');
INSERT INTO phpshop_shopusers VALUES ('32', 'test@gmail.com', 'NHg1eWU4dGw=', '1575019417', 'test@gmail.com', '����� �������', '', '', '+7 (098) 709-86-09', '', '1', '0', '', '', 'a:0:{}', 'a:2:{s:4:"list";a:1:{i:0;a:2:{s:7:"tel_new";s:18:"+7 (098) 709-86-09";s:13:"delivtime_new";s:4:"� 13";}}s:4:"main";i:0;}', '0', '1');
DROP TABLE IF EXISTS phpshop_shopusers_status;
CREATE TABLE phpshop_shopusers_status (
  `id` tinyint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `discount` float DEFAULT '0',
  `price` enum('1','2','3','4','5') DEFAULT '1',
  `enabled` enum('0','1') DEFAULT '1',
  `cumulative_discount_check` enum('0','1') DEFAULT '0',
  `cumulative_discount` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_shopusers_status VALUES ('1', '�������', '5', '1', '1', '1', 'a:2:{i:0;a:4:{s:17:"cumulative_sum_ot";s:4:"1000";s:17:"cumulative_sum_do";s:4:"5000";s:19:"cumulative_discount";s:1:"5";s:18:"cumulative_enabled";i:1;}i:1;a:4:{s:17:"cumulative_sum_ot";s:4:"2000";s:17:"cumulative_sum_do";s:5:"10000";s:19:"cumulative_discount";s:2:"10";s:18:"cumulative_enabled";i:1;}}');
INSERT INTO phpshop_shopusers_status VALUES ('2', '������� 3', '6', '1', '1', '1', 'a:1:{i:1;a:4:{s:17:"cumulative_sum_ot";s:3:"500";s:17:"cumulative_sum_do";s:4:"2000";s:19:"cumulative_discount";s:2:"40";s:18:"cumulative_enabled";i:1;}}');
INSERT INTO phpshop_shopusers_status VALUES ('3', '������� 2', '30', '1', '0', '0', 'a:2:{i:1;a:4:{s:17:"cumulative_sum_ot";s:3:"500";s:17:"cumulative_sum_do";s:4:"2000";s:19:"cumulative_discount";s:2:"40";s:18:"cumulative_enabled";i:1;}i:2;a:4:{s:17:"cumulative_sum_ot";s:3:"600";s:17:"cumulative_sum_do";s:5:"30000";s:19:"cumulative_discount";s:2:"70";s:18:"cumulative_enabled";i:1;}}');
DROP TABLE IF EXISTS phpshop_slider;
CREATE TABLE phpshop_slider (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT '',
  `enabled` enum('0','1') DEFAULT '0',
  `num` smallint(6) DEFAULT '0',
  `link` varchar(255) DEFAULT '',
  `alt` varchar(255) DEFAULT '',
  `servers` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_slider VALUES ('13', '/UserFiles/Image/Trial/slider2.jpg', '1', '0', '', '', '');
INSERT INTO phpshop_slider VALUES ('16', '/UserFiles/Image/Trial/slider1.jpg', '1', '0', '', '', '');
DROP TABLE IF EXISTS phpshop_sort;
CREATE TABLE phpshop_sort (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `category` int(11) unsigned DEFAULT '0',
  `num` int(11) DEFAULT '0',
  `page` varchar(255) DEFAULT '',
  `icon` varchar(255) DEFAULT '',
  `description` text,
  `sort_seo_name` varchar(255) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_sort VALUES ('1', '������', '2', '1', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('2', '������', '2', '2', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('3', '���', '2', '3', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('4', '����������', '3', '1', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('5', '������������', '3', '2', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('6', '���������', '3', '3', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('7', '�������', '4', '1', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('8', '�������', '4', '2', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('9', '�������', '4', '3', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('10', '��������', '4', '4', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('11', 'Mangoff', '5', '1', '', '/UserFiles/Image/Trial/brand-1.png', '<p>�������� ������ ����������� � ���� ������ - �������������� - �������������� � �������� "�����". � �������� �������������� ��������������, �������� �� ������ ��������, � ������� �� ������ ������������� ������.</p>\n<p><img src="/UserFiles/Image/Trial/brand-1.png" alt="" width="210" height="70" /></p>', 'mangoff', '');
INSERT INTO phpshop_sort VALUES ('12', 'Oodjim', '5', '2', '', '/UserFiles/Image/Trial/brand-2.png', '<p>�������� ������ ����������� � ���� ������ - �������������� - �������������� � �������� "�����". � �������� �������������� ��������������, �������� �� ������ ��������, � ������� �� ������ ������������� ������.</p>\n<p><img src="/UserFiles/Image/Trial/brand-2.png" alt="" width="210" height="70" /></p>', 'oodjim', '');
INSERT INTO phpshop_sort VALUES ('13', '1001 Dressyy', '5', '3', '', '/UserFiles/Image/Trial/brand-3.png', '<p>�������� ������ ����������� � ���� ������ - �������������� - �������������� � �������� "�����". � �������� �������������� ��������������, �������� �� ������ ��������, � ������� �� ������ ������������� ������.</p>\n<p><img src="/UserFiles/Image/Trial/brand-3.png" alt="" width="210" height="70" /></p>', '-1001-dressyy', '');
INSERT INTO phpshop_sort VALUES ('14', 'Befreedom', '5', '4', '', '/UserFiles/Image/Trial/brand-4.png', '<p>�������� ������ ����������� � ���� ������ - �������������� - �������������� � �������� "�����". � �������� �������������� ��������������, �������� �� ������ ��������, � ������� �� ������ ������������� ������.</p>\n<p><img src="/UserFiles/Image/Trial/brand-4.png" alt="" width="210" height="70" /></p>', 'befreedom', '');
INSERT INTO phpshop_sort VALUES ('15', 'Concepted Clubs', '5', '5', '', '/UserFiles/Image/Trial/brand-5.png', '<p>�������� ������ ����������� � ���� ������ - �������������� - �������������� � �������� "�����". � �������� �������������� ��������������, �������� �� ������ ��������, � ������� �� ������ ������������� ������.</p>\n<p><img src="/UserFiles/Image/Trial/brand-5.png" alt="" width="210" height="70" /></p>', 'concepted-clubs', '');
INSERT INTO phpshop_sort VALUES ('16', 'Springfold', '5', '6', '', '/UserFiles/Image/Trial/brand-6.png', '<p>�������� ������ ����������� � ���� ������ - �������������� - �������������� � �������� "�����". � �������� �������������� ��������������, �������� �� ������ ��������, � ������� �� ������ ������������� ������.</p>\n<p><img src="/UserFiles/Image/Trial/brand-6.png" alt="" width="210" height="70" /></p>', 'springfold', '');
INSERT INTO phpshop_sort VALUES ('17', 'Crocsby', '5', '7', '', '/UserFiles/Image/Trial/brand-7.png', '<p>�������� ������ ����������� � ���� ������ - �������������� - �������������� � �������� "�����". � �������� �������������� ��������������, �������� �� ������ ��������, � ������� �� ������ ������������� ������.</p>\n<p><img src="/UserFiles/Image/Trial/brand-7.png" alt="" width="210" height="70" /></p>', 'crocsby', '');
INSERT INTO phpshop_sort VALUES ('18', 'Oliverty', '5', '8', '', '/UserFiles/Image/Trial/brand-8.png', '<p>�������� ������ ����������� � ���� ������ - �������������� - �������������� � �������� "�����". � �������� �������������� ��������������, �������� �� ������ ��������, � ������� �� ������ ������������� ������.</p>\n<p><img src="/UserFiles/Image/Trial/brand-8.png" alt="" width="210" height="70" /></p>', 'oliverty', '');
INSERT INTO phpshop_sort VALUES ('19', 'Modizy', '5', '9', '', '/UserFiles/Image/Trial/brand-9.png', '<p>�������� ������ ����������� � ���� ������ - �������������� - �������������� � �������� "�����". � �������� �������������� ��������������, �������� �� ������ ��������, � ������� �� ������ ������������� ������.</p>\n<p><img src="/UserFiles/Image/Trial/brand-9.png" alt="" width="210" height="70" /></p>', 'modizy', '');
INSERT INTO phpshop_sort VALUES ('20', 'Kustang', '5', '10', '', '/UserFiles/Image/Trial/brand-10.png', '<p>�������� ������ ����������� � ���� ������ - �������������� - �������������� � �������� "�����". � �������� �������������� ��������������, �������� �� ������ ��������, � ������� �� ������ ������������� ������.</p>\n<p><img src="/UserFiles/Image/Trial/brand-10.png" alt="" width="210" height="70" /></p>', 'kustang', '');
INSERT INTO phpshop_sort VALUES ('21', 'Polambia', '5', '11', '', '/UserFiles/Image/Trial/brand-11.png', '<p>�������� ������ ����������� � ���� ������ - �������������� - �������������� � �������� "�����". � �������� �������������� ��������������, �������� �� ������ ��������, � ������� �� ������ ������������� ������.</p>\n<p><img src="/UserFiles/Image/Trial/brand-11.png" alt="" width="210" height="61" /></p>', 'polambia', '');
INSERT INTO phpshop_sort VALUES ('22', '��� ���� ����� ����', '7', '1', '', '', '', '', '');
INSERT INTO phpshop_sort VALUES ('23', '��� ��������������� ����', '7', '2', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('24', '��� ����� � �������������� ����', '7', '3', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('25', '����', '8', '1', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('26', '�����', '8', '2', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('27', '���', '8', '3', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('28', '������', '8', '4', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('29', '������', '9', '1', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('30', '�������', '9', '2', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('31', '�����', '9', '3', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('32', '���', '9', '4', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('33', '�����', '11', '1', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('34', '�������', '11', '2', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('35', '�������', '11', '3', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('36', '������', '11', '4', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('37', '������������������', '12', '1', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('38', '������ ����������', '12', '2', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('39', '������������� �����������', '12', '3', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('40', '������� �����������', '12', '4', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('41', '�����', '13', '1', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('42', '������', '13', '2', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('43', '������', '13', '3', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('44', '�������', '13', '4', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('45', '��� ����������� �������', '12', '5', '', '', '', '', '');
INSERT INTO phpshop_sort VALUES ('46', '��� ����������� �������', '7', '4', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('47', '����', '8', '0', '', '',  NULL, '', '');
INSERT INTO phpshop_sort VALUES ('48', '�����', '13', '0', '', '',  NULL, '', '');

DROP TABLE IF EXISTS phpshop_sort_categories;
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
  `virtual` enum('0','1') DEFAULT '0',
  `yandex_param` enum('1','2') DEFAULT '1',
  `yandex_param_unit` varchar(64) DEFAULT '',
  `servers` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=14 ;


INSERT INTO `phpshop_sort_categories` (`id`, `name`, `num`, `category`, `filtr`, `description`, `goodoption`, `optionname`, `page`, `brand`, `product`, `virtual`, `yandex_param`, `yandex_param_unit`, `servers`) VALUES
(1, '������', 0, 0, '0', '', '0', '0', '', '0', '0', '0', '1', '', ''),
(2, '��������', 4, 1, '1', '', '1', '0', '', '0', '0', '0', '1', '', ''),
(3, '� ����� �� �����', 2, 1, '0', '� ���� ���-�� ����� ����� "������������". �� ������ ���������� ������������� ������ � ���� ������������� �� �������, ������ �������� ���-�� ����� ���������� ������������� ������, ��������� � �������� ������.', '0', '0', '', '0', '1', '0', '1', '', ''),
(4, '���', 3, 1, '1', '', '1', '0', '', '0', '0', '0', '1', '', ''),
(5, '�����', 1, 1, '1', '���� � ��� ��� �������, � �� �� ������ ������ �� � ���� �����, ������ ������� ����� ����� � ���� ��������.', '0', '0', '', '1', '0', '1', '1', '', ''),
(6, '���������', 2, 0, '0', '', '0', '0', '', '0', '0', '0', '1', '', ''),
(7, '��� ����', 1, 6, '1', '', '0', '0', '', '0', '0', '1', '1', '', ''),
(8, '���� ����������', 0, 6, '0', '', '0', '0', '', '0', '0', '0', '1', '', ''),
(9, '������-������������', 3, 6, '1', '', '0', '0', '', '0', '0', '0', '1', '', ''),
(10, '�����������', 4, 0, '0', '', '0', '0', '', '0', '0', '0', '1', '', ''),
(11, '��������', 1, 10, '1', '', '1', '0', '', '0', '0', '0', '1', '', ''),
(12, '����������', 2, 10, '1', '', '0', '0', '', '0', '0', '1', '1', '', ''),
(13, '����', 3, 10, '1', '', '1', '0', '', '0', '0', '0', '1', '', '');


DROP TABLE IF EXISTS phpshop_system;
CREATE TABLE phpshop_system (
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
  `icon` varchar(255) DEFAULT '',
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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_system VALUES ('1', '�������� ��������-��������', '��������', '8', '0', '6', '0', 'lego', 'admin@localhost', '����-������ ������� ��������-�������� PHPShop', '������ ��������, ������ ��������-�������', '6', '8', '8', '&#43;7(495)111-22-33', 'a:12:{s:8:"org_name";s:14:"��� "��������"";s:12:"org_ur_adres";s:41:"000000 �. ������, ��. �����������, ��� 1.";s:9:"org_adres";s:30:"������, ��. ����������, ��� 1.";s:7:"org_inn";s:9:"777777777";s:7:"org_kpp";s:10:"8888888888";s:9:"org_schet";s:16:"1111111111111111";s:8:"org_bank";s:23:"��� "��� �������� ����"";s:7:"org_bic";s:8:"46778888";s:14:"org_bank_schet";s:15:"222222222222222";s:9:"org_stamp";s:32:"/UserFiles/Image/Trial/stamp.png";s:7:"org_sig";s:36:"/UserFiles/Image/Trial/facsimile.png";s:11:"org_sig_buh";s:36:"/UserFiles/Image/Trial/facsimile.png";}', '4', '', '1409661405', '18', '1', 'a:100:{s:12:"sklad_status";s:1:"1";s:13:"cloud_enabled";i:0;s:23:"digital_product_enabled";i:0;s:13:"user_calendar";i:0;s:19:"user_price_activate";i:0;s:22:"user_mail_activate_pre";i:0;s:18:"rss_graber_enabled";i:0;s:17:"image_save_source";i:0;s:6:"img_wm";N;s:5:"img_w";s:4:"1000";s:5:"img_h";s:4:"1000";s:6:"img_tw";s:3:"300";s:6:"img_th";s:3:"300";s:14:"width_podrobno";s:3:"100";s:12:"width_kratko";s:3:"100";s:12:"base_enabled";N;s:11:"sms_enabled";i:0;s:14:"notice_enabled";i:0;s:7:"base_id";s:0:"";s:9:"base_host";s:0:"";s:13:"sklad_enabled";s:1:"1";s:10:"price_znak";s:1:"0";s:18:"user_mail_activate";i:0;s:11:"user_status";s:1:"0";s:9:"user_skin";s:1:"1";s:12:"cart_minimum";s:0:"";s:13:"watermark_big";a:21:{s:14:"big_mergeLevel";i:70;s:11:"big_enabled";s:1:"1";s:8:"big_type";s:3:"png";s:12:"big_png_file";s:30:"/UserFiles/Image/shop_logo.png";s:12:"big_copyFlag";s:1:"0";s:6:"big_sm";i:0;s:16:"big_positionFlag";s:1:"4";s:13:"big_positionX";i:0;s:13:"big_positionY";i:0;s:9:"big_alpha";i:70;s:8:"big_text";s:0:"";s:21:"big_text_positionFlag";i:0;s:8:"big_size";i:0;s:9:"big_angle";i:0;s:18:"big_text_positionX";i:0;s:18:"big_text_positionY";i:0;s:10:"big_colorR";i:0;s:10:"big_colorG";i:0;s:10:"big_colorB";i:0;s:14:"big_text_alpha";i:0;s:8:"big_font";s:16:"norobot_font.ttf";}s:15:"watermark_small";a:21:{s:16:"small_mergeLevel";i:100;s:13:"small_enabled";s:1:"1";s:10:"small_type";s:3:"png";s:14:"small_png_file";s:25:"/UserFiles/Image/logo.png";s:14:"small_copyFlag";s:1:"0";s:8:"small_sm";i:0;s:18:"small_positionFlag";s:1:"1";s:15:"small_positionX";i:0;s:15:"small_positionY";i:0;s:11:"small_alpha";i:50;s:10:"small_text";s:0:"";s:23:"small_text_positionFlag";i:0;s:10:"small_size";i:0;s:11:"small_angle";i:0;s:20:"small_text_positionX";i:0;s:20:"small_text_positionY";i:0;s:12:"small_colorR";i:0;s:12:"small_colorG";i:0;s:12:"small_colorB";i:0;s:16:"small_text_alpha";i:0;s:10:"small_font";s:16:"norobot_font.ttf";}s:15:"watermark_ishod";a:21:{s:16:"ishod_mergeLevel";i:100;s:13:"ishod_enabled";N;s:10:"ishod_type";s:3:"png";s:14:"ishod_png_file";s:0:"";s:14:"ishod_copyFlag";s:1:"0";s:8:"ishod_sm";i:0;s:18:"ishod_positionFlag";s:1:"1";s:15:"ishod_positionX";i:0;s:15:"ishod_positionY";i:0;s:11:"ishod_alpha";i:0;s:10:"ishod_text";s:0:"";s:23:"ishod_text_positionFlag";i:0;s:10:"ishod_size";i:0;s:11:"ishod_angle";i:0;s:20:"ishod_text_positionX";i:0;s:20:"ishod_text_positionY";i:0;s:12:"ishod_colorR";i:0;s:12:"ishod_colorG";i:0;s:12:"ishod_colorB";i:0;s:16:"ishod_text_alpha";i:0;s:10:"ishod_font";s:16:"norobot_font.ttf";}s:14:"nowbuy_enabled";s:1:"2";s:6:"editor";s:7:"tinymce";s:5:"theme";s:7:"default";s:24:"sms_status_order_enabled";i:0;s:17:"mail_smtp_replyto";s:0:"";s:9:"sms_phone";s:0:"";s:8:"sms_user";s:0:"";s:8:"sms_pass";s:0:"";s:8:"sms_name";s:0:"";s:9:"ace_theme";s:4:"dawn";s:9:"adm_title";s:0:"";s:14:"search_enabled";s:1:"3";s:14:"mail_smtp_host";s:0:"";s:14:"mail_smtp_port";s:0:"";s:14:"mail_smtp_user";s:0:"";s:14:"mail_smtp_pass";s:0:"";s:20:"parent_price_enabled";i:0;s:17:"mail_smtp_enabled";i:0;s:15:"mail_smtp_debug";i:0;s:14:"mail_smtp_auth";i:0;s:12:"rule_enabled";i:0;s:15:"catlist_enabled";s:1:"1";s:17:"recaptcha_enabled";s:1:"1";s:14:"recaptcha_pkey";s:0:"";s:14:"recaptcha_skey";s:0:"";s:14:"dadata_enabled";s:1:"1";s:12:"dadata_token";s:0:"";s:21:"multi_currency_search";i:0;s:17:"image_result_path";s:0:"";s:14:"watermark_text";s:8:"YOURLOGO";s:20:"watermark_text_color";s:7:"#cccccc";s:19:"watermark_text_size";s:2:"20";s:19:"watermark_text_font";s:4:"Vera";s:15:"watermark_right";s:2:"20";s:16:"watermark_bottom";s:2:"30";s:20:"watermark_text_alpha";s:2:"40";s:15:"watermark_image";s:0:"";s:21:"image_adaptive_resize";i:0;s:15:"image_save_name";i:0;s:21:"watermark_big_enabled";s:1:"1";s:24:"watermark_source_enabled";i:0;s:17:"yandexmap_enabled";s:1:"1";s:9:"hub_theme";s:23:"bootstrap-theme-default";s:15:"hub_fluid_theme";s:23:"bootstrap-theme-default";s:24:"watermark_center_enabled";i:0;s:19:"filter_cache_period";s:0:"";s:20:"filter_cache_enabled";i:0;s:21:"filter_products_count";s:1:"1";s:12:"promo_notice";b:1;s:15:"image_save_path";i:0;s:11:"new_enabled";i:0;s:12:"chat_enabled";i:0;s:18:"image_save_catalog";i:1;s:23:"watermark_small_enabled";i:0;s:12:"astero_theme";s:20:"bootstrap-theme-blue";s:18:"astero_fluid_theme";s:20:"bootstrap-theme-blue";s:13:"astero_editor";N;s:10:"lego_theme";s:23:"bootstrap-theme-default";s:16:"lego_fluid_theme";s:23:"bootstrap-theme-default";s:11:"lego_editor";a:5:{s:1:"h";i:1;s:1:"f";i:1;s:1:"c";i:1;s:1:"p";i:2;s:1:"s";i:2;}s:13:"metrica_token";s:0:"";s:10:"metrica_id";s:0:"";s:13:"yandex_apikey";s:0:"";s:9:"google_id";s:0:"";s:15:"metrica_enabled";i:0;s:14:"metrica_widget";i:0;s:17:"metrica_ecommerce";i:0;s:14:"google_enabled";i:0;s:16:"google_analitics";i:0;s:4:"lang";s:7:"russian";s:17:"sklad_sum_enabled";s:1:"1";}', '6', 'PHPShop � ��� ������� ������� ��� �������� �������� ��������-��������.', '@Podcatalog@, @Catalog@, @System@', '@Podcatalog@ - @Catalog@ - @System@', '@Podcatalog@, @Catalog@, @Generator@', '@Product@ - @Podcatalog@ - @Catalog@', '@Product@, @Podcatalog@, @Catalog@', '@Product@,@System@', '/UserFiles/Image/Trial/php_logo.svg', '', '@Catalog@ - @System@', '@Catalog@', '@Catalog@', '0', '0', '0', 'a:7:{s:11:"update_name";s:1:"1";s:14:"update_content";s:1:"1";s:18:"update_description";s:1:"1";s:15:"update_category";s:1:"1";s:11:"update_sort";s:1:"1";s:12:"update_price";s:1:"1";s:11:"update_item";s:1:"1";}');
DROP TABLE IF EXISTS phpshop_templates_key;
CREATE TABLE phpshop_templates_key (
  `path` varchar(64) NOT NULL DEFAULT '',
  `date` int(11) DEFAULT '0',
  `key` text,
  `verification` varchar(32) DEFAULT '',
  PRIMARY KEY (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS phpshop_users;
CREATE TABLE phpshop_users (
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

DROP TABLE IF EXISTS phpshop_valuta;
CREATE TABLE phpshop_valuta (
  `id` tinyint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `code` varchar(64) DEFAULT '',
  `iso` varchar(64) DEFAULT '',
  `kurs` varchar(64) DEFAULT '0',
  `num` tinyint(11) DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

INSERT INTO phpshop_valuta VALUES ('4', '������', '���', 'UAH', '0.061', '4', '1');
INSERT INTO phpshop_valuta VALUES ('5', '�������', '$', 'USD', '0.016', '0', '1');
INSERT INTO phpshop_valuta VALUES ('6', '�����', '���.', 'RUB', '1', '1', '1');
DROP TABLE IF EXISTS phpshop_warehouses;
CREATE TABLE phpshop_warehouses (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `uid` varchar(64) DEFAULT NULL,
  `enabled` enum('0','1') DEFAULT '1',
  `num` int(11) DEFAULT NULL,
  `servers` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

DROP TABLE IF EXISTS `phpshop_modules_yandexkassa_system`;
CREATE TABLE IF NOT EXISTS `phpshop_modules_yandexkassa_system` (
  `id` int(11) NOT NULL auto_increment,
  `status` int(11) NOT NULL,
  `title` text NOT NULL,
  `title_end` text NOT NULL,
  `shop_id` varchar(64) NOT NULL default '',
  `api_key` varchar(255) NOT NULL default '',
  `version` varchar(64) DEFAULT '1.5' NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_modules_yandexkassa_system` (`id`, `status`, `title`, `title_end`, `shop_id`, `api_key`, `version`) VALUES
(1, 0, '�������� ������', '�������� ���������� ���� �����', '665601', 'test_IBkYJDzgL1-gaz04YTHNxQekxtaGz6z-7_40u0rRlYs', 1.5);

INSERT INTO `phpshop_payment_systems` (`id`, `name`, `path`, `enabled`, `num`, `message`, `message_header`, `yur_data_flag`, `icon`) VALUES
(10004, '������.�����', 'modules', '0', 0, '', '', '', '/UserFiles/Image/Payments/yandex-money.png');

CREATE TABLE IF NOT EXISTS `phpshop_modules_yandexkassa_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `message` text NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `yandex_id` varchar(255) NULL,
  `status_code` varchar(255) NULL,
  `type` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

CREATE TABLE `phpshop_push` (
  `token` text,
  `date` timestamp DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;
