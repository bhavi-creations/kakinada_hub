<?php include 'navbar.php'; ?>


<h1 class="text-center my-4">Let's Travel</h1>



<div class="container">
    <div class="row justify-content-center">
        <?php include './db.connection/db_connection.php'; ?>

        <?php


        $typeQuery = "SELECT DISTINCT type FROM travels";
        $typeResult = mysqli_query($conn, $typeQuery);
        while ($typeRow = mysqli_fetch_assoc($typeResult)) {
            $type = ucfirst($typeRow['type']);
            $lowerType = strtolower($type);
            $imgSrc = $typeImages[$lowerType] ?? "assets/img/self_images/rental.png"; // Default image
            $btnClass = $buttonColors[$lowerType] ?? "btn-secondary";

            echo '
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card travel_card shadow border-0">
                        <img src="' . $imgSrc . '" class="card_img_top_travel" alt="' . $type . '">
                        <div class="card-body card_img_top_travel_body text-center">
                        </div>
                        <div class="card-footer text-center bg-white border-0">
                            <button class="btn ' . $btnClass . ' filter-btn filter-btn-travel" data-filter="' . $lowerType . '">  ' . $type . '</button>
                        </div>
                    </div>
                </div>';
        }
        ?>
    </div>
</div>

<!-- JavaScript for Redirecting on Filter Click -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".filter-btn").forEach(button => {
            button.addEventListener("click", function() {
                let filter = this.getAttribute("data-filter").toLowerCase();
                window.location.href = "filtered_travel.php?filter=" + filter;
            });
        });
    });
</script>


<?php include 'chat_bot.php';  ?>


<?php include 'footer.php'; ?>