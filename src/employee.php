<?php

// Include necessary files for path, validation, and database connection
require_once __DIR__ . '/path.php';
include_once BASE_PATH . '/validate.php';

use Validation\ValidateCPF;

include_once 'db.php';

// Define the Employee class
class Employee
{
    // Private properties for database connection and table name
    private $conn;
    private $table_name = "employees";

    // Constructor to initialize database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Method to create a new employee
    public function create($name, $birthdate, $cpf, $email, $marital_status)
    {
        // Sanitize and validate CPF
        $cpf = preg_replace('/[^0-9]/', '', $cpf); // Remove non-numeric characters from CPF
        if (!ValidateCPF::isValidCPF($cpf)) { // Validate CPF format
            return "Invalid CPF.";
        }
        if (!isValidEmail($email)) { // Validate email format
            return "Invalid email.";
        }

        // Check if CPF already exists in the database
        $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE cpf = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$cpf]);
        if ($stmt->fetchColumn() > 0) {
            return "CPF already exists.";
        }

        // Insert new employee record into the database
        $query = "INSERT INTO " . $this->table_name . " (name, birthdate, cpf, email, marital_status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Execute the query and handle potential errors
        try {
            if ($stmt->execute([$name, $birthdate, $cpf, $email, $marital_status])) {
                return true;
            } else {
                $errorInfo = $stmt->errorInfo();
                return "Error executing query: " . $errorInfo[2];
            }
        } catch (PDOException $exception) {
            return "Exception: " . $exception->getMessage();
        }
    }

    // Method to read all employees from the database
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Method to update an existing employee's details
    public function update($id, $name, $birthdate, $cpf, $email, $marital_status)
    {
        if (!isValidCPF($cpf)) { // Validate CPF format
            return "Invalid CPF.";
        }
        if (!isValidEmail($email)) { // Validate email format
            return "Invalid email.";
        }

        // Update employee record in the database
        $query = "UPDATE " . $this->table_name . " SET name = ?, birthdate = ?, cpf = ?, email = ?, marital_status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Execute the query and handle potential errors
        try {
            if ($stmt->execute([$name, $birthdate, $cpf, $email, $marital_status, $id])) {
                return true;
            } else {
                $errorInfo = $stmt->errorInfo();
                return "Error executing query: " . $errorInfo[2];
            }
        } catch (PDOException $exception) {
            return "Exception: " . $exception->getMessage();
        }
    }

    // Method to delete an employee from the database
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Execute the query and handle potential errors
        try {
            if ($stmt->execute([$id])) {
                return true;
            } else {
                $errorInfo = $stmt->errorInfo();
                return "Error executing query: " . $errorInfo[2];
            }
        } catch (PDOException $exception) {
            return "Exception: " . $exception->getMessage();
        }
    }

    // Method to read an employee by email
    public function readByEmail($email)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        return $stmt;
    }

    // Method to read an employee by CPF
    public function readByCPF($cpf)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE cpf = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $cpf);
        $stmt->execute();
        return $stmt;
    }




    public function readOne($id)
    {
        // Query to select all employee data
        $query = "SELECT id, name, birthdate, cpf, email, marital_status, created_at 
                  FROM employees 
                  WHERE id = ? 
                  LIMIT 0,1";
    
        // Prepare the query
        $stmt = $this->conn->prepare($query);
    
        // Bind the employee ID
        $stmt->bindParam(1, $id);
    
        // Execute the query
        $stmt->execute();
    
        // Fetch the employee data
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Check if data is found
        if ($row) {
            return $row;
        } else {
            return null;
        }
    }
    
    
}
