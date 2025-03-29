<?php include 'header.php';   ?>


<!-- Page Wrapper -->
<div id="wrapper">

    <?php include 'sidebar.php';   ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <?php include 'navbar.php';  ?>

        <div id="content">

            <div class="container-fluid">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                </div>

                <div class="container"> 
                    <div class="row">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h2 class="h2 mb-0 text-info mx-2">Recently Published Blogs</h2>
                        </div>
                        <div class='row row-custom no-gutters col-12'>
                            <?php
                            // Database connection (replace with your actual database connection details)
                            include '../../db.connection/db_connection.php';

                            // Fetch blog data ordered by created_at in descending order
                            $sql = "SELECT id, title, main_content, full_content, title_image, main_image FROM blogs ORDER BY created_at DESC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Directly use the image path in the src attribute
                                    $image_path = !empty($row['main_image']) ?  "../uploads/photos/{$row['main_image']}" : 'path_to_placeholder_image.jpg'; // Replace with your placeholder image path

                                    // Output the blog card
                                    echo "
                                        <div class='col-12 col-md-4 col-custom'>
                                            <div class='card card-custom m-2'>
                                         
                                                <img src='{$image_path}' class='card-img-top' alt='Blog Image'>

                                                <div class='card-body'>
                                                    <h5 class='card-title' style='color:black;'>{$row['title']}</h5>
                                                    <p class='card-text'>" . substr(strip_tags($row['main_content']), 0, 100) . "...</p>
                                                </div>
                                            </div>
                                        </div>";
                                }
                            } else {
                                echo "<p>No blog posts found.</p>";
                            }

                            $conn->close();
                            ?>
                        </div>


                    </div>  

                </div>

            </div>

        </div>

        <?php include 'footer.php'; ?>

    </div>

</div>


<?php include 'end.php'; ?>