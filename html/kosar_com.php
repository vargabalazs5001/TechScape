<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity'])) {
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];
    $quantity = $_POST['quantity'];

    $isProductInCart = false;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as &$product) {
            if ($product['name'] === $productName) {
                $product['quantity'] += $quantity;
                $isProductInCart = true;
                break;
            }
        }
        if (!$isProductInCart) {
            $_SESSION['cart'][] = array(
                'name' => $productName,
                'price' => $productPrice,
                'quantity' => $quantity
            );
        }
    } else {
        $_SESSION['cart'] = array(
            array(
                'name' => $productName,
                'price' => $productPrice,
                'quantity' => $quantity
            )
        );
    }

    echo json_encode(array('success' => true));
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['index'])) {
    $index = $_POST['index'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        echo json_encode(array('success' => true));
        exit;
    }
}

$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

?>