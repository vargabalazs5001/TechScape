<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['index']) && isset($_POST['quantity'])) {
    $index = $_POST['index'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'][$index])) {
        $_SESSION['cart'][$index]['quantity'] = $quantity;
        echo json_encode(array('success' => true));
        exit;
    }
}

echo json_encode(array('success' => false));
?>
