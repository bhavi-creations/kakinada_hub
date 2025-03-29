<?php
include '../../db.connection/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['title'])) {
        $_SESSION['error'] = "Title is required!";
        header("Location: home_ads.php");
        exit();
    }

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $type = isset($_POST['type']) ? mysqli_real_escape_string($conn, $_POST['type']) : 'upper';

    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = "Error uploading image!";
        header("Location: home_ads.php");
        exit();
    }

    $image = $_FILES['image'];
    $imageName = time() . "_" . basename($image['name']);
    $targetDir = "../uploads/home_ads/";
    $targetFile = $targetDir . $imageName;

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
    if (!in_array($image['type'], $allowedTypes)) {
        $_SESSION['error'] = "Invalid file type! Only JPG, PNG, GIF, WEBP, and SVG allowed.";
        header("Location: home_ads.php");
        exit();
    }

    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        $query = "INSERT INTO home_ads (title, image, type) VALUES ('$title', '$imageName', '$type')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "Image uploaded successfully!";
            header("Location: view_home_ads.php");
            exit();
        } else {
            $_SESSION['error'] = "Database error: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['error'] = "Failed to move uploaded file!";
    }

    header("Location: home_ads.php");
    exit();
}
?>

<?php include 'header.php'; ?>
<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>
        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">UPLOAD IMAGE</h1>
                    <a href="view_home_ads.php" class="btn btn-primary btn-sm"><i class="fa-regular fa-eye"></i> View Images</a>
                </div>

                <div class="row">
                    <div class="col-xl-11">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-success">ADD IMAGE</h6>
                            </div>

                            <div class="card-body">
                                <form id="addblogform" action="home_ads.php" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter image title" required>
                                    </div>

                                    <div class="mb-3">
                                        
                                        <label for="imageType" class="form-label">Select Image Type</label>
                                        <select class="form-control" name="type" id="imageType">
                                        <option >Select the field</option>
                                            <option value="upper" selected>Upper Image</option>
                                            <option value="lower">Lower Image</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="imageUpload" class="form-label">Select Image</label>
                                        <input type="file" class="form-control" name="image" id="imageUpload" accept="image/*" required>
                                    </div>

                                    <div class="row p-3">
                                        <button type="reset" class="btn btn-danger mx-1 my-2">Clear</button>
                                        <button type="submit" class="btn btn-success mx-1 my-2">Upload Image</button>
                                    </div>
                                </form>

                                <?php if (isset($_SESSION['success'])) : ?>
                                    <div class="alert alert-success mt-3"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
                                <?php endif; ?>

                                <?php if (isset($_SESSION['error'])) : ?>
                                    <div class="alert alert-danger mt-3"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    setTimeout(function() {
                        document.querySelector(".alert")?.remove();
                    }, 4000);
                </script>
            </div>
        </div>
    </div>
</div>

<?php include 'end.php'; ?>
