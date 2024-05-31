<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $comment_id = $_POST['comment_id'];
    $content = $_POST['content'];

    // Update the comment in the database
    $sql = "UPDATE Comments SET content='$content' WHERE comment_id=$comment_id";

    if ($conn->query($sql) === TRUE) {
        echo "Comment updated successfully";
    } else {
        echo "Error updating comment: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
