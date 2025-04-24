<?php include 'header.php'; ?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Add Home Slide</h1>
                    <a href="home_orange_slides.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-eye"></i> View All Slides
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <?php
                            include '../../db.connection/db_connection.php';

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Check if the form is submitted
                            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
                                $heading_text = $_POST['heading_text'];
                                $button_text = $_POST['button_text'] ?? 'Know More';
                                $button_link = $_POST['button_link'] ?? '#';

                                // Image Upload
                                $image_name = $_FILES['image']['name'];
                                $image_tmp = $_FILES['image']['tmp_name'];
                                $upload_dir = "../uploads/home_slides/"; // Updated directory

                                // Generate a unique name for the image
                                $unique_image_name = uniqid() . '.' . pathinfo($image_name, PATHINFO_EXTENSION);
                                $image_path = $upload_dir . $unique_image_name;

                                // Store only filename in DB
                                $image_db_name =  $unique_image_name;

                                if (move_uploaded_file($image_tmp, $image_path)) {
                                    // Insert data into the database
                                    $stmt = $conn->prepare("INSERT INTO orange_slides (heading_text, image_name, button_text, button_link) VALUES (?, ?, ?, ?)");
                                    $stmt->bind_param("ssss", $heading_text, $image_db_name, $button_text, $button_link);

                                    if ($stmt->execute()) {
                                        $success_msg = "Slide added successfully."; // Store the success message
                                        header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");

                                        exit(); // Stop further script execution
                                    } else {
                                        $error_msg = "Insert error: " . $stmt->error;
                                    }

                                    $stmt->close();
                                } else {
                                    $error_msg = "Image upload failed.";
                                }
                            }

                            $conn->close();
                            ?>

                            <!-- Display success message if set -->
                            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                                <div id="success-message" class="alert alert-success">Slide added successfully.</div>
                            <?php endif; ?>


                            <!-- Slide Add Form -->
                            <form action="" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light">
                                <div class="form-group">
                                    <label>Heading Text</label>
                                    <input type="text" name="heading_text" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control-file" accept="image/*" required>
                                </div>

                                <div class="form-group">
                                    <label>Button Text</label>
                                    <input type="text" name="button_text" class="form-control" value="Know More">
                                </div>

                                <div class="form-group">
                                    <label>Button Link</label>
                                    <input type="text" name="button_link" class="form-control" value="#">
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary mt-3">
                                    <i class="fas fa-plus-circle"></i> Add Slide
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script>
            // Hide success message after 3 seconds
            setTimeout(function() {
                var successMessage = document.getElementById("success-message");
                if (successMessage) {
                    successMessage.style.display = "none";
                }
            }, 3000);
        </script>
        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>