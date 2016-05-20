CREATE TABLE IF NOT EXISTS `#__menu_category` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`title` TEXT NOT NULL ,
`alias` VARCHAR(255) COLLATE utf8_bin NOT NULL ,
`image` TEXT NOT NULL ,
`title_en` TEXT NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__menu_item` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`title` TEXT NOT NULL ,
`title_en` TEXT NOT NULL ,
`category_id` TEXT NOT NULL ,
`image` TEXT NOT NULL ,
`text` TEXT NOT NULL ,
`price` INT(11)  NOT NULL ,
`weight` INT(11)  NOT NULL ,
`text_en` TEXT NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;


INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Category','com_hacha.category','{"special":{"dbtable":"#__menu_category","key":"id","type":"Category","prefix":"Hacha MenuTable"}}', '{"formFile":"administrator\/components\/com_hacha\/models\/forms\/category.xml", "hideFields":["checked_out","checked_out_time","params","language" ,"image"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_hacha.category')
) LIMIT 1;

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Item','com_hacha.item','{"special":{"dbtable":"#__menu_item","key":"id","type":"Item","prefix":"Hacha MenuTable"}}', '{"formFile":"administrator\/components\/com_hacha\/models\/forms\/item.xml", "hideFields":["checked_out","checked_out_time","params","language" ,"image"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_hacha.item')
) LIMIT 1;
