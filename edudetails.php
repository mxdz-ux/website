<?php
session_start();
$page_title = "Educational Books";
$has_reached_limit = false;
if (isset($_SESSION['user_id'])) {
    require_once 'config.php';
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM borrows br JOIN books bk ON br.book_id = bk.id WHERE br.user_id = ? AND LOWER(bk.category) = 'children' AND br.status IN ('pending', 'approved')");
    $stmt->execute([$user_id]);
    $has_reached_limit = $stmt->fetchColumn() >= 3;
}
$page_title = "Educational Books - All Details";
include 'navbar.php';
$books = [
    [
        'id' => 62,
        'img' => 'assets/img/edu1.jpg',
        'title' => "Pedagogy of the Oppressed",
        'author' => "Paulo Freire",
        'synopsis' => "NULL"
    ],
    [
        'id' => 63,
        'img' => 'assets/img/edu2.jpg',
        'title' => "How Children Succeed",
        'author' => "Paul Tough",
        'synopsis' => "NULL"
    ],
    [
        'id' => 64,
        'img' => 'assets/img/edu3.jpg',
        'title' => "Dumbing Us Down",
        'author' => "John Taylor Gatto",
        'synopsis' => "NULL"
    ],
    [
        'id' => 65,
        'img' => 'assets/img/edu4.jpg',
        'title' => "Free to Learn",
        'author' => "Peter Gray",
        'synopsis' => "NULL"
    ],
    [
        'id' => 66,
        'img' => 'assets/img/edu5.jpg',
        'title' => "Left Back",
        'author' => "Diane Ravitch",
        'synopsis' => "NULL"
    ],
    [
        'id' => 67,
        'img' => 'assets/img/edu6.jpg',
        'title' => "The Smartest Kids in the World",
        'author' => "Amanda Ripley",
        'synopsis' => "NULL"
    ],
    [
        'id' => 68,
        'img' => 'assets/img/edu7.jpg',
        'title' => "Education for Extinction",
        'author' => "David Wallace Adams",
        'synopsis' => "NULL"
    ],
    [
        'id' => 69,
        'img' => 'assets/img/edu8.jpg',
        'title' => "The Education of Blacks in the South",
        'author' => "James D. Anderson",
        'synopsis' => "NULL"
    ],
    [
        'id' => 70,
        'img' => 'assets/img/edu9.jpg',
        'title' => "Advanced Composition for ESL Students",
        'author' => "Bryan Ryan",
        'synopsis' => "NULL"
    ],
    [
        'id' => 71,
        'img' => 'assets/img/edu10.jpg',
        'title' => "Assessing Writing Across the Curriculum",
        'author' => "Charles R. Duke and Rebecca Sanchez",
        'synopsis' => "NULL"
    ],
    [
        'id' => 72,
        'img' => 'assets/img/edu11.png',
        'title' => "Chaos in the Classroom",
        'author' => "Charles R. Duke",
        'synopsis' => "NULL"
    ],
    [
        'id' => 73,
        'img' => 'assets/img/edu12.jpg',
        'title' => "The Courage to Teach",
        'author' => "Parker J. Palmer",
        'synopsis' => "NULL"
    ],
    [
        'id' => 74,
        'img' => 'assets/img/edu13.jpg',
        'title' => "Teaching to Transgress",
        'author' => "Bell Hooks",
        'synopsis' => "NULL"
    ],
    [
        'id' => 75,
        'img' => 'assets/img/edu14.jpg',
        'title' => "The First Days of School",
        'author' => "Harry K. Wong and Rosemary T. Wong",
        'synopsis' => "NULL"
    ]
];


