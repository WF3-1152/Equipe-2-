-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 26 nov. 2021 à 09:17
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `manga`
--

-- --------------------------------------------------------

--
-- Structure de la table `manga`
--

CREATE TABLE `manga` (
  `id` tinyint(4) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(60) NOT NULL,
  `description` varchar(6000) NOT NULL,
  `publish_date` date NOT NULL,
  `cover` varchar(250) NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `promote` tinyint(1) NOT NULL,
  `category` varchar(35) NOT NULL,
  `stock` int(11) NOT NULL,
  `avis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `manga`
--

INSERT INTO `manga` (`id`, `title`, `author`, `description`, `publish_date`, `cover`, `price`, `promote`, `category`, `stock`, `avis`) VALUES
(7, 'One Piece : Tome 63 - Otohime et Tiger', 'Eiichiro Odo', 'Sur l’île des hommes-poissons, Luffy a rencontré la princesse Shirahoshi, consignée dans la tour de nacre depuis des années afin d’échapper aux attaques de Vander Decken, son prétendant. Cependant, la princesse rêve de voir le monde extérieur… Il n’en fallait pas plus pour que Luffy l’entraîne hors de la tour, juste au moment où Vander Decken part à l’assaut du palais !', '2012-07-04', 'onepiece_tome63.jpg', '6.95', 0, 'shonen', 10, ''),
(9, 'One Piece : Tome 64 - 100000 vs 10', 'Eiichiro Odo', 'Les habitants de l’île des hommes-poissons se rapprochent petit à petit de cet idéal de paix avec les hommes que leur a légué leur défunte reine.  Mais Hody Jones et le nouvel équipage des hommes-poissons comptent bien briser ce rêve !! Luffy et son équipage, entraînés dans cette affaire, se lancent dans une lutte acharnée sur l’île !!', '2012-10-03', 'onepiece_tome64.jpeg', '6.95', 1, 'shonen', 5, ''),
(10, 'One Piece : Tome 65 - Table rase', 'Eiichiro Odo', 'L’équipage de Chapeau de paille tente d’empêcher le pirate Hody Jones, capitaine du nouvel équipage des hommes-poissons, de s’emparer de l’île. Mais, durant son combat sous-marin contre Luffy, Hody commet un nouveau crime atroce ! C’est maintenant l’existence même de l’île des hommes-poissons qui est menacée par ce nouveau péril !!', '2013-01-03', 'onepiece_tome65.jpg', '6.95', 1, 'shonen', 25, ''),
(21, 'One Piece : Tome 04 - Attaque au clair de lune', 'Eiichiro Odo', 'Des pirates projettent d’attaquer le paisible village d’Usopp ! Ni une, ni deux, Luffy et ses amis décident de piéger la plage et d’attendre ces derniers de pied ferme. Mais le temps passe et les pirates ne se montrent toujours pas, quand soudain… ils distinguent des cris provenant d’une direction opposée ?!', '2021-11-05', 'onepiece_tome4.jpg', '6.95', 1, 'shonen', 3, ''),
(25, 'One Piece : 01 - À l\'aube d\'une grande aventure', 'Eiichiro Odo', 'Le roi des pirates, ce sera lui !\r\n\r\nNous sommes à l\'ère des pirates. Luffy, un garçon espiègle, rêve de devenir le roi des pirates en trouvant le “One Piece”, un fabuleux trésor. Seulement, Luffy a avalé un fruit du démon qui l\'a transformé en homme élastique. Depuis, il est capable de contorsionner son corps dans tous les sens, mais il a perdu la faculté de nager. Avec l\'aide de ses précieux amis, il va devoir affronter de redoutables pirates dans des aventures toujours plus rocambolesques.\r\nÉgalement adapté en dessin animé pour la télévision et le cinéma, One Piece remporte un formidable succès à travers le monde. Les aventures de Luffy au chapeau de paille ont désormais gagné tous les lecteurs, qui se passionnent chaque trimestre pour les aventures exceptionnelles de leurs héros.', '2013-07-03', 'onepiece_tome1.jpg', '6.90', 1, 'shonen', 2, ''),
(26, 'One piece : 02 - Luffy Vs la bande à Baggy !!', 'Eiichiro Odo', 'Luffy fait la connaissance de Nami, une ravissante jeune fille maîtrisant la navigation. Seulement, Nami déteste les pirates et refuse d’entrer dans son équipage. Pire, elle fait prisonnier Luffy, pour le livrer au terrible… Baggy le clown !', '2013-09-03', 'onepiece_tome2.jpg', '6.90', 0, 'shonen', 1, ''),
(28, 'Goblin Slayer - tome 01', 'Kumo Kagyu', '\" Je ne sauve pas le monde. Je ne fais que tuer des gobelins. \"\r\nLa jeune Prêtresse fraîchement devenue aventurière découvre, dès sa première mission, à quel point des monstres aussi faibles que des gobelins peuvent représenter une menace effrayante. Heureusement, un homme en armure se décrivant comme le Goblin Slayer - un crève-gobelins - fait son apparition et abat un par un, sans aucune pitié, tous les gobelins qui lui font face pour la tirer de cette mauvaise posture.', '2018-07-13', 'goblin_slayer_tome1.jpg', '7.65', 1, 'Seinen', 8, ''),
(29, 'Gantz :E - Tome 1', 'Hiroya Oku / Jin Kagetsu', 'Hanbe, un paysan, demande O-Haru en mariage, mais celle-ci lui répond qu\'elle en aime un autre, Masakichi. Hanbe rencontre Masakichi et découvre qu\'il sait magner le sabre malgré sa condition de paysan. Alors qu\'ils s\'affrontent, une jeune fille se noie. Les deux hommes meurent en tentant de la sauver. Ils se retrouvent alors dans une salle Gantz.', '2021-09-01', 'gantzE_tome1.jpg', '7.99', 1, 'Seinen', 20, ''),
(30, 'Dragon Ball perfect edition - Tome 01', 'Akira Toriyama', 'Dans un monde fantastique semblable à la Terre et peuplé de créatures plus étranges les unes que les autres, un petit garçon à la force herculéenne et doté d’une queue de singe croise un jour la route d’une jeune fi lle. Celle-ci s’est lancée à la recherche de sept mystérieuses boules de cristal. Car il est dit que quiconque les réunira pourra appeler le dragon sacré et exaucer son voeu le plus cher.En chemin, ce duo d’aventuriers peu commun se heurte à un cochon transformiste usant de ses dons pour kidnapper les jeunes fi lles d’un village, puis à un vagabond solitaire adepte des arts martiaux que la simple vue d’une jeune femme suffi t à tétaniser sur place. Ce n’est que le début d’une grande aventure riche en péripéties, en humour et en combats extraordinaires…Enfin la voilà, l’édition « ultime » de Dragon Ball que tous attendaient ! Pour la première fois, le manga culte d’Akira Toriyama (le manga le plus lu et vendu dans le monde) est présenté dans les meilleures conditions de lecture. Un grand format qui met en valeur chaque planche, un papier de qualité, une illustration de jaquette inédite et somptueuse. La traduction sera améliorée et encore plus fi dèle au texte original. Enfi n, la présence de toutes les planches réalisées à l’époque en couleurs, inédites en France ! L’événement éditorial de l’année, alors que sort début 2009 l’adaptation en fi lm live de Dragon Ball qui ne va pas manquer de faire l’actualité.', '2009-02-18', 'dragon_ball_tome1.jpeg', '10.75', 1, 'shonen', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` tinyint(4) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `role` varchar(250) NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `role`) VALUES
(1, 'admin', 'Admin31#', 'admin@admin.com', 'admin'),
(11, 'olivier', '123456aA', 'olivier@hotmail.fr', 'admin'),
(13, '123456aA', '123456aA', 'moi@hotmail.fr', 'member'),
(14, 'sandrix', '123456Aa', 'sandra@hotmail.fr', 'member');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `manga`
--
ALTER TABLE `manga`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
