<?php
session_start();
$page_title = "Cook Books";
$has_reached_limit = false;
if (isset($_SESSION['user_id'])) {
    require_once 'config.php';
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM borrows br JOIN books bk ON br.book_id = bk.id WHERE br.user_id = ? AND LOWER(bk.category) = 'cook' AND br.status IN ('pending', 'approved')");
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
    <h1 style="text-align: center; margin-bottom: 30px;">Cooking Books Collection</h1>
    <div class="book-grid">
           <!-- Book 1 -->
          <div class="book">
                <img src="assets/img/cook1.jpg" alt="Book Cover">
                
                <div class="details">
                    <p>Vegetable Kingdom</p>
                    <p style="font-size: 12px;">A book by Bryant Terry</p>
                    <!-- Inside your book card HTML, add this form/button -->
<form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="31">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='cookbdetails.php?book_id=31'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/cook2.jpg" alt="Book Cover">
                <div class="details">
                    <p>Win Son Presents a Taiwanese American Cookbook</p>
                    <p style="font-size: 12px;">A book by Josh Ku</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="32">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='cookbdetails.php?book_id=32'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/cook3.jpg" alt="Book Cover">
                <div class="details">
                    <p>Whole Food For Your Family</p>
                    <p style="font-size: 12px;">A book by Autumn Michaelis</p>
                    
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="33">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='cookbdetails.php?book_id=33'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 1 -->
            <div class="book">
                <img src="assets/img/cook4.jpg" alt="Book Cover">
                <div class="details">
                    <p>Home Shores</p>
                    <p style="font-size: 12px;">A book by Emily Scott.</p>
                    manu
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="34">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='cookbdetails.php?book_id=34'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/cook5.png" alt="Book Cover">
                <div class="details">
                    <p>Barbecue: Smoked & Spiced</p>
                    <p style="font-size: 12px;">A book by Levi Roots.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="35">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='cookbdetails.php?book_id=35'" style="width: 100px;">Details</button>
                </div>
            </div>
       <!-- Book 1 -->
       <div class="book">
                <img src="assets/img/cook6.jpg" alt="Book Cover">
                <div class="details">
                    <p>BUNS: Sweet and Simple Bakes</p>
                    <p style="font-size: 12px;">A book by Louise Hurst.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="36">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='cookbdetails.php?book_id=36'" style="width: 100px;">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="assets/img/cook7.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Unofficial Hocus Pocus Cookbook</p>
                    <p style="font-size: 12px;">A book by Bridget Thoreson.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="37">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='cookbdetails.php?book_id=37'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/cook8.jpg" alt="Book Cover">
                <div class="details">
                    <p>XOXO: A Cocktail Book</p>
                    <p style="font-size: 12px;">A book by Bridget Thoreson.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="38">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='cookbdetails.php?book_id=38'" style="width: 100px;">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="assets/img/cook9.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Joy of Cooking</p>
                    <p style="font-size: 12px;">A book by Irma S. Rombauer.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="39">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='cookbdetails.php?book_id=39'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/cook10.jpg" alt="Book Cover">
                <div class="details">
                    <p>How to Cook Everything Fast</p>
                    <p style="font-size: 12px;">A book by Mark Bittman.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="40">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='cookbdetails.php?book_id=40'" style="width: 100px;">Details</button>
                </div>
            </div>
             <!-- Book 1 -->
          <div class="book">
                <img src="assets/img/cook11.jpg" alt="Book Cover">
                
                <div class="details">
                    <p>Essentials of Classic Italian Cooking</p>
                    <p style="font-size: 12px;">A novel by Marcella Hazan.</p>
                    <!-- Inside your book card HTML, add this form/button -->
<form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="41">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='cookbdetails.php?book_id=41'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/cook12.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Silver Spoon</p>
                    <p style="font-size: 12px;">A book by The Silver Spoon Kitchen.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="42">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='cookbdetails.php?book_id=42'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/cook13.jpg" alt="Book Cover">
                <div class="details">
                    <p>Plenty</p>
                    <p style="font-size: 12px;">A book by Yotam Ottolenghi.</p>
                    
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="43">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='cookbdetails.php?book_id=43'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 1 -->
            <div class="book">
                <img src="assets/img/cook14.jpg" alt="Book Cover">
                <div class="details">
                    <p>Salt, Fat, Acid, Heat</p>
                    <p style="font-size: 12px;">A book by Samin Nosrat.</p>
                    
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="44">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='cookbdetails.php?book_id=44'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/cook15.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Food Lab</p>
                    <p style="font-size: 12px;">A book by J. Kenji López-Alt.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="45">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='cookbdetails.php?book_id=45'" style="width: 100px;">Details</button>
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
    </style>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<script src="script.js"></script>
</body>
</html>