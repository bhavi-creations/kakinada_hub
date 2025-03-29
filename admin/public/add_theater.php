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
                    <h1 class="h3 mb-0 text-gray-800">Add Theaters</h1>
                    <a href="movies.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-regular fa-eye"></i> View Theaters
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <?php include '../../db.connection/db_connection.php'; ?>

                            <?php
                            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                                $theater_name = mysqli_real_escape_string($conn, $_POST['theater_name']);
                                $location = mysqli_real_escape_string($conn, $_POST['location']);

                                // Upload Theater Image
                                $theater_image = "";
                                if (!empty($_FILES["theater_image"]["name"])) {
                                    $theater_image = time() . "_" . $_FILES["theater_image"]["name"];
                                    move_uploaded_file($_FILES["theater_image"]["tmp_name"], "../uploads/theaters/" . $theater_image);
                                }

                                // Insert into Theaters Table
                                $query = "INSERT INTO theaters (name, image, location) 
                                          VALUES ('$theater_name', '$theater_image', '$location')";
                                
                                if (mysqli_query($conn, $query)) {
                                    echo "<div class='alert alert-success'>Theater added successfully!</div>";
                                    echo "<script>window.location.href='movies.php';</script>"; // Redirect after success
                                } else {
                                    echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
                                }
                            }
                            ?>

                            <!-- Theater Form -->
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Theater Name</label>
                                    <input type="text" name="theater_name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Theater Location</label>
                                    <input type="text" name="location" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Theater Image</label>
                                    <input type="file" name="theater_image" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Add Theater</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>
