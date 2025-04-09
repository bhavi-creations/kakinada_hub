-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 07:49 AM
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
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `about` text DEFAULT NULL,
  `map_url` text DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `no_of_employees` int(11) DEFAULT NULL,
  `experience_years` int(11) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `company_images` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `email`, `phone`, `address`, `about`, `map_url`, `category`, `no_of_employees`, `experience_years`, `website`, `logo`, `company_images`, `created_at`) VALUES
(2, 'TCS', 'tcs@gmail.com', '9239423432', 'vizag', NULL, 'https://www.google.com/maps/dir/16.9834286,82.2506434/INOX+Movies(SRMT),+INOX+Leisure+Ltd.,+3rd+Floor,+82%C2%B0+East+SRMT+Mall+%26+Multiplex,+Ramanayya+Peta,+Sarpavaram,+Kakinada+-+533005,+Andhra+Pradesh/@16.9898052,82.2360282,15z/data=!3m1!4b1!4m12!1m2!2m1!1sINOX!4m8!1m1!4e1!1m5!1m1!1s0x3a382944ec9e5f5b:0x2356059d79408404!2m2!1d82.243297!2d16.9980821?entry=ttu&g_ep=EgoyMDI1MDMzMC4wIKXMDSoJLDEwMjExNDUzSAFQAw%3D%3D', 'IT', 233, 12, 'https://srinivasadentalkakinada.com/', '1743575037_tcs.jpg', '1743575037_download (4).jpeg,1743575037_download (3).jpeg,1743575037_download (2).jpeg', '2025-04-02 06:23:57'),
(3, 'bhavi', 'bhavicreations@gmail.com', '9239423434', 'kakinada', 'bhavi cretions company', 'https://www.google.com/maps/dir//Plot+no+28,+H+No+70,+17-28,+RTO+Office+Rd,+opposite+to+New,+behind+J.N.T.U.Engineering+College+Play+Ground,+Ranga+Rao+Nagar,+Kakinada,+Andhra+Pradesh+533003/@16.9834056,82.2094508,13z/data=!4m8!4m7!1m0!1m5!1m1!1s0x3a3829915d3063a9:0x357d06d49d4e389a!2m2!1d82.2506066!2d16.9834178?entry=ttu&g_ep=EgoyMDI1MDMzMC4wIKXMDSoJLDEwMjExNjQwSAFQAw%3D%3D', 'digital marketing ', 15, 3, 'https://bhavicreationspvtltd.com/', '1743575200_Bhavi pvt ltd logo[1].png', '1743575200_Holi-Event-Organisers-in-Gurgaon.png,1743575200_holi 3.jpeg,1743575200_holi 1.jpeg', '2025-04-02 06:26:40'),
(4, 'srinivasa dental', 'bhavicreations3022@gmail.come', '213', 'ew', '2', 'https://www.google.com/maps/dir/16.9834286,82.2506434/INOX+Movies(SRMT),+INOX+Leisure+Ltd.,+3rd+Floor,+82%C2%B0+East+SRMT+Mall+%26+Multiplex,+Ramanayya+Peta,+Sarpavaram,+Kakinada+-+533005,+Andhra+Pradesh/@16.9898052,82.2360282,15z/data=!3m1!4b1!4m12!1m2!2m1!1sINOX!4m8!1m1!4e1!1m5!1m1!1s0x3a382944ec9e5f5b:0x2356059d79408404!2m2!1d82.243297!2d16.9980821?entry=ttu&g_ep=EgoyMDI1MDMzMC4wIKXMDSoJLDEwMjExNDUzSAFQAw%3D%3D', 'health care', 3, 2, 'https://srinivasadentalkakinada.com/', '1743578704_srmt_mall.jpeg', '1743578704_vaccetion.jpeg,1743578704_booked.jpeg,1743578704_rentals.jpeg', '2025-04-02 07:25:04');

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
(1, 'aD', '3uFKWSiuGKES9MyfJCPsHT-1280-80.jpg.webp', '2025-03-27 11:35:46', 'lower'),
(2, 'add 1', 'toothbrushes-dental-hygiene-tools-white-background.jpg', '2025-03-28 04:12:08', 'upper'),
(3, 'add 3', '3uFKWSiuGKES9MyfJCPsHT-1280-80.jpg.webp', '2025-03-28 04:14:28', 'lower'),
(4, 'ff', '1743505281_toothbrushes-dental-hygiene-tools-white-background.jpg', '2025-04-01 11:01:21', 'upper');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `vacancies` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `company_id`, `job_title`, `vacancies`, `created_at`) VALUES
(1, 2, 'software', 3, '2025-04-02 06:54:07'),
(2, 2, 'full stack', 2, '2025-04-02 06:54:28'),
(3, 2, 'front end', 2, '2025-04-02 06:58:00'),
(5, 3, 'it', 3, '2025-04-02 07:11:18'),
(6, 4, 'reception', 2, '2025-04-02 07:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `marquee_texts`
--

CREATE TABLE `marquee_texts` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marquee_texts`
--

INSERT INTO `marquee_texts` (`id`, `text`, `created_at`) VALUES
(1, 'Get All Your Discounts At One Place IN Kakinada Hub', '2025-04-04 09:24:36'),
(2, 'Happy Ugadhi', '2025-04-04 09:24:36'),
(3, 'Get All Discounts Here', '2025-04-04 09:24:36'),
(4, 'We Are Launching Soon', '2025-04-04 09:24:36'),
(5, 'Hello World !', '2025-04-04 09:26:17'),
(7, 'welcomes you', '2025-04-04 09:39:19');

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
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `offer` varchar(255) DEFAULT NULL,
  `type` enum('upper','lower') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `title`, `description`, `image`, `link`, `offer`, `type`, `created_at`) VALUES
(2, 'apple', 'Up to 50% off 1000s of items at Under Armour - Don\'t miss  p to 50% off 1000s of items at Under Armour - Don\'t miss  ', 'images (6).jpeg', 'https://srinivasadentalkakinada.com/', '  discount sale ', 'lower', '2025-04-04 06:46:10'),
(3, 'mango', 'Up to 50% off 1000s of items at Under Armour - Don\'t miss Up to 50% off 1000s of items at Under Armour - Don\'t miUp to 50% off 1000s of items at Under Armour - Don\'t miss out, ...', 'tcs.jpg', 'https://bhavicreationspvtltd.com/', ' flash sale ', 'upper', '2025-04-04 06:54:26'),
(4, 'nike', 'get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels ', 'nike.png', 'https://bhavicreationspvtltd.com/', '  discount sale ', 'upper', '2025-04-04 07:01:01'),
(5, 'addidas', 'get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels ', 'adida.png', 'https://srinivasadentalkakinada.com/', ' flash sale ', 'upper', '2025-04-04 07:01:19'),
(6, 'crocos', 'get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels ', 'Crocs-logo.jpg', 'https://srinivasadentalkakinada.com/', ' flash sale ', 'upper', '2025-04-04 07:01:35'),
(7, 'lenskart', 'get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels ', 'lenskart.png', 'https://bhavicreationspvtltd.com/', '  discount sale ', 'upper', '2025-04-04 07:02:00'),
(8, 'kfc', 'get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels ', 'kfc.png', '', '  discount sale ', 'lower', '2025-04-04 07:03:13'),
(9, 'SRMT', 'get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels ', 'srmt_mall.jpeg', 'https://srinivasadentalkakinada.com/', ' flash sale ', 'lower', '2025-04-04 07:03:32'),
(10, 'Kritunga', 'get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels ', 'kritunga.jpeg', 'https://srinivasadentalkakinada.com/', '  discount sale ', 'lower', '2025-04-04 07:03:50'),
(11, 'BBQ', 'get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels get upto 10 % discount on the spectial sale of ugadhi and on also upcoming festivels ', 'bbq.png', 'https://srinivasadentalkakinada.com/', '  discount sale ', 'lower', '2025-04-04 07:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('For Rent','For Sale','For Lease') NOT NULL,
  `category` enum('Commercial','Residential') NOT NULL,
  `price` int(11) DEFAULT NULL,
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

INSERT INTO `properties` (`id`, `title`, `type`, `category`, `price`, `location`, `size_sqft`, `bedrooms`, `bathrooms`, `furnishing_status`, `amenities`, `image`, `description`, `created_at`, `images`, `phone`) VALUES
(54, 'sales building', 'For Sale', 'Commercial', 3300000, 'kkd', 22555, 2, 2, 'Unfurnished', 'Parking', '1742887299_download (6).jpeg', 'tata', '2025-03-25 07:21:39', '1742887299_images (7).jpeg,1742887299_images (6).jpeg,1742887299_images (5).jpeg,1742887299_download (6).jpeg', '9876543321'),
(55, 'f', 'For Sale', 'Residential', 1200, 'ddd', 2, 2, 2, 'Unfurnished', 'Parking', '1742893760_download (5).jpeg', 'd', '2025-03-25 09:09:20', '1742893760_download (4).jpeg,1742893760_download (3).jpeg,1742893760_download (2).jpeg', '9239423432'),
(56, 'induvdial huse', 'For Rent', 'Residential', 8000, 'vakalapudi', 22200, 2, 3, 'Unfurnished', 'Parking', '1743762261_download (6).jpeg', 'call us for more details ', '2025-04-04 10:24:21', '1743762261_images (7).jpeg,1743762261_images (6).jpeg,1743762261_images (5).jpeg', '9879870987'),
(57, 'sample', 'For Sale', 'Residential', 1200, 'kkd', 23223, 2, 2, 'Unfurnished', 'Parking', '1743769051_automobile-model-is-silver-car-with-black-interior.jpg', '3r', '2025-04-04 12:17:31', '1743769051_off-road-car-fantasy-scenario.jpg,1743769051_download (1).jpeg,1743769051_download.jpeg', '9239423432'),
(58, 'storew', 'For Rent', 'Residential', 1200, 'ddd', 2, 3, 2, 'Semi-Furnished', 'Security', '1743769317_automobile-model-is-silver-car-with-black-interior.jpg', 'er', '2025-04-04 12:21:57', '1743769317_images (7).jpeg,1743769317_images (6).jpeg', '9239423432'),
(59, 'land', 'For Lease', 'Commercial', 1200, 'rjy', 67687, 0, 0, 'Furnished', 'aa', '1743827030_automobile-model-is-silver-car-with-black-interior.jpg', 'fyuyu', '2025-04-05 04:23:50', '1743827030_images (7).jpeg,1743827030_images (6).jpeg', '456456'),
(60, 'car', 'For Rent', 'Commercial', 90000, 'kkd', 2333, 2, 0, 'Unfurnished', 'swiming', '1743828006_Holi-Event-Organisers-in-Gurgaon.png', 'te', '2025-04-05 04:40:06', '1743828006_holi 3.jpeg,1743828006_holi 1.jpeg,1743828006_holi.jpeg,1743828006_spandhana.jpeg', '9239423432'),
(61, 'ccs', 'For Sale', 'Commercial', 1200, 'cc', 333, 3, 3, 'Unfurnished', 'w', '1743831878_sangeeth.png', 'cc', '2025-04-05 05:44:38', '1743831878_automobile-model-is-silver-car-with-black-interior.jpg', '33');

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
  `name` varchar(100) NOT NULL,
  `filter_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travels`
--

INSERT INTO `travels` (`id`, `name`, `filter_image`, `created_at`) VALUES
(3, 'Car Bookings', 'car-body-parts-side-view-automotive-car-parts-such-as-window-wheel-tire-headlight-side-mirror-side (1).jpg', '2025-04-02 12:05:02'),
(7, 'Hiring', 'download (3).jpeg', '2025-04-03 03:53:49'),
(8, 'Car Rentals', 'download (1).jpeg', '2025-04-03 04:50:17');

-- --------------------------------------------------------

--
-- Table structure for table `travel_details`
--

CREATE TABLE `travel_details` (
  `id` int(11) NOT NULL,
  `travel_id` int(11) NOT NULL,
  `model` varchar(100) DEFAULT NULL,
  `seating_capacity` int(11) DEFAULT NULL,
  `fuel_efficiency` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `price_per_6hrs` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travel_details`
--

INSERT INTO `travel_details` (`id`, `travel_id`, `model`, `seating_capacity`, `fuel_efficiency`, `price`, `name`, `age`, `gender`, `experience`, `price_per_6hrs`, `image`, `created_at`) VALUES
(2, 7, NULL, NULL, NULL, NULL, 'raja', 27, 'Male', 5, 600.00, 'rental.jpeg', '2025-04-03 00:24:31'),
(3, 3, 'innnova', 7, '12', 1200.00, NULL, NULL, NULL, NULL, NULL, 'download (4).jpeg', '2025-04-03 01:10:21'),
(5, 7, NULL, NULL, NULL, NULL, 'ram', 22, 'Male', 2, 600.00, 'automobile-model-is-silver-car-with-black-interior.jpg', '2025-04-03 01:11:45'),
(6, 8, ' swift', 4, '12', 1200.00, NULL, NULL, NULL, NULL, NULL, 'download.jpeg', '2025-04-03 01:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `trending`
--

CREATE TABLE `trending` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `offer` varchar(255) DEFAULT NULL,
  `type` enum('upper','lower') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trending`
--

INSERT INTO `trending` (`id`, `title`, `description`, `image`, `link`, `offer`, `type`, `created_at`) VALUES
(4, 'maxfit', 'this is the smaple', 'images (5).jpeg', 'https://bhavicreationspvtltd.com/', '⭐ discount sale ', 'upper', '2025-04-04 05:01:56'),
(5, 'tata', 'nothing', 'download (6).jpeg', 'https://bhavicreationspvtltd.com/', '⭐ flash sale ', 'lower', '2025-04-04 05:02:21'),
(6, 'nike ', 'thisis the sample', 'automobile-model-is-silver-car-with-black-interior.jpg', 'https://bhavicreationspvtltd.com/', '⭐ flash sale ', 'upper', '2025-04-04 05:58:33'),
(7, 'tere', 'saag wqet qq  q gr g4g', 'images (7).jpeg', 'https://bhavicreationspvtltd.com/', ' flash sale ', 'upper', '2025-04-04 06:02:55'),
(8, 'rre', 'qrhg3 43q t43t3q4t43t    ggreg geg', 'rental.jpeg', 'https://bhavicreationspvtltd.com/', ' flash sale ', 'upper', '2025-04-04 06:03:14'),
(9, 'ree wgq ', 'erht rthtrhtreh tr hh rt h hrth w erht rthtrhtreh tr hh rt h hrth w erht rthtrhtreh tr hh rt h hrth w erht rthtrhtreh tr hh rt h hrth w erht rthtrhtreh tr hh rt h hrth w erht rthtrhtreh tr hh rt h hrth w erht rthtrhtreh tr hh rt h hrth w erht rthtrhtreh tr hh rt h hrth w', 'rentals.jpeg', 'https://srinivasadentalkakinada.com/', ' flash sale ', 'upper', '2025-04-04 06:05:39'),
(10, 'notiing', 'Up to 50% off 1000s of items at Under Armour - Don\'t miss out, ...', 'download (2).jpeg', 'https://srinivasadentalkakinada.com/', '  discount sale ', 'lower', '2025-04-04 06:06:42'),
(11, 'ggh', 'Up to 50% off 1000s of items at Under Armour - Don\'t miss\r\n                                 out, ...', 'holi 3.jpeg', 'https://srinivasadentalkakinada.com/', '  discount sale ', 'lower', '2025-04-04 06:07:01'),
(12, 'max', 'Up to 50% off 1000s of items at Under Armour - Don\'t miss\r\n                                 out, ...', 'portrait-3d-doctors-hospital-attire.jpg', 'https://bhavicreationspvtltd.com/', '  discount sale ', 'lower', '2025-04-04 06:07:23'),
(13, 'fddf', 'Up to 50% off 1000s of items at Under Armour - Don\'t miss\r\n                                 out, ...', 'e04cf887-696b-43c0-9c55-7ae1c10e5f5c.jpeg', 'https://srinivasadentalkakinada.com/', ' flash sale ', 'lower', '2025-04-04 06:07:56');

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
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_ads`
--
ALTER TABLE `home_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `marquee_texts`
--
ALTER TABLE `marquee_texts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `screen_id` (`screen_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `travel_details`
--
ALTER TABLE `travel_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `travel_id` (`travel_id`);

--
-- Indexes for table `trending`
--
ALTER TABLE `trending`
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
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `home_ads`
--
ALTER TABLE `home_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `marquee_texts`
--
ALTER TABLE `marquee_texts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `travel_details`
--
ALTER TABLE `travel_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trending`
--
ALTER TABLE `trending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

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

--
-- Constraints for table `travel_details`
--
ALTER TABLE `travel_details`
  ADD CONSTRAINT `travel_details_ibfk_1` FOREIGN KEY (`travel_id`) REFERENCES `travels` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
