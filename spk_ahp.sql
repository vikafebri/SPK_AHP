-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 04, 2016 at 01:34 PM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spk_ahp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` varchar(18) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `nomor_telepon` varchar(13) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `photo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `nomor_telepon`, `jenis_kelamin`, `agama`, `photo`) VALUES
('root', 'Wildan One Alika', 'Muara Mahat', '1993-08-27', 'Jl. Manunggal', '085265878958', 'Laki-Laki', 'Islam', 'gambar/Admin/root.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `admin_sekolah`
--

CREATE TABLE IF NOT EXISTS `admin_sekolah` (
  `nip` varchar(18) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `nomor_telepon` varchar(13) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `photo` text NOT NULL,
  `id_sekolah` varchar(10) NOT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_sekolah`
--

INSERT INTO `admin_sekolah` (`nip`, `nama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `nomor_telepon`, `jenis_kelamin`, `agama`, `photo`, `id_sekolah`) VALUES
('11051103136', 'Wildan One Alika', 'Muara Mahat', '1993-08-27', 'Jl. Manunggal', '085265878958', 'Laki-Laki', 'Islam', 'gambar/Admin_Sekolah/11051103136.jpg', 'Sekolah-01'),
('11051103137', 'Shaddam Hassan Al Arisi', 'Danau Bingkuang', '1991-12-20', 'Jl. Garuda, Pekanbaru', '085208520852', 'Laki-Laki', 'Islam', 'gambar/Admin_Sekolah/11051103137.jpg', 'Sekolah-02'),
('11051103140', 'Andi Saputra', 'Pekanbaru', '1992-01-01', 'Jl. Setia Budi, Pekanbaru', '085208520852', 'Laki-Laki', 'Islam', 'gambar/Admin_Sekolah/11051103140.JPG', 'Sekolah-03');

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE IF NOT EXISTS `alternatif` (
  `id_alternatif` varchar(13) NOT NULL,
  `alternatif` varchar(50) NOT NULL,
  PRIMARY KEY (`id_alternatif`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `alternatif`) VALUES
('Alternatif-06', 'Standar Pengelolaan'),
('Alternatif-01', 'Standar Isi'),
('Alternatif-02', 'Standar Proses'),
('Alternatif-03', 'Standar Kompetensi Lulusan'),
('Alternatif-04', 'Standar Pendidik dan Tenaga Kependidikan'),
('Alternatif-05', 'Standar Sarana dan Prasarana'),
('Alternatif-07', 'Standar Pembiayaan'),
('Alternatif-08', 'Standar Penilaian Pendidikan');

-- --------------------------------------------------------

--
-- Table structure for table `alternatif_kriteria`
--

CREATE TABLE IF NOT EXISTS `alternatif_kriteria` (
  `id_alternatif_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `id_sekolah` varchar(11) NOT NULL,
  `id_alternatif` varchar(13) NOT NULL,
  `id_kriteria` varchar(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `nilai` double NOT NULL,
  PRIMARY KEY (`id_alternatif_kriteria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=521 ;

--
-- Dumping data for table `alternatif_kriteria`
--

INSERT INTO `alternatif_kriteria` (`id_alternatif_kriteria`, `id_sekolah`, `id_alternatif`, `id_kriteria`, `tahun`, `nilai`) VALUES
(520, 'Sekolah-02', 'Alternatif-08', 'Kriteria-04', 2016, 0.10330545389779),
(519, 'Sekolah-02', 'Alternatif-07', 'Kriteria-04', 2016, 0.16098968614294),
(518, 'Sekolah-02', 'Alternatif-06', 'Kriteria-04', 2016, 0.10212938426855),
(517, 'Sekolah-02', 'Alternatif-05', 'Kriteria-04', 2016, 0.27293535232703),
(516, 'Sekolah-02', 'Alternatif-04', 'Kriteria-04', 2016, 0.12835734456111),
(515, 'Sekolah-02', 'Alternatif-03', 'Kriteria-04', 2016, 0.087699282064966),
(514, 'Sekolah-02', 'Alternatif-02', 'Kriteria-04', 2016, 0.068758610008836),
(513, 'Sekolah-02', 'Alternatif-01', 'Kriteria-04', 2016, 0.075824886728793),
(512, 'Sekolah-02', 'Alternatif-08', 'Kriteria-03', 2016, 0.122),
(511, 'Sekolah-02', 'Alternatif-07', 'Kriteria-03', 2016, 1),
(509, 'Sekolah-02', 'Alternatif-05', 'Kriteria-03', 2016, 0.665),
(510, 'Sekolah-02', 'Alternatif-06', 'Kriteria-03', 2016, 0.423),
(508, 'Sekolah-02', 'Alternatif-04', 'Kriteria-03', 2016, 0.195),
(507, 'Sekolah-02', 'Alternatif-03', 'Kriteria-03', 2016, 0.423),
(506, 'Sekolah-02', 'Alternatif-02', 'Kriteria-03', 2016, 0.665),
(505, 'Sekolah-02', 'Alternatif-01', 'Kriteria-03', 2016, 0.195),
(503, 'Sekolah-02', 'Alternatif-07', 'Kriteria-02', 2016, 0.405),
(504, 'Sekolah-02', 'Alternatif-08', 'Kriteria-02', 2016, 0.405),
(501, 'Sekolah-02', 'Alternatif-05', 'Kriteria-02', 2016, 0.164),
(502, 'Sekolah-02', 'Alternatif-06', 'Kriteria-02', 2016, 0.405),
(500, 'Sekolah-02', 'Alternatif-04', 'Kriteria-02', 2016, 0.405),
(499, 'Sekolah-02', 'Alternatif-03', 'Kriteria-02', 2016, 0.405),
(498, 'Sekolah-02', 'Alternatif-02', 'Kriteria-02', 2016, 1),
(497, 'Sekolah-02', 'Alternatif-01', 'Kriteria-02', 2016, 0.164),
(496, 'Sekolah-02', 'Alternatif-08', 'Kriteria-01', 2016, 0.405),
(495, 'Sekolah-02', 'Alternatif-07', 'Kriteria-01', 2016, 1),
(494, 'Sekolah-02', 'Alternatif-06', 'Kriteria-01', 2016, 0.164),
(493, 'Sekolah-02', 'Alternatif-05', 'Kriteria-01', 2016, 0.405),
(492, 'Sekolah-02', 'Alternatif-04', 'Kriteria-01', 2016, 0.405),
(491, 'Sekolah-02', 'Alternatif-03', 'Kriteria-01', 2016, 0.164),
(490, 'Sekolah-02', 'Alternatif-02', 'Kriteria-01', 2016, 1),
(489, 'Sekolah-02', 'Alternatif-01', 'Kriteria-01', 2016, 0.405),
(488, 'Sekolah-01', 'Alternatif-08', 'Kriteria-04', 2016, 0.10330545389779),
(487, 'Sekolah-01', 'Alternatif-07', 'Kriteria-04', 2016, 0.16098968614294),
(486, 'Sekolah-01', 'Alternatif-06', 'Kriteria-04', 2016, 0.10212938426855),
(485, 'Sekolah-01', 'Alternatif-05', 'Kriteria-04', 2016, 0.27293535232703),
(484, 'Sekolah-01', 'Alternatif-04', 'Kriteria-04', 2016, 0.12835734456111),
(483, 'Sekolah-01', 'Alternatif-03', 'Kriteria-04', 2016, 0.087699282064966),
(482, 'Sekolah-01', 'Alternatif-02', 'Kriteria-04', 2016, 0.068758610008836),
(481, 'Sekolah-01', 'Alternatif-01', 'Kriteria-04', 2016, 0.075824886728793),
(480, 'Sekolah-01', 'Alternatif-08', 'Kriteria-03', 2016, 0.423),
(479, 'Sekolah-01', 'Alternatif-07', 'Kriteria-03', 2016, 0.122),
(478, 'Sekolah-01', 'Alternatif-06', 'Kriteria-03', 2016, 1),
(477, 'Sekolah-01', 'Alternatif-05', 'Kriteria-03', 2016, 0.195),
(476, 'Sekolah-01', 'Alternatif-04', 'Kriteria-03', 2016, 0.195),
(475, 'Sekolah-01', 'Alternatif-03', 'Kriteria-03', 2016, 1),
(474, 'Sekolah-01', 'Alternatif-02', 'Kriteria-03', 2016, 0.423),
(473, 'Sekolah-01', 'Alternatif-01', 'Kriteria-03', 2016, 1),
(472, 'Sekolah-01', 'Alternatif-08', 'Kriteria-02', 2016, 0.164),
(471, 'Sekolah-01', 'Alternatif-07', 'Kriteria-02', 2016, 0.405),
(470, 'Sekolah-01', 'Alternatif-06', 'Kriteria-02', 2016, 0.164),
(469, 'Sekolah-01', 'Alternatif-05', 'Kriteria-02', 2016, 0.164),
(468, 'Sekolah-01', 'Alternatif-04', 'Kriteria-02', 2016, 0.405),
(467, 'Sekolah-01', 'Alternatif-03', 'Kriteria-02', 2016, 0.164),
(466, 'Sekolah-01', 'Alternatif-02', 'Kriteria-02', 2016, 0.405),
(465, 'Sekolah-01', 'Alternatif-01', 'Kriteria-02', 2016, 0.405),
(464, 'Sekolah-01', 'Alternatif-08', 'Kriteria-01', 2016, 0.164),
(463, 'Sekolah-01', 'Alternatif-07', 'Kriteria-01', 2016, 0.164),
(462, 'Sekolah-01', 'Alternatif-06', 'Kriteria-01', 2016, 0.164),
(461, 'Sekolah-01', 'Alternatif-05', 'Kriteria-01', 2016, 0.164),
(460, 'Sekolah-01', 'Alternatif-04', 'Kriteria-01', 2016, 0.405),
(459, 'Sekolah-01', 'Alternatif-03', 'Kriteria-01', 2016, 0.164),
(458, 'Sekolah-01', 'Alternatif-02', 'Kriteria-01', 2016, 1),
(457, 'Sekolah-01', 'Alternatif-01', 'Kriteria-01', 2016, 0.405);

-- --------------------------------------------------------

--
-- Table structure for table `bobot_alternatif`
--

CREATE TABLE IF NOT EXISTS `bobot_alternatif` (
  `id_kriteria` varchar(11) NOT NULL,
  `standar_isi` double NOT NULL,
  `standar_proses` double NOT NULL,
  `standar_kompetensi_lulusan` double NOT NULL,
  `standar_pendidik_dan_tenaga_kependidikan` double NOT NULL,
  `standar_sarana_dan_prasarana` double NOT NULL,
  `standar_pengelolaan` double NOT NULL,
  `standar_pembiayaan` double NOT NULL,
  `standar_penilaian_pendidikan` double NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot_alternatif`
--

INSERT INTO `bobot_alternatif` (`id_kriteria`, `standar_isi`, `standar_proses`, `standar_kompetensi_lulusan`, `standar_pendidik_dan_tenaga_kependidikan`, `standar_sarana_dan_prasarana`, `standar_pengelolaan`, `standar_pembiayaan`, `standar_penilaian_pendidikan`) VALUES
('Kriteria-01', 0.075639420360403, 0.055219491240084, 0.093794576203355, 0.14098852525092, 0.23242462538267, 0.13795822222061, 0.16234886780691, 0.10162627153505),
('Kriteria-02', 0.070786440230817, 0.061478663065897, 0.082941302175595, 0.13091626735547, 0.26907325757665, 0.096004860932431, 0.17239801090141, 0.11640119776174),
('Kriteria-03', 0.087192713893976, 0.086519467470108, 0.093262383140985, 0.11208715442881, 0.29136203799908, 0.08594859269836, 0.14878187525022, 0.094845775118466),
('Kriteria-04', 0.064750324141809, 0.057887232849422, 0.088197220710548, 0.15634696279727, 0.26340312361251, 0.15243267565808, 0.1455510311523, 0.071431429078062);

-- --------------------------------------------------------

--
-- Table structure for table `bobot_kriteria`
--

CREATE TABLE IF NOT EXISTS `bobot_kriteria` (
  `pakar` varchar(8) NOT NULL,
  `dana` double DEFAULT NULL,
  `sumber_daya_manusia__sdm_` double DEFAULT NULL,
  `jangka_waktu_perbaikan` double DEFAULT NULL,
  `bobot_ban_s_m` double DEFAULT NULL,
  PRIMARY KEY (`pakar`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`pakar`, `dana`, `sumber_daya_manusia__sdm_`, `jangka_waktu_perbaikan`, `bobot_ban_s_m`) VALUES
('Pakar-01', 0.092327235772358, 0.4712906504065, 0.33795731707317, 0.098424796747967),
('Pakar-02', 0.083267061885483, 0.41839574898785, 0.38268146327357, 0.11565572585309),
('Pakar-03', 0.050738763974058, 0.57639677492619, 0.25562432180079, 0.11724013929896);

-- --------------------------------------------------------

--
-- Table structure for table `galeri_sekolah`
--

CREATE TABLE IF NOT EXISTS `galeri_sekolah` (
  `id_sekolah` varchar(10) NOT NULL,
  `foto` varchar(50) NOT NULL,
  PRIMARY KEY (`id_sekolah`,`foto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galeri_sekolah`
--

INSERT INTO `galeri_sekolah` (`id_sekolah`, `foto`) VALUES
('Sekolah-01', 'gambar/galeri_sekolah/Sekolah-01/0.jpg'),
('Sekolah-01', 'gambar/galeri_sekolah/Sekolah-01/1.jpg'),
('Sekolah-01', 'gambar/galeri_sekolah/Sekolah-01/2.png'),
('Sekolah-01', 'gambar/galeri_sekolah/Sekolah-01/3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE IF NOT EXISTS `hak_akses` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hak_akses` varchar(20) NOT NULL,
  `id` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`username`, `password`, `hak_akses`, `id`) VALUES
('admin', 'admin', 'Administrator', 'root'),
('11051103138', '11051103138', 'Kadis', '11051103138'),
('11051103139', '11051103139', 'UPA', '11051103139'),
('11051103136', '11051103136', 'Admin Sekolah', '11051103136'),
('11051103137', '11051103137', 'Admin Sekolah', '11051103137'),
('11051103140', '11051103140', 'Admin Sekolah', '11051103140');

-- --------------------------------------------------------

--
-- Table structure for table `kadis`
--

CREATE TABLE IF NOT EXISTS `kadis` (
  `nip` varchar(18) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `nomor_telepon` varchar(13) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `photo` text NOT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kadis`
--

INSERT INTO `kadis` (`nip`, `nama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `nomor_telepon`, `jenis_kelamin`, `agama`, `photo`) VALUES
('11051103138', 'Drs. Rudinal. B.M, Si', 'Bangkinang', '1971-01-01', 'Bangkinang', '085208520852', 'Laki-Laki', 'Islam', 'gambar/Kadis/11051103138.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` varchar(11) NOT NULL,
  `kriteria` varchar(50) NOT NULL,
  `costbenefit` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `costbenefit`) VALUES
('Kriteria-01', 'Dana', 'benefit'),
('Kriteria-02', 'Sumber Daya Manusia (SDM)', 'benefit'),
('Kriteria-04', 'Bobot BAN-S/M', 'benefit'),
('Kriteria-03', 'Jangka Waktu Perbaikan', 'benefit');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE IF NOT EXISTS `laporan` (
  `id_laporan` int(11) NOT NULL AUTO_INCREMENT,
  `id_sekolah` varchar(10) NOT NULL,
  `tahun` year(4) NOT NULL,
  `rangking1` varchar(50) NOT NULL,
  `rangking2` varchar(50) NOT NULL,
  `rangking3` varchar(50) NOT NULL,
  `rangking4` varchar(50) NOT NULL,
  `rangking5` varchar(50) NOT NULL,
  `rangking6` varchar(50) NOT NULL,
  `rangking7` varchar(50) NOT NULL,
  `rangking8` varchar(50) NOT NULL,
  `bobot1` double NOT NULL,
  `bobot2` double NOT NULL,
  `bobot3` double NOT NULL,
  `bobot4` double NOT NULL,
  `bobot5` double NOT NULL,
  `bobot6` double NOT NULL,
  `bobot7` double NOT NULL,
  `bobot8` double NOT NULL,
  PRIMARY KEY (`id_laporan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `id_sekolah`, `tahun`, `rangking1`, `rangking2`, `rangking3`, `rangking4`, `rangking5`, `rangking6`, `rangking7`, `rangking8`, `bobot1`, `bobot2`, `bobot3`, `bobot4`, `bobot5`, `bobot6`, `bobot7`, `bobot8`) VALUES
(2, 'Sekolah-01', 2016, 'Standar Isi', 'Standar Proses', 'Standar Pendidik dan Tenaga Kependidikan', 'Standar Pengelolaan', 'Standar Kompetensi Lulusan', 'Standar Pembiayaan', 'Standar Sarana dan Prasarana', 'Standar Penilaian Pendidikan', 0.18162419708571, 0.15482620061717, 0.12731484870931, 0.12586929155497, 0.12427562788385, 0.11855436610745, 0.084622095743023, 0.08291337229851),
(3, 'Sekolah-02', 2016, 'Standar Proses', 'Standar Pembiayaan', 'Standar Sarana dan Prasarana', 'Standar Pengelolaan', 'Standar Kompetensi Lulusan', 'Standar Pendidik dan Tenaga Kependidikan', 'Standar Penilaian Pendidikan', 'Standar Isi', 0.23112977203342, 0.18415515883509, 0.12046327283182, 0.11076584704558, 0.10917218337446, 0.098149641080326, 0.088941544800901, 0.057222579998395);

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan_kuisioner`
--

CREATE TABLE IF NOT EXISTS `pertanyaan_kuisioner` (
  `id_pertanyaan` varchar(13) NOT NULL,
  `id_kriteria` varchar(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `nilai` double NOT NULL,
  PRIMARY KEY (`id_pertanyaan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pertanyaan_kuisioner`
--

INSERT INTO `pertanyaan_kuisioner` (`id_pertanyaan`, `id_kriteria`, `pertanyaan`, `nilai`) VALUES
('Pertanyaan-01', 'Kriteria-01', 'Tersedianya dana yang lebih untuk meningkatkan standar', 1),
('Pertanyaan-02', 'Kriteria-01', 'Tersedianya dana yang cukup untuk meningkatkan standar', 0.405),
('Pertanyaan-03', 'Kriteria-01', 'Tidak tersedia dana untuk meningkatkan standar', 0.164),
('Pertanyaan-04', 'Kriteria-02', 'Tersedianya Sumber Daya Manusia Yang Berkompeten dan Mencukupi Jumlahnya', 1),
('Pertanyaan-05', 'Kriteria-02', 'Tersedianya Sumber Daya Manusia Yang Mencukupi Jumlahnya', 0.405),
('Pertanyaan-06', 'Kriteria-02', 'Kurangnya Sumber Daya Manusia', 0.164),
('Pertanyaan-08', 'Kriteria-03', 'Merencanakan Perbaikan Dalam Jangka Waktu 1 Hingga 2 Tahun', 0.665),
('Pertanyaan-07', 'Kriteria-03', 'Merencanakan Perbaikan Dalam Jangka Waktu Kurang Dari 1 Tahun', 1),
('Pertanyaan-09', 'Kriteria-03', 'Merencanakan Perbaikan Dalam Jangka Waktu 2 Hingga 3 Tahun', 0.423),
('Pertanyaan-10', 'Kriteria-03', 'Merencanakan Perbaikan Dalam Jangka Waktu 3 Hingga 4 Tahun', 0.195),
('Pertanyaan-19', 'Kriteria-04', 'Standar 8', 0.10330545389779),
('Pertanyaan-18', 'Kriteria-04', 'Standar 7', 0.16098968614294),
('Pertanyaan-17', 'Kriteria-04', 'Standar 6', 0.10212938426855),
('Pertanyaan-16', 'Kriteria-04', 'Standar 5', 0.27293535232703),
('Pertanyaan-15', 'Kriteria-04', 'Standar 4', 0.12835734456111),
('Pertanyaan-14', 'Kriteria-04', 'Standar 3', 0.087699282064966),
('Pertanyaan-13', 'Kriteria-04', 'Standar 2', 0.068758610008836),
('Pertanyaan-11', 'Kriteria-03', 'Merencanakan Perbaikan Dalam Jangka Waktu 4 Hingga 5 Tahun', 0.122),
('Pertanyaan-12', 'Kriteria-04', 'Standar 1', 0.075824886728793);

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE IF NOT EXISTS `sekolah` (
  `id_sekolah` varchar(10) NOT NULL,
  `nama_sekolah` varchar(75) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `nomor_telepon_sekolah` varchar(12) NOT NULL,
  PRIMARY KEY (`id_sekolah`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id_sekolah`, `nama_sekolah`, `alamat_sekolah`, `nomor_telepon_sekolah`) VALUES
('Sekolah-01', 'SMA Negeri 1 Bangkinang', 'Jl. Sudirman, Bangkinang', '085265878958'),
('Sekolah-02', 'SMA Negeri 1 Bangkinang Barat', 'Salo, Tarandam, Bangkinang Barat', '085208520852'),
('Sekolah-03', 'SMA Negeri 4 Pekanbaru', 'Jl. Adi Sucipto, Pekanbaru', '085208520852');

-- --------------------------------------------------------

--
-- Table structure for table `upa`
--

CREATE TABLE IF NOT EXISTS `upa` (
  `nip` varchar(18) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `nomor_telepon` varchar(13) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `photo` text NOT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upa`
--

INSERT INTO `upa` (`nip`, `nama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `nomor_telepon`, `jenis_kelamin`, `agama`, `photo`) VALUES
('11051103139', 'Helen Fadtria, S.Sos', 'Bangkinang', '1988-02-09', 'Bangkinang', '085208520852', 'Perempuan', 'Islam', 'gambar/UPA/11051103139.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
