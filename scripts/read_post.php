<?php
// Include the database connection file
include 'config.php';

// Query to select all posts
$sql = "SELECT * FROM Posts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "Post ID: " . $row["post_id"]. " - User ID: " . $row["user_id"]. " - Content: " . $row["content"]. " - Link: " . $row["link"]. "<br>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
