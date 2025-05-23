<?php
session_start();
$page_title = "Ya Books";
$has_reached_limit = false;
if (isset($_SESSION['user_id'])) {
    require_once 'config.php';
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM borrows br JOIN books bk ON br.book_id = bk.id WHERE br.user_id = ? AND LOWER(bk.category) = 'children' AND br.status IN ('pending', 'approved')");
    $stmt->execute([$user_id]);
    $has_reached_limit = $stmt->fetchColumn() >= 3;
}
$page_title = "YA Books - All Details";
include 'navbar.php';
$books = [
    [
        'id' => 1,
        'img' => 'assets/img/ya1.jpg',
        'title' => "To Kill a Mockingbird",
        'author' => "Harper Lee",
        'synopsis' => "A profound novel that explores racial injustice and childhood innocence in the Deep South."
    ],
    [
        'id' => 2,
        'img' => 'assets/img/ya2.jpg',
        'title' => "The Hunger Games",
        'author' => "Suzanne Collins",
        'synopsis' => "In a dystopian world, Katniss Everdeen volunteers to fight in a televised death match to save her sister."
    ],
    [
        'id' => 3,
        'img' => 'assets/img/ya3.jpg',
        'title' => "Looking For Alaska",
        'author' => "John Green",
        'synopsis' => "A coming-of-age story about love, loss, and finding meaning in life’s chaos."
    ],
    [
        'id' => 4,
        'img' => 'assets/img/ya4.jpg',
        'title' => "One Of Us is Lying",
        'author' => "Karen M. Mcmanus",
        'synopsis' => "Five students walk into detention, but only four come out alive."
    ],
    [
        'id' => 5,
        'img' => 'assets/img/ya5.jpg',
        'title' => "The Catcher In The Rye",
        'author' => "J.D Salinger",
        'synopsis' => "Holden Caulfield narrates a few days in his life, revealing his deep alienation and disillusionment."
    ],
    [
        'id' => 6,
        'img' => 'assets/img/ya6.jpg',
        'title' => "The Outsiders",
        'author' => "S.E Hinton",
        'synopsis' => "A tale of teenage gangs, loyalty, and identity in a divided society."
    ],
    [
        'id' => 7,
        'img' => 'assets/img/ya7.jpg',
        'title' => "The Book Thief",
        'author' => "Markus Zusak",
        'synopsis' => "Narrated by Death, a girl steals books and shares them during WWII in Nazi Germany."
    ],
    [
        'id' => 8,
        'img' => 'assets/img/book3.jpg',
        'title' => "SharePoint 2010 Branding and User Interface Design",
        'author' => "Yaroslav Pentsarskyy",
        'synopsis' => "A technical guide to customizing SharePoint for a more user-friendly and attractive UI."
    ],
    [
        'id' => 9,
        'img' => 'assets/img/ya2.jpg',
        'title' => "The Hunger Games",
        'author' => "Suzanne Collins",
        'synopsis' => "Repetition: Katniss enters a deadly arena to fight for survival in a brutal dystopia."
    ],
    [
        'id' => 10,
        'img' => 'assets/img/ya10.jpg',
        'title' => "Twilight",
        'author' => "Stephenie Meyer",
        'synopsis' => "A teenage girl falls in love with a vampire, changing her life forever."
    ],
    [
        'id' => 11,
        'img' => 'assets/img/ya11.jpg',
        'title' => "The Lightning Thief",
        'author' => "Rick Riordan",
        'synopsis' => "Percy Jackson discovers he’s a demigod and embarks on a quest to prevent war among gods."
    ],
    [
        'id' => 12,
        'img' => 'assets/img/ya12.jpg',
        'title' => "Divergent",
        'author' => "Veronica Roth",
        'synopsis' => "In a divided society, Tris Prior discovers she doesn’t fit any faction—and that’s dangerous."
    ],
    [
        'id' => 13,
        'img' => 'assets/img/ya13.jpg',
        'title' => "The Fault in Our Stars",
        'author' => "John Green",
        'synopsis' => "Two teens with cancer fall in love and grapple with love, loss, and legacy."
    ],
    [
        'id' => 14,
        'img' => 'assets/img/ya14.jpg',
        'title' => "City of Bones",
        'author' => "Cassandra Clare",
        'synopsis' => "Clary Fray discovers a hidden world of Shadowhunters fighting demons in modern NYC."
    ],
    [
        'id' => 15,
        'img' => 'assets/img/ya15.jpg',
        'title' => "Throne of Glass",
        'author' => "Sarah J. Maas",
        'synopsis' => "An assassin must win a deadly competition to gain her freedom in a magical kingdom."
    ],
    [
        'id' => 16,
        'img' => 'assets/img/ya16.jpg',
        'title' => "Graceling",
        'author' => "Kristin Cashore",
        'synopsis' => "Katsa’s extraordinary fighting Grace leads her to uncover political intrigue and truth."
    ],
    [
        'id' => 17,
        'img' => 'assets/img/ya17.jpg',
        'title' => "Six of Crows",
        'author' => "Leigh Bardugo",
        'synopsis' => "A crew of outcasts attempts an impossible heist in a gritty fantasy world."
    ],
    [
        'id' => 18,
        'img' => 'assets/img/ya18.jpg',
        'title' => "Cinder",
        'author' => "Marissa Meyer",
        'synopsis' => "A sci-fi Cinderella retelling with a cyborg mechanic and a deadly plague."
    ],
    [
        'id' => 19,
        'img' => 'assets/img/ya19.jpg',
        'title' => "The Selection",
        'author' => "Kiera Cass",
        'synopsis' => "A girl competes for a prince’s heart in a televised royal contest."
    ],
    [
        'id' => 20,
        'img' => 'assets/img/ya20.jpg',
        'title' => "The Giver",
        'author' => "Lois Lowry",
        'synopsis' => "Jonas lives in a colorless society until he learns about real emotions and choices."
    ],
    [
        'id' => 22,
        'img' => 'assets/img/ya22.jpg',
        'title' => "Poison Study",
        'author' => "Maria V. Snyder",
        'synopsis' => "A condemned prisoner becomes a poison taster for a powerful ruler."
    ],
    [
        'id' => 23,
        'img' => 'assets/img/ya23.jpg',
        'title' => "Vampire Academy",
        'author' => "Richelle Mead",
        'synopsis' => "Two best friends navigate love, danger, and secrets at a vampire boarding school."
    ],
    [
        'id' => 24,
        'img' => 'assets/img/ya24.jpg',
        'title' => "The Golden Compass",
        'author' => "Philip Pullman",
        'synopsis' => "Lyra journeys to the Arctic to save kidnapped children and uncover a cosmic mystery."
    ],
    [
        'id' => 25,
        'img' => 'assets/img/ya25.jpg',
        'title' => "Sabriel",
        'author' => "Garth Nix",
        'synopsis' => "A young necromancer ventures beyond death to rescue her father and battle evil."
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
   <a href="ya_books.php" class="modern-back-btn"><i class="fas fa-arrow-left"></i> Back to Children Books</a> 
    <div class="search-container" style="margin: 20px 0;">
        <input type="text" id="searchInput" placeholder="Search by title, author, or synopsis..." style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 16px; margin-bottom: 20px;">
    </div>
    <h2 style="margin-bottom:32px;">All Young Adult Books - Details & Synopsis</h2>
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
        background: rgba(255, 255, 255, 0.9);
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
