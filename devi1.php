<?php include 'navbar.php';  ?>



<?php include 'moviesidebar.php';  ?>











<section>
    <div class="container">

        <div class="text-center   mb-5">
            <h1> screen name</h1>

        </div>
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="row">

                    <div class="col-md-8 col-12 my-2">


                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="assets/img/self_images/chhaava (1).png" class="  img-fluid  d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="assets/img/self_images/chhaava (2).png" class="  img-fluid  d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="assets/img/self_images/chhaava (3).png" class="  img-fluid  d-block w-100" alt="...">
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="col-md-4 col-12  my-2 movie_title_card">

                        <div class="product-content">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Title:</strong></p>
                                <h3 class="movie-value">Chhaava</h3>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Rating:</strong></p>
                                <p class="movie-value">⭐⭐⭐⭐⭐ 5/5</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Genre:</strong></p>
                                <p class="movie-value">Historical Drama</p>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="row my-5 p-3">
                    <div class="col-md-8 col-12 ">
                        <h2>About the movie</h2>
                        <h6>
                            After Chhatrapati Shivaji Maharaj`s death, the Mughals aim to expand into the Deccan, only to face his fearless son, Chhatrapati Sambhaji Maharaj. Chhaava, inspired by Shivaji Sawant`s novel, chronicles Chhatrapati Sambhaji Maharaj`s unwavering resistance against Aurangzeb, marked by courage, strategy, and betrayal.

                        </h6>
                    </div>
                    <div class="col-md-4 col-12  ">
                        <h3 class="text-center">Cast</h3>

                        <div class="product-content">

                            <div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Actor : </strong></p>
                                <p class="cast_names">Vicky Kaushal</p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Actor : </strong></p>
                                <p class="cast_names">Rashmika Mandanna </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Actor : </strong></p>
                                <p class="cast_names">Akshaye Khanna </p>
                            </div>

                        </div>



                        <hr>

                        <h3 class="text-center">Crew</h3>

                        <div class="product-content">

                            <div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Director : </strong></p>
                                <p class="cast_names">Laxman Utekar</p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Producer : </strong></p>
                                <p class="cast_names">Dinesh Vijan </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Musician : </strong></p>
                                <p class="cast_names">A. R. Rahman </p>
                            </div>

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