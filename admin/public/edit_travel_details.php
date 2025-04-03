<?php
include 'header.php';
include '../../db.connection/db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch travel details
    $sql = "SELECT * FROM travel_details WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $travel = $result->fetch_assoc();
    $stmt->close();

    if (!$travel) {
        echo "Travel details not found.";
        exit;
    }
}

// Fetch travel options
$travelOptions = "";
$sql = "SELECT id, name FROM travels";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $selected = ($row['id'] == $travel['travel_id']) ? "selected" : "";
    $travelOptions .= "<option value='{$row['id']}' $selected>{$row['name']}</option>";
}

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

    // Handle image upload
    $image = $travel['image'];
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../uploads/travels/";
        $image = basename($_FILES['image']['name']);
        $target_file = $target_dir . $image;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Delete old image
            if (!empty($travel['image']) && file_exists($target_dir . $travel['image'])) {
                unlink($target_dir . $travel['image']);
            }
        } else {
            echo "Error uploading image.";
            exit;
        }
    }

    // Update database
    $sql = "UPDATE travel_details SET travel_id=?, model=?, seating_capacity=?, fuel_efficiency=?, price=?, name=?, age=?, gender=?, experience=?, price_per_6hrs=?, image=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issiisissssi", $travel_id, $model, $seating_capacity, $fuel_efficiency, $price, $name, $age, $gender, $experience, $price_per_6hrs, $image, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Travel details updated successfully!'); window.location.href='travel.php?id=$id';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


<!-- Edit Form -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Edit Travel Service</h1>
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Travel Type</label>
                            <select name="travel_id" class="form-control" required>
                                <?php echo $travelOptions; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Model</label>
                            <input type="text" name="model" class="form-control" value="<?php echo $travel['model']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Seating Capacity</label>
                            <input type="number" name="seating_capacity" class="form-control" value="<?php echo $travel['seating_capacity']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Fuel Efficiency</label>
                            <input type="text" name="fuel_efficiency" class="form-control" value="<?php echo $travel['fuel_efficiency']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $travel['price']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $travel['name']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Age</label>
                            <input type="number" name="age" class="form-control" value="<?php echo $travel['age']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="Male" <?php echo ($travel['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo ($travel['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                <option value="Other" <?php echo ($travel['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Experience</label>
                            <input type="text" name="experience" class="form-control" value="<?php echo $travel['experience']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Price per 6 hours</label>
                            <input type="text" name="price_per_6hrs" class="form-control"  value="<?php echo $travel['price_per_6hrs']; ?>" >
                        </div>
                        <div class="col-md-6">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                            <?php if ($travel['image']) { ?>
                                <img src="../uploads/travels/<?php echo $travel['image']; ?>" width="100">
                            <?php } ?>
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary">Update Travel Service</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</div>
<?php include 'end.php'; ?>
