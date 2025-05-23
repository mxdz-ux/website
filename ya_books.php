<?php
session_start();


$page_title = "Young Adult Books";

// Only allow one active borrow in YA Books for this user
$has_active_ya_borrow = false;
$has_reached_limit = false;
if (isset($_SESSION['user_id'])) {
    require_once 'config.php';
    $user_id = $_SESSION['user_id'];
    // Count all YA Books with status pending or approved, matching only 'ya' category
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM borrows br JOIN books bk ON br.book_id = bk.id WHERE br.user_id = ? AND LOWER(bk.category) = 'ya' AND br.status IN ('pending', 'approved')");
    $stmt->execute([$user_id]);
    $count = (int)$stmt->fetchColumn();
    $has_reached_limit = $count >= 3;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Reading Club 2000</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
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
      </div>
    </nav>
  </header>
<div class="container">
    <h1 style="text-align: center; margin-bottom: 30px;">Young Adult Books Collection</h1>
    <div class="book-grid">
          <!-- Book 1 -->
          <div class="book">
                <img src="assets/img/ya1.jpg" alt="Book Cover">
                
                <div class="details">
                    <p>To Kill a Mockingbird</p>
                    <p style="font-size: 12px;">A novel by Harper Lee</p>
                    <!-- Inside your book card HTML, add this form/button -->
<form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="1">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=1'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/ya2.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Hunger Games</p>
                    <p style="font-size: 12px;">A fantasy novel by Suzanne Collins</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="2">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=2'" style="width: 100px;">Details</button>

                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/ya3.jpg" alt="Book Cover">
                <div class="details">
                    <p>Looking for Alaska</p>
                    <p style="font-size: 12px;">A novel by John Green</p>
                    
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="3">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=3'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 1 -->
            <div class="book">
                <img src="assets/img/ya4.jpg" alt="Book Cover">
                <div class="details">
                    <p>One Of Us is Lying</p>
                    <p style="font-size: 12px;">A novel by Karen M. Mcmanus.</p>
                    
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="4">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=4'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/ya5.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Catcher In The Rye</p>
                    <p style="font-size: 12px;">A fantasy novel by J.D Salinger.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="5">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=5'" style="width: 100px;">Details</button>
                </div>
            </div>
       <!-- Book 1 -->
       <div class="book">
                <img src="assets/img/ya6.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Outsiders</p>
                    <p style="font-size: 12px;">A fantasy novel by S.E Hinton.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="6">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=6'" style="width: 100px;">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="assets/img/ya7.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Book For Thief</p>
                    <p style="font-size: 12px;">A fantasy novel by Markus Zusak.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="7">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=7'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/book3.jpg" alt="Book Cover">
                <div class="details">
                    <p>SharePoint 2010 Branding and User Interface Design</p>
                    <p style="font-size: 12px;">A fantasy novel by Yaroslav Pentsarskyy.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="8">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=8'" style="width: 100px;">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="assets/img/ya2.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Hunger Games</p>
                    <p style="font-size: 12px;">A fantasy novel by Suzanne Collins.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="9">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=9'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/ya10.jpg" alt="Book Cover">
                <div class="details">
                    <p>Twilight</p>
                    <p style="font-size: 12px;">A fantasy novel by Stephenie Meyer.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="10">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=10'" style="width: 100px;">Details</button>
</div>
            </div>
             <!-- Book 1 -->
          <div class="book">
                <img src="assets/img/ya11.jpg" alt="Book Cover">
                
                <div class="details">
                    <p>The Lightning Thief</p>
                    <p style="font-size: 12px;">A novel by F. Rick Riordan.</p>
                    <!-- Inside your book card HTML, add this form/button -->
<form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="11">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=11'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/ya12.jpg" alt="Book Cover">
                <div class="details">
                    <p>Divergent</p>
                    <p style="font-size: 12px;">A fantasy novel by Veronica Roth.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="12">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=12'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/ya13.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Fault in Our Stars</p>
                    <p style="font-size: 12px;">A novel by John Green.</p>
                    
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="13">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=13'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 1 -->
            <div class="book">
                <img src="assets/img/ya14.jpg" alt="Book Cover">
                <div class="details">
                    <p>City of Bones</p>
                    <p style="font-size: 12px;">A novel by Cassandra Clare.</p>
                    
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="14">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=14'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/ya15.jpg" alt="Book Cover">
                <div class="details">
                    <p>Throne of Glass</p>
                    <p style="font-size: 12px;">A fantasy novel by Sarah J. Maas.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="15">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=15'" style="width: 100px;">Details</button>
                </div>
            </div>
       <!-- Book 1 -->
       <div class="book">
                <img src="assets/img/ya16.jpg" alt="Book Cover">
                <div class="details">
                    <p>Graceling</p>
                    <p style="font-size: 12px;">A fantasy novel by Kristin Cashore.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="16">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=16'" style="width: 100px;">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="assets/img/ya17.jpg" alt="Book Cover">
                <div class="details">
                    <p>Six of Crows</p>
                    <p style="font-size: 12px;">A fantasy novel by Leigh Bardugo.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="17">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=17'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/ya18.jpg" alt="Book Cover">
                <div class="details">
                    <p>Cinder</p>
                    <p style="font-size: 12px;">A fantasy novel by Marissa Meyer.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="18">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=18'" style="width: 100px;">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="assets/img/ya19.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Selection</p>
                    <p style="font-size: 12px;">A fantasy novel by Kiera Cass.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="19">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=19'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/ya20.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Giver</p>
                    <p style="font-size: 12px;">A fantasy novel by Lois Lowry.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="20">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=20'" style="width: 100px;">Details</button>
</div>
    </div>
 <!-- Book 1 -->
          <div class="book">
                <img src="assets/img/ya21.jpg" alt="Book Cover">
                
                <div class="details">
                    <p>Alanna</p>
                    <p style="font-size: 12px;">A novel by Tamora Pierce.</p>
                    <!-- Inside your book card HTML, add this form/button -->
<form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="21">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=21'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/ya22.jpg" alt="Book Cover">
                <div class="details">
                    <p>Poison Study</p>
                    <p style="font-size: 12px;">A fantasy novel by Maria V. Snyder.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="22">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=22'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/ya23.jpg" alt="Book Cover">
                <div class="details">
                    <p>Vampire Academy</p>
                    <p style="font-size: 12px;">A novel by Richelle Mead.</p>
                    
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="23">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=23'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 1 -->
            <div class="book">
                <img src="assets/img/ya24.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Golden Compass</p>
                    <p style="font-size: 12px;">A novel by F. Philip Pullman.</p>
                    
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="24">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=24'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/ya25.jpg" alt="Book Cover">
                <div class="details">
                    <p>Sabriel</p>
                    <p style="font-size: 12px;">A fantasy novel by Garth Nix.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="25">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style="background:#aaa;cursor:not-allowed;"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='yabdetails.php?book_id=25'" style="width: 100px;">Details</button>
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
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<script>
    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
    // Auto-close modals after 6 seconds
    if (document.getElementById('borrow-success-modal')) {
        setTimeout(function() { closeModal('borrow-success-modal'); }, 6000);
    }
    if (document.getElementById('borrow-error-modal')) {
        setTimeout(function() { closeModal('borrow-error-modal'); }, 6000);
    }
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
<script src="script.js"></script>
</body>
</html>