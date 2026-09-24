-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-09-2026 a las 15:45:54
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
-- Base de datos: `cheoparrilla_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `slug` varchar(60) NOT NULL,
  `orden` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `slug`, `orden`) VALUES
(1, 'Asados y Carnes', 'asados', 1),
(2, 'Hamburguesas Artesanales', 'hamburguesas', 2),
(3, 'Combo de Hamburguesas', 'combo-hamburguesas', 3),
(4, 'Salchipapas', 'salchipapas', 4),
(5, 'Perros y Perras Artesanales', 'perros', 5),
(8, 'Otros', 'otros', 6),
(6, 'Bebidas', 'bebidas', 7),
(7, 'Licores', 'licores', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL DEFAULT 1,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL DEFAULT '',
  `valor` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL DEFAULT '',
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `orden` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`id`, `categoria_id`, `nombre`, `descripcion`, `valor`, `imagen`, `activo`, `orden`) VALUES
(1, 1, 'Chuzo de Pollo', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 20000.00, '', 1, 10),
(2, 1, 'Chuzo de cerdo', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 20000.00, '', 1, 20),
(3, 1, 'Carne de Cerdo', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 21000.00, '', 1, 30),
(4, 1, 'Carne de Res', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 22000.00, '', 1, 40),
(5, 1, 'Chuleta', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 22000.00, '', 1, 50),
(6, 1, 'Costichic', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 22000.00, '', 1, 60),
(7, 1, 'Pechuga', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 22000.00, '', 1, 70),
(8, 1, 'Carne de Res envinada', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 25000.00, '', 1, 80),
(9, 1, 'Pechuga Gratinada', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 26000.00, '', 1, 90),
(10, 1, 'Punta de Anca', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 29500.00, '', 1, 100),
(11, 1, 'Churrasco', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 29500.00, '', 1, 110),
(12, 1, 'Picada para 2 personas', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 32500.00, '', 1, 120),
(13, 2, 'Sencilla', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 9000.00, '', 1, 130),
(14, 2, 'Especial', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 12000.00, '', 1, 140),
(15, 2, 'Doble Carne', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 15000.00, '', 1, 150),
(16, 2, 'Ropa Vieja', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 15000.00, '', 1, 160),
(17, 2, 'Pollo con Champiñones', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 15000.00, '', 1, 170),
(18, 2, 'Hawaiana', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 15000.00, '', 1, 180),
(19, 2, 'Pollo Maicito', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 15000.00, '', 1, 190),
(20, 2, 'Quesuda', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 15000.00, '', 1, 200),
(21, 2, 'Mexicana', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 16000.00, '', 1, 210),
(22, 2, 'Mixta', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 16000.00, '', 1, 220),
(23, 2, 'Jumbo', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 17000.00, '', 1, 230),
(24, 2, 'ChuzoBurguer', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 17000.00, '', 1, 240),
(25, 2, 'Paisa', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 17000.00, '', 1, 250),
(26, 2, 'Carnaval', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 17000.00, '', 1, 260),
(27, 5, 'Perro Sencillo', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 9000.00, '', 1, 270),
(28, 5, 'Perro Especial', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 12000.00, '', 1, 280),
(29, 5, 'Perro Doble Cañon', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 14000.00, '', 1, 290),
(30, 5, 'Perro Hawaiano', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 15000.00, '', 1, 300),
(31, 5, 'Perro con carne', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 15000.00, '', 1, 310),
(32, 5, 'Perro pollo y maicitos', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 15000.00, '', 1, 320),
(33, 5, 'Perro mexicano', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 15000.00, '', 1, 330),
(34, 5, 'Perro quesudo', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 15000.00, '', 1, 340),
(35, 5, 'Perro pollo con champiñones', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 15000.00, '', 1, 350),
(36, 5, 'Chuzoperro', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 17000.00, '', 1, 360),
(37, 5, 'Perro Jumbo de 40cm', 'Preparado con ingredientes seleccionados y el sabor de nuestra cocina. (Editar descripción real desde el panel)', 26000.00, '', 1, 370);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `personas` tinyint(4) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `notas` varchar(200) DEFAULT NULL,
  `estado` enum('pendiente','confirmada','cumplida','cancelada','no_asistio') NOT NULL DEFAULT 'pendiente',
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `codigo`, `nombre`, `telefono`, `personas`, `fecha`, `hora`, `notas`, `estado`, `creado`) VALUES
(1, 'CP-R-000001', 'Laura Restrepo', '3001234567', 4, '2026-09-18', '19:00:00', 'Cumpleanos', 'confirmada', '2026-09-18 13:39:24'),
(2, 'CP-R-000002', 'Andres Gomez', '3019876543', 6, '2026-09-18', '19:00:00', NULL, 'pendiente', '2026-09-18 13:39:24'),
(3, 'CP-R-000003', 'Familia Munoz', '3145558899', 8, '2026-09-18', '20:00:00', 'Mesa cerca a la ventana', 'confirmada', '2026-09-18 13:39:24'),
(4, 'CP-R-000004', 'Camilo Ruiz', '3112223344', 2, '2026-09-18', '19:30:00', NULL, 'cancelada', '2026-09-18 13:39:24'),
(5, 'CP-R-000005', 'Sara Villa', '3204447788', 5, '2026-09-19', '20:00:00', NULL, 'pendiente', '2026-09-18 13:39:24'),
(6, 'CP-R-000006', 'antonio arenas', '3101234567', 10, '2026-09-23', '19:00:00', 'cumpleaños', 'pendiente', '2026-09-23 14:39:13'),
(7, 'CP-R-000007', 'juanito perez', '3101234567', 10, '2026-09-23', '19:00:00', 'cumpleaños', 'pendiente', '2026-09-23 14:41:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_bloqueos`
--

