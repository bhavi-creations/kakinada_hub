<?php include 'navbar.php';  ?>





<?php
   include './db.connection/db_connection.php'; // Ensure the database connection is included

   // Fetch marquee texts
   $sql = "SELECT text FROM marquee_texts ORDER BY created_at DESC";
   $result = $conn->query($sql);

   // Prepare marquee content
   $marquee_texts = [];
   while ($row = $result->fetch_assoc()) {
       $marquee_texts[] = '<span class="highlight-text">' . htmlspecialchars($row['text']) . '</span>';
   }

   // Convert array to string with separators
   $marquee_content = implode(' &nbsp; || &nbsp; ', $marquee_texts);
   ?>

<section class="marquee-section">
    <div class="marquee-content">
        <marquee behavior="scroll" direction="left" class="marquee">
            <?php echo $marquee_content; ?>
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





<?php
   include './db.connection/db_connection.php'; // Ensure the database connection is included

   // Fetch trending items with type 'upper'
   $sqlUpper = "SELECT * FROM trending WHERE type = 'upper' ORDER BY created_at DESC";
   $resultUpper = $conn->query($sqlUpper);

   // Fetch trending items with type 'lower'
   $sqlLower = "SELECT * FROM trending WHERE type = 'lower' ORDER BY created_at DESC";
   $resultLower = $conn->query($sqlLower);
   ?>

