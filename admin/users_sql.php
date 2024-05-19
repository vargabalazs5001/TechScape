<?php
$sql = "SELECT image FROM user_data WHERE permission = 0";
$result = $conn->query($sql);
if (!$result) {
    die("Érvénytelen lekérdezés: " . $conn->error);
}
while ($row = $result->fetch_assoc()) {
    $image = "";
    if ($row['image'] != "") {
        $image = '<img src="' . $row['image'] . '" style="width: 100px; height: 100px;  padding: 10px; border-radius: 50%;">';
    }
    echo '<div class="user-grid-item">';
    echo $image;
    echo '</div>';
}
?>