<?php 
include "../inc/header.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login and Signup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
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
    </style>
</head>
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

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <?php
                if (isset($_GET['message'])) {
                    $message = urldecode($_GET['message']);
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $message . '</div>';
                }
                ?>
                <!-- Login Section -->
                <section id="loginSection" class="section active">
                    <h2 class="text-center mb-4">Sign In To <span style="color:#ffb703;">ParkEasy</span></h2>
                    <form id="loginForm" action="log.php" method="POST">
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
                    <form id="signupForm" action="reg.php" method="POST">
                    <div class="mb-3">
    <input type="text" class="form-control" name="fname" placeholder="First Name" required />
    <div id="fname-validation"></div>
</div>
<div class="mb-3">
    <input type="text" class="form-control" name="lname" placeholder="Last Name" required />
    <div id="lname-validation"></div>
</div>

<div class="mb-3">
    <input type="email" class="form-control" name="email" placeholder="Email" required />
    <div id="email-validation"></div>
</div>

            <div class="mb-3">
              <input type="text" class="form-control" name="phone" placeholder="Phone Number (Starting with 9)" pattern="[9][0-9]{9}" required />
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
            </div>
            <div id="password-validation">
              <p class="text-muted">Password must contain at least 8 characters, 1 uppercase letter, 1 special character, and 1 number.</p>
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" name="lis_no" placeholder="License No." required />
            </div>
            <div class="text-center">
              <input type="Submit" class="btn" style="background-color:#ffb703;" name="Submit" id="submitButton" value="Sign Up" disabled />
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

    // First Name validation
const fnameInput = document.getElementsByName('fname')[0]; // Get the first name input element
const fnameValidation = document.getElementById('fname-validation');

fnameInput.addEventListener('input', function () {
    const firstName = fnameInput.value;

    // Regular expression to validate name (only letters, spaces allowed)
    const nameRegex = /^[A-Za-z\s]+$/;

    if (nameRegex.test(firstName)) {
        fnameValidation.innerHTML = '<p class="text-success">First Name is valid.</p>';
    } else {
        fnameValidation.innerHTML = '<p class="text-danger">Invalid First Name. Only letters and spaces allowed.</p>';
    }
});

// Last Name validation
const lnameInput = document.getElementsByName('lname')[0]; // Get the last name input element
const lnameValidation = document.getElementById('lname-validation');

lnameInput.addEventListener('input', function () {
    const lastName = lnameInput.value;
    const nameRegex = /^[A-Za-z\s]+$/;
    if (nameRegex.test(lastName)) {
        lnameValidation.innerHTML = '<p class="text-success">Last Name is valid.</p>';
    } else {
        lnameValidation.innerHTML = '<p class="text-danger">Invalid Last Name. Only letters and spaces allowed.</p>';
    }
});


    // Password validation
    const passwordInput = document.getElementById('password');
    const passwordValidation = document.getElementById('password-validation');
    const submitButton = document.getElementById('submitButton');

    passwordInput.addEventListener('input', function () {
      const password = passwordInput.value;

      // Regular expressions to validate password requirements
      const lengthRegex = /.{8,}/;
      const uppercaseRegex = /[A-Z]/;
      const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;
      const numberRegex = /\d/;

      let message = '';

      if (!lengthRegex.test(password)) {
        message += 'Password must have at least 8 characters. ';
      }
      if (!uppercaseRegex.test(password)) {
        message += 'Password must have at least 1 uppercase letter. ';
      }
      if (!specialCharRegex.test(password)) {
        message += 'Password must have at least 1 special character. ';
      }
      if (!numberRegex.test(password)) {
        message += 'Password must have at least 1 number. ';
      }

      if (message === '') {
        passwordValidation.innerHTML = '<p class="text-success">Password is valid.</p>';
        submitButton.removeAttribute('disabled');
      } else {
        passwordValidation.innerHTML = '<p class="text-danger">' + message + '</p>';
        submitButton.setAttribute('disabled', 'true');
      }
    });
    // Email validation
const emailInput = document.getElementsByName('email')[0]; // Get the email input element
const emailValidation = document.getElementById('email-validation');

emailInput.addEventListener('input', function () {
    const email = emailInput.value;

    // Regular expression to validate email
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (emailRegex.test(email)) {
        emailValidation.innerHTML = '<p class="text-success">Email is valid.</p>';
    } else {
        emailValidation.innerHTML = '<p class="text-danger">Invalid email address.</p>';
    }
});

  </script>

</body>
</html>
