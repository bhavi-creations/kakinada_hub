 <?php include 'navbar.php';  ?>





 <section class="marquee-section">
     <div class="marquee-content">
         <marquee behavior="scroll" direction="left" class="marquee">
             <span class="highlight-text">Get All Your Discounts At One Place IN Kakinada Hub</span> &nbsp; || &nbsp; <span class="highlight-text">Happy Ugadhi</span> &nbsp; ||&nbsp;<span class="highlight-text">Get All Discounts Here</span> &nbsp; ||&nbsp; <span class="highlight-text">We Are Launching Soon</span>
         </marquee>
     </div>
 </section>


 <?php
    include './db.connection/db_connection.php'; // Ensure the database connection is included

    // Fetch only upper images
    $upperQuery = "SELECT image FROM home_ads WHERE type = 'upper'";
    $upperResult = mysqli_query($conn, $upperQuery);

    $upperImages = [];
    while ($row = mysqli_fetch_assoc($upperResult)) {
        $upperImages[] = $row['image'];
    }

    // Fetch only lower images
    $lowerQuery = "SELECT image FROM home_ads WHERE type = 'lower'";
    $lowerResult = mysqli_query($conn, $lowerQuery);

    $lowerImages = [];
    while ($row = mysqli_fetch_assoc($lowerResult)) {
        $lowerImages[] = $row['image'];
    }

    // Close connection (optional)
    mysqli_close($conn);
    ?>





 <section style="padding: 0px !important;">
     <div class="px-0">
         <div class="row justify-content-center mx-0">
             <div class="col-12 px-0">
                 <?php if (!empty($upperImages)): ?>
                     <div id="upperCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                         <div class="carousel-inner">
                             <?php foreach ($upperImages as $index => $image): ?>
                                 <div class="carousel-item <?= ($index === 0) ? 'active' : ''; ?>">
                                     <img src="./admin/uploads/home_ads/<?= htmlspecialchars($image) ?>" class="d-block w-100 img-fluid" style="object-fit: cover; max-height: 500px;" alt="Upper Image">
                                 </div>
                             <?php endforeach; ?>
                         </div>

                         <!-- Navigation buttons -->
                         <button class="carousel-control-prev" type="button" data-bs-target="#upperCarousel" data-bs-slide="prev">
                           
                                 <i class="fas fa-arrow-left"></i> <!-- Left arrow icon -->
                         
                         </button>
                         <button class="carousel-control-next" type="button" data-bs-target="#upperCarousel" data-bs-slide="next">
                         <i class="fas fa-arrow-right"></i>

                         </button>
                     </div>
                 <?php else: ?>
                     <p class="text-center text-muted">No upper images available.</p>
                 <?php endif; ?>
             </div>
         </div>
     </div>
 </section>








 <section class="team-section-three   space-md-bottom">
     <div class="container-style6">
         <div class="title-area-three text-center wow fadeInUp" data-wow-delay="600ms">
             <span class="sub-title7">Trending Now</span>

         </div>

         <div class="swiper-container team-slider"> <!-- Swiper Container -->
             <div class="swiper-wrapper"> <!-- Swiper Wrapper -->
                 <!-- Team block -->
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/srmt_mall.jpeg" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">SRMT Mall</p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">On Your First Purchase Get Up to 50% off 1000rs of items at SRMT </p>
                         </div>
                     </div>
                 </div>

                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/bbq.png" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">BBQ Nation</p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 10% off 1000rs of items at BBQ - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/lenskart.png" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">LensKart</p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 20% off 1000rs of items at Lentkart - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/kfc.png" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">KFC</p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 20% off 800rs of items at KFC - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/reliance trends.jpeg" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">Reliance Trends</p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 50% off 1000s of items at Trends - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>


             </div>
             <!-- Pagination and Navigation Buttons -->

         </div>
         <div class="swiper-container team-slider"> <!-- Swiper Container -->
             <div class="swiper-wrapper"> <!-- Swiper Wrapper -->
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/lenskart.png" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">LensKart</p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 20% off 1000rs of items at Lentkart - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/kfc.png" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">KFC</p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 20% off 800rs of items at KFC - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/reliance trends.jpeg" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">Reliance Trends</p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 50% off 1000s of items at Trends - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/srmt_mall.jpeg" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">SRMT Mall</p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">On Your First Purchase Get Up to 50% off 1000rs of items at SRMT </p>
                         </div>
                     </div>
                 </div>

                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/bbq.png" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">BBQ Nation</p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 10% off 1000rs of items at BBQ - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Pagination and Navigation Buttons -->

         </div>
     </div>
 </section>




 <section class="team-section-three   space-md-bottom">
     <div class="container-style6">
         <div class="title-area-three text-center wow fadeInUp" data-wow-delay="600ms">
             <span class="sub-title7">Offers</span>

         </div>

         <div class="swiper-container team-slider"> <!-- Swiper Container -->
             <div class="swiper-wrapper"> <!-- Swiper Wrapper -->
                 <!-- Team block -->
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/undaer.webp" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">Under Armour
                                     </p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 50% off 1000s of items at Under Armour - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>

                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/adida.png" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">Adadis</p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 50% off 1000s of items at Adadis - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/nike.png" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">Nike
                                     </p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 50% off 1000s of items at Nike - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/Ray.webp" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">Ray-Ban
                                     </p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 50% off 1000s of items at Ray-Ban - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/Crocs-logo.jpg" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">Crocs</p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 50% off 1000s of items at Crocs - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>


             </div>
             <!-- Pagination and Navigation Buttons -->

         </div>
         <div class="swiper-container team-slider"> <!-- Swiper Container -->
             <div class="swiper-wrapper"> <!-- Swiper Wrapper -->
                 <!-- Team block -->
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/Ray.webp" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">Ray-Ban
                                     </p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 50% off 1000s of items at Ray-Ban - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/Crocs-logo.jpg" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">Crocs</p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 50% off 1000s of items at Crocs - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/adida.png" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">Adadis</p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 50% off 1000s of items at Adadis - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/nike.png" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">Nike
                                     </p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 50% off 1000s of items at Nike - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide "> <!-- Swiper Slide -->
                     <div class="card_border_styles">
                         <div class="row">
                             <div class="col-4 ">
                                 <div class="img_border">
                                     <img src="assets/img/self_images/undaer.webp" class="img-fluid" alt="">
                                 </div>
                             </div>

                             <div class="col-8">
                                 <div class="d-flex">
                                     <p class="brand_name">Under Armour
                                     </p>
                                 </div>

                                 <div class="d-flex">
                                     <p class="brand_type"> <i class="fal fa-star"></i> Exclusive</p>
                                 </div>
                             </div>
                         </div>
                         <div class="row  mini_card_spacings">
                             <p class="brand_special_discount">Up to 50% off 1000s of items at Under Armour - Don't miss
                                 out, ...</p>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Pagination and Navigation Buttons -->

         </div>
     </div>
 </section>





 <section class="mb-5">
    <div class="px-0">
        <div class="row justify-content-center mx-0">
            <div class="col-12 px-0">
                <?php if (!empty($lowerImages)): ?>
                    <div id="lowerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                            <?php foreach ($lowerImages as $index => $image): ?>
                                <div class="carousel-item <?= ($index === 0) ? 'active' : ''; ?>">
                                    <img src="./admin/uploads/home_ads/<?= htmlspecialchars($image) ?>"
                                         class="d-block w-100 img-fluid"
                                         style="object-fit: cover; max-height: 500px;"
                                         alt="Lower Image">
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Navigation buttons -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#lowerCarousel" data-bs-slide="prev">
                            <i class="fas fa-arrow-left"></i> <!-- Left arrow icon -->
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#lowerCarousel" data-bs-slide="next">
                            <i class="fas fa-arrow-right"></i> <!-- Right arrow icon -->
                        </button>
                    </div>
                <?php else: ?>
                    <p class="text-center text-muted">No lower images available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>



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
                 slidesPerView: 4
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














 <?php include 'chat_bot.php';  ?>




 <?php include 'footer.php';  ?>