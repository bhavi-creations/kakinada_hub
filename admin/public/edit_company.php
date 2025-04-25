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
                    <h1 class="h3 mb-0 text-gray-800">Edit Company Details</h1>
                    <a href="jobs.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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
                                $query = "SELECT * FROM companies WHERE id = '$company_id'";
                                $result = mysqli_query($conn, $query);

                                if ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <form action="update_company.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="company_id" value="<?php echo $row['id']; ?>">

                                        <div class="mb-3">
                                            <label class="form-label">Company Name</label>
                                            <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Google Maps URL</label>
                                            <input type="url" name="map_url" class="form-control" value="<?php echo $row['map_url']; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">About</label>
                                            <textarea name="about" class="form-control" rows="3"><?php echo $row['about']; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Category</label>
                                            <input type="text" name="category" class="form-control" value="<?php echo $row['category']; ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Established  (Years)</label>
                                            <input type="number" name="experience_years" class="form-control" value="<?php echo $row['experience_years']; ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Number of Employees</label>
                                            <input type="number" name="no_of_employees" class="form-control" value="<?php echo $row['no_of_employees']; ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Website</label>
                                            <input type="url" name="website" class="form-control" value="<?php echo $row['website']; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Company Logo</label>
                                            <input type="file" name="logo" class="form-control">
                                            <small>Current Logo: <img src="../uploads/companies/<?php echo $row['logo']; ?>" style="max-width: 100px;"></small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Company Images (Multiple Uploads)</label>
                                            <input type="file" name="company_images[]" class="form-control" multiple>
                                            <small>Current Images:</small>
                                            <div class="row">
                                                <?php
                                                if (!empty($row['company_images'])) {
                                                    $images = explode(',', $row['company_images']);
                                                    foreach ($images as $image) {
                                                        echo '<div class="col-md-3"><img src="../uploads/companies/' . trim($image) . '" class="img-fluid rounded"></div>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <button type="submit" name="update_company" class="btn btn-primary">Update Company</button>
                                    </form>
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
