<!DOCTYPE html>
<html>
<head>
    <title>Payment Failed</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 text-center">
        <div class="alert alert-danger" role="alert">
            Payment Failed. Please try again.
        </div>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "unbooking/index.php";
        }, 3000); // Redirect after 3 seconds
    </script>
</body>
</html>
