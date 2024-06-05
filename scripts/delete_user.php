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

    // Fetch the user's posts to delete related comments, likes, and post tags
    $sql_fetch_posts = "SELECT post_id FROM Posts WHERE user_id = '$user_id'";
    $result_posts = $conn->query($sql_fetch_posts);

    while ($post = $result_posts->fetch_assoc()) {
        $post_id = $post['post_id'];

        // Delete post tags related to the post
        $sql_delete_post_tags = "DELETE FROM post_tags WHERE post_id = '$post_id'";
        $conn->query($sql_delete_post_tags);

        // Delete likes related to the post
        $sql_delete_post_likes = "DELETE FROM Likes WHERE post_id = '$post_id'";
        $conn->query($sql_delete_post_likes);

        // Delete comments related to the post
        $sql_delete_post_comments = "DELETE FROM Comments WHERE post_id = '$post_id'";
        $conn->query($sql_delete_post_comments);
    }

    // Delete the user's comments
    $sql_delete_comments = "DELETE FROM Comments WHERE user_id = '$user_id'";
    $conn->query($sql_delete_comments);

    // Delete the user's posts
    $sql_delete_posts = "DELETE FROM Posts WHERE user_id = '$user_id'";
    $conn->query($sql_delete_posts);

    // Delete the user's likes
    $sql_delete_likes = "DELETE FROM Likes WHERE user_id = '$user_id'";
    $conn->query($sql_delete_likes);

    // Delete the user's followers and following relationships
    $sql_delete_followers = "DELETE FROM Followers WHERE user_id = '$user_id' OR follower_user_id = '$user_id'";
    $conn->query($sql_delete_followers);

    // Delete the user's notifications
    $sql_delete_notifications = "DELETE FROM Notifications WHERE user_id = '$user_id'";
    $conn->query($sql_delete_notifications);

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
