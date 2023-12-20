<?php
include "../inc/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $question = $_POST["question"];
    $answer = $_POST["answer"];

    // Update FAQ in the database
    $update_query = "UPDATE faq SET question='$question', answer='$answer' WHERE id=$id";
    if (mysqli_query($conn, $update_query)) {
        header("Location: view.php");
        exit();
    } else {
        echo "Error updating FAQ: " . mysqli_error($conn);
    }
}

// Retrieve FAQ details for the given ID
$id = $_GET["id"];
$select_query = "SELECT * FROM faq WHERE id=$id";
$result = mysqli_query($conn, $select_query);
$faq = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update FAQ</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Update FAQ</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $faq['id']; ?>">
        <div class="form-group">
            <label for="question">Question:</label>
            <input type="text" class="form-control" id="question" name="question" value="<?php echo $faq['question']; ?>" required>
        </div>
        <div class="form-group">
            <label for="answer">Answer:</label>
            <textarea class="form-control" id="answer" name="answer" rows="4" required><?php echo $faq['answer']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update FAQ</button>
    </form>
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
