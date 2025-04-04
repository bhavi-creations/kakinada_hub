<?php include 'header.php'; ?>
<?php include '../../db.connection/db_connection.php'; ?>

<?php
$id = intval($_GET['id']);
$item = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM offers WHERE id = $id"));

if (!$item) die("Item not found.");

$successMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $offer = mysqli_real_escape_string($conn, $_POST['offer']);
    $type = $_POST['type'];

    $imageName = $item['image']; // default old image

    if (!empty($_FILES['image']['name'])) {
        $newImage = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        $uploadPath = '../uploads/home_offers/' . basename($newImage);

        if (move_uploaded_file($tmpName, $uploadPath)) {
            // Delete old image
            $oldImagePath = '../uploads/home_offers/' . $item['image'];
            if (file_exists($oldImagePath)) unlink($oldImagePath);

            $imageName = $newImage;
        }
    }

    $updateQuery = "UPDATE offers SET 
        title='$title', description='$description', link='$link', 
        offer='$offer', type='$type', image='$imageName' 
        WHERE id=$id";

    if (mysqli_query($conn, $updateQuery)) {
        $successMsg = "offers item updated successfully!";
        $item = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM offers WHERE id = $id")); // refresh data
    } else {
        $successMsg = "Error updating item: " . mysqli_error($conn);
    }
}
?>

<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">


                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Edit offers Item</h1>
                    <a href="view_home_offers.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-regular fa-eye"></i> View offers Lists
                    </a>
                </div>

                

                <?php if ($successMsg): ?>
                    <div class="alert alert-success"><?= $successMsg ?></div>
                <?php endif; ?>

                <div class="card shadow p-4">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Title</label>
                                <input type="text" name="title" value="<?= htmlspecialchars($item['title']) ?>" class="form-control" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Offer</label>
                                <input type="text" name="offer" value="<?= htmlspecialchars($item['offer']) ?>" class="form-control" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($item['description']) ?></textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Link (optional)</label>
                                <input type="text" name="link" value="<?= htmlspecialchars($item['link']) ?>" class="form-control">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Type</label>
                                <select name="type" class="form-control" required>
                                    <option value="upper" <?= $item['type'] == 'upper' ? 'selected' : '' ?>>Upper</option>
                                    <option value="lower" <?= $item['type'] == 'lower' ? 'selected' : '' ?>>Lower</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Current Image</label><br>
                                <img src="../uploads/home_offers/<?= $item['image'] ?>" width="150" class="img-thumbnail">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Upload New Image (optional)</label>
                                <input type="file" name="image" class="form-control-file" accept="image/*">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Update Item</button>
                        <a href="view_home_offers.php" class="btn btn-secondary mt-3">Cancel</a>
                    </form>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>