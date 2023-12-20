<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Car Park Management System</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

  <!-- Add Bootstrap CSS link -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Add any custom styles here if needed */
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
        <div class="table-responsive">
          <form method="post" action="delete.php">
            <table class="table table-striped table-bordered" id="example">
              <thead class="thead-dark">
                <tr>
                  <th>CHK</th>
                  <th>Name</th>
                  <th>ID No</th>
                  <th>Phone</th>
                  <th style="width:100px;">Plate No</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $query = mysqli_query($connect, "select * from users where access='2'") or die(mysqli_error());
                while ($row = mysqli_fetch_array($query)) {
                  $id = $row['id'];
                ?>
                <tr>
                  <td>
                    <input name="selector[]" type="checkbox" value="<?php echo $id; ?>">
                  </td>
                  <td><?php echo $row['name'] ?></td>
                  <td><?php echo $row['id_no'] ?></td>
                  <td><?php echo $row['phone'] ?></td>
                  <td><?php echo $row['plate_no'] ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <input type="submit" class="btn btn-danger" value="Delete" name="delete">
          </form>
        </div>
      </div>
    </section>
  </section>

  <!-- Add Bootstrap JS and jQuery links -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
