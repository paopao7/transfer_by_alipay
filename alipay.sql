/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50635
 Source Host           : localhost
 Source Database       : alipay

 Target Server Type    : MySQL
 Target Server Version : 50635
 File Encoding         : utf-8

 Date: 01/02/2018 22:29:00 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `think_order`
-- ----------------------------
DROP TABLE IF EXISTS `think_order`;
CREATE TABLE `think_order` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `out_trade_no` varchar(255) DEFAULT '' COMMENT '订单号',
  `payee_account` varchar(255) DEFAULT '' COMMENT '收款方账号',
  `amount` float(30,2) DEFAULT '0.00' COMMENT '支付金额',
  `has_notify` int(1) DEFAULT '0' COMMENT '是否回调(0:未回调 1:已回调)',
  `create_time` int(30) DEFAULT '0' COMMENT '创建时间戳',
  `update_time` int(30) DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
