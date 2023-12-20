<?php
session_start();

// lot.php
if(isset($_GET['data'])) {
    $area = urldecode($_GET['data']);
} else {
    $area = $_SESSION['area_id'];
}

include "../inc/connect.php";

$sql = "SELECT name FROM areas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $area);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $area_name = $row["name"];
}

if (isset($area_name) && $area_name !== null) {
    $pageTitle = "Parking Spaces for " . $area_name;
} else {
    // Redirect to the previous page
    header("Location: area.php");
    exit;
}

$query = "SELECT * FROM booking WHERE area_id = '$area'";
$result = $conn->query($query);

$bookedLots = array();
$availableLots = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['status'] === 'booked') {
            $bookedLots[] = $row['lot_no'];
        } else {
            $availableLots[] = $row['lot_no'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Lot</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add custom styles here */
        .box {
            width: 100px;
            height: 100px;
            background-color: green;
            border: 1px solid #ddd;
            display: inline-block;
            margin: 5px;
            text-align: center;
            line-height: 100px;
            cursor: pointer;
        }

        .box.unavailable {
            background-color: red;
            cursor: not-allowed;
        }

        .road {
            color: white;
            width: 100%;
            height: 40px; /* Adjust the road height as needed */
            background-color: gray;
            margin: 5px;
        }
    </style>
</head>
<body>
<?php
include "../inc/header.php";
?>
<div class="container">
    <h2 class="mb-4">Parking Spaces for <?php echo $area_name; ?></h2>
    <div class="row">
        <?php
        // Generating box values from 1 to 20
        $boxValues = range(1, 20);

        $i = 0; // Counter to track parking lot number
        foreach ($boxValues as $value) {
            $boxClass = in_array($value, $bookedLots) ? 'box unavailable' : 'box';
            $boxStatus = in_array($value, $bookedLots) ? 'Booked' : 'Available';

            // Add a road every 10 parking lots
            if ($i % 10 === 0) {
              echo '<div class="road">Road</div>;';
            }

            echo '<div class="' . $boxClass . '" onclick="handleBoxClick(' . $value . ', \'' . $boxStatus . '\')">' . $value . '</div>';
            $i++;
        }
        ?>
    </div>
</div>

<!-- Bootstrap Modal for Slot Booked -->
<div class="modal fade" id="slotBookedModal" tabindex="-1" aria-labelledby="slotBookedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="slotBookedModalLabel">Slot Booked</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" disabled></button>
            </div>
            <div class="modal-body">
                This slot is already booked.
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function handleBoxClick(value, status) {
        if (status === 'Booked') {
            $('#slotBookedModal').modal('show');
        } else {
        }
    }
</script>
</body>
</html>
