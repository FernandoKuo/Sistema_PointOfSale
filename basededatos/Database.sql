-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-04-2024 a las 22:41:28
-- Versión del servidor: 8.0.33
-- Versión de PHP: 7.4.29

/*SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";*/

drop database if exists pos;
create database pos;
use pos;

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

--drop table if exists carta;
CREATE TABLE `carta` (
  `plato` varchar(30) DEFAULT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `importe` int DEFAULT NULL,
  `id_carta` int NOT NULL primary KEY auto_increment
);

--
-- Volcado de datos para la tabla `carta`
--

INSERT INTO `carta` (`plato`, `desc`, `importe`) VALUES
('Pollo a la parrilla', 'Pollo asado con hierbas frescas y acompañado de papas fritas', 7000),
('Espaguetis a la bolognesa', 'Espaguetis con salsa boloñesa casera y queso parmesano', 7500),
('Sushi variado', 'Selección de sushi con variedad de pescado fresco y arroz al vapor', 8000),
('Hamburguesa clásica', 'Hamburguesa de carne de res con queso, lechuga, tomate y salsa especial', 7500),
('Parrillada mixta', 'Selección de carnes a la parrilla con vegetales asados', 9000),
('Tarta de chocolate', 'Tarta de chocolate negro con crema batida y frambuesas frescas', 7000),
('Helado de vainilla', 'Helado cremoso de vainilla con sirope de caramelo', 7200),
('Tiramisú', 'Postre italiano hecho con bizcochos de soletilla, café y crema de mascarpone', 7400),
('Pastel de manzana', 'Pastel de manzana casero con canela y crujiente de nueces', 7600),
('Mousse de limón', 'Mousse refrescante de limón con ralladura de lima', 7800),
('Coca-Cola', 'Refresco de cola carbonatado', 1500),
('Agua mineral', 'Agua mineral natural embotellada', 1700),
('Cerveza artesanal IPA', 'Cerveza india pale ale elaborada con lúpulo americano', 3500),
('Vino tinto reserva', 'Vino tinto reserva de la región, añejado en barricas de roble', 4600),
('Jugo de naranja natural', 'Jugo de naranja recién exprimido', 1300);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id_mesa` int NOT NULL primary key
  `id_pedido` int,
  foreign key(id_pedido) references pedido(id_pedido)
);
--delete from mesa where id_mesa = '';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `fecha_hora` datetime DEFAULT NULL,
  `id_carta` int DEFAULT NULL,
  `id_pedido` int NOT NULL primary key,
  `estado` enum('pendiente','concluido') DEFAULT 'pendiente',
  foreign key(id_carta) references carta(id_carta)
);
--update pedido set estado = 'concluido' where id_pedido = '';
