<?php
// Retrieve the data from query parameters
$id = $_GET['id'];
$date = $_GET['date'];
$name = $_GET['name'];
$user_email = $_GET['user_email'];
$area_name = $_GET['area_name'];
$lot_no = $_GET['lot_no'];
$duration = $_GET['duration'];
$charge = $_GET['charge'];
$status = $_GET['status'];
$pay_id = $_GET['pay_id'];
$ref_id = $_GET['ref_id'];



// Output the received data and the "Approve Payment" button
echo '<!DOCTYPE html>
<html>
<head>
    <title>Approval Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Approval Details</h2>
        <table class="table table-bordered">
            <tbody>
                <tr><td><strong>ID:</strong></td><td>' . htmlspecialchars($id) . '</td></tr>
                <tr><td><strong>Date:</strong></td><td>' . htmlspecialchars($date) . '</td></tr>
                <tr><td><strong>Name:</strong></td><td>' . htmlspecialchars($name) . '</td></tr>
                <tr><td><strong>Email:</strong></td><td>' . htmlspecialchars($user_email) . '</td></tr>
                <tr><td><strong>Area:</strong></td><td>' . htmlspecialchars($area_name) . '</td></tr>
                <tr><td><strong>Lot No.:</strong></td><td>' . htmlspecialchars($lot_no) . '</td></tr>
                <tr><td><strong>Duration:</strong></td><td>' . htmlspecialchars($duration) . '</td></tr>
                <tr><td><strong>Charge:</strong></td><td>' . htmlspecialchars($charge) . '</td></tr>
                <tr><td><strong>Status:</strong></td><td>' . htmlspecialchars($status) . '</td></tr>
                <tr><td><strong>Transaction ID:</strong></td><td>' . htmlspecialchars($pay_id) . '</td></tr>
                <tr><td><strong>Reference ID:</strong></td><td>' . htmlspecialchars($ref_id) . '</td></tr>
            </tbody>
        </table>
        
        <a href="paid.php?id=' . htmlspecialchars($id) . '&email=' . htmlspecialchars($user_email) . '&pay_id=' . htmlspecialchars($pay_id) . '" class="btn btn-success">Approve Payment</a>
    </div>
</body>
</html>';

?>
