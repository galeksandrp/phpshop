ALTER TABLE `phpshop_modules_yandexkassa_system` CHANGE `merchant_id` `shop_id` varchar(64) NOT NULL default '';
ALTER TABLE `phpshop_modules_yandexkassa_system` CHANGE `merchant_scid` `api_key` varchar(255) NOT NULL default '';
ALTER TABLE `phpshop_modules_yandexkassa_system` DROP `test`;
ALTER TABLE `phpshop_modules_yandexkassa_system` DROP `merchant_sig`;
ALTER TABLE `phpshop_modules_yandexkassa_system` DROP `pay_variants`;
ALTER TABLE `phpshop_modules_yandexkassa_log` ADD `yandex_id` varchar(255) NULL;
ALTER TABLE `phpshop_modules_yandexkassa_log` ADD `status_code` varchar(255) NULL;