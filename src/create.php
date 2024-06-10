<?php
require_once __DIR__ . '/path.php';
include_once BASE_PATH . '/validate.php';

use Validation\ValidateCPF;

// Include database connection and employee class files
include_once 'db.php';
include_once 'employee.php';

// Create a new instance of the Database class to establish a connection
$database = new Database();
$db = $database->getConnection();

// Create a new instance of the Employee class
$employee = new Employee($db);

// Initialize the variable to store the message
$message = "";

// Check if form data has been submitted
if ($_POST) {
    // Retrieve form data
    $name = $_POST['name'];
    $birthdate = $_POST['birthdate'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $marital_status = $_POST['marital_status'];

    // Sanitize CPF
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Validate CPF and email
    if (!ValidateCPF::isValidCPF($cpf)) {
        $message = "Invalid CPF.";
    } elseif (!isValidEmail($email)) {
        $message = "Invalid email.";
    } else {
        // Attempt to add a new employee with the retrieved data
        $result = $employee->create($name, $birthdate, $cpf, $email, $marital_status);
        if ($result === true) {
            $message = "Employee added successfully.";
        } elseif (strpos($result, 'cpf') !== false) {
            $message = "CPF already exists.";
        } elseif (strpos($result, 'email') !== false) {
            $message = "Email already exists.";
        } else {
            $message = "Failed to add employee.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
    <link rel="icon" type="image/png" href="img/image.png" class="logo">

    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container-create">

        <!-- Employee addition form -->
        <form action="create.php" method="post">
            <h1>Add Employee</h1>
            <label for="name">Name:</label>
            <!-- Input field for employee name -->
            <input type="text" name="name" placeholder="Enter name" required>
            <label for="birthdate">Birthdate:</label>
            <!-- Input field for employee birthdate -->
            <input type="date" name="birthdate" required>
            <label for="cpf">CPF:</label>
            <!-- Input field for employee CPF -->
            <input type="text" name="cpf" placeholder="Enter CPF" required>
            <label for="email">Email:</label>
            <!-- Input field for employee email -->
            <input type="email" name="email" placeholder="Enter email" required>
            <label for="marital_status">Marital Status:</label>
            <!-- Dropdown menu for employee marital status -->
            <select name="marital_status" required>
                <option value="SINGLE">Single</option>
                <option value="MARRIED">Married</option>
                <option value="DIVORCED">Divorced</option>
                <option value="WIDOWED">Widowed</option>
            </select>
            <!-- Submit button to add the employee -->
            <button type="submit" class="add">
                <span class="add-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                    </svg>
                </span>
                Add Employee
            </button>
            <!-- Button to navigate back to the employee list -->
            <button class="button-back" onclick="window.location.href='index.php'">
                <span class="back-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
                        <path d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z" />
                    </svg>
                </span>
                Back
            </button>
        </form>

        <!-- Message confirm -->
        <div id="message-container" class="<?php echo empty($message) ? 'hidden' : ''; ?>">
            <div id="message" class="<?php echo $message ? 'success' : 'error'; ?>">
                <span id="message-text"><?php echo $message; ?></span>
            </div>
        </div>


    </div>
</body>

</html>