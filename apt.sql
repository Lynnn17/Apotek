-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 06:47 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apt`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id` int(11) NOT NULL,
  `kode_obat` varchar(32) NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `produsen` varchar(200) NOT NULL,
  `harga` varchar(200) NOT NULL,
  `stok` double NOT NULL,
  `jenis_obat` enum('Kapsul','Tablet','Cair') NOT NULL,
  `file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id`, `kode_obat`, `nama_obat`, `produsen`, `harga`, `stok`, `jenis_obat`, `file`) VALUES
(55, 'OBT001', 'Paracetamol 550mg', 'PT Kimia Farma', '5000', 160, 'Tablet', 'download.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_beli`
--

CREATE TABLE `tb_beli` (
  `id` int(200) NOT NULL,
  `id_barang` int(200) NOT NULL,
  `kode_mds` varchar(200) CHARACTER SET latin1 NOT NULL,
  `nama_mds` varchar(200) CHARACTER SET latin1 NOT NULL,
  `stok` int(200) NOT NULL,
  `harga` int(200) NOT NULL,
  `total` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_beli`
--

INSERT INTO `tb_beli` (`id`, `id_barang`, `kode_mds`, `nama_mds`, `stok`, `harga`, `total`) VALUES
(7, 2, 'ALT001', 'msk', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_dstr`
--

CREATE TABLE `tb_dstr` (
  `id` int(200) NOT NULL,
  `kode_dstr` varchar(200) NOT NULL,
  `nama_dstr` char(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_hp` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dstr`
--

INSERT INTO `tb_dstr` (`id`, `kode_dstr`, `nama_dstr`, `alamat`, `no_hp`) VALUES
(83, 'DTR001 ', 'PT. Maju Jaya Obat', 'Jl. Raya Daan Magot KM19 Kebun Batu Ceper Tanggerang ', '081212121212');

-- --------------------------------------------------------

--
-- Table structure for table `tb_in`
--

CREATE TABLE `tb_in` (
  `id` int(200) NOT NULL,
  `id_barang` int(200) NOT NULL,
  `kode_msk` varchar(200) CHARACTER SET latin1 NOT NULL,
  `nama_msk` varchar(200) CHARACTER SET latin1 NOT NULL,
  `harga` int(200) NOT NULL,
  `stok` int(200) NOT NULL,
  `tgl_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_in`
--

INSERT INTO `tb_in` (`id`, `id_barang`, `kode_msk`, `nama_msk`, `harga`, `stok`, `tgl_masuk`) VALUES
(1, 3, '', 'entahdah ', 4750, 150, '2021-04-19'),
(4, 3, 'MSK001 ', 'entahdah ', 1, 1, '2021-04-20'),
(5, 2, 'MSK002 ', 'Masker', 2000, 100, '2021-04-22'),
(6, 2, 'MSK003 ', 'Masker', 4000, 10, '2021-04-25'),
(7, 2, 'MSK004 ', 'Masker', 4000, 5, '2021-04-25'),
(8, 2, 'MSK005 ', 'Masker', 2000, 19, '2021-04-25'),
(9, 2, 'MSK006 ', 'Masker', 4000, 12, '2021-04-25'),
(10, 2, 'MSK007 ', 'Masker', 4000, 71, '2021-04-25'),
(11, 2, 'MSK008 ', 'Masker', 2000, 15, '2021-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_masuk`
--

CREATE TABLE `tb_masuk` (
  `id` int(200) NOT NULL,
  `id_obat` int(200) NOT NULL,
  `kode_obat` varchar(200) NOT NULL,
  `nama_obat` varchar(200) NOT NULL,
  `produsen` varchar(200) NOT NULL,
  `harga` int(200) NOT NULL,
  `stok` double NOT NULL,
  `jenis_obat` enum('Kapsul','Tablet','Cair') NOT NULL,
  `tgl_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_masuk`
--

INSERT INTO `tb_masuk` (`id`, `id_obat`, `kode_obat`, `nama_obat`, `produsen`, `harga`, `stok`, `jenis_obat`, `tgl_masuk`) VALUES
(71, 77, 'MSK001 ', 'Bodrex Flu Dan Batuk', 'kookok', 4750, 100, 'Tablet', '2021-04-18'),
(74, 60, 'MSK004 ', 'Kortikosteroid', '', 4750, 100, 'Kapsul', '2021-04-18'),
(75, 55, 'MSK005 ', 'Paracetamol', '', 4750, 100, 'Kapsul', '2021-04-18'),
(80, 77, 'MSK006 ', 'Bodrex Flu Dan Batuk', 'kookok', 4750, 1, 'Kapsul', '2021-04-20'),
(81, 55, 'MSK007 ', 'Paracetamol 550mg', 'PT Kimia Farma', 4000, 15, 'Kapsul', '2021-04-24'),
(82, 55, 'MSK008 ', 'Paracetamol 550mg', 'PT Kimia Farma', 4000, 25, 'Kapsul', '2021-04-24'),
(83, 55, 'MSK009 ', 'Paracetamol 550mg', 'PT Kimia Farma', 4000, 15, 'Kapsul', '2021-04-24'),
(84, 55, 'MSK010 ', 'Paracetamol 550mg', 'PT Kimia Farma', 3000, 15, 'Kapsul', '2021-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_medis`
--

CREATE TABLE `tb_medis` (
  `id` int(200) NOT NULL,
  `kode_mds` varchar(200) CHARACTER SET latin1 NOT NULL,
  `nama_mds` varchar(200) CHARACTER SET latin1 NOT NULL,
  `stok` int(200) NOT NULL,
  `harga` int(200) NOT NULL,
  `file` varchar(200) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_medis`
--

INSERT INTO `tb_medis` (`id`, `kode_mds`, `nama_mds`, `stok`, `harga`, `file`) VALUES
(2, 'ALT001', 'Masker', 332, 2000, '45914-ilustrasi-masker.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_out`
--

CREATE TABLE `tb_out` (
  `id` int(200) NOT NULL,
  `id_barang` int(200) NOT NULL,
  `kode_msk` varchar(200) CHARACTER SET latin1 NOT NULL,
  `nama_msk` varchar(200) CHARACTER SET latin1 NOT NULL,
  `stok` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_out`
--

INSERT INTO `tb_out` (`id`, `id_barang`, `kode_msk`, `nama_msk`, `stok`) VALUES
(1, 2, 'JUL001', 'Masker', 0),
(2, 2, 'JUL002', 'Masker', 0),
(3, 2, 'JUL003', 'Masker', 0),
(4, 2, 'JUL004', 'Masker', 0),
(5, 2, 'JUL005', 'Masker', 0),
(6, 2, 'JUL006', 'Masker', 0),
(7, 2, 'JUL007', 'Masker', 0),
(8, 2, 'JUL008', 'Masker', 0),
(9, 2, 'JUL009', 'Masker', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id` int(200) NOT NULL,
  `id_obat` varchar(200) NOT NULL,
  `kode_jual` varchar(200) NOT NULL,
  `nama_obat` varchar(200) NOT NULL,
  `produsen` varchar(200) NOT NULL,
  `stok` varchar(200) NOT NULL,
  `jenis_obat` enum('Kapsul','Tablet','Cair') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id`, `id_obat`, `kode_jual`, `nama_obat`, `produsen`, `stok`, `jenis_obat`) VALUES
(101, '77', 'JUL001', 'Bodrex Flu Dan Batuk', 'kookok', '0', 'Cair'),
(102, '77', 'JUL002', 'Bodrex Flu Dan Batuk', 'kookok', '0', 'Tablet'),
(103, '58', 'JUL003', 'Bodrex Sakit Kepala', '', '0', 'Tablet'),
(104, '60', 'JUL004', 'Kortikosteroid', '', '0', 'Kapsul'),
(105, '55', 'JUL005', 'Paracetamol', '', '20', 'Kapsul'),
(108, '55', 'JUL007', 'Paracetamol', 'okokkoko', '0', 'Kapsul'),
(109, '55', 'JUL008', 'Paracetamol 550mg', 'PT Kimia Farma', '0', 'Kapsul'),
(112, '55', 'JUL009', 'Paracetamol 550mg', 'PT Kimia Farma', '0', 'Kapsul');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tuku`
--

CREATE TABLE `tb_tuku` (
  `id` int(200) NOT NULL,
  `id_obat` int(200) NOT NULL,
  `kode_obat` varchar(200) CHARACTER SET latin1 NOT NULL,
  `nama_obat` varchar(200) NOT NULL,
  `produsen` varchar(200) CHARACTER SET latin1 NOT NULL,
  `stok` int(200) NOT NULL,
  `harga` int(200) NOT NULL,
  `jenis_obat` enum('Kapsul','Tablet','Cair') CHARACTER SET latin1 NOT NULL,
  `total` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_tuku`
--

INSERT INTO `tb_tuku` (`id`, `id_obat`, `kode_obat`, `nama_obat`, `produsen`, `stok`, `harga`, `jenis_obat`, `total`) VALUES
(117, 55, 'OBT001', 'Paracetamol', '', 80, 7000, 'Tablet', 560000),
(118, 55, 'OBT001', 'Paracetamol', 'okokkoko', 1, 7000, 'Tablet', 7000),
(119, 55, 'OBT001', 'Paracetamol 550mg', 'PT Kimia Farma', 10, 5000, 'Tablet', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(200) NOT NULL,
  `username` varchar(20) CHARACTER SET latin1 NOT NULL,
  `password` varchar(20) CHARACTER SET latin1 NOT NULL,
  `nama` char(200) CHARACTER SET latin1 NOT NULL,
  `alamat` varchar(200) CHARACTER SET latin1 NOT NULL,
  `no_hp` varchar(200) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('Perempuan','Laki-Laki') CHARACTER SET latin1 NOT NULL,
  `level` enum('Admin','User') CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `nama`, `alamat`, `no_hp`, `tgl_lahir`, `jk`, `level`) VALUES
(59, 'user', 'user', 'Teguh Bulan Purnama', 'ds Purwosari kec Purwosari Rt 03 Rw 05 Kab Bojonegoro p', '082131415181', '2003-12-02', 'Perempuan', 'User'),
(60, 'Admin', 'admin', 'Aryeswara Lintang Ek', 'ds Purwosari kec Purwosari Rt 03 Rw 05 Kab Bojonegoro p', '082230691212', '2004-12-02', 'Laki-Laki', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_beli`
--
ALTER TABLE `tb_beli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_dstr`
--
ALTER TABLE `tb_dstr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_in`
--
ALTER TABLE `tb_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_masuk`
--
ALTER TABLE `tb_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_medis`
--
ALTER TABLE `tb_medis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_out`
--
ALTER TABLE `tb_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tuku`
--
ALTER TABLE `tb_tuku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `tb_beli`
--
ALTER TABLE `tb_beli`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_dstr`
--
ALTER TABLE `tb_dstr`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `tb_in`
--
ALTER TABLE `tb_in`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_masuk`
--
ALTER TABLE `tb_masuk`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `tb_medis`
--
ALTER TABLE `tb_medis`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_out`
--
ALTER TABLE `tb_out`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `tb_tuku`
--
ALTER TABLE `tb_tuku`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
