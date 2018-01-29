SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `otake`
--

-- --------------------------------------------------------

--
-- Структура таблицы `otake_invites`
--

CREATE TABLE `otake_invites` (
  `id` int(11) NOT NULL,
  `code` varchar(250) NOT NULL,
  `parent_user` varchar(250) NOT NULL,
  `create_time` int(11) NOT NULL,
  `is_used` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `otake_invites`
--

INSERT INTO `otake_invites` (`id`, `code`, `parent_user`, `create_time`, `is_used`) VALUES
(1, 'testinvite', 'root', 12345678, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `otake_subpages`
--

CREATE TABLE `otake_subpages` (
  `id` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `admin` varchar(250) NOT NULL,
  `mods` text NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `users_allowed` text NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `otake_subpages`
--

INSERT INTO `otake_subpages` (`id`, `address`, `name`, `description`, `admin`, `mods`, `hidden`, `users_allowed`, `create_time`) VALUES
(1, 'main', 'Глагне', 'тест', 'root', '', 0, '', 1517072305),
(2, 'tech', 'Технические вопросы', 'Здесь пишем о багах', 'root', '', 0, '', 1517144350);

-- --------------------------------------------------------

--
-- Структура таблицы `otake_users`
--

CREATE TABLE `otake_users` (
  `id` int(11) NOT NULL,
  `login` varchar(250) NOT NULL,
  `passwd` varchar(250) NOT NULL,
  `joindate` int(11) NOT NULL,
  `join_ip` varchar(250) NOT NULL,
  `ugroup` enum('user','admin') NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `otake_users`
--

INSERT INTO `otake_users` (`id`, `login`, `passwd`, `joindate`, `join_ip`, `ugroup`, `email`) VALUES
(1, 'root', MD5('ВАШ ПАРОЛЬ'), 1517016747, '127.0.0.1', 'admin', 'upyachkin2018@yandex.ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `otake_invites`
--
ALTER TABLE `otake_invites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `parent_user` (`parent_user`);

--
-- Индексы таблицы `otake_subpages`
--
ALTER TABLE `otake_subpages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `address_2` (`address`),
  ADD KEY `address` (`address`),
  ADD KEY `admin` (`admin`);

--
-- Индексы таблицы `otake_users`
--
ALTER TABLE `otake_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `otake_invites`
--
ALTER TABLE `otake_invites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `otake_subpages`
--
ALTER TABLE `otake_subpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `otake_users`
--
ALTER TABLE `otake_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
