<?php 
// Include the header template
include '../templates/header.php'; 
?>

<!-- Main content section -->
<main>
    <h2>Signup</h2>
    <!-- Placeholder for signup form -->
    <div class="signup-form">
        <form action="#" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username">
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email">
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
            
            <button type="submit">Signup</button>
        </form>
    </div>
</main>

<?php 
// Include the footer template
include '../templates/footer.php'; 
?>
