-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 23 2021 г., 11:26
-- Версия сервера: 8.0.15
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `adsaf`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accesslevel`
--

CREATE TABLE `accesslevel` (
  `id_accessLevel` int(11) NOT NULL,
  `publication` tinyint(1) NOT NULL,
  `delete_` tinyint(1) NOT NULL,
  `edit` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `accesslevel`
--

INSERT INTO `accesslevel` (`id_accessLevel`, `publication`, `delete_`, `edit`) VALUES
(1, 1, 1, 1),
(2, 1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `advertisement`
--

CREATE TABLE `advertisement` (
  `id_advertisement` int(11) NOT NULL,
  `id_User` int(11) NOT NULL,
  `heading` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(5000) COLLATE utf8mb4_general_ci NOT NULL,
  `charter` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `advertisement`
--

INSERT INTO `advertisement` (`id_advertisement`, `id_User`, `heading`, `price`, `description`, `photo`, `charter`) VALUES
(1, 1, 'Лошадь', 100000, 'Продам доморощенную кобылку, 3,5 года. Рост 164-167см, растёт. Родилась у нас, очень контактная, ручная. Заезжена, ничего особо не знает под верхом, только 3 аллюра. Очень спокойная, смелая. Мягкая под седлом, не тряская. Не таскает, не козлит. Сел и поехал. Подойдёт даже ребёнку. Бегает на корде, расчищается, колется. Руки будут проверяться.', 'img/horse.png', 'Животные'),
(2, 1, 'Машина', 123333, 'Покупай машину - не прогадаешь. Лошадь', 'img/car.png', 'Транспорт'),
(3, 1, 'Квартира', 22000, 'Сдается квартира в аренду.', 'img/flat.png', 'Недвижимость'),
(4, 6, 'Телята', 13000, 'Скот хороший, ухоженные, отборные, здоровые, привитые.', 'img/cow.png', 'Животные'),
(5, 10, 'Участок', 150000, 'Продаётся участок с фундаментом, в аренде, в связи с переездом, удобное расположение, в пешей доступности вся инфраструктура', 'img/house.png', 'Недвижимость'),
(6, 4, 'Квадроцикл', 480000, 'Продается STELS ATV-800G 2015 г. Квадроцикл полностью обслужен. Идеальное состояние. Один владелец! Полный комплект документов и ключей. Пробег 1850 км', 'img/moto.png', 'Транспорт'),
(7, 14, 'Французский дог', 21000, 'Малыши французики ищут свою семью. Остались 1 девочка и 1 мальчик. Переезжать будут в 20 числах декабря. Прекрасный подарок к новому году.', 'img/dog.png', 'Животные'),
(8, 11, 'Велосипеды', 12990, 'Велосипеды в наличии более 1000 моделей.\r\nВедущий велопоставщик по минимальным ценам в Липецке.\r\nШирокий ассортимент велосипедов от производителя.\r\nГод бесплатного ТО и обслуживания.\r\nКрылья в подарок к каждому велосипеду.', 'img/velo.png', 'Транспорт'),
(9, 12, 'Бишон фризе', 35000, 'Щенок Бишон фризе, девочка 2 месяца. Маленькая кукольная красавица, фото реального щенка, без Фотошопа. Продается именно она, щенок с документами и клеймом. Девочка полностью здорова, привита, без дефектов. Размер миниатюрный ( не для разведения). Характер весёлый, активная и очень ласковая. Приучена к туалету, к грумерским процедурам, очень воспитанная леди.', 'img/dog1.png', 'Животные'),
(20, 20, 'Машина Кио Рио', 500000, 'Пробег маленький, состояние хорошее. Возможен торг.', 'img/3d7e99cs-960.jpg', 'Транспорт'),
(21, 17, 'Гараж', 300000, 'Продам гараж по низкой цене. Гараж капитальный. Размер 4*6 метров. Имеется смотровая яма, свет.', 'img/index.jpg', 'Недвижимость');

-- --------------------------------------------------------

--
-- Структура таблицы `application`
--

CREATE TABLE `application` (
  `id_application` int(11) NOT NULL,
  `id_User` int(11) NOT NULL,
  `id_advertisement` int(11) NOT NULL,
  `applicationData` date NOT NULL,
  `applicationTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `application`
--

