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
                    <h1 class="h3 mb-0 text-gray-800">Theaters</h1>
                    <a href="movies.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fa-regular fa-eye"></i> Show Theaters List
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <?php
                        include '../../db.connection/db_connection.php';

                        // Fetch theaters from the database
                        $query = "SELECT * FROM theaters";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <img src="../uploads/theaters/<?php echo $row['image']; ?>" class="card-img-top" alt="Theater Image">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                            <p class="card-text"><strong>Location:</strong> <?php echo $row['location']; ?></p>

                                            <!-- Manage Screens Button -->
                                            <a href="add_screens.php?theater_id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">
                                                <i class="fa fa-tv"></i> Add Screens
                                            </a>

                                            <!-- Show Screens Button -->
                                            <a href="show_screens.php?theater_id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">
                                                <i class="fa fa-eye"></i> Show Screens
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<div class='col-md-12'><div class='alert alert-warning'>No Theaters Found.</div></div>";
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
