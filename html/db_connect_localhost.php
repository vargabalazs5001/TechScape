<?php
$servername = "localhost";
$port = "3306";
$username = "root";
$password = "";
$dbname = "techscape";
// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Ellenőrizzük a kapcsolatot
if ($conn->connect_error) {
    die("Hiba történt az adatbázisoh való csatlakozás során: " . $conn->connect_error);
}
?>