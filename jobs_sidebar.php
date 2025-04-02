<?php
include 'db.connection/db_connection.php';

// Fetch companies from database
$companyQuery = "SELECT id, name FROM companies ORDER BY name ASC";
$companyResult = mysqli_query($conn, $companyQuery);

// Store companies in an array for JavaScript
$companies = [];
while ($row = mysqli_fetch_assoc($companyResult)) {
    $companies[] = $row;
}

// Encode companies as JSON for JavaScript use
$companiesJSON = json_encode($companies);
?>

<!-- Sidebar Structure -->
<div id="overlay" class="overlay"></div>
<button id="sidebar-icon" class="sidebar-icon">🏢</button>
<div id="sidebar" class="sidebar side_view">
    <h1 class="side_bar_tittle">Companies 🏢</h1>
    <ul id="company-list" class="service-list"></ul>
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

        // Fetch companies from PHP JSON output
        const companies = <?php echo $companiesJSON; ?>;
        const companyList = document.getElementById("company-list");

        companies.forEach(company => {
            const listItem = document.createElement("li");
            const link = document.createElement("a");
            link.href = "job_full_page.php?company_id=" + company.id;
            link.rel = "noopener noreferrer";
            link.textContent = company.name;
            listItem.appendChild(link);
            companyList.appendChild(listItem);
        });
    });
</script>