<?php
include 'header.php';
include '../../db.connection/db_connection.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    function getRestaurantById($conn, $id) {
        $restaurant = null;
        $stmt = $conn->prepare("SELECT * FROM restaurants WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $restaurant = $result->fetch_assoc();
        }
        $stmt->close();
        return $restaurant;
    }

    $restaurant = getRestaurantById($conn, $id);

    if (!$restaurant) {
        echo "<div class='alert alert-danger'>Restaurant not found.</div>";
        exit;
    }

    $uploadDir = '../uploads/restaurants/';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $star_rating = floatval($_POST['star_rating']);
        $about = mysqli_real_escape_string($conn, $_POST['about']);
        $tagline = mysqli_real_escape_string($conn, $_POST['tagline']);

        if (empty($name) || $star_rating < 0 || $star_rating > 5) {
            echo "<div class='alert alert-danger'>Invalid data.</div>";
        } else {
            // Handle main image
            $mainImage = $restaurant['main_image'];
            if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] == 0) {
                $mainImageExt = pathinfo($_FILES['main_image']['name'], PATHINFO_EXTENSION);
                $mainImageName = uniqid('main_') . '.' . $mainImageExt;
                $mainImagePath = $uploadDir . $mainImageName;

                if (move_uploaded_file($_FILES['main_image']['tmp_name'], $mainImagePath)) {
                    // Optionally delete old image file
                    if (!empty($restaurant['main_image']) && file_exists($uploadDir . $restaurant['main_image'])) {
                        unlink($uploadDir . $restaurant['main_image']);
                    }
                    $mainImage = $mainImageName;
                } else {
                    echo "<div class='alert alert-danger'>Failed to upload main image.</div>";
                }
            }

            // Handle gallery images
            $imagePaths = [];
            $existingImagePaths = explode(',', $restaurant['image_paths']);
            $uploadSuccess = true;
            $uploadErrors = [];

            if (isset($_FILES['images']) && is_array($_FILES['images']['name'])) {
                foreach ($_FILES['images']['name'] as $index => $filename) {
                    if ($_FILES['images']['error'][$index] == 0) {
                        $fileExt = pathinfo($filename, PATHINFO_EXTENSION);
                        $newFilename = uniqid() . '.' . $fileExt;
                        $filePath = $uploadDir . $newFilename;

                        if (move_uploaded_file($_FILES['images']['tmp_name'][$index], $filePath)) {
                            $imagePaths[] = $newFilename;
                        } else {
                            $uploadSuccess = false;
                            $uploadErrors[] = "Failed to upload image: " . $filename;
                        }
                    } elseif ($_FILES['images']['error'][$index] != 4) {
                        $uploadSuccess = false;
                        $uploadErrors[] = "Error uploading " . $filename . ". Error Code: " . $_FILES['images']['error'][$index];
                    }
                }
            }

            if (isset($_POST['existing_images']) && is_array($_POST['existing_images'])) {
                $imagePaths = array_merge($imagePaths, $_POST['existing_images']);
            }

            $allImages = array_unique($imagePaths);
            $imagePathsString = implode(',', $allImages);

            // Handle menu items
            $foodNames = [];
            $prices = [];
            if (isset($_POST['menu_items']) && is_array($_POST['menu_items'])) {
                foreach ($_POST['menu_items'] as $menuItem) {
                    $foodName = mysqli_real_escape_string($conn, $menuItem['food_name']);
                    $price = floatval($menuItem['price']);
                    if (empty($foodName) || $price < 0) {
                        echo "<div class='alert alert-danger'>Invalid menu item. Food Name: $foodName, Price: $price </div>";
                        exit;
                    }
                    $foodNames[] = $foodName;
                    $prices[] = $price;
                }
            }

            $foodNamesString = implode(',', $foodNames);
            $pricesString = implode(',', $prices);

            $updateRestaurantQuery = "UPDATE restaurants 
                SET name = '$name', 
                    star_rating = $star_rating, 
                    about = '$about', 
                    tagline = '$tagline', 
                    main_image = '$mainImage', 
                    image_paths = '$imagePathsString', 
                    food_names = '$foodNamesString', 
                    prices = '$pricesString' 
                WHERE id = $id";

            if ($uploadSuccess && mysqli_query($conn, $updateRestaurantQuery)) {
                echo "<div class='alert alert-success'>Restaurant updated successfully.</div>";
                header("Location: view_restaurants.php");
                exit;
            } else {
                $errorMessage = "Failed to update restaurant.";
                if (!$uploadSuccess) {
                    $errorMessage .= " Image upload failed: " . implode(", ", $uploadErrors);
                }
                echo "<div class='alert alert-danger'>$errorMessage</div>";
            }
        }
    }
}
?>

