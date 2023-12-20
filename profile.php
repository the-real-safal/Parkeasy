<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>My Profile</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- Add Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  /* Additional custom CSS for hover effects and animations */
  .profile-card {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 20px;
    margin: 20px auto;
    max-width: 400px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    opacity: 0; /* Set initial opacity to 0 for animation */
  }

  .profile-card:hover {
    transform: scale(1.05);
    transition: transform 0.3s ease-in-out;
  }

  /* Fade-in animation when the page loads */
  @keyframes fadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }

  .animated {
    animation: fadeIn 1s ease-in-out;
  }

  /* Style for the avatar image frame */
  .avatar-frame {
    border: 3px solid #007bff; /* Replace #007bff with the desired color */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    margin: 0 auto 20px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .avatar-frame img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
  }
</style>

</head>
<body>
<section id="container">
<?php
  include ('inc/header.php');
  include('inc/connect.php');
  // Your PHP code for including header, connection, and fetching user data goes here
?>

<section id="content" class="container">
  <div class="profile-card animated">
    <div class="text-center">
    <div><span>My Profile</span></div>
      <div class="avatar-frame"> <!-- Avatar image frame -->
        <img src="src/avatar.png" alt="Avatar" /> <!-- Replace with the path to the actual avatar image -->
      </div>
      
      <?php
      $password = $_SESSION['password'];
      $email = $_SESSION['email'];
      $query = "SELECT * FROM users WHERE password='$password' AND email ='$email'";
      $result = $conn->query($query);
      while ($rows = $result->fetch_assoc()) {
      ?>

      <?php
        // Replace this with actual user data fetched from the database
        $userProfile = array(
          'name' => $rows['name'],
          'phone' => $rows['phone'],
          'id' => $rows['id'],
          'lis_no' => $rows['lis_no']
        );}
      ?>
      <form action="update.php" method="POST">
      <div class="form-group">ID. NO: <span><input class="form-control" type="text" name="id" value="<?php echo $userProfile['id']; ?>" disabled="disabled" /></span></div> <br>
        <div class="form-group">NAME: <span><input class="form-control" type="text" name="name" value="<?php echo $userProfile['name']; ?>" /></span></div><br>
        <div class="form-group">PHONE: <span><input class="form-control" type="text" name="phone" value="<?php echo $userProfile['phone']; ?>" /></span></div><br>
        <div class="form-group">LIsence No: <span><input class="form-control" type="text" name="lis_no" value="<?php echo $userProfile['lis_no']; ?>" /></span></div><br>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
      <div id="status"></div>
    </div>
  </div>
</section>

<?php
  // Your PHP code for including footer goes here
?>

</section>

<!-- Add Bootstrap JS if needed -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script to trigger the animation after the page loads -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const profileCard = document.querySelector('.profile-card');
    profileCard.style.opacity = '1'; // Set the opacity to 1 to trigger the fade-in animation
  });
</script>

</body>
</html>
<?php
			include('inc/footer.php');
	?>
