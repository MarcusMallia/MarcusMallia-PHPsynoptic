<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];

    // Delete the user's data from related tables first (e.g., posts, comments, likes, followers)
    $sql_delete_posts = "DELETE FROM Posts WHERE user_id = '$user_id'";
    $conn->query($sql_delete_posts);

    $sql_delete_comments = "DELETE FROM Comments WHERE user_id = '$user_id'";
    $conn->query($sql_delete_comments);

    $sql_delete_likes = "DELETE FROM Likes WHERE user_id = '$user_id'";
    $conn->query($sql_delete_likes);

    $sql_delete_followers = "DELETE FROM Followers WHERE user_id = '$user_id' OR follower_user_id = '$user_id'";
    $conn->query($sql_delete_followers);

    // Delete the user's account
    $sql_delete_user = "DELETE FROM Users WHERE user_id = '$user_id'";
    if ($conn->query($sql_delete_user) === TRUE) {
        // Log the user out and redirect to the homepage or login page
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        echo "Error deleting account: " . $conn->error;
    }
}

$conn->close();
?>
