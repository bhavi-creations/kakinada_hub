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
                    <a href="add_banner_adds.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Banner Ads
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="row row-custom no-gutters col-12">
                            <?php
                            include '../../db.connection/db_connection.php';

                            $showSuccess = false;

                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['page_name'])) {
                                $page_name = trim($_POST['page_name']);
                                $stmt = $conn->prepare("INSERT IGNORE INTO banner_pages (name) VALUES (?)");
                                $stmt->bind_param("s", $page_name);
                                if ($stmt->execute()) {
                                    // redirect to avoid resubmission
                                    header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
                                    exit;
                                }
                            }

                            if (isset($_GET['success']) && $_GET['success'] == 1) {
                                $showSuccess = true;
                            }
                            ?>

                            <div class="container mt-4">
                                <h4>Manage Banner Pages</h4>

                                <?php if ($showSuccess): ?>
                                    <div class="alert alert-success" id="successMsg">Page added successfully!</div>
                                <?php endif; ?>

                                <form method="POST">
                                    <div class="form-group">
                                        <label>Add New Page Name</label>
                                        <input type="text" name="page_name" class="form-control" placeholder="e.g. contact, gallery" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Add Page</button>
                                </form>
                            </div>

                            <script>
                                // Auto-hide success alert after 3 seconds
                                setTimeout(() => {
                                    const msg = document.getElementById('successMsg');
                                    if (msg) {
                                        msg.style.display = 'none';
                                    }
                                }, 3000);
                            </script>

                        </div>
                    </div>
                </div>



                <!-- Display Existing Pages -->
                <div class="mt-5">
                    <h4>Existing Pages</h4>
                    <?php
                    // Handle DELETE
                    if (isset($_GET['delete_id'])) {
                        $delete_id = intval($_GET['delete_id']);
                        $stmt = $conn->prepare("DELETE FROM banner_pages WHERE id = ?");
                        $stmt->bind_param("i", $delete_id);
                        if ($stmt->execute()) {
                            header("Location: " . $_SERVER['PHP_SELF'] . "?deleted=1");
                            exit;
                        }
                    }

                    // Handle UPDATE
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
                        $edit_id = intval($_POST['edit_id']);
                        $new_name = trim($_POST['edit_name']);
                        $stmt = $conn->prepare("UPDATE banner_pages SET name = ? WHERE id = ?");
                        $stmt->bind_param("si", $new_name, $edit_id);
                        if ($stmt->execute()) {
                            header("Location: " . $_SERVER['PHP_SELF'] . "?updated=1");
                            exit;
                        }
                    }

                    // Fetch and display
                    $pages = $conn->query("SELECT * FROM banner_pages ORDER BY id DESC");
                    ?>

                    <?php if (isset($_GET['deleted'])): ?>
                        <div class="alert alert-danger" id="deleteMsg">Page deleted successfully.</div>
                    <?php endif; ?>

                    <?php if (isset($_GET['updated'])): ?>
                        <div class="alert alert-info" id="updateMsg">Page updated successfully.</div>
                    <?php endif; ?>

                    <table class="table table-bordered mt-3">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Page Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($row = $pages->fetch_assoc()): ?>
                                <tr id="row_<?= $row['id']; ?>">

                                    <td><?= $i++; ?></td>
                                    <td>
                                        <?php if (isset($_GET['edit_id']) && $_GET['edit_id'] == $row['id']): ?>
                                            <!-- Edit Mode -->
                                            <form method="POST" class="form-inline">
                                                <input type="hidden" name="edit_id" value="<?= $row['id']; ?>">
                                                <input type="text" name="edit_name" class="form-control mr-2" value="<?= htmlspecialchars($row['name']); ?>" required>
                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                            </form>
                                        <?php else: ?>
                                            <?= htmlspecialchars($row['name']); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!isset($_GET['edit_id']) || $_GET['edit_id'] != $row['id']): ?>
                                            <a href="?edit_id=<?= $row['id']; ?>#row_<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>

                                            <a href="?delete_id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this page?');">Delete</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <script>
                    // Auto-hide success messages
                    setTimeout(() => {
                        const msgs = ['deleteMsg', 'updateMsg'];
                        msgs.forEach(id => {
                            let el = document.getElementById(id);
                            if (el) el.style.display = 'none';
                        });
                    }, 3000);
                </script>


            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>