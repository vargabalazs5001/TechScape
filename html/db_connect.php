<?php
$servername = "mysql.nethely.hu";
$port = "3306";
$username = "techscape";
$password = "mesterremek01";
$dbname = "techscape";
// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Ellenőrizzük a kapcsolatot
if ($conn->connect_error) {
    die("Hiba történt az adatbázisoh való csatlakozás során: " . $conn->connect_error);
}
?>