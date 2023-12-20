<?php
   $connection=mysqli_connect("localhost", "root", "", "cpms") or die(mysql_error());
   $name = $_POST['name']; //get posted data
    $phone = $_POST['phone'];  //escape string 
	$lis_no = $_POST['lis_no'];  //escape string 

    $sql = "UPDATE users SET name = '$name',  lis_no = '$lis_no' WHERE phone = '$phone'";
       // $sql = "UPDATE content SET text = '$content' WHERE element_id = '2' ";


    if (mysqli_query($connection, $sql))
    {
        header('Location:profile.php');
    }

?> 