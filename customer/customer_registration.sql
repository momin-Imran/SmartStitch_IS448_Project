
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

