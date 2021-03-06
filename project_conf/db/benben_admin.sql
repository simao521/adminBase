/*
 Navicat Premium Data Transfer

 Source Server         : 本地数据库
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : base

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 27/01/2019 23:37:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for benben_admin
-- ----------------------------
DROP TABLE IF EXISTS `benben_user_follow`;
CREATE TABLE `benben_user_follow`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL COMMENT '用户ID',
  `type` int(5) NULL DEFAULT NULL COMMENT '关注内容类型',
  `follow_id` text  COMMENT '被关注ID',
  `add_time` int(11) NULL DEFAULT NULL COMMENT '添加时间',
  `update_time` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  `status` int(2) NULL DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of benben_admin
-- ----------------------------
INSERT INTO `benben_admin` VALUES (1, '41198723febba48b336ec819abc4b964a978b1f1', 1548600070, 'admin', '66871cc5347eafeca60c51ee397b9049', 'csKWUM', '超级账号', 'admin', 1, 1, '127.0.0.1', 1548599448, 1546517440, 1548599770, NULL, 1, NULL);
INSERT INTO `benben_admin` VALUES (2, NULL, NULL, '15515974821', 'ec01e9153ddd0fafb48ab9e1927e066e', 'HjWHM3', '龙大大', '15515974821', 1, 1, NULL, NULL, 1548169536, 1548169536, NULL, 1, NULL);
INSERT INTO `benben_admin` VALUES (3, NULL, NULL, '15515974822', '7e3c916b1d86acbdaa865cf88775215f', 'z1Gpp5', '龙大大', '15515974822', 1, 1, NULL, NULL, 1548169536, 1548169536, NULL, 1, NULL);
INSERT INTO `benben_admin` VALUES (4, NULL, NULL, '15515974823', '6f61eb15e2fbc6945a187019cfbed661', 'yAgUWg', '龙大大', '15515974823', 1, 1, NULL, NULL, 1548169536, 1548169536, NULL, 1, NULL);
INSERT INTO `benben_admin` VALUES (5, NULL, NULL, '15515974824', 'c5ab1fdf85d9f268c23d946d1d8668bf', 'AXXM6a', '龙大大', '15515974824', 1, 1, NULL, NULL, 1548169536, 1548169536, NULL, 1, NULL);
INSERT INTO `benben_admin` VALUES (6, NULL, NULL, '15515974827', 'f87f4be30772920b6a107666a1c4d25a', 'WZPNU1', '龙大大', '15515974825', 1, 1, '127.0.0.1', 1548348041, 1548168989, 1548348041, NULL, 1, NULL);
INSERT INTO `benben_admin` VALUES (7, NULL, NULL, '15515974826', 'fdfd5bb02bcf1803fbf8d2b41e543c49', 'Kzdu31', '龙大大', '15515974826', 1, 1, NULL, NULL, 1548169536, 1548169536, NULL, 1, NULL);
INSERT INTO `benben_admin` VALUES (8, NULL, NULL, '15515974827', '35552bd596614c5c366e1390a0a5057b', 'CUnj4n', '龙大大', '15515974827', 1, 1, NULL, NULL, 1548169536, 1548171130, NULL, 1, NULL);

SET FOREIGN_KEY_CHECKS = 1;
