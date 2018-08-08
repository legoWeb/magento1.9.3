<?php
/**
 * @var Mage_Core_Model_Resource_Setup $installer
 */
$installer = $this;
$installer->startSetup();
$installer->run("
CREATE TABLE `{$this->getTable('blog/block')}` (
  `request_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `blog_status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `{$this->getTable('blog/category')}` (
    `request_id` int(11) NOT NULL auto_increment,
    `name` varchar(255) NOT NULL,
    `description` text,
    `image` varchar(255) default NULL,
    PRIMARY KEY  (`request_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
");
$installer->endSetup();