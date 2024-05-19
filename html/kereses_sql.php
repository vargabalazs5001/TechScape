<?php
session_start();
include "db_connect.php";
 
$priceRanges = isset($_GET['priceRanges']) ? $_GET['priceRanges'] : array();
$searchTerm = isset($_GET['kereses']) ? $_GET['kereses'] : '';
 
$keywords = explode(" ", $searchTerm);
$conditions = array();
foreach ($keywords as $keyword) {
    $conditions[] = "(name LIKE '%$keyword%' OR description LIKE '%$keyword%')";
}
 
$whereClause = '';
if (!empty($conditions)) {
    $whereClause = ' WHERE ' . implode(' OR ', $conditions);
} else {
    $whereClause = ' WHERE 1 = 0';
}
 
$sql = "SELECT * FROM products $whereClause";
$result = $conn->query($sql);
 
if (!$result) {
    die("Hiba a lekérdezés végrehajtása közben: " . $conn->error);
}
?>