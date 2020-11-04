-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 29, 2020 at 04:13 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gs_bm`
--

-- --------------------------------------------------------

--
-- Table structure for table `gs_bm_table`
--

CREATE TABLE `gs_bm_table` (
  `id` int(12) NOT NULL,
  `title` varchar(64) NOT NULL,
  `author` varchar(64) NOT NULL,
  `img` text NOT NULL,
  `url` text NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `title`, `author`, `img`, `url`, `comment`, `date`) VALUES
(34, '総理の夫', '原田マハ', 'http://books.google.com/books/content?id=Fv_1DQAAQBAJ&amp;printsec=frontcover&amp;img=1&amp;zoom=1&amp;edge=curl&amp;source=gbs_api', 'http://books.google.co.jp/books?id=Fv_1DQAAQBAJ&amp;printsec=frontcover&amp;dq=%E7%B7%8F%E7%90%86%E3%81%AE%E5%A4%AB&amp;hl=&amp;cd=1&amp;source=gbs_api', '映画になる', '2020-10-27 15:19:35'),
(35, 'ハリー・ポッターと死の秘宝', 'J.K. ローリング', 'http://books.google.com/books/content?id=xHXLRAAACAAJ&amp;printsec=frontcover&amp;img=1&amp;zoom=1&amp;source=gbs_api', 'http://books.google.co.jp/books?id=xHXLRAAACAAJ&amp;dq=%E3%83%8F%E3%83%AA%E3%83%BC%E3%83%9D%E3%83%83%E3%82%BF%E3%83%BC&amp;hl=&amp;cd=4&amp;source=gbs_api', '読んでない', '2020-10-27 15:26:55'),
(36, '鬼滅の刃 1', '吾峠呼世晴', 'http://books.google.com/books/content?id=Mj1cDAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'http://books.google.co.jp/books?id=Mj1cDAAAQBAJ&pg=PT109&dq=%E9%AC%BC%E6%BB%85&hl=&cd=5&source=gbs_api', '話題なのでほしい', '2020-10-27 15:55:19'),
(37, 'レシピブログmagazine Vol.16', 'レシピブログ', 'http://books.google.com/books/content?id=Z4YBEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'http://books.google.co.jp/books?id=Z4YBEAAAQBAJ&printsec=frontcover&dq=%E3%83%AC%E3%82%B7%E3%83%94&hl=&cd=1&source=gbs_api', 'なし', '2020-10-29 13:09:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
