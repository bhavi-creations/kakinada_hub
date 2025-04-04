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
                    <h1 class="h3 mb-0 text-gray-800">Manage Marquee Text</h1>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <?php 
                            include '../../db.connection/db_connection.php';

                            // Handle Delete Request
                            if (isset($_GET['delete'])) {
                                $id = intval($_GET['delete']);
                                $delete_sql = "DELETE FROM marquee_texts WHERE id = ?";
                                $stmt = $conn->prepare($delete_sql);
                                $stmt->bind_param("i", $id);

                                if ($stmt->execute()) {
                                    $_SESSION['message'] = '<div class="alert alert-success">Marquee text deleted successfully!</div>';
                                } else {
                                    $_SESSION['message'] = '<div class="alert alert-danger">Error deleting text.</div>';
                                }
                                $stmt->close();
                                header("Location: add_marquee.php");
                                exit;
                            }

                            // Handle Edit Request
                            $edit_text = "";
                            $edit_id = "";
                            if (isset($_GET['edit'])) {
                                $edit_id = intval($_GET['edit']);
                                $edit_sql = "SELECT text FROM marquee_texts WHERE id = ?";
                                $stmt = $conn->prepare($edit_sql);
                                $stmt->bind_param("i", $edit_id);
                                $stmt->execute();
                                $stmt->bind_result($edit_text);
                                $stmt->fetch();
                                $stmt->close();
                            }

                            // Handle Form Submission (Insert / Update)
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $marquee_text = trim($_POST['marquee_text']);

                                if (!empty($marquee_text)) {
                                    if (!empty($_POST['edit_id'])) {
                                        // Update existing text
                                        $id = intval($_POST['edit_id']);
                                        $sql = "UPDATE marquee_texts SET text = ? WHERE id = ?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("si", $marquee_text, $id);
                                        $_SESSION['message'] = '<div class="alert alert-success">Marquee text updated successfully!</div>';
                                    } else {
                                        // Insert new text
                                        $sql = "INSERT INTO marquee_texts (text) VALUES (?)";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("s", $marquee_text);
                                        $_SESSION['message'] = '<div class="alert alert-success">Marquee text added successfully!</div>';
                                    }

                                    if ($stmt->execute()) {
                                        $stmt->close();
                                        header("Location: add_marquee.php");
                                        exit;
                                    } else {
                                        echo '<div class="alert alert-danger">Error saving text.</div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-warning">Please enter some text!</div>';
                                }
                            }

                            // Display Success/Error Messages
                            if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            }
                            ?>

                            <form action="" method="POST">
                                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
                                <div class="form-group">
                                    <label for="marquee_text">Enter Marquee Text:</label>
                                    <input type="text" class="form-control" name="marquee_text" id="marquee_text" value="<?php echo htmlspecialchars($edit_text); ?>" required>
                                </div>
                                <button type="submit" class="btn btn-<?php echo empty($edit_id) ? 'primary' : 'success'; ?> mt-2">
                                    <?php echo empty($edit_id) ? 'Add Marquee Text' : 'Update Marquee Text'; ?>
                                </button>
                            </form>
                        </div>

                        <div class="col-md-4">
                            <h4>Existing Marquee Texts</h4>
                            <ul class="list-group">
                                <?php
                                $result = $conn->query("SELECT id, text FROM marquee_texts ORDER BY created_at DESC");
                                while ($row = $result->fetch_assoc()) {
                                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">
                                            ' . htmlspecialchars($row['text']) . '
                                            <div>
                                                <a href="?edit=' . $row['id'] . '" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="?delete=' . $row['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\');">Delete</a>
                                            </div>
                                          </li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>
