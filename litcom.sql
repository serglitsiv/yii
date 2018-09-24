-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 01 2018 г., 11:29
-- Версия сервера: 5.6.37
-- Версия PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `litcom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1517162395),
('content', '3', 1517162554),
('user', '2', 1517162483);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Администратор', NULL, NULL, 1517083699, 1517083699),
('banned', 1, 'Пользовательбездоступа', NULL, NULL, 1517083699, 1517083699),
('canAdmin', 2, 'Право на вход в админку', NULL, NULL, 1517089485, 1517089485),
('content', 1, 'Контент менеджер', NULL, NULL, 1517083699, 1517083699),
('user', 1, 'Пользователь', NULL, NULL, 1517083699, 1517083699);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'canAdmin'),
('content', 'canAdmin');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `text` text,
  `url` varchar(150) NOT NULL,
  `status_id` tinyint(1) NOT NULL DEFAULT '1',
  `sort` tinyint(2) NOT NULL DEFAULT '50',
  `user_id` int(11) NOT NULL DEFAULT '1',
  `date_update` datetime DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `blog`
--

INSERT INTO `blog` (`id`, `title`, `text`, `url`, `status_id`, `sort`, `user_id`, `date_update`, `date_create`, `image`) VALUES
(2, 'Модели', '<p><strong>Модели</strong> являются частью архитектуры MVC (Модель-Вид-Контроллер). Они представляют собой объекты бизнес данных, правил и логики.</p><p>Вы можете создавать классы моделей путём расширения класса yii\\base\\Model или его дочерних классов. Базовый класс yii\\base\\Model поддерживает много полезных функций:</p>', 'models', 1, 78, 1, '2018-01-27 23:09:19', '2018-01-03 21:20:10', ''),
(3, 'Active Record', '<p>Active Record обеспечивает объектно-ориентированный интерфейс для доступа и манипулирования данными, хранящимися в базах данных. Класс Active Record соответствует таблице в базе данных, объект Active Record соответствует строке этой таблицы, а атрибут объекта Active Record представляет собой значение отдельного столбца строки. Вместо непосредственного написания SQL-выражений вы сможете получать доступ к атрибутам Active Record и вызывать методы Active Record для доступа и манипулирования данными, хранящимися в таблицах базы данных.</p>', 'active', 1, 44, 2, '2018-01-09 22:42:13', NULL, ''),
(4, 'Модули', '<p>Модули - это законченные программные блоки, состоящие из моделей, представлений, контроллеров и других вспомогательных компонентов. При установке модулей в приложение, конечный пользователь получает доступ к их контроллерам. По этой причине модули часто рассматриваются как миниатюрные приложения. В отличии от приложений, модули нельзя развертывать отдельно. Модули должны находиться внутри приложений.</p>', 'modul', 1, 48, 3, '2018-01-08 16:07:43', NULL, ''),
(5, 'Виды', '<p><strong>Виды</strong> - это часть MVC архитектуры, это код, который отвечает за представление данных конечным пользователям. В веб приложениях виды создаются обычно в виде <em>видов - шаблонов</em>, которые суть PHP скрипты, в основном содержащие HTML код и код PHP, отвечающий за представление и внешний вид. Виды управляются компонентом приложения view, который содержит часто используемые методы для упорядочивания видов и их рендеринга. </p>', 'view', 1, 12, 1, '2018-01-09 22:19:38', NULL, ''),
(6, '​Фильтры', '<p>Фильтры — это объекты, которые могут запускаться как перед так и после действие контроллера. Например, фильтр управления доступом может запускаться перед действиями удостовериться, что запросившему их пользователю разрешен доступ; фильтр сжатия содержимого может запускаться после действий для сжатия содержимого ответа перед отправкой его конечному пользователю.</p>', 'filter', 1, 33, 1, NULL, NULL, NULL),
(7, 'Сортировка', '<p><strong>Иногд</strong>а выводимые данные требуется отсортировать в соответствии с одним или несколькими атрибутами. В противном случае вы должны создать  настроить его и применить к запросу. <strong>Он</strong> также может быть передан в представление, где будет использован для создания ссылок на сортировку по определенным атрибутам.<span class=\"redactor-invisible-space\"></span></p>', 'sorts', 0, 25, 1, '2018-01-21 20:14:43', NULL, ''),
(8, 'ListView', '<p>ListView дает широкие возможности по нативной возможности передачи дополнительных данных в _item я не нашел. Впрочем, путем несложного изучения документации решение было найдено.Как видите — дело в параметре <code>&lt;strong&gt;viewParams&lt;/strong&gt;</code>. Именно в него можно передать массив данных, которые будут доступны в каждом <code>_item</code>.</p>', 'listwiew', 0, 37, 1, NULL, NULL, NULL),
(9, 'Ресурсы', '<p>Ресурс в Yii это файл который может быть задан в Web странице. Это может быть CSS файл, JavaScript файл, изображение или видео файл и т.д. Ресурсы располагаются в Web доступных директориях и обслуживаются непосредственно Web серверами.</p>', 'resource', 1, 86, 1, '2018-01-03 21:19:25', '2018-01-03 21:19:25', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `blog_tag`
--

CREATE TABLE `blog_tag` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `blog_tag`
--

INSERT INTO `blog_tag` (`id`, `blog_id`, `tag_id`) VALUES
(4, 3, 2),
(6, 2, 3),
(7, 9, 4),
(8, 5, 4),
(9, 3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `tree` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(50) NOT NULL,
  `text` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `tree`, `lft`, `rgt`, `depth`, `name`, `url`, `text`) VALUES
(1, 0, 1, 8, 0, 'Основное меню', 'main', 'main menu in app'),
(2, 0, 4, 7, 1, 'saidbar', 'saidb', 'sainbar on site'),
(3, 0, 5, 6, 2, 'footer', 'fot', 'foter on site'),
(4, 0, 2, 3, 1, 'шапка сайта', 'header', 'site header');

-- --------------------------------------------------------

--
-- Структура таблицы `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menus`
--

INSERT INTO `menus` (`id`, `title`, `url`, `parent_id`, `sort`) VALUES
(1, 'Главная страница сайта', 'main', NULL, 0),
(2, 'О нас', 'left', NULL, 0),
(3, 'Лефтбар', 'leftbar', NULL, 100),
(4, 'Футер', 'footer', NULL, 200),
(5, 'Райтбар', 'rigtbar', NULL, 300),
(6, 'О нас', 'about', 3, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1512308728),
('m130524_201442_init', 1512308734),
('m140506_102106_rbac_init', 1517079324),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1517079324),
('m180214_174839_menu', 1518631038),
('m230416_200116_tree', 1518979225);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `sklad_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `cost` int(11) DEFAULT NULL,
  `date` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `sklad_id`, `title`, `cost`, `date`, `type_id`, `text`) VALUES
