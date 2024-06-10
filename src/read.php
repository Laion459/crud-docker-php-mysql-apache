<?php
// Include database connection and employee class files
include_once 'db.php';
include_once 'employee.php';

// Create a new instance of the Database class to establish connection
$database = new Database();
$db = $database->getConnection();

// Create a new instance of the Employee class
$employee = new Employee($db);

// Initialize the message and employee data variables
$message = "";
$messageType = "";
$employeeData = null;

// Check if form data has been submitted
if ($_POST) {
    $input = $_POST['search'];

    // Validate input as CPF or email
    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        $stmt = $employee->readByEmail($input);
    } elseif (preg_match("/^\d{11}$/", $input)) {
        $stmt = $employee->readByCPF($input);
    } else {
        $message = "Invalid CPF or Email.";
        $messageType = "error";
    }

    // Fetch employee data if query was successful
    if ($stmt) {
        $employeeData = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$employeeData) {
            $message = "Employee not found.";
            $messageType = "error";
        }
    } else {
        $message = "Error fetching employee data.";
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Read Employee</title>
    <link rel="icon" type="image/png" href="img/image.png" class="logo">

    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>

<body>
    <div class="container-read">
        <h1>Read Employee</h1>
        <form action="read.php" method="post">
            <label for="search">Enter CPF or Email:</label>
            <input type="text" name="search" required>
            <button type="submit" class="search">
                <span class="search-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </span>
                Search
            </button>
        </form>

        <?php if ($employeeData) : ?>
            <h2>Employee Details</h2>
            <p>Name: <?php echo htmlspecialchars($employeeData['name']); ?></p>
            <p>Birthdate: <?php echo htmlspecialchars($employeeData['birthdate']); ?></p>
            <p>CPF: <?php echo htmlspecialchars($employeeData['cpf']); ?></p>
            <p>Email: <?php echo htmlspecialchars($employeeData['email']); ?></p>
            <p>Marital Status: <?php echo htmlspecialchars($employeeData['marital_status']); ?></p>
        <?php endif; ?>
        <!-- Link to navigate back to the employee list -->
        <button class="button-back" onclick="window.location.href='index.php'">
            <span class="back-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
                    <path d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z" />
                </svg>
            </span>
            Back
        </button>
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