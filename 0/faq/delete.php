<?php
include "../inc/connect.php";
// Delete FAQ based on the provided ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete_query = "DELETE FROM faq WHERE id=$id";

    if (mysqli_query($conn, $delete_query)) {
        header("Location: view.php");
        exit();
    } else {
        echo "Error deleting FAQ: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
