DROP TABLE IF EXISTS `#__vwebadmin_customers`;
DROP TABLE IF EXISTS `#__vwebadmin_websites`;
DROP TABLE IF EXISTS `#__vwebadmin_website_cms`;
DROP TABLE IF EXISTS `#__vwebadmin_website_cms_version`;
DROP TABLE IF EXISTS `#__vwebadmin_maintenance`;
DROP TABLE IF EXISTS `#__vwebadmin_maintenance_package`;
DROP TABLE IF EXISTS `#__vwebadmin_hosting`;
DROP TABLE IF EXISTS `#__vwebadmin_hosting_package`;
DROP TABLE IF EXISTS `#__vwebadmin_domains`;

DELETE FROM `#__content_types` WHERE (type_alias LIKE 'com_vwebadmin.%');