<?php

session_start();
// Other code and processing...


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
                <label for="vehicle_type">Type of Vehicle:</label>
                <select class="form-control" name="vehicle_type" required>
                    <option value="Car">Car</option>
                    <option value="Truck">Truck</option>
                    <option value="Van">Van</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="plate_number">Plate Number:</label>
                <input type="text" class="form-control" name="plate_number" required>
            </div>
            
            <div class="form-group">
                <label for="license_number">License Number:</label>
                <input type="text" class="form-control" name="license_number" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
