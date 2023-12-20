<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <header>
        <?php include('inc/header.php'); ?>
    </header>
    
    <section id="content" class="container my-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card p-4">
                    <h2 class="text-center mb-4">New Admin Registration</h2>
                    <form id="registration" action="proc/reg.php" method="post">
                        <div class="mb-3">
                            <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                            <div id="fname-validation"></div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                            <div id="lname-validation"></div>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="example@domain.com" required>
                            <div id="email-validation"></div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                            <div id="password-validation"></div>
                        </div>
                        <button id="submitButton" type="submit" class="btn btn-primary w-100" >Create Account</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<script>
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