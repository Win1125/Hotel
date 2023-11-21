-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 20-11-2023 a las 23:11:30
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
-- Base de datos: `hotel_a`
--
CREATE DATABASE IF NOT EXISTS `hotel_a` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hotel_a`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`` PROCEDURE `CancelBooking` (IN `p_booking_id` INT)   BEGIN
    -- Obtener el id de la habitación asociada a la reservación
    DECLARE room_id INT;
    SELECT id_room INTO room_id FROM booking WHERE id_booking = p_booking_id;

    -- Eliminar la reservación
    DELETE FROM booking WHERE id_booking = p_booking_id;

    -- Actualizar el estado de la habitación a "Disponible"
    UPDATE rooms
    SET id_status = 4
    WHERE id_room = room_id;
END$$

CREATE DEFINER=`` PROCEDURE `InsertBooking` (IN `p_user_id` INT, IN `p_room_id` INT, IN `p_phone_number` BIGINT, IN `p_check_in` VARCHAR(20), IN `p_check_out` VARCHAR(20), IN `p_payment` INT)   BEGIN
    INSERT INTO booking (
        id_user,
        id_room,
        phone_number,
        check_in,
        check_out,
        payment
    )
    VALUES (
        p_user_id,
        p_room_id,
        p_phone_number,
        p_check_in,
        p_check_out,
        p_payment
    );
END$$

CREATE DEFINER=`` PROCEDURE `InsertUserWithRole` (IN `p_username` VARCHAR(50), IN `p_email` VARCHAR(50), IN `p_mypassword` VARCHAR(200), IN `p_role_name` VARCHAR(50))   BEGIN
    DECLARE new_user_id INT;

    -- Insertar el nuevo usuario en la tabla `users`
    INSERT INTO users (username, email, mypassword)
    VALUES (p_username, p_email, p_mypassword);

    -- Obtener el id_user del nuevo usuario que acabamos de insertar
    SET new_user_id = LAST_INSERT_ID();

    -- Insertar el rol correspondiente para el nuevo usuario en la tabla `user_roles`
    INSERT INTO user_roles (id_user, id_role)
    SELECT new_user_id, id_role
    FROM roles
    WHERE role_name = p_role_name;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `check_in` varchar(20) NOT NULL,
  `check_out` varchar(20) NOT NULL,
  `id_status` int(11) NOT NULL DEFAULT 3,
  `payment` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `booking`
--

INSERT INTO `booking` (`id_booking`, `id_user`, `id_room`, `phone_number`, `check_in`, `check_out`, `id_status`, `payment`, `created_at`) VALUES
(1, 3, 5, 3216549870, '2023-11-16', '2023-11-18', 4, 325, '2023-11-17 04:37:25'),
(2, 4, 5, 3216549870, '2023-11-18', '2023-11-20', 3, 500, '2023-11-16 23:54:35'),
(3, 3, 7, 3216549870, '2023-11-21', '2023-11-22', 3, 600, '2023-11-16 23:54:35'),
(4, 4, 8, 3216549870, '2023-11-25', '2023-11-28', 3, 300, '2023-11-16 23:54:35'),
(5, 3, 6, 3216549870, '2023-11-27', '2023-11-30', 3, 300, '2023-11-16 23:54:35'),
(6, 4, 5, 3216549870, '2023-12-01', '2023-12-08', 3, 300, '2023-11-16 23:54:35'),
(8, 4, 5, 3012698617, '2023-11-17', '2023-11-19', 4, 300, '2023-11-17 00:33:39'),
(9, 3, 6, 3012698617, '2023-11-19', '2023-11-21', 3, 160, '2023-11-17 02:35:21'),
(10, 3, 8, 3021654875, '2023-12-04', '2023-12-06', 4, 320, '2023-11-17 02:48:49');

--
-- Disparadores `booking`
--
DELIMITER $$
CREATE TRIGGER `UpdateRoomStatusAfterBookingUpdate` AFTER UPDATE ON `booking` FOR EACH ROW BEGIN
    IF NEW.id_status = 4 THEN
        -- Actualizar el estado de la habitación a "Disponible" (1)
        UPDATE rooms
        SET id_status = 1
        WHERE id_room = NEW.id_room;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `client_users`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `client_users` (
`id_user` int(11)
,`username` varchar(50)
,`email` varchar(50)
,`role_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE `contacts` (
  `id_contact` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_status` int(11) NOT NULL DEFAULT 6
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hotels`
--

INSERT INTO `hotels` (`id_hotel`, `name`, `image`, `description`, `location`, `created_at`, `id_status`) VALUES
(4, 'The Ritz', 'image_4.jpg', 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.', 'New York', '2023-11-16 22:21:52', 1),
(5, 'The Plaza Hotel', 'image_4.jpg', 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.', 'Brasil', '2023-11-16 22:21:52', 1),
(6, 'Tequendama', 'tequendama.jpg', 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.', 'Colombia', '2023-11-16 22:21:52', 1),
(7, 'Fairfield Edit', 'fairfield.jpg', 'Hotel de Prueba Editado', 'Bogotá Edit', '2023-11-17 05:39:32', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `hotel_reservation_stats`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `hotel_reservation_stats` (
`hotel_name` varchar(100)
,`total_reservations` bigint(21)
,`total_revenue` decimal(32,0)
);

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

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `reservation_info`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `reservation_info` (
`id_booking` int(11)
,`id_user` int(11)
,`id_room` int(11)
,`phone_number` bigint(20)
,`check_in` varchar(20)
,`check_out` varchar(20)
,`id_status` int(11)
,`payment` int(11)
,`created_at` timestamp
,`user_name` varchar(50)
,`room_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_role`, `role_name`) VALUES
(1, 'Administrador'),
(2, 'Recepcionista'),
(3, 'Cliente');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rooms`
--

INSERT INTO `rooms` (`id_room`, `room_name`, `image`, `price`, `num_persons`, `size`, `view`, `num_beds`, `id_hotel`, `created_at`, `id_status`) VALUES
(5, 'Suite Room Edit', 'room-1.jpg', 125, 2, 50, 'Sea View', 1, 4, '2023-11-16 22:28:59', 1),
(6, 'Standard Room\r\n', 'room-2.jpg', 80, 3, 45, 'Internal View', 2, 6, '2023-11-16 22:28:59', 1),
(7, 'Family Room', 'room-3.jpg', 100, 4, 60, 'Sea View', 4, 5, '2023-11-16 22:28:59', 4),
(8, 'Deluxe Room', 'room-4.jpg', 160, 6, 55, 'Sea View', 3, 6, '2023-11-16 22:28:59', 1),
(15, 'prueba', 'superior_room.jpg', 1, 1, 1, 'prueba', 1, 6, '2023-11-17 06:32:20', 1),
(16, 'prueba2', 'superior_room.jpg', 1, 1, 1, 'prueba', 1, 7, '2023-11-17 06:33:02', 1),
(17, 'prueba', 'superior_room.jpg', 1, 1, 1, '1', 1, 4, '2023-11-17 06:35:25', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `room_status`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `room_status` (
`id_room` int(11)
,`room_name` varchar(100)
,`image` varchar(100)
,`price` int(11)
,`num_persons` int(5)
,`size` int(5)
,`view` varchar(100)
,`num_beds` int(11)
,`id_hotel` int(11)
,`created_at` timestamp
,`id_status` int(11)
,`status` varchar(10)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `room_utilities`
--

CREATE TABLE `room_utilities` (
  `id_room_utility` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `id_utilities` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `room_utilities`
--

INSERT INTO `room_utilities` (`id_room_utility`, `id_room`, `id_utilities`) VALUES
(1, 8, 4),
(2, 8, 1),
(3, 8, 2),
(4, 8, 3),
(5, 8, 4),
(6, 7, 5),
(7, 7, 6),
(8, 7, 3),
(9, 6, 1),
(10, 6, 8),
(11, 5, 1),
(12, 5, 2),
(13, 5, 4),
(14, 5, 3),
(15, 5, 5);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `staff_users`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `staff_users` (
`id_user` int(11)
,`username` varchar(50)
,`email` varchar(50)
,`role_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id_status`, `name`) VALUES
(0, 'Inactivo'),
(1, 'Activo'),
(2, 'Confirmado'),
(3, 'Pendiente'),
(4, 'Finalizado'),
(5, 'Leído'),
(6, 'No Leído');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mypassword` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `mypassword`, `created_at`) VALUES
(1, 'Edwin', 'edwin@gmail.com', '$2y$10$G/xRQbiRsJe9nk32TL/ZDuyuZIfCrWgmVNuO2FgT.zzTBOGuUkPqi', '2023-11-15 05:31:23'),
(2, 'Felipe', 'felipe@gmail.com', '$2y$10$HGb46BwB6AfnDr3LKjKZ9ePBUl151.hCisPmZq3BowCV2JENCXkUa', '2023-11-15 05:31:23'),
(3, 'Franco', 'franco@gmail.com', '$2y$10$o6nKxapW5bEDz1DWb6jIaOU7IUOarzeltLsyS.HEMUyewVorESr3i', '2023-11-15 05:31:23'),
(4, 'Karen', 'karen@gmail.com', '$2y$10$.uSSB4NIq3Ls477kVxjLiOX42hu90G4wVDt0drRb2DHkyC30GtW8e', '2023-11-15 05:31:23'),
(5, 'EEdwin', 'eefandiño@gmail.com', '$2y$10$lGPTTKuGgv6yRKnXnW2SIO.r8vg4SKLRXH8uW/KFtvSaG2IYxyhfy', '2023-11-16 23:37:11'),
(6, 'NuevoUsuario', 'nuevo@gmail.com', 'contraseña123', '2023-11-16 23:38:27'),
(7, 'NuevoUsuarioProcedimiento', 'nuevoprocedimiento@mail.com', 'contraseña123', '2023-11-16 23:40:41'),
(8, 'NuevoUsuarioInterfaz', 'interfazusuario@gmail.com', '$2y$10$nKvLUdwaJFSR.a2Zs33kDeoDH93KCDN7Ku22J5XHaJWSo8Ns12Uge', '2023-11-17 01:01:58'),
(9, 'Admin Interfaz edit', 'admineditado@gmail.com', '$2y$10$PkNoqQorfG.Z0C5MUyxjjuEpxmZkxYHDyrXa5NYOnILsIOQAvZksm', '2023-11-17 04:04:19'),
(10, 'NuevoRecepcionista', 'recepcionista@mail.com', 'recepcionista123', '2023-11-17 03:57:51'),
(11, 'Administrador', 'admin@gmail.com', '$2y$10$kfPpNBIMG0ekAvW1ZXwHQeCnPV0UQoJWnbfAiS0WRnaGyf.O46VlK', '2023-11-17 04:07:00'),
(12, 'Admin Procedimiento', 'admin_procedimiento@gmail.com', '$2y$10$0GohWTsTBkAv.fsOAzOn.efdzaBanORnjyHWTbcJUZxcbIOGj1B12', '2023-11-17 04:08:48'),
(13, 'Cliente pro edit', 'cliente_procedimiento_editado@gmail.com', '$2y$10$gZMxvrVPCHXkNFOMussa1OfuJN5/doTUVMvoN9R58Fbt/IqdVxqcO', '2023-11-17 04:14:23'),
(14, 'Coco', 'coco@gmail.com', '$2y$10$wmV3.NeU450aChpNhbNN4es7Mq54p/0Vqy.EzOma455XYICSw1w6u', '2023-11-20 21:45:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_roles`
--

CREATE TABLE `user_roles` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_roles`
--

INSERT INTO `user_roles` (`id_user`, `id_role`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 3),
(5, 2),
(6, 3),
(7, 3),
(8, 3),
(9, 1),
(10, 2),
(11, 1),
(12, 1),
(13, 3),
(14, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `utilities`
--

CREATE TABLE `utilities` (
  `id_utilities` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `utilities`
--

INSERT INTO `utilities` (`id_utilities`, `name`, `icon`, `description`, `created_at`) VALUES
(1, 'Tea Coffee', 'flaticon-diet', 'A small river named Duden flows by their place and supplies it with the necessary', '2023-11-16 20:31:11'),
(2, 'Hot Showers', 'flaticon-workout', 'A small river named Duden flows by their place and supplies it with the necessary', '2023-11-16 20:31:11'),
(3, 'Laundry', 'flaticon-diet-1', 'A small river named Duden flows by their place and supplies it with the necessary', '2023-11-16 20:31:11'),
(4, 'Air Conditioning', 'flaticon-first', 'A small river named Duden flows by their place and supplies it with the necessary', '2023-11-16 20:31:11'),
(5, 'Free Wifi', 'flaticon-first', 'A small river named Duden flows by their place and supplies it with the necessary', '2023-11-16 20:31:11'),
(6, 'Kitchen', 'flaticon-first', 'A small river named Duden flows by their place and supplies it with the necessary', '2023-11-16 20:31:11'),
(7, 'Ironing', 'flaticon-first', 'A small river named Duden flows by their place and supplies it with the necessary', '2023-11-16 20:31:11'),
(8, 'Lovkers', 'flaticon-first', 'A small river named Duden flows by their place and supplies it with the necessary', '2023-11-16 20:31:11');

-- --------------------------------------------------------

--
-- Estructura para la vista de `client_users` exportada como una tabla
--
DROP TABLE IF EXISTS `client_users`;
CREATE TABLE`client_users`(
    `id_user` int(11) NOT NULL DEFAULT '0',
    `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `role_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura para la vista de `hotel_reservation_stats` exportada como una tabla
--
DROP TABLE IF EXISTS `hotel_reservation_stats`;
CREATE TABLE`hotel_reservation_stats`(
    `hotel_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
    `total_reservations` bigint(21) NOT NULL DEFAULT '0',
    `total_revenue` decimal(32,0) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Estructura para la vista de `reservation_info` exportada como una tabla
--
DROP TABLE IF EXISTS `reservation_info`;
CREATE TABLE`reservation_info`(
    `id_booking` int(11) NOT NULL DEFAULT '0',
    `id_user` int(11) NOT NULL,
    `id_room` int(11) NOT NULL,
    `phone_number` bigint(20) NOT NULL,
    `check_in` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
    `check_out` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
    `id_status` int(11) NOT NULL DEFAULT '3',
    `payment` int(11) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT 'current_timestamp()',
    `user_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `room_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura para la vista de `room_status` exportada como una tabla
--
DROP TABLE IF EXISTS `room_status`;
CREATE TABLE`room_status`(
    `id_room` int(11) NOT NULL DEFAULT '0',
    `room_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
    `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
    `price` int(11) NOT NULL,
    `num_persons` int(5) NOT NULL,
    `size` int(5) NOT NULL,
    `view` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
    `num_beds` int(11) NOT NULL,
    `id_hotel` int(11) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT 'current_timestamp()',
    `id_status` int(11) NOT NULL DEFAULT '1',
    `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
);

-- --------------------------------------------------------

--
-- Estructura para la vista de `staff_users` exportada como una tabla
--
DROP TABLE IF EXISTS `staff_users`;
CREATE TABLE`staff_users`(
    `id_user` int(11) NOT NULL DEFAULT '0',
    `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `role_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_room` (`id_room`),
  ADD KEY `booking_ibfk_3` (`id_status`);

--
-- Indices de la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id_contact`),
  ADD KEY `contacts_ibfk_1` (`id_status`);

--
-- Indices de la tabla `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id_hotel`),
  ADD KEY `id_status` (`id_status`);

--
-- Indices de la tabla `passwords`
--
ALTER TABLE `passwords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indices de la tabla `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id_room`),
  ADD KEY `pk_status` (`id_status`),
  ADD KEY `pk_hotel` (`id_hotel`);

--
-- Indices de la tabla `room_utilities`
--
ALTER TABLE `room_utilities`
  ADD PRIMARY KEY (`id_room_utility`),
  ADD KEY `id_room` (`id_room`),
  ADD KEY `id_utilities` (`id_utilities`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- Indices de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id_user`,`id_role`),
  ADD KEY `id_role` (`id_role`);

--
-- Indices de la tabla `utilities`
--
ALTER TABLE `utilities`
  ADD PRIMARY KEY (`id_utilities`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `passwords`
--
ALTER TABLE `passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `room_utilities`
--
ALTER TABLE `room_utilities`
  MODIFY `id_room_utility` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `utilities`
--
ALTER TABLE `utilities`
  MODIFY `id_utilities` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`);

--
-- Filtros para la tabla `passwords`
--
ALTER TABLE `passwords`
  ADD CONSTRAINT `passwords_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Filtros para la tabla `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `pk_hotel` FOREIGN KEY (`id_hotel`) REFERENCES `hotels` (`id_hotel`),
  ADD CONSTRAINT `pk_status` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `room_utilities`
--
ALTER TABLE `room_utilities`
  ADD CONSTRAINT `room_utilities_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`),
  ADD CONSTRAINT `room_utilities_ibfk_2` FOREIGN KEY (`id_utilities`) REFERENCES `utilities` (`id_utilities`);

--
-- Filtros para la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