// Scroll to book if ?book_id=xx is set
$scrollTo = isset($_GET['book_id']) ? intval($_GET['book_id']) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    
    <style>
        .book-details-list { display: flex; flex-direction: column; gap: 32px; }
        .book-details-card { background: #fff; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.08); padding: 24px; display: flex; align-items: flex-start; gap: 24px; }
        .book-details-card img { max-width: 120px; border-radius: 8px; }
        .book-details-info { flex: 1; }
        .borrow-btn, .details-btn { margin-top: 12px; }
        .borrow-btn { background-color: #ffcc00; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
        .borrow-btn:hover { background-color: green; }
    </style>
</head>
<body style="background-image: url('assets/img/back.png');">
<div class="container">
    <br>
    <br>
    <br>
   <a href="educational_books.php" class="modern-back-btn"><i class="fas fa-arrow-left"></i> Back to Children Books</a> 
    <div class="search-container" style="margin: 20px 0;">
        <input type="text" id="searchInput" placeholder="Search by title, author, or synopsis..." style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 16px; margin-bottom: 20px;">
    </div>
    <h2 style="margin-bottom:32px;">All Educational Books - Details & Synopsis</h2>
    <div class="book-details-list">
        <?php foreach ($books as $book): 
            // Check if user already has this book
            $has_book = false;
            if (isset($_SESSION['user_id'])) {
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM borrows WHERE user_id = ? AND book_id = ? AND status IN ('pending', 'approved')");
                $stmt->execute([$_SESSION['user_id'], $book['id']]);
                $has_book = $stmt->fetchColumn() > 0;
            }
            
            // Check total copies borrowed
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM borrows WHERE book_id = ? AND status IN ('pending', 'approved')");
            $stmt->execute([$book['id']]);
            $copies_borrowed = $stmt->fetchColumn();
            $available = !$has_book && !$has_reached_limit && $copies_borrowed < 3;
        ?>
        <div class="book-details-card" id="book<?php echo $book['id']; ?>" 
             data-title="<?php echo strtolower(htmlspecialchars($book['title'])); ?>"
             data-author="<?php echo strtolower(htmlspecialchars($book['author'])); ?>"
             data-synopsis="<?php echo strtolower(htmlspecialchars($book['synopsis'])); ?>">
            <img src="<?php echo $book['img']; ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
            <div class="book-details-info">
                <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                <h5>by <?php echo htmlspecialchars($book['author']); ?></h5>
                <p><strong>Synopsis:</strong> <?php echo htmlspecialchars($book['synopsis']); ?></p>
                <div style="display: flex; align-items: center; gap: 15px; margin-top: 10px;">
                    <form action="borrow.php" method="POST" style="margin: 0;">
                        <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                        <button type="submit" class="borrow-btn" <?php if (!$available) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
                    </form>
                    <span style="padding: 5px 10px; border-radius: 5px; margin-top: 10px; <?php echo $available ? 'background-color: #4CAF50; color: white;' : 'background-color: #f44336; color: white;'; ?>">
                        <?php 
                        if ($has_book) {
                            echo 'Already borrowed';
                        } elseif ($has_reached_limit) {
                            echo 'Borrow limit reached';
                        } elseif ($copies_borrowed >= 3) {
                            echo 'No copies available';
                        } else {
                            echo 'Available';
                        }
                        ?>
                    </span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php if (isset($_SESSION['error'])): ?>
    <div id="borrow-error-modal" class="modal-overlay" style="display: flex;">
        <div class="modal-content">
            <img src="assets/img/Logo.png" alt="Error" class="modal-check" style="width: 80px; margin: 0 auto; display: block; filter: grayscale(1);" />
            <h2 style="text-align:center; color: #d32f2f;">Borrowing Limit Reached</h2>
            <p style="text-align:center;">
                <?php
                    if (strpos($_SESSION['error'], 'already have a request for this book') !== false) {
                        echo 'You already have this book in your collection';
                    } else if (strpos($_SESSION['error'], 'borrowing limit') !== false) {
                        echo 'You have reached the maximum limit of 3 books for this category. Please return some books before borrowing more.';
                    } else {
                        echo htmlspecialchars($_SESSION['error']);
                    }
                ?>
            </p>
            <button onclick="closeModal('borrow-error-modal')" class="btn" style="display:block; margin: 20px auto 0 auto; background: #d32f2f;">OK</button>
        </div>
    </div>
    <script>
        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }
        setTimeout(function() { closeModal('borrow-error-modal'); }, 6000);
    </script>
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
            background: #d32f2f;
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
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
<style>
    .search-container {
        position: sticky;
        top: 0;
        z-index: 100;
        background: transparent;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    #searchInput:focus {
        outline: 2px solid #ffcc00;
        box-shadow: 0 0 5px rgba(255, 204, 0, 0.3);
    }
</style>
<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const bookCards = document.querySelectorAll('.book-details-card');
    
    bookCards.forEach(card => {
        const title = card.getAttribute('data-title');
        const author = card.getAttribute('data-author');
        const synopsis = card.getAttribute('data-synopsis');
        
        if (title.includes(searchTerm) || author.includes(searchTerm) || synopsis.includes(searchTerm)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
});

// If a book_id is set, scroll to that book
window.onload = function() {
    var scrollTo = <?php echo $scrollTo ? $scrollTo : 'null'; ?>;
    if (scrollTo) {
        var el = document.getElementById('book' + scrollTo);
        if (el) {
            el.scrollIntoView({behavior: 'smooth', block: 'center'});
             el.style.boxShadow = '0 0 0 4px #3e2723';
        }
    }
}
</script>
</body>
</html>
