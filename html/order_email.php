<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
include "db_connect.php";

// Rendelés adatainak begyűjtése az űrlapról
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nev = $_POST['nev'];
    $telefonszam = $_POST['telefonszam'];
    $hazszam = $_POST['hazszam'];
    $iranyitoszam = $_POST['iranyitoszam'];
    $varos = $_POST['varos'];
    $email = $_POST['email'];
    $delivery = $_POST['delivery'];
    $payment = $_POST['payment'];
    $card_name = $_POST['kartyanev'];
    $card_number = $_POST['kartyaszam'];
    $expiration_date = $_POST['lejarat'];
    $cvv = $_POST['cvv'];

    // Kosár összetevőinek begyűjtése
    $order_items = "";
    foreach ($_SESSION['cart'] as $key => $product) {
        $prod_name = $product['name'];
        $prod_price = $product['price'];
        $prod_quantity = $product['quantity'];
        $order_items .= "$prod_name (Ár: $prod_price, Mennyiség: $prod_quantity)\n";
    }

    if ($card_name && $card_number && $expiration_date && $cvv == null) {

    }
    if ($card_number) {
        $hashed_number = password_hash($card_number, PASSWORD_DEFAULT);
    } else {
        $hashed_number = null;
    }

    if ($expiration_date) {
        $hashed_date = password_hash($expiration_date, PASSWORD_DEFAULT);
    } else {
        $hashed_date = null;
    }

    if ($cvv) {
        $hashed_cvv = password_hash($cvv, PASSWORD_DEFAULT);
    } else {
        $hashed_cvv = null;
    }

    // SQL lekérdezés összeállítása a rendelés adatainak beszúrására
    $sql = "INSERT INTO orders (name, phone, street_address, postalcode, city, email, shipping_method, payment, card_name, card_number, expiration_date, cvv)
    VALUES ('$nev', '$telefonszam', '$hazszam', '$iranyitoszam', '$varos', '$email', '$delivery', '$payment', '$card_name', '$hashed_number','$hashed_date', '$hashed_cvv')";

    // Rendelt termékek beszúrása az order_items táblába
    $sql2 = "INSERT INTO order_items (email, name, quantity, unit_price) VALUES ";
    foreach ($_SESSION['cart'] as $key => $product) {
        $prod_name = $product['name'];
        $prod_price = $product['price'];
        $prod_quantity = $product['quantity'];
        $sql2 .= "('$email','$prod_name', '$prod_quantity', '$prod_price'),";
    }
    $sql2 = rtrim($sql2, ","); // Utolsó vessző eltávolítása

    // SQL lekérdezések végrehajtása
    if ($conn->query($sql) && $conn->query($sql2)) {
        echo "<script>alert('Rendelés sikeresen felvéve az adatbázisba'); window.location = 'kosar.php'</script>";
    } else {
        echo "<script>alert('Hiba a rendelés felvétele közben: ');</script>" . $conn->error;
    }

    $conn->close();

    // Email küldése
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'mail.nethely.hu';
        $mail->SMTPAuth = true;
        $mail->Username = 'mesterremek@techscape.szakdoga.net';
        $mail->Password = 'Mesterremek01';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('mesterremek@techscape.szakdoga.net', 'TechScape');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Megrendelés visszaigazolása';
        $mail->Body = 'Köszönjük a megrendelést! <br> Rendelt termékek: <br>' . $order_items;

        $mail->CharSet = 'UTF-8';
        $mail->send();
        echo 'Az email sikeresen elküldve!';
    } catch (Exception $e) {
        echo "Hiba történt az email küldése közben: {$mail->ErrorInfo}";
    }
}
?>