<!-- HTML content -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include 'navbar.php'; ?>
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Edit Restaurant</h1>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <?php if ($restaurant): ?>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Restaurant Name</label>
                                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($restaurant['name']) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="star_rating">Star Rating (e.g., 4.5)</label>
                                    <input type="number" name="star_rating" class="form-control" step="0.1" min="0" max="5" value="<?= htmlspecialchars($restaurant['star_rating']) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="about">About</label>
                                    <textarea name="about" class="form-control"><?= htmlspecialchars($restaurant['about']) ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tagline">Tagline</label>
                                    <input type="text" name="tagline" class="form-control" value="<?= htmlspecialchars($restaurant['tagline']) ?>">
                                </div>
                                <div class="form-group">
                                    <label for="main_image">Main Image</label>
                                    <input type="file" name="main_image" class="form-control-file">
                                    <?php if (!empty($restaurant['main_image'])): ?>
                                        <div class="mt-2">
                                            <img src="<?= $uploadDir . htmlspecialchars($restaurant['main_image']) ?>" alt="Main Image" class="img-thumbnail" width="150">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="images">Gallery Images (Multiple)</label>
                                    <input type="file" name="images[]" class="form-control-file" multiple>
                                    <div class="mt-2">
                                        Existing Images:
                                        <?php
                                        $existingImagePaths = explode(',', $restaurant['image_paths']);
                                        foreach ($existingImagePaths as $imagePath) {
                                            if (!empty($imagePath)) {
                                                echo '<div style="display:inline-flex; align-items:center; margin-right:10px;">
                                                    <img src="' . $uploadDir . htmlspecialchars($imagePath) . '" alt="Restaurant Image" class="img-thumbnail" width="100">
                                                    <button type="button" class="btn btn-danger btn-sm ml-2 remove-image-btn" data-image-name="' . htmlspecialchars($imagePath) . '">Remove</button>
                                                    <input type="hidden" name="existing_images[]" value="' . htmlspecialchars($imagePath) . '">
                                                </div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Menu Items</label>
                                    <div id="menuFields">
                                        <?php
                                        $foodNames = explode(',', $restaurant['food_names']);
                                        $prices = explode(',', $restaurant['prices']);
                                        for ($i = 0; $i < max(count($foodNames), count($prices)); $i++) {
                                            $foodNameValue = isset($foodNames[$i]) ? htmlspecialchars($foodNames[$i]) : '';
                                            $priceValue = isset($prices[$i]) ? htmlspecialchars($prices[$i]) : '';
                                            echo '<div class="input-group mb-3">
                                                <input type="text" name="menu_items[' . $i . '][food_name]" class="form-control" placeholder="Food Name" value="' . $foodNameValue . '" required>
                                                <input type="number" name="menu_items[' . $i . '][price]" class="form-control" placeholder="Price" value="' . $priceValue . '" required min="0">
                                            </div>';
                                        }
                                        ?>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-secondary" id="addMenuItem">+ Add Menu Item</button>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Restaurant</button>
                            </form>
                            <script>
                                document.getElementById('addMenuItem').addEventListener('click', function() {
                                    let container = document.getElementById('menuFields');
                                    let newIndex = container.querySelectorAll('.input-group').length;
                                    let newInputGroup = document.createElement('div');
                                    newInputGroup.className = 'input-group mb-3';
                                    newInputGroup.innerHTML = `
                                        <input type="text" name="menu_items[${newIndex}][food_name]" class="form-control" placeholder="Food Name" required>
                                        <input type="number" name="menu_items[${newIndex}][price]" class="form-control" placeholder="Price" required min="0">
                                    `;
                                    container.appendChild(newInputGroup);
                                });

                                document.addEventListener('click', function(event) {
                                    if (event.target.classList.contains('remove-image-btn')) {
                                        const imageToRemove = event.target.getAttribute('data-image-name');
                                        const imageContainer = event.target.closest('div');
                                        if (imageContainer) {
                                            imageContainer.remove();
                                        }
                                    }
                                });
                            </script>
                        <?php else: ?>
                            <div class="alert alert-danger">Restaurant not found.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</div>
<?php include 'end.php'; ?>
