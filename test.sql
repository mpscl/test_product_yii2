/*
 Navicat Premium Data Transfer

 Source Server         : products.local
 Source Server Type    : MySQL
 Source Server Version : 80017
 Source Host           : products.local
 Source Database       : test

 Target Server Type    : MySQL
 Target Server Version : 80017
 File Encoding         : utf-8

 Date: 08/30/2019 19:32:02 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `ad`
-- ----------------------------
DROP TABLE IF EXISTS `ad`;
CREATE TABLE `ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `part_number` varchar(255) NOT NULL,
  `type_id` int(11) unsigned NOT NULL,
  `display_image` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `seller` varchar(255) DEFAULT NULL,
  `condition` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `ad`
-- ----------------------------
BEGIN;
INSERT INTO `ad` VALUES ('1', '123123', '1', 'Screenshot 2019-08-18 23.13.05.png', '12', '12', '12', '12', '12'), ('2', '123123', '1', 'Screenshot 2019-08-18 23.13.05.png', '12', '12', '12', '12', '12'), ('3', '123123', '1', 'Screenshot 2019-08-18 23.13.05.png', '12', '12', '12', '12', '12'), ('4', '123123', '1', 'Screenshot 2019-08-18 23.13.05.png', '12', '12', '12', '12', '12'), ('5', '123123', '1', 'Screenshot 2019-08-18 23.13.05.png', '12', '12', '12', '12', '12'), ('6', '123123', '1', 'Screenshot 2019-08-18 23.13.05.png', '12', '12', '12', '12', '12'), ('7', '123123', '1', 'Screenshot 2019-08-18 23.13.05.png', '12', '12', '12', '12', '12'), ('8', '123123', '1', 'Screenshot 2019-08-18 23.13.05.png', '12', '12', '12', '12', '12');
COMMIT;

-- ----------------------------
--  Table structure for `ad_to_category`
-- ----------------------------
DROP TABLE IF EXISTS `ad_to_category`;
CREATE TABLE `ad_to_category` (
  `ad_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ad_id`,`category_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `ad_to_tag_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `ad` (`id`),
  CONSTRAINT `ad_to_tag_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `ad_to_category`
-- ----------------------------
BEGIN;
INSERT INTO `ad_to_category` VALUES ('6', '1'), ('7', '1'), ('8', '1');
COMMIT;

-- ----------------------------
--  Table structure for `ad_to_manufacturer`
-- ----------------------------
DROP TABLE IF EXISTS `ad_to_manufacturer`;
CREATE TABLE `ad_to_manufacturer` (
  `ad_id` int(10) unsigned NOT NULL,
  `manufacturer_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ad_id`,`manufacturer_id`),
  KEY `manufacturer_id` (`manufacturer_id`),
  CONSTRAINT `ad_to_manufacturer_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `ad` (`id`),
  CONSTRAINT `ad_to_manufacturer_ibfk_2` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `ad_to_manufacturer`
-- ----------------------------
BEGIN;
INSERT INTO `ad_to_manufacturer` VALUES ('7', '1'), ('8', '1');
COMMIT;

-- ----------------------------
--  Table structure for `ad_type`
-- ----------------------------
DROP TABLE IF EXISTS `ad_type`;
CREATE TABLE `ad_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `ad_type`
-- ----------------------------
BEGIN;
INSERT INTO `ad_type` VALUES ('1', 'Sell'), ('2', 'Buy');
COMMIT;

-- ----------------------------
--  Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `category`
-- ----------------------------
BEGIN;
INSERT INTO `category` VALUES ('1', 'Category 1'), ('2', 'Category 2'), ('3', 'Man 1');
COMMIT;

-- ----------------------------
--  Table structure for `manufacturer`
-- ----------------------------
DROP TABLE IF EXISTS `manufacturer`;
CREATE TABLE `manufacturer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `manufacturer`
-- ----------------------------
BEGIN;
INSERT INTO `manufacturer` VALUES ('1', 'Man 1'), ('2', 'Man 2');
COMMIT;

-- ----------------------------
--  Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `migration`
-- ----------------------------
BEGIN;
INSERT INTO `migration` VALUES ('m000000_000000_base', '1567176548'), ('m190827_030016_01_create_table_product', '1567176550');
COMMIT;

-- ----------------------------
--  Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `part_number` varchar(255) NOT NULL,
  `type_id` int(11) unsigned NOT NULL,
  `display_image` varchar(255) DEFAULT NULL,
  `reference_id` int(11) unsigned NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `product`
-- ----------------------------
BEGIN;
INSERT INTO `product` VALUES ('1', '123', '123', 'shawn-ang-1059163-unsplash.jpg', '123', '1233', '123'), ('2', '123', '123', 'shawn-ang-1059163-unsplash.jpg', '123', '1233', '123'), ('6', '123', '1', 'shawn-ang-1059163-unsplash.jpg', '123', 'Test', 'Test'), ('7', '12', '1', 'Screenshot 2019-08-18 23.13.05.png', '12', '12', '12');
COMMIT;

-- ----------------------------
--  Table structure for `product_to_ad`
-- ----------------------------
DROP TABLE IF EXISTS `product_to_ad`;
CREATE TABLE `product_to_ad` (
  `product_id` int(10) unsigned NOT NULL,
  `ad_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`ad_id`),
  KEY `ad_id` (`ad_id`),
  CONSTRAINT `ad_to_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `ad_to_product_ibfk_2` FOREIGN KEY (`ad_id`) REFERENCES `ad` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `product_to_ad`
-- ----------------------------
BEGIN;
INSERT INTO `product_to_ad` VALUES ('7', '8');
COMMIT;

-- ----------------------------
--  Table structure for `product_to_category`
-- ----------------------------
DROP TABLE IF EXISTS `product_to_category`;
CREATE TABLE `product_to_category` (
  `product_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `post_to_tag_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `post_to_tag_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `product_to_category`
-- ----------------------------
BEGIN;
INSERT INTO `product_to_category` VALUES ('2', '1'), ('6', '2'), ('7', '2');
COMMIT;

-- ----------------------------
--  Table structure for `product_to_manufacturer`
-- ----------------------------
DROP TABLE IF EXISTS `product_to_manufacturer`;
CREATE TABLE `product_to_manufacturer` (
  `product_id` int(10) unsigned NOT NULL,
  `manufacturer_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`manufacturer_id`),
  KEY `manufacturer_id` (`manufacturer_id`),
  CONSTRAINT `post_to_manufacturer_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `post_to_manufacturer_ibfk_2` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `product_to_manufacturer`
-- ----------------------------
BEGIN;
INSERT INTO `product_to_manufacturer` VALUES ('7', '1');
COMMIT;

-- ----------------------------
--  Table structure for `reference`
-- ----------------------------
DROP TABLE IF EXISTS `reference`;
CREATE TABLE `reference` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `reference`
-- ----------------------------
BEGIN;
INSERT INTO `reference` VALUES ('1', 'Aliases'), ('2', 'Model Number'), ('3', 'Configuration Number'), ('4', 'Build Number');
COMMIT;

-- ----------------------------
--  Table structure for `type`
-- ----------------------------
DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `type`
-- ----------------------------
BEGIN;
INSERT INTO `type` VALUES ('1', 'Orderable'), ('2', 'Non-orderable');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
