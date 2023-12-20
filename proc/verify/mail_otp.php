<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';
include ("../../inc/connect.php");

$email = $_GET['email'];

function generateCustomOTP($length)
{
    $otp = '';
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charCount = strlen($characters);
    $isLetter = true;
    for ($i = 0; $i < $length; $i++) {
        if ($isLetter) {
            $randomIndex = rand(0, 25); 
        } else {
            $randomIndex = rand(26, $charCount - 1); 
        }
        $otp .= $characters[$randomIndex];
        $isLetter = !$isLetter;
    }
    return $otp;
}
$otp = generateCustomOTP(6);
$storedOTP = $otp;

// Prepare and execute a query to check if the email exists
$sql = "SELECT id, name FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userId = $row["id"];
    $name = $row["name"];
    
    // Store OTP with user ID
    $otpSql = "INSERT INTO otp (user_id, otp) VALUES (?, ?)";
    $otpStmt = $conn->prepare($otpSql);
    $otpStmt->bind_param("is", $userId, $storedOTP);
    $otpStmt->execute();
    $otpStmt->close();

    $subject = "Verify OTP";

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'parkeasycompany@gmail.com';         // SMTP username
        $mail->Password = 'eyvfkgcdeqhdmxgc';                 // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
    
        // Recipients
        $mail->setFrom('parkeasycompany@gmail.com', 'Park Easy');
        $mail->addAddress($email, $name);     // Add a recipient
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = 'Please verify your account using this OTP. <b>' . $otp . '</b> ';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients ';
    
        $mail->send();
        
        // Redirect to the verification page
        $encodedData = urlencode($email);
        echo "<script>window.location.href = 'verify.php?data=" . $encodedData . "';</script>";
        exit();
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
} else {
    echo "Email not found. Try Again";
}

// Close the statement
$stmt->close();
?>
