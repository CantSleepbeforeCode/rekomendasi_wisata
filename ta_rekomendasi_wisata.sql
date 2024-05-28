/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100427
 Source Host           : localhost:3306
 Source Schema         : ta_rekomendasi_wisata

 Target Server Type    : MySQL
 Target Server Version : 100427
 File Encoding         : 65001

 Date: 27/05/2024 19:47:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for kuliners
-- ----------------------------
DROP TABLE IF EXISTS `kuliners`;
CREATE TABLE `kuliners`  (
  `kuliner_id` int NOT NULL AUTO_INCREMENT,
  `kuliner_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kuliner_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `kuliner_picture` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `kuliner_latitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kuliner_longitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kuliner_min_price` int NULL DEFAULT NULL,
  `kuliner_max_price` int NULL DEFAULT NULL,
  PRIMARY KEY (`kuliner_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kuliners
-- ----------------------------
INSERT INTO `kuliners` VALUES (1, 'Gado Gadoo', 'gado gado', '/image/1716807797__1.jpg', '222', '11', 40, 40);

-- ----------------------------
-- Table structure for persons
-- ----------------------------
DROP TABLE IF EXISTS `persons`;
CREATE TABLE `persons`  (
  `person_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `person_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `person_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `person_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `person_age` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `person_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`person_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of persons
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'anureta', '$2y$12$5kvV5J0.LChvg0zmlZl/sOyq7lU23yMbofAD7tqEVHoDyWNqDT4ga', 'admin');

-- ----------------------------
-- Table structure for wisatas
-- ----------------------------
DROP TABLE IF EXISTS `wisatas`;
CREATE TABLE `wisatas`  (
  `wisata_id` int NOT NULL AUTO_INCREMENT,
  `wisata_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `wisata_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `wisata_picture` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `wisata_latitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `wisata_longitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `wisata_min_price` int NULL DEFAULT NULL,
  `wisata_max_price` int NULL DEFAULT NULL,
  PRIMARY KEY (`wisata_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wisatas
-- ----------------------------
INSERT INTO `wisatas` VALUES (2, 'Lamaruw', 'Pantai Lamaruuuu Tepi Laudd~', '/image/1716806776__1.jpg', '-1.2021151125029932', '116.9969805194049', 40000, 40000);

SET FOREIGN_KEY_CHECKS = 1;
