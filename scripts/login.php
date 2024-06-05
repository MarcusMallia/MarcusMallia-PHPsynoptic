<?php
// Start the session
session_start();

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SpeakeasySounds</title>
    <link rel="stylesheet" href="/MarcusMallia-PHPsynoptic/assets/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-form-container">
            <form id="login-form" action="login.php" method="post">
                <h2>Login</h2>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Email address" required>
                    <div id="email-error" class="error-message"></div>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <div id="password-error" class="error-message"></div>
                </div>
                <button type="submit">Login</button>
                <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            </form>
            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
        </div>
        <div class="login-message-container">
            <h2>Welcome to SpeakeasySounds</h2>
            <p>Share your musical experiences and connect with other music enthusiasts.</p>
        </div>
    </div>
</body>
</html>
