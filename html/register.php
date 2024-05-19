<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/registerstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <title>TechScape | Regisztráció</title>
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
                <?php include "log_check.php";?> 
            </ul>
            <div class="search">
                <span class="icon">
                    <i class='bx bx-search' id="searchBtn"></i>
                    <i class='bx bx-x' id="closeBtn" ></i>
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
     <div class="register-section">
        <div class="formbox register">
            <form id="registration_process.php" action="registration_process.php" method="post" enctype="multipart/form-data">
                <h2>Regisztráció</h2>
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
                <div class="input-box">
                    <span class="icon" id="toggleConfirmPassword">
                        <i class='bx bxs-lock-alt'></i>
                    </span>
                    <input type="password" name="confirm_password" required>
                    <label for="confirm_password">Jelszó mégegyszer:</label>
                </div>
                <div class="input-box">
                    <label for="image" class="file-label">
                        <i class='bx bxs-cloud-upload'></i> Kép kiválasztása
                    </label>
                    <input type="file" id="image" name="image" required style="display: none;" accept="image/">
                </div>
                <button class="btn" type="submit">Regisztráció</button>
                <div class="create-account">
                    <p>Van már fiókja?<a href="login.php" class="login-link"> Jelentkezzen be!</a></p>
                </div>
            </form>                        
        </div>
    </div>
    <script type="text/javascript" src="../js/jelszo.js"></script>
    <script src="../js/kereso.js"></script>
</body>
</html>