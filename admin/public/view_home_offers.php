<?php include 'header.php'; ?>
<?php include '../../db.connection/db_connection.php'; ?>

<?php
// Handle delete action
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // Fetch and delete image
    $getImgQuery = mysqli_query($conn, "SELECT image FROM offers WHERE id = $id");
    if ($getImgQuery && mysqli_num_rows($getImgQuery) > 0) {
        $row = mysqli_fetch_assoc($getImgQuery);
        $imagePath = '../uploads/home_offers/' . $row['image'];
        if (file_exists($imagePath)) unlink($imagePath);
    }

    // Delete record
    mysqli_query($conn, "DELETE FROM offers WHERE id = $id");
    header("Location: view_home_offers.php?deleted=1");
    exit();
}
?>

<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Manage Home Page offers</h1>
                    <a href="add_home_offers.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i>Add offers List
                    </a>
                </div>


                <?php if (isset($_GET['deleted'])): ?>
                    <div class="alert alert-success">offers item deleted successfully!</div>
                <?php endif; ?>

                <div class="card shadow p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Offer</th>
                                    <th>Link</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM offers ORDER BY id DESC");
                                if (mysqli_num_rows($result) > 0):
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($result)):
                                ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td>
                                                <img src="../uploads/home_offers/<?= $row['image'] ?>" width="80" height="60" style="object-fit: cover;" />
                                            </td>
                                            <td><?= htmlspecialchars($row['title']) ?></td>
                                            <td><?= htmlspecialchars($row['description']) ?></td>
                                            <td><?= htmlspecialchars($row['offer']) ?></td>
                                            <td>
                                                <?php if (!empty($row['link'])): ?>
                                                    <a href="<?= $row['link'] ?>" target="_blank">Visit</a>
                                                <?php else: ?>
                                                    —
                                                <?php endif; ?>
                                            </td>
                                            <td><?= ucfirst($row['type']) ?></td>
                                            <td>
                                                <a href="view_home_offers_item.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">View</a>
                                                <a href="edit_home_offers_item.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="delete_home_offers_item.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                    endwhile;
                                else:
                                    ?>
                                    <tr>
                                        <td colspan="8" class="text-center">No offers items found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>