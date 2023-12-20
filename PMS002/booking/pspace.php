<?php
session_start();



$area = $_SESSION['area'];
include "../inc/connect.php";

$query = "SELECT * FROM booking WHERE area = '$area'";
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
  <title>Box Clicker</title>
  <!-- Include Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Add custom styles here */
    .box {
      width: 150px;
      height: 150px;
      background-color: green;
      border: 1px solid #ddd;
      display: inline-block;
      margin: 10px;
      text-align: center;
      line-height: 150px;
      cursor: pointer;
    }
    
    .box.unavailable {
      background-color: red;
      cursor: not-allowed;
    }
  </style>
</head>
<body>
 
  <div class="container">
 
    <h2 class="mb-4">Parking Spaces for <?php echo $area; ?></h2>
    <div class="row">
      
      <?php
      // Generating box values from 1 to 20
      $boxValues = range(1, 20);
      
      foreach ($boxValues as $value) {
        $boxClass = in_array($value, $bookedLots) ? 'box unavailable' : 'box';
        $boxStatus = in_array($value, $bookedLots) ? 'Booked' : 'Available';
        echo '<div class="' . $boxClass . '" onclick="handleBoxClick(' . $value . ', \'' . $boxStatus . '\')">' . $value . '</div>';
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
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
        location.href = 'updatebook.php?value=' + value;
      }
    }
  </script>
</body>
</html>
