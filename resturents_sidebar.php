<?php
$restaurantQuery = "SELECT id, name FROM restaurants ORDER BY name ASC";
$restaurantResult = mysqli_query($conn, $restaurantQuery);

$restaurants = [];
while ($row = mysqli_fetch_assoc($restaurantResult)) {
    $restaurants[] = $row;
}
?>

<!-- Sidebar Structure for Restaurants -->
<div id="restaurant-overlay" class="overlay"></div>
<button id="restaurant-sidebar-icon" class="sidebar-icon">🍽️</button>

<div id="restaurant-sidebar" class="sidebar side_view">
    <!-- Title -->
    <h1 class="side_bar_tittle">
        <a href="resturents.php">Restaurants 🍽️</a>
    </h1>

    <!-- Scrollable list -->
    <ul class="service-list scroll_foe_restrents" >
        <?php foreach ($restaurants as $restaurant): ?>
            <li>
                <a class="sub_mini_serices" href="resturents_layouts.php?id=<?= $restaurant['id'] ?>">
                    <?= htmlspecialchars($restaurant['name']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebarIcon = document.getElementById("restaurant-sidebar-icon");
        const sidebar = document.getElementById("restaurant-sidebar");
        const overlay = document.getElementById("restaurant-overlay");

        function openSidebar() {
            sidebar.classList.add("open");
            overlay.classList.add("active");
        }

        function closeSidebar() {
            sidebar.classList.remove("open");
            overlay.classList.remove("active");
        }

        sidebarIcon.addEventListener("click", openSidebar);
        overlay.addEventListener("click", closeSidebar);
    });
</script>
