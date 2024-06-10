<?php
// Include database connection and employee class files
include_once 'db.php';
include_once 'employee.php';

// Create a new instance of the Database class to establish connection
$database = new Database();
$db = $database->getConnection();

// Create a new instance of the Employee class
$employee = new Employee($db);

// Get the employee ID from the URL parameter or display an error if not found
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Employee ID not found.');

// Fetch employee data from the database
$employeeData = $employee->readOne($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Employee</title>
    <link rel="icon" type="image/png" href="img/image.png" class="logo">

    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>

<body>
    <div class="view-container">
        <?php if ($employeeData) : ?>
            <!-- Display the employee data -->
            <h1>Employee Details</h1>
            <p><strong>Name:</strong> <?= htmlspecialchars($employeeData['name']) ?></p>
            <p><strong>Birthdate:</strong> <?= htmlspecialchars($employeeData['birthdate']) ?></p>
            <p><strong>CPF:</strong> <?= htmlspecialchars($employeeData['cpf']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($employeeData['email']) ?></p>
            <p><strong>Marital Status:</strong> <?= htmlspecialchars($employeeData['marital_status']) ?></p>
            <p><strong>Created At:</strong> <?= htmlspecialchars($employeeData['created_at']) ?></p>
        <?php else : ?>
            <p>Employee not found.</p>
        <?php endif; ?>
        <!-- Button to navigate back to the employee list -->
        <button class="button-back" onclick="window.location.href='index.php'">
            <span class="back-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
                    <path d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z" />
                </svg>
            </span>
            Back
        </button>
    </div>

</body>

</html>