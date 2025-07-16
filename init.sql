CREATE DATABASE IF NOT EXISTS fastfood CHARACTER SET utf8mb4;

USE fastfood;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255)
);

CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    price DECIMAL(10, 2),
    image VARCHAR(255),
    category VARCHAR(50)
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total DECIMAL(10, 2),
    delivery_address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    item_name VARCHAR(100),
    price DECIMAL(10, 2),
    quantity INT
);
CREATE TABLE menu (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  price DECIMAL(10,2) NOT NULL
);
INSERT INTO `menu_items` (`name`, `price`, `category`) VALUES
-- Fast Food
('Cheeseburger', 5.99, 'Fast Food'),
('Fries', 2.50, 'Fast Food'),
('Chicken Nuggets', 4.00, 'Fast Food'),

-- Grills
('Grilled Chicken', 7.99, 'Grills'),
('Lamb Chops', 9.99, 'Grills'),
('Grilled Kebab', 6.50, 'Grills'),

-- Drinks
('Coca-Cola', 1.50, 'Drinks'),
('Lemonade', 1.75, 'Drinks'),
('Iced Tea', 2.00, 'Drinks');
