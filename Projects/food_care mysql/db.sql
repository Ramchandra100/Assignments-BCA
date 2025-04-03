CREATE DATABASE IF NOT EXISTS food_waste_management
CREATE TABLE IF NOT EXISTS restaurants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);




CREATE TABLE IF NOT EXISTS beneficiaries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE food_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    food_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    contact VARCHAR(20) NOT NULL,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    FOREIGN KEY (food_id) REFERENCES food_donations(id) ON DELETE CASCADE
);

CREATE TABLE contact_message (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message TEXT NOT NULL,
    type VARCHAR(50) NOT NULL,  -- Can be 'success', 'warning', 'info', or 'error'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO notifications (message, type) VALUES
('✅ New food donation received.', 'success'),
('⚠️ Low stock warning at Community Center.', 'warning'),
('❌ Delivery delay due to traffic.', 'error'),
('ℹ️ Weekly donation report available.', 'info');

CREATE TABLE food_donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    food_name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    expiration_date DATE NOT NULL,
    location VARCHAR(255) NOT NULL,
    donor_name VARCHAR(255) NOT NULL,
    contact VARCHAR(20) NOT NULL,
    status ENUM('Pending', 'Approved') DEFAULT 'Pending'
);
INSERT INTO food_donations (food_name, quantity, expiry_date, location, donor_name, contact, status) 
VALUES ('niki', '10', '2025-03-29', 'kharadi', 'vina', '1234567890', 'Pending');

CREATE TABLE donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donor_name VARCHAR(255) NOT NULL,
    donor_email VARCHAR(255) NOT NULL,
    food_quantity VARCHAR(100) NOT NULL,
    food_type VARCHAR(255) NOT NULL,
    pickup_location TEXT NOT NULL,
    donation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
