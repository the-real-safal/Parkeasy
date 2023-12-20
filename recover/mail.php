<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email=$_POST['email'];
}

?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
include ("../inc/connect.php");


?>


<?php
$sql = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userId = $row["id"];
}


$sql = "SELECT id, otp FROM otp WHERE user_id = (SELECT id FROM users WHERE email = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // If an OTP exists, delete it
    $sql_delete = "DELETE FROM otp WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $row["id"]);
    $stmt_delete->execute();
}
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

$sql = "INSERT INTO otp (user_id, otp) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $userId, $storedOTP);
$stmt->execute();



    // Prepare and execute a query to check if the email exists
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
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
