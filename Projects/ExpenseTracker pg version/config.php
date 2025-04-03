<?php
session_start();
$con = pg_connect('host=localhost dbname=expense user=postgres password=your_password');

// CREATE TABLE category(id SERIAL PRIMARY KEY, name VARCHAR(255));

// CREATE TABLE users(id SERIAL PRIMARY KEY, userName VARCHAR(255), email VARCHAR(255), pass VARCHAR(255), role ENUM('Admin','User'), principleAmount FLOAT, leftAmount FLOAT);

// CREATE TABLE expense(id SERIAL PRIMARY KEY, price INT NOT NULL, detail VARCHAR(255), eDate DATE, userId INT, categoryId INT, FOREIGN KEY(userId) REFERENCES users(id), FOREIGN KEY(categoryId) REFERENCES category(id));

// -- Insert records into the category table
// INSERT INTO category (name) VALUES ('Electronics');
// INSERT INTO category (name) VALUES ('Clothing');
// INSERT INTO category (name) VALUES ('Books');
// INSERT INTO category (name) VALUES ('Home Decor');
// INSERT INTO category (name) VALUES ('Toys');

// -- Update the role of the user with id 2
// UPDATE users SET role = 'Admin' WHERE users.id = 2;


?>