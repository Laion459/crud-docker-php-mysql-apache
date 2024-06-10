<?php
// Include database connection and employee class files
include_once 'db.php';
include_once 'employee.php';

// Create a new instance of the Database class to establish connection
$database = new Database();
$db = $database->getConnection();

// Create a new instance of the Employee class
$employee = new Employee($db);

// Fetch all employee data from the database
$stmt = $employee->read();
$num = $stmt->rowCount(); // Get the number of rows returned

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Employee List</title>
    <link rel="icon" type="image/png" href="img/image.png" class="logo">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>

</head>

<body>
    <div class="index-container">
        <div class="title-container">
            <h1>Employee List</h1>
            <div class="button-container">
                <a href="create.php" class="button add">
                    <span class="add-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                        </svg>
                    </span>
                    Add Employee
                </a>
                <a href="read.php" class="button read">
                    <span class="read-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </span>
                    Search Employee
                </a>
            </div>
        </div>

        <div class="container">

            <div class="table-container">
                <?php if ($num > 0) : // Check if there are any employees 
                ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Birthdate</th>
                                <th>CPF</th>
                                <th>Email</th>
                                <th>Marital Status</th>
                                <th>Actions</th>
                                <div class="results">
                                    <h3>Results <?php echo $num ?> </h3>
                                </div>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through each employee data row -->
                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr data-id="<?php echo $row['id']; ?>">
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php
                                        $birthdate = date_create_from_format('Y-m-d', $row['birthdate']);
                                        echo htmlspecialchars(date_format($birthdate, 'd/m/Y'));
                                        ?></td>
                                    <td><?php echo htmlspecialchars($row['cpf']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['marital_status']); ?></td>
                                    <td>
                                        <a href="view.php?id=<?php echo $row['id']; ?>" class="button view">
                                            <span class="view-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                                </svg>
                                            </span>
                                            View
                                        </a>
                                        <a href="update.php?id=<?php echo $row['id']; ?>" class="button edit">
                                            <span class="edit-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg>
                                            </span>
                                            Edit
                                        </a>
                                        <button onclick="confirmDelete(<?php echo $row['id']; ?>);" class="button delete">
                                            <span class="delete-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                </svg>
                                            </span>
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else : // If no employees are found 
                ?>
                    <p>No employees found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div class="confirmation-modal" style="display: none;">
            <div class="confirmation-dialog">
                <p>Are you sure you want to delete this employee?</p>
                <button class="ok">OK</button>
                <button class="cancel">Cancel</button>
            </div>
        </div>

        <!-- Mensagem de confirmação -->
        <div id="message-container" class="hidden">
            <div id="message"><span id="message-text"></span></div>
        </div>
    </div>

</body>

</html>