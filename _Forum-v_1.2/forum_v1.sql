-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 12 2019 г., 22:33
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
-- База данных: `forum_v1`
--
CREATE DATABASE IF NOT EXISTS `forum_v1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `forum_v1`;

-- --------------------------------------------------------

--
-- Структура таблицы `color`
--

CREATE TABLE `color` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `color`:
--

--
-- Дамп данных таблицы `color`
--

INSERT INTO `color` (`color_id`, `color_name`) VALUES
(1, 'card-item-green'),
(2, 'card-item-red'),
(3, 'card-item-purple'),
(4, 'card-item-blue'),
(5, 'card-item-yellow');

-- --------------------------------------------------------

--
-- Структура таблицы `genders`
--

CREATE TABLE `genders` (
  `gender_id` tinyint(1) NOT NULL,
  `gender_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `genders`:
--

--
-- Дамп данных таблицы `genders`
--

INSERT INTO `genders` (`gender_id`, `gender_name`) VALUES
(1, 'М'),
(2, 'Ж');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `roles_id` int(10) NOT NULL,
  `roles_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `roles`:
--

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`roles_id`, `roles_name`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `section`
--

CREATE TABLE `section` (
  `section_id` int(10) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `section_image` varchar(255) NOT NULL,
  `section_tag_sections_id` int(10) NOT NULL,
  `section_publication_user_id` int(10) DEFAULT NULL,
  `section_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `section`:
--   `section_tag_sections_id`
--       `tag_section` -> `tag_id`
--

--
-- Дамп данных таблицы `section`
--

INSERT INTO `section` (`section_id`, `section_name`, `section_image`, `section_tag_sections_id`, `section_publication_user_id`, `section_url`) VALUES
(1, 'Новости и объявления', 'logo.1', 1, 5, 'php/news_section.php'),
(2, 'Общий раздел', 'logo.2', 2, 4, 'php/general_section.php'),
(3, 'Конкурсы', 'logo.3', 3, 5, ''),
(4, 'Игровой мир', 'logo.4', 4, 4, ''),
(5, 'Обсуждение игры', 'logo.5', 5, 6, ''),
(6, 'Технические вопросы по игре', 'logo.6', 6, 6, '');

-- --------------------------------------------------------

--
-- Структура таблицы `subtopic`
--

