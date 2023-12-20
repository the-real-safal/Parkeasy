<?php
include "../inc/connect.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Step 1: Generate a unique token
    function generateUniqueToken() {
        return bin2hex(random_bytes(32));
    }

    // Step 2: Store the token and email
    $token = generateUniqueToken();
    $email = $_POST["email"];
    $timestamp = time();
    $expiry = $timestamp + (24 * 60 * 60);

    // Step 3: Store token, email, timestamp, and expiry in your database
    // Replace with your database connection and SQL query
    $sql= "INSERT INTO token (email, token, timestamp, expiry) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $email, $token, $timestamp, $expiry);
    $stmt->execute();
    $stmt->close();

    // Step 3: Send the reset link
    $resetLink = "https://yourdomain.com/reset_password.php?token=" . $token;

    // Replace with your email sending logic (e.g., PHPMailer)
    // Example: sendEmail($email, $resetLink);
    echo $resetLink;
    $encodedData = urlencode($resetLink);
    header("Location:mail.php?data=$encodedData");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <h2>Password Reset</h2>
    <form method="POST" action="mail.php">
        <label for="email">Enter Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Send Reset Link</button>
    </form>
</body>
</html>
