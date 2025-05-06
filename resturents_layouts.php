<?php include 'navbar.php';  ?>



<div id="overlay" class="overlay"></div>
<button id="restaurant-icon" class="restaurant-icon">🍽</button>
<div id="sidebar" class="sidebar side_view">
    <h1 class="side_bar_tittle"><a href="resturents_layouts.php"> Restaurants 🍽</a></h1>
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

        <div class="row">



            <?php include 'left_side_ads.php'; ?>



            <?php
           

            // 1. Check if ID is present
            if (!isset($_GET['id'])) {
                echo "<div class='alert alert-danger'>No restaurant ID specified.</div>";
                exit;
            }

            $id = intval($_GET['id']); // 2. Sanitize

            // 3. Fetch restaurant details
            $query = "SELECT * FROM restaurants WHERE id = $id";
            $result = mysqli_query($conn, $query);

            if (!$result || mysqli_num_rows($result) == 0) {
                echo "<div class='alert alert-danger'>Restaurant not found.</div>";
                exit;
            }

            $row = mysqli_fetch_assoc($result);

            // 4. Parse data
            $images = explode(',', $row['image_paths']);
            $food_names = explode(',', $row['food_names']);
            $prices = explode(',', $row['prices']);
            ?>

            <!-- 5. Display -->
            <div class="col-lg-8 col-12">
            <h1 class="text-center gradient_text_color spacing_for_htag">Welcome to <?= htmlspecialchars($row['name']) ?></h1>

                <div class="row">
                    <div class="col-md-8 col-12">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($images as $index => $image): ?>
                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                        <img src="admin/uploads/restaurants/<?= htmlspecialchars($image) ?>" class="img-fluid d-block w-100" alt="Restaurant Image">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12 p-3">
                        <div class="product-content">
                            <h3 class="heading-gradient"><?= htmlspecialchars($row['name']) ?></h3>
                            <p class="product-title h5 mt-1 p-gradient"><?= htmlspecialchars($row['tagline']) ?></p>

                            <div class="rating-wrap">
                                <div class="star-rating" role="img" aria-label="Rated <?= $row['star_rating'] ?> out of 5">
                                    <span style="width:<?= ($row['star_rating'] / 5) * 100 ?>%">
                                        Rated <strong class="rating"><?= $row['star_rating'] ?></strong> out of 5
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-5 p-3">
                    <div class="col-md-8 col-12">
                        <h6><?= nl2br(htmlspecialchars($row['about'])) ?></h6>
                    </div>

                    <div class="col-md-4 col-12">
                        <h3 class="text-center">Menu</h3>
                        <div class="menu-container">
                            <?php foreach ($food_names as $i => $food): ?>
                                <div class="menu-item">
                                    <span class="food-name"><?= htmlspecialchars($food) ?></span>
                                    <span class="price">$<?= isset($prices[$i]) ? htmlspecialchars($prices[$i]) : '0.00' ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>






            <?php include 'right_side_ads.php'; ?>








            <!-- Modal Structure -->
            <div id="mobileModal" class="mobile-modal-overlay">

                <div class="mobile-modal-content">
                    <!-- Close Button -->
                    <button class="close-btn" onclick="closeMobileModal()"
                        style="position: absolute; top: 5px; right: 10px; background: none; border: none; font-size: 24px; cursor: pointer;">×</button>

                    <!-- Carousel Starts Here -->
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/img/test/21.png" class="img-fluid d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/img/test/22.png" class="img-fluid d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/img/test/23.png" class="img-fluid d-block w-100" alt="...">
                            </div>
                        </div>
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