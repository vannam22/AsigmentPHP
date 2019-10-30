-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: fdb24.runhosting.com
-- Generation Time: Oct 30, 2019 at 09:42 AM
-- Server version: 5.7.20-log
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `3192481_onlineshopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productImage` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `productName`, `productImage`, `price`, `status`) VALUES
(608, 'Máy Ảnh Canon EOS M50 + Kit 15-45mm (24.1MP)...', 'img/products/b3ef1d86739ec9c4eb776c55a81a73b6.jpg', 13990000, 1),
(639, 'Chân Máy Ảnh Tripod WEIFENG WT-3520 - Hàng...', 'img/products/5a43fc7c1f74f99fdeadf458184e48fe.jpg', 222222, 1),
(648, 'Giá đỡ điện thoại, máy ảnh 3 chân Tripod...', 'img/products/5859b0e6f827fc2df5078d12ad73efce.jpg', 64939, 1),
(649, 'Chân Máy Ảnh Tripod Yunteng VCT - 668 - Hàng...', 'img/products/34688695d67b1a96439181022825bc3f.jpg', 399999, 1),
(650, 'Thẻ nhớ Samsung Evo Plus 32GB chuyên dụng...', 'img/products/48bf4e954563f36b9fc6bff289681755.jpg', 105000, 1),
(651, 'Camera IP Wifi Dahua 3Mp IPC-C35P - Hàng...', 'img/products/-1.u504.d20161011.t160935.440433.jpg', 1060000, 1),
(652, 'Camera Ezviz C6C CS-CV246 (Ez360 1080P) -...', 'img/products/0b9e8d07bd27ed6184b8f4da96f3bbc1.jpg', 636480, 1),
(655, 'Máy Quay DJI OSMO Pocket - Hàng Chính hãng', 'img/products/6ccff1f06b3d00093e97ea6b6515936e.jpg', 7190000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` mediumint(6) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` char(60) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_level` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `first_name`, `last_name`, `email`, `password`, `registration_date`, `user_level`, `status`) VALUES
(162, 'admin', 'nam', 'admin@gmail.com', '$2y$10$CK.L0C42hzlvRxKYqOYoHO6Ojzbrk8pKb2yBtkZuBhJHOYfF/owPq', '2019-09-16 20:07:33', 1, 1),
(282, 'anh', 'em', 'anhem@gmail.com', '$2y$10$NVvqgaeMVyA4gt5TbLaMS.1R0F.X.VjwrOD8rvFZwFgHHjbT2vr/6', '2019-10-16 07:10:17', 2, 1),
(284, 'nam', 'nam', 'namkaka2412@gmail.com', '$2y$10$4EJOTHYj7y2D1yn5qKiNcu8.imT1XH64XXWDXyeUXbWHz7CXKInHm', '2019-10-17 10:48:54', 2, 1),
(288, 'test', 'user', 'test@gmail.com', '$2y$10$HPCayIaoWK0771CLaNEfMOeT3x5dL0tI4e8kx/fNoLcsQ7tIRlX86', '2019-10-29 17:21:55', 2, 1),
(292, 'test', 'admin', 'admin2@gmail.com', '$2y$10$aAN7FneMJR0KIhtUS1PRHuaoYAEm0IZVYI7vu9D0K35gUXoQcTrVm', '2019-10-30 09:09:14', 1, 1),
(293, 'add', 'user', 'user@gmail.com', '$2y$10$/BUO510GEjm1JwKY5Sm8jeoSvvNCkUoJKHB/2JZDOsaZNUlvX4gk6', '2019-10-30 09:16:02', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=670;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
