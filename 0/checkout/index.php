<?php
include("../inc/connect.php");
date_default_timezone_set('Asia/Kathmandu');
$current_time = date('Y-m-d H:i:s');
$id = $_GET["id"];
echo " " . $id . "<br>" . $current_time . "";

// Perform the SQL query to select area_id, user_id, and vehicle_type_id from the booking table
$query = "SELECT area_id, user_id, vehicle_type_id, c_date FROM booking WHERE id = $id";
$result = $conn->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $area_id = $row['area_id'];
        $user_id = $row['user_id'];
        $vehicle_type_id = $row['vehicle_type_id'];
        $check_date = $row['c_date'];
        $check = "1";

        // Calculate the time difference
        $check_date_timestamp = strtotime($check_date);
        $current_time_timestamp = strtotime($current_time);
        $time_difference = $current_time_timestamp - $check_date_timestamp;

        // Calculate hours, minutes, and seconds
        $hours = floor($time_difference / 3600);
        $time_difference %= 3600;
        $minutes = floor($time_difference / 60);
        $seconds = $time_difference % 60;

        echo "Area ID: " . $area_id . "<br> User ID: " . $user_id . "<br> Check: " . $check . "<br> Check In date: " . $check_date;
        echo "<br> Time Difference: " . $hours . " hours, " . $minutes . " minutes, " . $seconds . " seconds";

        // Check the number of paid transactions for the user
        $query = "SELECT COUNT(*) AS num_transactions FROM transaction WHERE user_id = $user_id AND status = 'paid'";
        $transactionResult = $conn->query($query);

        if ($transactionResult) {
            $transactionRow = $transactionResult->fetch_assoc();
            $numTransactions = $transactionRow['num_transactions'];
            echo "<br> Number of paid transactions by User ID " . $user_id . ": " . $numTransactions;
        } else {
            echo "<br> Error in fetching transaction data.";
        }

        //FEE CALCULATION ALGORITHM START HERE
        $dis = "0";
        $userDiscountFee = 0; // Initialize userDiscountFee to 0
        function calculateParkingFee($vehicleType, $hoursParked, $entryTime, $exitTime, $userParkingCount, &$dis, &$userDiscountFee)
        {
            // Define base rates for each vehicle type
            $rates = [
                'car' => 5.0,
                'truck' => 7.5,
                'van' => 6.0,
            ];

            // Calculate the base fee based on the vehicle type and hours parked
            $baseFee = $rates[$vehicleType] * $hoursParked;

            // Apply the user-specific discount
            if ($userParkingCount > 3) {
                $userDiscount = 0.1; // 10% discount
                $userDiscountFee = $baseFee * $userDiscount;
                $baseFee -= $userDiscountFee;
                $dis = "1";
            }

            // Calculate the total fee
            $totalFee = $baseFee;

            return $totalFee;
        }

        if ($vehicle_type_id == '1') {
            $vehicleType = 'truck';
        } else if ($vehicle_type_id == '2') {
            $vehicleType = 'car';
        } else if ($vehicle_type_id == '3') {
            $vehicleType = 'van';
        }

        // Calculate the time difference in hours
        $time = $time_difference / 60; // 3600 seconds in an hour


        $hoursParked = round($time);
        $userParkingCount = $numTransactions;

        $totalFee = calculateParkingFee($vehicleType, $hoursParked, $check_date, $current_time, $userParkingCount, $dis, $userDiscountFee);

        echo "<br><br><b>The parking fee for a $vehicleType parked for $hoursParked hours from $check_date to $current_time is Rs. $totalFee.";

        if ($dis == "1") {
            echo " <br><br>Congratulations, as you have parked more than 3 times, you can enjoy a 10% discount on your every check-in. Your discount amount is Rs. $userDiscountFee.";
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Parking Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Parking Information</h1>
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>Area ID:</th>
                    <td>
                        <?php
                        if ($area_id == 1) {
                            echo "Ground Floor";
                        } elseif ($area_id == 2) {
                            echo "First Floor";
                        } elseif ($area_id == 3) {
                            echo "Second Floor";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>User ID:</th>
                    <td>
                        <?php echo $user_id; ?>
                    </td>
                </tr>
                <tr>
                    <th>User Name:</th>
                    <td>
                        <?php
                        $query = "SELECT name FROM users WHERE id = $user_id";
                        $result = $conn->query($query);

                        if ($result) {
                            while ($row = $result->fetch_assoc()) {

                                $username = $row['name'];

                                echo $username;
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Check-In:</th>
                    <td>
                        <?php
                        if ($check == 1) {
                            echo "Yes";
                        } elseif ($check == 2) {
                            echo "Already Checked Out";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Check-In Date:</th>
                    <td>
                        <?php echo $check_date; ?>
                    </td>
                </tr>
                <tr>
                    <th>Parking Duration:</th>
                    <td>
                        <?php echo "$hours hours, $minutes minutes, $seconds seconds"; ?>
                    </td>
                </tr>
                <!-- <tr>
                    <th>Num Transactions:</th>
                    <td>
                        <?php echo $numTransactions; ?>
                    </td>
                </tr> -->
                <tr>
                    <th>Vehicle Type:</th>
                    <td>
                        <?php echo $vehicleType; ?>
                    </td>
                </tr>
                <tr>
                    <th>Fee:</th>
                    <td>Rs.
                        <?php
                        $baseFee = $totalFee + $userDiscountFee;
                        echo $baseFee; ?>
                    </td>
                </tr>
                <tr>
                    <th>Discount:</th>
                    <td>
                        <?php 
                        if($userDiscountFee==0 || $baseFee==0){
                            echo "0%";
                        }else{
$discountRate = ($userDiscountFee / $baseFee) * 100;
echo $discountRate;
                        }
                        ?>%
                    </td>
                </tr>
                <tr>
                    <th>Discount Amount:</th>
                    <td>Rs.
                        <?php echo $userDiscountFee; ?>
                    </td>
                </tr>
                <tr>
                    <th>Total Fee:</th>
                    <td>Rs.
                        <?php echo $totalFee; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        

        <form method="post" action="checkout.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="hours" value="<?php echo $hours; ?>">
    <input type="hidden" name="minutes" value="<?php echo $minutes; ?>">
    <input type="hidden" name="seconds" value="<?php echo $seconds; ?>">
    <input type="hidden" name="fee" value="<?php echo $totalFee; ?>">
    <input type="hidden" name="duration" value="<?php echo $hoursParked; ?>">
    <button type="submit" class="btn btn-primary">Confirm Check Out</button>
</form>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>