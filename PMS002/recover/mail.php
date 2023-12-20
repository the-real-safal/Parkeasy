<?php 
$email=$_POST['email'];
$resetLink = $_GET["data"];
?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
include ("../inc/connect.php");
?>




<?php

$otp = mt_rand(100000, 999999); // Generates a 6-digit random OTP.
$storedOTP = $otp;

$sql = "INSERT INTO otp (email, otp) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $storedOTP);
$stmt->execute();



    // Prepare and execute a query to check if the email exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // // Display user data
        // echo "User Data for Email: " . $row["email"] . "<br>";
        // echo "Name: " . $row["name"] . "<br>";
        // echo "Age: " . $row["age"] . "<br>";
        // // Add more columns as needed
        $name=$row["name"];

$subject="Password Reset OTP";

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
            $mail->setFrom('parkeasycompany@gmail.com', 'Park Easy');
            $mail->addAddress($email, $name);     // Add a recipient
            //$mail->addReplyTo('123santoshrimal@gmail.com', 'ToleSudharSamiti');
        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = 'This is your password reset OTP. <b>'.$otp.'</b> ';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients ';
        
            $mail->send();
            
         
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
        $encodedData = urlencode($email);
        ?>
        <script>
window.location.href =" <?php echo "verify.php?data=".$encodedData; ?>";
            </script>
            <?php
    } else {
        echo "Email not found. Try Again";
        
    }

    // Close the statement
    $stmt->close();

?>
