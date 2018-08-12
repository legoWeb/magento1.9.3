<?php
/**
 * @var Mage_Core_Model_Resource_Setup $installer
 */
$installer = $this;
$installer->startSetup();
$installer->run("
CREATE TABLE `{$this->getTable('blog/block')}` (
  `request_id` int(11) NOT NULL AUTO INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `blog_status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime  NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `{blog/block}` (`request_id`, `name`, `content`, `short_description`, `blog_status`, `created_at`, `updated_at`) VALUES
(1, 'human', 'to be or not to be', 'gamlet', 1, '2018-08-11 23:07:16', NULL),
(2, 'animal', 'lorem ipsum bla bla bla', 'short bla', 1, '2018-08-11 23:09:02', NULL);

CREATE TABLE `{$this->getTable('blog/category')}` (
  `request_id` int(11) NOT NULL AUTO INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` int(11) NULL REFERENCES `blog_post` (request_Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
    
");
$installer->endSetup();