<?php
include("../inc/connect.php");
date_default_timezone_set('Asia/Kathmandu');
$current_time = date('Y-m-d H:i:s');
$id = $_GET["id"];
echo " " . $id . "<br>" . $current_time . "";

// Perform the SQL query to select area_id, user_id, and vehicle_type_id from the booking table
$query = "SELECT area_id, user_id, vehicle_type_id FROM booking WHERE id = $id";
$result = $conn->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $area_id = $row['area_id'];
        $user_id = $row['user_id'];
        $vehicle_type_id = $row['vehicle_type_id'];
        $check = "1";
        echo "Area ID: " . $area_id . "<br> User ID: " . $user_id . "<br> Check: " . $check . "<br>";
    }

    // Update the data in the "booking" table
    $update_data = array(
        'area_id' => $area_id,
        'user_id' => $user_id,
        'vehicle_type_id' => $vehicle_type_id,
        'c_date' => $current_time,
        'status' => 'check in',
        'check' => $check // Use single quotes to enclose the value
    );

    $set_values = [];
    foreach ($update_data as $column => $value) {
        $set_values[] = "`$column` = '$value'";
    }

    $set_clause = implode(', ', $set_values);

    $where_condition = "id = $id"; // Update the row with the specified id

    // Perform the update using an SQL UPDATE query
    $update_query = "UPDATE booking SET $set_clause WHERE $where_condition";
    if ($conn->query($update_query) === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Redirect to the booking.php page
    header("Location: ../booking.php");
    exit(); // Make sure to exit after the header() function
} else {
    echo "Error: " . $conn->error;
}
?>
