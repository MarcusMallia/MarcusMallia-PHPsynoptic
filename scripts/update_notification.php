<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $notification_id = $_POST['notification_id'];
    $message = $_POST['message'];
    $is_read = isset($_POST['read']) ? 1 : 0;

    // Update the notification in the database
    $sql = "UPDATE Notifications SET message='$message', is_read=$is_read WHERE notification_id=$notification_id";

    if ($conn->query($sql) === TRUE) {
        echo "Notification updated successfully";
    } else {
        echo "Error updating notification: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
