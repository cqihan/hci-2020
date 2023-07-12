-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 09, 2020 at 12:15 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `environment`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(5) NOT NULL,
  `place_id` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `comment_content` varchar(2048) NOT NULL,
  `comment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `place_id`, `username`, `comment_content`, `comment_date`) VALUES
(1, 1, 'anson', 'sdfghj', '2020-10-16 14:07:02'),
(2, 1, 'anson', 'waestrryutj', '2020-10-16 14:07:53'),
(3, 1, 'anson', 'dsfghj', '2020-10-16 14:09:50'),
(4, 1, 'anson', 'erty4ur', '2020-10-16 14:15:50'),
(5, 1, 'anson', 'dgfhjgk', '2020-10-16 14:16:24'),
(6, 1, 'anson', 'dgfhju', '2020-10-16 14:17:29'),
(7, 1, 'anson', 'sdfgthj', '2020-10-16 14:17:35'),
(8, 1, 'anson', 'dsfgdh', '2020-10-16 14:18:48'),
(9, 1, 'anson', 'dsgfh', '2020-10-16 14:19:31'),
(10, 1, 'anson', 'eertth', '2020-10-16 14:25:10'),
(11, 1, 'anson', 'sdtfyh', '2020-10-16 14:25:58'),
(12, 1, 'anson', 'dfdhgfjk', '2020-10-16 14:26:02'),
(13, 1, 'anson', 'dryuti', '2020-10-16 15:58:12'),
(14, 2, 'anson', 'nice air & water quality', '2020-11-09 19:08:27'),
(15, 6, 'anson', 'One of the best place to visit for outdoor activities with family', '2020-11-09 19:11:37');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(3) NOT NULL,
  `event_name` varchar(128) NOT NULL,
  `location` varchar(256) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` varchar(64) NOT NULL,
  `contact_no` varchar(16) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `deadline` date NOT NULL,
  `picture` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `event_name`, `location`, `event_date`, `event_time`, `contact_no`, `description`, `deadline`, `picture`) VALUES
(1, 'Handmade Soap Making Workshop (Christmas Theme)', 'Reiki Refuge:\r\n55, Jalan Hujan Emas 4,\r\nTaman OUG,\r\nKuala Lumpur, WP Kuala Lumpur 58200', '2020-12-20', '10:00 AM-1:00 PM', '012-3456789', 'Make your own soap using all natural ingredients and establish a sustainable lifestyle while contributing to the care of our planet!', '2020-12-21', 'img/handmadesoap.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `event_id` int(3) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `place_id` int(3) NOT NULL,
  `place_name` varchar(100) NOT NULL,
  `place_address` varchar(256) NOT NULL,
  `working_hours` varchar(256) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `picture` varchar(128) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`place_id`, `place_name`, `place_address`, `working_hours`, `contact_no`, `description`, `picture`, `state`) VALUES
