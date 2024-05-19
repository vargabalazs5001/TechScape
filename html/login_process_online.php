<?php
error_reporting(E_ALL);

// Adatbázis kapcsolódás
include "db_connect.php";

// Űrlapból érkező adatok
$user_email = $_POST['email'];
$user_password = $_POST['password'];

// SQL lekérdezés a felhasználó ellenőrzéséhez
$sql = "SELECT * FROM user_data WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

$login_successful = false; // inicializáljuk a változót

if ($result->num_rows > 0) {
    // A felhasználó létezik, ellenőrizzük a jelszót és a jogosultságot
    $user_data = $result->fetch_assoc();
    if (password_verify($user_password, $user_data['password_hash'])) {
        // Sikeres belépés
        session_start(); // Munkamenet indítása vagy folytatása
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $user_email;
        $_SESSION['permission'] = $user_data['permission']; // Eltároljuk a jogosultságot is a munkamenetben

        if ($_SESSION['permission'] == 1) {
            // Admin felhasználó
            header("Location: ../admin/index.php");
        } else {
            // Sima felhasználó
            header("Location: ../html/index.php");
        }
        exit();
    } else {
        // Helytelen jelszó
        echo "<script>alert('Hibás felhasználónév vagy jelszó'); window.location = 'login_html.php';</script>";
    }
} else {
    // Nincs ilyen felhasználó
    echo "<script>alert('Hibás felhasználónév vagy jelszó'); window.location = 'login_html.php';</script>";
}

// Ha a bejelentkezés sikeres
if ($login_successful) {
    // Felhasználó adatainak lekérdezése az adatbázisból
    $username = $_POST['username'];
    $query = "SELECT image FROM user_data WHERE username = '$username'";
    $result = $mysqli->query($query);

    if ($result) {
        // Az adatok kiolvasása
        $row = $result->fetch_assoc();
        $imageName = $row['image'];

        // Kép megjelenítése
        $imagePath = "uploads/" . $imageName;
        echo "<img src='$imagePath' alt='Felhasználó képe'>";
    } else {
        echo "Hiba a lekérdezés során: " . $mysqli->error();
    }
}

$stmt->close();

$conn->close();
?>
