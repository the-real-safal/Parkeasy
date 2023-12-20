<?php
session_start();
$userLoggedIn = false; // Assume user is not logged in by default
$loggedInUserId='';
if (isset($_SESSION['email'])) {
    // User is logged in
    $userLoggedIn = true;
    $loggedInUserName = $_SESSION['name'];
    $loggedInUserEmail = $_SESSION['email'];
    $loggedInUserId=$_SESSION['uid'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
          /* Custom CSS */
    body {
      padding-top: 0px;
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
      background-color: #d8e2dc;
      padding: 40px;
      border-radius: 4px;
    }
    
    .form-group label {
      font-weight: bold;
    }
    
    .contact-details {
      background-color: #d8e2dc;
      padding: 40px;
      border-radius: 4px;
      height: 500px;
    }
    
    .map-container {
      height: 100%;
    }
        /* Add styles for the background SVG */
        .background-svg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: -1; /* Move the SVG background to the back */
        }

        /* Add styles for the login and signup sections */
        .section {
            position: relative; /* Set position to allow z-index to work */
            z-index: 1; /* Bring the content to the front */
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease;
            background-color: rgba(255, 255, 255, 0.8); /* Add a semi-transparent white background */
            border-radius: 10px;
            padding: 20px;
        }

        .section.active {
            display: block;
            opacity: 1;
        }
        /* Additional custom styles */
        .form-group {
            margin-bottom: 20px;
        }

        #msg_type {
            transition: transform 0.3s ease-in-out;
        }

        #msg_type.show {
            transform: scale(1.02);
        }

        /* Custom styling for the dropdown menu */
        .dropdown-menu {
            border: none;
            border-radius: 0.25rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            padding: 8px 12px;
            font-size: 14px;
        }

        .dropdown-item.active,
        .dropdown-item:active {
            background-color: #f8f9fa;
        }

    </style>
    <title>Message Form</title>
</head>
<body>
<body>
    <!-- Background SVG -->
    <svg class="background-svg" preserveAspectRatio="xMidYMid slice" viewBox="10 10 80 80">
        <defs>
            <style>
            @keyframes rotate {
					 0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }
            .out-top {
                animation: rotate 20s linear infinite;
                transform-origin: 13px 25px;
            }
            .in-top {
                animation: rotate 10s linear infinite;
                transform-origin: 13px 25px;
            }
            .out-bottom {
                animation: rotate 25s linear infinite;
                transform-origin: 84px 93px;
            }
            .in-bottom {
                animation: rotate 15s linear infinite;
                transform-origin: 84px 93px;
            }
        </style>
        </defs>
        <path fill="#9b5de5" class="out-top" d="M37-5C25.1-14.7,5.7-19.1-9.2-10-28.5,1.8-32.7,31.1-19.8,49c15.5,21.5,52.6,22,67.2,2.3C59.4,35,53.7,8.5,37-5Z"/>
        <path fill="#f15bb5" class="in-top" d="M20.6,4.1C11.6,1.5-1.9,2.5-8,11.2-16.3,23.1-8.2,45.6,7.4,50S42.1,38.9,41,24.5C40.2,14.1,29.4,6.6,20.6,4.1Z"/>
        <path fill="#00bbf9" class="out-bottom" d="M105.9,48.6c-12.4-8.2-29.3-4.8-39.4.8-23.4,12.8-37.7,51.9-19.1,74.1s63.9,15.3,76-5.6c7.6-13.3,1.8-31.1-2.3-43.8C117.6,63.3,114.7,54.3,105.9,48.6Z"/>
        <path fill="#00f5d4" class="in-bottom" d="M102,67.1c-9.6-6.1-22-3.1-29.5,2-15.4,10.7-19.6,37.5-7.6,47.8s35.9,3.9,44.5-12.5C115.5,92.6,113.9,74.6,102,67.1Z"/>
    </svg>
    <header class="nav-head" style="position:sticky; top:0px; z-index: 1;">
    <?php include('../inc/header.php'); ?>
  </header>

  <?php


// Check if the session variable is set
if (isset($_SESSION['messageSent'])) {
    // Display success or error message based on the session value
    if ($_SESSION['messageSent']) {
        $message = "Your message has been sent successfully.";
        $messageClass = "alert-success";
    } else {
        $message = "Failed to send the message. Please try again later.";
        $messageClass = "alert-danger";
    }

    // Clear the session variable after displaying the message
    unset($_SESSION['messageSent']);
}
?>

<!-- Display the message if set -->
<?php if (isset($message)): ?>
    <div class="alert <?php echo $messageClass; ?> mt-3"><?php echo $message; ?></div>
<?php endif; ?>



    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <!-- Message Form -->
                <form action="submit_message.php" method="POST">
                    <div class="form-group">
                        <input name="user_id" type="text" class="form-control" value="<?php echo $loggedInUserId; ?>" id="user_id" hidden>
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" required
                            <?php if ($userLoggedIn) echo 'value="' . $loggedInUserName . '"'; ?>>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input name="email" type="email" class="form-control" id="email" required
                            <?php if ($userLoggedIn) echo 'value="' . $loggedInUserEmail . '"'; ?>>
                    </div>

                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea name="msg" class="form-control" id="message" rows="5" placeholder="Please specify your purpose of message eg: unban account, payment issue, service error " required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="msg_type">Message Type:</label>
                        <select id="msg_type" name="msg_type" class="form-select">
                            <option value="normal">Normal</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
            <div class="col-md-6">
                <!-- Contact Details -->
                <div class="mt-3">
                    <h4>Contact Details</h4>
                    <p>Name: ParkEasy Company Ltd.</p>
                    <p>Email: parkeasycompany@gmail.com</p>
                    <p>Phone: +977 9865206654/9827273208 </p>
                    <!-- Add any additional contact details here -->
                </div>

                <!-- Google Map -->
                <div class="mt-3">
                    <h4>Location</h4>
                    <div class="map-responsive">
          <iframe id="map-iframe"
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12345.67890!2d84.5202715!3d27.6562162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjfCsDI4JzE5LjAiTiA4NMKwMTMnMTMuMiJF!5e0!3m2!1sen!2sus!4v1632505622222!5m2!1sen!2sus"
    frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add animation class to the dropdown menu when it's open
        document.getElementById('msg_type').addEventListener('show.bs.select', function () {
            this.classList.add('show');
        });

        // Remove animation class when the dropdown menu is closed
        document.getElementById('msg_type').addEventListener('hide.bs.select', function () {
            this.classList.remove('show');
        });
    </script>
    <br>
</body>
</html>
<?php 
include "../inc/footer.php";
?>