<?php
// Start the session
session_start();

// Include the database connection file
include 'config.php';

$error = ''; // Variable to hold error messages

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match."; // Set error message for password mismatch
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $sql = "INSERT INTO Users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            header("Location: /MarcusMallia-PHPsynoptic/scripts/login.php");
            exit();
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error; // Set error message for database error
        }

        // Close the database connection
        $conn->close();
    }
}
?>

<?php include '../templates/header.php'; ?>

<!-- Main content section -->
<main>
    <h2>Signup</h2>
    <?php include '../templates/signup_form.php'; ?>
    <?php if ($error): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
</main>

<?php include '../templates/footer.php'; ?>
