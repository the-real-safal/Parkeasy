<!DOCTYPE html>
<html>
<head>
    <title>Reports Display</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .container {
            margin-top: 20px;
        }

        .report-box {
            background-color: #ffffff;
            border: 1px solid #ccc;
            padding: 20px;
            margin: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="report-box">
                    <!-- Booking Summary Report -->
                    <?php include("summary/booking.php"); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="report-box">
                    <!-- Revenue Summary Report -->
                    <?php include("summary/revenew.php"); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="report-box">
                    <!-- Users Pie Chart Report -->
                    <?php include("summary/users.php"); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="report-box">
                    <!-- Vehicle Type Linear Graph Report -->
                    <?php include("summary/vtypes.php"); ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
