-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2026 a las 07:41:38
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
(1, 1, 'Chuzo de Pollo', 'Chuzo de pollo, hechos con una deliciosa milanesa acompañado con papas y arepas.', 20000.00, 'assets/imagenes/platos/7652a792d1ecac541d3815a2fb16fafe.jpg', 1, 10),
(2, 1, 'Chuzo de cerdo', 'Delicioso chuzo de cerdo, una excelente carne de cerdo acompañada de papas y arepas.', 20000.00, 'assets/imagenes/platos/5b300f2c7f27e4992ef7f5f7fd3bf3ed.png', 1, 20),
(3, 1, 'Carne de Cerdo', 'Carne de cerdo asada, bien hecha, jugosa y sabrosa acompañada de papas y arepas.', 21000.00, 'assets/imagenes/platos/e3fb5bdc32baa63a9587c62f11f1378f.jpg', 1, 30),
(4, 1, 'Carne de Res', 'Un excelso filete de carne de Res acompañado de arroz y papas a la francesa.', 22000.00, 'assets/imagenes/platos/4d81e4f9ed21824e90cfb271f1d64b14.png', 1, 40),
(5, 1, 'Chuleta', 'Chuleta de cerdo bañada en una deliciosa salsa BBQ.', 22000.00, 'assets/imagenes/platos/7f4d0c8d6d67713898d2c7ec129573c8.png', 1, 50),
(6, 1, 'Costichic', 'Disfruta de nuestro delicioso plato Costichi el cual viene acompañado de ensalada, papas a la francesa y arepa con queso mozarella.', 22000.00, 'assets/imagenes/platos/0d28c9ddcc28dc8f8f72f1518a701d29.png', 1, 60),
(7, 1, 'Pechuga', 'Deliciosa pechuga de pollo a la parrilla, acompañada de arroz y ensalada fresca.', 22000.00, 'assets/imagenes/platos/6d47d1d6a00eaf57fd2001506908ce94.jpeg', 1, 70),
(8, 1, 'Carne de Res envinada', 'Carne de res envinada, acompañada de arroz y papas a la francesa.', 25000.00, 'assets/imagenes/platos/8d4dc2568f706a6c71ef13b5e4c15237.jpeg', 1, 80),
(9, 1, 'Pechuga Gratinada', 'Una exquisita pechuga gratinada, viene junto con papas a la francesa, maicitos, y ensalada.', 26000.00, 'assets/imagenes/platos/fd2b59da001e06afc15a374996ca91c3.png', 1, 90),
(10, 1, 'Punta de Anca', 'No existe un mejor corte que este, disfruta ya de nuestro plato de Punta de Anca, marinada y cocinada de la mejor manera.', 29500.00, 'assets/imagenes/platos/76edfa674c034e9b605af6fb41bb78c6.jpeg', 1, 100),
(11, 1, 'Churrasco', 'El mejor Churrasco de medelín lo encuentras aquí, jugoso y lleno de sabor.', 29500.00, 'assets/imagenes/platos/24221e68fea2b67a2755f9c496379bf5.jpg', 1, 110),
(12, 1, 'Picada para 2 personas', 'Delicioso ......  preparado con ingredientes seleccionados y el sabor de nuestra cocina.', 32500.00, 'assets/imagenes/platos/4bcb1bbfc80a4e7afe257a7193a47c0e.png', 1, 120),
(13, 2, 'Sencilla', 'Una deliciosa hamburguesa con carne jugosa, queso derretido y ingredientes frescos.', 9000.00, 'assets/imagenes/platos/a21bf978c6baef99dbbe8e429033c1db.jpeg', 1, 130),
(14, 2, 'Especial', 'Una deliciosa hamburguesa especial con ingredientes frescos y salsas únicas.', 12000.00, 'assets/imagenes/platos/3ebea9c49934038f781ebb8c1142c3cc.jpeg', 1, 140),
(15, 2, 'Doble Carne', 'Exquisita hamburguesa dos carnes, con ingredientes frescos y salsas especiales.', 15000.00, 'assets/imagenes/platos/1116d9c30627efd631cf18fa53003eec.jpeg', 1, 150),
(16, 2, 'Ropa Vieja', 'Nuestra increible hamburguesa \'ropa vieja\' te va a encantar.', 15000.00, 'assets/imagenes/platos/b85c13323741187e15587e48fe953e97.jpeg', 1, 160),
(17, 2, 'Pollo con Champiñones', 'Pollo y champiñones en salsa blanca, nuestra deliciosa hamburguesa.', 15000.00, 'assets/imagenes/platos/46c5d279af140b7c1379cfd3dad455e9.jpeg', 1, 170),
(18, 2, 'Hawaiana', 'Una deliciosa hamburguesa hawaiana con piña y jamón, Aloha!!.', 15000.00, 'assets/imagenes/platos/a56d0205f534d4107a1f2b34f4b9bdb8.jpeg', 1, 180),
(19, 2, 'Pollo Maicito', 'Pollo Maicito, una deliciosa combinación de sabores y texturas.', 15000.00, 'assets/imagenes/platos/b3accfc0759563c9fd79320a4fb5ae02.jpeg', 1, 190),
(20, 2, 'Quesuda', 'Una hamburguesa full queso que te hará agua la boca.', 15000.00, 'assets/imagenes/platos/8db317bb3111781f5d550ff98e51457b.jpeg', 1, 200),
(21, 2, 'Mexicana', 'Una deliciosa hamburguesa mexicana para comer a toda madre mi wey!!.', 16000.00, 'assets/imagenes/platos/a1c8e8eac2448d3c8a258bcee547d6b4.jpeg', 1, 210),
(22, 2, 'Mixta', 'Hamburguesa mixta, dos carnes, queso y bacon.', 16000.00, 'assets/imagenes/platos/b69fcbd7e26148ec1775add73ed07230.png', 1, 220),
(23, 2, 'Jumbo', 'Deliciosa hamburguesa Jumbo, con ingredientes seleccionados y el sabor de nuestra cocina.', 17000.00, 'assets/imagenes/platos/a9b5a2a8e75113aca3bb83cb1f18ea2e.jpeg', 1, 230),
(24, 2, 'ChuzoBurguer', 'ChuzoBurguer, una deliciosa hamburguesa con chorizo y queso fundido.', 17000.00, 'assets/imagenes/platos/1b1205d657ec2c7e57ecc09b6eb668ae.jpeg', 1, 240),
(25, 2, 'Paisa', 'Hamburguesa Paisa, para comer con los parceroosss!!.', 17000.00, 'assets/imagenes/platos/6cced24969806dc2dfa89147a0e7d174.jpeg', 1, 250),
(26, 2, 'Carnaval', 'Una deliciosa hamburguesa con carne de res, pollo y cerdo. Un carnaval de sabores!!', 17000.00, 'assets/imagenes/platos/e440204aa053bad0c3888241cd6a0171.jpeg', 1, 260),
(27, 5, 'Perro Sencillo', 'Perro Sencillo, el sabor de nuestra cocina.', 9000.00, 'assets/imagenes/platos/1121ac97045afb68c0ea84b68a485c15.jpeg', 1, 270),
(28, 5, 'Perro Especial', 'Perro Especial, una deliciosa combinación de sabores y texturas.', 12000.00, 'assets/imagenes/platos/4348f5cdf1deb1e27bfed8b147167e5f.jpeg', 1, 280),
(29, 5, 'Perro Doble Cañon', 'Perro Doble Cañon, una deliciosa combinación de carnes y salsas.', 14000.00, 'assets/imagenes/platos/9478e77ea34fb3d80f0c3f6c4332b1fc.jpeg', 1, 290),
(30, 5, 'Perro Hawaiano', 'Perro Hawaiano, una deliciosa combinación de sabores tropicales.', 15000.00, 'assets/imagenes/platos/fedebbacb2acad44b8d43541e99dea66.jpeg', 1, 300),
(31, 5, 'Perro con carne', 'Perro con carne, una deliciosa combinación de sabores y texturas.', 15000.00, 'assets/imagenes/platos/091de99892d718d1fab8092a5ad95d5f.jpeg', 1, 310),
(32, 5, 'Perro pollo y maicitos', 'Perro pollo y maicitos, una deliciosa combinación de carne y maíz dulce.', 15000.00, 'assets/imagenes/platos/b9d409f8cd82e60cb84b7048f17c7aaf.jpeg', 1, 320),
(33, 5, 'Perro mexicano', 'Perro mexicano, una deliciosa combinación de sabores y texturas mexicanas.', 15000.00, 'assets/imagenes/platos/c965de95ac058fa597af2e7613eacae9.jpeg', 1, 330),
(34, 5, 'Perro quesudo', 'Perro quesudo, full queso y full sabor', 15000.00, 'assets/imagenes/platos/35132f81f32f26dc077b36779e58d966.jpeg', 1, 340),
(35, 5, 'Perro pollo con champiñones', 'Perro Pollo con champiñones, una deliciosa combinación de sabores y texturas.', 15000.00, 'assets/imagenes/platos/e5c2e7de0aa0e439438366db6bc11f88.jpeg', 1, 350),
(36, 5, 'Chuzoperro', 'Chuzoperro, un sabor autentico y perfecto.', 17000.00, 'assets/imagenes/platos/5d2874ecc336c2c799dfd45a81b4f12e.jpeg', 1, 360),
(37, 5, 'Perro Jumbo de 40cm', 'Nuestro Gourmet y gigante perro jumbo de 40cm, con un sabor sabrosisimo en cada bocado, de principio a fin.', 26000.00, 'assets/imagenes/platos/1c475b91662c77946356d664ea1cbfed.jpeg', 1, 370),
(38, 5, 'Perra Especial', 'Una buena perra con bastante tocineta, salsa de la casa y más.', 11500.00, 'assets/imagenes/platos/8cd1d68a2dd30304600a8978f3ace30d.jpeg', 1, 380),
(39, 5, 'Perra Fufa', 'Perra con carne desmechada y ahogao, para probarlo 2 veces!!.', 11500.00, 'assets/imagenes/platos/3ab1c33ab42a17f9f9861231f7d3b59d.jpeg', 1, 390),
(40, 5, 'Perra pollo y maicitos', 'Perra con pollo desmechado y maicitos, un sabor autentico', 11500.00, 'assets/imagenes/platos/c81daaeafbfae9b434b8291cce5cb47e.jpeg', 1, 400),
(41, 5, 'Perra Quesuda', 'Perra Quesuda, full queso y full sabor', 14500.00, 'assets/imagenes/platos/9539181f27467d8134cecc0076846268.jpeg', 1, 410),
(42, 5, 'Perra pollo con champiñones', 'Perra pollo con champiñones, una deliciosa combinación de sabores y texturas.', 14500.00, 'assets/imagenes/platos/d31b6aabcbcc9b3ca84f6dead94be040.jpeg', 1, 420),
(43, 5, 'Perra grilla', 'Perra grilla, full sabor a la parrilla y el toque especial de la casa.', 15500.00, 'assets/imagenes/platos/886491b41a2757e7b855771eeacceac0.jpeg', 1, 430),
(44, 4, 'Sencilla', 'Salchipapa sencilla, papas fritas y salsas al gusto.', 9000.00, 'assets/imagenes/platos/4b9de1327a0f8eb14683f180407d37b4.jpeg', 1, 440),
(45, 4, 'Especial', 'Salchipapa especial, con ingredientes premium y salsas exclusivas.', 12000.00, 'assets/imagenes/platos/e82ff7e937e793f70733915e35543528.jpeg', 1, 450),
(46, 4, 'Desgranada', 'Salchipapa desgranada, con un toque especial.', 15000.00, 'assets/imagenes/platos/a99e38b866482f5601882fb80ff4b995.jpeg', 1, 460),
(47, 4, 'Con pollo', 'Salchipapa con pollo, una deliciosa combinación de sabores.', 16000.00, 'assets/imagenes/platos/8b9846c856e82f3eb7dff2b3708eea5b.jpeg', 1, 470),
(48, 4, 'Con carne', 'Salchipapa con carne, un sabor autentico y delicioso.', 16000.00, 'assets/imagenes/platos/c995dd6fb515b31fd4539785b769f8e3.jpeg', 1, 480),
(49, 4, 'Paisa', 'Salchipapa paisa, un sabor auténtico para un parche bacano!!', 19500.00, 'assets/imagenes/platos/5fcb8334d693d833790426512d0fb909.jpeg', 1, 490),
(50, 3, 'Combo Hamburguesas', 'Un combo de hamburguesas, cargado de sabor y acompañamientos!', 17000.00, 'assets/imagenes/platos/5947abf237804af7f55b7bbc89524dad.jpeg', 1, 500),
(51, 3, 'Combo Alitas: Combo 1', 'Un combo de alitas, con mucha salsa y sabor', 17000.00, 'assets/imagenes/platos/e8fd5985142d0d7ecc27bd7bbad133e7.jpeg', 1, 510),
(52, 3, 'Combo Alitas: Combo 2', 'Un combo de muchas alitas, papas y 2 gaseosas.', 31500.00, 'assets/imagenes/platos/dcd8b9b580aa7461744f31a5a6a0f7da.jpeg', 1, 520),
(53, 3, 'Combo Alitas: Combo 3', 'Un combo de aun más alitas, papas y 2 gaseosas.', 42000.00, 'assets/imagenes/platos/81a0928d7796e22e9523543e3d9ce127.jpeg', 1, 530),
(54, 8, 'Arepa Burguer', 'Una deliciosa arepa rellena de carne, queso, huevo, bacon y más', 13000.00, 'assets/imagenes/platos/8628c4e225bd6f3895cf142aaed91164.jpeg', 1, 540),
(55, 8, 'Burrito', 'Un burrito delicioso con carne, frijoles y salsa.', 13000.00, 'assets/imagenes/platos/21575c21de250673a2754661dcf4c984.jpeg', 1, 550),
(56, 8, 'Patacón', 'Un patacón crujiente con carne, queso y salsa.', 16000.00, 'assets/imagenes/platos/49add46301cf93fc404ae64ed9b70e63.jpeg', 1, 560),
(57, 8, 'Ceviche de Chicharrón', 'Un ceviche fresco de chicharrón, con limón y cebolla.', 21000.00, 'assets/imagenes/platos/5a858a25c3764ee0845167483846985f.jpeg', 1, 570),
(58, 6, 'Coca-Cola', 'Coca Cola 315 mL', 3000.00, 'assets/imagenes/platos/60b9b91511d9bbbfe0daa3882401a8bc.jpeg', 1, 580),
(59, 6, 'Coca-Cola Zero', 'Deliciosa gaseosa Coca-Cola Zero', 2000.00, 'assets/imagenes/platos/d4c333587e5b88db4dc281f0504e3b84.jpeg', 1, 590),
(60, 6, 'Agua', 'Botella de agua', 2000.00, 'assets/imagenes/platos/b3a2dfe040b4b7413c41b40da80b0f90.png', 1, 600),
(61, 6, 'Premio', 'Refrescante gaseosa Premio', 4000.00, 'assets/imagenes/platos/436620a6ecdc519bcd86ccdad37adcb9.png', 1, 610),
(62, 6, 'Quatro', 'Refrescante gaseosa Quatro', 4000.00, 'assets/imagenes/platos/3c3221e2baf45a586a670b1868e3dc35.png', 1, 620),
(63, 6, 'Sprite', 'Refrescante Sprite', 4000.00, 'assets/imagenes/platos/2949a14015794c5c2da36875c1ea59f2.png', 1, 630),
(64, 6, 'Jugos en Agua', 'Ricos jugos', 5000.00, 'assets/imagenes/platos/2985a0a94a109167a5e78774d1cdc44a.jpeg', 1, 640),
(65, 6, 'Jugo en leche', 'Ricos jugos en leche', 6500.00, 'assets/imagenes/platos/c21703d4f33be95910febfd4d1e16c73.jpeg', 1, 650),
(66, 6, 'Limonada natural', 'Refrescante limonada natural', 5000.00, 'assets/imagenes/platos/06f6920b6a63c9865326a41c7f57b747.png', 1, 660),
(67, 6, 'Limonada Hierbabuena', 'Refrescante limonada de Hierbabuena', 7000.00, 'assets/imagenes/platos/48292123f56cea2d50eaee09cb7e866d.jpeg', 1, 670),
(68, 6, 'Soda De Fresa', 'Deliciosa Soda de Fresa', 7000.00, 'assets/imagenes/platos/88dfbb8eedcd6fe2ef931d35538d148f.jpeg', 1, 680),
(69, 6, 'Soda De Cereza', 'Deliciosa Soda de Cereza', 7000.00, 'assets/imagenes/platos/fc91cd515419b72dfb24ab06d4247863.jpeg', 1, 690),
(70, 6, 'Soda De Mango', 'Deliciosa Soda de Mango', 7000.00, 'assets/imagenes/platos/23d929fc9496ce4be825490bbbae87d1.jpeg', 1, 700),
(71, 6, 'Soda De Maracuyá', 'Deliciosa Soda de Maracuyá', 7000.00, 'assets/imagenes/platos/410a8973b4acbfa253f10b09cbb938cf.jpeg', 1, 710),
(72, 6, 'Soda De Sandia', 'Deliciosa Soda de Sandia', 7000.00, 'assets/imagenes/platos/af3bf009219ef6bb217d854b59dc12bb.jpeg', 1, 720),
(73, 7, 'Copa de Vino', 'Copa de vino de excelente Calidad', 10000.00, 'assets/imagenes/platos/cbffad2729bfb3323086ae3f34587920.jpeg', 1, 730),
(74, 7, 'Botella de Vino', 'Botella de Vino de excelente calidad', 55000.00, 'assets/imagenes/platos/46d50bb3bb9c03fcd2fbc273dd9f3d85.jpeg', 1, 740),
(75, 7, 'Ron 8 años', 'Ron viejo de caldas añejado 8 años', 65000.00, 'assets/imagenes/platos/7d3063f9b9b9f6495897ac9b8fae9b7f.jpeg', 1, 750),
(76, 7, 'Guaro Tapa roja', 'Excelente Aguardiente Guaro Tapa Roja', 4800.00, 'assets/imagenes/platos/3e3de8542d61f36a4842795c6a751d08.png', 1, 760),
(77, 7, 'Buchanans', 'Excelente Buchanans', 5000.00, 'assets/imagenes/platos/62ba86078ee1a43f63a9e316d48664a9.png', 1, 770),
(78, 7, 'Old Parr', 'Refrescante whisky Old Parr', 5000.00, 'assets/imagenes/platos/6dc1bf2aee875d6e20f7501ad0c9d792.png', 1, 780),
(79, 7, 'Tequila 1800', 'Esencioso Tequila 1800', 7000.00, 'assets/imagenes/platos/bd7467916b8b61e67354f611a66971e3.jpeg', 1, 790),
(80, 7, 'Corona', 'Refrescante Cerveza Corona', 6000.00, 'assets/imagenes/platos/00a9ee27d0b000e234cfff11620fa3d2.jpeg', 1, 800),
(81, 7, '3 Cordilleras', 'Refrescante Cerveza 3 Cordilleras', 3500.00, 'assets/imagenes/platos/3ece8a89eb5b080b48ed8287a2d4e34c.png', 1, 810),
(82, 7, 'Heineken', 'Refrescante Cerveza Heineken', 4500.00, 'assets/imagenes/platos/1c7683f3d7a89ec079403f87ede10026.jpeg', 1, 820),
(83, 7, 'Club Colombia', 'Refrescante cerveza Club Colombia', 3500.00, 'assets/imagenes/platos/c9009175ec889aea8bae7ed55d34d35c.png', 1, 830),
(84, 7, 'Aguila', 'Cerveza Aguila', 3800.00, 'assets/imagenes/platos/a322b34acd92a02ffe040150529789fc.png', 1, 840),
(85, 7, 'Aguila Light', 'Aguila Light', 4000.00, 'assets/imagenes/platos/6c78a791f76d47aeb179d29bc976366d.png', 1, 850),
(86, 7, 'Pilsen', 'Refrescante cerveza Pilsen', 3500.00, 'assets/imagenes/platos/1e291fa7aa86629e8e89eb4470d68d9b.png', 1, 860);

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
('whatsapp', '573116667082', 'WhatsApp del restaurante, con 57 y sin signos');

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