(1, 1, 'iphone 8', 900, 1514505600, 0, 'Для iPhone 8 мы разработали совершенно новый дизайн, в котором передняя и задняя панели выполнены из стекла. Самая популярная камера усовершенствована. Установлен самый умный и мощный процессор, когда-﻿либо созданный для iPhone. Без проводов процесс зарядки становится элементарным. А дополненная реальность открывает невиданные до сих пор возможности. iPhone 8. Новое поколение iPhone.'),
(2, 2, 'samsung galaxy 8', 890, 1531353600, 1, 'Экран (6.3\", Super AMOLED, 2960х1440)/ Samsung Exynos 8895 (Quad 2.3 ГГц + Quad 1.7 ГГц)/ камера 12 Мп+12 Мп + фронтальная 8 Мп/ RAM 6 ГБ/ 64 ГБ встроенной памяти + microSD (до 256 ГБ)/ 3G/ LTE/ GPS/ поддержка 2х SIM-карт (Nano-SIM)/ Android 7.1.1 (Nougat) / 3300 мА*ч\r\nПодробнее: https://rozetka.com.ua/samsung_sm_n950fzkdsek/p21615056/');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `shop_id`, `color`, `price`, `size`) VALUES
(1, 'кроссовки Nike air', 1, 'grey', 1200, 41),
(2, 'кроссовки Addidas', 2, 'black', 1500, 42),
(3, 'футболка Cropp', 3, 'red', 300, 37),
(4, 'Рубашка Colins', 4, 'djins', 500, 40);

-- --------------------------------------------------------

--
-- Структура таблицы `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `address` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop`
--

