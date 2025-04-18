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

            <div class="col-lg-2  col-12 text_side_div d-none d-lg-block">
                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid side_dive_images">
                <img src="assets/img/test/animation.gif" alt="Animated GIF" class=" my-4 side_dive_images">
                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid  side_dive_images">
            </div>






            <div class="col-lg-8 col-12 ">

                <div class="row px-4">

                    <div class=" col-12 order-1 order-md-0 my-4">
                        <div class="row fadeIn" data-wow-delay="0.3s">
                            <section class="OfferContainer_exclusive__non wow fadeInUp my-2" data-wow-delay="100ms">
                                <div class="col-12 card_div  ">
                                    <div class="row p-3">
                                        <h4 class="  text-center property_title_sace  heading-gradient"><i class="fas fa-home"></i> <?php echo htmlspecialchars($property['title']); ?></h4>



                                        <div class="col-12 col-md-6 propertys_divs_for_text_paras">
                                            <p class="property_p_tag">
                                                <strong class="property_strong">💰 Price:</strong>
                                                ₹<?php echo number_format($property['price']); ?>
                                            </p>
                                        </div>
                                        <!-- <div class="col-12 col-md-6 propertys_divs_for_text_paras">
                                            <p class="property_p_tag">
                                                <strong class="property_strong">📍 Location:</strong>
                                                <?php echo htmlspecialchars($property['location']); ?>
                                            </p>
                                        </div> -->
                                        <div class="col-12 col-md-6 propertys_divs_for_text_paras">
                                            <p class="property_p_tag">
                                                <strong class="property_strong">📏 Area (Sqft):</strong>
                                                <?php echo htmlspecialchars($property['size_sqft']); ?>
                                            </p>
                                        </div>

                                        <div class="col-12 col-md-6 propertys_divs_for_text_paras">

                                            <p class="property_p_tag">
                                                <strong class="property_strong">🛏 Bed Rooms:</strong>
                                                <?php echo htmlspecialchars($property['bedrooms']); ?>
                                            </p>
                                        </div>

                                        <div class="col-12 col-md-6 propertys_divs_for_text_paras">

                                            <p class="property_p_tag">
                                                <strong class="property_strong">🛁 Bath Rooms:</strong>
                                                <?php echo htmlspecialchars($property['bathrooms']); ?>
                                            </p>
                                        </div>

                                        <div class="col-12 col-md-6 propertys_divs_for_text_paras">

                                            <p class="property_p_tag">
                                                <strong class="property_strong">🪑 Furnishing Status:</strong>
                                                <?php echo htmlspecialchars($property['furnishing_status']); ?>
                                            </p>
                                        </div>

                                        <div class="col-12 col-md-6 propertys_divs_for_text_paras">

                                            <p class="property_p_tag">
                                                <strong class="property_strong">🛠 Amenities:</strong>
                                                <?php echo htmlspecialchars($property['amenities']); ?> Available
                                            </p>
                                        </div>

                                        <div class="col-12 col-md-6 propertys_divs_for_text_paras">

                                            <p class="property_p_tag">
                                                <strong class="property_strong">📅 Posted On:</strong>
                                                <?php
                                                $created_at = isset($property['created_at']) ? strtotime($property['created_at']) : null;
                                                echo $created_at ? date('d M Y', $created_at) . ' (' . date('H:i', $created_at) . ')' : 'Not Available';
                                                ?>
                                            </p>
                                        </div>

                                        <div class="col-12 col-md-6 propertys_divs_for_text_paras">

                                            <p class="property_p_tag">
                                                <strong class="property_strong">📞 Contact Person:</strong>
                                                <?php echo htmlspecialchars($property['phone']); ?> /
                                                <?php echo htmlspecialchars($property['location']); ?>
                                            </p>
                                        </div>


                                    </div>
                                </div>

                            </section>
                        </div>

                    </div>

                    <div class="  col-12 text-center order-0 order-md-1">
                        <div class="container  text_side_div ">

                            <div class="image-gallery">
                                <!-- Main Image Carousel -->
                                <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                                    <div class="carousel-inner ">
                                        <?php
                                        if (!empty($images)) {
                                            foreach ($images as $index => $image) {
                                                $image = trim($image); // Ensure clean filenames
                                                $activeClass = ($index === 0) ? "active" : "";
                                                echo "
                                    <div class='carousel-item $activeClass '>
                                        <img src='./admin/uploads/properties/$image' class='d-block w-100' alt='Property Image'>
                                    </div>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>

                                <!-- Thumbnails Row -->
                                <div class="thumbnail-gallery mt-3">
                                    <div class="row gx-2">
                                        <?php
                                        if (!empty($images)) {
                                            foreach ($images as $index => $image) {
                                                $image = trim($image); // Remove extra spaces
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

                        </div>


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
                    </div>
                </div>
                <div class="col-12 col-md-6"></div>
                <div class="col-12 col-md-6"></div>

            </div>


            <div class="col-lg-2  col-12 text_side_div d-none d-lg-block">
                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid side_dive_images">
                <img src="assets/img/test/animation.gif" alt="Animated GIF" class=" my-4 side_dive_images">
                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid  side_dive_images">
            </div>





        </div>
    </div>
</section>

<?php include 'footer.php'; ?>







