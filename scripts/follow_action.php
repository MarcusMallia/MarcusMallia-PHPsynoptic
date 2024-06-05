<?php
session_start();
include 'config.php'; 

header('Content-Type: application/json');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit();
}

$follower_user_id = $_SESSION['user_id'];
$user_id = $_POST['user_id'];
$action = $_POST['action'];

if ($action == 'follow') {
    // Insert a new follow relationship
    $sql = "INSERT INTO Followers (follower_user_id, user_id) VALUES ('$follower_user_id', '$user_id')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'action' => 'follow']);
    } else {
        echo json_encode(['success' => false, 'message' => $conn->error]);
    }
} elseif ($action == 'unfollow') {
    // Delete the follow relationship
    $sql = "DELETE FROM Followers WHERE follower_user_id = '$follower_user_id' AND user_id = '$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'action' => 'unfollow']);
    } else {
        echo json_encode(['success' => false, 'message' => $conn->error]);
    }
}

$conn->close();
?>
