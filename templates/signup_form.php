<form id="signup-form" action="signup.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <div id="username-error" class="error-message"></div>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <div id="email-error" class="error-message"></div>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <div id="password-error" class="error-message"></div>

    <label for="confirm-password">Confirm Password:</label>
    <input type="password" id="confirm-password" name="confirm_password" required>
    <div id="confirm-password-error" class="error-message"></div>

    <button type="submit">Signup</button>
</form>
<div id="form-error" class="error-message"></div>
