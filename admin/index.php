<?php
session_start();
if (!isset($_SESSION["loggedin"]) || (isset($_SESSION["loggedin"]) && $_SESSION["permission"] != "1")) {
    // Ha nincs bejelentkezett felhasználó, átirányítás a bejelentkezés oldalra
    header("Location: html/index.php");
    exit();
}
include "../html/db_connect.php";
$file_path = '../html/visits.txt';
$content = file_get_contents($file_path);
include "prof_image.php";
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/inv.css">
    <link rel="stylesheet" href="./css/admin.css">
    <title>TechScape | Admin</title>
    <script src="./js/dark.js"></script>
</head>

<body>
    <div class="container">
        <!--Sidebar-->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <h2>Tech<span class="danger">Scape</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-rounded">
                        close
                    </span>
                </div>
            </div>
            <div class="sidebar">
                <a href="index.php">
                    <span class="material-symbols-rounded">
                        Dashboard
                    </span>
                    <h3>Irányítópult</h3>
                </a>
                <a href="users.php">
                    <span class="material-symbols-rounded">
                        Group
                    </span>
                    <h3>Felhasználók</h3>
                </a>
                <a href="email_send.php">
                    <span class="material-symbols-rounded">
                        mail
                    </span>
                    <h3>E-mail és hírlevél küldése</h3>
                </a>
                <a href="inventory_upload.php">
                    <span class="material-symbols-rounded">
                        upload
                    </span>
                    <h3>Feltöltés</h3>
                </a>
                <a href="inventory.php">
                    <span class="material-symbols-rounded">
                        Inventory_2
                    </span>
                    <h3>Raktár</h3>
                </a>
                <a href="admin_feedbacks.php">
                    <span class="material-symbols-rounded">
                        Reviews
                    </span>
                    <h3>Visszajelzések</h3>
                </a>
                <a>
                    <div class="dark-mode">
                        <span class="material-symbols-rounded active" onclick="setLightMode()">
                            light_mode
                        </span>
                        <span class="material-symbols-rounded" onclick="setDarkMode()">
                            dark_mode
                        </span>
                    </div>

                </a>
                <a href="../html/index.php">
                    <span class="material-symbols-rounded">
                        Logout
                    </span>
                    <h3>Kijelentkezés</h3>
                </a>

            </div>
        </aside>
        <!--End of Sidebar-->
        <!--Main Content-->
        <main>
            <div class="techscape">
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <h3>Összes eladás</h3>
                            <h1>0 HUF</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="visits">
                    <div class="status">
                        <div class="info">
                            <h3>Eddigi látogatók</h3>
                            <h1>
                                <?php echo $content ?>
                            </h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="searches">
                    <div class="status">
                        <div class="info">
                            <h3>Keresések</h3>
                            <h1>0</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Recent Orders Table -->
            <div class="recent-orders">
                <h2>Új rendelések</h2>
                <form method="post" action="order_process.php">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Név</th>
                                <th>Mennyiség</th>
                                <th>Egységár</th>
                                <th>Műveletek</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           include "admin_order.php";
                            ?>
                        </tbody>
                    </table>
                </form>


            </div>
            <!-- End of Recent Orders -->
        </main>
        <!--End of Main Content-->
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-symbols-rounded">
                        menu
                    </span>
                </button>
                <div class="profile">
                    <div class="profile-photo">
                        <img src="<?= $image ?>" alt="Profilkép">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/index.js"></script>
</body>

</html>