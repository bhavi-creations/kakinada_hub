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
                    <h1 class="h3 mb-0 text-gray-800">Add Companies</h1>
                    <a href="companies.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-regular fa-eye"></i> View Companies
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <?php include '../../db.connection/db_connection.php'; ?>

                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $name = mysqli_real_escape_string($conn, $_POST['name']);
                                $category = mysqli_real_escape_string($conn, $_POST['category']);
                                $email = mysqli_real_escape_string($conn, $_POST['email']);
                                $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                                $address = mysqli_real_escape_string($conn, $_POST['address']);
                                $about = mysqli_real_escape_string($conn, $_POST['about']);
                                $map_url = mysqli_real_escape_string($conn, $_POST['map_url']);
                                $no_of_employees = intval($_POST['no_of_employees']);
                                $experience_years = intval($_POST['experience_years']);
                                $website = mysqli_real_escape_string($conn, $_POST['website']);

                                // Handling logo upload
                                $logo = '';
                                if (!empty($_FILES["logo"]["name"])) {
                                    $target_dir = "../uploads/companies/";
                                    $logo = time() . "_" . basename($_FILES["logo"]["name"]);
                                    $target_file = $target_dir . $logo;
                                    move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);
                                }

                                // Handling multiple company images upload
                                $company_images = '';
                                if (!empty($_FILES["company_images"]["name"][0])) {
                                    $image_names = [];
                                    foreach ($_FILES["company_images"]["name"] as $key => $image_name) {
                                        $new_name = time() . "_" . basename($image_name);
                                        move_uploaded_file($_FILES["company_images"]["tmp_name"][$key], $target_dir . $new_name);
                                        $image_names[] = $new_name;
                                    }
                                    $company_images = implode(",", $image_names); // Store images as comma-separated values
                                }

                                // Insert query
                                $query = "INSERT INTO companies (name, category, email, phone, address, about, map_url, no_of_employees, experience_years, website, logo, company_images) 
                                          VALUES ('$name', '$category', '$email', '$phone', '$address', '$about', '$map_url', '$no_of_employees', '$experience_years', '$website', '$logo', '$company_images')";

                                if (mysqli_query($conn, $query)) {
                                    header("Location: add_companies.php?success=1");
                                    exit();
                                } else {
                                    echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
                                }
                            }
                            ?>

                            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                                <div class='alert alert-success' id='successMessage'>Company added successfully!</div>
                            <?php endif; ?>

                            <div class="card shadow p-4">
                                <h5 class="text-center">Add a New Company</h5>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="row my-4">


                                        <div class="form-group col-6">
                                            <label for="name">Company Name</label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="category">Category</label>
                                            <input type="text" class="form-control" name="category" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" name="phone" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="address">Address</label>
                                            <textarea class="form-control" name="address" required></textarea>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="about">About</label>
                                            <textarea class="form-control" name="about" required></textarea>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="map_url">Google Map URL</label>
                                            <input type="text" class="form-control" name="map_url">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="no_of_employees">Number of Employees</label>
                                            <input type="number" class="form-control" name="no_of_employees" min="1">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="experience_years">Company Experience (Years)</label>
                                            <input type="number" class="form-control" name="experience_years" min="0">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="website">Website</label>
                                            <input type="text" class="form-control" name="website">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="logo">Company Logo</label>
                                            <input type="file" class="form-control-file" name="logo">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="company_images">Company Images (Multiple)</label>
                                            <input type="file" class="form-control-file" name="company_images[]" multiple>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">Add Company</button>
                                    </div>
                                </form>
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

<script>
    setTimeout(function() {
        var successMessage = document.getElementById("successMessage");
        if (successMessage) {
            successMessage.style.display = "none";
        }
    }, 3000);
</script>