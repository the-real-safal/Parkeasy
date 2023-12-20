<?php 
session_start();
$area=$_SESSION["area"];
$lot_no=$_SESSION["lot_no"];
$status=$_SESSION["status"];
$name=$_SESSION["name"];
$email=$_SESSION["email"];
$duration=$_SESSION["duration"];
$fee=$_SESSION["parking_fee"];
$booking_id = $_SESSION["booking_id"];

date_default_timezone_set('Asia/Kathmandu'); // Set the time zone to Kathmandu
//$current_time = date('Y-m-d H:i:s');
$date=date('Y-m-d');
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
            $mail->Body    = "Dear ".$email.",<br><br><b>Unbooking Successful!</b><br>Date: ".$date."<br>Booking ID: ".$booking_id."<br>Parking Area: ".$area."<br>Lot Number: ".$lot_no."<br>Duration: ".$duration."<br>Fee: RS. ".$fee."<br>";
            $mail->AltBody = ' ';
        
            $mail->send();
            
         
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
        $encodedData = urlencode($email);
        ?>
        <script>
window.location.href =" <?php echo "index.php"; ?>";
            </script>
            <?php
    } else {
        echo "Email not found. Try Again";
        
    }

    // Close the statement
    $stmt->close();

?>
