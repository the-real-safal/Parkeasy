<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin FAQ Update</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Admin FAQ Update</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="question">Question:</label>
            <input type="text" class="form-control" id="question" name="question" required>
        </div>
        <div class="form-group">
            <label for="answer">Answer:</label>
            <textarea class="form-control" id="answer" name="answer" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update FAQ</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "../inc/connect.php";
        $question = $_POST["question"];
        $answer = $_POST["answer"];

        // Use prepared statements to insert data safely
        $insert_query = "INSERT INTO faq (question, answer) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt, "ss", $question, $answer);

        if (mysqli_stmt_execute($stmt)) {
            echo "<p class='mt-3 text-success'>FAQ updated successfully!</p>";
            echo "<a href='view.php' class='btn btn-primary mt-2'>Review FAQs</a>";
        } else {
            echo "<p class='mt-3 text-danger'>Error updating FAQ: " . mysqli_error($conn) . "</p>";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    ?>
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
