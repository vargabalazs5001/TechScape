<?php
    include "db_connect.php";

    $sql = "SELECT * FROM produts";
    $result = $conn->query($sql);
?>