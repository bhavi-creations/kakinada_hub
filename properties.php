<?php include 'navbar.php';  ?>

 


<?php include 'propertys_sidebar.php'; ?>

<?php
// Fetch distinct types
$typeQuery = "SELECT DISTINCT type FROM properties WHERE type IS NOT NULL AND type != '' ORDER BY type ASC";
$typeResult = mysqli_query($conn, $typeQuery);

// Fetch distinct categories
$categoryQuery = "SELECT DISTINCT category FROM properties WHERE category IS NOT NULL AND category != '' ORDER BY category ASC";
$categoryResult = mysqli_query($conn, $categoryQuery);
?>


<section class="bg_section responsive_section">
    <div class="container ">
        <h1 class="text-center gradient_text_color spacing_for_htag">Find Your Residency by one click</h1>
        <!-- <h5 class="text-center gradient_text_color spacing_for_htag">Find Your Residency By One Click</h5> -->


        <!-- Filters -->
        <div class="row gy-2 my-4 custom-filters  ">
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
                <!-- <input type="text" id="priceInput" class="custom-input" placeholder="Search by price..." onkeyup="filterProperties()"> -->
                <input type="text" id="priceInput" class="custom-input" placeholder="Filter by price..." readonly onclick="openPriceModal()">




            </div>

            <div class="col-12 col-md-1">
                <button class="btn btn-outline-secondary w-100 custom-reset" onclick="resetFilters()">Reset</button>
            </div>
        </div>


        <div class="row">


            <div class="col-lg-2  col-12 text_side_div d-none d-lg-block">
                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid side_dive_images">
                <img src="assets/img/test/animation.gif" alt="Animated GIF" class=" my-4 side_dive_images">
                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid  side_dive_images">
            </div>


            <div class="col-lg-8 col-12">

                <div class="row   scrollable-list">
                    <?php
                    $query = "SELECT * FROM properties ORDER BY id DESC";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)):
                        $propertyType = trim($row['type']);
                        $propertyCategory = trim($row['category']);
                        $numericPrice = isset($row['price']) ? (int) preg_replace('/[^\d]/', '', $row['price']) : '';
                    ?>

                        <section class="OfferContainer_exclusive__non   my-2 property-item"

                            data-type="<?php echo strtolower($propertyType); ?>"
                            data-category="<?php echo strtolower($propertyCategory); ?>"
                            data-price="<?php echo $numericPrice; ?>">

                            <div class="container card_div">
                                <div class="row need_padding_div">
                                    <div class="col-12 col-md-3 job_image_card_main mb-2 parent-container">
                                        <img src="./admin/uploads/properties/<?php echo $row['image']; ?>" class="img-fluid company_logo_size inner_image_card_job" alt="Property Image">
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <h4 class="gradient_text_color"><?php echo $row['title']; ?></h4>
                                        <p class="property_p_tag"><strong class="property_strong">Price:</strong> ₹<?php echo number_format($numericPrice); ?></p>
                                        <p class="property_p_tag"><strong class="property_strong">Location:</strong> <?php echo $row['location']; ?></p>
                                        <p class="property_p_tag"><strong class="property_strong">Posted On:</strong> <?php echo date('d M Y', strtotime($row['created_at'])); ?></p>
                                        <p class="rent_tag <?php echo strtolower(str_replace(' ', '-', $propertyType)); ?>"><?php echo $propertyType; ?></p>
                                    </div>
                                </div>

                                <div class="col-12 terms_cond_styles">
                                    <div class="terms_justify">
                                        <p class="gradient_text_color"><a href="property_details.php?id=<?php echo $row['id']; ?>">View Full Details</a></p>
                                    </div>
                                </div>
                            </div>
                        </section>

                    <?php endwhile; ?>

                </div>

                <!-- JavaScript Filtering -->
                <script>
                    function normalizePrice(priceText) {
                        return priceText.replace(/[₹,\s]/g, '').trim();
                    }

                    function getFilterValue(id1, id2) {
                        const el1 = document.getElementById(id1);
                        const el2 = document.getElementById(id2);
                        return (el1 && el1.value) ? el1.value.toLowerCase() :
                            (el2 && el2.value) ? el2.value.toLowerCase() : '';
                    }


                    function filterProperties() {
                        const typeValue = getFilterValue('typeFilter', 'typeFilterSidebar');
                        const categoryValue = getFilterValue('categoryFilter', 'categoryFilterSidebar');
                        const searchText = getFilterValue('searchInput', 'searchInputSidebar');
                        const priceInput = normalizePrice(getFilterValue('priceInput', 'priceInputSidebar'));


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

                            card.style.display = (matchesType && matchesCategory && matchesSearch && matchesPrice) ? '' : 'none';
                        });
                    }



                    function resetFilters() {
                        ['typeFilter', 'typeFilterSidebar', 'categoryFilter', 'categoryFilterSidebar', 'searchInput', 'searchInputSidebar', 'priceInput', 'priceInputSidebar'].forEach(id => {
                            const el = document.getElementById(id);
                            if (el) el.value = '';
                        });

                        filterProperties();
                    }
                </script>

            </div>

            <!-- Sidebar (for desktop) -->
            <div class="col-lg-2  col-12 text_side_div d-none d-lg-block">
                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid side_dive_images">
                <img src="assets/img/test/animation.gif" alt="Animated GIF" class=" my-4 side_dive_images">
                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid  side_dive_images">
            </div>





        </div>

    </div>



    <div class="modal fade" id="priceFilterModal" tabindex="-1" aria-labelledby="priceFilterLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 filter_section">
                <div class="modal-header">
                    <h5 class="modal-title" id="priceFilterLabel">Filter by Price</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="minPrice">Min Price</label>
                    <input type="number" id="minPrice" class="form-control coustom-input  mb-2">

                    <label for="maxPrice">Max Price</label>
                    <input type="number" id="maxPrice" class="form-control coustom-input mb-3">

                    <button class="btn btn-primary w-100" onclick="applyPriceFilter()">Apply Filter</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function openPriceModal() {
            const modal = new bootstrap.Modal(document.getElementById('priceFilterModal'));
            modal.show();
        }

        function applyPriceFilter() {
            const min = parseInt(document.getElementById('minPrice').value) || 0;
            const max = parseInt(document.getElementById('maxPrice').value) || Number.MAX_SAFE_INTEGER;

            document.getElementById('priceInput').value = `₹${min} - ₹${max}`;

            const cards = document.querySelectorAll('.property-item');
            cards.forEach(card => {
                const price = parseInt(card.getAttribute('data-price'));
                card.style.display = (price >= min && price <= max) ? '' : 'none';
            });

            const modal = bootstrap.Modal.getInstance(document.getElementById('priceFilterModal'));
            modal.hide();
        }
    </script>





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

</section>



<?php include 'chat_bot.php';  ?>

<?php include 'footer.php';  ?>