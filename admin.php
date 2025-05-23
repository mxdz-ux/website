<?php
require_once 'config.php';

// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    $_SESSION['error'] = "You don't have permission to access this page.";
    redirect('index.php');
    exit;
}

// Get counts for dashboard
$stmt = $pdo->query("SELECT COUNT(*) as total FROM books");
$totalBooks = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM borrows WHERE status = 'pending'");
$pendingRequests = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM borrows WHERE status = 'borrowed'");
$activeBorrows = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE is_admin = 0");
$totalUsers = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Reading Club 2000</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/admin2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Admin Navbar -->
    <nav class="admin-navbar">
        <div class="logo">
            <img src="assets/img/Logo5.png" alt="Reading Club Logo">
            <h1>Admin Dashboard</h1>
        </div>
        <ul class="nav-links">
            <li><a href="admin.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="admin_books.php"><i class="fas fa-book"></i> Manage Books</a></li>
            <li><a href="admin_requests.php"><i class="fas fa-clipboard-list"></i> Borrow Requests</a></li>
            <li><a href="admin_users.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="admin_report.php"><i class="fas fa-chart-bar"></i> Reports</a></li>
            <li><a href="admin_only.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            
        </ul>
        <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>

    <div class="admin-container">
        <h2>Welcome, <?php echo $_SESSION['first_name'], " ",  "Admin"; ?>!</h2>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

       <div class="dashboard-counters">
    <div class="counter-box blue">
        <div class="counter-title">Total Books</div>
        <div class="counter-value"><?php echo $totalBooks; ?></div>
        <div class="counter-icon"><i class="fas fa-book"></i></div>
    </div>
    <div class="counter-box green">
        <div class="counter-title">Active Borrows</div>
        <div class="counter-value"><?php echo $activeBorrows; ?></div>
        <div class="counter-icon"><i class="fas fa-book-reader"></i></div>
    </div>
    <div class="counter-box yellow">
        <div class="counter-title">Pending Requests</div>
        <div class="counter-value"><?php echo $pendingRequests; ?></div>
        <div class="counter-icon"><i class="fas fa-hourglass-half"></i></div>
    </div>
    <div class="counter-box purple">
        <div class="counter-title">Total Users</div>
        <div class="counter-value"><?php echo $totalUsers; ?></div>
        <div class="counter-icon"><i class="fas fa-users"></i></div>
    </div>
</div>

        
        <div class="recent-activity">
            <h3>Recent Borrow Activities</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Book</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->query("
                        SELECT b.id as borrow_id, u.first_name, u.last_name, bk.title, bk.category, b.status, b.borrow_date, b.book_id
                        FROM borrows b
                        JOIN users u ON b.user_id = u.id
                        JOIN books bk ON b.book_id = bk.id
                        ORDER BY b.borrow_date DESC
                        LIMIT 5
                    ");
                    
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                    <tr>
                        <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td>
                            <span class="status-badge status-<?php echo strtolower($row['status']); ?>">
                                <?php echo ucfirst($row['status']); ?>
                            </span>
                        </td>
                        <td><?php echo date('M j, Y', strtotime($row['borrow_date'])); ?></td>
                        <td class="action-buttons">
                            <?php if ($row['status'] == 'pending'): ?>
                                <a href="process_borrow.php?action=approve&id=<?php echo $row['borrow_id']; ?>" class="btn-small btn-approve">Approve</a>
                                <a href="process_borrow.php?action=reject&id=<?php echo $row['borrow_id']; ?>" class="btn-small btn-reject">Reject</a>
                            <?php elseif ($row['status'] == 'approved'): ?>
                                <a href="process_borrow.php?action=return&id=<?php echo $row['borrow_id']; ?>" class="btn-small btn-return">Mark Returned</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <br>
            <a href="admin_requests.php" class="view-all">View All Requests</a>
        </div>
    </div>

    <script src="assets/js/admin.js"></script>
</body>
</html>