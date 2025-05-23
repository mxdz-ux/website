<?php
require_once 'config.php';

// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    $_SESSION['error'] = "You don't have permission to access this page.";
    redirect('index.php');
    exit;
}

// Get borrows in the last week, grouped by user
$query = "SELECT u.id, u.username, u.first_name, u.last_name, u.email, COUNT(b.id) as books_borrowed
          FROM borrows b
          JOIN users u ON b.user_id = u.id
          WHERE b.borrow_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
          GROUP BY u.id, u.username, u.first_name, u.last_name, u.email
          ORDER BY books_borrowed DESC, u.last_name ASC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$report = $stmt->fetchAll(PDO::FETCH_ASSOC);

$today = date('M d, Y');
$weekAgo = date('M d, Y', strtotime('-6 days'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Borrow Report - Reading Club 2000</title>
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
            <li><a href="admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="admin_books.php"><i class="fas fa-book"></i> Manage Books</a></li>
            <li><a href="admin_requests.php"><i class="fas fa-clipboard-list"></i> Borrow Requests</a></li>
            <li><a href="admin_users.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="admin_report.php" class="active"><i class="fas fa-chart-bar"></i>  Report</a></li>
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
            <h2>Activity Report</h2>
            <form method="post" style="display:inline;">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" value="<?php echo isset($_POST['start_date']) ? htmlspecialchars($_POST['start_date']) : ''; ?>" required>
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" value="<?php echo isset($_POST['end_date']) ? htmlspecialchars($_POST['end_date']) : ''; ?>" required>
                <button type="submit" name="generate_report" class="btn btn-primary" style="background:#007bff;color:#fff;"><i class="fas fa-sync-alt"></i> Generate</button>
                <button type="button" class="btn btn-primary" style="background:#007bff;color:#fff;;margin-left:8px;" onclick="clearReportForm()"><i class="fas fa-eraser"></i> Clear</button>
            </form>
            <script>
            function clearReportForm() {
                document.getElementById('start_date').value = '';
                document.getElementById('end_date').value = '';
                // Submit the form to clear the table
                var form = document.querySelector('form[method=post]');
                // Add a hidden input to indicate clear action
                var clearInput = document.createElement('input');
                clearInput.type = 'hidden';
                clearInput.name = 'clear_report';
                clearInput.value = '1';
                form.appendChild(clearInput);
                form.submit();
            }
            </script>
        </div>
        <?php
        $showTable = false;
        $borrowed = $returnedOnTime = $returnedLate = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate_report'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            // Borrowed books (all borrows in range)
            $query = "SELECT b.id as borrow_id, u.username, CONCAT(u.first_name, ' ', u.last_name) as full_name, u.email, bk.title, b.borrow_date
                      FROM borrows b
                      JOIN users u ON b.user_id = u.id
                      JOIN books bk ON b.book_id = bk.id
                      WHERE b.borrow_date BETWEEN ? AND ?
                      ORDER BY b.borrow_date DESC";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$start_date, $end_date]);
            $borrowed = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Returned on time
            $query = "SELECT b.id as borrow_id, u.username, CONCAT(u.first_name, ' ', u.last_name) as full_name, u.email, bk.title, b.borrow_date, b.return_date
                      FROM borrows b
                      JOIN users u ON b.user_id = u.id
                      JOIN books bk ON b.book_id = bk.id
                      WHERE b.return_date IS NOT NULL AND b.return_date <= b.due_date AND b.return_date BETWEEN ? AND ?
                      ORDER BY b.return_date DESC";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$start_date, $end_date]);
            $returnedOnTime = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Returned late
            $query = "SELECT b.id as borrow_id, u.username, CONCAT(u.first_name, ' ', u.last_name) as full_name, u.email, bk.title, b.borrow_date, b.return_date, b.due_date,
                             TIMESTAMPDIFF(DAY, b.due_date, b.return_date) as overdue_days
                      FROM borrows b
                      JOIN users u ON b.user_id = u.id
                      JOIN books bk ON b.book_id = bk.id
                      WHERE b.return_date IS NOT NULL AND b.return_date > b.due_date AND b.return_date BETWEEN ? AND ?
                      ORDER BY b.return_date DESC";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$start_date, $end_date]);
            $returnedLate = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $showTable = true;
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_report'])) {
            // Clear button pressed, do not show table
            $showTable = false;
        }
        ?>
        <?php if ($showTable): ?>
        <div class="table-responsive">
            <h3>Books Borrowed</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Borrow ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Book Title</th>
                        <th>Time Borrowed</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($borrowed) > 0): ?>
                        <?php foreach ($borrowed as $row): ?>
                            <tr>
                                <td><?php echo $row['borrow_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['borrow_date']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="no-results">No books borrowed in this range.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <h3>Books Returned On Time</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Borrow ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Book Title</th>
                        <th>Time Borrowed</th>
                        <th>Time Returned</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($returnedOnTime) > 0): ?>
                        <?php foreach ($returnedOnTime as $row): ?>
                            <tr>
                                <td><?php echo $row['borrow_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['borrow_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['return_date']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="no-results">No books returned on time in this range.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <h3>Books Returned Late</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Borrow ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Book Title</th>
                        <th>Time Borrowed</th>
                        <th>Time Returned</th>
                        <th>Overdue Time (days)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($returnedLate) > 0): ?>
                        <?php foreach ($returnedLate as $row): ?>
                            <tr>
                                <td><?php echo $row['borrow_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['borrow_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['return_date']); ?></td>
                                <td><?php echo (int)$row['overdue_days']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8" class="no-results">No books returned late in this range.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Rejected Requests Table -->
        <div class="table-responsive">
            <h3>Rejected Borrow Requests</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Book Title</th>
                        <th>Category</th>
                        <th>Request Date</th>
                        <th>Rejection Reason</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch rejected requests in the date range from borrows table (not borrow_requests)
                    $query = "SELECT b.id as request_id, u.username, CONCAT(u.first_name, ' ', u.last_name) as full_name, u.email, bk.title, bk.category, b.borrow_date as request_date, b.admin_note as rejection_reason
                              FROM borrows b
                              JOIN users u ON b.user_id = u.id
                              JOIN books bk ON b.book_id = bk.id
                              WHERE b.status = 'rejected' AND b.borrow_date BETWEEN ? AND ?
                              ORDER BY b.borrow_date DESC";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$start_date, $end_date]);
                    $rejected = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (count($rejected) > 0):
                        foreach ($rejected as $row): ?>
                            <tr>
                                <td><?php echo $row['request_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['category']); ?></td>
                                <td><?php echo htmlspecialchars($row['request_date']); ?></td>
                                <td><?php echo !empty($row['rejection_reason']) ? htmlspecialchars($row['rejection_reason']) : 'N/A'; ?></td>
                            </tr>
                        <?php endforeach;
                    else: ?>
                        <tr><td colspan="8" class="no-results">No rejected requests in this range.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
