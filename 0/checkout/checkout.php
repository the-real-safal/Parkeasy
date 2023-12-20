<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $hours = $_POST['hours'];
    $minutes = $_POST['minutes'];
    $seconds = $_POST['seconds'];
    $totalFee = $_POST['fee'];
    $duration= $_POST['duration'];
echo $id;
    


} else {
    // Handle the case where 'id' is not set
}
?>

<?php
include('../inc/connect.php');
include('../inc/insert.php');
$orderId = isset($_GET['oid']) ? $_GET['oid'] : '';
$amount = isset($_GET['amt']) ? $_GET['amt'] : '';
$refId = isset($_GET['refId']) ? $_GET['refId'] : '';

session_start();


// Extract aid from email
$sql = "SELECT * FROM booking WHERE id =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $areaId = $row["area_id"];
    $lot_no = $row["lot_no"];
    $plate_no = $row["plate_no"];
    $e_date = $row["e_date"];
    $status = $row["status"];
    $userId = $row["user_id"];
}






$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $email = $row["email"];
}

$fee = $totalFee;
$booking_id =$id;

date_default_timezone_set('Asia/Kathmandu'); // Set the time zone to Kathmandu
$date = date('Y-m-d');
// echo "Current time in Kathmandu: " . $date;
// echo "<br>User ID:" . $userId . ",";
// echo "<br>area id:" . $areaId . ",";
// echo "<br>lot no:" . $lot_no . ",";
// echo "<br>Duration:" . $duration . ",";
// echo "<br>Fee:" . $fee . ",";
// echo "<br>Status:" . $status . ",";

$current_time = new DateTime();
// Update the d_date (departure date) in the database
$update_query = "UPDATE booking SET d_date = '" . $current_time->format('Y-m-d H:i:s') . "', status = 'check out', charge=$fee, `check`=2 WHERE id = '$booking_id';";
$update_query .=
$conn->query($update_query);

// Updating into transaction table
$getLastIdQuery = "SELECT MAX(id) FROM transaction";
$getLastIdResult = $conn->query($getLastIdQuery);
$lastId = $getLastIdResult->fetch_row()[0];

// Calculate the new id by incrementing the last id by one
$newId = $lastId + 1;

$table_name = 'transaction';

$form_data = array(
    'id' => $newId,
    'date' => $date,
    'user_id' => $userId,
    'area_id' => $areaId,
    'lot_no' => $lot_no,
    'duration' => $duration . " minutes",
    'charge' => $fee,
    'status' => "paid",
    'pay_id' => $orderId,
    'ref_id' => $refId
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
            Payment and Unbooking Successful
        </div>
    </div>
    <script>
        var id = ' . json_encode($id) . '; // Pass the PHP $id to JavaScript
        setTimeout(function() {
            // Redirect after 3 seconds and include the $id as a query parameter
            window.location.href = "mail.php?id=" + id;
        }, 3000); // Redirect after 3 seconds
    </script>
</body>
</html>
';

?>