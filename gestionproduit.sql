DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int NOT NULL AUTO_INCREMENT,
  `denomination` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`idCategorie`)
) ENGINE=MyISAM AUTO_INCREMENT=5;


INSERT INTO `categorie` (`idCategorie`, `denomination`, `description`) VALUES
(1, 'Camera', 'Camera'),
(2, 'Casque', 'Casque'),
(3, 'Clavier', 'Clavier'),
(4, 'Souris', 'Souris');


DROP TABLE IF EXISTS `compteproprietaire`;
CREATE TABLE IF NOT EXISTS `compteproprietaire` (
  `loginProp` varchar(191) NOT NULL,
  `motPasse` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`loginProp`)
) ;


INSERT INTO `compteproprietaire` (`loginProp`, `motPasse`, `nom`, `prenom`) VALUES
('lahcen', 'ezzara', 'Ezzara', 'Lahcen');


DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `reference` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) DEFAULT NULL,
  `prixUnitaire` int DEFAULT NULL,
  `dateAchat` date DEFAULT NULL,
  `photoProduit` varchar(255) DEFAULT NULL,
  `idCategorie` int DEFAULT NULL,
  PRIMARY KEY (`reference`),
  KEY `idCategorie` (`idCategorie`)
) ENGINE=MyISAM AUTO_INCREMENT=17;


INSERT INTO `produit` (`reference`, `libelle`, `prixUnitaire`, `dateAchat`, `photoProduit`, `idCategorie`) VALUES
(1, 'BRIO STREAM 3', 160, '2023-11-20', 'cam1', 1),
(2, 'AUKEY Webcam', 400, '2023-11-15', 'cam2', 1),
(3, 'Casque Apple AirPods Max', 600, '2023-11-13', 'csq1', 2),
(4, 'Logitech G213 Prodigy', 500, '2023-11-17', 'clv1', 3),
(5, 'Souris Gaming Logitech G502 Hero Noir\r\n', 580, '2023-11-12', 'sour1', 4),
(6, 'Casque Gaming HyperX Cloud', 390, '2023-11-13', 'csq2', 2),
(7, 'KLIM Aim Souris Gamer RGB 7000 DPI', 450, '2023-11-17', 'sour2', 4),
(8, 'Clavier Gaming filaire Razer', 690, '2023-11-10', 'clv2', 3),
(9, 'AverMedia Live Streamer CAM 513', 350, '2023-11-20', 'cam3', 1),
(10, 'Casque hi-fi fermé circum-aural', 340, '2023-11-23', 'csq3', 2),
(11, 'FELiCON AK33', 600, '2023-11-18', 'clv3', 3),
(12, 'Logitech Streamcam Webcam', 250, '2023-11-27', 'cam4', 1),
(13, 'Casque audio Focal Celestee', 840, '2023-11-19', 'csq4', 2),
(14, 'Souris sans fil Logitech M220 Silent Noir', 840, '2023-11-25', 'sour3', 4),
(15, 'Corsair K68 Red LED ', 140, '2023-11-24', 'clv4', 3),
(16, 'Souris Logitech M236 Argent', 240, '2023-11-22', 'sour4', 4);
COMMIT;
