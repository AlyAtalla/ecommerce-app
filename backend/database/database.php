<?php
require_once __DIR__ . '/../../backend/config/config.php';

class Database {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli('localhost:8000', 'root', '0120852868', 'scandiweb');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Create a new category
    public function createCategory($name, $description) {
        $stmt = $this->conn->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $description);
        $stmt->execute();
        return $stmt->insert_id;
    }

    // Read all categories
    public function getAllCategories() {
        $result = $this->conn->query("SELECT * FROM categories");
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        return $categories;
    }

    // Update a category
    public function updateCategory($id, $name, $description) {
        $stmt = $this->conn->prepare("UPDATE categories SET name = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $description, $id);
        return $stmt->execute();
    }

    // Delete a category
    public function deleteCategory($id) {
        $stmt = $this->conn->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
