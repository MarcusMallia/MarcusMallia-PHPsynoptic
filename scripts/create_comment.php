<?php
session_start();
include 'config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];
$content = $_POST['content'];

// Insert the new comment
$sql = "INSERT INTO Comments (user_id, post_id, content) VALUES ('$user_id', '$post_id', '$content')";
if ($conn->query($sql) === TRUE) {
    // Fetch the post owner and commenter username
    $sql_post_owner = "SELECT user_id FROM Posts WHERE post_id = '$post_id'";
    $result_post_owner = $conn->query($sql_post_owner);
    $post_owner = $result_post_owner->fetch_assoc()['user_id'];
    
    $sql_commenter = "SELECT username FROM Users WHERE user_id = '$user_id'";
    $result_commenter = $conn->query($sql_commenter);
    $commenter_username = $result_commenter->fetch_assoc()['username'];
    
    // Generate notification for the post owner
    $notification_message = "$commenter_username commented on your post.";
    $sql_notification = "INSERT INTO Notifications (user_id, type, message) VALUES ('$post_owner', 'comment', '$notification_message')";
    $conn->query($sql_notification);
    
    echo "Comment added successfully.";
} else {
    echo "Error: " . $conn->error;
}

// Redirect back to the post details page
header("Location: post_details.php?post_id=$post_id");
exit();

$conn->close();
?>
