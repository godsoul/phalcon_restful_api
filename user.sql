/*
Navicat MySQL Data Transfer

Source Server         : 83
Source Server Version : 50623
Source Host           : 192.168.0.83:3306
Source Database       : sama

Target Server Type    : MYSQL
Target Server Version : 50623
File Encoding         : 65001

Date: 2016-01-11 16:49:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) DEFAULT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `salt` char(5) NOT NULL,
  `gender` tinyint(1) DEFAULT NULL COMMENT '性别 1：男、2：女',
  `nickname` varchar(50) NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否已激活 1：激活、0：未激活',
  `ctime` int(11) unsigned NOT NULL COMMENT '注册时间',
  `is_del` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '是否禁用，0不禁用，1：禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
