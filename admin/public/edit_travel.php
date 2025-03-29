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
                    <h1 class="h3 mb-0 text-gray-800">Edit Travel</h1>
                    <a href="add_travel.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Travel
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="row row-custom no-gutters col-12">

                            <?php
                            include '../../db.connection/db_connection.php';

                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $query = "SELECT * FROM travels WHERE id = $id";
                                $result = mysqli_query($conn, $query);
                                $travel = mysqli_fetch_assoc($result);
                            } else {
                                $_SESSION['message'] = "Travel entry not found!";
                                $_SESSION['msg_type'] = "danger";
                                header("Location: travels.php");
                                exit();
                            }

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Escape user inputs
                                $type = mysqli_real_escape_string($conn, $_POST['type']);
                                $model = mysqli_real_escape_string($conn, $_POST['model']);
                                $seating_capacity = mysqli_real_escape_string($conn, $_POST['seating_capacity']);
                                $fuel_efficiency = mysqli_real_escape_string($conn, $_POST['fuel_efficiency']);
                                $price = mysqli_real_escape_string($conn, $_POST['price']);

                                // Initialize query
                                $update_query = "UPDATE travels SET 
                                type='$type', 
                                model='$model', 
                                seating_capacity='$seating_capacity', 
                                fuel_efficiency='$fuel_efficiency', 
                                price='$price'";

                                // Handle Image Upload (Optional)
                                if (!empty($_FILES['image']['name'])) {
                                    $image = $_FILES['image']['name'];
                                    $target = "../uploads/travels/" . basename($image);
                                    move_uploaded_file($_FILES['image']['tmp_name'], $target);
                                    $update_query .= ", image='$image'";
                                }

                                // Finalizing SQL query
                                $update_query .= " WHERE id=$id";

                                // Execute Query
                                if (mysqli_query($conn, $update_query)) {
                                    $_SESSION['message'] = "Travel entry updated successfully!";
                                    $_SESSION['msg_type'] = "success";
                                    header("Location: travels.php");
                                    exit();
                                } else {
                                    echo "Error updating record: " . mysqli_error($conn);
                                }
                            }
                            ?>

                            <div class="container mt-5">
                                <h2>Edit Travel</h2>
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="row">

                                    <div class="form-group col-6">
                                        <label>Type</label>
                                        <input type="text" name="type" value="<?php echo $travel['type']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Model</label>
                                        <input type="text" name="model" value="<?php echo $travel['model']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Seating Capacity</label>
                                        <input type="text" name="seating_capacity" value="<?php echo $travel['seating_capacity']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Fuel Efficiency</label>
                                        <input type="text" name="fuel_efficiency" value="<?php echo $travel['fuel_efficiency']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Price</label>
                                        <input type="text" name="price" value="<?php echo $travel['price']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Current Image</label><br>
                                        <img src="../uploads/travels/<?php echo $travel['image']; ?>" width="150">
                                    
                                        <label>Upload New Image (optional)</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Travel</button>
                                    <a href="travel.php" class="btn btn-secondary">Cancel</a>
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
