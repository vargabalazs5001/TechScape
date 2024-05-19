<?php
$sql = "SELECT * FROM cities";
$result = mysqli_query($conn, $sql);

$zipcodeData = array();

while ($row = mysqli_fetch_assoc($result)) {
    $zipcodeData[$row['postcode']] = $row['town'];
}

echo '<script>';
echo 'var iranyitoszamok = ' . json_encode($zipcodeData) . ';';
echo '</script>';

?>