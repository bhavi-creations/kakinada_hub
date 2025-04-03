<?php include 'header.php'; ?>
<?php include '../../db.connection/db_connection.php';

// Fetch travel names from the travels table
$travelOptions = "";
$sql = "SELECT id, name FROM travels";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $travelOptions .= "<option value='{$row['id']}'>{$row['name']}</option>";
    }
}

// Handle form submission
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $travel_id = $_POST['travel_id'];
    $model = !empty($_POST['model']) ? $_POST['model'] : NULL;
    $seating_capacity = !empty($_POST['seating_capacity']) ? $_POST['seating_capacity'] : NULL;
    $fuel_efficiency = !empty($_POST['fuel_efficiency']) ? $_POST['fuel_efficiency'] : NULL;
    $price = !empty($_POST['price']) ? $_POST['price'] : NULL;
    $name = !empty($_POST['name']) ? $_POST['name'] : NULL;
    $age = !empty($_POST['age']) ? $_POST['age'] : NULL;
    $gender = isset($_POST['gender']) && $_POST['gender'] !== "" ? $_POST['gender'] : NULL;
    $experience = !empty($_POST['experience']) ? $_POST['experience'] : NULL;
    $price_per_6hrs = !empty($_POST['price_per_6hrs']) ? $_POST['price_per_6hrs'] : NULL;
    $created_at = date('Y-m-d H:i:s');

    // Handle image upload
    $image = NULL;
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../uploads/travels/";
        $image = basename($_FILES['image']['name']);
        $target_file = $target_dir . $image;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Image uploaded successfully
        } else {
            echo "Error uploading image.";
            exit;
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO travel_details (travel_id, model, seating_capacity, fuel_efficiency, price, name, age, gender, experience, price_per_6hrs, image, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issiisisssss", $travel_id, $model, $seating_capacity, $fuel_efficiency, $price, $name, $age, $gender, $experience, $price_per_6hrs, $image, $created_at);

    if ($stmt->execute()) {
        echo "<script>alert('Travel details added successfully!'); window.location.href='add_travel_type.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Add Travel Service</h1>
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Travel Type</label>
                            <select name="travel_id" class="form-control" required>
                                <option value="">Select Travel Type</option>
                                <?php echo $travelOptions; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Model</label>
                            <input type="text" name="model" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Seating Capacity</label>
                            <input type="number" name="seating_capacity" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Fuel Efficiency</label>
                            <input type="text" name="fuel_efficiency" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Age</label>
                            <input type="number" name="age" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="">Select Gender</option> <!-- Empty option to allow NULL -->
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Experience (Years)</label>
                            <input type="text" name="experience" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Price per 6 hours</label>
                            <input type="text" name="price_per_6hrs" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary">Add Travel Service</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</div>
<?php include 'end.php'; ?>