(1, 'Setia Eco Cascadia', 'Wisma S P Setia, 1, Jalan Setia 3/6, Taman Setia Indah, 81100 Johor Bahru, Johor', 'Monday-Friday: 9:00am-6:00pm\nSaturday-Sunday: 10:00am-6:00pm', '073512255', 'In an effort to create a natural and holistic ecosystem, 15% of the total land area in Setia Eco Cascadia is reserved for the cultivation of flora. The town parks of Setia Eco Cascadia allow the residents to experience a deeper connection with Mother Nature. Pebbled walkways shaded by tall, leafy trees, impeccably manicured landscapes and picture perfect views are among the many fascination that can be found in these green paradise. Each principal in Setia Eco Cascadia is served by private, resident-only pool house. Facilities like swimming pool, gymnasiums and many more are available for the residents to enjoy every day.', 'img/908175118setia-eco-cascadia-tea-party_compilation1.jpg', 'Johor'),
(2, 'Tropicana Aman Central Park', 'Jalan Bukit Komandol, 41200, Selangor', '6:00a.m.-9:00p.m.', 'N/A', 'The main focus of this development is well, an impressive 85-acre park. Dubbed the Central Park, the park is surrounded by a 100-feet tree-line boulevard which immediately makes the surrounding homes and living spaces feel greener and more immersed in nature. The 7km biking and running trails that flank the neighbourhood provides a great impetus for people to take to the outdoors and live an active lifestyle in a conducive environment.\r\n\r\nThe beautiful pavilions that dot the landscape also provide impetus for you to do these outdoor activities with other members of the community as they are great places to take a breather and to have a chat in between a run or biking.', 'Central Park.jpg', 'Selangor'),
(3, 'Taman Jaya Park', 'Jalan Merah 3/6, Taman Jaya, 54500 Petaling Jaya, Selangor\r\ndsfdgbhfn', '9:00am-6:00pm', '05446255638', 'Taman Jaya is an icon in Petaling Jaya and has been around for a long time. It\'s a lovely area for people of all ages. There is a man made lake in the centre where you can walk/jog around. There is a playground and also an exercising area. Very enjoyable and easy to get access to from the LRT station. There are 2 entry points by car and both have car parks.', 'img/1337383762426085.jpg', 'Selangor'),
(4, 'Eco Spring Park, Tebrau', '1, Jalan Ekoflora Utama, 81100 Johor Bahru, Johor', 'Monday-Friday: 9:00a.m.-6:00p.m.\r\nSaturday-Sunday: 10:00a.m.-6:00p.m.', '073642552', 'Built on a sizeable plot of 400-acre land, Eco Spring features 460 units of a mix of two-storey homes, semi-detached houses and bungalows. Most developments by Eco World tend to have some focus on eco-friendly fixtures and amenities and this would be no different.\r\n\r\nFor one thing, the development boasts a garden concept where an impressive 13% of its land area has been allocated for greenery. The concept of the development is rooted in the idea of spring, with boulevards lined with luscious trees and separate lanes for pedestrian and cycling, which encourages more outdoor activities amongst its residents. This idea continues with the availability of a sports and recreational facility for residents that features an outdoor fitness deck, gymnasium, basketball and futsal courts and even an outdoor skating rink.', 'eco-spring.jpg', 'Johor'),
(5, 'Sejati Residences', 'No1, Jalan Sejati 1, Sejati Residences, Persiaran Bestari, Cyberjaya, 63000 Cyberjaya, Selangor', 'Monday-Friday: 9:00a.m.-5:00p.m.\r\nSaturday-Sunday: 10:00a.m.-5:00p.m.', '0186056000', 'Spread over 50 acres of natural, undulating greens, Sejati Residences have implemented these top eco-friendly features:\r\n\r\nOxygen-giving trees to act as natural air filters and sunshades\r\nRainwater harvesting for watering gardens\r\nWell-insulated and ventilated roof space to reduce heat gain\r\nHeat resistant paint for the exterior wall\r\nNatural cross-ventilation through well-positioned windows to reduce cooling costs\r\nHigh energy-saving hot water system\r\nWater-saving aerated tap and dual flush system', 'SejatiResidences.jpg', 'Selangor'),
(6, 'Leisure Farm Resort', 'Jalan Tanjung Kupang, Kampung Tiram, 81550 Gelang Patah, Johor', 'N/A', '078691001', 'Spanning across 1765 acres of lush verdant land, Leisure Farm is home to an award-winning range of well designed estates and residences complemented by world-class amenities. First established in 1991 as a haven for the mind, body and soul, Leisure Farm is now home to a truly international community.', 'LeisureFarm.jpg', 'Johor'),
(7, 'KLCC Park', 'Jalan Ampang, Kuala Lumpur City Centre, 50088 Kuala Lumpur, Federal Territory of Kuala Lumpur', '7:00a.m.-10:00p.m.', '0323822828', 'The KLCC Park is an urban park in Kuala Lumpur City Centre, Kuala Lumpur, Malaysia. The park has been designed to provide greenery to Petronas Twin Towers and the areas surrounding it.\r\n\r\nThe park was designed to showcase a heritage of tropical greenery by integrating man\'s creation with nature. The park itself contrasts as a calm environment in the midst of the hustle and bustle of the city. The park features many combinations of man-made design such as cements, water features and also natural features such as trees, shrubs, stones and wood. Elements of shape and topography were created to give an illusion of space. The combination of trees, shrubs and sculptures were arranged to provide color and form to the park.', 'KLCCPark.jpg', 'Kuala Lumpur'),
(8, 'Maya Park, Eco Ardence', '40170, Persiaran Setia Alam, Setia Alam, 40170 Shah Alam, Selangor', '6:00am-11:00pm', '0374992552', 'Do you know that : Eco Ardence is an eco-themed, gated and guarded, mixed-development township, spanning a massive 533 acres. Within the township there is several development spanning from residential, leisure and commercial areas. This is where the creation of art, the expression of culture and the innovation of commerce converge, inspiring a sense of pride and belonging in the community. The motto is “Re-imagining Shah Alam”. This eco-township a joint venture between Eco World Development Group Bhd and Cascara Sdn Bhd.', 'Maya Park.jpg', 'Selangor');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `username` varchar(50) NOT NULL,
  `place_id` int(3) NOT NULL,
  `waste_management_rating` int(1) NOT NULL,
  `air_quality_rating` int(1) NOT NULL,
  `water_quality_rating` int(1) NOT NULL,
  `biodiversity_rating` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`username`, `place_id`, `waste_management_rating`, `air_quality_rating`, `water_quality_rating`, `biodiversity_rating`) VALUES
('anson', 1, 4, 4, 3, 4),
('anson', 2, 4, 5, 5, 3),
('anson', 3, 4, 2, 3, 4),
('anson', 4, 4, 4, 4, 3),
('anson', 5, 4, 3, 3, 3),
('anson', 6, 5, 5, 5, 4),
('anson', 7, 5, 3, 4, 2),
('anson', 8, 5, 4, 4, 3),
('ansonlim', 2, 5, 5, 4, 3),
('ansontan', 1, 3, 4, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(128) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `fullname`, `password`, `image`, `email`) VALUES
('anson', 'Anson Wong', 'anson', 'img/11063228752108863.jpg', 'anson99wya@gmail.com'),
('ansonlee', 'Anson Lee', 'ansonlee', 'img/1514314274Step3.PNG', 'ansonlee@gmail.com'),
('ansonLim', 'Anson Lim', 'ansonlim', 'img/976038912S1.PNG', 'ansonlim@gmail.com'),
('ansontan', 'Anson Tan', 'ansontan', 'img/12440042531926117.png', 'ansontan@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id` (`place_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`event_id`,`username`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`username`,`place_id`),
  ADD KEY `place_id` (`place_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `place_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `participant_ibfk_2` FOREIGN KEY (`username`) REFERENCES `rating` (`username`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
