<!-- Login form -->
<form id="login-form" action="login.php" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <div id="email-error" class="error-message"></div>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <div id="password-error" class="error-message"></div>

    <button type="submit">Login</button>
</form>
<div id="form-error" class="error-message"></div>
