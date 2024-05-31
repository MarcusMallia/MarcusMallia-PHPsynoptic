<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    // Insert the new like into the database
    $sql = "INSERT INTO Likes (post_id, user_id) VALUES ('$post_id', '$user_id')";

    if ($conn->query($sql) === TRUE) {
        echo "New like added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
