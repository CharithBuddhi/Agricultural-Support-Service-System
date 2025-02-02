-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2025 at 04:13 AM
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
-- Database: `myagro`
--

-- --------------------------------------------------------

--
-- Table structure for table `agrochemical`
--

CREATE TABLE `agrochemical` (
  `agro_id` int(11) NOT NULL,
  `agro_category` varchar(20) NOT NULL,
  `fertilizer_category` varchar(20) NOT NULL,
  `fertilizer_type` varchar(25) NOT NULL,
  `agro_name` varchar(50) NOT NULL,
  `iso_id` varchar(20) NOT NULL,
  `sls_id` varchar(20) NOT NULL,
  `agro_image` varchar(100) NOT NULL,
  `agro_location` varchar(50) NOT NULL,
  `agro_area` varchar(20) NOT NULL,
  `agro_district` varchar(20) NOT NULL,
  `shop_name` varchar(50) NOT NULL,
  `agro_description` varchar(800) NOT NULL,
  `agro_price` decimal(11,2) NOT NULL,
  `commission` decimal(11,2) NOT NULL,
  `total_quantity` decimal(11,2) NOT NULL,
  `agro_quantity` decimal(11,2) NOT NULL,
  `meassure` varchar(10) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agrochemical`
--

INSERT INTO `agrochemical` (`agro_id`, `agro_category`, `fertilizer_category`, `fertilizer_type`, `agro_name`, `iso_id`, `sls_id`, `agro_image`, `agro_location`, `agro_area`, `agro_district`, `shop_name`, `agro_description`, `agro_price`, `commission`, `total_quantity`, `agro_quantity`, `meassure`, `supplier_id`) VALUES
(1, 'fertilizer', 'Straight', 'Nitrogen', 'Sulphate of Ammonia', '22000', '640', 'Sulphate-of-Ammonia.png', 'd/33 Digala Road,Dikella', 'Padawala', 'Ampara', 'Agripari', 'Sulphate of Ammonia is a quick acting, nitrogen fertilizer which encourages green and leafy growth. It is especially beneficial for crops such as lettuce, spinach, leeks and onions. As a water-soluble fertilizer, Sulphate of ammonia is extensively used for crop production because it provides efficient nitrogen and readily available Sulphur which aids in plant growth. The high-quality Sulphate of Ammonia Fertilizer from Hayleys Fertilizer is paramount in the maintenance of healthy soil and vibrant crop growth.', 350.00, 7.00, 150.00, 25.00, 'Kg', 4),
(2, 'fertilizer', 'Specialty', 'Seaweed', 'Algae Solid Star', '22000', '640', 'Algae-Solid-Star.png', 'D/33 Digala Road,Dikella', 'Iranamadu', 'Kilinochchi', 'Agripari', 'Unlock the full potential of your crops with “Vigore,” the world’s No. 1 yield enhancer designed to deliver superior results in both quality and quantity. This exclusive product is dedicated to boosting agricultural productivity, aiming to address global food scarcity by maximizing crop production on available land.', 350.00, 7.00, 45.00, 5.00, 'Kg', 4),
(3, 'fertilizer', 'Straight', 'Nitrogen', 'Sulphate of Ammonia', '22000', '640', 'Sulphate-of-Ammonia.png', 'd/33 Digala Road,Dikella', 'Dehiowita', 'Anuradhapura', 'MyAgro', 'dasads', 350.00, 7.00, 99.00, 1.00, 'Kg', 4),
(4, 'fertilizer', 'Straight', 'Phosphorous', 'High Grade Eppawala Rock Phosphate', '22000', '640', 'High-Grade-ERP.png', 'No 25, Haton Road', 'Awissawella', 'Kegalle', 'Agro Mart', 'HERP is a locally available cheap source of Phosphorous fertilizer, manufactured from Eppawela Rock Phosphate. ', 15000.00, 300.00, 400.00, 50.00, 'Kg', 5),
(5, 'fertilizer', 'Specialty', 'Phosphorous', 'Triple Super Phosphate – TSP', '22000', '640', 'TSP.png', 'No 25, Noori Road', 'Deraniyagala', 'Kegalle', 'Agro Place', 'TSP has the highest P content of dry fertilizers that don’t contain nitrogen (N). Over 90 percent of the total P in TSP is water soluble, so it becomes rapidly available for plant uptake. As soil moisture dissolves the granule, the concentrated soil solution becomes acidic. TSP also contains 15 percent calcium (Ca), providing an additional plant nutrient. A major use of TSP is in situations where several solid fertilizers are blended together for broadcasting on the soil surface or for application in a concentrated band beneath the surface. It’s also desirable for fertilization of leguminous crops, such as alfalfa or beans, where no additional N fertilization is needed to supplement biological N fixation.', 8500.00, 170.00, 350.00, 50.00, 'Kg', 4),
(6, 'fertilizer', 'Straight', 'Potassium', 'Sulphate of Potash – SOP', '22000', '640', 'SOP.png', 'No 25, Noori Road', 'Deraniyagala', 'Kegalle', 'Agro Place', 'SOP is considered a premium-quality potash. It contains two key nutrients for growing crops: potassium and sulfur. Using SOP improves both quality and crop yield and makes plants more resilient to drought, frost, insects and even disease. SOP has been known to improve the look and taste of foods and can boost a plant’s ability to absorb key nutrients like phosphorus and iron. \r\n\r\nMost often, SOP is used on high-value crops like fruits, vegetables, nuts, tea, coffee and tobacco. It works better on crops that are sensitive to chloride, which can be toxic to some fruit and vegetable plants. ', 6000.00, 120.00, 500.00, 50.00, 'Kg', 5),
(7, 'fertilizer', 'Straight', 'Calcium', 'Dolomite', '22000', '640', 'Dolomite.png', 'No 25, Haton Road', 'Awissawella', 'Kegalle', 'Agro Mart', 'A premium calcium and magnesium-rich soil enhancer for stressed crops with 100% organic calcium fertilizer and magnesium.', 180.99, 3.61, 48.00, 1.00, 'Kg', 5),
(8, 'fertilizer', 'Specialty', 'NPK Compound', 'NPK Prime', '22000', '640', 'NPK-Prime.png', '456/ Madu road,Maduknda', 'Madukanda', 'Vavuniya', 'Agro Mart', 'RATIO : 18 : 06 : 18 + S + MG', 320.99, 6.41, 7.50, 2.50, 'Kg', 4),
(10, 'fertilizer', 'Garden', 'Vegetables', 'Home Garden Vegetable', '22000', '640', 'Home-garden-vegetable.png', 'd/33 Digala Road,Dikella', 'Ahaliyagoda', 'Ratnapura', 'MyAgro', 'Ratio : 13 : 07 : 12', 450.12, 9.00, 8.00, 2.00, 'Kg', 4),
(11, 'fertilizer', 'Garden', 'Vegetables', 'Home Garden Chilli', '22000', '640', 'Home-garden-chilli.png', 'No78,Main road,kalpitiya stand', 'Kalpitiya', 'Puttalam', 'New Agro', 'Ratio : 12 : 09 : 09.\r\nEspecially beneficial for Chilli cultivation', 352.48, 7.04, 15.00, 2.50, 'Kg', 5),
(12, 'fertilizer', 'Garden', 'Flowers', 'Home Garden Flower', '22000', '640', 'black_home_flower.png', 'No 456, Main Road, Moanarathenna', 'Monarathenna', 'Polonnaruwa', 'Agro Mart', 'Ratio : 10 : 13 : 12.\r\nSuitable for any kind of flowering plants.', 356.00, 7.12, 12.00, 2.00, 'Kg', 4),
(13, 'fertilizer', 'Garden', 'Coconut', 'Home Garden APM (W)', '22000', '640', 'Home-Garden-APM.png', 'No 25, Haton Road', 'Hakgala', 'Nuwara Eliya', 'MyAgro', 'Ratio : 11: 08 : 29.\r\nEspecially for adult coconut and king coconut palms.', 125.99, 2.51, 4.00, 1.00, 'Kg', 5),
(14, 'fertilizer', 'Garden', 'Export Crops', 'Home Garden T-65', '22000', '640', 'Home-garden-T-65.png', 'No78,Main road,Vadduvakal', 'Vadduvakal', 'Mullaitivu', 'Agripari', 'RATIO : 11 : 11 : 11 : 04', 1500.00, 30.00, 10.00, 2.00, 'Kg', 4),
(15, 'fertilizer', 'Garden', 'Fruits', 'ZN Sulphate', '22000', '640', 'Zn-Sulphate.png', 'No 25, Bibila Road,Bus Stand', 'Bibila', 'Monaragala', 'Agro Mart', 'Home Garden ZN SULPHATE : 22% ZN', 300.00, 6.00, 80.00, 2.00, 'Kg', 4),
(16, 'fertilizer', 'Blended', 'Tea Mixtures', 'ST/UM 400', '22000', '640', 'STUM-400.png', 'No 25, Palaruwa Main Road', 'Palaruwa', 'Monaragala', 'New Agro', 'ST/UM 400\r\nRATIO : 22.5 : 06.2 : 17.6', 300.00, 6.00, 10.00, 1.00, 'Kg', 5),
(19, 'chemical', 'Insecticides', 'Thrips', 'Hayleys Profenophos', '22000', '640', 'Hayleys-Pofenofos.png', 'No 823, digala road,sewanagala', 'Aguruwella', 'Ampara', 'MyAgrPari', 'An emulsifiable concentrate which is a contact and stomach insecticide / acaricide for the control of insect pests.', 450.99, 9.00, 50.00, 1.00, 'Liter', 5),
(21, 'chemical', 'Insecticides', 'Thrips', 'X ven', '22000', '645', 'markzole-1-300x300.jpg', 'No 28, bus stand, nope', 'Nope', 'Ampara', 'Agro Mart', 'bred', 2900.00, 58.00, 45.00, 5.00, 'Liter', 4),
(22, 'chemical', 'Fungicides', 'Blast', 'Folicur Tebuconazole', '22000', '640', 'Folicur-Tebuconazole-1.png', 'N0 25, Churche Road', 'Kalpitiya', 'Anuradhapura', 'AgroMart', 'Folicur® EW 250 is a fungicidal compound with a broad-spectrum systemic action that can be used as a foliar spray or seed-dressing. Folicur® has excellent plant compatibility, provides reliable efficacy over a period of several weeks, and controls numerous pathogens in various crops.', 650.00, 13.00, 6.00, 0.25, 'Liter', 4),
(23, 'chemical', 'Weedicides', 'Sedges', 'Kairo Pretilachlor', '', '645', 'Kairo-Pretilachlor-1.png', 'No 28, bandarawela town', 'Bandarawela', 'Badulla', 'MyAgro', 'Herbicide / Weedicide for grasses, broad leaves and sedges.', 550.00, 11.00, 5.00, 0.10, 'Liter', 4),
(24, 'chemical', 'Organic', 'Diamondback Moth', 'Success', '78421', '8912', 'Success.png', 'No 28, bandarawela town', 'Bandarawela', 'Badulla', 'MyAgro', 'Spinosad is a new type of biological insecticide that is derived from the fermentation of Saccharopolyspora spinosa. Spinosad is highly effective for the control of insect pests.', 150.00, 3.00, 1.00, 0.25, 'Liter', 4);

-- --------------------------------------------------------

--
-- Table structure for table `controlprice`
--

CREATE TABLE `controlprice` (
  `price_id` int(11) NOT NULL,
  `crop_category` varchar(30) NOT NULL,
  `crop_name` varchar(50) NOT NULL,
  `varieties_name` varchar(50) NOT NULL,
  `min_price` float(10,2) NOT NULL,
  `max_price` float(10,2) NOT NULL,
  `pervious_min_price` float(11,2) NOT NULL,
  `pervious_max_price` float(11,2) NOT NULL,
  `commission` float(11,2) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `controlprice`
--

INSERT INTO `controlprice` (`price_id`, `crop_category`, `crop_name`, `varieties_name`, `min_price`, `max_price`, `pervious_min_price`, `pervious_max_price`, `commission`, `create_date`, `update_date`) VALUES
(121, 'Vegetable', 'Carrot', 'Lanka Carrot', 161.66, 176.36, 0.00, 0.00, 10.00, '2024-10-09', '2024-10-09'),
(122, 'Vegetable', 'Sweet Potato', 'Wariyapola Red', 54.47, 59.43, 0.00, 0.00, 2.00, '2024-10-09', '2024-10-09'),
(123, 'Vegetable', 'Brinjal', 'Amanda F1', 153.29, 167.23, 0.00, 0.00, 8.00, '2024-10-09', '2024-10-09'),
(124, 'Vegetable', 'Sweet Potato', 'Wariyapola White', 147.17, 149.85, 0.00, 0.00, 7.00, '2024-10-12', '2024-10-12'),
(125, 'Vegetable', 'Cabbage', 'Green Coronet', 212.74, 257.74, 0.00, 0.00, 15.00, '2024-10-13', '2024-10-13'),
(126, 'Fruit', 'strawberry', 'Elan F1', 600.52, 643.41, 1308.63, 1353.75, 75.00, '2025-01-09', '2025-01-09'),
(127, 'Fruit', 'Pineapple', 'Muritious', 89.61, 98.72, 96.07, 104.42, 9.00, '2025-01-09', '2025-01-09'),
(128, 'Fruit', 'Orange', 'Bibile Sweet', 109.73, 109.73, 106.65, 116.35, 5.13, '2025-01-12', '2025-01-12'),
(129, 'Fruit', 'banana', 'Abul', 476.11, 519.39, 0.00, 0.00, 9.57, '2025-01-14', '2025-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(80) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `customer_address` varchar(150) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_telno` bigint(10) NOT NULL,
  `images` varchar(255) NOT NULL,
  `customer_status` tinyint(1) NOT NULL DEFAULT 0,
  `create_time` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `username`, `password`, `customer_address`, `customer_email`, `customer_telno`, `images`, `customer_status`, `create_time`) VALUES