INSERT INTO `shop` (`id`, `title`, `address`) VALUES
(1, 'Магазин Nike', 'В.Стуса 45'),
(2, 'Магазин Addidas', 'В.Стуса 64'),
(3, 'Магазин Cropp', 'Дворцовая 42'),
(4, 'Магазин Colins', 'Парковая 15');

-- --------------------------------------------------------

--
-- Структура таблицы `sklad`
--

CREATE TABLE `sklad` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sklad`
--

INSERT INTO `sklad` (`id`, `title`, `address`) VALUES
(1, 'Склад новой почты №1', 'Парковая 25'),
(2, 'Склад новой почты №2', 'Дворцовая 14');

-- --------------------------------------------------------

--
-- Структура таблицы `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'Stotskiy Alex'),
(2, 'Levchenka Gleb'),
(3, 'Semerenko Valia'),
(4, 'Gorelov Serg');

-- --------------------------------------------------------

--
-- Структура таблицы `time`
--

CREATE TABLE `time` (
  `id` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `time`
--

INSERT INTO `time` (`id`, `time`, `date`, `datetime`) VALUES
(1, '17:15:00', '2018-01-10', '2017-01-05 07:45:00');

-- --------------------------------------------------------

--
-- Структура таблицы `tree`
--

CREATE TABLE `tree` (
  `id` bigint(20) NOT NULL,
  `root` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `lvl` smallint(5) NOT NULL,
  `name` varchar(60) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `icon_type` smallint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `selected` tinyint(1) NOT NULL DEFAULT '0',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `readonly` tinyint(1) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `collapsed` tinyint(1) NOT NULL DEFAULT '0',
  `movable_u` tinyint(1) NOT NULL DEFAULT '1',
  `movable_d` tinyint(1) NOT NULL DEFAULT '1',
  `movable_l` tinyint(1) NOT NULL DEFAULT '1',
  `movable_r` tinyint(1) NOT NULL DEFAULT '1',
  `removable` tinyint(1) NOT NULL DEFAULT '1',
  `removable_all` tinyint(1) NOT NULL DEFAULT '0',
  `content_type` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tree`
--

INSERT INTO `tree` (`id`, `root`, `lft`, `rgt`, `lvl`, `name`, `icon`, `icon_type`, `active`, `selected`, `disabled`, `readonly`, `visible`, `collapsed`, `movable_u`, `movable_d`, `movable_l`, `movable_r`, `removable`, `removable_all`, `content_type`) VALUES
(1, 1, 1, 4, 0, 'Кроссовки', 'cog', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(2, 2, 1, 2, 0, 'Nike', 'fire', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(3, 1, 2, 3, 1, 'addidas', 'star', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(4, 4, 1, 2, 0, 'Мужская одежда', 'crosshairs', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'M-Yk525-0UE3symHTcwOibIU4SBAbkhk', '$2y$13$lVwvV13Vvl.07sZAJhSpNuJUz1kwsSRkB/Bj5C9N87X1PeeOAaoOm', NULL, 'adminserg@gmail.com', 10, 1517162395, 1517162395),
(2, 'user', 'fmKrYdZDas4kc84IZEO-uWFBIOXcwh3T', '$2y$13$hNMDk3bXjvVZavQsAUeoR.cApQrsnhyxpxabTHAxg7toKT1SVBHm.', NULL, 'user@gmail.com', 10, 1517162483, 1517162483),
(3, 'content', 'W7CuIeRzlM51Zs79w_SJCQ-XFvvclvPb', '$2y$13$fDBNBILiGu.WQZJdMrwCMea4tVNOStJAqa3qNUPbSl884rZfEQ2pu', NULL, 'content@gmail.com', 10, 1517162554, 1517162554);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `auth_assignment_user_id_idx` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sort` (`sort`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `blog_tag`
--
ALTER TABLE `blog_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `sort` (`sort`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sklad`
--
ALTER TABLE `sklad`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tree`
--
ALTER TABLE `tree`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tree_NK1` (`root`),
  ADD KEY `tree_NK2` (`lft`),
  ADD KEY `tree_NK3` (`rgt`),
  ADD KEY `tree_NK4` (`lvl`),
  ADD KEY `tree_NK5` (`active`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `blog_tag`
--
ALTER TABLE `blog_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `sklad`
--
ALTER TABLE `sklad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `time`
--
ALTER TABLE `time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `tree`
--
ALTER TABLE `tree`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
