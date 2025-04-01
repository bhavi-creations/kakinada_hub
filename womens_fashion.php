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










<section>
    <div class="container">

        <div class="text-center   ">
            <h1>Welcome to The Woman Fashion</h1>
            <h5>Elevate Your Style with Trendy Women's Fashion</h5>
        </div>
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="row">
                    <div class="col-md-8 col-12">





                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="assets/img/test/wf1.png" class="  img-fluid  d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="assets/img/test/wf2.png" class="img-fluid d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="assets/img/test/wf3.png" class="img-fluid  d-block w-100" alt="...">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-4 col-12 p-3">
                        <div class="product-content">
                            <h3>The Woman Fashion</h3>
                            <p class="product-title h5 mt-1">Chic, Comfortable, and Timeless – Fashion for Every Woman</p>

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
                        Women's fashion is a dynamic and ever-evolving industry that allows women to express their individuality, creativity, and confidence. From classic pieces to contemporary trends, fashion is an essential aspect of every woman's daily life. Whether it’s a casual outing, a formal event, or a special occasion, there’s always something in fashion that fits perfectly.



                        </h6>
                        <h6>
                        Fashion is not just about following trends; it’s about choosing pieces that make a woman feel comfortable, empowered, and stylish. The clothing and accessories a woman chooses often reflect her personality, mood, and the environment she’s in, making fashion an essential form of self-expression.


                        </h6>
                    </div>












                    <div class="col-md-4 col-12  ">
                        <h3 class="text-center">Menu</h3>
                        <div class="menu-container">
                            <div class="menu-item">
                                <span class="food-name">Casual T-Shirts  </span>
                                <span class="price"> ₹500 to ₹1,500 </span>
                            </div>
                            <div class="menu-item">
                                <span class="food-name">Maxi Dresses  </span>
                                <span class="price"> ₹1,500 to ₹4,000</span>
                            </div>
                            <div class="menu-item">
                                <span class="food-name">Tailored Blazers </span>
                                <span class="price"> ₹2,000 to ₹6,000 </span>
                            </div>
                            <div class="menu-item">
                                <span class="food-name">Sarees (Traditional) </span>
                                <span class="price"> ₹1,500 to ₹15,000 </span>
                            </div>
                            <div class="menu-item">
                                <span class="food-name">Casual Sneakers </span>
                                <span class="price"> ₹1,000 to ₹3,500</span>
                            </div>

                            <div class="menu-item">
                                <span class="food-name">Flats and Sandals </span>
                                <span class="price">  ₹500 to ₹2,500</span>
                            </div>
                            <div class="menu-item">
                                <span class="food-name">Handbags  </span>
                                <span class="price"> ₹1,500 to ₹10,000 </span>
                            </div>
                            <div class="menu-item">
                                <span class="food-name">Sunglasses  </span>
                                <span class="price"> ₹1,000 to ₹4,000</span>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-8 col-12">
                        <div class="review-container">
                            <h2>Customer Reviews</h2>

                            <div class="review">
                                <div class="review-header">
                                    <img src="assets/img/test/woman.png" alt="User" class="profile-img">
                                    <div class="">
                                        <p><strong>rajesh R</strong></p>
                                        <p class="stars">⭐⭐⭐⭐⭐</p>
                                    </div>
                                </div>
                                <p class="review-text">
                                    "I love the variety of styles and the quality of clothing at affordable prices. .
                                    <span class="hidden-text">The maxi dress I bought was perfect for the wedding I attended!"</span>
                                </p>
                                <p class="view-more" onclick="toggleText(this)">Read More</p>
                                <p class="view-images" onclick="toggleImages(this)">View Images</p>
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
                                        <p><strong>David raj kumar M</strong></p>
                                        <p class="stars">⭐⭐⭐⭐</p>
                                    </div>
                                </div>
                                <p class="review-text">
                                The casual t-shirts and jeans collection is amazing. Super comfortable and stylish!
                                    <span class="hidden-text">Definitely worth the investment.</span>
                                </p>
                                <p class="view-more" onclick="toggleText(this)">Read More</p>
                                <p class="view-images" onclick="toggleImages(this)">View Images</p>
                                <div class="review-images">
                                    <img src="assets/img/review3.jpg" alt="Review Image"
                                        onclick="openLightbox(this)">
                                </div>
                            </div>


                            <div class="review">
                                <div class="review-header">
                                    <img src="assets/img/test/woman.png" alt="User" class="profile-img">
                                    <div class="">
                                        <p><strong> Sophia L.</strong></p>
                                        <p class="stars">⭐⭐⭐⭐⭐</p>
                                    </div>
                                </div>
                                <p class="review-text">
                                    "I bought a pair of wedges and a blazer from the store. Both are excellent in quality
                                    <span class="hidden-text">and make me feel so confident and fashionable"</span>
                                </p>
                                <p class="view-more" onclick="toggleText(this)">Read More</p>
                                <p class="view-images" onclick="toggleImages(this)">View Images</p>
                                <div class="review-images">
                                    <img src="assets/img/test/1.png" alt="Review Image"
                                        onclick="openLightbox(this)">
                                    <img src="assets/img/test/2.png" alt="Review Image"
                                        onclick="openLightbox(this)">
                                </div>
                            </div>

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
                                </div>


                                <div class="review">
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
                    <div class="col-md-4 col-12">
                        <div class="review-form">
                            <h2>Submit Your Review</h2>
                            <input type="text" id="name" placeholder="Your Name" required>
                            <select id="rating">
                                <option value="⭐">⭐</option>
                                <option value="⭐⭐">⭐⭐</option>
                                <option value="⭐⭐⭐">⭐⭐⭐</option>
                                <option value="⭐⭐⭐⭐">⭐⭐⭐⭐</option>
                                <option value="⭐⭐⭐⭐⭐" selected>⭐⭐⭐⭐⭐</option>
                            </select>
                            <textarea id="comment" rows="3" placeholder="Write a comment..." required></textarea>
                            <input type="file" id="imageUpload" accept="image/*">
                            <button onclick="submitReview()">Submit Review</button>
                        </div>
                    </div>

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