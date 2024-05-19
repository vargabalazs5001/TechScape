<?php
// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Ellenőrizzük a kapcsolatot
if ($conn->connect_error) {
    die("Hiba történt az adatbázisoh való csatlakozás során: " . $conn->connect_error);
}

// SQL lekérdezés az összes kategória lekéréséhez
$sql = "SELECT * FROM product_category";
$result = $conn->query($sql);

// Ellenőrizzük a lekérdezés eredményét
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["id"] . "'>" . $row["category_name"] . "</option>";
    }
}
?>