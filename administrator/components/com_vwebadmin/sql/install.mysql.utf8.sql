CREATE TABLE IF NOT EXISTS `#__vwebadmin_customers` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`related_user_account` INT(11)  NOT NULL ,
`company_name` VARCHAR(255)  NOT NULL ,
`email` VARCHAR(255)  NOT NULL ,
`phone` VARCHAR(255)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__vwebadmin_websites` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`owner` INT NOT NULL ,
`website` VARCHAR(255)  NOT NULL ,
`onderhoud` TINYINT(1)  NOT NULL ,
`hosting` TINYINT(1)  NOT NULL ,
`domein` TINYINT(1)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`cms_guess` INT NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__vwebadmin_website_cms` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`cms` VARCHAR(255)  NOT NULL ,
`description` TEXT NOT NULL ,
`image` VARCHAR(255)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__vwebadmin_website_cms_version` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`cms` INT NOT NULL ,
`version` VARCHAR(255)  NOT NULL ,
`release_date` DATE NOT NULL ,
`changelog` TEXT NOT NULL ,
`changelog_link` VARCHAR(255)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__vwebadmin_maintenance` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`website` INT NOT NULL ,
`package` INT NOT NULL ,
`subscription_start` DATE NOT NULL ,
`subscription_end` DATE NOT NULL ,
`cms` INT NOT NULL ,
`cms_version` INT NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__vwebadmin_maintenance_package` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`package_name` VARCHAR(255)  NOT NULL ,
`package_price` VARCHAR(255)  NOT NULL ,
`package_description` TEXT NOT NULL ,
`update_frequency` VARCHAR(2)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__vwebadmin_hosting` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`website` INT NOT NULL ,
`package` INT NOT NULL ,
`subscription_start` DATE NOT NULL ,
`subscription_end` DATE NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__vwebadmin_hosting_package` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`package_name` VARCHAR(255)  NOT NULL ,
`package_price` VARCHAR(255)  NOT NULL ,
`package_description` TEXT NOT NULL ,
`package_link` VARCHAR(255)  NOT NULL ,
`bandwidth` VARCHAR(5)  NOT NULL ,
`storage` VARCHAR(5)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__vwebadmin_domains` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`website` INT NOT NULL ,
`subscription_start` DATE NOT NULL ,
`subscription_end` DATE NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT COLLATE=utf8mb4_unicode_ci;


INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Klant','com_vwebadmin.klant','{"special":{"dbtable":"#__vwebadmin_customers","key":"id","type":"Klant","prefix":"VwebadminTable"}}', '{"formFile":"administrator\/components\/com_vwebadmin\/models\/forms\/klant.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_vwebadmin.klant')
) LIMIT 1;

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Website','com_vwebadmin.website','{"special":{"dbtable":"#__vwebadmin_websites","key":"id","type":"Website","prefix":"VwebadminTable"}}', '{"formFile":"administrator\/components\/com_vwebadmin\/models\/forms\/website.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"owner","targetTable":"#__vwebadmin_customers","targetColumn":"related_user_account","displayColumn":"company_name"},{"sourceColumn":"cms_guess","targetTable":"#__vwebadmin_website_cms","targetColumn":"id","displayColumn":"cms"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_vwebadmin.website')
) LIMIT 1;

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'CMS Type','com_vwebadmin.cmstype','{"special":{"dbtable":"#__vwebadmin_website_cms","key":"id","type":"Cmstype","prefix":"VwebadminTable"}}', '{"formFile":"administrator\/components\/com_vwebadmin\/models\/forms\/cmstype.xml", "hideFields":["checked_out","checked_out_time","params","language" ,"description"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_vwebadmin.cmstype')
) LIMIT 1;

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'CMS Versie','com_vwebadmin.cmsversie','{"special":{"dbtable":"#__vwebadmin_website_cms_version","key":"id","type":"Cmsversie","prefix":"VwebadminTable"}}', '{"formFile":"administrator\/components\/com_vwebadmin\/models\/forms\/cmsversie.xml", "hideFields":["checked_out","checked_out_time","params","language" ,"changelog"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"cms","targetTable":"#__vwebadmin_website_cms","targetColumn":"id","displayColumn":"cms"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_vwebadmin.cmsversie')
) LIMIT 1;

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Onderhoud','com_vwebadmin.onderhoud','{"special":{"dbtable":"#__vwebadmin_maintenance","key":"id","type":"Onderhoud","prefix":"VwebadminTable"}}', '{"formFile":"administrator\/components\/com_vwebadmin\/models\/forms\/onderhoud.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"website","targetTable":"#__vwebadmin_websites","targetColumn":"id","displayColumn":"website"},{"sourceColumn":"package","targetTable":"#__vwebadmin_maintenance_package","targetColumn":"id","displayColumn":"package_name"},{"sourceColumn":"cms","targetTable":"#__vwebadmin_website_cms","targetColumn":"id","displayColumn":"cms"},{"sourceColumn":"cms_version","targetTable":"#__vwebadmin_website_cms_version","targetColumn":"id","displayColumn":"version"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_vwebadmin.onderhoud')
) LIMIT 1;

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'onderhoudspakket','com_vwebadmin.onderhoudspakket','{"special":{"dbtable":"#__vwebadmin_maintenance_package","key":"id","type":"Onderhoudspakket","prefix":"VwebadminTable"}}', '{"formFile":"administrator\/components\/com_vwebadmin\/models\/forms\/onderhoudspakket.xml", "hideFields":["checked_out","checked_out_time","params","language" ,"package_description"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_vwebadmin.onderhoudspakket')
) LIMIT 1;

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Hosting','com_vwebadmin.hosting','{"special":{"dbtable":"#__vwebadmin_hosting","key":"id","type":"Hosting","prefix":"VwebadminTable"}}', '{"formFile":"administrator\/components\/com_vwebadmin\/models\/forms\/hosting.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"website","targetTable":"#__vwebadmin_websites","targetColumn":"id","displayColumn":"website"},{"sourceColumn":"package","targetTable":"#__vwebadmin_hosting_package","targetColumn":"id","displayColumn":"package_name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_vwebadmin.hosting')
) LIMIT 1;

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Pakket','com_vwebadmin.pakket','{"special":{"dbtable":"#__vwebadmin_hosting_package","key":"id","type":"Pakket","prefix":"VwebadminTable"}}', '{"formFile":"administrator\/components\/com_vwebadmin\/models\/forms\/pakket.xml", "hideFields":["checked_out","checked_out_time","params","language" ,"package_description"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_vwebadmin.pakket')
) LIMIT 1;

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Domein','com_vwebadmin.domein','{"special":{"dbtable":"#__vwebadmin_domains","key":"id","type":"Domein","prefix":"VwebadminTable"}}', '{"formFile":"administrator\/components\/com_vwebadmin\/models\/forms\/domein.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"website","targetTable":"#__vwebadmin_websites","targetColumn":"id","displayColumn":"website"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_vwebadmin.domein')
) LIMIT 1;
