<?php include 'navbar.php'; ?>
<?php include './db.connection/db_connection.php'; ?>

<?php
$filter = isset($_GET['filter']) ? mysqli_real_escape_string($conn, $_GET['filter']) : '';

$query = "SELECT * FROM travels WHERE type = '$filter'";
$result = mysqli_query($conn, $query);
?>

<h1 class="text-center my-4">Available <?php echo ucfirst($filter); ?> </h1>
<div class="container">
    <div class="row">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $model = $row['model'] ?? 'N/A';
                $seating = $row['seating_capacity'] ?? 'N/A';
                $mileage = $row['fuel_efficiency'] ?? 'N/A';
                $price = $row['price'] ?? 'N/A';
                $image = !empty($row['image']) ? "./admin/uploads/travels/" . $row['image'] : "./admin/uploads/travels/default.png";

                echo '
                <div class="col-12 col-md-3">
                    <div class="rental-card p-3 border rounded shadow">
                        <img src="' . $image . '" class="car_image img-fluid" alt="' . htmlspecialchars($model) . '">

                        <div class="product-content mt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Model :</strong></p>
                                <p class="cast_names">' . htmlspecialchars($model) . '</p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Seating :</strong></p>
                                <p class="cast_names">' . htmlspecialchars($seating) . '</p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>1 Liter :</strong></p>
                                <p class="cast_names">' . htmlspecialchars($mileage) . ' Km</p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <p class="movie-label"><strong>Price :</strong></p>
                                <p class="cast_names">' . htmlspecialchars($price) . ' / 24 hrs</p>
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                <button class="btn btn-primary book_now_btn px-4 py-2" data-bs-toggle="modal" data-bs-target="#bookingModal" 
                                    data-model="' . htmlspecialchars($model) . '" 
                                    data-price="' . htmlspecialchars($price) . '">Book Now</button>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<div class="col-12"><p class="text-center">No results found for this filter.</p></div>';
        }
        ?>
    </div>
</div>

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