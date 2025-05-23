<?php
session_start();
$page_title = "Educational Books";
$has_reached_limit = false;
if (isset($_SESSION['user_id'])) {
    require_once 'config.php';
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM borrows br JOIN books bk ON br.book_id = bk.id WHERE br.user_id = ? AND LOWER(bk.category) = 'educational' AND br.status IN ('pending', 'approved')");
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
    <h1 style="text-align: center; margin-bottom: 30px;">Educational Books Collection</h1>
    <div class="book-grid">
         <div class="book">
                <img src="assets/img/edu1.jpg" alt="Book Cover">
                
                <div class="details">
                    <p>Pedagogy of the Oppressed</p>
                    <p style="font-size: 12px;">A book by Paulo Freire.</p>
                    <!-- Inside your book card HTML, add this form/button -->
<form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="62">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='edudetails.php?book_id=62'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/edu2.jpg" alt="Book Cover">
                <div class="details">
                    <p>How Children Succeed</p>
                    <p style="font-size: 12px;">A book by Paul Tough</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="63">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='edudetails.php?book_id=63'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/edu3.jpg" alt="Book Cover">
                <div class="details">
                    <p>Dumbing Us Down</p>
                    <p style="font-size: 12px;">A book by John Taylor Gatto</p>
                    
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="64">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='edudetails.php?book_id=64'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 1 -->
            <div class="book">
                <img src="assets/img/edu4.jpg" alt="Book Cover">
                <div class="details">
                    <p>Free to Learn</p>
                    <p style="font-size: 12px;">A book by Peter Gray.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="65">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='edudetails.php?book_id=65'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/edu5.jpg" alt="Book Cover">
                <div class="details">
                    <p>Left Back</p>
                    <p style="font-size: 12px;">A book by Diane Ravitch.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="66">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='edudetails.php?book_id=66'" style="width: 100px;">Details</button>
                </div>
            </div>
       <!-- Book 1 -->
       <div class="book">
                <img src="assets/img/edu6.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Smartest Kids in the World</p>
                    <p style="font-size: 12px;">A book by Amanda Ripley.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="67">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='edudetails.php?book_id=67'" style="width: 100px;">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="assets/img/edu7.jpg" alt="Book Cover">
                <div class="details">
                    <p>Education for Extinction</p>
                    <p style="font-size: 12px;">A book by David Wallace Adams.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="68">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='edudetails.php?book_id=68'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/edu8.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Education of Blacks in the South</p>
                    <p style="font-size: 12px;">A book by James D. Anderson.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="69">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='edudetails.php?book_id=69'" style="width: 100px;">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="assets/img/edu9.jpg" alt="Book Cover">
                <div class="details">
                    <p>Advanced Composition for ESL Students</p>
                    <p style="font-size: 12px;">A book by Bryan Ryan.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="70">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='edudetails.php?book_id=70'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/edu10.jpg" alt="Book Cover">
                <div class="details">
                    <p>Assessing Writing Across the Curriculum</p>
                    <p style="font-size: 12px;">A book by Charles R. Duke and Rebecca Sanchez.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="71">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='edudetails.php?book_id=71'" style="width: 100px;">Details</button>
                </div>
            </div>
             <!-- Book 1 -->
          <div class="book">
                <img src="assets/img/edu11.png" alt="Book Cover">
                
                <div class="details">
                    <p>Chaos in the Classroom</p>
                    <p style="font-size: 12px;">A book by Charles R. Duke.</p>
                    <!-- Inside your book card HTML, add this form/button -->
<form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="72">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='edudetails.php?book_id=72'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/edu12.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Courage to Teach</p>
                    <p style="font-size: 12px;">A book by Parker J. Palmer.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="73">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='edudetails.php?book_id=73'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/edu13.jpg" alt="Book Cover">
                <div class="details">
                    <p>Teaching to Transgress</p>
                    <p style="font-size: 12px;">A book by Bell Hooks.</p>
                    
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="74">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='edudetails.php?book_id=74'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 1 -->
            <div class="book">
                <img src="assets/img/edu14.jpg" alt="Book Cover">
                <div class="details">
                    <p>The First Days of School</p>
                    <p style="font-size: 12px;">A book by Harry K. Wong and Rosemary T. Wong.</p>
                    
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="75">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='edudetails.php?book_id=75'" style="width: 100px;">Details</button>
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