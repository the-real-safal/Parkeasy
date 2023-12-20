<?php
session_start();
include "../inc/connect.php";
include "../inc/header.php";

$email = $_SESSION["email"];

// Fetch all data from the transaction table
$query = "SELECT * FROM transaction";
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
    <title>All Transactions</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>All Transactions</h2>

    <!-- Add the "Daily Transaction" button here -->
    <a href="transaction.php" class="btn btn-primary mb-3">Daily Transaction</a>

    <table class="table table-bordered table-hover">
        <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Name</th>
            <th>Email</th>
            <th>Area</th>
            <th>Lot No.</th>
            <th>Duration</th>
            <th>Charge</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['area']; ?></td>
                <td><?php echo $row['lot_no']; ?></td>
                <td><?php echo $row['duration']; ?></td>
                <td><?php echo $row['charge']; ?></td>
                <td><?php echo $row['status']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="mt-3">
        <!-- Export buttons (CSV and PDF) -->
        <button class="btn btn-success float-right" id="exportCsvBtn">Export to CSV</button>
        <button class="btn btn-success float-right mr-2" id="exportPdfBtn">Export to PDF</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script>
    $(document).ready(function () {
        const transactionTable = $('table').DataTable({
            paging: true, // Enable pagination
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]], // Customize number of records per page
            buttons: [
                {
                    extend: 'pdf',
                    text: 'Export to PDF',
                    exportOptions: {
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'csv',
                    text: 'Export to CSV',
                    exportOptions: {
                        modifier: {
                            page: 'all'
                        }
                    }
                }
            ],
            //dom: 'Bfrtip', // Show buttons at the top
            dom: '<"row"<"col-sm-6"B><"col-sm-6"f>>' + // Custom positioning
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-5"i><"col-sm-7"p>>', // Include pagination and records per page
        });

        // Export to CSV button
        $('#exportCsvBtn').on('click', function () {
            transactionTable.button('.buttons-csv').trigger();
        });

        // Export to PDF button
        $('#exportPdfBtn').on('click', function () {
            transactionTable.button('.buttons-pdf').trigger();
        });
    });
</script>
</body>
</html>
