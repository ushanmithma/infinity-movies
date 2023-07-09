-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2020 at 01:01 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infinity_movies`
--
CREATE DATABASE IF NOT EXISTS `infinity_movies` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `infinity_movies`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` text NOT NULL,
  `last_seen` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `password`, `last_seen`) VALUES
(1, 'Admin', 'admin', '$2y$10$eY.cDcgwTs0QVXnDw7w7GOBTVadlTyy.rKqvAIbf0GhPjjJQmx.I.', '2020-01-04 17:00:38'),
(2, 'Kosala Sansith', 'kosalasansith', '$2y$10$7FSG6uZPLvGsZOVeQxx6vOCEKT/.xPb/5.AAddzJTvs85t5ioaI6K', '0000-00-00 00:00:00'),
(3, 'Ushan Mithma', 'ushanmithma', '$2y$10$oTMafcUUJhKylhcNEyG20eBBY32AX0SxI0xMabD5eWFdYGrjOmzUy', '0000-00-00 00:00:00'),
(4, 'Greatest Lord', 'greatestlord', '$2y$10$kDgcLuh9OgZLhWSJGCv5yOpE5tGy.YRY7V/nK7MaEj03YXLfVsXjm', '0000-00-00 00:00:00'),
(5, 'Batman', 'batman', '$2y$10$qtiJQ6HaMIwg68S81gEzAe4h1XRNvz5k81UisBeYkp9ZEhSS/8VLW', '0000-00-00 00:00:00'),
(6, 'Superman', 'superman', '$2y$10$2yQfUlv4GOdMdCrmTi4epubEwGllVCoojPlwirFhEJI7EdHEBXUlG', '0000-00-00 00:00:00'),
(7, 'Wonder Woman', 'wonderwoman', '$2y$10$kjeXdTquBKP5XRu2HrmlEuXgHJ7ikEkZcsTylvbBkJWGR25IjM/lK', '0000-00-00 00:00:00'),
(8, 'Aquaman', 'aquaman', '$2y$10$nWE5m6Yia6bipoh8SLbfN.fFXhkeYaFTJhp.jrqWsrVn23W51En9i', '0000-00-00 00:00:00'),
(9, 'Flash', 'flash', '$2y$10$zBaxWRA2SWrfNFPY3QB1YObsJN4dRwz8rKjKfTfbNc2kHHuEh4wCq', '0000-00-00 00:00:00'),
(10, 'Cyborg', 'cyborg', '$2y$10$0T4qpEAit7P70pMXANfU0eJekL.KEM5kXEmyEpfcg9TPQgDNayejq', '0000-00-00 00:00:00'),
(11, 'LOCKDOWN', 'lockdown007x', '$2y$10$so4IbxjHVyzWtL1kcpYhPe9CTFcQnTDWvEVR7MVgDVvcDjpohuxWe', '0000-00-00 00:00:00'),
(12, 'Niraj Kavishka', 'neeka', '$2y$10$iu7HEakwEjn7J5HZTNbuFeFW3u3vwvOpPnZWVbSL0oPOkXfnp9bWW', '0000-00-00 00:00:00'),
(13, 'SL Venom', 'sl_venom', '$2y$10$fVOMou8Yg5J2PeQ63MT48OEIoUNuRRgfbErGjB5ZCUZDWh99HbfEW', '0000-00-00 00:00:00'),
(14, 'Lasiya', 'lasiya', '$2y$10$oH7XkRVEt6eSkVK0rUs/cOAvjYGy5F3hDZeLShAod6No4xVviVK0.', '0000-00-00 00:00:00'),
(15, 'Sinbad', 'sinbad', '$2y$10$nidLtEG343OnQDj/g/kz2eQZ.bkk.DnnqyyOxZDS.bzx7iumV9B.q', '0000-00-00 00:00:00'),
(16, 'Iron Man', 'ironman', '$2y$10$anxEbep6BJJhCQHthW8a3udOKUFDxYLtSiJ1gC/f8oLt.1tRuqTiu', '0000-00-00 00:00:00'),
(17, 'Doctor Strange', 'dr.strange', '$2y$10$7ip1cihlsby9r8EJfCgecedlfKc8nfYUY58wcW.GtMLQonRDScKUS', '0000-00-00 00:00:00'),
(18, 'Lex Luthor', 'lexluthor', '$2y$10$g9YUiMMc8289a.ixmJ3Tx.MfPHzvMvtUyzVHei7Ye7WXaOgKUfPJy', '0000-00-00 00:00:00'),
(19, 'Flient Lockwood', 'flientlockwood', '$2y$10$F6fr0g9F2.nPpqaCBZcH0eFmrMywLFoYJ8qDKWKPHzUj2v36TxX7a', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `age_rating` char(20) NOT NULL,
  `runtime` char(20) NOT NULL,
  `imdb_rating` char(3) NOT NULL,
  `imdb_rating_count` int(11) NOT NULL,
  `release_date` char(20) NOT NULL,
  `genres` varchar(1000) NOT NULL,
  `rotten_tomatoes` int(3) NOT NULL,
  `audience_score` int(3) NOT NULL,
  `rotten_rating_count` int(11) NOT NULL,
  `size` char(20) NOT NULL,
  `box_office` int(11) NOT NULL,
  `quality` char(20) NOT NULL,
  `directors` varchar(1000) NOT NULL,
  `description` text NOT NULL,
  `color` text NOT NULL,
  `trailer` text NOT NULL,
  `download_link` text NOT NULL,
  `download_count` int(11) NOT NULL DEFAULT '0',
  `sub_download_link` text NOT NULL,
  `sub_download_count` int(11) NOT NULL DEFAULT '0',
  `keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `age_rating`, `runtime`, `imdb_rating`, `imdb_rating_count`, `release_date`, `genres`, `rotten_tomatoes`, `audience_score`, `rotten_rating_count`, `size`, `box_office`, `quality`, `directors`, `description`, `color`, `trailer`, `download_link`, `download_count`, `sub_download_link`, `sub_download_count`, `keywords`) VALUES
(1, 'Spider-Man: Far from Home', 'PG-13', '2hr 9min', '7.6', 230045, '2019-07-02', 'Action, Adventure, Sci-Fi', 90, 95, 69200, '1.12GB', 1132000000, '720p WEB', 'Jon Watts', 'Following the events of Avengers: Endgame (2019), Spider-Man must step up to take on new threats in a world that has changed forever.', '#b11313', 'https://www.youtube.com/embed/Nt9L1jCKGnE', 'https://yts.lt/torrent/download/2785C4334EF835B25EC1202299F768EF22F53102', 2, 'https://www.yifysubtitles.com/subtitle/spider-manfarfromhome2019720pblurayx264ytsag-english-154721.zip', 0, 'spider man far from home, spider-man, avengers endgame, avengers infinity war, marvel, marvel cinematic universe'),
(2, 'The Lord of the Rings: The Fellowship of the Ring', 'PG-13', '3hr 48min', '8.8', 1547627, '2001-12-19', 'Adventure, Drama, Fantasy', 91, 95, 1355751, '1.5GB', 314000000, '720p BRRip', 'Peter Jackson', 'A meek Hobbit from the Shire and eight companions set out on a journey to destroy the powerful One Ring and save Middle-earth from the Dark Lord Sauron.', '#996633', 'https://www.youtube.com/embed/V75dMMIW2B4', 'https://yts.lt/torrent/download/E175ACD03B68BF0736DFC4B17D1D1496A455E01D', 2, 'https://www.yifysubtitles.com/subtitle/the-lord-of-the-rings-the-fellowship-of-the-ring-english-yify-1538.zip', 0, 'the lord of the rings the fellowship of the ring, the lord of the rings, lotr, aragorn, the lord of the rings trilogy, the lord of the rings series, jrr tolkien'),
(3, 'Avengers: Endgame', 'PG-13', '3hr 1min', '8.5', 599323, '2019-04-26', 'Action, Adventure, Drama', 94, 91, 66313, '1.42GB', 2147483647, '720p BRRip', 'Anthony Russo, Joe Russo', 'After the devastating events of Avengers: Infinity War (2018), the universe is in ruins. With the help of remaining allies, the Avengers assemble once more in order to reverse Thanos'' actions and restore balance to the universe.', '#1a1a64', 'https://www.youtube.com/embed/TcMBFSGVi1c', 'https://yts.lt/torrent/download/5A4140BD59D66BCAC57CF05AF4A8FAB4EBCAE1C1', 2, 'https://www.yifysubtitles.com/subtitle/avengersendgame2019720pblurayx264ytsag-english-152239.zip', 0, 'avengers endgame, marvel, avengers, marvel cinematic universe, avengers infinity war, avengers assemble, thanos'),
(4, 'Avengers: Infinity War', 'PG-13', '2hr 29min', '8.5', 724854, '2018-04-27', 'Action, Adventure, Sci-Fi', 85, 91, 57047, '1.24GB', 2048000000, '720p WEB', 'Anthony Russo, Joe Russo', 'The Avengers and their allies must be willing to sacrifice all in an attempt to defeat the powerful Thanos before his blitz of devastation and ruin puts an end to the universe.', '#d93d27', 'https://www.youtube.com/embed/6ZfuNTqbHE8', 'https://yts.lt/torrent/download/BCEB706EA32EDD855FCA4426DF8A7831F53CC3EE', 2, 'https://www.yifysubtitles.com/subtitle/avengersinfinitywar2018720pwebripx264-ytsam-english-130904.zip', 0, 'avengers infinity war, infinity war, avengers, marvel, marvel cinematic universe, thanos'),
(5, 'Batman v Superman: Dawn of Justice', 'PG-13', '3hr 2min', '6.5', 589705, '2016-03-25', 'Action, Adventure, Sci-Fi', 28, 63, 233722, '1.48GB', 872700000, '720p BRRip', 'Zack Snyder', 'Fearing that the actions of Superman are left unchecked, Batman takes on the Man of Steel, while the world wrestles with what kind of a hero it really needs.', '#1b1b1b', 'https://www.youtube.com/embed/0WWzgGyAH6Y', 'https://yts.lt/torrent/download/A0DF264C995A009B422E61D3EBFAB9FFFBF12AD1', 2, 'https://www.yifysubtitles.com/subtitle/batmanvsupermandawnofjustice2016extended1080pbluray6chshaanig-english-90433.zip', 0, 'batman v superman dawn of justice, dc extended universe, man of steel, batman, wonder woman'),
(6, 'Batman Begins', 'PG-13', '2hr 20min', '8.2', 1224083, '2005-06-15', 'Action, Adventure', 84, 94, 1114315, '849MB', 375200000, '720p BRRip', 'Christopher Nolan', 'After training with his mentor, Batman begins his fight to free crime-ridden Gotham City from corruption.', '#000066', 'https://www.youtube.com/embed/neY2xVmOfUM', 'https://yts.lt/torrent/download/A260FBC02AE0B4386677220BCCB18158512F5A0C', 2, 'https://www.yifysubtitles.com/subtitle/batman-begins-english-yify-975.zip', 0, 'batman begins, batman, christian bale'),
(7, 'The Dark Knight', 'PG-13', '2hr 32min', '9.0', 2132513, '2008-07-18', 'Action, Crime, Drama', 94, 94, 1831566, '949MB', 1005000000, '720p BRRip', 'Christopher Nolan', 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.', '#000033', 'https://www.youtube.com/embed/EXeTwQWrcwY', 'https://yts.lt/torrent/download/F5D61BF3D57082BA2EE1305DA5DF8DCD10D34539', 3, 'https://www.yifysubtitles.com/subtitle/the-dark-knight-english-yify-971.zip', 0, 'the dark knight, batman, joker, heath ledger, christian bale'),
(8, 'The Dark Knight Rises', 'PG-13', '2hr 44min', '8.4', 1420424, '2012-07-20', 'Action, Thriller', 87, 90, 1210974, '1.10GB', 1085000000, '720p BRRip', 'Christopher Nolan', 'Eight years after the Joker''s reign of anarchy, Batman, with the help of the enigmatic Catwoman, is forced from his exile to save Gotham City from the brutal guerrilla terrorist Bane.', '#00001a', 'https://www.youtube.com/embed/g8evyE9TuYk', 'https://yts.lt/torrent/download/CAEBDB751F2B541C9A420A15FB5C107494544285', 3, 'https://www.yifysubtitles.com/subtitle/the-dark-knight-rises-english-yify-1952.zip', 0, 'the dark knight rises, the dark knight, batman, bane, christian bale, tom hardy, dark knight'),
(9, 'Harry Potter and the Sorcerer''s Stone', 'PG', '2hr 32min', '7.6', 584257, '2001-11-16', 'Adventure, Family, Fantasy', 81, 82, 1157315, '550MB', 978087613, '720p BRRip', 'Chris Columbus', 'An orphaned boy enrolls in a school of wizardry, where he learns the truth about himself, his family and the terrible evil that haunts the magical world.', '#000066', 'https://www.youtube.com/embed/VyHV0BRtdxo', 'https://yts.lt/torrent/download/C483A8C04C800EB55EF652CAB3439F0D55DB475C', 1, 'https://www.yifysubtitles.com/subtitle/harry-potter-and-the-sorcerers-stone-english-yify-3275.zip', 0, 'harry potter and the sorcerer''s stone, harry potter and the philosopher''s stone, harry potter series, harry potter franchise, harry potter'),
(10, 'The Lord of the Rings: The Two Towers', 'PG-13', '3hr 55min', '8.7', 1386443, '2002-12-18', 'Adventure, Drama, Fantasy', 95, 95, 1341428, '1.34GB', 926000000, '720p BRRip', 'Peter Jackson', 'While Frodo and Sam edge closer to Mordor with the help of the shifty Gollum, the divided fellowship makes a stand against Sauron''s new ally, Saruman, and his hordes of Isengard.', '#00ffcc', 'https://www.youtube.com/embed/cvCktPUwkW0', 'https://yts.lt/torrent/download/2186007B26ACE9270FD6C9658213D081C698DC22', 2, 'https://www.yifysubtitles.com/subtitle/the-lord-of-the-rings-the-two-towers-english-yify-1553.zip', 0, 'the lord of the rings the two towers, the lord of the rings, the lord of the rings trilogy, lotr, two towers'),
(11, 'Shazam!', 'PG-13', '2hr 12min', '7.1', 190578, '2019-04-05', 'Action, Adventure, Comedy', 90, 83, 15331, '1.1GB', 364500000, '720p BRRip', 'David F. Sandberg', 'We all have a superhero inside us, it just takes a bit of magic to bring it out. In Billy Batson''s case, by shouting out one word - SHAZAM - this streetwise fourteen-year-old foster kid can turn into the grown-up superhero Shazam.', '#c13128', 'https://www.youtube.com/embed/go6GEIrcvFY', 'https://yts.lt/torrent/download/77FC1E25B1B295D7827022712CB89C994A193427', 1, 'https://www.yifysubtitles.com/subtitle/shazam2019720pblurayx264ytsag-english-150096.zip', 0, 'shazam!, shazam, dc extended universe, shazam 2019'),
(12, 'Aquaman', 'PG-13', '2hr 23min', '7.0', 310677, '2018-12-21', 'Action, Adventure, Fantasy', 65, 75, 33921, '1.22GB', 1148000000, '720p BRRip', 'James Wan', 'Arthur Curry, the human-born heir to the underwater kingdom of Atlantis, goes on a quest to prevent a war between the worlds of ocean and land.', '#499dad', 'https://www.youtube.com/embed/2wcj6SrX4zw', 'https://yts.lt/torrent/download/02478CCA63698A84D2E2456C6A2B0CF59868B1C6', 2, 'https://www.yifysubtitles.com/subtitle/aquaman2018720pwebripx264-ytsam-english-142540.zip', 0, 'aquaman, aquaman 2018, jason momoa'),
(13, 'Fantastic Beasts and Where to Find Them', 'PG-13', '2hr 12min', '7.3', 377481, '2016-11-18', 'Adventure, Family, Fantasy', 75, 79, 87534, '988.3MB', 812500000, '720p BRRip', 'David Yates', 'The adventures of writer Newt Scamander in New York''s secret community of witches and wizards seventy years before Harry Potter reads his book in school.', '#7f0909', 'https://www.youtube.com/embed/ViuDsy7yb8M', 'https://yts.lt/torrent/download/5EF0DA95695935FC2CB49078BB62BE7CDB5C4BDA', 1, 'https://www.yifysubtitles.com/subtitle/fantasticbeastsandwheretofindthem2016720pblurayx264-ytsag1080p-english-104994.zip', 0, 'fantastic beasts and where to find them, fantastic beasts series, fantastic beasts franchise, harry potter series, harry potter franchise'),
(14, 'It', 'R', '2hr 15min', '7.3', 407614, '2017-09-08', 'Horror', 86, 84, 66499, '997.65MB', 700400000, '720p BRRip', 'Andy Muschietti', 'In the summer of 1989, a group of bullied kids band together to destroy a shape-shifting monster, which disguises itself as a clown and preys on the children of Derry, their small Maine town.', '#663300', 'https://www.youtube.com/embed/FnCdOQsX5kc', 'https://yts.lt/torrent/download/2A79F446525BB495F86207072F6F2CC754CBF40A', 1, 'https://www.yifysubtitles.com/subtitle/it2017brripxvidmp3-rarbg-english-118566.zip', 0, 'it2017, itseries, itmovie'),
(15, 'Pirates of the Caribbean: The Curse of the Black Pearl', 'PG-13', '2hr 23min', '8.0', 977091, '2003-07-09', 'Action, Adventure, Fantasy', 79, 86, 33125722, '900.54MB', 654300000, '720p BRRip', 'Gore Verbinski', 'Blacksmith Will Turner teams up with eccentric pirate "Captain" Jack Sparrow to save his love, the governor''s daughter, from Jack''s former pirate allies, who are now undead.', '#af0303', 'https://www.youtube.com/embed/naQr0uTrH_s', 'https://yts.lt/torrent/download/031FE2BF7D426019DB128A7EE3E52C35B4634409', 1, 'https://www.yifysubtitles.com/subtitle/pirates-of-the-caribbean-the-curse-of-the-black-pearl-english-yify-36180.zip', 0, 'pirates of the caribbean the curse of the black pearl, pirates of the caribbean the curse of the black pearl 1, pirates of the caribbean the curse of the black pearl 2003, pirates of the caribbean series, pirates of the caribbean franchise'),
(16, 'Black Panther', 'PG-13', '2hr 14min', '7.3', 550729, '2018-02-16', 'Action, Adventure, Sci-Fi', 97, 79, 88211, '1.13GB', 1344000000, '720p BRRip', 'Ryan Coogler', 'T''Challa, heir to the hidden but advanced kingdom of Wakanda, must step forward to lead his people into a new future and must confront a challenger from his country''s past.', '#003366', 'https://www.youtube.com/embed/xjDjIWPwcPU', 'https://yts.lt/torrent/download/584CB082CB19D81DBABE3E201D89976459D495EA', 1, 'https://www.yifysubtitles.com/subtitle/blackpanther2018720pblurayx264-ytsam-english-125845.zip', 0, 'black panther, black panther 2018, marvel, marvel cinematic universe'),
(17, 'La La Land', 'PG-13', '2hr 8min', '8.0', 453244, '2016-12-25', 'Comedy, Drama, Music', 91, 81, 70521, '932.57MB', 446100000, '720p BRRip', 'Damien Chazelle', 'While navigating their careers in Los Angeles, a pianist and an actress fall in love while attempting to reconcile their aspirations for the future.', '#9900ff', 'https://www.youtube.com/embed/0pdqf4P9MB8', 'https://yts.lt/torrent/download/6F4CCD2AC62A59111DB59F9928B43BDAF8A390AF', 3, 'https://www.yifysubtitles.com/subtitle/lalaland2016brripxvidmp3-rarbg-english-107458.zip', 0, 'la la land, la la land 2016'),
(18, 'Pirates of the Caribbean: Dead Men Tell No Tales', 'PG-13', '2hr 9min', '6.6', 237732, '2017-05-26', 'Action, Adventure, Fantasy', 30, 61, 130439, '961.25MB', 794800000, '720p BRRip', 'Joachim RÃ¸nning, Espen Sandberg', 'Captain Jack Sparrow (Johnny Depp) searches for the trident of Poseidon while being pursued by an undead sea Captain and his crew.', '#6197ce', 'https://www.youtube.com/embed/a5V5C8mEVzY', 'https://yts.lt/torrent/download/36FDA3A596D905103529251503F0A5CF24290551', 1, 'https://www.yifysubtitles.com/subtitle/piratesofthecaribbeandeadmentellnotales20171080pblurayx264-ytsag-english-114176.zip', 0, 'pirates of the caribbean dead men tell no tales, pirates of the caribbean dead men tell no tales 2017, pirates of the caribbean series, pirates of the caribbean franchise'),
(19, 'Ready Player One', 'PG-13', '2hr 20min', '7.5', 319917, '2018-03-29', 'Action, Adventure, Sci-Fi', 72, 77, 24517, '1.17GB', 582900000, '720p BRRip', 'Steven Spielberg', 'When the creator of a virtual reality called the OASIS dies, he makes a posthumous challenge to all OASIS users to find his Easter Egg, which will give the finder his fortune and control of his world.', '#6600cc', 'https://www.youtube.com/embed/rjLVCpE3kuw', 'https://yts.lt/torrent/download/996B12CB3FF3628FAA3A02F385AF23716BD1CA75', 1, 'https://www.yifysubtitles.com/subtitle/readyplayerone2018web-dlxvidmp3-fgt-english-128399.zip', 0, 'ready player one, ready player one 2018, ready player one, steven spielberg'),
(20, 'Harry Potter and the Chamber of Secrets', 'PG', '2hr 41min', '7.4', 506097, '2002-11-15', 'Adventure, Family, Fantasy', 83, 80, 1150588, '600MB', 879465594, '720p BRRip', 'Chris Columbus', 'An ancient prophecy seems to be coming true when a mysterious presence begins stalking the corridors of a school of magic and leaving its victims paralyzed.', '#003300', 'https://www.youtube.com/embed/1bq0qff4iF8', 'https://yts.lt/torrent/download/B6DC52BD753674B57B143A515CD871B5027F0522', 1, 'https://www.yifysubtitles.com/subtitle/harry-potter-and-the-chamber-of-secrets-english-yify-573.zip', 0, 'harry potter and the chamber of secrets, harry potter and the chamber of secrets 2002, harry potter series, harry potter franchise, harry potter'),
(21, 'Avatar', 'PG-13', '2hr 42min', '7.8', 1066193, '2009-12-18', 'Action, Adventure, Fantasy', 82, 82, 1382004, '2.0GB', 2147483647, '720p BRRip', 'James Cameron', 'A paraplegic Marine dispatched to the moon Pandora on a unique mission becomes torn between following his orders and protecting the world he feels is his home.', '#1c3f6e', 'https://www.youtube.com/embed/5PSNL1qE6VY', 'https://yts.lt/torrent/download/1FA82D9959257AFC7D849D7B014BDD2F76BD2C05', 1, 'https://www.yifysubtitles.com/subtitle/avatar-extended-collectors-edition-2009-1080p-brrip-x264-yify-english-87555.zip', 0, 'avatar, avatar 2009, avatar james cameron, avater'),
(22, 'The Lord of the Rings: The Return of the King', 'PG-13', '4hr 23min', '8.9', 1532986, '2003-12-17', 'Adventure, Drama, Fantasy', 93, 86, 34679773, '1.6GB', 1120000000, '720p BRRip', 'Peter Jackson', 'Gandalf and Aragorn lead the World of Men against Sauron''s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.', '#999966', 'https://www.youtube.com/embed/r5X-hFf6Bwo', 'https://yts.lt/torrent/download/FDF8D3EB9CD78DE60C3CBB3B68AF6C8A7D560E67', 3, 'https://www.yifysubtitles.com/subtitle/the-lord-of-the-rings-the-return-of-the-king-english-yify-1537.zip', 0, 'the lord of the rings the return of the king, the lord of the rings, lotr, aragorn, the lord of the rings trilogy, the lord of the rings series, jrr tolkien'),
(23, 'The Hobbit: An Unexpected Journey', 'PG-13', '3hr 2min', '7.8', 728340, '2012-12-14', 'Adventure, Family, Fantasy', 64, 83, 482891, '1.83GB', 1021000000, '720p BRRip', 'Peter Jackson', 'A reluctant Hobbit, Bilbo Baggins, sets out to the Lonely Mountain with a spirited group of dwarves to reclaim their mountain home, and the gold within it from the dragon Smaug.', '#009933', 'https://www.youtube.com/embed/SDnYMbYB-nU', 'https://yst.am/torrent/download/0671B1402F497B71867AB54B5A404DC91A20047E', 1, 'https://www.yifysubtitles.com/subtitle/the-hobbit-an-unexpected-journey-english-yify-412.zip', 0, 'the hobbit an unexpected journey, the hobbit 2012, the hobbit an unexpected journey 2012, the hobbit series, the hobbit franchise, the hobbit trilogy, lotr, the hobbit 1'),
(24, 'The Hobbit: The Desolation of Smaug', 'PG-13', '3hr 6min', '7.8', 573998, '2013-12-13', 'Adventure, Fantasy', 74, 85, 264026, '1.88GB', 958000000, '720p BRRip', 'Peter Jackson', 'The dwarves, along with Bilbo Baggins and Gandalf the Grey, continue their quest to reclaim Erebor, their homeland, from Smaug. Bilbo Baggins is in possession of a mysterious and magical ring.', '#996633', 'https://www.youtube.com/embed/fnaojlfdUbs', 'https://yts.lt/torrent/download/8ED5613286DCFE9B5C9380839FF01C0E3E93BBA4', 1, 'https://www.yifysubtitles.com/subtitle/the-hobbit-the-desolation-of-smaug-english-yify-9349.zip', 0, 'the hobbit the desolation of smaug, the hobbit 2013, the hobbit the desolation of smaug 2013, the hobbit 2, the hobbit series, the hobbit franchise, the hobbit trilogy, lotr'),
(25, 'The Hobbit: The Battle of the Five Armies', 'PG-13', '2hr 44min', '7.4', 447152, '2014-12-17', 'Adventure, Fantasy', 59, 74, 214815, '1.88GB', 956000000, '720p BRRip', 'Peter Jackson', 'Bilbo and company are forced to engage in a war against an array of combatants and keep the Lonely Mountain from falling into the hands of a rising darkness.', '#003300', 'https://www.youtube.com/embed/iVAgTiBrrDA', 'https://yts.lt/torrent/download/EA974AA1432B16C764DA618453CEBCFF7812EAAD', 1, 'https://www.yifysubtitles.com/subtitle/the-hobbit-the-battle-of-the-five-armies-english-yify-40696.zip', 0, 'the hobbit the battle of the five armies, the hobbit 2014, the hobbit the battle of the five armies 2014, the hobbit 3, the hobbit series, the hobbit franchise, the hobbit trilogy, lotr'),
(26, 'It Chapter Two', 'R', '2hr 49min', '6.8', 113609, '2019-09-06', 'Drama, Fantasy, Horror', 63, 78, 30866, '1.47GB', 466500000, '720p WEB', 'Andy Muschietti', 'Twenty-seven years after their first encounter with the terrifying Pennywise, the Losers Club have grown up and moved away, until a devastating phone call brings them back.', '#669999', 'https://www.youtube.com/embed/xhJ5P7Up3jA', 'https://yts.lt/torrent/download/F31C44414B8AD283E79E35A51AD2C495B51CAA45', 1, 'https://www.yifysubtitles.com/subtitle/itchaptertwo2019720pwebripx264-ytslt-english-157985.zip', 0, 'it chapter two, it chapter two 2019, itseries, itmovie'),
(27, 'Fast & Furious Presents: Hobbs & Shaw', 'PG-13', '2hr 17min', '6.5', 119918, '2019-08-02', 'Action, Adventure', 67, 88, 27676, '1.19GB', 758900000, '720p BRRip', 'David Leitch', 'Lawman Luke Hobbs (Dwayne "The Rock" Johnson) and outcast Deckard Shaw (Jason Statham) form an unlikely alliance when a cyber-genetically enhanced villain threatens the future of humanity.', '#0099cc', 'https://www.youtube.com/embed/HZ7PAyCDwEg', 'https://yts.lt/torrent/download/5D48660C59475FBFAC03071BACDDE89E751BF5FF', 2, 'https://www.yifysubtitles.com/subtitle/the-fast-and-the-furious-hobbs-and-shaw-web-dlwebrip1080p720p-english-155060.zip', 1, 'fast and furious presents hobbs and shaw 2019, fast and furious hobbs and shaw 2019, fast & furious hobbs and shaw, fast & furious series, fast&furious'),
(28, 'Charlie and the Chocolate Factory', 'PG', '1hr 55min', '6.6', 399540, '2005-07-15', 'Adventure, Comedy, Fantasy', 83, 51, 32495606, '751.02MB', 475000000, '720p BRRip', 'Tim Burton', 'A young boy wins a tour through the most magnificent chocolate factory in the world, led by the world''s most unusual candy maker.', '#ff0066', 'https://www.youtube.com/embed/OFVGCUIXJls', 'https://yts.lt/torrent/download/34C48DCAF4F99321BF39C6CFE2A7828BB0877A87', 2, 'https://www.yifysubtitles.com/subtitle/charlie-and-the-chocolate-factory-english-yify-2326.zip', 1, 'charlie and the chocolate factory 2005, charlie and the chocolate factory movie, chocolate factory'),
(29, 'Joker', 'R', '2hr 2min', '8.7', 521815, '2019-10-04', 'Crime, Drama, Thriller', 69, 88, 65342, '1.06GB', 1060342715, '720p WEB', 'Todd Phillips', 'In Gotham City, mentally troubled comedian Arthur Fleck is disregarded and mistreated by society. He then embarks on a downward spiral of revolution and bloody crime. This path brings him face-to-face with his alter-ego: the Joker.', '#b32d00', 'https://www.youtube.com/embed/zAGVQLHvwOY', 'https://yts.lt/torrent/download/33435E0D8EE7311F5AC93531A402F7A002E4A750', 3, 'https://www.yifysubtitles.com/subtitle/joker2019720pwebripx264-ytslt-english-160037.zip', 1, 'joker 2019, the joker, joker movie, the dark knight'),
(30, 'The Addams Family', 'PG', '1hr 26min', '5.8', 9887, '2019-10-11', 'Animation, Comedy, Family', 43, 69, 10280, '772.04MB', 197085807, '720p WEB', 'Greg Tiernan, Conrad Vernon', 'The eccentrically macabre family moves to a bland suburb where Wednesday Addams'' friendship with the daughter of a hostile and conformist local reality show host exacerbates conflict between the families.', '#003366', 'https://www.youtube.com/embed/xFCrR3Uw6Mk', 'https://yts.lt/torrent/download/AE0C6C4F6FE6DD8D03DEB1E0DEF1AE4E2EB87ABE', 0, 'https://www.yifysubtitles.com/subtitle/theaddamsfamily2019720pwebripx264-ytslt-english-160535.zip', 1, 'the addams family'),
(31, 'Maleficent: Mistress of Evil', 'PG', '1hr 59min', '7.0', 29569, '2019-10-18', 'Adventure, Family, Fantasy', 40, 95, 19033, '1.03GB', 490372862, '720p WEB', 'Joachim RÃ¸nning', 'Maleficent and her goddaughter Aurora begin to question the complex family ties that bind them as they are pulled in different directions by impending nuptials, unexpected allies, and dark new forces at play.', '#333300', 'https://www.youtube.com/embed/n0OFH4xpPr4', 'https://yts.lt/torrent/download/87880152C046DAFDBE099B5A839B1B155E8F1B45', 0, 'https://www.yifysubtitles.com/subtitle/maleficentmistressofevil2019720pblurayx264ytsag-english-161053.zip', 2, 'maleficent mistress of evil'),
(32, 'Lady and the Tramp', 'PG', '1hr 43min', '6.3', 6831, '2019-11-12', 'Adventure, Comedy, Drama', 65, 55, 432, '889.8MB', 1, '720p WEB', 'Charlie Bean', 'An upper-middle-class American cocker spaniel named Lady and a street-smart, stray schnauzer called Tramp embark on many adventures.', '#cc3300', 'https://www.youtube.com/embed/A2ZDDU34gYw', 'https://yts.lt/torrent/download/F1342A771D04771DCDC303381833F07B8B94AC33', 0, 'https://www.yifysubtitles.com/subtitle/ladyandthetramp2019720pblurayx264ytsag-english-159158.zip', 0, 'lady and the tramp 2019'),
(33, 'Harry Potter and the Prisoner of Azkaban', 'PG', '2hr 22min', '7.9', 507155, '2004-06-04', 'Adventure, Family, Fantasy', 90, 86, 1167912, '550MB', 796093802, '720p BRRip', 'Alfonso CuarÃ³n', 'It''s Harry''s (Daniel Radcliffe''s) third year at Hogwarts; not only does he have a new "Defense Against the Dark Arts" teacher, Professor Lupin (David Thewlis), but there is also trouble brewing. Convicted murderer Sirius Black (Gary Oldman) has escaped the Wizards'' Prison and is coming after Harry.', '#333300', 'https://www.youtube.com/embed/lAxgztbYDbs', 'https://yts.lt/torrent/download/C0F96FE1D7F1CC6C33DC3233615B1EFB76DC4B70', 0, 'https://www.yifysubtitles.com/subtitle/harry-potter-and-the-prisoner-of-azkaban-english-yify-574.zip', 0, 'harry potter and the prisoner of azkaban, harry potter and the prisoner of azkaban 2004, harry potter series, harry potter franchise, harry potter'),
(34, 'Harry Potter and the Goblet of Fire', 'PG-13', '2hr 37min', '7.7', 505624, '2005-11-18', 'Adventure, Family, Fantasy', 88, 74, 34153607, '600MB', 896346229, '720p BRRip', 'Mike Newell', 'Harry Potter (Daniel Radcliffe) finds himself competing in a hazardous tournament between rival schools of magic, but he is distracted by recurring nightmares.', '#990033', 'https://www.youtube.com/embed/3EGojp4Hh6I', 'https://yts.lt/torrent/download/1FFC246E37E945A5D88D2D0D43F7B590F5BA02F7', 0, 'https://www.yifysubtitles.com/subtitle/harry-potter-and-the-goblet-of-fire-english-yify-577.zip', 0, 'harry potter and the goblet of fire, harry potter and the goblet of fire 2005, harry potter series, harry potter franchise, harry potter'),
(35, 'Harry Potter and the Order of the Phoenix', 'PG-13', '2hr 18min', '7.5', 470148, '2007-07-11', 'Action, Adventure, Family', 78, 81, 2333005, '550MB', 938580405, '720p BRRip', 'David Yates', 'With their warning about Lord Voldemort''s (Ralph Fiennes'') return scoffed at, Harry (Daniel Radcliffe) and Dumbledore (Sir Michael Gambon) are targeted by the Wizard authorities as an authoritarian bureaucrat slowly seizes power at Hogwarts.', '#336600', 'https://www.youtube.com/embed/y6ZW7KXaXYk', 'https://yts.lt/torrent/download/9FB3221627DC4D437A8FDB6829258EB5C83A2FE5', 0, 'https://www.yifysubtitles.com/subtitle/harry-potter-and-the-order-of-the-phoenix-english-yify-578.zip', 0, 'harry potter and the order of the phoenix, harry potter and the order of the phoenix 2007, harry potter series, harry potter franchise, harry potter'),
(36, 'Harry Potter and the Half-Blood Prince', 'PG', '2hr 33min', '7.6', 434443, '2009-07-15', 'Action, Adventure, Family', 83, 78, 1558902, '650MB', 934326396, '720p BRRip', 'David Yates', 'As Harry Potter (Daniel Radcliffe) begins his sixth year at Hogwarts, he discovers an old book marked as "the property of the Half-Blood Prince" and begins to learn more about Lord Voldemort''s (Ralph Fiennes'') dark past.', '#336699', 'https://www.youtube.com/embed/sg81Lts5kYY', 'https://yts.lt/torrent/download/A3FE0AB5EC6AEB66EC955202998933E9C239AE1B', 0, 'https://www.yifysubtitles.com/subtitle/harry-potter-and-the-half-blood-prince-english-yify-580.zip', 0, 'harry potter and the half blood prince, harry potter and the half blood prince 2009, harry potter series, harry potter franchise, harry potter'),
(37, 'Harry Potter and the Deathly Hallows: Part 1', 'PG-13', '2hr 26min', '7.7', 440925, '2010-11-19', 'Adventure, Family, Fantasy', 77, 85, 351409, '998.56MB', 960666490, '720p BRRip', 'David Yates', 'As Harry (Daniel Radcliffe), Ron (Rupert Grint), and Hermione (Emma Watson) race against time and evil to destroy the Horcruxes, they uncover the existence of the three most powerful objects in the wizarding world: the Deathly Hallows.', '#003366', 'https://www.youtube.com/embed/9hXH0Ackz6w', 'https://yts.lt/torrent/download/33BC7EAA9763181EB7E77AF08674D2055ACEB908', 0, 'https://www.yifysubtitles.com/subtitle/harry-potter-and-the-deathly-hallows-part-1-english-yify-584.zip', 0, 'harry potter and the deathly hallows part 1, harry potter and the deathly hallows part 1 2010, harry potter series, harry potter franchise, harry potter'),
(38, 'Harry Potter and the Deathly Hallows: Part 2', 'PG-13', '2hr 10min', '8.1', 712945, '2011-07-15', 'Adventure, Drama, Fantasy', 96, 89, 391319, '1.00GB', 1341932398, '720p BRRip', 'David Yates', 'Harry (Daniel Radcliffe), Ron (Rupert Grint), and Hermione (Emma Watson) search for Voldemort''s (Ralph Fiennes'') remaining Horcruxes in their effort to destroy the Dark Lord as the final battle rages on at Hogwarts.', '#003333', 'https://www.youtube.com/embed/5NYt1qirBWg', 'https://yts.lt/torrent/download/180BAF28690926163D5D0359EFAE1CC104A6C98C', 0, 'https://www.yifysubtitles.com/subtitle/harry-potter-and-the-deathly-hallows-part-2-english-yify-853.zip', 0, 'harry potter and the deathly hallows part 2, harry potter and the deathly hallows part 2 2011, harry potter series, harry potter franchise, harry potter');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `year` text,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `name`, `year`, `description`, `user_id`) VALUES
(1, 'Joker', '2019', 'I have requested Joker movie which johain phoenix is acted.', 11),
(2, 'Jumanji: The Next Level', '', 'Jumanji: The Next Level', 11);

-- --------------------------------------------------------

--
-- Table structure for table `upcoming`
--

CREATE TABLE `upcoming` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `release_date` char(20) NOT NULL,
  `imdb_rating` char(3) NOT NULL,
  `trailer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upcoming`
--

INSERT INTO `upcoming` (`id`, `name`, `release_date`, `imdb_rating`, `trailer`) VALUES
(1, 'Frozen II', '2019-11-22', '7.3', 'https://www.youtube.com/embed/Zi4LMpSDccc'),
(2, 'Jumanji: The Next Level', '2019-12-13', '7.0', 'https://www.youtube.com/embed/rBxcF-r9Ibs'),
(3, 'Ford v Ferrari', '2019-11-15', '8.3', 'https://www.youtube.com/embed/I3h9Z89U9ZA'),
(4, 'Sonic the Hedgehog', '2020-02-14', '0.0', 'https://www.youtube.com/embed/szby7ZHLnkA'),
(5, 'Dolittle', '2020-01-17', '0.0', 'https://www.youtube.com/embed/FEf412bSPLs'),
(7, 'Midway', '2019-11-08', '6.9', 'https://www.youtube.com/embed/BfTYY_pac8o'),
(8, 'Onward', '2020-03-06', '0.0', 'https://www.youtube.com/embed/gn5QmllRCn4'),
(9, 'Peter Rabbit 2: The Runaway', '2020-04-03', '0.0', 'https://www.youtube.com/embed/PWBcqCz7l_c'),
(10, 'Scoob!', '2020-05-15', '0.0', 'https://www.youtube.com/embed/ZnKvQbpDYXU'),
(11, 'Soul', '2020-06-19', '0.0', 'https://www.youtube.com/embed/4TojlZYqPUo'),
(12, 'Spies in Disguise', '2019-12-25', '6.5', 'https://www.youtube.com/embed/A05s7OM-8Oc'),
(13, 'The SpongeBob Movie: Sponge on the Run', '2020-05-22', '0.0', 'https://www.youtube.com/embed/HfiH_526qhY'),
(14, 'Jungle Cruise', '2020-07-24', '0.0', 'https://www.youtube.com/embed/ydnzilTiBcY'),
(15, 'Tenet', '2020-07-17', '0.0', 'https://www.youtube.com/embed/LdOM0x0XDMo'),
(16, 'Wonder Woman 1984', '2020-06-05', '0.0', 'https://www.youtube.com/embed/sfM7_JLk-84'),
(17, 'Birds of Prey: And the Fantabulous Emancipation of One Harley Quinn', '2020-02-07', '0.0', 'https://www.youtube.com/embed/kGM4uYZzfu0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `downloaded` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `downloaded`) VALUES
(1, 'Admin', 'Member', 'admin@abc.lk', '$2y$10$FCB92y5C2lXGWJvfuJW0wOca6.jtIdUkiWhvhwA4KEb8BkgJ7Hk8.', ''),
(2, 'Greatest', 'Lord', 'greatestlords@gmail.com', '$2y$10$7TSwyx0ic6yEb0RnUnOznONxxRuVxDTJBX810yRd4K3xbFOuJLvAG', '7,8,6,22,2,10,17,3,12,4,1,29,27,28,5,'),
(3, 'Kosala', 'Sansith', 'kosalasansith@yahoo.com', '$2y$10$RmRu.yg3DYRXNLaXB.WhaOJe0hM9F8tXUAw5h4w0hyaNyjtecKQ5y', '7,22,8,17,29,'),
(4, 'piumi', 'sandeepani', 'piumisandeepani6@gmail.com', '$2y$10$WF.YOjTRe4HuqTG45MYk3uQHluKJNtCdqVi2Q.6RqbjlDMdBtZ0/e', NULL),
(5, 'Sakura', 'Dayananda', 'sakuradayananda45@gmail.com', '$2y$10$y9wTKBIrMv3GsuipodM23ezRYaCV9i2zmLK2DQfHk.RBpfHzwnsDa', NULL),
(6, 'Lahiru', 'Adoms', 'lahiruavishka@gmail.com', '$2y$10$x2Kz4lKRKdToN8ahuTJUROQXIlvvuYeY.Yplruzk9rnvOCeuQ4.De', NULL),
(7, 'Dushan', 'Wijethunga', 'Dushan.wijethunga@gmail.com', '$2y$10$iZze.1hB7jSLv7pPzGvRH.uc69yA/92IpEo3kpA8XHZwPjVePl67W', NULL),
(8, 'shehan', 'mihiraga', 'sheaahn@gmail.com', '$2y$10$7CAoAgooS33sPnsTNUCzouBepYtI7e3uWD6164mr9zFIGrsS4Eohy', NULL),
(9, 'Niraj', 'Rajapakhsapaka', 'nirajkavishka98@gmail.com', '$2y$10$7//3dPkcAvPnTHZX9kCm0uUUa305Qyvk6zu2ifYvp.IYJOXqLXWyC', NULL),
(10, 'Buddhika', 'Kanchana', 'm.b.k.hemachandra@gmail.com', '$2y$10$5uVIYS9v00Rr9X/aLoXwvOg4Q8KqS8JQme5HqXKD8BOaWXGUnPHGa', NULL),
(11, 'Ushan', 'Mithma', 'ushanmithmakumara@gmail.com', '$2y$10$p5iBi8xk99HPyte74ejYw.z7pxfa6ViIN0Vle2wtUIV2FTTFR.0ae', '7,6,8,5,11,12,15,18,20,9,13,22,2,10,25,23,24,17,26,14,19,21,1,3,4,16,29,28,27,'),
(12, 'lasindu', 'madusanka', 'vtalasindu@gmail.com', '$2y$10$PJHQsARaPyDEyKqa3.dNdetCBnHnQUv9pNEifM7r8tOIkHFMDtRT2', NULL),
(13, 'Arshad', 'SPARDA', 'abc123@gmail.com', '$2y$10$fr//9wAt4/MbJR.vrsA4g.mqfdbi8faglFxC3uTk/JP36QVLyAa7K', NULL),
(14, 'ishara', 'soft', 'ishaft@gmail.com', '$2y$10$f2fpF.nOIvp/W8Qm6y.JvuJDk7J.j1PMKyeuhvhG4aRd1yGOQQJku', NULL),
(15, 'John', 'Doe', 'johndoe@gmail.com', '$2y$10$IKr.Ereel3.AIYEaf5T8SuYQmeqvVYL5jLvecFbDqI5poXFdkSPmO', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upcoming`
--
ALTER TABLE `upcoming`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `upcoming`
--
ALTER TABLE `upcoming`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
