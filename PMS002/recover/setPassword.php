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
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

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
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" id="submitButton">Set New Password</button>
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
