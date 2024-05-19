<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../html/PHPMailer/src/PHPMailer.php';
require '../html/PHPMailer/src/SMTP.php';
require '../html/PHPMailer/src/Exception.php';

// Függvények definíciója
function processOrder($recipient, $action, $conn) {
    // Az e-mail küldése előtt ellenőrizzük, hogy van-e ilyen e-mail cím az adatbázisban
    $sql = "SELECT email FROM order_items WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $recipient);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Ha találunk egyezést az adatbázisban, akkor küldjük el az e-mailt
        sendEmail($recipient, $action);
    } else {
        // Ha nincs egyezés az adatbázisban, akkor hibaüzenetet adunk vissza
        echo "<script>alert('A megadott e-mail cím nem található az adatbázisban!'); window.location = 'index.php'</script>";
    }

    $stmt->close();
}

function sendEmail($recipient, $action)
{
    // PHPMailer inicializálása
    $mail = new PHPMailer(true);
    try {
        // SMTP beállítások
        $mail->isSMTP();
        $mail->Host = 'mail.nethely.hu'; // SMTP szerver címe
        $mail->SMTPAuth = true;
        $mail->Username = 'mesterremek@techscape.szakdoga.net'; // SMTP felhasználónév
        $mail->Password = 'Mesterremek01'; // SMTP jelszó
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Titkosítási mód
        $mail->Port = 587; // SMTP port

        // Feladó és címzett beállítása
        $mail->setFrom('mesterremek@techscape.szakdoga.net', 'TechScape');
        $mail->addAddress($recipient);

        // Email beállítások
        $mail->isHTML(true); // HTML formátum
        $mail->Subject = 'Rendelés státusza frissült'; // Email tárgya
        $mail->Body = 'Kedves Felhasználó, a rendelés státusza frissült! <br> Új státusz: ' . $action; // Email tartalma

        // E-mail küldése
        $mail->CharSet = 'UTF-8'; // Karakterkódolás beállítása
        $mail->send(); // Email küldése
        echo "<script>alert('Az e-mail sikeresen elküldve.'); window.location = 'index.php'</script>"; // Sikeres üzenet
    } catch (Exception $e) {
        echo "<script>alert('Hiba történt az e-mail küldése közben: {$mail->ErrorInfo}'); window.location = 'index.php'</script>"; // Hibaüzenet
    }
}

// Ellenőrizzük, hogy valóban érkezett-e POST kérés
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        // Az e-mail változóba mentése és ellenőrzése
        if (isset($_POST['email'])) {
            $recipient = $_POST['email'];
            if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('Érvénytelen e-mail cím!'); window.location = 'index.php'</script>";
                exit(); // Kilépés a folyamatból, ha az e-mail cím érvénytelen
            }

            // A kapcsolatot tartalmazó fájl elérési útjának megadása
            include "../html/db_connect.php";

            // Az adott műveletnek megfelelő függvény meghívása
            processOrder($recipient, $action, $conn);
        } else {
            // Ha nincs érvényes e-mail adat a POST-ban
            echo "<script>alert('Hiányzó e-mail cím!'); window.location = 'index.php'</script>";
            exit(); // Kilépés a folyamatból
        }
    } else {
        // Ha nincs érvényes művelet a POST-ban
        echo "<script>alert('Hiányzó művelet!'); window.location = 'index.php'</script>";
        exit(); // Kilépés a folyamatból
    }
} else {
    // Ha nem érkezett POST kérés
    echo "<script>alert('Hiányzó POST adatok!'); window.location = 'index.php'</script>";
    exit(); // Kilépés a folyamatból
}