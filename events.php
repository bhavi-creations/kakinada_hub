<?php
include './db.connection/db_connection.php'; // Include your database connection file

// Retrieve service filter from GET request
$service = isset($_GET['service']) ? $_GET['service'] : '';

// Prepare SQL query with optional service filter
$sql = "SELECT id, title, main_content, main_image, created_at FROM blogs";
if (!empty($service)) {
    $sql .= " WHERE service = ?";
}
$sql .= " ORDER BY created_at DESC";

// Initialize statement
$stmt = $conn->prepare($sql);

// Bind parameters if service is set
if (!empty($service)) {
    $stmt->bind_param("s", $service);
}

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();
?>








<?php include 'navbar.php';  ?>













<section class=" black_bg_body">
    <div class="container  ">

        <div class="text-center   ">
            <h1 class="gradient_text_color">Upcomming Events</h1>
        </div>
        <div class="row">

            <div class="col-lg-2  col-12 text_side_div d-none d-lg-block">

                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid side_dive_images">

                <img src="assets/img/test/animation.gif" alt="Animated GIF" class=" my-4 side_dive_images">

                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid  side_dive_images">
            </div>

            <div class="col-lg-8 col-12 ">
                <div class="row    fadeIn" data-wow-delay="0.3s">



                    <section class="OfferContainer_exclusive__non wow fadeInUp my-2" data-wow-delay="100ms">
                        <div class="   container  card_div ">
                            <div class="row  need_padding_div ">
                                <div class="col-12 col-md-4 job_image_card_main mb-2 parent-container">
                                    <img src="assets/img/self_images/spandhana.jpeg" class="img-fluid inner_image_card_job" alt="">

                                </div>

                                <div class="col-12 col-md-8">
                                    <h4 class="gradient_text_color"> <strong class="property_strong"> occasion :</strong>Ugadhi</h4>
                                    <p class="property_p_tag"><strong class="property_strong"> Venue :</strong> Spandhana </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Location : </strong> Kakinada </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Phone :</strong>9642343434 </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Website :</strong><a target="_blank" href="https://bhavicreationspvtltd.com/"> https://Spandhnaevents.com/ </a> </p>


                                </div>




                                <div class="col-12 terms_cond_styles">
                                    <div class="terms_justify">

                                        <p class="gradient_text_color">
                                            <a href="event_full_page.php" class=" ">View More Details</a>
                                        </p>
                                    </div>



                                </div>
                            </div>

                        </div>
                    </section>

                    <section class="OfferContainer_exclusive__non wow fadeInUp my-2" data-wow-delay="100ms">
                        <div class="   container  card_div ">
                            <div class="row  need_padding_div ">
                                <div class="col-12 col-md-4 job_image_card_main mb-2 parent-container">
                                    <img src="assets/img/self_images/spandhana.jpeg" class="img-fluid inner_image_card_job" alt="">

                                </div>

                                <div class="col-12 col-md-8">
                                    <h4 class="gradient_text_color"> <strong class="property_strong"> occasion :</strong>Ugadhi</h4>
                                    <p class="property_p_tag"><strong class="property_strong"> Venue :</strong> Spandhana </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Location : </strong> Kakinada </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Phone :</strong>9642343434 </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Website :</strong><a target="_blank" href="https://bhavicreationspvtltd.com/"> https://Spandhnaevents.com/ </a> </p>


                                </div>




                                <div class="col-12 terms_cond_styles">
                                    <div class="terms_justify">

                                        <p class="gradient_text_color">
                                            <a href="event_full_page.php" class=" ">View More Details</a>
                                        </p>
                                    </div>



                                </div>
                            </div>

                        </div>
                    </section>

                    v<section class="OfferContainer_exclusive__non wow fadeInUp my-2" data-wow-delay="100ms">
                        <div class="   container  card_div ">
                            <div class="row  need_padding_div ">
                                <div class="col-12 col-md-4 job_image_card_main mb-2 parent-container">
                                    <img src="assets/img/self_images/spandhana.jpeg" class="img-fluid inner_image_card_job" alt="">

                                </div>

                                <div class="col-12 col-md-8">
                                    <h4 class="gradient_text_color"> <strong class="property_strong"> occasion :</strong>Ugadhi</h4>
                                    <p class="property_p_tag"><strong class="property_strong"> Venue :</strong> Spandhana </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Location : </strong> Kakinada </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Phone :</strong>9642343434 </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Website :</strong><a target="_blank" href="https://bhavicreationspvtltd.com/"> https://Spandhnaevents.com/ </a> </p>


                                </div>




                                <div class="col-12 terms_cond_styles">
                                    <div class="terms_justify">

                                        <p class="gradient_text_color">
                                            <a href="event_full_page.php" class=" ">View More Details</a>
                                        </p>
                                    </div>



                                </div>
                            </div>

                        </div>
                    </section>


                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            document.querySelectorAll(".toggle-terms").forEach(function(link) {
                                link.addEventListener("click", function(event) {
                                    event.preventDefault(); // Prevent default anchor behavior

                                    var parentDiv = this.closest(".col-12");
                                    var termsDiv = parentDiv.querySelector(".terms-content");
                                    var separator = parentDiv.querySelector(".terms-separator");

                                    // Toggle visibility
                                    if (termsDiv.style.display === "none" || termsDiv.style.display === "") {
                                        termsDiv.style.display = "block";
                                        separator.style.display = "block"; // Show the separator
                                    } else {
                                        termsDiv.style.display = "none";
                                        separator.style.display = "none"; // Hide the separator
                                    }
                                });
                            });
                        });
                    </script>



                </div>

            </div>

            <div class="col-lg-2  col-12 text_side_div d-none d-lg-block">

                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid side_dive_images">

                <img src="assets/img/test/animation.gif" alt="Animated GIF" class=" my-4 side_dive_images">

                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid  side_dive_images">
            </div>

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









<script>
    let currentSlide = 0;

    function slideImages() {
        const slides = document.querySelectorAll('.custom-slide');
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }
    setInterval(slideImages, 3000); // Auto-slide every 3 seconds
</script>

<script>
    function toggleText(element) {
        let hiddenText = element.previousElementSibling.querySelector(".hidden-text");
        if (hiddenText.style.display === "none" || hiddenText.style.display === "") {
            hiddenText.style.display = "inline";
            element.innerText = "Read Less";
        } else {
            hiddenText.style.display = "none";
            element.innerText = "Read More";
        }
    }

    function toggleImages(element) {
        let imagesDiv = element.nextElementSibling;
        if (imagesDiv.style.display === "none" || imagesDiv.style.display === "") {
            imagesDiv.style.display = "flex";
            element.innerText = "Hide Images";
        } else {
            imagesDiv.style.display = "none";
            element.innerText = "View Images";
        }
    }

    function openLightbox(image) {
        let lightbox = document.getElementById("lightbox");
        let lightboxImg = document.getElementById("lightbox-img");
        lightboxImg.src = image.src;
        lightbox.style.display = "flex";
    }

    function closeLightbox() {
        document.getElementById("lightbox").style.display = "none";
    }
</script>

<?php include 'chat_bot.php';  ?>


<?php include 'footer.php';  ?>