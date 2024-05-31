<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $follower_user_id = $_POST['follower_user_id'];

    // Insert the new follower into the database
    $sql = "INSERT INTO Followers (user_id, follower_user_id) VALUES ('$user_id', '$follower_user_id')";

    if ($conn->query($sql) === TRUE) {
        echo "New follower added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
