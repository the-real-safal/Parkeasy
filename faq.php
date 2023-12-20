<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        .mb-0{
            color: aqua;
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
<header class="nav-head" style="position:sticky; top:0px; z-index: 1;">
    <?php include('inc/header.php'); ?>
  </header>
<div class="container mt-5">
    <h1 class="text-center mb-4">Frequently Asked Questions</h1>
    <?php
    include "inc/connect.php";

    // Retrieve FAQs from the database
    $select_query = "SELECT * FROM faq";
    $result = mysqli_query($conn, $select_query);

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="accordion" id="faqAccordion">';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="card">';
            echo '<div class="card-header" id="heading' . $row['id'] . '">';
            echo '<h2 class="mb-0">';
            echo '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse' . $row['id'] . '" aria-expanded="true" aria-controls="collapse' . $row['id'] . '">';
            echo $row['question'];
            echo '</button>';
            echo '</h2>';
            echo '</div>';
            echo '<div id="collapse' . $row['id'] . '" class="collapse" aria-labelledby="heading' . $row['id'] . '" data-parent="#faqAccordion">';
            echo '<div class="card-body">';
            echo $row['answer'];
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p class="text-center">No FAQs available at the moment.</p>';
    }

    mysqli_close($conn);
    ?>
</div>
<br>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php 
include "inc/footer.php";
?>