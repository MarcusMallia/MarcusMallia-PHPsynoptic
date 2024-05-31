<?php
// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];

    // Insert the new tag into the database
    $sql = "INSERT INTO Tags (name) VALUES ('$name')";

    if ($conn->query($sql) === TRUE) {
        echo "New tag created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