INSERT INTO `application` (`id_application`, `id_User`, `id_advertisement`, `applicationData`, `applicationTime`) VALUES
(1, 1, 4, '2021-11-17', '21:55:00'),
(2, 4, 1, '2021-11-15', '19:16:09'),
(3, 5, 2, '2021-11-03', '11:27:00'),
(4, 7, 1, '2021-11-02', '13:10:00'),
(5, 2, 1, '2021-11-05', '00:08:00'),
(6, 3, 2, '2021-11-15', '16:28:00'),
(7, 10, 9, '2021-11-16', '09:00:00'),
(8, 11, 9, '2021-11-16', '11:00:00'),
(9, 4, 7, '2021-11-17', '10:00:00'),
(10, 6, 9, '2021-11-07', '15:00:00'),
(11, 12, 3, '2021-11-01', '14:21:19'),
(12, 6, 8, '2021-11-08', '00:00:00'),
(13, 2, 9, '2021-11-01', '19:00:00'),
(14, 8, 4, '2021-11-30', '13:00:00'),
(15, 12, 4, '2021-11-29', '12:25:00'),
(16, 7, 5, '2021-11-30', '13:19:07'),
(17, 3, 8, '2021-11-30', '21:12:09'),
(18, 13, 7, '2021-11-30', '19:07:32'),
(19, 1, 9, '2021-12-01', '16:27:00'),
(20, 1, 7, '2021-12-01', '13:00:00'),
(21, 1, 8, '2021-12-01', '20:32:48'),
(22, 14, 7, '2021-12-16', '11:26:12'),
(23, 17, 1, '2021-12-16', '11:53:09'),
(24, 18, 2, '2021-12-16', '13:30:05'),
(25, 20, 4, '2021-12-22', '22:35:22'),
(26, 20, 8, '2021-12-22', '22:35:49'),
(27, 17, 7, '2021-12-22', '22:37:43');

-- --------------------------------------------------------

--
-- Структура таблицы `statistics`
--

