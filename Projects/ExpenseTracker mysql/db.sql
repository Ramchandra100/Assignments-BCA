$con = mysqli_connect('sql12.freesqldatabase.com', 'sql12768063', 'QeMCkp9UM6', 'sql12768063');


CREATE TABLE category(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,name varchar(255));

CREATE TABLE users(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,userName varchar(255),email varchar(255),pass varchar(255),role ENUM('Admin','User'),principleAmount float,leftAmount float);

CREATE TABLE expense(id INT NOT NULL AUTO_INCREMENT,price INT NOT NULL ,detail varchar(255),eDate date,userId int,categoryId int, PRIMARY KEY (id),FOREIGN KEY(userId) REFERENCES users(id),FOREIGN KEY(categoryId) REFERENCES category(id));


INSERT INTO category (name) VALUES ('Electronics');
INSERT INTO category (name) VALUES ('Clothing');
INSERT INTO category (name) VALUES ('Books');
INSERT INTO category (name) VALUES ('Home Decor');
INSERT INTO category (name) VALUES ('Toys');