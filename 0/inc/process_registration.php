<?php
include('connect.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    // Insert user data into the database
    $sql = "INSERT INTO users (username, email, phone, name, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $email, $email, $phone, $fname . ' ' . $lname, $password);

    if ($stmt->execute()) {
        echo "User created successfully!";
    } else {
        echo "Error creating user. Please try again.";
    }
}
?>
