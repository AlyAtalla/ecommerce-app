<?php

// Read the JSON file
$jsonString = file_get_contents('data.json');

// Decode the JSON
$data = json_decode($jsonString, true);

// Access Categories and Products
$categories = $data['categories'] ?? [];
$products = $data['products'] ?? [];

// Database Connection
// Replace DB_HOST, DB_NAME, DB_USER, and DB_PASSWORD with your database credentials
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=scandiweb;charset=utf8mb4', 'root', '0120852868');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Insert Categories into Database
$pdo->exec("CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)");

foreach ($categories as $category) {
    $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
    $stmt->execute(['name' => $category['name']]);
}

// Insert Products into Database
$pdo->exec("CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    in_stock BOOLEAN NOT NULL,
    description TEXT,
    category VARCHAR(255),
    brand VARCHAR(255)
)");

foreach ($products as $product) {
    $stmt = $pdo->prepare("INSERT INTO products (name, in_stock, description, category, brand) VALUES (:name, :in_stock, :description, :category, :brand)");
    $stmt->execute([
        'name' => $product['name'],
        'in_stock' => $product['inStock'] ? 1 : 0,
        'description' => $product['description'],
        'category' => $product['category'],
        'brand' => $product['brand']
    ]);
}

echo "Data imported successfully.";

?>
