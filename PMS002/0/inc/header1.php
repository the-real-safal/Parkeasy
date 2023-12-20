<?php  
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  if (isset($_SESSION['phone'])) {
  } else {
    //header("Location: index.php");
  }
}
?>
	<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<header>
<nav>
<?php if ($_SESSION['access'] == 0) { ?>
    <div class="super">
    SUPERADMIN
  </div>
  <?php }
  elseif($_SESSION['access'] == 1) {?>
 <div class="super">
    ADMIN
  </div>
  <?php } ?>
    <ul>
      <li><a href="index.php">Users</a></li>
      <li class="dropdown"><a href="bookings.php">Bookings</a></li>
      <li class="dropdown"><a href="transactions.php">Transactions</a></li>
      <li class="dropdown"><a href="messages.php">Messages</a></li>
      <?php if ($_SESSION['access'] == 0) { ?>
        <li class="dropdown"><a href="manage.php">Manage Admins</a></li>
      <?php } ?>	
    </ul>
    <?php 
  if (isset($_SESSION['phone'])) {
  ?>
  
  <div>
    <a href="profile.php">My Profile</a>
  </div>
  <div>
    <a href="../proc/logout.php">Sign Out</a>
  </div>
  <?php if ($_SESSION['access'] == 0) { ?>
    <a href="new_account.php" >Add New Admin</a>
  <?php } ?>
  <?php
  } 
  ?>
  </nav>
</header>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');

  body {
    font-family: 'Poppins', sans-serif;
    background-image: url('background.jpg');
    background-size: cover;
    background-position: center;
    background-blur: 10px;
  }

  nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #edf2f4;
    padding: 20px;
    backdrop-filter: blur(10px);
  }

  nav a {
    text-decoration: none;
    color: black;
    font-weight: bold;
    margin-right: 10px;
  }

  nav ul {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
  }

  nav li {
    margin-right: 10px;
  }

  nav li:last-child {
    margin-right: 0;
  }

  nav a:hover {
    color: #ffb703;
    text-shadow: 2px 2px 5px #ffb703;
  }

  .button-container {
    display: flex;
  }

  .button-container button {
    margin-right: 10px;
    padding: 8px 12px;
    background-color: #ffb703;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .button-container button:hover {
    background-color: #023047;
  }
  .super{
    color: #ffb703;
  }

  .fade-in {
    opacity: 0;
    animation: fadeInAnimation 1s forwards;
  }

  @keyframes fadeInAnimation {
    0% {
      opacity: 0;
    }

    100% {
      opacity: 1;
    }
  }
</style>
<!-- Add Bootstrap JS and jQuery links -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>






