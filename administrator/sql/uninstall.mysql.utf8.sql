DROP TABLE IF EXISTS `#__menu_category`;
DROP TABLE IF EXISTS `#__menu_item`;

DELETE FROM `#__content_types` WHERE (type_alias LIKE 'com_hacha.%');