<?php
session_start();
include "../inc/connect.php";
include "../inc/header.php";

$email = $_SESSION["email"];

// Fetch data from the transaction table with sorting by date in descending order
$query = "SELECT transaction.*, users.name, users.email AS user_email, areas.name AS area_name 
          FROM transaction 
          INNER JOIN users ON transaction.user_id = users.id 
          INNER JOIN areas ON transaction.area_id = areas.id
          ORDER BY transaction.date DESC"; // Sort by date in descending order

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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
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
            <th>Transaction ID</th>
            <th>Reference ID</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['user_email']; ?></td>
                <td><?php echo $row['area_name']; ?></td>
                <td><?php echo $row['lot_no']; ?></td>
                <td><?php echo $row['duration']; ?></td>
                <td><?php echo $row['charge']; ?></td>
                <td>
                    <?php
                    if ($row['status'] === 'pending') {
                        // Serialize the row data as a query string
                        $rowData = http_build_query($row);

                        // Display "Approve" button for pending status
                        echo '<a href="approve.php?' . $rowData . '" class="btn btn-warning">Approve</a>';
                    } elseif ($row['status'] === 'paid') {
                        // Display "Paid" label for paid status
                        echo '<span style="color:#09814A">Paid</span>';
                    } else {
                        echo $row['status'];
                    }
                    ?>
                </td>
                <td><?php echo $row['pay_id']; ?></td>
                <td><?php echo $row['ref_id']; ?></td>
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
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script>
    $(document).ready(function () {
        const transactionTable = $('table').DataTable({
            dom: 'Bfrtip', // Add the export buttons to the DOM
            buttons: [
                'csv', // CSV export button
                {
                    extend: 'pdfHtml5', // PDF export button
                    customize: function (doc) {
                        doc.defaultStyle.fontSize = 10;
                    }
                },
                'print' // Print button
            ]
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
