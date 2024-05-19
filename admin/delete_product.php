<?php
include "../html/db_connect.php";
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Ellenőrizzük a kapcsolatot
if ($conn->connect_error) {
    die("Hiba történt az adatbázisoh való csatlakozás során: " . $conn->connect_error);
}
$product_id = $_GET['id'];
// Ellenőrizd, hogy a product_id létezik és nem üres
if (isset($product_id) && !empty($product_id)) {
    
    // Elkészítjük a prepared statement-et
    $delete_sql = "DELETE FROM `products` WHERE `id` = ?";
    $delete_stmt = $conn->prepare($delete_sql);

    // Ellenőrizzük a prepared statement előkészítését
    if ($delete_stmt === false) {
        echo "<script>alert('Hiba az adatbázisból való törlés során: " . $conn->error . "');</script>";
    } else {
        // Kösd össze a paramétert a prepared statement-del
        $delete_stmt->bind_param("i", $product_id);
        
        // Végrehajtjuk a prepared statement-et
        if ($delete_stmt->execute()) {
            echo "<script>alert('Termék sikeresen törölve az adatbázisból.'); window.location = 'inventory.php'</script>";
        } else {
            echo "<script>alert('Hiba az adatbázisból való törlés során: " . $delete_stmt->error . "');</script>";
        }
    }

} else {
    echo "<script>alert('Hibás termék azonosító.');</script>";
}

// Bezárjuk a kapcsolatot
$conn->close();
?>