<?php
include('../inc/connect.php');
include('../inc/insert.php');


session_start();
$area=$_SESSION["area"];
$lot_no=$_SESSION["lot_no"];
$plate_no=$_SESSION["plate_no"];
$e_date=$_SESSION["e_date"];
$status=$_SESSION["status"];
$name=$_SESSION["name"];
$email=$_SESSION["email"];
$duration=$_SESSION["duration"];
$fee=$_SESSION["parking_fee"];
$booking_id = $_SESSION["booking_id"];

date_default_timezone_set('Asia/Kathmandu'); // Set the time zone to Kathmandu
//$current_time = date('Y-m-d H:i:s');
$date=date('Y-m-d');
echo "Current time in Kathmandu: " . $date;
echo "<br>Name:".$name.",";
echo "<br>Email:".$email.",";
echo "<br>Area:".$area.",";
echo "<br>Duration:".$duration.",";
echo "<br>Fee:".$fee.",";
echo "<br>Status:".$status.",";



$current_time = new DateTime();
// Update the d_date (departure date) in the database
$update_query = "UPDATE booking SET d_date = '" . $current_time->format('Y-m-d H:i:s') . "', status = 'unbooked', charge=$fee WHERE id = '$booking_id';";
$update_query.=
$conn->query($update_query);

//Updating into transaction table


$table_name='transaction';



$form_data = array(
    'date' =>  $date ,
    'name' => $name,
    'email' => $email,
    'area' => $area,
    'lot_no' => $lot_no,
    'duration' => $duration ." minutes",
    'charge' => $fee,
    'status' => "paid",
);




//echo dbRowInsert($table_name, $form_data);
$conn->multi_query( dbRowInsert($table_name, $form_data));

$conn->close();




header("Location: unbook_mail.php");
session_abort();



?>