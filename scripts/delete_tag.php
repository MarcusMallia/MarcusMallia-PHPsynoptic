<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $tag_id = $_POST['tag_id'];

    // Delete the tag from the database
    $sql = "DELETE FROM Tags WHERE tag_id=$tag_id";

    if ($conn->query($sql) === TRUE) {
        echo "Tag deleted successfully";
    } else {
        echo "Error deleting tag: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
