<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $notification_id = $_POST['notification_id'];

    // Delete the notification from the database
    $sql = "DELETE FROM Notifications WHERE notification_id=$notification_id";

    if ($conn->query($sql) === TRUE) {
        echo "Notification deleted successfully";
    } else {
        echo "Error deleting notification: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
