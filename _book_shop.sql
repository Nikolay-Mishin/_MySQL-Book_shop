-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 18 2019 г., 20:24
-- Версия сервера: 10.1.37-MariaDB
-- Версия PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `_book_shop`
--
CREATE DATABASE IF NOT EXISTS `_book_shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `_book_shop`;

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `author_id` int(10) UNSIGNED NOT NULL,
  `author_name` varchar(255) DEFAULT NULL,
  `author_is_deleted` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `authors`:
--

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`, `author_is_deleted`) VALUES
(1, 'Пушкин Александр Сергеевич', 0),
(2, 'Достоевский Федор Михайлович', 0),
(3, 'Толстой Лев Николаевич', 0),
(4, 'Тютчев Федор Афанасьевич', 0),
(5, 'Есенин Сергей', 0),
(6, 'Булгаков', 0),
(7, 'gfkasjdgfk', 1),
(8, '', 1),
(9, 'asfasfa', 1),
(10, '', 1),
(11, '', 1),
(12, 'Рэки Кавахара', 0),
(13, '', 1),
(14, 'Шекспир', 0),
(15, 'Анна Каренина', 0),
(16, 'Гёте', 0),
(17, 'Дарья Донцова', 0),
(18, 'Сборник', 1),
(19, 'Рэки Кавахара', 1),
(20, 'Рэки', 1),
(21, 'Агата Кристи', 1),
(22, 'Толстой', 1),
(23, 'Агата', 1),
(24, 'Кристина', 1),
(25, 'Тютчев', 1),
(26, 'Анеко Юсаги', 0),
(27, 'Поливанов', 0),
(28, 'Эйнштейн', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `book_id` int(10) UNSIGNED NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_price` int(6) UNSIGNED DEFAULT NULL,
  `book_publisher_id` smallint(5) UNSIGNED DEFAULT NULL,
  `book_year` year(4) DEFAULT NULL,
  `book_description` text,
  `book_quantity` smallint(5) UNSIGNED DEFAULT NULL,
  `book_binding_id` tinyint(1) UNSIGNED DEFAULT NULL,
  `book_language_id` smallint(5) UNSIGNED DEFAULT NULL,
  `book_image` varchar(255) DEFAULT NULL,
  `book_isbn` char(13) DEFAULT NULL,
  `book_average_mark` float(3,2) UNSIGNED NOT NULL,
  `book_is_deleted` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `books`:
--   `book_publisher_id`
--       `publishers` -> `publisher_id`
--

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `book_price`, `book_publisher_id`, `book_year`, `book_description`, `book_quantity`, `book_binding_id`, `book_language_id`, `book_image`, `book_isbn`, `book_average_mark`, `book_is_deleted`) VALUES
(1, 'Евгений Онегин', 359, 1, 2010, NULL, 5, NULL, NULL, NULL, NULL, 5.00, 0),
(2, 'Преступление и наказание', 349, 4, 2011, NULL, 10, NULL, NULL, NULL, NULL, 4.33, 0),
(3, 'Мастер и Маргарита', 500, 1, 2010, NULL, 10, NULL, NULL, NULL, NULL, 3.00, 0),
(4, 'Капитанская дочка', 320, 4, 2013, NULL, 22, NULL, NULL, NULL, NULL, 3.50, 0),
(5, 'Сборник стихов', 450, 3, 2015, NULL, 20, NULL, NULL, NULL, NULL, 4.00, 0),
(6, 'Сборник Сказок', 400, 3, 2010, NULL, NULL, NULL, NULL, NULL, NULL, 4.00, 1),
(7, 'Карнелион', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4.00, 1),
(8, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3.00, 1),
(9, 'Монти Оум', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5.00, 1),
(10, 'Золотая рыба', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 1),
(11, 'Арлекин', 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0),
(12, 'Сон в летнюю ночь', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0),
(13, 'Война и мир', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 1),
(14, 'Война и мир', 200, 3, NULL, NULL, 10, NULL, NULL, NULL, NULL, 0.00, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `books_authors`
--

CREATE TABLE `books_authors` (
  `book_author_id` int(10) UNSIGNED NOT NULL,
  `book_author_book_id` int(10) UNSIGNED NOT NULL,
  `book_author_author_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `books_authors`:
--   `book_author_author_id`
--       `authors` -> `author_id`
--   `book_author_book_id`
--       `books` -> `book_id`
--

--
-- Дамп данных таблицы `books_authors`
--

INSERT INTO `books_authors` (`book_author_id`, `book_author_book_id`, `book_author_author_id`) VALUES
(1, 4, 1),
(2, 1, 1),
(3, 3, 6),
(4, 5, 5),
(5, 2, 2),
(6, 4, 6),
(7, 14, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `connects`
--

CREATE TABLE `connects` (
  `connect_id` int(10) UNSIGNED NOT NULL,
  `connect_user_id` int(10) UNSIGNED NOT NULL,
  `connect_token` char(32) NOT NULL,
  `connect_token_time` datetime NOT NULL,
  `connect_session` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `connects`:
--   `connect_user_id`
--       `users` -> `user_id`
--

-- --------------------------------------------------------

--
-- Структура таблицы `genders`
--

CREATE TABLE `genders` (
  `gender_id` tinyint(1) UNSIGNED NOT NULL,
  `gender_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `genders`:
--

-- --------------------------------------------------------

--
-- Структура таблицы `marks`
--

CREATE TABLE `marks` (
  `mark_id` int(10) UNSIGNED NOT NULL,
  `mark_user_id` int(10) UNSIGNED NOT NULL,
  `mark_book_id` int(10) UNSIGNED NOT NULL,
  `mark_value` tinyint(1) UNSIGNED NOT NULL,
  `mark_feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `marks`:
--   `mark_book_id`
--       `books` -> `book_id`
--   `mark_user_id`
--       `users` -> `user_id`
--

--
-- Дамп данных таблицы `marks`
--

INSERT INTO `marks` (`mark_id`, `mark_user_id`, `mark_book_id`, `mark_value`, `mark_feedback`) VALUES
(1, 1, 1, 5, ''),
(2, 1, 2, 3, ''),
(3, 1, 3, 3, ''),
(4, 1, 4, 3, ''),
(5, 1, 5, 4, '');

--
-- Триггеры `marks`
--
DELIMITER $$
CREATE TRIGGER `update_book_average_mark_on_insert` AFTER INSERT ON `marks` FOR EACH ROW UPDATE `books`
	SET `book_average_mark`= 
    (
    	SELECT AVG(`mark_value`) 
        FROM `marks`
        WHERE `mark_book_id` = NEW.`mark_book_id`
    )
    WHERE `book_id` = NEW.`mark_book_id`
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `order_user_id` int(10) UNSIGNED DEFAULT NULL,
  `order_status_id` tinyint(1) UNSIGNED DEFAULT NULL,
  `order_creation_date` datetime DEFAULT NULL,
  `order_delivery_date` datetime DEFAULT NULL,
  `order_comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `orders`:
--   `order_user_id`
--       `users` -> `user_id`
--   `order_status_id`
--       `statuses` -> `status_id`
--

-- --------------------------------------------------------

--
-- Структура таблицы `publishers`
--

CREATE TABLE `publishers` (
  `publisher_id` smallint(5) UNSIGNED NOT NULL,
  `publisher_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `publishers`:
--

--
-- Дамп данных таблицы `publishers`
--

INSERT INTO `publishers` (`publisher_id`, `publisher_name`) VALUES
(1, 'ЭКСМО'),
(2, 'ПХВ'),
(3, 'Просвещение'),
(4, 'Санкт-Петербург');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `roles`:
--

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `status_id` tinyint(1) UNSIGNED NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `statuses`:
--

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`status_id`, `status_name`) VALUES
(1, 'Новый'),
(2, 'В процессе'),
(5, 'Создан');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_login` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` char(32) DEFAULT NULL,
  `user_birthdate` date DEFAULT NULL,
  `user_gender_id` tinyint(1) UNSIGNED DEFAULT NULL,
  `user_address` text,
  `user_phone` varchar(20) DEFAULT NULL,
  `user_is_admin` tinyint(1) UNSIGNED DEFAULT NULL,
  `user_role_id` int(10) UNSIGNED DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `users`:
--   `user_role_id`
--       `roles` -> `role_id`
--

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_login`, `user_email`, `user_password`, `user_birthdate`, `user_gender_id`, `user_address`, `user_phone`, `user_is_admin`, `user_role_id`) VALUES
(1, NULL, 'admin', 'abc@email.com', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL, 1),
(2, NULL, 'gg', 'fggtt@hhhjy.ru', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, NULL, NULL, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `book_publisher_id` (`book_publisher_id`),
  ADD KEY `book_binding_id` (`book_binding_id`),
  ADD KEY `book_language_id` (`book_language_id`);

--
-- Индексы таблицы `books_authors`
--
ALTER TABLE `books_authors`
  ADD PRIMARY KEY (`book_author_id`),
  ADD KEY `book_author_book_id` (`book_author_book_id`),
  ADD KEY `book_author_author_id` (`book_author_author_id`);

--
-- Индексы таблицы `connects`
--
ALTER TABLE `connects`
  ADD PRIMARY KEY (`connect_id`),
  ADD KEY `connect_user_id` (`connect_user_id`);

--
-- Индексы таблицы `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`gender_id`);

--
-- Индексы таблицы `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`mark_id`),
  ADD KEY `mark_user_id` (`mark_user_id`),
  ADD KEY `mark_book_id` (`mark_book_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_user_id` (`order_user_id`),
  ADD KEY `order_status_id` (`order_status_id`);

--
-- Индексы таблицы `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`publisher_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`status_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `user_gender_id` (`user_gender_id`),
  ADD KEY `users_user_role_id` (`user_role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `books_authors`
--
ALTER TABLE `books_authors`
  MODIFY `book_author_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `connects`
--
ALTER TABLE `connects`
  MODIFY `connect_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `genders`
--
ALTER TABLE `genders`
  MODIFY `gender_id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `marks`
--
ALTER TABLE `marks`
  MODIFY `mark_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `publishers`
--
ALTER TABLE `publishers`
  MODIFY `publisher_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`book_publisher_id`) REFERENCES `publishers` (`publisher_id`);

--
-- Ограничения внешнего ключа таблицы `books_authors`
--
ALTER TABLE `books_authors`
  ADD CONSTRAINT `books_authors_ibfk_1` FOREIGN KEY (`book_author_author_id`) REFERENCES `authors` (`author_id`),
  ADD CONSTRAINT `books_authors_ibfk_2` FOREIGN KEY (`book_author_book_id`) REFERENCES `books` (`book_id`);

--
-- Ограничения внешнего ключа таблицы `connects`
--
ALTER TABLE `connects`
  ADD CONSTRAINT `connects_ibfk_1` FOREIGN KEY (`connect_user_id`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_1` FOREIGN KEY (`mark_book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`mark_user_id`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`order_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`order_status_id`) REFERENCES `statuses` (`status_id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
