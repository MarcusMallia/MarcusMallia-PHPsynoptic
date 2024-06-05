<?php 
session_start();
include 'config.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['post_id'])) {
    echo "No post ID provided.";
    exit();
}

$post_id = $_GET['post_id'];

// Delete the post and its associated tags
$sql_delete_post_tags = "DELETE FROM post_tags WHERE post_id='$post_id'";
$conn->query($sql_delete_post_tags);

$sql_delete_post = "DELETE FROM Posts WHERE post_id='$post_id' AND user_id='".$_SESSION['user_id']."'";
if ($conn->query($sql_delete_post) === TRUE) {
    echo "Post deleted successfully.";
    header("Location: feed.php");
    exit();
} else {
    echo "Error deleting post: " . $conn->error;
}

$conn->close();
?>
