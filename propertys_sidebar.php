<!-- Sidebar Trigger Button -->
<button id="restaurant-icon" class="restaurant-icon">🏠</button>

<!-- Overlay for Sidebar Close -->
<div id="overlay" class="overlay"></div>

<!-- Sidebar -->
<div id="sidebar" class="sidebar side_view">
    <h2 class="side_bar_tittle"><a href="properties.php"> Properties 🏠</a></h2>

    <!-- Filter Inputs -->
    <div class="filter-group">
        <!-- Type Filter -->
        <!-- Sidebar Filters -->
        <div class="filter-item">
            <label class="properties_lable_sidebar" for="typeFilterSidebar">Type</label>
            <select id="typeFilterSidebar" class="custom-input" onchange="filterProperties()">
                <option value="">All Types</option>
                <?php
                $typeQuery = "SELECT DISTINCT type FROM properties";
                $typeResult = mysqli_query($conn, $typeQuery);
                while ($typeRow = mysqli_fetch_assoc($typeResult)) {
                    echo '<option value="' . htmlspecialchars($typeRow['type']) . '">' . htmlspecialchars($typeRow['type']) . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- Repeat same for category filter -->


        <!-- Category Filter -->
        <div class="filter-item">
            <label class="properties_lable_sidebar" for="categoryFilterSidebar">Category</label>
            <select id="categoryFilterSidebar" class="custom-input" onchange="filterProperties()">
                <option value="">All Categories</option>
                <?php
                $categoryQuery = "SELECT DISTINCT category FROM properties";
                $categoryResult = mysqli_query($conn, $categoryQuery);
                while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                    echo '<option value="' . htmlspecialchars($categoryRow['category']) . '">' . htmlspecialchars($categoryRow['category']) . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- Title/Location Search -->
        <div class="filter-item">
            <label class="properties_lable_sidebar" for="searchInputSidebar">Title / Location</label>
            <input type="text" id="searchInputSidebar" class="custom-input" placeholder="Search..." onkeyup="filterProperties()">
        </div>

        <!-- Price Search -->
        <div class="filter-item">
            <label class="properties_lable_sidebar" for="priceInputSidebar">Price</label>
            <input type="text" id="priceInputSidebar" class="custom-input" placeholder="Search price..." onkeyup="filterProperties()">
        </div>

        <!-- Reset Button -->
        <div class="filter-item">
            <button class="reset-btn-side-bar" onclick="resetFilters()">Reset Filters</button>
        </div>
    </div>

    <!-- List Items (Optional Static Links or Categories) -->
    <ul id="restaurant-list" class="restaurant-list"></ul>
</div>

<!-- JS to Open/Close Sidebar -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");

        document.getElementById("restaurant-icon").addEventListener("click", () => {
            sidebar.classList.add("open");
            overlay.classList.add("active");
        });

        overlay.addEventListener("click", () => {
            sidebar.classList.remove("open");
            overlay.classList.remove("active");
        });



        const list = document.getElementById("restaurant-list");
        restaurants.forEach(item => {
            const li = document.createElement("li");
            const a = document.createElement("a");
            a.href = item.link;
            a.textContent = item.name;
            li.appendChild(a);
            list.appendChild(li);
        });
    });
</script>