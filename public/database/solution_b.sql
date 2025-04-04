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

-- Solution B: Order Queries

-- 1. List invoices with user ID, user name, and order ID
SELECT orders.user_id, users.user_name, orders.order_id FROM orders
JOIN users ON orders.user_id = users.user_id;

-- 2. Count number of orders per user
SELECT users.user_id, users.user_name, COUNT(orders.order_id) AS order_count FROM users
LEFT JOIN orders ON users.user_id = orders.user_id
GROUP BY users.user_id;

-- 3. Get order details: order ID and number of products in each order
SELECT orders.order_id, COUNT(order_details.product_id) AS product_count FROM orders
JOIN order_details ON orders.order_id = order_details.order_id
GROUP BY orders.order_id;

-- 4. List user purchases grouped by order
SELECT users.user_id, users.user_name, orders.order_id, products.product_name FROM orders
JOIN users ON orders.user_id = users.user_id
JOIN order_details ON orders.order_id = order_details.order_id
JOIN products ON order_details.product_id = products.product_id
ORDER BY orders.order_id;

-- 5. List top 7 users with most orders
SELECT users.user_id, users.user_name, COUNT(orders.order_id) AS total_orders FROM users
JOIN orders ON users.user_id = orders.user_id
GROUP BY users.user_id
ORDER BY total_orders DESC
LIMIT 7;

-- 6. List top 7 users who bought products containing 'Samsung' or 'Apple'
SELECT DISTINCT users.user_id, users.user_name, orders.order_id, products.product_name FROM users
JOIN orders ON users.user_id = orders.user_id
JOIN order_details ON orders.order_id = order_details.order_id
JOIN products ON order_details.product_id = products.product_id
WHERE products.product_name LIKE '%Samsung%' OR products.product_name LIKE '%Apple%'
LIMIT 7;

-- 7. List user purchases with total order cost
SELECT users.user_id, users.user_name, orders.order_id, SUM(products.product_price) AS total_price FROM users
JOIN orders ON users.user_id = orders.user_id
JOIN order_details ON orders.order_id = order_details.order_id
JOIN products ON order_details.product_id = products.product_id
GROUP BY orders.order_id;

-- 8. Get the most expensive order per user
SELECT user_id, user_name, order_id, total_price FROM (
    SELECT users.user_id, users.user_name, orders.order_id, SUM(products.product_price) AS total_price,
           RANK() OVER (PARTITION BY users.user_id ORDER BY SUM(products.product_price) DESC) AS ranking
    FROM users
    JOIN orders ON users.user_id = orders.user_id
    JOIN order_details ON orders.order_id = order_details.order_id
    JOIN products ON order_details.product_id = products.product_id
    GROUP BY orders.order_id
) ranked_orders WHERE ranking = 1;

-- 9. Get the cheapest order per user with total price and number of products
SELECT user_id, user_name, order_id, total_price, product_count FROM (
    SELECT users.user_id, users.user_name, orders.order_id, SUM(products.product_price) AS total_price,
           COUNT(order_details.product_id) AS product_count,
           RANK() OVER (PARTITION BY users.user_id ORDER BY SUM(products.product_price) ASC) AS ranking
    FROM users
    JOIN orders ON users.user_id = orders.user_id
    JOIN order_details ON orders.order_id = order_details.order_id
    JOIN products ON order_details.product_id = products.product_id
    GROUP BY orders.order_id
) ranked_orders WHERE ranking = 1;

-- 10. Get the order with the highest number of products per user
SELECT user_id, user_name, order_id, total_price, product_count FROM (
    SELECT users.user_id, users.user_name, orders.order_id, SUM(products.product_price) AS total_price,
           COUNT(order_details.product_id) AS product_count,
           RANK() OVER (PARTITION BY users.user_id ORDER BY COUNT(order_details.product_id) DESC) AS ranking
    FROM users
    JOIN orders ON users.user_id = orders.user_id
    JOIN order_details ON orders.order_id = order_details.order_id
    JOIN products ON order_details.product_id = products.product_id
    GROUP BY orders.order_id
) ranked_orders WHERE ranking = 1;
