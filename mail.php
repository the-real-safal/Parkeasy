<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Theme Example</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Enter your details</h5>
            <form method="post" action="<?php echo  $_SERVER['PHP_SELF']; ?>"> 
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
              </div>
              <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" id="Subject" name="subject" placeholder="Purpose of your message">
              </div>
              <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message"></textarea>
              </div>
              <input type="submit" class="btn btn-primary" name="submit" value="submit">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Include Bootstrap JS and jQuery -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
if(isset($_REQUEST['submit'])){
  $name=$_REQUEST['name'];
  $email=$_REQUEST['email'];
  $subject=$_REQUEST['subject']; 
  $message=$_REQUEST['message'];
  
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'parkeasycompany@gmail.com';          // SMTP username
    $mail->Password = 'eyvfkgcdeqhdmxgc';              // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('irakihda.lafas@gmail.com', 'Park Easy');
    $mail->addAddress($email, 'Safal Adhikari');     // Add a recipient
    //$mail->addReplyTo('123santoshrimal@gmail.com', 'ToleSudharSamiti');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = '<b>'.$message.'</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients ';

    $mail->send();
    
 
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

}?>