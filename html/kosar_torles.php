<?php
session_start();

// Ellenőrizd, hogy az AJAX kérés POST metódussal érkezett-e
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['index'])) {
    $index = $_POST['index'];
    // Törlés a kosárból az index alapján
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        // Újrarendezzük a tömböt
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    
    } else {
        header('HTTP/1.1 400 Bad Request');
     
    }
} else {
    header('HTTP/1.1 400 Bad Request');
   
}

