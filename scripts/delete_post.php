<?php
session_start();
include 'config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You need to log in to delete a post.";
    exit();
}

// Check if the post ID is provided
if (!isset($_GET['post_id'])) {
    echo "No post ID provided.";
    exit();
}

$post_id = $_GET['post_id'];

// Delete the post from the database
$sql = "DELETE FROM Posts WHERE post_id = '$post_id' AND user_id = '".$_SESSION['user_id']."'";

if ($conn->query($sql) === TRUE) {
    header("Location: feed.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
