<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
//require_once __DIR__ . '/../vendor/autoload.php'; 

function sendPaymentSuccessEmail($customerEmail) {
    try {
        $mail = new PHPMailer(true);

        // SMTP Configuration (Using Gmail)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mazds.web@gmail.com'; // Gmail address
        $mail->Password = 'dgpxbmxhndglfgbh'; // Gmail app password
        $mail->SMTPSecure = 'tls'; // Use 'tls' for encryption
        $mail->Port = 587; // Use 587 for TLS, or 465 for SSL

        // Email Content
        $mail->setFrom('mazds.web@gmail.com', 'JB Barbershop'); // Sender
        $mail->addAddress($customerEmail); // Recipient
        $mail->Subject = 'Payment Successful';
        $mail->Body    = "Dear Customer,\n\nYour payment was successful!\n\nThank you for Booking with us.\n\nBest Regards,\nJB Barbershop Team";

        // Send Email
        if ($mail->send()) {
            file_put_contents(__DIR__ . "/../logs/email_log.txt",
                date("Y-m-d H:i:s") . " - Email sent to: " . $customerEmail . PHP_EOL, FILE_APPEND);
            return true;
        } else {
            file_put_contents(__DIR__ . "/../logs/email_log.txt",
                date("Y-m-d H:i:s") . " - Email sending failed: " . $mail->ErrorInfo . PHP_EOL, FILE_APPEND);
            return false;
        }
    } catch (Exception $e) {
        file_put_contents(__DIR__ . "/../logs/email_log.txt",
            date("Y-m-d H:i:s") . " - PHPMailer Exception: " . $mail->ErrorInfo . PHP_EOL, FILE_APPEND);
        return false;
    }
}
?>
