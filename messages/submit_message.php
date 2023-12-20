<?php
include "../inc/connect.php";
// Get form data
$user_id = $_POST['user_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$msg = $_POST['msg'];
$msg_type = $_POST['msg_type'];

//echo '<br>'.$user_id.'<br>'.$name.'<br>'.$email.'<br>'.$msg.'<br>'.$msg_type.'<br>';

// Prepare and execute the SQL query
$query = "INSERT INTO messages (user_id, name, email, msg, msg_type) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("issss", $user_id, $name, $email, $msg, $msg_type);
$messageSent = $stmt->execute();


// Close the statement and connection
$stmt->close();
$conn->close();

session_start();


// Assuming $messageSent is a boolean indicating if the message was sent successfully
if ($messageSent) {
    $_SESSION['messageSent'] = true; // Set a session variable
} else {
    $_SESSION['messageSent'] = false; // Set a session variable
}

// Redirect back to the form or a confirmation page
header("Location: index.php?success=true");
exit();
?>
