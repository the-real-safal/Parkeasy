<?php 
include('inc/header.php');
include('inc/connect.php');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Car Park Management System</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

  <!-- Add Bootstrap CSS link -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
  <style>
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  th, td {
    padding: 8px;
    text-align: left;
    word-wrap: break-word;
    max-width: 150px; /* Adjust the max-width as needed */
  }
</style>

</head>
<body>
  <section id="container" class="container">
    <?php
      // include('inc/header.php');
      include('inc/connect.php');
    ?>

    <section id="content">
      <div class="mt-4 mb-4">
        <h2>Users</h2>
        <div class="mb-3">
          <label for="accessFilter" class="form-label">Filter by Access:</label>
          <select class="form-select" id="accessFilter" name="accessFilter">
            <option value="all">All</option>
            <option value="allowed">Allowed</option>
            <option value="restricted">Restricted</option>
          </select>
          <button class="btn btn-primary" onclick="applyFilter()">Apply Filter</button>
        </div>
        <div class="table-responsive">
          <form method="post" action="delete.php">
          <table class="table table-striped table-bordered" id="example">
  <thead class="thead-dark">
    <tr>
      <th>CHK</th>
      <th>ID No</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th style="width: 100px;">License No.</th>
      <th>Bookings</th>
      <th>Unbooking</th> <!-- Add this new column -->
      <th>Permission</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $accessFilter = isset($_GET['accessFilter']) ? $_GET['accessFilter'] : 'all';
  $whereClause = '';

  if ($accessFilter === 'allowed') {
    $whereClause = "WHERE access = 2";
  } elseif ($accessFilter === 'restricted') {
    $whereClause = "WHERE access = 3";
  } else {
    $whereClause = "WHERE access IN (2, 3)";
  }

  $query = mysqli_query($connect, "SELECT * FROM users $whereClause") or die(mysqli_error());
  while ($row = mysqli_fetch_array($query)) {
    $id = $row['id'];

    // Fetch the total number of booked and unbooked bookings for the current user
    $booking_query = mysqli_query($connect, "SELECT COUNT(*) AS total_bookings FROM booking WHERE user_id='$id'") or die(mysqli_error());
    $booking_count_row = mysqli_fetch_assoc($booking_query);
    $total_bookings = $booking_count_row['total_bookings'];

    // Fetch the total number of unbooked bookings for the current user
    $unbooked_query = mysqli_query($connect, "SELECT COUNT(*) AS total_unbooked FROM booking WHERE user_id='$id' AND status='unbooked'") or die(mysqli_error());
    $unbooked_count_row = mysqli_fetch_assoc($unbooked_query);
    $total_unbooked = $unbooked_count_row['total_unbooked'];
  ?>
  <tr>
    <td>
      <input name="selector[]" type="checkbox" value="<?php echo $id; ?>">
    </td>
    <td><?php echo $id; ?></td>
    <td><?php echo $row['name'] ?></td>
    <td><?php echo $row['email'] ?></td>
    <td><?php echo $row['phone'] ?></td>
    <td><?php echo $row['lis_no'] ?></td>
    <td><?php echo $total_bookings; ?></td>
    <td><?php echo $total_unbooked; ?></td>
    
    <!-- Display the Permission column with appropriate font color -->
    <td class="<?php echo ($row['access'] == 3) ? 'text-danger' : 'text-success'; ?>">
      <?php echo ($row['access'] == 3) ? 'Restricted' : 'Allowed'; ?>
    </td>
  </tr>
  <?php } ?>

  </tbody>
</table>
<?php if ($accessFilter === 'allowed') { ?>
  <input type="hidden" name="action" value="restrict">
  <input type="submit" class="btn btn-danger" value="Restrict" name="restrict">
<?php } elseif ($accessFilter === 'restricted') { ?>
  <input type="hidden" name="action" value="allow">
  <input type="submit" class="btn btn-success" value="Allow" name="allow">
<?php } ?>
          </form>
        </div>
      </div>
    </section>
  </section>

  <!-- Add Bootstrap JS and jQuery links -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    function applyFilter() {
      var selectedValue = document.getElementById("accessFilter").value;
      window.location.href = "users.php?accessFilter=" + selectedValue;
    }
  </script>
</body>
</html>
