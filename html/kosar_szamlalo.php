<?php
session_start();
include "db_connect.php";

// Kosárban lévő elemek számának lekérése
$sql = "SELECT COUNT(*) AS count FROM cart";
$result = $conn->query($sql);
if (!$result) {
    die("Hiba a lekérdezés végrehajtása közben: " . $conn->error);
}

$row = $result->fetch_assoc();
echo $row['count'];
?>
