-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 04:07 PM
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
-- Database: `presensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id_absen` varchar(50) NOT NULL,
  `Nomor_Pegawai` varchar(50) NOT NULL,
  `Nama_Satpam` varchar(50) NOT NULL,
  `Shift` varchar(50) NOT NULL,
  `Gender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id_absen`, `Nomor_Pegawai`, `Nama_Satpam`, `Shift`, `Gender`) VALUES
('', '02', 'Ghean ', 'Pagi', 'Laki-laki'),
('01', '01', 'Haji Bekky', 'Pagi', 'Laki-laki');

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id_Gaji` varchar(50) NOT NULL,
  `Nama_Satpam` varchar(50) NOT NULL,
  `Jumlah_Gaji` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id_Gaji`, `Nama_Satpam`, `Jumlah_Gaji`) VALUES
('01', 'Haji Bekky', 'Rp.5.000.000.000');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id _Jadwal` varchar(12) NOT NULL,
  `Shift` varchar(50) NOT NULL,
  `Nama_Satpam` varchar(50) NOT NULL,
  `Umur_Satpam` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `No_HP` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id _Jadwal`, `Shift`, `Nama_Satpam`, `Umur_Satpam`, `tanggal`, `Gender`, `No_HP`) VALUES
('01', 'pagi', 'ghean anuno', '22', '03 november', 'laki laki', '08570790999');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_bulanan`
--

CREATE TABLE `laporan_bulanan` (
  `id_laporan_bulanan` varchar(12) NOT NULL,
  `id_gaji` varchar(50) NOT NULL,
  `Nama_Satpam` varchar(50) NOT NULL,
  `Rekap_Absensi` varchar(50) NOT NULL,
  `Evaluasi` varchar(50) NOT NULL,
  `Catatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_bulanan`
--

INSERT INTO `laporan_bulanan` (`id_laporan_bulanan`, `id_gaji`, `Nama_Satpam`, `Rekap_Absensi`, `Evaluasi`, `Catatan`) VALUES
('01', '01', 'Haji Bekky', '29', 'Sering Terlambat', 'Semangat Lagi');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `gender` varchar(12) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `Username`, `gender`, `Password`) VALUES
('Haji Bekky', '081234567890', 'laki-laki', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nomor_pegawai` varchar(30) NOT NULL,
  `id_Login` varchar(50) NOT NULL,
  `id_register` varchar(50) NOT NULL,
  `id _Jadwal` int(12) NOT NULL,
  `id_absen` varchar(50) NOT NULL,
  `id_perizinan` varchar(50) NOT NULL,
  `id_laporan_bulanan` varchar(50) NOT NULL,
  `id_gaji` varchar(50) NOT NULL,
  `Nama_satpam` varchar(50) NOT NULL,
  `No_HP` varchar(14) NOT NULL,
  `Gender` enum('L','P') NOT NULL DEFAULT 'L'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perizinan`
--

CREATE TABLE `perizinan` (
  `id_perizinan` varchar(50) NOT NULL,
  `Nama_Satpam` varchar(50) NOT NULL,
  `Pengajuan_Cuti` varchar(50) NOT NULL,
  `Alasan` varchar(50) NOT NULL,
  `Validasi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perizinan`
--

INSERT INTO `perizinan` (`id_perizinan`, `Nama_Satpam`, `Pengajuan_Cuti`, `Alasan`, `Validasi`) VALUES
('01', 'Haji Bekky', 'Pagi', 'sakit', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id_register` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_Gaji`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id _Jadwal`);

--
-- Indexes for table `laporan_bulanan`
--
ALTER TABLE `laporan_bulanan`
  ADD PRIMARY KEY (`id_laporan_bulanan`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nomor_pegawai`);

--
-- Indexes for table `perizinan`
--
ALTER TABLE `perizinan`
  ADD PRIMARY KEY (`id_perizinan`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id_register`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
