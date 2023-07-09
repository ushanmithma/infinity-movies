CREATE DATABASE IF NOT EXISTS infinity_movies

CREATE TABLE movies (
	id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name text NOT NULL,
	age_rating char(20) NOT NULL,
	runtime char(20) NOT NULL,
	imdb_rating char(3) NOT NULL,
	imdb_rating_count int(11) NOT NULL,
	release_date char(20) NOT NULL,
	genres varchar(1000) NOT NULL,
	rotten_tomatoes int(3) NOT NULL,
	audience_score int(3) NOT NULL,
	rotten_rating_count int(11) NOT NULL,
	size char(20) NOT NULL,
	box_office int(11) NOT NULL,
	quality char(20) NOT NULL,
	directors varchar(1000) NOT NULL,
	description text NOT NULL,
	color text NOT NULL,
	trailer text NOT NULL,
	download_link text NOT NULL,
	download_count int(11) NOT NULL DEFAULT '0',
	sub_download_link text NOT NULL,
	sub_download_count int(11) NOT NULL DEFAULT '0',
	keywords text NOT NULL)

CREATE TABLE admins (
	id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(256) NOT NULL,
	username varchar(256) NOT NULL,
	password text NOT NULL,
	last_seen datetime NOT NULL)

CREATE TABLE users (
	id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	first_name varchar(256) NOT NULL,
	last_name varchar(256) NOT NULL,
	email varchar(256) NOT NULL,
	password varchar(256) NOT NULL,
	downloaded text)

CREATE TABLE requests (
	id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name text NOT NULL,
	year text,
	description text NOT NULL,
	user_id int(11) NOT NULL,
	FOREIGN KEY (id) REFERENCES users(id))

CREATE TABLE upcoming (
	id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name text NOT NULL,
	release_date char(20) NOT NULL,
	imdb_rating char(3) NOT NULL,
	trailer text NOT NULL)