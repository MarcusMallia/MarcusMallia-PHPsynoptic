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
$action = $_POST['action'];
$redirect = $_POST['redirect'];

// Fetch the post owner and liker username
$sql_post_owner = "SELECT user_id FROM Posts WHERE post_id = '$post_id'";
$result_post_owner = $conn->query($sql_post_owner);
$post_owner = $result_post_owner->fetch_assoc()['user_id'];

$sql_liker = "SELECT username FROM Users WHERE user_id = '$user_id'";
$result_liker = $conn->query($sql_liker);
$liker_username = $result_liker->fetch_assoc()['username'];

if ($action == 'like') {
    // Insert a new like
    $sql = "INSERT INTO Likes (user_id, post_id) VALUES ('$user_id', '$post_id')";
    if ($conn->query($sql) === TRUE) {
        // Generate notification for the post owner
        $notification_message = "$liker_username liked your post.";
        $sql_notification = "INSERT INTO Notifications (user_id, type, message) VALUES ('$post_owner', 'like', '$notification_message')";
        $conn->query($sql_notification);
        echo "Liked successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
} elseif ($action == 'unlike') {
    // Delete the like
    $sql = "DELETE FROM Likes WHERE user_id = '$user_id' AND post_id = '$post_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Unliked successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Redirect back to the referring page
header("Location: " . $redirect);
exit();

$conn->close();
?>
