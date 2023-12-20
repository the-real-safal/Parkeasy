<!DOCTYPE html>
<html>
<head>
    <title>Banned</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
       <?php
       $status=1;
            // You can implement further processing here, such as sending an email to administrators with the unban request details.
if($status==0){

            // After processing, you can display a thank you message to the user.
            echo '<div class="alert alert-success">';
            echo '    <h4 class="alert-heading">Thank You</h4>';
            echo '    <p>Thank you for submitting your unban request. Your request will be reviewed by our administrators.</p>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-danger">';
            echo '    <h4 class="alert-heading">You Are Banned</h4>';
            echo '    <p>Your account has been restricted from using the service. If you believe this is an error or would like to request to unban your account, please fill out the form below:</p>';
            echo '</div>';

            echo '<form action="send_request.php" method="post">';
            echo '    <div class="form-group">';
            echo '        <label for="name">Name:</label>';
            echo '        <input type="text" class="form-control" id="name" name="name" required>';
            echo '    </div>';
            echo '    <div class="form-group">';
            echo '        <label for="email">Email:</label>';
            echo '        <input type="email" class="form-control" id="email" name="email" required>';
            echo '    </div>';
            echo '    <div class="form-group">';
            echo '        <label for="reason">Reason for unban request:</label>';
            echo '        <textarea class="form-control" id="reason" name="reason" required></textarea>';
            echo '    </div>';
            echo '    <input type="hidden" name="unban_request" value="true">';
            echo '    <button type="submit" class="btn btn-primary">Submit Request</button>';
            echo '</form>';
        }
        ?>
    </div>
</body>
</html>
