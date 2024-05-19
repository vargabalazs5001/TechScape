<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require '../html/PHPMailer/src/PHPMailer.php';
require '../html/PHPMailer/src/SMTP.php';
require '../html/PHPMailer/src/Exception.php';

// Function to send newsletter to all registered users
function sendNewsletterToUsers($subject, $message) {
    include "../html/db_connect.php";

    $subject = "Ismerd meg az Új Funkciókat - Február 2024";
    $message = file_get_contents("newsletter.html");

    // Select all email addresses from the users table
    $sql = "SELECT email FROM user_data WHERE permission = 0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Iterate through each row and send newsletter
        while ($row = $result->fetch_assoc()) {
            $recipient = $row["email"];
            sendEmail($recipient, $subject, $message);
        }
        echo "Newsletter successfully sent to users";
    } else {
        echo "No users found in the database.";
    }

    $conn->close();
}

// Function to send email
function sendEmail($recipient, $subject, $message) {
    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'mail.nethely.hu';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mesterremek@techscape.szakdoga.net';
        $mail->Password   = 'Mesterremek01';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Email content
        $mail->setFrom('mesterremek@techscape.szakdoga.net', 'TechScape');
        $mail->addAddress($recipient);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        // Set character encoding
        $mail->CharSet = 'UTF-8';

        // Send email
        $mail->send();
        echo "<script>alert('Hírlevél sikeresen elküldve a címzetteknek'); window.location = 'email_send.php'</script>";
    } catch (Exception $e) {
        echo "<script>alert('A hírlevél elküldése sikeretelen volt! '); window.location = 'email_send.php'</script>";
    }
}

// Usage
sendNewsletterToUsers($subject, $message);
