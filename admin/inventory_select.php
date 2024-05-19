<?php
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
if (!$result) {
    die("Érvénytelen lekérdezés: " . $conn->error);
}
while ($row = $result->fetch_assoc()) {
    $image = "";
    if ($row['image'] != "") {
        $image = '<img src="' . $row['image'] . '" style="max-width: 100px; acpect-ratio: 3/2">';
    }
    echo "
        <tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['category_id'] . "</td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['description'] . "</td>
            <td>" . $row['unit_price'] . "</td>
            <td>" . $image . "</td>
            <td>
                <button onclick='modosit(" . $row['id'] . ")'>Módosítás</button>
                <button onclick='torol(" . $row['id'] . ")'>Törlés</button>
            </td>
        </tr>
        
    ";
}
?>