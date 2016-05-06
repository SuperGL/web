/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : supgl

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-05-06 13:41:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for gl_menu
-- ----------------------------
DROP TABLE IF EXISTS `gl_menu`;
CREATE TABLE `gl_menu` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` varchar(20) DEFAULT NULL,
  `m_pid` int(11) DEFAULT '0',
  `m_type` varchar(20) DEFAULT NULL,
  `m_attr` varchar(100) DEFAULT NULL,
  `m_state` tinyint(1) DEFAULT '1' COMMENT '1未提交到微信2提交到微信',
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gl_menu
-- ----------------------------
INSERT INTO `gl_menu` VALUES ('1', '英雄联盟', '0', 'click', 'yingxionglianm', '1');
INSERT INTO `gl_menu` VALUES ('2', '123123', '0', 'view', '1231', '1');
