/*
 Navicat MySQL Data Transfer

 Source Server         : mariadb
 Source Server Version : 50505
 Source Host           : 192.168.99.100
 Source Database       : wx

 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 02/08/2017 21:45:00 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `wx_article`
-- ----------------------------
DROP TABLE IF EXISTS `wx_article`;
CREATE TABLE `wx_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL,
  `author` char(50) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `dateline` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `wx_comment`
-- ----------------------------
DROP TABLE IF EXISTS `wx_comment`;
CREATE TABLE `wx_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `ask` varchar(30) NOT NULL,
  `answer` varchar(30) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `wx_user`
-- ----------------------------
DROP TABLE IF EXISTS `wx_user`;
CREATE TABLE `wx_user` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `username` char(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `identity` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
