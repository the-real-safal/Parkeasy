<?php
include("../inc/connect.php");
$email = $_GET["data"];
//echo "Received Data: $email";

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
    <style>
        /* Add styles for the background SVG */
        .background-svg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: -1;
            /* Move the SVG background to the back */
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- Background SVG -->
    <svg class="background-svg" preserveAspectRatio="xMidYMid slice" viewBox="10 10 80 80">
        <defs>
            <style>
                @keyframes rotate {
                    0% {
                        transform: rotate(0deg);
                    }

                    100% {
                        transform: rotate(360deg);
                    }
                }

                .out-top {
                    animation: rotate 20s linear infinite;
                    transform-origin: 13px 25px;
                }

                .in-top {
                    animation: rotate 10s linear infinite;
                    transform-origin: 13px 25px;
                }

                .out-bottom {
                    animation: rotate 25s linear infinite;
                    transform-origin: 84px 93px;
                }

                .in-bottom {
                    animation: rotate 15s linear infinite;
                    transform-origin: 84px 93px;
                }
            </style>
        </defs>
        <path fill="#9b5de5" class="out-top"
            d="M37-5C25.1-14.7,5.7-19.1-9.2-10-28.5,1.8-32.7,31.1-19.8,49c15.5,21.5,52.6,22,67.2,2.3C59.4,35,53.7,8.5,37-5Z" />
        <path fill="#f15bb5" class="in-top"
            d="M20.6,4.1C11.6,1.5-1.9,2.5-8,11.2-16.3,23.1-8.2,45.6,7.4,50S42.1,38.9,41,24.5C40.2,14.1,29.4,6.6,20.6,4.1Z" />
        <path fill="#00bbf9" class="out-bottom"
            d="M105.9,48.6c-12.4-8.2-29.3-4.8-39.4.8-23.4,12.8-37.7,51.9-19.1,74.1s63.9,15.3,76-5.6c7.6-13.3,1.8-31.1-2.3-43.8C117.6,63.3,114.7,54.3,105.9,48.6Z" />
        <path fill="#00f5d4" class="in-bottom"
            d="M102,67.1c-9.6-6.1-22-3.1-29.5,2-15.4,10.7-19.6,37.5-7.6,47.8s35.9,3.9,44.5-12.5C115.5,92.6,113.9,74.6,102,67.1Z" />
    </svg>
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
                            $stmt->bind_param("i", $userId);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $storedOTP = $row["otp"];

                                if ($enteredOTP == $storedOTP) {
                                    echo "<p class='alert alert-success'>OTP matched! User verified.</p>";

                                    //Delete OTP
                                    $sqlDelete = "DELETE FROM otp WHERE otp = ?";
                                    $stmtDelete = $conn->prepare($sqlDelete);
                                    $stmtDelete->bind_param("i", $storedOTP);
                                    $stmtDelete->execute();

                                    $encodedData = urlencode($email);
                                    header("Location: setPassword.php?data=$encodedData");
                                    exit();
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
                            <input type="hidden" id="email" name="email" value="<?php echo $_GET["data"]; ?>">
                            <button type="submit" class="btn btn-primary">Verify OTP</button>
                            


                        </form>
                        <form method="POST" action="mail.php">
                        <div id="countdown">
                                <p>Resend OTP in <span id="timer">60</span> seconds</p>
                                <input type="hidden" id="email" name="email" value="<?php echo $_GET["data"]; ?>">
                                <button id="resendButton" class="btn btn-link" style="display: none;">Resend
                                    OTP</button>
                            </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and jQuery scripts here -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Add this JavaScript code after including jQuery and Bootstrap scripts -->
<script>
    // Function to start the countdown timer
    function startCountdown() {
        var seconds = 10; // 60 seconds countdown
        var timerElement = document.getElementById('timer');
        var resendButton = document.getElementById('resendButton');

        var countdownInterval = setInterval(function () {
            seconds--;
            timerElement.innerText = seconds;

            if (seconds <= 0) {
                clearInterval(countdownInterval);
                resendButton.style.display = 'block';
            }
        }, 1000);
    }

    // Call the startCountdown function to start the countdown timer
    startCountdown();
</script>




</body>

</html>