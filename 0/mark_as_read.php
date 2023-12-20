<?php
include('inc/connect.php');

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  
  // Update the 'is_read' field to 1
  $updateQuery = mysqli_query($connect, "UPDATE messages SET is_read = 1 WHERE id = $id");
  
  if ($updateQuery) {
    // Redirect back to the messages page or display a success message
    header("Location: messages.php"); // Change 'messages.php' to the actual page name
    exit;
  } else {
    echo "Error updating message status.";
  }
} else {
  echo "Invalid message ID.";
}
?>
