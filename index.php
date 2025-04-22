<!-- <div class="color-stripe-bar"></div> -->




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
<!-- 
<section class="marquee-section">
    <div class="marquee-content">
        <marquee behavior="scroll" direction="left" class="marquee">
            <?php echo $marquee_content; ?>
        </marquee>
    </div>
</section> -->

<?php include 'navbar.php';  ?>






<section class=" bg_section   ">
    <div class="container text-center main_div_container">

        <div class="    d-md-none    pt-5 first_dive_image_top_div_robot">
            <img src="assets/img/self_images/robot_bg.png" class="img-fluid" alt="">
        </div>

        <div class="row justify-content-between align-items-center equal-divs pt-5 position-relative">



            <!-- Left Text -->
            <div class="col-5 col-md-4 first_side_div_image   order-md-0">
                <h6 class="white_coor_text">
                    GROW WITH US
                </h6>
                <p class="white_coor_text">Showcase your business to a growing local audience.
                    Connect with real customers looking ...</p>
                <button
                    class="gradient_color_btn client"
                    data-bs-toggle="modal"
                    data-bs-target="#customModal"
                    data-title="GROW WITH US"
                    data-description="Showcase your business to a growing local audience.
                    Connect with real customers looking for products and services like yours.
               F     Get support, visibility, and tools to grow — all in one platform"
                    data-img="assets/img/self_images/robot_bg.png">
                    Read More
                </button>
            </div>

            <!-- Center Image -->
            <div class="  col-md-4  d-none d-md-block center_side_div_image tab_images_space order-0  order-md-1">
                <img src="assets/img/self_images/robot_bg.png" class="img-fluid" alt="">
            </div>

            <!-- Horizontal and Vertical Lines -->
            <div class="horizontal_line_between_left d-none d-md-block "></div>
            <!-- <div class="d-flex vertical_line_left"></div> -->

            <div class="horizontal_line_between_right  d-none d-md-block "></div>
            <!-- <div class="vertical_line_right"></div> -->

            <!-- Right Text -->
            <div class="col-5 col-md-4 last_side_div_image     order-md-2">
                <h2 class="white_coor_text">GET YOU SOLUTION HERE</h2>
                <p class="white_coor_text">Discover trusted local businesses right at your fingertips...</p>
                <button
                    class="gradient_color_btn coustmer"
                    data-bs-toggle="modal"
                    data-bs-target="#customModal"
                    data-title="GET YOU SOLUTION HERE"
                    data-description="Discover trusted local businesses right at your fingertips.
                Find exactly what you need, when you need it — fast and easy.
                Enjoy a seamless experience backed by quality and community trust
                customers"
                    data-img="assets/img/self_images/robot_bg.png">
                    Read More
                </button>
            </div>

        </div>










        <div class="row">


            <div class="col-12 col-md-5  gradient-border-wrapper ">
                <div class="row  border_styles_home">
                    <div class="col-6 col-md-4">
                        <img src="assets/img/self_images/mini_mask_man.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-6 col-md-8 inner_div_index">
                        <h1 class="logo_title_color">1000+</h1>
                        <h4 class="white_coor_text">TRAFFIC</h4>
                        <p class="white_coor_text"> Join the brands already hitting 1000+ traffic with proven methods
                        </p>
                    </div>
                </div>
            </div>


            <div class="col-12 col-md-5  art_and_design">
                <h2 class="white_coor_text">Trusted. Local. Easy</h2>
                <p class="white_coor_text">Connecting Businesses with a Growing Audience, Every Day.
                    connectuion </p>

            </div>

            <div class="col-12  col-md-2 gradient-border-wrapper-last ">
                <div class="row  ">
                    <div class="border_styles_home_last">


                        <h1 class="logo_title_color"> 500+ </h1>
                        <h5 class="white_coor_text">Supporting vendors </h5>
                    </div>
                </div>
            </div>

        </div>

    </div>



    <div class="modal fade" id="customModal" tabindex="-1" aria-labelledby="customModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content filter_section  ">

                <div class="modal-body d-flex flex-column flex-md-row align-items-center">
                    <div class="modal-img pe-md-4 mb-3 mb-md-0">
                        <img id="modalImage" src="" alt="Modal Image" class="img-fluid rounded shadow" style="max-width: 300px;">
                    </div>
                    <div class="modal-text">
                        <h5 class="modal-title heading-gradient" id="customModalLabel"></h5>
                        <p id="modalDescription" class="mb-0 p-gradient"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->




