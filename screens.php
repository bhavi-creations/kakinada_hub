<?php 
include 'navbar.php';  
include './db.connection/db_connection.php'; 
include 'moviesidebar.php';

// Get theater ID from URL
$theater_id = isset($_GET['theater_id']) ? intval($_GET['theater_id']) : 0;

// Fetch theater name dynamically
$theater_query = "SELECT name FROM theaters WHERE id = ?";
$stmt = mysqli_prepare($conn, $theater_query);
mysqli_stmt_bind_param($stmt, "i", $theater_id);
mysqli_stmt_execute($stmt);
$theater_result = mysqli_stmt_get_result($stmt);
$theater_row = mysqli_fetch_assoc($theater_result);
$theater_name = $theater_row ? htmlspecialchars($theater_row['name']) : "Unknown Theater";

// Fetch screens for the selected theater
$query = "SELECT id, screen_name, screen_image FROM screens WHERE theater_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $theater_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<h1 class="text-center my-4"><?php echo $theater_name; ?></h1>

<section>
    <div class="container">
        <div class="row g-4"> <!-- g-4 adds spacing between items -->

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-12 col-sm-6 col-md-4"> <!-- Responsive grid -->
                    <a href="screen_details.php?screen_id=<?php echo $row['id']; ?>" class="text-decoration-none">
                        <div class="card bg-dark text-white shadow-lg rounded overflow-hidden position-relative">
                            <img src="./admin/uploads/screens/<?php echo htmlspecialchars($row['screen_image']); ?>" 
                                 alt="<?php echo htmlspecialchars($row['screen_name']); ?>" 
                                 class="img-fluid"
                                 style="width: 100%; height: 220px; object-fit: cover;">
                            
                            <!-- Dark overlay for better readability -->
                            <div class="overlay position-absolute w-100 h-100" style="background: rgba(0, 0, 0, 0.5); top: 0; left: 0;"></div>
                            
                            <!-- Highlighted background for screen name -->
                            <div class="card-body position-absolute w-100 text-center" 
                                style="bottom: 0; padding: 10px; background: #00000080; color: white; border-radius: 0 0 10px 10px;">
                                <h4 class="mb-0" style="font-size: 20px; font-weight: bold; color:white;">
                                    <?php echo htmlspecialchars($row['screen_name']); ?>
                                </h4>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>

        </div>
    </div>
</section>

<?php include 'chat_bot.php'; ?>
<?php include 'footer.php'; ?>
