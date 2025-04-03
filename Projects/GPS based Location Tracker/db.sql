CREATE DATABASE location_tracking;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    latitude DECIMAL(9,6),  -- Corrected syntax for DECIMAL type
    longitude DECIMAL(9,6)
);