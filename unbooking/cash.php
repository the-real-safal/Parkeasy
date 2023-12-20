<?php 
session_start();
$user = $_SESSION['name'];
$id = $_SESSION['uid'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cash Payment Confirmation</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Cash Payment Confirmation</h1>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $amt = $_POST['amt'];
                            $txAmt = $_POST['txAmt'];
                            $tAmt = $_POST['tAmt'];
                            $pid = $_POST['pid'];
                            echo "<p class='card-text'><strong>User Id:</strong> " . htmlspecialchars($id) . "</p>";
                            echo "<p class='card-text'><strong>Username:</strong> " . htmlspecialchars($user) . "</p>";
                            echo "<p class='card-text'><strong>Amount:</strong> $" . htmlspecialchars($amt) . "</p>";
                            echo "<p class='card-text'><strong>Tax Amount:</strong> $" . htmlspecialchars($txAmt) . "</p>";
                            echo "<p class='card-text'><strong>Total Amount:</strong> $" . htmlspecialchars($tAmt) . "</p>";
                            echo "<p class='card-text'><strong>Transaction Code:</strong> " . htmlspecialchars($pid) . "</p>";
                        } else {
                            echo "<p class='card-text text-center'>Form data has not been submitted.</p>";
                        }
                        ?>
                    </div>
                    <div class="card-footer text-center">
                        <a href="payment_cash.php?id=<?php echo $id; ?>&user=<?php echo $user; ?>&amt=<?php echo $amt; ?>&txAmt=<?php echo $txAmt; ?>&tAmt=<?php echo $tAmt; ?>&pid=<?php echo $pid; ?>" class="btn btn-success">Confirm Payment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
