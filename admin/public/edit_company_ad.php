<?php
// edit_company_ad.php
 
include '../../db.connection/db_connection.php';

if (!isset($_GET['id'])) {
    header('Location: view_company_ads.php');
    exit;
}

$id = (int)$_GET['id'];
// Fetch existing ad
$stmt = $conn->prepare("
  SELECT company_id, file_name, ad_type, ad_position
  FROM company_ads
  WHERE id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$ad = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$ad) {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Ad not found'];
    header('Location: view_company_ads.php');
    exit;
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $position = $_POST['ad_position'];
    $newFile = $ad['file_name'];

    // if a new file uploaded, move & update $newFile + delete old
    if (!empty($_FILES['ad_file']['tmp_name'])) {
        $uploadDir = '../uploads/company_ads/';
        $tmp = $_FILES['ad_file']['tmp_name'];
        $orig = basename($_FILES['ad_file']['name']);
        $ext  = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
        $newFile = time() . "_edit." . $ext;
        move_uploaded_file($tmp, $uploadDir . $newFile);
        // delete old
        @unlink($uploadDir . $ad['file_name']);
        // determine new ad_type
        if (in_array($ext, ['mp4', 'webm', 'ogg'])) $type = 'video';
        elseif ($ext === 'gif') $type = 'gif';
        else $type = 'image';
    } else {
        $type = $ad['ad_type'];
    }

    // Update DB
    $upd = $conn->prepare("
    UPDATE company_ads
    SET file_name=?, ad_type=?, ad_position=?
    WHERE id=?
  ");
    $upd->bind_param("sssi", $newFile, $type, $position, $id);
    $upd->execute();
    $upd->close();

    $_SESSION['message'] = ['type' => 'success', 'text' => 'Ad updated!'];
    header("Location: view_company_ads.php");
    exit;
}
?>

<?php include 'header.php'; ?>
<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>
        <div class="container-fluid py-4">

            <h1 class="h3 mb-4 text-gray-800">Edit Company Ad</h1>
            <?php if (!empty($_SESSION['message'])): ?>
                <div class="alert alert-<?= $_SESSION['message']['type'] ?>" id="flash-msg">
                    <?= $_SESSION['message']['text'] ?>
                </div>
                <script>
                    setTimeout(() => document.getElementById('flash-msg').remove(), 3000);
                </script>
            <?php unset($_SESSION['message']);
            endif; ?>

            <form method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
                <div class="mb-3">
                    <label class="form-label">Current Preview</label><br>
                    <?php if ($ad['ad_type'] === 'video'): ?>
                        <video width="200" controls src="../uploads/company_ads/<?= urlencode($ad['file_name']) ?>"></video>
                    <?php else: ?>
                        <img src="../uploads/company_ads/<?= urlencode($ad['file_name']) ?>" width="200"
                            <?= $ad['ad_type'] === 'gif' ? '' : 'class="img-fluid"' ?>>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="ad_file" class="form-label">Replace File (optional)</label>
                    <input type="file" name="ad_file" id="ad_file" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Position</label><br>
                    <label class="me-3">
                        <input type="radio" name="ad_position" value="left"
                            <?= $ad['ad_position'] === 'left' ? 'checked' : '' ?> required> Left
                    </label>
                    <label>
                        <input type="radio" name="ad_position" value="right"
                            <?= $ad['ad_position'] === 'right' ? 'checked' : '' ?>> Right
                    </label>
                </div>

                <button class="btn btn-success">Save Changes</button>
                <a href="view_company_ads.php" class="btn btn-secondary">Cancel</a>
            </form>

        </div>
    </div>
</div>
<?php include 'end.php'; ?>