/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50620
 Source Host           : localhost:3306
 Source Schema         : 0skr_tugasakhir

 Target Server Type    : MySQL
 Target Server Version : 50620
 File Encoding         : 65001

 Date: 19/07/2018 08:46:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for akademik
-- ----------------------------
DROP TABLE IF EXISTS `akademik`;
CREATE TABLE `akademik`  (
  `id` int(5) NOT NULL,
  `nip` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_akademik` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_hp` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of akademik
-- ----------------------------
INSERT INTO `akademik` VALUES (1, '11111', 'Akademik TA', 'akademikta@gmail.com', '08312131212');

-- ----------------------------
-- Table structure for dosen
-- ----------------------------
DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nip` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_dosen` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_hp` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dosen
-- ----------------------------
INSERT INTO `dosen` VALUES (1, '11111', 'Dosen 1', 'dosen1@gmail.com', '082131231');
INSERT INTO `dosen` VALUES (2, '22222', 'Dosen 2', 'dosen1@gmail.com', '0852131212');
INSERT INTO `dosen` VALUES (3, '33333', 'Dosen 3', 'dosen3@gmail.com', '0832131212');
INSERT INTO `dosen` VALUES (4, '44444', 'Dosen 4', 'dosen4@gmail.com', '0823123123');
INSERT INTO `dosen` VALUES (5, '55555', 'Dosen 5', 'dosen5@gmail.com', '08213121312');
INSERT INTO `dosen` VALUES (6, '66666', 'Dosen 6', 'dosen6@gmail.com', '0831213123');

-- ----------------------------
-- Table structure for judul
-- ----------------------------
DROP TABLE IF EXISTS `judul`;
CREATE TABLE `judul`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `mhsid` int(5) NOT NULL,
  `judul` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pembimbing` int(5) NOT NULL,
  `penguji1` int(5) NULL DEFAULT NULL,
  `penguji2` int(5) NULL DEFAULT NULL,
  `status` tinyint(5) NOT NULL COMMENT '0=arsip; 1=belum diajukan; 2=sudah diajukan; 3=sudah diacc',
  `keterangan` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created` datetime(0) NULL DEFAULT NULL,
  `updated` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of judul
-- ----------------------------
INSERT INTO `judul` VALUES (2, 1, 'Tes', 0, NULL, NULL, 0, '', '2018-07-12 04:27:37', '2018-07-12 04:27:39');
INSERT INTO `judul` VALUES (3, 1, 'adaw', 0, NULL, NULL, 0, NULL, '2018-07-12 04:27:41', '2018-07-12 04:27:43');
INSERT INTO `judul` VALUES (5, 1, 'sadasd', 0, NULL, NULL, 0, NULL, '2018-07-12 04:27:44', '2018-07-12 04:27:46');
INSERT INTO `judul` VALUES (6, 1, 'Judul 1', 3, NULL, NULL, 3, NULL, '2018-07-12 04:27:48', '2018-07-12 05:55:30');
INSERT INTO `judul` VALUES (7, 1, 'Judul 2', 0, NULL, NULL, 2, NULL, '2018-07-12 04:27:52', '2018-07-12 04:27:54');
INSERT INTO `judul` VALUES (9, 1, 'Judul 3', 0, NULL, NULL, 2, NULL, '2018-07-12 04:27:56', '2018-07-12 04:27:59');
INSERT INTO `judul` VALUES (11, 2, 'Skripsi 1', 0, NULL, NULL, 2, NULL, NULL, '2018-07-12 06:25:56');
INSERT INTO `judul` VALUES (12, 2, 'Skripsi 2', 0, NULL, NULL, 2, NULL, NULL, '2018-07-12 06:30:06');
INSERT INTO `judul` VALUES (13, 2, 'Skripsi 3', 5, NULL, NULL, 3, NULL, NULL, '2018-07-12 06:30:53');

-- ----------------------------
-- Table structure for judul_detail
-- ----------------------------
DROP TABLE IF EXISTS `judul_detail`;
CREATE TABLE `judul_detail`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_judul` int(5) NOT NULL,
  `ringkas_masalah` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `metode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `judul_id`(`id_judul`) USING BTREE,
  CONSTRAINT `judul_id` FOREIGN KEY (`id_judul`) REFERENCES `judul` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of judul_detail
-- ----------------------------
INSERT INTO `judul_detail` VALUES (1, 2, 'tes masalah', 'tes metode', 'tes deskripsi');
INSERT INTO `judul_detail` VALUES (2, 3, 'dwadad', 'dwa', 'dwadawdawd');
INSERT INTO `judul_detail` VALUES (4, 5, 'dasad', 'dasad', 'daawd');
INSERT INTO `judul_detail` VALUES (5, 6, 'ringkasan judul 1', 'metode judul 1', 'deskripsi judul 1');
INSERT INTO `judul_detail` VALUES (6, 7, 'dawdkawd', 'awdawdawd', 'xvfvfvxfv');
INSERT INTO `judul_detail` VALUES (8, 9, 'awdawdklawjl', 'ahwkdhawkjhwad', 'hwakjhdakwjhdakwjhdkawhdjakwhdawdawd');
INSERT INTO `judul_detail` VALUES (10, 11, 'ringkasan masalah skripsi 1', 'metode masalah skripsi 1', 'deskripsi masalah skripsi 1');
INSERT INTO `judul_detail` VALUES (11, 12, 'ringkasan masalah skripsi 2', 'metode masalah skripsi 2', 'deskripsi masalah skripsi 2');
INSERT INTO `judul_detail` VALUES (12, 13, 'ringkasan masalah skripsi 3', 'metode masalah skripsi 3', 'deskripsi masalah skripsi 3');

-- ----------------------------
-- Table structure for jurusan
-- ----------------------------
DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE `jurusan`  (
  `id` int(5) NOT NULL,
  `fakultas` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jurusan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of jurusan
-- ----------------------------
INSERT INTO `jurusan` VALUES (1, 'Ilmu Komputer', 'Teknik Informatika');

-- ----------------------------
-- Table structure for mahasiswa
-- ----------------------------
DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nim` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_mhs` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jurusan` int(5) NOT NULL,
  `email` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mahasiswa
-- ----------------------------
INSERT INTO `mahasiswa` VALUES (1, '121020120017', 'Heri Hakim Setiawan', 1, 'hhakimsetiawan@gmail.com');
INSERT INTO `mahasiswa` VALUES (2, '11111020', 'Munazir Rahman', 1, 'ajiel@gmail.com');

-- ----------------------------
-- Table structure for pengajuan
-- ----------------------------
DROP TABLE IF EXISTS `pengajuan`;
CREATE TABLE `pengajuan`  (
  `id` int(5) NOT NULL,
  `judulid` int(5) NOT NULL,
  `mhsid` int(5) NOT NULL,
  `tanggal_pengajuan` datetime(6) NOT NULL,
  `status` tinyint(5) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for seminar
-- ----------------------------
DROP TABLE IF EXISTS `seminar`;
CREATE TABLE `seminar`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime(6) NULL DEFAULT NULL,
  `judulid` int(5) NOT NULL,
  `mhsid` int(5) NOT NULL,
  `nilai_pembimbing` int(5) NULL DEFAULT NULL,
  `nilai_penguji1` int(5) NULL DEFAULT NULL,
  `nilai_penguji2` int(5) NULL DEFAULT NULL,
  `status_pengajuan` tinyint(5) NOT NULL COMMENT '0=arsip;1=ready;2=diajukan;3=acc',
  `status` tinyint(5) NOT NULL COMMENT '0-tidak lulus;1=lulus',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for sidang
-- ----------------------------
DROP TABLE IF EXISTS `sidang`;
CREATE TABLE `sidang`  (
  `id` int(5) NOT NULL,
  `tanggal` datetime(6) NULL DEFAULT NULL,
  `judulid` int(5) NOT NULL,
  `mhsid` int(5) NOT NULL,
  `status` tinyint(5) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `jenis_user` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'akademik; mahasiswa; dosen;',
  `userid` int(5) NOT NULL,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` datetime(6) NOT NULL,
  `updated` datetime(6) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(6),
  `last_login` datetime(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'mahasiswa', 1, '121020120017', '17ebec54ad4f0c3638478ee5b3ff4f42', '2018-07-10 04:39:00.000000', '2018-07-10 06:02:54.053132', NULL);
INSERT INTO `user` VALUES (2, 'dosen', 1, '12345', '17ebec54ad4f0c3638478ee5b3ff4f42', '2018-07-10 06:04:04.000000', '2018-07-10 06:04:06.630952', NULL);
INSERT INTO `user` VALUES (3, 'akademik', 1, 'akademik', '17ebec54ad4f0c3638478ee5b3ff4f42', '2018-07-10 06:04:29.000000', '2018-07-10 06:04:31.076395', NULL);
INSERT INTO `user` VALUES (4, 'mahasiswa', 2, '11111020', '17ebec54ad4f0c3638478ee5b3ff4f42', '0000-00-00 00:00:00.000000', '2018-07-12 06:10:12.603768', NULL);

SET FOREIGN_KEY_CHECKS = 1;
