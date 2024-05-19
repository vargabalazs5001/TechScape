<?php
session_start();
include "db_connect.php";
include "kosar_com.php";
include "iranyitoszamok.php";
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="../js/kosar.js"></script>
    <link rel="stylesheet" href="css/kosar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <title>TechSpace | Főoldal</title>
</head>

<body data-isloggedin="<?php echo $isLoggedIn ? 'true' : 'false'; ?>">
    <header>
        <a href="index.php" class="logo">Tech<span class="logo2">Scape</span></a>
        <div class="group">
            <ul class="navigation">
                <li><a href="products.php">Termékek</a></li>
                <li>
                    <a href="kosar.php"><i class="ri-shopping-cart-line"></i><span id="cartCounter">0</span></a>
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
            <input type="text" placeholder="Keresés...">
        </div>
    </header>
    <main>
        <div class="container">
            <?php include "kosar_add.php"; ?>
            <div class="pagination-container">
                <div class="pagination-buttons">
                    <button id="prevButton"><<</button>
                    <div id="pageIndicator"></div>
                    <button id="nextButton">>></button>
                </div>
            </div>
        </div>

        <div class="second-div">
            <form id="orderForm" action="order_email.php" method="post">
                <h1>Rendelés</h1>
                <div class="input-container">
                    <input type="text" name="nev" id="nev" required> <label for="nev"
                        class="shrinkable-label">Név:</label>
                </div>
                <div class="input-container">
                    <input type="text" name="telefonszam" id="telefonszam" style="color: #999;" value="30 111 1111"
                        required onfocus="clearDefaultValue(this)" oninput="formatPhoneNumber(this)"
                        onblur="restoreDefaultValue(this)" maxlength="12">
                    <label for="telefonszam" class="shrinkable-label">Telefonszám:</label>
                    <div id="telefonszam-error" style="color: red;"></div>
                </div>
                <div class="input-container">
                    <input type="text" name="hazszam" id="hazszam" required> <label for="hazszam"
                        class="shrinkable-label">Utca, Házszám:</label>
                </div>
                <div class="input-container">
                    <input type="text" name="iranyitoszam" id="iranyitoszam" required> <label for="iranyitoszam"
                        class="shrinkable-label">Irányítószám:</label>
                </div>
                <div class="input-container">
                    <input type="text" name="varos" id="varos" required> <label for="varos"
                        class="shrinkable-label">Város:</label>
                </div>
                <div class="input-container">
                    <input type="email" name="email" id="email" required> <label for="email"
                        class="shrinkable-label">Email:</label>
                </div>
                <hr>
                <p>HÁZHOZSZÁLLÍTÁS:</p>
                <div class="delivery-options">
                    <input type="radio" id="dpd" name="delivery" value="dpd" checked>
                    <label for="dpd">DPD Futár - 1200</label><br>

                    <input type="radio" id="gls" name="delivery" value="gls">
                    <label for="gls">GLS - 1400</label>
                </div>
                <hr>
                <div class="payment-options">
                    <p>FIZETÉS:</p>
                    <input type="radio" id="card" name="payment" value="card">
                    <label for="card">Bankkártya - Ingyenes</label><br>

                    <input type="radio" id="cod" name="payment" value="cod" checked>
                    <label for="cod">Utánvét - 300 Ft</label>
                </div>
                <hr>
                <div id="cardDetails" class="card-details" style="">
                    <h1>Bankkártya adatok</h1>
                    <div class="input-container">
                        <input type="text" name="kartyanev" id="kartyanev">
                        <label for="kartyanev" class="shrinkable-label">Kártyatulajdonos neve:</label>
                    </div>
                    <div class="input-container">
                        <input type="text" name="kartyaszam" id="kartyaszam" maxlength="19">
                        <label for="kartyaszam" class="shrinkable-label">Kártyaszám:</label>
                    </div>
                    <div class="input-container">
                        <input type="text" name="lejarat" id="lejarat" maxlength="5"
                            pattern="^(0[1-9]|1[0-2])/[0-9]{2}$">
                        <label for="lejarat" class="shrinkable-label">Lejárati dátum:</label>
                    </div>
                    <div class="input-container">
                        <input type="text" name="cvv" id="cvv" maxlength="3">
                        <label for="cvv" class="shrinkable-label">CVV kód:</label>
                    </div>
                </div>
                <p class="total-price">Végösszeg: <span id='finalPrice'>
                        <?= number_format($totalProductPrice, 0, ) ?> Ft
                    </span></p>
                <button type="submit" class="payment-button" id="processOrderButton" onclick="order_email();">Megrendelés</button>
            </form>
        </div>
        </div>

        <div id="overlay" class="overlay">
            <div id="popup" class="popup">
                <span class="close-btn" onclick="closePopup()">x</span>
                <div id="loginForm" class="login-form">
                    <div class="formbox login">
                        <form action="/TechScape/html/login_process_online.php" method="post">
                            <h2>Bejelentkezés</h2>
                            <div class="input-box">
                                <span class="icon">
                                    <i class='bx bxs-envelope'></i>
                                </span>
                                <input type="email" name="email" required>
                                <label for="email">Email:</label>
                            </div>
                            <div class="input-box">
                                <span class="icon" id="togglePassword">
                                    <i class='bx bxs-lock-alt' data-hidden='true'></i>
                                </span>
                                <input type="password" name="password" id="password" required>
                                <label for="password">Jelszó:</label>
                            </div>
                            <div class="remember-password">
                                <label for=""><input type="checkbox" name="" id="">Emlékezz rám</label>
                                <a href="#">Elfelejtette a jelszavát?</a>
                            </div>
                            <button class="btn">Bejelentkezés</button>
                            <div class="create-account">
                                <p>Nincs fiókja?<a href="register.php" class="register-link"> Hozzon létre egyet!</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </main>
</body>
<script type="text/javascript" src="../js/kereso.js"></script>
<script type="text/javascript" src="../js/jelszo.js"></script>

</html>