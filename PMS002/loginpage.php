<?php
include 'inc/header.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login and Signup</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <style>
    .section {
      display: none;
      opacity: 0;
      transition: opacity 0.5s ease;
    }

    .section.active {
      display: block;
      opacity: 1;
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-6">

      <?php
                if (isset($_GET['message'])) {
                    $message = urldecode($_GET['message']);
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                              ' . $message . '
                              
                          </div>';
                }
                ?>

        <!-- Login Section -->
        <section id="loginSection" class="section active">
          <h2 class="text-center mb-4">Sign In To <span style="color:#ffb703;">ParkEasy</span></h2>
          <form id="loginForm" action="proc/login.php" method="POST">
            <div class="mb-3">
              <input type="email" class="form-control" name="email" placeholder="example@domain.com" required />
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" name="password" placeholder="Password" required />
            </div>
            <div class="text-center">
            <input type="Submit" class="btn" style="background-color:#ffb703;" name="Submit" value="Sign In" />
            </div>
            <p class="text-center mt-3">Forgot Password ? <a href="recover/recover.php">Click Here</a></p>

            <p class="text-center mt-3">Don't have an account? <span id="showSignupLink" class="text-primary">Create Account</span></p>
          </form>
        </section>

        <!-- Signup Section -->
        <section id="signupSection" class="section">
          <h2 class="text-center mb-4">Sign Up To <span style="color:#ffb703;">ParkEasy</span></h2>
          <form id="signupForm" action="proc/reg.php" method="POST">
            <div class="mb-3">
              <input type="text" class="form-control" name="fname" placeholder="First Name" required />
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" name="lname" placeholder="Last Name" required />
            </div>
            <div class="mb-3">
              <input type="email" class="form-control" name="email" placeholder="Email" required />
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" name="phone" placeholder="Phone Number" required />
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" name="password" placeholder="Password" required />
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" name="plate" placeholder="Plate No" required />
            </div>
            <div class="text-center">
            <input type="Submit" class="btn " style="background-color:#ffb703;" name="Submit" value="Sign Up" />
            </div>
            <p class="text-center mt-3">Already have an account? <span id="showLoginLink" class="text-primary">Sign In</span></p>
          </form>
        </section>
      </div>
    </div>
  </div>

  <script>
    // Show login section and hide signup section by default
    document.getElementById('loginSection').classList.add('active');

    // Show signup section and hide login section when "Create Account" is clicked
    document.getElementById('showSignupLink').addEventListener('click', function () {
      document.getElementById('loginSection').classList.remove('active');
      document.getElementById('signupSection').classList.add('active');
    });

    // Show login section and hide signup section when "Sign In" is clicked
    document.getElementById('showLoginLink').addEventListener('click', function () {
      document.getElementById('signupSection').classList.remove('active');
      document.getElementById('loginSection').classList.add('active');
    });
  </script>
</body>
</html>
