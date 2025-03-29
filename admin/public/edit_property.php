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
                    <h1 class="h3 mb-0 text-gray-800">Edit Property Types</h1>
                    <a href="add_property_type.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Property Types
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="row row-custom no-gutters col-12">

                            <?php
                            include '../../db.connection/db_connection.php';

                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $query = "SELECT * FROM properties WHERE id = $id";
                                $result = mysqli_query($conn, $query);
                                $property = mysqli_fetch_assoc($result);
                            } else {
                                $_SESSION['message'] = "Property not found!";
                                $_SESSION['msg_type'] = "danger";
                                header("Location: properties.php");
                                exit();
                            }

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Escape user inputs to prevent SQL injection
                                $title = mysqli_real_escape_string($conn, $_POST['title']);
                                $type = mysqli_real_escape_string($conn, $_POST['type']);
                                $price = mysqli_real_escape_string($conn, $_POST['price']);
                                $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                                $location = mysqli_real_escape_string($conn, $_POST['location']);
                                $size_sqft = mysqli_real_escape_string($conn, $_POST['size_sqft']);
                                $bedrooms = mysqli_real_escape_string($conn, $_POST['bedrooms']);
                                $bathrooms = mysqli_real_escape_string($conn, $_POST['bathrooms']);
                                $furnishing_status = mysqli_real_escape_string($conn, $_POST['furnishing_status']);
                                $amenities = mysqli_real_escape_string($conn, $_POST['amenities']);
                                $description = mysqli_real_escape_string($conn, $_POST['description']);

                                // Initialize query
                                $update_query = "UPDATE properties SET 
                                title='$title', 
                                type='$type', 
                                price='$price', 
                                phone='$phone', 
                                location='$location', 
                                size_sqft='$size_sqft', 
                                bedrooms='$bedrooms', 
                                bathrooms='$bathrooms', 
                                furnishing_status='$furnishing_status', 
                                amenities='$amenities', 
                                description='$description'";

                                // Handle Single Image Upload (Optional)
                                if (!empty($_FILES['image']['name'])) {
                                    $image = $_FILES['image']['name'];
                                    $target = "../uploads/properties/" . basename($image);
                                    move_uploaded_file($_FILES['image']['tmp_name'], $target);

                                    $update_query .= ", image='$image'";
                                }

                                // Handle Multiple Images Upload (Optional)
                                if (!empty($_FILES['images']['name'][0])) {
                                    $imageArray = [];
                                    foreach ($_FILES['images']['name'] as $key => $img) {
                                        $targetMultiple = "../uploads/properties/" . basename($img);
                                        move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetMultiple);
                                        $imageArray[] = $img;
                                    }
                                    $images = implode(",", $imageArray);
                                    $update_query .= ", images='$images'";
                                }

                                // Finalizing SQL query
                                $update_query .= " WHERE id=$id";

                                // Execute Query
                                if (mysqli_query($conn, $update_query)) {
                                    $_SESSION['message'] = "Property updated successfully!";
                                    $_SESSION['msg_type'] = "success";
                                    header("Location: properties.php");
                                    exit();
                                } else {
                                    echo "Error updating record: " . mysqli_error($conn);
                                }
                            }
                            ?>


                            <div class="container mt-5">
                                <h2>Edit Property</h2>
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="row">


                                    <div class="form-group col-6">
                                        <label>Property Title</label>
                                        <input type="text" name="title" value="<?php echo $property['title']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Property Type</label>
                                        <input type="text" name="type" value="<?php echo $property['type']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Price</label>
                                        <input type="text" name="price" value="<?php echo $property['price']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" value="<?php echo $property['phone']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Location</label>
                                        <input type="text" name="location" value="<?php echo $property['location']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Size (sqft)</label>
                                        <input type="text" name="size_sqft" value="<?php echo $property['size_sqft']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Bedrooms</label>
                                        <input type="text" name="bedrooms" value="<?php echo $property['bedrooms']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Bathrooms</label>
                                        <input type="text" name="bathrooms" value="<?php echo $property['bathrooms']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Furnishing Status</label>
                                        <input type="text" name="furnishing_status" value="<?php echo $property['furnishing_status']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Amenities</label>
                                        <textarea name="amenities" class="form-control" required><?php echo $property['amenities']; ?></textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" required><?php echo $property['description']; ?></textarea>
                                    </div>

                                    <div class="form-group col-6 ">
                                        <label>Current Image</label><br>
                                        <img src="../uploads/properties/<?php echo $property['image']; ?>" width="150">
                                    
                                        <label>Upload New Image (optional)</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                    <div class="form-group col-6 ">
                                        <label>Current Multiple Images</label><br>
                                        <?php
                                        $imageArray = explode(",", $property['images']);
                                        foreach ($imageArray as $img) {
                                            echo '<img src="../uploads/properties/' . $img . '" width="100" style="margin-right:5px;">';
                                        }
                                        ?>
                                   
                                        <label>Upload New Images (optional)</label>
                                        <input type="file" name="images[]" class="form-control" multiple>
                                    </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Property</button>
                                    <a href="properties.php" class="btn btn-secondary">Cancel</a>
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