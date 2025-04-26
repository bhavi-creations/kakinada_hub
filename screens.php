<?php
include 'navbar.php';
include './db.connection/db_connection.php';
include 'moviesidebar.php';

// Get theater ID from URL
$theater_id = isset($_GET['theater_id']) ? intval($_GET['theater_id']) : 0;

// Fetch theater name dynamically
$theater_query = "SELECT name FROM theaters WHERE id = ?";
$stmt = mysqli_prepare($conn, $theater_query);
mysqli_stmt_bind_param($stmt, "i", $theater_id);
mysqli_stmt_execute($stmt);
$theater_result = mysqli_stmt_get_result($stmt);
$theater_row = mysqli_fetch_assoc($theater_result);
$theater_name = $theater_row ? htmlspecialchars($theater_row['name']) : "Unknown Theater";

// Fetch screens for the selected theater
$query = "SELECT id, screen_name, screen_image FROM screens WHERE theater_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $theater_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>


<section class="bg_section responsive_section">
    <div class="container ">
        <!-- <h1 class="text-center gradient_text_color spacing_for_htag"><?php echo $theater_name; ?></h1> -->

        <div class="row">

            <div class="col-lg-2  col-12 text_side_div d-none d-lg-block">
                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid side_dive_images">
                <img src="assets/img/test/animation.gif" alt="Animated GIF" class=" my-4 side_dive_images">
                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid  side_dive_images">
            </div>



            <div class="col-lg-8 col-12">


                <div class="row g-4"> <!-- g-4 adds spacing between items -->

                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-12   col-md-6"> <!-- Responsive grid -->
                            <a href="screen_details.php?screen_id=<?php echo $row['id']; ?>" class="text-decoration-none">
                                <div class="card bg-dark text-white shadow-lg rounded overflow-hidden position-relative">
                                    <img src="./admin/uploads/screens/<?php echo htmlspecialchars($row['screen_image']); ?>"
                                        alt="<?php echo htmlspecialchars($row['screen_name']); ?>"
                                        class="img-fluid"
                                        style="width: 100%; height: 220px; object-fit: cover;">

                                    <!-- Dark overlay for better readability -->
                                    <div class="overlay position-absolute w-100 h-100" style="background: rgba(0, 0, 0, 0.5); top: 0; left: 0;"></div>

                                    <!-- Highlighted background for screen name -->
                                    <div class="card-body position-absolute w-100 text-center"
                                        style="bottom: 0; padding: 10px; background: #00000080; color: white; border-radius: 0 0 10px 10px;">
                                        <h4 class="mb-0" style="font-size: 20px; font-weight: bold; color:white;">
                                            <?php echo htmlspecialchars($row['screen_name']); ?>
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>

                </div>


                <div id="carouselExampleSlidesOnly" class="carousel slide d-md-none mt-5" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/img/test/theater1.png" class="  img-fluid  d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/test/theater2.png" class="img-fluid d-block w-100" alt="...">
                    </div>
                    <!-- <div class="carousel-item">
                        <img src="assets/img/test/23.png" class="img-fluid  d-block w-100" alt="...">
                    </div> -->
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



<?php include 'chat_bot.php'; ?>
<?php include 'footer.php'; ?>