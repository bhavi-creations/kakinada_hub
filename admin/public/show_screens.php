<?php include 'header.php'; ?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Screens</h1>
                    <a href="view_theater.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa fa-arrow-left"></i> Back to Theaters
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <?php
                        include '../../db.connection/db_connection.php';

                        // Get theater ID from URL
                        if (isset($_GET['theater_id']) && !empty($_GET['theater_id'])) {
                            $theater_id = mysqli_real_escape_string($conn, $_GET['theater_id']);

                            // Fetch screens for the selected theater
                            $query = "SELECT * FROM screens WHERE theater_id = '$theater_id'";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                    <div class="col-md-4">
                                        <div class="card mb-4">
                                            <img src="../uploads/screens/<?php echo $row['screen_image']; ?>" class="card-img-top" alt="Screen Image">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row['screen_name']; ?></h5>
                                                <a href="view_screen.php?screen_id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i> View
                                                </a>
                                                <a href="edit_screen.php?screen_id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a href="delete_screen.php?screen_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                }
                            } else {
                                echo "<div class='col-md-12'><div class='alert alert-warning'>No Screens Found for this Theater.</div></div>";
                            }
                        } else {
                            echo "<div class='col-md-12'><div class='alert alert-danger'>Invalid Theater ID.</div></div>";
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>
