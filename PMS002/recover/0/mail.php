<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'irakihda.lafas@gmail.com';          // SMTP username
    $mail->Password = 'pqampxtaairlriec';              // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('irakihda.lafas@gmail.com', 'Park Easy');
    $mail->addAddress('lucifer.safal@gmail.com', 'Safal Adhikari');     // Add a recipient
    //$mail->addReplyTo('123santoshrimal@gmail.com', 'ToleSudharSamiti');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'About Your Random Password';
    $mail->Body    = 'This is test message <b>Hello Safal</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients ';

    $mail->send();
    
 
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

 ?>