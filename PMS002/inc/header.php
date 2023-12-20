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
  background-image: url('http://localhost/pms002/src/navicon.png');
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
    .time {
      font-size: 14px;
      font-weight: ;
      color: #023047;
      background-color: #ffb703;
      text-align: center;
      margin-top: 10px;
    }
    select {
    background-color:#ffb703; /* Change this to your desired highlight color */
    border: 1px solid #ccc; /* Add a border for better visibility */
    border-radius: 4px; /* Optional: Add border radius for rounded corners */
    padding: 6px; /* Optional: Add padding for spacing */
    font-size: 14px; /* Optional: Adjust font size */
    color: #333; /* Optional: Adjust text color */
    /* Add any other desired styles */
}
  </style>
</head>

<body>
<div id="time-display" class="time"></div>
  <nav>
  <div class="image-container"></div>
 
    <!-- <div class="navicon">
    <a href="#"><img src="src/navicon.png"></a>
  </div> -->
    <div>
      <ul>
        <li>
          <a href="http://localhost/pms002/index.php">Home</a>
        </li>
        <li>
          <a href="http://localhost/pms002/area/area.php">Parking Zones</a>
        </li>
        <?php
        if (isset($_SESSION['email'])) {
            $email=$_SESSION['email'];
          
           $sql = "SELECT * FROM booking WHERE email='$email' and status ='booked'";
                            $result = mysqli_query($connect, $sql);
                            $count = mysqli_num_rows($result);
                            if ($count == 1) {
                                ?>
          <li>
          <a href="http://localhost/pms002/unbooking/index.php">My Bookings</a>

          </li>
         
          <?php }
          else{ ?>
            <li>
            <a href="http://localhost/pms002/booking/index.php">Book Now</a>

          </li> <?php
          }
         }?>


        <li>
          <a href="http://localhost/pms002/contact.php">Contact Us</a>
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
        <a href="http://localhost/pms002/profile.php">My Profile</a>
      </div>';
      echo '   <a href="http://localhost/pms002/proc/logout.php">Sign Out</a>';
    } else { ?>


      <div class="button-container">
        <button type="button" onclick="redirectToLoginPage()">Sign In</button>
        <!-- <button type="button" onclick="redirectToLoginPage()">Signup</button> -->
      </div>
    <?php } ?>
  </nav>
  <script>
    function redirectToLoginPage() {
      window.location.href = "http://localhost/pms002/loginpage.php";
    }

    window.addEventListener("load", function() {
      document.body.classList.add("fade-in");
      updateTime(); // Initial call to set the time immediately
      setInterval(updateTime, 1000); // Update time every second
    });

    function updateTime() {
      const timeDisplay = document.getElementById("time-display");
      const now = new Date();
      const options = {
        timeZone: "Asia/Kathmandu",
        hour: "numeric",
        minute: "numeric",
        second: "numeric",
      };
      const formattedTime = now.toLocaleString("en-US", options);
      timeDisplay.innerHTML = `Time: GMT +5:45 <span style="font-weight: bold;">${formattedTime}</span>`;    }
  </script>
  <script>
    // function redirectToLoginPage() {
    //   window.location.href = "http://localhost/pms002/loginpage.php";
    // }

    // window.addEventListener("load", function() {
    //   document.body.classList.add("fade-in");
    // });
  </script>
</body>

</html>
