<?php
include "../html/db_connect.php";
if(isset($_POST['modify_product'])) {
    // Az űrlapról érkező adatok
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $unit_price = $_POST['unit_price'];
    
    if ($_FILES['image']['name'] != "") {
        $image = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
        $image = "data:image/jpeg;base64," . $image;
    } else {
        $image = "";
    }

    // Képfeltöltés kezelése, ha szükséges

    // Adatbázis frissítése
    $query = "UPDATE products SET name=?, description=?, unit_price=?, image=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $name, $description, $unit_price, $image, $id); // $id változót kell használni
    $stmt->execute();

    // Sikeres módosítás után átirányítás az inventory.php oldalra vagy egyéb helyre
    echo "<script>alert('Termék sikeresen módosítva!'); window.location = 'inventory.php'</script>";
    exit();
}
?>