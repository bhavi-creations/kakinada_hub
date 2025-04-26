<?php
include 'db.connection/db_connection.php';

// Fetch theaters from database
$theaterQuery = "SELECT id, name FROM theaters ORDER BY name ASC";
$theaterResult = mysqli_query($conn, $theaterQuery);

// Store theaters in an array for JavaScript
$theaters = [];
while ($row = mysqli_fetch_assoc($theaterResult)) {
    $theaters[] = $row;
}

// Encode as JSON
$theatersJSON = json_encode($theaters);
?>

<!-- Sidebar Structure -->
<div id="overlay" class="overlay"></div>
<button id="sidebar-icon" class="sidebar-icon">🎥</button>
<div id="sidebar" class="sidebar side_view">
    <h1 class="side_bar_tittle"><a href="theaters.php">Theaters 🎭</a> </h1>
    <ul id="theater-list" class="service-list"></ul>
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

        // Get theater data from PHP
        const theaters = <?php echo $theatersJSON; ?>;
        const theaterList = document.getElementById("theater-list");

        theaters.forEach(theater => {
            const listItem = document.createElement("li");
            const link = document.createElement("a");
            link.href = "screens.php?theater_id=" + theater.id;
            link.rel = "noopener noreferrer";
            link.textContent = theater.name;
            listItem.appendChild(link);
            theaterList.appendChild(listItem);
        });
    });
</script>
