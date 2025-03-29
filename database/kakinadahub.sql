-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2025 at 04:58 AM
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
-- Database: `kakinadahub`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `main_content` text NOT NULL,
  `full_content` text NOT NULL,
  `title_image` varchar(255) NOT NULL,
  `main_image` varchar(255) NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `main_content`, `full_content`, `title_image`, `main_image`, `video`, `service`, `created_at`) VALUES
(59, 'Tooth Extraction', '<p>Tooth Extraction <span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">is a common dental procedure performed for various reasons, such as severe tooth decay, damage, or crowding</span></p>', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Tooth extraction is often needed when a tooth becomes severely decayed, fractured, or impacted. It may also be required for crowded teeth, gum disease, or dental injuries. Tooth luxation, a condition where the tooth is loosened from its socket, is another common reason for extraction.</span></p><p><strong style=\"color: rgb(33, 154, 2); background-color: transparent;\">Sedation During Extraction</strong></p><p><br></p><p><span style=\"color: rgb(0, 0, 0); background-color: transparent;\">For your comfort, several sedation options are available, including nitrous oxide (laughing gas), oral conscious sedation, and intravenous sedation. These help ease dental anxiety, making your experience more relaxed and pain-free.</span></p><p><br></p>', '', '67d2cf48d2bde_1741868872.png', '67d2cf48d2c10_1741868872.mp4', 'Tooth Extraction', '2025-03-13 12:27:52'),
(60, 'A Permanent Solution for Missing Teeth', '<h3><strong>What Are Dental Implants?</strong></h3><p>Dental implants are a long-lasting and natural-looking solution for replacing missing teeth. Unlike dentures or bridges, implants are surgically placed into the jawbone, acting as artificial tooth roots that support crowns, bridges, or dentures. Made from biocompatible titanium, dental implants integrate with the bone over time, ensuring a secure and stable foundation for replacement teeth.</p>', '<h3><strong>Benefits of Dental Implants</strong></h3><p>One of the biggest advantages of dental implants is their durability—they can last a lifetime with proper care. They also prevent bone loss, maintain facial structure, and function just like natural teeth, allowing you to eat and speak comfortably. Additionally, implants improve confidence by providing a natural-looking smile without the discomfort or instability of traditional dentures.</p>', '', '67d2d27f61100_1741869695.jpg', '67d2d27f61135_1741869695.mp4', 'Dental Implant', '2025-03-13 12:41:35'),
(61, 'Restoring Your Oral Health', '<h3><strong>Understanding the Importance of Gum Surgery</strong></h3><p>Gum surgery is a crucial dental procedure used to treat severe gum diseases like periodontitis and correct gum recession. When bacteria accumulate beneath the gums, they cause inflammation, leading to gum and bone loss. If left untreated, this can result in tooth mobility and even loss. Gum surgery helps remove infected tissue, deep-clean the gums, and restore a healthy foundation for your teeth.</p>', '<h3><strong>Types of Gum Surgery and Their Benefits</strong></h3><p>There are different types of gum surgery, depending on the severity of the issue. <strong>Flap surgery</strong> involves lifting the gums to clean deep pockets, while <strong>gum grafting</strong> covers exposed tooth roots using tissue from another area of the mouth. These procedures not only improve oral health but also enhance aesthetics, reduce tooth sensitivity, and prevent further gum recession. Proper aftercare, including good oral hygiene and regular dental visits, ensures successful healing and long-term benefits.</p>', '', '67d2d286ad627_1741869702.jpg', '67d2d286ad65a_1741869702.mp4', 'Gum Surgery', '2025-03-13 12:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `home_ads`
--

CREATE TABLE `home_ads` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` enum('upper','lower') NOT NULL DEFAULT 'upper'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_ads`
--

INSERT INTO `home_ads` (`id`, `title`, `image`, `created_at`, `type`) VALUES
(1, 'aD', '1743135363_3uFKWSiuGKES9MyfJCPsHT-1280-80.jpg.webp', '2025-03-27 11:35:46', 'lower'),
(2, 'add 1', '1743135128_3uFKWSiuGKES9MyfJCPsHT-1280-80.jpg.webp', '2025-03-28 04:12:08', 'upper'),
(3, 'add 3', '1743135268_3uFKWSiuGKES9MyfJCPsHT-1280-80.jpg.webp', '2025-03-28 04:14:28', 'lower');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `duration` time NOT NULL,
  `start_time` time NOT NULL,
  `images` text DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `about_movie` text DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `producer` varchar(255) DEFAULT NULL,
  `musician` varchar(255) DEFAULT NULL,
  `hero` varchar(255) DEFAULT NULL,
  `heroin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `screen_id`, `movie_name`, `duration`, `start_time`, `images`, `genre`, `language`, `rating`, `about_movie`, `director`, `producer`, `musician`, `hero`, `heroin`, `created_at`) VALUES
(1, 4, 'ff', '14:01:00', '20:06:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-27 10:53:49'),
(7, 9, 'jadhoo', '03:04:00', '03:40:00', '67e62766c4a9a.jpeg,67e62766c4c6a.jpeg,67e62766c4dc0.jpeg', 'action', 'telugu', 5.0, 'rrr', 'raja', 'dil raju', 'rahaman', 'ram', 'wrrre', '2025-03-27 11:40:40'),
(8, 8, 'ttre', '03:00:00', '17:43:00', '67e54476242f5.jpeg,67e544762456f.jpeg', 'drama', 'hindi', 3.0, '', '', '', '', '', '', '2025-03-27 12:13:31'),
(9, 5, 'chaavan', '01:01:00', '13:07:00', '1743143850_67e643aa24e02.png,1743143850_67e643aa24ff8.jpeg,1743143850_67e643aa25215.jpg', 'drama', 'english', 4.5, '3g', 'raja', 'dil raju', 'rahaman', 'ramo', 'kajal', '2025-03-28 06:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('For Rent','For Sale','For Lease') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `location` varchar(255) NOT NULL,
  `size_sqft` int(11) NOT NULL,
  `bedrooms` int(11) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `furnishing_status` enum('Furnished','Semi-Furnished','Unfurnished') NOT NULL,
  `amenities` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `images` text NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `title`, `type`, `price`, `location`, `size_sqft`, `bedrooms`, `bathrooms`, `furnishing_status`, `amenities`, `image`, `description`, `created_at`, `images`, `phone`) VALUES
(54, 'sales building', 'For Sale', 3300000.00, 'kkd', 22555, 2, 2, 'Unfurnished', 'Parking', '1742887299_download (6).jpeg', 'tata', '2025-03-25 07:21:39', '1742887299_images (7).jpeg,1742887299_images (6).jpeg,1742887299_images (5).jpeg,1742887299_download (6).jpeg', '9876543321'),
(55, 'f', 'For Sale', 1200.00, 'ddd', 2, 2, 2, 'Unfurnished', 'Parking', '1742893760_download (5).jpeg', 'd', '2025-03-25 09:09:20', '1742893760_download (4).jpeg,1742893760_download (3).jpeg,1742893760_download (2).jpeg', '9239423432');

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `id` int(11) NOT NULL,
  `theater_id` int(11) NOT NULL,
  `screen_name` varchar(255) NOT NULL,
  `screen_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`id`, `theater_id`, `screen_name`, `screen_image`) VALUES
(4, 6, 'screen 1', '1743070154_download (5).jpeg'),
(5, 6, 'screen 2', '1743070194_rental.jpeg'),
(6, 8, 'screen 1', '1743070450_spandhana.jpeg'),
(7, 8, 'screen 3', 'sddefault.jpg'),
(8, 9, 'raja', '1743071599_sangeeth.png'),
(9, 9, 'ratnam', '1743071608_tirumala.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `page_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `created_at`, `page_name`) VALUES
(1, 'Movies', 'movies', '2025-03-22 06:34:28', 'movies.php'),
(2, 'Resturents', 'resturents', '2025-03-22 06:35:03', 'service_details.php'),
(3, 'Saloons & Spa', 'saloons-&-spa', '2025-03-22 06:35:18', 'service_details.php'),
(4, 'Gifts & Jewellery', 'gifts-&-jewellery', '2025-03-22 06:35:27', 'gifts.php'),
(5, 'Fashion', 'fashion', '2025-03-22 06:35:36', 'fashion.php'),
(6, 'Hospitals', 'hospitals', '2025-03-22 06:35:45', 'hospitals.php'),
(7, 'Sports & Gym', 'sports-&-gym', '2025-03-22 06:35:53', 'sports.php'),
(8, 'Kids & Babies', 'kids-&-babies', '2025-03-22 06:37:16', 'kids.php'),
(9, 'Jobs', 'jobs', '2025-03-22 06:37:26', 'jobs.php'),
(10, 'Events', 'events', '2025-03-22 06:37:31', 'events.php'),
(11, 'Travel', 'travel', '2025-03-22 06:37:37', 'travel.php'),
(12, 'Properties', 'properties', '2025-03-22 06:37:42', 'properties.php');

-- --------------------------------------------------------

--
-- Table structure for table `theaters`
--

CREATE TABLE `theaters` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theaters`
--

INSERT INTO `theaters` (`id`, `name`, `image`, `location`, `created_at`) VALUES
(6, 'cnc', 'download (6).jpeg', 'kkd', '2025-03-27 07:07:51'),
(8, 'inox', '1743070238_Holi-Event-Organisers-in-Gurgaon.png', 'kkd', '2025-03-27 10:10:38'),
(9, 'devi', '1743071576_mayuri.png', 'kkd', '2025-03-27 10:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `travels`
--

CREATE TABLE `travels` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `seating_capacity` int(11) DEFAULT NULL,
  `fuel_efficiency` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travels`
--

INSERT INTO `travels` (`id`, `type`, `model`, `seating_capacity`, `fuel_efficiency`, `price`, `image`, `created_at`) VALUES
(10, 'For driver', 'swift', 5, '12km', 5555.00, '1742971970_download (3).jpeg', '2025-03-26 06:52:50'),
(12, 'For Rent', 'swift', 6, '12km', 1.00, '1742989750_download (4).jpeg', '2025-03-26 11:49:10'),
(13, 'For Rent', 'innnova', 6, '12km', 1200.00, '1743048336_download (5).jpeg', '2025-03-27 04:05:36'),
(14, 'For Marriages', 'Crytsa', 7, '7', 4000.00, '1743053229_download (5).jpeg', '2025-03-27 05:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`) VALUES
(5, 'bhavi', 'creations', 'bhavicreations@gmail.com', '600c304331ed6847dd108dea621d56ea', '2024-11-12 11:08:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_ads`
--
ALTER TABLE `home_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `screen_id` (`screen_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theater_id` (`theater_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `theaters`
--
ALTER TABLE `theaters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travels`
--
ALTER TABLE `travels`
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
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `home_ads`
--
ALTER TABLE `home_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `theaters`
--
ALTER TABLE `theaters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `travels`
--
ALTER TABLE `travels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`screen_id`) REFERENCES `screens` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `screens`
--
ALTER TABLE `screens`
  ADD CONSTRAINT `screens_ibfk_1` FOREIGN KEY (`theater_id`) REFERENCES `theaters` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
