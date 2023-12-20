
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Messages</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<?php
			//include('inc/head.php');
			include('inc/header.php');
						include('inc/connect.php');
	?>
</head>
<body>
	<section id="container">
	<?php
	if($_SESSION['access']=='1'){
		header("Location: index.php");
	}
	if($_SESSION['access']=='2'){
		header("Location: ../index.php");
	}
						
	?>
	
	<section id="content">
      <div class="mt-4 mb-4">
        <h2>Transaction</h2>
        <div class="table-responsive">
          
		
						<form method="post" action="deleteadmin.php" >
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                           
                            <thead class="thead-dark">
						
						
                                <tr>
                                    <th>CHK</th>
                                    <th>Name</th>
									<th>Phone</th>
									<th style="width:100px;">Password</th>
                                    <th>Id No</th>
                                                                                             
                                </tr>
                            </thead>
                            <tbody>
							<?php 
							$query=mysqli_query($connect, "select * from users where access='1'")or die(mysql_error());
							while($row=mysqli_fetch_array($query)){
							$id=$row['id'];
							?>
                              
										<tr>
										<td>
										<input name="selector[]" type="checkbox" value="<?php echo $id; ?>">
										</td>
                                         <td><?php echo $row['name'] ?></td>
										  <td><?php echo $row['phone'] ?></td>
                                         <td><?php echo $row['password'] ?></td>
                                         <td><?php echo $id?></td>
                                        
                                       
                                </tr>
                         
						          <?php } ?>
                            </tbody>
                        </table>
						<input type="submit" class="btn btn-danger" value="Delete" name="delete">
          
		</form>
	</div></div>
	</section>
	</section>
</body>
</html>