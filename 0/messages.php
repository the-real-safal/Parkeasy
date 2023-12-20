<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Messages</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>
  table {
    width: 80%; /* Adjust the table width as needed */
    border-collapse: collapse;
  }
  
  th, td {
    padding: 8px;
    text-align: left;
    word-wrap: break-word;
    max-width: 150px; /* Adjust the max-width as needed */
  }
</style>
</head>
<body>
	<section id="container">
	<?php
			include('inc/header.php');
			include('inc/connect.php');
	?>
	
	<section id="content">
      <div class="mt-4 mb-4">
        <h2>Messages</h2>
        <div class="table-responsive">
          <form method="post" action="deletemsg.php">
            <table class="table table-striped table-bordered" id="example">
              <thead class="thead-dark">
                <tr>
                  <th>CHK</th>
                  <th>UID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Message</th>
                  <th>Date & Time</th>
                  <th>Type</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $query=mysqli_query($connect,"select * from messages")or die(mysql_error());
                while($row=mysqli_fetch_array($query)){
                  $id=$row['id'];
                  $isRead = $row['is_read'] ? "Read" : "Unread";
              ?>
                <tr>
                  <td>
                    <input name="selector[]" type="checkbox" value="<?php echo $id; ?>">
                  </td>
                  <td><?php echo $row['user_id'] ?></td>
                  <td><?php echo $row['name'] ?></td>
                  <td><?php echo $row['email'] ?></td>
                  <td style="width:180px; text-align:left;"><?php echo $row['msg'] ?></td>
                  <td><?php echo $row['msg_date'] ?></td>
                  <td><?php echo $row['msg_type'] ?></td>
                  <td>
<?php
  if (!$row['is_read']) {
    echo "<a href='mark_as_read.php?id=$id'>Mark as seen</a>";
  }
  else {
	echo 'SEEN';
  }?>
  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            <input type="submit" class="btn btn-danger" value="Delete" name="delete">
          </form>
        </div>
      </div>
	</section>
	</section>
</body>
</html>
