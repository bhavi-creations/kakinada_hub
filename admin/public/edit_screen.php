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
                                        <h2>Edit Screen</h2>
                                        <form action="update_screen.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="screen_id" value="<?php echo $screen_id; ?>">

                                            <div class="mb-3">
                                                <label class="form-label">Screen Name:</label>
                                                <input type="text" name="screen_name" class="form-control" value="<?php echo $row['screen_name']; ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Screen Image:</label>
                                                <input type="file" name="screen_image" class="form-control">
                                                <small>Leave empty if not changing the image.</small>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="show_screens.php?theater_id=<?php echo $row['theater_id']; ?>" class="btn btn-secondary">Cancel</a>
                                        </form>
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