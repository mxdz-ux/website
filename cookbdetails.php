<?php
session_start();
$page_title = "Cooking Books";
$has_reached_limit = false;
if (isset($_SESSION['user_id'])) {
    require_once 'config.php';
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM borrows br JOIN books bk ON br.book_id = bk.id WHERE br.user_id = ? AND LOWER(bk.category) = 'children' AND br.status IN ('pending', 'approved')");
    $stmt->execute([$user_id]);
    $has_reached_limit = $stmt->fetchColumn() >= 3;
}
$page_title = "Cooking Books - All Details";
include 'navbar.php';
$books = [
    [
        'id' => 31,
        'img' => 'assets/img/cook1.jpg',
        'title' => "Vegetable Kingdom",
        'author' => "Bryant Terry",
        'synopsis' => "A celebration of plant-based cooking rooted in African diasporic cuisine, blending heritage, culture, and modern flavor in soulful vegan dishes."
    ],
    [
        'id' => 32,
        'img' => 'assets/img/cook2.jpg',
        'title' => "Win Son Presents a Taiwanese American Cookbook",
        'author' => "Josh Ku",
        'synopsis' => "A flavorful fusion of Taiwanese and American cuisine with personal stories from the popular Brooklyn restaurant, Win Son."
    ],
    [
        'id' => 33,
        'img' => 'assets/img/cook3.jpg',
        'title' => "Whole Food For Your Family",
        'author' => "Autumn Michaelis",
        'synopsis' => "Wholesome, budget-friendly meals for busy families, with a focus on clean eating and practical, real-life cooking solutions."
    ],
    [
        'id' => 34,
        'img' => 'assets/img/cook4.jpg',
        'title' => "Home Shores",
        'author' => "Emily Scott",
        'synopsis' => "A heartfelt cookbook inspired by life on the Cornish coast, featuring seasonal recipes and stories of comfort and community."
    ],
    [
        'id' => 35,
        'img' => 'assets/img/cook5.png',
        'title' => "Barbecue: Smoked & Spiced",
        'author' => "Levi Roots",
        'synopsis' => "A bold mix of Caribbean flavors and BBQ techniques, bringing spice and soul to outdoor cooking."
    ],
    [
        'id' => 36,
        'img' => 'assets/img/cook6.jpg',
        'title' => "BUNS: Sweet and Simple Bakes",
        'author' => "Louise Hurst",
        'synopsis' => "A comforting collection of easy-to-make bun recipes, from sticky cinnamon rolls to fruity delights, ideal for any home baker."
    ],
    [
        'id' => 37,
        'img' => 'assets/img/cook7.jpg',
        'title' => "The Unofficial Hocus Pocus Cookbook",
        'author' => "Bridget Thoreson",
        'synopsis' => "A magical tribute to the cult classic, filled with whimsical recipes perfect for Halloween and themed parties."
    ],
    [
        'id' => 38,
        'img' => 'assets/img/cook8.jpg',
        'title' => "XOXO: A Cocktail Book",
        'author' => "Bridget Thoreson",
        'synopsis' => "A chic cocktail book featuring flirty and fun drinks for parties, dates, or just a stylish night in."
    ],
    [
        'id' => 39,
        'img' => 'assets/img/cook9.jpg',
        'title' => "The Joy of Cooking",
        'author' => "Irma S. Rombauer",
        'synopsis' => "The quintessential American cookbook, offering reliable recipes and trusted kitchen wisdom for generations of home cooks."
    ],
    [
        'id' => 40,
        'img' => 'assets/img/cook10.jpg',
        'title' => "How to Cook Everything Fast",
        'author' => "Mark Bittman",
        'synopsis' => "A go-to guide for quick, flavorful meals, emphasizing efficient techniques and flexible ingredients to suit any schedule."
    ],
    [
        'id' => 41,
        'img' => 'assets/img/cook11.jpg',
        'title' => "Essentials of Classic Italian Cooking",
        'author' => "Marcella Hazan",
        'synopsis' => "The definitive source on authentic Italian cuisine, with detailed, traditional recipes and expert techniques from a culinary legend."
    ],
    [
        'id' => 42,
        'img' => 'assets/img/cook12.jpg',
        'title' => "The Silver Spoon",
        'author' => "The Silver Spoon Kitchen",
        'synopsis' => "A culinary bible of Italy, featuring over 2,000 time-honored recipes from across the country’s diverse regions and traditions."
    ],
    [
        'id' => 43,
        'img' => 'assets/img/cook13.jpg',
        'title' => "Plenty",
        'author' => "Yotam Ottolenghi",
        'synopsis' => "An innovative vegetarian cookbook that uses bold spices and Mediterranean flair to transform vegetables into stunning main dishes."
    ],
    [
        'id' => 44,
        'img' => 'assets/img/cook14.jpg',
        'title' => "Salt, Fat, Acid, Heat",
        'author' => "Samin Nosrat",
        'synopsis' => "A masterclass in cooking fundamentals, teaching how to balance key elements to elevate flavor and master any dish."
    ],
    [
        'id' => 45,
        'img' => 'assets/img/cook15.jpg', // You can update this with the correct image if needed
        'title' => "The Food Lab",
        'author' => "J. Kenji López-Alt",
        'synopsis' => "A science-driven approach to cooking, offering tested recipes and techniques to make everyday meals exceptionally delicious."
    ],
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
   <a href="cook_books.php" class="modern-back-btn"><i class="fas fa-arrow-left"></i> Back to Children Books</a> 
    <div class="search-container" style="margin: 20px 0;">
        <input type="text" id="searchInput" placeholder="Search by title, author, or synopsis..." style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 16px; margin-bottom: 20px;">
    </div>
    <h2 style="margin-bottom:32px;">All Cooking Books - Details & Synopsis</h2>
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
