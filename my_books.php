<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Get user's borrowed books with proper error handling
try {    $stmt = $pdo->prepare("
        SELECT b.id as book_id, b.title, b.author, b.cover_image, b.category,
               br.id as borrow_id, br.borrow_date, br.due_date, 
               br.return_date, br.status, br.admin_note
        FROM borrows br
        JOIN books b ON br.book_id = b.id
        WHERE br.user_id = ?
        ORDER BY 
            CASE WHEN br.status = 'approved' THEN 0 
                 WHEN br.status = 'pending' THEN 1
                 ELSE 2 END,
            br.due_date
    ");
    $stmt->execute([$user_id]);
    $borrowed_books = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $_SESSION['error'] = "Database error: " . $e->getMessage();
    $borrowed_books = [];
}

// Ensure $filtered_books is always defined as an array
$filtered_books = $borrowed_books ?? [];

// --- BEGIN: Approval Modal Logic ---
// Create a persistent cookie to track shown approval notifications
$shownApprovals = [];
if (isset($_COOKIE['shown_approvals'])) {
    $shownApprovals = json_decode($_COOKIE['shown_approvals'], true) ?: [];
}

// Check if we have a modal dismissal request - this is needed to handle when the user clicks OK
if (isset($_GET['dismiss_approval']) && !empty($_GET['dismiss_approval'])) {
    $bookId = (int)$_GET['dismiss_approval'];
    if (!in_array($bookId, $shownApprovals)) {
        $shownApprovals[] = $bookId;
        setcookie('shown_approvals', json_encode($shownApprovals), time() + (86400 * 30), "/");
    }
    // Redirect to the same page without the query parameter to prevent resubmission on refresh
    $redirectUrl = strtok($_SERVER["REQUEST_URI"], '?');
    header("Location: $redirectUrl");
    exit;
}

$showApprovedModal = false;
$approvedBookId = null;
$approvedBookTitle = '';

// Check for newly approved books not already shown
foreach ($borrowed_books as $book) {
    // Only show notification if:
    // 1. Status is approved
    // 2. Not already in shown_approvals cookie
    if (strtolower($book['status']) === 'approved' && !in_array($book['book_id'], $shownApprovals)) {
        $showApprovedModal = true;
        $approvedBookId = $book['book_id'];
        $approvedBookTitle = $book['title'];
        break;
    }
}
// --- END: Approval Modal Logic ---

// Set a PHP variable for JS and modal logic
$showBorrowedModal = isset($_SESSION['borrowed']) && $_SESSION['borrowed'] === 'Thank you for borrowing the book';
$showReturnSuccessModal = isset($_SESSION['return_success']);
$showProfileEditSuccessModal = isset($_SESSION['success']) && $_SESSION['success'] === 'Profile updated successfully!';

// Only show books that are not returned or rejected
$filtered_books = array_filter($filtered_books, function($book) {
    return !in_array(strtolower($book['status']), ['returned', 'rejected']);
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Books</title>
    <link rel="stylesheet" href="assets/css/mybooks.css">
    
    <style>
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(44, 62, 80, 0.85);
            z-index: 9999;
            display: flex;
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
        .btn {
            background: #43c05a;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 32px;
            font-size: 1.1rem;
            cursor: pointer;
        }
        .btn:hover {
            background: #2e9442;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="profile-wrapper">
        <aside class="profile-sidebar">
            <div class="profile-avatar">
                <img src="assets/img/avatar-icon.png" alt="User Avatar">
            </div>
            <div class="profile-user-info">
                <h2><?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></h2>
                <span class="profile-email"><?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?></span>
            </div>
            <nav class="profile-nav">
                <ul>
                    <li id="borrowed-tab" class="active">Borrowed Books</li>
                    <li id="profile-tab">Profile</li>
                    <li><a href="logout.php" class="profile-logout">Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="profile-main">
            <div class="profile-header">
                <h1>Profile</h1>
            </div>
            <div id="profile-view">
                <div class="profile-info-view minimalist-profile_info">
                    <div class="profile-info-row"><span class="profile-info-label">Username:</span> <span class="profile-info-value"><?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?></span></div>
                    <div class="profile-info-row"><span class="profile-info-label">Email:</span> <span class="profile-info-value"><?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?></span></div>
                    <button id="edit-profile-btn" class="btn profile-save-btn" style="width:180px;margin-top:18px;">Edit Profile</button>
                </div>
            </div>
            <form id="profile-edit-form" class="profile-form" action="update_profile.php" method="POST" style="display:none;">
                <div class="form-row">
                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>" required>
                </div>
                <div class="form-row">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>" required>
                </div>
                <div class="form-row">
                    <button type="submit" class="btn profile-save-btn">Save Changes</button>
                </div>
            </form>
            <div id="borrowed-books-section" class="profile-section borrowed-books-section" style="display:none;">
                <h2>Borrowed Books</h2>
                <input type="text" id="borrowed-search" placeholder="Search by title..." style="width: 100%; max-width: 350px; margin-bottom: 18px; padding: 8px 14px; border-radius: 6px; border: 1px solid #ccc; font-size: 1rem;">
                <div class="book-grid">
                    <?php foreach ($filtered_books as $book): ?>
                        <div class="book-card" data-title="<?php echo htmlspecialchars(strtolower($book['title'])); ?>">
                            <?php if (!empty($book['cover_image'])): ?>
                                <img src="<?php echo htmlspecialchars($book['cover_image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" class="book-cover">
                            <?php endif; ?>                            <div class="book-details">
                                <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                                <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                                <p><strong>Category:</strong> <?php echo htmlspecialchars(ucfirst($book['category'])); ?></p>
                                <p><strong>Status:</strong> <span class="status-<?php echo strtolower($book['status']); ?>"><?php echo ucfirst($book['status']); ?></span></p>
                                <p><strong>Due Date:</strong> <?php echo date('M j, Y', strtotime($book['due_date'])); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
    </div>

    <!-- Generic Success Modal -->
    <?php if (isset($_SESSION['success']) && $_SESSION['success'] !== 'Profile updated successfully!'): ?>
    <div id="success-modal" class="modal-overlay" style="display: flex;">
        <div class="modal-content">
            <img src="assets/img/Logo.png" alt="Success" class="modal-check" style="width: 80px; margin: 0 auto; display: block;" />
            <h2 style="text-align:center;">Thank You!</h2>
            <p style="text-align:center;">
                <?php echo htmlspecialchars($_SESSION['success']); ?>
            </p>
            <button onclick="closeAndClearModal('success-modal', 'success')" class="btn" style="display:block; margin: 20px auto 0 auto;">OK</button>
        </div>
    </div>
    <?php endif; ?>

    <!-- Return Success Modal -->
    <?php if ($showReturnSuccessModal): ?>
    <div id="return-success-modal" class="modal-overlay" style="display: flex;">
        <div class="modal-content">
            <img src="assets/img/Logo.png" alt="Success" class="modal-check" style="width: 80px; margin: 0 auto; display: block;" />
            <h2 style="text-align:center;">Thank You!</h2>
            <p style="text-align:center;">
                Thank you for returning the book, come by again.
            </p>
            <button onclick="closeAndClearModal('return-success-modal', 'return_success')" class="btn" style="display:block; margin: 20px auto 0 auto;">OK</button>
        </div>
    </div>
    <?php endif; ?>

    <!-- Approved Book Modal - Only closes when user clicks OK -->
    <?php if ($showApprovedModal && $approvedBookId && $approvedBookTitle): ?>
    <div id="borrow-approved-modal" class="modal-overlay" style="display: flex;">
        <div class="modal-content">
            <img src="assets/img/Logo.png" alt="Approved" class="modal-check" style="width: 80px; margin: 0 auto; display: block;" />
            <strong><h2 style="text-align:center;">Borrow Approved!</h2></strong>
            <p style="text-align:center;">
                Your borrow request for "<b><?php echo htmlspecialchars($approvedBookTitle); ?></b>" has been approved by the admin. Please check your email for more details.
            </p>
            <button onclick="markApprovalSeen('borrow-approved-modal', <?php echo $approvedBookId; ?>)" class="btn" style="display:block; margin: 20px auto 0 auto;">OK</button>
        </div>
    </div>
    <?php endif; ?>

    <!-- Profile Edit Success Modal -->
    <?php if ($showProfileEditSuccessModal): ?>
    <div id="profile-edit-success-modal" class="modal-overlay" style="display: flex;">
        <div class="modal-content">
            <img src="assets/img/Logo.png" alt="Success" class="modal-check" style="width: 80px; margin: 0 auto; display: block;" />
            <strong><h2 style="text-align:center;">Profile Updated!</h2></strong>
            <p style="text-align:center;">
                You successfully edited your profile.
            </p>
            <button onclick="closeAndClearModal('profile-edit-success-modal', 'success')" class="btn" style="display:block; margin: 20px auto 0 auto;">OK</button>
        </div>
    </div>
    <?php endif; ?>    <!-- Thank You Modal for Borrowing Book -->
    <?php if ($showBorrowedModal): ?>
    <div id="borrow-thankyou-modal" class="modal-overlay" style="display: flex;">
        <div class="modal-content">
            <img src="assets/img/Logo.png" alt="Thank You" class="modal-check" style="width: 80px; margin: 0 auto; display: block;" />
            <strong><h2 style="text-align:center;">Thank You!</h2></strong>
            <p style="text-align:center;">
                Your request to borrow a book from the <?php echo htmlspecialchars($_SESSION['borrowed_category'] ?? ''); ?> category has been submitted. Check your email for updates.
            </p>
            <button onclick="closeAndClearModal('borrow-thankyou-modal', 'borrowed')" class="btn" style="display:block; margin: 20px auto 0 auto;">OK</button>
        </div>
    </div>
    <?php endif; ?>

    <script>
        // Function to close modals and clear associated session variables via AJAX
        function closeAndClearModal(modalId, sessionVar) {
            document.getElementById(modalId).style.display = 'none';
            
            // Use fetch API to clear the session variable
            fetch('clear_session.php?var=' + sessionVar, {
                method: 'GET',
            });
        }

        // Function to handle approval notifications - redirects to dismiss
        function markApprovalSeen(modalId, bookId) {
            // Redirect to the same page with a dismiss parameter
            window.location.href = window.location.pathname + '?dismiss_approval=' + bookId;
        }
        
        // Helper function to get cookie value
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        // Regular modal close function (for modals that don't need session clearing)
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Set auto-close timers for non-approval modals only
        document.addEventListener('DOMContentLoaded', function() {
            const modals = [
                'success-modal', 
                'return-success-modal', 
                'profile-edit-success-modal', 
                'borrow-thankyou-modal'
            ];
            
            // Auto-close timer for all modals EXCEPT the approval modal
            modals.forEach(function(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    setTimeout(function() {
                        modal.style.display = 'none';
                    }, 6000);
                }
            });
            
            // No auto-close for approval modal - it must be closed by user clicking OK
        });

        const profileTab = document.getElementById('profile-tab');
        const borrowedTab = document.getElementById('borrowed-tab');
        const profileView = document.getElementById('profile-view');
        const profileEditForm = document.getElementById('profile-edit-form');
        const borrowedSection = document.getElementById('borrowed-books-section');
        const editBtn = document.getElementById('edit-profile-btn');

        window.addEventListener('DOMContentLoaded', function() {
            let showBorrowed = <?php echo ($showBorrowedModal || $showApprovedModal || $showReturnSuccessModal) ? 'true' : 'false'; ?>;
            if (showBorrowed) {
                profileTab.classList.remove('active');
                borrowedTab.classList.add('active');
                profileView.style.display = 'none';
                profileEditForm.style.display = 'none';
                borrowedSection.style.display = '';
            } else {
                profileTab.classList.add('active');
                borrowedTab.classList.remove('active');
                profileView.style.display = '';
                profileEditForm.style.display = 'none';
                borrowedSection.style.display = 'none';
            }
            
            profileTab.onclick = function() {
                profileTab.classList.add('active');
                borrowedTab.classList.remove('active');
                profileView.style.display = '';
                profileEditForm.style.display = 'none';
                borrowedSection.style.display = 'none';
            };
            
            borrowedTab.onclick = function() {
                profileTab.classList.remove('active');
                borrowedTab.classList.add('active');
                profileView.style.display = 'none';
                profileEditForm.style.display = 'none';
                borrowedSection.style.display = '';
            };
            
            if (editBtn) {
                editBtn.onclick = function() {
                    profileTab.classList.remove('active');
                    borrowedTab.classList.remove('active');
                    profileView.style.display = 'none';
                    profileEditForm.style.display = '';
                    borrowedSection.style.display = 'none';
                };
            }
        });

        // Borrowed Books search engine
        const borrowedSearch = document.getElementById('borrowed-search');
        if (borrowedSearch) {
            borrowedSearch.addEventListener('input', function() {
                const query = this.value.trim().toLowerCase();
                document.querySelectorAll('#borrowed-books-section .book-card').forEach(function(card) {
                    const title = card.getAttribute('data-title') || '';
                    card.style.display = title.includes(query) ? '' : 'none';
                });
            });
        }
    </script>

    <?php
    // Unset session variables to prevent them from showing again on refresh
    unset($_SESSION['success']);
    unset($_SESSION['borrowed']);
    unset($_SESSION['return_success']);
    ?>
</body>
</html>