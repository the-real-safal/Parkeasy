<?php
include('inc/connect.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    
    if ($action === 'restrict') {
        $ids = $_POST['selector'];
        $confirmMessage = "Restricting user will ban user from using the service. Are you sure you want to continue?";
        
        echo '<script>
                var confirmChange = confirm("' . $confirmMessage . '");
                if (confirmChange) {
                    window.location.href = "?action=restrict&id=' . implode(",", $ids) . '";
                } else {
                    window.location.href = "index.php";
                }
              </script>';
    } elseif ($action === 'allow') {
        $ids = $_POST['selector'];
        $confirmMessage = "Allowing user will grant access to the service. Are you sure you want to continue?";
        
        echo '<script>
                var confirmChange = confirm("' . $confirmMessage . '");
                if (confirmChange) {
                    window.location.href = "?action=allow&id=' . implode(",", $ids) . '";
                } else {
                    window.location.href = "index.php";
                }
              </script>';
    }
} elseif (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $ids = explode(",", $_GET['id']);
    
    foreach ($ids as $id) {
        if ($action === 'restrict') {
            // Update the access level to 3 to restrict user
            mysqli_query($connect, "UPDATE users SET access = 3 WHERE id='$id'");
        } elseif ($action === 'allow') {
            // Update the access level to 2 to allow user
            mysqli_query($connect, "UPDATE users SET access = 2 WHERE id='$id'");
        }
    }
    
    header("location: users.php");
} else {
    echo "No action specified.";
}
?>
