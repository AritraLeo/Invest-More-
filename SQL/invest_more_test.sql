-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2022 at 09:27 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invest_more_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `deposit_users`
--

CREATE TABLE `deposit_users` (
  `id` int(25) NOT NULL,
  `name` varchar(40) NOT NULL,
  `username` varchar(25) NOT NULL,
  `plan` text NOT NULL,
  `amount` varchar(10) NOT NULL,
  `pay_id` varchar(40) NOT NULL,
  `pay_status` text NOT NULL,
  `expected_amt_status` varchar(40) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deposit_users`
--

INSERT INTO `deposit_users` (`id`, `name`, `username`, `plan`, `amount`, `pay_id`, `pay_status`, `expected_amt_status`, `dt`) VALUES
(1, 'Aritra Banerjee ', 'ab3', 'long_term', '6000', 'pay_JTydpZ6CyXs7wI', 'Success', 'On 2023-03', '2022-05-11 21:24:24'),
(2, 'Aritra Banerjee ', 'ab3', 'short_term', '200', 'pay_JTyiYPwCYJBrhu', 'Success', 'On 2023-03', '2022-05-11 21:28:51'),
(3, 'Aritra Banerjee ', 'ab', 'short_term', '6000', 'pay_JTz7RgYJSHi2j2', 'Success', 'On 2023-03', '2022-05-11 21:52:25'),
(4, 'Aritra Banerjee ', 'ab3', 'Short Term Basic\r\n', '6000', 'pay_JZsPinjfQWkmLB', 'Success', 'On 2023-03', '2022-05-26 19:12:57'),
(6, 'Aritra Banerjee ', 'ab3', 'Short Term Basic', '200', 'pay_JabptQmaW1TnVZ', 'Success', 'On 2022-06-27 your funds are expected to', '2022-05-28 15:38:56'),
(7, 'Aritra Banerjee ', 'ab3', 'Short Term Basic', '6000', 'pay_JabwsPrVWE1w9n', 'Success', 'On 2022-06-27  ', '2022-05-28 15:45:33'),
(8, 'Aritra Banerjee ', 'ab', 'Short Term Premium', '6000', 'pay_JbpTwhH7DgBMS5', 'Success', 'On 2022-08-29  ', '2022-05-31 17:38:55'),
(9, 'Aritra Banerjee ', 'Leo056', 'Short Term Basic', '5000', 'pay_JbpcjBXllm42vI', 'Success', 'On 2022-06-30  ', '2022-05-31 17:47:12'),
(11, 'Aritra Banerjee ', 'ab', 'Short Term Basic', '2500', 'pay_Jbqidgv4s0aNHZ', 'Success', 'On 2022-06-30  ', '2022-05-31 18:51:34'),
(12, 'Aritra Banerjee ', 'ab', 'Short Term Basic', '2500', 'pay_JbqlQNXwUrtAS9', 'Success', 'On 2022-06-30  ', '2022-05-31 18:54:07'),
(13, 'Aritra Banerjee ', 'ab', 'Short Term Basic', '2500', 'pay_JbqmB5DTELzvyI', 'Success', 'On 2022-06-30  ', '2022-05-31 18:54:51'),
(14, 'Aritra Banerjee ', 'ab', 'Long Term Premium', '2500', 'pay_Jbr5z8AFhJgnge', 'Success', 'On 2023-05-26  ', '2022-05-31 19:13:36'),
(15, 'Aritra Banerjee ', 'ab3', 'Short Term Basic', '2500', 'pay_Jbw3uCcjuxuchc', 'Success', 'On 2022-06-30  ', '2022-06-01 00:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(20) NOT NULL,
  `name_of_plan` varchar(20) NOT NULL,
  `plan_code` text NOT NULL,
  `interest` varchar(2) NOT NULL,
  `tenure` varchar(2) NOT NULL,
  `description` text NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `accent_color` varchar(14) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name_of_plan`, `plan_code`, `interest`, `tenure`, `description`, `featured`, `accent_color`, `dt`) VALUES
(1, 'Short Term Basic', 'stb', '2', '1', 'Short Term Basic Plan!', 1, '#FF0000', '2022-05-11 22:07:59'),
(2, 'Short Term Premium', 'stp', '8', '3', 'Short Term Premium Desc ', 1, '#DC143C', '2022-05-23 20:02:40'),
(3, 'Short Term Ultra', 'stu', '18', '6', 'Short Term Ultra', 0, '#031cfc', '2022-05-30 12:41:08'),
(4, 'Long Term Basic', 'ltb', '24', '8', 'LongTerm Basic', 1, '#42adf5', '2022-05-30 12:42:37'),
(5, 'Long Term Premium', 'ltp', '38', '12', 'Long Term Premium', 0, '#fc5a03', '2022-05-30 12:44:42'),
(6, 'Long Term Ultra', 'ltu', '49', '15', 'Long Term Ultra', 1, '#fc0394', '2022-05-30 12:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(25) NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `account` int(25) NOT NULL,
  `ifsc` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `refererusername` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `phone`, `email`, `address`, `name`, `account`, `ifsc`, `refererusername`, `dt`) VALUES
(1, 'ab', '$2y$10$6FBd/soJsaG/Qm8thq/kIOUS.qsaWs7kUnbUQPS0FvigcI7ZM0MJW', '08697173233', 'aritra056@gmail.com', 'Baikunthapur, near Saraswati Sanga', 'Aritra Banerjee ', 2147483647, 'Trd838', '', '2022-04-11 17:55:03'),
(2, 'dsdeb', '$2y$10$IR/Hx4OsvJN8xdqkJG5IGOmiGaLoYKY1sjFGTciVMMqSZxN3gcWJa', '9831144167', 'ds.debabrata@gmail.com', '&lt;script&gt;alert(‘XSS’)&lt;/script&gt;', 'deb', 123, '123', '', '2022-04-14 21:10:04'),
(3, 'ab3', '$2y$10$vzj9W1xk3WWgP/dDiti3VemSzFoAIBIvpihnSINDxdlU1OhuoTr2u', '62916077454', 'testab3@gmail.com', 'Baikunthapur, near Saraswati Sanga', 'Aritra Banerjee ', 2147483647, '54452', 'ab', '2022-05-26 19:08:13'),
(6, 'ref', '$2y$10$B0JU.QD1GNfhxle3Oj7y2uo4HGxEB7xAHM10Q4NRgB7vEdTeJuoMS', '22122121221', 'ref@fss.com', 'wwewqeeqwe', 'ref', 2147483647, 'asA123123', 'ab        ', '2022-05-27 19:41:42'),
(7, 'Leo056', '$2y$10$rXRJj8kqyP8Rr9ueLEvfKuXGEooxuFGFAY9NZrdAAoILg7bEEH3PG', '2321312312', 'leo@try.tr', '104 , Near Saraswati Sanga', 'Leo', 2147483647, 'Triben000', '     ab3         ', '2022-05-29 17:09:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deposit_users`
--
ALTER TABLE `deposit_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposit_users`
--
ALTER TABLE `deposit_users`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
