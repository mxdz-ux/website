<?php
require_once 'config.php';

// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    $_SESSION['error'] = "You don't have permission to perform this action.";
    redirect('index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $available_copies = isset($_POST['available_copies']) ? intval($_POST['available_copies']) : 1;
    $available = isset($_POST['available']) ? intval($_POST['available']) : 0;
    $description = trim($_POST['description'] ?? '');

    // Validate required fields
    if ($id <= 0 || $title === '' || $author === '' || $category === '' || $available_copies < 1 || $available < 0) {
        $_SESSION['error'] = "Please fill in all required fields correctly.";
        redirect("admin_edit_book.php?action=edit&id=$id");
        exit;
    }

    // Handle cover image upload if provided
    $cover_image = null;
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['cover_image']['tmp_name'];
        $name = basename($_FILES['cover_image']['name']);
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($ext, $allowed)) {
            $new_name = 'assets/img/book_' . time() . '_' . rand(1000,9999) . '.' . $ext;
            if (move_uploaded_file($tmp_name, $new_name)) {
                $cover_image = $new_name;
            }
        }
    }

    // Build update query
    $params = [$title, $author, $category, $available_copies, $available, $description, $id];
    $set = "title = ?, author = ?, category = ?, available_copies = ?, available = ?, description = ?";
    if ($cover_image) {
        $set .= ", cover_image = ?";
        $params = [$title, $author, $category, $available_copies, $available, $description, $cover_image, $id];
    }
    $sql = "UPDATE books SET $set WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        $_SESSION['success'] = "Book updated successfully.";
    } else {
        $_SESSION['error'] = "Failed to update book. Please try again.";
    }
    redirect('admin_books.php');
    exit;
} else {
    $_SESSION['error'] = "Invalid request.";
    redirect('admin_books.php');
    exit;
}
