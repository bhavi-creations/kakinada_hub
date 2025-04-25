<?php
include 'header.php';
include '../../db.connection/db_connection.php';

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $ad_id = $_GET['id'];

    // Fetch the existing data for this banner ad
    $query = "SELECT * FROM banner_ads WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $ad_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $ad = $result->fetch_assoc();
    } else {
        echo "Banner ad not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $page_name = $_POST['page_name'];
    $target_url = $_POST['target_url'];
    $status = $_POST['status'];
    $uploadDir = '../uploads/banner_ads/';
    $dbPath = $ad['image_path']; // Keep the existing image unless a new one is uploaded

    if (isset($_FILES['banner_file']) && $_FILES['banner_file']['error'] === 0) {
        $fileTmp = $_FILES['banner_file']['tmp_name'];
        $fileExt = pathinfo($_FILES['banner_file']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $fileExt;
        $filePath = $uploadDir . $fileName;
        $dbPath = $fileName;

        if (move_uploaded_file($fileTmp, $filePath)) {
            // Remove old file if a new one was uploaded
            if (file_exists($uploadDir . $ad['image_path'])) {
                unlink($uploadDir . $ad['image_path']);
            }
        } else {
            $error = "File upload failed.";
        }
    }

    if (!isset($error)) {
        $updateQuery = "UPDATE banner_ads SET page_name = ?, image_path = ?, target_url = ?, status = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ssssi", $page_name, $dbPath, $target_url, $status, $ad_id);

        if ($stmt->execute()) {
            header("Location: view_banner_adds.php?success=1");
            exit;
        } else {
            $error = "Error updating banner ad.";
        }
    }
}
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
                    <h1 class="h3 mb-0 text-gray-800">Edit Banner Ad</h1>
                    <a href="view_banner_adds.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-arrow-left"></i> Back to Ads List
                    </a>
                </div>

                <!-- Display Success or Error Message -->
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" id="success-alert">
                        Banner updated successfully!
                    </div>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error; ?></div>
                <?php endif; ?>

                <!-- Banner Edit Form -->
                <div class="card shadow p-4">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="page_name">Page Name</label>
                            <input type="text" name="page_name" class="form-control" value="<?= htmlspecialchars($ad['page_name']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="target_url">Target URL</label>
                            <input type="text" name="target_url" class="form-control" value="<?= htmlspecialchars($ad['target_url']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="banner_file">Upload New Banner (Optional)</label>
                            <input type="file" name="banner_file" class="form-control-file">
                            <small class="form-text text-muted">Leave empty if you don't want to change the image.</small>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active" <?= $ad['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?= $ad['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Banner</button>
                    </form>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>
