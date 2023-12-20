<?php 
include('inc/header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .content-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .selected-content {
            font-size: 18px;
            padding: 20px;
        }
    </style>
</head>
<body>
<section id="container" class="container">
    <?php
      // include('inc/header.php');
      include('inc/connect.php');
    ?>
    <div class="content-container mt-5">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="pageSelector">View Reports</label>
                <select class="form-control" name="pageSelector" id="pageSelector">
                    <option value="1">Booking</option>
                    <option value="2">Revenue</option>
                    <option value="3">Users</option>
                    <option value="4">Vehicles</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
        <div class="selected-content mt-4">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $selectedPage = $_POST["pageSelector"];

                if ($selectedPage === "1") {
                    include("summary/booking.php");
                } elseif ($selectedPage === "2") {
                    include("summary/revenew.php");
                } elseif ($selectedPage === "3") {
                    include("summary/users.php");
                } elseif ($selectedPage === "4") {
                    include("summary/vtypes.php");
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