(6, 'ishan awishka', 'malidu', '$2y$10$n2OfOReWafdW7wtK6o08Juc0hEW7DRyGYca7qBaQiBS4Nbn3xJBX.', 'digala, dikella, dehiowoita', 'rbcharitha160@gmail.com', 94717235416, 'men.jpg', 0, '2024-08-12 08:28:25'),
(7, 'Rashmi Tharushika', 'Rashmi', '$2y$10$CScoYVgQ56z7UGp9AHYFD.7S4.lrc7NedvccHZjiZ..to0YscumfO', 'D/33/1/C/ Digala Road, Dikella', 'cbuddhika3000@gmail.com', 94717235416, '1731308675_hasitha.PNG', 0, '2024-10-12 05:26:23'),
(15, 'charitha buddhika rajakarunaa', 'buddhika', '$2y$10$TXeDxP3DSqylxeWYdyQ8IujSvRj3PloS95uJAJAemeOBuFlpU0qhe', 'Dikella,Dehiowia, kegalle', 'badsnake122@gmail.com', 94717235458, '1736828129_10dcf0285149b453a270fa119b5b1567.jpg', 0, '2024-12-25 08:26:23'),
(20, 'dewanga maheshi', 'dewnga', '$2y$10$DQaZ574YXqVLOkXHhvXW4OQU1S/VOrHEYaF3G.oMPTyfF6OrqzX0m', 'Deraniyagla, Nasewana', 'rbcharitha163@gmail.com', 94757575757, '1736251265_dwanga.PNG', 0, '2025-01-07 17:29:48'),
(25, 'Nuwantha Rajakaruna', 'nimntha', '$2y$10$0woYgDGwsth1fjDSusXXpuWfxgzxoEwyqVjFSAFsEfKfP8dG3UBTG', 'Colombo 8', 'badsnake1212@gmail.com', 94717235416, '', 0, '2025-01-14 09:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `farmer_id` int(11) NOT NULL,
  `farmer_name` varchar(80) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `farmer_nic` bigint(12) NOT NULL,
  `farmer_email` varchar(50) NOT NULL,
  `farmer_address` varchar(100) NOT NULL,
  `farmer_phone` bigint(11) NOT NULL,
  `farmer_proof` varchar(150) NOT NULL,
  `images` varchar(255) NOT NULL,
  `bank_name` varchar(25) NOT NULL,
  `account_name` varchar(80) NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `branch_name` varchar(25) NOT NULL,
  `farmer_status` tinyint(1) NOT NULL DEFAULT 0,
  `response` int(11) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` varchar(25) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`farmer_id`, `farmer_name`, `username`, `password`, `farmer_nic`, `farmer_email`, `farmer_address`, `farmer_phone`, `farmer_proof`, `images`, `bank_name`, `account_name`, `account_no`, `branch_name`, `farmer_status`, `response`, `create_time`, `update_time`) VALUES
(1, 'Ishan Avishka Rajakruna', 'ishan', '$2y$10$hCJi7pjfSPYLnJhW9BQ.rO1X71h0HvTm1pT0MabZWAk0FLwfVLBgW', 200200605164, 'badsnake@gmail.com', 'Dikella,Dehiowia', 94726990663, 'home (3).jpg', '1736763380_p.jpg', 'Bank of Ceylon ', 'Rajakaruna  Ishan Awishka', '27458963', 'Kegalle', 0, 20078, '2024-11-28 16:18:34', '2025-01-14 09:49:36'),
(23, 'Nuwantha Rajakaruna', 'hasitha', ' $2y$10$RYIWUXO.UvGOzzdIlVwF7umjUUXrHY9kg0IB.qi40dq7iFWFHsQ2a', 200602200164, 'buddhika111@gmail.com', 'Colombo 8', 94717235416, '2.PNG', '', '', '', '', '', 0, 789, '2025-01-13 18:10:42', '2025-01-13 18:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `harvest`
--

CREATE TABLE `harvest` (
  `harvest_id` int(11) NOT NULL,
  `crop_name` varchar(50) NOT NULL,
  `crop_variety` varchar(50) NOT NULL,
  `yala_start` date NOT NULL,
  `yala_end` date NOT NULL,
  `maha_start` date NOT NULL,
  `maha_end` date NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `harvest`
--

INSERT INTO `harvest` (`harvest_id`, `crop_name`, `crop_variety`, `yala_start`, `yala_end`, `maha_start`, `maha_end`, `create_time`) VALUES
(14, 'Brinjal', 'Amanda F1', '2024-01-01', '2024-02-29', '2024-07-01', '2024-09-09', '2024-10-13 00:54:23'),
(15, 'Beetroot', 'Beta vulgaris', '2024-02-01', '2024-05-31', '2024-08-01', '2024-09-30', '2024-10-13 00:54:23'),
(16, 'Cabbage', 'Green Coronet', '2024-01-01', '2024-04-30', '2024-07-01', '2024-10-31', '2024-10-13 00:54:23'),
(17, 'Radish', 'Beeralu Rabu', '2024-01-01', '2024-01-31', '2024-11-01', '2024-11-30', '2024-10-13 00:54:23'),
(18, 'Capsicum', 'Gannoruwa Prarthana (F1)', '2024-02-09', '2024-03-09', '2024-09-06', '2024-10-09', '2024-10-13 00:54:23'),
(20, 'Okra', 'Haritha', '2024-02-01', '2024-03-30', '2024-09-01', '2024-10-31', '2024-10-13 00:54:23'),
(21, 'Sweet Potato', 'Wariyapola Red', '2024-01-01', '2024-02-29', '2024-08-01', '2024-09-30', '2024-10-13 00:54:23'),
(22, 'Sweet Potato', 'Wariyapola White', '2024-01-01', '2024-02-29', '2024-08-01', '2024-09-30', '2024-10-13 00:54:23'),
(23, 'Sweet Potato', 'Gannoruwa White', '2024-01-18', '2024-02-29', '2024-08-15', '2024-10-07', '2024-10-13 00:54:23'),
(24, 'Carrot', 'Lanka Carrot', '2024-02-01', '2024-04-30', '2024-08-20', '2024-11-30', '2024-10-13 00:54:23'),
(25, 'strawberry', 'Elan F1', '2024-02-05', '2024-03-15', '2024-08-06', '2024-09-09', '2024-12-01 15:34:59'),
(26, 'Pineapple', 'Muritious', '2025-02-01', '2025-04-30', '2025-07-01', '2025-11-30', '2025-01-09 02:13:09'),
(27, 'Orange', 'Bibile Sweet', '2025-04-01', '2025-05-31', '2025-08-01', '2025-09-30', '2025-01-12 02:19:47'),
(29, 'banana', 'Abul', '2025-01-01', '2025-01-31', '2025-02-01', '2025-02-28', '2025-01-14 04:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `income_id` int(11) NOT NULL,
  `income` varchar(30) NOT NULL,
  `date` varchar(40) NOT NULL,
  `order_id` int(11) NOT NULL,
  `cutomer_id` int(11) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `order_paid_amount` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`income_id`, `income`, `date`, `order_id`, `cutomer_id`, `product_name`, `order_paid_amount`) VALUES
(5, '6.41', '2025-01-12 13:03:55', 8, 15, ' NPK Prime', '314.58'),
(7, '10.00', '2025-01-12 14:05:47', 39, 1, 'Lanka Carrot', '242'),
(8, '5.00', '2024-11-25 17:01:59', 5, 15, 'Algae Solid Star', '345.00'),
(9, '12.92', '2024-12-12 09:37:09', 6, 15, 'NPK Prime', '950.05'),
(10, '55.00', '2024-11-25 17:07:07', 20, 1, 'Home Garden Flower', '2800.12'),
(11, '30.00', '2024-12-12 09:37:09', 7, 15, 'ST/UM 400', '1470.00'),
(12, '100.00', '2025-01-12 12:03:55', 12, 15, 'VP/UM 910', '8400'),
(13, '6.41', '2025-01-12 13:03:55', 21, 15, 'NPK Prime', '314.58'),
(14, '54.05', '2024-11-25 17:05:07', 30, 5, 'Hayleys Profenophos', '2200.90'),
(15, '20.00', '2024-11-25 21:15:01', 35, 4, 'Hayleys Profenophos', '1790.96'),
(16, '15.00', '2024-12-03 10:19:04', 42, 1, 'Elan F1', '1035'),
(17, '10.00', '2025-01-14 09:51:47', 46, 15, 'Lanka Carrot', '158');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `notify_id` int(11) NOT NULL,
  `notify_name` varchar(40) NOT NULL,
  `notify_email` varchar(50) NOT NULL,
  `notify_subject` varchar(60) NOT NULL,
  `notify_msg` varchar(800) NOT NULL,
  `inquire_status` tinyint(1) NOT NULL DEFAULT 1,
  `response` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`notify_id`, `notify_name`, `notify_email`, `notify_subject`, `notify_msg`, `inquire_status`, `response`) VALUES
(16, 'charitha buddhika', 'badsnake1212@gmail.com', 'my bulk order not yet receiver', 'my user name is charith buddhika, i am place order in 2024/09/19. but my order has not yet been received. what is doing now.', 0, 0),
(32, 'charitha', 'wexada7878@gmail.com', 'your information fake for submited MyAgro', 'your information fake for submited MyAgro\r\n', 0, 2),
(34, 'MyAgroCompany', 'cbrajakaruna164@gmail.com', 'helo', 'helo world', 0, 20078),
(35, 'MyAgroCompany', 'badsnake1212@gmail.com', 'proof document invalid', 'something goes herer', 0, 20078),
(36, 'MyAgroCompany', 'badsnake1212@gmail.com', 'proof document invalid', 'something', 0, 20078),
(42, 'Ishan Avishka', 'badsnake1212@gmail.com', 'not correct you document', 'Demo', 1, 789);

-- --------------------------------------------------------

--
-- Table structure for table `nutrition`
--

CREATE TABLE `nutrition` (
  `nutrient_id` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `item_category` varchar(50) NOT NULL,
  `nutrient_amont` varchar(10) NOT NULL,
  `nutrient_valu1` varchar(80) NOT NULL,
  `nutrient_valu2` varchar(80) NOT NULL,
  `nutrient_valu3` varchar(80) NOT NULL,
  `nutrient_valu4` varchar(80) NOT NULL,
  `nutrient_valu5` varchar(80) NOT NULL,
  `nutrient_valu6` varchar(80) NOT NULL,
  `crate` varchar(30) NOT NULL,
  `response` int(11) NOT NULL,
  `update_time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nutrition`
--

INSERT INTO `nutrition` (`nutrient_id`, `item`, `item_category`, `nutrient_amont`, `nutrient_valu1`, `nutrient_valu2`, `nutrient_valu3`, `nutrient_valu4`, `nutrient_valu5`, `nutrient_valu6`, `crate`, `response`, `update_time`) VALUES
(2, 'Banana', 'Fruit', '126g', 'Potassium 451mg', 'Calories 112', 'Carbohydrate  28.8g', 'Vitamin C 11mg', 'Protein 1.37g', 'Magnesium 34mg', '2024-12-07 19:58:22', 789, ''),
(4, 'Orange', 'Fruit', '140 g', 'Calories 65', 'Carbohydrate 16.5g', 'Fiber 2.8g', 'Vitamin C 82.7mg', 'Potassium 232mg', 'Calcium 60.2mg', '2024-12-07 21:33:08', 789, ''),
(5, 'Kiwi', 'Fruit', '100 g', 'Calories 61', 'Carbohydrate 15g', 'Calcium 23.5g', 'Protein 1.2g ', 'Potassium 232mg ', 'Vitamin C 85mg', '2024-12-07 21:39:49', 789, '2024-12-07 22:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `rating_provider`
--

CREATE TABLE `rating_provider` (
  `rating_id` int(11) NOT NULL,
  `rate_value` int(5) NOT NULL,
  `description` varchar(500) NOT NULL,
  `provider` varchar(20) NOT NULL,
  `provider_type` varchar(20) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_type` varchar(15) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating_provider`
--

INSERT INTO `rating_provider` (`rating_id`, `rate_value`, `description`, `provider`, `provider_type`, `customer_name`, `customer_type`, `product_id`, `product_category`) VALUES
(1, 3, 'order send with good quality', '4', 'supplier', 'buddhika', 'customer', 8, 'Fertilizer'),
(2, 3, 'order send with good quality', '4', 'supplier', 'buddhika', 'customer', 8, 'Fertilizer'),
(3, 3, 'order send with good quality', '4', 'supplier', 'buddhika', 'customer', 8, 'Fertilizer'),
(4, 5, 'good supplier and good product', '4', 'supplier', 'buddhika', 'customer', 17, 'Fertilizer'),
(5, 2, 'very disapointered', '4', 'supplier', 'buddhika', 'customer', 8, 'Fertilizer'),
(6, 4, 'done', '4', 'supplier', 'buddhika', 'customer', 8, 'Fertilizer'),
(7, 3, 'go', '4', 'supplier', 'buddhika', 'customer', 8, 'Fertilizer'),
(8, 5, 'This farmer product is in the best condition and good quality', '1', 'farmer', 'ishan', 'farmer', 3, 'Fruit'),
(9, 4, 'Superb!!!', '1', 'farmer', 'ishan', 'farmer', 1, 'Vegetable'),
(10, 3, 'Demo', '4', 'supplier', 'ishan', 'farmer', 12, 'Fertilizer');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `your_name` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `nic_number` varchar(12) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `tel_no` bigint(10) NOT NULL,
  `proof_image` varchar(150) NOT NULL,
  `user_action` tinyint(1) NOT NULL DEFAULT 0,
  `shop_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `your_name`, `username`, `user_password`, `user_type`, `nic_number`, `user_address`, `user_email`, `tel_no`, `proof_image`, `user_action`, `shop_name`) VALUES
