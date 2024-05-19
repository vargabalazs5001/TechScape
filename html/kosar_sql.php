<?php
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo "<ul>";
    foreach ($_SESSION['cart'] as $key => $product) {

        $sql = "SELECT image FROM products WHERE name = '" . $product['name'] . "'";
        $result = $conn->query($sql);
        if (!$result) {
            die("Érvénytelen lekérdezés: " . $conn->error);
        }
        while ($row = $result->fetch_assoc()) {
            $image = "";
            if ($row['image'] != "") {
                $image = '<img src="' . $row['image'] . '" style="max-width:100px; max-height:100px;" >';
            }
        }
        echo "<li>";
        echo "<div class='product-info'>";
        echo "<span class='product-name'>" . $product['name'] . "</span>";
        echo "<span class='product-price'>" . $product['price'] . "</span>";
        echo $image;
        echo "<input type='number' class='product-quantity' value='" . max(1, $product['quantity']) . "' min='1' onchange='updateCartItemQuantity($key, this.value)'>";
        echo "<button class='remove-button' onclick='removeFromCart($key)' '><i class='ri-delete-bin-5-line'></i></button>";
        echo "</div>";
        echo "</li>";
    }
    echo "</ul>";
}
?>