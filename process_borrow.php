<?php
require 'config.php';
require 'vendor/autoload.php';  // If using Composer for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ensure the user is an admin when processing approval/rejection
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = sanitizeInput($_GET['action']);
    $borrow_id = (int) $_GET['id']; // Ensure the ID is an integer

    if ($_SESSION['is_admin'] != 1) {
        $_SESSION['error'] = "You do not have permission to perform this action.";
        header("Location: admin_requests.php");
        exit;
    }

    try {
        $pdo->beginTransaction();

        switch ($action) {
            case 'approve':
                // Get the book_id and user_id from the borrow request
                $stmt = $pdo->prepare("SELECT book_id, user_id FROM borrows WHERE id = ?");
                $stmt->execute([$borrow_id]);
                $request = $stmt->fetch(PDO::FETCH_ASSOC);
                $book_id = $request['book_id'];
                $user_id = $request['user_id'];

                // Get the category of the book being approved
                $stmt = $pdo->prepare("SELECT category FROM books WHERE id = ?");
                $stmt->execute([$book_id]);
                $category = strtolower($stmt->fetchColumn());
                // Enforce 3-book limit for all categories (approved only)
                $check = $pdo->prepare("SELECT COUNT(*) FROM borrows br JOIN books bk ON br.book_id = bk.id WHERE br.user_id = ? AND LOWER(bk.category) = ? AND br.status = 'approved'");
                $check->execute([$user_id, $category]);
                if ($check->fetchColumn() >= 3) {
                    $_SESSION['error'] = "User already has 3 approved books in this category. Cannot approve more.";
                    $pdo->rollBack();
                    header("Location: admin_requests.php");
                    exit;
                }

                // Fetch user email to validate before proceeding
                $stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
                $stmt->execute([$user_id]);
                $user_email = $stmt->fetchColumn();
                
                // Validate email existence and format
                if (!$user_email || !filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['error'] = "Cannot approve: User's email address is missing or invalid.";
                    $pdo->rollBack();
                    header("Location: admin_requests.php");
                    exit;
                }

                // Check if book has available copies
                $stmt = $pdo->prepare("SELECT available_copies FROM books WHERE id = ?");
                $stmt->execute([$book_id]);
                $copies = $stmt->fetchColumn();
            
                if ($copies <= 0) {
                    throw new Exception("No available copies left for this book.");
                }
            
                // Update the borrow request status to approved
                $stmt = $pdo->prepare("UPDATE borrows SET status = 'approved' WHERE id = ?");
                $stmt->execute([$borrow_id]);
            
                // Decrease the available_copies by 1
                $stmt = $pdo->prepare("UPDATE books SET available_copies = available_copies - 1 WHERE id = ?");
                $stmt->execute([$book_id]);

                // Prepare and send the email for approval
                if ($user_email) {
                    // Create PHPMailer instance
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'dddummyacc6969420@gmail.com'; // Your Gmail
                    $mail->Password   = 'vyfh fxlm xfpf sdvk'; // Use App Password if 2FA is enabled
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    //Recipients
                    $mail->setFrom('dddummyacc6969420@gmail.com', 'Reading Club 2000');
                    $mail->addAddress($user_email);

                    // Content
                    $mail->isHTML(false);  // Set email format to plain text
                    $mail->Subject = "Your Borrow Request has been Approved!";
                    $mail->Body    = "Dear User,\n\n" .
"Your request to borrow a book has been approved. Please bring a valid ID with you to verify your identity when you visit the library to collect your book.\n\n" .
"Pickup Details:\n" .
"Address: 1454 Balagtas, Makati, 1204 Metro Manila\n" .
"Location: Shelves 1, Right Corner\n\n" .
"Please note that your ID will be temporarily held and will only be returned once the book is returned within the designated borrowing period. Failure to return the book on time may result in the withholding of your ID until the item is returned.\n\n" .
"Best regards,\n" .
"Reading Club 2000";

                    // Send email
                    if ($mail->send()) {
                        $_SESSION['success'] = "Request approved and email sent to the user!";
                    } else {
                        $_SESSION['error'] = "Request approved, but email notification failed.";
                    }
                }

                break;

            case 'reject':
                
                $stmt = $pdo->prepare("SELECT user_id FROM borrows WHERE id = ?");
                $stmt->execute([$borrow_id]);
                $user_id = $stmt->fetchColumn();

               
                $stmt = $pdo->prepare("UPDATE borrows SET status = 'rejected' WHERE id = ?");
                $stmt->execute([$borrow_id]);

                
                $stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
                $stmt->execute([$user_id]);
                $user_email = $stmt->fetchColumn();

                
                if ($user_email) {
                   
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'dddummyacc6969420@gmail.com'; 
                    $mail->Password   = 'vyfh fxlm xfpf sdvk'; 
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    
                    $mail->setFrom('dddummyacc6969420@gmail.com', 'Reading Club 2000');
                    $mail->addAddress($user_email);

                    // Content
                    $mail->isHTML(false); 
                    $mail->Subject = "Your Borrow Request has been Rejected";
                    $mail->Body    = "Dear User,\n\nWe regret to inform you that your borrow request for the book has been rejected.\n\nBest regards,\nReading Club 2000";

                    // Send email
                    if ($mail->send()) {
                        $_SESSION['success'] = "Request rejected and email sent to the user!";
                    } else {
                        $_SESSION['error'] = "Request rejected, but email notification failed.";
                    }
                }

                break;

            case 'return':
                // Mark the book as returned
                $return_date = date('Y-m-d'); // Get the current date as the return date
                $stmt = $pdo->prepare("UPDATE borrows SET status = 'returned', return_date = ? WHERE id = ?");
                $stmt->execute([$return_date, $borrow_id]);

                // Increase the available_copies by 1
                $stmt = $pdo->prepare("SELECT book_id, user_id FROM borrows WHERE id = ?");
                $stmt->execute([$borrow_id]);
                $request = $stmt->fetch(PDO::FETCH_ASSOC);
                $book_id = $request['book_id'];
                $user_id = $request['user_id'];

                $stmt = $pdo->prepare("UPDATE books SET available_copies = available_copies + 1 WHERE id = ?");
                $stmt->execute([$book_id]);

                // Fetch user email to send the return confirmation email
                $stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
                $stmt->execute([$user_id]);
                $user_email = $stmt->fetchColumn();

                // Prepare and send the email for return
                if ($user_email) {
                    // Create PHPMailer instance
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'dddummyacc6969420@gmail.com'; // Your Gmail
                    $mail->Password   = 'vyfh fxlm xfpf sdvk'; // Use App Password if 2FA is enabled
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    //Recipients
                    $mail->setFrom('dddummyacc6969420@gmail.com', 'Reading Club 2000');
                    $mail->addAddress($user_email);

                    // Content
                    $mail->isHTML(false);  // Set email format to plain text
                    $mail->Subject = "Your Borrowed Book has been Returned!";
                    $mail->Body    = "Dear User,\n\nYour borrowed book has been successfully returned. Thank you for returning it on time.\n\nBest regards,\nReading Club 2000";

                    // Send email
                    if ($mail->send()) {
                        $_SESSION['success'] = "Book returned and email sent to the user!";
                    } else {
                        $_SESSION['error'] = "Book returned, but email notification failed.";
                    }
                }

                break;

            default:
                throw new Exception("Invalid action.");
        }

        // Commit the transaction if successful
        $pdo->commit();
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
            // Admin action: redirect back to admin_requests.php, do not set member modal
            header("Location: admin_requests.php");
            exit;
        } else {
            // User action: set modal and redirect to my_books.php
            $_SESSION['borrowed'] = 'Thank you for borrowing the book';
            header("Location: my_books.php");
            exit;
        }
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = "Error processing request: " . $e->getMessage();
        header("Location: admin_requests.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle borrow request submission for users (normal users)
    $user_id = $_SESSION['user_id'];
    $book_id = $_POST['book_id'];

    try {
        $pdo->beginTransaction();

        // Get the category of the book being requested
        $stmt = $pdo->prepare("SELECT category FROM books WHERE id = ?");
        $stmt->execute([$book_id]);
        $category = strtolower($stmt->fetchColumn());

        // Enforce 3-book limit for all categories
        $check = $pdo->prepare("SELECT COUNT(*) FROM borrows br JOIN books bk ON br.book_id = bk.id WHERE br.user_id = ? AND LOWER(bk.category) = ? AND br.status IN ('pending', 'approved')");
        $check->execute([$user_id, $category]);
        if ($check->fetchColumn() >= 3) {
            $_SESSION['error'] = "You have reached the borrowing limit of 3 books for this category. Please return some books before borrowing more.";
            $pdo->rollBack();
            header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'catalog.php'));
            exit;
        }

        // Check if the user has already requested the same book and the request is pending or approved
        $check = $pdo->prepare("SELECT COUNT(*) FROM borrows WHERE user_id = ? AND book_id = ? AND status IN ('pending', 'approved')");
        $check->execute([$user_id, $book_id]);
        if ($check->fetchColumn() > 0) {
            $_SESSION['error'] = "You already have a request for this book.";
            $pdo->rollBack();
            header("Location: catalog.php");
            exit;
        }

        // Create a borrow request with status "pending"
        $stmt = $pdo->prepare("
            INSERT INTO borrows(user_id, book_id, borrow_date, status)
            VALUES (?, ?, NOW(), 'pending')
        ");
        $stmt->execute([$user_id, $book_id]);

        $pdo->commit();        // Get the book category
        $stmt = $pdo->prepare("SELECT category FROM books WHERE id = ?");
        $stmt->execute([$book_id]);
        $category = ucfirst(strtolower($stmt->fetchColumn()));

        // Set the session variables for the thank you modal
        $_SESSION['borrowed'] = 'Thank you for borrowing the book';
        $_SESSION['borrowed_category'] = $category;
        header("Location: my_books.php");
        exit;
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = "Error submitting request: " . $e->getMessage();
    }

    header("Location: my_books.php");
    exit;
}
?>