<!DOCTYPE html>
<html>
<head>
    <title>Payment Approved</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-success">Payment Approved</h1>
        <p>Your payment has been approved.</p>
        
        <!-- Download Receipt Button -->
        <a href="../../unbooking/generate_recipt.php" class="btn btn-primary">Download Receipt</a>
        
        <!-- Link to View Details in Mail -->
        <a href="mail.php?id=<?php echo $id; ?>&email=<?php echo $email; ?>" class="btn btn-info">View Details in Mail</a>
        
        <!-- Countdown and Skip Button -->
        <p>You will be redirected to All Transactions in <span id="countdown">5</span> seconds.</p>
        <button id="skipButton" class="btn btn-secondary">Skip</button>
    </div>

    <!-- Include Bootstrap JS and JavaScript for Countdown -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Countdown to redirect
        let countdown = 5;
        const countdownElement = document.getElementById("countdown");
        const skipButton = document.getElementById("skipButton");

        const updateCountdown = () => {
            countdown--;
            countdownElement.innerText = countdown;

            if (countdown <= 0) {
                // Redirect to alltransaction.php when countdown reaches 0
                window.location.href = "alltransaction.php";
            }
        };

        // Update the countdown every second
        const countdownInterval = setInterval(updateCountdown, 1000);

        // Handle Skip button click
        skipButton.addEventListener("click", () => {
            clearInterval(countdownInterval); // Stop the countdown
            window.location.href = "alltransaction.php"; // Redirect immediately
        });
    </script>
</body>
</html>
