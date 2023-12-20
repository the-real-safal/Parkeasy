<?php
session_start();
if (isset($_GET['id'])) {
    $bookingId = $_GET['id'];
    // Now $bookingId contains the value passed from the previous page
} else {
    // Handle the case where 'id' is not provided in the URL
}
$_SESSION["bkid"] = "$bookingId";

date_default_timezone_set('Asia/Kathmandu');
$booking_fee = 10;
function generateTransactionCode() {
    $prefix = 'TXN';
    $random_number = mt_rand(100000, 999999);
    $timestamp = time();

    $transaction_code = $prefix . $random_number . $timestamp;
    return $transaction_code;
}
?>
<!-- <form action="https://uat.esewa.com.np/epay/main" method="POST"> -->
    <form action="success.php" method="POST">
                    <input type="hidden" name="amt" value="<?php echo $booking_fee; ?>">
                    <input type="hidden" name="pdc" value="0">
                    <input type="hidden" name="psc" value="0">
                    <input type="hidden" name="txAmt" value="0">
                    <input type="hidden" name="tAmt" value="<?php echo $booking_fee; ?>">
                    <input type="hidden" name="pid" value="<?php echo $transaction_code; ?>">
                    <input type="hidden" name="scd" value="EPAYTEST">
                    <input type="hidden" name="su" value="https://localhost/pms002/booking/success.php?q=su">
                    <input type="hidden" name="fu" value="https://localhost/pms002/esewa_payment_failed.php?q=fu">

                    <button type="submit" class="btn btn-success">
                        Pay with <b>Esewa</b>
                    </button>
                </form>
                <?php

                ?>