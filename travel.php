<?php include 'navbar.php'; ?>
<?php include 'travel_sidebar.php'; ?>

<?php include './db.connection/db_connection.php'; ?>

<section class="  p-5">


<h1 class="text-center gradient_text_color  pb-5">Travel Destinations</h1>

<div class="container p-5">
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
                <div class="col-md-4 col-sm-6 mb-4">
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
</section>

<?php include 'chat_bot.php'; ?>
<?php include 'footer.php'; ?>