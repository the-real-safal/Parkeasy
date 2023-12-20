<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  if (!isset($_SESSION['email'])) {
    header("Location:../index.php");
  }
}
?>

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<header>
  <nav class="custom-nav">
    <?php if ($_SESSION['access'] == 0) { ?>
      <div class="super">
        SUPERADMIN
      </div>
    <?php } elseif ($_SESSION['access'] == 1) { ?>
      <div class="super">
        ADMIN
      </div>
    <?php } else { ?>
      <div class="super">
        User Role Unknown
      </div>
      <?php
      header("Location:http://localhost/pms002/index.php");
    }
    ?>

    <ul class="nav-list">
      <li><a href="http://localhost/pms002/0/index.php">Users</a></li>
      <li class="dropdown"><a href="bookings.php">Bookings</a></li>
      <li class="dropdown"><a href="transaction/alltransaction.php">Transactions</a></li>
      <li class="dropdown"><a href="http://localhost/pms002/0/messages.php">Messages</a></li>
      <?php if ($_SESSION['access'] == 0) { ?>
        <li class="dropdown"><a href="http://localhost/pms002/0/manage.php">Manage Admins</a></li>
      <?php } ?>
    </ul>

    <?php if (isset($_SESSION['email'])) : ?>
      <div>
        <?php if ($_SESSION['access'] == 0) : ?>
          <a href="http://localhost/pms002/0/new_account.php">Add New Admin</a>
        <?php endif; ?>
      </div>

      <div>
        <a href="http://localhost/pms002/0/profile.php">My Profile</a>
      </div>

      <div>
        <a href="http://localhost/pms002/proc/logout.php">Sign Out</a>
      </div>
    <?php endif; ?>
  </nav>
</header>

<style>
  /* ... your global CSS styles ... */

  /* Add a class for custom navigation styles */
  .custom-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #edf2f4;
    padding: 20px;
    backdrop-filter: blur(10px);
  }

  .custom-nav a {
    text-decoration: none;
    color: black;
    font-weight: bold;
    margin-right: 10px;
  }

  ul.nav-list {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
  }

  .custom-nav li {
    margin-right: 10px;
  }

  .custom-nav li:last-child {
    margin-right: 0;
  }

  .custom-nav a:hover {
    color: #ffb703;
    text-shadow: 2px 2px 5px #ffb703;
  }

  /* ... other styles ... */
</style>

<!-- Add Bootstrap JS and jQuery links -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
