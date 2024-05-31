<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $post_id = $_POST['post_id'];

    // Delete the post from the database
    $sql = "DELETE FROM Posts WHERE post_id=$post_id";

    if ($conn->query($sql) === TRUE) {
        echo "Post deleted successfully";
    } else {
        echo "Error deleting post: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
