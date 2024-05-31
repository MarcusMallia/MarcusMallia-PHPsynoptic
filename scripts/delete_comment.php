<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $comment_id = $_POST['comment_id'];

    // Delete the comment from the database
    $sql = "DELETE FROM Comments WHERE comment_id=$comment_id";

    if ($conn->query($sql) === TRUE) {
        echo "Comment deleted successfully";
    } else {
        echo "Error deleting comment: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
