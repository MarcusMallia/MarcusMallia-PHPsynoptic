<?php 
session_start();
include 'config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$comment_id = $_GET['comment_id'];
$post_id = $_GET['post_id'];

// Delete the comment from the database
$sql_delete = "DELETE FROM Comments WHERE comment_id = '$comment_id' AND user_id = '".$_SESSION['user_id']."'";
if ($conn->query($sql_delete) === TRUE) {
    header("Location: post_details.php?post_id=$post_id");
    exit();
} else {
    echo "Error deleting comment: " . $conn->error;
}

$conn->close();
?>
