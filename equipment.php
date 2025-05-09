<?php include 'navbar.php';  ?>



<div id="overlay" class="overlay"></div>
<button id="restaurant-icon" class="restaurant-icon">🍽</button>
<div id="sidebar" class="sidebar side_view">
    <h1 class="side_bar_tittle">Restaurants 🍽</h1>
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
            name: "Dominos",
            link: "./business_layout.php"
        },
        {
            name: "PizzaHut",
            link: "./business_layout.php"
        },
        {
            name: "KFC",
            link: "./business_layout.php"
        },
        {
            name: "MC donald's",
            link: "./business_layout.php"
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










<section class="bg_section responsive_section">
    <div class="container ">
        <h1 class="text-center gradient_text_color spacing_for_htag">
            Welcome to The FitGear Hub – Gym & Fitness Essentials</h1>
        <h5 class="text-center">Build Your Dream Gym at Home or Studio</h5>

        <div class="row">

            <?php include 'left_side_ads.php'; ?>

            <div class="col-lg-8 col-12">
                <div class="row">
                    <div class="col-md-8 col-12">





                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="assets\img\service _inside_images\fitness1.png" class="  img-fluid  d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="assets\img\service _inside_images\accessries1.png" class="img-fluid d-block w-100" alt="...">
                                </div>
                                <!-- <div class="carousel-item">
                                    <img src="assets\img\service _inside_images\hospital8.png" class="img-fluid  d-block w-100" alt="...">
                                </div> -->
                            </div>
                        </div>


                    </div>
                    <div class="col-md-4 col-12 p-3">
                        <div class="product-content">
                            <h3>FitGear Hub</h3>
                            <p class="product-title h5 mt-1">Professional-Grade Fitness Equipment</p>

                            <div class="rating-wrap">
                                <div class="star-rating " role="img" aria-label="Rated 5.00 out of 5"><span
                                        style="width:100%">Rated <strong class="rating">5.00</strong> out of
                                        5</span></div>
                            </div>

                            <!-- <span class="price">$120.00</span> -->
                        </div>
                    </div>
                </div>
                <div class="row my-5 p-3">
                    <div class="col-md-8 col-12 ">
                        <h6>
                        FitGear Hub is your one-stop destination for high-quality gym and fitness equipment. Whether you're setting up a personal home gym or managing a commercial fitness center, we provide the best tools to meet your workout needs. From cardio machines to strength training gear, each product is built for performance, durability, and comfort. We cater to fitness enthusiasts, athletes, and professionals who value health and strength.

                        </h6>


                    </div>












                    <div class="col-md-4 col-12  ">
                        <h3 class="text-center">Menu</h3>
                        <div class="menu-container">
                            <div class="menu-item">
                                <span class="food-name">Flat Weight Bench</span>
                                <span class="price">₹3800</span>
                            </div>
                            <div class="menu-item">
                                <span class="food-name">
                                Spin Bike (Indoor Cycle) </span>
                                <span class="price"> ₹20,000</span>
                            </div>
                            <div class="menu-item">
                                <span class="food-name">
                                Elliptical Cross Trainer</span>
                                <span class="price"> ₹22,000</span>
                            </div>
                            <div class="menu-item">
                                <span class="food-name">
                                Multi-Function Home Gym Station</span>
                                <span class="price"> ₹32,000
                                </span>
                            </div>
                            <div class="menu-item">
                                <span class="food-name">Pull-up Bar (Wall Mounted)</span>
                                <span class="price">₹1,500</span>
                            </div>

                            <!-- <div class="menu-item">
                                <span class="food-name">
                                Camping Chair</span>
                                <span class="price"> ₹1,000 </span>
                            </div>
                            <div class="menu-item">
                                <span class="food-name">
                                Headlamp/Flashlight</span>
                                <span class="price"> ₹1,000</span>
                            </div>
                            <div class="menu-item">
                                <span class="food-name">
                                Cookware Set </span>
                                <span class="price"> ₹1,000</span>
                            </div> -->
                        </div>



                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-8 col-12">
                        <div class="review-container">
                            <h2>Customer Reviews</h2>




                            <!-- <div class="review">
                                    <div class="review-header">
                                        <img src="assets/img/test/boy11.png" alt="User" class="profile-img">
                                        <div class="">
                                            <p><strong>David M</strong></p>
                                            <p class="stars">⭐⭐⭐⭐</p>
                                        </div>
                                    </div>
                                    <p class="review-text">
                                        "A top-notch restaurant with a warm and inviting atmosphere. The wine selection was impressive, and the.
                                        <span class="hidden-text">chef’s special was divine. Will definitely be coming back!"</span>
                                    </p>
                                    <p class="view-more" onclick="toggleText(this)">Read More</p>
                                    <p class="view-images" onclick="toggleImages(this)">View Images</p>
                                    <div class="review-images">
                                        <img src="assets/img/review3.jpg" alt="Review Image"
                                            onclick="openLightbox(this)">
                                    </div>
                                </div> -->


                            <!-- <div class="review">
                                    <div class="review-header">
                                        <img src="assets/img/test/woman.png" alt="User" class="profile-img">
                                        <div class="">
                                            <p><strong> Sophia L.</strong></p>
                                            <p class="stars">⭐⭐⭐⭐⭐</p>
                                        </div>
                                    </div>
                                    <p class="review-text">
                                        "The food was amazing, especially the wood-fired pizza and seafood platter! However, the service was a
                                        <span class="hidden-text">little slow during peak hours. Overall, a great place for a relaxed meal."</span>
                                    </p>
                                    <p class="view-more" onclick="toggleText(this)">Read More</p>
                                    <p class="view-images" onclick="toggleImages(this)">View Images</p>
                                    <div class="review-images">
                                        <img src="assets/img/test/1.png" alt="Review Image"
                                            onclick="openLightbox(this)">
                                        <img src="assets/img/test/2.png" alt="Review Image"
                                            onclick="openLightbox(this)">
                                    </div>
                                </div>   -->
                        </div>

                        <!-- Lightbox for Image Popup -->
                        <div class="lightbox" id="lightbox">
                            <span class="close" onclick="closeLightbox()">&times;</span>
                            <img id="lightbox-img" src="">
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

            <?php include 'right_side_ads.php'; ?>



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