(42, 'charitha', 'charitha', 'dasda', 'farmer', '200200602164', 'Dikella,Dehiowia', 'badsnake@gmail.com', 94726990663, 'home (3).jpg', 1, ''),
(44, 'chmoth migara', 'chamoth', '123', 'supplier', '456123963987', '250 Main Road, Deraniygala', 'charithabuddika111@gmail.com', 94717235416, 'linkedin-logo_4096186.png', 1, 'Deraniygala Agro'),
(46, 'Nuwantha Rajakaruna', 'hasitha', '$2y$10$RYIWUXO.UvGOzzdIlVwF7umjUUXrHY9kg0IB.qi40dq7iFWFHsQ2a', 'farmer', '200602200164', 'Colombo 8', 'badsnake1@gmail.com', 94717235416, '2.PNG', 1, ''),
(47, 'Nuwantha Rajakaruna', 'sashika', '$2y$10$EcIGiBWDjMVikPoWvw2ijeAaH1SGI5TXd44MIZcu5e35yFyjQ.RBK', 'farmer', '200602200168', 'Colombo 8', 'nuwantha9872@gmail.com', 94717235416, '3.PNG', 1, ''),
(50, 'samantha ', 'samantha', '$2y$10$shHaGxGuIk.iE0fcgVeRZ.Yn/ZKN.Q4nXCFI5pBbiQxm99GH/c7OS', 'supplier', '789456123963', 'Colombo 8', 'cbuddhika305@gmail.com', 94717235416, '5.PNG', 0, 'AgroFarm');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(200) NOT NULL,
  `staff_userName` varchar(200) NOT NULL,
  `staff_password` varchar(300) NOT NULL,
  `staff_email` varchar(80) NOT NULL,
  `staff_type` varchar(10) NOT NULL,
  `reponse` varchar(50) NOT NULL,
  `create_time` varchar(40) NOT NULL,
  `update_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `staff_userName`, `staff_password`, `staff_email`, `staff_type`, `reponse`, `create_time`, `update_date`) VALUES
(1, 'isuru sampath rajakaruna', '123', '$2y$10$qWuHYhzgxPHl8xYqfhrekO9Kx006pMW4WntrEeKghdwXaSyh3yRya', 'ishanSampath99@gmail.com', 'admin', '0', '2024-08-12 08:28:25', '2025-01-13 06:58:36'),
(5, 'shashini chamodya thilakarathndd', '180352', '$2y$10$RqMLb1eirMJzT2jd22zmMuwhbcjML4okd8KmRO7zFVFw0yvvJ3uBO', 'shashini2003@gmail.com', 'assistant', '123', '2024-12-12 08:28:25', '2025-01-14 09:59:57'),
(10, 'charitha buddhika rajakaruna', '20078', '$2y$10$awtaj6IwK2Es6ajofvQru.a3aImyeFJNqHhfROFASIBxP2NiBJaPG', 'charithabuddhika2002@gmail.com', 'assistant', '123', '2024-12-12 08:28:45', '2025-01-13 07:03:16'),
(12, 'ishan awishka rajakaruna', '789', '$2y$10$MtskiDsoQiQUk4Droaee5OpligPog18yjxGaCkBsDA1a8ZJqK/eP6', 'ishn@gmail.com', 'assistant', '123', '2024-08-12 08:28:25', '2025-01-14 09:54:41'),
(15, 'Ishan Avishka', '456789', '00000', 'ishanSamp99@gmail.com', 'assistant', '123', '2025-01-14 09:59:08', '2025-01-14 09:59:08');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `supplier_nic` bigint(12) NOT NULL,
  `supplier_shop_name` varchar(50) NOT NULL,
  `supplier_email` varchar(50) NOT NULL,
  `supplier_address` varchar(100) NOT NULL,
  `supplier_phone` bigint(10) NOT NULL,
  `supplier_proof` varchar(150) NOT NULL,
  `images` varchar(255) NOT NULL,
  `bank_name` varchar(25) NOT NULL,
  `account_name` varchar(80) NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `branch_name` varchar(30) NOT NULL,
  `response` int(11) NOT NULL,
  `supplier_status` tinyint(1) NOT NULL DEFAULT 0,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` varchar(25) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `username`, `password`, `supplier_nic`, `supplier_shop_name`, `supplier_email`, `supplier_address`, `supplier_phone`, `supplier_proof`, `images`, `bank_name`, `account_name`, `account_no`, `branch_name`, `response`, `supplier_status`, `create_time`, `update_time`) VALUES
