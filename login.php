<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($errors)) {
        // Check user credentials
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['is_admin'] = isset($user['is_admin']) ? $user['is_admin'] : 0;
            // Redirect all users to home page (not admin)
            redirect('home.php');
        } else {
            $errors[] = "Invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Reading Club 2000</title>
    <link rel="stylesheet" href="assets/css/loginn.css">
    <style>
        .eye-icon {
            cursor: pointer;
        }
    </style>
</head>
<body background="assets/img/back.png">

<div class="fullscreen-wrapper">
    <img src="assets/img/Logo.png" alt="logo">
        <h1>Reading Club 2000</h1>
        <div class="auth-container">
            <h2>Login</h2>
            
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <p><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
                </div>
            <?php endif; ?>
            
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div style="position:relative;">
                        <input type="password" id="password" name="password" placeholder="Enter your password" required style="padding-right:40px;">
                        <button type="button" class="toggle-password" onclick="togglePassword('password', this)" tabindex="-1" style="position:absolute; right:8px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer;">
                            <span class="eye-icon" aria-label="Show password" style="font-size:1.2em;">&#128065;</span>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="btn">LOGIN</button>
            </form>
            <br>
            <div class="divider"></div>
            
            <div class="auth-footer">
                <a href="forgot_password.php">Forgot your password?</a>
                <br>
                <br>
                Don't have an account? <a href="signup.php">Sign up here</a>
                
            </div>
        </div>
    </div>

    <script>
        function togglePassword(id, element) {
            var input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
                element.querySelector(".eye-icon").innerHTML = "\u{1F441}"; 
            } else {
                input.type = "password";
                element.querySelector(".eye-icon").innerHTML = "\u{1F441}";
            }
        }
    </script>
</body>
</html>