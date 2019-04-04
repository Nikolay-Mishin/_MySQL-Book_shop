-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 25 2019 г., 01:22
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
(9, 'asfasfa', 1);

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
  `book_average_mark` float(3,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `book_price`, `book_publisher_id`, `book_year`, `book_description`, `book_quantity`, `book_binding_id`, `book_language_id`, `book_image`, `book_isbn`, `book_average_mark`) VALUES
(1, 'Евгений Онегин', 359, 1, 2010, NULL, 5, NULL, NULL, NULL, NULL, 5.00),
(2, 'Преступление и наказание', 349, 4, 2011, NULL, 10, NULL, NULL, NULL, NULL, 4.33),
(3, 'Мастер и Маргарита', 500, 1, 2010, NULL, 10, NULL, NULL, NULL, NULL, 3.00),
(4, 'Капитанская дочка', 320, 4, 2013, NULL, 22, NULL, NULL, NULL, NULL, 3.50),
(5, 'Сборник стихотворений', 450, 3, 2015, NULL, 20, NULL, NULL, NULL, NULL, 4.00),
(6, 'Сборник Сказок', 400, 3, 2010, NULL, NULL, NULL, NULL, NULL, NULL, 2.00);

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
-- Дамп данных таблицы `books_authors`
--

INSERT INTO `books_authors` (`book_author_id`, `book_author_book_id`, `book_author_author_id`) VALUES
(1, 4, 1),
(2, 1, 1),
(3, 3, 6),
(4, 5, 5),
(5, 2, 2),
(6, 4, 6);

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
-- Дамп данных таблицы `connects`
--

INSERT INTO `connects` (`connect_id`, `connect_user_id`, `connect_token`, `connect_token_time`, `connect_session`) VALUES
(2, 1, 'sink1bbibqzpbxy7v5i28k2edg8aonko', '2019-03-16 13:22:46', '1mm1rfmm6mq5esaejml7im837l'),
(71, 6, 'tf9yxcf9ryhf5i82suwbek93ott3cdl5', '2019-03-25 02:42:39', '1u3oge25tev0djhd22jmcqj8i1'),
(72, 1, '8559e92ghm2nlcofgppfyg3iyqyo8ep4', '2019-03-25 02:49:14', '1u3oge25tev0djhd22jmcqj8i1'),
(73, 1, 'vvz39d0om3oq09p9s6x3wu4m4xi1ykgm', '2019-03-25 03:24:54', '1u3oge25tev0djhd22jmcqj8i1');

-- --------------------------------------------------------

--
-- Структура таблицы `genders`
--

CREATE TABLE `genders` (
  `gender_id` tinyint(1) UNSIGNED NOT NULL,
  `gender_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Дамп данных таблицы `marks`
--

INSERT INTO `marks` (`mark_id`, `mark_user_id`, `mark_book_id`, `mark_value`, `mark_feedback`) VALUES
(3, 1, 1, 5, ''),
(4, 1, 2, 3, ''),
(5, 1, 3, 3, ''),
(6, 1, 4, 3, ''),
(7, 1, 2, 5, ''),
(8, 1, 2, 5, ''),
(9, 1, 3, 3, ''),
(10, 1, 4, 4, ''),
(15, 1, 5, 4, '');

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

-- --------------------------------------------------------

--
-- Структура таблицы `publishers`
--

CREATE TABLE `publishers` (
  `publisher_id` smallint(5) UNSIGNED NOT NULL,
  `publisher_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `status_id` tinyint(1) UNSIGNED NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `user_is_admin` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_login`, `user_email`, `user_password`, `user_birthdate`, `user_gender_id`, `user_address`, `user_phone`, `user_is_admin`) VALUES
(1, NULL, NULL, 'abc@email.com', '123', NULL, NULL, NULL, NULL, NULL),
(6, NULL, 'gg', 'fggtt@hhhjy.ru', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, NULL, NULL);

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
  ADD KEY `user_gender_id` (`user_gender_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `books_authors`
--
ALTER TABLE `books_authors`
  MODIFY `book_author_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `connects`
--
ALTER TABLE `connects`
  MODIFY `connect_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT для таблицы `genders`
--
ALTER TABLE `genders`
  MODIFY `gender_id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `marks`
--
ALTER TABLE `marks`
  MODIFY `mark_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
