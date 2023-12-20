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
      background-color: #f0f0f0;
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
    <h1 class="mt-4">Click a Box</h1>
    <div class="row">
      <?php
      // Simulating data stored on the server
      $storedValues = array(20, 60, 100, 150);
      $boxValues = array(10, 20, 30, 40, 50, 60, 70, 80, 90, 100,
                        110, 120, 130, 140, 150, 160, 170, 180, 190, 200);
      
      foreach ($boxValues as $value) {
        $boxClass = in_array($value, $storedValues) ? 'box unavailable' : 'box';
        echo '<div class="col-md-2 ' . $boxClass . '" onclick="lot1.href=\'next_page.php?value=' . $value . '\'">' . $value . '</div>';
      }
      ?>
    </div>
  </div>
</body>
</html>
