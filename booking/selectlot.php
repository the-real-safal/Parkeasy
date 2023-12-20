<?php
$error_message = "This vehicle is already parked. ERROR: DUPLICATE_VEHICLE_ENTRY";
session_start();
include "../inc/connect.php";
$email=$_SESSION['email'];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $vehicleModel = $_POST["vehicle_model"];
    $vehicleId = $_POST["vehicle_id"];
    $plateNumber = $_POST["plate_number"];
    $sql = "SELECT lis_no FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lis_no = $row["lis_no"];
    }
    // Prepare and execute a database query to check if the vehicle is booked
    $query = "SELECT * FROM booking WHERE plate_no = '$plateNumber' AND status = 'booked'";
    $result = $conn->query($query);

    if ($result && $result->num_rows >= 1) {
        $_SESSION["booking_status"] = "Vehicle is already parked.";
        $_SESSION["redirect"] = true;
    } else {
        $_SESSION["vehicle_model"] = $vehicleModel;
        $_SESSION["vehicle_id"] = $vehicleId;
        $_SESSION["plate_number"] = $plateNumber;
        $_SESSION["license_number"] = $lis_no;

        header("Location: nextpage.php");
        exit();
    }
}
?>
 <?php if ($error_message !== "") : ?>
    <?php echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $error_message . '</div>';   endif; ?>
    <script>
        <?php if (isset($_SESSION["redirect"])) : ?>
        setTimeout(function() {
            window.location.href = "index.php"; // Replace "index.php" with the desired URL
        }, 3000); // Redirect after 3 seconds (3000 milliseconds)
        <?php unset($_SESSION["redirect"]); ?>
        <?php endif; ?>
    </script>
</body>
</html>
