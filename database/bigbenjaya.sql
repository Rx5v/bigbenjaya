/*
Navicat MySQL Data Transfer

Source Server         : Xampp
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : bigbenjaya

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-01-19 16:25:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for car
-- ----------------------------
DROP TABLE IF EXISTS `car`;
CREATE TABLE `car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plate_number` varchar(255) DEFAULT NULL,
  `status_id` varchar(255) DEFAULT NULL,
  `car_type_id` varchar(11) DEFAULT NULL,
  `car_series_id` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of car
-- ----------------------------
INSERT INTO `car` VALUES ('1', '1312312', '1', '1', '5');
INSERT INTO `car` VALUES ('7', '1312312', '1', '1', '6');
INSERT INTO `car` VALUES ('8', 'AD 177013 XD', '1', '1', '5');
INSERT INTO `car` VALUES ('9', 'AB 228922 XP', '1', '1', '6');
INSERT INTO `car` VALUES ('10', 'H 45 U', '1', '1', '5');

-- ----------------------------
-- Table structure for car_series
-- ----------------------------
DROP TABLE IF EXISTS `car_series`;
CREATE TABLE `car_series` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `series` varchar(255) DEFAULT NULL,
  `type_id` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of car_series
-- ----------------------------
INSERT INTO `car_series` VALUES ('5', 'grand', '1');
INSERT INTO `car_series` VALUES ('6', '5', '1');

-- ----------------------------
-- Table structure for car_type
-- ----------------------------
DROP TABLE IF EXISTS `car_type`;
CREATE TABLE `car_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of car_type
-- ----------------------------
INSERT INTO `car_type` VALUES ('1', 'Inova');
INSERT INTO `car_type` VALUES ('2', 'Avanza');
INSERT INTO `car_type` VALUES ('3', 'Premio');
INSERT INTO `car_type` VALUES ('4', 'Vioz');
INSERT INTO `car_type` VALUES ('8', 'Forklift');
INSERT INTO `car_type` VALUES ('9', 'Fuso');
INSERT INTO `car_type` VALUES ('10', 'asdasd');

-- ----------------------------
-- Table structure for driver
-- ----------------------------
DROP TABLE IF EXISTS `driver`;
CREATE TABLE `driver` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `pict` varchar(255) DEFAULT NULL,
  `status_id` varchar(255) DEFAULT NULL,
  `is_active` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of driver
-- ----------------------------
INSERT INTO `driver` VALUES ('1', 'Nama customer', '1312', '219347-P0VB16-4936.jpg', '1', '1');
INSERT INTO `driver` VALUES ('2', 'Nama customer', '13123', 'wp346534311.jpg', '1', '1');
INSERT INTO `driver` VALUES ('3', 'Owi', '08123456', 'ha.jpg', '1', '1');
INSERT INTO `driver` VALUES ('4', 'Mak Banteng', '0876543123', 'pakde.jpg', '1', '1');
INSERT INTO `driver` VALUES ('5', 'Owii - Kunn', '081234567', 'monyet_cukur2.jpg', '1', '1');

-- ----------------------------
-- Table structure for order_detail
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) DEFAULT NULL,
  `car_id` varchar(11) DEFAULT NULL,
  `car_type` varchar(255) DEFAULT NULL,
  `driver_id` varchar(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of order_detail
-- ----------------------------
INSERT INTO `order_detail` VALUES ('1', 'BBJ2201160001', '1', '1', '3', '2');

-- ----------------------------
-- Table structure for order_head
-- ----------------------------
DROP TABLE IF EXISTS `order_head`;
CREATE TABLE `order_head` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `guest_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `pickup` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of order_head
-- ----------------------------
INSERT INTO `order_head` VALUES ('1', 'BBJ2201160001', 'Coba', 'Njir', '0987654321', 'ndak tau', 'home', '2022-01-16', '2022-01-20', '2', '2022-01-16 21:53:32');

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES ('1', 'ready');
INSERT INTO `status` VALUES ('2', 'ontrack');

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
