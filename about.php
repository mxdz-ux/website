<?php
// Start session for user tracking
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
</head>
<body style="background-image: url(assets/img/back.png);">

<?php include 'navbar.php'; ?>

    <!-- about us section-->
    <section id="about" class="containers">
        <h1>About Us</h1>
        <hr class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <h2>Our Mission</h2>
                <p>
                    At Reading Club 2000, our mission is to nurture a love for reading, encourage the reuse of books, and promote a culture of knowledge sharing. We strive to make reading accessible to everyone by creating a space where books are freely shared, inspiring individuals to grow and connect through the power of literature.
                </p>
            </div>
            <div class="col-md-6">
                <h2>Our Vision</h2>
                <p>
                    Reading Club 2000 envisions a world where books are celebrated as tools for personal and communal transformation. We aim to be a beacon of inspiration, fostering a sustainable, inclusive, and passionate reading community that values learning, creativity, and social responsibility.
                </p>
            </div>
        </div>
    </section>

    <!-- history section -->
    <section id="history" class="containers">
        <h1 class="texts-center">Our History</h1>
        <p>
            Reading Club 2000 was founded by Nanie Guanlao in 2000 as a simple initiative to share his personal collection of books with his community. Starting from his home in Makati City, the club has grown into a beloved community hub where people can freely borrow and donate books. Nanie’s belief that "a book should be used and reused" remains the cornerstone of the club’s philosophy.
        </p>
    </section>

    <!-- owner -->
    <section id="owner" class="containers">
        <h1 class="texts-center">Meet the Owner</h1>
        <div class="row">
            <img src="assets/img/about.png" alt="Mang Nanie">
            <h2><u>Mang Nanie Guanlao</u></h2>
            <h4><b>Founder and Owner of Reading Club 2000</b></h4>
            <p>
                Mang Nanie is a passionate advocate for literacy and community learning. He founded Reading Club 2000 with the belief that books should be shared and reused to inspire knowledge and growth. His initiative began with his personal collection and has since grown into a beloved hub for readers in Makati City.
            </p>
        </div>
    </section>

    <script src="script.js"></script>
    <?php include 'footer.php'; ?>
</body>
</html>