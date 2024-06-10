<?php

class Database
{
    // Database connection parameters
    private $host = 'mysql';
    private $db_name = 'employees_db';
    private $username = 'user';
    private $password = 'user_password';
    public $conn; // Database connection object

    // Method to establish a database connection
    public function getConnection()
    {
        $this->conn = null; // Initialize connection object to null
        try {
            // Attempt to create a new PDO instance for database connection
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            // Set character set to UTF-8
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            // Display connection error message if connection fails
            echo "Connection error: " . $exception->getMessage();
        }
        // Return the database connection object
        return $this->conn;
    }
}
