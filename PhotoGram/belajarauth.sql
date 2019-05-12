-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Bulan Mei 2019 pada 12.08
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belajarauth`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `comment`
--

INSERT INTO `comment` (`id`, `status_id`, `user_id`, `comment`) VALUES
(10, 8, 8, 'good'),
(11, 7, 8, 'Kuda lumping'),
(12, 8, 7, 'yaudah'),
(16, 7, 7, 'HAHAHAHAHAHAH'),
(17, 8, 8, 'annjay'),
(19, 8, 7, '<b>syahru</b> Test anjay :v');

-- --------------------------------------------------------

--
-- Struktur dari tabel `friend`
--

CREATE TABLE `friend` (
  `id` int(11) NOT NULL,
  `me` int(11) NOT NULL,
  `friend` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `friend`
--

INSERT INTO `friend` (`id`, `me`, `friend`) VALUES
(6, 7, 10),
(7, 0, 0),
(9, 0, 11),
(14, 7, 9),
(15, 7, 12),
(17, 8, 9),
(18, 8, 12),
(19, 8, 10),
(21, 9, 8),
(22, 9, 7),
(23, 10, 8),
(24, 10, 7),
(25, 10, 9),
(26, 11, 8),
(27, 11, 7),
(28, 8, 11),
(29, 12, 8),
(30, 12, 9),
(31, 12, 10),
(32, 12, 11),
(33, 12, 13),
(34, 12, 15),
(35, 14, 7),
(36, 14, 10),
(37, 14, 13),
(38, 14, 15),
(39, 14, 8),
(57, 8, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `likes`
--

CREATE TABLE `likes` (
  `likes` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `likes`
--

INSERT INTO `likes` (`likes`, `status_id`, `user_id`) VALUES
(29, 8, 8),
(30, 7, 8),
(31, 7, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `msg_send` int(11) NOT NULL,
  `msg_receive` int(11) NOT NULL,
  `message` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `message`
--

INSERT INTO `message` (`id`, `msg_send`, `msg_receive`, `message`, `datetime`) VALUES
(1, 7, 8, 'test', '2019-05-10 17:40:35'),
(2, 8, 7, 'hai', '2019-05-10 18:00:29'),
(3, 11, 8, 'ini diva', '2019-05-10 18:02:19'),
(4, 8, 7, 'apa?', '2019-05-11 16:45:05'),
(5, 8, 7, 'apa?', '2019-05-11 16:45:17'),
(6, 8, 11, 'oh', '2019-05-11 16:48:01'),
(7, 8, 11, 'oh', '2019-05-11 16:48:20'),
(8, 8, 11, 'oh', '2019-05-11 16:48:52'),
(9, 8, 11, 'shit', '2019-05-11 16:48:59'),
(10, 8, 11, 'lah', '2019-05-11 16:49:02'),
(11, 8, 10, 'p', '2019-05-11 16:49:10'),
(12, 8, 10, 'gak jawab PKI', '2019-05-11 16:49:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `caption` text NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `notification`
--

INSERT INTO `notification` (`id`, `user_name`, `caption`, `link`) VALUES
(14, 'syahru', '<b>yudono&nbsp;Tagged You!</b>&nbsp; Test anjay :v', 'dashboard.php?page=status&id=8'),
(40, 'yudono', 'syahru is <b>Unfollow</b> you!', '#'),
(41, 'yudono', 'syahru now <b>Following</b> you!', '#');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `s_id` int(11) NOT NULL,
  `sender_id` int(255) NOT NULL,
  `caption` text NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`s_id`, `sender_id`, `caption`, `file`) VALUES
(7, 7, '', 'upload/3lqbNykYtdCtuA1191DpLBsHt7U4tCYI.jpg'),
(8, 8, 'test', 'upload/rUhGLbfzM8f65iSe2JoJgS3I3VTe8H8L.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `bg` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `active` varchar(255) NOT NULL DEFAULT 'active',
  `gender` varchar(255) DEFAULT NULL,
  `hobi` varchar(255) DEFAULT NULL,
  `bio` text,
  `website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `user`, `email`, `password`, `profile`, `bg`, `role`, `active`, `gender`, `hobi`, `bio`, `website`) VALUES
