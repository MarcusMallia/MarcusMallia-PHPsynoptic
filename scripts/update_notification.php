<?php
session_start();
include 'config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$notification_id = $_POST['notification_id'];

// Update the notification status to read
$sql = "UPDATE Notifications SET is_read = TRUE WHERE notification_id = '$notification_id'";
if ($conn->query($sql) === TRUE) {
    echo "Notification marked as read.";
} else {
    echo "Error: " . $conn->error;
}

// Redirect back to the notifications page
header("Location: notifications.php");
exit();

$conn->close();
?>
