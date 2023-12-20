<?php
include "../inc/connect.php";

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["date"])) {
    $date = $_GET["date"];
    
    // Fetch transactions based on the given date
    $query = "SELECT * FROM transaction WHERE DATE(date) = '$date'";
    $result = $conn->query($query);
    
    $transactions = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $transactions[] = array(
                'id' => $row['id'],
                'date' => $row['date'],
                'name' => $row['name'],
                'email' => $row['email'],
                'area' => $row['area'],
                'lot_no' => $row['lot_no'],
                'duration' => $row['duration'],
                'fee' => $row['fee'],
                'status' => $row['status']
            );
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($transactions);
}
?>
