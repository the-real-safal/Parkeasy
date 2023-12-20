<?php
include('../inc/connect.php');
include('../inc/insert.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $full_name = $fname . ' ' . $lname;
    $ver = "YES";
    $ass = 1;

    // Check if email or phone number already exist
    $checkQuery = "SELECT * FROM users WHERE email = '$email' OR phone = '$phone'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo "Email or phone number already exists.";
    } else {
        // Get the maximum ID from users table and add 1 to create a new ID
        $maxIdQuery = "SELECT MAX(id) as maxId FROM users";
        $maxIdResult = $conn->query($maxIdQuery);
        $row = $maxIdResult->fetch_assoc();
        $newId = $row['maxId'] + 1;

        // Insert data into the users table with the new ID
        $sql = "INSERT INTO users (id, username, email, phone, name, password, verification, access) 
                VALUES ('$newId', '$fname', '$email', '$phone', '$full_name', '$password', '$ver', '$ass')";

        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        header("Location: ../manage.php");
    }
} else {
    echo "ERROR";
}
$conn->close();
?>
