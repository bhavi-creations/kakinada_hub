<?php include 'header.php'; ?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">

                <div class="container py-4">
             
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Upload Company Ads</h1>
                   
                    <a href="view_company_ads.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                          <i class="fa-regular fa-eye"></i> view Ads
                    </a>
                    <a href="companies.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                          <i class="fa-regular fa-eye"></i> view Companies
                    </a>
                </div>
                    <?php
                    include '../../db.connection/db_connection.php';
                 

                    // Fetch companies for the dropdown
                    $companies = $conn->query("SELECT id,name FROM companies ORDER BY name");

                    // Handle form submission
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $company_id   = (int)$_POST['company_id'];
                        $ad_position  = $_POST['ad_position']; // 'left' or 'right'
                        $upload_dir   = '../uploads/company_ads/';
                        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

                        $errors = [];
                        foreach ($_FILES['ads_files']['tmp_name'] as $idx => $tmpPath) {
                            if (!$tmpPath) continue;
                            $origName = basename($_FILES['ads_files']['name'][$idx]);
                            $ext      = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                            $newName  = time() . "_{$idx}." . $ext;
                            $dest     = $upload_dir . $newName;
                            if (!move_uploaded_file($tmpPath, $dest)) {
                                $errors[] = "Failed to upload $origName";
                                continue;
                            }
                            // Determine ad_type
                            if (in_array($ext, ['mp4', 'webm', 'ogg'])) {
                                $ad_type = 'video';
                            } elseif ($ext === 'gif') {
                                $ad_type = 'gif';
                            } else {
                                $ad_type = 'image';
                            }
                            // Insert into DB
                            $stmt = $conn->prepare(
                                "INSERT INTO company_ads (company_id,file_name,ad_type,ad_position)
                                 VALUES (?,?,?,?)"
                            );
                            $stmt->bind_param("isss", $company_id, $newName, $ad_type, $ad_position);
                            $stmt->execute();
                            $stmt->close();
                        }

                        if (empty($errors)) {
                            $_SESSION['message'] = ['type' => 'success', 'text' => 'Ads uploaded successfully!'];
                        } else {
                            $_SESSION['message'] = ['type' => 'danger', 'text' => implode('<br>', $errors)];
                        }
                        header("Location: add_company_ads.php");
                        exit;
                    }
                    ?>

                    <?php if (!empty($_SESSION['message'])): ?>
                        <div id="messageAlert" class="alert alert-<?= $_SESSION['message']['type'] ?>">
                            <?= $_SESSION['message']['text'] ?>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                        <script>
                            // Hide the alert after 3 seconds
                            setTimeout(() => {
                                const msg = document.getElementById('messageAlert');
                                if (msg) msg.style.display = 'none';
                            }, 3000);
                        </script>
                    <?php endif; ?>

                    <form action="" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
                        <div class="mb-3">
                            <label for="company_id" class="form-label">Select Company</label>
                            <select name="company_id" id="company_id" class="form-select" required>
                                <option value="">— choose —</option>
                                <?php while ($c = $companies->fetch_assoc()): ?>
                                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ad Position</label>
                            <div>
                                <label class="me-3"><input type="radio" name="ad_position" value="left" required> Left</label>
                                <label><input type="radio" name="ad_position" value="right"> Right</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="ads_files" class="form-label">
                                Upload Files (images/.jpg/.png/.gif, videos/.mp4/.webm/.ogg)
                            </label>
                            <input type="file" name="ads_files[]" id="ads_files" class="form-control" multiple required>
                        </div>

                        <button type="submit" class="btn btn-primary">Upload Ads</button>
                    </form>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>
<?php include 'end.php'; ?>
