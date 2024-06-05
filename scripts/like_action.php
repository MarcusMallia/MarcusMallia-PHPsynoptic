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

if ($action == 'like') {
    // Insert a new like
    $sql = "INSERT INTO Likes (user_id, post_id) VALUES ('$user_id', '$post_id')";
    if ($conn->query($sql) === TRUE) {
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
