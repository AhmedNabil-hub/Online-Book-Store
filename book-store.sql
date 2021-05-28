-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2021 at 11:17 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book-store`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` smallint(6) NOT NULL,
  `author_name` varchar(50) NOT NULL,
  `author_country` varchar(50) NOT NULL,
  `author_language` varchar(50) NOT NULL,
  `author_description` text NOT NULL,
  `author_photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`, `author_country`, `author_language`, `author_description`, `author_photo`) VALUES
(2, 'Clarkson N. Potter', 'england', 'english', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed.', 'frontend/images/main/default_author_photo.png'),
(3, 'Silhouette', 'egypt', 'english', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed.', 'frontend/images/main/default_author_photo.png'),
(4, 'Macromedia Press', 'england', 'english', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed.', 'frontend/images/main/default_author_photo.png'),
(5, 'Harlequin', 'egypt', 'english', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed.', 'frontend/images/main/default_author_photo.png'),
(6, 'Back Bay Books', 'england', 'english', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed.', 'frontend/images/main/default_author_photo.png'),
(7, 'Harper', 'india', 'english', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed.', 'frontend/images/main/default_author_photo.png'),
(8, 'New Riders Publishing', 'egypt', 'english', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed.', 'frontend/images/main/default_author_photo.png'),
(9, 'McGraw-Hill/Irwin', 'india', 'english', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed.', 'frontend/images/main/default_author_photo.png'),
(10, 'Vintage Books', 'egypt', 'english', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed.', 'frontend/images/main/default_author_photo.png'),
(11, 'Harvest Books', 'england', 'english', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed.', 'frontend/images/main/default_author_photo.png'),
(12, 'Picador', 'india', 'english', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed.', 'frontend/images/main/default_author_photo.png'),
(13, 'Pocket Books', 'england', 'english', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed.', 'frontend/images/main/default_author_photo.png'),
(14, 'Scribner Paperback Fiction', 'china', 'english', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed.', 'frontend/images/main/default_author_photo.png'),
(15, 'Penguin USA', 'china', 'english', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed.', 'frontend/images/main/default_author_photo.png'),
(16, 'Scribner', 'china', 'english', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed.', 'frontend/images/main/default_author_photo.png');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` smallint(6) NOT NULL,
  `title` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `published_at` text NOT NULL,
  `book_description` text NOT NULL,
  `book_cover` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `book_language` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `category`, `published_at`, `book_description`, `book_cover`, `created_at`, `book_language`) VALUES
(2, 'Chesapeake Blue', 'Literature & Fiction', '2002', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(3, 'The New City Home: Smart Solutions for Metro Living', 'Home Design', '2003', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(4, 'The Magician\'s Assistant', 'Romance', '1998', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(5, 'The Dark Highlander', 'Romance', '2002', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(6, 'Atonement', 'Literature & Fiction', '2003', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(7, 'The Rescuer: The O\'Malley Series', 'Romance', '2003', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(8, 'Love By Design', 'Literature & Fiction', '2003', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(9, 'Words and Rules: The Ingredients of Language', 'Science', '2000', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(10, 'The Complete Illustrated Guide to Furniture and Cabinet Construction', 'Home Design', '2001', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(11, 'Message in a Bottle', 'Literature & Fiction', '1999', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(12, 'Engaging The Enemy', 'Literature & Fiction', '2003', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(13, 'The Color of Magic', 'Fantasy', '2005', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(14, 'Photoshop 7 Down & Dirty Tricks', 'Computer', '2002', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(15, 'Contact', 'Science', '1997', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(16, 'Pyramids', 'Fantasy', '2001', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(17, 'The Future of Life', 'Science', '2002', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(18, 'Enduring Love', 'Literature & Fiction', '1999', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(19, 'The Pianist', 'Literature & Fiction', '2003', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(20, 'Cosmopolis: A Novel', 'Literature & Fiction', '2003', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(21, 'Linked: The New Science of Networks', 'Science', '2002', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(22, 'Pale Blue Dot: A Vision of the Human Future in Space', 'Science', '1997', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(23, 'Advanced Accounting', 'Accounting & Finance', '2001', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(24, 'On Human Nature', 'Science', '1988', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(25, 'MySQL', 'Computer', '2003', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(26, 'The Blank Slate: The Modern Denial of Human Nature', 'Science', '2002', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(27, 'Architecture: Form, Space, and Order', 'Home Design', '1996', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(28, 'Patron Saint of Liars', 'Romance', '2003', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english'),
(29, 'Dreamcatcher', 'Horror', '2003', 'Lorem ipsum dolor sit amet, id nam falli temporibus. Vero definiebas argumentum sea ex, sint molestie ut est, cu illud oblique sed. No luptatum suavitate vix, no zril persequeris est, per ne unum consectetuer. Sed feugiat sanctus ut.', 'frontend/images/main/default_book_cover.png', '2021-05-28 05:42:26', 'english');

-- --------------------------------------------------------

--
-- Table structure for table `book_auth`
--

CREATE TABLE `book_auth` (
  `book_id` smallint(6) NOT NULL,
  `author_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book_auth`
--

INSERT INTO `book_auth` (`book_id`, `author_id`) VALUES
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 2),
(18, 3),
(19, 7),
(20, 10),
(21, 15),
(22, 16),
(23, 4),
(24, 3),
(25, 10),
(26, 12),
(27, 15),
(28, 10),
(29, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` smallint(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `privilege` tinyint(1) NOT NULL DEFAULT 0,
  `profile_photo` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `full_name`, `privilege`, `profile_photo`, `created_at`) VALUES
(1, 'ahmed', '7c222fb2927d828af22f592134e8932480637c0d', 'ahmed@an.com', 'Ahmed Nabil', 0, NULL, '2021-05-28 01:18:37'),
(2, 'amal', '7c222fb2927d828af22f592134e8932480637c0d', 'amal@am.com', 'Amal Ahmed', 0, 'frontend/images/uploads/60672.jpg', '2021-05-28 01:19:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_auth`
--
ALTER TABLE `book_auth`
  ADD PRIMARY KEY (`book_id`,`author_id`),
  ADD KEY `book_auth_ibfk_2` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_auth`
--
ALTER TABLE `book_auth`
  ADD CONSTRAINT `book_auth_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_auth_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
