-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2018 at 04:27 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `earsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposisi_eksternal`
--

CREATE TABLE `disposisi_eksternal` (
  `id_disposisi_eksternal` int(11) NOT NULL,
  `isi_disposisi` varchar(255) NOT NULL,
  `tanggal_disposisi` date NOT NULL,
  `tujuan_disposisi` int(11) DEFAULT NULL,
  `id_surat_eksternal` int(11) DEFAULT NULL,
  `id_perintah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `disposisi_internal`
--

CREATE TABLE `disposisi_internal` (
  `id_disposisi_internal` int(11) NOT NULL,
  `isi_disposisi` text NOT NULL,
  `tanggal_disposisi` date NOT NULL,
  `id_surat_internal` int(11) DEFAULT NULL,
  `id_perintah` int(11) DEFAULT NULL,
  `tujuan_disposisi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `id_unit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `keterangan`, `id_unit`) VALUES
(1, 'administrator', 'admin sistem', 3);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `media_surat`
--

CREATE TABLE `media_surat` (
  `id_media` int(11) NOT NULL,
  `nama_media` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `kontak_email` varchar(255) NOT NULL,
  `kontak_telepon` varchar(12) NOT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `kontak_email`, `kontak_telepon`, `id_unit`, `id_jabatan`) VALUES
(1, 'Yusuf Eka Wicaksana', 'ekayusuf.wicaksana@gmail.com', '085212520595', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `perintah_disposisi`
--

CREATE TABLE `perintah_disposisi` (
  `id_perintah` int(11) NOT NULL,
  `nama_perintah` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prioritas_surat`
--

CREATE TABLE `prioritas_surat` (
  `id_prioritas` int(11) NOT NULL,
  `nama_prioritas` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sifat_surat`
--

CREATE TABLE `sifat_surat` (
  `id_sifat` int(11) NOT NULL,
  `nama_sifat` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_eksternal`
--

CREATE TABLE `surat_eksternal` (
  `id_surat_eksternal` int(11) NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `isi_ringkas` text NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `lokasi_surat` varchar(255) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `asal_surat_pengguna` int(11) DEFAULT NULL,
  `asal_surat_luar` varchar(255) DEFAULT NULL,
  `tujuan_surat_pengguna` int(11) DEFAULT NULL,
  `tujuan_surat_luar` varchar(255) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `id_media` int(11) DEFAULT NULL,
  `id_prioritas` int(11) DEFAULT NULL,
  `id_sifat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_internal`
--

CREATE TABLE `surat_internal` (
  `id_surat_internal` int(11) NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `destinasi_surat` int(11) DEFAULT NULL,
  `isi_ringkas` text NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `lokasi_surat` varchar(255) NOT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `id_prioritas` int(11) DEFAULT NULL,
  `id_sifat` int(11) DEFAULT NULL,
  `id_media` int(11) DEFAULT NULL,
  `asal_surat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `id_unit` int(11) NOT NULL,
  `nama_unit` varchar(255) NOT NULL,
  `kepala_unit` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`id_unit`, `nama_unit`, `kepala_unit`, `keterangan`) VALUES
(3, 'Administrator', 'adminstrator', 'Admin sistem');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('1','0') NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `password`, `level`, `id_pegawai`) VALUES
(1, 'admin', 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposisi_eksternal`
--
ALTER TABLE `disposisi_eksternal`
  ADD PRIMARY KEY (`id_disposisi_eksternal`),
  ADD KEY `fk_surat_eksternal` (`id_surat_eksternal`),
  ADD KEY `fk_user` (`tujuan_disposisi`),
  ADD KEY `fk_perintah_eksternal` (`id_perintah`);

--
-- Indexes for table `disposisi_internal`
--
ALTER TABLE `disposisi_internal`
  ADD PRIMARY KEY (`id_disposisi_internal`),
  ADD KEY `fk_disposisi` (`id_surat_internal`),
  ADD KEY `fk_perintah` (`id_perintah`),
  ADD KEY `fk_tujuan` (`tujuan_disposisi`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `fk_jabatan_unit` (`id_unit`);

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `media_surat`
--
ALTER TABLE `media_surat`
  ADD PRIMARY KEY (`id_media`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `fk_pegawai_unit` (`id_unit`),
  ADD KEY `fk_pegawai_jabatan` (`id_jabatan`);

--
-- Indexes for table `perintah_disposisi`
--
ALTER TABLE `perintah_disposisi`
  ADD PRIMARY KEY (`id_perintah`);

--
-- Indexes for table `prioritas_surat`
--
ALTER TABLE `prioritas_surat`
  ADD PRIMARY KEY (`id_prioritas`);

--
-- Indexes for table `sifat_surat`
--
ALTER TABLE `sifat_surat`
  ADD PRIMARY KEY (`id_sifat`);

--
-- Indexes for table `surat_eksternal`
--
ALTER TABLE `surat_eksternal`
  ADD PRIMARY KEY (`id_surat_eksternal`),
  ADD KEY `fk_asal_surat_pengguna` (`asal_surat_pengguna`),
  ADD KEY `fk_tujuan_surat_pengguna` (`tujuan_surat_pengguna`),
  ADD KEY `fk_jenis` (`id_jenis`),
  ADD KEY `fk_prioritas` (`id_prioritas`),
  ADD KEY `fk_sifat` (`id_sifat`),
  ADD KEY `fk_media` (`id_media`);

--
-- Indexes for table `surat_internal`
--
ALTER TABLE `surat_internal`
  ADD PRIMARY KEY (`id_surat_internal`),
  ADD KEY `fk_masuk_jenis` (`id_jenis`),
  ADD KEY `fk_masuk_sifat` (`id_sifat`),
  ADD KEY `fk_masuk_prioritas` (`id_prioritas`),
  ADD KEY `fk_masuk_media` (`id_media`) USING BTREE,
  ADD KEY `fk_masuk_user` (`asal_surat`),
  ADD KEY `fk_destinasi_surat_user` (`destinasi_surat`);

--
-- Indexes for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_user_pegawai` (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disposisi_eksternal`
--
ALTER TABLE `disposisi_eksternal`
  MODIFY `id_disposisi_eksternal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disposisi_internal`
--
ALTER TABLE `disposisi_internal`
  MODIFY `id_disposisi_internal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `media_surat`
--
ALTER TABLE `media_surat`
  MODIFY `id_media` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `perintah_disposisi`
--
ALTER TABLE `perintah_disposisi`
  MODIFY `id_perintah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prioritas_surat`
--
ALTER TABLE `prioritas_surat`
  MODIFY `id_prioritas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sifat_surat`
--
ALTER TABLE `sifat_surat`
  MODIFY `id_sifat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surat_eksternal`
--
ALTER TABLE `surat_eksternal`
  MODIFY `id_surat_eksternal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `surat_internal`
--
ALTER TABLE `surat_internal`
  MODIFY `id_surat_internal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disposisi_eksternal`
--
ALTER TABLE `disposisi_eksternal`
  ADD CONSTRAINT `fk_perintah_eksternal` FOREIGN KEY (`id_perintah`) REFERENCES `perintah_disposisi` (`id_perintah`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_surat_eksternal` FOREIGN KEY (`id_surat_eksternal`) REFERENCES `surat_eksternal` (`id_surat_eksternal`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`tujuan_disposisi`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `disposisi_internal`
--
ALTER TABLE `disposisi_internal`
  ADD CONSTRAINT `fk_disposisi` FOREIGN KEY (`id_surat_internal`) REFERENCES `surat_internal` (`id_surat_internal`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_perintah` FOREIGN KEY (`id_perintah`) REFERENCES `perintah_disposisi` (`id_perintah`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_tujuan` FOREIGN KEY (`tujuan_disposisi`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `fk_jabatan_unit` FOREIGN KEY (`id_unit`) REFERENCES `unit_kerja` (`id_unit`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `fk_pegawai_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_pegawai_unit` FOREIGN KEY (`id_unit`) REFERENCES `unit_kerja` (`id_unit`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `surat_eksternal`
--
ALTER TABLE `surat_eksternal`
  ADD CONSTRAINT `fk_asal_surat_pengguna` FOREIGN KEY (`asal_surat_pengguna`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_surat` (`id_jenis`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_media` FOREIGN KEY (`id_media`) REFERENCES `media_surat` (`id_media`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_prioritas` FOREIGN KEY (`id_prioritas`) REFERENCES `prioritas_surat` (`id_prioritas`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_sifat` FOREIGN KEY (`id_sifat`) REFERENCES `sifat_surat` (`id_sifat`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_tujuan_surat_pengguna` FOREIGN KEY (`tujuan_surat_pengguna`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `surat_internal`
--
ALTER TABLE `surat_internal`
  ADD CONSTRAINT `fk_destinasi_surat_user` FOREIGN KEY (`destinasi_surat`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_masuk_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_surat` (`id_jenis`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_masuk_kategori` FOREIGN KEY (`id_media`) REFERENCES `media_surat` (`id_media`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_masuk_prioritas` FOREIGN KEY (`id_prioritas`) REFERENCES `prioritas_surat` (`id_prioritas`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_masuk_sifat` FOREIGN KEY (`id_sifat`) REFERENCES `sifat_surat` (`id_sifat`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_masuk_user` FOREIGN KEY (`asal_surat`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
