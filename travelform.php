<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust the path to autoload.php based on your project

// Check if the form is submitted
//-----Contact form------

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assign POST data to variables
    $contactname = $_POST['customer_name'] ?? '';
    $contactemail = $_POST['customer_email'] ?? '';
    // $contactsubject = $_POST['address'] ?? '';
    $contactnumber = $_POST['customer_phone'] ?? '';
    // $contactmessage = $_POST['contactmessage'] ?? '';

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings for Gmail SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kakinadahub2025@gmail.com'; // Your Gmail email address
        $mail->Password = 'vxwtwaffmadlkoir'; // Your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('kakinadahub2025@gmail.com', 'kakinadahub.com'); // Your Gmail email and name
        $mail->addAddress('kakinadahub2025@gmail.com', 'kakinadahub.com'); // Recipient's email and name

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Message from Kakinada hub';
        $mail->Body = "
           
        <h1>from travels</h1>
            <h1>Contact Details</h1>
            <p><strong>Name:</strong> $contactname</p>
            <p><strong>Email:</strong> $contactemail</p>
            <p><strong>Phone:</strong> $contactnumber</p>
        ";

        $mail->send();
        echo '<script> window.alert("Message has been sent.\n\nPlease click OK."); window.location.href="index.php";</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // If accessed directly without POST data
    echo 'Access Denied';
}
