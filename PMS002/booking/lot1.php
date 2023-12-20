<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Next Page</title>
  <!-- Include Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h1 class="mt-4">Next Page</h1>
    <?php
    if (isset($_GET['value'])) {
      $value = $_GET['value'];
      echo '<p>You clicked on a box with value: ' . $value . '</p>';
    }
    ?>
  </div>
</body>
</html>
