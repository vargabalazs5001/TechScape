<?php
session_start();
include "../html/db_connect.php";
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/feedbacks.css">
    <link rel="stylesheet" href="./css/admin.css">
    <title>TechScape | Vélemények</title>
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
        <div class="feedbacks">
                <h2>Visszajelzések</h2>
                <table class="scroll">
                    <thead>
                        <tr>
                            <th>Név</th>
                            <th>Email</th>
                            <th>Visszajelzés</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "admin_fb_sql.php"?>
                    </tbody>
                </table>
            </div>
        </main>
        <!--End of Main Content-->
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-rounded">
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