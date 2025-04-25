<?php include 'header.php'; ?>
<?php include '../../db.connection/db_connection.php'; ?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">View Banner Ads</h1>
                    <a href="add_banner_adds.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Banner Ad
                    </a>
                </div>

                <!-- Display Success Message -->
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" id="success-alert">
                        Banner Updated successfully!
                    </div>
                    <script>
                        setTimeout(function() {
                            const alertBox = document.getElementById("success-alert");
                            if (alertBox) {
                                alertBox.style.display = "none";
                            }
                        }, 3000);
                    </script>
                <?php endif; ?>

                <!-- Banner Ads Table -->
                <div class="card shadow p-4">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Page Name</th>
                                <th>Banner Image</th>
                                <th>Target URL</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetching banner ads from the database
                            $result = mysqli_query($conn, "SELECT * FROM banner_ads ORDER BY id DESC");
                            $counter = 1; // Initialize serial number counter

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?= $counter++; ?></td> <!-- Display serial number -->
                                        <td><?= htmlspecialchars($row['page_name']); ?></td>
                                        <td><img src="../uploads/banner_ads/<?= htmlspecialchars($row['image_path']); ?>" alt="Banner Image" width="150" height="auto"></td>
                                        <td><a href="<?= htmlspecialchars($row['target_url']); ?>" target="_blank"><?= htmlspecialchars($row['target_url']); ?></a></td>
                                        <td><?= ucfirst($row['status']); ?></td>
                                        <td>
                                            <a href="edit_banner_adds.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="delete_banner_adds.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this ad?');">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr><td colspan="6" class="text-center">No Banner Ads found</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>
