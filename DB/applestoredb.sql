-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2019 a las 19:52:21
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `applestoredb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `car_id` int(11) NOT NULL,
  `car_subtotal` float NOT NULL,
  `USUARIO_usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `cat_id` int(11) NOT NULL,
  `cat_nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`cat_id`, `cat_nombre`) VALUES
(1, 'mac'),
(2, 'ipad'),
(3, 'iphone'),
(4, 'watch'),
(5, 'tv'),
(6, 'accesorios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `dir_id` int(11) NOT NULL,
  `dir_nombre` varchar(100) NOT NULL,
  `dir_calle_principal` varchar(100) NOT NULL,
  `dir_calle_secundaria` varchar(100) DEFAULT NULL,
  `dir_ciudad` varchar(45) NOT NULL,
  `dir_provincia` varchar(45) NOT NULL,
  `dir_codigo_postal` varchar(45) NOT NULL,
  `USUARIO_usu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_sucursal`
--

CREATE TABLE `direccion_sucursal` (
  `dir_suc_id` int(11) NOT NULL,
  `SUCURSAL_suc_id` int(11) NOT NULL,
  `DIRECCION_dir_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_cabecera`
--

CREATE TABLE `factura_cabecera` (
  `fac_cab_id` int(11) NOT NULL,
  `fac_cab_metodo_pago` varchar(10) NOT NULL,
  `fac_cab_subtotal` float NOT NULL,
  `fac_cab_iva` tinyint(4) DEFAULT NULL,
  `fac_cab_total` float NOT NULL,
  `TARJETA_tar_id` int(11) DEFAULT NULL,
  `USUARIO_usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_detalle`
--

CREATE TABLE `factura_detalle` (
  `fac_det_id` int(11) NOT NULL,
  `fac_det_cantidad` tinyint(4) NOT NULL,
  `fac_det_subtotal` float NOT NULL,
  `PRODUCTO_pro_id` int(11) NOT NULL,
  `CARRITO_car_id` int(11) DEFAULT NULL,
  `FACTURA_CABECERA_fac_cab_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoja_contacto`
--

CREATE TABLE `hoja_contacto` (
  `con_id` int(11) NOT NULL,
  `con_asunto` varchar(100) NOT NULL,
  `con_contenido` text NOT NULL,
  `con_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `USUARIO_usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `img_id` int(11) NOT NULL,
  `img_nombre` varchar(200) NOT NULL,
  `USUARIO_usu_id` int(11) DEFAULT NULL,
  `PRODUCTO_pro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`img_id`, `img_nombre`, `USUARIO_usu_id`, `PRODUCTO_pro_id`) VALUES
(2, 'perfil.jpg', 1, NULL),
(3, 'Screenshot_5.png', 4, NULL),
(4, 'xs.jpg', NULL, 1),
(5, 'xsmax.jpg', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `pro_id` int(11) NOT NULL,
  `pro_nombre` varchar(45) NOT NULL,
  `pro_descripcion` varchar(100) NOT NULL,
  `pro_precio` float NOT NULL,
  `pro_descuento` float DEFAULT '0',
  `pro_estado` tinyint(1) NOT NULL DEFAULT '1',
  `pro_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pro_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `CATEGORIA_cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`pro_id`, `pro_nombre`, `pro_descripcion`, `pro_precio`, `pro_descuento`, `pro_estado`, `pro_fecha_creacion`, `pro_fecha_modificacion`, `CATEGORIA_cat_id`) VALUES
