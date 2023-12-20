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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
      background-color: rgba(242, 242, 242, 0.5); /* Set a transparent background color */
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
    .navicon a img {
      width: 20%;
    }
    .image-container {
      width: 250px;
      height: 65px;
      background-image: url('http://localhost/pms002/src/navicon.png');
      background-size: cover;
      background-position: center center;
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
      background-color: #ffb703;
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 6px;
      font-size: 14px;
      color: #333;
    }
  </style>
</head>
<body>
<div id="time-display" class="time"></div>
<nav>
  <div class="image-container"></div>
  <div>
    <ul>
      <li><a href="http://localhost/pms002/index.php"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="http://localhost/pms002/area/area.php"><i class="fa-regular fa-circle-parking"></i> Parking Zones</a></li>
      <?php
      if (isset($_SESSION['email'])) {
          $email=$_SESSION['email'];
          $sql = "SELECT id FROM users WHERE email = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("s", $email);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $userId = $row["id"];
              $_SESSION['uid']= $userId;
          }
          $sql = "SELECT * FROM booking WHERE user_id ='$userId' and status ='booked'";
          $result = mysqli_query($connect, $sql);
          $count = mysqli_num_rows($result);
          if ($count == 1) {
          } else {
      ?>
      <li><a href="http://localhost/pms002/booking/index.php"> <i class="fas fa-home"></i> Book Now</a></li>
      <?php } }?>
      <?php if (isset($_SESSION['email'])) { ?>
 <li><a href="http://localhost/pms002/unbooking/index.php"><i class="fas fa-home"></i> My Bookings</a></li>
     <?php  }?>
     
      <li><a href="http://localhost/pms002/messages/index.php"><i class="fas fa-home"></i> Contact Us</a></li>
    </ul>
  </div>
  <?php if (isset($_SESSION['name'])) {
    $user=$_SESSION['name'];
    echo $user;
  }
  ?>
  <?php if (isset($_SESSION['email'])) {
    echo '<div><a href="http://localhost/pms002/profile.php">My Profile</a></div>';
    echo '<a href="http://localhost/pms002/proc/logout.php">Sign Out</a>';
  } else { ?>
  <div class="button-container">
    <button type="button" onclick="redirectToLoginPage()">Sign In</button>
  </div>
  <?php } ?>
</nav>
<script>
  function redirectToLoginPage() {
    window.location.href = "http://localhost/pms002/loginpage.php";
  }
  window.addEventListener("load", function() {
    document.body.classList.add("fade-in");
    updateTime();
    setInterval(updateTime, 1000);
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
    timeDisplay.innerHTML = `Time: GMT +5:45 <span style="font-weight: bold;">${formattedTime}</span>`;
  }
</script>
</body>
</html>
