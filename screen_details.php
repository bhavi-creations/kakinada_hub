<?php
include 'navbar.php';
include 'moviesidebar.php';
include './db.connection/db_connection.php';


// Fetch movie details dynamically based on screen_id
$screen_id = isset($_GET['screen_id']) ? intval($_GET['screen_id']) : 1; // Default to screen 1
$query = "SELECT * FROM movies WHERE screen_id = $screen_id LIMIT 1";
$result = mysqli_query($conn, $query);
$movie = mysqli_fetch_assoc($result);
?>

<section class="bg_section responsive_section">
    <div class="container ">
        <?php
        // Fetch screen name from screens table
        $screen_query = "SELECT screen_name FROM screens WHERE id = $screen_id LIMIT 1";
        $screen_result = mysqli_query($conn, $screen_query);
        $screen = mysqli_fetch_assoc($screen_result);
        ?>
        <h1 class="text-center gradient_text_color spacing_for_htag"><?php echo htmlspecialchars($screen['screen_name']); ?></h1>
        
    

        <div class="row">

            <div class="col-lg-2  col-12 text_side_div d-none d-lg-block">

                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid side_dive_images">

                <img src="assets/img/test/animation.gif" alt="Animated GIF" class=" my-4 side_dive_images">

                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid  side_dive_images">
            </div>

            <div class="col-lg-8 col-12">
                <div class="row  scrollable-list">

                    <div class="row scrollable-list">
                        <div class="col-md-8 col-12 my-2">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    $images = explode(',', $movie['images']); // Assuming images are stored as comma-separated values
                                    foreach ($images as $index => $image) {
                                        $active = $index === 0 ? 'active' : '';
                                        echo "<div class='carousel-item  $active'>
                                            <img src='./admin/uploads/movies/$image' class='img-fluid     ' alt='Movie Image'>
                                          </div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 my-2 movie_title_card ">
                            <div class="product-content">

                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Title:</strong></p>
                                    <h3 class="movie-value"><?php echo htmlspecialchars($movie['movie_name']); ?></h3>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Duration:</strong></p>
                                    <p class="movie-value"><?php echo htmlspecialchars($movie['duration']); ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Rating:</strong></p>
                                    <p class="movie-value">
                                        <?php
                                        $rating = intval($movie['rating']); // Convert rating to integer
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<i class="fas fa-star text-warning"></i>'; // Filled star
                                            } else {
                                                echo '<i class="far fa-star text-warning"></i>'; // Empty star
                                            }
                                        }
                                        ?>
                                        (<?php echo htmlspecialchars($movie['rating']); ?>/5)
                                    </p>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Genre:</strong></p>
                                    <p class="movie-value"><?php echo htmlspecialchars($movie['genre']); ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Language:</strong></p>
                                    <p class="movie-value"><?php echo htmlspecialchars($movie['language']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-5 p-3 ">
                        <div class="col-md-8 col-12">
                            <h2 class="heading-gradient">About the movie</h2>
                            <p class="p-gradient"><?php echo htmlspecialchars($movie['about_movie']); ?></p>
                        </div>
                        <div class="col-md-4 col-12">
                            <h3 class="text-center heading-gradient">Cast</h3>
                            <div class="product-content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Hero:</strong></p>
                                    <p class="cast_names"><?php echo htmlspecialchars($movie['hero']); ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Heroin:</strong></p>
                                    <p class="cast_names"><?php echo htmlspecialchars($movie['heroin']); ?></p>
                                </div>
                            </div>
                            <hr>
                            <h3 class="text-center heading-gradient">Crew</h3>
                            <div class="product-content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Director:</strong></p>
                                    <p class="cast_names"><?php echo htmlspecialchars($movie['director']); ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Producer:</strong></p>
                                    <p class="cast_names"><?php echo htmlspecialchars($movie['producer']); ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="movie-label"><strong>Musician:</strong></p>
                                    <p class="cast_names"><?php echo htmlspecialchars($movie['musician']); ?></p>
                                </div>
                            </div>
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


            <div class="col-lg-2  col-12 text_side_div d-none d-lg-block">

                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid side_dive_images">

                <img src="assets/img/test/animation.gif" alt="Animated GIF" class=" my-4 side_dive_images">

                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid  side_dive_images">
            </div>


        </div>
    </div>
</section>

<?php include 'chat_bot.php';  ?>
<?php include 'footer.php';  ?>