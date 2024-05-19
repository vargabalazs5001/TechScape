<?php
// Először az adott termék adatainak lekérdezése az adatbázisból
if(isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = "SELECT * FROM products WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}

// Ellenőrizd, hogy volt-e hiba a lekérdezésben
if (!isset($product) || !$product) {
    echo "Hiba a termék lekérdezésekor.";
    exit();
}
?>