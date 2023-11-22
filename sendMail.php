<?php
// Файлы phpmailer

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: Content-Type");

require 'phpMailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'phpmailer/PHPMailer.php';
// require 'phpmailer/SMTP.php';
// require 'phpmailer/Exception.php';


$name = $_POST['name'];
$email = $_POST['email'];
$quantity = $_POST['quantity'];
$destination = $_POST['destination'];
$message = $_POST['message'];

// Формування листа
$title = "Mail from Plan Voyage";
$body = "
<b>name:</b> $name<br>
<b>email:</b> $email<br>
<b>Number of travelers:</b> $quantity<br>
<b>destination:</b> $destination<br><br>
<b>message:</b><br>$message
";

// Настройки PHPMailer
$mail = new PHPMailer(true);

echo ($title.'________'.$body);

try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('PlanVoyageNewMail@mail.com', 'new client'); // Адрес пошти
    $mail->addAddress('t0n9hua@gmail.com');  

    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;    
    $mail->send();
    echo "Mail has been sent successfully!";

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>