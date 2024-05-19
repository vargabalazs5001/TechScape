<?php
include "../html/db_connect.php";
// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Ellenőrizzük a kapcsolatot
if ($conn->connect_error) {
    die("Hiba történt az adatbázisoh való csatlakozás során: " . $conn->connect_error);
}

// Adatok begyűjtése a POST kéréstől
$category_id = $_POST["category_id"];
$name = $_POST['name'];
$description = $_POST['description'];
$unit_price = $_POST['unit_price'];

if ($_FILES['image']['name'] != "") {
    $image = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
    $image = "data:image/jpeg;base64," . $image;
} else {
    $image = "";
}

// SQL lekérdezés a felhasználó beszúrásához
$insert_sql = "INSERT INTO products (category_id, name, description, unit_price, image) VALUES (?, ?, ?, ?, ?)";
$insert_stmt = $conn->prepare($insert_sql);
$insert_stmt->bind_param("sssss", $category_id, $name, $description, $unit_price, $image);

// Adatok beszúrása az adatbázisba
if ($insert_stmt->execute()) {
    echo "<script>alert('Termék sikeresen hozzáadva az adatbázishoz.'); window.location = 'inventory_upload.php'</script>";
    // Adatbázis kapcsolat lezárása
    $insert_stmt->close();
} else {
    echo "<script>alert('Hiba az adatok beszúrása során: ');</script>" . $conn->error;
}

// Ellenőrzés, hogy minden mezőt kitöltöttek-e
if ($category_id == "" || $name == "" || $description == "" || $image == "" || $unit_price == "") {
    setcookie("missing_data", "true", time() + 3600, "/");
    header("Location: inventory_upload.php");
}

// Adatbázis kapcsolat lezárása
$conn->close();


// Adatbázis kapcsolat lezárása
$insert_stmt->close();
$conn->close();
?>