<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Car Park Management System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<?php
			// include('inc/header.php');
	?>
</head>
<body>
	<section id="container">
	<?php
			include('inc/header.php');
						include('inc/connect.php');
						
	?>



<!DOCTYPE html>
<html>
<head>
    <title>Transaction Form</title>
</head>
<body>
    <h1>Transaction Form</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="date">Enter Date:</label>
        <input type="date" name="date" id="date" required>
        <br>
        <input type="submit" value="Submit">
    </form>
    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="margin:-30px 0 0 90px;">
        <input type="hidden" name="date" id="date" value="2057/2054">
        <input type="submit" value="Reset">
    </form>
    

    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the date submitted by the user
    $date = $_POST['date'];
    

    // Perform any necessary processing for the transaction
    // For demonstration purposes, we'll just echo the transaction details
    echo "Transaction for date: $date";
    ?>

    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                           
                            <thead>
						
                                <tr>
                                    <th>Date & Time</th>
									<th>Confirmation Code</th>
									<th>Amount</th>
                                    <th>phone</th>
                                   
                                                             
                                </tr>
                            </thead>
                            <tbody>
							<?php 
							$query=mysqli_query($connect, "select * from zones where d1='$date'")or die(mysql_error());
							while($row=mysqli_fetch_array($query)){
							?>
                              
										<tr>
									
                                         <td><?php echo $row['d1'] ?></td>
										  <td><?php echo $row['account'] ?></td>
                                         <td><?php echo $row['charge'] ?></td>
                                         <td><?php echo $row['phone'] ?></td>
                                        
                                       
                                </tr>
                         
						          <?php } ?>
                            </tbody>
                        </table>

<?php }
?>

</body>
</html>