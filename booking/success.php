<?php 
// $orderId = isset($_GET['oid']) ? $_GET['oid'] : '';
// $amount = isset($_GET['amt']) ? $_GET['amt'] : '';
// $refId = isset($_GET['refId']) ? $_GET['refId'] : '';
// echo '<b> Booking Successful<b> <br>';
// echo '<br>'.$orderId.'<br>'.$amount.'<br>'.$refId.'<br>';

include('../inc/connect.php'); // Include your database connection file

session_start();
$id = $_SESSION['bkid'];

// Prepare the SQL query
$sql = "UPDATE booking SET status = 'booked' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    // Data updated successfully, so redirect to another page
    header("Location: book_mail.php"); // Replace "some-other-page.php" with the actual URL you want to redirect to
    exit; // Make sure to exit to prevent further execution
} else {
    echo "Error updating record: " . $conn->error;
}
?>
