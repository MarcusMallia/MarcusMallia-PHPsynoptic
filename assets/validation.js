document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function (event) {
            let isValid = true;

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Clear previous error messages
            document.getElementById('email-error').textContent = '';
            document.getElementById('password-error').textContent = '';
            document.getElementById('form-error').textContent = '';

            // Validate email
            if (!email) {
                isValid = false;
                document.getElementById('email-error').textContent = 'Email is required.';
            } else if (!validateEmail(email)) {
                isValid = false;
                document.getElementById('email-error').textContent = 'Invalid email format.';
            }

            // Validate password
            if (!password) {
                isValid = false;
                document.getElementById('password-error').textContent = 'Password is required.';
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
                document.getElementById('form-error').textContent = 'Please correct the errors above.';
            }
        });
    }

    const signupForm = document.getElementById('signup-form');
    if (signupForm) {
        signupForm.addEventListener('submit', function (event) {
            let isValid = true;

            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            // Clear previous error messages
            document.getElementById('username-error').textContent = '';
            document.getElementById('email-error').textContent = '';
            document.getElementById('password-error').textContent = '';
            document.getElementById('confirm-password-error').textContent = '';
            document.getElementById('form-error').textContent = '';

            // Validate username
            if (!username) {
                isValid = false;
                document.getElementById('username-error').textContent = 'Username is required.';
            }

            // Validate email
            if (!email) {
                isValid = false;
                document.getElementById('email-error').textContent = 'Email is required.';
            } else if (!validateEmail(email)) {
                isValid = false;
                document.getElementById('email-error').textContent = 'Invalid email format.';
            }

            // Validate password
            if (!password) {
                isValid = false;
                document.getElementById('password-error').textContent = 'Password is required.';
            }

            // Validate confirm password
            if (password !== confirmPassword) {
                isValid = false;
                document.getElementById('confirm-password-error').textContent = 'Passwords do not match.';
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
                document.getElementById('form-error').textContent = 'Please correct the errors above.';
            }
        });
    }

    // Function to validate email format
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }
});
