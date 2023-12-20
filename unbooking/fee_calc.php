<?php
session_start();
include "../inc/connect.php";

date_default_timezone_set('Asia/Kathmandu');

// Function to generate a unique transaction code
function generateTransactionCode() {
    $prefix = 'TXN';
    $random_number = mt_rand(100000, 999999);
    $timestamp = time();

    $transaction_code = $prefix . $random_number . $timestamp;
    return $transaction_code;
}

// Function to update the transaction table
function updateTransactionTable($transaction_code, $booking_id, $conn) {
    $sql = "UPDATE booking SET transaction_code = '$transaction_code' WHERE id = $booking_id";

    if ($conn->query($sql) === TRUE) {
        //echo "Transaction code updated successfully.";
    } else {
       // echo "Error updating transaction code: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["booking_id"])) {
    $booking_id = $_POST["booking_id"];
    $_SESSION['booking_id'] = $booking_id;

    // Fetch the booking record from the database
    $query = "SELECT e_date, vehicle_type_id FROM booking WHERE id = '$booking_id'";
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
        $vehicle_type = $row['vehicle_type_id'];
        if ($vehicle_type === 2) {
            $rate_per_minute = 0.5;
        } elseif ($vehicle_type === 1) {
            $rate_per_minute = 1;
        } else {
            // Set a default rate if vehicle type is not Car or Truck
            $rate_per_minute = 0.5;
        }

        // Calculate parking fee based on rate per minute
        $parking_fee = 10 + $minutes * $rate_per_minute;
        $_SESSION['fee'] = $parking_fee ;

        // Generate a unique transaction code
        $transaction_code = generateTransactionCode();
        $_SESSION['txn']= $transaction_code;

        // Simulate payment verification
        $payment_verified = true; // Set this to true if payment is verified

        if ($payment_verified) {
            // Update the transaction table with the verified transaction code
            updateTransactionTable($transaction_code, $booking_id, $conn);
        }

        // ... (rest of your form and HTML code)
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
        // ... (rest of your HTML)
    ?>
   <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Transaction ID</th>
                            <th>Duration (minutes)</th>
                            <th>Parking Fee (NPR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $booking_id; ?></td>
                            <td><?php echo $transaction_code; ?></td>
                            <td><?php echo $minutes; ?></td>
                            <td><?php echo $parking_fee; ?></td>
                        </tr>
                    </tbody>
                </table>

                <form action="https://uat.esewa.com.np/epay/main" method="POST">
                    <input type="hidden" name="amt" value="<?php echo $parking_fee; ?>">
                    <input type="hidden" name="pdc" value="0">
                    <input type="hidden" name="psc" value="0">
                    <input type="hidden" name="txAmt" value="0">
                    <input type="hidden" name="tAmt" value="<?php echo $parking_fee; ?>">
                    <input type="hidden" name="pid" value="<?php echo $transaction_code; ?>">
                    <input type="hidden" name="scd" value="EPAYTEST">
                    <input type="hidden" name="su" value="https://localhost/pms002/unbooking/payment.php?q=su">
                    <input type="hidden" name="fu" value="https://localhost/pms002/esewa_payment_failed.php?q=fu">

                    <button type="submit" class="btn btn-success">
                        Pay with <b>Esewa</b>
                    </button>
                </form>
                <br>
                 <form action="cash.php" method="POST">
                    <input type="hidden" name="amt" value="<?php echo $parking_fee; ?>">
                    <input type="hidden" name="pdc" value="0">
                    <input type="hidden" name="psc" value="0">
                    <input type="hidden" name="txAmt" value="0">
                    <input type="hidden" name="tAmt" value="<?php echo $parking_fee; ?>">
                    <input type="hidden" name="pid" value="<?php echo $transaction_code; ?>">
                    <button type="submit" class="btn btn-dark">
                        Pay with <b>Cash</b>
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
