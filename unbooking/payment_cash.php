<?php
include "../inc/connect.php";
include('../inc/insert.php');
// Retrieve payment details from the query parameters
$userId = $_GET['id'];
$user = $_GET['user'];
$amt = $_GET['amt'];
$txAmt = $_GET['txAmt'];
$amount = $_GET['tAmt'];
$pid = $_GET['pid'];

// Process the payment (you can implement your payment logic here)

// For demonstration, let's display the payment details
session_start();
$area = $_SESSION["area"];


$current_time = new DateTime();

// Updating into transaction table
$getLastIdQuery = "SELECT MAX(id) FROM transaction";
$getLastIdResult = $conn->query($getLastIdQuery);
$lastId = $getLastIdResult->fetch_row()[0];

// Calculate the new id by incrementing the last id by one
$newId = $lastId + 1;

date_default_timezone_set('Asia/Kathmandu'); // Set the time zone to Kathmandu
$date = date('Y-m-d');

// Extract aid from email
$sql = "SELECT id FROM areas WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $area);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $areaId = $row["id"];
}

$lot_no = $_SESSION["lot_no"];

$duration = $_SESSION["duration"];

$plate_no = $_SESSION["plate_no"];
$e_date = $_SESSION["e_date"];
$status = $_SESSION["status"];
$name = $_SESSION["name"];


$fee = $_SESSION["fee"];
$booking_id = $_SESSION["booking_id"];


// Update the d_date (departure date) in the database
$update_query = "UPDATE booking SET status = 'pending' WHERE id = '$booking_id'";
$conn->query($update_query);


$table_name = 'transaction';

$form_data = array(
    'id' => $newId,
    'date' => $date,
    'user_id' => $userId,
    'area_id' => $areaId,
    'lot_no' => $lot_no,
    'duration' => $duration . " minutes",
    'charge' => $amount,
    'status' => "pending",
    'pay_id' => $pid
    // 'ref_id' => $refId
);

$conn->multi_query(dbRowInsert($table_name, $form_data));

$conn->close();

// JavaScript code for showing popup and redirection
echo '
<!DOCTYPE html>
<html>
<head>
    <title>Payment and Unbooking Successful</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 text-center">
        <div class="alert alert-success" role="alert">
            Payment Pending ! Visist counter and make payment to finish Unbooking.
        </div>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "index.php";
        }, 5000); // Redirect after 3 seconds
    </script>
</body>
</html>
';

session_abort();
?>
