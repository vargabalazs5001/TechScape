<?php
include "db_connect.php";
// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Ellenőrizzük a kapcsolatot
if ($conn->connect_error) {
    die("Hiba történt az adatbázisoh való csatlakozás során: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    // SQL lekérdezés a kategória hozzáadásához
    $sql = "INSERT INTO feedbacks (name, email, comment) VALUES ('$name', '$email', '$comment')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('A kategória sikeresen hozzá lett adva az adatbázishoz.'); window.location = 'feedbacks.php'</script>";
    } else {
        echo "<script>alert('Hiba a kategória hozzáadása során: ');</script>" . $conn->error;
    }
}
$conn->close();
?>