SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for test
-- ----------------------------
DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test
-- ----------------------------
BEGIN;
INSERT INTO `test` VALUES (2, 1, 'Marcia Banaszkiewicz', '2018-11-19 19:23:45', 16);
INSERT INTO `test` VALUES (3, 1, 'Colet Neaves', '2019-05-24 00:37:48', 81);
INSERT INTO `test` VALUES (4, 0, 'Elsey Dudhill', '2018-12-22 18:45:44', 99);
INSERT INTO `test` VALUES (5, 1, 'Uri Jendrassik', '2019-07-12 08:49:36', 97);
INSERT INTO `test` VALUES (6, 1, 'Moll Vanini', '2019-06-13 06:15:30', 82);
INSERT INTO `test` VALUES (7, 1, 'Moria Dickings', '2018-12-20 22:17:16', 80);
INSERT INTO `test` VALUES (8, 0, 'Tobiah Bielby', '2018-10-03 01:26:44', 81);
INSERT INTO `test` VALUES (9, 0, 'Gerrie Hughlin', '2019-05-13 04:33:26', 56);
INSERT INTO `test` VALUES (10, 1, 'Tandi Stickells', '2018-11-08 14:43:04', 89);
INSERT INTO `test` VALUES (11, 0, 'Mildrid Standall', '2018-10-05 02:38:31', 19);
INSERT INTO `test` VALUES (12, 1, 'Verina Maciak', '2019-02-02 11:50:34', 14);
INSERT INTO `test` VALUES (13, 0, 'Gaelan Sitwell', '2019-05-29 07:56:58', 70);
INSERT INTO `test` VALUES (14, 1, 'Nell Vuittet', '2019-03-16 13:22:39', 55);
INSERT INTO `test` VALUES (15, 1, 'Dotty Gorry', '2019-07-19 20:31:07', 25);
INSERT INTO `test` VALUES (16, 1, 'Cathrin Piwell', '2019-03-23 19:59:29', 5);
INSERT INTO `test` VALUES (17, 0, 'Essa Withur', '2019-03-06 05:40:27', 99);
INSERT INTO `test` VALUES (18, 1, 'Lissa Raubenheimer', '2018-12-18 19:19:17', 32);
INSERT INTO `test` VALUES (19, 0, 'Hube Hagergham', '2019-06-16 13:07:01', 49);
INSERT INTO `test` VALUES (20, 0, 'Rosette Johnstone', '2019-06-02 11:26:51', 37);
INSERT INTO `test` VALUES (21, 0, 'Charmion Cleaves', '2019-01-26 15:49:00', 60);
INSERT INTO `test` VALUES (22, 1, 'Shannen Snaddon', '2018-11-06 08:21:49', 43);
INSERT INTO `test` VALUES (23, 0, 'Lishe Tuckwell', '2019-07-08 18:22:49', 89);
INSERT INTO `test` VALUES (24, 1, 'Charlene Board', '2019-03-24 10:52:31', 60);
INSERT INTO `test` VALUES (25, 1, 'Gabey Attrey', '2018-11-16 05:20:11', 41);
INSERT INTO `test` VALUES (26, 1, 'Reagen Pennell', '2019-03-05 09:39:01', 67);
INSERT INTO `test` VALUES (27, 0, 'Micheal Parsell', '2019-04-17 05:59:40', 80);
INSERT INTO `test` VALUES (28, 1, 'Erhard Goodin', '2018-07-31 18:15:49', 52);
INSERT INTO `test` VALUES (29, 1, 'Kathie Yurygyn', '2019-03-26 20:48:53', 64);
INSERT INTO `test` VALUES (30, 1, 'Sully Ziems', '2019-07-01 20:07:18', 11);
INSERT INTO `test` VALUES (31, 1, 'Baxter Vain', '2019-01-31 06:51:19', 88);
INSERT INTO `test` VALUES (32, 0, 'Mallorie Minister', '2018-08-29 00:53:55', 41);
INSERT INTO `test` VALUES (33, 1, 'Shell Gouck', '2018-10-25 09:16:24', 58);
INSERT INTO `test` VALUES (34, 0, 'Elvyn True', '2018-11-08 08:28:53', 18);
INSERT INTO `test` VALUES (35, 1, 'Tan Kalb', '2018-12-02 14:02:58', 49);
INSERT INTO `test` VALUES (36, 1, 'Teodoor Greaves', '2018-08-25 14:43:15', 47);
INSERT INTO `test` VALUES (37, 1, 'Ethelbert Coggin', '2018-12-27 20:06:56', 71);
INSERT INTO `test` VALUES (38, 0, 'Lorita Gawthorp', '2018-11-18 04:35:43', 10);
INSERT INTO `test` VALUES (39, 0, 'Henderson Hanley', '2018-08-30 03:17:36', 100);
INSERT INTO `test` VALUES (40, 1, 'Amil Paolini', '2019-07-29 15:19:44', 13);
INSERT INTO `test` VALUES (41, 0, 'Evanne Spaldin', '2018-09-29 16:19:52', 3);
INSERT INTO `test` VALUES (42, 0, 'Debee Arstingall', '2018-09-04 16:47:53', 74);
INSERT INTO `test` VALUES (43, 1, 'Alonzo Neubigging', '2019-01-06 05:48:42', 36);
INSERT INTO `test` VALUES (44, 1, 'Conn Joy', '2019-02-05 22:08:37', 35);
INSERT INTO `test` VALUES (45, 0, 'Flor McCreadie', '2019-01-31 03:34:06', 72);
INSERT INTO `test` VALUES (46, 0, 'Hillary Manthroppe', '2018-12-30 21:29:35', 16);
INSERT INTO `test` VALUES (47, 0, 'Nadya Grimsell', '2019-04-16 10:15:19', 69);
INSERT INTO `test` VALUES (48, 1, 'Fonzie Pickring', '2018-11-10 22:14:42', 51);
INSERT INTO `test` VALUES (49, 0, 'Sherie Penkethman', '2018-12-04 20:21:56', 39);
INSERT INTO `test` VALUES (50, 1, 'Marlie Rosenkrantz', '2019-07-13 16:29:47', 56);
INSERT INTO `test` VALUES (51, 0, 'Osmond Leipnik', '2018-10-03 20:02:59', 76);
INSERT INTO `test` VALUES (52, 0, 'Arlan Innot', '2018-09-20 22:35:57', 36);
INSERT INTO `test` VALUES (53, 1, 'Chelsy Scripture', '2019-03-13 21:53:45', 61);
INSERT INTO `test` VALUES (54, 0, 'Amara Purtell', '2018-10-07 22:25:30', 74);
INSERT INTO `test` VALUES (55, 0, 'Charo Cordey', '2019-04-18 00:53:03', 39);
INSERT INTO `test` VALUES (56, 1, 'Marissa Nutty', '2018-08-20 06:33:26', 33);
INSERT INTO `test` VALUES (57, 1, 'Rhodie De Castri', '2018-11-17 05:14:35', 50);
INSERT INTO `test` VALUES (58, 1, 'Laurence Gogie', '2018-10-24 20:44:40', 66);
INSERT INTO `test` VALUES (59, 1, 'Farica Duffield', '2019-07-07 10:29:47', 9);
INSERT INTO `test` VALUES (60, 0, 'Judas Hearn', '2019-07-26 07:58:26', 32);
INSERT INTO `test` VALUES (61, 0, 'Lisette O\'Murtagh', '2018-09-24 11:18:52', 58);
INSERT INTO `test` VALUES (62, 1, 'Cinderella Ewbanck', '2019-02-12 04:31:17', 78);
INSERT INTO `test` VALUES (63, 1, 'Merrilee Faireclough', '2018-09-03 19:24:00', 90);
INSERT INTO `test` VALUES (64, 1, 'Tommy McIsaac', '2019-02-07 01:14:06', 12);
INSERT INTO `test` VALUES (65, 0, 'Des McBain', '2018-08-17 04:49:51', 56);
INSERT INTO `test` VALUES (66, 1, 'Beryl Beale', '2019-07-11 09:05:24', 45);
INSERT INTO `test` VALUES (67, 0, 'Taddeo Dilliway', '2019-02-08 09:41:20', 27);
INSERT INTO `test` VALUES (68, 0, 'Hortensia Pollen', '2018-10-13 21:43:26', 37);
INSERT INTO `test` VALUES (69, 0, 'Maribel Mellhuish', '2018-10-11 16:22:56', 17);
INSERT INTO `test` VALUES (70, 1, 'Hillel Clayfield', '2019-07-05 08:52:52', 18);
INSERT INTO `test` VALUES (71, 1, 'Padraig Jandourek', '2019-04-05 01:50:13', 6);
INSERT INTO `test` VALUES (72, 1, 'Mildrid Rolf', '2019-02-27 18:14:31', 38);
INSERT INTO `test` VALUES (73, 0, 'Patrizio Brockwell', '2018-10-17 02:23:34', 32);
INSERT INTO `test` VALUES (74, 0, 'Evvy Brassill', '2019-01-21 21:55:54', 17);
INSERT INTO `test` VALUES (75, 0, 'Hardy Ygoe', '2019-01-21 00:35:19', 38);
INSERT INTO `test` VALUES (76, 1, 'Waneta Davern', '2019-07-02 21:46:04', 33);
INSERT INTO `test` VALUES (77, 1, 'Adel Strowthers', '2019-02-13 12:23:58', 54);
INSERT INTO `test` VALUES (78, 0, 'Deny Midner', '2019-04-25 15:49:59', 39);
INSERT INTO `test` VALUES (79, 1, 'Tanny Franiak', '2018-11-24 17:54:20', 62);
INSERT INTO `test` VALUES (80, 1, 'Siouxie Kennifeck', '2018-09-01 14:47:01', 22);
INSERT INTO `test` VALUES (81, 0, 'Maye Huxham', '2018-11-24 19:35:52', 15);
INSERT INTO `test` VALUES (82, 1, 'Scarlett O\'Scollain', '2018-12-29 17:17:38', 70);
INSERT INTO `test` VALUES (83, 1, 'Daisi Sheere', '2018-12-21 18:18:32', 38);
INSERT INTO `test` VALUES (84, 0, 'Sarge Burbank', '2018-11-25 16:16:41', 22);
INSERT INTO `test` VALUES (85, 1, 'Dru Gravestone', '2019-05-12 13:13:06', 90);
INSERT INTO `test` VALUES (86, 0, 'Issy Brewitt', '2019-02-13 03:30:57', 9);
INSERT INTO `test` VALUES (87, 0, 'Konstance Yarmouth', '2019-01-16 15:01:38', 54);
INSERT INTO `test` VALUES (88, 0, 'Gabbie Kellen', '2019-05-07 11:20:08', 42);
INSERT INTO `test` VALUES (89, 1, 'Daren Humbie', '2018-10-09 02:39:52', 10);
INSERT INTO `test` VALUES (90, 1, 'Almire Writer', '2019-02-23 03:22:28', 2);
INSERT INTO `test` VALUES (91, 1, 'Jenn Lenihan', '2019-06-05 17:51:52', 5);
INSERT INTO `test` VALUES (92, 1, 'Dietrich Mintram', '2019-05-24 03:43:08', 45);
INSERT INTO `test` VALUES (93, 0, 'Smitty Glisenan', '2018-08-13 08:44:13', 74);
INSERT INTO `test` VALUES (94, 1, 'Kerk Sell', '2019-03-02 19:45:02', 15);
INSERT INTO `test` VALUES (95, 0, 'Thorin Suffe', '2019-03-21 21:08:39', 71);
INSERT INTO `test` VALUES (96, 0, 'Kristen Frissell', '2019-03-30 07:00:48', 75);
INSERT INTO `test` VALUES (97, 1, 'Tami Dallon', '2018-09-12 12:25:43', 28);
INSERT INTO `test` VALUES (98, 1, 'Myrvyn Squibbs', '2019-07-09 16:46:09', 42);
INSERT INTO `test` VALUES (99, 0, 'Cole Haverty', '2019-01-03 22:11:57', 72);
INSERT INTO `test` VALUES (100, 1, 'Gabriel Scandred', '2019-05-19 09:51:30', 38);
INSERT INTO `test` VALUES (101, 1, 'Example', '2019-07-31 16:17:42', 1);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
