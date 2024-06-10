<?php
// Include database connection and employee class files
include_once 'db.php';
include_once 'employee.php';

// Create a new instance of the Database class to establish connection
$database = new Database();
$db = $database->getConnection();

// Create a new instance of the Employee class
$employee = new Employee($db);

// Get the employee ID from the POST data
$id = isset($_POST['id']) ? $_POST['id'] : die(json_encode(["success" => false, "message" => "No ID provided."]));

// Call the delete method of the Employee class
if ($employee->delete($id)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to delete employee."]);
}
