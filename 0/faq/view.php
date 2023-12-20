<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin FAQ Management</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
include "../inc/header.php";
?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Admin FAQ Management</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../inc/connect.php";

            // Pagination settings
            $results_per_page = 10;
            $query = "SELECT COUNT(*) as total FROM faq";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $total_records = $row['total'];
            $total_pages = ceil($total_records / $results_per_page);

            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }

            $start = ($page - 1) * $results_per_page;

            // Retrieve FAQs from the database with pagination
            $select_query = "SELECT * FROM faq LIMIT $start, $results_per_page";
            $result = mysqli_query($conn, $select_query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['question']}</td>";
                echo "<td>{$row['answer']}</td>";
                echo "<td>
                         <a href='update.php?id={$row['id']}' class='btn btn-primary'>Update</a>
                         <button class='btn btn-danger' data-toggle='modal' data-target='#deleteModal{$row['id']}'>Delete</button>
                      </td>";
                echo "</tr>";

                // Modal for Delete Confirmation
                echo "<div class='modal fade' id='deleteModal{$row['id']}' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel{$row['id']}' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered' role='document'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h5 class='modal-title' id='deleteModalLabel{$row['id']}'>Confirm Delete</h5>
                              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>
                            <div class='modal-body'>
                              Are you sure you want to delete this FAQ?
                            </div>
                            <div class='modal-footer'>
                              <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                              <a href='delete.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                            </div>
                          </div>
                        </div>
                      </div>";
            }

            mysqli_close($conn);
            ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<li class='page-item'><a class='page-link' href='faq_admin.php?page=$i'>$i</a></li>";
            }
            ?>
        </ul>
    </nav>

    <a href='insert.php' class='btn btn-success' style='position: fixed; bottom: 20px; left: 20px;'>Add FAQ</a>
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
