-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-04-2024 a las 22:41:28
-- Versión del servidor: 8.0.33
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sucursalll`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carta`
--

CREATE TABLE `carta` (
  `plato` varchar(30) DEFAULT NULL,
  `descrip` varchar(100) DEFAULT NULL,
  `importe` int DEFAULT NULL,
  `id_carta` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `carta`
--

INSERT INTO `carta` (`plato`, `descrip`, `importe`, `id_carta`) VALUES
('Pollo a la parrilla', 'Pollo asado con hierbas frescas y acompañado de papas fritas', 7000, 1),
('Espaguetis a la bolognesa', 'Espaguetis con salsa boloñesa casera y queso parmesano', 7500, 2),
('Sushi variado', 'Selección de sushi con variedad de pescado fresco y arroz al vapor', 8000, 3),
('Hamburguesa clásica', 'Hamburguesa de carne de res con queso, lechuga, tomate y salsa especial', 7500, 4),
('Parrillada mixta', 'Selección de carnes a la parrilla con vegetales asados', 9000, 5),
('Tarta de chocolate', 'Tarta de chocolate negro con crema batida y frambuesas frescas', 7000, 6),
('Helado de vainilla', 'Helado cremoso de vainilla con sirope de caramelo', 7200, 7),
('Tiramisú', 'Postre italiano hecho con bizcochos de soletilla, café y crema de mascarpone', 7400, 8),
('Pastel de manzana', 'Pastel de manzana casero con canela y crujiente de nueces', 7600, 9),
('Mousse de limón', 'Mousse refrescante de limón con ralladura de lima', 7800, 10),
('Coca-Cola', 'Refresco de cola carbonatado', 1500, 11),
('Agua mineral', 'Agua mineral natural embotellada', 1700, 12),
('Cerveza artesanal IPA', 'Cerveza india pale ale elaborada con lúpulo americano', 3500, 13),
('Vino tinto reserva', 'Vino tinto reserva de la región, añejado en barricas de roble', 4600, 14),
('Jugo de naranja natural', 'Jugo de naranja recién exprimido', 1300, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int NOT NULL,
  `pedido_id` int DEFAULT NULL,
  `carta_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `nombre` varchar(10) DEFAULT NULL,
  `id_mesa` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`nombre`, `id_mesa`) VALUES
('Mesa 1', 1),
('Mesa 2', 2),
('Mesa 3', 3),
('Mesa 4', 4),
('Mesa 5', 5),
('Mesa VIP', 6),
('Mesa 7', 7),
('Mesa 8', 8),
('Mesa 9', 9),
('Mesa 10', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `fecha_hora` date DEFAULT NULL,
  `carta_id` int DEFAULT NULL,
  `mesa_id` int DEFAULT NULL,
  `id_pedido` int NOT NULL,
  `estado_pedido` enum('en proceso','pendiente','entregado') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carta`
--
ALTER TABLE `carta`
  ADD PRIMARY KEY (`id_carta`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `carta_id` (`carta_id`);

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
  ADD KEY `carta_id` (`carta_id`),
  ADD KEY `mesa_id` (`mesa_id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id_pedido`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`carta_id`) REFERENCES `carta` (`id_carta`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`carta_id`) REFERENCES `carta` (`id_carta`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`mesa_id`) REFERENCES `mesa` (`id_mesa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