CREATE TABLE `statistics` (
  `id_statistics` int(11) NOT NULL,
  `id_User` int(11) NOT NULL,
  `datein` date NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `statistics`
--

INSERT INTO `statistics` (`id_statistics`, `id_User`, `datein`, `city`) VALUES
(1, 1, '2021-12-08', 'Липецк'),
(2, 1, '2021-12-08', 'Липецк'),
(3, 10, '2021-12-09', 'Липецк'),
(4, 1, '2021-12-09', 'Липецк'),
(5, 1, '2021-12-09', 'Липецк'),
(6, 1, '2021-12-09', 'Липецк'),
(7, 1, '2021-12-09', 'Липецк'),
(8, 1, '2021-12-09', 'Липецк'),
(9, 1, '2021-12-15', 'Липецк'),
(10, 17, '2021-12-15', 'Липецк'),
(11, 17, '2021-12-15', 'Липецк'),
(12, 17, '2021-12-16', 'Липецк'),
(13, 17, '2021-12-16', 'Липецк'),
(14, 17, '2021-12-16', 'Липецк'),
(15, 17, '2021-12-16', 'Липецк'),
(16, 18, '2021-12-16', 'Липецк'),
(17, 18, '2021-12-16', 'Липецк'),
(18, 18, '2021-12-16', 'Липецк'),
(19, 18, '2021-12-16', 'Липецк'),
(20, 17, '2021-12-16', 'Липецк'),
(21, 17, '2021-12-16', 'Липецк'),
(22, 17, '2021-12-16', 'Липецк'),
(23, 17, '2021-12-16', 'Липецк'),
(24, 17, '2021-12-16', 'Липецк'),
(25, 17, '2021-12-16', 'Липецк'),
(26, 17, '2021-12-16', 'Липецк'),
(27, 17, '2021-12-16', 'Липецк'),
(28, 17, '2021-12-16', 'Липецк'),
(29, 17, '2021-12-16', 'Липецк'),
(30, 17, '2021-12-21', 'Липецк'),
(31, 17, '2021-12-21', 'Липецк'),
(32, 17, '2021-12-21', 'Липецк'),
(33, 17, '2021-12-21', 'Липецк'),
(34, 17, '2021-12-21', 'Липецк'),
(35, 17, '2021-12-22', 'Липецк'),
(36, 17, '2021-12-22', 'Липецк'),
(37, 17, '2021-12-22', 'Липецк'),
(38, 17, '2021-12-22', 'Липецк'),
(39, 17, '2021-12-22', 'Липецк'),
(40, 17, '2021-12-22', 'Липецк'),
(41, 17, '2021-12-22', 'Липецк'),
(42, 17, '2021-12-22', 'Липецк'),
(43, 17, '2021-12-22', 'Липецк'),
(44, 17, '2021-12-22', 'Липецк'),
(45, 17, '2021-12-22', 'Липецк'),
(46, 20, '2021-12-22', 'Липецк'),
(47, 20, '2021-12-22', 'Липецк'),
(48, 20, '2021-12-22', 'Липецк'),
(49, 17, '2021-12-22', 'Липецк');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id_User` int(11) NOT NULL,
  `telephone` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `patronymic` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `registrationDate` date NOT NULL,
  `token` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `idaccessLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id_User`, `telephone`, `name`, `surname`, `patronymic`, `email`, `password`, `registrationDate`, `token`, `idaccessLevel`) VALUES
(1, '89009853899', 'Софья', 'Федорова', 'Алексеевна', 'sonya-fedorova-2014@mail.ru', '0000', '2021-11-17', 'fgbajhdfb', 1),
(2, '89002920435', 'Альберт', 'Мамедов', 'Эдуардович', 'a.ma@mail.ru', '1111', '2021-11-17', 'fsaadhthb', 1),
(3, '89046867799', 'Екатерина', 'Семынина', 'Дмитриевна', 'kate@mail.ru', '1212', '2021-11-17', 'argq345vq35v', 2),
(4, '85750846858 ', 'Дмитрий', 'Кузнецов ', 'Иванович', 'aaa@mail.ru', '1321', '2021-11-17', '24tetw45y4getg', 2),
(5, '85750846858 ', 'Иван', 'Кузнецов', 'Иванович', 'aaa@mail.ru', '1321', '2021-11-17', '24tetw45y4getg', 2),
(6, '85350856858 ', 'Петр', 'Кузнецов', 'Иванович', 'a3a@mail.ru', '1521', '2021-11-17', '5tg4g45y4getg', 2),
(7, '85367896858 ', 'Данила', 'Суханов', 'Иванович', 'dan@mail.ru', '7654', '2021-11-17', '35ryku6gnhjtt4w', 2),
(8, '85208236234', 'Дмитрий ', 'Окулов ', 'Ильич', 'okulov@ya.ru', '12345', '2021-11-09', 'zgbzdfb', 2),
(9, '85202346234', 'Илья', 'Евсеев', 'Федорович', 'evseev@ya.ru', '99345', '2021-11-10', 'rfgv5sdfb', 2),
(10, '81115673564', 'Ева', 'Крылова', 'Матвеевна', 'eva@ya.ru', '993432', '2021-10-10', '34edfg45tgui', 2),
(11, '85462323564', 'Варвара', 'Мельникова', 'Ивановна', 'melnicova@ya.ru', '0909', '2020-10-10', '345tfg667h', 2),
(12, '85462323511', 'Даниил', 'Горбачев', 'Артемович', 'gorbachev@ya.ru', '1929', '2020-10-22', '3edvr456hn', 2),
(13, '82345664114', 'Кира', 'Трофимова', 'Алиевна', 'kira@yandex.ru', '6563', '2021-09-22', '34567ugcde4567u', 2),
(14, '85460983564', 'Петр', 'Горшков', 'Егорович', 'petya@ya.ru', '65462', '2020-10-22', 'lkjhgfd7654', 2),
(15, '85462323564', 'Егор', 'Иванов', 'Иванович', 'egorka@mail.ru', '23456', '2020-10-22', '23456trdxfew345', 2),
(16, '85367890858', 'Дмитрий', 'Кузнецов', 'Иванович', 'sdfghjkl@mail.ru', '090875', '2021-12-15', 'wertyuiop456789', 2),
(17, '89023451221', 'ирина', 'Пуствовалова', 'Павловна', 'irina@mail.ru', '$2y$10$0S1GujkwzIPSX2tjCgISfOLGwGe2YFIiGiZaFLHhTikM2U0SYW8HS', '2021-12-15', 'aasdasqwzcWA', 1),
(18, '89042920435', 'Альберт ', 'Мамедов', 'Эдуардович', 'albert.e.m@mail.ru', '$2y$10$q.XsE9.wz0A/esCy07nJhOT7tUimylEK0ZTvRf7sPtcCqV6gYP6GK', '2021-12-16', 'aasdasqwzcWA', 2),
(20, '+79182835647', 'Никита', 'Комаров', 'Алексеевич', 'komar@ya.ru', '$2y$10$jcF1mbPx2il4FlDaRSHyuuTZH3icDw62i/uWl8rnV7Jg7D9X./ssG', '2021-12-22', 'aasdasqwzcWA', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accesslevel`
--
ALTER TABLE `accesslevel`
  ADD PRIMARY KEY (`id_accessLevel`);

--
-- Индексы таблицы `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`id_advertisement`),
  ADD KEY `id_User` (`id_User`);

--
-- Индексы таблицы `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id_application`),
  ADD KEY `id_User` (`id_User`),
  ADD KEY `id_advertisement` (`id_advertisement`);

--
-- Индексы таблицы `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id_statistics`),
  ADD KEY `id_User` (`id_User`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_User`),
  ADD KEY `idaccessLevel` (`idaccessLevel`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accesslevel`
--
ALTER TABLE `accesslevel`
  MODIFY `id_accessLevel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `id_advertisement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `application`
--
ALTER TABLE `application`
  MODIFY `id_application` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id_statistics` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `advertisement`
--
ALTER TABLE `advertisement`
  ADD CONSTRAINT `advertisement_ibfk_1` FOREIGN KEY (`id_User`) REFERENCES `user` (`id_User`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`id_User`) REFERENCES `user` (`id_User`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`id_advertisement`) REFERENCES `advertisement` (`id_advertisement`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `statistics`
--
ALTER TABLE `statistics`
  ADD CONSTRAINT `statistics_ibfk_1` FOREIGN KEY (`id_User`) REFERENCES `user` (`id_User`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idaccessLevel`) REFERENCES `accesslevel` (`id_accessLevel`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
