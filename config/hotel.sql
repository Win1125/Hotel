-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2023 a las 22:00:06
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mypassword` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id`, `admin_name`, `email`, `mypassword`, `created_at`) VALUES
(1, 'Admin', 'admin.first@gmail.com', '$2y$10$.NdyKa0hBtfKjmumbYP/ROBA8zJo8mG0QvUw1eDZ5xJr6hcHDBqbS', '2023-10-21 09:20:45'),
(2, 'arroz', 'admin.second@gmail.com', '$2y$10$prJLCe7onoVv2e96ZMfwGOH5UfA762oWnWWhFVMsOvIBfvUrJeE9q', '2023-10-21 23:33:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone_number` int(40) NOT NULL,
  `check_in` varchar(50) NOT NULL,
  `check_out` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `payment` int(11) NOT NULL,
  `hotel_name` varchar(100) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `booking`
--

INSERT INTO `booking` (`id_booking`, `email`, `full_name`, `phone_number`, `check_in`, `check_out`, `status`, `payment`, `hotel_name`, `room_name`, `id_user`, `created_at`) VALUES
(9, 'edwineladio73@gmail.com', 'Edwin Fandiño Salazar', 2147483647, '10/23/2023', '10/24/2023', 'Finished', 125, 'Sheraton', 'Suite Room', 2, '2023-10-22 06:05:42'),
(10, 'edwineladio73@gmail.com', 'Edwin Fandiño Salazar', 2147483647, '10/30/2023', '11/1/2023', 'Finished', 250, 'Sheraton', 'Suite Room', 2, '2023-10-22 05:51:12'),
(11, 'edwineladio73@gmail.com', 'Edwin Fandiño Salazar', 2147483647, '11/1/2023', '11/4/2023', 'Confirmed', 300, 'The Ritz', 'Family Room', 2, '2023-10-22 06:05:52'),
(12, 'edwineladio73@gmail.com', 'Edwin Fandiño Salazar', 2147483647, '10/29/2023', '10/31/2023', 'Confirmed', 250, 'Sheraton', 'Suite Room', 2, '2023-10-22 05:52:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotels`
--

CREATE TABLE `hotels` (
  `id_hotel` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hotels`
--

INSERT INTO `hotels` (`id_hotel`, `name`, `image`, `description`, `location`, `status`, `created_at`) VALUES
(1, 'Sheraton', 'services-1.jpg', 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.', 'Cairo', 1, '2023-10-06 19:50:22'),
(2, 'The Plaza Hotel', 'image_4.jpg', 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.', 'New York', 1, '2023-10-06 19:50:22'),
(3, 'The Ritz', 'image_4.jpg', 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.', 'Colombia', 1, '2023-10-06 19:50:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `passwords`
--

CREATE TABLE `passwords` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(200) NOT NULL,
  `codigo` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `passwords`
--

INSERT INTO `passwords` (`id`, `email`, `token`, `codigo`, `created_at`) VALUES
(1, 'edwineladio73@gmail.com', 'a5fc1cfade8c17694a0263819ddc4e5c6bdffd22', 3389, '2023-10-22 08:11:45'),
(2, 'edwineladio73@gmail.com', '223d186cde17d1b31903f002116a4908669d3de7', 8785, '2023-10-22 09:03:06'),
(3, 'edwineladio73@gmail.com', '95179b228fa4ddcfb0b9005ae565f21c97152d0e', 4776, '2023-10-22 09:08:43'),
(4, 'edwineladio73@gmail.com', '35a5e0ef66093dc22ed19967602bbadbd62622b7', 4112, '2023-10-22 09:10:47'),
(5, 'edwineladio73@gmail.com', 'fd77b86252e42b46722132eed10946bc76281f24', 3825, '2023-10-22 09:30:10'),
(6, 'edwineladio73@gmail.com', '22f0bd50aaf3872e1bbe118b35a2b42947389b42', 8368, '2023-10-22 09:34:39'),
(7, 'edwineladio73@gmail.com', 'e11785ea796548da1307e0b7ff81b08bca190eaf', 1261, '2023-10-22 09:37:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rooms`
--

CREATE TABLE `rooms` (
  `id_room` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `num_persons` int(5) NOT NULL,
  `size` int(5) NOT NULL,
  `view` varchar(100) NOT NULL,
  `num_beds` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `hotel_name` varchar(200) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rooms`
--

INSERT INTO `rooms` (`id_room`, `room_name`, `image`, `price`, `num_persons`, `size`, `view`, `num_beds`, `id_hotel`, `hotel_name`, `status`, `created_at`) VALUES
(1, 'Suite Room', 'room-1.jpg', 125, 2, 50, 'Sea View', 1, 1, 'Sheraton', 1, '2023-10-06 20:22:42'),
(2, 'Standard Room', 'room-2.jpg', 80, 3, 45, 'Internal View', 2, 2, 'The Plaza Hotel', 1, '2023-10-06 20:22:42'),
(3, 'Family Room', 'room-3.jpg', 100, 4, 60, 'Sea View', 6, 3, 'The Ritz', 1, '2023-10-06 20:22:42'),
(4, 'Deluxe Room', 'room-4.jpg', 160, 6, 55, 'Sea View', 1, 1, 'Sheraton', 1, '2023-10-06 20:22:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mypassword` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `mypassword`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$RD7U1Txs0CSy0.AUcZeZRu7SOo7lVQ1KOT7WtSiJ5HQrdOGDObndW', '2023-10-06 00:12:47'),
(2, 'Edwin', 'edwin@gmail.com', '$2y$10$UI6SlQzagDbYnzHzUg3LxOZcKWpsgMVu7h9AbNOwjksQu8w5cyILK', '2023-10-08 05:56:36'),
(3, 'karen', 'karen@gmail.com', '$2y$10$.NdyKa0hBtfKjmumbYP/ROBA8zJo8mG0QvUw1eDZ5xJr6hcHDBqbS', '2023-10-08 05:57:07'),
(4, 'oscar', 'oscar@gmail.com', '$2y$10$qkHwUnJCZZCC4hKu9XdC3edADazu3M7vaSS0gNztj2PVWwHxhzB9m', '2023-10-08 06:28:24'),
(5, 'andres', 'andres@gmail.com', '$2y$10$OOtQDlVRaVmuiahXQ0gr2e99QSG5Ofaxha0xPbHsUgeUkCb4K3U6y', '2023-10-08 06:29:11'),
(6, 'Edwin', 'edwineladio73@gmail.com', '$2y$10$9UGwM1mdd1cwQFD5nmYzl.zHAw4OAU42SYtQMg7xoVEoF0lLTCu5S', '2023-10-22 09:38:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `utilities`
--

CREATE TABLE `utilities` (
  `id_utilities` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `id_room` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indices de la tabla `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id_hotel`);

--
-- Indices de la tabla `passwords`
--
ALTER TABLE `passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id_room`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `utilities`
--
ALTER TABLE `utilities`
  ADD PRIMARY KEY (`id_utilities`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `passwords`
--
ALTER TABLE `passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `utilities`
--
ALTER TABLE `utilities`
  MODIFY `id_utilities` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
