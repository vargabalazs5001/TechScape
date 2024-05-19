<?php
// Adatbázis kapcsolódás
include "../html/db_connect.php";


// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Ellenőrizzük a kapcsolatot
if ($conn->connect_error) {
    die("Hiba történt az adatbázisoh való csatlakozás során: " . $conn->connect_error);
}

// Űrlapból érkező adatok kezelése
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $categoryName = $_POST['category_name'];

    // SQL lekérdezés a kategória hozzáadásához
    $sql = "INSERT INTO product_category (type, category_name) VALUES ('$type', '$categoryName')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('A kategória sikeresen hozzá lett adva az adatbázishoz.'); window.location = 'inventory_upload.php'</script>";
    } else {
        echo "<script>alert('Hiba a kategória hozzáadása során: ');</script>" . $conn->error;
    }
}

// Adatbázis kapcsolat lezárása
$conn->close();
?>
