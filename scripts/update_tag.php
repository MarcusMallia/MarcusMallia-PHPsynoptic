<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $tag_id = $_POST['tag_id'];
    $name = $_POST['name'];

    // Update the tag in the database
    $sql = "UPDATE Tags SET name='$name' WHERE tag_id=$tag_id";

    if ($conn->query($sql) === TRUE) {
        echo "Tag updated successfully";
    } else {
        echo "Error updating tag: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
