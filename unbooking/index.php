<?php
session_start();
include "../inc/connect.php";

// Set the number of results per page
$resultsPerPage = 10;

$email = $_SESSION["email"]; // Assuming email is stored in the session
$sql = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userId = $row["id"];
}

$sql = "SELECT id FROM booking WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $bookingId = $row["id"];
}

// $sql = "SELECT id FROM transaction WHERE user_id = ?";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("i", $userId);
// $stmt->execute();
// $result = $stmt->get_result();

// if ($result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $userId = $row["id"];
// }

// Fetch total number of rows for pagination calculation
$totalRowsQuery = "SELECT COUNT(*) AS total FROM booking WHERE user_id = ?";
$totalRowsStmt = $conn->prepare($totalRowsQuery);
$totalRowsStmt->bind_param("i", $userId);
$totalRowsStmt->execute();
$totalRowsResult = $totalRowsStmt->get_result();
$totalRows = $totalRowsResult->fetch_assoc()['total'];

// Calculate total number of pages
$totalPages = ceil($totalRows / $resultsPerPage);

// Get current page from query parameter, default to 1 if not set
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate starting row for the query
$startRow = ($current_page - 1) * $resultsPerPage;

// Fetch data from the booking table based on user id, ordered by entry date in descending order, with pagination
$query = "SELECT b.*, a.name AS area_name, vt.name AS vehicle_type_name FROM booking AS b
          INNER JOIN areas AS a ON b.area_id = a.id
          INNER JOIN vehicle_types AS vt ON b.vehicle_type_id = vt.id
          WHERE b.user_id = ? ORDER BY e_date DESC LIMIT ?, ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("iii", $userId, $startRow, $resultsPerPage);
$stmt->execute();
$result = $stmt->get_result();

$data = []; // Array to hold fetched data

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Add each row to the data array
    }
}

// Sort the data by entry date using Bubble Sort// Sort the data by entry date in descending order
function bubbleSort(&$array) {
    $n = count($array);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if (strtotime($array[$j]['e_date']) < strtotime($array[$j + 1]['e_date'])) {
                // Swap the elements to sort in descending order
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }
}

bubbleSort($data); // Call the sorting function in descending order

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
                    <th>Id</th>
                    <th>Area</th>
                    <th>Lot No</th>
                    <th>Vehicle Type</th>
                    <th>License No.</th>
                    <th>Plate No</th>
                    <th>Entry Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['area_name']; ?></td>
                        <td><?php echo $row['lot_no']; ?></td>
                        <td><?php echo $row['vehicle_type_name']; ?></td>
                        <td><?php echo $row['lis_no']; ?></td>
                        <td><?php echo $row['plate_no']; ?></td>
                        <td><?php echo $row['e_date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <?php
                            $_SESSION["area"] = $row['area_name'];
                            $_SESSION["lot_no"] = $row['lot_no'];
                            $_SESSION["plate_no"] = $row['plate_no'];
                            $_SESSION["e_date"] = $row['e_date'];
                            $_SESSION["status"] = $row['status'];
                            $_SESSION['v_type'] = $row['vehicle_type_name'];
                            $_SESSION['lis_no'] = $row['lis_no'];

                            if ($row['status'] === 'unbooked'||$row['status'] === 'check out') {
                                echo '<a href="generate_receipt.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">Download Receipt</a>';
                            } elseif($row['status'] === 'pending'){
                                echo '<a href="../booking/payment.php?id=' . $row['id'] . '" class="btn btn-success btn-sm">Confirm Booking</a>';
                            } elseif($row['status'] === 'check in'){
                                echo 'Checked In';
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
                        <a class="page-link" href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</body>
</html>
