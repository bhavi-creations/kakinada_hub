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
                    <h1 class="h3 mb-0 text-gray-800">Edit Slide</h1>
                    <a href="home_orange_slides.php" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <?php
                            include '../../db.connection/db_connection.php';

                            if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
                                echo "<div class='alert alert-danger'>Invalid slide ID.</div>";
                                exit;
                            }

                            $id = intval($_GET['id']);
                            $message = "";

                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                $heading = $_POST['heading_text'];
                                $btn_text = $_POST['button_text'];
                                $btn_link = $_POST['button_link'];
                                $old_image = $_POST['old_image'];

                                $new_image_name = $old_image;

                                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                                    $image_tmp = $_FILES['image']['tmp_name'];
                                    $image_name = basename($_FILES['image']['name']);
                                    $target_path = "../uploads/" . $image_name;

                                    if (move_uploaded_file($image_tmp, $target_path)) {
                                        $new_image_name = "uploads/" . $image_name;
                                    } else {
                                        $message = "<div class='alert alert-warning'>Failed to upload new image. Keeping the old one.</div>";
                                    }
                                }

                                $updateSQL = "UPDATE orange_slides SET heading_text=?, button_text=?, button_link=?, image_name=? WHERE id=?";
                                $stmt = $conn->prepare($updateSQL);
                                $stmt->bind_param("ssssi", $heading, $btn_text, $btn_link, $new_image_name, $id);

                                if ($stmt->execute()) {
                                    // Avoid resubmission
                                    header("Location: edit_home_slide.php?id=$id&updated=1");
                                    exit;
                                } else {
                                    $message = "<div class='alert alert-danger'>Failed to update slide.</div>";
                                }
                                $stmt->close();
                            }

                            if (isset($_GET['updated'])) {
                                echo "<div class='alert alert-success' id='success-alert'>Slide updated successfully.</div>";
                                echo "<script>
                                    setTimeout(function() {
                                        var alertBox = document.getElementById('success-alert');
                                        if(alertBox){
                                            alertBox.style.display = 'none';
                                        }
                                    }, 3000);
                                </script>";
                                
                            }

                            echo $message;

                            $sql = "SELECT * FROM orange_slides WHERE id = $id";
                            $result = $conn->query($sql);
                            if ($result->num_rows === 1) {
                                $row = $result->fetch_assoc();
                            ?>
                                <form method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($row['image_name']); ?>">

                                    <div class="mb-3">
                                        <label for="heading_text" class="form-label">Heading Text</label>
                                        <input type="text" class="form-control" name="heading_text" value="<?php echo htmlspecialchars($row['heading_text']); ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="button_text" class="form-label">Button Text</label>
                                        <input type="text" class="form-control" name="button_text" value="<?php echo htmlspecialchars($row['button_text']); ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="button_link" class="form-label">Button Link</label>
                                        <input type="text" class="form-control" name="button_link" value="<?php echo htmlspecialchars($row['button_link']); ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Current Image</label><br>
                                        <img src="../<?php echo $row['image_name']; ?>" alt="Current Image" style="height: 100px;"><br><br>
                                        <label for="image" class="form-label">Change Image (optional)</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Slide</button>
                                </form>
                            <?php
                            } else {
                                echo "<div class='alert alert-danger'>Slide not found.</div>";
                            }

                            $conn->close();
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
