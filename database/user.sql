/*
Navicat MySQL Data Transfer

Source Server         : Xampp
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : bigbenjaya

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-01-16 23:23:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'admin@mail.com', '$2y$10$okIUQQF.6rvjs/hw5mmOZODLr5mbIoOzV03U5IYrCYM7IakgmsC2u', '1', '1');
INSERT INTO `user` VALUES ('2', 'user', 'user@mail.com', '$2y$10$okIUQQF.6rvjs/hw5mmOZODLr5mbIoOzV03U5IYrCYM7IakgmsC2u', '2', '1');
