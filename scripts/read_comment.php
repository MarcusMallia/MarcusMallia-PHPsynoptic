<?php
// Include the database connection file
include 'config.php';

// Query to select all comments
$sql = "SELECT * FROM Comments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "Comment ID: " . $row["comment_id"]. " - Post ID: " . $row["post_id"]. " - User ID: " . $row["user_id"]. " - Content: " . $row["content"]. "<br>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
