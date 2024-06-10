<?php
require_once __DIR__ . '/path.php';
include_once BASE_PATH . '/validate.php';

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

// Initialize message variables
$message = "";
$messageType = "";

// Check if form data has been submitted
if ($_POST) {
    // Retrieve form data
    $name = $_POST['name'];
    $birthdate = $_POST['birthdate'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $marital_status = $_POST['marital_status'];

    // Call the update method of the Employee class to update employee information
    $updateResult = $employee->update($id, $name, $birthdate, $cpf, $email, $marital_status);

    if ($updateResult === true) { // Verifique se a atualização foi bem-sucedida
        $message = "Employee updated successfully.";
        $messageType = "success";
    } else {
        $message = "Failed to update employee. ";
        if (is_string($updateResult)) { // Se updateResult for string, é uma mensagem de erro
            $message .= $updateResult;
        }
        $messageType = "error";
    }
}

// Fetch all employee data from the database
$stmt = $employee->read();

// Initialize variable to hold employee data
$employeeData = null;

// Loop through the fetched data to find the employee with the specified ID
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($row['id'] == $id) {
        $employeeData = $row;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>
    <link rel="icon" type="image/png" href="img/image.png" class="logo">

    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>

<body>
    <div class="update-container">
        <?php if ($employeeData) : ?>
            <!-- Display the employee edit form if employee data is found -->
            <form action="update.php?id=<?= $id ?>" method="post" class="edit-form">
                <h1>Edit Employee</h1>
                <label for="name">Name:</label><br>
                <input type="text" name="name" value="<?= htmlspecialchars($employeeData['name']) ?>" required><br>
                <label for="birthdate">Birthdate:</label><br>
                <input type="date" name="birthdate" value="<?= htmlspecialchars($employeeData['birthdate']) ?>" required><br>
                <label for="cpf">CPF:</label><br>
                <input type="text" name="cpf" value="<?= htmlspecialchars($employeeData['cpf']) ?>" required><br>
                <label for="email">Email:</label><br>
                <input type="email" name="email" value="<?= htmlspecialchars($employeeData['email']) ?>" required><br>
                <label for="marital_status">Marital Status:</label><br>
                <select name="marital_status" required>
                    <option value="SINGLE" <?= $employeeData['marital_status'] == 'SINGLE' ? 'selected' : '' ?>>Single</option>
                    <option value="MARRIED" <?= $employeeData['marital_status'] == 'MARRIED' ? 'selected' : '' ?>>Married</option>
                    <option value="DIVORCED" <?= $employeeData['marital_status'] == 'DIVORCED' ? 'selected' : '' ?>>Divorced</option>
                    <option value="WIDOWED" <?= $employeeData['marital_status'] == 'WIDOWED' ? 'selected' : '' ?>>Widowed</option>
                </select><br><br>
                <button type="submit" class="button-update">
                    <span class="button-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                        </svg>
                    </span>
                    Update Employee
                </button>
                <!-- Link to navigate back to the employee list -->
                <a href="index.php" class="button button-back">
                    <span class="button-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
                            <path d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z" />
                        </svg>
                    </span>
                    Back
                </a>
            </form>
        <?php else : ?>
            <p>Employee not found.</p>
        <?php endif; ?>
    </div>

    <!-- Mensagem de confirmação -->
    <div id="message-container" class="hidden">
        <div id="message"><span id="message-text"></span></div>
    </div>

    <?php if ($message) : ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showMessage("<?php echo $message; ?>", "<?php echo $messageType; ?>");
            });
        </script>
    <?php endif; ?>
</body>

</html>