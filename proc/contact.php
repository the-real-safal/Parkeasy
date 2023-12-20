<?php
    include('../inc/connect.php');
    include('../inc/insert.php');
    session_start();
    
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $msg = $_POST['msg'];
        $table_name = 'messages';
        
        $user_id = 0; // Initialize user_id with null
        
        // Check if user is logged in
        if (isset($_SESSION['email'])) {
            $logged_in_email = $_SESSION['email'];
            
            // Retrieve the user_id from the database based on the logged in email
            $sql = "SELECT id FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $logged_in_email); // Use "s" for a string parameter
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $user_id = $row["id"];
            } else {
                echo "User not found in the database.";
                exit; // Terminate the script
            }
        }
        
        date_default_timezone_set('Asia/Kathmandu');
        $current_time = new DateTime();
        $current_time_formatted = $current_time->format('Y-m-d H:i:s'); // Format the DateTime object
        
        $sql = "INSERT INTO $table_name (msgdate, name, email, msg) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $current_time_formatted, $name, $email, $msg);
        
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            echo "<script>alert('Successfully send message!')</script>";
            echo "<script>window.location='../contact.php'</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
?>
