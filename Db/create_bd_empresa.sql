SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE `almacen` (
  `ide_alm` int(11) NOT NULL AUTO_INCREMENT,
  `nom_alm` varchar(50) DEFAULT NULL,
  `ubi_alm` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ide_alm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `articulos` (
  `ide_art` int(11) NOT NULL AUTO_INCREMENT,
  `nom_art` varchar(30) DEFAULT NULL,
  `tip_art` enum('terminado','materia') DEFAULT NULL,
  `imp_art` decimal(5,2) DEFAULT NULL,
  `sto_art` int(5) DEFAULT NULL,
  PRIMARY KEY (`ide_art`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `clientes` (
  `dni_cli` varchar(9) NOT NULL,
  `nom_cli` varchar(40) DEFAULT NULL,
  `dir_cli` varchar(40) DEFAULT NULL,
  `tlf_cli` varchar(12) DEFAULT NULL,
  `ema_cli` varchar(40) DEFAULT NULL,
  `dto_cli` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`dni_cli`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `detalle_compra` (
  `ide_dco` int(11) NOT NULL AUTO_INCREMENT,
  `can_dco` int(4) DEFAULT NULL,
  `imp_dco` decimal(7,2) DEFAULT NULL,
  `ide_art` int(11) DEFAULT NULL,
  `num_com` int(11) DEFAULT NULL,
  PRIMARY KEY (`ide_dco`),
  KEY `detalle_compra_ibfk_1` (`ide_art`),
  KEY `detalle_compra_ibfk_2` (`num_com`),
  CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`ide_art`) REFERENCES `articulos` (`ide_art`) ON DELETE CASCADE,
  CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`num_com`) REFERENCES `factura_compra` (`num_com`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `detalle_escandallo` (
  `ide_des` int(11) NOT NULL AUTO_INCREMENT,
  `uds_des` int(3) DEFAULT NULL,
  `ide_art` int(11) DEFAULT NULL,
  `ide_esc` int(11) DEFAULT NULL,
  PRIMARY KEY (`ide_des`),
  KEY `ide_art` (`ide_art`),
  KEY `ide_esc` (`ide_esc`),
  CONSTRAINT `detalle_escandallo_ibfk_1` FOREIGN KEY (`ide_art`) REFERENCES `articulos` (`ide_art`),
  CONSTRAINT `detalle_escandallo_ibfk_2` FOREIGN KEY (`ide_esc`) REFERENCES `escandallo` (`ide_esc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `detalle_inventario` (
  `ide_din` int(11) NOT NULL AUTO_INCREMENT,
  `can_din` int(4) DEFAULT NULL,
  `ide_art` int(11) DEFAULT NULL,
  `cod_inv` int(11) DEFAULT NULL,
  PRIMARY KEY (`ide_din`),
  KEY `ide_art` (`ide_art`),
  KEY `cod_inv` (`cod_inv`),
  CONSTRAINT `detalle_inventario_ibfk_1` FOREIGN KEY (`ide_art`) REFERENCES `articulos` (`ide_art`),
  CONSTRAINT `detalle_inventario_ibfk_2` FOREIGN KEY (`cod_inv`) REFERENCES `inventario` (`cod_inv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `detalle_venta` (
  `ide_dve` int(11) NOT NULL AUTO_INCREMENT,
  `can_dve` int(4) DEFAULT NULL,
  `imp_dve` decimal(7,2) DEFAULT NULL,
  `ide_art` int(11) DEFAULT NULL,
  `num_ven` int(11) DEFAULT NULL,
  PRIMARY KEY (`ide_dve`),
  KEY `detalle_venta_ibfk_1` (`ide_art`),
  KEY `detalle_venta_ibfk_2` (`num_ven`),
  CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`ide_art`) REFERENCES `articulos` (`ide_art`) ON DELETE CASCADE,
  CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`num_ven`) REFERENCES `factura_venta` (`num_ven`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `empleados` (
  `dni_emp` varchar(9) NOT NULL,
  `nom_emp` varchar(40) DEFAULT NULL,
  `con_emp` varchar(100) DEFAULT NULL,
  `dir_emp` varchar(40) DEFAULT NULL,
  `tlf_emp` varchar(12) DEFAULT NULL,
  `ema_emp` varchar(40) DEFAULT NULL,
  `pue_emp` enum('compras','direccion','contabilidad','produccion','diseño','transporte') DEFAULT NULL,
  PRIMARY KEY (`dni_emp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `escandallo` (
  `ide_esc` int(11) NOT NULL AUTO_INCREMENT,
  `nom_esc` varchar(30) DEFAULT NULL,
  `tie_esc` decimal(4,2) DEFAULT NULL,
  `cos_esc` decimal(5,2) DEFAULT NULL,
  `tip_esc` enum('comun','personalizado') DEFAULT NULL,
  `ide_art` int(11) DEFAULT NULL,
  PRIMARY KEY (`ide_esc`),
  KEY `fk_escandallo_articulo` (`ide_art`),
  CONSTRAINT `fk_escandallo_articulo` FOREIGN KEY (`ide_art`) REFERENCES `articulos` (`ide_art`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `factura_compra` (
  `num_com` int(11) NOT NULL AUTO_INCREMENT,
  `fac_com` varchar(20) DEFAULT NULL,
  `fec_com` date DEFAULT NULL,
  `tot_com` decimal(7,2) DEFAULT NULL,
  `dni_emp` varchar(9) DEFAULT NULL,
  `nif_pro` varchar(9) DEFAULT NULL,
  `ide_alm` int(11) DEFAULT NULL,
  PRIMARY KEY (`num_com`),
  KEY `factura_compra_ibfk_1` (`dni_emp`),
  KEY `factura_compra_ibfk_2` (`nif_pro`),
  KEY `factura_compra_ibfk_3` (`ide_alm`),
  CONSTRAINT `factura_compra_ibfk_1` FOREIGN KEY (`dni_emp`) REFERENCES `empleados` (`dni_emp`) ON DELETE CASCADE,
  CONSTRAINT `factura_compra_ibfk_2` FOREIGN KEY (`nif_pro`) REFERENCES `proveedores` (`nif_pro`) ON DELETE CASCADE,
  CONSTRAINT `factura_compra_ibfk_3` FOREIGN KEY (`ide_alm`) REFERENCES `almacen` (`ide_alm`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `factura_venta` (
  `num_ven` int(11) NOT NULL AUTO_INCREMENT,
  `fec_ven` date DEFAULT NULL,
  `tot_ven` decimal(7,2) DEFAULT NULL,
  `dni_emp` varchar(9) DEFAULT NULL,
  `dni_cli` varchar(9) DEFAULT NULL,
  `ide_alm` int(11) DEFAULT NULL,
  PRIMARY KEY (`num_ven`),
  KEY `factura_venta_ibfk_1` (`dni_emp`),
  KEY `factura_venta_ibfk_2` (`dni_cli`),
  KEY `factura_venta_ibfk_3` (`ide_alm`),
  CONSTRAINT `factura_venta_ibfk_1` FOREIGN KEY (`dni_emp`) REFERENCES `empleados` (`dni_emp`) ON DELETE CASCADE,
  CONSTRAINT `factura_venta_ibfk_2` FOREIGN KEY (`dni_cli`) REFERENCES `clientes` (`dni_cli`) ON DELETE CASCADE,
  CONSTRAINT `factura_venta_ibfk_3` FOREIGN KEY (`ide_alm`) REFERENCES `almacen` (`ide_alm`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `inventario` (
  `cod_inv` int(11) NOT NULL AUTO_INCREMENT,
  `fec_inv` date DEFAULT NULL,
  `dni_emp` varchar(9) DEFAULT NULL,
  `ide_art` int(11) DEFAULT NULL,
  `ide_alm` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod_inv`),
  KEY `dni_emp` (`dni_emp`),
  KEY `ide_art` (`ide_art`),
  KEY `ide_alm` (`ide_alm`),
  CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`dni_emp`) REFERENCES `empleados` (`dni_emp`),
  CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`ide_art`) REFERENCES `articulos` (`ide_art`),
  CONSTRAINT `inventario_ibfk_3` FOREIGN KEY (`ide_alm`) REFERENCES `almacen` (`ide_alm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `produccion` (
  `ide_pdc` int(11) NOT NULL AUTO_INCREMENT,
  `fec_pdc` date DEFAULT NULL,
  `can_pdc` int(3) DEFAULT NULL,
  `ide_alm` int(11) DEFAULT NULL,
  `ide_esc` int(11) DEFAULT NULL,
  `dni_emp` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`ide_pdc`),
  KEY `ide_alm` (`ide_alm`),
  KEY `ide_esc` (`ide_esc`),
  KEY `dni_emp` (`dni_emp`),
  CONSTRAINT `produccion_ibfk_1` FOREIGN KEY (`ide_alm`) REFERENCES `almacen` (`ide_alm`),
  CONSTRAINT `produccion_ibfk_2` FOREIGN KEY (`ide_esc`) REFERENCES `escandallo` (`ide_esc`),
  CONSTRAINT `produccion_ibfk_3` FOREIGN KEY (`dni_emp`) REFERENCES `empleados` (`dni_emp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `proveedores` (
  `nif_pro` varchar(9) NOT NULL,
  `nom_pro` varchar(40) DEFAULT NULL,
  `dir_pro` varchar(40) DEFAULT NULL,
  `tlf_pro` varchar(12) DEFAULT NULL,
  `ema_pro` varchar(40) DEFAULT NULL,
  `dto_pro` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`nif_pro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;