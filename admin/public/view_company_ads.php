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

    

      <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
          <thead>
            <tr>
              <th>S.no</th>
              <th>Company</th>
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
            $where = '';
            if (!empty($search)) {
              $safe_search = $conn->real_escape_string($search);
              $where = "WHERE c.name LIKE '%$safe_search%'";
            }

            $sql = "
  SELECT a.id, a.file_name, a.ad_type, a.ad_position, a.created_at,
         c.name AS company
  FROM company_ads AS a
  JOIN companies AS c ON a.company_id = c.id
  $where
  ORDER BY a.created_at DESC
";

            $result = $conn->query($sql);
            $i = 1;
            while ($ad = $result->fetch_assoc()):
            ?>
              <tr>
                <td><?= $i++ ?></td>
                <td><?= htmlspecialchars($ad['company']) ?></td>
                <td>
                  <?php if ($ad['ad_type'] === 'video'): ?>
                    <video width="120" controls src="../uploads/company_ads/<?= urlencode($ad['file_name']) ?>"></video>
                  <?php else: ?>
                    <img src="../uploads/company_ads/<?= urlencode($ad['file_name']) ?>"
                      width="120"
                      <?= $ad['ad_type'] === 'gif' ? '' : 'class="img-fluid"' ?>>
                  <?php endif; ?>
                </td>
                <td><?= ucfirst($ad['ad_type']) ?></td>
                <td><?= ucfirst($ad['ad_position']) ?></td>
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