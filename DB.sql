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

-- Tailors table stores tailor login credentials
CREATE TABLE Tailors (
    tailor_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Availability table links tailor to available time slots
CREATE TABLE Availability (
    availability_id INT AUTO_INCREMENT PRIMARY KEY,
    tailor_id INT NOT NULL,
    date DATE NOT NULL,
    time_slot VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tailor_id) REFERENCES Tailors(tailor_id)
);

-- Add index for faster lookup on date and time_slot
CREATE INDEX idx_date_time ON Availability(date, time_slot);

-- Insert a sample tailor
INSERT INTO Tailors (name, email, password)
VALUES ('John Doe', 'john@example.com', 'password123');

-- Insert another sample tailor
INSERT INTO Tailors (name, email, password)
VALUES ('Nathan Rakhamimov', 'nathan@example.com', 'mypassword');

-- Insert sample availability for the tailor
INSERT INTO Availability (tailor_id, date, time_slot)
VALUES 
    (1, '2025-04-15', '9AM-11AM'),
    (1, '2025-04-16', '12PM-2PM');


-------------------------------------------------------------------------------------------------------------------------------
-- Author: Adams Ubini  
-- Description: This SQL script creates the `Customer_Reg` table, which stores customer registration details such as title, name, email, phone number, and password. 
-- It also includes a sample record insertion for testing purposes.


-- Tailors table (stores login information)
CREATE TABLE Customer_Reg (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    cust_title ENUM('Mr', 'Mrs') NOT NULL,
    cust_first_name VARCHAR(100) NOT NULL,
    cust_last_name VARCHAR(100) NOT NULL,
    cust_email VARCHAR(100) NOT NULL UNIQUE,
    cust_phone VARCHAR(15) NOT NULL UNIQUE,
    cust_password VARCHAR(255) NOT NULL
);

-- Insert a sample tailor
INSERT INTO Customer_Reg (cust_title, cust_first_name, cust_last_name, cust_email, cust_phone, cust_password)
VALUES ('Mr', 'Declan', 'Rice', 'rice@example.com', '123-456-7890', 'password123');
------------------------------------------------------------------------------------------------------------------------------
