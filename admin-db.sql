-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 20 Mar 2020, 14:59:59
-- Sunucu sürümü: 10.4.11-MariaDB
-- PHP Sürümü: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `aduks`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `updated_at` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `active`, `created_at`, `updated_at`, `ip`) VALUES
(1, 'demo@hotmail.com', '$2y$10$mMk6/sj6.uWKveQ1HnaX3.HekF644HVef.RT4SqDiY6ZIx2laooA.', 1, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `email_register`
--

CREATE TABLE `email_register` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `m_date` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `logo` text COLLATE utf8_turkish_ci DEFAULT '',
  `address` text COLLATE utf8_turkish_ci DEFAULT '',
  `email` varchar(200) COLLATE utf8_turkish_ci DEFAULT '',
  `phone` varchar(200) COLLATE utf8_turkish_ci DEFAULT '',
  `slider` longtext COLLATE utf8_turkish_ci DEFAULT '',
  `gallery` longtext COLLATE utf8_turkish_ci DEFAULT '',
  `about` longtext COLLATE utf8_turkish_ci DEFAULT NULL,
  `created_at` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `updated_at` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `site`
--

INSERT INTO `site` (`id`, `active`, `logo`, `address`, `email`, `phone`, `slider`, `gallery`, `about`, `created_at`, `updated_at`) VALUES
(1, 1, '[{\"url\":\"\\/public\\/images\\/158455808551.PNG\"}]', 'asdasdasd', 'sadasdas', 'asdasdasd', '[]', '[]', 'sadasd', '2020-03-18 12:36:22', '2020-03-19 13:49:23');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`username`);

--
-- Tablo için indeksler `email_register`
--
ALTER TABLE `email_register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`email`);

--
-- Tablo için indeksler `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