<script>
    const customModal = document.getElementById('customModal');

    customModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        const title = button.getAttribute('data-title');
        const description = button.getAttribute('data-description');
        const image = button.getAttribute('data-img');

        const modalTitle = customModal.querySelector('.modal-title');
        const modalDesc = customModal.querySelector('#modalDescription');
        const modalImg = customModal.querySelector('#modalImage');

        modalTitle.textContent = title;
        modalDesc.textContent = description;
        modalImg.src = image;
    });
</script>






<?php
include './db.connection/db_connection.php'; // Ensure the database connection is included

// Fetch offers items with type 'upper'
$sqlUpper = "SELECT * FROM offers WHERE type = 'upper' ORDER BY created_at DESC";
$resultUpper = $conn->query($sqlUpper);

// Fetch offers items with type 'lower'
$sqlLower = "SELECT * FROM offers WHERE type = 'lower' ORDER BY created_at DESC";
$resultLower = $conn->query($sqlLower);
?>




<section class="team-section-three space-md-bottom  bg_section    ">
    <!-- <section class="team-section-three space-md-bottom bg_image_for_shops  "> -->

    <div class="container-style6  ">
        <div class="title-area-three text-center wow fadeInUp offers_section_text" data-wow-delay="400ms">
            <span class="sub-title7 gradient_text_color">Offers </span>
        </div>

        <!-- Upper Type Swiper -->
        <div class="swiper-container swiper-container-upper team-slider  ">
            <div class="swiper-wrapper">
                <?php if ($resultUpper->num_rows > 0): ?>
                    <?php while ($row = $resultUpper->fetch_assoc()): ?>
                        <div class="swiper-slide">
                            <div class="gradient_card_wrapper">

                                <div class="card_border_styles">

                                    <div class="row">

                                        <div class="col-5 d-flex flex-column justify-content-center hr_line_side">
                                            <div class="gradient_border_wrapper ">
                                                <div class="img_border">
                                                    <img src="./admin/uploads/home_offers/<?php echo htmlspecialchars($row['image']); ?>" alt="">
                                                </div>
                                            </div>
                                        </div>






                                        <div class="col-7">

                                            <p class="brand_name gradient_text_color_orange_to_gold"><?php echo htmlspecialchars($row['title']); ?></p>

                                            <p class="brand_type gradient_text_color_orange_to_gold">⭐ <?php echo htmlspecialchars($row['offer']); ?></p>

                                            <button
                                                class="card_lrg_btn fold_btn wow fadeInUp"
                                                data-wow-delay="500ms"
                                                data-bs-toggle="modal"
                                                data-bs-target="#codeModal"
                                                data-code='&lt;div class="example  p-gradient"&gt;Your Code LN3U4O34ITBG3N&lt;/div&gt;'>
                                                Get Code
                                            </button>

                                            <p class="brand_special_discount gradient_text_color_orange_to_gold">
                                                <?php
                                                $text = htmlspecialchars($row['description']);
                                                echo (strlen($text) > 30) ? substr($text, 0, 27) . '...' : $text;
                                                ?>
                                            </p>
                                        </div>

                                    </div>
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
                            <div class="gradient_card_wrapper">

                                <div class="card_border_styles">
                                    <div class="row">

                                        <div class="col-5 d-flex flex-column justify-content-center hr_line_side">
                                            <div class="gradient_border_wrapper">
                                                <div class="img_border">
                                                    <img src="./admin/uploads/home_offers/<?php echo htmlspecialchars($row['image']); ?>" class="img-fluid" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-7">

                                            <p class="brand_name gradient_text_color_orange_to_gold"><?php echo htmlspecialchars($row['title']); ?></p>

                                            <p class="brand_type gradient_text_color_orange_to_gold">⭐ <?php echo htmlspecialchars($row['offer']); ?></p>

                                            <button
                                                class="card_lrg_btn fold_btn wow fadeInUp"
                                                data-wow-delay="500ms"
                                                data-bs-toggle="modal"
                                                data-bs-target="#codeModal"
                                                data-code='&lt;div class="example p-gradient"&gt;Your Code D3L5N5PDS979&lt;/div&gt;'>
                                                Get Code
                                            </button>

                                            <p class="brand_special_discount gradient_text_color_orange_to_gold">
                                                <?php
                                                $text = htmlspecialchars($row['description']);
                                                echo (strlen($text) > 30) ? substr($text, 0, 27) . '...' : $text;
                                                ?>
                                            </p>
                                        </div>

                                    </div>

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


    <!-- Code Reveal Modal -->
    <div class="modal fade" id="codeModal" tabindex="-1" aria-labelledby="codeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <h5 class="modal-title heading-gradient" id="codeModalLabel">Your Discount Code </h5>
                    <pre><code id="codeBlock" class="language-html"></code></pre>
                </div>
            </div>
        </div>
    </div>


    <script>
        const codeModal = document.getElementById('codeModal');

        codeModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const code = button.getAttribute('data-code');

            const codeBlock = codeModal.querySelector('#codeBlock');
            codeBlock.innerHTML = code;
        });
    </script>

