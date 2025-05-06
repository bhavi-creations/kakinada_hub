<?php
 
include 'header.php';
?>

<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Add Restaurant</h1>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <?php include '../../db.connection/db_connection.php'; ?>

                            <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                // 1. Validate Restaurant Data
                                $name = mysqli_real_escape_string($conn, $_POST['name']);
                                $star_rating = floatval($_POST['star_rating']);
                                $about = mysqli_real_escape_string($conn, $_POST['about']);
                                $tagline = mysqli_real_escape_string($conn, $_POST['tagline']); // Get tagline

                                if (empty($name) || $star_rating < 0 || $star_rating > 5) {
                                    echo "<div class='alert alert-danger'>Invalid data.</div>";
                                } else {
                                    // 2. Handle Images Upload
                                    $uploadDir = '../uploads/restaurants/';
                                    if (!is_dir($uploadDir)) {
                                        mkdir($uploadDir, 0777, true);
                                    }

                                    $imagePaths = [];
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
                                            }
                                        }
                                    }
                                    $imagePathsString = implode(',', $imagePaths);

                                    // 3. Handle Menu Items
                                    $foodNames = [];
                                    $prices = [];
                                    if (isset($_POST['menu_items']) && is_array($_POST['menu_items'])) {
                                        foreach ($_POST['menu_items'] as $menuItem) {
                                            $foodName = mysqli_real_escape_string($conn, $menuItem['food_name']);
                                            $price = floatval($menuItem['price']);

                                            if (empty($foodName) || $price < 0) {
                                                echo "<div class='alert alert-danger'>Invalid menu item.</div>";
                                                exit;
                                            }
                                            $foodNames[] = $foodName;
                                            $prices[] = $price;
                                        }
                                    }
                                    $foodNamesString = implode(',', $foodNames);
                                    $pricesString = implode(',', $prices);

                                    // 4. Insert Restaurant (Modified query)
                                    $insertRestaurantQuery = "INSERT INTO restaurants (name, star_rating, about, tagline, image_paths, food_names, prices) 
                                                            VALUES ('$name', $star_rating, '$about', '$tagline', '$imagePathsString', '$foodNamesString', '$pricesString')"; // Include tagline

                                    if (mysqli_query($conn, $insertRestaurantQuery)) {
                                        echo "<div id='success-message' class='alert alert-success alert-dismissible fade show' role='alert'>Restaurant added successfully.</div>";
                                         echo '<script>
                                            setTimeout(function() {
                                                document.getElementById("success-message").style.display = "none";
                                            }, 3000);
                                            </script>';
                                        header("Location: add_restaurant.php");
                                        exit();
                                    } else {
                                        echo "<div class='alert alert-danger'>Failed to add restaurant.</div>";
                                    }
                                    mysqli_close($conn);
                                }
                            }
                            ?>

                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Restaurant Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="star_rating">Star Rating (e.g., 4.5)</label>
                                    <input type="number" name="star_rating" class="form-control" step="0.1" min="0" max="5" required>
                                </div>
                                <div class="form-group">
                                    <label for="about">About</label>
                                    <textarea name="about" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tagline">Tagline</label>
                                    <input type="text" name="tagline" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="images">Restaurant Images (Multiple)</label>
                                    <input type="file" name="images[]" class="form-control-file" multiple>
                                </div>

                                <div class="form-group">
                                    <label>Menu Items</label>
                                    <div id="menuFields">
                                        <div class="input-group mb-3">
                                            <input type="text" name="menu_items[0][food_name]" class="form-control" placeholder="Food Name" required>
                                            <input type="number" name="menu_items[0][price]" class="form-control" placeholder="Price" required min="0">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-secondary" id="addMenuItem">+ Add Menu Item</button>
                                </div>


                                <button type="submit" class="btn btn-primary">Add Restaurant</button>
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

                                window.onload = function() {
                                    const successMessage = document.getElementById('success-message');
                                    if (successMessage) {
                                        setTimeout(function() {
                                            successMessage.style.display = 'none';
                                        }, 3000);
                                    }
                                };
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>
