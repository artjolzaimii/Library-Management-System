<?php
require_once __DIR__ . '/mail/PHPMailer.php';
require_once __DIR__ . '/mail/SMTP.php';
require_once __DIR__ . '/mail/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($to, $subject, $message, $recipientName = '') {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Change if using another provider
        $mail->SMTPAuth = true;
        $mail->Username = 'eternallibray13@gmail.com'; // Your Gmail address
        $mail->Password = 'zbcdurxhxkvxxtfi';    // App password from Google
        $mail->SMTPSecure = 'tls'; // Encryption: 'tls' or 'ssl'
        $mail->Port = 587;         // 587 for TLS, 465 for SSL

        // Recipients
        $mail->setFrom('library@example.com', 'Library');
        $mail->addAddress($to, $recipientName);

        // Content
        $mail->isHTML(false); // true if sending HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mail error: {$mail->ErrorInfo}");
        return false;
    }
}
?>
