-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: sql210.byetcluster.com
-- Üretim Zamanı: 13 Oca 2025, 17:16:52
-- Sunucu sürümü: 10.6.19-MariaDB
-- PHP Sürümü: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `if0_38087799_clinic_appointments`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` enum('active','completed','cancelled') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `appointment_date`, `appointment_time`, `status`, `created_at`) VALUES
(6, 5, 31, '2025-01-25', '09:00:00', 'active', '2025-01-10 21:59:43'),
(7, 8, 47, '2025-01-27', '09:00:00', 'active', '2025-01-11 23:54:08'),
(8, 5, 28, '2025-01-29', '09:00:00', 'active', '2025-01-12 01:33:37'),
(9, 5, 25, '2025-01-20', '15:00:00', 'active', '2025-01-12 01:35:58'),
(10, 5, 27, '2025-01-27', '13:00:00', 'active', '2025-01-12 01:50:51'),
(11, 4, 26, '2025-01-17', '11:00:00', 'active', '2025-01-12 02:42:52'),
(12, 4, 45, '2025-01-29', '16:00:00', 'active', '2025-01-12 02:44:13'),
(13, 8, 46, '2025-01-29', '09:00:00', 'active', '2025-01-12 02:46:30'),
(14, 8, 26, '2025-01-17', '11:00:00', 'active', '2025-01-13 20:48:23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `specialty` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `doctors`
--

INSERT INTO `doctors` (`id`, `first_name`, `last_name`, `email`, `password`, `specialty`, `created_at`) VALUES
(25, 'Ayşe', 'Yılmaz', 'ayse.yilmaz@hospital.com', '1234', 'anesthesia and reanimation', '2025-01-05 15:59:30'),
(26, 'Mehmet', 'Demir', 'mehmet.demir@hospital.com', 'abcd', 'anesthesia and reanimation', '2025-01-05 15:59:30'),
(27, 'Ali', 'Can', 'ali.can@hospital.com', '1a2b', 'neurosurgery', '2025-01-05 15:59:30'),
(28, 'Elif', 'Kaya', 'elif.kaya@hospital.com', 'a1b2', 'neurosurgery', '2025-01-05 15:59:30'),
(29, 'Fatma', 'Türk', 'fatma.turk@hospital.com', 'sdfg', 'pediatric surgery', '2025-01-05 15:59:30'),
(30, 'Deniz', 'Aksoy', 'deniz.aksoy@hospital.com', 'rasd', 'pediatric surgery', '2025-01-05 15:59:30'),
(31, 'Serkan', 'Öztürk', 'serkan.ozturk@hospital.com', 'mlkd', 'general surgery', '2025-01-05 15:59:30'),
(32, 'Zeynep', 'Aksoy', 'zeynep.aksoy@hospital.com', 'lkop', 'general surgery', '2025-01-05 15:59:30'),
(33, 'Canan', 'Demirci', 'canan.demirci@hospital.com', 'njkl', 'thoracic surgery', '2025-01-05 15:59:30'),
(34, 'Pelin', 'Kaya', 'pelin.kaya@hospital.com', 'oklp', 'thoracic surgery', '2025-01-05 15:59:30'),
(35, 'Deniz', 'Soyer', 'deniz.soyer@hospital.com', 'nykl', 'ophthalmology', '2025-01-05 15:59:30'),
(36, 'Berk', 'Özkan', 'berk.ozkan@hospital.com', 'bvgy', 'ophthalmology', '2025-01-05 15:59:30'),
(37, 'Gülşen', 'Arslan', 'gulsen.arslan@hospital.com', 'b8yu', 'obstetrics and gynecology', '2025-01-05 15:59:30'),
(38, 'Ayten', 'Yücel', 'ayten.yucel@hospital.com', 'a89y', 'obstetrics and gynecology', '2025-01-05 15:59:30'),
(39, 'Murat', 'Kaya', 'murat.kaya@hospital.com', 'b7hy', 'cardiovascular surgery', '2025-01-05 15:59:30'),
(40, 'Selim', 'Erdem', 'selim.erdem@hospital.com', '7302', 'cardiovascular surgery', '2025-01-05 15:59:30'),
(41, 'Özgür', 'Demir', 'ozgur.demir@hospital.com', 'basy', 'ear,nose and throat', '2025-01-05 15:59:30'),
(42, 'Pınar', 'Can', 'pinar.can@hospital.com', 'yu7v', 'ear,nose and throat', '2025-01-05 15:59:30'),
(43, 'Hasan ', 'Çelik', 'hasan.celik@hospital.com', 'brty', 'obesity and obesity surgery', '2025-01-05 15:59:30'),
(44, 'Ayşe', 'Kaya', 'ayse.kaya@hospital.com', '56ct', 'obesity and obesity surgery', '2025-01-05 15:59:30'),
(45, 'Veli', 'Akın', 'veli.akin@hospital.com', '1109', 'organ transplantation', '2025-01-05 15:59:30'),
(46, 'Elif', 'Demirci', 'elif.demirci@hospital.com', 'a89m', 'organ transplantation', '2025-01-05 15:59:30'),
(47, 'Tarık', 'Yılmaz', 'tarik.yilmaz@hospital.com', 'n0sa', 'orthopedics and traumotology', '2025-01-05 15:59:30'),
(48, 'Seda', 'Demirci', 'seda.demirci@hospital.com', 'vxy7', 'orthopedics and traumotology', '2025-01-05 15:59:30');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `doctor_availability`
--

CREATE TABLE `doctor_availability` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `available_date` date NOT NULL,
  `available_time` time NOT NULL,
  `is_booked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `doctor_availability`
