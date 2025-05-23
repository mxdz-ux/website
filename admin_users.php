<?php
require_once 'config.php';

// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    $_SESSION['error'] = "You don't have permission to access this page.";
    redirect('index.php');
    exit;
}

// Handle user search/filter
$search = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';
$role = isset($_GET['role']) ? sanitizeInput($_GET['role']) : '';

// Get all users
$query = "SELECT * FROM users WHERE 1=1";
$params = [];

if (!empty($search)) {
    $query .= " AND (username LIKE ? OR email LIKE ? OR first_name LIKE ? OR last_name LIKE ?)";
    $searchParam = "%$search%";
    $params = array_merge($params, [$searchParam, $searchParam, $searchParam, $searchParam]);
}

if (!empty($role)) {
    $query .= " AND is_admin = ?";
    $params[] = ($role == 'admin') ? 1 : 0;
}

$query .= " ORDER BY created_at DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Reading Club 2000</title>
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
            <li><a href="admin_users.php" class="active"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="admin_report.php"><i class="fas fa-chart-bar"></i> Weekly Report</a></li>
            <li><a href="home.php"><i class="fas fa-home"></i> Main Site</a></li>
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
            <h2>Manage Users</h2>
            <button id="addUserBtn" class="btn btn-primary"><i class="fas fa-plus"></i> Add New User</button>
        </div>
        
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
        
        <!-- Search and Filter Section -->
        <div class="search-filter">
            <form action="admin_users.php" method="GET">
                <div class="search-bar">
                    <input type="text" name="search" placeholder="Search by name, username or email..." value="<?php echo $search; ?>">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
                
                <div class="filter-options">
                    <select name="role">
                        <option value="">All Users</option>
                        <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?>>Admins</option>
                        <option value="member" <?php echo ($role == 'member') ? 'selected' : ''; ?>>Members</option>
                    </select>
                    
                    <button type="submit" class="btn filter-btn">Filter</button>
                    <a href="admin_users.php" class="btn reset-btn">Reset</a>
                </div>
            </form>
        </div>
        
        <!-- Users Table -->
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($users) > 0): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td>
                                    <span class="role-badge role-<?php echo ($user['is_admin'] ? 'admin' : 'member'); ?>">
                                        <?php echo ($user['is_admin'] ? 'Admin' : 'Member'); ?>
                                    </span>
                                </td>
                                <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                                <td class="action-buttons">
                                    <a href="admin_edit_user.php?id=<?php echo $user['id']; ?>" class="btn-small btn-edit"><i class="fas fa-edit"></i> Edit</a>
                                    <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                        <a href="#" class="btn-small btn-delete" data-id="<?php echo $user['id']; ?>" data-username="<?php echo $user['username']; ?>"><i class="fas fa-trash"></i> Delete</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="no-results">No users found matching your criteria.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
      <!-- Add User Modal -->
    <div id="addUserModal" class="modal-overlay">
        <div class="modal-content">
            <img src="assets/img/Logo.png" alt="Add User" class="modal-check" style="width: 80px; margin: 0 auto; display: block;" />
            <h2 style="text-align:center; color: #2196F3;">Add New User</h2>
            <form action="process_add_user.php" method="POST">
                <div class="form-group">
                    <input type="text" id="username" name="username" placeholder="Username*" required>
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Email*" required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Password*" required>
                </div>
                <div class="form-group">
                    <input type="text" id="first_name" name="first_name" placeholder="First Name*" required>
                </div>
                <div class="form-group">
                    <input type="text" id="last_name" name="last_name" placeholder="Last Name*" required>
                </div>
                <div class="form-group" style="text-align: center;">
                    <label style="display: inline-block;">
                        <input type="checkbox" name="is_admin" value="1">
                        Make this user an admin
                    </label>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn" style="background: #2196F3;">Yes, Add User!</button>
                    <button type="button" class="btn close-modal" style="background: #757575;">No, Cancel.</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal-overlay">
        <div class="modal-content">
            <img src="assets/img/Logo.png" alt="Delete User" class="modal-check" style="width: 80px; margin: 0 auto; display: block; filter: grayscale(1);" />
            <h2 style="text-align:center; color: #d32f2f;">Confirm Delete</h2>
            <div class="confirmation-message">
                <p class="user-info" style="text-align:center; margin-bottom: 10px;"></p>
                <p style="text-align:center;">Are you sure you want to delete this user? This action cannot be undone.</p>
            </div>
            <form action="process_delete_user.php" method="POST" id="deleteForm">
                <input type="hidden" name="user_id" id="deleteUserId">
                <div class="form-buttons">
                    <button type="submit" class="btn" style="background: #d32f2f;">Yes, Delete!</button>
                    <button type="button" class="btn close-delete-modal" style="background: #757575;">Cancel, Keep it.</button>
                </div>
            </form>
        </div>
    </div>    <style>
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(44, 62, 80, 0.85);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: #fff;
        border-radius: 12px;
        padding: 32px 32px 24px 32px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        text-align: center;
        min-width: 320px;
        max-width: 90vw;
    }

    .modal-check {
        margin-bottom: 18px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 1rem;
        transition: border-color 0.2s;
    }

    .form-group input:focus {
        outline: none;
        border-color: #2196F3;
    }

    .form-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .btn {
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 10px 32px;
        font-size: 1.1rem;
        cursor: pointer;
        transition: opacity 0.2s;
    }

    .btn:hover {
        opacity: 0.9;
    }
    </style>

    <script>    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    // Add User Modal functionality
    const addModal = document.getElementById('addUserModal');
    const addBtn = document.getElementById('addUserBtn');
    const closeAddBtn = document.getElementsByClassName('close-modal')[0];

    addBtn.onclick = function() {
        addModal.style.display = "flex";
    }

    closeAddBtn.onclick = function() {
        closeModal('addUserModal');
    }

    // Delete modal functionality
    const deleteModal = document.getElementById('deleteModal');
    const deleteForm = document.getElementById('deleteForm');
    const deleteUserId = document.getElementById('deleteUserId');
    const closeDeleteBtn = document.getElementsByClassName('close-delete-modal')[0];

    // Handle delete button clicks
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const userId = this.dataset.id;
            const username = this.dataset.username;
            const row = this.closest('tr');
            const name = row.cells[2].textContent;
            const roleSpan = row.querySelector('.role-badge');
            
            if (roleSpan && roleSpan.textContent.trim() === 'Admin') {
                const errorModal = createErrorModal("You can't delete admin accounts.");
                document.body.appendChild(errorModal);
                setTimeout(() => errorModal.remove(), 3000);
                return;
            }
            
            const userInfo = deleteModal.querySelector('.user-info');
            userInfo.innerHTML = `<strong>${name}</strong> (${username})`;
            deleteUserId.value = userId;
            deleteModal.style.display = "flex";
        });
    });

    // Close delete modal
    closeDeleteBtn.onclick = function() {
        closeModal('deleteModal');
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
        if (event.target.classList.contains('modal-overlay')) {
            event.target.style.display = 'none';
        }
    }

    // Function to create error modal
    function createErrorModal(message) {
        const modal = document.createElement('div');
        modal.className = 'modal-overlay';
        modal.style.display = 'flex';
        modal.innerHTML = `
            <div class="modal-content">
                <img src="assets/img/Logo.png" alt="Error" class="modal-check" style="width: 80px; margin: 0 auto; display: block; filter: grayscale(1);" />
                <h2 style="text-align:center; color: #d32f2f;">Error</h2>
                <p style="text-align:center;">${message}</p>
                <button onclick="this.closest('.modal-overlay').remove()" class="btn" style="display:block; margin: 20px auto 0 auto; background: #d32f2f;">OK</button>
            </div>
        `;
        setTimeout(() => modal.remove(), 6000);
        return modal;
    }
    </script>
</body>
</html>