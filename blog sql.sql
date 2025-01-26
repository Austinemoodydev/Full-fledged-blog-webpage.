-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2025 at 12:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Category 1'),
(2, 'Category 2'),
(3, 'Category 3'),
(4, 'Category 4'),
(5, 'Category 5'),
(6, 'Category 6'),
(7, 'Category 7'),
(8, 'Category 8'),
(9, 'Category 9'),
(10, 'Category 10');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `author`, `created_at`, `category_id`, `category`) VALUES
(2, 'STEPS TO BECAME A PROFFESSIONAL PROGRAMMER', '1. Learn the Basics of Web Development\r\nHTML: Understand how to structure web pages with HTML (HyperText Markup Language).\r\nCSS: Learn how to style and lay out web pages using CSS (Cascading Style Sheets).\r\nJavaScript: Master the basics of JavaScript to make your websites interactive.\r\n2. Get Comfortable with Developer Tools\r\nFamiliarize yourself with browser developer tools (DevTools) like Chrome DevTools.\r\nLearn how to inspect elements, debug JavaScript, and test your website on different screen sizes.\r\n3. Understand Version Control (Git)\r\nLearn Git to manage your code. It’s essential for collaborating with other developers.\r\nPlatforms like GitHub or GitLab are important for sharing your work and collaborating on open-source projects.\r\n4. Learn Responsive Web Design\r\nMaster the concepts of responsive web design to make your websites work well on desktops, tablets, and mobile devices.\r\nUnderstand media queries and frameworks like Bootstrap or Tailwind CSS.\r\n5. Dive Deeper into JavaScript\r\nOnce you\'re comfortable with the basics, explore advanced topics like asynchronous JavaScript (Promises, async/await), closures, and ES6+ features.\r\nUnderstand how JavaScript interacts with the Document Object Model (DOM).\r\n6. Learn Front-End Frameworks\r\nLearn a front-end framework/library to speed up development and create more dynamic user interfaces.\r\nPopular options: React.js, Vue.js, or Angular.\r\n7. Explore Back-End Development\r\nLearn a back-end programming language (Node.js, Python, Ruby, PHP, etc.).\r\nUnderstand databases (SQL, MongoDB, PostgreSQL) and how to interact with them using server-side code.\r\nLearn how to build RESTful APIs or GraphQL.\r\n8. Master Development Tools & Workflow\r\nGet comfortable using task runners (Webpack, Gulp) and bundlers to streamline your workflow.\r\nLearn testing frameworks (Jest, Mocha) to ensure your code is working as expected.\r\nExplore continuous integration/continuous deployment (CI/CD) pipelines to automate deployment.\r\n9. Work on Personal Projects\r\nBuild projects to practice and showcase your skills. It could be a portfolio website, a to-do list app, or a personal blog.\r\nReal-world projects will help you apply your learning and give you practical experience.\r\n10. Get Involved in the Web Development Community\r\nJoin online communities (Reddit, Stack Overflow, Twitter, Discord) to stay updated, ask questions, and share knowledge.\r\nContribute to open-source projects to learn from others and build your portfolio.\r\n11. Learn About Web Security\r\nStudy the basics of web security (cross-site scripting, SQL injection, HTTPS, etc.).\r\nUnderstand how to protect user data and build secure websites.\r\n12. Stay Up-to-Date with Trends\r\nWeb development is a constantly evolving field. Follow blogs, attend conferences, and take part in online courses to keep learning new techniques and technologies.\r\n13. Build a Strong Portfolio\r\nCreate a portfolio to showcase your work. It should include your projects, resume, and any other relevant information about your skills.\r\nMake sure your portfolio is well-designed, responsive, and easy to navigate.\r\n14. Find Internships or Freelance Opportunities\r\nStart with internships or freelance gigs to gain real-world experience.\r\nBuild relationships and connections with other developers, clients, and potential employers.\r\n15. Apply for Full-Time Jobs\r\nOnce you’ve gained experience and built a portfolio, start applying for full-time positions as a web developer.\r\nPrepare for technical interviews, coding challenges, and system design questions.\r\nBonus Tips:\r\nNetworking: Don’t underestimate the power of networking. Attend meetups, conferences, and online webinars to meet other developers and potential employers.\r\nSoft Skills: Effective communication, problem-solving, and time management are critical in the tech industry.\r\nContinuous Learning: Web development is an ever-changing field, so always be open to learning new languages, frameworks, and best practices.', 'MOODY AUSTINE', '2025-01-26 09:19:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','contributor') DEFAULT 'contributor',
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `role`, `password`, `email`) VALUES
(1, 'moodyaustine477@gmail.comm', '', 'contributor', '$2y$10$le8FKoM/ZDzDAleI.VuFOeUumkiGMwOw70MXpOVr0mJavvw5YU1ai', ''),
(2, 'moodyaustine6@gmail.comm', '', 'admin', '$2y$10$eoGcJ3f3ZnR3hJ5/G9ekjuO.Hc4R.Xpdq07vfvg.M8DHhR9eZquza', ''),
(3, 'moodyaustine6@gmail.com', '', 'admin', '$2y$10$XgDfYfBqosNIZryoGN03Nu.dOumf6JsrC1qrxw3Olq2KGACjI97Iu', ''),
(5, 'atieno', '', 'contributor', '$2y$10$1bZvoskpJae9XbaAGpwdFOKhGuFY5mlN62LHcPTi50IwEuhCKXGWS', ''),
(6, 'MOODY AUSTINE', '', 'admin', '$2y$10$xwddnFCAVOgr2MxlPybyh.vu0UuE7ISnO9RqYde/EGrVq9uRkRwlK', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
