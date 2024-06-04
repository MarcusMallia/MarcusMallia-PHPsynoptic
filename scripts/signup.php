<?php
// Include the database connection file
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $sql = "INSERT INTO Users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "New user created successfully.";
        header("Location: ../login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<?php include '../templates/header.php'; ?>

<!-- Main content section -->
<main>
    <h2>Signup</h2>
    <?php include '../templates/signup_form.php'; ?>
</main>

<?php include '../templates/footer.php'; ?>
