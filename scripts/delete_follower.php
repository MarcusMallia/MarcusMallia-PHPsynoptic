<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $follower_id = $_POST['follower_id'];

    // Delete the follower from the database
    $sql = "DELETE FROM Followers WHERE follower_id=$follower_id";

    if ($conn->query($sql) === TRUE) {
        echo "Follower deleted successfully";
    } else {
        echo "Error deleting follower: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
