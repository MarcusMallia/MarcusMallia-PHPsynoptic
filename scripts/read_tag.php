<?php
// Include the database connection file
include 'config.php';

// Query to select all tags
$sql = "SELECT * FROM Tags";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "Tag ID: " . $row["tag_id"]. " - Name: " . $row["name"]. "<br>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
