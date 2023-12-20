<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Car Park Management System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <?php
    //include('inc/head.php');
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
</head>
<body>
<?php
include('inc/header.php');
include('inc/connect.php');
?>
<section id="container" class="container">
    <section id="content">
        <div class="mt-4 mb-4">
            <h2>All Booking Details</h2>
            <div style="width:auto;background:white;padding:10px;margin:auto;">
                <div class="table-responsive">
                    <form method="post" action="deletebooking.php">
                        <!-- <div class="form-group">
                            <label for="search">Search:</label>
                            <input type="text" class="form-control" id="search" name="search" placeholder="Search...">
                        </div> -->
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                               id="example">
                            <thead class="thead-dark">
                            <tr>
                                <th>CHK</th>
                                <th>Booking ID</th>
                                <th>Area</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Vehicle Type</th>
                                <th>Lisence No.</th>
                                <th>Plate No.</th>
                                <th>Entry Date</th>
                                <th>Departure Date</th>
                                <th style="width:80px;">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = mysqli_query($connect, "select * from booking") or die(mysql_error());

                            while ($row = mysqli_fetch_array($query)) {
                                $id = $row['id'];
                                ?>
                                <tr>
                                    <td>
                                        <input name="selector[]" type="checkbox" value="<?php echo $id; ?>">
                                    </td>
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $row['area'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['v_type'] ?></td>
                                    <td><?php echo $row['lis_no'] ?></td>
                                    <td><?php echo $row['plate_no'] ?></td>
                                    <td><?php echo $row['e_date'] ?></td>
                                    <td><?php echo $row['d_date'] ?></td>
                                    <td><?php echo $row['status'] ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <input type="submit" class="btn btn-danger" value="Delete" name="delete">
                    </form>
                </div>
                <!-- Pagination links -->
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li> -->
                        <!-- ... More page links ... -->
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
</body>
</html>
