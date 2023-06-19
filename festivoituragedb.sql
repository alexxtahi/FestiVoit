CREATE DATABASE `festivoituragedb`;
USE `festivoituragedb`;
CREATE TABLE `typeUser` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nomType` varchar(15) NOT NULL
);
CREATE TABLE `user` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `hashMdp` varchar(255) NOT NULL,
  `typeUserId` int NOT NULL DEFAULT(3),
  FOREIGN KEY (`typeUserId`) REFERENCES `typeUser` (`id`)
);
CREATE TABLE `festival` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nomFestival` varchar(255) NOT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  `localisation` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
);
CREATE TABLE `annonce` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `typeVehicule` varchar(255) NOT NULL,
  `placeVehicule` int NOT NULL,
  `dateAller` datetime NOT NULL,
  `dateRetour` datetime DEFAULT NULL,
  `userId` int NOT NULL,
  `festivalId` int NOT NULL,
  FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  FOREIGN KEY (`festivalId`) REFERENCES `festival` (`id`)
);
CREATE TABLE `participate` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `annonceId` int NOT NULL,
  `userId` int NOT NULL,
  FOREIGN KEY (`annonceId`) REFERENCES `annonce` (`id`),
  FOREIGN KEY (`userId`) REFERENCES `user` (`id`)
);
-- Insertions dans la base --
INSERT INTO `typeUser` (`id`, `nomType`)
VALUES (1, "Admin"),
  (2, "Chauffeur"),
  (3, "Festivalier");
INSERT INTO `festival` (
    `id`,
    `nomFestival`,
    `dateDebut`,
    `dateFin`,
    `localisation`,
    `photo`
  )
VALUES (
    NULL,
    'Festival de la musique',
    '2023-06-19 00:08:39.000000',
    '2023-06-21 02:08:40',
    'Marché emblématique de Rennes',
    'zaza.png'
  );