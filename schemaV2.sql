-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-02-2018 a las 19:53:33
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: 'fromspace'
--

DROP TABLE IF EXISTS from_space_replyposts;
DROP TABLE IF EXISTS from_space_posts;
DROP TABLE IF EXISTS from_space_users;
DROP TABLE IF EXISTS from_space_users_c;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'users_c'
--

CREATE TABLE `from_space_users_c` (
  `id` int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `decoder` varchar(20) NOT NULL,
  `user` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'users'
--

CREATE TABLE `from_space_users` (
  `id` int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'posts'
--


CREATE TABLE `from_space_posts` (
  `id` int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ownership` int(20) NOT NULL,
  `title` VARCHAR(30) NOT NULL,
  `body` varchar(300) NOT NULL,
  FOREIGN KEY (ownership) REFERENCES from_space_users(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'replyposts'
--


CREATE TABLE `from_space_replyposts` (
  `post` int(20) NOT NULL,
  `ownership` int(20) NOT NULL,
  `body` varchar(300) NOT NULL,
   FOREIGN KEY (post) REFERENCES from_space_posts(id),
   FOREIGN KEY (ownership) REFERENCES from_space_users(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;