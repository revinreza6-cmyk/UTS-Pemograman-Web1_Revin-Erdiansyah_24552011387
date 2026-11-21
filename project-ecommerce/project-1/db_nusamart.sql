-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2026 at 02:18 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_nusamart`
--

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `produk_id` int NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1',
  `total_harga` int NOT NULL,
  `status` enum('Pending','Diproses','Selesai') COLLATE utf8mb4_unicode_ci DEFAULT 'Pending',
  `tanggal_pesan` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `user_id`, `produk_id`, `jumlah`, `total_harga`, `status`, `tanggal_pesan`) VALUES
(1, 1, 1, 1, 14500000, 'Selesai', '2026-11-21 13:34:12'),
(2, 1, 2, 2, 3700000, 'Diproses', '2026-11-21 13:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_angka` int NOT NULL,
  `stok` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ringkasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori`, `judul`, `harga`, `harga_angka`, `stok`, `gambar`, `ringkasan`, `deskripsi`, `created_at`) VALUES
(1, 'Elektronik', 'NusaBook Pro 14 M2', 'Rp 14.500.000', 14500000, 'Tersedia (15 unit)', 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=800&q=80', 'Laptop ultrabook resmi distribusi PT. NusaMart Digital Nusantara untuk kebutuhan komputasi profesional.', 'NusaBook Pro 14 M2 hadir dengan layar Retina 14 inci, RAM 16GB LPDDR5, dan SSD NVMe 512GB. Produk ini dilengkapi garansi resmi 2 tahun PT. NusaMart Digital Nusantara serta layanan purna jual di 25 kota di Indonesia.', '2026-11-21 13:34:12'),
(2, 'Aksesoris', 'NusaSound ANC Wireless', 'Rp 1.850.000', 1850000, 'Tersedia (42 unit)', 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80', 'Headphone nirkabel dengan fitur Active Noise Cancellation dan baterai tahan hingga 40 jam.', 'Dirancang khusus untuk produktivitas dan hiburan tanpa gangguan suara luar. Menggunakan driver 40mm Hi-Res Audio, koneksi Bluetooth 5.3 multipoint, serta bantalan busa memori ergonomis.', '2026-11-21 13:34:12'),
(3, 'Smart Home', 'NusaCam 360 Smart CCTV', 'Rp 650.000', 650000, 'Tersedia (30 unit)', 'https://images.unsplash.com/photo-1558002038-1055907df827?auto=format&fit=crop&w=800&q=80', 'Kamera keamanan pintar resolusi 2K QHD dengan deteksi gerakan AI dan pantauan real-time.', 'Pantau keamanan rumah dan kantor langsung dari smartphone melalui aplikasi NusaHome. Mendukung penglihatan malam inframerah, audio dua arah, dan penyimpanan cloud terenkripsi.', '2026-11-21 13:34:12'),
(4, 'Layanan B2B', 'Paket Pengadaan IT Kantor', 'Rp 45.000.000', 45000000, 'Pre-Order (7 Hari Kerja)', 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&w=800&q=80', 'Solusi pengadaan perangkat keras, jaringan, dan lisensi resmi untuk perusahaan & instansi.', 'PT. NusaMart Digital Nusantara menyediakan layanan pengadaan perangkat IT skala korporasi lengkap dengan instalasi jaringan lokal, konfigurasi server, dan kontrak pemeliharaan berkala.', '2026-11-21 13:34:12'),
(5, 'Gadget', 'NusaWatch Ultra AMOLED', 'Rp 2.299.000', 2299000, 'Tersedia (20 unit)', 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=800&q=80', 'Smartwatch tahan air IP68 dengan pemantau detak jantung, GPS bawaan, dan layar Always-On.', 'Dilengkapi bodi titanium ringan, 100+ mode olahraga, serta daya tahan baterai hingga 14 hari pemakaian normal. Kompatibel dengan Android maupun iOS.', '2026-11-21 13:34:12'),
(6, 'Networking', 'NusaRouter WiFi 6 AX3000', 'Rp 980.000', 980000, 'Tersedia (25 unit)', 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=800&q=80', 'Router gigabit dual-band berkecepatan tinggi hingga 3000 Mbps untuk rumah dan kantor modern.', 'Mendukung teknologi OFDMA dan MU-MIMO untuk koneksi stabil hingga 128 perangkat secara bersamaan tanpa lag, dilengkapi fitur keamanan WPA3.', '2026-11-21 13:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','pelanggan') COLLATE utf8mb4_unicode_ci DEFAULT 'pelanggan',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Revin Erdiansyah', 'revin@nusamart.co.id', 'admin', '123456', 'admin', '2026-11-21 13:34:12'),
(2, 'Budi Santoso', 'budi@gmail.com', 'budi123', '123456', 'pelanggan', '2026-11-21 13:34:12'),
(3, 'Ambasing', 'kanjutkuda@gmail.com', 'cihuy', 'kerjabagus', 'pelanggan', '2026-11-21 13:40:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
