SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


INSERT INTO `almacen` (`ide_alm`, `nom_alm`, `ubi_alm`) VALUES
(1, 'Mostoles5', 'Cl Mariblanca 14 28937'),
(2, 'Fuenlabrada', 'Plaza de la Coruña 28942'),
(3, 'dada', 'dada'),
(4, '414', '4141'),
(6, '3213132312', '31231231'),
(8, '1111', '5325235');

INSERT INTO `articulos` (`ide_art`, `nom_art`, `tip_art`, `imp_art`, `sto_art`) VALUES
(1, 'Zapato Oxford', 'terminado', 134.99, 100),
(2, 'Zapato Derby', 'terminado', 126.00, 200),
(3, 'Bota Chelsea', 'terminado', 181.13, -6),
(4, 'Bota Desert', 'terminado', 143.99, 8),
(5, 'Sandalia Piel', 'terminado', 98.25, -32284),
(6, 'Cuero Premium', 'materia', 45.00, 121),
(7, 'Cuerdas enceradas', 'materia', 5.50, 266),
(8, 'Suela de goma', 'materia', 12.75, 164),
(9, 'Plantillas confort', 'materia', 8.99, 205),
(10, 'Hebillas metálicas', 'materia', 3.25, 300),
(11, 'Pegamento resistente', 'materia', 6.99, 124),
(12, 'Tintes para cuero', 'materia', 7.50, 185),
(13, 'Cordones de algodón', 'materia', 4.99, 624),
(14, 'Zapato Monk Strap', 'terminado', 149.25, 16),
(15, 'Zapato Loafer', 'terminado', 113.99, 24),
(24, '3213', 'terminado', 999.99, 33),
(25, 'PRUEBA', 'materia', 5.00, 17),
(26, 'PRUEBA5555', 'materia', 5.00, 3),
(27, 'PRUEBA5555TERMINADO', 'terminado', 5.00, 17),
(28, 'NUEVAPRUEBA2', 'materia', 1.00, 70);

INSERT INTO `clientes` (`dni_cli`, `nom_cli`, `dir_cli`, `tlf_cli`, `ema_cli`, `dto_cli`) VALUES
('1', '1', '1', '1', '33@333', 1.00),
('3554881A', 'Pilar Nuñez Suarez', 'Cl Angelillo 13 2B 28018', '914334558', 'pilarnunez@gmail.com', 0.00),
('6546888R', 'Jose Sanchez Gil', 'Rda del Sur 4 6C 28041', '687245123', 'josesanchez@gmail.com', 0.00),
('7158846L', 'Pablo Pino Garcia', 'Cl Pozo 18 28300', '689265741', 'pablopino@gmail.es', 0.00),
('8646548F', 'Zapatos y mas S.A.', 'Cl Pez 12 28005', '687245123', 'zapatosymas@hotmail.es', 15.00);

INSERT INTO `detalle_compra` (`ide_dco`, `can_dco`, `imp_dco`, `ide_art`, `num_com`) VALUES
(19, 1, 7.50, 12, 22);

INSERT INTO `detalle_escandallo` (`ide_des`, `uds_des`, `ide_art`, `ide_esc`) VALUES
(1, 5, 1, 1),
(2, 3, 2, 1),
(3, 4, 3, 1),
(4, 2, 4, 1),
(5, 6, 5, 2),
(6, 2, 6, 2),
(7, 4, 7, 2),
(8, 3, 8, 2),
(9, 5, 9, 3),
(10, 2, 10, 3),
(11, 3, 11, 3),
(12, 4, 12, 3),
(13, 1, 13, 3),
(14, 2, 14, 3),
(15, 3, 15, 3),
(16, 1, 25, 6),
(17, 1, 26, 8),
(18, 5, 28, 8),
(19, 1, 11, 10),
(20, 1, 12, 11);

