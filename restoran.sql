-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Nov 2021 pada 06.14
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telpon` varchar(16),
  `jenis_kelamin` varchar(16), 
  `tanggal_lahir` date,
  `role` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

-- INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
-- (17, 'Syafnides Wulan S', 'syafnideswulan@gmail.com', 'cfe4de3567eadaf6682db4754ce09ef2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- create products table
CREATE TABLE IF NOT EXISTS `products`(
  `id` INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `product_name` varchar(255) NOT NULL, 
  `product_price` FLOAT, 
  `product_image` varchar(100)
);

-- insert special products
INSERT INTO  `products` (id, product_name, product_price, product_image) VALUES 
(1, 'spicy noodles', 45000, 'image/home-img-1.png' ),
(2, 'fried chicken', 49500, 'image/home-img-2.png' ),
(3, 'hot pizza', 47500, 'image/home-img-3.png' ),
(4, 'burger, cola, and fries', 48500, 'image/cat-1.png' );


-- insert data into products table
INSERT INTO  `products` (product_name, product_price, product_image) VALUES
('produk 1',40000,'image/food-1.png'),
('produk 2',39000,'image/food-2.png'),
('produk 3',39500,'image/food-3.png'),
('produk 4',38000,'image/food-4.png'),
('produk 5',35000,'image/food-5.png'),
('produk 6',37500,'image/food-6.png'),
('produk 7',36500,'image/food-7.png'),
('produk 8',39000,'image/food-8.png');

-- create cart table to store information user id and product id in cart
CREATE TABLE IF NOT EXISTS `cart` (
  `user_id` INT(255) NOT NULL,
  `product_id` INT(255) NOT NULL
);

-- create table to store costumer order
CREATE TABLE IF NOT EXISTS 'costumer_order' (
  `order_id` INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `costumer_id` INT(255) NOT NULL,
  `costumer_payment_method_id` INT(255), 
  `date_created` DATE NOT NULL, 
  `total_order_price` int(255) NOT NULL,
  `order_status` varchar(255)
);

CREATE TABLE IF NOT EXISTS `costumer_order_products`(
  `id` INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `order_id` INT(255),
  `product_id` INT(255), 
  `quantity` INT (255),
  `harga_satuan` INT (255),
  `comment` VARCHAR(255) 
);