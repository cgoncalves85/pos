-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2020 a las 00:43:26
-- Versión del servidor: 10.4.16-MariaDB
-- Versión de PHP: 7.4.12

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
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `id` int(11) NOT NULL,
  `banco_operador_id` int(11) NOT NULL DEFAULT 0,
  `nro_cuenta` varchar(255) NOT NULL DEFAULT '',
  `descripcion_cuenta` text DEFAULT NULL,
  `saldo_inicial` decimal(10,2) NOT NULL DEFAULT 0.00,
  `saldo_disponible` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bancos`
--

INSERT INTO `bancos` (`id`, `banco_operador_id`, `nro_cuenta`, `descripcion_cuenta`, `saldo_inicial`, `saldo_disponible`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 2, '8032659598', '', '2500000.00', '2500000.00', 1, '2020-09-14 19:18:49', 1, '2020-09-16 15:20:11', 1),
(3, 3, '2020956874', 'Cuenta de Ahorros FalaBella', '1000000.00', '1000000.00', 1, '2020-09-14 19:55:06', 1, '2020-09-16 14:47:26', 1),
(4, 1, '0102639586', 'Cuenta de Ahorros Bancolombia', '10000000.00', '10000000.00', 1, '2020-09-14 20:03:04', 1, '2020-09-14 22:02:12', 1),
(5, 6, '4182014790', 'Cuenta de Ahorros', '280000.00', '280000.00', 1, '2020-09-14 22:00:16', 1, '2020-09-14 22:00:16', 1),
(6, 1, '1653957892', 'Cuenta Christian Goncalves', '0.00', '4000000.00', 1, '2020-09-15 20:51:25', 1, '2020-09-21 19:37:38', 1),
(7, 1, '8888999955', 'Cuenta de Ejemplo', '50000.00', '50000.00', 1, '2020-09-16 12:05:21', 1, '2020-09-16 12:05:21', 1),
(8, 3, '1111111111', 'Cuenta Ejemplo', '280000.00', '280000.00', 1, '2020-09-16 12:06:19', 1, '2020-09-16 14:42:57', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_operador`
--

