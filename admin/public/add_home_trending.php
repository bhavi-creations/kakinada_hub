<?php include 'header.php'; ?>
<?php include '../../db.connection/db_connection.php'; ?>

<?php
// Success message if redirected with 'success' parameter
$successMsg = isset($_GET['success']) ? "Trending item added successfully!" : '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $offer = mysqli_real_escape_string($conn, $_POST['offer']);
    $type = $_POST['type'];

    // Image Upload Handling
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $uploadDir = '../uploads/home_trending/';
    $uploadPath = $uploadDir . basename($imageName);

    // Ensure upload folder exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($imageTmp, $uploadPath)) {
        $sql = "INSERT INTO trending (title, description, image, link, offer, type)
                VALUES ('$title', '$description', '$imageName', '$link', '$offer', '$type')";

        if (mysqli_query($conn, $sql)) {
            // Redirect to prevent form resubmission
            header("Location: add_home_trending.php?success=1");
            exit();
        } else {
            $successMsg = "Error: " . mysqli_error($conn);
        }
    } else {
        $successMsg = "Image upload failed.";
    }
}
?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Add Home Page Trending</h1>
                    <a href="view_home_trending.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-regular fa-eye"></i> View Trending Posts
                    </a>
                </div>

                <?php if (!empty($successMsg)): ?>
                    <div class="alert alert-success" id="successAlert">
                        <?php echo $successMsg; ?>
                    </div>
                    <script>
                        setTimeout(() => {
                            document.getElementById('successAlert').style.display = 'none';
                        }, 3000);
                    </script>
                <?php endif; ?>

                <div class="card shadow p-4">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <div class="form-group col-6">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="form-group col-6">
                                <label>Offer</label>
                                <input type="text" name="offer" class="form-control" required>
                            </div>

                            <div class="form-group col-6">
                                <label>Link (optional)</label>
                                <input type="text" name="link" class="form-control">
                            </div>

                            <div class="form-group col-6">
                                <label>Type</label>
                                <select name="type" class="form-control" required>
                                    <option value="upper">Upper</option>
                                    <option value="lower">Lower</option>
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control-file" accept="image/*" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Add Trending Item</button>
                    </form>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>
