<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $like_id = $_POST['like_id'];

    // Delete the like from the database
    $sql = "DELETE FROM Likes WHERE like_id=$like_id";

    if ($conn->query($sql) === TRUE) {
        echo "Like deleted successfully";
    } else {
        echo "Error deleting like: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
