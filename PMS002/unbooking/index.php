<?php
session_start();
include "../inc/connect.php";

// Set the number of results per page
$resultsPerPage = 10;

$email = $_SESSION["email"]; // Assuming email is stored in the session

// Fetch total number of rows for pagination calculation
$totalRowsQuery = "SELECT COUNT(*) AS total FROM booking WHERE email = '$email'";
$totalRowsResult = $conn->query($totalRowsQuery);
$totalRows = $totalRowsResult->fetch_assoc()['total'];

// Calculate total number of pages
$totalPages = ceil($totalRows / $resultsPerPage);

// Get current page from query parameter, default to 1 if not set
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate starting row for the query
$startRow = ($current_page - 1) * $resultsPerPage;

// Fetch data from the booking table based on email, ordered by entry date in descending order, with pagination
$query = "SELECT * FROM booking WHERE email = '$email' ORDER BY e_date DESC LIMIT $startRow, $resultsPerPage";
$result = $conn->query($query);

$data = []; // Array to hold fetched data

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Add each row to the data array
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
/* Default color for pagination links */
.pagination a.page-link {
    color: #ffb703;
}

/* Selected pagination link */
.pagination .page-item.active .page-link {
    color: white;
    background-color: #ffb703; /* You can also set a background color for the selected link */
}

        </style>
</head>
<body>
    <?php include "../inc/header.php"; ?>
    <div class="container mt-5">
        <h2>Welcome to Your Dashboard, <?php echo $_SESSION["name"]; ?></h2>
        <table class="table table-bordered table-hover">
        <thead class="thead-light">
                <tr>
                    <th>Area</th>
                    <th>Lot No</th>
                    <th>Vehicle Type</th>
                    <th>Lisence No.</th>
                    <th>Plate No</th>
                    <th>Entry Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row) : ?>
                    <tr>
                        <td><?php echo $row['area']; ?></td>
                        <td><?php echo $row['lot_no']; ?></td>
                        <td><?php echo $row['v_type']; ?></td>
                        <td><?php echo $row['lis_no']; ?></td>
                        <td><?php echo $row['plate_no']; ?></td>
                        <td><?php echo $row['e_date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <?php
                            $_SESSION["area"] = $row['area'];
                            $_SESSION["lot_no"] = $row['lot_no'];
                            $_SESSION["plate_no"] = $row['plate_no'];
                            $_SESSION["e_date"] = $row['e_date'];
                            $_SESSION["status"] = $row['status'];
                            $_SESSION['v_type'] = $row['v_type'];
                            $_SESSION['lis_no'] = $row['lis_no'];

                            if ($row['status'] === 'unbooked') {
                                echo '<a href="generate_receipt.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">Download Receipt</a>';
                            } else {
                                echo '<form action="fee_calc.php" method="post">';
                                echo '<input type="hidden" name="booking_id" value="' . $row['id'] . '">';
                                echo '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to unbook this space?\')">Unbook</button>';
                                echo '</form>';
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Pagination links -->
<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php for ($page = 1; $page <= $totalPages; $page++): ?>
            <li class="page-item <?php if ($page === $current_page) echo 'active'; ?>">
                <a class="page-link" href="?page=<?php echo $page; ?>" ><?php echo $page; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

    </div>
</body>
</html>
