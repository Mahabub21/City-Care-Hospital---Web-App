<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - City Care Hospital</title>
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <a href="../index.html" class="home-btn"><i class="fas fa-home"></i> Home</a>
        <h2>Login</h2>
        <form method="post" action="login_process.php">
            <label for="email">Email:</label>
            <div class="input-container">
                <i class="fas fa-envelope"></i> <!-- Email Icon -->
                <input type="email" id="email" name="email" required>
            </div>

            <label for="password">Password:</label>
            <div class="input-container">
                <i class="fas fa-lock"></i> <!-- Password Icon -->
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Login</button>
        </form>
        <p><a href="forgot_password.php">Forgot Password?</a></p>
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
</body>
</html>