(1, 'iPhone XS MAX', 'El mejor celular del mundo mundial', 1599, 10, 1, '2019-05-28 01:32:42', NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_sucursal`
--

CREATE TABLE `producto_sucursal` (
  `pro_suc_id` int(11) NOT NULL,
  `pro_suc_stock` int(11) NOT NULL,
  `PRODUCTO_pro_id` int(11) DEFAULT NULL,
  `SUCURSAL_suc_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto_sucursal`
--

INSERT INTO `producto_sucursal` (`pro_suc_id`, `pro_suc_stock`, `PRODUCTO_pro_id`, `SUCURSAL_suc_id`) VALUES
(4, 10, 1, 1),
(5, 20, 1, 3),
(6, 5, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rating`
--

CREATE TABLE `rating` (
  `rat_id` int(11) NOT NULL,
  `rat_calificacion` float NOT NULL,
  `rat_descripcion` text,
  `SUCURSAL_suc_id` int(11) DEFAULT NULL,
  `USUARIO_usu_id` int(11) NOT NULL,
  `PRODUCTO_pro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rating`
--

INSERT INTO `rating` (`rat_id`, `rat_calificacion`, `rat_descripcion`, `SUCURSAL_suc_id`, `USUARIO_usu_id`, `PRODUCTO_pro_id`) VALUES
(1, 4, 'Calificacion', NULL, 1, 1),
(2, 3, 'Calificacion', NULL, 3, 1),
(3, 5, 'Calificacion', NULL, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `suc_id` int(11) NOT NULL,
  `suc_nombre` varchar(45) NOT NULL,
  `suc_telefono` varchar(14) NOT NULL,
  `suc_celular` varchar(14) DEFAULT NULL,
  `suc_url` varchar(45) DEFAULT NULL,
  `suc_correo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`suc_id`, `suc_nombre`, `suc_telefono`, `suc_celular`, `suc_url`, `suc_correo`) VALUES
(1, 'guayaquil', '0725425', '0989420495', 'storeguayaquil.php', 'applestoreguayaquil@apple.com.ec'),
(2, 'quito', '0723125', '09825632152', 'storequito.php', 'applestorequito@apple.com.ec'),
(3, 'cuenca', '0732563', '0988653256', 'storecuenca.php', 'applestorecuenca@apple.com.ec');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta`
--

CREATE TABLE `tarjeta` (
  `tar_id` int(11) NOT NULL,
  `tar_tipo` varchar(15) NOT NULL,
  `tar_nombre` varchar(50) NOT NULL,
  `tar_numero` varchar(20) NOT NULL,
  `tar_fecha_exp` varchar(5) NOT NULL,
  `tar_codigo_seguridad` varchar(4) NOT NULL,
  `USUARIO_usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_cedula` varchar(45) DEFAULT NULL,
  `usu_nombres` varchar(50) NOT NULL,
  `usu_apellidos` varchar(50) NOT NULL,
  `usu_telefono` varchar(20) NOT NULL,
  `usu_fecha_nacimiento` date NOT NULL,
  `usu_correo` varchar(45) NOT NULL,
  `usu_password` varchar(255) NOT NULL,
  `usu_eliminado` tinyint(4) NOT NULL DEFAULT '0',
  `usu_rol` varchar(45) NOT NULL,
  `usu_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usu_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `SUCURSAL_suc_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_cedula`, `usu_nombres`, `usu_apellidos`, `usu_telefono`, `usu_fecha_nacimiento`, `usu_correo`, `usu_password`, `usu_eliminado`, `usu_rol`, `usu_fecha_creacion`, `usu_fecha_modificacion`, `SUCURSAL_suc_id`) VALUES
(1, '', 'claudio', 'maldonado', '', '0000-00-00', 'claudio@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', 0, '', '2019-05-28 01:05:02', NULL, NULL),
(3, NULL, 'christian', 'mocha', '', '0000-00-00', 'christian@mail.com', '202cb962ac59075b964b07152d234b70', 0, '', '2019-05-28 01:08:40', NULL, NULL),
(4, NULL, 'maria', 'cajamarca', '', '0000-00-00', 'maria@mail.com', '202cb962ac59075b964b07152d234b70', 0, '', '2019-05-28 01:14:21', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `fk_CARRITO_USUARIO1_idx` (`USUARIO_usu_id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`dir_id`),
  ADD KEY `fk_DIRECCION_USUARIO1_idx` (`USUARIO_usu_id`);

--
-- Indices de la tabla `direccion_sucursal`
--
ALTER TABLE `direccion_sucursal`
  ADD PRIMARY KEY (`dir_suc_id`),
  ADD KEY `fk_DIRECCION_SUCURSAL_SUCURSAL1_idx` (`SUCURSAL_suc_id`),
  ADD KEY `fk_DIRECCION_SUCURSAL_DIRECCION1_idx` (`DIRECCION_dir_id`);

--
-- Indices de la tabla `factura_cabecera`
--
ALTER TABLE `factura_cabecera`
  ADD PRIMARY KEY (`fac_cab_id`),
  ADD KEY `fk_FACTURA_CABECERA_TARJETA1_idx` (`TARJETA_tar_id`),
  ADD KEY `fk_FACTURA_CABECERA_USUARIO1_idx` (`USUARIO_usu_id`);

--
-- Indices de la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  ADD PRIMARY KEY (`fac_det_id`),
  ADD KEY `fk_FACTURA_DETALLE_PRODUCTO1_idx` (`PRODUCTO_pro_id`),
  ADD KEY `fk_FACTURA_DETALLE_CARRITO1_idx` (`CARRITO_car_id`),
  ADD KEY `fk_FACTURA_DETALLE_FACTURA_CABECERA1_idx` (`FACTURA_CABECERA_fac_cab_id`);

--
-- Indices de la tabla `hoja_contacto`
--
ALTER TABLE `hoja_contacto`
  ADD PRIMARY KEY (`con_id`),
  ADD KEY `fk_HOJA_CONTACTO_USUARIO1_idx` (`USUARIO_usu_id`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `fk_IMAGEN_USUARIO1_idx` (`USUARIO_usu_id`),
  ADD KEY `fk_IMAGEN_PRODUCTO1_idx` (`PRODUCTO_pro_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `fk_PRODUCTO_CATEGORIA1_idx` (`CATEGORIA_cat_id`);

--
-- Indices de la tabla `producto_sucursal`
--
ALTER TABLE `producto_sucursal`
  ADD PRIMARY KEY (`pro_suc_id`),
  ADD KEY `fk_PRODUCTO_SUCURSAL_PRODUCTO1_idx` (`PRODUCTO_pro_id`),
  ADD KEY `fk_PRODUCTO_SUCURSAL_SUCURSAL1_idx` (`SUCURSAL_suc_id`);

--
-- Indices de la tabla `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rat_id`),
  ADD KEY `fk_RATING_SUCURSAL1_idx` (`SUCURSAL_suc_id`),
  ADD KEY `fk_RATING_USUARIO1_idx` (`USUARIO_usu_id`),
  ADD KEY `fk_RATING_PRODUCTO1_idx` (`PRODUCTO_pro_id`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`suc_id`);

--
-- Indices de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD PRIMARY KEY (`tar_id`),
  ADD KEY `fk_TARJETA_USUARIO1_idx` (`USUARIO_usu_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD UNIQUE KEY `usu_correo_UNIQUE` (`usu_correo`),
  ADD UNIQUE KEY `usu_cedula_UNIQUE` (`usu_cedula`),
  ADD KEY `fk_USUARIO_SUCURSAL1_idx` (`SUCURSAL_suc_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `dir_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccion_sucursal`
--
ALTER TABLE `direccion_sucursal`
  MODIFY `dir_suc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura_cabecera`
--
ALTER TABLE `factura_cabecera`
  MODIFY `fac_cab_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  MODIFY `fac_det_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hoja_contacto`
--
ALTER TABLE `hoja_contacto`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `producto_sucursal`
--
ALTER TABLE `producto_sucursal`
  MODIFY `pro_suc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rating`
--
ALTER TABLE `rating`
  MODIFY `rat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `suc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  MODIFY `tar_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_CARRITO_USUARIO1` FOREIGN KEY (`USUARIO_usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `fk_DIRECCION_USUARIO1` FOREIGN KEY (`USUARIO_usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `direccion_sucursal`
--
ALTER TABLE `direccion_sucursal`
  ADD CONSTRAINT `fk_DIRECCION_SUCURSAL_DIRECCION1` FOREIGN KEY (`DIRECCION_dir_id`) REFERENCES `direccion` (`dir_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DIRECCION_SUCURSAL_SUCURSAL1` FOREIGN KEY (`SUCURSAL_suc_id`) REFERENCES `sucursal` (`suc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura_cabecera`
--
ALTER TABLE `factura_cabecera`
  ADD CONSTRAINT `fk_FACTURA_CABECERA_TARJETA1` FOREIGN KEY (`TARJETA_tar_id`) REFERENCES `tarjeta` (`tar_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FACTURA_CABECERA_USUARIO1` FOREIGN KEY (`USUARIO_usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  ADD CONSTRAINT `fk_FACTURA_DETALLE_CARRITO1` FOREIGN KEY (`CARRITO_car_id`) REFERENCES `carrito` (`car_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FACTURA_DETALLE_FACTURA_CABECERA1` FOREIGN KEY (`FACTURA_CABECERA_fac_cab_id`) REFERENCES `factura_cabecera` (`fac_cab_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FACTURA_DETALLE_PRODUCTO1` FOREIGN KEY (`PRODUCTO_pro_id`) REFERENCES `producto` (`pro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hoja_contacto`
--
ALTER TABLE `hoja_contacto`
  ADD CONSTRAINT `fk_HOJA_CONTACTO_USUARIO1` FOREIGN KEY (`USUARIO_usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `fk_IMAGEN_PRODUCTO1` FOREIGN KEY (`PRODUCTO_pro_id`) REFERENCES `producto` (`pro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_IMAGEN_USUARIO1` FOREIGN KEY (`USUARIO_usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_PRODUCTO_CATEGORIA1` FOREIGN KEY (`CATEGORIA_cat_id`) REFERENCES `categoria` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto_sucursal`
--
ALTER TABLE `producto_sucursal`
  ADD CONSTRAINT `fk_PRODUCTO_SUCURSAL_PRODUCTO1` FOREIGN KEY (`PRODUCTO_pro_id`) REFERENCES `producto` (`pro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PRODUCTO_SUCURSAL_SUCURSAL1` FOREIGN KEY (`SUCURSAL_suc_id`) REFERENCES `sucursal` (`suc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_RATING_PRODUCTO1` FOREIGN KEY (`PRODUCTO_pro_id`) REFERENCES `producto` (`pro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_RATING_SUCURSAL1` FOREIGN KEY (`SUCURSAL_suc_id`) REFERENCES `sucursal` (`suc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_RATING_USUARIO1` FOREIGN KEY (`USUARIO_usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD CONSTRAINT `fk_TARJETA_USUARIO1` FOREIGN KEY (`USUARIO_usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_USUARIO_SUCURSAL1` FOREIGN KEY (`SUCURSAL_suc_id`) REFERENCES `sucursal` (`suc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
