<?php
include '../../db.connection/db_connection.php';

if (isset($_GET['id'])) {
    $ad_id = $_GET['id'];

    // Fetch the ad details to get the image path before deleting
    $query = "SELECT * FROM banner_ads WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $ad_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $ad = $result->fetch_assoc();

        // Delete the banner ad record from the database
        $deleteQuery = "DELETE FROM banner_ads WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $ad_id);

        if ($deleteStmt->execute()) {
            // Remove the associated image from the server
            $imagePath = '../uploads/banner_ads/' . $ad['image_path'];
            if (file_exists($imagePath)) {
                unlink($imagePath);  // Delete the image
            }

            header("Location: view_banner_adds.php?success=1");
            exit;
        } else {
            echo "Error deleting banner ad.";
        }
    } else {
        echo "Banner ad not found.";
    }
} else {
    echo "Invalid request.";
}
