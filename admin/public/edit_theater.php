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
                            if (isset($_GET['theater_id'])) {
                                $theater_id = $_GET['theater_id'];

                                // Fetch theater details
                                $query = "SELECT * FROM theaters WHERE id = $theater_id";
                                $result = mysqli_query($conn, $query);

                                if ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <div class="container mt-4">
                                        <h2>Edit Theater</h2>
                                        <form action="update_theater.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="theater_id" value="<?php echo $theater_id; ?>">

                                            <div class="mb-3">
                                                <label class="form-label">Theater Name:</label>
                                                <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Location:</label>
                                                <input type="text" name="location" class="form-control" value="<?php echo $row['location']; ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Theater Image:</label>
                                                <input type="file" name="image" class="form-control">
                                                <small>Leave empty if not changing the image.</small>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="movies.php" class="btn btn-secondary">Cancel</a>
                                        </form>
                                    </div>
                            <?php
                                } else {
                                    echo "<div class='alert alert-danger'>Theater not found.</div>";
                                }
                            } else {
                                echo "<div class='alert alert-warning'>No Theater Selected.</div>";
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