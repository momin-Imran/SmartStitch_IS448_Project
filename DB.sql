-- Create the database (optional, depending on your setup)
CREATE DATABASE SmartClothingStore;
USE SmartClothingStore;

-- Tailors table (stores login information)
CREATE TABLE Tailors (
    tailor_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Availability table (stores available time slots per tailor and date)
CREATE TABLE Availability (
    availability_id INT AUTO_INCREMENT PRIMARY KEY,
    tailor_id INT NOT NULL,
    date DATE NOT NULL,
    time_slot VARCHAR(20) NOT NULL,
    FOREIGN KEY (tailor_id) REFERENCES Tailors(tailor_id)
);
