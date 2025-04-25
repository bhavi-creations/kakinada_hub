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
                    <a href="view_banner_adds.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fa-regular fa-eye"></i> View Banner Ads
                    </a>
                    <a href="add_banner_pages.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Pages
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
                                    // Handle form submission
                                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                        $page_name = $_POST['page_name'];
                                        $target_url = $_POST['target_url'];
                                        $status = $_POST['status'];
                                        $uploadDir = '../uploads/banner_ads/';
                                        $dbPath = '';

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
                                                    header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
                                                    exit;
                                                } else {
                                                    $error = "Database error.";
                                                }
                                            } else {
                                                $error = "File upload failed.";
                                            }
                                        }
                                    }

                                    // Display success message
                                    if (isset($_GET['success'])) {
                                        echo '<div class="alert alert-success alert-dismissible fade show" id="success-alert">Banner added successfully!</div>';
                                        echo '<script>
                                            setTimeout(function() {
                                                const alertBox = document.getElementById("success-alert");
                                                if (alertBox) {
                                                    alertBox.style.display = "none";
                                                }
                                            }, 3000);
                                        </script>';
                                    }

                                    // Display error if exists
                                    if (isset($error)) {
                                        echo '<div class="alert alert-danger">' . $error . '</div>';
                                    }

                                    // Fetch available and used pages
                                    $pages = [];
                                    $usedPages = [];

                                    $pagesQuery = mysqli_query($conn, "SELECT name FROM banner_pages ORDER BY name ASC");
                                    while ($row = mysqli_fetch_assoc($pagesQuery)) {
                                        $pages[] = $row['name'];
                                    }

                                    $usedQuery = mysqli_query($conn, "SELECT DISTINCT page_name FROM banner_ads");
                                    while ($row = mysqli_fetch_assoc($usedQuery)) {
                                        $usedPages[] = $row['page_name'];
                                    }
                                    ?>

                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="page_name">Page Name</label>
                                            <select name="page_name" class="form-control" required>
                                                <option value="">Select Page</option>
                                                <?php foreach ($pages as $page): ?>
                                                    <option value="<?= htmlspecialchars($page) ?>" <?= in_array($page, $usedPages) ? 'disabled' : '' ?>>
                                                        <?= ucfirst($page) ?> <?= in_array($page, $usedPages) ? '(Already Added)' : '' ?>
                                                    </option>
                                                <?php endforeach; ?>
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
