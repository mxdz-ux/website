<?php
require_once 'config.php';

// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    $_SESSION['error'] = "You don't have permission to access this page.";
    redirect('index.php');
    exit;
}

// Get user ID from query
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "Invalid user ID.";
    redirect('admin_users.php');
    exit;
}
$user_id = (int)$_GET['id'];

// Fetch user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) {
    $_SESSION['error'] = "User not found.";
    redirect('admin_users.php');
    exit;
}

// Handle update or delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $is_admin = isset($_POST['is_admin']) ? (int)$_POST['is_admin'] : 0;
        $stmt = $pdo->prepare("UPDATE users SET is_admin = ? WHERE id = ?");
        $stmt->execute([$is_admin, $user_id]);
        $_SESSION['success'] = "User role updated successfully.";
        redirect('admin_users.php');
        exit;
    } elseif (isset($_POST['delete'])) {
        // Prevent admin from deleting themselves
        if ($user_id == $_SESSION['user_id']) {
            $_SESSION['error'] = "You cannot delete your own account.";
        } else {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            $_SESSION['success'] = "User deleted successfully.";
        }
        redirect('admin_users.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Reading Club 2000</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/admin2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <nav class="admin-navbar">
        <div class="logo">
            <img src="assets/img/Logo5.png" alt="Reading Club Logo">
            <h1>Admin Dashboard</h1>
        </div>
        <ul class="nav-links">
            <li><a href="admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="admin_books.php"><i class="fas fa-book"></i> Manage Books</a></li>
            <li><a href="admin_requests.php"><i class="fas fa-clipboard-list"></i> Borrow Requests</a></li>
            <li><a href="admin_users.php" class="active"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="admin_report.php"><i class="fas fa-chart-bar"></i> Weekly Report</a></li>
            <li><a href="admin_only.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
        <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>
    <div class="admin-container">
        <div class="admin-header">
            <h2>Edit User</h2>
            <a href="admin_users.php" class="btn btn-secondary">Back to Users</a>
        </div>
        <div class="edit-user-form">
            <form method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" value="<?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="is_admin">Role</label>
                    <select id="is_admin" name="is_admin">
                        <option value="0" <?php if (!$user['is_admin']) echo 'selected'; ?>>Member</option>
                        <option value="1" <?php if ($user['is_admin']) echo 'selected'; ?>>Admin</option>
                    </select>
                </div>
                <div class="form-buttons">
                    <button type="submit" name="update" class="btn btn-primary">Update Role</button>
                    <?php if ($user['id'] != $_SESSION['user_id']): ?>
                        <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">Delete User</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
