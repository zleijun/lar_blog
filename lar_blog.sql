/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : lar_blog

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-06-23 18:36:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `lav_admins`
-- ----------------------------
DROP TABLE IF EXISTS `lav_admins`;
CREATE TABLE `lav_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `is_super` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0:不是超级管理员  1：是超级管理员',
  `status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '0:禁用  1：正常',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lav_admins
-- ----------------------------
INSERT INTO `lav_admins` VALUES ('1', 'admin', '123456', 'admin', '389843954@qq.com', '1', '1', '2018-06-13 22:06:39', '2018-06-17 15:08:01', null);

-- ----------------------------
-- Table structure for `lav_articles`
-- ----------------------------
DROP TABLE IF EXISTS `lav_articles`;
CREATE TABLE `lav_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `tags` varchar(50) NOT NULL COMMENT '标签',
  `member_id` int(11) NOT NULL COMMENT '发布人ID',
  `cate_id` int(11) NOT NULL COMMENT '栏目ID',
  `desc` text COMMENT '简介',
  `content` longtext COMMENT '内容',
  `is_top` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0:不推荐  1：推荐',
  `status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '0:不显示  1：显示',
  `comm_num` int(11) NOT NULL DEFAULT '0' COMMENT '评论量',
  `click` int(11) NOT NULL DEFAULT '0' COMMENT '点击量',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `lav_cates`
-- ----------------------------
DROP TABLE IF EXISTS `lav_cates`;
CREATE TABLE `lav_cates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catename` varchar(20) NOT NULL,
  `sort` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `lav_comments`
-- ----------------------------
DROP TABLE IF EXISTS `lav_comments`;
CREATE TABLE `lav_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `article_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `lav_members`
-- ----------------------------
DROP TABLE IF EXISTS `lav_members`;
CREATE TABLE `lav_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `is_super` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0:不是会员  1：是会员',
  `status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '0:禁用  1：正常',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `lav_systems`
-- ----------------------------
DROP TABLE IF EXISTS `lav_systems`;
CREATE TABLE `lav_systems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webname` varchar(50) NOT NULL COMMENT '网站名称',
  `copyright` varchar(50) NOT NULL COMMENT '版权',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lav_systems
-- ----------------------------
INSERT INTO `lav_systems` VALUES ('1', 'Geeker程序员爱好者', 'www.zljun.cn', '2018-06-21 21:13:26', '2018-06-23 10:49:34', null);
