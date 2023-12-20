<?php
include "../inc/connect.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate OTP</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Generate OTP</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST["email"]; // Get the email from the form
                
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
                
                // Store the OTP in a variable
                $storedOTP = $otp;

                $sql = "UPDATE otp SET otp = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $generatedOTP, $email);
    $stmt->execute();


                echo "<p class='alert alert-success'>An OTP has been generated and stored for the email: $email</p>";
                echo "<p>Generated OTP: $otp</p>";
            }
            ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="email">Enter Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary">Generate OTP</button>
            </form>
        </div>
    </div>
</div>

<!-- Add Bootstrap JS and jQuery scripts here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</body>
</html>
