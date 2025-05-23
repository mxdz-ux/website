<?php
require_once 'config.php';

$errors = [];
$success = '';
$showForm = true;

if (isset($_GET['token']) && !empty($_GET['token'])) {
    $token = $_GET['token'];
    // Debug: check if token exists and show details
    $stmt_dbg = $pdo->prepare('SELECT id, username, reset_token, reset_expires FROM users WHERE reset_token = ?');
    $stmt_dbg->execute([$token]);
    $row_dbg = $stmt_dbg->fetch(PDO::FETCH_ASSOC);
    if (!$row_dbg) {
        $errors[] = 'Invalid reset link. No user found for this token.';
        $showForm = false;
    } else if (empty($row_dbg['reset_expires']) || strtotime($row_dbg['reset_expires']) < time()) {
        $errors[] = 'Reset link has expired.';
        $showForm = false;
    } else {
        // Token is valid and not expired, fetch full user for password reset
        $user = $row_dbg;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';
            if (strlen($password) < 6) {
                $errors[] = 'Password must be at least 6 characters.';
            } elseif ($password !== $confirm) {
                $errors[] = 'Passwords do not match.';
            } else {
                // Update password, clear token
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare('UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?');
                $stmt->execute([$hashed, $user['id']]);
                $success = 'Your password has been reset. You can now <a href="login.php">login</a>.';
                $showForm = false;
            }
        }
    }
} else {
    $errors[] = 'Invalid or expired reset link.';
    $showForm = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Reading Club 2000</title>
    <link rel="stylesheet" href="assets/css/loginn.css">
</head>
<body background="assets/img/back.png">
<div class="fullscreen-wrapper">
    <img src="assets/img/Logo.png" alt="logo">
    <h1>Reading Club 2000</h1>
    <div class="auth-container">
        <h2>Reset Password</h2>
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
        <?php if ($showForm): ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" placeholder="Enter new password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password" required>
            </div>
            <button type="submit" class="btn">Reset Password</button>
        </form>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
