<div class="container mt-5">
    <h2 class="text-center mb-4">Frequently Asked Questions</h2>
    <?php
    include "connect.php";
    
    // Retrieve FAQs from the database
    $select_query = "SELECT * FROM faq LIMIT 5"; // Limit to 5 FAQs for the section
    $result = mysqli_query($conn, $select_query);
    
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="accordion" id="faqAccordion">';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="card">';
            echo '<div class="card-header" id="heading' . $row['id'] . '">';
            echo '<h5 class="mb-0">';
            echo '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse' . $row['id'] . '" aria-expanded="true" aria-controls="collapse' . $row['id'] . '">';
            echo $row['question'];
            echo '</button>';
            echo '</h5>';
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

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