CREATE TABLE `reservas_bloqueos` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `motivo` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_config`
--

CREATE TABLE `reservas_config` (
  `clave` varchar(40) NOT NULL,
  `valor` varchar(120) NOT NULL,
  `descripcion` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas_config`
--

INSERT INTO `reservas_config` (`clave`, `valor`, `descripcion`) VALUES
('capacidad_local', '40', 'Cuantas personas caben al mismo tiempo en el local'),
('dias_anticipacion', '30', 'Con cuantos dias de anticipacion se puede reservar'),
('duracion_min', '90', 'Cuanto tiempo ocupa la mesa una reserva, en minutos'),
('intervalo_min', '30', 'Cada cuantos minutos se ofrece una franja (30 = 6:00, 6:30, 7:00)'),
('max_personas', '10', 'Maximo de personas por reserva (mas que esto es un evento)'),
('min_personas', '1', 'Minimo de personas por reserva'),
('nombre_negocio', 'Cheo Parrilla', 'Nombre que sale en el mensaje de WhatsApp'),
('whatsapp', '573234382813', 'WhatsApp del restaurante, con 57 y sin signos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_horarios`
--

CREATE TABLE `reservas_horarios` (
  `dia_semana` tinyint(4) NOT NULL,
  `abre` tinyint(1) NOT NULL DEFAULT 1,
  `apertura` time NOT NULL,
  `cierre` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas_horarios`
--

INSERT INTO `reservas_horarios` (`dia_semana`, `abre`, `apertura`, `cierre`) VALUES
(1, 0, '17:00:00', '22:00:00'),
(2, 1, '17:00:00', '22:00:00'),
(3, 1, '17:00:00', '22:00:00'),
(4, 1, '17:00:00', '22:00:00'),
(5, 1, '16:00:00', '23:00:00'),
(6, 1, '12:00:00', '23:00:00'),
(7, 1, '12:00:00', '21:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `creado`) VALUES
(1, 'admin', '$2y$12$KwD7MWf9YXa2TZfdXCanmOQvZWlAoJxQarV1pALCNCMVYTkliExJm', '2026-09-23 14:47:50');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_plato_categoria` (`categoria_id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_codigo` (`codigo`),
  ADD KEY `idx_fecha_hora` (`fecha`,`hora`);

--
-- Indices de la tabla `reservas_bloqueos`
--
ALTER TABLE `reservas_bloqueos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_fecha` (`fecha`);

--
-- Indices de la tabla `reservas_config`
--
ALTER TABLE `reservas_config`
  ADD PRIMARY KEY (`clave`);

--
-- Indices de la tabla `reservas_horarios`
--
ALTER TABLE `reservas_horarios`
  ADD PRIMARY KEY (`dia_semana`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservas_bloqueos`
--
ALTER TABLE `reservas_bloqueos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `platos`
--
ALTER TABLE `platos`
  ADD CONSTRAINT `fk_plato_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
