DROP TABLE IF EXISTS `phpshop_modules_avito_system`;
CREATE TABLE `phpshop_modules_avito_system` (
  `id` int(11) NOT NULL auto_increment,
  `password` varchar(64),
  `manager` varchar(255),
  `phone` varchar(64),
  `version` varchar(64) default '1.0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_modules_avito_system` VALUES (1,'', '', '', '1.0');

DROP TABLE IF EXISTS `phpshop_modules_avito_categories`;
CREATE TABLE `phpshop_modules_avito_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_modules_avito_categories` (`id`, `name`) VALUES
(1, '��������'),
(2, '����� � �����'),
(3, '������ ��� ����������'),
(4, '�����������'),
(5, '����, ��������� � ���������'),
(6, '���������� � ����������'),
(7, '�������� � ����������� �����'),
(8, '��������'),
(9, '���������� ����������');

DROP TABLE IF EXISTS `phpshop_modules_avito_types`;
CREATE TABLE `phpshop_modules_avito_types` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64),
  `category_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_modules_avito_types` (`id`, `name`, `category_id`) VALUES
(1, 'Acer', 1),
(2, 'Alcatel', 1),
(3, 'ASUS', 1),
(4, 'BlackBerry', 1),
(5, 'BQ', 1),
(6, 'DEXP', 1),
(7, 'Explay', 1),
(8, 'Fly', 1),
(9, 'Highscreen', 1),
(10, 'HTC', 1),
(11, 'Huawei', 1),
(12, 'iPhone', 1),
(13, 'Lenovo', 1),
(14, 'LG', 1),
(15, 'Meizu', 1),
(16, 'Micromax', 1),
(17, 'Microsoft', 1),
(18, 'Motorola', 1),
(19, 'MTS', 1),
(20, 'Nokia', 1),
(21, 'Panasonic', 1),
(22, 'Philips', 1),
(23, 'Prestigio', 1),
(24, 'Samsung', 1),
(25, 'Siemens', 1),
(26, 'SkyLink', 1),
(27, 'Sony', 1),
(28, 'teXet', 1),
(29, 'Vertu', 1),
(30, 'Xiaomi', 1),
(31, 'ZTE', 1),
(32, '������ �����', 1),
(33, '�����', 1),
(34, '������������ ��������', 1),
(35, 'MP3-������', 2),
(36, '��������, �������, ���������', 2),
(37, '�����, DVD � Blu-ray ������', 2),
(38, '�����������', 2),
(39, '������ � ��������', 2),
(40, '���������', 2),
(41, '������ � ������', 2),
(42, '����������� ������, ���������', 2),
(43, '��������', 2),
(44, '���������� � ���������', 2),
(45, '��������� � ��������', 2),
(46, '����������', 2),
(47, '��������', 3),
(48, '���-������', 3),
(49, '��������� � ����', 3),
(50, '���������� � ����', 3),
(51, '�������������', 3),
(52, '��������', 3),
(53, '���������� ������ �����', 3),
(54, '������� ������������', 3),
(55, '��-������', 3),
(56, '������ � ����� ������', 3),
(57, '����������', 3),
(58, '���������� ������������', 4),
(59, '���������� ������������', 4),
(60, '�������� ������������', 4),
(61, '������� � ���������', 4),
(62, '���������', 4),
(63, '������������ � ����������', 4),
(64, '������� ���������', 5),
(65, '���� ��� ���������', 5),
(66, '������������ ����', 5),
(67, '���������', 5),
(68, '���, ������ � �������', 6),
(69, '��������', 6),
(70, '���������', 6),
(71, '���, ������� �������', 6),
(72, '������������ �����', 6),
(73, '��������� ������', 6),
(74, '����������', 6),
(75, '��������', 7),
(76, '����������� �����', 7),
(77, '����������', 7),
(78, 'Acer', 8),
(79, 'Apple', 8),
(80, 'ASUS', 8),
(81, 'Compaq', 8),
(82, 'Dell', 8),
(83, 'Fujitsu', 8),
(84, 'HP', 8),
(85, 'Huawei', 8),
(86, 'Lenovo', 8),
(87, 'MSI', 8),
(88, 'Packard Bell', 8),
(89, 'Microsoft', 8),
(90, 'Samsung', 8),
(91, 'Sony', 8),
(92, 'Toshiba', 8),
(93, 'Xiaomi', 8),
(94, '������', 8);

ALTER TABLE `phpshop_products` ADD `condition_avito` varchar(64) DEFAULT '�����';
ALTER TABLE `phpshop_products` ADD `export_avito` enum('0','1') DEFAULT '0';
ALTER TABLE `phpshop_products` ADD `name_avito` varchar(255) DEFAULT '';
ALTER TABLE `phpshop_products` ADD `listing_fee_avito` varchar(64) DEFAULT 'Package';
ALTER TABLE `phpshop_products` ADD `ad_status_avito` varchar(64) DEFAULT 'Free';
ALTER TABLE `phpshop_categories` ADD `category_avito` int(11) DEFAULT NULL;
ALTER TABLE `phpshop_categories` ADD `type_avito` int(11) DEFAULT NULL;
  