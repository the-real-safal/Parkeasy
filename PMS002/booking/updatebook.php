<?php

session_start();




include "../inc/connect.php";

$area = $_SESSION["area"];
$model = $_SESSION["vehicle_model"];
$type = $_SESSION["vehicle_type"];
$plate_no = $_SESSION["plate_number"];
$lisence_no = $_SESSION["license_number"];
$name=$_SESSION["name"];
$email=$_SESSION["email"];
$vehicleType=$_SESSION["vehicle_type"];
$licenseNumber=$_SESSION["license_number"];


date_default_timezone_set('Asia/Kathmandu'); // Set the time zone to Kathmandu
$current_time = date('Y-m-d H:i:s');
$date=date('Y-m-d');
echo "Current time in Kathmandu: " . $current_time;
$_SESSION['e_date']=$current_time;
$selectedSpace = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["selected_space"])) {
        $selectedSpace = $_POST["selected_space"];
        
 
    }}
        
       
       // echo '<p>You clicked on a box with value: ' . $space . '</p>';
        
        
        // // Insert data into the booking table
        // $sqli = "INSERT INTO booking (area, lot_no, username, email, plate_no, e_date, d_date, status, date)
        //         VALUES ('$area', '$space', '$name', '$email', '$plate_no', $current_time, '', 'reserved', $date)";
        
        // if ($conn->query($sqli) === TRUE) {
        //     // Display booked popup and then redirect to index.php
        //     echo '<script>
        //         alert("Parking space ' . $selectedSpace . ' has been booked!");
        //         window.location.href = "index.php";
        //     </script>';
        // } else {
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }
        
        // $conn->close();

        include('../inc/connect.php');
        include('../inc/insert.php');
        if (isset($_GET['value'])) {
            $space = $_GET['value']; 
          
        $table_name='booking';
        
        
        $form_data = array(
            'area' =>  $area ,
            'lot_no' => $space,
            'username' => $name,
            'email' => $email,
            'v_type' => $vehicleType,
            'lis_no' => $licenseNumber,
            'plate_no' => $plate_no,
            'e_date' => $current_time,
            'status' => "booked",
        );
    

        
        //echo dbRowInsert($table_name, $form_data);
    $conn->multi_query( dbRowInsert($table_name, $form_data));
    $conn->close();
        
        }
        header("Location: book_mail.php");
        $_SESSION['space']=$space;
        session_abort();


   // }
//}
?>
