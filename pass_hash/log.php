<?php
include('../inc/connect.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to hash the password with a salt
function hashPassword($password, $salt) {
    // Implement your custom hashing algorithm here
    // Example: concatenate password and salt and hash it using SHA-256
    $concatenated = $password . $salt;
    $hashedPassword = hash('sha256', $concatenated);
    return $hashedPassword;
}

if (isset($_POST['Submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; // The password entered by the user

    // Query to retrieve the stored hashed password and salt
    $getUserQuery = "SELECT password, salt FROM Users WHERE email = ?";
    $getUserStmt = $conn->prepare($getUserQuery);
    $getUserStmt->bind_param("s", $email);
    $getUserStmt->execute();
    $getUserResult = $getUserStmt->get_result();

    if ($getUserResult->num_rows === 1) {
        // User found in the database
        $userData = $getUserResult->fetch_assoc();
        $storedHashedPassword = $userData['password'];
        $storedSalt = $userData['salt'];

        // Function to verify the entered password
        function verifyPassword($inputPassword, $storedHashedPassword, $storedSalt) {
            // Rehash the entered password with the stored salt
            $hashedPassword = hashPassword($inputPassword, $storedSalt);

            // Compare the generated hash with the stored hashed password
            return ($hashedPassword === $storedHashedPassword);
        }

        // Verify the entered password
        if (verifyPassword($password, $storedHashedPassword, $storedSalt)) {
            $verification = $row['verification']; // Fetch verification column value
		
            if ($row['access'] == 3) {
                // Redirect to a page indicating the user is banned
                header("Location: ../banpage.php?email=$email");
                exit();
            }
            
            elseif($verification == "YES") {
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $row['name'];
                $_SESSION['password'] = $password;
                $_SESSION['access'] = $row['access'];
                $_SESSION['uid']= $row['id'];
                $phone = $row['phone'];
                $_SESSION['phone'] = $phone;
                
                if ($row['access'] == 2) {
                    header("Location: ../index.php");
                } elseif ($row['access'] == 0 || $row['access'] == 1) {
                    header("Location: ../0/index.php");
                }
            } 
            else {
                $encodedData = urlencode($email);
                echo "<script>window.location.href = 'verify/mail_otp.php?email=" . $encodedData . "';</script>"; // Redirect to verification page
            }
        } else {
            echo "<script>alert('Invalid username or password')</script>";
            echo "<script>window.location='../loginpage.php'</script>";
        }
    } else {
        // User not found, display an error message or redirect back to the login page
        header("Location: login.php?message=" . urlencode("User not found."));
        exit();
    }
}
?>
