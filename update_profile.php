<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');

    // Basic validation
    if ($username === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Please fill in all fields with valid information.';
        header('Location: my_books.php');
        exit;
    }

    // Check for username/email conflicts (excluding current user)
    $stmt = $pdo->prepare('SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?');
    $stmt->execute([$username, $email, $user_id]);
    if ($stmt->fetch()) {
        $_SESSION['error'] = 'Username or email already taken.';
        header('Location: my_books.php');
        exit;
    }

    // Update user in database
    $stmt = $pdo->prepare('UPDATE users SET username = ?, email = ? WHERE id = ?');
    $stmt->execute([$username, $email, $user_id]);

    // Update session values
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;

    $_SESSION['success'] = 'Profile updated successfully!';
    header('Location: my_books.php');
    exit;
} else {
    header('Location: my_books.php');
    exit;
}
?>
