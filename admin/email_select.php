<?php
include "../html/db_connect.php";
$sql = "SELECT email FROM user_data";
$result = $conn->query($sql);
?>