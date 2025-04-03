<?php include 'navbar.php'; ?>
<?php include './db.connection/db_connection.php'; ?>

<?php
$travel_id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

$query = "SELECT * FROM travel_details WHERE travel_id = '$travel_id'";
$result = mysqli_query($conn, $query);
?>

<h1 class="text-center my-4">Available Travel Options</h1>

<div class="container">
    <div class="row">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $model = $row['model'] ?? '';
                $seating = $row['seating_capacity'] ?? '';
                $mileage = $row['fuel_efficiency'] ?? '';
                $price_per_6hrs = $row['price_per_6hrs'] ?? '';
                $driver_name = $row['name'] ?? '';
                $driver_age = $row['age'] ?? '';
                $driver_gender = $row['gender'] ?? '';
                $experience = $row['experience'] ?? '';
                $image = !empty($row['image']) ? "./admin/uploads/travels/" . $row['image'] : '';

                echo '<div class="col-12 col-md-4 mb-4">
                    <div class="card shadow border-0 travel-card">';

                if (!empty($image)) {
                    echo '<img src="' . htmlspecialchars($image) . '" class="card-img-top img-fluid" alt="' . htmlspecialchars($model) . '">';
                }

                echo '<div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($model) . '</h5>';

                if (!empty($seating)) echo '<p><strong>Seating:</strong> ' . htmlspecialchars($seating) . '</p>';
                if (!empty($mileage)) echo '<p><strong>Fuel Efficiency:</strong> ' . htmlspecialchars($mileage) . ' Km/L</p>';
                if (!empty($price_per_6hrs)) echo '<p><strong>Price (6hrs):</strong> ' . htmlspecialchars($price_per_6hrs) . '</p>';

                echo '<hr><h6>Driver Details:</h6>';
                if (!empty($driver_name)) echo '<p><strong>Name:</strong> ' . htmlspecialchars($driver_name) . '</p>';
                if (!empty($driver_age)) echo '<p><strong>Age:</strong> ' . htmlspecialchars($driver_age) . '</p>';
                if (!empty($driver_gender)) echo '<p><strong>Gender:</strong> ' . htmlspecialchars($driver_gender) . '</p>';
                if (!empty($experience)) echo '<p><strong>Experience:</strong> ' . htmlspecialchars($experience) . ' Years</p>';

                echo '<button class="btn btn-primary book_now_btn mt-2 px-4" 
                            data-bs-toggle="modal" 
                            data-bs-target="#bookingModal"
                            data-model="' . htmlspecialchars($model) . '"
                            data-price="' . htmlspecialchars($price_per_6hrs) . '">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>';
            }
        } else {
            echo '<div class="col-12"><p class="text-center">No details found for this travel destination.</p></div>';
        }
        ?>
    </div>
</div>


<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Book Your Ride</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="travelform.php" method="POST">
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
                    <div class="mb-3">
                        <label for="vehicle_model" class="form-label">Vehicle Model</label>
                        <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="vehicle_price" class="form-label">Price (6hrs)</label>
                        <input type="text" class="form-control" id="vehicle_price" name="vehicle_price" readonly>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Submit Booking</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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
