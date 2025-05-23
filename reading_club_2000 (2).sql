-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 02:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reading_club_2000`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `category` enum('children','ya','educational','programming','cook') NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `available` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `available_copies` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `description`, `category`, `cover_image`, `quantity`, `available`, `created_at`, `updated_at`, `available_copies`) VALUES
(1, 'To Kill a Mockingbird', 'Harper Lee', NULL, 'ya', 'assets/img/ya1.jpg', 1, 99, '2025-04-04 16:56:53', '2025-05-23 05:41:57', 104),
(2, 'The Hunger Games', 'Suzanne Collins', NULL, 'ya', 'assets/img/ya2.jpg', 1, 99, '2025-04-04 16:56:53', '2025-05-23 05:42:03', 103),
(3, 'Looking For Alaska', 'John Green', '', 'ya', 'assets/img/ya3.jpg', 1, 99, '2025-04-04 16:56:53', '2025-05-23 05:42:08', 101),
(4, 'One Of Us is Lying', 'Karen M. Mcmanus', NULL, 'ya', 'assets/img/ya4.jpg', 1, 100, '2025-04-04 16:56:53', '2025-05-23 05:41:02', 100),
(5, 'The Catcher In The Rye', 'J.D Salinger', '', 'ya', 'assets/img/ya5.jpg', 1, 100, '2025-04-04 16:56:53', '2025-05-22 06:20:14', 100),
(6, 'The Outsiders', 'S.E Hinton', NULL, 'ya', 'assets/img/ya6.jpg', 3, 98, '2025-04-04 17:31:51', '2025-05-22 05:48:02', 101),
(7, 'The Book For Thief', 'Markus Zusak', NULL, 'ya', 'assets/img/ya7.jpg', 2, 97, '2025-04-04 17:31:51', '2025-05-22 05:47:55', 100),
(8, 'SharePoint 2010 Branding and User Interface Design', 'Yaroslav Pentsarskyy', NULL, 'ya', 'assets/img/book3.jpg', 1, 99, '2025-04-04 17:31:51', '2025-05-21 07:36:18', 100),
(9, 'The Hunger Games', 'Suzanne Collins', NULL, 'ya', 'assets/img/ya2.jpg', 1, 99, '2025-05-19 14:28:24', '2025-05-21 06:52:15', 100),
(10, 'Twilight', 'Stephenie Meyer', NULL, 'ya', 'assets/img/ya10.jpg', 1, 100, '2025-05-19 14:28:24', '2025-05-19 15:27:01', 100),
(11, 'The Lightning Thief', 'Rick Riordan', NULL, 'ya', 'assets/img/ya11.jpg', 1, 100, '2025-05-19 14:28:24', '2025-05-19 15:27:07', 100),
(12, 'Divergent', 'Veronica Roth', NULL, 'ya', 'assets/img/ya12.jpg', 1, 100, '2025-05-19 14:28:24', '2025-05-19 15:27:48', 100),
(13, 'The Fault in Our Stars', 'John Green', NULL, 'ya', 'assets/img/ya13.jpg', 1, 100, '2025-05-19 14:28:24', '2025-05-19 15:27:54', 100),
(14, 'City of Bones', 'Cassandra Clare', NULL, 'ya', 'assets/img/ya14.jpg', 1, 100, '2025-05-19 14:28:24', '2025-05-19 15:27:58', 100),
(15, 'Throne of Glass', 'Sarah J. Maas', NULL, 'ya', 'assets/img/ya15.jpg', 1, 99, '2025-05-19 14:28:24', '2025-05-21 06:27:35', 100),
(16, 'Graceling', 'Kristin Cashore', NULL, 'ya', 'assets/img/ya16.jpg', 1, 100, '2025-05-19 14:28:24', '2025-05-19 15:28:06', 100),
(17, 'Six of Crows', 'Leigh Bardugo', NULL, 'ya', 'assets/img/ya17.jpg', 1, 100, '2025-05-19 14:28:24', '2025-05-19 15:28:12', 100),
(18, 'Cinder', 'Marissa Meyer', NULL, 'ya', 'assets/img/ya18.jpg', 1, 100, '2025-05-19 14:28:24', '2025-05-19 15:28:19', 100),
(19, 'The Selection', 'Kiera Cass', NULL, 'ya', 'assets/img/ya19.jpg', 1, 100, '2025-05-19 14:28:24', '2025-05-19 15:28:27', 100),
(20, 'The Giver', 'Lois Lowry', NULL, 'ya', 'assets/img/ya20.jpg', 1, 100, '2025-05-19 14:28:24', '2025-05-19 15:28:34', 100),
(22, 'Poison Study', 'Maria V. Snyder', NULL, 'ya', 'assets/img/ya22.jpg', 1, 99, '2025-05-19 14:28:24', '2025-05-21 07:36:15', 100),
(23, 'Vampire Academy', 'Richelle Mead', NULL, 'ya', 'assets/img/ya23.jpg', 1, 100, '2025-05-19 14:28:24', '2025-05-19 15:28:54', 100),
(24, 'The Golden Compass', 'Philip Pullman', NULL, 'ya', 'assets/img/ya24.jpg', 1, 100, '2025-05-19 14:28:24', '2025-05-19 15:28:58', 100),
(25, 'Sabriel', 'Garth Nix', NULL, 'ya', 'assets/img/ya25.jpg', 1, 99, '2025-05-19 14:28:24', '2025-05-21 06:49:06', 100),
(31, 'Vegetable Kingdom', 'Bryant Terry', NULL, 'cook', 'assets/img/cook1.jpg', 1, 98, '2025-05-19 14:45:54', '2025-05-23 06:46:20', 100),
(32, 'Win Son Presents a Taiwanese American Cookbook', 'Josh Ku', NULL, 'cook', 'assets/img/cook2.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:29:59', 100),
(33, 'Whole Food For Your Family', 'Autumn Michaelis', NULL, 'cook', 'assets/img/cook3.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:30:06', 100),
(34, 'Home Shores', 'Emily Scott', NULL, 'cook', 'assets/img/cook4.jpg', 1, 99, '2025-05-19 14:45:54', '2025-05-23 06:54:02', 100),
(35, 'Barbecue: Smoked & Spiced', 'Levi Roots', NULL, 'cook', 'assets/img/cook5.png', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:30:17', 100),
(36, 'BUNS: Sweet and Simple Bakes', 'Louise Hurst', NULL, 'cook', 'assets/img/cook6.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:30:22', 100),
(37, 'The Unofficial Hocus Pocus Cookbook', 'Bridget Thoreson', NULL, 'cook', 'assets/img/cook7.jpg', 1, 99, '2025-05-19 14:45:54', '2025-05-21 06:59:47', 100),
(38, 'XOXO: A Cocktail Book', 'Bridget Thoreson', NULL, 'cook', 'assets/img/cook8.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:30:32', 100),
(39, 'The Joy of Cooking', 'Irma S. Rombauer', NULL, 'cook', 'assets/img/cook9.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:30:36', 100),
(40, 'How to Cook Everything Fast', 'Mark Bittman', NULL, 'cook', 'assets/img/cook10.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:30:41', 100),
(41, 'Essentials of Classic Italian Cooking', 'Marcella Hazan', NULL, 'cook', 'assets/img/cook11.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:30:45', 100),
(42, 'The Silver Spoon', 'The Silver Spoon Kitchen', NULL, 'cook', 'assets/img/cook12.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:30:49', 100),
(43, 'Plenty', 'Yotam Ottolenghi', NULL, 'cook', 'assets/img/cook13.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:30:54', 100),
(44, 'Salt, Fat, Acid, Heat', 'Samin Nosrat', NULL, 'cook', 'assets/img/cook14.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:31:01', 100),
(45, 'The Food Lab', 'J. Kenji López-Alt', NULL, 'cook', 'assets/img/cook15.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:31:05', 100),
(46, 'The Mythical Man-Month', 'Frederick P. Brooks Jr.', NULL, 'programming', 'assets/img/prog1.jpg', 1, 97, '2025-05-19 14:45:54', '2025-05-23 10:48:55', 100),
(47, 'The Pragmatic Programmer', 'Andrew Hunt and David Thomas', NULL, 'programming', 'assets/img/prog2.jpg', 1, 99, '2025-05-19 14:45:54', '2025-05-23 10:48:58', 100),
(48, 'Clean Code', 'Robert C. Martin', NULL, 'programming', 'assets/img/prog3.jpg', 1, 99, '2025-05-19 14:45:54', '2025-05-23 10:49:01', 100),
(49, 'The Art of Computer Programming', 'Donald Knuth', NULL, 'programming', 'assets/img/prog4.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:32:12', 100),
(50, 'Structure and Interpretation of Computer Programs', 'Harold Abelson and Gerald Jay Sussman', NULL, 'programming', 'assets/img/prog5.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:32:16', 100),
(51, 'Design Patterns', 'Erich Gamma, Richard Helm, Ralph Johnson, John Vlissides', NULL, 'programming', 'assets/img/prog6.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:32:21', 100),
(52, 'Code Complete', 'Steve McConnell', NULL, 'programming', 'assets/img/prog7.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:32:25', 100),
(53, 'Refactoring', 'Martin Fowler', NULL, 'programming', 'assets/img/prog8.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:32:29', 100),
(54, 'Working Effectively with Legacy Code', 'Michael Feathers', NULL, 'programming', 'assets/img/prog9.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:32:33', 100),
(55, 'You Don\'t Know JS', 'Kyle Simpson', NULL, 'programming', 'assets/img/prog10.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:32:38', 100),
(56, 'Eloquent JavaScript', 'Marijn Haverbeke', NULL, 'programming', 'assets/img/prog11.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:32:41', 100),
(57, 'JavaScript: The Good Parts', 'Douglas Crockford', NULL, 'programming', 'assets/img/prog12.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:32:46', 100),
(58, 'Python Crash Course', 'Eric Matthes', NULL, 'programming', 'assets/img/prog13.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:32:50', 100),
(59, 'Automate the Boring Stuff with Python', 'Al Sweigart', NULL, 'programming', 'assets/img/prog14.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:32:54', 100),
(60, 'Learn Python the Hard Way', 'Zed A. Shaw', NULL, 'programming', 'assets/img/prog15.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:32:57', 100),
(62, 'Pedagogy of the Oppressed', 'Paulo Freire', NULL, 'educational', 'assets/img/edu1.jpg', 1, 98, '2025-05-19 14:45:54', '2025-05-23 10:11:12', 100),
(63, 'How Children Succeed', 'Paul Tough', NULL, 'educational', 'assets/img/edu2.jpg', 1, 99, '2025-05-19 14:45:54', '2025-05-23 10:16:28', 100),
(64, 'Dumbing Us Down', 'John Taylor Gatto', NULL, 'educational', 'assets/img/edu3.jpg', 1, 98, '2025-05-19 14:45:54', '2025-05-23 10:16:35', 100),
(65, 'Free to Learn', 'Peter Gray', NULL, 'educational', 'assets/img/edu4.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:33:48', 100),
(66, 'Left Back', 'Diane Ravitch', NULL, 'educational', 'assets/img/edu5.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:33:52', 100),
(67, 'The Smartest Kids in the World', 'Amanda Ripley', NULL, 'educational', 'assets/img/edu6.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:33:57', 100),
(68, 'Education for Extinction', 'David Wallace Adams', NULL, 'educational', 'assets/img/edu7.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:34:05', 100),
(69, 'The Education of Blacks in the South', 'James D. Anderson', NULL, 'educational', 'assets/img/edu8.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:34:09', 100),
(70, 'Advanced Composition for ESL Students', 'Bryan Ryan', NULL, 'educational', 'assets/img/edu9.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:34:13', 100),
(71, 'Assessing Writing Across the Curriculum', 'Charles R. Duke and Rebecca Sanchez', NULL, 'educational', 'assets/img/edu10.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:34:18', 100),
(72, 'Chaos in the Classroom', 'Charles R. Duke', NULL, 'educational', 'assets/img/edu11.png', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:34:24', 100),
(73, 'The Courage to Teach', 'Parker J. Palmer', NULL, 'educational', 'assets/img/edu12.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:34:31', 100),
(74, 'Teaching to Transgress', 'Bell Hooks', NULL, 'educational', 'assets/img/edu13.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 16:28:25', 100),
(75, 'The First Days of School', 'Harry K. Wong and Rosemary T. Wong', NULL, 'educational', 'assets/img/edu14.jpg', 1, 100, '2025-05-19 14:45:54', '2025-05-19 15:34:39', 100),
(77, 'Where the Wild Things Are', 'Maurice Sendak', NULL, 'children', 'assets/img/chil1.jpg', 1, 100, '2025-05-22 06:24:27', '2025-05-23 05:38:41', 100),
(78, 'The Very Hungry Caterpillar', 'Eric Carle', NULL, 'children', 'assets/img/chil2.jfif', 1, 100, '2025-05-22 06:24:27', '2025-05-23 05:41:28', 99),
(79, 'Goodnight Moon', 'Margaret Wise Brown', NULL, 'children', 'assets/img/chil3.jpg', 1, 100, '2025-05-22 06:24:27', '2025-05-23 05:41:22', 99),
(80, 'Charlotte\'s Web', 'E.B. White', NULL, 'children', 'assets/img/chil4.jpg', 1, 100, '2025-05-22 06:24:27', '2025-05-23 05:39:48', 100),
(81, 'Green Eggs and Ham', 'Dr. Seuss', NULL, 'children', 'assets/img/chil5.jpg', 1, 100, '2025-05-22 06:24:27', '2025-05-23 05:41:17', 99),
(82, 'The Cat in the Hat', 'Dr. Seuss', NULL, 'children', 'assets/img/chil6.png', 1, 100, '2025-05-22 06:24:27', '2025-05-23 05:40:00', 100),
(83, 'Matilda', 'Roald Dahl', NULL, 'children', 'assets/img/chil7.jpg', 1, 100, '2025-05-22 06:24:27', '2025-05-23 05:40:05', 100),
(84, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', NULL, 'children', 'assets/img/chil8.jpg', 1, 100, '2025-05-22 06:24:27', '2025-05-23 05:40:10', 100),
(85, 'The Gruffalo', 'Julia Donaldson', NULL, 'children', 'assets/img/chil9.jpg', 1, 100, '2025-05-22 06:24:27', '2025-05-23 05:40:15', 100),
(86, 'Don\'t Let the Pigeon Drive the Bus!', 'Mo Willems', NULL, 'children', 'assets/img/chil10.jpg', 1, 100, '2025-05-22 06:24:27', '2025-05-23 05:40:20', 100),
(87, 'Brown Bear, Brown Bear, What Do You See?', 'Bill Martin Jr.', NULL, 'children', 'assets/img/chil11.jpg', 1, 100, '2025-05-22 06:24:27', '2025-05-23 05:40:23', 100),
(88, 'The Snowy Day', 'Ezra Jack Keats', NULL, 'children', 'assets/img/chil12.jpg', 1, 100, '2025-05-22 06:24:27', '2025-05-23 05:40:27', 100),
(89, 'Oh, the Places You\'ll Go!', 'Dr. Seuss', NULL, 'children', 'assets/img/chil13.jpg', 1, 100, '2025-05-22 06:24:27', '2025-05-23 05:40:30', 100),
(90, 'Curious George', 'H.A. Rey', NULL, 'children', 'assets/img/chil14.jpg', 1, 100, '2025-05-22 06:24:27', '2025-05-23 05:40:33', 100),
(91, 'Winnie-the-Pooh', 'A.A. Milne', NULL, 'children', 'assets/img/chil15.jpg', 1, 100, '2025-05-22 06:24:27', '2025-05-23 05:40:36', 100);

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

CREATE TABLE `borrows` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrow_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `due_date` date NOT NULL,
  `return_date` timestamp NULL DEFAULT NULL,
  `status` enum('pending','approved','rejected','returned') NOT NULL,
  `admin_note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrows`
--

INSERT INTO `borrows` (`id`, `user_id`, `book_id`, `borrow_date`, `due_date`, `return_date`, `status`, `admin_note`) VALUES
(1, 2, 1, '2025-04-15 06:39:18', '2025-04-29', NULL, '', NULL),
(2, 1, 3, '2025-04-15 06:57:53', '2025-04-29', NULL, '', NULL),
(3, 1, 2, '2025-04-15 07:33:56', '2025-04-29', '2025-04-14 16:00:00', 'returned', NULL),
(4, 1, 4, '2025-04-15 07:38:16', '2025-04-29', NULL, 'rejected', NULL),
(5, 1, 5, '2025-04-15 07:43:00', '2025-04-29', NULL, 'rejected', NULL),
(6, 1, 1, '2025-04-15 07:44:38', '2025-04-29', NULL, 'rejected', NULL),
(7, 1, 1, '2025-04-15 07:44:50', '2025-04-29', '2025-04-14 16:00:00', 'returned', NULL),
(8, 1, 4, '2025-04-15 07:47:19', '2025-04-29', NULL, 'rejected', NULL),
(9, 1, 4, '2025-04-15 07:50:13', '2025-04-29', NULL, 'rejected', NULL),
(10, 1, 4, '2025-04-15 07:50:39', '2025-04-29', NULL, 'rejected', NULL),
(11, 1, 6, '2025-04-15 07:57:24', '2025-04-29', NULL, 'rejected', NULL),
(12, 1, 7, '2025-04-15 08:00:03', '2025-04-29', NULL, 'rejected', NULL),
(13, 2, 8, '2025-04-29 09:10:51', '2025-05-13', '2025-04-28 16:00:00', 'returned', NULL),
(14, 1, 3, '2025-05-05 04:02:22', '2025-05-19', '2025-05-04 16:00:00', 'returned', NULL),
(15, 1, 3, '2025-05-05 04:06:36', '2025-05-19', '2025-05-04 16:00:00', 'returned', NULL),
(16, 1, 3, '2025-05-05 04:11:53', '2025-05-19', '2025-05-04 16:00:00', 'returned', 'The books have already been borrowed and are ready for pick-up. \nAddress: 1454 Balagtas, Makati, 1204 Metro Manila\nLocation: Shelves 1 Corner Right'),
(17, 1, 2, '2025-05-05 04:46:11', '2025-05-20', NULL, 'rejected', NULL),
(18, 1, 2, '2025-05-05 05:07:46', '2025-05-20', '2025-05-04 16:00:00', 'returned', NULL),
(19, 1, 1, '2025-05-05 05:15:54', '2025-05-20', '2025-05-04 16:00:00', 'returned', NULL),
(20, 1, 1, '2025-05-05 05:17:04', '2025-05-20', '2025-05-04 16:00:00', 'returned', NULL),
(21, 1, 3, '2025-05-05 05:24:13', '2025-05-20', '2025-05-04 16:00:00', 'returned', NULL),
(22, 1, 3, '2025-05-05 05:29:19', '2025-05-20', '2025-05-04 16:00:00', 'returned', NULL),
(23, 1, 1, '2025-05-05 05:30:50', '2025-05-20', '2025-05-04 16:00:00', 'returned', NULL),
(24, 1, 2, '2025-05-05 05:41:30', '2025-05-20', '2025-05-04 16:00:00', 'returned', NULL),
(25, 2, 1, '2025-05-05 05:43:03', '2025-05-20', '2025-05-04 16:00:00', 'returned', NULL),
(26, 2, 1, '2025-05-05 06:40:49', '2025-05-20', '2025-05-04 16:00:00', 'returned', NULL),
(27, 2, 2, '2025-05-05 06:42:31', '2025-05-20', '2025-05-04 16:00:00', 'returned', NULL),
(28, 2, 3, '2025-05-05 06:44:38', '2025-05-20', '2025-05-04 16:00:00', 'returned', NULL),
(29, 2, 5, '2025-05-05 06:47:41', '2025-05-20', '2025-05-04 16:00:00', 'returned', NULL),
(30, 2, 1, '2025-05-05 06:47:48', '2025-05-20', '2025-05-04 16:00:00', 'returned', NULL),
(31, 2, 2, '2025-05-05 07:19:06', '2025-05-20', '2025-05-04 16:00:00', 'returned', NULL),
(32, 2, 1, '2025-05-05 07:19:14', '2025-05-20', '2025-05-04 16:00:00', 'returned', NULL),
(33, 1, 1, '2025-05-09 08:38:58', '2025-05-24', '2025-05-08 16:00:00', 'returned', NULL),
(34, 4, 1, '2025-05-09 08:48:19', '2025-05-24', '2025-05-08 16:00:00', 'returned', NULL),
(35, 2, 1, '2025-05-09 09:32:25', '2025-05-24', '2025-05-13 16:00:00', 'returned', NULL),
(36, 2, 1, '2025-05-16 20:23:02', '2025-06-01', '2025-05-16 16:00:00', 'returned', NULL),
(37, 2, 1, '2025-05-16 20:26:02', '2025-06-01', '2025-05-18 16:00:00', 'returned', NULL),
(38, 2, 2, '2025-05-16 20:34:04', '2025-06-01', '2025-05-18 16:00:00', 'returned', NULL),
(39, 1, 1, '2025-05-16 21:01:48', '2025-06-01', NULL, 'rejected', NULL),
(40, 1, 3, '2025-05-16 21:13:57', '2025-06-01', NULL, 'rejected', NULL),
(41, 5, 1, '2025-05-16 21:15:47', '2025-06-01', '2025-05-18 16:00:00', 'returned', NULL),
(42, 1, 2, '2025-05-19 07:08:36', '2025-06-03', NULL, 'rejected', NULL),
(43, 1, 1, '2025-05-19 07:12:48', '2025-06-03', NULL, 'rejected', NULL),
(44, 1, 2, '2025-05-19 07:13:26', '2025-06-03', NULL, 'rejected', NULL),
(45, 1, 1, '2025-05-19 07:25:19', '2025-06-03', NULL, 'rejected', NULL),
(46, 1, 2, '2025-05-19 07:31:26', '2025-06-03', NULL, 'rejected', NULL),
(47, 1, 3, '2025-05-19 08:02:23', '2025-06-03', NULL, 'rejected', NULL),
(48, 1, 4, '2025-05-19 09:56:07', '2025-06-03', NULL, 'rejected', NULL),
(49, 2, 1, '2025-05-19 10:47:09', '2025-06-03', NULL, 'rejected', NULL),
(50, 2, 2, '2025-05-19 10:47:17', '2025-06-03', NULL, 'rejected', NULL),
(51, 2, 1, '2025-05-19 10:52:30', '2025-06-03', NULL, 'rejected', NULL),
(52, 2, 2, '2025-05-19 10:52:37', '2025-06-03', NULL, 'rejected', NULL),
(53, 2, 2, '2025-05-19 10:56:57', '2025-05-26', NULL, 'rejected', NULL),
(54, 2, 1, '2025-05-19 11:00:16', '2025-05-26', NULL, 'rejected', NULL),
(55, 2, 2, '2025-05-19 11:00:23', '2025-05-26', NULL, 'rejected', NULL),
(56, 2, 1, '2025-05-19 11:05:31', '2025-05-26', NULL, 'rejected', NULL),
(57, 2, 2, '2025-05-19 11:05:35', '2025-05-26', NULL, 'rejected', NULL),
(58, 2, 3, '2025-05-19 11:05:52', '2025-05-26', NULL, 'rejected', NULL),
(59, 5, 1, '2025-05-19 11:11:56', '2025-05-26', '2025-05-18 16:00:00', 'returned', NULL),
(60, 1, 1, '2025-05-20 03:06:52', '2025-05-27', NULL, 'rejected', NULL),
(61, 1, 5, '2025-05-20 04:30:17', '2025-05-27', '2025-05-19 16:00:00', 'returned', NULL),
(62, 5, 1, '2025-05-20 04:38:31', '2025-05-27', '2025-05-20 16:00:00', 'returned', NULL),
(63, 5, 2, '2025-05-20 04:39:26', '2025-05-27', '2025-05-19 16:00:00', 'returned', NULL),
(64, 1, 2, '2025-05-20 07:06:16', '2025-05-27', '2025-05-19 16:00:00', 'returned', NULL),
(65, 1, 3, '2025-05-20 07:13:58', '2025-05-27', '2025-05-19 16:00:00', 'returned', NULL),
(66, 1, 2, '2025-05-20 07:23:32', '2025-05-27', '2025-05-19 16:00:00', 'returned', NULL),
(67, 1, 3, '2025-05-20 07:23:48', '2025-05-27', '2025-05-19 16:00:00', 'returned', NULL),
(68, 5, 3, '2025-05-21 00:09:16', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(69, 5, 8, '2025-05-21 00:09:33', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(70, 5, 22, '2025-05-21 00:12:07', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(71, 5, 62, '2025-05-21 00:16:37', '2025-05-28', NULL, 'rejected', NULL),
(72, 1, 1, '2025-05-21 00:17:45', '2025-05-28', NULL, 'rejected', NULL),
(73, 1, 2, '2025-05-21 00:21:30', '2025-05-28', NULL, 'rejected', NULL),
(74, 1, 15, '2025-05-21 00:27:35', '2025-05-28', NULL, 'rejected', NULL),
(75, 1, 3, '2025-05-21 00:32:04', '2025-05-28', NULL, 'rejected', NULL),
(76, 1, 2, '2025-05-21 00:34:38', '2025-05-28', NULL, 'rejected', NULL),
(77, 1, 64, '2025-05-21 00:35:33', '2025-05-28', NULL, 'rejected', NULL),
(78, 1, 1, '2025-05-21 00:40:02', '2025-05-28', NULL, 'rejected', NULL),
(79, 1, 4, '2025-05-21 00:42:30', '2025-05-28', NULL, 'rejected', NULL),
(80, 1, 7, '2025-05-21 00:45:11', '2025-05-28', NULL, 'rejected', NULL),
(81, 1, 25, '2025-05-21 00:49:06', '2025-05-28', NULL, 'rejected', NULL),
(82, 1, 46, '2025-05-21 00:49:56', '2025-05-28', NULL, 'rejected', NULL),
(83, 1, 9, '2025-05-21 00:52:15', '2025-05-28', NULL, 'rejected', NULL),
(84, 1, 37, '2025-05-21 00:59:47', '2025-05-28', NULL, 'rejected', NULL),
(85, 2, 2, '2025-05-21 01:15:46', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(86, 2, 3, '2025-05-21 01:17:03', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(87, 5, 31, '2025-05-21 01:21:33', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(88, 5, 5, '2025-05-21 01:29:13', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(89, 5, 5, '2025-05-21 01:50:18', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(90, 5, 2, '2025-05-21 01:57:02', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(91, 5, 4, '2025-05-21 02:04:17', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(92, 5, 1, '2025-05-21 02:06:20', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(93, 5, 2, '2025-05-21 02:07:04', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(94, 5, 1, '2025-05-21 02:14:39', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(95, 5, 2, '2025-05-21 02:19:43', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(96, 5, 5, '2025-05-21 02:27:50', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(97, 5, 6, '2025-05-21 02:28:27', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(98, 5, 1, '2025-05-21 02:39:43', '2025-05-28', '2025-05-20 16:00:00', 'returned', NULL),
(99, 5, 2, '2025-05-21 02:44:57', '2025-05-28', NULL, 'approved', NULL),
(100, 5, 1, '2025-05-21 02:55:38', '2025-05-28', NULL, 'rejected', NULL),
(101, 5, 3, '2025-05-21 02:55:43', '2025-05-28', NULL, 'rejected', NULL),
(102, 5, 4, '2025-05-21 02:55:51', '2025-05-28', NULL, 'rejected', NULL),
(103, 4, 1, '2025-05-21 22:15:33', '2025-05-29', NULL, 'rejected', NULL),
(104, 4, 2, '2025-05-21 22:15:40', '2025-05-29', NULL, 'rejected', NULL),
(105, 4, 3, '2025-05-21 22:15:48', '2025-05-29', NULL, 'rejected', NULL),
(106, 4, 4, '2025-05-21 22:15:55', '2025-05-29', NULL, 'rejected', NULL),
(107, 4, 5, '2025-05-21 22:17:15', '2025-05-29', NULL, 'rejected', NULL),
(108, 4, 1, '2025-05-21 22:19:11', '2025-05-29', NULL, 'rejected', NULL),
(109, 4, 2, '2025-05-21 22:19:18', '2025-05-29', NULL, 'rejected', NULL),
(110, 4, 3, '2025-05-21 22:19:24', '2025-05-29', NULL, 'rejected', NULL),
(111, 4, 4, '2025-05-21 22:19:31', '2025-05-29', NULL, 'rejected', NULL),
(112, 4, 1, '2025-05-21 22:36:07', '2025-05-29', NULL, 'rejected', NULL),
(113, 4, 2, '2025-05-21 22:36:15', '2025-05-29', NULL, 'rejected', NULL),
(114, 4, 3, '2025-05-21 22:36:21', '2025-05-29', NULL, 'rejected', NULL),
(115, 4, 4, '2025-05-21 22:36:29', '2025-05-29', NULL, 'rejected', NULL),
(116, 4, 1, '2025-05-21 23:11:23', '2025-05-29', NULL, 'rejected', NULL),
(117, 4, 2, '2025-05-21 23:11:31', '2025-05-29', NULL, 'rejected', NULL),
(118, 4, 3, '2025-05-21 23:11:36', '2025-05-29', NULL, 'rejected', NULL),
(119, 4, 4, '2025-05-21 23:11:42', '2025-05-29', NULL, 'rejected', NULL),
(120, 4, 1, '2025-05-21 23:13:20', '2025-05-29', NULL, 'rejected', NULL),
(121, 4, 2, '2025-05-21 23:13:26', '2025-05-29', NULL, 'rejected', NULL),
(122, 4, 3, '2025-05-21 23:13:30', '2025-05-29', NULL, 'rejected', NULL),
(123, 4, 5, '2025-05-21 23:13:37', '2025-05-29', NULL, 'rejected', NULL),
(124, 4, 1, '2025-05-21 23:15:42', '2025-05-29', NULL, 'rejected', NULL),
(125, 4, 2, '2025-05-21 23:15:47', '2025-05-29', NULL, 'rejected', NULL),
(126, 4, 3, '2025-05-21 23:15:52', '2025-05-29', NULL, 'rejected', NULL),
(127, 4, 4, '2025-05-21 23:15:57', '2025-05-29', NULL, 'rejected', NULL),
(128, 4, 1, '2025-05-21 23:18:40', '2025-05-29', NULL, 'rejected', NULL),
(129, 4, 2, '2025-05-21 23:18:44', '2025-05-29', NULL, 'rejected', NULL),
(130, 4, 3, '2025-05-21 23:18:49', '2025-05-29', NULL, 'rejected', NULL),
(131, 4, 7, '2025-05-21 23:18:57', '2025-05-29', NULL, 'rejected', NULL),
(132, 4, 4, '2025-05-21 23:20:36', '2025-05-29', NULL, 'rejected', NULL),
(133, 4, 1, '2025-05-21 23:23:15', '2025-05-29', '2025-05-21 16:00:00', 'returned', NULL),
(134, 4, 2, '2025-05-21 23:23:20', '2025-05-29', NULL, 'rejected', NULL),
(135, 4, 3, '2025-05-21 23:23:25', '2025-05-29', NULL, 'rejected', NULL),
(136, 4, 4, '2025-05-21 23:23:31', '2025-05-29', NULL, 'rejected', NULL),
(137, 4, 2, '2025-05-21 23:32:07', '2025-05-29', NULL, 'rejected', NULL),
(138, 4, 3, '2025-05-21 23:32:11', '2025-05-29', NULL, 'rejected', NULL),
(139, 4, 4, '2025-05-21 23:32:17', '2025-05-29', NULL, 'rejected', NULL),
(140, 4, 2, '2025-05-21 23:38:44', '2025-05-29', '2025-05-21 16:00:00', 'returned', NULL),
(141, 4, 6, '2025-05-21 23:38:55', '2025-05-29', '2025-05-21 16:00:00', 'returned', NULL),
(142, 4, 7, '2025-05-21 23:39:03', '2025-05-29', '2025-05-21 16:00:00', 'returned', NULL),
(143, 4, 1, '2025-05-21 23:48:41', '2025-05-29', '2025-05-22 16:00:00', 'returned', NULL),
(144, 4, 2, '2025-05-21 23:48:45', '2025-05-29', '2025-05-22 16:00:00', 'returned', NULL),
(145, 4, 3, '2025-05-21 23:48:50', '2025-05-29', '2025-05-22 16:00:00', 'returned', NULL),
(146, 4, 4, '2025-05-21 23:49:04', '2025-05-29', '2025-05-22 16:00:00', 'returned', NULL),
(147, 4, 46, '2025-05-22 00:04:47', '2025-05-29', NULL, 'rejected', NULL),
(148, 4, 82, '2025-05-22 23:29:21', '2025-05-30', NULL, 'rejected', 'Auto-rejected: User already has 3 approved books in this category.'),
(149, 4, 78, '2025-05-22 23:35:00', '2025-05-30', NULL, 'approved', NULL),
(150, 4, 79, '2025-05-22 23:35:10', '2025-05-30', NULL, 'approved', NULL),
(151, 4, 81, '2025-05-22 23:35:22', '2025-05-30', NULL, 'approved', NULL),
(152, 4, 1, '2025-05-22 23:41:57', '2025-05-30', NULL, 'pending', NULL),
(153, 4, 2, '2025-05-22 23:42:03', '2025-05-30', NULL, 'pending', NULL),
(154, 4, 3, '2025-05-22 23:42:08', '2025-05-30', NULL, 'pending', NULL),
(155, 4, 31, '2025-05-23 00:46:20', '2025-05-30', NULL, 'pending', NULL),
(156, 4, 34, '2025-05-23 00:54:02', '2025-05-30', NULL, 'pending', NULL),
(157, 4, 62, '2025-05-23 04:11:12', '2025-05-30', NULL, 'pending', NULL),
(158, 4, 63, '2025-05-23 04:16:28', '2025-05-30', NULL, 'pending', NULL),
(159, 4, 64, '2025-05-23 04:16:35', '2025-05-30', NULL, 'pending', NULL),
(160, 4, 46, '2025-05-23 04:48:55', '2025-05-30', NULL, 'pending', NULL),
(161, 4, 47, '2025-05-23 04:48:58', '2025-05-30', NULL, 'pending', NULL),
(162, 4, 48, '2025-05-23 04:49:01', '2025-05-30', NULL, 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `borrow_requests`
--

CREATE TABLE `borrow_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `request_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected','returned') NOT NULL DEFAULT 'pending',
  `approval_date` datetime DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `return_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_admin` tinyint(1) DEFAULT 0,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `phone`, `address`, `created_at`, `updated_at`, `is_admin`, `reset_token`, `reset_expires`) VALUES
(1, 'jackhole22', 'christian.madrideo@depedmakati.ph', '$2y$10$Z7FCG80wNzNgcuxvnnPZXuOxD6Q69F4jbAaQT7wYQl8509PuNbspW', 'jack', 'meribeles', NULL, NULL, '2025-04-02 15:56:09', '2025-05-21 06:59:29', 1, NULL, NULL),
(2, 'drakefanboy2', 'gresibelleyumang12@gmail.com', '$2y$10$G0Yc50gzWTrzOgkvmGnDAewtBvmUCjLEO.o0Gcg135tpAaT3x3wPu', 'drake', 'aubrey', NULL, NULL, '2025-04-04 09:55:28', '2025-05-21 09:26:29', 1, NULL, NULL),
(4, 'naitman', 'christian.madrideo11@gmail.com', '$2y$10$LVepeqZ8WQsjyeNgtUD2BegQn2AEJrXG.ANdryH2Sw8G8oYnAkpFm', 'christian', 'madrideo', NULL, NULL, '2025-05-09 14:39:58', '2025-05-21 09:27:09', 0, NULL, NULL),
(5, 'garutay', 'cmadrideo.9217@umak.edu.ph', '$2y$10$gEnZuunh7fvp3e300R6yFux9g.XhCQJEsN26B3eC0xrVCfdunyOh2', 'garutay', 'chuchu', NULL, NULL, '2025-05-17 03:15:33', '2025-05-17 03:15:33', 0, NULL, NULL),
(6, 'admin', 'admin.qwerty12@gmail.com', '$2y$10$UzJMaX7EO/JkweNVVj1.0.pnfAgqQ/fZeQYGSwPtAkndTw/agLQf.', 'admin', 'qwerty', NULL, NULL, '2025-05-23 11:37:26', '2025-05-23 11:37:26', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `borrow_requests`
--
ALTER TABLE `borrow_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `approved_by` (`approved_by`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `borrows`
--
ALTER TABLE `borrows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `borrow_requests`
--
ALTER TABLE `borrow_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `borrows_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `borrows_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Constraints for table `borrow_requests`
--
ALTER TABLE `borrow_requests`
  ADD CONSTRAINT `borrow_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `borrow_requests_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `borrow_requests_ibfk_3` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
