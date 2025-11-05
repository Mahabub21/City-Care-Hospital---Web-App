<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - City Care Hospital</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <a href="../index.html" class="home-btn">🏠 Home</a>
        <h2>Reset Password</h2>
        <form method="post" action="reset_password.php">
            <label for="email">Enter Your Email:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Send Reset Link</button>
        </form>
        <p>Remembered your password? <a href="../login.php">Login</a></p>
    </div>
</body>
</html>
