
CREATE TABLE `bac_rquotes` LIKE `#__rquotes`;
INSERT INTO `bac_rquotes` SELECT * FROM `#__rquotes`;
DROP TABLE IF EXISTS  `#__rquotes`;
DROP TABLE IF EXISTS `#__rquotes_meta`;
DROP TABLE IF EXISTS `#__rquotes_categories`;