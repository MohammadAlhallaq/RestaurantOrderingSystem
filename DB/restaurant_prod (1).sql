-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2022 at 10:01 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant_prod`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `account_name` varchar(500) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_number` varchar(50) DEFAULT NULL,
  `password` varchar(500) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `approved` int(11) DEFAULT NULL,
  `account_type_id` int(11) NOT NULL,
  `resturant_category_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `work_status_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `logo_path` varchar(100) DEFAULT NULL,
  `license_path` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_id` int(11) DEFAULT NULL,
  `login_token` longtext DEFAULT NULL,
  `platform_id` varchar(225) DEFAULT NULL,
  `platform_kind` enum('facebook','google','apple') DEFAULT NULL,
  `package_expiration_at` timestamp NULL DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `verification_link` longtext DEFAULT NULL,
  `opening_time` time DEFAULT NULL,
  `closing_time` time DEFAULT NULL,
  `device_token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `account_name`, `email`, `phone_number`, `national_number`, `password`, `email_verified_at`, `package_id`, `sales_id`, `approved`, `account_type_id`, `resturant_category_id`, `status_id`, `work_status_id`, `owner_id`, `logo_path`, `license_path`, `remember_token`, `main_id`, `login_token`, `platform_id`, `platform_kind`, `package_expiration_at`, `description`, `verification_link`, `opening_time`, `closing_time`, `device_token`, `created_at`, `updated_at`) VALUES
