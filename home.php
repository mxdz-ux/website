<?php
// Start session for user tracking
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

</head>
<body style="background-image: url(assets/img/back.png);">

    <!-- navbar natin-->
    <?php include 'navbar.php'; ?>
    <!-- header slider natin -->
    <div class="slider-container">
        <div class="slider-wrapper">
            <div class="slider-item">
                <div class="slide-content">
                    <h3 class="slide-subtitle">Featured</h3>
                    <p class="slide-description">This section contains the overview of the website</p>
                    <a href="home.html" class="slide-button">Learn More</a>
                </div>
                <img src="assets/img/featured.png" alt="Featured" class="slider-image">
            </div>
            <div class="slider-item">
                <div class="slide-content">
                    <h3 class="slide-subtitle">Catalog</h3>
                    <p class="slide-description">This section contains the books offered</p>
                    <a href="catalog.html" class="slide-button">Learn More</a>
                </div>
                <img src="assets/img/homepic3.jpg" alt="Catalog" class="slider-image">
            </div>
            <div class="slider-item">
                <div class="slide-content">
                    <h3 class="slide-subtitle">Services</h3>
                    <p class="slide-description">This section contains the services of the company</p>
                    <a href="services.html" class="slide-button">Learn More</a>
                </div>
                <img src="assets/img/homepic1.jpg" alt="Services" class="slider-image">
            </div>
            <div class="slider-item">
                <div class="slide-content">
                    <h3 class="slide-subtitle">About</h3>
                    <p class="slide-description">This section contains mission, vision, and history.</p>
                    <a href="about.html" class="slide-button">Learn More</a>
                </div>
                <img src="assets/img/homepic2.jpg" alt="About" class="slider-image">
            </div>
        </div>
        <div class="slider-nav">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>

    <!-- Latest News ng Library -->
    <section id="news" class="news-section">
        <h2>Donating Books</h2>
        <hr>
        <div class="news-grid">
            <div class="news-card">
                <img src="assets/img/news1.PNG" alt="Event 1">
                <div class="news-content">
                    <h3>New Canipo National High School</h3>
                    <p>In collaboration with JASON AND ROMELISA BERNARDO on our Community Engagement...</p>
                    <button><a href="https://www.facebook.com/ReadingClub2000/posts/free-book-giving-mission-in-palawan-province-to-reach-the-indegenous-reading-com/997898182373127/">Read More</a></button>
                </div>
            </div>
            <div class="news-card">
                <img src="assets/img/news2.PNG" alt="Event 2">
                <div class="news-content">
                    <h3>Reader's of Barrio</h3>
                    <p>Our free book giving mission now includes K-12 textbooks, old toys, and school supplies...</p>
                    <button><a href="https://www.facebook.com/ReadingClub2000/posts/bookdonors-and-book-missionariesmaraming-salamat-po-sa-inyong-supporta-sa-readin/981332400696372/">Read More</a></button>
                </div>
            </div>
            <div class="news-card">
                <img src="assets/img/news4.jpg" alt="Event 3">
                <div class="news-content">
                    <h3>Project Hara - Help Albay Rise Again</h3>
                    <p>Youth-led relief efforts in Libon, Albay with our free books through the initiative...</p>
                    <button><a href="https://www.facebook.com/share/p/15oGsHGfwc/">Read More</a></button>
                </div>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
    <?php include 'footer.php'; ?>
</body>

</html>
