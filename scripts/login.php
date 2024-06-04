<?php
// Start the session
session_start();

// Include the database connection file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to select the user with the provided email
    $sql = "SELECT * FROM Users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            header("Location: ../index.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }

    // Close the database connection
    $conn->close();
}
?>

<?php include '../templates/header.php'; ?>

<!-- Main content section -->
<main>
    <h2>Login</h2>
    <?php include '../templates/login_form.php'; ?>
</main>

<?php include '../templates/footer.php'; ?>
