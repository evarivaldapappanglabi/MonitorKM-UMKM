-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Apr 2024 pada 17.16
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitorkm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `idlaporan` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `namalengkap` text NOT NULL,
  `email` text NOT NULL,
  `notelp` text NOT NULL,
  `namausaha` text NOT NULL,
  `keterangan` text NOT NULL,
  `status` text NOT NULL,
  `file` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`idlaporan`, `id`, `namalengkap`, `email`, `notelp`, `namausaha`, `keterangan`, `status`, `file`, `tanggal`) VALUES
(1, 2, 'Bayam', 'bayam@gmail.com', '0874213', 'Bayam Sayur', '', 'Diterima', '20240326133228pdf-test.pdf', '2024-03-26'),
(2, 2, 'Bayam', 'bayam@gmail.com', '08798', 'sayur', 'sedang diproses', 'Diterima', '20240327102944pdf-test-1.pdf', '2024-03-27'),
(3, 2, 'Bayam', 'bayam@gmail.com', '078', 'sad', '', 'Diterima', '20240327113628pdf-test-1.pdf', '2024-03-27'),
(4, 2, 'Andi', 'andi@gmail.com', '08673213', 'CV Andi ', 'diterima', 'Diterima', '20240327131918pdf-test.pdf', '2024-03-27'),
(5, 2, 'Abdul Bayam', 'bayam@gmail.com', '0867321321', 'CV. Sayur123', '', 'Belum Dikonfirmasi', 'laporan_20240327191350.pdf', '2024-03-27'),
(6, 2, 'Bayam', 'bayam@gmail.com', '0877576', 'Cv. Sayur123', '', 'Diterima', 'laporan_20240328113905.pdf', '2024-03-28'),
(7, 2, 'test ', 'test@gmail.com', '213213', 'test', '', 'Belum Dikonfirmasi', 'laporan_20240330205328.pdf', '2024-03-30'),
(9, 2, 'Bayam', 'bayam@gmail.com', '0898678', 'CV. Saur123', '', 'Belum Dikonfirmasi', 'laporan_20240331134858.pdf', '2024-03-31'),
(10, 2, 'Bayam', 'bayam@gmail.com', '0898678', 'CV. Saur123', '', 'Diterima', 'laporan_20240331141432.pdf', '2024-03-31'),
(11, 3, 'wildan', 'wildan@gmail.com', '123123123', 'wildansukses', '', 'Diterima', 'laporan_20240401033402.pdf', '2024-04-01'),
(12, 2, 'Bayam', 'bayam@gmail.com', '0898678', 'CV. Saur123', '', 'Diterima', 'laporan_20240402134123.pdf', '2024-04-02'),
(13, 3, 'wildan', 'wildan@gmail.com', '123123123', 'wildansukses', '', 'Diterima', 'laporan_20240402142137.pdf', '2024-04-02'),
(14, 5, 'uji', 'uji@gmail.com', '2323423423', 'uji usaha', '', 'Diterima', 'laporan_20240402180650.pdf', '2024-04-02'),
(15, 5, 'uji', 'uji@gmail.com', '2323423423', 'uji usaha', '', 'Diterima', 'laporan_20240402180756.pdf', '2024-04-02'),
(16, 5, 'uji', 'uji@gmail.com', '2323423423', 'uji usaha', '', 'Diterima', 'laporan_20240402180907.pdf', '2024-04-02'),
(17, 5, 'uji', 'uji@gmail.com', '2323423423', 'uji usaha', '', 'Belum Dikonfirmasi', 'laporan_20240402181025.pdf', '2024-04-02'),
(18, 3, 'wildan', 'wildan@gmail.com', '123123123', 'wildansukses', '', 'Diterima', 'laporan_20240402205637.pdf', '2024-04-02'),
(23, 3, 'wildan', 'wildan@gmail.com', '123123123', 'wildansukses', '', 'Diterima', 'laporan_20240402212240.pdf', '2024-04-02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporanbantuan`
--

CREATE TABLE `laporanbantuan` (
  `idlaporanbantuan` int(11) NOT NULL,
  `idlaporan` int(11) NOT NULL,
  `tanggalpenggunaan` date NOT NULL,
  `kategori` text NOT NULL,
  `pengeluaran` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporanbantuan`
--

INSERT INTO `laporanbantuan` (`idlaporanbantuan`, `idlaporan`, `tanggalpenggunaan`, `kategori`, `pengeluaran`, `keterangan`) VALUES
(1, 6, '2024-03-26', 'Barang', '200000', 'barang'),
(2, 6, '2024-03-29', 'Barang', '100000', 'asd'),
(3, 7, '2024-03-30', 'test', 'test', 'test'),
(4, 8, '2024-03-30', 'test', 'test', 'test'),
(5, 9, '2024-03-27', 'test', 'test', 'test'),
(6, 10, '2024-03-31', 'test', 'test', 'test'),
(7, 11, '2024-04-01', 'test', 'test', 'test'),
(8, 12, '2024-04-02', 'test', 'test', 'test'),
(9, 13, '2024-04-02', 'test', 'test', 'test'),
(10, 14, '2024-04-02', 'test', 'test', 'test'),
(11, 15, '2024-04-02', 'test', 'test', 'test'),
(12, 16, '2024-04-02', 'test', 'test', 'test'),
(13, 17, '2024-04-02', 'test', 'test', 'test'),
(14, 18, '2024-04-02', 'test', 'test', 'test'),
(15, 19, '2024-04-02', 'test', 'test', 'test'),
(16, 23, '2024-04-02', 'test', 'test', 'test');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporanidentitas`
--

CREATE TABLE `laporanidentitas` (
  `idlaporanidentitas` int(11) NOT NULL,
  `idlaporan` int(11) NOT NULL,
  `namalengkap` text NOT NULL,
  `nik` text NOT NULL,
  `alamatusaha` text NOT NULL,
  `notelp` text NOT NULL,
  `email` text NOT NULL,
  `namausaha` text NOT NULL,
  `bidangusaha` text NOT NULL,
  `jenisproduksi` text NOT NULL,
  `lamausaha` text NOT NULL,
  `daritanggal` date NOT NULL,
  `sampaitanggal` date NOT NULL,
  `periode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporanidentitas`
--

INSERT INTO `laporanidentitas` (`idlaporanidentitas`, `idlaporan`, `namalengkap`, `nik`, `alamatusaha`, `notelp`, `email`, `namausaha`, `bidangusaha`, `jenisproduksi`, `lamausaha`, `daritanggal`, `sampaitanggal`, `periode`) VALUES
(1, 6, 'Bayam', '12321321', 'jakarta', '0877576', 'bayam@gmail.com', 'Cv. Sayur123', 'Makanan', 'Sayur', '2 Tahun', '2024-01-01', '2024-07-01', '2023/2024'),
(2, 7, 'test ', '1223', 'test', '213213', 'test@gmail.com', 'test', 'test', 'test', '2', '2024-03-30', '2024-03-30', 'test periode'),
(3, 8, '', '', '', '', '', '', '', '', '', '2024-03-30', '2024-03-30', 'test periode'),
(4, 9, 'Bayam', '1234', 'Jalan Kodran Jakarta', '0898678', 'bayam@gmail.com', 'CV. Saur123', '', '', '', '2024-03-31', '2024-03-31', 'test periode'),
(5, 10, 'Bayam', '1234', 'Jalan Kodran Jakarta', '0898678', 'bayam@gmail.com', 'CV. Saur123', '', '', '', '2024-03-31', '2024-03-31', 'test periode'),
(6, 11, 'wildan', '1234', 'test', '123123123', 'wildan@gmail.com', 'wildansukses', '', '', '', '2024-04-01', '2024-04-01', 'test periode'),
(7, 12, 'Bayam', '1234', 'Jalan Kodran Jakarta', '0898678', 'bayam@gmail.com', 'CV. Saur123', '', '', '', '2024-04-02', '2024-04-02', 'test periode'),
(8, 13, 'wildan', '1234', 'test', '123123123', 'wildan@gmail.com', 'wildansukses', '', '', '', '2023-01-02', '2022-11-09', 'test periode'),
(9, 14, 'uji', '24234234', 'asdasdasd', '2323423423', 'uji@gmail.com', 'uji usaha', '', '', '', '2023-07-01', '2024-04-02', 'test periode'),
(10, 15, 'uji', '24234234', 'asdasdasd', '2323423423', 'uji@gmail.com', 'uji usaha', '', '', '', '2023-01-02', '2024-04-02', 'test periode asd'),
(11, 16, 'uji', '24234234', 'asdasdasd', '2323423423', 'uji@gmail.com', 'uji usaha', '', '', '', '2022-07-14', '2023-01-02', 'test periode'),
(12, 17, 'uji', '24234234', 'asdasdasd', '2323423423', 'uji@gmail.com', 'uji usaha', '', '', '', '2022-05-02', '2022-06-02', 'test periode qwqew'),
(13, 18, 'wildan', '1234', 'test', '123123123', 'wildan@gmail.com', 'wildansukses', '', '', '', '2024-03-31', '2024-04-02', 'asdasd'),
(14, 19, 'wildan', '1234', 'test', '123123123', 'wildan@gmail.com', 'wildansukses', '', '', '', '2024-04-02', '2024-04-02', 'test periode asd'),
(18, 23, 'wildan', '1234', 'test', '123123123', 'wildan@gmail.com', 'wildansukses', '', '', '', '2023-10-02', '2024-02-03', 'test periode');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporanpemanfaatan`
--

CREATE TABLE `laporanpemanfaatan` (
  `idlaporanpemanfaatan` int(11) NOT NULL,
  `idlaporan` int(11) NOT NULL,
  `nilaibantuan` text NOT NULL,
  `tanggalpencairan` date NOT NULL,
  `nomorrekening` text NOT NULL,
  `namabank` text NOT NULL,
  `modalkerja` text NOT NULL,
  `modalinvestasi` text NOT NULL,
  `penggunaandana` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporanpemanfaatan`
--

INSERT INTO `laporanpemanfaatan` (`idlaporanpemanfaatan`, `idlaporan`, `nilaibantuan`, `tanggalpencairan`, `nomorrekening`, `namabank`, `modalkerja`, `modalinvestasi`, `penggunaandana`) VALUES
(1, 6, '2000000', '2024-03-19', '123124', 'BRI', '3000000', '2000000', 'Beli Barang'),
(2, 7, '200000', '2024-03-30', '23232323', 'test', 'test', 'test', 'test'),
(3, 8, '123123', '2024-03-30', '23232323', 'test', 'test', 'test', 'qweqwe'),
(4, 9, '123123', '2024-03-26', '123123', 'sdasd', '12312', '3123123', 'asdasd'),
(5, 10, '123123', '2024-03-25', '123123', 'asdad', '123123', '123123', 'asdasd'),
(6, 11, '2000000', '2024-04-01', '23232323', 'test', '12312', '3123123', 'qweqwe'),
(7, 12, '500000', '2024-04-02', '23232323', 'test', '400000', '123123', 'asdasd'),
(8, 13, '400000', '2022-12-14', '23232323', 'test', '123123', '3123123', 'sadasda'),
(9, 14, '100000', '2024-04-02', '23232323', 'test', '12312', '3123123', 'asdasd'),
(10, 15, '200000', '2024-04-02', '23232323', 'test', '400000', '250000', 'asdasd'),
(11, 16, '350000', '2024-04-02', '123123', 'test', '400000', '3123123', 'sdadw'),
(12, 17, '400000', '2024-04-02', '23232323', 'test', '400000', '250000', 'sdasd'),
(13, 18, '123131', '2024-04-02', '123123', 'test', '400000', '3123123', 'qweqwe'),
(14, 19, '123123', '2024-04-02', '123123', 'test', '400000', '3123123', 'sdasd'),
(18, 23, '23123123', '2024-04-02', '23232323', 'test', '400000', '123123', 'weqweqwe');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporanpemasaran`
--

CREATE TABLE `laporanpemasaran` (
  `idlaporanpemasaran` int(11) NOT NULL,
  `idlaporan` int(11) NOT NULL,
  `carapemasaran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporanpemasaran`
--

INSERT INTO `laporanpemasaran` (`idlaporanpemasaran`, `idlaporan`, `carapemasaran`) VALUES
(1, 6, 'Iklan'),
(2, 7, 'test'),
(3, 8, 'qweqwe'),
(4, 9, 'asdasd'),
(5, 10, 'qweqwewqe'),
(6, 11, 'qweqwe'),
(7, 12, 'asdasdad'),
(8, 13, 'asdasd'),
(9, 14, 'asdasd'),
(10, 15, 'asdasd'),
(11, 16, 'asdasd'),
(12, 17, 'asdasd'),
(13, 18, 'asdasd'),
(14, 19, 'asdasd'),
(15, 23, 'qweqweq');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporanperkembangan`
--

CREATE TABLE `laporanperkembangan` (
  `idlaporanperkembangan` int(11) NOT NULL,
  `idlaporan` int(11) NOT NULL,
  `jumlahkaryawansebelum` text NOT NULL,
  `jumlahkaryawansesudah` text NOT NULL,
  `omsetsebelum` text NOT NULL,
  `omsetsesudah` text NOT NULL,
  `keuntungansebelum` text NOT NULL,
  `keuntungansesudah` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporanperkembangan`
--

INSERT INTO `laporanperkembangan` (`idlaporanperkembangan`, `idlaporan`, `jumlahkaryawansebelum`, `jumlahkaryawansesudah`, `omsetsebelum`, `omsetsesudah`, `keuntungansebelum`, `keuntungansesudah`, `id`) VALUES
(1, 6, '2', '1', '300000', '300000', '400000', '400000', 2),
(2, 7, '2', '2', '200000', '200000', '100000', '100000', 2),
(3, 8, '2', '3', '200000', '200000', '100000', '100000', 2),
(4, 9, '2', '4', '1231231', '1231231', '123123', '123123', 2),
(5, 10, '2', '3', '2333333', '213123123', '123123', '1231231231', 2),
(6, 11, '2', '3', '200000', '200000', '100000', '100000', 3),
(7, 12, '2', '6', '200000', '600000', '100000', '300000', 2),
(8, 13, '2', '4', '200000', '600000', '100000', '300000', 3),
(9, 14, '2', '3', '200000', '600000', '100000', '300000', 5),
(10, 15, '4', '7', '200000', '600000', '100000', '300000', 5),
(11, 16, '4', '8', '200000', '600000', '100000', '300000', 5),
(12, 17, '4', '2', '200000', '600000', '100000', '100000', 5),
(13, 18, '3', '5', '200000', '400000', '100000', '300000', 3),
(14, 19, '4', '7', '200000', '600000', '100000', '100000', 3),
(15, 23, '2', '4', '200000', '200000', '100000', '100000', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notiflaporan`
--

CREATE TABLE `notiflaporan` (
  `idnotif` int(11) NOT NULL,
  `idlaporan` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `baca` text NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `jenis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `notiflaporan`
--

INSERT INTO `notiflaporan` (`idnotif`, `idlaporan`, `pesan`, `baca`, `waktu`, `jenis`) VALUES
(1, 3, 'Ada Laporan yang baru ditambahkan', 'Sudah', '2024-03-27 11:36:28', ''),
(2, 4, 'Ada Laporan yang baru ditambahkan', 'Sudah', '2024-03-27 13:19:18', ''),
(3, 5, 'Ada Laporan yang baru ditambahkan', '', '2024-03-27 19:13:50', ''),
(4, 6, 'Ada Laporan yang baru ditambahkan', '', '2024-03-28 11:39:05', ''),
(5, 7, 'Ada Laporan yang baru ditambahkan', '', '2024-03-30 20:53:28', ''),
(6, 8, 'Ada Laporan yang baru ditambahkan', '', '2024-03-30 23:47:02', ''),
(7, 9, 'Ada Laporan yang baru ditambahkan', '', '2024-03-31 13:48:58', ''),
(8, 10, 'Ada Laporan yang baru ditambahkan', '', '2024-03-31 14:14:32', ''),
(9, 11, 'Ada Laporan yang baru ditambahkan', '', '2024-04-01 03:34:02', ''),
(10, 12, 'Ada Laporan yang baru ditambahkan', '', '2024-04-02 13:41:23', ''),
(11, 13, 'Ada Laporan yang baru ditambahkan', '', '2024-04-02 14:21:37', ''),
(12, 14, 'Ada Laporan yang baru ditambahkan', '', '2024-04-02 18:06:50', ''),
(13, 15, 'Ada Laporan yang baru ditambahkan', '', '2024-04-02 18:07:56', ''),
(14, 16, 'Ada Laporan yang baru ditambahkan', '', '2024-04-02 18:09:07', ''),
(15, 17, 'Ada Laporan yang baru ditambahkan', '', '2024-04-02 18:10:25', ''),
(16, 18, 'Ada Laporan yang baru ditambahkan', '', '2024-04-02 20:56:37', ''),
(17, 19, 'Ada Laporan yang baru ditambahkan', '', '2024-04-02 21:13:30', ''),
(18, 23, 'Ada Laporan yang baru ditambahkan', '', '2024-04-02 21:22:40', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `alamatusaha` text NOT NULL,
  `npwpusaha` text NOT NULL,
  `nik` text NOT NULL,
  `telepon` text NOT NULL,
  `namausaha` text NOT NULL,
  `bidangusaha` text NOT NULL,
  `jenisproduksi` text NOT NULL,
  `lamausaha` text NOT NULL,
  `level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `username`, `password`, `email`, `alamatusaha`, `npwpusaha`, `nik`, `telepon`, `namausaha`, `bidangusaha`, `jenisproduksi`, `lamausaha`, `level`) VALUES
(1, 'Admin', 'admin', 'admin', 'admin@gmail.com', '-', '-', '-', '--', '-', '', '', '', 'Admin'),
(2, 'Bayam', 'bayam', 'bayam', 'bayam@gmail.com', 'Jalan Kodran Jakarta', '013212', '1234', '0898678', 'CV. Saur123', '', '', '', 'User'),
(3, 'wildan', 'wildan', 'wildan', 'wildan@gmail.com', 'test', '12313', '1234', '123123123', 'wildansukses', 'asda', 'asdasd', '12312', 'User'),
(4, 'test ', 'test', 'test', 'test@gmail.com', 'test', '123123', '1234', '1231231', 'test', 'test', 'test', '123123', 'User'),
(5, 'uji', 'uji', 'uji', 'uji@gmail.com', 'asdasdasd', '2313123123', '24234234', '2323423423', 'uji usaha', 'asdasd', 'asdad', '123123', 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `idtransaksi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `jenis` text NOT NULL,
  `pendapatan` text NOT NULL,
  `pengeluaran` text NOT NULL,
  `id` int(11) NOT NULL,
  `idlaporan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `tanggal`, `keterangan`, `jenis`, `pendapatan`, `pengeluaran`, `id`, `idlaporan`) VALUES
(1, '2024-03-26', 'tes 1', 'Pendapatan', '200000', '0', 2, 0),
(2, '2024-03-26', 'tes 2 ', 'Pengeluaran', '0', '150000', 2, 0),
(4, '2024-03-27', 'tes 3', 'Pendapatan', '200000', '0', 2, 0),
(5, '2024-03-27', 'tes 4', 'Pengeluaran', '0', '50000', 2, 0),
(6, '2023-12-01', 'tes', 'Pendapatan', '200000', '0', 2, 0),
(7, '2024-03-27', 'pemasukan', 'Pendapatan', '100000', '0', 2, 0),
(8, '2024-04-01', 'asd', 'Pendapatan', '50000', '0', 3, 18),
(9, '2024-04-01', 'fdgdfg', 'Pendapatan', '300000', '0', 3, 18),
(10, '2023-04-01', 'ertert', 'Pendapatan', '40000', '0', 3, 0),
(11, '2023-04-01', 'etert', 'Pendapatan', '10000', '0', 3, 0),
(12, '2024-04-02', 'asd', 'Pendapatan', '10000000', '0', 5, 0),
(13, '2024-04-01', 'asd', 'Pendapatan', '20000', '0', 5, 0),
(14, '2024-02-05', 'asd', 'Pendapatan', '10000', '0', 5, 0),
(15, '2023-10-25', 'asd', 'Pendapatan', '30000', '0', 5, 0),
(16, '2023-12-01', 'asdasd', 'Pendapatan', '20000', '0', 3, 23),
(17, '2024-04-02', 'asdasd', 'Pendapatan', '50000', '0', 3, 19),
(18, '2024-01-01', 'test 1 januari 2024', 'Pendapatan', '200000', '0', 3, 23),
(19, '2024-01-02', 'test 2 januari 2024', 'Pendapatan', '50000', '0', 3, 23),
(20, '2023-07-01', 'test 1 juli 2023', 'Pendapatan', '100000', '0', 3, 0),
(21, '2023-07-02', 'Test 2 juli 2023', 'Pendapatan', '50000', '0', 3, 0),
(22, '2022-03-01', 'test 1 maret 2022', 'Pendapatan', '50000', '0', 3, 0),
(23, '2022-03-02', 'test 2 maret 2022', 'Pendapatan', '50000', '0', 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`idlaporan`);

--
-- Indeks untuk tabel `laporanbantuan`
--
ALTER TABLE `laporanbantuan`
  ADD PRIMARY KEY (`idlaporanbantuan`);

--
-- Indeks untuk tabel `laporanidentitas`
--
ALTER TABLE `laporanidentitas`
  ADD PRIMARY KEY (`idlaporanidentitas`);

--
-- Indeks untuk tabel `laporanpemanfaatan`
--
ALTER TABLE `laporanpemanfaatan`
  ADD PRIMARY KEY (`idlaporanpemanfaatan`);

--
-- Indeks untuk tabel `laporanpemasaran`
--
ALTER TABLE `laporanpemasaran`
  ADD PRIMARY KEY (`idlaporanpemasaran`);

--
-- Indeks untuk tabel `laporanperkembangan`
--
ALTER TABLE `laporanperkembangan`
  ADD PRIMARY KEY (`idlaporanperkembangan`);

--
-- Indeks untuk tabel `notiflaporan`
--
ALTER TABLE `notiflaporan`
  ADD PRIMARY KEY (`idnotif`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtransaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `idlaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `laporanbantuan`
--
ALTER TABLE `laporanbantuan`
  MODIFY `idlaporanbantuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `laporanidentitas`
--
ALTER TABLE `laporanidentitas`
  MODIFY `idlaporanidentitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `laporanpemanfaatan`
--
ALTER TABLE `laporanpemanfaatan`
  MODIFY `idlaporanpemanfaatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `laporanpemasaran`
--
ALTER TABLE `laporanpemasaran`
  MODIFY `idlaporanpemasaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `laporanperkembangan`
--
ALTER TABLE `laporanperkembangan`
  MODIFY `idlaporanperkembangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `notiflaporan`
--
ALTER TABLE `notiflaporan`
  MODIFY `idnotif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
