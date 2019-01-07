CREATE TABLE IF NOT EXISTS `#__rquotes`
(
  `id` int(11) NOT NULL auto_increment,
  `catid` int(11) NOT NULL,
  `quote` text NOT NULL,
  `author` text NOT NULL,
  `categorey`text NOT NULL,
  `notes` text NOT NULL,
  `published` tinyint(1) unsigned NOT NULL default '0',
   PRIMARY KEY  (`id`)
);


ALTER TABLE `#__rquotes` CHANGE `catid` `daily_number`  int(11) NOT NULL;
ALTER TABLE `#__rquotes` ADD COLUMN `catid`  int(11) NOT NULL;
ALTER TABLE `#__rquotes` ADD COLUMN `checked_out`  int(11) NOT NULL;
ALTER TABLE `#__rquotes` ADD COLUMN `ordering`  int(11) NOT NULL;
#--ALTER TABLE `#__rquotes` DROP COLUMN `category` ;

#RENAME TABLE  `#__rquotes_categories` TO `bac_rquotes_categories`;   
  
DROP TABLE IF EXISTS `#__rquotes_meta`;

CREATE TABLE `#__rquotes_meta` (
  `id` int(11) NOT NULL DEFAULT '0',
  `number_reached` mediumint(9) NOT NULL DEFAULT '0',
  `date_modified` mediumint(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



--
-- Dumping data for table `#__rquotes_meta`
--

INSERT INTO `#__rquotes_meta` (`id`, `number_reached`, `date_modified`) VALUES
(1, 1, 1);
