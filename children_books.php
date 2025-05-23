<?php
session_start();
$page_title = "Children Books";
$has_reached_limit = false;
if (isset($_SESSION['user_id'])) {
    require_once 'config.php';
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM borrows br JOIN books bk ON br.book_id = bk.id WHERE br.user_id = ? AND LOWER(bk.category) = 'children' AND br.status IN ('pending', 'approved')");
    $stmt->execute([$user_id]);
    $has_reached_limit = $stmt->fetchColumn() >= 3;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Reading Club 2000</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body style="background-image: url('assets/img/back.png');">

<?php include 'navbar.php'; ?>
<header>
    <br>
    <br>
    <nav>
      <div class="container">
      <a href="catalog.php" class="modern-back-btn"><i class="fas fa-arrow-left"></i> Back</a> 
      </div>
    </nav>
  </header>

<div class="container">
    <h1 style="text-align: center; margin-bottom: 30px;">Children Books Collection</h1>
    <div class="book-grid">
           <!-- Book 1 -->
          <div class="book">
                <img src="assets/img/chil1.jpg" alt="Book Cover">
                
                <div class="details">
                    <p>Where the Wild Things Are</p>
                    <p style="font-size: 12px;">A book by Maurice Sendak</p>
                    <!-- Inside your book card HTML, add this form/button -->
<form action="borrow.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="book_id" value="77">
                    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
                </form>
                <button class="details-btn" onclick="location.href='cbookdetails.php?book_id=77'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/chil2.jfif" alt="Book Cover">
                <div class="details">
                    <p>The Very Hungry Caterpillar</p>
                    <p style="font-size: 12px;">A book by Eric Carle</p>
                    <form action="borrow.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="book_id" value="78">
                    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
                </form>
                <button class="details-btn" onclick="location.href='cbookdetails.php?book_id=78'" style="width: 100px;" >Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/chil3.jpg" alt="Book Cover">
                <div class="details">
                    <p>Goodnight Moon</p>
                    <p style="font-size: 12px;">A book by Margaret Wise Brown</p>
                    
                    <form action="borrow.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="book_id" value="79">
                    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
                </form>
                <button class="details-btn" onclick="location.href='cbookdetails.php?book_id=79'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 1 -->
            <div class="book">
                <img src="assets/img/chil4.jpg" alt="Book Cover">
                <div class="details">
                    <p>Charlotte's Web</p>
                    <p style="font-size: 12px;">A book by E.B. White</p>
                    manu
                    <form action="borrow.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="book_id" value="80">
                    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
                </form>
                <button class="details-btn" onclick="location.href='cbookdetails.php?book_id=80'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/chil5.jpg" alt="Book Cover">
                <div class="details">
                    <p>Green Eggs and Ham</p>
                    <p style="font-size: 12px;">A book by Dr. Seuss</p>
                    <form action="borrow.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="book_id" value="81">
                    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
                </form>
                <button class="details-btn" onclick="location.href='cbookdetails.php?book_id=81'" style="width: 100px;">Details</button>
                </div>
            </div>
       <!-- Book 1 -->
       <div class="book">
                <img src="assets/img/chil6.png" alt="Book Cover">
                <div class="details">
                    <p>The Cat in the Hat</p>
                    <p style="font-size: 12px;">A book by Dr. Seuss</p>
                    <form action="borrow.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="book_id" value="82">
                    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
                </form>
                <button class="details-btn" onclick="location.href='cbookdetails.php?book_id=82'" style="width: 100px;">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="assets/img/chil7.jpg" alt="Book Cover">
                <div class="details">
                    <p>Matilda</p>
                    <p style="font-size: 12px;">A book by Roald Dahl</p>
                    <form action="borrow.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="book_id" value="83">
                    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
                </form>
                <button class="details-btn" onclick="location.href='cbookdetails.php?book_id=83'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/chil8.jpg" alt="Book Cover">
                <div class="details">
                    <p>Harry Potter and the Sorcerer's Stone</p>
                    <p style="font-size: 12px;">A book by J.K. Rowling.</p>
                    <form action="borrow.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="book_id" value="84">
                    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
                </form>
                <button class="details-btn" onclick="location.href='cbookdetails.php?book_id=84'" style="width: 100px;">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="assets/img/chil9.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Gruffalo</p>
                    <p style="font-size: 12px;">A book by Julia Donaldson</p>
                    <form action="borrow.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="book_id" value="85">
                    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
                </form>
                <button class="details-btn" onclick="location.href='cbookdetails.php?book_id=85'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/chil10.jpg" alt="Book Cover">
                <div class="details">
                    <p>Don't Let the Pigeon Drive the Bus!</p>
                    <p style="font-size: 12px;">A book by Mo Willems.</p>
                    <form action="borrow.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="book_id" value="86">
                    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
                </form>
                <button class="details-btn" onclick="location.href='cbookdetails.php?book_id=86'" style="width: 100px;">Details</button>
                </div>
            </div>
             <!-- Book 1 -->
          <div class="book">
                <img src="assets/img/chil11.jpg" alt="Book Cover">
                
                <div class="details">
                    <p>Brown Bear, Brown Bear, What Do You See?</p>
                    <p style="font-size: 12px;">A novel by Bill Martin Jr.</p>
                    <!-- Inside your book card HTML, add this form/button -->
<form action="borrow.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="book_id" value="87">
                    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
                </form>
                <button class="details-btn" onclick="location.href='cbookdetails.php?book_id=87'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/chil12.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Snowy Day</p>
                    <p style="font-size: 12px;">A book by Ezra Jack Keats.</p>
                    <form action="borrow.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="book_id" value="88">
                    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
                </form>
                <button class="details-btn" onclick="location.href='cbookdetails.php?book_id=88'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/chil13.jpg" alt="Book Cover">
                <div class="details">
                    <p>Oh, the Places You'll Go!</p>
                    <p style="font-size: 12px;">A book by Dr. Seuss.</p>
                    
                    <form action="borrow.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="book_id" value="89">
                    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
                </form>
                <button class="details-btn" onclick="location.href='cbookdetails.php?book_id=89'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 1 -->
            <div class="book">
                <img src="assets/img/chil14.jpg" alt="Book Cover">
                <div class="details">
                    <p>Curious George</p>
                    <p style="font-size: 12px;">A book by H.A. Rey</p>
                    
                    <form action="borrow.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="book_id" value="90">
                    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
                </form>
                <button class="details-btn" onclick="location.href='cbookdetails.php?book_id=90'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/chil15.jpg" alt="Book Cover">
                <div class="details">
                    <p>Winnie-the-Pooh</p>
                    <p style="font-size: 12px;">A book by A.A. Milne    .</p>
                    <form action="borrow.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="book_id" value="91">
                    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
                </form>
                <button class="details-btn" onclick="location.href='cbookdetails.php?book_id=91'" style="width: 100px;">Details</button>
                </div>
            </div>
    </div>
</div>


<!-- Error Modal for Borrowing -->
<?php if (isset($_SESSION['error'])): ?>
    <div id="borrow-error-modal" class="modal-overlay" style="display: flex;">
        <div class="modal-content">
            <img src="assets/img/Logo.png" alt="Error" class="modal-check" style="width: 80px; margin: 0 auto; display: block; filter: grayscale(1);" />
            <h2 style="text-align:center; color: #d32f2f;">Sorry!</h2>
            <p style="text-align:center;">
                <?php
                    if (strpos($_SESSION['error'], 'already have a request for this book') !== false) {
                        echo 'Sorry, you already have that book in your collection';
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
        .details-link {
            text-decoration: none;
            color: #222;
            background: #ffd600;
            border: none;
            border-radius: 8px;
            padding: 10px 32px;
            font-size: 1.1rem;
            font-family: inherit;
            font-weight: 500;
            cursor: pointer;
            display: inline-block;
            transition: background 0.2s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-top: 8px;
        }
        .details-link:hover {
            background: #ffb300;
            color: #111;
            text-decoration: none;
        }
    </style>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<script src="script.js"></script>
</body>
</html>