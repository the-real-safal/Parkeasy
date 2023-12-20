<?php

?>


<!DOCTYPE html>
<html>
<head>
  <!-- <link type="icon" src=""> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="shortcut icon" href="src/favicon.png" type="image/x-icon">
  <style>
    /* CSS Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    #bg-video {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
    }
    .container {
      max-width: calc(90%);
      margin: 0 auto;
      padding: 20px;
    }
 

    h1 {
      text-align: center;
    }
    h1 .parkeasy {
      max-width: calc(10%);
  text-decoration: none;
  position: relative;
}
h1 .parkeasy::before {
  content: '';
  background-color: rgba(255, 183, 3, 0.75);
  position: absolute;
  left: 0;
  bottom: 3px;
  width: 100%;
  height: 8px;
  z-index: -1;
  transition: all .3s ease-in-out;
}
h1 .parkeasy:hover::before {
  bottom: 0;
  height: 100%;
}
    .section {
      margin-bottom: 40px;
    }
    .parking-lots {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }
    .parking-lot p {
      margin: 20px auto;
    }
    .parking-lot {
      color: #023047;
      width: calc(33.33% - 20px);
      margin-bottom: 40px;
      background-color: rgba(242, 242, 242, 0.5); /* Set a transparent background color */
      border-radius: 5px;
      padding: 10px;
      box-sizing: border-box;
      transition: background-color 0.3s ease, transform 0.3s ease;
      backdrop-filter: blur(5px); /* Apply the blur effect */
    }

    .parking-lot img {
      width: 100%;
      height: auto;
      border-radius: 5px;
      margin-bottom: 10px;
      
    }
    .parking-lot:hover {
      background-color: #faf0ca;
      transform: scale(1.1);
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
      backdrop-filter: blur(5px); /* Apply the blur effect */
    }
    .view-spaces:hover {
      background-color: #023047;
    }
    .service {
      color: #023047;
      margin-bottom: 20px;
      padding: 10px;
      background-color: rgba(242, 242, 242, 0.5); /* Set a transparent background color */
      border-radius: 5px;
      box-sizing: border-box;
      transition: background-color 0.3s ease, transform 0.3s ease;
      backdrop-filter: blur(5px); /* Apply the blur effect */
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
    .jumbotron {
      color: white;
      position: relative;
      height: 100vh;
    }
    .jumbotron video {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
    }
    .jumbotron .content {
      position: relative;
      z-index: 0;
      padding: 20px;
      text-align: center;
    }
    /* Custom CSS for FAQ section */
.faq-list {
  display: flex;
  flex-direction: column;
}

.faq {
  background-color: rgba(242, 242, 242, 0.5);
  border-radius: 5px;
  padding: 10px;
  margin-bottom: 20px;
  box-sizing: border-box;
  transition: background-color 0.3s ease, transform 0.3s ease;
  backdrop-filter: blur(5px);
}

.faq:hover {
  background-color: #faf0ca;
  transform: scale(1.1);
}

.faq-question {
  color: #023047;
  margin-bottom: 10px;
}

.faq-answer {
  color: #333;
}

 
  </style>
</head>
<body>
  <!-- Header Include -->
  <header class="nav-head" style="position:sticky; top:0px; z-index: 2;">
    <?php include('inc/header.php'); ?>
  </header>
  <div class="jumbotron">
    <video autoplay muted loop>
      <source src="src/bg.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <div class="content">
      <div class="container">
        <div class="title">
          <h1>Welcome to <span class="parkeasy"> ParkEasy</span></h1>
        </div>
        <div class="section">
          <h2>Our Parking Lots</h2>
          <div class="parking-lots">
            <div class="parking-lot">
              <img src="src/floor0.jpg" alt="Parking Lot 1">
              <h3>Ground Floor</h3>
              <p>Our ground floor parking is tailor-made for trucks, featuring spacious areas that perfectly accommodate large vehicles. Wide lanes ensure easy maneuvering, providing a secure and hassle-free truck parking experience.</p>
              <a href="area/lot.php?data=<?php $floor = "1"; echo urlencode($floor); ?>" class="view-spaces" style="text-decoration: none;">View Available Lots</a>
            </div>
            <div class="parking-lot">
              <img src="src/floor1.jpg" alt="Parking Lot 2">
              <h3>First Floor</h3>
              <p>Welcome to our first-floor parking facility, an ideal space designed exclusively for cars. With a focus on convenience and accessibility, our parking spots are tailored to ensure smooth and hassle-free parking for your car. Enjoy the peace of mind that comes with knowing your vehicle is secure in our well-maintained and well-lit environment.</p>
              <a href="area/lot.php?data=<?php $floor = "2"; echo urlencode($floor); ?>" class="view-spaces" style="text-decoration: none;">View Available Lots</a>
            </div>
            <div class="parking-lot">
              <img src="src/floor3.jpg" alt="Parking Lot 3">
              <h3>Second Floor</h3>
              <p>Introducing our second-floor parking area, thoughtfully crafted for vans. Whether you're driving a compact van or a larger model, our parking spaces are perfectly suited to provide you with a seamless parking experience. Rest easy knowing your van is protected within our secure and brightly lit premises.</p>
              <a href="area/lot.php?data=<?php $floor = "3"; echo urlencode($floor); ?>" class="view-spaces" style="text-decoration: none;">View Available Lots</a>
            </div>
          </div>
        </div>
        <div class="section">
          <h2>Why Choose Us</h2>
          <p>We provide secure parking facilities with 24/7 surveillance, easy access, and friendly staff.</p>
        </div>
        <div class="section">
          <h2>Our Upcomming Services</h2>
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
        <?php

include "inc/connect.php";
// Query to get the minimum and maximum ID from the 'faq' table
$sql = "SELECT MIN(id) AS min_id, MAX(id) AS max_id FROM faq";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$minId = $row['min_id'];
$maxId = $row['max_id'];

// Function to generate a random number between the minimum and maximum ID
function generateRandomNumber($min, $max) {
    return rand($min, $max);
}

$randomNumber = generateRandomNumber($minId, $maxId);

$faqs = array();

do {
    $sql = "SELECT question, answer FROM faq WHERE id = $randomNumber";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $faqs[] = $row;
        }
    }

    // If no matching FAQ found, generate a new random number
    if (empty($faqs)) {
        $randomNumber = generateRandomNumber($minId, $maxId);
    }

} while (empty($faqs));

?>

<div class="section-faq">
    <h2>Frequently Asked Questions</h2>
    <div class="faq-list">
        <?php foreach ($faqs as $faq) { ?>
            <div class="faq">
                <h3 class="faq-question"><?php echo $faq['question']; ?></h3>
                <p class="faq-answer"><?php echo $faq['answer']; ?></p>
            </div>
        <?php } ?>
    </div>
</div>
<div class="explore-more">
    <a href="faq.php" class="btn btn-primary" style="color:#ffb703">Explore More FAQs</a>
</div>

      </div>
    </div>
    <?php include 'inc/footer.php'; ?>
  </div>
</body>
</html>
