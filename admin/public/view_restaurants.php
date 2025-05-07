<?php
// admin/public/view_restaurants.php
include 'header.php';
//include 'admin_functions.php';  // Include if you have admin functions for checks

//  database connection file.
include '../../db.connection/db_connection.php';

// Function to fetch all restaurants
function getAllRestaurants($conn) {
    try {
        $restaurants = [];
        $result = mysqli_query($conn, "SELECT * FROM restaurants ORDER BY created_at DESC");
        if (!$result) {
            throw new Exception("Query failed: " . mysqli_error($conn)); // More specific error handling
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $restaurants[] = $row;
        }
        return $restaurants;
    } catch (Exception $e) {
        error_log("Error in getAllRestaurants: " . $e->getMessage()); // Log the error
        return []; // Return an empty array on error to avoid further issues
    }
}

// Get all restaurants
$all_restaurants = getAllRestaurants($conn);

// Define the base path for the uploaded images
$upload_path = '../uploads/restaurants/';
?>

<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include 'navbar.php'; ?>
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">View Restaurants</h1>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Star Rating</th>
                                        <th>About</th>
                                        <th>Tagline</th>
                                        <th>Main Image</th>
                                        <th>Images</th>
                                        <th>Menu Items</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($all_restaurants)): ?>
                                        <?php foreach ($all_restaurants as $index => $restaurant): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= htmlspecialchars($restaurant['name']) ?></td>
                                                <td><?= htmlspecialchars($restaurant['star_rating']) ?></td>
                                                <td><?= htmlspecialchars($restaurant['about']) ?></td>
                                                <td><?= htmlspecialchars($restaurant['tagline']) ?></td>
                                                <td>
                                                    <?php if (!empty($restaurant['main_image'])): ?>
                                                        <img src="<?= $upload_path . htmlspecialchars($restaurant['main_image']) ?>" alt="Main Image" class="img-thumbnail" width="100">
                                                    <?php else: ?>
                                                        No Main Image
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($restaurant['image_paths']): ?>
                                                        <?php
                                                        $imagePaths = explode(',', $restaurant['image_paths']);
                                                        foreach ($imagePaths as $imagePath) {
                                                            if(!empty($imagePath)){
                                                                echo '<img src="' . $upload_path . htmlspecialchars($imagePath) . '" alt="Restaurant Image" class="img-thumbnail" width="100">';
                                                            }
                                                        }
                                                        ?>
                                                    <?php else: ?>
                                                        No Images
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($restaurant['food_names'] && $restaurant['prices']): ?>
                                                        <ul>
                                                        <?php
                                                        $foodNames = explode(',', $restaurant['food_names']);
                                                        $prices = explode(',', $restaurant['prices']);
                                                        // Determine the maximum number of items to display
                                                        $maxItems = max(count($foodNames), count($prices));

                                                        for ($i = 0; $i < $maxItems; $i++) {
                                                            // Get food name and price, handling potential missing values
                                                            $foodName = isset($foodNames[$i]) ? htmlspecialchars($foodNames[$i]) : '';
                                                            $price = isset($prices[$i]) ? htmlspecialchars($prices[$i]) : '';
                                                            echo '<li>' . $foodName . ' - ' . $price . '</li>';
                                                        }
                                                        ?>
                                                        </ul>
                                                    <?php else: ?>
                                                        No Menu Items
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= date('F j, Y, g:i a', strtotime($restaurant['created_at'])) ?></td>
                                                <td>
                                                    <a href="edit_restaurant.php?id=<?= $restaurant['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="delete_restaurant.php?id=<?= $restaurant['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this restaurant?')">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="10">No restaurants found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();  // Initialize DataTables
    });
</script>

