<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $confirm_password = sanitizeInput($_POST['confirm_password']);
    $first_name = sanitizeInput($_POST['first_name']);
    $last_name = sanitizeInput($_POST['last_name']);

    // Validate inputs
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }
    
    if (empty($first_name)) {
        $errors[] = "First name is required";
    }
    
    if (empty($last_name)) {
        $errors[] = "Last name is required";
    }

    // Check if username or email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    
    if ($stmt->rowCount() > 0) {
        $errors[] = "Username or email already exists";
    }

    if (empty($errors)) {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user into database
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, first_name, last_name) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password, $first_name, $last_name]);
        
        // Send welcome email
        $subject = "Welcome to Reading Club 2000";
        $message = "Dear $first_name,\n\nThank you for joining Reading Club 2000. You can now borrow books from our collection.\n\nHappy reading!";
        sendEmail($email, $subject, $message);
        
        $_SESSION['success'] = "Registration successful! You can now login.";
        redirect('login.php');
    }
}

function sendEmail($to, $subject, $message) {
    $headers = "From: " . FROM_NAME . " <" . FROM_EMAIL . ">\r\n";
    $headers .= "Reply-To: " . FROM_EMAIL . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    mail($to, $subject, $message, $headers);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sign Up - Reading Club 2000</title>
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .eye-icon {
            cursor: pointer;
        }
        .btn {
            background: #4e342e;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 12px 0;
            width: 100%;
            font-size: 1.1rem;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            margin-top: 10px;
        }
        .btn:hover {
            background: #6d4c2b;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="fullscreen-wrapper">
        <div class="auth-container">
            <h2>Create an Account</h2>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="signup.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
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

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <div style="position:relative;">
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required style="padding-right:40px;">
                        <button type="button" class="toggle-password" onclick="togglePassword('confirm_password', this)" tabindex="-1" style="position:absolute; right:8px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer;">
                            <span class="eye-icon" aria-label="Show password" style="font-size:1.2em;">&#128065;</span>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" required>
                </div>

                <button type="submit" class="btn">Sign Up</button>
            </form>

            <p style="text-align: center; margin-top: 15px;">Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>

    <script>
        function togglePassword(id, element) {
            var input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
                element.querySelector(".eye-icon").innerHTML = "&#128064;"; // Eye slash icon
            } else {
                input.type = "password";
                element.querySelector(".eye-icon").innerHTML = "&#128065;"; // Eye icon
            }
        }

        function togglePassword(fieldId, btn) {
            var input = document.getElementById(fieldId);
            if (input.type === 'password') {
                input.type = 'text';
                btn.querySelector('.eye-icon').textContent = '\u{1F441}\u{FE0E}'; // eye open
            } else {
                input.type = 'password';
                btn.querySelector('.eye-icon').textContent = '\u{1F441}'; // eye
            }
        }
    </script>
</body>
</html>