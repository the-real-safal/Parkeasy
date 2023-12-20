<!DOCTYPE html>
<html>
<head>
  <!-- <link type="icon" src=""> -->
  <link rel="shortcut icon" href="src/favicon.png" type="image/x-icon">
  <style>
    /* CSS Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    
    .container {
      max-width: 900px;
      margin: 0 auto;
      padding: 20px;
    }
    
    h1 {
      text-align: center;
    }
    
    .section {
      margin-bottom: 40px;
    }
    
    .parking-lots {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }
    .parking-lot p{
      margin:20px auto;
    }
    .parking-lot {
      width: calc(33.33% - 10px);
      margin-bottom: 40px;
      background-color: #f2f2f2;
      border-radius: 5px;
      padding: 10px;
      box-sizing: border-box;
      transition: background-color 0.3s ease;
      transition: transform 0.3s ease;
    }
.title h1:hover {
  transform: translate3d(0, -10px, 22px);
  color: #ffb703;
}

    .parking-lot img {
      width: 100%;
      height: auto;
      border-radius: 5px;
      margin-bottom: 10px;
    }
    
    .parking-lot:hover {
      background-color: #faf0ca;
      transform: scale(1.1)
    }


    .view-spaces {
      background-color: #ffb703;
      color: white;
      border: none;
      margin-top: 10px;
      padding: 8px 16px;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    
    .view-spaces:hover {
      background-color: #023047;
    }

    
    
    .service {
      margin-bottom: 20px;
      padding: 10px;
      background-color: #f2f2f2;
      border-radius: 5px;
      box-sizing: border-box;
      transition: background-color 0.3s ease;
      transition: transform 0.3s ease;
    }
    
    .service:hover {
        background-color: #faf0ca;
      transform: scale(1.1);
    }
    
    @keyframes fade-in {
      from { opacity: 0; }
      to { opacity: 1; }
    }
   
    .fade-in {
      animation: fade-in 1s ease;
    }
  </style>
</head>
<body>
  <!-- Header Include -->
  <header class="nav-head" style="position:sticky; top:0px">
<?php 
include('inc/header.php'); ?>
</header>

  <div class="container">
<div class="title">
    <h1>Welcome to ParkEasy</h1>
  </div>
    <div class="section">
  <h2>Our Parking Lots</h2>
  <div class="parking-lots">
    <div class="parking-lot">
      <img src="src/floor0.jpg" alt="Parking Lot 1">
      <h3>Parking Lot 1</h3>
      <p>Conveniently located near the entrance.</p>
      <a href="zones.php?data=<?php $floor = "First Floor"; echo urlencode($floor); ?>" class="view-spaces" style="text-decoration: none;">View Available Lots</a>
    </div>
    <div class="parking-lot">
      <img src="src/floor1.jpg"alt="Parking Lot 2">
      <h3>Parking Lot 2</h3>
      <p>Reserved for disabled visitors.</p>
      <a href="zones.php?data=<?php $floor = "Second Floor"; echo urlencode($floor); ?>" class="view-spaces" style="text-decoration: none;">View Available Lots</a>
    </div>
    <div class="parking-lot">
      <img src="src/floor3.jpg" alt="Parking Lot 3">
      <h3>Parking Lot 3</h3>
      <p>Extra-wide spaces for large vehicles.</p>
      <a href="zones.php?data=<?php $floor = "Third Floor"; echo urlencode($floor); ?>" class="view-spaces" style="text-decoration: none;">View Available Lots</a>
    </div>
  </div>
</div>
    
    <div class="section">
      <h2>Why Choose Us</h2>
      <p>We provide secure parking facilities with 24/7 surveillance, easy access, and friendly staff.</p>
    </div>
    
    <div class="section">
      <h2>Our Services</h2>
      <div class="services">
        <div class="service">
          <h3>Car Wash</h3>
          <p>Get your car washed and cleaned while you park.</p>
        </div>
        <div class="service">
          <h3>Car Charging</h3>
          <p>Charge your electric vehicle at our charging stations.</p>
        </div>
        <div class="service">
          <h3>Car Maintenance</h3>
          <p>Book an appointment for car maintenance services.</p>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    // JavaScript Code
    const parkingLots = document.querySelectorAll('.parking-lot');
    
    parkingLots.forEach(parkingLot => {
      parkingLot.addEventListener('click', () => {
        parkingLot.classList.toggle('fade-in');
      });
    });
  </script>
 
</body>
<?php
  include 'inc/footer.php';
  ?>
</html>
