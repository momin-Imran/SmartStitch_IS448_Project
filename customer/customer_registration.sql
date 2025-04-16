-- 
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
