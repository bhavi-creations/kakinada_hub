<?php include 'navbar.php'; ?>
<?php include './db.connection/db_connection.php'; ?>

<?php include 'propertys_sidebar.php'; ?>

<?php
// Fetch distinct types
$typeQuery = "SELECT DISTINCT type FROM properties WHERE type IS NOT NULL AND type != '' ORDER BY type ASC";
$typeResult = mysqli_query($conn, $typeQuery);

// Fetch distinct categories
$categoryQuery = "SELECT DISTINCT category FROM properties WHERE category IS NOT NULL AND category != '' ORDER BY category ASC";
$categoryResult = mysqli_query($conn, $categoryQuery);
?>

<section class=" ">
    <div class="container">

        <div class="text-center">
            <h1 class="gradient_text_color">List Of Properties</h1>
            <h5 class="gradient_text_color">Find Your Residency By One Click</h5>
        </div>

        <!-- Filters -->
        <div class="row gy-2 my-4 custom-filters">
            <div class="col-12 col-md-3">
                <select id="typeFilter" class="custom-input" onchange="filterProperties()">
                    <option value="">All Types</option>
                    <option value="rent">Rent</option>
                    <option value="sale">Sale</option>
                    <option value="lease">Lease</option>
                </select>
            </div>

            <div class="col-12 col-md-3">
                <select id="categoryFilter" class="custom-input" onchange="filterProperties()">
                    <option value="">All Categories</option>
                    <option value="commercial">Commercial</option>
                    <option value="residential">Residential</option>
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
            <!-- Sidebar Left -->
            <div class="col-lg-2  col-12 text_side_div d-none d-lg-block">
                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid side_dive_images">
                <img src="assets/img/test/animation.gif" alt="Animated GIF" class=" my-4 side_dive_images">
                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid  side_dive_images">
            </div>

            <!-- Properties List -->
            <div class="col-lg-8 col-12">
                <div class="row fadeIn property_cotent" data-wow-delay="0.3s">
                    <section class="OfferContainer_exclusive__non wow fadeInUp my-2" data-wow-delay="100ms">

                        <!-- Scrollable Container Starts -->
                        <div style="max-height: 1000px; overflow-y: scroll; overflow-x: hidden; padding: 10px;" class="custom-scrollbar">
                            <div class="row" id="property-list">
                                <?php
                                $query = "SELECT * FROM properties ORDER BY id DESC";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)):
                                    $propertyType = strtolower(trim($row['type']));
                                    $propertyCategory = strtolower(trim($row['category']));
                                    $title = strtolower($row['title']);
                                    $location = strtolower($row['location']);
                                    $numericPrice = isset($row['price']) ? (int) preg_replace('/[^\d]/', '', $row['price']) : '';
                                ?>
                                    <div class="col-12 mb-4 property-box"
                                        data-type="<?= $propertyType ?>"
                                        data-category="<?= $propertyCategory ?>"
                                        data-title="<?= $title ?>"
                                        data-location="<?= $location ?>"
                                        data-price="<?= $numericPrice ?>">


                                        <div class="  card_div property-item position-relative">
                                            <div class="row gy-3 property_card_div align-items-start  ">

                                                <!-- Image -->
                                                <div class="col-12 col-md-3 job_image_card_main  ">

                                                    <img src="./admin/uploads/properties/<?php echo $row['image']; ?>"
                                                        class="img-fluid  company_logo_size inner_image_card_job"

                                                        alt="Property Image">

                                                </div>

                                                <!-- Info -->
                                                <div class="col-12 col-md-9" style="padding-left: 15px;">
                                                    <h5 class="heading-gradient"><?php echo $row['title']; ?></h5>
                                                    <p class="mb-1 p-gradient"><strong>Price:</strong> ₹<?php echo number_format($numericPrice); ?></p>
                                                    <p class="mb-1 p-gradient"><strong>Location:</strong> <?php echo $row['location']; ?></p>
                                                    <p class="mb-1 p-gradient"><strong>Posted On:</strong>
                                                        <?php echo isset($row['created_at']) ? date('d M Y', strtotime($row['created_at'])) : 'Not Available'; ?>
                                                    </p>
                                                    <p class="mb-2 text-muted  property_type_color"><?php echo ucfirst($propertyType); ?></p>
                                                </div>
                                            </div>

                                            <div class="position-absolute" style="bottom: 10px; right: 15px;">
                                                <a href="property_details.php?id=<?php echo $row['id']; ?>" class="no-hover-link  p-gradient">View Full Details</a>
                                                <!-- <a href="property_details.php?id=<?php echo $row['id']; ?>">View Full Details</a> -->
                                            </div>
                                        </div>

                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>properties.php
                        <!-- Scrollable Container Ends -->

                    </section>
                </div>
            </div>



            <!-- Sidebar Right -->
            <div class="col-lg-2 col-12 text_side_div d-none d-lg-block">
                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid side_dive_images">
                <img src="assets/img/test/animation.gif" alt="Animated GIF" class=" my-4 side_dive_images">
                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid  side_dive_images">
            </div>

            
        </div>
    </div>

    <!-- Mobile Sidebar -->
    <div id="mobileModal" class="mobile-modal-overlay">
        <div class="mobile-modal-content">
            <button class="close-btn" onclick="closeMobileModal()">×</button>
            <div class="col-12 text_side_div">
                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid">
            </div>
        </div>
    </div>

    <!-- JavaScript Filter -->
    <script>
        function normalizeText(text) {
            return text.toLowerCase().replace(/[₹,\s]/g, '').trim();
        }

        function filterProperties() {
            const type = normalizeText(document.getElementById('typeFilter').value);
            const category = normalizeText(document.getElementById('categoryFilter').value);
            const search = normalizeText(document.getElementById('searchInput').value);
            const price = normalizeText(document.getElementById('priceInput').value);

            document.querySelectorAll('.property-box').forEach(card => {
                const cardType = card.getAttribute('data-type') || '';
                const cardCategory = card.getAttribute('data-category') || '';
                const cardTitle = card.getAttribute('data-title') || '';
                const cardLocation = card.getAttribute('data-location') || '';
                const cardPrice = card.getAttribute('data-price') || '';

                const matchType = !type || cardType.includes(type);
                const matchCategory = !category || cardCategory.includes(category);
                const matchSearch = !search || cardTitle.includes(search) || cardLocation.includes(search);
                const matchPrice = !price || cardPrice.includes(price);

                card.style.display = (matchType && matchCategory && matchSearch && matchPrice) ? 'block' : 'none';
            });
        }

        function resetFilters() {
            document.getElementById('typeFilter').value = '';
            document.getElementById('categoryFilter').value = '';
            document.getElementById('searchInput').value = '';
            document.getElementById('priceInput').value = '';
            filterProperties();
        }

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