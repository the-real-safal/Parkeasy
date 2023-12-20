<?php
$email = $_GET["data"];
//echo "Received Data: $email";
include "../inc/connect.php"
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password</title>
    <!-- Add Bootstrap CSS link here -->\
    <style>
        /* Add styles for the background SVG */
        .background-svg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: -1; /* Move the SVG background to the back */
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
        <path fill="#9b5de5" class="out-top" d="M37-5C25.1-14.7,5.7-19.1-9.2-10-28.5,1.8-32.7,31.1-19.8,49c15.5,21.5,52.6,22,67.2,2.3C59.4,35,53.7,8.5,37-5Z"/>
        <path fill="#f15bb5" class="in-top" d="M20.6,4.1C11.6,1.5-1.9,2.5-8,11.2-16.3,23.1-8.2,45.6,7.4,50S42.1,38.9,41,24.5C40.2,14.1,29.4,6.6,20.6,4.1Z"/>
        <path fill="#00bbf9" class="out-bottom" d="M105.9,48.6c-12.4-8.2-29.3-4.8-39.4.8-23.4,12.8-37.7,51.9-19.1,74.1s63.9,15.3,76-5.6c7.6-13.3,1.8-31.1-2.3-43.8C117.6,63.3,114.7,54.3,105.9,48.6Z"/>
        <path fill="#00f5d4" class="in-bottom" d="M102,67.1c-9.6-6.1-22-3.1-29.5,2-15.4,10.7-19.6,37.5-7.6,47.8s35.9,3.9,44.5-12.5C115.5,92.6,113.9,74.6,102,67.1Z"/>
    </svg>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Set New Password</h4>
                </div>
                <div class="card-body">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $newPassword = $_POST["new_password"]; // Get the new password from the form
                        $confirmPassword = $_POST["confirm_password"]; // Get the confirm password from the form

                        if ($newPassword == $confirmPassword) {
                            // Hash the new password before updating
                            //$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                            // Prepare and execute a query to update the password
                            $sql = "UPDATE users SET password = ? WHERE email = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ss", $newPassword, $email);
                            $stmt->execute();

                            echo "<p class='text-success'>Password updated successfully.</p>";
                            header ("Location:../loginpage.php");
                        } else {
                            echo "<p class='text-danger'>Passwords do not match. Please try again.</p>";
                        }
                    }
                    ?>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
                            <div id="password-validation"></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" id="submitButton" disabled>Set New Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Bootstrap JS and jQuery scripts here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  const passwordInput = document.getElementById('new_password');
  const confirmPasswordInput = document.getElementById('confirm_password');
  const passwordValidation = document.getElementById('password-validation');
  const submitButton = document.getElementById('submitButton');

  const validatePassword = () => {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    const lengthRegex = /.{8,}/;
    const uppercaseRegex = /[A-Z]/;
    const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;
    const numberRegex = /\d/;

    let message = '';

    if (!lengthRegex.test(password)) {
      message += 'Password must have at least 8 characters. ';
    }
    if (!uppercaseRegex.test(password)) {
      message += 'Password must have at least 1 uppercase letter. ';
    }
    if (!specialCharRegex.test(password)) {
      message += 'Password must have at least 1 special character. ';
    }
    if (!numberRegex.test(password)) {
      message += 'Password must have at least 1 number. ';
    }

    if (password === confirmPassword && message === '') {
      passwordValidation.innerHTML = '<p class="text-success">Password is valid.</p>';
      submitButton.removeAttribute('disabled');
    } else {
      passwordValidation.innerHTML = '<p class="text-danger">' + message + '</p>';
      submitButton.setAttribute('disabled', 'true');
    }
  };

  passwordInput.addEventListener('input', validatePassword);
  confirmPasswordInput.addEventListener('input', validatePassword);
</script>

</body>
</html>
