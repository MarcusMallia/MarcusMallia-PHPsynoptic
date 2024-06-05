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
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query to insert the new user
    $sql = "INSERT INTO Users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<?php include '../templates/header.php'; ?>

<!-- Main content section -->
<main class="login-main">
    <div class="login-container">
        <div class="login-form-container">
            <h2>Sign Up</h2>
            <form id="signup-form" action="signup.php" method="post">
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Sign Up</button>
            </form>
            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
        <div class="login-message-container">
            <h2>Welcome to SpeakeasySounds</h2>
            <p>Share your musical experiences and connect with other music enthusiasts.</p>
        </div>
    </div>
</main>

<?php include '../templates/footer.php'; ?>
