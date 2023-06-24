-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2023 a las 18:17:16
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `emailsend`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correos`
--

CREATE TABLE `correos` (
  `CORREOID` int(11) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `CORREO` text DEFAULT NULL,
  `ASUNTO` varchar(100) NOT NULL,
  `SALUDO` varchar(50) NOT NULL,
  `CUERPO` text NOT NULL,
  `ESTADO` char(1) DEFAULT 'P',
  `CREACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `ACTUALIZACION` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `correos`
--

INSERT INTO `correos` (`CORREOID`, `NOMBRE`, `CORREO`, `ASUNTO`, `SALUDO`, `CUERPO`, `ESTADO`, `CREACION`, `ACTUALIZACION`) VALUES
(1, 'Elvis Godoy', 'elvis.godoy@ops.com.hn', 'Correo de cobro', 'Buenas tardes Elvis', 'Le saludamos del gallo mas gallo referente al saldo pendiente que tiene a la fecha por un valor de L 4000\r\n', 'P', '2023-04-12 22:24:40', NULL),
(2, 'Elvis Godoy', 'elvis.godoy@ops.com.hn', 'Correo de cobro', 'Buenas tardes Elvis', 'Le saludamos del gallo mas gallo referente al saldo pendiente que tiene a la fecha por un valor de L 4000\r\n', 'P', '2023-04-12 22:27:27', NULL),
(3, 'Elvis', 'Elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo\nreferente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-14 16:28:42', NULL),
(4, 'Elvis', 'Elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo\nreferente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'E', '2023-04-14 16:30:52', NULL),
(5, 'Elvis', 'Elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo\nreferente al saldo pendiente que adeuda a la fecha\npara mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'E', '2023-04-14 16:38:09', NULL),
(6, 'Xavier', 'xaviergodoyortega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', '¿Qué es poesía?, dices mientras clavas\nen mi pupila tu pupila azul.\n¿Qué es poesía? ¿Y tú me lo preguntas?\nPoesía... eres tú', 'E', '2023-04-14 16:38:09', NULL),
(7, 'Elvis', 'Elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo\nreferente al saldo pendiente que adeuda a la fecha\npara mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'E', '2023-04-14 16:42:55', NULL),
(8, 'Xavier', 'xaviergodoyortega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', '¿Qué es poesía?, dices mientras clavas\nen mi pupila tu pupila azul.\n¿Qué es poesía? ¿Y tú me lo preguntas?\nPoesía... eres tú', 'E', '2023-04-14 16:42:55', NULL),
(9, 'Elvis', 'Elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo\nreferente al saldo pendiente que adeuda a la fecha\npara mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-15 13:58:22', NULL),
(10, 'Xavier', 'xaviergodoyortega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', '¿Qué es poesía?, dices mientras clavas\nen mi pupila tu pupila azul.\n¿Qué es poesía? ¿Y tú me lo preguntas?\nPoesía... eres tú', 'P', '2023-04-15 13:58:22', NULL),
(11, 'Elvis', 'Elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo\nreferente al saldo pendiente que adeuda a la fecha\npara mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-15 14:17:14', NULL),
(12, 'Xavier', 'xaviergodoyortega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', '¿Qué es poesía?, dices mientras clavas\nen mi pupila tu pupila azul.\n¿Qué es poesía? ¿Y tú me lo preguntas?\nPoesía... eres tú', 'P', '2023-04-15 14:17:14', NULL),
(13, 'Elvis', 'Elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo\nreferente al saldo pendiente que adeuda a la fecha\npara mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-15 14:25:47', NULL),
(14, 'Xavier', 'xaviergodoyortega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', '¿Qué es poesía?, dices mientras clavas\nen mi pupila tu pupila azul.\n¿Qué es poesía? ¿Y tú me lo preguntas?\nPoesía... eres tú', 'P', '2023-04-15 14:25:47', NULL),
(15, 'Elvis', 'Elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo\nreferente al saldo pendiente que adeuda a la fecha\npara mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-15 14:41:17', NULL),
(16, 'Xavier', 'xaviergodoyortega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', '¿Qué es poesía?, dices mientras clavas\nen mi pupila tu pupila azul.\n¿Qué es poesía? ¿Y tú me lo preguntas?\nPoesía... eres tú', 'P', '2023-04-15 14:41:17', NULL),
(17, 'Elvis', 'Elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo\nreferente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-15 16:50:14', NULL),
(18, 'Xavier', 'xaviergodoyortega@gmail.com', 'Saldo pendiente', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo\nreferente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-15 16:50:14', NULL),
(19, 'Elvis', 'Elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'E', '2023-04-15 16:52:21', NULL),
(20, 'Xavier', 'xaviergodoyortega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-15 16:52:21', NULL),
(21, 'Elvis', 'Elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo\n referente al saldo pendiente que adeuda a la fecha\n para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'E', '2023-04-15 16:55:15', NULL),
(22, 'Xavier', 'xaviergodoyortega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo\n referente al saldo pendiente que adeuda a la fecha\n para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'E', '2023-04-15 16:55:15', NULL),
(23, 'Elvis', 'elvis.ordon?ez@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-15 17:32:16', NULL),
(24, 'Xavier', 'xaviergn?doyn?rtega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-15 17:32:16', NULL),
(25, 'Elvis', 'ELVIS.ORDOÑEZ@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-15 17:44:00', NULL),
(26, 'Xavier', 'XAVIERgÓDOYóRTEGA@GMAIL.COM', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-15 17:44:00', NULL),
(27, 'Elvis', 'micorreoelectronico@ejemplo.com', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-15 17:44:26', NULL),
(28, 'Xavier', 'micorreoelectronico@ejemplo.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-15 17:44:26', NULL),
(29, 'Elvis', 'elvis.ordonez@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-15 17:46:09', NULL),
(30, 'Xavier', 'xaviergodoyortega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-15 17:46:09', NULL),
(31, 'Elvis', 'elvis.godoyñ@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'N', '2023-04-18 15:02:07', NULL),
(32, 'Xavier', 'xaviergodoyortega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'E', '2023-04-18 15:02:07', NULL),
(33, 'Elvis MAL', 'elvis.godoyn@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 15:47:49', NULL),
(34, 'Xavier MAL', 'xaviergodoyortegagmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 15:47:49', NULL),
(35, 'Elvis', 'elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 15:47:49', NULL),
(36, 'Xavier', 'xaviergodoyortega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 15:47:49', NULL),
(37, '', '', '', '', '', 'P', '2023-04-18 15:47:49', NULL),
(38, '', '', '', '', '', 'P', '2023-04-18 15:47:49', NULL),
(39, '', '', '', '', '', 'P', '2023-04-18 15:47:49', NULL),
(40, '', '', '', '', '', 'P', '2023-04-18 15:47:49', NULL),
(41, 'Elvis MAL', 'elvis.godoyn@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 15:49:54', NULL),
(42, 'Xavier MAL', 'xaviergodoyortegagmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 15:49:54', NULL),
(43, 'Elvis', 'elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 15:49:54', NULL),
(44, 'Xavier', 'xaviergodoyortega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 15:49:54', NULL),
(45, '', '', '', '', '', 'P', '2023-04-18 15:49:54', NULL),
(46, '', '', '', '', '', 'P', '2023-04-18 15:49:54', NULL),
(47, '', '', '', '', '', 'P', '2023-04-18 15:49:54', NULL),
(48, '', '', '', '', '', 'P', '2023-04-18 15:49:54', NULL),
(49, 'Elvis MAL', 'elvis.godoyn@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 15:50:39', NULL),
(50, 'Xavier MAL', 'xaviergodoyortegagmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 15:50:39', NULL),
(51, 'Elvis', 'elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 15:50:39', NULL),
(52, 'Xavier', 'xaviergodoyortega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 15:50:39', NULL),
(53, '', '', '', '', '', 'P', '2023-04-18 15:50:39', NULL),
(54, '', '', '', '', '', 'P', '2023-04-18 15:50:39', NULL),
(55, '', '', '', '', '', 'P', '2023-04-18 15:50:39', NULL),
(56, '', '', '', '', '', 'P', '2023-04-18 15:50:39', NULL),
(57, 'Elvis', 'elvis.godoyn@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 15:53:38', NULL),
(58, 'Xavier', 'xaviergodoyortega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 15:53:38', NULL),
(59, 'Elvis MAL', 'elvis.godoyÑ@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'N', '2023-04-18 15:54:50', NULL),
(60, 'Xavier MAL', 'xaviergodoyortegagmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'N', '2023-04-18 15:54:50', NULL),
(61, 'Elvis', 'elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'E', '2023-04-18 15:54:50', NULL),
(62, 'Xavier', 'xaviergodoyortega@gmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha para mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'E', '2023-04-18 15:54:50', NULL),
(63, 'Elvis', 'elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha\n\npara mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 19:49:12', NULL),
(64, 'Xavier', 'xaviergodoyortegagmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha\n\npara mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 19:49:12', NULL),
(65, 'Elvis', 'elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha\n\npara mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 21:27:54', NULL),
(67, 'Elvis', 'elvis.godoy@ops.com.hn', 'Saldo pendiente', 'Buenas tardes Elvis', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha\n\npara mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 21:30:31', NULL),
(68, 'Xavier', 'xaviergodoyortegagmail.com', 'Correo de prueba', 'Buenas tardes Xavier', 'Le saludamos de parte de tigo referente al saldo pendiente que adeuda a la fecha\n\npara mas informacion puede visitar el siguiente enlace https://www.tigo.com.hn/', 'P', '2023-04-18 21:30:31', NULL),
(69, 'Elvis', 'elvis.godoy@ops.com.hn', 'Historia de Honduras', 'Buen dia', 'Honduras, oficialmente conocida como la República de Honduras, es un país ubicado en América Central. Su historia se remonta a tiempos antiguos, cuando estaba habitada por diversas culturas indígenas como los mayas, lenca, tolupanes, pech, misquitos y garífunas, que dejaron una rica herencia cultural en la región.\n\nLa llegada de los españoles a Honduras se produjo en 1502, cuando Cristóbal Colón desembarcó en la costa norte del país durante su cuarto viaje a América. Sin embargo, la colonización española de Honduras no comenzó hasta 1524, cuando el conquistador español Hernán Cortés llegó a la región en busca de oro y riquezas. Los españoles sometieron a la población indígena y establecieron una colonia que formaba parte del Virreinato de Nueva España.\n\nDurante el período colonial, Honduras se convirtió en un importante centro de producción agrícola, con la exportación de productos como cacao, añil y tabaco. Sin embargo, la explotación de los indígenas y la imposición de la cultura y religión española provocaron numerosos conflictos y rebeliones en la región.\n\nCon la independencia de México en 1821, Honduras se unió a la Federación Centroamericana junto con otros países de la región, incluyendo Guatemala, El Salvador, Nicaragua y Costa Rica. Sin embargo, la federación fue efímera y se disolvió en 1838, lo que llevó a la creación de la República de Honduras como un país independiente.\n\nDesde entonces, Honduras ha enfrentado una serie de conflictos políticos y sociales. Durante el siglo XIX, el país experimentó una serie de dictaduras y gobiernos inestables, lo que llevó a numerosos levantamientos y guerras civiles. En 1898, Honduras firmó un tratado con Estados Unidos que permitió la construcción de una base naval en la Bahía de Honduras, lo que generó tensiones y protestas en la población hondureña.\n\nA principios del siglo XX, Honduras vivió un auge económico gracias a la exportación de bananas y otros productos agrícolas. Sin embargo, la explotación de los trabajadores y la falta de distribución de la riqueza provocaron descontento en la población, lo que llevó a la Revolución de 1919, liderada por el general Rafael López Gutiérrez.\n\nA partir de la década de 1930, Honduras experimentó una serie de gobiernos militares y democracias interrumpidas. Durante la Guerra Fría, el país se convirtió en un escenario de luchas políticas y conflictos armados, incluyendo la intervención de Estados Unidos en la región para proteger sus intereses estratégicos. En 1969, Honduras se involucró en un conflicto bélico conocido como la \"Guerra del Fútbol\" con El Salvador, en la que ambos países se enfrentaron por disputas territoriales y migratorias.\n\nEn la década de 1980, Honduras se vio afectada por la guerra civil en Nicaragua y por la presencia de grupos guerrilleros y contrar', 'P', '2023-04-24 15:03:29', NULL),
(70, 'Juan', 'juan@mail', 'Historia de Honduras', 'Buen dia', 'Honduras, oficialmente conocida como la República de Honduras, es un país ubicado en América Central. Su historia se remonta a tiempos antiguos, cuando estaba habitada por diversas culturas indígenas como los mayas, lenca, tolupanes, pech, misquitos y garífunas, que dejaron una rica herencia cultural en la región.\n\nLa llegada de los españoles a Honduras se produjo en 1502, cuando Cristóbal Colón desembarcó en la costa norte del país durante su cuarto viaje a América. Sin embargo, la colonización española de Honduras no comenzó hasta 1524, cuando el conquistador español Hernán Cortés llegó a la región en busca de oro y riquezas. Los españoles sometieron a la población indígena y establecieron una colonia que formaba parte del Virreinato de Nueva España.\n\nDurante el período colonial, Honduras se convirtió en un importante centro de producción agrícola, con la exportación de productos como cacao, añil y tabaco. Sin embargo, la explotación de los indígenas y la imposición de la cultura y religión española provocaron numerosos conflictos y rebeliones en la región.\n\nCon la independencia de México en 1821, Honduras se unió a la Federación Centroamericana junto con otros países de la región, incluyendo Guatemala, El Salvador, Nicaragua y Costa Rica. Sin embargo, la federación fue efímera y se disolvió en 1838, lo que llevó a la creación de la República de Honduras como un país independiente.\n\nDesde entonces, Honduras ha enfrentado una serie de conflictos políticos y sociales. Durante el siglo XIX, el país experimentó una serie de dictaduras y gobiernos inestables, lo que llevó a numerosos levantamientos y guerras civiles. En 1898, Honduras firmó un tratado con Estados Unidos que permitió la construcción de una base naval en la Bahía de Honduras, lo que generó tensiones y protestas en la población hondureña.\n\nA principios del siglo XX, Honduras vivió un auge económico gracias a la exportación de bananas y otros productos agrícolas. Sin embargo, la explotación de los trabajadores y la falta de distribución de la riqueza provocaron descontento en la población, lo que llevó a la Revolución de 1919, liderada por el general Rafael López Gutiérrez.\n\nA partir de la década de 1930, Honduras experimentó una serie de gobiernos militares y democracias interrumpidas. Durante la Guerra Fría, el país se convirtió en un escenario de luchas políticas y conflictos armados, incluyendo la intervención de Estados Unidos en la región para proteger sus intereses estratégicos. En 1969, Honduras se involucró en un conflicto bélico conocido como la \"Guerra del Fútbol\" con El Salvador, en la que ambos países se enfrentaron por disputas territoriales y migratorias.\n\nEn la década de 1980, Honduras se vio afectada por la guerra civil en Nicaragua y por la presencia de grupos guerrilleros y contrar', 'P', '2023-04-24 15:03:29', NULL),
(71, 'Xavier', 'xaviergodoyortega@gmail.com', 'Historia de Honduras', 'Buen dia', 'Honduras, oficialmente conocida como la República de Honduras, es un país ubicado en América Central. Su historia se remonta a tiempos antiguos, cuando estaba habitada por diversas culturas indígenas como los mayas, lenca, tolupanes, pech, misquitos y garífunas, que dejaron una rica herencia cultural en la región.\n\nLa llegada de los españoles a Honduras se produjo en 1502, cuando Cristóbal Colón desembarcó en la costa norte del país durante su cuarto viaje a América. Sin embargo, la colonización española de Honduras no comenzó hasta 1524, cuando el conquistador español Hernán Cortés llegó a la región en busca de oro y riquezas. Los españoles sometieron a la población indígena y establecieron una colonia que formaba parte del Virreinato de Nueva España.\n\nDurante el período colonial, Honduras se convirtió en un importante centro de producción agrícola, con la exportación de productos como cacao, añil y tabaco. Sin embargo, la explotación de los indígenas y la imposición de la cultura y religión española provocaron numerosos conflictos y rebeliones en la región.\n\nCon la independencia de México en 1821, Honduras se unió a la Federación Centroamericana junto con otros países de la región, incluyendo Guatemala, El Salvador, Nicaragua y Costa Rica. Sin embargo, la federación fue efímera y se disolvió en 1838, lo que llevó a la creación de la República de Honduras como un país independiente.\n\nDesde entonces, Honduras ha enfrentado una serie de conflictos políticos y sociales. Durante el siglo XIX, el país experimentó una serie de dictaduras y gobiernos inestables, lo que llevó a numerosos levantamientos y guerras civiles. En 1898, Honduras firmó un tratado con Estados Unidos que permitió la construcción de una base naval en la Bahía de Honduras, lo que generó tensiones y protestas en la población hondureña.\n\nA principios del siglo XX, Honduras vivió un auge económico gracias a la exportación de bananas y otros productos agrícolas. Sin embargo, la explotación de los trabajadores y la falta de distribución de la riqueza provocaron descontento en la población, lo que llevó a la Revolución de 1919, liderada por el general Rafael López Gutiérrez.\n\nA partir de la década de 1930, Honduras experimentó una serie de gobiernos militares y democracias interrumpidas. Durante la Guerra Fría, el país se convirtió en un escenario de luchas políticas y conflictos armados, incluyendo la intervención de Estados Unidos en la región para proteger sus intereses estratégicos. En 1969, Honduras se involucró en un conflicto bélico conocido como la \"Guerra del Fútbol\" con El Salvador, en la que ambos países se enfrentaron por disputas territoriales y migratorias.\n\nEn la década de 1980, Honduras se vio afectada por la guerra civil en Nicaragua y por la presencia de grupos guerrilleros y contrar', 'P', '2023-04-24 15:03:29', NULL),
(72, 'Maria', 'mariagmail.com', 'Historia de Honduras', 'Buen dia', 'Honduras, oficialmente conocida como la República de Honduras, es un país ubicado en América Central. Su historia se remonta a tiempos antiguos, cuando estaba habitada por diversas culturas indígenas como los mayas, lenca, tolupanes, pech, misquitos y garífunas, que dejaron una rica herencia cultural en la región.\n\nLa llegada de los españoles a Honduras se produjo en 1502, cuando Cristóbal Colón desembarcó en la costa norte del país durante su cuarto viaje a América. Sin embargo, la colonización española de Honduras no comenzó hasta 1524, cuando el conquistador español Hernán Cortés llegó a la región en busca de oro y riquezas. Los españoles sometieron a la población indígena y establecieron una colonia que formaba parte del Virreinato de Nueva España.\n\nDurante el período colonial, Honduras se convirtió en un importante centro de producción agrícola, con la exportación de productos como cacao, añil y tabaco. Sin embargo, la explotación de los indígenas y la imposición de la cultura y religión española provocaron numerosos conflictos y rebeliones en la región.\n\nCon la independencia de México en 1821, Honduras se unió a la Federación Centroamericana junto con otros países de la región, incluyendo Guatemala, El Salvador, Nicaragua y Costa Rica. Sin embargo, la federación fue efímera y se disolvió en 1838, lo que llevó a la creación de la República de Honduras como un país independiente.\n\nDesde entonces, Honduras ha enfrentado una serie de conflictos políticos y sociales. Durante el siglo XIX, el país experimentó una serie de dictaduras y gobiernos inestables, lo que llevó a numerosos levantamientos y guerras civiles. En 1898, Honduras firmó un tratado con Estados Unidos que permitió la construcción de una base naval en la Bahía de Honduras, lo que generó tensiones y protestas en la población hondureña.\n\nA principios del siglo XX, Honduras vivió un auge económico gracias a la exportación de bananas y otros productos agrícolas. Sin embargo, la explotación de los trabajadores y la falta de distribución de la riqueza provocaron descontento en la población, lo que llevó a la Revolución de 1919, liderada por el general Rafael López Gutiérrez.\n\nA partir de la década de 1930, Honduras experimentó una serie de gobiernos militares y democracias interrumpidas. Durante la Guerra Fría, el país se convirtió en un escenario de luchas políticas y conflictos armados, incluyendo la intervención de Estados Unidos en la región para proteger sus intereses estratégicos. En 1969, Honduras se involucró en un conflicto bélico conocido como la \"Guerra del Fútbol\" con El Salvador, en la que ambos países se enfrentaron por disputas territoriales y migratorias.\n\nEn la década de 1980, Honduras se vio afectada por la guerra civil en Nicaragua y por la presencia de grupos guerrilleros y contrar', 'P', '2023-04-24 15:03:29', NULL),
(73, 'Pedro', 'pedro@mail.com', 'Historia de Honduras', 'Buen dia', 'Honduras, oficialmente conocida como la República de Honduras, es un país ubicado en América Central. Su historia se remonta a tiempos antiguos, cuando estaba habitada por diversas culturas indígenas como los mayas, lenca, tolupanes, pech, misquitos y garífunas, que dejaron una rica herencia cultural en la región.\n\nLa llegada de los españoles a Honduras se produjo en 1502, cuando Cristóbal Colón desembarcó en la costa norte del país durante su cuarto viaje a América. Sin embargo, la colonización española de Honduras no comenzó hasta 1524, cuando el conquistador español Hernán Cortés llegó a la región en busca de oro y riquezas. Los españoles sometieron a la población indígena y establecieron una colonia que formaba parte del Virreinato de Nueva España.\n\nDurante el período colonial, Honduras se convirtió en un importante centro de producción agrícola, con la exportación de productos como cacao, añil y tabaco. Sin embargo, la explotación de los indígenas y la imposición de la cultura y religión española provocaron numerosos conflictos y rebeliones en la región.\n\nCon la independencia de México en 1821, Honduras se unió a la Federación Centroamericana junto con otros países de la región, incluyendo Guatemala, El Salvador, Nicaragua y Costa Rica. Sin embargo, la federación fue efímera y se disolvió en 1838, lo que llevó a la creación de la República de Honduras como un país independiente.\n\nDesde entonces, Honduras ha enfrentado una serie de conflictos políticos y sociales. Durante el siglo XIX, el país experimentó una serie de dictaduras y gobiernos inestables, lo que llevó a numerosos levantamientos y guerras civiles. En 1898, Honduras firmó un tratado con Estados Unidos que permitió la construcción de una base naval en la Bahía de Honduras, lo que generó tensiones y protestas en la población hondureña.\n\nA principios del siglo XX, Honduras vivió un auge económico gracias a la exportación de bananas y otros productos agrícolas. Sin embargo, la explotación de los trabajadores y la falta de distribución de la riqueza provocaron descontento en la población, lo que llevó a la Revolución de 1919, liderada por el general Rafael López Gutiérrez.\n\nA partir de la década de 1930, Honduras experimentó una serie de gobiernos militares y democracias interrumpidas. Durante la Guerra Fría, el país se convirtió en un escenario de luchas políticas y conflictos armados, incluyendo la intervención de Estados Unidos en la región para proteger sus intereses estratégicos. En 1969, Honduras se involucró en un conflicto bélico conocido como la \"Guerra del Fútbol\" con El Salvador, en la que ambos países se enfrentaron por disputas territoriales y migratorias.\n\nEn la década de 1980, Honduras se vio afectada por la guerra civil en Nicaragua y por la presencia de grupos guerrilleros y contrar', 'P', '2023-04-24 15:03:29', NULL),
(74, 'Elvis', 'elvis.godoy@ops.com.hn', 'Historia de Honduras', 'Buen dia', 'Honduras, oficialmente conocida como la República de Honduras, es un país ubicado en América Central. Su historia se remonta a tiempos antiguos, cuando estaba habitada por diversas culturas indígenas como los mayas, lenca, tolupanes, pech, misquitos y garífunas, que dejaron una rica herencia cultural en la región.\n\nLa llegada de los españoles a Honduras se produjo en 1502, cuando Cristóbal Colón desembarcó en la costa norte del país durante su cuarto viaje a América. Sin embargo, la colonización española de Honduras no comenzó hasta 1524, cuando el conquistador español Hernán Cortés llegó a la región en busca de oro y riquezas. Los españoles sometieron a la población indígena y establecieron una colonia que formaba parte del Virreinato de Nueva España.\n\nDurante el período colonial, Honduras se convirtió en un importante centro de producción agrícola, con la exportación de productos como cacao, añil y tabaco. Sin embargo, la explotación de los indígenas y la imposición de la cultura y religión española provocaron numerosos conflictos y rebeliones en la región.\n\nCon la independencia de México en 1821, Honduras se unió a la Federación Centroamericana junto con otros países de la región, incluyendo Guatemala, El Salvador, Nicaragua y Costa Rica. Sin embargo, la federación fue efímera y se disolvió en 1838, lo que llevó a la creación de la República de Honduras como un país independiente.\n\nDesde entonces, Honduras ha enfrentado una serie de conflictos políticos y sociales. Durante el siglo XIX, el país experimentó una serie de dictaduras y gobiernos inestables, lo que llevó a numerosos levantamientos y guerras civiles. En 1898, Honduras firmó un tratado con Estados Unidos que permitió la construcción de una base naval en la Bahía de Honduras, lo que generó tensiones y protestas en la población hondureña.\n\nA principios del siglo XX, Honduras vivió un auge económico gracias a la exportación de bananas y otros productos agrícolas. Sin embargo, la explotación de los trabajadores y la falta de distribución de la riqueza provocaron descontento en la población, lo que llevó a la Revolución de 1919, liderada por el general Rafael López Gutiérrez.\n\nA partir de la década de 1930, Honduras experimentó una serie de gobiernos militares y democracias interrumpidas. Durante la Guerra Fría, el país se convirtió en un escenario de luchas políticas y conflictos armados, incluyendo la intervención de Estados Unidos en la región para proteger sus intereses estratégicos. En 1969, Honduras se involucró en un conflicto bélico conocido como la \"Guerra del Fútbol\" con El Salvador, en la que ambos países se enfrentaron por disputas territoriales y migratorias.\n\nEn la década de 1980, Honduras se vio afectada por la guerra civil en Nicaragua y por la presencia de grupos guerrilleros y contrar', 'P', '2023-04-24 15:26:23', NULL),
(75, 'Juan', 'juan@mail', 'Historia de Honduras', 'Buen dia', 'Honduras, oficialmente conocida como la República de Honduras, es un país ubicado en América Central. Su historia se remonta a tiempos antiguos, cuando estaba habitada por diversas culturas indígenas como los mayas, lenca, tolupanes, pech, misquitos y garífunas, que dejaron una rica herencia cultural en la región.\n\nLa llegada de los españoles a Honduras se produjo en 1502, cuando Cristóbal Colón desembarcó en la costa norte del país durante su cuarto viaje a América. Sin embargo, la colonización española de Honduras no comenzó hasta 1524, cuando el conquistador español Hernán Cortés llegó a la región en busca de oro y riquezas. Los españoles sometieron a la población indígena y establecieron una colonia que formaba parte del Virreinato de Nueva España.\n\nDurante el período colonial, Honduras se convirtió en un importante centro de producción agrícola, con la exportación de productos como cacao, añil y tabaco. Sin embargo, la explotación de los indígenas y la imposición de la cultura y religión española provocaron numerosos conflictos y rebeliones en la región.\n\nCon la independencia de México en 1821, Honduras se unió a la Federación Centroamericana junto con otros países de la región, incluyendo Guatemala, El Salvador, Nicaragua y Costa Rica. Sin embargo, la federación fue efímera y se disolvió en 1838, lo que llevó a la creación de la República de Honduras como un país independiente.\n\nDesde entonces, Honduras ha enfrentado una serie de conflictos políticos y sociales. Durante el siglo XIX, el país experimentó una serie de dictaduras y gobiernos inestables, lo que llevó a numerosos levantamientos y guerras civiles. En 1898, Honduras firmó un tratado con Estados Unidos que permitió la construcción de una base naval en la Bahía de Honduras, lo que generó tensiones y protestas en la población hondureña.\n\nA principios del siglo XX, Honduras vivió un auge económico gracias a la exportación de bananas y otros productos agrícolas. Sin embargo, la explotación de los trabajadores y la falta de distribución de la riqueza provocaron descontento en la población, lo que llevó a la Revolución de 1919, liderada por el general Rafael López Gutiérrez.\n\nA partir de la década de 1930, Honduras experimentó una serie de gobiernos militares y democracias interrumpidas. Durante la Guerra Fría, el país se convirtió en un escenario de luchas políticas y conflictos armados, incluyendo la intervención de Estados Unidos en la región para proteger sus intereses estratégicos. En 1969, Honduras se involucró en un conflicto bélico conocido como la \"Guerra del Fútbol\" con El Salvador, en la que ambos países se enfrentaron por disputas territoriales y migratorias.\n\nEn la década de 1980, Honduras se vio afectada por la guerra civil en Nicaragua y por la presencia de grupos guerrilleros y contrar', 'P', '2023-04-24 15:26:23', NULL),
(76, 'Xavier', 'xaviergodoyortega@gmail.com', 'Historia de Honduras', 'Buen dia', 'Honduras, oficialmente conocida como la República de Honduras, es un país ubicado en América Central. Su historia se remonta a tiempos antiguos, cuando estaba habitada por diversas culturas indígenas como los mayas, lenca, tolupanes, pech, misquitos y garífunas, que dejaron una rica herencia cultural en la región.\n\nLa llegada de los españoles a Honduras se produjo en 1502, cuando Cristóbal Colón desembarcó en la costa norte del país durante su cuarto viaje a América. Sin embargo, la colonización española de Honduras no comenzó hasta 1524, cuando el conquistador español Hernán Cortés llegó a la región en busca de oro y riquezas. Los españoles sometieron a la población indígena y establecieron una colonia que formaba parte del Virreinato de Nueva España.\n\nDurante el período colonial, Honduras se convirtió en un importante centro de producción agrícola, con la exportación de productos como cacao, añil y tabaco. Sin embargo, la explotación de los indígenas y la imposición de la cultura y religión española provocaron numerosos conflictos y rebeliones en la región.\n\nCon la independencia de México en 1821, Honduras se unió a la Federación Centroamericana junto con otros países de la región, incluyendo Guatemala, El Salvador, Nicaragua y Costa Rica. Sin embargo, la federación fue efímera y se disolvió en 1838, lo que llevó a la creación de la República de Honduras como un país independiente.\n\nDesde entonces, Honduras ha enfrentado una serie de conflictos políticos y sociales. Durante el siglo XIX, el país experimentó una serie de dictaduras y gobiernos inestables, lo que llevó a numerosos levantamientos y guerras civiles. En 1898, Honduras firmó un tratado con Estados Unidos que permitió la construcción de una base naval en la Bahía de Honduras, lo que generó tensiones y protestas en la población hondureña.\n\nA principios del siglo XX, Honduras vivió un auge económico gracias a la exportación de bananas y otros productos agrícolas. Sin embargo, la explotación de los trabajadores y la falta de distribución de la riqueza provocaron descontento en la población, lo que llevó a la Revolución de 1919, liderada por el general Rafael López Gutiérrez.\n\nA partir de la década de 1930, Honduras experimentó una serie de gobiernos militares y democracias interrumpidas. Durante la Guerra Fría, el país se convirtió en un escenario de luchas políticas y conflictos armados, incluyendo la intervención de Estados Unidos en la región para proteger sus intereses estratégicos. En 1969, Honduras se involucró en un conflicto bélico conocido como la \"Guerra del Fútbol\" con El Salvador, en la que ambos países se enfrentaron por disputas territoriales y migratorias.\n\nEn la década de 1980, Honduras se vio afectada por la guerra civil en Nicaragua y por la presencia de grupos guerrilleros y contrar', 'P', '2023-04-24 15:26:23', NULL),
(77, 'Maria', 'mariagmail.com', 'Historia de Honduras', 'Buen dia', 'Honduras, oficialmente conocida como la República de Honduras, es un país ubicado en América Central. Su historia se remonta a tiempos antiguos, cuando estaba habitada por diversas culturas indígenas como los mayas, lenca, tolupanes, pech, misquitos y garífunas, que dejaron una rica herencia cultural en la región.\n\nLa llegada de los españoles a Honduras se produjo en 1502, cuando Cristóbal Colón desembarcó en la costa norte del país durante su cuarto viaje a América. Sin embargo, la colonización española de Honduras no comenzó hasta 1524, cuando el conquistador español Hernán Cortés llegó a la región en busca de oro y riquezas. Los españoles sometieron a la población indígena y establecieron una colonia que formaba parte del Virreinato de Nueva España.\n\nDurante el período colonial, Honduras se convirtió en un importante centro de producción agrícola, con la exportación de productos como cacao, añil y tabaco. Sin embargo, la explotación de los indígenas y la imposición de la cultura y religión española provocaron numerosos conflictos y rebeliones en la región.\n\nCon la independencia de México en 1821, Honduras se unió a la Federación Centroamericana junto con otros países de la región, incluyendo Guatemala, El Salvador, Nicaragua y Costa Rica. Sin embargo, la federación fue efímera y se disolvió en 1838, lo que llevó a la creación de la República de Honduras como un país independiente.\n\nDesde entonces, Honduras ha enfrentado una serie de conflictos políticos y sociales. Durante el siglo XIX, el país experimentó una serie de dictaduras y gobiernos inestables, lo que llevó a numerosos levantamientos y guerras civiles. En 1898, Honduras firmó un tratado con Estados Unidos que permitió la construcción de una base naval en la Bahía de Honduras, lo que generó tensiones y protestas en la población hondureña.\n\nA principios del siglo XX, Honduras vivió un auge económico gracias a la exportación de bananas y otros productos agrícolas. Sin embargo, la explotación de los trabajadores y la falta de distribución de la riqueza provocaron descontento en la población, lo que llevó a la Revolución de 1919, liderada por el general Rafael López Gutiérrez.\n\nA partir de la década de 1930, Honduras experimentó una serie de gobiernos militares y democracias interrumpidas. Durante la Guerra Fría, el país se convirtió en un escenario de luchas políticas y conflictos armados, incluyendo la intervención de Estados Unidos en la región para proteger sus intereses estratégicos. En 1969, Honduras se involucró en un conflicto bélico conocido como la \"Guerra del Fútbol\" con El Salvador, en la que ambos países se enfrentaron por disputas territoriales y migratorias.\n\nEn la década de 1980, Honduras se vio afectada por la guerra civil en Nicaragua y por la presencia de grupos guerrilleros y contrar', 'P', '2023-04-24 15:26:23', NULL),
(78, 'Pedro', 'pedro@mail.com', 'Historia de Honduras', 'Buen dia', 'Honduras, oficialmente conocida como la República de Honduras, es un país ubicado en América Central. Su historia se remonta a tiempos antiguos, cuando estaba habitada por diversas culturas indígenas como los mayas, lenca, tolupanes, pech, misquitos y garífunas, que dejaron una rica herencia cultural en la región.\n\nLa llegada de los españoles a Honduras se produjo en 1502, cuando Cristóbal Colón desembarcó en la costa norte del país durante su cuarto viaje a América. Sin embargo, la colonización española de Honduras no comenzó hasta 1524, cuando el conquistador español Hernán Cortés llegó a la región en busca de oro y riquezas. Los españoles sometieron a la población indígena y establecieron una colonia que formaba parte del Virreinato de Nueva España.\n\nDurante el período colonial, Honduras se convirtió en un importante centro de producción agrícola, con la exportación de productos como cacao, añil y tabaco. Sin embargo, la explotación de los indígenas y la imposición de la cultura y religión española provocaron numerosos conflictos y rebeliones en la región.\n\nCon la independencia de México en 1821, Honduras se unió a la Federación Centroamericana junto con otros países de la región, incluyendo Guatemala, El Salvador, Nicaragua y Costa Rica. Sin embargo, la federación fue efímera y se disolvió en 1838, lo que llevó a la creación de la República de Honduras como un país independiente.\n\nDesde entonces, Honduras ha enfrentado una serie de conflictos políticos y sociales. Durante el siglo XIX, el país experimentó una serie de dictaduras y gobiernos inestables, lo que llevó a numerosos levantamientos y guerras civiles. En 1898, Honduras firmó un tratado con Estados Unidos que permitió la construcción de una base naval en la Bahía de Honduras, lo que generó tensiones y protestas en la población hondureña.\n\nA principios del siglo XX, Honduras vivió un auge económico gracias a la exportación de bananas y otros productos agrícolas. Sin embargo, la explotación de los trabajadores y la falta de distribución de la riqueza provocaron descontento en la población, lo que llevó a la Revolución de 1919, liderada por el general Rafael López Gutiérrez.\n\nA partir de la década de 1930, Honduras experimentó una serie de gobiernos militares y democracias interrumpidas. Durante la Guerra Fría, el país se convirtió en un escenario de luchas políticas y conflictos armados, incluyendo la intervención de Estados Unidos en la región para proteger sus intereses estratégicos. En 1969, Honduras se involucró en un conflicto bélico conocido como la \"Guerra del Fútbol\" con El Salvador, en la que ambos países se enfrentaron por disputas territoriales y migratorias.\n\nEn la década de 1980, Honduras se vio afectada por la guerra civil en Nicaragua y por la presencia de grupos guerrilleros y contrar', 'P', '2023-04-24 15:26:23', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombresgruposexcel`
--

CREATE TABLE `nombresgruposexcel` (
  `NGEID` int(11) NOT NULL,
  `NOMBRES` varchar(100) NOT NULL,
  `ESTADO` char(1) DEFAULT 'A',
  `USUARIOID` int(11) NOT NULL,
  `IMAGEN` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `nombresgruposexcel`
--

INSERT INTO `nombresgruposexcel` (`NGEID`, `NOMBRES`, `ESTADO`, `USUARIOID`, `IMAGEN`) VALUES
(2, 'Campaña Elvis 2', 'A', 1, './imagenes/CampañaElvis2/imagen.png'),
(3, 'Campaña Elvis con parrafos', 'A', 1, './imagenes/CampañaElvisconparrafos/imagen.png'),
(4, 'Campaña Elvis con parrafos 2', 'A', 1, './imagenes/CampañaElvisconparrafos2/imagen.png'),
(5, 'Campaña Elvis con parrafos2', 'A', 1, './imagenes/CampañaElvisconparrafos2/imagen.png'),
(6, 'Campaña Elvis con parrafos 3', 'A', 1, './imagenes/CampañaElvisconparrafos3/imagen.png'),
(7, 'campaña de prueba con saltos de linea ', 'A', 1, './imagenes/campañadepruebaconsaltosdelinea/imagen.png'),
(8, 'campaña de prueba con saltos de linea 2', 'A', 1, './imagenes/campañadepruebaconsaltosdelinea2/imagen.png'),
(9, 'campaña de prueba con saltos de linea 3', 'A', 1, './imagenes/campañadepruebaconsaltosdelinea3/imagen.png'),
(10, 'campaña de prueba con saltos de linea 4', 'A', 1, './imagenes/campañadepruebaconsaltosdelinea4/imagen.png'),
(11, 'campaña de prueba con saltos de linea 5', 'A', 1, './imagenes/campañadepruebaconsaltosdelinea5/imagen.png'),
(12, 'campaña de prueba con saltos de linea 6', 'A', 1, './imagenes/campañadepruebaconsaltosdelinea6/imagen.png'),
(13, 'campaña de prueba con saltos de linea 7', 'A', 1, './imagenes/campañadepruebaconsaltosdelinea7/imagen.png'),
(14, 'campaña de prueba con saltos de linea 8', 'A', 1, './imagenes/campañadepruebaconsaltosdelinea8/imagen.png'),
(15, 'campaña de prueba con saltos de linea 9', 'A', 1, './imagenes/campañadepruebaconsaltosdelinea9/imagen.png'),
(16, 'campaña de prueba con saltos de linea 10', 'A', 1, './imagenes/campañadepruebaconsaltosdelinea10/imagen.png'),
(17, 'campaña de prueba con saltos de linea 11', 'A', 1, './imagenes/campañadepruebaconsaltosdelinea11/imagen.png'),
(18, 'campaña de prueba con saltos de linea 12', 'A', 1, './imagenes/campañadepruebaconsaltosdelinea12/imagen.png'),
(19, 'campaña de prueba con saltos de linea 13', 'A', 1, './imagenes/campañadepruebaconsaltosdelinea13/imagen.png'),
(20, 'CORREO CON ACENTOS', 'A', 1, './imagenes/CORREOCONACENTOS/imagen.png'),
(21, 'campaña con acentos y mayusculas', 'A', 1, './imagenes/campañaconacentosymayusculas/imagen.png'),
(22, 'campaña con acentos y mayusculas 1', 'A', 1, './imagenes/campañaconacentosymayusculas1/imagen.png'),
(23, 'campaña con acentos y mayusculas 2', 'A', 1, './imagenes/campañaconacentosymayusculas2/imagen.png'),
(24, 'campaña con acentos y mayusculas 3', 'A', 1, './imagenes/campañaconacentosymayusculas3/imagen.png'),
(25, 'CORREO CON ACENTOS 3', 'A', 1, './imagenes/CORREOCONACENTOS3/imagen.png'),
(26, 'CORREO CON ACENTOS 4', 'A', 1, './imagenes/1/CORREOCONACENTOS4/imagen.png'),
(27, 'CORREO CON ACENTOS 5', 'A', 1, './imagenes/CORREOCONACENTOS5/imagen.png'),
(28, 'CORREO CON ACENTOS 6', 'A', 1, './imagenes/CORREOCONACENTOS6/imagen.png'),
(29, 'CORREO CON ACENTOS 7', 'A', 1, './imagenes/1/CORREOCONACENTOS7/imagen.png'),
(30, 'CORREO CON ACENTOS 8', 'A', 1, './imagenes/1/CORREOCONACENTOS8/imagen.png'),
(31, 'CORREO CON ACENTOS 9', 'A', 1, './imagenes/1/CORREOCONACENTOS9/imagen.png'),
(32, 'CORREO CON ACENTOS 10', 'A', 1, './imagenes/CORREOCONACENTOS10/imagen.png'),
(33, 'campaña correo con ñ', 'A', 1, './imagenes/1/campañacorreoconñ/imagen.png'),
(34, 'CORREOS MALOS', 'A', 1, './imagenes/CORREOSMALOS/imagen.png'),
(35, 'CORREOS MALOS 2', 'A', 1, './imagenes/CORREOSMALOS2/imagen.png'),
(36, 'CORREOS MALOS 3', 'A', 1, './imagenes/CORREOSMALOS3/imagen.png'),
(37, 'CORREOS MALOS 4', 'A', 1, './imagenes/CORREOSMALOS4/imagen.png'),
(38, 'CORREOS MALOS 5', 'A', 1, './imagenes/1/CORREOSMALOS5/imagen.png'),
(39, 'A Imagenes', 'A', 1, './imagenes/1/AImagenes/imagen.png'),
(41, 'Campaña Elvis 1', 'A', 1, './imagenes/CampañaElvis1/imagen.png'),
(42, 'excel de pruebas funcion subir imagen', 'A', 1, './imagenes/1/exceldepruebasfuncionsubirimagen/imagen.png'),
(43, 'campaña extra de prueba', 'A', 1, './imagenes/1/campañaextradeprueba/imagen.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudenviarcorreos`
--

CREATE TABLE `solicitudenviarcorreos` (
  `ID` int(11) NOT NULL,
  `USUARIOID` int(11) NOT NULL,
  `NGEID` int(11) NOT NULL,
  `ESTADO` char(1) DEFAULT 'I',
  `CREACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `ACTUALIZACION` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitudenviarcorreos`
--

INSERT INTO `solicitudenviarcorreos` (`ID`, `USUARIOID`, `NGEID`, `ESTADO`, `CREACION`, `ACTUALIZACION`) VALUES
(2, 1, 2, 'I', '2023-04-12 22:27:27', '2023-04-12 22:30:45'),
(3, 1, 3, 'I', '2023-04-14 16:28:42', NULL),
(4, 1, 4, 'E', '2023-04-14 16:30:52', '2023-04-14 16:34:13'),
(5, 1, 5, 'E', '2023-04-14 16:38:09', '2023-04-14 16:38:16'),
(6, 1, 6, 'E', '2023-04-14 16:42:55', '2023-04-14 16:43:05'),
(7, 1, 7, 'I', '2023-04-15 13:58:22', '2023-04-24 15:27:05'),
(8, 1, 8, 'I', '2023-04-15 14:17:14', NULL),
(9, 1, 9, 'I', '2023-04-15 14:25:47', NULL),
(10, 1, 10, 'I', '2023-04-15 14:41:17', NULL),
(11, 1, 11, 'I', '2023-04-15 16:36:28', NULL),
(12, 1, 12, 'I', '2023-04-15 16:37:42', NULL),
(13, 1, 13, 'I', '2023-04-15 16:38:03', NULL),
(14, 1, 14, 'I', '2023-04-15 16:39:42', NULL),
(15, 1, 15, 'I', '2023-04-15 16:41:05', NULL),
(16, 1, 16, 'I', '2023-04-15 16:47:41', NULL),
(17, 1, 17, 'I', '2023-04-15 16:50:14', NULL),
(18, 1, 18, 'I', '2023-04-15 16:52:21', '2023-04-15 16:55:05'),
(19, 1, 19, 'E', '2023-04-15 16:55:15', '2023-04-15 16:55:26'),
(20, 1, 20, 'I', '2023-04-15 17:32:16', NULL),
(21, 1, 21, 'I', '2023-04-15 17:38:26', NULL),
(22, 1, 22, 'I', '2023-04-15 17:38:56', NULL),
(23, 1, 23, 'I', '2023-04-15 17:39:59', NULL),
(24, 1, 24, 'I', '2023-04-15 17:41:08', NULL),
(25, 1, 25, 'I', '2023-04-15 17:42:07', NULL),
(26, 1, 26, 'I', '2023-04-15 17:42:34', NULL),
(27, 1, 27, 'I', '2023-04-15 17:44:00', NULL),
(28, 1, 28, 'I', '2023-04-15 17:44:26', NULL),
(29, 1, 29, 'I', '2023-04-15 17:45:15', NULL),
(30, 1, 30, 'I', '2023-04-15 17:45:24', NULL),
(31, 1, 31, 'I', '2023-04-15 17:45:46', NULL),
(32, 1, 32, 'I', '2023-04-15 17:46:09', NULL),
(33, 1, 33, 'E', '2023-04-18 15:02:07', '2023-04-18 15:28:07'),
(34, 1, 34, 'I', '2023-04-18 15:47:49', '2023-04-18 15:50:45'),
(35, 1, 35, 'I', '2023-04-18 15:49:54', NULL),
(36, 1, 36, 'I', '2023-04-18 15:50:39', NULL),
(37, 1, 37, 'I', '2023-04-18 15:53:38', NULL),
(38, 1, 38, 'X', '2023-04-18 15:54:50', '2023-04-18 16:58:06'),
(41, 1, 41, 'I', '2023-04-18 21:30:31', NULL),
(42, 1, 42, 'I', '2023-04-24 15:03:29', NULL),
(43, 1, 43, 'I', '2023-04-24 15:26:23', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `USUARIOID` int(11) NOT NULL,
  `NOMBRE` varchar(150) NOT NULL,
  `CORREOLOGIN` varchar(150) NOT NULL,
  `CLAVELOGIN` varchar(250) NOT NULL,
  `CORREOENVIO` varchar(150) NOT NULL,
  `CLAVEENVIO` varchar(250) NOT NULL,
  `RESETCLAVE` char(1) DEFAULT '0',
  `CREACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `ACTUALIZACION` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`USUARIOID`, `NOMBRE`, `CORREOLOGIN`, `CLAVELOGIN`, `CORREOENVIO`, `CLAVEENVIO`, `RESETCLAVE`, `CREACION`, `ACTUALIZACION`) VALUES
(1, 'Elvis Godoy', 'elvis.godoy@ops.com.hn', '15bb41e6147ef05f85106378d29e46ead4256160bec05ef91c7859bf0341d3c09f9cd97b5d8fdd14507656c058a8700df1fe3d6eb9232d09bfaf7eb2366e6cf6', 'elvis.godoy@ops.com.hn', 'p9jTUmCfa2s=', '0', '2023-04-12 22:23:05', '2023-04-24 14:52:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioscorreos`
--

CREATE TABLE `usuarioscorreos` (
  `UCID` int(11) NOT NULL,
  `NGEID` int(11) NOT NULL,
  `USUARIOID` int(11) NOT NULL,
  `CORREOID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarioscorreos`
--

INSERT INTO `usuarioscorreos` (`UCID`, `NGEID`, `USUARIOID`, `CORREOID`) VALUES
(2, 2, 1, 2),
(3, 3, 1, 3),
(4, 4, 1, 4),
(5, 5, 1, 5),
(6, 5, 1, 6),
(7, 6, 1, 7),
(8, 6, 1, 8),
(9, 7, 1, 9),
(10, 7, 1, 10),
(11, 8, 1, 11),
(12, 8, 1, 12),
(13, 9, 1, 13),
(14, 9, 1, 14),
(15, 10, 1, 15),
(16, 10, 1, 16),
(17, 17, 1, 17),
(18, 17, 1, 18),
(19, 18, 1, 19),
(20, 18, 1, 20),
(21, 19, 1, 21),
(22, 19, 1, 22),
(23, 20, 1, 23),
(24, 20, 1, 24),
(25, 27, 1, 25),
(26, 27, 1, 26),
(27, 28, 1, 27),
(28, 28, 1, 28),
(29, 32, 1, 29),
(30, 32, 1, 30),
(31, 33, 1, 31),
(32, 33, 1, 32),
(33, 34, 1, 33),
(34, 34, 1, 34),
(35, 34, 1, 35),
(36, 34, 1, 36),
(37, 34, 1, 37),
(38, 34, 1, 38),
(39, 34, 1, 39),
(40, 34, 1, 40),
(41, 35, 1, 41),
(42, 35, 1, 42),
(43, 35, 1, 43),
(44, 35, 1, 44),
(45, 35, 1, 45),
(46, 35, 1, 46),
(47, 35, 1, 47),
(48, 35, 1, 48),
(49, 36, 1, 49),
(50, 36, 1, 50),
(51, 36, 1, 51),
(52, 36, 1, 52),
(53, 36, 1, 53),
(54, 36, 1, 54),
(55, 36, 1, 55),
(56, 36, 1, 56),
(57, 37, 1, 57),
(58, 37, 1, 58),
(59, 38, 1, 59),
(60, 38, 1, 60),
(61, 38, 1, 61),
(62, 38, 1, 62),
(63, 39, 1, 63),
(64, 39, 1, 64),
(67, 41, 1, 67),
(68, 41, 1, 68),
(69, 42, 1, 69),
(70, 42, 1, 70),
(71, 42, 1, 71),
(72, 42, 1, 72),
(73, 42, 1, 73),
(74, 43, 1, 74),
(75, 43, 1, 75),
(76, 43, 1, 76),
(77, 43, 1, 77),
(78, 43, 1, 78);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `correos`
--
ALTER TABLE `correos`
  ADD PRIMARY KEY (`CORREOID`);

--
-- Indices de la tabla `nombresgruposexcel`
--
ALTER TABLE `nombresgruposexcel`
  ADD PRIMARY KEY (`NGEID`),
  ADD UNIQUE KEY `NOMBRES` (`NOMBRES`),
  ADD KEY `FK_NGE_USUARIOS` (`USUARIOID`);

--
-- Indices de la tabla `solicitudenviarcorreos`
--
ALTER TABLE `solicitudenviarcorreos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`USUARIOID`),
  ADD UNIQUE KEY `CORREOLOGIN` (`CORREOLOGIN`),
  ADD UNIQUE KEY `CORREOENVIO` (`CORREOENVIO`);

--
-- Indices de la tabla `usuarioscorreos`
--
ALTER TABLE `usuarioscorreos`
  ADD PRIMARY KEY (`UCID`),
  ADD KEY `FK_USUARIOCORREOS_NGE` (`NGEID`),
  ADD KEY `FK_USUARIOCORREOS_USUARIOS` (`USUARIOID`),
  ADD KEY `FK_USUARIOCORREOS_CORREOS` (`CORREOID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `correos`
--
ALTER TABLE `correos`
  MODIFY `CORREOID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `nombresgruposexcel`
--
ALTER TABLE `nombresgruposexcel`
  MODIFY `NGEID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `solicitudenviarcorreos`
--
ALTER TABLE `solicitudenviarcorreos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `USUARIOID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarioscorreos`
--
ALTER TABLE `usuarioscorreos`
  MODIFY `UCID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `nombresgruposexcel`
--
ALTER TABLE `nombresgruposexcel`
  ADD CONSTRAINT `FK_NGE_USUARIOS` FOREIGN KEY (`USUARIOID`) REFERENCES `usuarios` (`USUARIOID`);

--
-- Filtros para la tabla `usuarioscorreos`
--
ALTER TABLE `usuarioscorreos`
  ADD CONSTRAINT `FK_USUARIOCORREOS_CORREOS` FOREIGN KEY (`CORREOID`) REFERENCES `correos` (`CORREOID`),
  ADD CONSTRAINT `FK_USUARIOCORREOS_NGE` FOREIGN KEY (`NGEID`) REFERENCES `nombresgruposexcel` (`NGEID`),
  ADD CONSTRAINT `FK_USUARIOCORREOS_USUARIOS` FOREIGN KEY (`USUARIOID`) REFERENCES `usuarios` (`USUARIOID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
