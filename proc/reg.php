<?php
include('../inc/connect.php');
include('../inc/insert.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['Submit'])) {
    $phone = $_POST['phone'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $email = $_POST['abc'];
    $lis_no = $_POST['lis_no'];
    $verification = "NO";

    // Check if the email already exists in the database
    $checkEmailQuery = "SELECT * FROM Users WHERE email = ?";
    $checkEmailStmt = $conn->prepare($checkEmailQuery);
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailResult = $checkEmailStmt->get_result();

    // Check if the license number already exists in the database
    $checkLicenseQuery = "SELECT * FROM Users WHERE lis_no = ?";
    $checkLicenseStmt = $conn->prepare($checkLicenseQuery);
    $checkLicenseStmt->bind_param("s", $lis_no);
    $checkLicenseStmt->execute();
    $checkLicenseResult = $checkLicenseStmt->get_result();

    if ($checkEmailResult->num_rows > 0) {
        // Email already exists, redirect to the login page with a message
        $conn->close();
        header("Location: ../loginpage.php?message=" . urlencode("Email already exists. Please sign in to continue."));
        exit();
    } elseif ($checkLicenseResult->num_rows > 0) {
        // License number already exists, redirect to the registration page with a message
        $conn->close();
        header("Location: ../loginpage.php?message=" . urlencode("License number already exists."));
        exit();
    } else {
        // Obtain the last row id from the Users table
        $getLastIdQuery = "SELECT MAX(id) FROM users";
        $getLastIdResult = $conn->query($getLastIdQuery);
        $lastId = $getLastIdResult->fetch_row()[0];

        // Calculate the new id by incrementing the last id by one
        $newId = $lastId + 1;

        // Email and license number don't exist, insert the new user data
        $username = $fname;
        $name = $fname . ' ' . $lname;
        $access = 2;
        $table_name = 'users';

        $form_data = array(
            'id' => $newId,
            'username' => $fname,
            'email' => $email,
            'phone' => $phone,
            'name' => $fname . ' ' . $lname,
            'lis_no'=> $lis_no,
            'password' => $password,
            'verification'=> "NO",
            'access' => 2
        );
    
        $conn->multi_query(dbRowInsert($table_name, $form_data));
        $conn->close();

        // Redirect to the OTP verification page
        header("Location: verify/mail_otp.php?email=" . urlencode($email));
        exit();
    }
}
?>
