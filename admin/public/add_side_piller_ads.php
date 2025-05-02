<?php include 'header.php'; ?>
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">

                <h1 class="h3 mb-4 text-gray-800">Add Side Piller Ads</h1>

                <div class="container">
                    <div class="row">
                        <?php include '../../db.connection/db_connection.php'; ?>

                        <div class="card col-md-10">
                            <div class="card-body">
                                <h5 class="card-title">Insert Ads</h5>

                                <?php
                                // Handle form submission
                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    $page_name = $_POST['page_name'];
                                    $ad_side = $_POST['ad_side'];
                                    $ad_position = $_POST['ad_position'] ?? null;
                                    $target_urls = $_POST['target_urls'];
                                    $status = $_POST['status'];
                                    $uploadDir = '../uploads/side_piller_ads/';
                                    $uploadSuccess = true;
                                    $uploadErrors = [];
                                    $insertedCount = 0;

                                    if (!is_dir($uploadDir)) {
                                        mkdir($uploadDir, 0777, true);
                                    }

                                    if (!empty($_FILES['banner_files']['name'][0])) {
                                        foreach ($_FILES['banner_files']['tmp_name'] as $index => $tmpName) {
                                            $fileExt = pathinfo($_FILES['banner_files']['name'][$index], PATHINFO_EXTENSION);
                                            $fileName = uniqid() . '.' . $fileExt;
                                            $filePath = $uploadDir . $fileName;
                                            $dbPath = $fileName;

                                            if (move_uploaded_file($tmpName, $filePath)) {
                                                $url = $target_urls[$index] ?? '';
                                                // Include device_type in the query and bind
                                                $stmt = $conn->prepare("INSERT INTO side_piller_ads (page_name, ad_side, ad_position, image_path, target_url, status, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
                                                $stmt->bind_param("ssssss", $page_name, $ad_side, $ad_position, $dbPath, $url, $status); // Removed device_type
                                                if ($stmt->execute()) {
                                                    $insertedCount++;
                                                } else {
                                                    $uploadErrors[] = "Database error for " . $_FILES['banner_files']['name'][$index] . ": " . $stmt->error;
                                                    $uploadSuccess = false;
                                                }
                                                $stmt->close();
                                            } else {
                                                $uploadErrors[] = "Failed to upload: " . $_FILES['banner_files']['name'][$index];
                                                $uploadSuccess = false;
                                            }
                                        }
                                    } else {
                                        $uploadSuccess = false;
                                        $uploadErrors[] = "Please select at least one file.";
                                    }

                                    if ($uploadSuccess && empty($uploadErrors) && $insertedCount > 0) {
                                        header("Location: " . $_SERVER['PHP_SELF'] . "?success=" . $insertedCount);
                                        exit;
                                    } else {
                                        $error = implode("<br>", $uploadErrors);
                                    }
                                }

                                // Show success message
                                if (isset($_GET['success'])) {
                                    $count = intval($_GET['success']);
                                    echo '<div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">';
                                    echo "<strong>Success!</strong> " . $count . " ad(s) have been added.";
                                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                                    echo '<span aria-hidden="true">&times;</span>';
                                    echo '</button>';
                                    echo '</div>';
                                    echo '<script>
                                        setTimeout(function() {
                                            const alertBox = document.getElementById("success-message");
                                            if (alertBox) {
                                                alertBox.remove();
                                            }
                                        }, 3000);
                                        </script>';
                                }

                                if (isset($error)) {
                                    echo '<div class="alert alert-danger">' . $error . '</div>';
                                }

                                // Fetch available pages
                                $pages = [];
                                $pagesQuery = mysqli_query($conn, "SELECT name FROM banner_pages ORDER BY name ASC");
                                while ($row = mysqli_fetch_assoc($pagesQuery)) {
                                    $pages[] = $row['name'];
                                }
                                ?>

                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="page_name">Page Name</label>
                                        <select name="page_name" class="form-control" required>
                                            <option value="">Select Page</option>
                                            <?php foreach ($pages as $page) : ?>
                                                <option value="<?= htmlspecialchars($page) ?>"><?= ucfirst($page) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    
                                    <div class="form-group">
                                        <label for="ad_side">Ad Side</label>
                                        <select name="ad_side" class="form-control" required onchange="toggleAdPosition()">
                                            <option value="">Select Placement</option>
                                            <option value="left">Left</option>
                                            <option value="right">Right</option>
                                            <!-- <option value="in-between">In-Between</option> -->
                                            <option value="default">All Device Ads </option>
                                            <option value="popup">Mobile Popup Ads</option>

                                        </select>
                                    </div>

                                    <div class="form-group" id="adPositionGroup" style="display:none;">
                                        <label for="ad_position">Ad Position (for In-Between Ads)</label>
                                        <select name="ad_position" class="form-control">
                                            <option value="">Select Position</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                        <small class="form-text text-muted">This is to order ads within the content.</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="banner_files">Upload Ads (multiple allowed)</label>
                                        <input type="file" name="banner_files[]" class="form-control-file" multiple required>
                                    </div>

                                    <div class="form-group">
                                        <label>Target URLs (Match file order)</label>
                                        <div id="urlFields">
                                            <input type="text" name="target_urls[]" class="form-control mb-2" placeholder="https://example.com" required>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="addUrlField()">+ Add Another URL</button>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="active" selected>Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add Ads</button>
                                </form>

                                <script>
                                    function toggleAdPosition() {
                                        const adSideSelect = document.querySelector('select[name="ad_side"]');
                                        const adPositionGroup = document.getElementById("adPositionGroup");

                                        if (adSideSelect.value === 'in-between') {
                                            adPositionGroup.style.display = 'block';
                                        } else {
                                            adPositionGroup.style.display = 'none';
                                            document.querySelector('select[name="ad_position"]').value = ''; // Reset value
                                        }
                                    }

                                    // Call on page load
                                    document.addEventListener('DOMContentLoaded', toggleAdPosition);

                                    function addUrlField() {
                                        let container = document.getElementById("urlFields");
                                        let input = document.createElement("input");
                                        input.type = "text";
                                        input.name = "target_urls[]";
                                        input.className = "form-control mb-2";
                                        input.placeholder = "https://example.com";
                                        input.required = true;
                                        container.appendChild(input);
                                    }
                                </script>

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
