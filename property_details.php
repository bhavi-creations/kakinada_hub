<?php
include 'navbar.php';

include './db.connection/db_connection.php';

if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    // Fetch property details
    $query = "SELECT * FROM properties WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $property = $result->fetch_assoc();

    if (!$property) {
        echo "<h2 class='text-center'>Property not found</h2>";
        exit;
    }

    // Fetch images correctly
    $images = array(); // Initialize empty array to store images
    if (!empty($property['images'])) {
        $images = array_filter(explode(',', $property['images'])); // Convert to array and remove empty values
    }
} else {
    echo "<h2 class='text-center'>Invalid Property</h2>";
    exit;
}

?>
<a href="properties.php">
    <button id="restaurant-icon" class="restaurant-icon">🔙</button>
</a>




<section class="bg_section responsive_section">
    <div class="container ">
        <h1 class="text-center gradient_text_color spacing_for_htag"><?php echo htmlspecialchars($property['category']); ?> - <?php echo htmlspecialchars($property['type']); ?></h1>



        <div class="row">

            <?php include 'left_side_ads.php'; ?>



            <div class="col-lg-8 col-12 text_side_div   px-3" style="min-height: 400px;">





                <div class="row gx-4 property_wrapper_v2_section">
                    <!-- Left Side: Image + Description -->
                    <div class="col-12 col-md-6 left_col_section position-relative">
                        <div class="propeerty_section_details mt-2">
                            📅 Posted On:
                            <?php
                            $created_at = isset($property['created_at']) ? strtotime($property['created_at']) : null;
                            echo $created_at ? date('d M Y', $created_at) . ' (' . date('H:i', $created_at) . ')' : 'Not Available';
                            ?>
                        </div>

                        <!-- Image Gallery -->
                        <div class="image-gallery mt-3">
                            <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                                <div class="carousel_inner_section">
                                    <?php
                                    if (!empty($images)) {
                                        foreach ($images as $index => $image) {
                                            $image = trim($image);
                                            $activeClass = ($index === 0) ? "active" : "";
                                            echo "
                            <div class='carousel-item $activeClass'>
                                <img src='./admin/uploads/properties/$image' class='d-block w-100' alt='Property Image'>
                            </div>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <!-- Thumbnail Gallery -->
                            <div class="thumbnail_gallery_section mt-3">
                                <div class="row gx-2">
                                    <?php
                                    if (!empty($images)) {
                                        foreach ($images as $index => $image) {
                                            $image = trim($image);
                                            $activeClass = ($index === 0) ? "active-thumb" : "";
                                            echo "
                            <div class='col-3'>
                                <img src='./admin/uploads/properties/$image' class='img-thumbnail thumb $activeClass' data-bs-target='#mainCarousel' data-bs-slide-to='$index'>
                            </div>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal my-4">
                    </div>

                    <!-- Right Side: Property Details -->
                    <div class="col-12 col-md-6 right_col_section">
                        <div class="row fadeIn" data-wow-delay="0.3s">
                            <section class="OfferContainer_exclusive__non wow fadeInUp my-2" data-wow-delay="100ms">
                                <div class="col-12 card_div">
                                    <div class="row p-3">
                                        <h4 class="text-center property_title_sace heading-gradient">
                                            <i class="fas fa-home"></i> <?php echo htmlspecialchars($property['title']); ?>
                                        </h4>

                                        <?php
                                        $details = [
                                            "💰 Price:" => "₹" . number_format($property['price']),
                                            "📏 Area (Sqft):" => $property['size_sqft'],
                                            "🛏 Bed Rooms:" => $property['bedrooms'],
                                            "🛁 Bath Rooms:" => $property['bathrooms'],
                                            "🪑 Furnishing Status:" => $property['furnishing_status'],
                                            "🛠 Amenities:" => $property['amenities'] . " Available",
                                            "📞 Contact :" => htmlspecialchars($property['phone']) . ' / ' . htmlspecialchars($property['location']),
                                        ];
                                        foreach ($details as $label => $value) {
                                            echo "
                            <div class='col-12 propertys_divs_for_text_paras'>
                                <p class='property_p_tag'><strong class='property_strong'>$label</strong> " . htmlspecialchars($value) . "</p>
                            </div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <!-- Description (Full width below both sides) -->
                    <p class="property_p_tag  mt-3">
                        <strong class="property_strong">📝 Description:</strong>
                        <?php echo nl2br(htmlspecialchars($property['description'])); ?>
                    </p>
                </div>





                <?php include 'default_ads.php'; ?>


            </div>







            <!-- Optional JS for Active Thumbnail -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const thumbnails = document.querySelectorAll(".thumb");
                    const carousel = document.getElementById("mainCarousel");

                    function setActiveThumbnail(index) {
                        thumbnails.forEach((thumb, i) => {
                            thumb.classList.toggle("active-thumb", i === index);
                        });
                    }

                    setActiveThumbnail(0);

                    carousel.addEventListener("slid.bs.carousel", function(e) {
                        setActiveThumbnail(e.to);
                    });

                    thumbnails.forEach((thumb, index) => {
                        thumb.addEventListener("click", () => {
                            setActiveThumbnail(index);
                        });
                    });
                });
            </script>

            <!-- Carousel Thumbnail JavaScript -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const thumbnails = document.querySelectorAll(".thumb");
                    const carousel = document.getElementById("mainCarousel");

                    function setActiveThumbnail(index) {
                        thumbnails.forEach((thumb, i) => {
                            thumb.classList.toggle("active-thumb", i === index);
                        });
                    }

                    setActiveThumbnail(0);

                    carousel.addEventListener("slid.bs.carousel", function(e) {
                        setActiveThumbnail(e.to);
                    });

                    thumbnails.forEach((thumb, index) => {
                        thumb.addEventListener("click", () => {
                            setActiveThumbnail(index);
                        });
                    });
                });
            </script>






            <?php include 'right_side_ads.php'; ?>




        </div>
    </div>
</section>

<?php include 'footer.php'; ?>