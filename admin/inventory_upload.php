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
            <h1>Termék és kategória hozzáadása</h1>
            <br>
            <form action="category_feltolt.php" method="post">
                <label for="type">Típus:</label>
                <input type="text" name="type" required><br>

                <label for="category_name">Kategória név:</label>
                <input type="text" name="category_name" required><br>

                <button type="submit">Kategória hozzáadása</button>
            </form>
            <br>
            <form id="feltolt.php" action="feltolt.php" method="post" enctype="multipart/form-data">
                <label for="name">Termék neve:</label>
                <input type="text" id="name" name="name" required>
                <label for="description">Leírás:</label>
                <textarea id="description" name="description" required></textarea>
                <label for="image">Kép kiválasztása:</label>
                <input type="file" id="image" name="image" accept="image/jpeg" required>
                <label for="unit_price">Ár:</label>
                <input type="number" id="unit_price" name="unit_price" required>
                <label for="category_id">Kategória kiválasztása:</label>
                <select id="category_id" name="category_id" required>
                    <?php
                    include "../html/db_connect.php";
                    include "inv_up_select.php";
                    ?>
                </select>
                <button type="submit">Termék Hozzáadása</button>
            </form>
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
        <script src="./js/feltolt.js"></script>
        <script src="./js/index.js"></script>
</body>

</html>