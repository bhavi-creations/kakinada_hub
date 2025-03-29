<?php
include '../../db.connection/db_connection.php';

if (isset($_GET['service'])) {
    $service_slug = mysqli_real_escape_string($conn, $_GET['service']);
    
    $query = "SELECT * FROM services WHERE slug = '$service_slug'";
    $result = mysqli_query($conn, $query);
    $service = mysqli_fetch_assoc($result);

    if (!$service) {
        echo "<h2 class='text-center text-danger'>Service Not Found!</h2>";
        exit();
    }
} else {
    echo "<h2 class='text-center text-danger'>Invalid Service</h2>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $service['name']; ?> - Kakinada Hub</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file -->
</head>
<body>
    <div class="container">
        <h1 class="text-primary text-center"><?php echo $service['name']; ?></h1>
        <p class="text-muted text-center">Details about <?php echo $service['name']; ?> will be shown here.</p>

        <!-- Display Specific Content Based on Service -->
        <div class="service-content">
            <?php
            if ($service_slug == "movies") {
                echo "<p>Here you can find the latest movies and cinema showtimes.</p>";
            } elseif ($service_slug == "travel") {
                echo "<p>Find the best travel deals, locations, and packages.</p>";
            } elseif ($service_slug == "properties") {
                echo "<p>Explore property listings, rental options, and real estate deals.</p>";
            } else {
                echo "<p>More details will be added soon.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
