<?php
include "../html/db_connect.php";
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Ellenőrizzük a kapcsolatot
if ($conn->connect_error) {
    die("Hiba történt az adatbázisoh való csatlakozás során: " . $conn->connect_error);
}
$id = $_SESSION["email"];
$sql = "SELECT image FROM user_data WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();
$image = $user_data['image'];
?>