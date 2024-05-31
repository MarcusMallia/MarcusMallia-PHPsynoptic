<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $post_id = $_POST['post_id'];
    $content = $_POST['content'];
    $link = $_POST['link'];

    // Update the post in the database
    $sql = "UPDATE Posts SET content='$content', link='$link' WHERE post_id=$post_id";

    if ($conn->query($sql) === TRUE) {
        echo "Post updated successfully";
    } else {
        echo "Error updating post: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