(58, 'fire man restaurant', 'fireman@gmail.com', '00971 55 342 3342', NULL, '$2y$10$OHYaULlJwDvLVnjdghQxmeWKVqP92f3GeArgzkbVwx8DQSHBchuGa', '2021-08-31 05:32:03', 80, 27, 1, 2, 1, 2, 2, 57, '61e9247f47fb0.jpg', 'نظام المطاعم.pdf', 'LpYJjODQzVq6achkxVUOnek4HtdQKiCaXOctTF7Qh8BSc7FWQ1UienXlezIp', 22, NULL, NULL, NULL, '2021-10-07 21:15:58', 'test', NULL, '08:00:00', '10:31:00', 'c0RLdCWurpgpUtaG0i2qnm:APA91bGk_Xaa5JDKfpCiLVpAK5Wygnry58QBy5dqP4bEOyKcCUmSn56xQbuEd8abr8WDKaEzNGh5WqP5tP0sAdprt-7P_dJiBlzc686LT9BEMWDlJwenNHP3MmgJxyrBjnuOMkUCLx3L', '2021-08-31 05:31:33', '2022-01-21 09:59:24'),
(60, 'admin1', 'admin@admin.com', '00971558678574', '342-3536-4567556-3', '$2y$10$ivsAUr5nn50B.CGEmT1vXOyuIC6CiNFigSW4/GV4eXRnZYGw41ily', '2021-08-02 18:16:20', NULL, 1, 1, 1, NULL, 1, NULL, NULL, NULL, NULL, '1UM7a2p6qBos7adbjpy1t8hOnyKOcSdwB1dC9p8mfNJN4YWP1dGpRcnYDtER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'c0RLdCWurpgpUtaG0i2qnm:APA91bGk_Xaa5JDKfpCiLVpAK5Wygnry58QBy5dqP4bEOyKcCUmSn56xQbuEd8abr8WDKaEzNGh5WqP5tP0sAdprt-7P_dJiBlzc686LT9BEMWDlJwenNHP3MmgJxyrBjnuOMkUCLx3L', NULL, '2022-01-15 15:22:21'),
(61, 'Oswald Torphy', 'raphael95@example.org', '00971 55 556 7674', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 38, 27, 1, 2, 4, 1, 2, 58, '1636627896.png', '1-2021.pdf', 'jUCKwKKJRmgtgjuyP9mtAStBbjXTtBhBEwInNlUkaR5qBXyT0L1uoaACsqIx', NULL, NULL, NULL, NULL, '2022-01-08 21:35:15', 'test rttest', NULL, NULL, '11:31:00', 'e8ps73s_aSQ0uJ2Sd8vwIf:APA91bEYDmQUt6FyQ0E1N_NTFmGbL0pNxPvN4lEWz-VNcZ4I5eouUF-qMCufR8sgRjt0fdgiLfeB4BtSAjjsb-7cTIAcA4ABoeU70qQE-cCOeEFUWSLqtV3TfboHqKDpqHTHMCu-oc7H', '2021-09-19 02:54:45', '2022-01-18 11:23:43'),
(62, 'Eric Corwin', 'tatyana60@example.net', '820-561-4965', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 1, 2, NULL, NULL, NULL, 'j7lfmqJ0du', NULL, NULL, NULL, NULL, NULL, 'Corrupti sed voluptatibus perferendis blanditiis. Similique molestiae temporibus exercitationem sequi sit sit molestias velit. Sed quia qui ut dolorum. Ex vitae expedita deserunt blanditiis delectus.', NULL, NULL, '12:00:12', NULL, '2021-09-19 02:54:45', '2022-01-18 11:23:43'),
(63, 'Hosea Tremblay I', 'trantow.haskell@example.org', '831.321.4241', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 1, 2, NULL, NULL, NULL, 'eQJKR5Lf9m', NULL, NULL, NULL, NULL, NULL, 'Laborum nemo et quae saepe. Aut voluptas voluptatum quas alias. Sint nisi voluptatibus magni numquam autem est nihil. Alias veniam fuga provident dolorem quam.', NULL, NULL, '12:30:12', NULL, '2021-09-19 02:54:45', '2022-01-18 11:23:43'),
(64, 'Prof. Zelda Walsh', 'isaac89@example.net', '+19125066822', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 1, 2, NULL, NULL, NULL, 'XYkpifnXeR', NULL, NULL, NULL, NULL, NULL, 'Consectetur velit id voluptatem nemo ex id. Qui occaecati soluta fuga officiis omnis. Impedit hic voluptatem tempora id enim consequatur. Aut dolorem non voluptates ab.', NULL, NULL, '09:30:12', NULL, '2021-09-19 02:54:45', '2022-01-18 11:23:43'),
(65, 'Mrs. Katlyn Kilback', 'herman.keaton@example.com', '(781) 537-3168', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 1, 2, NULL, NULL, NULL, 'EQsih1PEab', NULL, NULL, NULL, NULL, NULL, 'Rerum possimus laudantium sed quia placeat. Modi voluptas numquam culpa aliquam enim. Doloremque exercitationem ipsa perspiciatis sint occaecati tempora.', NULL, NULL, '10:30:12', NULL, '2021-09-19 02:54:45', '2022-01-18 11:23:43'),
(66, 'Ms. Alice Schamberger DDS', 'rippin.clemens@example.com', '(256) 844-8450', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 2, 1, NULL, NULL, NULL, 'eut28JPPcG', NULL, NULL, NULL, NULL, NULL, 'Sit quas est nam veniam. Est porro ut ullam voluptas sed enim. Ea culpa iste dolorem.', NULL, NULL, NULL, NULL, '2021-09-19 02:54:45', '2021-11-03 19:41:31'),
(67, 'Dariana Schneider', 'yessenia.hahn@example.net', '+1 (559) 804-9169', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 2, 1, NULL, NULL, NULL, 'nnWw24TW5E', NULL, NULL, NULL, NULL, NULL, 'Nulla at suscipit quibusdam magnam. Ea aut minima in porro vitae iste quo. Omnis dolore id aut pariatur quod et. Corporis enim distinctio soluta blanditiis placeat et beatae.', NULL, NULL, NULL, NULL, '2021-09-19 02:54:45', '2021-11-03 19:41:34'),
(68, 'Elwin Friesen I', 'qking@example.org', '+13462129291', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 2, 2, NULL, NULL, NULL, 'Wl8SBVId6i', NULL, NULL, NULL, NULL, NULL, 'Sit modi explicabo ducimus deserunt. Neque rerum laboriosam cupiditate.', NULL, NULL, NULL, NULL, '2021-09-19 02:54:45', '2021-11-03 19:41:37'),
(69, 'Dario Prosacco', 'nkeeling@example.org', '586.754.0140', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 2, 2, NULL, NULL, NULL, 'Bjl3ThAk4F', NULL, NULL, NULL, NULL, NULL, 'Eaque vero cumque dolores illum voluptas illo sed magnam. Cupiditate omnis eius ab dolor. Nam soluta accusantium nesciunt harum. Atque quos sint consequatur dolor atque eius.', NULL, NULL, NULL, NULL, '2021-09-19 02:54:45', '2021-11-03 19:41:40'),
(70, 'Fleta Schinner DVM', 'srogahn@example.com', '+1 (419) 645-4557', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 2, 2, NULL, NULL, NULL, 'ICt0sKaLWC', NULL, NULL, NULL, NULL, NULL, 'Magnam qui provident saepe et ipsam est placeat. Labore ratione odio eum. Officia excepturi et maiores veniam eos voluptates numquam.', NULL, NULL, NULL, NULL, '2021-09-19 02:54:45', '2021-11-03 19:40:40'),
(71, 'Tracy Schultz', 'osauer@example.org', '1-952-427-0982', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 2, 2, NULL, NULL, NULL, 'Cqlt4X5ml2', NULL, NULL, NULL, NULL, NULL, 'Quia quo quis cumque eius fugit deserunt totam. Sed non est totam nam eos animi. Cum excepturi ut et suscipit voluptatum doloribus et. Corrupti omnis voluptatem minima vel rerum est aut.', NULL, NULL, NULL, NULL, '2021-09-19 02:54:45', '2021-11-03 19:40:42'),
(72, 'Providenci Schiller DDS', 'maegan35@example.org', '+1 (559) 546-6792', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 2, 2, NULL, NULL, NULL, 'I3F05bgISG', NULL, NULL, NULL, NULL, NULL, 'Magnam nostrum minus quo quasi quia incidunt dolores. Eius earum modi aperiam quos saepe. Alias libero recusandae et maxime impedit.', NULL, NULL, NULL, NULL, '2021-09-19 02:54:45', '2021-11-03 19:40:45'),
(73, 'Monte Rowe', 'dwalker@example.com', '1-785-309-9733', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 2, 2, NULL, NULL, NULL, 'RBLP6Pyxkt', NULL, NULL, NULL, NULL, NULL, 'Nihil cumque qui aperiam est qui et consequatur. Labore libero quae nesciunt tempore maxime quia. Quasi consectetur dolores laudantium. Ad earum recusandae dicta ratione veritatis.', NULL, NULL, NULL, NULL, '2021-09-19 02:54:45', '2021-11-03 19:40:48'),
(74, 'Mr. Jed Rutherford Sr.', 'gaylord.ashleigh@example.net', '769.907.5946', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 2, 2, NULL, NULL, NULL, 'NVwkvOn2ej', NULL, NULL, NULL, NULL, NULL, 'Sunt repellat natus facere enim earum. Recusandae ut ab quas quo totam. Aut ratione ut sint repellat sint quas et.', NULL, NULL, NULL, NULL, '2021-09-19 02:54:45', '2021-11-03 19:40:50'),
(75, 'Jamarcus Labadie', 'nellie15@example.net', '+1-743-832-4354', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 2, 2, NULL, NULL, NULL, 'jApgqW4bVo', NULL, NULL, NULL, NULL, NULL, 'Provident molestiae amet perspiciatis cumque commodi eligendi est. Ab omnis error sunt cupiditate omnis sed unde nihil. Id reprehenderit laudantium sit voluptatem iste quisquam expedita.', NULL, NULL, NULL, NULL, '2021-09-19 02:54:45', '2021-11-03 19:40:54'),
(76, 'Gladyce Parker', 'bruce.kunde@example.com', '+16282594157', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 2, 2, NULL, NULL, NULL, 'v9K1Y0nidM', NULL, NULL, NULL, NULL, NULL, 'Reprehenderit quia et voluptas omnis harum deserunt expedita. Optio officia est dolore neque pariatur. Accusamus nihil quod porro tempora id laborum et. Alias ipsa fuga ab quis.', NULL, NULL, NULL, NULL, '2021-09-19 02:54:45', '2021-11-03 19:40:56'),
(77, 'Birdie Simonis', 'emertz@example.com', '+1 (484) 821-9230', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 2, 2, NULL, NULL, NULL, 'EQQhMX0huD', NULL, NULL, NULL, NULL, NULL, 'Ratione autem ratione nam sunt. Neque et necessitatibus deserunt sed nam mollitia fuga. Voluptatibus dolorem beatae tempora ipsa accusantium. Dolorem nihil cum fuga qui nisi nulla fugit rerum.', NULL, NULL, NULL, NULL, '2021-09-19 02:54:45', '2021-11-03 19:41:00'),
(78, 'Carleton Block', 'mclaughlin.brant@example.net', '(906) 457-3514', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 2, 2, NULL, NULL, NULL, 'FpadSssC1y', NULL, NULL, NULL, NULL, NULL, 'Vel doloremque nesciunt velit impedit suscipit aut. Accusantium excepturi nesciunt et voluptas saepe aspernatur occaecati velit. Perspiciatis blanditiis placeat aut.', NULL, NULL, NULL, NULL, '2021-09-19 02:54:45', '2021-11-03 19:41:03'),
(79, 'Ellis Zulauf', 'alisha.ryan@example.com', '+19383556069', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 2, 2, NULL, NULL, NULL, 'cuqUPVva5W', NULL, NULL, NULL, NULL, NULL, 'Et culpa dolor libero enim debitis tempore. Ut sint hic architecto ullam. Unde impedit aut minima qui amet totam.', NULL, NULL, NULL, NULL, '2021-09-19 02:54:45', '2021-11-03 19:41:05'),
(80, 'Frances Bergnaum', 'vergie53@example.net', '(754) 279-9850', '342-3536-4567556-3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2021-09-19 02:54:45', 16, NULL, 1, 2, 4, 2, 2, NULL, NULL, NULL, 'ouZz3PqyzL', NULL, NULL, NULL, NULL, NULL, 'Non autem ipsum necessitatibus. Necessitatibus aperiam modi quis at earum asperiores suscipit. Eos et quia facere nisi fugit molestiae. Quo quod mollitia voluptas ducimus praesentium.', NULL, NULL, NULL, NULL, '2021-09-19 02:54:45', '2021-11-03 19:40:22'),
(131, 'Kabab Al Afghani Restaurant', 'swewe@gmail.com', '97156 91 150 69', NULL, '$2y$10$OHYaULlJwDvLVnjdghQxmeWKVqP92f3GeArgzkbVwx8DQSHBchuGa', '2021-09-22 08:51:13', 52, 27, 1, 2, 4, 1, 1, 60, '1636627762.jpg', 'Izhar.pdf', 'BzO2L8inlSTTC22MwJByUcdpFEfakdNuhQQy76MzWe4DLhm7lihWw15etjV9', 688, NULL, NULL, NULL, '2022-10-04 22:53:28', 'Fresh and delicious food', NULL, '08:31:17', '15:31:34', 'e8ps73s_aSQ0uJ2Sd8vwIf:APA91bEYDmQUt6FyQ0E1N_NTFmGbL0pNxPvN4lEWz-VNcZ4I5eouUF-qMCufR8sgRjt0fdgiLfeB4BtSAjjsb-7cTIAcA4ABoeU70qQE-cCOeEFUWSLqtV3TfboHqKDpqHTHMCu-oc7H', '2022-10-22 08:49:06', '2021-11-11 15:49:22'),
(132, 'support', 'support@arcadius.ae', '', NULL, '$2y$10$OHYaULlJwDvLVnjdghQxmeWKVqP92f3GeArgzkbVwx8DQSHBchuGa', '2021-10-04 22:43:57', NULL, NULL, 1, 1, NULL, 1, NULL, 58, NULL, NULL, 'mVZj080qxI9fgRiFsrynaIiTbMtLKEWbWbhVXszYQnYkr6ZwSRlO4Qag7T2k', 714, 'e51a9993993d88f748e7057c9e8351f3d6c1903a925abd2c7249cdd58906e15331363332353438373334', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e8ps73s_aSQ0uJ2Sd8vwIf:APA91bEYDmQUt6FyQ0E1N_NTFmGbL0pNxPvN4lEWz-VNcZ4I5eouUF-qMCufR8sgRjt0fdgiLfeB4BtSAjjsb-7cTIAcA4ABoeU70qQE-cCOeEFUWSLqtV3TfboHqKDpqHTHMCu-oc7H', '2021-09-25 03:44:11', '2021-10-18 20:33:14'),
(133, 'KIF', 'amjad.bond90@gmail.com', '00971 55 213 1243', NULL, '$2y$10$OHYaULlJwDvLVnjdghQxmeWKVqP92f3GeArgzkbVwx8DQSHBchuGa', '2021-09-27 15:05:43', 42, 27, 1, 2, 1, 1, 1, 59, '1634575046.png', 'نظام المطاعم - Copy.pdf', '1yFrcuLvXcFV3aNgqgqd9HjUjPfCxvqIrXnrybVtItF0ziQ2STy6zXhYnjuz', 731, 'd90cc4ba086fd2006b182e5ea10f80bce4f2a86e26bb96d829ec43d78b85c62131363333333535323438', NULL, NULL, '2022-07-27 23:41:23', 'hhhghg', NULL, NULL, NULL, 'e8ps73s_aSQ0uJ2Sd8vwIf:APA91bEYDmQUt6FyQ0E1N_NTFmGbL0pNxPvN4lEWz-VNcZ4I5eouUF-qMCufR8sgRjt0fdgiLfeB4BtSAjjsb-7cTIAcA4ABoeU70qQE-cCOeEFUWSLqtV3TfboHqKDpqHTHMCu-oc7H', '2021-09-26 14:48:02', '2021-11-04 15:03:40'),
(144, 'Digital Restaurant llc', 'allin1uaetest@gmail.com', '97156 89 589 89', NULL, '$2y$10$OHYaULlJwDvLVnjdghQxmeWKVqP92f3GeArgzkbVwx8DQSHBchuGa', '2021-10-04 08:05:33', 37, 27, 1, 2, 3, 1, 1, 58, '1633339392.png', 'Test Commercial license.pdf', '3wt8p7tAJDcbL2pU5U2DJqWMzInkzSDniee1xqNS6gBs8TXQWYN8j6oUR00W', 753, NULL, NULL, NULL, '2022-10-04 11:15:10', 'Vegan Genius', NULL, NULL, NULL, 'e8ps73s_aSQ0uJ2Sd8vwIf:APA91bEYDmQUt6FyQ0E1N_NTFmGbL0pNxPvN4lEWz-VNcZ4I5eouUF-qMCufR8sgRjt0fdgiLfeB4BtSAjjsb-7cTIAcA4ABoeU70qQE-cCOeEFUWSLqtV3TfboHqKDpqHTHMCu-oc7H', '2021-10-04 06:41:01', '2021-11-10 18:18:32'),
(145, 'Restaurant 5th October', 'technotest98981@gmail.com', '97156 91 150 92', NULL, '$2y$10$OHYaULlJwDvLVnjdghQxmeWKVqP92f3GeArgzkbVwx8DQSHBchuGa', '2021-10-05 12:28:27', 52, 27, 1, 2, 4, 1, 1, 59, '1633433389.jpg', 'test license.pdf', 'SO52NfPmTXLFwLYAYMJggF8KknH1odZhitU7aJq2ofJpXHCp2elD41zzKhJG', 760, NULL, NULL, NULL, '2022-10-18 17:47:28', 'Fresh Food', NULL, '04:31:48', '16:31:56', 'e8ps73s_aSQ0uJ2Sd8vwIf:APA91bEYDmQUt6FyQ0E1N_NTFmGbL0pNxPvN4lEWz-VNcZ4I5eouUF-qMCufR8sgRjt0fdgiLfeB4BtSAjjsb-7cTIAcA4ABoeU70qQE-cCOeEFUWSLqtV3TfboHqKDpqHTHMCu-oc7H', '2021-10-05 12:27:37', '2021-11-10 17:39:46'),
(146, 'admin', 'superadmin@allin1uae.com', '00971 55 213 1243', '342-3536-4567556-3', '$2y$10$jhfcdgL0cXwGv0jCRfXZ..f34IZ630GcAd1TD5tgVszCSyPQ0uq4G', '2021-08-02 23:16:20', NULL, 1, 1, 1, NULL, 1, NULL, NULL, NULL, NULL, 'yZFMioRgWkZvllHEwA3y2P7ZqdFdtO8TmiZZQBqqY2HbtmEG3qynM0kiKZqL', 1, '978bccfde35997225bf6f6b129c53053d7d44d9dabeb6fe6647077898e82769f31363332393737363837', NULL, NULL, NULL, NULL, NULL, '04:31:48', '16:31:56', 'f8vOtMiI-jNoKeGMRqYVJ5:APA91bHFcKmkgMCezOuSDJnUqNQ9ozFWOvfYHh9HoF2Ei97wnnQ2V_VBEhbjtWynZtHPiMkX2Ji1WPctdJDgu3OWzvyhLH8d2iF3DKqIBwuoV1KdJMPbIA3DqpDfQuR54OOcVOHAsGrV', NULL, '2022-01-03 17:35:42'),
(150, 'techno last', 'waledaljawad@gmail.com', '+971547999805', NULL, '$2y$10$U4O99hxeyOWPA/f3uynOHu6zGc.yfEicuY9WuolzMHNqFJFSVXNmi', NULL, NULL, NULL, NULL, 2, NULL, 3, 2, NULL, NULL, NULL, NULL, 777, '14abb06832f17afcd4d8620d9bc485c0a1fc0b28da4d34b864c1e531f3520e7731363334343234333231', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-17 02:45:15', '2021-10-17 02:45:21'),
(151, 'Shahi Restaurant', 'arcadiustest513@gmail.com', '97150 91 150 60', NULL, '$2y$10$eSSMqXA5kRVXmR4xSAE5veaUgtb7xGKDCJUHEN9.ZzMMlZFarDkXm', '2021-10-17 10:27:59', 40, 27, 1, 2, 4, 1, 2, 59, '1640092706.jpg', 'Test Commercial License.pdf', 'cVZ2xUYJvqdzkNIy9anqMzXpfDUGiDTvEkYs2cCKaMgpYsJS1zXyq7rRX0iV', 780, 'c3d25b141a416aad99d71dfc2bb002f4cb2c668d48f07c8a69c1663e0ea754ac31363334393739313037', NULL, NULL, '2022-10-17 11:29:57', 'Delicious Food', NULL, '08:00:00', '12:00:00', 'e8ps73s_aSQ0uJ2Sd8vwIf:APA91bEYDmQUt6FyQ0E1N_NTFmGbL0pNxPvN4lEWz-VNcZ4I5eouUF-qMCufR8sgRjt0fdgiLfeB4BtSAjjsb-7cTIAcA4ABoeU70qQE-cCOeEFUWSLqtV3TfboHqKDpqHTHMCu-oc7H', '2021-10-17 09:38:48', '2022-01-18 10:57:26'),
(152, 'techno restaurant', 'technosharjah90@gmail.com', '+971525052222', NULL, '$2y$10$wzXR4QVq/fzX6Km.qepPJuSbtLP9g2J47DVNYDn0zCTw4Kvkihqf6', NULL, NULL, NULL, NULL, 2, NULL, 3, 2, NULL, NULL, NULL, 'KbQMRZEWqL7sQ5s49NPU1Ehwa2WVfLVTa6zkWjYT9G8xOWqGOQHAne6iHcHY', 791, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-18 18:32:40', '2021-10-18 18:32:40'),
(153, 'techno restaurant new', 'technosharjah91@gmail.com', '97152 50 511 11', NULL, '$2y$10$OHYaULlJwDvLVnjdghQxmeWKVqP92f3GeArgzkbVwx8DQSHBchuGa', '2021-10-06 01:12:57', 35, 27, 1, 2, 1, 1, 1, 61, '1634580925.png', 'نظام المطاعم.pdf', 'J2qChHiyJiGliz5OOj4V2bgrHeQaVe42HfajhbrWg0aT7a6PVJCmFTHzoJzd', 792, NULL, NULL, NULL, '2022-10-30 02:17:23', 'test', NULL, NULL, NULL, 'e8ps73s_aSQ0uJ2Sd8vwIf:APA91bEYDmQUt6FyQ0E1N_NTFmGbL0pNxPvN4lEWz-VNcZ4I5eouUF-qMCufR8sgRjt0fdgiLfeB4BtSAjjsb-7cTIAcA4ABoeU70qQE-cCOeEFUWSLqtV3TfboHqKDpqHTHMCu-oc7H', '2021-10-18 18:33:45', '2021-11-22 16:23:46'),
(154, 'Al Khaleej Restaurant', 'zaman.haider7776@gmail.com', '+971508180231', NULL, '$2y$10$IgpXCt10Fs5D9T2TBPAaY.vxXUPN37wI092fWbccQN33rwnrpqz5S', NULL, NULL, NULL, NULL, 2, NULL, 3, 2, NULL, NULL, NULL, 'oT6taRvC1ddQg0hlFBJEOelQvyhC9wP5cfJGNBAUVWytyrdG0OsnSXZDqSPM', 846, 'ada97c90211b74d8145146b27c05dd108d0c1f32bfde2119823a0cbc1605b35831363336363139323232', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-11 13:15:44', '2021-11-11 13:27:02'),
(157, 'testt', 'mohammad.alhallaq1@gmail.com', '00971 55 234 2342', NULL, '$2y$10$KrR9oSFARGwitmNqJA/mM.uibC.eTc.MtqenoF6BG/nC1LrdizgGK', NULL, NULL, NULL, NULL, 2, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-22 12:20:15', '2021-11-22 12:20:15'),
(158, 'techno new', 'technosharjah101@gmail.com', '97152 50 571 28', NULL, '$2y$10$7OFrLidil4IDnumTo0V.WOaJ2HTXfkKLHUUSlgPiF0YLKsucX/Umu', '2021-11-22 13:08:14', 62, 27, 1, 2, 4, 1, 1, 62, '1637568656.jpg', 'test.pdf', 'bUtjP4oEvsfpxO2TaUUdkN3zGKbASI3UdLn3dH6HS3LaaR3W4y74tx1m2pCT', 892, NULL, NULL, NULL, '2022-11-22 13:16:00', 'Great food and Shisha\nThe food was superb and the service very friendly and quick.. I managed to taste several dishes and enjoyed them all. The lamb chops were very tasty.', NULL, '06:00:00', '23:45:00', NULL, '2021-11-22 12:59:54', '2021-11-22 16:04:19'),
(159, 'techno test', 'technosharjah102@gmail.com', '+971525057129', NULL, '$2y$10$nes3mPvvrbYwicDoeC8wieOedLbEJFE6YYgwBCzYwkoesDoi1SMi2', NULL, NULL, NULL, NULL, 2, NULL, 3, 2, NULL, NULL, NULL, NULL, 893, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-22 13:19:48', '2021-11-22 13:19:48'),
(160, 'techno test', 'technosharjah103@gmail.com', '+971525057120', NULL, '$2y$10$sszNSmXkeCkW.6161NbRH.PHTeJbHdGfkkZIrRmoupEoEWbgCL9ii', NULL, NULL, NULL, NULL, 2, NULL, 3, 2, NULL, NULL, NULL, NULL, 894, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-22 13:46:38', '2021-11-22 13:46:38'),
(161, '28 Nov Seller', 'amir3lijalal@gmail.com', '+971562250280', NULL, '$2y$10$fhkc.XxTy/xKYVCeHxh7GOlqIwoBU/pcD3FSCZtWTsYnnbfBsoX2u', NULL, NULL, NULL, NULL, 2, NULL, 3, 2, NULL, NULL, NULL, NULL, 938, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-28 15:57:32', '2021-11-28 15:57:32'),
(162, 'Training Vendor llc', 'allin1uaetraining@gmail.com', '+971581994514', NULL, '$2y$10$IRIKjPXxeaLk.AdFpiA.0O6zpUQjfUB1vLpMG4ONAwTq6lgUh4fRi', '2021-11-29 13:36:07', 40, 27, NULL, 2, 4, 4, 2, 63, '1638175037.jpg', 'Test Commercial license.pdf', NULL, 939, NULL, NULL, NULL, NULL, 'Arabian food', NULL, NULL, NULL, NULL, '2021-11-29 13:21:17', '2021-11-29 13:42:34'),
(163, 'chef art restaurant', 'amedalkl@hotmail.com', '+971563120205', NULL, '$2y$10$NCyt05F51ZPZD2iATRi9U.WgVoDoMCt70jojK7BWGTMJLwChAW.Wq', '2021-12-14 17:45:08', 76, NULL, 1, 2, 4, 1, 2, 64, '1639486489.jpg', 'SHAWRMA THE CHEF ART - DUBAI BRANCH license.pdf', NULL, 972, NULL, NULL, NULL, '2022-12-14 19:37:00', 'Jumeirah street', NULL, NULL, NULL, NULL, '2021-12-14 17:43:50', '2021-12-14 19:37:00'),
(164, 'Stop and Shop Grocery LLC', 'arcadiusdemo1@gmail.com', '+971569115060', NULL, '$2y$10$riZ8YGGoU21DW34wOlUufOozoVSiQjKZrKA7muIsZPwW9PJcKAKk.', NULL, NULL, NULL, NULL, 2, NULL, 3, 2, NULL, NULL, NULL, NULL, 680, 'bccfa5a05a32897871f4945f7353e12d990c7d7d5c4f3373e5c66cb6aaa352d631363339343839353832', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-14 18:46:12', '2021-12-14 18:46:22'),
(165, 'qweds2--_&876', 'future133@hotmail.com', '00971 55 234 2342', NULL, '$2y$10$U6LX4XoLgtha3RJamhD6TuecRZP5d2Nc16jkbhhE3oYHmDCoQt06C', NULL, NULL, NULL, NULL, 2, NULL, 3, 2, NULL, NULL, NULL, 'udu1kXaQY6cEHwDBcus6laVftWRgbUW1nzrmzVtEQdALWcPhYWEWmeRyfet2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12:00:00', '22:00:00', NULL, '2022-01-20 10:59:21', '2022-01-20 10:59:21'),
(166, 'asdasd', 'futurse133@hotmail.com', '00971 55 523 4234', NULL, '$2y$10$9W5TUMBdvmOOIvSm4wsPnOYDp/UDzgTlnvCQJ5H8QIDkn2BW.oPx2', NULL, NULL, NULL, NULL, 2, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12:00:00', '22:00:00', NULL, '2022-02-05 21:51:20', '2022-02-05 21:51:20'),
(169, 'asdasdasd', 'amjsad@codak.com', '00971 55 234 2342', NULL, '$2y$10$iivbWvHmO85bBekI/W2JsOupjw9fyrsj6ZZN49JRoT0VkYFnEI8Fa', NULL, NULL, NULL, NULL, 2, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12:00:00', '22:00:00', NULL, '2022-02-05 22:01:45', '2022-02-05 22:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_payment_log`
--

CREATE TABLE `accounts_payment_log` (
  `id` int(11) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `account_id` int(11) NOT NULL,
  `orderNo` varchar(200) DEFAULT NULL,
  `status` enum('renew','initial') NOT NULL,
  `code_id` int(11) DEFAULT NULL,
  `done` tinyint(4) NOT NULL,
  `done_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts_payment_log`
--

INSERT INTO `accounts_payment_log` (`id`, `amount`, `account_id`, `orderNo`, `status`, `code_id`, `done`, `done_date`, `created_at`, `updated_at`) VALUES
(5, '999', 144, NULL, 'initial', 27, 0, NULL, '2021-10-04 10:25:26', '2021-10-04 10:25:26'),
(6, '0.1', 145, 'ORD1633434473', 'initial', 27, 1, '2021-10-05 12:49:28', '2021-10-05 12:49:28', '2021-10-05 12:49:28'),
(8, '0.1', 58, 'ORD1634216802', 'renew', 27, 1, '2021-10-14 17:07:19', '2021-10-14 17:07:19', '2021-10-14 17:07:19'),
(9, '0.1', 58, 'ORD1634309367', 'renew', NULL, 1, '2021-10-15 18:49:52', '2021-10-15 18:49:52', '2021-10-15 18:49:52'),
(10, '0.1', 58, 'ORD1634309955', 'renew', NULL, 1, '2021-10-15 18:59:54', '2021-10-15 18:59:54', '2021-10-15 18:59:54'),
(11, '0.1', 58, 'ORD1634310688', 'renew', NULL, 1, '2021-10-15 19:11:56', '2021-10-15 19:11:56', '2021-10-15 19:11:56'),
(12, '0.1', 58, 'ORD1634311102', 'renew', NULL, 1, '2021-10-15 19:18:48', '2021-10-15 19:18:48', '2021-10-15 19:18:48'),
(13, '999', 61, NULL, 'initial', 27, 0, NULL, '2021-10-16 17:33:33', '2021-10-16 17:33:33'),
(17, '1499', 151, NULL, 'initial', 27, 0, NULL, '2021-10-17 10:44:17', '2021-10-17 10:44:17'),
(19, '1', 131, NULL, 'initial', 27, 0, NULL, '2021-10-18 20:10:07', '2021-10-18 20:10:07'),
(20, '1499', 133, NULL, 'initial', 27, 0, NULL, '2021-10-18 20:40:29', '2021-10-18 20:40:29'),
(21, '999', 153, NULL, 'initial', 27, 0, NULL, '2021-10-18 23:14:51', '2021-10-18 23:14:51'),
(22, '99', 158, NULL, 'initial', 27, 1, '2021-11-22 13:15:51', '2021-11-22 13:13:42', '2021-11-22 13:15:51'),
(23, '1499', 162, NULL, 'initial', 27, 0, NULL, '2021-11-29 13:42:29', '2021-11-29 13:42:29'),
(24, '0.1', 163, 'ORD1639487867', 'initial', NULL, 1, '2021-12-14 18:19:49', '2021-12-14 18:19:49', '2021-12-14 18:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_roles`
--

CREATE TABLE `accounts_roles` (
  `account_id` int(11) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts_roles`
--

INSERT INTO `accounts_roles` (`account_id`, `role_id`) VALUES
(60, 1),
(132, 3),
(146, 1);

-- --------------------------------------------------------

--
-- Table structure for table `account_currency`
--

CREATE TABLE `account_currency` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_currency`
--

INSERT INTO `account_currency` (`id`, `account_id`, `currency_id`, `created_at`, `updated_at`) VALUES
(1, 58, 1, '2021-09-26 09:44:45', NULL),
(31, 58, 2, '2021-09-28 12:19:50', NULL),
(32, 58, 3, '2021-09-28 12:19:50', NULL),
(33, 58, 4, '2021-09-28 12:19:50', NULL),
(37, 131, 4, '2021-10-04 07:17:02', NULL),
(39, 131, 2, '2021-10-18 16:17:57', NULL),
(40, 131, 3, '2021-10-18 16:17:57', NULL),
(44, 133, 1, '2021-10-18 16:51:27', NULL),
(45, 133, 3, '2021-10-18 16:51:27', NULL),
(46, 153, 2, '2021-10-18 19:17:44', NULL),
(47, 153, 3, '2021-10-18 19:17:44', NULL),
(50, 61, 1, '2021-10-20 13:57:42', NULL),
(51, 61, 2, '2021-10-20 13:59:55', NULL),
(52, 61, 3, '2021-10-20 13:59:55', NULL),
(53, 61, 4, '2021-10-20 13:59:55', NULL),
(54, 151, 1, '2021-11-04 09:59:45', NULL),
(57, 133, 2, '2021-11-04 11:03:39', NULL),
(58, 133, 4, '2021-11-04 11:04:15', NULL),
(59, 153, 1, '2021-11-04 11:18:16', NULL),
(60, 153, 4, '2021-11-04 11:18:16', NULL),
(61, 131, 1, '2021-11-04 12:36:34', NULL),
(62, 145, 1, '2021-11-10 12:39:19', NULL),
(63, 145, 2, '2021-11-10 12:39:19', NULL),
(64, 145, 3, '2021-11-10 12:39:19', NULL),
(65, 145, 4, '2021-11-10 12:39:19', NULL),
(66, 144, 1, '2021-11-10 12:41:12', NULL),
(67, 144, 2, '2021-11-10 12:41:12', NULL),
(68, 144, 3, '2021-11-10 12:41:12', NULL),
(69, 144, 4, '2021-11-10 12:41:12', NULL),
(70, 158, 1, '2021-11-22 08:16:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `account_status`
--

CREATE TABLE `account_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_status`
--

INSERT INTO `account_status` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'active', NULL, NULL),
(2, 'inactive', NULL, NULL),
(3, 'incomplete', NULL, NULL),
(4, 'pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` int(11) NOT NULL,
  `account_type_name` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `account_type_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2021-08-03 06:29:55', NULL),
(2, 'restaurant', '2021-08-03 06:29:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `account_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `area_id`, `address`, `latitude`, `longitude`, `account_id`, `created_at`, `updated_at`) VALUES
(27, 20, 'ASDA\'A BCW - Falak St - Dubai - United Arab Emirates', 25.0962478, 55.1588295, 58, '2021-08-31 05:50:50', '2022-01-20 09:00:11'),
(28, 16, 'تكنو كود لتقنية المعلومات techno code information technology - Sheikh Zayed Road - Dubai - United Arab Emirates', 25.208709931481, 55.272439785377, 61, '2021-09-08 21:00:00', '2021-11-11 15:51:36'),
(29, 2, 'test', 58.181788, 63.061267, 81, '2021-09-19 03:40:12', '2021-09-19 03:40:12'),
(30, 1, 'test', 25.253034743895014, 55.364926594551996, 62, '2021-09-19 03:40:56', '2021-09-19 03:40:56'),
(31, 1, 'test', 25.252695120620604, 55.364197033699945, 63, '2021-09-19 03:41:11', '2021-09-19 03:41:11'),
(32, 1, 'test', 25.252277867869257, 55.362727183159784, 64, '2021-09-19 03:41:15', '2021-09-19 03:41:15'),
(33, 1, 'test', 25.251540394384875, 55.36461545830627, 65, '2021-09-19 03:41:20', '2021-09-19 03:41:20'),
(34, 1, 'test', 25.25149187623551, 55.36239458924194, 66, '2021-09-19 03:41:26', '2021-09-19 03:41:26'),
(35, 2, 'test', 25.251540394384875, 55.36486222153564, 67, '2021-09-19 03:41:33', '2021-09-19 03:41:33'),
(36, 2, 'test', 25.25152098712747, 55.364712017830804, 68, '2021-09-19 03:41:38', '2021-09-19 03:41:38'),
(37, 2, 'test', 25.252404014201044, 55.36406828766723, 69, '2021-09-19 03:41:44', '2021-09-19 03:41:44'),
(38, 2, 'test', 25.251850910081902, 55.36410047417541, 70, '2021-09-19 03:41:49', '2021-09-19 03:41:49'),
(39, 2, 'test', 35.198367, -85.039223, 71, '2021-09-19 03:41:53', '2021-09-19 03:41:53'),
(40, 3, 'test', 0.007673, 28.060619, 72, '2021-09-19 03:42:01', '2021-09-19 03:42:01'),
(41, 3, 'test', -9.061909, 68.058764, 73, '2021-09-19 03:42:05', '2021-09-19 03:42:05'),
(42, 3, 'test', 23.593138, 89.980879, 74, '2021-09-19 03:42:08', '2021-09-19 03:42:08'),
(43, 3, 'test', 106.373677, 36.624595, 75, '2021-09-19 03:42:13', '2021-09-19 03:42:13'),
(44, 1, 'test', 110.879695, 73.217353, 76, '2021-09-19 03:42:17', '2021-09-19 03:42:17'),
(45, 1, 'test', 150.1569, -12.062267, 77, '2021-09-19 03:42:23', '2021-09-19 03:42:23'),
(46, 16, 'تكنو كود لتقنية المعلومات techno code information technology - Sheikh Zayed Road - Dubai - United Arab Emirates', 25.209787408879954, 55.27318007506509, 145, '2021-09-19 03:42:27', '2021-11-10 17:39:46'),
(47, 1, 'test', 111.820928, -3.148298, 79, '2021-09-19 03:42:35', '2021-09-19 03:42:35'),
(48, 3, 'test', 43.190671, 50.999788, 80, '2021-09-19 03:42:41', '2021-09-19 03:42:41'),
(49, 16, 'تكنو كود لتقنية المعلومات techno code information technology - Sheikh Zayed Road - Dubai - United Arab Emirates', 25.209748581031, 55.272171564475, 151, '2021-10-17 10:39:03', '2021-12-26 11:22:21'),
(50, 16, 'تكنو كود لتقنية المعلومات techno code information technology - Sheikh Zayed Road - Dubai - United Arab Emirates', 25.208865244127, 55.27297622718, 131, '2021-10-18 20:09:42', '2021-11-11 15:49:22'),
(51, 16, 'تكنو كود لتقنية المعلومات techno code information technology - Sheikh Zayed Road - Dubai - United Arab Emirates', 25.20932147387786, 55.27324444808145, 133, '2021-10-18 20:38:28', '2021-11-10 17:36:37'),
(52, 16, 'تكنو كود لتقنية المعلومات techno code information technology - Sheikh Zayed Road - Dubai - United Arab Emirates', 25.2067782138854, 55.27120596923013, 153, '2021-10-18 23:12:42', '2021-11-10 18:15:58'),
(53, 16, 'تكنو كود لتقنية المعلومات techno code information technology - Sheikh Zayed Road - Dubai - United Arab Emirates', 25.21060279084141, 55.27388817824502, 144, NULL, '2021-11-10 18:18:32'),
(54, 18, 'Burj Khalifa tower - Burj Khalifa Boulevard - Dubai - United Arab Emirates', 25.1967512, 55.27388749999999, 158, '2021-11-22 13:13:04', '2021-11-22 13:56:25'),
(55, 6, 'The Metropolis Tower - Burj Khalifa Boulevard - Dubai - United Arab Emirates', 25.1857263, 55.2758231, 162, '2021-11-29 13:41:40', '2021-11-29 13:41:40'),
(56, 19, 'Shawarma the chef art شاورما فن الطاهي - 35a St - دبي - الإمارات العربية المتحدة', 25.15087990000001, 55.1995343, 163, '2021-12-14 18:13:03', '2021-12-14 18:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `area_name` varchar(500) NOT NULL,
  `city_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `area_name`, `city_id`, `created_at`, `updated_at`) VALUES
(1, 'Hamra', 1, '2021-08-24 10:07:44', NULL),
(2, 'Arnous', 2, '2021-09-07 21:00:00', NULL),
(3, 'midan', 1, '2021-09-19 06:00:34', NULL),
(4, 'muhajren', 2, '2021-09-19 06:01:08', NULL),
(5, 'Sharjah International Airport ', 3, '2021-10-05 05:07:49', '2021-10-05 05:07:49'),
(6, ' Burj Khalifa Boulevard ', 3, '2021-10-04 08:09:33', '2021-10-04 08:09:33'),
(7, 'Opal Tower | Business Bay ', 3, '2021-10-05 12:31:49', '2021-10-05 12:31:49'),
(8, 'STADIUM METRO STATION ', 4, '2021-10-16 17:32:31', '2021-10-16 17:32:31'),
(9, ' Sheik Khalifa Bin Zayed Street ', 5, '2021-10-18 20:09:42', '2021-10-18 20:09:42'),
(10, 'Starbucks ', 5, '2021-10-18 20:17:30', '2021-10-18 20:17:30'),
(11, 'Air Arabia Al Ain Office ', 5, '2021-10-18 20:19:38', '2021-10-18 20:19:38'),
(12, 'Starbucks Drive Thru ', 4, '2021-10-18 23:12:42', '2021-10-18 23:12:42'),
(13, 'Spain S04 International city ', 4, '2021-10-18 23:19:02', '2021-10-18 23:19:02'),
(14, ' Sheikh Mohammed bin Rashid Boulevard ', 4, '2021-10-19 11:54:34', '2021-10-19 11:54:34'),
(15, ' Sheikh Zayed Road ', 4, '2021-10-23 12:06:29', '2021-10-23 12:06:29'),
(16, 'Sheikh Zayed Road', 6, '2021-11-10 17:32:16', '2021-11-10 17:32:16'),
(17, 'Safari Mall Sharjah ', 3, '2021-11-22 13:13:04', '2021-11-22 13:13:04'),
(18, 'Burj Khalifa Boulevard', 6, '2021-11-22 13:56:25', '2021-11-22 13:56:25'),
(19, ' 35a St ', 7, '2021-12-14 18:13:03', '2021-12-14 18:13:03'),
(20, 'Falak St', 6, '2022-01-20 09:00:11', '2022-01-20 09:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `title_ar` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `description_ar` text NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `title_ar`, `description`, `description_ar`, `image_path`, `sub_category_id`, `created_at`, `updated_at`) VALUES
(33, 'italian food', 'تيستيد', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'تيستيد', '1635318380.jpg', 2, '2021-10-27 11:06:20', '2021-10-27 18:07:30'),
(34, 'chinese', 'تيستيد', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 'تيستيد', '1635318417.jpg', 1, '2021-10-27 11:06:57', '2021-10-27 18:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `banking_details`
--

CREATE TABLE `banking_details` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `iban` varchar(50) NOT NULL,
  `account_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banking_details`
--

INSERT INTO `banking_details` (`id`, `bank_name`, `iban`, `account_id`, `created_at`, `updated_at`) VALUES
(10, 'kvet tur', 'AE07 0331 2345 6789 0123 456', 57, '2021-08-31 08:51:12', '2021-08-31 05:51:12'),
(11, 'Mashreq', 'AE30 0330 0000 1910 0556 250', 162, '2021-11-29 13:41:40', '2021-11-29 13:41:40'),
(12, 'Shawarma the chef art', 'AE58 0500 0000 0001 9021 600', 163, '2021-12-14 18:13:03', '2021-12-14 18:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `customer_id`, `status_id`, `created_at`, `updated_at`) VALUES
(31, 26, 2, '2021-11-03 14:04:50', NULL),
(32, 28, 2, '2021-11-05 16:20:47', NULL),
(33, 37, 2, '2021-11-08 07:22:48', NULL),
(34, 38, 2, '2021-11-08 07:26:07', NULL),
(35, 35, 2, '2021-11-08 07:30:51', NULL),
(36, 39, 2, '2021-11-08 07:48:16', NULL),
(37, 40, 1, '2021-11-08 11:23:06', NULL),
(38, 40, 1, '2021-11-09 07:30:23', NULL),
(39, 40, 1, '2021-11-09 07:32:59', NULL),
(40, 40, 1, '2021-11-09 07:35:21', NULL),
(41, 40, 1, '2021-11-09 19:00:11', NULL),
(42, 40, 1, '2021-11-09 19:52:22', NULL),
(43, 40, 1, '2021-11-09 20:50:27', NULL),
(44, 40, 1, '2021-11-09 20:52:27', NULL),
(45, 40, 1, '2021-11-09 21:27:38', NULL),
(46, 40, 1, '2021-11-09 21:43:48', NULL),
(47, 40, 1, '2021-11-09 21:53:23', NULL),
(48, 40, 1, '2021-11-09 22:11:01', NULL),
(49, 40, 1, '2021-11-10 05:35:19', NULL),
(50, 40, 1, '2021-11-10 05:43:48', NULL),
(51, 40, 1, '2021-11-10 05:56:39', NULL),
(52, 40, 1, '2021-11-10 06:01:12', NULL),
(53, 40, 1, '2021-11-10 06:03:08', NULL),
(54, 40, 1, '2021-11-10 06:46:15', NULL),
(55, 40, 1, '2021-11-10 08:15:14', NULL),
(56, 40, 1, '2021-11-10 08:22:18', NULL),
(57, 40, 1, '2021-11-11 08:59:44', NULL),
(58, 40, 1, '2021-11-11 10:34:21', NULL),
(59, 40, 1, '2021-11-11 10:42:08', NULL),
(60, 40, 1, '2021-11-11 11:05:17', NULL),
(61, 40, 1, '2021-11-12 09:29:48', NULL),
(62, 40, 1, '2021-11-12 19:13:52', NULL),
(63, 40, 1, '2021-11-12 19:16:04', NULL),
(64, 40, 1, '2021-11-13 13:16:16', NULL),
(65, 40, 1, '2021-11-14 07:30:17', NULL),
(66, 20, 2, '2021-11-14 07:41:14', NULL),
(67, 47, 1, '2021-11-14 08:43:43', NULL),
(68, 40, 1, '2021-11-17 08:18:19', NULL),
(69, 40, 1, '2021-11-17 08:45:05', NULL),
(70, 40, 1, '2021-11-17 14:50:13', NULL),
(71, 47, 1, '2021-11-18 09:35:08', NULL),
(72, 40, 1, '2021-11-18 12:50:34', NULL),
(73, 40, 1, '2021-11-18 13:24:51', NULL),
(74, 40, 1, '2021-11-19 10:40:21', NULL),
(75, 40, 1, '2021-11-19 10:44:03', NULL),
(76, 1, 2, '2021-11-20 12:36:35', NULL),
(77, 40, 1, '2021-11-20 13:39:25', NULL),
(78, 40, 1, '2021-11-21 14:59:37', NULL),
(79, 50, 2, '2021-11-22 10:01:03', NULL),
(80, 40, 1, '2021-11-22 10:03:24', NULL),
(81, 40, 1, '2021-11-22 13:25:46', NULL),
(82, 40, 1, '2021-11-22 13:37:37', NULL),
(83, 40, 1, '2021-11-22 13:54:19', NULL),
(84, 40, 1, '2021-11-23 06:19:16', NULL),
(85, 40, 1, '2021-11-23 10:43:49', NULL),
(86, 40, 1, '2021-11-23 10:50:03', NULL),
(87, 40, 1, '2021-11-23 10:56:46', NULL),
(88, 40, 1, '2021-11-24 10:44:41', NULL),
(89, 46, 2, '2021-11-26 14:57:30', NULL),
(90, 40, 1, '2021-11-27 10:03:12', NULL),
(91, 40, 1, '2021-11-27 10:32:55', NULL),
(92, 40, 1, '2021-11-27 11:12:13', NULL),
(93, 40, 1, '2021-11-27 12:20:28', NULL),
(94, 40, 1, '2021-11-27 13:48:22', NULL),
(95, 40, 1, '2021-11-27 15:15:54', NULL),
(96, 40, 1, '2021-11-27 15:22:00', NULL),
(97, 40, 1, '2021-11-27 18:14:31', NULL),
(98, 47, 1, '2021-11-28 06:47:56', NULL),
(99, 40, 1, '2021-11-28 11:25:29', NULL),
(100, 40, 1, '2021-11-28 11:26:58', NULL),
(101, 40, 1, '2021-11-28 11:30:39', NULL),
(102, 40, 1, '2021-11-28 11:32:01', NULL),
(103, 40, 1, '2021-11-28 11:32:59', NULL),
(104, 40, 1, '2021-11-28 11:35:13', NULL),
(105, 40, 1, '2021-11-28 12:35:38', NULL),
(106, 47, 1, '2021-11-28 12:55:23', NULL),
(107, 47, 1, '2021-11-28 12:57:23', NULL),
(108, 40, 1, '2021-11-29 09:56:06', NULL),
(109, 40, 2, '2021-11-30 07:26:34', NULL),
(110, 47, 1, '2021-12-01 18:06:20', NULL),
(111, 47, 2, '2021-12-04 09:27:56', NULL),
(112, 22, 1, '2021-12-09 06:24:12', NULL),
(113, 22, 1, '2022-01-03 10:41:47', NULL),
(114, 22, 2, '2022-01-03 10:55:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `item_count` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `item_id`, `offer_id`, `item_count`, `created_at`, `updated_at`) VALUES
(2, 32, 206, NULL, 5, '2021-11-07 07:50:15', NULL),
(3, 33, 173, NULL, 4, '2021-11-08 07:22:48', NULL),
(4, 34, 173, NULL, 4, '2021-11-08 07:26:07', NULL),
(5, 35, 173, NULL, 4, '2021-11-08 07:30:51', NULL),
(6, 37, 173, NULL, 4, '2021-11-08 11:23:08', NULL),
(7, 38, 173, NULL, 4, '2021-11-09 07:30:23', NULL),
(8, 39, 173, NULL, 4, '2021-11-09 07:32:59', NULL),
(22, 40, 60, NULL, 1, '2021-11-09 18:21:47', NULL),
(23, 41, 173, NULL, 4, '2021-11-09 19:00:12', NULL),
(24, 42, 179, NULL, 1, '2021-11-09 19:52:22', NULL),
(25, 43, 173, NULL, 4, '2021-11-09 20:50:27', NULL),
(26, 44, 173, NULL, 4, '2021-11-09 20:52:27', NULL),
(27, 45, 59, NULL, 1, '2021-11-09 21:27:38', NULL),
(28, 46, 173, NULL, 1, '2021-11-09 21:43:49', NULL),
(29, 47, 203, NULL, 1, '2021-11-09 21:53:23', NULL),
(30, 48, 204, NULL, 1, '2021-11-09 22:11:01', NULL),
(31, 49, 204, NULL, 1, '2021-11-10 05:35:19', NULL),
(32, 50, 206, NULL, 1, '2021-11-10 05:43:49', NULL),
(34, 51, 179, NULL, 1, '2021-11-10 05:58:35', NULL),
(35, 52, 205, NULL, 1, '2021-11-10 06:01:12', NULL),
(36, 53, 61, NULL, 3, '2021-11-10 06:03:09', NULL),
(37, 54, 205, NULL, 1, '2021-11-10 06:46:16', NULL),
(38, 55, 205, NULL, 1, '2021-11-10 08:15:14', NULL),
(47, 56, 60, NULL, 1, '2021-11-11 08:33:17', NULL),
(49, 57, 204, NULL, 1, '2021-11-11 10:23:35', NULL),
(50, 58, 178, NULL, 1, '2021-11-11 10:34:21', NULL),
(52, 59, 189, NULL, 1, '2021-11-11 10:43:50', NULL),
(55, 60, 188, NULL, 1, '2021-11-12 09:25:39', NULL),
(58, 61, 203, NULL, 1, '2021-11-12 19:13:12', NULL),
(59, 62, 173, NULL, 4, '2021-11-12 19:13:52', NULL),
(60, 63, 203, NULL, 1, '2021-11-12 19:16:04', NULL),
(64, 64, 173, NULL, 4, '2021-11-14 06:42:46', NULL),
(78, 66, 173, NULL, 3, '2021-11-16 10:56:22', NULL),
(80, 65, 173, NULL, 4, '2021-11-16 13:20:28', NULL),
(81, 68, 173, NULL, 1, '2021-11-17 08:18:19', NULL),
(82, 68, 178, NULL, 1, '2021-11-17 08:18:22', NULL),
(84, 69, 173, NULL, 4, '2021-11-17 09:11:36', NULL),
(86, 69, 178, NULL, 2, '2021-11-17 14:17:14', NULL),
(87, 69, 175, NULL, 1, '2021-11-17 14:42:38', NULL),
(88, 69, 174, NULL, 1, '2021-11-17 14:42:41', NULL),
(89, 70, 203, NULL, 1, '2021-11-17 14:50:13', NULL),
(90, 67, 175, NULL, 2, '2021-11-18 09:31:53', NULL),
(91, 67, 58, NULL, 1, '2021-11-18 09:31:58', NULL),
(95, 72, 181, NULL, 5, '2021-11-18 13:11:42', NULL),
(96, 73, 173, NULL, 4, '2021-11-18 13:24:51', NULL),
(97, 74, 187, NULL, 3, '2021-11-19 10:40:21', NULL),
(99, 71, 178, NULL, 1, '2021-11-20 06:57:24', NULL),
(100, 71, 173, NULL, 1, '2021-11-20 06:57:39', NULL),
(103, 75, 59, NULL, 1, '2021-11-20 11:07:51', NULL),
(104, 76, 180, NULL, 6, '2021-11-20 12:36:36', NULL),
(105, 77, 173, NULL, 10, '2021-11-20 13:39:25', NULL),
(106, 78, 173, NULL, 4, '2021-11-21 14:59:37', NULL),
(107, 79, 207, NULL, 1, '2021-11-22 10:01:03', NULL),
(108, 80, 59, NULL, 1, '2021-11-22 10:03:24', NULL),
(109, 80, 173, NULL, 4, '2021-11-22 10:04:03', NULL),
(111, 81, 209, NULL, 2, '2021-11-22 13:27:11', NULL),
(112, 81, 210, NULL, 2, '2021-11-22 13:28:41', NULL),
(115, 82, 59, 2, 2, '2021-11-22 13:39:54', NULL),
(116, 83, 207, NULL, 1, '2021-11-22 13:54:19', NULL),
(117, 83, 205, NULL, 1, '2021-11-22 13:54:26', NULL),
(122, 84, 173, NULL, 3, '2021-11-23 10:27:41', NULL),
(123, 85, 187, NULL, 1, '2021-11-23 10:43:49', NULL),
(124, 86, 201, NULL, 1, '2021-11-23 10:50:03', NULL),
(125, 87, 192, NULL, 1, '2021-11-23 10:56:46', NULL),
(126, 87, 194, NULL, 2, '2021-11-23 10:57:05', NULL),
(128, 89, 179, NULL, 1, '2021-11-26 15:38:18', NULL),
(129, 89, 66, NULL, 1, '2021-11-26 18:41:05', NULL),
(139, 88, 173, NULL, 1, '2021-11-27 06:52:28', NULL),
(140, 90, 181, NULL, 1, '2021-11-27 10:03:12', NULL),
(141, 91, 173, NULL, 1, '2021-11-27 10:32:55', NULL),
(144, 92, 85, NULL, 1, '2021-11-27 12:04:59', NULL),
(145, 92, 179, NULL, 1, '2021-11-27 12:16:06', NULL),
(146, 93, 58, 7, 1, '2021-11-27 12:20:29', NULL),
(147, 94, 66, NULL, 1, '2021-11-27 13:48:22', NULL),
(148, 95, 58, 7, 1, '2021-11-27 15:15:54', NULL),
(149, 96, 58, 7, 1, '2021-11-27 15:22:00', NULL),
(150, 96, 173, NULL, 1, '2021-11-27 17:01:59', NULL),
(155, 98, 210, NULL, 2, '2021-11-28 06:47:56', NULL),
(156, 98, 209, NULL, 1, '2021-11-28 06:47:58', NULL),
(167, 97, 178, NULL, 2, '2021-11-28 11:23:17', NULL),
(168, 99, 178, NULL, 1, '2021-11-28 11:25:29', NULL),
(169, 100, 178, NULL, 1, '2021-11-28 11:26:58', NULL),
(170, 101, 178, NULL, 1, '2021-11-28 11:30:39', NULL),
(171, 102, 178, NULL, 1, '2021-11-28 11:32:01', NULL),
(172, 103, 59, 1, 1, '2021-11-28 11:32:59', NULL),
(173, 104, 178, NULL, 1, '2021-11-28 11:35:14', NULL),
(174, 105, 173, NULL, 2, '2021-11-28 12:35:38', NULL),
(175, 106, 210, NULL, 1, '2021-11-28 12:55:23', NULL),
(176, 107, 209, NULL, 1, '2021-11-28 12:57:23', NULL),
(177, 107, 210, NULL, 1, '2021-11-28 12:57:28', NULL),
(178, 108, 192, NULL, 1, '2021-11-29 09:56:06', NULL),
(180, 110, 174, NULL, 1, '2021-12-01 18:06:20', NULL),
(239, 111, 181, NULL, 1, '2022-01-01 05:38:08', NULL),
(240, 112, 207, NULL, 1, '2022-01-03 10:40:15', NULL),
(241, 113, 174, NULL, 1, '2022-01-03 10:41:47', NULL),
(243, 114, 207, NULL, 1, '2022-01-03 12:18:36', NULL),
(244, 114, 205, NULL, 1, '2022-01-03 12:18:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items_component`
--

CREATE TABLE `cart_items_component` (
  `id` int(11) NOT NULL,
  `cart_item_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_items_component`
--

INSERT INTO `cart_items_component` (`id`, `cart_item_id`, `component_id`, `created_at`, `updated_at`) VALUES
(2, 2, 48, '2021-11-07 07:50:15', NULL),
(3, 3, 22, '2021-11-08 07:22:48', NULL),
(4, 4, 22, '2021-11-08 07:26:07', NULL),
(5, 5, 22, '2021-11-08 07:30:51', NULL),
(6, 6, 22, '2021-11-08 11:23:08', NULL),
(7, 7, 22, '2021-11-09 07:30:23', NULL),
(9, 8, 22, '2021-11-09 07:32:59', NULL),
(36, 22, 23, '2021-11-09 18:21:47', NULL),
(37, 22, 24, '2021-11-09 18:21:47', NULL),
(38, 23, 22, '2021-11-09 19:00:12', NULL),
(40, 24, 23, '2021-11-09 19:52:22', NULL),
(41, 24, 24, '2021-11-09 19:52:22', NULL),
(42, 25, 22, '2021-11-09 20:50:27', NULL),
(44, 26, 22, '2021-11-09 20:52:27', NULL),
(46, 27, 23, '2021-11-09 21:27:38', NULL),
(47, 28, 22, '2021-11-09 21:43:49', NULL),
(48, 29, 27, '2021-11-09 21:53:23', NULL),
(49, 29, 47, '2021-11-09 21:53:23', NULL),
(50, 30, 47, '2021-11-09 22:11:01', NULL),
(51, 30, 48, '2021-11-09 22:11:01', NULL),
(52, 31, 47, '2021-11-10 05:35:20', NULL),
(53, 31, 48, '2021-11-10 05:35:20', NULL),
(54, 32, 48, '2021-11-10 05:43:49', NULL),
(55, 32, 49, '2021-11-10 05:43:50', NULL),
(56, 32, 50, '2021-11-10 05:43:50', NULL),
(60, 34, 24, '2021-11-10 05:58:35', NULL),
(61, 35, 49, '2021-11-10 06:01:14', NULL),
(62, 35, 50, '2021-11-10 06:01:15', NULL),
(63, 36, 22, '2021-11-10 06:03:10', NULL),
(64, 36, 23, '2021-11-10 06:03:11', NULL),
(65, 36, 24, '2021-11-10 06:03:11', NULL),
(66, 37, 49, '2021-11-10 06:46:16', NULL),
(67, 37, 50, '2021-11-10 06:46:16', NULL),
(68, 38, 49, '2021-11-10 08:15:14', NULL),
(69, 38, 50, '2021-11-10 08:15:14', NULL),
(87, 47, 23, '2021-11-11 08:33:17', NULL),
(90, 49, 47, '2021-11-11 10:23:35', NULL),
(91, 50, 23, '2021-11-11 10:34:21', NULL),
(92, 50, 24, '2021-11-11 10:34:21', NULL),
(93, 52, 32, '2021-11-11 10:43:50', NULL),
(94, 52, 34, '2021-11-11 10:43:50', NULL),
(95, 52, 35, '2021-11-11 10:43:50', NULL),
(99, 55, 33, '2021-11-12 09:25:40', NULL),
(104, 58, 27, '2021-11-12 19:13:12', NULL),
(105, 58, 47, '2021-11-12 19:13:20', NULL),
(106, 59, 22, '2021-11-12 19:13:52', NULL),
(108, 60, 27, '2021-11-12 19:16:04', NULL),
(109, 60, 47, '2021-11-12 19:16:04', NULL),
(113, 64, 22, '2021-11-14 06:42:46', NULL),
(126, 78, 22, '2021-11-16 10:56:22', NULL),
(129, 80, 22, '2021-11-16 13:20:29', NULL),
(131, 81, 22, '2021-11-17 08:18:19', NULL),
(132, 82, 23, '2021-11-17 08:18:22', NULL),
(133, 82, 24, '2021-11-17 08:18:22', NULL),
(136, 87, 23, '2021-11-17 14:42:38', NULL),
(137, 88, 23, '2021-11-17 14:42:41', NULL),
(138, 86, 23, '2021-11-17 14:42:50', NULL),
(139, 86, 24, '2021-11-17 14:42:50', NULL),
(140, 89, 27, '2021-11-17 14:50:13', NULL),
(141, 89, 47, '2021-11-17 14:50:13', NULL),
(142, 90, 23, '2021-11-18 09:31:53', NULL),
(143, 90, 24, '2021-11-18 09:31:53', NULL),
(144, 91, 23, '2021-11-18 09:31:58', NULL),
(145, 91, 24, '2021-11-18 09:31:58', NULL),
(150, 95, 27, '2021-11-18 13:11:43', NULL),
(151, 97, 33, '2021-11-19 10:40:21', NULL),
(152, 97, 34, '2021-11-19 10:40:21', NULL),
(153, 97, 35, '2021-11-19 10:40:21', NULL),
(157, 99, 23, '2021-11-20 06:57:24', NULL),
(158, 99, 24, '2021-11-20 06:57:24', NULL),
(159, 100, 23, '2021-11-20 06:57:39', NULL),
(160, 100, 24, '2021-11-20 06:57:39', NULL),
(165, 103, 23, '2021-11-20 11:07:51', NULL),
(166, 105, 22, '2021-11-20 13:40:34', NULL),
(167, 107, 27, '2021-11-22 10:01:03', NULL),
(168, 107, 48, '2021-11-22 10:01:03', NULL),
(169, 108, 23, '2021-11-22 10:03:24', NULL),
(173, 112, 54, '2021-11-22 13:29:17', NULL),
(174, 115, 23, '2021-11-22 13:41:03', NULL),
(175, 116, 27, '2021-11-22 13:54:19', NULL),
(176, 116, 48, '2021-11-22 13:54:20', NULL),
(177, 117, 49, '2021-11-22 13:54:26', NULL),
(178, 117, 50, '2021-11-22 13:54:26', NULL),
(183, 122, 22, '2021-11-23 10:40:54', NULL),
(184, 123, 33, '2021-11-23 10:43:49', NULL),
(185, 123, 34, '2021-11-23 10:43:49', NULL),
(186, 123, 35, '2021-11-23 10:43:49', NULL),
(187, 124, 42, '2021-11-23 10:50:04', NULL),
(188, 124, 43, '2021-11-23 10:50:04', NULL),
(189, 124, 44, '2021-11-23 10:50:04', NULL),
(190, 125, 37, '2021-11-23 10:56:46', NULL),
(191, 125, 38, '2021-11-23 10:56:46', NULL),
(192, 125, 40, '2021-11-23 10:56:46', NULL),
(195, 126, 40, '2021-11-23 10:57:05', NULL),
(196, 126, 39, '2021-11-23 10:57:19', NULL),
(197, 126, 41, '2021-11-23 10:57:19', NULL),
(199, 128, 23, '2021-11-26 15:38:18', NULL),
(200, 128, 24, '2021-11-26 15:38:18', NULL),
(201, 129, 24, '2021-11-26 18:41:05', NULL),
(202, 129, 23, '2021-11-26 18:41:05', NULL),
(214, 140, 27, '2021-11-27 10:03:12', NULL),
(215, 141, 22, '2021-11-27 10:32:55', NULL),
(218, 145, 23, '2021-11-27 12:16:06', NULL),
(219, 145, 24, '2021-11-27 12:16:06', NULL),
(220, 146, 23, '2021-11-27 12:20:29', NULL),
(221, 147, 23, '2021-11-27 13:48:22', NULL),
(222, 147, 24, '2021-11-27 13:48:22', NULL),
(223, 148, 23, '2021-11-27 15:15:54', NULL),
(224, 149, 23, '2021-11-27 15:22:00', NULL),
(225, 150, 22, '2021-11-27 17:01:59', NULL),
(230, 155, 54, '2021-11-28 06:47:56', NULL),
(231, 156, 51, '2021-11-28 06:47:58', NULL),
(232, 156, 52, '2021-11-28 06:47:58', NULL),
(233, 156, 53, '2021-11-28 06:47:58', NULL),
(248, 168, 24, '2021-11-28 11:25:29', NULL),
(249, 168, 23, '2021-11-28 11:25:29', NULL),
(250, 169, 23, '2021-11-28 11:26:58', NULL),
(251, 169, 24, '2021-11-28 11:26:58', NULL),
(252, 170, 23, '2021-11-28 11:30:40', NULL),
(253, 170, 24, '2021-11-28 11:30:40', NULL),
(254, 171, 24, '2021-11-28 11:32:02', NULL),
(255, 171, 23, '2021-11-28 11:32:02', NULL),
(256, 172, 23, '2021-11-28 11:32:59', NULL),
(257, 173, 23, '2021-11-28 11:35:14', NULL),
(258, 173, 24, '2021-11-28 11:35:14', NULL),
(260, 175, 54, '2021-11-28 12:55:23', NULL),
(261, 176, 51, '2021-11-28 12:57:23', NULL),
(262, 176, 52, '2021-11-28 12:57:23', NULL),
(263, 176, 53, '2021-11-28 12:57:24', NULL),
(264, 177, 51, '2021-11-28 12:57:28', NULL),
(265, 177, 52, '2021-11-28 12:57:28', NULL),
(266, 177, 53, '2021-11-28 12:57:28', NULL),
(267, 178, 37, '2021-11-29 09:56:07', NULL),
(268, 178, 38, '2021-11-29 09:56:07', NULL),
(269, 178, 40, '2021-11-29 09:56:07', NULL),
(271, 180, 23, '2021-12-01 18:06:20', NULL),
(392, 239, 27, '2022-01-01 05:38:09', NULL),
(393, 240, 27, '2022-01-03 10:40:15', NULL),
(394, 240, 48, '2022-01-03 10:40:15', NULL),
(395, 241, 23, '2022-01-03 10:41:47', NULL),
(397, 243, 49, '2022-01-03 12:18:36', NULL),
(398, 243, 50, '2022-01-03 12:18:36', NULL),
(399, 244, 49, '2022-01-03 12:18:46', NULL),
(400, 244, 50, '2022-01-03 12:18:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_status`
--

CREATE TABLE `cart_status` (
  `id` int(11) NOT NULL,
  `status_name_en` varchar(500) CHARACTER SET utf8 NOT NULL,
  `status_name_ar` varchar(500) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_status`
--

INSERT INTO `cart_status` (`id`, `status_name_en`, `status_name_ar`, `created_at`) VALUES
(1, 'close', 'مغلقة', '2021-10-13 08:09:46'),
(2, 'open', 'جاري الاستخدام', '2021-10-13 08:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name_ar` varchar(500) NOT NULL,
  `sort_id` int(11) DEFAULT NULL,
  `category_photo` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_name_ar`, `sort_id`, `category_photo`, `created_at`, `updated_at`) VALUES
(1, 'Vegetarian', 'نباتي', 8, 'Vegetarian.jpg', NULL, '2022-01-03 16:44:21'),
(2, 'Cafe', 'كافيه', 5, 'Cafe.jpg', NULL, '2022-01-03 16:43:58'),
(3, 'Bakery & Cakes', 'مخبوزات وكعك', 1, 'FOODANDBEVERAGESICONS-08.jpg', NULL, '2021-12-16 18:42:25'),
(4, 'Restaurants', 'مطعم', 3, 'FOODANDBEVERAGESICONS-06.jpg', '2021-08-10 06:26:38', '2022-01-03 16:42:57'),
(5, 'BBQ & Grills', 'مشاوي و باربيكيو', 2, 'FOODANDBEVERAGESICONS-02.jpg', '2021-09-20 08:25:40', '2021-12-16 22:23:16'),
(6, 'Beverages', 'المشروبات', 7, 'FOODANDBEVERAGESICONS-03.jpg', '2021-10-23 14:33:24', '2021-12-16 11:42:08'),
(7, 'Cuisines', 'طعام خاص', 6, 'FOODANDBEVERAGESICONS-05.jpg', '2021-11-17 13:24:28', '2022-01-03 16:46:33'),
(8, 'Groceries', 'البقالة', 4, 'Grocery(1).jpg', '2021-12-16 11:15:26', '2022-01-03 16:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `city_name` varchar(500) NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city_name`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Homs', 1, '2021-08-24 10:07:19', NULL),
(2, 'Damascus', 1, '2021-09-07 21:00:00', NULL),
(3, ' Sharjah ', 2, '2021-10-05 05:07:49', '2021-10-05 05:07:49'),
(4, ' Dubai ', 2, '2021-10-16 17:32:31', '2021-10-16 17:32:31'),
(5, ' Abu Dhabi ', 2, '2021-10-18 20:09:42', '2021-10-18 20:09:42'),
(6, 'Dubai', 3, '2021-11-10 17:32:16', '2021-11-10 17:32:16'),
(7, ' دبي ', 4, '2021-12-14 18:13:03', '2021-12-14 18:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment_text` varchar(5000) NOT NULL,
  `source_id` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `destination_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment_text`, `source_id`, `is_read`, `destination_id`, `created_at`) VALUES
(1, 'test', 1, 0, 58, '2021-10-27 20:33:42');

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE `component` (
  `id` int(11) NOT NULL,
  `component_name_en` varchar(500) NOT NULL,
  `component_name_ar` varchar(500) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`id`, `component_name_en`, `component_name_ar`, `created_by`, `created_at`, `updated_at`) VALUES
(9, 'lettuce', 'خس', 0, '2021-08-18 07:53:42', '2021-08-18 07:54:23'),
(10, 'Bread', 'خبز', 0, '2021-08-22 08:39:28', '2021-08-22 08:39:28'),
(11, 'Meat', 'لحم', 0, '2021-08-22 08:39:49', '2021-08-22 08:39:49'),
(12, 'Tomato', 'بندورة', 0, '2021-09-19 03:58:41', '2021-09-19 03:58:41'),
(13, 'pickles', 'مخلل', 0, '2021-09-19 03:59:50', '2021-09-19 03:59:50'),
(14, 'coriander', 'كزبرة', 0, '2021-09-19 04:00:48', '2021-09-19 04:00:48'),
(15, 'mint', 'نعنع', 0, '2021-09-19 04:01:12', '2021-09-19 04:01:12'),
(16, 'chicken breast', 'صدر دجاج', 0, '2021-09-19 04:01:40', '2021-09-19 04:01:40'),
(17, 'meatballs', 'كفتة', 0, '2021-09-19 04:02:41', '2021-09-19 04:02:41'),
(18, 'peas', 'بازلاء', 0, '2021-09-19 04:03:16', '2021-09-19 04:03:16'),
(19, 'Carrots', 'جزر', 0, '2021-09-19 04:05:52', '2021-09-19 04:05:52'),
(20, 'toast', 'خبز محمص', 0, '2021-09-19 04:06:25', '2021-09-19 04:06:25'),
(22, 'cucamber', 'خيار', 58, '2021-10-07 07:15:34', '2021-10-26 16:42:48'),
(23, 'potato', 'بطاطا', 58, '2021-10-07 08:23:19', '2021-10-26 16:42:22'),
(24, 'cheese', 'جبنة', 58, '2021-10-10 05:04:46', '2021-10-26 16:42:36'),
(25, 'Carrots', 'جزر', 151, '2021-10-17 11:39:55', '2021-12-21 15:56:45'),
(26, 'Mint', 'نعنع', 131, '2021-10-19 11:13:48', '2021-10-19 11:13:48'),
(27, 'test', 'تيست', 61, '2021-10-19 16:04:01', '2021-10-19 16:04:01'),
(28, 'Beef', 'لحم', 151, '2021-10-23 15:30:44', '2021-12-21 15:57:15'),
(29, 'dummy component', 'مكون عشوائي', 131, '2021-11-04 13:49:24', '2021-11-04 13:49:24'),
(30, 'dummy component 1', 'مكون عشوائي 1', 131, '2021-11-04 13:49:47', '2021-11-04 13:49:47'),
(31, 'dummy component 2', 'مكون عشوائي 2', 131, '2021-11-04 13:50:11', '2021-11-04 13:50:11'),
(32, 'Raisin', 'زبيب', 151, '2021-11-04 14:00:52', '2021-12-21 15:55:30'),
(33, 'Steamed Rice', 'الأرز على البخار', 151, '2021-11-04 14:02:10', '2021-12-21 15:54:51'),
(34, 'Almond-onion paste', 'معجون اللوز والبصل', 151, '2021-11-04 14:02:25', '2021-12-21 16:11:23'),
(35, 'Lamb', 'خروف', 151, '2021-11-04 14:02:42', '2021-12-21 16:12:25'),
(36, 'Cooking oil', 'زيت الطهي', 151, '2021-11-04 14:04:40', '2021-12-21 16:13:32'),
(37, 'test', 'تيست', 133, '2021-11-04 15:00:19', '2021-11-04 15:00:19'),
(38, 'dummy component 1', 'مكون عشوائي 1', 133, '2021-11-04 15:01:33', '2021-11-04 15:01:33'),
(39, 'dummy component 2', 'مكون عشوائي 2', 133, '2021-11-04 15:01:49', '2021-11-04 15:01:49'),
(40, 'dummy component 3', 'مكون عشوائي 3', 133, '2021-11-04 15:02:04', '2021-11-04 15:02:04'),
(41, 'dummy component', 'مكون عشوائي', 133, '2021-11-04 15:02:20', '2021-11-04 15:02:20'),
(42, 'test', 'تيست', 153, '2021-11-04 15:19:27', '2021-11-04 15:19:27'),
(43, 'dummy component', 'مكون عشوائي', 153, '2021-11-04 15:21:56', '2021-11-04 15:21:56'),
(44, 'dummy component 1', 'مكون عشوائي 1', 153, '2021-11-04 15:22:11', '2021-11-04 15:22:11'),
(45, 'dummy component 2', 'مكون عشوائي 2', 153, '2021-11-04 15:22:24', '2021-11-04 15:22:24'),
(46, 'dummy component 3', 'مكون عشوائي 3', 153, '2021-11-04 15:22:37', '2021-11-04 15:22:37'),
(47, 'dummy component', 'مكون عشوائي', 61, '2021-11-04 15:37:15', '2021-11-04 15:37:15'),
(48, 'dummy component 3', 'مكون عشوائي 3', 61, '2021-11-04 15:37:57', '2021-11-04 15:38:40'),
(49, 'dummy component 2', 'مكون عشوائي 2', 61, '2021-11-04 15:38:24', '2021-11-04 15:38:24'),
(50, 'dummy component 1', 'مكون عشوائي 1', 61, '2021-11-04 15:38:57', '2021-11-04 15:38:57'),
(51, 'Rice', 'رز', 158, '2021-11-22 15:10:03', '2021-11-22 15:10:03'),
(52, 'Spices', 'توابل', 158, '2021-11-22 15:10:50', '2021-11-22 15:10:50'),
(53, 'Meat', 'لحم', 158, '2021-11-22 15:11:22', '2021-11-22 15:11:22'),
(54, 'Salat', 'سلطة', 158, '2021-11-22 15:20:27', '2021-11-22 15:20:27'),
(55, 'Yogurt', 'زبادي', 151, '2021-12-21 16:14:21', '2021-12-21 16:14:21'),
(56, 'Water', 'ماء', 151, '2021-12-21 16:15:05', '2021-12-21 16:15:05'),
(57, 'Chicken', 'دجاج', 151, '2021-12-21 16:16:52', '2021-12-21 16:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `component_price_currency`
--

CREATE TABLE `component_price_currency` (
  `id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `acc_currency_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `component_price_currency`
--

INSERT INTO `component_price_currency` (`id`, `component_id`, `price`, `acc_currency_id`, `created_by`, `created_at`, `updated_at`) VALUES
(11, 26, 3, 37, 131, '2021-10-19 07:13:48', NULL),
(12, 26, 1, 39, 131, '2021-10-19 07:13:48', NULL),
(13, 26, 1, 40, 131, '2021-10-19 07:13:49', NULL),
(14, 27, 50, 50, 61, '2021-10-19 12:04:01', NULL),
(15, 27, 50, 51, 61, '2021-10-19 12:04:02', NULL),
(16, 27, 50, 52, 61, '2021-10-19 12:04:02', NULL),
(19, 23, 1, 1, 58, '2021-10-26 12:42:22', NULL),
(20, 23, 4, 31, 58, '2021-10-26 12:42:22', NULL),
(21, 23, 3, 32, 58, '2021-10-26 12:42:22', NULL),
(22, 23, 1, 33, 58, '2021-10-26 12:42:22', NULL),
(24, 24, 2, 1, 58, '2021-10-26 12:42:36', NULL),
(25, 24, 4, 31, 58, '2021-10-26 12:42:36', NULL),
(26, 24, 3, 32, 58, '2021-10-26 12:42:37', NULL),
(27, 24, 1, 33, 58, '2021-10-26 12:42:37', NULL),
(29, 22, 6, 1, 58, '2021-10-26 12:42:48', NULL),
(30, 22, 4, 31, 58, '2021-10-26 12:42:48', NULL),
(31, 22, 3, 32, 58, '2021-10-26 12:42:49', NULL),
(32, 22, 1, 33, 58, '2021-10-26 12:42:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `country_name` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `created_at`, `updated_at`) VALUES
(1, 'syria', '2021-08-24 10:07:05', NULL),
(2, ' United Arab Emirates', '2021-10-05 05:07:49', '2021-10-05 05:07:49'),
(3, 'United Arab Emirates', '2021-11-10 17:32:16', '2021-11-10 17:32:16'),
(4, ' الإمارات العربية المتحدة', '2021-12-14 18:13:03', '2021-12-14 18:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(500) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_currency`
--

CREATE TABLE `coupon_currency` (
  `id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `acc_currency_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_status`
--

CREATE TABLE `coupon_status` (
  `id` int(11) NOT NULL,
  `status_name_en` varchar(500) NOT NULL,
  `status_name_ar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon_status`
--

INSERT INTO `coupon_status` (`id`, `status_name_en`, `status_name_ar`) VALUES
(1, 'active', 'فعال'),
(2, 'inactive', 'غير فعال');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `currency_name` varchar(500) NOT NULL,
  `currency_name_ar` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `currency_name`, `currency_name_ar`, `created_at`) VALUES
(1, 'AED', 'الدرهم الإماراتي', '2021-09-21 08:07:49'),
(2, 'SA', 'الريال السعودي', '2021-09-21 08:07:49'),
(3, 'KDW', 'الدينار الكويتي', '2021-09-28 05:22:50'),
(4, 'Dirham ', 'درهم', '2021-09-28 05:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status_id` int(11) NOT NULL,
  `main_id` int(11) NOT NULL DEFAULT 0,
  `platform_id` varchar(225) DEFAULT NULL,
  `login_token` longtext DEFAULT NULL,
  `platform_kind` enum('facebook','google','apple') DEFAULT NULL,
  `verification_link` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `email`, `phone_number`, `password`, `status_id`, `main_id`, `platform_id`, `login_token`, `platform_kind`, `verification_link`, `created_at`, `updated_at`) VALUES
(1, 'Nigel Terry', 'ally.hyatt@example.org', '713-702-5801', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, NULL, 'wQroqLMqyHkZYuWI0zWBtp2V0xtlvBS4NO55sWjfaYTCWhFNkDm1EbtTfbJh', NULL, 'wQroqLMqyHkZYuWI0zWBtp2V0xtlvBS4NO55sWjfaYTCWhFNkDm1EbtTfbJh', '2021-08-29 14:43:26', '2021-10-26 21:39:54'),
(2, 'Celine Krajcik', 'asanford@example.org', '+1-509-920-5355', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 0, NULL, NULL, NULL, NULL, '2021-08-29 14:43:26', '2021-10-17 13:26:51'),
(3, 'Ewald Gutkowski PhD', 'yesenia57@example.com', '916-507-3273', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 0, NULL, NULL, NULL, NULL, '2021-08-29 14:43:26', '2021-08-29 14:43:26'),
(4, 'Miss Heath Veum MD', 'kassulke.clay@example.net', '+1-682-785-1557', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 0, NULL, NULL, NULL, NULL, '2021-08-29 14:43:26', '2021-08-29 14:43:26'),
(5, 'Prof. Burley Reinger', 'chelsie.bins@example.org', '+1-731-942-0290', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 0, NULL, NULL, NULL, NULL, '2021-08-29 14:43:26', '2021-08-29 14:43:26'),
(6, 'Aditya Keebler', 'talia.grimes@example.net', '1-240-760-2631', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 0, NULL, NULL, NULL, NULL, '2021-08-29 14:43:26', '2021-08-29 14:43:26'),
(7, 'Prof. Jerad Corkery', 'whitney.heaney@example.com', '1-541-783-3919', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 0, NULL, NULL, NULL, NULL, '2021-08-29 14:43:26', '2021-08-29 14:43:26'),
(8, 'Elinor Torphy IV', 'iva25@example.org', '352.559.6229', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 0, NULL, NULL, NULL, NULL, '2021-08-29 14:43:26', '2021-08-29 14:43:26'),
(9, 'Milo Wiegand', 'emmanuelle78@example.com', '+1-234-445-5094', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 0, NULL, NULL, NULL, NULL, '2021-08-29 14:43:26', '2021-08-29 14:43:26'),
(10, 'Sheldon Zboncak', 'sigmund.upton@example.net', '559-348-4952', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 0, NULL, NULL, NULL, NULL, '2021-08-29 14:43:26', '2021-10-17 13:40:32'),
(15, 'testCustomer', 'testCustomer@gmail.com', '00971 55 876 3458', '$2y$10$F7psblRSamdfroSlaQgmx..wpwsj2TBotPQCqVpPaKpmKP.RyUfhq', 1, 0, NULL, NULL, NULL, NULL, '2021-09-04 07:36:46', '2021-10-17 13:40:41'),
(16, 'Anna Zyma', 'annazvladimirovna@gmail.com', '+971508408277', '$2y$10$cva/UjDy7APk2jTFHys5R.uCkWv4iF9phHPFdDWJsmIaHVHmgyw/K', 1, 768, NULL, NULL, NULL, '6ec1a6d75d436683cd3768714dc9e8367f5ea2beeccdeacd4ba3fed40f28675731363334313230353935', '2021-10-13 14:22:17', '2021-10-13 14:23:17'),
(17, 'sefsaf amine', 'sefsaf.moh.amin@gmail.com', '+971456678765', '$2y$10$dDax7B0jvqEYZwvrQu4eQ.5JnYKfxdYS5xRX44CnOrp3DLtE.q2eS', 1, 770, NULL, NULL, NULL, '52d57ec666181d333b1f527a225f67a92ac1807d32c9e6ec9ca54916339607d631363334343533393934', '2021-10-14 16:27:33', '2021-10-17 10:59:56'),
(18, 'Amjad Bond', 'amjad@amjad.com', '4554545232', '$2y$10$Wso/LHUBK3b208Pf0ggUGuoa65dGo2n6CsjWnlZaMJRG0VxKR9QMu', 2, 772, NULL, NULL, NULL, '3f28da95339b9365f321aa970aa407b9c5748d56c28992add1b744e46f0f0ee831363334363834353430', '2021-10-15 15:16:42', '2021-10-20 16:14:07'),
(19, 'ali ghothani', 'technosharjah16@gmail.com', '+971525057247', '$2y$10$fV6G0GZGL1/phUfnLro5Xepw7dAC/jGIBNMM4pCWR7jtLCVVFyIeC', 1, 785, NULL, NULL, NULL, '4f0b94e380115e1623f7303c3ff8e1f42ad5aa88f8eb1f47bb74649febd5919d31363334343836353935', '2021-10-17 19:03:02', '2021-10-17 20:03:18'),
(20, 'Moustafa Rajab', 'user-android@user.com', '+971561585959', '$2y$10$7C6BG21AUmn3a902sMLvQuZyjBf21vcVyMzqM0dM6yOWw.57a/iJ6', 1, 787, NULL, NULL, NULL, '3ef7b455656dce0f3c8034068b19e0d76a47de157c996fdfb4b95667e8c826be31363334353530303430', '2021-10-18 12:29:31', '2021-11-17 12:51:43'),
(21, 'Moustafa Rajab', 'user-ios@user.com', '+971561585957', '$2y$10$ikSyt47XNAm.fbZoIUhEGO1eIf17IAztRl5CSIh9Yn3iqxcJ7CkYW', 1, 788, NULL, NULL, NULL, '4c0180782fe3c5e988fc9b2ad47a6ebb449969f3bd46cfa194ef481534a6275631363334363531303432', '2021-10-18 12:32:48', '2021-10-30 13:33:49'),
(22, 'Arcadius Customer', 'arcadiuscustomer@gmail.com', '+971565514154', '$2y$10$mV8OhBeg.wl1SRaP.NDxqebPxmTW6XB4EQMnbiS.XdpNzylCVUcMu', 1, 789, NULL, NULL, NULL, 'd4bb19cba0775dd702f3318e229fb96f08586ecfc3899ee13d9a98c440ccebd031363334363333393632', '2021-10-18 14:01:45', '2022-01-03 16:49:15'),
(23, 'abdeldjalil Bidi Aissaoui', 'testallin123@outlook.com', '+971657654323', '$2y$10$sT9G2aTFWkj/jAnmAYO/IeI/Pt44JvPA8LhmSOjlK0zBxcrckmit.', 1, 790, NULL, NULL, NULL, '343bf5b5ad3b1cf8951fb2b03b121232e34f4405043bb25690852484deaac1e931363334353539303836', '2021-10-18 16:11:26', '2021-10-18 16:11:29'),
(24, 'ali alghothani', 'eng.ghothani@gmail.com', '+971525057200', '$2y$10$vDGnFhDaCDIdXsJi10tJNuEaQEw5lMKf3rBr/PwXuUt4w2Eem3ZnO', 1, 797, NULL, NULL, NULL, '3b002a7a47f9a06290863dc2452fd151815bd8027d573e030405a6f7ccb82f1b31363334373038353936', '2021-10-20 09:43:16', '2021-11-21 13:58:40'),
(25, 'Amjad Bond', 'ahmad@ahmad.com', '45542323545232', '$2y$10$SjNoikrgCBqS5h5xPRprOe.4ofVs/SMs7AGr3/tTokDca1YuQ/4mq', 1, 798, NULL, NULL, NULL, '2ebac59cf0a70f898ed11030d753671ce7aa42fdf38ce14bf18c26d11889708b31363334383235333034', '2021-10-21 18:07:55', '2021-12-22 13:29:09'),
(26, 'Moustafa Rajab', 'user-test@user.com', '+971561585945', '$2y$10$/cQBuvJ7qR5rNJFpWqrXnuzxdvGbEnIJx0czWUd2ZLrx7hRwnNPUq', 1, 802, NULL, NULL, NULL, '18efcbb3d64964467a3f07329b96d59e3a490f0750ff8aa2141ab3140ffd289531363335313531393435', '2021-10-25 12:52:20', '2021-12-23 18:50:04'),
(27, 'hamad alameri', 'hamadalameri308@gmail.com', '+97150 405 7114', '$2y$10$ezsOR908PT8OCSi4or5Wdug6BhIxyJfoaSgmX5nXXN.hXQG3HJ/li', 1, 805, NULL, NULL, NULL, NULL, '2021-10-26 20:38:33', '2021-10-26 20:38:33'),
(28, 'Moustafa Rajab', 'user-ios@ios.com', '+971561585953', '$2y$10$xTOmPwRPUYap.OEGrxaRJ.bDp4qJKIs4Ul9y2OfKS4xqQ.7nDQ7ai', 1, 815, NULL, NULL, NULL, 'fe65d0f07487893c5cd71201ee19b83b31680cfd2d85dbada4f5f6becffbb55b31363335353836393432', '2021-10-30 13:42:03', '2021-12-15 11:56:23'),
(29, 'Diksha Rai', 'diksharai05401@gmail.com', '+971549916437', '$2y$10$I9egENbvKHiEbKXXG8kuOOJzQr1Zz9GGguImPWXro.YNOEz7a5IYG', 1, 816, NULL, NULL, NULL, '350d32861c81eed5b94f25056aae9e707892b39ce09e039368b7353883acfe5b31363336373832313039', '2021-10-31 09:22:29', '2021-11-13 10:41:51'),
(30, 'tareq abed', 'tareq.ak1985@gmail.com', '+9710569611999', '$2y$10$06Uy.GW9Y4gIsuxVtKTEvO8PO8HI7k6WdoHj2R8DQuSiqgvff6XhO', 1, 817, NULL, NULL, NULL, '057008bf97afc88d72cdd861300e85dc5f5068f486564e1699719d2341de77e131363335363634303231', '2021-10-31 11:06:29', '2021-12-19 13:07:29'),
(31, 'Mariam AlRaeesi', 'basmet_alm21@hotmail.com', '+971504704483', '$2y$10$aUOWx3YwLaoTyRdej1sBpO4E3MZsPdGv4CXMTBTlk3lsNdb8gSQkG', 1, 818, NULL, NULL, NULL, '5f064699755f2684beeb7ef0068cae80c677a0f6471a07c0c86cd5044f564a5731363335373838303738', '2021-11-01 21:33:58', '2021-11-01 21:34:40'),
(32, 'Shashank Mital', 'Shashank.mital@gmail.com', '+971508872095', '$2y$10$A28/7.dihMamOAK9y7vIQ.AYhtxyFvJGzuYvRA3XfPb6UI6b.aRzS', 1, 819, NULL, NULL, NULL, '56a3e1136721ab6b125a658efa6484f9ac89a8d273e2643b86600034e26e76a731363335383737303338', '2021-11-02 22:16:33', '2021-11-02 22:17:20'),
(33, 'Moustafa Rajab', 'test-ios@user.com', '+971561585954', '$2y$10$McU1iL43FyoWuy85LJki7en3M6JrAlHS3/LLuBSTGBT7F2DAlFPTa', 1, 820, NULL, NULL, NULL, '16209b885976e385c342061736ef0dd97a02fbf3b35ea12ce646e8a07bc90e5b31363335393235343737', '2021-11-03 11:43:48', '2021-11-03 11:44:38'),
(34, 'Moustafa Rajab', 'ussser@gmail.com', '+971591585955', '$2y$10$NX/yLlACAWLb0GgjoktYE.Y7.cQxy1PRIWtgc8ns9Z7TBfMrU7oJW', 1, 825, NULL, NULL, NULL, NULL, '2021-11-05 18:23:26', '2021-11-05 18:23:26'),
(35, 'Moustafa Rajab', 'uss5ser@gmail.com', '+971891585955', '$2y$10$woXRY4bfYfvM9dp01Aa4wON.ztiJ7tNgDEej9a8YyVPOo.9Vly1f6', 1, 826, NULL, NULL, NULL, 'e4430b927ec7434db3f128b591c40997d7ac4eadffdfcc001397f334eeee0f7431363336333536363336', '2021-11-05 18:23:39', '2021-11-26 20:24:55'),
(36, 'sidahmed kerbouche', 'kerbouche.sid@gmail.com', '+9710543416450', '$2y$10$HpfXFcK9tQHoWOyoQv3td.zx4icTUZhbpGsF3u6FRJuEhap90sFiC', 1, 827, NULL, NULL, NULL, 'fe494905b9c9174bfcbef5f910694d64dca8a48f226bf203f427b03029fa699431363336363335323731', '2021-11-06 11:29:42', '2021-12-14 14:18:34'),
(37, 'Moustafa Rajab', 'user-test2@user.com', '+971561585951', '$2y$10$vYvFo0Rk9PuVAWESEqpVUOuQpGO61SLdpQWEGbu9tLhHEkPgPVBJa', 1, 830, NULL, NULL, NULL, '7308a949ed512f886971833530aa1c48cc4a1a2bf9e32d9bc56793b811c86c9031363336333536313139', '2021-11-08 12:21:13', '2021-11-08 12:22:00'),
(38, 'Moustafa Rajab', 'user-test4@user.com', '+971561585925', '$2y$10$D6VRfD4uoc/1332WBjRyCO.MyWFSknxZXUqef5mxoIJrGdakHg5ga', 1, 831, NULL, NULL, NULL, 'cacc57d48e866a10258c124ee5500d41ac17e20e8332fc26911f832290485d5c31363336333536333535', '2021-11-08 12:25:46', '2021-11-08 12:25:56'),
(39, 'Moustafa Rajab', 'uss55ser@gmail.com', '+97185291585955', '$2y$10$UJbAXRtZku4P6W0cQS9vFuXr1mqBB3WtQOhX3AaRU2jQIwp.psPFm', 1, 832, NULL, NULL, NULL, '4e7d25bc79316ba125234b5d9f58dfde03156b1236ab6eddeb3c148e7045ec7e31363336333537363833', '2021-11-08 12:41:57', '2021-11-08 13:52:56'),
(40, 'Moustafa Rajab', 'user-test5@user.com', '+971561585935', '$2y$10$8HGOsucDLwSYRNWTLcyNm.Bg.uaFk1faIoi3fLc3XtL5cfDj7Mfi2', 1, 835, NULL, NULL, NULL, 'd38e7f856b8edf878772f6716fa2c1ac1b476374dc87713d6cda645f9d810e7731363336333730353632', '2021-11-08 16:22:26', '2021-12-26 10:12:19'),
(41, 'sidahmed kerbouche', 'KERBOUCHE.SID@HOTMAIL.COM', '+971543416450', '$2y$10$PmhL.iZcuHn0HgcEAxI9K.hVzHmx0gQt3SgybQyWKeejIzfvOrFFW', 1, 847, NULL, NULL, NULL, '3198105afc6a12f704b0c8b903336536d25fbab0e1be0dda4869683aca03810f31363336363334303434', '2021-11-11 17:34:03', '2021-11-11 17:34:06'),
(42, 'ahmad omda', 'ahmadomda2020@gmail.com', '+971551237479', '$2y$10$mBLk2PKlmDclQSzup1V5.eNyw01fcGOZi69vp2mm.JeYRzYRHxwOC', 1, 849, NULL, NULL, NULL, '73739c21aa593f4b24f416fcb8fcc8b7366cceab1f58698244f7c1ec46b0b08c31363336363336383732', '2021-11-11 17:58:16', '2021-11-11 18:21:15'),
(43, 'Ahmed Inam Ghazi', 'ahmed.inam@gladius.ae', '+971565114455', '$2y$10$maqvuJlNU4/ELldWekJ8ceEvWmfUwNnKZEOJLEUa0j3wIWvcCvtxi', 1, 851, NULL, NULL, NULL, 'fd87a1bb70d1e7ef88ba895aa1afe3f0a6bf1e89e58f6f0945cf7bf6ef1a873331363336363336353735', '2021-11-11 18:16:11', '2021-11-11 18:16:16'),
(44, 'swarna Jacob', 'swarnajc10@gmail.com', '+9710545976789', '$2y$10$x/8fttPjp09LMsoSViORdu2tLSZDuGyZjH2oJNtNxuHc56mu8/wBm', 1, 854, NULL, NULL, NULL, '30c74051a45c4ac328e237747cd3e70703af76766fa65bb014c0652ca3f1a09e31363336373830323836', '2021-11-13 10:03:29', '2021-11-13 10:47:49'),
(45, 'diksha rai', 'diksha@glurious.ae', '+971527187615', '$2y$10$DU43HVQiHqmA.HA4Vpxwqumq9p8VtO1tqAIhZ4ZuWvmmW97END1ma', 1, 855, NULL, NULL, NULL, NULL, '2021-11-13 10:14:34', '2021-11-13 10:14:34'),
(46, 'mmm ttt', 'mmm@gmail.com', '0000000000', '$2y$10$pgLvXfVWkgIOP4DPd1HD4edDsuMrqry59VhLNYK4DHpdodjAAt6jq', 1, 856, NULL, NULL, NULL, '3de91ea028e4a214d60e8b41a5fc7180edab7d3456fb2c91e32ef5a5bc942bab31363336373934393734', '2021-11-13 14:12:33', '2021-11-26 19:54:50'),
(47, 'ali ghothani', 'technosharjah17@gmail.com', '+9715232303140232', '$2y$10$I3cX2KFmtLbomf3qfvlaNO3vFX3puRfrI9Dz0/SHoN1n7.wudnZqa', 1, 857, NULL, NULL, NULL, '1d9d6aeb6d689a6803511ebdc010216f20105f304c4308cdea6236f1cc4252a331363336383739333936', '2021-11-14 13:42:42', '2021-12-04 11:09:25'),
(48, 'aaaaqqq aaaa', 'asasa@gmail.com', '+971767456558', '$2y$10$9TuJr2yASKkA6XbyIY7wwO4RJlcO2a0zzffvq4Z16wv6CzfTdTMm2', 1, 860, NULL, NULL, NULL, '04679c66a30d407f6b712e7adf0933c001e31250b16639020fa394998d347f8231363337303636343335', '2021-11-16 17:40:34', '2021-11-16 17:40:36'),
(49, 'Chams-Eddine Djaghballou', 'djaghballou.chamseddine@yahoo.fr', '+971561213081', '$2y$10$ASo.c54cRTtEVWHUzhoa3ud7CYQ8WfjnYKyGtFzhulacCSA1GVcHi', 1, 869, NULL, NULL, NULL, '063897a9a3a3bb3494b279a336f7814e0d5d9d9f97aec056e2d448fa2a8e0f2931363337343137363337', '2021-11-20 19:12:39', '2021-11-20 19:13:59'),
(50, 'Moustafa Rajab', 'user-test6@user.com', '+9715615859355', '$2y$10$Y6FSizpVHwz/Bm40hnPTKu1l1xJ/RQtsFLoiCwgOn7.1AsK8JaUbO', 1, 871, NULL, NULL, NULL, '2f8a15a0607bddf2f61d6c516433397ec3a632fff199d4dab30725d9452becc131363337343139333231', '2021-11-20 19:41:48', '2021-11-20 20:11:00'),
(51, 'Tamarah Adnan', 'tamaraqmjed1994@gmail.com', '+971527080869', '$2y$10$f3n.Zu1ZUZxUkB/vXaUG.eVw48YQej9exTtfCHfYmRDN3PQBUFk3K', 1, 875, NULL, NULL, NULL, '04d7838c33eeac9866d1bc32e782ea625e35c0e57d83d659f3600bade383ce5531363337343832373532', '2021-11-21 12:30:27', '2021-11-21 13:19:13'),
(52, 'Mohammed Safwan', 'msafan0007@gmail.com', '+971509765404', '$2y$10$FTJaD/iT9rZDAWf5NEnTk.rI8vLQ3GqF3ja7cfG3oPuLEGymPQtem', 1, 878, NULL, NULL, NULL, '160759170126b6bcd8d00768c172f36c5b940bd5be570110ad2b262a5cb35bda31363337343931343030', '2021-11-21 15:42:29', '2021-11-21 15:43:21'),
(53, 'ali alghothani', 'eng.9ni@gmail.com', '+971508840232', '$2y$10$76IYYMhwYI6IfFMoQ39sUetye3t9S/tzI/w5.AhJVK00d6VeXRvbG', 1, 879, NULL, NULL, NULL, 'ed530008ca3b59cf12bf3bce852937793b5a775e2fb597dfa5fa05d65057b42d31363337343933303032', '2021-11-21 16:10:01', '2021-11-21 16:10:05'),
(54, 'Azar ebin', 'azarebin04@gmail.com', '+971561298928', '$2y$10$PNHeBGaQz0Qw4kd6joiyvOiowl0go59yZsPoXUOerVjCspwQ8GyCq', 1, 896, NULL, NULL, NULL, '86e8944f9a378b0c7c33f71097d74782daf50fc1f744c30d1b169c51f297d25f31363337363030313733', '2021-11-22 16:54:42', '2021-11-22 21:56:15'),
(55, 'aa aa', 'ahmbbbad@ahmad.com', '00905378813272', '$2y$10$tkRYKBrzElpj6agbOz5Ad.JMm339ZPNlyaZrZtpy.CezH0WRqaU5i', 1, 898, NULL, NULL, NULL, 'd5f3632a620090b075c9fac1b99a509d910ac3241c134e8c5310f1e618a4fa0d31363337353834383831', '2021-11-22 17:41:21', '2021-11-22 17:41:22'),
(56, 'Amjad Bond', 'ahmad-5@ahmad.com', '45542323213545232', '$2y$10$QZZV6HdMG6tv8/hALfLH5.Hhrcc9HULPWFBuhYouiVSKtZ3iRl7fq', 1, 918, NULL, NULL, NULL, 'f4cfa1ca7cb8a42966af88d72882659873c7b590dd97b5a040c14fc79b459ea831363337363739373539', '2021-11-23 20:02:05', '2021-11-23 20:02:40'),
(57, 'Jithin lal', 'jithin.lal1991@gmail.com', '+971507407987', '$2y$10$6GbKouSqmlRSvVpKaBTIdukONxm8a7spCLAQIQ.m0.LjnmxOYpYr2', 1, 926, NULL, NULL, NULL, 'f9590559cfdb77e0c577d4836b7e32ade427e216ede17b9834a5912ed5b8c09c31363337363833343630', '2021-11-23 21:03:48', '2021-11-23 21:04:22'),
(58, 'aa aa', 'ah232mad@ahmad.com', '+97150232323323233140232', '$2y$10$CMporsLMKLRPzKJ/myy6eebCe6kBZBiT5spaNaB8SHCH6hprU2.Am', 1, 927, NULL, NULL, NULL, '97bae60dbf740d20a3420b90bcbb9bc30b9fbead1128567389e721af3e36e4d631363337363838373236', '2021-11-23 22:32:06', '2021-11-23 22:32:07'),
(59, 'arche franilla', 'archefranilla@gmail.com', '+971561254316', '$2y$10$XuHYd33xXVPkdAULWbtWreDAPIQYkOlgbBq36OIIW9Z3kY/QZKO26', 1, 941, NULL, NULL, NULL, '1812f8e590d0cbdaadfba3b0414f771482295719441309f4e5eb7483e02e0a0231363338313933333733', '2021-11-29 18:42:37', '2021-11-29 18:42:54'),
(60, 'عيسى العياصره', 'essahmour1995@icloud.com', '+962775454505', '$2y$10$8gZQLwcx4Eh6oGz3jpXAZulhVnwmoD85v.I4ZZiakIZWMg0yLkDl6', 1, 961, NULL, NULL, NULL, NULL, '2021-12-08 13:07:06', '2021-12-08 13:07:06'),
(61, 'abdullah mushba', 'heppyzain@gmail.com', '+971 50 752 2923', '$2y$10$xFc2AfeRA.b.kMiqZqmtSOzodW5YHks.MQ995rA5WpGq1S.au4zii', 1, 982, NULL, NULL, NULL, NULL, '2021-12-19 06:50:53', '2021-12-19 06:50:53'),
(62, 'majd alshafei', 'mjcoins@gmail.com', '+971523862028', '$2y$10$IO6XtyROdEqUwqMyjEewXegSVKuOi8QxicA16j5TjSlDggjdDPFQe', 1, 995, NULL, NULL, NULL, '5f5c4405fc9c7883955170fa0d662ba6beeb4074c0eca4d180dd7637809d271731363431313230353031', '2022-01-02 15:48:04', '2022-01-02 15:48:22');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `id` int(11) NOT NULL,
  `address` varchar(500) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address_main_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`id`, `address`, `latitude`, `longitude`, `customer_id`, `address_main_id`, `created_at`, `updated_at`) VALUES
(17, 'weqsdfsdf', 23.213, 234.213, 1, 2, '2021-10-21 07:10:41', '2021-10-21 07:10:41'),
(18, 'weqsdfsdf', 23.213, 234.213, 1, 2, '2021-10-21 15:38:30', '2021-10-21 15:38:30'),
(19, 'weqsdfsdf', 23.213, 234.213, 1, 2, '2021-10-21 15:38:38', '2021-10-21 15:38:38'),
(20, 'weqsdfsdf', 23.213, 234.213, 1, 2, '2021-10-21 15:38:59', '2021-10-21 15:38:59'),
(21, 'weqsdfsdf', 23.213, 234.213, 1, 2, '2021-10-21 16:30:25', '2021-10-21 16:30:25'),
(22, 'weqsdfsdf', 23.213, 234.213, 1, 2, '2021-10-21 19:22:33', '2021-10-21 19:22:33'),
(23, 'weqsdfsdf', 23.213, 234.213, 1, 2, '2021-10-21 19:25:26', '2021-10-21 19:25:26'),
(24, 'weqsdfsdf', 23.213, 234.213, 25, 2, '2021-10-21 19:33:26', '2021-10-21 19:33:26'),
(25, 'weqsdfsdf', 23.213, 234.213, 1, 2, '2021-10-21 19:27:30', '2021-10-21 19:27:30'),
(28, 'sdsdsd', 55.276738, 25.130686, 25, 154, '2021-10-23 03:05:24', '2021-10-23 03:05:24'),
(30, 'latest test', 23.213, 234.213, 26, 156, '2021-10-25 13:04:55', '2021-10-25 13:04:55'),
(31, 'Test note', 23.66666, 24.555555, 2, 187, '2021-11-08 19:55:27', '2021-11-08 19:55:27'),
(32, 'Test note', 23.66666, 24.555555, 40, 188, '2021-11-08 19:59:56', '2021-11-08 19:59:56'),
(33, 'fragile', 55.276738, 25.130686, 41, 190, '2021-11-11 17:39:31', '2021-11-11 17:39:31'),
(34, 'Industrial Area', 55.407446399331, 25.330311756253, 36, 191, '2021-11-11 17:57:34', '2021-11-11 17:57:34'),
(35, 'Industrial Area', 55.407446399331, 25.330311756253, 36, 192, '2021-11-11 17:57:56', '2021-11-11 17:57:56'),
(36, 'المنطقة الصناعية, الشارقة,test', 55.407732389867306, 25.327326458109884, 30, 194, '2021-11-11 18:02:19', '2021-11-11 18:02:19'),
(37, 'Industrial Area, Sharjah,zayeed road', 55.40652472525835, 25.329005943598045, 30, 196, '2021-11-11 18:06:40', '2021-11-11 18:06:40'),
(38, 'المنطقة الصناعية', 55.428228490055, 25.302379628863, 42, 199, '2021-11-11 18:22:22', '2021-11-11 18:22:22'),
(39, 'Hungerburg, Innsbruck,metropolis', 11.339865736663343, 47.31895362592748, 44, 206, '2021-11-13 11:41:45', '2021-11-13 11:41:45'),
(40, 'Area,bsbbxbx', 0, 0, 44, 208, '2021-11-13 11:44:07', '2021-11-13 11:44:07'),
(41, 'Business Bay', 55.2769537, 25.1852126, 29, 209, '2021-11-13 11:47:22', '2021-11-13 11:47:22'),
(42, 'Trade Centre', 55.272485688329, 25.209289057363, 20, 213, '2021-11-13 15:09:07', '2021-11-13 15:09:07'),
(43, 'Business Bay', 55.259898081422, 25.189793109571, 20, 214, '2021-11-13 15:09:40', '2021-11-13 15:09:40'),
(44, 'Trade Centre', 55.27249339968, 25.209285113894, 20, 215, '2021-11-13 16:14:40', '2021-11-13 16:14:40'),
(45, 'oooooo', 55.2975737, 25.1873896, 25, 216, '2021-11-14 18:18:07', '2021-11-14 18:18:07'),
(46, 'ssdsd', 55.276738, 25.130686, 25, 220, '2021-11-17 18:34:04', '2021-11-17 18:34:04'),
(47, 'Trade Centre', 55.272610746324, 25.209031214892, 40, 221, '2021-11-17 19:06:07', '2021-11-17 19:06:07'),
(48, 'Trade Centre', 55.27256179601, 25.209093400479, 47, 223, '2021-11-18 14:32:59', '2021-11-18 14:32:59'),
(49, 'Trade Centre', 55.27256179601, 25.20909704061, 47, 224, '2021-11-18 14:39:30', '2021-11-18 14:39:30'),
(50, 'Trade Centre', 55.272587276995, 25.20900239717, 40, 228, '2021-11-20 18:28:57', '2021-11-20 18:28:57'),
(51, 'Trade Centre', 55.272585600615, 25.208998757036, 40, 229, '2021-11-20 18:33:37', '2021-11-20 18:33:37'),
(52, 'Al Wasl', 55.253501348197, 25.197918898828, 40, 230, '2021-11-20 18:34:58', '2021-11-20 18:34:58'),
(53, 'Business Bay', 55.2769537, 25.1852126, 29, 231, '2021-11-20 19:26:37', '2021-11-20 19:26:37'),
(54, 'null', 55.5093128, 25.4047303, 49, 232, '2021-11-20 19:30:57', '2021-11-20 19:30:57'),
(55, 'Downtown Dubai', 55.274830944836, 25.199502794233, 29, 235, '2021-11-20 19:37:18', '2021-11-20 19:37:18'),
(56, 'Downtown Dubai', 55.274830944836, 25.199502794233, 29, 236, '2021-11-20 19:37:41', '2021-11-20 19:37:41'),
(57, 'Trade Centre, Dubai,ndjdjd', 55.27267914265395, 25.208935964711642, 46, 237, '2021-11-20 19:38:39', '2021-11-20 19:38:39'),
(58, 'Za\'abeel, Dubai,Dubai I just want', 55.29250603169202, 25.2032669280327, 40, 240, '2021-11-20 20:07:56', '2021-11-20 20:07:56'),
(59, 'Trade Centre, Dubai,Dubai is going on the', 0, 0, 50, 243, '2021-11-20 20:11:23', '2021-11-20 20:11:23'),
(60, 'Trade Centre, Dubai,Dubai is a good', 0, 0, 50, 244, '2021-11-20 20:12:34', '2021-11-20 20:12:34'),
(61, 'القوز', 55.256241895258, 25.16879594423, 29, 245, '2021-11-20 20:15:22', '2021-11-20 20:15:22'),
(62, 'Trade Centre, Dubai,Dubai is a good time for', 0, 0, 50, 246, '2021-11-20 20:16:55', '2021-11-20 20:16:55'),
(63, 'Trade Centre, Dubai,Dubai is going on the', 0, 0, 50, 247, '2021-11-20 20:19:24', '2021-11-20 20:19:24'),
(64, 'Trade Centre, Dubai,Dubai I just want you', 55.27406048029661, 25.207633699197636, 50, 248, '2021-11-20 20:24:16', '2021-11-20 20:24:16'),
(65, 'Trade Centre, Dubai,Dubai is a high', 55.27259163558483, 25.209043348667457, 50, 249, '2021-11-20 20:25:13', '2021-11-20 20:25:13'),
(66, 'Trade Centre, Dubai,Dubai is going to', 55.27262147516013, 25.209006947337112, 50, 250, '2021-11-20 20:28:45', '2021-11-20 20:28:45'),
(67, 'Trade Centre, Dubai,dubai I just want to see', 55.27262147516013, 25.209006947337112, 50, 251, '2021-11-20 20:32:18', '2021-11-20 20:32:18'),
(68, 'Muteena', 55.322778783739, 25.273412061218, 52, 255, '2021-11-21 19:41:34', '2021-11-21 19:41:34'),
(69, 'Al Khan', 55.377192422748, 25.310132969019, 47, 256, '2021-11-22 00:21:23', '2021-11-22 00:21:23'),
(70, 'Al Khan', 55.373866148293, 25.317012354781, 47, 261, '2021-11-23 15:00:09', '2021-11-23 15:00:09'),
(71, 'Deira', 55.3199705109, 25.260560937561, 47, 266, '2021-11-23 18:34:08', '2021-11-23 18:34:08'),
(72, 'Trade Centre', 55.270310081542, 25.206164273161, 56, 267, '2021-11-23 20:05:09', '2021-11-23 20:05:09'),
(73, 'sdsdsdsdsdsds', 55.2707828, 25.2048493, 58, 271, '2021-11-24 15:17:00', '2021-11-24 15:17:00'),
(74, 'mmmmmm', 55.419560265625, 25.2897242234283, 28, 273, '2021-11-25 12:17:23', '2021-11-25 12:17:23'),
(75, 'Al Baraha', 55.321360900998, 25.278613976551, 47, 274, '2021-11-25 23:14:19', '2021-11-25 23:14:19'),
(76, 'Trade Centre, Dubai,Sheikh Zayed Road (south), Trade Centre First, Dubai', 55.272557437419884, 25.20913738538713, 47, 275, '2021-12-04 11:20:32', '2021-12-04 11:20:32'),
(77, 'Industrial Area', 55.407383702695, 25.330118415653, 36, 281, '2021-12-11 16:45:52', '2021-12-11 16:45:52'),
(78, 'Trade Centre', 55.272565819323, 25.209023631282, 22, 282, '2021-12-20 18:14:16', '2021-12-20 18:14:16'),
(79, 'Trade Centre, Dubai,tower suite test', 55.27340434491634, 25.210633166148757, 40, 284, '2022-01-03 11:57:24', '2022-01-03 11:57:24'),
(80, 'Trade Centre, Dubai,test home', 55.27443565428257, 25.21244318492475, 40, 285, '2022-01-03 11:58:56', '2022-01-03 11:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `customer_banking_details`
--

CREATE TABLE `customer_banking_details` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `iban` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_coupon`
--

CREATE TABLE `customer_coupon` (
  `id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_coupon`
--

INSERT INTO `customer_coupon` (`id`, `coupon_id`, `customer_id`, `order_id`, `created_at`) VALUES
(1, 3, 25, 65, '2021-10-22 23:24:47'),
(2, 2, 26, 72, '2021-10-25 09:05:08'),
(3, 3, 47, 111, '2021-11-18 09:33:13'),
(4, 3, 40, 122, '2021-11-23 10:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `discount_type`
--

CREATE TABLE `discount_type` (
  `id` int(11) NOT NULL,
  `discount_name_en` varchar(500) NOT NULL,
  `discount_name_ar` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount_type`
--

INSERT INTO `discount_type` (`id`, `discount_name_en`, `discount_name_ar`, `created_at`, `created_by`) VALUES
(1, 'Percentage', 'نسبة مئوية', '2021-08-15 10:41:53', 1),
(2, 'Static value', 'قيمة ثابتة', '2021-08-15 10:41:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `id` int(11) NOT NULL,
  `taste_value` int(11) DEFAULT 3,
  `clean_value` int(11) DEFAULT 3,
  `delivery_value` int(11) DEFAULT 3,
  `customer_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`id`, `taste_value`, `clean_value`, `delivery_value`, `customer_id`, `restaurant_id`, `note`, `created_at`) VALUES
(6, 2, 5, 5, 1, 58, 'test eval from alaa', '2021-10-04 09:13:52'),
(8, 5, 5, 1, 4, 58, 'test eval from alaa2', '2021-10-04 09:14:12'),
(9, 5, 5, 3, 2, 58, 'test eval from alaa3', '2021-10-04 09:14:30'),
(10, 5, 3, 3, 5, 58, '', '2021-10-04 09:14:27'),
(11, 1, 5, 4, 9, 58, '', '2021-10-04 09:14:00'),
(12, 5, 5, 1, 15, 58, '', '2021-10-04 09:14:16'),
(13, 3, 3, 5, 20, 145, 'test eval from alaa', '2021-11-10 13:25:31'),
(14, 3, 3, 3, 20, 61, 'test eval from alaa', '2021-11-21 11:35:35'),
(15, 3, 3, 3, 40, 58, 'sh da', '2021-11-21 11:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `customer_id`, `place_id`, `created_at`) VALUES
(1, 1, 58, '2021-10-09 18:01:13'),
(2, 1, 60, '2021-10-12 11:26:42'),
(3, 1, 60, '2021-10-13 13:06:39'),
(30, 26, 61, '2021-10-26 08:55:16'),
(43, 20, 61, '2021-11-14 07:48:12'),
(44, 46, 61, '2021-11-15 10:25:04'),
(45, 47, 61, '2021-11-18 09:38:02'),
(47, 47, 158, '2021-11-23 10:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `filters`
--

CREATE TABLE `filters` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filters`
--

INSERT INTO `filters` (`id`, `name`) VALUES
(1, 'min_price'),
(2, 'max_price'),
(3, 'name'),
(5, 'size');

-- --------------------------------------------------------

--
-- Table structure for table `filters_account`
--

CREATE TABLE `filters_account` (
  `id` int(11) NOT NULL,
  `filter_name` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filters_account`
--

INSERT INTO `filters_account` (`id`, `filter_name`) VALUES
(1, 'work_status'),
(2, 'min_price'),
(3, 'max_price'),
(4, 'rate_value'),
(5, 'name');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `item_name_en` varchar(500) NOT NULL,
  `item_name_ar` varchar(500) NOT NULL,
  `description_en` varchar(5000) NOT NULL,
  `description_ar` varchar(5000) NOT NULL,
  `execution_time` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `photo_url` varchar(1000) NOT NULL,
  `has_discount` int(11) NOT NULL,
  `discount_type_id` int(11) DEFAULT NULL,
  `discount_val` decimal(10,0) DEFAULT NULL,
  `item_status_id` int(11) NOT NULL,
  `item_size_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `item_name_en`, `item_name_ar`, `description_en`, `description_ar`, `execution_time`, `sub_cat_id`, `photo_url`, `has_discount`, `discount_type_id`, `discount_val`, `item_status_id`, `item_size_id`, `restaurant_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(58, 'sushi', 'سوشي', 'test', 'تيست', 0, 75, '90cf15fca56b0e383c071d4a209af016_w750_h750.jpg', 0, NULL, NULL, 1, 3, 58, '2021-08-22 05:37:59', 58, '2021-11-14 14:04:08', NULL),
(59, 'humhum', 'شاروما', 'test', 'تيست', 99, 77, 'change_iptv.PNG', 0, NULL, NULL, 1, 3, 58, '2021-08-22 05:38:36', 58, '2021-11-10 19:53:34', NULL),
(60, 'kespy', 'كريسبي', 'test', 'تيست', 20, 77, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 04:39:20', 58, '2021-10-19 13:45:47', NULL),
(61, 'kespy', 'كريسبي', 'test', 'تيست', 0, 75, 'download (2).jfif', 0, NULL, NULL, 1, 3, 58, '2021-09-12 04:39:58', 58, '2021-11-14 14:07:06', NULL),
(62, 'kespy', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 04:40:32', 58, '2021-09-12 04:40:32', NULL),
(63, 'kespy', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 04:46:46', 58, '2021-09-12 04:46:46', NULL),
(64, 'kespy', 'كريسبي', 'test', 'تيست', 30, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 04:47:45', 58, '2021-10-19 13:49:01', NULL),
(65, 'kespy', 'كريسبي', 'test', 'تيست', 30, 77, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 04:49:05', 58, '2021-10-19 13:48:06', NULL),
(66, 'kespy', 'كريسبي', 'test', 'تيست', 20, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 04:56:43', 58, '2021-10-19 13:46:56', NULL),
(67, 'kespy', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:00:25', 58, '2021-09-12 05:00:25', NULL),
(68, 'kespy', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:00:42', 58, '2021-09-12 05:00:42', NULL),
(69, 'kespy', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:04:36', 58, '2021-09-12 05:04:36', NULL),
(70, 'kespy', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:08:40', 58, '2021-09-12 05:08:40', NULL),
(71, 'kespy', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:18:08', 58, '2021-09-12 05:18:08', NULL),
(72, 'kespy', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:18:45', 58, '2021-09-12 05:18:45', NULL),
(73, 'kespy', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:19:13', 58, '2021-09-12 05:19:13', NULL),
(74, 'kespy', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:19:24', 58, '2021-09-12 05:19:24', NULL),
(75, 'kespy', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:34:53', 58, '2021-09-12 05:34:53', NULL),
(76, 'kespy', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:38:39', 58, '2021-09-12 05:38:39', NULL),
(77, 'kespy', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:39:28', 58, '2021-09-12 05:39:28', NULL),
(78, 'kespy2', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:44:28', 58, '2021-09-12 05:44:28', NULL),
(79, 'sh sh', 'سوشي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:46:43', 58, '2021-09-12 05:46:43', NULL),
(80, 'sh sh', 'سوشي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:48:07', 58, '2021-09-12 05:48:07', NULL),
(81, 'sh sh', 'سوشي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:48:26', 58, '2021-09-12 05:48:26', NULL),
(82, 'sh sh', 'سوشي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:48:42', 58, '2021-09-12 05:48:42', NULL),
(83, 'sh sh', 'سوشي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:50:50', 58, '2021-09-12 05:50:50', NULL),
(84, 'sh sh', 'سوشي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:51:32', 58, '2021-09-12 05:51:32', NULL),
(85, 'sh sh', 'سوشي', 'test test', 'توصيف تجريبي', 0, 75, '90cf15fca56b0e383c071d4a209af016_w750_h750.jpg', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:53:50', 58, '2021-11-20 17:59:39', NULL),
(86, 'sh sh', 'سوشي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:54:06', 58, '2021-09-12 05:54:06', NULL),
(87, 'sh sh', 'سوشي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:54:38', 58, '2021-09-12 05:54:38', NULL),
(88, 'sh sh', 'سوشي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 58, '2021-09-12 05:58:45', 58, '2021-09-12 05:58:45', NULL),
(89, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 80, '2021-09-19 04:18:43', 0, '2021-09-19 04:18:43', NULL),
(90, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 78, '2021-09-19 04:19:09', 0, '2021-09-19 04:19:09', NULL),
(91, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 77, '2021-09-19 04:19:12', 0, '2021-09-19 04:19:12', NULL),
(92, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 76, '2021-09-19 04:19:24', 0, '2021-09-19 04:19:24', NULL),
(93, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 75, '2021-09-19 04:19:29', 0, '2021-09-19 04:19:29', NULL),
(94, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 75, '2021-09-19 04:19:35', 0, '2021-09-19 04:19:35', NULL),
(95, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 74, '2021-09-19 04:19:40', 0, '2021-09-19 04:19:40', NULL),
(96, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 73, '2021-09-19 04:19:44', 0, '2021-09-19 04:19:44', NULL),
(97, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 72, '2021-09-19 04:19:48', 0, '2021-09-19 04:19:48', NULL),
(98, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 71, '2021-09-19 04:19:52', 0, '2021-09-19 04:19:52', NULL),
(99, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 70, '2021-09-19 04:19:59', 0, '2021-09-19 04:19:59', NULL),
(100, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 69, '2021-09-19 04:20:09', 0, '2021-09-19 04:20:09', NULL),
(101, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 69, '2021-09-19 04:20:13', 0, '2021-09-19 04:20:13', NULL),
(102, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 68, '2021-09-19 04:20:19', 0, '2021-09-19 04:20:19', NULL),
(103, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 67, '2021-09-19 04:20:24', 0, '2021-09-19 04:20:24', NULL),
(104, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 67, '2021-09-19 04:20:28', 0, '2021-09-19 04:20:28', NULL),
(105, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 67, '2021-09-19 04:20:33', 0, '2021-09-19 04:20:33', NULL),
(106, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 66, '2021-09-19 04:20:37', 0, '2021-09-19 04:20:37', NULL),
(107, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 79, '2021-09-19 04:20:44', 0, '2021-09-19 04:20:44', NULL),
(108, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 79, '2021-09-19 04:20:47', 0, '2021-09-19 04:20:47', NULL),
(109, 'chickentoast', 'خبز محمص', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 80, '2021-09-19 04:20:51', 0, '2021-09-19 04:20:51', NULL),
(110, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 78, '2021-09-19 04:21:14', 0, '2021-09-19 04:21:14', NULL),
(111, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 77, '2021-09-19 04:21:18', 0, '2021-09-19 04:21:18', NULL),
(112, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 76, '2021-09-19 04:21:26', 0, '2021-09-19 04:21:26', NULL),
(113, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 75, '2021-09-19 04:21:31', 0, '2021-09-19 04:21:31', NULL),
(114, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 75, '2021-09-19 04:21:35', 0, '2021-09-19 04:21:35', NULL),
(115, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 74, '2021-09-19 04:21:39', 0, '2021-09-19 04:21:39', NULL),
(116, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 73, '2021-09-19 04:21:43', 0, '2021-09-19 04:21:43', NULL),
(117, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 72, '2021-09-19 04:21:46', 0, '2021-09-19 04:21:46', NULL),
(118, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 71, '2021-09-19 04:21:52', 0, '2021-09-19 04:21:52', NULL),
(119, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 70, '2021-09-19 04:21:56', 0, '2021-09-19 04:21:56', NULL),
(120, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 80, '2021-09-19 04:22:27', 0, '2021-09-19 04:22:27', NULL),
(121, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 79, '2021-09-19 04:22:30', 0, '2021-09-19 04:22:30', NULL),
(122, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 79, '2021-09-19 04:22:36', 0, '2021-09-19 04:22:36', NULL),
(123, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 66, '2021-09-19 04:22:40', 0, '2021-09-19 04:22:40', NULL),
(124, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 67, '2021-09-19 04:22:46', 0, '2021-09-19 04:22:46', NULL),
(125, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 67, '2021-09-19 04:22:51', 0, '2021-09-19 04:22:51', NULL),
(126, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 67, '2021-09-19 04:22:58', 0, '2021-09-19 04:22:58', NULL),
(127, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 68, '2021-09-19 04:23:03', 0, '2021-09-19 04:23:03', NULL),
(128, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 69, '2021-09-19 04:23:07', 0, '2021-09-19 04:23:07', NULL),
(129, 'subway', 'صب واي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 69, '2021-09-19 04:23:17', 0, '2021-09-19 04:23:17', NULL),
(130, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 78, '2021-09-19 04:24:03', 0, '2021-09-19 04:24:03', NULL),
(131, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 77, '2021-09-19 04:24:07', 0, '2021-09-19 04:24:07', NULL),
(132, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 76, '2021-09-19 04:24:11', 0, '2021-09-19 04:24:11', NULL),
(133, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 75, '2021-09-19 04:24:16', 0, '2021-09-19 04:24:16', NULL),
(134, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 75, '2021-09-19 04:24:21', 0, '2021-09-19 04:24:21', NULL),
(135, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 74, '2021-09-19 04:24:50', 0, '2021-09-19 04:24:50', NULL),
(136, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 73, '2021-09-19 04:24:56', 0, '2021-09-19 04:24:56', NULL),
(137, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 72, '2021-09-19 04:25:05', 0, '2021-09-19 04:25:05', NULL),
(138, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 71, '2021-09-19 04:25:10', 0, '2021-09-19 04:25:10', NULL),
(139, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 70, '2021-09-19 04:25:15', 0, '2021-09-19 04:25:15', NULL),
(140, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 69, '2021-09-19 04:25:22', 0, '2021-09-19 04:25:22', NULL),
(141, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 69, '2021-09-19 04:25:27', 0, '2021-09-19 04:25:27', NULL),
(142, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 68, '2021-09-19 04:25:32', 0, '2021-09-19 04:25:32', NULL),
(143, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 67, '2021-09-19 04:25:37', 0, '2021-09-19 04:25:37', NULL),
(144, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 67, '2021-09-19 04:25:41', 0, '2021-09-19 04:25:41', NULL),
(145, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 67, '2021-09-19 04:25:46', 0, '2021-09-19 04:25:46', NULL),
(146, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 66, '2021-09-19 04:25:50', 0, '2021-09-19 04:25:50', NULL),
(147, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 79, '2021-09-19 04:25:55', 0, '2021-09-19 04:25:55', NULL),
(148, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 79, '2021-09-19 04:26:02', 0, '2021-09-19 04:26:02', NULL),
(149, 'beef shawrma', 'شاورما لحم', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 80, '2021-09-19 04:26:06', 0, '2021-09-19 04:26:06', NULL),
(150, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 78, '2021-09-19 04:27:04', 0, '2021-09-19 04:27:04', NULL),
(151, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 77, '2021-09-19 04:27:17', 0, '2021-09-19 04:27:17', NULL),
(152, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 76, '2021-09-19 04:27:26', 0, '2021-09-19 04:27:26', NULL),
(153, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 76, '2021-09-19 04:28:26', 0, '2021-09-19 04:28:26', NULL),
(154, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 74, '2021-09-19 04:28:31', 0, '2021-09-19 04:28:31', NULL),
(155, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 74, '2021-09-19 04:28:36', 0, '2021-09-19 04:28:36', NULL),
(156, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 73, '2021-09-19 04:28:42', 0, '2021-09-19 04:28:42', NULL),
(157, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 72, '2021-09-19 04:28:46', 0, '2021-09-19 04:28:46', NULL),
(158, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 70, '2021-09-19 04:28:51', 0, '2021-09-19 04:28:51', NULL),
(159, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 69, '2021-09-19 04:28:55', 0, '2021-09-19 04:28:55', NULL),
(160, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 69, '2021-09-19 04:29:01', 0, '2021-09-19 04:29:01', NULL),
(161, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 68, '2021-09-19 04:29:10', 0, '2021-09-19 04:29:10', NULL),
(162, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 67, '2021-09-19 04:29:15', 0, '2021-09-19 04:29:15', NULL),
(163, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 67, '2021-09-19 04:29:19', 0, '2021-09-19 04:29:19', NULL),
(164, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 67, '2021-09-19 04:29:23', 0, '2021-09-19 04:29:23', NULL),
(165, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 66, '2021-09-19 04:29:28', 0, '2021-09-19 04:29:28', NULL),
(166, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 79, '2021-09-19 04:29:33', 0, '2021-09-19 04:29:33', NULL),
(167, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 79, '2021-09-19 04:29:38', 0, '2021-09-19 04:29:38', NULL),
(168, 'Diet meal', 'وجبة دايت', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 1, 3, 80, '2021-09-19 04:29:46', 0, '2021-09-19 04:29:46', NULL),
(169, 'sushi', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 2, 3, 58, '2021-09-26 08:37:57', 58, '2021-09-26 08:37:57', NULL),
(170, 'sushi', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 2, 3, 58, '2021-09-26 08:38:40', 58, '2021-09-26 08:38:40', NULL),
(171, 'sushi', 'كريسبي', '', '', 0, 75, 'bg-logo.png', 0, NULL, NULL, 2, 3, 58, '2021-09-26 08:44:40', 58, '2021-09-26 08:44:40', NULL),
(172, 'zinger', 'ينجر', '', '', 0, 75, 'unknown.jpg', 0, NULL, NULL, 1, 3, 58, '2021-09-27 03:34:11', 58, '2021-09-27 03:34:11', NULL),
(173, 'zinger', 'زينجر', 'zinger zinger zinger', 'زينجر زينجرزينجر', 0, 75, '90cf15fca56b0e383c071d4a209af016_w750_h750.jpg', 0, NULL, NULL, 1, 4, 58, '2021-09-27 03:34:52', 58, '2021-10-10 14:04:07', NULL),
(174, 'termisoh', 'تيراميسو', 'test ttes', 'توصيف تجريبي', 5, 75, 'download (1).jfif', 0, NULL, NULL, 1, 3, 58, '2021-09-27 04:28:10', 58, '2021-11-14 14:05:19', NULL),
(175, 'hamburger', 'همبرغر', 'test', 'تيست', 15, 75, 'unknown.jpg', 0, NULL, NULL, 1, 4, 58, '2021-09-29 08:11:26', 58, '2021-11-10 19:52:26', NULL),
(176, 'potato sandwish', 'سندويش بطاطا', 'test description', 'وصف التجريبي', 30, 75, '90cf15fca56b0e383c071d4a209af016_w750_h750.jpg', 0, NULL, NULL, 1, 3, 58, '2021-10-07 08:32:26', 58, '2021-10-09 05:25:30', NULL),
(178, 'chiecken ro', 'تيشكن رول', 'chiecken rochiecken rochiecken rochiecken ro', 'تيشكن رولتيشكن رولتيشكن رولتيشكن رولتيشكن رول', 15, 77, '90cf15fca56b0e383c071d4a209af016_w750_h750.jpg', 0, NULL, NULL, 1, 4, 58, '2021-10-10 06:16:58', 58, '2021-10-26 18:46:06', NULL),
(179, 'Chicken Avocado Bacon Sandwich', 'سندويتش دجاج أفوكادو بيكون', 'Roasted Chicken, crispy turkey bacon, Ripe avocado and ranch dressing.', 'دجاج مشوي ، ديك رومي مقدد مقرمش ، أفوكادو و صلصة رانش.', 24, 77, 'Chicken_Avo_Bacon_637193147665607868.jpg', 0, NULL, NULL, 1, 3, 58, '2021-10-19 11:46:13', 58, '2021-10-26 16:52:04', NULL),
(180, 'Chicken Biryani', 'دجاج برياني', 'In a large skillet, in 2 tablespoons vegetable oil (or ghee) fry potatoes until brown, drain and …\r\nWhen the mixture is thick and smooth, add the chicken pieces and stir well to coat them with …\r\nWash rice well and drain in colander for at least 30 minutes.', 'في مقلاة كبيرة، في 2 ملعقة طعام زيت نباتي (أو السمن) تقلى البطاطا حتى البني، واستنزاف و ...\r\nعندما يكون الخليط سميكا وناعما، تضاف قطع الدجاج ويحرك جيدا لتغليفها ب...\r\nيغسل الأرز جيدا ويصفى في مصفاة لمدة 30 دقيقة على الأقل.', 30, 94, 'R.png', 0, NULL, NULL, 1, 3, 131, '2021-10-19 11:54:52', 131, '2021-10-19 11:59:04', NULL),
(181, 'test', 'تيست', 'تيست', 'تيست', 30, 74, 'menu1.jpg', 0, NULL, NULL, 1, 3, 61, '2021-10-19 16:06:34', 61, '2021-10-20 18:00:14', NULL),
(182, 'test meal', 'وجبة تجربة', 'test meal', 'وجبة تجربة', 20, 94, 'menu7.jpg', 0, NULL, NULL, 1, 3, 131, '2021-11-04 13:47:25', 131, '2021-11-04 13:47:25', NULL),
(183, 'test meal 1', 'وجبة تجربة 1', 'test meal 1', 'وجبة تجربة 1', 30, 94, 'menu5.jpg', 0, NULL, NULL, 1, 3, 131, '2021-11-04 13:48:48', 131, '2021-11-04 13:48:48', NULL),
(184, 'test meal 2', 'وجبة تجربة 2', 'test meal 2', 'وجبة تجربة 2', 20, 93, 'pic1.jpg', 0, NULL, NULL, 1, 3, 131, '2021-11-04 13:51:20', 131, '2021-11-04 13:51:20', NULL),
(185, 'test meal 3', 'وجبة تجربة 3', 'test meal 3', 'وجبة تجربة 3', 20, 93, 'fav2.jpg', 0, NULL, NULL, 1, 3, 131, '2021-11-04 13:52:36', 131, '2021-11-04 13:52:36', NULL),
(186, 'test meal 4', 'وجبة تجربة 4', 'test meal 4', 'وجبة تجربة 4', 20, 93, 'menu6.jpg', 0, NULL, NULL, 1, 3, 131, '2021-11-04 13:54:05', 131, '2021-11-04 13:54:05', NULL),
(187, 'Seekh Kabab', 'سيخ كباب', 'Kebabs made from minced mutton and chicken meat, slathered in a bowl of spices and grilled to perfection. Full of juice and flavor, these kebabs are perfect as a starter for an amazing dinner party.', 'كباب مصنوع من لحم الضأن المفروم ولحم الدجاج ، مغطى بوعاء بهارات ومشوي إلى درجة الكمال. مليء بالعصير والنكهات ، هذا الكباب مثالي كمقبل لحفل عشاء رائع.', 20, 88, 'Seekh kabab.jpg', 0, NULL, NULL, 1, 3, 151, '2021-11-04 14:08:04', 151, '2021-12-21 16:29:02', NULL),
(188, 'Mutton Korma', 'لحم الضأن كورما', 'It\'s a quintessential recipe from the Royal Indian Mughlai/Awadhi cuisine, where mutton or lamb, is braised/cooked in a mix of spices, almond-onion paste, ghee, yogurt and kewda water (light sweet-scented water).', 'إنها وصفة مثالية من المطبخ الهندي الملكي المغلاي / العوضي ، حيث يتم طهي / طهي لحم الضأن أو لحم الضأن في مزيج من التوابل ومعجون اللوز والبصل والسمن واللبن الزبادي وماء الكودا (ماء خفيف برائحة حلوة).', 20, 88, 'Mutton Qourma.jpg', 0, NULL, NULL, 1, 3, 151, '2021-11-04 14:09:19', 151, '2021-12-21 16:29:48', NULL),
(189, 'Chicken Tikka', 'سهام الدجاج', 'Chicken Tikka is a popular sub-continent dish where pieces of marinated chicken are cooked in a tandoor/oven. The Chicken Tikka Dry is a delicious dish is often served as an appetizer or even as a main course with roti, naan or paratha. It is a prominent menu at weddings and parties.  A staple of the Punjabi cuisine, it is made with boneless chicken pieces marinated in a yogurt marinade and cooked in an oven or a tandoor either skewered or as is.', 'دجاج تكا هو طبق شائع من شبه القارة حيث يتم طهي قطع الدجاج المتبل في التندور / الفرن. دجاج تكا دراي هو طبق لذيذ يتم تقديمه غالبًا كمقبلات أو حتى كطبق رئيسي مع روتي أو نان أو باراثا. إنها قائمة بارزة في حفلات الزفاف والحفلات. من المكونات الأساسية للمطبخ البنجابي ، وهي مصنوعة من قطع الدجاج الخالية من العظم المنقوعة في تتبيلة الزبادي وتُطهى في الفرن أو التندور إما على السيخ أو كما هو.4', 30, 88, 'Chicken Tikka.jpg', 0, NULL, NULL, 1, 3, 151, '2021-11-04 14:10:42', 151, '2021-12-26 11:24:47', NULL),
(190, 'Kabali Pulao', 'قبالي بولاو', 'Kabuli Pulao is an incredibly delicious dish from Afghanistan, as the name suggests. This light and aromatic rice dish with lamb, other meat or poultry, that\'s jewelled with carrots and raisins is the Afghan national dish.', 'كابولي بولاو هو طبق شهي بشكل لا يصدق من أفغانستان ، كما يوحي الاسم. طبق الأرز الخفيف والعطري هذا مع لحم الضأن أو اللحوم أو الدواجن الأخرى والمرصع بالجزر والزبيب هو الطبق الوطني الأفغاني.', 30, 88, 'Kabali Pulao.jpg', 0, NULL, NULL, 1, 3, 151, '2021-11-04 14:16:03', 151, '2021-12-21 16:29:31', NULL),
(191, 'test', 'تيست', 'test', 'تيست', 20, 89, 'menu3.jpg', 0, NULL, NULL, 1, 3, 133, '2021-11-04 15:05:32', 133, '2021-11-04 15:05:32', NULL),
(192, 'test meal', 'وجبة تجربة', 'test meal', 'وجبة تجربة', 30, 90, 'fav1.jpg', 0, NULL, NULL, 1, 3, 133, '2021-11-04 15:06:32', 133, '2021-11-04 15:06:32', NULL),
(193, 'test meal 1', 'وجبة تجربة 1', 'test meal 1', 'وجبة تجربة 1', 20, 89, 'menu6.jpg', 0, NULL, NULL, 1, 3, 133, '2021-11-04 15:08:27', 133, '2021-11-04 15:08:27', NULL),
(194, 'test meal 2', 'وجبة تجربة 2', 'test meal 2', 'وجبة تجربة 2', 20, 90, 'menu2.jpg', 0, NULL, NULL, 1, 3, 133, '2021-11-04 15:09:46', 133, '2021-11-04 15:09:46', NULL),
(195, 'test meal 3', 'وجبة تجربة 3', 'test meal 3', 'وجبة تجربة 3', 20, 89, 'pic1.jpg', 0, NULL, NULL, 1, 3, 133, '2021-11-04 15:10:47', 133, '2021-11-04 15:10:47', NULL),
(196, 'test', 'تيست', 'test', 'تيست', 20, 91, 'menu6.jpg', 0, NULL, NULL, 1, 3, 153, '2021-11-04 15:23:30', 153, '2021-11-04 15:23:30', NULL),
(197, 'test meal', 'وجبة تجربة', 'test meal', 'وجبة تجربة', 30, 91, 'pic1.jpg', 0, NULL, NULL, 1, 3, 153, '2021-11-04 15:24:21', 153, '2021-11-04 15:24:21', NULL),
(198, 'test meal 2', 'وجبة تجربة 2', 'test meal 2', 'وجبة تجربة 2', 20, 91, 'menu1.jpg', 0, NULL, NULL, 1, 3, 153, '2021-11-04 15:25:13', 153, '2021-11-04 15:28:29', NULL),
(199, 'test meal 1', 'وجبة تجربة 1', 'test meal 1', 'وجبة تجربة 1', 20, 91, 'menu1.jpg', 0, NULL, NULL, 1, 3, 153, '2021-11-04 15:25:15', 153, '2021-11-04 15:25:15', NULL),
(200, 'test meal 1', 'وجبة تجربة 1', 'test meal 1', 'وجبة تجربة 1', 20, 91, 'menu1.jpg', 0, NULL, NULL, 1, 3, 153, '2021-11-04 15:25:15', 153, '2021-11-04 15:25:15', NULL),
(201, 'test meal 4', 'وجبة تجربة 4', 'test meal 4', 'وجبة تجربة 4', 20, 91, 'menu1.jpg', 0, NULL, NULL, 1, 3, 153, '2021-11-04 15:25:18', 153, '2021-11-04 15:28:55', NULL),
(202, 'test meal 3', 'وجبة تجربة 3', 'test meal 3', 'وجبة تجربة 3', 20, 91, 'menu5.jpg', 0, NULL, NULL, 1, 3, 153, '2021-11-04 15:27:47', 153, '2021-11-04 15:27:47', NULL),
(203, 'test', 'تيست', 'test', 'تيست', 30, 74, 'menu3.jpg', 0, NULL, NULL, 1, 3, 61, '2021-11-04 15:43:50', 61, '2021-11-04 15:43:50', NULL),
(204, 'test meal 1', 'وجبة تجربة 1', 'test meal 1', 'وجبة تجربة 1', 20, 74, 'download.jfif', 0, NULL, NULL, 1, 3, 61, '2021-11-04 16:06:14', 61, '2021-11-14 14:08:08', NULL),
(205, 'test meal 2', 'وجبة تجربة 2', 'test meal 2', 'وجبة تجربة 2', 30, 74, 'pic4.jpg', 0, NULL, NULL, 1, 3, 61, '2021-11-04 16:18:23', 61, '2021-11-04 16:18:23', NULL),
(206, 'test meal 3', 'وجبة تجربة 3', 'test meal 3', 'وجبة تجربة 3', 20, 74, 'pic1.jpg', 0, NULL, NULL, 1, 3, 61, '2021-11-04 16:19:26', 61, '2021-11-04 16:19:26', NULL),
(207, 'test meal 4', 'وجبة تجربة 4', 'test meal 4', 'وجبة تجربة 4', 30, 74, 'offer.jpg', 0, NULL, NULL, 1, 3, 61, '2021-11-04 16:20:29', 61, '2021-11-14 14:09:48', NULL),
(208, 'pepsi', 'بيبسي', 'soft drink', 'مشروب غازي', 8, 77, 'download (3).jfif', 0, NULL, NULL, 1, 3, 58, '2021-11-16 13:14:09', 58, '2021-11-16 13:14:43', NULL),
(209, 'Biryani', 'برياني', 'It is made with Indian spices, rice, and meat usually that of chicken, goat, lamb, prawn, fish, and sometimes, in addition, eggs or vegetables such as potatoes in certain regional varieties.', 'وهي مصنوعة من التوابل الهندية والأرز واللحوم عادة ما تكون الدجاج والماعز والضأن والجمبري والأسماك، وأحيانا، بالإضافة إلى البيض أو الخضروات مثل البطاطا في أصناف إقليمية معينة.', 90, 97, 'R.png', 0, NULL, NULL, 1, 3, 158, '2021-11-22 15:13:04', 158, '2021-11-22 15:13:04', NULL),
(210, 'mand chicken', 'مندي دجاج', 'very hot', 'حارة جدا', 30, 97, 'download.jpeg', 0, NULL, NULL, 1, 3, 158, '2021-11-22 15:22:44', 158, '2021-11-22 15:22:44', NULL),
(211, 'Afghan Shinwari Lamb Meat Tikka Dish', 'طبق تكا لحم الضأن الأفغاني شينواري', 'Charcoal grilled lamb meat, lamb meat fat and salt.', 'لحم غنم مشوي علي الفحم ، لحم ضأن دهن و ملح.', 30, 88, 'Afghan Shinwari Lamb.jpg', 0, NULL, NULL, 1, 3, 151, '2021-12-21 18:13:33', 151, '2021-12-21 18:13:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_belongings`
--

CREATE TABLE `item_belongings` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `related_item_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_belongings`
--

INSERT INTO `item_belongings` (`id`, `item_id`, `related_item_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(30, 176, 175, '2021-10-09 05:25:31', 58, '2021-10-09 05:25:31', NULL),
(36, 173, 178, '2021-10-10 14:04:07', 58, '2021-10-10 14:04:07', NULL),
(45, 180, 179, '2021-10-19 11:59:05', 131, '2021-10-19 11:59:05', NULL),
(52, 60, 65, '2021-10-19 13:45:48', 58, '2021-10-19 13:45:48', NULL),
(53, 60, 82, '2021-10-19 13:45:48', 58, '2021-10-19 13:45:48', NULL),
(55, 66, 63, '2021-10-19 13:46:57', 58, '2021-10-19 13:46:57', NULL),
(56, 65, 63, '2021-10-19 13:48:07', 58, '2021-10-19 13:48:07', NULL),
(57, 64, 81, '2021-10-19 13:49:03', 58, '2021-10-19 13:49:03', NULL),
(58, 179, 58, '2021-10-26 16:52:05', 58, '2021-10-26 16:52:05', NULL),
(59, 178, 173, '2021-10-26 18:46:09', 58, '2021-10-26 18:46:09', NULL),
(60, 178, 176, '2021-10-26 18:46:10', 58, '2021-10-26 18:46:10', NULL),
(61, 182, 180, '2021-11-04 13:47:37', 131, '2021-11-04 13:47:37', NULL),
(62, 184, 182, '2021-11-04 13:51:30', 131, '2021-11-04 13:51:30', NULL),
(63, 185, 182, '2021-11-04 13:52:52', 131, '2021-11-04 13:52:52', NULL),
(64, 185, 183, '2021-11-04 13:52:53', 131, '2021-11-04 13:52:53', NULL),
(65, 186, 182, '2021-11-04 13:54:12', 131, '2021-11-04 13:54:12', NULL),
(70, 192, 191, '2021-11-04 15:06:37', 133, '2021-11-04 15:06:37', NULL),
(71, 193, 191, '2021-11-04 15:08:36', 133, '2021-11-04 15:08:36', NULL),
(72, 193, 192, '2021-11-04 15:08:36', 133, '2021-11-04 15:08:36', NULL),
(73, 194, 192, '2021-11-04 15:09:52', 133, '2021-11-04 15:09:52', NULL),
(74, 195, 191, '2021-11-04 15:10:57', 133, '2021-11-04 15:10:57', NULL),
(75, 195, 192, '2021-11-04 15:10:57', 133, '2021-11-04 15:10:57', NULL),
(76, 197, 196, '2021-11-04 15:24:29', 153, '2021-11-04 15:24:29', NULL),
(77, 202, 199, '2021-11-04 15:27:56', 153, '2021-11-04 15:27:56', NULL),
(78, 203, 181, '2021-11-04 15:43:58', 61, '2021-11-04 15:43:58', NULL),
(80, 205, 203, '2021-11-04 16:18:31', 61, '2021-11-04 16:18:31', NULL),
(81, 206, 203, '2021-11-04 16:19:34', 61, '2021-11-04 16:19:34', NULL),
(83, 175, 174, '2021-11-10 19:52:27', 58, '2021-11-10 19:52:27', NULL),
(84, 59, 173, '2021-11-10 19:53:35', 58, '2021-11-10 19:53:35', NULL),
(85, 59, 178, '2021-11-10 19:53:35', 58, '2021-11-10 19:53:35', NULL),
(86, 58, 60, '2021-11-14 14:04:09', 58, '2021-11-14 14:04:09', NULL),
(87, 58, 68, '2021-11-14 14:04:09', 58, '2021-11-14 14:04:09', NULL),
(88, 58, 69, '2021-11-14 14:04:09', 58, '2021-11-14 14:04:09', NULL),
(89, 58, 175, '2021-11-14 14:04:09', 58, '2021-11-14 14:04:09', NULL),
(90, 174, 172, '2021-11-14 14:05:19', 58, '2021-11-14 14:05:19', NULL),
(91, 61, 59, '2021-11-14 14:07:06', 58, '2021-11-14 14:07:06', NULL),
(92, 204, 181, '2021-11-14 14:08:08', 61, '2021-11-14 14:08:08', NULL),
(93, 207, 205, '2021-11-14 14:09:49', 61, '2021-11-14 14:09:49', NULL),
(95, 208, 59, '2021-11-16 13:14:44', 58, '2021-11-16 13:14:44', NULL),
(96, 208, 179, '2021-11-16 13:14:44', 58, '2021-11-16 13:14:44', NULL),
(97, 85, 179, '2021-11-20 17:59:39', 58, '2021-11-20 17:59:39', NULL),
(98, 210, 209, '2021-11-22 15:23:18', 158, '2021-11-22 15:23:18', NULL),
(99, 209, 210, '2021-11-22 15:26:51', 158, '2021-11-22 15:26:51', NULL),
(122, 187, 188, '2021-12-21 16:29:02', 151, '2021-12-21 16:29:02', NULL),
(123, 187, 189, '2021-12-21 16:29:03', 151, '2021-12-21 16:29:03', NULL),
(124, 187, 190, '2021-12-21 16:29:03', 151, '2021-12-21 16:29:03', NULL),
(125, 190, 187, '2021-12-21 16:29:32', 151, '2021-12-21 16:29:32', NULL),
(126, 190, 188, '2021-12-21 16:29:35', 151, '2021-12-21 16:29:35', NULL),
(127, 190, 189, '2021-12-21 16:29:36', 151, '2021-12-21 16:29:36', NULL),
(128, 188, 187, '2021-12-21 16:29:49', 151, '2021-12-21 16:29:49', NULL),
(129, 188, 189, '2021-12-21 16:29:50', 151, '2021-12-21 16:29:50', NULL),
(130, 188, 190, '2021-12-21 16:29:50', 151, '2021-12-21 16:29:50', NULL),
(134, 189, 187, '2021-12-26 11:24:56', 151, '2021-12-26 11:24:56', NULL),
(135, 189, 188, '2021-12-26 11:24:57', 151, '2021-12-26 11:24:57', NULL),
(136, 189, 190, '2021-12-26 11:24:58', 151, '2021-12-26 11:24:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_component`
--

CREATE TABLE `item_component` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_component`
--

INSERT INTO `item_component` (`id`, `item_id`, `component_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(75, 76, 10, '2021-09-12 05:38:39', 58, '2021-09-12 05:38:39', NULL),
(76, 76, 11, '2021-09-12 05:38:39', 58, '2021-09-12 05:38:39', NULL),
(77, 77, 10, '2021-09-12 05:39:28', 58, '2021-09-12 05:39:28', NULL),
(78, 77, 11, '2021-09-12 05:39:28', 58, '2021-09-12 05:39:28', NULL),
(79, 78, 10, '2021-09-12 05:44:28', 58, '2021-09-12 05:44:28', NULL),
(80, 88, 10, '2021-09-12 05:58:45', 58, '2021-09-12 05:58:45', NULL),
(82, 171, 11, '2021-09-26 08:44:40', 58, '2021-09-26 08:44:40', NULL),
(83, 171, 12, '2021-09-26 08:44:40', 58, '2021-09-26 08:44:40', NULL),
(95, 176, 23, '2021-10-09 05:25:31', 58, '2021-10-09 05:25:31', NULL),
(96, 177, 23, '2021-10-10 06:12:58', 58, '2021-10-10 06:12:58', NULL),
(97, 177, 24, '2021-10-10 06:12:58', 58, '2021-10-10 06:12:58', NULL),
(106, 173, 22, '2021-10-10 14:04:07', 58, '2021-10-10 14:04:07', NULL),
(115, 180, 26, '2021-10-19 11:59:05', 131, '2021-10-19 11:59:05', NULL),
(126, 60, 23, '2021-10-19 13:45:47', 58, '2021-10-19 13:45:47', NULL),
(127, 60, 24, '2021-10-19 13:45:47', 58, '2021-10-19 13:45:47', NULL),
(131, 66, 23, '2021-10-19 13:46:57', 58, '2021-10-19 13:46:57', NULL),
(132, 66, 24, '2021-10-19 13:46:57', 58, '2021-10-19 13:46:57', NULL),
(133, 65, 22, '2021-10-19 13:48:07', 58, '2021-10-19 13:48:07', NULL),
(134, 65, 23, '2021-10-19 13:48:07', 58, '2021-10-19 13:48:07', NULL),
(135, 65, 24, '2021-10-19 13:48:07', 58, '2021-10-19 13:48:07', NULL),
(136, 64, 22, '2021-10-19 13:49:03', 58, '2021-10-19 13:49:03', NULL),
(137, 64, 23, '2021-10-19 13:49:03', 58, '2021-10-19 13:49:03', NULL),
(138, 64, 24, '2021-10-19 13:49:03', 58, '2021-10-19 13:49:03', NULL),
(144, 181, 27, '2021-10-20 18:00:14', 61, '2021-10-20 18:00:14', NULL),
(145, 179, 23, '2021-10-26 16:52:05', 58, '2021-10-26 16:52:05', NULL),
(146, 179, 24, '2021-10-26 16:52:05', 58, '2021-10-26 16:52:05', NULL),
(147, 178, 23, '2021-10-26 18:46:07', 58, '2021-10-26 18:46:07', NULL),
(148, 178, 24, '2021-10-26 18:46:07', 58, '2021-10-26 18:46:07', NULL),
(149, 182, 26, '2021-11-04 13:47:25', 131, '2021-11-04 13:47:25', NULL),
(150, 183, 26, '2021-11-04 13:48:49', 131, '2021-11-04 13:48:49', NULL),
(151, 184, 29, '2021-11-04 13:51:20', 131, '2021-11-04 13:51:20', NULL),
(152, 184, 30, '2021-11-04 13:51:20', 131, '2021-11-04 13:51:20', NULL),
(153, 185, 29, '2021-11-04 13:52:36', 131, '2021-11-04 13:52:36', NULL),
(154, 185, 30, '2021-11-04 13:52:36', 131, '2021-11-04 13:52:36', NULL),
(155, 186, 29, '2021-11-04 13:54:06', 131, '2021-11-04 13:54:06', NULL),
(156, 186, 30, '2021-11-04 13:54:06', 131, '2021-11-04 13:54:06', NULL),
(169, 191, 38, '2021-11-04 15:05:33', 133, '2021-11-04 15:05:33', NULL),
(170, 191, 39, '2021-11-04 15:05:33', 133, '2021-11-04 15:05:33', NULL),
(171, 191, 40, '2021-11-04 15:05:33', 133, '2021-11-04 15:05:33', NULL),
(172, 192, 37, '2021-11-04 15:06:32', 133, '2021-11-04 15:06:32', NULL),
(173, 192, 38, '2021-11-04 15:06:32', 133, '2021-11-04 15:06:32', NULL),
(174, 192, 40, '2021-11-04 15:06:32', 133, '2021-11-04 15:06:32', NULL),
(175, 193, 38, '2021-11-04 15:08:27', 133, '2021-11-04 15:08:27', NULL),
(176, 193, 39, '2021-11-04 15:08:27', 133, '2021-11-04 15:08:27', NULL),
(177, 194, 39, '2021-11-04 15:09:47', 133, '2021-11-04 15:09:47', NULL),
(178, 194, 40, '2021-11-04 15:09:47', 133, '2021-11-04 15:09:47', NULL),
(179, 194, 41, '2021-11-04 15:09:47', 133, '2021-11-04 15:09:47', NULL),
(180, 195, 38, '2021-11-04 15:10:47', 133, '2021-11-04 15:10:47', NULL),
(181, 195, 39, '2021-11-04 15:10:47', 133, '2021-11-04 15:10:47', NULL),
(182, 196, 45, '2021-11-04 15:23:31', 153, '2021-11-04 15:23:31', NULL),
(183, 196, 46, '2021-11-04 15:23:32', 153, '2021-11-04 15:23:32', NULL),
(184, 197, 43, '2021-11-04 15:24:22', 153, '2021-11-04 15:24:22', NULL),
(185, 197, 44, '2021-11-04 15:24:22', 153, '2021-11-04 15:24:22', NULL),
(188, 199, 42, '2021-11-04 15:25:15', 153, '2021-11-04 15:25:15', NULL),
(189, 199, 43, '2021-11-04 15:25:15', 153, '2021-11-04 15:25:15', NULL),
(190, 200, 42, '2021-11-04 15:25:16', 153, '2021-11-04 15:25:16', NULL),
(191, 200, 43, '2021-11-04 15:25:16', 153, '2021-11-04 15:25:16', NULL),
(194, 202, 44, '2021-11-04 15:27:47', 153, '2021-11-04 15:27:47', NULL),
(195, 202, 45, '2021-11-04 15:27:47', 153, '2021-11-04 15:27:47', NULL),
(196, 198, 42, '2021-11-04 15:28:29', 153, '2021-11-04 15:28:29', NULL),
(197, 198, 43, '2021-11-04 15:28:29', 153, '2021-11-04 15:28:29', NULL),
(198, 198, 45, '2021-11-04 15:28:29', 153, '2021-11-04 15:28:29', NULL),
(199, 201, 42, '2021-11-04 15:28:56', 153, '2021-11-04 15:28:56', NULL),
(200, 201, 43, '2021-11-04 15:28:56', 153, '2021-11-04 15:28:56', NULL),
(201, 201, 44, '2021-11-04 15:28:56', 153, '2021-11-04 15:28:56', NULL),
(202, 203, 27, '2021-11-04 15:43:50', 61, '2021-11-04 15:43:50', NULL),
(203, 203, 47, '2021-11-04 15:43:50', 61, '2021-11-04 15:43:50', NULL),
(206, 205, 49, '2021-11-04 16:18:23', 61, '2021-11-04 16:18:23', NULL),
(207, 205, 50, '2021-11-04 16:18:24', 61, '2021-11-04 16:18:24', NULL),
(208, 206, 48, '2021-11-04 16:19:26', 61, '2021-11-04 16:19:26', NULL),
(209, 206, 49, '2021-11-04 16:19:26', 61, '2021-11-04 16:19:26', NULL),
(210, 206, 50, '2021-11-04 16:19:26', 61, '2021-11-04 16:19:26', NULL),
(213, 175, 23, '2021-11-10 19:52:27', 58, '2021-11-10 19:52:27', NULL),
(214, 175, 24, '2021-11-10 19:52:27', 58, '2021-11-10 19:52:27', NULL),
(215, 59, 23, '2021-11-10 19:53:35', 58, '2021-11-10 19:53:35', NULL),
(216, 58, 23, '2021-11-14 14:04:08', 58, '2021-11-14 14:04:08', NULL),
(217, 174, 23, '2021-11-14 14:05:19', 58, '2021-11-14 14:05:19', NULL),
(218, 61, 22, '2021-11-14 14:07:06', 58, '2021-11-14 14:07:06', NULL),
(219, 61, 23, '2021-11-14 14:07:06', 58, '2021-11-14 14:07:06', NULL),
(220, 61, 24, '2021-11-14 14:07:06', 58, '2021-11-14 14:07:06', NULL),
(221, 204, 47, '2021-11-14 14:08:08', 61, '2021-11-14 14:08:08', NULL),
(222, 204, 48, '2021-11-14 14:08:08', 61, '2021-11-14 14:08:08', NULL),
(223, 207, 27, '2021-11-14 14:09:48', 61, '2021-11-14 14:09:48', NULL),
(224, 207, 48, '2021-11-14 14:09:48', 61, '2021-11-14 14:09:48', NULL),
(225, 209, 51, '2021-11-22 15:13:05', 158, '2021-11-22 15:13:05', NULL),
(226, 209, 52, '2021-11-22 15:13:05', 158, '2021-11-22 15:13:05', NULL),
(227, 209, 53, '2021-11-22 15:13:05', 158, '2021-11-22 15:13:05', NULL),
(228, 210, 54, '2021-11-22 15:22:44', 158, '2021-11-22 15:22:44', NULL),
(266, 187, 28, '2021-12-21 16:29:02', 151, '2021-12-21 16:29:02', NULL),
(267, 190, 25, '2021-12-21 16:29:32', 151, '2021-12-21 16:29:32', NULL),
(268, 190, 28, '2021-12-21 16:29:32', 151, '2021-12-21 16:29:32', NULL),
(269, 190, 32, '2021-12-21 16:29:32', 151, '2021-12-21 16:29:32', NULL),
(270, 190, 33, '2021-12-21 16:29:32', 151, '2021-12-21 16:29:32', NULL),
(271, 188, 28, '2021-12-21 16:29:48', 151, '2021-12-21 16:29:48', NULL),
(272, 188, 34, '2021-12-21 16:29:48', 151, '2021-12-21 16:29:48', NULL),
(273, 188, 36, '2021-12-21 16:29:48', 151, '2021-12-21 16:29:48', NULL),
(274, 188, 55, '2021-12-21 16:29:48', 151, '2021-12-21 16:29:48', NULL),
(275, 188, 56, '2021-12-21 16:29:49', 151, '2021-12-21 16:29:49', NULL),
(276, 211, 28, '2021-12-21 18:13:33', 151, '2021-12-21 18:13:33', NULL),
(277, 211, 33, '2021-12-21 18:13:33', 151, '2021-12-21 18:13:33', NULL),
(278, 211, 55, '2021-12-21 18:13:34', 151, '2021-12-21 18:13:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_price_currency`
--

CREATE TABLE `item_price_currency` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `acc_currency_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_price_currency`
--

INSERT INTO `item_price_currency` (`id`, `item_id`, `price`, `acc_currency_id`, `created_at`, `created_by`, `updated_at`) VALUES
(32, 173, 12, 1, '2021-10-10 14:04:07', 58, '2021-10-10 14:04:07'),
(56, 180, 50, 37, '2021-10-19 11:59:04', 131, '2021-10-19 11:59:04'),
(57, 180, 15, 39, '2021-10-19 11:59:04', 131, '2021-10-19 11:59:04'),
(58, 180, 30, 40, '2021-10-19 11:59:05', 131, '2021-10-19 11:59:05'),
(89, 60, 100, 1, '2021-10-19 13:45:47', 58, '2021-10-19 13:45:47'),
(90, 60, 100, 31, '2021-10-19 13:45:47', 58, '2021-10-19 13:45:47'),
(91, 60, 100, 32, '2021-10-19 13:45:47', 58, '2021-10-19 13:45:47'),
(92, 60, 100, 33, '2021-10-19 13:45:47', 58, '2021-10-19 13:45:47'),
(99, 66, 100, 1, '2021-10-19 13:46:57', 58, '2021-10-19 13:46:57'),
(100, 66, 100, 31, '2021-10-19 13:46:57', 58, '2021-10-19 13:46:57'),
(101, 66, 100, 32, '2021-10-19 13:46:57', 58, '2021-10-19 13:46:57'),
(102, 66, 100, 33, '2021-10-19 13:46:57', 58, '2021-10-19 13:46:57'),
(104, 65, 100, 1, '2021-10-19 13:48:06', 58, '2021-10-19 13:48:06'),
(105, 65, 100, 31, '2021-10-19 13:48:06', 58, '2021-10-19 13:48:06'),
(106, 65, 100, 32, '2021-10-19 13:48:06', 58, '2021-10-19 13:48:06'),
(107, 65, 100, 33, '2021-10-19 13:48:06', 58, '2021-10-19 13:48:06'),
(109, 64, 100, 1, '2021-10-19 13:49:02', 58, '2021-10-19 13:49:02'),
(110, 64, 100, 31, '2021-10-19 13:49:02', 58, '2021-10-19 13:49:02'),
(111, 64, 100, 32, '2021-10-19 13:49:02', 58, '2021-10-19 13:49:02'),
(112, 64, 100, 33, '2021-10-19 13:49:02', 58, '2021-10-19 13:49:02'),
(130, 181, 100, 50, '2021-10-20 18:00:14', 61, '2021-10-20 18:00:14'),
(131, 181, 100, 51, '2021-10-20 18:00:14', 61, '2021-10-20 18:00:14'),
(132, 181, 100, 52, '2021-10-20 18:00:14', 61, '2021-10-20 18:00:14'),
(133, 181, 100, 53, '2021-10-20 18:00:14', 61, '2021-10-20 18:00:14'),
(134, 179, 1, 1, '2021-10-26 16:52:04', 58, '2021-10-26 16:52:04'),
(135, 179, 5, 31, '2021-10-26 16:52:04', 58, '2021-10-26 16:52:04'),
(136, 179, 2, 32, '2021-10-26 16:52:04', 58, '2021-10-26 16:52:04'),
(137, 179, 44, 33, '2021-10-26 16:52:04', 58, '2021-10-26 16:52:04'),
(139, 178, 100, 1, '2021-10-26 18:46:07', 58, '2021-10-26 18:46:07'),
(140, 178, 100, 31, '2021-10-26 18:46:07', 58, '2021-10-26 18:46:07'),
(141, 178, 100, 32, '2021-10-26 18:46:07', 58, '2021-10-26 18:46:07'),
(142, 178, 100, 33, '2021-10-26 18:46:07', 58, '2021-10-26 18:46:07'),
(144, 182, 100, 37, '2021-11-04 13:47:25', 131, '2021-11-04 13:47:25'),
(145, 182, 50, 39, '2021-11-04 13:47:25', 131, '2021-11-04 13:47:25'),
(146, 182, 25, 40, '2021-11-04 13:47:25', 131, '2021-11-04 13:47:25'),
(147, 183, 100, 37, '2021-11-04 13:48:49', 131, '2021-11-04 13:48:49'),
(148, 183, 50, 39, '2021-11-04 13:48:49', 131, '2021-11-04 13:48:49'),
(149, 183, 25, 40, '2021-11-04 13:48:49', 131, '2021-11-04 13:48:49'),
(150, 184, 100, 37, '2021-11-04 13:51:20', 131, '2021-11-04 13:51:20'),
(151, 184, 50, 39, '2021-11-04 13:51:20', 131, '2021-11-04 13:51:20'),
(152, 184, 25, 40, '2021-11-04 13:51:20', 131, '2021-11-04 13:51:20'),
(153, 185, 200, 37, '2021-11-04 13:52:36', 131, '2021-11-04 13:52:36'),
(154, 185, 100, 39, '2021-11-04 13:52:36', 131, '2021-11-04 13:52:36'),
(155, 185, 50, 40, '2021-11-04 13:52:36', 131, '2021-11-04 13:52:36'),
(156, 186, 100, 37, '2021-11-04 13:54:05', 131, '2021-11-04 13:54:05'),
(157, 186, 50, 39, '2021-11-04 13:54:05', 131, '2021-11-04 13:54:05'),
(158, 186, 25, 40, '2021-11-04 13:54:05', 131, '2021-11-04 13:54:05'),
(175, 191, 50, 44, '2021-11-04 15:05:32', 133, '2021-11-04 15:05:32'),
(176, 191, 50, 45, '2021-11-04 15:05:32', 133, '2021-11-04 15:05:32'),
(177, 191, 50, 57, '2021-11-04 15:05:32', 133, '2021-11-04 15:05:32'),
(178, 191, 50, 58, '2021-11-04 15:05:32', 133, '2021-11-04 15:05:32'),
(179, 192, 100, 44, '2021-11-04 15:06:32', 133, '2021-11-04 15:06:32'),
(180, 192, 100, 45, '2021-11-04 15:06:32', 133, '2021-11-04 15:06:32'),
(181, 192, 100, 57, '2021-11-04 15:06:32', 133, '2021-11-04 15:06:32'),
(182, 192, 100, 58, '2021-11-04 15:06:32', 133, '2021-11-04 15:06:32'),
(183, 193, 50, 44, '2021-11-04 15:08:27', 133, '2021-11-04 15:08:27'),
(184, 193, 50, 45, '2021-11-04 15:08:27', 133, '2021-11-04 15:08:27'),
(185, 193, 50, 57, '2021-11-04 15:08:27', 133, '2021-11-04 15:08:27'),
(186, 193, 50, 58, '2021-11-04 15:08:27', 133, '2021-11-04 15:08:27'),
(187, 194, 100, 44, '2021-11-04 15:09:46', 133, '2021-11-04 15:09:46'),
(188, 194, 100, 45, '2021-11-04 15:09:46', 133, '2021-11-04 15:09:46'),
(189, 194, 100, 57, '2021-11-04 15:09:47', 133, '2021-11-04 15:09:47'),
(190, 194, 100, 58, '2021-11-04 15:09:47', 133, '2021-11-04 15:09:47'),
(191, 195, 100, 44, '2021-11-04 15:10:47', 133, '2021-11-04 15:10:47'),
(192, 195, 100, 45, '2021-11-04 15:10:47', 133, '2021-11-04 15:10:47'),
(193, 195, 100, 57, '2021-11-04 15:10:47', 133, '2021-11-04 15:10:47'),
(194, 195, 100, 58, '2021-11-04 15:10:47', 133, '2021-11-04 15:10:47'),
(195, 196, 50, 46, '2021-11-04 15:23:30', 153, '2021-11-04 15:23:30'),
(196, 196, 50, 47, '2021-11-04 15:23:30', 153, '2021-11-04 15:23:30'),
(197, 196, 50, 59, '2021-11-04 15:23:30', 153, '2021-11-04 15:23:30'),
(198, 196, 50, 60, '2021-11-04 15:23:31', 153, '2021-11-04 15:23:31'),
(199, 197, 100, 46, '2021-11-04 15:24:22', 153, '2021-11-04 15:24:22'),
(200, 197, 100, 47, '2021-11-04 15:24:22', 153, '2021-11-04 15:24:22'),
(201, 197, 1000, 59, '2021-11-04 15:24:22', 153, '2021-11-04 15:24:22'),
(202, 197, 100, 60, '2021-11-04 15:24:22', 153, '2021-11-04 15:24:22'),
(207, 199, 100, 46, '2021-11-04 15:25:15', 153, '2021-11-04 15:25:15'),
(208, 199, 100, 47, '2021-11-04 15:25:15', 153, '2021-11-04 15:25:15'),
(209, 199, 100, 59, '2021-11-04 15:25:15', 153, '2021-11-04 15:25:15'),
(210, 199, 100, 60, '2021-11-04 15:25:15', 153, '2021-11-04 15:25:15'),
(211, 200, 100, 46, '2021-11-04 15:25:15', 153, '2021-11-04 15:25:15'),
(212, 200, 100, 47, '2021-11-04 15:25:15', 153, '2021-11-04 15:25:15'),
(213, 200, 100, 59, '2021-11-04 15:25:16', 153, '2021-11-04 15:25:16'),
(214, 200, 100, 60, '2021-11-04 15:25:16', 153, '2021-11-04 15:25:16'),
(219, 202, 100, 46, '2021-11-04 15:27:47', 153, '2021-11-04 15:27:47'),
(220, 202, 100, 47, '2021-11-04 15:27:47', 153, '2021-11-04 15:27:47'),
(221, 202, 100, 59, '2021-11-04 15:27:47', 153, '2021-11-04 15:27:47'),
(222, 202, 100, 60, '2021-11-04 15:27:47', 153, '2021-11-04 15:27:47'),
(223, 198, 100, 46, '2021-11-04 15:28:29', 153, '2021-11-04 15:28:29'),
(224, 198, 100, 47, '2021-11-04 15:28:29', 153, '2021-11-04 15:28:29'),
(225, 198, 100, 59, '2021-11-04 15:28:29', 153, '2021-11-04 15:28:29'),
(226, 198, 100, 60, '2021-11-04 15:28:29', 153, '2021-11-04 15:28:29'),
(227, 201, 100, 46, '2021-11-04 15:28:55', 153, '2021-11-04 15:28:55'),
(228, 201, 100, 47, '2021-11-04 15:28:55', 153, '2021-11-04 15:28:55'),
(229, 201, 100, 59, '2021-11-04 15:28:55', 153, '2021-11-04 15:28:55'),
(230, 201, 100, 60, '2021-11-04 15:28:55', 153, '2021-11-04 15:28:55'),
(231, 203, 75, 50, '2021-11-04 15:43:50', 61, '2021-11-04 15:43:50'),
(232, 203, 75, 51, '2021-11-04 15:43:50', 61, '2021-11-04 15:43:50'),
(233, 203, 75, 52, '2021-11-04 15:43:50', 61, '2021-11-04 15:43:50'),
(234, 203, 75, 53, '2021-11-04 15:43:50', 61, '2021-11-04 15:43:50'),
(239, 205, 100, 50, '2021-11-04 16:18:23', 61, '2021-11-04 16:18:23'),
(240, 205, 100, 51, '2021-11-04 16:18:23', 61, '2021-11-04 16:18:23'),
(241, 205, 100, 52, '2021-11-04 16:18:23', 61, '2021-11-04 16:18:23'),
(242, 205, 100, 53, '2021-11-04 16:18:23', 61, '2021-11-04 16:18:23'),
(243, 206, 200, 50, '2021-11-04 16:19:26', 61, '2021-11-04 16:19:26'),
(244, 206, 200, 51, '2021-11-04 16:19:26', 61, '2021-11-04 16:19:26'),
(245, 206, 200, 52, '2021-11-04 16:19:26', 61, '2021-11-04 16:19:26'),
(246, 206, 200, 53, '2021-11-04 16:19:26', 61, '2021-11-04 16:19:26'),
(251, 175, 100, 1, '2021-11-10 19:52:26', 58, '2021-11-10 19:52:26'),
(252, 175, 50, 31, '2021-11-10 19:52:27', 58, '2021-11-10 19:52:27'),
(253, 175, 100, 32, '2021-11-10 19:52:27', 58, '2021-11-10 19:52:27'),
(254, 175, 100, 33, '2021-11-10 19:52:27', 58, '2021-11-10 19:52:27'),
(255, 59, 150, 1, '2021-11-10 19:53:35', 58, '2021-11-10 19:53:35'),
(256, 59, 50, 31, '2021-11-10 19:53:35', 58, '2021-11-10 19:53:35'),
(257, 59, 70, 32, '2021-11-10 19:53:35', 58, '2021-11-10 19:53:35'),
(258, 59, 100, 33, '2021-11-10 19:53:35', 58, '2021-11-10 19:53:35'),
(259, 58, 1, 1, '2021-11-14 14:04:08', 58, '2021-11-14 14:04:08'),
(260, 58, 100, 31, '2021-11-14 14:04:08', 58, '2021-11-14 14:04:08'),
(261, 58, 100, 32, '2021-11-14 14:04:08', 58, '2021-11-14 14:04:08'),
(262, 58, 100, 33, '2021-11-14 14:04:08', 58, '2021-11-14 14:04:08'),
(263, 174, 1, 1, '2021-11-14 14:05:19', 58, '2021-11-14 14:05:19'),
(264, 174, 5, 31, '2021-11-14 14:05:19', 58, '2021-11-14 14:05:19'),
(265, 174, 2, 32, '2021-11-14 14:05:19', 58, '2021-11-14 14:05:19'),
(266, 174, 1, 33, '2021-11-14 14:05:19', 58, '2021-11-14 14:05:19'),
(267, 61, 100, 1, '2021-11-14 14:07:06', 58, '2021-11-14 14:07:06'),
(268, 61, 100, 31, '2021-11-14 14:07:06', 58, '2021-11-14 14:07:06'),
(269, 61, 100, 32, '2021-11-14 14:07:06', 58, '2021-11-14 14:07:06'),
(270, 61, 100, 33, '2021-11-14 14:07:06', 58, '2021-11-14 14:07:06'),
(271, 204, 100, 50, '2021-11-14 14:08:08', 61, '2021-11-14 14:08:08'),
(272, 204, 100, 51, '2021-11-14 14:08:08', 61, '2021-11-14 14:08:08'),
(273, 204, 100, 52, '2021-11-14 14:08:08', 61, '2021-11-14 14:08:08'),
(274, 204, 100, 53, '2021-11-14 14:08:08', 61, '2021-11-14 14:08:08'),
(275, 207, 100, 50, '2021-11-14 14:09:48', 61, '2021-11-14 14:09:48'),
(276, 207, 100, 51, '2021-11-14 14:09:48', 61, '2021-11-14 14:09:48'),
(277, 207, 100, 52, '2021-11-14 14:09:48', 61, '2021-11-14 14:09:48'),
(278, 207, 100, 53, '2021-11-14 14:09:48', 61, '2021-11-14 14:09:48'),
(283, 208, 44, 1, '2021-11-16 13:14:43', 58, '2021-11-16 13:14:43'),
(284, 208, 5, 31, '2021-11-16 13:14:43', 58, '2021-11-16 13:14:43'),
(285, 208, 2, 32, '2021-11-16 13:14:43', 58, '2021-11-16 13:14:43'),
(286, 208, 4, 33, '2021-11-16 13:14:43', 58, '2021-11-16 13:14:43'),
(287, 180, 5, 61, '2021-11-20 19:52:54', 131, NULL),
(288, 85, 1, 1, '2021-11-20 17:59:39', 58, '2021-11-20 17:59:39'),
(289, 85, 5, 31, '2021-11-20 17:59:39', 58, '2021-11-20 17:59:39'),
(290, 85, 2, 32, '2021-11-20 17:59:39', 58, '2021-11-20 17:59:39'),
(291, 85, 4, 33, '2021-11-20 17:59:39', 58, '2021-11-20 17:59:39'),
(292, 209, 50, 70, '2021-11-22 15:13:04', 158, '2021-11-22 15:13:04'),
(293, 210, 29, 70, '2021-11-22 15:22:44', 158, '2021-11-22 15:22:44'),
(330, 187, 75, 54, '2021-12-21 16:29:02', 151, '2021-12-21 16:29:02'),
(332, 190, 60, 54, '2021-12-21 16:29:32', 151, '2021-12-21 16:29:32'),
(334, 188, 35, 54, '2021-12-21 16:29:48', 151, '2021-12-21 16:29:48'),
(336, 211, 55, 54, '2021-12-21 18:13:33', 151, '2021-12-21 18:13:33'),
(340, 189, 35, 54, '2021-12-26 11:24:55', 151, '2021-12-26 11:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `item_size`
--

CREATE TABLE `item_size` (
  `id` int(11) NOT NULL,
  `size_name_en` varchar(500) NOT NULL,
  `size_name_ar` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_size`
--

INSERT INTO `item_size` (`id`, `size_name_en`, `size_name_ar`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(3, 'Medium size', 'حجم فردي', '2021-08-15 10:39:12', 1, NULL, NULL),
(4, 'Big size', 'حجم عائلي', '2021-08-15 10:39:12', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_status`
--

CREATE TABLE `item_status` (
  `id` int(11) NOT NULL,
  `status_name_en` varchar(500) NOT NULL,
  `status_name_ar` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_status`
--

INSERT INTO `item_status` (`id`, `status_name_en`, `status_name_ar`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'available', 'متوفرة', '2021-08-15 10:40:21', 1, NULL, NULL),
(2, 'unavailable', 'غير متوفرة', '2021-08-15 10:40:21', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `min_price_currency`
--

CREATE TABLE `min_price_currency` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `min_price` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `min_price_currency`
--

INSERT INTO `min_price_currency` (`id`, `account_id`, `min_price`, `currency_id`, `created_at`, `updated_at`) VALUES
(3, 58, 10, 1, '2021-11-11 20:46:45', '2021-11-11 22:02:43'),
(4, 58, 20, 2, '2021-11-11 20:46:45', '2021-11-11 22:02:43'),
(5, 58, 50, 3, NULL, '2021-11-11 22:02:43'),
(10, 61, 100, 1, '2021-11-12 16:10:20', '2021-11-13 15:02:18'),
(14, 61, 200, 2, '2021-11-14 23:27:01', '2021-11-14 23:27:01'),
(15, 61, 300, 3, '2021-11-14 23:27:01', '2021-11-14 23:27:01'),
(16, 61, 400, 4, '2021-11-14 23:27:02', '2021-11-14 23:27:02'),
(17, 131, 234, 1, '2021-11-16 23:35:12', '2021-11-16 23:35:12'),
(18, 131, 213, 2, '2021-11-16 23:35:12', '2021-11-16 23:35:12'),
(19, 131, 23, 3, '2021-11-16 23:35:12', '2021-11-16 23:35:12'),
(20, 131, 43, 4, '2021-11-16 23:35:12', '2021-11-16 23:35:12'),
(21, 158, 50, 1, '2021-11-22 13:57:34', '2021-11-22 13:57:34'),
(22, 151, 50, 1, '2021-12-21 13:28:13', '2021-12-21 13:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `type` enum('initial','renew','order','comment','evaluation') NOT NULL,
  `notifiable` int(11) NOT NULL,
  `notifiable_type` enum('customer','restaurant') NOT NULL,
  `notified` int(11) DEFAULT NULL,
  `notified_type` enum('admin','restaurant') NOT NULL,
  `data` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable`, `notifiable_type`, `notified`, `notified_type`, `data`, `created_at`, `updated_at`) VALUES
(34, 'renew', 58, 'restaurant', NULL, 'admin', 'Restaurant has renewed subscription', '2021-09-30 08:25:16', NULL),
(35, 'initial', 136, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-09-30 08:57:47', NULL),
(36, 'evaluation', 1, 'customer', 60, 'restaurant', 'Has made an evaluation', '2021-10-02 08:40:22', NULL),
(37, 'initial', 137, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-10-02 06:42:50', NULL),
(38, 'initial', 137, 'restaurant', NULL, 'admin', 'New application has been completed', '2021-10-02 06:57:56', NULL),
(39, 'initial', 138, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-10-02 10:47:17', NULL),
(40, 'comment', 1, 'customer', 62, 'restaurant', 'New comment has been made.', '2021-10-02 14:41:20', NULL),
(41, 'comment', 1, 'customer', 62, 'restaurant', 'New comment has been made.', '2021-10-02 14:42:37', NULL),
(42, 'comment', 1, 'customer', 62, 'restaurant', 'New comment has been made.', '2021-10-02 14:43:54', NULL),
(43, 'comment', 1, 'customer', 62, 'restaurant', 'New comment has been made.', '2021-10-02 14:44:06', NULL),
(44, 'comment', 1, 'customer', 62, 'restaurant', 'New comment has been made.', '2021-10-02 14:45:40', NULL),
(45, 'comment', 1, 'customer', 62, 'restaurant', 'New comment has been made.', '2021-10-02 14:46:17', NULL),
(46, 'comment', 1, 'customer', 62, 'restaurant', 'New comment has been made.', '2021-10-02 14:48:34', NULL),
(47, 'evaluation', 4, 'customer', 62, 'restaurant', 'New comment has been made.', '2021-10-02 15:07:46', NULL),
(48, 'evaluation', 4, 'customer', 58, 'restaurant', 'New evaluation has been made.', '2021-10-02 15:14:34', NULL),
(49, 'evaluation', 4, 'customer', 58, 'restaurant', 'New evaluation has been made.', '2021-10-02 15:15:28', NULL),
(50, 'evaluation', 4, 'customer', 62, 'restaurant', 'Has made a new evaluation.', '2021-10-02 15:26:52', NULL),
(51, 'evaluation', 1, 'customer', 58, 'restaurant', 'New evaluation has been made.', '2021-10-03 04:29:38', NULL),
(52, 'order', 1, 'customer', 58, 'restaurant', 'New order has been made.', '2021-10-03 04:32:13', NULL),
(53, 'order', 1, 'customer', 58, 'restaurant', 'New order has been made.', '2021-10-03 04:34:44', NULL),
(54, 'order', 1, 'customer', 58, 'restaurant', 'New order has been made.', '2021-10-03 04:35:02', NULL),
(55, 'initial', 139, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-10-04 13:39:27', NULL),
(56, 'initial', 58, 'restaurant', NULL, 'admin', 'Restaurant has renewed subscription', '2021-10-14 17:04:17', NULL),
(57, 'initial', 58, 'restaurant', NULL, 'admin', 'Restaurant has renewed subscription', '2021-10-14 17:07:19', NULL),
(58, 'initial', 58, 'restaurant', NULL, 'admin', 'Restaurant has renewed subscription', '2021-10-15 18:49:53', NULL),
(59, 'initial', 58, 'restaurant', NULL, 'admin', 'Restaurant has renewed subscription', '2021-10-15 18:59:54', NULL),
(60, 'initial', 58, 'restaurant', NULL, 'admin', 'Restaurant has renewed subscription', '2021-10-15 19:11:56', NULL),
(61, 'initial', 58, 'restaurant', NULL, 'admin', 'Restaurant has renewed subscription', '2021-10-15 19:18:49', NULL),
(62, 'initial', 148, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-10-17 02:42:45', NULL),
(63, 'initial', 149, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-10-17 02:43:29', NULL),
(64, 'initial', 150, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-10-17 02:45:15', NULL),
(65, 'initial', 151, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-10-17 09:38:48', NULL),
(66, 'initial', 151, 'restaurant', NULL, 'admin', 'New application has been completed.', '2021-10-17 10:44:19', NULL),
(67, 'initial', 152, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-10-18 18:32:41', NULL),
(68, 'initial', 153, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-10-18 18:33:46', NULL),
(69, 'order', 25, 'customer', 58, 'restaurant', 'New order has been made.', '2021-10-22 17:26:32', NULL),
(70, 'order', 25, 'customer', 58, 'restaurant', 'New order has been made.', '2021-10-22 17:34:45', NULL),
(71, 'order', 25, 'customer', 58, 'restaurant', 'New order has been made.', '2021-10-23 03:24:48', NULL),
(72, 'order', 25, 'customer', 58, 'restaurant', 'New order has been made.', '2021-10-23 03:26:52', NULL),
(73, 'order', 25, 'customer', 58, 'restaurant', 'New order has been made.', '2021-10-23 03:28:55', NULL),
(74, 'order', 25, 'customer', 58, 'restaurant', 'New order has been made.', '2021-10-23 03:31:11', NULL),
(75, 'order', 25, 'customer', 58, 'restaurant', 'New order has been made.', '2021-10-23 16:48:37', NULL),
(76, 'evaluation', 787, 'customer', 61, 'restaurant', 'Has made a new evaluation.', '2021-10-24 19:01:50', NULL),
(77, 'order', 26, 'customer', 58, 'restaurant', 'New order has been made.', '2021-10-25 13:05:10', NULL),
(78, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-08 20:00:19', NULL),
(79, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-09 12:31:54', NULL),
(80, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-09 12:33:27', NULL),
(81, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-09 23:37:52', NULL),
(82, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-10 00:27:32', NULL),
(83, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-10 01:50:21', NULL),
(84, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-10 01:52:13', NULL),
(85, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-10 02:26:48', NULL),
(86, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-10 02:27:45', NULL),
(87, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-10 02:43:55', NULL),
(88, 'order', 40, 'customer', 61, 'restaurant', 'New order has been made.', '2021-11-10 03:08:45', NULL),
(89, 'order', 40, 'customer', 61, 'restaurant', 'New order has been made.', '2021-11-10 03:11:07', NULL),
(90, 'order', 40, 'customer', 61, 'restaurant', 'New order has been made.', '2021-11-10 10:35:54', NULL),
(91, 'order', 40, 'customer', 61, 'restaurant', 'New order has been made.', '2021-11-10 10:44:42', NULL),
(92, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-10 11:00:36', NULL),
(93, 'order', 40, 'customer', 61, 'restaurant', 'New order has been made.', '2021-11-10 11:01:36', NULL),
(94, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-10 11:03:40', NULL),
(95, 'order', 40, 'customer', 61, 'restaurant', 'New order has been made.', '2021-11-10 13:13:03', NULL),
(96, 'order', 40, 'customer', 61, 'restaurant', 'New order has been made.', '2021-11-10 13:21:32', NULL),
(97, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-11 13:59:03', NULL),
(98, 'order', 40, 'customer', 61, 'restaurant', 'New order has been made.', '2021-11-11 15:25:00', NULL),
(99, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-11 15:34:30', NULL),
(100, 'order', 40, 'customer', 151, 'restaurant', 'New order has been made.', '2021-11-11 15:44:22', NULL),
(101, 'order', 40, 'customer', 151, 'restaurant', 'New order has been made.', '2021-11-12 14:26:49', NULL),
(102, 'order', 40, 'customer', 61, 'restaurant', 'New order has been made.', '2021-11-13 00:13:34', NULL),
(103, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-13 00:14:02', NULL),
(104, 'order', 40, 'customer', 61, 'restaurant', 'New order has been made.', '2021-11-13 00:16:23', NULL),
(105, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-14 11:43:31', NULL),
(106, 'order', 25, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-14 18:38:54', NULL),
(107, 'order', 25, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-14 18:39:14', NULL),
(108, 'order', 25, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-17 04:52:24', NULL),
(109, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-17 13:14:47', NULL),
(110, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-17 13:20:06', NULL),
(111, 'order', 25, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-17 18:01:53', NULL),
(112, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-17 19:44:20', NULL),
(113, 'order', 40, 'customer', 61, 'restaurant', 'New order has been made.', '2021-11-17 19:50:31', NULL),
(114, 'order', 47, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-18 14:33:13', NULL),
(115, 'order', 40, 'customer', 61, 'restaurant', 'New order has been made.', '2021-11-18 18:24:37', NULL),
(116, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-18 18:24:55', NULL),
(117, 'order', 40, 'customer', 151, 'restaurant', 'New order has been made.', '2021-11-19 15:42:42', NULL),
(118, 'evaluation', 787, 'customer', 61, 'restaurant', 'Has made a new evaluation.', '2021-11-20 15:56:54', NULL),
(119, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-20 16:08:11', NULL),
(120, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-21 15:42:54', NULL),
(121, 'evaluation', 835, 'customer', 58, 'restaurant', 'Has made a new evaluation.', '2021-11-21 16:38:26', NULL),
(123, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-21 19:59:41', NULL),
(124, 'initial', 157, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-11-22 12:20:16', NULL),
(125, 'initial', 158, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-11-22 12:59:54', NULL),
(126, 'initial', 158, 'restaurant', NULL, 'admin', 'New application has been completed.', '2021-11-22 13:13:43', NULL),
(127, 'initial', 159, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-11-22 13:19:48', NULL),
(128, 'initial', 160, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-11-22 13:46:38', NULL),
(129, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-22 18:18:14', NULL),
(130, 'order', 40, 'customer', 158, 'restaurant', 'New order has been made.', '2021-11-22 18:37:27', NULL),
(131, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-22 18:41:33', NULL),
(132, 'order', 40, 'customer', 61, 'restaurant', 'New order has been made.', '2021-11-23 11:12:00', NULL),
(133, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-23 15:43:21', NULL),
(134, 'order', 40, 'customer', 151, 'restaurant', 'New order has been made.', '2021-11-23 15:48:00', NULL),
(135, 'order', 40, 'customer', 153, 'restaurant', 'New order has been made.', '2021-11-23 15:50:19', NULL),
(136, 'order', 40, 'customer', 133, 'restaurant', 'New order has been made.', '2021-11-23 15:57:47', NULL),
(137, 'order', 47, 'customer', 158, 'restaurant', 'New order has been made.', '2021-11-23 16:53:15', NULL),
(138, 'order', 47, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-26 16:28:09', NULL),
(139, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-27 14:43:17', NULL),
(140, 'order', 40, 'customer', 61, 'restaurant', 'New order has been made.', '2021-11-27 15:03:22', NULL),
(141, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-27 16:09:07', NULL),
(142, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-27 17:18:54', NULL),
(143, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-27 17:20:44', NULL),
(144, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-27 18:54:31', NULL),
(145, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-27 20:19:46', NULL),
(146, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-27 22:12:35', NULL),
(147, 'order', 47, 'customer', 158, 'restaurant', 'New order has been made.', '2021-11-28 11:48:42', NULL),
(148, 'initial', 161, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-11-28 15:57:33', NULL),
(149, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-28 16:24:37', NULL),
(150, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-28 16:25:36', NULL),
(151, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-28 16:27:16', NULL),
(152, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-28 16:30:59', NULL),
(153, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-28 16:32:05', NULL),
(154, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-28 16:33:11', NULL),
(155, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-28 16:35:29', NULL),
(156, 'order', 40, 'customer', 58, 'restaurant', 'New order has been made.', '2021-11-28 17:53:01', NULL),
(157, 'order', 47, 'customer', 158, 'restaurant', 'New order has been made.', '2021-11-28 17:55:55', NULL),
(158, 'order', 47, 'customer', 158, 'restaurant', 'New order has been made.', '2021-11-28 17:57:47', NULL),
(159, 'initial', 162, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-11-29 13:21:17', NULL),
(160, 'initial', 162, 'restaurant', NULL, 'admin', 'New application has been completed.', '2021-11-29 13:42:37', NULL),
(161, 'order', 40, 'customer', 133, 'restaurant', 'New order has been made.', '2021-11-29 18:57:33', NULL),
(162, 'order', 47, 'customer', 58, 'restaurant', 'New order has been made.', '2021-12-04 11:14:00', NULL),
(163, 'initial', 163, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-12-14 17:43:51', NULL),
(164, 'initial', 164, 'restaurant', NULL, 'admin', 'new application has been created.', '2021-12-14 18:46:13', NULL),
(165, 'order', 25, 'customer', 58, 'restaurant', 'New order has been made.', '2021-12-29 15:17:56', NULL),
(166, 'order', 22, 'customer', 61, 'restaurant', 'New order has been made.', '2022-01-03 15:41:17', NULL),
(167, 'order', 22, 'customer', 58, 'restaurant', 'New order has been made.', '2022-01-03 15:42:16', NULL),
(168, 'initial', 165, 'restaurant', NULL, 'admin', 'new application has been created.', '2022-01-20 10:59:45', NULL),
(169, 'initial', 167, 'restaurant', NULL, 'admin', 'new application has been created.', '2022-02-05 21:57:44', NULL),
(170, 'initial', 168, 'restaurant', NULL, 'admin', 'new application has been created.', '2022-02-05 21:59:47', NULL),
(171, 'initial', 169, 'restaurant', NULL, 'admin', 'new application has been created.', '2022-02-05 22:01:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `offer_name_en` varchar(500) NOT NULL,
  `offer_name_ar` varchar(500) NOT NULL,
  `offer_image` varchar(500) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `approve` tinyint(1) DEFAULT NULL,
  `approved_date` timestamp NULL DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `offer_name_en`, `offer_name_ar`, `offer_image`, `item_id`, `created_at`, `created_by`, `expiry_date`, `approve`, `approved_date`, `approved_by`) VALUES
(1, 'first', 'تيست', 'unknown.jpg', 59, '2021-09-13 12:21:07', 58, '2022-09-29 04:00:00', 1, '2021-11-14 14:13:27', 60),
(2, 'second', 'الثاني', 'unknown.jpg', 59, '2021-09-13 12:21:28', 58, '2022-09-27 04:00:00', 1, '2021-11-14 14:11:48', 60),
(3, 'third', 'الثالث', 'offer.jpg', 207, '2021-09-13 12:24:37', 61, '2022-09-28 04:00:00', 1, '2021-11-14 14:10:57', 60),
(4, 'test new', 'تيست', 'download (1).jfif', 59, '2021-09-15 07:55:27', 58, '2021-11-29 05:00:00', NULL, NULL, NULL),
(6, 'termiso offer', 'تيراميسو', 'download.jfif', 174, '2021-09-27 09:50:44', 58, '2022-11-30 05:00:00', 1, '2021-11-14 14:11:59', 60),
(7, 'sushi offer', 'سوشي', '90cf15fca56b0e383c071d4a209af016_w750_h750.jpg', 58, '2021-10-05 08:49:18', 58, '2022-11-05 04:00:00', 1, '2021-11-14 14:11:38', 60),
(8, 'test offer', 'عرض تجربة', 'menu5.jpg', 188, '2021-11-04 10:12:00', 151, '2022-11-10 05:00:00', 2, '2021-11-11 17:44:49', NULL),
(9, 'test offer 1', 'عرض تجربة 1', 'pic3.jpg', 189, '2021-11-04 10:14:56', 151, '2021-11-11 05:00:00', 1, '2021-11-14 14:12:25', 60),
(10, 'test offer', 'عرض تجربة', 'menu5.jpg', 185, '2021-11-04 10:21:37', 131, '2021-11-10 05:00:00', 0, '2022-01-03 15:34:27', 146),
(11, 'test offer 1', 'عرض تجربة 1', 'download (2).jfif', 61, '2021-11-04 10:52:52', 58, '2021-11-17 05:00:00', 1, '2021-11-14 14:12:40', 60),
(12, 'test offer 2', 'عرض تجربة 2', 'menu7.jpg', 186, '2021-11-04 10:57:06', 131, '2021-11-13 05:00:00', 1, '2021-11-14 14:11:15', 60),
(13, 'test offer', 'عرض تجربة', 'pic4.jpg', 191, '2021-11-04 11:07:32', 133, '2021-11-09 05:00:00', 1, '2022-01-03 15:34:05', 146),
(14, 'test offer', 'عرض تجربة', 'menu3.jpg', 196, '2021-11-04 11:29:41', 153, '2021-11-26 05:00:00', 1, '2022-01-03 15:34:17', 146),
(15, 'test offer 1', 'عرض تجربة 1', 'fav2.jpg', 204, '2021-11-04 12:21:41', 61, '2021-11-20 05:00:00', 1, '2021-11-14 14:11:25', 60);

-- --------------------------------------------------------

--
-- Table structure for table `offer_price_currency`
--

CREATE TABLE `offer_price_currency` (
  `id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `acc_currency_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offer_price_currency`
--

INSERT INTO `offer_price_currency` (`id`, `offer_id`, `price`, `acc_currency_id`, `created_at`, `created_by`, `updated_at`) VALUES
(18, 8, 100, 54, '2021-11-04 14:12:00', 151, '2021-11-04 14:12:00'),
(22, 9, 50, 54, '2021-11-04 14:14:56', 151, '2021-11-04 14:14:56'),
(25, 10, 100, 37, '2021-11-04 14:21:37', 131, '2021-11-04 14:21:37'),
(26, 10, 100, 39, '2021-11-04 14:21:37', 131, '2021-11-04 14:21:37'),
(27, 10, 100, 40, '2021-11-04 14:21:37', 131, '2021-11-04 14:21:37'),
(32, 12, 50, 37, '2021-11-04 14:57:06', 131, '2021-11-04 14:57:06'),
(33, 12, 50, 39, '2021-11-04 14:57:06', 131, '2021-11-04 14:57:06'),
(34, 12, 50, 40, '2021-11-04 14:57:06', 131, '2021-11-04 14:57:06'),
(35, 13, 25, 44, '2021-11-04 15:07:32', 133, '2021-11-04 15:07:32'),
(36, 13, 25, 45, '2021-11-04 15:07:32', 133, '2021-11-04 15:07:32'),
(37, 13, 25, 57, '2021-11-04 15:07:32', 133, '2021-11-04 15:07:32'),
(38, 13, 25, 58, '2021-11-04 15:07:32', 133, '2021-11-04 15:07:32'),
(39, 14, 20, 46, '2021-11-04 15:29:42', 153, '2021-11-04 15:29:42'),
(40, 14, 20, 47, '2021-11-04 15:29:42', 153, '2021-11-04 15:29:42'),
(41, 14, 20, 59, '2021-11-04 15:29:42', 153, '2021-11-04 15:29:42'),
(42, 14, 20, 60, '2021-11-04 15:29:42', 153, '2021-11-04 15:29:42'),
(51, 1, 4, 1, '2021-11-14 13:43:55', 58, '2021-11-14 13:43:55'),
(52, 1, 1, 31, '2021-11-14 13:43:55', 58, '2021-11-14 13:43:55'),
(53, 1, 5, 32, '2021-11-14 13:43:55', 58, '2021-11-14 13:43:55'),
(54, 1, 6, 33, '2021-11-14 13:43:55', 58, '2021-11-14 13:43:55'),
(55, 2, 4, 1, '2021-11-14 13:44:11', 58, '2021-11-14 13:44:11'),
(56, 2, 1, 31, '2021-11-14 13:44:11', 58, '2021-11-14 13:44:11'),
(57, 2, 5, 32, '2021-11-14 13:44:11', 58, '2021-11-14 13:44:11'),
(58, 2, 6, 33, '2021-11-14 13:44:11', 58, '2021-11-14 13:44:11'),
(59, 7, 4, 1, '2021-11-14 13:44:45', 58, '2021-11-14 13:44:45'),
(60, 7, 1, 31, '2021-11-14 13:44:46', 58, '2021-11-14 13:44:46'),
(61, 7, 5, 32, '2021-11-14 13:44:46', 58, '2021-11-14 13:44:46'),
(62, 7, 6, 33, '2021-11-14 13:44:46', 58, '2021-11-14 13:44:46'),
(63, 6, 6, 1, '2021-11-14 13:46:09', 58, '2021-11-14 13:46:09'),
(64, 6, 1, 31, '2021-11-14 13:46:09', 58, '2021-11-14 13:46:09'),
(65, 6, 5, 32, '2021-11-14 13:46:10', 58, '2021-11-14 13:46:10'),
(66, 6, 6, 33, '2021-11-14 13:46:10', 58, '2021-11-14 13:46:10'),
(71, 4, 4, 1, '2021-11-14 13:48:21', 58, '2021-11-14 13:48:21'),
(72, 4, 1, 31, '2021-11-14 13:48:22', 58, '2021-11-14 13:48:22'),
(73, 4, 5, 32, '2021-11-14 13:48:22', 58, '2021-11-14 13:48:22'),
(74, 4, 6, 33, '2021-11-14 13:48:22', 58, '2021-11-14 13:48:22'),
(75, 11, 50, 1, '2021-11-14 13:49:17', 58, '2021-11-14 13:49:17'),
(76, 11, 50, 31, '2021-11-14 13:49:17', 58, '2021-11-14 13:49:17'),
(77, 11, 50, 32, '2021-11-14 13:49:17', 58, '2021-11-14 13:49:17'),
(78, 11, 50, 33, '2021-11-14 13:49:18', 58, '2021-11-14 13:49:18'),
(79, 15, 25, 50, '2021-11-14 13:51:24', 61, '2021-11-14 13:51:24'),
(80, 15, 25, 51, '2021-11-14 13:51:24', 61, '2021-11-14 13:51:24'),
(81, 15, 25, 52, '2021-11-14 13:51:24', 61, '2021-11-14 13:51:24'),
(82, 15, 25, 53, '2021-11-14 13:51:24', 61, '2021-11-14 13:51:24'),
(87, 3, 1, 50, '2021-11-14 14:10:07', 61, '2021-11-14 14:10:07'),
(88, 3, 4, 51, '2021-11-14 14:10:07', 61, '2021-11-14 14:10:07'),
(89, 3, 2, 52, '2021-11-14 14:10:07', 61, '2021-11-14 14:10:07'),
(90, 3, 74, 53, '2021-11-14 14:10:07', 61, '2021-11-14 14:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `token` varchar(5000) DEFAULT NULL,
  `payment_verfication` varchar(5000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_cost_before` double(10,0) NOT NULL,
  `has_coupon` tinyint(1) NOT NULL DEFAULT 0,
  `total_cost_after` double NOT NULL,
  `customer_address_id` int(11) NOT NULL,
  `note` mediumtext DEFAULT NULL,
  `payment_type_id` int(11) NOT NULL,
  `order_stop_log_id` int(11) DEFAULT NULL,
  `done` tinyint(1) DEFAULT NULL,
  `done_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `restaurant_id`, `cart_id`, `tax_id`, `currency_id`, `token`, `payment_verfication`, `created_at`, `total_cost_before`, `has_coupon`, `total_cost_after`, `customer_address_id`, `note`, `payment_type_id`, `order_stop_log_id`, `done`, `done_date`) VALUES
(61, 1, 58, 27, 2, 0, NULL, NULL, '2021-10-19 14:26:59', 99, 1, 11, 28, 'note first orders', 1, 75, 0, '2021-10-19 15:10:38'),
(62, 1, 58, 28, 2, 0, NULL, NULL, '2021-10-19 15:32:05', 99, 0, 11, 28, 'note first orders', 1, 60, 0, '2021-10-19 13:22:23'),
(67, 1, 58, 0, 2, 0, NULL, NULL, '2021-10-21 14:22:33', 99, 0, 11, 28, 'note first orders', 1, 79, NULL, NULL),
(68, 1, 58, 0, 2, 0, NULL, NULL, '2021-10-21 14:26:36', 99, 1, 11, 28, 'note first orders', 1, 80, NULL, NULL),
(69, 40, 58, 37, 2, 1, NULL, NULL, '2021-11-08 15:00:18', 48, 0, 54.72, 32, 'note first orders', 1, 1, NULL, NULL),
(70, 40, 58, 38, 2, 1, NULL, NULL, '2021-11-09 07:31:53', 200, 0, 228, 32, 'note first orders', 1, 2, NULL, NULL),
(71, 40, 58, 39, 2, 1, NULL, NULL, '2021-11-09 07:33:26', 200, 0, 228, 32, 'note first orders', 1, 3, NULL, NULL),
(72, 40, 58, 40, 2, 1, NULL, NULL, '2021-11-09 18:37:51', 48, 0, 54.72, 32, 'note first orders', 1, 4, NULL, NULL),
(73, 40, 58, 41, 2, 1, NULL, NULL, '2021-11-09 19:27:31', 200, 0, 228, 32, 'note first orders', 1, 5, NULL, NULL),
(74, 40, 58, 42, 2, 1, NULL, NULL, '2021-11-09 20:50:20', 200, 0, 228, 32, 'note first orders', 1, 6, NULL, NULL),
(75, 40, 58, 43, 2, 1, NULL, NULL, '2021-11-09 20:52:13', 48, 0, 54.72, 32, NULL, 2, 7, NULL, NULL),
(76, 40, 58, 44, 2, 1, NULL, NULL, '2021-11-09 21:26:47', 48, 0, 54.72, 32, NULL, 2, 8, NULL, NULL),
(77, 40, 58, 45, 2, 1, NULL, NULL, '2021-11-09 21:27:44', 100, 0, 114, 32, NULL, 2, 9, NULL, NULL),
(78, 40, 58, 46, 2, 1, NULL, NULL, '2021-11-09 21:43:54', 12, 0, 13.68, 32, NULL, 2, 10, NULL, NULL),
(79, 40, 61, 47, 2, 1, NULL, NULL, '2021-11-09 22:08:44', 75, 0, 85.5, 32, NULL, 2, 11, NULL, NULL),
(80, 40, 61, 48, 2, 1, NULL, NULL, '2021-11-09 22:11:06', 100, 0, 114, 32, NULL, 2, 12, NULL, NULL),
(81, 40, 61, 49, 2, 1, NULL, NULL, '2021-11-10 05:35:52', 100, 0, 114, 32, NULL, 2, 13, NULL, NULL),
(82, 40, 61, 50, 2, 1, NULL, NULL, '2021-11-10 05:44:38', 200, 0, 228, 32, NULL, 2, 14, NULL, NULL),
(83, 40, 58, 51, 2, 1, NULL, NULL, '2021-11-10 06:00:32', 1, 0, 1.14, 32, NULL, 2, 15, NULL, NULL),
(84, 40, 61, 52, 2, 1, NULL, NULL, '2021-11-10 06:01:32', 100, 0, 114, 32, NULL, 2, 16, NULL, NULL),
(85, 40, 58, 53, 2, 1, NULL, NULL, '2021-11-10 06:03:35', 300, 0, 342, 32, NULL, 2, 17, NULL, NULL),
(86, 40, 61, 54, 2, 1, NULL, NULL, '2021-11-10 08:13:02', 100, 0, 114, 32, NULL, 2, 18, NULL, NULL),
(87, 40, 61, 55, 2, 1, NULL, NULL, '2021-11-10 08:21:31', 100, 0, 114, 32, NULL, 1, 19, NULL, NULL),
(88, 40, 58, 56, 2, 1, NULL, NULL, '2021-11-11 08:59:02', 100, 0, 114, 32, NULL, 1, 20, NULL, NULL),
(89, 40, 61, 57, 2, 1, NULL, NULL, '2021-11-11 10:24:59', 100, 0, 114, 32, NULL, 1, 21, NULL, NULL),
(90, 40, 58, 58, 2, 1, NULL, NULL, '2021-11-11 10:34:30', 100, 0, 114, 32, NULL, 1, 22, NULL, NULL),
(91, 40, 151, 59, 2, 1, NULL, NULL, '2021-11-11 10:44:21', 50, 0, 57, 32, NULL, 1, 23, NULL, NULL),
(92, 40, 151, 60, 2, 1, NULL, NULL, '2021-11-12 09:26:49', 50, 0, 57, 32, NULL, 1, 24, NULL, NULL),
(93, 40, 61, 61, 2, 1, NULL, NULL, '2021-11-12 19:13:33', 75, 0, 85.5, 32, NULL, 1, 25, NULL, NULL),
(94, 40, 58, 62, 2, 1, NULL, NULL, '2021-11-12 19:14:01', 1, 0, 1.14, 32, 'note first orders', 1, 26, NULL, NULL),
(95, 40, 61, 63, 2, 1, NULL, NULL, '2021-11-12 19:16:20', 75, 0, 85.5, 32, NULL, 1, 27, NULL, NULL),
(96, 40, 58, 64, 2, 1, NULL, NULL, '2021-11-14 06:43:30', 48, 0, 54.72, 32, 'note first orders', 1, 28, NULL, NULL),
(103, 25, 58, 0, 2, 1, NULL, NULL, '2021-11-14 13:38:54', 400, 0, 456, 45, 'Note', 1, 35, NULL, NULL),
(104, 25, 58, 0, 2, 1, NULL, NULL, '2021-11-14 13:39:13', 400, 0, 456, 45, 'Note', 1, 36, NULL, NULL),
(105, 25, 58, 0, 2, 1, NULL, NULL, '2021-11-16 23:52:23', 1, 0, 1.14, 45, 'Note', 1, 37, NULL, NULL),
(106, 40, 58, 65, 2, 1, NULL, NULL, '2021-11-17 08:14:47', 48, 0, 54.72, 32, 'note first orders', 1, 38, NULL, NULL),
(107, 40, 58, 68, 2, 1, NULL, NULL, '2021-11-17 08:20:05', 112, 0, 127.68, 32, NULL, 1, 39, NULL, NULL),
(108, 25, 58, 0, 2, 1, NULL, NULL, '2021-11-17 13:01:53', 106, 0, 176.84, 45, 'Note', 1, 40, NULL, NULL),
(109, 40, 58, 69, 2, 1, NULL, NULL, '2021-11-17 14:44:19', 349, 0, 397.86, 47, NULL, 1, 41, NULL, NULL),
(110, 40, 61, 70, 2, 1, NULL, NULL, '2021-11-17 14:50:29', 75, 0, 85.5, 47, NULL, 1, 42, NULL, NULL),
(111, 47, 58, 67, 2, 1, NULL, NULL, '2021-11-18 09:33:12', 201, 1, 217.14, 48, NULL, 1, 43, NULL, NULL),
(112, 40, 61, 72, 2, 1, NULL, NULL, '2021-11-18 13:24:36', 200, 0, 228, 32, NULL, 1, 44, NULL, NULL),
(113, 40, 58, 73, 2, 1, NULL, NULL, '2021-11-18 13:24:55', 48, 0, 54.72, 32, 'note first orders', 1, 45, NULL, NULL),
(114, 40, 151, 74, 2, 1, NULL, NULL, '2021-11-19 10:42:41', 150, 0, 171, 47, NULL, 1, 46, NULL, NULL),
(115, 40, 58, 75, 2, 1, NULL, NULL, '2021-11-20 11:08:11', 150, 0, 171, 47, NULL, 1, 47, NULL, NULL),
(116, 40, 58, 77, 2, 1, NULL, NULL, '2021-11-21 10:42:53', 1, 0, 1.14, 32, 'note first orders', 1, 48, NULL, NULL),
(117, 40, 58, 78, 2, 1, NULL, NULL, '2021-11-21 14:59:40', 48, 0, 54.72, 32, 'note first orders', 1, 49, NULL, NULL),
(118, 40, 58, 80, 2, 1, NULL, NULL, '2021-11-22 13:18:13', 48, 0, 54.72, 32, 'note first orders', 1, 50, NULL, NULL),
(119, 40, 158, 81, 2, 1, NULL, NULL, '2021-11-22 13:37:26', 48, 0, 165.9, 32, 'note first orders', 1, 51, NULL, NULL),
(120, 40, 58, 82, 2, 1, NULL, NULL, '2021-11-22 13:41:32', 48, 0, 165.9, 32, 'note first orders', 1, 52, NULL, NULL),
(121, 40, 61, 83, 2, 1, NULL, NULL, '2021-11-23 06:11:59', 48, 0, 165.9, 32, 'note first orders', 1, 53, NULL, NULL),
(122, 40, 58, 84, 3, 1, NULL, NULL, '2021-11-23 10:43:20', 36, 1, 25.8, 58, NULL, 1, 54, NULL, NULL),
(123, 40, 151, 85, 3, 1, NULL, NULL, '2021-11-23 10:47:59', 50, 0, 52.5, 58, NULL, 1, 55, NULL, NULL),
(124, 40, 153, 86, 3, 1, NULL, NULL, '2021-11-23 10:50:18', 100, 0, 105, 58, NULL, 1, 56, NULL, NULL),
(125, 40, 133, 87, 3, 1, NULL, NULL, '2021-11-23 10:57:46', 300, 0, 315, 58, NULL, 1, 57, NULL, NULL),
(126, 47, 158, 0, 3, 1, NULL, NULL, '2021-11-23 11:53:15', 50, 0, 52.5, 70, 'Note', 1, 58, NULL, NULL),
(127, 47, 58, 71, 3, 1, NULL, NULL, '2021-11-26 11:28:08', 112, 0, 117.6, 49, NULL, 1, 59, NULL, NULL),
(128, 40, 58, 88, 2, 1, NULL, NULL, '2021-11-27 09:43:17', 48, 0, 165.9, 32, 'note first orders', 1, 60, NULL, NULL),
(129, 40, 61, 90, 3, 1, NULL, NULL, '2021-11-27 10:03:21', 100, 0, 105, 58, NULL, 1, 61, NULL, NULL),
(133, 40, 58, 91, 3, 1, NULL, NULL, '2021-11-27 11:09:06', 12, 0, 12.6, 58, 'self.not', 1, 62, NULL, NULL),
(134, 40, 58, 92, 3, 1, NULL, NULL, '2021-11-27 12:18:53', 2, 0, 2.1, 58, 'self.not', 2, 63, NULL, NULL),
(135, 40, 58, 93, 3, 1, NULL, NULL, '2021-11-27 12:20:43', 4, 0, 4.2, 58, 'self.not', 1, 64, NULL, NULL),
(136, 40, 58, 94, 3, 1, NULL, NULL, '2021-11-27 13:54:30', 100, 0, 105, 58, 'self.not', 2, 65, NULL, NULL),
(137, 40, 58, 95, 3, 1, NULL, NULL, '2021-11-27 15:19:45', 4, 0, 4.2, 51, 'self.not', 1, 66, NULL, NULL),
(138, 40, 58, 96, 3, 1, NULL, NULL, '2021-11-27 17:12:34', 16, 0, 16.8, 58, 'self.not', 1, 67, NULL, NULL),
(139, 47, 158, 98, 3, 1, NULL, NULL, '2021-11-28 06:48:40', 108, 0, 113.4, 71, NULL, 1, 68, NULL, NULL),
(140, 40, 58, 97, 3, 1, NULL, NULL, '2021-11-28 11:24:36', 200, 0, 210, 58, 'self.not', 1, 69, NULL, NULL),
(141, 40, 58, 99, 2, 1, NULL, NULL, '2021-11-28 11:25:35', 48, 0, 165.9, 32, 'note first orders', 1, 70, NULL, NULL),
(142, 40, 58, 100, 3, 1, NULL, NULL, '2021-11-28 11:27:16', 100, 0, 105, 58, 'self.not', 1, 71, NULL, NULL),
(143, 40, 58, 101, 3, 1, NULL, NULL, '2021-11-28 11:30:58', 100, 0, 105, 58, 'self.not', 1, 72, NULL, NULL),
(144, 40, 58, 102, 2, 1, NULL, NULL, '2021-11-28 11:32:05', 48, 0, 165.9, 32, 'note first orders', 1, 73, NULL, NULL),
(145, 40, 58, 103, 3, 1, NULL, NULL, '2021-11-28 11:33:11', 4, 0, 4.2, 58, 'self.not', 1, 74, NULL, NULL),
(146, 40, 58, 104, 3, 1, NULL, NULL, '2021-11-28 11:35:28', 100, 0, 105, 58, 'self.not', 1, 75, NULL, NULL),
(147, 40, 58, 105, 3, 1, NULL, NULL, '2021-11-28 12:52:59', 24, 0, 25.2, 52, 'self.not', 1, 76, NULL, NULL),
(148, 47, 158, 106, 3, 1, NULL, NULL, '2021-11-28 12:55:54', 29, 0, 30.45, 71, NULL, 1, 77, NULL, NULL),
(149, 47, 158, 107, 3, 1, NULL, NULL, '2021-11-28 12:57:46', 79, 0, 82.95, 71, NULL, 1, 78, NULL, NULL),
(150, 40, 133, 108, 3, 1, NULL, NULL, '2021-11-29 13:57:32', 100, 0, 105, 52, NULL, 1, 79, NULL, NULL),
(151, 47, 58, 110, 3, 1, NULL, NULL, '2021-12-04 06:13:59', 1, 0, 1.05, 75, 'self.not', 1, 80, NULL, NULL),
(152, 25, 58, 0, 3, 1, NULL, NULL, '2021-12-29 10:17:54', 1, 0, 1.05, 46, 'Note', 1, 81, NULL, NULL),
(153, 22, 61, 112, 3, 1, NULL, NULL, '2022-01-03 10:41:15', 100, 0, 105, 78, 'test', 1, 82, NULL, NULL),
(154, 22, 58, 113, 3, 1, NULL, NULL, '2022-01-03 10:42:16', 1, 0, 1.05, 78, 'check', 1, 83, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `item_count` int(11) NOT NULL DEFAULT 1,
  `item_price` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `offer_id`, `item_count`, `item_price`, `created_at`, `created_by`) VALUES
(35, 61, 82, NULL, 1, 0, '2021-10-19 14:26:59', 1),
(36, 62, 70, NULL, 1, 0, '2021-10-19 15:32:05', 1),
(39, 67, 82, NULL, 1, 0, '2021-10-21 14:22:33', 1),
(40, 67, 70, NULL, 2, 0, '2021-10-21 14:22:33', 1),
(41, 68, 82, NULL, 1, 0, '2021-10-21 14:26:36', 1),
(42, 68, 70, NULL, 2, 0, '2021-10-21 14:26:36', 1),
(43, 69, 173, NULL, 4, 12, '2021-11-08 15:00:18', 40),
(44, 70, 173, NULL, 4, 12, '2021-11-09 07:31:53', 40),
(45, 71, 173, NULL, 4, 12, '2021-11-09 07:33:26', 40),
(46, 72, 60, NULL, 1, 100, '2021-11-09 18:37:52', 40),
(47, 73, 173, NULL, 4, 12, '2021-11-09 19:27:32', 40),
(48, 74, 179, NULL, 1, 1, '2021-11-09 20:50:21', 40),
(49, 75, 173, NULL, 4, 12, '2021-11-09 20:52:13', 40),
(50, 76, 173, NULL, 4, 12, '2021-11-09 21:26:48', 40),
(51, 77, 59, NULL, 1, 100, '2021-11-09 21:27:44', 40),
(52, 78, 173, NULL, 1, 12, '2021-11-09 21:43:54', 40),
(53, 79, 203, NULL, 1, 75, '2021-11-09 22:08:44', 40),
(54, 80, 204, NULL, 1, 100, '2021-11-09 22:11:07', 40),
(55, 81, 204, NULL, 1, 100, '2021-11-10 05:35:53', 40),
(56, 82, 206, NULL, 1, 200, '2021-11-10 05:44:39', 40),
(57, 83, 179, NULL, 1, 1, '2021-11-10 06:00:35', 40),
(58, 84, 205, NULL, 1, 100, '2021-11-10 06:01:35', 40),
(59, 85, 61, NULL, 3, 100, '2021-11-10 06:03:37', 40),
(60, 86, 205, NULL, 1, 100, '2021-11-10 08:13:03', 40),
(61, 87, 205, NULL, 1, 100, '2021-11-10 08:21:31', 40),
(62, 88, 60, NULL, 1, 100, '2021-11-11 08:59:02', 40),
(63, 89, 204, NULL, 1, 100, '2021-11-11 10:24:59', 40),
(64, 90, 178, NULL, 1, 100, '2021-11-11 10:34:30', 40),
(65, 91, 189, NULL, 1, 50, '2021-11-11 10:44:22', 40),
(66, 92, 188, NULL, 1, 50, '2021-11-12 09:26:49', 40),
(67, 93, 203, NULL, 1, 75, '2021-11-12 19:13:33', 40),
(68, 94, 173, NULL, 4, 12, '2021-11-12 19:14:02', 40),
(69, 95, 203, NULL, 1, 75, '2021-11-12 19:16:22', 40),
(70, 96, 173, NULL, 4, 12, '2021-11-14 06:43:30', 40),
(71, 103, 61, NULL, 1, 100, '2021-11-14 13:38:54', 25),
(72, 103, 64, NULL, 3, 100, '2021-11-14 13:38:54', 25),
(73, 104, 61, NULL, 1, 100, '2021-11-14 13:39:13', 25),
(74, 104, 64, NULL, 3, 100, '2021-11-14 13:39:13', 25),
(75, 105, 62, NULL, 1, 0, '2021-11-16 23:52:23', 25),
(76, 105, 58, NULL, 1, 1, '2021-11-16 23:52:23', 25),
(77, 106, 173, NULL, 4, 12, '2021-11-17 08:14:47', 40),
(78, 107, 173, NULL, 1, 12, '2021-11-17 08:20:05', 40),
(79, 107, 178, NULL, 1, 100, '2021-11-17 08:20:05', 40),
(80, 108, 61, NULL, 1, 100, '2021-11-17 13:01:53', 25),
(81, 108, 58, NULL, 6, 1, '2021-11-17 13:01:53', 25),
(82, 109, 173, NULL, 4, 12, '2021-11-17 14:44:19', 40),
(83, 109, 178, NULL, 2, 100, '2021-11-17 14:44:19', 40),
(84, 109, 175, NULL, 1, 100, '2021-11-17 14:44:19', 40),
(85, 109, 174, NULL, 1, 1, '2021-11-17 14:44:20', 40),
(86, 110, 203, NULL, 1, 75, '2021-11-17 14:50:31', 40),
(87, 111, 175, NULL, 2, 100, '2021-11-18 09:33:13', 47),
(88, 111, 58, NULL, 1, 1, '2021-11-18 09:33:13', 47),
(89, 112, 181, NULL, 5, 100, '2021-11-18 13:24:36', 40),
(90, 113, 173, NULL, 4, 12, '2021-11-18 13:24:55', 40),
(91, 114, 187, NULL, 3, 50, '2021-11-19 10:42:42', 40),
(92, 115, 59, NULL, 1, 150, '2021-11-20 11:08:11', 40),
(93, 116, 173, NULL, 10, 12, '2021-11-21 10:42:54', 40),
(94, 117, 173, NULL, 4, 12, '2021-11-21 14:59:41', 40),
(95, 118, 59, NULL, 1, 150, '2021-11-22 13:18:13', 40),
(96, 118, 173, NULL, 4, 12, '2021-11-22 13:18:13', 40),
(97, 119, 209, NULL, 2, 50, '2021-11-22 13:37:27', 40),
(98, 119, 210, NULL, 2, 29, '2021-11-22 13:37:27', 40),
(99, 120, 59, 2, 2, 4, '2021-11-22 13:41:32', 40),
(100, 121, 207, NULL, 1, 100, '2021-11-23 06:12:00', 40),
(101, 121, 205, NULL, 1, 100, '2021-11-23 06:12:00', 40),
(102, 122, 173, NULL, 3, 12, '2021-11-23 10:43:21', 40),
(103, 123, 187, NULL, 1, 50, '2021-11-23 10:47:59', 40),
(104, 124, 201, NULL, 1, 100, '2021-11-23 10:50:19', 40),
(105, 125, 192, NULL, 1, 100, '2021-11-23 10:57:46', 40),
(106, 125, 194, NULL, 2, 100, '2021-11-23 10:57:47', 40),
(107, 126, 209, NULL, 1, 50, '2021-11-23 11:53:15', 47),
(108, 127, 178, NULL, 1, 100, '2021-11-26 11:28:08', 47),
(109, 127, 173, NULL, 1, 12, '2021-11-26 11:28:09', 47),
(110, 128, 173, NULL, 1, 12, '2021-11-27 09:43:17', 40),
(111, 129, 181, NULL, 1, 100, '2021-11-27 10:03:22', 40),
(112, 133, 173, NULL, 1, 12, '2021-11-27 11:09:06', 40),
(113, 134, 85, NULL, 1, 1, '2021-11-27 12:18:53', 40),
(114, 134, 179, NULL, 1, 1, '2021-11-27 12:18:53', 40),
(115, 135, 58, 7, 1, 4, '2021-11-27 12:20:44', 40),
(116, 136, 66, NULL, 1, 100, '2021-11-27 13:54:31', 40),
(117, 137, 58, 7, 1, 4, '2021-11-27 15:19:45', 40),
(118, 138, 58, 7, 1, 4, '2021-11-27 17:12:34', 40),
(119, 138, 173, NULL, 1, 12, '2021-11-27 17:12:34', 40),
(120, 139, 210, NULL, 2, 29, '2021-11-28 06:48:41', 47),
(121, 139, 209, NULL, 1, 50, '2021-11-28 06:48:41', 47),
(122, 140, 178, NULL, 2, 100, '2021-11-28 11:24:36', 40),
(123, 141, 178, NULL, 1, 100, '2021-11-28 11:25:35', 40),
(124, 142, 178, NULL, 1, 100, '2021-11-28 11:27:16', 40),
(125, 143, 178, NULL, 1, 100, '2021-11-28 11:30:58', 40),
(126, 144, 178, NULL, 1, 100, '2021-11-28 11:32:05', 40),
(127, 145, 59, 1, 1, 4, '2021-11-28 11:33:11', 40),
(128, 146, 178, NULL, 1, 100, '2021-11-28 11:35:29', 40),
(129, 147, 173, NULL, 2, 12, '2021-11-28 12:53:00', 40),
(130, 148, 210, NULL, 1, 29, '2021-11-28 12:55:55', 47),
(131, 149, 209, NULL, 1, 50, '2021-11-28 12:57:46', 47),
(132, 149, 210, NULL, 1, 29, '2021-11-28 12:57:46', 47),
(133, 150, 192, NULL, 1, 100, '2021-11-29 13:57:33', 40),
(134, 151, 174, NULL, 1, 1, '2021-12-04 06:13:59', 47),
(135, 152, 58, NULL, 1, 1, '2021-12-29 10:17:54', 25),
(136, 153, 207, NULL, 1, 100, '2022-01-03 10:41:15', 22),
(137, 154, 174, NULL, 1, 1, '2022-01-03 10:42:16', 22);

-- --------------------------------------------------------

--
-- Table structure for table `order_items_component`
--

CREATE TABLE `order_items_component` (
  `id` int(11) NOT NULL,
  `order_item_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items_component`
--

INSERT INTO `order_items_component` (`id`, `order_item_id`, `component_id`, `created_at`, `created_by`) VALUES
(1, 43, 22, '2021-11-08 15:00:18', 40),
(2, 44, 22, '2021-11-09 07:31:54', 40),
(3, 45, 22, '2021-11-09 07:33:26', 40),
(4, 46, 23, '2021-11-09 18:37:52', 40),
(5, 46, 24, '2021-11-09 18:37:52', 40),
(6, 47, 22, '2021-11-09 19:27:32', 40),
(7, 48, 23, '2021-11-09 20:50:21', 40),
(8, 48, 24, '2021-11-09 20:50:21', 40),
(9, 49, 22, '2021-11-09 20:52:13', 40),
(10, 50, 22, '2021-11-09 21:26:48', 40),
(11, 51, 23, '2021-11-09 21:27:44', 40),
(12, 52, 22, '2021-11-09 21:43:54', 40),
(13, 53, 27, '2021-11-09 22:08:44', 40),
(14, 53, 47, '2021-11-09 22:08:45', 40),
(15, 54, 47, '2021-11-09 22:11:07', 40),
(16, 54, 48, '2021-11-09 22:11:07', 40),
(17, 55, 47, '2021-11-10 05:35:53', 40),
(18, 55, 48, '2021-11-10 05:35:53', 40),
(19, 56, 48, '2021-11-10 05:44:40', 40),
(20, 56, 49, '2021-11-10 05:44:40', 40),
(21, 56, 50, '2021-11-10 05:44:40', 40),
(22, 57, 24, '2021-11-10 06:00:35', 40),
(23, 58, 49, '2021-11-10 06:01:35', 40),
(24, 58, 50, '2021-11-10 06:01:36', 40),
(25, 59, 22, '2021-11-10 06:03:38', 40),
(26, 59, 23, '2021-11-10 06:03:39', 40),
(27, 59, 24, '2021-11-10 06:03:40', 40),
(28, 60, 49, '2021-11-10 08:13:03', 40),
(29, 60, 50, '2021-11-10 08:13:03', 40),
(30, 61, 49, '2021-11-10 08:21:32', 40),
(31, 61, 50, '2021-11-10 08:21:32', 40),
(32, 62, 23, '2021-11-11 08:59:02', 40),
(33, 63, 47, '2021-11-11 10:24:59', 40),
(34, 64, 23, '2021-11-11 10:34:30', 40),
(35, 64, 24, '2021-11-11 10:34:30', 40),
(36, 65, 32, '2021-11-11 10:44:22', 40),
(37, 65, 34, '2021-11-11 10:44:22', 40),
(38, 65, 35, '2021-11-11 10:44:22', 40),
(39, 66, 33, '2021-11-12 09:26:49', 40),
(40, 67, 27, '2021-11-12 19:13:33', 40),
(41, 67, 47, '2021-11-12 19:13:33', 40),
(42, 68, 22, '2021-11-12 19:14:02', 40),
(43, 69, 27, '2021-11-12 19:16:22', 40),
(44, 69, 47, '2021-11-12 19:16:23', 40),
(45, 70, 22, '2021-11-14 06:43:30', 40),
(46, 71, 23, '2021-11-14 13:38:54', 0),
(47, 71, 24, '2021-11-14 13:38:54', 0),
(48, 72, 22, '2021-11-14 13:38:54', 0),
(49, 72, 23, '2021-11-14 13:38:54', 0),
(50, 73, 23, '2021-11-14 13:39:13', 0),
(51, 73, 24, '2021-11-14 13:39:13', 0),
(52, 74, 22, '2021-11-14 13:39:13', 0),
(53, 74, 23, '2021-11-14 13:39:14', 0),
(54, 76, 23, '2021-11-16 23:52:23', 0),
(55, 77, 22, '2021-11-17 08:14:47', 40),
(56, 78, 22, '2021-11-17 08:20:05', 40),
(57, 79, 23, '2021-11-17 08:20:05', 40),
(58, 79, 24, '2021-11-17 08:20:05', 40),
(59, 80, 22, '2021-11-17 13:01:53', 0),
(60, 80, 23, '2021-11-17 13:01:53', 0),
(61, 80, 24, '2021-11-17 13:01:53', 0),
(62, 81, 23, '2021-11-17 13:01:53', 0),
(63, 83, 23, '2021-11-17 14:44:19', 40),
(64, 83, 24, '2021-11-17 14:44:19', 40),
(65, 84, 23, '2021-11-17 14:44:20', 40),
(66, 85, 23, '2021-11-17 14:44:20', 40),
(67, 86, 27, '2021-11-17 14:50:31', 40),
(68, 86, 47, '2021-11-17 14:50:31', 40),
(69, 87, 23, '2021-11-18 09:33:13', 47),
(70, 87, 24, '2021-11-18 09:33:13', 47),
(71, 88, 23, '2021-11-18 09:33:13', 47),
(72, 88, 24, '2021-11-18 09:33:13', 47),
(73, 89, 27, '2021-11-18 13:24:36', 40),
(74, 91, 33, '2021-11-19 10:42:42', 40),
(75, 91, 34, '2021-11-19 10:42:42', 40),
(76, 91, 35, '2021-11-19 10:42:42', 40),
(77, 92, 23, '2021-11-20 11:08:11', 40),
(78, 93, 22, '2021-11-21 10:42:54', 40),
(79, 95, 23, '2021-11-22 13:18:13', 40),
(80, 98, 54, '2021-11-22 13:37:27', 40),
(81, 99, 23, '2021-11-22 13:41:32', 40),
(82, 100, 27, '2021-11-23 06:12:00', 40),
(83, 100, 48, '2021-11-23 06:12:00', 40),
(84, 101, 49, '2021-11-23 06:12:00', 40),
(85, 101, 50, '2021-11-23 06:12:00', 40),
(86, 102, 22, '2021-11-23 10:43:21', 40),
(87, 103, 33, '2021-11-23 10:47:59', 40),
(88, 103, 34, '2021-11-23 10:48:00', 40),
(89, 103, 35, '2021-11-23 10:48:00', 40),
(90, 104, 42, '2021-11-23 10:50:19', 40),
(91, 104, 43, '2021-11-23 10:50:19', 40),
(92, 104, 44, '2021-11-23 10:50:19', 40),
(93, 105, 37, '2021-11-23 10:57:46', 40),
(94, 105, 38, '2021-11-23 10:57:46', 40),
(95, 105, 40, '2021-11-23 10:57:46', 40),
(96, 106, 40, '2021-11-23 10:57:47', 40),
(97, 106, 39, '2021-11-23 10:57:47', 40),
(98, 106, 41, '2021-11-23 10:57:47', 40),
(99, 107, 51, '2021-11-23 11:53:15', 0),
(100, 107, 52, '2021-11-23 11:53:15', 0),
(101, 108, 23, '2021-11-26 11:28:08', 47),
(102, 108, 24, '2021-11-26 11:28:09', 47),
(103, 109, 23, '2021-11-26 11:28:09', 47),
(104, 109, 24, '2021-11-26 11:28:09', 47),
(105, 111, 27, '2021-11-27 10:03:22', 40),
(106, 112, 22, '2021-11-27 11:09:06', 40),
(107, 114, 23, '2021-11-27 12:18:53', 40),
(108, 114, 24, '2021-11-27 12:18:53', 40),
(109, 115, 23, '2021-11-27 12:20:44', 40),
(110, 116, 23, '2021-11-27 13:54:31', 40),
(111, 116, 24, '2021-11-27 13:54:31', 40),
(112, 117, 23, '2021-11-27 15:19:46', 40),
(113, 118, 23, '2021-11-27 17:12:34', 40),
(114, 119, 22, '2021-11-27 17:12:35', 40),
(115, 120, 54, '2021-11-28 06:48:41', 47),
(116, 121, 51, '2021-11-28 06:48:41', 47),
(117, 121, 52, '2021-11-28 06:48:41', 47),
(118, 121, 53, '2021-11-28 06:48:42', 47),
(119, 123, 24, '2021-11-28 11:25:35', 40),
(120, 123, 23, '2021-11-28 11:25:36', 40),
(121, 124, 23, '2021-11-28 11:27:16', 40),
(122, 124, 24, '2021-11-28 11:27:16', 40),
(123, 125, 23, '2021-11-28 11:30:58', 40),
(124, 125, 24, '2021-11-28 11:30:59', 40),
(125, 126, 24, '2021-11-28 11:32:05', 40),
(126, 126, 23, '2021-11-28 11:32:05', 40),
(127, 127, 23, '2021-11-28 11:33:11', 40),
(128, 128, 23, '2021-11-28 11:35:29', 40),
(129, 128, 24, '2021-11-28 11:35:29', 40),
(130, 130, 54, '2021-11-28 12:55:55', 47),
(131, 131, 51, '2021-11-28 12:57:46', 47),
(132, 131, 52, '2021-11-28 12:57:46', 47),
(133, 131, 53, '2021-11-28 12:57:46', 47),
(134, 132, 51, '2021-11-28 12:57:46', 47),
(135, 132, 52, '2021-11-28 12:57:46', 47),
(136, 132, 53, '2021-11-28 12:57:47', 47),
(137, 133, 37, '2021-11-29 13:57:33', 40),
(138, 133, 38, '2021-11-29 13:57:33', 40),
(139, 133, 40, '2021-11-29 13:57:33', 40),
(140, 134, 23, '2021-12-04 06:13:59', 47),
(141, 135, 23, '2021-12-29 10:17:54', 0),
(142, 136, 27, '2022-01-03 10:41:16', 22),
(143, 136, 48, '2022-01-03 10:41:16', 22),
(144, 137, 23, '2022-01-03 10:42:16', 22);

-- --------------------------------------------------------

--
-- Table structure for table `order_steps`
--

CREATE TABLE `order_steps` (
  `id` int(11) NOT NULL,
  `step_name_en` varchar(500) NOT NULL,
  `step_name_ar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_steps`
--

INSERT INTO `order_steps` (`id`, `step_name_en`, `step_name_ar`) VALUES
(1, 'waiting', 'انتظار'),
(2, 'in-process', 'بالمبطخ'),
(3, 'rejected', 'رفض'),
(4, 'on-deleviry', 'توصيل'),
(5, 'finish', 'تم توصيله'),
(6, 'not-finish', 'رفض الاستلام');

-- --------------------------------------------------------

--
-- Table structure for table `order_steps_log`
--

CREATE TABLE `order_steps_log` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `restaurant_note` varchar(5000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `done_at` timestamp NULL DEFAULT NULL,
  `done_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_steps_log`
--

INSERT INTO `order_steps_log` (`id`, `order_id`, `step_id`, `restaurant_note`, `created_at`, `created_by`, `done_at`, `done_by`) VALUES
(1, 69, 1, NULL, '2021-11-08 15:00:18', 40, NULL, NULL),
(2, 70, 1, NULL, '2021-11-09 07:31:53', 40, NULL, NULL),
(3, 71, 1, NULL, '2021-11-09 07:33:26', 40, NULL, NULL),
(4, 72, 1, NULL, '2021-11-09 18:37:51', 40, NULL, NULL),
(5, 73, 1, NULL, '2021-11-09 19:27:32', 40, NULL, NULL),
(6, 74, 1, NULL, '2021-11-09 20:50:21', 40, NULL, NULL),
(7, 75, 1, NULL, '2021-11-09 20:52:13', 40, NULL, NULL),
(8, 76, 1, NULL, '2021-11-09 21:26:48', 40, NULL, NULL),
(9, 77, 1, NULL, '2021-11-09 21:27:44', 40, NULL, NULL),
(10, 78, 1, NULL, '2021-11-09 21:43:54', 40, NULL, NULL),
(11, 79, 1, NULL, '2021-11-09 22:08:44', 40, NULL, NULL),
(12, 80, 1, NULL, '2021-11-09 22:11:07', 40, NULL, NULL),
(13, 81, 1, NULL, '2021-11-10 05:35:52', 40, NULL, NULL),
(14, 82, 1, NULL, '2021-11-10 05:44:38', 40, NULL, NULL),
(15, 83, 1, NULL, '2021-11-10 06:00:35', 40, NULL, NULL),
(16, 84, 1, NULL, '2021-11-10 06:01:33', 40, NULL, NULL),
(17, 85, 1, NULL, '2021-11-10 06:03:36', 40, NULL, NULL),
(18, 86, 1, NULL, '2021-11-10 08:13:02', 40, NULL, NULL),
(19, 87, 1, NULL, '2021-11-10 08:21:31', 40, NULL, NULL),
(20, 88, 1, NULL, '2021-11-11 08:59:02', 40, NULL, NULL),
(21, 89, 1, NULL, '2021-11-11 10:24:59', 40, NULL, NULL),
(22, 90, 1, NULL, '2021-11-11 10:34:30', 40, NULL, NULL),
(23, 91, 1, NULL, '2021-11-11 10:44:21', 40, NULL, NULL),
(24, 92, 1, NULL, '2021-11-12 09:26:49', 40, NULL, NULL),
(25, 93, 1, NULL, '2021-11-12 19:13:33', 40, NULL, NULL),
(26, 94, 1, NULL, '2021-11-12 19:14:02', 40, NULL, NULL),
(27, 95, 1, NULL, '2021-11-12 19:16:21', 40, NULL, NULL),
(28, 96, 1, NULL, '2021-11-14 06:43:30', 40, NULL, NULL),
(35, 103, 1, NULL, '2021-11-14 13:38:54', 25, NULL, NULL),
(36, 104, 1, NULL, '2021-11-14 13:39:13', 25, NULL, NULL),
(37, 105, 1, NULL, '2021-11-16 23:52:23', 25, NULL, NULL),
(38, 106, 1, NULL, '2021-11-17 08:14:47', 40, NULL, NULL),
(39, 107, 1, NULL, '2021-11-17 08:20:05', 40, NULL, NULL),
(40, 108, 1, NULL, '2021-11-17 13:01:53', 25, NULL, NULL),
(41, 109, 1, NULL, '2021-11-17 14:44:19', 40, NULL, NULL),
(42, 110, 1, NULL, '2021-11-17 14:50:31', 40, NULL, NULL),
(43, 111, 1, NULL, '2021-11-18 09:33:12', 47, NULL, NULL),
(44, 112, 1, NULL, '2021-11-18 13:24:36', 40, NULL, NULL),
(45, 113, 1, NULL, '2021-11-18 13:24:55', 40, NULL, NULL),
(46, 114, 1, NULL, '2021-11-19 10:42:41', 40, NULL, NULL),
(47, 115, 1, NULL, '2021-11-20 11:08:11', 40, NULL, NULL),
(48, 116, 1, NULL, '2021-11-21 10:42:53', 40, NULL, NULL),
(49, 117, 1, NULL, '2021-11-21 14:59:41', 40, NULL, NULL),
(50, 118, 1, NULL, '2021-11-22 13:18:13', 40, NULL, NULL),
(51, 119, 1, NULL, '2021-11-22 13:37:27', 40, NULL, NULL),
(52, 120, 1, NULL, '2021-11-22 13:41:32', 40, NULL, NULL),
(53, 121, 1, NULL, '2021-11-23 06:11:59', 40, NULL, NULL),
(54, 122, 1, NULL, '2021-11-23 10:43:20', 40, NULL, NULL),
(55, 123, 1, NULL, '2021-11-23 10:47:59', 40, NULL, NULL),
(56, 124, 1, NULL, '2021-11-23 10:50:18', 40, NULL, NULL),
(57, 125, 1, NULL, '2021-11-23 10:57:46', 40, NULL, NULL),
(58, 126, 1, NULL, '2021-11-23 11:53:15', 47, NULL, NULL),
(59, 127, 1, NULL, '2021-11-26 11:28:08', 47, NULL, NULL),
(60, 128, 1, NULL, '2021-11-27 09:43:17', 40, NULL, NULL),
(61, 129, 1, NULL, '2021-11-27 10:03:22', 40, NULL, NULL),
(62, 133, 1, NULL, '2021-11-27 11:09:06', 40, NULL, NULL),
(63, 134, 1, NULL, '2021-11-27 12:18:53', 40, NULL, NULL),
(64, 135, 1, NULL, '2021-11-27 12:20:44', 40, NULL, NULL),
(65, 136, 1, NULL, '2021-11-27 13:54:30', 40, NULL, NULL),
(66, 137, 1, NULL, '2021-11-27 15:19:45', 40, NULL, NULL),
(67, 138, 1, NULL, '2021-11-27 17:12:34', 40, NULL, NULL),
(68, 139, 1, NULL, '2021-11-28 06:48:41', 47, NULL, NULL),
(69, 140, 1, NULL, '2021-11-28 11:24:36', 40, NULL, NULL),
(70, 141, 1, NULL, '2021-11-28 11:25:35', 40, NULL, NULL),
(71, 142, 1, NULL, '2021-11-28 11:27:16', 40, NULL, NULL),
(72, 143, 1, NULL, '2021-11-28 11:30:58', 40, NULL, NULL),
(73, 144, 1, NULL, '2021-11-28 11:32:05', 40, NULL, NULL),
(74, 145, 1, NULL, '2021-11-28 11:33:11', 40, NULL, NULL),
(75, 146, 1, NULL, '2021-11-28 11:35:28', 40, NULL, NULL),
(76, 147, 1, NULL, '2021-11-28 12:53:00', 40, NULL, NULL),
(77, 148, 1, NULL, '2021-11-28 12:55:55', 47, NULL, NULL),
(78, 149, 1, NULL, '2021-11-28 12:57:46', 47, NULL, NULL),
(79, 150, 1, NULL, '2021-11-29 13:57:33', 40, NULL, NULL),
(80, 151, 1, NULL, '2021-12-04 06:13:59', 47, NULL, NULL),
(81, 152, 1, NULL, '2021-12-29 10:17:54', 25, NULL, NULL),
(82, 153, 1, NULL, '2022-01-03 10:41:15', 22, NULL, NULL),
(83, 154, 1, NULL, '2022-01-03 10:42:16', 22, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_user_subscriptions`
--

CREATE TABLE `order_user_subscriptions` (
  `id` bigint(11) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `tracking_id` varchar(255) DEFAULT NULL,
  `bank_ref_no` varchar(255) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `failure_message` varchar(255) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `card_name` varchar(255) DEFAULT NULL,
  `status_code` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `billing_name` mediumtext DEFAULT NULL,
  `billing_address` mediumtext DEFAULT NULL,
  `billing_city` mediumtext DEFAULT NULL,
  `billing_state` mediumtext DEFAULT NULL,
  `billing_zip` mediumtext DEFAULT NULL,
  `billing_country` mediumtext DEFAULT NULL,
  `billing_tel` mediumtext DEFAULT NULL,
  `billing_email` mediumtext DEFAULT NULL,
  `delivery_name` mediumtext DEFAULT NULL,
  `delivery_address` mediumtext DEFAULT NULL,
  `delivery_city` mediumtext DEFAULT NULL,
  `delivery_state` mediumtext DEFAULT NULL,
  `delivery_zip` mediumtext DEFAULT NULL,
  `delivery_country` mediumtext DEFAULT NULL,
  `delivery_tel` mediumtext DEFAULT NULL,
  `merchant_param1` mediumtext DEFAULT NULL,
  `merchant_param2` mediumtext DEFAULT NULL,
  `merchant_param3` mediumtext DEFAULT NULL,
  `merchant_param4` mediumtext DEFAULT NULL,
  `merchant_param5` mediumtext DEFAULT NULL,
  `vault` mediumtext DEFAULT NULL,
  `offer_type` mediumtext DEFAULT NULL,
  `offer_code` mediumtext DEFAULT NULL,
  `discount_value` mediumtext DEFAULT NULL,
  `mer_amount` mediumtext DEFAULT NULL,
  `eci_value` mediumtext DEFAULT NULL,
  `card_holder_name` mediumtext DEFAULT NULL,
  `bank_qsi_no` mediumtext DEFAULT NULL,
  `bank_receipt_no` mediumtext DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `user_order_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `account_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone_number` varchar(150) NOT NULL,
  `national_number` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `account_name`, `email`, `phone_number`, `national_number`, `created_at`, `updated_at`) VALUES
(57, 'owner1', 'owner@gmail.com', '023456789', '748-1934-2342343-2', '2021-08-31 05:37:59', '2022-01-19 11:50:07'),
(58, 'mohammad', 'owner1@gmail.com', '00971 55 334 3453', '342-3536-4567556-3', '2021-10-16 16:59:43', '2021-10-16 16:59:43'),
(59, 'Shah Ahmed', 'arcadiustest513@gmail.com', '00971 54 911 4062', '784-1994-2577782-6', '2021-10-17 10:30:06', '2021-10-17 10:30:06'),
(60, 'الشيخ زايد', 'owner@gmail.com', '00971 55 523 4234', '342-3536-4567556-3', '2021-10-18 20:06:30', '2021-10-18 20:06:30'),
(61, 'owner1', 'thedoctorsOwner@gmail.com', '00971 55 342 4354', '223-4435-2342342-3', '2021-10-18 22:15:44', '2021-10-18 22:15:44'),
(62, 'ali', 'technosharjah101@gmail.com', '00971 52 505 7249', '121-3323-2323332-3', '2021-11-22 13:11:36', '2021-11-22 13:11:36'),
(63, 'Test Vendor', 'allin1uaetraining@gmail.com', '00971 58 199 4514', '784-6253-6718936-7', '2021-11-29 13:38:46', '2021-11-29 13:38:46'),
(64, 'Ahmad alarfaj', 'amedalkl@hotmail.com', '00971 56 312 0205', '784-1996-7506420-0', '2021-12-14 18:02:11', '2021-12-14 18:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `allowed_meals` int(10) NOT NULL,
  `duration` int(10) NOT NULL,
  `cost` int(200) NOT NULL,
  `free_delivery` tinyint(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `allowed_meals`, `duration`, `cost`, `free_delivery`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(15, 'golden', 15, 15, 1500, 1, 1, '2021-09-02 06:13:17', '2021-09-21 15:36:00', '2021-09-21 15:36:00'),
(16, 'new package', 50, 12, 1200, 0, 1, '2021-09-02 06:13:33', '2021-09-21 15:36:37', '2021-10-19 11:52:53'),
(17, 'Platinum', 10000, 12, 1999, 0, 2, '2021-09-21 11:00:33', '2021-09-21 16:52:00', '2021-09-21 16:52:00'),
(18, 'Gold', 99, 12, 1499, 0, 3, '2021-09-21 11:01:08', '2021-09-21 16:52:03', '2021-09-21 16:52:03'),
(19, 'Silver', 49, 12, 999, 0, 4, '2021-09-21 11:01:46', '2021-09-21 16:51:56', '2021-09-21 16:51:56'),
(20, 'Platinum (Restaurant)', 10000, 12, 1999, 0, 4, '2021-09-21 16:53:11', '2021-09-22 10:33:13', '2021-10-19 11:54:57'),
(21, 'Platinum (Beverages)', 10000, 12, 1999, 0, 1, '2021-09-21 16:53:50', '2021-09-22 10:33:08', '2021-10-05 11:52:49'),
(22, 'Platinum (Cafeteria)', 10000, 12, 1999, 0, 2, '2021-09-21 16:54:27', '2021-09-22 10:34:15', '2021-10-12 11:54:07'),
(23, 'Platinum (Bakery & Cakes)', 100000, 12, 1999, 0, 3, '2021-09-21 16:55:25', '2021-10-23 14:35:29', NULL),
(24, 'Platinum (Vegan & Vegetarian)', 10000, 12, 1999, 0, 3, '2021-09-21 16:56:08', '2021-09-22 10:33:49', '2021-10-24 11:53:39'),
(25, 'Gold (Bakery & Cakes)', 99, 12, 1499, 0, 3, '2021-09-21 16:59:50', '2021-10-23 14:35:49', NULL),
(26, 'Gold (Beverages)', 99, 12, 1499, 0, 1, '2021-09-21 17:00:14', '2021-09-22 10:33:28', '2021-10-18 11:52:46'),
(27, 'Gold (Cafeteria)', 99, 12, 365, 0, 2, '2021-09-21 17:00:49', '2021-09-22 10:33:00', '2021-10-03 11:54:03'),
(28, 'Gold (Restaurant)', 99, 12, 1499, 0, 4, '2021-09-21 17:01:12', '2021-09-22 10:33:37', '2021-10-10 11:54:54'),
(29, 'Gold (Vegan & Vegetarian)', 99, 12, 1499, 0, 3, '2021-09-21 17:28:26', '2021-09-22 10:33:04', '2021-10-18 11:53:36'),
(30, 'Silver (Bakery & Cakes)', 49, 12, 999, 0, 3, '2021-09-21 17:29:07', '2021-10-23 14:37:08', NULL),
(31, 'Silver (Beverages)', 49, 12, 999, 0, 1, '2021-09-21 17:29:59', '2021-09-22 10:34:32', '2021-10-12 11:52:40'),
(32, 'Silver (Cafeteria)', 49, 12, 999, 0, 2, '2021-09-21 17:30:55', '2021-09-22 10:34:28', '2021-10-18 11:54:00'),
(33, 'Silver (Restaurant)', 49, 12, 999, 0, 4, '2021-09-21 17:31:22', '2021-09-22 10:34:24', '2021-10-12 11:54:51'),
(34, 'Silver (Vegan & Vegetarian)', 49, 12, 999, 0, 3, '2021-09-21 17:31:49', '2021-09-22 10:34:20', '2021-10-11 11:53:31'),
(35, 'Silver (Vegan & Vegetarian)', 49, 12, 999, 0, 1, '2021-09-22 10:37:46', '2021-09-22 10:37:46', NULL),
(36, 'Silver (Cafe)', 49, 12, 999, 0, 2, '2021-09-22 10:38:31', '2021-09-22 10:38:31', NULL),
(37, 'Silver (Beverages)', 49, 12, 999, 0, 6, '2021-09-22 10:39:03', '2021-10-23 14:47:42', NULL),
(38, 'Silver (Restaurant)', 49, 12, 999, 0, 4, '2021-09-22 10:39:34', '2021-09-22 10:39:34', NULL),
(39, 'Silver (Bakery & Cakes)', 49, 12, 999, 0, 5, '2021-09-22 10:40:21', '2021-10-23 14:37:41', '2021-10-23 14:37:41'),
(40, 'Gold (Restaurant)', 99, 12, 1499, 0, 4, '2021-09-22 10:41:47', '2021-09-22 10:41:47', NULL),
(41, 'Gold (Cafe)', 99, 12, 1499, 0, 2, '2021-09-22 10:42:39', '2021-09-23 20:51:26', NULL),
(42, 'Gold (Vegan & Vegetarian)', 99, 12, 1499, 0, 1, '2021-09-22 10:43:22', '2021-09-22 10:43:22', NULL),
(43, 'Gold (Beverages)', 99, 12, 1499, 0, 6, '2021-09-22 10:44:05', '2021-10-23 14:47:19', NULL),
(44, 'Gold (Bakery & Cakes)', 99, 12, 1499, 0, 5, '2021-09-22 10:44:40', '2021-10-23 14:36:27', '2021-10-23 14:36:27'),
(45, 'Platinum (Vegan & Vegetarian)', 100000, 12, 1999, 0, 1, '2021-09-22 10:48:04', '2021-09-22 15:36:05', NULL),
(46, 'Platinum (Cafe)', 100000, 12, 1999, 0, 2, '2021-09-22 10:48:45', '2021-09-22 10:48:45', NULL),
(47, 'Platinum (Beverages)', 100000, 12, 1999, 0, 6, '2021-09-22 10:49:15', '2021-10-23 14:48:05', NULL),
(48, 'Platinum (Restaurant)', 100000, 12, 1999, 0, 4, '2021-09-22 10:49:48', '2021-09-22 10:49:48', NULL),
(49, 'Platinum (Bakery & Cakes)', 100000, 12, 1999, 0, 5, '2021-09-22 10:50:30', '2021-10-23 14:46:31', '2021-10-23 14:46:31'),
(50, 'Silver', 49, 12, 999, 0, 1, '2021-09-22 15:29:12', '2021-09-22 15:47:05', '2021-09-22 15:47:05'),
(51, 'Gold', 99, 12, 1499, 0, 1, '2021-09-22 15:29:41', '2021-09-22 15:34:40', '2021-09-22 15:34:40'),
(52, 'Training Package', 200, 12, 1, 1, 4, '2021-10-05 11:07:53', '2021-11-17 13:17:09', '2021-11-17 13:17:09'),
(53, 'Silver (BBQ & Grills)', 49, 12, 999, 0, 5, '2021-10-23 14:28:10', '2021-11-28 16:53:49', NULL),
(54, 'Gold (BBQ & Grills)', 99, 12, 1499, 0, 5, '2021-10-23 14:29:00', '2021-11-28 16:54:16', NULL),
(55, 'Platinum (BBQ & Grills)', 100000, 12, 1999, 0, 5, '2021-10-23 14:29:41', '2021-10-23 14:29:41', NULL),
(56, 'Silver (Cuisines)', 49, 12, 999, 0, 7, '2021-11-17 13:34:03', '2021-11-28 16:53:13', NULL),
(57, 'Gold (Cuisines)', 99, 12, 1499, 0, 7, '2021-11-17 13:34:31', '2021-11-28 16:52:23', NULL),
(58, 'Platinum (Cuisines)', 100000, 12, 1999, 0, 7, '2021-11-17 13:35:07', '2021-11-28 16:54:34', NULL),
(59, 'Promo Package (UAE Day)', 100000, 12, 99, 0, 1, '2021-11-17 13:36:10', '2021-11-28 16:49:51', '2021-11-28 16:49:51'),
(60, 'Promo Package (UAE Day)', 100000, 12, 99, 0, 2, '2021-11-17 13:40:15', '2021-11-28 16:50:05', '2021-11-28 16:50:05'),
(61, 'Promo Package (UAE Day)', 100000, 12, 99, 0, 3, '2021-11-17 13:41:22', '2021-11-28 16:50:12', '2021-11-28 16:50:12'),
(62, 'Promo Package (UAE Day)', 100000, 12, 99, 0, 4, '2021-11-17 13:42:04', '2021-11-28 16:50:18', '2021-11-28 16:50:18'),
(63, 'Promo Package (UAE Day)', 100000, 12, 99, 0, 5, '2021-11-17 13:42:29', '2021-11-28 16:50:26', '2021-11-28 16:50:26'),
(64, 'Promo Package (UAE Day)', 100000, 12, 99, 0, 6, '2021-11-17 13:42:52', '2021-11-28 16:50:33', '2021-11-28 16:50:33'),
(65, 'Promo Package (UAE Day)', 100000, 12, 99, 0, 7, '2021-11-17 13:43:17', '2021-11-28 16:50:40', '2021-11-28 16:50:40'),
(66, 'Standard (UAE Day)', 49, 12, 0, 0, 3, '2021-11-28 16:51:44', '2021-11-28 16:51:44', NULL),
(67, 'Premium (UAE Day)', 100000, 12, 99, 0, 3, '2021-11-28 16:55:40', '2021-11-28 16:57:52', NULL),
(68, 'Standard (UAE Day)', 49, 12, 0, 0, 5, '2021-11-28 16:56:40', '2021-11-28 16:56:40', NULL),
(69, 'Premium (UAE Day)', 100000, 12, 99, 0, 5, '2021-11-28 16:57:24', '2021-11-28 16:57:24', NULL),
(70, 'Standard (UAE Day)', 49, 12, 0, 0, 6, '2021-11-28 17:02:45', '2021-11-28 17:02:45', NULL),
(71, 'Premium (UAE Day)', 100000, 12, 99, 0, 6, '2021-11-28 17:03:27', '2021-11-28 17:03:27', NULL),
(72, 'Standard (UAE Day)', 49, 12, 0, 0, 2, '2021-11-28 17:04:02', '2021-11-28 17:04:02', NULL),
(73, 'Premium (UAE Day)', 100000, 12, 99, 0, 2, '2021-11-28 17:04:34', '2021-11-28 17:04:34', NULL),
(74, 'Standard (UAE Day)', 49, 12, 0, 0, 7, '2021-11-28 17:05:27', '2021-11-28 17:05:27', NULL),
(75, 'Premium (UAE Day)', 100000, 12, 99, 0, 7, '2021-11-28 17:06:12', '2021-11-28 17:06:12', NULL),
(76, 'Standard (UAE Day)', 49, 12, 0, 0, 4, '2021-11-28 17:06:47', '2021-11-28 17:06:47', NULL),
(77, 'Premium (UAE Day)', 100000, 12, 99, 0, 4, '2021-11-28 17:07:22', '2021-11-28 17:07:22', NULL),
(78, 'Standard (UAE Day)', 49, 12, 0, 0, 1, '2021-11-28 17:07:58', '2021-11-28 17:07:58', NULL),
(79, 'Premium (UAE Day)', 100000, 12, 99, 0, 1, '2021-11-28 17:08:27', '2021-11-28 17:08:27', NULL),
(80, 'test', 12, 12, 0, 1, 1, '2022-01-20 06:53:27', '2022-01-20 06:53:27', NULL),
(81, 'testtoo', 50, 12, 0, 1, 2, '2022-01-20 06:56:13', '2022-01-20 06:56:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parent_sub_category`
--

CREATE TABLE `parent_sub_category` (
  `id` int(11) NOT NULL,
  `parent_name` varchar(500) NOT NULL,
  `parent_name_ar` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parent_sub_category`
--

INSERT INTO `parent_sub_category` (`id`, `parent_name`, `parent_name_ar`, `created_at`) VALUES
(1, 'Foods', 'مأكولات', '2021-09-21 16:01:02'),
(2, 'Drinks', 'مشروبات', '2021-09-21 16:01:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('fireman@gmail.com', '93a05c3076e1668d027c126ff8764441b733d29d', '2021-10-04 13:05:46'),
('fireman@gmail.com', '284fd4d639bb5825135a248038228d880ba97ea9', '2021-10-16 17:51:48'),
('fireman@gmail.com', '6a9996d9f652f91b01284a84c3edc99151944980', '2021-10-18 19:42:20');

-- --------------------------------------------------------

--
-- Table structure for table `payment_log`
--

CREATE TABLE `payment_log` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_amount` double NOT NULL,
  `done` tinyint(1) DEFAULT NULL,
  `done_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_log`
--

INSERT INTO `payment_log` (`id`, `order_id`, `payment_amount`, `done`, `done_date`, `created_at`) VALUES
(1, 69, 54.72, NULL, NULL, '2021-11-08 15:00:18'),
(2, 70, 228, NULL, NULL, '2021-11-09 07:31:53'),
(3, 71, 228, NULL, NULL, '2021-11-09 07:33:26'),
(4, 72, 54.72, NULL, NULL, '2021-11-09 18:37:51'),
(5, 73, 228, NULL, NULL, '2021-11-09 19:27:32'),
(6, 74, 228, NULL, NULL, '2021-11-09 20:50:21'),
(7, 75, 54.72, NULL, NULL, '2021-11-09 20:52:13'),
(8, 76, 54.72, NULL, NULL, '2021-11-09 21:26:48'),
(9, 77, 114, NULL, NULL, '2021-11-09 21:27:44'),
(10, 78, 13.68, NULL, NULL, '2021-11-09 21:43:54'),
(11, 79, 85.5, NULL, NULL, '2021-11-09 22:08:44'),
(12, 80, 114, NULL, NULL, '2021-11-09 22:11:07'),
(13, 81, 114, NULL, NULL, '2021-11-10 05:35:53'),
(14, 82, 228, NULL, NULL, '2021-11-10 05:44:39'),
(15, 83, 1.14, NULL, NULL, '2021-11-10 06:00:35'),
(16, 84, 114, NULL, NULL, '2021-11-10 06:01:34'),
(17, 85, 342, NULL, NULL, '2021-11-10 06:03:37'),
(18, 86, 114, NULL, NULL, '2021-11-10 08:13:02'),
(19, 87, 114, NULL, NULL, '2021-11-10 08:21:31'),
(20, 88, 114, NULL, NULL, '2021-11-11 08:59:02'),
(21, 89, 114, NULL, NULL, '2021-11-11 10:24:59'),
(22, 90, 114, NULL, NULL, '2021-11-11 10:34:30'),
(23, 91, 57, NULL, NULL, '2021-11-11 10:44:21'),
(24, 92, 57, NULL, NULL, '2021-11-12 09:26:49'),
(25, 93, 85.5, NULL, NULL, '2021-11-12 19:13:33'),
(26, 94, 1.14, NULL, NULL, '2021-11-12 19:14:02'),
(27, 95, 85.5, NULL, NULL, '2021-11-12 19:16:22'),
(28, 96, 54.72, NULL, NULL, '2021-11-14 06:43:30'),
(35, 103, 456, NULL, NULL, '2021-11-14 13:38:54'),
(36, 104, 456, NULL, NULL, '2021-11-14 13:39:13'),
(37, 105, 1.14, NULL, NULL, '2021-11-16 23:52:23'),
(38, 106, 54.72, NULL, NULL, '2021-11-17 08:14:47'),
(39, 107, 127.68, NULL, NULL, '2021-11-17 08:20:05'),
(40, 108, 176.84, NULL, NULL, '2021-11-17 13:01:53'),
(41, 109, 397.86, NULL, NULL, '2021-11-17 14:44:19'),
(42, 110, 85.5, NULL, NULL, '2021-11-17 14:50:31'),
(43, 111, 217.14, NULL, NULL, '2021-11-18 09:33:13'),
(44, 112, 228, NULL, NULL, '2021-11-18 13:24:36'),
(45, 113, 54.72, NULL, NULL, '2021-11-18 13:24:55'),
(46, 114, 171, NULL, NULL, '2021-11-19 10:42:41'),
(47, 115, 171, NULL, NULL, '2021-11-20 11:08:11'),
(48, 116, 1.14, NULL, NULL, '2021-11-21 10:42:54'),
(49, 117, 54.72, NULL, NULL, '2021-11-21 14:59:41'),
(50, 118, 54.72, NULL, NULL, '2021-11-22 13:18:13'),
(51, 119, 165.9, NULL, NULL, '2021-11-22 13:37:27'),
(52, 120, 165.9, NULL, NULL, '2021-11-22 13:41:32'),
(53, 121, 165.9, NULL, NULL, '2021-11-23 06:11:59'),
(54, 122, 25.8, NULL, NULL, '2021-11-23 10:43:21'),
(55, 123, 52.5, NULL, NULL, '2021-11-23 10:47:59'),
(56, 124, 105, NULL, NULL, '2021-11-23 10:50:19'),
(57, 125, 315, NULL, NULL, '2021-11-23 10:57:46'),
(58, 126, 52.5, NULL, NULL, '2021-11-23 11:53:15'),
(59, 127, 117.6, NULL, NULL, '2021-11-26 11:28:08'),
(60, 128, 165.9, NULL, NULL, '2021-11-27 09:43:17'),
(61, 129, 105, NULL, NULL, '2021-11-27 10:03:22'),
(62, 133, 12.6, NULL, NULL, '2021-11-27 11:09:06'),
(63, 134, 2.1, NULL, NULL, '2021-11-27 12:18:53'),
(64, 135, 4.2, NULL, NULL, '2021-11-27 12:20:44'),
(65, 136, 105, NULL, NULL, '2021-11-27 13:54:31'),
(66, 137, 4.2, NULL, NULL, '2021-11-27 15:19:45'),
(67, 138, 16.8, NULL, NULL, '2021-11-27 17:12:34'),
(68, 139, 113.4, NULL, NULL, '2021-11-28 06:48:41'),
(69, 140, 210, NULL, NULL, '2021-11-28 11:24:36'),
(70, 141, 165.9, NULL, NULL, '2021-11-28 11:25:35'),
(71, 142, 105, NULL, NULL, '2021-11-28 11:27:16'),
(72, 143, 105, NULL, NULL, '2021-11-28 11:30:58'),
(73, 144, 165.9, NULL, NULL, '2021-11-28 11:32:05'),
(74, 145, 4.2, NULL, NULL, '2021-11-28 11:33:11'),
(75, 146, 105, NULL, NULL, '2021-11-28 11:35:28'),
(76, 147, 25.2, NULL, NULL, '2021-11-28 12:53:00'),
(77, 148, 30.45, NULL, NULL, '2021-11-28 12:55:55'),
(78, 149, 82.95, NULL, NULL, '2021-11-28 12:57:46'),
(79, 150, 105, NULL, NULL, '2021-11-29 13:57:33'),
(80, 151, 1.05, NULL, NULL, '2021-12-04 06:13:59'),
(81, 152, 1.05, NULL, NULL, '2021-12-29 10:17:54'),
(82, 153, 105, NULL, NULL, '2022-01-03 10:41:15'),
(83, 154, 1.05, NULL, NULL, '2022-01-03 10:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `id` int(11) NOT NULL,
  `pay_type_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`id`, `pay_type_name`) VALUES
(1, 'Pay by cash'),
(2, 'Pay online');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'manage privileges', 'manage-privileges', '2021-12-04 21:02:50', '2021-12-04 21:02:50'),
(2, 'create admin', 'create-admin', '2021-12-04 19:08:59', '2021-12-04 19:08:59'),
(3, 'show admins', 'show-admins', '2021-12-04 19:09:12', '2021-12-04 19:09:12'),
(4, 'show offers', 'show-offers', '2021-12-04 19:09:32', '2021-12-04 19:09:32'),
(5, 'show rejected offers', 'show-rejected-offers', '2021-12-04 19:09:38', '2021-12-04 19:09:38'),
(6, 'show approved offers', 'show-approved-offers', '2021-12-04 19:09:58', '2021-12-04 19:09:58'),
(7, 'manage offers', 'manage-offers', '2021-12-04 19:10:12', '2021-12-04 19:10:12'),
(8, 'delete admin', 'delete-admin', '2021-12-04 19:11:10', '2021-12-04 19:11:10'),
(9, 'edit admin', 'edit-admin', '2021-12-04 19:11:16', '2021-12-04 19:11:16'),
(10, 'create package', 'create-package', '2021-12-04 19:15:40', '2021-12-04 19:15:40'),
(11, 'show packages', 'show-packages', '2021-12-04 19:15:48', '2021-12-04 19:15:48'),
(12, 'manage packages', 'manage-packages', '2021-12-04 19:16:09', '2021-12-04 19:16:09'),
(13, 'create category', 'create-category', '2021-12-04 19:16:25', '2021-12-04 19:16:25'),
(14, 'show payments', 'show-payments', '2021-12-04 19:17:10', '2021-12-04 19:17:10'),
(15, 'show restaurants', 'show-restaurants', '2021-12-04 19:18:15', '2021-12-04 19:18:15'),
(16, 'show non approved restaurants', 'show-non-approved-restaurants', '2021-12-04 19:18:23', '2021-12-04 19:18:23'),
(17, 'manage restaurants', 'manage-restaurants', '2021-12-04 19:18:47', '2021-12-04 19:18:47'),
(18, 'show categories', 'show-categories', '2021-12-04 19:26:30', '2021-12-04 19:26:30'),
(19, 'manage categories', 'manage-categories', '2021-12-04 19:27:05', '2021-12-04 19:27:05'),
(20, 'manage tax', 'manage-tax', '2021-12-04 19:27:20', '2021-12-04 19:27:20'),
(21, 'show sub categories', 'show-sub-categories', '2021-12-04 19:27:43', '2021-12-04 19:27:43'),
(22, 'create sub category', 'create-sub-category', '2021-12-04 19:27:53', '2021-12-04 19:27:53'),
(23, 'manage sub categories', 'manage-sub-categories', '2021-12-04 19:28:13', '2021-12-04 19:28:13'),
(24, 'show customers', 'show-customers', '2021-12-05 06:54:09', '2021-12-05 06:54:09'),
(25, 'manage customers', 'manage-customers', '2021-12-05 06:54:17', '2021-12-05 06:54:17'),
(26, 'show articles', 'show-articles', '2021-12-05 06:55:02', '2021-12-05 06:55:02'),
(27, 'create article', 'create-article', '2021-12-05 06:55:12', '2021-12-05 06:55:12'),
(28, 'manage articles', 'manage-articles', '2021-12-05 06:55:35', '2021-12-05 06:55:35'),
(29, 'create sub categories', 'create-sub-categories', '2021-12-05 06:56:16', '2021-12-05 06:56:16'),
(30, 'grant privileges', 'grant-privileges', '2021-12-05 07:06:26', '2021-12-05 07:06:26'),
(31, 'show notifications', 'show-notifications', '2021-12-07 00:37:53', '2021-12-07 00:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(14, 'App\\Models\\Account', 58, 'my-app-token', '8072c6ba78e411ca2bebbe76c2399e4c83aa57f5566324291c8d9cf7cf96f00c', '[\"*\"]', NULL, '2021-09-04 08:11:37', '2021-09-04 08:11:37'),
(15, 'App\\Models\\Account', 58, 'my-app-token', 'd9986d1922fca86360d93456ac7f9822836bebbe74041481ba71d7f888d9f103', '[\"*\"]', NULL, '2021-09-04 08:16:23', '2021-09-04 08:16:23'),
(16, 'App\\Models\\Customer', 2, 'my-app-token', '4aca2dcb90cfab32a13754333f26a72dab79bbf5d8cc7b0129c2c2e1695f4db8', '[\"*\"]', NULL, '2021-09-04 08:19:48', '2021-09-04 08:19:48'),
(17, 'App\\Models\\Customer', 2, 'my-app-token', 'a6338d90252ce22afd923d5258aac75568b6197356edf240fd89f88647bd58c3', '[\"*\"]', NULL, '2021-09-04 08:21:20', '2021-09-04 08:21:20'),
(18, 'App\\Models\\Account', 58, 'my-app-token', '17e9e6705d6263f4d82bd562bf3e543b7ee42487a2287337d1d46c1b213e1393', '[\"*\"]', NULL, '2021-09-05 04:44:36', '2021-09-05 04:44:36'),
(19, 'App\\Models\\Customer', 1, 'my-app-token', '957856f6867a66cfd6b8ec5c77c948b963d59d404dfe9551560b4e33a35a55e8', '[\"*\"]', '2021-09-05 08:37:20', '2021-09-05 07:17:25', '2021-09-05 08:37:20'),
(20, 'App\\Models\\Customer', 1, 'my-app-token', 'a85dbca9afd812b01606b3f5238aee3ca58daf6a96e283b57f8f3e4d5eb0d790', '[\"*\"]', '2021-09-05 10:07:57', '2021-09-05 10:07:44', '2021-09-05 10:07:57'),
(21, 'App\\Models\\Customer', 1, 'my-app-token', 'bb2f31e7768529de132fd2ee2c0fc826d669932bb609d4272c15751b6ddb8a4d', '[\"*\"]', '2021-09-06 05:39:04', '2021-09-06 04:26:10', '2021-09-06 05:39:04'),
(22, 'App\\Models\\Customer', 1, 'my-app-token', '907144d291d939b432a21dc7e03d6c4669cf5e9b703a960e7167d1febe95c993', '[\"*\"]', '2021-09-07 06:17:13', '2021-09-07 06:16:28', '2021-09-07 06:17:13'),
(23, 'App\\Models\\Customer', 1, 'my-app-token', 'fbe3fa4d7c95a232e30a84a2b21c37903e6e5b89c423d572963c2a6528f6b517', '[\"*\"]', '2021-09-07 06:32:38', '2021-09-07 06:17:54', '2021-09-07 06:32:38'),
(24, 'App\\Models\\Customer', 2, 'my-app-token', '590cb3a8696f109c71850425fa07db0f4c0a44be12666b3d424691fd7bd20919', '[\"*\"]', NULL, '2021-09-07 06:34:53', '2021-09-07 06:34:53'),
(25, 'App\\Models\\Customer', 2, 'my-app-token', 'b114ec51dfaf24709d4d9ec4dbebc9d0e966b6e26aed4144782b7474b4672589', '[\"*\"]', '2021-09-07 07:00:44', '2021-09-07 06:35:01', '2021-09-07 07:00:44'),
(26, 'App\\Models\\Customer', 2, 'my-app-token', '81687728da49acfdd1c28d7c9e0715ed1d8fb0b024c046913e1801fe4862b8b7', '[\"*\"]', '2021-09-07 09:27:32', '2021-09-07 07:00:52', '2021-09-07 09:27:32'),
(27, 'App\\Models\\Customer', 2, 'my-app-token', '2d6cc7f541054ded032feaafce84272e50135220894be4a4c88df503338529f3', '[\"*\"]', '2021-09-14 06:24:26', '2021-09-08 09:55:47', '2021-09-14 06:24:26'),
(28, 'App\\Models\\Account', 80, 'auth_token', '80d0944a2c5c85e470916c94506478a16d1547e2470009fae64fc175583af4ee', '[\"*\"]', NULL, '2021-09-10 08:49:32', '2021-09-10 08:49:32'),
(29, 'App\\Models\\Account', 81, 'auth_token', '396492ef5a591d7f4b20522dea22885e6de52272916bee16463a1c26233fec85', '[\"*\"]', NULL, '2021-09-10 08:50:20', '2021-09-10 08:50:20'),
(30, 'App\\Models\\Account', 82, 'auth_token', '3adea225413d7ba678c876aeee6e6e3a08df9dcb1e04830ad0d1d8216a2f6167', '[\"*\"]', NULL, '2021-09-10 08:51:28', '2021-09-10 08:51:28'),
(31, 'App\\Models\\Account', 83, 'auth_token', 'c79ba634e2c45e445185928dd3bec609bb895cccfcd9a2a9b559fa41a5c5cd48', '[\"*\"]', NULL, '2021-09-10 08:53:50', '2021-09-10 08:53:50'),
(32, 'App\\Models\\Account', 85, 'auth_token', 'b6e05055036b1382febb8de68c747ab6d74f91c9a366d264d2bdf5f66603ea81', '[\"*\"]', NULL, '2021-09-10 09:00:05', '2021-09-10 09:00:05'),
(33, 'App\\Models\\Account', 86, 'auth_token', '105eb8cc8113d2939563005e0ac44f8266011a2c19f8ded9caa931290e1834cc', '[\"*\"]', NULL, '2021-09-10 09:03:04', '2021-09-10 09:03:04'),
(34, 'App\\Models\\Account', 87, 'auth_token', '7b157dcc048d23264e8bbdb3cd61dcfe4796e1bc9282a3c5a0474eda1bf07695', '[\"*\"]', NULL, '2021-09-10 11:26:01', '2021-09-10 11:26:01'),
(35, 'App\\Models\\Account', 88, 'auth_token', 'd8b3b5ed416b1a4553beec9d4195325ac40d97ae946c28ba14ae02c8dd8ceea4', '[\"*\"]', NULL, '2021-09-10 11:44:09', '2021-09-10 11:44:09'),
(36, 'App\\Models\\Account', 89, 'auth_token', '778ce4372ed41b538806d3686a2ee9cf9ff58056afef2fa59da80d3c826d8c4d', '[\"*\"]', NULL, '2021-09-10 11:54:30', '2021-09-10 11:54:30'),
(37, 'App\\Models\\Account', 90, 'auth_token', '889737685e4c125090ee07eb875aa0f636bc0f323735258978fb5d516231125a', '[\"*\"]', NULL, '2021-09-10 11:55:26', '2021-09-10 11:55:26'),
(38, 'App\\Models\\Account', 92, 'auth_token', '576878cba4c07ea104cc7771e2411446a1fab9b8cdec87656b67fb7588822ec8', '[\"*\"]', NULL, '2021-09-10 12:09:22', '2021-09-10 12:09:22'),
(39, 'App\\Models\\Account', 109, 'auth_token', 'b9c380dec3ac5a0a1217cf3c4964648c302266d8ae6350d1a9a427fa8dea72b1', '[\"*\"]', NULL, '2021-09-10 12:57:01', '2021-09-10 12:57:01'),
(40, 'App\\Models\\Account', 121, 'auth_token', '685a7709dda13e9caa386e368d9ab43772f692dd15d8343833163472924eaa26', '[\"*\"]', NULL, '2021-09-11 06:02:10', '2021-09-11 06:02:10'),
(41, 'App\\Models\\Account', 122, 'auth_token', 'a98dc916ffcc2734aa2c8f5ea75aab88bff60b95644ca6001dde31e4774b5f88', '[\"*\"]', NULL, '2021-09-11 06:03:41', '2021-09-11 06:03:41'),
(42, 'App\\Models\\Customer', 26, 'my-app-token', '157a4b07fa10d0c3b79ec9cb8cb0af44c16ee421befe5e43f52041260e65d1c1', '[\"*\"]', NULL, '2021-11-05 01:00:58', '2021-11-05 01:00:58'),
(43, 'App\\Models\\Customer', 26, 'my-app-token', '47362d2bd094d6dc755873a1b2da9939a11b8cbee066b3574d0848f06a7e668d', '[\"*\"]', NULL, '2021-11-05 01:03:08', '2021-11-05 01:03:08'),
(44, 'App\\Models\\Customer', 28, 'my-app-token', '612d7c38d43cc77e1f47da210a085254f88976be72e2b66991c987ce45136192', '[\"*\"]', NULL, '2021-11-05 16:38:00', '2021-11-05 16:38:00'),
(45, 'App\\Models\\Customer', 28, 'my-app-token', '86f8c5066acd7eeded0efb8892827ed156f9bda8be5d0c4ce960273de8f7a344', '[\"*\"]', NULL, '2021-11-05 18:13:57', '2021-11-05 18:13:57'),
(46, 'App\\Models\\Customer', 35, 'my-app-token', 'df9f9edc77f8b67b395bce0666c776ba5583da1c06fb326c7df071649523db13', '[\"*\"]', NULL, '2021-11-05 18:24:37', '2021-11-05 18:24:37'),
(47, 'App\\Models\\Customer', 35, 'my-app-token', '5488ebcd88c59dc5688d580ea9f297a01b137b99c42ad34cbce76c36f77cc47b', '[\"*\"]', NULL, '2021-11-08 12:07:50', '2021-11-08 12:07:50'),
(48, 'App\\Models\\Customer', 39, 'my-app-token', '80461309e39d5c5f046d211de9887a7d1baac7723ebe5f4766e3ca6107d9a1e2', '[\"*\"]', NULL, '2021-11-08 12:42:26', '2021-11-08 12:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_sub_category`
--

CREATE TABLE `restaurant_sub_category` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `image_path` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurant_sub_category`
--

INSERT INTO `restaurant_sub_category` (`id`, `restaurant_id`, `sub_category_id`, `image_path`, `created_at`, `updated_at`) VALUES
(74, 61, 2, NULL, '2021-08-20 12:39:40', NULL),
(75, 58, 3, NULL, '2021-10-30 11:02:13', NULL),
(76, 62, 2, NULL, '2021-09-02 12:01:30', NULL),
(77, 58, 4, '1634630353.png', '2021-09-15 08:31:07', NULL),
(78, 128, 7, NULL, '2021-09-22 07:56:15', NULL),
(79, 128, 2, NULL, '2021-09-22 08:03:41', NULL),
(80, 130, 1, NULL, '2021-09-27 14:08:13', NULL),
(84, 144, 20, NULL, '2021-10-04 06:23:13', NULL),
(85, 144, 21, NULL, '2021-10-04 06:23:13', NULL),
(86, 145, 6, NULL, '2021-10-05 08:29:50', NULL),
(87, 145, 7, NULL, '2021-10-05 08:29:50', NULL),
(88, 151, 11, '1640092540.jpg', '2021-10-17 06:29:04', NULL),
(89, 133, 4, NULL, '2021-10-18 16:37:26', NULL),
(90, 133, 7, NULL, '2021-10-18 16:37:27', NULL),
(91, 153, 4, NULL, '2021-10-18 18:15:25', NULL),
(92, 153, 6, NULL, '2021-10-18 18:15:25', NULL),
(93, 131, 1, '1634630233.jpg', '2021-10-19 07:35:57', NULL),
(94, 131, 2, NULL, '2021-10-19 07:35:57', NULL),
(95, 158, 1, '1637578872.jpg', '2021-11-22 08:10:57', NULL),
(96, 158, 2, '1637578885.jpg', '2021-11-22 08:10:57', NULL),
(97, 158, 3, '1637578899.jpg', '2021-11-22 08:10:57', NULL),
(98, 158, 4, '1637578911.jpg', '2021-11-22 08:10:57', NULL),
(99, 158, 6, '1637578922.jpg', '2021-11-22 08:10:57', NULL),
(100, 158, 7, '1637578931.jpg', '2021-11-22 08:10:57', NULL),
(101, 162, 4, NULL, '2021-11-29 08:37:17', NULL),
(102, 163, 24, NULL, '2021-12-14 12:54:49', NULL),
(103, 58, 20, NULL, '2022-01-05 19:25:26', NULL),
(104, 58, 21, NULL, '2022-01-05 19:25:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'super-admin', '2021-12-04 21:02:09', NULL),
(2, 'supervisor', 'supervisor', '2021-12-05 08:01:53', '2021-12-05 08:01:53'),
(3, 'Manger', 'manger', '2021-12-11 12:45:44', '2021-12-11 12:45:44'),
(4, 'Staff', 'staff', '2021-12-11 12:46:41', '2021-12-11 12:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(2, 3),
(2, 9),
(2, 24),
(2, 26),
(2, 27),
(2, 28),
(2, 30),
(3, 1),
(3, 2),
(4, 13),
(4, 17),
(4, 20);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'tester', 'LY4PHZ', '2021-08-12 04:33:51', '2021-08-14 17:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `sub_category_name` varchar(500) NOT NULL,
  `sub_category_name_ar` varchar(500) NOT NULL,
  `main_photo` varchar(500) NOT NULL,
  `parent_cat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `sub_category_name`, `sub_category_name_ar`, `main_photo`, `parent_cat_id`, `created_at`, `updated_at`) VALUES
(1, 'chinese', 'صيني', 'Chinese.jpeg', 1, '2021-08-03 22:53:44', '2021-12-04 11:19:06'),
(2, 'Italian', 'إيطالي', 'Italian.jpg', 1, '2021-08-03 22:53:44', '2021-12-04 11:19:36'),
(3, 'Mandi', 'مندي', 'Mandi.jpg', 1, '2021-08-03 22:53:44', '2021-12-04 11:20:48'),
(4, 'Arabian', 'عربي', 'Arabian.jpeg', 1, '2021-08-22 08:21:03', '2021-12-04 11:21:13'),
(6, 'American', 'أمريكي', 'American.jpg', 1, '2021-09-16 11:31:05', '2021-12-04 11:20:01'),
(7, 'Pizza', 'بيتزا', 'Screenshot 2021-10-17 114559.png', 1, '2021-09-16 11:33:22', '2021-10-23 15:08:43'),
(8, 'Biryani', 'برياني', 'Screenshot 2021-10-23 150724.png', 1, '2021-09-21 13:28:11', '2021-10-23 15:09:51'),
(9, 'Iranian', 'إيراني', 'Iranian.png', 1, '2021-09-25 08:27:05', '2021-09-25 08:27:05'),
(10, 'Lebanese', 'لبناني', 'lebanese .png', 1, '2021-09-25 08:31:39', '2021-09-25 08:31:39'),
(11, 'Pakistani', 'باكستاني', 'Pakistani.png', 1, '2021-09-25 08:36:40', '2021-09-25 08:36:40'),
(12, 'Nepalese', 'نيبالي', 'Nepal.png', 1, '2021-09-25 08:40:00', '2021-09-25 08:40:00'),
(13, 'Egyptian', 'مصري', 'Egyptian.png', 1, '2021-09-25 08:46:21', '2021-09-25 08:46:21'),
(14, 'North Indian', 'شمال الهند', 'Screenshot 2021-09-25 114921.png', 1, '2021-09-25 08:49:59', '2021-09-25 08:49:59'),
(15, 'South Indian', 'جنوب الهند', 'Screenshot 2021-09-25 114839.png', 1, '2021-09-25 08:52:17', '2021-09-25 08:52:17'),
(16, 'Burger & Pizza', 'برجر وبيتزا', 'burger and pizza .png', 1, '2021-09-25 08:56:15', '2021-10-04 07:46:01'),
(17, 'BBQ & Grills', 'مشاوي و باربيكيو', 'Screenshot 2021-10-04 094730.png', 1, '2021-10-04 06:48:31', '2021-10-04 06:57:44'),
(18, 'Breakfast', 'إفطار', 'Screenshot 2021-10-04 100141.png', 1, '2021-10-04 07:02:07', '2021-10-04 07:02:07'),
(19, 'Shrimps & Seafood', 'جمبري و مأكولات بحرية', 'shrimps.png', 1, '2021-10-04 07:10:12', '2021-10-04 07:10:12'),
(20, 'Shakes & Smoothies', 'شيكس آند سموذي', 'milkshakes.png', 2, '2021-10-04 07:17:45', '2021-10-04 07:25:48'),
(21, 'Fresh Juice', 'عصير طازج', 'juice 2.png', 2, '2021-10-04 07:22:13', '2021-10-04 07:22:13'),
(22, 'Fast-food', 'الوجبات السريعة', 'fast.png', 1, '2021-10-04 07:31:05', '2021-10-04 07:31:05'),
(23, 'Desserts & Appetizers', 'حلويات ومقبلات', 'desserts 2.png', 1, '2021-10-04 07:38:35', '2021-10-04 07:38:35'),
(24, 'Shawarma & Sandwiches', 'شاورما و سندويشات', 'shawarma .png', 1, '2021-10-04 07:42:35', '2021-10-04 07:42:35'),
(25, 'Pasta & Noodles', 'المعكرونة والنودلز', 'pasta.png', 1, '2021-10-04 07:59:26', '2021-10-04 07:59:26'),
(26, 'Salad', 'سلطة', 'salad.png', 1, '2021-10-04 08:03:44', '2021-10-04 08:03:44'),
(27, 'Tea | Coffee', 'الشاي | قهوة', 'Screenshot 2021-10-23 151528.png', 2, '2021-10-23 15:15:39', '2021-10-23 15:15:39'),
(28, 'Beverages', 'المشروبات', 'Beverages .jpg', 2, '2021-12-16 15:50:25', '2021-12-16 15:50:25'),
(29, 'Breakfast Food', 'طعام الإفطار', 'Breakfast food .jpg', 1, '2021-12-16 15:52:01', '2021-12-16 15:52:01'),
(30, 'Fruits & Vegetables', 'الفواكه والخضروات', 'Fruits & Vegetables.jpg', 1, '2021-12-16 15:53:36', '2021-12-16 15:53:36'),
(31, 'Meat & Seafood', 'اللحوم والمأكولات البحرية', 'Meat & Seafood .jpg', 1, '2021-12-16 15:55:13', '2021-12-16 15:55:13'),
(32, 'Chocolate & Snacks', 'الشوكولاته والوجبات الخفيفة', 'Chocolate & Snacks .jpg', 1, '2021-12-16 15:56:20', '2021-12-16 15:56:20'),
(33, 'Pet food', 'أغذية الحيوانات الأليفة', 'Pet Food.jpg', 1, '2021-12-16 15:58:30', '2021-12-16 15:58:30'),
(34, 'Dairy, Milk & Eggs', 'الألبان والحليب والبيض', 'Dairy Milk & Eggs.jpg', 1, '2021-12-16 16:00:37', '2021-12-16 16:00:37'),
(35, 'Bread & Bakery', 'الخبز والمخابز', 'Bread & Bakery.jpg', 1, '2021-12-16 16:02:17', '2021-12-16 16:02:17'),
(36, 'Food Cupboard', 'خزانة الطعام', 'Food Cupboard .jpg', 1, '2021-12-16 16:03:34', '2021-12-16 16:03:34'),
(37, 'Frozen Food', 'الأغذية المجمدة', 'Frozen Food.jpg', 1, '2021-12-16 16:13:51', '2021-12-16 16:13:51'),
(38, 'Bio & Organic Food', 'الحيوي والأغذية العضوية', 'Bio & Organic Food.jpg', 1, '2021-12-16 16:15:05', '2021-12-16 16:15:05'),
(39, 'Fresh Food', 'الأغذية الطازجة', 'Fresh Food.jpg', 1, '2021-12-16 16:16:00', '2021-12-16 16:16:00'),
(40, 'Packaged & Canned Food', 'الأغذية المعلبة', 'Packaged & Canned Food.jpg', 1, '2021-12-16 16:17:43', '2021-12-16 16:17:43'),
(41, 'Water small', 'قنينة مي', 'istockphoto-185072125-170667a.jpeg', 2, '2022-01-03 17:46:15', '2022-01-03 17:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(11) NOT NULL,
  `tax_value` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `tax_value`, `currency_id`, `status_id`, `created_at`, `created_by`) VALUES
(1, 12, 1, 2, '2021-10-11 13:30:46', 60),
(2, 14, 1, 2, '2021-10-11 13:34:47', 60),
(3, 5, 1, 1, '2021-11-20 13:49:22', 60),
(4, 5, 2, 1, '2021-11-20 13:49:34', 60),
(5, 5, 3, 1, '2021-11-20 13:49:44', 60),
(6, 5, 4, 1, '2021-11-20 13:49:55', 60);

-- --------------------------------------------------------

--
-- Table structure for table `tax_status`
--

CREATE TABLE `tax_status` (
  `id` int(11) NOT NULL,
  `status_name_en` varchar(500) NOT NULL,
  `status_name_ar` varchar(500) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_status`
--

INSERT INTO `tax_status` (`id`, `status_name_en`, `status_name_ar`, `created_at`, `created_by`) VALUES
(1, 'active', 'فعالة', '2021-10-11 11:16:19', 1),
(2, 'inactive', 'غير فعالة', '2021-10-11 11:16:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_orders`
--

CREATE TABLE `temp_orders` (
  `id` bigint(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `type` enum('website','mobile') CHARACTER SET utf32 NOT NULL,
  `data` longtext CHARACTER SET utf32 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_orders`
--

INSERT INTO `temp_orders` (`id`, `user_id`, `type`, `data`, `created_at`) VALUES
(11, 797, 'website', '{\"user_id\":797,\"tax_id\":2,\"total_cost_before\":1,\"user_address_id\":\"150\",\"note\":\"Note\",\"payment_type\":\"2\",\"has_coupon\":0,\"token\":\"3b002a7a47f9a06290863dc2452fd151815bd8027d573e030405a6f7ccb82f1b31363334373038353936\",\"language_id\":1,\"currency_id\":1,\"total_cost_after\":1.140000000000000124344978758017532527446746826171875,\"coupon_code\":null,\"restaurant_id\":\"58\",\"items_content\":\"[{\\\"item_id\\\":\\\"58\\\",\\\"count\\\":\\\"1\\\",\\\"component\\\":\\\"\\\",\\\"offer_id\\\":\\\"\\\",\\\"price\\\":\\\"1\\\"}]\"}', '2021-11-17 13:37:14'),
(13, 798, 'website', '{\"user_id\":798,\"tax_id\":3,\"total_cost_before\":101,\"user_address_id\":\"220\",\"note\":\"Note\",\"payment_type\":\"2\",\"has_coupon\":0,\"token\":\"2ebac59cf0a70f898ed11030d753671ce7aa42fdf38ce14bf18c26d11889708b31363334383235333034\",\"language_id\":1,\"currency_id\":1,\"total_cost_after\":106.0499999999999971578290569595992565155029296875,\"coupon_code\":null,\"restaurant_id\":\"58\",\"items_content\":\"[{\\\"item_id\\\":\\\"61_23_24\\\",\\\"count\\\":\\\"1\\\",\\\"component\\\":\\\"23,24\\\",\\\"offer_id\\\":\\\"\\\",\\\"price\\\":\\\"100\\\"},{\\\"item_id\\\":\\\"58_23\\\",\\\"count\\\":\\\"1\\\",\\\"component\\\":\\\"23\\\",\\\"offer_id\\\":\\\"\\\",\\\"price\\\":\\\"1\\\"}]\"}', '2021-11-23 09:36:34'),
(14, 857, 'website', '{\"user_id\":857,\"tax_id\":3,\"total_cost_before\":50,\"user_address_id\":\"256\",\"note\":\"Note\",\"payment_type\":\"2\",\"has_coupon\":0,\"token\":\"1d9d6aeb6d689a6803511ebdc010216f20105f304c4308cdea6236f1cc4252a331363336383739333936\",\"language_id\":1,\"currency_id\":1,\"total_cost_after\":52.5,\"coupon_code\":null,\"restaurant_id\":\"158\",\"items_content\":\"[{\\\"item_id\\\":\\\"209_51_52\\\",\\\"count\\\":\\\"1\\\",\\\"component\\\":\\\"51,52\\\",\\\"offer_id\\\":\\\"\\\",\\\"price\\\":\\\"50\\\"}]\"}', '2021-11-23 09:52:39'),
(15, 789, 'website', '{\"user_id\":789,\"tax_id\":3,\"total_cost_before\":60,\"user_address_id\":\"282\",\"note\":\"Note\",\"payment_type\":\"2\",\"has_coupon\":0,\"token\":\"d4bb19cba0775dd702f3318e229fb96f08586ecfc3899ee13d9a98c440ccebd031363334363333393632\",\"language_id\":1,\"currency_id\":1,\"total_cost_after\":63,\"coupon_code\":null,\"restaurant_id\":\"151\",\"items_content\":\"[{\\\"item_id\\\":\\\"190_25_28_32_33\\\",\\\"count\\\":\\\"1\\\",\\\"component\\\":\\\"25,28,32,33\\\",\\\"offer_id\\\":\\\"\\\",\\\"price\\\":\\\"60\\\"}]\"}', '2021-12-25 08:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `verify_accounts`
--

CREATE TABLE `verify_accounts` (
  `account_id` int(11) NOT NULL,
  `token` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verify_accounts`
--

INSERT INTO `verify_accounts` (`account_id`, `token`, `created_at`, `updated_at`) VALUES
(116, '4a60252876c9750d6d7ed76c9448cc2f6307cb4c', '2021-09-11 05:35:33', '2021-09-11 05:35:33'),
(117, '7fc0ee90bb149ba6597df063f6b75912b9a6c0bd', '2021-09-11 05:36:38', '2021-09-11 05:36:38'),
(118, '87ef60b2e5bec1a9bb7e01a1cbbb11a3557da15f', '2021-09-11 05:38:16', '2021-09-11 05:38:16'),
(119, '51014327809eb6ca4f4e9ed09a7d5898ceb9f57a', '2021-09-11 05:41:18', '2021-09-11 05:41:18'),
(120, '4b001fa7cf5187b36b53d805e61fa8c639430d4b', '2021-09-11 05:45:09', '2021-09-11 05:45:09'),
(121, '970689f9d0cd2f7651f402ea339ee851b7a886d5', '2021-09-11 06:02:02', '2021-09-11 06:02:02'),
(122, 'a8c90960825ab39e4ce2211364398936a7a588b2', '2021-09-11 06:03:37', '2021-09-11 06:03:37'),
(148, 'c18c61fac996c641de2bd92f7ea3d899def3faa4', '2021-10-17 02:42:44', '2021-10-17 02:42:44'),
(149, '7a5be511dfc34dc1f2bbc4aad5f86a96ff841648', '2021-10-17 02:43:29', '2021-10-17 02:43:29'),
(150, '96a5dfd155cf4488698d760060d8ad3c4db4df90', '2021-10-17 02:45:15', '2021-10-17 02:45:15'),
(152, '62dc813f9a6fe5dce20d659d44bd41b5664f7c04', '2021-10-18 18:32:40', '2021-10-18 18:32:40'),
(153, 'd6cb72ba8d87a885ff34b60b7134944e9943faaa', '2021-10-18 18:33:45', '2021-10-18 18:33:45'),
(154, 'ebb2fa4bab6a467459b546a16579ae6a1599a3eb', '2021-11-11 13:15:44', '2021-11-11 13:15:44'),
(156, '25a6692499d3e745a14e6194a14b2fc6736e9f1a', '2021-11-21 20:05:32', '2021-11-21 20:05:32'),
(159, '8cf8dbe78646a45ca678606ea31b380eee966c88', '2021-11-22 13:19:48', '2021-11-22 13:19:48'),
(160, '1370d06b9e3082607b0e1ce1a029b3d531b6027e', '2021-11-22 13:46:38', '2021-11-22 13:46:38'),
(161, 'a418b914936b0c5fdd9c0780fe0a77e1c73fcc6b', '2021-11-28 15:57:32', '2021-11-28 15:57:32'),
(164, '691a4eb7d45b8d9603eebc5ee03223ff4d7722ac', '2021-12-14 18:46:12', '2021-12-14 18:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `work_status`
--

CREATE TABLE `work_status` (
  `id` int(11) NOT NULL,
  `status_name_en` varchar(500) NOT NULL,
  `status_name_ar` varchar(500) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `work_status`
--

INSERT INTO `work_status` (`id`, `status_name_en`, `status_name_ar`) VALUES
(1, 'online', 'مفتوح'),
(2, 'offline', 'مغلق');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_status_id` (`work_status_id`);

--
-- Indexes for table `accounts_payment_log`
--
ALTER TABLE `accounts_payment_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts_roles`
--
ALTER TABLE `accounts_roles`
  ADD PRIMARY KEY (`account_id`,`role_id`),
  ADD KEY `accounts_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `account_currency`
--
ALTER TABLE `account_currency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_fk` (`account_id`),
  ADD KEY `currency_fk` (`currency_id`);

--
-- Indexes for table `account_status`
--
ALTER TABLE `account_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banking_details`
--
ALTER TABLE `banking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `cart_items_component`
--
ALTER TABLE `cart_items_component`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_item_id` (`cart_item_id`),
  ADD KEY `component_id` (`component_id`);

--
-- Indexes for table `cart_status`
--
ALTER TABLE `cart_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `source_id` (`source_id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Indexes for table `component`
--
ALTER TABLE `component`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `component_price_currency`
--
ALTER TABLE `component_price_currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `coupon_currency`
--
ALTER TABLE `coupon_currency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_id` (`coupon_id`),
  ADD KEY `acc_currency_id` (`acc_currency_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `coupon_status`
--
ALTER TABLE `coupon_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_banking_details`
--
ALTER TABLE `customer_banking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_coupon`
--
ALTER TABLE `customer_coupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_id` (`coupon_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `discount_type`
--
ALTER TABLE `discount_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `place_id` (`place_id`);

--
-- Indexes for table `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filters_account`
--
ALTER TABLE `filters_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `discount_type_id` (`discount_type_id`),
  ADD KEY `item_status_id` (`item_status_id`),
  ADD KEY `item_size_id` (`item_size_id`);

--
-- Indexes for table `item_belongings`
--
ALTER TABLE `item_belongings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `related_item_id` (`related_item_id`);

--
-- Indexes for table `item_component`
--
ALTER TABLE `item_component`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `component_id` (`component_id`);

--
-- Indexes for table `item_price_currency`
--
ALTER TABLE `item_price_currency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_fk` (`item_id`),
  ADD KEY `acc_curr_fk` (`acc_currency_id`);

--
-- Indexes for table `item_size`
--
ALTER TABLE `item_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_status`
--
ALTER TABLE `item_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `min_price_currency`
--
ALTER TABLE `min_price_currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_price_currency`
--
ALTER TABLE `offer_price_currency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_id` (`offer_id`),
  ADD KEY `fk_acc` (`acc_currency_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `customer_address_id` (`customer_address_id`),
  ADD KEY `payment_type_id` (`payment_type_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `order_items_component`
--
ALTER TABLE `order_items_component`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_item_id` (`order_item_id`);

--
-- Indexes for table `order_steps`
--
ALTER TABLE `order_steps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_steps_log`
--
ALTER TABLE `order_steps_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `step_id` (`step_id`);

--
-- Indexes for table `order_user_subscriptions`
--
ALTER TABLE `order_user_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_sub_category`
--
ALTER TABLE `parent_sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `payment_log`
--
ALTER TABLE `payment_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`(191),`tokenable_id`);

--
-- Indexes for table `restaurant_sub_category`
--
ALTER TABLE `restaurant_sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `roles_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_cat_id` (`parent_cat_id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currency_id` (`currency_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `tax_status`
--
ALTER TABLE `tax_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_orders`
--
ALTER TABLE `temp_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_status`
--
ALTER TABLE `work_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `accounts_payment_log`
--
ALTER TABLE `accounts_payment_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `account_currency`
--
ALTER TABLE `account_currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `account_status`
--
ALTER TABLE `account_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `banking_details`
--
ALTER TABLE `banking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `cart_items_component`
--
ALTER TABLE `cart_items_component`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT for table `cart_status`
--
ALTER TABLE `cart_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `component`
--
ALTER TABLE `component`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `component_price_currency`
--
ALTER TABLE `component_price_currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `coupon_currency`
--
ALTER TABLE `coupon_currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `coupon_status`
--
ALTER TABLE `coupon_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `customer_banking_details`
--
ALTER TABLE `customer_banking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_coupon`
--
ALTER TABLE `customer_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `discount_type`
--
ALTER TABLE `discount_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `filters`
--
ALTER TABLE `filters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `filters_account`
--
ALTER TABLE `filters_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `item_belongings`
--
ALTER TABLE `item_belongings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `item_component`
--
ALTER TABLE `item_component`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT for table `item_price_currency`
--
ALTER TABLE `item_price_currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=341;

--
-- AUTO_INCREMENT for table `item_size`
--
ALTER TABLE `item_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item_status`
--
ALTER TABLE `item_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `min_price_currency`
--
ALTER TABLE `min_price_currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `offer_price_currency`
--
ALTER TABLE `offer_price_currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `order_items_component`
--
ALTER TABLE `order_items_component`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `order_steps`
--
ALTER TABLE `order_steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_steps_log`
--
ALTER TABLE `order_steps_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `order_user_subscriptions`
--
ALTER TABLE `order_user_subscriptions`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `parent_sub_category`
--
ALTER TABLE `parent_sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_log`
--
ALTER TABLE `payment_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `restaurant_sub_category`
--
ALTER TABLE `restaurant_sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tax_status`
--
ALTER TABLE `tax_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp_orders`
--
ALTER TABLE `temp_orders`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `work_status`
--
ALTER TABLE `work_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`work_status_id`) REFERENCES `work_status` (`id`);

--
-- Constraints for table `accounts_roles`
--
ALTER TABLE `accounts_roles`
  ADD CONSTRAINT `accounts_roles_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accounts_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `account_currency`
--
ALTER TABLE `account_currency`
  ADD CONSTRAINT `account_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `currency_fk` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `cart_status` (`id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);

--
-- Constraints for table `cart_items_component`
--
ALTER TABLE `cart_items_component`
  ADD CONSTRAINT `cart_items_component_ibfk_1` FOREIGN KEY (`cart_item_id`) REFERENCES `cart_items` (`id`),
  ADD CONSTRAINT `cart_items_component_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `component` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`source_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`destination_id`) REFERENCES `account` (`id`);

--
-- Constraints for table `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `coupon_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `coupon_status` (`id`),
  ADD CONSTRAINT `coupon_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `coupon_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `account` (`id`);

--
-- Constraints for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `evaluation_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
