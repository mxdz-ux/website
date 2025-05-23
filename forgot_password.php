<?php
require_once 'config.php';

$success = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $errors[] = 'Please enter a valid email address.';
    } else {
        // Check if email exists in users table
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            // Generate a unique reset token and expiration (1 hour)
            $token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
            // Store token and expiry in DB (add columns if needed)
            $stmt = $pdo->prepare('UPDATE users SET reset_token = ?, reset_expires = ? WHERE id = ?');
            $stmt->execute([$token, $expires, $user['id']]);

            // Send email with PHPMailer (Gmail SMTP, plain text)
            require_once __DIR__ . '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
            require_once __DIR__ . '/vendor/phpmailer/phpmailer/src/SMTP.php';
            require_once __DIR__ . '/vendor/phpmailer/phpmailer/src/Exception.php';
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'dddummyacc6969420@gmail.com'; // Your Gmail
                $mail->Password   = 'vyfh fxlm xfpf sdvk'; // App Password
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
                $mail->setFrom('dddummyacc6969420@gmail.com', 'Reading Club 2000');
                $mail->addAddress($email);
                $mail->isHTML(false); // Plain text
                $mail->Subject = 'Password Reset Request';
                $resetLink = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/reset_password.php?token=' . $token;
                $mail->Body    = "Hello {$user['username']},\n\nYou requested a password reset. Click the link below to reset your password:\n\n$resetLink\n\nIf you did not request this, you can ignore this email.\n\nBest regards,\nReading Club 2000";
                if ($mail->send()) {
                    $success = 'If this email is registered, a password reset link has been sent.';
                } else {
                    $errors[] = 'Invalid.';
                }
            } catch (Exception $e) {
                $errors[] = 'Failed to send reset email. Please try again later.';
            }
        } else {
            $success = 'If this email is registered, a password reset link has been sent.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Reading Club 2000</title>
    <link rel="stylesheet" href="assets/css/loginn.css">
    <style>
        .eye-icon { cursor: pointer; }
    </style>
</head>
<body background="assets/img/back.png">
<div class="fullscreen-wrapper">
    <img src="assets/img/Logo.png" alt="logo">
    <h1>Reading Club 2000</h1>
    <div class="auth-container">
        <h2>Forgot Password</h2>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success">
                <p><?php echo $success; ?></p>
            </div>
        <?php endif; ?>
        <form action="forgot_password.php" method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <button type="submit" class="btn">Send Reset Link</button>
        </form>
        <br>
        <div class="divider"></div>
        <div class="auth-footer">
            Remembered your password? <a href="login.php">Login here</a>
        </div>
    </div>
</div>
</body>
</html>
