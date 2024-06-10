/**
 * Confirms the deletion of an employee.
 * 
 * @param {number} id The ID of the employee to be deleted.
 */
function confirmDelete(id) {
    // Get the confirmation modal element.
    var modal = document.querySelector('.confirmation-modal');

    // Show the modal.
    modal.style.display = 'block';

    // Define the action when the "OK" button is clicked.
    document.querySelector('.ok').onclick = function () {
        // Make an AJAX request to delete the employee.
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            // Check if the request has completed successfully.
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Parse the server response.
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Remove the row from the table.
                    var row = document.querySelector(`tr[data-id='${id}']`);
                    row.parentNode.removeChild(row);
                    // Show a success message.
                    showMessage("Employee deleted successfully.", "success");
                } else {
                    // Show an error message.
                    showMessage("Failed to delete employee.", "error");
                }
                // Hide the modal.
                modal.style.display = 'none';
            }
        };
        // Send the request with the employee ID.
        xhr.send("id=" + id);
    };

    // Define the action when the "Cancel" button is clicked.
    document.querySelector('.cancel').onclick = function () {
        // Hide the modal.
        modal.style.display = 'none';
    };
}

/**
 * Shows a success or error message.
 * 
 * @param {string} message The message to be displayed.
 * @param {string} type The type of message ("success" or "error").
 */
function showMessage(message, type) {
    var messageContainer = document.getElementById('message-container');
    var messageElement = document.getElementById('message');
    var messageText = document.getElementById('message-text');

    messageContainer.classList.remove('hidden');
    messageElement.classList.remove('success', 'error');
    messageElement.classList.add(type);
    messageText.innerText = message;

    messageContainer.classList.add('show');
    setTimeout(function () {
        messageContainer.classList.remove('show');
    }, 5000);
}


