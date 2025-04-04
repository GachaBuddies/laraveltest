-- Create database
CREATE DATABASE IF NOT EXISTS bke_management;
USE bke_management;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(25) NOT NULL,
    user_email VARCHAR(55) NOT NULL,
    user_pass VARCHAR(255) NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create products table
CREATE TABLE IF NOT EXISTS products (
    product_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    product_price DOUBLE NOT NULL,
    product_description TEXT NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create orders table
CREATE TABLE IF NOT EXISTS orders (
    order_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Create order_details table
CREATE TABLE IF NOT EXISTS order_details (
    order_detail_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    order_id INT(11) NOT NULL,
    product_id INT(11) NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

-- Solution A: User Queries

-- 1. Get all users sorted alphabetically by name
SELECT * FROM users ORDER BY user_name ASC;

-- 2. Get the first 7 users sorted alphabetically by name
SELECT * FROM users ORDER BY user_name ASC LIMIT 7;

-- 3. Get users whose names contain the letter 'a' sorted alphabetically
SELECT * FROM users WHERE user_name LIKE '%a%' ORDER BY user_name ASC;

-- 4. Get users whose names start with 'm'
SELECT * FROM users WHERE user_name LIKE 'm%';

-- 5. Get users whose names end with 'i'
SELECT * FROM users WHERE user_name LIKE '%i';

-- 6. Get users with Gmail addresses
SELECT * FROM users WHERE user_email LIKE '%@gmail.com';

-- 7. Get users with Gmail addresses whose names start with 'm'
SELECT * FROM users WHERE user_email LIKE '%@gmail.com' AND user_name LIKE 'm%';

-- 8. Get users with Gmail addresses, names containing 'i', and name length > 5
SELECT * FROM users WHERE user_email LIKE '%@gmail.com' AND user_name LIKE '%i%' AND LENGTH(user_name) > 5;

-- 9. Get users whose names contain 'a', have length between 5-9, use Gmail, and have 'i' in their email username
SELECT * FROM users WHERE user_name LIKE '%a%' AND LENGTH(user_name) BETWEEN 5 AND 9 AND user_email LIKE '%@gmail.com' AND SUBSTRING_INDEX(user_email, '@', 1) LIKE '%i%';

-- 10. Get users who meet at least one of the following criteria:
--     - Name contains 'a' and has length 5-9
--     - Name contains 'i' and has length < 9
--     - Uses Gmail and has 'i' in email username
SELECT * FROM users WHERE (user_name LIKE '%a%' AND LENGTH(user_name) BETWEEN 5 AND 9)
    OR (user_name LIKE '%i%' AND LENGTH(user_name) < 9)
    OR (user_email LIKE '%@gmail.com' AND SUBSTRING_INDEX(user_email, '@', 1) LIKE '%i%');
