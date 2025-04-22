<?php include 'navbar.php'; ?>
<?php include 'jobs_sidebar.php'; ?>


<section class="bg_section responsive_section">
    <div class="container">

        <?php
        include './db.connection/db_connection.php';

        if (isset($_GET['company_id'])) {
            $company_id = intval($_GET['company_id']);

            // Fetch company details
            $companyQuery = "SELECT * FROM companies WHERE id = $company_id";
            $companyResult = mysqli_query($conn, $companyQuery);
            $company = mysqli_fetch_assoc($companyResult);

            // Fetch all jobs for this company
            $jobQuery = "SELECT * FROM jobs WHERE company_id = $company_id";
            $jobResult = mysqli_query($conn, $jobQuery);

            // Fetch ads
            $adsQuery = "SELECT * FROM company_ads WHERE company_id = $company_id";
            $adsResult = mysqli_query($conn, $adsQuery);

            $leftAds = [];
            $rightAds = [];
            while ($ad = mysqli_fetch_assoc($adsResult)) {
                if ($ad['ad_position'] === 'left') $leftAds[] = $ad;
                if ($ad['ad_position'] === 'right') $rightAds[] = $ad;
            }
        } else {
            echo "Invalid Company Selection";
            exit;
        }
        ?>

        <h1 class="text-center gradient_text_color spacing_for_htag"><?php echo $company['name']; ?></h1>

        <div class="row">

            <!-- LEFT ADS -->
            <div class="col-lg-2 d-none d-lg-block ads-section ads_section text_side_div">
                <?php foreach ($leftAds as $ad): ?>
                    <?php if ($ad['ad_type'] === 'image' || $ad['ad_type'] === 'gif'): ?>
                        <img src="admin/uploads/company_ads/<?php echo $ad['file_name']; ?>" class="img-fluid my-2 side_dive_images" alt="Ad">
                    <?php elseif ($ad['ad_type'] === 'video'): ?>
                        <video controls class="img-fluid my-2 side_dive_images">
                            <source src="admin/uploads/company_ads/<?php echo $ad['file_name']; ?>" type="video/mp4">
                        </video>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- CENTER CONTENT -->
            <div class="col-lg-8 col-12">
                <div class="row scrollable-list">

                    <!-- COMPANY LOGO AND INFO -->
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <div class="job_image_card border-gradient">
                                <img src="admin/uploads/companies/<?php echo $company['logo']; ?>" class="img-fluid" alt="Company Logo">
                            </div>
                        </div>
                        <div class="col-md-6 my-2 movie_title_card">
                            <div class="product-content">
                                <?php
                                $info = [
                                    // 'Company' => $company['name'],
                                    'Category' => $company['category'],
                                    'Website' => $company['website'],
                                    'Phone' => $company['phone'],
                                    'Employees' => $company['no_of_employees'],
                                    'Established ' => $company['experience_years']
                                ];
                                foreach ($info as $label => $value): ?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="movie-label"><strong><?php echo $label; ?> :</strong></p>
                                        <?php if ($label === 'Website'): ?>
                                            <p class="movie-value"><a href="<?php echo $value; ?>" target="_blank"><?php echo $value; ?></a></p>
                                        <?php else: ?>
                                            <p class="movie-value"><?php echo $value; ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- ABOUT COMPANY & JOB LIST -->
                    <div class="row my-5 p-3">
                        <div class=" col-12">
                            <h2 class="heading-gradient">About Company</h2>
                            <h6 class="p-gradient"><?php echo $company['about']; ?></h6>

                            <h2 class="heading-gradient">Address</h2>
                            <h6 class="card-text movie-value">
                                <?php if (!empty($company['map_url'])): ?>
                                    <a href="<?php echo $company['map_url']; ?>" target="_blank"><?php echo $company['address']; ?></a>
                                <?php else: ?>
                                    <?php echo $company['address']; ?>
                                <?php endif; ?>
                            </h6>
                        </div>


                    </div>

                    <!-- COMPANY IMAGE SLIDER -->
                    <div class="row">
                        <div class="col-md-7 col-12 my-2">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    if (!empty($company['company_images'])) {
                                        $images = explode(',', $company['company_images']);
                                        foreach ($images as $index => $image) {
                                            $active = $index === 0 ? 'active' : '';
                                            echo "<div class='carousel-item $active'>
                                                    <img src='admin/uploads/companies/$image' class='img-fluid d-block w-100' alt='Company Image'>
                                                  </div>";
                                        }
                                    } else {
                                        echo "<p class='text-center'>No images available</p>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <h3 class="text-center heading-gradient">vacancies</h3>
                            <div class="product-content">
                                <?php while ($job = mysqli_fetch_assoc($jobResult)): ?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="movie-label"><strong><?php echo $job['job_title']; ?> :</strong></p>
                                        <p class="job_roles"><?php echo $job['vacancies']; ?></p>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>


                        <div class="">
                            <div class="row px-2">
                                <div class="swiper-container swiper-container-upper team-slider">
                                    <div class="swiper-wrapper">
                                        <!-- Slide 1 -->
                                        <div class="swiper-slide">
                                            <div class="gradient_card_wrapper">
                                                <div class="card_border_styles">
                                                    <div class="row">

                                                        <div class=" text-center">
                                                            <p class="heading-gradient"><strong>Veera Venkata Durgadevi Gandi</strong></p>

                                                            <img src="assets/img/test/woman.png" alt="User" class="profile-img ">
                                                            <p class="stars  p-gradient ">⭐⭐⭐⭐⭐ 5/5</p>
                                                        </div>
                                                        <p class="review-text  p-gradient ">
                                                            Teeth gap fill cheyinchukunna chala Baga chesaru and chala Baga treat chesaru
                                                            <span class="hidden-text">Dr.kiran Raju explains everything in detail and very happy for whole process"</span>

                                                        </p>
                                                        <p class="view-more  heading-gradient " onclick="toggleText(this)">Read More</p>
                                                        <p class="view-images  heading-gradient " onclick="toggleImages(this)">View Images</p>
                                                        <div class="review-images">
                                                            <img src="assets/img/test/1.png" alt="Review Image"
                                                                onclick="openLightbox(this)">
                                                            <img src="assets/img/test/2.png" alt="Review Image"
                                                                onclick="openLightbox(this)">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <div class="gradient_card_wrapper">
                                                <div class="card_border_styles">
                                                    <div class="row">

                                                        <div class=" text-center">
                                                            <p class="heading-gradient"><strong>Iqra mahi</strong></p>

                                                            <img src="assets/img/test/boy11.png" alt="User" class="profile-img">
                                                            <p class="stars  p-gradient ">⭐⭐⭐⭐⭐ 5/5</p>
                                                        </div>
                                                        <p class="review-text  p-gradient ">
                                                            Thanks you so much all im soo happy
                                                        </p>
                                                        <p class="view-more  heading-gradient " onclick="toggleText(this)">Read More</p>
                                                        <p class="view-images  heading-gradient " onclick="toggleImages(this)">View Images</p>
                                                        <div class="review-images">
                                                            <img src="assets/img/test/1.png" alt="Review Image"
                                                                onclick="openLightbox(this)">
                                                            <img src="assets/img/test/2.png" alt="Review Image"
                                                                onclick="openLightbox(this)">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="swiper-slide">
                                            <div class="gradient_card_wrapper">
                                                <div class="card_border_styles">
                                                    <div class="row">

                                                        <div class=" text-center">
                                                            <p class="heading-gradient"><strong>lokesh nandan</strong></p>

                                                            <img src="assets/img/test/boy11.png" alt="User" class="profile-img">
                                                            <p class="stars  p-gradient ">⭐⭐⭐⭐⭐ 5/5</p>
                                                        </div>
                                                        <p class="review-text  p-gradient ">
                                                            Treatment was super & excellent.... complete painless treatment....
                                                            <span class="hidden-text">clinic was very clean and hygienic...Dr kira raju sir was treated me very caring....staff also very supported....and carring....I'm fully satisfied my treatment....tk u Dr Kiran raju sir and staff....tk u srinivasa dental"</span>
                                                        </p>
                                                        <p class="view-more  heading-gradient " onclick="toggleText(this)">Read More</p>
                                                        <p class="view-images  heading-gradient " onclick="toggleImages(this)">View Images</p>
                                                        <div class="review-images">
                                                            <img src="assets/img/test/1.png" alt="Review Image"
                                                                onclick="openLightbox(this)">
                                                            <img src="assets/img/test/2.png" alt="Review Image"
                                                                onclick="openLightbox(this)">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="swiper-slide">
                                            <div class="gradient_card_wrapper">
                                                <div class="card_border_styles">
                                                    <div class="row">

                                                        <div class=" text-center">
                                                            <p class="heading-gradient"><strong>kranthi kumar m</strong></p>

                                                            <img src="assets/img/test/woman.png" alt="User" class="profile-img ">
                                                            <p class="stars  p-gradient ">⭐⭐⭐⭐⭐ 5/5</p>
                                                        </div>
                                                        <p class="review-text  p-gradient ">
                                                            Treatment is very good.receving is fantastic and fully equipped
                                                            <span class="hidden-text">dental hospital, fully satisfied.price is reasonable
                                                                Dr.kiran Raju explains everything in detail and very happy for whole process"</span>

                                                        </p>
                                                        <p class="view-more  heading-gradient " onclick="toggleText(this)">Read More</p>
                                                        <p class="view-images  heading-gradient " onclick="toggleImages(this)">View Images</p>
                                                        <div class="review-images">
                                                            <img src="assets/img/test/1.png" alt="Review Image"
                                                                onclick="openLightbox(this)">
                                                            <img src="assets/img/test/2.png" alt="Review Image"
                                                                onclick="openLightbox(this)">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>



                                <script>
                                    var swiper = new Swiper(".team-slider", {
                                        slidesPerView: 3, // Show 3 slides at a time
                                        spaceBetween: 20, // Adjust spacing between slides
                                        loop: true, // Enables infinite scrolling
                                        autoplay: {
                                            delay: 3000, // Auto-slide every 3 seconds
                                            disableOnInteraction: false,
                                        },

                                        pagination: {
                                            el: ".swiper-pagination",
                                            clickable: true,
                                        },
                                        breakpoints: {
                                            1024: {
                                                slidesPerView: 3
                                            },
                                            768: {
                                                slidesPerView: 3
                                            },
                                            0: {
                                                slidesPerView: 1
                                            }
                                        }
                                    });
                                </script>




                            </div>

                            <div class="row mt-5 px-2">

                                <div class="  col-12">

                                    <div class="review-form">

                                        <div class="row">

                                            <h2 class="heading-gradient">Submit Your Review</h2>
                                            <div class="col-md-4">
                                                <input type="text" class="custom-input" id="name" placeholder="Your Name" required>

                                            </div>
                                            <div class="col-md-4">
                                                <select id="rating">
                                                    <option value="⭐">⭐</option>
                                                    <option value="⭐⭐">⭐⭐</option>
                                                    <option value="⭐⭐⭐">⭐⭐⭐</option>
                                                    <option value="⭐⭐⭐⭐">⭐⭐⭐⭐</option>
                                                    <option value="⭐⭐⭐⭐⭐ 5/5" selected>⭐⭐⭐⭐⭐ 5/5</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="file" class="custom-input" id="imageUpload" accept="image/*">
                                            </div>
                                            <div class="col-12">

                                                <textarea id="comment" rows="3" class="custom-input" placeholder="Write a comment..." required></textarea>
                                                <button class="button-gradient" onclick="submitReview()">Submit Review</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>










            </div>

            <!-- RIGHT ADS -->
            <div class="col-lg-2 d-none d-lg-block ads-section ads_section text_side_div">
                <?php foreach ($rightAds as $ad): ?>
                    <?php if ($ad['ad_type'] === 'image' || $ad['ad_type'] === 'gif'): ?>
                        <img src="admin/uploads/company_ads/<?php echo $ad['file_name']; ?>" class="img-fluid my-2 side_dive_images" alt="Ad">
                    <?php elseif ($ad['ad_type'] === 'video'): ?>
                        <video controls class="img-fluid my-2 side_dive_images">
                            <source src="admin/uploads/company_ads/<?php echo $ad['file_name']; ?>" type="video/mp4">
                        </video>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>



            <!-- MOBILE AD POPUP -->
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
</section>








<script>
    let currentSlide = 0;

    function slideImages() {
        const slides = document.querySelectorAll('.custom-slide');
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }
    setInterval(slideImages, 2000); // Auto-slide every 3 seconds
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