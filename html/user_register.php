<?php
// Adatbázis kapcsolódás
include "db_connect.php";

// Űrlapból érkező adatok
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$image = $_POST['image'];

// Ellenőrzés, hogy van-e már ilyen felhasználónév vagy email az adatbázisban
$check_sql = "SELECT * FROM user WHERE username = ? OR email = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ss", $username, $email);
$check_stmt->execute();
$check_result = $check_stmt->get_result();


//Üres mezők ellenőrzése
if ($password == "" || $username == "" || $email == "" || $image == "") {
    setcookie("missing_data", "true", time() + 3600, "/");
    header("Location: register.html");
} else {
    // SQL lekérdezés a felhasználó beszúrásához
    $insert_sql = "INSERT INTO user (username, email, password_hash, image) VALUES (?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("sss", $username, $email, $hashed_password, $image);

    if ($check_result->num_rows > 0) {
        // Már létezik ilyen felhasználónév vagy email cím
        setcookie("registration_exists", "true", time() + 3600, "/");
        header("Location: register.html");
        exit();
    } else {
        // Jelszó hashelése
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    }

    if ($insert_stmt->execute()) {
        session_start(); // Munkamenet indítása vagy folytatása
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        setcookie("registration_success", "true", time() + 3600, "/");
        header("Location: admin/index.php");
        exit();
    } else {
        echo "Hiba történt a regisztráció során: " . $insert_stmt->error;
    }

    $insert_stmt->close();
}

$check_stmt->close();
$conn->close();
?>