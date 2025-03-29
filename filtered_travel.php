<?php include 'navbar.php'; ?>
<?php include './db.connection/db_connection.php'; ?>

<?php
// Get filter value from URL
$filter = isset($_GET['filter']) ? mysqli_real_escape_string($conn, $_GET['filter']) : '';

// Fetch records based on filter
$query = "SELECT * FROM travels WHERE type = '$filter'";
$result = mysqli_query($conn, $query);
?>

<h1 class="text-center my-4">Available <?php echo ucfirst($filter); ?> </h1>
<div class="container">
    <div class="row">
        <?php
        if (isset($_GET['filter'])) {
            $filter = mysqli_real_escape_string($conn, $_GET['filter']);

            // Fetch filtered travel records
            $query = "SELECT * FROM travels WHERE type = '$filter'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $model = $row['model'] ?? 'N/A';
                    $seating = $row['seating_capacity'] ?? 'N/A';
                    $mileage = $row['fuel_efficiency'] ?? 'N/A';
                    $price = $row['price'] ?? 'N/A';
                    
                    // Dynamically generate image path
                    $image = !empty($row['image']) ? "./admin/uploads/travels/" . $row['image'] : "./admin/uploads/travels/default.png";

                    echo '
                    <div class="col-12 col-md-3">
                        <a href="rental.php?id=' . $id . '">
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
                                        <p class="cast_names">' . htmlspecialchars($mileage) . '  Km </p>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="movie-label"><strong>Price :</strong></p>
                                        <p class="cast_names">' . htmlspecialchars($price) . ' / 24 hrs</p>
                                    </div>

                                    <div class="d-flex justify-content-center mt-3">
                                        <a href="#" class="btn btn-primary book_now_btn px-4 py-2">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>';
                }
            } else {
                echo '<div class="col-12"><p class="text-center">No results found for this filter.</p></div>';
            }
        } else {
            echo '<div class="col-12"><p class="text-center">No filter applied.</p></div>';
        }
        ?>
    </div>
</div>

<?php include 'chat_bot.php'; ?>
<?php include 'footer.php'; ?>