CREATE TABLE `subtopic` (
  `subtopic_id` int(10) NOT NULL,
  `subtopic_topic_id` int(10) NOT NULL,
  `subtopic_title` varchar(255) NOT NULL,
  `subtopic_publication_user_id` varchar(255) NOT NULL,
  `subtopic_date` datetime NOT NULL,
  `subtopic_message` tinyint(4) NOT NULL,
  `subtopic_view` tinyint(4) NOT NULL,
  `subtopic_tag_id` int(10) NOT NULL,
  `subtopic_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `subtopic`:
--

--
-- Дамп данных таблицы `subtopic`
--

INSERT INTO `subtopic` (`subtopic_id`, `subtopic_topic_id`, `subtopic_title`, `subtopic_publication_user_id`, `subtopic_date`, `subtopic_message`, `subtopic_view`, `subtopic_tag_id`, `subtopic_url`) VALUES
(1, 6, 'Гайд - класс Вершитель', 'Xarlen', '2019-04-01 10:30:00', 4, 5, 1, ''),
(2, 6, 'Руководство: Гладиатор', 'Xarlen', '2019-04-02 15:18:00', 0, 0, 1, ''),
(3, 6, 'Руководство: Разбойник', 'Администрация', '2019-04-01 12:24:00', 0, 0, 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `tag_section`
--

CREATE TABLE `tag_section` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(255) NOT NULL,
  `tag_color` varchar(255) NOT NULL,
  `tag_color_bg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `tag_section`:
--

--
-- Дамп данных таблицы `tag_section`
--

INSERT INTO `tag_section` (`tag_id`, `tag_name`, `tag_color`, `tag_color_bg`) VALUES
(1, 'News', '#6f42c1', 'bg-purple'),
(2, 'General', '#007bff', 'bg-primary'),
(3, 'Competition', '#28a745', 'bg-success'),
(4, 'GameWorld', '#ffc107', 'bg-warning'),
(5, 'GameDiscussions', '#17a2b8', 'bg-info'),
(6, 'TechnicalIssue', '#dc3545', 'bg-danger');

-- --------------------------------------------------------

--
-- Структура таблицы `tag_topic`
--

CREATE TABLE `tag_topic` (
  `tag_id` int(10) NOT NULL,
  `tag_name` text NOT NULL,
  `tag_color_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `tag_topic`:
--   `tag_color_id`
--       `color` -> `color_id`
--

--
-- Дамп данных таблицы `tag_topic`
--

INSERT INTO `tag_topic` (`tag_id`, `tag_name`, `tag_color_id`) VALUES
(1, 'usual', 5),
(2, 'important', 4),
(3, 'Daily-event', 1),
(4, 'Transportation', 2),
(5, 'Info', 3),
(6, 'Events', 4),
(7, 'Updates', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `topic`
--

CREATE TABLE `topic` (
  `topic_id` int(10) NOT NULL,
  `topic_section_id` int(11) NOT NULL,
  `topic_title` varchar(255) NOT NULL,
  `topic_description` text NOT NULL,
  `topic_publication_user_id` varchar(255) NOT NULL,
  `topic_date` datetime NOT NULL,
  `topic_message` int(11) DEFAULT NULL,
  `topic_view` int(11) DEFAULT NULL,
  `topic_tag_id` int(10) NOT NULL,
  `topic_show_id` tinyint(1) NOT NULL,
  `topic_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `topic`:
--   `topic_tag_id`
--       `tag_topic` -> `tag_id`
--   `topic_section_id`
--       `section` -> `section_id`
--

--
-- Дамп данных таблицы `topic`
--

INSERT INTO `topic` (`topic_id`, `topic_section_id`, `topic_title`, `topic_description`, `topic_publication_user_id`, `topic_date`, `topic_message`, `topic_view`, `topic_tag_id`, `topic_show_id`, `topic_url`) VALUES
(1, 1, 'События', 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus', 'Администрация', '2019-04-15 08:24:00', 3, 1, 3, 0, ''),
(2, 1, 'Трансфер', 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus', 'Администрация', '2019-04-02 13:25:00', 5, 5, 4, 0, ''),
(3, 1, 'Информация о технических работах', 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus', 'Администрация', '2019-04-02 06:17:10', 0, 0, 5, 1, ''),
(4, 1, 'Ивенты', 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus', 'Администрация', '2019-04-03 07:13:00', 0, 0, 6, 1, ''),
(5, 1, 'Обновления игры', 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus', 'Администрация', '2019-04-01 09:16:00', 0, 1, 7, 1, ''),
(6, 2, 'Гайды: игровые классы', 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus', 'Администрация', '2019-04-01 06:23:00', 10, 0, 2, 0, 'general_section_guides.php'),
(7, 2, 'Помощь новичкам и вернувшимся путешественникам', 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus', 'Администрация', '2019-04-01 06:23:00', 0, 0, 1, 1, ''),
(8, 4, 'Сражения', 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus', 'Администрация', '2019-04-12 07:25:00', 25, 0, 1, 1, ''),
(9, 3, 'Международный конкурс артов ', 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus', 'Администрация', '2019-04-01 06:30:00', 0, 0, 1, 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `user_login` varchar(255) NOT NULL,
  `user_password` char(32) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_birthdate` date NOT NULL,
  `user_gender_id` tinyint(1) NOT NULL,
  `user_address` text NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_roles_id` int(10) NOT NULL,
  `user_nike` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ССЫЛКИ ТАБЛИЦЫ `users`:
--   `user_gender_id`
--       `genders` -> `gender_id`
--   `user_roles_id`
--       `roles` -> `roles_id`
--

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `user_password`, `user_name`, `user_email`, `user_birthdate`, `user_gender_id`, `user_address`, `user_phone`, `user_roles_id`, `user_nike`) VALUES
(1, '', '', 'Xarlen', 'adv@mail.ru', '2019-04-01', 1, 'РФ', '0', 1, 'Xarlen'),
(2, '', '', 'Anton', 'dfg@mail.ru', '2019-04-02', 1, 'РФ', '0', 2, 'Администрация');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`color_id`);

--
-- Индексы таблицы `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`gender_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roles_id`);

--
-- Индексы таблицы `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `section_id` (`section_tag_sections_id`);

--
-- Индексы таблицы `subtopic`
--
ALTER TABLE `subtopic`
  ADD PRIMARY KEY (`subtopic_id`);

--
-- Индексы таблицы `tag_section`
--
ALTER TABLE `tag_section`
  ADD PRIMARY KEY (`tag_id`);

--
-- Индексы таблицы `tag_topic`
--
ALTER TABLE `tag_topic`
  ADD PRIMARY KEY (`tag_id`),
  ADD KEY `tag_color_id` (`tag_color_id`);

--
-- Индексы таблицы `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `topic_id` (`topic_section_id`),
  ADD KEY `topic_tag_id` (`topic_tag_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_gender_id` (`user_gender_id`),
  ADD KEY `user_roles_id` (`user_roles_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `color`
--
ALTER TABLE `color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `genders`
--
ALTER TABLE `genders`
  MODIFY `gender_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `roles_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `subtopic`
--
ALTER TABLE `subtopic`
  MODIFY `subtopic_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tag_section`
--
ALTER TABLE `tag_section`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `tag_topic`
--
ALTER TABLE `tag_topic`
  MODIFY `tag_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `topic`
--
ALTER TABLE `topic`
  MODIFY `topic_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_id` FOREIGN KEY (`section_tag_sections_id`) REFERENCES `tag_section` (`tag_id`);

--
-- Ограничения внешнего ключа таблицы `tag_topic`
--
ALTER TABLE `tag_topic`
  ADD CONSTRAINT `tag_topic_ibfk_1` FOREIGN KEY (`tag_color_id`) REFERENCES `color` (`color_id`);

--
-- Ограничения внешнего ключа таблицы `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`topic_tag_id`) REFERENCES `tag_topic` (`tag_id`),
  ADD CONSTRAINT `topic_id` FOREIGN KEY (`topic_section_id`) REFERENCES `section` (`section_id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_gender_id`) REFERENCES `genders` (`gender_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`user_roles_id`) REFERENCES `roles` (`roles_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
