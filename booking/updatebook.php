<?php
session_start();

include "../inc/connect.php";

$area = $_SESSION["area"];
$model = $_SESSION["vehicle_model"];
$plate_no = $_SESSION["plate_number"];
$lisence_no = $_SESSION["license_number"];
$name = $_SESSION["name"];
$email = $_SESSION["email"];
$vehicleId = $_SESSION["vehicle_id"];




$sql = "SELECT id FROM areas WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $area);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $areaId = $row["id"];
}

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userId = $row["id"];
    $lisence_no=$row["lis_no"];

}

date_default_timezone_set('Asia/Kathmandu');
$current_time = date('Y-m-d H:i:s');
$date = date('Y-m-d');
$_SESSION['e_date'] = $current_time;
$selectedSpace = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["selected_space"])) {
        $selectedSpace = $_POST["selected_space"];
    }
}

$minTimeDifference = 10; // Minimum time difference in seconds

if (isset($_SESSION['last_booking_time'])) {
    $lastBookingTime = strtotime($_SESSION['last_booking_time']);
    $currentTime = time();
    $timeDifference = $currentTime - $lastBookingTime;

    if ($timeDifference < $minTimeDifference) {
        echo '<script>
            alert("Please wait a moment before making another booking.");
            window.location.href = "pspace.php"; // Redirect back to the booking page
        </script>';
        exit(); // Exit the script to prevent further execution
    }
}

include('../inc/connect.php');
include('../inc/insert.php');

if (isset($_GET['value'])) {
    $space = $_GET['value'];
    $getLastIdQuery = "SELECT MAX(id) FROM booking";
    $getLastIdResult = $conn->query($getLastIdQuery);
    $lastId = $getLastIdResult->fetch_row()[0];
    $newId = $lastId + 1;
    $table_name = 'booking';
    $form_data = array(
        'id' => $newId,
        'area_id' => $areaId,
        'lot_no' => $space,
        'user_id' => $userId,
        'vehicle_type_id' => $vehicleId,
        'lis_no' => $lisence_no,
        'plate_no' => $plate_no,
        'e_date' => $current_time,
        '`check`' => "0",
        'status' => "pending",
    );

    $conn->multi_query(dbRowInsert($table_name, $form_data));
    $conn->close();
    
    $_SESSION['last_booking_time'] = $current_time;
    header("Location: ../unbooking/index.php");
    $_SESSION['space'] = $space;
}
?>
