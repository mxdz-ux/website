<?php
session_start();
$page_title = "Programming Books";
$has_reached_limit = false;
if (isset($_SESSION['user_id'])) {
    require_once 'config.php';
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM borrows br JOIN books bk ON br.book_id = bk.id WHERE br.user_id = ? AND LOWER(bk.category) = 'programming' AND br.status IN ('pending', 'approved')");
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
    <h1 style="text-align: center; margin-bottom: 30px;">Programming Books Collection</h1>
    <div class="book-grid">
          <div class="book">
                <img src="assets/img/prog1.jpg" alt="Book Cover">
                
                <div class="details">
                    <p>The Mythical Man-Month</p>
                    <p style="font-size: 12px;">A book by Frederick P. Brooks Jr.</p>
                    <!-- Inside your book card HTML, add this form/button -->
<form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="46">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='progb.php?book_id=46'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/prog2.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Pragmatic Programmer</p>
                    <p style="font-size: 12px;">A book by Andrew Hunt and David Thomas</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="47">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='progb.php?book_id=47'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/prog3.jpg" alt="Book Cover">
                <div class="details">
                    <p>Clean Code</p>
                    <p style="font-size: 12px;">A book by Robert C. Martin</p>
                    
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="48">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='progb.php?book_id=48'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 1 -->
            <div class="book">
                <img src="assets/img/prog4.jpg" alt="Book Cover">
                <div class="details">
                    <p>The Art of Computer Programming</p>
                    <p style="font-size: 12px;">A book by Donald Knuth.</p>
                    manu
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="49">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='progb.php?book_id=49'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/prog5.jpg" alt="Book Cover">
                <div class="details">
                    <p>Structure and Interpretation of Computer Programs</p>
                    <p style="font-size: 12px;">A book by Harold Abelson and Gerald Jay Sussman.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="50">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='progb.php?book_id=50'" style="width: 100px;">Details</button>
                </div>
            </div>
       <!-- Book 1 -->
       <div class="book">
                <img src="assets/img/prog6.jpg" alt="Book Cover">
                <div class="details">
                    <p>Design Patterns</p>
                    <p style="font-size: 12px;">A book by Erich Gamma, Richard Helm, Ralph Johnson, John Vlissides.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="51">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='progb.php?book_id=51'" style="width: 100px;">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="assets/img/prog7.jpg" alt="Book Cover">
                <div class="details">
                    <p>Code Complete</p>
                    <p style="font-size: 12px;">A book by Steve McConnell.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="52">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='progb.php?book_id=52'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/prog8.jpg" alt="Book Cover">
                <div class="details">
                    <p>Refactoring</p>
                    <p style="font-size: 12px;">A book by Martin Fowler.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="53">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='progb.php?book_id=53'" style="width: 100px;">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="assets/img/prog9.jpg" alt="Book Cover">
                <div class="details">
                    <p>Working Effectively with Legacy Code</p>
                    <p style="font-size: 12px;">A book by Michael Feathers.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="54">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='progb.php?book_id=54'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/prog10.jpg" alt="Book Cover">
                <div class="details">
                    <p>You Don't Know JS</p>
                    <p style="font-size: 12px;">A book by Kyle Simpson.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="55">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='progb.php?book_id=55'" style="width: 100px;">Details</button>
                </div>
            </div>
             <!-- Book 1 -->
          <div class="book">
                <img src="assets/img/prog11.jpg" alt="Book Cover">
                
                <div class="details">
                    <p>Eloquent JavaScript</p>
                    <p style="font-size: 12px;">A book by Marijn Haverbeken.</p>
                    <!-- Inside your book card HTML, add this form/button -->
<form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="56">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='progb.php?book_id=56'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/prog12.jpg" alt="Book Cover">
                <div class="details">
                    <p>JavaScript: The Good Parts</p>
                    <p style="font-size: 12px;">A book by Douglas Crockford.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="57">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='progb.php?book_id=57'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 3 -->
            <div class="book">
                <img src="assets/img/prog13.jpg" alt="Book Cover">
                <div class="details">
                    <p>Python Crash Course</p>
                    <p style="font-size: 12px;">A book by Eric Matthes.</p>
                    
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="58">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='progb.php?book_id=58'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 1 -->
            <div class="book">
                <img src="assets/img/prog14.jpg" alt="Book Cover">
                <div class="details">
                    <p>Automate the Boring Stuff with Python</p>
                    <p style="font-size: 12px;">A book by Al Sweigart.</p>
                    
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="59">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='progb.php?book_id=59'" style="width: 100px;">Details</button>
                </div>
            </div>
            <!-- Book 2 -->
            <div class="book">
                <img src="assets/img/prog15.jpg" alt="Book Cover">
                <div class="details">
                    <p>Learn Python the Hard Way</p>
                    <p style="font-size: 12px;">A book by Zed A. Shaw.</p>
                    <form action="borrow.php" method="POST">
    <input type="hidden" name="book_id" value="60">
    <button type="submit" class="borrow-btn" <?php if ($has_reached_limit) echo 'disabled style=\"background:#aaa;cursor:not-allowed;\"'; ?>>Borrow</button>
</form>
<button class="details-btn" onclick="location.href='progb.php?book_id=60'" style="width: 100px;">Details</button>
                </div>
            </div>
    </div>
</div>>

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