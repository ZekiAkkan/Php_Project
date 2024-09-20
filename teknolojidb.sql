-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 15 Eyl 2024, 19:59:06
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `teknolojidb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `urunadi` varchar(255) NOT NULL,
  `urunbilgi` text NOT NULL,
  `urunfiyat` decimal(10,2) NOT NULL,
  `urunresim` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `urunadi`, `urunbilgi`, `urunfiyat`, `urunresim`) VALUES
(1, 'Laptop', '16GB RAM, 512GB SSD, Intel i7', 14999.99, 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcR0pg71dRCrGp7zNFbbHnCpcUeRcQB5d1yGk2G5dlaF4wgR8C-DkWkbRZiLe_gzeZ8AY5R0KLwlOwp_BoyAZh3i9Q971ubqKBIGC1pFs9JRYU30LSFaJFWg6_Y&usqp=CAE'),
(2, 'Mouse', 'Kablosuz Gaming Mouse', 399.99, 'https://www.atombilisim.com.tr/turbox-giantpeak-usb-kablolu-rgb-makro-gaming-klavye-standart-q-sese-duyarli-rgb-isikli-macrolu-telefon-tutacakli-gaming-klavye-turbox-gaming-klavye-66511-72-B.jpg'),
(3, 'Klavye', 'RGB Mekanik Klavye', 699.99, 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcRRT0n9pXB-_eC_hzoBNCp1vVTp8VGmN_fmVwEDg812PzujnbbJIWhLF1U6K4TfhQAe78r4JVDKiHn_wKfGWU2_hLdBJCQhH2oEyM3A-rEh5KtJSG24xMfeuL8&usqp=CAE');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunsepet`
--

CREATE TABLE `urunsepet` (
  `id` int(11) NOT NULL,
  `urunid` int(11) NOT NULL,
  `kullaniciID` int(11) NOT NULL,
  `urunadet` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `urunsepet`
--

INSERT INTO `urunsepet` (`id`, `urunid`, `kullaniciID`, `urunadet`) VALUES
(1, 1, 1, 1),
(3, 2, 1, 1),
(4, 3, 1, 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunsepet`
--
ALTER TABLE `urunsepet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `urunid` (`urunid`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `urunsepet`
--
ALTER TABLE `urunsepet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `urunsepet`
--
ALTER TABLE `urunsepet`
  ADD CONSTRAINT `urunsepet_ibfk_1` FOREIGN KEY (`urunid`) REFERENCES `urunler` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
