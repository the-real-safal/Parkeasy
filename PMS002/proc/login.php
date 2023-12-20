 <?php 
 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
		
}

if (isset($_POST['Submit'])) {
	$email=$_POST['email'];
	$password=$_POST['password'];

	$connection = mysqli_connect("localhost", "root", "", "cpms");

	$query = mysqli_query($connection, "select * from users where password='$password' AND email='$email'");
	$rows = mysqli_num_rows($query);
	echo $rows;
	$row=mysqli_fetch_array($query);
	if ($rows == 1) {
		$_SESSION['email']=$email;
		$_SESSION['name']=$row['name'];
		$_SESSION['password']=$password;
		$_SESSION['access']=$row['access'];
		$phone=$row['phone'];
		$_SESSION['phone']=$phone;
		if ($row['access']==2){
		header("Location: ../index.php");
		}
		if ($row['access']==0){
		header("Location: ../0/index.php");
		}
		if ($row['access']==1){
		header("Location: ../0/index.php");
		}
	}else{
		echo"<script>alert('Invalid username or password')</script>";
		echo"<script>window.location='../index.php'</script>";
	}
	
	
	
}

//
?>