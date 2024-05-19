<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/loginstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <title>TechSpace | Főoldal</title>
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
                <?php include "log_check.php"; ?>
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
    <div class="login-section">
        <div class="formbox login">
            <form action="login_process_online.php" method="post">
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
                    <p>Nincs fiókja?<a href="register.php" class="register-link"> Hozzon létre egyet!</a></p>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/jelszo.js"></script>
    <script type="text/javascript" src="../js/kereso.js"></script>
</body>

</html>