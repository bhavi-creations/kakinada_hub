<?php include 'navbar.php'; ?>
<?php include 'travel_sidebar.php'; ?>


<?php include './db.connection/db_connection.php'; ?>

<?php
$travel_id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

$query = "SELECT * FROM travel_details WHERE travel_id = '$travel_id'";
$result = mysqli_query($conn, $query);
?>




<section class="bg_section responsive_section">
    <div class="container ">
    <!-- <h1 class="text-center gradient_text_color spacing_for_htag">Available Travel Options</h1> -->



        <div class="row py-5">

            <div class="col-lg-2  col-12 text_side_div d-none d-lg-block">
                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid side_dive_images">
                <img src="assets/img/test/animation.gif" alt="Animated GIF" class=" my-4 side_dive_images">
                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid  side_dive_images">
            </div>



            <div class="col-lg-8 col-12">

                <div class="row">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $model = $row['model'] ?? '';
                            $seating = $row['seating_capacity'] ?? '';
                            $mileage = $row['fuel_efficiency'] ?? '';
                            $price = $row['price'] ?? '';
                            $price_per_6hrs = $row['price_per_6hrs'] ?? '';
                            $driver_name = $row['name'] ?? '';
                            $driver_age = $row['age'] ?? '';
                            $driver_gender = $row['gender'] ?? '';
                            $experience = $row['experience'] ?? '';
                            $image = !empty($row['image']) ? "./admin/uploads/travels/" . $row['image'] : '';

                            echo '<div class="col-12 col-md-4">
                    <div class="rental-card p-3 border rounded shadow">';

                            if (!empty($image)) {
                                echo '<img src="' . htmlspecialchars($image) . '" class="car_image img-fluid" alt="' . htmlspecialchars($model) . '">';
                            }

                            echo '<div class="product-content mt-3">';

                            // Car Details
                            if (!empty($model) || !empty($seating) || !empty($mileage) || !empty($price)) {
                                // echo '<h5 class="text-primary heading-gradient">Car Details</h5>';

                                if (!empty($model)) {
                                    echo '<div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Model :</strong></p>
                                <p class="cast_names">' . htmlspecialchars($model) . '</p>
                              </div>';
                                }

                                if (!empty($seating)) {
                                    echo '<div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Seating :</strong></p>
                                <p class="cast_names">' . htmlspecialchars($seating) . '</p>
                              </div>';
                                }
                                if (!empty($price)) {
                                    echo '<div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Price :</strong></p>
                                <p class="cast_names">₹' . htmlspecialchars($price) . ' / 12hrs</p>
                              </div>';
                                }
                                if (!empty($mileage)) {
                                    echo '<div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>1 Liter :</strong></p>
                                <p class="cast_names">' . htmlspecialchars($mileage) . ' Km</p>
                              </div>';
                                }

                                if (!empty($price_per_6hrs)) {
                                    echo '<div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Price :</strong></p>
                                <p class="cast_names">' . htmlspecialchars($price_per_6hrs) . ' / 6 hrs</p>
                              </div>';
                                }
                            }

                            // Driver Details
                            if (!empty($driver_name) || !empty($price_per_6hrs) || !empty($experience) || !empty($driver_age) || !empty($driver_gender)) {
                                // echo '<h5 class=" heading-gradient mt-3">Driver Details</h5>';

                                if (!empty($driver_name)) {
                                    echo '<div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Name :</strong></p>
                                <p class="cast_names">' . htmlspecialchars($driver_name) . '</p>
                              </div>';
                                }

                            

                                if (!empty($driver_age)) {
                                    echo '<div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Age :</strong></p>
                                <p class="cast_names">' . htmlspecialchars($driver_age) . '</p>
                              </div>';
                                }


                                if (!empty($experience)) {
                                    echo '<div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Experience :</strong></p>
                                <p class="cast_names">' . htmlspecialchars($experience) . ' Years</p>
                              </div>';
                                }

                               
                                if (!empty($driver_gender)) {
                                    echo '<div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Gender :</strong></p>
                                <p class="cast_names">' . htmlspecialchars($driver_gender) . '</p>
                              </div>';
                                }
                            }
                            if (!empty($price_per_6hrs)) {
                                echo '<div class="d-flex justify-content-between align-items-center">
                            <p class="movie-label"><strong>Price :</strong></p>
                            <p class="cast_names"> ₹' . htmlspecialchars($price_per_6hrs) . ' /6 hrs</p>
                          </div>';
                            }

                            echo '<div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-primary book_now_btn px-4 py-2" data-bs-toggle="modal" 
                            data-bs-target="#bookingModal" 
                            data-model="' . htmlspecialchars($model) . '" 
                            data-price="' . htmlspecialchars($price_per_6hrs) . '">
                            Book Now
                        </button>
                      </div>';

                            echo '</div></div></div>';
                        }
                    } else {
                        echo '<div class="col-12"><p class="text-center">No details found for this travel destination.</p></div>';
                    }
                    ?>
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





<!-- Booking Modal -->
<div class="modal fade   " id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="travel_model_body">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Book Your Ride</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form action="travelform.php" role="form" class="php-email-form p-5 " method="POST">





                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="customer_email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                    </div>

                    <div class="mb-3">
                        <label for="customer_phone" class="form-label">Your Phone</label>
                        <input type="text" class="form-control" id="customer_phone" name="customer_phone" required>
                    </div>



                    <div class="form-btn pt-15  col-xl-12 text-center">
                        <button class="vs-btn style2">Submit Booking<i class="fas fa-chevron-right"></i></button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Pass car details to modal fields
    document.querySelectorAll(".book_now_btn").forEach(button => {
        button.addEventListener("click", function() {
            let model = this.getAttribute("data-model");
            let price = this.getAttribute("data-price");

            document.getElementById("vehicle_model").value = model;
            document.getElementById("vehicle_price").value = price;
        });
    });
</script>

<?php include 'chat_bot.php'; ?>
<?php include 'footer.php'; ?>