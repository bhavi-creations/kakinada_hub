<?php include 'navbar.php';  ?>


 




<div class="container">
    <div class="row">
        <div class="col-12">

            <?php include './db.connection/db_connection.php'; ?>

            <!-- Display Success Message -->
            <?php if (isset($_SESSION['message'])): ?>
                <div id="alert-box" class="alert alert-<?php echo $_SESSION['msg_type']; ?>">
                    <?php echo $_SESSION['message']; ?>
                    <?php unset($_SESSION['message']); ?>
                </div>

                <script>
                    setTimeout(function() {
                        let alertBox = document.getElementById('alert-box');
                        if (alertBox) {
                            alertBox.style.display = 'none';
                        }
                    }, 3000);
                </script>
            <?php endif; ?>



        </div>
    </div>
</div>






<div class="container text-center">

    <!-- Buttons for Larger Screens -->
    <div class="col-12  ">
        <div class="mt-5 text-center">
            <button class="redirect_blog_srivice filter-btn" data-filter="all">All</button>
            <button class="redirect_blog_srivice filter-btn" data-filter="For Sale">For Sale</button>
            <button class="redirect_blog_srivice filter-btn" data-filter="For Rent">For Rent</button>
            <button class="redirect_blog_srivice filter-btn" data-filter="For Lease">For Lease</button>
        </div>
    </div>





    <script>
        $(document).ready(function() {
            function filterProperties(filterValue) {
                $(".property-item").hide(); // Hide all property items

                if (filterValue === "all") {
                    $(".property-item").fadeIn(); // Show all properties if "All" is selected
                } else {
                    $(".property-item").each(function() {
                        if ($(this).data("type").trim() === filterValue) {
                            $(this).fadeIn(); // Show only the matching properties
                        }
                    });
                }
            }

            // Filter when a button is clicked (for large screens)
            $(".filter-btn").click(function() {
                let filterValue = $(this).data("filter");
                filterProperties(filterValue);
            });

            // Filter when a dropdown option is selected (for mobile)
            $(".filter-dropdown").change(function() {
                let filterValue = $(this).val();
                filterProperties(filterValue);
            });
        });
    </script>

</div>






<section>
    <div class="container">

        <div class="text-center   ">
            <h1>List Of Properties</h1>
            <h5>Find Your Residency By One Click</h5>
        </div>
        <div class="row">

            <div class="col-lg-9 col-12 ">
                <div class="row    fadeIn" data-wow-delay="0.3s">


                    <section class="OfferContainer_exclusive__non wow fadeInUp my-2" data-wow-delay="100ms">


                        <div class="row" id="property-list">
                            <?php
                            $query = "SELECT * FROM properties ORDER BY id DESC";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)):
                                $propertyType = trim($row['type']);
                            ?>
                                <div class="col-12 card_div px-3 property-item" data-type="<?php echo $propertyType; ?>">
                                    <div class="row py-3">
                                        <div class="col-12 col-md-3 job_image_card">
                                            <img src="./admin/uploads/properties/<?php echo $row['image']; ?>" class="img-fluid company_logo_size" alt="Property Image">
                                        </div>
                                        <div class="col-8 col-md-9">
                                            <h4><?php echo $row['title']; ?></h4>
                                            <p class="property_p_tag">
                                                <strong class="property_strong">Price:</strong>
                                                <?php
                                                // Check if the price is available and apply number formatting, otherwise show 'Not Provided'
                                                $price = isset($row['price']) ? $row['price'] : null;
                                                echo $price ? '₹' . number_format($price) : 'Not Provided';
                                                ?>
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
                                                <p><a href="property_details.php?id=<?php echo $row['id']; ?>" class=" ">View Full Details</a></p>
                                            </div>
                                            <!-- <div class="terms-content mb-3" style="display: none;">
                                                <h4>Addtional Details</h4>
                                                <p class="property_p_tag"><strong class="property_strong">Phone:</strong> <?php echo $row['phone'] ?: 'Not Available'; ?></p>
                                                <p class="property_p_tag"><strong class="property_strong">Description:</strong> <?php echo nl2br($row['description']); ?></p>
                                                <a href="property_details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Full Details</a>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>


                    </section>


                    <script>
                        document.querySelectorAll('.filter-btn').forEach(button => {
                            button.addEventListener('click', function() {
                                let filter = this.getAttribute('data-filter');
                                document.querySelectorAll('.property-item').forEach(item => {
                                    if (filter === 'all' || item.getAttribute('data-type') === filter) {
                                        item.style.display = 'block';
                                    } else {
                                        item.style.display = 'none';
                                    }
                                });
                            });
                        });
                    </script>


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

            <div class="col-lg-3  col-12 text_side_div d-none d-lg-block">

                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid">

                <img src="assets/img/test/animation.gif" alt="Animated GIF" class="mt-5">

                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid mt-5">
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