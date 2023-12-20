<?php
			include('inc/header.php');
						
	?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    /* Custom CSS */
    body {
      padding-top: 40px;
      background-color: #f5f5f5;
    }
    
    .container {
      max-width: 800px;
      margin: 0 auto;
    }
    
    .section-title {
      text-align: center;
      margin-bottom: 40px;
    }
    
    .contact-form {
      background-color: #fff;
      padding: 40px;
      border-radius: 4px;
    }
    
    .form-group label {
      font-weight: bold;
    }
    
    .contact-details {
      background-color: #f8f9fa;
      padding: 40px;
      border-radius: 4px;
      height: 500px;
    }
    
    .map-container {
      height: 100%;
    }
  </style>
</head>
<?php
		//	include('inc/header.php');
						
	?>
<body>

  <div class="container">
    <h1 class="text-center">Contact Us</h1>
    <div class="row">
      <div class="col-md-6">
        <div class="contact-form">
          <h2 class="section-title">Get in Touch</h2>
          <form action="proc/contact.php" method="POST">
            <div class="form-group">
              <label for="name">Name</label>
              <input name="name" type="text" class="form-control" id="name" required>
            </div>
            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input name="phone" type="tel" class="form-control" id="phone" required>
            </div>
            <div class="form-group">
              <label for="message">Your Message</label>
              <textarea name="msg" class="form-control" id="message" rows="5" required></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="contact-details">
          <h2 class="section-title">Contact Details</h2>
          <p><strong>Address:</strong> 123 Park Street, City, State, Country</p>
          <p><strong>Email:</strong> info@example.com</p>
          <p><strong>Phone:</strong> +1 234 567890</p>
          <div class="map-responsive">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12345.67890!2d-71.062899!3d42.360081!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e370a45f045f05%3A0xd7e65c1b72a0b151!2sExample%20Location!5e0!3m2!1sen!2sus!4v1632505622222!5m2!1sen!2sus"
              frameborder="0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
