<?php
session_start();
include ("../../inc/connect.php");
$email=$_GET['data'];


$sql = "SELECT id FROM users WHERE email = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userId = $row["id"];

}

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>OTP Verification</h4>
                </div>
                <div class="card-body">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $enteredOTP = $_POST["entered_otp"]; // Get the entered OTP from the form
                        

                      

                        // Retrieve the stored OTP for the entered email
                        $sql = "SELECT otp FROM otp WHERE user_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $userId);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $storedOTP = $row["otp"];
                            
                            if ($enteredOTP == $storedOTP) {
                                echo "<p class='alert alert-success'>OTP matched! User verified.</p>";
                            
                                // Delete OTP based on the email
                                $sqlDelete = "DELETE FROM otp WHERE user_id = ?";
                                $stmtDelete = $conn->prepare($sqlDelete);
                                $stmtDelete->bind_param("s", $userId);
                                $stmtDelete->execute();

                                 // Update verification status in the user table
                                $updateSql = "UPDATE users SET verification = 'YES' WHERE id = ?";
                                $stmtUpdate = $conn->prepare($updateSql);
                                $stmtUpdate->bind_param("s", $userId);
                                $stmtUpdate->execute();
                                
                                // Display success message and redirect after a delay
                                echo "<p class='alert alert-success'>You are now verified. Continue browsing.</p>";
                                echo "<script>
                                    setTimeout(function() {
                                        window.location.href = '../../index.php';
                                    }, 3000); // Redirect after 3 seconds
                                </script>";
                            } else {
                                echo "<p class='alert alert-danger'>OTP did not match. Verification failed.</p>";
                            }
                            
                        } else {
                            echo "<p class='alert alert-danger'>Email not found.</p>";
                        }

                        // Close the statement
                        $stmt->close();
                    }
                    ?>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="entered_otp">Enter OTP:</label>
                            <input type="text" class="form-control" id="entered_otp" name="entered_otp" required>
                        </div>
                        <input type="hidden" name="email" value="<?php echo $_GET['data']; ?>">
                        <button type="submit" class="btn btn-primary">Verify OTP</button>
                    </form>
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
