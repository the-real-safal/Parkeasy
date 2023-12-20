<?php
session_start();
include "../inc/connect.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $vehicleModel = $_POST["vehicle_model"];
    $vehicleType = $_POST["vehicle_type"];
    $plateNumber = $_POST["plate_number"];
    $licenseNumber = $_POST["license_number"];

    // Prepare and execute a database query to check if the vehicle is booked
    $query = "SELECT * FROM booking WHERE plate_no = '$plateNumber' AND status = 'booked'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $_SESSION["booking_status"] = "Vehicle is already parked.";
        $_SESSION["redirect"] = true;
    } else {
        $_SESSION["vehicle_model"] = $vehicleModel;
        $_SESSION["vehicle_type"] = $vehicleType;
        $_SESSION["plate_number"] = $plateNumber;
        $_SESSION["license_number"] = $licenseNumber;

        header("Location: nextpage.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Booking Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include "../inc/header.php"; ?>
    <div class="container mt-5">
        <?php if (isset($_SESSION["booking_status"])) : ?>
            <div class="alert alert-danger"><?php echo $_SESSION["booking_status"]; ?></div>
            <?php unset($_SESSION["booking_status"]); ?>
        <?php endif; ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <!-- ... Rest of your form ... -->
        </form>
    </div>
    
    <script>
        <?php if (isset($_SESSION["redirect"])) : ?>
        setTimeout(function() {
            window.location.href = "index.php"; // Replace "otherpage.php" with the desired URL
        }, 3000); // Redirect after 3 seconds (3000 milliseconds)
        <?php unset($_SESSION["redirect"]); ?>
        <?php endif; ?>
    </script>
</body>
</html>
