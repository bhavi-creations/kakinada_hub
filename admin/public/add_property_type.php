<?php
include 'header.php';
?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Add Property</h1>
                    <a href="properties.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-regular fa-eye"></i> View Property Types
                    </a>
                </div>

                <?php
                include '../../db.connection/db_connection.php';

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $title = $_POST['title'];
                    $type = $_POST['type'];
                    $category = ucfirst(strtolower(trim($_POST['category']))); // Capitalize first letter
                    $price = (int) $_POST['price']; // Ensure integer
                    $phone = $_POST['phone'];
                    $location = $_POST['location'];
                    $size_sqft = (int) $_POST['size_sqft']; // Ensure integer
                    $bedrooms = (int) $_POST['bedrooms']; // Ensure integer
                    $bathrooms = (int) $_POST['bathrooms']; // Ensure integer
                    $furnishing_status = $_POST['furnishing_status'];
                    $description = $_POST['description'];
                    $facing = $_POST['facing'];
                    $amenities = $_POST['amenities'];


                    // ✅ Set Correct Upload Path (Relative Path)
                    $upload_folder = "../uploads/properties/";

                    // ✅ Ensure Directory Exists
                    if (!file_exists($upload_folder)) {
                        mkdir($upload_folder, 0777, true);
                    }

                    // ✅ Single Image Upload
                    $image_name = '';
                    if (!empty($_FILES['image']['name'])) {
                        $image_name = time() . '_' . basename($_FILES['image']['name']);
                        $image_path = $upload_folder . $image_name;

                        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                            $_SESSION['message'] = "Error: Failed to upload main image.";
                            $_SESSION['msg_type'] = "danger";
                            header("Location: add_property_type.php");
                            exit();
                        }
                    }

                    // ✅ Multiple File Uploads
                    $multiple_images = [];
                    if (!empty($_FILES['property_images']['name'][0])) {
                        foreach ($_FILES['property_images']['name'] as $key => $file_name) {
                            $file_tmp = $_FILES['property_images']['tmp_name'][$key];
                            $unique_file_name = time() . '_' . basename($file_name);
                            $file_path = $upload_folder . $unique_file_name;

                            if (move_uploaded_file($file_tmp, $file_path)) {
                                $multiple_images[] = $unique_file_name;
                            } else {
                                $_SESSION['message'] = "Error: Failed to upload $file_name.";
                                $_SESSION['msg_type'] = "danger";
                                header("Location: add_property_type.php");
                                exit();
                            }
                        }
                    }
                    $multiple_images_str = implode(',', $multiple_images);

                    // ✅ Updated Query with Category


                    $query = "INSERT INTO properties (title, type, category, price, phone, location, size_sqft, bedrooms, bathrooms, furnishing_status, facing, amenities, image, images, description) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("sssissiiissssss", $title, $type, $category, $price, $phone, $location, $size_sqft, $bedrooms, $bathrooms, $furnishing_status, $facing, $amenities, $image_name, $multiple_images_str, $description);

                    if ($stmt->execute()) {
                        $_SESSION['message'] = "Property added successfully!";
                        $_SESSION['msg_type'] = "success";
                        header("Location: add_property_type.php"); // ✅ Prevent Form Resubmission
                        exit();
                    } else {
                        $_SESSION['message'] = "Error: " . $stmt->error;
                        $_SESSION['msg_type'] = "danger";
                        header("Location: add_property_type.php");
                        exit();
                    }
                }
                ?>

                <!-- ✅ Success Message Display in HTML -->
                <?php if (isset($_SESSION['message'])): ?>
                    <div id="alert-box" class="alert alert-<?php echo $_SESSION['msg_type']; ?>">
                        <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']); // ✅ Remove message after displaying
                        ?>
                    </div>

                    <script>
                        // Hide the alert after 3 seconds
                        setTimeout(function() {
                            let alertBox = document.getElementById('alert-box');
                            if (alertBox) {
                                alertBox.style.display = 'none';
                            }
                        }, 3000);
                    </script>
                <?php endif; ?>

                <!-- Property Form -->
                <div class="container">
                    <form action="add_property_type.php" method="POST" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Category:</label>
                                <select name="category" class="form-control" required>
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                </select>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Type:</label>
                                <select name="type" class="form-control" required>
                                    <option value="For Rent">For Rent</option>
                                    <option value="For Sale">For Sale</option>
                                    <option value="For Lease">For Lease</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Title:</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Price:</label>
                                <input type="text" name="price" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone Number:</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Location:</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Size (sqft):</label>
                                <input type="number" name="size_sqft" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Facing:</label>
                                <select name="facing" class="form-control" required>
                                    <option value="">-- Select Facing --</option>
                                    <option value="East">East</option>
                                    <option value="West">West</option>
                                    <option value="North">North</option>
                                    <option value="South">South</option>
                                    <option value="North-East">North-East</option>
                                    <option value="North-West">North-West</option>
                                    <option value="South-East">South-East</option>
                                    <option value="South-West">South-West</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Bedrooms:</label>
                                <input type="number" name="bedrooms" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Bathrooms:</label>
                                <input type="number" name="bathrooms" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Furnishing Status:</label>
                                <select name="furnishing_status" class="form-control" required>
                                    <option value="Furnished">Furnished</option>
                                    <option value="Semi-Furnished">Semi-Furnished</option>
                                    <option value="Unfurnished">Unfurnished</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Description:</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Amenities:</label>
                                <input type="text" name="amenities" class="form-control" placeholder="e.g. Gym, Pool, Parking, Security">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="image">Main Image:</label>
                                <input type="file" name="image" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="property_images">Upload More Images:</label>
                                <input type="file" name="property_images[]" multiple>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Add Property</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>