CREATE TABLE `banco_operador` (
  `id` int(11) NOT NULL,
  `nombre_banco` varchar(255) NOT NULL DEFAULT '',
  `descripcion` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `banco_operador`
--

INSERT INTO `banco_operador` (`id`, `nombre_banco`, `descripcion`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Bancolombia', NULL, 1, '2020-09-14 18:35:26', 1, '2020-09-14 18:35:26', 1),
(2, 'Banco de Bogotá', NULL, 1, '2020-09-14 18:35:26', 1, '2020-09-14 18:35:26', 1),
(3, 'Banco Falabella', NULL, 1, '2020-09-14 18:35:26', 1, '2020-09-14 18:35:26', 1),
(4, 'Banco de Occidente', NULL, 1, '2020-09-14 18:35:26', 1, '2020-09-14 18:35:26', 1),
(5, 'BBVA', NULL, 1, '2020-09-14 18:35:26', 1, '2020-09-14 18:35:26', 1),
(6, 'ScotiaBank Colpatria S.A', '', 1, '2020-09-14 21:36:55', 1, '2020-09-14 21:36:55', 1),
(7, 'Banvivienda', 'Entidad Bancaria de la Vivienda', 1, '2020-09-14 21:39:46', 1, '2020-09-14 21:39:46', 1),
(8, 'Colpatria', '', 1, '2020-09-14 21:43:39', 1, '2020-09-14 21:43:39', 1),
(9, 'Banco Bilbao Vizcaya', '', 1, '2020-09-16 16:01:50', 1, '2020-09-16 16:01:50', 1),
(10, 'Ejemplo Bank', '', 1, '2020-09-16 16:03:52', 1, '2020-09-16 16:03:52', 1),
(11, 'Banco Socialista', '', 1, '2020-09-16 16:04:11', 1, '2020-09-16 16:04:11', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bonos`
--

CREATE TABLE `bonos` (
  `id` int(11) NOT NULL,
  `tipo_bono` int(11) NOT NULL DEFAULT 0 COMMENT '1= Descuento 2 = Premio',
  `cantidad_puntos` decimal(10,2) NOT NULL DEFAULT 0.00,
  `premio` varchar(255) DEFAULT NULL,
  `porcentaje_dcto` decimal(10,2) DEFAULT NULL,
  `observacion` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bonos`
--

INSERT INTO `bonos` (`id`, `tipo_bono`, `cantidad_puntos`, `premio`, `porcentaje_dcto`, `observacion`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 2, '5000.00', 'TV 32\' Marca LG', '0.00', 'Premio - TV 32\' Marca LG', 1, '2020-10-27 12:54:44', 1, '2020-10-27 22:41:29', 1),
(2, 1, '250.00', '', '5.00', 'Descuento de 5% sobre el total de la compra', 1, '2020-10-27 13:21:19', 1, '2020-10-27 13:21:19', 1),
(3, 1, '500.00', '', '25.00', 'Descuento de 25 % sobre el total de la compra', 1, '2020-10-27 14:32:59', 1, '2020-10-27 14:32:59', 1),
(4, 1, '550.00', '', '12.00', 'Descuento de 12 % sobre el total de la compra', 1, '2020-10-27 14:36:25', 1, '2020-10-27 14:36:25', 1),
(5, 2, '10000.00', 'Horno Microhondas', '0.00', 'Premio - Horno Microhondas', 1, '2020-10-27 14:39:05', 1, '2020-10-27 14:39:05', 1),
(6, 1, '500.00', '', '10.00', 'Descuento de 10 % sobre el total de la compra', 1, '2020-10-27 21:15:17', 1, '2020-10-27 21:15:17', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bonos_asignados`
--

CREATE TABLE `bonos_asignados` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL DEFAULT 0,
  `bono_id` int(11) NOT NULL DEFAULT 0,
  `nro_documento` int(11) NOT NULL DEFAULT 0,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE `cajas` (
  `id` int(11) NOT NULL,
  `nro` varchar(2) NOT NULL DEFAULT '0',
  `descripcion` varchar(100) NOT NULL DEFAULT '',
  `tienda_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cajas`
--

INSERT INTO `cajas` (`id`, `nro`, `descripcion`, `tienda_id`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '01', 'Caja 01', 1, 1, '2020-06-25 16:12:17', 1, '2020-06-25 17:05:14', 1),
(2, '02', 'Caja 02', 1, 1, '2020-06-25 16:22:20', 1, '2020-06-25 17:05:43', 1),
(3, '01', 'Caja 01', 2, 1, '2020-06-25 17:07:16', 1, '2020-06-25 17:07:16', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas_apertura`
--

CREATE TABLE `cajas_apertura` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `caja_id` int(11) NOT NULL DEFAULT 0,
  `fecha` date DEFAULT NULL,
  `monto_apertura` decimal(10,2) NOT NULL DEFAULT 0.00,
  `monto_cierre` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cajas_apertura`
--

INSERT INTO `cajas_apertura` (`id`, `user_id`, `caja_id`, `fecha`, `monto_apertura`, `monto_cierre`, `status`) VALUES
(1, 2, 1, '2020-08-03', '200000.00', '200000.00', 1),
(2, 1, 1, '2020-08-03', '200000.00', '50000000.00', 2),
(3, 1, 1, '2020-08-03', '1500000.00', '3000000.00', 2),
(4, 1, 1, '2020-08-03', '200000.00', '50000000.00', 2),
(5, 1, 2, '2020-08-03', '10000.00', '500000.00', 2),
(7, 1, 2, '2020-08-03', '10000.00', '25000000.00', 2),
(8, 1, 2, '2020-08-03', '5000.00', '150000.00', 2),
(9, 1, 1, '2020-08-02', '200000.00', '500000.00', 2),
(10, 1, 1, '2020-08-04', '200000.00', '1250000.00', 0),
(11, 1, 2, '2020-10-15', '100000.00', '100000.00', 0),
(12, 1, 1, '2020-10-15', '0.00', '0.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL DEFAULT '',
  `imagen` varchar(255) DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `imagen`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Carnes', 'carnes.png', 1, '2020-06-16 15:01:12', 1, '2020-06-16 20:40:04', 1),
(9, 'Frutas', 'frutas.png', 1, '2020-06-16 19:53:05', 1, '2020-06-16 20:39:46', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL DEFAULT '',
  `tipo_identificacion` varchar(100) NOT NULL DEFAULT '',
  `nro_identificacion` varchar(30) NOT NULL DEFAULT '',
  `correo` varchar(255) DEFAULT '',
  `telefono` varchar(100) DEFAULT '',
  `movil` varchar(100) DEFAULT '',
  `direccion` text DEFAULT NULL,
  `credito` int(11) NOT NULL DEFAULT 0,
  `monto_credito` decimal(10,2) DEFAULT 0.00,
  `puntos` decimal(20,0) NOT NULL DEFAULT 0,
  `categoria_cliente_id` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `tipo_identificacion`, `nro_identificacion`, `correo`, `telefono`, `movil`, `direccion`, `credito`, `monto_credito`, `puntos`, `categoria_cliente_id`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Fernando Goncalves', 'RIF', 'V-17143539-7', 'jeam2006@gmail.com', '02128644651', '04242678319', 'Los Flores de Catia. Caracas', 1, '3000000.00', '8000', 1, 1, NULL, NULL, '2020-10-28 17:37:28', 1),
(2, 'Carlota Alanis', 'CE', 'V-16106355-1', 'alanisg@gmail.com', '02128644651', '04269066672', 'Catia', 0, '0.00', '0', 1, 1, NULL, NULL, NULL, NULL),
(3, 'Carmen Perez', 'CE', '15846935', 'cperez@gmail.com', '04242685963', '04241578635', 'Santa Marta', 0, '0.00', '0', 1, 1, '2020-07-12 13:38:08', 1, '2020-07-12 13:38:08', 1),
(4, 'Pedro Perez', 'CC', '45784596', 'ppere@gmail.com', '457812359', '653298425', 'Bogota', 0, '0.00', '0', 1, 1, '2020-07-12 13:46:11', 1, '2020-07-12 13:46:11', 1),
(5, 'Priscilla Ginez', 'CC', '451278456', 'dolores@gmail.com', '784512963', '326598741', 'Bogota', 0, '0.00', '6400', 1, 1, '2020-07-12 13:59:10', 1, '2020-10-28 13:37:40', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_categorias`
--

CREATE TABLE `clientes_categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `clientes_categorias`
--

INSERT INTO `clientes_categorias` (`id`, `categoria`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Clientes Genéricos', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL DEFAULT 0,
  `nro_documento` varchar(255) NOT NULL DEFAULT '',
  `fecha` date NOT NULL,
  `precio_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cotizaciones`
--

INSERT INTO `cotizaciones` (`id`, `cliente_id`, `nro_documento`, `fecha`, `precio_total`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, '010203', '2020-09-11', '15000.00', 1, '2020-09-14 18:35:26', 1, '2020-09-14 18:35:26', 1),
(2, 2, '010204', '2020-09-11', '1000.00', 1, '2020-09-14 18:35:26', 1, '2020-09-14 18:35:26', 1),
(3, 4, '010205', '2020-09-11', '300.00', 1, '2020-09-14 18:35:26', 1, '2020-09-14 18:35:26', 1),
(4, 5, '010206', '2020-09-11', '12000.00', 1, '2020-09-14 18:35:26', 1, '2020-09-14 18:35:26', 1),
(5, 2, '010207', '2020-09-11', '5500.00', 1, '2020-09-14 18:35:26', 1, '2020-09-14 18:35:26', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones_productos`
--

CREATE TABLE `cotizaciones_productos` (
  `id` int(11) NOT NULL,
  `cotizaciones_id` int(11) NOT NULL DEFAULT 0,
  `producto_id` int(11) NOT NULL DEFAULT 0,
  `cantidad` decimal(10,2) NOT NULL DEFAULT 0.00,
  `precio_unitario` decimal(10,2) NOT NULL DEFAULT 0.00,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cotizaciones_productos`
--

INSERT INTO `cotizaciones_productos` (`id`, `cotizaciones_id`, `producto_id`, `cantidad`, `precio_unitario`, `precio`) VALUES
(2, 2, 2, '10.00', '100.00', '1000.00'),
(4, 3, 2, '10.00', '10.00', '100.00'),
(5, 3, 2, '10.00', '20.00', '200.00'),
(6, 4, 5, '100.00', '80.00', '8000.00'),
(7, 4, 6, '10.00', '400.00', '4000.00'),
(21, 1, 2, '10.00', '1000.00', '10000.00'),
(23, 1, 6, '10.00', '500.00', '5000.00'),
(24, 5, 2, '10.00', '500.00', '5000.00'),
(25, 5, 3, '10.00', '50.00', '500.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupones`
--

CREATE TABLE `cupones` (
  `id` int(11) NOT NULL,
  `id_lista` int(11) NOT NULL DEFAULT 0,
  `cupon` varchar(255) NOT NULL DEFAULT '',
  `descripcion` text NOT NULL,
  `porcentaje_descuento` int(10) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cupones`
--

INSERT INTO `cupones` (`id`, `id_lista`, `cupon`, `descripcion`, `porcentaje_descuento`, `status`) VALUES
(1, 1, 'lxajgb3eps', 'Cupón de Descuento: 10%', 10, 1),
(2, 1, 'lihf5nuqd2', 'Cupón de Descuento: 10%', 10, 1),
(3, 1, 'q9mahsxfj3', 'Cupón de Descuento: 10%', 10, 0),
(4, 1, '1syo8dmpwn', 'Cupón de Descuento: 10%', 10, 1),
(5, 1, 'nyiead7x9r', 'Cupón de Descuento: 10%', 10, 0),
(6, 1, '5glo34bfd7', 'Cupón de Descuento: 10%', 10, 0),
(7, 1, 'm78asprzq6', 'Cupón de Descuento: 10%', 10, 1),
(8, 1, 'jm1gylzuht', 'Cupón de Descuento: 10%', 10, 1),
(9, 1, 'tvq10c7hnw', 'Cupón de Descuento: 10%', 10, 1),
(10, 1, '8cqd2o6ib7', 'Cupón de Descuento: 10%', 10, 1),
(11, 1, '2bj8za9rpw', 'Cupón de Descuento: 10%', 10, 0),
(12, 1, 'nwrk3bvzqg', 'Cupón de Descuento: 10%', 10, 1),
(13, 1, 'awd5r4ms96', 'Cupón de Descuento: 10%', 10, 0),
(14, 1, 'sbvoq3r6hi', 'Cupón de Descuento: 10%', 10, 0),
(15, 1, 'f14o7mbxjk', 'Cupón de Descuento: 10%', 10, 0),
(16, 2, '3es7zyoxtv', 'Cupón de Descuento: 30%', 30, 0),
(17, 2, 'r648bnfev9', 'Cupón de Descuento: 30%', 30, 0),
(18, 2, '8qcow0p7ja', 'Cupón de Descuento: 30%', 30, 0),
(19, 2, '61ics2bkyf', 'Cupón de Descuento: 30%', 30, 1),
(20, 2, 't728yfmp6b', 'Cupón de Descuento: 30%', 30, 1),
(21, 3, 's7rdjp9ku4', 'Cupón de Descuento: 25%', 25, 1),
(22, 3, '067s5dvpet', 'Cupón de Descuento: 25%', 25, 1),
(23, 3, 'b0cg25kt3o', 'Cupón de Descuento: 25%', 25, 1),
(24, 3, 'wizrv35821', 'Cupón de Descuento: 25%', 25, 1),
(25, 3, '0ctifpjb6z', 'Cupón de Descuento: 25%', 25, 1),
(26, 3, 'icfykgt5q4', 'Cupón de Descuento: 25%', 25, 1),
(27, 3, 'gn45uslw9z', 'Cupón de Descuento: 25%', 25, 1),
(28, 3, 'gmdjwlv5k2', 'Cupón de Descuento: 25%', 25, 0),
(29, 3, 'hlknsutpxb', 'Cupón de Descuento: 25%', 25, 0),
(30, 3, 'da1uj8gm5x', 'Cupón de Descuento: 25%', 25, 1),
(31, 4, 'lyxsjf9d16', 'Cupón de Descuento: 10%', 10, 0),
(32, 4, 'kw2j3g7z40', 'Cupón de Descuento: 10%', 10, 1),
(33, 4, 'hekgzsrtac', 'Descuento de 10 %', 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupones_lista`
--

CREATE TABLE `cupones_lista` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `cantidad_cupones` int(11) NOT NULL DEFAULT 0,
  `porcentaje_descuento` int(10) NOT NULL DEFAULT 0,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cupones_lista`
--

INSERT INTO `cupones_lista` (`id`, `descripcion`, `cantidad_cupones`, `porcentaje_descuento`, `fecha_inicio`, `fecha_fin`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Cupos de Descuento - Octubre 2020', 15, 10, '2020-10-01', '2020-10-31', 1, '2020-10-30 12:30:45', 1, '2020-10-30 12:36:32', 1),
(2, 'Cupones de Descuento - Noviembre 2020', 5, 30, '2020-11-01', '2020-11-30', 1, '2020-10-30 13:57:25', 1, '2020-10-30 13:57:25', 1),
(3, 'Halloween 2020', 10, 25, '2020-10-30', '2020-11-01', 1, '2020-10-30 15:28:21', 1, '2020-10-30 15:28:21', 1),
(4, 'Cupon de Prueba', 3, 10, '2020-10-30', '2020-10-31', 1, '2020-10-30 17:00:15', 1, '2020-10-30 17:00:15', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `existencias`
--

CREATE TABLE `existencias` (
  `id` int(11) NOT NULL,
  `tienda_id` int(11) NOT NULL DEFAULT 0,
  `producto_id` int(11) NOT NULL DEFAULT 0,
  `cantidad` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `existencias`
--

INSERT INTO `existencias` (`id`, `tienda_id`, `producto_id`, `cantidad`) VALUES
(1, 1, 2, '0.00'),
(2, 1, 3, '171.00'),
(3, 2, 2, '32.00'),
(4, 1, 4, '79.00'),
(5, 1, 5, '66.00'),
(6, 1, 6, '90.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

CREATE TABLE `forma_pago` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `forma_pago`
--

INSERT INTO `forma_pago` (`id`, `descripcion`, `status`) VALUES
(1, 'Efectivo', 1),
(2, 'TPV (Punto de Venta)', 1),
(3, 'Crédito', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `proveedor_id` int(11) NOT NULL DEFAULT 0,
  `fecha` date DEFAULT NULL,
  `tienda_id` int(11) NOT NULL DEFAULT 0,
  `forma_pago_id` int(11) NOT NULL DEFAULT 0,
  `monto` decimal(10,2) NOT NULL DEFAULT 0.00,
  `impuesto_id` int(11) NOT NULL DEFAULT 0,
  `gastos_categorias_id` int(11) NOT NULL DEFAULT 0,
  `gastos_subcategorias_id` int(11) NOT NULL DEFAULT 0,
  `banco_id` int(11) DEFAULT 0,
  `nro_referencia` varchar(255) DEFAULT '',
  `nota` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `descripcion`, `proveedor_id`, `fecha`, `tienda_id`, `forma_pago_id`, `monto`, `impuesto_id`, `gastos_categorias_id`, `gastos_subcategorias_id`, `banco_id`, `nro_referencia`, `nota`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Gastos por Papeleria', 4, '2020-09-16', 1, 1, '50000.00', 1, 1, 4, 2, '01029635', 'Copias', 1, '2020-09-16 23:02:48', 1, '2020-09-18 18:18:43', 1),
(8, 'Almuerzo', 4, '2020-09-18', 2, 1, '25000.00', 1, 1, 6, 0, '', 'Almuerzo Christian Goncalves', 1, '2020-09-18 16:32:21', 1, '2020-09-18 16:32:21', 1),
(9, 'Pago de Bomba', 4, '2020-09-18', 1, 1, '250000.00', 1, 1, 3, 2, '082544', '', 1, '2020-09-18 16:33:42', 1, '2020-09-18 16:33:42', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_categorias`
--

CREATE TABLE `gastos_categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gastos_categorias`
--

INSERT INTO `gastos_categorias` (`id`, `categoria`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Gastos Personales', 1, '2020-09-16 21:45:28', 1, '2020-09-16 21:45:28', 1),
(2, 'Gastos Generales', 1, '2020-09-16 21:46:06', 1, '2020-09-16 21:46:06', 1),
(3, 'Gastos Financieros', 1, '2020-09-16 21:46:33', 1, '2020-09-16 21:46:33', 1),
(4, 'Gastos por Impuestos', 1, '2020-09-16 21:46:49', 1, '2020-09-16 21:46:49', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_subcategorias`
--

CREATE TABLE `gastos_subcategorias` (
  `id` int(11) NOT NULL,
  `gastos_categorias_id` int(11) NOT NULL DEFAULT 0,
  `subcategoria` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gastos_subcategorias`
--

INSERT INTO `gastos_subcategorias` (`id`, `gastos_categorias_id`, `subcategoria`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'Arrendamientos', 1, '2020-09-16 22:27:25', 1, '2020-09-16 22:27:25', 1),
(2, 1, 'Comisiones, honorarios y servicios', 1, '2020-09-16 22:28:16', 1, '2020-09-16 22:28:16', 1),
(3, 1, 'Otros Gastos Generales', 1, '2020-09-16 22:29:00', 1, '2020-09-16 22:29:00', 1),
(4, 1, 'Papeleria', 1, '2020-09-16 22:29:21', 1, '2020-09-16 22:29:21', 1),
(5, 1, 'Publicidad', 1, '2020-09-16 22:29:40', 1, '2020-09-16 22:29:40', 1),
(6, 1, 'Restaurantes y Lavanderias', 1, '2020-09-16 22:30:25', 1, '2020-09-16 22:30:25', 1),
(7, 1, 'Seguros Generales', 1, '2020-09-16 22:31:01', 1, '2020-09-16 22:31:01', 1),
(8, 1, 'Servicios de Aseo', 1, '2020-09-16 22:31:37', 1, '2020-09-16 22:31:37', 1),
(9, 1, 'Servicios Públicos', 1, '2020-09-16 22:31:57', 1, '2020-09-16 22:31:57', 1),
(10, 1, 'Vigilancia', 1, '2020-09-16 22:32:17', 1, '2020-09-16 22:32:17', 1),
(11, 2, 'Ajustes por aproximación en cálculos', 1, '2020-09-16 22:33:11', 1, '2020-09-16 22:33:11', 1),
(12, 2, 'Ajustes por diferencia en cambio', 1, '2020-09-16 22:33:54', 1, '2020-09-16 22:33:54', 1),
(13, 3, 'Impuestos de Renta', 1, '2020-09-16 22:34:30', 1, '2020-09-16 22:34:30', 1),
(14, 3, 'Otros Impuestos', 1, '2020-09-16 22:35:10', 1, '2020-09-16 22:35:10', 1),
(15, 4, 'Impuestos de Renta', 1, '2020-09-16 22:35:51', 1, '2020-09-16 22:35:51', 1),
(16, 4, 'Otros Impuestos', 1, '2020-09-16 22:36:03', 1, '2020-09-16 22:36:03', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos`
--

CREATE TABLE `impuestos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL DEFAULT '',
  `valor` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `impuestos`
--

INSERT INTO `impuestos` (`id`, `descripcion`, `valor`) VALUES
(1, 'Impuesto al Valor Agregado', '10.00'),
(2, 'Impuesto', '9.00'),
(3, 'Impuesto', '15.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `tipo_movimiento` varchar(255) NOT NULL DEFAULT '',
  `nro_documento` varchar(30) NOT NULL DEFAULT '',
  `fecha` date NOT NULL,
  `tienda_id` int(11) NOT NULL DEFAULT 0,
  `orden_compra_id` int(11) DEFAULT NULL,
  `observacion` varchar(255) NOT NULL DEFAULT '',
  `tienda_origen_id` int(11) DEFAULT 0,
  `tienda_destino_id` int(11) DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `tipo_movimiento`, `nro_documento`, `fecha`, `tienda_id`, `orden_compra_id`, `observacion`, `tienda_origen_id`, `tienda_destino_id`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'INGRESO', '001', '2020-07-01', 1, 19, 'Ingreso OC 123', NULL, NULL, 1, '2020-07-01 20:23:41', 1, '2020-07-01 20:23:41', 1),
(2, 'EGRESO', '17143539', '2020-07-01', 1, NULL, 'Egreso de 10 Solomos por Regalos', NULL, NULL, 0, '2020-07-01 20:31:39', 1, '2020-07-01 20:31:39', 1),
(4, 'EGRESO', '16106355', '2020-07-01', 1, NULL, 'Egreso', NULL, NULL, 0, '2020-07-01 20:35:59', 1, '2020-07-01 20:35:59', 1),
(5, 'INGRESO', '01072020', '2020-07-01', 1, 20, 'Ingreso de 100 Solomos Amiguitos del Dog', NULL, NULL, 1, '2020-07-01 20:38:30', 1, '2020-07-01 20:38:30', 1),
(6, 'EGRESO', '12761308', '2020-07-01', 1, NULL, '10 Solomos para Italia', NULL, NULL, 0, '2020-07-01 20:39:32', 1, '2020-07-01 20:39:32', 1),
(7, 'INGRESO', '10159975', '2020-07-01', 2, 3, 'Ingreso por OC  58963588', NULL, NULL, 1, '2020-07-01 21:04:47', 1, '2020-07-01 21:04:47', 1),
(8, 'INGRESO', '242422', '2020-07-08', 1, 21, 'Ingreso por Compra de Frutas', NULL, NULL, 1, '2020-07-08 14:17:13', 1, '2020-07-08 14:17:13', 1),
(9, 'INGRESO', '202748', '2020-07-08', 1, 22, 'Compra de Fresas', NULL, NULL, 1, '2020-07-08 14:22:57', 1, '2020-07-08 14:22:57', 1),
(10, 'INGRESO', '17143539', '2020-07-21', 1, 1, '', NULL, NULL, 1, '2020-07-21 13:17:01', 1, '2020-07-21 13:17:01', 1),
(12, 'INGRESO', '16106355', '2020-07-21', 1, 1, '', NULL, NULL, 1, '2020-07-21 13:45:25', 1, '2020-07-21 13:45:25', 1),
(13, 'EGRESO', '12761308', '2020-07-21', 1, NULL, 'sale', NULL, NULL, 0, '2020-07-21 13:52:26', 1, '2020-07-21 13:52:26', 1),
(14, 'EGRESO', '10812978', '2020-07-21', 1, NULL, 'Regalo', NULL, NULL, 0, '2020-07-21 13:57:05', 1, '2020-07-21 13:57:05', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_auditoria`
--

CREATE TABLE `inventario_auditoria` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `tienda_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario_auditoria`
--

INSERT INTO `inventario_auditoria` (`id`, `descripcion`, `fecha`, `tienda_id`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Toma Física de Inventario', '2020-09-23', 1, 1, NULL, NULL, '2020-10-05 15:19:49', 1),
(2, 'Toma Física de Inventario (23-09-2020)', '2020-09-23', 1, 1, NULL, NULL, '2020-09-24 10:49:46', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_auditoria_productos`
--

CREATE TABLE `inventario_auditoria_productos` (
  `id` int(11) NOT NULL,
  `inventario_auditoria_id` int(11) NOT NULL DEFAULT 0,
  `producto_id` int(11) NOT NULL DEFAULT 0,
  `cantidad` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cantidad_final` decimal(10,2) NOT NULL DEFAULT 0.00,
  `observacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario_auditoria_productos`
--

INSERT INTO `inventario_auditoria_productos` (`id`, `inventario_auditoria_id`, `producto_id`, `cantidad`, `cantidad_final`, `observacion`) VALUES
(1, 1, 3, '10.00', '10.00', ''),
(2, 2, 3, '10.00', '10.00', ''),
(3, 2, 4, '50.00', '49.00', 'Epaaa falto una manzana'),
(4, 2, 6, '100.00', '82.00', 'Donde estan las fresas ?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_productos`
--

CREATE TABLE `inventario_productos` (
  `id` int(11) NOT NULL,
  `inventario_id` int(11) NOT NULL DEFAULT 0,
  `producto_id` int(11) NOT NULL DEFAULT 0,
  `cantidad` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario_productos`
--

INSERT INTO `inventario_productos` (`id`, `inventario_id`, `producto_id`, `cantidad`) VALUES
(1, 1, 2, '10.00'),
(2, 1, 3, '50.00'),
(3, 2, 2, '10.00'),
(4, 4, 2, '50.00'),
(5, 5, 2, '100.00'),
(6, 6, 2, '10.00'),
(7, 7, 2, '25.00'),
(8, 7, 2, '10.00'),
(9, 8, 4, '100.00'),
(10, 8, 5, '100.00'),
(11, 9, 6, '100.00'),
(12, 10, 2, '100.00'),
(13, 10, 3, '20.00'),
(14, 10, 3, '25.00'),
(15, 10, 3, '30.00'),
(16, 12, 2, '100.00'),
(17, 12, 3, '20.00'),
(18, 12, 3, '25.00'),
(19, 12, 3, '30.00'),
(20, 13, 2, '119.00'),
(21, 14, 2, '20.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_precios`
--

CREATE TABLE `libro_precios` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL DEFAULT '',
  `tienda_id` int(11) NOT NULL DEFAULT 0,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libro_precios`
--

INSERT INTO `libro_precios` (`id`, `descripcion`, `tienda_id`, `fecha_inicio`, `fecha_fin`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Ofertas de Enero', 1, '2021-01-01', '2021-01-31', 1, '2020-10-05 13:50:46', 1, '2020-10-05 13:50:46', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_precios_productos`
--

CREATE TABLE `libro_precios_productos` (
  `id` int(11) NOT NULL,
  `libro_precio_id` int(11) NOT NULL DEFAULT 0,
  `producto_id` int(11) NOT NULL DEFAULT 0,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libro_precios_productos`
--

INSERT INTO `libro_precios_productos` (`id`, `libro_precio_id`, `producto_id`, `precio`) VALUES
(1, 1, 2, '500000.00'),
(2, 1, 3, '350000.00'),
(3, 1, 4, '150000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE `medidas` (
  `id` int(11) NOT NULL,
  `medida` varchar(255) NOT NULL DEFAULT '',
  `abv_med` varchar(20) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`id`, `medida`, `abv_med`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Kilogramo', 'Kg.', 1, '2020-06-16 16:35:48', 1, '2020-06-22 21:35:53', 1),
(2, 'Litros', 'Lts.', 1, '2020-06-22 21:37:00', 1, '2020-06-22 21:37:09', 1),
(3, 'Unidad', 'Und.', 1, '2020-07-08 14:12:27', 1, '2020-07-08 14:12:27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1565964268),
('m130524_201442_init', 1565964276),
('m190124_110200_add_verification_token_column_to_user_table', 1565964276);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mov_bancarios`
--

CREATE TABLE `mov_bancarios` (
  `id` int(11) NOT NULL,
  `nro_referencia` varchar(255) NOT NULL DEFAULT '',
  `banco_id` int(11) NOT NULL DEFAULT 0,
  `tipo_movimiento_id` int(11) NOT NULL DEFAULT 0,
  `valor` decimal(10,2) NOT NULL DEFAULT 0.00,
  `observacion` text DEFAULT NULL,
  `nota_impresion` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mov_bancarios`
--

INSERT INTO `mov_bancarios` (`id`, `nro_referencia`, `banco_id`, `tipo_movimiento_id`, `valor`, `observacion`, `nota_impresion`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(19, '1020304000', 6, 1, '2000000.00', '', '', 1, '2020-09-16 15:42:08', 1, '2020-09-21 19:37:39', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mov_bancario_tipo`
--

CREATE TABLE `mov_bancario_tipo` (
  `id` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `tipo_movimiento` varchar(20) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mov_bancario_tipo`
--

INSERT INTO `mov_bancario_tipo` (`id`, `descripcion`, `tipo_movimiento`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Ingreso a Cuenta', 'ENTRADA', 1, '2020-09-15 19:16:40', 1, '2020-09-15 19:16:40', 1),
(2, 'Egreso a Cuenta', 'SALIDA', 1, '2020-09-15 19:17:40', 1, '2020-09-15 19:17:40', 1),
(3, 'Ingreso', 'ENTRADA', 1, '2020-09-15 19:23:54', 1, '2020-09-15 19:23:54', 1),
(4, 'Egreso', 'SALIDA', 1, '2020-09-16 15:48:14', 1, '2020-09-16 15:48:14', 1),
(5, 'Aporte', 'ENTRADA', 1, '2020-09-16 15:50:01', 1, '2020-09-16 15:50:01', 1),
(6, 'Salida de Dinero', 'SALIDA', 1, '2020-09-16 15:50:14', 1, '2020-09-16 15:50:14', 1),
(7, 'Ingreso por Cuotas Fijas', 'ENTRADA', 1, '2020-09-21 19:39:04', 1, '2020-09-21 19:39:04', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operacion`
--

CREATE TABLE `operacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `operacion`
--

INSERT INTO `operacion` (`id`, `nombre`, `descripcion`) VALUES
(1, 'rol-index', 'Roles'),
(4, 'operacion-index', 'Permisos'),
(8, 'operacion-update', 'Modificar Permiso'),
(9, 'rol-update', 'Modificar Rol'),
(10, 'rol-delete', 'Eliminar Rol'),
(11, 'operacion-delete', 'Eliminar Permiso'),
(12, 'cajas-index', 'Cajas'),
(13, 'cajas-update', 'Modificar Caja'),
(14, 'cajas-delete', 'Eliminar Caja'),
(15, 'site-signup', 'Registro de Usuarios'),
(16, 'tiendas-index', 'Tiendas'),
(17, 'tiendas-update', 'Modificar Tienda'),
(18, 'tiendas-delete', 'Eliminar Tienda'),
(19, 'categorias-index', 'Categorias'),
(20, 'categorias-update', 'Modificar Categoria'),
(21, 'categorias-delete', 'Eliminar Categoria'),
(22, 'productos-index', 'Productos'),
(23, 'productos-update', 'Modificar Producto'),
(24, 'productos-delete', 'Eliminar Producto'),
(25, 'clientes-index', 'Clientes'),
(26, 'clientes-update', 'Modificar Cliente'),
(27, 'clientes-delete', 'Eliminar Cliente'),
(28, 'proveedores-index', 'Proveedores'),
(29, 'proveedores-update', 'Modificar Proveedor'),
(30, 'proveedores-delete', 'Eliminar Proveedor'),
(31, 'clientes-create', 'Agregar Cliente'),
(32, 'proveedores-create', 'Agregar Proveedor'),
(33, 'site-reportes', 'Ver Reportes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `id` int(11) NOT NULL,
  `nro_documento` varchar(30) DEFAULT NULL,
  `proveedor_id` int(11) NOT NULL DEFAULT 0,
  `utilidad_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fecha` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`id`, `nro_documento`, `proveedor_id`, `utilidad_total`, `fecha`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '5896367', 4, '10000.00', '2020-06-26', 1, '2020-06-24 19:10:38', 1, '2020-10-05 15:29:43', 1),
(2, '082536', 4, '10000.00', '2020-06-24', 1, '2020-06-24 19:12:30', 1, '2020-06-24 19:12:30', 1),
(3, '58963588', 4, '600.00', '2020-06-24', 1, '2020-06-24 21:01:57', 1, '2020-06-24 21:01:57', 1),
(4, '7845', 4, '0.00', '2020-06-24', 1, '2020-06-24 22:23:57', 1, '2020-10-05 15:08:13', 1),
(5, '789', 4, '0.00', '2020-06-24', 1, '2020-06-24 22:26:38', 1, '2020-06-24 22:26:38', 1),
(6, '78454548', 4, '0.00', '2020-06-24', 1, '2020-06-24 22:28:46', 1, '2020-10-05 15:10:55', 1),
(7, '80', 4, '200.00', '2020-06-24', 1, '2020-06-24 22:30:20', 1, '2020-06-24 22:30:20', 1),
(8, '250785', 4, '20500.00', '2020-06-24', 1, '2020-06-24 22:32:06', 1, '2020-06-27 17:02:23', 1),
(10, '5896', 4, '300.00', '2020-06-25', 1, '2020-06-25 13:22:29', 1, '2020-06-27 15:20:18', 1),
(11, '010203', 4, '0.00', '2020-06-27', 1, '2020-06-27 18:09:12', 1, '2020-07-06 17:54:03', 3),
(12, '204060', 4, '0.00', '0000-00-00', 1, '2020-06-27 18:16:14', 1, '2020-06-27 18:16:14', 1),
(13, '171435397', 4, '0.00', '1970-01-01', 1, '2020-06-27 19:10:07', 1, '2020-06-27 19:10:07', 1),
(14, '777', 4, '0.00', '1970-01-01', 1, '2020-06-27 19:11:22', 1, '2020-06-27 19:11:22', 1),
(15, '34', 4, '0.00', '1970-01-01', 1, '2020-06-27 19:12:10', 1, '2020-06-27 19:12:10', 1),
(16, '55', 4, '0.00', '2020-06-27', 1, '2020-06-27 19:12:49', 1, '2020-06-27 19:12:49', 1),
(17, '12', 4, '0.00', '2020-06-27', 1, '2020-06-27 19:13:47', 1, '2020-06-27 19:13:47', 1),
(18, '20406080', 4, '0.00', '2020-06-27', 1, '2020-06-27 22:32:18', 1, '2020-06-27 22:32:18', 1),
(19, '123', 4, '0.00', '2020-06-30', 1, '2020-06-30 20:29:27', 1, '2020-06-30 20:29:27', 1),
(20, '01072020', 4, '0.00', '2020-07-01', 1, '2020-07-01 20:36:35', 1, '2020-07-01 20:36:35', 1),
(21, '15953678', 4, '0.00', '2020-07-08', 1, '2020-07-08 14:15:36', 1, '2020-07-08 14:15:36', 1),
(22, '8534602', 4, '0.00', '2020-07-08', 1, '2020-07-08 14:22:07', 1, '2020-07-08 14:22:07', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_productos`
--

CREATE TABLE `orden_productos` (
  `id` int(11) NOT NULL,
  `orden_compra_id` int(11) NOT NULL DEFAULT 0,
  `producto_id` int(11) NOT NULL DEFAULT 0,
  `cantidad` decimal(10,2) NOT NULL DEFAULT 0.00,
  `precio_compra` decimal(10,2) NOT NULL DEFAULT 0.00,
  `precio_venta` decimal(10,2) NOT NULL DEFAULT 0.00,
  `utilidad` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orden_productos`
--

INSERT INTO `orden_productos` (`id`, `orden_compra_id`, `producto_id`, `cantidad`, `precio_compra`, `precio_venta`, `utilidad`) VALUES
(3, 2, 2, '15.00', '70000.00', '75000.00', '5000.00'),
(4, 2, 2, '15.00', '65000.00', '70000.00', '5000.00'),
(5, 3, 2, '25.00', '200.00', '500.00', '300.00'),
(6, 3, 2, '10.00', '200.00', '500.00', '300.00'),
(7, 4, 3, '100.00', '500000.00', '1000000.00', '0.00'),
(8, 4, 2, '10.00', '5000.00', '10000.00', '0.00'),
(9, 5, 3, '10.00', '500000.00', '1000000.00', '500000.00'),
(10, 5, 2, '10.00', '1000000.00', '2000000.00', '1000000.00'),
(11, 6, 2, '10.00', '50.00', '100.00', '50.00'),
(12, 6, 2, '20.00', '50.00', '100.00', '50.00'),
(13, 7, 3, '10.00', '400.00', '500.00', '100.00'),
(14, 7, 2, '10.00', '200.00', '300.00', '100.00'),
(15, 8, 2, '10.00', '100000.00', '120000.00', '20000.00'),
(16, 8, 3, '10.00', '5000.00', '5500.00', '500.00'),
(17, 9, 3, '12.00', '5000.00', '7500.00', '2500.00'),
(18, 10, 3, '10.00', '200.00', '500.00', '300.00'),
(20, 1, 2, '100.00', '5000.00', '6000.00', '0.00'),
(21, 1, 3, '20.00', '150.00', '200.00', '0.00'),
(22, 1, 3, '25.00', '100.00', '200.00', '0.00'),
(23, 1, 3, '30.00', '150.00', '250.00', '0.00'),
(24, 11, 2, '10.00', '100.00', '180.00', '0.00'),
(26, 12, 2, '10.00', '100.00', '200.00', '0.00'),
(27, 12, 3, '10.00', '150.00', '250.00', '0.00'),
(28, 18, 3, '10.00', '200.00', '500.00', '0.00'),
(29, 19, 2, '10.00', '100.00', '200.00', '0.00'),
(30, 19, 3, '50.00', '25.00', '30.00', '0.00'),
(31, 20, 2, '100.00', '0.00', '0.00', '0.00'),
(32, 11, 2, '1000.00', '120.00', '250.00', '0.00'),
(33, 21, 4, '100.00', '35000000.00', '50000000.00', '0.00'),
(34, 21, 5, '100.00', '10000000.00', '12000000.00', '0.00'),
(35, 22, 6, '100.00', '18000000.00', '20000000.00', '0.00'),
(36, 4, 4, '10.00', '150000.00', '180000.00', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL DEFAULT '',
  `codigo` varchar(50) DEFAULT '',
  `categoria_id` int(11) NOT NULL DEFAULT 0,
  `medida_id` int(11) NOT NULL DEFAULT 0,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `impuesto_id` int(11) NOT NULL DEFAULT 0,
  `stock_minimo` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stock_maximo` decimal(10,2) NOT NULL DEFAULT 0.00,
  `imagen` varchar(255) DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `codigo`, `categoria_id`, `medida_id`, `precio`, `impuesto_id`, `stock_minimo`, `stock_maximo`, `imagen`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 'Solomo', '0001020345', 1, 1, '720000.00', 1, '10.00', '1000.00', 'solomo.png', 1, '2020-06-16 21:46:39', 1, '2020-10-10 15:08:38', 1),
(3, 'Bananas', '1224658', 9, 1, '35000.00', 1, '20.00', '500.00', 'banana.png', 1, '2020-06-16 21:52:01', 1, '2020-06-16 21:52:01', 1),
(4, 'Manzanas', '042683', 9, 1, '500000.00', 1, '10.00', '500.00', 'manzanas.png', 1, '2020-07-08 14:11:40', 1, '2020-07-08 14:11:40', 1),
(5, 'Piñas', '209536', 9, 3, '120000.00', 1, '5.00', '500.00', 'pinas.png', 1, '2020-07-08 14:12:55', 1, '2020-10-16 20:19:51', 1),
(6, 'Fresas', '852675', 9, 1, '200000.00', 1, '100.00', '500.00', 'fresas.png', 1, '2020-07-08 14:21:26', 1, '2020-07-08 14:21:26', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL DEFAULT '',
  `razon_social` varchar(255) NOT NULL DEFAULT '',
  `nif_cif` varchar(30) NOT NULL DEFAULT '',
  `contacto` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT '',
  `telefono` varchar(100) DEFAULT '',
  `movil` varchar(100) DEFAULT '',
  `direccion` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `razon_social`, `nif_cif`, `contacto`, `correo`, `telefono`, `movil`, `direccion`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(4, 'Provinaca 2000 S.R.L', 'Inversiones Provinaca 2000 S.R.L', 'J-20008504-5', 'José Luis Abreu', 'provinaca@gmail.com', '02446630590', '04242689315', 'Av. Las Palmas entre calles 2 y 3. Sector Agua Sucia.', 1, NULL, NULL, NULL, NULL),
(5, 'Suministros Las Mercedes C.A', 'Las Mercedes', 'J-52689535-8', 'Luis Martinez', 'suministros@lasmercedes.com', '02128588899', '04248563325', 'Calle el Cojo con Araguaney', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_puntos`
--

CREATE TABLE `registro_puntos` (
  `id` int(11) NOT NULL,
  `cantidad_puntos` decimal(10,2) NOT NULL DEFAULT 0.00,
  `valor` decimal(10,2) NOT NULL DEFAULT 0.00,
  `observacion` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro_puntos`
--

INSERT INTO `registro_puntos` (`id`, `cantidad_puntos`, `valor`, `observacion`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '250.00', '1000000.00', 'Por cada $ 1.000.000,00 en compras el cliente recibirá 250 puntos.', 1, '2020-10-27 17:16:18', 1, '2020-10-28 17:58:58', 1),
(2, '100.00', '400000.00', 'Por cada $ 400.000,00 en compras el cliente recibirá 100 puntos.', 1, '2020-10-27 17:18:15', 1, '2020-10-27 21:55:40', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'Vendedor'),
(2, 'Admin'),
(3, 'SuperUsuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_operacion`
--

CREATE TABLE `rol_operacion` (
  `rol_id` int(11) NOT NULL,
  `operacion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol_operacion`
--

INSERT INTO `rol_operacion` (`rol_id`, `operacion_id`) VALUES
(2, 1),
(2, 4),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(3, 1),
(3, 4),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(3, 22),
(3, 23),
(3, 24),
(3, 25),
(3, 26),
(3, 27),
(3, 28),
(3, 29),
(3, 30),
(3, 31),
(3, 32),
(3, 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

CREATE TABLE `tiendas` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL DEFAULT '',
  `nombre` varchar(255) NOT NULL DEFAULT '',
  `razon_social` varchar(255) NOT NULL DEFAULT '',
  `nif_cif` varchar(30) NOT NULL DEFAULT '',
  `direccion` text NOT NULL,
  `telefono` varchar(100) DEFAULT '',
  `movil` varchar(100) DEFAULT '',
  `contacto` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiendas`
--

INSERT INTO `tiendas` (`id`, `codigo`, `nombre`, `razon_social`, `nif_cif`, `direccion`, `telefono`, `movil`, `contacto`, `correo`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '001', 'Amiguitos del Dog', 'Epets', 'J-85639572-8', 'Calle Los Aguacates Sector 20. El Pueblito', '+5789536251', '+5789542563', 'Pedro Perez', 'pperez@gmail.com', 1, '2020-06-25 15:46:35', 1, '2020-07-06 17:08:57', 1),
(2, '002', 'PetShop Orange', 'Epets', 'J-85639572-8', 'Av. Juan Manantial. PB. Al Lado de ElectroAuto Catedral', '+5798653241', '+5795635852', 'Luis Hurtado', 'lhurtado@orangepetshop.com', 1, '2020-06-25 17:01:37', 1, '2020-06-25 17:01:37', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `tienda_id` int(11) NOT NULL DEFAULT 0,
  `rol_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `nombre_completo`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `tienda_id`, `rol_id`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'Christian Goncalves', 'cgoncalves', '', '$2y$13$MJBA3oKeTvNwf19pdKrZIeOASKsYERVdwGoisauYoUUohiDql1P9G', NULL, 'jeam2006@gmail.com', 10, 1, 3, 1592327295, 1592327295, 'EdqvAVaWTLsZRePJWh3XH0rUR3yxBwZy_1592327295'),
(2, 'Paula Goncalves', 'paula2020', 'V3ppAmiWl87iwy2GUOPtYE-QcvBxqxIZ', '$2y$13$MJBA3oKeTvNwf19pdKrZIeOASKsYERVdwGoisauYoUUohiDql1P9G', NULL, 'paula@gmail.com', 10, 1, 1, 1592332023, 1592332023, 'TtwSK56AG7oEB6012xZqXIpZzxU1wPqO_1592332023'),
(3, 'Anyeli Mijares', 'anyeli', 'keOpxpBG6ZsbxEtO83PJQgGMVTE9Zote', '$2y$13$MJBA3oKeTvNwf19pdKrZIeOASKsYERVdwGoisauYoUUohiDql1P9G', NULL, 'anyi@gmail.com', 10, 2, 3, 1592332210, 1592332210, 'g3SgsZXOZsGGeC8vHDMz3no4U7S9NDN6_1592332210'),
(4, 'Jeampierre Goncalves', 'jeampierre', 'McEe8gY4Lrqrq5bh7dt4jdi87bQoYpn6', '$2y$13$MJBA3oKeTvNwf19pdKrZIeOASKsYERVdwGoisauYoUUohiDql1P9G', NULL, 'jeam96@hotmail.com', 10, 2, 1, 1592411550, 1592411550, 'azoL_4TwL-DiJuXPQmAJZBDoMIuSXtMJ_1592411550'),
(5, 'Jose Rafael Ortuño', 'ortuño', 'WfpT92h0WfJr6DGQaPIRtcAId4XkdJQT', '$2y$13$MJBA3oKeTvNwf19pdKrZIeOASKsYERVdwGoisauYoUUohiDql1P9G', NULL, 'ortuno@gmail.com', 10, 1, 1, 1593524942, 1593524942, 'amrE8mNh5bhF8HzjvyL-8BlUJUuEgxoF_1593524942'),
(6, 'Pedro Perez', 'pperez', 'w0rak8NP4U94dq1ttROczcS758h8svkI', '$2y$13$MJBA3oKeTvNwf19pdKrZIeOASKsYERVdwGoisauYoUUohiDql1P9G', NULL, 'pperez@gmail.com', 10, 2, 1, 1593530326, 1593530326, '9PBLvlIa5NM3ZrrCdAUbH-Q4Welz2OtJ_1593530326');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `caja_id` int(11) NOT NULL DEFAULT 0,
  `nro_documento` int(11) NOT NULL DEFAULT 0,
  `fecha` date DEFAULT NULL,
  `cliente_id` int(11) NOT NULL DEFAULT 0,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `impuesto` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `forma_pago_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `user_id`, `caja_id`, `nro_documento`, `fecha`, `cliente_id`, `subtotal`, `impuesto`, `total`, `forma_pago_id`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(22, 1, 1, 12208, '2020-07-12', 2, '200000.00', '0.00', '200000.00', 1, 1, '2020-07-12 18:36:32', 1, '2020-07-12 18:36:32', 1),
(23, 1, 1, 12209, '2020-07-12', 3, '70000.00', '0.00', '70000.00', 1, 1, '2020-07-12 18:49:24', 1, '2020-07-12 18:49:24', 1),
(24, 1, 1, 12210, '2020-07-12', 4, '240000.00', '0.00', '240000.00', 1, 1, '2020-07-12 19:02:22', 1, '2020-07-12 19:02:22', 1),
(25, 1, 1, 12211, '2020-07-12', 5, '3915000.00', '0.00', '3915000.00', 1, 1, '2020-07-12 19:22:40', 1, '2020-07-12 19:22:40', 1),
(26, 1, 1, 12212, '2020-07-12', 1, '140000.00', '0.00', '140000.00', 1, 1, '2020-07-12 22:41:10', 1, '2020-07-12 22:41:10', 1),
(27, 1, 1, 12213, '2020-07-12', 2, '600000.00', '0.00', '600000.00', 1, 1, '2020-07-12 23:01:21', 1, '2020-07-12 23:01:21', 1),
(28, 6, 3, 12214, '2020-07-12', 1, '2160000.00', '0.00', '2160000.00', 1, 1, '2020-07-12 23:12:02', 6, '2020-07-12 23:12:02', 6),
(29, 1, 1, 12215, '2020-07-15', 1, '0.00', '0.00', '0.00', 1, 1, '2020-07-15 21:23:27', 1, '2020-07-15 21:23:27', 1),
(30, 1, 1, 12216, '2020-07-21', 1, '892693.32', '87306.68', '980000.00', 1, 1, '2020-07-21 11:14:48', 1, '2020-07-21 11:14:48', 1),
(31, 1, 1, 12217, '2020-07-21', 2, '3302752.29', '297247.71', '3600000.00', 1, 1, '2020-07-21 15:17:27', 1, '2020-07-21 15:17:27', 1),
(32, 1, 1, 12218, '2020-10-10', 2, '39272727.27', '3927272.73', '43200000.00', 3, 1, '2020-10-10 15:22:33', 1, '2020-10-10 15:22:33', 1),
(33, 1, 1, 12219, '2020-10-12', 3, '4581818.18', '458181.82', '5040000.00', 1, 1, '2020-10-12 10:13:59', 1, '2020-10-12 10:13:59', 1),
(34, 1, 1, 12220, '2020-10-28', 1, '1468181.82', '146818.18', '1615000.00', 2, 1, '2020-10-28 13:01:30', 1, '2020-10-28 13:01:30', 1),
(35, 1, 1, 12221, '2020-10-28', 1, '2618181.82', '261818.18', '2880000.00', 1, 1, '2020-10-28 13:13:31', 1, '2020-10-28 13:13:31', 1),
(36, 1, 1, 12222, '2020-10-28', 5, '654545.45', '65454.55', '720000.00', 1, 1, '2020-10-28 13:37:40', 1, '2020-10-28 13:37:40', 1),
(37, 1, 1, 12223, '2020-10-28', 1, '654545.45', '65454.55', '720000.00', 1, 1, '2020-10-28 17:37:28', 1, '2020-10-28 17:37:28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_productos`
--

CREATE TABLE `ventas_productos` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL DEFAULT 0,
  `producto_id` int(11) NOT NULL DEFAULT 0,
  `cantidad` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas_productos`
--

INSERT INTO `ventas_productos` (`id`, `venta_id`, `producto_id`, `cantidad`) VALUES
(1, 22, 2, '2.00'),
(2, 22, 3, '3.00'),
(3, 22, 4, '2.00'),
(4, 22, 5, '1.00'),
(5, 22, 6, '1.00'),
(6, 23, 3, '2.00'),
(7, 24, 3, '2.00'),
(8, 24, 5, '2.00'),
(9, 25, 2, '2.00'),
(10, 25, 3, '1.00'),
(11, 25, 4, '4.00'),
(12, 25, 5, '2.00'),
(13, 25, 6, '1.00'),
(14, 26, 3, '4.00'),
(15, 27, 6, '3.00'),
(16, 28, 2, '3.00'),
(17, 30, 3, '4.00'),
(18, 30, 2, '1.00'),
(19, 30, 5, '1.00'),
(20, 31, 2, '5.00'),
(21, 32, 2, '60.00'),
(22, 33, 2, '7.00'),
(23, 34, 3, '5.00'),
(24, 34, 2, '2.00'),
(25, 35, 2, '4.00'),
(26, 36, 2, '1.00'),
(27, 37, 2, '1.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banco_operador_id` (`banco_operador_id`);

--
-- Indices de la tabla `banco_operador`
--
ALTER TABLE `banco_operador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bonos`
--
ALTER TABLE `bonos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bonos_asignados`
--
ALTER TABLE `bonos_asignados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tienda_id` (`tienda_id`);

--
-- Indices de la tabla `cajas_apertura`
--
ALTER TABLE `cajas_apertura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `caja_id` (`caja_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_cliente_id` (`categoria_cliente_id`);

--
-- Indices de la tabla `clientes_categorias`
--
ALTER TABLE `clientes_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `cotizaciones_productos`
--
ALTER TABLE `cotizaciones_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `cupones`
--
ALTER TABLE `cupones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cupones_lista`
--
ALTER TABLE `cupones_lista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `existencias`
--
ALTER TABLE `existencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tienda_id` (`tienda_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedor_id` (`proveedor_id`),
  ADD KEY `tienda_id` (`tienda_id`),
  ADD KEY `forma_pago_id` (`forma_pago_id`),
  ADD KEY `impuesto_id` (`impuesto_id`),
  ADD KEY `gastos_categorias_id` (`gastos_categorias_id`),
  ADD KEY `gastos_subcategorias_id` (`gastos_subcategorias_id`),
  ADD KEY `gastos_ibfk_7` (`banco_id`);

--
-- Indices de la tabla `gastos_categorias`
--
ALTER TABLE `gastos_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos_subcategorias`
--
ALTER TABLE `gastos_subcategorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gastos_categorias_id` (`gastos_categorias_id`);

--
-- Indices de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orden_compra_id` (`orden_compra_id`),
  ADD KEY `tienda_origen_id` (`tienda_origen_id`),
  ADD KEY `tienda_destino_id` (`tienda_destino_id`),
  ADD KEY `tienda_id` (`tienda_id`);

--
-- Indices de la tabla `inventario_auditoria`
--
ALTER TABLE `inventario_auditoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tienda_id` (`tienda_id`);

--
-- Indices de la tabla `inventario_auditoria_productos`
--
ALTER TABLE `inventario_auditoria_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `inventario_productos`
--
ALTER TABLE `inventario_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `libro_precios`
--
ALTER TABLE `libro_precios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tienda_id` (`tienda_id`);

--
-- Indices de la tabla `libro_precios_productos`
--
ALTER TABLE `libro_precios_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `mov_bancarios`
--
ALTER TABLE `mov_bancarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banco_id` (`banco_id`),
  ADD KEY `tipo_movimiento_id` (`tipo_movimiento_id`);

--
-- Indices de la tabla `mov_bancario_tipo`
--
ALTER TABLE `mov_bancario_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `operacion`
--
ALTER TABLE `operacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nro_documento` (`nro_documento`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- Indices de la tabla `orden_productos`
--
ALTER TABLE `orden_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `medida_id` (`medida_id`),
  ADD KEY `impuesto_id` (`impuesto_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_puntos`
--
ALTER TABLE `registro_puntos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol_operacion`
--
ALTER TABLE `rol_operacion`
  ADD PRIMARY KEY (`rol_id`,`operacion_id`);

--
-- Indices de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `tienda_id` (`tienda_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `caja_id` (`caja_id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `forma_pago_id` (`forma_pago_id`);

--
-- Indices de la tabla `ventas_productos`
--
ALTER TABLE `ventas_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id` (`venta_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `banco_operador`
--
ALTER TABLE `banco_operador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `bonos`
--
ALTER TABLE `bonos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `bonos_asignados`
--
ALTER TABLE `bonos_asignados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cajas`
--
ALTER TABLE `cajas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cajas_apertura`
--
ALTER TABLE `cajas_apertura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clientes_categorias`
--
ALTER TABLE `clientes_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cotizaciones_productos`
--
ALTER TABLE `cotizaciones_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `cupones`
--
ALTER TABLE `cupones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `cupones_lista`
--
ALTER TABLE `cupones_lista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `existencias`
--
ALTER TABLE `existencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `gastos_categorias`
--
ALTER TABLE `gastos_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `gastos_subcategorias`
--
ALTER TABLE `gastos_subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `inventario_auditoria`
--
ALTER TABLE `inventario_auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventario_auditoria_productos`
--
ALTER TABLE `inventario_auditoria_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `inventario_productos`
--
ALTER TABLE `inventario_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `libro_precios`
--
ALTER TABLE `libro_precios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `libro_precios_productos`
--
ALTER TABLE `libro_precios_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mov_bancarios`
--
ALTER TABLE `mov_bancarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `mov_bancario_tipo`
--
ALTER TABLE `mov_bancario_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `operacion`
--
ALTER TABLE `operacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `orden_productos`
--
ALTER TABLE `orden_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `registro_puntos`
--
ALTER TABLE `registro_puntos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `ventas_productos`
--
ALTER TABLE `ventas_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD CONSTRAINT `bancos_ibfk_1` FOREIGN KEY (`banco_operador_id`) REFERENCES `banco_operador` (`id`);

--
-- Filtros para la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD CONSTRAINT `cajas_ibfk_1` FOREIGN KEY (`tienda_id`) REFERENCES `tiendas` (`id`);

--
-- Filtros para la tabla `cajas_apertura`
--
ALTER TABLE `cajas_apertura`
  ADD CONSTRAINT `cajas_apertura_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cajas_apertura_ibfk_2` FOREIGN KEY (`caja_id`) REFERENCES `cajas` (`id`);

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`categoria_cliente_id`) REFERENCES `clientes_categorias` (`id`);

--
-- Filtros para la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD CONSTRAINT `cotizaciones_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `cotizaciones_productos`
--
ALTER TABLE `cotizaciones_productos`
  ADD CONSTRAINT `cotizaciones_productos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `existencias`
--
ALTER TABLE `existencias`
  ADD CONSTRAINT `existencias_ibfk_1` FOREIGN KEY (`tienda_id`) REFERENCES `tiendas` (`Id`),
  ADD CONSTRAINT `existencias_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `gastos_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`Id`),
  ADD CONSTRAINT `gastos_ibfk_2` FOREIGN KEY (`tienda_id`) REFERENCES `tiendas` (`Id`),
  ADD CONSTRAINT `gastos_ibfk_3` FOREIGN KEY (`forma_pago_id`) REFERENCES `forma_pago` (`Id`),
  ADD CONSTRAINT `gastos_ibfk_4` FOREIGN KEY (`impuesto_id`) REFERENCES `impuestos` (`Id`),
  ADD CONSTRAINT `gastos_ibfk_5` FOREIGN KEY (`gastos_categorias_id`) REFERENCES `gastos_categorias` (`id`),
  ADD CONSTRAINT `gastos_ibfk_6` FOREIGN KEY (`gastos_subcategorias_id`) REFERENCES `gastos_subcategorias` (`id`);

--
-- Filtros para la tabla `gastos_subcategorias`
--
ALTER TABLE `gastos_subcategorias`
  ADD CONSTRAINT `gastos_subcategorias_ibfk_1` FOREIGN KEY (`gastos_categorias_id`) REFERENCES `gastos_categorias` (`id`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`orden_compra_id`) REFERENCES `orden_compra` (`id`),
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`tienda_origen_id`) REFERENCES `tiendas` (`id`),
  ADD CONSTRAINT `inventario_ibfk_3` FOREIGN KEY (`tienda_destino_id`) REFERENCES `tiendas` (`id`),
  ADD CONSTRAINT `inventario_ibfk_4` FOREIGN KEY (`tienda_id`) REFERENCES `tiendas` (`Id`);

--
-- Filtros para la tabla `inventario_auditoria`
--
ALTER TABLE `inventario_auditoria`
  ADD CONSTRAINT `inventario_auditoria_ibfk_1` FOREIGN KEY (`tienda_id`) REFERENCES `tiendas` (`Id`);

--
-- Filtros para la tabla `inventario_auditoria_productos`
--
ALTER TABLE `inventario_auditoria_productos`
  ADD CONSTRAINT `inventario_auditoria_productos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `inventario_productos`
--
ALTER TABLE `inventario_productos`
  ADD CONSTRAINT `inventario_productos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `libro_precios`
--
ALTER TABLE `libro_precios`
  ADD CONSTRAINT `libro_precios_ibfk_2` FOREIGN KEY (`tienda_id`) REFERENCES `tiendas` (`Id`);

--
-- Filtros para la tabla `libro_precios_productos`
--
ALTER TABLE `libro_precios_productos`
  ADD CONSTRAINT `libro_precios_productos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `mov_bancarios`
--
ALTER TABLE `mov_bancarios`
  ADD CONSTRAINT `mov_bancarios_ibfk_1` FOREIGN KEY (`banco_id`) REFERENCES `bancos` (`id`),
  ADD CONSTRAINT `mov_bancarios_ibfk_2` FOREIGN KEY (`tipo_movimiento_id`) REFERENCES `mov_bancario_tipo` (`id`);

--
-- Filtros para la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD CONSTRAINT `orden_compra_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`Id`);

--
-- Filtros para la tabla `orden_productos`
--
ALTER TABLE `orden_productos`
  ADD CONSTRAINT `orden_productos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`medida_id`) REFERENCES `medidas` (`id`),
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`impuesto_id`) REFERENCES `impuestos` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`tienda_id`) REFERENCES `tiendas` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`caja_id`) REFERENCES `cajas` (`id`),
  ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `ventas_ibfk_4` FOREIGN KEY (`forma_pago_id`) REFERENCES `forma_pago` (`id`);

--
-- Filtros para la tabla `ventas_productos`
--
ALTER TABLE `ventas_productos`
  ADD CONSTRAINT `ventas_productos_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`),
  ADD CONSTRAINT `ventas_productos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
