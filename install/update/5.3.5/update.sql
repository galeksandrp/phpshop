ALTER TABLE `phpshop_delivery` ADD `servers` varchar(64) default '';
ALTER TABLE `phpshop_orders` ADD `tracking` varchar(64) default '';
ALTER TABLE `phpshop_rssgraber` ADD `servers` varchar(64) default '';
ALTER TABLE `phpshop_baners` ADD `dop_cat` varchar(255) default '';
ALTER TABLE `phpshop_baners` ADD `servers` varchar(64) default '';
ALTER TABLE `phpshop_payment_systems` ADD `color` varchar(64) default '#000000';
ALTER TABLE `phpshop_system` CHANGE `width_icon` `icon` varchar(255) default ''; 