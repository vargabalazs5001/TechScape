<?php
session_start();
include "db_connect.php";
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <title>TechScape | Főoldal</title>
</head>

<body>
    <header>
        <a href="index.php" class="logo">Tech<span class="logo2">Scape</span></a>
        <div class="group">
            <ul class="navigation">
                <li><a href="products.php">Termékek</a></li>
                <li>
                    <a href="kosar.php"><i class="ri-shopping-cart-line"></i>Kosár</a>
                </li>
                <?php include "log_check.php" ?>
            </ul>
            <div class="search">
                <span class="icon">
                    <i class='bx bx-search' id="searchBtn"></i>
                    <i class='bx bx-x' id="closeBtn"></i>
                </span>
            </div>
            <i class='bx bx-menu' id="menuToggle"></i>
        </div>
        <div class="searchBox">
            <form method="GET" action="kereses.php">
                <input type="text" name="kereses" placeholder="Keresés...">
            </form>
        </div>
    </header>
    <main>
    <section class="hero">
            <div class="hero-content">
                <h1>Üdvözöljük a <span class="focim">Tech</span><span class="focim2">Scape</span> webáruházban!</h1>
                <p>Ismerje meg legújabb termékeinket és szolgáltatásainkat.</p>
                <a href="products.php" class="btn btn-primary">Termékek böngészése</a>
            </div>
        </section>

        <section class="services">
            <div class="container">
                <h2>Termékeink</h2>
                <div class="service-items">
                    <?php
                    $random_products_query = "SELECT * FROM products ORDER BY RAND() LIMIT 4";
                    $random_products_result = $conn->query($random_products_query);
                    
                    while ($row = $random_products_result->fetch_assoc()) {
                        $image = ($row['image'] != "") ? '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">' : '';
                        echo '<div class="service-item">';
                        echo $image;
                        echo '<h3>' . $row['name'] . '</h3>';
                        echo '<p>' . $row['description'] . '</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="testimonials">
            <h2 id="vasarloi">Vásárlói vélemények</h2>
            <div class="container">
                <?php
                $feedbacks_query = "SELECT * FROM feedbacks ORDER BY RAND() LIMIT 4";
                $feedbacks_result = $conn->query($feedbacks_query);

                if ($feedbacks_result->num_rows > 0) {
                    while ($feedback_row = $feedbacks_result->fetch_assoc()) {
                        echo '<div class="testimonial-item">';
                        echo '<p>"' . $feedback_row['comment'] . '"</p>';
                        echo '<span>- ' . $feedback_row['name'] . '</span>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Nincsenek vásárlói vélemények.</p>';
                }
                ?>
            </div>
        </section>
    </main>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>Cégünk</h4>
                    <ul>
                        <li><a href="aboutus.php">Rólunk</a></li>
                        <li><a href="privacypolicy.php">Adatvédelmi irányelvek</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Segítségek</h4>
                    <ul>
                        <li><a href="gyik.php">GyIK</a></li>
                        <li><a href="order.php">Szállítás & Fizetési Információk</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Termékeink</h4>
                    <ul>
                        <li><a href="graphiccards.php">Videókártyák</a></li>
                        <li><a href="cpu.php">Processzorok</a></li>
                        <li><a href="keyboards.php">Billentyűzetek</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Kövessen minket</h4>
                    <div class="social-links">
                        <a href="https://www.facebook.com/vargabalazs5001" target="_blank"><i
                                class="ri-facebook-fill"></i></a>
                        <a href="https://github.com/vargabalazs5001/TechScape/tree/main" target="_blank"><i
                                class='bx bxl-github'></i></a>
                        <a href="https://www.instagram.com/baloghdominik_/" target="_blank"><i
                                class="ri-instagram-fill"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="../js/kereso.js"></script>

</html>