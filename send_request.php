
<?php
       
            include("inc/connect.php");
            
            $sql = "SELECT name FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id= $row["id"];
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $msg = $_POST['reason'];
        $msg_type = 'Unban';
        $sql = "SELECT name FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row["id"];
        }
        
        // Prepare and execute the SQL query
$query = "INSERT INTO messages (user_id, name, email, msg, msg_type) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("issss", $user_id, $name, $email, $msg, $msg_type);
$messageSent = $stmt->execute();


// Close the statement and connection
$stmt->close();
$conn->close();

// Redirect back to the form or a confirmation page
header("Location: index.php?success=true");
exit();
    }