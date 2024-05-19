<?php
// Ellenőrizd, hogy van-e találat
if ($result->num_rows > 0) {
    // Ha van találat, jelenítsd meg a termékeket
    while ($row = $result->fetch_assoc()) {
        $image = "";
        if ($row['image'] != "") {
            $image = '<img src="' . $row['image'] . '" >';
        }
        ?>
        <div class="product-card">
            <?php echo $image; ?>
            <div class="product-details">
                <h3 class="product-title">
                    <?php echo $row['name']; ?>
                </h3>
                <span class="product-price">
                    <?php echo $row['unit_price']; ?> Ft
                </span>
                <p class="product-description">
                    <?php echo $row['description']; ?>
                </p>
            </div>
            <button class="payment-button" onclick="addToCart(this)">Kosárba</button>
        </div>
        <?php
    }
} else {
    // Ha nincs találat a keresésre, jelenítsd meg az üzenetet
    echo "<h2 style='text-align: center;' id='hibaCim'>A/Az '$searchTerm' termék nem található. Kérlek, próbálkozz újra.</h2>";
}
?>