-- Drop the `notifications` table
DROP TABLE IF EXISTS notifications;

-- Drop the `contact_messages` table
DROP TABLE IF EXISTS contact_messages;

-- Drop the `food_requests` table
DROP TABLE IF EXISTS food_requests;

-- Drop the `admins` table
DROP TABLE IF EXISTS admins;

-- Drop the `beneficiaries` table (Note: Corrected the typo from 'beneficiaries' to 'beneficiaries')
DROP TABLE IF EXISTS beneficiaries;

-- Drop the `restaurants` table
DROP TABLE IF EXISTS restaurants;

-- Drop the `food_donations` table
DROP TABLE IF EXISTS food_donations;

-- Drop the `team` table
DROP TABLE IF EXISTS team;

-- Drop the `testimonials` table
DROP TABLE IF EXISTS testimonials;


-- Create the `food_donations` table first
CREATE TABLE IF NOT EXISTS food_donations (
    id SERIAL PRIMARY KEY,
    food_name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    expiration_date DATE NOT NULL,
    location VARCHAR(255) NOT NULL,
    donor_name VARCHAR(255) NOT NULL,
    contact VARCHAR(20) NOT NULL,
    status VARCHAR(50) DEFAULT 'Pending'
);

-- Create the `restaurants` table
CREATE TABLE IF NOT EXISTS restaurants (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the `beneficiaries` table
CREATE TABLE IF NOT EXISTS beneficiaries (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the `admins` table
CREATE TABLE IF NOT EXISTS admins (
    id SERIAL PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the `food_requests` table after `food_donations` table
CREATE TABLE IF NOT EXISTS food_requests (
    id SERIAL PRIMARY KEY,
    food_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    contact VARCHAR(20) NOT NULL,
    address VARCHAR(255) NOT NULL,
    status VARCHAR(50) DEFAULT 'Pending',
    FOREIGN KEY (food_id) REFERENCES food_donations(id) ON DELETE CASCADE
);

-- Create the `contact_messages` table
CREATE TABLE IF NOT EXISTS contact_messages (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the `notifications` table
CREATE TABLE IF NOT EXISTS notifications (
    id SERIAL PRIMARY KEY,
    message TEXT NOT NULL,
    type VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert data into `restaurants` table
INSERT INTO restaurants (name, email, phone, address, password) VALUES
('Spicy Delights', 'spicy@gmail.com', '1234567890', '123 Curry Street, Pune', 'password123'),
('Ocean Bites', 'oceanbites@gmail.com', '1234567891', '456 Seafood Lane, Pune', 'password456'),
('Green Bowl', 'greenbowl@gmail.com', '1234567892', '789 Vegan Avenue, Pune', 'password789'),
('Grill House', 'grillhouse@gmail.com', '1234567893', '101 Barbecue Street, Pune', 'password101'),
('Sweet Treats', 'sweettreats@gmail.com', '1234567894', '202 Dessert Road, Pune', 'password202'),
('Pizza Corner', 'pizza@gmail.com', '1234567895', '303 Cheese Lane, Pune', 'password303'),
('Noodle Nest', 'noodlenest@gmail.com', '1234567896', '404 Wok Way, Pune', 'password404'),
('Taco Haven', 'tacohaven@gmail.com', '1234567897', '505 Salsa Road, Pune', 'password505');

-- Insert data into `beneficiaries` table
INSERT INTO beneficiaries (name, email, phone, address, password) VALUES
('John Doe', 'johndoe@gmail.com', '9876543210', '321 Helper Street, Pune', 'secure123'),
('Jane Smith', 'janesmith@gmail.com', '9876543211', '654 Hope Avenue, Pune', 'secure456'),
('Michael Brown', 'michael@gmail.com', '9876543212', '789 Charity Road, Pune', 'secure789'),
('Emily Davis', 'emily@gmail.com', '9876543213', '101 Love Lane, Pune', 'secure101'),
('Sarah Wilson', 'sarah@gmail.com', '9876543214', '202 Care Street, Pune', 'secure202'),
('James Moore', 'james@gmail.com', '9876543215', '303 Kindness Way, Pune', 'secure303'),
('Laura Scott', 'laura@gmail.com', '9876543216', '404 Joy Drive, Pune', 'secure404'),
('Paul Adams', 'paul@gmail.com', '9876543217', '505 Giving Road, Pune', 'secure505');

-- Insert data into `admins` table
INSERT INTO admins (email, password) VALUES
('admin1@gmail.com', '123'),
('admin2@gmail.com', 'admin456'),
('admin3@gmail.com', 'admin789'),
('admin4@gmail.com', 'admin101'),
('admin5@gmail.com', 'admin202'),
('admin6@gmail.com', 'admin303'),
('admin7@gmail.com', 'admin404'),
('admin8@gmail.com', 'admin505');

-- Insert data into `food_donations` table
INSERT INTO food_donations (food_name, quantity, expiration_date, location, donor_name, contact) VALUES
('Rice', 50, '2025-04-10', 'Central Pune', 'Rajesh Kumar', '1234567890'),
('Wheat', 20, '2025-04-08', 'North Pune', 'Anita Sharma', '1234567891'),
('Vegetables', 30, '2025-04-05', 'West Pune', 'Vikram Singh', '1234567892'),
('Fruits', 40, '2025-04-12', 'East Pune', 'Meena Patel', '1234567893'),
('Milk', 10, '2025-04-02', 'Central Pune', 'Prakash Gupta', '1234567894'),
('Bread', 15, '2025-04-06', 'South Pune', 'Kiran Rao', '1234567895'),
('Biscuits', 25, '2025-04-09', 'North Pune', 'Sunita Roy', '1234567896'),
('Juice', 35, '2025-04-07', 'West Pune', 'Amit Joshi', '1234567897');

-- Insert data into `food_requests` table
INSERT INTO food_requests (food_id, name, contact, address) VALUES
(1, 'Charity Home', '9988776655', '123 Help Street, Pune'),
(2, 'NGO Center', '9988776656', '456 Relief Avenue, Pune'),
(3, 'Community Kitchen', '9988776657', '789 Support Lane, Pune'),
(4, 'Shelter House', '9988776658', '101 Aid Road, Pune'),
(5, 'Care Center', '9988776659', '202 Comfort Way, Pune'),
(6, 'Humanity Hub', '9988776660', '303 Empathy Drive, Pune'),
(7, 'Compassion Society', '9988776661', '404 Relief Street, Pune'),
(8, 'Kindness Group', '9988776662', '505 Unity Road, Pune');

-- Insert data into `contact_messages` table
INSERT INTO contact_messages (name, email, message) VALUES
('Rahul Verma', 'rahul@gmail.com', 'Need help with donations.'),
('Asha Kapoor', 'asha@gmail.com', 'How can I volunteer?'),
('Ramesh Khanna', 'ramesh@gmail.com', 'I want to donate food items.'),
('Sneha Iyer', 'sneha@gmail.com', 'Please share more about your services.'),
('Anil Bhatia', 'anil@gmail.com', 'Interested in partnership opportunities.'),
('Pooja Chawla', 'pooja@gmail.com', 'Can I get some help for my community?'),
('Vikas Arora', 'vikas@gmail.com', 'Looking for volunteer opportunities.'),
('Priya Nair', 'priya@gmail.com', 'What is the donation process?');

-- Insert data into `notifications` table
INSERT INTO notifications (message, type) VALUES
('New food donation added.', 'Food Donation'),
('New beneficiary registered.', 'Beneficiary'),
('Food request pending.', 'Food Request'),
('Contact message received.', 'Message'),
('Food donation accepted.', 'Food Donation'),
('New admin account created.', 'Admin'),
('Food request fulfilled.', 'Food Request'),
('New restaurant registered.', 'Restaurant');

-- Create the `team` table after all dependencies are created
CREATE TABLE IF NOT EXISTS team (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL,
    img VARCHAR(255) NOT NULL -- Assuming img is a URL or path to the image
);

-- Insert data into `team` table
INSERT INTO team (name, role, img) VALUES
('John Doe', 'Founder', 'path/to/john_doe.jpg'),
('Jane Smith', 'Volunteer Coordinator', 'path/to/jane_smith.jpg'),
('Michael Brown', 'Logistics Manager', 'path/to/michael_brown.jpg');

-- Create the `testimonials` table after `team` table
CREATE TABLE IF NOT EXISTS testimonials (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    feedback TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert data into `testimonials` table
INSERT INTO testimonials (name, feedback) VALUES
('John Doe', '"The Food Management System has been a lifesaver for our community.'),
('Jane Smith', '"I am so grateful for the help I received through this system.'),
('Michael Brown', '"Thank you for making it easy to donate and help those in need."');

-- Combined SELECT queries to fetch all data from tables
SELECT * FROM food_donations;
SELECT * FROM restaurants;
SELECT * FROM beneficiaries;
SELECT * FROM admins;
SELECT * FROM food_requests;
SELECT * FROM contact_messages;
SELECT * FROM notifications;
SELECT * FROM team;
SELECT * FROM testimonials;