INSERT INTO `detalle_inventario` (`ide_din`, `can_din`, `ide_art`, `cod_inv`) VALUES
(1, 1, 25, 1),
(2, 1, 15, 1),
(3, 1, 15, 1),
(4, 1, 15, 1),
(5, 1, 24, 1),
(6, 1, 15, 10),
(7, 1, 26, 11),
(8, 1, 25, 12),
(9, 1, 26, 13),
(10, 1, 25, 14);

INSERT INTO `detalle_venta` (`ide_dve`, `can_dve`, `imp_dve`, `ide_art`, `num_ven`) VALUES
(10, 2, 143.99, 4, 5),
(11, 2, 149.25, 14, 5),
(12, 1, 5.00, 27, 6);

INSERT INTO `empleados` (`dni_emp`, `nom_emp`, `con_emp`, `dir_emp`, `tlf_emp`, `ema_emp`, `pue_emp`) VALUES
('0155546F1', '3', '1111', 'Cl Angelillo 13 2B 28018', '914334558', 'pilarnunez@gmail.com', 'compras'),
('0155546F2', '3', '0', 'Cl Angelillo 13 2B 28018', 'JAVIER JAVIE', 'pilarnunez@gmail.com', 'contabilidad'),
('01815724E', 'José Autor Lopez', '1', 'Cl Lirio 4 6B 28001', '645198756', 'joseautor@autor.es', 'direccion'),
('02158744A', 'Maria Autor Suarez', '7', 'Cl Feria 12 28701', '687245985', 'mariaautor@autor.es', 'produccion'),
('03181526F', 'Alvaro Limon Sanz', '5', 'Cl Siete 16 2b 28018', '752895455', 'alimon@autor.es', 'produccion'),
('05716618B', 'Manuel Carvajal Perez', '8', 'Rd del Sur 7 1E 28036', '618256477', 'mcarvajal@autor.es', 'transporte'),
('1111', '111133', '$2y$10$lTlYBYmpVC.dlH4Hv81fAePlw4QhJZpNBuldcqQxT51tWzt2a1Zu2', '11111', '1111', '111111@1111', 'compras'),
('222', '0155546F1111', '$2y$10$wCDezKb.8kcHiRK2EYRxYekZhPzSuu9me6zpsWcFiTCK6BW4MHgVG', '1', '0155546F1111', '33@333', 'direccion'),
('315555', 'Rafael', '$2y$10$flQkYJOC9qe368CH4kXeWOJSZgx.CaA3l4MmQ9gaTBieGScqLjgVa', 'Cl Angelillo 13 2B 28018', '1312313', 'pilarnunez@gmail.com', 'direccion'),
('444', '444', '$2y$10$2RZ6YlUbx31lnWrCIseK4u30ypdqTJp54E9r3B7AocR6HBnRA5zU2', '1', '4444', 'adios@adios', 'diseño'),
('51458795S', 'Laura Autor Suarez', '2', 'Cl Paz 12 11A 28931', '665952124', 'lauraautor@autor.es', 'contabilidad'),
('52456789V', 'Javier Sanchez Pera', '3', 'Cl Lima 5 28043', '696325854', 'jsanchez@autor.es', 'produccion'),
('545555555', '77777777777', '1111', '77777777777', '77777777777', '2@2', 'compras'),
('54958623J', 'Fernando Autor Suarez', '4', 'Avd Rosas 4 28100', '612478951', 'fernandoautor@autor.es', 'compras'),
('5555', 'JAVIER RAMON', '$2y$10$OJNBgWQOzxO2BnfGgzO28.ljVc23nJ8zqKHqdh7cZclU7BhY3/W7C', '5555', '5555', '55555111@131', 'direccion'),
('55579226L', 'Juan Autor Martinez', '9', 'Cl Hierro 33 28041', '620914513', 'juanautor@autor.es', 'produccion'),
('57859456L', 'Eva Autor Nuñez', '6', 'Cl Sirio 13A 28038', '645897789', 'evaautor@autor.es', 'diseño'),
('7777', 'Rafael', '$2y$10$iIJfYeYthI7n6hMXb2IJ1eIlnSnj802v2yqLA9oT.w2Ci/SHSoKRW', 'Cl Angelillo 13 2B 28018', '1312313', 'pilarnunez@gmail.com', 'contabilidad'),
('888888888', '77777777777', '1111', '77777777777', '77777777777', '2@2', 'compras'),
('987654321', 'PATATA', '0', '1', 'PATATA', 'MICARRO@1', 'compras'),
('ALEJANDRO', '3', '1111', 'Cl Angelillo 13 2B 28018', 'JAVIER JAVIE', 'pilarnunez@gmail.com', 'contabilidad'),
('BBBBBBBBB', 'PATATA', '0', '1', 'PATATA', 'MICARRO@1', 'compras'),
('BORJA31', '22222', '$2y$10$qI1AJ9zK1Z7SGLLO0Lgb1uPCrzWjvqRzvLEu7fC7l8mf7xn80h0Fe', '1', 'PATATA', 'MICARRO@1', 'compras'),
('CARLISTRI', 'PATATA', '$2y$10$eZrgAvC2WinfKUCdpVa8/uKiOKqT57KwwhjlJK40dtr6BXtQVxywq', '1', 'PATATA', 'MICARRO@1', 'compras'),
('CARLITOSC', 'PATATA', '$2y$10$zHOYQfczLIKBhluMsSk1ge.x18eDB5O/SQh6Vaf.kpfEmYCZyB.ee', '1', 'PATATA', 'MICARRO@1', 'compras'),
('dddd', '3', '0', 'Cl Angelillo 13 2B 28018', 'JAVIER JAVIE', 'pilarnunez@gmail.com', 'contabilidad'),
('JAVIER123', 'JAVIER12345678', '0', '1', 'JAVIER123456', 'JAVIER12345678@1', 'direccion'),
('JAVIERJAV', 'PATATA', '$2y$10$f/Hiy8/2vJEEOF2NMM.vouQa56wVUm/7f67w9qaDeGhthu3wetQ62', '1', 'PATATA', 'MICARRO@1', 'compras'),
('LIMOOOON', 'PATATA', '0', '1', 'PATATA', 'MICARRO@1', 'compras'),
('MICARRO', 'MICARRO', '0', '1', 'MICARRO', 'MICARRO@1', 'compras'),
('PATATA', 'PATATA', '0', '1', 'PATATA', 'MICARRO@1', 'compras'),
('qqqqqqqqq', 'PATATA', '$2y$10$nmsgHxemMBQfincDX7R4P.AkOcv3oUGl6ROgWrHlAMiLcnNnF3s.e', '1', 'PATATA', 'MICARRO@1', 'compras'),
('RAMONCITO', 'PATATA', '0', '1', 'PATATA', 'MICARRO@1', 'compras'),
('RAMONYCAJ', 'PATATA', '0', '1', 'PATATA', 'MICARRO@1', 'compras');

