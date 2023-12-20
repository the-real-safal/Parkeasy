 <?php 
 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
		
}

if (isset($_POST['Submit'])) {
	
	$email=$_POST['email'];
	$password=$_POST['password'];

	// To protect MySQL injection for Security purpose
	$email = stripslashes($email);
	$password = stripslashes($password);
	$email = mysql_real_escape_string($email);
	$password = mysql_real_escape_string($password);
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$connection = mysql_connect("localhost", "root", "");
	// Selecting Database
	$db = mysql_select_db("cpms", $connection);
	// SQL query to fetch information of registerd users and finds user match.
	$query = mysql_query("select * from users where password='$password' AND email='$email'", $connection);
	$rows = mysql_num_rows($query);
	//echo $rows;
	$row=mysql_fetch_array($query);
	if ($rows == 1) {
		$_SESSION['email']=$email; // Initializing Session
		$_SESSION['password']=$password; // Initializing Session
	$_SESSION['access']=$row['access'];
	if ($row['access']==2){
	header("Location: ../index.php");
	}
	if ($row['access']==0){
	
	header("Location: ../0/index.php");
	}
	}
	
	
	
}

//
?>