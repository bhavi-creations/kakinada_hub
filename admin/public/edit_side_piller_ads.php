<?php
include 'header.php';
include '../../db.connection/db_connection.php';

// Function to safely escape output
function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// Initialize variables for messages
$success_message = '';
$error_message = '';
$redirect_on_success = false; // Flag to trigger redirection

// Fetch ad details if ID is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $stmt_select = $conn->prepare("SELECT * FROM side_piller_ads WHERE id = ?");
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    if ($result->num_rows === 1) {
        $ad_data = $result->fetch_assoc();
    } else {
        $error_message = "Ad not found.";
    }
    $stmt_select->close();
} else {
    $error_message = "Invalid ad ID.";
}

// Handle form submission for editing
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_ad'])) {
    $ad_id = $_POST['ad_id'];
    $page_name = $_POST['page_name'];
    $ad_side = $_POST['ad_side'];
    $ad_position = $_POST['ad_position'] ?? null;
    $target_url = $_POST['target_url'];
    $status = $_POST['status'];
    $uploadDir = '../uploads/side_piller_ads/';
    $uploadSuccess = true;
    $uploadErrors = [];
    $image_path = $_POST['old_image']; // Keep the old image path if no new image is uploaded

    // Handle new image upload if provided
    if (!empty($_FILES['banner_file']['name'])) {
        $fileExt = pathinfo($_FILES['banner_file']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $fileExt;
        $filePath = $uploadDir . $fileName;
        $dbPath = $fileName;

        if (move_uploaded_file($_FILES['banner_file']['tmp_name'], $filePath)) {
            // Delete the old image if a new one was uploaded
            $oldFilePath = $uploadDir . $_POST['old_image'];
            if (file_exists($oldFilePath) && $_POST['old_image'] !== '') {
                unlink($oldFilePath);
            }
            $image_path = $dbPath;
        } else {
            $uploadSuccess = false;
            $uploadErrors[] = "Failed to upload the new image.";
        }
    }

    if ($uploadSuccess) {
        $stmt_update = $conn->prepare("UPDATE side_piller_ads SET page_name = ?, ad_side = ?, ad_position = ?, image_path = ?, target_url = ?, status = ? WHERE id = ?");
        $stmt_update->bind_param("ssssssi", $page_name, $ad_side, $ad_position, $image_path, $target_url, $status, $ad_id);

        if ($stmt_update->execute()) {
            $success_message = "Ad updated successfully!";
            $redirect_on_success = true; // Set the flag for redirection
        } else {
            $error_message = "Error updating ad: " . $stmt_update->error;
        }
        $stmt_update->close();
    } else {
        $error_message = implode("<br>", $uploadErrors);
    }
}

// Fetch available pages
$pages = [];
$pagesQuery = mysqli_query($conn, "SELECT name FROM banner_pages ORDER BY name ASC");
while ($row = mysqli_fetch_assoc($pagesQuery)) {
    $pages[] = $row['name'];
}

// Redirect if update was successful
if ($redirect_on_success) {
    header("Location: view_side_piller_ads.php?update_success=1");
    exit();
}

?>

<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">

                <h1 class="h3 mb-4 text-gray-800">Edit Side Piller Ad</h1>

                <?php if ($success_message) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= e($success_message) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <script>
                        setTimeout(function() {
                            document.querySelector('.alert-success').remove();
                        }, 3000);
                    </script>
                <?php endif; ?>

                <?php if ($error_message) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= e($error_message) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <script>
                        setTimeout(function() {
                            document.querySelector('.alert-danger').remove();
                        }, 3000);
                    </script>
                <?php endif; ?>

                <?php if (isset($ad_data)) : ?>
                    <div class="card col-md-10">
                        <div class="card-body">
                            <h5 class="card-title">Edit Ad ID: <?= e($ad_data['id']) ?></h5>
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="ad_id" value="<?= e($ad_data['id']) ?>">
                                <input type="hidden" name="old_image" value="<?= e($ad_data['image_path']) ?>">

                                <div class="form-group">
                                    <label for="page_name">Page Name</label>
                                    <select name="page_name" class="form-control" required>
                                        <option value="">Select Page</option>
                                        <?php foreach ($pages as $page) : ?>
                                            <option value="<?= e($page) ?>" <?= (isset($ad_data['page_name']) && $ad_data['page_name'] === $page) ? 'selected' : '' ?>><?= ucfirst(e($page)) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ad_side">Ad Side</label>
                                    <select name="ad_side" class="form-control" required onchange="toggleAdPosition()">
                                        <option value="">Select Placement</option>
                                        <option value="left" <?= (isset($ad_data['ad_side']) && $ad_data['ad_side'] === 'left') ? 'selected' : '' ?>>Left</option>
                                        <option value="right" <?= (isset($ad_data['ad_side']) && $ad_data['ad_side'] === 'right') ? 'selected' : '' ?>>Right</option>
                                        <option value="default" <?= (isset($ad_data['ad_side']) && $ad_data['ad_side'] === 'default') ? 'selected' : '' ?>>All Device Ads (Default )</option>
                                        <option value="popup" <?= (isset($ad_data['ad_side']) && $ad_data['ad_side'] === 'popup') ? 'selected' : '' ?>>Mobile Popup Ads (Pop Up) </option>
                                    </select>
                                </div>

                                <div class="form-group" id="adPositionGroup" style="display:<?= (isset($ad_data['ad_side']) && $ad_data['ad_side'] === 'in-between') ? 'block' : 'none' ?>;">
                                    <label for="ad_position">Ad Position (for In-Between Ads)</label>
                                    <select name="ad_position" class="form-control">
                                        <option value="">Select Position</option>
                                        <option value="1" <?= (isset($ad_data['ad_position']) && $ad_data['ad_position'] === '1') ? 'selected' : '' ?>>1</option>
                                        <option value="2" <?= (isset($ad_data['ad_position']) && $ad_data['ad_position'] === '2') ? 'selected' : '' ?>>2</option>
                                        <option value="3" <?= (isset($ad_data['ad_position']) && $ad_data['ad_position'] === '3') ? 'selected' : '' ?>>3</option>
                                    </select>
                                    <small class="form-text text-muted">This is to order ads within the content.</small>
                                </div>

                                <div class="form-group">
                                    <label>Current Ad</label><br>
                                    <img src="../uploads/side_piller_ads/<?= e($ad_data['image_path']) ?>" alt="Current Ad Image" width="150">
                                </div>

                                <div class="form-group">
                                    <label for="banner_file">Upload New Ad (optional)</label>
                                    <input type="file" name="banner_file" class="form-control-file">
                                    <small class="form-text text-muted">Leave blank to keep the current ad.</small>
                                </div>

                                <div class="form-group">
                                    <label for="target_url">Target URL</label>
                                    <input type="text" name="target_url" class="form-control" value="<?= e($ad_data['target_url']) ?>" placeholder="https://example.com" required>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="active" <?= (isset($ad_data['status']) && $ad_data['status'] === 'active') ? 'selected' : '' ?>>Active</option>
                                        <option value="inactive" <?= (isset($ad_data['status']) && $ad_data['status'] === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" name="update_ad" class="btn btn-primary">Update Ad</button>
                                <a href="view_side_piller_ads.php" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                <?php elseif ($error_message) : ?>
                    <div class="alert alert-danger"><?= e($error_message) ?></div>
                <?php endif; ?>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>
<?php include 'end.php'; ?>

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

    // Call on page load to set initial visibility
    document.addEventListener('DOMContentLoaded', toggleAdPosition);
</script>