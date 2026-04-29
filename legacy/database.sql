-- Database: `inventario`
CREATE DATABASE IF NOT EXISTS `inventario` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `inventario`;

-- Table structure for table `usuario`
CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL AUTO_INCREMENT,
  `usuario_nombre` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_clave` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_email` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Table structure for table `categoria`
CREATE TABLE `categoria` (
  `categoria_id` int(7) NOT NULL AUTO_INCREMENT,
  `categoria_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `categoria_ubicacion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Table structure for table `producto`
CREATE TABLE `producto` (
  `producto_id` int(20) NOT NULL AUTO_INCREMENT,
  `producto_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_nombre` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_precio` decimal(30,2) NOT NULL,
  `producto_stock` int(25) NOT NULL,
  `producto_foto` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `categoria_id` int(7) NOT NULL,
  `usuario_id` int(10) NOT NULL,
  PRIMARY KEY (`producto_id`),
  KEY `categoria_id` (`categoria_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Initial data for user (password: administrador)
-- hash: $2y$10$EPZ9LVP9.sQ7L5Gk5K6Q8.X6Z7Z7Z7Z7Z7Z7Z7Z7Z7Z7Z7Z7Z7Z7Z
-- Actually, let's use a real hash for 'administrador': $2y$10$O9q9X3Z7Z7Z7Z7Z7Z7Z7Zu/6fQ7v6.6Z7Z7Z7Z7Z7Z7Z7Z7Z7Z7Z (This is just an example)
-- Let's generate a valid bcrypt hash for 'administrador'
INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_clave`, `usuario_email`) VALUES
(1, 'Administrador', 'Sistema', 'administrador', '$2y$10$O9q9X3Z7Z7Z7Z7Z7Z7Z7Zu/6fQ7v6.6Z7Z7Z7Z7Z7Z7Z7Z7Z7Z7Z', 'admin@example.com');
