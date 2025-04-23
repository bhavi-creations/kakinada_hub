<?php include 'header.php'; ?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>
        <style>
            .custom-card {
                background-image: linear-gradient(to right top, #c6c6c7, #afafb0, #999999, #838383, #6e6e6e);
                border-radius: 12px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                transition: transform 0.3s;
                height: 130px;
                text-align: center;


            }

            .card_home_title {
                color: white;
                font-weight: bold;
                text-align: center;
            }

            .custom-card:hover {
                transform: translateY(-5px);
            }

            .card-header-btn {
                margin-top: 10px;
                background-color: #007bff;
                color: #fff;
                border: none;
                padding: 5px 10px;
                font-size: 14px;
                border-radius: 5px;
                cursor: pointer;

            }

            .card-header-btn:hover {
                background-color: #0056b3;
            }
        </style>
        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"> Home Page Services</h1>

                </div>

                <div class="container mt-5">
                    <div class="row g-4">

                        <div class="col-md-4 col-lg-3 my-4">
                            <div class="custom-card p-3 position-relative">

                                <h5 class="mt-3 card_home_title">Home Slider Ads</h5>
                                <a href="home_ads.php"> <button class="card-header-btn">Click Me</button></a>

                            </div>
                        </div>

                        <div class="col-md-4 col-lg-3 my-4">
                            <div class="custom-card p-3 position-relative">

                                <h5 class="mt-3 card_home_title">Trending Now</h5>
                                <a href="view_home_trending.php"> <button class="card-header-btn">Click Me</button></a>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3 my-4">
                            <div class="custom-card p-3 position-relative">

                                <h5 class="mt-3 card_home_title">Offers </h5>
                                <a href="view_home_offers.php"> <button class="card-header-btn">Click Me</button></a>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3 my-4">
                            <div class="custom-card p-3 position-relative">

                                <h5 class="mt-3 card_home_title">Marquee Texts</h5>
                                <a href="add_marquee.php"> <button class="card-header-btn">Click Me</button></a>

                            </div>
                        </div>
                            <div class="col-md-4 col-lg-3 my-4">
                            <div class="custom-card p-3 position-relative">

                                <h5 class="mt-3 card_home_title">Orange last Slider</h5>
                                <a href="home_orange_slides.php"> <button class="card-header-btn">Click Me</button></a>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>