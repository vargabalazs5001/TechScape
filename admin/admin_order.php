<?php
include "../html/db_connect.php";
$sql = "SELECT id, email, name, quantity, unit_price FROM order_items";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["quantity"] . "</td>";
    echo "<td>" . $row["unit_price"] . "</td>";
    echo "<td>
<button type='submit' name='action' value='Feldolgozás alatt'>Feldolgozás alatt</button>
<button type='submit' name='action' value='Csomagolás alatt'>Csomagolás</button>
<button type='submit' name='action' value='Átadva a futárszolgálatnak'>Átadva a futárnak</button>
<input type='hidden' name='id' value='" . $row['id'] . "'>
<input type='hidden' name='email' value='" . $row['email'] . "'>
</td>";
    echo "</tr>";
}
