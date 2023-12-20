<?php 
session_start();
include "../inc/connect.php";
$email = $_SESSION['email'];
$sql = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userId = $row["id"];
}


// Calculate the timestamp for the expiration time (e.g., 5 minutes ago)
$expirationTime = time() - (1 * 60); // 1 minutes

// Delete records from OTP table that have expired


$conn->close();
?>