(4, 'charitha', 'charitha', '$2y$10$8lzXfD7j9JtJIvWd9Z8fyOjBDKqaa4KSq914HSiskvi0/JXrMyoru', 200200602169, 'MyAgro', 'rbcharitha160@gmail.com', 'Dikella,Dehiowia', 94726990663, 'flat-lay-vegetables-concept-with-copy-space.jpg', '1732562336_f1stawbeary.jpg', 'People\'s Bank', 'charitha Buddhika WA', '2531002000100752', 'Homagama', 20078, 0, '2024-10-13 06:26:23', '2024-11-21 00:10:10'),
(5, 'chmoth migara', 'chamoth', '$2y$10$I.L0q7Ae8aYitv/ybxgzq.6zkhe2A7W4xM0/U0aNc9nnaT8yxXCmq', 456123963987, 'Deraniygala Agro', 'charithabuddika111@gmail.com', '250 Main Road, Deraniygala', 94717235416, 'linkedin-logo_4096186.png', '1732173591_a.jpg', 'Peoples Bank', 'Gihana samindi wijewardana', '193280456750150', 'Dehiowita', 789, 0, '2024-11-08 11:11:09', '2024-11-21 00:10:10'),
(7, 'samantha ', 'samantha', '$2y$10$shHaGxGuIk.iE0fcgVeRZ.Yn/ZKN.Q4nXCFI5pBbiQxm99GH/c7OS', 789456123963, 'AgroFarm', 'cbuddhika305@gmail.com', 'Colombo 8', 94717235416, '5.PNG', '', '', '', '', '', 789, 0, '2025-01-14 09:36:36', '2025-01-14 09:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `technology`
--

CREATE TABLE `technology` (
  `tech_id` int(11) NOT NULL,
  `video_name` varchar(80) NOT NULL,
  `view_name` varchar(225) NOT NULL,
  `like_video` int(11) NOT NULL,
  `response` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technology`
--

INSERT INTO `technology` (`tech_id`, `video_name`, `view_name`, `like_video`, `response`) VALUES
(39, 'apple harvesting machine_1727349802.mp4', 'apple harvesting machine', 79, 0),
(40, 'plant bind machine_1727349826.mp4', 'plant bind machine', 0, 0),
(41, 'paddy harvesting machine_1727349858.mp4', 'paddy harvesting machine', 0, 0),
(42, 'palnting easy machine_1727349880.mp4', 'palnting easy machine', 0, 0),
(43, 'water manage technique_1727351182.mp4', 'water manage technique', 0, 0),
(44, 'water supply technique_1727351206.mp4', 'water supply technique', 0, 0),
(46, 'cuting_1727499470.mp4', 'cuting', 0, 0),
(49, 'Demo_1736772391.mp4', 'Demo', 0, 789),
(50, 'Demo_1736828701.mp4', 'Demo', 0, 789);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `Reference_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_email` varchar(80) NOT NULL,
  `customer_type` varchar(20) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `provider_name` varchar(50) NOT NULL,
  `provider_phone` varchar(12) NOT NULL,
  `provider_email` varchar(80) NOT NULL,
  `provider_type` varchar(20) NOT NULL,
  `item_category` varchar(25) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_price` float(11,2) NOT NULL,
  `item_quantity` float(11,2) NOT NULL,
  `meassure` varchar(10) NOT NULL,
  `item_location` varchar(150) NOT NULL,
  `order_quantity` float(11,2) NOT NULL,
  `paid_amount` float(11,2) DEFAULT NULL,
  `total_amount` float(11,2) NOT NULL,
  `paid_currency` varchar(20) DEFAULT NULL,
  `txn_id` varchar(80) DEFAULT NULL,
  `payment_status` varchar(20) NOT NULL,
  `stripe_id` varchar(200) DEFAULT NULL,
  `created` datetime NOT NULL,
  `update_time` varchar(50) NOT NULL,
  `rating` tinyint(1) NOT NULL DEFAULT 0,
  `responsible` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`Reference_id`, `customer_id`, `customer_name`, `customer_email`, `customer_type`, `provider_id`, `provider_name`, `provider_phone`, `provider_email`, `provider_type`, `item_category`, `item_name`, `item_id`, `item_price`, `item_quantity`, `meassure`, `item_location`, `order_quantity`, `paid_amount`, `total_amount`, `paid_currency`, `txn_id`, `payment_status`, `stripe_id`, `created`, `update_time`, `rating`, `responsible`) VALUES
(5, 15, 'charitha', 'badsnake1212@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'Algae Solid Star', 2, 350.00, 5.00, 'Kg', 'D/33 Digala Road,Dikella,Iranamadu', 5.00, 350.00, 350.00, 'lkr', 'pi_3QFt03RxjCPZ5J0V0cr1M02t', 'Completed', 'cs_test_a1XknT1HEL3zeTjqr8LsRLlWhoXyOjjCia50tg3oN5hqxryaz1EG7waj0w', '2024-10-31 13:16:59', '2024-11-25 17:01:59', 0, '4'),
(6, 15, 'charitha', 'badsnake1212@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'NPK Prime', 8, 320.99, 2.50, 'Kg', '456/ Madu road,Maduknda,Madukanda', 7.50, 962.97, 962.97, 'lkr', 'pi_3QGFpTRxjCPZ5J0V1fGOmMg9', 'Completed', 'cs_test_a1ds9WhOMsMVu8lm9btsiTQOvOxWfXHXqvELsYw9hsa7knoJezpRi2VUkP', '2024-11-01 13:33:39', '', 1, ''),
(7, 15, 'charitha', 'badsnake1212@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'ST/UM 400', 16, 300.00, 1.00, 'Kg', 'No 25, Palaruwa Main Road,Palaruwa', 5.00, 1500.00, 1500.00, 'lkr', 'pi_3QGOm4RxjCPZ5J0V0qQcAsHL', 'Completed', 'cs_test_a1hlzYgDFVcWBLAdxTwk3u0alh0br6ZUXrWkDpv3a8Wqm2oNtLfgMA3PYM', '2024-11-01 23:06:45', '2025-01-12 09:37:07', 0, '4'),
(8, 15, 'charitha', 'badsnake1212@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'NPK Prime', 8, 320.99, 2.50, 'Kg', '456/ Madu road,Maduknda,Madukanda', 2.50, 320.99, 320.99, 'lkr', 'pi_3QGXKFRxjCPZ5J0V0NjIogrX', 'Completed', 'cs_test_a1jsed7guflyzgnNNHrlaWZAd9Y4cLWAkfRL2r5ZK6rAofDfJnqlFMybjD', '2024-11-02 08:14:35', '2025-01-12 13:03:55', 0, '4'),
(9, 15, 'charitha', 'badsnake1212@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'Algae Solid Star', 2, 350.00, 5.00, 'Kg', 'D/33 Digala Road,Dikella,Iranamadu', 5.00, 350.00, 350.00, 'lkr', 'pi_3QGXOCRxjCPZ5J0V0yA6KU6l', 'succeeded', 'cs_test_a1C3VMZLiNWLeOcDR6fvMYUGn1GWJ8ZnVl7TERWnpWzm4VbyUOsOcjnt83', '2024-11-02 08:18:39', '', 0, ''),
(12, 15, 'charitha', 'badsnake1212@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'VP/UM 910', 17, 8500.00, 50.00, 'Kg', 'No 23, Petta Bus Stand,Kolonnawa', 50.00, 8500.00, 8500.00, NULL, 'pi_1742024-11-02 10:42:31', 'Completed', NULL, '2024-11-02 15:12:31', '', 1, ''),
(13, 15, 'charitha', 'badsnake1212@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'VP/UM 910', 17, 8500.00, 50.00, 'Kg', 'No 23, Petta Bus Stand,Kolonnawa', 50.00, NULL, 8500.00, NULL, 'pi_1742024-11-02 10:42:36', 'Canceled', NULL, '2024-11-02 15:12:36', '2024-11-19 12:14:34', 0, '789'),
(15, 15, 'charitha', 'badsnake1212@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'VP/UM 910', 17, 8500.00, 50.00, 'Kg', 'No 23, Petta Bus Stand,Kolonnawa', 50.00, NULL, 8500.00, NULL, 'pi_174158500.0050.00', 'Canceled', NULL, '2024-11-02 15:51:10', '', 0, ''),
(17, 4, 'charitha', 'rbcharitha164@gmail.com', 'supplier', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'VP/UM 910', 17, 8500.00, 50.00, 'Kg', 'No 23, Petta Bus Stand,Kolonnawa', 200.00, NULL, 34000.00, NULL, 'pi_174434000.00200', 'Canceled', NULL, '2024-11-02 21:44:49', '', 0, ''),
(20, 1, 'charitha', 'badsnake1212@gmail.com', 'farmer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'Home Garden Flower', 12, 356.89, 2.00, 'Kg', 'No 456, Main Road, Moanarathenna,Monarathenna', 16.00, 2855.12, 2855.12, NULL, 'pi_124222855.1216', 'Completed', NULL, '2024-11-03 13:53:40', '', 1, ''),
(21, 15, 'charitha', 'badsnake1212@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'NPK Prime', 8, 320.99, 2.50, 'Kg', '456/ Madu road,Maduknda,Madukanda', 2.50, 320.99, 320.99, NULL, 'pi_8415320.992.50', 'Completed', NULL, '2024-11-04 21:34:13', '', 1, ''),
(23, 15, 'charitha', 'badsnake1212@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'chemical', 'Hayleys Profenophos', 18, 450.99, 1.00, 'Liter', 'No 823, digala road,sewanagala,Aguruwella', 3.00, 1350.00, 1352.97, 'lkr', 'pi_184151352.973', 'succeeded', NULL, '2024-11-07 18:34:52', '2024-11-19 12:27:42', 0, '789'),
(24, 15, 'charitha', 'badsnake1212@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'chemical', 'Hayleys Profenophos', 18, 450.99, 1.00, 'Liter', 'No 823, digala road,sewanagala,Aguruwella', 1.00, 450.99, 450.99, 'lkr', 'pi_3QIYwJRxjCPZ5J0V0Qijq7H8', 'succeeded', 'cs_test_a1NzhVFJGn7gFpTkDiTtvoggOG0Oq4X3ZOjmaH4zV2vh1rwPUeSjPiBj9e', '2024-11-07 22:22:10', '', 0, ''),
(25, 15, 'charitha buddhika rajakarunaa', 'badsnake1212@gmail.com', 'customer', 5, 'chmoth migara', '94717235416', 'charithabuddika111@gmail.com', 'supplier', 'fertilizer', 'Sulphate of Ammonia', 1, 350.00, 25.00, 'Kg', 'd/33 Digala Road,Dikella, Padawala', 225.00, 3150.00, 3150.00, 'lkr', 'pi_3QMvW8RxjCPZ5J0V1qXN00Zp', 'succeeded', 'cs_test_a1RYOKNmWRUZ5TZ8ITb37uTvibUdyoaNHo3OmIF7jbIUFFbXqSnHUX2Li2', '2024-11-19 23:17:16', '', 0, ''),
(30, 5, 'chmoth migara', 'charithabuddika111@gmail.com', 'supplier', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'chemical', 'Hayleys Profenophos', 18, 450.99, 1.00, '', 'No 823, digala road,sewanagala, Aguruwella', 5.00, 2254.95, 2254.95, 'lkr', 'pi_3QNW6LRxjCPZ5J0V0YZyaqoI', 'Completed', 'cs_test_a1X4rAVyJ3FKX8okeQ2ETi1X2o1VuQbU0r8s4grn8tMIkJKBO0BVcNV26B', '2024-11-21 14:21:05', '2024-11-25 17:05:07', 0, '4'),
(31, 5, 'chmoth migara', 'charithabuddika111@gmail.com', 'supplier', 5, 'chmoth migara', '94717235416', 'charithabuddika111@gmail.com', 'supplier', 'chemical', 'Hayleys Profenophos', 19, 450.99, 1.00, '', 'No 823, digala road,sewanagala, Aguruwella', 4.00, NULL, 1803.96, NULL, 'pi_19551803.964', 'Canceled', NULL, '2024-11-21 14:29:43', '', 0, ''),
(34, 15, 'charitha buddhika rajakarunaa', 'badsnake1212@gmail.com', 'customer', 5, 'chmoth migara', '94717235416', 'charithabuddika111@gmail.com', 'supplier', 'fertilizer', 'Dolomite', 7, 180.99, 1.00, '', 'No 25, Haton Road, Awissawella', 2.00, 361.98, 361.98, 'lkr', 'pi_3QNYMGRxjCPZ5J0V0pbUIx2N', 'Canceled', 'cs_test_a16llfBPeAZKwLtjYSbtKHRPCBit77sxiWNjNIdpLduCceRDNQkb9GjFyb', '2024-11-21 16:45:40', '', 0, ''),
(35, 4, 'charitha', 'rbcharitha164@gmail.com', 'supplier', 5, 'chmoth migara', '94717235416', 'charithabuddika111@gmail.com', 'supplier', 'chemical', 'Hayleys Profenophos', 19, 450.99, 1.00, '', 'No 823, digala road,sewanagala, Aguruwella', 4.00, 1810.00, 1803.96, NULL, 'pi_19541803.964', 'Completed', NULL, '2024-11-25 09:15:29', '2024-11-25 21:15:01', 0, ''),
(36, 15, 'charitha buddhika rajakarunaa', 'badsnake1212@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'ZN Sulphate', 15, 300.00, 2.00, '', 'No 25, Bibila Road,Bus Stand, Bibila', 10.00, 1450.00, 1500.00, NULL, 'pi_154151500.0010', 'Canceled', NULL, '2024-11-25 21:16:28', '2024-11-25 21:57:09', 0, '789'),
(37, 1, 'Ishan Avishka', 'badsnake1212@gmail.com', 'farmer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'chemical', 'Folicur Tebuconazole', 22, 650.00, 0.25, 'Liter', 'N0 25, Churche Road, Kalpitiya', 1.00, 2600.00, 2600.00, 'lkr', 'pi_22412600.001', 'succeeded', NULL, '2024-11-28 22:19:06', '2024-11-28 22:26:19', 0, '789'),
(38, 1, 'Ishan Avishka', 'badsnake1212@gmail.com', 'farmer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'Sulphate of Ammonia', 3, 350.00, 1.00, 'Kg', 'd/33 Digala Road,Dikella, Dehiowita', 1.00, NULL, 350.00, NULL, 'pi_341350.001.00', 'Canceled', NULL, '2024-12-02 22:05:33', '', 0, ''),
(39, 1, 'Ishan Avishka', 'badsnake1212@gmail.com', 'farmer', 1, 'ishan', '94726990663', 'badsnake1212@gmail.com', 'farmer', 'vegetable', 'Lanka Carrot', 1, 168.00, 1.00, 'Kg', 'No 28, bandarawela town', 1.50, 252.00, 252.00, 'lkr', 'pi_111252.001.5 Kg', 'Completed', NULL, '2024-12-02 23:22:59', '2025-01-12 14:05:47', 1, '1'),
(40, 1, 'Ishan Avishka', 'badsnake1212@gmail.com', 'farmer', 1, 'ishan', '94726990663', 'badsnake1212@gmail.com', 'farmer', 'vegetable', 'Amanda F1', 4, 155.00, 1.00, 'Kg', 'No 3, kaduwela road', 1.00, NULL, 155.00, NULL, 'pi_411155.001', 'Canceled', NULL, '2024-12-03 08:02:25', '', 0, ''),
(42, 1, 'Ishan Avishka', 'badsnake1212@gmail.com', 'farmer', 1, 'ishan', '94726990663', 'badsnake1212@gmail.com', 'farmer', 'fruit', 'Elan F1', 3, 1050.00, 1.00, 'Kg', 'No 3, wewukannra main road', 1.00, 1050.00, 1050.00, 'lkr', 'pi_3QRnJPRxjCPZ5J0V0ZCJ5Qz4', 'Completed', 'cs_test_a1AylL4sBHJ2gevxRzuLZ8wjF3VHVY2d9zJ0LvSivXXwEhqe20L9a2NsHW', '2024-12-03 09:32:14', '2024-12-03 10:19:04', 1, '1'),
(43, 15, 'charitha buddhika rajakarunaa', 'badsnake1212@gmail.com', 'customer', 1, 'ishan', '94726990663', 'badsnake1212@gmail.com', 'farmer', 'fruit', 'Bibile Sweet', 7, 109.73, 1.00, 'Kg', 'Colombo 8', 3.00, 329.19, 329.19, 'lkr', 'pi_7115329.193', 'succeeded', NULL, '2025-01-12 13:56:14', '2025-01-13 09:58:26', 0, '789'),
(44, 15, 'charitha buddhika rajakarunaa', 'badsnake1212@gmail.com', 'customer', 1, 'ishan', '94726990663', 'badsnake@gmail.com', 'farmer', 'vegetable', 'Amanda F1', 4, 155.00, 1.00, 'Kg', 'No 3, kaduwela road', 1.00, 155.00, 155.00, 'lkr', 'pi_3QgjixRxjCPZ5J0V1bS3VuHA', 'succeeded', 'cs_test_a1X1wIxysPWxVuK2HCndr7SQfYKEBbo21Pe9KGWFS9oqVPTn4ilXbRzR5j', '2025-01-13 14:44:23', '', 0, ''),
(45, 15, 'charitha buddhika rajakarunaa', 'badsnake1212@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'Home Garden Vegetable', 10, 450.12, 2.00, 'Kg', 'd/33 Digala Road,Dikella, Ahaliyagoda', 2.00, NULL, 900.24, NULL, 'pi_10415900.242.00', 'Canceled', NULL, '2025-01-13 14:50:49', '2025-01-13 21:13:36', 0, '789'),
(46, 15, 'charitha buddhika rajakarunaa', 'badsnake122@gmail.com', 'customer', 1, 'ishan', '94726990663', 'badsnake@gmail.com', 'farmer', 'vegetable', 'Lanka Carrot', 1, 168.00, 1.00, 'Kg', 'No 28, bandarawela town', 1.00, 168.00, 168.00, 'lkr', 'pi_3QgoOdRxjCPZ5J0V0Sw2K43f', 'Completed', 'cs_test_a1OH0jwEaPZQ8fu4V36rKmzfVIINKwx7aOQlDWnP2h37VP0FMAQJqF25mX', '2025-01-13 19:43:43', '2025-01-14 09:51:47', 0, '1'),
(47, 15, 'charitha buddhika rajakarunaa', 'badsnake122@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'Home Garden Flower', 12, 356.00, 2.00, 'Kg', 'No 456, Main Road, Moanarathenna, Monarathenna', 2.00, 712.00, 712.00, 'lkr', 'pi_12415712.002', 'succeeded', NULL, '2025-01-13 21:00:23', '2025-01-14 06:56:51', 0, '789'),
(48, 15, 'charitha buddhika rajakarunaa', 'badsnake122@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha164@gmail.com', 'supplier', 'fertilizer', 'Home Garden Flower', 12, 356.00, 2.00, 'Kg', 'No 456, Main Road, Moanarathenna, Monarathenna', 2.00, NULL, 712.00, NULL, 'pi_12415712.002.00', 'Canceled', NULL, '2025-01-13 21:05:29', '', 0, ''),
(49, 15, 'charitha buddhika rajakarunaa', 'badsnake122@gmail.com', 'customer', 1, 'ishan', '94726990663', 'badsnake@gmail.com', 'farmer', 'vegetable', 'Lanka Carrot', 1, 168.00, 1.00, 'Kg', 'No 28, bandarawela town', 2.00, 336.00, 336.00, 'lkr', 'pi_3Qh1RXRxjCPZ5J0V1oN81dAm', 'succeeded', 'cs_test_a1r2BrNxbB4OcOdCMOHhc9yWQx5EN33j34LVXIw0NgbewefZhhDdmKZfIV', '2025-01-14 09:39:36', '', 0, ''),
(50, 15, 'charitha buddhika rajakarunaa', 'badsnake122@gmail.com', 'customer', 4, 'charitha', '94726990663', 'rbcharitha160@gmail.com', 'supplier', 'fertilizer', 'Garden Flower', 12, 356.00, 2.00, 'Kg', 'No 456, Main Road, Moanarathenna, Monarathenna', 4.00, 1424.00, 1424.00, 'lkr', 'pi_124151424.004', 'process', NULL, '2025-01-14 09:41:04', '2025-01-14 09:47:36', 0, '789'),
(51, 20, 'dewanga maheshi', 'rbcharitha163@gmail.com', 'customer', 1, 'ishan', '94726990663', 'badsnake@gmail.com', 'farmer', 'vegetable', 'Lanka Carrot', 1, 168.00, 1.00, 'Kg', 'No 28, bandarawela town', 2.00, 336.00, 336.00, 'lkr', 'pi_3Qh1uVRxjCPZ5J0V0fTXyFeJ', 'succeeded', 'cs_test_a1x2BCb3YQioYn2ABBFXDlZjBkSGzv2PT7Brc4RqfUod4gNzSd9OA9M4VN', '2025-01-14 10:09:31', '', 0, ''),
(52, 20, 'dewanga maheshi', 'rbcharitha163@gmail.com', 'customer', 1, 'ishan', '94726990663', 'badsnake@gmail.com', 'farmer', 'vegetable', 'Lanka Carrot', 1, 168.00, 1.00, 'Kg', 'No 28, bandarawela town', 1.00, 168.00, 168.00, 'lkr', 'pi_3Qh1wERxjCPZ5J0V12qC1ehJ', 'succeeded', 'cs_test_a1RGuYSDhp7fN8X0ikekChmLm7mbXMCkiUzV4RY9MoL7uBAc6zshhl25dg', '2025-01-14 10:11:18', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `vegetablefruit`
--

CREATE TABLE `vegetablefruit` (
  `vegfruitle_id` int(11) NOT NULL,
  `vegetable_category` varchar(20) NOT NULL,
  `vegetable_name` varchar(20) NOT NULL,
  `vegfruitle_verity` varchar(50) NOT NULL,
  `vegfruit_distric` varchar(20) NOT NULL,
  `vegfruit_area` varchar(20) NOT NULL,
  `vegfruit_location` varchar(40) NOT NULL,
  `vegfruit_image` varchar(50) NOT NULL,
  `vegfruit_price` decimal(11,2) NOT NULL,
  `vegfruit_total` decimal(11,2) NOT NULL,
  `measurement` varchar(4) NOT NULL,
  `farmer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vegetablefruit`
--

INSERT INTO `vegetablefruit` (`vegfruitle_id`, `vegetable_category`, `vegetable_name`, `vegfruitle_verity`, `vegfruit_distric`, `vegfruit_area`, `vegfruit_location`, `vegfruit_image`, `vegfruit_price`, `vegfruit_total`, `measurement`, `farmer_id`) VALUES
(1, 'vegetable', 'Carrot', 'Lanka Carrot', 'Badulla', 'Bandarawela', 'No 28, bandarawela town', 'Carrots.jpeg', 168.00, 30.50, 'Kg', 1),
(3, 'fruit', 'strawberry', 'Elan F1', 'Anuradhapura', 'wewukannara', 'No 3, wewukannra main road', 'stwbery.jpg', 1050.00, 31.00, 'Kg', 1),
(4, 'vegetable', 'Brinjal', 'Amanda F1', 'Nuwara Eliya', 'homagama', 'No 3, kaduwela road', 'brinjal.jpg', 155.00, 7.00, 'Kg', 1),
(7, 'fruit', 'Orange', 'Bibile Sweet', 'Ampara', 'petta', 'Colombo 8', 'orange.png', 109.73, 0.00, 'Kg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `verity`
--

CREATE TABLE `verity` (
  `verity_id` int(11) NOT NULL,
  `product_category` varchar(20) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `verity_name` varchar(50) NOT NULL,
  `Days_Maturity` varchar(10) NOT NULL,
  `Verities_image` varchar(255) NOT NULL,
  `Description` varchar(1500) NOT NULL,
  `Light` varchar(20) NOT NULL,
  `Water` varchar(20) NOT NULL,
  `Nutrient` varchar(20) NOT NULL,
  `Soil` varchar(20) NOT NULL,
  `distance` varchar(20) NOT NULL,
  `depth` varchar(20) NOT NULL,
  `spacing` varchar(20) NOT NULL,
  `Harvest_message` varchar(1500) NOT NULL,
  `Companion` varchar(400) NOT NULL,
  `Antagonistic` varchar(400) NOT NULL,
  `Diseases` varchar(400) NOT NULL,
  `Pests` varchar(400) NOT NULL,
  `Origin` varchar(50) NOT NULL,
  `reponsible` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verity`
--

INSERT INTO `verity` (`verity_id`, `product_category`, `product_name`, `verity_name`, `Days_Maturity`, `Verities_image`, `Description`, `Light`, `Water`, `Nutrient`, `Soil`, `distance`, `depth`, `spacing`, `Harvest_message`, `Companion`, `Antagonistic`, `Diseases`, `Pests`, `Origin`, `reponsible`, `create_time`) VALUES
(9, 'vegetable', 'Cauliflower', 'Multi-Head F1', '60 – 75 da', 'Multi-Head F1.jpg', 'F1 hybrid with a short cultivation period (harvest from June already possible). Central flower grows between 12-15 cm, and smaller flowers on the side shoots. Suitable for growing in large containers on the terrace or balcony. Set cultivation allows harvesting from June to September. Germination after 10-14 days at 16-20 ° C.', 'Sunny', 'Very humid', 'High', 'Medium (loamy)', '50 cm', '1 cm', '60 cm', 'An early harvest of the main flower, serves the growth of side shoots. Multiple harvests possible. Planting out the seedlings with 2 pairs of leaves. If they become too large, they tend to shoot. Cultivation possible throughout the outdoor season. For good growth, keep side shoots rather dry and water them little. Observe crop rotation. If necessary, cover with an insect protection net. Prick out early seeds after 2 weeks to 5 x 5 cm, plant out from April at a distance of 40 x 50 cm.', 'Physalis,  Potato,  Radish,  Radishes,  Rhubarb,  Sage,  Soybean,  Spinach (Summer),  Thyme', 'Arugula / Rocket,  Broccoli,  Brussels sprouts,  Cabbage (Cabbage),  Cabbage (Savoy cabbage),  Chives,  Collard greens (Kale),  Collard greens (Tuscan kale / Dinosaur kale / Palm tree kale),  Florence fennel / Finocchio,  Garlic , Horseradish,  Jerusalem artichoke / Topinambur,  Kohlrabi / German turnip / Turnip cabbage,  Lovage , Mizuna / Japanese mustard greens,  Napa cabbage / Chinese cabbage, ', 'Soft rot,  Club root of cabbage', 'Cabbage white,  Cabbage fly,  Cabbage heart midge', 'Southern Greece, Crete / Cyprus', 20078, '2024-10-13 00:55:27'),
(11, 'Fruit', 'Strawberry', 'Elan F1', '100-120 da', 'f1stawbeary.jpg', 'F1 hybrid. This aroma strawberry always brings new sugary sweet. juicy fruits throughout the summer.\r\nThese plants can be cultivated as snack fruit in beds, in pots and tubs on balconies and terraces and in hanging baskets.', 'Sunny', 'Wet', 'Medium', 'Light (sandy)', '25 cm', '0 cm', '30 cm', 'To grow strawberries in the garden, you can either plant purchased seedlings or take cuttings from existing plants. These are formed on long shoots, called stolons. Best planting time is July/August, so the plant has enough time to become strong for a good harvest the following year. Propagation by seeds is also possible, they are located on the outside of the so-called gathering nut fruit. During the growth and in dry weather (especially during fruiting) the strawberries need a lot of water. From May you can spread straw as a mulch between the plants, as a protection against moisture and gray mold infestation and against weeds.', 'Radishes,  Borage,  Chives,  Cress,  Garlic', 'Pak Choi, Lovage, Broccoli, Brussels sprouts,  Cabbage (Cabbage),  Cauliflower', 'Black spot of roses,  Red spot disease, Grey mold', 'Root knot nematodes, Strawberry blossom weevil', 'North America', 0, '2024-10-13 00:55:27'),
(13, 'vegetable', 'Knol khol', 'Neckarperle', '50 – 60 da', 'Kolibri.jpg', 'done', 'Sunny', 'Wet', 'High', 'Light (sandy)', '50 cm', '1 cm', '60 cm', 'done something', 'Radishes,  Borage,  Chives,  Cress,  Garlic', 'Okra,Onion, Brussels sprouts,Garlic,Chives,Turnip,Horseradish', 'Black spot of roses,  Red spot disease, Grey mold', 'Cabbage heart midge, Cabbage fly, Cabbage white', 'North America', 20078, '2024-10-16 07:11:08'),
(14, 'vegetable', 'Strawberry', 'Tubby White', '100-120 da', 'tubby.jpg', 'Small wild strawberry, which due to its small size is more intense flavor and richer in ingredients than their classic relatives. Ideal for small garden corners, balcony boxes and tubs.', 'Sunny', 'Wet', 'Medium', 'Light (sandy)', '25 cm', '5 cm', '30 cm', 'Also known as strawberry meadow. Robust. Also well suited for boxes and containers. Forms numerous runners, ground cover. Fruits are large, bright red and very aromatic. Stems stand tall, keeping fruit clean and less likely to be attacked by slugs and gray rot. Self-pollinating. Insect friendly.', 'Radishes,  Borage,  Chives,  Cress,  Garlic', 'Pak Choi, Lovage, Broccoli, Brussels sprouts,  Cabbage (Cabbage),  Cauliflower', 'Black spot of roses,  Red spot disease, Grey mold', 'Root knot nematodes, Strawberry blossom weevil', 'North America', 789, '2025-01-13 09:38:02'),
(15, 'vegetable', 'Strawberry', 'Renaissance', '100-120 da', 'renia.jpg', 'Renaissance is a new gourmet variety from Hansabred GmbH. It is single-bearing and can be classified in the medium-late harvest range. It impresses with its excellent flavor, which is reminiscent of wild berries. The yield is very good and the glossy, medium-red fruits are easy to pick (even without the calyx). The fruit size of the highly aromatic berries is between 19-20 grams/fruit and the flesh is firm. The unusual heart shape of the fruit gives it that special \"something\". It has a well-balanced sweetness-acidity ratio. The plants grow vigorously and are very hardy. Yields good to very good, no obvious susceptibilities.', 'Sunny', 'Wet', 'Medium', 'Light (sandy)', '20 cm', '40 cm', '30 cm', 'The Renaissance strawberry plant is very vigorous and is therefore ideal for the garden. The plants are hardy and do not require another strawberry variety for pollination. The perfect location for your Renaissance strawberry plants is semi-shady to sunny. The ripening period is medium-late and begins in June. Renaissance can be grown as a good complement to the strawberry plants Senga Sengana, Sonata or Polka. In general, the plant health of the Renaissance strawberry variety is very good, with tolerance to mildew, botrytis and Phytophthora cactorum. Further cultivation tips for the strawberry variety.', 'Radishes,  Borage,  Chives,  Cress,  Garlic', 'Pak Choi, Lovage, Broccoli, Brussels sprouts,  Cabbage (Cabbage),  Cauliflower', 'Black spot of roses,  Red spot disease,  Grey mold', 'Root knot nematodes, Strawberry blossom weevil', 'North America', 0, '2025-01-13 09:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `voucher_id` int(11) NOT NULL,
  `rp_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `provider_name` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `amount_due` decimal(11,2) NOT NULL,
  `amount_total` decimal(11,2) NOT NULL,
  `voucher` varchar(100) NOT NULL,
  `action` tinyint(2) NOT NULL DEFAULT 0,
  `responsible` int(11) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_id`, `rp_id`, `product_id`, `provider_name`, `product_name`, `customer_id`, `customer_name`, `amount_due`, `amount_total`, `voucher`, `action`, `responsible`, `create_time`, `update_time`) VALUES
(5, 10, 17, 'charitha', 'VP/UM 910', 15, 'charitha', 8500.00, 8500.00, '1731929057_shashini.PNG', 1, 789, '2024-11-12 20:16:32', '2025-01-09 20:20:17'),
(6, 11, 17, 'charitha', 'VP/UM 910', 15, 'charitha', 8500.00, 8500.00, '1731942510_dwanga.PNG', 1, 789, '2024-11-20 10:14:47', '2024-11-19 12:14:47'),
(7, 13, 17, 'charitha', 'VP/UM 910', 15, 'charitha', 8500.00, 8500.00, '1731952173_f1stawbeary.jpg', 2, 789, '2024-11-19 12:18:23', '2024-11-19 12:11:23'),
(8, 14, 17, 'charitha', 'VP/UM 910', 15, 'charitha', 6000.00, 8500.00, '1731987627_dwanga.PNG', 2, 789, '2024-11-21 08:29:52', '2024-11-19 09:21:31'),
(9, 14, 17, 'charitha', 'VP/UM 910', 15, 'charitha', 500.00, 8500.00, '1731989426_dwanga.PNG', 2, 789, '2024-11-19 09:43:35', '2024-11-19 09:40:35'),
(10, 14, 17, 'charitha', 'VP/UM 910', 15, 'charitha', 8500.00, 8500.00, '1731989454_Kolibri.jpg', 1, 789, '2024-11-19 10:21:16', '2024-11-19 09:41:16'),
(11, 13, 17, 'charitha', 'VP/UM 910', 15, 'charitha', 8500.00, 8500.00, '1731998509_f1stawbeary.jpg', 2, 789, '2024-11-19 12:52:07', '2024-11-19 12:12:07'),
(12, 13, 17, 'charitha', 'VP/UM 910', 15, 'charitha', 8500.00, 8500.00, '1731998574_Kolibri.jpg', 2, 789, '2024-11-20 12:14:00', '2024-11-19 12:14:00'),
(13, 11, 17, 'charitha', 'VP/UM 910', 15, 'charitha', 85.00, 8500.00, '1731998924_hasitha.PNG', 1, 789, '2024-11-19 12:18:59', '2024-11-19 12:18:59'),
(14, 23, 18, 'charitha', 'Hayleys Profenophos', 15, 'charitha', 1350.00, 1352.97, '1731999432_dwanga.PNG', 1, 789, '2024-11-19 12:27:35', '2024-11-19 12:27:35'),
(15, 32, 19, 'chmoth migara', 'Hayleys Profenophos', 15, 'charitha buddhika rajakarunaa', 1352.97, 1352.97, '1732186655_Kolibri.jpg', 2, 789, '2024-11-21 16:27:35', '2024-11-21 16:28:10'),
(16, 36, 15, 'charitha', 'ZN Sulphate', 15, 'charitha buddhika rajakarunaa', 1500.00, 1500.00, '1732543439_5.PNG', 2, 789, '2024-11-25 19:33:59', '2024-11-25 19:35:15'),
(17, 37, 22, 'charitha', 'Folicur Tebuconazole', 1, 'Ishan Avishka', 2600.00, 2600.00, '1732812741_3.PNG', 2, 789, '2024-11-28 22:22:21', '2024-11-28 22:23:15'),
(18, 37, 22, 'charitha', 'Folicur Tebuconazole', 1, 'Ishan Avishka', 2600.00, 2600.00, '1732812811_IMG-20241123-WA0004.jpg', 2, 789, '2024-11-28 22:23:31', '2024-11-28 22:23:42'),
(19, 37, 22, 'charitha', 'Folicur Tebuconazole', 1, 'Ishan Avishka', 2600.00, 2600.00, '1732812835_1.PNG', 1, 789, '2024-11-28 22:23:55', '2024-11-28 22:24:03'),
(20, 39, 1, 'ishan', 'Lanka Carrot', 1, 'Ishan Avishka', 252.00, 252.00, '1733201916_IMG-20241123-WA0012.jpg', 2, 789, '2024-12-03 10:28:36', '2024-12-03 11:04:02'),
(21, 39, 1, 'ishan', 'Lanka Carrot', 1, 'Ishan Avishka', 150.00, 252.00, '1733204202_IMG-20241123-WA0004.jpg', 2, 789, '2024-12-03 11:06:42', '2024-12-03 11:07:08'),
(22, 39, 1, 'ishan', 'Lanka Carrot', 1, 'Ishan Avishka', 150.00, 252.00, '1733204202_IMG-20241123-WA0004.jpg', 2, 789, '2024-12-03 11:06:42', '2024-12-03 11:07:07'),
(23, 39, 1, 'ishan', 'Lanka Carrot', 1, 'Ishan Avishka', 252.00, 252.00, '1733204245_5.PNG', 1, 789, '2024-12-03 11:07:25', '2024-12-03 11:08:10'),
(24, 43, 7, 'ishan', 'Bibile Sweet', 15, 'charitha buddhika rajakarunaa', 329.19, 329.19, '1736742419_db conn.JPG', 1, 789, '2025-01-13 09:56:59', '2025-01-13 09:57:57'),
(25, 45, 10, 'charitha', 'Home Garden Vegetable', 15, 'charitha buddhika rajakarunaa', 900.24, 900.24, '1736782998_aprov1.JPG', 2, 789, '2025-01-13 21:13:18', '2025-01-13 21:13:33'),
(26, 47, 12, 'charitha', 'Home Garden Flower', 15, 'charitha buddhika rajakarunaa', 712.00, 712.00, '1736817965_aprov2.JPG', 1, 789, '2025-01-14 06:56:05', '2025-01-14 06:56:53'),
(27, 50, 12, 'charitha', 'Garden Flower', 15, 'charitha buddhika rajakarunaa', 1424.00, 1424.00, '1736828220_3.PNG', 0, 789, '2025-01-14 09:47:00', '2025-01-14 09:47:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agrochemical`
--
ALTER TABLE `agrochemical`
  ADD PRIMARY KEY (`agro_id`),
  ADD KEY `agrochemical_ibfk_1` (`supplier_id`);

--
-- Indexes for table `controlprice`
--
ALTER TABLE `controlprice`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`farmer_id`);

--
-- Indexes for table `harvest`
--
ALTER TABLE `harvest`
  ADD PRIMARY KEY (`harvest_id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`income_id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`notify_id`);

--
-- Indexes for table `nutrition`
--
ALTER TABLE `nutrition`
  ADD PRIMARY KEY (`nutrient_id`);

--
-- Indexes for table `rating_provider`
--
ALTER TABLE `rating_provider`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `technology`
--
ALTER TABLE `technology`
  ADD PRIMARY KEY (`tech_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`Reference_id`);

--
-- Indexes for table `vegetablefruit`
--
ALTER TABLE `vegetablefruit`
  ADD PRIMARY KEY (`vegfruitle_id`),
  ADD KEY `farmer_ibfx_d` (`farmer_id`) USING BTREE;

--
-- Indexes for table `verity`
--
ALTER TABLE `verity`
  ADD PRIMARY KEY (`verity_id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`voucher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agrochemical`
--
ALTER TABLE `agrochemical`
  MODIFY `agro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `controlprice`
--
ALTER TABLE `controlprice`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `farmer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `harvest`
--
ALTER TABLE `harvest`
  MODIFY `harvest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `notify_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `nutrition`
--
ALTER TABLE `nutrition`
  MODIFY `nutrient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rating_provider`
--
ALTER TABLE `rating_provider`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `technology`
--
ALTER TABLE `technology`
  MODIFY `tech_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `Reference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `vegetablefruit`
--
ALTER TABLE `vegetablefruit`
  MODIFY `vegfruitle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `verity`
--
ALTER TABLE `verity`
  MODIFY `verity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agrochemical`
--
ALTER TABLE `agrochemical`
  ADD CONSTRAINT `agrochemical_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vegetablefruit`
--
ALTER TABLE `vegetablefruit`
  ADD CONSTRAINT `vegetablefruit_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`farmer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
