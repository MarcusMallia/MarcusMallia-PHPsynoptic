<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $type = $_POST['type'];
    $message = $_POST['message'];

    // Insert the new notification into the database
    $sql = "INSERT INTO Notifications (user_id, type, message) VALUES ('$user_id', '$type', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "New notification created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