<section class="team-section-three space-md-bottom bg_image_for_shops">
    <div class="container-style6 bg_color_white"   >
        <div class="title-area-three text-center wow fadeInUp shop_heads" data-wow-delay="400ms">
            <span class="sub-title7">Trending Now</span>
        </div>

        <!-- Upper Type Swiper -->
        <div class="swiper-container swiper-container-upper team-slider  ">
            <div class="swiper-wrapper">
                <?php if ($resultUpper->num_rows > 0): ?>
                    <?php while ($row = $resultUpper->fetch_assoc()): ?>
                        <div class="swiper-slide">
                            <div class="card_border_styles">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="img_border">
                                            <img src="./admin/uploads/home_trending/<?php echo htmlspecialchars($row['image']); ?>" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="d-flex">
                                            <p class="brand_name"><?php echo htmlspecialchars($row['title']); ?></p>
                                        </div>
                                        <div class="d-flex">
                                            <p class="brand_type">
                                                ⭐<?php echo htmlspecialchars($row['offer']); ?></p>
                                        </div>

                                    </div>
                                </div>
                                <div class="row mini_card_spacings">
                                    <p class="brand_special_discount">
                                        <?php
                                           $text = htmlspecialchars($row['description']);
                                           echo (strlen($text) > 60) ? substr($text, 0, 57) . '...' : $text;
                                           ?>
                                    </p>
                                </div>


                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No upper trending items found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Lower Type Swiper -->
        <div class="swiper-container swiper-container-lower team-slider">
            <div class="swiper-wrapper">
                <?php if ($resultLower->num_rows > 0): ?>
                    <?php while ($row = $resultLower->fetch_assoc()): ?>
                        <div class="swiper-slide">
                            <div class="card_border_styles">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="img_border">
                                            <img src="./admin/uploads/home_trending/<?php echo htmlspecialchars($row['image']); ?>" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="d-flex">
                                            <p class="brand_name"><?php echo htmlspecialchars($row['title']); ?></p>
                                        </div>
                                        <div class="d-flex">
                                            <p class="brand_type">⭐ <?php echo htmlspecialchars($row['offer']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mini_card_spacings">
                                    <p class="brand_special_discount">
                                        <?php
                                           $text = htmlspecialchars($row['description']);
                                           echo (strlen($text) > 60) ? substr($text, 0, 57) . '...' : $text;
                                           ?>
                                    </p>
                                </div>

                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No lower trending items found.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>




<?php
   include './db.connection/db_connection.php'; // Ensure the database connection is included

   // Fetch offers items with type 'upper'
   $sqlUpper = "SELECT * FROM offers WHERE type = 'upper' ORDER BY created_at DESC";
   $resultUpper = $conn->query($sqlUpper);

   // Fetch offers items with type 'lower'
   $sqlLower = "SELECT * FROM offers WHERE type = 'lower' ORDER BY created_at DESC";
   $resultLower = $conn->query($sqlLower);
   ?>

<section class="team-section-three space-md-bottom bg_image_for_shops">
    <div class="container-style6 bg_color_white">
        <div class="title-area-three text-center wow fadeInUp" data-wow-delay="400ms">
            <span class="sub-title7">Offers </span>
        </div>

        <!-- Upper Type Swiper -->
        <div class="swiper-container swiper-container-upper team-slider  ">
            <div class="swiper-wrapper">
                <?php if ($resultUpper->num_rows > 0): ?>
                    <?php while ($row = $resultUpper->fetch_assoc()): ?>
                        <div class="swiper-slide">
                            <div class="card_border_styles">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="img_border">
                                            <img src="./admin/uploads/home_offers/<?php echo htmlspecialchars($row['image']); ?>" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="d-flex">
                                            <p class="brand_name"><?php echo htmlspecialchars($row['title']); ?></p>
                                        </div>
                                        <div class="d-flex">
                                            <p class="brand_type">⭐ <?php echo htmlspecialchars($row['offer']); ?></p>
                                        </div>

                                    </div>
                                </div>
                                <div class="row mini_card_spacings">
                                    <p class="brand_special_discount">
                                        <?php
                                           $text = htmlspecialchars($row['description']);
                                           echo (strlen($text) > 60) ? substr($text, 0, 57) . '...' : $text;
                                           ?>
                                    </p>
                                </div>


                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No upper offers items found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Lower Type Swiper -->
        <div class="swiper-container swiper-container-lower team-slider">
            <div class="swiper-wrapper">
                <?php if ($resultLower->num_rows > 0): ?>
                    <?php while ($row = $resultLower->fetch_assoc()): ?>
                        <div class="swiper-slide">
                            <div class="card_border_styles">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="img_border">
                                            <img src="./admin/uploads/home_offers/<?php echo htmlspecialchars($row['image']); ?>" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="d-flex">
                                            <p class="brand_name"><?php echo htmlspecialchars($row['title']); ?></p>
                                        </div>
                                        <div class="d-flex">
                                            <p class="brand_type">⭐ <?php echo htmlspecialchars($row['offer']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mini_card_spacings">
                                    <p class="brand_special_discount">
                                        <?php
                                           $text = htmlspecialchars($row['description']);
                                           echo (strlen($text) > 60) ? substr($text, 0, 57) . '...' : $text;
                                           ?>
                                    </p>
                                </div>

                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No lower Offers items found.</p>
                <?php endif; ?>
            </div>
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







<section class="vs-hero-wrapper position-relative slider-area  bg_section   ">
    <div class="bg-overlay "></div>
    <div class="vs-hero-carousel  " data-navprevnext="true" data-height="800" data-container="1900" data-slidertype="responsive">


        <div class="ls-slide orange-slide">

            <h1 class="slider_main_text ls-l ls-responsive  text_animation orange-slide-anim" data-ls-mobile="left: 100px; top: 230px;" data-ls-tablet="left: 100px; top: 230px;" data-ls-laptop="left: 100px; top: 180px;" style="left: 300px; top: 270px; font-size: 72px; font-weight: 700;">We always put the</h1>

            <h1 class="slider_main_text ls-l ls-responsive orange-slide-anim" data-ls-mobile="left: 100px; top: 340px;" data-ls-tablet="left: 100px; top: 340px;" data-ls-laptop="left: 100px; top: 270px;" style="left: 300px; top: 352px; font-size: 72px; font-weight: 700;">patients first</h1>


            <div class="ls-btn ls-l  " style="top: 50%; left: 75%;">
                <img src="assets/img/self_images/sample (1).png" class="img-fluid last_image_cid" alt="">
            </div>

            <div class="ls-btn ls-l ls-responsive " data-ls-mobile="left: 100px; top: 500px;" data-ls-tablet="left: 100px; top: 500px;" data-ls-laptop="left: 100px;" style="left: 300px; top: 582px;" data-ls="offsetyin: 200; durationin: 2000; delayin: 1400; offsetyout: 300; durationout: 2000; durationout: 2000; ">
                <a href="services.php" class="vs-btn style2">Know More<i class="fas fa-bolt"></i></a>
            </div>
        </div>

        <div class="ls-slide orange-slide">
            <h1 class="slider_main_text ls-l ls-responsive orange-slide-anim" data-ls-mobile="left: 100px; top: 230px;" data-ls-tablet="left: 100px; top: 230px;" data-ls-laptop="left: 100px; top: 180px;" style="left: 300px; top: 270px; font-size: 72px; font-weight: 700;">We always put the</h1>
            <h1 class="slider_main_text ls-l ls-responsive orange-slide-anim" data-ls-mobile="left: 100px; top: 340px;" data-ls-tablet="left: 100px; top: 340px;" data-ls-laptop="left: 100px; top: 270px;" style="left: 300px; top: 352px; font-size: 72px; font-weight: 700;">patients first</h1>


            <div class="ls-btn ls-l  " style="top: 50%; left: 75%;">
                <img src="assets/img/self_images/sample (2).png" class="img-fluid last_image_cid" alt="">
            </div>

            <div class="ls-btn ls-l ls-responsive " data-ls-mobile="left: 100px; top: 500px;" data-ls-tablet="left: 100px; top: 500px;" data-ls-laptop="left: 100px;" style="left: 300px; top: 582px;" data-ls="offsetyin: 200; durationin: 2000; delayin: 1400; offsetyout: 300; durationout: 2000; durationout: 2000; ">
                <a href="services.php" class="vs-btn style2">Know More<i class="fas fa-bolt"></i></a>
            </div>
        </div>

        <div class="ls-slide orange-slide">

            <h1 class="slider_main_text ls-l ls-responsive orange-slide-anim" data-ls-mobile="left: 100px; top: 230px;" data-ls-tablet="left: 100px; top: 230px;" data-ls-laptop="left: 100px; top: 180px;" style="left: 300px; top: 270px; font-size: 72px; font-weight: 700;">We always put the</h1>
            <h1 class="slider_main_text ls-l ls-responsive orange-slide-anim" data-ls-mobile="left: 100px; top: 340px;" data-ls-tablet="left: 100px; top: 340px;" data-ls-laptop="left: 100px; top: 270px;" style="left: 300px; top: 352px; font-size: 72px; font-weight: 700;">patients first</h1>


            <div class="ls-btn ls-l  image_topper_dive " style="top: 50%; left: 75%;">
                <img src="assets/img/self_images/sample (3).png" class="img-fluid last_image_cid" alt="">
            </div>

            <div class="ls-btn ls-l ls-responsive " data-ls-mobile="left: 100px; top: 500px;" data-ls-tablet="left: 100px; top: 500px;" data-ls-laptop="left: 100px;" style="left: 300px; top: 582px;" data-ls="offsetyin: 200; durationin: 2000; delayin: 1400; offsetyout: 300; durationout: 2000; durationout: 2000; ">
                <a href="services.php" class="vs-btn style2">Know More<i class="fas fa-bolt"></i></a>
            </div>

        </div>

    </div>


    <script>
        // For h1 animation (title/subtitle)
        document.querySelectorAll('.orange-slide-anim').forEach(el => {
            el.setAttribute('data-ls',
                'delayin: 600; easingin: easeInOutSine; texttransitionin: true; textstartatin: transitioninstart; textdurationin: 2000; texttypein: words_asc; textshiftin: 200; textoffsetyin: -100; offsetyout: -100; durationout: 2000;'
            );
        });

        // For slide container animation
        document.querySelectorAll('.orange-slide').forEach(el => {
            el.setAttribute('data-ls', 'duration: 13000; transition2d: 5;');
        });
    </script>


</section> 






<?php include 'chat_bot.php';  ?>




<?php include 'footer.php';  ?>