<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kakinada Hub</title>
    <meta name="author" content="Vecuro">
    <meta name="description" content="Medixi - Medical and Health Care HTML Template">
    <meta name="keywords" content="Medixi - Medical and Health Care HTML Template">
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--==============================
	   Google Web Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Quicksand:wght@400;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">


    <!-- Favicons - Place favicon.ico in the root directory -->
    <!-- <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon"> -->
    <!-- <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon"> -->

    <!--==============================
	    All CSS File
	============================== -->


    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/app.min.css"> -->
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <!-- Layerslider -->
    <link rel="stylesheet" href="assets/css/layerslider.min.css">
    <!-- jQuery DatePicker -->
    <link rel="stylesheet" href="assets/css/jquery.datetimepicker.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="assets/css/slick.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/new.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style1.css">
</head>


<?php include './db.connection/db_connection.php'; ?>


<body class="">






    <div class="vs-menu-wrapper">
        <div class="vs-menu-area text-center">
            <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <a href="index.php">
                    <!-- <img src="assets/img/self_images/kakinada_hub.png" alt="Kakinada Hub"> -->
                    <h2 class="logo_title_color my-5    ">KAKINADA Hub</h2>


                </a>
            </div>
            <form action="#" class="mobile-menu-form">
                <input type="text" class="form-control" placeholder="Search...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
            <div class="vs-mobile-menu">
                <ul>
                    <li class="menu-item-has-children">
                        <a href="index.php">Home</a>

                    </li>


                    <li class="menu-item-has-children">
                        <a href="# ">Services</a>
                        <!-- Arrow for submenu toggle -->
                        <ul class="sub-menu ">
                            <li class="movies_bg"><a class=" " href="theaters.php"> Movies</a>
                                <ul>
                                    <?php
                                    // Database connection

                                    $query = "SELECT id, name FROM theaters";
                                    $result = mysqli_query($conn, $query);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<li><a class="sub_mini_serices" href="screens.php?theater_id=' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</a></li>';
                                    }
                                    ?>
                                    <li><a class="view_all_sub_mini_serices" href="theaters.php"> View All Movies Deals </a></li>
                                </ul>
                            </li>



                            <li class="resturent_bg"><a class=" " href="resturents.php"> Resturents</a>
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
                            </li>
                            <li class="saloon_bg"><a class=" " href="theaters.php"> Saloons & Spa</a>
                                <ul>
                                    <li><a class="sub_mini_serices" href="royal_touch.php"> Royal Touch </a></li>
                                    <li><a class="sub_mini_serices" href="vv_saloon.php"> V & V </a></li>
                                    <li><a class="sub_mini_serices" href="s3_beauty_saloon.php"> S3 Saloon & Spa </a></li>
                                    <li><a class="sub_mini_serices" href="groom9_saloon.php"> Groom 9 saloon </a></li>
                                    <li><a class="sub_mini_serices" href="natural_saloon.php"> Natural Saloon </a></li>
                                    <li><a class="sub_mini_serices" href="laavish_saloon.php"> Laavish Saloon </a></li>
                                    <li><a class="sub_mini_serices" href="royal_touch.php"> Celebraties secrets </a></li>
                                    <li><a class="sub_mini_serices" href="royal_touch.php"> Decent </a></li>


                                    <li><a class="view_all_sub_mini_serices" href="list_layout.php"> View All Saloons & Spa Deals </a></li>

                                </ul>
                            </li>
                            <li class="gifts_bg"><a class="" href="business_layout.php"> Gifts & Jewellery</a>
                                <ul>
                                    <li><a class="sub_mini_serices" href="sweets_chocolate.php"> Sweets & Chocolates </a></li>
                                    <li><a class="sub_mini_serices" href="gifts_collactable.php"> Gifts & Collectables </a></li>
                                    <li><a class="sub_mini_serices" href="flowers_gifts.php"> Flowers </a></li>
                                    <li><a class="sub_mini_serices" href="jewellery_watches.php"> Jewellery & Watches </a></li>
                                    <li><a class="sub_mini_serices" href="sweets_chocolate.php"> Malbar </a></li>
                                    <li><a class="sub_mini_serices" href="sweets_chocolate.php"> Tansique </a></li>
                                    <li><a class="sub_mini_serices" href="sweets_chocolate.php"> Kazana Jewellery </a></li>
                                    <li><a class="view_all_sub_mini_serices" href="list_layout.php"> View All Gifts & Jewellery Deals </a></li>

                                </ul>
                            </li>
                            <li class="fashion_bg"><a class=" " href="theaters.php"> Fashion</a>
                                <ul>
                                    <li><a class="sub_mini_serices" href="footware_fashion.php"> Footwear </a></li>
                                    <li><a class="sub_mini_serices" href="footware_fashion.php"> Jewellery </a></li>
                                    <li><a class="sub_mini_serices" href="footware_fashion.php"> Women's Fashion </a></li>
                                    <li><a class="sub_mini_serices" href="footware_fashion.php"> Designerwear </a></li>
                                    <li><a class="sub_mini_serices" href="footware_fashion.php"> Men's Fashion </a></li>
                                    <li><a class="sub_mini_serices" href="footware_fashion.php"> Lingerie </a></li>
                                    <li><a class="sub_mini_serices" href="footware_fashion.php"> Fashion Accessories </a></li>
                                    <li><a class="sub_mini_serices" href="footware_fashion.php"> Children & Teen Fashion </a></li>

                                    <li><a class="view_all_sub_mini_serices" href="list_layout.php"> View All Fashion Deals </a></li>

                                </ul>
                            </li>
                            <li class="hospital_bg"><a class=" " href="theaters.php"> Hospitals</a>
                                <ul>
                                    <li><a class="sub_mini_serices" href="dental_hospital.php"> Dental Hospitals </a></li>
                                    <li><a class="sub_mini_serices" href="dental_hospital.php"> Neuro Hospitals </a></li>
                                    <li><a class="sub_mini_serices" href="dental_hospital.php"> ENT Hospitals </a></li>
                                    <li><a class="sub_mini_serices" href="dental_hospital.php"> Skincare Hospitals </a></li>
                                    <li><a class="sub_mini_serices" href="dental_hospital.php"> physiotherapy </a></li>

                                    <li><a class="view_all_sub_mini_serices" href="list_layout.php"> View All Fashion Deals </a></li>

                                </ul>
                            </li>
                            <li class="sports_bg"><a class=" " href="business_layout.php"> Sports & Gym</a>
                                <ul>
                                    <li><a class="sub_mini_serices" href="sports_clothing.php"> Sports Clothing </a></li>
                                    <li><a class="sub_mini_serices" href="sports_clothing.php"> Clubs & Gyms </a></li>
                                    <li><a class="sub_mini_serices" href="sports_clothing.php"> Camping & Outdoors </a></li>
                                    <li><a class="sub_mini_serices" href="sports_clothing.php"> Sports & Fitness Equipment </a></li>
                                    <li><a class="sub_mini_serices" href="sports_clothing.php"> Sports Nutrition & Diet </a></li>
                                    <li><a class="sub_mini_serices" href="sports_clothing.php"> Cycling - Bikes & Accessories </a></li>
                                    <li><a class="view_all_sub_mini_serices" href="list_layout.php"> View All Sports & Fitness Deals </a></li>

                                </ul>
                            </li>
                            <li class="kids_bg"><a class=" " href="business_layout.php"> Kids & Babies</a>
                                <ul>
                                    <li><a class="sub_mini_serices" href="toys_games.php"> Toys & Games </a></li>
                                    <li><a class="sub_mini_serices" href="toys_games.php"> Kids & Baby Clothes </a></li>
                                    <li><a class="sub_mini_serices" href="toys_games.php"> Maternity </a></li>
                                    <li><a class="sub_mini_serices" href="toys_games.php"> Baby Items & Furniture </a></li>
                                    <li><a class="view_all_sub_mini_serices" href="list_layout.php"> View All Kids & Babies Deals </a></li>

                                </ul>
                            </li>

                        </ul>

                    </li>

                    <li>
                        <a href="jobs.php">Jobs </a>
                    </li>


                    <!-- <li class="menu-item-has-children">
                        <a href="blog.html">Blog</a>
                        <ul class="sub-menu">
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="blog-details.html">Blog Details</a></li>
                        </ul>
                    </li> -->


                    <li>
                        <a href="events.php">Events </a>
                    </li>
                    <li>
                        <a href="travel.php">Travel </a>
                    </li>
                    <li>
                        <a href="properties.php">Properties</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="header-container" style="position: relative;">
        <a href="#" class="drag_the_location_icon">
            <i class="fas fa-map-marker-alt rotate-icon"></i>
        </a>
        <header class="header-wrapper header-layout1">


            <div class="sticky-wrap">
                <div class="sticky-active">
                    <!-- Header Main -->
                    <div class="header-main">
                        <div class="container container-style1 position-relative">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto">
                                    <div class="header1-logo  ">
                                        <a href="index.php" class="text-center">
                                            <h2 class="logo_title_color">KAKINADA Hub</h2>

                                            <!-- <img src="assets/img/self_images/kkd_mini.png" class="  img-fluid  " alt="Logo"> -->
                                        </a>
                                    </div>
                                </div>


                                <div class="col text-end text-lg-center">
                                    <nav class="main-menu menu-style1 d-none d-lg-block">
                                        <ul>
                                            <li class=" ">
                                                <a href="index.php"> Home </a>
                                            </li>


                                            <li class="menu-item-has-children mega-menu-wrap">
                                                <a href="services.php"><span class="has-new-label">Services </span></a>
                                                <ul class="mega-menu dropdown-menu-mega">
                                                    <div class="mega-menu-row row  ">
                                                        <div class="col-3 movies_bg my-2">


                                                            <li><a class="sub_heading" href="theaters.php"> Movies</a>
                                                                <ul>

                                                                    <?php

                                                                    // Fetch all theaters from the database
                                                                    $theater_query = "SELECT id, name FROM theaters";
                                                                    $theater_result = mysqli_query($conn, $theater_query);

                                                                    while ($row = mysqli_fetch_assoc($theater_result)) {
                                                                        echo '<li><a class="sub_mini_serices" href="screens.php?theater_id=' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</a></li>';
                                                                    }
                                                                    ?>
                                                                    <li><a class="view_all_sub_mini_serices" href="theaters.php"> View All Movies Deals </a></li>
                                                                </ul>
                                                            </li>





                                                        </div>
                                                        <div class="col-3 resturent_bg  my-2 ">
                                                            <li><a class="sub_heading" href="resturents.php"> Resturents</a>
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

                                                            </li>

                                                        </div>
                                                        <div class="col-3 saloon_bg my-2">
                                                            <li><a class="sub_heading" href="royal_touch.php"> Saloons & Spa</a>
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
                                                            </li>

                                                        </div>
                                                        <div class="col-3 gifts_bg my-2">
                                                            <li><a class="sub_heading" href="sweets_chocolate.php"> Gifts & Jewellery</a>
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
                                                            </li>

                                                        </div>
                                                        <div class="col-3 fashion_bg  my-2">
                                                            <li><a class="sub_heading" href="footware_fashion.php"> Fashion</a>
                                                                <ul>
                                                                    <li><a class="sub_mini_serices" href="footware_fashion.php"> Footwear </a></li>
                                                                    <!-- <li><a class="sub_mini_serices" href="footware_fashion.php"> Jewellery </a></li> -->
                                                                    <li><a class="sub_mini_serices" href="womens_fashion.php"> Women's Fashion </a></li>
                                                                    <!-- <li><a class="sub_mini_serices" href="footware_fashion.php"> Designerwear </a></li> -->
                                                                    <li><a class="sub_mini_serices" href="mens_fashion.php"> Men's Fashion </a></li>
                                                                    <!-- <li><a class="sub_mini_serices" href="footware_fashion.php"> Lingerie </a></li> -->
                                                                    <li><a class="sub_mini_serices" href="fashion_accessories.php"> Fashion Accessories </a></li>
                                                                    <li><a class="sub_mini_serices" href="child_accessories_fashion.php"> Children & Teen Fashion </a></li>

                                                                    <li><a class="view_all_sub_mini_serices" href="fashion.php"> View All Fashion Deals </a></li>

                                                                </ul>
                                                            </li>

                                                        </div>
                                                        <div class="col-3 hospital_bg my-2">
                                                            <li><a class="sub_heading" href="dental_hospital.php"> Hospitals</a>
                                                                <ul>
                                                                    <li><a class="sub_mini_serices" href="dental_hospital.php"> Dental Hospitals </a></li>
                                                                    <li><a class="sub_mini_serices" href="neuro_hospital.php"> Neuro Hospitals </a></li>
                                                                    <li><a class="sub_mini_serices" href="ent_hospital.php"> ENT Hospitals </a></li>
                                                                    <li><a class="sub_mini_serices" href="skincare.php"> Skincare Hospitals </a></li>
                                                                    <li><a class="sub_mini_serices" href="physiotherapy.php"> physiotherapy </a></li>

                                                                    <li><a class="view_all_sub_mini_serices" href="dental.php"> View All Fashion Deals </a></li>

                                                                </ul>
                                                            </li>

                                                        </div>
                                                        <div class="col-3 sports_bg my-2">
                                                            <li><a class="sub_heading" href="sports_clothing.php"> Sports & Gym</a>
                                                                <ul>
                                                                    <li><a class="sub_mini_serices" href="sports_clothing.php"> Sports Clothing </a></li>
                                                                    <li><a class="sub_mini_serices" href="gym.php"> Gyms </a></li>
                                                                    <li><a class="sub_mini_serices" href="outdoor.php"> Camping & Outdoors </a></li>
                                                                    <li><a class="sub_mini_serices" href="fitness.php"> Sports & Fitness Equipment </a></li>
                                                                    <li><a class="sub_mini_serices" href="nutrition_diet.php"> Nutrition & Diet </a></li>
                                                                    <li><a class="sub_mini_serices" href="accessories.php"> Cycling - Bikes & Accessories </a></li>
                                                                    <li><a class="view_all_sub_mini_serices" href="sports_gym.php"> View All Sports & Fitness Deals </a></li>


                                                                </ul>
                                                            </li>

                                                        </div>
                                                        <div class="col-3 kids_bg my-2">
                                                            <li><a class="sub_heading" href="toys_games.php"> Kids & Babies</a>
                                                                <ul>
                                                                    <li><a class="sub_mini_serices" href="toys_games.php"> Toys & Games </a></li>
                                                                    <li><a class="sub_mini_serices" href="toys_games.php"> Little Twins </a></li>
                                                                    <li><a class="sub_mini_serices" href="tinynest.php"> TinyNest World </a></li>
                                                                    <li><a class="sub_mini_serices" href="toys_hub.php"> ToyTales Hub </a></li>
                                                                    <li><a class="sub_mini_serices" href="snugglebee.php"> SnuggleBee  </a></li>
                                                                    <li><a class="sub_mini_serices" href="littlewonders.php"> LittleWonders  </a></li>
                                                                    <li><a class="sub_mini_serices" href="dreamcrib.php"> DreamCrib  </a></li>

                                                                    <li><a class="view_all_sub_mini_serices" href="kids_babies.php"> View All Kids & Babies Deals </a></li>

                                                                </ul>
                                                            </li>

                                                        </div>
                                                    </div>
                                                </ul>
                                            </li>




                                            <li class="">
                                                <a class=" " href="jobs.php"> Jobs </a>
                                            </li>



                                            <li>
                                                <a href="events.php">Events</a>
                                            </li>
                                            <li>
                                                <a href="travel.php">Travel</a>
                                            </li>
                                            <li>
                                                <a href="properties.php">Properties</a>
                                            </li>

                                        </ul>
                                    </nav>


                                    <button class="vs-menu-toggle d-inline-block d-lg-none"><i class="fas fa-bars"></i></button>

                                </div>


                                <div class="col-auto gap-3 d-none d-lg-flex">
                                    <form action="#" class="mobile-menu-form  d-none d-lg-block">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <button class="need_no_styles" type="submit"><i class="search_icon  fas fa-search"></i></button>
                                    </form>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

    </div>







    <?php

    $pageName = basename($_SERVER['PHP_SELF'], '.php');

    // Get active banner for that page
    $query = "SELECT * FROM banner_ads WHERE page_name = ? AND status = 'active' LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $pageName);
    $stmt->execute();
    $result = $stmt->get_result();
    $banner = $result->fetch_assoc();
    ?>


    <?php if (!empty($banner)) : ?>
        <section id="adSection">
            <div class="sticky-ad" id="stickyAd">
                <div class="ad-container">
                    <button class="close-ad" onclick="closeAd()">✖</button>
                    <a href="<?php echo htmlspecialchars($banner['target_url']); ?>" target="_blank">
                        <img src="./admin/uploads/banner_ads/<?php echo htmlspecialchars($banner['image_path']); ?>" class="img-fluid" alt="Ad">
                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?>


    <script>
        window.addEventListener("scroll", function() {
            let ad = document.getElementById("stickyAd");
            let adPosition = ad.offsetTop;

            if (window.scrollY >= adPosition) {
                ad.classList.add("fixed");
            } else {
                ad.classList.remove("fixed");
            }
        });

        function closeAd() {
            document.getElementById("adSection").style.display = "none";
        }
    </script>




    <?php
    include './db.connection/db_connection.php'; // Ensure the database connection is included

    // Fetch marquee texts
    $sql = "SELECT text FROM marquee_texts ORDER BY created_at DESC";
    $result = $conn->query($sql);

    // Prepare marquee content
    $marquee_texts = [];
    while ($row = $result->fetch_assoc()) {
        $marquee_texts[] = '<span class="highlight-text">' . htmlspecialchars($row['text']) . '</span>';
    }

    // Convert array to string with separators
    $marquee_content = implode(' &nbsp; || &nbsp; ', $marquee_texts);
    ?>

    <!-- <section class="marquee-section">
    <div class="marquee-content">
        <marquee behavior="scroll" direction="left" class="marquee">
            <?php echo $marquee_content; ?>
        </marquee>
    </div>
</section> -->



    <section class="marquee-section" id="marqueeSection">
        <div class="marquee-content">
            <marquee behavior="scroll" direction="left" class="marquee">
                <?php echo $marquee_content; ?>
            </marquee>
            <button class="close-marquee" onclick="closeMarquee()">×</button>
        </div>
    </section>



    <script>
        function closeMarquee() {
            document.getElementById("marqueeSection").style.display = "none";
        }
    </script>