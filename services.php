<?php include 'navbar.php';  ?>







<section class="bg_section responsive_section ">
    <div class="container  service_contant">

        <div class="row ">
            <div class="yellow_fields_cards_container">


                <div class="yellow_field_card movies_bg">
                    <h4 class="yello_heding">
                        <img src="assets/img/self_images/day.png" alt="" class="img-fluid"><a href="theaters.php">Movies</a>
                    </h4>

                    <ul>
                        <?php


                        $query = "SELECT id, name FROM theaters";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<li><a class="sub_mini_serices" href="screens.php?theater_id=' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</a></li>';
                        }
                        ?>
                        <li><a class="view_all_sub_mini_serices" href="theaters.php"> View All Movies Deals </a></li>
                    </ul>
                </div>
                <div class="yellow_field_card resturent_bg">
                    <h4 class="yello_heding"><img src="assets/img/self_images/spoon-and-fork.png" alt="" class="img-fluid"> <a href="resturents.php">Resturents</a> </h4>

                    <ul>
                        <?php
                         

                        $query = "SELECT id, name FROM restaurants ORDER BY name ASC LIMIT 8";
                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0):
                            while ($row = mysqli_fetch_assoc($result)):
                                $id = $row['id'];
                                $name = htmlspecialchars($row['name']);
                        ?>
                                <li><a class="sub_mini_serices" href="resturents_layouts.php?id=<?= $id ?>"><?= $name ?></a></li>
                        <?php
                            endwhile;
                        else:
                            echo '<li>No restaurants available</li>';
                        endif;
                        ?>

                        <li><a class="view_all_sub_mini_serices" href="resturents.php">View All Restaurants Deals</a></li>
                    </ul>


                </div>
                <div class="yellow_field_card saloon_bg">
                    <h4 class="yello_heding"><img src="assets/img/self_images/haircut.png" alt="" class="img-fluid"> <a href="theaters.php"> Saloons & Spa</a></h4>

                    <ul>
                        <li><a class="sub_mini_serices" href="royal_touch.php"> Royal Touch </a></li>
                        <li><a class="sub_mini_serices" href="vv_saloon.php"> V & V Saloon </a></li>
                        <li><a class="sub_mini_serices" href="s3_beauty_saloon.php"> S3 Beauty Saloon </a></li>
                        <li><a class="sub_mini_serices" href="groom9_saloon.php">Groom 9 Saloon </a></li>
                        <li><a class="sub_mini_serices" href="natural_saloon.php"> Natural Saloon </a></li>
                        <li><a class="sub_mini_serices" href="angelic_beauty_salon.php"> Angelic Beauty Saloom </a></li>
                        <li><a class="sub_mini_serices" href="laavish_saloon.php"> Laavish Saloon </a></li>
                        <!-- <li><a class="sub_mini_serices" href="royal_touch.php"> Decent </a></li> -->


                        <li><a class="view_all_sub_mini_serices" href="saloon.php"> View All Saloons & Spa Deals </a></li>

                    </ul>

                </div>
                <div class="yellow_field_card gifts_bg">
                    <h4 class="yello_heding"><img src="assets/img/self_images/giftbox.png" alt="" class="img-fluid"> <a href="theaters.php"> Gifts & Jewellery </a></h4>


                    <ul>
                        <li><a class="sub_mini_serices" href="sweets_chocolate.php"> kotaiah sweets </a></li>
                        <li><a class="sub_mini_serices" href="gifts_collactable.php">YUVA GIFT WORLD</a></li>
                        <li><a class="sub_mini_serices" href="flowers_gifts.php"> Flowers </a></li>
                        <li><a class="sub_mini_serices" href="jewellery_watches.php"> Jewellery & Watches </a></li>
                        <li><a class="sub_mini_serices" href="malbar.php"> Malbar </a></li>
                        <li><a class="sub_mini_serices" href="tanisqe.php"> Tansique </a></li>
                        <li><a class="sub_mini_serices" href="khazana.php"> Kazana Jewellery </a></li>
                        <li><a class="view_all_sub_mini_serices" href="gifts_jewellery.php"> View All Gifts & Jewellery Deals </a></li>

                    </ul>

                </div>
                <div class="yellow_field_card fashion_bg">

                    <h4 class="yello_heding "> <img src="assets/img/self_images/fashion.png" alt="" class="img-fluid"> <a href="theaters.php">Fashion</a> </h4>

                    <ul>
                        <li><a class="sub_mini_serices" href="footware_fashion.php"> Footwear </a></li>
                        <li><a class="sub_mini_serices" href="footware_fashion.php"> Jewellery </a></li>
                        <li><a class="sub_mini_serices" href="womens_fashion.php"> Women's Fashion </a></li>
                        <li><a class="sub_mini_serices" href="footware_fashion.php"> Designerwear </a></li>
                        <li><a class="sub_mini_serices" href="mens_fashion.php"> Men's Fashion </a></li>
                        <!-- <li><a class="sub_mini_serices" href="footware_fashion.php"> Lingerie </a></li> -->
                        <li><a class="sub_mini_serices" href="fashion_accessories.php"> Fashion Accessories </a></li>
                        <li><a class="sub_mini_serices" href="child_accessories_fashion.php"> Children & Teen Fashion </a></li>

                        <li><a class="view_all_sub_mini_serices" href="fashion.php"> View All Fashion Deals </a></li>

                    </ul>
                </div>
                <div class="yellow_field_card hospital_bg">
                    <h4 class="yello_heding"><img src="assets/img/self_images/hospital.png" alt="" class="img-fluid"> <a href="theaters.php">Hospitals</a> </h4>


                    <ul>
                        <li><a class="sub_mini_serices" href="dental_hospital.php"> Dental Hospitals </a></li>
                        <li><a class="sub_mini_serices" href="neuro_hospital.php"> Neuro Hospitals </a></li>
                        <li><a class="sub_mini_serices" href="ent_hospital.php"> ENT Hospitals </a></li>
                        <li><a class="sub_mini_serices" href="skincare.php"> Skincare Hospitals </a></li>
                        <li><a class="sub_mini_serices" href="physiotherapy.php"> physiotherapy </a></li>

                        <li><a class="view_all_sub_mini_serices" href="dental.php"> View All Fashion Deals </a></li>

                    </ul>

                </div>
                <div class="yellow_field_card sports_bg">
                    <h4 class="yello_heding"><img src="assets/img/self_images/Sports.png" alt="" class="img-fluid"> <a href="theaters.php"> Sports & Gym</a> </h4>


                    <ul>
                        <li><a class="sub_mini_serices" href="sports_clothing.php"> Sports Clothing </a></li>
                        <li><a class="sub_mini_serices" href="gym.php"> Gyms </a></li>
                        <li><a class="sub_mini_serices" href="sports_clothing.php"> Camping & Outdoors </a></li>
                        <li><a class="sub_mini_serices" href="sports_clothing.php"> Sports & Fitness Equipment </a></li>
                        <li><a class="sub_mini_serices" href="sports_clothing.php">  Nutrition & Diet </a></li>
                        <li><a class="sub_mini_serices" href="sports_clothing.php"> Cycling - Bikes & Accessories </a></li>
                        <li><a class="view_all_sub_mini_serices" href="sports_gym.php"> View All Sports & Fitness Deals </a></li>

                    </ul>

                </div>
                <div class="yellow_field_card kids_bg">
                    <h4 class="yello_heding"><img src="assets/img/self_images/kids.png" alt="" class="img-fluid"> <a href="theaters.php"> Kids & Babies</a></h4>


                    <ul>
                        <li><a class="sub_mini_serices" href="toys_games.php"> Toys & Games </a></li>
                        <li><a class="sub_mini_serices" href="toys_games.php"> Little Twins </a></li>
                        <li><a class="sub_mini_serices" href="toys_games.php"> Maternity </a></li>
                        <li><a class="sub_mini_serices" href="toys_games.php"> Baby Items & Furniture </a></li>
                        <li><a class="view_all_sub_mini_serices" href="kids_babies.php"> View All Kids & Babies Deals </a></li>

                    </ul>
                </div>

            </div>

        </div>
    </div>
</section>





<?php include 'footer.php';  ?>