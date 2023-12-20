<?php 
 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['Submit'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$connection = mysqli_connect("localhost", "root", "", "cpms");

	$query = mysqli_query($connection, "SELECT * FROM users WHERE password='$password' AND email='$email'");
	$rows = mysqli_num_rows($query);
	$row = mysqli_fetch_array($query);
	
	if ($rows == 1) {
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
}
?>
