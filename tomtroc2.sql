-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 18 mai 2026 à 19:03
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tomtroc2`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `picture` varchar(100) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `user_id`, `title`, `author`, `description`, `picture`, `available`) VALUES
(1, 1, 'Esther', 'Alabaster', 'The Book of Esther: Un livre curieux et passionnant sur l\'expérience de Dieu à l\'œuvre au milieu des rencontres fortuites, du destin et de la providence divine.\r\n\r\nLa beauté de la Bible. Images visuelles et conception réfléchie intégrées au texte de la Bible. Des images qui éclairent les thèmes et les messages du texte aideront le lecteur à interagir avec les Écritures d\'une nouvelle manière. Utilisation judicieuse de l\'espace, police des caractères facilitant la lecture et mise en page permettant une exploration réfléchie entre le texte et les images. Imprimé sur du papier de haute qualité pour une expérience belle au regard et au toucher.', 'https://biblescanada.com/cdn/shop/files/301221117.png?v=1709137371&width=640', 0),
(2, 3, 'Les Secrets de la femme de ménage', 'Mcfadden Freida', 'Avec ce nouvel emploi, Millie semble avoir une chance en or. Chez les Garrick, un couple fortuné qui possède un somptueux appartement avec vue sur Manhattan, elle fait le ménage et prépare les repas dans la magnifique cuisine. Mais elle ne tarde pas à déceler quelques ombres au tableau... Son patron, Douglas Garrick, est d\'humeur de plus en plus changeante. Et pourquoi sa femme Wendy reste-t-elle toujours enfermée dans la chambre d\'amis ? Le jour où Millie découvre du sang sur une chemise de nuit, elle ne peut plus rester les bras croisés. Quelque chose se trame dans cette maison. Et cela pourrait bien se retourner contre elle si elle continue à fouiner dans les secrets des autres...', 'https://cdn.cultura.com/cdn-cgi/image/width=1280/media/pim/TITELIVE/8_9782290391198_1_75.jpg', 1),
(3, 2, 'Occidents: Enquête sur nos ennemis', 'Frédéric Martel', 'L\'Occident et ses ennemis : la Russie, la Chine, l\'islamisme... et l\'Amérique de Trump.\r\nUne guerre mondiale des idées se déroule sous nos yeux. Mais nous n\'avons pas encore compris qu\'elle visait nos valeurs : démocratie, pluralisme, droits de l\'homme, liberté d\'expression. De Moscou à Beijing, de Caracas à Téhéran, nos ennemis entendent défaire l\'Europe et détruire l\'Occident.\r\nPour mieux identifier cette menace, le journaliste et chercheur Frédéric Martel est allé partout, sur le terrain, \" au contact \" des intellectuels de Xi Jinping, des idéologues de Poutine, des propagandistes du Hamas – mais aussi des conseillers de Donald Trump. Au cours d\'une enquête de huit années, menée dans cinquante-deux pays, il a interviewé près de deux mille protagonistes, témoins ou acteurs, du nouveau chaos mondial.\r\nCe livre hors norme dévoile l\'envers de notre histoire contemporaine. Il raconte le grand renversement idéologique de notre époque, marquée par son obsession contre l\'\" Occident \". Rejeté par ceux qui, comme la Chine ou l\'Iran, veulent l\'anéantir ; glorifié par les populistes russes, hongrois, américains ou brésiliens, qui prétendent l\'exalter. Il n\'y a plus un Occident, mais des \" Occidents \" – projetés, fantasmés, souvent contradictoires. Au bout du compte, ceux qui veulent \" plus \" d\'Occident rejoignent ceux qui en veulent \" moins \" : une convergence des extrêmes et, dans les deux cas, une même illusion. Une même pathologie.\r\nGrande fresque intellectuelle, ce récit, nourri de centaines de portraits et de témoignages, fait vaciller nos repères et illustre une thèse forte : la critique des valeurs universelles est un mirage ; elles doivent être défendues car elles sont les seules à pouvoir calmer le bruit et la fureur du monde. Et en cherchant à expliquer l\'\" Occident \" par les haines qu\'il suscite, l\'auteur finit, au terme de cette enquête exceptionnelle, par nous éclairer sur ce que nous sommes.', 'https://m.media-amazon.com/images/I/51+oMPjnc5L._SL1303_.jpg', 1),
(4, 3, 'Elden ring become lord - Tome 1', '21g', 'Un Sans-éclat se réveille dans le royaume de Nécrolimbe, en Entre-Terre. Guidé par la grâce et lié par un pacte avec la mystérieuse Melina, il se lance dans une quête périlleuse pour reconstituer le légendaire Cercle d\'Elden et ainsi prétendre au titre de Seigneur d\'Elden. En chemin, il rencontrera de précieux alliés, mais devra aussi faire face à de nombreux et puissants ennemis : Margit le Déchu, Morgott le Roi des Réprouvés, Godrick le Greffé...?? (Re)vivez l\'aventure épique du jeu Elden Ring dans une version manga entièrement colorisée !', 'https://m.media-amazon.com/images/I/81h0bV7arKL._SL1500_.jpg', 0),
(5, 2, 'Le Petit Prince', 'Antoine de Saint-Exupéry', 'Pour ses 80 ans, le Petit Prince débarque sur la planète MinaLima! Une édition exceptionnelle et interactive.\r\nMinaLima réimagine le livre culte d\'Antoine de Saint-Exupéry dans sa patte colorée et inventive. À travers une centaine d\'illustrations et huit animations, les lecteurs suivent le Petit Prince de planète en planète, font éclore sa rose, comptent les couchers de soleil, philosophent avec le renard, arpentent le désert, et rêvent plus fort encore.', 'https://m.media-amazon.com/images/I/91jHhhNKQ5L._SL1500_.jpg', 0),
(6, 3, 'Le Médecin malgré lui', 'Molière', 'Martine a décidé de se venger de Sganarelle, son vaurien de mari ! Les circonstances vont lui offrir une occasion bien tentante : le faire passer pour un médecin – malgré lui !\r\nLa vengeance de Martine s’accomplira-t-elle ? Comment Sganarelle réussira-t-il à se tirer de cette situation ?', 'https://m.media-amazon.com/images/I/71wNY1nm6yL._SL1500_.jpg', 1),
(7, 1, 'MA REVANCHE: une voix qui refuse de se taire', 'Charlotte Deseigne', 'Je m’appelle Charlotte. J’ai quinze ans.\r\nJe ne peux pas contrôler les regards. Je ne peux pas faire taire les commentaires. Mais ma voix, elle, m’appartient.\r\n\r\nAvant la lumière des projecteurs, il y a eu le cancer. Un rhabdomyosarcome. Des opérations lourdes. Une mâchoire marquée par la maladie. Puis il y a eu les regards. Les moqueries au collège. Le harcèlement scolaire. Et plus tard, le cyberharcèlement après mon passage à The Voice Kids.\r\n\r\nEn 2025, je remporte la finale de The Voice Kids grâce au vote du public. Mais la victoire n’efface pas les blessures. Elle en révèle d’autres.', 'https://m.media-amazon.com/images/I/61X9wFka4JL._SL1500_.jpg', 1),
(8, 2, 'Mushoku Tensei - vol. 23', 'RIFUJIN NA MAGONOTE', 'En route pour le labyrinthe de téléportation ! Nous jurons de sauver celles qui nous sont chères ! Roxy se perd dans le labyrinthe de téléportation et se retrouve coincée près d\'un nid de monstres. Elle cherche désespérément un moyen de s\'échapper, mais elle s\'affaiblit de jour en jour... Pendant ce temps, Rudeus pénètre dans le labyrinthe avec Paul et ses autres compagnons pour sauver sa maîtresse. Bien qu\'il soit angoissé à l\'idée d\'explorer un labyrinthe pour la première fois, il ne se laisse pas décourager. Et rapidement, le groupe atteint le troisième niveau du dédale, où Roxy avait disparu lors de leur malencontreuse expédition !', 'https://m.media-amazon.com/images/I/710CXvP2uwL._SL1500_.jpg', 1),
(9, 3, 'Toi, moi, elle', 'Sue Watson', 'Un mariage. Trois personnes. Un meurtre.\r\n\r\nTOI : Mon beau mari Tom. Tu m’as tout donné – notre fils magnifique et notre nouvelle maison parfaite en bord de mer. Je veux te faire confiance, mais je sais que tu n’as pas été honnête sur les raisons qui t’ont poussé à venir vivre ici. Je n’ai pas été honnête avec toi non plus…\r\n\r\nMOI : Je me fais une promesse tandis que Tom m’embrasse et me verse un verre de vin bien frais pour porter un toast à notre première nuit dans la maison de nos rêves : je vais oublier son passé. Pour le bien de notre fils, je maintiendrai cette famille unie, quoi qu’il arrive.\r\n\r\nELLE : Chloé est la seule amie que je me sois faite depuis le déménagement. J’adore nos longs déjeuners, même si elle pose des questions indiscrètes sur mon couple. Tom déteste que je passe du temps avec elle, mais je ne tiens pas compte de son avis quand il me conseille de garder mes distances. J’ai vu la façon dont il la regarde. Moi je trouve qu’il vaut mieux avoir ses ennemis sous les yeux…\r\n\r\nVous pensez peut-être savoir ce qui se passe dans mon mariage, mais vous vous trompez. Seules trois choses sont vraies :\r\nQuelqu’un ment.\r\nQuelqu’un est en danger.\r\nQuelqu’un est un tueur.\r\n\r\nLes fans de La Femme de ménage, Le Mariage parfait et La Fille du train adoreront ce thriller psychologique absolument époustouflant. Avec des rebondissements à n’en plus finir, vous ne pourrez plus lâcher ce livre !', 'https://m.media-amazon.com/images/I/71CKCQI5YRL._SL1500_.jpg', 1),
(10, 2, 'Virginité Volée', 'Dark Flower', 'Que feriez-vous si votre première fois était volée par un homme qui vous a confondue avec une autre femme ?\r\nQue feriez-vous si ce richissime charmant diable était le meilleur ami de votre grand-frère ?\r\nEn quelques minutes seulement, j\'ai appris à haïr l\'homme que j\'aimais en secret.\r\nMon plus beau cauchemar ne faisait que commencer.\r\n\r\n\r\nLe Charmant Diable\r\n\r\nElle pense que je lui ai \"pris\" sa virginité ce jour-là, après mon retour à Boston.\r\nElle ignore tout de la Vérité.\r\nMais j\'ignorais également tout de mon obsession pour elle...', 'https://m.media-amazon.com/images/I/61JAt1d2nhL._SL1500_.jpg', 1),
(11, 1, 'Ils n\'ont rien vu', 'Andrea Mara', 'Deux enfants montent dans le métro. Un seul en descend...\r\n\r\nUn thriller aux allures de montagnes russes, par la romancière n°1 des ventes au Royaume-Uni, et lauréate de l’An Post Award du meilleur roman policier irlandais.\r\n\r\nImaginez : vous êtes sur le quai du métro londonien, à l’heure de pointe. Vos filles de 2 et 6 ans sont devant vous et montent dans le wagon qui vient d’arriver. Mais alors que vous tentez de les rejoindre en traversant la foule, les portes se referment. Le métro s’éloigne, vous laissant seule sur le quai. Vous atteignez l’arrêt suivant, persuadée que vos enfants ont été prises en charge par la sécurité. Quand vous arrivez, on ne vous rend pas vos deux filles, mais seulement votre cadette : celle de deux ans, à peine capable de parler. Votre fille aînée s’est-elle perdue ? A-t-elle été enlevée par un inconnu ? Le coupable est-il plus proche de vous que vous ne l’imaginez ? Vous le savez, autour de vous, tout le monde ment. Et plus les recherches avancent, plus la vérité vous échappe.', 'https://m.media-amazon.com/images/I/81r5FvdN14L._SL1500_.jpg', 1),
(12, 2, 'Signé (Veux-Tu M\'épouser? t. 1)', 'Cassidy Vale', 'J\'avais une énorme bague en diamant à mon doigt.\r\n\r\nUn majordome entra dans la chambre et demanda :\r\n\r\n« Bonjour Madame Ashford, puis-je vous apporter quelque chose pour le petit-déjeuner ? Café ou thé ? »\r\n\r\nJe secouai lentement la tête, parce que ce n\'est PAS mon nom de famille.\r\n\r\nPuis je me retourne et je vois un certificat de mariage que j\'ai signé, posé sur la table de nuit.\r\n\r\nSoudain, la porte de la salle de bain s\'ouvrit brusquement, et le meilleur ami de mon frère en sortit, une serviette nouée bas autour de ses hanches.\r\n\r\nIl s\'appuya contre le chambranle, une main agrippant la serviette, et gronda :\r\n\r\n« Vous avez bien dormi, Madame Ashford ? »', 'https://m.media-amazon.com/images/I/81B4Im4wXoL._SL1500_.jpg', 1),
(13, 2, 'Elle est à nous', 'Sara Fields', 'Quand nous la partagerons, elle saura ce que cela signifie d\'être à nous.\r\n \r\nKara Lennox pensait qu\'il serait facile d\'infiltrer la Bratva Markov. Il lui suffisait de séduire l\'un de mes frères, d\'obtenir les informations qu\'elle recherchait et de s\'enfuir. Elle ne s\'attendait pas à être traquée.\r\n \r\nNi d\'être emmenée, déshabillée et sauvagement prise à tour de rôle par chacun d\'entre nous.\r\n \r\nMais ce n\'est pas parce que nous l\'avons fait supplier, gémir et jouir si fort qu\'elle hurle à chaque coup brutal et à chaque orgasme que nous en avons fini avec elle.\r\n \r\nElle est désormais à nous, et nous la partagerons.', 'https://m.media-amazon.com/images/I/71F1FWfXeBL._SL1500_.jpg', 1),
(14, 3, 'L’Empreinte de l’ombre (La Bratva Izotov t. 1)', 'Nicole Fox', 'Entre Cinquante nuances de Grey et The Bear, Nicole Fox, autrice à succès sur Amazon, nous livre une idylle de bureau saupoudrée de romance mafieuse.\r\n\r\nJ’ai voulu démissionner.\r\nMon patron a refusé.\r\n\r\nQuand on bosse pour le restaurateur milliardaire Bastian Hale, chaque jour est un test d’endurance.\r\nIl vous crie dessus devant la moitié du personnel ? Vous subissez.\r\nIl anéantit votre travail et vous demande de tout recommencer ? Vous endurez.\r\nVous le surprenez torse nu au bureau tard le soir ? Vous souffrez en silence… avant de rentrer chez vous, morte de honte.\r\n\r\nJ’ai supporté Bastian Hale pendant six ans.\r\nJe suis capable de tout surmonter.\r\nJusqu’à ce que mon médecin m’annonce que je vais perdre la vue dans 90 jours.\r\n\r\nSoudain, il n’est plus question de subir.\r\nL’objectif, c’est de vivre.\r\nJ’ai envie de capter tout ce que je peux, avant que la lumière ne s’éteigne pour toujours.\r\nPar conséquent, je dois quitter ce boulot qui m’a volé toute ma vie d’adulte.\r\n\r\nIl y a juste un léger problème…\r\nBastian n’accepte pas ma démission.\r\n\r\nIl déchire ma lettre…\r\nIl me propose un million de dollars pour rester…\r\nEt il me promet de rendre mes 90 derniers jours mémorables.\r\n\r\nCe type est arrogant. Violent. Aussi froid qu’un congélateur.\r\nMais ses mains m’embrasent.\r\nEt, dans le noir, il me fait découvrir des choses que mes yeux n’ont jamais pu m’apprendre.\r\n\r\nJe voulais voir la lumière une dernière fois.\r\nJ’ai plutôt goûté à l’obscurité.\r\n\r\nL’EMPREINTE DE L’OMBRE est le premier tome consacré à l’histoire de Bastian et d’Eliana. Leur romance se termine dans le deuxième, L’EMPREINTE DE LA LUMIÈRE.', 'https://m.media-amazon.com/images/I/818d7XtdzuL._SL1500_.jpg', 1),
(15, 1, 'Le drôle de Noël de Scrooge', 'Charles Dickens', 'Le soir de Noël, un vieil homme égoïste et solitaire choisit de passer la soirée seul. Mais les esprits de Noël en ont décidé autrement. L’entraînant tour à tour dans son passé, son présent, et son futur, les trois spectres lui montrent ce que sera son avenir s’il persiste à ignorer que le bonheur existe, même dans le quotidien le plus ordinaire.', 'https://m.media-amazon.com/images/I/8138p1-SZHL._SL1500_.jpg', 1),
(16, 1, 'Héroïnes de la mythologie - Pénélope, la femme aux mille ruses', 'Isabelle Pandazopoulos', '', 'https://m.media-amazon.com/images/I/81T7PesXsbL._SL1500_.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `last_message` text NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `unread_user1` tinyint(1) NOT NULL DEFAULT 0,
  `unread_user2` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`id`, `user1_id`, `user2_id`, `last_message`, `date_creation`, `date_update`, `unread_user1`, `unread_user2`) VALUES
(1, 1, 2, 'Salut', '2026-05-05 14:33:14', '2026-05-05 14:33:14', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `content`, `date_creation`) VALUES
(1, 1, 1, 'Salut', '2026-04-28 17:03:43');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pass_word` varchar(100) NOT NULL,
  `date_creation` datetime NOT NULL,
  `picture` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `pass_word`, `date_creation`, `picture`) VALUES
