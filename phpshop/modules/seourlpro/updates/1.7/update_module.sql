ALTER TABLE `phpshop_sort` ADD `sort_seo_name` VARCHAR(255) NOT NULL;
ALTER TABLE `phpshop_modules_seourlpro_system` ADD `seo_brands_enabled` enum('1','2') NOT NULL default '1';

