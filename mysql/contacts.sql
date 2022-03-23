-- Author: Tolga Mungan

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
--
-- Database: `contacts`
--
CREATE DATABASE IF NOT EXISTS contacts;
--
-- Table structure for table `contact`
--
DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `emailAddress` varchar(100) NOT NULL,
  `phoneNumber` varchar(14) CHARACTER SET latin1 NOT NULL,
  `birthday` date NOT NULL,
  `streetAddress` varchar(256) NOT NULL,
  `city` varchar(25) NOT NULL,
  `province` varchar(40) NOT NULL,
  `postalCode` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;;
--
-- Table structure for table `user`
--
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `emailAddress` varchar(100) NOT NULL,
  `password` varchar(180) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
--
-- Dumping data for table `contact`
--
INSERT INTO `contact` (`id`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `birthday`, `streetAddress`, `city`, `province`, `postalCode`) VALUES
(1, 'Marcia', 'Pierce', 'vel@Inornare.edu', '1-799-342-9361', '1963-11-22', 'P.O. Box 861 1385 Consequat Rd.', 'Pottsville', 'MB', 'A6U 7T4'),
(2, 'Ivy', 'Kramer', 'aliquet.libero@pedemalesuadavel.org', '1-437-867-1282', '1968-04-12', '346-4462 Suspendisse Ave', 'Nenana', 'NL', 'B1J 8N8'),
(3, 'Fitzgerald', 'Shepard', 'magnis.dis.parturient@Cras.ca', '1-206-777-0595', '1961-03-21', 'P.O. Box 380 5309 Amet Avenue', 'Kennewick', 'ON', 'S5H 2I6'),
(4, 'Amaya', 'Jackson', 'Fusce@utaliquam.ca', '1-762-542-0380', '1974-09-13', 'P.O. Box 121 3581 Purus Avenue', 'Richland', 'MB', 'R2Q 9T6'),
(5, 'Jarrod', 'Huber', 'consectetuer.cursus.et@Praesent.edu', '1-469-899-2702', '1983-05-30', 'P.O. Box 419 4348 Elit. Ave', 'Falls Church', 'MB', 'I5Z 1F4'),
(6, 'Kirestin', 'Mcmahon', 'lacus@mollis.edu', '1-244-146-8495', '1969-08-05', '328-5079 Felis St.', 'Milford', 'BC', 'R5A 9X5'),
(7, 'Julian', 'Ayers', 'sed.consequat@rutrum.org', '1-191-550-8469', '1974-04-29', '7403 Mollis. Av.', 'Kalispell', 'YT', 'Q7J 5O9'),
(8, 'Akeem', 'Mcfadden', 'Integer.tincidunt@sit.org', '1-997-457-2031', '1975-10-28', '271-3230 Porttitor Av.', 'Kalamazoo', 'NT', 'C1P 6X6'),
(9, 'Dana', 'Snow', 'Fusce@nectempus.com', '1-592-165-0075', '1972-08-09', 'Ap #790-6746 Tellus Street', 'Agawam', 'NT', 'L3S 4X9'),
(10, 'Colleen', 'Hutchinson', 'Suspendisse.sagittis.Nullam@Innec.edu', '1-945-606-6717', '1974-09-11', '3896 Nunc Ave', 'Pembroke Pines', 'NT', 'V4M 2J4'),
(11, 'Hyatt', 'Sanchez', 'libero@nislMaecenasmalesuada.edu', '1-483-989-6613', '1972-01-06', 'P.O. Box 922 7698 Sed St.', 'Las Cruces', 'AB', 'M1N 8M9'),
(12, 'Madison', 'Stevenson', 'Donec.consectetuer.mauris@morbi.edu', '1-898-794-3086', '1966-06-14', 'P.O. Box 872 6306 Donec St.', 'Brigham City', 'NT', 'L5K 9L0'),
(13, 'Roanna', 'Downs', 'ac.sem@duinectempus.edu', '1-969-912-9999', '1967-10-30', '7691 Rhoncus Av.', 'Warwick', 'NB', 'S2X 6Q9'),
(14, 'Isaiah', 'Stevens', 'fringilla.porttitor.vulputate@malesuadaIntegerid.ca', '1-918-821-7207', '1956-08-25', '6132 Erat Road', 'Gatlinburg', 'BC', 'U5T 4D6'),
(15, 'Sonia', 'Ayers', 'lectus@acmi.ca', '1-598-429-1498', '1971-10-31', 'Ap #990-5463 Maecenas St.', 'Rosemead', 'NL', 'W2Z 1U8'),
(16, 'Alexis', 'Gilmore', 'mauris.sit.amet@penatibuset.org', '1-886-188-5867', '1977-10-25', 'Ap #412-1054 Nonummy Street', 'Temecula', 'PE', 'W6S 6L7'),
(17, 'Zoe', 'England', 'auctor.Mauris@nonlobortisquis.edu', '1-663-558-3161', '1976-12-03', '279-4028 Erat. Rd.', 'Beverly', 'QC', 'M8P 9P6'),
(18, 'Charde', 'Dunn', 'urna@sem.edu', '1-357-831-9923', '1976-04-16', '304-5920 Tellus Rd.', 'Chesapeake', 'NL', 'F2N 8T7'),
(19, 'Avye', 'Barron', 'Nullam@ligulaAeneangravida.com', '1-388-698-5126', '1974-05-07', 'Ap #915-7949 Donec Rd.', 'West Allis', 'NT', 'P9Z 4R0'),
(20, 'Hamish', 'Taylor', 'auctor.odio.a@duinec.ca', '1-924-809-0362', '1982-10-05', 'Ap #125-7692 Duis Av.', 'Caguas', 'NT', 'K9B 1Z4'),
(21, 'Wesley', 'Todd', 'arcu.Vestibulum@nostra.ca', '1-647-738-0019', '1980-05-31', '7226 Diam Avenue', 'Bellflower', 'NT', 'V6V 8O2'),
(22, 'Samson', 'Huber', 'tincidunt@laoreetlectusquis.ca', '1-922-760-7616', '1966-12-12', '4685 Vitae Road', 'Kennesaw', 'NB', 'D7B 1F3'),
(23, 'Samson', 'Ochoa', 'risus.Donec@arcu.ca', '1-309-979-6313', '1967-05-28', '3081 Iaculis Road', 'San Clemente', 'MB', 'H1C 3I4'),
(24, 'Blair', 'Yang', 'Mauris.quis.turpis@metusfacilisis.edu', '1-619-688-2205', '1982-11-30', '7557 Eu St.', 'Thousand Oaks', 'BC', 'L3Z 7O4'),
(25, 'Roary', 'Martin', 'et.ipsum.cursus@Morbiquisurna.org', '1-194-683-8143', '1960-07-18', 'Ap #261-7127 Lectus Av.', 'Sioux Falls', 'NL', 'P6Z 2A7'),
(26, 'Owen', 'Boyer', 'lacus.varius@urnasuscipit.com', '1-727-655-7997', '1982-11-08', '967-7532 Molestie. Avenue', 'Somerville', 'NU', 'F9Q 3T3'),
(27, 'Forrest', 'Landry', 'Aliquam.nec@Vestibulumanteipsum.com', '1-601-259-0565', '1966-06-07', '529-760 Primis Street', 'Turlock', 'NS', 'M2J 3M6'),
(28, 'Palmer', 'Barrera', 'Donec.consectetuer@nuncullamcorpereu.com', '1-781-382-8482', '1970-04-25', '2655 Augue Street', 'Cleveland', 'NL', 'U9Q 1J3'),
(29, 'Piper', 'Higgins', 'ut.pellentesque@Nullamenim.org', '1-165-448-1964', '1971-06-03', '866-9924 Magna. Av.', 'Rye', 'ON', 'N9P 9G3'),
(30, 'Ferris', 'Ferrell', 'fringilla.ornare@Phasellusat.com', '1-986-568-4320', '1957-02-11', 'P.O. Box 453 3973 Nulla Rd.', 'Racine', 'ON', 'P5D 8W4'),
(31, 'Bryar', 'Steele', 'ut.nulla@mollis.ca', '1-473-168-3889', '1972-10-29', 'P.O. Box 216 6350 In Avenue', 'Valparaiso', 'BC', 'Q1J 5M5'),
(32, 'Haley', 'Small', 'semper.et.lacinia@velit.edu', '1-379-952-7322', '1971-10-05', 'P.O. Box 653 8648 Dolor. Avenue', 'Fontana', 'NS', 'N7L 1H8'),
(33, 'Sonia', 'Marquez', 'ante.Nunc@pharetra.org', '1-574-102-4243', '1964-07-10', 'P.O. Box 832 2365 Pede. Avenue', 'Paducah', 'MB', 'Z6F 3K0'),
(34, 'Robert', 'Tyson', 'auctor.nunc@Sedeu.org', '1-829-944-2978', '1964-11-04', 'Ap #738-9722 Lobortis Street', 'Port St. Lucie', 'SK', 'L4Y 8L7'),
(35, 'Pascale', 'Flowers', 'sodales.elit@rhoncus.com', '1-172-514-4820', '1978-01-06', '3950 In Av.', 'Mission Viejo', 'SK', 'H9E 2J9'),
(36, 'Sophia', 'Nixon', 'sed@ametnullaDonec.org', '1-958-472-8658', '1960-05-11', 'Ap #810-427 Tincidunt Rd.', 'Jersey City', 'NL', 'H5W 6K7'),
(37, 'Ferris', 'Gonzalez', 'tortor.nibh@posuerevulputate.ca', '1-317-146-6049', '1983-01-12', 'Ap #124-9508 Posuere Rd.', 'Alhambra', 'NL', 'U5Y 2G2');
--
-- Dumping data for table `user`
--
INSERT INTO `user` (`id`, `firstName`, `lastName`, `emailAddress`, `password`) VALUES
(1, 'Matt', 'Redmond', 'matt@redmond.com', '$2y$10$S.jDL8E6QGzEUW9h38ifguV5tz52oDO9WsZVqXtv6fdTwmQU5/m5e'), /*pw:password*/
(2, 'user', 'one', 'user@one.com', '$2y$10$nTINNtFUT8Tey9qID0JsO.Kt1RlicrYJrqdrVfYjjTfcYwV3502pq');/*pw:password*/
COMMIT;


