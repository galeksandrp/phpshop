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
(1, 'Телефоны'),
(2, 'Аудио и видео'),
(3, 'Товары для компьютера'),
(4, 'Фототехника'),
(5, 'Игры, приставки и программы'),
(6, 'Оргтехника и расходники'),
(7, 'Планшеты и электронные книги'),
(8, 'Ноутбуки'),
(9, 'Настольные компьютеры');

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
(32, 'Другие марки', 1),
(33, 'Рации', 1),
(34, 'Стационарные телефоны', 1),
(35, 'MP3-плееры', 2),
(36, 'Акустика, колонки, сабвуферы', 2),
(37, 'Видео, DVD и Blu-ray плееры', 2),
(38, 'Видеокамеры', 2),
(39, 'Кабели и адаптеры', 2),
(40, 'Микрофоны', 2),
(41, 'Музыка и фильмы', 2),
(42, 'Музыкальные центры, магнитолы', 2),
(43, 'Наушники', 2),
(44, 'Телевизоры и проекторы', 2),
(45, 'Усилители и ресиверы', 2),
(46, 'Аксессуары', 2),
(47, 'Акустика', 3),
(48, 'Веб-камеры', 3),
(49, 'Джойстики и рули', 3),
(50, 'Клавиатуры и мыши', 3),
(51, 'Комплектующие', 3),
(52, 'Мониторы', 3),
(53, 'Переносные жёсткие диски', 3),
(54, 'Сетевое оборудование', 3),
(55, 'ТВ-тюнеры', 3),
(56, 'Флэшки и карты памяти', 3),
(57, 'Аксессуары', 3),
(58, 'Компактные фотоаппараты', 4),
(59, 'Зеркальные фотоаппараты', 4),
(60, 'Плёночные фотоаппараты', 4),
(61, 'Бинокли и телескопы', 4),
(62, 'Объективы', 4),
(63, 'Оборудование и аксессуары', 4),
(64, 'Игровые приставки', 5),
(65, 'Игры для приставок', 5),
(66, 'Компьютерные игры', 5),
(67, 'Программы', 5),
(68, 'МФУ, копиры и сканеры', 6),
(69, 'Принтеры', 6),
(70, 'Телефония', 6),
(71, 'ИБП, сетевые фильтры', 6),
(72, 'Уничтожители бумаг', 6),
(73, 'Расходные бумаги', 6),
(74, 'Канцелярия', 6),
(75, 'Планшеты', 7),
(76, 'Электронные книги', 7),
(77, 'Аксессуары', 7),
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
(94, 'Другой', 8);

ALTER TABLE `phpshop_products` ADD `condition_avito` varchar(64) DEFAULT 'Новое';
ALTER TABLE `phpshop_products` ADD `export_avito` enum('0','1') DEFAULT '0';
ALTER TABLE `phpshop_products` ADD `name_avito` varchar(255) DEFAULT '';
ALTER TABLE `phpshop_products` ADD `listing_fee_avito` varchar(64) DEFAULT 'Package';
ALTER TABLE `phpshop_products` ADD `ad_status_avito` varchar(64) DEFAULT 'Free';
ALTER TABLE `phpshop_categories` ADD `category_avito` int(11) DEFAULT NULL;
ALTER TABLE `phpshop_categories` ADD `type_avito` int(11) DEFAULT NULL;
  