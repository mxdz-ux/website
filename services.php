<?php
// Start session for user tracking
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
</head>
<body style="background-image: url(assets/img/back.png);">

<?php include 'navbar.php'; ?>

    <!--this is our Services Section -->
    <section id="services" class="containerss mt-5 pt-5">
        <h2 class="our">Our Services</h2>
        <p class="text-centers">Explore the wide range of services we offer to the community.</p>

        <div class="service-grid">
            <div class="service-box">
                <img src="assets/img/lending.jpg" alt="Book Lending" class="img-fluid mb-3">
                <div class="service-content">
                    <h2>Book Lending</h2>
                    <p>We offer an extensive collection of books for all ages, available for borrowing. Come visit and explore a world of knowledge.</p>
                </div>
            </div>
            <div class="service-box">
                <img src="assets/img/read.jpg" alt="Reading Programs" class="img-fluid mb-3">
                <div class="service-content">
                    <h2>Reading Programs</h2>
                    <p>We host a variety of reading programs for children, teenagers, and adults to foster a love of reading and literacy.</p>
                </div>
            </div>
            <div class="service-box">
                <img src="assets/img/community.jpg" alt="Community Outreach" class="img-fluid mb-3">
                <div class="service-content">
                    <h2>Community Outreach</h2>
                    <p>We believe in giving back to the community. Our outreach programs serve to engage and empower local residents through initiatives.</p>
                </div>
            </div>
        </div>
    </section>
    
    <script src="script.js"></script>
    <?php include 'footer.php'; ?>
</body>
</html>
    