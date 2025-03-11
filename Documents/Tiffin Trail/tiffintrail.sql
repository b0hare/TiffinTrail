-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 10:14 AM
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
-- Database: `tiffintrail`
--

-- --------------------------------------------------------

--
-- Table structure for table `deliveryman`
--

CREATE TABLE `deliveryman` (
  `Id` int(5) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `MNumber` varchar(10) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Address` varchar(30) NOT NULL,
  `Vehicle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliveryman`
--

INSERT INTO `deliveryman` (`Id`, `Name`, `MNumber`, `Password`, `Address`, `Vehicle`) VALUES
(5, 'Ravi', '9638527410', '123456', '102, Govindpuri', 'Yamaha FZ'),
(6, 'Java', '9876543220', '123456', 'system.orcale', 'pulsar');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `code` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plan_name` varchar(20) DEFAULT NULL,
  `WeeklyPrice` decimal(6,2) DEFAULT NULL,
  `MonthlyPrice` decimal(7,2) DEFAULT NULL,
  `p_Description` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `category` enum('jain','veg','non-veg') DEFAULT NULL,
  `Taste_preference` enum('Not Spicy/Oily','Spicy/not Oily','Oily/not Spicy','Spicy','Oily') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`code`, `user_id`, `plan_name`, `WeeklyPrice`, `MonthlyPrice`, `p_Description`, `url`, `category`, `Taste_preference`) VALUES
