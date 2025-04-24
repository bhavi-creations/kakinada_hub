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
                    <h1 class="h3 mb-0 text-gray-800">Available Property</h1>
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
                                header("Location: properties_list.php"); // Redirect to property list
                                exit();
                            }
                            ?>

                            <div class="container mt-5">
                                <h2>Property Details</h2>
                                <table class="table table-bordered">
                                  
                                

                                    <tr>
                                        <th>Category</th>
                                        <td><?php echo ucfirst($property['category']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Property Name</th>
                                        <td><?php echo $property['title']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td><?php echo $property['type']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td><?php echo $property['price']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td><?php echo $property['phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Facing</th>
                                        <td><?php echo $property['facing']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Location</th>
                                        <td><?php echo $property['location']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Size (sqft)</th>
                                        <td><?php echo $property['size_sqft']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Bedrooms</th>
                                        <td><?php echo $property['bedrooms']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Bathrooms</th>
                                        <td><?php echo $property['bathrooms']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Furnishing Status</th>
                                        <td><?php echo $property['furnishing_status']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Amenities</th>
                                        <td><?php echo $property['amenities']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Main Image</th>
                                        <td><img src="../uploads/properties/<?php echo $property['image']; ?>" width="300"></td>
                                    </tr>
                                    <tr>
                                        <th>Additional Images</th>
                                        <td>
                                            <?php
                                            $images = explode(',', $property['images']); // Assuming images are stored as comma-separated values
                                            foreach ($images as $img) {
                                                echo '<img src="../uploads/properties/' . trim($img) . '" width="150" style="margin: 5px;">';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td><?php echo nl2br($property['description']); ?></td>
                                    </tr>
                                </table>
                                <a href="properties.php" class="btn btn-secondary">Back to List</a>
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