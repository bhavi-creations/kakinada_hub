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

<section>
    <div class="container">
        <?php
        // Fetch screen name from screens table
        $screen_query = "SELECT screen_name FROM screens WHERE id = $screen_id LIMIT 1";
        $screen_result = mysqli_query($conn, $screen_query);
        $screen = mysqli_fetch_assoc($screen_result);
        ?>
        <div class="text-center mb-5">
            <h1><?php echo htmlspecialchars($screen['screen_name']); ?></h1>
        </div>

        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="row">
                    <div class="col-md-8 col-12 my-2">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $images = explode(',', $movie['images']); // Assuming images are stored as comma-separated values
                                foreach ($images as $index => $image) {
                                    $active = $index === 0 ? 'active' : '';
                                    echo "<div class='carousel-item $active'>
                                            <img src='./admin/uploads/movies/$image' class='img-fluid d-block w-100' alt='Movie Image'>
                                          </div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 my-2 movie_title_card">
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
                <div class="row my-5 p-3">
                    <div class="col-md-8 col-12">
                        <h2>About the movie</h2>
                        <p><?php echo htmlspecialchars($movie['about_movie']); ?></p>
                    </div>
                    <div class="col-md-4 col-12">
                        <h3 class="text-center">Cast</h3>
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
                        <h3 class="text-center">Crew</h3>
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

                <div class="row p-3">
                    <div class="col-md-8 col-12">
                        <div class="review-container">
                            <h2>Customer Reviews</h2>

                            <div class="review">
                                <div class="review-header">
                                    <img src="assets/img/test/woman.png" alt="User" class="profile-img">
                                    <div class="">
                                        <p><strong>Emma R</strong></p>
                                        <p class="stars">⭐⭐⭐⭐⭐</p>
                                    </div>
                                </div>
                                <p class="review-text">
                                    "The ambiance was elegant, and the food was absolutely delicious! Every dish was beautifully presented, and the flavors were exceptional.
                                    <span class="hidden-text">The staff was courteous and attentive, making the experience even more enjoyable. Highly recommended!"</span>
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
                            </div>

                            <div class="review">
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
            <div class="col-lg-3 col-12 text_side_div d-none d-lg-block">
                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid">
                <img src="assets/img/test/animation.gif" alt="Animated GIF" class="mt-5">
                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid mt-5">
            </div>
        </div>
    </div>
</section>

<?php include 'chat_bot.php';  ?>
<?php include 'footer.php';  ?>