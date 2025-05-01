<?php
// Assuming database connection is available as $conn
$upload_path = './admin/uploads/side_piller_ads/';
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// Fetch popup ads from DB
$popup_ads_query = mysqli_query($conn, "
    SELECT image_path, target_url 
    FROM side_piller_ads 
    WHERE ad_side = 'popup' 
    AND (page_name = '$current_page' OR page_name IS NULL OR page_name = '') 
    AND status = 'active' 
    ORDER BY created_at DESC
");

$popup_ads = [];
while ($row = mysqli_fetch_assoc($popup_ads_query)) {
    $popup_ads[] = $row;
}
?>

<?php if (!empty($popup_ads)): ?>
<!-- Modal Structure -->
<div id="mobileModal" class="mobile-modal-overlay"  >
    
    <div class="mobile-modal-content" >
        <!-- Close Button -->
        <button class="close-btn" onclick="closeMobileModal()" 
                style="position: absolute; top: 5px; right: 10px; background: none; background-color: aqua; border: none; font-size: 24px; cursor: pointer;">×</button>

        <!-- Carousel Starts Here -->
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($popup_ads as $index => $ad): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <a href="<?= htmlspecialchars($ad['target_url']) ?>" target="_blank" rel="noopener noreferrer">
                            <img src="<?= $upload_path . htmlspecialchars($ad['image_path']) ?>" class="img-fluid d-block w-100" alt="Popup Ad">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Carousel Ends -->
    </div>
</div>

<!-- Show modal on mobile -->
<script>
    function closeMobileModal() {
        document.getElementById("mobileModal").style.display = "none";
    }

    document.addEventListener("DOMContentLoaded", function () {
        if (window.innerWidth <= 991) {
            document.getElementById("mobileModal").style.display = "flex";
        }
    });
</script>
<?php endif; ?>
