<?php
include '../../db.connection/db_connection.php'; // Database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch image path
    $query = "SELECT filter_image FROM travels WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    // Delete image file from server
    $filePath = "../uploads/travels/" . $row['filter_image'];
    if (file_exists($filePath)) {
        unlink($filePath); // Remove image file
    }

    // Delete travel type from database
    $deleteQuery = "DELETE FROM travels WHERE id = $id";
    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: travel.php?success=deleted");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>
