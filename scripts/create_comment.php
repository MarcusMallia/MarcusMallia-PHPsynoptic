<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];
    $content = $_POST['content'];

    // Insert the new comment into the database
    $sql = "INSERT INTO Comments (post_id, user_id, content) VALUES ('$post_id', '$user_id', '$content')";

    if ($conn->query($sql) === TRUE) {
        echo "New comment created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
