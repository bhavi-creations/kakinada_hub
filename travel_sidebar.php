<?php
include 'db.connection/db_connection.php';

// Fetch travel destinations from database
$travelQuery = "SELECT id, name FROM travels ORDER BY name ASC";
$travelResult = mysqli_query($conn, $travelQuery);

// Store travel data in an array for JavaScript
$travelDestinations = [];
while ($row = mysqli_fetch_assoc($travelResult)) {
    $travelDestinations[] = $row;
}

// Encode travel data as JSON for JavaScript use
$travelJSON = json_encode($travelDestinations);
?>

<!-- Sidebar Structure -->
<div id="overlay" class="overlay"></div>
<button id="sidebar-icon" class="sidebar-icon">🚗</button>
<div id="sidebar" class="sidebar side_view">
    <h1 class="side_bar_tittle">Travel Destinations 🚗</h1>
    <ul id="travel-list" class="service-list"></ul>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarIcon = document.getElementById("sidebar-icon");
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");

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

        // Fetch travel destinations from PHP JSON output
        const travelDestinations = <?php echo $travelJSON; ?>;
        const travelList = document.getElementById("travel-list");

        travelDestinations.forEach(travel => {
            const listItem = document.createElement("li");
            const link = document.createElement("a");
            link.href = "travel_details.php?id=" + travel.id;
            link.rel = "noopener noreferrer";
            link.textContent = travel.name;
            listItem.appendChild(link);
            travelList.appendChild(listItem);
        });
    });
</script>