INSERT INTO `escandallo` (`ide_esc`, `nom_esc`, `tie_esc`, `cos_esc`, `tip_esc`, `ide_art`) VALUES
(1, '3123', 99.99, 999.99, 'comun', 15),
(2, '43', 43.00, 999.99, 'personalizado', 24),
(3, '32', 32.00, 999.99, 'personalizado', NULL),
(4, 'zapatines', 1.00, 51.50, 'comun', NULL),
(5, '1', 2.00, 49.00, 'comun', 14),
(6, '1', 2.00, 11.50, 'comun', 3),
(7, 'PRUEBA55552', 5.00, 40.00, 'comun', 26),
(8, 'PRUEBA5555TERMINADOES', 5.00, 20.00, 'comun', 27),
(9, 'RAMIREZ2', 5.00, 20.00, 'comun', NULL),
(10, '1', 1.00, 7.99, 'comun', 1),
(11, '1', 1.00, 8.50, 'comun', 2);

INSERT INTO `factura_compra` (`num_com`, `fac_com`, `fec_com`, `tot_com`, `dni_emp`, `nif_pro`, `ide_alm`) VALUES
(12, '1', '2025-01-16', 63.25, '57859456L', 'F67890123', 3),
(22, '1', '0111-11-11', 7.50, '0155546F1', 'C34567890', 8);

