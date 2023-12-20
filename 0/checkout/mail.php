<?php 
include ("../inc/connect.php");
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo $id;
    // Now you can safely use the $id variable
    // Your code to process the id goes here
} else {
    // Handle the case where 'id' is not present in the URL
    // You can show an error message or perform some other action
    echo "ID parameter is missing.";
}
// Extract aid from email
$sql = "SELECT * FROM booking WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id); // Use $id instead of $booking_id
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userId= $row["user_id"];
    // Now $row should be defined with the retrieved data
    // You can access the data as needed
} else {
    echo "Booking not found. Try Again";
}


// Extract name from uid
$sql = "SELECT * FROM users WHERE id =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $email = $row["email"];
}


date_default_timezone_set('Asia/Kathmandu'); // Set the time zone to Kathmandu
//$current_time = date('Y-m-d H:i:s');
$date=date('Y-m-d');
?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';

?>




<?php

// $otp = mt_rand(100000, 999999); // Generates a 6-digit random OTP.
// $storedOTP = $otp;

// $sql = "INSERT INTO otp (email, otp) VALUES (?, ?)";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("ss", $email, $storedOTP);
// $stmt->execute();

// Prepare and execute a query to check if the email exists
$sql = "SELECT * FROM booking WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // // Display user data
    // echo "User Data for Email: " . $row["email"] . "<br>";
    // echo "Name: " . $row["name"] . "<br>";
    // echo "Age: " . $row["age"] . "<br>";
    // // Add more columns as needed
}


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
        $date = date("Y-m-d H:i:s");

$subject="Checked Out";

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
        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = "Dear ".$name.",<br><br><b>Checkout Successful!</b><br>Date: ".$date."<br>";
            $mail->AltBody = ' ';
        
            $mail->send();
            
         
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
        $encodedData = urlencode($email);
        ?>
        <script>
window.location.href =" <?php echo "../booking.php"; ?>";
            </script>
            <?php
    } else {
        echo "Email not found. Try Again";
        
    }

    // Close the statement
    $stmt->close();

?>
