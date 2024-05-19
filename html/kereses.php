<?php
session_start();
include "db_connect.php";

$priceRanges = isset($_GET['priceRanges']) ? $_GET['priceRanges'] : array();
$searchTerm = isset($_GET['kereses']) ? $_GET['kereses'] : '';

$keywords = explode(" ", $searchTerm);
$conditions = array();
foreach ($keywords as $keyword) {
    $conditions[] = "(name LIKE '%$keyword%' OR description LIKE '%$keyword%')";
}

$whereClause = '';
if (!empty($conditions)) {
    $whereClause = ' WHERE ' . implode(' OR ', $conditions);
} else {
    $whereClause = ' WHERE 1 = 0';
}

$sql = "SELECT * FROM products $whereClause";
$result = $conn->query($sql);

if (!$result) {
    die("Hiba a lekérdezés végrehajtása közben: " . $conn->error);
}
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
    <title>TechScape | Keresési eredmények</title>
</head>
<body class="<?php echo $result->num_rows > 0 ? '' : 'no-scroll'; ?>">
    <header>
        <a href="index.php" class="logo">Tech<span class="logo2">Scape</span></a>
        <div class="group">
            <ul class="navigation">
                <li><a href="products.php">Termékek</a></li>
                <li>
                    <a href="kosar.php"><i class="ri-shopping-cart-line"></i>Kosár</a>
                </li>
                <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { ?>    
                    <li><a href="logout.php" id="logoutButton" >Kijelentkezés</a></li>
                    <?php } else { ?>
                <li>
                    <a href="login_html.php" class="user" id="loginLink"><i class="ri-user-fill"></i>Bejelentkezés</a> 
                </li>
                <li><a href="register.php">Regisztráció</a></li>
                <?php } ?> 
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
            <input type="text" name="kereses" placeholder="Keresés..." value="<?php echo htmlspecialchars($searchTerm); ?>">
            </form>
        </div>
    </header>

    <main>
        <div class="product-container">
            <?php if ($result->num_rows > 0) { ?>
                <h2 class='hibaCim'><?php echo $result->num_rows; ?> találat a következő kifejezésre: '<?php echo $searchTerm; ?>'</h2>
                <div class="product-row">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class="product-card">
                            <?php 
                            $image = "";
                            if ($row['image'] != "") {
                                $image = '<img src="' . $row['image'] . '" >';
                            }
                            echo $image; ?>
                            <div class="product-details">
                                <h3 class="product-title"><?php echo $row['name']; ?></h3>
                                <span class="product-price"><?php echo $row['unit_price']; ?> Ft</span>
                                <p class="product-description"><?php echo $row['description']; ?></p>
                            </div>
                            <button class="payment-button" onclick="addToCart(this)">Kosárba</button>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div id="hibadiv">
                    <h2 id='hibaCim'>0 találat a következő kifejezésre: '<?php echo $searchTerm; ?>'</h2>
                    <ul id='hibaCim2'>A keresett termék megtalálása érdekében, próbálja a következőket:
                        <li class='hiba'>Ellenőrizze a kifejezések helyességét.</li>
                        <li class='hiba'>Próbáljon meg hasonló kifejezéseket használni.</li>
                        <li class='hiba'>Próbálja újra, használjon átfogóbb keresést.</li>
                    </ul>
                </div>
            <?php } ?>
        </div>
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
                        <a href="https://www.facebook.com/vargabalazs5001" target="_blank"><i class="ri-facebook-fill"></i></a>
                        <a href="https://github.com/vargabalazs5001/TechScape/tree/main" target="_blank"><i class='bx bxl-github'></i></a>
                        <a href="https://www.instagram.com/baloghdominik_/" target="_blank"><i class="ri-instagram-fill"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>   

    <script type="text/javascript" src="../js/termekek.js"></script>
    <script type="text/javascript" src="../js/kereso.js"></script>
</body>
</html>