INSERT INTO `factura_venta` (`num_ven`, `fec_ven`, `tot_ven`, `dni_emp`, `dni_cli`, `ide_alm`) VALUES
(5, '2025-02-27', 586.48, '02158744A', '3554881A', 2),
(6, '0001-11-11', 5.00, '54958623J', '6546888R', 2);

INSERT INTO `inventario` (`cod_inv`, `fec_inv`, `dni_emp`, `ide_art`, `ide_alm`) VALUES
(1, '3333-01-10', '02158744A', 9, 1),
(2, '0001-01-01', '55579226L', 9, 1),
(3, '0023-12-31', '03181526F', 12, 2),
(4, '0004-04-04', '51458795S', 12, 1),
(5, '1444-12-04', '55579226L', 13, 2),
(10, '2025-02-05', '545555555', NULL, 2),
(11, '2025-02-14', '57859456L', NULL, 2),
(12, '1111-01-01', '55579226L', NULL, 3),
(13, '0111-01-13', '5555', NULL, 2),
(14, '0111-11-11', '5555', NULL, 6);

INSERT INTO `produccion` (`ide_pdc`, `fec_pdc`, `can_pdc`, `ide_alm`, `ide_esc`, `dni_emp`) VALUES
(1, '3333-12-31', 32, 4, 1, '05716618B'),
(2, '0001-01-01', 25, 8, 1, '51458795S'),
(3, '0001-01-01', 2, 3, 1, '51458795S'),
(4, '0002-03-23', 44, 3, 1, '05716618B'),
(5, '2025-01-09', 3, 1, 1, '02158744A'),
(6, '2030-10-09', 1, 6, 1, '02158744A'),
(8, '2025-03-01', 1, 1, 1, '0155546F1'),
(9, '2025-02-10', 1, 1, 1, '0155546F1'),
(10, '2025-02-10', 2, 1, 1, '0155546F1'),
(11, '2025-02-10', 3, 1, 1, '0155546F1'),
(12, '2025-02-10', 32, 1, 1, '0155546F1'),
(13, '2025-02-10', 5, 1, 6, '0155546F1'),
(14, '2025-02-10', 4, 1, 5, '0155546F1'),
(15, '2025-02-10', 4, 4, 5, '1111'),
(16, '2025-02-10', 4, 4, 5, '1111'),
(17, '2025-02-10', 4, 4, 5, '1111'),
(18, '2025-02-10', 2, 1, 8, '0155546F1'),
(19, '2025-02-10', 5, 1, 3, '0155546F1'),
(20, '2025-02-10', 1, 1, 8, '0155546F1'),
(21, '2025-02-10', 1, 1, 8, '0155546F1'),
(22, '2025-02-10', 1, 1, 8, '0155546F1'),
(23, '2025-02-10', 3, 1, 8, '0155546F1'),
(24, '2025-02-10', 2, 1, 8, '0155546F1'),
(25, '2025-02-10', 2, 1, 8, '0155546F1'),
(26, '2025-02-10', 2, 1, 1, '0155546F1');

INSERT INTO `proveedores` (`nif_pro`, `nom_pro`, `dir_pro`, `tlf_pro`, `ema_pro`, `dto_pro`) VALUES
('B23456789', 'Distribuciones Martínez', 'Avenida Sol 23, Barcelona', '934567890', 'ventas@martinezdistribuciones.com', 12.75),
('C34567890', 'Logística Pérez', 'Plaza Luna 5, Valencia', '963890456', 'info@logisticaperez.com', 8.20),
('D45678901', 'Comercial López S.A.', 'Calle Verde 9, Sevilla', '954123789', 'soporte@comerciallopez.com', 15.00),
('E56789012', 'Juan García', 'Ronda Norte 3, Bilbao', '944678321', 'juangarcia@gmail.com', 9.10),
('F67890123', 'Muebles y Diseño S.L.', 'Avenida Mar 45, Málaga', '952345678', 'consultas@mueblesydiseno.com', 11.50);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
