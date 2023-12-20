 <?php 
 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
	$connection = mysqli_connect("localhost", "root", "", "cpms");
	$email=$_SESSION['email'];
	$query = mysqli_query($connection, "select * from users where pl_booked='YES' AND phone='$email'");
	$rows = mysqli_num_rows($query);
	//echo $rows;
	$row=mysqli_fetch_array($query);
	if ($rows == 1) {
	 header("Location: ../booked.php");
	}else{
	 header("Location: ../your_car.php");
		}
		
}