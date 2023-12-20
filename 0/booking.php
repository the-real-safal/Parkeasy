<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Car Park Management System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <style>
        .container{
            max-width: 1920px;
        }
        table {
            font-size: 14px; /* Adjust the font size as needed */
            width: 100%; /* Fill the available width */
        }
    </style>
</head>
<body>
<?php
include('inc/header.php');
include('inc/connect.php');

// Function to perform bubble sort based on 'id' in descending order
function bubbleSort($array) {
    $n = count($array);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($array[$j]['id'] < $array[$j + 1]['id']) {
                // Swap elements if they are in the wrong order
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }
    return $array;
}

// Fetch and sort the data
$query = mysqli_query($connect, "SELECT booking.*, users.username, users.email, areas.name AS area_name, vehicle_types.name AS vehicle_type_name
    FROM booking 
    LEFT JOIN users ON booking.user_id = users.id
    LEFT JOIN areas ON booking.area_id = areas.id
    LEFT JOIN vehicle_types ON booking.vehicle_type_id = vehicle_types.id") or die(mysqli_error($connect));

$bookingData = array();
while ($row = mysqli_fetch_array($query)) {
    $bookingData[] = $row;
}

// Sort the data using bubble sort
$sortedData = bubbleSort($bookingData);
?>

<section id="container" class="container">
    <section id="content">
        <div class="mt-4 mb-4">
            <h2>All Booking Details</h2>
            <div style="width:auto;background:white;padding:10px;margin:auto;">
                <div class="table-responsive">
                    <form method="post" action="deletebooking.php">
                        <table class="table table-striped table-bordered small-table" id="example">
                            <thead class="thead-dark">
                            <tr>
                                <th>CHK</th>
                                <th>Booking ID</th>
                                <th>Area</th>
                                <th>Lot No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Vehicle Type</th>
                                <th>Lisence No.</th>
                                <th>Plate No.</th>
                                <th>Booking Date</th>
                                <th>Check In Date</th>
                                <th>Check</th>
                                <th>Departure Date</th>
                                <th style="width:80px;">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($sortedData as $row) {
                                $id = $row['id'];
                                ?>
                                <tr>
                                    <td>
                                        <input name="selector[]" type="checkbox" value="<?php echo $id; ?>">
                                    </td>
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $row['area_name'] ?></td>
                                    <td><?php echo $row['lot_no'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['vehicle_type_name'] ?></td>
                                    <td><?php echo $row['lis_no'] ?></td>
                                    <td><?php echo $row['plate_no'] ?></td>
                                    <td> <?php echo $row['e_date'] ?></td>
                                    <td> <?php echo $row['c_date'] ?></td>
                                    <td>
                                    <?php
                                    $query_check = "SELECT `check` FROM `booking` WHERE `id` = $id";
                                    $result_check = mysqli_query($connect, $query_check);
                                    if ($result_check) {
                                        $row_check = mysqli_fetch_assoc($result_check);
                                        $checkValue = $row_check['check'];
                                        if ($checkValue == 0) {
                                            echo '<a href="checkin/index.php?id='.$id.'" class="btn btn-success">Check In</a>';
                                        } elseif ($checkValue == 1) {
                                            echo '<a href="checkout/index.php?id='.$id.'" class="btn btn-danger">Check Out</a>';
                                        } elseif ($checkValue == 2) {
                                            echo '<span class="badge rounded-pill bg-warning text-dark">Checked Out</span>';
                                        }
                                    } else {
                                        echo "Error in the SQL query: " . mysqli_error($connect);
                                    }
                                    ?>
                                    </td>
                                    <td><?php echo $row['d_date'] ?></td>
                                    <td><?php echo $row['status'] ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <input type="submit" class="btn btn-danger" value="Delete" name="delete">
                    </form>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <!-- ... More page links ... -->
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
</body>
</html>
