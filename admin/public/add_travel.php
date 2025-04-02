<?php
include 'header.php';
include '../../db.connection/db_connection.php'; // Database connection
?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Add Travel Type</h1>
                    <a href="travel.php" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fa-regular fa-eye"></i> View Travel
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="add_travel.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Travel Type Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="filter_image" class="form-label">Upload Image</label>
                                    <input type="file" class="form-control" id="filter_image" name="filter_image" required>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Add Travel Type</button>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_POST['submit'])) {
                    $name = mysqli_real_escape_string($conn, $_POST['name']);

                    // Handle Image Upload
                    $targetDir = "../uploads/travels/"; // Destination folder
                    $fileName = basename($_FILES["filter_image"]["name"]);
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

                    // Allowed file types
                    $allowTypes = array("jpg", "jpeg", "png", "gif");

                    if (in_array($fileType, $allowTypes)) {
                        if (move_uploaded_file($_FILES["filter_image"]["tmp_name"], $targetFilePath)) {
                            // Insert into database
                            $query = "INSERT INTO travels (name, filter_image) VALUES ('$name', '$fileName')";
                            if (mysqli_query($conn, $query)) {
                                // Redirect to prevent form resubmission
                                header("Location: add_travel.php?success=1");
                                exit();
                            } else {
                                echo "<div class='alert alert-danger'>Database error: " . mysqli_error($conn) . "</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>Error uploading image.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Invalid file type. Allowed types: JPG, JPEG, PNG, GIF.</div>";
                    }
                }

                // Display success message if redirected
                if (isset($_GET['success'])) {
                    echo "<div class='alert alert-success'>Travel type added successfully!</div>";
                }
                ?>


            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>