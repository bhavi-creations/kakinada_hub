<?php
// view_company_ads.php
include 'header.php';
include '../../db.connection/db_connection.php';

// Function to safely escape output
function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// Handle delete action
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Fetch file name to delete from server
    $stmt_select_file = $conn->prepare("SELECT file_name FROM company_ads WHERE id = ?");
    $stmt_select_file->bind_param("i", $delete_id);
    $stmt_select_file->execute();
    $result_file = $stmt_select_file->get_result();
    if ($row_file = $result_file->fetch_assoc()) {
        $file_to_delete = '../uploads/company_ads/' . $row_file['file_name'];
    }
    $stmt_select_file->close();

    $stmt_delete = $conn->prepare("DELETE FROM company_ads WHERE id = ?");
    $stmt_delete->bind_param("i", $delete_id);
    if ($stmt_delete->execute()) {
        if (isset($file_to_delete) && file_exists($file_to_delete)) {
            unlink($file_to_delete);
        }
        $delete_success_message = "Ad deleted successfully.";
    } else {
        $delete_error_message = "Error deleting ad: " . $stmt_delete->error;
    }
    $stmt_delete->close();

    // Redirect to avoid form resubmission on refresh
    header("Location: view_company_ads.php?delete_success=1");
    exit();
}

// Fetch all company ads with company names and target URLs
$search = isset($_GET['search_name']) ? trim($_GET['search_name']) : '';
$where = '';
if (!empty($search)) {
    $safe_search = $conn->real_escape_string($search);
    $where = "WHERE c.name LIKE '%$safe_search%'";
}

$sql = "
    SELECT a.id, a.file_name, a.ad_type, a.ad_position, a.created_at, a.target_url,
           c.name AS company
    FROM company_ads AS a
    JOIN companies AS c ON a.company_id = c.id
    $where
    ORDER BY a.created_at DESC
";

$result = $conn->query($sql);
$ads = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ads[] = $row;
    }
}
?>

<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>
        <div id="content" class="container-fluid">

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">View Company Ads</h1>
                <div>
                    <a href="add_company_ads.php" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fa-regular fa-plus"></i> Upload New Ads
                    </a>
                    <a href="companies.php" class="btn btn-sm btn-secondary shadow-sm">
                        <i class="fa-regular fa-building"></i> View Companies
                    </a>
                </div>
            </div>

            <div class="form_view_company_ads">
                <form method="GET" class="d-inline ">
                    <input type="text" name="search_name" class="custom-input shadow-sm"
                           placeholder="🔍 Company Name"
                           value="<?= isset($_GET['search_name']) ? htmlspecialchars($_GET['search_name']) : '' ?>">
                    <button type="submit" class="btn btn-sm btn-info shadow-sm">
                        <i class="fas fa-search"></i> Search
                    </button>
                </form>
            </div>

            <?php if (isset($_GET['delete_success'])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Ad deleted successfully!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <script>
                    setTimeout(function() {
                        const alertBox = document.querySelector('.alert-success');
                        if (alertBox) {
                            alertBox.remove();
                        }
                    }, 3000);
                </script>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Company</th>
                            <th>Preview</th>
                            <th>Type</th>
                            <th>Position</th>
                            <th>Target URL</th>
                            <th>Uploaded</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($ads as $ad):
                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= htmlspecialchars($ad['company']) ?></td>
                                <td>
                                    <?php if (!empty($ad['target_url'])): ?>
                                        <a href="<?= htmlspecialchars($ad['target_url']) ?>" target="_blank" style="display: inline-block;">
                                    <?php endif; ?>
                                        <?php if ($ad['ad_type'] === 'video'): ?>
                                            <video width="120" controls src="../uploads/company_ads/<?= urlencode($ad['file_name']) ?>"></video>
                                        <?php else: ?>
                                            <img src="../uploads/company_ads/<?= urlencode($ad['file_name']) ?>"
                                                 width="120"
                                                 <?= $ad['ad_type'] === 'gif' ? '' : 'class="img-fluid"' ?>>
                                        <?php endif; ?>
                                    <?php if (!empty($ad['target_url'])): ?>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td><?= ucfirst($ad['ad_type']) ?></td>
                                <td><?= ucfirst($ad['ad_position']) ?></td>
                                <td>
                                    <?php if (!empty($ad['target_url'])): ?>
                                        <a href="<?= htmlspecialchars($ad['target_url']) ?>" target="_blank"><?= htmlspecialchars($ad['target_url']) ?></a>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d M Y', strtotime($ad['created_at'])) ?></td>
                                <td>
                                    <a href="edit_company_ad.php?id=<?= $ad['id'] ?>"
                                       class="btn btn-warning btn-sm mb-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm mb-1 delete-ad"
                                            data-id="<?= $ad['id'] ?>">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <script>
                // AJAX Delete
                document.querySelectorAll('.delete-ad').forEach(btn => {
                    btn.addEventListener('click', () => {
                        if (!confirm('Remove this ad?')) return;
                        fetch('delete_company_ad.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'id=' + encodeURIComponent(btn.dataset.id)
                        })
                        .then(r => r.json())
                        .then(js => {
                            if (js.success) {
                                btn.closest('tr').remove();
                            } else {
                                alert(js.message);
                            }
                        })
                        .catch(() => alert('Error deleting ad.'));
                    });
                });
            </script>

        </div>
    </div>
</div>

<?php include 'end.php'; ?>