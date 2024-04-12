<?php

namespace MyNamespace;

class CategoryResolver {
    private $conn;

    public function __construct() {
        // Include the database credentials
        require_once __DIR__ . '/../../config/config.php'; // Adjust the path to config.php
        
        // Use environment variables for database credentials
        $host = getenv('DB_HOST') ?: 'localhost';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: '0120852868';
        $dbName = getenv('DB_NAME') ?: 'scandiweb';
        
        // Create a new database connection
        $this->conn = new \mysqli($host, $user, $pass, $dbName);
    
        // Check connection and handle errors gracefully
        if ($this->conn->connect_error) {
            throw new \Exception("Connection failed: " . $this->conn->connect_error);
        }
    }
    

    // Implement resolver function for fetching a single category by ID
    public function getCategory($args) {
        $categoryId = $args['id'];
        $query = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();
        $category = $result->fetch_assoc();
        $stmt->close(); // Close the statement
        return $category;
    }

    public function getAllCategories() {
        $query = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        $stmt->close(); // Close the statement
        return $categories;
    }
    
    // Implement resolver function for creating a new category
    public function createCategory($args) {
        $name = $args['name'];
        $description = $args['description'];
        $query = "INSERT INTO categories (name, description) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $name, $description);
        if ($stmt->execute()) {
            $categoryId = $stmt->insert_id;
            $newCategory = $this->getCategory(['id' => $categoryId]);
            $stmt->close(); // Close the statement
            return $newCategory;
        } else {
            $stmt->close(); // Close the statement
            return null;
        }
    }

    // Implement resolver function for updating an existing category
    public function updateCategory($args) {
        $categoryId = $args['id'];
        $name = $args['name'];
        $description = $args['description'];
        $query = "UPDATE categories SET name = ?, description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $name, $description, $categoryId);
        if ($stmt->execute()) {
            $updatedCategory = $this->getCategory(['id' => $categoryId]);
            $stmt->close(); // Close the statement
            return $updatedCategory;
        } else {
            $stmt->close();
            return null;
        }
    }

    // Implement resolver function for deleting a category
    public function deleteCategory($args) {
        $categoryId = $args['id'];
        $query = "DELETE FROM categories WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $categoryId);
        if ($stmt->execute()) {
            $stmt->close(); // Close the statement
            return true;
        } else {
            $stmt->close(); // Close the statement
            return false;
        }
    }

    // Close the database connection when the object is destroyed
    public function __destruct() {
        $this->conn->close();
    }
}
