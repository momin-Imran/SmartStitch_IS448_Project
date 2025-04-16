/*
	The allergens table stores an ID for each allergen entry, the ID of the customer who has it (referencing the ID the user's account was given when they registered,
	The particular allergen they have, and how severe that allergen is.
*/
CREATE TABLE Allergens (
	allerg_id INT AUTO_INCREMENT PRIMARY KEY,
	customer_id INT NOT NULL,
	allergen VARCHAR(30) NOT NULL,
	severity VARCHAR(10) NOT NULL,
	FOREIGN KEY (customer_id) REFERENCES Customer_Reg(customer_id)
);
/*
	The sizePrefs table contains an ID for each user's preferences, the customer's ID (also referencing registration), and the measurements for their chest, waist, and neck
	sizes.
*/
CREATE TABLE SizePrefs (
	size_id INT AUTO_INCREMENT PRIMARY KEY,
	customer_id INT NOT NULL,
	chest VARCHAR(5) NOT NULL,
	waist VARCHAR (5) NOT NULL,
	neck VARCHAR (5) NOT NULL,
	FOREIGN KEY (customer_id) REFERENCES Customer_Reg(customer_id)
);
/*
	The sizePrefsOther Table is for any other preferences that the customer might have that aren't part of the default 3 listed in the sizePrefs table (such as hip size).
	It includes an ID for the additional preference, the ID for the set of size preferences that it is related to, what specific dimension the user specified, and specific 
	measurement of that dimension.
*/
CREATE TABLE SizePrefsOther (
	pref_id INT AUTO_INCREMENT PRIMARY KEY,
	size_id INT NOT NULL,
	dimension VARCHAR(10) NOT NULL,
	measure VARCHAR(5) NOT NULL,
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
	details VARCHAR(255) NOT NULL,
	FOREIGN KEY (customer_id) REFERENCES Customer_Reg(customer_id),
	FOREIGN KEY (tailor_id) REFERENCES Tailors(tailor_id)
);
/*
	The OrdersCom table records data for communications pertaining to specific orders that have been made. It provides an ID for the communication, the ID of the order in
	question, the date that the communication was sent, and the details of the concern being communicated.
*/
CREATE TABLE OrderCom (
	com_id INT AUTO_INCREMENT PRIMARY KEY,
	order_id INT NOT NULL,
	com_date DATE NOT NULL,
	concern VARCHAR(255) NOT NULL,
	FOREIGN KEY (order_id) REFERENCES Orders(order_id)
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
	FOREIGN KEY (customer_id) REFERENCES Customer_Reg(customer_id),
	FOREIGN KEY (tailor_id) REFERENCES Tailors(tailor_id)
);
	
	
	