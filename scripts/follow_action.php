<?php
session_start();
include 'config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$follower_user_id = $_SESSION['user_id'];
$user_id = $_POST['user_id'];
$action = $_POST['action'];

// Fetch the follower username
$sql_follower = "SELECT username FROM Users WHERE user_id = '$follower_user_id'";
$result_follower = $conn->query($sql_follower);
$follower_username = $result_follower->fetch_assoc()['username'];

if ($action == 'follow') {
    // Insert a new follow relationship
    $sql = "INSERT INTO Followers (follower_user_id, user_id) VALUES ('$follower_user_id', '$user_id')";
    if ($conn->query($sql) === TRUE) {
        // Generate notification for the followed user
        $notification_message = "$follower_username followed you.";
        $sql_notification = "INSERT INTO Notifications (user_id, type, message) VALUES ('$user_id', 'follow', '$notification_message')";
        $conn->query($sql_notification);
        echo "Followed successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
} elseif ($action == 'unfollow') {
    // Delete the follow relationship
    $sql = "DELETE FROM Followers WHERE follower_user_id = '$follower_user_id' AND user_id = '$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Unfollowed successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Redirect back to the user's profile
header("Location: user_profile.php?user_id=$user_id");
exit();

$conn->close();
?>