(1, 'LaurentCnng', 'laurent.canonge@hotmail.fr', '$2y$10$kPxj7OR7ijdhANhS16aL6Oy2tN4MumrS2/MibDZJUIJWjleZRvC9K', '2026-04-01 20:36:51', 'https://preview.redd.it/a-render-of-a-custom-geth-v0-xvh7l2zn7h191.jpg?width=1080&crop=smart&auto=webp&s=b217e94ddef67b6034f5c24c6a8f2ac60fe7dcaf'),
(2, 'Annie', 'annie.leonart@paradis.at', '$2y$10$kPxj7OR7ijdhANhS16aL6Oy2tN4MumrS2/MibDZJUIJWjleZRvC9K', '2026-04-27 16:28:54', 'https://static.wikia.nocookie.net/inconsistently-heinous/images/9/91/Annie_854.png/revision/latest?cb=20230410214334'),
(3, 'Kratos', 'kratos@olympe.gr', '$2y$10$r3Xk5J2HGgOLBj8TN02GNOowFl3YLovjBdOyZxEyaj0QoaUz5UpJ.', '2026-04-07 15:09:51', 'https://www.tryagame.fr/wp-content/uploads/2017/08/god-of-war-plus-brutal.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user1` (`user1_id`),
  ADD KEY `fk_user2` (`user2_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`sender_id`),
  ADD KEY `fk_conversation` (`conversation_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE NO ACTION;

--
-- Contraintes pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `fk_user1` FOREIGN KEY (`user1_id`) REFERENCES `users` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user2` FOREIGN KEY (`user2_id`) REFERENCES `users` (`id`) ON UPDATE NO ACTION;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_conversation` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
