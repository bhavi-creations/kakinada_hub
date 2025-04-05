<?php include 'navbar.php'; ?>
<?php include './db.connection/db_connection.php';?>

<?php include 'propertys_sidebar.php'; ?>

<?php
// Fetch distinct types
$typeQuery = "SELECT DISTINCT type FROM properties WHERE type IS NOT NULL AND type != '' ORDER BY type ASC";
$typeResult = mysqli_query($conn, $typeQuery);

// Fetch distinct categories
$categoryQuery = "SELECT DISTINCT category FROM properties WHERE category IS NOT NULL AND category != '' ORDER BY category ASC";
$categoryResult = mysqli_query($conn, $categoryQuery);
?>

<section>
    <div class="container">

        <div class="text-center">
            <h1>List Of Properties</h1>
            <h5>Find Your Residency By One Click</h5>
        </div>


        <!-- Filters -->
        <div class="row gy-2 my-4 custom-filters">
            <div class="col-12 col-md-3">
                <select id="typeFilter" class="custom-input" onchange="filterProperties()">
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

            <div class="col-12 col-md-3">
                <select id="categoryFilter" class="custom-input" onchange="filterProperties()">
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

            <div class="col-12 col-md-3">
                <input type="text" id="searchInput" class="custom-input" placeholder="Search by title or location..." onkeyup="filterProperties()">
            </div>

            <div class="col-12 col-md-2">
                <input type="text" id="priceInput" class="custom-input" placeholder="Search by price..." onkeyup="filterProperties()">
            </div>

            <div class="col-12 col-md-1">
                <button class="btn btn-outline-secondary w-100 custom-reset" onclick="resetFilters()">Reset</button>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-9 col-12">



                <!-- Property List -->
                <div class="row fadeIn" data-wow-delay="0.3s">
                    <section class="OfferContainer_exclusive__non wow fadeInUp my-2" data-wow-delay="100ms">
                        <div class="row" id="property-list">
                            <?php
                            $query = "SELECT * FROM properties ORDER BY id DESC";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)):
                                $propertyType = trim($row['type']);
                                $propertyCategory = trim($row['category']);
                                $numericPrice = isset($row['price']) ? (int) preg_replace('/[^\d]/', '', $row['price']) : '';
                            ?>
                                <div class="col-12 card_div px-3 property-item"
                                    data-type="<?php echo $propertyType; ?>"
                                    data-category="<?php echo $propertyCategory; ?>"
                                    data-price="<?php echo $numericPrice; ?>">

                                    <div class="row py-3">
                                        <div class="col-12 col-md-3 job_image_card">
                                            <img src="./admin/uploads/properties/<?php echo $row['image']; ?>" class="img-fluid company_logo_size" alt="Property Image">
                                        </div>
                                        <div class="col-8 col-md-9">
                                            <h4><?php echo $row['title']; ?></h4>
                                            <p class="property_p_tag">
                                                <strong class="property_strong">Price:</strong>
                                                <?php echo $numericPrice ? '₹' . number_format($numericPrice) : 'Not Provided'; ?>
                                            </p>
                                            <p class="property_p_tag"><strong class="property_strong">Location:</strong> <?php echo $row['location']; ?></p>
                                            <p class="property_p_tag">
                                                <strong class="property_strong">Posted On:</strong>
                                                <?php echo isset($row['created_at']) ? date('d M Y', strtotime($row['created_at'])) : 'Not Available'; ?>
                                            </p>
                                            <p class="rent_tag <?php echo strtolower(str_replace(' ', '-', $propertyType)); ?>">
                                                <?php echo $propertyType; ?>
                                            </p>
                                        </div>
                                        <div class="col-12 terms_cond_styles">
                                            <div class="terms_justify">
                                                <p><a href="property_details.php?id=<?php echo $row['id']; ?>">View Full Details</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </section>
                </div>

                <!-- JavaScript Filtering -->
                <script>
                    function normalizePrice(priceText) {
                        return priceText.replace(/[₹,\s]/g, '').trim();
                    }

                    function filterProperties() {
                        const typeValue = document.getElementById('typeFilter').value.toLowerCase();
                        const categoryValue = document.getElementById('categoryFilter').value.toLowerCase();
                        const searchText = document.getElementById('searchInput').value.toLowerCase();
                        const priceInput = normalizePrice(document.getElementById('priceInput').value);

                        const cards = document.querySelectorAll('.property-item');

                        cards.forEach(card => {
                            const type = card.getAttribute('data-type').toLowerCase();
                            const category = card.getAttribute('data-category').toLowerCase();
                            const price = card.getAttribute('data-price') || '';
                            const title = card.querySelector('h4')?.textContent.toLowerCase() || '';
                            const location = card.querySelector('p.property_p_tag:nth-of-type(2)')?.textContent.toLowerCase() || '';

                            const matchesType = !typeValue || type === typeValue;
                            const matchesCategory = !categoryValue || category === categoryValue;
                            const matchesSearch = !searchText || title.includes(searchText) || location.includes(searchText);
                            const matchesPrice = !priceInput || price.includes(priceInput);

                            if (matchesType && matchesCategory && matchesSearch && matchesPrice) {
                                card.style.display = '';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    }

                    function resetFilters() {
                        document.getElementById('typeFilter').value = '';
                        document.getElementById('categoryFilter').value = '';
                        document.getElementById('searchInput').value = '';
                        document.getElementById('priceInput').value = '';
                        filterProperties();
                    }
                </script>

            </div>

            <!-- Sidebar (for desktop) -->
            <div class="col-lg-3 col-12 text_side_div d-none d-lg-block">
                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid">
                <img src="assets/img/test/animation.gif" alt="Animated GIF" class="mt-5">
                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid mt-5">
            </div>

            <!-- Sidebar modal (for mobile) -->
            <div id="mobileModal" class="mobile-modal-overlay">
                <div class="mobile-modal-content">
                    <button class="close-btn" onclick="closeMobileModal()">×</button>
                    <div class="col-12 text_side_div">
                        <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>

            <script>
                function closeMobileModal() {
                    document.getElementById("mobileModal").style.display = "none";
                }

                document.addEventListener("DOMContentLoaded", function() {
                    if (window.innerWidth <= 991) {
                        document.getElementById("mobileModal").style.display = "flex";
                    }
                });
            </script>




        </div>
    </div>
</section>