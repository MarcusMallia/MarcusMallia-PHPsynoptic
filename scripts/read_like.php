<?php
// Include the database connection file
include 'config.php';

// Query to select all likes
$sql = "SELECT * FROM Likes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "Like ID: " . $row["like_id"]. " - Post ID: " . $row["post_id"]. " - User ID: " . $row["user_id"]. "<br>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
