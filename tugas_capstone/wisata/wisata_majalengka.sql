-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2025 at 12:58 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisata_majalengka`
--

-- --------------------------------------------------------

--
-- Table structure for table `paket_wisata`
--

CREATE TABLE `paket_wisata` (
  `id` int NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `deskripsi` text,
  `destinasi` text,
  `durasi` varchar(20) DEFAULT NULL,
  `harga` int NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `video_youtube` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `paket_wisata`
--

INSERT INTO `paket_wisata` (`id`, `nama_paket`, `deskripsi`, `destinasi`, `durasi`, `harga`, `gambar`, `video_youtube`, `created_at`) VALUES
(1, 'Paket Alam Majalengka', 'Menikmati keindahan alam pegunungan dan danau alami Majalengka.', 'Panyaweuyan, Situ Cipanten', '1 Hari', 125000, 'paket-alam.png', 'https://www.youtube.com/watch?v=KT-Gy-QIPb4', '2025-12-14 09:20:45'),
(2, 'Paket Adventure Majalengka', 'Wisata petualangan dengan aktivitas river tubing dan trekking alam.', 'River Tubing Cikadongdong, Curug Tonjong', '1 Hari', 125000, 'paket-adventure.png', 'https://www.youtube.com/watch?v=kMDbDDoRSkY', '2025-12-14 09:20:45'),
(3, 'Paket Wisata Desa', 'Wisata edukasi dan budaya desa khas Majalengka.', 'Desa Wisata Bumi Agung Lemah Sugih', '1 Hari', 50000, 'paket-desa.png', 'https://www.youtube.com/watch?v=gOLZUPGrZBw', '2025-12-14 09:20:45'),
(4, 'Paket Wisata Kota', 'City tour santai menikmati ikon Kota Majalengka.', 'Taman Raharja, Alun-Alun Majalengka', '1 Hari', 75000, 'paket-kota.png', 'https://www.youtube.com/watch?v=oaLTA9a4kdc', '2025-12-14 09:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int NOT NULL,
  `id_paket` int DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `lama_hari` int NOT NULL,
  `jumlah_peserta` int NOT NULL,
  `penginapan` tinyint(1) DEFAULT '0',
  `transportasi` tinyint(1) DEFAULT '0',
  `makanan` tinyint(1) DEFAULT '0',
  `harga_paket` int NOT NULL,
  `harga_layanan` int DEFAULT NULL,
  `total_tagihan` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `id_paket`, `nama`, `no_hp`, `tanggal_pesan`, `lama_hari`, `jumlah_peserta`, `penginapan`, `transportasi`, `makanan`, `harga_paket`, `harga_layanan`, `total_tagihan`, `created_at`) VALUES
(11, 1, 'Fitriani', '085555555555', '2025-12-15', 1, 2, 0, 1, 1, 250000, 300000, 550000, '2025-12-14 12:29:31'),
(12, 2, 'Jayus', '085555555555', '2025-12-15', 1, 1, 1, 1, 0, 125000, 300000, 425000, '2025-12-14 12:38:17'),
(13, 4, 'Saputri', '085555555555', '2025-12-15', 1, 5, 1, 0, 0, 375000, 500000, 875000, '2025-12-14 12:38:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `paket_wisata`
--
ALTER TABLE `paket_wisata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_paket` (`id_paket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `paket_wisata`
--
ALTER TABLE `paket_wisata`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `fk_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket_wisata` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
