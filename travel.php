<?php include 'navbar.php';  ?>
 

<?php include 'travel_sidebar.php'; ?>
 




<section class="bg_section responsive_section">
    <div class="container ">
    <h1 class="text-center gradient_text_color spacing_for_htag">Travel Destinations</h1>




        <div class="row ">

            <div class="col-lg-2  col-12 text_side_div d-none d-lg-block">
                <img src="assets/img/test/sideimg2.png" alt="" class="img-fluid side_dive_images">
                <img src="assets/img/test/animation.gif" alt="Animated GIF" class=" my-4 side_dive_images">
                <img src="assets/img/test/sideimg1.png" alt="" class="img-fluid  side_dive_images">
            </div>



            <div class="col-lg-8 col-12">

            <div class="row justify-content-center">
            <?php
            $query = "SELECT id, name, filter_image, created_at FROM travels";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = ucwords($row['name']);
                $image = "./admin/uploads/travels/" . $row['filter_image'];
                $createdAt = date("F j, Y", strtotime($row['created_at']));

                if (!empty($row['filter_image'])) {
                    echo '
                <div class="col-12  col-md-6 g-5" >
                    <a href="travel_details.php?id=' . $id . '" class="travel-card-link">
                        <div class="card shadow border-0 travel-card" style="background-image: url(\'' . $image . '\');">
                            <div class="card-overlay travel_card_overlay">
                                <h5 class="card-title travel_card_tittle">' . $name . '</h5>
                            </div>
                        </div>
                    </a>
                </div>';
                }
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