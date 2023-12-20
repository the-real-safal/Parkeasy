<?php
require('../fpdf/fpdf.php'); // Make sure to include the FPDF library
session_start();
// Get the transaction ID from the query parameter
if (isset($_GET['id'])) {
    $transactionId = $_GET['id'];
} else {
    // Redirect or show an error message
    header("Location: user_dashboard.php"); // Redirect to the dashboard page or wherever you want
    exit();
}

// Fetch data for the specified transaction ID from the database
include "../inc/connect.php"; // Include your database connection code

$query = "SELECT * FROM booking WHERE id = '$transactionId'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Create a new PDF instance
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Add the "ParkEasy Ltd." heading
    $pdf->Cell(0, 10, 'ParkEasy Ltd.', 0, 1, 'C');

    // Add the receipt details
    $pdf->Ln(10); // Add a line break
    $pdf->Cell(0, 10, 'Receipt Details', 0, 1, 'L');
    $pdf->Cell(40, 10, 'Transaction ID : ', 0);
    $pdf->Cell(0, 10, $row['id'], 0, 1);
    $pdf->Cell(40, 10, 'Name:', 0);
    $pdf->Cell(0, 10, $_SESSION['name'], 0, 1);
    $pdf->Cell(40, 10, 'Email:', 0);
    $pdf->Cell(0, 10, $_SESSION['email'], 0, 1);
    $pdf->Cell(40, 10, 'Area:', 0);
    $pdf->Cell(0, 10, $row['area'], 0, 1);
    $pdf->Cell(40, 10, 'Lot No:', 0);
    $pdf->Cell(0, 10, $row['lot_no'], 0, 1);
    $pdf->Cell(40, 10, 'Vehicle Type:', 0);
    $pdf->Cell(0, 10, $row['v_type'], 0, 1);
    $pdf->Cell(40, 10, 'License No:', 0);
    $pdf->Cell(0, 10, $row['lis_no'], 0, 1);
    $pdf->Cell(40, 10, 'Plate No:', 0);
    $pdf->Cell(0, 10, $row['plate_no'], 0, 1);
    $pdf->Cell(40, 10, 'Entry Date:', 0);
    $pdf->Cell(0, 10, $row['e_date'], 0, 1);
    $pdf->Cell(40, 10, 'Fee:', 0);
    $pdf->Cell(0, 10, 'Rs. ' . $row['charge'], 0, 1);

    // Output the PDF
    $pdf->Output('D', 'Receipt.pdf'); // Output the PDF to the browser and prompt download
} else {
    // Redirect or show an error message
    header("Location: index.php"); // Redirect to the dashboard page or wherever you want
    exit();
}
?>
