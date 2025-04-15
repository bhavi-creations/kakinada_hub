<?php include 'navbar.php';  ?>
<?php include 'jobs_sidebar.php'; ?>



<section class=" ">
    <div class="container">
        <?php
        include './db.connection/db_connection.php';

        // Get company ID from URL
        if (isset($_GET['company_id'])) {
            $company_id = intval($_GET['company_id']);

            // Fetch company details
            $companyQuery = "SELECT * FROM companies WHERE id = $company_id";
            $companyResult = mysqli_query($conn, $companyQuery);
            $company = mysqli_fetch_assoc($companyResult);

            // Fetch all jobs for this company
            $jobQuery = "SELECT * FROM jobs WHERE company_id = $company_id";
            $jobResult = mysqli_query($conn, $jobQuery);
        } else {
            echo "Invalid Company Selection";
            exit;
        }
        ?>

        <div class="text-center   mb-5">
            <h1 class="heading-gradient"><?php echo $company['name']; ?></h1>


        </div>
        <div class="row">


            <div class="col-lg-2  col-12 text_side_div d-none d-lg-block">

                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid side_dive_images">

                <img src="assets/img/test/animation.gif" alt="Animated GIF" class=" my-4 side_dive_images">

                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid  side_dive_images">
            </div>

            <div class="col-lg-8 col-12  ">

                <div class="row scrollable-list">


                    <?php
                    include './db.connection/db_connection.php';

                    // Get company ID from URL
                    if (isset($_GET['company_id'])) {
                        $company_id = intval($_GET['company_id']);

                        // Fetch company details
                        $companyQuery = "SELECT * FROM companies WHERE id = $company_id";
                        $companyResult = mysqli_query($conn, $companyQuery);
                        $company = mysqli_fetch_assoc($companyResult);

                        // Fetch all jobs for this company
                        $jobQuery = "SELECT * FROM jobs WHERE company_id = $company_id";
                        $jobResult = mysqli_query($conn, $jobQuery);
                    } else {
                        echo "Invalid Company Selection";
                        exit;
                    }
                    ?>
                    <div class="row ">
                        <div class="col-md-6 col-12 my-2">
                            <div class="job_image_card border-gradient">
                                <img src="./admin/uploads/companies/<?php echo $company['logo']; ?>" class="img-fluid " alt="">
                            </div>
                        </div>

                        <div class="col-md-6 col-12 my-2 movie_title_card">
                            <div class="product-content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Company : </strong></p>
                                    <h4 class="movie-value"><?php echo $company['name']; ?></h4>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Category : </strong></p>
                                    <h4 class="movie-value"><?php echo $company['category']; ?></h4>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Website :</strong></p>
                                    <p class="movie-value"><a href="<?php echo $company['website']; ?>" target="_blank"><?php echo $company['website']; ?></a></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Phone :</strong></p>
                                    <p class="movie-value"><?php echo $company['phone']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Employees :</strong></p>
                                    <p class="movie-value"><?php echo $company['no_of_employees']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Experience :</strong></p>
                                    <p class="movie-value"><?php echo $company['experience_years']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-5 p-3">
                        <div class="col-md-8 col-12">
                            <h2 class="heading-gradient">About Company</h2>
                            <h6 class="p-gradient"><?php echo $company['about']; ?></h6>

                            <h2 class="heading-gradient">Address</h2>
                            <h6 class="card-text movie-value">

                                <?php if (!empty($company['map_url'])) { ?>
                                    <a href="<?php echo $company['map_url']; ?>" target="_blank">
                                        <?php echo $company['address']; ?>
                                    </a>
                                <?php } else {
                                    echo $company['address'];
                                } ?>
                            </h6>

                        </div>
                        <div class="col-md-4 col-12">
                            <h3 class="text-center heading-gradient">Jobs</h3>
                            <div class="product-content">
                                <?php while ($job = mysqli_fetch_assoc($jobResult)) { ?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="movie-label"><strong><?php echo $job['job_title']; ?> : </strong></p>
                                        <p class="job_roles"><?php echo $job['vacancies']; ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="  col-12 my-2">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    if (!empty($company['company_images'])) {
                                        $images = explode(',', $company['company_images']); // Assuming images are stored as CSV
                                        foreach ($images as $index => $image) {
                                            $active = $index === 0 ? 'active' : '';
                                            echo "<div class='carousel-item $active'>
                                <img src='./admin/uploads/companies/$image' class='img-fluid d-block w-100' alt='Company Image'>
                              </div>";
                                        }
                                    } else {
                                        echo "<p class='text-center'>No images available</p>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5 p-3">
                        <div class="col-md-8 col-12">
                            <div class="review-container">
                                <h2 class="heading-gradient">Customer Reviews</h2>

                                <div class="review">
                                    <div class="review-header">
                                        <img src="assets/img/test/woman.png" alt="User" class="profile-img">
                                        <div class="">
                                            <p class="heading-gradient"><strong>Veera Venkata Durgadevi Gandi</strong></p>
                                            <p class="stars  p-gradient ">⭐⭐⭐⭐⭐ 5/5</p>
                                        </div>
                                    </div>
                                    <p class="review-text  p-gradient ">
                                        Teeth gap fill cheyinchukunna chala Baga chesaru and chala Baga treat chesaru
                                        <!-- <span class="hidden-text"> It’s wonderful to know you’re satisfied with the teeth gap treatment. We're always here to keep your smile healthy and beautiful! Best regards, Srinivasa Multispecialty Dental Hospital"</span> -->
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

                                <div class="review">
                                    <div class="review-header">
                                        <img src="assets/img/test/boy11.png" alt="User" class="profile-img">
                                        <div class="">
                                            <p class="heading-gradient"><strong>
                                                    kranthi kumar m
                                                </strong></p>
                                            <p class="stars  p-gradient">⭐⭐⭐⭐</p>
                                        </div>
                                    </div>
                                    <p class="review-text  p-gradient ">
                                        Treatment is very good.receving is fantastic and fully equipped dental hospital, fully satisfied.price is reasonable
                                        <span class="hidden-text">Dr.kiran Raju explains everything in detail and very happy for whole process"</span>
                                    </p>
                                    <p class="view-more  heading-gradient " onclick="toggleText(this)">Read More</p>
                                    <p class="view-images  heading-gradient " onclick="toggleImages(this)">View Images</p>
                                    <div class="review-images">
                                        <img src="assets/img/review3.jpg" alt="Review Image"
                                            onclick="openLightbox(this)">
                                    </div>
                                </div>


                                <div class="review">
                                    <div class="review-header">
                                        <img src="assets/img/test/woman.png" alt="User" class="profile-img">
                                        <div class="">
                                            <p class="heading-gradient"><strong>Iqra mahi
                                                </strong></p>
                                            <p class="stars  p-gradient">⭐⭐⭐⭐⭐ 5/5</p>
                                        </div>
                                    </div>
                                    <p class="review-text  p-gradient ">
                                        Thanks you so much all im soo happy <!-- <span class="hidden-text">little slow during peak hours. Overall, a great place for a relaxed meal."</span> -->
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

                                <div class="review">
                                    <div class="review-header">
                                        <img src="assets/img/test/boy11.png" alt="User" class="profile-img">
                                        <div class="">
                                            <p class="heading-gradient"><strong>lokesh nandan</strong></p>
                                            <p class="stars  p-gradient">⭐⭐⭐⭐</p>
                                        </div>
                                    </div>
                                    <p class="review-text  p-gradient ">
                                        Treatment was super & excellent.... complete painless treatment....clinic was very clean and hygienic...Dr kira raju sir was treated me very caring....staff also very supported....and
                                        <span class="hidden-text">carring....I'm fully satisfied my treatment....tk u Dr Kiran raju sir and staff....tk u srinivasa dental"</span>
                                    </p>
                                    <p class="view-more  heading-gradient " onclick="toggleText(this)">Read More</p>
                                    <p class="view-images  heading-gradient " onclick="toggleImages(this)">View Images</p>
                                    <div class="review-images">
                                        <img src="assets/img/review3.jpg" alt="Review Image"
                                            onclick="openLightbox(this)">
                                    </div>
                                </div>


                                <div class="review">
                                    <div class="review-header">
                                        <img src="assets/img/test/woman.png" alt="User" class="profile-img">
                                        <div class="">
                                            <p class="heading-gradient"><strong> Sophia L.</strong></p>
                                            <p class="stars  p-gradient">⭐⭐⭐⭐⭐ 5/5</p>
                                        </div>
                                    </div>
                                    <p class="review-text  p-gradient ">
                                        "The food was amazing, especially the wood-fired pizza and seafood platter! However, the service was a
                                        <span class="hidden-text">little slow during peak hours. Overall, a great place for a relaxed meal."</span>
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

                            <!-- Lightbox for Image Popup -->
                            <div class="lightbox" id="lightbox">
                                <span class="close" onclick="closeLightbox()">&times;</span>
                                <img id="lightbox-img" src="">
                            </div>


                        </div>
                        <div class="col-md-4 col-12">
                            <div class="review-form">
                                <h2 class="heading-gradient">Submit Your Review</h2>
                                <input type="text" id="name" placeholder="Your Name" required>
                                <select id="rating">
                                    <option value="⭐">⭐</option>
                                    <option value="⭐⭐">⭐⭐</option>
                                    <option value="⭐⭐⭐">⭐⭐⭐</option>
                                    <option value="⭐⭐⭐⭐">⭐⭐⭐⭐</option>
                                    <option value="⭐⭐⭐⭐⭐ 5/5" selected>⭐⭐⭐⭐⭐ 5/5</option>
                                </select>
                                <textarea id="comment" rows="3" placeholder="Write a comment..." required></textarea>
                                <input type="file" id="imageUpload" accept="image/*">
                                <button class="button-gradient" onclick="submitReview()">Submit Review</button>
                            </div>
                        </div>

                    </div>
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