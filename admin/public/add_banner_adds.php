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

                            <div class="card col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Add Banner Ad</h5>

                                    <?php
                                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                        $page_name = $_POST['page_name'];
                                        $target_url = $_POST['target_url'];
                                        $status = $_POST['status'];
                                        $uploadDir = '../uploads/banner_ads/'; // folder path
                                        $dbPath = ''; // only file name saved here

                                        if (!is_dir($uploadDir)) {
                                            mkdir($uploadDir, 0777, true);
                                        }

                                        if (isset($_FILES['banner_file']) && $_FILES['banner_file']['error'] === 0) {
                                            $fileTmp = $_FILES['banner_file']['tmp_name'];
                                            $fileExt = pathinfo($_FILES['banner_file']['name'], PATHINFO_EXTENSION);
                                            $fileName = uniqid() . '.' . $fileExt;
                                            $filePath = $uploadDir . $fileName;
                                            $dbPath = $fileName;

                                            if (move_uploaded_file($fileTmp, $filePath)) {
                                                $stmt = $conn->prepare("INSERT INTO banner_ads (page_name, image_path, target_url, status) VALUES (?, ?, ?, ?)");
                                                $stmt->bind_param("ssss", $page_name, $dbPath, $target_url, $status);
                                                if ($stmt->execute()) {
                                                    echo '<div class="alert alert-success">Banner added successfully!</div>';
                                                } else {
                                                    echo '<div class="alert alert-danger">Database error.</div>';
                                                }
                                            } else {
                                                echo '<div class="alert alert-danger">File upload failed.</div>';
                                            }
                                        }
                                    }
                                    ?>

                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="page_name">Page Name</label>
                                            <select name="page_name" class="form-control" required>
                                                <option value="">Select Page</option>
                                                <option value="home">Home</option>
                                                <option value="services">Services</option>
                                                <option value="jobs">Jobs</option>
                                                <!-- Add more if needed -->
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="target_url">Target URL</label>
                                            <input type="text" name="target_url" class="form-control" placeholder="https://example.com" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="banner_file">Upload Banner (Image / GIF / Video)</label>
                                            <input type="file" name="banner_file" class="form-control-file" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value="active" selected>Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Add Banner</button>
                                    </form>
                                </div>
                            </div>






                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>