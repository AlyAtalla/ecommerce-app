<?php

// Include the Database class
require_once __DIR__ . '/path/to/your/Database.php';

// Create a new instance of the Database class
$db = new Database();

// Fetch all categories from the database
$categories = $db->getAllCategories();

// Check if categories were fetched
if (!empty($categories)) {
    // Output the categories
    echo "<h1>Categories:</h1>";
    echo "<ul>";
    foreach ($categories as $category) {
        echo "<li>ID: " . $category['id'] . ", Name: " . $category['name'] . ", Description: " . $category['description'] . "</li>";
    }
    echo "</ul>";
} else {
    // Output a message if no categories were found
    echo "<p>No categories found.</p>";
}
