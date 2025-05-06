<?php
include 'header.php';
include '../../db.connection/db_connection.php';

function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// Handle delete
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt_delete = $conn->prepare("DELETE FROM side_piller_ads WHERE id = ?");
    $stmt_delete->bind_param("i", $delete_id);
    if ($stmt_delete->execute()) {
        $delete_success_message = "Ad deleted successfully.";
    } else {
        $delete_error_message = "Error deleting ad: " . $stmt_delete->error;
    }
    $stmt_delete->close();
}

// Fetch all ads
$sql = "SELECT * FROM side_piller_ads ORDER BY created_at DESC";
$result = $conn->query($sql);
$ads = [];
$page_names = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ads[] = $row;
        if (!in_array($row['page_name'], $page_names)) {
            $page_names[] = $row['page_name'];
        }
    }
}
?>

<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">View Side Piller Ads</h1>

                <?php if (isset($delete_success_message)) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= e($delete_success_message) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($delete_error_message)) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= e($delete_error_message) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                    </div>
                <?php endif; ?>

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Current Side Piller Ads</h6>
                        <div>
                            <label for="pageFilter">Filter by Page Name:</label>
                            <select id="pageFilter" class="form-control form-control-sm" style="width: auto; display: inline-block;">
                                <option value="">All</option>
                                <?php foreach ($page_names as $page) : ?>
                                    <option value="<?= e($page) ?>"><?= e(ucfirst($page)) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <?php if (empty($ads)) : ?>
                                <p>No side piller ads found.</p>
                            <?php else : ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>ID</th>
                                            <th>Page Name</th>
                                            <th>Ad Side</th>
                                            <th>Ad Position</th>
                                            <th>Image</th>
                                            <th>Target URL</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $serialNumber = 1; ?>
                                        <?php foreach ($ads as $ad) : ?>
                                            <tr>
                                                <td><?= e($serialNumber++) ?></td>
                                                <td><?= e($ad['id']) ?></td>
                                                <td><?= e(ucfirst($ad['page_name'])) ?></td>
                                                <td><?= e(ucfirst($ad['ad_side'])) ?></td>
                                                <td><?= e($ad['ad_position'] ?: '-') ?></td>
                                                <td><img src="../uploads/side_piller_ads/<?= e($ad['image_path']) ?>" alt="Ad Image" width="100"></td>
                                                <td><a href="<?= e($ad['target_url']) ?>" target="_blank"><?= e($ad['target_url']) ?></a></td>
                                                <td><?= e(ucfirst($ad['status'])) ?></td>
                                                <td><?= e($ad['created_at']) ?></td>
                                                <td>
                                                    <a href="edit_side_piller_ads.php?id=<?= e($ad['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="view_side_piller_ads.php?delete_id=<?= e($ad['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this ad?')">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>
<?php include 'end.php'; ?>

<!-- DataTables JS (make sure you load these if not already in your template) -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- DataTables Initialization + Page Name Filter --><script>
    $(document).ready(function () {
        var table = $('#dataTable').DataTable({
            lengthChange: false,
            info: false,
            paging: false
        });

        $('#pageFilter').on('change', function () {
            var selectedPage = $(this).val();
            if (selectedPage) {
                table.column(2).search('^' + selectedPage + '$', true, false).draw(); // Exact match
            } else {
                table.column(2).search('').draw(); // Reset
            }
        });
    });
</script>
