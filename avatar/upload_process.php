<?php 
include "../inc/connect.php";
if (empty($_FILES['new-image']['name'])) {
  $new_name = $_POST['old_image'];
} else {
  $errors = array();

  $file_name = $_FILES['new-image']['name'];
  $file_size = $_FILES['new-image']['size'];
  $file_tmp = $_FILES['new-image']['tmp_name'];
  $file_type = $_FILES['new-image']['type'];
  $file_ext = strtolower(end(explode('.', $file_name))); // Convert extension to lowercase

  $extensions = array("jpeg", "jpg", "png");

  if (in_array($file_ext, $extensions) === false) {
    $errors[] = "This extension file is not allowed. Please choose a JPG or PNG file.";
  }

  if ($file_size > 10485760) {
    $errors[] = "File size must be 10MB or lower.";
  }

  $new_name = time() . "-" . basename($file_name);
  $target = "upload/" . $new_name;
  $image_name = $new_name;

  if (empty($errors)) {
    if (move_uploaded_file($file_tmp, $target)) {
      // File uploaded successfully, proceed with database update
      $id = 8;
      $sql = "UPDATE users SET avatar = '$image_name' WHERE id = '$id'";
      if (mysqli_query($conn, $sql)) {
        // Avatar updated successfully
        echo "Avatar updated successfully.";
      } else {
        echo "Error updating avatar: " . mysqli_error($conn);
      }
    } else {
      echo "Error uploading file.";
    }
  } else {
    print_r($errors);
  }
}
?>
