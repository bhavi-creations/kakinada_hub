<?php
include '../../db.connection/db_connection.php';

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // Step 1: Fetch the image file name
    $result = mysqli_query($conn, "SELECT image FROM trending WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $image = $row['image'];
        $imagePath = '../uploads/home_trending/' . $image;

        // Step 2: Delete the image file if it exists
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Step 3: Delete the record from the database
        $deleteQuery = "DELETE FROM trending WHERE id = $id";
        if (mysqli_query($conn, $deleteQuery)) {
            header("Location: view_home_trending.php?msg=deleted");
            exit;
        } else {
            echo "Error deleting item: " . mysqli_error($conn);
        }
    } else {
        echo "Item not found.";
    }
} else {
    echo "Invalid request.";
}
?>
