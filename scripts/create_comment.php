<?php
session_start();
include 'config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You need to log in to add a comment.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $content = $_POST['content'];

    // Insert the new comment into the database
    $sql = "INSERT INTO Comments (user_id, post_id, content) VALUES ('$user_id', '$post_id', '$content')";

    if ($conn->query($sql) === TRUE) {
        header("Location: post_details.php?post_id=$post_id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
