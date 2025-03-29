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
                    <h1 class="h3 mb-0 text-gray-800">Available Services</h1>
                    <a href="add_service.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Property Types
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="row row-custom no-gutters col-12">
                            <?php include '../../db.connection/db_connection.php'; ?>


                            <?php
                            if (isset($_GET['screen_id'])) {
                                $screen_id = $_GET['screen_id'];

                                // Fetch screen details
                                $query = "SELECT * FROM screens WHERE id = $screen_id";
                                $result = mysqli_query($conn, $query);

                                if ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <div class="container mt-4">
                                        <h2><?php echo $row['screen_name']; ?></h2>
                                        <img src="../uploads/screens/<?php echo $row['screen_image']; ?>" class="img-fluid" alt="Screen Image">
                                        <br><br>
                                        <a href="show_screens.php?theater_id=<?php echo $row['theater_id']; ?>" class="btn btn-secondary">Back</a>
                                    </div>
                            <?php
                                } else {
                                    echo "<div class='alert alert-danger'>Screen not found.</div>";
                                }
                            } else {
                                echo "<div class='alert alert-warning'>No Screen Selected.</div>";
                            }
                            ?>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>