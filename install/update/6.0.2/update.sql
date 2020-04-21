ALTER TABLE `phpshop_categories` CHANGE `num_row` `num_row` ENUM( '1', '2', '3', '4', '5' );
ALTER TABLE `phpshop_parent_name` ADD `color` VARCHAR(255);
ALTER TABLE `phpshop_orders` ADD `servers` int(11) default 0;
ALTER TABLE `phpshop_servers` ADD `admin` int(11) default 0;