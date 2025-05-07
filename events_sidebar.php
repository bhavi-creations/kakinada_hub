<?php
// Make sure your DB connection ($conn) is available before this
$eventQuery = "SELECT id, venue FROM events ORDER BY event_date DESC";
$eventResult = mysqli_query($conn, $eventQuery);

$events = [];
while ($row = mysqli_fetch_assoc($eventResult)) {
    $events[] = $row;
}
?>

<!-- Sidebar Structure for Events -->
<div id="event-overlay" class="overlay"></div>
<button id="event-sidebar-icon" class="sidebar-icon">🎉</button>

<div id="event-sidebar" class="sidebar side_view">
    <!-- Title -->
    <h1 class="side_bar_tittle">
        <a href="events.php">Events 🎉</a>
    </h1>

    <!-- Scrollable list -->
    <ul class="service-list scroll_foe_restrents">
        <?php foreach ($events as $event): ?>
            <li>
                <a class="sub_mini_serices" href="event_full_page.php?id=<?= $event['id'] ?>">
                    <?= htmlspecialchars($event['venue']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebarIcon = document.getElementById("event-sidebar-icon");
        const sidebar = document.getElementById("event-sidebar");
        const overlay = document.getElementById("event-overlay");

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
