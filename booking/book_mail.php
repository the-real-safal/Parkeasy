<?php 
session_start();
$email=$_SESSION['email'];
$name=$_SESSION['name'];

?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
include ("../inc/connect.php");
?>




<?php

// $otp = mt_rand(100000, 999999); // Generates a 6-digit random OTP.
// $storedOTP = $otp;

// $sql = "INSERT INTO otp (email, otp) VALUES (?, ?)";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("ss", $email, $storedOTP);
// $stmt->execute();



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

$subject="Thank You for Booking a Parking Lot";

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
            $mail->Body    = "Dear ".$email.",<br><br>We want to express our gratitude for choosing ParkEasy for your parking needs. We are pleased to confirm that you have successfully booked a parking lot in our facility.<br><br>Thank you for trusting ParkEasy for your parking requirements. We are committed to providing a seamless and convenient parking experience for you. If you have any questions or need assistance, please feel free to contact our customer support team.<br><br>Once again, thank you for choosing ParkEasy. We look forward to serving you.<br><br>Best Regards,<br>The ParkEasy Team
            ";
            $mail->AltBody = ' ';
        
            $mail->send();
            
         
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
        $encodedData = urlencode($email);
        ?>
        <script>
window.location.href =" <?php echo "../unbooking/index.php?data="; ?>";
            </script>
            <?php
    } else {
        echo "Email not found. Try Again";
        
    }

    // Close the statement
    $stmt->close();

?>