</section>




<section class="vs-hero-wrapper position-relative slider-area  bg_section   ">
    <div class="bg-overlay "></div>
    <div class="vs-hero-carousel  " data-navprevnext="true" data-height="800" data-container="1900" data-slidertype="responsive">


        <div class="ls-slide" data-ls="duration: 13000; transition2d: 5;">
            <h1 class="slider_main_text ls-l ls-responsive" data-ls-mobile="left: 100px; top: 230px;" data-ls-tablet="left: 100px; top: 230px;" data-ls-laptop="left: 100px; top: 180px;" style="left: 300px; top: 270px; font-size: 72px; font-weight: 700;" data-ls="delayin: 600; easingin: easeInOutSine; texttransitionin: true; textstartatin: transitioninstart; textdurationin: 2000; texttypein: words_asc; textshiftin: 200; textoffsetyin: -100; offsetyout: -100; durationout: 2000; ">We always put the</h1>
            <h1 class="slider_main_text ls-l ls-responsive" data-ls-mobile="left: 100px; top: 340px;" data-ls-tablet="left: 100px; top: 340px;" data-ls-laptop="left: 100px; top: 270px;" style="left: 300px; top: 352px; font-size: 72px; font-weight: 700;" data-ls="delayin: 0; easingin: easeInOutSine; texttransitionin: true; textstartatin: transitioninstart; textdurationin: 2000; texttypein: words_asc; textshiftin: 200; textoffsetyin: -100; offsetyout: -100; durationout: 2000; ">patients first</h1>


            <div class="ls-btn ls-l  " style="top: 50%; left: 75%;">
                <img src="assets/img/self_images/sample (1).png" class="img-fluid last_image_cid" alt="">
            </div>

            <div class="ls-btn ls-l ls-responsive " data-ls-mobile="left: 100px; top: 500px;" data-ls-tablet="left: 100px; top: 500px;" data-ls-laptop="left: 100px;" style="left: 300px; top: 582px;" data-ls="offsetyin: 200; durationin: 2000; delayin: 1400; offsetyout: 300; durationout: 2000; durationout: 2000; ">
                <a href="service.php" class="vs-btn style2">View All Services<i class="fas fa-bolt"></i></a>
            </div>
        </div>
        <div class="ls-slide" data-ls="duration: 13000; transition2d: 5;">
            <h1 class="slider_main_text ls-l ls-responsive" data-ls-mobile="left: 100px; top: 230px;" data-ls-tablet="left: 100px; top: 230px;" data-ls-laptop="left: 100px; top: 180px;" style="left: 300px; top: 270px; font-size: 72px; font-weight: 700;" data-ls="delayin: 600; easingin: easeInOutSine; texttransitionin: true; textstartatin: transitioninstart; textdurationin: 2000; texttypein: words_asc; textshiftin: 200; textoffsetyin: -100; offsetyout: -100; durationout: 2000; ">We always put the</h1>
            <h1 class="slider_main_text ls-l ls-responsive" data-ls-mobile="left: 100px; top: 340px;" data-ls-tablet="left: 100px; top: 340px;" data-ls-laptop="left: 100px; top: 270px;" style="left: 300px; top: 352px; font-size: 72px; font-weight: 700;" data-ls="delayin: 0; easingin: easeInOutSine; texttransitionin: true; textstartatin: transitioninstart; textdurationin: 2000; texttypein: words_asc; textshiftin: 200; textoffsetyin: -100; offsetyout: -100; durationout: 2000; ">patients first</h1>


            <div class="ls-btn ls-l  " style="top: 50%; left: 75%;">
                <img src="assets/img/self_images/sample (2).png" class="img-fluid last_image_cid" alt="">
            </div>

            <div class="ls-btn ls-l ls-responsive " data-ls-mobile="left: 100px; top: 500px;" data-ls-tablet="left: 100px; top: 500px;" data-ls-laptop="left: 100px;" style="left: 300px; top: 582px;" data-ls="offsetyin: 200; durationin: 2000; delayin: 1400; offsetyout: 300; durationout: 2000; durationout: 2000; ">
                <a href="service.php" class="vs-btn style2">View All Services<i class="fas fa-bolt"></i></a>
            </div>
        </div>
        <div class="ls-slide" data-ls="duration: 13000; transition2d: 5;">
            <h1 class="slider_main_text ls-l ls-responsive" data-ls-mobile="left: 100px; top: 230px;" data-ls-tablet="left: 100px; top: 230px;" data-ls-laptop="left: 100px; top: 180px;" style="left: 300px; top: 270px; font-size: 72px; font-weight: 700;" data-ls="delayin: 600; easingin: easeInOutSine; texttransitionin: true; textstartatin: transitioninstart; textdurationin: 2000; texttypein: words_asc; textshiftin: 200; textoffsetyin: -100; offsetyout: -100; durationout: 2000; ">We always put the</h1>
            <h1 class="slider_main_text ls-l ls-responsive" data-ls-mobile="left: 100px; top: 340px;" data-ls-tablet="left: 100px; top: 340px;" data-ls-laptop="left: 100px; top: 270px;" style="left: 300px; top: 352px; font-size: 72px; font-weight: 700;" data-ls="delayin: 0; easingin: easeInOutSine; texttransitionin: true; textstartatin: transitioninstart; textdurationin: 2000; texttypein: words_asc; textshiftin: 200; textoffsetyin: -100; offsetyout: -100; durationout: 2000; ">patients first</h1>


            <div class="ls-btn ls-l  image_topper_dive " style="top: 50%; left: 75%;">
                <img src="assets/img/self_images/sample (3).png" class="img-fluid last_image_cid" alt="">
            </div>

            <div class="ls-btn ls-l ls-responsive " data-ls-mobile="left: 100px; top: 500px;" data-ls-tablet="left: 100px; top: 500px;" data-ls-laptop="left: 100px;" style="left: 300px; top: 582px;" data-ls="offsetyin: 200; durationin: 2000; delayin: 1400; offsetyout: 300; durationout: 2000; durationout: 2000; ">
                <a href="service.php" class="vs-btn style2">View All Services<i class="fas fa-bolt"></i></a>
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
            1200: {
                slidesPerView: 4
            },
            1024: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 2
            },
            0: {
                slidesPerView: 1
            }
        }
    });
</script>





<?php include 'chat_bot.php';  ?>




<?php include 'footer.php';  ?>