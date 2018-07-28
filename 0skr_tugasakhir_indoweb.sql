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

 Date: 28/07/2018 10:05:28
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
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for jurusan
-- ----------------------------
DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE `jurusan`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `fakultas` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jurusan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of jurusan
-- ----------------------------
INSERT INTO `jurusan` VALUES (1, 'Ilmu Komputer', 'Teknik Informatika');
INSERT INTO `jurusan` VALUES (2, 'Ilmu Komputer', 'Sistem Informasi');

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mahasiswa
-- ----------------------------
INSERT INTO `mahasiswa` VALUES (1, '11111001', 'Mahasiswa 1', 1, 'mahasiswa1@gmail.com');
INSERT INTO `mahasiswa` VALUES (2, '11111002', 'Mahasiswa 2', 1, 'mahasiswa2@gmail.com');
INSERT INTO `mahasiswa` VALUES (3, '11111003', 'Mahasiswa 3', 1, 'mahasiswa3@gmail.com');
INSERT INTO `mahasiswa` VALUES (4, '11111004', 'Mahasiswa 4', 2, 'mahasiswa4@gmail.com');
INSERT INTO `mahasiswa` VALUES (5, '11111005', 'Mahasiswa 5', 2, 'mahasiswa5@gmail.com');

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
-- Table structure for pengaturan
-- ----------------------------
DROP TABLE IF EXISTS `pengaturan`;
CREATE TABLE `pengaturan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of pengaturan
-- ----------------------------
INSERT INTO `pengaturan` VALUES (1, 'Pengajuan Judul', 1);

-- ----------------------------
-- Table structure for seminar
-- ----------------------------
DROP TABLE IF EXISTS `seminar`;
CREATE TABLE `seminar`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tanggal` date NULL DEFAULT NULL,
  `judulid` int(5) NOT NULL,
  `mhsid` int(5) NOT NULL,
  `nilai_pembimbing` int(5) NULL DEFAULT NULL,
  `nilai_penguji1` int(5) NULL DEFAULT NULL,
  `nilai_penguji2` int(5) NULL DEFAULT NULL,
  `status_pengajuan` tinyint(5) NOT NULL COMMENT '0=arsip;1=ready;2=diajukan;3=acc',
  `status` tinyint(5) NOT NULL COMMENT '0-tidak lulus;1=lulus',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for sidang
-- ----------------------------
DROP TABLE IF EXISTS `sidang`;
CREATE TABLE `sidang`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tanggal` date NULL DEFAULT NULL,
  `judulid` int(5) NOT NULL,
  `mhsid` int(5) NOT NULL,
  `nilai_pembimbing` int(5) NULL DEFAULT NULL,
  `nilai_penguji1` int(5) NULL DEFAULT NULL,
  `nilai_penguji2` int(5) NULL DEFAULT NULL,
  `status_pengajuan` tinyint(5) NOT NULL COMMENT '0=arsip;1=ready;2=diajukan;3=acc',
  `status` tinyint(5) NOT NULL COMMENT '0-tidak lulus;1=lulus',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (5, 'mahasiswa', 1, '11111001', 'd969b436bdf5d694384ab43bcb26351c', '2018-07-20 03:49:58.000000', '2018-07-20 03:56:39.932394', NULL);
INSERT INTO `user` VALUES (6, 'mahasiswa', 2, '11111002', '20abd8a2643f34feee2705ed712e8348', '2018-07-20 03:51:00.000000', '2018-07-20 03:56:45.683050', NULL);
INSERT INTO `user` VALUES (7, 'mahasiswa', 3, '11111003', 'd85e8aaca1c4d60e148f95a890da8218', '2018-07-20 03:51:24.000000', '2018-07-20 03:56:51.751812', NULL);
INSERT INTO `user` VALUES (8, 'akademik', 1, 'akademik', '0b5652714faf87700d60a912f753cc55', '2018-07-20 03:52:26.000000', '2018-07-20 03:56:58.085434', NULL);

SET FOREIGN_KEY_CHECKS = 1;
