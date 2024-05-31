<?php
// Include the database connection file
include 'config.php';

// Query to select all notifications
$sql = "SELECT * FROM Notifications";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "Notification ID: " . $row["notification_id"]. " - User ID: " . $row["user_id"]. " - Type: " . $row["type"]. " - Message: " . $row["message"]. "<br>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
