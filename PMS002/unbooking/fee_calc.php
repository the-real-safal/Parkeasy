<?php
session_start();
include "../inc/connect.php";

date_default_timezone_set('Asia/Kathmandu');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["booking_id"])) {
    $booking_id = $_POST["booking_id"];
    $_SESSION['booking_id']=$booking_id;
    // Fetch the booking record from the database
    $query = "SELECT e_date, v_type FROM booking WHERE id = '$booking_id'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $entry_date = new DateTime($row['e_date']);
        // Set the time zone to Kathmandu
        $current_time = new DateTime(); // Current time
        
        // Calculate time difference in minutes
        $interval = $current_time->diff($entry_date);
        $minutes = $interval->days * 24 * 60 + $interval->h * 60 + $interval->i;
        $_SESSION['duration'] = $minutes;
        
        // Determine parking rate based on vehicle type
        $vehicle_type = $row['v_type'];
        if ($vehicle_type === 'Car') {
            $rate_per_minute = 0.5;
        } elseif ($vehicle_type === 'Truck') {
            $rate_per_minute = 1;
        } else {
            // Set a default rate if vehicle type is not Car or Truck
            $rate_per_minute = 0.5;
        }
        
        // Calculate parking fee based on rate per minute
        $parking_fee = 10 + $minutes * $rate_per_minute;
        
        // Update the d_date (departure date) in the database
        // $update_query = "UPDATE booking SET d_date = '" . $current_time->format('Y-m-d H:i:s') . "', status = 'unbooked' WHERE id = '$booking_id'";
        // $conn->query($update_query);
        
        // Store the parking fee in a session variable
        $_SESSION["parking_fee"] = $parking_fee;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Unbooking Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php
include "../inc/header.php";
?>
    <div class="container mt-5">
        <?php if (isset($parking_fee)) : ?>
            <h2>Your parking fee: Rs <?php echo $parking_fee; ?></h2>
        <?php endif; ?>
        <p>Thank you for using our parking system.</p>
        <!-- Two different buttons with different page redirection -->
        <a href="payment.php" class="btn" style="background-color: #60bb48;">Pay with <b>Esewa</b></a>
        <a href="payment.php" class="btn" style=" color:#fff; background-color: #5d2e8e;">Pay with <b>Khalti</b></a>
    </div>
</body>
</html>
