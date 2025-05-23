<?php
require_once 'config.php';

// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    $_SESSION['error'] = "You don't have permission to perform this action.";
    redirect('index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    $book_id = intval($_POST['book_id']);
    if ($book_id > 0) {
        // Optionally, check for borrows before deleting
        try {
            // Delete the book
            $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
            $stmt->execute([$book_id]);
            $_SESSION['success'] = "Book deleted successfully.";
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error deleting book: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Invalid book ID.";
    }
} else {
    $_SESSION['error'] = "Invalid request.";
}

redirect('admin_books.php');
exit;
