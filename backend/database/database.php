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

    // Add functions for CRUD operations here
}
