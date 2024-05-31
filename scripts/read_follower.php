<?php
// Include the database connection file
include 'config.php';

// Query to select all followers
$sql = "SELECT * FROM Followers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "Follower ID: " . $row["follower_id"]. " - User ID: " . $row["user_id"]. " - Follower User ID: " . $row["follower_user_id"]. "<br>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
