<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $content = $_POST['content'];
    $link = $_POST['link'];

    // Insert the new post into the database
    $sql = "INSERT INTO Posts (user_id, content, link) VALUES ('$user_id', '$content', '$link')";

    if ($conn->query($sql) === TRUE) {
        echo "New post created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
