<?php
session_start();

// Itt kell ellenőrizni a felhasználó bejelentkezését és más műveleteket végezni (pl. adatbázis ellenőrzés)
// Ha sikeres a bejelentkezés, beállítjuk a munkamenet változókat
$_SESSION['loggedin'] = true;

// JSON válasz elküldése a kliensnek
echo json_encode(['success' => true]);
?>