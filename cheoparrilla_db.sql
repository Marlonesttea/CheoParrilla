-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-09-2026 a las 05:13:59
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
(6, 'Bebidas', 'bebidas', 7),
(7, 'Licores', 'licores', 8),
(8, 'Otros', 'otros', 6);

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
(1, 1, 'Chuzo de Pollo', 'Chuzo de pollo, hechos con una deliciosa milanesa acompañado con papas y arepas.', 20000.00, 'imagenCards', 1, 10),
(2, 1, 'Chuzo de cerdo', 'Delicioso chuzo de cerdo, una excelente carne de cerdo acompañada de papas y arepas.', 20000.00, 'imagenCards2', 1, 20),
(3, 1, 'Carne de Cerdo', 'Carne de cerdo asada, bien hecha, jugosa y sabrosa acompañada de papas y arepas.', 21000.00, 'imagenCards3', 1, 30),
(4, 1, 'Carne de Res', 'Un excelso filete de carne de Res acompañado de arroz y papas a la francesa.', 22000.00, 'imagenCards4', 1, 40),
(5, 1, 'Chuleta', 'Chuleta de cerdo bañada en una deliciosa salsa BBQ.', 22000.00, 'imagenCards5', 1, 50),
(6, 1, 'Costichic', 'Disfruta de nuestro delicioso plato Costichi el cual viene acompañado de arroz, papas a la francesa y arepa con queso mozarella.', 22000.00, 'imagenCards6', 1, 60),
(7, 1, 'Pechuga', 'Deliciosa pechuga de pollo a la parrilla, acompañada de arroz y ensalada fresca.', 22000.00, 'imagenCards7', 1, 70),
(8, 1, 'Carne de Res envinada', 'Carne de res envinada, acompañada de arroz y papas a la francesa.', 25000.00, 'imagenCards8', 1, 80),
(9, 1, 'Pechuga Gratinada', 'Una exquisita pechuga gratinada, viene junto con papas a la francesa, maicitos, y ensalada.', 26000.00, 'imagenCards9', 1, 90),
(10, 1, 'Punta de Anca', 'No existe un mejor corte que este, disfruta ya de nuestro plato de Punta de Anca, marinada y cocinada de la mejor manera.', 29500.00, 'imagenCards10', 1, 100),
(11, 1, 'Churrasco', 'El mejor Churrasco de medelín lo encuentras aquí, jugoso y lleno de sabor.', 29500.00, 'imagenCards11', 1, 110),
(12, 1, 'Picada para 2 personas', 'Delicioso ......  preparado con ingredientes seleccionados y el sabor de nuestra cocina.', 32500.00, 'imagenCards12', 1, 120),
(13, 2, 'Sencilla', 'Una deliciosa hamburguesa con carne jugosa, queso derretido y ingredientes frescos.', 9000.00, 'imagenCards13', 1, 130),
(14, 2, 'Especial', 'Una deliciosa hamburguesa especial con ingredientes frescos y salsas únicas.', 12000.00, 'imagenCards14', 1, 140),
(15, 2, 'Doble Carne', 'Exquisita hamburguesa dos carnes, con ingredientes frescos y salsas especiales.', 15000.00, 'imagenCards15', 1, 150),
(16, 2, 'Ropa Vieja', 'Nuestra increible hamburguesa \'ropa vieja\' te va a encantar.', 15000.00, 'imagenCards16', 1, 160),
(17, 2, 'Pollo con Champiñones', 'Pollo y champiñones en salsa blanca, nuestra deliciosa hamburguesa.', 15000.00, 'imagenCards17', 1, 170),
(18, 2, 'Hawaiana', 'Una deliciosa hamburguesa hawaiana con piña y jamón, Aloha!!.', 15000.00, 'imagenCards18', 1, 180),
(19, 2, 'Pollo Maicito', 'Pollo Maicito, una deliciosa combinación de sabores y texturas.', 15000.00, 'imagenCards19', 1, 190),
(20, 2, 'Quesuda', 'Una hamburguesa full queso que te hará agua la boca.', 15000.00, 'imagenCards20', 1, 200),
(21, 2, 'Mexicana', 'Una deliciosa hamburguesa mexicana para comer a toda madre mi wey!!.', 16000.00, 'imagenCards21', 1, 210),
(22, 2, 'Mixta', 'Hamburguesa mixta, dos carnes, queso y bacon.', 16000.00, 'imagenCards22', 1, 220),
(23, 2, 'Jumbo', 'Deliciosa hamburguesa Jumbo, con ingredientes seleccionados y el sabor de nuestra cocina.', 17000.00, 'imagenCards23', 1, 230),
(24, 2, 'ChuzoBurguer', 'ChuzoBurguer, una deliciosa hamburguesa con chorizo y queso fundido.', 17000.00, 'imagenCards24', 1, 240),
(25, 2, 'Paisa', 'Hamburguesa Paisa, para comer con los parceroosss!!.', 17000.00, 'imagenCards25', 1, 250),
(26, 2, 'Carnaval', 'Una deliciosa hamburguesa con carne de res, pollo y cerdo. Un carnaval de sabores!!', 17000.00, 'imagenCards26', 1, 260),
(27, 5, 'Perro Sencillo', 'Perro Sencillo, el sabor de nuestra cocina.', 9000.00, 'imagenCards27', 1, 270),
(28, 5, 'Perro Especial', 'Perro Especial, una deliciosa combinación de sabores y texturas.', 12000.00, 'imagenCards28', 1, 280),
(29, 5, 'Perro Doble Cañon', 'Perro Doble Cañon, una deliciosa combinación de carnes y salsas.', 14000.00, 'imagenCards29', 1, 290),
(30, 5, 'Perro Hawaiano', 'Perro Hawaiano, una deliciosa combinación de sabores tropicales.', 15000.00, 'imagenCards30', 1, 300),
(31, 5, 'Perro con carne', 'Perro con carne, una deliciosa combinación de sabores y texturas.', 15000.00, 'imagenCards31', 1, 310),
(32, 5, 'Perro pollo y maicitos', 'Perro pollo y maicitos, una deliciosa combinación de carne y maíz dulce.', 15000.00, 'imagenCards32', 1, 320),
(33, 5, 'Perro mexicano', 'Perro mexicano, una deliciosa combinación de sabores y texturas mexicanas.', 15000.00, 'imagenCards33', 1, 330),
(34, 5, 'Perro quesudo', 'Perro quesudo, full queso y full sabor', 15000.00, 'imagenCards34', 1, 340),
(35, 5, 'Perro pollo con champiñones', 'Perro Pollo con champiñones, una deliciosa combinación de sabores y texturas.', 15000.00, 'imagenCards35', 1, 350),
(36, 5, 'Chuzoperro', 'Chuzoperro, un sabor autentico y perfecto.', 17000.00, 'imagenCards36', 1, 360),
(37, 5, 'Perro Jumbo de 40cm', 'Nuestro Gourmet y gigante perro jumbo de 40cm, con un sabor sabrosisimo en cada bocado, de principio a fin.', 26000.00, 'imagenCards37', 1, 370),
(38, 5, 'Perra Especial', 'Una buena perra con bastante tocineta, salsa de la casa y más.', 11500.00, 'imagenCards38', 1, 380),
(39, 5, 'Perra Fufa', 'Perra con carne desmechada y ahogao, para probarlo 2 veces!!.', 11500.00, 'imagenCards39', 1, 390),
(40, 5, 'Perra pollo y maicitos', 'Perra con pollo desmechado y maicitos, un sabor autentico', 11500.00, 'imagenCards40', 1, 400),
(41, 5, 'Perra Quesuda', 'Perra Quesuda, full queso y full sabor', 14500.00, 'imagenCards41', 1, 410),
(42, 5, 'Perra pollo con champiñones', 'Perra pollo con champiñones, una deliciosa combinación de sabores y texturas.', 14500.00, 'imagenCards42', 1, 420),
(43, 5, 'Perra grilla', 'Perra grilla, full sabor a la parrilla y el toque especial de la casa.', 15500.00, 'imagenCards42', 1, 430),
(44, 4, 'Sencilla', 'Salchipapa sencilla, papas fritas y salsas al gusto.', 9000.00, 'imagenCards43', 1, 440),
(45, 4, 'Especial', 'Salchipapa especial, con ingredientes premium y salsas exclusivas.', 12000.00, 'imagenCards44', 1, 450),
(46, 4, 'Desgranada', 'Salchipapa desgranada, con un toque especial.', 15000.00, 'imagenCards45', 1, 460),
(47, 4, 'Con pollo', 'Salchipapa con pollo, una deliciosa combinación de sabores.', 16000.00, 'imagenCards46', 1, 470),
(48, 4, 'Con carne', 'Salchipapa con carne, un sabor autentico y delicioso.', 16000.00, 'imagenCards47', 1, 480),
(49, 4, 'Paisa', 'Salchipapa paisa, un sabor autentico para un parche bacano!!', 19500.00, 'imagenCards48', 1, 490),
(50, 3, 'Combo Hamburguesas', 'Un combo de hamburguesas, cargado de sabor y acompañamientos!', 17000.00, 'imagenCards49', 1, 500),
(51, 3, 'Combo Alitas: Combo 1', 'Un combo de alitas, con mucha salsa y sabor', 17000.00, 'imagenCards50', 1, 510),
(52, 3, 'Combo Alitas: Combo 2', 'Un combo de muchas alitas, papas y 2 gaseosas.', 31500.00, 'imagenCards51', 1, 520),
(53, 3, 'Combo Alitas: Combo 3', 'Un combo de aun más alitas, papas y 2 gaseosas.', 42000.00, 'imagenCards52', 1, 530),
(54, 8, 'Arepa Burguer', 'Una deliciosa arepa rellena de carne, queso, huevo, bacon y más', 13000.00, 'imagenCards53', 1, 540),
(55, 8, 'Burrito', 'Un burrito delicioso con carne, frijoles y salsa.', 13000.00, 'imagenCards54', 1, 550),
(56, 8, 'Patacón', 'Un patacón crujiente con carne, queso y salsa.', 16000.00, 'imagenCards55', 1, 560),
(57, 8, 'Ceviche de Chicharrón', 'Un ceviche fresco de chicharrón, con limón y cebolla.', 21000.00, 'imagenCards56', 1, 570),
(58, 6, 'Coca-Cola', 'Coca Cola 315 mL', 3000.00, 'imagenCards57', 1, 580),
(59, 6, 'Coca-Cola Zero', '', 2000.00, 'imagenCards58', 1, 590),
(60, 6, 'Agua', '', 2000.00, 'imagenCards59', 1, 600),
(61, 6, 'Premio', '', 4000.00, 'imagenCards60', 1, 610),
(62, 6, 'Quatro', '', 4000.00, 'imagenCards61', 1, 620),
(63, 6, 'Sprite', '', 4000.00, 'imagenCards62', 1, 630),
(64, 6, '', '', 5000.00, 'imagenCards63', 1, 640),
(65, 6, 'Jugo en leche', '', 6500.00, 'imagenCards64', 1, 650),
(66, 6, 'Limonada natural', '', 5000.00, 'imagenCards65', 1, 660),
(67, 6, 'Limonada Hierbabuena', '', 7000.00, 'imagenCards66', 1, 670),
(68, 6, 'Fresa', '', 7000.00, 'imagenCards67', 1, 680),
(69, 6, 'Cereza', '', 7000.00, 'imagenCards68', 1, 690),
(70, 6, 'Mango', '', 7000.00, 'imagenCards69', 1, 700),
(71, 6, 'Maracuyá', '', 7000.00, 'imagenCards70', 1, 710),
(72, 6, 'Sandia', '', 7000.00, 'imagenCards71', 1, 720),
(73, 7, 'Copa de Vino', 'oe', 10000.00, 'imagenCards72', 1, 730),
(74, 7, 'Botella de Vino', '', 55000.00, 'imagenCards73', 1, 740),
(75, 7, 'Ron 8 años', '', 0.00, 'imagenCards74', 1, 750),
(76, 7, 'Guaro Tapa roja', '', 0.00, 'imagenCards75', 1, 760),
(77, 7, 'Buchanans', '', 0.00, 'imagenCards76', 1, 770),
(78, 7, 'Old Parr', '', 0.00, 'imagenCards77', 1, 780),
(79, 7, 'Tequila 1800', '', 0.00, 'imagenCards78', 1, 790),
(80, 7, 'Corona', '', 0.00, 'imagenCards79', 1, 800),
(81, 7, '3 Cordilleras', '', 0.00, 'imagenCards80', 1, 810),
(82, 7, 'Heineken', '', 0.00, 'imagenCards81', 1, 820),
(83, 7, 'Club Colombia', '', 0.00, 'imagenCards82', 1, 830),
(84, 7, 'Aguila', '', 0.00, 'imagenCards83', 1, 840),
(85, 7, 'Aguila Light', '', 0.00, 'imagenCards84', 1, 850),
(86, 7, 'Pilsen', '', 0.00, 'imagenCards85', 1, 860);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('nombre_negocio', 'CheoParrilla', 'Nombre que sale en el mensaje de WhatsApp'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
