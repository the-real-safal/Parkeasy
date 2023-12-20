<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Forgot Password</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="mail.php">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                    <div class="mt-3 text-center">
                        <p>Remember your password? <a href="../loginpage.php">Go back to login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Bootstrap JS and jQuery scripts here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"]; // Get the email from the form
    
    // You can add further processing here, such as sending a password reset email
       // Generate a unique OTP
       $otp = mt_rand(100000, 999999); // Generates a 6-digit random OTP.

       $sql = "UPDATE otp SET otp = ? WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $otp);
$stmt->execute();

    
    // Redirect to another page with the email data
    header("Location: mail.php?email=".urlencode($email));
    exit;
}
?>
