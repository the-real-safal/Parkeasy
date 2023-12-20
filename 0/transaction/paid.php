<?php
include "../inc/connect.php";
include "../inc/insert.php";

// Receive data from query parameters
$id = $_GET['id'];
$email = $_GET['email'];
$pay_id = $_GET['pay_id'];

$ref_id = 'csh_' . substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 3);

$sql = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row["id"];
}

// Additional processing logic here...

// Perform your SQL updates...

$current_time = new DateTime();
$update_query = "UPDATE booking SET d_date = '" . $current_time->format('Y-m-d H:i:s') . "', status = 'unbooked' WHERE id = '$booking_id';";
$update_query .= $conn->query($update_query);

$update_query = "UPDATE transaction SET date = '" . $current_time->format('Y-m-d H:i:s') . "', status = 'Paid', ref_id = '$ref_id' WHERE pay_id = '$pay_id';";
$update_query .= $conn->query($update_query);

// After all queries are complete, redirect to mail.php with id and email as query parameters
if (!$update_query) {
    // An error occurred, handle it or show an error message
    echo "Error occurred.";
} else {
    $mail_url = "unbookmail.php?id=" . urlencode($id) . "&email=" . urlencode($email);
    header("Location: $mail_url");
    exit(); // Ensure no further processing after the header() call
}
?>
