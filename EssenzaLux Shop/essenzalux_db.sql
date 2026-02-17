-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 20 mai 2025 à 22:58
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
-- Base de données : `essenzalux_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '9cf95dacd226dcf43da376cdb6cbba7035218921');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(10, 4, 7, 'COCO CHANEL MADMOISELLE', 6000, 1, 'chanel.jpg'),
(11, 5, 5, 'COCO CHANEL MADMOISELLE', 6000, 1, 'chanel.jpg'),
(12, 5, 6, 'MISS DIOR PARFUM', 5000, 1, 'miss_dior.jpg'),
(13, 5, 10, 'CHANEL PARFUM GREEN BOTTLE', 6000, 1, 'chanel_1.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 1, 'afaf', 'afaf@gmail.com', '0987654345', 'i like your service and parfum thank you'),
(2, 2, 'fatima', 'fati@gmail.com', '0987654321', 'thanks for your service'),
(3, 2, 'anouar', 'anouar@gmail.com', '0876543252', 'finale project');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(11) NOT NULL,
  `placed_on` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(13, 8, 'anouar11', '1234567910', 'anouargb1@gmail.com', 'credit card', 'ZEZE, ZEZA, ZEZ, YU, ZEZE, EZE, FGG - 12313', 'BLEU DE CHANEL - EAU DE PARFUME (1200 x 1) - ', 1200, '2025-05-17 00:19:00', 'completed'),
(14, 8, 'anouar11', '1234567910', 'anouargb1@gmail.com', 'credit card', 'ZEZE, ZEZA, ZEZ, YU, ZEZE, EZE, FGG - 12313', 'GUCCI FLORA (2000 x 1) - ', 2000, '2025-05-17 00:32:56', 'pending'),
(15, 8, 'anouar11', '1234567910', 'anouargb1@gmail.com', 'credit card', 'ZEZE, ZEZA, ZEZ, YU, ZEZE, EZE, FGG - 12313', 'PAYTON - ZARA (1000 x 1) - ', 1000, '2025-05-17 00:48:05', 'pending'),
(16, 8, 'anouar11', '1234567910', 'anouargb1@gmail.com', 'credit card', 'ZEZE, ZEZA, ZEZ, YU, ZEZE, EZE, FGG - 12313', 'GUCCI FLORA (2000 x 1) - BONNE ETOILE FOR BOYS (1300 x 1) - ', 3300, '2025-05-17 09:17:23', 'pending'),
(17, 8, 'anouar11', '1234567910', 'anouargb1@gmail.com', 'cash on delivery', 'ZEZE, ZEZA, ZEZ, YU, ZEZE, EZE, FGG - 12313', 'PAYTON - ZARA (1000 x 1) - ', 1000, '2025-05-17 09:44:09', 'pending'),
(18, 8, 'anouar11', '1234567910', 'anouargb1@gmail.com', 'credit card', 'ZEZE, ZEZA, ZEZ, YU, ZEZE, EZE, FGG - 12313', 'GUCCI FLORA (2000 x 4) - ', 8000, '2025-05-17 10:34:17', 'pending'),
(19, 8, 'anouar11', '1234567910', 'anouargb1@gmail.com', 'Paypal', 'ZEZE, ZEZA, ZEZ, YU, ZEZE, EZE, FGG - 12313', 'GUCCI FLORA (2000 x 1) - PAYTON - ZARA (1000 x 1) - ', 3000, '2025-05-20 11:36:33', 'pending');

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(2, 13, 1, 1),
(3, 14, 3, 1),
(4, 15, 4, 1),
(5, 16, 3, 1),
(6, 16, 7, 1),
(7, 17, 4, 1),
(8, 18, 3, 4),
(9, 19, 3, 1),
(10, 19, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `old_price`, `image`, `type`) VALUES
(1, 'BLEU DE CHANEL - EAU DE PARFUME', 'Chanel', 1200, NULL, 'ed.jpg', 'homme'),
(3, 'GUCCI FLORA', 'GUCCI', 2000, 3000.00, 'gf.jpg', 'femme'),
(4, 'PAYTON - ZARA', 'ZARA', 1000, NULL, 'pz.jpg', 'kids'),
(5, 'COCO CHANEL MADMOISELLE', 'Chanel', 6000, NULL, 'chanel.jpg', 'femme'),
(6, 'MISS DIOR PARFUM', 'Dior', 5000, NULL, 'miss_dior.jpg', 'femme'),
(7, 'BONNE ETOILE FOR BOYS', 'Dior', 1300, NULL, 'beb.jpg', 'kids'),
(8, 'Jasmin Rouge - Eau de Parfum', 'Tom Ford', 3071, 4200.00, 'tomford_jasmin_rouge.jpg', 'femme'),
(9, 'Vanille Fatale Tom Ford', 'Tom Ford', 3075, NULL, 'tomford_vanille_fatale.jpg', 'femme'),
(10, 'CHANEL PARFUM GREEN BOTTLE', 'Chanel', 6000, 8999.00, 'chanel_1.jpg', 'femme'),
(11, 'VICTORIA\'S SECRET VANILLA BEAN & MACADAMIA', 'Victoria\'s Secret', 5500, NULL, 'victoria_secret.jpg', 'femme'),
(12, 'SWEET VANILLA 02', 'ZARA', 4600, NULL, 'zara.jpg', 'femme'),
(13, 'HYPNOTIC POISON', 'Dior', 7000, 8400.00, 'dior2.jpg', 'femme'),
(14, 'MIDNIGHT POISON', 'Dior', 3000, NULL, 'dior3.jpg', 'femme'),
(15, 'POISON GIRL', 'Dior', 5000, NULL, 'diorhh.jpg', 'femme'),
(16, 'PURE POISON', 'Dior', 4000, NULL, 'dior5.jpg', 'femme'),
(17, 'COCO NOIR ', 'Chanel', 3075, NULL, 'chanel4.jpg', 'homme'),
(18, 'SAUVAGE PARFUME', 'Dior', 5000, NULL, 'dior6.jpg', 'homme'),
(19, 'BOY CHANEL', 'Chanel', 1200, NULL, 'chanel5.jpg', 'homme'),
(20, 'OMBRE LEATHER', 'Tom Ford', 1714, 2300.00, 'tomford.jpg', 'homme'),
(21, 'BOMBSHELL OUD', 'Victoria\'s Secret', 6700, 9000.00, 'vs1.jpg', 'femme'),
(22, 'VS HIM DEEPWATER', 'Victoria\'s Secret', 3000, NULL, 'vs2.jpg', 'homme'),
(23, 'ZARA APPLEJUICE', 'ZARA', 3400, 5000.00, 'zara2.jpg', 'femme'),
(24, 'ZARA RED VANILLA', 'ZARA', 4590, NULL, 'zara3.jpg', 'femme'),
(25, 'RED TEMPTATION - EAU DE PARFUM', 'ZARA', 1300, NULL, 'zara4.jpg', 'femme'),
(26, 'FUKING FABULOUS', 'Tom Ford', 5600, NULL, 'tomford00.jpg', 'homme'),
(27, 'CHERRY ELIXIR + FRAGRANCE LOTION', 'Victoria\'s Secret', 7000, 9000.00, 'vs6.jpg', 'femme'),
(28, 'OUD WOOD', 'Tom Ford', 1200, NULL, 'oud.jpg', 'homme'),
(30, 'DIOR HOMME INTENSE', 'Dior', 1300, NULL, 'dhome.jpg', 'homme'),
(32, 'ALLURE', 'Chanel', 1475, NULL, 'allure.jpg', 'homme'),
(35, 'BLEU DE CHANEL - AFTER SHAVE BALM', 'Chanel', 2000, 3000.00, 'kkkk.jpg', 'homme'),
(36, 'GREY SOUL', 'ZARA', 2000, NULL, 'grey.jpg', 'homme'),
(37, 'CK FREE', 'calvin klein', 1300, 3000.00, 'ck.jpg', 'homme'),
(38, 'ZARA MAN SILVER', 'ZARA', 1200, NULL, 'silver.jpg', 'homme'),
(39, 'EUPHORIA MEN', 'calvin klein', 1678, NULL, 'eu.jpg', 'homme'),
(40, 'BLACK AMBER', 'ZARA', 1475, NULL, 'black.jpg', 'homme'),
(41, 'BONNE ETOILE FOR GIRLS', 'Dior', 1400, NULL, 'beg.jpg', 'kids'),
(42, 'HELLO KITTY', 'ZARA', 700, NULL, 'hello.jpg', 'kids'),
(43, 'KALOO BLEU', 'kaloo', 600, NULL, 'kaloo.jpg', 'kids'),
(44, 'GUCCI - HAIR MIST', 'GUCCI', 1000, NULL, 'gh.jpg', 'femme'),
(45, 'JEAN MISS', 'jean miss', 800, NULL, 'jm.jpg', 'femme'),
(46, 'MUSTI - EAU DE SOIN', 'MUSTI', 400, NULL, 'mu.jpg', 'kids'),
(47, 'BONBSHELL MIDNIGHT', 'Victoria\'s Secret', 5000, NULL, 'bomb.jpg', 'femme'),
(48, 'BLEU DE CHANEL PARFUM', 'Chanel', 2000, NULL, 'bdc.jpg', 'homme'),
(49, 'LITTRE GIRL', 'ZARA', 1700, 2000.00, 'lg.jpg', 'kids'),
(50, 'MUSTI - EAU DE SOIN PARFUMEE', 'MUSTI', 600, 890.00, 'mus.jpg', 'kids'),
(51, 'KALOO - LILIROSE', 'KALOO', 500, NULL, 'kal.jpg', 'kids'),
(52, 'KALOO - DRAGEE', 'KALOO', 400, NULL, 'ka.jpg', 'kids'),
(53, 'KALOO - POP', 'KALOO', 600, 700.00, 'kalo.jpg', 'kids'),
(54, 'KALOO - VANILLE CHOCOLAT', 'KALOO', 500, 600.00, 'K.jpg', 'kids');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`, `profile_image`) VALUES
(1, 'afaf', 'afafmzaou@gmail.com', '0608238391', '63d08c784ad634b6c3bcbe7907429a26dded44eb', '', NULL),
(2, 'jfmhfh', 'afafmzaou5@gmail.com', '0973637829', '8cb2237d0679ca88db6464eac60da96345513964', '', NULL),
(5, 'h', 'afaf@gmail.com', '0987654322', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', NULL),
(8, 'anouar11', 'anouargb1@gmail.com', '1234567910', '$2y$10$QyKSeZRyFKEgDs/YPGLUnOazoAYOYGML0Z68YgGqEMEBW9EsfzugG', 'ZEZE, ZEZA, ZEZ, YU, ZEZE, EZE, FGG - 12313', 'image3.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
