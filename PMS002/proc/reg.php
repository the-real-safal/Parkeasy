<?php
include('../inc/connect.php');
include('../inc/insert.php');

if (isset($_POST['Submit'])) {
    $phone = $_POST['phone'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $plate = $_POST['plate'];
    $email = $_POST['email'];
    $verification = "NO";
    $table_name1 = 'Users';

    // Check if the email already exists in the database
    $checkEmailQuery = "SELECT * FROM $table_name1 WHERE email = ?";
    $checkEmailStmt = $conn->prepare($checkEmailQuery);
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailResult = $checkEmailStmt->get_result();

    if ($checkEmailResult->num_rows > 0) {
        // Email already exists, redirect to the login page with a message
        header("Location: ../loginpage.php?message=" . urlencode("Email already exists. Please sign in to continue."));
        exit(); // Make sure to exit to prevent further execution of the script
    } else {
        // Email doesn't exist, insert the new user data
        $form_data1 = array(
            'name' => $fname . ' ' . $lname,
            'phone' => $phone,
            'username' => $fname,
            'password' => $password,
            'plate_no' => $plate,
            'email' => $email,
            'access' => 2,
            'verification' => $verification
        );

        $conn->multi_query(dbRowInsert($table_name1, $form_data1));
    }

    $conn->close();
}

// Redirect to the OTP verification page
header("Location: verify/mail_otp.php?email=" . urlencode($email));
?>
