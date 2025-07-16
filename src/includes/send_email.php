<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendInvoiceEmail($toEmail, $username, $order, $items) {
    $mail = new PHPMailer(true);

    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Use your SMTP provider
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your_email@gmail.com'; // Your email
        $mail->Password   = 'your_email_password_or_app_password';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // From & To
        $mail->setFrom('your_email@gmail.com', 'FastFood Restaurant');
        $mail->addAddress($toEmail, $username);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Your FastFood Order Invoice';

        $body = "<h3>Hi $username,</h3>";
        $body .= "<p>Thank you for your order! Here’s your invoice:</p>";
        $body .= "<strong>Order ID:</strong> " . $order['id'] . "<br>";
        $body .= "<strong>Address:</strong> " . htmlspecialchars($order['delivery_address']) . "<br>";
        $body .= "<strong>Total:</strong> $" . $order['total'] . "<br><br>";
        $body .= "<ul>";

        foreach ($items as $item) {
            $body .= "<li>{$item['item_name']} x {$item['quantity']} = $" . ($item['price'] * $item['quantity']) . "</li>";
        }

        $body .= "</ul>";
        $body .= "<p>We hope you enjoy your meal!</p>";
        $body .= "<p>FastFood Restaurant</p>";

        $mail->Body = $body;

        $mail->send();
    } catch (Exception $e) {
        error_log("Email error: {$mail->ErrorInfo}");
    }
}
