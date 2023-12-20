

<!DOCTYPE html>
<html>
<head>
    <title>Select Parking Lot</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .disabled-lot {
            filter: grayscale(100%);
            pointer-events: none;
        }
        
    </style>
</head>
<body style="background-color: #fff0cc;
opacity: 0.2;
background: radial-gradient(circle, transparent 20%, #fff0cc 20%, #fff0cc 80%, transparent 80%, transparent), radial-gradient(circle, transparent 20%, #fff0cc 20%, #fff0cc 80%, transparent 80%, transparent) 40px 40px, linear-gradient(#ffb703 3.2px, transparent 3.2px) 0 -1.6px, linear-gradient(90deg, #ffb703 3.2px, #fff0cc 3.2px) -1.6px 0;
background-size: 80px 80px, 80px 80px, 40px 40px, 40px 40px;">
    <?php
include "../inc/header.php";

    ?>
<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["area"])) {
        $_SESSION["area_id"] = $_POST["area"];
?>
<script>
      window.location.href = "lot.php";

    </script>

<?php

        header("Location:lot.php?lot=" . urlencode($_POST["area"]));
    }
}
?>
    <div class="container mt-5">
        <h2>Select a Parking Lot:</h2>
        <form method="post" >
            <div class="row" style="display: flex;
                                    justify-content: space-between;
                                    flex-wrap: wrap;">
                <div class="col-md-4 ">
                    <button type="submit" class="btn btn-link" name="area" value="1">
                        <img src="../src/floor0.jpg" alt="Ground Floor" style="width: 100%; height: auto; border-radius: 5px; margin-bottom: 10px;">
                        <p>Ground Floor</p>
                    </button>
                    
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-link" name="area" value="2">
                        <img src="../src/floor1.jpg" alt="First Floor" style="width: 100%; height: auto; border-radius: 5px; margin-bottom: 10px;">
                        <p>First Floor</p>
                    </button>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-link" name="area" value="3">
                        <img src="../src/floor3.jpg" alt="Second Floor" style="width: 100%; height: auto; border-radius: 5px; margin-bottom: 10px;">
                        <p>Second Floor</p>
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
