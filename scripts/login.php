<?php
// Start the session
session_start();

// Include the header template
include '../templates/header.php';

// Include the database connection file
include 'config.php';

$error = ''; // Variable to hold error messages

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
            header("Location: /MarcusMallia-PHPsynoptic/scripts/index.php");
            exit();
        } else {
            $error = "Invalid password."; // Set error message for invalid password
        }
    } else {
        $error = "No user found with this email."; // Set error message for no user found
    }

    // Close the database connection
    $conn->close();
}
?>

<!-- Main content section -->
<main>
    <h2>Login</h2>
    <!-- Include the login form template -->
    <?php include '../templates/login_form.php'; ?>
    <!-- Display error message if any -->
    <?php if ($error): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
</main>

<?php include '../templates/footer.php'; ?>
