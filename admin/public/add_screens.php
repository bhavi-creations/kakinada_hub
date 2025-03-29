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
                    <h1 class="h3 mb-0 text-gray-800">Add Screens</h1>
                    <a href="view_theater.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa fa-arrow-left"></i> Back to Theaters
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <?php include '../../db.connection/db_connection.php'; ?>

                            <?php
                            // Get Theater ID from URL
                            if (isset($_GET['theater_id'])) {
                                $theater_id = $_GET['theater_id'];

                                // Fetch Theater Name
                                $theater_query = "SELECT name FROM theaters WHERE id = $theater_id";
                                $theater_result = mysqli_query($conn, $theater_query);
                                $theater = mysqli_fetch_assoc($theater_result);
                            } else {
                                echo "<div class='alert alert-danger'>Invalid Theater.</div>";
                                exit;
                            }

                            // Handle Form Submission
                            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                                $screen_name = mysqli_real_escape_string($conn, $_POST['screen_name']);
                                

                                // Upload Screen Image
                                $screen_image = "";
                                if (!empty($_FILES["screen_image"]["name"])) {
                                    $screen_image = time() . "_" . $_FILES["screen_image"]["name"];
                                    move_uploaded_file($_FILES["screen_image"]["tmp_name"], "../uploads/screens/" . $screen_image);
                                }

                                // Insert into Database
                                $query = "INSERT INTO screens (theater_id, screen_name,   screen_image) 
                                          VALUES ('$theater_id', '$screen_name',   '$screen_image')";

                                if (mysqli_query($conn, $query)) {
                                    echo "<div class='alert alert-success'>Screen added successfully!</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
                                }
                            }
                            ?>

                            <!-- Add Screen Form -->
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Theater Name</label>
                                    <input type="text" class="form-control" value="<?php echo $theater['name']; ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Screen Name</label>
                                    <input type="text" name="screen_name" class="form-control" required>
                                </div>

                             

                                <div class="form-group">
                                    <label>Screen Image</label>
                                    <input type="file" name="screen_image" class="form-control">
                                </div>

                                <button type="submit" class="btn btn-primary">Add Screen</button>
                                <a href="movies.php" class="btn btn-secondary">Cancel</a>

                            </form>
                        </div>
                    </div>

                    <hr>

                   

                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>
