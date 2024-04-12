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
$pdo = new PDO('mysql:host=localhost;port=8000;dbname=scandiweb;charset=utf8mb4', 'root', '0120852868');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Insert Categories into Database
foreach ($categories as $category) {
    $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
    $stmt->execute(['name' => $category['name']]);
}

// Insert Products into Database
foreach ($products as $product) {
    $stmt = $pdo->prepare("INSERT INTO products (id, name, in_stock, description, category, brand) VALUES (:id, :name, :in_stock, :description, :category, :brand)");
    $stmt->execute([
        'id' => $product['id'],
        'name' => $product['name'],
        'in_stock' => $product['inStock'] ? 1 : 0,
        'description' => $product['description'],
        'category' => $product['category'],
        'brand' => $product['brand']
    ]);
}

echo "Data imported successfully.";

?>
