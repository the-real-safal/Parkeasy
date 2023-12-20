

<!DOCTYPE html>
<html>
<head>
    <title>Select Parking Lot</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .disabled-lot {
            filter: grayscale(100%);
            pointer-events: none;
        }
    </style>
</head>
<body>
    <?php
    ob_start();
include "../inc/header.php";

    ?>
    <?php


//session_start();

$vehicleModel = $_SESSION["vehicle_model"];
$vehicleId = $_SESSION["vehicle_id"];
$plateNumber = $_SESSION["plate_number"];
$licenseNumber = $_SESSION["license_number"];

//Selecting vehicle type according to vehicle_id
$sql = "SELECT name FROM vehicle_types WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $vehicleId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $vehicleType = $row["name"];
    $_SESSION["vehicle_type"]=$vehicleType;
}


$enableGroundFloor = ($vehicleType === "Truck");
$enableFirstFloor = ($vehicleType === "Car" || $vehicleType === "Van");
?>

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["area"])) {
        $areaId = $_POST["area"];
        $_SESSION["area_id"]=$areaId;
//Selecting vehicle type according to vehicle_id
$sql = "SELECT name FROM areas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $vehicleId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $area = $row["name"];
    $_SESSION["area"]=$area;
}


        header("Location: pspace.php?lot=" . urlencode($area));
    }
}

?>
    <div class="container mt-5">
        <h2>Select a Parking Lot:</h2>
        <form method="post" >
            <div class="row" style="display: flex;
                                    justify-content: space-between;
                                    flex-wrap: wrap;">
                <div class="col-md-4 <?php echo $enableGroundFloor ? '' : 'disabled-lot'; ?>" style=" width: calc(33.33% - 10px);
                                                margin-bottom: 40px;
                                                background-color: #f2f2f2;
                                                border-radius: 5px;
                                                padding: 10px;
                                                box-sizing: border-box;">
                    <button type="submit" class="btn btn-link" name="area" value="1">
                        <img src="../src/floor0.jpg" alt="Ground Floor" style="width: 100%; height: auto; border-radius: 5px; margin-bottom: 10px;">
                        <p>Ground Floor</p>
                    </button>
                    <?php if (!$enableGroundFloor) : ?>
                        <div class="popup-message">Note: Ground floor is for Trucks.</div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4 <?php echo $enableFirstFloor ? '' : 'disabled-lot'; ?>" style=" width: calc(33.33% - 10px);
                                                margin-bottom: 40px;
                                                background-color: #f2f2f2;
                                                border-radius: 5px;
                                                padding: 10px;
                                                box-sizing: border-box;">
                    <button type="submit" class="btn btn-link" name="area" value="2">
                        <img src="../src/floor1.jpg" alt="First Floor" style="width: 100%; height: auto; border-radius: 5px; margin-bottom: 10px;">
                        <p>First Floor</p>
                    </button>
                </div>
                <div class="col-md-4 <?php echo $enableFirstFloor ? '' : 'disabled-lot'; ?>" style=" width: calc(33.33% - 10px);
                                                margin-bottom: 40px;
                                                background-color: #f2f2f2;
                                                border-radius: 5px;
                                                padding: 10px;
                                                box-sizing: border-box;">
                    <button type="submit" class="btn btn-link" name="area" value="3">
                        <img src="../src/floor3.jpg" alt="Second Floor" style="width: 100%; height: auto; border-radius: 5px; margin-bottom: 10px;">
                        <p>Second Floor</p>
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
<?php
ob_end_flush();
?>