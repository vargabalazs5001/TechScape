<?php
include "email_select.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require '../html/PHPMailer/src/PHPMailer.php';
require '../html/PHPMailer/src/SMTP.php';
require '../html/PHPMailer/src/Exception.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which button was clicked
    if (isset($_POST["send_email"])) {
        sendEmail($_POST["email"], $_POST["subject"], $_POST["message"]);
    } elseif (isset($_POST["send_newsletter"])) {
        sendNewsletter($_POST["subject"], $_POST["message"]);
    }
}

// Function to send a single email
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

        // Send email
        $mail->send();
        echo "<script>alert('E-mail sikeresen elküldve a címzettnek'); window.location = 'email_send.php'</script>";
    } catch (Exception $e) {
        echo "<script>alert('Az e-mail elküldése sikeretelen volt! '); window.location = 'email_send.php'</script>";
    }
}

// Function to send a newsletter to all users
function sendNewsletter($subject, $message) {
    // Query all email addresses from your database
    $recipients = ["email1@example.com", "email2@example.com"]; // Placeholder, replace with actual email addresses from your database

    // Send email to each recipient
    foreach ($recipients as $recipient) {
        sendEmail($recipient, $subject, $message);
    }

    echo 'Hírlevél sikeresen elküldve!';
}
?>
