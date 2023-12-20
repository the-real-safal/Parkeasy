<?php
include "../inc/connect.php";
session_start();
// Other code and processing...
$email = $_SESSION["email"]; // Assuming you have stored the user's email in the session

// Fetch lis_no from the user table based on the email
$fetchLisNoQuery = "SELECT lis_no FROM users WHERE email = ?";
$stmt = $conn->prepare($fetchLisNoQuery);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$lis_no = $row["lis_no"];
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
        <form action="selectlot.php" method="post">
            <div class="form-group">
                <label for="vehicle_model">Vehicle Model:</label>
                <input type="text" class="form-control" name="vehicle_model" required>
            </div>
            
            <div class="form-group">
                <label for="vehicle_type">Vehicle Type:</label>
                <select class="form-control" name="vehicle_id" required>
                    <?php
                    // Include your database connection code here
                    include "../inc/connect.php";
                    
                    // Fetch data from the vehicle_types table
                    $vehicleTypeQuery = "SELECT * FROM vehicle_types";
                    $vehicleTypeResult = $conn->query($vehicleTypeQuery);

                    // Loop through the results and create options
                    while ($row = $vehicleTypeResult->fetch_assoc()) {
                        echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="plate_number">Plate Number:</label>
                <input type="text" class="form-control" name="plate_number" required>
            </div>
            
            <div class="form-group">
                <label for="license_number">License Number:</label>
                <input type="text" class="form-control" name="license_number" value="<?php echo $lis_no; ?>" disabled>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
