<?php
// Get the data sent by Esewa from the URL query parameters
$orderId = isset($_GET['oid']) ? $_GET['oid'] : '';
$amount = isset($_GET['amt']) ? $_GET['amt'] : '';
$refId = isset($_GET['refId']) ? $_GET['refId'] : '';

// Perform any necessary processing with the received data
// For example, you could update your database, send notifications, etc.

// Output a success message to the user
echo "Payment Successful!<br>";
echo "Order ID: " . $orderId . "<br>";
echo "Amount: " . $amount . "<br>";
echo "Reference ID: " . $refId . "<br>";
?>
