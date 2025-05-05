/*
--------------------------------------------------------
  Author: Nathan Rakhamimov
  File: tailor_availability.sql
  Description: Creates the database, tables, and inserts
               sample data for the Smart Clothing Store 
               tailor availability system.
  Usage: Import this file into phpMyAdmin to set up 
         the necessary database structure and test data.
--------------------------------------------------------
*/
-- Create the database
CREATE DATABASE IF NOT EXISTS SmartClothingStore;
USE SmartClothingStore;

-- Tailors table links to Users
CREATE TABLE IF NOT EXISTS Tailors (
    tailor_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
);

-- Availability table links tailor to available time slots
CREATE TABLE IF NOT EXISTS Tailor_Availability (
    availability_id INT AUTO_INCREMENT PRIMARY KEY,
    tailor_id INT NOT NULL,
    date DATE NOT NULL,
    time_slot VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tailor_id) REFERENCES Tailors(tailor_id) ON DELETE CASCADE
);

-- Insert sample users with actual hashed passwords (generated using PHP's password_hash function)
INSERT INTO Users (name, email, password) VALUES
('John Doe', 'john@example.com', '$2y$10$Wz3Eydnx64EpL3eWP/j1pOmVOj3iSZclHctoxe5Fcx1XjIJFmZ7wC'), -- password: password123
('Jane Smith', 'tailor@example.com', '$2y$10$gNXqDZbPeSkS/x0EZkhr3unGo1SNXp8EUCLCMDMHNfe09AH60xBuS'); -- password: TailorPass2024

-- Insert sample tailors linked to users
INSERT INTO Tailors (user_id) VALUES
((SELECT user_id FROM Users WHERE email = 'john@example.com')),
((SELECT user_id FROM Users WHERE email = 'tailor@example.com'));

-- Insert sample availability for tailor_id = 1 (John Doe)
INSERT INTO Availability (tailor_id, date, time_slot) VALUES
(1, '2025-04-14', '9AM-11AM'),
(1, '2025-04-15', '12PM-2PM'),
(1, '2025-04-16', '3PM-5PM');

-- Confirm the tailor records exist
SELECT * FROM Tailors;
-------------------------------------------------------------------------------------------------------------------------------
-- Author: Adams Ubini  
-- Description: This SQL script creates the `Customer` table, which stores customer registration details such as title, name, email, phone number, and password. 
-- It also includes a sample record insertion for testing purposes.


-- Customer table (stores login information)
--Additional Edits by Yug Patel
CREATE TABLE Customer (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
	user_id INT NOT NULL UNIQUE,
	foreign key (user_id) references Users(user_id) on delete cascade
);

create table Users (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	title ENUM('Mr', 'Mrs') NOT NULL,
	email VARCHAR(100) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	phone VARCHAR(15) NOT NULL UNIQUE,
	first_name VARCHAR(100) NOT NULL,
	last_name VARCHAR(100) NOT NULL,
	role ENUM('customer', 'tailor') NOT NULL DEFAULT 'customer',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


------------------------------------------------------------------------------------------------------------------------------
-- Author : Taurus Hink
-- Description : This SQL code creates a set of tables to be used in relation to user data and communications to be used on the user-tailor communication page / use case.
/*
	The allergens table stores an ID for each allergen entry, the ID of the customer who has it (referencing the ID the user's account was given when they registered,
	The particular allergen they have, and how severe that allergen is.
*/
CREATE TABLE Allergens (
	allerg_id INT AUTO_INCREMENT PRIMARY KEY,
	customer_id INT NOT NULL,
	allergen VARCHAR(30) NOT NULL,
	severity VARCHAR(10) NOT NULL,
	FOREIGN KEY (customer_id) REFERENCES Customer(customer_id)
);
/*
	The sizePrefs table contains an ID for each user's preferences, the customer's ID (also referencing registration), and the measurements for their chest, waist, and neck
	sizes.
*/
-- Additional Edits by Yug Patel
CREATE TABLE SizePrefs (
	size_id INT AUTO_INCREMENT PRIMARY KEY,
	customer_id INT NULL,
	chest DECIMAL(5,2) NULL,
	waist DECIMAL(5,2) NULL,
	neck DECIMAL(5,2) NULL,
	shoulder DECIMAL(5,2) NULL,
	arm DECIMAL(5,2) NULL,
	inseam DECIMAL(5,2) NULL,
	hips DECIMAL(5,2) NULL,
	rise DECIMAL(5,2) NULL,
	specInst VARCHAR(1000),
	FOREIGN KEY (customer_id) REFERENCES Customer(customer_id)
);
/*
	The sizePrefsOther Table is for any other preferences that the customer might have that aren't part of the default 3 listed in the sizePrefs table.
	It includes an ID for the additional preference, the ID for the set of size preferences that it is related to, what specific dimension the user specified, and specific 
	measurement of that dimension.
*/
CREATE TABLE SizePrefsOther (
	pref_id INT AUTO_INCREMENT PRIMARY KEY,
	size_id INT NOT NULL,
	dimension VARCHAR(10) NOT NULL,
	measure VARCHAR(5) NOT NULL,
	specInst VARCHAR(1000),
	FOREIGN KEY (size_id) REFERENCES SizePrefs(size_id)
);
/*
	The Orders table keeps track of what orders have been put in for custom fittings. It assigns an ID for the order, references the IDs for the tailor and customer (from 
	their respective tables), the date that the fitting took place / the order was entered, the status of the order ('D' for Delivered, 'U' for Undelivered, 'L' for late / 
	delayed, 'C' for Cancelled, and finally, the details of the order that the customer requested.
*/
CREATE TABLE Orders (
	order_id INT AUTO_INCREMENT PRIMARY KEY,
	customer_id INT NOT NULL,
	tailor_id INT NOT NULL,
	dateOrdered DATE NOT NULL,
	status VARCHAR(1) NOT NULL,
	details VARCHAR(255) NULL,
	FOREIGN KEY (customer_id) REFERENCES Customer(customer_id),
	FOREIGN KEY (tailor_id) REFERENCES Tailors(tailor_id)
);
/*
	The OrdersCom table records data for communications pertaining to specific orders that have been made. It provides an ID for the communication, the ID of the order in
	question, the date that the communication was sent, and the details of the concern being communicated.
*/
CREATE TABLE OrderCom (
	com_id INT AUTO_INCREMENT PRIMARY KEY,
	/*order_id INT NOT NULL,*/
	com_date DATE NOT NULL,
	concern VARCHAR(255) NOT NULL,
	/*FOREIGN KEY (order_id) REFERENCES Orders(order_id)*/
);
/*
	The OtherCom table records data for communications not pertaining to orders that have been made (ie general concerns a customer wants to direct to a tailor). This table includes
	the IDs for the customer and the tailor communicating, the date that the communication was sent, and the details of the communication.
*/
CREATE TABLE OtherCom (
	com_id INT AUTO_INCREMENT PRIMARY KEY,
	customer_id INT NOT NULL,
	tailor_id INT NOT NULL,
	com_date DATE NOT NULL,
	concern VARCHAR(255) NOT NULL,
	FOREIGN KEY (customer_id) REFERENCES Customer(customer_id),
	FOREIGN KEY (tailor_id) REFERENCES Tailors(tailor_id)
);
------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------
-- Author: Momin Imran
-- Description: Creates Products and Purchases tables for catalog and user purchase tracking
------------------------------------------------------------------------------------------------------------------------------

-- Products table holds the store’s catalog of items
CREATE TABLE Products (
    product_id   INT AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(100)    NOT NULL,
    price        DECIMAL(10,2)   NOT NULL
);

-- Purchases table logs each customer purchase of a product
CREATE TABLE Purchases (
    purchase_id   INT AUTO_INCREMENT PRIMARY KEY,
    customer_id   INT              NOT NULL,
    product_id    INT              NOT NULL,
    quantity      INT         NOT NULL DEFAULT 1,
    purchase_date DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id),
    FOREIGN KEY (product_id)  REFERENCES Products(product_id)
);

