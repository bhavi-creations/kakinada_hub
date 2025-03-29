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


<div id="overlay" class="overlay"></div>

<button id="restaurant-icon" class="restaurant-icon">🏠</button>

<div id="sidebar" class="sidebar side_view">
    <h1 class="side_bar_tittle">Propertys 🏠</h1>
    <ul id="restaurant-list" class="restaurant-list"></ul>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const restaurantIcon = document.getElementById("restaurant-icon");
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

        restaurantIcon.addEventListener("click", openSidebar);
        overlay.addEventListener("click", closeSidebar);
    });

    const restaurants = [{
            name: "House Rent",
            link: "#"
        },
        {
            name: "Commercial Rent",
            link: "#"
        },
        {
            name: "House Sale",
            link: "#"
        },
        {
            name: "Commercial Sale",
            link: "#"
        },
        {
            name: "Land Sale",
            link: "#"
        },
        {
            name: "Land Lease",
            link: "#"
        },
    ];

    const restaurantList = document.getElementById("restaurant-list");
    restaurants.forEach((restaurant) => {
        const listItem = document.createElement("li");
        const link = document.createElement("a");
        link.href = restaurant.link;
        // link.target = "_blank";
        link.rel = "noopener noreferrer";
        link.textContent = restaurant.name;

        listItem.appendChild(link);
        restaurantList.appendChild(listItem);
    });
</script>



 

 
 




<section>
    <div class="container">

        <div class="text-center   ">
            <h1>List Of Companies</h1>
        </div>
        <div class="row">

            <div class="col-lg-9 col-12 ">
                <div class="row    fadeIn" data-wow-delay="0.3s">



                <section class="OfferContainer_exclusive__non wow fadeInUp my-2" data-wow-delay="100ms">
                        <div class="col-12  card_div px-3">
                            <div class="row  py-3">
                                <div class="col-12 col-md-4 job_image_card  ">
                                    <img src="assets/img/self_images/Bhavi pvt ltd logo.png" class="img-fluid company_logo_size" alt="">

                                </div>

                                <div class="col-12 col-md-8">
                                    <h4>Bhavi Creations Pvt Ltd</h4>
                                    <p class="property_p_tag"><strong class="property_strong"> vacancies :</strong> 12 </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Location : </strong> Kakinada </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Phone :</strong>+91 9642343434 </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Website :</strong><a target="_blank" href="https://bhavicreationspvtltd.com/"> https://bhavicreationspvtltd.com/ </a>  </p>



                                </div>




                                <div class="col-12 terms_cond_styles">
                                    <div class="terms_justify">

                                        <p>
                                            <a href="job_full_page.php" class=" ">View More Details</a>
                                        </p>
                                    </div>

                                     

                                </div>
                            </div>

                        </div>
                    </section>

                    <section class="OfferContainer_exclusive__non wow fadeInUp my-2" data-wow-delay="100ms">
                        <div class="col-12  card_div px-3">
                            <div class="row  py-3">
                                <div class="col-12 col-md-4 job_image_card  ">
                                    <img src="assets/img/self_images/srinivasa_dental_logo.png" class="img-fluid company_logo_size" alt="">

                                </div>

                                <div class="col-12 col-md-8">
                                    <h4>Srinivasa Dental Hospital </h4>
                                    <p class="property_p_tag"><strong class="property_strong"> vacancies :</strong> 12 </p> 
                                    <p class="property_p_tag"> <strong class="property_strong"> Location : </strong> Kakinada </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Phone :</strong>+91 9569568567 </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Website :</strong><a target="_blank" href="https://srinivasadentalkakinada.com/">https://srinivasadentalkakinada.com/</a>  </p>


                                </div>




                                <div class="col-12 terms_cond_styles">
                                    <div class="terms_justify">

                                        <p>
                                            <a href="job_full_page1.php" class=" ">View More Details</a>
                                        </p>
                                    </div>

                                     

                                </div>
                            </div>

                        </div>
                    </section>

                    <section class="OfferContainer_exclusive__non wow fadeInUp my-2" data-wow-delay="100ms">
                        <div class="col-12  card_div px-3">
                            <div class="row  py-3">
                                <div class="col-12 col-md-4 job_image_card  ">
                                    <img src="assets/img/self_images/neurostar_logo.png" class="img-fluid company_logo_size" alt="">

                                </div>

                                <div class="col-12 col-md-8">
                                    <h4>Neuro Star Hospital</h4>
                                    <p class="property_p_tag"><strong class="property_strong"> vacancies :</strong> 12 </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Location : </strong> Kakinada </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Phone :</strong> +91 9121476777,9885943399</p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Website :</strong><a target="_blank" href="https://neurostarhospital.com/">https://neurostarhospital.com/</a>  </p>


                                </div>




                                <div class="col-12 terms_cond_styles">
                                    <div class="terms_justify">

                                        <p>
                                            <a href="job_full_page2.php" class=" ">View More Details</a>
                                        </p>
                                    </div>

                                     

                                </div>
                            </div>

                        </div>
                    </section>

                    <!-- <section class="OfferContainer_exclusive__non wow fadeInUp my-2" data-wow-delay="100ms">
                        <div class="col-12  card_div px-3">
                            <div class="row  py-3">
                                <div class="col-12 col-md-4 job_image_card  ">
                                    <img src="assets/img/self_images/Bhavi pvt ltd logo.png" class="img-fluid company_logo_size" alt="">

                                </div>

                                <div class="col-12 col-md-8">
                                    <h4>Bhavi Creations Pvt Ltd</h4>
                                    <p class="property_p_tag"><strong class="property_strong"> vacancies :</strong> 12 </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Location : </strong> Kakinada </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Phone :</strong> 9876543210 </p>
                                    <p class="property_p_tag"> <strong class="property_strong"> Website :</strong><a target="_blank" href="https://bhavicreationspvtltd.com/"> https://bhavicreationspvtltd.com/ </a>  </p>


                                </div>




                                <div class="col-12 terms_cond_styles">
                                    <div class="terms_justify">

                                        <p>
                                            <a href="job_full_page.php" class=" ">View More Details</a>
                                        </p>
                                    </div>

                                     

                                </div>
                            </div>

                        </div>
                    </section> -->


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