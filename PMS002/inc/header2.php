<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['phone'])) {


    } else {
        //header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Navbar Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .navbar-brand {
            padding: 10px 15px;
        }

        .navbar-nav li {
            padding-right: 10px;
        }

        .login-form,
        .signup-form {
            padding: 10px;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">ParkEasy</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="zone.php">Parking Zones</a>
                </li>
                <?php
                if (isset($_SESSION['phone'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="proc/check_book.php">Book Now</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="unbook.php">Unbook Now</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>
            </ul>
        </div>
        <div class="login-form">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Login</button>
        </div>
        <div class="signup-form">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#signupModal">Signup</button>
        </div>
    </nav>
       
    <div class="login-form">
          <a href="profile.php" class="btn btn-primary">My Profile</a>
          <a href="logout.php" class="btn btn-danger">Sign Out</a>
        </div>
      
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>