<?php

require_once "db/config.php";

$db->exec("
CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT,
    password TEXT,
	is_admin INTEGER DEFAULT 0
);
");

$db->exec("
CREATE TABLE products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    desc TEXT,
    price REAL,
    stock INTEGER,
    category TEXT,
    image TEXT NULL
);
");

$db->exec("
CREATE TABLE carts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    product_id INTEGER,
    quantity INTEGER,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
");


// Insert a default admin user
$username = "admin";
$password = "admin123";
$hash = password_hash($password, PASSWORD_DEFAULT);
$db->exec("
INSERT INTO users (username, password, is_admin) VALUES ('$username', '$hash', 1);
");


echo "Database initialized successfully.";  