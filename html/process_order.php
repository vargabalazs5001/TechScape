<?php
include "db_connect.php";
// Rendelés adatainak begyűjtése az űrlapról
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

if($card_name && $card_number && $expiration_date && $cvv == null){

}
if($card_number) {
    $hashed_number = password_hash($card_number, PASSWORD_DEFAULT);
} else {
    $hashed_number = null;
}

if($expiration_date) {
    $hashed_date = password_hash($expiration_date, PASSWORD_DEFAULT);
} else {
    $hashed_date = null;
}

if($cvv) {
    $hashed_cvv = password_hash($cvv, PASSWORD_DEFAULT);
} else {
    $hashed_cvv = null;
}

// SQL lekérdezés összeállítása a rendelés adatainak beszúrására
$sql = "INSERT INTO orders (name, phone, street_address, postalcode, city, email, shipping_method, payment, card_name, card_number, expiration_date, cvv)
VALUES ('$nev', '$telefonszam', '$hazszam', '$iranyitoszam', '$varos', '$email', '$delivery', '$payment', '$card_name', '$hashed_number','$hashed_date', '$hashed_cvv')";

// SQL lekérdezés végrehajtása
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Rendelés sikeresen felvéve az adatbázisba'); window.location = 'kosar.php'</script>";
} else {
    echo "<script>alert('Hiba a rendelés felvétele közben: ');</script>" . $conn->error;
}
// Kapcsolat lezárása
$conn->close();
?>