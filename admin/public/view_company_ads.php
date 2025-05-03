<?php
// view_company_ads.php
include 'header.php';
include '../../db.connection/db_connection.php';
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


            <form method="GET" class="flex-wrap gap-2 form_view_company_ads">
                <input type="text" name="search_name" placeholder="🔍 Company Name"
                    value="<?= isset($_GET['search_name']) ? htmlspecialchars($_GET['search_name']) : '' ?>">

                <select name="ad_position">
                    <option value="">All Positions</option>
                    <option value="left" <?= (isset($_GET['ad_position']) && $_GET['ad_position'] === 'left') ? 'selected' : '' ?>>Left
                    </option>
                    <option value="right" <?= (isset($_GET['ad_position']) && $_GET['ad_position'] === 'right') ? 'selected' : '' ?>>
                        Right</option>
                    <option value="mobile popup" <?= (isset($_GET['ad_position']) && $_GET['ad_position'] === 'mobile popup') ? 'selected' : '' ?>>
                        Mobile Pop Up Ads</option>
                </select>

                <button type="submit" class="btn btn-sm btn-info shadow-sm">
                    <i class="fas fa-search"></i> Filter
                </button>
            </form>






            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Company</th>
                            <th>Ad Number</th>
                            <th>Preview</th>
                            <th>Type</th>
                            <th>Position</th>
                            <th>Uploaded</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $search = isset($_GET['search_name']) ? trim($_GET['search_name']) : '';
                        $position = isset($_GET['ad_position']) ? trim($_GET['ad_position']) : '';

                        $whereClauses = [];

                        if (!empty($search)) {
                            $safe_search = $conn->real_escape_string($search);
                            $whereClauses[] = "c.name LIKE '%$safe_search%'";
                        }

                        if (!empty($position)) {
                            $safe_position = $conn->real_escape_string($position);
                            $whereClauses[] = "a.ad_position = '$safe_position'";
                        }

                        $where = !empty($whereClauses) ? 'WHERE ' . implode(' AND ', $whereClauses) : '';



                        $sql = "
                            SELECT a.id, a.file_name, a.ad_type, a.ad_position, a.created_at,
                                   c.name AS company, a.ad_number
                            FROM company_ads AS a
                            JOIN companies AS c ON a.company_id = c.id
                            $where
                            ORDER BY c.name, a.ad_position, a.ad_number
                            ";

                        $result = $conn->query($sql);
                        $i = 1;
                        while ($ad = $result->fetch_assoc()):
                            ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($ad['company']) ?></td>
                            <td><?= htmlspecialchars($ad['ad_number']) ?></td>
                            <td>
                                <?php if ($ad['ad_type'] === 'video'): ?>
                                <video width="120" controls src="../uploads/company_ads/<?= urlencode($ad['file_name']) ?>"></video>
                                <?php else: ?>
                                <img src="../uploads/company_ads/<?= urlencode($ad['file_name']) ?>" width="120"
                                    <?= $ad['ad_type'] === 'gif' ? '' : 'class="img-fluid"' ?>>
                                <?php endif; ?>
                            </td>
                            <td><?= ucfirst($ad['ad_type']) ?></td>
                            <td><?= ucfirst($ad['ad_position']) ?></td>
                            <td><?= date('d M Y', strtotime($ad['created_at'])) ?></td>
                            <td>
                                <a href="edit_company_ad.php?id=<?= $ad['id'] ?>" class="btn btn-warning btn-sm mb-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="btn btn-danger btn-sm mb-1 delete-ad" data-id="<?= $ad['id'] ?>">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
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
