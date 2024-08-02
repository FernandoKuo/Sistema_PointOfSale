-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-07-2024 a las 20:26:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carta`
--

CREATE TABLE `carta` (
  `id_carta` int(11) NOT NULL,
  `plato` varchar(30) DEFAULT NULL,
  `importe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carta`
--

INSERT INTO `carta` (`id_carta`, `plato`, `importe`) VALUES
(11, 'Coca-Cola', 1500),
(12, 'Jugo de naranja natural', 1300),
(13, 'Vino tinto reserva', 4600),
(14, 'Agua mineral', 1700),
(15, 'Cerveza artesanal IPA', 3500),
(21, 'Pollo a la parrilla', 7000),
(22, 'Espaguetis a la bolognesa', 7500),
(23, 'Sushi variado', 8000),
(24, 'Hamburguesa clásica', 7500),
(25, 'Parrillada mixta', 9000),
(31, 'Tarta de chocolate', 7000),
(32, 'Helado de vainilla', 7200),
(33, 'Tiramisú', 7400),
(34, 'Pastel de manzana', 7600),
(35, 'Mousse de limón', 7800);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id_mesa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id_mesa`) VALUES
(1),
(2),
(3),
(4),
(5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `fecha_hora1` datetime DEFAULT NULL,
  `fecha_hora2` datetime DEFAULT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_carta` int(11) DEFAULT NULL,
  `id_mesa` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `estado` enum('pendiente','concluido') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`fecha_hora1`, `fecha_hora2`, `id_pedido`, `id_carta`, `id_mesa`, `id_usuario`, `estado`) VALUES
('2024-07-01 14:39:55', '2024-07-01 14:43:28', 3, 11, 1, 1, 'concluido'),
('2024-07-01 14:43:20', '2024-07-01 14:43:28', 6, 11, 1, 1, 'concluido'),
('2024-07-01 14:45:20', '2024-07-01 14:45:49', 7, 11, 1, 1, 'concluido'),
('2024-07-01 14:45:46', '2024-07-01 14:45:49', 8, 11, 1, 1, 'concluido'),
('2024-07-01 14:47:01', '2024-07-01 14:47:10', 9, 11, 1, 1, 'concluido'),
('2024-07-01 14:47:08', '2024-07-01 14:47:10', 10, 11, 1, 1, 'concluido'),
('2024-07-01 14:48:13', '2024-07-01 14:52:39', 11, 11, 1, 1, 'concluido'),
('2024-07-01 14:48:21', '2024-07-01 14:52:39', 12, 11, 1, 1, 'concluido'),
('2024-07-01 14:58:05', '2024-07-01 14:59:58', 13, 11, 1, 1, 'concluido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `dni` int(8) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `psw` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `username`, `dni`, `tel`, `email`, `psw`) VALUES
(1, '0', '0', '0', 0, '0', '0', '0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carta`
--
ALTER TABLE `carta`
  ADD PRIMARY KEY (`id_carta`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id_mesa`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_carta` (`id_carta`),
  ADD KEY `id_mesa` (`id_mesa`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_carta`) REFERENCES `carta` (`id_carta`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_mesa`) REFERENCES `mesa` (`id_mesa`),
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
