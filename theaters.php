<?php
include 'navbar.php';
include './db.connection/db_connection.php';
?>
<?php include 'moviesidebar.php'; ?>

<section class="bg_section responsive_section">
    <div class="container ">
    <h1 class="text-center gradient_text_color spacing_for_htag">Movie Theaters</h1>


        <div class="row">

            <div class="col-lg-2  col-12 text_side_div d-none d-lg-block">
                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid side_dive_images">
                <img src="assets/img/test/animation.gif" alt="Animated GIF" class=" my-4 side_dive_images">
                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid  side_dive_images">
            </div>



            <div class="col-lg-8 col-12">

                <div class="row g-4">


                    <?php
                    // Fetch all theaters from the database
                    $query = "SELECT id, name, image FROM theaters";
                    $result = mysqli_query($conn, $query);

                    // Loop through each theater and display dynamically
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="col-6 col-md-4">
                            <a href="screens.php?theater_id=<?php echo $row['id']; ?>">
                                <div class="card bg-dark text-white shadow-lg d-flex flex-column align-items-center"
                                    style="height: 220px;">
                                    <img src="./admin/uploads/theaters/<?php echo $row['image']; ?>"
                                        alt="<?php echo htmlspecialchars($row['name']); ?>"
                                        class="img-fluid pic"
                                        style="width: 100%; height: 220px; object-fit: cover;">
                                    <h3 class="mt-2 p-3 text-center list_page_test_tittle flex-grow-1 text-white">
                                        <?php echo htmlspecialchars($row['name']); ?>
                                    </h3>
                                </div>
                            </a>
                        </div>
                    <?php
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

<?php include 'chat_bot.php'; ?>
<?php include 'footer.php'; ?>