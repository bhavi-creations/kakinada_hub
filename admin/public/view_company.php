<?php include 'header.php'; ?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Company Details</h1>
                    <a href="companies.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa fa-arrow-left"></i> Back to Companies
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <?php
                            include '../../db.connection/db_connection.php';

                            if (isset($_GET['company_id'])) {
                                $company_id = mysqli_real_escape_string($conn, $_GET['company_id']);

                                // Fetch company details
                                $query = "SELECT * FROM companies WHERE id = '$company_id'";
                                $result = mysqli_query($conn, $query);

                                if ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="../uploads/companies/<?php echo $row['logo']; ?>" class="img-fluid mb-3" style="max-width: 150px;">
                                            </div>
                                            <h4 class="card-title"><strong>Company:</strong> <?php echo $row['name']; ?></h4>
                                            <p class="card-text"><strong>Email:</strong> <?php echo $row['email']; ?></p>
                                            <p class="card-text"><strong>Phone:</strong> <?php echo $row['phone']; ?></p>

                                            <!-- Address as Clickable Link to Open Map -->
                                            <p class="card-text"><strong>Address:</strong> 
                                                <?php if (!empty($row['map_url'])) { ?>
                                                    <a href="<?php echo $row['map_url']; ?>" target="_blank" style="text-decoration: none; color: #007bff;">
                                                        <?php echo $row['address']; ?>
                                                    </a>
                                                <?php } else {
                                                    echo $row['address'];
                                                } ?>
                                            </p>

                                            <p class="card-text"><strong>About:</strong> <?php echo $row['about']; ?></p>


                                            <p class="card-text"><strong>Category:</strong> <?php echo $row['category']; ?></p>
                                            <p class="card-text"><strong>Experience:</strong> <?php echo $row['experience_years']; ?> years</p>
                                            <p class="card-text"><strong>Employees:</strong> <?php echo $row['no_of_employees']; ?></p>

                                            <!-- Website as Clickable Link -->
                                            <p class="card-text"><strong>Website:</strong> 
                                                <a href="<?php echo $row['website']; ?>" target="_blank" style="text-decoration: none; color: #007bff;">
                                                    <?php echo $row['website']; ?>
                                                </a>
                                            </p>

                                            <p class="card-text"><strong>Posted At:</strong> <?php echo $row['created_at']; ?></p>
 
                                            <?php
                                            if (!empty($row['company_images'])) {
                                                $images = explode(',', $row['company_images']); // Assuming images are stored as comma-separated values
                                            ?>
                                                <div class="mt-3">
                                                    <h5>Company Images</h5>
                                                    <div class="row">
                                                        <?php foreach ($images as $image) { ?>
                                                            <div class="col-md-4 mb-2">
                                                                <img src="../uploads/companies/<?php echo trim($image); ?>" class="img-fluid rounded">
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                            <?php
                                } else {
                                    echo "<div class='alert alert-warning'>Company not found.</div>";
                                }
                            } else {
                                echo "<div class='alert alert-danger'>Invalid request.</div>";
                            }
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
