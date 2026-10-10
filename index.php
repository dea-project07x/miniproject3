-- Buat Pangkalan Data
CREATE DATABASE IF NOT EXISTS mini_project3;
USE mini_project3;

-- 1. Jadual Users (Login & Role)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Jadual Categories
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Jadual Products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    code VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    stock INT DEFAULT 0,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- 4. Jadual Inventory Transactions (Barang Masuk & Keluar)
CREATE TABLE IF NOT EXISTS inventory_transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    type ENUM('in', 'out') NOT NULL,
    quantity INT NOT NULL,
    note TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Data Awal (Data Ujian)
-- Password untuk admin1 & staff1 ialah: admin123
INSERT INTO users (username, password, role) VALUES 
('admin1', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHe11.75XDH/BTO5KeqH9.gYf.yS1e2M4W', 'admin'),
('staff1', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHe11.75XDH/BTO5KeqH9.gYf.yS1e2M4W', 'staff')
ON DUPLICATE KEY UPDATE id=id;

INSERT INTO categories (id, name) VALUES 
(1, 'Elektronik'), 
(2, 'Pakaian')
ON DUPLICATE KEY UPDATE id=id;

INSERT INTO products (id, category_id, code, name, stock, price) VALUES 
(1, 1, 'PRD-001', 'Laptop Asus', 10, 8000000.00),
(2, 2, 'PRD-002', 'Kemeja Putih', 25, 150000.00)
ON DUPLICATE KEY UPDATE id=id;
