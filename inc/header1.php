<?php
include "connect.php";
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  if (isset($_SESSION['email'])) {


  } else {
    //header("Location:fail.php");
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>ParkEasy</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
      background-image: url('background.jpg');
      background-size: cover;
      background-position: center;
      background-blur: 10px;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #edf2f4;
      padding: 20px;
      backdrop-filter: blur(10px);
    }

    nav a {
      text-decoration: none;
      color: black;
      font-weight: bold;
      margin-right: 10px;
    }

    nav ul {
      list-style: none;
      display: flex;
      margin: 0;
      padding: 0;
    }

    nav li {
      margin-right: 10px;
    }

    nav li:last-child {
      margin-right: 0;
    }

    nav li a:hover {
      color: #ffb703;
      text-shadow: 1px 1px 1px #023047;
    }

    .navicon a img{
      width:20%;
    }
    .image-container {
  width: 250px;
  height: 65px;
  background-image: url('src/navicon.png');
  background-size: cover; /* Adjust as needed */
  background-position: center center; /* Adjust as needed */
  }

    .button-container {
      display: flex;
    }

    .button-container button {
      margin-right: 10px;
      padding: 8px 12px;
      background-color: #ffb703;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .button-container button:hover {
      background-color: #023047;
    }

    .fade-in {
      opacity: 0;
      animation: fadeInAnimation 1s forwards;
    }

    @keyframes fadeInAnimation {
      0% {
        opacity: 0;
      }

      100% {
        opacity: 1;
      }
    }
  </style>
</head>

<body>
  <nav>
  <div class="image-container"></div>
    <!-- <div class="navicon">
    <a href="#"><img src="src/navicon.png"></a>
  </div> -->
    <div>
      <ul>
        <li>
          <a href="index.php">Home</a>
        </li>
        <li>
          <a href="allzones.php">Parking Zones</a>
        </li>
        <?php
        if (isset($_SESSION['email'])) {
            $email=$_SESSION['email'];
          
           $sql = "SELECT * FROM zones WHERE email='$email' and status='RESERVED'";
                            $result = mysqli_query($connect, $sql);
                            $count = mysqli_num_rows($result);
                            if ($count == 1) {
                                ?>
          <li>
            <a href="proc/check_book.php">Book Now</a>
          </li>
          <?php }
           else{ ?>
          <li>
            <a href="unbook.php">Unbook Now</a>
          </li>
        <?php }} ?>
        <li>
          <a href="contact.php">Contact Us</a>
        </li>
      </ul>
    </div>
    <?php if (isset($_SESSION['name'])) {
      $user=$_SESSION['name'];
      echo $user;
    }
      ?>
    <?php if (isset($_SESSION['email'])) {
      echo '<div>
        <a href="profile.php">My Profile</a>
      </div>';
      echo '   <a href="proc/logout.php">Sign Out</a>';
    } else { ?>


      <div class="button-container">
        <button type="button" onclick="redirectToLoginPage()">Sign In</button>
        <!-- <button type="button" onclick="redirectToLoginPage()">Signup</button> -->
      </div>
    <?php } ?>
  </nav>
  <script>
    function redirectToLoginPage() {
      window.location.href = "loginpage.php";
    }

    window.addEventListener("load", function() {
      document.body.classList.add("fade-in");
    });
  </script>
</body>

</html>
