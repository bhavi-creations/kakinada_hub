<?php
// ads.php (This single file handles default ad display)

// Function to fetch and display default ads (carousel)
function display_default_ads($conn) {
    // Define the base path for the uploaded images
    $upload_path = './admin/uploads/side_piller_ads/';

    // Get the current page name
    $current_page = basename($_SERVER['PHP_SELF'], '.php');

    // --- Default Ads (Carousel) ---
    $default_ads_query = mysqli_query($conn, "SELECT image_path, target_url FROM side_piller_ads WHERE ad_side = 'default' AND (page_name = '$current_page' OR page_name IS NULL OR page_name = '') AND status = 'active' ORDER BY created_at DESC");
    $default_ads = [];
    while ($row = mysqli_fetch_assoc($default_ads_query)) {
        $default_ads[] = $row;
    }

    if (!empty($default_ads)) {
        echo '<div id="carouselExampleSlidesOnly" class="carousel slide py-5" data-bs-ride="carousel">';
        echo '<div class="carousel-inner">';
        $i = 0;
        foreach ($default_ads as $ad) {
            $activeClass = ($i == 0) ? 'active' : '';
            echo '<div class="carousel-item ' . $activeClass . '">';
            echo '<a href="' . htmlspecialchars($ad['target_url']) . '" target="_blank" rel="noopener noreferrer">';
            echo '<img src="' . $upload_path . htmlspecialchars($ad['image_path']) . '" class="img-fluid d-block w-100" alt="Ad for ' . $current_page . '">';
            echo '</a>';
            echo '</div>';
            $i++;
        }
        echo '</div>';
        echo '</div>';
    } else {
        echo '';
    }
}

// Establish database connection (if not already established)
// include './db.connection/db_connection.php';  <--  Remove this line, and make sure the connection is established *before* including this file

// Call the function to display the default ads
display_default_ads($conn);
?>
