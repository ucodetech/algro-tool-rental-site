-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 27, 2022 at 02:43 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `passport` varchar(200) NOT NULL DEFAULT 'default.png',
  `signature` varchar(200) NOT NULL DEFAULT 'defaultSign.png',
  `user_unique_id` varchar(15) NOT NULL,
  `user_fullname` varchar(50) NOT NULL,
  `user_tel` varchar(15) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_address` text NOT NULL,
  `user_state` varchar(100) NOT NULL,
  `user_city` varchar(100) NOT NULL,
  `user_lga` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  `user_date_joined` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(2) NOT NULL DEFAULT 0,
  `suspened` int(2) NOT NULL DEFAULT 0,
  `made_update` int(11) NOT NULL DEFAULT 0,
  `made_update_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;