(7, 'yudono', 'yudonoputro@gmail.com', '$2y$10$iQkaAq0p5VWM3ey9BQ5xSOEsOw7zV.TyOp2F4cMB5I6cIRyA7XUgm', 'upload/XT1cKss418KRmHqnmnVviq2sEdvnK8RcG18QZMrTn8sjILVz9rcSmOJ7U8rsGATJtxhhux7usaD844zm8mJsxYMN7wVeE36pk24P5A5j5zXeQzcqVO2LAIkDPmQlUfwB.jpg', 'upload/HmV2nFrVace4zHvVNIyLI1MU2pP6njtV5I0V1sq6XyGH5DpB3UH8UPOJduVCLbCqaIJowzCB8sq1u822U6DXRZmlcmI3QLMjuQlu2tePbfSezZ1YR8wHKP4Hu3oHy4qz.jpg', 'admin', 'active', 'male', '', '', ''),
(8, 'syahru', 'syahru@gmail.com', '$2y$10$JnQMDTVl4BhiLWwg3bzSP.kH5/WUIQfWAKXNToN.W0UsRRWnVe9dC', 'upload/NJ3eadJzg0kKmluSXttK2dunGPEDU6FC4y1IyCDCAiN7CTv41IAxtp6tRNnohAajxd8B0RNv1f1aJkTqsTknw1ApQ2Oygpk0NJ8ScagQQtigy5VoPr04hNhKrKbwRzmx.png', '', 'admin', 'active', 'male', 'coding', 'nolep', 'teragadgets.000webhostapp.com'),
(9, 'rahul', 'rahul@gmail.com', '$2y$10$bVAAXQ6Sys9nVVrLqmd5Vu/R1b30oy/2vMHrNN7/W8HCm3D5SS6Am', '', '', 'admin', 'active', 'male', '', '', ''),
(10, 'ikram', 'ikram@gmail.com', '$2y$10$8vcSGST/DGzcLlnFLkFCJuXyXAbhSfIekz4CNwmJAur1/dCWEyI4q', '', '', 'admin', 'active', 'male', '', '', ''),
(11, 'diva', 'diva@gmail.com', '$2y$10$DTn78W44vtjhox7XvS782eB0MkzW44129GRKNFafALqytH4/Ymivu', '', '', 'admin', 'active', 'male', '', '', ''),
(12, 'syaban', 'syaban@gmail.com', '$2y$10$w/t0JUanDD8mv/swKOD/p.TcYDvERGTe8mrceSeX3IdxhRmAVA3aS', '', '', 'admin', 'active', 'male', '', '', ''),
(13, 'fashikin', 'fashikin@gmail.com', '$2y$10$jHV0mv/b3kFLeMrBXoicXOBHljAFSf0LQM6PD00ZG3yQpOM4cXKBy', '', '', 'admin', 'active', 'male', '', '', ''),
(14, 'gugus', 'gugus@gmail.com', '$2y$10$VleOjJ.jcV8Pth/hfQuXjO2Y3eUyd3LAVgx2O1hAtKTMHZLVYp/KG', '', '', 'admin', 'active', 'male', '', '', ''),
(15, 'dimas', 'dimas@gmail.com', '$2y$10$Yt6N.tvKGMWylzUybBYPd.0h/DzolpzwCGJoTgtQy9.vdjfoPwgEq', '', '', 'admin', 'active', 'male', '', '', ''),
(16, 'syarif', 'syarif@gmail.com', '$2y$10$aofxlISWj/IlRgl950hg1.8swNvdkVnJ6r0unt3hmkbO6Geid13lC', '', '', 'admin', 'active', 'male', '', '', ''),
(17, 'defrands', 'defrands@gmail.com', '$2y$10$.EwG5QGhI4rwgc9BbGhNc.Cw1uMtnTtNBLZrAX5H1wCEpJ87OlmqK', '', '', 'admin', 'active', 'male', '', '', ''),
(18, 'bayu', 'bayu@gmail.com', '$2y$10$TZXycfNVDEbQTUdrq/VoQOgs9CuwVfCvmgZ2lfdZVghDaJ5rdibvi', '', '', 'admin', 'active', 'male', '', '', ''),
(19, 'benno', 'benno@gmail.com', '$2y$10$nOchYPUcSCL4p80DAJ5Af.k4XO6aerrTEyMeTWy5wIx6k6PL3hd3O', '', '', 'admin', 'active', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likes`);

--
-- Indeks untuk tabel `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`s_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `friend`
--
ALTER TABLE `friend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `likes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
