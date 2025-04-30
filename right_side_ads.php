
<?php
// right_side_ads.php

// Function to fetch right side pillar ads
function getRightSidePillerAds($conn, $page)
{
    $ads = [];
    $stmt = $conn->prepare("SELECT image_path, target_url FROM side_piller_ads WHERE ad_side = 'right' AND status = 'active' AND (page_name = ? OR page_name IS NULL OR page_name = '') ORDER BY created_at DESC");
    $stmt->bind_param("s", $page);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $ads[] = $row;
    }
    $stmt->close();
    return $ads;
}

// Define the base path for the uploaded images
$upload_path = './admin/uploads/side_piller_ads/';

// Get the current page name
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// Fetch right side ads
$right_ads = getRightSidePillerAds($conn, $current_page);
?>

<div class="col-lg-2 col-12 text_side_div d-none d-lg-block">
    <?php if (!empty($right_ads)): ?>
        <?php foreach ($right_ads as $ad): ?>
            <a href="<?= htmlspecialchars($ad['target_url']) ?>" target="_blank" rel="noopener noreferrer">
                <img src="<?= $upload_path . htmlspecialchars($ad['image_path']) ?>" alt="Right Side Ad" class="img-fluid side_dive_images mb-3">
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
