<?php
// unset_approved.php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id']) && $_POST['book_id'] !== '') {
    $book_id = $_POST['book_id'];
    if (!isset($_SESSION['approved_shown_books'])) {
        $_SESSION['approved_shown_books'] = [];
    }
    if (!in_array($book_id, $_SESSION['approved_shown_books'])) {
        $_SESSION['approved_shown_books'][] = $book_id;
    }
    unset($_SESSION['approved']);
    unset($_SESSION['approved_book_id']);
    unset($_SESSION['approved_book_title']);
    echo 'OK';
    exit;
}
echo 'NO';