--

INSERT INTO `doctor_availability` (`id`, `doctor_id`, `available_date`, `available_time`, `is_booked`) VALUES
(1, 25, '2025-01-20', '13:00:00', 1),
(2, 25, '2025-01-20', '14:00:00', 1),
(3, 25, '2025-01-20', '15:00:00', 1),
(4, 25, '2025-01-22', '13:00:00', 0),
(5, 25, '2025-01-22', '14:00:00', 0),
(6, 26, '2025-01-17', '09:00:00', 0),
(7, 26, '2025-01-17', '10:00:00', 0),
(8, 26, '2025-01-17', '11:00:00', 0),
(9, 26, '2025-01-20', '09:00:00', 0),
(10, 26, '2025-02-20', '09:00:00', 0),
(11, 27, '2025-01-25', '11:30:00', 0),
(12, 27, '2025-01-27', '13:00:00', 0),
(13, 27, '2025-02-01', '09:00:00', 0),
(14, 28, '2025-01-29', '09:00:00', 1),
(15, 28, '2025-01-29', '10:00:00', 0),
(16, 29, '2025-01-29', '13:00:00', 0),
(17, 29, '2025-02-01', '09:00:00', 0),
(18, 30, '2025-01-25', '09:00:00', 0),
(19, 30, '2025-01-27', '09:00:00', 0),
(20, 31, '2025-01-25', '09:00:00', 1),
(21, 31, '2025-01-29', '10:00:00', 0),
(22, 32, '2025-01-29', '10:00:00', 0),
(23, 32, '2025-02-01', '11:00:00', 0),
(24, 33, '2025-02-01', '09:00:00', 0),
(25, 33, '2025-02-01', '13:00:00', 0),
(26, 34, '2025-01-25', '13:00:00', 0),
(27, 34, '2025-01-25', '15:00:00', 0),
(28, 35, '2025-01-29', '09:00:00', 0),
(29, 35, '2025-01-29', '14:00:00', 0),
(30, 36, '2025-01-25', '09:00:00', 0),
(31, 36, '2025-01-27', '10:00:00', 0),
(32, 37, '2025-01-25', '11:00:00', 0),
(33, 37, '2025-01-27', '13:00:00', 0),
(34, 38, '2025-01-27', '09:00:00', 0),
(35, 38, '2025-02-01', '09:00:00', 0),
(36, 39, '2025-01-29', '10:00:00', 0),
(37, 39, '2025-02-01', '11:00:00', 0),
(38, 40, '2025-01-27', '09:00:00', 0),
(39, 40, '2025-02-01', '11:00:00', 0),
(40, 40, '2025-02-01', '15:00:00', 0),
(41, 41, '2025-01-27', '10:00:00', 0),
(42, 41, '2025-01-29', '10:00:00', 0),
(43, 41, '2025-02-01', '11:00:00', 0),
(44, 42, '2025-01-25', '13:00:00', 0),
(45, 42, '2025-01-25', '15:00:00', 0),
(46, 43, '2025-01-29', '09:00:00', 0),
(47, 43, '2025-02-01', '14:00:00', 1),
(48, 44, '2025-01-27', '16:00:00', 0),
(49, 45, '2025-01-27', '14:00:00', 0),
(50, 45, '2025-01-29', '16:00:00', 0),
(51, 46, '2025-01-29', '09:00:00', 0),
(52, 46, '2025-01-29', '10:00:00', 0),
(53, 46, '2025-02-01', '13:00:00', 0),
(54, 46, '2025-02-01', '15:00:00', 0),
(55, 47, '2025-01-25', '10:00:00', 0),
(56, 47, '2025-01-27', '09:00:00', 1),
(57, 47, '2025-02-01', '15:00:00', 0),
(58, 48, '2025-01-29', '15:00:00', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `tc_number` varchar(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone` varchar(10) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `height` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `patients`
--

INSERT INTO `patients` (`id`, `email`, `password`, `first_name`, `last_name`, `tc_number`, `date_of_birth`, `phone`, `weight`, `height`, `created_at`, `profile_photo`) VALUES
(4, 'esra.uysal.1978@gmail.com', 'aaa', 'esra', 'uysal', '22222222222', '2005-06-24', '5545657789', '60.00', 170, '2025-01-04 23:13:17', NULL),
(5, 'sude.uysal.20022@gmail.com', '1111', 'Sevgi Sude', 'UYSAL', '11111111111', '2000-07-24', '5545657789', '60.00', 160, '2025-01-05 15:02:57', NULL),
(8, 'uysalfurkan1234@gmail.com', 'abcde', 'Furkan', 'UYSAL', '13775658546', '2008-03-14', '5906286278', '70.00', 180, '2025-01-11 23:17:58', NULL),
(9, 'rumeysaensari@icloud.com', 'xxx123', 'Aaaaa', 'Bbbbb', '12345678901', '2000-07-01', '5445436542', '60.00', 170, '2025-01-13 11:44:58', NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Tablo için indeksler `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `doctor_availability`
--
ALTER TABLE `doctor_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Tablo için indeksler `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tc_number` (`tc_number`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Tablo için AUTO_INCREMENT değeri `doctor_availability`
--
ALTER TABLE `doctor_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Tablo için AUTO_INCREMENT değeri `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);

--
-- Tablo kısıtlamaları `doctor_availability`
--
ALTER TABLE `doctor_availability`
  ADD CONSTRAINT `doctor_availability_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
