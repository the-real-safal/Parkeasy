<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Car Park Management System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<?php
			//include('inc/head.php');
	?>
</head>
<body>
	<section id="container">
	<?php
			include('inc/header.php');
						include('inc/connect.php');
						
	?>
	
	<section id="content">
	<!-- <img src="src/bg.png" style="position:absolute; z-index:-1; margin:0;"/> -->
	<section id="container" class="container">
    <?php
      // include('inc/header.php');
      include('inc/connect.php');
    ?>

    <section id="content">
      <div class="mt-4 mb-4">
        <h2>Transaction</h2>
        <div class="table-responsive">
          
		
						<form method="post" action="" >
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                           
                            <thead class="thead-dark">
						
                                <tr>
                                    <th>ID</th>
									<th>Date</th>
									<th>Name</th>
                                    <th>Email</th>
									<th>Area</th>
									<th>Lot No.</th>
									<th>Parking Duration</th>
                                    <th>Fee</th>
									<th>Status</th>
                                   
                                                             
                                </tr>
                            </thead>
                            <tbody>
							<?php 
							$query=mysqli_query($connect, "select * from transaction")or die(mysql_error());
							while($row=mysqli_fetch_array($query)){
							?>
                              
										<tr>
									
                                         <td><?php echo $row['id'] ?></td>
										  <td><?php echo $row['date'] ?></td>
                                         <td><?php echo $row['name'] ?></td>
                                         <td><?php echo $row['email'] ?></td>
										 <td><?php echo $row['area'] ?></td>
										  <td><?php echo $row['lot_no'] ?></td>
                                         <td><?php echo $row['duration'] ?></td>
                                         <td><?php echo $row['charge'] ?></td>
										 <td><?php echo $row['status'] ?></td>
                                        
                                       
                                </tr>
                         
						          <?php } ?>
                            </tbody>
                        </table>
					
          
		</form>
	</div></div>
	</section>
	</section>
	DAily Transaction: <a href="daily_transaction.php">Click Here</a>
</body>
</html>