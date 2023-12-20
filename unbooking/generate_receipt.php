<?php
require('../fpdf/fpdf.php');
include "../inc/connect.php";
session_start();
$email = $_SESSION["email"];

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    $sql = "SELECT transaction_code FROM booking WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $txn = $row["transaction_code"];
    }

    $sql = "SELECT name FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
    }

    $query = "SELECT t.*, a.name AS area_name 
              FROM transaction t
              JOIN areas a ON t.area_id = a.id
              WHERE t.pay_id = '$txn'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $txId = $row['id'];
        $date = $row['date'];
        $areaName = $row['area_name'];
        $lotNo = $row['lot_no'];
        $duration = $row['duration'];
        $charge = $row['charge'];
        $status = $row['status'];
        $payId = $row['pay_id'];
        $refId = $row['ref_id'];

        // Create a new PDF instance
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Add the "ParkEasy Ltd." heading
        $pdf->Cell(0, 10, 'ParkEasy Ltd.', 0, 1, 'C');
        // Add your logo image
        $pdf->Image('../src/navicon.png', 10, 10, 40); // Adjust the coordinates as needed


        // Add the invoice title and user's name
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
        $pdf->Cell(0, 10, 'Customer: ' . $name, 0, 1, 'L');

        // Add transaction details
        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'Transaction Details', 0, 1, 'L');
        $pdf->Cell(50, 10, 'Transaction ID:', 0);
        $pdf->Cell(0, 10, $txId, 0, 1, 'L');
        $pdf->Cell(50, 10, 'Date:', 0);
        $pdf->Cell(0, 10, $date, 0, 1, 'L');
        $pdf->Cell(50, 10, 'Area:', 0);
        $pdf->Cell(0, 10, $areaName, 0, 1, 'L');
        $pdf->Cell(50, 10, 'Lot No:', 0);
        $pdf->Cell(0, 10, $lotNo, 0, 1, 'L');
        $pdf->Cell(50, 10, 'Duration:', 0);
        $pdf->Cell(0, 10, $duration . ' hours', 0, 1, 'L');
        $pdf->Cell(50, 10, 'Charge:', 0);
        $pdf->Cell(0, 10, 'Rs.' . $charge, 0, 1, 'L');
        $pdf->Cell(50, 10, 'Status:', 0);
        $pdf->Cell(0, 10, $status, 0, 1, 'L');
        $pdf->Cell(50, 10, 'Payment Method:', 0);
        $pdf->Cell(0, 10, 'Cash/Epay', 0, 1, 'L');
        $pdf->Cell(50, 10, 'Payment ID:', 0);
        $pdf->Cell(0, 10, $payId, 0, 1, 'L');
        $pdf->Cell(50, 10, 'Reference ID:', 0);
        $pdf->Cell(0, 10, $refId, 0, 1, 'L');

        // Output the PDF
        $pdf->Output('D', 'Invoice.pdf'); // Output the PDF to the browser and prompt download
    } else {
        // Handle the case where data is not available
        echo "No data found.";
    }
} else {
    // Handle the case where the transaction ID is not provided
    echo "Transaction ID not provided.";
}
?>
