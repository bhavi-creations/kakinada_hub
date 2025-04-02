 <?php include 'navbar.php';  ?>

<?php include 'jobs_sidebar.php'; ?>



 <section>
     <div class="container">

         <div class="text-center   ">
             <h1>List Of Companies</h1>
         </div>
         <div class="row">

             <div class="col-lg-9 col-12">
                 <?php include 'db.connection/db_connection.php'; ?>

                 <!-- Search Form -->
                 <form method="GET" action="" class="p-3 bg-light shadow-sm rounded">
                     <div class="row g-3 align-items-center">
                         <div class="col-md-4">
                             <input type="text" name="search_name" class="form-control border-primary shadow-sm"
                                 placeholder="🔍 Search by Company Name"
                                 value="<?php echo isset($_GET['search_name']) ? $_GET['search_name'] : ''; ?>">
                         </div>
                         <div class="col-md-4">
                             <input type="text" name="search_category" class="form-control border-primary shadow-sm"
                                 placeholder="🏷️ Search by Category"
                                 value="<?php echo isset($_GET['search_category']) ? $_GET['search_category'] : ''; ?>">
                         </div>
                         <div class="col-md-4 text-end">
                             <button type="submit" class="btn btn-primary px-4 shadow">🔎 Search</button>
                             <a href="jobs.php" class="btn btn-secondary px-4 shadow">⟲ Reset</a>
                         </div>
                     </div>
                 </form>


                 <div class="row fadeIn" data-wow-delay="0.3s">
                     <?php
                        // Fetch search parameters
                        $searchName = isset($_GET['search_name']) ? trim($_GET['search_name']) : '';
                        $searchCategory = isset($_GET['search_category']) ? trim($_GET['search_category']) : '';

                        // Base query
                        $companyQuery = "SELECT * FROM companies WHERE 1=1";

                        // Apply filters
                        if (!empty($searchName)) {
                            $companyQuery .= " AND name LIKE '%" . mysqli_real_escape_string($conn, $searchName) . "%'";
                        }
                        if (!empty($searchCategory)) {
                            $companyQuery .= " AND category LIKE '%" . mysqli_real_escape_string($conn, $searchCategory) . "%'";
                        }

                        $companyResult = mysqli_query($conn, $companyQuery);

                        while ($company = mysqli_fetch_assoc($companyResult)) {
                            $company_id = $company['id'];
                            $jobQuery = "SELECT * FROM jobs WHERE company_id = $company_id";
                            $jobResult = mysqli_query($conn, $jobQuery);
                            $jobCount = mysqli_num_rows($jobResult);

                            echo '<section class="OfferContainer_exclusive__non wow fadeInUp my-2" data-wow-delay="100ms">
                    <div class="col-12 card_div px-3">
                        <div class="row py-3">
                            <div class="col-12 col-md-4 job_image_card">
                                <img src="./admin/uploads/companies/' . $company['logo'] . '" class="img-fluid company_logo_size" alt="">
                            </div>

                            <div class="col-12 col-md-8">
                                <h4>' . $company['name'] . '</h4>
                                <p class="property_p_tag"> <strong class="property_strong"> Category: </strong>' . $company['category'] . '</p>
                                <p class="property_p_tag"> <strong class="property_strong"> Phone: </strong>' . $company['phone'] . '</p>
                                <p class="property_p_tag"> <strong class="property_strong"> Email: </strong>' . $company['email'] . '</p>
                                <p class="property_p_tag"> <strong class="property_strong"> Website: </strong>
                                    <a target="_blank" href="' . $company['website'] . '">' . $company['website'] . '</a>
                                </p>
                            </div>
                        </div>';

                            // Display jobs count if available
                            if ($jobCount > 0) {
                                echo '<div class="col-12 terms_cond_styles">
                        <div class="terms_justify">
                            <p>
                                <a href="job_full_page.php?company_id=' . $company_id . '" class="">View More Details</a>
                            </p>
                        </div>
                      </div>';
                            }

                            echo '</div></section>';
                        }
                        ?>
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