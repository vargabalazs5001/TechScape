<?php
// Adatbázis kapcsolódás
include "db_connect.php";

// Űrlapból érkező adatok
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Jelszó hashelése
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if ($_FILES['image']['name'] != "") {
    $image = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
    $image = "data:image/jpeg;base64," . $image;
}
else{
    $image = "";
}

// SQL lekérdezés a felhasználó beszúrásához
$insert_sql = "INSERT INTO user_data (email, password_hash, image, permission) VALUES (?, ?, ?, ?)";
$default_permission = 0; // alapértelmezett jogosultság sima felhasználóknak
$insert_stmt = $conn->prepare($insert_sql);
$insert_stmt->bind_param("sssi", $email, $hashed_password, $image, $default_permission);

if ($insert_stmt->execute()) {
    session_start(); // Munkamenet indítása vagy folytatása
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
    $_SESSION['permission'] = $default_permission; // Beállítjuk az alapértelmezett jogosultságot

    echo "<script>alert('Sikeres regisztráció'); window.location = 'index.php'</script>";
    setcookie("registration_success", "true", time() + 3600, "/");
    header("Location: index.php");
    exit();
} else {
    echo "<script>alert('Hiba történt a regisztráció során!'); window.location = 'register.php'</script>" . $insert_stmt->error;
}
// Lezárjuk a lekérdezést és a kapcsolatot
$insert_stmt->close();
$conn->close();
?>