-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 08, 2019 lúc 05:42 AM
-- Phiên bản máy phục vụ: 10.1.34-MariaDB
-- Phiên bản PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `larabook`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 'Demo comment', 3, 36, '2019-03-05 17:00:00', '2019-03-06 17:00:00'),
(2, 'Demo cmt 2', 3, 36, '2019-03-06 17:00:00', '2019-03-06 17:00:00'),
(5, 'haha', 3, 37, NULL, NULL),
(6, 'hehe', 3, 37, NULL, NULL),
(7, 'ro gia gia ro ro gia gia ro ro gia gia ro ro gia gia ro ro gia gia ro ro gia gia ro', 3, 37, NULL, NULL),
(8, '=))', 4, 37, NULL, NULL),
(9, '>', 4, 32, NULL, NULL),
(10, 'oke', 8, 37, NULL, NULL),
(11, 'somebody here?', 8, 31, NULL, NULL),
(12, 'so delicous', 3, 42, NULL, NULL),
(13, 'nice to be a friend of you', 3, 43, NULL, NULL),
(14, 'Really?', 9, 35, NULL, NULL),
(16, 'nippou sentai hurricane', 5, 45, NULL, NULL),
(17, 'huhu', 3, 47, NULL, NULL),
(18, 'ok boy', 3, 46, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `conversation`
--

INSERT INTO `conversation` (`id`, `user_one`, `user_two`) VALUES
(1, 3, 4),
(2, 3, 5),
(3, 3, 6),
(4, 3, 10),
(5, 6, 5),
(6, 4, 8),
(7, 3, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `friendships`
--

CREATE TABLE `friendships` (
  `id` int(10) UNSIGNED NOT NULL,
  `requester` int(11) NOT NULL,
  `user_requested` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `friendships`
--

INSERT INTO `friendships` (`id`, `requester`, `user_requested`, `status`, `created_at`, `updated_at`) VALUES
(16, 7, 6, 1, '2019-02-21 01:36:36', '2019-02-21 01:36:36'),
(18, 4, 6, 1, '2019-02-21 02:18:28', '2019-02-21 02:18:28'),
(19, 3, 4, 1, '2019-02-21 02:58:25', '2019-02-21 02:58:25'),
(21, 5, 3, 1, '2019-02-21 20:05:17', '2019-02-21 20:05:17'),
(23, 4, 5, 1, '2019-02-21 20:22:54', '2019-02-21 20:22:54'),
(24, 5, 6, 1, '2019-02-21 20:26:48', '2019-02-21 20:26:48'),
(25, 10, 3, 1, '2019-02-21 20:45:44', '2019-02-21 20:45:44'),
(27, 10, 5, 1, '2019-02-21 20:45:52', '2019-02-21 20:45:52'),
(30, 3, 6, 1, '2019-02-25 01:38:09', '2019-02-25 01:38:09'),
(31, 9, 4, 1, '2019-02-25 01:46:02', '2019-02-25 01:46:02'),
(32, 9, 5, 1, '2019-02-25 01:46:05', '2019-02-25 01:46:05'),
(33, 9, 10, 1, '2019-02-25 02:10:57', '2019-02-25 02:10:57'),
(34, 8, 10, 1, '2019-02-25 02:55:02', '2019-02-25 02:55:02'),
(35, 8, 4, 1, '2019-02-25 02:55:06', '2019-02-25 02:55:06'),
(36, 8, 5, 1, '2019-02-25 02:58:31', '2019-02-25 02:58:31'),
(37, 8, 7, 1, '2019-02-25 03:04:57', '2019-02-25 03:04:57'),
(38, 3, 8, 1, '2019-02-27 08:44:37', '2019-02-27 08:44:37'),
(39, 4, 7, 0, '2019-03-06 22:00:27', '2019-03-06 22:00:27'),
(40, 3, 7, 1, '2019-03-07 01:34:41', '2019-03-07 01:34:41'),
(41, 9, 3, 1, '2019-03-07 02:05:57', '2019-03-07 02:05:57'),
(42, 9, 6, 0, '2019-03-07 02:06:00', '2019-03-07 02:06:00'),
(43, 9, 7, 0, '2019-03-07 02:06:03', '2019-03-07 02:06:03'),
(44, 11, 3, 0, '2019-03-07 02:12:21', '2019-03-07 02:12:21'),
(45, 11, 4, 0, '2019-03-07 02:12:24', '2019-03-07 02:12:24'),
(46, 11, 5, 0, '2019-03-07 02:12:27', '2019-03-07 02:12:27'),
(47, 11, 10, 0, '2019-03-07 02:12:32', '2019-03-07 02:12:32'),
(48, 8, 11, 0, '2019-03-07 02:43:30', '2019-03-07 02:43:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `like` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `like`, `created_at`, `updated_at`) VALUES
(11, 4, 34, 0, NULL, NULL),
(12, 4, 34, 0, NULL, NULL),
(13, 4, 34, 1, NULL, NULL),
(14, 4, 32, 0, NULL, NULL),
(15, 4, 31, 1, NULL, NULL),
(16, 4, 32, 0, NULL, NULL),
(17, 4, 32, 1, NULL, NULL),
(18, 3, 34, 0, NULL, NULL),
(19, 3, 32, 1, NULL, NULL),
(20, 3, 34, 1, NULL, NULL),
(21, 3, 35, 1, NULL, NULL),
(22, 3, 36, 0, NULL, NULL),
(23, 3, 36, 0, NULL, NULL),
(24, 3, 24, 1, NULL, NULL),
(25, 3, 36, 1, NULL, NULL),
(26, 3, 37, 1, NULL, NULL),
(27, 4, 37, 1, NULL, NULL),
(28, 8, 37, 1, NULL, NULL),
(29, 8, 39, 1, NULL, NULL),
(30, 3, 39, 1, NULL, NULL),
(31, 3, 42, 1, NULL, NULL),
(32, 3, 43, 0, NULL, NULL),
(33, 3, 44, 0, NULL, NULL),
(34, 9, 35, 1, NULL, NULL),
(35, 3, 45, 1, NULL, NULL),
(36, 5, 45, 1, NULL, NULL),
(37, 3, 46, 1, NULL, NULL),
(38, 3, 47, 1, NULL, NULL),
(39, 3, 43, 1, NULL, NULL),
(40, 3, 44, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `user_from`, `user_to`, `conversation_id`, `msg`, `status`) VALUES
(1, 3, 4, 1, 'how are you, id 4?', 1),
(2, 5, 3, 2, 'hello Khanh', 1),
(3, 3, 5, 2, 'hello quy', 1),
(4, 3, 4, 1, 'hey mina', 1),
(5, 4, 3, 1, 'I am here Khanh', 1),
(12, 3, 4, 1, 'hello agian', 1),
(13, 3, 5, 2, 'how do u feel', 1),
(17, 3, 4, 1, 'abc', 1),
(18, 3, 5, 2, 'dd', 1),
(19, 3, 6, 3, 'an oi', 1),
(20, 3, 6, 3, 'khanh day', 1),
(21, 6, 3, 3, 'toi day', 1),
(22, 3, 6, 3, 'lam bai tap chua', 1),
(23, 6, 3, 3, 'roi', 1),
(24, 3, 10, 4, 'Hey, what is going on?', 1),
(25, 6, 5, 5, 'quy oi', 1),
(26, 3, 5, 2, 'eu', 1),
(27, 4, 8, 6, 'zolo', 1),
(28, 4, 8, 6, 'minh oi t bao', 1),
(29, 4, 3, 1, 'what the hell', 1),
(30, 3, 6, 3, 'chup anh t voi', 1),
(31, 6, 3, 3, 'doi ti', 1),
(32, 3, 8, 7, 'eu cu', 1),
(33, 3, 4, 1, 'abc', 1),
(34, 3, 4, 1, 'abc', 1),
(35, 3, 4, 1, 'tets', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_02_20_064149_create_profile_table', 1),
(4, '2019_02_21_035809_create_friendships_table', 2),
(5, '2019_02_25_065654_create_notifcations_table', 3),
(6, '2019_02_27_031852_create_posts_table', 4),
(7, '2019_03_06_071718_create_likes_table', 5),
(8, '2019_03_07_030301_create_comments_table', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifcations`
--

CREATE TABLE `notifcations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_logged` int(11) NOT NULL,
  `user_hero` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `notifcations`
--

INSERT INTO `notifcations` (`id`, `user_logged`, `user_hero`, `status`, `note`, `created_at`, `updated_at`) VALUES
(3, 6, 3, 0, 'accepted your friend request', '2019-02-25 01:38:32', '2019-02-25 01:38:32'),
(4, 4, 9, 1, 'accepted your friend request', '2019-02-25 01:46:21', '2019-02-25 01:46:21'),
(5, 5, 9, 0, 'accepted your friend request', '2019-02-25 01:46:39', '2019-02-25 01:46:39'),
(6, 10, 9, 0, 'accepted your friend request', '2019-02-25 02:11:15', '2019-02-25 02:11:15'),
(7, 10, 8, 1, 'accepted your friend request', '2019-02-25 02:55:21', '2019-02-25 02:55:21'),
(8, 4, 8, 1, 'accepted your friend request', '2019-02-25 02:55:34', '2019-02-25 02:55:34'),
(9, 5, 8, 0, 'accepted your friend request', '2019-02-25 02:58:53', '2019-02-25 02:58:53'),
(10, 5, 10, 0, 'accepted your friend request', '2019-02-26 19:04:06', '2019-02-26 19:04:06'),
(11, 7, 8, 1, 'accepted your friend request', '2019-02-26 21:43:53', '2019-02-26 21:43:53'),
(12, 8, 3, 0, 'accepted your friend request', '2019-02-27 08:45:00', '2019-02-27 08:45:00'),
(13, 7, 3, 1, 'accepted your friend request', '2019-03-07 01:35:08', '2019-03-07 01:35:08'),
(14, 3, 9, 1, 'accepted your friend request', '2019-03-07 02:09:32', '2019-03-07 02:09:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `pid` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`pid`, `user_id`, `content`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(31, 8, 'hello every one', NULL, 1, '2019-02-28 01:46:56', '2019-02-28 01:46:56'),
(34, 4, 'i am mina', NULL, 1, '2019-03-06 00:24:31', '2019-03-06 00:24:31'),
(35, 4, 'Hello I am a pretty girl', NULL, 1, '2019-03-06 01:11:17', '2019-03-06 01:11:17'),
(37, 3, 'hanoi 2/3/2019 tiki', NULL, 1, '2019-03-06 20:50:21', '2019-03-06 20:50:21'),
(39, 8, 'dark world', 'login_background2.jpg', 1, '2019-03-07 01:19:21', '2019-03-07 01:19:21'),
(42, 3, 'Coffee milk', 'Small-Heart-Latte-Art-Coffee-Design.jpg', 1, '2019-03-07 01:31:17', '2019-03-07 01:31:17'),
(43, 7, 'I want to make friend with everyone', 'article.jpg', 1, '2019-03-07 01:35:53', '2019-03-07 01:35:53'),
(44, 3, '\"That’s why you play football. You want to become a legend.\"\r\nVan Dijk craves the legendary status that he believes would come with Premier League title success at #LFC over individual awards...', 'images.jpg', 1, '2019-03-07 01:42:12', '2019-03-07 01:42:12'),
(45, 3, 'How do you think about my ava =)))', '13886946_1101550126628108_3940892956265818130_n.jpg', 1, '2019-03-07 01:56:14', '2019-03-07 01:56:14'),
(46, 9, 'I am new. Please make friend with me.', NULL, 1, '2019-03-07 02:00:13', '2019-03-07 02:00:13'),
(47, 5, 'One punch, one die', 'One-Punch-Man-Header-002-20150913.jpg', 1, '2019-03-07 02:07:05', '2019-03-07 02:07:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `city`, `country`, `about`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 3, 'Ha Noi', 'Viet Nam', 'Handsome, generous and still alone', NULL, '2019-02-20 00:11:02', '2019-02-20 00:11:02'),
(2, 4, 'Liverpool', 'England', 'lovely girl', NULL, '2019-02-20 00:11:43', '2019-02-20 00:11:43'),
(3, 5, 'Tuyen Quang', 'Viet Nam', 'love playing games', NULL, '2019-02-20 02:49:44', '2019-02-20 02:49:44'),
(4, 6, 'Lam Dong', 'Viet Nam', 'love pink, hate liar', NULL, '2019-02-20 20:39:07', '2019-02-20 20:39:07'),
(5, 7, 'New York', 'US', 'I am a teacher', NULL, '2019-02-21 01:08:47', '2019-02-21 01:08:47'),
(6, 8, 'Thanh Hoa', 'Viet Nam', 'Thanh Hoa anh hung', NULL, '2019-02-21 20:36:05', '2019-02-21 20:36:05'),
(7, 9, 'Ha Noi', 'Viet Nam', 'I know everything', NULL, '2019-02-21 20:37:10', '2019-02-21 20:37:10'),
(8, 10, 'L.A', 'US', 'You will never walk alone', NULL, '2019-02-21 20:38:16', '2019-02-21 20:38:16'),
(9, 11, 'Hamburg', 'Germany', 'Experienced manager', NULL, '2019-03-07 02:10:43', '2019-03-07 02:10:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `slug`, `email`, `pic`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Nguyen Khanh', 'male', 'nguyen-khanh', 'khanh_deptrai_97@yahoo.com.vn', '13886946_1101550126628108_3940892956265818130_n.jpg', '$2y$10$zrv/aRCIrAyFn7Mph7cKHeEySKuqCsiONNBlr32mIChPHbP0bpjGW', '4CvK4zXpCsWz3Ka9LPaFwNaXNnLiDHe4YJccOuxQMFN3VroX2ortoaouJ2mG', '2019-02-20 00:11:02', '2019-02-20 00:11:02'),
(4, 'Mina Dao', 'female', 'mina-dao', 'trambauxinh@yahoo.com.vn', 'ava5.png', '$2y$10$rsQc8NdHz10uhCxMZ9CnfOW8jL4c01W1zbcveC6eXfAMJmz6VqdxK', 'x6zNRJDJQVVds6iTM6DGCmVKPXpfgVZp0S5AYVVOv23Pvxv6c9xHo8PvHpen', '2019-02-20 00:11:43', '2019-02-20 00:11:43'),
(5, 'Dang Quy', 'male', 'dang-quy', 'quydt@gmail.com', 'ava3.png', '$2y$10$owXv/IV/SUO2pjRD.1ZDVOF/Dpq8edo97xZKU0GSBlw1lnAGnmxCu', 'NLcHz53JFQsAGWHsKbHpiyWrbzu7M6P9BXhg2rVlLNKE1tUTQMq6t8ZI6khu', '2019-02-20 02:49:44', '2019-02-20 02:49:44'),
(6, 'Nguyen Van An', 'male', 'nguyen-van-an', 'an@gmail.com', 'boy.png', '$2y$10$MqRjdNBODqBZGGpQel3mLudxc8b5W5nv/Jom3SHpK8msUsAQHlonS', 'tIyUBKZtfJYpXQKwox6ohAyQ9HVMz1D2pZV8hol2UW0wHoMDjIcFsFHsOwVo', '2019-02-20 20:39:07', '2019-02-20 20:39:07'),
(7, 'Anna Nguyen', 'female', 'anna-nguyen', 'anna@gmail.com', 'girl.png', '$2y$10$mjLwAKMF5N2JQZ7NhV0j6OqO3a6jWuq5S0DTNPaYGMlA8COZnNepu', 'NwsGE9CzEmsTkD3RmkOtFOF3JFj2XmuuOweMjZyBcGEvX8fLUSAdEIPBmGyH', '2019-02-21 01:08:47', '2019-02-21 01:08:47'),
(8, 'Quang Minh', 'male', 'quang-minh', 'zorrominh@gmail.com', '11267717_672935609516929_5956412_n.jpg', '$2y$10$C77j6NFZq0FZumMxzHkfzO/IWWrqQTyhT9ISVwNm80lumebzf5F1.', 'FFXRBQeEGuPW7FgS2FYQX9sqIewuYzKcNdzQoT8WJMLGoPLOp5Q9TzOKrdFQ', '2019-02-21 20:36:05', '2019-02-21 20:36:05'),
(9, 'Do Trung Tuan', 'male', 'do-trung-tuan', 'tuandt@hus.edu.vn', 'ava4.png', '$2y$10$e5mCFgeVfL7HJ7OLQV/wc.lHSML1qpuzCp0BlXWf3yxc/1heOtRNW', '2EDWjau9vCZGsjlXUlgTxgIwCn6O0CeV6yewZS2TyPtzpmWk3QEOOlHj1E48', '2019-02-21 20:37:10', '2019-02-21 20:37:10'),
(10, 'Michael Khanh', 'male', 'michael-khanh', 'nguyenbkhanh97@gmail.com', 'ava2.png', '$2y$10$tKHoCUs3kGzxRM2cmkahhuYK7EU5yXDynHITmLyAkUYY46W.9tj0S', 'A7PZcCIcqK4LDPaDfpxiWGQJtdm3Xb2Br2pT7TcsLGlbftTV5AUmGA5gvsFm', '2019-02-21 20:38:16', '2019-02-21 20:38:16'),
(11, 'Jurgen Klopp', 'male', 'jurgen-klopp', 'klopp@gmail.com', 'boy.png', '$2y$10$mk0PCK5LMUwo.RpKVM8b5eCNhJduf2TSLPSHy8PaHap/dlkinsc9y', 'it2PTfkBEgyT6rPXwFSMPqLiK3n22WOqCwXHv2DAEbF6KCMPOw09UN1WMwar', '2019-03-07 02:10:43', '2019-03-07 02:10:43');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifcations`
--
ALTER TABLE `notifcations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`pid`);

--
-- Chỉ mục cho bảng `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `friendships`
--
ALTER TABLE `friendships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `notifcations`
--
ALTER TABLE `notifcations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `pid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
