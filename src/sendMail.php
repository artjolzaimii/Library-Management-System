<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once( '../mail/PHPMailer.php');
require_once ('../mail/SMTP.php');
require_once ('../mail/Exception.php');


function sendMail($to, $subject, $message, $recipientName = '') {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Change if using another provider
        $mail->SMTPAuth = true;
        $mail->Username = 'eternallibrary13@gmail.com'; // Your Gmail address
        $mail->Password = 'dpaabcflzzssislp';    // App password from Google
        $mail->SMTPSecure = 'tls'; // Encryption: 'tls' or 'ssl'
        $mail->Port = 587;         // 587 for TLS, 465 for SSL

        // Recipients
        $mail->setFrom('eternallibrary13@gmail.com', 'Library');
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