(3, 1, 'Veg Plan1', 750.00, 2800.00, '1Daal, 6Roti, 1 Bowl Rice, salad', 'https://thumbs.dreamstime.com/b/veg-thali-indian-cuisine-food-platter-consists-variety-veggies-paneer-dish-lentils-jeera-rice-roti-sweet-dish-veg-thali-225931582.jpg', 'veg', 'Not Spicy/Oily'),
(4, 8, 'The Unique se7en', 600.00, 2250.00, '7 Days 7 Different cooked veg, 5 Rotis, Raita', 'https://www.tastingtable.com/img/gallery/20-delicious-indian-dishes-you-have-to-try-at-least-once/intro-1645057933.jpg', 'veg', 'Not Spicy/Oily'),
(7, 8, 'veg plan3', 700.00, 2600.00, 'Raita, 5Roti, Chawal, Rajma', 'https://media.istockphoto.com/id/1290444763/photo/assorted-of-indian-dish-with-curry-dish-naan-chicken.jpg?s=612x612&w=0&k=20&c=5q09leP6_QnvdUEfsB6KUXDTTBJtl88bEwrDfRVNA0U=', 'veg', 'Not Spicy/Oily'),
(8, 8, 'veg plan4', 670.00, 2350.00, 'Milk, Salad, Fruits, Daal, Roti', 'https://palmbeachuk.com/wp-content/uploads/2023/07/indian-food-culture.png', 'veg', 'Not Spicy/Oily'),
(9, 3, 'veg Plan5', 700.00, 2400.00, 'Parathe, Puri, Salad, Chhole', 'https://i.pinimg.com/originals/80/a4/cf/80a4cf099b52edbf033bb3393b6422d8.jpg', 'veg', 'Not Spicy/Oily'),
(10, 3, 'veg plan6', 800.00, 3000.00, '6 Roti, 1 bowl Rice, 2 Sabzi (Daal regular)', 'https://media-assets.swiggy.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_1024/3d16d7cc466fc3f7dce770a6a3000ea9', 'veg', 'Not Spicy/Oily'),
(11, 12, 'Jain plan1', 500.00, 1800.00, '1 dal Tadaka 5roti', 'https://res.cloudinary.com/purnesh/image/upload/w_1000,f_auto/untitled-11613387173977.jpg', 'jain', 'Not Spicy/Oily'),
(12, 12, 'Jain plan2', 550.00, 1900.00, '1 Dal Palak 5 roti', 'https://res.cloudinary.com/purnesh/image/upload/w_1000,f_auto,q_auto:eco,c_limit/31613387173978.jpg', 'jain', 'Not Spicy/Oily'),
(13, 12, 'Jain plan3', 600.00, 2000.00, '1 paneer Handi Special 4 roti', 'https://res.cloudinary.com/purnesh/image/upload/w_1000,f_auto,q_auto:eco,c_limit/81613387173943.jpg', 'jain', 'Not Spicy/Oily'),
(20, 16, 'veg1', 600.00, 1900.00, '1 simple panner 5 roti', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0s0p62YxTI7RwurSeXmLC8Py6tUXEG9JirQ&usqp=CAU', 'veg', 'Not Spicy/Oily'),
(21, 16, 'veg2', 450.00, 1700.00, '1 palak panner 5 roti', 'https://manjulaskitchen.com/wp-content/uploads/everyday-lunch-menu-1024x576.jpg', 'veg', 'Not Spicy/Oily'),
(22, 16, 'veg3', 550.00, 2000.00, '1 daal fry 5 roti', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWX_c6tny2HTTIbpbOwwK2X5ulF5M-B7RKgw&usqp=CAU', 'veg', 'Not Spicy/Oily'),
(23, 17, 'Non veg1', 600.00, 2100.00, 'chicken briyani', 'https://www.foodandwine.com/thmb/QRYKO8zoBeWhLCvkxuTgOo8zu0s=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/Chicken-Biryani-FT-RECIPE0823-9d51c6e665ec4c9daa45162841e2f034.jpg', 'non-veg', 'Not Spicy/Oily'),
(24, 17, 'Non veg2', 650.00, 2150.00, 'mutton briyani', 'https://bfoodale.com/uploads/2021/12/Mutton-Biryani.jpg', 'non-veg', 'Not Spicy/Oily'),
(25, 17, 'Non veg3', 700.00, 2200.00, 'Egg Curry - Boiled eggs simmered in a spiced onion', 'https://myfoodstory.com/wp-content/uploads/2015/11/south-indian-style-egg-curry-recipe.1024x1024-3.jpg', 'non-veg', 'Not Spicy/Oily'),
(26, 18, 'veg1', 500.00, 1950.00, 'palak puri palak panner', 'https://img-global.cpcdn.com/recipes/fae6a609e1a1e527/680x482cq70/palak-puri-with-yummy-allu-mattar-paneer-curry-sabzi-recipe-main-photo.jpg', 'veg', 'Not Spicy/Oily'),
(27, 18, 'veg2', 550.00, 1850.00, 'fry daal  chawal', 'https://menuprices.pk/wp-content/uploads/2022/01/Billys-daal-chawal-specialty-scaled.jpg', 'veg', 'Not Spicy/Oily'),
(28, 18, 'veg3', 600.00, 2100.00, 'allo pratha', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgAfWSzQQ8CQU91q_yLjLGy52AQGHCYOYn0w&usqp=CAU', 'veg', 'Not Spicy/Oily'),
(29, 22, 'Jain plan1', 700.00, 2550.00, 'vegiables roti', 'https://www.shutterstock.com/image-photo/indian-fasting-cuisine-upwas-food-260nw-1651806394.jpg', 'jain', 'Not Spicy/Oily'),
(30, 22, 'Jain plan2', 650.00, 1900.00, 'pumpkin roti', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSh-DaT7U7jppJF1JNcIIUHQptdMh2DVLkpRmtTuF6yO2i20tlG_r5FaAxcdXUUS9hzPyQ&usqp=CAU', 'jain', 'Not Spicy/Oily'),
(31, 22, 'Jain plan3', 750.00, 2100.00, 'panner 6 roti', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_szilOwaA4-R1rvSPhbo8ckuNa7Nt0EYbOQ&usqp=CAU', 'jain', 'Not Spicy/Oily'),
(32, 23, 'veg1', 700.00, 2150.00, 'aloo pratha', 'https://cdn2.foodviva.com/static-content/food-images/north-indian-recipes/alu-paratha-recipe/alu-paratha-recipe.jpg', 'veg', 'Not Spicy/Oily'),
(33, 23, 'veg2', 800.00, 2200.00, 'aloo roti', 'https://www.vidhyashomecooking.com/wp-content/uploads/2021/11/VVKMealplates-2.jpg', 'veg', 'Not Spicy/Oily'),
(34, 23, 'veg3', 800.00, 2250.00, 'daal bowl roti', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1ErCRkmVOw9m3JyBYcS02TuskxpRhBN1PNw&usqp=CAU', 'veg', 'Not Spicy/Oily'),
(38, 24, 'veg1', 700.00, 2100.00, 'pumpkin roti', 'https://i0.wp.com/arogyapoint.com/wp-content/uploads/2020/08/Untitled-design-2-2-1.png?fit=400%2C300&ssl=1', 'veg', 'Not Spicy/Oily'),
(39, 24, 'veg2', 600.00, 2000.00, 'green vegitables roti', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfdblXvvMWPcoQVLp8s-GELQ7tdTZwxuAKyg&usqp=CAU', 'veg', 'Not Spicy/Oily'),
(40, 24, 'veg3', 500.00, 2000.00, 'daal chawal 6 roti', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThTPlkexO12XKbh7fNSOjtyTESu99QgPxxYg&usqp=CAU', 'veg', 'Not Spicy/Oily'),
(41, 21, 'Non veg1', 800.00, 2400.00, 'briyani', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoGCBUTExcVFRUXGBcXGxkXGxkZFxkXFxcaGRcZGBkXFxcaHysjGhwoHRkXJDUkKCwuMjIyGSE3PDcxOysxMi4BCwsLDw4PHRERHTQpIykzMTEzNDEuMTExMTE5MTMxMzExOTEzMTExMy4xMTMxMTMxNTkxMTExMTEzMTMxMTExMf/AABEIAKgBLAMBIgACEQEDEQH/', 'non-veg', 'Not Spicy/Oily'),
(42, 21, 'Non veg2', 700.00, 2300.00, 'FISH BRIYANI', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoGBxQUExYUFBQYGBYZGxocGhoaGx8gHB0kHR0aIiEjHBogHysiIhwoHxscIzQjKCwuMTExHSE3PDcvOyswMS4BCwsLDw4PHBERHTAoIikwMjAwMDkuMDAwMjAwMDAwMDAwMjAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMP/AABEIAKoBKQMBIgACEQEDEQH/', 'jain', 'Not Spicy/Oily'),
(43, 21, 'Non veg3', 800.00, 2450.00, 'Golden Murgi Ka Salan  ROTI', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVAxmeJjO4rxxkEjwx_WnKoZ6xib4X81QrvA&usqp=CAU', 'non-veg', 'Not Spicy/Oily'),
(44, 26, 'Non-veg plan4', 660.00, 2300.00, 'Spicy Chicken Curry - Tender chicken pieces simmer', 'https://i0.wp.com/kalimirchbysmita.com/wp-content/uploads/2015/10/Koli-Chicken-Curry-02-1024x746.jpg?resize=1024%2C746', 'non-veg', 'Spicy'),
(45, 26, 'Non-veg plan5', 710.00, 2650.00, 'Lamb Rogan Josh - Succulent lamb cooked to perfect', 'https://picturetherecipe.com/wp-content/uploads/2020/01/Mutton-Rogan-Josh-with-Rice-PictureTheRecipe.jpg', 'non-veg', 'Not Spicy/Oily'),
(46, 26, 'Non-veg plan6', 570.00, 2010.00, 'Fish Fry - Crisp, golden-brown fillets marinated w', 'https://www.thetakeiteasychef.com/wp-content/uploads/2017/12/KFF-FI1-Compressed.jpg', 'non-veg', 'Not Spicy/Oily');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `S_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `chefID` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userMobile` varchar(11) NOT NULL,
  `chefMobile` varchar(11) NOT NULL,
  `chefName` varchar(30) NOT NULL,
  `userAddress` varchar(50) NOT NULL,
  `chefAddress` varchar(50) NOT NULL,
  `planCode` int(11) NOT NULL,
  `Duration` varchar(20) NOT NULL,
  `cardNumber` varchar(20) NOT NULL,
  `Upi` varchar(30) NOT NULL,
  `subscription_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`S_id`, `userID`, `chefID`, `userName`, `userMobile`, `chefMobile`, `chefName`, `userAddress`, `chefAddress`, `planCode`, `Duration`, `cardNumber`, `Upi`, `subscription_date`) VALUES
(12, 20, 8, 'kavya solanki', '7474747474', '7777788888', 'Anjali Sharma', 'parash bihar calony', 'Chetakpuri', 4, 'MonthlyPrice', '445444533887', '', '2024-06-02 00:00:00'),
(14, 19, 8, 'Bharti yadav', '6767676767', '7777788888', 'Anjali Sharma', 'Amkho', 'Chetakpuri', 7, 'WeeklyPrice', '445444533887', '', '2024-06-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `First_Name` varchar(30) DEFAULT NULL,
  `Last_Name` varchar(30) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Mobile_Number` varchar(15) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `ProfileImg` varchar(255) DEFAULT NULL,
  `Role` enum('Customer','Service Provider') DEFAULT NULL,
  `ServiceType` varchar(15) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `First_Name`, `Last_Name`, `Email`, `Mobile_Number`, `Password`, `Address`, `ProfileImg`, `Role`, `ServiceType`, `Gender`) VALUES
(1, 'Rahul', 'Singh', 'Rahul@gmail.com', '9999900000', '$2y$10$KBK11AH27V.UGQXPJ7MtouTQdq53sRKdz6vViDDfTrCfohb5T4ul6', 'Thatipur', 'https://img.freepik.com/premium-vector/curry-dishes_78118-131.jpg', 'Service Provider', 'Individual', NULL),
(3, 'Family', 'Restaurant', 'familyrestaurant@gmail.com', '8888899999', '$2y$10$O.uXksDuBqcXB6B6k/iA1u8MgfrO/cy/gOG1IbkvHjeYj6Y2cF6UW', 'Thatipur', 'https://media-cdn.tripadvisor.com/media/photo-s/24/61/a3/6b/a-pure-vegetarian-family.jpg', 'Service Provider', 'Business', NULL),
(8, 'Anjali', 'Sharma', 'anjali@gmail.com', '7777788888', '$2y$10$QXGShkXVKXA4DKJdtlN6nO4J00mNlcTAuEC2PaDehkVeghzE.RMOi', 'Chetakpuri', 'https://st2.depositphotos.com/8322640/48266/v/450/depositphotos_482669160-stock-illustration-lady-chef-holding-frypan-hand.jpg', 'Service Provider', 'Individual', 'Female'),
(11, 'Dev', 'Sharma', 'banti@gmail.com', '9876543210', '$2y$10$6qCGLYSRQaDm3umD75qqoOjyk7mVChle7ZSzEV7SPwB9ll3Fw8GMi', 'Naka', 'https://img.freepik.com/premium-vector/businessman-character-avatar-isolated_24877-5037.jpg?size=626&ext=jpg&ga=GA1.1.379443224.1710346056&semt=ais', 'Customer', '', 'Male'),
(12, 'Jain', 'Restaurant', 'jainRestau@gmail.com', '9999999999', '$2y$10$ShRIkJCsjpW/32cv9..85uaYl17/DOLbBdr8qhoowN3.OSH.50iu6', 'Kampu', 'https://media-cdn.tripadvisor.com/media/photo-s/24/61/a3/6b/a-pure-vegetarian-family.jpg', 'Service Provider', 'Business', NULL),
(16, 'Atithi', 'Pure Veg', 'sonam@gmail.com', '8888888888', '$2y$10$ShRIkJCsjpW/32cv9..85uaYl17/DOLbBdr8qhoowN3.OSH.50iu6', 'Govindpuri', 'https://content.jdmagicbox.com/comp/thiruvananthapuram/z8/0471px471.x471.180919221726.j4z8/catalogue/atithi-pure-veg-restaurant-attakulangara-thiruvananthapuram-indian-restaurants-cb0wrsytwa.jpg', 'Service Provider', 'Business', ''),
(17, 'The Meat ', 'Shack', 'vikash@gmail.com', '7777777777', '$2y$10$pLf1ri92GgfazLt1MlkqSucLo.SJIKuQU08mNeEkCUDsWZBpDCOQu', 'Sikander kampu', 'https://b.zmtcdn.com/data/pictures/2/20415432/d05e69d218e6095b41cf6d6deb0055a7.jpg', 'Service Provider', 'Business', ''),
(18, 'Food', 'Corner', 'rohan@gmail.com', '6262626262', '$2y$10$0i9f/2HXNIzD/qc3GhaxS.ZTZcUqQq8xGbcd2/9sG10N4kYhklTPy', 'mander ki mata', 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/28/f9/89/a5/restaurant-interior.jpg?w=600&h=400&s=1', 'Service Provider', 'Business', ''),
(19, 'Bharti', 'yadav', 'bharti@gmail.com', '6767676767', '$2y$10$7FcPot1cb.iuyRNKMozqo.mtzK3ffEKZiiZnJs4/6HKbcNaXEVi8W', 'Amkho', 'https://img.freepik.com/premium-photo/3d-animation-character-cartoon_113255-10852.jpg?w=740', 'Customer', '', 'Female'),
(20, 'kavya', 'solanki', 'kayva@gmai.vcom', '7474747474', '$2y$10$jnx2KsVl3wko6eK0XuW/.OzNVZVgnRjBs1bwlWxDHMcKzH.7N0SpS', 'parash bihar calony', 'https://img.freepik.com/premium-photo/3d-animation-character-cartoon_113255-10852.jpg?w=740', 'Customer', '', 'Female'),
(21, 'Sumit ', 'pal', 'sumit@gmail.com', '6464646446', '$2y$10$gtgrEZYcs.CCSDlzFudo9.hZst1I4mbaFv.FzuT6ZXCVFB8p1W/A2', 'Harishankar puram', 'https://img.freepik.com/premium-vector/businessman-character-avatar-isolated_24877-5037.jpg?size=626&ext=jpg&ga=GA1.1.379443224.1710346056&semt=ais', 'Customer', '', 'Male'),
(22, 'Nisha ', 'jain', 'nisha@gmail.com', '6363636363', '$2y$10$Ac08KhxEYaE4Gewc31EaMe59tVzCgOTwnxy/jQCKDTS5qmEDgvu.q', 'Govindpuri', 'https://st2.depositphotos.com/8322640/48266/v/450/depositphotos_482669160-stock-illustration-lady-chef-holding-frypan-hand.jpg', 'Service Provider', 'Individual', 'Female'),
(23, 'rakhi', 'dubey', 'rakhi@gmail.com', '9393939393', '$2y$10$33AsMjRvnZjNAGat1h7xMO4laM9V50B/VZc8HArlP/NOKrD9nlabi', 'Bade', 'https://st2.depositphotos.com/8322640/48266/v/450/depositphotos_482669160-stock-illustration-lady-chef-holding-frypan-hand.jpg', 'Service Provider', 'Individual', 'Female'),
(24, 'sameer ', 'gupta', 'sameer@gmail.com', '9321921912', '$2y$10$BcZNChr0lHa1E7XYj2CwEudAj6PoxesX0s5F1p3j.iHct14SLyfia', 'gole ke mandir', 'https://img.freepik.com/premium-vector/curry-dishes_78118-131.jpg', 'Service Provider', 'Individual', 'Male'),
(25, 'golu ', 'kumar', 'golu@gmail.com', '6464646464', '$2y$10$RP1t/NZMfu5c1c2HjzQTCOKhMTzusUN1AeoOb5lFq3JmPHnyJzMFa', 'roxy', 'https://img.freepik.com/premium-vector/curry-dishes_78118-131.jpg', 'Service Provider', 'Individual', 'Male'),
(26, 'Zubair', 'Khan', 'zubair@gmail.com', '9877896543', '$2y$10$wvup/.FTQ3Vi8RVNOlUSDuaoRNQN1XLfzMJQu.PPqyK7L0oyHM7C.', 'Victoria Market', 'https://img.freepik.com/premium-vector/curry-dishes_78118-131.jpg', 'Service Provider', 'Individual', 'Male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deliveryman`
--
ALTER TABLE `deliveryman`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `MNumber` (`MNumber`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`code`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`S_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `unique_mobile_number` (`Mobile_Number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deliveryman`
--
ALTER TABLE `deliveryman`
  MODIFY `Id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `S_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `plan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
