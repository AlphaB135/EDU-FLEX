-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 08:31 PM
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
-- Database: `education_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `pages` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default-book.jpg',
  `category_id` int(11) DEFAULT NULL,
  `is_popular` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'ม.ต้น'),
(2, 'ม.ปลาย'),
(3, 'มหาวิทยาลัย');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `instructor` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default-course.jpg',
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `is_popular` tinyint(1) NOT NULL DEFAULT 0,
  `orders` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `instructor`, `description`, `price`, `duration`, `image`, `category_id`, `subcategory_id`, `is_popular`, `orders`) VALUES
(3, 'รวมวิชาพื้นฐาน ม.ปลาย', '-', 'ชีววิทยา ภาษาอังกฤษ และภาษาไทย เพื่อเตรียมตัวสำหรับการสอบเข้าเรียนต่อมหาวิทยาลัยหรือเพิ่มเกรดในโรงเรียน', 9000.00, '12', '2.png', 1, NULL, 0, 0),
(5, 'TGAT2 การคิดอย่างมีเหตุผล', '-', 'TGAT2 การคิดอย่างมีเหตุผลติวกับกูรูขั้นเทพ ครบทั้งเนื้อหา แนวโจทย์ และเทคนิคเพิ่มคะแนนทั้ง 3 พาร์ต', 9000.00, '12', '1.png', 2, NULL, 0, 0),
(6, 'TGAT3 สมรรถนะการทำงาน', '-', 'ติวกับกูรูขั้นเทพ ครบทั้งเนื้อหา แนวโจทย์ และเทคนิคเพิ่มคะแนนทั้ง 3 พาร์ต', 99999999.99, '12', '1.png', 2, NULL, 1, 0),
(7, 'NETSAT โควตา ม.ขอนแก่น ', '-', '- คอร์สนี้จะเน้นการตะลุยโจทย์มากถึง 100 ข้อ เสริมด้วยเทคนิคต่างๆจากครู ทำให้น้องเข้าใจง่าย สอบได้จริง รวมถึงสรุปเนื้อหาที่ควรรู้ในทุกบทที่ออกสอบ\r\n- ข้อสอบอัปเดตล่าสุดจากสนาม NETSAT ปี 2/2566 พร้อมเฉลยละเอียดครบทุกข้อ\r\n', 60000.00, '12', '4.png', 2, NULL, 1, 0),
(8, 'A-level Biology', '-', 'คอร์สนี้ สอนเนื้อหาและตะลุยโจทย์สำหรับนักเรียนระดับชั้น ม.ปลาย ไม่จำเป็นต้องมีพื้นฐาน ก็สามารถเรียนได้เพราะเราเน้นสอนเนื้อหาสำคัญอย่างละเอียด สรุปเนื้อหาสำคัญ มีทริคและเทคนิกช่วยจำ พร้อมเฉลยละเอียดข้อสอบทุกข้อเนื้อหาข้างใน พี่วิเวียนเน้นตะลุยโจทย์เข้ามหาวิทยาลัย อาทิ วิชาสามัญ, PAT2 และอื่นๆ มั่นใจแน่ๆ ว่าทำถึงข้อสอบ A-level ปีนี้มากๆ โดยมีจำนวนโจทย์ในเล่มมากกว่า 1,800 ข้อ และตำรา A4 เขียนฟิน จดไม่สะดุด ซื้อแพ็คนี้ พี่วิเวียนมี Biology Box Set และ Study Planner สวยๆ + Mock วิชา A-Level ชีววิทยา (Computer-based) จาก Tcaster แจกให้ฟรี!!', 10000.00, '12', '5.png', 2, NULL, 1, 0),
(9, 'เสริมคะแนน ฟิสิกค์ ม.ปลาย', '-', '- สอนเนื้อหาอย่างละเอียด เข้มข้น พร้อมยกตัวอย่างโจทย์ประกอบเห็นภาพ\r\n- ใช้ Supermap พาเรียนเพื่อความเข้าใจและเห็นภาพของเนื้อหา\r\n- วิดีโอทบทวนเนื้อหาพื้นฐานที่ควรรู้ก่อนเรียนผ่านทาง QR Code', 1333.00, '12', '6.png', 2, NULL, 1, 0),
(10, 'Pack เคมี TCAS สำหรับ DEK69', '-', '- สำหรับน้อง ม.ปลาย เตรียมตัวสอบแข่งขัน A-Level วิชาเคมี\r\n- เหมาะกับน้องที่มีพื้นฐานเนื้อหา ม.ปลาย\r\n- เน้นสรุปเนื้อหาอย่างเข้มข้น เพื่อเตรียมตัวสอบเข้ามหาวิทยาลัย\r\n- ใช้เทคนิค K-Tips เรียนเคมีให้เห็นภาพ เน้นเข้าใจ ไม่เน้นท่องจำ เก็บทุกคะแนนสอบ\r\n- โจทย์จากข้อสอบจริง วิชาสามัญ PAT2 A-level พร้อมข้อสอบเก่าย้อนหลังตั้งแต่ปี 2530 ถึงปัจจุบัน พร้อมเทคนิคการทำโจทย์ที่ไม่เหมือนใครจากพี่เคน รวมโจทย์ทั้งหมดมากกว่า 2000 ข้อ', 1220.00, '12', '7.png', 2, NULL, 1, 0),
(11, 'Pack คณิตศาสตร์ ม.4 เทอม 1  ', '-', '-', 1200.00, '12', '8.png', 2, NULL, 1, 0),
(12, 'Math Admissions TCAS', '-', '- เน้นสรุปเนื้อหาคณิตศาสตร์ ม.4 - ม.6 อย่างเข้มข้น เพื่อเตรียมตัวสอบเข้ามหาวิทยาลัย\r\n- อัพเดตข้อสอบแนวประยุกต์ตามหลักสูตร สสวท.\r\n- รวบรวมแนวข้อสอบมากกว่า 3,000 ข้อ\r\n- เนื้อหาการสอนข้อสอบที่ครอบคลุม พร้อมด้วยเทคนิค A Point ให้น้องๆ ทำโจทย์ได้ทุกแนวสนามสอน', 12000.00, '12', '9.png', 1, NULL, 1, 0),
(13, 'Pack English TCAS Success', '-', '- คอร์สเดียวคุ้ม ครบทุกเนื้อหาและตะลุยโจทย์ทุกสนามทั้ง TGAT, A-Level Eng ให้พร้อมสู่การสอบเข้ามหาวิทยาลัย\r\n- Update เนื้อหาและแนวโจทย์ปีล่าสุดของข้อสอบ TGAT Eng และ A-Level Eng\r\n- เนื้อหาและโจทย์ครอบคลุมทั้งในสนามสอบ TGAT Eng และ A-Level Eng\r\n- เพิ่มกฎทอง ต้องจำได้กับ Premier Tips ที่รวบรวมมาจากข้อสอบปีแรกจนถึงปีล่าสุดของทั้ง 2 สนาม\r\n- แนวข้อสอบจริง 2 ชุดของแต่ละสนามให้น้องได้ฝึกประยุกต์กฎเหล็กที่เรียนมา', 1200.00, '12', '10.png', 2, NULL, 1, 0),
(14, 'Tgat', 'b', 'adaa', 121.00, '12', '481563829_1190369299102884_639233939744261936_n.jpg', 1, NULL, 0, 0),
(15, 'หมาไม่แดกคอร์ส', 'ฟหร้ิกด', '่วน่่วสา', 2200.00, '24', '481563829_1190369299102884_639233939744261936_n.jpg', 2, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','completed','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_type` enum('course','book') DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','admin') DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `fk_subcategory` (`subcategory_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_subcategory` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
