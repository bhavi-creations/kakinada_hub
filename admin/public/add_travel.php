<?php
include 'header.php';
include '../../db.connection/db_connection.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect input data
    $type = trim($_POST['type']);
    $model = trim($_POST['model']);
    $seating_capacity = intval($_POST['seating_capacity']);
    $fuel_efficiency = trim($_POST['fuel_efficiency']);
    $price = floatval($_POST['price']);

    // Image upload handling
    $upload_folder = "../uploads/travels/";
    if (!file_exists($upload_folder)) {
        mkdir($upload_folder, 0777, true);
    }

    $image_name = '';
    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . basename($_FILES['image']['name']);
        $image_path = $upload_folder . $image_name;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $_SESSION['message'] = "Error: Image upload failed.";
            $_SESSION['msg_type'] = "danger";
            header("Location: add_travel.php");
            exit();
        }
    }

    // Insert into database
    $query = "INSERT INTO travels (type, model, seating_capacity, fuel_efficiency, price, image, created_at) 
              VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssisss", $type, $model, $seating_capacity, $fuel_efficiency, $price, $image_name);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Travel package added successfully!";
        $_SESSION['msg_type'] = "success";
        header("Location: add_travel.php?success=1"); // Redirect with success flag
        exit();
    } else {
        $_SESSION['message'] = "Database error: " . $stmt->error;
        $_SESSION['msg_type'] = "danger";
        header("Location: add_travel.php");
        exit();
    }
}



?>



<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>
        <div id="content">
            <div class="container-fluid">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-4 text-gray-800">Add Travel Package</h1>

                    <a href="travel.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa-regular fa-eye"></i> View Travel services</a>
                </div>
                <?php if (isset($_GET['success'])): ?>
                    <div id="success-message" class="alert alert-success">
                        Travel package added successfully!
                    </div>

                    <script>
                        setTimeout(function() {
                            let successMessage = document.getElementById('success-message');
                            if (successMessage) {
                                successMessage.style.display = 'none';
                            }
                            // Remove success parameter from URL after timeout
                            const url = new URL(window.location.href);
                            url.searchParams.delete('success');
                            window.history.replaceState(null, '', url);
                        }, 2000); // Message disappears after 3 seconds
                    </script>
                <?php endif; ?>



                <div class="container">
                    <form action="add_travel.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Type:</label>
                                <input type="text" name="type" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Model:</label>
                                <input type="text" name="model" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Seating Capacity:</label>
                                <input type="number" name="seating_capacity" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Fuel Efficiency:</label>
                                <input type="text" name="fuel_efficiency" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Price:</label>
                                <input type="number" step="0.01" name="price" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Upload Image:</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Add Travel Package</button>
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