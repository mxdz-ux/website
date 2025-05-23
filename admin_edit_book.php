<?php
// admin_book_action.php
require_once 'config.php';

// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    $_SESSION['error'] = "You don't have permission to access this page.";
    redirect('index.php');
    exit;
}

// Get book ID and action from query
$book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$action = isset($_GET['action']) ? trim($_GET['action']) : '';

if ($book_id <= 0 || !in_array($action, ['view', 'edit', 'delete'])) {
    $_SESSION['error'] = "Invalid book action request.";
    redirect('admin_books.php');
    exit;
}

// Fetch book info
$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$book_id]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$book) {
    $_SESSION['error'] = "Book not found.";
    redirect('admin_books.php');
    exit;
}

if ($action === 'view') {
    // Show book details in a modern card style
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Book Details - <?php echo htmlspecialchars($book['title']); ?></title>
        <link rel="stylesheet" href="assets/css/edit.css">
        <style>
            
        </style>
       
    </head>
    <body>
        <button class="modern-back-btn" onclick="window.location.href='admin_books.php'">
            <span class="arrow">&#x2039;</span> Back
        </button>
        <div class="book-details-modern">
            <div class="top-bar">Book Details
                <button class="back-btn" onclick="window.location.href='admin_books.php'" title="Back"><span>&larr;</span></button>
                <button class="share-btn" onclick="navigator.share ? navigator.share({title: document.title, url: window.location.href}) : alert('Share not supported');" title="Share"><span>&#x1F517;</span></button>
            </div>
            <?php if (!empty($book['cover_image'])): ?>
                <img src="<?php echo htmlspecialchars($book['cover_image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" class="book-cover">
            <?php else: ?>
                <img src="assets/img/Logo.png" alt="No Cover" class="book-cover">
            <?php endif; ?>
            <div class="book-title"><?php echo htmlspecialchars($book['title']); ?></div>
            <div class="book-author"><?php echo htmlspecialchars($book['author']); ?></div>
        </div>
    </body>
    </html>
    <?php
    exit;
} elseif ($action === 'edit') {
    // Show edit form for the book
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Book - <?php echo htmlspecialchars($book['title']); ?></title>
        <link rel="stylesheet" href="assets/css/edit.css">
    </head>
    <body>
        <div class="admin-container">
            <h2>Edit Book</h2>
            <a href="admin_books.php" class="btn btn-secondary">Back to Books</a>
            <div class="book-details-view">
                <form action="process_edit_book.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                    <div class="form-group">
                        <label for="title">Title*</label>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="author">Author*</label>
                        <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category*</label>
                        <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($book['category']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="available_copies">Total Copies*</label>
                        <input type="number" id="available_copies" name="available_copies" min="1" value="<?php echo htmlspecialchars($book['available']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="available">Available*</label>
                        <input type="number" id="available" name="available" min="0" value="<?php echo htmlspecialchars($book['available']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4"><?php echo htmlspecialchars($book['description']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="cover_image">Cover Image</label>
                        <input type="file" id="cover_image" name="cover_image" accept="image/*">
                        <?php if (!empty($book['cover_image'])): ?>
                            <img src="<?php echo htmlspecialchars($book['cover_image']); ?>" alt="Current Cover" style="max-width:80px; display:block; margin-top:8px;">
                        <?php endif; ?>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
} elseif ($action === 'delete') {
    // Redirect to delete confirmation (modal is handled in admin_books.php)
    $_SESSION['delete_book_id'] = $book_id;
    $_SESSION['delete_book_title'] = $book['title'];
    redirect('admin_books.php#deleteModal');
    exit;
} else {
    $_SESSION['error'] = "Unknown action.";
    redirect('admin_books.php');
    exit;
}
