<?php
$sql = "SELECT * FROM feedbacks";
$result = $conn->query($sql);
if (!$result) {
    die("Érvénytelen lekérdezés: " . $conn->error);
}
while ($row = $result->fetch_assoc()) {
    echo "
        <tr>
            <td>" . $row['name'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['comment'] . "</td>
        </tr>
    ";
}
?>