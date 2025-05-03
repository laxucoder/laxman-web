<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // PHPMailer ko include kariye

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  
        $mail->SMTPAuth   = true;
        $mail->Username   = 'laxucoder@gmail.com';     // 👈 Aapka email
        $mail->Password   = 'fufr jvae cvuh dnxv';       // 👈 Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender and Recipient
        $mail->setFrom($email, $name);                 // Visitor ka email as sender
        $mail->addAddress('laxucoder@gmail.com');      // 👈 Aapko message yaha milega

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "
            <h3>Message from: $name</h3>
            <p>Email: $email</p>
            <p>Subject: $subject</p>
            <p>Message: $message</p>";

        $mail->send();
        
        // Redirect after sending
        header("Location: thank-you.html");
        exit();
    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
}
?>
