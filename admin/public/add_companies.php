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
                    <a href="jobs.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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
                                $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
                                $address = mysqli_real_escape_string($conn, $_POST['address']);
                                $website = mysqli_real_escape_string($conn, $_POST['website']);
                                $description = mysqli_real_escape_string($conn, $_POST['description']);

                                // Handling file upload
                                $logo = '';
                                if (!empty($_FILES["logo"]["name"])) {
                                    $target_dir = "../uploads/companies/"; // Updated upload path
                                    $logo = time() . "_" . basename($_FILES["logo"]["name"]); // Add timestamp to avoid name conflicts
                                    $target_file = $target_dir . $logo;
                                    move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);
                                }

                                // Insert query
                                $query = "INSERT INTO companies (name, category, email, contact_number, address, website, logo, description) 
                                          VALUES ('$name', '$category', '$email', '$contact_number', '$address', '$website', '$logo', '$description')";

                                if (mysqli_query($conn, $query)) {
                                    // Redirect to avoid resubmission issue
                                    header("Location: add_companies.php?success=1");
                                    exit();
                                } else {
                                    echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
                                }
                            }

                            // Show success message after redirect
                            if (isset($_GET['success']) && $_GET['success'] == 1) {
                                echo "<div class='alert alert-success' id='successMessage'>Company added successfully!</div>";
                            }
                            ?>

                            <div class="card shadow p-4">
                                <h5 class="text-center">Add a New Company</h5>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="name">Company Name</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <input type="text" class="form-control" name="category" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="contact_number">Contact Number</label>
                                        <input type="text" class="form-control" name="contact_number" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" name="address" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="website">Website</label>
                                        <input type="text" class="form-control" name="website">
                                    </div>

                                    <div class="form-group">
                                        <label for="logo">Company Logo</label>
                                        <input type="file" class="form-control-file" name="logo">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Company Description</label>
                                        <textarea class="form-control" name="description" rows="4"></textarea>
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

<!-- Success message auto-hide script -->
<script>
    setTimeout(function() {
        var successMessage = document.getElementById("successMessage");
        if (successMessage) {
            successMessage.style.display = "none";
        }
    }, 3000); // 3 seconds
</script>
